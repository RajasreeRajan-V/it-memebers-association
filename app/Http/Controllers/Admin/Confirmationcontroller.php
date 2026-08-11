<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminConfirmation;
use App\Models\MentorMentee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfirmationController extends Controller
{
    // Queue of everything waiting on an admin: mentee-accept requests + final resume reviews
    public function index(Request $request)
    {
        $action = $request->query('action', 'all'); // mentee_request | resume_review | all

        $query = AdminConfirmation::with(['confirmable', 'requestedBy'])
            ->pending()
            ->latest();

        if ($action !== 'all') {
            $query->action($action);
        }

        $confirmations = $query->paginate(15)->withQueryString();

        $counts = [
            'mentee_request' => AdminConfirmation::pending()->action('mentee_request')->count(),
            'resume_review' => AdminConfirmation::pending()->action('resume_review')->count(),
        ];

        return view('admin.confirmations.index', compact('confirmations', 'counts', 'action'));
    }

    // Approve — finalizes whichever action this confirmation represents
    public function approve(Request $request, AdminConfirmation $confirmation)
    {
        abort_unless($confirmation->status === 'pending', 409, 'This request has already been handled.');

        $notes = $request->input('admin_notes');

        match ($confirmation->action) {
            'mentee_request' => $this->finalizeMenteeRequest($confirmation),
            'resume_review' => $this->finalizeResumeReview($confirmation),
            default => null,
        };

        $confirmation->update([
            'status' => 'approved',
            'admin_id' => Auth::guard('admin')->id() ?? Auth::id(),
            'admin_notes' => $notes,
            'confirmed_at' => now(),
        ]);

        return back()->with('success', 'Confirmed and finalized.');
    }

    // Reject — sends it back; the underlying record's status reverts so the mentor can retry
    public function reject(Request $request, AdminConfirmation $confirmation)
    {
        abort_unless($confirmation->status === 'pending', 409, 'This request has already been handled.');

        $data = $request->validate([
            'admin_notes' => ['required', 'string'],
        ]);

        $confirmable = $confirmation->confirmable;

        if ($confirmation->action === 'mentee_request' && $confirmable) {
            $confirmable->update(['status' => 'rejected']);
        }

        if ($confirmation->action === 'resume_review' && $confirmable) {
            // Leave it in "in_review" so the mentor sees it back in their queue to revise
            $confirmable->update(['status' => 'in_review']);
        }

        $confirmation->update([
            'status' => 'rejected',
            'admin_id' => Auth::guard('admin')->id() ?? Auth::id(),
            'admin_notes' => $data['admin_notes'],
            'confirmed_at' => now(),
        ]);

        return back()->with('success', 'Request rejected and sent back to the mentor.');
    }

    private function finalizeMenteeRequest(AdminConfirmation $confirmation): void
    {
        $mentorshipRequest = $confirmation->confirmable;
        if (! $mentorshipRequest) {
            return;
        }

        // TODO: this is where "Admin Verifies Slot Availability" from your workflow diagram
        // would check the mentor's calendar for conflicts before confirming the slot.
        MentorMentee::firstOrCreate([
            'mentor_id' => $mentorshipRequest->mentor_id,
            'student_id' => $mentorshipRequest->mentee_id,
        ]);

        $mentorshipRequest->update(['status' => 'accepted']);
    }

    private function finalizeResumeReview(AdminConfirmation $confirmation): void
    {
        $review = $confirmation->confirmable;
        if (! $review) {
            return;
        }

        // This is the moment feedback actually becomes visible to the student
        $review->update([
            'status' => 'completed',
            'reviewed_at' => now(),
        ]);
    }
}
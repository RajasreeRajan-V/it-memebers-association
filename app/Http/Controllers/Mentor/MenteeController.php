<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\AdminConfirmation;
use App\Models\MentorMentee;
use App\Models\MentorshipRequest;
use App\Models\MentorshipSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenteeController extends Controller
{
    // List pending requests + assigned mentees for the logged-in mentor
    public function index()
    {
        $pendingRequests = MentorshipRequest::with(['mentee', 'adminConfirmation'])
            ->where('mentor_id', Auth::id())
            ->latest()
            ->take(20) // adjust as needed, or paginate
            ->get();

        $mentees = MentorMentee::with(['student', 'sessions'])
            ->where('mentor_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('mentor.mentees.index', compact('pendingRequests', 'mentees'));
    }

    // Send an accept decision to the admin for confirmation — does NOT create
    // the MentorMentee link yet. That happens once the admin approves.
    public function acceptRequest(MentorshipRequest $mentorshipRequest)
    {
        $this->authorizeRequest($mentorshipRequest);

        if ($mentorshipRequest->adminConfirmation()->pending()->exists()) {
            return back()->with('success', 'This request is already awaiting admin confirmation.');
        }

        AdminConfirmation::create([
            'confirmable_type' => MentorshipRequest::class,
            'confirmable_id' => $mentorshipRequest->id,
            'action' => 'mentee_request',
            'requested_by' => Auth::id(),
            'status' => 'pending',
        ]);

        return back()->with('success', 'Accepted — sent to admin for confirmation. The mentee will be added once approved.');
    }

    // Reject an accept/decline decision — no admin step needed for this one
    public function rejectRequest(MentorshipRequest $mentorshipRequest)
    {
        $this->authorizeRequest($mentorshipRequest);

        $mentorshipRequest->update(['status' => 'rejected']);

        return back()->with('success', 'Request rejected.');
    }

    // View a single mentee's profile + session history
    public function show(MentorMentee $mentee)
    {
        $this->authorizeMentee($mentee);

        $mentee->load(['student', 'sessions' => fn ($q) => $q->orderByDesc('scheduled_at')]);

        return view('mentor.mentees.show', compact('mentee'));
    }

    // Schedule a new session with this mentee
    public function storeSession(Request $request, MentorMentee $mentee)
    {
        $this->authorizeMentee($mentee);

        $data = $request->validate([
            'scheduled_at' => ['required', 'date'],
            'mode' => ['required', 'in:online,offline'],
            'meeting_link' => ['nullable', 'string', 'max:255'],
        ]);

        MentorshipSession::create([
            'mentor_mentee_id' => $mentee->id,
            'mentor_id' => Auth::id(),
            'student_id' => $mentee->student_id,
            'scheduled_at' => $data['scheduled_at'],
            'mode' => $data['mode'],
            'meeting_link' => $data['meeting_link'] ?? null,
            'status' => 'scheduled',
        ]);

        return back()->with('success', 'Session scheduled successfully.');
    }

    // Mark a session as conducted
    public function conductSession(MentorshipSession $session)
    {
        $this->authorizeSession($session);

        $session->update([
            'status' => 'conducted',
            'conducted_at' => now(),
        ]);

        return back()->with('success', 'Session marked as conducted.');
    }

    // Submit / update session notes
    public function storeNotes(Request $request, MentorshipSession $session)
    {
        $this->authorizeSession($session);

        $data = $request->validate([
            'session_notes' => ['required', 'string'],
        ]);

        $session->update([
            'session_notes' => $data['session_notes'],
        ]);

        return back()->with('success', 'Session notes submitted.');
    }

    // Mark session (and optionally the mentee track) completed
    public function markCompleted(MentorshipSession $session)
    {
        $this->authorizeSession($session);

        $session->update(['status' => 'conducted', 'conducted_at' => $session->conducted_at ?? now()]);

        return back()->with('success', 'Session marked completed.');
    }

    private function authorizeMentee(MentorMentee $mentee): void
    {
        abort_unless($mentee->mentor_id === Auth::id(), 403);
    }

    private function authorizeSession(MentorshipSession $session): void
    {
        abort_unless($session->mentor_id === Auth::id(), 403);
    }

    private function authorizeRequest(MentorshipRequest $mentorshipRequest): void
    {
        abort_unless($mentorshipRequest->mentor_id === Auth::id(), 403);
    }
}
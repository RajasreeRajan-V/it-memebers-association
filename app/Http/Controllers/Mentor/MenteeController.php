<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\Mentorship;
use App\Models\MentorshipRequest;
use Illuminate\Support\Facades\Auth;

class MenteeController extends Controller
{
    // GET /mentor/mentees — dashboard with tabs
    public function index()
    {
        $mentorId = Auth::id();

        $stats = [
            'active_count'    => Mentorship::where('mentor_id', $mentorId)->where('status', 'active')->count(),
            'pending_count'   => MentorshipRequest::where('mentor_id', $mentorId)->where('status', 'pending')->count(),
            'completed_count' => Mentorship::where('mentor_id', $mentorId)->where('status', 'completed')->count(),
        ];

        $pendingRequests = MentorshipRequest::where('mentor_id', $mentorId)
            ->where('status', 'pending')
            ->with('student')
            ->latest()
            ->get();

        $activeMentees = Mentorship::where('mentor_id', $mentorId)
            ->where('status', 'active')
            ->with(['student', 'sessions' => fn ($q) => $q->orderByDesc('starts_at')->limit(1)])
            ->get();

        $completed = Mentorship::where('mentor_id', $mentorId)
            ->where('status', 'completed')
            ->with('student')
            ->latest()
            ->get();

        return view('mentor.mentees.index', compact('stats', 'pendingRequests', 'activeMentees', 'completed'));
    }

    // GET /mentor/mentees/{mentee} — {mentee} is the Mentorship id
    public function show(Mentorship $mentee)
    {
        abort_unless($mentee->mentor_id === Auth::id(), 403);

        $mentee->load(['student', 'sessions' => fn ($q) => $q->orderByDesc('starts_at')]);
        $upcoming = $mentee->upcomingSession();

        return view('mentor.mentees.show', ['mentorship' => $mentee, 'upcoming' => $upcoming]);
    }

    // POST /mentor/mentees/requests/{mentorshipRequest}/accept
    public function acceptRequest(MentorshipRequest $mentorshipRequest)
    {
        abort_unless($mentorshipRequest->mentor_id === Auth::id(), 403);
        abort_unless($mentorshipRequest->status === 'pending', 422, 'Request already handled.');

        $mentorshipRequest->update([
            'status'      => 'admin_verification',
            'accepted_at' => now(),
        ]);

        return back()->with('success', 'Request accepted. Waiting for platform verification.');
    }

    // POST /mentor/mentees/requests/{mentorshipRequest}/reject
    public function rejectRequest(MentorshipRequest $mentorshipRequest)
    {
        abort_unless($mentorshipRequest->mentor_id === Auth::id(), 403);
        abort_unless($mentorshipRequest->status === 'pending', 422, 'Request already handled.');

        $mentorshipRequest->update(['status' => 'rejected']);

        return back()->with('success', 'Request rejected.');
    }
}

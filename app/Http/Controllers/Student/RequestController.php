<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\MentorshipRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    // GET /student/mentorship — "My Mentorship" (active mentor card + request history)
    public function index()
    {
        $activeMentorship = Auth::user()->mentorshipsAsStudent()
            ->with([
                'mentor.mentorRegistration',
                'sessions' => fn ($q) => $q->orderByDesc('starts_at'),
            ])
            ->where('status', 'active')
            ->latest()
            ->first();

        $upcomingSession = $activeMentorship?->upcomingSession();

        $stats = [
            'upcoming_count'  => $activeMentorship?->sessions()->whereIn('status', ['scheduled', 'confirmed'])->count() ?? 0,
            'completed_count' => $activeMentorship?->sessions()->where('status', 'completed')->count() ?? 0,
            'total_count'     => $activeMentorship?->sessions()->count() ?? 0,
        ];

        $sessionHistory = $activeMentorship?->sessions()->orderByDesc('starts_at')->limit(10)->get();

        $requests = MentorshipRequest::where('student_id', Auth::id())
            ->with('mentor.mentorRegistration')
            ->latest()
            ->get();

        return view('students.mentorship.index', compact(
            'activeMentorship', 'upcomingSession', 'stats', 'sessionHistory', 'requests'
        ));
    }

    // GET /student/mentorship/pending
    public function pending()
    {
        $requests = MentorshipRequest::where('student_id', Auth::id())
            ->whereIn('status', ['pending', 'time_suggested'])
            ->with('mentor.mentorRegistration')
            ->latest()
            ->get();

        return view('students.mentorship.pending', compact('requests'));
    }

    // POST /student/mentorship/requests/{mentorshipRequest}/accept-suggestion
    // Student accepts the mentor's proposed new date/time.
    public function acceptSuggestion(MentorshipRequest $mentorshipRequest)
    {
        abort_unless($mentorshipRequest->student_id === Auth::id(), 403);
        abort_unless($mentorshipRequest->status === 'time_suggested', 422, 'No suggestion to accept.');

        $mentorshipRequest->update([
            'preferred_time' => $mentorshipRequest->suggested_time,
            'status'         => 'accepted',
            'accepted_at'    => now(),
        ]);

        \App\Models\Mentorship::firstOrCreate(
            [
                'mentorship_request_id' => $mentorshipRequest->id,
            ],
            [
                'student_id'  => $mentorshipRequest->student_id,
                'mentor_id'   => $mentorshipRequest->mentor_id,
                'career_goal' => $mentorshipRequest->career_goal,
                'status'      => 'active',
                'started_at'  => now(),
            ]
        );

        return back()->with('success', 'You accepted the suggested time. The mentorship is now active — the mentor will schedule your first session.');
    }

    // DELETE /student/mentorship/requests/{mentorshipRequest}
    public function cancel(MentorshipRequest $mentorshipRequest)
    {
        abort_unless($mentorshipRequest->student_id === Auth::id(), 403);

        abort_unless(
            in_array($mentorshipRequest->status, ['pending', 'time_suggested']),
            422,
            'This request can no longer be cancelled.'
        );

        $mentorshipRequest->update(['status' => 'cancelled']);

        return back()->with('success', 'Mentorship request cancelled.');
    }
}

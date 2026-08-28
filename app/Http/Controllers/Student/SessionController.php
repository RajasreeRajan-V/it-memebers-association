<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\MentorshipFeedback;
use App\Models\MentorshipSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    /**
     * Upcoming Sessions
     */
    public function upcoming()
    {
        $student = Auth::user();

        $sessions = MentorshipSession::with('mentor')
            ->where('student_id', $student->id)
            ->whereIn('status', ['scheduled', 'confirmed'])
            ->orderBy('starts_at', 'asc')
            ->get();

        $totalUpcoming = $sessions->count();

        $confirmedCount = $sessions
            ->where('status', 'confirmed')
            ->count();

        $scheduledCount = $sessions
            ->where('status', 'scheduled')
            ->count();

        return view('students.mentorship.sessions.upcoming', [
            'sessions'       => $sessions,
            'totalUpcoming'  => $totalUpcoming,
            'confirmedCount' => $confirmedCount,
            'scheduledCount' => $scheduledCount,
        ]);
    }
/**
 * Completed Sessions
 */
public function completed(Request $request)
{
    $studentId = Auth::id();

    $sessions = MentorshipSession::with([
        'mentor',
        'mentorship',
        'feedback',
    ])
        ->where('student_id', $studentId)
        ->where('status', 'completed')
        ->latest('starts_at')
        ->paginate(10);

    // Total completed sessions
    $totalSessions = MentorshipSession::where('student_id', $studentId)
        ->where('status', 'completed')
        ->count();

    // Total sessions that received feedback
    $ratedSessions = MentorshipFeedback::whereHas(
        'session',
        function ($query) use ($studentId) {
            $query->where('student_id', $studentId)
                  ->where('status', 'completed');
        }
    )->count();

    // Average rating for completed sessions
    $averageRating = MentorshipFeedback::whereHas(
        'session',
        function ($query) use ($studentId) {
            $query->where('student_id', $studentId)
                  ->where('status', 'completed');
        }
    )->avg('rating');

    return view(
        'students.mentorship.sessions.completed',
        compact(
            'sessions',
            'totalSessions',
            'ratedSessions',
            'averageRating'
        )
    );
}

    /**
     * Show Session
     */
    public function show(MentorshipSession $session)
    {
        abort_unless(
            $session->student_id === Auth::id(),
            403
        );

        $session->load(
            'mentor',
            'mentorship',
            'feedback'
        );

        return view(
            'students.mentorship.sessions.show',
            compact('session')
        );
    }

    /**
     * Confirm Session
     */
    public function confirm(MentorshipSession $session)
    {
        abort_unless(
            $session->student_id === Auth::id(),
            403
        );

        abort_unless(
            $session->status === 'scheduled',
            422,
            'This session cannot be confirmed.'
        );

        $session->update([
            'status' => 'confirmed',
        ]);

        return back()->with(
            'success',
            'Session confirmed successfully.'
        );
    }

    /**
     * Submit / Update Feedback
     */
    public function storeFeedback(
        Request $request,
        MentorshipSession $session
    ) {
        abort_unless(
            $session->student_id === Auth::id(),
            403
        );

        abort_unless(
            $session->status === 'completed',
            422,
            'You can only review a completed session.'
        );

        $data = $request->validate([
            'rating' => [
                'required',
                'integer',
                'min:1',
                'max:5',
            ],

            'comment' => [
                'nullable',
                'string',
                'max:2000',
            ],
        ]);

        MentorshipFeedback::updateOrCreate(
            [
                'session_id' => $session->id,
                'student_id' => Auth::id(),
            ],
            [
                'mentorship_id' => $session->mentorship_id,
                'mentor_id' => $session->mentor_id,
                'rating' => $data['rating'],
                'comment' => $data['comment'] ?? null,
            ]
        );

        return back()->with(
            'success',
            'Thanks for your feedback!'
        );
    }
}
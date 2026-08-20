<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\MentorshipSession;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    // GET /sessions/upcoming
    public function upcoming()
    {
        $sessions = MentorshipSession::where('student_id', Auth::id())
            ->whereIn('status', ['scheduled', 'confirmed'])
            ->with('mentor', 'mentorship')
            ->orderBy('starts_at')
            ->get();

        return view('students.mentorship.sessions.upcoming', compact('sessions'));
    }

    // GET /sessions/completed
    public function completed()
    {
        $sessions = MentorshipSession::where('student_id', Auth::id())
            ->where('status', 'completed')
            ->with('mentor', 'mentorship')
            ->orderByDesc('starts_at')
            ->paginate(10);

        return view('students.mentorship.sessions.completed', compact('sessions'));
    }

    // POST /sessions/{session}/confirm — student confirms attendance
    public function confirm(MentorshipSession $session)
    {
        abort_unless($session->student_id === Auth::id(), 403);
        abort_unless($session->status === 'scheduled', 422, 'This session cannot be confirmed.');

        $session->update(['status' => 'confirmed']);

        return back()->with('success', 'Session confirmed.');
    }
}

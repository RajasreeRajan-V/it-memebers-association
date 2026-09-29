<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Mentorship;
use App\Models\MentorshipSession;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // GET /student/dashboard
    public function index()
    {
        $studentId = Auth::id();

        $activeMentorship = Mentorship::where('student_id', $studentId)
            ->where('status', 'active')
            ->with('mentor.mentorRegistration')
            ->latest()
            ->first();

        $stats = [
            'upcoming_sessions' => MentorshipSession::where('student_id', $studentId)
                ->whereIn('status', ['scheduled', 'confirmed'])->count(),
            'completed_sessions' => MentorshipSession::where('student_id', $studentId)
                ->where('status', 'completed')->count(),
            'active_mentors' => Mentorship::where('student_id', $studentId)
                ->where('status', 'active')->count(),
        ];

        $upcomingSession = $activeMentorship?->upcomingSession();

        $sessionHistory = $activeMentorship
            ? $activeMentorship->sessions()->orderByDesc('starts_at')->limit(5)->get()
            : collect();

        return view('students.dashboard', compact(
            'activeMentorship', 'stats', 'upcomingSession', 'sessionHistory'
        ));
    }
}

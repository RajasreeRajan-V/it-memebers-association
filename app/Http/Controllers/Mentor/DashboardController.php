<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\Mentorship;
use App\Models\MentorshipRequest;
use App\Models\MentorshipSession;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // GET /mentor/dashboard
    public function index()
    {
        $mentorId = Auth::id();

        $stats = [
            'active_mentees'    => Mentorship::where('mentor_id', $mentorId)->where('status', 'active')->count(),
            'upcoming_sessions' => MentorshipSession::where('mentor_id', $mentorId)->whereIn('status', ['scheduled', 'confirmed'])->count(),
            'completed_sessions'=> MentorshipSession::where('mentor_id', $mentorId)->where('status', 'completed')->count(),
        ];

        $pendingRequests = MentorshipRequest::where('mentor_id', $mentorId)
            ->where('status', 'pending')
            ->with('student')
            ->latest()
            ->limit(5)
            ->get();

        $activeMentees = Mentorship::where('mentor_id', $mentorId)
            ->where('status', 'active')
            ->with(['student', 'sessions' => fn ($q) => $q->orderByDesc('starts_at')->limit(1)])
            ->limit(6)
            ->get();

        return view('mentor.dashboard', compact('stats', 'pendingRequests', 'activeMentees'));
    }
}

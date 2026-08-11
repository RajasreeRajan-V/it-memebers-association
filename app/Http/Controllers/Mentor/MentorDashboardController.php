<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MentorMentee;
use App\Models\ResumeReview;
use App\Models\Webinar;
use App\Models\MockInterview;

class MentorDashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'mentor') {
            abort(403, 'Unauthorized');
        }

        $mentorId = Auth::id();

        return view('mentor.dashboard', [
            'menteeCount'          => MentorMentee::where('mentor_id', $mentorId)->count(),
            'pendingReviews'       => ResumeReview::where('mentor_id', $mentorId)->where('status', 'pending')->count(),
            'upcomingWebinars'     => Webinar::where('mentor_id', $mentorId)->where('scheduled_date', '>=', now()->toDateString())->count(),
            'scheduledInterviews'  => MockInterview::where('mentor_id', $mentorId)->where('status', 'scheduled')->count(),

            'recentMentees'        => MentorMentee::with('student')
                                            ->where('mentor_id', $mentorId)
                                            ->latest('assigned_at')
                                            ->take(5)
                                            ->get(),

            'recentResumeReviews'  => ResumeReview::with('student')
                                            ->where('mentor_id', $mentorId)
                                            ->where('status', 'pending')
                                            ->latest('created_at')
                                            ->take(5)
                                            ->get(),

            'upcomingWebinarsList' => Webinar::where('mentor_id', $mentorId)
                                            ->where('scheduled_date', '>=', now()->toDateString())
                                            ->orderBy('scheduled_date')
                                            ->take(5)
                                            ->get(),

            'recentInterviews'     => MockInterview::with('student')
                                            ->where('mentor_id', $mentorId)
                                            ->latest('scheduled_at')
                                            ->take(5)
                                            ->get(),
        ]);
    }
}
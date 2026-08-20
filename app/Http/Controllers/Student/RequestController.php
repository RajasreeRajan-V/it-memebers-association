<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\MentorshipRequest;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    // GET /requests — "My Mentorship" overview (active mentor + request history)
    public function index()
    {
        $activeMentorship = Auth::user()->mentorshipsAsStudent()
            ->with(['mentor', 'sessions' => fn ($q) => $q->orderByDesc('starts_at')])
            ->where('status', 'active')
            ->latest()
            ->first();

        $requests = MentorshipRequest::where('student_id', Auth::id())
            ->with('mentor')
            ->latest()
            ->get();

        return view('students.mentorship.index', compact('activeMentorship', 'requests'));
    }

    // GET /requests/pending
    public function pending()
    {
        $requests = MentorshipRequest::where('student_id', Auth::id())
            ->where('status', 'pending')
            ->with('mentor')
            ->latest()
            ->get();

        return view('students.mentorship.pending', compact('requests'));
    }

    // GET /requests/accepted
    public function accepted()
    {
        $requests = MentorshipRequest::where('student_id', Auth::id())
            ->whereIn('status', ['accepted', 'admin_verification'])
            ->with('mentor')
            ->latest()
            ->get();

        return view('students.mentorship.accepted', compact('requests'));
    }

    // DELETE /requests/{request}
    public function cancel(MentorshipRequest $request)
    {
        abort_unless($request->student_id === Auth::id(), 403);

        // Only requests still in the "not yet active" stage can be cancelled by the student.
        abort_unless(in_array($request->status, ['pending', 'accepted', 'admin_verification']), 422,
            'This request can no longer be cancelled.');

        $request->update(['status' => 'cancelled']);

        return back()->with('success', 'Mentorship request cancelled.');
    }
}

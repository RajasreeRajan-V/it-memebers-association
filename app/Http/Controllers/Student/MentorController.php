<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\MentorshipRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MentorController extends Controller
{
    // GET /student/mentors — "Select Mentor / Mentorship"
    public function index(Request $request)
    {
        $mentors = User::query()
            ->where('role', 'mentor')
            ->where('verification_status', 'approved')
            ->whereHas('mentorRegistration')
            ->with('mentorRegistration')
            ->withCount([
                'mentorshipsAsMentor as active_mentees_count' => function ($q) {
                    $q->where('status', 'active');
                },
            ])
            ->when($request->filled('skill'), function ($q) use ($request) {
                $q->whereHas('mentorRegistration', function ($query) use ($request) {
                    $query->where('expertise', 'like', '%' . $request->skill . '%');
                });
            })
            ->latest('id')
            ->paginate(3)
            ->withQueryString();

        return view('students.mentors.index', compact('mentors'));
    }

    // GET /student/mentors/{mentor} — View Mentor Profile
    public function show(User $mentor)
    {
        abort_unless(
            $mentor->role === 'mentor' && $mentor->verification_status === 'approved',
            404
        );

        $mentor->load('mentorRegistration');

        $mentor->loadCount([
            'mentorshipsAsMentor as active_mentees_count' => function ($q) {
                $q->where('status', 'active');
            },
        ]);

        $existingRequest = MentorshipRequest::where('student_id', Auth::id())
            ->where('mentor_id', $mentor->id)
            ->whereIn('status', ['pending', 'accepted', 'time_suggested'])
            ->latest()
            ->first();

        $activeMentorship = \App\Models\Mentorship::where('student_id', Auth::id())
            ->where('mentor_id', $mentor->id)
            ->where('status', 'active')
            ->first();

        return view('students.mentors.show', compact('mentor', 'existingRequest', 'activeMentorship'));
    }

    // GET /student/mentors/{mentor}/request — "Submit Mentorship Request" form
    public function requestForm(User $mentor)
    {
        abort_unless(
            $mentor->role === 'mentor' && $mentor->verification_status === 'approved',
            404
        );

        $mentor->load('mentorRegistration');

        return view('students.mentors.request', compact('mentor'));
    }

    // POST /student/mentors/{mentor}/request
    public function storeRequest(Request $request, User $mentor)
    {
        abort_unless(
            $mentor->role === 'mentor' && $mentor->verification_status === 'approved',
            404
        );

        $duplicate = MentorshipRequest::where('student_id', Auth::id())
            ->where('mentor_id', $mentor->id)
            ->whereIn('status', ['pending', 'accepted', 'time_suggested'])
            ->exists();

        if ($duplicate) {
            return back()->withErrors([
                'mentor' => 'You already have an active or pending request with this mentor.',
            ])->withInput();
        }

        $data = $request->validate([
            'goal'             => ['required', 'string', 'max:1000'],
            'current_skills'   => ['nullable', 'string', 'max:255'],
            'career_goal'      => ['required', 'string', 'max:255'],
            'frequency'        => ['required', 'in:weekly,biweekly,monthly'],
            'preferred_days'   => ['nullable', 'array'],
            'preferred_days.*' => ['string'],
            'preferred_time'   => ['nullable', 'string', 'max:100'],
            'message'          => ['nullable', 'string', 'max:2000'],
        ]);

        MentorshipRequest::create([
            'student_id' => Auth::id(),
            'mentor_id'  => $mentor->id,
            'status'     => 'pending',
            ...$data,
        ]);

        return redirect()
            ->route('student.mentorship.index')
            ->with('success', 'Mentorship request sent to ' . $mentor->name . '.');
    }
}

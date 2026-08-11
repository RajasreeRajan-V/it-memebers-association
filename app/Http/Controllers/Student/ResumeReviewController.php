<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ResumeReview;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ResumeReviewController extends Controller
{
    // Landing screen: mentor picker, "How It Works", and "My Requests" — links out to the create form
    public function index()
    {
        // Featured mentors shown on the landing screen (adjust the role check to match your User model)
        $mentors = User::where('role', 'mentor')
            ->take(4)
            ->get();

        $requestsBase = ResumeReview::with('mentor')->where('student_id', Auth::id());

        $myRequests = (clone $requestsBase)->latest()->paginate(6)->withQueryString();

        $requestCounts = [
            'total' => (clone $requestsBase)->count(),
            'pending' => (clone $requestsBase)->whereIn('status', ['pending', 'assigned'])->count(),
            'in_review' => (clone $requestsBase)->where('status', 'in_review')->count(),
            'completed' => (clone $requestsBase)->where('status', 'completed')->count(),
        ];

        return view('students.resume.index', compact('mentors', 'myRequests', 'requestCounts'));
    }

    // "Get Expert Feedback" form: upload resume + pick a mentor + request details
    public function create()
    {
        $mentors = User::where('role', 'mentor')->get();

        return view('students.resume.create', compact('mentors'));
    }

    // Submit a new resume review request
    public function store(Request $request)
    {
        $data = $request->validate([
            'resume' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:5120'], // 5MB
            'review_type' => ['required', 'string', 'max:255'],
            'goal' => ['nullable', 'string'],
            'feedback_focus' => ['nullable', 'array'],
            'feedback_focus.*' => ['string'],
            'preferred_completion_time' => ['nullable', 'string', 'max:255'],
            'additional_instructions' => ['nullable', 'string'],
            'mentor_id' => ['nullable', 'exists:users,id'],
        ]);

        $path = $request->file('resume')->store('resumes/' . Auth::id(), 'public');

        ResumeReview::create([
            'student_id' => Auth::id(),
            'mentor_id' => $data['mentor_id'] ?? null,
            'resume_path' => $path,
            'resume_original_name' => $request->file('resume')->getClientOriginalName(),
            'review_type' => $data['review_type'],
            'goal' => $data['goal'] ?? null,
            'feedback_focus' => $data['feedback_focus'] ?? [],
            'preferred_completion_time' => $data['preferred_completion_time'] ?? null,
            'additional_instructions' => $data['additional_instructions'] ?? null,
            'status' => !empty($data['mentor_id']) ? 'assigned' : 'pending',
        ]);

        return redirect()->route('student.resume-review')
            ->with('success', 'Your resume review request has been submitted.');
    }

    // Direct links to a single request now just land on the index page,
    // where that request's details open in a modal.
    public function show(ResumeReview $review)
    {
        abort_unless($review->student_id === Auth::id(), 403);

        return redirect()->route('student.resume-review');
    }
}
<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\MockInterview;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MockInterviewController extends Controller
{
    /**
     * List the logged-in student's mock interview requests/sessions.
     */
    public function index()
    {
        $interviews = MockInterview::forStudent(Auth::id())
            ->with('mentor')
            ->latest()
            ->paginate(10);

        return view('students.mock-interviews.index', compact('interviews'));
    }

    /**
     * Show the form to request a mock interview with a mentor.
     */
    public function create(Request $request)
    {
        $mentors = User::where('role', 'mentor')->orderBy('name')->get();
        $selectedMentorId = $request->query('mentor_id');

        return view('students.mock-interviews.create', compact('mentors', 'selectedMentorId'));
    }

    /**
     * Store a new mock interview request. Status starts as 'pending'
     * until the mentor schedules it.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'mentor_id'     => ['required', 'exists:users,id'],
            'topic'         => ['required', 'string', 'max:150'],
            'student_notes' => ['nullable', 'string', 'max:2000'],
            'requested_at'  => ['required', 'date', 'after:now'],
        ]);

        MockInterview::create([
            'student_id'    => Auth::id(),
            'mentor_id'     => $validated['mentor_id'],
            'topic'         => $validated['topic'],
            'student_notes' => $validated['student_notes'] ?? null,
            'requested_at'  => $validated['requested_at'],
            'status'        => 'pending',
        ]);

        return redirect()
            ->route('student.mock-interviews.index')
            ->with('success', 'Mock interview request sent to the mentor.');
    }

    /**
     * Show a single mock interview: schedule details, and feedback form
     * once it's completed.
     */
    public function show(MockInterview $mockInterview)
    {
        abort_unless($mockInterview->student_id === Auth::id(), 403);

        $mockInterview->load('mentor');

        return view('students.mock-interviews.show', compact('mockInterview'));
    }

    /**
     * Student cancels a pending or scheduled request.
     */
    public function cancel(MockInterview $mockInterview)
    {
        abort_unless($mockInterview->student_id === Auth::id(), 403);
        abort_if($mockInterview->status === 'completed', 422, 'Completed interviews cannot be cancelled.');

        $mockInterview->update(['status' => 'cancelled']);

        return back()->with('success', 'Mock interview cancelled.');
    }

    /**
     * Student leaves feedback/rating for the mentor after completion.
     */
    public function storeFeedback(Request $request, MockInterview $mockInterview)
    {
        abort_unless($mockInterview->student_id === Auth::id(), 403);
        abort_unless($mockInterview->status === 'completed', 422, 'You can only give feedback after the interview is completed.');

        $validated = $request->validate([
            'student_feedback' => ['required', 'string', 'max:2000'],
            'student_rating'   => ['required', 'integer', 'min:1', 'max:5'],
        ]);

        $mockInterview->update($validated);

        return back()->with('success', 'Thanks! Your feedback has been submitted.');
    }
}

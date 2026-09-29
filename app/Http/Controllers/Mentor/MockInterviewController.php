<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\MockInterview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MockInterviewController extends Controller
{
    /**
     * List mock interview requests / sessions for the logged-in mentor.
     * Optional ?status= filter (pending, scheduled, completed, cancelled).
     */
    public function index(Request $request)
    {
        $query = MockInterview::forMentor(Auth::id())->with('student')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->query('status'));
        }

        $interviews = $query->paginate(10)->withQueryString();

        return view('mentor.mock-interviews.index', compact('interviews'));
    }

    /**
     * Show a single request so the mentor can review details,
     * schedule it, or leave feedback once completed.
     */
    public function show(MockInterview $mockInterview)
    {
        abort_unless($mockInterview->mentor_id === Auth::id(), 403);

        $mockInterview->load('student');

        return view('mentor.mock-interviews.show', compact('mockInterview'));
    }

    /**
     * Mentor confirms date/time + meeting link. This is what "Admin
     * Verifies Slot Availability" precedes in the flow — the mentor
     * submits the slot, admin (or a scheduling service) can validate
     * it before it flips to 'scheduled'. Here we schedule directly;
     * swap in an approval step if slot verification is required first.
     */
    public function schedule(Request $request, MockInterview $mockInterview)
    {
        abort_unless($mockInterview->mentor_id === Auth::id(), 403);
        abort_unless($mockInterview->status === 'pending', 422, 'Only pending requests can be scheduled.');

        $validated = $request->validate([
            'scheduled_at' => ['required', 'date', 'after:now'],
            'meeting_link' => ['required', 'url', 'max:255'],
        ]);

        $mockInterview->update([
            'scheduled_at' => $validated['scheduled_at'],
            'meeting_link' => $validated['meeting_link'],
            'status'       => 'scheduled',
        ]);

        return redirect()
            ->route('mentor.mock-interviews.show', $mockInterview)
            ->with('success', 'Mock interview scheduled and confirmed with the student.');
    }

    /**
     * Mentor marks an interview as completed once it has taken place,
     * unlocking the feedback form for both sides.
     */
    public function complete(MockInterview $mockInterview)
    {
        abort_unless($mockInterview->mentor_id === Auth::id(), 403);
        abort_unless($mockInterview->status === 'scheduled', 422, 'Only scheduled interviews can be marked complete.');

        $mockInterview->update(['status' => 'completed']);

        return back()->with('success', 'Marked as completed. You can now leave feedback.');
    }

    /**
     * Mentor cancels a pending or scheduled request.
     */
    public function cancel(MockInterview $mockInterview)
    {
        abort_unless($mockInterview->mentor_id === Auth::id(), 403);
        abort_if($mockInterview->status === 'completed', 422, 'Completed interviews cannot be cancelled.');

        $mockInterview->update(['status' => 'cancelled']);

        return back()->with('success', 'Mock interview cancelled.');
    }

    /**
     * Mentor leaves feedback/rating for the student after completion.
     */
    public function storeFeedback(Request $request, MockInterview $mockInterview)
    {
        abort_unless($mockInterview->mentor_id === Auth::id(), 403);
        abort_unless($mockInterview->status === 'completed', 422, 'You can only give feedback after the interview is completed.');

        $validated = $request->validate([
            'mentor_feedback' => ['required', 'string', 'max:2000'],
            'mentor_rating'   => ['required', 'integer', 'min:1', 'max:5'],
        ]);

        $mockInterview->update($validated);

        return back()->with('success', 'Feedback submitted for the student.');
    }
}

<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\MockInterview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MockInterviewController extends Controller
{
    // View interviews assigned by admin to the logged-in mentor
    public function index()
    {
        $interviews = MockInterview::with('student')
            ->where('mentor_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('mentor.mock-interviews.index', compact('interviews'));
    }

    public function show(MockInterview $interview)
    {
        $this->authorizeInterview($interview);

        return view('mentor.mock-interviews.show', compact('interview'));
    }

    // Schedule the assigned interview
    public function schedule(Request $request, MockInterview $interview)
    {
        $this->authorizeInterview($interview);

        $data = $request->validate([
            'scheduled_at' => ['required', 'date'],
            'mode' => ['required', 'in:online,offline'],
            'meeting_link' => ['nullable', 'string', 'max:255'],
        ]);

        $interview->update([
            'scheduled_at' => $data['scheduled_at'],
            'mode' => $data['mode'],
            'meeting_link' => $data['meeting_link'] ?? null,
            'status' => 'scheduled',
        ]);

        return back()->with('success', 'Interview scheduled.');
    }

    // Mark as conducted
    public function conduct(MockInterview $interview)
    {
        $this->authorizeInterview($interview);

        $interview->update([
            'status' => 'conducted',
            'conducted_at' => now(),
        ]);

        return back()->with('success', 'Interview marked as conducted.');
    }

    // Fill evaluation form + submit feedback
    public function submitFeedback(Request $request, MockInterview $interview)
    {
        $this->authorizeInterview($interview);

        $data = $request->validate([
            'technical_rating' => ['required', 'integer', 'min:1', 'max:10'],
            'communication_rating' => ['required', 'integer', 'min:1', 'max:10'],
            'confidence_rating' => ['required', 'integer', 'min:1', 'max:10'],
            'overall_rating' => ['required', 'integer', 'min:1', 'max:10'],
            'feedback' => ['required', 'string'],
        ]);

        $interview->update(array_merge($data, [
            'status' => 'conducted',
            'conducted_at' => $interview->conducted_at ?? now(),
        ]));

        return redirect()->route('mentor.mock-interviews.index')
            ->with('success', 'Evaluation submitted.');
    }

    private function authorizeInterview(MockInterview $interview): void
    {
        abort_unless($interview->mentor_id === Auth::id(), 403);
    }
}

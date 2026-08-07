<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\ResumeReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResumeReviewController extends Controller
{
    // List resumes assigned to the logged-in mentor
    public function index()
    {
        $reviews = ResumeReview::with('student')
            ->where('mentor_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('mentor.resume-reviews.index', compact('reviews'));
    }

    // Open a resume for review
    public function show(ResumeReview $review)
    {
        $this->authorizeReview($review);

        if ($review->status === 'assigned') {
            $review->update(['status' => 'in_review']);
        }

        return view('mentor.resume-reviews.show', compact('review'));
    }

    // Add comments, ATS score, and submit review
    public function submit(Request $request, ResumeReview $review)
    {
        $this->authorizeReview($review);

        $data = $request->validate([
            'ats_score' => ['required', 'integer', 'min:0', 'max:100'],
            'comments' => ['required', 'string'],
        ]);

        $review->update([
            'ats_score' => $data['ats_score'],
            'comments' => $data['comments'],
            'status' => 'completed',
            'reviewed_at' => now(),
        ]);

        return redirect()->route('mentor.resume-reviews.index')
            ->with('success', 'Resume review submitted.');
    }

    private function authorizeReview(ResumeReview $review): void
    {
        abort_unless($review->mentor_id === Auth::id(), 403);
    }
}

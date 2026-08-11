<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\AdminConfirmation;
use App\Models\ResumeReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResumeReviewController extends Controller
{
    // Landing screen: list only, nothing selected yet
    public function index(Request $request)
    {
        return $this->renderBoard($request);
    }

    // Open a resume for review (auto-moves it from "assigned"/"pending" to "in_review"),
    // rendered on the SAME combined board as index() with this review pre-selected.
    public function show(Request $request, ResumeReview $review)
    {
        $this->authorizeReview($review);

        if (in_array($review->status, ['assigned', 'pending'])) {
            $review->update(['status' => 'in_review']);
        }

        return $this->renderBoard($request, $review);
    }

    // Save the mentor's ratings and written feedback. Drafts save immediately; a final
    // submission is sent to the admin queue and only becomes visible to the student once approved.
    public function submit(Request $request, ResumeReview $review)
    {
        $this->authorizeReview($review);

        $isDraft = $request->boolean('save_as_draft');

        if (! $isDraft && $review->hasPendingAdminConfirmation()) {
            return redirect()
                ->route('mentor.resume-reviews.show', ['review' => $review, 'tab' => $request->query('tab', 'pending'), 'q' => $request->query('q')])
                ->with('success', 'This review is already awaiting admin confirmation.');
        }

        // Drafts don't need every field filled in yet; final submission does.
        $rules = [
            'overall_rating' => [$isDraft ? 'nullable' : 'required', 'integer', 'min:1', 'max:5'],
            'resume_quality' => [$isDraft ? 'nullable' : 'required', 'integer', 'min:1', 'max:5'],
            'relevance' => [$isDraft ? 'nullable' : 'required', 'integer', 'min:1', 'max:5'],
            'presentation' => [$isDraft ? 'nullable' : 'required', 'integer', 'min:1', 'max:5'],
            'strengths' => [$isDraft ? 'nullable' : 'required', 'string'],
            'areas_to_improve' => [$isDraft ? 'nullable' : 'required', 'string'],
            'additional_comments' => ['nullable', 'string'],
        ];

        $data = $request->validate($rules);

        // The ratings/feedback are saved either way — only the "completed" flip is gated.
        $review->update([
            'overall_rating' => $data['overall_rating'] ?? null,
            'resume_quality' => $data['resume_quality'] ?? null,
            'relevance' => $data['relevance'] ?? null,
            'presentation' => $data['presentation'] ?? null,
            'strengths' => $data['strengths'] ?? null,
            'areas_to_improve' => $data['areas_to_improve'] ?? null,
            'additional_comments' => $data['additional_comments'] ?? null,
            // status stays 'in_review' for both draft and final submit — admin approval is what
            // flips it to 'completed' and makes it visible to the student.
        ]);

        $message = 'Draft saved.';

        if (! $isDraft) {
            AdminConfirmation::create([
                'confirmable_type' => ResumeReview::class,
                'confirmable_id' => $review->id,
                'action' => 'resume_review',
                'requested_by' => Auth::id(),
                'status' => 'pending',
            ]);

            $message = 'Review submitted — sent to admin for confirmation before the student sees it.';
        }

        return redirect()
            ->route('mentor.resume-reviews.show', [
                'review' => $review,
                'tab' => $request->query('tab', 'pending'),
                'q' => $request->query('q'),
            ])
            ->with('success', $message);
    }

    /**
     * Build everything the combined board (list + resume + feedback + student panel) needs.
     */
    private function renderBoard(Request $request, ?ResumeReview $selected = null)
    {
        $mentorId = Auth::id();
        $tab = $request->query('tab', 'pending'); // pending | in_progress | reviewed | all
        $search = $request->query('q');

        $base = ResumeReview::with('student')->where('mentor_id', $mentorId);

        if ($search) {
            $base->whereHas('student', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        $reviews = match ($tab) {
            'in_progress' => (clone $base)->inProgress(),
            'reviewed' => (clone $base)->reviewed(),
            'all' => clone $base,
            default => (clone $base)->pending(),
        };

        // CHANGED: pagination from 10 to 3 items per page
        $reviews = $reviews->latest()->paginate(3)->withQueryString();

        $counts = [
            'pending' => (clone $base)->pending()->count(),
            'in_progress' => (clone $base)->inProgress()->count(),
            'reviewed' => (clone $base)->reviewed()->count(),
            'all' => (clone $base)->count(),
        ];

        // Past reviews this mentor completed for the same student (for the "Review History" panel)
        $reviewHistory = collect();
        if ($selected) {
            $reviewHistory = ResumeReview::where('student_id', $selected->student_id)
                ->where('mentor_id', $mentorId)
                ->where('id', '!=', $selected->id)
                ->where('status', 'completed')
                ->latest('reviewed_at')
                ->take(5)
                ->get();
        }

        return view('mentor.resume-reviews.index', [
            'reviews' => $reviews,
            'counts' => $counts,
            'tab' => $tab,
            'search' => $search,
            'selected' => $selected,
            'reviewHistory' => $reviewHistory,
        ]);
    }

    private function authorizeReview(ResumeReview $review): void
    {
        abort_unless($review->mentor_id === Auth::id(), 403);
    }
}
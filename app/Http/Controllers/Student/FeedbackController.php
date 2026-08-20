<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Mentorship;
use App\Models\MentorshipFeedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FeedbackController extends Controller
{
    // GET /student/mentorship/{mentorship}/feedback
    public function create(Mentorship $mentorship)
    {
        abort_unless($mentorship->student_id === Auth::id(), 403);
        abort_unless($mentorship->status === 'completed', 422, 'Mentorship is not completed yet.');
        abort_if($mentorship->feedback()->exists(), 422, 'You already submitted feedback.');

        return view('students.mentorship.feedback', compact('mentorship'));
    }

    // POST /student/mentorship/{mentorship}/feedback
    public function store(Request $request, Mentorship $mentorship)
    {
        abort_unless($mentorship->student_id === Auth::id(), 403);
        abort_unless($mentorship->status === 'completed', 422, 'Mentorship is not completed yet.');
        abort_if($mentorship->feedback()->exists(), 422, 'You already submitted feedback.');

        $data = $request->validate([
            'rating'  => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string', 'max:2000'],
        ]);

        DB::transaction(function () use ($mentorship, $data) {
            MentorshipFeedback::create([
                'mentorship_id' => $mentorship->id,
                'student_id'    => $mentorship->student_id,
                'mentor_id'     => $mentorship->mentor_id,
                'rating'        => $data['rating'],
                'comment'       => $data['comment'] ?? null,
            ]);

            // Recalculate the mentor's overall average rating.
            $mentor = $mentorship->mentor;
            $avg = MentorshipFeedback::where('mentor_id', $mentor->id)->avg('rating');
            $mentor->update(['rating' => round($avg, 1)]);
        });

        return redirect()
            ->route('student.requests.index')
            ->with('success', 'Thanks for your feedback!');
    }
}

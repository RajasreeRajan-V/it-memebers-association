<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Enrollment;
use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TrainingController extends Controller
{
    /**
     * Browse all published trainings (the student catalogue).
     */
    public function index(Request $request)
    {
        $query = Training::published()->with('mentor');

        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('technology', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        if ($category = $request->query('category')) {
            $query->where('category', $category);
        }

        if ($level = $request->query('level')) {
            $query->where('level', $level);
        }

        $trainings = $query->latest('published_at')->paginate(12)->withQueryString();

        return view('students.trainings.index', compact('trainings'));
    }

    /**
     * View a single published training's details.
     */
    public function show(Training $training)
    {
        abort_unless($training->status === Training::STATUS_PUBLISHED, 404);

        $training->load(['mentor', 'outcomes', 'requirements', 'modules.sessions', 'resources']);

        $enrollment = Enrollment::where('training_id', $training->id)
            ->where('student_id', Auth::id())
            ->first();

        return view('students.trainings.show', compact('training', 'enrollment'));
    }

    /**
     * Enroll / register the logged-in student into a published training.
     */
    public function enroll(Training $training)
    {
        abort_unless($training->status === Training::STATUS_PUBLISHED, 404);

        if ($training->isFull()) {
            return back()->with('error', 'This training has reached its maximum number of participants.');
        }

        $enrollment = Enrollment::firstOrCreate(
            [
                'training_id' => $training->id,
                'student_id'  => Auth::id(),
            ],
            [
                'status'      => Enrollment::STATUS_ENROLLED,
                'progress'    => 0,
                'enrolled_at' => now(),
            ]
        );

        return redirect()
            ->route('student.trainings.my-trainings')
            ->with('success', 'You have been enrolled in "' . $training->title . '".');
    }

    /**
     * List trainings the student is enrolled in.
     */
    public function myTrainings()
    {
        $enrollments = Enrollment::with(['training.mentor', 'certificate'])
            ->where('student_id', Auth::id())
            ->latest('enrolled_at')
            ->paginate(3);

        return view('students.trainings.my-trainings', compact('enrollments'));
    }

    /**
     * Attend / learn view for an enrolled training (curriculum player).
     */
    public function learn(Training $training)
    {
        $enrollment = Enrollment::where('training_id', $training->id)
            ->where('student_id', Auth::id())
            ->firstOrFail();

        $training->load(['modules.sessions', 'resources']);

        if ($enrollment->status === Enrollment::STATUS_ENROLLED) {
            $enrollment->update(['status' => Enrollment::STATUS_IN_PROGRESS]);
        }

        return view('students.trainings.learn', compact('training', 'enrollment'));
    }

    /**
     * Update learning progress (e.g. called via AJAX as sessions are completed).
     */
    public function updateProgress(Request $request, Training $training)
    {
        $request->validate(['progress' => 'required|integer|min:0|max:100']);

        $enrollment = Enrollment::where('training_id', $training->id)
            ->where('student_id', Auth::id())
            ->firstOrFail();

        $enrollment->update(['progress' => $request->progress]);

        return response()->json(['success' => true, 'progress' => $enrollment->progress]);
    }

    /**
     * Mark a training as complete and issue a certificate if enabled.
     */
    public function complete(Training $training)
    {
        $enrollment = Enrollment::where('training_id', $training->id)
            ->where('student_id', Auth::id())
            ->firstOrFail();

        $enrollment->update([
            'status'       => Enrollment::STATUS_COMPLETED,
            'progress'     => 100,
            'completed_at' => now(),
        ]);

        if ($training->certificate_enabled) {
            Certificate::firstOrCreate(
                ['enrollment_id' => $enrollment->id],
                [
                    'certificate_number' => 'CERT-' . strtoupper(Str::random(10)),
                    'issued_at'          => now(),
                ]
            );
        }

        return redirect()
            ->route('student.trainings.my-trainings')
            ->with('success', 'Congratulations! Training marked as completed.');
    }

    /**
     * View / download the certificate for a completed training.
     */
    public function certificate(Training $training)
    {
        $enrollment = Enrollment::where('training_id', $training->id)
            ->where('student_id', Auth::id())
            ->where('status', Enrollment::STATUS_COMPLETED)
            ->firstOrFail();

        $certificate = $enrollment->certificate()->firstOrFail();

        return view('students.trainings.certificate', compact('training', 'certificate'));
    }
}

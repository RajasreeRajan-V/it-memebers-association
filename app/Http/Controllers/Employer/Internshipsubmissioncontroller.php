<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Internship;
use App\Models\InternshipTask;
use App\Models\InternshipTaskSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InternshipSubmissionController extends Controller
{
    /**
     * List every student's submission for one task.
     */
    public function index(Internship $internship, InternshipTask $task)
    {
        $this->authorizeTaskOwner($internship, $task);

        $submissions = $task->submissions()
            ->with('student')
            ->latest('submitted_at')
            ->get();

        $module = $task->module;

        return view(
            'employers.internship-submissions.index',
            compact('internship', 'module', 'task', 'submissions')
        );
    }

    /**
     * Approve or request changes on a submission.
     */
    public function review(Request $request, InternshipTaskSubmission $submission)
    {
        $task = $submission->task;
        $internship = $task->module->internship;

        $this->authorizeTaskOwner($internship, $task);

        $validated = $request->validate([
            'action' => ['required', 'in:complete,request_changes'],
            'feedback' => ['nullable', 'string', 'max:2000'],
        ]);

        if ($validated['action'] === 'complete') {

            $submission->update([
                'status' => InternshipTaskSubmission::STATUS_COMPLETED,
                'employer_feedback' => $validated['feedback'] ?? null,
                'reviewed_at' => now(),
            ]);

            return back()->with('success', 'Submission marked as completed.');
        }

        $submission->update([
            'status' => InternshipTaskSubmission::STATUS_CHANGES_REQUESTED,
            'employer_feedback' => $validated['feedback'] ?? 'Please review and resubmit.',
            'reviewed_at' => now(),
        ]);

        return back()->with('success', 'Changes requested from the student.');
    }

    private function authorizeTaskOwner(Internship $internship, InternshipTask $task): void
    {
        abort_if(
            (int) $internship->employer_id !== (int) Auth::id(),
            403,
            'You do not have access to this internship.'
        );

        abort_if(
            (int) $task->module->internship_id !== (int) $internship->id,
            404
        );
    }
}
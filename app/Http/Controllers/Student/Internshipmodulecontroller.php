<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Internship;
use App\Models\InternshipApplication;
use App\Models\InternshipModule;
use App\Models\InternshipTask;
use App\Models\InternshipTaskSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InternshipModuleController extends Controller
{
    /**
     * Module list + progress bar for a selected/completed internship.
     */
    public function index(Internship $internship)
    {
        $application = $this->authorizeAccess($internship);

        $modules = $internship->modules()
            ->withCount('tasks')
            ->get()
            ->map(function (InternshipModule $module) {

                $module->completed_tasks_count =
                    $module->completedTasksCountFor(Auth::id());

                return $module;
            });

        $totalTasks = $internship->totalTasksCount();
        $completedTasks = $internship->completedTasksCountFor(Auth::id());

        $progressPercent = $totalTasks > 0
            ? (int) round(($completedTasks / $totalTasks) * 100)
            : 0;

        $allCompleted = $totalTasks > 0 && $completedTasks === $totalTasks;

        return view(
            'students.internship-modules.index',
            compact(
                'internship',
                'application',
                'modules',
                'totalTasks',
                'completedTasks',
                'progressPercent',
                'allCompleted'
            )
        );
    }

    /**
     * One module's task list, with this student's status on each task.
     */
    public function show(Internship $internship, InternshipModule $module)
    {
        $this->authorizeAccess($internship);
        $this->authorizeModule($internship, $module);

        $tasks = $module->tasks->map(function (InternshipTask $task) {

            $task->my_submission = $task->submissionFor(Auth::id());

            return $task;
        });

        return view(
            'students.internship-modules.show',
            compact('internship', 'module', 'tasks')
        );
    }

    /**
     * One task's detail + submission form.
     */
    public function task(
        Internship $internship,
        InternshipModule $module,
        InternshipTask $task
    ) {
        $this->authorizeAccess($internship);
        $this->authorizeModule($internship, $module);
        $this->authorizeTask($module, $task);

        $submission = $task->submissionFor(Auth::id());

        return view(
            'students.internship-modules.task',
            compact('internship', 'module', 'task', 'submission')
        );
    }

    /**
     * Submit (or resubmit) work for a task.
     */
    public function submit(
        Request $request,
        Internship $internship,
        InternshipModule $module,
        InternshipTask $task
    ) {
        $this->authorizeAccess($internship);
        $this->authorizeModule($internship, $module);
        $this->authorizeTask($module, $task);

        $rules = [
            'submission_text' => ['nullable', 'string', 'max:3000'],
            'submission_text_comments' => ['nullable', 'string', 'max:3000'],
        ];

        if ($task->submission_type === InternshipTask::TYPE_GITHUB_LINK) {
            $rules['submission_url'] = ['required', 'url', 'max:500'];
        }

        if ($task->submission_type === InternshipTask::TYPE_FILE_UPLOAD) {
            $rules['submission_file'] = ['required', 'file', 'max:10240'];
        }

        if ($task->submission_type === InternshipTask::TYPE_TEXT) {
            $rules['submission_text'] = ['required', 'string', 'max:3000'];
        }

        $validated = $request->validate($rules);

        $filePath = null;

        if ($request->hasFile('submission_file')) {

            $filePath = $request->file('submission_file')->store(
                'internship-submissions',
                'public'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | For non-text task types the main answer lives in submission_url or
        | file_path, so "submission_text" is repurposed as the optional
        | comments field the student typed alongside their link/file.
        |--------------------------------------------------------------------------
        */

        $submissionText = $task->submission_type === InternshipTask::TYPE_TEXT
            ? ($validated['submission_text'] ?? null)
            : ($validated['submission_text_comments'] ?? null);

        InternshipTaskSubmission::updateOrCreate(
            [
                'task_id' => $task->id,
                'student_id' => Auth::id(),
            ],
            [
                'submission_text' => $submissionText,
                'submission_url' => $validated['submission_url'] ?? null,
                'file_path' => $filePath ?? optional($task->submissionFor(Auth::id()))->file_path,
                'status' => InternshipTaskSubmission::STATUS_SUBMITTED,
                'submitted_at' => now(),
            ]
        );

        return redirect()
            ->route('student.internships.modules.show', [$internship, $module])
            ->with('success', 'Task submitted for review.');
    }

    /**
     * A student may view/work on modules only once selected or completed.
     */
    private function authorizeAccess(Internship $internship): InternshipApplication
    {
        $application = InternshipApplication::where('internship_id', $internship->id)
            ->where('student_id', Auth::id())
            ->whereIn('status', [
                InternshipApplication::STATUS_SELECTED,
                InternshipApplication::STATUS_COMPLETED,
            ])
            ->first();

        abort_if(
            !$application,
            403,
            'You can access internship modules only after being selected.'
        );

        return $application;
    }

    private function authorizeModule(Internship $internship, InternshipModule $module): void
    {
        abort_if(
            (int) $module->internship_id !== (int) $internship->id,
            404
        );
    }

    private function authorizeTask(InternshipModule $module, InternshipTask $task): void
    {
        abort_if(
            (int) $task->module_id !== (int) $module->id,
            404
        );
    }
}
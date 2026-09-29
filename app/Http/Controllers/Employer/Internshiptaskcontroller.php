<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Internship;
use App\Models\InternshipModule;
use App\Models\InternshipTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InternshipTaskController extends Controller
{
    /**
     * List tasks for one module, with submission counts.
     */
    public function index(Internship $internship, InternshipModule $module)
    {
        $this->authorizeOwner($internship);
        $this->authorizeModule($internship, $module);

        $tasks = $module->tasks()
            ->withCount([
                'submissions',
                'submissions as completed_submissions_count' => function ($query) {
                    $query->where('status', 'completed');
                },
                'submissions as pending_submissions_count' => function ($query) {
                    $query->where('status', 'submitted');
                },
            ])
            ->get();

        return view(
            'employers.internship-modules.tasks',
            compact('internship', 'module', 'tasks')
        );
    }

    /**
     * Store a new task.
     */
    public function store(
        Request $request,
        Internship $internship,
        InternshipModule $module
    ) {
        $this->authorizeOwner($internship);
        $this->authorizeModule($internship, $module);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:3000'],
            'instructions' => ['nullable', 'string', 'max:3000'],
            'submission_type' => ['required', 'in:github_link,file_upload,text'],
        ]);

        $nextOrder = (int) $module->tasks()->max('sort_order') + 1;

        $module->tasks()->create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'instructions' => $validated['instructions'] ?? null,
            'submission_type' => $validated['submission_type'],
            'sort_order' => $nextOrder,
        ]);

        return back()->with('success', 'Task added successfully.');
    }

    /**
     * Update an existing task.
     */
    public function update(
        Request $request,
        Internship $internship,
        InternshipModule $module,
        InternshipTask $task
    ) {
        $this->authorizeOwner($internship);
        $this->authorizeModule($internship, $module);
        $this->authorizeTask($module, $task);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:3000'],
            'instructions' => ['nullable', 'string', 'max:3000'],
            'submission_type' => ['required', 'in:github_link,file_upload,text'],
        ]);

        $task->update($validated);

        return back()->with('success', 'Task updated successfully.');
    }

    /**
     * Delete a task (and its submissions via cascade).
     */
    public function destroy(
        Internship $internship,
        InternshipModule $module,
        InternshipTask $task
    ) {
        $this->authorizeOwner($internship);
        $this->authorizeModule($internship, $module);
        $this->authorizeTask($module, $task);

        $task->delete();

        return back()->with('success', 'Task deleted successfully.');
    }

    private function authorizeOwner(Internship $internship): void
    {
        abort_if(
            (int) $internship->employer_id !== (int) Auth::id(),
            403,
            'You do not have access to this internship.'
        );
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
<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Internship;
use App\Models\InternshipModule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InternshipModuleController extends Controller
{
    /**
     * List modules for one internship.
     */
    public function index(Internship $internship)
    {
        $this->authorizeOwner($internship);

        $modules = $internship->modules()
            ->withCount('tasks')
            ->get();

        return view(
            'employers.internship-modules.index',
            compact('internship', 'modules')
        );
    }

    /**
     * Store a new module.
     */
    public function store(Request $request, Internship $internship)
    {
        $this->authorizeOwner($internship);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'learning_outcomes' => ['nullable', 'string', 'max:3000'],
            'duration' => ['nullable', 'string', 'max:100'],
        ]);

        $nextOrder = (int) $internship->modules()->max('sort_order') + 1;

        $internship->modules()->create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'learning_outcomes' => $validated['learning_outcomes'] ?? null,
            'duration' => $validated['duration'] ?? null,
            'sort_order' => $nextOrder,
            'status' => 'active',
        ]);

        return back()->with('success', 'Module added successfully.');
    }

    /**
     * Update an existing module.
     */
    public function update(
        Request $request,
        Internship $internship,
        InternshipModule $module
    ) {
        $this->authorizeOwner($internship);
        $this->authorizeModule($internship, $module);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'learning_outcomes' => ['nullable', 'string', 'max:3000'],
            'duration' => ['nullable', 'string', 'max:100'],
        ]);

        $module->update($validated);

        return back()->with('success', 'Module updated successfully.');
    }

    /**
     * Delete a module (and its tasks/submissions via cascade).
     */
    public function destroy(Internship $internship, InternshipModule $module)
    {
        $this->authorizeOwner($internship);
        $this->authorizeModule($internship, $module);

        $module->delete();

        return back()->with('success', 'Module deleted successfully.');
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
}
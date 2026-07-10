<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::where('employer_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('employers.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('employers.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateProject($request);
        $validated['skills'] = $this->skillsToArray($request->input('skills'));
        $validated['employer_id'] = Auth::id();
        $validated['status'] = 'pending';

        Project::create($validated);

        return redirect()
            ->route('employer.projects.index')
            ->with('success', 'Project submitted successfully and is awaiting admin approval.');
    }

    public function edit(Project $project)
    {
        $this->authorizeOwner($project);

        return view('employers.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $this->authorizeOwner($project);

        $validated = $this->validateProject($request);
        $validated['skills'] = $this->skillsToArray($request->input('skills'));
        $validated['status'] = 'pending';
        $validated['rejection_reason'] = null;

        $project->update($validated);

        return redirect()
            ->route('employer.projects.index')
            ->with('success', 'Project updated successfully and is awaiting admin approval.');
    }

    public function destroy(Project $project)
    {
        $this->authorizeOwner($project);
        $project->delete();

        return redirect()
            ->route('employer.projects.index')
            ->with('success', 'Project deleted.');
    }

    private function validateProject(Request $request): array
    {
        return $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'description'  => ['required', 'string'],
            'project_type' => ['nullable', 'string', 'max:100'],
            'budget'       => ['required', 'string', 'max:100'],
            'duration'     => ['nullable', 'string', 'max:100'],
            'skills'       => ['nullable', 'string'],
            'deadline'     => ['nullable', 'date'],
        ]);
    }

    private function skillsToArray(?string $skills): array
    {
        if (!$skills) {
            return [];
        }

        return collect(explode(',', $skills))
            ->map(fn ($s) => trim($s))
            ->filter()
            ->values()
            ->all();
    }

    private function authorizeOwner(Project $project): void
    {
        abort_unless($project->employer_id === Auth::id(), 403);
    }
}

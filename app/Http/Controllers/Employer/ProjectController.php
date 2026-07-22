<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::where('employer_id', Auth::id())
            ->when($request->search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%");
            })
            ->when($request->status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('employers.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('employers.projects.create');
    }

   public function store(Request $request)
{
    $data = $this->validateProject($request);
    $data['employer_id'] = Auth::id();
    $data['status'] = 'pending';

    Project::create($data);

    return redirect()->route('employer.projects.index')
        ->with('success', 'Project posted successfully.');
}

    public function show(Project $project)
    {
        $this->authorizeOwner($project);

        return view('employers.projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $this->authorizeOwner($project);

        return view('employers.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $this->authorizeOwner($project);

        $data = $this->validateProject($request);
        $project->update($data);

        return redirect()->route('employer.projects.index')
            ->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $this->authorizeOwner($project);

        $project->delete();

        return redirect()->route('employer.projects.index')
            ->with('success', 'Project deleted successfully.');
    }

    private function validateProject(Request $request): array
    {
        return $request->validate([
            'title'             => ['required', 'string', 'max:255'],
            'project_type'      => ['required', 'in:fixed,hourly'],
            'budget'            => ['required', 'string', 'max:100'],
            'duration'          => ['required', 'string', 'max:100'],
            'experience_level'  => ['nullable', 'in:entry,intermediate,expert'],
            'skills'            => ['nullable', 'string', 'max:500'],
            'deadline'          => ['nullable', 'date'],
            'work_mode'         => ['required', 'in:remote,onsite,hybrid'],
            'country'           => ['nullable', 'string', 'max:100'],
            'state'             => ['required', 'string', 'max:100'],
            'district'          => ['required', 'string', 'max:100'],
            'city'              => ['required', 'string', 'max:100'],
            'description'       => ['required', 'string'],
        ]);
    }

    private function authorizeOwner(Project $project): void
    {
        abort_if($project->employer_id !== Auth::id(), 403, 'You do not have access to this project.');
    }
}

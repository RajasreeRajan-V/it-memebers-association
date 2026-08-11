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
        $data['status'] = 'active';

        Project::create($data);

        return redirect()->route('employer.projects.index')
            ->with('success', 'Project posted successfully.');
    }

    public function show(Project $project)
    {
        $this->authorizeOwner($project);

        // Load proposals + the employee who submitted each one,
        // so the "Proposals" section on the show page has what it needs.
        $project->load(['applications.applicant']);

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

    public function toggleStatus(Project $project)
    {
        $this->authorizeOwner($project);

        $project->status = $project->status === 'active' ? 'deactive' : 'active';
        $project->save();

        $message = $project->status === 'active'
            ? 'Project activated successfully.'
            : 'Project deactivated successfully.';

        return redirect()->route('employer.projects.index')
            ->with('success', $message);
    }

   private function validateProject(Request $request): array
{
    return $request->validate([
        // Alphabets + Numbers + Special characters
        'title' => [
            'required', 'string', 'max:255',
            'regex:/^[A-Za-z0-9\s\-&().,]+$/',
        ],

        'project_type' => ['required', 'in:fixed,hourly'],

        // Numbers + currency symbols only (no letters)
        'budget' => [
            'required', 'string', 'max:100',
            'regex:/^[0-9₹$,.\-\s\/]+$/',
        ],

        // Alphabets + Numbers + Hyphen
        'duration' => [
            'required', 'string', 'max:100',
            'regex:/^[A-Za-z0-9\s-]+$/',
        ],

        'experience_level' => ['nullable', 'in:entry,intermediate,expert'],

        // Alphabets + Numbers + Special characters
        'skills' => [
            'nullable', 'string', 'max:500',
            'regex:/^[A-Za-z0-9\s,.\-+#\/]+$/',
        ],

        'deadline'     => ['nullable', 'date'],
        'work_mode'    => ['required', 'in:remote,onsite,hybrid'],
        'visibility'   => ['required', 'in:freelancer,employee'],
        'maximum_bids' => ['required', 'integer', 'min:1', 'max:1000'],

        // Alphabets only
        'country' => [
            'nullable', 'string', 'max:100',
            'regex:/^[A-Za-z\s]+$/',
        ],

        // Alphabets only
        'state' => [
            'nullable', 'required_if:work_mode,onsite,hybrid', 'string', 'max:100',
            'regex:/^[A-Za-z\s]+$/',
        ],

        // Alphabets only
        'district' => [
            'nullable', 'required_if:work_mode,onsite,hybrid', 'string', 'max:100',
            'regex:/^[A-Za-z\s]+$/',
        ],

        // Alphabets only
        'city' => [
            'nullable', 'required_if:work_mode,onsite,hybrid', 'string', 'max:100',
            'regex:/^[A-Za-z\s]+$/',
        ],

        // Any characters
        'description' => ['required', 'string', 'max:5000'],
    ], [
        'title.regex'          => 'Title can only contain letters, numbers, and & ( ) . , -',
        'budget.regex'         => 'Budget can only contain numbers and ₹ $ , . - / (no letters).',
        'duration.regex'       => 'Duration can only contain letters, numbers, and -',
        'skills.regex'         => 'Skills can only contain letters, numbers, and , . - + # /',
        'visibility.in'        => 'Please select who can view/apply to this project.',
        'maximum_bids.required'=> 'Please specify the maximum number of bids allowed.',
        'maximum_bids.integer' => 'Maximum bids must be a whole number.',
        'maximum_bids.min'     => 'Maximum bids must be at least 1.',
        'maximum_bids.max'     => 'Maximum bids cannot exceed 1000.',
        'country.regex'        => 'Country can only contain letters.',
        'state.regex'          => 'State can only contain letters.',
        'district.regex'       => 'District can only contain letters.',
        'city.regex'           => 'City can only contain letters.',
    ]);
}
    private function authorizeOwner(Project $project): void
    {
        abort_if($project->employer_id !== Auth::id(), 403, 'You do not have access to this project.');
    }
}
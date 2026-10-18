<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display employer's projects.
     */

public function index(Request $request)
{
    $employerId = auth()->id();

    // Total projects belonging to this employer
    $total =Project::where('employer_id', $employerId)
        ->count();

    // Count projects by visibility
    $counts = Project::where('employer_id', $employerId)
        ->get(['visibility'])
        ->groupBy(function ($project) {
            $visibility = $project->visibility;

            if (is_string($visibility)) {
                $decoded = json_decode($visibility, true);

                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $visibility = $decoded;
                }
            }

            return is_array($visibility) ? $visibility : [];
        })
        ->flatten()
        
        ->all();

    $type = $request->query('type');

    // Base query
    $query = Project::where('employer_id', $employerId);

    // Filter by visibility tab
    if (in_array($type, ['freelancer', 'employee', 'student'], true)) {
        $query->whereJsonContains('visibility', $type);
    }

    // Search by project title
    if ($request->filled('search')) {
        $query->where('title', 'like', '%' . $request->search . '%');
    }

    // Filter by status
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $projects = $query->latest()
        ->paginate(10)
        ->withQueryString();

    return view('employers.projects.index', compact(
        'projects',
        'total',
        'counts',
        'type'
    ));
}


    /**
     * Show create project form.
     */
    public function create()
    {
        return view('employers.projects.create');
    }

    /**
     * Store a new project.
     */
    public function store(Request $request)
    {
        // Normalize special dashes and spaces before validation
        $this->normalizeInput($request);

        $data = $this->validateProject($request);

        $data['employer_id'] = Auth::id();
        $data['status'] = 'active';

        Project::create($data);

        return redirect()
            ->route('employer.projects.index')
            ->with('success', 'Project posted successfully.');
    }

    /**
     * Display a project.
     */
    public function show(Project $project)
    {
        $this->authorizeOwner($project);

        // Load proposals and the employee who submitted each proposal.
        $project->load([
            'applications.applicant'
        ]);

        return view('employers.projects.show', compact('project'));
    }

    /**
     * Show edit project form.
     */
    public function edit(Project $project)
    {
        $this->authorizeOwner($project);

        return view('employers.projects.edit', compact('project'));
    }

    /**
     * Update a project.
     */

    public function update(Request $request, Project $project)
    {
        $this->authorizeOwner($project);

        // Normalize special dashes and spaces before validation
        $this->normalizeInput($request);

        $data = $this->validateProject($request);

        $project->update($data);

        return redirect()
            ->route('employer.projects.index')
            ->with('success', 'Project updated successfully.');
    }



    /**
     * Delete a project.
     */
    public function destroy(Project $project)
    {
        $this->authorizeOwner($project);

        $project->delete();

        return redirect()
            ->route('employer.projects.index')
            ->with('success', 'Project deleted successfully.');
    }

    /**
     * Toggle project between active and deactive.
     */
    public function toggleStatus(Project $project)
    {
        $this->authorizeOwner($project);

        // Do not allow closed/completed projects to be toggled.
        if (in_array($project->status, ['closed', 'completed'])) {
            return back()->with(
                'error',
                'Closed or completed projects cannot be activated/deactivated.'
            );
        }

        $project->status = $project->status === 'active'
            ? 'deactive'
            : 'active';

        $project->save();

        $message = $project->status === 'active'
            ? 'Project activated successfully.'
            : 'Project deactivated successfully.';

        return redirect()
            ->route('employer.projects.index')
            ->with('success', $message);
    }

    /**
     * Close a project.
     *
     * No new proposals should be submitted after closing.
     * Existing proposals remain available for employer records.
     */
    public function close(Request $request, Project $project)
    {
        $this->authorizeOwner($project);

        if ($project->status === 'closed') {
            return back()->with(
                'error',
                'This project is already closed.'
            );
        }

        if ($project->status === 'completed') {
            return back()->with(
                'error',
                'A completed project cannot be closed.'
            );
        }

        /*
         * If the project already has accepted team members,
         * require confirmation before closing.
         */
        if (
            $project->acceptedCount() > 0 &&
            !$request->boolean('confirmed')
        ) {
            return back()->with(
                'error',
                'This project has accepted team members. Please confirm before closing.'
            );
        }

        $project->update([
            'status' => 'closed',
        ]);

        return redirect()
            ->route('employer.projects.index')
            ->with('success', 'Project closed successfully.');
    }

    /**
     * Mark an in-progress project as completed.
     */
    public function complete(Project $project)
    {
        $this->authorizeOwner($project);

        abort_unless(
            $project->status === 'in_progress',
            422,
            'Only an in-progress project can be marked as completed.'
        );

        $project->update([
            'status' => 'completed',
        ]);

        return redirect()
            ->route('employer.projects.index')
            ->with('success', 'Project marked as completed.');
    }

    /**
     * Validate project data.
     */
   private function validateProject(Request $request): array
    {
        return $request->validate([
            'title' => [
                'required', 'string', 'max:255',
                'regex:/^[A-Za-z0-9\s\-&().,]+$/',
            ],

            'project_type' => ['required', 'in:fixed,hourly'],

            'budget' => [
                'required', 'string', 'max:100',
                'regex:/^[0-9₹$,.\-\s\/]+$/',
            ],

            'duration' => [
                'required', 'string', 'max:100',
                'regex:/^[A-Za-z0-9\s-]+$/',
            ],

            'experience_level' => ['nullable', 'in:entry,intermediate,expert'],

            'skills' => [
                'nullable', 'string', 'max:500',
                'regex:/^[A-Za-z0-9\s,.\-+#\/]+$/',
            ],

            'deadline'  => ['nullable', 'date'],
            'work_mode' => ['required', 'in:remote,onsite,hybrid'],

            // Multi-select audience: one or more of freelancer / employee / student
            'visibility'   => ['required', 'array', 'min:1'],
            'visibility.*' => ['required', 'in:freelancer,employee,student', 'distinct'],

            'maximum_bids' => ['required', 'integer', 'min:1', 'max:1000'],

            'country' => ['nullable', 'string', 'max:100', 'regex:/^[A-Za-z\s]+$/'],

            'state' => [
                'nullable', 'required_if:work_mode,onsite,hybrid', 'string', 'max:100',
                'regex:/^[A-Za-z\s]+$/',
            ],

            'district' => [
                'nullable', 'required_if:work_mode,onsite,hybrid', 'string', 'max:100',
                'regex:/^[A-Za-z\s]+$/',
            ],

            'city' => [
                'nullable', 'required_if:work_mode,onsite,hybrid', 'string', 'max:100',
                'regex:/^[A-Za-z\s]+$/',
            ],

            'description' => ['required', 'string', 'max:5000'],
        ], [
            'title.regex'           => 'Title can only contain letters, numbers, and & ( ) . , -',
            'budget.regex'          => 'Budget can only contain numbers and ₹ $ , . - / (no letters).',
            'duration.regex'        => 'Duration can only contain letters, numbers, and -',
            'skills.regex'          => 'Skills can only contain letters, numbers, and , . - + # /',
            'visibility.required'   => 'Please select at least one audience.',
            'visibility.min'        => 'Please select at least one audience.',
            'visibility.*.in'       => 'Invalid audience selected.',
            'maximum_bids.required' => 'Please specify the maximum number of bids allowed.',
            'maximum_bids.integer'  => 'Maximum bids must be a whole number.',
            'maximum_bids.min'      => 'Maximum bids must be at least 1.',
            'maximum_bids.max'      => 'Maximum bids cannot exceed 1000.',
            'country.regex'         => 'Country can only contain letters.',
            'state.regex'           => 'State can only contain letters.',
            'district.regex'        => 'District can only contain letters.',
            'city.regex'            => 'City can only contain letters.',
        ]);
    }

    /**
     * Make sure the project belongs to the logged-in employer.
     */
    private function authorizeOwner(Project $project): void
    {
        abort_if(
            $project->employer_id !== Auth::id(),
            403,
            'You do not have access to this project.'
        );
    }
    /**
     * Convert fancy dashes / odd spaces to plain characters before validating.
     */
    private function normalizeInput(Request $request): void
    {
        $dashes = ['–', '—', '−', '‐', '‑', '‒'];

        foreach (['budget', 'duration'] as $field) {
            if (!$request->has($field)) {
                continue;
            }

            $value = (string) $request->input($field);

            $value = str_replace($dashes, '-', $value);          // en/em dash -> hyphen
            $value = str_replace("\u{00A0}", ' ', $value);       // non-breaking space -> space
            $value = trim(preg_replace('/\s+/u', ' ', $value));  // collapse whitespace

            $request->merge([$field => $value]);
        }
    }
}
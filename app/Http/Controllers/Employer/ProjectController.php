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
        return $request->validate(
            [

                /*
                 * Project title
                 * Alphabets + Numbers + Special characters
                 */
                'title' => [
                    'required',
                    'string',
                    'max:255',
                    'regex:/^[A-Za-z0-9\s\-&().,]+$/',
                ],

                /*
                 * Project category
                 */
                'category' => [
                    'nullable',
                    'string',
                    'max:100',
                ],

                /*
                 * Project type
                 */
                'project_type' => [
                    'required',
                    'in:fixed,hourly',
                ],

                /*
                 * Budget
                 * Numbers + currency symbols only
                 */
                'budget' => [
                    'required',
                    'string',
                    'max:100',
                    'regex:/^[0-9₹$,.\-\s\/]+$/',
                ],

                /*
                 * Duration
                 * Alphabets + Numbers + Hyphen
                 */
                'duration' => [
                    'required',
                    'string',
                    'max:100',
                    'regex:/^[A-Za-z0-9\s-]+$/',
                ],

                /*
                 * Experience level
                 */
                'experience_level' => [
                    'nullable',
                    'in:entry,intermediate,expert',
                ],

                /*
                 * Number of people required
                 */
                'people_required' => [
                    'required',
                    'integer',
                    'min:1',
                    'max:50',
                ],

                /*
                 * Skills
                 */
                'skills' => [
                    'nullable',
                    'string',
                    'max:500',
                    'regex:/^[A-Za-z0-9\s,.\-+#\/]+$/',
                ],

                /*
                 * Deadline
                 */
                'deadline' => [
                    'nullable',
                    'date',
                ],

                /*
                 * Work mode
                 */
                'work_mode' => [
                    'required',
                    'in:remote,onsite,hybrid',
                ],

                /*
                 * Visibility
                 */
                'visibility' => [
                    'required',
                    'in:freelancer,employee',
                ],

                /*
                 * Maximum bids
                 */
                'maximum_bids' => [
                    'required',
                    'integer',
                    'min:1',
                    'max:1000',
                ],

                /*
                 * Country
                 * Alphabets only
                 */
                'country' => [
                    'nullable',
                    'string',
                    'max:100',
                    'regex:/^[A-Za-z\s]+$/',
                ],

                /*
                 * State
                 */
                'state' => [
                    'nullable',
                    'required_if:work_mode,onsite,hybrid',
                    'string',
                    'max:100',
                    'regex:/^[A-Za-z\s]+$/',
                ],

                /*
                 * District
                 */
                'district' => [
                    'nullable',
                    'required_if:work_mode,onsite,hybrid',
                    'string',
                    'max:100',
                    'regex:/^[A-Za-z\s]+$/',
                ],

                /*
                 * City
                 */
                'city' => [
                    'nullable',
                    'required_if:work_mode,onsite,hybrid',
                    'string',
                    'max:100',
                    'regex:/^[A-Za-z\s]+$/',
                ],

                /*
                 * Project description
                 */
                'description' => [
                    'required',
                    'string',
                    'max:5000',
                ],
            ],
            [

                'title.regex' =>
                    'Title can only contain letters, numbers, and & ( ) . , -',

                'budget.regex' =>
                    'Budget can only contain numbers and ₹ $ , . - / (no letters).',

                'duration.regex' =>
                    'Duration can only contain letters, numbers, and -',

                'skills.regex' =>
                    'Skills can only contain letters, numbers, and , . - + # /',

                'visibility.in' =>
                    'Please select who can view/apply to this project.',

                'maximum_bids.required' =>
                    'Please specify the maximum number of bids allowed.',

                'maximum_bids.integer' =>
                    'Maximum bids must be a whole number.',

                'maximum_bids.min' =>
                    'Maximum bids must be at least 1.',

                'maximum_bids.max' =>
                    'Maximum bids cannot exceed 1000.',

                'people_required.required' =>
                    'Please specify how many people are required.',

                'people_required.integer' =>
                    'People required must be a whole number.',

                'people_required.min' =>
                    'At least 1 person is required.',

                'people_required.max' =>
                    'People required cannot exceed 50.',

                'country.regex' =>
                    'Country can only contain letters.',

                'state.regex' =>
                    'State can only contain letters.',

                'district.regex' =>
                    'District can only contain letters.',

                'city.regex' =>
                    'City can only contain letters.',
            ]
        );
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
}


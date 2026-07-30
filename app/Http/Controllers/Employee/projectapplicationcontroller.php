<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectApplicationController extends Controller
{
    /**
     * List the logged-in employee's own project proposals, with status.
     * Route: GET /projects/proposals
     * Name:  employee.projects.proposals
     */
    public function index(Request $request)
    {
        $proposals = ProjectApplication::where('user_id', Auth::id())
            ->with(['project.employer.employerRegistration'])
            ->latest()
            ->paginate(10);

        return view('employees.projects.proposals', compact('proposals'));
    }

    /**
     * Submit a proposal (cover note + rate + timeline) for a project.
     * Route: POST /projects/{project}/apply
     * Name:  employee.projects.apply
     */
    public function store(Request $request, Project $project)
    {
        // Only allow proposals on projects that are actually open to employees.
        abort_unless($project->status === 'active' && $project->visibility === 'employee', 404);

        $userId = $request->user()->id;

        if (ProjectApplication::where('project_id', $project->id)->where('user_id', $userId)->exists()) {
            return response()->json([
                'message' => 'You have already submitted a proposal for this project.',
            ], 409);
        }

        $validated = $request->validate([
            'cover_note'         => ['required', 'string', 'max:2000'],
            'proposed_rate'      => ['required', 'string', 'max:100'],
            'estimated_timeline' => ['required', 'string', 'max:100'],
        ]);

        $application = ProjectApplication::create([
            'project_id'         => $project->id,
            'user_id'            => $userId,
            'cover_note'         => $validated['cover_note'],
            'proposed_rate'      => $validated['proposed_rate'],
            'estimated_timeline' => $validated['estimated_timeline'],
            'status'             => 'pending',
        ]);

        return response()->json([
            'message'        => 'Proposal submitted successfully.',
            'application_id' => $application->id,
        ], 201);
    }
}
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
     * Route: GET /employee/projects/proposals
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
     * View a single one of the employee's own proposals.
     * Route: GET /employee/proposals/{proposal}
     * Name:  employee.proposals.show
     */
    public function show(ProjectApplication $proposal)
    {
        // Employees may only view their own proposals — never someone else's.
        abort_unless($proposal->user_id === Auth::id(), 403);

        $proposal->load('project.employer.employerRegistration');

        return view('employees.projects.proposal-show', compact('proposal'));
    }

    /**
     * Submit a proposal (cover note + rate + timeline) for a project.
     * Route: POST /employee/projects/{project}/apply
     * Name:  employee.projects.apply
     */
    public function store(Request $request, Project $project)
    {
        // Only allow proposals on projects that are actually open to employees.
        abort_unless($project->isOpenForProposals(), 404);

        $userId = $request->user()->id;

        // A withdrawn proposal shouldn't block a fresh one — only an
        // active (non-withdrawn) proposal counts as "already applied".
        $hasActiveProposal = ProjectApplication::where('project_id', $project->id)
            ->where('user_id', $userId)
            ->where('status', '!=', 'withdrawn')
            ->exists();

        if ($hasActiveProposal) {
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
            'status'             => 'pending', // "Under Review" in the UI
        ]);

        return response()->json([
            'message'        => 'Proposal submitted successfully.',
            'application_id' => $application->id,
        ], 201);
    }

    /**
     * Withdraw a proposal. Only allowed while it's still pending or
     * shortlisted — an accepted proposal can't be silently withdrawn here.
     * Route: POST /employee/proposals/{proposal}/withdraw
     * Name:  employee.proposals.withdraw
     */
    public function withdraw(Request $request, ProjectApplication $proposal)
    {
        abort_unless($proposal->user_id === $request->user()->id, 403);

        if (!in_array($proposal->status, ['pending', 'shortlisted'], true)) {
            return response()->json([
                'message' => 'This proposal can no longer be withdrawn.',
            ], 422);
        }

        $proposal->update(['status' => 'withdrawn']);

        return response()->json([
            'message' => 'Proposal withdrawn.',
            'status'  => $proposal->status,
        ]);
    }
}
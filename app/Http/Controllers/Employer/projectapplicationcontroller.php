<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\ProjectApplication;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProjectApplicationController extends Controller
{
    /**
     * Update a proposal's status (accept / shortlist / reject).
     * Route: PATCH /employer/proposals/{proposal}/status
     * Name:  employer.proposals.updateStatus
     */
    public function updateStatus(Request $request, ProjectApplication $proposal)
    {
        // Make sure this proposal belongs to a project owned by the logged-in employer.
        abort_unless($proposal->project->employer_id === $request->user()->id, 403);

        $validated = $request->validate([
            'status' => ['required', Rule::in(['shortlisted', 'accepted', 'rejected'])],
        ]);

        $newStatus = $validated['status'];
        $project = $proposal->project;

        // ------------------------------------------------------------
        // Accepting: enforce the people_required cap, and don't let an
        // employer accidentally accept the same proposal twice into the
        // count. If the proposal is already accepted, this is a no-op.
        // ------------------------------------------------------------
        if ($newStatus === 'accepted' && $proposal->status !== 'accepted') {
            if ($project->isTeamFull()) {
                return response()->json([
                    'message' => "This project's team is already full ({$project->requiredPeople()} / {$project->requiredPeople()} positions filled). Reject or remove an existing team member before accepting another proposal.",
                ], 422);
            }
        }

        $proposal->update(['status' => $newStatus]);

        // First acceptance moves the project from "active" (open/published)
        // into "in_progress". Only do this once — don't override completed/closed.
        if ($newStatus === 'accepted' && $project->status === 'active') {
            $project->update(['status' => 'in_progress']);
        }

        return response()->json([
            'message'          => 'Proposal status updated.',
            'status'           => $proposal->status,
            'accepted_count'   => $project->fresh()->acceptedCount(),
            'people_required'  => $project->requiredPeople(),
            'project_status'   => $project->fresh()->status,
        ]);
    }
}
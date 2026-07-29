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

        $proposal->update(['status' => $validated['status']]);

        return response()->json([
            'message' => 'Proposal status updated.',
            'status'  => $proposal->status,
        ]);
    }
}
<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\FreelancerBid;

class FreelancerBidController extends Controller
{
    /**
     * Display all freelancer bids received
     * for projects created by the logged-in employer.
     */
    public function index()
    {
        $employerId = auth()->id();

        $bids = FreelancerBid::with([
            'project',
            'freelancer.user',
        ])
            ->whereHas('project', function ($query) use ($employerId) {
                $query->where('employer_id', $employerId);
            })
            ->latest()
            ->paginate(10);

        return view('employers.freelance-bid.index', compact('bids'));
    }

    /**
     * Show a particular freelancer bid.
     */
    public function show(FreelancerBid $bid)
    {
        $bid->load([
            'project',
            'freelancer.user',
        ]);

        // Only the employer who created the project can view this bid.
        if (auth()->id() !== $bid->project->employer_id) {
            abort(403, 'You are not authorized to view this bid.');
        }

        return view(
            'employers.freelance-bid.proceed_bid',
            compact('bid')
        );
    }

    /**
     * Employer accepts/proceeds with freelancer bid.
     */
    public function proceed(FreelancerBid $bid)
    {
        $bid->load('project');

        // Only the project owner can proceed.
        if (auth()->id() !== $bid->project->employer_id) {
            abort(403, 'You are not authorized to proceed with this bid.');
        }

        /*
         * Pending bids cannot be processed by employer.
         * Only shortlisted/interview bids can be accepted.
         */
        if (
            !in_array($bid->status, [
                FreelancerBid::STATUS_SHORTLISTED,
                FreelancerBid::STATUS_INTERVIEW,
            ])
        ) {
            return back()->with(
                'error',
                'This bid is not available for proceeding yet.'
            );
        }

        $bid->update([
            'status' => FreelancerBid::STATUS_ACCEPTED,
        ]);

        return redirect()
            ->route('employer.bids.index')
            ->with(
                'success',
                'Freelancer bid accepted successfully.'
            );
    }

    /**
     * Employer rejects freelancer bid.
     */
    public function reject(FreelancerBid $bid)
    {
        $employerId = auth()->id();

        // Make sure the bid belongs to a project created by this employer
        if (!$bid->project || (int) $bid->project->employer_id !== (int) $employerId) {
            abort(403, 'You are not authorized to reject this bid.');
        }

        // Prevent rejecting an already completed bid
        if ($bid->status === FreelancerBid::STATUS_ACCEPTED) {
            return back()->with('error', 'An accepted bid cannot be rejected.');
        }

        if ($bid->status === FreelancerBid::STATUS_REJECTED) {
            return back()->with('error', 'This bid has already been rejected.');
        }

        $bid->update([
            'status' => FreelancerBid::STATUS_REJECTED,
            'comments' => 'The employer has rejected this bid.',
        ]);

        return back()->with(
            'success',
            'The freelancer bid has been rejected successfully.'
        );
    }

}
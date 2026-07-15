<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use Illuminate\Http\Request;

class JobApprovalController extends Controller
{
    /**
     * List job posts for admin review, filterable by status.
     */
    public function index(Request $request)
    {
        $query = JobPost::with('employer')->latest();

        // Default to showing pending jobs unless a status filter is given
        $status = $request->input('status', 'pending');

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $jobs = $query->paginate(10)->withQueryString();

        return view('admin.job_approval', compact('jobs', 'status'));
    }

    /**
     * Approve a pending job post.
     */
    public function approve($id)
    {
        $job = JobPost::findOrFail($id);

        $job->update([
            'status'            => 'approved',
            'rejection_reason'  => null,
        ]);

        return back()->with('success', "\"{$job->job_title}\" has been approved and is now live.");
    }

    /**
     * Reject a job post with a reason.
     */
    public function reject(Request $request, $id)
    {
        $job = JobPost::findOrFail($id);

        $validated = $request->validate([
            'rejection_reason' => ['nullable', 'string', 'max:500'],
        ]);

        $job->update([
            'status'            => 'rejected',
            'rejection_reason'  => $validated['rejection_reason'] ?? null,
        ]);

        return back()->with('success', "\"{$job->job_title}\" has been rejected.");
    }
}
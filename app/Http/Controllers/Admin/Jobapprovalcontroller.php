<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\JobApprovedMail;
use App\Mail\JobRejectedMail;
use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class JobApprovalController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'pending');

        $jobs = JobPost::with('employer')
            ->when($status !== 'all', fn ($q) => $q->where('status', $status))
            ->latest()
            ->paginate(10);

        return view('admin.job_approval', compact('jobs', 'status'));
    }

    public function approve(JobPost $job)
{
    $job->update([
        'status' => 'approved',
        'rejection_reason' => null,
    ]);

    if ($job->employer && $job->employer->email) {
        Mail::to($job->employer->email)->send(new JobApprovedMail($job));
    } else {
        \Log::warning("Job #{$job->id} approved but has no valid employer/email to notify.");
    }

    return back()->with('success', 'Job post approved' . ($job->employer ? ' and the employer has been notified.' : ', but no employer email was found to notify.'));
}

public function reject(Request $request, JobPost $job)
{
    $request->validate([
        'rejection_reason' => ['nullable', 'string', 'max:500'],
    ]);

    $job->update([
        'status' => 'rejected',
        'rejection_reason' => $request->rejection_reason,
    ]);

    if ($job->employer && $job->employer->email) {
        Mail::to($job->employer->email)->send(new JobRejectedMail($job));
    } else {
        \Log::warning("Job #{$job->id} rejected but has no valid employer/email to notify.");
    }

    return back()->with('success', 'Job post rejected' . ($job->employer ? ' and the employer has been notified.' : ', but no employer email was found to notify.'));
}
}
<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $jobs = JobPost::where('employer_id', Auth::id())
            ->when($request->search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%");
            })
            ->when($request->status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('employers.jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('employers.jobs.create');
    }

    /**
     * Store a newly created job.
     * New jobs always start as "pending" — they only go live after admin approval.
     */
    public function store(Request $request)
    {
        $data = $this->validateJob($request);
        $data['employer_id'] = Auth::id();
        $data['status'] = 'pending';        // <-- was 'active', now waits for admin review
        $data['rejection_reason'] = null;

        JobPost::create($data);

        return redirect()->route('employer.jobs.index')
            ->with('success', 'Job submitted for review. You will be notified once it is approved.');
    }

    public function show(JobPost $job)
    {
        $this->authorizeOwner($job);

        return view('employers.jobs.show', compact('job'));
    }

    public function edit(JobPost $job)
    {
        $this->authorizeOwner($job);

        return view('employers.jobs.edit', compact('job'));
    }

    /**
     * Update an existing job.
     * If an employer edits a rejected/approved job, send it back to "pending"
     * so admin reviews the new version before it goes live again.
     */
    public function update(Request $request, JobPost $job)
    {
        $this->authorizeOwner($job);

        $data = $this->validateJob($request);
        $data['status'] = 'pending';
        $data['rejection_reason'] = null;

        $job->update($data);

        return redirect()->route('employer.jobs.index')
            ->with('success', 'Job updated and resubmitted for review.');
    }

    public function destroy(JobPost $job)
    {
        $this->authorizeOwner($job);

        $job->delete();

        return redirect()->route('employer.jobs.index')
            ->with('success', 'Job deleted successfully.');
    }

    private function validateJob(Request $request): array
    {
        return $request->validate([
            'title'            => ['required', 'string', 'max:255'],
            'employment_type'  => ['required', 'in:full-time,part-time,contract,freelance'],
            'work_mode'        => ['required', 'in:onsite,hybrid,remote'],
            'experience'       => ['nullable', 'string', 'max:100'],
            'salary'           => ['nullable', 'string', 'max:100'],
            'qualification'    => ['nullable', 'string', 'max:255'],
            'skills'           => ['nullable', 'string', 'max:500'],
            'country'          => ['nullable', 'string', 'max:100'],
            'state'            => ['required', 'string', 'max:100'],
            'district'         => ['required', 'string', 'max:100'],
            'city'             => ['required', 'string', 'max:100'],
            'description'      => ['required', 'string'],
        ]);
    }

    private function authorizeOwner(JobPost $job): void
    {
        abort_if($job->employer_id !== Auth::id(), 403, 'You do not have access to this job.');
    }
}
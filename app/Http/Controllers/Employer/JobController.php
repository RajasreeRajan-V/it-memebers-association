<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function index()
    {
        $jobs = JobPost::where('employer_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('employers.jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('employers.jobs.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateJob($request);
        $validated['skills'] = $this->skillsToArray($request->input('skills'));
        $validated['employer_id'] = Auth::id();
        $validated['status'] = 'pending';

        JobPost::create($validated);

        return redirect()
            ->route('employer.jobs.index')
            ->with('success', 'Job submitted successfully and is awaiting admin approval.');
    }

    /**
     * Full details page for a single job.
     */
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

    public function update(Request $request, JobPost $job)
    {
        $this->authorizeOwner($job);

        $validated = $this->validateJob($request);
        $validated['skills'] = $this->skillsToArray($request->input('skills'));

        // Any edit sends it back for re-approval
        $validated['status'] = 'pending';
        $validated['rejection_reason'] = null;

        $job->update($validated);

        return redirect()
            ->route('employer.jobs.index')
            ->with('success', 'Job updated successfully and is awaiting admin approval.');
    }

    public function destroy(JobPost $job)
    {
        $this->authorizeOwner($job);
        $job->delete();

        return redirect()
            ->route('employer.jobs.index')
            ->with('success', 'Job deleted.');
    }

private function validateJob(Request $request): array
{
    return $request->validate([
        'title'           => ['required', 'string', 'min:3', 'max:255', 'regex:/^[A-Za-z0-9\s\-]+$/'],
        'employment_type' => ['required', 'in:full-time,part-time,contract,freelance'],
        'experience'      => ['required', 'string', 'max:50', 'regex:/^[A-Za-z0-9\s\-]+$/'],
        'salary'          => ['required', 'string', 'max:50', 'regex:/^[A-Za-z0-9\s\-\.\/\$₹,]+$/'],
        'skills'          => ['required', 'string', 'max:500', 'regex:/^[A-Za-z0-9\s\-\,]+$/'],
        'state'           => ['required', 'string', 'max:100', 'regex:/^[A-Za-z\s\-]+$/'],
        'district'        => ['required', 'string', 'max:100', 'regex:/^[A-Za-z\s\-]+$/'],
        'city'            => ['required', 'string', 'max:100', 'regex:/^[A-Za-z\s\-]+$/'],
        'qualification'   => ['nullable', 'string', 'max:150', 'regex:/^[A-Za-z0-9\s\-]*$/'],
        'work_mode'       => ['required', 'in:onsite,hybrid,remote'],
        'description'     => ['required', 'string', 'min:20', 'max:1500'],
   
], [
        'title.required' => 'The job title is required.',
        'title.min' => 'The job title must be at least 3 characters.',
        'experience.required' => 'Experience level is required.',
        'salary.required' => 'Salary information is required.',
        'skills.required' => 'Please list at least one skill.',
        'state.required' => 'Please select a state.',
        'district.required' => 'Please select a district.',
        'city.required' => 'Please enter a city.',
        'qualification.required' => 'Please specify the required qualification.',
        'description.required' => 'Job description is required.',
        'description.min' => 'Job description must be at least 20 characters.',
        'description.max' => 'Job description cannot exceed 1500 characters.',
    ]);
}

    private function skillsToArray(?string $skills): array
    {
        if (!$skills) {
            return [];
        }

        return collect(explode(',', $skills))
            ->map(fn ($s) => trim($s))
            ->filter()
            ->values()
            ->all();
    }

    private function authorizeOwner(JobPost $job): void
    {
        abort_unless($job->employer_id === Auth::id(), 403);
    }
}
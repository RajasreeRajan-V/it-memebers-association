<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    /**
     * Show the job creation form.
     */
    public function create()
    {
        return view('employers.jobs.create');
    }

    /**
     * Store a newly created job post.
     */
    public function store(Request $request)
    {
        $validated = $this->validateJob($request);
        $validated['skills'] = $this->skillsToArray($request->input('skills'));
        $validated['employer_id'] = Auth::id();
        $validated['status'] = 'pending';

        JobPost::create($validated);

        return redirect()
            ->route('jobs.create')
            ->with('success', 'Job submitted successfully and is awaiting admin approval.');
    }

    private function validateJob(Request $request): array
    {
        return $request->validate([
            'title'            => ['required', 'string', 'min:3', 'max:255', 'regex:/^[A-Za-z0-9\s\-]+$/'],
            'employment_type'  => ['required', 'in:full-time,part-time,contract,freelance'],
            'experience'       => ['required', 'string', 'max:50', 'regex:/^[A-Za-z0-9\s\-]+$/'],
            'salary'           => ['required', 'string', 'max:50', 'regex:/^[A-Za-z0-9\s\-\.\/\$₹,]+$/'],
            'skills'           => ['required', 'string', 'max:500', 'regex:/^[A-Za-z0-9\s\-\,]+$/'],
            'country'          => ['nullable', 'string', 'max:100', 'regex:/^[A-Za-z\s\-]*$/'],
            'state'            => ['required', 'string', 'max:100', 'regex:/^[A-Za-z\s\-]+$/'],
            'district'         => ['required', 'string', 'max:100', 'regex:/^[A-Za-z\s\-]+$/'],
            'city'             => ['required', 'string', 'max:100', 'regex:/^[A-Za-z\s\-]+$/'],
            'qualification'    => ['nullable', 'string', 'max:150', 'regex:/^[A-Za-z0-9\s\-]*$/'],
            'work_mode'        => ['required', 'in:onsite,hybrid,remote'],
            'description'      => ['required', 'string', 'min:20', 'max:1500'],
        ], [
            'title.required' => 'The job title is required.',
            'title.min' => 'The job title must be at least 3 characters.',
            'employment_type.required' => 'Please select an employment type.',
            'experience.required' => 'Experience level is required.',
            'salary.required' => 'Salary information is required.',
            'skills.required' => 'Please list at least one skill.',
            'state.required' => 'Please enter a state.',
            'district.required' => 'Please enter a district.',
            'city.required' => 'Please enter a city.',
            'work_mode.required' => 'Please select a work mode.',
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
}
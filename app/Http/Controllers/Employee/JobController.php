<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Public jobs listing – shows all approved & active jobs posted by employers.
     * Route: GET /jobs  ->  employee.jobs.index
     */
    public function index(Request $request)
    {
        $filters = $request->only(['q', 'location', 'category', 'employment_type', 'work_mode', 'sort']);

        $query = JobPost::query()
            ->with('employer')
            ->active(); // status = approved, is_active = true, not expired

        // Keyword search (title / description)
        if (!empty($filters['q'])) {
            $keyword = $filters['q'];
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                  ->orWhere('description', 'like', "%{$keyword}%");
            });
        }

        // Location search (city / state / district / country)
        if (!empty($filters['location'])) {
            $location = $filters['location'];
            $query->where(function ($q) use ($location) {
                $q->where('city', 'like', "%{$location}%")
                  ->orWhere('state', 'like', "%{$location}%")
                  ->orWhere('district', 'like', "%{$location}%")
                  ->orWhere('country', 'like', "%{$location}%");
            });
        }

        // Category – there's no dedicated column yet, so match it loosely
        // against the title and the skills JSON column.
        if (!empty($filters['category'])) {
            $category = $filters['category'];
            $query->where(function ($q) use ($category) {
                $q->where('title', 'like', "%{$category}%")
                  ->orWhereJsonContains('skills', $category);
            });
        }

        // Employment type filter (full-time, part-time, contract, freelance)
        if (!empty($filters['employment_type'])) {
            $query->where('employment_type', $filters['employment_type']);
        }

        // Work mode filter (onsite, hybrid, remote)
        if (!empty($filters['work_mode'])) {
            $query->where('work_mode', $filters['work_mode']);
        }

        // Sorting
        if (($filters['sort'] ?? 'relevant') === 'newest') {
            $query->latest();
        } else {
            $query->latest(); // no separate "relevance" signal yet, default to newest
        }

        $jobs = $query->paginate(10)->withQueryString();
        $jobsCount = $jobs->total();

        $topCompanies = JobPost::active()
            ->with('employer')
            ->get()
            ->filter(fn ($job) => $job->employer !== null)
            ->groupBy('employer_id')
            ->map(function ($group) {
                $employer = $group->first()->employer;

                return [
                    'name'     => $employer->company_name ?? $employer->name ?? 'Company',
                    'openings' => $group->count(),
                ];
            })
            ->sortByDesc('openings')
            ->take(5)
            ->values();

        return view('employees.jobs.index', compact('jobs', 'jobsCount', 'topCompanies', 'filters'));
    }

    /**
     * Jobs posted by the logged-in employer (employer dashboard "active jobs" list).
     * Route: GET /employer/jobs  ->  employer.jobs.index
     */
    public function employerJobs(Request $request)
    {
        $employerId = $request->user()->id;

        $jobs = JobPost::byEmployer($employerId)
            ->active()
            ->latest()
            ->paginate(10);

        return view('employer.jobs.index', compact('jobs'));
    }
}
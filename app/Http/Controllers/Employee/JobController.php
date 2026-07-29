<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use App\Models\JobPost;
use App\Models\Project;
use App\Models\ProjectApplication;
use App\Models\SavedJob;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class JobController extends Controller
{
    /**
     * How many jobs to show per page across all listing views.
     */
    protected int $perPage = 6;

    public function index(Request $request)
    {
        $filters = $request->only(['q', 'location', 'category', 'employment_type', 'work_mode', 'sort']);

        // ============================================================
        // 1. Regular job posts
        // ============================================================
        $jobQuery = JobPost::query()
            ->with('employer.employerRegistration')
            ->active();

        if (!empty($filters['q'])) {
            $keyword = $filters['q'];
            $jobQuery->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                  ->orWhere('description', 'like', "%{$keyword}%");
            });
        }

        if (!empty($filters['location'])) {
            $location = $filters['location'];
            $jobQuery->where(function ($q) use ($location) {
                $q->where('city', 'like', "%{$location}%")
                  ->orWhere('state', 'like', "%{$location}%")
                  ->orWhere('district', 'like', "%{$location}%")
                  ->orWhere('country', 'like', "%{$location}%");
            });
        }

        if (!empty($filters['category'])) {
            $categories = config('job_categories');

            if (isset($categories[$filters['category']])) {
                $keywords = $categories[$filters['category']]['keywords'];

                $jobQuery->where(function ($q) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $q->orWhere('title', 'like', "%{$keyword}%")
                          ->orWhereJsonContains('skills', $keyword);
                    }
                });
            }
        }

        if (!empty($filters['employment_type'])) {
            $jobQuery->where('employment_type', $filters['employment_type']);
        }

        if (!empty($filters['work_mode'])) {
            $jobQuery->where('work_mode', $filters['work_mode']);
        }

        $jobItems = $jobQuery->latest()->get()->each(function ($job) {
            $job->listing_type = 'job';
        });

        // ============================================================
        // 2. Employee-visible contract Projects
        //    (posted by employers with visibility = 'employee')
        // ============================================================
        // Skip pulling in projects if the user picked a full-time/part-time
        // filter - projects are inherently contract/freelance-style work.
        $includeProjects = empty($filters['employment_type'])
            || in_array($filters['employment_type'], ['contract', 'freelance']);

        $projectItems = collect();

        if ($includeProjects) {
            $projectQuery = Project::query()
                ->with('employer.employerRegistration')
                ->where('status', 'active')
                ->where('visibility', 'employee');

            if (!empty($filters['q'])) {
                $keyword = $filters['q'];
                $projectQuery->where(function ($q) use ($keyword) {
                    $q->where('title', 'like', "%{$keyword}%")
                      ->orWhere('description', 'like', "%{$keyword}%");
                });
            }

            if (!empty($filters['location'])) {
                $location = $filters['location'];
                $projectQuery->where(function ($q) use ($location) {
                    $q->where('city', 'like', "%{$location}%")
                      ->orWhere('state', 'like', "%{$location}%")
                      ->orWhere('district', 'like', "%{$location}%")
                      ->orWhere('country', 'like', "%{$location}%");
                });
            }

            if (!empty($filters['category'])) {
                $categories = config('job_categories');

                if (isset($categories[$filters['category']])) {
                    $keywords = $categories[$filters['category']]['keywords'];

                    $projectQuery->where(function ($q) use ($keywords) {
                        foreach ($keywords as $keyword) {
                            $q->orWhere('title', 'like', "%{$keyword}%")
                              ->orWhere('skills', 'like', "%{$keyword}%");
                        }
                    });
                }
            }

            if (!empty($filters['work_mode'])) {
                $projectQuery->where('work_mode', $filters['work_mode']);
            }

            $projectItems = $projectQuery->latest()->get()->each(function ($project) {
                $project->listing_type = 'project';
            });
        }

        // ============================================================
        // 3. Merge both sets, sort, and paginate manually
        // ============================================================
        $allItems = $jobItems->concat($projectItems)->sortByDesc('created_at')->values();

        $jobsCount = $allItems->count();
        $page      = LengthAwarePaginator::resolveCurrentPage();
        $pageItems = $allItems->slice(($page - 1) * $this->perPage, $this->perPage)->values();

        $jobs = new LengthAwarePaginator($pageItems, $jobsCount, $this->perPage, $page, [
            'path'  => $request->url(),
            'query' => $request->query(),
        ]);

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
            ->take(6)
            ->values();

        $userId = $request->user()?->id;

        // job ids the logged-in user has already saved / applied to,
        // so the UI can show filled bookmark icons / "Applied" state
        // (this only applies to real JobPost rows, not Projects)
        $savedJobIds = $userId
            ? SavedJob::where('user_id', $userId)->pluck('job_post_id')->all()
            : [];

        $appliedJobIds = $userId
            ? JobApplication::where('user_id', $userId)->pluck('job_post_id')->all()
            : [];

        // project ids the logged-in user has already submitted a proposal for,
        // so the UI can swap the "Submit Proposal" form for a confirmation state.
        $appliedProjectIds = $userId
            ? ProjectApplication::where('user_id', $userId)->pluck('project_id')->all()
            : [];

        $proposalsCount = count($appliedProjectIds);

        // counts shown on the sidebar nav buttons
        $savedJobsCount   = count($savedJobIds);
        $appliedJobsCount = count($appliedJobIds);

        $interviewsCount = $userId
            ? JobApplication::where('user_id', $userId)->interview()->count()
            : 0;

        $inprogress = $userId
            ? JobApplication::where('user_id', $userId)->inProgress()->count()
            : 0;

        $hiredJobsCount = $userId
            ? JobApplication::where('user_id', $userId)->hired()->count()
            : 0;

        $archivedCount = $userId
            ? JobApplication::where('user_id', $userId)->archived()->count()
            : 0;

        return view('employees.jobs.index', compact(
            'jobs', 'jobsCount', 'topCompanies', 'filters',
            'savedJobIds', 'appliedJobIds', 'appliedProjectIds', 'proposalsCount',
            'savedJobsCount', 'appliedJobsCount',
            'interviewsCount', 'inprogress', 'hiredJobsCount', 'archivedCount'
        ));
    }

    // ... show(), toggleSave(), apply(), savedJobs(), appliedJobs(),
    //     interviewJobs(), inProgressJobs(), hiredJobs(), archivedJobs(),
    //     employerJobs() — all unchanged, keep exactly as you already have them.
}
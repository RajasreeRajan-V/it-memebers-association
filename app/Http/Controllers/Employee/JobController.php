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
use App\Models\JobAlertSubscription;

class JobController extends Controller
{
   
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

  public function inProgressJobs(Request $request)
{
    $userId = $request->user()->id;

    // in-progress applications for this user, keyed by job_post_id for quick lookup in the view
    $applications = JobApplication::where('user_id', $userId)
        ->inProgress()
        ->get();

    $applicationsByJob = $applications->keyBy('job_post_id');

    $jobIds = $applications->pluck('job_post_id');

    $jobs = JobPost::with('employer.employerRegistration')
        ->whereIn('id', $jobIds)
        ->latest()
        ->paginate($this->perPage);

    return view('employees.jobs.in-progress', compact('jobs', 'applicationsByJob'));
}



public function appliedJobs(Request $request)
{
    $userId = $request->user()->id;

    $jobIds = JobApplication::where('user_id', $userId)->pluck('job_post_id');

    $jobs = JobPost::with('employer.employerRegistration')
        ->whereIn('id', $jobIds)
        ->latest()
        ->paginate($this->perPage);

    $savedJobIds = SavedJob::where('user_id', $userId)->pluck('job_post_id')->all();

    return view('employees.jobs.applied', compact('jobs', 'savedJobIds'));
}


public function savedJobs(Request $request)
{
    $userId = $request->user()->id;

    $jobIds = SavedJob::where('user_id', $userId)->pluck('job_post_id');

    $jobs = JobPost::with('employer.employerRegistration')
        ->whereIn('id', $jobIds)
        ->latest()
        ->paginate($this->perPage);

    $appliedJobIds = JobApplication::where('user_id', $userId)->pluck('job_post_id')->all();

    return view('employees.jobs.saved', compact('jobs', 'appliedJobIds'));
}

public function save(Request $request, $jobId)
{
    $userId = $request->user()->id;

    $existing = SavedJob::where('user_id', $userId)->where('job_post_id', $jobId)->first();

    if ($existing) {
        $existing->delete();
    } else {
        SavedJob::create([
            'user_id' => $userId,
            'job_post_id' => $jobId,
        ]);
    }

    return back();
}


public function interviewJobs(Request $request)
{
    $userId = $request->user()->id;

    $applications = JobApplication::with('interview')
        ->where('user_id', $userId)
        ->interview()
        ->get();

    $applicationsByJob = $applications->keyBy('job_post_id');

    $jobIds = $applications->pluck('job_post_id');

    $jobs = JobPost::with('employer.employerRegistration')
        ->whereIn('id', $jobIds)
        ->latest()
        ->paginate($this->perPage);

    return view('employees.jobs.interviews', compact('jobs', 'applicationsByJob'));
}


public function hiredJobs(Request $request)
{
    $userId = $request->user()->id;

    $jobIds = JobApplication::where('user_id', $userId)
        ->hired()
        ->pluck('job_post_id');

    $jobs = JobPost::with('employer.employerRegistration')
        ->whereIn('id', $jobIds)
        ->latest()
        ->paginate($this->perPage);

    return view('employees.jobs.hired', compact('jobs'));
}



public function archivedJobs(Request $request)
{
    $userId = $request->user()->id;

    $jobIds = JobApplication::where('user_id', $userId)
        ->archived()
        ->pluck('job_post_id');

    $jobs = JobPost::with('employer.employerRegistration')
        ->whereIn('id', $jobIds)
        ->latest()
        ->paginate($this->perPage);

    return view('employees.jobs.archived', compact('jobs'));
}



public function subscribe(Request $request)
{
    $request->validate([
        'email' => ['required', 'email'],
    ]);

    JobAlertSubscription::updateOrCreate(
        ['email' => $request->email],
        ['user_id' => $request->user()?->id]
    );

    return back()->with('success', 'You are subscribed to job alerts!');
}
}

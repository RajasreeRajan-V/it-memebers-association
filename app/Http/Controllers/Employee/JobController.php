<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use App\Models\JobPost;
use App\Models\SavedJob;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * How many jobs to show per page across all listing views.
     */
    protected int $perPage = 6;

    public function index(Request $request)
    {
        $filters = $request->only(['q', 'location', 'category', 'employment_type', 'work_mode', 'sort']);

        $query = JobPost::query()
            ->with('employer')
            ->active();

        if (!empty($filters['q'])) {
            $keyword = $filters['q'];
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                  ->orWhere('description', 'like', "%{$keyword}%");
            });
        }

        if (!empty($filters['location'])) {
            $location = $filters['location'];
            $query->where(function ($q) use ($location) {
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

                $query->where(function ($q) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $q->orWhere('title', 'like', "%{$keyword}%")
                          ->orWhereJsonContains('skills', $keyword);
                    }
                });
            }
        }

        if (!empty($filters['employment_type'])) {
            $query->where('employment_type', $filters['employment_type']);
        }

        if (!empty($filters['work_mode'])) {
            $query->where('work_mode', $filters['work_mode']);
        }

        if (($filters['sort'] ?? 'relevant') === 'newest') {
            $query->latest();
        } else {
            $query->latest();
        }

        $jobs = $query->paginate($this->perPage)->withQueryString();
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
            ->take(6)
            ->values();

        $userId = $request->user()?->id;

        // job ids the logged-in user has already saved / applied to,
        // so the UI can show filled bookmark icons / "Applied" state
        $savedJobIds = $userId
            ? SavedJob::where('user_id', $userId)->pluck('job_post_id')->all()
            : [];

        $appliedJobIds = $userId
            ? JobApplication::where('user_id', $userId)->pluck('job_post_id')->all()
            : [];

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
            'savedJobIds', 'appliedJobIds', 'savedJobsCount', 'appliedJobsCount',
            'interviewsCount', 'inprogress', 'hiredJobsCount', 'archivedCount'
        ));
    }

    /**
     * Full job details page.
     * Route: GET /jobs/{job}  ->  employee.jobs.show
     */
    public function show(Request $request, JobPost $job)
    {
        $job->load('employer');

        $isSaved = $request->user()
            ? SavedJob::where('user_id', $request->user()->id)->where('job_post_id', $job->id)->exists()
            : false;

        $hasApplied = $request->user()
            ? JobApplication::where('user_id', $request->user()->id)->where('job_post_id', $job->id)->exists()
            : false;

        return view('employees.jobs.show', compact('job', 'isSaved', 'hasApplied'));
    }

    /**
     * Toggle save/unsave for a job (called from the bookmark button).
     * Route: POST /jobs/{job}/save  ->  employee.jobs.save
     */
    public function toggleSave(Request $request, JobPost $job)
    {
        $userId = $request->user()->id;

        $saved = SavedJob::where('user_id', $userId)->where('job_post_id', $job->id)->first();

        if ($saved) {
            $saved->delete();
            $message = 'Job removed from saved list.';
        } else {
            SavedJob::create(['user_id' => $userId, 'job_post_id' => $job->id]);
            $message = 'Job saved.';
        }

        return back()->with('status', $message);
    }

    /**
     * Apply to a job.
     * Route: POST /jobs/{job}/apply  ->  employee.jobs.apply
     */
    public function apply(Request $request, JobPost $job)
    {
        $userId = $request->user()->id;

        JobApplication::firstOrCreate(
            [
                'user_id'     => $userId,
                'job_post_id' => $job->id,
            ],
            [
                'status'            => JobApplication::STATUS_APPLIED,
                'status_updated_at' => now(),
            ]
        );

        return back()->with('status', 'Application submitted successfully.');
    }

    /**
     * Jobs the logged-in user has saved (regardless of applied status).
     * Route: GET /jobs/saved  ->  employee.jobs.saved
     */
    public function savedJobs(Request $request)
    {
        $userId = $request->user()->id;

        $jobs = JobPost::query()
            ->with('employer')
            ->whereHas('savedBy', fn ($q) => $q->where('user_id', $userId))
            ->latest()
            ->paginate($this->perPage);

        $savedJobIds   = SavedJob::where('user_id', $userId)->pluck('job_post_id')->all();
        $appliedJobIds = JobApplication::where('user_id', $userId)->pluck('job_post_id')->all();

        return view('employees.jobs.saved', compact('jobs', 'savedJobIds', 'appliedJobIds'));
    }

    /**
     * Jobs the logged-in user has applied to.
     * Route: GET /jobs/applied  ->  employee.jobs.applied
     */
    public function appliedJobs(Request $request)
    {
        $userId = $request->user()->id;

        $jobs = JobPost::query()
            ->with('employer')
            ->whereHas('applications', fn ($q) => $q->where('user_id', $userId))
            ->latest()
            ->paginate($this->perPage);

        $savedJobIds   = SavedJob::where('user_id', $userId)->pluck('job_post_id')->all();
        $appliedJobIds = JobApplication::where('user_id', $userId)->pluck('job_post_id')->all();

        return view('employees.jobs.applied', compact('jobs', 'savedJobIds', 'appliedJobIds'));
    }

    /**
     * Jobs the logged-in user has an interview scheduled for.
     * Route: GET /jobs/interviews  ->  employee.jobs.interviews
     */
    public function interviewJobs(Request $request)
    {
        $userId = $request->user()->id;

        $jobs = JobPost::query()
            ->with('employer')
            ->whereHas('applications', fn ($q) => $q->where('user_id', $userId)->interview())
            ->latest()
            ->paginate($this->perPage);

        // pull each application's interview record so the view can show date/mode/location
        $applicationsByJob = JobApplication::where('user_id', $userId)
            ->interview()
            ->with('interview')
            ->get()
            ->keyBy('job_post_id');

        $savedJobIds   = SavedJob::where('user_id', $userId)->pluck('job_post_id')->all();
        $appliedJobIds = JobApplication::where('user_id', $userId)->pluck('job_post_id')->all();

        return view('employees.jobs.interviews', compact(
            'jobs', 'savedJobIds', 'appliedJobIds', 'applicationsByJob'
        ));
    }

    /**
     * Jobs the logged-in user's applications are currently "in progress" for
     * (Under Review / Shortlisted / Resume Reviewed / HR Review / Technical Review).
     * Route: GET /jobs/in-progress  ->  employee.jobs.inProgress
     */
    public function inProgressJobs(Request $request)
    {
        $userId = $request->user()->id;

        $jobs = JobPost::query()
            ->with('employer')
            ->whereHas('applications', fn ($q) => $q->where('user_id', $userId)->inProgress())
            ->latest()
            ->paginate($this->perPage);

        // pass along each application's sub_status so the blade can show
        // "Under Review" / "Shortlisted" per card
        $applicationsByJob = JobApplication::where('user_id', $userId)
            ->inProgress()
            ->get()
            ->keyBy('job_post_id');

        $savedJobIds   = SavedJob::where('user_id', $userId)->pluck('job_post_id')->all();
        $appliedJobIds = JobApplication::where('user_id', $userId)->pluck('job_post_id')->all();

        return view('employees.jobs.in-progress', compact(
            'jobs', 'savedJobIds', 'appliedJobIds', 'applicationsByJob'
        ));
    }

    /**
     * Jobs the logged-in user has been hired for.
     * Route: GET /jobs/hired  ->  employee.jobs.hired
     */
    public function hiredJobs(Request $request)
    {
        $userId = $request->user()->id;

        $jobs = JobPost::query()
            ->with('employer')
            ->whereHas('applications', fn ($q) => $q->where('user_id', $userId)->hired())
            ->latest()
            ->paginate($this->perPage);

        $savedJobIds   = SavedJob::where('user_id', $userId)->pluck('job_post_id')->all();
        $appliedJobIds = JobApplication::where('user_id', $userId)->pluck('job_post_id')->all();

        return view('employees.jobs.hired', compact('jobs', 'savedJobIds', 'appliedJobIds'));
    }

    /**
     * Jobs the logged-in user has archived.
     * Route: GET /jobs/archived  ->  employee.jobs.archived
     */
    public function archivedJobs(Request $request)
    {
        $userId = $request->user()->id;

        $jobs = JobPost::query()
            ->with('employer')
            ->whereHas('applications', fn ($q) => $q->where('user_id', $userId)->archived())
            ->latest()
            ->paginate($this->perPage);

        $savedJobIds   = SavedJob::where('user_id', $userId)->pluck('job_post_id')->all();
        $appliedJobIds = JobApplication::where('user_id', $userId)->pluck('job_post_id')->all();

        return view('employees.jobs.archived', compact('jobs', 'savedJobIds', 'appliedJobIds'));
    }

    public function employerJobs(Request $request)
    {
        $employerId = $request->user()->id;

        $jobs = JobPost::byEmployer($employerId)
            ->active()
            ->latest()
            ->paginate($this->perPage);

        return view('employer.jobs.index', compact('jobs'));
    }
}
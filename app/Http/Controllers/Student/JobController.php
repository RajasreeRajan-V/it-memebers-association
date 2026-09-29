<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use App\Models\JobApplication;
use App\Models\SavedJob;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\EmployerPortalNotificationHelper;
class JobController extends Controller
{
    /**
     * Job listing + search/filter.
     */
    public function index(Request $request)
    {
        $userId = Auth::id();

        $jobs = JobPost::with('employer')
            ->where('is_active', true)
            ->when($request->search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%");
            })
            ->when($request->city, function ($query, $city) {
                $query->where('city', 'like', "%{$city}%");
            })
            ->latest()
            ->paginate(4)
            ->withQueryString();

        $appliedJobIds = JobApplication::where('user_id', $userId)
            ->pluck('job_post_id')
            ->toArray();

        $savedJobIds = SavedJob::where('user_id', $userId)
            ->pluck('job_post_id')
            ->toArray();

        // Sidebar counts
        $savedJobsCount = SavedJob::where('user_id', $userId)->count();

        $appliedJobsCount = JobApplication::where('user_id', $userId)->count();

        $interviewsCount = JobApplication::where('user_id', $userId)
            ->interview()
            ->count();

        $inprogress = JobApplication::where('user_id', $userId)
            ->inProgress()
            ->count();

        $hiredJobsCount = JobApplication::where('user_id', $userId)
            ->hired()
            ->count();

        $archivedCount = JobApplication::where('user_id', $userId)
            ->archived()
            ->count();

        return view('students.jobs.index', compact(
            'jobs',
            'appliedJobIds',
            'savedJobIds',
            'savedJobsCount',
            'appliedJobsCount',
            'interviewsCount',
            'inprogress',
            'hiredJobsCount',
            'archivedCount'
        ));
    }

    /**
     * Apply to a job.
     *
     * Creates the application and sends a notification
     * to the employer who owns the job.
     */
    public function apply(JobPost $job)
    {
        $userId = Auth::id();

        /*
        |--------------------------------------------------------------------------
        | Check if already applied
        |--------------------------------------------------------------------------
        */
        $alreadyApplied = JobApplication::where('user_id', $userId)
            ->where('job_post_id', $job->id)
            ->exists();

        if ($alreadyApplied) {
            return response()->json([
                'message' => 'You have already applied to this job.',
            ], 409);
        }

        /*
        |--------------------------------------------------------------------------
        | Create application
        |--------------------------------------------------------------------------
        */
        $application = JobApplication::create([
            'user_id'           => $userId,
            'job_post_id'       => $job->id,
            'status'            => JobApplication::STATUS_APPLIED,
            'status_updated_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | Send notification to employer
        |--------------------------------------------------------------------------
        */
        $student = Auth::user();

   EmployerPortalNotificationHelper::send(
    employerId: $job->employer_id,
    type: 'application',
    title: 'New Applicant',
    message: ($student->name ?? 'A candidate')
        . ' has applied for your job "'
        . $job->title
        . '".',
    url: route('employer.applicants.index'),
    referenceId: $application->id,
    referenceType: 'application'
);

        /*
        |--------------------------------------------------------------------------
        | Response
        |--------------------------------------------------------------------------
        */
        return response()->json([
            'message' => 'Applied successfully.',
        ]);
    }

    /**
     * Toggle save/unsave for a job.
     */
    public function toggleSave(JobPost $job)
    {
        $userId = Auth::id();

        $saved = SavedJob::where('user_id', $userId)
            ->where('job_post_id', $job->id)
            ->first();

        if ($saved) {
            $saved->delete();

            return response()->json([
                'saved'   => false,
                'message' => 'Job removed from saved list.',
            ]);
        }

        SavedJob::create([
            'user_id'     => $userId,
            'job_post_id' => $job->id,
        ]);

        return response()->json([
            'saved'   => true,
            'message' => 'Job saved.',
        ]);
    }

    /**
     * Saved jobs list.
     */
    public function saved(Request $request)
    {
        $userId = Auth::id();

        $savedJobPostIds = SavedJob::where('user_id', $userId)
            ->pluck('job_post_id');

        $jobs = JobPost::with('employer')
            ->whereIn('id', $savedJobPostIds)
            ->latest()
            ->paginate(10);

        $appliedJobIds = JobApplication::where('user_id', $userId)
            ->pluck('job_post_id')
            ->toArray();

        return view('students.jobs.saved', compact(
            'jobs',
            'appliedJobIds'
        ));
    }

    /**
     * Applied jobs list (every application regardless of status).
     */
    public function applied(Request $request)
    {
        $userId = Auth::id();

        $applications = JobApplication::where('user_id', $userId)
            ->latest('status_updated_at')
            ->get()
            ->keyBy('job_post_id');

        $jobs = JobPost::with('employer')
            ->whereIn('id', $applications->keys())
            ->latest()
            ->paginate(10);

        $savedJobIds = SavedJob::where('user_id', $userId)
            ->pluck('job_post_id')
            ->toArray();

        return view('students.jobs.applied', compact(
            'jobs',
            'applications',
            'savedJobIds'
        ));
    }

    /**
     * Applications currently at the "interview" status.
     */
    public function interviews(Request $request)
    {
        $userId = Auth::id();

        $applications = JobApplication::where('user_id', $userId)
            ->interview()
            ->with('interview')
            ->get()
            ->keyBy('job_post_id');

        $jobs = JobPost::with('employer')
            ->whereIn('id', $applications->keys())
            ->latest()
            ->paginate(10);

        $applicationsByJob = $applications;

        return view('students.jobs.interviews', compact(
            'jobs',
            'applicationsByJob'
        ));
    }

    /**
     * Applications currently in progress.
     */
    public function inProgress(Request $request)
    {
        $userId = Auth::id();

        $applications = JobApplication::where('user_id', $userId)
            ->inProgress()
            ->get()
            ->keyBy('job_post_id');

        $jobs = JobPost::with('employer')
            ->whereIn('id', $applications->keys())
            ->latest()
            ->paginate(10);

        $applicationsByJob = $applications;

        return view('students.jobs.in-progress', compact(
            'jobs',
            'applicationsByJob'
        ));
    }

    /**
     * Jobs the student was hired for.
     */
    public function hired(Request $request)
    {
        $userId = Auth::id();

        $jobPostIds = JobApplication::where('user_id', $userId)
            ->hired()
            ->pluck('job_post_id');

        $jobs = JobPost::with('employer')
            ->whereIn('id', $jobPostIds)
            ->latest()
            ->paginate(10);

        return view('students.jobs.hired', compact('jobs'));
    }

    /**
     * Archived / closed-out applications.
     */
    public function archived(Request $request)
    {
        $userId = Auth::id();

        $jobPostIds = JobApplication::where('user_id', $userId)
            ->archived()
            ->pluck('job_post_id');

        $jobs = JobPost::with('employer')
            ->whereIn('id', $jobPostIds)
            ->latest()
            ->paginate(10);

        return view('students.jobs.archived', compact('jobs'));
    }

    /**
     * Standalone job details page.
     */
    public function show(JobPost $job)
    {
        $userId = Auth::id();

        $hasApplied = JobApplication::where('user_id', $userId)
            ->where('job_post_id', $job->id)
            ->exists();

        $isSaved = SavedJob::where('user_id', $userId)
            ->where('job_post_id', $job->id)
            ->exists();

        return view('students.jobs.show', compact(
            'job',
            'hasApplied',
            'isSaved'
        ));
    }
}
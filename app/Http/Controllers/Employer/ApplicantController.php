<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Interview;
use App\Models\JobApplication;
use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicantController extends Controller
{
    protected int $perPage = 10;

    /**
     * All candidates across every job this employer has posted.
     * Optional ?job=ID to filter to a single job, ?status=X to filter by bucket.
     * Route: GET /employer/applicants  ->  employer.applicants.index
     */
    public function index(Request $request)
    {
        $employerId = Auth::id();

        $query = JobApplication::query()
            ->with(['user', 'jobPost', 'interview'])
            ->whereHas('jobPost', fn ($q) => $q->where('employer_id', $employerId));

        if ($request->filled('job')) {
            $query->where('job_post_id', $request->job);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $applications = $query->latest()->paginate($this->perPage)->withQueryString();

        // for the job filter dropdown
        $jobs = JobPost::where('employer_id', $employerId)
            ->orderBy('title')
            ->get(['id', 'title']);

        // counts per bucket, for tab badges
        $counts = JobApplication::whereHas('jobPost', fn ($q) => $q->where('employer_id', $employerId))
            ->selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        return view('employers.applicants.index', compact('applications', 'jobs', 'counts'));
    }

    /**
     * Move an application to a new top-level status (shortlist, hire, reject, archive, etc).
     * Route: POST /employer/applicants/{application}/status  ->  employer.applicants.updateStatus
     */
    public function updateStatus(Request $request, JobApplication $application)
    {
        $this->authorizeOwner($application);

        $validated = $request->validate([
            'status'     => 'required|in:applied,in_progress,interview,hired,rejected,archived',
            'sub_status' => 'nullable|in:resume_reviewed,under_review,shortlisted,hr_review,technical_review',
        ]);

        $application->moveTo($validated['status'], $validated['sub_status'] ?? null);

        return back()->with('success', 'Candidate status updated.');
    }

    /**
     * Schedule (or reschedule) an interview for this application.
     * Route: POST /employer/applicants/{application}/interview  ->  employer.applicants.scheduleInterview
     */
    public function scheduleInterview(Request $request, JobApplication $application)
    {
        $this->authorizeOwner($application);

        $validated = $request->validate([
            'scheduled_at' => 'required|date|after:now',
            'mode'         => 'required|in:online,in_person,phone',
            'location'     => 'nullable|string|max:255',
        ]);

        Interview::updateOrCreate(
            ['application_id' => $application->id],
            [
                'employer_id'  => Auth::id(),
                'scheduled_at' => $validated['scheduled_at'],
                'mode'         => $validated['mode'],
                'location'     => $validated['location'] ?? null,
                'status'       => Interview::STATUS_SCHEDULED,
            ]
        );

        $application->moveTo(JobApplication::STATUS_INTERVIEW);

        return back()->with('success', 'Interview scheduled.');
    }

    private function authorizeOwner(JobApplication $application): void
    {
        abort_if(
            $application->jobPost->employer_id !== Auth::id(),
            403,
            'You do not have access to this application.'
        );
    }
}
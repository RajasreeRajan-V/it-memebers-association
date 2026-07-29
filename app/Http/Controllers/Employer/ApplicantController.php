<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Mail\ApplicationStatusMail;
use App\Models\Interview;
use App\Models\JobApplication;
use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ApplicantController extends Controller
{
    protected int $perPage = 5;

    public function index(Request $request)
    {
        $employerId = Auth::id();

        $query = JobApplication::query()
            ->with(['user.employeeRegistration', 'jobPost', 'interview'])
            ->whereHas('jobPost', fn ($q) => $q->where('employer_id', $employerId));

        if ($request->filled('job')) {
            $query->where('job_post_id', $request->job);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $applications = $query->latest()->paginate($this->perPage)->withQueryString();

        $jobs = JobPost::where('employer_id', $employerId)
            ->orderBy('title')
            ->get(['id', 'title']);

        $counts = JobApplication::whereHas('jobPost', fn ($q) => $q->where('employer_id', $employerId))
            ->selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        return view('employers.applicants.index', compact('applications', 'jobs', 'counts'));
    }

    /**
     * Move an application to a new top-level status (shortlist, hire, reject, archive, etc).
     */
    public function updateStatus(Request $request, JobApplication $application)
    {
        $this->authorizeOwner($application);

        $validated = $request->validate([
            'status'     => 'required|in:applied,in_progress,interview,hired,rejected,archived',
            'sub_status' => 'nullable|in:resume_reviewed,under_review,shortlisted,hr_review,technical_review',
        ]);

        $application->moveTo($validated['status'], $validated['sub_status'] ?? null);

        // send an email only for the actions that matter to the candidate
        $emailEvent = match (true) {
            $validated['status'] === 'in_progress' && ($validated['sub_status'] ?? null) === 'shortlisted' => 'shortlisted',
            $validated['status'] === 'hired'    => 'hired',
            $validated['status'] === 'rejected' => 'rejected',
            default => null, // archived, applied, plain in_progress without shortlist sub_status: no email
        };

        if ($emailEvent && $application->user?->email) {
            Mail::to($application->user->email)
                ->send(new ApplicationStatusMail($application->fresh(['user', 'jobPost.employer']), $emailEvent));
        }

        return back()->with('success', 'Candidate status updated.');
    }

    /**
     * Schedule (or reschedule) an interview for this application.
     */
    public function scheduleInterview(Request $request, JobApplication $application)
    {
        $this->authorizeOwner($application);

        $validated = $request->validate([
            'scheduled_at' => 'required|date|after:now',
            'mode'         => 'required|in:online,in_person,phone',
            'location'     => 'nullable|string|max:255',
        ]);

        $isReschedule = $application->interview()->exists();

        Interview::updateOrCreate(
            ['application_id' => $application->id],
            [
                'employer_id'  => Auth::id(),
                'scheduled_at' => $validated['scheduled_at'],
                'mode'         => $validated['mode'],
                'location'     => $validated['location'] ?? null,
                'status'       => $isReschedule
                    ? Interview::STATUS_RESCHEDULED
                    : Interview::STATUS_SCHEDULED,
            ]
        );

        $application->moveTo(JobApplication::STATUS_INTERVIEW);

        if ($application->user?->email) {
            Mail::to($application->user->email)->send(new ApplicationStatusMail(
                $application->fresh(['user', 'jobPost.employer', 'interview']),
                $isReschedule ? 'interview_rescheduled' : 'interview_scheduled'
            ));
        }

        return back()->with('success', $isReschedule ? 'Interview rescheduled.' : 'Interview scheduled.');
    }

    /**
     * Cancel a scheduled interview for this application.
     */
    public function cancelInterview(JobApplication $application)
    {
        $this->authorizeOwner($application);

        $interview = $application->interview;

        if ($interview) {
            $interview->update(['status' => Interview::STATUS_CANCELLED]);
        }

        $application->moveTo(JobApplication::STATUS_IN_PROGRESS, JobApplication::SUB_SHORTLISTED);

        if ($application->user?->email) {
            Mail::to($application->user->email)->send(new ApplicationStatusMail(
                $application->fresh(['user', 'jobPost.employer', 'interview']),
                'interview_cancelled'
            ));
        }

        return back()->with('success', 'Interview cancelled.');
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
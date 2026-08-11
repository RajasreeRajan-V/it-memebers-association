<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\FreelancerBid;
use Illuminate\Support\Facades\Auth;
use App\Models\FreelancerSavedJob;

class FreelancerWorkController extends Controller
{
    /**
     * Saved Jobs
     */
    public function savedJobs()
    {
        $savedJobs = FreelancerSavedJob::with([
            'project.employer.employerRegistration'
        ])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('freelancer.saved-jobs', compact('savedJobs'));
    }
    public function saveJob(Project $project)
    {
        FreelancerSavedJob::firstOrCreate([
            'user_id' => Auth::id(),
            'project_id' => $project->id,
        ]);

        return back()->with('success', 'Job saved successfully.');
    }

    public function unsaveJob(Project $project)
    {
        FreelancerSavedJob::where('user_id', Auth::id())
            ->where('project_id', $project->id)
            ->delete();

        return redirect()->back()->with(
            'success',
            'Job removed from saved jobs.'
        );
    }
    /**
     * Applied Jobs
     */
    public function appliedJobs()
    {
        $freelancer = Auth::user()?->freelancerRegistration;

        if (!$freelancer) {
            abort(404, 'Freelancer registration not found.');
        }

        $projects = FreelancerBid::with([
            'project.employer.employerRegistration'
        ])
            ->where('freelancer_id', $freelancer->id)
            ->latest()
            ->paginate(10);
        return view('freelancer.applied-jobs', compact('projects'));
    }

    /**
     * My Proposals
     */
    public function proposals()
    {
        $freelancer = Auth::user()?->freelancerRegistration;
        if (!$freelancer) {
            abort(404, 'Freelancer registration not found.');
        }
        $proposals = FreelancerBid::with(['project.employer.employerRegistration'])
        ->where('freelancer_id', $freelancer->id)
        ->latest()
        ->paginate(10);
        return view('freelancer.proposals', compact('proposals'));
    }

    /**
     * Interviews
     */
    public function interviews()
    {
        $proposals = FreelancerBid::with([
            'project.employer.employerRegistration'
        ])
            ->where('freelancer_id', Auth::id())
            ->whereIn('status', [
                'interview',
                'interview_scheduled',
                'shortlisted',
            ])
            ->latest()
            ->paginate(10);

        return view('freelancer.interviews', compact('proposals'));
    }

    /**
     * In Progress
     */
    public function inProgress()
    {
        $proposals = FreelancerBid::with([
            'project.employer.employerRegistration'
        ])
            ->where('freelancer_id', Auth::id())
            ->whereIn('status', [
                'in_progress',
                'accepted',
            ])
            ->latest()
            ->paginate(10);

        return view('freelancer.in-progress', compact('proposals'));
    }

    /**
     * Hired
     */
    public function hired()
    {
        $proposals = FreelancerBid::with([
            'project.employer.employerRegistration'
        ])
            ->where('freelancer_id', Auth::id())
            ->whereIn('status', [
                'hired',
                'accepted',
            ])
            ->latest()
            ->paginate(10);

        return view('freelancer.hired', compact('proposals'));
    }

    /**
     * Archived
     */
    public function archived()
    {
        $proposals = FreelancerBid::with([
            'project.employer.employerRegistration'
        ])
            ->where('freelancer_id', Auth::id())
            ->whereIn('status', [
                'rejected',
                'withdrawn',
                'completed',
                'cancelled',
            ])
            ->latest()
            ->paginate(10);

        return view('freelancer.archived', compact('proposals'));
    }
}
<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FreelancerBid;
use App\Models\Project;
use App\Models\FreelancerArchivedJob;
use Illuminate\Support\Facades\Auth;
use App\Models\FreelancerRegistration;

class FreelancersJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    private function currentFreelancerId(): int
    {
        $freelancerId = FreelancerRegistration::where(
            'user_id',
            Auth::id()
        )->value('id');

        abort_if(
            !$freelancerId,
            403,
            'No freelancer registration is linked to this account.'
        );

        return (int) $freelancerId;
    }

    public function archiveJob(Project $project)
    {
        FreelancerArchivedJob::firstOrCreate([
            'freelancer_id' => $this->currentFreelancerId(),
            'project_id' => $project->id,
        ]);

        return back()->with('success', 'Job moved to Archived.');
    }

    public function unarchiveJob(Project $project)
    {
        FreelancerArchivedJob::where('freelancer_id', $this->currentFreelancerId())
            ->where('project_id', $project->id)
            ->delete();

        return back()->with('success', 'Job restored.');
    }

    public function archived()
    {
        $freelancerId = $this->currentFreelancerId();

        // Jobs the freelancer archived manually
        $archivedJobs = Project::with('employer.employerRegistration')
            ->whereIn('id', FreelancerArchivedJob::where('freelancer_id', $freelancerId)->pluck('project_id'))
            ->latest()
            ->get();

        // Rejected / withdrawn / completed / cancelled proposals
        $proposals = FreelancerBid::with(['project.employer', 'freelancer'])
            ->where('freelancer_id', $freelancerId)
            ->whereIn('status', ['rejected', 'withdrawn', 'completed', 'cancelled'])
            ->latest()
            ->paginate(10);

        return view('freelancer.archived', compact('archivedJobs', 'proposals'));
    }
}

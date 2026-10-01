<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\FreelancerBid;
use App\Models\FreelancerRegistration;

class BidController extends Controller
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
        $user = Auth::user();

        $freelancer = FreelancerRegistration::where('user_id', $user->id)
            ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $rules = [
            'project_id' => 'required|exists:projects,id',
            'bid_amount' => 'required|numeric|min:1',
            'estimated_days' => 'required|string|max:100',
            'cover_letter' => 'required|string|min:50',
            'availability' => 'required|in:full_time,part_time,flexible',
            'github' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'portfolio' => 'nullable|file|mimes:pdf,zip,rar|max:20480',
        ];

        // Resume is required only when freelancer doesn't already have one
        if (empty($freelancer->resume)) {
            $rules['resume'] = 'required|file|mimes:pdf,doc,docx|max:5120';
        } else {
            $rules['resume'] = 'nullable|file|mimes:pdf,doc,docx|max:5120';
        }

        $validated = $request->validate($rules);

        /*
        |--------------------------------------------------------------------------
        | Get Project
        |--------------------------------------------------------------------------
        */

        $project = Project::findOrFail($request->project_id);

        /*
        |--------------------------------------------------------------------------
        | Check if Freelancer Already Submitted a Proposal
        |--------------------------------------------------------------------------
        */

        $existingBid = FreelancerBid::where('project_id', $project->id)
            ->where('freelancer_id', $freelancer->id)
            ->first();

        /*
        |--------------------------------------------------------------------------
        | Update Existing Proposal
        |--------------------------------------------------------------------------
        */

        if ($request->filled('bid_id')) {

            $bid = FreelancerBid::where('id', $request->bid_id)
                ->where('project_id', $project->id)
                ->where('freelancer_id', $freelancer->id)
                ->firstOrFail();

            $bid->update([
                'bid_amount' => $request->bid_amount,
                'estimated_days' => $request->estimated_days,
                'cover_letter' => $request->cover_letter,
                'github' => $request->github,
                'linkedin' => $request->linkedin,
                'availability' => $request->availability,
            ]);

            return redirect()
                ->route('freelancer.job')
                ->with('success', 'Your proposal has been updated successfully.');
        }

        /*
        |--------------------------------------------------------------------------
        | Prevent Duplicate Proposal
        |--------------------------------------------------------------------------
        */

        if ($existingBid) {
            return back()
                ->withInput()
                ->with('error', 'You have already submitted a proposal for this project.');
        }

        /*
        |--------------------------------------------------------------------------
        | Check Available Bid Slots
        |--------------------------------------------------------------------------
        */

        $maximumBids = (int) ($project->maximum_bids ?? 0);

        $receivedBids = FreelancerBid::where('project_id', $project->id)
            ->count();

        if ($maximumBids > 0 && $receivedBids >= $maximumBids) {
            return back()
                ->withInput()
                ->with('error', 'Sorry, all proposal slots for this project have been filled.');
        }

        /*
        |--------------------------------------------------------------------------
        | Resume Upload
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('resume')) {

            $resumePath = $request->file('resume')->store(
                'freelancers/resumes',
                'public'
            );

            $freelancer->update([
                'resume' => $resumePath,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Create New Proposal
        |--------------------------------------------------------------------------
        */

        FreelancerBid::create([
            'project_id' => $project->id,
            'freelancer_id' => $freelancer->id,
            'employer_id' => $project->employer_id,
            'bid_amount' => $request->bid_amount,
            'estimated_days' => $request->estimated_days,
            'cover_letter' => $request->cover_letter,
            'github' => $request->github,
            'linkedin' => $request->linkedin,
            'availability' => $request->availability,
            'status' => FreelancerBid::STATUS_PENDING,
        ]);

        return redirect()
            ->route('freelancer.job')
            ->with('success', 'Your proposal has been submitted successfully.');
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
    public function edit(Project $project)
    {
        $freelancer = Auth::user()->freelancerProfile;

        $bid = FreelancerBid::where('project_id', $project->id)
            ->where('freelancer_id', $freelancer->id)
            ->first();
        // dd($project->budget);
        return view('freelancer.bid.form', compact(
            'project',
            'bid',
            'freelancer'
        ));
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
}

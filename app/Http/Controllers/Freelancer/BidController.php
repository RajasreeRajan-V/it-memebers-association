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
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'bid_amount' => 'required|numeric|min:1',
            'estimated_days' => 'required',
            'cover_letter' => 'required|min:50',
            'availability' => 'required',
            'github' => 'nullable|url',
            'linkedin' => 'nullable|url',
        ]);

        $user = Auth::user();
        $freelancer = FreelancerRegistration::where('user_id', $user->id)->firstOrFail();
        $project = Project::findOrFail($request->project_id);

        // Update existing proposal
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

        // Create new proposal
        $alreadyBid = FreelancerBid::where('project_id', $project->id)
            ->where('freelancer_id', $freelancer->id)
            ->exists();

        if ($alreadyBid) {
            return back()->with('error', 'You have already submitted a proposal for this project.');
        }

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
            'status' => 'pending',
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

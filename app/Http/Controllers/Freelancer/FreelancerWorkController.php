<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\FreelancerBid;
use Illuminate\Support\Facades\Auth;
use App\Models\FreelancerSavedJob;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\SignedContractReceivedMail;
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
    $freelancer = Auth::user()?->freelancerRegistration;

    if (!$freelancer) {
        abort(404, 'Freelancer registration not found.');
    }

    $proposals = FreelancerBid::with([
        'project.employer.employerRegistration',
    ])
        ->where('freelancer_id', $freelancer->id)
        // ->whereNull('signed_contract_document')
        ->whereIn('status', [
            FreelancerBid::STATUS_ACCEPTED, // set by the employer's approve()
            'in_progress',
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
    $freelancer = Auth::user()?->freelancerRegistration;

    if (!$freelancer) {
        abort(404, 'Freelancer registration not found.');
    }

    $proposals = FreelancerBid::with([
        'project.employer.employerRegistration',
    ])
        ->where('freelancer_id', $freelancer->id)
        ->whereIn('status', [
            FreelancerBid::STATUS_ACCEPTED,
            'in_progress',
            'hired',
        ])
        ->whereNotNull('signed_contract_document')
        ->orderByDesc('signed_contract_received_at')
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
public function downloadContract(FreelancerBid $bid, string $type = 'contract')
{
    $freelancer = Auth::user()?->freelancerRegistration;
    abort_unless($freelancer && $bid->freelancer_id === $freelancer->id, 403);

    $path = $type === 'signed'
        ? $bid->signed_contract_document
        : $bid->contract_document;

    abort_unless($path, 404);

    foreach (['public', 'local'] as $disk) {
        if (Storage::disk($disk)->exists($path)) {
            return Storage::disk($disk)->response($path); // opens in browser
        }
    }

    abort(404, 'Contract file not found on disk.');
}
public function uploadSignedContract(Request $request, FreelancerBid $bid)
{
    $freelancer = Auth::user()?->freelancerRegistration;
    abort_unless($freelancer && $bid->freelancer_id === $freelancer->id, 403);

    // Only valid when employer sent a contract and nothing signed has been uploaded yet
    abort_unless($bid->status === FreelancerBid::STATUS_ACCEPTED || $bid->status === 'in_progress', 403);
    abort_unless($bid->contract_document, 403, 'No contract has been sent yet.');

    if ($bid->signed_contract_document) {
        return back()->with('error', 'A signed contract has already been uploaded.');
    }

    // Errors go into a per-bid bag so only the right card shows them
    $request->validateWithBag('signed_' . $bid->id, [
        'signed_contract' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
    ]);

    $file = $request->file('signed_contract');
    $safeName = now()->format('YmdHis') . '_signed_'
        . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
        . '.' . $file->extension();

    $path = $file->storeAs('contracts/bid-' . $bid->id, $safeName, 'local');

    $bid->forceFill([
        'signed_contract_document'    => $path,
        'signed_contract_received_at' => now(),
    ])->save();

    $bid->load(['project.employer', 'employer', 'freelancer.user']);
    $employerEmail = $bid->employer?->email ?? $bid->project?->employer?->email;

    $mailSent = false;
    if ($employerEmail) {
        try {
            Mail::to($employerEmail)->send(new SignedContractReceivedMail($bid, $path));
            $mailSent = true;
        } catch (\Throwable $e) {
            Log::error('Failed to send signed contract email for bid #' . $bid->id . ': ' . $e->getMessage());
        }
    } else {
        Log::warning('No employer email for bid #' . $bid->id . '; signed contract notification skipped.');
    }

    return back()->with(
        $mailSent ? 'success' : 'error',
        $mailSent
            ? 'Signed contract uploaded and sent to the employer.'
            : 'Signed contract uploaded, but the employer notification email could not be sent.'
    );
} 
}
<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Mail\JobInvitationMail;
use App\Models\JobInvitation;
use App\Models\JobPost;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CandidateInviteController extends Controller
{
    /**
     * Invite a candidate to apply for a specific job.
     */
    public function invite(Request $request, User $candidate)
    {
        /*
        |--------------------------------------------------------------------------
        | Employer authentication
        |--------------------------------------------------------------------------
        */

        $employer = Auth::user();

        if (!$employer || $employer->role !== 'employer') {
            abort(403, 'Unauthorized');
        }


        /*
        |--------------------------------------------------------------------------
        | Candidate validation
        |--------------------------------------------------------------------------
        */

        if ($candidate->role !== 'employee') {
            abort(404);
        }

        if (empty($candidate->email)) {
            return back()->with(
                'error',
                'This candidate does not have an email address.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Job ID validation
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'job_id' => [
                'required',
                'integer',
                'exists:job_posts,id',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Find job
        |--------------------------------------------------------------------------
        */

        $job = JobPost::findOrFail($request->job_id);


        /*
        |--------------------------------------------------------------------------
        | Security
        |--------------------------------------------------------------------------
        |
        | Make sure this job belongs to the logged-in employer.
        |
        */

        if ((int) $job->employer_id !== (int) $employer->id) {
            abort(403, 'You are not allowed to invite candidates for this job.');
        }


        /*
        |--------------------------------------------------------------------------
        | Check job is active
        |--------------------------------------------------------------------------
        */

        if (!$job->is_active) {
            return back()->with(
                'error',
                'This job is no longer active.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Check duplicate invitation
        |--------------------------------------------------------------------------
        */

        $existing = JobInvitation::where('employer_id', $employer->id)
            ->where('candidate_id', $candidate->id)
            ->where('job_id', $job->id)
            ->first();

        if ($existing) {
            return back()->with(
                'error',
                'This candidate has already been invited for this job.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Create invitation
        |--------------------------------------------------------------------------
        */

        $invitation = JobInvitation::create([
            'employer_id' => $employer->id,
            'candidate_id' => $candidate->id,
            'job_id' => $job->id,
            'token' => Str::random(64),
            'email' => $candidate->email,
            'status' => 'pending',
            'sent_at' => now(),
        ]);


        /*
        |--------------------------------------------------------------------------
        | Send email
        |--------------------------------------------------------------------------
        */

        Mail::to($candidate->email)
            ->send(
                new JobInvitationMail($invitation)
            );


        /*
        |--------------------------------------------------------------------------
        | Success
        |--------------------------------------------------------------------------
        */

        return back()->with(
            'success',
            'Job invitation sent successfully to ' . $candidate->name . '.'
        );
    }
}
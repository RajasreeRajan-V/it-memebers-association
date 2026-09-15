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

class CandidateInvitationController extends Controller
{
    /**
     * Send job invitation to employee.
     */
    public function send(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDATION
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
        | EMPLOYER
        |--------------------------------------------------------------------------
        */

        $employer = Auth::user();

        if (!$employer || $employer->role !== 'employer') {
            abort(403, 'Unauthorized');
        }


        /*
        |--------------------------------------------------------------------------
        | CANDIDATE
        |--------------------------------------------------------------------------
        */

        $candidate = User::findOrFail(
            $request->route('candidate')
        );

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
        | JOB
        |--------------------------------------------------------------------------
        */

        $job = JobPost::findOrFail(
            $request->job_id
        );


        /*
        |--------------------------------------------------------------------------
        | SECURITY
        |--------------------------------------------------------------------------
        */

        if ((int) $job->employer_id !== (int) $employer->id) {
            abort(
                403,
                'You are not allowed to invite candidates for this job.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | ACTIVE JOB CHECK
        |--------------------------------------------------------------------------
        */

        if ((int) $job->is_active !== 1) {
            return back()->with(
                'error',
                'This job is no longer active.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | DUPLICATE INVITATION CHECK
        |--------------------------------------------------------------------------
        */

        $existing = JobInvitation::where(
            'employer_id',
            $employer->id
        )
            ->where(
                'candidate_id',
                $candidate->id
            )
            ->where(
                'job_id',
                $job->id
            )
            ->first();

        if ($existing) {
            return back()->with(
                'error',
                'This candidate has already been invited for this job.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | CREATE INVITATION
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
        | SEND EMAIL
        |--------------------------------------------------------------------------
        */

        Mail::to($candidate->email)
            ->send(
                new JobInvitationMail($invitation)
            );


        /*
        |--------------------------------------------------------------------------
        | SUCCESS
        |--------------------------------------------------------------------------
        */

        return back()->with(
            'success',
            'Job invitation sent successfully to ' .
            $candidate->name .
            '.'
        );
    }


    /**
     * Open invitation from email.
     */
    public function open(string $token)
    {
        $invitation = JobInvitation::where(
            'token',
            $token
        )
            ->with([
                'employer',
                'candidate',
                'job',
            ])
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | MARK INVITATION AS OPENED
        |--------------------------------------------------------------------------
        */

        if (!$invitation->opened_at) {
            $invitation->update([
                'opened_at' => now(),
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | SHOW INVITATION
        |--------------------------------------------------------------------------
        */

        return view(
            'job-invitations.show',
            compact('invitation')
        );
    }
}
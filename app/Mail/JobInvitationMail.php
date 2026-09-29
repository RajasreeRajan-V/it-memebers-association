<?php

namespace App\Mail;

use App\Models\JobInvitation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JobInvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    public JobInvitation $invitation;

    public function __construct(JobInvitation $invitation)
    {
        $this->invitation = $invitation;
    }

    public function build()
    {
        return $this
            ->subject(
                'You are invited to apply for ' .
                $this->invitation->job->title
            )
            ->view('emails.job-invitation');
    }
}
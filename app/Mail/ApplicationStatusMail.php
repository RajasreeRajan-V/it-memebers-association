<?php

namespace App\Mail;

use App\Models\JobApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplicationStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public JobApplication $application;
    public string $event; // 'shortlisted', 'interview_scheduled', 'interview_rescheduled', 'interview_cancelled', 'hired', 'rejected', 'archived'

    public function __construct(JobApplication $application, string $event)
    {
        $this->application = $application;
        $this->event = $event;
    }

    public function build()
    {
        $subjects = [
            'shortlisted'            => 'You have been shortlisted!',
            'interview_scheduled'    => 'Interview Scheduled',
            'interview_rescheduled'  => 'Your Interview Has Been Rescheduled',
            'interview_cancelled'    => 'Your Interview Has Been Cancelled',
            'hired'                  => 'Congratulations — You Got the Job!',
            'rejected'               => 'Update on Your Application',
            'archived'               => 'Update on Your Application',
        ];

        return $this
            ->subject($subjects[$this->event] ?? 'Application Update')
            ->view('emails.application-status')
            ->with([
                'application' => $this->application,
                'event'       => $this->event,
                'candidate'   => $this->application->user,
                'job'         => $this->application->jobPost,
                'employer'    => $this->application->jobPost->employer,
                'interview'   => $this->application->interview,
            ]);
    }
}
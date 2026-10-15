<?php

namespace App\Mail;

use App\Models\EmployeeFreelanceJob;
use App\Models\Project;
use App\Models\EmployeeRegistration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmployeeApplicationAcceptedMail extends Mailable
{
    use Queueable, SerializesModels;

    public EmployeeRegistration $employee;
    public Project $project;
    public EmployeeFreelanceJob $application;

    /**
     * Create a new message instance.
     */
    public function __construct(
        EmployeeRegistration $employee,
        Project $project,
        EmployeeFreelanceJob $application
    ) {
        $this->employee = $employee;
        $this->project = $project;
        $this->application = $application;
    }

    /**
     * Email subject.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Application Has Been Accepted - ' . $this->project->title,
        );
    }

    /**
     * Email content.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.employer.application-accepted',
        );
    }

    /**
     * Attachments.
     */
    public function attachments(): array
    {
        return [];
    }
}
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

class EmployeeApplicationRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    public EmployeeRegistration $employee;
    public Project $project;
    public EmployeeFreelanceJob $application;

    public function __construct(
        EmployeeRegistration $employee,
        Project $project,
        EmployeeFreelanceJob $application
    ) {
        $this->employee = $employee;
        $this->project = $project;
        $this->application = $application;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Application Update - ' . $this->project->title,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.employer.application-rejected',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
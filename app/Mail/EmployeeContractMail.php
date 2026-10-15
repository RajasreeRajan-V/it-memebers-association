<?php

namespace App\Mail;

use App\Models\EmployeeFreelanceJob;
use App\Models\EmployeeRegistration;
use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmployeeContractMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public EmployeeRegistration $employee,
        public Project $project,
        public EmployeeFreelanceJob $application,
        public ?string $note = null
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Contract for ' . $this->project->title,
        );
    }

    public function content(): Content
    {
        
        return new Content(
            view: 'emails.employer.employee-contract',
        );
    }

    public function attachments(): array
    {
        return [
            Attachment::fromStorageDisk('public', $this->application->contract_path)
                ->as('Contract - ' . $this->project->title . '.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
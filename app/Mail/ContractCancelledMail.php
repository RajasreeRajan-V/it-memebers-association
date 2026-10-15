<?php

namespace App\Mail;

use App\Models\EmployeeFreelanceJob;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContractCancelledMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public EmployeeFreelanceJob $application,
        public string $recipientType = 'employee' // 'employee' | 'employer'
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Contract cancelled: ' . $this->application->project->title
        );
    }

    public function content(): Content
    {
        return new Content(view: 'emails.contract-cancelled');
    }
}
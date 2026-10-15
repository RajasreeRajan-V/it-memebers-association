<?php

namespace App\Mail;

use App\Models\EmployeeFreelanceJob;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContractSignedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public EmployeeFreelanceJob $application) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Signed contract received: ' . $this->application->project->title
        );
    }

    public function content(): Content
    {
        return new Content(view: 'emails.contract-signed');
    }

    public function attachments(): array
    {
        return [
            Attachment::fromStorageDisk('public', $this->application->signed_contract_path),
        ];
    }
}
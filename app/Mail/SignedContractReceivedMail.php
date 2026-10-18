<?php

namespace App\Mail;

use App\Models\FreelancerBid;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SignedContractReceivedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public FreelancerBid $bid,
        public string $contractPath
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Signed contract received – ' . ($this->bid->project->title ?? 'Project')
        );
    }

    public function content(): Content
    {
        return new Content(view: 'emails.freelancer.signed-contract-received');
    }

    public function attachments(): array
    {
        return [
            Attachment::fromStorageDisk('local', $this->contractPath)
                ->as(basename($this->contractPath)),
        ];
    }
}
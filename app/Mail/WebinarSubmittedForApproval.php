<?php

namespace App\Mail;

use App\Models\Webinar;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WebinarSubmittedForApproval extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Webinar $webinar)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "New webinar submitted for approval: {$this->webinar->title}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.webinar.submitted-for-approval',
            with: ['webinar' => $this->webinar],
        );
    }
}

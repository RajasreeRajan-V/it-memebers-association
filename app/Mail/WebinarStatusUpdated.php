<?php

namespace App\Mail;

use App\Models\Webinar;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * One mailable covers approved / rejected / published, since they're the
 * same "here's what happened to your submission" message with a different status.
 */
class WebinarStatusUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Webinar $webinar)
    {
    }

    public function envelope(): Envelope
    {
        $subjects = [
            'approved'  => "Your webinar was approved: {$this->webinar->title}",
            'rejected'  => "Your webinar needs changes: {$this->webinar->title}",
            'published' => "Your webinar is now live: {$this->webinar->title}",
        ];

        return new Envelope(
            subject: $subjects[$this->webinar->status] ?? "Update on your webinar: {$this->webinar->title}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.webinar.status-updated',
            with: ['webinar' => $this->webinar],
        );
    }
}

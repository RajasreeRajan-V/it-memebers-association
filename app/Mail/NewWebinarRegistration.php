<?php

namespace App\Mail;

use App\Models\WebinarRegistration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewWebinarRegistration extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public WebinarRegistration $registration)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "New registration: {$this->registration->webinar->title}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.webinar.new-registration',
            with: [
                'registration' => $this->registration,
                'webinar' => $this->registration->webinar,
                'student' => $this->registration->student,
            ],
        );
    }
}

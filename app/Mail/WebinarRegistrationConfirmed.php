<?php

namespace App\Mail;

use App\Models\WebinarRegistration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WebinarRegistrationConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public WebinarRegistration $registration)
    {
    }

    public function envelope(): Envelope
    {
        $waitlisted = $this->registration->status === 'pending';

        return new Envelope(
            subject: $waitlisted
                ? "You're on the waitlist: {$this->registration->webinar->title}"
                : "Registration confirmed: {$this->registration->webinar->title}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.webinar.registration-confirmed',
            with: [
                'registration' => $this->registration,
                'webinar' => $this->registration->webinar,
                'student' => $this->registration->student,
            ],
        );
    }
}

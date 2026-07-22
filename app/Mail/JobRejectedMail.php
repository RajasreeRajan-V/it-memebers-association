<?php

namespace App\Mail;

use App\Models\JobPost;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class JobRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    public JobPost $job;

    public function __construct(JobPost $job)
    {
        $this->job = $job;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your job posting "' . $this->job->title . '"has been rejected',
        );
    }

    public function content(): Content
    {
        return new Content(
           markdown: 'emails.job-rejected',
        );
    }
}
<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Webinar;
use App\Models\WebinarRegistration;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WebinarReminder extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @param  '24h'|'30min'  $type
     */
    public function __construct(
        public Webinar $webinar,
        public WebinarRegistration $registration,
        public User $student,
        public string $type,
    ) {}

    public function build()
    {
        $subject = $this->type === '30min'
            ? "Starting soon: {$this->webinar->title}"
            : "Reminder: {$this->webinar->title} is tomorrow";

        return $this->subject($subject)
            ->view('emails.webinars.reminder');
    }
}
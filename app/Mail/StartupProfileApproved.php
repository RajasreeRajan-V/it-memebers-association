<?php

namespace App\Mail;

use App\Models\StartupProfile;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StartupProfileApproved extends Mailable
{
    use Queueable, SerializesModels;

    public StartupProfile $startup;

    public function __construct(StartupProfile $startup)
    {
        $this->startup = $startup;
    }

    public function build()
    {
        return $this->subject('Your startup profile has been approved')
            ->view('emails.startup-approved')
            ->with(['startup' => $this->startup]);
    }
}

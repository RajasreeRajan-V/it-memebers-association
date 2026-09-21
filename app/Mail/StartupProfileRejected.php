<?php

namespace App\Mail;

use App\Models\StartupProfile;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StartupProfileRejected extends Mailable
{
    use Queueable, SerializesModels;

    public StartupProfile $startup;

    public function __construct(StartupProfile $startup)
    {
        $this->startup = $startup;
    }

    public function build()
    {
        return $this->subject('Your startup profile needs changes')
            ->view('emails.startup-rejected')
            ->with(['startup' => $this->startup]);
    }
}

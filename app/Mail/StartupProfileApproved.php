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
        return $this->subject('Your Startup Profile Has Been Approved')
            ->view('emails.startup.approved');
    }
}
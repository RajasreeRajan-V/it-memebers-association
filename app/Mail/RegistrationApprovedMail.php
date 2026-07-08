<?php

namespace App\Mail;

use App\Models\User;

use Illuminate\Mail\Mailable;



class RegistrationApprovedMail extends Mailable
{

    public User $user;
    public string $password;

    /**
     * @param User   $user     The approved user
     * @param string $password The plaintext (unhashed) generated password
     */
    public function __construct(User $user, string $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    public function build()
    {
        return $this->subject('Your Registration is Approved – Welcome to the Association')
            ->view('emails.registration-approved')
            ->with([
                'name'     => $this->user->name,
                'email'    => $this->user->email,
                'password' => $this->password,
                'loginUrl' => route('membership'), // adjust to your actual login route name
            ]);
    }
}
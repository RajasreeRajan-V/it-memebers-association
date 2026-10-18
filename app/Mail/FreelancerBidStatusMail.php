<?php

namespace App\Mail;

use App\Models\FreelancerBid;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Storage;

class FreelancerBidStatusMail extends Mailable
{
    public function __construct(
        public FreelancerBid $bid,
        public string $approverName,
        public ?string $comments = null,
        public ?string $contractPath = null,
    ) {}

    public function build()
    {
        $subject = $this->bid->status === FreelancerBid::STATUS_ACCEPTED
            ? 'Good news — your bid was accepted (#' . $this->bid->id . ')'
            : 'Update on your bid (#' . $this->bid->id . ')';

        $mail = $this->subject($subject)->markdown('emails.freelancer.bid_status');

        if ($this->contractPath && Storage::disk('local')->exists($this->contractPath)) {
            $extension = pathinfo($this->contractPath, PATHINFO_EXTENSION);

            $mail->attach(
                Storage::disk('local')->path($this->contractPath),
                ['as' => 'Contract-Bid-' . ($this->bid->bid_number ?? $this->bid->id) . '.' . $extension]
            );
        }

        return $mail;
    }
}
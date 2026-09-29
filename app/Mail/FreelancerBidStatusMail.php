<?php

namespace App\Mail;

use App\Models\FreelancerBid;
use Illuminate\Mail\Mailable;

class FreelancerBidStatusMail extends Mailable
{
    public function __construct(
        public FreelancerBid $bid,
        public string $approverName,
        public ?string $comments = null,
    ) {}

    public function build()
    {
        $subject = $this->bid->status === FreelancerBid::STATUS_ACCEPTED
            ? 'Good news — your bid was accepted (#' . $this->bid->id . ')'
            : 'Update on your bid (#' . $this->bid->id . ')';

        return $this->subject($subject)->markdown('emails.freelancer.bid_status');
    }
}
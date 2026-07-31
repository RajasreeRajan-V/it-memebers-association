<?php

namespace App\Mail;

use App\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ArticleApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Article $article)
    {
    }

    public function build()
    {
        return $this->subject('Your article "' . $this->article->title . '" has been approved')
            ->view('emails.articles.approved');
    }
}
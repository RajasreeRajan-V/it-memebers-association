<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\EmployerPortalNotificationHelper;
use App\Mail\ArticleApprovedMail;
use App\Mail\ArticleRejectedMail;
use App\Models\Article;
use App\Models\EmployerPortalNotification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ArticleApprovalController extends Controller
{
    /**
     * List articles awaiting admin review.
     */
    public function index()
    {
        $articles = Article::with('author')
            ->pending()
            ->latest()
            ->paginate(10);

        return view('admin.articles.index', compact('articles'));
    }

    /**
     * Approve an article.
     *
     * After approval:
     * - Article becomes publicly visible.
     * - Employee receives approval email.
     * - All employers receive a notification.
     * - Clicking the employer notification opens the article directly.
     */
    public function approve(Article $article)
    {
        /*
        |--------------------------------------------------------------------------
        | Approve and publish article
        |--------------------------------------------------------------------------
        */

        $article->forceFill([
            'status'       => 'approved',
            'published_at' => now(),
            'reviewed_at'  => now(),
        ])->save();

        /*
        |--------------------------------------------------------------------------
        | Send approval email to article author
        |--------------------------------------------------------------------------
        */

        if ($article->author && $article->author->email) {
            Mail::to($article->author->email)
                ->send(new ArticleApprovedMail($article));
        }

        /*
        |--------------------------------------------------------------------------
        | Notify all employers
        |--------------------------------------------------------------------------
        */

        // Load the article author.
        $article->load('author');

        // Get all employers.
        $employerIds = User::where('role', 'employer')
            ->pluck('id');

        foreach ($employerIds as $employerId) {

            /*
            |--------------------------------------------------------------------------
            | Prevent duplicate notifications
            |--------------------------------------------------------------------------
            */

            $alreadyNotified = EmployerPortalNotification::where(
                'employer_id',
                $employerId
            )
                ->where('type', 'article')
                ->where('reference_id', $article->id)
                ->where('reference_type', 'article')
                ->exists();

            if ($alreadyNotified) {
                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | Create employer notification
            |--------------------------------------------------------------------------
            */

            EmployerPortalNotificationHelper::send(
                employerId: $employerId,
                type: 'article',
                title: 'New Article Published',
                message: ($article->author?->name ?? 'A member')
                    . ' published a new article: "'
                    . $article->title
                    . '".',

                // Clicking the notification opens the article directly.
                url: route('articles.show', $article->slug),

                referenceId: $article->id,
                referenceType: 'article'
            );
        }

        return back()->with(
            'success',
            'Article approved and published.'
        );
    }

    /**
     * Reject an article.
     *
     * Rejected articles remain hidden and do not notify employers.
     */
    public function reject(Request $request, Article $article)
    {
        /*
        |--------------------------------------------------------------------------
        | Validate rejection reason
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'reason' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Reject article
        |--------------------------------------------------------------------------
        */

        $article->forceFill([
            'status'           => 'rejected',
            'rejection_reason' => $validated['reason'] ?? null,
            'reviewed_at'      => now(),
        ])->save();

        /*
        |--------------------------------------------------------------------------
        | Send rejection email to article author
        |--------------------------------------------------------------------------
        */

        if ($article->author && $article->author->email) {
            Mail::to($article->author->email)
                ->send(new ArticleRejectedMail($article));
        }

        /*
        |--------------------------------------------------------------------------
        | No employer notification
        |--------------------------------------------------------------------------
        |
        | Since the article was rejected and is not published,
        | employers should not receive an article notification.
        |--------------------------------------------------------------------------
        */

        return back()->with(
            'success',
            'Article rejected.'
        );
    }
}
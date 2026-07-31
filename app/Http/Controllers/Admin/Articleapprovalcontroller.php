<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ArticleApprovedMail;
use App\Mail\ArticleRejectedMail;
use App\Models\Article;
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
     * Approve an article — it becomes publicly visible on the employee
     * index page, and the employee gets an email.
     */
    public function approve(Article $article)
    {
        // forceFill bypasses $fillable protection entirely — this route is
        // already locked behind auth:admin, so it's safe, and it guarantees
        // the update actually happens even if the model's $fillable array
        // wasn't updated to include these columns.
        $article->forceFill([
            'status'        => 'approved',
            'published_at'  => now(),
            'reviewed_at'   => now(),
        ])->save();

        if ($article->author && $article->author->email) {
            Mail::to($article->author->email)->send(new ArticleApprovedMail($article));
        }

        return back()->with('success', 'Article approved and published.');
    }

    /**
     * Reject an article — it stays hidden from the index page, and the
     * employee gets an email (optionally with a reason from the admin).
     */
    public function reject(Request $request, Article $article)
    {
        $validated = $request->validate([
            'reason' => ['nullable', 'string', 'max:1000'],
        ]);

        $article->forceFill([
            'status'            => 'rejected',
            'rejection_reason'  => $validated['reason'] ?? null,
            'reviewed_at'       => now(),
        ])->save();

        if ($article->author && $article->author->email) {
            Mail::to($article->author->email)->send(new ArticleRejectedMail($article));
        }

        return back()->with('success', 'Article rejected.');
    }
}
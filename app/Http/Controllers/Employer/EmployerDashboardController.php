<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployerDashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'employer') {
            abort(403, 'Unauthorized');
        }

        $latestArticles = Article::with(['author', 'comments.user'])
            ->approved()
            ->latest('published_at')
            ->take(3)
            ->get();

        $likedArticleIds = Auth::check()
            ? ArticleLike::where('user_id', Auth::id())
                ->whereIn('article_id', $latestArticles->pluck('id'))
                ->pluck('article_id')
                ->all()
            : [];

        return view('employers.dashboard', [
            'latestArticles'  => $latestArticles,
            'likedArticleIds' => $likedArticleIds,
        ]);
    }
}
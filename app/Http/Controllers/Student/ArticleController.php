<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleComment;
use App\Models\ArticleLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ArticleController extends Controller
{
    /**
     * Articles hub for students — shows the SAME pool of admin-approved
     * articles as the employee hub (including ones employees wrote and
     * got approved). Students cannot submit articles; there is no
     * create()/store() here.
     */
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'all');
        $category = $request->query('category');
        $sort = $request->query('sort', 'latest');

        if (! Schema::hasTable('articles')) {
            return view('students.articles.index', [
                'activeTab'       => $tab,
                'activeCategory'  => $category,
                'sort'            => $sort,
                'likedArticleIds' => [],
            ]);
        }

        $query = Article::query()
            ->with(['author', 'comments.user'])
            ->approved();

        if ($category) {
            $query->where('category_slug', $category);
        }

        // "tab" controls which subset of articles is shown (all / trending).
        if ($tab === 'trending') {
            $query->orderByDesc('views_count');
        } else {
            // "sort" controls the ordering from the Sort By dropdown.
            match ($sort) {
                'most-viewed' => $query->orderByDesc('views_count'),
                'most-liked'  => $query->orderByDesc('likes_count'),
                default       => $query->latest('published_at'),
            };
        }

        $articles = $query->paginate(5)->withQueryString();

        $likedArticleIds = $request->user()
            ? ArticleLike::where('user_id', $request->user()->id)
                ->whereIn('article_id', $articles->pluck('id'))
                ->pluck('article_id')
                ->all()
            : [];

        $categories = [
            ['slug' => null, 'label' => 'All Articles', 'count' => Article::approved()->count()],
            ['slug' => 'software-development', 'label' => 'Software Development', 'count' => Article::approved()->where('category_slug', 'software-development')->count()],
            ['slug' => 'web-development', 'label' => 'Web Development', 'count' => Article::approved()->where('category_slug', 'web-development')->count()],
            ['slug' => 'mobile-development', 'label' => 'Mobile Development', 'count' => Article::approved()->where('category_slug', 'mobile-development')->count()],
            ['slug' => 'ui-ux-design', 'label' => 'UI/UX Design', 'count' => Article::approved()->where('category_slug', 'ui-ux-design')->count()],
            ['slug' => 'qa-testing', 'label' => 'QA & Testing', 'count' => Article::approved()->where('category_slug', 'qa-testing')->count()],
            ['slug' => 'devops-cloud', 'label' => 'DevOps & Cloud', 'count' => Article::approved()->where('category_slug', 'devops-cloud')->count()],
            ['slug' => 'data-science', 'label' => 'Data Science', 'count' => Article::approved()->where('category_slug', 'data-science')->count()],
            ['slug' => 'data-analytics', 'label' => 'Data Analytics', 'count' => Article::approved()->where('category_slug', 'data-analytics')->count()],
            ['slug' => 'artificial-intelligence', 'label' => 'Artificial Intelligence', 'count' => Article::approved()->where('category_slug', 'artificial-intelligence')->count()],
            ['slug' => 'machine-learning', 'label' => 'Machine Learning', 'count' => Article::approved()->where('category_slug', 'machine-learning')->count()],
            ['slug' => 'cybersecurity', 'label' => 'Cybersecurity', 'count' => Article::approved()->where('category_slug', 'cybersecurity')->count()],
            ['slug' => 'database', 'label' => 'Database Administration', 'count' => Article::approved()->where('category_slug', 'database')->count()],
            ['slug' => 'networking', 'label' => 'Networking', 'count' => Article::approved()->where('category_slug', 'networking')->count()],
            ['slug' => 'system-administration', 'label' => 'System Administration', 'count' => Article::approved()->where('category_slug', 'system-administration')->count()],
            ['slug' => 'it-support', 'label' => 'IT Support & Help Desk', 'count' => Article::approved()->where('category_slug', 'it-support')->count()],
            ['slug' => 'project-management', 'label' => 'Project Management', 'count' => Article::approved()->where('category_slug', 'project-management')->count()],
            ['slug' => 'product-management', 'label' => 'Product Management', 'count' => Article::approved()->where('category_slug', 'product-management')->count()],
            ['slug' => 'business-analysis', 'label' => 'Business Analysis', 'count' => Article::approved()->where('category_slug', 'business-analysis')->count()],
            ['slug' => 'erp-crm', 'label' => 'ERP & CRM', 'count' => Article::approved()->where('category_slug', 'erp-crm')->count()],
            ['slug' => 'blockchain', 'label' => 'Blockchain', 'count' => Article::approved()->where('category_slug', 'blockchain')->count()],
            ['slug' => 'game-development', 'label' => 'Game Development', 'count' => Article::approved()->where('category_slug', 'game-development')->count()],
            ['slug' => 'iot-embedded', 'label' => 'Embedded Systems & IoT', 'count' => Article::approved()->where('category_slug', 'iot-embedded')->count()],
            ['slug' => 'technical-writing', 'label' => 'Technical Writing', 'count' => Article::approved()->where('category_slug', 'technical-writing')->count()],
            ['slug' => 'programming-languages', 'label' => 'Programming Languages', 'count' => Article::approved()->where('category_slug', 'programming-languages')->count()],
            ['slug' => 'frameworks', 'label' => 'Frameworks', 'count' => Article::approved()->where('category_slug', 'frameworks')->count()],
            ['slug' => 'apis', 'label' => 'API Development', 'count' => Article::approved()->where('category_slug', 'apis')->count()],
            ['slug' => 'open-source', 'label' => 'Open Source', 'count' => Article::approved()->where('category_slug', 'open-source')->count()],
            ['slug' => 'software-architecture', 'label' => 'Software Architecture', 'count' => Article::approved()->where('category_slug', 'software-architecture')->count()],
            ['slug' => 'career-advice', 'label' => 'Career Advice', 'count' => Article::approved()->where('category_slug', 'career-advice')->count()],
            ['slug' => 'interview-preparation', 'label' => 'Interview Preparation', 'count' => Article::approved()->where('category_slug', 'interview-preparation')->count()],
        ];

        $trendingArticles = Article::approved()->orderByDesc('views_count')->take(4)->get();

        return view('students.articles.index', [
            'articles'         => $articles,
            'categories'       => $categories,
            'trendingArticles' => $trendingArticles,
            'activeTab'        => $tab,
            'activeCategory'   => $category,
            'sort'             => $sort,
            'likedArticleIds'  => $likedArticleIds,
        ]);
    }

    /**
     * Single article data — used ONLY by the popup modal on the index page.
     * Always returns JSON. Explicitly re-checks "approved" here (unlike the
     * employee controller) so a student can never load an article by
     * guessing an ID for one still pending/rejected.
     */
    public function show(Request $request, Article $article)
    {
        abort_unless($article->status === 'approved', 404);

        $article->increment('views_count');
        $article->refresh();

        $article->load(['author', 'comments.user']);

        $liked = $article->isLikedBy($request->user()?->id);

        $authorName = is_string($article->author ?? null)
            ? $article->author
            : ($article->author->name ?? 'Unknown Author');

        return response()->json([
            'id'             => $article->id,
            'title'          => $article->title,
            'category'       => $article->category,
            'author_name'    => $authorName,
            'published_at'   => optional($article->published_at)->format('M d, Y'),
            'read_minutes'   => $article->read_minutes ?? 5,
            'views_count'    => $article->views_count,
            'image'          => $article->image,
            'body'           => $article->body,
            'liked'          => $liked,
            'likes_count'    => $article->likes_count,
            'comments_count' => $article->comments_count,
            'comments'       => $article->comments->map(fn ($c) => [
                'id'         => $c->id,
                'user_name'  => $c->user->name ?? 'Unknown User',
                'created_at' => $c->created_at->diffForHumans(),
                'body'       => $c->body,
            ]),
        ]);
    }

    public function toggleLike(Request $request, Article $article)
    {
        abort_unless($article->status === 'approved', 404);

        $userId = $request->user()->id;

        $existing = $article->likes()->where('user_id', $userId)->first();

        if ($existing) {
            $existing->delete();
            $article->decrement('likes_count');
            $liked = false;
        } else {
            $article->likes()->create(['user_id' => $userId]);
            $article->increment('likes_count');
            $liked = true;
        }

        return response()->json([
            'liked'       => $liked,
            'likes_count' => $article->fresh()->likes_count,
        ]);
    }

    public function storeComment(Request $request, Article $article)
    {
        abort_unless($article->status === 'approved', 404);

        $validated = $request->validate([
            'body' => ['required', 'string', 'max:1000'],
        ]);

        $comment = $article->comments()->create([
            'user_id' => $request->user()->id,
            'body'    => $validated['body'],
        ]);

        $article->increment('comments_count');

        if ($request->wantsJson()) {
            $comment->load('user');

            return response()->json([
                'id'             => $comment->id,
                'body'           => $comment->body,
                'user_name'      => $comment->user->name ?? 'Unknown User',
                'created_at'     => $comment->created_at->diffForHumans(),
                'is_owner'       => true,
                'comments_count' => $article->fresh()->comments_count,
            ]);
        }

        return back()->with('success', 'Comment added.');
    }

    public function destroyComment(Request $request, ArticleComment $comment)
    {
        abort_unless($comment->user_id === $request->user()->id, 403);

        $article = $comment->article;
        $comment->delete();
        $article->decrement('comments_count');

        if ($request->wantsJson()) {
            return response()->json(['comments_count' => $article->fresh()->comments_count]);
        }

        return back()->with('success', 'Comment deleted.');
    }
}
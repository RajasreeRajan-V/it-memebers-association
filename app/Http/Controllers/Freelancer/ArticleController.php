<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleComment;
use App\Models\ArticleLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Categories shown in the sidebar of the index page (slug => label).
     */
    private const INDEX_CATEGORIES = [
        'software-development'    => 'Software Development',
        'web-development'         => 'Web Development',
        'mobile-development'      => 'Mobile Development',
        'ui-ux-design'            => 'UI/UX Design',
        'qa-testing'              => 'QA & Testing',
        'devops-cloud'            => 'DevOps & Cloud',
        'data-science'            => 'Data Science',
        'data-analytics'          => 'Data Analytics',
        'artificial-intelligence' => 'Artificial Intelligence',
        'machine-learning'        => 'Machine Learning',
        'cybersecurity'           => 'Cybersecurity',
        'database'                => 'Database Administration',
        'networking'              => 'Networking',
        'system-administration'   => 'System Administration',
        'it-support'              => 'IT Support & Help Desk',
        'project-management'      => 'Project Management',
        'product-management'      => 'Product Management',
        'business-analysis'       => 'Business Analysis',
        'erp-crm'                 => 'ERP & CRM',
        'blockchain'              => 'Blockchain',
        'game-development'        => 'Game Development',
        'iot-embedded'            => 'Embedded Systems & IoT',
        'technical-writing'       => 'Technical Writing',
        'programming-languages'   => 'Programming Languages',
        'frameworks'              => 'Frameworks',
        'apis'                    => 'API Development',
        'open-source'             => 'Open Source',
        'software-architecture'   => 'Software Architecture',
        'career-advice'           => 'Career Advice',
        'interview-preparation'   => 'Interview Preparation',
    ];

    /**
     * Categories offered on the "write article" form (slug => label).
     */
    private const CREATE_CATEGORIES = [
        'web-development' => 'Web Development',
        'mobile-dev'      => 'Mobile Development',
        'data-science'    => 'Data Science',
        'ai-ml'           => 'AI / Machine Learning',
        'devops'          => 'DevOps',
        'design'          => 'Design',
        'career-advice'   => 'Career Advice',
        'startup-advice'  => 'Startup Advice',
        'productivity'    => 'Productivity',
    ];

    public function index(Request $request)
    {
        $tab      = $request->query('tab', 'all');
        $category = $request->query('category');
        $sort     = $request->query('sort', 'latest');

        if (! Schema::hasTable('articles')) {
            return view('freelancer.articles.index', [
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

        // "tab" controls which subset of articles is shown (all / trending / latest).
        if ($tab === 'trending') {
            $query->orderByDesc('views_count');
        } else {
            // "sort" controls the ordering picked from the Sort By dropdown.
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

        // One grouped query instead of 30 separate COUNT queries.
        $counts = Article::approved()
            ->selectRaw('category_slug, COUNT(*) as total')
            ->groupBy('category_slug')
            ->pluck('total', 'category_slug');

        $categories = [
            [
                'slug'  => null,
                'label' => 'All Articles',
                'count' => Article::approved()->count(),
            ],
        ];

        foreach (self::INDEX_CATEGORIES as $slug => $label) {
            $categories[] = [
                'slug'  => $slug,
                'label' => $label,
                'count' => (int) ($counts[$slug] ?? 0),
            ];
        }

        $trendingArticles = Article::approved()->orderByDesc('views_count')->take(4)->get();

        return view('freelancer.articles.index', [
            'articles'         => $articles,
            'categories'       => $categories,
            'trendingArticles' => $trendingArticles,
            'activeTab'        => $tab,
            'activeCategory'   => $category,
            'sort'             => $sort,
            'likedArticleIds'  => $likedArticleIds,
        ]);
    }

    public function create()
    {
        $categoryOptions = self::CREATE_CATEGORIES;

        return view('freelancers.articles.create', compact('categoryOptions'));
    }

    /**
     * Persist a new article. It ALWAYS goes in as "pending" — an admin
     * must approve it before it appears on the index page.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'         => ['required', 'string', 'max:255'],
            'category_slug' => ['required', 'string', 'max:100'],
            'excerpt'       => ['nullable', 'string', 'max:500'],
            'body'          => ['required', 'string'],
            'image'         => ['nullable', 'image', 'max:4096'],
            'read_minutes'  => ['nullable', 'integer', 'min:1', 'max:120'],
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
        }

        Article::create([
            'title'         => $validated['title'],
            'slug'          => Str::slug($validated['title']) . '-' . uniqid(),
            'excerpt'       => $validated['excerpt'] ?? Str::limit(strip_tags($validated['body']), 160),
            'body'          => $validated['body'],
            'image'         => $imagePath ? Storage::url($imagePath) : null,
            'category'      => self::CREATE_CATEGORIES[$validated['category_slug']] ?? $validated['category_slug'],
            'category_slug' => $validated['category_slug'],
            'read_minutes'  => $validated['read_minutes'] ?? 5,
            'user_id'       => $request->user()->id,
            'published_at'  => null,        // set only when admin approves
            'status'        => 'pending',   // always starts pending review
        ]);

        return redirect()
            ->route('freelancer.articles.index')
            ->with('success', 'Your article was submitted and is awaiting admin approval.');
    }

    /**
     * Single article data — used ONLY by the popup modal on the index page.
     * Always returns JSON. There is no separate show.blade.php.
     */
    public function show(Request $request, Article $article)
    {
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
<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ArticleController extends Controller
{
    /**
     * Articles hub — categories, filters, tabs, trending sidebar.
     * Only shows articles an admin has APPROVED. Pending/rejected
     * submissions never appear here.
     */
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'all');
        $category = $request->query('category');
        $sort = $request->query('sort', 'latest');

        if (! Schema::hasTable('articles')) {
            return view('employees.articles.index', [
                'activeTab'      => $tab,
                'activeCategory' => $category,
                'sort'           => $sort,
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
            // "sort" controls the ordering the user picked from the Sort By dropdown.
            match ($sort) {
                'most-viewed' => $query->orderByDesc('views_count'),
                'most-liked'  => $query->orderByDesc('likes_count'),
                default       => $query->latest('published_at'),
            };
        }

        $articles = $query->paginate(5)->withQueryString();

        $likedArticleIds = $request->user()
            ? \App\Models\ArticleLike::where('user_id', $request->user()->id)
                ->whereIn('article_id', $articles->pluck('id'))
                ->pluck('article_id')
                ->all()
            : [];

$categories = [
    [
        'slug' => null,
        'label' => 'All Articles',
        'count' => Article::approved()->count(),
    ],

    [
        'slug' => 'software-development',
        'label' => 'Software Development',
        'count' => Article::approved()->where('category_slug', 'software-development')->count(),
    ],

    [
        'slug' => 'web-development',
        'label' => 'Web Development',
        'count' => Article::approved()->where('category_slug', 'web-development')->count(),
    ],

    [
        'slug' => 'mobile-development',
        'label' => 'Mobile Development',
        'count' => Article::approved()->where('category_slug', 'mobile-development')->count(),
    ],

    [
        'slug' => 'ui-ux-design',
        'label' => 'UI/UX Design',
        'count' => Article::approved()->where('category_slug', 'ui-ux-design')->count(),
    ],

    [
        'slug' => 'qa-testing',
        'label' => 'QA & Testing',
        'count' => Article::approved()->where('category_slug', 'qa-testing')->count(),
    ],

    [
        'slug' => 'devops-cloud',
        'label' => 'DevOps & Cloud',
        'count' => Article::approved()->where('category_slug', 'devops-cloud')->count(),
    ],

    [
        'slug' => 'data-science',
        'label' => 'Data Science',
        'count' => Article::approved()->where('category_slug', 'data-science')->count(),
    ],

    [
        'slug' => 'data-analytics',
        'label' => 'Data Analytics',
        'count' => Article::approved()->where('category_slug', 'data-analytics')->count(),
    ],

    [
        'slug' => 'artificial-intelligence',
        'label' => 'Artificial Intelligence',
        'count' => Article::approved()->where('category_slug', 'artificial-intelligence')->count(),
    ],

    [
        'slug' => 'machine-learning',
        'label' => 'Machine Learning',
        'count' => Article::approved()->where('category_slug', 'machine-learning')->count(),
    ],

    [
        'slug' => 'cybersecurity',
        'label' => 'Cybersecurity',
        'count' => Article::approved()->where('category_slug', 'cybersecurity')->count(),
    ],

    [
        'slug' => 'database',
        'label' => 'Database Administration',
        'count' => Article::approved()->where('category_slug', 'database')->count(),
    ],

    [
        'slug' => 'networking',
        'label' => 'Networking',
        'count' => Article::approved()->where('category_slug', 'networking')->count(),
    ],

    [
        'slug' => 'system-administration',
        'label' => 'System Administration',
        'count' => Article::approved()->where('category_slug', 'system-administration')->count(),
    ],

    [
        'slug' => 'it-support',
        'label' => 'IT Support & Help Desk',
        'count' => Article::approved()->where('category_slug', 'it-support')->count(),
    ],

    [
        'slug' => 'project-management',
        'label' => 'Project Management',
        'count' => Article::approved()->where('category_slug', 'project-management')->count(),
    ],

    [
        'slug' => 'product-management',
        'label' => 'Product Management',
        'count' => Article::approved()->where('category_slug', 'product-management')->count(),
    ],

    [
        'slug' => 'business-analysis',
        'label' => 'Business Analysis',
        'count' => Article::approved()->where('category_slug', 'business-analysis')->count(),
    ],

    [
        'slug' => 'erp-crm',
        'label' => 'ERP & CRM',
        'count' => Article::approved()->where('category_slug', 'erp-crm')->count(),
    ],

    [
        'slug' => 'blockchain',
        'label' => 'Blockchain',
        'count' => Article::approved()->where('category_slug', 'blockchain')->count(),
    ],

    [
        'slug' => 'game-development',
        'label' => 'Game Development',
        'count' => Article::approved()->where('category_slug', 'game-development')->count(),
    ],

    [
        'slug' => 'iot-embedded',
        'label' => 'Embedded Systems & IoT',
        'count' => Article::approved()->where('category_slug', 'iot-embedded')->count(),
    ],

    [
        'slug' => 'technical-writing',
        'label' => 'Technical Writing',
        'count' => Article::approved()->where('category_slug', 'technical-writing')->count(),
    ],

    [
        'slug' => 'programming-languages',
        'label' => 'Programming Languages',
        'count' => Article::approved()->where('category_slug', 'programming-languages')->count(),
    ],

    [
        'slug' => 'frameworks',
        'label' => 'Frameworks',
        'count' => Article::approved()->where('category_slug', 'frameworks')->count(),
    ],

    [
        'slug' => 'apis',
        'label' => 'API Development',
        'count' => Article::approved()->where('category_slug', 'apis')->count(),
    ],

    [
        'slug' => 'open-source',
        'label' => 'Open Source',
        'count' => Article::approved()->where('category_slug', 'open-source')->count(),
    ],

    [
        'slug' => 'software-architecture',
        'label' => 'Software Architecture',
        'count' => Article::approved()->where('category_slug', 'software-architecture')->count(),
    ],

    [
        'slug' => 'career-advice',
        'label' => 'Career Advice',
        'count' => Article::approved()->where('category_slug', 'career-advice')->count(),
    ],

    [
        'slug' => 'interview-preparation',
        'label' => 'Interview Preparation',
        'count' => Article::approved()->where('category_slug', 'interview-preparation')->count(),
    ],
];

        $trendingArticles = Article::approved()->orderByDesc('views_count')->take(4)->get();

        return view('employees.articles.index', [
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
        $categoryOptions = [
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

        return view('employees.articles.create', compact('categoryOptions'));
    }

    /**
     * Persist a new article. It ALWAYS goes in as "pending" — an admin
     * must approve it before it appears on the index page.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'          => ['required', 'string', 'max:255'],
            'category_slug'  => ['required', 'string', 'max:100'],
            'excerpt'        => ['nullable', 'string', 'max:500'],
            'body'           => ['required', 'string'],
            'image'          => ['nullable', 'image', 'max:4096'],
            'read_minutes'   => ['nullable', 'integer', 'min:1', 'max:120'],
        ]);

        $categoryLabels = [
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

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
        }

        Article::create([
            'title'          => $validated['title'],
            'slug'           => \Illuminate\Support\Str::slug($validated['title']) . '-' . uniqid(),
            'excerpt'        => $validated['excerpt'] ?? \Illuminate\Support\Str::limit(strip_tags($validated['body']), 160),
            'body'           => $validated['body'],
            'image'          => $imagePath ? \Illuminate\Support\Facades\Storage::url($imagePath) : null,
            'category'       => $categoryLabels[$validated['category_slug']] ?? $validated['category_slug'],
            'category_slug'  => $validated['category_slug'],
            'read_minutes'   => $validated['read_minutes'] ?? 5,
            'user_id'        => $request->user()->id,
            'published_at'   => null,        // set only when admin approves
            'status'         => 'pending',   // always starts pending review
        ]);

        return redirect()
            ->route('employee.articles.index')
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

    public function destroyComment(Request $request, \App\Models\ArticleComment $comment)
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
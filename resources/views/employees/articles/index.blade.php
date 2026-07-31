@extends('layouts.app')

@section('content')

@push('styles')
{{-- Remove this <script> tag if Tailwind is already compiled into your app's build.
     Kept here only so this page renders standalone for preview. --}}
<script src="https://cdn.tailwindcss.com"></script>
<style>
    .line-clamp-2{display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
    .modal-body-text{white-space:pre-line}
</style>
@endpush


@php
    // Fallback demo data so this view also renders when the controller
    // variables aren't wired up yet. Delete this block once $articles,
    // $categories and $trendingArticles are always passed from the controller.
    $categories = $categories ?? [
        ['slug' => null, 'label' => 'All Articles', 'count' => 0],
        ['slug' => 'software-development', 'label' => 'Software Development', 'count' => 0],
        ['slug' => 'web-development', 'label' => 'Web Development', 'count' => 0],
        ['slug' => 'mobile-development', 'label' => 'Mobile Development', 'count' => 0],
        ['slug' => 'ui-ux-design', 'label' => 'UI/UX Design', 'count' => 0],
        ['slug' => 'qa-testing', 'label' => 'QA & Testing', 'count' => 0],
        ['slug' => 'devops-cloud', 'label' => 'DevOps & Cloud', 'count' => 0],
        ['slug' => 'data-science', 'label' => 'Data Science', 'count' => 0],
        ['slug' => 'data-analytics', 'label' => 'Data Analytics', 'count' => 0],
        ['slug' => 'artificial-intelligence', 'label' => 'Artificial Intelligence', 'count' => 0],
        ['slug' => 'machine-learning', 'label' => 'Machine Learning', 'count' => 0],
        ['slug' => 'cybersecurity', 'label' => 'Cybersecurity', 'count' => 0],
        ['slug' => 'database', 'label' => 'Database Administration', 'count' => 0],
        ['slug' => 'networking', 'label' => 'Networking', 'count' => 0],
        ['slug' => 'system-administration', 'label' => 'System Administration', 'count' => 0],
        ['slug' => 'it-support', 'label' => 'IT Support & Help Desk', 'count' => 0],
        ['slug' => 'project-management', 'label' => 'Project Management', 'count' => 0],
        ['slug' => 'product-management', 'label' => 'Product Management', 'count' => 0],
        ['slug' => 'business-analysis', 'label' => 'Business Analysis', 'count' => 0],
        ['slug' => 'erp-crm', 'label' => 'ERP & CRM', 'count' => 0],
        ['slug' => 'blockchain', 'label' => 'Blockchain', 'count' => 0],
        ['slug' => 'game-development', 'label' => 'Game Development', 'count' => 0],
        ['slug' => 'iot-embedded', 'label' => 'Embedded Systems & IoT', 'count' => 0],
        ['slug' => 'technical-writing', 'label' => 'Technical Writing', 'count' => 0],
        ['slug' => 'programming-languages', 'label' => 'Programming Languages', 'count' => 0],
        ['slug' => 'frameworks', 'label' => 'Frameworks', 'count' => 0],
        ['slug' => 'apis', 'label' => 'API Development', 'count' => 0],
        ['slug' => 'open-source', 'label' => 'Open Source', 'count' => 0],
        ['slug' => 'software-architecture', 'label' => 'Software Architecture', 'count' => 0],
        ['slug' => 'career-advice', 'label' => 'Career Advice', 'count' => 0],
        ['slug' => 'interview-preparation', 'label' => 'Interview Preparation', 'count' => 0],
    ];

    $demoArticles = collect([
        (object)[
            'id' => 1, 'title' => 'Building Scalable Web Apps with React.js and TypeScript',
            'excerpt' => 'Learn how to build and structure large-scale web applications using React and TypeScript, with performance and maintainability best practices baked in from the start.',
            'category' => 'Web Development', 'category_slug' => 'web-development',
            'author' => 'John Doe', 'published_at' => now()->subDays(2), 'read_minutes' => 8,
            'views_count' => 3200, 'likes_count' => 128, 'comments_count' => 24,
            'image' => 'https://picsum.photos/seed/article1/480/280',
        ],
        (object)[
            'id' => 2, 'title' => '10 Soft Skills That Make You Stand Out at Work',
            'excerpt' => "Technical skills get you the interview, but soft skills get you the promotion. Here's what actually moves the needle on your team.",
            'category' => 'Career Advice', 'category_slug' => 'career-advice',
            'author' => 'Sarah Wilson', 'published_at' => now()->subDays(4), 'read_minutes' => 6,
            'views_count' => 2100, 'likes_count' => 96, 'comments_count' => 18,
            'image' => 'https://picsum.photos/seed/article2/480/280',
        ],
        (object)[
            'id' => 3, 'title' => "A Beginner's Guide to Machine Learning",
            'excerpt' => 'New to ML? This guide covers the basics: types of ML, real-world examples, and everything you need to get started this weekend.',
            'category' => 'AI / Machine Learning', 'category_slug' => 'ai-ml',
            'author' => 'Michael Chen', 'published_at' => now()->subDays(7), 'read_minutes' => 10,
            'views_count' => 4300, 'likes_count' => 210, 'comments_count' => 41,
            'image' => 'https://picsum.photos/seed/article3/480/280',
        ],
        (object)[
            'id' => 4, 'title' => 'How to Validate Your Startup Idea in 7 Simple Steps',
            'excerpt' => "Validate early, build faster. Radhika shares how 7 simple steps saved her startup months of wasted time and effort.",
            'category' => 'Startup Advice', 'category_slug' => 'startup-advice',
            'author' => 'Radhika Rao', 'published_at' => now()->subDays(9), 'read_minutes' => 7,
            'views_count' => 1800, 'likes_count' => 74, 'comments_count' => 12,
            'image' => 'https://picsum.photos/seed/article4/480/280',
        ],
    ]);

    $articles = $articles ?? $demoArticles;
    $trendingArticles = $trendingArticles ?? $demoArticles->sortByDesc('views_count')->values();
    $activeTab = $activeTab ?? 'all';
    $activeCategory = $activeCategory ?? null;
    $sort = $sort ?? 'latest';
@endphp

<div class="bg-white min-h-screen">

    {{-- ============ HERO (content left, image right) ============ --}}
    <div class="bg-gradient-to-b from-[#F5F8FF] to-white border-b border-slate-100">
        <div class="max-w-6xl mx-auto px-6 py-14 grid md:grid-cols-2 gap-10 items-center">

            {{-- Left: text content --}}
            <div class="flex flex-col items-start text-left">
                <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-blue-700 bg-blue-100/70 px-3.5 py-1.5 rounded-full mb-5">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M13 2 3 14h7l-1 8 11-14h-7l0-6z"/></svg>
                    {{ ($categories[0]['count'] ?? 48) }}+ NEW ARTICLES THIS WEEK
                </span>

                <h1 class="text-4xl sm:text-5xl font-extrabold text-slate-900 leading-tight mb-4">
                    Discover.<br>
                    <span class="text-blue-600">Learn. Grow.</span>
                </h1>

                <p class="text-slate-500 text-base mb-7 max-w-md">
                    Explore expert insights, tutorials, career advice and industry trends
                    published by employers and professionals like you.
                </p>

                <form action="{{ route('employee.articles.index') }}" method="GET"
                      class="w-full flex items-stretch bg-white rounded-xl shadow-lg shadow-blue-900/5 border border-slate-100 p-1.5 mb-6 gap-1">
                    <div class="relative flex-[1.4]">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5" stroke-linecap="round"/>
                        </svg>
                        <input
                            type="text" name="q" value="{{ request('q') }}"
                            placeholder="Search articles, topics..."
                            class="w-full h-full pl-9 pr-3 py-2.5 rounded-lg text-sm text-slate-700 placeholder-slate-400 focus:outline-none"
                        >
                    </div>

                    <div class="w-px bg-slate-200 my-1.5"></div>

                    <div class="relative flex-1">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 6h16M7 12h10M10 18h4"/>
                        </svg>
                        <select name="category" class="w-full h-full appearance-none pl-9 pr-6 py-2.5 rounded-lg text-sm text-slate-700 bg-transparent focus:outline-none cursor-pointer">
                            <option value="">All Categories</option>
                            @foreach ($categories as $cat)
                                @if ($cat['slug'])
                                    <option value="{{ $cat['slug'] }}" {{ $activeCategory === $cat['slug'] ? 'selected' : '' }}>{{ $cat['label'] }}</option>
                                @endif
                            @endforeach
                        </select>
                        <svg class="absolute right-2 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-slate-400 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="m6 9 6 6 6-6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>

                    <button type="submit" class="px-6 py-2.5 rounded-lg bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700 transition shrink-0">
                        Search
                    </button>
                </form>

                {{-- Popular tags — exactly 5, single row --}}
                <div class="flex flex-nowrap items-center justify-start gap-2 text-sm w-full overflow-x-auto">
                    <span class="text-slate-400 font-medium mr-1 shrink-0">Popular:</span>
                    @foreach (['Career Advice', 'Web Dev', 'AIML', 'Productivity'] as $tag)
                        <a href="{{ route('employee.articles.index', ['q' => strip_tags($tag)]) }}"
                           class="shrink-0 px-3.5 py-1.5 rounded-full bg-white border border-slate-200 text-slate-600 hover:border-blue-400 hover:text-blue-600 transition whitespace-nowrap">
                            {!! $tag !!}
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Right: hero image with floating badge cards --}}
            <div class="relative flex justify-center md:justify-end">
                <img
                    src="{{ asset('assets/img/ttt.png') }}"
                    alt="Articles hero"
                    class="w-full max-w-md h-auto rounded-xl object-cover"
                    onerror="this.style.display='none'"
                >

                <div class="absolute top-6 left-0 md:left-4 flex items-center gap-2 bg-white rounded-xl shadow-lg shadow-blue-900/10 px-4 py-2.5">
                    <span class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16v16H4z"/><path d="M8 8h8M8 12h8M8 16h5"/></svg>
                    </span>
                    <span class="text-sm font-semibold text-slate-800 whitespace-nowrap">Tutorials</span>
                </div>

                <div class="absolute bottom-6 left-0 md:-left-6 flex items-center gap-2 bg-white rounded-xl shadow-lg shadow-blue-900/10 px-4 py-2.5">
                    <span class="w-6 h-6 rounded-full bg-emerald-100 flex items-center justify-center shrink-0">
                        <svg class="w-3.5 h-3.5 text-emerald-600" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                    </span>
                    <span class="text-sm font-semibold text-slate-800 whitespace-nowrap">Browse Articles</span>
                </div>
            </div>
        </div>
    </div>

    {{-- ============ BODY ============ --}}
    <div class="max-w-7xl mx-auto px-4 py-8 grid lg:grid-cols-[280px_1fr_300px] gap-6">

        {{-- ---------- LEFT: Filters ---------- --}}
        <aside class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 h-fit lg:sticky lg:top-6">

            {{-- Header --}}
            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                <h3 class="flex items-center gap-2 text-base font-semibold text-slate-800">
                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 6h16M7 12h10M10 18h4"/>
                    </svg>
                    Filters
                </h3>
                <a href="{{ route('employee.articles.index') }}" class="text-sm font-medium text-blue-600 hover:underline">Clear all</a>
            </div>

            {{-- Categories --}}
            <div class="py-4 border-b border-slate-100">
                <h4 class="text-xs font-semibold tracking-widest text-slate-400 uppercase mb-3">Categories</h4>
                <ul class="space-y-1 max-h-72 overflow-y-auto pr-1">
                    @foreach ($categories as $cat)
                        @php
                            $isActive = $activeCategory === $cat['slug'];
                            $catUrl = route('employee.articles.index', array_filter(['category' => $cat['slug']])) . '#browse-articles';
                        @endphp
                        <li>
                            <a href="{{ $catUrl }}"
                               class="flex items-center justify-between px-2.5 py-1.5 rounded-md text-sm transition
                                      {{ $isActive ? 'bg-blue-50 text-blue-600 font-medium' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-800' }}">
                                <span>{{ $cat['label'] }}</span>
                                <span class="text-xs {{ $isActive ? 'text-blue-500' : 'text-slate-400' }}">{{ $cat['count'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <form action="{{ route('employee.articles.index') }}#browse-articles" method="GET">
                <input type="hidden" name="category" value="{{ $activeCategory }}">

                {{-- Sort By --}}
                <div class="py-4">
                    <h4 class="text-xs font-semibold tracking-widest text-slate-400 uppercase mb-3">Sort By</h4>
                    <select name="sort" class="w-full border border-slate-200 rounded-md text-sm py-1.5 px-2 text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500/40">
                        <option value="latest" {{ $sort === 'latest' ? 'selected' : '' }}>Latest</option>
                        <option value="most-viewed" {{ $sort === 'most-viewed' ? 'selected' : '' }}>Most Viewed</option>
                        <option value="most-liked" {{ $sort === 'most-liked' ? 'selected' : '' }}>Most Liked</option>
                    </select>
                </div>

                <button type="submit" class="w-full rounded-lg bg-blue-600 text-white text-sm font-medium py-2 hover:bg-blue-700 transition">
                    Apply Filters
                </button>
            </form>
        </aside>

        {{-- ---------- CENTER: Tabs + Article list ---------- --}}
        <main id="browse-articles">
            <div class="flex items-center justify-between gap-4 mb-5">
                <h2 class="text-[13px] font-bold text-slate-500 uppercase tracking-[0.12em]">Browse Articles</h2>

                {{-- Employees can submit articles for admin review — links to ArticleController@create --}}
                <a href="{{ route('employee.articles.create') }}"
                   class="inline-flex items-center gap-1.5 rounded-lg bg-blue-600 text-white text-sm font-semibold px-4 py-2 hover:bg-blue-700 transition shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 5v14M5 12h14"/>
                    </svg>
                    New Article
                </a>
            </div>

            <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-100 pb-2 mb-5">
                <div class="flex items-center gap-6 text-[15px]">
                    @php
                        $tabs = [
                            'all' => 'All Articles',
                        ];
                    @endphp
                    @foreach ($tabs as $key => $label)
                        <a href="{{ route('employee.articles.index', array_filter(['tab' => $key, 'category' => $activeCategory])) }}#browse-articles"
                           class="pb-2 -mb-[9px] border-b-2 font-semibold tracking-tight transition
                                  {{ $activeTab === $key ? 'border-blue-600 text-blue-600' : 'border-transparent text-slate-500 hover:text-slate-700' }}">
                            {{ $label }}
                        </a>
                    @endforeach
                </div>

                <label class="flex items-center gap-2 text-sm font-medium text-slate-500">
                    Sort by:
                    <select name="sort" onchange="updateSort(this.value)" class="border border-slate-200 rounded-md text-sm font-medium py-1.5 px-2.5 text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500/40">
                        <option value="latest" {{ $sort === 'latest' ? 'selected' : '' }}>Latest</option>
                        <option value="most-viewed" {{ $sort === 'most-viewed' ? 'selected' : '' }}>Most Viewed</option>
                        <option value="most-liked" {{ $sort === 'most-liked' ? 'selected' : '' }}>Most Liked</option>
                    </select>
                </label>
            </div>

            <div class="space-y-3">
                @forelse ($articles as $article)
                    <article class="bg-white border border-slate-200 rounded-xl px-4 py-3.5 hover:shadow-sm hover:border-slate-300 transition">
                        <div class="flex items-start gap-3">
                            <button type="button" class="article-open-btn shrink-0" data-article-id="{{ $article->id }}">
                                <img src="{{ $article->image }}" alt="{{ $article->title }}"
                                     class="w-11 h-11 sm:w-12 sm:h-12 object-cover rounded-lg bg-slate-100">
                            </button>

                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-3">
                                    <div class="min-w-0">
                                        <div class="flex items-center flex-wrap gap-2">
                                            <button type="button" class="article-open-btn text-left" data-article-id="{{ $article->id }}">
                                                <h2 class="text-[14.5px] font-bold text-slate-900 hover:text-blue-600 transition leading-snug tracking-tight">
                                                    {{ $article->title }}
                                                </h2>
                                            </button>
                                            <span class="inline-flex items-center gap-1 text-[10px] font-bold tracking-wide text-amber-700 bg-amber-50 px-2 py-0.5 rounded-full uppercase shrink-0">
                                                {{ $article->category }}
                                            </span>
                                        </div>

                                        @php
                                            $authorName = is_string($article->author ?? null)
                                                ? $article->author
                                                : ($article->author->name ?? 'Unknown Author');
                                        @endphp
                                        <p class="text-[12.5px] text-slate-500 font-medium mt-1 truncate">
                                            {{ $authorName }} · {{ $article->read_minutes ?? 5 }} min read
                                        </p>
                                    </div>

                                    <div class="text-right shrink-0">
                                        <p class="text-emerald-600 font-bold text-[13.5px] flex items-center justify-end gap-1">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/></svg>
                                            {{ number_format($article->views_count) }}
                                        </p>
                                        <p class="text-[11.5px] text-slate-400 font-medium mt-1">
                                            {{ optional($article->published_at)->diffForHumans() ?? 'Draft' }}
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-2 mt-2.5">
                                

                                    <span class="ml-auto flex items-center gap-3">
                                        <button
                                            type="button"
                                            class="like-btn flex items-center gap-1 text-[12.5px] font-medium transition {{ in_array($article->id, $likedArticleIds ?? []) ? 'text-red-500' : 'text-slate-400 hover:text-red-400' }}"
                                            data-article-id="{{ $article->id }}"
                                            data-liked="{{ in_array($article->id, $likedArticleIds ?? []) ? '1' : '0' }}"
                                        >
                                            <svg class="like-icon w-3.5 h-3.5" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                                 fill="{{ in_array($article->id, $likedArticleIds ?? []) ? 'currentColor' : 'none' }}">
                                                <path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 1 0-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 0 0 0-7.8z"/>
                                            </svg>
                                            <span class="like-count">{{ $article->likes_count }}</span>
                                        </button>

                                        <button type="button"
                                                class="comment-toggle-btn flex items-center gap-1 text-[12.5px] font-medium text-slate-400 hover:text-blue-600"
                                                data-article-id="{{ $article->id }}">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 11.5a8.38 8.38 0 0 1-8.5 8.5 8.5 8.5 0 1 1 8.5-8.5z"/><path d="M8 10h8M8 14h5" stroke-linecap="round"/></svg>
                                            <span class="comment-count">{{ $article->comments_count }}</span>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>

                            {{-- Inline comment panel — hidden until the comment icon is clicked --}}
                            <div id="comments-panel-{{ $article->id }}" class="hidden mt-4 pt-4 border-t border-slate-100">
                                <form class="comment-form flex items-start gap-2 mb-4" data-article-id="{{ $article->id }}">
                                    @csrf
                                    <div class="relative flex-1">
                                        <textarea
                                            name="body" rows="2" required maxlength="1000"
                                            placeholder="Write a comment..."
                                            class="comment-textarea w-full rounded-md border border-slate-200 pl-3 pr-9 py-2 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-400"
                                        ></textarea>
                                        <button type="button" class="emoji-toggle-btn absolute right-2 bottom-2 text-slate-400 hover:text-amber-500 transition" aria-label="Add emoji">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M8.5 14s1.2 2 3.5 2 3.5-2 3.5-2" stroke-linecap="round"/><path d="M9 9h.01M15 9h.01" stroke-linecap="round"/></svg>
                                        </button>
                                        <div class="emoji-picker hidden absolute bottom-10 right-0 z-30 bg-white border border-slate-200 rounded-lg shadow-lg p-2 grid grid-cols-6 gap-1 w-56">
                                            @foreach (['😀','😂','😍','😊','👍','🙌','🎉','🔥','😢','😮','❤️','👏','🤔','😎','🙏','💯','😅','🥳'] as $emoji)
                                                <button type="button" class="emoji-option text-lg leading-none hover:bg-slate-100 rounded p-1">{{ $emoji }}</button>
                                            @endforeach
                                        </div>
                                    </div>
                                    <button type="submit" class="rounded-md bg-blue-600 text-white text-sm font-semibold px-4 py-2 hover:bg-blue-700 transition shrink-0">
                                        Post
                                    </button>
                                </form>

                                <div class="comment-list space-y-3">
                                    @foreach ($article->comments as $comment)
                                        <div class="flex gap-2.5" data-comment-id="{{ $comment->id }}">
                                            <span class="w-7 h-7 rounded-full bg-slate-200 inline-flex items-center justify-center text-xs font-bold text-slate-500 shrink-0">
                                                {{ strtoupper(substr($comment->user->name ?? 'U', 0, 1)) }}
                                            </span>
                                            <div class="min-w-0">
                                                <div class="flex items-center gap-2">
                                                    <p class="text-sm font-semibold text-slate-700">{{ $comment->user->name ?? 'Unknown User' }}</p>
                                                    <p class="text-xs font-medium text-slate-400">{{ $comment->created_at->diffForHumans() }}</p>
                                                </div>
                                                <p class="text-sm text-slate-600 mt-0.5 leading-relaxed">{{ $comment->body }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                    @if ($article->comments->isEmpty())
                                        <p class="no-comments-msg text-sm text-slate-400">No comments yet — be the first to share your thoughts.</p>
                                    @endif
                                </div>
                            </div>
                    </article>
                @empty
                    <div class="text-center text-slate-400 py-14 text-base font-medium">
                        No articles found. Try a different search or filter.
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if (isset($articles) && method_exists($articles, 'links'))
                <div class="mt-6">{{ $articles->links() }}</div>
            @endif
        </main>

        {{-- ---------- RIGHT: Trending + Newsletter ---------- --}}
        <aside class="space-y-6">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-xs font-semibold tracking-widest text-slate-400 uppercase">Trending Articles</h3>
                    <a href="{{ route('employee.articles.index', ['tab' => 'trending']) }}#browse-articles" class="text-sm font-medium text-blue-600 hover:underline">View All</a>
                </div>
                <ul class="space-y-4">
                    @foreach ($trendingArticles->take(4) as $t)
                        <li>
                            <button type="button" class="article-open-btn flex gap-3 group text-left w-full" data-article-id="{{ $t->id }}">
                                <img src="{{ $t->image }}" alt="{{ $t->title }}" class="w-14 h-14 rounded-md object-cover shrink-0 bg-slate-100">
                                <div class="min-w-0">
                                    <p class="text-sm font-medium text-slate-800 group-hover:text-blue-600 leading-snug line-clamp-2">
                                        {{ $t->title }}
                                    </p>
                                    <p class="text-xs text-slate-400 mt-1">{{ $t->read_minutes }} min read</p>
                                </div>
                            </button>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="rounded-xl bg-gradient-to-br from-blue-600 to-blue-500 p-6 text-white">
                <h3 class="font-semibold text-lg mb-3">Explore the Latest Tech Insights</h3>

                <p class="text-sm text-blue-100 leading-6 mb-5">
                    Discover expert-written articles on software development, AI, cybersecurity,
                    cloud computing, data science, DevOps, mobile development, UI/UX, and many
                    more IT topics. Stay informed with practical guides, industry trends, and
                    best practices to grow your technical knowledge and career.
                </p>

                <div class="space-y-2 text-sm">
                    <div class="flex items-center gap-2">
                        <span>📘</span>
                        <span>Expert Technical Articles</span>
                    </div>

                    <div class="flex items-center gap-2">
                        <span>💡</span>
                        <span>Programming Tips & Tutorials</span>
                    </div>

                    <div class="flex items-center gap-2">
                        <span>🚀</span>
                        <span>Latest Technology Trends</span>
                    </div>

                    <div class="flex items-center gap-2">
                        <span>🎯</span>
                        <span>Career Growth & Best Practices</span>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</div>

{{-- ============ ARTICLE POPUP MODAL ============ --}}
<div id="article-modal-overlay" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4 pt-20 overflow-y-auto">
    <div class="bg-white rounded-xl max-w-2xl w-full my-8 relative shadow-2xl max-h-[90vh] flex flex-col">
        <button id="modal-close-btn" type="button"
                class="absolute top-5 right-5 w-9 h-9 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 flex items-center justify-center text-slate-500 hover:text-slate-800 shadow-sm z-20">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round"><path d="M6 6l12 12M18 6L6 18"/></svg>
        </button>

        <div id="modal-loading" class="p-16 text-center text-slate-400 text-sm">
            Loading article...
        </div>

        <div id="modal-content" class="hidden p-8 overflow-y-auto">
            <span id="modal-category" class="inline-block text-xs font-semibold tracking-wide text-blue-600 bg-blue-50 px-2.5 py-1 rounded-full mb-2 uppercase"></span>
            <h2 id="modal-title" class="text-2xl font-bold text-slate-900 leading-snug mb-3"></h2>

            <div class="flex flex-wrap items-center gap-4 text-sm text-slate-400 pb-4 border-b border-slate-100 mb-5">
                <span class="flex items-center gap-2">
                    <span id="modal-author-initial" class="w-6 h-6 rounded-full bg-slate-200 inline-flex items-center justify-center text-xs font-semibold text-slate-500"></span>
                    <span id="modal-author-name"></span>
                </span>
                <span id="modal-date"></span>
                <span id="modal-read-minutes"></span>

                <span class="ml-auto flex items-center gap-4">
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/></svg>
                        <span id="modal-views-count"></span>
                    </span>

                    <button type="button" id="modal-like-btn" class="like-btn flex items-center gap-1.5 transition text-slate-400 hover:text-red-400">
                        <svg class="like-icon w-4 h-4" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none">
                            <path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 1 0-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 0 0 0-7.8z"/>
                        </svg>
                        <span class="like-count" id="modal-like-count"></span>
                    </button>

                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 11.5a8.38 8.38 0 0 1-8.5 8.5 8.5 8.5 0 1 1 8.5-8.5z"/><path d="M8 10h8M8 14h5" stroke-linecap="round"/></svg>
                        <span class="comment-count" id="modal-comments-count"></span>
                    </span>
                </span>
            </div>

            <img id="modal-image" alt="" class="w-full h-56 object-cover rounded-lg bg-slate-100 mb-5">

            <div id="modal-body" class="modal-body-text text-base text-slate-700 leading-relaxed mb-6"></div>

            {{-- Comments — reuses the same .comment-form / .comment-list pattern as the cards --}}
            <div class="border-t border-slate-100 pt-5">
                <h3 class="text-xs font-semibold tracking-widest text-slate-400 uppercase mb-3">Comments</h3>

                <form class="comment-form flex items-start gap-2 mb-4" id="modal-comment-form" data-article-id="">
                    @csrf
                    <div class="relative flex-1">
                        <textarea
                            name="body" rows="2" required maxlength="1000"
                            placeholder="Write a comment..."
                            class="comment-textarea w-full rounded-md border border-slate-200 pl-3 pr-9 py-2 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-400"
                        ></textarea>
                        <button type="button" class="emoji-toggle-btn absolute right-2 bottom-2 text-slate-400 hover:text-amber-500 transition" aria-label="Add emoji">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M8.5 14s1.2 2 3.5 2 3.5-2 3.5-2" stroke-linecap="round"/><path d="M9 9h.01M15 9h.01" stroke-linecap="round"/></svg>
                        </button>
                        <div class="emoji-picker hidden absolute bottom-10 right-0 z-30 bg-white border border-slate-200 rounded-lg shadow-lg p-2 grid grid-cols-6 gap-1 w-56">
                            @foreach (['😀','😂','😍','😊','👍','🙌','🎉','🔥','😢','😮','❤️','👏','🤔','😎','🙏','💯','😅','🥳'] as $emoji)
                                <button type="button" class="emoji-option text-lg leading-none hover:bg-slate-100 rounded p-1">{{ $emoji }}</button>
                            @endforeach
                        </div>
                    </div>
                    <button type="submit" class="rounded-md bg-blue-600 text-white text-sm font-medium px-4 py-2 hover:bg-blue-700 transition shrink-0">
                        Post
                    </button>
                </form>

                <div class="comment-list space-y-3" id="modal-comment-list"></div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
    const csrfToken = csrfMeta ? csrfMeta.getAttribute('content') : null;

    function buildCommentEl(c) {
        const el = document.createElement('div');
        el.className = 'flex gap-2.5';
        el.dataset.commentId = c.id;

        const avatar = document.createElement('span');
        avatar.className = 'w-7 h-7 rounded-full bg-slate-200 inline-flex items-center justify-center text-xs font-semibold text-slate-500 shrink-0';
        avatar.textContent = c.user_name.charAt(0).toUpperCase();

        const wrap = document.createElement('div');
        wrap.className = 'min-w-0';
        wrap.innerHTML = `
            <div class="flex items-center gap-2">
                <p class="text-sm font-semibold text-slate-700"></p>
                <p class="text-xs text-slate-400"></p>
            </div>
            <p class="text-sm text-slate-600 mt-0.5"></p>
        `;
        wrap.querySelectorAll('p')[0].textContent = c.user_name;
        wrap.querySelectorAll('p')[1].textContent = c.created_at;
        wrap.querySelectorAll('p')[2].textContent = c.body;

        el.appendChild(avatar);
        el.appendChild(wrap);
        return el;
    }

    /* ---------- SORT BY (toolbar dropdown — not inside a <form>, so we build the URL ourselves) ---------- */
    window.updateSort = function (value) {
        const url = new URL(window.location.href);
        url.searchParams.set('sort', value);
        url.hash = 'browse-articles'; // land back on the article list, not the hero section
        window.location.href = url.toString();
    };

    // If the page loaded with #browse-articles in the URL (e.g. after changing
    // sort/category/tab), scroll straight to that section instead of the top.
    // We wait for the full "load" event (not just DOMContentLoaded) and add a
    // short delay, because the Tailwind CDN script injects styles after the
    // initial paint and reflows the page — scrolling too early lands in the
    // wrong spot once that reflow happens.
    function scrollToBrowseArticles() {
        if (window.location.hash === '#browse-articles') {
            const target = document.getElementById('browse-articles');
            if (target) target.scrollIntoView({ block: 'start' });
        }
    }
    if (document.readyState === 'complete') {
        setTimeout(scrollToBrowseArticles, 150);
    } else {
        window.addEventListener('load', function () {
            setTimeout(scrollToBrowseArticles, 150);
        });
    }

    /* ---------- ARTICLE MODAL ---------- */
    const overlay = document.getElementById('article-modal-overlay');
    const loadingEl = document.getElementById('modal-loading');
    const contentEl = document.getElementById('modal-content');

    async function openArticleModal(articleId) {
        overlay.classList.remove('hidden');
        loadingEl.classList.remove('hidden');
        loadingEl.textContent = 'Loading article...';
        contentEl.classList.add('hidden');
        document.body.style.overflow = 'hidden';

        try {
            // NOTE: employee-scoped endpoint — only ever returns approved articles.
            const response = await fetch(`/employee/articles/${articleId}`, {
                headers: { 'Accept': 'application/json' },
            });

            if (!response.ok) throw new Error('Failed to load article');

            const a = await response.json();

            document.getElementById('modal-category').textContent = a.category ?? '';
            document.getElementById('modal-title').textContent = a.title ?? '';
            document.getElementById('modal-author-initial').textContent = (a.author_name || 'U').charAt(0).toUpperCase();
            document.getElementById('modal-author-name').textContent = a.author_name ?? '';
            document.getElementById('modal-date').textContent = a.published_at ?? '';
            document.getElementById('modal-read-minutes').textContent = `${a.read_minutes ?? 5} min read`;
            document.getElementById('modal-views-count').textContent = a.views_count ?? 0;
            document.getElementById('modal-image').src = a.image ?? '';
            document.getElementById('modal-image').classList.toggle('hidden', !a.image);
            document.getElementById('modal-body').textContent = a.body ?? '';

            const likeBtn = document.getElementById('modal-like-btn');
            likeBtn.dataset.articleId = a.id;
            document.getElementById('modal-like-count').textContent = a.likes_count ?? 0;
            if (a.liked) {
                likeBtn.classList.remove('text-slate-400', 'hover:text-red-400');
                likeBtn.classList.add('text-red-500');
                likeBtn.querySelector('.like-icon').setAttribute('fill', 'currentColor');
            } else {
                likeBtn.classList.remove('text-red-500');
                likeBtn.classList.add('text-slate-400', 'hover:text-red-400');
                likeBtn.querySelector('.like-icon').setAttribute('fill', 'none');
            }

            document.getElementById('modal-comments-count').textContent = a.comments_count ?? 0;
            const commentForm = document.getElementById('modal-comment-form');
            commentForm.dataset.articleId = a.id;
            commentForm.querySelector('textarea').value = '';

            const list = document.getElementById('modal-comment-list');
            list.innerHTML = '';
            if (a.comments && a.comments.length) {
                a.comments.forEach(c => list.appendChild(buildCommentEl(c)));
            } else {
                const p = document.createElement('p');
                p.className = 'no-comments-msg text-sm text-slate-400';
                p.textContent = 'No comments yet — be the first to share your thoughts.';
                list.appendChild(p);
            }

            loadingEl.classList.add('hidden');
            contentEl.classList.remove('hidden');
        } catch (err) {
            console.error('Failed to open article:', err);
            loadingEl.textContent = 'Could not load this article. Please try again.';
        }
    }

    function closeArticleModal() {
        overlay.classList.add('hidden');
        document.body.style.overflow = '';
    }

    document.querySelectorAll('.article-open-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            openArticleModal(btn.dataset.articleId);
        });
    });

    document.getElementById('modal-close-btn').addEventListener('click', closeArticleModal);
    overlay.addEventListener('click', function (e) {
        if (e.target === overlay) closeArticleModal();
    });
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && !overlay.classList.contains('hidden')) closeArticleModal();
    });

    /* ---------- LIKE BUTTONS (event delegation — works for cards AND modal) ---------- */
    document.addEventListener('click', async function (e) {
        const btn = e.target.closest('.like-btn');
        if (!btn) return;

        const articleId = btn.dataset.articleId;
        if (!articleId) return;

        if (!csrfToken) {
            alert('Missing <meta name="csrf-token"> tag in your layout <head> — likes can\'t be saved without it.');
            return;
        }

        try {
            const response = await fetch(`/employee/articles/${articleId}/like`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
            });

            if (!response.ok) throw new Error('Request failed');

            const data = await response.json();

            document.querySelectorAll(`.like-btn[data-article-id="${articleId}"]`).forEach(function (b) {
                const i = b.querySelector('.like-icon');
                const c = b.querySelector('.like-count');
                c.textContent = data.likes_count;
                if (data.liked) {
                    b.classList.remove('text-slate-400', 'hover:text-red-400');
                    b.classList.add('text-red-500');
                    i.setAttribute('fill', 'currentColor');
                } else {
                    b.classList.remove('text-red-500');
                    b.classList.add('text-slate-400', 'hover:text-red-400');
                    i.setAttribute('fill', 'none');
                }
            });
        } catch (err) {
            console.error('Failed to toggle like:', err);
        }
    });

    /* ---------- COMMENT TOGGLE (cards only — modal comments are always visible) ---------- */
    document.addEventListener('click', function (e) {
        const btn = e.target.closest('.comment-toggle-btn');
        if (!btn) return;
        const panel = document.getElementById(`comments-panel-${btn.dataset.articleId}`);
        if (panel) panel.classList.toggle('hidden');
    });

    /* ---------- COMMENT SUBMIT (event delegation — works for cards AND modal) ---------- */
    document.addEventListener('submit', async function (e) {
        const form = e.target.closest('.comment-form');
        if (!form) return;
        e.preventDefault();

        const articleId = form.dataset.articleId;
        const textarea = form.querySelector('textarea[name="body"]');
        const submitBtn = form.querySelector('button[type="submit"]');
        const body = textarea.value.trim();
        if (!body || !articleId) return;

        if (!csrfToken) {
            alert('Missing <meta name="csrf-token"> tag in your layout <head> — comments can\'t be posted without it.');
            return;
        }

        submitBtn.disabled = true;

        try {
            const formData = new FormData();
            formData.append('body', body);

            const response = await fetch(`/employee/articles/${articleId}/comments`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: formData,
            });

            if (response.status === 419) {
                alert('Session expired (CSRF token mismatch). Please refresh the page and try again.');
                return;
            }
            if (response.status === 422) {
                const errorData = await response.json();
                alert('Could not post comment: ' + Object.values(errorData.errors).flat().join(' '));
                return;
            }
            if (!response.ok) {
                alert(`Could not post comment (server returned ${response.status}).`);
                console.error('Comment post failed:', response.status, await response.text());
                return;
            }

            const data = await response.json();

            const isModalForm = form.id === 'modal-comment-form';
            const list = isModalForm
                ? document.getElementById('modal-comment-list')
                : document.getElementById(`comments-panel-${articleId}`).querySelector('.comment-list');

            const emptyMsg = list.querySelector('.no-comments-msg');
            if (emptyMsg) emptyMsg.remove();

            list.appendChild(buildCommentEl({
                id: data.id,
                user_name: data.user_name,
                created_at: data.created_at,
                body: data.body,
            }));

            const cardCountEl = document.querySelector(`.comment-toggle-btn[data-article-id="${articleId}"] .comment-count`);
            if (cardCountEl) cardCountEl.textContent = data.comments_count;
            const modalCountEl = document.getElementById('modal-comments-count');
            if (isModalForm && modalCountEl) modalCountEl.textContent = data.comments_count;

            textarea.value = '';
        } catch (err) {
            console.error('Failed to post comment:', err);
            alert('Something went wrong posting your comment — check the browser console for details.');
        } finally {
            submitBtn.disabled = false;
        }
    });

    /* ---------- EMOJI PICKER (event delegation — works for cards AND modal) ---------- */
    document.addEventListener('click', function (e) {
        const toggleBtn = e.target.closest('.emoji-toggle-btn');
        if (toggleBtn) {
            const picker = toggleBtn.parentElement.querySelector('.emoji-picker');
            // close any other open pickers first
            document.querySelectorAll('.emoji-picker').forEach(function (p) {
                if (p !== picker) p.classList.add('hidden');
            });
            if (picker) picker.classList.toggle('hidden');
            return;
        }

        const emojiOption = e.target.closest('.emoji-option');
        if (emojiOption) {
            const picker = emojiOption.closest('.emoji-picker');
            const textarea = picker.parentElement.querySelector('.comment-textarea');
            if (textarea) {
                const start = textarea.selectionStart ?? textarea.value.length;
                const end = textarea.selectionEnd ?? textarea.value.length;
                const emoji = emojiOption.textContent;
                textarea.value = textarea.value.slice(0, start) + emoji + textarea.value.slice(end);
                const newPos = start + emoji.length;
                textarea.focus();
                textarea.setSelectionRange(newPos, newPos);
            }
            picker.classList.add('hidden');
            return;
        }

        // clicking anywhere else closes any open picker
        if (!e.target.closest('.emoji-picker')) {
            document.querySelectorAll('.emoji-picker').forEach(function (p) {
                p.classList.add('hidden');
            });
        }
    });

    /* ---------- AUTO-OPEN MODAL if ?article=ID is present (e.g. from dashboard links) ---------- */
    const params = new URLSearchParams(window.location.search);
    const openId = params.get('article');
    if (openId) openArticleModal(openId);
});
</script>
@endsection
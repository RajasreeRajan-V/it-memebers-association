@extends('layouts.app')

@section('title', 'Articles')

@section('content')

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

<style>
    :root {
        --job-primary: #3376F2;
        --job-primary-dark: #245ED1;
        --job-purple: #7C4DFF;
        --job-bg: #F6F8FC;
        --job-card: #FFFFFF;
        --job-text: #172033;
        --job-muted: #6B7280;
        --job-border: #E6EAF0;
        --job-success: #16A34A;
        --job-warning: #F59E0B;
        --job-danger: #EF4444;
        --job-shadow: 0 8px 28px rgba(31, 41, 55, 0.07);
    }

    * { box-sizing: border-box; }

    /* =========================================================
       PAGE
    ========================================================= */

    .student-articles-page {
        background: var(--job-bg);
        min-height: calc(100vh - 80px);
        padding: 34px 0 60px;
        color: var(--job-text);
    }

    .articles-page-container {
        width: min(1320px, calc(100% - 40px));
        margin: 0 auto;
    }

    /* =========================================================
       HERO
    ========================================================= */

    .articles-hero {
        background: #fff;
        border: 1px solid var(--job-border);
        border-radius: 24px;
        padding: 44px 46px;
        position: relative;
        overflow: hidden;
        margin-bottom: 28px;
        box-shadow: var(--job-shadow);
    }

    .articles-hero::before {
        content: "";
        position: absolute;
        width: 260px;
        height: 260px;
        border-radius: 50%;
        background: #EEF4FF;
        top: -150px;
        right: -90px;
        opacity: .75;
    }

    .articles-hero::after {
        content: "";
        position: absolute;
        width: 190px;
        height: 190px;
        border-radius: 50%;
        background: #F3EEFF;
        bottom: -130px;
        left: -80px;
        opacity: .55;
    }

    .articles-hero-grid {
        position: relative;
        z-index: 2;
        display: grid;
        grid-template-columns: 1.15fr 1fr;
        gap: 30px;
        align-items: center;
    }

    .articles-hero-left { min-width: 0; }

    .articles-hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #EAF1FF;
        color: var(--job-primary);
        border: 1px solid #D9E6FF;
        padding: 7px 15px;
        border-radius: 999px;
        font-size: 12.5px;
        font-weight: 700;
        margin-bottom: 18px;
    }

    .articles-hero-title {
        font-size: 36px;
        line-height: 1.18;
        font-weight: 800;
        margin: 0 0 14px;
        letter-spacing: -0.7px;
        color: var(--job-text);
    }

    .articles-hero-title span {
        display: block;
        background: linear-gradient(90deg, var(--job-primary), var(--job-purple));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    .articles-hero-text {
        margin: 0 0 25px;
        font-size: 15px;
        line-height: 1.75;
        color: var(--job-muted);
        max-width: 520px;
    }

    /* SEARCH */

    .articles-hero-search {
        display: flex;
        align-items: stretch;
        width: 100%;
        max-width: 680px;
        background: #fff;
        border: 1px solid #DDE3EC;
        border-radius: 13px;
        padding: 5px;
        box-shadow: 0 10px 24px rgba(31, 41, 55, .06);
    }

    .articles-search-field {
        flex: 1.4;
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 0 12px;
        min-width: 0;
    }

    .articles-search-field svg { color: #9AA3B2; flex-shrink: 0; }

    .articles-search-field input,
    .articles-search-field select {
        width: 100%;
        border: none;
        outline: none;
        background: transparent;
        color: var(--job-text);
        font-size: 13px;
        min-width: 0;
        padding: 11px 0;
        appearance: none;
    }

    .articles-search-field input::placeholder { color: #9AA3B2; }

    .articles-search-divider {
        width: 1px;
        background: #E7EBF1;
        margin: 7px 0;
    }

    .articles-hero-search button {
        border: 0;
        background: var(--job-primary);
        color: #fff;
        border-radius: 9px;
        padding: 0 22px;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        transition: .2s ease;
        white-space: nowrap;
    }

    .articles-hero-search button:hover {
        background: var(--job-primary-dark);
        transform: translateY(-1px);
    }

    /* POPULAR TAGS */

    .articles-popular {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 14px;
        overflow-x: auto;
        white-space: nowrap;
        scrollbar-width: none;
    }

    .articles-popular::-webkit-scrollbar { display: none; }

    .articles-popular > span {
        color: #9AA3B2;
        font-size: 12px;
        font-weight: 600;
    }

    .articles-popular a {
        text-decoration: none;
        color: #5F6877;
        border: 1px solid #DDE3EC;
        background: #fff;
        padding: 6px 12px;
        border-radius: 999px;
        font-size: 11px;
        transition: .2s ease;
    }

    .articles-popular a:hover {
        color: var(--job-primary);
        border-color: #BFD4FF;
        background: #F8FAFF;
    }

    /* HERO RIGHT */

    .articles-hero-right {
        display: flex;
        align-items: center;
        gap: 25px;
    }

    .articles-hero-visual {
        position: relative;
        width: 175px;
        height: 195px;
        flex-shrink: 0;
    }

    .articles-hero-visual-circle {
        position: absolute;
        top: 3px;
        left: 9px;
        width: 152px;
        height: 152px;
        border-radius: 50%;
        background: linear-gradient(135deg, #EAF1FF, #F3EEFF);
    }

    .articles-hero-visual-card {
        position: absolute;
        left: 34px;
        top: 45px;
        width: 108px;
        height: 132px;
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 15px 32px rgba(31, 41, 55, .13);
        padding: 15px;
    }

    .articles-hero-card-top {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 13px;
    }

    .articles-hero-card-icon {
        width: 25px;
        height: 25px;
        border-radius: 7px;
        background: #EAF1FF;
        color: var(--job-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
    }

    .articles-hero-card-small { height: 5px; border-radius: 4px; background: #EEF1F6; flex: 1; }
    .articles-hero-visual-line { height: 6px; border-radius: 4px; background: #EEF1F6; margin-bottom: 9px; }
    .articles-hero-visual-line.w-85 { width: 85%; }
    .articles-hero-visual-line.w-70 { width: 70%; }
    .articles-hero-visual-line.w-50 { width: 50%; }
    .articles-hero-visual-tag { display: inline-block; width: 48px; height: 13px; border-radius: 20px; background: #EAF1FF; margin-top: 2px; }

    .articles-hero-visual-badge {
        position: absolute;
        right: -9px;
        bottom: 18px;
        width: 40px;
        height: 40px;
        border-radius: 12px;
        background: var(--job-primary);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
        box-shadow: 0 8px 18px rgba(51,118,242,.30);
    }

    .articles-hero-visual-check {
        position: absolute;
        top: 8px;
        right: 3px;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: #E9FBF0;
        border: 1px solid #CFF5DC;
        color: var(--job-success);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
    }

    /* HERO FEATURES */

    .articles-hero-features { display: flex; flex-direction: column; gap: 18px; }
    .articles-hero-feature-item { display: flex; align-items: flex-start; gap: 12px; }

    .articles-hero-feature-icon {
        width: 38px;
        height: 38px;
        border-radius: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        flex-shrink: 0;
    }

    .articles-hero-feature-icon.icon-blue { background: #EAF1FF; color: var(--job-primary); }
    .articles-hero-feature-icon.icon-purple { background: #F3EEFF; color: var(--job-purple); }
    .articles-hero-feature-icon.icon-green { background: #E9FBF0; color: var(--job-success); }

    .articles-hero-feature-title { font-size: 13.5px; font-weight: 700; color: var(--job-text); margin-bottom: 2px; }
    .articles-hero-feature-text { font-size: 12px; color: var(--job-muted); line-height: 1.5; }

    /* =========================================================
       STATS
    ========================================================= */

    .articles-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
        margin-bottom: 28px;
    }

    .article-stat-card {
        background: var(--job-card);
        border: 1px solid var(--job-border);
        border-radius: 18px;
        padding: 21px 22px;
        display: flex;
        align-items: center;
        gap: 15px;
        box-shadow: var(--job-shadow);
    }

    .article-stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #EEF4FF;
        color: var(--job-primary);
        font-size: 21px;
        flex-shrink: 0;
    }

    .article-stat-value { font-size: 24px; line-height: 1; font-weight: 700; color: var(--job-text); margin-bottom: 5px; }
    .article-stat-label { font-size: 13px; color: var(--job-muted); font-weight: 500; }

    /* =========================================================
       MAIN GRID
    ========================================================= */

    .articles-body-grid {
        display: grid;
        grid-template-columns: 272px 1fr 300px;
        gap: 22px;
        align-items: start;
    }

    /* =========================================================
       FILTER SIDEBAR
    ========================================================= */

    .articles-sidebar {
        background: #fff;
        border: 1px solid var(--job-border);
        border-radius: 18px;
        padding: 20px;
        box-shadow: var(--job-shadow);
        position: sticky;
        top: 20px;
    }

    .articles-sidebar-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        padding-bottom: 14px;
        border-bottom: 1px solid var(--job-border);
        margin-bottom: 14px;
    }

    .articles-sidebar-title {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 15px;
        font-weight: 700;
        color: var(--job-text);
    }

    .articles-sidebar-title svg { color: var(--job-primary); }

    .articles-clear-filters { font-size: 12.5px; font-weight: 600; color: var(--job-primary); text-decoration: none; }
    .articles-clear-filters:hover { text-decoration: underline; }

    .articles-filter-block { padding: 15px 0; border-bottom: 1px solid #F0F2F6; }
    .articles-filter-block:last-of-type { border-bottom: none; padding-bottom: 4px; }

    .articles-filter-label {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .06em;
        text-transform: uppercase;
        color: #9AA3B2;
        margin-bottom: 10px;
    }

    .articles-category-list {
        list-style: none;
        margin: 0;
        padding: 0;
        max-height: 280px;
        overflow-y: auto;
    }

    .articles-category-list li + li { margin-top: 2px; }

    .articles-category-list a {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        padding: 8px 10px;
        border-radius: 9px;
        font-size: 13px;
        text-decoration: none;
        color: #5F6877;
        transition: .15s ease;
    }

    .articles-category-list a:hover { background: #F6F8FC; color: var(--job-text); }

    .articles-category-list a.active {
        background: #EAF1FF;
        color: var(--job-primary);
        font-weight: 700;
    }

    .articles-category-list a .cat-count { font-size: 11px; color: #9AA3B2; }
    .articles-category-list a.active .cat-count { color: var(--job-primary); }

    .articles-filter-input {
        width: 100%;
        height: 40px;
        border: 1px solid #DDE3EC;
        border-radius: 9px;
        padding: 0 12px;
        font-size: 13px;
        color: var(--job-text);
        outline: none;
        transition: .2s ease;
        background: #fff;
        appearance: none;
    }

    .articles-filter-input:focus {
        border-color: var(--job-primary);
        box-shadow: 0 0 0 3px rgba(51,118,242,.10);
    }

    .articles-filter-apply {
        width: 100%;
        height: 42px;
        border: 0;
        border-radius: 10px;
        background: var(--job-primary);
        color: #fff;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        margin-top: 8px;
        transition: .2s ease;
    }

    .articles-filter-apply:hover { background: var(--job-primary-dark); transform: translateY(-1px); }

    /* =========================================================
       SECTION HEADER / TABS
    ========================================================= */

    .articles-section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 16px;
    }

    .articles-section-heading {
        margin: 0;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .1em;
        text-transform: uppercase;
        color: #9AA3B2;
    }

    .articles-toolbar {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        border-bottom: 1px solid var(--job-border);
        padding-bottom: 10px;
        margin-bottom: 18px;
    }

    .articles-tabs { display: flex; align-items: center; gap: 22px; }

    .articles-tabs a {
        padding-bottom: 10px;
        margin-bottom: -11px;
        border-bottom: 2px solid transparent;
        font-weight: 700;
        font-size: 14px;
        letter-spacing: -.1px;
        color: #6B7280;
        text-decoration: none;
        transition: .15s ease;
    }

    .articles-tabs a.active { border-color: var(--job-primary); color: var(--job-primary); }
    .articles-tabs a:hover { color: var(--job-text); }

    .articles-sort-label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        font-weight: 600;
        color: var(--job-muted);
    }

    .articles-sort-label select {
        border: 1px solid #DDE3EC;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 600;
        padding: 8px 12px;
        color: var(--job-text);
        outline: none;
        background: #fff;
    }

    .articles-sort-label select:focus {
        border-color: var(--job-primary);
        box-shadow: 0 0 0 3px rgba(51,118,242,.10);
    }

    /* =========================================================
       ARTICLE LIST
    ========================================================= */

    .articles-list { display: flex; flex-direction: column; gap: 12px; }

    .student-article-card {
        background: #fff;
        border: 1px solid var(--job-border);
        border-radius: 16px;
        padding: 17px;
        box-shadow: var(--job-shadow);
        transition: .2s ease;
    }

    .student-article-card:hover {
        border-color: #C9D6EE;
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(31,41,55,.10);
    }

    .article-card-inner { display: flex; align-items: flex-start; gap: 14px; }

    .article-thumb-btn { flex-shrink: 0; border: 0; background: none; padding: 0; cursor: pointer; line-height: 0; }

    .article-thumb {
        width: 58px;
        height: 58px;
        border-radius: 13px;
        object-fit: cover;
        background: #EEF4FF;
    }

    .article-card-content { flex: 1; min-width: 0; }

    .article-card-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 14px;
    }

    .article-title-row {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        min-width: 0;
    }

    .article-open-title-btn { border: 0; background: none; padding: 0; cursor: pointer; text-align: left; }

    .article-title {
        margin: 0;
        color: var(--job-text);
        font-size: 15px;
        line-height: 1.4;
        font-weight: 700;
        transition: .15s ease;
    }

    .article-open-title-btn:hover .article-title { color: var(--job-primary); }

    .article-category-tag {
        display: inline-flex;
        align-items: center;
        background: #EAF1FF;
        color: var(--job-primary);
        border-radius: 999px;
        padding: 4px 9px;
        font-size: 9px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .03em;
        white-space: nowrap;
    }

    .article-meta-right { text-align: right; flex-shrink: 0; }

    .article-views {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 5px;
        color: var(--job-success);
        font-size: 13px;
        font-weight: 700;
    }

    .article-posted-time { font-size: 11px; color: #9AA3B2; margin-top: 4px; }

    .article-author-line { margin: 5px 0 0; font-size: 12px; color: var(--job-muted); line-height: 1.5; }

    /* actions row */

    .article-actions-row {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-top: 13px;
        padding-top: 12px;
        border-top: 1px solid #F0F2F6;
    }

    .article-action-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border: 0;
        background: none;
        cursor: pointer;
        font-size: 12.5px;
        font-weight: 600;
        color: #9AA3B2;
        transition: .15s ease;
        padding: 0;
    }

    .article-action-btn:hover { color: var(--job-primary); }
    .article-action-btn.liked { color: var(--job-danger); }
    .article-action-btn.liked:hover { color: var(--job-danger); }

    .article-actions-row .view-article-btn {
        margin-left: auto;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        min-height: 34px;
        padding: 0 15px;
        border: 0;
        border-radius: 9px;
        background: var(--job-primary);
        color: #fff;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: .2s ease;
    }

    .article-actions-row .view-article-btn:hover { background: var(--job-primary-dark); transform: translateY(-1px); }

    /* inline comments panel */

    .article-comments-panel { margin-top: 14px; padding-top: 14px; border-top: 1px solid #F0F2F6; }

    .comment-form { display: flex; align-items: flex-start; gap: 8px; margin-bottom: 14px; }

    .comment-textarea {
        width: 100%;
        border: 1px solid #DDE3EC;
        border-radius: 9px;
        padding: 9px 34px 9px 12px;
        font-size: 13px;
        color: var(--job-text);
        outline: none;
        resize: vertical;
        transition: .2s ease;
    }

    .comment-textarea:focus { border-color: var(--job-primary); box-shadow: 0 0 0 3px rgba(51,118,242,.10); }

    .comment-form button[type="submit"] {
        border: 0;
        background: var(--job-primary);
        color: #fff;
        border-radius: 9px;
        padding: 0 16px;
        height: 40px;
        font-size: 12.5px;
        font-weight: 700;
        cursor: pointer;
        flex-shrink: 0;
        transition: .2s ease;
    }

    .comment-form button[type="submit"]:hover { background: var(--job-primary-dark); }
    .comment-form button[type="submit"]:disabled { opacity: .6; cursor: default; }

    .emoji-toggle-btn { border: 0; background: none; cursor: pointer; padding: 0; }

    .emoji-picker {
        border: 1px solid var(--job-border) !important;
        box-shadow: var(--job-shadow) !important;
    }

    .emoji-option:hover { background: #F6F8FC !important; }

    .comment-list { display: flex; flex-direction: column; gap: 12px; }

    .no-comments-msg { font-size: 13px; color: #9AA3B2; }

    /* =========================================================
       EMPTY STATE
    ========================================================= */

    .empty-articles {
        background: #fff;
        border: 1px dashed #D8DEE8;
        border-radius: 20px;
        padding: 55px 20px;
        text-align: center;
    }

    .empty-articles-icon {
        width: 70px;
        height: 70px;
        margin: 0 auto 15px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #EEF4FF;
        color: var(--job-primary);
        font-size: 30px;
    }

    .empty-articles h3 { font-size: 18px; color: var(--job-text); font-weight: 700; margin: 0 0 6px; }
    .empty-articles p { color: var(--job-muted); font-size: 13px; margin: 0; }

    /* =========================================================
       TRENDING / PROMO ASIDE
    ========================================================= */

    .articles-aside { display: flex; flex-direction: column; gap: 22px; }

    .trending-card {
        background: #fff;
        border: 1px solid var(--job-border);
        border-radius: 18px;
        padding: 20px;
        box-shadow: var(--job-shadow);
    }

    .trending-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 14px;
    }

    .trending-card-header h3 {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .08em;
        text-transform: uppercase;
        color: #9AA3B2;
        margin: 0;
    }

    .trending-card-header a { font-size: 12.5px; font-weight: 600; color: var(--job-primary); text-decoration: none; }
    .trending-card-header a:hover { text-decoration: underline; }

    .trending-list { list-style: none; margin: 0; padding: 0; display: flex; flex-direction: column; gap: 14px; }

    .trending-item-btn {
        display: flex;
        gap: 10px;
        width: 100%;
        border: 0;
        background: none;
        padding: 0;
        text-align: left;
        cursor: pointer;
    }

    .trending-thumb { width: 54px; height: 54px; border-radius: 10px; object-fit: cover; background: #EEF4FF; flex-shrink: 0; }

    .trending-title {
        font-size: 13px;
        font-weight: 600;
        color: var(--job-text);
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        transition: .15s ease;
    }

    .trending-item-btn:hover .trending-title { color: var(--job-primary); }

    .trending-read-time { font-size: 11px; color: #9AA3B2; margin-top: 4px; }

    .promo-card {
        border-radius: 18px;
        padding: 24px;
        color: #fff;
        background: linear-gradient(135deg, var(--job-primary), var(--job-purple));
        box-shadow: var(--job-shadow);
    }

    .promo-card h3 { font-size: 17px; font-weight: 700; margin: 0 0 12px; }
    .promo-card p { font-size: 13px; line-height: 1.7; color: rgba(255,255,255,.88); margin: 0 0 18px; }

    .promo-feature-list { display: flex; flex-direction: column; gap: 9px; font-size: 13px; }
    .promo-feature-list div { display: flex; align-items: center; gap: 8px; }

    /* =========================================================
       ARTICLE MODAL (mirrors the job detail modal)
    ========================================================= */

    .student-article-modal {
        display: none;
        position: fixed;
        inset: 0;
        z-index: 9999;
        background: rgba(15, 23, 42, .55);
        backdrop-filter: blur(4px);
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .student-article-modal.active { display: flex; }

    .article-modal-box {
        width: 100%;
        max-width: 680px;
        max-height: 88vh;
        overflow-y: auto;
        background: #fff;
        border-radius: 20px;
        padding: 26px;
        position: relative;
        box-shadow: 0 25px 70px rgba(15, 23, 42, .22);
    }

    .article-modal-close {
        position: absolute;
        top: 15px;
        right: 15px;
        width: 35px;
        height: 35px;
        border: 1px solid #DDE3EC;
        background: #fff;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #64748B;
        cursor: pointer;
        transition: .2s ease;
        z-index: 5;
    }

    .article-modal-close:hover { background: #F6F8FC; color: var(--job-text); }

    .article-modal-loading { padding: 70px 20px; text-align: center; color: #9AA3B2; font-size: 13px; }

    .article-modal-header {
        display: flex;
        align-items: center;
        gap: 14px;
        padding-right: 45px;
    }

    .article-modal-avatar {
        width: 58px;
        height: 58px;
        border-radius: 13px;
        background: #EEF4FF;
        color: var(--job-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
        font-weight: 800;
        flex-shrink: 0;
    }

    .article-modal-header h2 { margin: 0; color: var(--job-text); font-size: 20px; line-height: 1.3; font-weight: 750; }

    .article-modal-category {
        display: inline-block;
        margin-top: 6px;
        color: var(--job-primary);
        background: #EAF1FF;
        border-radius: 999px;
        padding: 4px 10px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .05em;
    }

    .article-modal-image {
        width: 100%;
        height: 220px;
        object-fit: cover;
        border-radius: 14px;
        background: #EEF4FF;
        margin-top: 20px;
    }

    .article-modal-info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin-top: 22px;
    }

    .article-info-box {
        background: #F7F9FC;
        border: 1px solid #EEF1F5;
        border-radius: 11px;
        padding: 13px;
        min-width: 0;
    }

    .article-info-box span {
        display: block;
        color: #9AA3B2;
        font-size: 8px;
        text-transform: uppercase;
        font-weight: 750;
        letter-spacing: .08em;
        margin-bottom: 5px;
    }

    .article-info-box strong { display: block; color: #334155; font-size: 12px; line-height: 1.5; word-break: break-word; }

    .article-info-box .like-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border: 0;
        background: none;
        cursor: pointer;
        font-size: 13px;
        font-weight: 700;
        padding: 0;
    }

    .article-modal-section { margin-top: 21px; }
    .article-modal-section h4 { margin: 0 0 10px; color: var(--job-text); font-size: 13px; font-weight: 750; }
    .article-modal-body-text { margin: 0; color: var(--job-muted); font-size: 12.5px; line-height: 1.8; white-space: pre-line; }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 1200px) {
        .articles-body-grid { grid-template-columns: 260px 1fr; }
        .articles-aside { grid-column: 1 / -1; flex-direction: row; flex-wrap: wrap; }
        .articles-aside > * { flex: 1 1 260px; }
    }

    @media (max-width: 1024px) {
        .articles-body-grid { grid-template-columns: 1fr; }
        .articles-sidebar { position: static; }
        .articles-hero-grid { grid-template-columns: 1fr; }
        .articles-hero-right { justify-content: flex-start; }
    }

    @media (max-width: 768px) {
        .student-articles-page { padding: 20px 0 40px; }
        .articles-page-container { width: min(100% - 24px, 1320px); }
        .articles-hero { padding: 29px 24px; border-radius: 19px; }
        .articles-hero-title { font-size: 28px; }
        .articles-hero-text { font-size: 13px; }
        .articles-hero-right { flex-wrap: wrap; }
        .articles-stats { grid-template-columns: 1fr; }
        .articles-toolbar { flex-direction: column; align-items: flex-start; }
    }

    @media (max-width: 600px) {
        .articles-hero-search { flex-direction: column; gap: 2px; padding: 5px; }
        .articles-search-divider { display: none; }
        .articles-search-field { border-bottom: 1px solid #F0F2F6; padding: 0 10px; }
        .articles-hero-search button { height: 41px; margin-top: 4px; }
        .articles-hero-visual { display: none; }
        .article-card-inner { align-items: flex-start; }
        .article-thumb { width: 46px; height: 46px; border-radius: 11px; }
        .article-title { font-size: 14px; }
        .article-card-top { flex-direction: column; gap: 4px; }
        .article-actions-row { flex-wrap: wrap; }
        .article-actions-row .view-article-btn { margin-left: 0; width: 100%; }
        .article-modal-info-grid { grid-template-columns: 1fr; }
        .article-modal-box { padding: 21px 17px; border-radius: 16px; }
    }

    @media (max-width: 420px) {
        .articles-hero { padding: 25px 18px; }
        .articles-hero-title { font-size: 25px; }
        .articles-hero-badge { font-size: 11px; }
        .articles-page-container { width: calc(100% - 18px); }
        .articles-sidebar { padding: 16px; }
    }
</style>

<div class="student-articles-page">

    <div class="articles-page-container">

        {{-- =====================================================
             HERO
        ====================================================== --}}

        <section class="articles-hero">

            <div class="articles-hero-grid">

                <div class="articles-hero-left">

                    <div class="articles-hero-badge">
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M13 2 3 14h7l-1 8 11-14h-7l0-6z"/></svg>
                        {{ $categories[0]['count'] ?? 48 }}+ New Articles This Week
                    </div>

                    <h1 class="articles-hero-title">
                        Discover.
                        <span>Learn. Grow.</span>
                    </h1>

                    <p class="articles-hero-text">
                        Explore expert insights, tutorials, career advice & industry trends
                        published by employers & professionals like you.
                    </p>

                    {{-- SEARCH --}}

                    <form action="{{ route('student.articles.index') }}" method="GET" class="articles-hero-search">

                        <div class="articles-search-field">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5" stroke-linecap="round"/></svg>
                            <input type="text" name="q" value="{{ request('q') }}" placeholder="Search articles, topics...">
                        </div>

                        <div class="articles-search-divider"></div>

                        <div class="articles-search-field" style="flex:1;">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M4 6h16M7 12h10M10 18h4"/></svg>
                            <select name="category">
                                <option value="">All Categories</option>
                                @foreach ($categories as $cat)
                                    @if ($cat['slug'])
                                        <option value="{{ $cat['slug'] }}" {{ $activeCategory === $cat['slug'] ? 'selected' : '' }}>{{ $cat['label'] }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <button type="submit">Search Articles</button>
                    </form>

                    {{-- POPULAR --}}

                    <div class="articles-popular">
                        <span>Popular:</span>
                        @foreach (['Career Advice', 'Web Dev', 'AIML', 'Productivity'] as $tag)
                            <a href="{{ route('student.articles.index', ['q' => strip_tags($tag)]) }}">{{ $tag }}</a>
                        @endforeach
                    </div>

                </div>

                {{-- HERO RIGHT --}}

                <div class="articles-hero-right">

                    <div class="articles-hero-visual">
                        <div class="articles-hero-visual-circle"></div>

                        <div class="articles-hero-visual-card">
                            <div class="articles-hero-card-top">
                                <div class="articles-hero-card-icon">
                                    <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16v16H4z"/><path d="M8 8h8M8 12h8M8 16h5"/></svg>
                                </div>
                                <div class="articles-hero-card-small"></div>
                            </div>
                            <div class="articles-hero-visual-line w-85"></div>
                            <div class="articles-hero-visual-line w-70"></div>
                            <div class="articles-hero-visual-line w-50"></div>
                            <span class="articles-hero-visual-tag"></span>
                        </div>

                        <div class="articles-hero-visual-badge">
                            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16v16H4z"/><path d="M8 8h8M8 12h8"/></svg>
                        </div>

                        <div class="articles-hero-visual-check">
                            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                        </div>
                    </div>

                    {{-- HERO FEATURES --}}

                    <div class="articles-hero-features">

                        <div class="articles-hero-feature-item">
                            <div class="articles-hero-feature-icon icon-blue">
                                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5" stroke-linecap="round"/></svg>
                            </div>
                            <div>
                                <div class="articles-hero-feature-title">Expert Articles</div>
                                <div class="articles-hero-feature-text">Curated technical guides & tutorials</div>
                            </div>
                        </div>

                        <div class="articles-hero-feature-item">
                            <div class="articles-hero-feature-icon icon-purple">
                                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2 2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                            </div>
                            <div>
                                <div class="articles-hero-feature-title">Industry Trends</div>
                                <div class="articles-hero-feature-text">Stay current with what's changing</div>
                            </div>
                        </div>

                        <div class="articles-hero-feature-item">
                            <div class="articles-hero-feature-icon icon-green">
                                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/><path d="m19 9-5 5-4-4-3 3"/></svg>
                            </div>
                            <div>
                                <div class="articles-hero-feature-title">Grow Your Career</div>
                                <div class="articles-hero-feature-text">Practical advice you can apply today</div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </section>

        {{-- =====================================================
             STATS
        ====================================================== --}}

        <div class="articles-stats">

            <div class="article-stat-card">
                <div class="article-stat-icon">
                    <svg width="21" height="21" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16v16H4z"/><path d="M8 8h8M8 12h8M8 16h5"/></svg>
                </div>
                <div>
                    <div class="article-stat-value">{{ method_exists($articles, 'total') ? number_format($articles->total()) : $articles->count() }}</div>
                    <div class="article-stat-label">Available Articles</div>
                </div>
            </div>

            <div class="article-stat-card">
                <div class="article-stat-icon">
                    <svg width="21" height="21" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M4 6h16M7 12h10M10 18h4"/></svg>
                </div>
                <div>
                    <div class="article-stat-value">{{ count($categories) - 1 }}</div>
                    <div class="article-stat-label">Categories</div>
                </div>
            </div>

            <div class="article-stat-card">
                <div class="article-stat-icon">
                    <svg width="21" height="21" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/></svg>
                </div>
                <div>
                    <div class="article-stat-value">{{ number_format($trendingArticles->sum('views_count')) }}</div>
                    <div class="article-stat-label">Total Views</div>
                </div>
            </div>

        </div>

        {{-- =====================================================
             BODY
        ====================================================== --}}

        <div class="articles-body-grid">

            {{-- ---------- LEFT: Filters ---------- --}}

            <aside class="articles-sidebar">

                <div class="articles-sidebar-header">
                    <div class="articles-sidebar-title">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M4 6h16M7 12h10M10 18h4"/></svg>
                        Filters
                    </div>
                    <a href="{{ route('student.articles.index') }}" class="articles-clear-filters">Clear all</a>
                </div>

                <div class="articles-filter-block">
                    <div class="articles-filter-label">Categories</div>
                    <ul class="articles-category-list">
                        @foreach ($categories as $cat)
                            @php
                                $isActive = $activeCategory === $cat['slug'];
                                $catUrl = route('student.articles.index', array_filter(['category' => $cat['slug']])) . '#browse-articles';
                            @endphp
                            <li>
                                <a href="{{ $catUrl }}" class="{{ $isActive ? 'active' : '' }}">
                                    <span>{{ $cat['label'] }}</span>
                                    <span class="cat-count">{{ $cat['count'] }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <form action="{{ route('student.articles.index') }}#browse-articles" method="GET">
                    <input type="hidden" name="category" value="{{ $activeCategory }}">

                    <div class="articles-filter-block">
                        <div class="articles-filter-label">Sort By</div>
                        <select name="sort" class="articles-filter-input">
                            <option value="latest" {{ $sort === 'latest' ? 'selected' : '' }}>Latest</option>
                            <option value="most-viewed" {{ $sort === 'most-viewed' ? 'selected' : '' }}>Most Viewed</option>
                            <option value="most-liked" {{ $sort === 'most-liked' ? 'selected' : '' }}>Most Liked</option>
                        </select>
                    </div>

                    <button type="submit" class="articles-filter-apply">Apply Filters</button>
                </form>

            </aside>

            {{-- ---------- CENTER: Tabs + Article list ---------- --}}

            <main id="browse-articles">

                <div class="articles-section-header">
                    <h2 class="articles-section-heading">Browse Articles</h2>
                </div>

                <div class="articles-toolbar">
                    @php
                        $tabs = ['all' => 'All Articles'];
                    @endphp

                    <div class="articles-tabs">
                        @foreach ($tabs as $key => $label)
                            <a href="{{ route('student.articles.index', array_filter(['tab' => $key, 'category' => $activeCategory])) }}#browse-articles"
                               class="{{ $activeTab === $key ? 'active' : '' }}">
                                {{ $label }}
                            </a>
                        @endforeach
                    </div>

                    <label class="articles-sort-label">
                        Sort by:
                        <select name="sort" onchange="updateSort(this.value)">
                            <option value="latest" {{ $sort === 'latest' ? 'selected' : '' }}>Latest</option>
                            <option value="most-viewed" {{ $sort === 'most-viewed' ? 'selected' : '' }}>Most Viewed</option>
                            <option value="most-liked" {{ $sort === 'most-liked' ? 'selected' : '' }}>Most Liked</option>
                        </select>
                    </label>
                </div>

                <div class="articles-list">
                    @forelse ($articles as $article)
                        <article class="student-article-card">
                            <div class="article-card-inner">

                                <button type="button" class="article-thumb-btn article-open-btn" data-article-id="{{ $article->id }}">
                                    <img src="{{ $article->image }}" alt="{{ $article->title }}" class="article-thumb">
                                </button>

                                <div class="article-card-content">

                                    <div class="article-card-top">
                                        <div style="min-width:0;">
                                            <div class="article-title-row">
                                                <button type="button" class="article-open-title-btn article-open-btn" data-article-id="{{ $article->id }}">
                                                    <h3 class="article-title">{{ $article->title }}</h3>
                                                </button>
                                                <span class="article-category-tag">{{ $article->category }}</span>
                                            </div>

                                            @php
                                                $authorName = is_string($article->author ?? null)
                                                    ? $article->author
                                                    : ($article->author->name ?? 'Unknown Author');
                                            @endphp
                                            <p class="article-author-line">
                                                <strong>{{ $authorName }}</strong>
                                                <span style="margin:0 5px; color:#C7CEDB;">·</span>
                                                {{ $article->read_minutes ?? 5 }} min read
                                            </p>
                                        </div>

                                        <div class="article-meta-right">
                                            <p class="article-views">
                                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/></svg>
                                                {{ number_format($article->views_count) }}
                                            </p>
                                            <p class="article-posted-time">
                                                {{ optional($article->published_at)->diffForHumans() ?? 'Draft' }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="article-actions-row">
                                        <button
                                            type="button"
                                            class="article-action-btn like-btn {{ in_array($article->id, $likedArticleIds ?? []) ? 'liked' : '' }}"
                                            data-article-id="{{ $article->id }}"
                                            data-liked="{{ in_array($article->id, $likedArticleIds ?? []) ? '1' : '0' }}"
                                        >
                                            <svg class="like-icon" width="15" height="15" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                                 fill="{{ in_array($article->id, $likedArticleIds ?? []) ? 'currentColor' : 'none' }}">
                                                <path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 1 0-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 0 0 0-7.8z"/>
                                            </svg>
                                            <span class="like-count">{{ $article->likes_count }}</span>
                                        </button>

                                        <button type="button" class="article-action-btn comment-toggle-btn" data-article-id="{{ $article->id }}">
                                            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 11.5a8.38 8.38 0 0 1-8.5 8.5 8.5 8.5 0 1 1 8.5-8.5z"/><path d="M8 10h8M8 14h5" stroke-linecap="round"/></svg>
                                            <span class="comment-count">{{ $article->comments_count }}</span>
                                        </button>

                                        <button type="button" class="view-article-btn article-open-btn" data-article-id="{{ $article->id }}">
                                            View Details
                                            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                                        </button>
                                    </div>

                                </div>
                            </div>

                            {{-- Inline comment panel — hidden until the comment icon is clicked --}}
                            <div id="comments-panel-{{ $article->id }}" class="article-comments-panel" style="display:none;">
                                <form class="comment-form" data-article-id="{{ $article->id }}">
                                    @csrf
                                    <div class="relative" style="position:relative; flex:1;">
                                        <textarea
                                            name="body" rows="2" required maxlength="1000"
                                            placeholder="Write a comment..."
                                            class="comment-textarea"
                                        ></textarea>
                                        <button type="button" class="emoji-toggle-btn" style="position:absolute; right:8px; bottom:8px; color:#9AA3B2;" aria-label="Add emoji">
                                            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M8.5 14s1.2 2 3.5 2 3.5-2 3.5-2" stroke-linecap="round"/><path d="M9 9h.01M15 9h.01" stroke-linecap="round"/></svg>
                                        </button>
                                        <div class="emoji-picker hidden" style="display:none; position:absolute; bottom:44px; right:0; z-index:30; background:#fff; border-radius:10px; padding:8px; grid-template-columns:repeat(6,1fr); gap:4px; width:224px;">
                                            @foreach (['😀','😂','😍','😊','👍','🙌','🎉','🔥','😢','😮','❤️','👏','🤔','😎','🙏','💯','😅','🥳'] as $emoji)
                                                <button type="button" class="emoji-option" style="border:0; background:none; font-size:18px; line-height:1; cursor:pointer; border-radius:6px; padding:4px;">{{ $emoji }}</button>
                                            @endforeach
                                        </div>
                                    </div>
                                    <button type="submit">Post</button>
                                </form>

                                <div class="comment-list">
                                    @foreach ($article->comments as $comment)
                                        <div style="display:flex; gap:10px;" data-comment-id="{{ $comment->id }}">
                                            <span style="width:28px; height:28px; border-radius:50%; background:#EAF1FF; color:var(--job-primary); display:flex; align-items:center; justify-content:center; font-size:12px; font-weight:700; flex-shrink:0;">
                                                {{ strtoupper(substr($comment->user->name ?? 'U', 0, 1)) }}
                                            </span>
                                            <div style="min-width:0;">
                                                <div style="display:flex; align-items:center; gap:8px;">
                                                    <p style="margin:0; font-size:13px; font-weight:700; color:var(--job-text);">{{ $comment->user->name ?? 'Unknown User' }}</p>
                                                    <p style="margin:0; font-size:11px; color:#9AA3B2;">{{ $comment->created_at->diffForHumans() }}</p>
                                                </div>
                                                <p style="margin:3px 0 0; font-size:13px; color:var(--job-muted); line-height:1.6;">{{ $comment->body }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                    @if ($article->comments->isEmpty())
                                        <p class="no-comments-msg">No comments yet — be the first to share your thoughts.</p>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="empty-articles">
                            <div class="empty-articles-icon">
                                <svg width="30" height="30" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16v16H4z"/><path d="M8 8h8M8 12h8M8 16h5"/></svg>
                            </div>
                            <h3>No articles found</h3>
                            <p>Try a different search or filter.</p>
                        </div>
                    @endforelse
                </div>

                {{-- Pagination --}}
                @if (isset($articles) && method_exists($articles, 'links'))
                    <div class="student-pagination" style="margin-top:26px; display:flex; justify-content:center;">
                        {{ $articles->links() }}
                    </div>
                @endif

            </main>

            {{-- ---------- RIGHT: Trending + Newsletter ---------- --}}

            <aside class="articles-aside">

                <div class="trending-card">
                    <div class="trending-card-header">
                        <h3>Trending Articles</h3>
                        <a href="{{ route('student.articles.index', ['tab' => 'trending']) }}#browse-articles">View All</a>
                    </div>
                    <ul class="trending-list">
                        @foreach ($trendingArticles->take(4) as $t)
                            <li>
                                <button type="button" class="trending-item-btn article-open-btn" data-article-id="{{ $t->id }}">
                                    <img src="{{ $t->image }}" alt="{{ $t->title }}" class="trending-thumb">
                                    <div style="min-width:0;">
                                        <p class="trending-title">{{ $t->title }}</p>
                                        <p class="trending-read-time">{{ $t->read_minutes }} min read</p>
                                    </div>
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="promo-card">
                    <h3>Explore the Latest Tech Insights</h3>
                    <p>
                        Discover expert-written articles on software development, AI, cybersecurity,
                        cloud computing, data science, DevOps, mobile development, UI/UX, and many
                        more IT topics. Stay informed with practical guides, industry trends, and
                        best practices to grow your technical knowledge and career.
                    </p>
                    <div class="promo-feature-list">
                        <div><span>📘</span><span>Expert Technical Articles</span></div>
                        <div><span>💡</span><span>Programming Tips & Tutorials</span></div>
                        <div><span>🚀</span><span>Latest Technology Trends</span></div>
                        <div><span>🎯</span><span>Career Growth & Best Practices</span></div>
                    </div>
                </div>

            </aside>

        </div>

    </div>

</div>

{{-- ============ ARTICLE DETAIL MODAL (mirrors the job detail modal) ============ --}}
<div id="article-modal-overlay" class="student-article-modal">
    <div class="article-modal-box">

        <button id="modal-close-btn" type="button" class="article-modal-close" aria-label="Close">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round"><path d="M6 6l12 12M18 6L6 18"/></svg>
        </button>

        <div id="modal-loading" class="article-modal-loading">
            Loading article...
        </div>

        <div id="modal-content" style="display:none;">

            <div class="article-modal-header">
                <div id="modal-author-initial" class="article-modal-avatar"></div>
                <div style="min-width:0;">
                    <h2 id="modal-title"></h2>
                    <span id="modal-category" class="article-modal-category"></span>
                </div>
            </div>

            <img id="modal-image" alt="" class="article-modal-image">

            <div class="article-modal-info-grid">
                <div class="article-info-box">
                    <span>Author</span>
                    <strong id="modal-author-name"></strong>
                </div>

                <div class="article-info-box">
                    <span>Published</span>
                    <strong id="modal-date"></strong>
                </div>

                <div class="article-info-box">
                    <span>Read Time</span>
                    <strong id="modal-read-minutes"></strong>
                </div>

                <div class="article-info-box">
                    <span>Views</span>
                    <strong id="modal-views-count"></strong>
                </div>

                <div class="article-info-box">
                    <span>Likes</span>
                    <button type="button" id="modal-like-btn" class="like-btn" style="color:#9AA3B2;">
                        <svg class="like-icon" width="16" height="16" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none">
                            <path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 1 0-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 0 0 0-7.8z"/>
                        </svg>
                        <span class="like-count" id="modal-like-count"></span>
                    </button>
                </div>

                <div class="article-info-box">
                    <span>Comments</span>
                    <strong style="display:flex; align-items:center; gap:6px;">
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 11.5a8.38 8.38 0 0 1-8.5 8.5 8.5 8.5 0 1 1 8.5-8.5z"/><path d="M8 10h8M8 14h5" stroke-linecap="round"/></svg>
                        <span class="comment-count" id="modal-comments-count"></span>
                    </strong>
                </div>
            </div>

            <div class="article-modal-section">
                <div id="modal-body" class="article-modal-body-text"></div>
            </div>

            <div class="article-modal-section">
                <h4>Comments</h4>

                <form class="comment-form" id="modal-comment-form" data-article-id="">
                    @csrf
                    <div style="position:relative; flex:1;">
                        <textarea
                            name="body" rows="2" required maxlength="1000"
                            placeholder="Write a comment..."
                            class="comment-textarea"
                        ></textarea>
                        <button type="button" class="emoji-toggle-btn" style="position:absolute; right:8px; bottom:8px; color:#9AA3B2;" aria-label="Add emoji">
                            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M8.5 14s1.2 2 3.5 2 3.5-2 3.5-2" stroke-linecap="round"/><path d="M9 9h.01M15 9h.01" stroke-linecap="round"/></svg>
                        </button>
                        <div class="emoji-picker hidden" style="display:none; position:absolute; bottom:44px; right:0; z-index:30; background:#fff; border-radius:10px; padding:8px; grid-template-columns:repeat(6,1fr); gap:4px; width:224px;">
                            @foreach (['😀','😂','😍','😊','👍','🙌','🎉','🔥','😢','😮','❤️','👏','🤔','😎','🙏','💯','😅','🥳'] as $emoji)
                                <button type="button" class="emoji-option" style="border:0; background:none; font-size:18px; line-height:1; cursor:pointer; border-radius:6px; padding:4px;">{{ $emoji }}</button>
                            @endforeach
                        </div>
                    </div>
                    <button type="submit">Post</button>
                </form>

                <div class="comment-list" id="modal-comment-list"></div>
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
        el.style.display = 'flex';
        el.style.gap = '10px';
        el.dataset.commentId = c.id;

        const avatar = document.createElement('span');
        avatar.style.cssText = 'width:28px;height:28px;border-radius:50%;background:#EAF1FF;color:#3376F2;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;flex-shrink:0;';
        avatar.textContent = c.user_name.charAt(0).toUpperCase();

        const wrap = document.createElement('div');
        wrap.style.minWidth = '0';
        wrap.innerHTML = `
            <div style="display:flex;align-items:center;gap:8px;">
                <p style="margin:0;font-size:13px;font-weight:700;color:#172033;"></p>
                <p style="margin:0;font-size:11px;color:#9AA3B2;"></p>
            </div>
            <p style="margin:3px 0 0;font-size:13px;color:#6B7280;line-height:1.6;"></p>
        `;
        wrap.querySelectorAll('p')[0].textContent = c.user_name;
        wrap.querySelectorAll('p')[1].textContent = c.created_at;
        wrap.querySelectorAll('p')[2].textContent = c.body;

        el.appendChild(avatar);
        el.appendChild(wrap);
        return el;
    }

    /* ---------- SORT BY ---------- */
    window.updateSort = function (value) {
        const url = new URL(window.location.href);
        url.searchParams.set('sort', value);
        url.hash = 'browse-articles';
        window.location.href = url.toString();
    };

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
        overlay.classList.add('active');
        loadingEl.style.display = 'block';
        loadingEl.textContent = 'Loading article...';
        contentEl.style.display = 'none';
        document.body.style.overflow = 'hidden';

        try {
            const response = await fetch(`/student/articles/${articleId}`, {
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
            document.getElementById('modal-image').style.display = a.image ? 'block' : 'none';
            document.getElementById('modal-body').textContent = a.body ?? '';

            const likeBtn = document.getElementById('modal-like-btn');
            likeBtn.dataset.articleId = a.id;
            document.getElementById('modal-like-count').textContent = a.likes_count ?? 0;
            if (a.liked) {
                likeBtn.style.color = '#EF4444';
                likeBtn.querySelector('.like-icon').setAttribute('fill', 'currentColor');
            } else {
                likeBtn.style.color = '#9AA3B2';
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
                p.className = 'no-comments-msg';
                p.textContent = 'No comments yet — be the first to share your thoughts.';
                list.appendChild(p);
            }

            loadingEl.style.display = 'none';
            contentEl.style.display = 'block';
        } catch (err) {
            console.error('Failed to open article:', err);
            loadingEl.textContent = 'Could not load this article. Please try again.';
        }
    }

    function closeArticleModal() {
        overlay.classList.remove('active');
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
        if (e.key === 'Escape' && overlay.classList.contains('active')) closeArticleModal();
    });

    /* ---------- LIKE BUTTONS ---------- */
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
            const response = await fetch(`/student/articles/${articleId}/like`, {
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
                    b.classList.add('liked');
                    b.style.color = '#EF4444';
                    i.setAttribute('fill', 'currentColor');
                } else {
                    b.classList.remove('liked');
                    b.style.color = '#9AA3B2';
                    i.setAttribute('fill', 'none');
                }
            });
        } catch (err) {
            console.error('Failed to toggle like:', err);
        }
    });

    /* ---------- COMMENT TOGGLE (cards only) ---------- */
    document.addEventListener('click', function (e) {
        const btn = e.target.closest('.comment-toggle-btn');
        if (!btn) return;
        const panel = document.getElementById(`comments-panel-${btn.dataset.articleId}`);
        if (panel) panel.style.display = panel.style.display === 'none' ? 'block' : 'none';
    });

    /* ---------- COMMENT SUBMIT ---------- */
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

            const response = await fetch(`/student/articles/${articleId}/comments`, {
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

    /* ---------- EMOJI PICKER ---------- */
    document.addEventListener('click', function (e) {
        const toggleBtn = e.target.closest('.emoji-toggle-btn');
        if (toggleBtn) {
            const picker = toggleBtn.parentElement.querySelector('.emoji-picker');
            document.querySelectorAll('.emoji-picker').forEach(function (p) {
                if (p !== picker) p.style.display = 'none';
            });
            if (picker) picker.style.display = (picker.style.display === 'grid') ? 'none' : 'grid';
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
            picker.style.display = 'none';
            return;
        }

        if (!e.target.closest('.emoji-picker')) {
            document.querySelectorAll('.emoji-picker').forEach(function (p) {
                p.style.display = 'none';
            });
        }
    });

    /* ---------- AUTO-OPEN MODAL if ?article=ID is present ---------- */
    const params = new URLSearchParams(window.location.search);
    const openId = params.get('article');
    if (openId) openArticleModal(openId);
});
</script>
@endsection
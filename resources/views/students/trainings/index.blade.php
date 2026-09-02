
@extends('layouts.app')

@php($portal = 'student')

@section('title', 'Browse Trainings')

@section('content')

<style>
    /* =========================================================
       TECH LEADERS NETWORK - STUDENT TRAININGS
       Hero + Filter + Training Cards
    ========================================================== */

    :root {
        --training-primary: #3376F2;
        --training-primary-dark: #245ED1;
        --training-purple: #7C4DFF;
        --training-green: #16A34A;
        --training-bg: #F6F8FC;
        --training-card: #FFFFFF;
        --training-text: #172033f3;
        --training-muted: #667085;
        --training-border: #E5EAF2;
        --training-shadow: 0 8px 28px rgba(31, 41, 55, 0.07);
    }

    .training-page {
        background: var(--training-bg);
        min-height: 100vh;
        padding: 25px 28px 50px;
    }

    /* =========================================================
       HERO SECTION
    ========================================================== */

    .training-hero {
        background: #fff;
        border: 1px solid var(--training-border);
        border-radius: 24px;
        padding: 44px 46px;
        margin-bottom: 28px;
        position: relative;
        overflow: hidden;
        box-shadow: var(--training-shadow);
    }

    .hero-grid {
        position: relative;
        z-index: 2;
        display: grid;
        grid-template-columns: 1.15fr auto 1fr;
        gap: 30px;
        align-items: center;
    }

    .training-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #EAF1FF;
        color: var(--training-primary);
        border: 1px solid #D9E6FF;
        padding: 7px 15px;
        border-radius: 999px;
        font-size: 12.5px;
        font-weight: 700;
        margin-bottom: 18px;
    }

    .training-hero-title {
        font-size: 36px;
        line-height: 1.18;
        font-weight: 800;
        margin: 0 0 14px;
        letter-spacing: -0.6px;
        color: var(--training-text);
    }

    .training-hero-title span {
        display: block;
        background: linear-gradient(
            90deg,
            var(--training-primary),
            var(--training-purple)
        );
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    .training-hero-description {
        margin: 0 0 26px;
        font-size: 15px;
        line-height: 1.75;
        color: var(--training-muted);
        max-width: 480px;
    }

    .training-actions {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .training-btn-primary,
    .training-btn-outline {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 700;
        padding: 13px 22px;
        border-radius: 12px;
        transition: 0.2s ease;
        border: 1px solid transparent;
    }

    .training-btn-primary {
        background: var(--training-primary);
        color: #fff !important;
        box-shadow: 0 10px 22px rgba(51,118,242,0.24);
    }

    .training-btn-primary:hover {
        background: var(--training-primary-dark);
        color: #fff !important;
        transform: translateY(-1px);
    }

    .training-btn-outline {
        background: #fff;
        color: var(--training-text) !important;
        border-color: #DDE3EC;
    }

    .training-btn-outline:hover {
        border-color: var(--training-primary);
        color: var(--training-primary) !important;
    }

    /* =========================================================
       HERO ILLUSTRATION
    ========================================================== */

    .training-illustration {
        position: relative;
        width: 170px;
        height: 190px;
        flex-shrink: 0;
        margin: 0 auto;
    }

    .training-illustration-circle {
        position: absolute;
        top: 0;
        left: 10px;
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background: linear-gradient(135deg, #EAF1FF, #F3EEFF);
    }

    .training-illustration-card {
        position: absolute;
        left: 34px;
        top: 46px;
        width: 108px;
        height: 130px;
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 14px 30px rgba(31,41,55,0.13);
        padding: 16px 14px;
    }

    .training-illustration-icon {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #DCE8FF;
        margin-bottom: 12px;
    }

    .training-line {
        height: 6px;
        border-radius: 4px;
        background: #EEF1F6;
        margin-bottom: 8px;
    }

    .training-line.medium {
        width: 80%;
    }

    .training-line.short {
        width: 55%;
    }

    .training-small-badge {
        position: absolute;
        right: -8px;
        bottom: 6px;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: var(--training-primary);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
        border: 4px solid #fff;
        box-shadow: 0 8px 16px rgba(51,118,242,0.30);
    }

    .training-check {
        position: absolute;
        top: -6px;
        right: 10px;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: #E9FBF0;
        border: 1px solid #CFF5DC;
        color: var(--training-green);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
    }

    /* =========================================================
       HERO FEATURES
    ========================================================== */

    .training-features {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .training-feature {
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .training-feature-icon {
        width: 38px;
        height: 38px;
        border-radius: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        flex-shrink: 0;
    }

    .training-feature-icon.blue {
        background: #EAF1FF;
        color: var(--training-primary);
    }

    .training-feature-icon.purple {
        background: #F3EEFF;
        color: var(--training-purple);
    }

    .training-feature-icon.green {
        background: #E9FBF0;
        color: var(--training-green);
    }

    .training-feature-title {
        font-size: 13.5px;
        font-weight: 700;
        color: var(--training-text);
        margin-bottom: 2px;
    }

    .training-feature-text {
        font-size: 12px;
        color: var(--training-muted);
        line-height: 1.5;
    }

    /* =========================================================
       SECTION HEADER
    ========================================================== */

    .training-section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 0 0 17px;
    }

    .training-section-title {
        font-size: 20px;
        font-weight: 700;
        color: var(--training-text);
        margin: 0;
    }

    .training-section-subtitle {
        font-size: 13px;
        color: var(--training-muted);
        margin-top: 4px;
    }

    /* =========================================================
       BODY LAYOUT
    ========================================================== */

    .training-body {
        display: grid;
        grid-template-columns: 280px minmax(0, 1fr);
        gap: 24px;
        align-items: start;
    }

    /* =========================================================
       FILTER SIDEBAR
    ========================================================== */

    .training-filter {
        background: #fff;
        border: 1px solid var(--training-border);
        border-radius: 14px;
        padding: 20px;
        box-shadow: var(--training-shadow);
        position: sticky;
        top: 20px;
    }

    .training-filter-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-bottom: 16px;
        border-bottom: 1px solid #F1F5F9;
    }

    .training-filter-title {
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 0;
        color: var(--training-text);
        font-size: 15px;
        font-weight: 700;
    }

    .training-filter-title i {
        color: var(--training-muted);
        font-size: 14px;
    }

    .training-clear {
        color: var(--training-primary);
        font-size: 12.5px;
        font-weight: 600;
        text-decoration: none;
    }

    .training-clear:hover {
        text-decoration: underline;
    }

    .training-filter-section {
        padding: 17px 0;
        border-bottom: 1px solid #F1F5F9;
    }

    .training-filter-section:last-of-type {
        border-bottom: none;
        padding-bottom: 4px;
    }

    .training-filter-label {
        display: block;
        margin-bottom: 10px;
        color: #9AA3B2;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 1.2px;
        text-transform: uppercase;
    }

    .training-filter-input {
        width: 100%;
        height: 40px;
        padding: 0 12px;
        border: 1px solid #DDE3EC;
        border-radius: 8px;
        outline: none;
        color: var(--training-text);
        font-size: 13px;
        transition: .2s ease;
    }

    .training-filter-input:focus {
        border-color: var(--training-primary);
        box-shadow: 0 0 0 3px rgba(51,118,242,.10);
    }

    /* =========================================================
       LEVEL LIST
    ========================================================== */

    .training-level-list {
        margin: 0;
        padding: 0;
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .training-level-label {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 9px;
        border-radius: 8px;
        color: #4B5563;
        font-size: 13px;
        cursor: pointer;
        transition: .15s ease;
    }

    .training-level-label:hover {
        background: #F6F8FC;
    }

    .training-level-label.active {
        background: #EAF1FF;
        color: var(--training-primary);
        font-weight: 600;
    }

    .training-level-label input {
        accent-color: var(--training-primary);
        width: 15px;
        height: 15px;
        flex-shrink: 0;
    }

    .training-apply-button {
        width: 100%;
        height: 42px;
        margin-top: 8px;
        border: 0;
        border-radius: 9px;
        background: var(--training-primary);
        color: #fff;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        transition: .2s ease;
    }

    .training-apply-button:hover {
        background: var(--training-primary-dark);
        transform: translateY(-1px);
    }

    /* =========================================================
       TRAINING CARDS
    ========================================================== */

    .training-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 20px;
    }

    .training-card {
        display: flex;
        flex-direction: column;
        background: #fff;
        border: 1px solid var(--training-border);
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 3px 12px rgba(25, 45, 80, .025);
        transition: .2s ease;
    }

    .training-card:hover {
        transform: translateY(-3px);
        border-color: #D5E1FA;
        box-shadow: 0 12px 30px rgba(31, 65, 114, .09);
    }

    .training-card-image {
        width: 100%;
        height: 160px;
        display: block;
        object-fit: cover;
        background: #F1F5F9;
    }

    .training-card-content {
        display: flex;
        flex: 1;
        flex-direction: column;
        padding: 16px;
    }

    .training-card-badges {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 7px;
        margin-bottom: 9px;
    }

    .training-badge {
        display: inline-flex;
        align-items: center;
        padding: 3px 9px;
        border-radius: 999px;
        background: #EFF6FF;
        color: var(--training-primary);
        font-size: 9px;
        font-weight: 700;
        letter-spacing: .5px;
        text-transform: uppercase;
    }

    .training-card-title {
        margin: 0 0 7px;
        color: var(--training-text);
        font-size: 15px;
        line-height: 1.45;
        font-weight: 700;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .training-description {
        flex: 1;
        margin: 0 0 16px;
        color: var(--training-muted);
        font-size: 13px;
        line-height: 1.6;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .training-view-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        height: 40px;
        border-radius: 8px;
        background: var(--training-primary);
        color: #fff !important;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        margin-top: auto;
        transition: .2s ease;
    }

    .training-view-btn:hover {
        background: var(--training-primary-dark);
        color: #fff !important;
    }

    /* =========================================================
       EMPTY STATE
    ========================================================== */

    .training-empty {
        background: #fff;
        border: 1px solid var(--training-border);
        border-radius: 14px;
        padding: 45px 20px;
        text-align: center;
    }

    .training-empty-icon {
        width: 60px;
        height: 60px;
        background: #EEF4FF;
        color: var(--training-primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        font-size: 25px;
    }

    .training-empty h5 {
        font-size: 17px;
        font-weight: 700;
        color: var(--training-text);
        margin-bottom: 7px;
    }

    .training-empty p {
        font-size: 13px;
        color: var(--training-muted);
        margin: 0;
    }

    /* =========================================================
       PAGINATION
    ========================================================== */

    .training-pagination {
        margin-top: 26px;
        display: flex;
        justify-content: center;
    }

    .training-pagination .pagination {
        margin-bottom: 0;
    }

    .training-pagination .page-link {
        border: 1px solid #E0E6F0;
        color: var(--training-primary);
        border-radius: 7px;
        margin: 0 3px;
        font-size: 13px;
    }

    .training-pagination .page-item.active .page-link {
        background: var(--training-primary);
        border-color: var(--training-primary);
        color: #fff;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 1100px) {

        .hero-grid {
            grid-template-columns: 1fr;
        }

        .training-illustration {
            margin: 8px 0 0;
        }

        .training-body {
            grid-template-columns: 1fr;
        }

        .training-filter {
            position: static;
        }

        .training-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 768px) {

        .training-page {
            padding: 15px;
        }

        .training-hero {
            padding: 28px 24px;
            border-radius: 19px;
        }

        .training-hero-title {
            font-size: 27px;
        }

        .training-features {
            width: 100%;
        }
    }

    @media (max-width: 600px) {

        .training-actions {
            flex-direction: column;
        }

        .training-btn-primary,
        .training-btn-outline {
            justify-content: center;
            width: 100%;
        }

        .training-section-title {
            font-size: 18px;
        }

        .training-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 500px) {

        .training-illustration {
            display: none;
        }
    }
</style>


<div class="training-page">

    {{-- =====================================================
         HERO SECTION
    ====================================================== --}}

    <div class="training-hero">

        <div class="hero-grid">

            {{-- HERO CONTENT --}}
            <div class="training-hero-content">

                <div class="training-label">
                    <i class="bi bi-mortarboard-fill"></i>
                    Student Training
                </div>

                <h1 class="training-hero-title">
                    Learn New Skills
                    <span>Build Your Future</span>
                </h1>

                <p class="training-hero-description">
                    Explore expert-led training programs, strengthen your technical
                    skills, and prepare yourself for real-world career opportunities
                    with industry-focused learning.
                </p>

                <div class="training-actions">

                    <a href="#available-trainings" class="training-btn-primary">
                        <i class="bi bi-grid-fill"></i>
                        Explore Trainings
                    </a>

                    <a href="#training-search" class="training-btn-outline">
                        <i class="bi bi-search"></i>
                        Find a Training
                    </a>

                </div>

            </div>


            {{-- ILLUSTRATION --}}
            <div class="training-illustration">

                <div class="training-illustration-circle"></div>

                <div class="training-illustration-card">

                    <div class="training-illustration-icon"></div>

                    <div class="training-line"></div>

                    <div class="training-line medium"></div>

                    <div class="training-line"></div>

                    <div class="training-line short"></div>

                </div>

                <div class="training-small-badge">
                    <i class="bi bi-mortarboard-fill"></i>
                </div>

                <div class="training-check">
                    <i class="bi bi-check-lg"></i>
                </div>

            </div>


            {{-- FEATURES --}}
            <div class="training-features">

                <div class="training-feature">

                    <div class="training-feature-icon blue">
                        <i class="bi bi-person-workspace"></i>
                    </div>

                    <div>
                        <div class="training-feature-title">
                            Expert-Led Training
                        </div>

                        <div class="training-feature-text">
                            Learn directly from professionals
                        </div>
                    </div>

                </div>


                <div class="training-feature">

                    <div class="training-feature-icon purple">
                        <i class="bi bi-lightbulb-fill"></i>
                    </div>

                    <div>
                        <div class="training-feature-title">
                            Practical Learning
                        </div>

                        <div class="training-feature-text">
                            Build skills through real projects
                        </div>
                    </div>

                </div>


                <div class="training-feature">

                    <div class="training-feature-icon green">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>

                    <div>
                        <div class="training-feature-title">
                            Career Growth
                        </div>

                        <div class="training-feature-text">
                            Improve your skills and confidence
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
         BODY: SIDEBAR FILTER + TRAINING GRID
    ====================================================== --}}

    <div class="training-body" id="available-trainings">

        {{-- =================================================
             LEFT: FILTER SIDEBAR
        ================================================== --}}

        <aside class="training-filter" id="training-search">

            <div class="training-filter-header">

                <h3 class="training-filter-title">
                    <i class="bi bi-sliders"></i>
                    Filters
                </h3>

                <a href="{{ url()->current() }}" class="training-clear">
                    Clear all
                </a>

            </div>


            <form method="GET" action="{{ url()->current() }}">

                {{-- SEARCH --}}
                <div class="training-filter-section">

                    <label class="training-filter-label">
                        Search
                    </label>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search', '') }}"
                        placeholder="Title, technology, category..."
                        class="training-filter-input"
                    >

                </div>


                {{-- CATEGORY --}}
                <div class="training-filter-section">

                    <label class="training-filter-label">
                        Category
                    </label>

                    <input
                        type="text"
                        name="category"
                        value="{{ request('category', '') }}"
                        placeholder="e.g. Web Dev, Cloud..."
                        class="training-filter-input"
                    >

                </div>


                {{-- LEVEL --}}
                <div class="training-filter-section">

                    <label class="training-filter-label">
                        Level
                    </label>

                    <ul class="training-level-list">

                        {{-- ALL LEVELS --}}
                        <li>

                            <label class="training-level-label {{ request('level', '') === '' ? 'active' : '' }}">

                                <input
                                    type="radio"
                                    name="level"
                                    value=""
                                    {{ request('level', '') === '' ? 'checked' : '' }}
                                    onchange="this.form.submit()"
                                >

                                All Levels

                            </label>

                        </li>


                        {{-- BEGINNER --}}
                        <li>

                            <label class="training-level-label {{ request('level') === 'beginner' ? 'active' : '' }}">

                                <input
                                    type="radio"
                                    name="level"
                                    value="beginner"
                                    {{ request('level') === 'beginner' ? 'checked' : '' }}
                                    onchange="this.form.submit()"
                                >

                                Beginner

                            </label>

                        </li>


                        {{-- INTERMEDIATE --}}
                        <li>

                            <label class="training-level-label {{ request('level') === 'intermediate' ? 'active' : '' }}">

                                <input
                                    type="radio"
                                    name="level"
                                    value="intermediate"
                                    {{ request('level') === 'intermediate' ? 'checked' : '' }}
                                    onchange="this.form.submit()"
                                >

                                Intermediate

                            </label>

                        </li>


                        {{-- ADVANCED --}}
                        <li>

                            <label class="training-level-label {{ request('level') === 'advanced' ? 'active' : '' }}">

                                <input
                                    type="radio"
                                    name="level"
                                    value="advanced"
                                    {{ request('level') === 'advanced' ? 'checked' : '' }}
                                    onchange="this.form.submit()"
                                >

                                Advanced

                            </label>

                        </li>

                    </ul>

                </div>


                {{-- APPLY --}}
                <button type="submit" class="training-apply-button">

                    <i class="bi bi-search me-1"></i>

                    Apply Filters

                </button>

            </form>

        </aside>


        {{-- =================================================
             RIGHT: TRAINING LIST
        ================================================== --}}

        <main>

            <div class="training-section-header">

                <div>

                    <h2 class="training-section-title">
                        Available Trainings
                    </h2>

                    <div class="training-section-subtitle">
                        Choose a training and start building your skills
                    </div>

                </div>

            </div>


            {{-- TRAINING GRID --}}
            @if ($trainings->isNotEmpty())

                <div class="training-grid">

                    @foreach ($trainings as $training)

                        <article class="training-card">

                            {{-- TRAINING IMAGE --}}
                            <img
                                src="{{ $training->thumbnail
                                    ? asset('storage/' . $training->thumbnail)
                                    : 'https://via.placeholder.com/600x350?text=Training'
                                }}"
                                class="training-card-image"
                                alt="{{ $training->title }}"
                            >


                            <div class="training-card-content">

                                {{-- BADGES --}}
                                <div class="training-card-badges">

                                    @if ($training->level)

                                        <span class="training-badge">
                                            {{ ucfirst($training->level) }}
                                        </span>

                                    @endif


                                    @if ($training->category)

                                        <span class="training-badge">
                                            {{ $training->category }}
                                        </span>

                                    @endif


                                    @if ($training->duration)

                                        <span class="training-badge">
                                            {{ $training->duration }}
                                        </span>

                                    @endif

                                </div>


                                {{-- TITLE --}}
                                <h3 class="training-card-title">
                                    {{ $training->title }}
                                </h3>


                                {{-- DESCRIPTION --}}
                                <p class="training-description">

                                    {{ Str::limit(
                                        $training->short_description ?? '',
                                        100
                                    ) }}

                                </p>


                                {{-- DETAILS BUTTON --}}
                                <a
                                    href="{{ route('student.trainings.show', $training) }}"
                                    class="training-view-btn"
                                >

                                    View Training Details

                                    <i class="bi bi-arrow-right"></i>

                                </a>

                            </div>

                        </article>

                    @endforeach

                </div>

            @else

                {{-- EMPTY STATE --}}
                <div class="training-empty">

                    <div class="training-empty-icon">
                        <i class="bi bi-collection"></i>
                    </div>

                    <h5>
                        No Trainings Available
                    </h5>

                    <p>
                        No trainings match your search right now.
                        Please check back soon!
                    </p>

                </div>

            @endif


            {{-- PAGINATION --}}
            @if ($trainings->hasPages())

                <div class="training-pagination">

                    {{ $trainings->withQueryString()->links() }}

                </div>

            @endif

        </main>

    </div>

</div>

@endsection


@extends('layouts.app')

@php($portal = 'student')

@section('title', 'Browse Trainings')

@section('content')

<style>
    /* =========================================================
       TECH LEADERS NETWORK - STUDENT TRAININGS
       Design matched with Student Mentorship / Mock Interview section
    ========================================================= */

    :root {
        --training-primary: #3376F2;
        --training-primary-dark: #245ED1;
        --training-purple: #7C4DFF;
        --training-green: #16A34A;
        --training-bg: #F6F8FC;
        --training-card: #FFFFFF;
        --training-text: #172033;
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
       HERO SECTION (grid-based, matches Mock Interviews page)
    ========================================================= */

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
        background: linear-gradient(90deg, var(--training-primary), var(--training-purple));
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

    /* -- illustration -- */

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

    .training-line.medium { width: 80%; }
    .training-line.short { width: 55%; }

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

    /* -- feature list -- */

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

    .training-feature-icon.blue { background: #EAF1FF; color: var(--training-primary); }
    .training-feature-icon.purple { background: #F3EEFF; color: var(--training-purple); }
    .training-feature-icon.green { background: #E9FBF0; color: var(--training-green); }

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
    ========================================================= */

    .training-section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 5px 2px 17px;
    }

    .training-section-title {
        font-size: 23px;
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
       SEARCH BOX
    ========================================================= */

    .training-search-card {
        background: #fff;
        border: 1px solid var(--training-border);
        border-radius: 14px;
        padding: 18px;
        margin-bottom: 24px;
        box-shadow: 0 3px 12px rgba(25, 45, 80, .025);
    }

    .training-search-form {
        display: flex;
        gap: 12px;
        align-items: center;
    }

    .training-search-input {
        height: 46px;
        border: 1px solid #DCE3EE;
        border-radius: 8px;
        padding: 0 15px;
        font-size: 14px;
        color: #263247;
        width: 100%;
        outline: none;
        transition: .2s;
    }

    .training-search-input:focus {
        border-color: var(--training-primary);
        box-shadow: 0 0 0 3px rgba(51, 118, 242, .08);
    }

    .training-search-select {
        height: 46px;
        border: 1px solid #DCE3EE;
        border-radius: 8px;
        padding: 0 14px;
        font-size: 14px;
        color: #263247;
        outline: none;
        background: #fff;
        min-width: 180px;
    }

    .training-search-select:focus {
        border-color: var(--training-primary);
    }

    .training-search-button {
        height: 46px;
        min-width: 115px;
        border: none;
        border-radius: 8px;
        background: var(--training-primary);
        color: #fff;
        font-size: 14px;
        font-weight: 600;
        padding: 0 20px;
        transition: .2s;
    }

    .training-search-button:hover {
        background: var(--training-primary-dark);
    }

    /* =========================================================
       TRAINING CARDS
    ========================================================= */

    .training-card {
        background: #fff;
        border: 1px solid var(--training-border);
        border-radius: 14px;
        overflow: hidden;
        height: 100%;
        transition: all .25s ease;
        box-shadow: 0 3px 12px rgba(25, 45, 80, .025);
    }

    .training-card:hover {
        transform: translateY(-4px);
        border-color: #D5E1FA;
        box-shadow: 0 12px 30px rgba(31, 65, 114, .09);
    }

    .training-image-wrapper {
        height: 175px;
        background: #F3F6FB;
        overflow: hidden;
        position: relative;
    }

    .training-thumb {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform .35s ease;
    }

    .training-card:hover .training-thumb {
        transform: scale(1.04);
    }

    .training-category {
        position: absolute;
        left: 13px;
        top: 13px;
        background: rgba(255, 255, 255, .94);
        color: var(--training-primary);
        border-radius: 6px;
        padding: 6px 10px;
        font-size: 11px;
        font-weight: 700;
        box-shadow: 0 4px 12px rgba(0,0,0,.07);
    }

    .training-card-body {
        padding: 19px;
        display: flex;
        flex-direction: column;
        min-height: 215px;
    }

    .training-card-title {
        font-size: 17px;
        line-height: 1.4;
        font-weight: 700;
        color: var(--training-text);
        margin: 0 0 8px;
    }

    .training-description {
        font-size: 13px;
        line-height: 1.6;
        color: #778196;
        margin-bottom: 15px;
    }

    .training-meta {
        display: flex;
        align-items: center;
        gap: 17px;
        margin-bottom: 17px;
        color: #7A8496;
        font-size: 12px;
    }

    .training-meta-item {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .training-meta-item i {
        color: var(--training-primary);
        font-size: 13px;
    }

    .training-view-btn {
        width: 100%;
        height: 40px;
        border-radius: 7px;
        background: #3376F2;
        border: none;
        color: #fff !important;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        margin-top: auto;
        transition: .2s;
    }

    .training-view-btn:hover {
        background: var(--training-primary-dark);
        color: #fff !important;
    }

    /* =========================================================
       EMPTY STATE
    ========================================================= */

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
    ========================================================= */

    .training-pagination {
        margin-top: 28px;
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
    ========================================================= */

    @media (max-width: 1100px) {

        .hero-grid {
            grid-template-columns: 1fr;
        }

        .training-illustration {
            margin: 8px 0 0;
        }
    }

    @media (max-width: 900px) {

        .training-search-form {
            flex-wrap: wrap;
        }

        .training-search-input {
            flex: 1 1 100%;
        }

        .training-search-select {
            flex: 1;
        }

        .training-search-button {
            flex: 0 0 120px;
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
        }

        .training-search-form {
            display: block;
        }

        .training-search-input,
        .training-search-select,
        .training-search-button {
            width: 100%;
            margin-bottom: 10px;
        }

        .training-section-title {
            font-size: 20px;
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

            {{-- LEFT: copy + actions --}}
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


            {{-- CENTER: illustration --}}
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


            {{-- RIGHT: feature list --}}
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
         AVAILABLE TRAININGS HEADER
    ====================================================== --}}

    <div class="training-section-header" id="available-trainings">

        <div>
            <h2 class="training-section-title">
                Available Trainings
            </h2>

            <div class="training-section-subtitle">
                Choose a training and start building your skills
            </div>
        </div>

    </div>


    {{-- =====================================================
         SEARCH & FILTER
    ====================================================== --}}

    <div class="training-search-card" id="training-search">

        <form method="GET" class="training-search-form">

            <input
                type="text"
                name="search"
                class="training-search-input"
                placeholder="Search by title, technology, category..."
                value="{{ request('search') }}"
            >

            <select name="level" class="training-search-select">

                <option value="">
                    All Levels
                </option>

                @foreach (['beginner','intermediate','advanced'] as $lvl)

                    <option
                        value="{{ $lvl }}"
                        @selected(request('level') === $lvl)
                    >
                        {{ ucfirst($lvl) }}
                    </option>

                @endforeach

            </select>

            <button type="submit" class="training-search-button">

                <i class="bi bi-search"></i>
                Search

            </button>

        </form>

    </div>


    {{-- =====================================================
         TRAINING CARDS
    ====================================================== --}}

    <div class="row g-4">

        @forelse ($trainings as $training)

            <div class="col-xl-4 col-lg-4 col-md-6">

                <div class="training-card">

                    {{-- Image --}}
                    <div class="training-image-wrapper">

                        <img
                            src="{{ $training->thumbnail
                                ? asset('storage/'.$training->thumbnail)
                                : 'https://via.placeholder.com/600x350?text=Training'
                            }}"
                            class="training-thumb"
                            alt="{{ $training->title }}"
                        >

                        @if($training->category)

                            <div class="training-category">
                                {{ $training->category }}
                            </div>

                        @endif

                    </div>


                    {{-- Card Body --}}
                    <div class="training-card-body">

                        <h5 class="training-card-title">
                            {{ $training->title }}
                        </h5>


                        <p class="training-description">

                            {{ Str::limit(
                                $training->short_description,
                                100
                            ) }}

                        </p>


                        <div class="training-meta">

                            <div class="training-meta-item">

                                <i class="bi bi-bar-chart-fill"></i>

                                <span>
                                    {{ ucfirst($training->level) }}
                                </span>

                            </div>


                            <div class="training-meta-item">

                                <i class="bi bi-clock-fill"></i>

                                <span>
                                    {{ $training->duration }}
                                </span>

                            </div>

                        </div>


                        <a
                            href="{{ route('student.trainings.show', $training) }}"
                            class="training-view-btn"
                        >

                            View Training Details

                            <i class="bi bi-arrow-right"></i>

                        </a>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

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

            </div>

        @endforelse

    </div>


    {{-- =====================================================
         PAGINATION
    ====================================================== --}}

    @if($trainings->hasPages())

        <div class="training-pagination">
            {{ $trainings->links() }}
        </div>

    @endif

</div>

@endsection
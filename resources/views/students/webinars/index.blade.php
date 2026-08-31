@extends('layouts.app')

@php
    $portal = 'student';
@endphp

@section('title', 'Events & Webinars')

@section('content')

<style>
    :root {
        --event-primary: #3376F2;
        --event-primary-dark: #245ED1;
        --event-purple: #7C4DFF;
        --event-bg: #F6F8FC;
        --event-card: #FFFFFF;
        --event-text: #172033;
        --event-muted: #6B7280;
        --event-border: #E6EAF0;
        --event-success: #16A34A;
        --event-warning: #F59E0B;
        --event-danger: #EF4444;
        --event-shadow: 0 8px 28px rgba(31, 41, 55, 0.07);
    }

    .events-page {
        background: var(--event-bg);
        min-height: calc(100vh - 80px);
        padding: 34px 0 60px;
    }

    .events-container {
        width: min(1320px, calc(100% - 40px));
        margin: 0 auto;
    }

    /* =========================
       HERO (light, "training" style)
    ========================= */

    .events-hero {
        background: #FFFFFF;
        border: 1px solid var(--event-border);
        border-radius: 24px;
        padding: 44px 46px;
        position: relative;
        overflow: hidden;
        margin-bottom: 28px;
        box-shadow: var(--event-shadow);
    }

    .hero-grid {
        position: relative;
        z-index: 2;
        display: grid;
        grid-template-columns: 1.15fr 1fr;
        gap: 30px;
        align-items: center;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #EAF1FF;
        color: var(--event-primary);
        border: 1px solid #D9E6FF;
        padding: 7px 15px;
        border-radius: 999px;
        font-size: 12.5px;
        font-weight: 700;
        margin-bottom: 18px;
    }

    .hero-title {
        font-size: 36px;
        line-height: 1.18;
        font-weight: 800;
        margin: 0 0 14px;
        letter-spacing: -0.6px;
        color: var(--event-text);
    }

    .hero-title span {
        display: block;
        background: linear-gradient(90deg, var(--event-primary), var(--event-purple));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    .hero-text {
        margin: 0 0 26px;
        font-size: 15px;
        line-height: 1.75;
        color: var(--event-muted);
        max-width: 480px;
    }

    .hero-actions {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .hero-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 700;
        padding: 13px 22px;
        border-radius: 12px;
        transition: 0.2s ease;
    }

    .hero-btn-primary {
        background: var(--event-primary);
        color: #fff;
        box-shadow: 0 10px 22px rgba(51,118,242,0.24);
    }

    .hero-btn-primary:hover {
        background: var(--event-primary-dark);
        color: #fff;
        transform: translateY(-1px);
    }

    .hero-btn-outline {
        background: #fff;
        color: var(--event-text);
        border: 1px solid #DDE3EC;
    }

    .hero-btn-outline:hover {
        border-color: var(--event-primary);
        color: var(--event-primary);
    }

    /* -- right visual -- */

    .hero-right {
        display: flex;
        align-items: center;
        gap: 26px;
    }

    .hero-visual {
        position: relative;
        width: 170px;
        height: 190px;
        flex-shrink: 0;
    }

    .hero-visual-circle {
        position: absolute;
        top: 0;
        left: 10px;
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background: linear-gradient(135deg, #EAF1FF, #F3EEFF);
    }

    .hero-visual-card {
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

    .hero-visual-dot {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #DCE8FF;
        margin-bottom: 12px;
    }

    .hero-visual-line {
        height: 6px;
        border-radius: 4px;
        background: #EEF1F6;
        margin-bottom: 8px;
    }

    .hero-visual-line.w-80 { width: 80%; }
    .hero-visual-line.w-60 { width: 60%; }
    .hero-visual-line.w-40 { width: 40%; }

    .hero-visual-badge {
        position: absolute;
        right: -10px;
        bottom: 18px;
        width: 38px;
        height: 38px;
        border-radius: 12px;
        background: var(--event-primary);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        box-shadow: 0 8px 16px rgba(51,118,242,0.30);
    }

    .hero-visual-check {
        position: absolute;
        top: 8px;
        right: 4px;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: #E9FBF0;
        border: 1px solid #CFF5DC;
        color: var(--event-success);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
    }

    .hero-features {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .hero-feature-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .hero-feature-icon {
        width: 38px;
        height: 38px;
        border-radius: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        flex-shrink: 0;
    }

    .hero-feature-icon.icon-blue { background: #EAF1FF; color: var(--event-primary); }
    .hero-feature-icon.icon-purple { background: #F3EEFF; color: var(--event-purple); }
    .hero-feature-icon.icon-green { background: #E9FBF0; color: var(--event-success); }

    .hero-feature-title {
        font-size: 13.5px;
        font-weight: 700;
        color: var(--event-text);
        margin-bottom: 2px;
    }

    .hero-feature-text {
        font-size: 12px;
        color: var(--event-muted);
        line-height: 1.5;
    }

    /* =========================
       STAT CARDS
    ========================= */

    .event-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
        margin-bottom: 28px;
    }

    .event-stat-card {
        background: var(--event-card);
        border: 1px solid var(--event-border);
        border-radius: 18px;
        padding: 21px 22px;
        display: flex;
        align-items: center;
        gap: 15px;
        box-shadow: var(--event-shadow);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #EEF4FF;
        color: var(--event-primary);
        font-size: 21px;
        flex-shrink: 0;
    }

    .stat-value {
        font-size: 24px;
        line-height: 1;
        font-weight: 700;
        color: var(--event-text);
        margin-bottom: 5px;
    }

    .stat-label {
        font-size: 13px;
        color: var(--event-muted);
        font-weight: 500;
    }

    /* =========================
       FILTER CARD
    ========================= */

    .filter-card {
        background: #fff;
        border: 1px solid var(--event-border);
        border-radius: 20px;
        padding: 20px;
        box-shadow: var(--event-shadow);
        margin-bottom: 28px;
    }

    .filter-title {
        font-size: 16px;
        font-weight: 700;
        color: var(--event-text);
        margin-bottom: 14px;
    }

    .filter-form {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1fr auto;
        gap: 12px;
        align-items: end;
    }

    .filter-group label {
        display: block;
        font-size: 12px;
        font-weight: 600;
        color: #4B5563;
        margin-bottom: 7px;
    }

    .event-input,
    .event-select {
        width: 100%;
        height: 44px;
        border: 1px solid #DDE3EC;
        border-radius: 11px;
        padding: 0 13px;
        background: #fff;
        color: var(--event-text);
        font-size: 13px;
        outline: none;
        transition: 0.2s ease;
    }

    .event-input:focus,
    .event-select:focus {
        border-color: var(--event-primary);
        box-shadow: 0 0 0 3px rgba(51,118,242,0.10);
    }

    .event-search-btn {
        height: 44px;
        border: 0;
        border-radius: 11px;
        padding: 0 20px;
        background: var(--event-primary);
        color: #fff;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.2s ease;
        white-space: nowrap;
    }

    .event-search-btn:hover {
        background: var(--event-primary-dark);
        transform: translateY(-1px);
    }

    /* =========================
       SECTION HEADER
    ========================= */

    .section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 18px;
    }

    .section-heading {
        margin: 0;
        font-size: 22px;
        font-weight: 700;
        color: var(--event-text);
    }

    .section-subtitle {
        margin: 4px 0 0;
        font-size: 13px;
        color: var(--event-muted);
    }

    .view-my-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        background: #EEF4FF;
        color: var(--event-primary);
        border: 1px solid #DCE8FF;
        padding: 10px 15px;
        border-radius: 11px;
        font-size: 13px;
        font-weight: 600;
        transition: 0.2s ease;
    }

    .view-my-btn:hover {
        background: var(--event-primary);
        color: #fff;
    }

    /* =========================
       EVENT GRID
    ========================= */

    .events-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 22px;
    }

    .event-card {
        background: #fff;
        border: 1px solid var(--event-border);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--event-shadow);
        transition: transform 0.22s ease, box-shadow 0.22s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .event-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 15px 36px rgba(31,41,55,0.11);
    }

    .event-image {
        height: 185px;
        background: linear-gradient(135deg, #EEF4FF, #F5F1FF);
        position: relative;
        overflow: hidden;
    }

    .event-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .event-image-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--event-primary);
        font-size: 42px;
    }

    .event-type-badge {
        position: absolute;
        top: 13px;
        left: 13px;
        padding: 6px 10px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 700;
        background: rgba(255,255,255,0.94);
        color: var(--event-primary);
        border: 1px solid rgba(255,255,255,0.9);
        text-transform: capitalize;
    }

    .event-date-badge {
        position: absolute;
        top: 13px;
        right: 13px;
        width: 48px;
        height: 52px;
        border-radius: 12px;
        background: #fff;
        box-shadow: 0 6px 15px rgba(0,0,0,0.10);
        text-align: center;
        padding-top: 5px;
    }

    .event-date-day {
        font-size: 18px;
        line-height: 20px;
        font-weight: 700;
        color: var(--event-text);
    }

    .event-date-month {
        font-size: 9px;
        text-transform: uppercase;
        color: var(--event-primary);
        font-weight: 700;
    }

    .event-body {
        padding: 20px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .event-category {
        display: inline-flex;
        align-items: center;
        width: fit-content;
        background: #F4F6FA;
        color: #596273;
        border: 1px solid #E7EAF0;
        border-radius: 7px;
        padding: 5px 9px;
        font-size: 10px;
        font-weight: 600;
        margin-bottom: 11px;
    }

    .event-title {
        font-size: 17px;
        line-height: 1.4;
        font-weight: 700;
        color: var(--event-text);
        margin: 0 0 9px;
    }

    .event-description {
        color: var(--event-muted);
        font-size: 12px;
        line-height: 1.6;
        margin-bottom: 15px;
    }

    .event-meta {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-bottom: 17px;
    }

    .event-meta-item {
        display: flex;
        align-items: center;
        gap: 9px;
        color: #5E6675;
        font-size: 12px;
    }

    .event-meta-item i {
        width: 18px;
        text-align: center;
        color: var(--event-primary);
    }

    .event-footer {
        margin-top: auto;
        padding-top: 14px;
        border-top: 1px solid #EEF0F4;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .event-seats {
        font-size: 11px;
        color: var(--event-muted);
    }

    .event-seats i {
        color: var(--event-primary);
    }

    .event-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        min-height: 38px;
        padding: 0 14px;
        border-radius: 9px;
        text-decoration: none;
        font-size: 12px;
        font-weight: 600;
        transition: 0.2s ease;
    }

    .event-btn-primary {
        background: var(--event-primary);
        color: #fff;
    }

    .event-btn-primary:hover {
        background: var(--event-primary-dark);
        color: #fff;
    }

    .event-btn-success {
        background: #ECFDF3;
        color: var(--event-success);
        border: 1px solid #CFF5DC;
    }

    .event-btn-warning {
        background: #FFF7E8;
        color: #B77908;
        border: 1px solid #FBE4B3;
    }

    /* =========================
       EMPTY
    ========================= */

    .events-empty {
        background: #fff;
        border: 1px dashed #D8DEE8;
        border-radius: 20px;
        padding: 55px 20px;
        text-align: center;
        margin-bottom: 25px;
    }

    .events-empty-icon {
        width: 70px;
        height: 70px;
        margin: 0 auto 15px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #EEF4FF;
        color: var(--event-primary);
        font-size: 30px;
    }

    .events-empty h4 {
        font-size: 18px;
        color: var(--event-text);
        font-weight: 700;
        margin-bottom: 6px;
    }

    .events-empty p {
        color: var(--event-muted);
        font-size: 13px;
        margin: 0;
    }

    /* =========================
       UPCOMING
    ========================= */

    .upcoming-section {
        margin-top: 42px;
    }

    .upcoming-card {
        background: #fff;
        border: 1px solid var(--event-border);
        border-radius: 17px;
        padding: 16px;
        display: flex;
        align-items: center;
        gap: 15px;
        box-shadow: var(--event-shadow);
        margin-bottom: 12px;
    }

    .upcoming-date {
        width: 56px;
        height: 62px;
        border-radius: 13px;
        background: #EEF4FF;
        color: var(--event-primary);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .upcoming-date-day {
        font-size: 21px;
        line-height: 20px;
        font-weight: 700;
    }

    .upcoming-date-month {
        font-size: 9px;
        font-weight: 700;
        text-transform: uppercase;
        margin-top: 4px;
    }

    .upcoming-info {
        flex: 1;
        min-width: 0;
    }

    .upcoming-title {
        color: var(--event-text);
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .upcoming-meta {
        color: var(--event-muted);
        font-size: 11px;
    }

    .upcoming-action {
        flex-shrink: 0;
    }

    /* =========================
       PAGINATION
    ========================= */

    .event-pagination {
        margin-top: 30px;
        display: flex;
        justify-content: center;
    }

    .event-pagination nav {
        display: flex;
        justify-content: center;
    }

    .event-pagination .pagination {
        gap: 5px;
        margin: 0;
    }

    .event-pagination .page-link {
        border: 1px solid #DDE3EC;
        border-radius: 9px !important;
        color: #4B5563;
        font-size: 12px;
        min-width: 38px;
        text-align: center;
    }

    .event-pagination .page-item.active .page-link {
        background: var(--event-primary);
        border-color: var(--event-primary);
        color: #fff;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 1100px) {
        .filter-form {
            grid-template-columns: repeat(2, 1fr);
        }

        .filter-form .search-field {
            grid-column: span 2;
        }

        .events-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .hero-grid {
            grid-template-columns: 1fr;
        }

        .hero-right {
            justify-content: flex-start;
        }
    }

    @media (max-width: 768px) {
        .events-container {
            width: min(100% - 24px, 1320px);
        }

        .events-page {
            padding: 20px 0 40px;
        }

        .events-hero {
            padding: 28px 24px;
            border-radius: 19px;
        }

        .hero-title {
            font-size: 27px;
        }

        .hero-right {
            display: flex;
            flex-wrap: wrap;
        }

        .event-stats {
            grid-template-columns: 1fr;
        }

        .filter-form {
            grid-template-columns: 1fr;
        }

        .filter-form .search-field {
            grid-column: auto;
        }

        .events-grid {
            grid-template-columns: 1fr;
        }

        .section-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .upcoming-card {
            align-items: flex-start;
        }

        .upcoming-action {
            margin-left: auto;
        }
    }

    @media (max-width: 500px) {
        .event-image {
            height: 165px;
        }

        .event-footer {
            align-items: flex-start;
            flex-direction: column;
        }

        .event-btn {
            width: 100%;
        }

        .upcoming-card {
            flex-wrap: wrap;
        }

        .upcoming-action {
            width: 100%;
            margin-left: 0;
        }

        .upcoming-action .event-btn {
            width: 100%;
        }

        .hero-visual {
            display: none;
        }
    }
</style>

<div class="events-page">

    <div class="events-container">

        {{-- =====================================================
             HERO
        ====================================================== --}}
        <div class="events-hero">

            <div class="hero-grid">

                {{-- LEFT: copy + actions --}}
                <div class="hero-left">

                    <div class="hero-badge">
                        <i class="bi bi-calendar-event"></i>
                        Student Events &amp; Learning
                    </div>

                    <h1 class="hero-title">
                        Events, Webinars &amp;
                        <span>Workshops</span>
                    </h1>

                    <p class="hero-text">
                        Join live webinars and practical workshops conducted by
                        experienced mentors. Learn new skills, connect with experts,
                        and grow your professional network.
                    </p>

                    <div class="hero-actions">

                        <a href="#events-grid" class="hero-btn hero-btn-primary">
                            <i class="bi bi-grid"></i>
                            Explore Events
                        </a>

                        @if (Route::has('student.webinars.my'))
                            <a href="{{ route('student.webinars.my') }}" class="hero-btn hero-btn-outline">
                                <i class="bi bi-bookmark-check"></i>
                                My Webinars
                            </a>
                        @endif

                    </div>

                </div>

                {{-- RIGHT: illustration + feature list --}}
                <div class="hero-right">

                    <div class="hero-visual">
                        <div class="hero-visual-circle"></div>

                        <div class="hero-visual-card">
                            <div class="hero-visual-dot"></div>
                            <div class="hero-visual-line w-80"></div>
                            <div class="hero-visual-line w-60"></div>
                            <div class="hero-visual-line w-40"></div>
                        </div>

                        <div class="hero-visual-badge">
                            <i class="bi bi-mortarboard-fill"></i>
                        </div>

                        <div class="hero-visual-check">
                            <i class="bi bi-check-lg"></i>
                        </div>
                    </div>

                    <div class="hero-features">

                        <div class="hero-feature-item">
                            <div class="hero-feature-icon icon-blue">
                                <i class="bi bi-camera-video"></i>
                            </div>
                            <div>
                                <div class="hero-feature-title">Expert-Led Sessions</div>
                                <div class="hero-feature-text">Learn directly from industry professionals</div>
                            </div>
                        </div>

                        <div class="hero-feature-item">
                            <div class="hero-feature-icon icon-purple">
                                <i class="bi bi-lightbulb"></i>
                            </div>
                            <div>
                                <div class="hero-feature-title">Practical Learning</div>
                                <div class="hero-feature-text">Build skills through real, hands-on projects</div>
                            </div>
                        </div>

                        <div class="hero-feature-item">
                            <div class="hero-feature-icon icon-green">
                                <i class="bi bi-graph-up-arrow"></i>
                            </div>
                            <div>
                                <div class="hero-feature-title">Career Growth</div>
                                <div class="hero-feature-text">Improve your skills and confidence</div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
             STATS
        ====================================================== --}}
        <div class="event-stats">

            <div class="event-stat-card">
                <div class="stat-icon">
                    <i class="bi bi-calendar3"></i>
                </div>

                <div>
                    <div class="stat-value">
                        {{ $counts['all'] ?? 0 }}
                    </div>

                    <div class="stat-label">
                        Available Events
                    </div>
                </div>
            </div>


            <div class="event-stat-card">
                <div class="stat-icon">
                    <i class="bi bi-camera-video"></i>
                </div>

                <div>
                    <div class="stat-value">
                        {{ $counts['webinar'] ?? 0 }}
                    </div>

                    <div class="stat-label">
                        Webinars
                    </div>
                </div>
            </div>


            <div class="event-stat-card">
                <div class="stat-icon">
                    <i class="bi bi-mortarboard"></i>
                </div>

                <div>
                    <div class="stat-value">
                        {{ $counts['workshop'] ?? 0 }}
                    </div>

                    <div class="stat-label">
                        Workshops
                    </div>
                </div>
            </div>

        </div>


        {{-- =====================================================
             FILTER
        ====================================================== --}}
        <div class="filter-card">

            <div class="filter-title">
                <i class="bi bi-sliders me-1"></i>
                Find an Event
            </div>

            <form method="GET"
                  action="{{ route('student.webinars.index') }}"
                  class="filter-form">

                {{-- SEARCH --}}
                <div class="filter-group search-field">

                    <label for="event-search">
                        Search
                    </label>

                    <input
                        id="event-search"
                        type="text"
                        name="q"
                        class="event-input"
                        value="{{ $search ?? request('q') }}"
                        placeholder="Search webinars, workshops..."
                    >

                </div>


                {{-- TYPE --}}
                <div class="filter-group">

                    <label for="event-type">
                        Type
                    </label>

                    <select
                        id="event-type"
                        name="type"
                        class="event-select"
                    >

                        <option value="">
                            All Types
                        </option>

                        <option value="webinar"
                            @selected(($activeType ?? request('type')) === 'webinar')>
                            Webinar
                        </option>

                        <option value="workshop"
                            @selected(($activeType ?? request('type')) === 'workshop')>
                            Workshop
                        </option>

                    </select>

                </div>


                {{-- DATE --}}
                <div class="filter-group">

                    <label for="event-date">
                        Date
                    </label>

                    <select
                        id="event-date"
                        name="date"
                        class="event-select"
                    >

                        <option value="">
                            Any Date
                        </option>

                        <option value="today"
                            @selected(($activeDate ?? request('date')) === 'today')>
                            Today
                        </option>

                        <option value="week"
                            @selected(($activeDate ?? request('date')) === 'week')>
                            This Week
                        </option>

                        <option value="month"
                            @selected(($activeDate ?? request('date')) === 'month')>
                            This Month
                        </option>

                    </select>

                </div>


                {{-- SORT --}}
                <div class="filter-group">

                    <label for="event-sort">
                        Sort
                    </label>

                    <select
                        id="event-sort"
                        name="sort"
                        class="event-select"
                    >

                        <option value="upcoming"
                            @selected(($activeSort ?? request('sort', 'upcoming')) === 'upcoming')>
                            Upcoming
                        </option>

                        <option value="newest"
                            @selected(($activeSort ?? request('sort')) === 'newest')>
                            Newest
                        </option>

                    </select>

                </div>


                {{-- SEARCH BUTTON --}}
                <div class="filter-group">

                    <button type="submit" class="event-search-btn">
                        <i class="bi bi-search me-1"></i>
                        Search
                    </button>

                </div>

            </form>

        </div>


        {{-- =====================================================
             EVENTS HEADER
        ====================================================== --}}
        <div class="section-header" id="events-grid">

            <div>
                <h2 class="section-heading">
                    Available Events
                </h2>

                <p class="section-subtitle">
                    Explore upcoming webinars and workshops
                </p>
            </div>

        </div>


        {{-- =====================================================
             EVENT LIST
        ====================================================== --}}

        @if ($events->count() > 0)

            <div class="events-grid">

                @foreach ($events as $event)

                    @php
                        $registrationStatus = $myRegistrations[$event->id] ?? null;

                        $eventDate = null;

                        if ($event->scheduled_date) {
                            try {
                                $eventDate = \Carbon\Carbon::parse($event->scheduled_date);
                            } catch (\Throwable $e) {
                                $eventDate = null;
                            }
                        }

                        $image = $event->thumbnail
                            ?? $event->image
                            ?? $event->banner
                            ?? null;

                        $mentorName = optional($event->mentor)->name;

                        $description = $event->short_description
                            ?? $event->description
                            ?? null;

                        $duration = $event->duration
                            ?? null;
                    @endphp


                    <div class="event-card">

                        {{-- IMAGE --}}
                        <div class="event-image">

                            @if ($image)

                                <img
                                    src="{{ asset('storage/' . $image) }}"
                                    alt="{{ $event->title }}"
                                >

                            @else

                                <div class="event-image-placeholder">
                                    @if (($event->type ?? '') === 'workshop')
                                        <i class="bi bi-mortarboard"></i>
                                    @else
                                        <i class="bi bi-camera-video"></i>
                                    @endif
                                </div>

                            @endif


                            {{-- TYPE --}}
                            <span class="event-type-badge">

                                @if (($event->type ?? '') === 'workshop')
                                    <i class="bi bi-mortarboard me-1"></i>
                                @else
                                    <i class="bi bi-camera-video me-1"></i>
                                @endif

                                {{ ucfirst($event->type ?? 'event') }}

                            </span>


                            {{-- DATE --}}
                            @if ($eventDate)

                                <div class="event-date-badge">

                                    <div class="event-date-day">
                                        {{ $eventDate->format('d') }}
                                    </div>

                                    <div class="event-date-month">
                                        {{ $eventDate->format('M') }}
                                    </div>

                                </div>

                            @endif

                        </div>


                        {{-- BODY --}}
                        <div class="event-body">

                            {{-- CATEGORY --}}
                            @if ($event->category)

                                <span class="event-category">
                                    <i class="bi bi-tag me-1"></i>
                                    {{ ucwords(str_replace('_', ' ', $event->category)) }}
                                </span>

                            @endif


                            {{-- TITLE --}}
                            <h3 class="event-title">
                                {{ $event->title }}
                            </h3>


                            {{-- DESCRIPTION --}}
                            @if ($description)

                                <div class="event-description">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($description), 105) }}
                                </div>

                            @else

                                <div class="event-description">
                                    Join this event to learn from experienced
                                    professionals and mentors.
                                </div>

                            @endif


                            {{-- META --}}
                            <div class="event-meta">

                                @if ($eventDate)

                                    <div class="event-meta-item">
                                        <i class="bi bi-calendar3"></i>

                                        <span>
                                            {{ $eventDate->format('d M Y') }}
                                        </span>
                                    </div>

                                @endif


                                @if ($event->scheduled_time)

                                    <div class="event-meta-item">
                                        <i class="bi bi-clock"></i>

                                        <span>
                                            {{ \Carbon\Carbon::parse($event->scheduled_time)->format('h:i A') }}
                                        </span>
                                    </div>

                                @endif


                                @if ($mentorName)

                                    <div class="event-meta-item">
                                        <i class="bi bi-person"></i>

                                        <span>
                                            {{ $mentorName }}
                                        </span>
                                    </div>

                                @endif


                                @if ($duration)

                                    <div class="event-meta-item">
                                        <i class="bi bi-hourglass-split"></i>

                                        <span>
                                            {{ $duration }}
                                        </span>
                                    </div>

                                @endif

                            </div>


                            {{-- FOOTER --}}
                            <div class="event-footer">

                                <div class="event-seats">

                                    <i class="bi bi-people me-1"></i>

                                    {{ $event->registrations_count ?? 0 }}
                                    registered

                                </div>


                                <div>

                                    @if ($registrationStatus === 'approved')

                                        <a
                                            href="{{ route('student.webinars.show', $event) }}"
                                            class="event-btn event-btn-success"
                                        >
                                            <i class="bi bi-check-circle"></i>
                                            Registered
                                        </a>

                                    @elseif ($registrationStatus === 'pending')

                                        <a
                                            href="{{ route('student.webinars.show', $event) }}"
                                            class="event-btn event-btn-warning"
                                        >
                                            <i class="bi bi-hourglass-split"></i>
                                            Waitlisted
                                        </a>

                                    @else

                                        <a
                                            href="{{ route('student.webinars.show', $event) }}"
                                            class="event-btn event-btn-primary"
                                        >
                                            View Details
                                            <i class="bi bi-arrow-right"></i>
                                        </a>

                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>


            {{-- PAGINATION --}}
            @if ($events->hasPages())

                <div class="event-pagination">

                    {{ $events->onEachSide(1)->links() }}

                </div>

            @endif

        @else

            {{-- EMPTY STATE --}}
            <div class="events-empty">

                <div class="events-empty-icon">
                    <i class="bi bi-calendar-x"></i>
                </div>

                <h4>
                    No events found
                </h4>

                <p>
                    We couldn't find any webinars or workshops matching
                    your search criteria.
                </p>

            </div>

        @endif


        {{-- =====================================================
             UPCOMING EVENTS
        ====================================================== --}}

        @if ($upcoming && $upcoming->count() > 0)

            <section class="upcoming-section">

                <div class="section-header">

                    <div>
                        <h2 class="section-heading">
                            Upcoming Events
                        </h2>

                        <p class="section-subtitle">
                            Don't miss these upcoming learning opportunities
                        </p>
                    </div>

                </div>


                @foreach ($upcoming as $event)

                    @php
                        $upcomingDate = null;

                        if ($event->scheduled_date) {
                            try {
                                $upcomingDate = \Carbon\Carbon::parse($event->scheduled_date);
                            } catch (\Throwable $e) {
                                $upcomingDate = null;
                            }
                        }

                        $registrationStatus = $myRegistrations[$event->id] ?? null;
                    @endphp


                    <div class="upcoming-card">

                        @if ($upcomingDate)

                            <div class="upcoming-date">

                                <div class="upcoming-date-day">
                                    {{ $upcomingDate->format('d') }}
                                </div>

                                <div class="upcoming-date-month">
                                    {{ $upcomingDate->format('M') }}
                                </div>

                            </div>

                        @else

                            <div class="upcoming-date">
                                <i class="bi bi-calendar-event"></i>
                            </div>

                        @endif


                        <div class="upcoming-info">

                            <div class="upcoming-title">
                                {{ $event->title }}
                            </div>

                            <div class="upcoming-meta">

                                @if ($event->scheduled_time)

                                    <i class="bi bi-clock me-1"></i>

                                    {{ \Carbon\Carbon::parse($event->scheduled_time)->format('h:i A') }}

                                @endif


                                @if ($event->mentor)

                                    <span class="mx-2">•</span>

                                    <i class="bi bi-person me-1"></i>

                                    {{ $event->mentor->name }}

                                @endif

                            </div>

                        </div>


                        <div class="upcoming-action">

                            @if ($registrationStatus === 'approved')

                                <a
                                    href="{{ route('student.webinars.show', $event) }}"
                                    class="event-btn event-btn-success"
                                >
                                    <i class="bi bi-check-circle"></i>
                                    Registered
                                </a>

                            @elseif ($registrationStatus === 'pending')

                                <a
                                    href="{{ route('student.webinars.show', $event) }}"
                                    class="event-btn event-btn-warning"
                                >
                                    <i class="bi bi-hourglass-split"></i>
                                    Waitlisted
                                </a>

                            @else

                                <a
                                    href="{{ route('student.webinars.show', $event) }}"
                                    class="event-btn event-btn-primary"
                                >
                                    View Details
                                    <i class="bi bi-arrow-right"></i>
                                </a>

                            @endif

                        </div>

                    </div>

                @endforeach

            </section>

        @endif

    </div>

</div>

@endsection
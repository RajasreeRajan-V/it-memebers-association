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
       HERO (unchanged)
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
       STAT CARDS (unchanged)
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
       NEW: SIDEBAR FILTER
       (styled after employees portal filter panel)
    ========================= */

    .events-body-grid {
        display: grid;
        grid-template-columns: 272px 1fr;
        gap: 22px;
        align-items: start;
    }

    .filter-sidebar {
        background: #fff;
        border: 1px solid var(--event-border);
        border-radius: 18px;
        padding: 20px;
        box-shadow: var(--event-shadow);
        position: sticky;
        top: 20px;
    }

    .filter-sidebar-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        padding-bottom: 14px;
        border-bottom: 1px solid var(--event-border);
        margin-bottom: 14px;
    }

    .filter-sidebar-title {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 15px;
        font-weight: 700;
        color: var(--event-text);
    }

    .filter-clear-link {
        font-size: 12.5px;
        font-weight: 600;
        color: var(--event-primary);
        text-decoration: none;
    }

    .filter-clear-link:hover {
        text-decoration: underline;
    }

    .filter-block {
        padding: 15px 0;
        border-bottom: 1px solid #F0F2F6;
    }

    .filter-block:last-of-type {
        border-bottom: none;
        padding-bottom: 4px;
    }

    .filter-block-label {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        color: #9AA3B2;
        margin-bottom: 10px;
    }

    .filter-search-input {
        width: 100%;
        height: 40px;
        border: 1px solid #DDE3EC;
        border-radius: 9px;
        padding: 0 12px;
        font-size: 13px;
        color: var(--event-text);
        outline: none;
        transition: 0.2s ease;
    }

    .filter-search-input:focus {
        border-color: var(--event-primary);
        box-shadow: 0 0 0 3px rgba(51,118,242,0.10);
    }

    .filter-options {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .filter-radio-option {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 9px;
        border-radius: 9px;
        font-size: 13px;
        color: #4B5563;
        cursor: pointer;
        transition: 0.15s ease;
    }

    .filter-radio-option:hover {
        background: #F6F8FC;
    }

    .filter-radio-option.active {
        background: #EAF1FF;
        color: var(--event-primary);
        font-weight: 600;
    }

    .filter-radio-option input {
        accent-color: var(--event-primary);
        width: 15px;
        height: 15px;
        flex-shrink: 0;
    }

    .filter-apply-btn {
        width: 100%;
        height: 42px;
        border: 0;
        border-radius: 10px;
        background: var(--event-primary);
        color: #fff;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        margin-top: 8px;
        transition: 0.2s ease;
    }

    .filter-apply-btn:hover {
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
        margin-bottom: 16px;
    }

    .section-heading {
        margin: 0;
        font-size: 20px;
        font-weight: 700;
        color: var(--event-text);
    }

    .section-subtitle {
        margin: 4px 0 0;
        font-size: 13px;
        color: var(--event-muted);
    }

    .sort-inline {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-shrink: 0;
    }

    .sort-inline label {
        font-size: 13px;
        font-weight: 500;
        color: var(--event-muted);
    }

    .sort-inline select {
        height: 38px;
        border: 1px solid #DDE3EC;
        border-radius: 9px;
        padding: 0 10px;
        font-size: 13px;
        font-weight: 600;
        color: var(--event-text);
        background: #fff;
        outline: none;
    }

    /* =========================
       NEW: EVENT LIST CARDS
       (styled after employees portal list rows)
    ========================= */

    .events-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .event-list-card {
        background: #fff;
        border: 1px solid var(--event-border);
        border-radius: 16px;
        padding: 16px;
        box-shadow: var(--event-shadow);
        transition: 0.2s ease;
    }

    .event-list-card:hover {
        border-color: #C9D6EE;
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(31,41,55,0.10);
    }

    .event-list-inner {
        display: flex;
        align-items: flex-start;
        gap: 14px;
    }

    .event-list-thumb {
        width: 64px;
        height: 64px;
        border-radius: 12px;
        object-fit: cover;
        flex-shrink: 0;
        background: #EEF4FF;
    }

    .event-list-thumb-placeholder {
        width: 64px;
        height: 64px;
        border-radius: 12px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        background: #EEF4FF;
        color: var(--event-primary);
    }

    .event-list-thumb-placeholder.is-workshop {
        background: #E9FBF0;
        color: var(--event-success);
    }

    .event-list-body {
        flex: 1;
        min-width: 0;
    }

    .event-list-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
    }

    .event-list-title-row {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
    }

    .event-list-title {
        font-size: 14.5px;
        font-weight: 700;
        color: var(--event-text);
        margin: 0;
    }

    .badge-pill {
        display: inline-flex;
        align-items: center;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        padding: 4px 9px;
        border-radius: 999px;
        flex-shrink: 0;
    }

    .badge-type-webinar { background: #EAF1FF; color: var(--event-primary); }
    .badge-type-workshop { background: #E9FBF0; color: var(--event-success); }
    .badge-category { background: #FFF7E8; color: #B77908; }

    .event-list-desc {
        font-size: 12.5px;
        color: var(--event-muted);
        line-height: 1.6;
        margin: 6px 0 8px;
        max-width: 640px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .event-list-meta {
        font-size: 12px;
        color: #8C93A3;
        font-weight: 500;
    }

    .event-list-meta .meta-sep {
        margin: 0 6px;
        color: #C7CEDB;
    }

    .event-list-side {
        text-align: right;
        flex-shrink: 0;
    }

    .event-list-seats {
        font-size: 13px;
        font-weight: 700;
        color: #596273;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 5px;
        white-space: nowrap;
    }

    .event-list-seats i { color: var(--event-primary); }

    .event-list-relative {
        font-size: 11px;
        color: var(--event-muted);
        margin-top: 4px;
        white-space: nowrap;
    }

    .event-list-action {
        margin-top: 12px;
    }

    .event-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        min-height: 36px;
        padding: 0 15px;
        border-radius: 9px;
        text-decoration: none;
        font-size: 12.5px;
        font-weight: 600;
        transition: 0.2s ease;
    }

    .event-btn-primary { background: var(--event-primary); color: #fff; }
    .event-btn-primary:hover { background: var(--event-primary-dark); color: #fff; }

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
       UPCOMING (unchanged)
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
        margin-top: 26px;
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
        .events-body-grid {
            grid-template-columns: 1fr;
        }

        .filter-sidebar {
            position: static;
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

        .section-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .event-list-inner {
            flex-wrap: wrap;
        }

        .event-list-side {
            text-align: left;
            width: 100%;
        }

        .event-list-seats {
            justify-content: flex-start;
        }

        .upcoming-card {
            align-items: flex-start;
        }

        .upcoming-action {
            margin-left: auto;
        }
    }

    @media (max-width: 500px) {
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
             HERO (unchanged)
        ====================================================== --}}
        <div class="events-hero">

            <div class="hero-grid">

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
             STATS (unchanged)
        ====================================================== --}}
        <div class="event-stats">

            <div class="event-stat-card">
                <div class="stat-icon">
                    <i class="bi bi-calendar3"></i>
                </div>

                <div>
                    <div class="stat-value">{{ $counts['all'] ?? 0 }}</div>
                    <div class="stat-label">Available Events</div>
                </div>
            </div>

            <div class="event-stat-card">
                <div class="stat-icon">
                    <i class="bi bi-camera-video"></i>
                </div>

                <div>
                    <div class="stat-value">{{ $counts['webinar'] ?? 0 }}</div>
                    <div class="stat-label">Webinars</div>
                </div>
            </div>

            <div class="event-stat-card">
                <div class="stat-icon">
                    <i class="bi bi-mortarboard"></i>
                </div>

                <div>
                    <div class="stat-value">{{ $counts['workshop'] ?? 0 }}</div>
                    <div class="stat-label">Workshops</div>
                </div>
            </div>

        </div>


        {{-- =====================================================
             BODY: SIDEBAR FILTER + EVENT LIST
             (restyled to match the employees webinar page)
        ====================================================== --}}
        <div class="events-body-grid" id="events-grid">

            {{-- ---------- LEFT: FILTER SIDEBAR ---------- --}}
            <aside class="filter-sidebar">

                <form method="GET" action="{{ route('student.webinars.index') }}">

                    <div class="filter-sidebar-header">
                        <div class="filter-sidebar-title">
                            <i class="bi bi-sliders"></i>
                            Filters
                        </div>
                        <a href="{{ route('student.webinars.index') }}" class="filter-clear-link">Clear all</a>
                    </div>

                    {{-- SEARCH --}}
                    <div class="filter-block">
                        <div class="filter-block-label">Search Events</div>
                        <input
                            type="text"
                            id="event-search"
                            name="q"
                            value="{{ $search ?? request('q') }}"
                            placeholder="Search webinars, workshops..."
                            class="filter-search-input"
                        >
                    </div>

                    {{-- TYPE --}}
                    <div class="filter-block">
                        <div class="filter-block-label">Event Type</div>

                        <div class="filter-options">

                            @php $activeTypeVal = $activeType ?? request('type'); @endphp

                            <label class="filter-radio-option {{ !$activeTypeVal ? 'active' : '' }}">
                                <input type="radio" name="type" value="" {{ !$activeTypeVal ? 'checked' : '' }} onchange="this.form.submit()">
                                All Types ({{ $counts['all'] ?? 0 }})
                            </label>

                            <label class="filter-radio-option {{ $activeTypeVal === 'webinar' ? 'active' : '' }}">
                                <input type="radio" name="type" value="webinar" {{ $activeTypeVal === 'webinar' ? 'checked' : '' }} onchange="this.form.submit()">
                                Webinars ({{ $counts['webinar'] ?? 0 }})
                            </label>

                            <label class="filter-radio-option {{ $activeTypeVal === 'workshop' ? 'active' : '' }}">
                                <input type="radio" name="type" value="workshop" {{ $activeTypeVal === 'workshop' ? 'checked' : '' }} onchange="this.form.submit()">
                                Workshops ({{ $counts['workshop'] ?? 0 }})
                            </label>

                        </div>
                    </div>

                    {{-- DATE --}}
                    <div class="filter-block">
                        <div class="filter-block-label">Date</div>

                        <div class="filter-options">

                            @php $activeDateVal = $activeDate ?? request('date'); @endphp

                            @foreach (['' => 'Any Date', 'today' => 'Today', 'week' => 'This Week', 'month' => 'This Month'] as $value => $label)
                                <label class="filter-radio-option {{ $activeDateVal === $value ? 'active' : '' }}">
                                    <input type="radio" name="date" value="{{ $value }}" {{ $activeDateVal === $value ? 'checked' : '' }} onchange="this.form.submit()">
                                    {{ $label }}
                                </label>
                            @endforeach

                        </div>
                    </div>

                    {{-- SORT (kept as hidden-select inside the same panel) --}}
                    <div class="filter-block">
                        <div class="filter-block-label">Sort By</div>
                        <select name="sort" class="filter-search-input" onchange="this.form.submit()">
                            <option value="upcoming" @selected(($activeSort ?? request('sort', 'upcoming')) === 'upcoming')>Upcoming</option>
                            <option value="newest" @selected(($activeSort ?? request('sort')) === 'newest')>Newest</option>
                        </select>
                    </div>

                    <button type="submit" class="filter-apply-btn">
                        <i class="bi bi-search me-1"></i>
                        Apply Filters
                    </button>

                </form>

            </aside>


            {{-- ---------- RIGHT: EVENT LIST ---------- --}}
            <div>

                <div class="section-header">
                    <div>
                        <h2 class="section-heading">Available Events</h2>
                        <p class="section-subtitle">Explore upcoming webinars and workshops</p>
                    </div>
                </div>

                @if ($events->count() > 0)

                    <div class="events-list">

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

                                $eventTime = null;
                                if ($event->scheduled_time) {
                                    try {
                                        $eventTime = \Carbon\Carbon::parse($event->scheduled_time)->format('h:i A');
                                    } catch (\Throwable $e) {
                                        $eventTime = $event->scheduled_time;
                                    }
                                }

                                $image = $event->thumbnail ?? $event->image ?? $event->banner ?? null;
                                $mentorName = optional($event->mentor)->name;
                                $description = $event->short_description ?? $event->description ?? null;
                                $isWorkshop = ($event->type ?? '') === 'workshop';
                            @endphp

                            <article class="event-list-card">
                                <div class="event-list-inner">

                                    @if ($image)
                                        <img src="{{ asset('storage/' . $image) }}" alt="{{ $event->title }}" class="event-list-thumb">
                                    @else
                                        <div class="event-list-thumb-placeholder {{ $isWorkshop ? 'is-workshop' : '' }}">
                                            <i class="bi bi-{{ $isWorkshop ? 'mortarboard' : 'camera-video' }}"></i>
                                        </div>
                                    @endif

                                    <div class="event-list-body">

                                        <div class="event-list-top">

                                            <div class="min-w-0">

                                                <div class="event-list-title-row">
                                                    <h3 class="event-list-title">{{ $event->title }}</h3>

                                                    @if ($event->category)
                                                        <span class="badge-pill badge-category">
                                                            {{ ucwords(str_replace('_', ' ', $event->category)) }}
                                                        </span>
                                                    @endif

                                                    <span class="badge-pill {{ $isWorkshop ? 'badge-type-workshop' : 'badge-type-webinar' }}">
                                                        {{ ucfirst($event->type ?? 'event') }}
                                                    </span>
                                                </div>

                                                <div class="event-list-desc">
                                                    {{ $description ? \Illuminate\Support\Str::limit(strip_tags($description), 130) : 'Join this event to learn from experienced professionals and mentors.' }}
                                                </div>

                                                <div class="event-list-meta">
                                                    @if ($eventDate)
                                                        <span>{{ $eventDate->format('d M, Y') }}</span>
                                                    @endif
                                                    @if ($eventTime)
                                                        <span class="meta-sep">&middot;</span><span>{{ $eventTime }}</span>
                                                    @endif
                                                    @if ($mentorName)
                                                        <span class="meta-sep">&middot;</span><span>{{ $mentorName }}</span>
                                                    @endif
                                                    @if ($event->duration)
                                                        <span class="meta-sep">&middot;</span><span>{{ $event->duration }}</span>
                                                    @endif
                                                </div>

                                            </div>

                                            <div class="event-list-side">
                                                <div class="event-list-seats">
                                                    <i class="bi bi-people"></i>
                                                    {{ $event->registrations_count ?? 0 }} registered
                                                </div>
                                                @if ($eventDate)
                                                    <div class="event-list-relative">{{ $eventDate->diffForHumans() }}</div>
                                                @endif
                                            </div>

                                        </div>

                                        <div class="event-list-action">

                                            @if ($registrationStatus === 'approved')
                                                <a href="{{ route('student.webinars.show', $event) }}" class="event-btn event-btn-success">
                                                    <i class="bi bi-check-circle"></i>
                                                    Registered
                                                </a>
                                            @elseif ($registrationStatus === 'pending')
                                                <a href="{{ route('student.webinars.show', $event) }}" class="event-btn event-btn-warning">
                                                    <i class="bi bi-hourglass-split"></i>
                                                    Waitlisted
                                                </a>
                                            @else
                                                <a href="{{ route('student.webinars.show', $event) }}" class="event-btn event-btn-primary">
                                                    View Details
                                                    <i class="bi bi-arrow-right"></i>
                                                </a>
                                            @endif

                                        </div>

                                    </div>

                                </div>
                            </article>

                        @endforeach

                    </div>

                    @if ($events->hasPages())
                        <div class="event-pagination">
                            {{ $events->onEachSide(1)->links() }}
                        </div>
                    @endif

                @else

                    <div class="events-empty">
                        <div class="events-empty-icon">
                            <i class="bi bi-calendar-x"></i>
                        </div>
                        <h4>No events found</h4>
                        <p>We couldn't find any webinars or workshops matching your search criteria.</p>
                    </div>

                @endif

            </div>

        </div>


        {{-- =====================================================
             UPCOMING EVENTS (unchanged)
        ====================================================== --}}

        @if ($upcoming && $upcoming->count() > 0)

            <section class="upcoming-section">

                <div class="section-header">
                    <div>
                        <h2 class="section-heading">Upcoming Events</h2>
                        <p class="section-subtitle">Don't miss these upcoming learning opportunities</p>
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
                                <div class="upcoming-date-day">{{ $upcomingDate->format('d') }}</div>
                                <div class="upcoming-date-month">{{ $upcomingDate->format('M') }}</div>
                            </div>
                        @else
                            <div class="upcoming-date">
                                <i class="bi bi-calendar-event"></i>
                            </div>
                        @endif

                        <div class="upcoming-info">
                            <div class="upcoming-title">{{ $event->title }}</div>
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
                                <a href="{{ route('student.webinars.show', $event) }}" class="event-btn event-btn-success">
                                    <i class="bi bi-check-circle"></i>
                                    Registered
                                </a>
                            @elseif ($registrationStatus === 'pending')
                                <a href="{{ route('student.webinars.show', $event) }}" class="event-btn event-btn-warning">
                                    <i class="bi bi-hourglass-split"></i>
                                    Waitlisted
                                </a>
                            @else
                                <a href="{{ route('student.webinars.show', $event) }}" class="event-btn event-btn-primary">
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
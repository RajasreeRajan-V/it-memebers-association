@extends('layouts.app')

@php($portal = 'student')

@section('title', 'Upcoming Sessions')

@section('content')

<style>
    /* =========================================================
       TECH LEADERS NETWORK - MENTOR PROFILE
       Matches the "My Mentorship" index page design system.
    ========================================================= */

    :root {
        --tl-primary: #3376F2;
        --tl-primary-dark: #245ED1;
        --tl-bg: #F6F8FC;
        --tl-white: #FFFFFF;
        --tl-text: #172033;
        --tl-muted: #718096;
        --tl-light-text: #8A94A8;
        --tl-border: #E5EAF2;
        --tl-soft-blue: #EEF4FF;
        --tl-soft-purple: #F2EDFF;
        --tl-purple: #7C4DFF;
        --tl-green: #18A957;
        --tl-soft-green: #EAF9F0;
        --tl-orange: #D99000;
        --tl-soft-orange: #FFF6E5;
        --tl-red: #D13B40;
        --tl-soft-red: #FFF0F0;
        --tl-shadow: 0 4px 20px rgba(35, 60, 110, .06);
        --tl-gap-lg: 28px;
        --tl-gap-md: 20px;
    }

    * {
        box-sizing: border-box;
    }

    html, body {
        overflow-x: hidden;
        max-width: 100%;
    }

    .mentor-profile-page {
        width: 100%;
        min-height: calc(100vh - 130px);
        background: var(--tl-bg);
        color: var(--tl-text);
        font-family: 'Inter', sans-serif;
        padding: 24px 0 56px;
        overflow-x: hidden;
    }

    /* =========================================================
       HERO
    ========================================================= */

    .mentor-hero {
        width: 100%;
        min-height: 280px;
        background: #fff;
        border: 1px solid var(--tl-border);
        border-radius: 16px;
        overflow: hidden;
        margin: 0 var(--tl-gap-lg) var(--tl-gap-lg);
        position: relative;
    }

    .mentor-hero-inner {
        min-height: 280px;
        display: grid;
        grid-template-columns: 1.4fr 1fr;
        align-items: center;
        padding: 44px 48px;
        gap: 36px;
    }

    /* ---------- HERO LEFT ---------- */

    .hero-left {
        display: flex;
        flex-direction: column;
        justify-content: center;
        min-width: 0;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        width: fit-content;
        padding: 8px 16px;
        border-radius: 30px;
        background: var(--tl-soft-blue);
        color: var(--tl-primary);
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 18px;
    }

    .hero-badge i {
        font-size: 12px;
    }

    .hero-title {
        margin: 0 0 10px;
        font-family: 'Inter', sans-serif;
        font-size: clamp(28px, 3.2vw, 38px);
        line-height: 1.18;
        letter-spacing: -0.8px;
        font-weight: 800;
        color: #172033;
        max-width: 560px;
        word-break: break-word;
    }

    .hero-role-line {
        color: var(--tl-primary);
        font-weight: 700;
        font-size: 15px;
        display: block;
        margin: 0 0 16px;
    }

    .hero-description {
        max-width: 520px;
        margin: 0 0 26px;
        color: #66748B;
        font-size: 15px;
        line-height: 1.75;
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
        justify-content: center;
        gap: 8px;
        min-height: 48px;
        padding: 0 22px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 700;
        border: 0;
        cursor: pointer;
        transition: .2s ease;
    }

    .hero-btn-primary {
        background: var(--tl-primary);
        color: #fff;
        box-shadow: 0 6px 14px rgba(51, 118, 242, .2);
    }

    .hero-btn-primary:hover {
        background: var(--tl-primary-dark);
        color: #fff;
        transform: translateY(-1px);
    }

    .hero-btn-secondary {
        background: #fff;
        color: var(--tl-primary);
        border: 1px solid #D9E3F7;
    }

    .hero-btn-secondary:hover {
        background: var(--tl-soft-blue);
        color: var(--tl-primary);
    }

    /* ---------- HERO BENEFITS (STATS) ---------- */

    .hero-benefits {
        display: flex;
        flex-direction: column;
        gap: 22px;
        padding-left: 8px;
    }

    .benefit-item {
        display: flex;
        align-items: center;
        gap: 13px;
    }

    .benefit-icon {
        width: 36px;
        height: 36px;
        flex-shrink: 0;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
    }

    .benefit-icon.blue {
        background: var(--tl-soft-blue);
        color: var(--tl-primary);
    }

    .benefit-icon.purple {
        background: var(--tl-soft-purple);
        color: #7C4DFF;
    }

    .benefit-icon.green {
        background: #EAF9F0;
        color: #18A957;
    }

    .benefit-text strong {
        display: block;
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .benefit-text span {
        display: block;
        color: #8A94A8;
        font-size: 12px;
    }

    /* =========================================================
       STATUS BAR
    ========================================================= */

    .status-bar {
        margin: 0 var(--tl-gap-lg) var(--tl-gap-lg);
        background: #fff;
        border: 1px solid var(--tl-border);
        border-radius: 12px;
        padding: 18px 22px;
        box-shadow: var(--tl-shadow);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        flex-wrap: wrap;
    }

    .status-bar-left {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .status-bar-icon {
        width: 36px;
        height: 36px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        flex-shrink: 0;
    }

    .status-bar-icon.green {
        background: var(--tl-soft-green);
        color: var(--tl-green);
    }

    .status-bar-icon.orange {
        background: var(--tl-soft-orange);
        color: var(--tl-orange);
    }

    .status-bar-text strong {
        display: block;
        font-size: 13.5px;
        margin-bottom: 4px;
    }

    .status-bar-text span {
        color: #8A94A8;
        font-size: 12px;
    }

    .status-bar-link {
        color: var(--tl-primary);
        text-decoration: none;
        font-size: 12.5px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        white-space: nowrap;
    }

    .status-bar-link:hover {
        color: var(--tl-primary-dark);
    }

    /* status pills */

    .status-pill {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 700;
        white-space: nowrap;
        flex-shrink: 0;
    }

    .status-pill.pending {
        color: #B77700;
        background: var(--tl-soft-orange);
    }

    .status-pill.accepted {
        color: #148548;
        background: var(--tl-soft-green);
    }

    .status-pill.rejected,
    .status-pill.cancelled {
        color: var(--tl-red);
        background: var(--tl-soft-red);
    }

    .status-pill.time {
        color: var(--tl-primary);
        background: var(--tl-soft-blue);
    }

    /* =========================================================
       LAYOUT: MAIN + SIDEBAR
    ========================================================= */

    .profile-grid {
        display: grid;
        grid-template-columns: 1fr 340px;
        gap: var(--tl-gap-md);
        align-items: start;
        margin: 0 var(--tl-gap-lg) var(--tl-gap-lg);
    }

    .ui-card {
        background: #fff;
        border: 1px solid var(--tl-border);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: var(--tl-shadow);
    }

    .ui-card-header {
        padding: 20px 20px 18px;
        border-bottom: 1px solid var(--tl-border);
    }

    .ui-card-title-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .ui-card-title {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 16px;
        font-weight: 700;
        color: #263752;
    }

    .card-icon {
        width: 30px;
        height: 30px;
        border-radius: 8px;
        background: var(--tl-soft-blue);
        color: var(--tl-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        flex-shrink: 0;
    }

    .card-icon.purple {
        background: var(--tl-soft-purple);
        color: var(--tl-purple);
    }

    .ui-card-subtitle {
        margin: 8px 0 0;
        color: #8A94A8;
        font-size: 12.5px;
        line-height: 1.6;
    }

    .ui-card-body {
        padding: 20px;
    }

    /* =========================================================
       STAT TILES
    ========================================================= */

    .stat-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
        margin-bottom: 20px;
    }

    .stat-tile {
        padding: 16px;
        border: 1px solid var(--tl-border);
        border-radius: 10px;
        background: #F8FAFE;
        transition: .2s ease;
    }

    .stat-tile:hover {
        transform: translateY(-2px);
        box-shadow: 0 7px 20px rgba(40,64,120,.06);
        border-color: #D6E1F5;
    }

    .stat-tile-icon {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        background: var(--tl-soft-blue);
        color: var(--tl-primary);
        font-size: 12px;
        margin-bottom: 12px;
    }

    .stat-tile:nth-child(2) .stat-tile-icon {
        background: var(--tl-soft-purple);
        color: var(--tl-purple);
    }

    .stat-tile:nth-child(3) .stat-tile-icon {
        background: var(--tl-soft-green);
        color: var(--tl-green);
    }

    .stat-tile-value {
        font-size: 20px;
        font-weight: 800;
        color: #172033;
        margin-bottom: 3px;
        line-height: 1.2;
    }

    .stat-tile-value.small {
        font-size: 14.5px;
        padding-top: 3px;
    }

    .stat-tile-label {
        color: #8A94A8;
        font-size: 11px;
        font-weight: 600;
    }

    /* =========================================================
       INFO BOXES (expertise / bio)
    ========================================================= */

    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
        margin-bottom: 20px;
    }

    .request-info {
        background: #F8FAFE;
        border: 1px solid #EAF0FA;
        border-radius: 10px;
        padding: 16px;
    }

    .request-info-title {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        font-weight: 700;
        color: #3D4A60;
        margin-bottom: 9px;
    }

    .request-info-title i {
        color: var(--tl-primary);
        font-size: 12px;
    }

    .request-info-text {
        font-size: 12.5px;
        line-height: 1.7;
        color: #8A94A8;
        white-space: pre-line;
    }

    /* =========================================================
       REQUEST CTA
    ========================================================= */

    .cta-box {
        background: linear-gradient(135deg, #F0F5FF, #F7F3FF);
        border: 1px solid #E1E8F7;
        border-radius: 10px;
        padding: 18px;
    }

    .cta-box-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        flex-wrap: wrap;
    }

    .cta-box-title {
        font-size: 14px;
        font-weight: 700;
        color: #263752;
        margin-bottom: 6px;
    }

    .cta-box-text {
        font-size: 12.5px;
        color: #8A94A8;
        line-height: 1.65;
    }

    .full-btn {
        min-height: 46px;
        border: 0;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 0 20px;
        background: var(--tl-primary);
        color: #fff;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        transition: .2s ease;
    }

    .full-btn:hover {
        background: var(--tl-primary-dark);
        color: #fff;
        transform: translateY(-1px);
    }

    .cta-status {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 14px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 700;
        line-height: 1.5;
    }

    .cta-status.accepted {
        color: #148548;
        background: var(--tl-soft-green);
    }

    .cta-status.time {
        color: var(--tl-primary);
        background: var(--tl-soft-blue);
    }

    .cta-status.pending {
        color: #B77700;
        background: var(--tl-soft-orange);
    }

    /* =========================================================
       ACTIONS ROW
    ========================================================= */

    .profile-actions {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: 20px;
    }

    .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        min-height: 44px;
        padding: 0 18px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        border: 0;
        cursor: pointer;
    }

    .action-btn.primary {
        background: var(--tl-primary);
        color: #fff;
    }

    .action-btn.primary:hover {
        background: var(--tl-primary-dark);
        color: #fff;
    }

    .action-btn.secondary {
        background: #fff;
        border: 1px solid #DCE3EE;
        color: #526077;
    }

    .action-btn.secondary:hover {
        color: var(--tl-primary);
        background: #F8FAFF;
    }

    /* =========================================================
       SIDEBAR
    ========================================================= */

    .request-points {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .request-points li {
        display: flex;
        align-items: flex-start;
        gap: 11px;
        margin-bottom: 18px;
    }

    .request-points li:last-child {
        margin-bottom: 0;
    }

    .point-icon {
        width: 32px;
        height: 32px;
        flex-shrink: 0;
        border-radius: 9px;
        background: var(--tl-soft-blue);
        color: var(--tl-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
    }

    .point-icon.step {
        background: var(--tl-soft-purple);
        color: var(--tl-purple);
        font-weight: 800;
    }

    .point-text strong {
        display: block;
        font-size: 12.5px;
        font-weight: 700;
        color: #263752;
        margin-bottom: 3px;
    }

    .point-text span {
        display: block;
        font-size: 11.5px;
        color: #8A94A8;
        line-height: 1.6;
    }

    .sidebar-divider {
        height: 1px;
        background: var(--tl-border);
        margin: 20px 0;
    }

    .sidebar-subheading {
        font-size: 16px;
        font-weight: 700;
        color: #263752;
        margin-bottom: 16px;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 1150px) {

        .profile-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 900px) {

        .mentor-hero-inner {
            grid-template-columns: 1fr;
            padding: 36px;
        }

        .stat-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 760px) {

        :root {
            --tl-gap-lg: 16px;
            --tl-gap-md: 16px;
        }

        .mentor-hero {
            border-radius: 12px;
        }

        .mentor-hero-inner {
            padding: 30px 24px;
        }

        .hero-benefits {
            flex-direction: row;
            flex-wrap: wrap;
            padding-left: 0;
            gap: 18px 26px;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .status-bar {
            align-items: flex-start;
            flex-direction: column;
        }
    }

    @media (max-width: 600px) {

        .mentor-profile-page {
            padding: 16px 0 32px;
        }

        .mentor-hero-inner {
            min-height: auto;
            padding: 26px 20px;
        }

        .hero-title {
            font-size: 26px;
        }

        .hero-description {
            font-size: 13px;
        }

        .hero-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .hero-btn {
            width: 100%;
        }

        .hero-benefits {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .cta-box-inner,
        .profile-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .action-btn,
        .full-btn {
            width: 100%;
        }
    }

    @media (max-width: 420px) {

        .hero-benefits {
            grid-template-columns: 1fr;
        }

        .ui-card-header,
        .ui-card-body {
            padding: 16px;
        }
    }
</style>

<div class="mentor-profile-page">


{{-- =====================================================
     HERO
====================================================== --}}

<section class="mentor-hero">

    <div class="mentor-hero-inner">

        {{-- LEFT --}}
        <div class="hero-left">

            <div class="hero-badge">
                <i class="fa-solid fa-user-tie"></i>
                SkillConnect Mentor
            </div>

            <h1 class="hero-title">
                {{ $mentor->name }}
            </h1>

            <span class="hero-role-line">
                {{ $mentor->mentorRegistration->designation ?? 'Professional Mentor' }}
                @if($mentor->mentorRegistration->company ?? null)
                    · {{ $mentor->mentorRegistration->company }}
                @endif
            </span>

            <p class="hero-description">
                Get to know {{ explode(' ', $mentor->name)[0] }} before you
                reach out — their background, focus areas and what it's
                like to work together.
            </p>

            <div class="hero-actions">

                @if($activeMentorship)

                    <span class="hero-btn hero-btn-secondary" style="pointer-events:none;">
                        <i class="fa-solid fa-circle-check"></i>
                        Your Active Mentor
                    </span>

                @elseif($existingRequest)

                    <span class="hero-btn hero-btn-secondary" style="pointer-events:none;">
                        <i class="fa-solid fa-hourglass-half"></i>
                        Request {{ ucfirst($existingRequest->status) }}
                    </span>

                @else

                    <a href="{{ route('student.mentors.request', $mentor) }}"
                       class="hero-btn hero-btn-primary">

                        <i class="fa-solid fa-paper-plane"></i>
                        Request Mentorship

                    </a>

                @endif

                <a href="{{ route('student.mentors.index') }}"
                   class="hero-btn hero-btn-secondary">

                    <i class="fa-solid fa-arrow-left"></i>
                    Back to Mentors

                </a>

            </div>

        </div>


        {{-- RIGHT STATS --}}
        <div class="hero-benefits">

            <div class="benefit-item">

                <div class="benefit-icon blue">
                    <i class="fa-solid fa-briefcase"></i>
                </div>

                <div class="benefit-text">
                    <strong>{{ $mentor->mentorRegistration->years_of_experience ?? 0 }} Years</strong>
                    <span>Professional experience</span>
                </div>

            </div>


            <div class="benefit-item">

                <div class="benefit-icon purple">
                    <i class="fa-solid fa-users"></i>
                </div>

                <div class="benefit-text">
                    <strong>{{ $mentor->active_mentees_count }} Mentees</strong>
                    <span>Currently mentoring</span>
                </div>

            </div>


            <div class="benefit-item">

                <div class="benefit-icon green">
                    <i class="fa-regular fa-clock"></i>
                </div>

                <div class="benefit-text">
                    <strong>{{ $mentor->mentorRegistration->availability ?? '—' }}</strong>
                    <span>Availability</span>
                </div>

            </div>

        </div>

    </div>

</section>


{{-- =====================================================
     STATUS BAR
====================================================== --}}

@if($activeMentorship)

    <div class="status-bar">

        <div class="status-bar-left">

            <div class="status-bar-icon green">
                <i class="fa-solid fa-check"></i>
            </div>

            <div class="status-bar-text">

                <strong>This mentor is your active mentor</strong>

                <span>You're currently connected and can schedule sessions together.</span>

            </div>

        </div>

        <a href="{{ route('student.sessions.upcoming') }}" class="status-bar-link">

            View Sessions
            <i class="fa-solid fa-arrow-right"></i>

        </a>

    </div>

@elseif($existingRequest && $existingRequest->status === 'time_suggested')

    <div class="status-bar">

        <div class="status-bar-left">

            <div class="status-bar-icon orange">
                <i class="fa-solid fa-clock"></i>
            </div>

            <div class="status-bar-text">

                <strong>{{ $mentor->name }} suggested a new time</strong>

                <span>Review and accept the suggested time from "My Mentorship".</span>

            </div>

        </div>

        <a href="{{ route('student.mentorship.index') }}" class="status-bar-link">

            Review Request
            <i class="fa-solid fa-arrow-right"></i>

        </a>

    </div>

@endif


{{-- =====================================================
     MAIN + SIDEBAR
====================================================== --}}

<div class="profile-grid">


    {{-- =================================================
         MAIN CARD
    ================================================== --}}

    <div class="ui-card">

        <div class="ui-card-header">

            <div class="ui-card-title-row">

                <div class="ui-card-title">

                    <span class="card-icon">
                        <i class="fa-solid fa-user"></i>
                    </span>

                    Mentor Overview

                </div>

            </div>

            <p class="ui-card-subtitle">
                Get to know your potential mentor before sending a request.
            </p>

        </div>


        <div class="ui-card-body">

            {{-- STATS --}}

            <div class="stat-grid">

                <div class="stat-tile">

                    <div class="stat-tile-icon">
                        <i class="fa-solid fa-briefcase"></i>
                    </div>

                    <div class="stat-tile-value">
                        {{ $mentor->mentorRegistration->years_of_experience ?? 0 }}
                    </div>

                    <div class="stat-tile-label">
                        Years Experience
                    </div>

                </div>


                <div class="stat-tile">

                    <div class="stat-tile-icon">
                        <i class="fa-solid fa-users"></i>
                    </div>

                    <div class="stat-tile-value">
                        {{ $mentor->active_mentees_count }}
                    </div>

                    <div class="stat-tile-label">
                        Active Mentees
                    </div>

                </div>


                <div class="stat-tile">

                    <div class="stat-tile-icon">
                        <i class="fa-regular fa-clock"></i>
                    </div>

                    <div class="stat-tile-value small">
                        {{ $mentor->mentorRegistration->availability ?? '—' }}
                    </div>

                    <div class="stat-tile-label">
                        Availability
                    </div>

                </div>

            </div>


            {{-- EXPERTISE + BIO --}}

            <div class="info-grid">

                <div class="request-info">

                    <div class="request-info-title">
                        <i class="fa-solid fa-code"></i>
                        Skills & Expertise
                    </div>

                    <div class="request-info-text">
                        {{ $mentor->mentorRegistration->expertise ?? 'Not specified.' }}
                    </div>

                </div>


                <div class="request-info">

                    <div class="request-info-title">
                        <i class="fa-regular fa-user"></i>
                        About the Mentor
                    </div>

                    <div class="request-info-text">
                        {{ $mentor->mentorRegistration->bio ?? 'This mentor has not added a bio yet.' }}
                    </div>

                </div>

            </div>


            {{-- REQUEST CTA --}}

            <div class="cta-box">

                <div class="cta-box-inner">

                    <div>

                        <div class="cta-box-title">
                            Ready to learn from {{ $mentor->name }}?
                        </div>

                        <div class="cta-box-text">
                            Send a mentorship request and share your career
                            goals, skills and preferred schedule.
                        </div>

                    </div>


                    <div>

                        @if($activeMentorship)

                            <span class="cta-status accepted">
                                <i class="fa-solid fa-circle-check"></i>
                                Already your active mentor
                            </span>

                        @elseif($existingRequest)

                            @if($existingRequest->status === 'time_suggested')

                                <span class="cta-status time">
                                    <i class="fa-solid fa-clock"></i>
                                    New time suggested
                                </span>

                            @else

                                <span class="cta-status pending">
                                    <i class="fa-solid fa-hourglass-half"></i>
                                    Request {{ ucfirst($existingRequest->status) }}
                                </span>

                            @endif

                        @else

                            <a href="{{ route('student.mentors.request', $mentor) }}"
                               class="full-btn">

                                <i class="fa-solid fa-paper-plane"></i>
                                Request Mentorship

                            </a>

                        @endif

                    </div>

                </div>

            </div>


            {{-- ACTIONS --}}

            <div class="profile-actions">

                @if(!$activeMentorship && !$existingRequest)

                    <a href="{{ route('student.mentors.request', $mentor) }}"
                       class="action-btn primary">

                        <i class="fa-solid fa-paper-plane"></i>
                        Send Mentorship Request

                    </a>

                @endif

                <a href="{{ route('student.mentors.index') }}"
                   class="action-btn secondary">

                    <i class="fa-solid fa-arrow-left"></i>
                    Back to Mentors

                </a>

            </div>

        </div>

    </div>


    {{-- =================================================
         SIDEBAR
    ================================================== --}}

    <div class="ui-card">

        <div class="ui-card-header">

            <div class="ui-card-title-row">

                <div class="ui-card-title">

                    <span class="card-icon purple">
                        <i class="fa-solid fa-star"></i>
                    </span>

                    Why Connect

                </div>

            </div>

            <p class="ui-card-subtitle">
                What you'll get from this mentorship.
            </p>

        </div>

        <div class="ui-card-body">

            <ul class="request-points">

                <li>

                    <div class="point-icon">
                        <i class="fa-solid fa-bullseye"></i>
                    </div>

                    <div class="point-text">
                        <strong>Goal-Based Guidance</strong>
                        <span>Practical advice aligned with your career goals and ambitions.</span>
                    </div>

                </li>


                <li>

                    <div class="point-icon">
                        <i class="fa-solid fa-laptop-code"></i>
                    </div>

                    <div class="point-text">
                        <strong>Industry Experience</strong>
                        <span>Learn from real-world technical and industry experience.</span>
                    </div>

                </li>


                <li>

                    <div class="point-icon">
                        <i class="fa-solid fa-comments"></i>
                    </div>

                    <div class="point-text">
                        <strong>Personal Mentoring</strong>
                        <span>Discuss your challenges, projects, interviews and career decisions.</span>
                    </div>

                </li>


                <li>

                    <div class="point-icon">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>

                    <div class="point-text">
                        <strong>Career Growth</strong>
                        <span>Build a clear action plan and keep improving your skills.</span>
                    </div>

                </li>

            </ul>


            <div class="sidebar-divider"></div>


            <div class="sidebar-subheading">
                Mentorship Process
            </div>

            <ul class="request-points">

                <li>

                    <div class="point-icon step">1</div>

                    <div class="point-text">
                        <strong>Send Request</strong>
                        <span>Tell the mentor about your goals and expectations.</span>
                    </div>

                </li>


                <li>

                    <div class="point-icon step">2</div>

                    <div class="point-text">
                        <strong>Mentor Review</strong>
                        <span>The mentor reviews your request and responds.</span>
                    </div>

                </li>


                <li>

                    <div class="point-icon step">3</div>

                    <div class="point-text">
                        <strong>Start Mentoring</strong>
                        <span>Once accepted, schedule and attend your sessions.</span>
                    </div>

                </li>

            </ul>

        </div>

    </div>

</div>


</div>

@endsection
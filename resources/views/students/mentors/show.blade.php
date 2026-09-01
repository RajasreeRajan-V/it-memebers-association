@extends('layouts.app')

@php($portal = 'student')

@section('title', 'Upcoming Sessions')

@section('content')

<style>
    :root {
        --mp-primary: #3376F2;
        --mp-primary-dark: #245ED1;
        --mp-purple: #7C4DFF;
        --mp-bg: #F7F9FF;
        --mp-card: #FFFFFF;
        --mp-text: #172033;
        --mp-muted: #718096;
        --mp-border: #E5EAF3;
        --mp-green: #18A957;
        --mp-amber: #D98B00;
        --mp-shadow: 0 12px 35px rgba(40, 64, 120, .07);
    }

    /* =====================================================
       PAGE
    ===================================================== */

    .mentor-profile-page {
        min-height: 100vh;
        background: var(--mp-bg);
        padding: 8px 0 50px;
    }

    /* =====================================================
       HERO
    ===================================================== */

    .mentor-hero {
        position: relative;
        overflow: hidden;
        border-radius: 22px;
        margin-bottom: 22px;
        padding: 35px 38px;
        background:
            linear-gradient(
                120deg,
                #3376F2 0%,
                #536DF2 48%,
                #7C4DFF 100%
            );
        color: #fff;
        box-shadow: 0 16px 40px rgba(51, 118, 242, .17);
    }

    .mentor-hero::before {
        content: "";
        position: absolute;
        width: 360px;
        height: 360px;
        border-radius: 50%;
        right: -130px;
        top: -210px;
        background: rgba(255,255,255,.07);
    }

    .mentor-hero::after {
        content: "";
        position: absolute;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        left: 43%;
        bottom: -170px;
        background: rgba(255,255,255,.06);
    }

    .mentor-hero-content {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 30px;
    }

    .mentor-hero-left {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    /* =====================================================
       PROFILE IMAGE
    ===================================================== */

    .mentor-main-avatar {
        width: 100px;
        height: 100px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 28px;
        background: rgba(255,255,255,.15);
        border: 1px solid rgba(255,255,255,.25);
        backdrop-filter: blur(10px);
        overflow: hidden;
        font-size: 38px;
        font-weight: 800;
        box-shadow: 0 10px 30px rgba(0,0,0,.10);
    }

    .mentor-main-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .mentor-hero-info {
        min-width: 0;
    }

    .mentor-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 6px 10px;
        margin-bottom: 9px;
        border-radius: 50px;
        background: rgba(255,255,255,.13);
        border: 1px solid rgba(255,255,255,.18);
        font-size: 9px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .5px;
    }

    .mentor-hero-name {
        margin: 0 0 5px;
        font-size: clamp(25px, 4vw, 35px);
        font-weight: 800;
        line-height: 1.15;
        letter-spacing: -.5px;
    }

    .mentor-hero-role {
        color: rgba(255,255,255,.83);
        font-size: 12px;
        line-height: 1.5;
    }

    .mentor-hero-right {
        flex-shrink: 0;
        text-align: right;
    }

    .available-badge {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 9px 13px;
        border-radius: 50px;
        background: rgba(255,255,255,.14);
        border: 1px solid rgba(255,255,255,.20);
        color: #fff;
        font-size: 9px;
        font-weight: 800;
    }

    .available-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #7FF0AE;
        box-shadow: 0 0 0 4px rgba(127,240,174,.12);
    }

    /* =====================================================
       MAIN GRID
    ===================================================== */

    .mentor-profile-layout {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 300px;
        gap: 20px;
        align-items: start;
    }

    /* =====================================================
       MAIN CONTENT CARD
    ===================================================== */

    .profile-card {
        background: var(--mp-card);
        border: 1px solid var(--mp-border);
        border-radius: 18px;
        box-shadow: var(--mp-shadow);
        overflow: hidden;
    }

    .profile-card-header {
        padding: 20px 23px;
        border-bottom: 1px solid var(--mp-border);
    }

    .profile-card-title {
        display: flex;
        align-items: center;
        gap: 10px;
        color: var(--mp-text);
        font-size: 14px;
        font-weight: 800;
    }

    .profile-card-title-icon {
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: #EEF4FF;
        color: var(--mp-primary);
        font-size: 13px;
    }

    .profile-card-subtitle {
        margin-top: 4px;
        color: var(--mp-muted);
        font-size: 10px;
    }

    .profile-card-body {
        padding: 23px;
    }

    /* =====================================================
       STATS
    ===================================================== */

    .mentor-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
        margin-bottom: 23px;
    }

    .mentor-stat {
        position: relative;
        overflow: hidden;
        padding: 17px;
        border: 1px solid var(--mp-border);
        border-radius: 13px;
        background: #FBFCFF;
        transition: .2s ease;
    }

    .mentor-stat:hover {
        transform: translateY(-2px);
        box-shadow: 0 7px 20px rgba(40,64,120,.06);
        border-color: #D6E1F5;
    }

    .mentor-stat-icon {
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        background: #EEF4FF;
        color: var(--mp-primary);
        font-size: 11px;
        margin-bottom: 11px;
    }

    .mentor-stat:nth-child(2) .mentor-stat-icon {
        background: #F1ECFF;
        color: var(--mp-purple);
    }

    .mentor-stat:nth-child(3) .mentor-stat-icon {
        background: #EAF9F0;
        color: var(--mp-green);
    }

    .mentor-stat-value {
        color: var(--mp-text);
        font-size: 21px;
        line-height: 1.2;
        font-weight: 800;
        margin-bottom: 3px;
    }

    .mentor-stat-label {
        color: var(--mp-muted);
        font-size: 9px;
        font-weight: 600;
    }

    /* =====================================================
       INFORMATION GRID
    ===================================================== */

    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    .info-box {
        padding: 19px;
        border: 1px solid var(--mp-border);
        border-radius: 14px;
        background: #fff;
    }

    .info-box-header {
        display: flex;
        align-items: center;
        gap: 9px;
        margin-bottom: 11px;
    }

    .info-box-icon {
        width: 31px;
        height: 31px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        background: #EEF4FF;
        color: var(--mp-primary);
        font-size: 11px;
    }

    .info-box:nth-child(2) .info-box-icon {
        background: #F1ECFF;
        color: var(--mp-purple);
    }

    .info-box-title {
        color: var(--mp-text);
        font-size: 11px;
        font-weight: 800;
    }

    .info-box-content {
        color: var(--mp-muted);
        font-size: 10px;
        line-height: 1.7;
        white-space: pre-line;
    }

    /* =====================================================
       CTA CARD
    ===================================================== */

    .request-card {
        margin-top: 16px;
        padding: 20px;
        border-radius: 15px;
        background: linear-gradient(
            135deg,
            #F0F5FF,
            #F7F3FF
        );
        border: 1px solid #E1E8F7;
    }

    .request-card-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .request-card-title {
        color: var(--mp-text);
        font-size: 13px;
        font-weight: 800;
        margin-bottom: 4px;
    }

    .request-card-text {
        color: var(--mp-muted);
        font-size: 9px;
        line-height: 1.6;
    }

    /* =====================================================
       SIDEBAR
    ===================================================== */

    .sidebar-card {
        background: #fff;
        border: 1px solid var(--mp-border);
        border-radius: 18px;
        padding: 20px;
        box-shadow: var(--mp-shadow);
        position: sticky;
        top: 20px;
    }

    .sidebar-heading {
        color: var(--mp-text);
        font-size: 12px;
        font-weight: 800;
        margin-bottom: 17px;
    }

    .sidebar-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 15px;
    }

    .sidebar-item:last-child {
        margin-bottom: 0;
    }

    .sidebar-icon {
        width: 32px;
        height: 32px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        background: #EEF4FF;
        color: var(--mp-primary);
        font-size: 11px;
    }

    .sidebar-item-title {
        color: var(--mp-text);
        font-size: 10px;
        font-weight: 800;
        margin-bottom: 3px;
    }

    .sidebar-item-text {
        color: var(--mp-muted);
        font-size: 9px;
        line-height: 1.5;
    }

    .sidebar-divider {
        height: 1px;
        background: var(--mp-border);
        margin: 19px 0;
    }

    /* =====================================================
       BUTTONS
    ===================================================== */

    .mentor-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 9px;
        margin-top: 17px;
    }

    .mp-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 10px 14px;
        border-radius: 9px;
        text-decoration: none;
        font-size: 10px;
        font-weight: 800;
        border: 1px solid transparent;
        cursor: pointer;
        transition: .2s ease;
    }

    .mp-btn-primary {
        background: var(--mp-primary);
        color: #fff;
        box-shadow: 0 7px 17px rgba(51,118,242,.14);
    }

    .mp-btn-primary:hover {
        background: var(--mp-primary-dark);
        color: #fff;
        transform: translateY(-1px);
    }

    .mp-btn-outline {
        background: #fff;
        border-color: var(--mp-border);
        color: #647086;
    }

    .mp-btn-outline:hover {
        background: #F7F9FC;
        color: var(--mp-text);
        border-color: #D3DAE7;
    }

    /* =====================================================
       STATUS
    ===================================================== */

    .status-box {
        padding: 13px;
        border-radius: 11px;
        font-size: 9px;
        line-height: 1.5;
    }

    .status-active {
        background: #EAF9F0;
        color: #148548;
        border: 1px solid #D1F0DD;
    }

    .status-pending {
        background: #FFF8E7;
        color: #9A6700;
        border: 1px solid #F4E4B4;
    }

    .status-icon {
        margin-right: 5px;
    }

    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media (max-width: 950px) {

        .mentor-profile-layout {
            grid-template-columns: 1fr;
        }

        .sidebar-card {
            position: static;
        }
    }

    @media (max-width: 700px) {

        .mentor-hero {
            padding: 27px 22px;
            border-radius: 17px;
        }

        .mentor-hero-content {
            display: block;
        }

        .mentor-hero-left {
            align-items: flex-start;
        }

        .mentor-main-avatar {
            width: 75px;
            height: 75px;
            border-radius: 21px;
            font-size: 28px;
        }

        .mentor-hero-name {
            font-size: 27px;
        }

        .mentor-hero-right {
            text-align: left;
            margin-top: 16px;
        }

        .mentor-stats {
            grid-template-columns: 1fr;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .request-card-inner {
            flex-direction: column;
            align-items: stretch;
        }

        .mentor-actions {
            flex-direction: column;
        }

        .mp-btn {
            width: 100%;
        }

        .profile-card-body {
            padding: 17px;
        }
    }

    @media (max-width: 480px) {

        .mentor-hero-left {
            display: block;
        }

        .mentor-main-avatar {
            margin-bottom: 14px;
        }

        .mentor-hero-name {
            font-size: 25px;
        }

        .profile-card-header {
            padding: 17px;
        }
    }
</style>


<div class="mentor-profile-page">

    {{-- =====================================================
         HERO
    ====================================================== --}}

    <section class="mentor-hero">

        <div class="mentor-hero-content">

            <div class="mentor-hero-left">

                <div class="mentor-main-avatar">

                    @if($mentor->mentorRegistration->profile_photo ?? null)

                        <img
                            src="{{ asset('storage/' . $mentor->mentorRegistration->profile_photo) }}"
                            alt="{{ $mentor->name }}"
                        >

                    @else

                        {{ strtoupper(substr($mentor->name, 0, 1)) }}

                    @endif

                </div>


                <div class="mentor-hero-info">

                    <div class="mentor-eyebrow">

                        <i class="fa-solid fa-user-tie"></i>

                        SkillConnect Mentor

                    </div>

                    <h1 class="mentor-hero-name">
                        {{ $mentor->name }}
                    </h1>

                    <div class="mentor-hero-role">

                        {{ $mentor->mentorRegistration->designation ?? 'Professional Mentor' }}

                        @if($mentor->mentorRegistration->company ?? null)

                            · {{ $mentor->mentorRegistration->company }}

                        @endif

                    </div>

                </div>

            </div>


            <div class="mentor-hero-right">

                <div class="available-badge">

                    <span class="available-dot"></span>

                    Available for Mentorship

                </div>

            </div>

        </div>

    </section>


    {{-- =====================================================
         MAIN CONTENT
    ====================================================== --}}

    <div class="mentor-profile-layout">


        {{-- =================================================
             LEFT / MAIN
        ================================================== --}}

        <main>

            <div class="profile-card">

                <div class="profile-card-header">

                    <div class="profile-card-title">

                        <div class="profile-card-title-icon">

                            <i class="fa-solid fa-user"></i>

                        </div>

                        Mentor Overview

                    </div>

                    <div class="profile-card-subtitle">

                        Get to know your potential mentor before sending a request.

                    </div>

                </div>


                <div class="profile-card-body">


                    {{-- =================================================
                         STATS
                    ================================================== --}}

                    <div class="mentor-stats">

                        <div class="mentor-stat">

                            <div class="mentor-stat-icon">

                                <i class="fa-solid fa-briefcase"></i>

                            </div>

                            <div class="mentor-stat-value">

                                {{ $mentor->mentorRegistration->years_of_experience ?? 0 }}

                            </div>

                            <div class="mentor-stat-label">

                                Years Experience

                            </div>

                        </div>


                        <div class="mentor-stat">

                            <div class="mentor-stat-icon">

                                <i class="fa-solid fa-users"></i>

                            </div>

                            <div class="mentor-stat-value">

                                {{ $mentor->active_mentees_count }}

                            </div>

                            <div class="mentor-stat-label">

                                Active Mentees

                            </div>

                        </div>


                        <div class="mentor-stat">

                            <div class="mentor-stat-icon">

                                <i class="fa-regular fa-clock"></i>

                            </div>

                            <div class="mentor-stat-value"
                                 style="font-size:15px;padding-top:3px;">

                                {{ $mentor->mentorRegistration->availability ?? '—' }}

                            </div>

                            <div class="mentor-stat-label">

                                Availability

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                         EXPERTISE + ABOUT
                    ================================================== --}}

                    <div class="info-grid">


                        <div class="info-box">

                            <div class="info-box-header">

                                <div class="info-box-icon">

                                    <i class="fa-solid fa-code"></i>

                                </div>

                                <div class="info-box-title">

                                    Skills & Expertise

                                </div>

                            </div>

                            <div class="info-box-content">

                                {{ $mentor->mentorRegistration->expertise ?? 'Not specified.' }}

                            </div>

                        </div>


                        <div class="info-box">

                            <div class="info-box-header">

                                <div class="info-box-icon">

                                    <i class="fa-regular fa-user"></i>

                                </div>

                                <div class="info-box-title">

                                    About the Mentor

                                </div>

                            </div>

                            <div class="info-box-content">

                                {{ $mentor->mentorRegistration->bio ?? 'This mentor has not added a bio yet.' }}

                            </div>

                        </div>


                    </div>


                    {{-- =================================================
                         REQUEST CTA
                    ================================================== --}}

                    <div class="request-card">

                        <div class="request-card-inner">

                            <div>

                                <div class="request-card-title">

                                    Ready to learn from {{ $mentor->name }}?

                                </div>

                                <div class="request-card-text">

                                    Send a mentorship request and share your
                                    career goals, skills and preferred schedule.

                                </div>

                            </div>


                            <div>

                                @if($activeMentorship)

                                    <span class="status-box status-active">

                                        <i class="fa-solid fa-circle-check status-icon"></i>

                                        This mentor is already your active mentor.

                                    </span>

                                @elseif($existingRequest)

                                    @if($existingRequest->status === 'time_suggested')

                                        <span class="status-box status-pending">

                                            <i class="fa-solid fa-clock status-icon"></i>

                                            Mentor suggested a new time.
                                            Check "My Mentorship".

                                        </span>

                                    @else

                                        <span class="status-box status-pending">

                                            <i class="fa-solid fa-hourglass-half status-icon"></i>

                                            Request {{ ucfirst($existingRequest->status) }}

                                        </span>

                                    @endif

                                @else

                                    <a
                                        href="{{ route('student.mentors.request', $mentor) }}"
                                        class="mp-btn mp-btn-primary"
                                    >

                                        <i class="fa-solid fa-paper-plane"></i>

                                        Request Mentorship

                                    </a>

                                @endif

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                         ACTIONS
                    ================================================== --}}

                    <div class="mentor-actions">

                        @if(!$activeMentorship && !$existingRequest)

                            <a
                                href="{{ route('student.mentors.request', $mentor) }}"
                                class="mp-btn mp-btn-primary"
                            >

                                <i class="fa-solid fa-paper-plane"></i>

                                Send Mentorship Request

                            </a>

                        @endif


                        <a
                            href="{{ route('student.mentors.index') }}"
                            class="mp-btn mp-btn-outline"
                        >

                            <i class="fa-solid fa-arrow-left"></i>

                            Back to Mentors

                        </a>

                    </div>

                </div>

            </div>

        </main>


        {{-- =================================================
             RIGHT SIDEBAR
        ================================================== --}}

        <aside class="sidebar-card">

            <div class="sidebar-heading">

                Why Connect With This Mentor?

            </div>


            <div class="sidebar-item">

                <div class="sidebar-icon">

                    <i class="fa-solid fa-bullseye"></i>

                </div>

                <div>

                    <div class="sidebar-item-title">

                        Goal-Based Guidance

                    </div>

                    <div class="sidebar-item-text">

                        Get practical advice aligned with your
                        career goals and ambitions.

                    </div>

                </div>

            </div>


            <div class="sidebar-item">

                <div class="sidebar-icon">

                    <i class="fa-solid fa-laptop-code"></i>

                </div>

                <div>

                    <div class="sidebar-item-title">

                        Industry Experience

                    </div>

                    <div class="sidebar-item-text">

                        Learn from a professional with real-world
                        technical and industry experience.

                    </div>

                </div>

            </div>


            <div class="sidebar-item">

                <div class="sidebar-icon">

                    <i class="fa-solid fa-comments"></i>

                </div>

                <div>

                    <div class="sidebar-item-title">

                        Personal Mentoring

                    </div>

                    <div class="sidebar-item-text">

                        Discuss your challenges, projects,
                        interviews and career decisions.

                    </div>

                </div>

            </div>


            <div class="sidebar-item">

                <div class="sidebar-icon">

                    <i class="fa-solid fa-chart-line"></i>

                </div>

                <div>

                    <div class="sidebar-item-title">

                        Career Growth

                    </div>

                    <div class="sidebar-item-text">

                        Build a clear action plan and continuously
                        improve your professional skills.

                    </div>

                </div>

            </div>


            <div class="sidebar-divider"></div>


            <div class="sidebar-heading">

                Mentorship Process

            </div>


            <div class="sidebar-item">

                <div class="sidebar-icon">

                    <i class="fa-solid fa-1"></i>

                </div>

                <div>

                    <div class="sidebar-item-title">

                        Send Request

                    </div>

                    <div class="sidebar-item-text">

                        Tell the mentor about your goals and expectations.

                    </div>

                </div>

            </div>


            <div class="sidebar-item">

                <div class="sidebar-icon">

                    <i class="fa-solid fa-2"></i>

                </div>

                <div>

                    <div class="sidebar-item-title">

                        Mentor Review

                    </div>

                    <div class="sidebar-item-text">

                        The mentor reviews your request and responds.

                    </div>

                </div>

            </div>


            <div class="sidebar-item">

                <div class="sidebar-icon">

                    <i class="fa-solid fa-3"></i>

                </div>

                <div>

                    <div class="sidebar-item-title">

                        Start Mentoring

                    </div>

                    <div class="sidebar-item-text">

                        Once accepted, schedule and attend your sessions.

                    </div>

                </div>

            </div>

        </aside>

    </div>

</div>

@endsection
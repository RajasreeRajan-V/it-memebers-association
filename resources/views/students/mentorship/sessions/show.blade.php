@extends('layouts.app')

@php($portal = 'student')

@section('title', $session->topic)

@section('content')

<style>
    :root {
        --session-primary: #3376F2;
        --session-primary-dark: #245ED1;
        --session-purple: #7C4DFF;
        --session-green: #18A957;
        --session-amber: #F59E0B;

        --session-bg: #FAFBFE;
        --session-card: #FFFFFF;
        --session-text: #14181F;
        --session-muted: #6B7280;
        --session-border: #EEF1F6;

        --session-shadow: 0 1px 2px rgba(20, 24, 31, 0.04);
        --session-shadow-hover: 0 10px 26px rgba(31, 56, 110, 0.08);
    }

    /* =========================================================
       PAGE
    ========================================================= */

    .session-page {
        min-height: 100vh;
        background: var(--session-bg);
        padding: 24px 0 60px;
    }

    .session-page,
    .session-page * {
        box-sizing: border-box;
    }

    /* =========================================================
       BACK BUTTON
    ========================================================= */

    .back-button {
        display: inline-flex;
        align-items: center;
        gap: 9px;

        color: #6B7280;
        text-decoration: none;

        font-size: 13px;
        font-weight: 600;

        margin-bottom: 20px;
        padding: 8px 4px;

        transition: all .2s ease;
    }

    .back-button:hover {
        color: var(--session-primary);
        transform: translateX(-2px);
    }

    .back-button i {
        font-size: 12px;
    }

    /* =========================================================
       HERO — light card, illustration on the right,
       just like a clean product landing panel
    ========================================================= */

    .session-hero {
        position: relative;
        overflow: hidden;

        border-radius: 24px;
        padding: 40px 44px;
        margin-bottom: 24px;

        background: var(--session-card);
        border: 1px solid var(--session-border);
        box-shadow: var(--session-shadow);
    }

    .hero-content {
        position: relative;
        z-index: 2;

        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 40px;
    }

    .hero-left {
        min-width: 0;
    }

    .hero-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;

        padding: 8px 15px;
        border-radius: 50px;

        background: #EAF1FF;
        color: var(--session-primary);

        font-size: 12px;
        font-weight: 700;

        margin-bottom: 18px;
    }

    .hero-label i {
        font-size: 12px;
    }

    .hero-title {
        margin: 0 0 12px;
        color: var(--session-text);

        font-size: clamp(28px, 4vw, 40px);
        line-height: 1.16;
        font-weight: 800;
        letter-spacing: -.8px;
        word-break: break-word;
    }

    .hero-subtitle {
        margin: 0;
        color: var(--session-muted);

        font-size: 15px;
        line-height: 1.6;
    }

    .hero-subtitle strong {
        color: var(--session-text);
        font-weight: 700;
    }

    /* =========================================================
       STATUS
    ========================================================= */

    .hero-status {
        margin-top: 20px;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;

        padding: 8px 14px;
        border-radius: 50px;

        font-size: 11px;
        font-weight: 800;
        letter-spacing: .2px;

        background: #EAF9F0;
        color: #148548;
        border: 1px solid #D4F0E0;
    }

    .status-badge.is-scheduled,
    .status-badge.is-confirmed {
        background: #EAF1FF;
        color: var(--session-primary-dark);
        border-color: #D8E4FC;
    }

    .status-badge.is-other {
        background: #FFF3E5;
        color: #B4690E;
        border-color: #FBE3C4;
    }

    .status-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: currentColor;
    }

    /* =========================================================
       HERO ILLUSTRATION
    ========================================================= */

    .hero-session-icon {
        position: relative;

        width: 150px;
        height: 150px;
        flex-shrink: 0;

        display: flex;
        align-items: center;
        justify-content: center;
    }

    .hero-session-icon .icon-blob {
        position: absolute;
        inset: 0;
        border-radius: 50%;
        background: linear-gradient(135deg, #EEF4FF, #F3EEFF);
    }

    .hero-session-icon .icon-badge {
        position: absolute;
        top: 6px;
        right: 6px;

        width: 30px;
        height: 30px;
        border-radius: 50%;

        display: flex;
        align-items: center;
        justify-content: center;

        background: #EAF9F0;
        color: var(--session-green);
        font-size: 13px;

        border: 3px solid #fff;
    }

    .hero-session-icon .icon-core {
        position: relative;
        z-index: 1;

        width: 64px;
        height: 64px;
        border-radius: 20px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: #fff;
        color: var(--session-primary);
        font-size: 26px;

        box-shadow: 0 12px 26px rgba(51,118,242,.16);
    }

    /* =========================================================
       META GRID  (mirrors the feature list in the reference)
    ========================================================= */

    .meta-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 17px;
        margin-bottom: 25px;
    }

    .meta-card {
        display: flex;
        align-items: flex-start;
        gap: 13px;

        background: #fff;
        border: 1px solid var(--session-border);
        border-radius: 17px;
        padding: 19px;

        box-shadow: var(--session-shadow);
        transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
    }

    .meta-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--session-shadow-hover);
        border-color: #D9E2F3;
    }

    .meta-icon {
        width: 40px;
        height: 40px;
        flex-shrink: 0;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 12px;
        background: #EEF4FF;
        color: var(--session-primary);
        font-size: 15px;
    }

    .meta-card:nth-child(2) .meta-icon {
        background: #F1ECFF;
        color: var(--session-purple);
    }

    .meta-card:nth-child(3) .meta-icon {
        background: #EAF9F0;
        color: var(--session-green);
    }

    .meta-label {
        color: var(--session-muted);
        font-size: 11px;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .meta-value {
        color: var(--session-text);
        font-size: 15px;
        line-height: 1.4;
        font-weight: 800;
    }

    /* =========================================================
       MAIN LAYOUT
    ========================================================= */

    .session-layout {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 330px;
        gap: 23px;
        align-items: start;
    }

    /* =========================================================
       CONTENT CARD
    ========================================================= */

    .content-card {
        background: #fff;
        border: 1px solid var(--session-border);
        border-radius: 19px;
        box-shadow: var(--session-shadow);
        overflow: hidden;
        margin-bottom: 22px;
    }

    .content-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;

        padding: 20px 23px;
        border-bottom: 1px solid var(--session-border);
    }

    .section-heading {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .section-icon {
        width: 39px;
        height: 39px;
        flex-shrink: 0;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 11px;
        background: #EEF4FF;
        color: var(--session-primary);
        font-size: 14px;
    }

    .section-title {
        color: var(--session-text);
        font-size: 15px;
        font-weight: 800;
        line-height: 1.3;
    }

    .section-subtitle {
        color: var(--session-muted);
        font-size: 11px;
        margin-top: 4px;
        line-height: 1.5;
    }

    .content-card-body {
        padding: 23px;
    }

    /* =========================================================
       AGENDA
    ========================================================= */

    .agenda-box {
        display: flex;
        gap: 15px;
        padding: 18px;

        border-radius: 14px;
        background: #FAFBFE;
        border: 1px solid var(--session-border);
    }

    .agenda-icon {
        width: 40px;
        height: 40px;
        flex-shrink: 0;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 11px;
        background: #fff;
        color: var(--session-primary);
        box-shadow: 0 4px 12px rgba(40,64,120,.06);
        font-size: 14px;
    }

    .agenda-label {
        color: var(--session-text);
        font-size: 12px;
        font-weight: 800;
        margin-bottom: 6px;
    }

    .agenda-text {
        color: var(--session-muted);
        font-size: 13px;
        line-height: 1.75;
        white-space: pre-line;
    }

    /* =========================================================
       NOTES
    ========================================================= */

    .notes-grid {
        display: grid;
        gap: 15px;
    }

    .notes-card {
        padding: 19px;
        border-radius: 15px;

        background: #FAFBFE;
        border: 1px solid var(--session-border);
        transition: border-color .2s ease, transform .2s ease, box-shadow .2s ease;
    }

    .notes-card:hover {
        border-color: #D9E2F3;
        transform: translateY(-1px);
        box-shadow: 0 8px 22px rgba(40,64,120,.05);
    }

    .notes-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 11px;
    }

    .notes-icon {
        width: 35px;
        height: 35px;
        flex-shrink: 0;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 10px;
        background: #EEF4FF;
        color: var(--session-primary);
        font-size: 13px;
    }

    .notes-title {
        color: var(--session-text);
        font-size: 13px;
        font-weight: 800;
    }

    .notes-text {
        margin: 0;
        color: var(--session-muted);
        font-size: 13px;
        line-height: 1.75;
        white-space: pre-line;
    }

    /* =========================================================
       FEEDBACK CARD
    ========================================================= */

    .feedback-card {
        background: #fff;
        border: 1px solid var(--session-border);
        border-radius: 20px;
        padding: 24px;
        box-shadow: var(--session-shadow);
    }

    .feedback-heading {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 21px;
    }

    .feedback-icon {
        width: 42px;
        height: 42px;
        flex-shrink: 0;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 12px;
        background: #FFF3E5;
        color: var(--session-amber);
        font-size: 15px;
    }

    .feedback-title {
        font-size: 15px;
        font-weight: 800;
        color: var(--session-text);
    }

    .feedback-subtitle {
        font-size: 11px;
        color: var(--session-muted);
        margin-top: 4px;
    }

    .form-group {
        margin-bottom: 17px;
    }

    .form-label {
        display: block;
        color: #47536A;
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .session-form-control {
        width: 100%;
        min-height: 44px;
        padding: 10px 13px;

        border-radius: 10px;
        border: 1px solid #D9E1EE;
        background: #fff;
        color: var(--session-text);
        font-size: 13px;
        outline: none;
        transition: all .2s ease;
    }

    .session-form-control:hover {
        border-color: #C9D4E7;
    }

    .session-form-control:focus {
        border-color: var(--session-primary);
        box-shadow: 0 0 0 4px rgba(51,118,242,.08);
    }

    textarea.session-form-control {
        min-height: 120px;
        resize: vertical;
        line-height: 1.65;
    }

    .rating-select {
        max-width: 210px;
        cursor: pointer;
    }

    .feedback-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;

        min-height: 44px;
        padding: 10px 20px;
        border: 0;
        border-radius: 10px;

        background: var(--session-primary);
        color: #fff;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;

        box-shadow: 0 8px 18px rgba(51,118,242,.20);
        transition: all .2s ease;
    }

    .feedback-button:hover {
        background: var(--session-primary-dark);
        transform: translateY(-1px);
        box-shadow: 0 10px 22px rgba(51,118,242,.26);
    }

    .feedback-button:active {
        transform: translateY(0);
    }

    /* =========================================================
       SIDEBAR
    ========================================================= */

    .side-card {
        background: #fff;
        border: 1px solid var(--session-border);
        border-radius: 19px;
        box-shadow: var(--session-shadow);
        padding: 22px;
        margin-bottom: 21px;
    }

    /* =========================================================
       MENTOR PROFILE
    ========================================================= */

    .mentor-side-profile {
        text-align: center;
    }

    .mentor-avatar-large {
        width: 74px;
        height: 74px;
        margin: 0 auto 14px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 20px;
        background: linear-gradient(135deg, #3376F2, #7C4DFF);
        color: #fff;
        font-size: 26px;
        font-weight: 800;

        box-shadow: 0 10px 22px rgba(51,118,242,.20);
    }

    .mentor-side-name {
        color: var(--session-text);
        font-size: 17px;
        font-weight: 800;
        margin-bottom: 5px;
    }

    .mentor-side-role {
        color: var(--session-muted);
        font-size: 11px;
        margin-bottom: 16px;
    }

    .mentor-active {
        display: inline-flex;
        align-items: center;
        gap: 7px;

        padding: 7px 12px;
        border-radius: 50px;

        background: #EAF9F0;
        color: #148548;
        font-size: 10px;
        font-weight: 800;
    }

    .mentor-active-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: var(--session-green);
    }

    /* =========================================================
       SIDEBAR TITLE
    ========================================================= */

    .side-title {
        display: flex;
        align-items: center;
        gap: 9px;

        color: var(--session-text);
        font-size: 14px;
        font-weight: 800;
        margin-bottom: 15px;
    }

    .side-title i {
        color: var(--session-primary);
        font-size: 14px;
    }

    /* =========================================================
       DETAILS
    ========================================================= */

    .detail-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;

        padding: 12px 0;
        border-bottom: 1px solid var(--session-border);
    }

    .detail-row:last-child {
        border-bottom: 0;
        padding-bottom: 0;
    }

    .detail-label {
        color: #8993A6;
        font-size: 11px;
    }

    .detail-value {
        color: #354157;
        font-size: 11px;
        font-weight: 700;
        text-align: right;
    }

    /* =========================================================
       FEEDBACK STATUS
    ========================================================= */

    .feedback-status-score {
        text-align: center;
        padding: 9px 0 4px;
    }

    .feedback-score-number {
        font-size: 29px;
        font-weight: 800;
        color: var(--session-text);
        margin-bottom: 7px;
    }

    .feedback-stars {
        color: var(--session-amber);
        font-size: 15px;
        letter-spacing: 2px;
    }

    .feedback-submitted {
        margin-top: 9px;
        color: var(--session-green);
        font-size: 11px;
        font-weight: 700;
    }

    .feedback-empty {
        text-align: center;
        padding: 10px 0 4px;
        color: #8792A7;
        font-size: 11px;
        line-height: 1.65;
    }

    .feedback-empty i {
        display: inline-block;
        font-size: 25px;
        color: var(--session-amber);
        margin-bottom: 9px;
    }

    /* =========================================================
       TABLET
    ========================================================= */

    @media (max-width: 1050px) {

        .session-layout {
            grid-template-columns: minmax(0, 1fr) 290px;
        }

        .session-hero {
            padding: 34px;
        }

        .hero-title {
            font-size: 34px;
        }
    }

    /* =========================================================
       MOBILE / TABLET
    ========================================================= */

    @media (max-width: 900px) {

        .session-layout {
            grid-template-columns: 1fr;
        }

        .meta-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .side-card {
            margin-bottom: 18px;
        }
    }

    /* =========================================================
       MOBILE
    ========================================================= */

    @media (max-width: 650px) {

        .session-page {
            padding: 8px 0 45px;
        }

        .back-button {
            margin-bottom: 13px;
            font-size: 12px;
        }

        .session-hero {
            border-radius: 19px;
            padding: 27px 21px;
            margin-bottom: 17px;
        }

        .hero-content {
            display: block;
        }

        .hero-session-icon {
            display: none;
        }

        .hero-label {
            font-size: 11px;
            padding: 7px 11px;
            margin-bottom: 13px;
        }

        .hero-title {
            font-size: 27px;
            letter-spacing: -.4px;
        }

        .hero-subtitle {
            font-size: 12px;
        }

        .hero-status {
            margin-top: 15px;
        }

        .meta-grid {
            grid-template-columns: 1fr;
            gap: 11px;
            margin-bottom: 18px;
        }

        .meta-card {
            padding: 16px;
            border-radius: 15px;
        }

        .meta-icon {
            width: 38px;
            height: 38px;
        }

        .meta-value {
            font-size: 14px;
        }

        .content-card {
            border-radius: 16px;
            margin-bottom: 17px;
        }

        .content-card-header {
            padding: 17px;
            align-items: flex-start;
        }

        .content-card-body {
            padding: 17px;
        }

        .section-icon {
            width: 35px;
            height: 35px;
            font-size: 12px;
        }

        .section-title {
            font-size: 14px;
        }

        .section-subtitle {
            font-size: 10px;
        }

        .agenda-box {
            padding: 15px;
            gap: 12px;
        }

        .agenda-icon {
            width: 35px;
            height: 35px;
        }

        .agenda-text {
            font-size: 12px;
            line-height: 1.7;
        }

        .notes-card {
            padding: 16px;
        }

        .notes-text {
            font-size: 12px;
        }

        .feedback-card {
            padding: 18px;
            border-radius: 17px;
        }

        .feedback-title {
            font-size: 14px;
        }

        .feedback-subtitle {
            font-size: 10px;
        }

        .session-form-control {
            font-size: 12px;
        }

        .feedback-button {
            width: 100%;
            font-size: 12px;
        }

        .side-card {
            padding: 19px;
            border-radius: 17px;
        }
    }

    /* =========================================================
       SMALL MOBILE
    ========================================================= */

    @media (max-width: 420px) {

        .session-hero {
            padding: 24px 18px;
        }

        .hero-title {
            font-size: 24px;
        }

        .hero-subtitle {
            font-size: 11px;
        }

        .content-card-header {
            padding: 15px;
        }

        .content-card-body {
            padding: 15px;
        }

        .feedback-card {
            padding: 16px;
        }
    }
</style>

<div class="session-page">


{{-- =====================================================
     BACK
====================================================== --}}

<a href="{{ route('student.sessions.upcoming') }}"
   class="back-button">

    <i class="fa-solid fa-arrow-left"></i>

    Back to Sessions

</a>


{{-- =====================================================
     HERO
====================================================== --}}

<section class="session-hero">

    <div class="hero-content">

        <div class="hero-left">

            <div class="hero-label">

                <i class="fa-solid fa-chalkboard-user"></i>

                Mentorship Session

            </div>


            <h1 class="hero-title">
                {{ $session->topic }}
            </h1>


            <p class="hero-subtitle">

                Session with

                <strong>
                    {{ $session->mentor->name }}
                </strong>

            </p>


            <div class="hero-status">

                @if($session->status === 'completed')

                    <span class="status-badge">

                        <span class="status-dot"></span>

                        Completed

                    </span>

                @elseif(in_array($session->status, ['scheduled', 'confirmed']))

                    <span class="status-badge is-scheduled">

                        <span class="status-dot"></span>

                        {{ ucfirst($session->status) }}

                    </span>

                @else

                    <span class="status-badge is-other">

                        <span class="status-dot"></span>

                        {{ ucfirst($session->status) }}

                    </span>

                @endif

            </div>

        </div>


        <div class="hero-session-icon">

            <div class="icon-blob"></div>

            <div class="icon-core">

                @if($session->status === 'completed')

                    <i class="fa-solid fa-circle-check"></i>

                @else

                    <i class="fa-solid fa-video"></i>

                @endif

            </div>

            <div class="icon-badge">
                <i class="fa-solid fa-check"></i>
            </div>

        </div>

    </div>

</section>


{{-- =====================================================
     SESSION META
====================================================== --}}

<div class="meta-grid">

    <div class="meta-card">

        <div class="meta-icon">
            <i class="fa-regular fa-calendar"></i>
        </div>

        <div>

            <div class="meta-label">
                Session Date
            </div>

            <div class="meta-value">
                {{ $session->session_date->format('d M Y') }}
            </div>

        </div>

    </div>


    <div class="meta-card">

        <div class="meta-icon">
            <i class="fa-regular fa-clock"></i>
        </div>

        <div>

            <div class="meta-label">
                Time & Duration
            </div>

            <div class="meta-value">

                {{ \Carbon\Carbon::parse($session->start_time)->format('h:i A') }}

                <span style="
                    font-weight:500;
                    color:#8792A7;
                ">
                    · {{ $session->duration_minutes }} min
                </span>

            </div>

        </div>

    </div>


    <div class="meta-card">

        <div class="meta-icon">
            <i class="fa-solid fa-video"></i>
        </div>

        <div>

            <div class="meta-label">
                Meeting Type
            </div>

            <div class="meta-value">
                {{ ucfirst($session->meeting_type) }}
            </div>

        </div>

    </div>

</div>


{{-- =====================================================
     MAIN LAYOUT
====================================================== --}}

<div class="session-layout">


    {{-- =================================================
         LEFT CONTENT
    ================================================== --}}

    <div>


        {{-- =============================================
             AGENDA
        ============================================== --}}

        @if($session->agenda)

            <div class="content-card">

                <div class="content-card-header">

                    <div class="section-heading">

                        <div class="section-icon">
                            <i class="fa-solid fa-list-check"></i>
                        </div>

                        <div>

                            <div class="section-title">
                                Session Agenda
                            </div>

                            <div class="section-subtitle">
                                Topics covered during this session
                            </div>

                        </div>

                    </div>

                </div>


                <div class="content-card-body">

                    <div class="agenda-box">

                        <div class="agenda-icon">
                            <i class="fa-solid fa-list"></i>
                        </div>

                        <div>

                            <div class="agenda-label">
                                Discussion Agenda
                            </div>

                            <div class="agenda-text">
                                {{ $session->agenda }}
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        @endif


        {{-- =============================================
             COMPLETED SESSION CONTENT
        ============================================== --}}

        @if($session->status === 'completed')

            @if(
                $session->mentor_notes ||
                $session->homework ||
                $session->resources
            )

                <div class="content-card">

                    <div class="content-card-header">

                        <div class="section-heading">

                            <div class="section-icon">
                                <i class="fa-solid fa-file-lines"></i>
                            </div>

                            <div>

                                <div class="section-title">
                                    Session Takeaways
                                </div>

                                <div class="section-subtitle">
                                    Notes and resources shared by your mentor
                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="content-card-body">

                        <div class="notes-grid">


                            {{-- MENTOR NOTES --}}

                            @if($session->mentor_notes)

                                <div class="notes-card">

                                    <div class="notes-header">

                                        <div class="notes-icon">
                                            <i class="fa-solid fa-note-sticky"></i>
                                        </div>

                                        <div class="notes-title">
                                            Mentor Notes
                                        </div>

                                    </div>

                                    <p class="notes-text">
                                        {{ $session->mentor_notes }}
                                    </p>

                                </div>

                            @endif


                            {{-- HOMEWORK --}}

                            @if($session->homework)

                                <div class="notes-card">

                                    <div class="notes-header">

                                        <div
                                            class="notes-icon"
                                            style="
                                                background:#FFF3E5;
                                                color:#B4690E;
                                            "
                                        >
                                            <i class="fa-solid fa-list-check"></i>
                                        </div>

                                        <div class="notes-title">
                                            Homework / Action Items
                                        </div>

                                    </div>

                                    <p class="notes-text">
                                        {{ $session->homework }}
                                    </p>

                                </div>

                            @endif


                            {{-- RESOURCES --}}

                            @if($session->resources)

                                <div class="notes-card">

                                    <div class="notes-header">

                                        <div
                                            class="notes-icon"
                                            style="
                                                background:#F1ECFF;
                                                color:#7C4DFF;
                                            "
                                        >
                                            <i class="fa-solid fa-book-open"></i>
                                        </div>

                                        <div class="notes-title">
                                            Resources
                                        </div>

                                    </div>

                                    <p class="notes-text">
                                        {{ $session->resources }}
                                    </p>

                                </div>

                            @endif

                        </div>

                    </div>

                </div>

            @endif


            {{-- =========================================
                 FEEDBACK
            ========================================== --}}

            <div class="feedback-card">

                <div class="feedback-heading">

                    <div class="feedback-icon">
                        <i class="fa-solid fa-star"></i>
                    </div>

                    <div>

                        <div class="feedback-title">

                            {{ $session->feedback
                                ? 'Your Feedback'
                                : 'Give Session Feedback'
                            }}

                        </div>

                        <div class="feedback-subtitle">

                            {{ $session->feedback
                                ? 'You can update your feedback anytime.'
                                : 'Tell us how your mentorship session went.'
                            }}

                        </div>

                    </div>

                </div>


                <form
                    method="POST"
                    action="{{ route('student.sessions.feedback', $session) }}"
                >

                    @csrf


                    {{-- RATING --}}

                    <div class="form-group">

                        <label class="form-label">
                            Rate your mentor
                        </label>

                        <select
                            name="rating"
                            class="session-form-control rating-select"
                            required
                        >

                            @for($i = 5; $i >= 1; $i--)

                                <option
                                    value="{{ $i }}"
                                    {{ optional($session->feedback)->rating == $i ? 'selected' : '' }}
                                >

                                    {{ $i }}
                                    star{{ $i > 1 ? 's' : '' }}

                                </option>

                            @endfor

                        </select>

                    </div>


                    {{-- COMMENT --}}

                    <div class="form-group">

                        <label class="form-label">

                            Comments

                            <span style="
                                color:#9AA3B3;
                                font-weight:500;
                            ">
                                (optional)
                            </span>

                        </label>

                        <textarea
                            name="comment"
                            class="session-form-control"
                            placeholder="How was this session? Share your experience or feedback..."
                        >{{ optional($session->feedback)->comment }}</textarea>

                    </div>


                    <button
                        type="submit"
                        class="feedback-button"
                    >

                        @if($session->feedback)

                            <i class="fa-solid fa-rotate"></i>

                            Update Feedback

                        @else

                            <i class="fa-solid fa-paper-plane"></i>

                            Submit Feedback

                        @endif

                    </button>

                </form>

            </div>

        @endif

    </div>


    {{-- =================================================
         RIGHT SIDEBAR
    ================================================== --}}

    <aside>


        {{-- =============================================
             MENTOR CARD
        ============================================== --}}

        <div class="side-card">

            <div class="mentor-side-profile">

                <div class="mentor-avatar-large">

                    {{ strtoupper(substr($session->mentor->name, 0, 1)) }}

                </div>

                <div class="mentor-side-name">
                    {{ $session->mentor->name }}
                </div>

                <div class="mentor-side-role">
                    Professional Mentor
                </div>

                <span class="mentor-active">

                    <span class="mentor-active-dot"></span>

                    Mentor

                </span>

            </div>

        </div>


        {{-- =============================================
             SESSION INFORMATION
        ============================================== --}}

        <div class="side-card">

            <div class="side-title">

                <i class="fa-solid fa-circle-info"></i>

                Session Information

            </div>


            <div class="detail-row">

                <span class="detail-label">
                    Status
                </span>

                <span class="detail-value">
                    {{ ucfirst($session->status) }}
                </span>

            </div>


            <div class="detail-row">

                <span class="detail-label">
                    Date
                </span>

                <span class="detail-value">
                    {{ $session->session_date->format('d M Y') }}
                </span>

            </div>


            <div class="detail-row">

                <span class="detail-label">
                    Start Time
                </span>

                <span class="detail-value">
                    {{ \Carbon\Carbon::parse($session->start_time)->format('h:i A') }}
                </span>

            </div>


            <div class="detail-row">

                <span class="detail-label">
                    Duration
                </span>

                <span class="detail-value">
                    {{ $session->duration_minutes }} minutes
                </span>

            </div>


            <div class="detail-row">

                <span class="detail-label">
                    Meeting
                </span>

                <span class="detail-value">
                    {{ ucfirst($session->meeting_type) }}
                </span>

            </div>

        </div>


        {{-- =============================================
             FEEDBACK STATUS
        ============================================== --}}

        @if($session->status === 'completed')

            <div class="side-card">

                <div class="side-title">

                    <i class="fa-solid fa-star"></i>

                    Feedback Status

                </div>


                @if($session->feedback)

                    <div class="feedback-status-score">

                        <div class="feedback-score-number">
                            {{ $session->feedback->rating }}/5
                        </div>


                        <div class="feedback-stars">

                            @for($i = 1; $i <= 5; $i++)

                                <i
                                    class="fa-solid fa-star"
                                    style="
                                        color:{{ $i <= $session->feedback->rating
                                            ? '#F59E0B'
                                            : '#E4E7EC'
                                        }};
                                    "
                                ></i>

                            @endfor

                        </div>


                        <div class="feedback-submitted">

                            <i class="fa-solid fa-circle-check"></i>

                            Feedback Submitted

                        </div>

                    </div>

                @else

                    <div class="feedback-empty">

                        <i class="fa-regular fa-star"></i>

                        <br>

                        You haven't rated this session yet.

                    </div>

                @endif

            </div>

        @endif

    </aside>

</div>


</div>

@endsection
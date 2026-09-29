@extends('layouts.app')

@php($portal = 'student')

@section('title', $session->topic)

@section('content')

<style>
    /* =========================================================
       TECH LEADERS NETWORK - SESSION DETAIL
       Matches the "My Mentorship" / mentor profile design system.
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
        --tl-amber: #B4690E;
        --tl-soft-amber: #FFF3E5;
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

    .session-page {
        width: 100%;
        min-height: calc(100vh - 130px);
        background: var(--tl-bg);
        color: var(--tl-text);
        font-family: 'Inter', sans-serif;
        padding: 24px 0 56px;
        overflow-x: hidden;
    }

    /* =========================================================
       BACK BUTTON
    ========================================================= */

    .back-button {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        color: #718096;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        margin: 0 var(--tl-gap-lg) 18px;
        transition: .2s ease;
    }

    .back-button:hover {
        color: var(--tl-primary);
        transform: translateX(-2px);
    }

    .back-button i {
        font-size: 12px;
    }

    /* =========================================================
       HERO
    ========================================================= */

    .session-hero {
        width: 100%;
        min-height: 260px;
        background: #fff;
        border: 1px solid var(--tl-border);
        border-radius: 16px;
        overflow: hidden;
        margin: 0 var(--tl-gap-lg) var(--tl-gap-lg);
        position: relative;
    }

    .session-hero-inner {
        min-height: 260px;
        display: grid;
        grid-template-columns: 1fr auto;
        align-items: center;
        padding: 40px 44px;
        gap: 36px;
    }

    .hero-left {
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
        margin: 0 0 12px;
        font-family: 'Inter', sans-serif;
        font-size: clamp(26px, 3.2vw, 36px);
        line-height: 1.2;
        letter-spacing: -0.6px;
        font-weight: 800;
        color: #172033;
        max-width: 620px;
        word-break: break-word;
    }

    .hero-subtitle {
        margin: 0 0 20px;
        color: #66748B;
        font-size: 15px;
        line-height: 1.7;
    }

    .hero-subtitle strong {
        color: var(--tl-text);
        font-weight: 700;
    }

    /* status pills (shared language across the app) */

    .status-pill {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 8px 14px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: .2px;
    }

    .status-pill .dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: currentColor;
    }

    .status-pill.completed {
        color: #148548;
        background: var(--tl-soft-green);
    }

    .status-pill.scheduled {
        color: var(--tl-primary-dark);
        background: var(--tl-soft-blue);
    }

    .status-pill.other {
        color: var(--tl-amber);
        background: var(--tl-soft-amber);
    }

    /* hero icon (right side, simple — no illustration) */

    .hero-icon {
        width: 84px;
        height: 84px;
        flex-shrink: 0;
        border-radius: 20px;
        background: var(--tl-soft-blue);
        color: var(--tl-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
    }

    .hero-icon.done {
        background: var(--tl-soft-green);
        color: var(--tl-green);
    }

    /* =========================================================
       META GRID
    ========================================================= */

    .meta-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
        margin: 0 var(--tl-gap-lg) var(--tl-gap-lg);
    }

    .meta-card {
        display: flex;
        align-items: flex-start;
        gap: 13px;
        background: #fff;
        border: 1px solid var(--tl-border);
        border-radius: 12px;
        padding: 18px;
        box-shadow: var(--tl-shadow);
        transition: .2s ease;
    }

    .meta-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 26px rgba(31,56,110,.08);
        border-color: #D9E2F3;
    }

    .meta-icon {
        width: 38px;
        height: 38px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: var(--tl-soft-blue);
        color: var(--tl-primary);
        font-size: 14px;
    }

    .meta-card:nth-child(2) .meta-icon {
        background: var(--tl-soft-purple);
        color: var(--tl-purple);
    }

    .meta-card:nth-child(3) .meta-icon {
        background: var(--tl-soft-green);
        color: var(--tl-green);
    }

    .meta-label {
        color: #8A94A8;
        font-size: 11px;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .meta-value {
        color: var(--tl-text);
        font-size: 14.5px;
        line-height: 1.4;
        font-weight: 800;
    }

    .meta-value .meta-sub {
        font-weight: 500;
        color: #8792A7;
    }

    /* =========================================================
       MAIN LAYOUT
    ========================================================= */

    .session-layout {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 330px;
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
        margin-bottom: var(--tl-gap-md);
    }

    .ui-card:last-child {
        margin-bottom: 0;
    }

    .ui-card-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 15px;
        padding: 20px 20px 18px;
        border-bottom: 1px solid var(--tl-border);
    }

    .ui-card-title {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .card-icon {
        width: 38px;
        height: 38px;
        flex-shrink: 0;
        border-radius: 10px;
        background: var(--tl-soft-blue);
        color: var(--tl-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
    }

    .card-icon.purple {
        background: var(--tl-soft-purple);
        color: var(--tl-purple);
    }

    .card-icon.orange {
        background: var(--tl-soft-orange);
        color: var(--tl-orange);
    }

    .ui-card-title-text {
        font-size: 15px;
        font-weight: 800;
        color: #263752;
        line-height: 1.3;
    }

    .ui-card-subtitle {
        color: #8A94A8;
        font-size: 11.5px;
        margin-top: 4px;
        line-height: 1.5;
    }

    .ui-card-body {
        padding: 20px;
    }

    /* =========================================================
       AGENDA
    ========================================================= */

    .agenda-box {
        display: flex;
        gap: 14px;
        padding: 18px;
        border-radius: 10px;
        background: #F8FAFE;
        border: 1px solid #EAF0FA;
    }

    .agenda-icon {
        width: 38px;
        height: 38px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: #fff;
        color: var(--tl-primary);
        box-shadow: 0 4px 12px rgba(40,64,120,.06);
        font-size: 13px;
    }

    .agenda-label {
        color: var(--tl-text);
        font-size: 12.5px;
        font-weight: 700;
        margin-bottom: 7px;
    }

    .agenda-text {
        color: #66748B;
        font-size: 13px;
        line-height: 1.75;
        white-space: pre-line;
    }

    /* =========================================================
       NOTES
    ========================================================= */

    .notes-grid {
        display: grid;
        gap: 14px;
    }

    .notes-card {
        padding: 18px;
        border-radius: 10px;
        background: #F8FAFE;
        border: 1px solid #EAF0FA;
        transition: .2s ease;
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
        width: 34px;
        height: 34px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        background: var(--tl-soft-blue);
        color: var(--tl-primary);
        font-size: 12px;
    }

    .notes-icon.amber {
        background: var(--tl-soft-amber);
        color: var(--tl-amber);
    }

    .notes-icon.purple {
        background: var(--tl-soft-purple);
        color: var(--tl-purple);
    }

    .notes-title {
        color: var(--tl-text);
        font-size: 12.5px;
        font-weight: 700;
    }

    .notes-text {
        margin: 0;
        color: #66748B;
        font-size: 12.5px;
        line-height: 1.75;
        white-space: pre-line;
    }

    /* =========================================================
       FEEDBACK FORM
    ========================================================= */

    .feedback-form-group {
        margin-bottom: 17px;
    }

    .form-label {
        display: block;
        color: #47536A;
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .form-label .optional {
        color: #9AA3B3;
        font-weight: 500;
    }

    .session-form-control {
        width: 100%;
        min-height: 46px;
        padding: 10px 13px;
        border-radius: 8px;
        border: 1px solid #D9E1EE;
        background: #fff;
        color: var(--tl-text);
        font-size: 13px;
        outline: none;
        transition: .2s ease;
    }

    .session-form-control:hover {
        border-color: #C9D4E7;
    }

    .session-form-control:focus {
        border-color: var(--tl-primary);
        box-shadow: 0 0 0 4px rgba(51,118,242,.08);
    }

    textarea.session-form-control {
        min-height: 120px;
        resize: vertical;
        line-height: 1.65;
    }

    .rating-select {
        max-width: 220px;
        cursor: pointer;
    }

    .full-btn {
        min-height: 46px;
        border: 0;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 0 22px;
        background: var(--tl-primary);
        color: #fff;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        transition: .2s ease;
    }

    .full-btn:hover {
        background: var(--tl-primary-dark);
        color: #fff;
        transform: translateY(-1px);
    }

    /* =========================================================
       SIDEBAR
    ========================================================= */

    .mentor-side-profile {
        text-align: center;
    }

    .mentor-avatar-large {
        width: 70px;
        height: 70px;
        margin: 0 auto 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 18px;
        background: linear-gradient(135deg, #3376F2, #7C4DFF);
        color: #fff;
        font-size: 25px;
        font-weight: 800;
        box-shadow: 0 10px 22px rgba(51,118,242,.20);
    }

    .mentor-side-name {
        color: var(--tl-text);
        font-size: 16px;
        font-weight: 800;
        margin-bottom: 5px;
    }

    .mentor-side-role {
        color: #8A94A8;
        font-size: 11.5px;
        margin-bottom: 16px;
    }

    .mentor-active {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 7px 12px;
        border-radius: 50px;
        background: var(--tl-soft-green);
        color: #148548;
        font-size: 10px;
        font-weight: 800;
    }

    .mentor-active-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: var(--tl-green);
    }

    .side-title {
        display: flex;
        align-items: center;
        gap: 9px;
        color: var(--tl-text);
        font-size: 13.5px;
        font-weight: 800;
        margin-bottom: 15px;
    }

    .side-title i {
        color: var(--tl-primary);
        font-size: 13px;
    }

    .detail-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 12px 0;
        border-bottom: 1px solid var(--tl-border);
    }

    .detail-row:last-child {
        border-bottom: 0;
        padding-bottom: 0;
    }

    .detail-label {
        color: #8993A6;
        font-size: 11.5px;
    }

    .detail-value {
        color: #354157;
        font-size: 11.5px;
        font-weight: 700;
        text-align: right;
    }

    /* feedback status */

    .feedback-status-score {
        text-align: center;
        padding: 9px 0 4px;
    }

    .feedback-score-number {
        font-size: 28px;
        font-weight: 800;
        color: var(--tl-text);
        margin-bottom: 7px;
    }

    .feedback-stars {
        color: var(--tl-orange);
        font-size: 15px;
        letter-spacing: 2px;
    }

    .feedback-submitted {
        margin-top: 9px;
        color: var(--tl-green);
        font-size: 11.5px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    .feedback-empty {
        text-align: center;
        padding: 10px 0 4px;
        color: #8792A7;
        font-size: 11.5px;
        line-height: 1.65;
    }

    .feedback-empty i {
        display: block;
        font-size: 24px;
        color: var(--tl-orange);
        margin-bottom: 9px;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 1150px) {

        .session-layout {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 900px) {

        .meta-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }

    @media (max-width: 760px) {

        :root {
            --tl-gap-lg: 16px;
            --tl-gap-md: 16px;
        }

        .session-hero {
            border-radius: 12px;
        }

        .session-hero-inner {
            grid-template-columns: 1fr;
            padding: 30px 24px;
        }

        .hero-icon {
            display: none;
        }
    }

    @media (max-width: 650px) {

        .session-page {
            padding: 16px 0 32px;
        }

        .back-button {
            margin-bottom: 13px;
            font-size: 12px;
        }

        .hero-title {
            font-size: 24px;
        }

        .hero-subtitle {
            font-size: 13px;
        }

        .meta-grid {
            grid-template-columns: 1fr;
            gap: 11px;
        }

        .meta-card {
            padding: 16px;
        }

        .ui-card-header {
            padding: 17px;
        }

        .ui-card-body {
            padding: 17px;
        }

        .section-title,
        .ui-card-title-text {
            font-size: 14px;
        }

        .feedback-button,
        .full-btn {
            width: 100%;
        }
    }

    @media (max-width: 420px) {

        .session-hero-inner {
            padding: 24px 18px;
        }

        .hero-title {
            font-size: 22px;
        }

        .ui-card-header,
        .ui-card-body {
            padding: 15px;
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

    <div class="session-hero-inner">

        <div class="hero-left">

            <div class="hero-badge">
                <i class="fa-solid fa-chalkboard-user"></i>
                Mentorship Session
            </div>

            <h1 class="hero-title">
                {{ $session->topic }}
            </h1>

            <p class="hero-subtitle">
                Session with
                <strong>{{ $session->mentor->name }}</strong>
            </p>

            @if($session->status === 'completed')

                <span class="status-pill completed">
                    <span class="dot"></span>
                    Completed
                </span>

            @elseif(in_array($session->status, ['scheduled', 'confirmed']))

                <span class="status-pill scheduled">
                    <span class="dot"></span>
                    {{ ucfirst($session->status) }}
                </span>

            @else

                <span class="status-pill other">
                    <span class="dot"></span>
                    {{ ucfirst($session->status) }}
                </span>

            @endif

        </div>


        <div class="hero-icon {{ $session->status === 'completed' ? 'done' : '' }}">

            @if($session->status === 'completed')

                <i class="fa-solid fa-circle-check"></i>

            @else

                <i class="fa-solid fa-video"></i>

            @endif

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
            <div class="meta-label">Session Date</div>
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
            <div class="meta-label">Time & Duration</div>
            <div class="meta-value">
                {{ \Carbon\Carbon::parse($session->start_time)->format('h:i A') }}
                <span class="meta-sub">· {{ $session->duration_minutes }} min</span>
            </div>
        </div>

    </div>


    <div class="meta-card">

        <div class="meta-icon">
            <i class="fa-solid fa-video"></i>
        </div>

        <div>
            <div class="meta-label">Meeting Type</div>
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


        {{-- AGENDA --}}

        @if($session->agenda)

            <div class="ui-card">

                <div class="ui-card-header">

                    <div class="ui-card-title">

                        <span class="card-icon">
                            <i class="fa-solid fa-list-check"></i>
                        </span>

                        <div>
                            <div class="ui-card-title-text">Session Agenda</div>
                            <div class="ui-card-subtitle">Topics covered during this session</div>
                        </div>

                    </div>

                </div>

                <div class="ui-card-body">

                    <div class="agenda-box">

                        <div class="agenda-icon">
                            <i class="fa-solid fa-list"></i>
                        </div>

                        <div>
                            <div class="agenda-label">Discussion Agenda</div>
                            <div class="agenda-text">{{ $session->agenda }}</div>
                        </div>

                    </div>

                </div>

            </div>

        @endif


        {{-- COMPLETED SESSION CONTENT --}}

        @if($session->status === 'completed')

            @if($session->mentor_notes || $session->homework || $session->resources)

                <div class="ui-card">

                    <div class="ui-card-header">

                        <div class="ui-card-title">

                            <span class="card-icon">
                                <i class="fa-solid fa-file-lines"></i>
                            </span>

                            <div>
                                <div class="ui-card-title-text">Session Takeaways</div>
                                <div class="ui-card-subtitle">Notes and resources shared by your mentor</div>
                            </div>

                        </div>

                    </div>

                    <div class="ui-card-body">

                        <div class="notes-grid">

                            @if($session->mentor_notes)

                                <div class="notes-card">

                                    <div class="notes-header">

                                        <div class="notes-icon">
                                            <i class="fa-solid fa-note-sticky"></i>
                                        </div>

                                        <div class="notes-title">Mentor Notes</div>

                                    </div>

                                    <p class="notes-text">{{ $session->mentor_notes }}</p>

                                </div>

                            @endif


                            @if($session->homework)

                                <div class="notes-card">

                                    <div class="notes-header">

                                        <div class="notes-icon amber">
                                            <i class="fa-solid fa-list-check"></i>
                                        </div>

                                        <div class="notes-title">Homework / Action Items</div>

                                    </div>

                                    <p class="notes-text">{{ $session->homework }}</p>

                                </div>

                            @endif


                            @if($session->resources)

                                <div class="notes-card">

                                    <div class="notes-header">

                                        <div class="notes-icon purple">
                                            <i class="fa-solid fa-book-open"></i>
                                        </div>

                                        <div class="notes-title">Resources</div>

                                    </div>

                                    <p class="notes-text">{{ $session->resources }}</p>

                                </div>

                            @endif

                        </div>

                    </div>

                </div>

            @endif


            {{-- FEEDBACK --}}

            <div class="ui-card">

                <div class="ui-card-header">

                    <div class="ui-card-title">

                        <span class="card-icon orange">
                            <i class="fa-solid fa-star"></i>
                        </span>

                        <div>

                            <div class="ui-card-title-text">
                                {{ $session->feedback ? 'Your Feedback' : 'Give Session Feedback' }}
                            </div>

                            <div class="ui-card-subtitle">
                                {{ $session->feedback
                                    ? 'You can update your feedback anytime.'
                                    : 'Tell us how your mentorship session went.'
                                }}
                            </div>

                        </div>

                    </div>

                </div>

                <div class="ui-card-body">

                    <form method="POST" action="{{ route('student.sessions.feedback', $session) }}">

                        @csrf

                        <div class="feedback-form-group">

                            <label class="form-label">Rate your mentor</label>

                            <select name="rating" class="session-form-control rating-select" required>

                                @for($i = 5; $i >= 1; $i--)

                                    <option
                                        value="{{ $i }}"
                                        {{ optional($session->feedback)->rating == $i ? 'selected' : '' }}
                                    >
                                        {{ $i }} star{{ $i > 1 ? 's' : '' }}
                                    </option>

                                @endfor

                            </select>

                        </div>


                        <div class="feedback-form-group">

                            <label class="form-label">
                                Comments
                                <span class="optional">(optional)</span>
                            </label>

                            <textarea
                                name="comment"
                                class="session-form-control"
                                placeholder="How was this session? Share your experience or feedback..."
                            >{{ optional($session->feedback)->comment }}</textarea>

                        </div>


                        <button type="submit" class="full-btn">

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

            </div>

        @endif

    </div>


    {{-- =================================================
         RIGHT SIDEBAR
    ================================================== --}}

    <aside>


        {{-- MENTOR CARD --}}

        <div class="ui-card">

            <div class="ui-card-body">

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

        </div>


        {{-- SESSION INFORMATION --}}

        <div class="ui-card">

            <div class="ui-card-body">

                <div class="side-title">
                    <i class="fa-solid fa-circle-info"></i>
                    Session Information
                </div>

                <div class="detail-row">
                    <span class="detail-label">Status</span>
                    <span class="detail-value">{{ ucfirst($session->status) }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Date</span>
                    <span class="detail-value">{{ $session->session_date->format('d M Y') }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Start Time</span>
                    <span class="detail-value">
                        {{ \Carbon\Carbon::parse($session->start_time)->format('h:i A') }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Duration</span>
                    <span class="detail-value">{{ $session->duration_minutes }} minutes</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Meeting</span>
                    <span class="detail-value">{{ ucfirst($session->meeting_type) }}</span>
                </div>

            </div>

        </div>


        {{-- FEEDBACK STATUS --}}

        @if($session->status === 'completed')

            <div class="ui-card">

                <div class="ui-card-body">

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
                                        style="color:{{ $i <= $session->feedback->rating ? '#D99000' : '#E4E7EC' }};"
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
                            You haven't rated this session yet.
                        </div>

                    @endif

                </div>

            </div>

        @endif

    </aside>

</div>


</div>

@endsection
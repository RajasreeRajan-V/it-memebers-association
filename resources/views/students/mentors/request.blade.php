@extends('layouts.app')

@php
    $portal = 'student';

    // Always define this before the days checkbox loop.
    $selectedDays = old('preferred_days', []);

    // Make sure it is always an array.
    if (!is_array($selectedDays)) {
        $selectedDays = [];
    }
@endphp

@section('title', 'Request Mentorship')

@section('content')

<style>
    :root {
        --mr-primary: #3376F2;
        --mr-primary-dark: #245ED1;
        --mr-purple: #7C4DFF;
        --mr-bg: #F7F9FF;
        --mr-card: #FFFFFF;
        --mr-text: #172033;
        --mr-muted: #718096;
        --mr-border: #E5EAF3;
        --mr-green: #18A957;
        --mr-red: #D92D20;
        --mr-shadow: 0 12px 35px rgba(40, 64, 120, .07);
    }

    .request-page {
        min-height: 100vh;
        background: var(--mr-bg);
        padding: 10px 0 55px;
    }

    /* =========================
       HERO
    ========================= */

    .request-hero {
        position: relative;
        overflow: hidden;
        border-radius: 22px;
        padding: 34px 38px;
        margin-bottom: 22px;
        background: linear-gradient(
            120deg,
            #3376F2 0%,
            #526EF3 48%,
            #7C4DFF 100%
        );
        color: #fff;
        box-shadow: 0 16px 40px rgba(51,118,242,.17);
    }

    .request-hero::before {
        content: "";
        position: absolute;
        width: 320px;
        height: 320px;
        border-radius: 50%;
        background: rgba(255,255,255,.07);
        right: -100px;
        top: -180px;
    }

    .request-hero::after {
        content: "";
        position: absolute;
        width: 210px;
        height: 210px;
        border-radius: 50%;
        background: rgba(255,255,255,.06);
        left: 48%;
        bottom: -160px;
    }

    .request-hero-inner {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 30px;
    }

    .request-hero-left {
        max-width: 720px;
    }

    .request-label {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 7px 12px;
        border-radius: 50px;
        background: rgba(255,255,255,.13);
        border: 1px solid rgba(255,255,255,.18);
        font-size: 10px;
        font-weight: 700;
        margin-bottom: 13px;
    }

    .request-title {
        margin: 0 0 9px;
        font-size: clamp(27px, 4vw, 38px);
        line-height: 1.15;
        font-weight: 800;
        letter-spacing: -.5px;
    }

    .request-description {
        margin: 0;
        max-width: 620px;
        color: rgba(255,255,255,.83);
        font-size: 13px;
        line-height: 1.7;
    }

    .request-hero-icon {
        width: 100px;
        height: 100px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 28px;
        background: rgba(255,255,255,.12);
        border: 1px solid rgba(255,255,255,.18);
        backdrop-filter: blur(10px);
        font-size: 40px;
    }

    /* =========================
       MAIN LAYOUT
    ========================= */

    .request-layout {
        display: grid;
        grid-template-columns: 280px minmax(0, 1fr);
        gap: 20px;
        align-items: start;
    }

    /* =========================
       MENTOR CARD
    ========================= */

    .mentor-card {
        background: #fff;
        border: 1px solid var(--mr-border);
        border-radius: 18px;
        padding: 22px;
        box-shadow: var(--mr-shadow);
        position: sticky;
        top: 20px;
    }

    .mentor-card-label {
        color: var(--mr-muted);
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: .5px;
        font-weight: 800;
        margin-bottom: 16px;
    }

    .mentor-profile {
        text-align: center;
    }

    .mentor-avatar-large {
        width: 78px;
        height: 78px;
        margin: 0 auto 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 22px;
        background: linear-gradient(
            135deg,
            #3376F2,
            #7C4DFF
        );
        color: #fff;
        font-size: 28px;
        font-weight: 800;
        box-shadow: 0 10px 25px rgba(51,118,242,.2);
    }

    .mentor-name-large {
        color: var(--mr-text);
        font-size: 17px;
        font-weight: 800;
        margin-bottom: 5px;
    }

    .mentor-designation {
        color: var(--mr-muted);
        font-size: 11px;
        line-height: 1.5;
        margin-bottom: 14px;
    }

    .mentor-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 50px;
        background: #EAF9F0;
        color: #148548;
        font-size: 9px;
        font-weight: 800;
    }

    .mentor-status-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
    }

    .mentor-divider {
        height: 1px;
        background: var(--mr-border);
        margin: 20px 0;
    }

    .mentor-info {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 14px;
    }

    .mentor-info:last-child {
        margin-bottom: 0;
    }

    .mentor-info-icon {
        width: 31px;
        height: 31px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        background: #EEF4FF;
        color: var(--mr-primary);
        font-size: 11px;
    }

    .mentor-info-title {
        color: var(--mr-text);
        font-size: 10px;
        font-weight: 800;
        margin-bottom: 3px;
    }

    .mentor-info-text {
        color: var(--mr-muted);
        font-size: 10px;
        line-height: 1.5;
    }

    .mentor-profile-link {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        width: 100%;
        margin-top: 18px;
        padding: 9px;
        border-radius: 9px;
        background: #F2F6FF;
        color: var(--mr-primary);
        text-decoration: none;
        font-size: 10px;
        font-weight: 700;
        transition: .2s ease;
    }

    .mentor-profile-link:hover {
        background: #E7EFFF;
        color: var(--mr-primary-dark);
    }

    /* =========================
       FORM CARD
    ========================= */

    .request-form-card {
        background: #fff;
        border: 1px solid var(--mr-border);
        border-radius: 18px;
        box-shadow: var(--mr-shadow);
        overflow: hidden;
    }

    .form-header {
        padding: 21px 24px;
        border-bottom: 1px solid var(--mr-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .form-header-left {
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .form-header-icon {
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        background: #EEF4FF;
        color: var(--mr-primary);
        font-size: 14px;
    }

    .form-header-title {
        color: var(--mr-text);
        font-size: 15px;
        font-weight: 800;
    }

    .form-header-subtitle {
        color: var(--mr-muted);
        font-size: 10px;
        margin-top: 3px;
    }

    .form-step {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 10px;
        border-radius: 50px;
        background: #F2F6FF;
        color: var(--mr-primary);
        font-size: 9px;
        font-weight: 800;
    }

    /* =========================
       FORM
    ========================= */

    .request-form {
        padding: 25px;
    }

    .form-section {
        margin-bottom: 27px;
    }

    .form-section:last-child {
        margin-bottom: 0;
    }

    .section-heading {
        display: flex;
        align-items: center;
        gap: 9px;
        padding-bottom: 13px;
        margin-bottom: 17px;
        border-bottom: 1px solid #F0F2F7;
    }

    .section-number {
        width: 27px;
        height: 27px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        background: linear-gradient(
            135deg,
            #3376F2,
            #7C4DFF
        );
        color: #fff;
        font-size: 10px;
        font-weight: 800;
    }

    .section-title {
        color: var(--mr-text);
        font-size: 13px;
        font-weight: 800;
    }

    .section-description {
        color: var(--mr-muted);
        font-size: 9px;
        margin-top: 2px;
    }

    .form-group {
        margin-bottom: 17px;
    }

    .form-group:last-child {
        margin-bottom: 0;
    }

    .form-group label {
        display: block;
        color: #354157;
        font-size: 11px;
        font-weight: 700;
        margin-bottom: 7px;
    }

    .optional-label {
        color: #9AA4B5;
        font-weight: 500;
        font-size: 9px;
    }

    .form-control {
        width: 100%;
        box-sizing: border-box;
        padding: 11px 12px;
        border: 1px solid var(--mr-border);
        border-radius: 9px;
        background: #FBFCFE;
        color: var(--mr-text);
        font-size: 11px;
        outline: none;
        transition: .2s ease;
    }

    .form-control::placeholder {
        color: #A8B0BF;
    }

    .form-control:hover {
        border-color: #CBD5E6;
    }

    .form-control:focus {
        border-color: var(--mr-primary);
        background: #fff;
        box-shadow: 0 0 0 3px rgba(51,118,242,.09);
    }

    textarea.form-control {
        min-height: 105px;
        resize: vertical;
        line-height: 1.6;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    /* =========================
       DAYS
    ========================= */

    .days-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .day-option {
        position: relative;
    }

    .day-option input {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .day-option label {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 48px;
        padding: 9px 11px;
        border: 1px solid var(--mr-border);
        border-radius: 8px;
        background: #FBFCFE;
        color: #647086;
        font-size: 10px;
        font-weight: 700;
        cursor: pointer;
        transition: .2s ease;
    }

    .day-option label:hover {
        border-color: #B8CAEE;
        color: var(--mr-primary);
    }

    .day-option input:checked + label {
        background: #EEF4FF;
        border-color: var(--mr-primary);
        color: var(--mr-primary);
        box-shadow: 0 3px 10px rgba(51,118,242,.08);
    }

    /* =========================
       FREQUENCY
    ========================= */

    .frequency-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 9px;
    }

    .frequency-option {
        position: relative;
    }

    .frequency-option input {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .frequency-option label {
        display: block;
        padding: 12px;
        border: 1px solid var(--mr-border);
        border-radius: 9px;
        background: #FBFCFE;
        cursor: pointer;
        transition: .2s ease;
    }

    .frequency-option label:hover {
        border-color: #B8CAEE;
    }

    .frequency-name {
        display: block;
        color: #4A566B;
        font-size: 10px;
        font-weight: 800;
        margin-bottom: 3px;
    }

    .frequency-description {
        display: block;
        color: #929BAA;
        font-size: 8px;
    }

    .frequency-option input:checked + label {
        background: #EEF4FF;
        border-color: var(--mr-primary);
    }

    .frequency-option input:checked + label .frequency-name {
        color: var(--mr-primary);
    }

    /* =========================
       HELPERS / ERRORS
    ========================= */

    .field-helper {
        color: #8C96A7;
        font-size: 9px;
        line-height: 1.5;
        margin-top: 5px;
    }

    .field-error {
        color: var(--mr-red);
        font-size: 9px;
        margin-top: 5px;
    }

    .form-control.is-error {
        border-color: #E5484D;
    }

    .request-alert {
        margin: 20px 25px 0;
        padding: 12px 14px;
        border-radius: 10px;
        background: #FFF5F5;
        border: 1px solid #FFD6D6;
        color: #B42318;
        font-size: 10px;
        line-height: 1.5;
    }

    /* =========================
       FOOTER
    ========================= */

    .form-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding-top: 21px;
        margin-top: 25px;
        border-top: 1px solid var(--mr-border);
    }

    .privacy-note {
        display: flex;
        align-items: flex-start;
        gap: 7px;
        color: #8A94A6;
        font-size: 9px;
        line-height: 1.5;
        max-width: 300px;
    }

    .privacy-note i {
        color: var(--mr-green);
        margin-top: 2px;
    }

    .form-actions {
        display: flex;
        align-items: center;
        gap: 9px;
    }

    .btn-request,
    .btn-cancel {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        border-radius: 9px;
        text-decoration: none;
        cursor: pointer;
        transition: .2s ease;
    }

    .btn-request {
        padding: 11px 17px;
        border: 0;
        background: var(--mr-primary);
        color: #fff;
        font-size: 10px;
        font-weight: 800;
    }

    .btn-request:hover {
        background: var(--mr-primary-dark);
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 7px 18px rgba(51,118,242,.18);
    }

    .btn-cancel {
        padding: 10px 15px;
        border: 1px solid var(--mr-border);
        background: #fff;
        color: #647086;
        font-size: 10px;
        font-weight: 700;
    }

    .btn-cancel:hover {
        background: #F7F9FC;
        color: var(--mr-text);
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 900px) {

        .request-layout {
            grid-template-columns: 1fr;
        }

        .mentor-card {
            position: static;
        }

        .mentor-profile {
            display: grid;
            grid-template-columns: auto 1fr;
            text-align: left;
            align-items: center;
            column-gap: 15px;
        }

        .mentor-avatar-large {
            grid-row: span 3;
            margin: 0;
        }

        .mentor-status {
            justify-self: start;
        }

        .mentor-divider,
        .mentor-info,
        .mentor-profile-link {
            grid-column: 1 / -1;
        }

        .mentor-divider {
            margin-bottom: 17px;
        }
    }

    @media (max-width: 650px) {

        .request-page {
            padding-top: 0;
        }

        .request-hero {
            border-radius: 17px;
            padding: 28px 22px;
        }

        .request-hero-inner {
            display: block;
        }

        .request-hero-icon {
            display: none;
        }

        .request-title {
            font-size: 29px;
        }

        .request-description {
            font-size: 12px;
        }

        .request-form {
            padding: 19px;
        }

        .form-header {
            padding: 17px;
        }

        .form-step {
            display: none;
        }

        .form-row {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .frequency-grid {
            grid-template-columns: 1fr;
        }

        .form-footer {
            flex-direction: column;
            align-items: stretch;
        }

        .privacy-note {
            max-width: none;
        }

        .form-actions {
            width: 100%;
        }

        .btn-request,
        .btn-cancel {
            flex: 1;
        }
    }
</style>


<div class="request-page">

    {{-- =========================
         HERO
    ========================== --}}

    <section class="request-hero">

        <div class="request-hero-inner">

            <div class="request-hero-left">

                <div class="request-label">
                    <i class="fa-solid fa-user-graduate"></i>
                    Student Mentorship
                </div>

                <h1 class="request-title">
                    Start Your Mentorship Journey
                </h1>

                <p class="request-description">
                    Tell your mentor about your goals, current skills and
                    preferred schedule. A clear request helps your mentor
                    understand how they can support your growth.
                </p>

            </div>

            <div class="request-hero-icon">
                <i class="fa-solid fa-paper-plane"></i>
            </div>

        </div>

    </section>


    {{-- =========================
         MAIN LAYOUT
    ========================== --}}

    <div class="request-layout">

        {{-- =========================
             MENTOR INFORMATION
        ========================== --}}

        <aside class="mentor-card">

            <div class="mentor-card-label">
                You're requesting mentorship from
            </div>

            <div class="mentor-profile">

                <div class="mentor-avatar-large">
                    {{ strtoupper(substr($mentor->name ?? 'M', 0, 1)) }}
                </div>

                <div class="mentor-name-large">
                    {{ $mentor->name }}
                </div>

                <div class="mentor-designation">
                    {{ $mentor->mentorRegistration->designation ?? 'Mentor' }}
                </div>

                <div class="mentor-status">
                    <span class="mentor-status-dot"></span>
                    Available for Mentorship
                </div>

            </div>

            <div class="mentor-divider"></div>

            <div class="mentor-info">

                <div class="mentor-info-icon">
                    <i class="fa-solid fa-bullseye"></i>
                </div>

                <div>
                    <div class="mentor-info-title">
                        Personalized Guidance
                    </div>

                    <div class="mentor-info-text">
                        Get guidance based on your goals and career interests.
                    </div>
                </div>

            </div>

            <div class="mentor-info">

                <div class="mentor-info-icon">
                    <i class="fa-regular fa-calendar"></i>
                </div>

                <div>
                    <div class="mentor-info-title">
                        Flexible Sessions
                    </div>

                    <div class="mentor-info-text">
                        Share your preferred days and frequency.
                    </div>
                </div>

            </div>

            <div class="mentor-info">

                <div class="mentor-info-icon">
                    <i class="fa-solid fa-comments"></i>
                </div>

                <div>
                    <div class="mentor-info-title">
                        Meaningful Conversations
                    </div>

                    <div class="mentor-info-text">
                        Discuss your challenges, questions and career plans.
                    </div>
                </div>

            </div>

            <a href="{{ route('student.mentors.show', $mentor) }}"
               class="mentor-profile-link">

                View Mentor Profile

                <i class="fa-solid fa-arrow-right"></i>

            </a>

        </aside>


        {{-- =========================
             REQUEST FORM
        ========================== --}}

        <div class="request-form-card">

            <div class="form-header">

                <div class="form-header-left">

                    <div class="form-header-icon">
                        <i class="fa-solid fa-paper-plane"></i>
                    </div>

                    <div>

                        <div class="form-header-title">
                            Mentorship Request
                        </div>

                        <div class="form-header-subtitle">
                            Share a few details so your mentor can understand your needs
                        </div>

                    </div>

                </div>

                <div class="form-step">
                    <i class="fa-solid fa-list-check"></i>
                    Request Form
                </div>

            </div>


            {{-- Validation error --}}

            @if($errors->any())

                <div class="request-alert">

                    <strong>Please check the following:</strong>

                    <ul style="margin:6px 0 0 18px;padding:0;">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <form
                method="POST"
                action="{{ route('student.mentors.request.store', $mentor) }}"
                class="request-form"
            >

                @csrf


                {{-- =========================
                     SECTION 01
                ========================== --}}

                <div class="form-section">

                    <div class="section-heading">

                        <div class="section-number">
                            01
                        </div>

                        <div>

                            <div class="section-title">
                                Your Career Goal
                            </div>

                            <div class="section-description">
                                Tell your mentor what you want to achieve.
                            </div>

                        </div>

                    </div>


                    <div class="form-group">

                        <label for="career_goal">
                            Career Goal
                        </label>

                        <input
                            type="text"
                            id="career_goal"
                            name="career_goal"
                            class="form-control @error('career_goal') is-error @enderror"
                            placeholder="e.g. Become a backend engineer"
                            value="{{ old('career_goal') }}"
                            required
                        >

                        @error('career_goal')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                        <div class="field-helper">
                            Be specific about the career direction you're working toward.
                        </div>

                    </div>


                    <div class="form-group">

                        <label for="goal">
                            Purpose / What do you want guidance on?
                        </label>

                        <textarea
                            id="goal"
                            name="goal"
                            class="form-control @error('goal') is-error @enderror"
                            placeholder="Describe what you're hoping to get out of this mentorship..."
                            required
                        >{{ old('goal') }}</textarea>

                        @error('goal')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>


                {{-- =========================
                     SECTION 02
                ========================== --}}

                <div class="form-section">

                    <div class="section-heading">

                        <div class="section-number">
                            02
                        </div>

                        <div>

                            <div class="section-title">
                                Your Current Skills
                            </div>

                            <div class="section-description">
                                Help your mentor understand your current level.
                            </div>

                        </div>

                    </div>


                    <div class="form-group">

                        <label for="current_skills">

                            Current Skills

                            <span class="optional-label">
                                Optional
                            </span>

                        </label>

                        <input
                            type="text"
                            id="current_skills"
                            name="current_skills"
                            class="form-control"
                            placeholder="e.g. PHP, Laravel, MySQL, REST APIs"
                            value="{{ old('current_skills') }}"
                        >

                        <div class="field-helper">
                            Add technologies, tools, certifications or other relevant skills.
                        </div>

                    </div>

                </div>


                {{-- =========================
                     SECTION 03
                ========================== --}}

                <div class="form-section">

                    <div class="section-heading">

                        <div class="section-number">
                            03
                        </div>

                        <div>

                            <div class="section-title">
                                Preferred Schedule
                            </div>

                            <div class="section-description">
                                Let your mentor know when you prefer to connect.
                            </div>

                        </div>

                    </div>


                    {{-- FREQUENCY --}}

                    <div class="form-group">

                        <label>
                            Preferred Frequency
                        </label>

                        <div class="frequency-grid">

                            <div class="frequency-option">

                                <input
                                    type="radio"
                                    id="frequency_weekly"
                                    name="frequency"
                                    value="weekly"
                                    {{ old('frequency', 'weekly') === 'weekly' ? 'checked' : '' }}
                                    required
                                >

                                <label for="frequency_weekly">

                                    <span class="frequency-name">
                                        Weekly
                                    </span>

                                    <span class="frequency-description">
                                        Once every week
                                    </span>

                                </label>

                            </div>


                            <div class="frequency-option">

                                <input
                                    type="radio"
                                    id="frequency_biweekly"
                                    name="frequency"
                                    value="biweekly"
                                    {{ old('frequency') === 'biweekly' ? 'checked' : '' }}
                                >

                                <label for="frequency_biweekly">

                                    <span class="frequency-name">
                                        Biweekly
                                    </span>

                                    <span class="frequency-description">
                                        Every two weeks
                                    </span>

                                </label>

                            </div>


                            <div class="frequency-option">

                                <input
                                    type="radio"
                                    id="frequency_monthly"
                                    name="frequency"
                                    value="monthly"
                                    {{ old('frequency') === 'monthly' ? 'checked' : '' }}
                                >

                                <label for="frequency_monthly">

                                    <span class="frequency-name">
                                        Monthly
                                    </span>

                                    <span class="frequency-description">
                                        Once every month
                                    </span>

                                </label>

                            </div>

                        </div>

                        @error('frequency')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="form-row">

                        {{-- PREFERRED TIME --}}

                        <div class="form-group">

                            <label for="preferred_time">

                                Preferred Time

                                <span class="optional-label">
                                    Optional
                                </span>

                            </label>

                            <input
                                type="text"
                                id="preferred_time"
                                name="preferred_time"
                                class="form-control"
                                placeholder="e.g. Weekday evenings"
                                value="{{ old('preferred_time') }}"
                            >

                        </div>


                        {{-- PREFERRED DAYS --}}

                        <div class="form-group">

                            <label>
                                Preferred Days

                                <span class="optional-label">
                                    Optional
                                </span>
                            </label>

                            <div class="days-grid">

                                @foreach(['Mon','Tue','Wed','Thu','Fri','Sat','Sun'] as $day)

                                    <div class="day-option">

                                        <input
                                            type="checkbox"
                                            id="day_{{ strtolower($day) }}"
                                            name="preferred_days[]"
                                            value="{{ $day }}"
                                            {{ in_array($day, $selectedDays, true) ? 'checked' : '' }}
                                        >

                                        <label for="day_{{ strtolower($day) }}">
                                            {{ $day }}
                                        </label>

                                    </div>

                                @endforeach

                            </div>

                            @error('preferred_days')
                                <div class="field-error">
                                    {{ $message }}
                                </div>
                            @enderror

                            @error('preferred_days.*')
                                <div class="field-error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>

                </div>


                {{-- =========================
                     SECTION 04
                ========================== --}}

                <div class="form-section">

                    <div class="section-heading">

                        <div class="section-number">
                            04
                        </div>

                        <div>

                            <div class="section-title">
                                Message to Your Mentor
                            </div>

                            <div class="section-description">
                                Introduce yourself and tell your mentor anything else they should know.
                            </div>

                        </div>

                    </div>


                    <div class="form-group">

                        <label for="message">

                            Personal Message

                            <span class="optional-label">
                                Optional
                            </span>

                        </label>

                        <textarea
                            id="message"
                            name="message"
                            class="form-control"
                            placeholder="Hi {{ $mentor->name }}, I'm interested in mentorship because..."
                        >{{ old('message') }}</textarea>

                    </div>

                </div>


                {{-- =========================
                     FOOTER
                ========================== --}}

                <div class="form-footer">

                    <div class="privacy-note">

                        <i class="fa-solid fa-shield-halved"></i>

                        <span>
                            Your information will be shared with
                            <strong>{{ $mentor->name }}</strong>
                            to help them understand your mentorship needs.
                        </span>

                    </div>


                    <div class="form-actions">

                        <a
                            href="{{ route('student.mentors.show', $mentor) }}"
                            class="btn-cancel"
                        >
                            <i class="fa-solid fa-arrow-left"></i>
                            Cancel
                        </a>


                        <button
                            type="submit"
                            class="btn-request"
                        >
                            <i class="fa-solid fa-paper-plane"></i>
                            Send Mentorship Request
                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
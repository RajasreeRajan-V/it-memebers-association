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
        --mr-bg: #F6F8FC;
        --mr-card: #FFFFFF;
        --mr-text: #172033;
        --mr-muted: #6B7280;
        --mr-border: #E6EAF0;
        --mr-success: #16A34A;
        --mr-danger: #EF4444;
        --mr-shadow: 0 8px 28px rgba(31, 41, 55, 0.07);
    }

    .request-page {
        min-height: 100vh;
        background: var(--mr-bg);
        padding: 34px 0 60px;
    }

    .request-page-container {
        width: min(1320px, calc(100% - 40px));
        margin: 0 auto;
    }

    /* =========================
       HERO (light, matches events/webinars page)
    ========================= */

    .request-hero {
        background: #FFFFFF;
        border: 1px solid var(--mr-border);
        border-radius: 24px;
        padding: 44px 46px;
        position: relative;
        overflow: hidden;
        margin-bottom: 28px;
        box-shadow: var(--mr-shadow);
    }

    .hero-grid {
        position: relative;
        z-index: 2;
        display: grid;
        grid-template-columns: 1.15fr auto 1fr;
        gap: 30px;
        align-items: center;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #EAF1FF;
        color: var(--mr-primary);
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
        color: var(--mr-text);
    }

    .hero-title span {
        display: block;
        background: linear-gradient(90deg, var(--mr-primary), var(--mr-purple));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    .hero-text {
        margin: 0 0 26px;
        font-size: 15px;
        line-height: 1.75;
        color: var(--mr-muted);
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
        border: 1px solid transparent;
        cursor: pointer;
    }

    .hero-btn-primary {
        background: var(--mr-primary);
        color: #fff;
        box-shadow: 0 10px 22px rgba(51,118,242,0.24);
    }

    .hero-btn-primary:hover {
        background: var(--mr-primary-dark);
        color: #fff;
        transform: translateY(-1px);
    }

    .hero-btn-outline {
        background: #fff;
        color: var(--mr-text);
        border-color: #DDE3EC;
    }

    .hero-btn-outline:hover {
        border-color: var(--mr-primary);
        color: var(--mr-primary);
    }

    /* -- illustration -- */

    .hero-visual {
        position: relative;
        width: 170px;
        height: 190px;
        flex-shrink: 0;
        margin: 0 auto;
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
        right: -8px;
        bottom: 6px;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: var(--mr-primary);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
        border: 4px solid #fff;
        box-shadow: 0 8px 16px rgba(51,118,242,0.30);
    }

    .hero-visual-check {
        position: absolute;
        top: -6px;
        right: 10px;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: #E9FBF0;
        border: 1px solid #CFF5DC;
        color: var(--mr-success);
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

    .hero-feature-icon.icon-blue { background: #EAF1FF; color: var(--mr-primary); }
    .hero-feature-icon.icon-purple { background: #F3EEFF; color: var(--mr-purple); }
    .hero-feature-icon.icon-green { background: #E9FBF0; color: var(--mr-success); }

    .hero-feature-title {
        font-size: 13.5px;
        font-weight: 700;
        color: var(--mr-text);
        margin-bottom: 2px;
    }

    .hero-feature-text {
        font-size: 12px;
        color: var(--mr-muted);
        line-height: 1.5;
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
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: .5px;
        font-weight: 700;
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
        background: linear-gradient(135deg, #3376F2, #7C4DFF);
        color: #fff;
        font-size: 28px;
        font-weight: 800;
        box-shadow: 0 10px 25px rgba(51,118,242,.2);
    }

    .mentor-name-large {
        color: var(--mr-text);
        font-size: 17px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .mentor-designation {
        color: var(--mr-muted);
        font-size: 12px;
        line-height: 1.5;
        margin-bottom: 14px;
    }

    .mentor-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 999px;
        background: #ECFDF3;
        color: var(--mr-success);
        border: 1px solid #CFF5DC;
        font-size: 10px;
        font-weight: 700;
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
        width: 32px;
        height: 32px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        background: #EEF4FF;
        color: var(--mr-primary);
        font-size: 12px;
    }

    .mentor-info-title {
        color: var(--mr-text);
        font-size: 11px;
        font-weight: 700;
        margin-bottom: 3px;
    }

    .mentor-info-text {
        color: var(--mr-muted);
        font-size: 11px;
        line-height: 1.5;
    }

    .mentor-profile-link {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        width: 100%;
        margin-top: 18px;
        padding: 10px;
        border-radius: 10px;
        background: #EEF4FF;
        border: 1px solid #DCE8FF;
        color: var(--mr-primary);
        text-decoration: none;
        font-size: 11px;
        font-weight: 700;
        transition: .2s ease;
    }

    .mentor-profile-link:hover {
        background: var(--mr-primary);
        color: #fff;
    }

    /* =========================
       FORM CARD
    ========================= */

    .request-form-card {
        background: #fff;
        border: 1px solid var(--mr-border);
        border-radius: 20px;
        box-shadow: var(--mr-shadow);
        overflow: hidden;
    }

    .form-header {
        padding: 22px;
        border-bottom: 1px solid var(--mr-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .form-header-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .form-header-icon {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: #EEF4FF;
        color: var(--mr-primary);
        font-size: 15px;
        flex-shrink: 0;
    }

    .form-header-title {
        color: var(--mr-text);
        font-size: 16px;
        font-weight: 700;
    }

    .form-header-subtitle {
        color: var(--mr-muted);
        font-size: 12px;
        margin-top: 3px;
    }

    .form-step {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 11px;
        border-radius: 999px;
        background: #EEF4FF;
        color: var(--mr-primary);
        font-size: 10px;
        font-weight: 700;
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
        background: linear-gradient(135deg, #3376F2, #7C4DFF);
        color: #fff;
        font-size: 10px;
        font-weight: 800;
    }

    .section-title {
        color: var(--mr-text);
        font-size: 13px;
        font-weight: 700;
    }

    .section-description {
        color: var(--mr-muted);
        font-size: 11px;
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
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 7px;
    }

    .optional-label {
        color: #9AA4B5;
        font-weight: 500;
        font-size: 10px;
    }

    .form-control {
        width: 100%;
        box-sizing: border-box;
        padding: 12px 13px;
        border: 1px solid var(--mr-border);
        border-radius: 10px;
        background: #FBFCFE;
        color: var(--mr-text);
        font-size: 12px;
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
        box-shadow: 0 0 0 3px rgba(51,118,242,.10);
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
        border-radius: 9px;
        background: #FBFCFE;
        color: #647086;
        font-size: 11px;
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
        box-shadow: 0 3px 10px rgba(51,118,242,.10);
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
        border-radius: 10px;
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
        font-size: 11px;
        font-weight: 700;
        margin-bottom: 3px;
    }

    .frequency-description {
        display: block;
        color: #929BAA;
        font-size: 9px;
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
        font-size: 10px;
        line-height: 1.5;
        margin-top: 5px;
    }

    .field-error {
        color: var(--mr-danger);
        font-size: 10px;
        margin-top: 5px;
    }

    .form-control.is-error {
        border-color: var(--mr-danger);
    }

    .request-alert {
        margin: 20px 25px 0;
        padding: 13px 15px;
        border-radius: 11px;
        background: #FEF2F2;
        border: 1px solid #FECACA;
        color: #B42318;
        font-size: 11px;
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
        font-size: 10px;
        line-height: 1.5;
        max-width: 300px;
    }

    .privacy-note i {
        color: var(--mr-success);
        margin-top: 2px;
    }

    .form-actions {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .btn-request,
    .btn-cancel {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        border-radius: 10px;
        text-decoration: none;
        cursor: pointer;
        transition: .2s ease;
    }

    .btn-request {
        padding: 12px 18px;
        border: 0;
        background: var(--mr-primary);
        color: #fff;
        font-size: 11px;
        font-weight: 700;
    }

    .btn-request:hover {
        background: var(--mr-primary-dark);
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 10px 20px rgba(51,118,242,.20);
    }

    .btn-cancel {
        padding: 11px 16px;
        border: 1px solid var(--mr-border);
        background: #fff;
        color: #647086;
        font-size: 11px;
        font-weight: 700;
    }

    .btn-cancel:hover {
        background: #F7F9FC;
        color: var(--mr-text);
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 1100px) {

        .hero-grid {
            grid-template-columns: 1fr;
        }

        .hero-visual {
            margin: 8px 0 0;
        }
    }

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

    @media (max-width: 768px) {

        .request-page-container {
            width: min(100% - 24px, 1320px);
        }

        .request-page {
            padding: 20px 0 40px;
        }

        .request-hero {
            padding: 28px 24px;
            border-radius: 19px;
        }

        .hero-title {
            font-size: 27px;
        }

        .hero-features {
            width: 100%;
        }
    }

    @media (max-width: 650px) {

        .request-form {
            padding: 19px;
        }

        .form-header {
            padding: 17px;
            flex-direction: column;
            align-items: flex-start;
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

    @media (max-width: 500px) {

        .hero-visual {
            display: none;
        }
    }
</style>


<div class="request-page">

    <div class="request-page-container">

        {{-- =====================================================
             HERO
        ====================================================== --}}
        <div class="request-hero">

            <div class="hero-grid">

                {{-- LEFT: copy + actions --}}
                <div class="hero-left">

                    <div class="hero-badge">
                        <i class="fa-solid fa-user-graduate"></i>
                        Student Mentorship
                    </div>

                    <h1 class="hero-title">
                        Start Your
                        <span>Mentorship Journey</span>
                    </h1>

                    <p class="hero-text">
                        Tell your mentor about your goals, current skills and
                        preferred schedule. A clear request helps your mentor
                        understand how they can support your growth.
                    </p>

                    <div class="hero-actions">

                        <a href="#request-form" class="hero-btn hero-btn-primary">
                            <i class="fa-solid fa-paper-plane"></i>
                            Send Request
                        </a>

                        <a href="{{ route('student.mentors.show', $mentor) }}" class="hero-btn hero-btn-outline">
                            <i class="fa-solid fa-user"></i>
                            View Mentor Profile
                        </a>

                    </div>

                </div>

                {{-- CENTER: illustration --}}
                <div class="hero-visual">
                    <div class="hero-visual-circle"></div>

                    <div class="hero-visual-card">
                        <div class="hero-visual-dot"></div>
                        <div class="hero-visual-line w-80"></div>
                        <div class="hero-visual-line w-60"></div>
                        <div class="hero-visual-line w-40"></div>
                    </div>

                    <div class="hero-visual-badge">
                        <i class="fa-solid fa-paper-plane"></i>
                    </div>

                    <div class="hero-visual-check">
                        <i class="fa-solid fa-check"></i>
                    </div>
                </div>

                {{-- RIGHT: feature list --}}
                <div class="hero-features">

                    <div class="hero-feature-item">
                        <div class="hero-feature-icon icon-blue">
                            <i class="fa-solid fa-bullseye"></i>
                        </div>
                        <div>
                            <div class="hero-feature-title">Personalized Guidance</div>
                            <div class="hero-feature-text">Based on your goals and interests</div>
                        </div>
                    </div>

                    <div class="hero-feature-item">
                        <div class="hero-feature-icon icon-purple">
                            <i class="fa-regular fa-calendar"></i>
                        </div>
                        <div>
                            <div class="hero-feature-title">Flexible Sessions</div>
                            <div class="hero-feature-text">Share your preferred days and frequency</div>
                        </div>
                    </div>

                    <div class="hero-feature-item">
                        <div class="hero-feature-icon icon-green">
                            <i class="fa-solid fa-comments"></i>
                        </div>
                        <div>
                            <div class="hero-feature-title">Meaningful Conversations</div>
                            <div class="hero-feature-text">Discuss challenges, questions and plans</div>
                        </div>
                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
             MAIN LAYOUT
        ====================================================== --}}
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

            <div class="request-form-card" id="request-form">

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

</div>

@endsection
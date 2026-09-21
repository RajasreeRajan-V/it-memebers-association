@extends('layouts.app')

@section('title', $profile->startup_name . ' - Startup Profile')

@section('content')

<style>
    :root {
        --sp-blue: #3376F2;
        --sp-blue-dark: #245fd0;
        --sp-blue-light: #EEF4FF;
        --sp-navy: #0F172A;
        --sp-text: #172033;
        --sp-muted: #64748B;
        --sp-border: #E8EDF5;
        --sp-bg: #F8FAFC;
        --sp-green: #047857;
        --sp-green-bg: #ECFDF5;
        --sp-orange: #C2410C;
        --sp-orange-bg: #FFF7ED;
        --sp-red: #DC2626;
        --sp-red-bg: #FEF2F2;
    }

    * {
        box-sizing: border-box;
    }

    .sp-show-page {
        min-height: 100vh;
        background: #F8FAFC;
        padding-bottom: 60px;
    }

    .sp-container {
        width: min(1150px, calc(100% - 32px));
        margin: 0 auto;
    }

    /* =========================================================
       TOP HEADER
    ========================================================= */

    .sp-topbar {
        padding: 25px 0 18px;
    }

    .sp-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #64748B;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        transition: .2s;
    }

    .sp-back:hover {
        color: var(--sp-blue);
    }

    .sp-back i {
        font-size: 11px;
    }

    .sp-page-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-top: 18px;
    }

    .sp-page-heading h1 {
        margin: 0;
        color: var(--sp-navy);
        font-size: 28px;
        font-weight: 800;
        letter-spacing: -.5px;
    }

    .sp-page-heading p {
        margin: 6px 0 0;
        color: var(--sp-muted);
        font-size: 13px;
    }

    .sp-actions-right {
        display: flex;
        align-items: center;
        gap: 9px;
        flex-shrink: 0;
    }

    .sp-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        min-height: 40px;
        padding: 0 15px;
        border-radius: 9px;
        text-decoration: none;
        border: 1px solid transparent;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: .2s;
    }

    .sp-btn-primary {
        background: var(--sp-blue);
        color: #fff;
        border-color: var(--sp-blue);
    }

    .sp-btn-primary:hover {
        background: var(--sp-blue-dark);
        color: #fff;
    }

    .sp-btn-danger {
        background: #fff;
        color: var(--sp-red);
        border-color: #FECACA;
    }

    .sp-btn-danger:hover {
        background: var(--sp-red-bg);
    }

    /* =========================================================
       ALERT
    ========================================================= */

    .sp-alert {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 13px 15px;
        border-radius: 11px;
        margin-bottom: 18px;
        font-size: 13px;
    }

    .sp-alert-success {
        background: var(--sp-green-bg);
        color: var(--sp-green);
        border: 1px solid #A7F3D0;
    }

    .sp-alert-error {
        background: var(--sp-red-bg);
        color: #B91C1C;
        border: 1px solid #FECACA;
    }

    /* =========================================================
       HERO / COVER
    ========================================================= */

    .sp-profile-card {
        background: #fff;
        border: 1px solid var(--sp-border);
        border-radius: 22px;
        overflow: hidden;
        box-shadow: 0 8px 35px rgba(15, 23, 42, .05);
    }

    .sp-cover {
        height: 275px;
        background:
            linear-gradient(
                135deg,
                #3376F2,
                #0F172A
            );
        background-size: cover;
        background-position: center;
        position: relative;
    }

    .sp-cover::after {
        content: "";
        position: absolute;
        inset: 0;
        background:
            linear-gradient(
                to bottom,
                rgba(15,23,42,.03),
                rgba(15,23,42,.35)
            );
    }

    .sp-profile-main {
        position: relative;
        padding: 0 32px 32px;
    }

    .sp-profile-header {
        display: flex;
        align-items: flex-end;
        gap: 20px;
        margin-top: -65px;
        position: relative;
        z-index: 2;
    }

    .sp-logo {
        width: 130px;
        height: 130px;
        flex: 0 0 130px;
        padding: 7px;
        border-radius: 25px;
        background: #fff;
        box-shadow: 0 12px 35px rgba(15,23,42,.16);
    }

    .sp-logo img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        border-radius: 19px;
        background: #F8FAFC;
    }

    .sp-logo-placeholder {
        width: 100%;
        height: 100%;
        border-radius: 19px;
        background: var(--sp-blue-light);
        color: var(--sp-blue);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 38px;
    }

    .sp-profile-title {
        padding-bottom: 8px;
        min-width: 0;
    }

    .sp-badges {
        display: flex;
        align-items: center;
        gap: 7px;
        flex-wrap: wrap;
        margin-bottom: 8px;
    }

    .sp-status {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 10px;
        border-radius: 999px;
        font-size: 10px;
        font-weight: 800;
    }

    .sp-approved {
        background: var(--sp-green-bg);
        color: var(--sp-green);
    }

    .sp-pending {
        background: var(--sp-orange-bg);
        color: var(--sp-orange);
    }

    .sp-rejected {
        background: var(--sp-red-bg);
        color: var(--sp-red);
    }

    .sp-draft {
        background: #F1F5F9;
        color: #475569;
    }

    .sp-published {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 10px;
        border-radius: 999px;
        background: var(--sp-green-bg);
        color: var(--sp-green);
        font-size: 10px;
        font-weight: 800;
    }

    .sp-profile-title h2 {
        margin: 0;
        color: var(--sp-navy);
        font-size: 30px;
        line-height: 1.15;
        font-weight: 800;
    }

    .sp-tagline {
        margin: 6px 0 0;
        color: var(--sp-muted);
        font-size: 14px;
        line-height: 1.6;
    }

    /* =========================================================
       BASIC META
    ========================================================= */

    .sp-meta-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 12px;
        margin-top: 28px;
    }

    .sp-meta-box {
        padding: 15px;
        background: #F8FAFC;
        border: 1px solid var(--sp-border);
        border-radius: 13px;
    }

    .sp-meta-box-label {
        display: flex;
        align-items: center;
        gap: 6px;
        color: #94A3B8;
        font-size: 10px;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .sp-meta-box-label i {
        color: var(--sp-blue);
    }

    .sp-meta-box-value {
        color: var(--sp-text);
        font-size: 13px;
        font-weight: 700;
        word-break: break-word;
    }

    /* =========================================================
       BODY GRID
    ========================================================= */

    .sp-body-grid {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 280px;
        gap: 20px;
        margin-top: 20px;
    }

    .sp-main-column {
        min-width: 0;
    }

    .sp-sidebar {
        display: grid;
        gap: 15px;
        align-content: start;
    }

    /* =========================================================
       CONTENT SECTIONS
    ========================================================= */

    .sp-section {
        background: #fff;
        border: 1px solid var(--sp-border);
        border-radius: 17px;
        padding: 23px;
        margin-bottom: 16px;
    }

    .sp-section:last-child {
        margin-bottom: 0;
    }

    .sp-section-header {
        display: flex;
        align-items: center;
        gap: 9px;
        margin-bottom: 13px;
    }

    .sp-section-header-icon {
        width: 31px;
        height: 31px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        background: var(--sp-blue-light);
        color: var(--sp-blue);
        font-size: 12px;
    }

    .sp-section h3 {
        margin: 0;
        color: var(--sp-navy);
        font-size: 16px;
        font-weight: 800;
    }

    .sp-section-text {
        margin: 0;
        color: #64748B;
        font-size: 13px;
        line-height: 1.85;
        white-space: pre-line;
    }

    /* =========================================================
       MISSION / VISION
    ========================================================= */

    .sp-two-column {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
    }

    .sp-info-box {
        background: #fff;
        border: 1px solid var(--sp-border);
        border-radius: 17px;
        padding: 22px;
        margin-bottom: 16px;
    }

    .sp-info-box h3 {
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 0 0 12px;
        color: var(--sp-navy);
        font-size: 15px;
        font-weight: 800;
    }

    .sp-info-box h3 i {
        color: var(--sp-blue);
    }

    .sp-info-box p {
        margin: 0;
        color: var(--sp-muted);
        font-size: 13px;
        line-height: 1.8;
        white-space: pre-line;
    }

    /* =========================================================
       TAGS
    ========================================================= */

    .sp-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .sp-tag {
        display: inline-flex;
        align-items: center;
        padding: 7px 11px;
        background: var(--sp-blue-light);
        color: var(--sp-blue);
        border-radius: 999px;
        font-size: 11px;
        font-weight: 700;
    }

    /* =========================================================
       FUNDING
    ========================================================= */

    .sp-funding-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 12px;
    }

    .sp-funding-box {
        padding: 16px;
        border-radius: 13px;
        background: #F8FAFC;
        border: 1px solid var(--sp-border);
    }

    .sp-funding-label {
        display: block;
        color: #94A3B8;
        font-size: 10px;
        margin-bottom: 5px;
    }

    .sp-funding-value {
        color: var(--sp-text);
        font-size: 14px;
        font-weight: 800;
    }

    /* =========================================================
       CONTACT
    ========================================================= */

    .sp-contact-list {
        display: grid;
        gap: 10px;
    }

    .sp-contact-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 11px 12px;
        background: #F8FAFC;
        border: 1px solid var(--sp-border);
        border-radius: 10px;
        color: var(--sp-text);
        text-decoration: none;
        font-size: 12px;
        transition: .2s;
    }

    .sp-contact-item:hover {
        border-color: #CBD9F5;
        background: var(--sp-blue-light);
        color: var(--sp-blue);
    }

    .sp-contact-icon {
        width: 29px;
        height: 29px;
        flex: 0 0 29px;
        border-radius: 8px;
        background: var(--sp-blue-light);
        color: var(--sp-blue);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
    }

    .sp-contact-item span {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    /* =========================================================
       SIDEBAR CARDS
    ========================================================= */

    .sp-side-card {
        background: #fff;
        border: 1px solid var(--sp-border);
        border-radius: 17px;
        padding: 20px;
    }

    .sp-side-card h3 {
        margin: 0 0 13px;
        color: var(--sp-navy);
        font-size: 15px;
        font-weight: 800;
    }

    .sp-side-row {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 11px 0;
        border-bottom: 1px solid #F1F5F9;
    }

    .sp-side-row:last-child {
        border-bottom: 0;
        padding-bottom: 0;
    }

    .sp-side-row:first-child {
        padding-top: 0;
    }

    .sp-side-row-icon {
        width: 30px;
        height: 30px;
        flex: 0 0 30px;
        border-radius: 8px;
        background: var(--sp-blue-light);
        color: var(--sp-blue);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
    }

    .sp-side-row-content span {
        display: block;
        color: #94A3B8;
        font-size: 9px;
        margin-bottom: 2px;
    }

    .sp-side-row-content strong {
        display: block;
        color: var(--sp-text);
        font-size: 11px;
        line-height: 1.5;
    }

    /* =========================================================
       REJECTION
    ========================================================= */

    .sp-rejection {
        padding: 16px;
        background: var(--sp-red-bg);
        border: 1px solid #FECACA;
        border-radius: 13px;
        margin-bottom: 16px;
    }

    .sp-rejection-title {
        display: flex;
        align-items: center;
        gap: 7px;
        color: var(--sp-red);
        font-size: 13px;
        font-weight: 800;
        margin-bottom: 7px;
    }

    .sp-rejection-text {
        margin: 0;
        color: #991B1B;
        font-size: 12px;
        line-height: 1.6;
        white-space: pre-line;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 1000px) {

        .sp-meta-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .sp-body-grid {
            grid-template-columns: 1fr;
        }

        .sp-sidebar {
            grid-template-columns: repeat(2, 1fr);
        }

    }

    @media (max-width: 768px) {

        .sp-container {
            width: calc(100% - 22px);
        }

        .sp-page-heading {
            flex-direction: column;
            align-items: flex-start;
        }

        .sp-actions-right {
            width: 100%;
        }

        .sp-actions-right .sp-btn {
            flex: 1;
        }

        .sp-cover {
            height: 190px;
        }

        .sp-profile-main {
            padding: 0 18px 24px;
        }

        .sp-profile-header {
            align-items: flex-start;
            flex-direction: column;
            gap: 12px;
            margin-top: -45px;
        }

        .sp-logo {
            width: 95px;
            height: 95px;
            flex-basis: 95px;
        }

        .sp-profile-title h2 {
            font-size: 24px;
        }

        .sp-meta-grid {
            grid-template-columns: 1fr 1fr;
        }

        .sp-two-column {
            grid-template-columns: 1fr;
        }

        .sp-funding-grid {
            grid-template-columns: 1fr;
        }

        .sp-sidebar {
            grid-template-columns: 1fr;
        }

    }

    @media (max-width: 480px) {

        .sp-meta-grid {
            grid-template-columns: 1fr;
        }

        .sp-actions-right {
            flex-direction: column;
        }

        .sp-actions-right .sp-btn {
            width: 100%;
        }

    }
</style>


<div class="sp-show-page">

    <div class="sp-container">

        {{-- =====================================================
             TOP BAR
        ====================================================== --}}
        <div class="sp-topbar">

            <a href="{{ route('employer.startup-profile.index') }}"
               class="sp-back">

                <i class="fa-solid fa-arrow-left"></i>

                Back to Startup Profiles

            </a>


            <div class="sp-page-heading">

                <div>

                    <h1>
                        Startup Profile
                    </h1>

                    <p>
                        View and manage your startup showcase.
                    </p>

                </div>


                {{-- =================================================
                     IMPORTANT:
                     BOTH ROUTES RECEIVE startupProfile PARAMETER
                ================================================== --}}
                <div class="sp-actions-right">

                    <a href="{{ route('employer.startup-profile.edit', ['startupProfile' => $profile->id]) }}"
                       class="sp-btn sp-btn-primary">

                        <i class="fa-regular fa-pen-to-square"></i>

                        Edit Profile

                    </a>


                    <form action="{{ route('employer.startup-profile.destroy', ['startupProfile' => $profile->id]) }}"
                          method="POST"
                          onsubmit="return confirm('Delete this startup profile? This action cannot be undone.');"
                          style="margin:0;">

                        @csrf

                        @method('DELETE')

                        <button type="submit"
                                class="sp-btn sp-btn-danger">

                            <i class="fa-regular fa-trash-can"></i>

                            Delete

                        </button>

                    </form>

                </div>

            </div>

        </div>


        {{-- =====================================================
             ALERTS
        ====================================================== --}}

        @if(session('success'))

            <div class="sp-alert sp-alert-success">

                <i class="fa-solid fa-circle-check"></i>

                <span>
                    {{ session('success') }}
                </span>

            </div>

        @endif


        @if(session('error'))

            <div class="sp-alert sp-alert-error">

                <i class="fa-solid fa-circle-exclamation"></i>

                <span>
                    {{ session('error') }}
                </span>

            </div>

        @endif


        {{-- =====================================================
             PROFILE MAIN CARD
        ====================================================== --}}

        <div class="sp-profile-card">

            {{-- Cover --}}
            @if($profile->cover_image)

                <div class="sp-cover"
                     style="background-image:
                        url('{{ asset('storage/' . $profile->cover_image) }}');">
                </div>

            @else

                <div class="sp-cover">
                </div>

            @endif


            <div class="sp-profile-main">

                {{-- =================================================
                     PROFILE HEADER
                ================================================== --}}
                <div class="sp-profile-header">

                    {{-- Logo --}}
                    <div class="sp-logo">

                        @if($profile->logo)

                            <img src="{{ asset('storage/' . $profile->logo) }}"
                                 alt="{{ $profile->startup_name }}">

                        @else

                            <div class="sp-logo-placeholder">

                                <i class="fa-solid fa-rocket"></i>

                            </div>

                        @endif

                    </div>


                    {{-- Title --}}
                    <div class="sp-profile-title">

                        <div class="sp-badges">

                            @php
                                $status = strtolower($profile->status ?? 'draft');
                            @endphp


                            @if($status === 'approved')

                                <span class="sp-status sp-approved">

                                    <i class="fa-solid fa-circle-check"></i>

                                    Approved

                                </span>

                            @elseif($status === 'pending')

                                <span class="sp-status sp-pending">

                                    <i class="fa-solid fa-clock"></i>

                                    Pending Approval

                                </span>

                            @elseif($status === 'rejected')

                                <span class="sp-status sp-rejected">

                                    <i class="fa-solid fa-circle-xmark"></i>

                                    Rejected

                                </span>

                            @else

                                <span class="sp-status sp-draft">

                                    <i class="fa-regular fa-file"></i>

                                    Draft

                                </span>

                            @endif


                            @if($profile->is_published)

                                <span class="sp-published">

                                    <i class="fa-solid fa-globe"></i>

                                    Published

                                </span>

                            @endif

                        </div>


                        <h2>
                            {{ $profile->startup_name }}
                        </h2>


                        @if($profile->tagline)

                            <p class="sp-tagline">
                                {{ $profile->tagline }}
                            </p>

                        @elseif($profile->short_description)

                            <p class="sp-tagline">
                                {{ $profile->short_description }}
                            </p>

                        @endif

                    </div>

                </div>


                {{-- =================================================
                     BASIC META
                ================================================== --}}
                <div class="sp-meta-grid">

                    @if($profile->category)

                        <div class="sp-meta-box">

                            <div class="sp-meta-box-label">

                                <i class="fa-solid fa-shapes"></i>

                                Category

                            </div>

                            <div class="sp-meta-box-value">

                                {{ $profile->category }}

                            </div>

                        </div>

                    @endif


                    @if($profile->industry)

                        <div class="sp-meta-box">

                            <div class="sp-meta-box-label">

                                <i class="fa-solid fa-layer-group"></i>

                                Industry

                            </div>

                            <div class="sp-meta-box-value">

                                {{ $profile->industry }}

                            </div>

                        </div>

                    @endif


                    @if($profile->startup_type)

                        <div class="sp-meta-box">

                            <div class="sp-meta-box-label">

                                <i class="fa-solid fa-building"></i>

                                Startup Type

                            </div>

                            <div class="sp-meta-box-value">

                                {{ $profile->startup_type }}

                            </div>

                        </div>

                    @endif


                    @if($profile->startup_stage)

                        <div class="sp-meta-box">

                            <div class="sp-meta-box-label">

                                <i class="fa-solid fa-chart-line"></i>

                                Startup Stage

                            </div>

                            <div class="sp-meta-box-value">

                                {{ $profile->startup_stage }}

                            </div>

                        </div>

                    @endif


                    @if($profile->founded_year)

                        <div class="sp-meta-box">

                            <div class="sp-meta-box-label">

                                <i class="fa-regular fa-calendar"></i>

                                Founded

                            </div>

                            <div class="sp-meta-box-value">

                                {{ $profile->founded_year }}

                            </div>

                        </div>

                    @endif


                    @if($profile->team_size)

                        <div class="sp-meta-box">

                            <div class="sp-meta-box-label">

                                <i class="fa-solid fa-users"></i>

                                Team Size

                            </div>

                            <div class="sp-meta-box-value">

                                {{ $profile->team_size }}

                            </div>

                        </div>

                    @endif


                    @if($profile->location)

                        <div class="sp-meta-box">

                            <div class="sp-meta-box-label">

                                <i class="fa-solid fa-location-dot"></i>

                                Location

                            </div>

                            <div class="sp-meta-box-value">

                                {{ $profile->location }}

                            </div>

                        </div>

                    @endif


                    @if($profile->website)

                        <div class="sp-meta-box">

                            <div class="sp-meta-box-label">

                                <i class="fa-solid fa-globe"></i>

                                Website

                            </div>

                            <div class="sp-meta-box-value">

                                Website Available

                            </div>

                        </div>

                    @endif

                </div>

            </div>

        </div>


        {{-- =====================================================
             BODY
        ====================================================== --}}

        <div class="sp-body-grid">

            {{-- =================================================
                 MAIN COLUMN
            ================================================== --}}
            <div class="sp-main-column">


                {{-- Rejection --}}
                @if($profile->status === 'rejected' && $profile->rejection_reason)

                    <div class="sp-rejection">

                        <div class="sp-rejection-title">

                            <i class="fa-solid fa-circle-exclamation"></i>

                            Admin Feedback

                        </div>

                        <p class="sp-rejection-text">
                            {{ $profile->rejection_reason }}
                        </p>

                    </div>

                @endif


                {{-- =================================================
                     SHORT DESCRIPTION
                ================================================== --}}
                @if($profile->short_description)

                    <section class="sp-section">

                        <div class="sp-section-header">

                            <div class="sp-section-header-icon">

                                <i class="fa-solid fa-align-left"></i>

                            </div>

                            <h3>
                                About the Startup
                            </h3>

                        </div>

                        <p class="sp-section-text">
                            {{ $profile->short_description }}
                        </p>

                    </section>

                @endif


                {{-- =================================================
                     ABOUT
                ================================================== --}}
                @if($profile->about)

                    <section class="sp-section">

                        <div class="sp-section-header">

                            <div class="sp-section-header-icon">

                                <i class="fa-regular fa-building"></i>

                            </div>

                            <h3>
                                About
                            </h3>

                        </div>

                        <p class="sp-section-text">
                            {{ $profile->about }}
                        </p>

                    </section>

                @endif


                {{-- =================================================
                     MISSION + VISION
                ================================================== --}}
                @if($profile->mission || $profile->vision)

                    <div class="sp-two-column">

                        @if($profile->mission)

                            <div class="sp-info-box">

                                <h3>

                                    <i class="fa-solid fa-bullseye"></i>

                                    Mission

                                </h3>

                                <p>
                                    {{ $profile->mission }}
                                </p>

                            </div>

                        @endif


                        @if($profile->vision)

                            <div class="sp-info-box">

                                <h3>

                                    <i class="fa-regular fa-eye"></i>

                                    Vision

                                </h3>

                                <p>
                                    {{ $profile->vision }}
                                </p>

                            </div>

                        @endif

                    </div>

                @endif


                {{-- =================================================
                     PRODUCTS / SERVICES
                ================================================== --}}
                @if($profile->products_services)

                    <section class="sp-section">

                        <div class="sp-section-header">

                            <div class="sp-section-header-icon">

                                <i class="fa-solid fa-cubes"></i>

                            </div>

                            <h3>
                                Products & Services
                            </h3>

                        </div>

                        <p class="sp-section-text">
                            {{ $profile->products_services }}
                        </p>

                    </section>

                @endif


                {{-- =================================================
                     TECHNOLOGIES
                ================================================== --}}
                @if($profile->technologies)

                    <section class="sp-section">

                        <div class="sp-section-header">

                            <div class="sp-section-header-icon">

                                <i class="fa-solid fa-code"></i>

                            </div>

                            <h3>
                                Technologies
                            </h3>

                        </div>

                        <p class="sp-section-text">
                            {{ $profile->technologies }}
                        </p>

                    </section>

                @endif


                {{-- =================================================
                     LOOKING FOR
                ================================================== --}}
                @php
                    $lookingFor = $profile->looking_for;

                    if (is_string($lookingFor)) {
                        $lookingFor = json_decode($lookingFor, true);
                    }

                    $lookingFor = is_array($lookingFor)
                        ? $lookingFor
                        : [];

                    $lookingForLabels = [
                        'employee' => 'Employees',
                        'freelancer' => 'Freelancers',
                        'investor' => 'Investors',
                        'mentor' => 'Mentors',
                        'student' => 'Students',
                        'business_partner' => 'Business Partners',
                    ];
                @endphp


                @if(count($lookingFor))

                    <section class="sp-section">

                        <div class="sp-section-header">

                            <div class="sp-section-header-icon">

                                <i class="fa-solid fa-users"></i>

                            </div>

                            <h3>
                                Looking For
                            </h3>

                        </div>


                        <div class="sp-tags">

                            @foreach($lookingFor as $item)

                                <span class="sp-tag">

                                    {{ $lookingForLabels[$item] ?? $item }}

                                </span>

                            @endforeach

                        </div>

                    </section>

                @endif


                {{-- =================================================
                     OPPORTUNITIES
                ================================================== --}}
                @php
                    $opportunities = $profile->opportunities;

                    if (is_string($opportunities)) {
                        $opportunities = json_decode($opportunities, true);
                    }

                    $opportunities = is_array($opportunities)
                        ? $opportunities
                        : [];

                    $opportunityLabels = [
                        'jobs' => 'Jobs',
                        'internships' => 'Internships',
                        'freelance_projects' => 'Freelance Projects',
                        'student_projects' => 'Student Projects',
                        'mentorship' => 'Mentorship',
                        'business_partnerships' => 'Business Partnerships',
                        'investment' => 'Investment',
                    ];
                @endphp


                @if(count($opportunities))

                    <section class="sp-section">

                        <div class="sp-section-header">

                            <div class="sp-section-header-icon">

                                <i class="fa-solid fa-bullhorn"></i>

                            </div>

                            <h3>
                                Opportunities
                            </h3>

                        </div>


                        <div class="sp-tags">

                            @foreach($opportunities as $item)

                                <span class="sp-tag">

                                    {{ $opportunityLabels[$item] ?? $item }}

                                </span>

                            @endforeach

                        </div>

                    </section>

                @endif


                {{-- =================================================
                     FUNDING
                ================================================== --}}
                @if(
                    $profile->funding_stage ||
                    $profile->currently_raising ||
                    $profile->funding_requirement
                )

                    <section class="sp-section">

                        <div class="sp-section-header">

                            <div class="sp-section-header-icon">

                                <i class="fa-solid fa-chart-pie"></i>

                            </div>

                            <h3>
                                Funding
                            </h3>

                        </div>


                        <div class="sp-funding-grid">

                            <div class="sp-funding-box">

                                <span class="sp-funding-label">
                                    Funding Stage
                                </span>

                                <strong class="sp-funding-value">

                                    {{ $profile->funding_stage ?: 'Not specified' }}

                                </strong>

                            </div>


                            <div class="sp-funding-box">

                                <span class="sp-funding-label">
                                    Currently Raising
                                </span>

                                <strong class="sp-funding-value">

                                    @if($profile->currently_raising === 'yes')

                                        Yes

                                    @elseif($profile->currently_raising === 'no')

                                        No

                                    @else

                                        Not specified

                                    @endif

                                </strong>

                            </div>


                            @if($profile->funding_requirement)

                                <div class="sp-funding-box">

                                    <span class="sp-funding-label">
                                        Funding Requirement
                                    </span>

                                    <strong class="sp-funding-value">

                                        ₹{{ number_format((float) $profile->funding_requirement, 2) }}

                                    </strong>

                                </div>

                            @endif

                        </div>

                    </section>

                @endif

            </div>


            {{-- =================================================
                 SIDEBAR
            ================================================== --}}
            <aside class="sp-sidebar">


                {{-- Contact --}}
                @if(
                    $profile->website ||
                    $profile->linkedin ||
                    $profile->startup_email ||
                    $profile->startup_phone
                )

                    <div class="sp-side-card">

                        <h3>
                            Contact & Links
                        </h3>


                        <div class="sp-contact-list">

                            @if($profile->website)

                                <a href="{{ $profile->website }}"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   class="sp-contact-item">

                                    <div class="sp-contact-icon">

                                        <i class="fa-solid fa-globe"></i>

                                    </div>

                                    <span>
                                        Visit Website
                                    </span>

                                </a>

                            @endif


                            @if($profile->linkedin)

                                <a href="{{ $profile->linkedin }}"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   class="sp-contact-item">

                                    <div class="sp-contact-icon">

                                        <i class="fa-brands fa-linkedin-in"></i>

                                    </div>

                                    <span>
                                        LinkedIn
                                    </span>

                                </a>

                            @endif


                            @if($profile->startup_email)

                                <a href="mailto:{{ $profile->startup_email }}"
                                   class="sp-contact-item">

                                    <div class="sp-contact-icon">

                                        <i class="fa-regular fa-envelope"></i>

                                    </div>

                                    <span>
                                        {{ $profile->startup_email }}
                                    </span>

                                </a>

                            @endif


                            @if($profile->startup_phone)

                                <a href="tel:{{ $profile->startup_phone }}"
                                   class="sp-contact-item">

                                    <div class="sp-contact-icon">

                                        <i class="fa-solid fa-phone"></i>

                                    </div>

                                    <span>
                                        {{ $profile->startup_phone }}
                                    </span>

                                </a>

                            @endif

                        </div>

                    </div>

                @endif


                {{-- Startup information --}}
                <div class="sp-side-card">

                    <h3>
                        Startup Information
                    </h3>


                    @if($profile->startup_name)

                        <div class="sp-side-row">

                            <div class="sp-side-row-icon">

                                <i class="fa-solid fa-building"></i>

                            </div>

                            <div class="sp-side-row-content">

                                <span>
                                    Startup
                                </span>

                                <strong>
                                    {{ $profile->startup_name }}
                                </strong>

                            </div>

                        </div>

                    @endif


                    @if($profile->founded_year)

                        <div class="sp-side-row">

                            <div class="sp-side-row-icon">

                                <i class="fa-regular fa-calendar"></i>

                            </div>

                            <div class="sp-side-row-content">

                                <span>
                                    Founded
                                </span>

                                <strong>
                                    {{ $profile->founded_year }}
                                </strong>

                            </div>

                        </div>

                    @endif


                    @if($profile->team_size)

                        <div class="sp-side-row">

                            <div class="sp-side-row-icon">

                                <i class="fa-solid fa-users"></i>

                            </div>

                            <div class="sp-side-row-content">

                                <span>
                                    Team Size
                                </span>

                                <strong>
                                    {{ $profile->team_size }}
                                </strong>

                            </div>

                        </div>

                    @endif


                    @if($profile->location)

                        <div class="sp-side-row">

                            <div class="sp-side-row-icon">

                                <i class="fa-solid fa-location-dot"></i>

                            </div>

                            <div class="sp-side-row-content">

                                <span>
                                    Location
                                </span>

                                <strong>
                                    {{ $profile->location }}
                                </strong>

                            </div>

                        </div>

                    @endif

                </div>


                {{-- Status --}}
                <div class="sp-side-card">

                    <h3>
                        Profile Status
                    </h3>


                    <div class="sp-side-row">

                        <div class="sp-side-row-icon">

                            <i class="fa-solid fa-circle-check"></i>

                        </div>

                        <div class="sp-side-row-content">

                            <span>
                                Approval Status
                            </span>

                            <strong>

                                @if($profile->status === 'approved')

                                    Approved

                                @elseif($profile->status === 'pending')

                                    Pending Approval

                                @elseif($profile->status === 'rejected')

                                    Rejected

                                @else

                                    Draft

                                @endif

                            </strong>

                        </div>

                    </div>


                    <div class="sp-side-row">

                        <div class="sp-side-row-icon">

                            <i class="fa-solid fa-globe"></i>

                        </div>

                        <div class="sp-side-row-content">

                            <span>
                                Visibility
                            </span>

                            <strong>

                                @if($profile->is_published)

                                    Published

                                @else

                                    Unpublished

                                @endif

                            </strong>

                        </div>

                    </div>

                </div>


                {{-- Dates --}}
                <div class="sp-side-card">

                    <h3>
                        Profile Activity
                    </h3>


                    @if($profile->created_at)

                        <div class="sp-side-row">

                            <div class="sp-side-row-icon">

                                <i class="fa-regular fa-calendar-plus"></i>

                            </div>

                            <div class="sp-side-row-content">

                                <span>
                                    Created
                                </span>

                                <strong>
                                    {{ $profile->created_at->format('d M Y') }}
                                </strong>

                            </div>

                        </div>

                    @endif


                    @if($profile->updated_at)

                        <div class="sp-side-row">

                            <div class="sp-side-row-icon">

                                <i class="fa-regular fa-clock"></i>

                            </div>

                            <div class="sp-side-row-content">

                                <span>
                                    Last Updated
                                </span>

                                <strong>
                                    {{ $profile->updated_at->format('d M Y') }}
                                </strong>

                            </div>

                        </div>

                    @endif

                </div>

            </aside>

        </div>

    </div>

</div>

@endsection
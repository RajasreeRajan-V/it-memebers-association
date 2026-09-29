@extends('layouts.app')

@section('title', $startupProfile->startup_name . ' - Internships')

@section('content')

<style>
    :root {
        --si-blue: #3376F2;
        --si-blue-dark: #245fd0;
        --si-blue-light: #eef4ff;
        --si-navy: #0f172a;
        --si-text: #172033;
        --si-muted: #64748b;
        --si-light-muted: #94a3b8;
        --si-border: #e2e8f0;
        --si-bg: #f8fafc;
        --si-green: #059669;
        --si-green-bg: #ecfdf5;
        --si-orange: #ea580c;
        --si-orange-bg: #fff7ed;
    }

    * {
        box-sizing: border-box;
    }

    .startup-internships-page {
        min-height: 100vh;
        background: var(--si-bg);
        color: var(--si-text);
        padding: 30px 24px 55px;
    }

    .startup-internships-container {
        max-width: 1180px;
        margin: 0 auto;
    }

    /* =========================================================
       TOP HEADER
    ========================================================= */

    .startup-internships-header {
        position: relative;
        overflow: hidden;
        background: linear-gradient(
            135deg,
            #f4f7ff 0%,
            #ffffff 70%
        );
        border: 1px solid #e1e8f3;
        border-radius: 20px;
        padding: 25px;
        margin-bottom: 20px;
    }

    .startup-internships-header::before {
        content: "";
        position: absolute;
        width: 220px;
        height: 220px;
        right: -100px;
        top: -100px;
        border-radius: 50%;
        background: rgba(51, 118, 242, .055);
    }

    .startup-internships-header::after {
        content: "";
        position: absolute;
        width: 150px;
        height: 150px;
        right: 90px;
        bottom: -105px;
        border-radius: 50%;
        background: rgba(51, 118, 242, .035);
    }

    .startup-header-content {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 25px;
    }

    .startup-header-left {
        display: flex;
        align-items: center;
        gap: 16px;
        min-width: 0;
    }

    .startup-header-logo {
        width: 66px;
        height: 66px;
        flex: 0 0 66px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        background: #eef4ff;
        border: 1px solid #dbeafe;
        color: var(--si-blue);
        font-size: 25px;
    }

    .startup-header-logo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .startup-header-info {
        min-width: 0;
    }

    .startup-header-kicker {
        margin: 0 0 5px;
        color: var(--si-blue);
        font-size: 9px;
        font-weight: 800;
        letter-spacing: .08em;
        text-transform: uppercase;
    }

    .startup-header-title {
        margin: 0;
        color: var(--si-navy);
        font-size: 24px;
        line-height: 1.25;
        font-weight: 800;
        letter-spacing: -.025em;
        word-break: break-word;
    }

    .startup-header-description {
        margin: 6px 0 0;
        color: var(--si-muted);
        font-size: 11px;
        line-height: 1.55;
    }

    .startup-header-actions {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-shrink: 0;
    }

    .startup-header-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        min-height: 37px;
        padding: 0 14px;
        border-radius: 10px;
        text-decoration: none;
        font-size: 10px;
        font-weight: 800;
        transition: .18s ease;
        white-space: nowrap;
    }

    .startup-header-primary {
        color: #fff;
        background: var(--si-blue);
        border: 1px solid var(--si-blue);
        box-shadow: 0 5px 15px rgba(51, 118, 242, .13);
    }

    .startup-header-primary:hover {
        color: #fff;
        background: var(--si-blue-dark);
        border-color: var(--si-blue-dark);
        transform: translateY(-1px);
    }

    .startup-header-secondary {
        color: var(--si-muted);
        background: #fff;
        border: 1px solid var(--si-border);
    }

    .startup-header-secondary:hover {
        color: var(--si-blue);
        border-color: #bfdbfe;
        background: #f8fbff;
    }

    /* =========================================================
       BREADCRUMB
    ========================================================= */

    .startup-breadcrumb {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 7px;
        margin-bottom: 17px;
        font-size: 10px;
    }

    .startup-breadcrumb a {
        color: var(--si-blue);
        text-decoration: none;
        font-weight: 700;
    }

    .startup-breadcrumb a:hover {
        color: var(--si-blue-dark);
    }

    .startup-breadcrumb i {
        color: #cbd5e1;
        font-size: 9px;
    }

    .startup-breadcrumb-current {
        color: var(--si-muted);
        font-weight: 600;
    }

    /* =========================================================
       SUMMARY
    ========================================================= */

    .startup-summary-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
        margin-bottom: 20px;
    }

    .startup-summary-card {
        background: #fff;
        border: 1px solid var(--si-border);
        border-radius: 14px;
        padding: 15px;
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .startup-summary-icon {
        width: 38px;
        height: 38px;
        flex: 0 0 38px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
    }

    .startup-summary-blue .startup-summary-icon {
        background: var(--si-blue-light);
        color: var(--si-blue);
    }

    .startup-summary-green .startup-summary-icon {
        background: var(--si-green-bg);
        color: var(--si-green);
    }

    .startup-summary-orange .startup-summary-icon {
        background: var(--si-orange-bg);
        color: var(--si-orange);
    }

    .startup-summary-number {
        display: block;
        color: var(--si-navy);
        font-size: 17px;
        line-height: 1.1;
        font-weight: 800;
    }

    .startup-summary-label {
        display: block;
        margin-top: 3px;
        color: var(--si-light-muted);
        font-size: 9px;
        font-weight: 600;
    }

    /* =========================================================
       SECTION HEADER
    ========================================================= */

    .internships-section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 13px;
    }

    .internships-section-title-wrap {
        min-width: 0;
    }

    .internships-section-title {
        margin: 0;
        color: var(--si-navy);
        font-size: 19px;
        line-height: 1.3;
        font-weight: 800;
        letter-spacing: -.015em;
    }

    .internships-section-subtitle {
        margin: 4px 0 0;
        color: var(--si-light-muted);
        font-size: 10px;
    }

    .internships-count {
        min-width: 32px;
        height: 28px;
        padding: 0 9px;
        border-radius: 999px;
        background: var(--si-blue-light);
        border: 1px solid #dbeafe;
        color: var(--si-blue);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        font-weight: 800;
    }

    /* =========================================================
       INTERNSHIP CARD
    ========================================================= */

    .startup-internship-card {
        background: #fff;
        border: 1px solid #dfe6ef;
        border-radius: 16px;
        margin-bottom: 12px;
        overflow: hidden;
        transition: .2s ease;
    }

    .startup-internship-card:hover {
        border-color: #cbd9ee;
        box-shadow: 0 8px 24px rgba(15, 23, 42, .045);
    }

    .startup-internship-card-inner {
        padding: 17px 18px;
    }

    .internship-card-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 18px;
    }

    .internship-card-main {
        min-width: 0;
        flex: 1;
    }

    .internship-title-row {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 7px;
        margin-bottom: 8px;
    }

    .internship-title {
        margin: 0;
        color: var(--si-navy);
        font-size: 16px;
        line-height: 1.35;
        font-weight: 800;
        word-break: break-word;
    }

    .startup-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 5px 8px;
        border-radius: 999px;
        background: var(--si-blue-light);
        border: 1px solid #dbeafe;
        color: var(--si-blue);
        font-size: 8px;
        line-height: 1;
        font-weight: 800;
        white-space: nowrap;
    }

    .startup-badge i {
        font-size: 8px;
    }

    .internship-meta {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 11px;
        color: var(--si-muted);
        font-size: 10px;
    }

    .internship-meta-item {
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .internship-meta-item i {
        color: #94a3b8;
        font-size: 10px;
    }

    .internship-description {
        margin: 12px 0 0;
        color: var(--si-muted);
        font-size: 11px;
        line-height: 1.7;
    }

    /* =========================================================
       STATUS
    ========================================================= */

    .internship-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 999px;
        font-size: 9px;
        line-height: 1;
        font-weight: 800;
        white-space: nowrap;
    }

    .internship-status-active {
        color: #047857;
        background: #ecfdf5;
    }

    .internship-status-inactive {
        color: #64748b;
        background: #f1f5f9;
    }

    .internship-status-closed {
        color: #b91c1c;
        background: #fef2f2;
    }

    .internship-status-pending {
        color: #c2410c;
        background: #fff7ed;
    }

    .internship-status-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
    }

    /* =========================================================
       DETAILS
    ========================================================= */

    .internship-details {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 8px;
        margin-top: 15px;
        padding-top: 13px;
        border-top: 1px solid #f1f5f9;
    }

    .internship-detail {
        background: #f8fafc;
        border-radius: 10px;
        padding: 9px 10px;
    }

    .internship-detail-label {
        display: block;
        margin-bottom: 3px;
        color: #94a3b8;
        font-size: 8px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .03em;
    }

    .internship-detail-value {
        display: block;
        color: var(--si-text);
        font-size: 10px;
        line-height: 1.4;
        font-weight: 700;
        word-break: break-word;
    }

    /* =========================================================
       CARD FOOTER
    ========================================================= */

    .internship-card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-top: 13px;
    }

    .internship-updated {
        color: #94a3b8;
        font-size: 9px;
    }

    .internship-card-actions {
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .internship-action {
        min-height: 30px;
        padding: 0 11px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        text-decoration: none;
        font-size: 9px;
        font-weight: 700;
        transition: .18s ease;
    }

    .internship-action-primary {
        color: var(--si-blue);
        background: var(--si-blue-light);
        border: 1px solid #dbeafe;
    }

    .internship-action-primary:hover {
        color: #1d4ed8;
        background: #dbeafe;
    }

    /* =========================================================
       EMPTY STATE
    ========================================================= */

    .startup-internships-empty {
        background: #fff;
        border: 1px solid var(--si-border);
        border-radius: 17px;
        padding: 55px 25px;
        text-align: center;
    }

    .startup-internships-empty-icon {
        width: 60px;
        height: 60px;
        margin: 0 auto 15px;
        border-radius: 16px;
        background: var(--si-blue-light);
        color: var(--si-blue);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }

    .startup-internships-empty h3 {
        margin: 0 0 7px;
        color: var(--si-navy);
        font-size: 18px;
        font-weight: 800;
    }

    .startup-internships-empty p {
        max-width: 450px;
        margin: 0 auto 19px;
        color: var(--si-light-muted);
        font-size: 11px;
        line-height: 1.65;
    }

    .startup-empty-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        min-height: 35px;
        padding: 0 15px;
        border-radius: 9px;
        background: var(--si-blue);
        color: #fff;
        text-decoration: none;
        font-size: 10px;
        font-weight: 800;
    }

    .startup-empty-btn:hover {
        color: #fff;
        background: var(--si-blue-dark);
    }

    /* =========================================================
       PAGINATION
    ========================================================= */

    .startup-internships-pagination {
        margin-top: 18px;
        display: flex;
        justify-content: center;
    }

    .startup-internships-pagination nav {
        width: 100%;
    }

    .startup-internships-pagination svg {
        width: 15px;
        height: 15px;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 900px) {

        .startup-header-content {
            flex-direction: column;
            align-items: flex-start;
        }

        .startup-header-actions {
            width: 100%;
        }

        .startup-header-btn {
            flex: 1;
        }

        .internship-details {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 700px) {

        .startup-internships-page {
            padding-left: 16px;
            padding-right: 16px;
        }

        .startup-summary-grid {
            grid-template-columns: 1fr;
        }

        .startup-header-left {
            align-items: flex-start;
        }

        .startup-header-logo {
            width: 55px;
            height: 55px;
            flex-basis: 55px;
            border-radius: 13px;
            font-size: 21px;
        }

        .startup-header-title {
            font-size: 20px;
        }

        .startup-header-description {
            max-width: 100%;
        }

        .internship-card-top {
            flex-direction: column;
            gap: 10px;
        }

        .internship-status {
            align-self: flex-start;
        }

        .internship-card-footer {
            align-items: flex-start;
            flex-direction: column;
        }

        .internship-card-actions {
            width: 100%;
        }

        .internship-action {
            width: 100%;
        }
    }

    @media (max-width: 500px) {

        .startup-internships-header {
            padding: 18px;
        }

        .startup-header-actions {
            flex-direction: column;
        }

        .startup-header-btn {
            width: 100%;
            flex: none;
        }

        .internship-details {
            grid-template-columns: 1fr;
        }

        .internship-title {
            font-size: 15px;
        }

        .internship-meta {
            gap: 8px 11px;
        }
    }
</style>


<div class="startup-internships-page">

    <div class="startup-internships-container">


        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <section class="startup-internships-header">

            <div class="startup-header-content">


                {{-- LEFT --}}

                <div class="startup-header-left">


                    {{-- LOGO --}}

                    <div class="startup-header-logo">

                        @if($startupProfile->logo)

                            <img
                                src="{{ asset('storage/' . $startupProfile->logo) }}"
                                alt="{{ $startupProfile->startup_name }}"
                            >

                        @else

                            <i class="bi bi-rocket-takeoff-fill"></i>

                        @endif

                    </div>


                    {{-- INFO --}}

                    <div class="startup-header-info">

                        <p class="startup-header-kicker">
                            Startup Internship Opportunities
                        </p>

                        <h1 class="startup-header-title">
                            {{ $startupProfile->startup_name }}
                        </h1>

                        @if($startupProfile->tagline)

                            <p class="startup-header-description">
                                {{ $startupProfile->tagline }}
                            </p>

                        @else

                            <p class="startup-header-description">
                                Manage internships connected to this startup profile.
                            </p>

                        @endif

                    </div>

                </div>


                {{-- ACTIONS --}}

                <div class="startup-header-actions">


                    <a
                        href="{{ route('employer.startup-profile.index') }}"
                        class="startup-header-btn startup-header-secondary"
                    >

                        <i class="bi bi-arrow-left"></i>

                        Startup Profiles

                    </a>


                    <a
                        href="{{ route('employer.internships.create', [
                            'startup_profile_id' => $startupProfile->id
                        ]) }}"
                        class="startup-header-btn startup-header-primary"
                    >

                        <i class="bi bi-plus-lg"></i>

                        Create Internship

                    </a>

                </div>

            </div>

        </section>


        {{-- =====================================================
             BREADCRUMB
        ====================================================== --}}

        <div class="startup-breadcrumb">

            <a href="{{ route('employer.startup-profile.index') }}">
                Startup Profiles
            </a>

            <i class="bi bi-chevron-right"></i>

            <span class="startup-breadcrumb-current">
                {{ $startupProfile->startup_name }}
            </span>

            <i class="bi bi-chevron-right"></i>

            <span class="startup-breadcrumb-current">
                Internships
            </span>

        </div>


        {{-- =====================================================
             SUMMARY
        ====================================================== --}}

        @php

            $totalInternships = method_exists($internships, 'total')
                ? $internships->total()
                : $internships->count();

            $activeInternships = $internships->filter(function ($internship) {
                return strtolower((string) $internship->status) === 'active';
            })->count();

            $currentPageCount = $internships->count();

        @endphp


        <div class="startup-summary-grid">


            {{-- TOTAL --}}

            <div class="startup-summary-card startup-summary-blue">

                <span class="startup-summary-icon">

                    <i class="bi bi-mortarboard"></i>

                </span>

                <div>

                    <span class="startup-summary-number">
                        {{ $totalInternships }}
                    </span>

                    <span class="startup-summary-label">
                        Total Internships
                    </span>

                </div>

            </div>


            {{-- ACTIVE --}}

            <div class="startup-summary-card startup-summary-green">

                <span class="startup-summary-icon">

                    <i class="bi bi-check-circle"></i>

                </span>

                <div>

                    <span class="startup-summary-number">
                        {{ $activeInternships }}
                    </span>

                    <span class="startup-summary-label">
                        Active on This Page
                    </span>

                </div>

            </div>


            {{-- CURRENT PAGE --}}

            <div class="startup-summary-card startup-summary-orange">

                <span class="startup-summary-icon">

                    <i class="bi bi-list-ul"></i>

                </span>

                <div>

                    <span class="startup-summary-number">
                        {{ $currentPageCount }}
                    </span>

                    <span class="startup-summary-label">
                        Current Page
                    </span>

                </div>

            </div>

        </div>


        {{-- =====================================================
             SECTION HEADER
        ====================================================== --}}

        <div class="internships-section-header">

            <div class="internships-section-title-wrap">

                <h2 class="internships-section-title">
                    Internships
                </h2>

                <p class="internships-section-subtitle">
                    Internships created specifically for
                    {{ $startupProfile->startup_name }}
                </p>

            </div>


            <span class="internships-count">
                {{ $totalInternships }}
            </span>

        </div>


        {{-- =====================================================
             INTERNSHIP LIST
        ====================================================== --}}

        @forelse($internships as $internship)

            @php

                $internshipStatus =
                    strtolower((string) ($internship->status ?? 'active'));

                $statusClass = match ($internshipStatus) {

                    'active' => 'internship-status-active',

                    'closed' => 'internship-status-closed',

                    'pending' => 'internship-status-pending',

                    default => 'internship-status-inactive',

                };

                $statusLabel = ucfirst(
                    $internshipStatus ?: 'active'
                );

                $locationParts = array_filter([
                    $internship->city,
                    $internship->district,
                    $internship->state,
                    $internship->country,
                ]);

                $location = implode(', ', $locationParts);

                $internshipType = str_replace(
                    '_',
                    ' ',
                    (string) $internship->internship_type
                );

                $workMode = str_replace(
                    '_',
                    ' ',
                    (string) $internship->work_mode
                );

                $qualification = trim(
                    (string) $internship->qualification
                );

                $duration = trim(
                    (string) $internship->duration
                );

                $stipend = trim(
                    (string) $internship->stipend
                );

                $description = trim(
                    (string) $internship->description
                );

            @endphp


            <article class="startup-internship-card">

                <div class="startup-internship-card-inner">


                    {{-- =================================================
                         TOP
                    ================================================== --}}

                    <div class="internship-card-top">


                        <div class="internship-card-main">


                            <div class="internship-title-row">

                                <h3 class="internship-title">

                                    {{ $internship->title }}

                                </h3>


                                <span class="startup-badge">

                                    <i class="bi bi-rocket-takeoff"></i>

                                    Startup Internship

                                </span>

                            </div>


                            {{-- META --}}

                            <div class="internship-meta">


                                @if($internshipType !== '')

                                    <span class="internship-meta-item">

                                        <i class="bi bi-briefcase"></i>

                                        {{ ucwords($internshipType) }}

                                    </span>

                                @endif


                                @if($workMode !== '')

                                    <span class="internship-meta-item">

                                        <i class="bi bi-laptop"></i>

                                        {{ ucwords($workMode) }}

                                    </span>

                                @endif


                                @if($location !== '')

                                    <span class="internship-meta-item">

                                        <i class="bi bi-geo-alt"></i>

                                        {{ $location }}

                                    </span>

                                @endif


                                @if($internship->positions)

                                    <span class="internship-meta-item">

                                        <i class="bi bi-people"></i>

                                        {{ $internship->positions }}
                                        {{ $internship->positions == 1 ? 'Position' : 'Positions' }}

                                    </span>

                                @endif

                            </div>


                            {{-- DESCRIPTION --}}

                            @if($description !== '')

                                <p class="internship-description">

                                    {{ \Illuminate\Support\Str::limit(
                                        $description,
                                        300
                                    ) }}

                                </p>

                            @endif

                        </div>


                        {{-- STATUS --}}

                        <span class="internship-status {{ $statusClass }}">

                            <span class="internship-status-dot"></span>

                            {{ $statusLabel }}

                        </span>

                    </div>


                    {{-- =================================================
                         DETAILS
                    ================================================== --}}

                    <div class="internship-details">


                        {{-- DURATION --}}

                        <div class="internship-detail">

                            <span class="internship-detail-label">
                                Duration
                            </span>

                            <span class="internship-detail-value">

                                {{ $duration !== '' ? $duration : 'Not specified' }}

                            </span>

                        </div>


                        {{-- STIPEND --}}

                        <div class="internship-detail">

                            <span class="internship-detail-label">
                                Stipend
                            </span>

                            <span class="internship-detail-value">

                                {{ $stipend !== '' ? $stipend : 'Not specified' }}

                            </span>

                        </div>


                        {{-- QUALIFICATION --}}

                        <div class="internship-detail">

                            <span class="internship-detail-label">
                                Qualification
                            </span>

                            <span class="internship-detail-value">

                                {{ $qualification !== '' ? \Illuminate\Support\Str::limit($qualification, 55) : 'Not specified' }}

                            </span>

                        </div>


                        {{-- START DATE --}}

                        <div class="internship-detail">

                            <span class="internship-detail-label">
                                Start Date
                            </span>

                            <span class="internship-detail-value">

                                @if($internship->start_date)

                                    {{ $internship->start_date->format('d M Y') }}

                                @else

                                    Not specified

                                @endif

                            </span>

                        </div>

                    </div>


                    {{-- =================================================
                         FOOTER
                    ================================================== --}}

                    <div class="internship-card-footer">


                        <span class="internship-updated">

                            @if($internship->updated_at)

                                Updated
                                {{ $internship->updated_at->diffForHumans() }}

                            @else

                                Recently created

                            @endif

                        </span>


                        <div class="internship-card-actions">


                            <a
                                href="{{ route('employer.internships.create', [
                                    'startup_profile_id' => $startupProfile->id
                                ]) }}"
                                class="internship-action internship-action-primary"
                            >

                                <i class="bi bi-plus-lg"></i>

                                Create Another

                            </a>

                        </div>

                    </div>

                </div>

            </article>

        @empty


            {{-- =================================================
                 EMPTY STATE
            ================================================== --}}

            <div class="startup-internships-empty">

                <div class="startup-internships-empty-icon">

                    <i class="bi bi-mortarboard"></i>

                </div>


                <h3>
                    No Internships Yet
                </h3>


                <p>

                    There are currently no internships connected to
                    <strong>{{ $startupProfile->startup_name }}</strong>.

                    Create your first internship to connect an opportunity
                    directly to this startup profile.

                </p>


                <a
                    href="{{ route('employer.internships.create', [
                        'startup_profile_id' => $startupProfile->id
                    ]) }}"
                    class="startup-empty-btn"
                >

                    <i class="bi bi-plus-lg"></i>

                    Create First Internship

                </a>

            </div>

        @endforelse


        {{-- =====================================================
             PAGINATION
        ====================================================== --}}

        @if(method_exists($internships, 'hasPages') && $internships->hasPages())

            <div class="startup-internships-pagination">

                {{ $internships->withQueryString()->links() }}

            </div>

        @endif


    </div>

</div>

@endsection
@extends('layouts.app')

@section('title', $job->title ?? 'Job Details')

@section('content')

<style>
    :root {
        --job-primary: #3376F2;
        --job-primary-dark: #245FD0;
        --job-text: #17213A;
        --job-muted: #718096;
        --job-border: #E7ECF4;
        --job-bg: #F7F9FD;
        --job-white: #FFFFFF;
        --job-green: #16A66A;
        --job-orange: #F59E0B;
        --job-red: #EF4444;
        --job-purple: #7257E8;
        --job-shadow: 0 8px 30px rgba(36, 61, 105, .07);
    }

    .job-details-page {
        background: var(--job-bg);
        min-height: calc(100vh - 80px);
        padding: 35px 0 60px;
    }

    .job-details-container {
        width: min(1180px, calc(100% - 32px));
        margin: 0 auto;
    }

    /* =========================
       BREADCRUMB
    ========================= */

    .job-breadcrumb {
        display: flex;
        align-items: center;
        gap: 9px;
        margin-bottom: 22px;
        font-size: 14px;
        color: var(--job-muted);
    }

    .job-breadcrumb a {
        color: var(--job-primary);
        text-decoration: none;
        font-weight: 600;
    }

    .job-breadcrumb a:hover {
        text-decoration: underline;
    }

    .job-breadcrumb i {
        font-size: 11px;
        color: #A4AEC0;
    }

    /* =========================
       HERO
    ========================= */

    .job-header {
        position: relative;
        overflow: hidden;
        background:
            radial-gradient(circle at 90% 20%, rgba(51,118,242,.10), transparent 28%),
            radial-gradient(circle at 75% 100%, rgba(114,87,232,.08), transparent 30%),
            #fff;
        border: 1px solid var(--job-border);
        border-radius: 22px;
        padding: 32px;
        margin-bottom: 24px;
        box-shadow: var(--job-shadow);
    }

    .job-header::before {
        content: "";
        position: absolute;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        background: rgba(51,118,242,.035);
        right: -90px;
        top: -100px;
    }

    .job-header-content {
        position: relative;
        z-index: 2;
    }

    .job-status-row {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 16px;
        flex-wrap: wrap;
    }

    .job-status {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 7px 12px;
        border-radius: 999px;
        background: #ECFDF5;
        color: #087443;
        border: 1px solid #C9F3DE;
        font-size: 12px;
        font-weight: 700;
    }

    .job-status i {
        font-size: 8px;
    }

    .job-mode {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 7px 12px;
        border-radius: 999px;
        background: #EEF4FF;
        color: var(--job-primary);
        border: 1px solid #D8E5FF;
        font-size: 12px;
        font-weight: 700;
    }

    .job-title {
        margin: 0 0 12px;
        color: var(--job-text);
        font-size: 34px;
        line-height: 1.18;
        font-weight: 750;
        letter-spacing: -.5px;
    }

    .job-company {
        display: flex;
        align-items: center;
        gap: 9px;
        color: var(--job-muted);
        font-size: 15px;
        margin-bottom: 24px;
    }

    .job-company i {
        color: var(--job-primary);
    }

    /* =========================
       QUICK INFO
    ========================= */

    .job-quick-info {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 12px;
        position: relative;
        z-index: 2;
    }

    .quick-info-item {
        min-height: 78px;
        background: rgba(255,255,255,.82);
        border: 1px solid var(--job-border);
        border-radius: 13px;
        padding: 13px 15px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .quick-icon {
        width: 40px;
        height: 40px;
        flex: 0 0 40px;
        border-radius: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #EEF4FF;
        color: var(--job-primary);
        font-size: 15px;
    }

    .quick-info-item:nth-child(2) .quick-icon {
        background: #F3EFFF;
        color: var(--job-purple);
    }

    .quick-info-item:nth-child(3) .quick-icon {
        background: #ECFDF5;
        color: var(--job-green);
    }

    .quick-info-item:nth-child(4) .quick-icon {
        background: #FFF7E8;
        color: var(--job-orange);
    }

    .quick-label {
        display: block;
        color: var(--job-muted);
        font-size: 11px;
        margin-bottom: 3px;
        font-weight: 600;
    }

    .quick-value {
        display: block;
        color: var(--job-text);
        font-size: 14px;
        font-weight: 700;
        line-height: 1.3;
    }

    /* =========================
       MAIN GRID
    ========================= */

    .job-main-grid {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 340px;
        gap: 24px;
        align-items: start;
    }

    .job-card {
        background: var(--job-white);
        border: 1px solid var(--job-border);
        border-radius: 18px;
        box-shadow: var(--job-shadow);
    }

    .job-card + .job-card {
        margin-top: 20px;
    }

    .job-card-header {
        padding: 21px 24px;
        border-bottom: 1px solid var(--job-border);
    }

    .job-card-title {
        margin: 0;
        color: var(--job-text);
        font-size: 18px;
        font-weight: 750;
        display: flex;
        align-items: center;
        gap: 9px;
    }

    .job-card-title i {
        color: var(--job-primary);
        font-size: 16px;
    }

    .job-card-body {
        padding: 24px;
    }

    .job-description {
        color: #536176;
        font-size: 14px;
        line-height: 1.85;
        white-space: pre-line;
    }

    /* =========================
       SKILLS
    ========================= */

    .skills-list {
        display: flex;
        flex-wrap: wrap;
        gap: 9px;
    }

    .skill-tag {
        display: inline-flex;
        align-items: center;
        padding: 8px 12px;
        border-radius: 8px;
        background: #EEF4FF;
        color: #2865D5;
        border: 1px solid #DCE8FF;
        font-size: 12px;
        font-weight: 650;
    }

    /* =========================
       DETAILS LIST
    ========================= */

    .details-list {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 0;
    }

    .detail-row {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 16px 4px;
        border-bottom: 1px solid #EEF1F6;
    }

    .detail-row:nth-last-child(-n+2) {
        border-bottom: 0;
    }

    .detail-icon {
        width: 34px;
        height: 34px;
        flex: 0 0 34px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #F2F6FC;
        color: var(--job-primary);
        font-size: 13px;
    }

    .detail-label {
        display: block;
        font-size: 11px;
        color: var(--job-muted);
        margin-bottom: 4px;
        font-weight: 600;
    }

    .detail-value {
        display: block;
        color: var(--job-text);
        font-size: 13px;
        font-weight: 700;
        line-height: 1.4;
    }

    /* =========================
       SIDEBAR
    ========================= */

    .job-sidebar {
        position: sticky;
        top: 25px;
    }

    .apply-card {
        padding: 23px;
    }

    .apply-card-title {
        margin: 0 0 7px;
        color: var(--job-text);
        font-size: 18px;
        font-weight: 750;
    }

    .apply-card-text {
        color: var(--job-muted);
        font-size: 13px;
        line-height: 1.65;
        margin: 0 0 20px;
    }

    .apply-button {
        width: 100%;
        border: 0;
        border-radius: 11px;
        min-height: 46px;
        padding: 11px 16px;
        background: var(--job-primary);
        color: #fff;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: .2s ease;
        box-shadow: 0 6px 16px rgba(51,118,242,.20);
    }

    .apply-button:hover {
        background: var(--job-primary-dark);
        color: #fff;
        transform: translateY(-1px);
    }

    .applied-button {
        width: 100%;
        border-radius: 11px;
        min-height: 46px;
        padding: 11px 16px;
        background: #ECFDF5;
        color: #087443;
        border: 1px solid #C9F3DE;
        font-size: 14px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .save-button {
        width: 100%;
        margin-top: 10px;
        min-height: 44px;
        border-radius: 11px;
        border: 1px solid #DCE3EF;
        background: #fff;
        color: #4D5A70;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-decoration: none;
        transition: .2s ease;
    }

    .save-button:hover {
        border-color: var(--job-primary);
        color: var(--job-primary);
        background: #F8FAFF;
    }

    .save-button.saved {
        color: var(--job-primary);
        border-color: #C9D9FF;
        background: #EEF4FF;
    }

    .sidebar-divider {
        height: 1px;
        background: var(--job-border);
        margin: 21px 0;
    }

    .sidebar-meta {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .sidebar-meta-item {
        display: flex;
        align-items: flex-start;
        gap: 11px;
    }

    .sidebar-meta-icon {
        width: 34px;
        height: 34px;
        border-radius: 9px;
        background: #F2F6FC;
        color: var(--job-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 34px;
        font-size: 13px;
    }

    .sidebar-meta-label {
        color: var(--job-muted);
        font-size: 11px;
        margin-bottom: 3px;
        font-weight: 600;
    }

    .sidebar-meta-value {
        color: var(--job-text);
        font-size: 13px;
        font-weight: 700;
        line-height: 1.4;
    }

    /* =========================
       EMPLOYER CARD
    ========================= */

    .employer-card {
        padding: 22px;
    }

    .employer-heading {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 17px;
    }

    .employer-avatar {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        background: linear-gradient(135deg, #3376F2, #7257E8);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
        font-weight: 800;
    }

    .employer-name {
        color: var(--job-text);
        font-size: 15px;
        font-weight: 750;
        margin: 0;
    }

    .employer-sub {
        color: var(--job-muted);
        font-size: 11px;
        margin-top: 3px;
    }

    /* =========================
       BACK BUTTON
    ========================= */

    .back-area {
        margin-top: 24px;
    }

    .back-button {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 15px;
        border-radius: 9px;
        border: 1px solid var(--job-border);
        background: #fff;
        color: #536176;
        font-size: 13px;
        font-weight: 650;
        text-decoration: none;
        transition: .2s ease;
    }

    .back-button:hover {
        color: var(--job-primary);
        border-color: #C9D9FF;
        background: #F8FAFF;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 950px) {
        .job-main-grid {
            grid-template-columns: 1fr;
        }

        .job-sidebar {
            position: static;
        }

        .job-quick-info {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 650px) {
        .job-details-page {
            padding: 22px 0 45px;
        }

        .job-details-container {
            width: min(100% - 22px, 1180px);
        }

        .job-header {
            padding: 22px 18px;
            border-radius: 16px;
        }

        .job-title {
            font-size: 27px;
        }

        .job-company {
            font-size: 13px;
        }

        .job-quick-info {
            grid-template-columns: 1fr;
        }

        .details-list {
            grid-template-columns: 1fr;
        }

        .detail-row:nth-last-child(-n+2) {
            border-bottom: 1px solid #EEF1F6;
        }

        .detail-row:last-child {
            border-bottom: 0;
        }

        .job-card-header {
            padding: 18px;
        }

        .job-card-body {
            padding: 18px;
        }

        .job-description {
            font-size: 13px;
        }
    }
</style>


<div class="job-details-page">

    <div class="job-details-container">

        {{-- =========================
             BREADCRUMB
        ========================== --}}
        <div class="job-breadcrumb">
            <a href="{{ route('student.jobs.index') }}">
                <i class="fas fa-briefcase"></i>
                Jobs
            </a>

            <i class="fas fa-chevron-right"></i>

            <span>Job Details</span>
        </div>


        {{-- =========================
             JOB HEADER
        ========================== --}}
        <section class="job-header">

            <div class="job-header-content">

                <div class="job-status-row">

                    @if($job->is_active)
                        <span class="job-status">
                            <i class="fas fa-circle"></i>
                            Active Job
                        </span>
                    @else
                        <span class="job-status"
                              style="background:#FEF2F2;color:#B42318;border-color:#FECACA;">
                            <i class="fas fa-circle"></i>
                            Inactive
                        </span>
                    @endif

                    @if(!empty($job->work_mode))
                        <span class="job-mode">
                            <i class="fas fa-laptop-house"></i>
                            {{ ucfirst(str_replace('_', ' ', $job->work_mode)) }}
                        </span>
                    @endif

                </div>


                <h1 class="job-title">
                    {{ $job->title ?? 'Job Opportunity' }}
                </h1>


                @php
                    $employerName = null;

                    if (isset($job->employer)) {
                        $employerName =
                            $job->employer->company_name
                            ?? $job->employer->full_name
                            ?? $job->employer->name
                            ?? null;
                    }
                @endphp


                @if($employerName)
                    <div class="job-company">
                        <i class="fas fa-building"></i>
                        <span>{{ $employerName }}</span>
                    </div>
                @endif


                {{-- Quick Information --}}
                <div class="job-quick-info">

                    <div class="quick-info-item">
                        <div class="quick-icon">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>

                        <div>
                            <span class="quick-label">Salary</span>

                            <span class="quick-value">
                                @if(!empty($job->salary))
                                    ₹{{ number_format((float) $job->salary) }}
                                @else
                                    Not specified
                                @endif
                            </span>
                        </div>
                    </div>


                    <div class="quick-info-item">
                        <div class="quick-icon">
                            <i class="fas fa-clock"></i>
                        </div>

                        <div>
                            <span class="quick-label">Employment Type</span>

                            <span class="quick-value">
                                {{ !empty($job->employment_type)
                                    ? ucfirst(str_replace('_', ' ', $job->employment_type))
                                    : 'Not specified'
                                }}
                            </span>
                        </div>
                    </div>


                    <div class="quick-info-item">
                        <div class="quick-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>

                        <div>
                            <span class="quick-label">Experience</span>

                            <span class="quick-value">
                                {{ $job->experience ?: 'Not specified' }}
                            </span>
                        </div>
                    </div>


                    <div class="quick-info-item">
                        <div class="quick-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>

                        <div>
                            <span class="quick-label">Location</span>

                            <span class="quick-value">

                                @php
                                    $locationParts = array_filter([
                                        $job->city ?? null,
                                        $job->district ?? null,
                                        $job->state ?? null
                                    ]);
                                @endphp

                                {{ !empty($locationParts)
                                    ? implode(', ', $locationParts)
                                    : 'Not specified'
                                }}

                            </span>
                        </div>
                    </div>

                </div>

            </div>

        </section>


        {{-- =========================
             MAIN CONTENT
        ========================== --}}
        <div class="job-main-grid">

            {{-- LEFT CONTENT --}}
            <main>

                {{-- Job Description --}}
                <section class="job-card">

                    <div class="job-card-header">
                        <h2 class="job-card-title">
                            <i class="fas fa-align-left"></i>
                            Job Description
                        </h2>
                    </div>

                    <div class="job-card-body">

                        @if(!empty($job->description))

                            <div class="job-description">
                                {{ $job->description }}
                            </div>

                        @else

                            <div style="color:var(--job-muted);font-size:13px;">
                                No job description has been provided.
                            </div>

                        @endif

                    </div>

                </section>


                {{-- Job Requirements --}}
                <section class="job-card">

                    <div class="job-card-header">
                        <h2 class="job-card-title">
                            <i class="fas fa-clipboard-check"></i>
                            Job Requirements
                        </h2>
                    </div>

                    <div class="job-card-body">

                        <div class="details-list">

                            <div class="detail-row">

                                <div class="detail-icon">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>

                                <div>
                                    <span class="detail-label">
                                        Qualification
                                    </span>

                                    <span class="detail-value">
                                        {{ $job->qualification ?: 'Not specified' }}
                                    </span>
                                </div>

                            </div>


                            <div class="detail-row">

                                <div class="detail-icon">
                                    <i class="fas fa-briefcase"></i>
                                </div>

                                <div>
                                    <span class="detail-label">
                                        Experience
                                    </span>

                                    <span class="detail-value">
                                        {{ $job->experience ?: 'Not specified' }}
                                    </span>
                                </div>

                            </div>


                            <div class="detail-row">

                                <div class="detail-icon">
                                    <i class="fas fa-laptop-house"></i>
                                </div>

                                <div>
                                    <span class="detail-label">
                                        Work Mode
                                    </span>

                                    <span class="detail-value">
                                        {{ !empty($job->work_mode)
                                            ? ucfirst(str_replace('_', ' ', $job->work_mode))
                                            : 'Not specified'
                                        }}
                                    </span>
                                </div>

                            </div>


                            <div class="detail-row">

                                <div class="detail-icon">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>

                                <div>
                                    <span class="detail-label">
                                        Posted
                                    </span>

                                    <span class="detail-value">
                                        {{ $job->created_at
                                            ? $job->created_at->format('d M Y')
                                            : 'Not available'
                                        }}
                                    </span>
                                </div>

                            </div>

                        </div>

                    </div>

                </section>


                {{-- Skills --}}
                <section class="job-card">

                    <div class="job-card-header">
                        <h2 class="job-card-title">
                            <i class="fas fa-code"></i>
                            Required Skills
                        </h2>
                    </div>

                    <div class="job-card-body">

                        @php
                            $skills = $job->skills ?? [];

                            if (is_string($skills)) {
                                $decodedSkills = json_decode($skills, true);

                                if (json_last_error() === JSON_ERROR_NONE && is_array($decodedSkills)) {
                                    $skills = $decodedSkills;
                                } else {
                                    $skills = array_filter(
                                        array_map(
                                            'trim',
                                            preg_split('/[,|]/', $skills)
                                        )
                                    );
                                }
                            }

                            if (!is_array($skills)) {
                                $skills = [];
                            }
                        @endphp


                        @if(count($skills))

                            <div class="skills-list">

                                @foreach($skills as $skill)

                                    @if(is_string($skill) && trim($skill) !== '')

                                        <span class="skill-tag">
                                            {{ trim($skill) }}
                                        </span>

                                    @endif

                                @endforeach

                            </div>

                        @else

                            <div style="color:var(--job-muted);font-size:13px;">
                                No specific skills were listed for this position.
                            </div>

                        @endif

                    </div>

                </section>


                {{-- Location Details --}}
                <section class="job-card">

                    <div class="job-card-header">
                        <h2 class="job-card-title">
                            <i class="fas fa-map-marker-alt"></i>
                            Location Details
                        </h2>
                    </div>

                    <div class="job-card-body">

                        <div class="details-list">

                            @if(!empty($job->city))
                                <div class="detail-row">

                                    <div class="detail-icon">
                                        <i class="fas fa-city"></i>
                                    </div>

                                    <div>
                                        <span class="detail-label">
                                            City
                                        </span>

                                        <span class="detail-value">
                                            {{ ucfirst($job->city) }}
                                        </span>
                                    </div>

                                </div>
                            @endif


                            @if(!empty($job->district))
                                <div class="detail-row">

                                    <div class="detail-icon">
                                        <i class="fas fa-map"></i>
                                    </div>

                                    <div>
                                        <span class="detail-label">
                                            District
                                        </span>

                                        <span class="detail-value">
                                            {{ ucfirst($job->district) }}
                                        </span>
                                    </div>

                                </div>
                            @endif


                            @if(!empty($job->state))
                                <div class="detail-row">

                                    <div class="detail-icon">
                                        <i class="fas fa-location-dot"></i>
                                    </div>

                                    <div>
                                        <span class="detail-label">
                                            State
                                        </span>

                                        <span class="detail-value">
                                            {{ ucfirst($job->state) }}
                                        </span>
                                    </div>

                                </div>
                            @endif


                            @if(!empty($job->country))
                                <div class="detail-row">

                                    <div class="detail-icon">
                                        <i class="fas fa-globe"></i>
                                    </div>

                                    <div>
                                        <span class="detail-label">
                                            Country
                                        </span>

                                        <span class="detail-value">
                                            {{ ucfirst($job->country) }}
                                        </span>
                                    </div>

                                </div>
                            @endif

                        </div>

                    </div>

                </section>

            </main>


            {{-- =========================
                 RIGHT SIDEBAR
            ========================== --}}
            <aside class="job-sidebar">


                {{-- Apply Card --}}
                <section class="job-card apply-card">

                    <h2 class="apply-card-title">
                        Interested in this job?
                    </h2>

                    <p class="apply-card-text">
                        Take the next step and apply for this opportunity.
                    </p>


                    @if($hasApplied)

                        <div class="applied-button">
                            <i class="fas fa-circle-check"></i>
                            Application Submitted
                        </div>

                    @else

                        {{-- 
                            Change this route name only if your application
                            route has a different name.
                        --}}
                        @if(\Illuminate\Support\Facades\Route::has('student.jobs.apply'))

                            <form method="POST"
                                  action="{{ route('student.jobs.apply', $job->id) }}">

                                @csrf

                                <button type="submit" class="apply-button">
                                    <i class="fas fa-paper-plane"></i>
                                    Apply Now
                                </button>

                            </form>

                        @else

                            <button type="button"
                                    class="apply-button"
                                    onclick="alert('Application route is not configured yet.')">
                                <i class="fas fa-paper-plane"></i>
                                Apply Now
                            </button>

                        @endif

                    @endif


                    @if($isSaved)

                        <div class="save-button saved">
                            <i class="fas fa-bookmark"></i>
                            Job Saved
                        </div>

                    @else

                        @if(\Illuminate\Support\Facades\Route::has('student.jobs.save'))

                            <form method="POST"
                                  action="{{ route('student.jobs.save', $job->id) }}">

                                @csrf

                                <button type="submit" class="save-button">
                                    <i class="far fa-bookmark"></i>
                                    Save Job
                                </button>

                            </form>

                        @else

                            <button type="button"
                                    class="save-button"
                                    onclick="alert('Save job route is not configured yet.')">
                                <i class="far fa-bookmark"></i>
                                Save Job
                            </button>

                        @endif

                    @endif


                    <div class="sidebar-divider"></div>


                    <div class="sidebar-meta">

                        <div class="sidebar-meta-item">

                            <div class="sidebar-meta-icon">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>

                            <div>
                                <div class="sidebar-meta-label">
                                    Salary
                                </div>

                                <div class="sidebar-meta-value">

                                    @if(!empty($job->salary))
                                        ₹{{ number_format((float) $job->salary) }}
                                    @else
                                        Not specified
                                    @endif

                                </div>
                            </div>

                        </div>


                        <div class="sidebar-meta-item">

                            <div class="sidebar-meta-icon">
                                <i class="fas fa-briefcase"></i>
                            </div>

                            <div>
                                <div class="sidebar-meta-label">
                                    Employment Type
                                </div>

                                <div class="sidebar-meta-value">
                                    {{ !empty($job->employment_type)
                                        ? ucfirst(str_replace('_', ' ', $job->employment_type))
                                        : 'Not specified'
                                    }}
                                </div>
                            </div>

                        </div>


                        <div class="sidebar-meta-item">

                            <div class="sidebar-meta-icon">
                                <i class="fas fa-clock"></i>
                            </div>

                            <div>
                                <div class="sidebar-meta-label">
                                    Experience
                                </div>

                                <div class="sidebar-meta-value">
                                    {{ $job->experience ?: 'Not specified' }}
                                </div>
                            </div>

                        </div>


                        <div class="sidebar-meta-item">

                            <div class="sidebar-meta-icon">
                                <i class="fas fa-calendar"></i>
                            </div>

                            <div>
                                <div class="sidebar-meta-label">
                                    Posted On
                                </div>

                                <div class="sidebar-meta-value">
                                    {{ $job->created_at
                                        ? $job->created_at->format('d M Y')
                                        : 'Not available'
                                    }}
                                </div>
                            </div>

                        </div>

                    </div>

                </section>


                {{-- Employer --}}
                @if($employerName)

                    <section class="job-card employer-card">

                        <div class="employer-heading">

                            <div class="employer-avatar">
                                {{ strtoupper(substr($employerName, 0, 1)) }}
                            </div>

                            <div>

                                <h3 class="employer-name">
                                    {{ $employerName }}
                                </h3>

                                <div class="employer-sub">
                                    Hiring Employer
                                </div>

                            </div>

                        </div>


                        <div style="
                            font-size:12px;
                            line-height:1.65;
                            color:var(--job-muted);
                        ">
                            Review the job details and submit your application
                            if this opportunity matches your profile.
                        </div>

                    </section>

                @endif

            </aside>

        </div>


        {{-- =========================
             BACK
        ========================== --}}
        <div class="back-area">

            <a href="{{ route('student.jobs.index') }}"
               class="back-button">

                <i class="fas fa-arrow-left"></i>

                Back to Jobs

            </a>

        </div>

    </div>

</div>

@endsection
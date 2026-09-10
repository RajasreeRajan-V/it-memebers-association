@extends('layouts.app')

@section('content')

<style>
    /* ============================================================
       JOB POSTS PAGE
    ============================================================ */

    :root {
        --blue: #3376f2;
        --blue-dark: #245fd0;
        --blue-light: #eef4ff;
        --text: #172033;
        --muted: #7b8498;
        --border: #e8edf5;
        --bg: #f8fafc;
    }

    .job-posts-page {
        font-family:
            Inter,
            Poppins,
            ui-sans-serif,
            system-ui,
            -apple-system,
            BlinkMacSystemFont,
            "Segoe UI",
            sans-serif;
    }


    /* ============================================================
       JOB CARD
    ============================================================ */

    .job-card {
        position: relative;
        z-index: 1;
        border: 1px solid #e8edf5 !important;
        border-radius: 15px !important;
        padding: 17px 18px !important;
        margin-bottom: 12px !important;
        background: #fff;
        box-shadow: 0 2px 10px rgba(15, 23, 42, .025) !important;
        transition:
            transform .18s ease,
            box-shadow .18s ease,
            border-color .18s ease;
    }

    .job-card:hover {
        transform: translateY(-1px);
        border-color: #d5e1f7 !important;
        box-shadow:
            0 8px 22px rgba(37, 99, 235, .065) !important;
    }

    .job-card.menu-active {
        z-index: 50 !important;
    }

    .job-card-inner {
        display: flex;
        align-items: flex-start;
        gap: 13px !important;
    }


    /* ============================================================
       COMPANY PROFILE PHOTO
    ============================================================ */

    .job-company-logo {
        position: relative;
        width: 48px !important;
        height: 48px !important;
        min-width: 48px;
        border-radius: 12px !important;
        overflow: hidden;
        background: #f8fafc;
        border: 1px solid #e7ecf4;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 3px 9px rgba(15, 23, 42, .035);
    }

    .job-company-logo img {
        width: 100%;
        height: 100%;
        display: block;
        object-fit: cover;
    }

    .job-company-logo-fallback {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eef4ff;
        color: #3376f2;
        font-weight: 700;
        font-size: 17px;
    }


    /* ============================================================
       JOB CONTENT
    ============================================================ */

    .job-content {
        flex: 1;
        min-width: 0;
    }

    .job-top-row {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px !important;
    }

    .job-title-row {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 6px;
    }

    .job-title {
        font-size: 15px !important;
        line-height: 1.35 !important;
        font-weight: 700;
        color: #172033;
        letter-spacing: -.01em;
        margin: 0;
    }

    .verified-badge {
        width: 14px;
        height: 14px;
        border-radius: 50%;
        background: #3b82f6;
        color: #fff;
        font-size: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .company-name {
        margin-top: 2px !important;
        font-size: 11.5px !important;
        line-height: 1.4;
        font-weight: 600;
        color: #3376f2;
    }


    /* ============================================================
       ACTION AREA
    ============================================================ */

    .job-actions {
        display: flex;
        align-items: flex-start !important;
        gap: 9px !important;
        flex-shrink: 0;
    }

    .job-posted-info {
        text-align: right;
    }

    .posted-text {
        font-size: 10px !important;
        color: #9aa3b2;
        font-weight: 500;
        line-height: 1.4;
        white-space: nowrap;
    }

    .status-badge {
        display: inline-block;
        margin-top: 3px;
        padding: 2px 8px;
        border-radius: 999px;
        font-size: 9px !important;
        line-height: 1.4;
        font-weight: 600;
    }

    .status-active {
        background: #ecfdf5;
        color: #059669;
    }

    .status-inactive {
        background: #f1f5f9;
        color: #64748b;
    }


    /* ============================================================
       3 DOT MENU
    ============================================================ */

    .job-menu {
        position: relative;
        z-index: 60;
    }

    .job-menu > summary {
        width: 32px !important;
        height: 32px !important;
        list-style: none;
        border: 1px solid #e6ebf3;
        border-radius: 8px;
        color: #94a0b2;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all .16s ease;
    }

    .job-menu > summary::-webkit-details-marker {
        display: none;
    }

    .job-menu > summary::marker {
        display: none;
    }

    .job-menu > summary:hover {
        color: #3376f2;
        border-color: #c9dafa;
        background: #f8fbff;
    }

    .job-menu[open] > summary {
        color: #2563eb;
        border-color: #93c5fd;
        background: #f8fbff;
    }

    .job-menu-panel {
        position: absolute;
        right: 0;
        top: 100%;
        z-index: 100;
        min-width: 180px !important;
        margin-top: 7px;
        padding: 5px !important;
        background: #fff;
        border: 1px solid #e7ebf3 !important;
        border-radius: 11px !important;
        box-shadow: 0 15px 32px rgba(15, 23, 42, .11) !important;
        animation: jobMenuIn .14s ease-out;
        transform-origin: top right;
    }

    @keyframes jobMenuIn {
        from {
            opacity: 0;
            transform: scale(.97) translateY(-4px);
        }

        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    .job-menu-panel a,
    .job-menu-panel button {
        border-radius: 8px;
    }


    /* ============================================================
       JOB META
    ============================================================ */

    .job-meta {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 12px !important;
        margin-top: 8px !important;
    }

    .job-meta-item {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 11.5px !important;
        color: #7b8498;
        line-height: 1.5;
    }

    .job-meta-item svg {
        width: 13px !important;
        height: 13px !important;
        color: #9aa4b3;
        flex-shrink: 0;
    }

    .job-meta-salary {
        color: #059669 !important;
        font-weight: 600;
    }


    /* ============================================================
       DESCRIPTION
    ============================================================ */

    .job-description {
        margin-top: 7px !important;
        font-size: 11.5px !important;
        line-height: 1.6 !important;
        color: #7b8498;
    }

    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }


    /* ============================================================
       SKILLS
    ============================================================ */

    .job-skills {
        display: flex;
        flex-wrap: wrap;
        gap: 5px !important;
        margin-top: 9px !important;
    }

    .job-skill {
        padding: 3px 8px !important;
        border-radius: 999px;
        background: #f0f5ff;
        color: #3376f2;
        font-size: 9.5px !important;
        line-height: 1.5;
        font-weight: 600;
    }


    /* ============================================================
       HERO
    ============================================================ */

    .hero-title {
        letter-spacing: -.035em !important;
    }

    .hero-buttons a {
        box-shadow: 0 7px 18px rgba(37, 99, 235, .08);
    }

    .hero-buttons a:first-child {
        box-shadow: 0 9px 22px rgba(51, 118, 242, .20);
    }


    /* ============================================================
       SIDEBAR
    ============================================================ */

    .listing-sidebar-card {
        border-color: #e8edf5 !important;
        border-radius: 16px !important;
        box-shadow: 0 3px 13px rgba(15, 23, 42, .03) !important;
    }


    /* ============================================================
       EMPTY STATE
    ============================================================ */

    .empty-state {
        border-color: #e8edf5 !important;
        border-radius: 16px !important;
    }


    /* ============================================================
       MOBILE
    ============================================================ */

    @media (max-width: 767px) {

        .job-card {
            padding: 14px !important;
            border-radius: 14px !important;
        }

        .job-card-inner {
            gap: 10px !important;
        }

        .job-company-logo {
            width: 43px !important;
            height: 43px !important;
            min-width: 43px !important;
        }

        .job-top-row {
            flex-direction: column;
            align-items: stretch !important;
            gap: 8px !important;
        }

        .job-actions {
            width: 100%;
            justify-content: space-between;
            align-items: center !important;
        }

        .job-posted-info {
            text-align: left !important;
        }

        .job-menu {
            margin-left: auto;
        }

        .job-menu-panel {
            right: 0;
            width: 180px;
        }

        .job-title {
            font-size: 14px !important;
        }

        .hero-title {
            font-size: 34px !important;
        }
    }


    @media (max-width: 575px) {

        .hero-buttons {
            width: 100%;
        }

        .hero-buttons a {
            flex: 1;
            justify-content: center;
        }

        .job-meta {
            gap: 8px !important;
        }

        .job-description {
            font-size: 11px !important;
        }

        .job-menu-panel {
            width: 175px;
        }
    }


    @media (max-width: 1023px) {

        .job-posts-page .hero-title {
            font-size: 42px !important;
        }
    }
</style>

<div class="job-posts-page bg-slate-50 min-h-screen">

{{-- =========================================================
    HERO SECTION
========================================================== --}}

<div
    class="bg-gradient-to-b from-[#F5F8FF] via-[#F5F8FF] to-white border-b border-slate-100">

    <div
        class="max-w-6xl mx-auto px-6 py-11 md:py-13 grid md:grid-cols-2 gap-7 lg:gap-9 items-center">


        {{-- LEFT HERO CONTENT --}}

        <div class="flex flex-col items-start text-left">

            <span
                class="inline-flex items-center gap-1.5 text-xs font-semibold text-blue-700 bg-blue-100/70 px-3.5 py-1.5 rounded-full mb-4">

                <svg
                    class="w-3.5 h-3.5"
                    fill="currentColor"
                    viewBox="0 0 24 24">

                    <path d="M13 2 3 14h7l-1 8 11-14h-7l0-6z"/>

                </svg>

                GROW YOUR TEAM

            </span>


            <h1
                class="hero-title text-4xl sm:text-5xl font-bold text-slate-900 leading-[1.12] tracking-tight mb-4 max-w-lg">

                Find the Right Talent,

                <span class="text-blue-600 block">
                    Build Your Team
                </span>

            </h1>


            <p
                class="text-slate-500 text-base mb-6 max-w-md leading-relaxed">

                Post jobs, review applications, and hire skilled professionals
                who are ready to grow with your company.

            </p>


            <div
                class="hero-buttons flex flex-wrap items-center gap-3">

                <a
                    href="{{ route('employer.jobs.create') }}"
                    class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-6 py-3 rounded-xl transition hover:-translate-y-0.5">

                    <span class="text-base leading-none">
                        ＋
                    </span>

                    Create Job

                </a>


                <a
                    href="#job-list"
                    class="inline-flex items-center gap-2 bg-white border border-slate-200 text-slate-600 hover:text-blue-600 hover:border-blue-300 text-sm font-semibold px-6 py-3 rounded-xl transition">

                    Browse Jobs

                </a>

            </div>

        </div>


        {{-- RIGHT HERO IMAGE --}}

        <div
            class="relative flex justify-center md:justify-end">

            <img
                src="{{ asset('assets/img/jjj.png') }}"
                alt="Find the right talent"
                class="w-full max-w-sm lg:max-w-[370px] h-auto rounded-xl object-contain drop-shadow-[0_18px_35px_rgba(51,118,242,0.10)]"
                onerror="this.style.display='none'"
            >


            {{-- VERIFIED CANDIDATES --}}

            <div
                class="absolute top-4 left-0 md:-left-4 flex items-center gap-2 bg-white rounded-xl shadow-lg shadow-blue-900/10 px-3.5 py-2">

                <span
                    class="w-7 h-7 rounded-lg bg-blue-100 flex items-center justify-center shrink-0 text-blue-600 text-sm">

                    ✓

                </span>

                <div>

                    <p class="text-xs font-semibold text-slate-800 leading-tight">
                        Verified Candidates
                    </p>

                    <p class="text-[10px] text-slate-400 leading-tight">
                        100% genuine profiles
                    </p>

                </div>

            </div>


            {{-- SMART MATCHING --}}

            <div
                class="absolute top-24 right-0 md:right-4 flex items-center gap-2 bg-white rounded-xl shadow-lg shadow-blue-900/10 px-3.5 py-2">

                <span
                    class="w-7 h-7 rounded-lg bg-violet-100 flex items-center justify-center shrink-0 text-violet-600 text-sm">

                    ◈

                </span>

                <div>

                    <p class="text-xs font-semibold text-slate-800 leading-tight">
                        Smart Matching
                    </p>

                    <p class="text-[10px] text-slate-400 leading-tight">
                        AI-powered recommendations
                    </p>

                </div>

            </div>


            {{-- FASTER HIRING --}}

            <div
                class="absolute bottom-6 left-0 md:-left-6 flex items-center gap-2 bg-white rounded-xl shadow-lg shadow-blue-900/10 px-3.5 py-2">

                <span
                    class="w-7 h-7 rounded-lg bg-emerald-100 flex items-center justify-center shrink-0 text-emerald-600 text-sm">

                    ⚡

                </span>

                <div>

                    <p class="text-xs font-semibold text-slate-800 leading-tight">
                        Faster Hiring
                    </p>

                    <p class="text-[10px] text-slate-400 leading-tight">
                        Close roles in days
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
    MAIN CONTENT
========================================================== --}}

<div
    class="max-w-7xl mx-auto px-4 py-7 md:py-8">


    {{-- SUCCESS MESSAGE --}}

    @if (session('success'))

        <div
            class="flex items-center gap-2 bg-emerald-50 border border-emerald-100 text-emerald-700 text-sm font-medium rounded-xl px-4 py-3 mb-4">

            <svg
                class="w-4 h-4 shrink-0"
                fill="none"
                stroke="currentColor"
                stroke-width="2.5"
                viewBox="0 0 24 24">

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M5 13l4 4L19 7"
                />

            </svg>

            {{ session('success') }}

        </div>

    @endif


    {{-- =====================================================
        CONTENT LAYOUT
    ====================================================== --}}

    <div
        class="grid lg:grid-cols-[minmax(0,1fr)_280px] gap-5 lg:gap-6">


        {{-- =================================================
            JOB LIST
        ================================================== --}}

        <section
            id="job-list"
            class="min-w-0">


            @php

                $logoPalette = [

                    'bg-teal-50 text-teal-600',

                    'bg-amber-50 text-amber-600',

                    'bg-rose-50 text-rose-600',

                    'bg-emerald-50 text-emerald-600',

                    'bg-blue-50 text-blue-600',

                    'bg-violet-50 text-violet-600',

                ];

            @endphp


            @forelse ($jobs as $job)

                @php

                    /* ------------------------------------------------
                       JOB BASIC INFORMATION
                    ------------------------------------------------ */

                    $jobTitle =
                        $job->title
                        ?? $job->job_title
                        ?? 'Untitled Job';


                    $employmentType =
                        $job->employment_type
                        ?? $job->job_type
                        ?? 'Full Time';


                    $city =
                        $job->city
                        ?? null;


                    $state =
                        $job->state
                        ?? null;


                    $location = trim(

                        ($city ?: '')
                        .
                        ($city && $state ? ', ' : '')
                        .
                        ($state ?: '')

                    );


                    /* ------------------------------------------------
                       COMPANY PROFILE
                    ------------------------------------------------ */

                    $employerRegistration =
                        $job->employerRegistration
                        ?? null;


                    $companyName =
                        optional($employerRegistration)->company_name
                        ?? $job->company_name
                        ?? 'Your Company';


                    $companyProfilePhoto =
                        optional($employerRegistration)->profile_photo
                        ?? null;


                    /* ------------------------------------------------
                       DESCRIPTION
                    ------------------------------------------------ */

                    $description =
                        $job->description
                        ?? $job->job_description
                        ?? 'No job description available.';


                    /* ------------------------------------------------
                       SKILLS
                    ------------------------------------------------ */

                    $skills =
                        $job->skills
                        ?? $job->required_skills
                        ?? '';


                    if (is_string($skills)) {

                        $skills = array_filter(

                            array_map(
                                'trim',
                                preg_split('/[,|]+/', $skills)
                            )

                        );

                    }


                    if (is_array($skills)) {

                        $skills =
                            array_filter(
                                array_map('trim', $skills)
                            );

                    }


                    if (!is_array($skills)) {

                        $skills = [];

                    }


                    /* ------------------------------------------------
                       LOGO FALLBACK
                    ------------------------------------------------ */

                    $avatarClass =
                        $logoPalette[
                            $loop->index
                            %
                            count($logoPalette)
                        ];


                    $companyInitial =
                        strtoupper(
                            substr(
                                trim($companyName),
                                0,
                                1
                            )
                        );


                    /* ------------------------------------------------
                       STATUS
                    ------------------------------------------------ */

                    $isActive =
                        $job->is_active ?? false;


                    /* ------------------------------------------------
                       APPLICANT COUNT
                    ------------------------------------------------ */

                    $applicantsForJob =
                        $job->applicants_count
                        ?? $job->applications_count
                        ?? null;

                @endphp


                {{-- =================================================
                    JOB CARD
                ================================================== --}}

                <article
                    class="job-card">


                    <div
                        class="job-card-inner">


                        {{-- =================================================
                            COMPANY PROFILE PHOTO
                        ================================================== --}}

                        <div
                            class="job-company-logo">


                            @if ($companyProfilePhoto)

                                <img
                                    src="{{ asset('storage/' . ltrim($companyProfilePhoto, '/')) }}"
                                    alt="{{ $companyName }}"
                                    loading="lazy"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                >


                                {{-- IMAGE FALLBACK --}}

                                <span
                                    class="job-company-logo-fallback"
                                    style="display:none;">

                                    {{ $companyInitial }}

                                </span>

                            @else

                                {{-- NO PHOTO FALLBACK --}}

                                <span
                                    class="job-company-logo-fallback">

                                    {{ $companyInitial }}

                                </span>

                            @endif

                        </div>


                        {{-- =================================================
                            JOB CONTENT
                        ================================================== --}}

                        <div
                            class="job-content">


                            {{-- =================================================
                                TOP ROW
                            ================================================== --}}

                            <div
                                class="job-top-row">


                                {{-- JOB TITLE / COMPANY --}}

                                <div class="min-w-0">

                                    <div
                                        class="job-title-row">

                                        <h2
                                            class="job-title">

                                            {{ $jobTitle }}

                                        </h2>


                                        <span
                                            class="verified-badge"
                                            title="Verified">

                                            ✓

                                        </span>

                                    </div>


                                    <p
                                        class="company-name">

                                        {{ $companyName }}

                                    </p>

                                </div>


                                {{-- ACTION AREA --}}

                                <div
                                    class="job-actions">


                                    {{-- POSTED / STATUS --}}

                                    <div
                                        class="job-posted-info">

                                        <p
                                            class="posted-text">

                                            Posted
                                            {{ optional($job->created_at)->diffForHumans() }}

                                        </p>


                                        <span
                                            class="status-badge
                                            {{ $isActive
                                                ? 'status-active'
                                                : 'status-inactive'
                                            }}">

                                            {{ $isActive ? 'Active' : 'Inactive' }}

                                        </span>

                                    </div>


                                    {{-- =================================================
                                        3 DOT MENU
                                    ================================================== --}}

                                    <details
                                        class="job-menu">


                                        <summary>

                                            <svg
                                                class="w-4 h-4"
                                                viewBox="0 0 24 24"
                                                fill="currentColor">

                                                <circle
                                                    cx="12"
                                                    cy="5"
                                                    r="1.8">
                                                </circle>

                                                <circle
                                                    cx="12"
                                                    cy="12"
                                                    r="1.8">
                                                </circle>

                                                <circle
                                                    cx="12"
                                                    cy="19"
                                                    r="1.8">
                                                </circle>

                                            </svg>

                                        </summary>


                                        {{-- MENU PANEL --}}

                                        <div
                                            class="job-menu-panel">


                                            {{-- EDIT --}}

                                            <a
                                                href="{{ route('employer.jobs.edit', $job) }}"
                                                class="flex items-center gap-2.5 px-3.5 py-2.5 text-[12px] font-medium text-slate-600 hover:bg-slate-50 hover:text-blue-600 transition">

                                                <svg
                                                    class="w-4 h-4 shrink-0"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2">

                                                    <path d="M12 20h9"></path>

                                                    <path
                                                        d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4Z">
                                                    </path>

                                                </svg>

                                                Edit Job

                                            </a>


                                            {{-- APPLICANTS --}}

                                            <a
                                                href="{{ route('employer.applicants.index', ['job' => $job->id]) }}"
                                                class="flex items-center gap-2.5 px-3.5 py-2.5 text-[12px] font-medium text-slate-600 hover:bg-slate-50 hover:text-blue-600 transition">

                                                <svg
                                                    class="w-4 h-4 shrink-0"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2">

                                                    <path
                                                        d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2">
                                                    </path>

                                                    <circle
                                                        cx="9"
                                                        cy="7"
                                                        r="4">
                                                    </circle>

                                                    <path
                                                        d="M23 21v-2a4 4 0 0 0-3-3.87">
                                                    </path>

                                                    <path
                                                        d="M16 3.13a4 4 0 0 1 0 7.75">
                                                    </path>

                                                </svg>

                                                <span>
                                                    Applicants
                                                </span>


                                                @if (!is_null($applicantsForJob))

                                                    <span
                                                        class="ml-auto text-[10px] font-semibold text-blue-600 bg-blue-50 rounded-full px-1.5 py-0.5">

                                                        {{ $applicantsForJob }}

                                                    </span>

                                                @endif

                                            </a>


                                            {{-- VIEW --}}

                                            <a
                                                href="{{ route('employer.jobs.show', $job) }}"
                                                class="flex items-center gap-2.5 px-3.5 py-2.5 text-[12px] font-medium text-slate-600 hover:bg-slate-50 hover:text-blue-600 transition">

                                                <svg
                                                    class="w-4 h-4 shrink-0"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2">

                                                    <path
                                                        d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z">
                                                    </path>

                                                    <circle
                                                        cx="12"
                                                        cy="12"
                                                        r="3">
                                                    </circle>

                                                </svg>

                                                View Job

                                            </a>


                                            {{-- DIVIDER --}}

                                            <div
                                                class="my-1 border-t border-slate-100">
                                            </div>


                                            {{-- DELETE --}}

                                            <form
                                                action="{{ route('employer.jobs.destroy', $job) }}"
                                                method="POST"
                                                onsubmit="return confirm('Delete this job posting? This action cannot be undone.');">

                                                @csrf

                                                @method('DELETE')


                                                <button
                                                    type="submit"
                                                    class="w-full flex items-center gap-2.5 px-3.5 py-2.5 text-[12px] font-medium text-rose-600 hover:bg-rose-50 transition text-left">

                                                    <svg
                                                        class="w-4 h-4 shrink-0"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        stroke-width="2">

                                                        <path d="M3 6h18"></path>

                                                        <path
                                                            d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2m3 0v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6h14Z">
                                                        </path>

                                                        <path
                                                            d="M10 11v6M14 11v6">
                                                        </path>

                                                    </svg>

                                                    Delete

                                                </button>

                                            </form>

                                        </div>

                                    </details>

                                </div>

                            </div>


                            {{-- =================================================
                                JOB META
                            ================================================== --}}

                            <div
                                class="job-meta">


                                {{-- EMPLOYMENT TYPE --}}

                                <span
                                    class="job-meta-item">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2">

                                        <rect
                                            x="3"
                                            y="7"
                                            width="18"
                                            height="13"
                                            rx="2">
                                        </rect>

                                        <path
                                            d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                        </path>

                                    </svg>

                                    {{ ucfirst(str_replace('-', ' ', $employmentType)) }}

                                </span>


                                {{-- LOCATION --}}

                                @if ($location)

                                    <span
                                        class="job-meta-item">

                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2">

                                            <path
                                                d="M12 21s-7-6.1-7-11a7 7 0 0 1 14 0c0 4.9-7 11-7 11z">
                                            </path>

                                            <circle
                                                cx="12"
                                                cy="10"
                                                r="2.5">
                                            </circle>

                                        </svg>

                                        {{ $location }}

                                    </span>

                                @endif


                                {{-- EXPERIENCE --}}

                                @if (!empty($job->experience))

                                    <span
                                        class="job-meta-item">

                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2">

                                            <circle
                                                cx="12"
                                                cy="12"
                                                r="9">
                                            </circle>

                                            <path
                                                d="M12 7v5l3 3">
                                            </path>

                                        </svg>

                                        {{ $job->experience }}

                                    </span>

                                @elseif (!empty($job->experience_level))

                                    <span
                                        class="job-meta-item">

                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2">

                                            <circle
                                                cx="12"
                                                cy="12"
                                                r="9">
                                            </circle>

                                            <path
                                                d="M12 7v5l3 3">
                                            </path>

                                        </svg>

                                        {{ $job->experience_level }}

                                    </span>

                                @endif


                                {{-- SALARY --}}

                                @if (!empty($job->salary))

                                    <span
                                        class="job-meta-item job-meta-salary">

                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2">

                                            <path
                                                d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7H14a3.5 3.5 0 0 1 0 7H6">
                                            </path>

                                        </svg>

                                        {{ $job->salary }}

                                    </span>

                                @elseif (!empty($job->salary_range))

                                    <span
                                        class="job-meta-item job-meta-salary">

                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2">

                                            <path
                                                d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7H14a3.5 3.5 0 0 1 0 7H6">
                                            </path>

                                        </svg>

                                        {{ $job->salary_range }}

                                    </span>

                                @endif

                            </div>


                            {{-- =================================================
                                DESCRIPTION
                            ================================================== --}}

                            <p
                                class="job-description line-clamp-2">

                                {{ $description }}

                            </p>


                            {{-- =================================================
                                SKILLS
                            ================================================== --}}

                            @if (count($skills))

                                <div
                                    class="job-skills">

                                    @foreach (array_slice($skills, 0, 5) as $skill)

                                        <span
                                            class="job-skill">

                                            {{ $skill }}

                                        </span>

                                    @endforeach

                                </div>

                            @endif

                        </div>

                    </div>

                </article>


            @empty


                {{-- =================================================
                    EMPTY STATE
                ================================================== --}}

                <div
                    class="empty-state bg-white border border-slate-200 rounded-2xl shadow-sm py-14 px-6 text-center">


                    <div
                        class="w-14 h-14 mx-auto mb-4 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center">

                        <svg
                            class="w-6 h-6"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2">

                            <rect
                                x="3"
                                y="5"
                                width="18"
                                height="14"
                                rx="2">
                            </rect>

                            <path
                                d="M8 10h8M8 14h5">
                            </path>

                        </svg>

                    </div>


                    <h3
                        class="text-lg font-semibold text-slate-800 mb-1.5">

                        No jobs posted yet

                    </h3>


                    <p
                        class="text-sm text-slate-400 mb-5">

                        Start attracting great talent by posting your first job.

                    </p>


                    <a
                        href="{{ route('employer.jobs.create') }}"
                        class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-6 py-3 rounded-xl transition">

                        + Post a Job

                    </a>

                </div>

            @endforelse


            {{-- =================================================
                PAGINATION
            ================================================== --}}

            @if (
                $jobs instanceof \Illuminate\Contracts\Pagination\Paginator ||
                $jobs instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator
            )

                <div class="mt-5 text-sm">

                    {{ $jobs->withQueryString()->links() }}

                </div>

            @endif

        </section>


        {{-- =====================================================
            SIDEBAR
        ====================================================== --}}

        <aside class="space-y-4">


            {{-- POST JOB CTA --}}

            <div
                class="listing-sidebar-card relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-600 to-violet-600 text-white p-5 shadow-lg shadow-blue-900/15">


                <div
                    class="absolute w-28 h-28 rounded-full bg-white/10 -right-8 -bottom-8">
                </div>


                <div
                    class="absolute w-16 h-16 rounded-full bg-white/10 right-10 -top-6">
                </div>


                <h3
                    class="relative font-bold text-[16px] mb-2">

                    Need to hire faster?

                </h3>


                <p
                    class="relative text-[13px] text-white/85 leading-relaxed mb-4">

                    Post your job and connect with talented professionals
                    looking for their next opportunity.

                </p>


                <a
                    href="{{ route('employer.jobs.create') }}"
                    class="relative inline-flex items-center gap-1.5 bg-white text-blue-600 hover:bg-slate-50 text-[13px] font-bold px-4 py-2.5 rounded-lg transition">

                    Create Job →

                </a>

            </div>


            {{-- JOB TIPS --}}

            <div
                class="listing-sidebar-card bg-white border border-slate-200 rounded-2xl shadow-sm p-5">


                <h3
                    class="text-sm font-bold text-slate-800 mb-3">

                    Job Tips

                </h3>


                <ul
                    class="text-[12px] text-slate-500 leading-7">

                    <li>
                        ✓ Keep your job title clear
                    </li>

                    <li>
                        ✓ Add relevant skills
                    </li>

                    <li>
                        ✓ Mention experience requirements
                    </li>

                    <li>
                        ✓ Include salary information
                    </li>

                    <li>
                        ✓ Keep your description concise
                    </li>

                </ul>


                <a
                    href="#"
                    class="inline-flex items-center gap-1 mt-2 text-[12px] font-semibold text-blue-600 hover:underline">

                    View More Tips →

                </a>

            </div>

        </aside>

    </div>

</div>


</div>

{{-- ================================================================
3-DOT MENU JAVASCRIPT
================================================================ --}}

<script>

(function () {

    const menus =
        document.querySelectorAll('.job-menu');


    /* ============================================================
       CLOSE OTHER MENUS
    ============================================================ */

    function closeOtherMenus(currentMenu) {

        menus.forEach(function (menu) {

            if (menu !== currentMenu) {

                menu.removeAttribute('open');

                const card =
                    menu.closest('.job-card');

                if (card) {

                    card.classList.remove('menu-active');

                }

            }

        });

    }


    /* ============================================================
       MENU TOGGLE
    ============================================================ */

    menus.forEach(function (menu) {

        menu.addEventListener('toggle', function () {

            const card =
                menu.closest('.job-card');


            if (menu.open) {

                closeOtherMenus(menu);


                if (card) {

                    card.classList.add('menu-active');

                }

            } else {

                if (card) {

                    card.classList.remove('menu-active');

                }

            }

        });

    });


    /* ============================================================
       CLICK OUTSIDE
    ============================================================ */

    document.addEventListener('click', function (event) {

        menus.forEach(function (menu) {

            if (!menu.contains(event.target)) {

                menu.removeAttribute('open');


                const card =
                    menu.closest('.job-card');

                if (card) {

                    card.classList.remove('menu-active');

                }

            }

        });

    });


    /* ============================================================
       CLICK INSIDE
    ============================================================ */

    menus.forEach(function (menu) {

        menu.addEventListener('click', function (event) {

            event.stopPropagation();

        });

    });


})();

</script>

@endsection



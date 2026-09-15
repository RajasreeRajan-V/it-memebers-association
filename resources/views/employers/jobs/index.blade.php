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
        --green: #059669;
        --green-light: #ecfdf5;
        --amber: #b45309;
        --amber-light: #fff7ed;
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
        border: 1px solid var(--border) !important;
        border-radius: 18px !important;
        padding: 22px 24px !important;
        margin-bottom: 18px !important;
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
            0 10px 24px rgba(37, 99, 235, .07) !important;
    }

    .job-card.menu-active {
        z-index: 50 !important;
    }

    .job-card-inner {
        display: flex;
        align-items: flex-start;
        gap: 17px !important;
    }


    /* ============================================================
       COMPANY PROFILE PHOTO
    ============================================================ */

    .job-company-logo {
        position: relative;
        width: 56px !important;
        height: 56px !important;
        min-width: 56px;
        border-radius: 14px !important;
        overflow: hidden;
        background: #fff;
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
        font-size: 19px;
    }


    /* ============================================================
       JOB CONTENT
    ============================================================ */

    .job-content {
        flex: 1;
        min-width: 0;
    }

    /* ---- row 1: title + type badge  |  salary + menu ---- */

    .job-row {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 10px !important;
    }

    .job-row + .job-row {
        margin-top: 6px !important;
    }

    .job-title-line {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 9px;
        min-width: 0;
    }

    .job-title {
        font-size: 17px !important;
        line-height: 1.35 !important;
        font-weight: 700;
        color: var(--text);
        letter-spacing: -.01em;
        margin: 0;
    }

    .job-type-badge {
        flex-shrink: 0;
        font-size: 10.5px !important;
        font-weight: 700;
        letter-spacing: .03em;
        text-transform: uppercase;
        padding: 4px 10px !important;
        border-radius: 999px;
        background: var(--amber-light);
        color: var(--amber);
        white-space: nowrap;
    }

    .job-salary {
        flex-shrink: 0;
        font-size: 16px !important;
        font-weight: 700;
        color: var(--green);
        white-space: nowrap;
    }

    /* ---- row 2: company / location / experience  |  posted date ---- */

    .job-subline {
        font-size: 12.5px !important;
        color: var(--muted);
        line-height: 1.55;
        min-width: 0;
    }

    .job-subline strong {
        color: var(--text);
        font-weight: 600;
    }

    .job-subline .dot {
        margin: 0 5px;
        color: #c7cedb;
    }

    .posted-text {
        flex-shrink: 0;
        font-size: 11.5px !important;
        color: #9aa3b2;
        font-weight: 500;
        white-space: nowrap;
    }

    /* ---- row 3: tags  |  status ---- */

    .job-tags-row {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 8px !important;
        margin-top: 14px !important;
    }

    .tag-pill {
        font-size: 12px !important;
        font-weight: 600;
        line-height: 1.5;
        padding: 5px 12px !important;
        border-radius: 999px;
        white-space: nowrap;
    }

    .tag-pill.tag-mode {
        background: var(--blue-light);
        color: var(--blue);
    }

    .tag-pill.tag-skill {
        background: #f8fafc;
        border: 1px solid var(--border);
        color: #5b6472;
    }

    .job-footer-right {
        margin-left: auto;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 5px 12px !important;
        border-radius: 999px;
        font-size: 12px !important;
        font-weight: 700;
        white-space: nowrap;
    }

    .status-active {
        background: var(--green-light);
        color: var(--green);
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
        flex-shrink: 0;
    }

    .job-menu > summary {
        width: 30px !important;
        height: 30px !important;
        list-style: none;
        border: 1px solid transparent;
        border-radius: 8px;
        color: #b3bac8;
        background: transparent;
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

    .hero-image {
        border: 0 !important;
        margin: 0 !important;
        box-shadow: none !important;
        filter: none !important;
    }


    /* ============================================================
       SIDEBAR
    ============================================================ */

    .listing-sidebar-card {
        border-color: var(--border) !important;
        border-radius: 16px !important;
        box-shadow: 0 3px 13px rgba(15, 23, 42, .03) !important;
    }


    /* ============================================================
       EMPTY STATE
    ============================================================ */

    .empty-state {
        border-color: var(--border) !important;
        border-radius: 16px !important;
    }


    /* ============================================================
       MOBILE
    ============================================================ */

    @media (max-width: 767px) {

        .job-card {
            padding: 17px !important;
            border-radius: 15px !important;
        }

        .job-card-inner {
            gap: 12px !important;
        }

        .job-company-logo {
            width: 49px !important;
            height: 49px !important;
            min-width: 49px !important;
        }

        .job-row {
            flex-wrap: wrap;
        }

        .job-salary {
            font-size: 14.5px !important;
        }

        .job-title {
            font-size: 15.5px !important;
        }

        .job-subline {
            width: 100%;
        }

        .posted-text {
            width: 100%;
            margin-top: 2px;
        }

        .job-menu-panel {
            right: 0;
            width: 180px;
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

        .job-tags-row {
            gap: 7px !important;
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
                    class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-[15px] font-semibold px-9 py-3.5 rounded-lg transition hover:-translate-y-0.5">

                    <span class="text-base leading-none">
                        ＋
                    </span>

                    Create Job

                </a>


                <a
                    href="#job-list"
                    class="inline-flex items-center gap-2 bg-white border border-slate-200 text-slate-600 hover:text-blue-600 hover:border-blue-300 text-[15px] font-semibold px-9 py-3.5 rounded-lg transition">

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
                class="hero-image w-full max-w-sm lg:max-w-[420px] h-auto object-contain"
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


                    $workMode =
                        $job->work_mode
                        ?? $job->location_type
                        ?? null;


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


                                <span
                                    class="job-company-logo-fallback"
                                    style="display:none;">

                                    {{ $companyInitial }}

                                </span>

                            @else

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


                            {{-- ---- ROW 1 : title + type  |  salary + menu ---- --}}

                            <div class="job-row">

                                <div class="job-title-line">

                                    <h2 class="job-title">
                                        {{ $jobTitle }}
                                    </h2>

                                    <span class="job-type-badge">
                                        {{ ucfirst(str_replace('-', ' ', $employmentType)) }}
                                    </span>

                                </div>

                                <div class="flex items-center gap-2">

                                    @if (!empty($job->salary))

                                        <span class="job-salary">
                                            {{ $job->salary }}
                                        </span>

                                    @elseif (!empty($job->salary_range))

                                        <span class="job-salary">
                                            {{ $job->salary_range }}
                                        </span>

                                    @endif


                                    {{-- =================================================
                                        3 DOT MENU
                                    ================================================== --}}

                                    <details class="job-menu">

                                        <summary>

                                            <svg
                                                class="w-4 h-4"
                                                viewBox="0 0 24 24"
                                                fill="currentColor">

                                                <circle cx="12" cy="5" r="1.8"></circle>
                                                <circle cx="12" cy="12" r="1.8"></circle>
                                                <circle cx="12" cy="19" r="1.8"></circle>

                                            </svg>

                                        </summary>


                                        <div class="job-menu-panel">


                                            <a
                                                href="{{ route('employer.jobs.edit', $job) }}"
                                                class="flex items-center gap-2.5 px-3.5 py-2.5 text-[12px] font-medium text-slate-600 hover:bg-slate-50 hover:text-blue-600 transition">

                                                <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M12 20h9"></path>
                                                    <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4Z"></path>
                                                </svg>

                                                Edit Job

                                            </a>


                                            <a
                                                href="{{ route('employer.applicants.index', ['job' => $job->id]) }}"
                                                class="flex items-center gap-2.5 px-3.5 py-2.5 text-[12px] font-medium text-slate-600 hover:bg-slate-50 hover:text-blue-600 transition">

                                                <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                                    <circle cx="9" cy="7" r="4"></circle>
                                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                                </svg>

                                                <span>Applicants</span>

                                                @if (!is_null($applicantsForJob))

                                                    <span class="ml-auto text-[10px] font-semibold text-blue-600 bg-blue-50 rounded-full px-1.5 py-0.5">
                                                        {{ $applicantsForJob }}
                                                    </span>

                                                @endif

                                            </a>


                                            <a
                                                href="{{ route('employer.jobs.show', $job) }}"
                                                class="flex items-center gap-2.5 px-3.5 py-2.5 text-[12px] font-medium text-slate-600 hover:bg-slate-50 hover:text-blue-600 transition">

                                                <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z"></path>
                                                    <circle cx="12" cy="12" r="3"></circle>
                                                </svg>

                                                View Job

                                            </a>


                                            <div class="my-1 border-t border-slate-100"></div>


                                            <form
                                                action="{{ route('employer.jobs.destroy', $job) }}"
                                                method="POST"
                                                onsubmit="return confirm('Delete this job posting? This action cannot be undone.');">

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="w-full flex items-center gap-2.5 px-3.5 py-2.5 text-[12px] font-medium text-rose-600 hover:bg-rose-50 transition text-left">

                                                    <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                        <path d="M3 6h18"></path>
                                                        <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2m3 0v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6h14Z"></path>
                                                        <path d="M10 11v6M14 11v6"></path>
                                                    </svg>

                                                    Delete

                                                </button>

                                            </form>

                                        </div>

                                    </details>

                                </div>

                            </div>


                            {{-- ---- ROW 2 : company / location / experience  |  posted ---- --}}

                            <div class="job-row">

                                <p class="job-subline">

                                    <strong>{{ $companyName }}</strong>

                                    @if ($location)
                                        <span class="dot">·</span>{{ $location }}
                                    @endif

                                    @if (!empty($job->experience))
                                        <span class="dot">·</span>{{ $job->experience }}
                                    @elseif (!empty($job->experience_level))
                                        <span class="dot">·</span>{{ $job->experience_level }}
                                    @endif

                                </p>

                                <span class="posted-text">
                                    Posted {{ optional($job->created_at)->diffForHumans() }}
                                </span>

                            </div>


                            {{-- ---- ROW 3 : tags  |  status ---- --}}

                            <div class="job-tags-row">

                                @if ($workMode)

                                    <span class="tag-pill tag-mode">
                                        {{ ucfirst($workMode) }}
                                    </span>

                                @endif

                                @foreach (array_slice($skills, 0, 4) as $skill)

                                    <span class="tag-pill tag-skill">
                                        {{ $skill }}
                                    </span>

                                @endforeach

                                <span class="job-footer-right">

                                    <span
                                        class="status-badge {{ $isActive ? 'status-active' : 'status-inactive' }}">

                                        {{ $isActive ? 'Active' : 'Inactive' }}

                                    </span>

                                </span>

                            </div>

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

                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="5" width="18" height="14" rx="2"></rect>
                            <path d="M8 10h8M8 14h5"></path>
                        </svg>

                    </div>


                    <h3 class="text-lg font-semibold text-slate-800 mb-1.5">
                        No jobs posted yet
                    </h3>


                    <p class="text-sm text-slate-400 mb-5">
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


                <div class="absolute w-28 h-28 rounded-full bg-white/10 -right-8 -bottom-8"></div>
                <div class="absolute w-16 h-16 rounded-full bg-white/10 right-10 -top-6"></div>


                <h3 class="relative font-bold text-[16px] mb-2">
                    Need to hire faster?
                </h3>


                <p class="relative text-[13px] text-white/85 leading-relaxed mb-4">
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


                <h3 class="text-sm font-bold text-slate-800 mb-3">
                    Job Tips
                </h3>


                <ul class="text-[12px] text-slate-500 leading-7">

                    <li>✓ Keep your job title clear</li>
                    <li>✓ Add relevant skills</li>
                    <li>✓ Mention experience requirements</li>
                    <li>✓ Include salary information</li>
                    <li>✓ Keep your description concise</li>

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


    menus.forEach(function (menu) {

        menu.addEventListener('click', function (event) {

            event.stopPropagation();

        });

    });


})();

</script>

@endsection
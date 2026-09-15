
@extends('layouts.app')

@section('content')

<style>
    :root {
        --cand-blue: #3376f2;
        --cand-blue-dark: #245fd0;
        --cand-blue-light: #eef4ff;
        --cand-text: #172033;
        --cand-muted: #7b8498;
        --cand-border: #e8edf5;
        --cand-bg: #f8fafc;
    }

    .cand-page {
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

    .cand-hero-title {
        letter-spacing: -.035em !important;
    }

    .cand-hero-image {
        border: 0 !important;
        margin: 0 !important;
        box-shadow: none !important;
        filter: none !important;
    }

    /* ============================================================
       FILTER BAR
    ============================================================ */

    .cand-filter-card {
        background: #fff;
        border: 1px solid var(--cand-border);
        border-radius: 14px;
        box-shadow: 0 2px 10px rgba(15, 23, 42, .025);
        padding: 14px 16px;
        margin-bottom: 18px;
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .cand-filter-label {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .04em;
        color: var(--cand-muted);
        margin-right: 2px;
    }

    .cand-filter-card select {
        border: 1px solid #dfe4ec;
        border-radius: 9px;
        background: var(--cand-bg);
        color: var(--cand-text);
        font-size: 12.5px;
        font-weight: 500;
        padding: 8px 12px;
        outline: none;
        transition:
            border-color .2s ease,
            box-shadow .2s ease,
            background .2s ease;
    }

    .cand-filter-card select:focus {
        background: #fff;
        border-color: var(--cand-blue);
        box-shadow: 0 0 0 3px rgba(51, 118, 242, .09);
    }

    /* ============================================================
       CANDIDATE CARD
    ============================================================ */

    .cand-card {
        border: 1px solid var(--cand-border) !important;
        border-radius: 16px !important;
        padding: 22px 24px !important;
        margin-bottom: 14px !important;
        background: #fff;
        box-shadow: 0 2px 10px rgba(15, 23, 42, .025) !important;
        cursor: pointer;
        transition:
            transform .18s ease,
            box-shadow .18s ease,
            border-color .18s ease;

        min-height: 190px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .cand-card:hover {
        transform: translateY(-1px);
        border-color: #d5e1f7 !important;
        box-shadow: 0 8px 22px rgba(37, 99, 235, .065) !important;
    }

    .cand-card-inner {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
        flex: 1;
    }

    .cand-identity {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        min-width: 0;
        flex: 1;
    }

    .cand-avatar {
        width: 54px;
        height: 54px;
        min-width: 54px;
        border-radius: 50%;
        object-fit: cover;
        border: 1px solid var(--cand-border);
        background: var(--cand-bg);
    }

    .cand-avatar-fallback {
        width: 54px;
        height: 54px;
        min-width: 54px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--cand-blue-light);
        color: var(--cand-blue);
        font-weight: 700;
        font-size: 18px;
    }

    .cand-name-row {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 7px;
    }

    .cand-name {
        font-size: 16px;
        font-weight: 700;
        color: var(--cand-text);
        letter-spacing: -.01em;
        margin: 0;
    }

    .cand-interview-slot {
        min-height: 20px;
        margin-top: 8px;
    }

    .cand-status-pill {
        font-size: 11px;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 999px;
        white-space: nowrap;
    }

    .cand-sub-pill {
        font-size: 11px;
        font-weight: 600;
        padding: 4px 12px;
        border-radius: 999px;
        background: var(--cand-bg);
        color: var(--cand-muted);
        border: 1px solid var(--cand-border);
        white-space: nowrap;
    }

    .cand-meta-line {
        font-size: 12.5px;
        color: var(--cand-muted);
        margin-top: 6px;
        line-height: 1.65;
    }

    .cand-meta-line .cand-job-name {
        font-weight: 600;
        color: #475569;
    }

    .cand-interview-line {
        font-size: 12.5px;
        color: #7657e8;
        display: flex;
        align-items: center;
        gap: 6px;
        flex-wrap: wrap;
    }

    .cand-interview-line svg {
        width: 14px;
        height: 14px;
        flex-shrink: 0;
    }

    .cand-rescheduled-tag {
        font-size: 9.5px;
        font-weight: 700;
        padding: 2px 7px;
        border-radius: 6px;
        background: #f1edff;
    }

    /* ============================================================
       ACTION CHIPS
    ============================================================ */

    .cand-actions {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 7px;
        flex-shrink: 0;
    }

    .cand-chip {
        font-size: 11.5px;
        font-weight: 700;
        padding: 8px 15px;
        border-radius: 10px;
        border: none;
        cursor: pointer;
        transition:
            background-color .15s ease,
            transform .15s ease;
        white-space: nowrap;
    }

    .cand-chip:hover {
        transform: translateY(-1px);
    }

    .cand-chip-shortlist {
        background: #fef3c7;
        color: #92400e;
    }

    .cand-chip-shortlist:hover {
        background: #fde8a8;
    }

    .cand-chip-interview {
        background: #f1edff;
        color: #6d3fd6;
    }

    .cand-chip-interview:hover {
        background: #e6ddff;
    }

    .cand-chip-cancel {
        background: var(--cand-bg);
        color: #64748b;
    }

    .cand-chip-cancel:hover {
        background: #eef1f5;
    }

    .cand-chip-hire {
        background: #ecfdf5;
        color: #059669;
    }

    .cand-chip-hire:hover {
        background: #d9f9ea;
    }

    .cand-chip-reject {
        background: #fff1f1;
        color: #dc2626;
    }

    .cand-chip-reject:hover {
        background: #ffe4e4;
    }

    .cand-chip-archive {
        background: var(--cand-bg);
        color: #64748b;
    }

    .cand-chip-archive:hover {
        background: #eef1f5;
    }

    /* ============================================================
       SIDEBAR
    ============================================================ */

    .cand-sidebar-card {
        border-color: var(--cand-border) !important;
        border-radius: 16px !important;
        box-shadow: 0 3px 13px rgba(15, 23, 42, .03) !important;
    }

    .cand-pipeline-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 9px 0;
        border-bottom: 1px solid #f1f5f9;
        font-size: 12.5px;
    }

    .cand-pipeline-row:last-child {
        border-bottom: none;
    }

    .cand-pipeline-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 8px;
    }

    .cand-pipeline-count {
        font-weight: 700;
        color: var(--cand-text);
        background: var(--cand-bg);
        border-radius: 999px;
        padding: 1px 9px;
        font-size: 11.5px;
    }

    /* ============================================================
       EMPTY STATE
    ============================================================ */

    .cand-empty-state {
        border-color: var(--cand-border) !important;
        border-radius: 16px !important;
    }

    /* ============================================================
       MOBILE
    ============================================================ */

    @media (max-width: 767px) {
        .cand-card {
            padding: 18px !important;
            border-radius: 14px !important;
            min-height: 0 !important;
        }

        .cand-card-inner {
            flex-direction: column;
            align-items: stretch;
        }

        .cand-actions {
            width: 100%;
        }

        .cand-hero-title {
            font-size: 30px !important;
        }
    }

    @media (max-width: 575px) {
        .cand-filter-card {
            flex-direction: column;
            align-items: stretch;
        }

        .cand-filter-card select {
            width: 100%;
        }
    }
</style>


<div class="cand-page bg-slate-50 min-h-screen">

    {{-- =========================================================
        HERO SECTION
    ========================================================== --}}

    <div class="bg-gradient-to-b from-[#F5F8FF] via-[#F5F8FF] to-white border-b border-slate-100">

        <div class="max-w-6xl mx-auto px-6 py-11 md:py-13 grid md:grid-cols-2 gap-7 lg:gap-9 items-center">

            {{-- LEFT HERO CONTENT --}}
            <div class="flex flex-col items-start text-left">

                <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-blue-700 bg-blue-100/70 px-3.5 py-1.5 rounded-full mb-4">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M13 2 3 14h7l-1 8 11-14h-7l0-6z"/>
                    </svg>
                    REVIEW APPLICATIONS
                </span>

                <h1 class="cand-hero-title text-4xl sm:text-5xl font-bold text-slate-900 leading-[1.12] tracking-tight mb-4 max-w-lg">
                    Find Your Next
                    <span class="text-blue-600 block">Great Hire</span>
                </h1>

                <p class="text-slate-500 text-base mb-6 max-w-md leading-relaxed">
                    Everyone who has applied to your job postings — shortlist, schedule interviews,
                    and move candidates through your pipeline.
                </p>

                <div class="flex flex-wrap items-center gap-3">
                    <a href="{{ route('employer.jobs.index') }}"
                       class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-6 py-3 rounded-xl transition hover:-translate-y-0.5">
                        View Job Postings
                    </a>
                    <a href="#candidate-list"
                       class="inline-flex items-center gap-2 bg-white border border-slate-200 text-slate-600 hover:text-blue-600 hover:border-blue-300 text-sm font-semibold px-6 py-3 rounded-xl transition">
                        Browse Candidates
                    </a>
                </div>

            </div>

            {{-- RIGHT HERO IMAGE --}}
            <div class="relative flex justify-center md:justify-end">

                <img
                    src="{{ asset('assets/img/vvv.png') }}"
                    alt="Find your next great hire"
                    class="cand-hero-image w-full max-w-sm lg:max-w-[420px] h-auto object-contain"
                    onerror="this.style.display='none'"
                >

                {{-- VERIFIED CANDIDATES --}}
                <div class="absolute top-4 left-0 md:-left-4 flex items-center gap-2 bg-white rounded-xl shadow-lg shadow-blue-900/10 px-3.5 py-2">
                    <span class="w-7 h-7 rounded-lg bg-blue-100 flex items-center justify-center shrink-0 text-blue-600 text-sm">✓</span>
                    <div>
                        <p class="text-xs font-semibold text-slate-800 leading-tight">Verified Candidates</p>
                        <p class="text-[10px] text-slate-400 leading-tight">100% genuine profiles</p>
                    </div>
                </div>

                {{-- SMART MATCHING --}}
                <div class="absolute top-24 right-0 md:right-4 flex items-center gap-2 bg-white rounded-xl shadow-lg shadow-blue-900/10 px-3.5 py-2">
                    <span class="w-7 h-7 rounded-lg bg-violet-100 flex items-center justify-center shrink-0 text-violet-600 text-sm">◈</span>
                    <div>
                        <p class="text-xs font-semibold text-slate-800 leading-tight">Smart Matching</p>
                        <p class="text-[10px] text-slate-400 leading-tight">AI-powered recommendations</p>
                    </div>
                </div>

                {{-- FASTER HIRING --}}
                <div class="absolute bottom-6 left-0 md:-left-6 flex items-center gap-2 bg-white rounded-xl shadow-lg shadow-blue-900/10 px-3.5 py-2">
                    <span class="w-7 h-7 rounded-lg bg-emerald-100 flex items-center justify-center shrink-0 text-emerald-600 text-sm">⚡</span>
                    <div>
                        <p class="text-xs font-semibold text-slate-800 leading-tight">Faster Hiring</p>
                        <p class="text-[10px] text-slate-400 leading-tight">One click to shortlist</p>
                    </div>
                </div>

            </div>

        </div>

    </div>
    {{-- =========================================================
        MAIN CONTENT
    ========================================================== --}}

    <div class="max-w-7xl mx-auto px-4 py-7 md:py-8">

        {{-- SUCCESS MESSAGE --}}
        @if (session('success'))

            <div class="flex items-center gap-2 bg-emerald-50 border border-emerald-100 text-emerald-700 text-sm font-medium rounded-xl px-4 py-3 mb-4">

                <svg class="w-4 h-4 shrink-0"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2.5"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M5 13l4 4L19 7" />

                </svg>

                {{ session('success') }}

            </div>

        @endif


        {{-- =====================================================
            FILTER BAR
        ====================================================== --}}

        <form method="GET" class="cand-filter-card">

            <span class="cand-filter-label">
                Filter
            </span>

            <select name="job" onchange="this.form.submit()">

                <option value="">
                    All Jobs
                </option>

                @foreach ($jobs as $job)

                    <option value="{{ $job->id }}"
                        @selected(request('job') == $job->id)>
                        {{ $job->title }}
                    </option>

                @endforeach

            </select>


            <select name="status" onchange="this.form.submit()">

                <option value="">
                    All Statuses
                </option>

                <option value="applied"
                    @selected(request('status') === 'applied')>
                    Applied ({{ $counts['applied'] ?? 0 }})
                </option>

                <option value="in_progress"
                    @selected(request('status') === 'in_progress')>
                    In Progress ({{ $counts['in_progress'] ?? 0 }})
                </option>

                <option value="interview"
                    @selected(request('status') === 'interview')>
                    Interview ({{ $counts['interview'] ?? 0 }})
                </option>

                <option value="hired"
                    @selected(request('status') === 'hired')>
                    Hired ({{ $counts['hired'] ?? 0 }})
                </option>

                <option value="rejected"
                    @selected(request('status') === 'rejected')>
                    Rejected ({{ $counts['rejected'] ?? 0 }})
                </option>

                <option value="archived"
                    @selected(request('status') === 'archived')>
                    Archived ({{ $counts['archived'] ?? 0 }})
                </option>

            </select>

        </form>


        {{-- =====================================================
            CONTENT LAYOUT
        ====================================================== --}}

        <div class="grid lg:grid-cols-[minmax(0,1fr)_280px] gap-5 lg:gap-6">

            {{-- =================================================
                CANDIDATE LIST
            ================================================== --}}

            <section id="candidate-list" class="min-w-0">

                @php

                    $candStatusColors = [

                        'applied' =>
                            'background:#eef4ff;color:#3376f2;',

                        'in_progress' =>
                            'background:#fef3c7;color:#92400e;',

                        'interview' =>
                            'background:#f1edff;color:#6d3fd6;',

                        'hired' =>
                            'background:#ecfdf5;color:#059669;',

                        'rejected' =>
                            'background:#fff1f1;color:#dc2626;',

                        'archived' =>
                            'background:#f1f5f9;color:#64748b;',
                    ];

                @endphp


                @forelse ($applications as $application)

                    @php

                        $candidate = $application->user;

                        $profile = $candidate?->employeeRegistration;

                        $job = $application->jobPost;

                        $interview = $application->interview;

                        $hasActiveInterview =
                            $interview &&
                            $interview->status !== \App\Models\Interview::STATUS_CANCELLED;

                        $statusLabel =
                            ucwords(
                                str_replace(
                                    '_',
                                    ' ',
                                    $application->status
                                )
                            );

                        $statusStyle =
                            $candStatusColors[$application->status]
                            ?? 'background:#f1f5f9;color:#64748b;';

                    @endphp


                    {{-- CANDIDATE CARD --}}
                    <article
                        data-candidate-open="{{ $application->id }}"
                        class="cand-card">

                        <div class="cand-card-inner">

                            {{-- CANDIDATE IDENTITY --}}
                            <div class="cand-identity">

                                @if ($profile?->profile_photo)

                                    <img
                                        src="{{ asset('storage/' . $profile->profile_photo) }}"
                                        alt=""
                                        class="cand-avatar">

                                @else

                                    <div class="cand-avatar-fallback">
                                        {{ strtoupper(substr($candidate->name ?? 'C', 0, 1)) }}
                                    </div>

                                @endif


                                <div class="min-w-0">

                                    <div class="cand-name-row">

                                        <h3 class="cand-name">
                                            {{ $candidate->name ?? 'Candidate' }}
                                        </h3>

                                        <span
                                            class="cand-status-pill"
                                            style="{{ $statusStyle }}">
                                            {{ $statusLabel }}
                                        </span>

                                        @if ($application->sub_status)

                                            <span class="cand-sub-pill">
                                                {{ $application->sub_status_label }}
                                            </span>

                                        @endif

                                    </div>


                                    <p class="cand-meta-line">

                                        Applied for
                                        <span class="cand-job-name">
                                            {{ $job->title }}
                                        </span>

                                        &middot;

                                        {{ $candidate->email ?? '' }}

                                        &middot;

                                        {{ $application->created_at->diffForHumans() }}

                                    </p>


                                    <div class="cand-interview-slot">

                                        @if ($hasActiveInterview)

                                            <p class="cand-interview-line">

                                                <svg
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    viewBox="0 0 24 24">

                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />

                                                </svg>

                                                Interview:
                                                {{ $interview->scheduled_at->format('D, M j, g:i A') }}

                                                ({{ str_replace('_', ' ', $interview->mode) }})

                                                @if ($interview->status === 'rescheduled')

                                                    <span class="cand-rescheduled-tag">
                                                        Rescheduled
                                                    </span>

                                                @endif

                                            </p>

                                        @endif

                                    </div>

                                </div>

                            </div>


                            {{-- ACTION BUTTONS --}}
                            <div
                                class="cand-actions"
                                onclick="event.stopPropagation()">

                                {{-- SHORTLIST --}}
                                <form
                                    action="{{ route('employer.applicants.updateStatus', $application->id) }}"
                                    method="POST">

                                    @csrf

                                    <input
                                        type="hidden"
                                        name="status"
                                        value="in_progress">

                                    <input
                                        type="hidden"
                                        name="sub_status"
                                        value="shortlisted">

                                    <button
                                        type="submit"
                                        class="cand-chip cand-chip-shortlist">
                                        Shortlist
                                    </button>

                                </form>


                                {{-- INTERVIEW --}}
                                @if ($hasActiveInterview)

                                    <button
                                        type="button"
                                        onclick="document.getElementById('interview-modal-{{ $application->id }}').classList.remove('hidden')"
                                        class="cand-chip cand-chip-interview">

                                        Reschedule

                                    </button>


                                    <form
                                        action="{{ route('employer.applicants.cancelInterview', $application->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Cancel this interview?')">

                                        @csrf

                                        <button
                                            type="submit"
                                            class="cand-chip cand-chip-cancel">
                                            Cancel Interview
                                        </button>

                                    </form>

                                @else

                                    <button
                                        type="button"
                                        onclick="document.getElementById('interview-modal-{{ $application->id }}').classList.remove('hidden')"
                                        class="cand-chip cand-chip-interview">

                                        Interview

                                    </button>

                                @endif


                                {{-- HIRE --}}
                                <form
                                    action="{{ route('employer.applicants.updateStatus', $application->id) }}"
                                    method="POST">

                                    @csrf

                                    <input
                                        type="hidden"
                                        name="status"
                                        value="hired">

                                    <button
                                        type="submit"
                                        class="cand-chip cand-chip-hire">
                                        Hire
                                    </button>

                                </form>


                                {{-- REJECT --}}
                                <form
                                    action="{{ route('employer.applicants.updateStatus', $application->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Reject this candidate?')">

                                    @csrf

                                    <input
                                        type="hidden"
                                        name="status"
                                        value="rejected">

                                    <button
                                        type="submit"
                                        class="cand-chip cand-chip-reject">
                                        Reject
                                    </button>

                                </form>


                                {{-- ARCHIVE --}}
                                <form
                                    action="{{ route('employer.applicants.updateStatus', $application->id) }}"
                                    method="POST">

                                    @csrf

                                    <input
                                        type="hidden"
                                        name="status"
                                        value="archived">

                                    <button
                                        type="submit"
                                        class="cand-chip cand-chip-archive">
                                        Archive
                                    </button>

                                </form>

                            </div>

                        </div>

                    </article>


                    {{-- =================================================
                        CANDIDATE DETAIL TEMPLATE
                    ================================================== --}}

                    <template id="candidate-template-{{ $application->id }}">

                        <div class="flex items-start gap-4">

                            @if ($profile?->profile_photo)

                                <img
                                    src="{{ asset('storage/' . $profile->profile_photo) }}"
                                    alt=""
                                    class="w-16 h-16 rounded-xl object-cover shrink-0">

                            @else

                                <div class="w-16 h-16 rounded-xl bg-brand/10 text-brand flex items-center justify-center shrink-0 font-bold text-xl">

                                    {{ strtoupper(substr($candidate->name ?? 'C', 0, 1)) }}

                                </div>

                            @endif


                            <div class="min-w-0">

                                <h2 class="font-display font-bold text-xl text-gray-900">
                                    {{ $candidate->name ?? 'Candidate' }}
                                </h2>

                                <p class="text-sm text-gray-500 mt-1">
                                    {{ $candidate->email ?? '' }}
                                </p>

                                @if ($candidate->phone)

                                    <p class="text-sm text-gray-500">
                                        {{ $candidate->phone }}
                                    </p>

                                @endif

                            </div>

                        </div>


                        <div class="mt-6 grid grid-cols-2 gap-4 text-sm">

                            <div>

                                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wide">
                                    Applied For
                                </p>

                                <p class="text-gray-800 mt-0.5">
                                    {{ $job->title }}
                                </p>

                            </div>


                            @if ($profile?->designation)

                                <div>

                                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wide">
                                        Current Designation
                                    </p>

                                    <p class="text-gray-800 mt-0.5">
                                        {{ $profile->designation }}
                                    </p>

                                </div>

                            @endif


                            @if ($profile?->company_name)

                                <div>

                                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wide">
                                        Current Company
                                    </p>

                                    <p class="text-gray-800 mt-0.5">
                                        {{ $profile->company_name }}
                                    </p>

                                </div>

                            @endif


                            @if (!is_null($profile?->experience_years))

                                <div>

                                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wide">
                                        Experience
                                    </p>

                                    <p class="text-gray-800 mt-0.5">
                                        {{ $profile->experience_years }} years
                                    </p>

                                </div>

                            @endif


                            @if ($profile?->current_ctc)

                                <div>

                                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wide">
                                        Current CTC
                                    </p>

                                    <p class="text-gray-800 mt-0.5">
                                        {{ $profile->current_ctc }}
                                    </p>

                                </div>

                            @endif


                            @if ($profile?->expected_ctc)

                                <div>

                                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wide">
                                        Expected CTC
                                    </p>

                                    <p class="text-gray-800 mt-0.5">
                                        {{ $profile->expected_ctc }}
                                    </p>

                                </div>

                            @endif


                            @if ($profile?->linkedin)

                                <div class="col-span-2">

                                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wide">
                                        LinkedIn
                                    </p>

                                    <a
                                        href="{{ $profile->linkedin }}"
                                        target="_blank"
                                        rel="noopener"
                                        class="text-brand hover:underline mt-0.5 inline-block break-all">

                                        {{ $profile->linkedin }}

                                    </a>

                                </div>

                            @endif

                        </div>


                        {{-- SKILLS --}}
                        @if ($profile?->skills)

                            <div class="mt-5">

                                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wide mb-2">
                                    Skills
                                </p>

                                <div class="flex flex-wrap gap-1.5">

                                    @foreach (
                                        is_array($profile->skills)
                                            ? $profile->skills
                                            : explode(',', $profile->skills)
                                        as $skill
                                    )

                                        <span class="text-[11px] font-medium px-2.5 py-1 rounded-full bg-gray-50 text-gray-600 border border-gray-200">
                                            {{ trim($skill) }}
                                        </span>

                                    @endforeach

                                </div>

                            </div>

                        @endif


                        {{-- DOCUMENTS --}}
                        <div class="flex items-center gap-3 mt-6 pt-6 border-t border-gray-100">

                            @if ($profile?->resume)

                                <a
                                    href="{{ asset('storage/' . $profile->resume) }}"
                                    target="_blank"
                                    class="inline-flex items-center gap-2 text-sm font-semibold px-4 py-2.5 rounded-xl bg-brand text-white hover:bg-brand/90 transition-colors">

                                    <svg
                                        class="w-4 h-4"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        viewBox="0 0 24 24">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 10v6m0 0l-3-3m3 3l3-3M5 21h14a2 2 0 002-2V7.5L14.5 3H5a2 2 0 00-2 2v14a2 2 0 002 2z" />

                                    </svg>

                                    View Resume

                                </a>

                            @endif


                            @if ($profile?->experience_proof)

                                <a
                                    href="{{ asset('storage/' . $profile->experience_proof) }}"
                                    target="_blank"
                                    class="inline-flex items-center gap-2 text-sm font-semibold px-4 py-2.5 rounded-xl bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors">

                                    View Experience Proof

                                </a>

                            @endif


                            @if (!$profile?->resume && !$profile?->experience_proof)

                                <p class="text-xs text-gray-400">
                                    No documents uploaded.
                                </p>

                            @endif

                        </div>

                    </template>


                    {{-- =================================================
                        SCHEDULE / RESCHEDULE INTERVIEW MODAL
                    ================================================== --}}

                    <div
                        id="interview-modal-{{ $application->id }}"
                        class="hidden fixed inset-0 z-50">

                        <div
                            class="absolute inset-0 bg-black/40"
                            onclick="document.getElementById('interview-modal-{{ $application->id }}').classList.add('hidden')">
                        </div>


                        <div class="relative min-h-full flex items-center justify-center p-4">

                            <div class="bg-white rounded-2xl shadow-lg w-full max-w-md p-6">

                                <h3 class="font-display font-bold text-base text-gray-900 mb-4">

                                    {{ $hasActiveInterview ? 'Reschedule' : 'Schedule' }}
                                    Interview —
                                    {{ $candidate->name ?? 'Candidate' }}

                                </h3>


                                <form
                                    action="{{ route('employer.applicants.scheduleInterview', $application->id) }}"
                                    method="POST"
                                    class="space-y-3">

                                    @csrf


                                    {{-- DATE & TIME --}}
                                    <div>

                                        <label class="text-xs font-semibold text-gray-600">
                                            Date & Time
                                        </label>

                                        <input
                                            type="datetime-local"
                                            name="scheduled_at"
                                            required
                                            value="{{ old('scheduled_at', $interview?->scheduled_at?->format('Y-m-d\TH:i')) }}"
                                            class="w-full mt-1 text-sm border border-gray-200 rounded-lg px-3 py-2 outline-none">

                                    </div>


                                    {{-- MODE --}}
                                    <div>

                                        <label class="text-xs font-semibold text-gray-600">
                                            Mode
                                        </label>

                                        <select
                                            name="mode"
                                            required
                                            class="w-full mt-1 text-sm border border-gray-200 rounded-lg px-3 py-2 outline-none">

                                            <option
                                                value="online"
                                                @selected(($interview?->mode ?? '') === 'online')>
                                                Online
                                            </option>

                                            <option
                                                value="in_person"
                                                @selected(($interview?->mode ?? '') === 'in_person')>
                                                In Person
                                            </option>

                                            <option
                                                value="phone"
                                                @selected(($interview?->mode ?? '') === 'phone')>
                                                Phone
                                            </option>

                                        </select>

                                    </div>


                                    {{-- LOCATION / LINK --}}
                                    <div>

                                        <label class="text-xs font-semibold text-gray-600">
                                            Location / Link
                                        </label>

                                        <input
                                            type="text"
                                            name="location"
                                            value="{{ old('location', $interview?->location) }}"
                                            placeholder="Meeting link or office address"
                                            class="w-full mt-1 text-sm border border-gray-200 rounded-lg px-3 py-2 outline-none">

                                    </div>


                                    {{-- BUTTONS --}}
                                    <div class="flex items-center justify-end gap-2 pt-2">

                                        <button
                                            type="button"
                                            onclick="document.getElementById('interview-modal-{{ $application->id }}').classList.add('hidden')"
                                            class="text-xs font-semibold px-4 py-2 rounded-lg bg-gray-100 text-gray-600 hover:bg-gray-200">

                                            Cancel

                                        </button>


                                        <button
                                            type="submit"
                                            class="text-xs font-semibold px-4 py-2 rounded-lg bg-violet-600 text-white hover:bg-violet-700">

                                            {{ $hasActiveInterview ? 'Confirm Reschedule' : 'Confirm Interview' }}

                                        </button>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                @empty

                    {{-- =================================================
                        EMPTY STATE
                    ================================================== --}}

                    <div class="cand-empty-state bg-white border border-slate-200 rounded-2xl shadow-sm py-14 px-6 text-center">

                        <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center">

                            <svg
                                class="w-6 h-6"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2">

                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>

                                <circle
                                    cx="9"
                                    cy="7"
                                    r="4">
                                </circle>

                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>

                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>

                            </svg>

                        </div>


                        <h3 class="text-lg font-semibold text-slate-800 mb-1.5">
                            No candidates yet
                        </h3>

                        <p class="text-sm text-slate-400 mb-5">
                            Once someone applies to your jobs, they'll show up here.
                        </p>


                        <a
                            href="{{ route('employer.jobs.index') }}"
                            class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-6 py-3 rounded-xl transition">

                            View Job Postings

                        </a>

                    </div>

                @endforelse


                {{-- PAGINATION --}}
                <div class="mt-5 text-sm">
                    {{ $applications->onEachSide(1)->links() }}
                </div>

            </section>


            {{-- =================================================
                SIDEBAR
            ================================================== --}}

            <aside class="space-y-4">

                {{-- PIPELINE SUMMARY --}}
                <div class="cand-sidebar-card bg-white border border-slate-200 rounded-2xl shadow-sm p-5">

                    <h3 class="text-sm font-bold text-slate-800 mb-3">
                        Pipeline Summary
                    </h3>


                    <div class="cand-pipeline-row">

                        <span>
                            <span
                                class="cand-pipeline-dot"
                                style="background:#3376f2;">
                            </span>
                            Applied
                        </span>

                        <span class="cand-pipeline-count">
                            {{ $counts['applied'] ?? 0 }}
                        </span>

                    </div>


                    <div class="cand-pipeline-row">

                        <span>
                            <span
                                class="cand-pipeline-dot"
                                style="background:#d97706;">
                            </span>
                            In Progress
                        </span>

                        <span class="cand-pipeline-count">
                            {{ $counts['in_progress'] ?? 0 }}
                        </span>

                    </div>


                    <div class="cand-pipeline-row">

                        <span>
                            <span
                                class="cand-pipeline-dot"
                                style="background:#7c3aed;">
                            </span>
                            Interview
                        </span>

                        <span class="cand-pipeline-count">
                            {{ $counts['interview'] ?? 0 }}
                        </span>

                    </div>


                    <div class="cand-pipeline-row">

                        <span>
                            <span
                                class="cand-pipeline-dot"
                                style="background:#059669;">
                            </span>
                            Hired
                        </span>

                        <span class="cand-pipeline-count">
                            {{ $counts['hired'] ?? 0 }}
                        </span>

                    </div>


                    <div class="cand-pipeline-row">

                        <span>
                            <span
                                class="cand-pipeline-dot"
                                style="background:#dc2626;">
                            </span>
                            Rejected
                        </span>

                        <span class="cand-pipeline-count">
                            {{ $counts['rejected'] ?? 0 }}
                        </span>

                    </div>


                    <div class="cand-pipeline-row">

                        <span>
                            <span
                                class="cand-pipeline-dot"
                                style="background:#64748b;">
                            </span>
                            Archived
                        </span>

                        <span class="cand-pipeline-count">
                            {{ $counts['archived'] ?? 0 }}
                        </span>

                    </div>

                </div>


                {{-- HIRING TIPS --}}
                <div class="cand-sidebar-card bg-white border border-slate-200 rounded-2xl shadow-sm p-5">

                    <h3 class="text-sm font-bold text-slate-800 mb-3">
                        Hiring Tips
                    </h3>

                    <ul class="text-[12px] text-slate-500 leading-7">

                        <li>
                            ✓ Shortlist promising candidates early
                        </li>

                        <li>
                            ✓ Schedule interviews within a few days
                        </li>

                        <li>
                            ✓ Keep candidates updated on their status
                        </li>

                        <li>
                            ✓ Review resumes before the interview
                        </li>

                        <li>
                            ✓ Archive stale applications to stay organized
                        </li>

                    </ul>

                </div>

            </aside>

        </div>

    </div>

</div>


{{-- =============================================================
     CANDIDATE DETAIL MODAL
============================================================== --}}

<div
    id="candidate-modal"
    class="hidden fixed inset-0 z-[1100]">

    <div
        id="candidate-modal-backdrop"
        class="absolute inset-0 bg-black/40 backdrop-blur-sm">
    </div>


    <div class="relative min-h-full flex items-start justify-center p-4 sm:p-6 pt-24 sm:pt-28">

        <div class="bg-white rounded-2xl shadow-lg ring-1 ring-black/[0.03] w-full max-w-2xl max-h-[75vh] flex flex-col overflow-hidden">

            {{-- MODAL HEADER --}}
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 shrink-0">

                <h2 class="font-display font-bold text-lg text-gray-900">
                    Candidate Details
                </h2>


                <button
                    type="button"
                    id="candidate-modal-close"
                    aria-label="Close"
                    class="w-9 h-9 flex items-center justify-center rounded-lg border border-gray-200 text-gray-500 hover:text-gray-700 hover:bg-gray-50 transition-colors">

                    <svg
                        class="w-4 h-4"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6 18L18 6M6 6l12 12" />

                    </svg>

                </button>

            </div>


            {{-- MODAL CONTENT --}}
            <div
                id="candidate-modal-content"
                class="overflow-y-auto p-6">
            </div>

        </div>

    </div>

</div>


<script>
(function () {

    var modal = document.getElementById('candidate-modal');

    var content = document.getElementById('candidate-modal-content');


    function openModal(id) {

        var tpl =
            document.getElementById(
                'candidate-template-' + id
            );

        if (!tpl) {
            return;
        }

        content.innerHTML = '';

        content.appendChild(
            tpl.content.cloneNode(true)
        );

        modal.classList.remove('hidden');

        document.body.style.overflow = 'hidden';
    }


    function closeModal() {

        modal.classList.add('hidden');

        content.innerHTML = '';

        document.body.style.overflow = '';
    }


    document.addEventListener('click', function (e) {

        var trigger =
            e.target.closest(
                '[data-candidate-open]'
            );


        if (trigger) {

            openModal(
                trigger.getAttribute(
                    'data-candidate-open'
                )
            );

            return;
        }


        if (
            e.target.closest(
                '#candidate-modal-close'
            )
            ||
            e.target.id ===
                'candidate-modal-backdrop'
        ) {

            closeModal();

        }

    });


    document.addEventListener('keydown', function (e) {

        if (e.key === 'Escape') {

            closeModal();

        }

    });

})();
</script>

@endsection

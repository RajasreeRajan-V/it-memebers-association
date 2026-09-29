@extends('layouts.app')

@section('content')

<style>
    /* ============================================================
       PROJECTS PAGE (styled to match Job Posts page)
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

    .project-posts-page {
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
       PROJECT CARD
    ============================================================ */

    .project-card {
        position: relative;
        z-index: 1;
        border: 1px solid #e8edf5 !important;
        border-radius: 17px !important;
        padding: 21px 22px !important;
        margin-bottom: 16px !important;
        background: #fff;
        box-shadow: 0 2px 10px rgba(15, 23, 42, .025) !important;
        transition:
            transform .18s ease,
            box-shadow .18s ease,
            border-color .18s ease;
    }

    .project-card:hover {
        transform: translateY(-1px);
        border-color: #d5e1f7 !important;
        box-shadow:
            0 8px 22px rgba(37, 99, 235, .065) !important;
    }

    .project-card.menu-active {
        z-index: 50 !important;
    }

    .project-card-inner {
        display: flex;
        align-items: flex-start;
        gap: 16px !important;
    }


    /* ============================================================
       PROJECT TYPE ICON
    ============================================================ */

    .project-type-icon {
        position: relative;
        width: 55px !important;
        height: 55px !important;
        min-width: 55px;
        border-radius: 14px !important;
        overflow: hidden;
        background: #eef4ff;
        border: 1px solid #e7ecf4;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #3376f2;
        font-weight: 700;
        font-size: 19px;
        box-shadow: 0 3px 9px rgba(15, 23, 42, .035);
    }


    /* ============================================================
       PROJECT CONTENT
    ============================================================ */

    .project-content {
        flex: 1;
        min-width: 0;
    }

    .project-top-row {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px !important;
    }

    .project-title-row {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 6px;
    }

    .project-title {
        font-size: 16.5px !important;
        line-height: 1.35 !important;
        font-weight: 700;
        color: #172033;
        letter-spacing: -.01em;
        margin: 0;
    }

    .project-type-tag {
        margin-top: 3px !important;
        display: inline-block;
        font-size: 12.5px !important;
        line-height: 1.4;
        font-weight: 600;
        color: #3376f2;
    }


    /* ============================================================
       ACTION AREA
    ============================================================ */

    .project-actions {
        display: flex;
        align-items: flex-start !important;
        gap: 10px !important;
        flex-shrink: 0;
    }

    .project-posted-info {
        text-align: right;
    }

    .posted-text {
        font-size: 11px !important;
        color: #9aa3b2;
        font-weight: 500;
        line-height: 1.4;
        white-space: nowrap;
    }

    .status-badge {
        display: inline-block;
        margin-top: 4px;
        padding: 3px 9px;
        border-radius: 999px;
        font-size: 10px !important;
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

    .project-menu {
        position: relative;
        z-index: 60;
    }

    .project-menu > summary {
        width: 34px !important;
        height: 34px !important;
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

    .project-menu > summary::-webkit-details-marker {
        display: none;
    }

    .project-menu > summary::marker {
        display: none;
    }

    .project-menu > summary:hover {
        color: #3376f2;
        border-color: #c9dafa;
        background: #f8fbff;
    }

    .project-menu[open] > summary {
        color: #2563eb;
        border-color: #93c5fd;
        background: #f8fbff;
    }

    .project-menu-panel {
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
        animation: projectMenuIn .14s ease-out;
        transform-origin: top right;
    }

    @keyframes projectMenuIn {
        from {
            opacity: 0;
            transform: scale(.97) translateY(-4px);
        }

        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    .project-menu-panel a,
    .project-menu-panel button {
        border-radius: 8px;
    }


    /* ============================================================
       PROJECT META
    ============================================================ */

    .project-meta {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 14px !important;
        margin-top: 11px !important;
    }

    .project-meta-item {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 12.5px !important;
        color: #7b8498;
        line-height: 1.5;
    }

    .project-meta-item svg {
        width: 14px !important;
        height: 14px !important;
        color: #9aa4b3;
        flex-shrink: 0;
    }

    .project-meta-budget {
        color: #059669 !important;
        font-weight: 600;
    }


    /* ============================================================
       FILTER BAR
    ============================================================ */

    .project-filters {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .project-filters input,
    .project-filters select {
        border: 1px solid #e8edf5;
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 13px;
        color: var(--text);
        background: #fff;
    }

    .project-filters input {
        flex: 1;
        min-width: 220px;
    }

    .project-filters input:focus,
    .project-filters select:focus {
        outline: none;
        border-color: #93c5fd;
        box-shadow: 0 0 0 3px rgba(51, 118, 242, .10);
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

        .project-card {
            padding: 17px !important;
            border-radius: 15px !important;
        }

        .project-card-inner {
            gap: 12px !important;
        }

        .project-type-icon {
            width: 49px !important;
            height: 49px !important;
            min-width: 49px !important;
        }

        .project-top-row {
            flex-direction: column;
            align-items: stretch !important;
            gap: 9px !important;
        }

        .project-actions {
            width: 100%;
            justify-content: space-between;
            align-items: center !important;
        }

        .project-posted-info {
            text-align: left !important;
        }

        .project-menu {
            margin-left: auto;
        }

        .project-menu-panel {
            right: 0;
            width: 180px;
        }

        .project-title {
            font-size: 15.5px !important;
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

        .project-meta {
            gap: 9px !important;
        }

        .project-menu-panel {
            width: 175px;
        }
    }


    @media (max-width: 1023px) {

        .project-posts-page .hero-title {
            font-size: 42px !important;
        }
    }
</style>

<div class="project-posts-page bg-slate-50 min-h-screen">

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

                HIRE TOP FREELANCERS

            </span>


            <h1
                class="hero-title text-4xl sm:text-5xl font-bold text-slate-900 leading-[1.12] tracking-tight mb-4 max-w-lg">

                Get Projects Done,

                <span class="text-blue-600 block">
                    Hire Top Talent
                </span>

            </h1>


            <p
                class="text-slate-500 text-base mb-6 max-w-md leading-relaxed">

                Post your project, review proposals, and work with skilled
                freelancers who deliver quality on time.

            </p>


            <div
                class="hero-buttons flex flex-wrap items-center gap-3">

                <a
                    href="{{ route('employer.projects.create') }}"
                    class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-6 py-3 rounded-xl transition hover:-translate-y-0.5">

                    <span class="text-base leading-none">
                        ＋
                    </span>

                    Post a Project

                </a>


                <a
                    href="#project-list"
                    class="inline-flex items-center gap-2 bg-white border border-slate-200 text-slate-600 hover:text-blue-600 hover:border-blue-300 text-sm font-semibold px-6 py-3 rounded-xl transition">

                    Browse Projects

                </a>

            </div>

        </div>


        {{-- RIGHT HERO IMAGE --}}

        <div
            class="relative flex justify-center md:justify-end">

            <img
                src="{{ asset('assets/img/ooo.png') }}"
                alt="Find the right freelancer"
                class="w-full max-w-sm lg:max-w-[420px] h-auto rounded-xl object-contain drop-shadow-[0_18px_35px_rgba(51,118,242,0.10)]"
                onerror="this.style.display='none'"
            >


            {{-- VERIFIED FREELANCERS --}}

            <div
                class="absolute top-4 left-0 md:-left-4 flex items-center gap-2 bg-white rounded-xl shadow-lg shadow-blue-900/10 px-3.5 py-2">

                <span
                    class="w-7 h-7 rounded-lg bg-blue-100 flex items-center justify-center shrink-0 text-blue-600 text-sm">

                    ✓

                </span>

                <div>

                    <p class="text-xs font-semibold text-slate-800 leading-tight">
                        Verified Freelancers
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


            {{-- FASTER DELIVERY --}}

            <div
                class="absolute bottom-6 left-0 md:-left-6 flex items-center gap-2 bg-white rounded-xl shadow-lg shadow-blue-900/10 px-3.5 py-2">

                <span
                    class="w-7 h-7 rounded-lg bg-emerald-100 flex items-center justify-center shrink-0 text-emerald-600 text-sm">

                    ⚡

                </span>

                <div>

                    <p class="text-xs font-semibold text-slate-800 leading-tight">
                        Faster Delivery
                    </p>

                    <p class="text-[10px] text-slate-400 leading-tight">
                        Close projects in days
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
            PROJECT LIST
        ================================================== --}}

        <section
            id="project-list"
            class="min-w-0">


            {{-- FILTER BAR --}}

            <form
                method="GET"
                class="project-filters">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search by title...">

                <select name="status">
                    <option value="">All Statuses</option>
                    <option value="active" @selected(request('status') == 'active')>Active</option>
                    <option value="deactive" @selected(request('status') == 'deactive')>Deactive</option>
                </select>

                <button
                    type="submit"
                    class="inline-flex items-center gap-2 bg-white border border-slate-200 text-slate-600 hover:text-blue-600 hover:border-blue-300 text-sm font-semibold px-5 rounded-xl transition">

                    Filter

                </button>

            </form>


            @forelse ($projects as $project)

                @php

                    $location = trim(

                        ($project->city ?: '')
                        .
                        ($project->city && $project->state ? ', ' : '')
                        .
                        ($project->state ?: '')

                    );


                    $isActive =
                        $project->status === 'active';

                @endphp


                {{-- =================================================
                    PROJECT CARD
                ================================================== --}}

                <article
                    class="project-card">


                    <div
                        class="project-card-inner">


                        {{-- TYPE ICON --}}

                        <div
                            class="project-type-icon">

                            <svg
                                class="w-5 h-5"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2">

                                <path d="M3 7l9-4 9 4-9 4-9-4Z"></path>
                                <path d="M3 7v10l9 4 9-4V7"></path>
                                <path d="M12 11v10"></path>

                            </svg>

                        </div>


                        {{-- CONTENT --}}

                        <div
                            class="project-content">


                            {{-- TOP ROW --}}

                            <div
                                class="project-top-row">


                                <div class="min-w-0">

                                    <div
                                        class="project-title-row">

                                        <h2
                                            class="project-title">

                                            {{ $project->title }}

                                        </h2>

                                    </div>


                                    <p
                                        class="project-type-tag">

                                        {{ ucfirst($project->project_type) }} Project

                                    </p>

                                </div>


                                {{-- ACTION AREA --}}

                                <div
                                    class="project-actions">


                                    <div
                                        class="project-posted-info">

                                        <p
                                            class="posted-text">

                                            Posted
                                            {{ optional($project->created_at)->diffForHumans() }}

                                        </p>


                                        <span
                                            class="status-badge
                                            {{ $isActive
                                                ? 'status-active'
                                                : 'status-inactive'
                                            }}">

                                            {{ ucfirst($project->status) }}

                                        </span>

                                    </div>


                                    {{-- 3 DOT MENU --}}

                                    <details
                                        class="project-menu">


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


                                        <div
                                            class="project-menu-panel">


                                            {{-- VIEW --}}

                                            <a
                                                href="{{ route('employer.projects.show', $project) }}"
                                                class="flex items-center gap-2.5 px-3.5 py-2.5 text-[12px] font-medium text-slate-600 hover:bg-slate-50 hover:text-blue-600 transition">

                                                <svg
                                                    class="w-4 h-4 shrink-0"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2">

                                                    <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z"></path>
                                                    <circle cx="12" cy="12" r="3"></circle>

                                                </svg>

                                                View Project

                                            </a>


                                            {{-- EDIT --}}

                                            <a
                                                href="{{ route('employer.projects.edit', $project) }}"
                                                class="flex items-center gap-2.5 px-3.5 py-2.5 text-[12px] font-medium text-slate-600 hover:bg-slate-50 hover:text-blue-600 transition">

                                                <svg
                                                    class="w-4 h-4 shrink-0"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2">

                                                    <path d="M12 20h9"></path>
                                                    <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4Z"></path>

                                                </svg>

                                                Edit Project

                                            </a>


                                            {{-- TOGGLE STATUS --}}

                                            <form
                                                action="{{ route('employer.projects.toggle-status', $project) }}"
                                                method="POST">

                                                @csrf
                                                @method('PATCH')

                                                <button
                                                    type="submit"
                                                    class="w-full flex items-center gap-2.5 px-3.5 py-2.5 text-[12px] font-medium text-slate-600 hover:bg-slate-50 hover:text-blue-600 transition text-left">

                                                    <svg
                                                        class="w-4 h-4 shrink-0"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        stroke-width="2">

                                                        <path d="M8 3 4 7l4 4"></path>
                                                        <path d="M4 7h11a5 5 0 0 1 5 5v1"></path>
                                                        <path d="M16 21l4-4-4-4"></path>
                                                        <path d="M20 17H9a5 5 0 0 1-5-5v-1"></path>

                                                    </svg>

                                                    {{ $isActive ? 'Deactivate' : 'Activate' }}

                                                </button>

                                            </form>


                                            <div class="my-1 border-t border-slate-100"></div>


                                            {{-- DELETE --}}

                                            <form
                                                action="{{ route('employer.projects.destroy', $project) }}"
                                                method="POST"
                                                onsubmit="return confirm('Delete this project? This cannot be undone.');">

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


                            {{-- META --}}

                            <div
                                class="project-meta">


                                {{-- BUDGET --}}

                                @if (!empty($project->budget))

                                    <span
                                        class="project-meta-item project-meta-budget">

                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2">

                                            <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7H14a3.5 3.5 0 0 1 0 7H6"></path>

                                        </svg>

                                        {{ $project->budget }}

                                    </span>

                                @endif


                                {{-- PROJECT TYPE --}}

                                <span
                                    class="project-meta-item">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2">

                                        <rect x="3" y="7" width="18" height="13" rx="2"></rect>
                                        <path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>

                                    </svg>

                                    {{ ucfirst($project->project_type) }}

                                </span>


                                {{-- DURATION --}}

                                <span
                                    class="project-meta-item">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2">

                                        <circle cx="12" cy="12" r="9"></circle>
                                        <path d="M12 7v5l3 3"></path>

                                    </svg>

                                    {{ $project->duration }}

                                </span>


                                {{-- LOCATION --}}

                                @if ($location)

                                    <span
                                        class="project-meta-item">

                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2">

                                            <path d="M12 21s-7-6.1-7-11a7 7 0 0 1 14 0c0 4.9-7 11-7 11z"></path>
                                            <circle cx="12" cy="10" r="2.5"></circle>

                                        </svg>

                                        {{ $location }}

                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>

                </article>


            @empty


                {{-- EMPTY STATE --}}

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

                            <rect x="3" y="5" width="18" height="14" rx="2"></rect>
                            <path d="M8 10h8M8 14h5"></path>

                        </svg>

                    </div>


                    <h3
                        class="text-lg font-semibold text-slate-800 mb-1.5">

                        No projects posted yet

                    </h3>


                    <p
                        class="text-sm text-slate-400 mb-5">

                        Start attracting skilled freelancers by posting your first project.

                    </p>


                    <a
                        href="{{ route('employer.projects.create') }}"
                        class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-6 py-3 rounded-xl transition">

                        + Post a Project

                    </a>

                </div>

            @endforelse


            {{-- PAGINATION --}}

            <div class="mt-5 text-sm">

                {{ $projects->withQueryString()->links() }}

            </div>

        </section>


        {{-- =====================================================
            SIDEBAR
        ====================================================== --}}

        <aside class="space-y-4">


            {{-- POST PROJECT CTA --}}

            <div
                class="listing-sidebar-card relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-600 to-violet-600 text-white p-5 shadow-lg shadow-blue-900/15">


                <div class="absolute w-28 h-28 rounded-full bg-white/10 -right-8 -bottom-8"></div>
                <div class="absolute w-16 h-16 rounded-full bg-white/10 right-10 -top-6"></div>


                <h3
                    class="relative font-bold text-[16px] mb-2">

                    Need it done right?

                </h3>


                <p
                    class="relative text-[13px] text-white/85 leading-relaxed mb-4">

                    Post your project and connect with skilled freelancers
                    ready to deliver quality work.

                </p>


                <a
                    href="{{ route('employer.projects.create') }}"
                    class="relative inline-flex items-center gap-1.5 bg-white text-blue-600 hover:bg-slate-50 text-[13px] font-bold px-4 py-2.5 rounded-lg transition">

                    Create Project →

                </a>

            </div>


            {{-- PROJECT TIPS --}}

            <div
                class="listing-sidebar-card bg-white border border-slate-200 rounded-2xl shadow-sm p-5">


                <h3
                    class="text-sm font-bold text-slate-800 mb-3">

                    Project Tips

                </h3>


                <ul
                    class="text-[12px] text-slate-500 leading-7">

                    <li>✓ Keep your title clear</li>
                    <li>✓ Set a realistic budget</li>
                    <li>✓ Mention the expected duration</li>
                    <li>✓ List required skills</li>
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
        document.querySelectorAll('.project-menu');


    function closeOtherMenus(currentMenu) {

        menus.forEach(function (menu) {

            if (menu !== currentMenu) {

                menu.removeAttribute('open');

                const card =
                    menu.closest('.project-card');

                if (card) {

                    card.classList.remove('menu-active');

                }

            }

        });

    }


    menus.forEach(function (menu) {

        menu.addEventListener('toggle', function () {

            const card =
                menu.closest('.project-card');


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
                    menu.closest('.project-card');

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
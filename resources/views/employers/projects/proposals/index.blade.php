{{-- resources/views/employer/projects/proposals/index.blade.php --}}
@extends('layouts.app')

@section('content')

    <style>
        /* ============================================================
                                                           PROJECT PROPOSALS PAGE
                                                        ============================================================ */

        :root {
            --blue: #3376f2;
            --blue-dark: #245fd0;
            --blue-light: #eef4ff;
            --text: #172033;
            --muted: #7b8498;
            --border: #e8edf5;
        }

        .proposals-page {
            font-family: Inter, Poppins, ui-sans-serif, system-ui, -apple-system,
                BlinkMacSystemFont, "Segoe UI", sans-serif;
        }


        /* ============================================================
                                                           PAGE HEADER
                                                        ============================================================ */

        .proposals-header {
            background: linear-gradient(to bottom, #F5F8FF, #F5F8FF 60%, #fff);
            border-bottom: 1px solid #eef2f8;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12.5px;
            font-weight: 600;
            color: #7b8498;
            transition: color .16s ease;
        }

        .back-link:hover {
            color: #3376f2;
        }

        .proposals-title {
            font-size: 25px;
            font-weight: 700;
            letter-spacing: -.025em;
            color: #172033;
            line-height: 1.25;
        }

        .header-chip {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 600;
            background: #fff;
            border: 1px solid #e8edf5;
            color: #7b8498;
        }

        .header-chip.chip-blue {
            background: #eef4ff;
            border-color: #dbe7ff;
            color: #3376f2;
        }

        .header-chip.chip-emerald {
            background: #ecfdf5;
            border-color: #d1fae5;
            color: #059669;
        }


        /* ============================================================
                                                           STAT CARDS
                                                        ============================================================ */

        .stat-card {
            background: #fff;
            border: 1px solid #e8edf5;
            border-radius: 14px;
            padding: 13px 15px;
            box-shadow: 0 2px 10px rgba(15, 23, 42, .025);
            transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease;
        }

        .stat-card:hover {
            transform: translateY(-1px);
            border-color: #d5e1f7;
            box-shadow: 0 8px 22px rgba(37, 99, 235, .065);
        }

        .stat-label {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .05em;
            color: #9aa3b2;
        }

        .stat-value {
            font-size: 21px;
            font-weight: 700;
            color: #172033;
            line-height: 1.2;
            margin-top: 3px;
        }

        .stat-value.is-blue {
            color: #3376f2;
        }

        .stat-value.is-amber {
            color: #d97706;
        }

        .stat-value.is-violet {
            color: #7c3aed;
        }

        .stat-value.is-emerald {
            color: #059669;
        }


        /* ============================================================
                                                           FILTER BAR
                                                        ============================================================ */

        .proposal-filters {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 18px;
        }

        .proposal-filters input,
        .proposal-filters select {
            border: 1px solid #e8edf5;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 13px;
            color: var(--text);
            background: #fff;
        }

        .proposal-filters input {
            flex: 1;
            min-width: 220px;
        }

        .proposal-filters input:focus,
        .proposal-filters select:focus {
            outline: none;
            border-color: #93c5fd;
            box-shadow: 0 0 0 3px rgba(51, 118, 242, .10);
        }

        .filter-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #fff;
            border: 1px solid #e8edf5;
            color: #64748b;
            font-size: 13px;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 12px;
            transition: all .16s ease;
        }

        .filter-btn:hover {
            color: #3376f2;
            border-color: #c9dafa;
        }


        /* ============================================================
                                                           PROPOSAL CARD
                                                        ============================================================ */

        .proposal-card {
            position: relative;
            z-index: 1;
            border: 1px solid #e8edf5 !important;
            border-radius: 17px !important;
            padding: 20px 21px !important;
            margin-bottom: 15px !important;
            background: #fff;
            box-shadow: 0 2px 10px rgba(15, 23, 42, .025) !important;
            transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease;
        }

        .proposal-card:hover {
            transform: translateY(-1px);
            border-color: #d5e1f7 !important;
            box-shadow: 0 8px 22px rgba(37, 99, 235, .065) !important;
        }

        .proposal-card.menu-active {
            z-index: 50 !important;
        }

        .proposal-card.is-accepted {
            border-color: #bbf7d0 !important;
            background: linear-gradient(180deg, #f7fffb 0%, #ffffff 55%);
        }

        .proposal-inner {
            display: flex;
            align-items: flex-start;
            gap: 15px;
        }


        /* ============================================================
                                                           AVATAR
                                                        ============================================================ */

        .proposal-avatar {
            width: 52px;
            height: 52px;
            min-width: 52px;
            border-radius: 14px;
            overflow: hidden;
            background: #eef4ff;
            border: 1px solid #e7ecf4;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #3376f2;
            font-weight: 700;
            font-size: 17px;
            letter-spacing: -.02em;
            box-shadow: 0 3px 9px rgba(15, 23, 42, .035);
        }

        .proposal-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }


        /* ============================================================
                                                           CONTENT
                                                        ============================================================ */

        .proposal-main {
            flex: 1;
            min-width: 0;
        }

        .proposal-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
        }

        .proposal-name-row {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 6px;
        }

        .proposal-name {
            font-size: 15.5px;
            font-weight: 700;
            color: #172033;
            letter-spacing: -.01em;
            line-height: 1.35;
            margin: 0;
        }

        .verified-dot {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 15px;
            height: 15px;
            border-radius: 50%;
            background: #eef4ff;
            color: #3376f2;
            font-size: 9px;
            font-weight: 700;
        }

        .proposal-role {
            font-size: 12.5px;
            color: #7b8498;
            line-height: 1.5;
            margin-top: 2px;
        }

        .proposal-head-right {
            display: flex;
            align-items: center;
            gap: 9px;
            flex-shrink: 0;
        }


        /* ============================================================
                                                           STATUS BADGES
                                                        ============================================================ */

        .status-badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 999px;
            font-size: 10.5px;
            line-height: 1.5;
            font-weight: 600;
            white-space: nowrap;
        }

        .st-pending {
            background: #fffbeb;
            color: #b45309;
        }

        .st-shortlisted {
            background: #f5f3ff;
            color: #7c3aed;
        }

        .st-accepted {
            background: #ecfdf5;
            color: #059669;
        }

        .st-rejected {
            background: #fff1f2;
            color: #e11d48;
        }

        .st-withdrawn {
            background: #f1f5f9;
            color: #64748b;
        }


        /* ============================================================
                                                           META ROW
                                                        ============================================================ */

        .proposal-meta {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 16px;
            margin-top: 11px;
        }

        .proposal-meta-item {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12.5px;
            color: #7b8498;
            line-height: 1.5;
        }

        .proposal-meta-item svg {
            width: 14px;
            height: 14px;
            color: #9aa4b3;
            flex-shrink: 0;
        }

        .proposal-meta-item.meta-bid {
            color: #059669;
            font-weight: 700;
            font-size: 13.5px;
        }

        .proposal-meta-item.meta-bid svg {
            color: #059669;
        }


        /* ============================================================
                                                           COVER LETTER
                                                        ============================================================ */

        .proposal-letter {
            margin-top: 12px;
            padding: 12px 14px;
            background: #f8fafc;
            border: 1px solid #eef2f8;
            border-radius: 12px;
            font-size: 12.8px;
            line-height: 1.72;
            color: #55607a;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }


        /* ============================================================
                                                           SKILLS
                                                        ============================================================ */

        .proposal-skills {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-top: 11px;
        }

        .skill-pill {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 600;
            background: #eef4ff;
            color: #3376f2;
        }


        /* ============================================================
                                                           CARD ACTION BUTTONS
                                                        ============================================================ */

        .proposal-actions {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 8px;
            margin-top: 15px;
            padding-top: 14px;
            border-top: 1px solid #f1f5f9;
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12.5px;
            font-weight: 600;
            padding: 8px 15px;
            border-radius: 10px;
            border: 1px solid #e8edf5;
            background: #fff;
            color: #64748b;
            transition: all .16s ease;
            cursor: pointer;
            line-height: 1;
        }

        .btn-action:hover {
            color: #3376f2;
            border-color: #c9dafa;
            background: #f8fbff;
        }

        .btn-action svg {
            width: 14px;
            height: 14px;
            flex-shrink: 0;
        }

        .btn-action.btn-hire {
            background: #3376f2;
            border-color: #3376f2;
            color: #fff;
            box-shadow: 0 5px 14px rgba(51, 118, 242, .22);
        }

        .btn-action.btn-hire:hover {
            background: #245fd0;
            border-color: #245fd0;
            color: #fff;
        }

        .btn-action.btn-danger:hover {
            color: #e11d48;
            border-color: #fecdd3;
            background: #fff5f6;
        }

        .btn-action.is-disabled {
            opacity: .55;
            pointer-events: none;
        }


        /* ============================================================
                                                           3 DOT MENU
                                                        ============================================================ */

        .proposal-menu {
            position: relative;
            z-index: 60;
        }

        .proposal-menu>summary {
            width: 34px;
            height: 34px;
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

        .proposal-menu>summary::-webkit-details-marker {
            display: none;
        }

        .proposal-menu>summary::marker {
            display: none;
        }

        .proposal-menu>summary:hover {
            color: #3376f2;
            border-color: #c9dafa;
            background: #f8fbff;
        }

        .proposal-menu[open]>summary {
            color: #2563eb;
            border-color: #93c5fd;
            background: #f8fbff;
        }

        .proposal-menu-panel {
            position: absolute;
            right: 0;
            top: 100%;
            z-index: 100;
            min-width: 185px;
            margin-top: 7px;
            padding: 5px;
            background: #fff;
            border: 1px solid #e7ebf3;
            border-radius: 11px;
            box-shadow: 0 15px 32px rgba(15, 23, 42, .11);
            animation: proposalMenuIn .14s ease-out;
            transform-origin: top right;
        }

        @keyframes proposalMenuIn {
            from {
                opacity: 0;
                transform: scale(.97) translateY(-4px);
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .proposal-menu-panel a,
        .proposal-menu-panel button {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 12px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 500;
            color: #64748b;
            text-align: left;
            transition: all .14s ease;
        }

        .proposal-menu-panel a:hover,
        .proposal-menu-panel button:hover {
            background: #f8fafc;
            color: #3376f2;
        }

        .proposal-menu-panel svg {
            width: 15px;
            height: 15px;
            flex-shrink: 0;
        }

        .proposal-menu-panel .danger {
            color: #e11d48;
        }

        .proposal-menu-panel .danger:hover {
            background: #fff5f6;
            color: #e11d48;
        }


        /* ============================================================
                                                           SIDEBAR
                                                        ============================================================ */

        .side-card {
            border: 1px solid #e8edf5 !important;
            border-radius: 16px !important;
            background: #fff;
            box-shadow: 0 3px 13px rgba(15, 23, 42, .03) !important;
            padding: 18px;
        }

        .side-card-title {
            font-size: 13px;
            font-weight: 700;
            color: #172033;
            margin-bottom: 12px;
        }

        .side-row {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 10px;
            padding: 8px 0;
            border-bottom: 1px dashed #f1f5f9;
            font-size: 12.5px;
        }

        .side-row:last-child {
            border-bottom: 0;
        }

        .side-row-label {
            color: #9aa3b2;
            font-weight: 500;
            flex-shrink: 0;
        }

        .side-row-value {
            color: #334155;
            font-weight: 600;
            text-align: right;
            word-break: break-word;
        }


        /* ============================================================
                                                           EMPTY STATE
                                                        ============================================================ */

        .empty-state {
            border: 1px solid #e8edf5 !important;
            border-radius: 16px !important;
            background: #fff;
            box-shadow: 0 2px 10px rgba(15, 23, 42, .025);
            padding: 54px 24px;
            text-align: center;
        }


        /* ============================================================
                                                           MOBILE
                                                        ============================================================ */

        @media (max-width: 767px) {

            .proposal-card {
                padding: 16px !important;
                border-radius: 15px !important;
            }

            .proposal-inner {
                gap: 12px;
            }

            .proposal-avatar {
                width: 45px;
                height: 45px;
                min-width: 45px;
                border-radius: 12px;
                font-size: 15px;
            }

            .proposal-head {
                flex-direction: column;
                gap: 9px;
            }

            .proposal-head-right {
                width: 100%;
                justify-content: space-between;
            }

            .proposals-title {
                font-size: 20px;
            }

            .proposal-actions .btn-action {
                flex: 1;
                justify-content: center;
            }
        }

        @media (max-width: 575px) {
            .proposal-meta {
                gap: 10px;
            }

            .proposal-menu-panel {
                width: 180px;
            }
        }
    </style>

    <div class="proposals-page bg-slate-50 min-h-screen">


        {{-- =========================================================
    PAGE HEADER
========================================================== --}}

        <div class="proposals-header">

            <div class="max-w-7xl mx-auto px-4 sm:px-6 py-7 md:py-8">

                <a href="{{ route('employer.projects.index') }}" class="back-link mb-3">

                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                        stroke-linecap="round" stroke-linejoin="round">

                        <path d="M19 12H5"></path>
                        <path d="m12 19-7-7 7-7"></path>

                    </svg>

                    Back to Projects

                </a>


                <div class="flex flex-wrap items-start justify-between gap-4">

                    <div class="min-w-0">

                        <h1 class="proposals-title">

                            {{ $project->title }}

                        </h1>


                        <div class="flex flex-wrap items-center gap-2 mt-3">

                            <span class="header-chip chip-blue">

                                {{ $project->visibility === 'employee' ? 'Employee Job' : 'Freelance' }}

                            </span>

                            <span class="header-chip">

                                {{ ucfirst($project->project_type) }}

                            </span>

                            @if (!empty($project->budget))
                                <span class="header-chip chip-emerald">

                                    Budget: {{ $project->budget }}

                                </span>
                            @endif

                            @if (!empty($project->duration))
                                <span class="header-chip">

                                    {{ $project->duration }}

                                </span>
                            @endif

                        </div>

                    </div>


                    <div class="flex flex-wrap items-center gap-2">

                        <a href="{{ route('employer.projects.show', $project) }}" class="btn-action">

                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                                <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z"></path>
                                <circle cx="12" cy="12" r="3"></circle>

                            </svg>

                            View Project

                        </a>

                        <a href="{{ route('employer.projects.edit', $project) }}" class="btn-action">

                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                                <path d="M12 20h9"></path>
                                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4Z"></path>

                            </svg>

                            Edit Project

                        </a>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
    MAIN CONTENT
========================================================== --}}

        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-7 md:py-8">


            {{-- FLASH MESSAGES --}}

            @if (session('success'))
                <div
                    class="flex items-center gap-2 bg-emerald-50 border border-emerald-100 text-emerald-700 text-sm font-medium rounded-xl px-4 py-3 mb-4">

                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5"
                        viewBox="0 0 24 24">

                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />

                    </svg>

                    {{ session('success') }}

                </div>
            @endif

            @if (session('error'))
                <div
                    class="flex items-center gap-2 bg-rose-50 border border-rose-100 text-rose-700 text-sm font-medium rounded-xl px-4 py-3 mb-4">

                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5"
                        viewBox="0 0 24 24">

                        <circle cx="12" cy="12" r="9"></circle>
                        <path stroke-linecap="round" d="M12 8v5M12 16h.01"></path>

                    </svg>

                    {{ session('error') }}

                </div>
            @endif


            <div class="grid lg:grid-cols-[minmax(0,1fr)_280px] gap-5 lg:gap-6">


                {{-- =================================================
            PROPOSAL LIST
        ================================================== --}}

                <section class="min-w-0">


                    {{-- STAT CARDS --}}

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-5">

                        <div class="stat-card">

                            <p class="stat-label">Total</p>
                            <p class="stat-value is-blue">{{ $counts['all'] ?? 0 }}</p>

                        </div>

                        <div class="stat-card">

                            <p class="stat-label">Pending</p>
                            <p class="stat-value is-amber">{{ $counts['pending'] ?? 0 }}</p>

                        </div>

                        <div class="stat-card">

                            <p class="stat-label">Shortlisted</p>
                            <p class="stat-value is-violet">{{ $counts['shortlisted'] ?? 0 }}</p>

                        </div>

                        <div class="stat-card">

                            <p class="stat-label">Accepted</p>
                            <p class="stat-value is-emerald">{{ $counts['accepted'] ?? 0 }}</p>

                        </div>

                    </div>


                    {{-- FILTER BAR --}}

                    <form method="GET" class="proposal-filters">

                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search by freelancer name...">

                        <select name="status">

                            <option value="">All Statuses</option>

                            <option value="pending" @selected(request('status') === 'pending')>Pending</option>
                            <option value="shortlisted" @selected(request('status') === 'shortlisted')>Shortlisted</option>
                            <option value="accepted" @selected(request('status') === 'accepted')>Accepted</option>
                            <option value="rejected" @selected(request('status') === 'rejected')>Rejected</option>
                            <option value="withdrawn" @selected(request('status') === 'withdrawn')>Withdrawn</option>

                        </select>

                        <select name="sort">

                            <option value="">Newest First</option>

                            <option value="oldest" @selected(request('sort') === 'oldest')>Oldest First</option>
                            <option value="bid_low" @selected(request('sort') === 'bid_low')>Lowest Bid</option>
                            <option value="bid_high" @selected(request('sort') === 'bid_high')>Highest Bid</option>

                        </select>

                        <button type="submit" class="filter-btn">

                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">

                                <path d="M22 3H2l8 9.46V19l4 2v-8.54L22 3z"></path>

                            </svg>

                            Filter

                        </button>

                        @if (request()->hasAny(['search', 'status', 'sort']))
                            <a href="{{ route('employer.projects.proposals.index', $project) }}" class="filter-btn">

                                Clear

                            </a>
                        @endif

                    </form>


                    {{-- =================================================
                PROPOSAL CARDS
            ================================================== --}}

                    @forelse ($applications as $application)
                        @php
                            $employee = $application->employee;
                            $user = $employee?->user;

                            $status = strtolower($application->status ?? 'pending');

                            $statusClass = match ($status) {
                                'pending' => 'st-pending',
                                'shortlisted' => 'st-shortlisted',
                                'accepted' => 'st-accepted',
                                'rejected' => 'st-rejected',
                                'withdrawn' => 'st-withdrawn',
                                default => 'st-pending',
                            };

                            /*
    |--------------------------------------------------------------------------
    | Employee / User data
    |--------------------------------------------------------------------------
    */
                            $name = $user?->name ?? 'Employee';
                            $email = $user?->email ?? null;
                            $phone = $user?->phone ?? null;

                            $designation = $employee?->designation ?? 'Employee';
                            $company = $employee?->company_name ?? null;
                            $experience = $employee?->experience_years ?? null;
                            $avatar = $employee?->profile_photo ?? null;
                            $linkedin = $employee?->linkedin ?? null;

                            /*
    |--------------------------------------------------------------------------
    | Resume
    |--------------------------------------------------------------------------
    */
                            $resume = $application->resume_path ?? ($employee?->resume ?? null);

                            /*
    |--------------------------------------------------------------------------
    | Application data
    |--------------------------------------------------------------------------
    */
                            $isAccepted = $status === 'accepted';

                            $delivery = $application->availability ?? null;
                            $letter = $application->cover_letter ?? null;

                            /*
    |--------------------------------------------------------------------------
    | Employee skills
    |--------------------------------------------------------------------------
    */
                            $skills = collect();

                            if (!empty($employee?->skills)) {
                                $skills = is_array($employee->skills)
                                    ? collect($employee->skills)
                                    : collect(explode(',', $employee->skills));
                            }
                        @endphp
                        {{-- ================= APPLICATION CARD ================= --}}
                        {{-- ================= APPLICATION CARD ================= --}}
                        <article class="proposal-card {{ $isAccepted ? 'is-accepted' : '' }}">

                            <div class="proposal-inner">

                                {{-- AVATAR --}}
                                <div class="proposal-avatar">
                                    @if ($avatar)
                                        <img src="{{ asset('storage/' . $avatar) }}" alt="{{ $name }}">
                                    @else
                                        {{ strtoupper(substr($name, 0, 1)) }}
                                    @endif
                                </div>

                                {{-- MAIN CONTENT --}}
                                <div class="proposal-main">

                                    {{-- HEADER --}}
                                    <div class="proposal-head">

                                        <div>
                                            <div class="proposal-name-row">
                                                <h3 class="proposal-name">
                                                    {{ $name }}
                                                </h3>

                                                <span class="verified-dot">✓</span>
                                            </div>

                                            <p class="proposal-role">
                                                {{ $designation }}

                                                @if ($company)
                                                    <span class="text-slate-400"> · {{ $company }}</span>
                                                @endif
                                            </p>
                                        </div>

                                        {{-- STATUS --}}
                                        <div class="proposal-head-right">

                                            <span class="status-badge {{ $statusClass }}">
                                                {{ ucfirst($status) }}
                                            </span>

                                            <details class="proposal-menu">
                                                <summary>
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2">
                                                        <circle cx="12" cy="5" r="1"></circle>
                                                        <circle cx="12" cy="12" r="1"></circle>
                                                        <circle cx="12" cy="19" r="1"></circle>
                                                    </svg>
                                                </summary>

                                                <div class="proposal-menu-panel">

                                                    @if ($application->resume_path)
                                                        <a href="{{ asset('storage/' . $application->resume_path) }}"
                                                            target="_blank">
                                                            View Resume
                                                        </a>
                                                    @endif

                                                    @if ($application->portfolio_path)
                                                        <a href="{{ $application->portfolio_path }}" target="_blank">
                                                            View Portfolio
                                                        </a>
                                                    @endif

                                                    @if ($application->github)
                                                        <a href="{{ $application->github }}" target="_blank">
                                                            GitHub
                                                        </a>
                                                    @endif

                                                    @if ($application->linkedin)
                                                        <a href="{{ $application->linkedin }}" target="_blank">
                                                            LinkedIn
                                                        </a>
                                                    @endif

                                                </div>
                                            </details>

                                        </div>

                                    </div>

                                    {{-- META --}}
                                    <div class="proposal-meta">

                                        @if ($delivery)
                                            <span class="proposal-meta-item">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2">
                                                    <circle cx="12" cy="12" r="9"></circle>
                                                    <path d="M12 7v5l3 2"></path>
                                                </svg>

                                                {{ ucwords(str_replace('_', ' ', $delivery)) }}
                                            </span>
                                        @endif

                                        <span class="proposal-meta-item">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2">
                                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                <circle cx="12" cy="7" r="4"></circle>
                                            </svg>

                                            Applied {{ optional($application->created_at)->diffForHumans() }}
                                        </span>
                                        @if ($email)
                                            <span class="proposal-meta-item">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2">
                                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4
                                    c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2Z"></path>
                                                    <path d="m22 6-10 7L2 6"></path>
                                                </svg>

                                                {{ $email }}
                                            </span>
                                        @endif

                                        @if ($phone)
                                            <span class="proposal-meta-item">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2">
                                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2
                                    19.79 19.79 0 0 1-8.63-3.07
                                    19.5 19.5 0 0 1-6-6
                                    19.79 19.79 0 0 1-3.07-8.67
                                    A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72
                                    12.84 12.84 0 0 0 .7 2.81
                                    2 2 0 0 1-.45 2.11L8.09 9.91
                                    a16 16 0 0 0 6 6l1.27-1.27
                                    a2 2 0 0 1 2.11-.45
                                    12.84 12.84 0 0 0 2.81.7
                                    A2 2 0 0 1 22 16.92Z"></path>
                                                </svg>

                                                {{ $phone }}
                                            </span>
                                        @endif
                                    </div>

                                    {{-- COVER LETTER --}}
                                    @if ($letter)
                                        <div class="proposal-letter">
                                            {{ $letter }}
                                        </div>
                                    @endif

                                    {{-- SKILLS --}}
                                    @if ($skills->isNotEmpty())
                                        <div class="proposal-skills">

                                            @foreach ($skills as $skill)
                                                @if (trim($skill))
                                                    <span class="skill-pill">
                                                        {{ trim($skill) }}
                                                    </span>
                                                @endif
                                            @endforeach

                                        </div>
                                    @endif

                                    {{-- ACTIONS --}}

                                    {{-- ACTIONS --}}
                                    <div class="proposal-actions">

                                        {{-- View Resume --}}
                                        @if ($application->resume_path)
                                            <a href="{{ asset('storage/' . $application->resume_path) }}" target="_blank"
                                                class="btn-action">

                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2">
                                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z">
                                                    </path>
                                                    <path d="M14 2v6h6"></path>
                                                    <path d="M8 13h8M8 17h5"></path>
                                                </svg>

                                                View Resume
                                            </a>
                                        @endif


                                        {{-- PENDING APPLICATION --}}
                                        @if ($status === 'pending')
                                            {{-- ACCEPT --}}
                                            <form method="POST"
                                                action="{{ route('employer.projects.proposals.accept', [
                                                    'project' => $project->id,
                                                    'application' => $application->id,
                                                ]) }}"
                                                style="display:inline;">

                                                @csrf

                                                <button type="submit" class="btn-action btn-hire"
                                                    onclick="return confirm('Are you sure you want to accept this application?')">

                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2">
                                                        <path d="m5 12 4 4L19 6"></path>
                                                    </svg>

                                                    Accept Application
                                                </button>

                                            </form>


                                            {{-- REJECT --}}
                                            <form method="POST"
                                                action="{{ route('employer.projects.proposals.reject', [
                                                    'project' => $project->id,
                                                    'application' => $application->id,
                                                ]) }}"
                                                style="display:inline;">

                                                @csrf

                                                <button type="submit" class="btn-action btn-danger"
                                                    onclick="return confirm('Are you sure you want to reject this application?')">

                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2">
                                                        <path d="M6 6l12 12"></path>
                                                        <path d="M18 6 6 18"></path>
                                                    </svg>

                                                    Reject Application
                                                </button>

                                            </form>


                                            {{-- ACCEPTED --}}
                                            {{-- ACCEPTED --}}
                                        @elseif ($status === 'accepted')
                                            @php
                                                $isSigned = !empty($application->signed_contract_path);
                                                $isCancelled = !empty($application->contract_cancelled_at);
                                                $canSend = !$isSigned || $isCancelled; // hide Resend once signed
                                            @endphp

                                            <span class="btn-action btn-hire">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2">
                                                    <path d="m5 12 4 4L19 6"></path>
                                                </svg>
                                                Accepted
                                            </span>

                                            {{-- SEND / RESEND CONTRACT --}}
                                            @if ($canSend)
                                                <button type="button" class="btn-action" data-contract-open
                                                    data-action="{{ route('employer.projects.proposals.send-contract', [
                                                        'project' => $project->id,
                                                        'application' => $application->id,
                                                    ]) }}"
                                                    data-name="{{ $name }}">
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2">
                                                        <path
                                                            d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z">
                                                        </path>
                                                        <path d="M14 2v6h6"></path>
                                                    </svg>
                                                    {{ $application->contract_sent_at ? 'Resend Contract' : 'Send Contract' }}
                                                </button>
                                            @endif

                                            {{-- ORIGINAL CONTRACT --}}
                                            @if ($application->contract_path && !$isCancelled)
                                                <a href="{{ asset('storage/' . $application->contract_path) }}"
                                                    target="_blank" class="btn-action">
                                                    View Sent Contract
                                                </a>
                                            @endif

                                            @if ($application->contract_sent_at)
                                                <span class="text-xs text-slate-400">
                                                    Sent {{ $application->contract_sent_at->diffForHumans() }}
                                                </span>
                                            @endif

                                            {{-- SIGNED CONTRACT RECEIVED --}}
                                            @if ($isSigned && !$isCancelled)
                                                <span class="status-badge st-accepted">
                                                    Signed
                                                    {{ $application->contract_signed_at?->format('d M Y, h:i A') }}
                                                </span>

                                                <a href="{{ asset('storage/' . $application->signed_contract_path) }}"
                                                    target="_blank" class="btn-action btn-hire">
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2">
                                                        <path
                                                            d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z">
                                                        </path>
                                                        <path d="M14 2v6h6"></path>
                                                        <path d="m9 15 2 2 4-4"></path>
                                                    </svg>
                                                    View Signed Contract
                                                </a>

                                                {{-- WAITING --}}
                                            @elseif ($application->contract_sent_at && !$isCancelled)
                                                <span class="status-badge st-pending">Awaiting signature</span>
                                            @endif

                                            {{-- CANCELLED BY EMPLOYEE --}}
                                            @if ($isCancelled)
                                                <div class="contract-cancelled">
                                                    <strong>Contract cancelled</strong>
                                                    {{ $application->contract_cancelled_at->format('d M Y, h:i A') }}
                                                    @if ($application->contract_cancel_reason)
                                                        <div>Reason: {{ $application->contract_cancel_reason }}</div>
                                                    @endif
                                                </div>
                                            @endif


                                            {{-- REJECTED --}}
                                        @elseif ($status === 'rejected')
                                            <span class="btn-action btn-danger">

                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2">
                                                    <path d="M6 6l12 12"></path>
                                                    <path d="M18 6 6 18"></path>
                                                </svg>

                                                Rejected
                                            </span>
                                        @endif

                                    </div>


                                </div>

                            </div>

                        </article>

                    @empty

                        {{-- ================= EMPTY STATE ================= --}}
                        <div class="empty-state">

                            <div
                                class="w-14 h-14 mx-auto mb-4 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center">
                                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M14 3H6a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                    <path d="M14 3v6h6"></path>
                                    <path d="M8 13h8M8 17h5"></path>
                                </svg>
                            </div>

                            <h3 class="text-lg font-semibold text-slate-800 mb-1.5">
                                @if (request()->hasAny(['search', 'status', 'sort']))
                                    No proposals match your filters
                                @else
                                    No proposals yet
                                @endif
                            </h3>

                            <p class="text-sm text-slate-400 mb-5">
                                @if (request()->hasAny(['search', 'status', 'sort']))
                                    Try adjusting your search or clearing the filters.
                                @else
                                    Once employees apply to this project, their proposals will appear here.
                                @endif
                            </p>

                            @if (request()->hasAny(['search', 'status', 'sort']))
                                <a href="{{ route('employer.projects.proposals.index', $project) }}"
                                    class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-6 py-3 rounded-xl transition">
                                    Clear Filters
                                </a>
                            @else
                                <a href="{{ route('employer.projects.index') }}"
                                    class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-6 py-3 rounded-xl transition">
                                    Back to Projects
                                </a>
                            @endif

                        </div>
                    @endforelse


                    {{-- PAGINATION --}}

                    @if ($applications->hasPages())
                        <div class="mt-5 text-sm">
                            {{ $applications->withQueryString()->links() }}
                        </div>
                    @endif

                </section>


                {{-- =====================================================
            SIDEBAR
        ====================================================== --}}

                <aside class="space-y-4">


                    {{-- PROJECT SUMMARY --}}

                    <div class="side-card">

                        <h3 class="side-card-title">

                            Project Summary

                        </h3>


                        <div class="side-row">

                            <span class="side-row-label">Type</span>
                            <span class="side-row-value">

                                {{ $project->visibility === 'employee' ? 'Employee Job' : 'Freelance' }}

                            </span>

                        </div>


                        <div class="side-row">

                            <span class="side-row-label">Category</span>
                            <span class="side-row-value">

                                {{ ucfirst($project->project_type) }}

                            </span>

                        </div>


                        @if (!empty($project->budget))
                            <div class="side-row">

                                <span class="side-row-label">Budget</span>
                                <span class="side-row-value" style="color:#059669;">

                                    {{ $project->budget }}

                                </span>

                            </div>
                        @endif


                        @if (!empty($project->duration))
                            <div class="side-row">

                                <span class="side-row-label">Duration</span>
                                <span class="side-row-value">

                                    {{ $project->duration }}

                                </span>

                            </div>
                        @endif


                        <div class="side-row">

                            <span class="side-row-label">Status</span>
                            <span class="side-row-value">

                                {{ ucfirst($project->status) }}

                            </span>

                        </div>


                        <div class="side-row">

                            <span class="side-row-label">Posted</span>
                            <span class="side-row-value">

                                {{ optional($project->created_at)->diffForHumans() }}

                            </span>

                        </div>

                    </div>


                    {{-- HIRING TIPS --}}

                    <div class="side-card">

                        <h3 class="side-card-title">

                            Hiring Tips

                        </h3>


                        <ul class="text-[12px] text-slate-500 leading-7">

                            <li>✓ Read the full cover letter</li>
                            <li>✓ Compare bids against scope</li>
                            <li>✓ Check portfolio &amp; reviews</li>
                            <li>✓ Shortlist before you hire</li>
                            <li>✓ Message to clarify details</li>

                        </ul>

                    </div>


                    {{-- NEED HELP CTA --}}

                    <div
                        class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-600 to-violet-600 text-white p-5 shadow-lg shadow-blue-900/15">

                        <div class="absolute w-28 h-28 rounded-full bg-white/10 -right-8 -bottom-8"></div>
                        <div class="absolute w-16 h-16 rounded-full bg-white/10 right-10 -top-6"></div>


                        <h3 class="relative font-bold text-[15px] mb-2">

                            Not getting good proposals?

                        </h3>


                        <p class="relative text-[13px] text-white/85 leading-relaxed mb-4">

                            A clearer scope and realistic budget attract better freelancers.

                        </p>


                        <a href="{{ route('employer.projects.edit', $project) }}"
                            class="relative inline-flex items-center gap-1.5 bg-white text-blue-600 hover:bg-slate-50 text-[13px] font-bold px-4 py-2.5 rounded-lg transition">

                            Improve Project →

                        </a>

                    </div>

                </aside>

            </div>

        </div>

    </div>

    {{-- CONTRACT MODAL --}}
    <div id="contractModal"
        style="display:none; position:fixed; inset:0; z-index:1000; background:rgba(15,23,42,.5);
           align-items:center; justify-content:center; padding:16px;">

        <div
            style="background:#fff; border-radius:16px; width:100%; max-width:460px; padding:24px;
                box-shadow:0 20px 50px rgba(15,23,42,.25);">

            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:6px;">
                <h3 style="font-size:16px; font-weight:700; color:#172033;">Send Contract</h3>
                <button type="button" id="contractClose"
                    style="font-size:22px; line-height:1; color:#94a0b2; cursor:pointer;">&times;</button>
            </div>

            <p style="font-size:12.5px; color:#7b8498; margin-bottom:16px;">
                Upload the contract for <strong id="contractEmployeeName"></strong>.
                It will be emailed as an attachment.
            </p>

            <form id="contractForm" method="POST" enctype="multipart/form-data">
                @csrf

                <label style="font-size:12.5px; font-weight:600; color:#334155;">Contract (PDF, max 5 MB)</label>
                <input type="file" name="contract" accept="application/pdf" required
                    style="width:100%; margin:6px 0 14px; border:1px solid #e8edf5; border-radius:10px;
                       padding:9px 12px; font-size:13px;">

                @error('contract')
                    <p style="color:#e11d48; font-size:12px; margin:-8px 0 12px;">{{ $message }}</p>
                @enderror

                <label style="font-size:12.5px; font-weight:600; color:#334155;">Message (optional)</label>
                <textarea name="note" rows="3" maxlength="1000"
                    style="width:100%; margin:6px 0 18px; border:1px solid #e8edf5; border-radius:10px;
                       padding:9px 12px; font-size:13px;"
                    placeholder="Add a short note for the employee..."></textarea>

                <div style="display:flex; justify-content:flex-end; gap:8px;">
                    <button type="button" id="contractCancel" class="btn-action">Cancel</button>
                    <button type="submit" id="contractSubmit" class="btn-action btn-hire">Send Contract</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ================================================================
3-DOT MENU JAVASCRIPT
================================================================ --}}

    <script>
        (function() {

            const menus = document.querySelectorAll('.proposal-menu');


            function closeOtherMenus(currentMenu) {

                menus.forEach(function(menu) {

                    if (menu !== currentMenu) {

                        menu.removeAttribute('open');

                        const card = menu.closest('.proposal-card');

                        if (card) {
                            card.classList.remove('menu-active');
                        }

                    }

                });

            }


            menus.forEach(function(menu) {

                menu.addEventListener('toggle', function() {

                    const card = menu.closest('.proposal-card');

                    if (menu.open) {

                        closeOtherMenus(menu);

                        if (card) {
                            card.classList.add('menu-active');
                        }

                    } else if (card) {

                        card.classList.remove('menu-active');

                    }

                });

            });


            document.addEventListener('click', function(event) {

                menus.forEach(function(menu) {

                    if (!menu.contains(event.target)) {

                        menu.removeAttribute('open');

                        const card = menu.closest('.proposal-card');

                        if (card) {
                            card.classList.remove('menu-active');
                        }

                    }

                });

            });


            menus.forEach(function(menu) {

                menu.addEventListener('click', function(event) {
                    event.stopPropagation();
                });

            });


        })();
        (function() {
            const modal = document.getElementById('contractModal');
            const form = document.getElementById('contractForm');
            const nameEl = document.getElementById('contractEmployeeName');
            const submit = document.getElementById('contractSubmit');

            function openModal(action, name) {
                form.reset();
                form.action = action;
                nameEl.textContent = name;
                modal.style.display = 'flex';
            }

            function closeModal() {
                modal.style.display = 'none';
            }

            document.querySelectorAll('[data-contract-open]').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    openModal(btn.dataset.action, btn.dataset.name);
                });
            });

            document.getElementById('contractClose').addEventListener('click', closeModal);
            document.getElementById('contractCancel').addEventListener('click', closeModal);

            modal.addEventListener('click', function(e) {
                if (e.target === modal) closeModal();
            });

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') closeModal();
            });

            // Prevent double submit
            form.addEventListener('submit', function() {
                submit.disabled = true;
                submit.textContent = 'Sending...';
            });
        })();
    </script>

@endsection

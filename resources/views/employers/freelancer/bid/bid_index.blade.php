{{-- resources/views/employers/freelancer/bid/bid_index.blade.php --}}
@extends('layouts.app')

@section('title', 'Freelancer Bids')

@section('page-title', 'Freelancer Bids')
@section('page-subtitle', 'Review and manage freelancer bids')

@section('content')
    <div class="fb-page">

        {{-- Stats --}}
        <div class="fb-stats">
            <div class="fb-stat">
                <div class="fb-stat__icon fb-stat__icon--total"><i class="fas fa-file-invoice"></i></div>
                <div class="fb-stat__text">
                    <span class="fb-stat__label">Total bids</span>
                    <span class="fb-stat__value">{{ $totalBids }}</span>
                </div>
            </div>

            <div class="fb-stat">
                <div class="fb-stat__icon fb-stat__icon--pending"><i class="fas fa-clock"></i></div>
                <div class="fb-stat__text">
                    <span class="fb-stat__label">Pending</span>
                    <span class="fb-stat__value">{{ $pendingBids }}</span>
                </div>
            </div>

            <div class="fb-stat">
                <div class="fb-stat__icon fb-stat__icon--accepted"><i class="fas fa-check-circle"></i></div>
                <div class="fb-stat__text">
                    <span class="fb-stat__label">Accepted</span>
                    <span class="fb-stat__value">{{ $acceptedBids }}</span>
                </div>
            </div>

            <div class="fb-stat">
                <div class="fb-stat__icon fb-stat__icon--rejected"><i class="fas fa-times-circle"></i></div>
                <div class="fb-stat__text">
                    <span class="fb-stat__label">Rejected</span>
                    <span class="fb-stat__value">{{ $rejectedBids }}</span>
                </div>
            </div>
        </div>

        {{-- Filters --}}
        <div class="fb-card fb-filters">
            <form action="{{ route('employer.freelancer.bids.index') }}" method="GET" class="fb-filters__form">
                <div class="fb-field fb-field--grow">
                    <label for="fb-search">Search</label>
                    <div class="fb-search">
                        <i class="fas fa-search"></i>
                        <input type="text" id="fb-search" name="search" placeholder="Search by bid number or project"
                            value="{{ request('search') }}">
                    </div>
                </div>

                <div class="fb-field">
                    <label for="fb-status">Status</label>
                    <select id="fb-status" name="status">
                        <option value="">All statuses</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Accepted</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>

                <div class="fb-field">
                    <label for="fb-sort">Sort by</label>
                    <select id="fb-sort" name="sort">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest first</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest first</option>
                        <option value="amount_high" {{ request('sort') == 'amount_high' ? 'selected' : '' }}>Amount (high to low)</option>
                        <option value="amount_low" {{ request('sort') == 'amount_low' ? 'selected' : '' }}>Amount (low to high)</option>
                    </select>
                </div>

                <button type="submit" class="fb-btn fb-btn--primary">
                    <i class="fas fa-filter"></i>
                    <span>Filter</span>
                </button>
            </form>
        </div>

        {{-- Projects table --}}
        <div class="fb-card">
            <div class="fb-card__head">
                <h2 class="fb-card__title">
                    <i class="fas fa-project-diagram"></i>
                    Projects receiving bids
                </h2>
                <span class="fb-card__meta">{{ $projects->total() }} {{ \Illuminate\Support\Str::plural('project', $projects->total()) }}</span>
            </div>

            @if ($projects->count())
                <div class="fb-table-wrap">
                    <table class="fb-table">
                        <thead>
                            <tr>
                                <th>Project</th>
                                <th>Employer</th>
                                <th>Budget</th>
                                <th class="fb-center">Bids</th>
                                <th class="fb-center">Pending</th>
                                <th class="fb-center">Accepted</th>
                                <th class="fb-center">Rejected</th>
                                <th class="fb-right">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($projects as $project)
                                @php
                                    $pendingCount = $project->freelancerBids->where('status', 'pending')->count();
                                    $acceptedCount = $project->freelancerBids->where('status', 'accepted')->count();
                                    $rejectedCount = $project->freelancerBids->where('status', 'rejected')->count();
                                    $budget = (string) $project->budget;
                                    $budget = str_contains($budget, '₹') ? $budget : '₹' . $budget;
                                @endphp

                                <tr>
                                    <td>
                                        <div class="fb-project">
                                            <span class="fb-project__title">{{ $project->title }}</span>
                                            <span class="fb-project__id">Project #{{ $project->id }}</span>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="fb-person">
                                            <span class="fb-avatar">{{ strtoupper(substr($project->employer->name ?? 'N', 0, 1)) }}</span>
                                            <span>{{ $project->employer->name ?? 'N/A' }}</span>
                                        </div>
                                    </td>

                                    <td><span class="fb-budget">{{ $budget }}</span></td>

                                    <td class="fb-center">
                                        <span class="fb-pill fb-pill--total">
                                            <i class="fas fa-users"></i>
                                            {{ $project->freelancer_bids_count }}
                                        </span>
                                    </td>

                                    <td class="fb-center">
                                        <span class="fb-pill {{ $pendingCount ? 'fb-pill--pending' : 'fb-pill--zero' }}">{{ $pendingCount }}</span>
                                    </td>

                                    <td class="fb-center">
                                        <span class="fb-pill {{ $acceptedCount ? 'fb-pill--accepted' : 'fb-pill--zero' }}">{{ $acceptedCount }}</span>
                                    </td>

                                    <td class="fb-center">
                                        <span class="fb-pill {{ $rejectedCount ? 'fb-pill--rejected' : 'fb-pill--zero' }}">{{ $rejectedCount }}</span>
                                    </td>

                                    <td class="fb-right">
                                        <a href="{{ route('employer.freelancer.bids.project', $project->id) }}"
                                            class="fb-btn fb-btn--outline fb-btn--sm">
                                            <i class="fas fa-eye"></i>
                                            <span>View bids</span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="fb-card__foot">
                    <span class="fb-card__meta">
                        Showing {{ $projects->firstItem() ?? 0 }} to {{ $projects->lastItem() ?? 0 }}
                        of {{ $projects->total() }} projects
                    </span>

                    <div class="fb-pagination">
                        {{ $projects->appends(request()->query())->links() }}
                    </div>
                </div>
            @else
                <div class="fb-empty">
                    <div class="fb-empty__icon"><i class="fas fa-project-diagram"></i></div>
                    <h3>No projects found</h3>
                    <p>No projects have received freelancer bids yet, or none match your filters.</p>
                </div>
            @endif
        </div>
    </div>

    @push('styles')
        <style>
            /* All classes are prefixed with "fb-" so they cannot collide with
               .stat-card, .btn, .badge, .panel etc. defined in layouts.app */

            .fb-page {
                --fb-ink: #1f2937;
                --fb-ink-soft: #4b5563;
                --fb-muted: #6b7280;
                --fb-line: #e5e7eb;
                --fb-line-soft: #f1f3f7;
                --fb-surface: #ffffff;
                --fb-surface-soft: #f9fafb;
                --fb-primary: #2f5fd7;
                --fb-primary-dark: #244bb0;
                --fb-primary-soft: #e8eefc;
                --fb-success: #059669;
                --fb-success-soft: #e3f6ee;
                --fb-warning: #d97706;
                --fb-warning-soft: #fdf1dc;
                --fb-danger: #dc2626;
                --fb-danger-soft: #fde8e8;
                --fb-radius: 12px;

                max-width: 1400px;
                margin: 0 auto;
                padding: 1.5rem;
                font-size: 0.92rem;
                color: var(--fb-ink);
            }

            .fb-page *,
            .fb-page *::before,
            .fb-page *::after {
                box-sizing: border-box;
            }

            /* ---------- Stats ---------- */
            .fb-stats {
                display: grid;
                grid-template-columns: repeat(4, minmax(0, 1fr));
                gap: 1rem;
                margin-bottom: 1.25rem;
            }

            .fb-stat {
                display: flex;
                flex-direction: row;
                align-items: center;
                justify-content: flex-start;
                gap: 1rem;
                padding: 1.1rem 1.25rem;
                background: var(--fb-surface);
                border: 1px solid var(--fb-line);
                border-radius: var(--fb-radius);
                text-align: left;
            }

            .fb-stat__icon {
                display: flex;
                align-items: center;
                justify-content: center;
                flex: 0 0 44px;
                width: 44px;
                height: 44px;
                margin: 0;
                border-radius: 10px;
                font-size: 1.05rem;
            }

            .fb-stat__icon--total { background: var(--fb-primary-soft); color: var(--fb-primary); }
            .fb-stat__icon--pending { background: var(--fb-warning-soft); color: var(--fb-warning); }
            .fb-stat__icon--accepted { background: var(--fb-success-soft); color: var(--fb-success); }
            .fb-stat__icon--rejected { background: var(--fb-danger-soft); color: var(--fb-danger); }

            .fb-stat__text {
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                gap: 0.1rem;
                min-width: 0;
            }

            .fb-stat__label {
                font-size: 0.82rem;
                font-weight: 500;
                color: var(--fb-muted);
            }

            .fb-stat__value {
                font-size: 1.75rem;
                font-weight: 700;
                line-height: 1.1;
                color: var(--fb-ink);
            }

            /* ---------- Cards ---------- */
            .fb-card {
                margin-bottom: 1.25rem;
                background: var(--fb-surface);
                border: 1px solid var(--fb-line);
                border-radius: var(--fb-radius);
                overflow: hidden;
            }

            .fb-card__head,
            .fb-card__foot {
                display: flex;
                align-items: center;
                justify-content: space-between;
                flex-wrap: wrap;
                gap: 0.75rem;
                padding: 1rem 1.5rem;
            }

            .fb-card__head { border-bottom: 1px solid var(--fb-line); }
            .fb-card__foot { border-top: 1px solid var(--fb-line); }

            .fb-card__title {
                display: flex;
                align-items: center;
                gap: 0.6rem;
                margin: 0;
                font-size: 1rem;
                font-weight: 600;
                color: var(--fb-ink);
            }

            .fb-card__title i { color: var(--fb-primary); font-size: 0.95rem; }

            .fb-card__meta {
                font-size: 0.85rem;
                color: var(--fb-muted);
            }

            /* ---------- Filters ---------- */
            .fb-filters { padding: 1.25rem 1.5rem; overflow: visible; }

            .fb-filters__form {
                display: flex;
                align-items: flex-end;
                flex-wrap: wrap;
                gap: 1rem;
                margin: 0;
            }

            .fb-field {
                display: flex;
                flex-direction: column;
                gap: 0.4rem;
                min-width: 180px;
                margin: 0;
            }

            .fb-field--grow { flex: 1 1 280px; }

            .fb-field label {
                margin: 0;
                font-size: 0.82rem;
                font-weight: 600;
                color: var(--fb-ink-soft);
            }

            .fb-field input,
            .fb-field select {
                width: 100%;
                height: 42px;
                padding: 0 0.9rem;
                font-family: inherit;
                font-size: 0.9rem;
                color: var(--fb-ink);
                background-color: var(--fb-surface);
                border: 1px solid var(--fb-line);
                border-radius: 8px;
                transition: border-color 0.15s ease, box-shadow 0.15s ease;
            }

            .fb-field select { cursor: pointer; }

            .fb-field input:focus,
            .fb-field select:focus {
                outline: none;
                border-color: var(--fb-primary);
                box-shadow: 0 0 0 3px rgba(47, 95, 215, 0.15);
            }

            .fb-search { position: relative; }

            .fb-search i {
                position: absolute;
                top: 50%;
                left: 0.9rem;
                transform: translateY(-50%);
                font-size: 0.85rem;
                color: var(--fb-muted);
                pointer-events: none;
            }

            .fb-search input { padding-left: 2.4rem; }

            /* ---------- Buttons ---------- */
            .fb-btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 0.5rem;
                height: 42px;
                padding: 0 1.25rem;
                font-family: inherit;
                font-size: 0.9rem;
                font-weight: 600;
                line-height: 1;
                text-decoration: none;
                white-space: nowrap;
                border: 1px solid transparent;
                border-radius: 8px;
                cursor: pointer;
                transition: background-color 0.15s ease, border-color 0.15s ease, color 0.15s ease;
            }

            .fb-btn i { font-size: 0.85em; }

            .fb-btn--primary {
                color: #fff;
                background: var(--fb-primary);
            }

            .fb-btn--primary:hover { background: var(--fb-primary-dark); color: #fff; }

            .fb-btn--outline {
                color: var(--fb-primary);
                background: var(--fb-surface);
                border-color: var(--fb-line);
            }

            .fb-btn--outline:hover {
                color: var(--fb-primary-dark);
                background: var(--fb-primary-soft);
                border-color: var(--fb-primary);
            }

            .fb-btn--sm { height: 34px; padding: 0 0.9rem; font-size: 0.83rem; }

            .fb-btn:focus-visible {
                outline: 2px solid var(--fb-primary);
                outline-offset: 2px;
            }

            /* ---------- Table ---------- */
            .fb-table-wrap { overflow-x: auto; }

            .fb-table {
                width: 100%;
                margin: 0;
                border-collapse: collapse;
            }

            .fb-table thead th {
                padding: 0.85rem 1.25rem;
                font-size: 0.8rem;
                font-weight: 600;
                text-align: left;
                color: var(--fb-muted);
                background: var(--fb-surface-soft);
                border-bottom: 1px solid var(--fb-line);
                white-space: nowrap;
            }

            .fb-table tbody td {
                padding: 1rem 1.25rem;
                vertical-align: middle;
                color: var(--fb-ink-soft);
                background: transparent;
                border-bottom: 1px solid var(--fb-line-soft);
            }

            .fb-table tbody tr:last-child td { border-bottom: none; }
            .fb-table tbody tr:hover td { background: var(--fb-surface-soft); }

            .fb-center { text-align: center !important; }
            .fb-right { text-align: right !important; }

            .fb-project {
                display: flex;
                flex-direction: column;
                gap: 0.2rem;
                max-width: 380px;
            }

            .fb-project__title {
                font-weight: 600;
                line-height: 1.35;
                color: var(--fb-ink);
            }

            .fb-project__id {
                font-size: 0.8rem;
                color: var(--fb-muted);
            }

            .fb-person {
                display: flex;
                align-items: center;
                gap: 0.65rem;
                white-space: nowrap;
            }

            .fb-avatar {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                flex: 0 0 32px;
                width: 32px;
                height: 32px;
                font-size: 0.78rem;
                font-weight: 600;
                color: #fff;
                background: linear-gradient(135deg, #2f5fd7, #5b45d6);
                border-radius: 50%;
            }

            .fb-budget {
                font-weight: 600;
                color: var(--fb-ink);
                white-space: nowrap;
            }

            /* ---------- Count pills ---------- */
            .fb-pill {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 0.35rem;
                min-width: 36px;
                height: 28px;
                padding: 0 0.7rem;
                font-size: 0.8rem;
                font-weight: 600;
                border-radius: 999px;
            }

            .fb-pill i { font-size: 0.72rem; }

            .fb-pill--total { color: var(--fb-primary); background: var(--fb-primary-soft); }
            .fb-pill--pending { color: #92560a; background: var(--fb-warning-soft); }
            .fb-pill--accepted { color: #046c4e; background: var(--fb-success-soft); }
            .fb-pill--rejected { color: #b42318; background: var(--fb-danger-soft); }
            .fb-pill--zero { color: #9ca3af; background: #f3f4f6; }

            /* ---------- Pagination ---------- */
            .fb-pagination nav > div:first-child { display: none; } /* hides Laravel's duplicate "Showing x to y" text */

            .fb-pagination nav,
            .fb-pagination ul {
                display: flex;
                align-items: center;
                gap: 0.25rem;
                margin: 0;
                padding: 0;
                list-style: none;
            }

            .fb-pagination a,
            .fb-pagination span {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                min-width: 34px;
                height: 34px;
                padding: 0 0.6rem;
                font-size: 0.85rem;
                color: var(--fb-ink-soft);
                text-decoration: none;
                border-radius: 8px;
            }

            .fb-pagination a:hover { background: var(--fb-surface-soft); }

            .fb-pagination .active span,
            .fb-pagination [aria-current="page"] span {
                color: #fff;
                background: var(--fb-primary);
            }

            /* ---------- Empty state ---------- */
            .fb-empty {
                padding: 3.5rem 1.5rem;
                text-align: center;
            }

            .fb-empty__icon {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 68px;
                height: 68px;
                margin: 0 auto 1rem;
                font-size: 1.6rem;
                color: var(--fb-muted);
                background: var(--fb-surface-soft);
                border-radius: 50%;
            }

            .fb-empty h3 {
                margin: 0 0 0.35rem;
                font-size: 1.05rem;
                font-weight: 600;
                color: var(--fb-ink);
            }

            .fb-empty p {
                margin: 0;
                font-size: 0.9rem;
                color: var(--fb-muted);
            }

            /* ---------- Responsive ---------- */
            @media (max-width: 992px) {
                .fb-stats { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            }

            @media (max-width: 640px) {
                .fb-page { padding: 1rem; }
                .fb-stats { grid-template-columns: 1fr; }
                .fb-filters__form { flex-direction: column; align-items: stretch; }
                .fb-field { min-width: 0; }
                .fb-filters__form .fb-btn { width: 100%; }
            }
        </style>
    @endpush
@endsection
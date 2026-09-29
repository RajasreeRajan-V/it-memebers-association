{{-- resources/views/admin/freelancer/bid/bid_index.blade.php --}}
@extends('admin.layout.app')

@section('title', 'Freelancer Bids')

@section('page-title', 'Freelancer Bids')
@section('page-subtitle', 'Review and manage freelancer bids')

@section('content')
    <div class="bids-page">

        {{-- Stats Row --}}
        <div class="stats-grid">

            <div class="stat-card">
                <div class="stat-icon stat-icon--total">
                    <i class="fas fa-file-invoice"></i>
                </div>

                <div class="stat-info">
                    <span class="stat-label">Total Bids</span>
                    <span class="stat-value">{{ $totalBids }}</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon stat-icon--pending">
                    <i class="fas fa-clock"></i>
                </div>

                <div class="stat-info">
                    <span class="stat-label">Pending</span>
                    <span class="stat-value">{{ $pendingBids }}</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon stat-icon--approved">
                    <i class="fas fa-check-circle"></i>
                </div>

                <div class="stat-info">
                    <span class="stat-label">Accepted</span>
                    <span class="stat-value">{{ $acceptedBids }}</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon stat-icon--rejected">
                    <i class="fas fa-times-circle"></i>
                </div>

                <div class="stat-info">
                    <span class="stat-label">Rejected</span>
                    <span class="stat-value">{{ $rejectedBids }}</span>
                </div>
            </div>

        </div>

        {{-- Filter Bar --}}
        <div class="panel filter-panel">
            <form action="{{ route('employer.freelancer.bids.index') }}" method="GET" class="filter-form">
                <div class="field field--grow">
                    <label for="search">Search</label>
                    <div class="input-with-icon">
                        <i class="fas fa-search"></i>
                        <input type="text" id="search" name="search" placeholder="Search by bid number or project…"
                            value="{{ request('search') }}">
                    </div>
                </div>

                <div class="field">
                    <label for="status">Status</label>
                    <select id="status" name="status">
                        <option value="">All Statuses</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>

                <div class="field">
                    <label for="sort">Sort By</label>
                    <select id="sort" name="sort">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                        <option value="amount_high" {{ request('sort') == 'amount_high' ? 'selected' : '' }}>Amount (High)
                        </option>
                        <option value="amount_low" {{ request('sort') == 'amount_low' ? 'selected' : '' }}>Amount (Low)
                        </option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-filter"></i>
                    <span>Filter</span>
                </button>
            </form>
        </div>

        {{-- Bids Table --}}
        <div class="panel">

            <div class="panel-header">
                <h6>
                    <i class="fas fa-project-diagram"></i>
                    Projects Receiving Bids
                </h6>

                <span class="panel-header__meta">
                    {{ $projects->total() }} project(s) found
                </span>
            </div>

            <div class="panel-body panel-body--flush">

                @if ($projects->count())

                    <div class="table-scroll">

                        <table class="data-table">

                            <thead>
                                <tr>
                                    <th>Project</th>
                                    <th>Employer</th>
                                    <th>Budget</th>
                                    <th>Number of Bids</th>
                                    <th>Pending</th>
                                    <th>Accepted</th>
                                    <th>Rejected</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($projects as $project)
                                    @php
                                        $pendingCount = $project->freelancerBids->where('status', 'pending')->count();

                                        $acceptedCount = $project->freelancerBids->where('status', 'accepted')->count();

                                        $rejectedCount = $project->freelancerBids->where('status', 'rejected')->count();
                                    @endphp

                                    <tr>

                                        {{-- Project --}}
                                        <td>

                                            <div>
                                                <span class="cell-strong">
                                                    {{ $project->title }}
                                                </span>

                                                <small class="cell-muted">
                                                    Project #{{ $project->id }}
                                                </small>
                                            </div>

                                        </td>

                                        {{-- Employer --}}
                                        <td>

                                            <div class="person">

                                                <div class="avatar avatar--sm">
                                                    {{ strtoupper(substr($project->employer->name ?? 'N', 0, 1)) }}
                                                </div>

                                                <span>
                                                    {{ $project->employer->name ?? 'N/A' }}
                                                </span>

                                            </div>

                                        </td>

                                        {{-- Budget --}}
                                        <td>

                                            <span class="cell-amount">
                                                ₹{{ $project->budget }}
                                            </span>

                                        </td>

                                        {{-- Total bids --}}
                                        <td>

                                            <span class="badge badge--approved">
                                                <i class="fas fa-users"></i>

                                                {{ $project->freelancer_bids_count }}

                                            </span>

                                        </td>

                                        {{-- Pending --}}
                                        <td>

                                            <span class="badge badge--pending">
                                                {{ $pendingCount }}
                                            </span>

                                        </td>

                                        {{-- Accepted --}}
                                        <td>

                                            <span class="badge badge--approved">
                                                {{ $acceptedCount }}
                                            </span>

                                        </td>

                                        {{-- Rejected --}}
                                        <td>

                                            <span class="badge badge--rejected">
                                                {{ $rejectedCount }}
                                            </span>

                                        </td>

                                        {{-- Action --}}
                                        <td class="text-center">

                                            <a href="{{ route('employer.freelancer.bids.project', $project->id) }}"
                                                class="btn btn-outline btn-sm">
                                                <i class="fas fa-eye"></i>
                                                <span>View Bids</span>
                                            </a>

                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>

                        </table>

                    </div>

                    <div class="table-footer">

                        <div class="table-footer__meta">

                            Showing
                            {{ $projects->firstItem() ?? 0 }}
                            to
                            {{ $projects->lastItem() ?? 0 }}
                            of
                            {{ $projects->total() }}
                            projects

                        </div>

                        <div class="table-footer__pagination">

                            {{ $projects->appends(request()->query())->links() }}

                        </div>

                    </div>
                @else
                    <div class="empty-state">

                        <div class="empty-state__icon">
                            <i class="fas fa-project-diagram"></i>
                        </div>

                        <h5>No Projects Found</h5>

                        <p>
                            There are currently no projects with freelancer bids.
                        </p>

                    </div>

                @endif

            </div>

        </div>
    </div>

    @push('styles')
        <style>
            /* ===== SHARED TOKENS (aligned with admin layout) ===== */
            .bids-page {
                --ink: #1a1a2e;
                --ink-soft: #4a4a5a;
                --muted: #8a8fa8;
                --border: #eef2f7;
                --border-strong: #e9edf4;
                --surface: #ffffff;
                --surface-soft: #f8faff;
                --primary: #4a6cf7;
                --primary-dark: #3a5ce0;
                --primary-soft: rgba(74, 108, 247, 0.1);
                --success: #10b981;
                --success-soft: rgba(16, 185, 129, 0.12);
                --warning: #f59e0b;
                --warning-soft: rgba(245, 158, 11, 0.12);
                --danger: #ef4444;
                --danger-soft: rgba(239, 68, 68, 0.12);
                --radius: 12px;
                font-size: 0.9rem;
                color: var(--ink);
            }

            .bids-page * {
                box-sizing: border-box;
            }

            /* ===== STAT CARDS ===== */
            .stats-grid {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 1.25rem;
                margin-bottom: 1.5rem;
            }

            .stat-card {
                background: var(--surface);
                border: 1px solid var(--border);
                border-radius: var(--radius);
                padding: 1.25rem 1.5rem;
                display: flex;
                align-items: center;
                gap: 1rem;
                box-shadow: 0 1px 3px rgba(20, 20, 43, 0.04);
                transition: transform 0.18s ease, box-shadow 0.18s ease;
            }

            .stat-card:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 20px rgba(20, 20, 43, 0.08);
            }

            .stat-icon {
                width: 46px;
                height: 46px;
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.15rem;
                flex-shrink: 0;
            }

            .stat-icon--total {
                background: var(--primary-soft);
                color: var(--primary);
            }

            .stat-icon--pending {
                background: var(--warning-soft);
                color: var(--warning);
            }

            .stat-icon--approved {
                background: var(--success-soft);
                color: var(--success);
            }

            .stat-icon--rejected {
                background: var(--danger-soft);
                color: var(--danger);
            }

            .stat-info {
                display: flex;
                flex-direction: column;
                gap: 0.15rem;
            }

            .stat-label {
                font-size: 0.7rem;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.06em;
                color: var(--muted);
            }

            .stat-value {
                font-size: 1.6rem;
                font-weight: 700;
                color: var(--ink);
                line-height: 1.2;
            }

            /* ===== PANELS ===== */
            .panel {
                background: var(--surface);
                border: 1px solid var(--border);
                border-radius: var(--radius);
                box-shadow: 0 1px 3px rgba(20, 20, 43, 0.04);
                margin-bottom: 1.5rem;
            }

            .panel-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 1rem 1.5rem;
                border-bottom: 1px solid var(--border);
            }

            .panel-header h6 {
                margin: 0;
                font-size: 0.95rem;
                font-weight: 700;
                color: var(--primary);
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .panel-header__meta {
                font-size: 0.8rem;
                color: var(--muted);
            }

            .panel-body {
                padding: 1.5rem;
            }

            .panel-body--flush {
                padding: 0;
            }

            /* ===== FILTER BAR ===== */
            .filter-panel {
                padding: 1.25rem 1.5rem;
            }

            .filter-form {
                display: flex;
                align-items: flex-end;
                gap: 1rem;
                flex-wrap: wrap;
            }

            .field {
                display: flex;
                flex-direction: column;
                gap: 0.35rem;
                min-width: 160px;
            }

            .field--grow {
                flex: 1 1 260px;
            }

            .field label {
                font-size: 0.72rem;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.05em;
                color: var(--muted);
            }

            .field input,
            .field select {
                border: 1px solid var(--border-strong);
                border-radius: 9px;
                padding: 0.55rem 0.85rem;
                font-size: 0.85rem;
                font-family: inherit;
                color: var(--ink);
                background: var(--surface);
                transition: border-color 0.15s ease, box-shadow 0.15s ease;
            }

            .input-with-icon {
                position: relative;
                display: flex;
                align-items: center;
            }

            .input-with-icon i {
                position: absolute;
                left: 0.85rem;
                font-size: 0.8rem;
                color: var(--muted);
            }

            .input-with-icon input {
                width: 100%;
                padding-left: 2.25rem;
            }

            .field input:focus,
            .field select:focus {
                outline: none;
                border-color: var(--primary);
                box-shadow: 0 0 0 3px var(--primary-soft);
            }

            /* ===== BUTTONS ===== */
            .btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 0.5rem;
                font-family: inherit;
                font-size: 0.85rem;
                font-weight: 600;
                border-radius: 9px;
                padding: 0.6rem 1.25rem;
                border: 1px solid transparent;
                cursor: pointer;
                text-decoration: none;
                transition: all 0.15s ease;
                line-height: 1;
            }

            .btn i {
                font-size: 0.85em;
            }

            .btn-primary {
                background: var(--primary);
                color: #fff;
                box-shadow: 0 2px 8px rgba(74, 108, 247, 0.3);
            }

            .btn-primary:hover {
                background: var(--primary-dark);
                box-shadow: 0 4px 12px rgba(74, 108, 247, 0.35);
            }

            .btn-outline {
                background: var(--surface);
                color: var(--primary);
                border-color: var(--border-strong);
            }

            .btn-outline:hover {
                background: var(--primary-soft);
                border-color: var(--primary);
            }

            .btn-sm {
                padding: 0.4rem 0.9rem;
                font-size: 0.78rem;
            }

            /* ===== TABLE ===== */
            .table-scroll {
                overflow-x: auto;
            }

            .data-table {
                width: 100%;
                border-collapse: collapse;
            }

            .data-table thead th {
                text-align: left;
                font-size: 0.7rem;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.06em;
                color: var(--muted);
                background: var(--surface-soft);
                padding: 0.85rem 1.25rem;
                border-bottom: 1px solid var(--border);
                white-space: nowrap;
            }

            .data-table tbody td {
                padding: 0.9rem 1.25rem;
                border-bottom: 1px solid var(--border);
                vertical-align: middle;
                color: var(--ink-soft);
            }

            .data-table tbody tr:last-child td {
                border-bottom: none;
            }

            .data-table tbody tr:hover {
                background: var(--surface-soft);
            }

            .text-end {
                text-align: right;
            }

            .text-center {
                text-align: center;
            }

            .cell-strong {
                font-weight: 600;
                color: var(--ink);
            }

            .cell-muted {
                color: var(--muted);
                font-size: 0.82rem;
                white-space: nowrap;
            }

            .cell-amount {
                font-weight: 700;
                color: var(--success);
            }

            .cell-truncate {
                display: inline-block;
                max-width: 220px;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
                vertical-align: middle;
            }

            .person {
                display: flex;
                align-items: center;
                gap: 0.6rem;
            }

            .avatar {
                border-radius: 50%;
                background: linear-gradient(135deg, #4a6cf7, #6a4cf7);
                color: #fff;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 600;
                flex-shrink: 0;
            }

            .avatar--sm {
                width: 32px;
                height: 32px;
                font-size: 0.72rem;
            }

            /* ===== STATUS BADGE ===== */
            .badge {
                display: inline-flex;
                align-items: center;
                gap: 0.35rem;
                padding: 0.32rem 0.85rem;
                border-radius: 20px;
                font-size: 0.7rem;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.03em;
                white-space: nowrap;
            }

            .badge--pending {
                background: var(--warning-soft);
                color: #92400e;
            }

            .badge--approved {
                background: var(--success-soft);
                color: #065f46;
            }

            .badge--rejected {
                background: var(--danger-soft);
                color: #991b1b;
            }

            /* ===== TABLE FOOTER / PAGINATION ===== */
            .table-footer {
                display: flex;
                align-items: center;
                justify-content: space-between;
                flex-wrap: wrap;
                gap: 0.75rem;
                padding: 1rem 1.5rem;
                border-top: 1px solid var(--border);
            }

            .table-footer__meta {
                font-size: 0.8rem;
                color: var(--muted);
            }

            .table-footer__pagination :where(nav, ul) {
                display: flex;
                align-items: center;
                gap: 0.25rem;
                list-style: none;
                margin: 0;
                padding: 0;
            }

            .table-footer__pagination a,
            .table-footer__pagination span {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                min-width: 32px;
                height: 32px;
                padding: 0 0.5rem;
                border-radius: 7px;
                font-size: 0.8rem;
                color: var(--ink-soft);
                text-decoration: none;
            }

            .table-footer__pagination a:hover {
                background: var(--surface-soft);
            }

            .table-footer__pagination .active span {
                background: var(--primary);
                color: #fff;
            }

            /* ===== EMPTY STATE ===== */
            .empty-state {
                text-align: center;
                padding: 3.5rem 1.5rem;
            }

            .empty-state__icon {
                width: 72px;
                height: 72px;
                margin: 0 auto 1rem;
                border-radius: 50%;
                background: var(--surface-soft);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.8rem;
                color: var(--muted);
            }

            .empty-state h5 {
                margin: 0 0 0.35rem;
                font-weight: 700;
                color: var(--ink);
            }

            .empty-state p {
                margin: 0;
                color: var(--muted);
                font-size: 0.85rem;
            }

            /* ===== RESPONSIVE ===== */
            @media (max-width: 992px) {
                .stats-grid {
                    grid-template-columns: repeat(2, 1fr);
                }
            }

            @media (max-width: 640px) {
                .stats-grid {
                    grid-template-columns: 1fr;
                }

                .filter-form {
                    flex-direction: column;
                    align-items: stretch;
                }

                .field {
                    min-width: 0;
                }

                .filter-form .btn {
                    width: 100%;
                }
            }
        </style>
    @endpush
@endsection

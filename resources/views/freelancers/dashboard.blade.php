{{-- resources/views/freelancers/dashboard.blade.php --}}
@extends('freelancers.layout.app')

@section('title', 'Freelancer Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Freelancer overview')

@section('content')
    <!-- ===== STATISTICS CARDS ===== -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-folder-open"></i></div>
            <div class="stat-info">
                <div class="stat-label">Active Projects</div>
                <div class="stat-number">{{ $stats['active_projects'] ?? 5 }}</div>
                <div class="stat-sub">{{ $stats['completed_projects'] ?? 12 }} completed · {{ $stats['total_projects'] ?? 17 }} total</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-file-signature"></i></div>
            <div class="stat-info">
                <div class="stat-label">Proposals</div>
                <div class="stat-number">{{ $stats['total_proposals'] ?? 28 }}</div>
                <div class="stat-sub">{{ $stats['pending_proposals'] ?? 6 }} pending · {{ $stats['accepted_proposals'] ?? 14 }} accepted</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-dollar-sign"></i></div>
            <div class="stat-info">
                <div class="stat-label">Earnings</div>
                <div class="stat-number">${{ number_format($stats['earnings'] ?? 12450, 0) }}</div>
                <div class="stat-sub">↑ {{ $stats['earnings_change'] ?? 15 }}% from last month</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-star"></i></div>
            <div class="stat-info">
                <div class="stat-label">Rating</div>
                <div class="stat-number">{{ number_format($stats['rating'] ?? 4.8, 1) }}</div>
                <div class="stat-sub">{{ $stats['total_reviews'] ?? 42 }} reviews · 5 stars</div>
            </div>
        </div>
    </div>

    <!-- ===== TWO COLUMN LAYOUT ===== -->
    <div class="two-col">
        <!-- LEFT COLUMN -->
        <div class="left-panel">

            <!-- Recent Proposals -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="fas fa-file-signature"></i> Recent Proposals
                    </div>
                    <a href="#" class="card-link">View all</a>
                </div>
                <div class="card-body">
                    @foreach($proposals ?? [] as $proposal)
                        <div class="proposal-item">
                            <div class="proposal-info">
                                <div class="proposal-title">{{ $proposal['title'] }}</div>
                                <div class="proposal-details">
                                    <i class="fas fa-user"></i> {{ $proposal['client'] }}
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="far fa-clock"></i> {{ $proposal['submitted_at'] }}
                                </div>
                            </div>
                            <span class="status-badge status-{{ $proposal['status'] }}">
                                {{ ucfirst($proposal['status']) }}
                            </span>
                        </div>
                    @endforeach

                    @if(empty($proposals))
                        <div class="proposal-item">
                            <div class="proposal-info">
                                <div class="proposal-title">E-commerce Website Development</div>
                                <div class="proposal-details">
                                    <i class="fas fa-user"></i> TechStart Inc.
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="far fa-clock"></i> 2 hours ago
                                </div>
                            </div>
                            <span class="status-badge status-pending">Pending</span>
                        </div>
                        <div class="proposal-item">
                            <div class="proposal-info">
                                <div class="proposal-title">Mobile App UI/UX Design</div>
                                <div class="proposal-details">
                                    <i class="fas fa-user"></i> Creative Agency
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="far fa-clock"></i> Yesterday
                                </div>
                            </div>
                            <span class="status-badge status-accepted">Accepted</span>
                        </div>
                        <div class="proposal-item">
                            <div class="proposal-info">
                                <div class="proposal-title">Content Writing for Blog</div>
                                <div class="proposal-details">
                                    <i class="fas fa-user"></i> Media House
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="far fa-clock"></i> 2 days ago
                                </div>
                            </div>
                            <span class="status-badge status-review">Under Review</span>
                        </div>
                        <div class="proposal-item" style="border-bottom: none;">
                            <div class="proposal-info">
                                <div class="proposal-title">Brand Identity Design</div>
                                <div class="proposal-details">
                                    <i class="fas fa-user"></i> Startup Hub
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="far fa-clock"></i> 3 days ago
                                </div>
                            </div>
                            <span class="status-badge status-declined">Declined</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Active Contracts -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="fas fa-file-contract"></i> Active Contracts
                    </div>
                    <a href="3" class="card-link">View all</a>
                </div>
                <div class="card-body">
                    @foreach($contracts ?? [] as $contract)
                        <div class="contract-item">
                            <div class="contract-info">
                                <div class="contract-title">{{ $contract['title'] }}</div>
                                <div class="contract-details">
                                    <i class="fas fa-user"></i> {{ $contract['client'] }}
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="fas fa-dollar-sign"></i> ${{ number_format($contract['budget'], 0) }}
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="far fa-calendar"></i> {{ $contract['deadline'] }}
                                </div>
                            </div>
                            <div class="contract-progress">
                                <div class="progress-track small">
                                    <div class="progress-fill" style="width: {{ $contract['progress'] }}%;"></div>
                                </div>
                                <span class="progress-text">{{ $contract['progress'] }}%</span>
                            </div>
                        </div>
                    @endforeach

                    @if(empty($contracts))
                        <div class="contract-item">
                            <div class="contract-info">
                                <div class="contract-title">E-commerce Website Development</div>
                                <div class="contract-details">
                                    <i class="fas fa-user"></i> TechStart Inc.
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="fas fa-dollar-sign"></i> $5,000
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="far fa-calendar"></i> Dec 15, 2026
                                </div>
                            </div>
                            <div class="contract-progress">
                                <div class="progress-track small">
                                    <div class="progress-fill" style="width: 65%;"></div>
                                </div>
                                <span class="progress-text">65%</span>
                            </div>
                        </div>
                        <div class="contract-item">
                            <div class="contract-info">
                                <div class="contract-title">Mobile App UI/UX Design</div>
                                <div class="contract-details">
                                    <i class="fas fa-user"></i> Creative Agency
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="fas fa-dollar-sign"></i> $3,200
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="far fa-calendar"></i> Dec 20, 2026
                                </div>
                            </div>
                            <div class="contract-progress">
                                <div class="progress-track small">
                                    <div class="progress-fill" style="width: 40%;"></div>
                                </div>
                                <span class="progress-text">40%</span>
                            </div>
                        </div>
                        <div class="contract-item" style="border-bottom: none;">
                            <div class="contract-info">
                                <div class="contract-title">Content Writing for Blog</div>
                                <div class="contract-details">
                                    <i class="fas fa-user"></i> Media House
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="fas fa-dollar-sign"></i> $1,500
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="far fa-calendar"></i> Dec 10, 2026
                                </div>
                            </div>
                            <div class="contract-progress">
                                <div class="progress-track small">
                                    <div class="progress-fill" style="width: 90%;"></div>
                                </div>
                                <span class="progress-text">90%</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>

        <!-- RIGHT COLUMN -->
        <div class="right-panel">

            <!-- Upcoming Milestones -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="fas fa-flag"></i> Upcoming Milestones
                    </div>
                    <a href="#" class="card-link">View all</a>
                </div>
                <div class="card-body">
                    @foreach($milestones ?? [] as $milestone)
                        <div class="milestone-item">
                            <div class="milestone-info">
                                <div class="milestone-title">{{ $milestone['title'] }}</div>
                                <div class="milestone-details">
                                    <i class="fas fa-folder-open"></i> {{ $milestone['project'] }}
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="fas fa-dollar-sign"></i> ${{ number_format($milestone['amount'], 0) }}
                                </div>
                            </div>
                            <span class="milestone-date">{{ $milestone['due_date'] }}</span>
                        </div>
                    @endforeach

                    @if(empty($milestones))
                        <div class="milestone-item">
                            <div class="milestone-info">
                                <div class="milestone-title">MVP Launch</div>
                                <div class="milestone-details">
                                    <i class="fas fa-folder-open"></i> E-commerce Website
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="fas fa-dollar-sign"></i> $2,500
                                </div>
                            </div>
                            <span class="milestone-date">Dec 15, 2026</span>
                        </div>
                        <div class="milestone-item">
                            <div class="milestone-info">
                                <div class="milestone-title">Design Finalization</div>
                                <div class="milestone-details">
                                    <i class="fas fa-folder-open"></i> Mobile App UI/UX
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="fas fa-dollar-sign"></i> $1,800
                                </div>
                            </div>
                            <span class="milestone-date">Dec 18, 2026</span>
                        </div>
                        <div class="milestone-item">
                            <div class="milestone-info">
                                <div class="milestone-title">Content Submission</div>
                                <div class="milestone-details">
                                    <i class="fas fa-folder-open"></i> Blog Content Writing
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="fas fa-dollar-sign"></i> $1,500
                                </div>
                            </div>
                            <span class="milestone-date">Dec 10, 2026</span>
                        </div>
                        <div class="milestone-item" style="border-bottom: none;">
                            <div class="milestone-info">
                                <div class="milestone-title">Brand Guidelines</div>
                                <div class="milestone-details">
                                    <i class="fas fa-folder-open"></i> Brand Identity Design
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="fas fa-dollar-sign"></i> $800
                                </div>
                            </div>
                            <span class="milestone-date">Dec 22, 2026</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="fas fa-rocket"></i> Quick Actions
                    </div>
                </div>
                <div class="card-body" style="padding-bottom: 6px;">
                    <button class="quick-btn" onclick="window.location.href=#">
                        <i class="fas fa-plus-circle"></i> Submit Proposal
                    </button>
                    <button class="quick-btn" style="margin-top:12px; background:#059669; box-shadow:0 6px 0 #047857;" onclick="window.location.href=#">
                        <i class="fas fa-tasks"></i> Add Task
                    </button>
                    <button class="quick-btn" style="margin-top:12px; background:#3A5079; box-shadow:0 6px 0 #253a57;" onclick="window.location.href=#">
                        <i class="fas fa-file-invoice"></i> Create Invoice
                    </button>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="fas fa-bolt"></i> Recent Activity
                    </div>
                </div>
                <div class="card-body">
                    <div class="activity-item">
                        <div class="activity-icon" style="background:#d1fae5;color:#059669;"><i class="fas fa-check-circle"></i></div>
                        <div class="activity-content">
                            <div class="act-title">Milestone completed: Homepage Design</div>
                            <div class="act-meta"><i class="far fa-clock"></i> 1 hour ago</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon" style="background:#dbeafe;color:#3b82f6;"><i class="fas fa-file-signature"></i></div>
                        <div class="activity-content">
                            <div class="act-title">Proposal accepted: E-commerce Website</div>
                            <div class="act-meta"><i class="far fa-clock"></i> 3 hours ago</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon" style="background:#fef3c7;color:#f59e0b;"><i class="fas fa-dollar-sign"></i></div>
                        <div class="activity-content">
                            <div class="act-title">Payment received: $1,500 from Media House</div>
                            <div class="act-meta"><i class="far fa-clock"></i> Yesterday, 5:30 PM</div>
                        </div>
                    </div>
                    <div class="activity-item" style="border-bottom: none;">
                        <div class="activity-icon" style="background:#ede9fe;color:#7c3aed;"><i class="fas fa-star"></i></div>
                        <div class="activity-content">
                            <div class="act-title">New 5-star review from TechStart Inc.</div>
                            <div class="act-meta"><i class="far fa-clock"></i> 2 days ago</div>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- /right-panel -->
    </div><!-- /two-col -->
@endsection

@push('styles')
<style>
    /* ===== FREELANCER DASHBOARD STYLES ===== */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 1.25rem 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        border: 1px solid #edf2f7;
        transition: transform 0.15s ease, box-shadow 0.15s ease;
    }
    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        background: #d1fae5;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        color: #059669;
        flex-shrink: 0;
    }

    .stat-info {
        flex: 1;
    }
    .stat-label {
        font-size: 0.8rem;
        font-weight: 500;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }
    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: #0f172a;
        line-height: 1.2;
        margin: 0.1rem 0 0.1rem;
    }
    .stat-sub {
        font-size: 0.78rem;
        color: #94a3b8;
    }

    /* Cards */
    .card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #edf2f7;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
        margin-bottom: 1.5rem;
        overflow: hidden;
    }

    .card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1.1rem 1.5rem 0.6rem 1.5rem;
        border-bottom: 1px solid #f1f5f9;
    }

    .card-title {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        font-weight: 600;
        font-size: 1rem;
        color: #0f172a;
    }
    .card-title i {
        color: #059669;
        font-size: 1.1rem;
        width: 1.6rem;
    }

    .card-badge {
        background: #f1f5f9;
        padding: 0.2rem 0.9rem;
        border-radius: 30px;
        font-size: 0.7rem;
        font-weight: 500;
        color: #475569;
    }

    .card-link {
        font-size: 0.8rem;
        color: #059669;
        text-decoration: none;
        font-weight: 500;
    }
    .card-link:hover {
        text-decoration: underline;
    }

    .card-body {
        padding: 1.2rem 1.5rem 1.5rem;
    }

    /* Proposal items */
    .proposal-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.7rem 0;
        border-bottom: 1px solid #f1f5f9;
    }
    .proposal-item:last-child {
        border-bottom: none;
    }

    .proposal-info {
        flex: 1;
    }
    .proposal-title {
        font-weight: 500;
        font-size: 0.9rem;
        color: #0f172a;
    }
    .proposal-details {
        font-size: 0.78rem;
        color: #94a3b8;
        margin-top: 0.05rem;
    }
    .proposal-details i {
        font-size: 0.7rem;
    }

    .status-badge {
        padding: 0.2rem 0.9rem;
        border-radius: 30px;
        font-size: 0.7rem;
        font-weight: 600;
        white-space: nowrap;
        margin-left: 0.5rem;
    }
    .status-pending {
        background: #fef3c7;
        color: #92400e;
    }
    .status-review {
        background: #dbeafe;
        color: #1e40af;
    }
    .status-accepted {
        background: #d1fae5;
        color: #065f46;
    }
    .status-declined {
        background: #fee2e2;
        color: #991b1b;
    }
    .status-completed {
        background: #d1fae5;
        color: #065f46;
    }
    .status-in-progress {
        background: #ede9fe;
        color: #5b21b6;
    }

    /* Contract items */
    .contract-item {
        padding: 0.7rem 0;
        border-bottom: 1px solid #f1f5f9;
    }
    .contract-item:last-child {
        border-bottom: none;
    }

    .contract-info {
        margin-bottom: 0.4rem;
    }
    .contract-title {
        font-weight: 500;
        font-size: 0.9rem;
        color: #0f172a;
    }
    .contract-details {
        font-size: 0.78rem;
        color: #94a3b8;
        margin-top: 0.05rem;
    }
    .contract-details i {
        font-size: 0.7rem;
    }

    .contract-progress {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .progress-track.small {
        flex: 1;
        height: 4px;
        background: #e9edf4;
        border-radius: 20px;
        overflow: hidden;
    }
    .progress-track.small .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #10b981, #34d399);
        border-radius: 20px;
        transition: width 0.6s cubic-bezier(0.22, 1, 0.36, 1);
        width: 0%;
    }
    .progress-text {
        font-size: 0.78rem;
        font-weight: 600;
        color: #0f172a;
        min-width: 38px;
        text-align: right;
    }

    /* Milestone items */
    .milestone-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.7rem 0;
        border-bottom: 1px solid #f1f5f9;
    }
    .milestone-item:last-child {
        border-bottom: none;
    }

    .milestone-info {
        flex: 1;
    }
    .milestone-title {
        font-weight: 500;
        font-size: 0.9rem;
        color: #0f172a;
    }
    .milestone-details {
        font-size: 0.78rem;
        color: #94a3b8;
        margin-top: 0.05rem;
    }
    .milestone-details i {
        font-size: 0.7rem;
    }

    .milestone-date {
        font-size: 0.78rem;
        font-weight: 500;
        color: #059669;
        white-space: nowrap;
        margin-left: 0.5rem;
    }

    /* Activity */
    .activity-item {
        display: flex;
        gap: 0.9rem;
        padding: 0.6rem 0;
        border-bottom: 1px solid #f1f5f9;
    }
    .activity-item:last-child {
        border-bottom: none;
    }
    .activity-icon {
        width: 34px;
        height: 34px;
        background: #f1f5f9;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #059669;
        flex-shrink: 0;
    }
    .activity-content .act-title {
        font-weight: 500;
        font-size: 0.9rem;
        color: #0f172a;
    }
    .activity-content .act-meta {
        font-size: 0.78rem;
        color: #94a3b8;
        display: flex;
        align-items: center;
        gap: 0.3rem;
        margin-top: 0.1rem;
    }
    .activity-content .act-meta i {
        font-size: 0.7rem;
    }

    /* Quick buttons */
    .quick-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.6rem;
        width: 100%;
        padding: 0.8rem;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.9rem;
        background: #059669;
        color: #fff;
        box-shadow: 0 6px 0 #047857;
        cursor: pointer;
        transition: all 0.08s ease;
    }
    .quick-btn:active {
        transform: translateY(3px);
        box-shadow: 0 3px 0 #047857;
    }
    .quick-btn i {
        font-size: 1rem;
    }

    /* Two column */
    .two-col {
        display: grid;
        grid-template-columns: 1.6fr 1fr;
        gap: 1.5rem;
        margin-top: 0.25rem;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .two-col {
            grid-template-columns: 1fr;
        }
        .stats-grid {
            grid-template-columns: 1fr 1fr;
        }
        .card-header {
            flex-wrap: wrap;
            gap: 0.4rem;
        }
        .proposal-item {
            flex-wrap: wrap;
            gap: 0.5rem;
        }
        .milestone-item {
            flex-wrap: wrap;
            gap: 0.5rem;
        }
        .contract-details {
            flex-wrap: wrap;
        }
    }

    @media (max-width: 480px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
        .stat-card {
            padding: 1rem;
        }
        .stat-number {
            font-size: 1.6rem;
        }
        .milestone-date {
            font-size: 0.7rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animate progress bars
        const fills = document.querySelectorAll('.progress-fill');
        fills.forEach(function(el, index) {
            const w = el.style.width;
            el.style.width = '0%';
            setTimeout(function() {
                el.style.width = w;
            }, 80 + (index * 80));
        });
    });
</script>
@endpush
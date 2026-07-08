{{-- resources/views/investors/dashboard.blade.php --}}
@extends('investors.layout.app')

@section('title', 'Investor Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Investor overview')

@section('content')
    <!-- ===== STATISTICS CARDS ===== -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-briefcase"></i></div>
            <div class="stat-info">
                <div class="stat-label">Portfolio Value</div>
                <div class="stat-number">${{ number_format($stats['portfolio_value'] ?? 2845000, 0) }}</div>
                <div class="stat-sub">↑ {{ $stats['value_change'] ?? 12.5 }}% from last quarter</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
            <div class="stat-info">
                <div class="stat-label">Total Investments</div>
                <div class="stat-number">{{ $stats['total_investments'] ?? 18 }}</div>
                <div class="stat-sub">{{ $stats['active_investments'] ?? 8 }} active · {{ $stats['exited_investments'] ?? 5 }} exited</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-arrow-trend-up"></i></div>
            <div class="stat-info">
                <div class="stat-label">ROI</div>
                <div class="stat-number">{{ number_format($stats['roi'] ?? 24.8, 1) }}<small style="font-size:1rem;font-weight:400;color:#94a3b8;">%</small></div>
                <div class="stat-sub">↑ {{ $stats['roi_change'] ?? 3.2 }}% from last year</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-handshake"></i></div>
            <div class="stat-info">
                <div class="stat-label">Startups Funded</div>
                <div class="stat-number">{{ $stats['startups_funded'] ?? 12 }}</div>
                <div class="stat-sub">{{ $stats['new_startups'] ?? 3 }} new this quarter</div>
            </div>
        </div>
    </div>

    <!-- ===== TWO COLUMN LAYOUT ===== -->
    <div class="two-col">
        <!-- LEFT COLUMN -->
        <div class="left-panel">

            <!-- Portfolio Performance -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="fas fa-chart-simple"></i> Portfolio Performance
                    </div>
                    <span class="card-badge">Last 6 months</span>
                </div>
                <div class="card-body">
                    @foreach($portfolio ?? [] as $item)
                        <div class="portfolio-item">
                            <div class="portfolio-info">
                                <div class="portfolio-name">{{ $item['name'] }}</div>
                                <div class="portfolio-details">
                                    <i class="fas fa-building"></i> {{ $item['startup'] }}
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="fas fa-dollar-sign"></i> ${{ number_format($item['investment'], 0) }}
                                </div>
                            </div>
                            <div class="portfolio-performance">
                                <span class="performance-value {{ $item['change'] >= 0 ? 'positive' : 'negative' }}">
                                    {{ $item['change'] >= 0 ? '+' : '' }}{{ number_format($item['change'], 1) }}%
                                </span>
                                <div class="progress-track small">
                                    <div class="progress-fill" style="width: {{ $item['progress'] }}%;"></div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @if(empty($portfolio))
                        <div class="portfolio-item">
                            <div class="portfolio-info">
                                <div class="portfolio-name">TechFlow AI</div>
                                <div class="portfolio-details">
                                    <i class="fas fa-building"></i> NeuralTech Inc.
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="fas fa-dollar-sign"></i> $450,000
                                </div>
                            </div>
                            <div class="portfolio-performance">
                                <span class="performance-value positive">+28.5%</span>
                                <div class="progress-track small">
                                    <div class="progress-fill" style="width: 78%;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="portfolio-item">
                            <div class="portfolio-info">
                                <div class="portfolio-name">GreenEnergy Solutions</div>
                                <div class="portfolio-details">
                                    <i class="fas fa-building"></i> EcoPower Labs
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="fas fa-dollar-sign"></i> $320,000
                                </div>
                            </div>
                            <div class="portfolio-performance">
                                <span class="performance-value positive">+15.2%</span>
                                <div class="progress-track small">
                                    <div class="progress-fill" style="width: 65%;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="portfolio-item">
                            <div class="portfolio-info">
                                <div class="portfolio-name">FinTech Hub</div>
                                <div class="portfolio-details">
                                    <i class="fas fa-building"></i> PayFlow Systems
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="fas fa-dollar-sign"></i> $280,000
                                </div>
                            </div>
                            <div class="portfolio-performance">
                                <span class="performance-value negative">-4.8%</span>
                                <div class="progress-track small">
                                    <div class="progress-fill" style="width: 42%;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="portfolio-item" style="border-bottom: none;">
                            <div class="portfolio-info">
                                <div class="portfolio-name">HealthTech Innovations</div>
                                <div class="portfolio-details">
                                    <i class="fas fa-building"></i> MediCare AI
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="fas fa-dollar-sign"></i> $520,000
                                </div>
                            </div>
                            <div class="portfolio-performance">
                                <span class="performance-value positive">+42.3%</span>
                                <div class="progress-track small">
                                    <div class="progress-fill" style="width: 92%;"></div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Recent Investments -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="fas fa-clock"></i> Recent Investments
                    </div>
                    <a href="#" class="card-link">View all</a>
                </div>
                <div class="card-body">
                    @foreach($recentInvestments ?? [] as $investment)
                        <div class="investment-item">
                            <div class="investment-info">
                                <div class="investment-name">{{ $investment['startup'] }}</div>
                                <div class="investment-details">
                                    <i class="fas fa-dollar-sign"></i> ${{ number_format($investment['amount'], 0) }}
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="far fa-calendar"></i> {{ $investment['date'] }}
                                </div>
                            </div>
                            <span class="investment-status status-{{ $investment['status'] }}">
                                {{ ucfirst($investment['status']) }}
                            </span>
                        </div>
                    @endforeach

                    @if(empty($recentInvestments))
                        <div class="investment-item">
                            <div class="investment-info">
                                <div class="investment-name">NeuralTech Inc.</div>
                                <div class="investment-details">
                                    <i class="fas fa-dollar-sign"></i> $450,000
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="far fa-calendar"></i> Dec 5, 2026
                                </div>
                            </div>
                            <span class="investment-status status-active">Active</span>
                        </div>
                        <div class="investment-item">
                            <div class="investment-info">
                                <div class="investment-name">EcoPower Labs</div>
                                <div class="investment-details">
                                    <i class="fas fa-dollar-sign"></i> $320,000
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="far fa-calendar"></i> Nov 20, 2026
                                </div>
                            </div>
                            <span class="investment-status status-active">Active</span>
                        </div>
                        <div class="investment-item">
                            <div class="investment-info">
                                <div class="investment-name">PayFlow Systems</div>
                                <div class="investment-details">
                                    <i class="fas fa-dollar-sign"></i> $280,000
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="far fa-calendar"></i> Nov 10, 2026
                                </div>
                            </div>
                            <span class="investment-status status-active">Active</span>
                        </div>
                        <div class="investment-item" style="border-bottom: none;">
                            <div class="investment-info">
                                <div class="investment-name">MediCare AI</div>
                                <div class="investment-details">
                                    <i class="fas fa-dollar-sign"></i> $520,000
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="far fa-calendar"></i> Oct 28, 2026
                                </div>
                            </div>
                            <span class="investment-status status-exited">Exited</span>
                        </div>
                    @endif
                </div>
            </div>

        </div>

        <!-- RIGHT COLUMN -->
        <div class="right-panel">

            <!-- Upcoming Meetings -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="fas fa-calendar-check"></i> Upcoming Meetings
                    </div>
                    <a href="#" class="card-link">View all</a>
                </div>
                <div class="card-body">
                    @foreach($upcomingMeetings ?? [] as $meeting)
                        <div class="meeting-item">
                            <div class="meeting-info">
                                <div class="meeting-title">{{ $meeting['title'] }}</div>
                                <div class="meeting-details">
                                    <i class="fas fa-building"></i> {{ $meeting['startup'] }}
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="fas fa-user"></i> {{ $meeting['contact'] }}
                                </div>
                            </div>
                            <span class="meeting-time">{{ $meeting['time'] }}</span>
                        </div>
                    @endforeach

                    @if(empty($upcomingMeetings))
                        <div class="meeting-item">
                            <div class="meeting-info">
                                <div class="meeting-title">Pitch Presentation</div>
                                <div class="meeting-details">
                                    <i class="fas fa-building"></i> NeuralTech Inc.
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="fas fa-user"></i> Sarah Chen (CEO)
                                </div>
                            </div>
                            <span class="meeting-time">Today, 2:00 PM</span>
                        </div>
                        <div class="meeting-item">
                            <div class="meeting-info">
                                <div class="meeting-title">Board Meeting</div>
                                <div class="meeting-details">
                                    <i class="fas fa-building"></i> EcoPower Labs
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="fas fa-user"></i> Michael Rodriguez (COO)
                                </div>
                            </div>
                            <span class="meeting-time">Tomorrow, 10:30 AM</span>
                        </div>
                        <div class="meeting-item">
                            <div class="meeting-info">
                                <div class="meeting-title">Due Diligence Call</div>
                                <div class="meeting-details">
                                    <i class="fas fa-building"></i> PayFlow Systems
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="fas fa-user"></i> David Kim (CFO)
                                </div>
                            </div>
                            <span class="meeting-time">Wed, 11:00 AM</span>
                        </div>
                        <div class="meeting-item" style="border-bottom: none;">
                            <div class="meeting-info">
                                <div class="meeting-title">Investment Review</div>
                                <div class="meeting-details">
                                    <i class="fas fa-building"></i> MediCare AI
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="fas fa-user"></i> Emily Park (CTO)
                                </div>
                            </div>
                            <span class="meeting-time">Thu, 3:30 PM</span>
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
                        <i class="fas fa-plus-circle"></i> New Investment
                    </button>
                    <button class="quick-btn" style="margin-top:12px; background:#1d4ed8; box-shadow:0 6px 0 #1e3a8a;" onclick="window.location.href=#">
                        <i class="fas fa-rocket"></i> Browse Startups
                    </button>
                    <button class="quick-btn" style="margin-top:12px; background:#3A5079; box-shadow:0 6px 0 #253a57;" onclick="window.location.href=#">
                        <i class="fas fa-calendar-plus"></i> Schedule Meeting
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
                        <div class="activity-icon" style="background:#dbeafe;color:#3b82f6;"><i class="fas fa-check-circle"></i></div>
                        <div class="activity-content">
                            <div class="act-title">Investment confirmed: MediCare AI</div>
                            <div class="act-meta"><i class="far fa-clock"></i> 2 hours ago</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon" style="background:#d1fae5;color:#059669;"><i class="fas fa-file-signature"></i></div>
                        <div class="activity-content">
                            <div class="act-title">Term sheet signed: PayFlow Systems</div>
                            <div class="act-meta"><i class="far fa-clock"></i> Yesterday, 5:30 PM</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon" style="background:#fef3c7;color:#f59e0b;"><i class="fas fa-chart-line"></i></div>
                        <div class="activity-content">
                            <div class="act-title">Portfolio value increased by 8.2%</div>
                            <div class="act-meta"><i class="far fa-clock"></i> 2 days ago</div>
                        </div>
                    </div>
                    <div class="activity-item" style="border-bottom: none;">
                        <div class="activity-icon" style="background:#ede9fe;color:#7c3aed;"><i class="fas fa-handshake"></i></div>
                        <div class="activity-content">
                            <div class="act-title">Meeting completed with NeuralTech Inc.</div>
                            <div class="act-meta"><i class="far fa-clock"></i> 3 days ago</div>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- /right-panel -->
    </div><!-- /two-col -->
@endsection

@push('styles')
<style>
    /* ===== INVESTOR DASHBOARD STYLES ===== */
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
        background: #dbeafe;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        color: #3b82f6;
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
        color: #3b82f6;
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
        color: #3b82f6;
        text-decoration: none;
        font-weight: 500;
    }
    .card-link:hover {
        text-decoration: underline;
    }

    .card-body {
        padding: 1.2rem 1.5rem 1.5rem;
    }

    /* Portfolio items */
    .portfolio-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.7rem 0;
        border-bottom: 1px solid #f1f5f9;
    }
    .portfolio-item:last-child {
        border-bottom: none;
    }

    .portfolio-info {
        flex: 1;
    }
    .portfolio-name {
        font-weight: 500;
        font-size: 0.9rem;
        color: #0f172a;
    }
    .portfolio-details {
        font-size: 0.78rem;
        color: #94a3b8;
        margin-top: 0.05rem;
    }
    .portfolio-details i {
        font-size: 0.7rem;
    }

    .portfolio-performance {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        min-width: 140px;
        justify-content: flex-end;
    }
    .performance-value {
        font-weight: 600;
        font-size: 0.85rem;
        min-width: 55px;
        text-align: right;
    }
    .performance-value.positive {
        color: #059669;
    }
    .performance-value.negative {
        color: #dc2626;
    }

    .progress-track.small {
        width: 60px;
        height: 4px;
        background: #e9edf4;
        border-radius: 20px;
        overflow: hidden;
    }
    .progress-track.small .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #3b82f6, #60a5fa);
        border-radius: 20px;
        transition: width 0.6s cubic-bezier(0.22, 1, 0.36, 1);
        width: 0%;
    }

    /* Investment items */
    .investment-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.7rem 0;
        border-bottom: 1px solid #f1f5f9;
    }
    .investment-item:last-child {
        border-bottom: none;
    }

    .investment-info {
        flex: 1;
    }
    .investment-name {
        font-weight: 500;
        font-size: 0.9rem;
        color: #0f172a;
    }
    .investment-details {
        font-size: 0.78rem;
        color: #94a3b8;
        margin-top: 0.05rem;
    }
    .investment-details i {
        font-size: 0.7rem;
    }

    .investment-status {
        padding: 0.2rem 0.9rem;
        border-radius: 30px;
        font-size: 0.7rem;
        font-weight: 600;
        white-space: nowrap;
        margin-left: 0.5rem;
    }
    .investment-status.status-active {
        background: #d1fae5;
        color: #065f46;
    }
    .investment-status.status-exited {
        background: #fee2e2;
        color: #991b1b;
    }
    .investment-status.status-pending {
        background: #fef3c7;
        color: #92400e;
    }
    .investment-status.status-considering {
        background: #dbeafe;
        color: #1e40af;
    }

    /* Meeting items */
    .meeting-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.7rem 0;
        border-bottom: 1px solid #f1f5f9;
    }
    .meeting-item:last-child {
        border-bottom: none;
    }

    .meeting-info {
        flex: 1;
    }
    .meeting-title {
        font-weight: 500;
        font-size: 0.9rem;
        color: #0f172a;
    }
    .meeting-details {
        font-size: 0.78rem;
        color: #94a3b8;
        margin-top: 0.05rem;
    }
    .meeting-details i {
        font-size: 0.7rem;
    }

    .meeting-time {
        font-size: 0.78rem;
        font-weight: 500;
        color: #3b82f6;
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
        color: #3b82f6;
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
        background: #3b82f6;
        color: #fff;
        box-shadow: 0 6px 0 #1d4ed8;
        cursor: pointer;
        transition: all 0.08s ease;
    }
    .quick-btn:active {
        transform: translateY(3px);
        box-shadow: 0 3px 0 #1d4ed8;
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
        .portfolio-item {
            flex-wrap: wrap;
            gap: 0.5rem;
        }
        .portfolio-performance {
            min-width: 100%;
            justify-content: flex-start;
        }
        .investment-item {
            flex-wrap: wrap;
            gap: 0.5rem;
        }
        .meeting-item {
            flex-wrap: wrap;
            gap: 0.5rem;
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
        .meeting-time {
            font-size: 0.7rem;
        }
        .performance-value {
            font-size: 0.8rem;
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
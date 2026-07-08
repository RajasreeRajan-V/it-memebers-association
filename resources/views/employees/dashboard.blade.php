{{-- resources/views/employees/dashboard.blade.php --}}
@extends('employees.layout.app')

@section('title', 'Employee Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Employee overview')

@section('content')
    <!-- ===== STATISTICS CARDS ===== -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-tasks"></i></div>
            <div class="stat-info">
                <div class="stat-label">Tasks</div>
                <div class="stat-number">{{ $stats['tasks'] ?? 24 }}</div>
                <div class="stat-sub">{{ $stats['pending_tasks'] ?? 8 }} pending · {{ $stats['completed_tasks'] ?? 16 }} completed</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-clock"></i></div>
            <div class="stat-info">
                <div class="stat-label">Hours Worked</div>
                <div class="stat-number">{{ $stats['hours_worked'] ?? 42 }}</div>
                <div class="stat-sub">this week · +{{ $stats['hours_change'] ?? 6 }}h</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-calendar-check"></i></div>
            <div class="stat-info">
                <div class="stat-label">Attendance</div>
                <div class="stat-number">{{ $stats['attendance'] ?? 92 }}<small style="font-size:1rem;font-weight:400;color:#94a3b8;">%</small></div>
                <div class="stat-sub">{{ $stats['days_present'] ?? 23 }} present · {{ $stats['days_absent'] ?? 2 }} absent</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-project-diagram"></i></div>
            <div class="stat-info">
                <div class="stat-label">Active Projects</div>
                <div class="stat-number">{{ $stats['active_projects'] ?? 4 }}</div>
                <div class="stat-sub">{{ $stats['completed_projects'] ?? 12 }} completed total</div>
            </div>
        </div>
    </div>

    <!-- ===== TWO COLUMN LAYOUT ===== -->
    <div class="two-col">
        <!-- LEFT COLUMN -->
        <div class="left-panel">

            <!-- Project Progress -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="fas fa-chart-simple"></i> Project Progress
                    </div>
                    <span class="card-badge">Active</span>
                </div>
                <div class="card-body">
                    @foreach($projects ?? [] as $project)
                        <div class="grade-item">
                            <span class="subject">{{ $project['name'] }}</span>
                            <div class="progress-track">
                                <div class="progress-fill" style="width: {{ $project['progress'] }}%;"></div>
                            </div>
                            <span class="grade-value">{{ $project['progress'] }}<small>%</small></span>
                        </div>
                    @endforeach

                    @if(empty($projects))
                        <div class="grade-item">
                            <span class="subject">Website Redesign</span>
                            <div class="progress-track"><div class="progress-fill" style="width:78%;"></div></div>
                            <span class="grade-value">78<small>%</small></span>
                        </div>
                        <div class="grade-item">
                            <span class="subject">Mobile App</span>
                            <div class="progress-track"><div class="progress-fill" style="width:45%;"></div></div>
                            <span class="grade-value">45<small>%</small></span>
                        </div>
                        <div class="grade-item">
                            <span class="subject">API Integration</span>
                            <div class="progress-track"><div class="progress-fill" style="width:92%;"></div></div>
                            <span class="grade-value">92<small>%</small></span>
                        </div>
                        <div class="grade-item">
                            <span class="subject">Dashboard UI</span>
                            <div class="progress-track"><div class="progress-fill" style="width:63%;"></div></div>
                            <span class="grade-value">63<small>%</small></span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="fas fa-bolt"></i> Recent Activity
                    </div>
                    <a href="#" class="card-link">View all</a>
                </div>
                <div class="card-body">
                    @foreach($activities ?? [] as $activity)
                        <div class="activity-item">
                            <div class="activity-icon"><i class="{{ $activity['icon'] }}"></i></div>
                            <div class="activity-content">
                                <div class="act-title">{{ $activity['title'] }}</div>
                                <div class="act-meta">
                                    <i class="far fa-clock"></i> {{ $activity['time'] }}
                                    @if(isset($activity['status'])) · {{ $activity['status'] }} @endif
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @if(empty($activities))
                        <div class="activity-item">
                            <div class="activity-icon"><i class="fas fa-check-circle"></i></div>
                            <div class="activity-content">
                                <div class="act-title">Completed task: User authentication module</div>
                                <div class="act-meta"><i class="far fa-clock"></i> 2 hours ago · done</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon"><i class="fas fa-comment"></i></div>
                            <div class="activity-content">
                                <div class="act-title">Commented on Project: API Documentation</div>
                                <div class="act-meta"><i class="far fa-clock"></i> Yesterday, 4:30 PM</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon"><i class="fas fa-clock"></i></div>
                            <div class="activity-content">
                                <div class="act-title">Clock in · Start of shift</div>
                                <div class="act-meta"><i class="far fa-clock"></i> Today, 9:00 AM</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon"><i class="fas fa-file-alt"></i></div>
                            <div class="activity-content">
                                <div class="act-title">Submitted weekly report</div>
                                <div class="act-meta"><i class="far fa-clock"></i> 1 day ago · pending review</div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN -->
        <div class="right-panel">

            <!-- Upcoming Tasks -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="fas fa-calendar-check"></i> Upcoming Tasks
                    </div>
                    <span class="card-badge">Deadlines</span>
                </div>
                <div class="card-body">
                    @foreach($upcoming ?? [] as $item)
                        <div class="upcoming-item">
                            <span class="upcoming-badge">{{ $item['badge'] }}</span>
                            <div class="upcoming-info">
                                <div class="title">{{ $item['title'] }}</div>
                                <div class="detail">
                                    <i class="{{ $item['icon'] }}"></i> {{ $item['detail'] }}
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @if(empty($upcoming))
                        <div class="upcoming-item">
                            <span class="upcoming-badge">Today</span>
                            <div class="upcoming-info">
                                <div class="title">Fix login page bug</div>
                                <div class="detail"><i class="fas fa-code"></i> Priority: High · 2 hours left</div>
                            </div>
                        </div>
                        <div class="upcoming-item">
                            <span class="upcoming-badge">Tomorrow</span>
                            <div class="upcoming-info">
                                <div class="title">Team meeting · Sprint planning</div>
                                <div class="detail"><i class="fas fa-users"></i> 10:00 AM · prepare backlog</div>
                            </div>
                        </div>
                        <div class="upcoming-item">
                            <span class="upcoming-badge">Wed</span>
                            <div class="upcoming-info">
                                <div class="title">Review pull requests</div>
                                <div class="detail"><i class="fas fa-code-branch"></i> 4 PRs waiting</div>
                            </div>
                        </div>
                        <div class="upcoming-item">
                            <span class="upcoming-badge">Fri</span>
                            <div class="upcoming-info">
                                <div class="title">Deploy v2.0 to staging</div>
                                <div class="detail"><i class="fas fa-rocket"></i> 3:00 PM · coordinate with DevOps</div>
                            </div>
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
                    <button class="quick-btn" onclick="window.location.href='#'">
                        <i class="fas fa-plus-circle"></i> New Task
                    </button>
                    <button class="quick-btn" style="margin-top:12px; background:#3A5079; box-shadow:0 6px 0 #253a57;" onclick="window.location.href='#'">
                        <i class="fas fa-clock"></i> Clock In/Out
                    </button>
                    <button class="quick-btn" style="margin-top:12px; background:#504482; box-shadow:0 6px 0 #352d5a;" onclick="window.location.href='#'">
                        <i class="fas fa-calendar-plus"></i> Request Leave
                    </button>
                </div>
            </div>

            <!-- Team Updates -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="fas fa-users"></i> Team Updates
                    </div>
                    <span class="card-badge">2 new</span>
                </div>
                <div class="card-body">
                    <div class="activity-item">
                        <div class="activity-icon" style="background:#dbeafe;color:#3b82f6;"><i class="fas fa-user"></i></div>
                        <div class="activity-content">
                            <div class="act-title">Sarah completed "Payment Gateway"</div>
                            <div class="act-meta"><i class="far fa-clock"></i> 1 hour ago</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon" style="background:#d1fae5;color:#10b981;"><i class="fas fa-check"></i></div>
                        <div class="activity-content">
                            <div class="act-title">Mike approved your PR #142</div>
                            <div class="act-meta"><i class="far fa-clock"></i> 3 hours ago</div>
                        </div>
                    </div>
                    <div class="activity-item" style="border-bottom: none;">
                        <div class="activity-icon" style="background:#fef3c7;color:#f59e0b;"><i class="fas fa-exclamation"></i></div>
                        <div class="activity-content">
                            <div class="act-title">Review required: Design feedback</div>
                            <div class="act-meta"><i class="far fa-clock"></i> Yesterday, 5:30 PM</div>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- /right-panel -->
    </div><!-- /two-col -->
@endsection

@push('styles')
<style>
    /* ===== EMPLOYEE DASHBOARD STYLES ===== */
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
        background: #eff6ff;
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

    /* Grade/Progress items (reused for projects) */
    .grade-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 0.85rem;
    }
    .grade-item:last-child {
        margin-bottom: 0;
    }

    .grade-item .subject {
        width: 120px;
        font-size: 0.9rem;
        font-weight: 500;
        color: #1e293b;
        flex-shrink: 0;
    }
    .progress-track {
        flex: 1;
        height: 6px;
        background: #e9edf4;
        border-radius: 20px;
        overflow: hidden;
    }
    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #3b82f6, #60a5fa);
        border-radius: 20px;
        transition: width 0.6s cubic-bezier(0.22, 1, 0.36, 1);
        width: 0%;
    }
    .grade-value {
        font-weight: 600;
        font-size: 0.9rem;
        color: #0f172a;
        min-width: 44px;
        text-align: right;
    }
    .grade-value small {
        font-weight: 400;
        font-size: 0.7rem;
        color: #94a3b8;
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

    /* Upcoming */
    .upcoming-item {
        display: flex;
        gap: 0.75rem;
        margin-bottom: 1rem;
        align-items: flex-start;
    }
    .upcoming-item:last-child {
        margin-bottom: 0;
    }
    .upcoming-badge {
        background: #f1f5f9;
        color: #1e293b;
        font-size: 0.7rem;
        font-weight: 600;
        padding: 0.15rem 0.8rem;
        border-radius: 20px;
        white-space: nowrap;
        margin-top: 0.1rem;
        border: 1px solid #e2e8f0;
    }
    .upcoming-info .title {
        font-weight: 500;
        font-size: 0.9rem;
        color: #0f172a;
    }
    .upcoming-info .detail {
        font-size: 0.8rem;
        color: #64748b;
        display: flex;
        align-items: center;
        gap: 0.4rem;
        margin-top: 0.1rem;
    }
    .upcoming-info .detail i {
        font-size: 0.7rem;
        color: #94a3b8;
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
        .grade-item .subject {
            width: 90px;
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
        .grade-item .subject {
            width: 80px;
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
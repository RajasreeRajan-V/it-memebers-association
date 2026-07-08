{{-- resources/views/employer/dashboard.blade.php --}}
@extends('employers.layout.app')

@section('title', 'Employer Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Employer overview')

@section('content')
    <!-- ===== STATISTICS CARDS ===== -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-briefcase"></i></div>
            <div class="stat-info">
                <div class="stat-label">Active Jobs</div>
                <div class="stat-number">{{ $stats['active_jobs'] ?? 12 }}</div>
                <div class="stat-sub">{{ $stats['total_jobs'] ?? 28 }} total · {{ $stats['closed_jobs'] ?? 16 }} filled</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-file-lines"></i></div>
            <div class="stat-info">
                <div class="stat-label">Applications</div>
                <div class="stat-number">{{ $stats['total_applications'] ?? 156 }}</div>
                <div class="stat-sub">{{ $stats['new_applications'] ?? 23 }} new · {{ $stats['pending_review'] ?? 12 }} pending</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-users"></i></div>
            <div class="stat-info">
                <div class="stat-label">Employees</div>
                <div class="stat-number">{{ $stats['total_employees'] ?? 48 }}</div>
                <div class="stat-sub">{{ $stats['new_employees'] ?? 6 }} hired this month</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-handshake"></i></div>
            <div class="stat-info">
                <div class="stat-label">Interviews</div>
                <div class="stat-number">{{ $stats['upcoming_interviews'] ?? 8 }}</div>
                <div class="stat-sub">{{ $stats['completed_interviews'] ?? 34 }} completed</div>
            </div>
        </div>
    </div>

    <!-- ===== TWO COLUMN LAYOUT ===== -->
    <div class="two-col">
        <!-- LEFT COLUMN -->
        <div class="left-panel">

            <!-- Recent Applications -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="fas fa-file-lines"></i> Recent Applications
                    </div>
                    <a href="#" class="card-link">View all</a>
                </div>
                <div class="card-body">
                    @foreach($applications ?? [] as $application)
                        <div class="application-item">
                            <div class="applicant-info">
                                <div class="applicant-name">{{ $application['name'] }}</div>
                                <div class="applicant-details">{{ $application['position'] }} · {{ $application['applied_at'] }}</div>
                            </div>
                            <span class="status-badge status-{{ $application['status'] }}">
                                {{ ucfirst($application['status']) }}
                            </span>
                        </div>
                    @endforeach

                    @if(empty($applications))
                        <div class="application-item">
                            <div class="applicant-info">
                                <div class="applicant-name">Sarah Johnson</div>
                                <div class="applicant-details">Senior Developer · 2 hours ago</div>
                            </div>
                            <span class="status-badge status-pending">Pending</span>
                        </div>
                        <div class="application-item">
                            <div class="applicant-info">
                                <div class="applicant-name">Michael Chen</div>
                                <div class="applicant-details">UI/UX Designer · 4 hours ago</div>
                            </div>
                            <span class="status-badge status-review">Under Review</span>
                        </div>
                        <div class="application-item">
                            <div class="applicant-info">
                                <div class="applicant-name">Emily Rodriguez</div>
                                <div class="applicant-details">Marketing Manager · Yesterday</div>
                            </div>
                            <span class="status-badge status-interview">Interview</span>
                        </div>
                        <div class="application-item">
                            <div class="applicant-info">
                                <div class="applicant-name">David Kim</div>
                                <div class="applicant-details">Data Analyst · Yesterday</div>
                            </div>
                            <span class="status-badge status-shortlisted">Shortlisted</span>
                        </div>
                        <div class="application-item" style="border-bottom: none;">
                            <div class="applicant-info">
                                <div class="applicant-name">Lisa Patel</div>
                                <div class="applicant-details">Product Manager · 2 days ago</div>
                            </div>
                            <span class="status-badge status-rejected">Rejected</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Job Performance -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="fas fa-chart-simple"></i> Job Performance
                    </div>
                    <span class="card-badge">Last 30 days</span>
                </div>
                <div class="card-body">
                    @foreach($jobPerformance ?? [] as $job)
                        <div class="grade-item">
                            <span class="subject">{{ $job['title'] }}</span>
                            <div class="progress-track">
                                <div class="progress-fill" style="width: {{ $job['fill_rate'] }}%;"></div>
                            </div>
                            <span class="grade-value">{{ $job['applicants'] }} <small>apps</small></span>
                        </div>
                    @endforeach

                    @if(empty($jobPerformance))
                        <div class="grade-item">
                            <span class="subject">Senior Developer</span>
                            <div class="progress-track"><div class="progress-fill" style="width:78%;"></div></div>
                            <span class="grade-value">42 <small>apps</small></span>
                        </div>
                        <div class="grade-item">
                            <span class="subject">UI/UX Designer</span>
                            <div class="progress-track"><div class="progress-fill" style="width:55%;"></div></div>
                            <span class="grade-value">28 <small>apps</small></span>
                        </div>
                        <div class="grade-item">
                            <span class="subject">Marketing Manager</span>
                            <div class="progress-track"><div class="progress-fill" style="width:92%;"></div></div>
                            <span class="grade-value">56 <small>apps</small></span>
                        </div>
                        <div class="grade-item">
                            <span class="subject">Data Analyst</span>
                            <div class="progress-track"><div class="progress-fill" style="width:63%;"></div></div>
                            <span class="grade-value">34 <small>apps</small></span>
                        </div>
                        <div class="grade-item" style="margin-bottom: 0;">
                            <span class="subject">Product Manager</span>
                            <div class="progress-track"><div class="progress-fill" style="width:40%;"></div></div>
                            <span class="grade-value">18 <small>apps</small></span>
                        </div>
                    @endif
                </div>
            </div>

        </div>

        <!-- RIGHT COLUMN -->
        <div class="right-panel">

            <!-- Upcoming Interviews -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="fas fa-calendar-check"></i> Upcoming Interviews
                    </div>
                    <a href="#" class="card-link">View all</a>
                </div>
                <div class="card-body">
                    @foreach($upcomingInterviews ?? [] as $interview)
                        <div class="upcoming-item">
                            <span class="upcoming-badge">{{ $interview['date'] }}</span>
                            <div class="upcoming-info">
                                <div class="title">{{ $interview['candidate'] }}</div>
                                <div class="detail">
                                    <i class="fas fa-briefcase"></i> {{ $interview['position'] }}
                                    <span style="margin-left: 0.5rem; color: #94a3b8;">·</span>
                                    <i class="far fa-clock"></i> {{ $interview['time'] }}
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @if(empty($upcomingInterviews))
                        <div class="upcoming-item">
                            <span class="upcoming-badge">Today</span>
                            <div class="upcoming-info">
                                <div class="title">Sarah Johnson</div>
                                <div class="detail"><i class="fas fa-briefcase"></i> Senior Developer · <i class="far fa-clock"></i> 2:00 PM</div>
                            </div>
                        </div>
                        <div class="upcoming-item">
                            <span class="upcoming-badge">Tomorrow</span>
                            <div class="upcoming-info">
                                <div class="title">Michael Chen</div>
                                <div class="detail"><i class="fas fa-briefcase"></i> UI/UX Designer · <i class="far fa-clock"></i> 10:30 AM</div>
                            </div>
                        </div>
                        <div class="upcoming-item">
                            <span class="upcoming-badge">Wed</span>
                            <div class="upcoming-info">
                                <div class="title">Emily Rodriguez</div>
                                <div class="detail"><i class="fas fa-briefcase"></i> Marketing Manager · <i class="far fa-clock"></i> 3:00 PM</div>
                            </div>
                        </div>
                        <div class="upcoming-item" style="margin-bottom: 0;">
                            <span class="upcoming-badge">Thu</span>
                            <div class="upcoming-info">
                                <div class="title">David Kim</div>
                                <div class="detail"><i class="fas fa-briefcase"></i> Data Analyst · <i class="far fa-clock"></i> 11:00 AM</div>
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
                    <button class="quick-btn" onclick="window.location.href=#">
                        <i class="fas fa-plus-circle"></i> Post New Job
                    </button>
                    <button class="quick-btn" style="margin-top:12px; background:#7c3aed; box-shadow:0 6px 0 #5b21b6;" onclick="window.location.href=#">
                        <i class="fas fa-file-lines"></i> Review Applications
                    </button>
                    <button class="quick-btn" style="margin-top:12px; background:#3A5079; box-shadow:0 6px 0 #253a57;" onclick="window.location.href=#">
                        <i class="fas fa-calendar-plus"></i> Schedule Interview
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
                        <div class="activity-icon" style="background:#ede9fe;color:#7c3aed;"><i class="fas fa-user-plus"></i></div>
                        <div class="activity-content">
                            <div class="act-title">New application for Senior Developer</div>
                            <div class="act-meta"><i class="far fa-clock"></i> 15 minutes ago</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon" style="background:#dbeafe;color:#3b82f6;"><i class="fas fa-check-circle"></i></div>
                        <div class="activity-content">
                            <div class="act-title">Interview completed with Emily Rodriguez</div>
                            <div class="act-meta"><i class="far fa-clock"></i> 1 hour ago</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon" style="background:#fef3c7;color:#f59e0b;"><i class="fas fa-edit"></i></div>
                        <div class="activity-content">
                            <div class="act-title">Job posting updated: UI/UX Designer</div>
                            <div class="act-meta"><i class="far fa-clock"></i> 3 hours ago</div>
                        </div>
                    </div>
                    <div class="activity-item" style="border-bottom: none;">
                        <div class="activity-icon" style="background:#d1fae5;color:#10b981;"><i class="fas fa-user-check"></i></div>
                        <div class="activity-content">
                            <div class="act-title">New employee onboarded: Lisa Patel</div>
                            <div class="act-meta"><i class="far fa-clock"></i> Yesterday, 4:30 PM</div>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- /right-panel -->
    </div><!-- /two-col -->
@endsection

@push('styles')
<style>
    /* ===== EMPLOYER DASHBOARD STYLES ===== */
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
        background: #ede9fe;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        color: #7c3aed;
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
        color: #7c3aed;
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
        color: #7c3aed;
        text-decoration: none;
        font-weight: 500;
    }
    .card-link:hover {
        text-decoration: underline;
    }

    .card-body {
        padding: 1.2rem 1.5rem 1.5rem;
    }

    /* Application items */
    .application-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.7rem 0;
        border-bottom: 1px solid #f1f5f9;
    }
    .application-item:last-child {
        border-bottom: none;
    }

    .applicant-info {
        flex: 1;
    }
    .applicant-name {
        font-weight: 500;
        font-size: 0.9rem;
        color: #0f172a;
    }
    .applicant-details {
        font-size: 0.78rem;
        color: #94a3b8;
        margin-top: 0.05rem;
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
    .status-interview {
        background: #ede9fe;
        color: #5b21b6;
    }
    .status-shortlisted {
        background: #d1fae5;
        color: #065f46;
    }
    .status-rejected {
        background: #fee2e2;
        color: #991b1b;
    }
    .status-hired {
        background: #d1fae5;
        color: #065f46;
    }

    /* Grade/Progress items (reused for job performance) */
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
        width: 140px;
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
        background: linear-gradient(90deg, #8b5cf6, #a78bfa);
        border-radius: 20px;
        transition: width 0.6s cubic-bezier(0.22, 1, 0.36, 1);
        width: 0%;
    }
    .grade-value {
        font-weight: 600;
        font-size: 0.9rem;
        color: #0f172a;
        min-width: 50px;
        text-align: right;
    }
    .grade-value small {
        font-weight: 400;
        font-size: 0.7rem;
        color: #94a3b8;
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
        gap: 0.3rem;
        margin-top: 0.1rem;
        flex-wrap: wrap;
    }
    .upcoming-info .detail i {
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
        color: #7c3aed;
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
        background: #7c3aed;
        color: #fff;
        box-shadow: 0 6px 0 #5b21b6;
        cursor: pointer;
        transition: all 0.08s ease;
    }
    .quick-btn:active {
        transform: translateY(3px);
        box-shadow: 0 3px 0 #5b21b6;
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
            width: 100px;
        }
        .application-item {
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
        .grade-item .subject {
            width: 80px;
            font-size: 0.8rem;
        }
        .upcoming-item {
            flex-wrap: wrap;
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
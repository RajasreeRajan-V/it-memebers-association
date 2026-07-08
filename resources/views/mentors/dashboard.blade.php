{{-- resources/views/mentors/dashboard.blade.php --}}
@extends('mentors.layout.app')

@section('title', 'Mentor Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Mentor overview')

@section('content')
    <!-- ===== STATISTICS CARDS ===== -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-users"></i></div>
            <div class="stat-info">
                <div class="stat-label">Active Mentees</div>
                <div class="stat-number">{{ $stats['active_mentees'] ?? 8 }}</div>
                <div class="stat-sub">{{ $stats['total_mentees'] ?? 12 }} total · {{ $stats['new_mentees'] ?? 3 }} this month</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-calendar-check"></i></div>
            <div class="stat-info">
                <div class="stat-label">Sessions</div>
                <div class="stat-number">{{ $stats['total_sessions'] ?? 24 }}</div>
                <div class="stat-sub">{{ $stats['upcoming_sessions'] ?? 5 }} upcoming · {{ $stats['completed_sessions'] ?? 19 }} completed</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-star"></i></div>
            <div class="stat-info">
                <div class="stat-label">Rating</div>
                <div class="stat-number">{{ number_format($stats['rating'] ?? 4.9, 1) }}</div>
                <div class="stat-sub">{{ $stats['total_reviews'] ?? 34 }} reviews · 5 stars</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-graduation-cap"></i></div>
            <div class="stat-info">
                <div class="stat-label">Programs</div>
                <div class="stat-number">{{ $stats['active_programs'] ?? 3 }}</div>
                <div class="stat-sub">{{ $stats['completed_programs'] ?? 6 }} completed</div>
            </div>
        </div>
    </div>

    <!-- ===== TWO COLUMN LAYOUT ===== -->
    <div class="two-col">
        <!-- LEFT COLUMN -->
        <div class="left-panel">

            <!-- Mentee Progress -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="fas fa-chart-simple"></i> Mentee Progress
                    </div>
                    <a href="#" class="card-link">View all</a>
                </div>
                <div class="card-body">
                    @foreach($mentees ?? [] as $mentee)
                        <div class="mentee-item">
                            <div class="mentee-info">
                                <div class="mentee-name">{{ $mentee['name'] }}</div>
                                <div class="mentee-details">
                                    <i class="fas fa-graduation-cap"></i> {{ $mentee['program'] }}
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="far fa-calendar"></i> {{ $mentee['joined'] }}
                                </div>
                            </div>
                            <div class="mentee-progress">
                                <div class="progress-track small">
                                    <div class="progress-fill" style="width: {{ $mentee['progress'] }}%;"></div>
                                </div>
                                <span class="progress-text">{{ $mentee['progress'] }}%</span>
                            </div>
                        </div>
                    @endforeach

                    @if(empty($mentees))
                        <div class="mentee-item">
                            <div class="mentee-info">
                                <div class="mentee-name">Sarah Johnson</div>
                                <div class="mentee-details">
                                    <i class="fas fa-graduation-cap"></i> Web Development
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="far fa-calendar"></i> Joined Oct 15
                                </div>
                            </div>
                            <div class="mentee-progress">
                                <div class="progress-track small">
                                    <div class="progress-fill" style="width: 75%;"></div>
                                </div>
                                <span class="progress-text">75%</span>
                            </div>
                        </div>
                        <div class="mentee-item">
                            <div class="mentee-info">
                                <div class="mentee-name">Michael Chen</div>
                                <div class="mentee-details">
                                    <i class="fas fa-graduation-cap"></i> Data Science
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="far fa-calendar"></i> Joined Nov 1
                                </div>
                            </div>
                            <div class="mentee-progress">
                                <div class="progress-track small">
                                    <div class="progress-fill" style="width: 45%;"></div>
                                </div>
                                <span class="progress-text">45%</span>
                            </div>
                        </div>
                        <div class="mentee-item">
                            <div class="mentee-info">
                                <div class="mentee-name">Emily Rodriguez</div>
                                <div class="mentee-details">
                                    <i class="fas fa-graduation-cap"></i> UI/UX Design
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="far fa-calendar"></i> Joined Oct 28
                                </div>
                            </div>
                            <div class="mentee-progress">
                                <div class="progress-track small">
                                    <div class="progress-fill" style="width: 90%;"></div>
                                </div>
                                <span class="progress-text">90%</span>
                            </div>
                        </div>
                        <div class="mentee-item" style="border-bottom: none;">
                            <div class="mentee-info">
                                <div class="mentee-name">David Kim</div>
                                <div class="mentee-details">
                                    <i class="fas fa-graduation-cap"></i> Mobile Development
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="far fa-calendar"></i> Joined Nov 15
                                </div>
                            </div>
                            <div class="mentee-progress">
                                <div class="progress-track small">
                                    <div class="progress-fill" style="width: 30%;"></div>
                                </div>
                                <span class="progress-text">30%</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Recent Sessions -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="fas fa-clock"></i> Recent Sessions
                    </div>
                    <a href="#" class="card-link">View all</a>
                </div>
                <div class="card-body">
                    @foreach($recentSessions ?? [] as $session)
                        <div class="session-item">
                            <div class="session-info">
                                <div class="session-title">{{ $session['title'] }}</div>
                                <div class="session-details">
                                    <i class="fas fa-user"></i> {{ $session['mentee'] }}
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="far fa-clock"></i> {{ $session['time'] }}
                                </div>
                            </div>
                            <span class="session-status status-{{ $session['status'] }}">
                                {{ ucfirst($session['status']) }}
                            </span>
                        </div>
                    @endforeach

                    @if(empty($recentSessions))
                        <div class="session-item">
                            <div class="session-info">
                                <div class="session-title">JavaScript Fundamentals</div>
                                <div class="session-details">
                                    <i class="fas fa-user"></i> Sarah Johnson
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="far fa-clock"></i> 2 hours ago
                                </div>
                            </div>
                            <span class="session-status status-completed">Completed</span>
                        </div>
                        <div class="session-item">
                            <div class="session-info">
                                <div class="session-title">Data Visualization</div>
                                <div class="session-details">
                                    <i class="fas fa-user"></i> Michael Chen
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="far fa-clock"></i> Yesterday, 3:30 PM
                                </div>
                            </div>
                            <span class="session-status status-completed">Completed</span>
                        </div>
                        <div class="session-item">
                            <div class="session-info">
                                <div class="session-title">Design Systems</div>
                                <div class="session-details">
                                    <i class="fas fa-user"></i> Emily Rodriguez
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="far fa-clock"></i> Yesterday, 10:00 AM
                                </div>
                            </div>
                            <span class="session-status status-upcoming">Upcoming</span>
                        </div>
                        <div class="session-item" style="border-bottom: none;">
                            <div class="session-info">
                                <div class="session-title">Mobile App Architecture</div>
                                <div class="session-details">
                                    <i class="fas fa-user"></i> David Kim
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="far fa-clock"></i> 2 days ago
                                </div>
                            </div>
                            <span class="session-status status-cancelled">Cancelled</span>
                        </div>
                    @endif
                </div>
            </div>

        </div>

        <!-- RIGHT COLUMN -->
        <div class="right-panel">

            <!-- Upcoming Sessions -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="fas fa-calendar-check"></i> Upcoming Sessions
                    </div>
                    <a href="#" class="card-link">View all</a>
                </div>
                <div class="card-body">
                    @foreach($upcomingSessions ?? [] as $session)
                        <div class="upcoming-item">
                            <span class="upcoming-badge">{{ $session['date'] }}</span>
                            <div class="upcoming-info">
                                <div class="title">{{ $session['title'] }}</div>
                                <div class="detail">
                                    <i class="fas fa-user"></i> {{ $session['mentee'] }}
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="far fa-clock"></i> {{ $session['time'] }}
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @if(empty($upcomingSessions))
                        <div class="upcoming-item">
                            <span class="upcoming-badge">Today</span>
                            <div class="upcoming-info">
                                <div class="title">Design Systems</div>
                                <div class="detail">
                                    <i class="fas fa-user"></i> Emily Rodriguez
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="far fa-clock"></i> 10:00 AM
                                </div>
                            </div>
                        </div>
                        <div class="upcoming-item">
                            <span class="upcoming-badge">Tomorrow</span>
                            <div class="upcoming-info">
                                <div class="title">Mobile App Architecture</div>
                                <div class="detail">
                                    <i class="fas fa-user"></i> David Kim
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="far fa-clock"></i> 2:00 PM
                                </div>
                            </div>
                        </div>
                        <div class="upcoming-item">
                            <span class="upcoming-badge">Wed</span>
                            <div class="upcoming-info">
                                <div class="title">JavaScript Fundamentals</div>
                                <div class="detail">
                                    <i class="fas fa-user"></i> Sarah Johnson
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="far fa-clock"></i> 11:30 AM
                                </div>
                            </div>
                        </div>
                        <div class="upcoming-item" style="border-bottom: none;">
                            <span class="upcoming-badge">Thu</span>
                            <div class="upcoming-info">
                                <div class="title">Data Visualization</div>
                                <div class="detail">
                                    <i class="fas fa-user"></i> Michael Chen
                                    <span style="margin: 0 0.5rem; color: #d0d4e0;">·</span>
                                    <i class="far fa-clock"></i> 3:30 PM
                                </div>
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
                        <i class="fas fa-calendar-plus"></i> Schedule Session
                    </button>
                    <button class="quick-btn" style="margin-top:12px; background:#7c3aed; box-shadow:0 6px 0 #5b21b6;" onclick="window.location.href=#">
                        <i class="fas fa-folder-plus"></i> Add Resource
                    </button>
                    <button class="quick-btn" style="margin-top:12px; background:#3A5079; box-shadow:0 6px 0 #253a57;" onclick="window.location.href=#">
                        <i class="fas fa-bullseye"></i> Set Goal
                    </button>
                </div>
            </div>

            <!-- Recent Feedback -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="fas fa-star"></i> Recent Feedback
                    </div>
                    <a href="#" class="card-link">View all</a>
                </div>
                <div class="card-body">
                    <div class="feedback-item">
                        <div class="feedback-header">
                            <div class="feedback-mentee">Sarah Johnson</div>
                            <div class="feedback-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <div class="feedback-text">"Amazing mentor! Very patient and explained complex concepts clearly."</div>
                        <div class="feedback-time"><i class="far fa-clock"></i> 2 days ago</div>
                    </div>
                    <div class="feedback-item" style="border-bottom: none;">
                        <div class="feedback-header">
                            <div class="feedback-mentee">Michael Chen</div>
                            <div class="feedback-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                        <div class="feedback-text">"Great guidance on my data science project. Looking forward to more sessions."</div>
                        <div class="feedback-time"><i class="far fa-clock"></i> 5 days ago</div>
                    </div>
                </div>
            </div>

        </div><!-- /right-panel -->
    </div><!-- /two-col -->
@endsection

@push('styles')
<style>
    /* ===== MENTOR DASHBOARD STYLES ===== */
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

    /* Mentee items */
    .mentee-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.7rem 0;
        border-bottom: 1px solid #f1f5f9;
    }
    .mentee-item:last-child {
        border-bottom: none;
    }

    .mentee-info {
        flex: 1;
    }
    .mentee-name {
        font-weight: 500;
        font-size: 0.9rem;
        color: #0f172a;
    }
    .mentee-details {
        font-size: 0.78rem;
        color: #94a3b8;
        margin-top: 0.05rem;
    }
    .mentee-details i {
        font-size: 0.7rem;
    }

    .mentee-progress {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        min-width: 100px;
        justify-content: flex-end;
    }
    .progress-track.small {
        width: 70px;
        height: 4px;
        background: #e9edf4;
        border-radius: 20px;
        overflow: hidden;
    }
    .progress-track.small .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #8b5cf6, #a78bfa);
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

    /* Session items */
    .session-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.7rem 0;
        border-bottom: 1px solid #f1f5f9;
    }
    .session-item:last-child {
        border-bottom: none;
    }

    .session-info {
        flex: 1;
    }
    .session-title {
        font-weight: 500;
        font-size: 0.9rem;
        color: #0f172a;
    }
    .session-details {
        font-size: 0.78rem;
        color: #94a3b8;
        margin-top: 0.05rem;
    }
    .session-details i {
        font-size: 0.7rem;
    }

    .session-status {
        padding: 0.2rem 0.9rem;
        border-radius: 30px;
        font-size: 0.7rem;
        font-weight: 600;
        white-space: nowrap;
        margin-left: 0.5rem;
    }
    .session-status.status-completed {
        background: #d1fae5;
        color: #065f46;
    }
    .session-status.status-upcoming {
        background: #dbeafe;
        color: #1e40af;
    }
    .session-status.status-cancelled {
        background: #fee2e2;
        color: #991b1b;
    }
    .session-status.status-in-progress {
        background: #fef3c7;
        color: #92400e;
    }

    /* Upcoming items */
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

    /* Feedback items */
    .feedback-item {
        padding: 0.7rem 0;
        border-bottom: 1px solid #f1f5f9;
    }
    .feedback-item:last-child {
        border-bottom: none;
    }

    .feedback-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 0.3rem;
    }
    .feedback-mentee {
        font-weight: 500;
        font-size: 0.85rem;
        color: #0f172a;
    }
    .feedback-rating {
        color: #f59e0b;
        font-size: 0.8rem;
        letter-spacing: 1px;
    }
    .feedback-rating i {
        margin: 0 1px;
    }
    .feedback-text {
        font-size: 0.85rem;
        color: #475569;
        margin: 0.2rem 0;
        font-style: italic;
    }
    .feedback-time {
        font-size: 0.7rem;
        color: #94a3b8;
        margin-top: 0.2rem;
    }
    .feedback-time i {
        margin-right: 0.3rem;
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
        .mentee-item {
            flex-wrap: wrap;
            gap: 0.5rem;
        }
        .mentee-progress {
            min-width: 100%;
            justify-content: flex-start;
        }
        .session-item {
            flex-wrap: wrap;
            gap: 0.5rem;
        }
        .feedback-header {
            flex-wrap: wrap;
            gap: 0.3rem;
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
        .upcoming-item {
            flex-wrap: wrap;
        }
        .progress-track.small {
            width: 50px;
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
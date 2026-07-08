@extends('students.layout.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Student overview')

@section('content')
    <!-- ===== STATISTICS CARDS (redesigned with admin panel feel) ===== -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-book-open"></i></div>
            <div class="stat-info">
                <div class="stat-label">Courses</div>
                <div class="stat-number">{{ $stats['courses'] ?? 8 }}</div>
                <div class="stat-sub">{{ $stats['active_courses'] ?? 4 }} active · {{ $stats['completed_courses'] ?? 2 }} completed</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-tasks"></i></div>
            <div class="stat-info">
                <div class="stat-label">Assignments</div>
                <div class="stat-number">{{ $stats['assignments'] ?? 14 }}</div>
                <div class="stat-sub">{{ $stats['pending_assignments'] ?? 6 }} pending · {{ $stats['submitted_assignments'] ?? 8 }} submitted</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-star"></i></div>
            <div class="stat-info">
                <div class="stat-label">GPA</div>
                <div class="stat-number">{{ number_format($stats['gpa'] ?? 3.84, 2) }}</div>
                <div class="stat-sub">↑ {{ number_format($stats['gpa_change'] ?? 0.12, 2) }} from last term</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-clock"></i></div>
            <div class="stat-info">
                <div class="stat-label">Study hours</div>
                <div class="stat-number">{{ $stats['study_hours'] ?? 26 }}</div>
                <div class="stat-sub">this week · +{{ $stats['hours_change'] ?? 4 }}h</div>
            </div>
        </div>
    </div>

    <!-- ===== TWO COLUMN LAYOUT ===== -->
    <div class="two-col">
        <!-- LEFT COLUMN -->
        <div class="left-panel">

            <!-- Grade Overview -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="fas fa-chart-simple"></i> Grade overview
                    </div>
                    <span class="card-badge">Current</span>
                </div>
                <div class="card-body">
                    @foreach($grades ?? [] as $grade)
                        <div class="grade-item">
                            <span class="subject">{{ $grade['subject'] }}</span>
                            <div class="progress-track">
                                <div class="progress-fill" style="width: {{ $grade['percentage'] }}%;"></div>
                            </div>
                            <span class="grade-value">{{ $grade['percentage'] }}<small>%</small></span>
                        </div>
                    @endforeach

                    @if(empty($grades))
                        <div class="grade-item">
                            <span class="subject">Mathematics</span>
                            <div class="progress-track"><div class="progress-fill" style="width:88%;"></div></div>
                            <span class="grade-value">88<small>%</small></span>
                        </div>
                        <div class="grade-item">
                            <span class="subject">Physics</span>
                            <div class="progress-track"><div class="progress-fill" style="width:74%;"></div></div>
                            <span class="grade-value">74<small>%</small></span>
                        </div>
                        <div class="grade-item">
                            <span class="subject">Chemistry</span>
                            <div class="progress-track"><div class="progress-fill" style="width:92%;"></div></div>
                            <span class="grade-value">92<small>%</small></span>
                        </div>
                        <div class="grade-item">
                            <span class="subject">English</span>
                            <div class="progress-track"><div class="progress-fill" style="width:79%;"></div></div>
                            <span class="grade-value">79<small>%</small></span>
                        </div>
                        <div class="grade-item">
                            <span class="subject">History</span>
                            <div class="progress-track"><div class="progress-fill" style="width:66%;"></div></div>
                            <span class="grade-value">66<small>%</small></span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="fas fa-bolt"></i> Recent activity
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
                            <div class="activity-icon"><i class="fas fa-pen-fancy"></i></div>
                            <div class="activity-content">
                                <div class="act-title">Submitted essay · Philosophy</div>
                                <div class="act-meta"><i class="far fa-clock"></i> 2 hours ago · pending review</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon"><i class="fas fa-video"></i></div>
                            <div class="activity-content">
                                <div class="act-title">Attended lecture · Quantum Mechanics</div>
                                <div class="act-meta"><i class="far fa-clock"></i> Yesterday, 10:30 AM · completed</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon"><i class="fas fa-file-alt"></i></div>
                            <div class="activity-content">
                                <div class="act-title">Quiz result · Data Structures</div>
                                <div class="act-meta"><i class="far fa-clock"></i> 2 days ago · score 92%</div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN -->
        <div class="right-panel">

            <!-- Upcoming -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="fas fa-calendar-check"></i> Upcoming
                    </div>
                    <span class="card-badge">Next 7 days</span>
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
                                <div class="title">Calculus III · assignment</div>
                                <div class="detail"><i class="far fa-clock"></i> 11:59 PM · 2 problems left</div>
                            </div>
                        </div>
                        <div class="upcoming-item">
                            <span class="upcoming-badge">Tomorrow</span>
                            <div class="upcoming-info">
                                <div class="title">Organic Chemistry lab</div>
                                <div class="detail"><i class="fas fa-flask"></i> 2:00 PM · prepare report</div>
                            </div>
                        </div>
                        <div class="upcoming-item">
                            <span class="upcoming-badge">Thu</span>
                            <div class="upcoming-info">
                                <div class="title">Literature review</div>
                                <div class="detail"><i class="far fa-file-pdf"></i> 2 chapters · peer feedback</div>
                            </div>
                        </div>
                        <div class="upcoming-item">
                            <span class="upcoming-badge">Fri</span>
                            <div class="upcoming-info">
                                <div class="title">Statistics quiz</div>
                                <div class="detail"><i class="fas fa-chart-pie"></i> chapters 5–7 · 30 min</div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="fas fa-rocket"></i> Quick actions
                    </div>
                </div>
                <div class="card-body" style="padding-bottom: 6px;">
                    <button class="quick-btn" onclick="window.location.href='#'">
                        <i class="fas fa-plus-circle"></i> New assignment
                    </button>
                    <button class="quick-btn" style="margin-top:12px; background:#3A5079; box-shadow:0 6px 0 #253a57;" onclick="window.location.href='#'">
                        <i class="fas fa-people-group"></i> Study group
                    </button>
                    <button class="quick-btn" style="margin-top:12px; background:#504482; box-shadow:0 6px 0 #352d5a;" onclick="window.location.href='#'">
                        <i class="fas fa-calendar-plus"></i> Schedule session
                    </button>
                </div>
            </div>

        </div><!-- /right-panel -->
    </div><!-- /two-col -->
@endsection

@push('styles')
<style>
    /* ===== DASHBOARD REDESIGN – matches admin panel style ===== */
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
        background: #f1f5f9;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        color: #f97316;
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

    /* --- cards (admin style) --- */
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
        color: #f97316;
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
        color: #f97316;
        text-decoration: none;
        font-weight: 500;
    }
    .card-link:hover {
        text-decoration: underline;
    }

    .card-body {
        padding: 1.2rem 1.5rem 1.5rem;
    }

    /* grade items */
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
        width: 88px;
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
        background: linear-gradient(90deg, #f97316, #fb923c);
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

    /* activity */
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
        color: #f97316;
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

    /* upcoming */
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

    /* quick buttons */
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
        background: #f97316;
        color: #fff;
        box-shadow: 0 6px 0 #c2410c;
        cursor: pointer;
        transition: all 0.08s ease;
    }
    .quick-btn:active {
        transform: translateY(3px);
        box-shadow: 0 3px 0 #c2410c;
    }
    .quick-btn i {
        font-size: 1rem;
    }

    /* two column */
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
            width: 70px;
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
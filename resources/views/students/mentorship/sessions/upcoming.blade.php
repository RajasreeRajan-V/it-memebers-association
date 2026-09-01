@extends('layouts.app')

@php($portal = 'student')

@section('title', 'Upcoming Sessions')

@section('content')

<style>
    :root {
        --up-primary: #3376F2;
        --up-primary-dark: #245ED1;
        --up-purple: #7C4DFF;
        --up-bg: #F6F8FC;
        --up-card: #FFFFFF;
        --up-text: #172033;
        --up-muted: #6B7280;
        --up-border: #E6EAF0;
        --up-success: #16A34A;
        --up-warning: #F59E0B;
        --up-shadow: 0 8px 28px rgba(31, 41, 55, 0.07);
    }

    .upcoming-page {
        width: 100%;
        min-height: 100vh;
        background: var(--up-bg);
        padding: 34px 0 60px;
    }

    .upcoming-container {
        width: min(1320px, calc(100% - 40px));
        margin: 0 auto;
    }

    /* =========================
       HERO (light, matches events/webinars page)
    ========================= */

    .upcoming-hero {
        background: #FFFFFF;
        border: 1px solid var(--up-border);
        border-radius: 24px;
        padding: 44px 46px;
        position: relative;
        overflow: hidden;
        margin-bottom: 28px;
        box-shadow: var(--up-shadow);
    }

    .hero-grid {
        position: relative;
        z-index: 2;
        display: grid;
        grid-template-columns: 1.15fr auto 1fr;
        gap: 30px;
        align-items: center;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #EAF1FF;
        color: var(--up-primary);
        border: 1px solid #D9E6FF;
        padding: 7px 15px;
        border-radius: 999px;
        font-size: 12.5px;
        font-weight: 700;
        margin-bottom: 18px;
    }

    .hero-title {
        font-size: 36px;
        line-height: 1.18;
        font-weight: 800;
        margin: 0 0 14px;
        letter-spacing: -0.6px;
        color: var(--up-text);
    }

    .hero-title span {
        display: block;
        background: linear-gradient(90deg, var(--up-primary), var(--up-purple));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    .hero-text {
        margin: 0 0 26px;
        font-size: 15px;
        line-height: 1.75;
        color: var(--up-muted);
        max-width: 480px;
    }

    .hero-actions {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .hero-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 700;
        padding: 13px 22px;
        border-radius: 12px;
        transition: 0.2s ease;
        border: 1px solid transparent;
        cursor: pointer;
    }

    .hero-btn-primary {
        background: var(--up-primary);
        color: #fff;
        box-shadow: 0 10px 22px rgba(51,118,242,0.24);
    }

    .hero-btn-primary:hover {
        background: var(--up-primary-dark);
        color: #fff;
        transform: translateY(-1px);
    }

    .hero-btn-outline {
        background: #fff;
        color: var(--up-text);
        border-color: #DDE3EC;
    }

    .hero-btn-outline:hover {
        border-color: var(--up-primary);
        color: var(--up-primary);
    }

    /* -- illustration -- */

    .hero-visual {
        position: relative;
        width: 170px;
        height: 190px;
        flex-shrink: 0;
        margin: 0 auto;
    }

    .hero-visual-circle {
        position: absolute;
        top: 0;
        left: 10px;
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background: linear-gradient(135deg, #EAF1FF, #F3EEFF);
    }

    .hero-visual-card {
        position: absolute;
        left: 34px;
        top: 46px;
        width: 108px;
        height: 130px;
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 14px 30px rgba(31,41,55,0.13);
        padding: 16px 14px;
    }

    .hero-visual-dot {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #DCE8FF;
        margin-bottom: 12px;
    }

    .hero-visual-line {
        height: 6px;
        border-radius: 4px;
        background: #EEF1F6;
        margin-bottom: 8px;
    }

    .hero-visual-line.w-80 { width: 80%; }
    .hero-visual-line.w-60 { width: 60%; }
    .hero-visual-line.w-40 { width: 40%; }

    .hero-visual-badge {
        position: absolute;
        right: -8px;
        bottom: 6px;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: var(--up-primary);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
        border: 4px solid #fff;
        box-shadow: 0 8px 16px rgba(51,118,242,0.30);
    }

    .hero-visual-check {
        position: absolute;
        top: -6px;
        right: 10px;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: #E9FBF0;
        border: 1px solid #CFF5DC;
        color: var(--up-success);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
    }

    .hero-features {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .hero-feature-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .hero-feature-icon {
        width: 38px;
        height: 38px;
        border-radius: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        flex-shrink: 0;
    }

    .hero-feature-icon.icon-blue { background: #EAF1FF; color: var(--up-primary); }
    .hero-feature-icon.icon-purple { background: #F3EEFF; color: var(--up-purple); }
    .hero-feature-icon.icon-green { background: #E9FBF0; color: var(--up-success); }

    .hero-feature-title {
        font-size: 13.5px;
        font-weight: 700;
        color: var(--up-text);
        margin-bottom: 2px;
    }

    .hero-feature-text {
        font-size: 12px;
        color: var(--up-muted);
        line-height: 1.5;
    }

    /* =========================
       STATS
    ========================= */

    .upcoming-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
        margin-bottom: 28px;
    }

    .up-stat {
        background: var(--up-card);
        border: 1px solid var(--up-border);
        border-radius: 18px;
        padding: 21px 22px;
        display: flex;
        align-items: center;
        gap: 15px;
        box-shadow: var(--up-shadow);
        transition: 0.2s ease;
    }

    .up-stat:hover {
        transform: translateY(-2px);
        box-shadow: 0 14px 32px rgba(31,41,55,0.10);
    }

    .up-stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #EEF4FF;
        color: var(--up-primary);
        font-size: 21px;
        flex-shrink: 0;
    }

    .up-stat:nth-child(2) .up-stat-icon {
        background: #EAF9F0;
        color: var(--up-success);
    }

    .up-stat:nth-child(3) .up-stat-icon {
        background: #FFF7E8;
        color: #B77908;
    }

    .up-stat-number {
        font-size: 24px;
        line-height: 1;
        font-weight: 700;
        color: var(--up-text);
        margin-bottom: 5px;
    }

    .up-stat-label {
        color: var(--up-muted);
        font-size: 13px;
        font-weight: 500;
    }

    /* =========================
       MAIN CARD
    ========================= */

    .sessions-container {
        background: #fff;
        border: 1px solid var(--up-border);
        border-radius: 20px;
        box-shadow: var(--up-shadow);
        overflow: hidden;
    }

    .sessions-header {
        padding: 22px;
        border-bottom: 1px solid var(--up-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .sessions-heading {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .sessions-heading-icon {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: #EEF4FF;
        color: var(--up-primary);
        font-size: 15px;
        flex-shrink: 0;
    }

    .sessions-title {
        color: var(--up-text);
        font-size: 16px;
        font-weight: 700;
    }

    .sessions-subtitle {
        color: var(--up-muted);
        font-size: 12px;
        margin-top: 3px;
    }

    .completed-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 15px;
        border-radius: 11px;
        background: #EEF4FF;
        border: 1px solid #DCE8FF;
        color: var(--up-primary);
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        transition: 0.2s ease;
    }

    .completed-link:hover {
        background: var(--up-primary);
        color: #fff;
    }

    /* =========================
       TABLE
    ========================= */

    .table-scroll {
        width: 100%;
        overflow-x: auto;
    }

    .upcoming-table {
        width: 100%;
        min-width: 900px;
        border-collapse: collapse;
    }

    .upcoming-table th {
        padding: 13px 20px;
        background: #FAFBFE;
        border-bottom: 1px solid var(--up-border);
        color: #8792A7;
        font-size: 10px;
        text-align: left;
        text-transform: uppercase;
        letter-spacing: .45px;
        font-weight: 800;
    }

    .upcoming-table td {
        padding: 16px 20px;
        border-bottom: 1px solid #F0F2F7;
        color: #4C586D;
        font-size: 12px;
        vertical-align: middle;
    }

    .upcoming-table tbody tr {
        transition: .18s ease;
    }

    .upcoming-table tbody tr:hover {
        background: #FBFCFF;
    }

    .upcoming-table tbody tr:last-child td {
        border-bottom: 0;
    }

    /* =========================
       TOPIC
    ========================= */

    .topic-cell {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .topic-icon {
        width: 37px;
        height: 37px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: linear-gradient(135deg, #EEF4FF, #F1ECFF);
        color: var(--up-primary);
        font-size: 13px;
    }

    .topic-name {
        max-width: 230px;
        color: var(--up-text);
        font-weight: 700;
        line-height: 1.4;
    }

    /* =========================
       MENTOR
    ========================= */

    .mentor-cell {
        display: flex;
        align-items: center;
        gap: 9px;
    }

    .mentor-avatar {
        width: 34px;
        height: 34px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        background: linear-gradient(135deg, #3376F2, #7C4DFF);
        color: #fff;
        font-size: 11px;
        font-weight: 800;
    }

    .mentor-name {
        color: #354157;
        font-weight: 700;
        white-space: nowrap;
    }

    /* =========================
       DATE / TIME
    ========================= */

    .date-cell,
    .time-cell {
        display: flex;
        align-items: center;
        gap: 7px;
        white-space: nowrap;
    }

    .date-cell i {
        color: var(--up-primary);
        font-size: 11px;
    }

    .time-cell i {
        color: var(--up-purple);
        font-size: 11px;
    }

    /* =========================
       STATUS
    ========================= */

    .session-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 999px;
        font-size: 10px;
        font-weight: 700;
    }

    .session-status.confirmed {
        background: #ECFDF3;
        color: var(--up-success);
        border: 1px solid #CFF5DC;
    }

    .session-status.scheduled {
        background: #FFF7E8;
        color: #B77908;
        border: 1px solid #FBE4B3;
    }

    .status-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
    }

    /* =========================
       ACTIONS
    ========================= */

    .actions-cell {
        display: flex;
        align-items: center;
        gap: 8px;
        white-space: nowrap;
    }

    .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 9px 12px;
        border-radius: 9px;
        font-size: 11px;
        font-weight: 700;
        text-decoration: none;
        border: 1px solid transparent;
        cursor: pointer;
        transition: .2s ease;
    }

    .action-primary {
        background: var(--up-primary);
        color: #fff;
        border-color: var(--up-primary);
    }

    .action-primary:hover {
        background: var(--up-primary-dark);
        color: #fff;
    }

    .action-join {
        background: #ECFDF3;
        color: var(--up-success);
        border-color: #CFF5DC;
    }

    .action-join:hover {
        background: #DDF5E6;
        color: #10733D;
    }

    .action-details {
        background: #EEF4FF;
        color: var(--up-primary);
        border-color: #DCE8FF;
    }

    .action-details:hover {
        background: var(--up-primary);
        color: #fff;
    }

    /* =========================
       EMPTY STATE
    ========================= */

    .empty-state {
        text-align: center;
        padding: 65px 25px;
    }

    .empty-icon {
        width: 70px;
        height: 70px;
        margin: 0 auto 17px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 20px;
        background: #EEF4FF;
        color: var(--up-primary);
        font-size: 28px;
    }

    .empty-title {
        color: var(--up-text);
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 7px;
    }

    .empty-description {
        max-width: 430px;
        margin: 0 auto 18px;
        color: var(--up-muted);
        font-size: 13px;
        line-height: 1.7;
    }

    .find-mentor-btn {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 12px 18px;
        border-radius: 11px;
        background: var(--up-primary);
        color: #fff;
        text-decoration: none;
        font-size: 13px;
        font-weight: 700;
        transition: .2s ease;
    }

    .find-mentor-btn:hover {
        background: var(--up-primary-dark);
        color: #fff;
        transform: translateY(-1px);
    }

    /* =========================
       TIP
    ========================= */

    .session-tip {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-top: 22px;
        padding: 18px 20px;
        border-radius: 17px;
        border: 1px solid var(--up-border);
        background: #fff;
        box-shadow: var(--up-shadow);
    }

    .tip-icon {
        width: 40px;
        height: 40px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: #F3EEFF;
        color: var(--up-purple);
    }

    .tip-title {
        color: var(--up-text);
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 3px;
    }

    .tip-text {
        color: var(--up-muted);
        font-size: 12px;
        line-height: 1.6;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 1100px) {

        .hero-grid {
            grid-template-columns: 1fr;
        }

        .hero-visual {
            margin: 8px 0 0;
        }
    }

    @media (max-width: 768px) {

        .upcoming-container {
            width: min(100% - 24px, 1320px);
        }

        .upcoming-page {
            padding: 20px 0 40px;
        }

        .upcoming-hero {
            padding: 28px 24px;
            border-radius: 19px;
        }

        .hero-title {
            font-size: 27px;
        }

        .hero-features {
            width: 100%;
        }

        .upcoming-stats {
            grid-template-columns: 1fr;
        }

        .sessions-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .completed-link {
            width: 100%;
            justify-content: center;
        }

        .session-tip {
            align-items: flex-start;
        }
    }

    @media (max-width: 500px) {

        .hero-visual {
            display: none;
        }
    }
</style>


<div class="upcoming-page">

    <div class="upcoming-container">

        {{-- =====================================================
             HERO
        ====================================================== --}}
        <div class="upcoming-hero">

            <div class="hero-grid">

                {{-- LEFT: copy + actions --}}
                <div class="hero-left">

                    <div class="hero-badge">
                        <i class="fa-regular fa-calendar-days"></i>
                        Student Mentorship
                    </div>

                    <h1 class="hero-title">
                        Your Upcoming
                        <span>Mentor Sessions</span>
                    </h1>

                    <p class="hero-text">
                        Stay on top of your mentorship journey. View your
                        scheduled sessions, confirm your attendance and
                        join your mentor when it's time.
                    </p>

                    <div class="hero-actions">

                        <a href="#sessions" class="hero-btn hero-btn-primary">
                            <i class="fa-regular fa-calendar-check"></i>
                            View Sessions
                        </a>

                        <a href="{{ route('student.mentors.index') }}" class="hero-btn hero-btn-outline">
                            <i class="fa-solid fa-user-plus"></i>
                            Find a Mentor
                        </a>

                    </div>

                </div>

                {{-- CENTER: illustration --}}
                <div class="hero-visual">
                    <div class="hero-visual-circle"></div>

                    <div class="hero-visual-card">
                        <div class="hero-visual-dot"></div>
                        <div class="hero-visual-line w-80"></div>
                        <div class="hero-visual-line w-60"></div>
                        <div class="hero-visual-line w-40"></div>
                    </div>

                    <div class="hero-visual-badge">
                        <i class="fa-solid fa-user"></i>
                    </div>

                    <div class="hero-visual-check">
                        <i class="fa-solid fa-check"></i>
                    </div>
                </div>

                {{-- RIGHT: feature list --}}
                <div class="hero-features">

                    <div class="hero-feature-item">
                        <div class="hero-feature-icon icon-blue">
                            <i class="fa-solid fa-user-check"></i>
                        </div>
                        <div>
                            <div class="hero-feature-title">Expert Mentors</div>
                            <div class="hero-feature-text">Verified professionals</div>
                        </div>
                    </div>

                    <div class="hero-feature-item">
                        <div class="hero-feature-icon icon-purple">
                            <i class="fa-regular fa-comments"></i>
                        </div>
                        <div>
                            <div class="hero-feature-title">Personal Guidance</div>
                            <div class="hero-feature-text">Learn directly from experts</div>
                        </div>
                    </div>

                    <div class="hero-feature-item">
                        <div class="hero-feature-icon icon-green">
                            <i class="fa-solid fa-arrow-trend-up"></i>
                        </div>
                        <div>
                            <div class="hero-feature-title">Career Growth</div>
                            <div class="hero-feature-text">Build skills and confidence</div>
                        </div>
                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
             STATS
        ====================================================== --}}
        <div class="upcoming-stats">

            <div class="up-stat">

                <div class="up-stat-icon">
                    <i class="fa-regular fa-calendar"></i>
                </div>

                <div>
                    <div class="up-stat-number">
                        {{ $totalUpcoming }}
                    </div>

                    <div class="up-stat-label">
                        Upcoming Sessions
                    </div>
                </div>

            </div>


            <div class="up-stat">

                <div class="up-stat-icon">
                    <i class="fa-solid fa-circle-check"></i>
                </div>

                <div>
                    <div class="up-stat-number">
                        {{ $confirmedCount }}
                    </div>

                    <div class="up-stat-label">
                        Confirmed Sessions
                    </div>
                </div>

            </div>


            <div class="up-stat">

                <div class="up-stat-icon">
                    <i class="fa-solid fa-clock"></i>
                </div>

                <div>
                    <div class="up-stat-number">
                        {{ $scheduledCount }}
                    </div>

                    <div class="up-stat-label">
                        Awaiting Confirmation
                    </div>
                </div>

            </div>

        </div>


        {{-- =====================================================
             SESSIONS
        ====================================================== --}}
        <div class="sessions-container" id="sessions">

            <div class="sessions-header">

                <div class="sessions-heading">

                    <div class="sessions-heading-icon">
                        <i class="fa-regular fa-calendar-days"></i>
                    </div>

                    <div>

                        <div class="sessions-title">
                            Your Upcoming Sessions
                        </div>

                        <div class="sessions-subtitle">
                            Sessions scheduled with your mentor
                        </div>

                    </div>

                </div>


                <a
                    href="{{ route('student.sessions.completed') }}"
                    class="completed-link"
                >
                    <i class="fa-solid fa-circle-check"></i>
                    Completed Sessions
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

            </div>


            @if($sessions->count() > 0)

                <div class="table-scroll">

                    <table class="upcoming-table">

                        <thead>
                            <tr>
                                <th>Topic</th>
                                <th>Mentor</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($sessions as $s)

                                <tr>

                                    {{-- TOPIC --}}
                                    <td>

                                        <div class="topic-cell">

                                            <div class="topic-icon">
                                                <i class="fa-solid fa-comments"></i>
                                            </div>

                                            <div class="topic-name">
                                                {{ $s->topic }}
                                            </div>

                                        </div>

                                    </td>


                                    {{-- MENTOR --}}
                                    <td>

                                        <div class="mentor-cell">

                                            <div class="mentor-avatar">

                                                {{ strtoupper(
                                                    substr(
                                                        $s->mentor->name ?? 'M',
                                                        0,
                                                        1
                                                    )
                                                ) }}

                                            </div>

                                            <div class="mentor-name">
                                                {{ $s->mentor->name ?? 'Mentor' }}
                                            </div>

                                        </div>

                                    </td>


                                    {{-- DATE --}}
                                    <td>

                                        <div class="date-cell">

                                            <i class="fa-regular fa-calendar"></i>

                                            {{ $s->session_date
                                                ? $s->session_date->format('d M Y')
                                                : \Carbon\Carbon::parse($s->starts_at)->format('d M Y')
                                            }}

                                        </div>

                                    </td>


                                    {{-- TIME --}}
                                    <td>

                                        <div class="time-cell">

                                            <i class="fa-regular fa-clock"></i>

                                            @if($s->start_time)

                                                {{ \Carbon\Carbon::parse(
                                                    $s->start_time
                                                )->format('h:i A') }}

                                            @elseif($s->starts_at)

                                                {{ \Carbon\Carbon::parse(
                                                    $s->starts_at
                                                )->format('h:i A') }}

                                            @else

                                                —

                                            @endif

                                        </div>

                                    </td>


                                    {{-- STATUS --}}
                                    <td>

                                        @if($s->status === 'confirmed')

                                            <span class="session-status confirmed">
                                                <span class="status-dot"></span>
                                                Confirmed
                                            </span>

                                        @else

                                            <span class="session-status scheduled">
                                                <span class="status-dot"></span>
                                                Scheduled
                                            </span>

                                        @endif

                                    </td>


                                    {{-- ACTIONS --}}
                                    <td>

                                        <div class="actions-cell">

                                            {{-- CONFIRM --}}
                                            @if($s->status === 'scheduled')

                                                <form
                                                    method="POST"
                                                    action="{{ route(
                                                        'student.sessions.confirm',
                                                        $s
                                                    ) }}"
                                                >

                                                    @csrf

                                                    <button
                                                        type="submit"
                                                        class="action-btn action-primary"
                                                    >
                                                        <i class="fa-solid fa-check"></i>
                                                        Confirm
                                                    </button>

                                                </form>

                                            @endif


                                            {{-- JOIN --}}
                                            @if($s->meeting_link)

                                                <a
                                                    href="{{ $s->meeting_link }}"
                                                    target="_blank"
                                                    rel="noopener noreferrer"
                                                    class="action-btn action-join"
                                                >
                                                    <i class="fa-solid fa-video"></i>
                                                    Join
                                                </a>

                                            @endif


                                            {{-- DETAILS --}}
                                            <a
                                                href="{{ route(
                                                    'student.sessions.show',
                                                    $s
                                                ) }}"
                                                class="action-btn action-details"
                                            >
                                                <i class="fa-solid fa-arrow-right"></i>
                                                Details
                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="empty-state">

                    <div class="empty-icon">
                        <i class="fa-regular fa-calendar"></i>
                    </div>

                    <div class="empty-title">
                        No Upcoming Sessions
                    </div>

                    <p class="empty-description">
                        You don't have any sessions scheduled at the moment.
                        Find a mentor and start your mentorship journey to
                        schedule your first session.
                    </p>

                    <a
                        href="{{ route('student.mentors.index') }}"
                        class="find-mentor-btn"
                    >
                        <i class="fa-solid fa-user-plus"></i>
                        Find a Mentor
                    </a>

                </div>

            @endif

        </div>


        {{-- =====================================================
             TIP
        ====================================================== --}}
        <div class="session-tip">

            <div class="tip-icon">
                <i class="fa-solid fa-lightbulb"></i>
            </div>

            <div>

                <div class="tip-title">
                    Get ready for your next session
                </div>

                <div class="tip-text">
                    Review your previous session notes, prepare your questions
                    and make sure you're ready before joining your upcoming
                    mentorship meeting.
                </div>

            </div>

        </div>

    </div>

</div>

@endsection
@extends('layouts.app')

@section('content')

<style>
    :root {
        --primary: #3376F2;
        --primary-dark: #245FD0;
        --purple: #7C4DFF;
        --text: #172033;
        --muted: #718096;
        --border: #E7ECF4;
        --bg: #F7F9FC;
        --white: #FFFFFF;
        --green: #16A36A;
        --orange: #F59E0B;
        --red: #EF4444;
    }

    .mentees-page {
        min-height: 100vh;
        background: var(--bg);
        color: var(--text);
        font-family: "Poppins", "Inter", Arial, sans-serif;
        padding: 30px 34px 60px;
    }

    .mentees-container {
        max-width: 1440px;
        margin: 0 auto;
    }

    /* =====================================================
       ALERTS
    ===================================================== */

    .mentor-alert {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 14px 17px;
        border-radius: 12px;
        margin-bottom: 22px;
        font-size: 12px;
        font-weight: 600;
    }

    .mentor-alert.success {
        background: #EAF9F2;
        color: #147A4D;
        border: 1px solid #C8EEDD;
    }

    .mentor-alert.error {
        background: #FFF1F2;
        color: #BE123C;
        border: 1px solid #FFD5DC;
    }

    /* =====================================================
       HERO
    ===================================================== */

    .mentees-hero {
        position: relative;
        overflow: hidden;
        background: #FFFFFF;
        border: 1px solid var(--border);
        border-radius: 24px;
        padding: 42px 46px;
        margin-bottom: 26px;
        box-shadow: 0 12px 35px rgba(30, 55, 90, 0.06);
    }

    .mentees-hero::before {
        content: "";
        position: absolute;
        width: 280px;
        height: 280px;
        right: -100px;
        top: -130px;
        border-radius: 50%;
        background: rgba(51, 118, 242, 0.06);
    }

    .mentees-hero::after {
        content: "";
        position: absolute;
        width: 180px;
        height: 180px;
        right: 180px;
        bottom: -130px;
        border-radius: 50%;
        background: rgba(124, 77, 255, 0.05);
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-left {
        max-width: 760px;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #EEF4FF;
        color: var(--primary);
        border-radius: 30px;
        padding: 8px 14px;
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 17px;
    }

    .hero-badge-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: var(--primary);
    }

    .hero-title {
        margin: 0 0 12px;
        font-size: 38px;
        line-height: 1.2;
        font-weight: 800;
        letter-spacing: -1px;
        color: #15213A;
    }

    .hero-title span {
        color: var(--primary);
    }

    .hero-description {
        margin: 0;
        max-width: 700px;
        color: var(--muted);
        font-size: 15px;
        line-height: 1.8;
    }

    /* =====================================================
       STATS
    ===================================================== */

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 18px;
        padding: 22px;
        display: flex;
        align-items: center;
        gap: 15px;
        box-shadow: 0 8px 24px rgba(30, 55, 90, .045);
        transition: .2s ease;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(30, 55, 90, .07);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        flex-shrink: 0;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 19px;
    }

    .stat-icon.blue {
        background: #EEF4FF;
        color: var(--primary);
    }

    .stat-icon.orange {
        background: #FFF7E8;
        color: var(--orange);
    }

    .stat-icon.green {
        background: #EAF9F2;
        color: var(--green);
    }

    .stat-icon.purple {
        background: #F2EDFF;
        color: var(--purple);
    }

    .stat-label {
        margin: 0 0 5px;
        color: var(--muted);
        font-size: 12px;
        font-weight: 600;
    }

    .stat-value {
        margin: 0;
        color: #172033;
        font-size: 25px;
        font-weight: 800;
        line-height: 1;
    }

    /* =====================================================
       SECTIONS
    ===================================================== */

    .section {
        margin-bottom: 30px;
    }

    .section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 15px;
    }

    .section-title-wrap {
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .section-title-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: #EEF4FF;
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
    }

    .section-title {
        margin: 0;
        font-size: 19px;
        font-weight: 800;
        color: #172033;
    }

    .section-count {
        min-width: 28px;
        height: 26px;
        padding: 0 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 20px;
        background: #EEF4FF;
        color: var(--primary);
        font-size: 11px;
        font-weight: 800;
    }

    /* =====================================================
       REQUESTS
    ===================================================== */

    .requests-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 18px;
    }

    .request-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 18px;
        padding: 20px;
        box-shadow: 0 8px 24px rgba(30, 55, 90, .045);
    }

    .request-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 15px;
    }

    .student-info {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
    }

    .student-avatar {
        width: 46px;
        height: 46px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #EEF4FF;
        color: var(--primary);
        font-weight: 800;
        font-size: 16px;
        flex-shrink: 0;
    }

    .student-name {
        margin: 0 0 4px;
        font-size: 14px;
        font-weight: 800;
        color: #172033;
    }

    .student-email {
        margin: 0;
        font-size: 11px;
        color: var(--muted);
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .pending-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 9px;
        border-radius: 20px;
        background: #FFF7E8;
        color: #C77A00;
        font-size: 10px;
        font-weight: 800;
        white-space: nowrap;
    }

    .request-goal {
        margin-top: 17px;
        background: #F8FAFD;
        border-radius: 12px;
        padding: 13px;
    }

    .request-goal-label {
        margin: 0 0 5px;
        color: #8A94A6;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .5px;
    }

    .request-goal-text {
        margin: 0;
        color: #374151;
        font-size: 12px;
        line-height: 1.6;
    }

    .request-actions {
        display: flex;
        gap: 9px;
        margin-top: 15px;
    }

    .request-btn {
        flex: 1;
        min-height: 39px;
        border-radius: 10px;
        border: 1px solid var(--border);
        background: #fff;
        cursor: pointer;
        font-size: 11px;
        font-weight: 700;
        transition: .2s ease;
    }

    .request-btn.accept {
        background: var(--primary);
        border-color: var(--primary);
        color: #fff;
    }

    .request-btn.accept:hover {
        background: var(--primary-dark);
    }

    .request-btn.reject {
        color: var(--red);
    }

    .request-btn.reject:hover {
        background: #FFF1F2;
    }

    /* =====================================================
       ACTIVE MENTEES
    ===================================================== */

    .mentees-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
    }

    .mentee-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 18px;
        padding: 21px;
        box-shadow: 0 8px 24px rgba(30, 55, 90, .045);
        transition: .2s ease;
    }

    .mentee-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 13px 30px rgba(30, 55, 90, .07);
    }

    .mentee-card-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }

    .mentee-profile {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
    }

    .mentee-avatar {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        background: linear-gradient(135deg, #EEF4FF, #F2EDFF);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        font-weight: 800;
        flex-shrink: 0;
    }

    .mentee-name {
        margin: 0 0 4px;
        font-size: 14px;
        font-weight: 800;
        color: #172033;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .mentee-role {
        margin: 0;
        color: var(--muted);
        font-size: 11px;
    }

    .active-badge {
        padding: 6px 9px;
        border-radius: 20px;
        background: #EAF9F2;
        color: var(--green);
        font-size: 9px;
        font-weight: 800;
    }

    .mentee-divider {
        height: 1px;
        background: #EDF0F5;
        margin: 18px 0;
    }

    .mentee-meta {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 11px;
    }

    .meta-item {
        background: #F8FAFD;
        border-radius: 11px;
        padding: 11px;
    }

    .meta-label {
        margin: 0 0 4px;
        color: #8A94A6;
        font-size: 9px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .4px;
    }

    .meta-value {
        margin: 0;
        color: #374151;
        font-size: 11px;
        font-weight: 700;
    }

    .rating {
        display: flex;
        align-items: center;
        gap: 4px;
        color: #F59E0B;
    }

    .rating-number {
        color: #374151;
        margin-left: 2px;
    }

    .mentee-footer {
        display: flex;
        gap: 9px;
        margin-top: 17px;
    }

    .view-btn {
        flex: 1;
        min-height: 39px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: #EEF4FF;
        color: var(--primary);
        text-decoration: none;
        font-size: 11px;
        font-weight: 800;
        transition: .2s ease;
    }

    .view-btn:hover {
        background: var(--primary);
        color: #fff;
    }

    /* =====================================================
       UPCOMING SESSIONS
    ===================================================== */

    .sessions-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 8px 24px rgba(30, 55, 90, .045);
    }

    .session-row {
        display: grid;
        grid-template-columns: 76px 1fr auto;
        align-items: center;
        gap: 20px;
        padding: 19px 22px;
        border-bottom: 1px solid #EDF0F5;
    }

    .session-row:last-child {
        border-bottom: none;
    }

    .session-date-box {
        width: 62px;
        min-height: 64px;
        border-radius: 14px;
        background: #EEF4FF;
        color: var(--primary);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .session-month {
        font-size: 9px;
        text-transform: uppercase;
        font-weight: 800;
    }

    .session-day {
        font-size: 21px;
        line-height: 1.2;
        font-weight: 800;
    }

    .session-details {
        min-width: 0;
    }

    .session-title {
        margin: 0 0 6px;
        color: #172033;
        font-size: 13px;
        font-weight: 800;
    }

    .session-meta {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        color: var(--muted);
        font-size: 10px;
    }

    .session-meta span {
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .session-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 38px;
        padding: 0 15px;
        border-radius: 10px;
        background: #EEF4FF;
        color: var(--primary);
        text-decoration: none;
        font-size: 10px;
        font-weight: 800;
        white-space: nowrap;
    }

    .session-action:hover {
        background: var(--primary);
        color: #fff;
    }

    /* =====================================================
       COMPLETED
    ===================================================== */

    .completed-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
    }

    .completed-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 18px;
        padding: 19px;
        box-shadow: 0 8px 24px rgba(30, 55, 90, .04);
    }

    .completed-top {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .completed-avatar {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: #EAF9F2;
        color: var(--green);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 800;
    }

    .completed-name {
        margin: 0 0 3px;
        font-size: 13px;
        font-weight: 800;
    }

    .completed-date {
        margin: 0;
        color: var(--muted);
        font-size: 10px;
    }

    .completed-status {
        margin-left: auto;
        padding: 5px 8px;
        border-radius: 20px;
        background: #EAF9F2;
        color: var(--green);
        font-size: 9px;
        font-weight: 800;
    }

    /* =====================================================
       EMPTY
    ===================================================== */

    .empty-card {
        background: #fff;
        border: 1px dashed #DCE3ED;
        border-radius: 18px;
        padding: 42px 25px;
        text-align: center;
    }

    .empty-icon {
        width: 52px;
        height: 52px;
        margin: 0 auto 13px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #F1F4F8;
        color: #98A2B3;
        font-size: 19px;
    }

    .empty-title {
        margin: 0 0 6px;
        font-size: 14px;
        font-weight: 800;
        color: #374151;
    }

    .empty-text {
        margin: 0;
        color: var(--muted);
        font-size: 11px;
        line-height: 1.6;
    }

    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media (max-width: 1200px) {

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .mentees-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .completed-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 900px) {

        .mentees-page {
            padding: 22px 18px 45px;
        }

        .requests-grid {
            grid-template-columns: 1fr;
        }

        .mentees-grid {
            grid-template-columns: 1fr;
        }

        .completed-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 650px) {

        .mentees-hero {
            padding: 30px 24px;
        }

        .hero-title {
            font-size: 29px;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .session-row {
            grid-template-columns: 62px 1fr;
        }

        .session-action {
            grid-column: 2;
            justify-self: start;
        }
    }
</style>


<div class="mentees-page">

    <div class="mentees-container">

        {{-- ==================================================
             ALERTS
        =================================================== --}}

        @if(session('success'))
            <div class="mentor-alert success">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="mentor-alert error">
                <i class="fas fa-exclamation-circle"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif


        {{-- ==================================================
             HERO
        =================================================== --}}

        <section class="mentees-hero">

            <div class="hero-content">

                <div class="hero-left">

                    <div class="hero-badge">
                        <span class="hero-badge-dot"></span>
                        Mentor Workspace
                    </div>

                    <h1 class="hero-title">
                        My <span>Mentees</span>
                    </h1>

                    <p class="hero-description">
                        Manage your mentorship relationships, review student
                        requests, track upcoming sessions, and support your
                        mentees throughout their learning journey.
                    </p>

                </div>

            </div>

        </section>


        {{-- ==================================================
             STATS
        =================================================== --}}

        @php
            $upcomingSessions = $upcomingSessions ?? collect();
        @endphp

        <section class="stats-grid">

            <div class="stat-card">

                <div class="stat-icon blue">
                    <i class="fas fa-users"></i>
                </div>

                <div>
                    <p class="stat-label">
                        Active Mentees
                    </p>

                    <p class="stat-value">
                        {{ $stats['active_count'] ?? 0 }}
                    </p>
                </div>

            </div>


            <div class="stat-card">

                <div class="stat-icon orange">
                    <i class="fas fa-clock"></i>
                </div>

                <div>
                    <p class="stat-label">
                        Pending Requests
                    </p>

                    <p class="stat-value">
                        {{ $stats['pending_count'] ?? 0 }}
                    </p>
                </div>

            </div>


            <div class="stat-card">

                <div class="stat-icon purple">
                    <i class="fas fa-calendar-check"></i>
                </div>

                <div>
                    <p class="stat-label">
                        Upcoming Sessions
                    </p>

                    <p class="stat-value">
                        {{ $stats['upcoming_sessions_count'] ?? $upcomingSessions->count() }}
                    </p>
                </div>

            </div>


            <div class="stat-card">

                <div class="stat-icon green">
                    <i class="fas fa-check-double"></i>
                </div>

                <div>
                    <p class="stat-label">
                        Completed
                    </p>

                    <p class="stat-value">
                        {{ $stats['completed_count'] ?? 0 }}
                    </p>
                </div>

            </div>

        </section>


        {{-- ==================================================
             PENDING REQUESTS
        =================================================== --}}

        <section class="section">

            <div class="section-header">

                <div class="section-title-wrap">

                    <div class="section-title-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>

                    <h2 class="section-title">
                        Pending Requests
                    </h2>

                    @if($pendingRequests->count() > 0)
                        <span class="section-count">
                            {{ $pendingRequests->count() }}
                        </span>
                    @endif

                </div>

            </div>


            @if($pendingRequests->count() > 0)

                <div class="requests-grid">

                    @foreach($pendingRequests as $requestItem)

                        @php

                            $student = $requestItem->student;

                            $studentName =
                                $student->name ?? 'Student';

                            $studentInitials = collect(
                                preg_split(
                                    '/\s+/',
                                    trim($studentName)
                                )
                            )
                            ->filter()
                            ->take(2)
                            ->map(
                                fn($word) =>
                                    strtoupper(
                                        substr($word, 0, 1)
                                    )
                            )
                            ->implode('');

                            $studentEmail =
                                $student->email ?? '';

                            $careerGoal =
                                $requestItem->career_goal
                                ?? 'Mentorship support requested.';

                        @endphp


                        <div class="request-card">

                            <div class="request-top">

                                <div class="student-info">

                                    <div class="student-avatar">
                                        {{ $studentInitials ?: 'S' }}
                                    </div>

                                    <div>

                                        <h3 class="student-name">
                                            {{ $studentName }}
                                        </h3>

                                        @if($studentEmail)

                                            <p class="student-email">
                                                {{ $studentEmail }}
                                            </p>

                                        @endif

                                    </div>

                                </div>


                                <span class="pending-badge">
                                    <i class="fas fa-clock"></i>
                                    Pending
                                </span>

                            </div>


                            <div class="request-goal">

                                <p class="request-goal-label">
                                    Career Goal
                                </p>

                                <p class="request-goal-text">
                                    {{ $careerGoal }}
                                </p>

                            </div>


                            {{-- IMPORTANT:
                                 Routes are mentor.requests.accept
                                 and mentor.requests.reject
                            --}}

                            <div class="request-actions">

                                <form
                                    action="{{ route('mentor.requests.accept', $requestItem) }}"
                                    method="POST"
                                    style="flex:1;"
                                >

                                    @csrf

                                    <button
                                        type="submit"
                                        class="request-btn accept"
                                        style="width:100%;"
                                    >
                                        <i class="fas fa-check"></i>
                                        Accept
                                    </button>

                                </form>


                                <form
                                    action="{{ route('mentor.requests.reject', $requestItem) }}"
                                    method="POST"
                                    style="flex:1;"
                                    onsubmit="return confirm('Are you sure you want to reject this mentorship request?');"
                                >

                                    @csrf

                                    <button
                                        type="submit"
                                        class="request-btn reject"
                                        style="width:100%;"
                                    >
                                        <i class="fas fa-times"></i>
                                        Reject
                                    </button>

                                </form>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="empty-card">

                    <div class="empty-icon">
                        <i class="fas fa-user-check"></i>
                    </div>

                    <h3 class="empty-title">
                        No Pending Requests
                    </h3>

                    <p class="empty-text">
                        New mentorship requests from students will appear here.
                    </p>

                </div>

            @endif

        </section>


        {{-- ==================================================
             ACTIVE MENTEES
        =================================================== --}}

        <section class="section">

            <div class="section-header">

                <div class="section-title-wrap">

                    <div class="section-title-icon">
                        <i class="fas fa-users"></i>
                    </div>

                    <h2 class="section-title">
                        Active Mentees
                    </h2>

                    @if($activeMentees->count() > 0)
                        <span class="section-count">
                            {{ $activeMentees->count() }}
                        </span>
                    @endif

                </div>

            </div>


            @if($activeMentees->count() > 0)

                <div class="mentees-grid">

                    @foreach($activeMentees as $mentorship)

                        @php

                            $student = $mentorship->student;

                            $studentName =
                                $student->name ?? 'Student';

                            $initials = collect(
                                preg_split(
                                    '/\s+/',
                                    trim($studentName)
                                )
                            )
                            ->filter()
                            ->take(2)
                            ->map(
                                fn($word) =>
                                    strtoupper(
                                        substr($word, 0, 1)
                                    )
                            )
                            ->implode('');

                            $latestSession =
                                $mentorship->sessions->first();

                            $rating =
                                $mentorship->avg_rating;

                            $rating = is_numeric($rating)
                                ? number_format(
                                    (float)$rating,
                                    1
                                )
                                : '—';

                        @endphp


                        <div class="mentee-card">

                            <div class="mentee-card-top">

                                <div class="mentee-profile">

                                    <div class="mentee-avatar">
                                        {{ $initials ?: 'S' }}
                                    </div>

                                    <div style="min-width:0;">

                                        <h3 class="mentee-name">
                                            {{ $studentName }}
                                        </h3>

                                        <p class="mentee-role">
                                            Active Mentee
                                        </p>

                                    </div>

                                </div>


                                <span class="active-badge">
                                    ACTIVE
                                </span>

                            </div>


                            <div class="mentee-divider"></div>


                            <div class="mentee-meta">

                                <div class="meta-item">

                                    <p class="meta-label">
                                        Sessions
                                    </p>

                                    <p class="meta-value">

                                        @if(isset($mentorship->sessions_count))

                                            {{ $mentorship->sessions_count }}

                                        @else

                                            {{ $mentorship->sessions->count() }}

                                        @endif

                                    </p>

                                </div>


                                <div class="meta-item">

                                    <p class="meta-label">
                                        Rating
                                    </p>

                                    <p class="meta-value rating">

                                        @if($rating !== '—')
                                            <i class="fas fa-star"></i>
                                        @endif

                                        <span class="rating-number">
                                            {{ $rating }}
                                        </span>

                                    </p>

                                </div>

                            </div>


                            <div class="mentee-footer">

                                <a
                                    href="{{ route('mentor.mentees.show', $mentorship) }}"
                                    class="view-btn"
                                >
                                    View Mentee

                                    <i
                                        class="fas fa-arrow-right"
                                        style="margin-left:7px;"
                                    ></i>

                                </a>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="empty-card">

                    <div class="empty-icon">
                        <i class="fas fa-users"></i>
                    </div>

                    <h3 class="empty-title">
                        No Active Mentees Yet
                    </h3>

                    <p class="empty-text">
                        Once you accept a mentorship request,
                        the student will appear here.
                    </p>

                </div>

            @endif

        </section>


        {{-- ==================================================
             UPCOMING SESSIONS
        =================================================== --}}

        <section class="section">

            <div class="section-header">

                <div class="section-title-wrap">

                    <div class="section-title-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>

                    <h2 class="section-title">
                        Upcoming Sessions
                    </h2>

                    @if($upcomingSessions->count() > 0)

                        <span class="section-count">
                            {{ $upcomingSessions->count() }}
                        </span>

                    @endif

                </div>

            </div>


            @if($upcomingSessions->count() > 0)

                <div class="sessions-card">

                    @foreach($upcomingSessions as $item)

                        @php

                            $session =
                                $item['session'];

                            $mentee =
                                $item['mentee'];

                            $student =
                                $mentee->student ?? null;

                            $studentName =
                                $student->name ?? 'Mentee';

                            $sessionDate = null;

                            if (!empty($session->starts_at)) {

                                try {

                                    $sessionDate =
                                        \Carbon\Carbon::parse(
                                            $session->starts_at
                                        );

                                } catch (\Exception $e) {

                                    $sessionDate = null;

                                }

                            }

                            $sessionTitle =
                                $session->title
                                ?? $session->topic
                                ?? 'Mentorship Session';

                            $sessionMode =
                                $session->meeting_type
                                ?? $session->mode
                                ?? 'Online';

                            $meetingUrl =
                                $session->meeting_url
                                ?? $session->join_url
                                ?? null;

                        @endphp


                        <div class="session-row">

                            <div class="session-date-box">

                                @if($sessionDate)

                                    <span class="session-month">
                                        {{ $sessionDate->format('M') }}
                                    </span>

                                    <span class="session-day">
                                        {{ $sessionDate->format('d') }}
                                    </span>

                                @else

                                    <span class="session-month">
                                        Date
                                    </span>

                                    <span class="session-day">
                                        —
                                    </span>

                                @endif

                            </div>


                            <div class="session-details">

                                <h3 class="session-title">
                                    {{ $sessionTitle }}
                                </h3>

                                <div class="session-meta">

                                    <span>
                                        <i class="fas fa-user"></i>
                                        {{ $studentName }}
                                    </span>


                                    @if($sessionDate)

                                        <span>
                                            <i class="fas fa-clock"></i>
                                            {{ $sessionDate->format('h:i A') }}
                                        </span>

                                    @endif


                                    <span>
                                        <i class="fas fa-video"></i>
                                        {{ ucfirst($sessionMode) }}
                                    </span>

                                </div>

                            </div>


                            <div>

                                @if($meetingUrl)

                                    <a
                                        href="{{ $meetingUrl }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="session-action"
                                    >
                                        Join Session
                                    </a>

                                @else

                                    <a
                                        href="{{ route('mentor.mentees.show', $mentee) }}"
                                        class="session-action"
                                    >
                                        View Session
                                    </a>

                                @endif

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="empty-card">

                    <div class="empty-icon">
                        <i class="fas fa-calendar-day"></i>
                    </div>

                    <h3 class="empty-title">
                        No Upcoming Sessions
                    </h3>

                    <p class="empty-text">
                        Your scheduled mentorship sessions will appear here.
                    </p>

                </div>

            @endif

        </section>


        {{-- ==================================================
             COMPLETED MENTORSHIPS
        =================================================== --}}

        <section class="section">

            <div class="section-header">

                <div class="section-title-wrap">

                    <div class="section-title-icon">
                        <i class="fas fa-check-double"></i>
                    </div>

                    <h2 class="section-title">
                        Completed Mentorships
                    </h2>

                    @if($completed->count() > 0)

                        <span class="section-count">
                            {{ $completed->count() }}
                        </span>

                    @endif

                </div>

            </div>


            @if($completed->count() > 0)

                <div class="completed-grid">

                    @foreach($completed as $mentorship)

                        @php

                            $student =
                                $mentorship->student;

                            $studentName =
                                $student->name ?? 'Student';

                            $initials = collect(
                                preg_split(
                                    '/\s+/',
                                    trim($studentName)
                                )
                            )
                            ->filter()
                            ->take(2)
                            ->map(
                                fn($word) =>
                                    strtoupper(
                                        substr($word, 0, 1)
                                    )
                            )
                            ->implode('');

                            $completedDate =
                                $mentorship->completed_at
                                ?? $mentorship->updated_at;

                        @endphp


                        <div class="completed-card">

                            <div class="completed-top">

                                <div class="completed-avatar">
                                    {{ $initials ?: 'S' }}
                                </div>

                                <div>

                                    <h3 class="completed-name">
                                        {{ $studentName }}
                                    </h3>

                                    <p class="completed-date">

                                        @if($completedDate)

                                            Completed
                                            {{ \Carbon\Carbon::parse($completedDate)->format('M d, Y') }}

                                        @else

                                            Mentorship completed

                                        @endif

                                    </p>

                                </div>

                                <span class="completed-status">
                                    COMPLETED
                                </span>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="empty-card">

                    <div class="empty-icon">
                        <i class="fas fa-history"></i>
                    </div>

                    <h3 class="empty-title">
                        No Completed Mentorships
                    </h3>

                    <p class="empty-text">
                        Completed mentorship relationships will appear here.
                    </p>

                </div>

            @endif

        </section>

    </div>

</div>

@endsection
@extends('layouts.app')

@php($portal = 'student')

@section('title', 'Upcoming Sessions')

@section('content')

<style>
    :root {
        --up-primary: #3376F2;
        --up-primary-dark: #245ED1;
        --up-purple: #7C4DFF;
        --up-bg: #F7F9FF;
        --up-text: #172033;
        --up-muted: #718096;
        --up-border: #E8ECF5;
        --up-green: #18A957;
        --up-amber: #F59E0B;
        --up-shadow: 0 10px 35px rgba(40, 64, 120, .07);
    }

    .upcoming-page {
        width: 100%;
        min-height: 100vh;
        background: var(--up-bg);
        padding: 10px 0 50px;
    }

    /* =========================
       HERO
    ========================= */

    .upcoming-hero {
        position: relative;
        overflow: hidden;
        border-radius: 22px;
        padding: 35px 38px;
        margin-bottom: 22px;
        background: linear-gradient(
            120deg,
            #3376F2 0%,
            #526EF3 50%,
            #7C4DFF 100%
        );
        color: #fff;
        box-shadow: 0 16px 40px rgba(51, 118, 242, .18);
    }

    .upcoming-hero::before {
        content: "";
        position: absolute;
        width: 300px;
        height: 300px;
        border-radius: 50%;
        background: rgba(255,255,255,.08);
        right: -100px;
        top: -160px;
    }

    .upcoming-hero::after {
        content: "";
        position: absolute;
        width: 190px;
        height: 190px;
        border-radius: 50%;
        background: rgba(255,255,255,.06);
        left: 45%;
        bottom: -130px;
    }

    .upcoming-hero-inner {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 30px;
    }

    .upcoming-hero-left {
        max-width: 680px;
    }

    .upcoming-label {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 7px 12px;
        border-radius: 50px;
        background: rgba(255,255,255,.13);
        border: 1px solid rgba(255,255,255,.18);
        font-size: 11px;
        font-weight: 700;
        margin-bottom: 14px;
    }

    .upcoming-title {
        margin: 0 0 9px;
        font-size: clamp(27px, 4vw, 38px);
        line-height: 1.15;
        font-weight: 800;
        letter-spacing: -.5px;
    }

    .upcoming-description {
        margin: 0;
        max-width: 600px;
        color: rgba(255,255,255,.82);
        font-size: 13px;
        line-height: 1.7;
    }

    .upcoming-hero-icon {
        width: 100px;
        height: 100px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 28px;
        background: rgba(255,255,255,.12);
        border: 1px solid rgba(255,255,255,.18);
        backdrop-filter: blur(10px);
        font-size: 42px;
    }

    /* =========================
       STATS
    ========================= */

    .upcoming-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        margin-bottom: 22px;
    }

    .up-stat {
        position: relative;
        overflow: hidden;
        background: #fff;
        border: 1px solid var(--up-border);
        border-radius: 16px;
        padding: 19px;
        box-shadow: var(--up-shadow);
        transition: .2s ease;
    }

    .up-stat:hover {
        transform: translateY(-2px);
        box-shadow: 0 14px 35px rgba(40, 64, 120, .10);
    }

    .up-stat::after {
        content: "";
        position: absolute;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: rgba(51,118,242,.05);
        right: -25px;
        top: -25px;
    }

    .up-stat-icon {
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        background: #EEF4FF;
        color: var(--up-primary);
        margin-bottom: 12px;
    }

    .up-stat:nth-child(2) .up-stat-icon {
        background: #EAF9F0;
        color: var(--up-green);
    }

    .up-stat:nth-child(3) .up-stat-icon {
        background: #FFF7E5;
        color: var(--up-amber);
    }

    .up-stat-number {
        font-size: 24px;
        line-height: 1;
        font-weight: 800;
        color: var(--up-text);
        margin-bottom: 6px;
    }

    .up-stat-label {
        color: var(--up-muted);
        font-size: 11px;
    }

    /* =========================
       MAIN CARD
    ========================= */

    .sessions-container {
        background: #fff;
        border: 1px solid var(--up-border);
        border-radius: 19px;
        box-shadow: var(--up-shadow);
        overflow: hidden;
    }

    .sessions-header {
        padding: 20px 22px;
        border-bottom: 1px solid var(--up-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .sessions-heading {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .sessions-heading-icon {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: #EEF4FF;
        color: var(--up-primary);
        font-size: 14px;
    }

    .sessions-title {
        color: var(--up-text);
        font-size: 15px;
        font-weight: 800;
    }

    .sessions-subtitle {
        color: var(--up-muted);
        font-size: 10px;
        margin-top: 3px;
    }

    .completed-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 11px;
        border-radius: 8px;
        background: #F2F6FF;
        color: var(--up-primary);
        text-decoration: none;
        font-size: 11px;
        font-weight: 700;
        transition: .2s ease;
    }

    .completed-link:hover {
        background: #E7EFFF;
        color: var(--up-primary-dark);
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
        background: linear-gradient(
            135deg,
            #EEF4FF,
            #F1ECFF
        );
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
        background: linear-gradient(
            135deg,
            #3376F2,
            #7C4DFF
        );
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
        padding: 6px 9px;
        border-radius: 50px;
        font-size: 9px;
        font-weight: 800;
    }

    .session-status.confirmed {
        background: #EAF9F0;
        color: #148548;
    }

    .session-status.scheduled {
        background: #FFF7E5;
        color: #B87500;
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
        gap: 7px;
        white-space: nowrap;
    }

    .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 8px 10px;
        border-radius: 8px;
        font-size: 10px;
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
        background: #EAF9F0;
        color: #148548;
        border-color: #D3F0DF;
    }

    .action-join:hover {
        background: #DDF5E6;
        color: #10733D;
    }

    .action-details {
        background: #F2F6FF;
        color: var(--up-primary);
        border-color: #E2EAFB;
    }

    .action-details:hover {
        background: #E7EFFF;
        color: var(--up-primary-dark);
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
        background: linear-gradient(
            135deg,
            #EEF4FF,
            #F1ECFF
        );
        color: var(--up-primary);
        font-size: 28px;
    }

    .empty-title {
        color: var(--up-text);
        font-size: 17px;
        font-weight: 800;
        margin-bottom: 7px;
    }

    .empty-description {
        max-width: 430px;
        margin: 0 auto 18px;
        color: var(--up-muted);
        font-size: 12px;
        line-height: 1.7;
    }

    .find-mentor-btn {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 10px 15px;
        border-radius: 9px;
        background: var(--up-primary);
        color: #fff;
        text-decoration: none;
        font-size: 11px;
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
        gap: 14px;
        margin-top: 20px;
        padding: 17px 19px;
        border-radius: 15px;
        border: 1px solid #E1E8F7;
        background: linear-gradient(
            135deg,
            #F2F6FF,
            #F8F4FF
        );
    }

    .tip-icon {
        width: 38px;
        height: 38px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        background: #fff;
        color: var(--up-primary);
        box-shadow: 0 5px 15px rgba(40,64,120,.06);
    }

    .tip-title {
        color: var(--up-text);
        font-size: 12px;
        font-weight: 800;
        margin-bottom: 3px;
    }

    .tip-text {
        color: var(--up-muted);
        font-size: 10px;
        line-height: 1.5;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 850px) {

        .upcoming-hero-inner {
            align-items: flex-start;
        }

        .upcoming-hero-icon {
            width: 75px;
            height: 75px;
            font-size: 30px;
            border-radius: 20px;
        }
    }

    @media (max-width: 650px) {

        .upcoming-page {
            padding-top: 0;
        }

        .upcoming-hero {
            border-radius: 17px;
            padding: 28px 23px;
        }

        .upcoming-hero-inner {
            display: block;
        }

        .upcoming-hero-icon {
            display: none;
        }

        .upcoming-title {
            font-size: 29px;
        }

        .upcoming-description {
            font-size: 12px;
        }

        .upcoming-stats {
            grid-template-columns: 1fr;
        }

        .up-stat {
            padding: 16px;
        }

        .sessions-header {
            flex-direction: column;
            align-items: flex-start;
            padding: 17px;
        }

        .completed-link {
            width: 100%;
            justify-content: center;
        }

        .session-tip {
            align-items: flex-start;
        }
    }
</style>


<div class="upcoming-page">

    {{-- HERO --}}
    <section class="upcoming-hero">

        <div class="upcoming-hero-inner">

            <div class="upcoming-hero-left">

                <div class="upcoming-label">
                    <i class="fa-regular fa-calendar-days"></i>
                    Student Mentorship
                </div>

                <h1 class="upcoming-title">
                    Upcoming Sessions
                </h1>

                <p class="upcoming-description">
                    Stay on top of your mentorship journey. View your
                    scheduled sessions, confirm your attendance and
                    join your mentor when it's time.
                </p>

            </div>

            <div class="upcoming-hero-icon">
                <i class="fa-solid fa-calendar-check"></i>
            </div>

        </div>

    </section>


    {{-- STATISTICS --}}
    <div class="upcoming-stats">

        <div class="up-stat">

            <div class="up-stat-icon">
                <i class="fa-regular fa-calendar"></i>
            </div>

            <div class="up-stat-number">
                {{ $totalUpcoming }}
            </div>

            <div class="up-stat-label">
                Upcoming Sessions
            </div>

        </div>


        <div class="up-stat">

            <div class="up-stat-icon">
                <i class="fa-solid fa-circle-check"></i>
            </div>

            <div class="up-stat-number">
                {{ $confirmedCount }}
            </div>

            <div class="up-stat-label">
                Confirmed Sessions
            </div>

        </div>


        <div class="up-stat">

            <div class="up-stat-icon">
                <i class="fa-solid fa-clock"></i>
            </div>

            <div class="up-stat-number">
                {{ $scheduledCount }}
            </div>

            <div class="up-stat-label">
                Awaiting Confirmation
            </div>

        </div>

    </div>


    {{-- SESSIONS --}}
    <div class="sessions-container">

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


    {{-- TIP --}}
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

@endsection
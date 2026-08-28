@extends('layouts.app')

@php($portal = 'student')

@section('title', 'Completed Sessions')

@section('content')

<style>
    :root {
        --primary: #3376F2;
        --primary-dark: #245ED1;
        --purple: #7C4DFF;
        --bg: #F7F9FF;
        --card: #FFFFFF;
        --text: #172033;
        --muted: #718096;
        --border: #E8ECF5;
        --green: #18A957;
        --amber: #F59E0B;
        --shadow: 0 10px 35px rgba(40, 64, 120, .07);
    }

    .completed-page {
        background: var(--bg);
        min-height: 100vh;
        padding: 10px 0 50px;
    }

    /* =========================================
       HERO
    ========================================= */

    .completed-hero {
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

    .completed-hero::before {
        content: "";
        position: absolute;
        width: 260px;
        height: 260px;
        border-radius: 50%;
        background: rgba(255,255,255,.08);
        right: -70px;
        top: -120px;
    }

    .completed-hero::after {
        content: "";
        position: absolute;
        width: 170px;
        height: 170px;
        border-radius: 50%;
        background: rgba(255,255,255,.06);
        left: 45%;
        bottom: -120px;
    }

    .hero-inner {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 30px;
    }

    .hero-left {
        max-width: 700px;
    }

    .hero-label {
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

    .hero-title {
        margin: 0 0 9px;
        font-size: clamp(27px, 4vw, 38px);
        line-height: 1.15;
        font-weight: 800;
        letter-spacing: -.5px;
    }

    .hero-description {
        margin: 0;
        max-width: 600px;
        color: rgba(255,255,255,.82);
        font-size: 13px;
        line-height: 1.7;
    }

    .hero-icon {
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

    /* =========================================
       SUMMARY
    ========================================= */

    .summary-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        margin-bottom: 22px;
    }

    .summary-card {
        position: relative;
        overflow: hidden;
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 19px;
        box-shadow: var(--shadow);
    }

    .summary-card::after {
        content: "";
        position: absolute;
        width: 75px;
        height: 75px;
        border-radius: 50%;
        background: rgba(51,118,242,.05);
        right: -25px;
        top: -25px;
    }

    .summary-icon {
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        background: #EEF4FF;
        color: var(--primary);
        margin-bottom: 12px;
    }

    .summary-number {
        font-size: 24px;
        line-height: 1;
        font-weight: 800;
        color: var(--text);
        margin-bottom: 6px;
    }

    .summary-label {
        font-size: 11px;
        color: var(--muted);
    }

    /* =========================================
       MAIN CARD
    ========================================= */

    .sessions-card {
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 19px;
        box-shadow: var(--shadow);
        overflow: hidden;
    }

    .sessions-header {
        padding: 20px 22px;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .section-heading {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-icon {
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: #EAF9F0;
        color: var(--green);
        font-size: 14px;
    }

    .section-title {
        font-size: 15px;
        font-weight: 800;
        color: var(--text);
    }

    .section-subtitle {
        color: var(--muted);
        font-size: 10px;
        margin-top: 3px;
    }

    .upcoming-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: var(--primary);
        text-decoration: none;
        font-size: 11px;
        font-weight: 700;
        padding: 8px 11px;
        border-radius: 8px;
        background: #F2F6FF;
        transition: .2s ease;
    }

    .upcoming-link:hover {
        color: var(--primary-dark);
        background: #E8F0FF;
    }

    /* =========================================
       TABLE
    ========================================= */

    .table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .sessions-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 750px;
    }

    .sessions-table th {
        padding: 13px 20px;
        background: #FAFBFE;
        border-bottom: 1px solid var(--border);
        color: #8792A7;
        font-size: 10px;
        text-align: left;
        text-transform: uppercase;
        letter-spacing: .45px;
        font-weight: 800;
    }

    .sessions-table td {
        padding: 16px 20px;
        border-bottom: 1px solid #F0F2F7;
        font-size: 12px;
        color: #4C586D;
        vertical-align: middle;
    }

    .sessions-table tbody tr {
        transition: .18s ease;
    }

    .sessions-table tbody tr:hover {
        background: #FBFCFF;
    }

    .sessions-table tbody tr:last-child td {
        border-bottom: 0;
    }

    /* =========================================
       TOPIC
    ========================================= */

    .topic-wrapper {
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .topic-icon {
        width: 36px;
        height: 36px;
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
        color: var(--primary);
        font-size: 13px;
    }

    .topic-name {
        color: var(--text);
        font-weight: 700;
        line-height: 1.4;
        max-width: 250px;
    }

    /* =========================================
       MENTOR
    ========================================= */

    .mentor-wrapper {
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
    }

    /* =========================================
       DATE
    ========================================= */

    .date-wrapper {
        display: flex;
        align-items: center;
        gap: 7px;
        white-space: nowrap;
    }

    .date-wrapper i {
        color: var(--primary);
        font-size: 11px;
    }

    /* =========================================
       RATING
    ========================================= */

    .rating-wrapper {
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .stars {
        display: inline-flex;
        align-items: center;
        gap: 2px;
    }

    .star-filled {
        color: #F59E0B;
        font-size: 12px;
    }

    .star-empty {
        color: #E4E7EC;
        font-size: 12px;
    }

    .rating-number {
        font-size: 10px;
        color: #8A94A8;
        font-weight: 700;
    }

    .not-rated {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #929BAD;
        background: #F5F6F8;
        padding: 6px 9px;
        border-radius: 50px;
        font-size: 10px;
        font-weight: 600;
    }

    /* =========================================
       DETAILS BUTTON
    ========================================= */

    .details-btn {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        color: var(--primary);
        text-decoration: none;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
        padding: 8px 10px;
        border-radius: 8px;
        background: #F2F6FF;
        transition: .2s ease;
    }

    .details-btn:hover {
        color: var(--primary-dark);
        background: #E7EFFF;
        transform: translateX(2px);
    }

    /* =========================================
       PAGINATION
    ========================================= */

    .pagination-area {
        padding: 17px 20px;
        border-top: 1px solid var(--border);
        background: #FCFDFF;
    }

    .pagination-area nav {
        display: flex;
        justify-content: center;
    }

    .pagination-area .pagination {
        display: flex;
        align-items: center;
        gap: 5px;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .pagination-area .page-item {
        list-style: none;
    }

    .pagination-area .page-link {
        min-width: 31px;
        height: 31px;
        padding: 0 9px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #E1E6F0;
        border-radius: 8px;
        background: #fff;
        color: #647086;
        text-decoration: none;
        font-size: 11px;
        font-weight: 600;
    }

    .pagination-area .page-item.active .page-link {
        background: var(--primary);
        border-color: var(--primary);
        color: #fff;
    }

    .pagination-area .page-link:hover {
        background: #F1F5FF;
        color: var(--primary);
    }

    .pagination-area .page-item.disabled .page-link {
        opacity: .45;
        pointer-events: none;
    }

    /* =========================================
       EMPTY STATE
    ========================================= */

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
        color: var(--primary);
        font-size: 28px;
    }

    .empty-title {
        color: var(--text);
        font-size: 17px;
        font-weight: 800;
        margin-bottom: 7px;
    }

    .empty-description {
        max-width: 430px;
        margin: 0 auto 18px;
        color: var(--muted);
        font-size: 12px;
        line-height: 1.7;
    }

    .find-mentor-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 15px;
        border-radius: 9px;
        background: var(--primary);
        color: #fff;
        text-decoration: none;
        font-size: 11px;
        font-weight: 700;
        transition: .2s ease;
    }

    .find-mentor-btn:hover {
        background: var(--primary-dark);
        color: #fff;
        transform: translateY(-1px);
    }

    /* =========================================
       INFO BANNER
    ========================================= */

    .info-banner {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-top: 20px;
        padding: 18px 20px;
        border-radius: 15px;
        border: 1px solid #E1E8F7;
        background: linear-gradient(
            135deg,
            #F2F6FF,
            #F8F4FF
        );
    }

    .info-icon {
        width: 38px;
        height: 38px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        background: #fff;
        color: var(--primary);
        box-shadow: 0 5px 15px rgba(40,64,120,.06);
    }

    .info-title {
        font-size: 12px;
        font-weight: 800;
        color: var(--text);
        margin-bottom: 3px;
    }

    .info-text {
        font-size: 10px;
        color: var(--muted);
        line-height: 1.5;
    }

    /* =========================================
       RESPONSIVE
    ========================================= */

    @media (max-width: 850px) {

        .hero-inner {
            align-items: flex-start;
        }

        .hero-icon {
            width: 75px;
            height: 75px;
            font-size: 30px;
            border-radius: 20px;
        }

        .summary-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 650px) {

        .completed-page {
            padding-top: 0;
        }

        .completed-hero {
            border-radius: 17px;
            padding: 28px 23px;
        }

        .hero-inner {
            display: block;
        }

        .hero-icon {
            display: none;
        }

        .hero-title {
            font-size: 29px;
        }

        .hero-description {
            font-size: 12px;
        }

        .summary-grid {
            grid-template-columns: 1fr;
        }

        .summary-card {
            padding: 16px;
        }

        .sessions-header {
            align-items: flex-start;
            flex-direction: column;
            padding: 17px;
        }

        .upcoming-link {
            width: 100%;
            justify-content: center;
        }

        .info-banner {
            align-items: flex-start;
        }
    }
</style>

<div class="completed-page">

    {{-- =========================================
         HERO
    ========================================== --}}

    <section class="completed-hero">

        <div class="hero-inner">

            <div class="hero-left">

                <div class="hero-label">
                    <i class="fa-solid fa-graduation-cap"></i>
                    Student Mentorship
                </div>

                <h1 class="hero-title">
                    Completed Sessions
                </h1>

                <p class="hero-description">
                    Review your mentorship journey, revisit completed
                    sessions and see the feedback from your mentoring
                    experience.
                </p>

            </div>

            <div class="hero-icon">
                <i class="fa-solid fa-circle-check"></i>
            </div>

        </div>

    </section>


    {{-- =========================================
         SUMMARY
    ========================================== --}}

    <div class="summary-grid">

        {{-- TOTAL COMPLETED --}}

        <div class="summary-card">

            <div class="summary-icon">
                <i class="fa-solid fa-circle-check"></i>
            </div>

            <div class="summary-number">
                {{ $totalSessions }}
            </div>

            <div class="summary-label">
                Completed Sessions
            </div>

        </div>


        {{-- RATED --}}

        <div class="summary-card">

            <div class="summary-icon">
                <i class="fa-solid fa-star"></i>
            </div>

            <div class="summary-number">
                {{ $ratedSessions }}
            </div>

            <div class="summary-label">
                Sessions Rated
            </div>

        </div>


        {{-- AVERAGE RATING --}}

        <div class="summary-card">

            <div class="summary-icon">
                <i class="fa-solid fa-chart-simple"></i>
            </div>

            <div class="summary-number">

                @if($averageRating !== null)

                    {{ number_format($averageRating, 1) }}

                    <span style="font-size:13px;color:#F59E0B;">
                        ★
                    </span>

                @else

                    —

                @endif

            </div>

            <div class="summary-label">
                Average Rating
            </div>

        </div>

    </div>


    {{-- =========================================
         COMPLETED SESSIONS
    ========================================== --}}

    <div class="sessions-card">

        <div class="sessions-header">

            <div class="section-heading">

                <div class="section-icon">
                    <i class="fa-solid fa-circle-check"></i>
                </div>

                <div>

                    <div class="section-title">
                        Your Completed Sessions
                    </div>

                    <div class="section-subtitle">
                        A record of your mentorship sessions
                    </div>

                </div>

            </div>


            <a
                href="{{ route('student.sessions.upcoming') }}"
                class="upcoming-link"
            >

                <i class="fa-regular fa-calendar"></i>

                Upcoming Sessions

                <i class="fa-solid fa-arrow-right"></i>

            </a>

        </div>


        @if($sessions->count())

            {{-- =========================================
                 TABLE
            ========================================== --}}

            <div class="table-wrapper">

                <table class="sessions-table">

                    <thead>

                        <tr>

                            <th>
                                Topic
                            </th>

                            <th>
                                Mentor
                            </th>

                            <th>
                                Date
                            </th>

                            <th>
                                Your Rating
                            </th>

                            <th>
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($sessions as $s)

                            <tr>

                                {{-- TOPIC --}}

                                <td>

                                    <div class="topic-wrapper">

                                        <div class="topic-icon">
                                            <i class="fa-solid fa-comments"></i>
                                        </div>

                                        <div class="topic-name">

                                            {{ $s->topic ?? 'Mentorship Session' }}

                                        </div>

                                    </div>

                                </td>


                                {{-- MENTOR --}}

                                <td>

                                    @if($s->mentor)

                                        <div class="mentor-wrapper">

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

                                    @else

                                        <span class="not-rated">
                                            Mentor unavailable
                                        </span>

                                    @endif

                                </td>


                                {{-- DATE --}}

                                <td>

                                    <div class="date-wrapper">

                                        <i class="fa-regular fa-calendar"></i>

                                        @if($s->session_date)

                                            {{ $s->session_date->format('d M Y') }}

                                        @else

                                            —

                                        @endif

                                    </div>

                                </td>


                                {{-- RATING --}}

                                <td>

                                    @if($s->feedback)

                                        <div class="rating-wrapper">

                                            <div class="stars">

                                                @for($i = 1; $i <= 5; $i++)

                                                    @if($i <= (int) $s->feedback->rating)

                                                        <i class="fa-solid fa-star star-filled"></i>

                                                    @else

                                                        <i class="fa-solid fa-star star-empty"></i>

                                                    @endif

                                                @endfor

                                            </div>

                                            <span class="rating-number">

                                                {{ $s->feedback->rating }}/5

                                            </span>

                                        </div>

                                    @else

                                        <span class="not-rated">

                                            <i class="fa-regular fa-star"></i>

                                            Not rated

                                        </span>

                                    @endif

                                </td>


                                {{-- DETAILS --}}

                                <td>

                                    <a
                                        href="{{ route('student.sessions.show', $s) }}"
                                        class="details-btn"
                                    >

                                        View Details

                                        <i class="fa-solid fa-arrow-right"></i>

                                    </a>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            {{-- =========================================
                 PAGINATION
            ========================================== --}}

            @if($sessions->hasPages())

                <div class="pagination-area">

                    {{ $sessions->links() }}

                </div>

            @endif


        @else

            {{-- =========================================
                 EMPTY STATE
            ========================================== --}}

            <div class="empty-state">

                <div class="empty-icon">
                    <i class="fa-regular fa-circle-check"></i>
                </div>

                <div class="empty-title">
                    No Completed Sessions Yet
                </div>

                <p class="empty-description">
                    Your completed mentorship sessions will appear
                    here after you finish your first session with a
                    mentor. Start your journey by exploring available
                    mentors.
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


    {{-- =========================================
         INFORMATION BANNER
    ========================================== --}}

    <div class="info-banner">

        <div class="info-icon">
            <i class="fa-solid fa-lightbulb"></i>
        </div>

        <div>

            <div class="info-title">
                Keep learning from every session
            </div>

            <div class="info-text">
                Review your completed sessions and mentor feedback
                to identify your strengths, improve your skills and
                prepare better for your next mentorship session.
            </div>

        </div>

    </div>

</div>

@endsection
@extends('layouts.app')

@php($portal = 'student')

@section('title', 'Upcoming Sessions')

@section('content')

<style>
    :root {
        --mentor-primary: #3376F2;
        --mentor-primary-dark: #245ED1;
        --mentor-purple: #7C4DFF;
        --mentor-bg: #F7F9FF;
        --mentor-card: #FFFFFF;
        --mentor-text: #172033;
        --mentor-muted: #718096;
        --mentor-border: #E7EBF3;
        --mentor-green: #18A957;
        --mentor-shadow: 0 10px 35px rgba(40, 64, 120, .07);
    }

    /* =========================
       PAGE
    ========================= */

    .mentor-page {
        min-height: 100vh;
        background: var(--mentor-bg);
        padding: 10px 0 50px;
    }

    /* =========================
       HERO
    ========================= */

    .mentor-hero {
        position: relative;
        overflow: hidden;
        margin-bottom: 22px;
        padding: 35px 38px;
        border-radius: 22px;
        color: #fff;
        background: linear-gradient(
            120deg,
            #3376F2 0%,
            #526EF3 50%,
            #7C4DFF 100%
        );
        box-shadow: 0 16px 40px rgba(51, 118, 242, .18);
    }

    .mentor-hero::before {
        content: "";
        position: absolute;
        width: 300px;
        height: 300px;
        right: -100px;
        top: -170px;
        border-radius: 50%;
        background: rgba(255,255,255,.08);
    }

    .mentor-hero::after {
        content: "";
        position: absolute;
        width: 180px;
        height: 180px;
        left: 45%;
        bottom: -120px;
        border-radius: 50%;
        background: rgba(255,255,255,.06);
    }

    .mentor-hero-inner {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 30px;
    }

    .mentor-hero-content {
        max-width: 700px;
    }

    .mentor-label {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 7px 12px;
        margin-bottom: 13px;
        border: 1px solid rgba(255,255,255,.18);
        border-radius: 50px;
        background: rgba(255,255,255,.13);
        font-size: 11px;
        font-weight: 700;
    }

    .mentor-hero-title {
        margin: 0 0 9px;
        font-size: clamp(27px, 4vw, 38px);
        line-height: 1.15;
        font-weight: 800;
        letter-spacing: -.5px;
    }

    .mentor-hero-text {
        max-width: 610px;
        margin: 0;
        color: rgba(255,255,255,.83);
        font-size: 13px;
        line-height: 1.7;
    }

    .mentor-hero-icon {
        width: 100px;
        height: 100px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(255,255,255,.18);
        border-radius: 28px;
        background: rgba(255,255,255,.12);
        backdrop-filter: blur(10px);
        font-size: 40px;
    }

    /* =========================
       MAIN CARD
    ========================= */

    .mentor-container {
        background: var(--mentor-card);
        border: 1px solid var(--mentor-border);
        border-radius: 19px;
        box-shadow: var(--mentor-shadow);
        overflow: hidden;
    }

    .mentor-header {
        padding: 21px 23px;
        border-bottom: 1px solid var(--mentor-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .mentor-heading {
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .mentor-heading-icon {
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        background: #EEF4FF;
        color: var(--mentor-primary);
        font-size: 14px;
    }

    .mentor-heading-title {
        color: var(--mentor-text);
        font-size: 15px;
        font-weight: 800;
    }

    .mentor-heading-subtitle {
        margin-top: 3px;
        color: var(--mentor-muted);
        font-size: 10px;
    }

    /* =========================
       SEARCH
    ========================= */

    .mentor-search {
        padding: 18px 23px;
        background: #FCFDFF;
        border-bottom: 1px solid var(--mentor-border);
    }

    .mentor-search-form {
        position: relative;
        max-width: 440px;
    }

    .mentor-search-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #8A96AA;
        font-size: 12px;
        pointer-events: none;
    }

    .mentor-search-input {
        width: 100%;
        height: 42px;
        padding: 0 15px 0 38px;
        border: 1px solid #DDE4F0;
        border-radius: 10px;
        outline: none;
        background: #fff;
        color: var(--mentor-text);
        font-size: 11px;
        transition: .2s ease;
    }

    .mentor-search-input::placeholder {
        color: #9AA5B7;
    }

    .mentor-search-input:focus {
        border-color: var(--mentor-primary);
        box-shadow: 0 0 0 3px rgba(51,118,242,.08);
    }

    /* =========================
       MENTOR GRID
    ========================= */

    .mentor-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        padding: 23px;
    }

    .mentor-card {
        position: relative;
        padding: 19px;
        border: 1px solid var(--mentor-border);
        border-radius: 16px;
        background: #fff;
        box-shadow: 0 6px 22px rgba(40,64,120,.045);
        transition: .22s ease;
    }

    .mentor-card:hover {
        transform: translateY(-3px);
        border-color: #D8E3FA;
        box-shadow: 0 15px 35px rgba(40,64,120,.10);
    }

    /* =========================
       PROFILE
    ========================= */

    .mentor-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 17px;
    }

    .mentor-person {
        display: flex;
        align-items: center;
        gap: 11px;
        min-width: 0;
    }

    .mentor-avatar {
        width: 48px;
        height: 48px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border-radius: 13px;
        background: linear-gradient(
            135deg,
            #3376F2,
            #7C4DFF
        );
        color: #fff;
        font-size: 16px;
        font-weight: 800;
    }

    .mentor-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .mentor-name {
        max-width: 160px;
        overflow: hidden;
        color: var(--mentor-text);
        font-size: 13px;
        font-weight: 800;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .mentor-role {
        margin-top: 3px;
        max-width: 170px;
        overflow: hidden;
        color: var(--mentor-muted);
        font-size: 10px;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .mentor-available {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 8px;
        border-radius: 50px;
        background: #EAF9F0;
        color: #148548;
        font-size: 8px;
        font-weight: 800;
        white-space: nowrap;
    }

    .available-dot {
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: currentColor;
    }

    /* =========================
       META
    ========================= */

    .mentor-meta-list {
        display: flex;
        flex-direction: column;
        gap: 9px;
        margin-bottom: 17px;
    }

    .mentor-meta {
        display: flex;
        align-items: center;
        gap: 9px;
        min-width: 0;
        color: #59667A;
        font-size: 10px;
    }

    .mentor-meta-icon {
        width: 27px;
        height: 27px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        background: #F3F6FC;
        color: var(--mentor-primary);
        font-size: 10px;
    }

    .mentor-meta-text {
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    /* =========================
       EXPERTISE
    ========================= */

    .mentor-expertise {
        margin-bottom: 17px;
        padding: 10px 11px;
        border: 1px solid #E9EDFA;
        border-radius: 10px;
        background: linear-gradient(
            135deg,
            #F7F9FF,
            #FAF8FF
        );
    }

    .expertise-label {
        margin-bottom: 4px;
        color: #8994A8;
        font-size: 8px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .4px;
    }

    .expertise-value {
        color: #3B4659;
        font-size: 10px;
        font-weight: 700;
        line-height: 1.4;
    }

    /* =========================
       BUTTON
    ========================= */

    .mentor-profile-btn {
        width: 100%;
        min-height: 39px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        border: 0;
        border-radius: 9px;
        background: var(--mentor-primary);
        color: #fff !important;
        text-decoration: none;
        font-size: 10px;
        font-weight: 800;
        transition: .2s ease;
    }

    .mentor-profile-btn:hover {
        background: var(--mentor-primary-dark);
        color: #fff !important;
        transform: translateY(-1px);
    }

    .mentor-profile-btn i {
        font-size: 9px;
    }

    /* =========================
       PAGINATION
    ========================= */

    .mentor-pagination {
        padding: 0 23px 23px;
    }

    .mentor-pagination nav {
        display: flex;
        justify-content: center;
    }

    /* =========================
       EMPTY STATE
    ========================= */

    .mentor-empty {
        padding: 70px 25px;
        text-align: center;
    }

    .mentor-empty-icon {
        width: 70px;
        height: 70px;
        margin: 0 auto 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 20px;
        background: linear-gradient(
            135deg,
            #EEF4FF,
            #F1ECFF
        );
        color: var(--mentor-primary);
        font-size: 27px;
    }

    .mentor-empty-title {
        margin-bottom: 7px;
        color: var(--mentor-text);
        font-size: 17px;
        font-weight: 800;
    }

    .mentor-empty-text {
        max-width: 420px;
        margin: 0 auto;
        color: var(--mentor-muted);
        font-size: 11px;
        line-height: 1.7;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 1050px) {
        .mentor-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 750px) {

        .mentor-hero {
            padding: 28px 23px;
            border-radius: 17px;
        }

        .mentor-hero-inner {
            display: block;
        }

        .mentor-hero-icon {
            display: none;
        }

        .mentor-hero-title {
            font-size: 29px;
        }

        .mentor-header {
            align-items: flex-start;
        }
    }

    @media (max-width: 600px) {

        .mentor-grid {
            grid-template-columns: 1fr;
            padding: 16px;
        }

        .mentor-header {
            padding: 17px;
        }

        .mentor-search {
            padding: 15px 17px;
        }

        .mentor-pagination {
            padding: 0 16px 18px;
        }

        .mentor-card {
            padding: 17px;
        }
    }
</style>


<div class="mentor-page">

    {{-- =========================
         HERO
    ========================= --}}

    <section class="mentor-hero">

        <div class="mentor-hero-inner">

            <div class="mentor-hero-content">

                <div class="mentor-label">
                    <i class="fa-solid fa-user-group"></i>
                    Student Mentorship
                </div>

                <h1 class="mentor-hero-title">
                    Find Your Perfect Mentor
                </h1>

                <p class="mentor-hero-text">
                    Connect with experienced professionals who can guide
                    you with career growth, technical skills, projects,
                    interviews and your professional journey.
                </p>

            </div>

            <div class="mentor-hero-icon">
                <i class="fa-solid fa-user-group"></i>
            </div>

        </div>

    </section>


    {{-- =========================
         MAIN CONTAINER
    ========================= --}}

    <div class="mentor-container">

        {{-- HEADER --}}

        <div class="mentor-header">

            <div class="mentor-heading">

                <div class="mentor-heading-icon">
                    <i class="fa-solid fa-user-group"></i>
                </div>

                <div>

                    <div class="mentor-heading-title">
                        Select a Mentor
                    </div>

                    <div class="mentor-heading-subtitle">
                        Browse mentors by skill, experience and availability
                    </div>

                </div>

            </div>

        </div>


        {{-- =========================
             SEARCH
        ========================= --}}

        <div class="mentor-search">

            <form method="GET" class="mentor-search-form">

                <i class="fa-solid fa-magnifying-glass mentor-search-icon"></i>

                <input
                    type="text"
                    name="skill"
                    class="mentor-search-input"
                    placeholder="Search by skill, e.g. Laravel, React..."
                    value="{{ request('skill') }}"
                >

            </form>

        </div>


        {{-- =========================
             MENTORS
        ========================= --}}

        @if($mentors->count())

            <div class="mentor-grid">

                @foreach($mentors as $mentor)

                    <div class="mentor-card">

                        {{-- PROFILE TOP --}}

                        <div class="mentor-top">

                            <div class="mentor-person">

                                <div class="mentor-avatar">

                                    @if($mentor->mentorRegistration->profile_photo ?? null)

                                        <img
                                            src="{{ asset('storage/' . $mentor->mentorRegistration->profile_photo) }}"
                                            alt="{{ $mentor->name }}"
                                        >

                                    @else

                                        {{ strtoupper(substr($mentor->name, 0, 1)) }}

                                    @endif

                                </div>

                                <div>

                                    <div class="mentor-name">
                                        {{ $mentor->name }}
                                    </div>

                                    <div class="mentor-role">
                                        {{ $mentor->mentorRegistration->designation ?? 'Mentor' }}
                                    </div>

                                </div>

                            </div>

                            <span class="mentor-available">
                                <span class="available-dot"></span>
                                Available
                            </span>

                        </div>


                        {{-- META --}}

                        <div class="mentor-meta-list">

                            <div class="mentor-meta">

                                <div class="mentor-meta-icon">
                                    <i class="fa-solid fa-briefcase"></i>
                                </div>

                                <div class="mentor-meta-text">
                                    {{ $mentor->mentorRegistration->company ?? 'Independent Mentor' }}
                                </div>

                            </div>


                            <div class="mentor-meta">

                                <div class="mentor-meta-icon">
                                    <i class="fa-solid fa-clock"></i>
                                </div>

                                <div class="mentor-meta-text">
                                    {{ $mentor->mentorRegistration->years_of_experience ?? 0 }}
                                    years experience
                                </div>

                            </div>


                            <div class="mentor-meta">

                                <div class="mentor-meta-icon">
                                    <i class="fa-solid fa-user-graduate"></i>
                                </div>

                                <div class="mentor-meta-text">
                                    {{ $mentor->active_mentees_count ?? 0 }}
                                    active mentees
                                </div>

                            </div>

                        </div>


                        {{-- EXPERTISE --}}

                        <div class="mentor-expertise">

                            <div class="expertise-label">
                                Expertise
                            </div>

                            <div class="expertise-value">

                                {{ $mentor->mentorRegistration->expertise ?? 'General guidance' }}

                            </div>

                        </div>


                        {{-- PROFILE BUTTON --}}

                        <a
                            href="{{ route('student.mentors.show', $mentor) }}"
                            class="mentor-profile-btn"
                        >

                            View Mentor Profile

                            <i class="fa-solid fa-arrow-right"></i>

                        </a>

                    </div>

                @endforeach

            </div>


            {{-- PAGINATION --}}

            @if($mentors->hasPages())

                <div class="mentor-pagination">
                    {{ $mentors->links() }}
                </div>

            @endif


        @else

            {{-- EMPTY STATE --}}

            <div class="mentor-empty">

                <div class="mentor-empty-icon">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>

                <div class="mentor-empty-title">
                    No Mentors Found
                </div>

                <p class="mentor-empty-text">
                    We couldn't find any mentors matching your search.
                    Try another skill or remove the search filter to
                    explore all available mentors.
                </p>

            </div>

        @endif

    </div>

</div>

@endsection
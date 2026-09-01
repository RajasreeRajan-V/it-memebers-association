@extends('layouts.app')

@php($portal = 'student')

@section('title', 'Find a Mentor')

@section('content')

<style>
    :root {
        --mentor-primary: #3376F2;
        --mentor-primary-dark: #245ED1;
        --mentor-purple: #7C4DFF;
        --mentor-bg: #F6F8FC;
        --mentor-card: #FFFFFF;
        --mentor-text: #172033;
        --mentor-muted: #6B7280;
        --mentor-border: #E6EAF0;
        --mentor-success: #16A34A;
        --mentor-shadow: 0 8px 28px rgba(31, 41, 55, 0.07);
    }

    /* =========================
       PAGE
    ========================= */

    .mentor-page {
        min-height: 100vh;
        background: var(--mentor-bg);
        padding: 34px 0 60px;
    }

    .mentor-page-container {
        width: min(1320px, calc(100% - 40px));
        margin: 0 auto;
    }

    /* =========================
       HERO (light, matches events/webinars page)
    ========================= */

    .mentor-hero {
        background: #FFFFFF;
        border: 1px solid var(--mentor-border);
        border-radius: 24px;
        padding: 44px 46px;
        position: relative;
        overflow: hidden;
        margin-bottom: 28px;
        box-shadow: var(--mentor-shadow);
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
        color: var(--mentor-primary);
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
        color: var(--mentor-text);
    }

    .hero-title span {
        display: block;
        background: linear-gradient(90deg, var(--mentor-primary), var(--mentor-purple));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    .hero-text {
        margin: 0 0 26px;
        font-size: 15px;
        line-height: 1.75;
        color: var(--mentor-muted);
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
        background: var(--mentor-primary);
        color: #fff;
        box-shadow: 0 10px 22px rgba(51,118,242,0.24);
    }

    .hero-btn-primary:hover {
        background: var(--mentor-primary-dark);
        color: #fff;
        transform: translateY(-1px);
    }

    .hero-btn-outline {
        background: #fff;
        color: var(--mentor-text);
        border-color: #DDE3EC;
    }

    .hero-btn-outline:hover {
        border-color: var(--mentor-primary);
        color: var(--mentor-primary);
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
        background: var(--mentor-primary);
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
        color: var(--mentor-success);
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

    .hero-feature-icon.icon-blue { background: #EAF1FF; color: var(--mentor-primary); }
    .hero-feature-icon.icon-purple { background: #F3EEFF; color: var(--mentor-purple); }
    .hero-feature-icon.icon-green { background: #E9FBF0; color: var(--mentor-success); }

    .hero-feature-title {
        font-size: 13.5px;
        font-weight: 700;
        color: var(--mentor-text);
        margin-bottom: 2px;
    }

    .hero-feature-text {
        font-size: 12px;
        color: var(--mentor-muted);
        line-height: 1.5;
    }

    /* =========================
       MAIN CARD
    ========================= */

    .mentor-container {
        background: var(--mentor-card);
        border: 1px solid var(--mentor-border);
        border-radius: 20px;
        box-shadow: var(--mentor-shadow);
        overflow: hidden;
    }

    .mentor-header {
        padding: 22px;
        border-bottom: 1px solid var(--mentor-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .mentor-heading {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .mentor-heading-icon {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: #EEF4FF;
        color: var(--mentor-primary);
        font-size: 15px;
        flex-shrink: 0;
    }

    .mentor-heading-title {
        color: var(--mentor-text);
        font-size: 16px;
        font-weight: 700;
    }

    .mentor-heading-subtitle {
        margin-top: 3px;
        color: var(--mentor-muted);
        font-size: 12px;
    }

    /* =========================
       SEARCH
    ========================= */

    .mentor-search {
        padding: 18px 22px;
        background: #FAFBFE;
        border-bottom: 1px solid var(--mentor-border);
    }

    .mentor-search-form {
        position: relative;
        max-width: 440px;
    }

    .mentor-search-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #8A96AA;
        font-size: 13px;
        pointer-events: none;
    }

    .mentor-search-input {
        width: 100%;
        height: 44px;
        padding: 0 15px 0 40px;
        border: 1px solid #DDE3EC;
        border-radius: 11px;
        outline: none;
        background: #fff;
        color: var(--mentor-text);
        font-size: 13px;
        transition: .2s ease;
    }

    .mentor-search-input::placeholder {
        color: #9AA5B7;
    }

    .mentor-search-input:focus {
        border-color: var(--mentor-primary);
        box-shadow: 0 0 0 3px rgba(51,118,242,.10);
    }

    /* =========================
       MENTOR GRID
    ========================= */

    .mentor-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
        padding: 22px;
    }

    .mentor-card {
        position: relative;
        padding: 20px;
        border: 1px solid var(--mentor-border);
        border-radius: 18px;
        background: #fff;
        box-shadow: var(--mentor-shadow);
        transition: .22s ease;
    }

    .mentor-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 15px 36px rgba(31,41,55,0.11);
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
        background: linear-gradient(135deg, #3376F2, #7C4DFF);
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
        font-size: 14px;
        font-weight: 700;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .mentor-role {
        margin-top: 3px;
        max-width: 170px;
        overflow: hidden;
        color: var(--mentor-muted);
        font-size: 11px;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .mentor-available {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 9px;
        border-radius: 999px;
        background: #ECFDF3;
        color: var(--mentor-success);
        border: 1px solid #CFF5DC;
        font-size: 9px;
        font-weight: 700;
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
        font-size: 11px;
    }

    .mentor-meta-icon {
        width: 28px;
        height: 28px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        background: #F4F6FA;
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
        padding: 11px 12px;
        border: 1px solid var(--mentor-border);
        border-radius: 11px;
        background: #F6F8FC;
    }

    .expertise-label {
        margin-bottom: 4px;
        color: #8994A8;
        font-size: 9px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .4px;
    }

    .expertise-value {
        color: #3B4659;
        font-size: 11px;
        font-weight: 700;
        line-height: 1.4;
    }

    /* =========================
       BUTTON
    ========================= */

    .mentor-profile-btn {
        width: 100%;
        min-height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        border: 0;
        border-radius: 10px;
        background: var(--mentor-primary);
        color: #fff !important;
        text-decoration: none;
        font-size: 12px;
        font-weight: 700;
        transition: .2s ease;
    }

    .mentor-profile-btn:hover {
        background: var(--mentor-primary-dark);
        color: #fff !important;
        transform: translateY(-1px);
    }

    .mentor-profile-btn i {
        font-size: 10px;
    }

    /* =========================
       PAGINATION
    ========================= */

    .mentor-pagination {
        padding: 0 22px 22px;
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
        background: #EEF4FF;
        color: var(--mentor-primary);
        font-size: 28px;
    }

    .mentor-empty-title {
        margin-bottom: 7px;
        color: var(--mentor-text);
        font-size: 18px;
        font-weight: 700;
    }

    .mentor-empty-text {
        max-width: 420px;
        margin: 0 auto;
        color: var(--mentor-muted);
        font-size: 13px;
        line-height: 1.7;
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

    @media (max-width: 1050px) {
        .mentor-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {

        .mentor-page-container {
            width: min(100% - 24px, 1320px);
        }

        .mentor-page {
            padding: 20px 0 40px;
        }

        .mentor-hero {
            padding: 28px 24px;
            border-radius: 19px;
        }

        .hero-title {
            font-size: 27px;
        }

        .hero-features {
            width: 100%;
        }

        .mentor-header {
            align-items: flex-start;
            flex-direction: column;
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

    @media (max-width: 500px) {

        .hero-visual {
            display: none;
        }
    }
</style>


<div class="mentor-page">

    <div class="mentor-page-container">

        {{-- =====================================================
             HERO
        ====================================================== --}}
        <div class="mentor-hero">

            <div class="hero-grid">

                {{-- LEFT: copy + actions --}}
                <div class="hero-left">

                    <div class="hero-badge">
                        <i class="fa-solid fa-user-group"></i>
                        Student Mentorship
                    </div>

                    <h1 class="hero-title">
                        Find Your Perfect
                        <span>Mentor</span>
                    </h1>

                    <p class="hero-text">
                        Connect with experienced professionals who can guide
                        you with career growth, technical skills, projects,
                        interviews and your professional journey.
                    </p>

                    <div class="hero-actions">

                        <a href="#mentors" class="hero-btn hero-btn-primary">
                            <i class="fa-solid fa-user-group"></i>
                            Browse Mentors
                        </a>

                        @if (Route::has('student.sessions.upcoming'))
                            <a href="{{ route('student.sessions.upcoming') }}" class="hero-btn hero-btn-outline">
                                <i class="fa-regular fa-calendar-check"></i>
                                My Sessions
                            </a>
                        @endif

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
                        <i class="fa-solid fa-user-group"></i>
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
                            <div class="hero-feature-title">Verified Mentors</div>
                            <div class="hero-feature-text">Experienced, screened professionals</div>
                        </div>
                    </div>

                    <div class="hero-feature-item">
                        <div class="hero-feature-icon icon-purple">
                            <i class="fa-regular fa-comments"></i>
                        </div>
                        <div>
                            <div class="hero-feature-title">Personal Guidance</div>
                            <div class="hero-feature-text">1:1 support tailored to your goals</div>
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
             MAIN CONTAINER
        ====================================================== --}}
        <div class="mentor-container" id="mentors">

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

</div>

@endsection
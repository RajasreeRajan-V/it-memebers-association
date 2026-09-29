@extends('layouts.app')

@section('title', 'My Webinars')

@section('content')

{{-- =========================================================
     SUCCESS MESSAGE
========================================================= --}}
@if(session('success'))
    <div class="webinar-alert-wrap">
        <div class="webinar-alert">
            <div class="webinar-alert-icon">
                <i class="fas fa-check"></i>
            </div>

            <div class="webinar-alert-content">
                <strong>Registration Successful</strong>
                <span>{{ session('success') }}</span>
            </div>

            <button type="button"
                    class="webinar-alert-close"
                    onclick="this.parentElement.remove()"
                    aria-label="Close">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
@endif


<div class="my-webinars-page">

    <div class="webinar-container">

        {{-- =================================================
             PAGE HEADER
        ================================================== --}}
        <div class="webinar-header">

            <div class="webinar-header-content">

                <div class="webinar-breadcrumb">
                    <a href="{{ url()->previous() }}">
                        <i class="fas fa-arrow-left"></i>
                        Back
                    </a>

                    <span>/</span>

                    <span>My Webinars</span>
                </div>

                <div class="webinar-title-row">

                    <div class="webinar-title-icon">
                        <i class="fas fa-video"></i>
                    </div>

                    <div>
                        <h1>My Webinars</h1>

                        <p>
                            Manage your registered webinars and keep track of your
                            upcoming and completed sessions.
                        </p>
                    </div>

                </div>

            </div>


            {{-- Header Illustration --}}
            <div class="webinar-header-decoration">

                <div class="decoration-circle circle-one"></div>
                <div class="decoration-circle circle-two"></div>

                <div class="video-decoration-card">

                    <div class="video-decoration-icon">
                        <i class="fas fa-play"></i>
                    </div>

                    <div>
                        <strong>Learning Sessions</strong>
                        <span>Stay connected & learn</span>
                    </div>

                </div>

                <div class="floating-icon icon-one">
                    <i class="fas fa-calendar-check"></i>
                </div>

                <div class="floating-icon icon-two">
                    <i class="fas fa-graduation-cap"></i>
                </div>

                <div class="floating-icon icon-three">
                    <i class="fas fa-comments"></i>
                </div>

            </div>

        </div>


        {{-- =================================================
             QUICK STATS
        ================================================== --}}
        <div class="webinar-stats">

            <div class="webinar-stat-card">

                <div class="webinar-stat-icon upcoming">
                    <i class="fas fa-calendar-alt"></i>
                </div>

                <div class="webinar-stat-content">
                    <span>Upcoming</span>
                    <strong>{{ $upcoming->count() }}</strong>
                </div>

            </div>


            <div class="webinar-stat-card">

                <div class="webinar-stat-icon completed">
                    <i class="fas fa-check-circle"></i>
                </div>

                <div class="webinar-stat-content">
                    <span>Completed</span>
                    <strong>{{ $completed->count() }}</strong>
                </div>

            </div>


            <div class="webinar-stat-card">

                <div class="webinar-stat-icon total">
                    <i class="fas fa-video"></i>
                </div>

                <div class="webinar-stat-content">
                    <span>Total Webinars</span>
                    <strong>{{ $upcoming->count() + $completed->count() }}</strong>
                </div>

            </div>

        </div>


        {{-- =================================================
             TABS
        ================================================== --}}
        <div class="webinar-tabs-wrapper">

            <div class="webinar-tabs">

                <button
                    type="button"
                    class="tab-btn active"
                    data-tab="upcoming"
                    onclick="showTab('upcoming')">

                    <span class="tab-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </span>

                    <span>Upcoming</span>

                    <span class="tab-count">
                        {{ $upcoming->count() }}
                    </span>

                </button>


                <button
                    type="button"
                    class="tab-btn"
                    data-tab="completed"
                    onclick="showTab('completed')">

                    <span class="tab-icon">
                        <i class="fas fa-check-circle"></i>
                    </span>

                    <span>Completed</span>

                    <span class="tab-count">
                        {{ $completed->count() }}
                    </span>

                </button>

            </div>

        </div>


        {{-- =================================================
             UPCOMING WEBINARS
        ================================================== --}}
        <div id="tab-upcoming" class="tab-panel active-panel">

            <div class="section-heading">

                <div>
                    <h2>Upcoming Webinars</h2>

                    <p>
                        Your registered webinars that are coming up.
                    </p>
                </div>

                @if($upcoming->count() > 0)
                    <div class="section-result-count">
                        {{ $upcoming->count() }}
                        {{ $upcoming->count() === 1 ? 'Webinar' : 'Webinars' }}
                    </div>
                @endif

            </div>


            @if($upcoming->count() > 0)

                <div class="webinar-list">

                    @foreach($upcoming as $reg)

                        <div class="webinar-card-wrapper">

                            @include(
                                'students.webinars._my-card',
                                [
                                    'reg' => $reg,
                                    'isPast' => false
                                ]
                            )

                        </div>

                    @endforeach

                </div>

            @else

                <div class="webinar-empty-state">

                    <div class="empty-illustration">

                        <div class="empty-circle"></div>

                        <div class="empty-icon">
                            <i class="fas fa-calendar-plus"></i>
                        </div>

                        <span class="empty-dot dot-one"></span>
                        <span class="empty-dot dot-two"></span>
                        <span class="empty-dot dot-three"></span>

                    </div>

                    <h3>No Upcoming Webinars</h3>

                    <p>
                        You don't have any upcoming webinar registrations yet.
                        Register for a webinar to start learning and connecting.
                    </p>

                    <a href="{{ url()->previous() }}" class="empty-action">
                        <i class="fas fa-search"></i>
                        Explore Webinars
                    </a>

                </div>

            @endif

        </div>


        {{-- =================================================
             COMPLETED WEBINARS
        ================================================== --}}
        <div
            id="tab-completed"
            class="tab-panel"
            style="display:none;">

            <div class="section-heading">

                <div>
                    <h2>Completed Webinars</h2>

                    <p>
                        Webinars you have already attended or completed.
                    </p>
                </div>

                @if($completed->count() > 0)
                    <div class="section-result-count completed-count">
                        {{ $completed->count() }}
                        {{ $completed->count() === 1 ? 'Webinar' : 'Webinars' }}
                    </div>
                @endif

            </div>


            @if($completed->count() > 0)

                <div class="webinar-list">

                    @foreach($completed as $reg)

                        <div class="webinar-card-wrapper completed-card-wrapper">

                            @include(
                                'students.webinars._my-card',
                                [
                                    'reg' => $reg,
                                    'isPast' => true
                                ]
                            )

                        </div>

                    @endforeach

                </div>

            @else

                <div class="webinar-empty-state">

                    <div class="empty-illustration completed-illustration">

                        <div class="empty-circle"></div>

                        <div class="empty-icon">
                            <i class="fas fa-history"></i>
                        </div>

                        <span class="empty-dot dot-one"></span>
                        <span class="empty-dot dot-two"></span>
                        <span class="empty-dot dot-three"></span>

                    </div>

                    <h3>No Completed Webinars</h3>

                    <p>
                        Once you attend and complete webinars, they will appear
                        here for easy access to your learning history.
                    </p>

                    <button
                        type="button"
                        class="empty-action secondary-action"
                        onclick="showTab('upcoming')">

                        <i class="fas fa-calendar-alt"></i>
                        View Upcoming

                    </button>

                </div>

            @endif

        </div>

    </div>

</div>


<style>

/* =========================================================
   ROOT
========================================================= */

.my-webinars-page {
    --web-primary: #3376F2;
    --web-primary-dark: #245FD0;
    --web-secondary: #6C63E8;
    --web-text: #17213A;
    --web-muted: #718096;
    --web-border: #E6EBF3;
    --web-bg: #F7F9FD;
    --web-white: #FFFFFF;
    --web-green: #20B486;
    --web-light-blue: #EEF4FF;
    --web-light-purple: #F2F0FF;

    min-height: calc(100vh - 80px);
    background: var(--web-bg);
    padding: 38px 0 70px;
}


/* =========================================================
   CONTAINER
========================================================= */

.webinar-container {
    width: min(1180px, calc(100% - 40px));
    margin: 0 auto;
}


/* =========================================================
   HEADER
========================================================= */

.webinar-header {
    position: relative;
    min-height: 235px;
    overflow: hidden;

    display: flex;
    align-items: center;
    justify-content: space-between;

    padding: 34px 42px;

    border: 1px solid rgba(51,118,242,.10);
    border-radius: 24px;

    background:
        radial-gradient(
            circle at 82% 30%,
            rgba(108,99,232,.14),
            transparent 34%
        ),
        radial-gradient(
            circle at 100% 100%,
            rgba(51,118,242,.10),
            transparent 40%
        ),
        #ffffff;

    box-shadow:
        0 12px 35px rgba(31,55,100,.06);

    margin-bottom: 20px;
}


.webinar-header-content {
    position: relative;
    z-index: 5;
    max-width: 650px;
}


/* =========================================================
   BREADCRUMB
========================================================= */

.webinar-breadcrumb {
    display: flex;
    align-items: center;
    gap: 9px;

    margin-bottom: 17px;

    font-size: 13px;
    font-weight: 600;
    color: var(--web-muted);
}


.webinar-breadcrumb a {
    display: inline-flex;
    align-items: center;
    gap: 7px;

    color: var(--web-primary);
    text-decoration: none;

    transition: .2s ease;
}


.webinar-breadcrumb a:hover {
    color: var(--web-primary-dark);
}


.webinar-breadcrumb i {
    font-size: 11px;
}


/* =========================================================
   TITLE
========================================================= */

.webinar-title-row {
    display: flex;
    align-items: flex-start;
    gap: 17px;
}


.webinar-title-icon {
    width: 52px;
    height: 52px;

    flex: 0 0 52px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 15px;

    background: linear-gradient(
        135deg,
        #3376F2,
        #6C63E8
    );

    color: #fff;

    font-size: 21px;

    box-shadow:
        0 9px 20px rgba(51,118,242,.20);
}


.webinar-header h1 {
    margin: 0 0 7px;

    color: var(--web-text);

    font-family: var(--font-display, inherit);

    font-size: 34px;
    line-height: 1.15;
    font-weight: 750;
    letter-spacing: -.7px;
}


.webinar-header p {
    margin: 0;

    max-width: 610px;

    color: var(--web-muted);

    font-size: 15px;
    line-height: 1.7;
}


/* =========================================================
   HEADER DECORATION
========================================================= */

.webinar-header-decoration {
    position: absolute;

    right: 35px;
    top: 0;

    width: 390px;
    height: 100%;

    pointer-events: none;
}


.decoration-circle {
    position: absolute;

    border-radius: 50%;
}


.circle-one {
    width: 210px;
    height: 210px;

    right: 40px;
    top: 18px;

    background: rgba(51,118,242,.055);

    border: 1px solid rgba(51,118,242,.08);
}


.circle-two {
    width: 130px;
    height: 130px;

    right: 145px;
    bottom: -50px;

    background: rgba(108,99,232,.07);
}


/* =========================================================
   DECORATION CARD
========================================================= */

.video-decoration-card {
    position: absolute;

    right: 70px;
    top: 69px;

    width: 205px;

    display: flex;
    align-items: center;
    gap: 13px;

    padding: 14px;

    border-radius: 14px;

    background: rgba(255,255,255,.94);

    border: 1px solid rgba(51,118,242,.10);

    box-shadow:
        0 12px 30px rgba(30,60,110,.10);
}


.video-decoration-icon {
    width: 43px;
    height: 43px;

    display: flex;
    align-items: center;
    justify-content: center;

    flex: 0 0 43px;

    border-radius: 12px;

    background: var(--web-light-blue);

    color: var(--web-primary);

    font-size: 15px;
}


.video-decoration-card strong {
    display: block;

    color: var(--web-text);

    font-size: 12px;
    font-weight: 700;

    margin-bottom: 3px;
}


.video-decoration-card span {
    display: block;

    color: var(--web-muted);

    font-size: 10px;
}


/* =========================================================
   FLOATING ICONS
========================================================= */

.floating-icon {
    position: absolute;

    width: 39px;
    height: 39px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 12px;

    background: #fff;

    color: var(--web-primary);

    border: 1px solid var(--web-border);

    box-shadow:
        0 8px 20px rgba(30,60,110,.08);

    font-size: 14px;
}


.icon-one {
    top: 38px;
    right: 25px;

    color: var(--web-green);
}


.icon-two {
    bottom: 40px;
    right: 83px;

    color: var(--web-secondary);
}


.icon-three {
    top: 124px;
    right: 5px;

    color: #F39A35;
}


/* =========================================================
   STATS
========================================================= */

.webinar-stats {
    display: grid;

    grid-template-columns:
        repeat(3, minmax(0, 1fr));

    gap: 16px;

    margin-bottom: 24px;
}


.webinar-stat-card {
    display: flex;
    align-items: center;
    gap: 14px;

    min-height: 86px;

    padding: 16px 19px;

    background: #fff;

    border: 1px solid var(--web-border);

    border-radius: 15px;

    box-shadow:
        0 6px 20px rgba(30,60,110,.035);

    transition:
        transform .2s ease,
        box-shadow .2s ease;
}


.webinar-stat-card:hover {
    transform: translateY(-2px);

    box-shadow:
        0 10px 26px rgba(30,60,110,.075);
}


.webinar-stat-icon {
    width: 48px;
    height: 48px;

    flex: 0 0 48px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 13px;

    font-size: 17px;
}


.webinar-stat-icon.upcoming {
    color: var(--web-primary);
    background: var(--web-light-blue);
}


.webinar-stat-icon.completed {
    color: var(--web-green);
    background: #ECFDF5;
}


.webinar-stat-icon.total {
    color: var(--web-secondary);
    background: var(--web-light-purple);
}


.webinar-stat-content span {
    display: block;

    margin-bottom: 3px;

    color: var(--web-muted);

    font-size: 12px;
    font-weight: 600;
}


.webinar-stat-content strong {
    display: block;

    color: var(--web-text);

    font-size: 22px;
    line-height: 1.1;
    font-weight: 750;
}


/* =========================================================
   TABS WRAPPER
========================================================= */

.webinar-tabs-wrapper {
    display: flex;
    justify-content: space-between;
    align-items: center;

    margin-bottom: 24px;
}


.webinar-tabs {
    display: inline-flex;
    align-items: center;
    gap: 5px;

    padding: 5px;

    background: #fff;

    border: 1px solid var(--web-border);

    border-radius: 13px;

    box-shadow:
        0 5px 18px rgba(30,60,110,.035);
}


.tab-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 9px;

    min-height: 43px;

    padding: 8px 15px;

    border: 0;
    border-radius: 9px;

    background: transparent;

    color: var(--web-muted);

    font-family: inherit;

    font-size: 13px;
    font-weight: 650;

    cursor: pointer;

    transition:
        background .2s ease,
        color .2s ease,
        box-shadow .2s ease;
}


.tab-btn:hover {
    color: var(--web-primary);
    background: #f7f9ff;
}


.tab-btn.active {
    color: #fff;

    background: linear-gradient(
        135deg,
        var(--web-primary),
        var(--web-secondary)
    );

    box-shadow:
        0 6px 15px rgba(51,118,242,.20);
}


.tab-icon {
    font-size: 12px;
}


.tab-count {
    min-width: 23px;
    height: 22px;

    padding: 2px 6px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    border-radius: 7px;

    background: #F1F4F9;

    color: var(--web-muted);

    font-size: 11px;
    font-weight: 700;
}


.tab-btn.active .tab-count {
    background: rgba(255,255,255,.20);
    color: #fff;
}


/* =========================================================
   SECTION HEADING
========================================================= */

.section-heading {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;

    margin-bottom: 16px;
}


.section-heading h2 {
    margin: 0 0 4px;

    color: var(--web-text);

    font-size: 20px;
    font-weight: 750;

    letter-spacing: -.2px;
}


.section-heading p {
    margin: 0;

    color: var(--web-muted);

    font-size: 13px;
}


.section-result-count {
    padding: 7px 11px;

    border-radius: 8px;

    background: var(--web-light-blue);

    color: var(--web-primary);

    font-size: 11px;
    font-weight: 700;
}


.section-result-count.completed-count {
    background: #ECFDF5;
    color: var(--web-green);
}


/* =========================================================
   WEBINAR LIST
========================================================= */

.webinar-list {
    display: flex;
    flex-direction: column;
    gap: 16px;
}


.webinar-card-wrapper {
    position: relative;

    transition:
        transform .2s ease;
}


.webinar-card-wrapper:hover {
    transform: translateY(-2px);
}


/* =========================================================
   EMPTY STATE
========================================================= */

.webinar-empty-state {
    position: relative;

    overflow: hidden;

    padding: 58px 30px;

    text-align: center;

    background: #fff;

    border: 1px solid var(--web-border);

    border-radius: 18px;

    box-shadow:
        0 8px 25px rgba(30,60,110,.035);
}


.webinar-empty-state::before {
    content: "";

    position: absolute;

    width: 220px;
    height: 220px;

    left: -100px;
    top: -110px;

    border-radius: 50%;

    background: rgba(51,118,242,.035);
}


.webinar-empty-state::after {
    content: "";

    position: absolute;

    width: 180px;
    height: 180px;

    right: -90px;
    bottom: -100px;

    border-radius: 50%;

    background: rgba(108,99,232,.04);
}


.empty-illustration {
    position: relative;

    width: 86px;
    height: 86px;

    margin: 0 auto 20px;
}


.empty-circle {
    position: absolute;

    inset: 0;

    border-radius: 50%;

    background: var(--web-light-blue);

    border: 1px solid rgba(51,118,242,.08);
}


.completed-illustration .empty-circle {
    background: #ECFDF5;
}


.empty-icon {
    position: absolute;

    width: 52px;
    height: 52px;

    left: 17px;
    top: 17px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 15px;

    background: #fff;

    color: var(--web-primary);

    box-shadow:
        0 7px 18px rgba(51,118,242,.10);

    font-size: 21px;
}


.completed-illustration .empty-icon {
    color: var(--web-green);
}


.empty-dot {
    position: absolute;

    width: 7px;
    height: 7px;

    border-radius: 50%;

    background: var(--web-primary);
}


.dot-one {
    top: 7px;
    right: 7px;
}


.dot-two {
    left: 3px;
    bottom: 18px;

    background: var(--web-secondary);
}


.dot-three {
    right: 4px;
    bottom: 8px;

    background: var(--web-green);
}


.webinar-empty-state h3 {
    position: relative;
    z-index: 2;

    margin: 0 0 8px;

    color: var(--web-text);

    font-size: 19px;
    font-weight: 750;
}


.webinar-empty-state p {
    position: relative;
    z-index: 2;

    max-width: 520px;

    margin: 0 auto 22px;

    color: var(--web-muted);

    font-size: 13px;
    line-height: 1.7;
}


.empty-action {
    position: relative;
    z-index: 3;

    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;

    padding: 10px 17px;

    border: 0;
    border-radius: 9px;

    background: var(--web-primary);

    color: #fff;

    font-size: 12px;
    font-weight: 700;

    text-decoration: none;

    cursor: pointer;

    box-shadow:
        0 7px 16px rgba(51,118,242,.18);

    transition:
        transform .2s ease,
        background .2s ease;
}


.empty-action:hover {
    color: #fff;

    background: var(--web-primary-dark);

    transform: translateY(-1px);
}


.secondary-action {
    background: #fff;

    color: var(--web-primary);

    border: 1px solid rgba(51,118,242,.18);

    box-shadow: none;
}


.secondary-action:hover {
    background: var(--web-light-blue);
    color: var(--web-primary-dark);
}


/* =========================================================
   SUCCESS ALERT
========================================================= */

.webinar-alert-wrap {
    width: min(1180px, calc(100% - 40px));

    margin: 25px auto 0;
}


.webinar-alert {
    display: flex;
    align-items: center;
    gap: 13px;

    padding: 13px 15px;

    border: 1px solid #A7F3D0;

    border-radius: 13px;

    background: #F0FDF7;

    box-shadow:
        0 6px 18px rgba(16,185,129,.06);
}


.webinar-alert-icon {
    width: 36px;
    height: 36px;

    flex: 0 0 36px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 10px;

    background: #D1FAE5;

    color: #059669;

    font-size: 13px;
}


.webinar-alert-content {
    min-width: 0;
    flex: 1;
}


.webinar-alert-content strong {
    display: block;

    margin-bottom: 2px;

    color: #065F46;

    font-size: 12px;
    font-weight: 750;
}


.webinar-alert-content span {
    display: block;

    color: #047857;

    font-size: 12px;
    line-height: 1.5;
}


.webinar-alert-close {
    width: 30px;
    height: 30px;

    display: flex;
    align-items: center;
    justify-content: center;

    border: 0;
    border-radius: 8px;

    background: transparent;

    color: #6B7280;

    cursor: pointer;

    transition: .2s ease;
}


.webinar-alert-close:hover {
    background: #D1FAE5;
    color: #047857;
}


/* =========================================================
   TAB ANIMATION
========================================================= */

.tab-panel {
    animation: webinarFade .25s ease;
}


@keyframes webinarFade {

    from {
        opacity: 0;
        transform: translateY(5px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }

}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 900px) {

    .webinar-header {
        padding: 30px;
    }

    .webinar-header-decoration {
        opacity: .35;
        right: -20px;
    }

    .webinar-header-content {
        max-width: 75%;
    }

    .webinar-stats {
        gap: 12px;
    }

}


@media (max-width: 700px) {

    .my-webinars-page {
        padding: 25px 0 50px;
    }

    .webinar-container {
        width: min(100% - 24px, 1180px);
    }

    .webinar-header {
        min-height: auto;

        padding: 25px 22px;

        border-radius: 18px;
    }

    .webinar-header-content {
        max-width: 100%;
    }

    .webinar-header-decoration {
        display: none;
    }

    .webinar-title-icon {
        width: 45px;
        height: 45px;
        flex-basis: 45px;

        border-radius: 12px;

        font-size: 18px;
    }

    .webinar-header h1 {
        font-size: 27px;
    }

    .webinar-header p {
        font-size: 13px;
    }

    .webinar-stats {
        grid-template-columns: 1fr;
    }

    .webinar-stat-card {
        min-height: 74px;
    }

    .webinar-tabs-wrapper {
        margin-bottom: 20px;
    }

    .webinar-tabs {
        width: 100%;
    }

    .tab-btn {
        flex: 1;

        padding-left: 8px;
        padding-right: 8px;
    }

    .section-heading {
        align-items: flex-start;
        gap: 10px;
    }

    .section-heading h2 {
        font-size: 18px;
    }

    .section-heading p {
        font-size: 12px;
    }

}


@media (max-width: 480px) {

    .webinar-title-row {
        gap: 12px;
    }

    .webinar-title-icon {
        width: 40px;
        height: 40px;
        flex-basis: 40px;

        font-size: 16px;
    }

    .webinar-header h1 {
        font-size: 24px;
    }

    .webinar-breadcrumb {
        font-size: 11px;
    }

    .tab-btn {
        gap: 5px;

        font-size: 11px;
    }

    .tab-icon {
        display: none;
    }

    .tab-count {
        min-width: 20px;
        height: 20px;

        font-size: 10px;
    }

    .webinar-empty-state {
        padding: 45px 20px;
    }

    .webinar-empty-state h3 {
        font-size: 17px;
    }

    .webinar-empty-state p {
        font-size: 12px;
    }

    .section-result-count {
        display: none;
    }

}

</style>


<script>

function showTab(tab) {

    /*
     * Hide all panels
     */
    document.querySelectorAll('.tab-panel').forEach(function(panel) {

        panel.style.display = 'none';
        panel.classList.remove('active-panel');

    });


    /*
     * Remove active state from all buttons
     */
    document.querySelectorAll('.tab-btn').forEach(function(button) {

        button.classList.remove('active');

    });


    /*
     * Show selected panel
     */
    var selectedPanel = document.getElementById('tab-' + tab);

    if (selectedPanel) {

        selectedPanel.style.display = 'block';

        /*
         * Restart animation
         */
        selectedPanel.style.animation = 'none';

        requestAnimationFrame(function() {

            selectedPanel.style.animation = '';

        });

        selectedPanel.classList.add('active-panel');

    }


    /*
     * Activate selected button
     */
    var selectedButton = document.querySelector(
        '.tab-btn[data-tab="' + tab + '"]'
    );

    if (selectedButton) {

        selectedButton.classList.add('active');

    }


    /*
     * Smoothly keep the tabs visible on smaller screens
     */
    if (window.innerWidth <= 700) {

        var tabs = document.querySelector('.webinar-tabs-wrapper');

        if (tabs) {

            tabs.scrollIntoView({
                behavior: 'smooth',
                block: 'nearest'
            });

        }

    }

}


/*
 * Auto-hide success message
 */
document.addEventListener('DOMContentLoaded', function() {

    var alert = document.querySelector('.webinar-alert');

    if (alert) {

        setTimeout(function() {

            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-5px)';
            alert.style.transition = 'all .3s ease';

            setTimeout(function() {

                if (alert.parentElement) {
                    alert.parentElement.remove();
                }

            }, 300);

        }, 5000);

    }

});

</script>

@endsection
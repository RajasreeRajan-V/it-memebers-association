@extends('layouts.app')

@section('content')

<!-- Events Hero -->
<section class="hero" id="events">
    <div class="container hero-inner">
        <div class="hero-copy">
            <p class="eyebrow">Events</p>
            <h1>
                Learn, Connect<br />
                <span class="accent-text">and Grow Together</span>
            </h1>
            <p class="hero-sub">
                Workshops, webinars, job fairs and networking meetups — find out
                what's happening on SkillConnect and reserve your spot.
            </p>
        </div>
    </div>
</section>

<!-- Upcoming Events -->
<section class="portals">
    <div class="container">
        <div class="section-head">
            <h2>Upcoming Events</h2>
            <p>Hand-picked sessions to help you hire, get hired, learn and grow.</p>
        </div>

        <div class="portal-grid">

            <article class="portal-card portal-blue">
                <div class="portal-icon">
                    <svg viewBox="0 0 24 24" fill="none">
                        <rect x="3" y="5" width="18" height="16" rx="2" stroke="currentColor" stroke-width="1.8" />
                        <path d="M3 9h18M8 3v4M16 3v4" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" />
                    </svg>
                </div>
                <div class="portal-body">
                    <h3>Hiring Fair 2026</h3>
                    <p>Meet top employers hiring across tech, design and operations.</p>
                    <a href="#" class="portal-link">Details <span aria-hidden="true">→</span></a>
                </div>
            </article>

            <article class="portal-card portal-green">
                <div class="portal-icon">
                    <svg viewBox="0 0 24 24" fill="none">
                        <rect x="3" y="5" width="18" height="16" rx="2" stroke="currentColor" stroke-width="1.8" />
                        <path d="M3 9h18M8 3v4M16 3v4" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" />
                    </svg>
                </div>
                <div class="portal-body">
                    <h3>Resume & Interview Workshop</h3>
                    <p>Live session on building a standout resume and acing interviews.</p>
                    <a href="#" class="portal-link">Details <span aria-hidden="true">→</span></a>
                </div>
            </article>

            <article class="portal-card portal-pink">
                <div class="portal-icon">
                    <svg viewBox="0 0 24 24" fill="none">
                        <rect x="3" y="5" width="18" height="16" rx="2" stroke="currentColor" stroke-width="1.8" />
                        <path d="M3 9h18M8 3v4M16 3v4" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" />
                    </svg>
                </div>
                <div class="portal-body">
                    <h3>Student Career Webinar</h3>
                    <p>Panel discussion on internships, scholarships and first jobs.</p>
                    <a href="#" class="portal-link">Details <span aria-hidden="true">→</span></a>
                </div>
            </article>

            <article class="portal-card portal-yellow">
                <div class="portal-icon">
                    <svg viewBox="0 0 24 24" fill="none">
                        <rect x="3" y="5" width="18" height="16" rx="2" stroke="currentColor" stroke-width="1.8" />
                        <path d="M3 9h18M8 3v4M16 3v4" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" />
                    </svg>
                </div>
                <div class="portal-body">
                    <h3>Freelancer Meetup</h3>
                    <p>Network with other freelancers and swap tips on winning projects.</p>
                    <a href="#" class="portal-link">Details <span aria-hidden="true">→</span></a>
                </div>
            </article>

            <article class="portal-card portal-purple">
                <div class="portal-icon">
                    <svg viewBox="0 0 24 24" fill="none">
                        <rect x="3" y="5" width="18" height="16" rx="2" stroke="currentColor" stroke-width="1.8" />
                        <path d="M3 9h18M8 3v4M16 3v4" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" />
                    </svg>
                </div>
                <div class="portal-body">
                    <h3>Investor Pitch Night</h3>
                    <p>Startups pitch live to a room of early-stage investors.</p>
                    <a href="#" class="portal-link">Details <span aria-hidden="true">→</span></a>
                </div>
            </article>

            <article class="portal-card portal-cyan">
                <div class="portal-icon">
                    <svg viewBox="0 0 24 24" fill="none">
                        <rect x="3" y="5" width="18" height="16" rx="2" stroke="currentColor" stroke-width="1.8" />
                        <path d="M3 9h18M8 3v4M16 3v4" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" />
                    </svg>
                </div>
                <div class="portal-body">
                    <h3>Mentor Meet & Greet</h3>
                    <p>Connect with mentors across industries in a casual roundtable.</p>
                    <a href="#" class="portal-link">Details <span aria-hidden="true">→</span></a>
                </div>
            </article>

        </div>
    </div>
</section>

@endsection
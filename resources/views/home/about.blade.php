@extends('layouts.app')

@section('content')

<!-- About Hero -->
<!-- About Hero -->
<section class="hero" id="about">
    <div class="container hero-inner">

        <!-- Left Side Image -->
        <div class="hero-image">
            <img src="{{ asset('assets/img/about-team.png') }}" alt="About SkillConnect">
        </div>

        <!-- Right Side Content -->
        <div class="hero-copy">
            <p class="eyebrow">About Us</p>

            <h1>
                Built for People,<br>
                <span class="accent-text">Powered by Opportunity</span>
            </h1>

            <p class="hero-sub">
                SkillConnect brings employers, job seekers, students, freelancers,
                investors and mentors together on one platform — because opportunity
                shouldn't be scattered across a dozen different apps.
            </p>
        </div>

    </div>
</section>

<!-- Mission / Story -->
<section class="portals">
    <div class="container">
        <div class="section-head">
            <h2>Our Mission</h2>
            <p>
                We believe growth happens fastest when the right people, skills and
                capital can find each other without friction. SkillConnect was built
                to be that meeting point.
            </p>
        </div>

        <div class="portal-grid">

            <article class="portal-card portal-blue">
                <div class="portal-icon">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M12 2 2 7l10 5 10-5-10-5Z" stroke="currentColor" stroke-width="1.8"
                            stroke-linejoin="round" />
                        <path d="M2 17l10 5 10-5M2 12l10 5 10-5" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="portal-body">
                    <h3>Our Vision</h3>
                    <p>A single platform where every career and business milestone can happen.</p>
                </div>
            </article>

            <article class="portal-card portal-green">
                <div class="portal-icon">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M12 21c4.97-3.5 8-7.1 8-11a8 8 0 1 0-16 0c0 3.9 3.03 7.5 8 11Z"
                            stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                        <circle cx="12" cy="10" r="2.5" stroke="currentColor" stroke-width="1.8" />
                    </svg>
                </div>
                <div class="portal-body">
                    <h3>Our Values</h3>
                    <p>Transparency, accessibility and fairness for everyone who joins us.</p>
                </div>
            </article>

            <article class="portal-card portal-purple">
                <div class="portal-icon">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M4 21V8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v13" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M9 21V13h6v8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="portal-body">
                    <h3>Our Team</h3>
                    <p>A small, focused group building tools that actually help people move forward.</p>
                </div>
            </article>

        </div>
    </div>
</section>

@endsection
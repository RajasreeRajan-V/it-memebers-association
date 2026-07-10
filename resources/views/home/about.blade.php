@extends('layouts.app')

@section('content')

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

<!-- Our Story -->
<section class="portals">
    <div class="container">
        <div class="section-head">
            <h2>Our Story</h2>
            <p>How a simple frustration turned into a platform for everyone.</p>
        </div>

        <div class="story-grid">
            <div class="story-text">
                <p>
                    SkillConnect started with a simple observation: opportunity is
                    everywhere, but it's scattered. Employers post jobs on one site,
                    freelancers pitch on another, students search for internships
                    somewhere else entirely, and investors discover startups through
                    yet another network.
                </p>
                <p>
                    We set out to build a single home for all of it — a place where
                    an employer can hire, a student can learn, a freelancer can bid,
                    and an investor can discover the next big idea, all without
                    switching platforms or losing context.
                </p>
                <p>
                    Today, SkillConnect connects thousands of people across six
                    distinct portals, each tailored to exactly what that person
                    needs — nothing more, nothing less.
                </p>
            </div>

            <div class="story-stats">
                <div class="stat-box">
                    <span class="stat-num">10K+</span>
                    <span class="stat-label">Active Users</span>
                </div>
                <div class="stat-box">
                    <span class="stat-num">2K+</span>
                    <span class="stat-label">Jobs Posted</span>
                </div>
                <div class="stat-box">
                    <span class="stat-num">500+</span>
                    <span class="stat-label">Startups Funded</span>
                </div>
                <div class="stat-box">
                    <span class="stat-num">6</span>
                    <span class="stat-label">Portals, One Platform</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mission / Values -->
<section class="portals" style="background: var(--white);">
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

            <article class="portal-card portal-pink">
                <div class="portal-icon">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M13 2 3 14h7l-1 8 10-12h-7l1-8Z" stroke="currentColor" stroke-width="1.8"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="portal-body">
                    <h3>Our Speed</h3>
                    <p>We move fast — for hiring, funding, and learning, timing matters.</p>
                </div>
            </article>

            <article class="portal-card portal-yellow">
                <div class="portal-icon">
                    <svg viewBox="0 0 24 24" fill="none">
                        <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.8" />
                        <path d="M12 7v5l3 3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="portal-body">
                    <h3>Our Reliability</h3>
                    <p>Verified profiles and secure transactions you can count on.</p>
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

            <article class="portal-card portal-cyan">
                <div class="portal-icon">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M12 3 2 8l10 5 10-5-10-5Z" stroke="currentColor" stroke-width="1.8"
                            stroke-linejoin="round" />
                        <path d="M6 10.5V16c0 1.9 2.7 3.5 6 3.5s6-1.6 6-3.5v-5.5" stroke="currentColor"
                            stroke-width="1.8" stroke-linecap="round" />
                    </svg>
                </div>
                <div class="portal-body">
                    <h3>Our Community</h3>
                    <p>Mentors, learners and builders supporting each other every step.</p>
                </div>
            </article>

        </div>
    </div>
</section>




<!-- Why Choose Us -->
<section class="portals">
    <div class="container">
        <div class="section-head">
            <h2>Why Choose SkillConnect</h2>
            <p>What sets us apart from scattered, single-purpose platforms.</p>
        </div>

        <div class="feature-list">

            <div class="feature-row">
                <div class="feature-num">01</div>
                <div class="feature-icon feature-blue">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M12 2 2 7l10 5 10-5-10-5Z" stroke="currentColor" stroke-width="1.8"
                            stroke-linejoin="round" />
                        <path d="M2 17l10 5 10-5M2 12l10 5 10-5" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="feature-text">
                    <h3>All-in-One Platform</h3>
                    <p>Six portals, one login — no juggling multiple apps for hiring, learning or funding.</p>
                </div>
            </div>

            <div class="feature-row">
                <div class="feature-num">02</div>
                <div class="feature-icon feature-green">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="m9 12 2 2 4-4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.8" />
                    </svg>
                </div>
                <div class="feature-text">
                    <h3>Verified Profiles</h3>
                    <p>Every employer, freelancer and investor is verified for a safer experience.</p>
                </div>
            </div>

            <div class="feature-row">
                <div class="feature-num">03</div>
                <div class="feature-icon feature-pink">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M13 2 3 14h7l-1 8 10-12h-7l1-8Z" stroke="currentColor" stroke-width="1.8"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="feature-text">
                    <h3>Fast Matching</h3>
                    <p>Smart matching connects the right people, skills and capital in days, not months.</p>
                </div>
            </div>

            <div class="feature-row">
                <div class="feature-num">04</div>
                <div class="feature-icon feature-yellow">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M4 21V8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v13" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M9 21V13h6v8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="feature-text">
                    <h3>Built for Growth</h3>
                    <p>Whether you're hiring your first employee or funding your tenth startup, we scale with you.</p>
                </div>
            </div>

            <div class="feature-row">
                <div class="feature-num">05</div>
                <div class="feature-icon feature-purple">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M12 21c4.97-3.5 8-7.1 8-11a8 8 0 1 0-16 0c0 3.9 3.03 7.5 8 11Z"
                            stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                        <circle cx="12" cy="10" r="2.5" stroke="currentColor" stroke-width="1.8" />
                    </svg>
                </div>
                <div class="feature-text">
                    <h3>Global Reach</h3>
                    <p>Opportunities and talent from every corner of the world, in one place.</p>
                </div>
            </div>

            <div class="feature-row">
                <div class="feature-num">06</div>
                <div class="feature-icon feature-cyan">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path
                            d="M12 2v4M12 18v4M4.9 4.9l2.8 2.8M16.3 16.3l2.8 2.8M2 12h4M18 12h4M4.9 19.1l2.8-2.8M16.3 7.7l2.8-2.8"
                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                        <circle cx="12" cy="12" r="3.2" stroke="currentColor" stroke-width="1.8" />
                    </svg>
                </div>
                <div class="feature-text">
                    <h3>24/7 Support</h3>
                    <p>Our support team is always on hand to help, whichever portal you're in.</p>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- How It Works -->
<section class="portals" style="background: var(--white);">
    <div class="container">
        <div class="section-head">
            <h2>How It Works</h2>
            <p>Getting started on SkillConnect takes three simple steps.</p>
        </div>

        <div class="process-track">
            <div class="process-line" aria-hidden="true"></div>

            <div class="process-step">
                <div class="process-dot">1</div>
                <div class="process-body">
                    <h3>Choose Your Portal</h3>
                    <p>Pick the portal that matches you — Employer, Employee, Student, Freelancer, Investor or Mentor.</p>
                </div>
            </div>

            <div class="process-step">
                <div class="process-dot">2</div>
                <div class="process-body">
                    <h3>Build Your Profile</h3>
                    <p>Add your details, skills or listings so the right people can find and connect with you.</p>
                </div>
            </div>

            <div class="process-step">
                <div class="process-dot process-dot-active">3</div>
                <div class="process-body">
                    <h3>Start Connecting</h3>
                    <p>Apply, hire, bid, invest or mentor — everything happens right inside your portal.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="portals">
    <div class="container about-cta">
        <h2>Ready to find your portal?</h2>
        <p>Join thousands already hiring, learning, freelancing and investing on SkillConnect.</p>
        <div class="hero-actions" style="justify-content: center;">
            <a href="#portals" class="btn btn-primary btn-lg">Get Started</a>
            <a href="{{ route('contact') }}" class="btn btn-outline btn-lg">Contact Us</a>
        </div>
    </div>
</section>

@endsection
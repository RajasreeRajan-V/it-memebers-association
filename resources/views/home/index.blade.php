@extends('layouts.app')

@section('content')

<!-- Hero -->
<section class="hero" id="about">
    <div class="container hero-inner">

        <div class="hero-copy reveal">
            <p class="eyebrow"></p>

            <h1>
                One Platform<br>
                <span class="accent-text">Endless Opportunities</span>
            </h1>

            <p class="home-hero-subtitle">Connect. Learn. Grow. Earn.</p>

            <p class="hero-sub">
                Jobs, internships, projects, courses, investments and mentorship —
                everything in one place, built around the way you actually work.
                Whether you're hiring, learning, freelancing, or investing, SkillConnect
                gives you the tools to move faster and go further.
            </p>

            <div class="hero-actions">
                <a href="#portals" class="btn btn-primary btn-lg">Get Started</a>
                <a href="{{ route('about') }}" class="btn btn-primary btn-lg">About Us</a>

            </div>
        </div>

        <div class="hero-visual hero-visual-plain reveal reveal-delay-1">
            <!-- <div class="hero-blob"></div> -->


            <img class="hero-plain-img" src="{{ asset('assets/img/hero-team.png') }}" alt="About SkillConnect">

            <div class="hero-float-chip hero-float-chip-brand">
                <span class="hero-float-chip-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M13 2 3 14h7l-1 8 10-12h-7l1-8Z" stroke-linejoin="round" />
                    </svg>
                </span>
                <div class="hero-float-chip-text">
                    <strong>SkillConnect</strong>
                    <span>Connect &amp; Grow</span>
                </div>
            </div>
</section>

<!-- Hero Stats Bar -->
<section class="home-stats-bar-section">
    <div class="container">
        <div class="home-stats-bar reveal">

            <div class="home-stats-bar-item">
                <div class="home-stats-bar-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <circle cx="9" cy="8" r="3.2" />
                        <path d="M2.5 20c0-3.8 2.9-6.2 6.5-6.2s6.5 2.4 6.5 6.2" />
                        <path d="M16 8.2a3.2 3.2 0 1 1 3.6 3.17" />
                        <path d="M15.5 13.9c2.9.3 5 2.5 5 6.1" />
                    </svg>
                </div>
                <div class="home-stats-bar-body">
                    <span class="home-stats-bar-number" data-count="100000">0</span><span
                        class="home-stats-bar-plus">+</span>
                    <p>Members</p>
                </div>
            </div>

            <div class="home-stats-bar-item">
                <div class="home-stats-bar-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M4 21V8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v13" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M9 21V13h6v8" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M9 6V4a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="home-stats-bar-body">
                    <span class="home-stats-bar-number" data-count="10000">0</span><span
                        class="home-stats-bar-plus">+</span>
                    <p>Jobs Posted</p>
                </div>
            </div>

            <div class="home-stats-bar-item">
                <div class="home-stats-bar-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M13 2 3 14h7l-1 8 10-12h-7l1-8Z" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="home-stats-bar-body">
                    <span class="home-stats-bar-number" data-count="5000">0</span><span
                        class="home-stats-bar-plus">+</span>
                    <p>Freelance Projects</p>
                </div>
            </div>

            <div class="home-stats-bar-item">
                <div class="home-stats-bar-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M12 3 2 8l10 5 10-5-10-5Z" stroke-linejoin="round" />
                        <path d="M6 10.5V16c0 1.9 2.7 3.5 6 3.5s6-1.6 6-3.5v-5.5" stroke-linecap="round" />
                        <path d="M22 8v6" stroke-linecap="round" />
                    </svg>
                </div>
                <div class="home-stats-bar-body">
                    <span class="home-stats-bar-number" data-count="3000">0</span><span
                        class="home-stats-bar-plus">+</span>
                    <p>Mentors</p>
                </div>
            </div>

            <div class="home-stats-bar-item">
                <div class="home-stats-bar-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M4 21V8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v13" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M9 21V13h6v8" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="home-stats-bar-body">
                    <span class="home-stats-bar-number" data-count="1500">0</span><span
                        class="home-stats-bar-plus">+</span>
                    <p>Startups</p>
                </div>
            </div>

            <div class="home-stats-bar-item">
                <div class="home-stats-bar-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path
                            d="M12 2v4M12 18v4M4.9 4.9l2.8 2.8M16.3 16.3l2.8 2.8M2 12h4M18 12h4M4.9 19.1l2.8-2.8M16.3 7.7l2.8-2.8"
                            stroke-linecap="round" />
                        <circle cx="12" cy="12" r="3.2" />
                    </svg>
                </div>
                <div class="home-stats-bar-body">
                    <span class="home-stats-bar-number" data-count="500">0</span><span
                        class="home-stats-bar-plus">+</span>
                    <p>Investors</p>
                </div>
            </div>

            <div class="home-stats-bar-item">
                <div class="home-stats-bar-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M12 2 3 6v6c0 5 4 8 9 10 5-2 9-5 9-10V6l-9-4Z" stroke-linejoin="round" />
                        <path d="m8.5 12 2.5 2.5L16 9" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="home-stats-bar-body">
                    <span class="home-stats-bar-number" data-count="95">0</span><span
                        class="home-stats-bar-plus">%</span>
                    <p>Hiring Success</p>
                </div>
            </div>
        </div>
</section>








<!-- ===== Portal Slider ===== -->
<section class="portals" id="portals">
    <div class="container">

        <div class="section-head reveal">
            <h2>Choose your portal</h2>
            <p>
                Every path onto SkillConnect is purpose-built — pick the door
                that matches where you're headed.
            </p>
        </div>

        <div class="portal-slider">

            <div class="portal-track">

                <!-- ================= Slide 1 ================= -->
                <div class="portal-group">

                    <!-- Employer -->
                    <article class="portal-card portal-blue">
                        <div class="portal-icon">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M4 21V8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v13" stroke="currentColor"
                                    stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M9 21V13h6v8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M9 6V4a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2" stroke="currentColor"
                                    stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>

                        <div class="portal-body">
                            <h3>Employer Portal</h3>
                            <p>Post jobs, screen applicants, and build your team.</p>
                            <a href="{{ route('membership') }}" class="portal-link">
                                Register <span>→</span>
                            </a>
                        </div>
                    </article>

                    <!-- Employee -->
                    <article class="portal-card portal-green">
                        <div class="portal-icon">
                            <svg viewBox="0 0 24 24" fill="none">
                                <circle cx="12" cy="8" r="4" stroke="currentColor" stroke-width="1.8" />
                                <path d="M4 21c0-4.4 3.6-7 8-7s8 2.6 8 7" stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" />
                            </svg>
                        </div>

                        <div class="portal-body">
                            <h3>Employee Portal</h3>
                            <p>Find jobs, build skills, and grow your career.</p>
                            <a href="{{ route('membership') }}" class="portal-link">
                                Register <span>→</span>
                            </a>
                        </div>
                    </article>

                    <!-- Student -->
                    <article class="portal-card portal-pink">
                        <div class="portal-icon">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M22 10 12 5 2 10l10 5 10-5Z" stroke="currentColor" stroke-width="1.8"
                                    stroke-linejoin="round" />
                                <path d="M6 12v5c0 1.7 2.7 3 6 3s6-1.3 6-3v-5" stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>

                        <div class="portal-body">
                            <h3>Student Portal</h3>
                            <p>Find internships, courses and scholarships.</p>
                            <a href="{{ route('membership') }}" class="portal-link">
                                Register <span>→</span>
                            </a>
                        </div>
                    </article>

                </div>

                <!-- ================= Slide 2 ================= -->
                <div class="portal-group">

                    <!-- Freelancer -->
                    <article class="portal-card portal-yellow">
                        <div class="portal-icon">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M13 2 3 14h7l-1 8 10-12h-7l1-8Z" stroke="currentColor" stroke-width="1.8"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>

                        <div class="portal-body">
                            <h3>Freelancer Portal</h3>
                            <p>Bid on projects, showcase work, and get paid.</p>
                            <a href="{{ route('membership') }}" class="portal-link">
                                Register <span>→</span>
                            </a>
                        </div>
                    </article>

                    <!-- Investor -->
                    <article class="portal-card portal-purple">
                        <div class="portal-icon">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M12 2v4M12 18v4M4.9 4.9l2.8 2.8M16.3 16.3l2.8 2.8M2 12h4M18 12h4M4.9 19.1l2.8-2.8M16.3 7.7l2.8-2.8"
                                    stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                <circle cx="12" cy="12" r="3.2" stroke="currentColor" stroke-width="1.8" />
                            </svg>
                        </div>

                        <div class="portal-body">
                            <h3>Investor Portal</h3>
                            <p>Discover startups and back new ideas early.</p>
                            <a href="{{ route('membership') }}" class="portal-link">
                                Register <span>→</span>
                            </a>
                        </div>
                    </article>

                    <!-- Mentor -->
                    <article class="portal-card portal-cyan">
                        <div class="portal-icon">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M12 3 2 8l10 5 10-5-10-5Z" stroke="currentColor" stroke-width="1.8"
                                    stroke-linejoin="round" />
                                <path d="M6 10.5V16c0 1.9 2.7 3.5 6 3.5s6-1.6 6-3.5v-5.5" stroke="currentColor"
                                    stroke-width="1.8" stroke-linecap="round" />
                                <path d="M22 8v6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                            </svg>
                        </div>

                        <div class="portal-body">
                            <h3>Mentor Portal</h3>
                            <p>Teach, guide and support the next generation.</p>
                            <a href="{{ route('membership') }}" class="portal-link">
                                Register <span>→</span>
                            </a>
                        </div>
                    </article>

                </div>

            </div>

        </div>

    </div>
</section>
<section class="future-section">
    <div class="container future-wrapper">

        <!-- LEFT SIDE -->
        <div class="future-images">

            <div class="shape-one"></div>
            <div class="shape-two"></div>

            <div class="image-box main-image">
                <img src="{{ asset('assets/img/build.png') }}" alt="">
            </div>



        </div>


        <!-- RIGHT SIDE -->

        <div class="future-content">

            <span class="section-tag">
                BUILDING THE FUTURE
            </span>

            <h2>
                Empowering Professionals with
                <span>Modern Digital Solutions</span>
            </h2>

            <p>
                We connect students, professionals, employers, freelancers,
                mentors, and investors through one intelligent platform that
                simplifies networking, hiring, learning, collaboration,
                and business growth.
            </p>

            <div class="feature-grid">

                <div class="feature-item">
                    <i class="fas fa-check-circle"></i>
                    Professional Networking
                </div>

                <div class="feature-item">
                    <i class="fas fa-check-circle"></i>
                    Job & Internship Portal
                </div>

                <div class="feature-item">
                    <i class="fas fa-check-circle"></i>
                    Startup Investment
                </div>

                <div class="feature-item">
                    <i class="fas fa-check-circle"></i>
                    Mentorship Programs
                </div>

                <div class="feature-item">
                    <i class="fas fa-check-circle"></i>
                    Freelancing Opportunities
                </div>

                <div class="feature-item">
                    <i class="fas fa-check-circle"></i>
                    Verified Community
                </div>

            </div>

            <div class="future-buttons">

                <a href="{{ route('membership') }}" class="btn-primary">
                    Join Our Community
                </a>

                <a href="{{ route('about') }}" class="btn-primary">
                    Learn More
                </a>

            </div>

        </div>

    </div>
</section>



<section class="home-benefits-section">
    <div class="container">
        <div class="section-head reveal">
            <h2>Built Around Every Role</h2>
            <p>One platform, six ways in — here's what you unlock the moment you join.</p>
        </div>

        <div class="home-flip-grid">

            <div class="home-flip-card reveal">
                <div class="home-flip-inner">
                    <div class="home-flip-face home-flip-front home-flip-blue">
                        <div class="home-flip-icon">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M22 10 12 5 2 10l10 5 10-5Z" stroke="currentColor" stroke-width="1.8"
                                    stroke-linejoin="round" />
                                <path d="M6 12v5c0 1.7 2.7 3 6 3s6-1.3 6-3v-5" stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <h3>Student</h3>
                        <span class="home-flip-hint">Hover to see benefits</span>
                    </div>
                    <div class="home-flip-face home-flip-back home-flip-blue">
                        <h3>Student</h3>
                        <ul>
                            <li>Apply to jobs &amp; internships</li>
                            <li>Enroll in courses &amp; trainings</li>
                            <li>Get free resume reviews</li>
                            <li>Request 1:1 mentorship</li>
                            <li>Join hackathons &amp; events</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="home-flip-card reveal reveal-delay-1">
                <div class="home-flip-inner">
                    <div class="home-flip-face home-flip-front home-flip-green">
                        <div class="home-flip-icon">
                            <svg viewBox="0 0 24 24" fill="none">
                                <circle cx="12" cy="8" r="4" stroke="currentColor" stroke-width="1.8" />
                                <path d="M4 21c0-4.4 3.6-7 8-7s8 2.6 8 7" stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" />
                            </svg>
                        </div>
                        <h3>Employee</h3>
                        <span class="home-flip-hint">Hover to see benefits</span>
                    </div>
                    <div class="home-flip-face home-flip-back home-flip-green">
                        <h3>Employee</h3>
                        <ul>
                            <li>Explore new job switches</li>
                            <li>Take on paid side projects</li>
                            <li>Publish technical articles</li>
                            <li>Access legal support</li>
                            <li>Join workshops &amp; trainings</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="home-flip-card reveal reveal-delay-2">
                <div class="home-flip-inner">
                    <div class="home-flip-face home-flip-front home-flip-purple">
                        <div class="home-flip-icon">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M4 21V8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v13" stroke="currentColor"
                                    stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M9 21V13h6v8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M9 6V4a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2" stroke="currentColor"
                                    stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <h3>Employer</h3>
                        <span class="home-flip-hint">Hover to see benefits</span>
                    </div>
                    <div class="home-flip-face home-flip-back home-flip-purple">
                        <h3>Employer</h3>
                        <ul>
                            <li>Post jobs &amp; internships</li>
                            <li>Outsource projects easily</li>
                            <li>Showcase your startup pitch</li>
                            <li>Hire verified freelancers</li>
                            <li>Review applications in one place</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="home-flip-card reveal">
                <div class="home-flip-inner">
                    <div class="home-flip-face home-flip-front home-flip-yellow">
                        <div class="home-flip-icon">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M13 2 3 14h7l-1 8 10-12h-7l1-8Z" stroke="currentColor" stroke-width="1.8"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>
                        <h3>Freelancer</h3>
                        <span class="home-flip-hint">Hover to see benefits</span>
                    </div>
                    <div class="home-flip-face home-flip-back home-flip-yellow">
                        <h3>Freelancer</h3>
                        <ul>
                            <li>Bid on live projects</li>
                            <li>Post &amp; sell your services</li>
                            <li>Build a public portfolio</li>
                            <li>Get secure, tracked payments</li>
                            <li>Grow client relationships</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="home-flip-card reveal reveal-delay-1">
                <div class="home-flip-inner">
                    <div class="home-flip-face home-flip-front home-flip-pink">
                        <div class="home-flip-icon">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M12 2v4M12 18v4M4.9 4.9l2.8 2.8M16.3 16.3l2.8 2.8M2 12h4M18 12h4M4.9 19.1l2.8-2.8M16.3 7.7l2.8-2.8"
                                    stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                <circle cx="12" cy="12" r="3.2" stroke="currentColor" stroke-width="1.8" />
                            </svg>
                        </div>
                        <h3>Investor</h3>
                        <span class="home-flip-hint">Hover to see benefits</span>
                    </div>
                    <div class="home-flip-face home-flip-back home-flip-pink">
                        <h3>Investor</h3>
                        <ul>
                            <li>Browse curated startup profiles</li>
                            <li>Request full pitch deck access</li>
                            <li>Connect directly with founders</li>
                            <li>Post your investment criteria</li>
                            <li>Join exclusive pitch nights</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="home-flip-card reveal reveal-delay-2">
                <div class="home-flip-inner">
                    <div class="home-flip-face home-flip-front home-flip-cyan">
                        <div class="home-flip-icon">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M12 3 2 8l10 5 10-5-10-5Z" stroke="currentColor" stroke-width="1.8"
                                    stroke-linejoin="round" />
                                <path d="M6 10.5V16c0 1.9 2.7 3.5 6 3.5s6-1.6 6-3.5v-5.5" stroke="currentColor"
                                    stroke-width="1.8" stroke-linecap="round" />
                                <path d="M22 8v6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                            </svg>
                        </div>
                        <h3>Mentor</h3>
                        <span class="home-flip-hint">Hover to see benefits</span>
                    </div>
                    <div class="home-flip-face home-flip-back home-flip-cyan">
                        <h3>Mentor</h3>
                        <ul>
                            <li>Accept mentee requests</li>
                            <li>Review student resumes</li>
                            <li>Host webinars &amp; workshops</li>
                            <li>Share training material</li>
                            <li>Conduct mock interviews</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>





<!-- Interactive Role Showcase -->
<section class="home-tabs-section">
    <div class="container">

        <div class="section-head reveal">
            <h2>Explore By Your Needs</h2>
            <p>Find everything you need to grow, build and succeed.</p>
        </div>

        <div class="home-tabs reveal">

            <!-- Tabs -->
            <div class="home-tabs-nav" id="homeTabsNav">
                <button type="button" class="home-tab-btn is-active" data-tab="student">
                    For Students
                </button>



                <button type="button" class="home-tab-btn" data-tab="employer">
                    For Employers
                </button>


                <button type="button" class="home-tab-btn" data-tab="employee">
                    For Employees
                </button>

                <button type="button" class="home-tab-btn" data-tab="freelancer">
                    For Freelancers
                </button>

                <button type="button" class="home-tab-btn" data-tab="investor">
                    For Investors
                </button>

                <button type="button" class="home-tab-btn" data-tab="mentor">
                    For Mentors
                </button>
            </div>

            <!-- Panels -->
            <div class="home-tabs-panel-wrap" id="homeTabsPanels">

                <!-- Student -->
                <div class="home-tab-panel is-active" data-panel="student">
                    <div class="home-tab-visual home-tab-blue">
                        <img src="{{ asset('assets/img/student.png') }}" alt="Student">
                    </div>

                    <div class="home-tab-content">
                        <h3>Find Your Dream Path</h3>

                        <p>
                            Discover internships and entry-level jobs, enroll in skill-building
                            courses, and get direct mentorship from professionals who've been
                            where you're headed.
                        </p>

                        <ul>
                            <li><span class="tab-check">✓</span> Curated job & internship listings</li>
                            <li><span class="tab-check">✓</span> Free resume reviews from mentors</li>
                            <li><span class="tab-check">✓</span> Hackathons & skill events</li>
                            <li><span class="tab-check">✓</span> Connect with top mentors</li>
                        </ul>

                        <a href="registration" class="btn btn-primary home-tab-cta">
                            Explore Now →
                        </a>
                    </div>
                </div>

                <!-- Employee -->
                <div class="home-tab-panel" data-panel="employee">
                    <div class="home-tab-visual home-tab-blue">
                        <img src="{{ asset('assets/img/employee.png') }}" alt="Employee">
                    </div>

                    <div class="home-tab-content">
                        <h3>Advance Your Career</h3>

                        <p>
                            Discover better career opportunities, expand your professional
                            network, and enhance your skills through mentorship, workshops,
                            and industry connections tailored for working professionals.
                        </p>

                        <ul>
                            <li><span class="tab-check">✓</span> Explore full-time and part-time jobs</li>
                            <li><span class="tab-check">✓</span> Connect with leading employers</li>
                            <li><span class="tab-check">✓</span> Upskill through workshops and training</li>
                            <li><span class="tab-check">✓</span> Get guidance from experienced mentors</li>
                        </ul>

                        <a href="registration" class="btn btn-primary home-tab-cta">
                            Explore Opportunities →
                        </a>
                    </div>
                </div>

                <!-- Employer -->
                <div class="home-tab-panel" data-panel="employer">
                    <div class="home-tab-visual home-tab-purple">
                        <img src="{{ asset('assets/img/employer7.png') }}" alt="Employer">
                    </div>

                    <div class="home-tab-content">
                        <h3>Find Talent Faster</h3>

                        <p>
                            Post jobs, projects, or internships and reach a pool of students,
                            employees, and freelancers actively looking for opportunities.
                        </p>

                        <ul>
                            <li><span class="tab-check">✓</span> Post jobs, internships & projects</li>
                            <li><span class="tab-check">✓</span> Review applications in one dashboard</li>
                            <li><span class="tab-check">✓</span> Hire verified freelancers on demand</li>
                        </ul>

                        <a href="registration" class="btn btn-primary home-tab-cta">
                            Post a Job →
                        </a>
                    </div>
                </div>

                <!-- Freelancer -->
                <div class="home-tab-panel" data-panel="freelancer">
                    <div class="home-tab-visual home-tab-yellow">
                        <img src="{{ asset('assets/img/freelancer.png') }}" alt="Freelancer">
                    </div>

                    <div class="home-tab-content">
                        <h3>Bid, Build & Get Paid</h3>

                        <p>
                            Browse live projects, showcase your portfolio, and manage your
                            client work with secure, tracked payments from start to finish.
                        </p>

                        <ul>
                            <li><span class="tab-check">✓</span> Bid on projects that fit your skills</li>
                            <li><span class="tab-check">✓</span> Public portfolio & service listings</li>
                            <li><span class="tab-check">✓</span> Secure, tracked payment releases</li>
                        </ul>

                        <a href="registration" class="btn btn-primary home-tab-cta">
                            Browse Projects →
                        </a>
                    </div>
                </div>

                <!-- Investor -->
                <div class="home-tab-panel" data-panel="investor">
                    <div class="home-tab-visual home-tab-pink">
                        <img src="{{ asset('assets/img/investor.png') }}" alt="Investor">
                    </div>

                    <div class="home-tab-content">
                        <h3>Discover Startups Worth Backing</h3>

                        <p>
                            Browse curated startup profiles, request pitch decks, and connect
                            directly with founders who match your investment criteria.
                        </p>

                        <ul>
                            <li><span class="tab-check">✓</span> Curated startup profiles</li>
                            <li><span class="tab-check">✓</span> Access pitch decks & financials</li>
                            <li><span class="tab-check">✓</span> Direct founder connections</li>
                        </ul>

                        <a href="registration" class="btn btn-primary home-tab-cta">
                            View Startups →
                        </a>
                    </div>
                </div>

                <!-- Mentor -->
                <div class="home-tab-panel" data-panel="mentor">
                    <div class="home-tab-visual home-tab-cyan">
                        <img src="{{ asset('assets/img/mentor.png') }}" alt="Mentor">
                    </div>

                    <div class="home-tab-content">
                        <h3>Share Your Experience</h3>

                        <p>
                            Accept mentee requests, host webinars, and guide the next generation
                            with resume reviews and mock interviews.
                        </p>

                        <ul>
                            <li><span class="tab-check">✓</span> Flexible mentee matching</li>
                            <li><span class="tab-check">✓</span> Host webinars & workshops</li>
                            <li><span class="tab-check">✓</span> Conduct mock interviews</li>
                        </ul>

                        <a href="registration" class="btn btn-primary home-tab-cta">
                            Become a Mentor →
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

<!-- Features / Why Choose Us -->
<section class="home-bento-section">
    <div class="container">
        <div class="section-head reveal">
            <h2 class="home-bento-heading">Why Choose SkillConnect</h2>
            <p>Built for real people navigating real careers — not one-size-fits-all job boards.</p>
        </div>

        <div class="home-bento-grid">

            <div class="home-bento-tile home-bento-large home-bento-indigo reveal">
                <div class="home-bento-icon">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M13 2 3 14h7l-1 8 10-12h-7l1-8Z" stroke="currentColor" stroke-width="1.8"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <h3>Fast Matching</h3>
                <p>Smart algorithms connect you to the right opportunity in minutes, not weeks — no endless scrolling
                    through irrelevant listings.</p>
            </div>

            <div class="home-bento-tile home-bento-teal reveal reveal-delay-1">
                <div class="home-bento-icon">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M12 2 3 6v6c0 5 4 8 9 10 5-2 9-5 9-10V6l-9-4Z" stroke="currentColor" stroke-width="1.8"
                            stroke-linejoin="round" />
                        <path d="m8.5 12 2.5 2.5L16 9" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <h3>Verified &amp; Secure</h3>
                <p>Every profile and payment is verified for safe, confident hiring.</p>
            </div>

            <div class="home-bento-tile home-bento-pink reveal reveal-delay-2">
                <div class="home-bento-icon">
                    <svg viewBox="0 0 24 24" fill="none">
                        <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.8" />
                        <path d="M3 12h18M12 3c2.5 2.6 4 6 4 9s-1.5 6.4-4 9c-2.5-2.6-4-6-4-9s1.5-6.4 4-9Z"
                            stroke="currentColor" stroke-width="1.8" />
                    </svg>
                </div>
                <h3>Global Reach</h3>
                <p>Access talent, mentors, and investors from anywhere in the world.</p>
            </div>

            <div class="home-bento-tile home-bento-large home-bento-purple reveal reveal-delay-1">
                <div class="home-bento-icon">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M4 19V10M10 19V5M16 19v-7M22 19H2" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <h3>Track Your Growth</h3>
                <p>Dashboards and insights help you measure progress across every portal you use, from applications sent
                    to earnings tracked.</p>
            </div>

        </div>
    </div>
</section>




<section class="opportunities-section">
    <div class="container opportunities-inner">

        <!-- Top trust badge -->
        <div class="trust-badge">
            <div class="trust-avatars">
                <img src="https://ui-avatars.com/api/?name=A+B&background=4F46E5&color=fff&size=32" alt="">
                <img src="https://ui-avatars.com/api/?name=C+D&background=22C55E&color=fff&size=32" alt="">
                <img src="https://ui-avatars.com/api/?name=E+F&background=F59E0B&color=fff&size=32" alt="">
                <span class="trust-more">+10K</span>
            </div>
            <div class="trust-text">
                <strong>Trusted by 100,000+</strong>
                <span>Professionals Worldwide</span>
            </div>
            <div class="trust-rating">
                <span class="stars">★★★★★</span>
                <span class="rating-value">4.9/5</span>
            </div>
        </div>

        <!-- Heading -->
        <div class="opportunities-header">
            <span class="opportunities-eyebrow">MULTIPLE PATHS. ONE PLATFORM.</span>
            <h2 class="opportunities-heading">
                Opportunities for <span class="highlight">Every Professional</span>
            </h2>
            <p class="opportunities-subtext">
                Whether you guide, invest, or create — SkillConnect provides the perfect ecosystem to grow your impact,
                income, and network.
            </p>
        </div>

        <!-- Cards -->
        <div class="opportunity-cards">

            <!-- Mentor Card -->
            <div class="opportunity-card">
                <span class="card-tag tag-mentor">CREATE &amp; INSPIRE</span>
                <div class="card-photo">
                    <img src="{{ asset('assets/img/mentor1.png') }}" alt="Mentor">

                    <div class="floating-badge badge-bottom">
                        <div class="mini-avatars">
                            <img src="https://ui-avatars.com/api/?name=N+L&background=4F46E5&color=fff&size=20" alt="">
                            <img src="https://ui-avatars.com/api/?name=R+J&background=22C55E&color=fff&size=20" alt="">
                        </div>
                        <span>Nabeel, Lisa Nova, Rohan Jamil</span>
                    </div>
                </div>
                <h3>Mentor</h3>
                <p class="card-desc">Share your knowledge. Shape the future.</p>
                <p class="card-subdesc">Empower students, professionals, and entrepreneurs with your guidance career
                    advice.</p>
                <ul class="card-features">
                    <li>1-on-1 Mentorship</li>
                    <li>Webinars Workshops</li>
                    <li>Resume Reviews</li>
                    <li>Career Guidance</li>
                </ul>
                <a href="{{ route('membership') }}" class="card-cta cta-mentor">Explore Mentor Portal <span>&rarr;</span></a>
            </div>

            <!-- Investor Card -->
            <div class="opportunity-card">
                <span class="card-tag tag-investor">INVEST &amp; GROW</span>
                <div class="card-photo">
                    <img src="{{ asset('assets/img/investor1.png') }}" alt="Investor">
                    <div class="floating-badge badge-top">
                        <span class="badge-label">Active Investments</span>
                        <span class="badge-value">28</span>
                    </div>
                    <div class="floating-badge badge-bottom stat-badge">
                        <span class="badge-label">Total Portfolio Value</span>
                        <span class="badge-value">₹2.45 Cr</span>
                    </div>
                </div>
                <h3>Investor</h3>
                <p class="card-desc">Discover startups. Invest in tomorrow.</p>
                <p class="card-subdesc">Connect with innovative startups, review pitch decks, and invest in
                    high-potential ideas.</p>
                <ul class="card-features">
                    <li>Startups Discovery</li>
                    <li>Pitch Decks</li>
                    <li>Founder Connect</li>
                    <li>Portfolio Tracking</li>
                </ul>
                <a href="{{ route('membership') }}" class="card-cta cta-investor">Explore Investor Portal <span>&rarr;</span></a>
            </div>

            <!-- Freelancer Card -->
            <div class="opportunity-card">
                <span class="card-tag tag-freelancer">WORK &amp; EARN</span>
                <div class="card-photo">
                    <img src="{{ asset('assets/img/freelancer4.png') }}" alt="Freelancer">
                    <div class="floating-badge badge-top">
                        New Project Available
                    </div>
                    <div class="floating-badge badge-bottom stat-badge">
                        <span class="badge-label">Payment Received</span>
                        <span class="badge-value">₹25,000</span>
                    </div>
                </div>
                <h3>Freelancer</h3>
                <p class="card-desc">Showcase your skills. Work on your terms.</p>
                <p class="card-subdesc">Find projects, bid on opportunities, collaborate with clients, and get paid
                    securely for your work.</p>
                <ul class="card-features">
                    <li>Project Marketplace</li>
                    <li>Secure Payments</li>
                    <li>Client Communication</li>
                    <li>Portfolio Builder</li>
                </ul>
                <a href="{{ route('membership') }}" class="card-cta cta-freelancer">Explore Freelancer Portal <span>&rarr;</span></a>
            </div>

        </div>
    </div>
</section>





<section class="membership-hero">
    <div class="container membership-hero-inner">
        <div class="membership-hero-content">
            <span class="membership-eyebrow">MEMBERSHIP PLANS</span>
            <h2 class="membership-heading">
                Build. Connect. <span class="highlight">Raise. Grow.</span>
            </h2>
            <p class="membership-subtext">
                Create your startup profile, showcase your ideas, recruit talent, upload pitch decks, connect with
                investors, join startup events, and raise funding to grow your business.
            </p>

            <ul class="membership-features">
                <li>
                    <span class="check-icon">
                        <svg viewBox="0 0 24 24" width="16" height="16">
                            <circle cx="12" cy="12" r="10" fill="#2563EB" />
                            <path d="M8 12.5l2.5 2.5L16 9" stroke="white" stroke-width="2" fill="none"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                    Startup Profiles &amp; Pitch Decks
                </li>
                <li>
                    <span class="check-icon">
                        <svg viewBox="0 0 24 24" width="16" height="16">
                            <circle cx="12" cy="12" r="10" fill="#2563EB" />
                            <path d="M8 12.5l2.5 2.5L16 9" stroke="white" stroke-width="2" fill="none"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                    Founder Networking
                </li>
                <li>
                    <span class="check-icon">
                        <svg viewBox="0 0 24 24" width="16" height="16">
                            <circle cx="12" cy="12" r="10" fill="#2563EB" />
                            <path d="M8 12.5l2.5 2.5L16 9" stroke="white" stroke-width="2" fill="none"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                    Startup Events &amp; Hackathons
                </li>
                <li>
                    <span class="check-icon">
                        <svg viewBox="0 0 24 24" width="16" height="16">
                            <circle cx="12" cy="12" r="10" fill="#2563EB" />
                            <path d="M8 12.5l2.5 2.5L16 9" stroke="white" stroke-width="2" fill="none"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                    Funding Opportunities
                </li>
            </ul>

            <a href="{{ route('registration') }}" class="membership-cta">Explore Startups</a>
        </div>

        <div class="membership-hero-visual">
            <img src="{{ asset('assets/img/rocket.png') }}" alt="Startup growth illustration" class="hero-illustration">
        </div>
    </div>
</section>




<section class="faq-wrap">
    <div>
           <p style="color: #3376F2;">Everything you need to know</p>
        <h1>Frequently asked<br><span>questions</span></h1>
        <p class="desc">Answers to the most common questions about using SkillConnect — whatever portal you're coming
            from. Browse by topic below, or reach out to our support team if you can't find what you need.</p>
    </div>

    <div class="accordion" id="accordion">
        <div class="item open" data-index="0">
            <div class="item-header">
                <span>How do I create an account on SkillConnect?</span>
                <div class="icon-btn"><svg viewBox="0 0 24 24">
                        <polyline points="6 9 12 15 18 9" />
                    </svg></div>
            </div>
            <div class="item-body">
                <p>Click "Membership" on the homepage, choose the portal that matches you (Employer, Employee, Student,
                    Freelancer, Investor or Mentor), and fill in your details to get started in minutes</p>
            </div>
        </div>

        <div class="item" data-index="1">
            <div class="item-header">
                <span>Is my personal data safe on SkillConnect?</span>
                <div class="icon-btn"><svg viewBox="0 0 24 24">
                        <polyline points="6 9 12 15 18 9" />
                    </svg></div>
            </div>
            <div class="item-body">
                <p>Yes. We use industry-standard encryption and never sell your personal data to third parties.</p>
            </div>
        </div>

        <div class="item" data-index="2">
            <div class="item-header">
                <span>Can I switch between portals later?</span>
                <div class="icon-btn"><svg viewBox="0 0 24 24">
                        <polyline points="6 9 12 15 18 9" />
                    </svg></div>
            </div>
            <div class="item-body">
                <p>Yes. Your account isn't locked to a single portal — you can access multiple portals (for example,
                    Freelancer and Investor) from the same login.</p>
            </div>
        </div>

        <div class="item" data-index="3">
            <div class="item-header">
                <span>Who can I contact for support?</span>
                <div class="icon-btn"><svg viewBox="0 0 24 24">
                        <polyline points="6 9 12 15 18 9" />
                    </svg></div>
            </div>
            <div class="item-body">
                <p>You can reach our support team anytime through the contact form linked in the footer, or email us
                    directly and we'll get back to you within 24 hours.</p>
            </div>
        </div>
    </div>
</section>


<section class="cta-banner-section">
    <div class="container">
        <div class="cta-banner reveal">

            <!-- Left Content -->
            <div class="cta-banner-content">
                <span class="cta-banner-eyebrow">Ready to Get Started</span>

                <h2>
                    Join thousands of professionals and
                    start your journey with SkillConnect today!
                </h2>

                <div class="cta-banner-actions">
                    <a href="registration" class="btn btn-cta-primary">
                        Create Your Account
                    </a>

                    <a href="members" class="btn btn-cta-outline">
                        Explore More
                    </a>
                </div>
            </div>

            <!-- Right Image -->
            <div class="cta-banner-image">
                <img src="{{ asset('assets/img/cta-image.png') }}" alt="CTA Image">
                
            </div>

        </div>
    </div>
</section>







<script>
document.addEventListener('DOMContentLoaded', () => {
    const navToggle = document.getElementById('navToggle');
    const mainNav = document.querySelector('.main-nav');
    if (navToggle && mainNav) {
        navToggle.addEventListener('click', () => {
            const open = mainNav.classList.toggle('is-open');
            navToggle.classList.toggle('is-open', open);
            navToggle.setAttribute('aria-expanded', open);
        });
    }

    // Scroll reveal animation
    const revealEls = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.15
    });
    revealEls.forEach(el => observer.observe(el));

    // Animated stat counters
    const statNumbers = document.querySelectorAll('.home-stats-bar-number');
    const statObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const el = entry.target;
                const target = parseInt(el.getAttribute('data-count'), 10);
                const duration = 1500;
                const start = performance.now();

                function tick(now) {
                    const progress = Math.min((now - start) / duration, 1);
                    el.textContent = Math.floor(progress * target).toLocaleString();
                    if (progress < 1) requestAnimationFrame(tick);
                    else el.textContent = target.toLocaleString();
                }
                requestAnimationFrame(tick);
                statObserver.unobserve(el);
            }
        });
    }, {
        threshold: 0.4
    });
    statNumbers.forEach(el => statObserver.observe(el));
});


// Interactive role tabs (event delegation - fixes multi-button issue)
const homeTabsNav = document.getElementById('homeTabsNav');
const homeTabsPanels = document.getElementById('homeTabsPanels');

if (homeTabsNav && homeTabsPanels) {
    homeTabsNav.addEventListener('click', (e) => {
        const btn = e.target.closest('.home-tab-btn');
        if (!btn) return;

        const target = btn.getAttribute('data-tab');

        homeTabsNav.querySelectorAll('.home-tab-btn').forEach(b => {
            b.classList.remove('is-active');
        });
        btn.classList.add('is-active');

        homeTabsPanels.querySelectorAll('.home-tab-panel').forEach(panel => {
            if (panel.getAttribute('data-panel') === target) {
                panel.classList.add('is-active');
            } else {
                panel.classList.remove('is-active');
            }
        });
    });
}



const track = document.querySelector('.process-track');
if (track) {
    const io = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                track.classList.add('in-view');
                io.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.4
    });
    io.observe(track);
}


const hiwTrack = document.querySelector('.hiw-track');
if (hiwTrack) {
    const hiwObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                hiwTrack.classList.add('in-view');
                hiwObserver.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.35
    });
    hiwObserver.observe(hiwTrack);
}


const items = document.querySelectorAll('.item');
items.forEach(item => {
    const header = item.querySelector('.item-header');
    const body = item.querySelector('.item-body');
    if (item.classList.contains('open')) {
        body.style.maxHeight = body.scrollHeight + 'px';
    }
    header.addEventListener('click', () => {
        const isOpen = item.classList.contains('open');
        items.forEach(i => {
            i.classList.remove('open');
            i.querySelector('.item-body').style.maxHeight = 0;
        });
        if (!isOpen) {
            item.classList.add('open');
            body.style.maxHeight = body.scrollHeight + 'px';
        }
    });
});
</script>

@endsection
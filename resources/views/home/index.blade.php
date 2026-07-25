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
                <a href="#how-it-works" class="btn btn-outline btn-lg">How It Works</a>
            </div>

            <div class="hero-stats">

            </div>
        </div>

        <div class="hero-visual reveal reveal-delay-1">
            <!-- <div class="hero-blob"></div> -->
            <div class="hero-dots"></div>
            <div class="hero-card">
                <img src="{{ asset('assets/img/hero-team.png') }}" alt="About SkillConnect">
            </div>
</section>



<!-- Stats -->
<!-- <section class="home-stats-section">
    <div class="container">
        <div class="home-stats-grid home-stats-grid-cards">

            <div class="home-stat-card reveal">
                <div class="home-stat-card-icon home-stat-icon-indigo">
                    <svg viewBox="0 0 24 24" fill="none">
                        <circle cx="12" cy="8" r="4" stroke="currentColor" stroke-width="1.8" />
                        <path d="M4 21c0-4.4 3.6-7 8-7s8 2.6 8 7" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" />
                    </svg>
                </div>
                <div class="home-stat-card-body">
                    <span class="home-stat-number" data-count="50000">0</span><span class="home-stat-plus"></span>
                    <p>Active Users</p>
                </div>
            </div>

            <div class="home-stat-card reveal reveal-delay-1">
                <div class="home-stat-card-icon home-stat-icon-blue">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M4 21V8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v13" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M9 21V13h6v8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="home-stat-card-body">
                    <span class="home-stat-number" data-count="12000">0</span><span class="home-stat-plus"></span>
                    <p>Jobs Posted</p>
                </div>
            </div>

            <div class="home-stat-card reveal reveal-delay-2">
                <div class="home-stat-card-icon home-stat-icon-cyan">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M22 10 12 5 2 10l10 5 10-5Z" stroke="currentColor" stroke-width="1.8"
                            stroke-linejoin="round" />
                        <path d="M6 12v5c0 1.7 2.7 3 6 3s6-1.3 6-3v-5" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="home-stat-card-body">
                    <span class="home-stat-number" data-count="3200">0</span><span class="home-stat-plus"></span>
                    <p>Courses Available</p>
                </div>
            </div>

            <div class="home-stat-card reveal reveal-delay-3">
                <div class="home-stat-card-icon home-stat-icon-pink">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M13 2 3 14h7l-1 8 10-12h-7l1-8Z" stroke="currentColor" stroke-width="1.8"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="home-stat-card-body">
                    <span class="home-stat-number" data-count="850">0</span><span class="home-stat-plus"></span>
                    <p>Startups Funded</p>
                </div>
            </div>

        </div>
    </div>
</section> -->



<!-- How It Works -->
<!-- <section class="hiw" id="how-it-works">
    <div class="container">
        <div class="section-head reveal">
            <h2>How It Works</h2>
        </div>

        <div class="hiw-track">

            <div class="hiw-step">
                <div class="hiw-circle">
                    <span>01</span>
                </div>

                <div class="hiw-content">
                    <h3>Create Profile</h3>
                    <p>Sign up and complete your profile.</p>
                </div>
            </div>

            <div class="hiw-line"></div>

            <div class="hiw-step">
                <div class="hiw-circle">
                    <span>02</span>
                </div>

                <div class="hiw-content">
                    <h3>Explore Opportunities</h3>
                    <p>Browse jobs, projects and mentors.</p>
                </div>
            </div>

            <div class="hiw-line"></div>

            <div class="hiw-step">
                <div class="hiw-circle">
                    <span>03</span>
                </div>

                <div class="hiw-content">
                    <h3>Achieve Goals</h3>
                    <p>Apply, learn and grow.</p>
                </div>
            </div>

        </div>


    </div>
</section> -->





<section class="future-section">
    <div class="container future-wrapper">

        <!-- Left Images -->

        <div class="future-images">

            <div class="shape-bg"></div>

            <div class="image-box main-image">
                <img src="{{ asset('assets/img/build.png') }}" alt="">
            </div>

            <!-- <div class="image-box small-image">
                <img src="{{ asset('assets/img/team2.png') }}" alt="">
            </div> -->

            <div class="stats-card">

                <div class="stats-icon">
                    <i class="fas fa-users"></i>
                </div>

                <div>
                    <h3>200k +</h3>
                    <p>Link Up Here More</p>
                </div>

            </div>

        </div>

        <!-- Right Content -->

        <div class="future-content">

            <span class="section-tag">
                Building The Future
            </span>


            <h2 class=".future-content h2">Building The Future With</h2>
            <h2 class=".future-content h2">Cutting-Edge IT Solutions</h2>


            <p>
                At our company, we believe in technology that drives
                innovation and transforms businesses for tomorrow.
            </p>

            <div class="feature-grid">

                <div class="feature-item">
                    ✔ Smart Team Solutions
                </div>

                <div class="feature-item">
                    ✔ Digital Transformation
                </div>

                <div class="feature-item">
                    ✔ Trusted IT Support
                </div>

                <div class="feature-item">
                    ✔ Engine Services
                </div>

                <div class="feature-item">
                    ✔ Security Protection
                </div>

                <div class="feature-item">
                    ✔ Certified Experts
                </div>

            </div>

            <div class="future-buttons">

                <a href="{{ route('membership') }}" class="btn-primary">
                    Discover More
                </a>





            </div>

        </div>

    </div>

    </div>
</section>










<!-- Portals -->
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
                            <a href="#" class="portal-link">
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
                            <a href="#" class="portal-link">
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
                            <a href="#" class="portal-link">
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
                            <a href="#" class="portal-link">
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
                            <a href="#" class="portal-link">
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
                            <a href="#" class="portal-link">
                                Register <span>→</span>
                            </a>
                        </div>
                    </article>

                </div>

            </div>

        </div>

    </div>
</section>



<section class="startup-section">
    <div class="container startup-container">

        <!-- Left Content -->
        <div class="startup-content">

            <h2>
                Providing IT solutions & <br>
                services for startups
            </h2>

            <div class="service-list">

                <div class="service-item">
                    <div class="icon-box">
                        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M12 2L3 7l9 5 9-5-9-5Z" />
                            <path d="M3 17l9 5 9-5" />
                            <path d="M3 12l9 5 9-5" />
                        </svg>
                    </div>

                    <div>
                        <h4>Quality Solution for Business</h4>
                        <p>
                            Each demo built with Web will look different.
                            Customize almost anything in the appearance.
                        </p>
                    </div>
                </div>

                <div class="service-item">
                    <div class="icon-box">
                        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M12 6V12L16 14" />
                            <circle cx="12" cy="12" r="9" />
                        </svg>
                    </div>

                    <div>
                        <h4>Amazing Expert Teams</h4>
                        <p>
                            Each demo built with Web will look different.
                            Customize almost anything in the appearance.
                        </p>
                    </div>
                </div>

                <div class="service-item">
                    <div class="icon-box">
                        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M18 8a6 6 0 0 0-12 0v4" />
                            <path d="M6 12v5h12v-5" />
                        </svg>
                    </div>

                    <div>
                        <h4>Urgent Support For Clients</h4>
                        <p>
                            Each demo built with Web will look different.
                            Customize almost anything in the appearance.
                        </p>
                    </div>
                </div>

            </div>

        </div>

        <!-- Right Images -->
        <div class="startup-images">

            <div class="img-card img-top">
                <img src="{{ asset('assets/img/team1.png') }}" alt="">
            </div>

            <div class="img-card img-bottom">
                <img src="{{ asset('assets/img/team2.png') }}" alt="">
            </div>



            <span class="dots dots-top"></span>
            <span class="dots dots-bottom"></span>

        </div>

    </div>
</section>










<!-- Interactive Role Showcase -->
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

<!-- Testimonials -->
<!-- Role Benefits -->
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




<section class="cta-banner-section">
    <div class="container">
        <div class="cta-banner reveal">
            <div class="cta-banner-stars"></div>
            <div class="cta-banner-rocket"></div>

            <span class="cta-banner-eyebrow">Ready to Get Started</span>
            <h2>Join thousands of professionals and<br>start your journey with SkillConnect today!</h2>

            <div class="cta-banner-actions">
                <a href="registration" class="btn btn-cta-primary">Create Your Account</a>
                <a href="members" class="btn btn-cta-outline">Explore More</a>
            </div>
        </div>
    </div>
</section>





<!-- CTA -->
<!-- <section class="home-cta-banner">
    <div class="container home-cta-inner reveal">
        <h2>Ready to find your next opportunity?</h2>
        <p>Join thousands of employers, students, freelancers, and mentors already growing with SkillConnect.</p>
        <a href="#portals" class="btn btn-primary btn-lg">Join SkillConnect Today</a>
    </div>
</section> -->

<style>
/* Removes the card-style highlight (background/border/shadow) around the
       hero image on this page only, leaving just the plain image. */
.hero .hero-card {
    background: none;
    border: none;
    box-shadow: none;
    padding: 0;
    border-radius: 0;
}

.hero .hero-card img {
    border-radius: 16px;
}

/* Overrides the shared .hero-blob color just for this page */
.hero .hero-blob {
    background: #9fd6ff;
    top: 25px;
}

/* Card-style stats model */
.home-stats-grid-cards {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 18px;
}

.home-stat-card {
    display: flex;
    align-items: center;
    gap: 14px;
    background: #ffffff;
    border: 1px solid #e6e9f2;
    border-radius: 14px;
    padding: 20px 18px;
    box-shadow: 0 2px 8px rgba(15, 23, 42, 0.05);
    transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
}

.home-stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 28px rgba(30, 41, 79, 0.08);
    border-color: #dfe2f5;
}

.home-stat-card-icon {
    flex-shrink: 0;
    width: 44px;
    height: 44px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.home-stat-card-icon svg {
    width: 22px;
    height: 22px;
}

.home-stat-icon-indigo {
    background: #eef2ff;
    color: #4338ca;
}

.home-stat-icon-blue {
    background: #ecfeff;
    color: #0e7490;
}

.home-stat-icon-cyan {
    background: #fffbeb;
    color: #b45309;
}

.home-stat-icon-pink {
    background: #ecfdf5;
    color: #047857;
}

.home-stat-card-body {
    line-height: 1.1;
}

.home-stat-card-body .home-stat-number {
    font-size: 1.7rem;
    font-weight: 800;
    color: #111827;
    letter-spacing: -0.01em;
}

.home-stat-card-body .home-stat-plus {
    font-size: 1.7rem;
    font-weight: 800;
    color: #111827;
}

.home-stat-card-body p {
    margin: 3px 0 0;
    font-size: 0.85rem;
    color: #6b7280;
    font-weight: 500;
}

@media (max-width: 900px) {
    .home-stats-grid-cards {
        grid-template-columns: 1fr 1fr;
    }
}

@media (max-width: 480px) {
    .home-stats-grid-cards {
        grid-template-columns: 1fr;
    }
}
</style>

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
    const statNumbers = document.querySelectorAll('.home-stat-number');
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
</script>

@endsection
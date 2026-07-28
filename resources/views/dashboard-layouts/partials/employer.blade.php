@extends('layouts.app')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

{{-- ============ HERO / WELCOME ============ --}}
<section class="hero ed-hero">
    <div class="container">

        <div class="ed-hero-card">

            <div class="hero-inner ed-hero-inner">

                <div class="hero-copy reveal">
                    <h1>
                        One Hub.<br>
                        <span class="accent-text">Endless Opportunities.</span>
                    </h1>

                    <p class="ed-hero-tagline">Post. Match. Hire. Grow.</p>

                    <p class="hero-sub">
                        SkillConnect helps employers discover skilled professionals, interns,
                        freelancers, and startups to drive your business forward.
                    </p>

                    <div class="hero-actions">
                        <div class="ed-dropdown">
                            <button type="button" class="btn btn-primary btn-lg" id="edPostToggle">Post Opportunity</button>
                            <div class="ed-dropdown-menu" id="edPostMenu">
                                <a href="{{ route('employer.jobs.create') }}">Job</a>
                                <a href="{{ route('employer.internships.create') }}">Internship</a>
                                <a href="{{ route('employer.projects.create') }}">Project</a>
                            </div>
                        </div>
                        <a href="{{ route('employer.jobs.index') }}" class="btn btn-outline-invert btn-lg">View Candidates</a>
                    </div>
                </div>

                <div class="hero-visual ed-hero-visual reveal reveal-delay-1">

                    <div class="ed-illo-frame">
                        <img src="{{ asset('assets/img/employer1.png') }}"
                            alt="Employer and colleague reviewing candidates on a laptop" class="ed-illo-img"
                            onerror="this.closest('.ed-illo-frame').classList.add('ed-illo-empty')">
                        <div class="ed-illo-placeholder">
                            <svg viewBox="0 0 24 24" fill="none" width="36" height="36">
                                <rect x="3" y="3" width="18" height="18" rx="3" stroke="currentColor" stroke-width="1.6" />
                                <circle cx="8.5" cy="8.5" r="1.6" stroke="currentColor" stroke-width="1.6" />
                                <path d="M21 15.5 16 10.5 5 21.5" stroke="currentColor" stroke-width="1.6"
                                    stroke-linejoin="round" />
                            </svg>
                            <p>Add your image at<br><code>public/images/employer-hero.png</code></p>
                        </div>
                    </div>

                    <div class="ed-float-badge ed-float-badge-top">
                        <span class="ed-float-badge-icon ed-float-badge-icon-accent">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5Z"
                                    stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                        <span class="ed-float-badge-text">3 new applicants</span>
                    </div>

                    <div class="ed-float-badge ed-float-badge-bottom">
                        <span class="ed-float-badge-icon">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M9 12.5l2 2 4-4.5" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.8" />
                            </svg>
                        </span>
                        <span class="ed-float-badge-text">Verified Employer</span>
                    </div>
                </div>

            </div>

            <div class="ed-trust-row reveal reveal-delay-1">
                <div class="ed-trust-item">
                    <span class="ed-trust-icon ed-trust-blue">
                        <svg viewBox="0 0 24 24" fill="none">
                            <path d="M4 21V8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v13" stroke="currentColor" stroke-width="1.8"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M9 21V13h6v8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </span>
                    <span class="ed-trust-text">
                        <span class="ed-trust-num">{{ $jobsCount ?? '10,000+' }}</span>
                        <span class="ed-trust-label">Opportunities Posted</span>
                    </span>
                </div>
                <div class="ed-trust-item">
                    <span class="ed-trust-icon ed-trust-green">
                        <svg viewBox="0 0 24 24" fill="none">
                            <circle cx="12" cy="8" r="4" stroke="currentColor" stroke-width="1.8" />
                            <path d="M4 21c0-4.4 3.6-7 8-7s8 2.6 8 7" stroke="currentColor" stroke-width="1.8"
                                stroke-linecap="round" />
                        </svg>
                    </span>
                    <span class="ed-trust-text">
                        <span class="ed-trust-num">2M+</span>
                        <span class="ed-trust-label">Skilled Candidates</span>
                    </span>
                </div>
                <div class="ed-trust-item">
                    <span class="ed-trust-icon ed-trust-purple">
                        <svg viewBox="0 0 24 24" fill="none">
                            <path d="M13 2 3 14h7l-1 8 10-12h-7l1-8Z" stroke="currentColor" stroke-width="1.8"
                                stroke-linejoin="round" />
                        </svg>
                    </span>
                    <span class="ed-trust-text">
                        <span class="ed-trust-num">{{ $hiredCount ?? '3,200+' }}</span>
                        <span class="ed-trust-label">Successful Hires</span>
                    </span>
                </div>
                <div class="ed-trust-item">
                    <span class="ed-trust-icon ed-trust-amber">
                        <svg viewBox="0 0 24 24" fill="none">
                            <path d="M4 21c0-4 2-6 2-6M12 3c3 2 5 6 5 10a5 5 0 0 1-10 0c0-4 2-8 5-10Z" stroke="currentColor"
                                stroke-width="1.8" stroke-linejoin="round" />
                        </svg>
                    </span>
                    <span class="ed-trust-text">
                        <span class="ed-trust-num">850+</span>
                        <span class="ed-trust-label">Startups Funded</span>
                    </span>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- ============ ABOUT US ============ --}}
<section class="ed-about-section">
    <div class="container">
        <div class="ed-about-grid reveal">

            <div class="ed-about-copy">
                <p class="ed-about-eyebrow">Employer Dashboard</p>

                <h2>Manage Hiring, Internships<br>and Startup Growth</h2>

                <p class="ed-about-description">
                    Connect with talented professionals, post opportunities, manage startup profiles,
                    and discover the right candidates for your organization—all from one powerful platform.
                </p>

                <div class="ed-about-list">

                    <div class="ed-about-item">
                        <span class="ed-about-check">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M5 12.5l4.5 4.5L19 7"
                                    stroke="currentColor"
                                    stroke-width="2.2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </span>
                        <div>
                            <h4>Post Jobs & Internships</h4>
                            <p>Create job openings and internship programs to attract skilled candidates.</p>
                        </div>
                    </div>

                    <div class="ed-about-item">
                        <span class="ed-about-check">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M5 12.5l4.5 4.5L19 7"
                                    stroke="currentColor"
                                    stroke-width="2.2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </span>
                        <div>
                            <h4>Review Applications</h4>
                            <p>Browse candidate profiles, evaluate applications, and shortlist talent.</p>
                        </div>
                    </div>

                    <div class="ed-about-item">
                        <span class="ed-about-check">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M5 12.5l4.5 4.5L19 7"
                                    stroke="currentColor"
                                    stroke-width="2.2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </span>
                        <div>
                            <h4>Manage Projects & Startups</h4>
                            <p>Showcase your startup, publish projects, and collaborate with professionals.</p>
                        </div>
                    </div>

                </div>

                <a href="#" class="btn btn-primary ed-about-btn">
                    Explore Employer Features
                </a>
            </div>

            <div class="ed-about-image">
                <img src="{{ asset('assets/img/uvu.png') }}"
                    alt="Employer dashboard">
            </div>

            <div class="ed-about-features">

              <div class="ed-about-feature">
    <span class="ed-about-feature-icon">
        <i class="fas fa-briefcase"></i>
    </span>
    <span class="ed-about-feature-label">Job Posting</span>
</div>

<div class="ed-about-feature">
    <span class="ed-about-feature-icon">
        <i class="fas fa-graduation-cap"></i>
    </span>
    <span class="ed-about-feature-label">Internships</span>
</div>

<div class="ed-about-feature">
    <span class="ed-about-feature-icon">
        <i class="fas fa-users"></i>
    </span>
    <span class="ed-about-feature-label">View Candidates</span>
</div>

<div class="ed-about-feature">
    <span class="ed-about-feature-icon">
        <i class="fas fa-rocket"></i>
    </span>
    <span class="ed-about-feature-label">Startup Profile</span>
</div>

<div class="ed-about-feature">
    <span class="ed-about-feature-icon">
        <i class="fas fa-folder-open"></i>
    </span>
    <span class="ed-about-feature-label">Projects</span>
</div>

<div class="ed-about-feature">
    <span class="ed-about-feature-icon">
        <i class="fas fa-chart-line"></i>
    </span>
    <span class="ed-about-feature-label">Application Tracking</span>
</div>

            </div>

        </div>
    </div>
</section>

@if (session('success'))
<div class="container">
    <div class="alert alert-success ed-alert-inline">{{ session('success') }}</div>
</div>
@endif


{{-- ============ WHY SKILLCONNECT ============ --}}
<section class="ed-why-section">
    <div class="container">
        <div class="ed-why-card reveal">
            <div class="ed-why-copy">
                <p class="ed-why-eyebrow">Why SkillConnect</p>
                <h2>Building a Stronger<br>Hiring Community Together</h2>
                <p class="ed-why-sub">Our employer tools and matching technology help you connect with the right talent
                    quickly and efficiently.</p>

                <div class="ed-why-grid">
                    <div class="ed-why-item">
                        <span class="ed-why-icon ed-why-blue"><svg viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M12 3v3M12 18v3M4.2 4.2l2.1 2.1M17.7 17.7l2.1 2.1M3 12h3M18 12h3M4.2 19.8l2.1-2.1M17.7 6.3l2.1-2.1"
                                    stroke="currentColor" stroke-width="1.7" stroke-linecap="round" />
                                <circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="1.7" />
                            </svg></span>
                        <div>
                            <h3>Smart Matching</h3>
                            <p>Our AI matches you with the most relevant candidates.</p>
                        </div>
                    </div>
                    <div class="ed-why-item">
                        <span class="ed-why-icon ed-why-green"><svg viewBox="0 0 24 24" fill="none">
                                <path d="M9 12l2 2 4-4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.7" />
                            </svg></span>
                        <div>
                            <h3>Quality Applications</h3>
                            <p>Get applications from verified, skilled professionals.</p>
                        </div>
                    </div>
                    <div class="ed-why-item">
                        <span class="ed-why-icon ed-why-purple"><svg viewBox="0 0 24 24" fill="none">
                                <circle cx="9" cy="8" r="3" stroke="currentColor" stroke-width="1.7" />
                                <circle cx="17" cy="9" r="2.4" stroke="currentColor" stroke-width="1.7" />
                                <path d="M3.5 20c.4-3.3 2.7-5.5 5.5-5.5s5.1 2.2 5.5 5.5M14.5 15.2c2 .2 3.6 1.9 3.9 4.3"
                                    stroke="currentColor" stroke-width="1.7" stroke-linecap="round" />
                            </svg></span>
                        <div>
                            <h3>Easy Collaboration</h3>
                            <p>Manage your hiring process with your team seamlessly.</p>
                        </div>
                    </div>
                    <div class="ed-why-item">
                        <span class="ed-why-icon ed-why-amber"><svg viewBox="0 0 24 24" fill="none">
                                <path d="M12 3l7 3v5c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V6l7-3Z" stroke="currentColor"
                                    stroke-width="1.7" stroke-linejoin="round" />
                                <path d="M9.5 12l1.8 1.8L15 10" stroke="currentColor" stroke-width="1.7"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg></span>
                        <div>
                            <h3>Secure &amp; Reliable</h3>
                            <p>Your data and hiring process are safe with us.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ed-why-stats">
                <div class="ed-why-stat">
                    <span class="ed-why-stat-icon ed-why-stat-blue"><svg viewBox="0 0 24 24" fill="none">
                            <circle cx="12" cy="8" r="4" stroke="currentColor" stroke-width="1.8" />
                            <path d="M4 21c0-4.4 3.6-7 8-7s8 2.6 8 7" stroke="currentColor" stroke-width="1.8"
                                stroke-linecap="round" />
                        </svg></span>
                    <span class="ed-why-stat-num">10,000+</span>
                    <span class="ed-why-stat-label">Companies</span>
                </div>
                <div class="ed-why-stat">
                    <span class="ed-why-stat-icon ed-why-stat-green"><svg viewBox="0 0 24 24" fill="none">
                            <path
                                d="M17 20h5v-1a4 4 0 0 0-3-3.9M9 20H4v-1a4 4 0 0 1 3-3.9m5-2.1a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z"
                                stroke="currentColor" stroke-width="1.7" stroke-linejoin="round" />
                        </svg></span>
                    <span class="ed-why-stat-num">2M+</span>
                    <span class="ed-why-stat-label">Candidates</span>
                </div>
                <div class="ed-why-stat">
                    <span class="ed-why-stat-icon ed-why-stat-amber"><svg viewBox="0 0 24 24" fill="none">
                            <path d="M4 21V8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v13" stroke="currentColor" stroke-width="1.7"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M9 21V13h6v8" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg></span>
                    <span class="ed-why-stat-num">{{ $jobsCount ?? '100K+' }}</span>
                    <span class="ed-why-stat-label">Jobs Posted</span>
                </div>
                <div class="ed-why-stat">
                    <span class="ed-why-stat-icon ed-why-stat-purple"><svg viewBox="0 0 24 24" fill="none">
                            <path d="M9 12.5l2 2 4-4.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.7" />
                        </svg></span>
                    <span class="ed-why-stat-num">{{ $hiredCount ?? '50K+' }}</span>
                    <span class="ed-why-stat-label">Hires Made</span>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- ============ EXCLUSIVE BENEFITS BANNER ============ --}}
<section class="ed-benefits-section">
    <div class="container">
        <div class="ed-benefits-card reveal">
            <div class="ed-benefits-copy">
                <!-- <span class="ed-benefits-badge">For Employers</span> -->
                <h2>Exclusive Benefits for Our Members</h2>
                <ul class="ed-benefits-list">
                    <li>
                        <span class="ed-benefits-check"><svg viewBox="0 0 24 24" fill="none">
                                <path d="M5 12.5l4.5 4.5L19 7" stroke="currentColor" stroke-width="2.2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg></span>
                        Priority placement across job, internship &amp; project listings
                    </li>
                    <li>
                        <span class="ed-benefits-check"><svg viewBox="0 0 24 24" fill="none">
                                <path d="M5 12.5l4.5 4.5L19 7" stroke="currentColor" stroke-width="2.2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg></span>
                        Access to a fully verified candidate pool
                    </li>
                    <li>
                        <span class="ed-benefits-check"><svg viewBox="0 0 24 24" fill="none">
                                <path d="M5 12.5l4.5 4.5L19 7" stroke="currentColor" stroke-width="2.2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg></span>
                        Dedicated support for your hiring team
                    </li>
                    <li>
                        <span class="ed-benefits-check"><svg viewBox="0 0 24 24" fill="none">
                                <path d="M5 12.5l4.5 4.5L19 7" stroke="currentColor" stroke-width="2.2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg></span>
                        Advanced filtering &amp; applicant analytics
                    </li>
                </ul>
            </div>
            <div class="ed-benefits-cta-card">
                <h3>Ready to Get Started?</h3>
                <p>Post your first opportunity and start meeting qualified candidates today.</p>
                <a href="{{ route('employer.jobs.create') }}" class="btn btn-primary btn-lg ed-benefits-btn">Post an
                    Opportunity</a>
            </div>
        </div>
    </div>
</section>


{{-- ============ COMPREHENSIVE SERVICES / QUICK ACTIONS ============ --}}
<section class="ed-quickstrip-section">
    <div class="container">
        <div class="section-head reveal">
            <h2>Comprehensive Services For Your Growth</h2>
            <p>Everything you need to hire, manage and grow your team in one place.</p>
        </div>

        <div class="ed-quickstrip reveal">

            <a href="{{ route('employer.jobs.create') }}" class="ed-quickstrip-item">
                <span class="ed-quickstrip-icon ed-quickstrip-blue">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M4 21V8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v13" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M9 21V13h6v8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </span>
                <span class="ed-quickstrip-title">Post a Job</span>
                <span class="ed-quickstrip-sub">Find the perfect full-time talent.</span>
                <span class="ed-quickstrip-cta">Get Started <span aria-hidden="true">→</span></span>
            </a>

            <a href="{{ route('employer.internships.create') }}" class="ed-quickstrip-item">
                <span class="ed-quickstrip-icon ed-quickstrip-green">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M22 10 12 5 2 10l10 5 10-5Z" stroke="currentColor" stroke-width="1.8"
                            stroke-linejoin="round" />
                        <path d="M6 12v5c0 1.7 2.7 3 6 3s6-1.3 6-3v-5" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </span>
                <span class="ed-quickstrip-title">Post an Internship</span>
                <span class="ed-quickstrip-sub">Hire enthusiastic interns.</span>
                <span class="ed-quickstrip-cta">Get Started <span aria-hidden="true">→</span></span>
            </a>

            <a href="{{ route('employer.projects.create') }}" class="ed-quickstrip-item">
                <span class="ed-quickstrip-icon ed-quickstrip-purple">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M13 2 3 14h7l-1 8 10-12h-7l1-8Z" stroke="currentColor" stroke-width="1.8"
                            stroke-linejoin="round" />
                    </svg>
                </span>
                <span class="ed-quickstrip-title">Post a Project</span>
                <span class="ed-quickstrip-sub">Find skilled freelancers for your projects.</span>
                <span class="ed-quickstrip-cta">Get Started <span aria-hidden="true">→</span></span>
            </a>

            <a href="{{ route('employer.startup-profile.create') }}" class="ed-quickstrip-item">
                <span class="ed-quickstrip-icon ed-quickstrip-amber">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M4 21c0-4 2-6 2-6M12 3c3 2 5 6 5 10a5 5 0 0 1-10 0c0-4 2-8 5-10Z" stroke="currentColor"
                            stroke-width="1.8" stroke-linejoin="round" />
                    </svg>
                </span>
                <span class="ed-quickstrip-title">Startup Profile</span>
                <span class="ed-quickstrip-sub">Showcase your startup to the right people.</span>
                <span class="ed-quickstrip-cta">Get Started <span aria-hidden="true">→</span></span>
            </a>

            <a href="{{ route('employer.jobs.index') }}" class="ed-quickstrip-item">
                <span class="ed-quickstrip-icon ed-quickstrip-cyan">
                    <svg viewBox="0 0 24 24" fill="none">
                        <circle cx="12" cy="8" r="4" stroke="currentColor" stroke-width="1.8" />
                        <path d="M4 21c0-4.4 3.6-7 8-7s8 2.6 8 7" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" />
                    </svg>
                </span>
                <span class="ed-quickstrip-title">Search Candidates</span>
                <span class="ed-quickstrip-sub">Search from millions of verified profiles.</span>
                <span class="ed-quickstrip-cta">Search Now <span aria-hidden="true">→</span></span>
            </a>

        </div>
    </div>
</section>


{{-- ============ STARTUP SPOTLIGHT ============ --}}
<section class="ed-startup-section">
    <div class="container">
        <div class="ed-startup-card reveal">
            <div class="ed-startup-copy">
                <!-- <span class="ed-startup-badge">🚀 For Startups</span> -->
                <h2>Fundraising too? Get in front of investors.</h2>
                <p>List your startup on SkillConnect's Investor Portal alongside your job postings, and reach backers
                    actively looking for companies like yours.</p>
            </div>
            <div class="ed-startup-actions">
                <a href="#" class="btn btn-lg">List Your Startup</a>
            </div>
        </div>
    </div>
</section>

{{-- ============ RECENT POSTINGS ============ --}}
<section class="ed-recent-section" id="recent-postings">
    <div class="container">
        <div class="section-head reveal">
            <h2>Recent Postings</h2>
            <p>The latest jobs, internships and projects from your company.</p>
        </div>

        @php
        // Jobs go through admin approval — only show approved jobs here.
        // Internships/projects (no approval workflow) pass through unchanged.
        $visiblePostings = ($recentPostings ?? collect())->filter(function ($posting) {
        if ($posting->posting_type === 'job') {
        return $posting->status === 'approved';
        }
        return true;
        })->values();
        @endphp

        <div class="listing-table-wrap reveal">
            <table class="listing-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Posted</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($visiblePostings as $posting)
                    <tr>
                        <td class="cell-title">{{ $posting->title }}</td>
                        <td><span
                                class="ed-type-pill ed-type-{{ $posting->posting_type }}">{{ ucfirst($posting->posting_type) }}</span>
                        </td>
                        <td>{{ $posting->city }}, {{ $posting->state }}</td>
                        <td>
                            <span
                                class="badge badge-{{ in_array($posting->status, ['active','open','approved']) ? 'green' : 'gray' }}">
                                {{ ucfirst($posting->status) }}
                            </span>
                        </td>
                        <td>{{ $posting->created_at->diffForHumans() }}</td>
                        <td class="text-right actions-cell">
                            <a href="{{ route('employer.' . $posting->posting_type . 's.show', $posting) }}"
                                class="action-link">View</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="empty-state">
                            Nothing posted yet. Use "New Posting" above to publish your first job, internship or
                            project.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="pagination-wrapper">
               {{ $recentPostings->fragment('recent-postings')->links() }}
            </div>
        </div>
    </div>
</section>

{{-- ============ LATEST OPPORTUNITIES & UPCOMING EVENTS ============ --}}
<section class="ed-feed-section">
    <div class="container">
        <div class="ed-feed-grid">

            {{-- Latest Job Opportunities --}}
            <div class="ed-feed-card reveal">
                <div class="ed-feed-head">
                    <h2>Latest Job Opportunities</h2>
                    <a href="{{ route('employer.jobs.index') }}" class="ed-feed-viewall">View All Jobs <span
                            aria-hidden="true">→</span></a>
                </div>

                <div class="ed-feed-list">
                    @forelse (($latestJobs ?? collect()) as $job)
                    <div class="ed-job-row">
                        <span class="ed-job-logo"
                            style="background:{{ $job->logo_color ?? '#eeeafd' }}; color:{{ $job->logo_text_color ?? '#4338ca' }};">{{ strtoupper(substr($job->company_name ?? $job->title, 0, 1)) }}</span>
                        <div class="ed-job-info">
                            <p class="ed-job-title">{{ $job->title }}</p>
                            <p class="ed-job-meta">{{ $job->company_name ?? '—' }} &middot; {{ $job->city }},
                                {{ $job->state }}</p>
                        </div>
                        <div class="ed-job-side">
                            <span class="ed-job-salary">{{ $job->salary_range ?? '—' }}</span>
                            <span class="ed-job-type">{{ $job->employment_type ?? 'Full time' }}</span>
                        </div>
                        <a href="{{ route('employer.jobs.show', $job) }}" class="btn btn-outline ed-feed-btn">Apply
                            Now</a>
                    </div>
                    @empty
                    {{-- Sample rows shown until live data is wired up --}}
                    <div class="ed-job-row">
                        <span class="ed-job-logo" style="background:#eeeafd; color:#4338ca;">G</span>
                        <div class="ed-job-info">
                            <p class="ed-job-title">Senior Software Engineer</p>
                            <p class="ed-job-meta">Google &middot; Bangalore, India</p>
                        </div>
                        <div class="ed-job-side">
                            <span class="ed-job-salary">₹15L - 25L</span>
                            <span class="ed-job-type">Full time</span>
                        </div>
                        <a href="#" class="btn btn-outline ed-feed-btn">Apply Now</a>
                    </div>
                    <div class="ed-job-row">
                        <span class="ed-job-logo" style="background:#ecfeff; color:#0e7490;">M</span>
                        <div class="ed-job-info">
                            <p class="ed-job-title">Frontend Developer</p>
                            <p class="ed-job-meta">Microsoft &middot; Remote</p>
                        </div>
                        <div class="ed-job-side">
                            <span class="ed-job-salary">₹8L - 15L</span>
                            <span class="ed-job-type">Full time</span>
                        </div>
                        <a href="#" class="btn btn-outline ed-feed-btn">Apply Now</a>
                    </div>
                    <div class="ed-job-row">
                        <span class="ed-job-logo" style="background:#fff1e8; color:#c2410c;">A</span>
                        <div class="ed-job-info">
                            <p class="ed-job-title">DevOps Engineer</p>
                            <p class="ed-job-meta">Amazon &middot; Hyderabad, India</p>
                        </div>
                        <div class="ed-job-side">
                            <span class="ed-job-salary">₹10L - 18L</span>
                            <span class="ed-job-type">Full time</span>
                        </div>
                        <a href="#" class="btn btn-outline ed-feed-btn">Apply Now</a>
                    </div>
                    <div class="ed-job-row">
                        <span class="ed-job-logo" style="background:#f4f0ff; color:#7c3aed;">R</span>
                        <div class="ed-job-info">
                            <p class="ed-job-title">React Developer</p>
                            <p class="ed-job-meta">Meta &middot; Bangalore, India</p>
                        </div>
                        <div class="ed-job-side">
                            <span class="ed-job-salary">₹12L - 20L</span>
                            <span class="ed-job-type">Full time</span>
                        </div>
                        <a href="#" class="btn btn-outline ed-feed-btn">Apply Now</a>
                    </div>
                    @endforelse
                </div>
            </div>

            {{-- Upcoming Events --}}
            <div class="ed-feed-card reveal reveal-delay-1">
                <div class="ed-feed-head">
                    <h2>Upcoming Events</h2>
                    <a href="#" class="ed-feed-viewall">View All Events <span aria-hidden="true">→</span></a>
                </div>

                <div class="ed-feed-list">
                    @forelse (($upcomingEvents ?? collect()) as $event)
                    <div class="ed-event-row">
                        <span class="ed-event-date">
                            <span class="ed-event-month">{{ $event->starts_at->format('M') }}</span>
                            <span class="ed-event-day">{{ $event->starts_at->format('d') }}</span>
                        </span>
                        <div class="ed-event-info">
                            <p class="ed-event-title">{{ $event->title }}</p>
                            <p class="ed-event-meta">{{ $event->starts_at->format('g:i A') }} &middot;
                                {{ $event->location }}</p>
                        </div>
                        <a href="{{ $event->url ?? '#' }}" class="btn btn-outline ed-feed-btn">Register</a>
                    </div>
                    @empty
                    {{-- Sample rows shown until live data is wired up --}}
                    <div class="ed-event-row">
                        <span class="ed-event-date"><span class="ed-event-month">Jan</span><span
                                class="ed-event-day">15</span></span>
                        <div class="ed-event-info">
                            <p class="ed-event-title">AI &amp; Future of Technology Conference 2024</p>
                            <p class="ed-event-meta">10:00 AM - 5:00 PM &middot; Bangalore, India</p>
                        </div>
                        <a href="#" class="btn btn-outline ed-feed-btn">Register</a>
                    </div>
                    <div class="ed-event-row">
                        <span class="ed-event-date"><span class="ed-event-month">Jan</span><span
                                class="ed-event-day">22</span></span>
                        <div class="ed-event-info">
                            <p class="ed-event-title">Web Development Workshop</p>
                            <p class="ed-event-meta">1:00 PM - 4:00 PM &middot; Online</p>
                        </div>
                        <a href="#" class="btn btn-outline ed-feed-btn">Register</a>
                    </div>
                    <div class="ed-event-row">
                        <span class="ed-event-date"><span class="ed-event-month">Jan</span><span
                                class="ed-event-day">28</span></span>
                        <div class="ed-event-info">
                            <p class="ed-event-title">Cybersecurity Seminar</p>
                            <p class="ed-event-meta">9:00 AM - 12:00 PM &middot; Delhi, India</p>
                        </div>
                        <a href="#" class="btn btn-outline ed-feed-btn">Register</a>
                    </div>
                    <div class="ed-event-row">
                        <span class="ed-event-date"><span class="ed-event-month">Feb</span><span
                                class="ed-event-day">05</span></span>
                        <div class="ed-event-info">
                            <p class="ed-event-title">Startup Networking Meetup</p>
                            <p class="ed-event-meta">5:00 PM - 8:00 PM &middot; Mumbai, India</p>
                        </div>
                        <a href="#" class="btn btn-outline ed-feed-btn">Register</a>
                    </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ============ TIPS ============ --}}
<section class="ed-tips-section">
    <div class="container">
        <div class="section-head reveal">
            <h2>Tips to Get Noticed Faster</h2>
            <p>Small changes that make a big difference in applicant quality.</p>
        </div>

        <div class="ed-tips-grid">
            <div class="ed-tip-card reveal">
                <div class="ed-tip-icon">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M4 20h4l10-10-4-4L4 16v4Z" stroke="currentColor" stroke-width="1.7"
                            stroke-linejoin="round" />
                        <path d="M13 6l4 4" stroke="currentColor" stroke-width="1.7" />
                    </svg>
                </div>
                <h3>Write clear titles</h3>
                <p>Specific job titles attract noticeably more qualified applicants than vague ones.</p>
            </div>
            <div class="ed-tip-card reveal reveal-delay-1">
                <div class="ed-tip-icon">
                    <svg viewBox="0 0 24 24" fill="none">
                        <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.7" />
                        <path d="M9.5 15c.5 1 1.4 1.5 2.5 1.5s2-.5 2.5-1.5M9.5 9h.01M14.5 9h.01" stroke="currentColor"
                            stroke-width="1.7" stroke-linecap="round" />
                    </svg>
                </div>
                <h3>Share a salary range</h3>
                <p>Postings with a visible pay range get opened more often and close faster.</p>
            </div>
            <div class="ed-tip-card reveal reveal-delay-2">
                <div class="ed-tip-icon">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M13 2 3 14h7l-1 8 10-12h-7l1-8Z" stroke="currentColor" stroke-width="1.7"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <h3>Reply within 48 hours</h3>
                <p>Fast responses keep strong candidates from accepting offers elsewhere.</p>
            </div>
        </div>
    </div>
</section>



<style>
/* ============================================================
   SkillConnect · Employer Hub
   Palette: deep indigo + warm coral signature accent
   Type: Sora (display) / Inter (body & data)
   ============================================================ */
:root {
    --ed-ink: #15172E;
    --ed-ink-soft: #3D4066;
    --ed-muted: #6C7089;
    --ed-line: #E7E8F3;
    --ed-primary: #3760d1;
    --ed-primary-dark: #1E52E3;
    --ed-primary-soft: #EEEAFD;
    --ed-accent: #3760d1;
    --ed-accent-dark:#3760d1;
    --ed-accent-soft: #f0e1ff;
    --ed-surface: #ffffff;
    --ed-surface-soft: #F7F7FC;
    --ed-radius-lg: 22px;
    --ed-radius-md: 15px;
    --ed-shadow-sm: 0 2px 10px rgba(21, 23, 46, 0.06);
    --ed-shadow-md: 0 16px 34px rgba(30, 26, 90, 0.10);
    --font-display: 'Sora', 'Inter', system-ui, sans-serif;
    --font-body: 'Inter', system-ui, sans-serif;
}

.ed-hero, .ed-why-section, .ed-benefits-section, .ed-quickstrip-section,
.ed-startup-section, .ed-recent-section, .ed-feed-section, .ed-tips-section {
    font-family: var(--font-body);
}

.ed-hero h1, .ed-hero h2, .ed-why-card h2, .ed-why-item h3, .ed-benefits-copy h2,
.ed-benefits-cta-card h3, .ed-startup-copy h2, .section-head h2,
.ed-quickstrip-title, .ed-job-title, .ed-event-title, .ed-tip-card h3,
.ed-why-stat-num, .ed-trust-num {
    font-family: var(--font-display);
}

/* ---------- Hero ---------- */
.ed-hero {
    padding-top: 44px;
    padding-bottom: 8px;
    overflow: visible !important;
    position: relative;
    z-index: 100;
}

/* Plain hero panel — no card styling, just a flat container */
.ed-hero-card {
    position: relative;
    background: transparent;
    border: none;
    border-radius: 0;
    padding: 0;
    overflow: visible;
    box-shadow: none;
}

.ed-hero-inner {
    align-items: center;
    overflow: visible;
    position: relative;
    z-index: 1;
    padding: 20px 0 36px;
}

.ed-hero .hero-sub {
    max-width: 440px;
    color: var(--ed-muted);
    font-size: 1rem;
    line-height: 1.65;
    margin-top: 16px;
}

.ed-hero-tagline {
    display: inline-block;
    font-family: var(--font-display);
    font-weight: 700;
    font-size: 1.1rem;
    letter-spacing: -0.01em;
    color: var(--ed-primary);
    margin-top: 10px;
}

.ed-hero h1 {
    font-weight: 800;
    letter-spacing: -0.03em;
    line-height: 1.14;
    color: var(--ed-ink);
    font-size: 2.65rem;
}

.ed-hero h1 .accent-text {
    color: var(--ed-primary);
}

.hero-copy.reveal {
    overflow: visible !important;
    position: relative;
    z-index: 1;
}

.ed-hero-inner.container,
.ed-hero .container {
    overflow: visible !important;
}

.hero-actions {
    display: flex;
    gap: 12px;
    margin-top: 30px;
}

.btn-lg {
    padding: 13px 24px;
    border-radius: 12px;
    font-weight: 700;
    font-size: 0.95rem;
    font-family: var(--font-body);
}

/* Primary CTA: confident indigo gradient */
.btn-primary {
    background: linear-gradient(135deg, var(--ed-primary) 0%, var(--ed-primary-dark) 100%);
    border: 1px solid var(--ed-primary-dark);
    color: #fff;
    box-shadow: 0 10px 22px rgba(67, 56, 202, 0.28);
    transition: transform 0.15s ease, box-shadow 0.15s ease, background 0.15s ease;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #4c40e0 0%, var(--ed-primary-dark) 100%);
    transform: translateY(-2px);
    box-shadow: 0 14px 26px rgba(67, 56, 202, 0.34);
}

.btn-primary:active {
    transform: scale(0.97);
}

.btn-outline {
    border: 1.5px solid var(--ed-line);
    color: var(--ed-ink);
    background: #fff;
    transition: border-color 0.15s ease, transform 0.15s ease, color 0.15s ease;
}

.btn-outline:hover {
    border-color: var(--ed-primary);
    color: var(--ed-primary);
    transform: translateY(-2px);
}

.btn-outline:active {
    transform: scale(0.97);
}

/* Outline button variant (kept for compatibility, resolves to the same light look) */
.btn-outline-invert {
    border: 1.5px solid var(--ed-line);
    color: var(--ed-ink);
    background: #ffffff;
    transition: border-color 0.15s ease, transform 0.15s ease, background 0.15s ease;
}

.btn-outline-invert:hover {
    border-color: var(--ed-primary);
    color: var(--ed-primary);
    transform: translateY(-2px);
}

.btn-outline-invert:active { transform: scale(0.97); }

.ed-dropdown {
    position: relative;
    display: inline-block;
    z-index: 50;
}

.ed-dropdown-menu {
    display: none;
    position: absolute;
    left: 0;
    top: calc(100% + 10px);
    background: #ffffff;
    opacity: 1;
    border: 1px solid var(--ed-line);
    border-radius: 14px;
    box-shadow: var(--ed-shadow-md);
    min-width: 190px;
    z-index: 99999;
    pointer-events: auto;
    overflow: hidden;
}

.ed-dropdown-menu.is-open {
    display: block;
    animation: edMenuIn 0.16s ease;
}

@keyframes edMenuIn {
    from { opacity: 0; transform: translateY(-6px); }
    to { opacity: 1; transform: translateY(0); }
}

.ed-dropdown-menu a {
    display: block;
    padding: 13px 18px;
    font-size: 0.88rem;
    font-weight: 600;
    color: var(--ed-ink-soft);
    text-decoration: none;
    position: relative;
    z-index: 1;
    pointer-events: auto;
    background: #fff;
    border-left: 3px solid transparent;
    transition: background 0.12s ease, color 0.12s ease, border-color 0.12s ease, padding-left 0.12s ease;
}

.ed-dropdown-menu a:hover {
    background: var(--ed-surface-soft);
    color: var(--ed-primary);
    border-left-color: var(--ed-accent);
    padding-left: 22px;
}

.ed-alert-inline {
    margin: 24px auto 0;
    max-width: 1100px;
    border-radius: 14px;
}

/* Stat pills — sit inline below the hero content */
.ed-trust-row {
    display: flex;
    flex-wrap: wrap;
    align-items: stretch;
    gap: 14px;
    position: relative;
    z-index: 1;
    padding: 0 0 40px;
}

.ed-trust-item {
    display: flex;
    align-items: center;
    gap: 11px;
    background: #ffffff;
    border: 1px solid #ECEEFA;
    border-radius: 14px;
    padding: 12px 18px;
    box-shadow: 0 8px 20px rgba(67, 56, 202, 0.07);
    flex: 1 1 200px;
}

.ed-trust-text {
    display: flex;
    flex-direction: column;
    gap: 1px;
}

.ed-trust-divider { display: none; }

.ed-trust-icon {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.ed-trust-icon svg {
    width: 17px;
    height: 17px;
}

.ed-trust-blue { background: var(--ed-primary-soft); color: var(--ed-primary-dark); }
.ed-trust-green { background: #E9FBF2; color: #0E8A5E; }
.ed-trust-purple { background: #F5EEFF; color: #8A3FE0; }
.ed-trust-amber { background: var(--ed-accent-soft); color: var(--ed-accent-dark); }

.ed-trust-num {
    font-size: 1.08rem;
    font-weight: 800;
    color: var(--ed-ink);
    letter-spacing: -0.02em;
    line-height: 1.2;
    white-space: nowrap;
}

.ed-trust-label {
    font-size: 0.74rem;
    color: var(--ed-muted);
    font-weight: 500;
    white-space: nowrap;
}

@media (max-width: 900px) {
    .ed-trust-row { padding: 0 0 30px; }
    .ed-trust-item { flex: 1 1 40%; }
}

@media (max-width: 560px) {
    .ed-trust-item { flex: 1 1 100%; }
}

/* Hero visual */
.ed-hero-visual {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 300px;
}

.ed-illo-frame {
    border: none !important;
    box-shadow: none !important;
    background: transparent !important;
    padding: 0;
    overflow: visible;
    max-width: 420px;
    margin: 0 auto;
}

.ed-illo-img {
    width: 100%;
    height: auto;
    display: block;
    border: none;
    box-shadow: none;
}

.ed-illo-placeholder {
    display: none;
    flex-direction: column;
    align-items: center;
    gap: 10px;
    color: #94a3b8;
    text-align: center;
    padding: 30px 20px;
    font-size: 0.8rem;
    line-height: 1.5;
    background: rgba(67, 56, 202, 0.04);
    border: 1px dashed #DAD8F7;
    border-radius: 20px;
}

.ed-illo-placeholder code {
    background: #fff;
    padding: 2px 6px;
    border-radius: 6px;
    color: var(--ed-primary);
    font-size: 0.75rem;
}

.ed-illo-frame.ed-illo-empty .ed-illo-img { display: none; }
.ed-illo-frame.ed-illo-empty .ed-illo-placeholder { display: flex; }

@media (max-width: 900px) {
    .ed-hero-visual { order: -1; min-height: 260px; }
    .ed-illo-frame { max-width: 320px; }
}

/* Floating badges over the illustration */
.ed-float-badge {
    position: absolute;
    z-index: 5;
    display: inline-flex;
    align-items: center;
    gap: 9px;
    background: #ffffff;
    border-radius: 999px;
    box-shadow: 0 12px 26px rgba(67, 56, 202, 0.16);
    padding: 10px 18px 10px 11px;
}

.ed-float-badge-top {
    top: 6%;
    right: 2%;
}

.ed-float-badge-bottom {
    bottom: 6%;
    left: 0;
}

.ed-float-badge-icon {
    width: 26px;
    height: 26px;
    border-radius: 50%;
    background: #E9FBF2;
    color: #0E8A5E;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.ed-float-badge-icon-accent {
    background: var(--ed-accent-soft);
    color: var(--ed-accent-dark);
}

.ed-float-badge-icon svg { width: 14px; height: 14px; }

.ed-float-badge-text {
    font-size: 0.81rem;
    font-weight: 700;
    color: var(--ed-ink);
    white-space: nowrap;
}

@media (max-width: 640px) {
    .ed-float-badge-text { display: none; }
    .ed-float-badge { padding: 10px; }
}

/* ---------- About Us ---------- */
.ed-about-section { padding: 12px 0 44px; }

.ed-about-grid {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 30px;
    align-items: center;
}

.ed-about-eyebrow {
    font-size: 0.76rem;
    font-weight: 700;
    color: var(--ed-primary);
    text-transform: uppercase;
    letter-spacing: 0.06em;
    margin-bottom: 10px;
}

.ed-about-copy h2 {
    font-size: 1.5rem;
    font-weight: 800;
    letter-spacing: -0.02em;
    line-height: 1.25;
    margin-bottom: 22px;
    color: var(--ed-ink);
}

.ed-about-list {
    display: flex;
    flex-direction: column;
    gap: 18px;
    margin-bottom: 26px;
}

.ed-about-item {
    display: flex;
    gap: 12px;
    align-items: flex-start;
}

.ed-about-check {
    flex-shrink: 0;
    width: 22px;
    height: 22px;
    border-radius: 50%;
    background: var(--ed-primary-soft);
    color: var(--ed-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 2px;
}

.ed-about-check svg { width: 12px; height: 12px; }

.ed-about-item h4 {
    font-size: 0.92rem;
    font-weight: 700;
    color: var(--ed-ink);
    margin-bottom: 3px;
}

.ed-about-item p {
    font-size: 0.83rem;
    color: var(--ed-muted);
    line-height: 1.55;
}

.ed-about-btn { display: inline-flex; }

.ed-about-image {
    position: relative;
    border-radius: var(--ed-radius-lg);
    overflow: hidden;
    box-shadow: var(--ed-shadow-md);
    aspect-ratio: 4 / 3;
    background: var(--ed-surface-soft);
}

.ed-about-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.ed-about-image-placeholder {
    display: none;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 10px;
    color: #94a3b8;
    text-align: center;
    padding: 30px 20px;
    font-size: 0.8rem;
    line-height: 1.5;
    height: 100%;
    background: rgba(67, 56, 202, 0.04);
    border: 1px dashed #DAD8F7;
}

.ed-about-image-placeholder code {
    background: #fff;
    padding: 2px 6px;
    border-radius: 6px;
    color: var(--ed-primary);
    font-size: 0.75rem;
}

.ed-about-image.ed-about-image-empty img { display: none; }
.ed-about-image.ed-about-image-empty .ed-about-image-placeholder { display: flex; }

.ed-about-features {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
}

.ed-about-feature {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 10px;
    background: var(--ed-surface);
    border: 1px solid var(--ed-line);
    border-radius: var(--ed-radius-md);
    padding: 18px 16px;
    box-shadow: var(--ed-shadow-sm);
    transition: transform 0.18s ease, box-shadow 0.18s ease, border-color 0.18s ease;
}

.ed-about-feature:hover {
    transform: translateY(-3px);
    box-shadow: var(--ed-shadow-md);
    border-color: #DAD8F7;
}

.ed-about-feature-icon {
    width: 34px;
    height: 34px;
    border-radius: 10px;
    background: var(--ed-primary-soft);
    color: var(--ed-primary-dark);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.ed-about-feature-icon svg { width: 16px; height: 16px; }

.ed-about-feature-label {
    font-size: 0.82rem;
    font-weight: 700;
    color: var(--ed-ink);
    line-height: 1.35;
}

@media (max-width: 1100px) {
    .ed-about-grid { grid-template-columns: 1fr 1fr; }
    .ed-about-features { grid-column: 1 / -1; grid-template-columns: repeat(3, 1fr); }
}

@media (max-width: 720px) {
    .ed-about-grid { grid-template-columns: 1fr; }
    .ed-about-features { grid-template-columns: 1fr 1fr; }
}

/* ---------- Section head (shared) ---------- */
.section-head h2 {
    font-weight: 800;
    letter-spacing: -0.02em;
    font-size: 1.55rem;
    color: var(--ed-ink);
}

.section-head p { color: var(--ed-muted); margin-top: 6px; }

/* ---------- Comprehensive Services ---------- */
.ed-quickstrip-section { padding: 40px 0 10px; }
.ed-quickstrip-section .section-head { margin-bottom: 26px; }

.ed-quickstrip {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 16px;
}

.ed-quickstrip-item {
    display: flex;
    flex-direction: column;
    gap: 4px;
    align-items: flex-start;
    padding: 26px 22px;
    text-decoration: none;
    background: var(--ed-surface);
    border: 1px solid var(--ed-line);
    border-radius: var(--ed-radius-md);
    box-shadow: var(--ed-shadow-sm);
    transition: transform 0.18s ease, box-shadow 0.18s ease, border-color 0.18s ease;
    position: relative;
    overflow: hidden;
}

.ed-quickstrip-item::after {
    content: "";
    position: absolute;
    inset: auto -30px -30px auto;
    width: 70px;
    height: 70px;
    border-radius: 50%;
    background: var(--ed-accent-soft);
    opacity: 0;
    transition: opacity 0.2s ease, transform 0.2s ease;
    transform: scale(0.6);
}

.ed-quickstrip-item:hover {
    transform: translateY(-4px);
    box-shadow: var(--ed-shadow-md);
    border-color: #DAD8F7;
}

.ed-quickstrip-item:hover::after {
    opacity: 1;
    transform: scale(1);
}

.ed-quickstrip-icon {
    width: 42px;
    height: 42px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 12px;
    position: relative;
    z-index: 1;
}

.ed-quickstrip-icon svg { width: 19px; height: 19px; }

.ed-quickstrip-blue { background: var(--ed-primary-soft); color: var(--ed-primary); }
.ed-quickstrip-green { background: #E9FBF2; color: #0E8A5E; }
.ed-quickstrip-purple { background: #F5EEFF; color: #8A3FE0; }
.ed-quickstrip-amber { background: var(--ed-accent-soft); color: var(--ed-accent-dark); }
.ed-quickstrip-cyan { background: #E7FAFC; color: #0E7C90; }

.ed-quickstrip-title {
    font-size: 0.98rem;
    font-weight: 700;
    color: var(--ed-ink);
    letter-spacing: -0.01em;
    position: relative;
    z-index: 1;
}

.ed-quickstrip-sub {
    font-size: 0.81rem;
    color: var(--ed-muted);
    line-height: 1.5;
    margin-bottom: 10px;
    position: relative;
    z-index: 1;
}

.ed-quickstrip-cta {
    font-size: 0.79rem;
    font-weight: 700;
    color: var(--ed-primary);
    margin-top: auto;
    position: relative;
    z-index: 1;
    transition: gap 0.15s ease;
}

.ed-quickstrip-item:hover .ed-quickstrip-cta { color: var(--ed-accent-dark); }

@media (max-width: 1000px) { .ed-quickstrip { grid-template-columns: repeat(3, 1fr); } }
@media (max-width: 640px) { .ed-quickstrip { grid-template-columns: 1fr 1fr; } }

/* ---------- Why section ---------- */
.ed-why-section { padding: 12px 0 44px; }

.ed-why-card {
    display: grid;
    grid-template-columns: 1fr 270px;
    gap: 32px;
    background: var(--ed-surface);
    border: 1px solid var(--ed-line);
    border-radius: var(--ed-radius-lg);
    padding: 44px;
    box-shadow: var(--ed-shadow-sm);
}

.ed-why-eyebrow {
    font-size: 0.78rem;
    font-weight: 700;
    color: var(--ed-accent-dark);
    text-transform: uppercase;
    letter-spacing: 0.06em;
    margin-bottom: 10px;
}

.ed-why-copy h2 {
    font-size: 1.75rem;
    font-weight: 800;
    letter-spacing: -0.02em;
    line-height: 1.2;
    margin-bottom: 12px;
    color: var(--ed-ink);
}

.ed-why-sub {
    color: var(--ed-muted);
    max-width: 460px;
    line-height: 1.65;
    margin-bottom: 28px;
}

.ed-why-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
    margin-bottom: 28px;
}

.ed-why-item {
    display: flex;
    gap: 13px;
    align-items: flex-start;
}

.ed-why-icon {
    flex-shrink: 0;
    width: 38px;
    height: 38px;
    border-radius: 11px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.ed-why-icon svg { width: 18px; height: 18px; }

.ed-why-blue { background: var(--ed-primary-soft); color: var(--ed-primary-dark); }
.ed-why-green { background: #E9FBF2; color: #0E8A5E; }
.ed-why-purple { background: #F5EEFF; color: #8A3FE0; }
.ed-why-amber { background: var(--ed-accent-soft); color: var(--ed-accent-dark); }

.ed-why-item h3 { font-size: 0.95rem; font-weight: 700; margin-bottom: 3px; color: var(--ed-ink); }
.ed-why-item p { font-size: 0.83rem; color: var(--ed-muted); line-height: 1.55; }

.ed-why-stats {
    background: linear-gradient(165deg, var(--ed-surface-soft) 0%, var(--ed-primary-soft) 160%);
    border-radius: var(--ed-radius-md);
    padding: 28px 22px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 22px;
    align-content: center;
}

.ed-why-stat { display: flex; flex-direction: column; gap: 4px; }

.ed-why-stat-icon {
    width: 32px;
    height: 32px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 4px;
    background: #fff;
}

.ed-why-stat-icon svg { width: 15px; height: 15px; }

.ed-why-stat-blue { color: var(--ed-primary-dark); }
.ed-why-stat-green { color: #0E8A5E; }
.ed-why-stat-amber { color: var(--ed-accent-dark); }
.ed-why-stat-purple { color: #8A3FE0; }

.ed-why-stat-num {
    font-size: 1.35rem;
    font-weight: 800;
    color: var(--ed-ink);
    letter-spacing: -0.02em;
}

.ed-why-stat-label { font-size: 0.77rem; color: var(--ed-muted); font-weight: 500; }

@media (max-width: 900px) {
    .ed-why-card { grid-template-columns: 1fr; }
    .ed-why-grid { grid-template-columns: 1fr; }
}

/* ---------- Exclusive Benefits banner ---------- */
.ed-benefits-section { padding: 12px 0 44px; }

.ed-benefits-card {
    display: grid;
    grid-template-columns: 1.3fr 1fr;
    align-items: center;
    gap: 0;

    background: #34659a; /* Light blue */

    border: 1px solid #D6E8FF;
    border-radius: var(--ed-radius-lg);
    padding: 48px;
    box-shadow: 0 12px 30px rgba(31, 104, 225, 0.12);

    position: relative;
    overflow: hidden;
}

.ed-benefits-badge {
    display: inline-flex;
    align-items: center;
    font-size: 0.76rem;
    font-weight: 700;
    letter-spacing: 0.03em;
    text-transform: uppercase;
    color: #FFE3D0;
    background: rgba(251, 122, 60, 0.22);
    padding: 6px 13px;
    border-radius: 999px;
    margin-bottom: 16px;
}

.ed-benefits-copy h2 {
    font-size: 1.6rem;
    font-weight: 800;
    letter-spacing: -0.02em;
    color: #fff;
    margin-bottom: 22px;
    max-width: 380px;
    line-height: 1.25;
}

.ed-benefits-list {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    gap: 15px;
    max-width: 420px;
}

.ed-benefits-list li {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    font-size: 0.89rem;
    color: #E4E3FA;
    line-height: 1.55;
}

.ed-benefits-check {
    flex-shrink: 0;
    width: 22px;
    height: 22px;
    border-radius: 50%;
    background: var(--ed-accent);
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 1px;
}

.ed-benefits-check svg { width: 12px; height: 12px; }

.ed-benefits-cta-card {
    background: #fff;
    border-radius: var(--ed-radius-md);
    padding: 32px 28px;
    margin-left: 38px;
    box-shadow: 0 24px 46px rgba(15, 12, 60, 0.24);
    position: relative;
    z-index: 1;
}

.ed-benefits-cta-card h3 {
    font-size: 1.18rem;
    font-weight: 800;
    color: var(--ed-ink);
    margin-bottom: 8px;
}

.ed-benefits-cta-card p {
    font-size: 0.86rem;
    color: var(--ed-muted);
    line-height: 1.55;
    margin-bottom: 22px;
}

.ed-benefits-btn { display: inline-flex; width: 100%; justify-content: center; }

@media (max-width: 900px) {
    .ed-benefits-card { grid-template-columns: 1fr; padding: 34px 28px; }
    .ed-benefits-cta-card { margin-left: 0; margin-top: 30px; }
}

/* ---------- Startup Spotlight ---------- */
.ed-startup-section { padding: 12px 0 54px; }

.ed-startup-card {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 24px;
    background: var(--ed-ink);
    background-image: radial-gradient(300px 180px at 0% 100%, rgba(251, 122, 60, 0.20), transparent 70%);
    border: 1px solid var(--ed-ink);
    border-radius: var(--ed-radius-lg);
    padding: 34px 36px;
    box-shadow: var(--ed-shadow-md);
}

.ed-startup-copy h2 {
    font-size: 1.4rem;
    font-weight: 800;
    letter-spacing: -0.02em;
    margin-bottom: 8px;
    color: #fff;
}

.ed-startup-copy p {
    font-size: 0.92rem;
    color: #C7C8DE;
    max-width: 480px;
    line-height: 1.6;
}

.ed-startup-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 0.76rem;
    font-weight: 700;
    color: var(--ed-accent);
    background: rgba(251, 122, 60, 0.16);
    padding: 6px 13px;
    border-radius: 999px;
    margin-bottom: 14px;
}

.ed-startup-actions { flex-shrink: 0; }

.ed-startup-actions .btn {
    background: var(--ed-accent);
    color: #fff;
    border: none;
    font-weight: 700;
    padding: 13px 26px;
    border-radius: 12px;
    box-shadow: 0 10px 22px rgba(251, 122, 60, 0.32);
}

.ed-startup-actions .btn:hover {
    background: var(--ed-accent-dark);
    transform: translateY(-2px);
}

@media (max-width: 720px) {
    .ed-startup-card { flex-direction: column; align-items: flex-start; text-align: left; }
}

/* ---------- Recent postings ---------- */
.ed-recent-section { padding: 34px 0 64px; }
.ed-recent-section .section-head { margin-bottom: 24px; }

.ed-type-pill {
    font-size: 0.72rem;
    font-weight: 700;
    padding: 4px 11px;
    border-radius: 999px;
    text-transform: capitalize;
}

.ed-type-job { background: var(--ed-primary-soft); color: var(--ed-primary-dark); }
.ed-type-internship { background: #E7FAFC; color: #0E7C90; }
.ed-type-project { background: var(--ed-accent-soft); color: var(--ed-accent-dark); }

.listing-table-wrap {
    background: var(--ed-surface);
    border: 1px solid var(--ed-line);
    border-radius: var(--ed-radius-lg);
    overflow-x: auto;
    box-shadow: var(--ed-shadow-sm);
}

.listing-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.87rem;
}

.listing-table th {
    text-align: left;
    padding: 14px 20px;
    background: var(--ed-surface-soft);
    color: var(--ed-primary-dark);
    font-weight: 700;
    text-transform: uppercase;
    font-size: 0.7rem;
    letter-spacing: 0.05em;
    border-bottom: 1px solid var(--ed-line);
}

.listing-table td {
    padding: 16px 20px;
    border-bottom: 1px solid #F1F1F9;
    color: var(--ed-ink-soft);
}

.listing-table tr:last-child td { border-bottom: none; }
.listing-table tbody tr { transition: background 0.15s ease; }
.listing-table tbody tr:hover { background: var(--ed-surface-soft); }

.cell-title { font-weight: 700; color: var(--ed-ink); }

.badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 700;
}

.badge-green { background: #DEFBEA; color: #0E7C4C; }
.badge-gray { background: #F1F1F6; color: #6B7089; }

.text-right { text-align: right; }
.actions-cell { white-space: nowrap; }

.action-link {
    color: #fff;
    text-decoration: none;
    font-weight: 700;
    margin-left: 14px;
    font-size: 0.82rem;
    padding: 8px 16px;
    border-radius: 9px;
    background: var(--ed-primary);
    transition: background 0.15s ease, transform 0.15s ease;
}

.action-link:hover {
    text-decoration: none;
    background: var(--ed-primary-dark);
    transform: translateY(-1px);
}

.empty-state { text-align: center; padding: 48px 16px; color: #9ca3af; }

/* ---------- Latest Opportunities & Upcoming Events feed ---------- */
.ed-feed-section { padding: 12px 0 54px; }

.ed-feed-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 22px;
}

.ed-feed-card {
    background: var(--ed-surface);
    border: 1px solid var(--ed-line);
    border-radius: var(--ed-radius-lg);
    box-shadow: var(--ed-shadow-sm);
    padding: 24px 24px 8px;
}

.ed-feed-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 8px;
}

.ed-feed-head h2 {
    font-size: 1.08rem;
    font-weight: 800;
    letter-spacing: -0.02em;
    color: var(--ed-ink);
}

.ed-feed-viewall {
    font-size: 0.79rem;
    font-weight: 700;
    color: var(--ed-primary);
    text-decoration: none;
    white-space: nowrap;
}

.ed-feed-viewall:hover { color: var(--ed-accent-dark); }

.ed-feed-list { display: flex; flex-direction: column; }

/* Job rows */
.ed-job-row {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 17px 0;
    border-bottom: 1px solid #F1F1F9;
}

.ed-feed-list .ed-job-row:last-child,
.ed-feed-list .ed-event-row:last-child { border-bottom: none; }

.ed-job-logo {
    flex-shrink: 0;
    width: 42px;
    height: 42px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    font-size: 0.92rem;
    font-family: var(--font-display);
}

.ed-job-info { flex: 1; min-width: 0; }

.ed-job-title {
    font-size: 0.89rem;
    font-weight: 700;
    color: var(--ed-ink);
    margin: 0 0 2px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.ed-job-meta {
    font-size: 0.78rem;
    color: var(--ed-muted);
    margin: 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.ed-job-side {
    flex-shrink: 0;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 2px;
    margin-right: 4px;
}

.ed-job-salary { font-size: 0.82rem; font-weight: 700; color: var(--ed-ink); white-space: nowrap; }
.ed-job-type { font-size: 0.72rem; color: var(--ed-muted); white-space: nowrap; }

/* Event rows */
.ed-event-row {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 17px 0;
    border-bottom: 1px solid #F1F1F9;
}

.ed-event-date {
    flex-shrink: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 48px;
    height: 48px;
    border-radius: 12px;
    background: var(--ed-ink);
    background-image: linear-gradient(160deg, var(--ed-primary) 0%, var(--ed-ink) 120%);
    color: #fff;
    line-height: 1.1;
}

.ed-event-month {
    font-size: 0.62rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    opacity: 0.8;
}

.ed-event-day { font-size: 1.05rem; font-weight: 800; font-family: var(--font-display); }

.ed-event-info { flex: 1; min-width: 0; }

.ed-event-title {
    font-size: 0.89rem;
    font-weight: 700;
    color: var(--ed-ink);
    margin: 0 0 2px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.ed-event-meta {
    font-size: 0.78rem;
    color: var(--ed-muted);
    margin: 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.ed-feed-btn { flex-shrink: 0; padding: 8px 17px; font-size: 0.79rem; border-radius: 10px; }

@media (max-width: 900px) { .ed-feed-grid { grid-template-columns: 1fr; } }

@media (max-width: 560px) {
    .ed-job-row, .ed-event-row { flex-wrap: wrap; }
    .ed-job-side {
        order: 3;
        flex-direction: row;
        align-items: center;
        gap: 8px;
        margin-left: 56px;
        margin-right: 0;
    }
    .ed-feed-btn { order: 4; margin-left: auto; }
}

/* ---------- Tips ---------- */
.ed-tips-section { padding: 12px 0 64px; }
.ed-tips-section .section-head { margin-bottom: 4px; }

.ed-tips-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 22px;
    margin-top: 24px;
}

.ed-tip-card {
    background: var(--ed-surface);
    border: 1px solid var(--ed-line);
    border-radius: var(--ed-radius-lg);
    padding: 26px 24px;
    box-shadow: var(--ed-shadow-sm);
    transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
}

.ed-tip-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--ed-shadow-md);
    border-color: #DAD8F7;
}

.ed-tip-icon {
    width: 44px;
    height: 44px;
    border-radius: 13px;
    background: var(--ed-surface-soft);
    color: var(--ed-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 14px;
    transition: transform 0.25s ease, background 0.25s ease, color 0.25s ease;
}

.ed-tip-card:hover .ed-tip-icon {
    transform: scale(1.08) rotate(-4deg);
    background: var(--ed-accent-soft);
    color: var(--ed-accent-dark);
}

.ed-tip-icon svg { width: 21px; height: 21px; }

.ed-tip-card h3 {
    font-weight: 700;
    font-size: 1.02rem;
    margin-bottom: 7px;
    letter-spacing: -0.01em;
    color: var(--ed-ink);
}

.ed-tip-card p { color: var(--ed-muted); font-size: 0.88rem; line-height: 1.6; }

@media (max-width: 900px) { .ed-tips-grid { grid-template-columns: 1fr 1fr; } }
@media (max-width: 640px) {
    .ed-tips-grid { grid-template-columns: 1fr; }
    .hero-actions { flex-direction: column; align-items: stretch; }
}

/* ---------- Trusted by / Partners (kept for compatibility) ---------- */
.ed-partners-section { padding: 12px 0 74px; }
.ed-partners-head { text-align: center; margin-bottom: 26px; }
.ed-partners-head p {
    font-size: 0.8rem;
    font-weight: 700;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    color: var(--ed-muted);
}
.ed-partners-row { display: flex; flex-wrap: wrap; justify-content: center; gap: 14px; }
.ed-partner-chip {
    display: inline-flex;
    align-items: center;
    gap: 9px;
    background: var(--ed-surface);
    border: 1px solid var(--ed-line);
    border-radius: 999px;
    padding: 8px 16px 8px 8px;
    font-size: 0.85rem;
    font-weight: 600;
    color: var(--ed-ink);
    box-shadow: var(--ed-shadow-sm);
    transition: transform 0.15s ease, box-shadow 0.15s ease;
}
.ed-partner-chip:hover { transform: translateY(-2px); box-shadow: var(--ed-shadow-md); }
.ed-partner-dot {
    width: 26px; height: 26px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.75rem; font-weight: 800; color: #fff; flex-shrink: 0;
}
.ed-partner-blue { background: var(--ed-primary); }
.ed-partner-green { background: #0E8A5E; }
.ed-partner-amber { background: var(--ed-accent); }
.ed-partner-purple { background: #8A3FE0; }
.ed-partner-cyan { background: #0E7C90; }

.pagination-wrapper { margin-top: 26px; display: flex; justify-content: center; }

/* ---------- Reveal animation ---------- */
.reveal { opacity: 0; transform: translateY(18px); transition: opacity 0.55s ease, transform 0.55s ease; }
.reveal.is-visible { opacity: 1; transform: translateY(0); }
.reveal-delay-1.is-visible { transition-delay: 0.08s; }
.reveal-delay-2.is-visible { transition-delay: 0.16s; }

@keyframes edPulse {
    0% { box-shadow: 0 0 0 0 rgba(251, 122, 60, 0.55); }
    70% { box-shadow: 0 0 0 8px rgba(251, 122, 60, 0); }
    100% { box-shadow: 0 0 0 0 rgba(251, 122, 60, 0); }
}

@media (prefers-reduced-motion: reduce) {
    .ed-illo-frame, .ed-eyebrow-dot, .reveal { animation: none !important; transition: none !important; opacity: 1; transform: none; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Reveal-on-scroll
    const revealEls = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15 });
    revealEls.forEach(el => observer.observe(el));

    // New Posting dropdown
    const toggle = document.getElementById('edPostToggle');
    const menu = document.getElementById('edPostMenu');
    if (toggle && menu) {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            menu.classList.toggle('is-open');
        });
        document.addEventListener('click', function(e) {
            if (!menu.contains(e.target) && e.target !== toggle) {
                menu.classList.remove('is-open');
            }
        });
    } else {
        console.warn('Dropdown elements not found', toggle, menu);
    }
});
</script>

@endsection
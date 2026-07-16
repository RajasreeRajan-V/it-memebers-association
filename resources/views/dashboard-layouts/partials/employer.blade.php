@extends('layouts.app')

@section('content')

{{-- ============ HERO / WELCOME ============ --}}
<section class="hero ed-hero">
    <div class="container hero-inner ed-hero-inner">

        <div class="hero-copy reveal">
            <p class="eyebrow"><span class="ed-eyebrow-dot"></span> Employer Hub</p>

            <h1>
                Hire the Right Talent.<br>
                <span class="accent-text">Build the Future.</span>
            </h1>

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
                <a href="{{ route('employer.jobs.index') }}" class="btn btn-outline btn-lg">View Candidates</a>
            </div>

            <div class="ed-trust-row">
                <div class="ed-trust-item">
                    <svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.6"/><path d="M8.5 12.5l2.2 2.2 4.8-5.4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    <span><strong>10,000+</strong> Employers</span>
                </div>
                <div class="ed-trust-item">
                    <svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.6"/><path d="M8.5 12.5l2.2 2.2 4.8-5.4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    <span><strong>2M+</strong> Active Candidates</span>
                </div>
                <!-- <div class="ed-trust-item">
                    <svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.6"/><path d="M8.5 12.5l2.2 2.2 4.8-5.4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    <span><strong>100K+</strong> Successful Hires</span>
                </div> -->
            </div>
        </div>

        <div class="hero-visual ed-hero-visual reveal reveal-delay-1">
            <div class="hero-blob"></div>
            <div class="hero-dots"></div>
            <div class="ed-illo-frame">
                <img src="{{ asset('assets/img/employer.png') }}"
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

            <div class="ed-float-card reveal reveal-delay-2">
                <p class="ed-float-title">Here's what you can do</p>
                <ul class="ed-float-list">
                    <li>
                        <span class="ed-float-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M4 21V8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v13" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/><path d="M9 21V13h6v8" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        Post Jobs &amp; Internships
                    </li>
                    <li>
                        <span class="ed-float-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M4 4h16v16H4z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M8 10h8M8 14h5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg></span>
                        Receive Quality Applications
                    </li>
                    <li>
                        <span class="ed-float-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M9 12l2 2 4-4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.7"/></svg></span>
                        Shortlist &amp; Interview
                    </li>
                    <li>
                        <span class="ed-float-icon"><svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="8" r="4" stroke="currentColor" stroke-width="1.7"/><path d="M4 21c0-4.4 3.6-7 8-7s8 2.6 8 7" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg></span>
                        Hire Top Talent
                    </li>
                </ul>
                <a href="{{ route('employer.jobs.index') }}" class="ed-float-link">Explore All Features <span aria-hidden="true">→</span></a>
            </div>
        </div>

    </div>
</section>

@if (session('success'))
<div class="container">
    <div class="alert alert-success ed-alert-inline">{{ session('success') }}</div>
</div>
@endif





{{-- ============ STATS ============ --}}
<section class="ed-stats-section">
    <div class="container">

        <div class="ed-stats-grid ed-stats-grid-full">
            <div class="ed-stat-card ed-stat-blue reveal">
                <div class="ed-stat-icon">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M4 21V8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v13" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M9 21V13h6v8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="ed-stat-body">
                    <span class="ed-stat-number" data-count="{{ $jobsCount ?? 0 }}">0</span>
                    <p>Jobs Posted</p>
                </div>
            </div>

            <div class="ed-stat-card ed-stat-cyan reveal reveal-delay-1">
                <div class="ed-stat-icon">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M22 10 12 5 2 10l10 5 10-5Z" stroke="currentColor" stroke-width="1.8"
                            stroke-linejoin="round" />
                        <path d="M6 12v5c0 1.7 2.7 3 6 3s6-1.3 6-3v-5" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="ed-stat-body">
                    <span class="ed-stat-number" data-count="{{ $internshipsCount ?? 0 }}">0</span>
                    <p>Internships Posted</p>
                </div>
            </div>

            <div class="ed-stat-card ed-stat-amber reveal reveal-delay-2">
                <div class="ed-stat-icon">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M13 2 3 14h7l-1 8 10-12h-7l1-8Z" stroke="currentColor" stroke-width="1.8"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="ed-stat-body">
                    <span class="ed-stat-number" data-count="{{ $projectsCount ?? 0 }}">0</span>
                    <p>Projects Posted</p>
                </div>
            </div>

            <div class="ed-stat-card ed-stat-green reveal reveal-delay-3">
                <div class="ed-stat-icon">
                    <span class="ed-live-dot" title="Live"></span>
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M12 22c5.5-3.5 8-7 8-11.5A8 8 0 0 0 4 10.5C4 15 6.5 18.5 12 22Z" stroke="currentColor"
                            stroke-width="1.8" stroke-linejoin="round" />
                        <path d="M9 12.5l2 2 4-4.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="ed-stat-body">
                    <span class="ed-stat-number" data-count="{{ $activeCount ?? 0 }}">0</span>
                    <p>Currently Active</p>
                </div>
            </div>
        </div>

    </div>
</section>




{{-- ============ WHY SKILLCONNECT ============ --}}
<section class="ed-why-section">
    <div class="container">
        <div class="ed-why-card reveal">
            <div class="ed-why-copy">
                <p class="ed-why-eyebrow"></p>
                <h2>Everything you need to hire<br>better &amp; faster</h2>
                <p class="ed-why-sub">Our employer tools and matching technology help you connect with the right talent quickly and efficiently.</p>

                <div class="ed-why-grid">
                    <div class="ed-why-item">
                        <span class="ed-why-icon ed-why-blue"><svg viewBox="0 0 24 24" fill="none"><path d="M12 3v3M12 18v3M4.2 4.2l2.1 2.1M17.7 17.7l2.1 2.1M3 12h3M18 12h3M4.2 19.8l2.1-2.1M17.7 6.3l2.1-2.1" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/><circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="1.7"/></svg></span>
                        <div>
                            <h3>Smart Matching</h3>
                            <p>Our AI matches you with the most relevant candidates.</p>
                        </div>
                    </div>
                    <div class="ed-why-item">
                        <span class="ed-why-icon ed-why-green"><svg viewBox="0 0 24 24" fill="none"><path d="M9 12l2 2 4-4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.7"/></svg></span>
                        <div>
                            <h3>Quality Applications</h3>
                            <p>Get applications from verified, skilled professionals.</p>
                        </div>
                    </div>
                    <div class="ed-why-item">
                        <span class="ed-why-icon ed-why-purple"><svg viewBox="0 0 24 24" fill="none"><circle cx="9" cy="8" r="3" stroke="currentColor" stroke-width="1.7"/><circle cx="17" cy="9" r="2.4" stroke="currentColor" stroke-width="1.7"/><path d="M3.5 20c.4-3.3 2.7-5.5 5.5-5.5s5.1 2.2 5.5 5.5M14.5 15.2c2 .2 3.6 1.9 3.9 4.3" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg></span>
                        <div>
                            <h3>Easy Collaboration</h3>
                            <p>Manage your hiring process with your team seamlessly.</p>
                        </div>
                    </div>
                    <div class="ed-why-item">
                        <span class="ed-why-icon ed-why-amber"><svg viewBox="0 0 24 24" fill="none"><path d="M12 3l7 3v5c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V6l7-3Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M9.5 12l1.8 1.8L15 10" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        <div>
                            <h3>Secure &amp; Reliable</h3>
                            <p>Your data and hiring process are safe with us.</p>
                        </div>
                    </div>
                </div>

                <!-- <a href="{{ route('employer.jobs.index') }}" class="btn btn-primary btn-lg">Learn More About Us</a> -->
            </div>

            <div class="ed-why-stats">
                <div class="ed-why-stat">
                    <span class="ed-why-stat-num">10,000+</span>
                    <span class="ed-why-stat-label">Companies</span>
                </div>
                <div class="ed-why-stat">
                    <span class="ed-why-stat-num">2M+</span>
                    <span class="ed-why-stat-label">Candidates</span>
                </div>
                <div class="ed-why-stat">
                    <span class="ed-why-stat-num">{{ $jobsCount ?? '100K+' }}</span>
                    <span class="ed-why-stat-label">Jobs Posted</span>
                </div>
                <div class="ed-why-stat">
                    <span class="ed-why-stat-num">{{ $hiredCount ?? '50K+' }}</span>
                    <span class="ed-why-stat-label">Hires Made</span>
                </div>
            </div>
        </div>
    </div>
</section>





{{-- ============ QUICK ACTIONS STRIP ============ --}}
<section class="ed-quickstrip-section">
    <div class="container">
        <div class="ed-quickstrip reveal">

            <a href="{{ route('employer.jobs.create') }}" class="ed-quickstrip-item">
                <span class="ed-quickstrip-icon ed-quickstrip-blue">
                    <svg viewBox="0 0 24 24" fill="none"><path d="M4 21V8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><path d="M9 21V13h6v8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </span>
                <span class="ed-quickstrip-title">Post a Job</span>
                <span class="ed-quickstrip-sub">Find the perfect full-time talent.</span>
                <span class="ed-quickstrip-cta">Get Started <span aria-hidden="true">→</span></span>
            </a>

            <a href="{{ route('employer.internships.create') }}" class="ed-quickstrip-item">
                <span class="ed-quickstrip-icon ed-quickstrip-green">
                    <svg viewBox="0 0 24 24" fill="none"><path d="M22 10 12 5 2 10l10 5 10-5Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="M6 12v5c0 1.7 2.7 3 6 3s6-1.3 6-3v-5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </span>
                <span class="ed-quickstrip-title">Post an Internship</span>
                <span class="ed-quickstrip-sub">Hire enthusiastic interns.</span>
                <span class="ed-quickstrip-cta">Get Started <span aria-hidden="true">→</span></span>
            </a>

            <a href="{{ route('employer.projects.create') }}" class="ed-quickstrip-item">
                <span class="ed-quickstrip-icon ed-quickstrip-purple">
                    <svg viewBox="0 0 24 24" fill="none"><path d="M13 2 3 14h7l-1 8 10-12h-7l1-8Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg>
                </span>
                <span class="ed-quickstrip-title">Post a Project</span>
                <span class="ed-quickstrip-sub">Find skilled freelancers for your projects.</span>
                <span class="ed-quickstrip-cta">Get Started <span aria-hidden="true">→</span></span>
            </a>

            <a href="{{ route('employer.startup-profile.create') }}" class="ed-quickstrip-item">
                <span class="ed-quickstrip-icon ed-quickstrip-amber">
                    <svg viewBox="0 0 24 24" fill="none"><path d="M4 21c0-4 2-6 2-6M12 3c3 2 5 6 5 10a5 5 0 0 1-10 0c0-4 2-8 5-10Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg>
                </span>
                <span class="ed-quickstrip-title">Startup Profile</span>
                <span class="ed-quickstrip-sub">Showcase your startup to the right people.</span>
                <span class="ed-quickstrip-cta">Get Started <span aria-hidden="true">→</span></span>
            </a>

            <a href="{{ route('employer.jobs.index') }}" class="ed-quickstrip-item">
                <span class="ed-quickstrip-icon ed-quickstrip-cyan">
                    <svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="8" r="4" stroke="currentColor" stroke-width="1.8"/><path d="M4 21c0-4.4 3.6-7 8-7s8 2.6 8 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                </span>
                <span class="ed-quickstrip-title">Search Candidates</span>
                <span class="ed-quickstrip-sub">Search from millions of verified profiles.</span>
                <span class="ed-quickstrip-cta">Search Now <span aria-hidden="true">→</span></span>
            </a>

        </div>
    </div>
</section>









{{-- ============ RECENT ACTIVITY ============ --}}
<!-- <section class="ed-activity-section">
    <div class="container">
        <div class="section-head reveal">
            <h2>Recent Activity</h2>
            <p>What's happened across your postings lately.</p>
        </div>

        <div class="ed-activity-card reveal">
            <div class="ed-activity-row">
                <div class="ed-activity-icon ed-activity-blue">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M12 22c5.5-3.5 8-7 8-11.5A8 8 0 0 0 4 10.5C4 15 6.5 18.5 12 22Z" stroke="currentColor"
                            stroke-width="1.7" stroke-linejoin="round" />
                        <path d="M9 12.5l2 2 4-4.5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="ed-activity-body">
                    <p><strong>Your job posting was approved</strong></p>
                    <span>An admin reviewed and approved a recent job listing.</span>
                </div>
                <span class="ed-activity-time">2h ago</span>
            </div>
            <div class="ed-activity-row">
                <div class="ed-activity-icon ed-activity-cyan">
                    <svg viewBox="0 0 24 24" fill="none">
                        <circle cx="12" cy="8" r="4" stroke="currentColor" stroke-width="1.7" />
                        <path d="M4 21c0-4.4 3.6-7 8-7s8 2.6 8 7" stroke="currentColor" stroke-width="1.7"
                            stroke-linecap="round" />
                    </svg>
                </div>
                <div class="ed-activity-body">
                    <p><strong>3 new applicants</strong></p>
                    <span>New candidates applied to your open internship listings.</span>
                </div>
                <span class="ed-activity-time">6h ago</span>
            </div>
            <div class="ed-activity-row">
                <div class="ed-activity-icon ed-activity-amber">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M13 2 3 14h7l-1 8 10-12h-7l1-8Z" stroke="currentColor" stroke-width="1.7"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="ed-activity-body">
                    <p><strong>A project bid was submitted</strong></p>
                    <span>A freelancer placed a bid on one of your open projects.</span>
                </div>
                <span class="ed-activity-time">1d ago</span>
            </div>
            <div class="ed-activity-row">
                <div class="ed-activity-icon ed-activity-green">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M4 21V8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v13" stroke="currentColor" stroke-width="1.7"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M9 21V13h6v8" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="ed-activity-body">
                    <p><strong>Internship listing published</strong></p>
                    <span>Your internship posting went live and is now visible to students.</span>
                </div>
                <span class="ed-activity-time">2d ago</span>
            </div>
        </div>
    </div>
</section> -->

{{-- ============ TODAY'S INTERVIEWS ============ --}}
<!-- <section class="ed-activity-section">
    <div class="container">
        <div class="section-head reveal">
            <h2>Today's Interviews</h2>
            <p>Candidates scheduled to interview today.</p>
        </div>

        <div class="ed-activity-card reveal">
            @forelse (($todayInterviews ?? collect()) as $interview)
            <div class="ed-activity-row">
                <div class="ed-activity-icon ed-activity-blue">
                    <svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="8" r="4" stroke="currentColor" stroke-width="1.7"/><path d="M4 21c0-4.4 3.6-7 8-7s8 2.6 8 7" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
                </div>
                <div class="ed-activity-body">
                    <p><strong>{{ $interview->application->applicant_name ?? 'Candidate' }}</strong></p>
                    <span>{{ ucfirst($interview->mode) }}{{ $interview->location ? ' · ' . $interview->location : '' }} — {{ ucfirst($interview->status) }}</span>
                </div>
                <span class="ed-activity-time">{{ $interview->scheduled_at->format('g:i A') }}</span>
            </div>
            @empty
            <div class="ed-activity-row">
                <div class="ed-activity-body">
                    <p style="color:#9ca3af;">No interviews scheduled for today.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section> -->

{{-- ============ NOTIFICATIONS ============ --}}
<!-- <section class="ed-activity-section">
    <div class="container">
        <div class="section-head reveal">
            <h2>Notifications
                @if(($unreadNotifications ?? 0) > 0)
                    <span class="badge badge-green" style="margin-left:8px;">{{ $unreadNotifications }} new</span>
                @endif
            </h2>
            <p>Updates about your postings and applicants.</p>
        </div>

        <div class="ed-activity-card reveal">
            @forelse (($notifications ?? collect()) as $notification)
            <div class="ed-activity-row">
                <div class="ed-activity-icon ed-activity-{{ $notification->type === 'success' ? 'green' : ($notification->type === 'warning' ? 'amber' : 'blue') }}">
                    <svg viewBox="0 0 24 24" fill="none"><path d="M12 2a6 6 0 0 0-6 6c0 5-2 6-2 6h16s-2-1-2-6a6 6 0 0 0-6-6Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M10 20a2 2 0 0 0 4 0" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
                </div>
                <div class="ed-activity-body">
                    <p><strong>{{ $notification->title }}</strong></p>
                    <span>{{ $notification->message }}</span>
                </div>
                <span class="ed-activity-time">{{ $notification->created_at->diffForHumans() }}</span>
            </div>
            @empty
            <div class="ed-activity-row">
                <div class="ed-activity-body">
                    <p style="color:#9ca3af;">No notifications yet.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section> -->

{{-- ============ UPCOMING DEADLINES ============ --}}
<!-- <section class="ed-deadlines-section">
    <div class="container">
        <div class="section-head reveal">
            <h2>Upcoming Deadlines</h2>
            <p>Postings closing soon — review applicants before they expire.</p>
        </div>

        <div class="ed-deadlines-grid">
            <div class="ed-deadline-card reveal">
                <span class="ed-deadline-pill ed-deadline-soon">Closes in 2 days</span>
                <h3>Senior Backend Engineer</h3>
                <p>Full-time · Remote</p>
            </div>
            <div class="ed-deadline-card reveal reveal-delay-1">
                <span class="ed-deadline-pill ed-deadline-week">Closes in 5 days</span>
                <h3>Marketing Intern</h3>
                <p>Internship · Hybrid</p>
            </div>
            <div class="ed-deadline-card reveal reveal-delay-2">
                <span class="ed-deadline-pill ed-deadline-week">Closes in 9 days</span>
                <h3>Landing Page Redesign</h3>
                <p>Project · Fixed price</p>
            </div>
        </div>
    </div>
</section> -->

{{-- ============ STARTUP SPOTLIGHT ============ --}}
<section class="ed-startup-section">
    <div class="container">
        <div class="ed-startup-card reveal">
            <div class="ed-startup-copy">
                <span class="ed-startup-badge">🚀 For Startups</span>
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
<section class="ed-recent-section">
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
:root {
    --ed-ink: #0f172a;
    --ed-muted: #64748b;
    --ed-line: #e6e9f2;
    --ed-primary: #2f5fdb;
    --ed-primary-dark: #1e40af;
    --ed-surface: #ffffff;
    --ed-surface-soft: #f5f8ff;
    --ed-radius-lg: 18px;
    --ed-radius-md: 14px;
    --ed-shadow-sm: 0 2px 8px rgba(15, 23, 42, 0.05);
    --ed-shadow-md: 0 12px 28px rgba(30, 41, 79, 0.08);
}

/* Hero */
.ed-hero {
    padding-top: 52px;
    padding-bottom: 28px;
    overflow: visible !important;
    position: relative;
    z-index: 100;
}

.ed-hero-inner {
    align-items: center;
    overflow: visible;
}

.ed-hero .hero-sub {
    max-width: 480px;
    color: var(--ed-muted);
    font-size: 1.02rem;
    line-height: 1.6;
}

.ed-hero .eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 0.8rem;
    font-weight: 600;
    letter-spacing: 0.02em;
    color: var(--ed-primary-dark);
    background: #eaf0ff;
    padding: 6px 12px;
    border-radius: 999px;
    margin-bottom: 14px;
}

.ed-eyebrow-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: var(--ed-primary);
    box-shadow: 0 0 0 0 rgba(47, 95, 219, 0.5);
    animation: edPulse 2s infinite;
}

.ed-hero h1 {
    font-weight: 800;
    letter-spacing: -0.02em;
    line-height: 1.12;
}

.ed-hero .accent-text {
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
    margin-top: 26px;
}

.btn-lg {
    padding: 12px 22px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 0.94rem;
}

.btn-primary {
    background: var(--ed-primary);
    border: 1px solid var(--ed-primary);
    box-shadow: 0 6px 16px rgba(47, 95, 219, 0.24);
    transition: transform 0.15s ease, box-shadow 0.15s ease, background 0.15s ease;
}

.btn-primary:hover {
    background: var(--ed-primary-dark);
    transform: translateY(-1px);
    box-shadow: 0 10px 22px rgba(47, 95, 219, 0.3);
}

.btn-primary:active {
    transform: scale(0.97);
}

.btn-outline {
    border: 1px solid var(--ed-line);
    color: var(--ed-ink);
    background: #fff;
    transition: border-color 0.15s ease, transform 0.15s ease;
}

.btn-outline:hover {
    border-color: var(--ed-primary);
    transform: translateY(-1px);
}

.btn-outline:active {
    transform: scale(0.97);
}

.ed-dropdown {
    position: relative;
    display: inline-block;
    z-index: 50;
}

.ed-dropdown-menu {
    display: none;
    position: absolute;
    left: 0;
    top: calc(100% + 8px);
    background: #ffffff;
    opacity: 1;
    border: 1px solid var(--ed-line);
    border-radius: 12px;
    box-shadow: var(--ed-shadow-md);
    min-width: 180px;
    z-index: 99999;
    pointer-events: auto;
    overflow: hidden;
}

.ed-dropdown-menu.is-open {
    display: block;
    animation: edMenuIn 0.16s ease;
}

@keyframes edMenuIn {
    from {
        opacity: 0;
        transform: translateY(-6px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.ed-dropdown-menu a {
    display: block;
    padding: 12px 16px;
    font-size: 0.88rem;
    font-weight: 500;
    color: #1f2937;
    text-decoration: none;
    position: relative;
    z-index: 1;
    pointer-events: auto;
    background: #fff;
    transition: background 0.12s ease, padding-left 0.12s ease;
}

.ed-dropdown-menu a:hover {
    background: var(--ed-surface-soft);
    color: var(--ed-primary);
    padding-left: 20px;
}

.ed-alert-inline {
    margin: 24px auto 0;
    max-width: 1100px;
    border-radius: 12px;
}

/* Trust row under hero copy */
.ed-trust-row {
    display: flex;
    flex-wrap: wrap;
    gap: 22px;
    margin-top: 30px;
    padding-top: 22px;
    border-top: 1px solid var(--ed-line);
    max-width: 500px;
}

.ed-trust-item {
    display: flex;
    align-items: center;
    gap: 7px;
    font-size: 0.84rem;
    color: var(--ed-muted);
}

.ed-trust-item svg {
    width: 17px;
    height: 17px;
    color: var(--ed-primary);
    flex-shrink: 0;
}

.ed-trust-item strong {
    color: var(--ed-ink);
    font-weight: 700;
}

/* Floating capability card on hero image */
.ed-float-card {
    position: absolute;
    top: 55%;
    right: -4%;
    z-index: 5;
    background: #dce2ee;
    border-radius: var(--ed-radius-md);
    box-shadow: var(--ed-shadow-md);
    padding: 18px 20px;
    width: 232px;
}

.ed-float-title {
    font-size: 0.78rem;
    font-weight: 700;
    color: var(--ed-ink);
    margin: 0 0 10px;
}

.ed-float-list {
    list-style: none;
    margin: 0 0 12px;
    padding: 0;
    display: flex;
    flex-direction: column;
    gap: 9px;
}

.ed-float-list li {
    display: flex;
    align-items: center;
    gap: 9px;
    font-size: 0.76rem;
    color: #374151;
    font-weight: 500;
}

.ed-float-icon {
    flex-shrink: 0;
    width: 24px;
    height: 24px;
    border-radius: 7px;
    background: var(--ed-surface-soft);
    color: var(--ed-primary);
    display: flex;
    align-items: center;
    justify-content: center;
}

.ed-float-icon svg {
    width: 13px;
    height: 13px;
}

.ed-float-link {
    display: inline-block;
    font-size: 0.76rem;
    font-weight: 700;
    color: var(--ed-primary);
}

.ed-float-link:hover {
    color: var(--ed-primary-dark);
}

@media (max-width: 900px) {
    .ed-float-card {
        position: static;
        width: 100%;
        margin-top: 18px;
    }
}

/* ===== Quick action strip ===== */
.ed-quickstrip-section {
    padding: 34px 0 8px;
}

.ed-quickstrip {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    background: var(--ed-surface);
    border: 1px solid var(--ed-line);
    border-radius: var(--ed-radius-lg);
    box-shadow: var(--ed-shadow-sm);
    overflow: hidden;
}

.ed-quickstrip-item {
    display: flex;
    flex-direction: column;
    gap: 4px;
    padding: 22px 18px;
    text-decoration: none;
    border-right: 1px solid var(--ed-line);
    transition: background 0.15s ease;
}

.ed-quickstrip-item:last-child {
    border-right: none;
}

.ed-quickstrip-item:hover {
    background: var(--ed-surface-soft);
}

.ed-quickstrip-icon {
    width: 34px;
    height: 34px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 6px;
}

.ed-quickstrip-icon svg {
    width: 17px;
    height: 17px;
}

.ed-quickstrip-blue {
    background: #eaf0ff;
    color: var(--ed-primary);
}

.ed-quickstrip-green {
    background: #ecfdf5;
    color: #047857;
}

.ed-quickstrip-purple {
    background: #f4f0ff;
    color: #7c3aed;
}

.ed-quickstrip-amber {
    background: #fffbeb;
    color: #b45309;
}

.ed-quickstrip-cyan {
    background: #ecfeff;
    color: #0e7490;
}

.ed-quickstrip-title {
    font-size: 0.92rem;
    font-weight: 700;
    color: var(--ed-ink);
    letter-spacing: -0.01em;
}

.ed-quickstrip-sub {
    font-size: 0.78rem;
    color: var(--ed-muted);
    line-height: 1.45;
    margin-bottom: 6px;
}

.ed-quickstrip-cta {
    font-size: 0.78rem;
    font-weight: 700;
    color: var(--ed-primary);
}

@media (max-width: 900px) {
    .ed-quickstrip {
        grid-template-columns: repeat(3, 1fr);
    }

    .ed-quickstrip-item {
        border-bottom: 1px solid var(--ed-line);
    }
}

@media (max-width: 560px) {
    .ed-quickstrip {
        grid-template-columns: 1fr 1fr;
    }
}

/* ===== Stats section ===== */
.ed-stats-section {
    padding: 40px 0 48px;
    position: relative;
    z-index: 1;
    background: linear-gradient(180deg, #f6f8ff 0%, #ffffff 100%);
}

.ed-stats-grid-full {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 18px;
}

.ed-stat-card {
    display: flex;
    align-items: center;
    gap: 14px;
    background: var(--ed-surface);
    border: 1px solid var(--ed-line);
    border-radius: var(--ed-radius-md);
    padding: 20px 18px;
    box-shadow: var(--ed-shadow-sm);
    transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
}

.ed-stat-card:hover {
    transform: translateY(-3px);
    box-shadow: var(--ed-shadow-md);
    border-color: #dfe2f5;
}

.ed-stat-icon {
    position: relative;
    flex-shrink: 0;
    width: 44px;
    height: 44px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.ed-stat-icon svg {
    width: 22px;
    height: 22px;
}

.ed-live-dot {
    position: absolute;
    top: -3px;
    right: -3px;
    width: 9px;
    height: 9px;
    border-radius: 50%;
    background: #22c55e;
    border: 2px solid #fff;
    animation: edPulse 2s infinite;
}

@keyframes edPulse {
    0% {
        box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.55);
    }

    70% {
        box-shadow: 0 0 0 7px rgba(34, 197, 94, 0);
    }

    100% {
        box-shadow: 0 0 0 0 rgba(34, 197, 94, 0);
    }
}

.ed-eyebrow-dot {
    animation-name: edEyebrowPulse;
}

@keyframes edEyebrowPulse {
    0% {
        box-shadow: 0 0 0 0 rgba(47, 95, 219, 0.5);
    }

    70% {
        box-shadow: 0 0 0 6px rgba(47, 95, 219, 0);
    }

    100% {
        box-shadow: 0 0 0 0 rgba(47, 95, 219, 0);
    }
}

.ed-stat-blue .ed-stat-icon {
    background: #eaf0ff;
    color: var(--ed-primary-dark);
}

.ed-stat-cyan .ed-stat-icon {
    background: #ecfeff;
    color: #0e7490;
}

.ed-stat-amber .ed-stat-icon {
    background: #fffbeb;
    color: #b45309;
}

.ed-stat-green .ed-stat-icon {
    background: #ecfdf5;
    color: #047857;
}

.ed-stat-body .ed-stat-number {
    display: block;
    font-size: 1.75rem;
    font-weight: 800;
    color: var(--ed-ink);
    line-height: 1.1;
    letter-spacing: -0.01em;
}

.ed-stat-body p {
    margin: 3px 0 0;
    font-size: 0.82rem;
    color: var(--ed-muted);
    font-weight: 500;
}

/* Hero image panel */
.ed-hero-visual {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 320px;
}

.ed-hero-visual .hero-blob {
    background: #cfe0ff;
}

.ed-illo-frame {
    position: relative;
    z-index: 1;
    width: 100%;
    max-width: 520px;
    aspect-ratio: 4 / 3;
    border-radius: var(--ed-radius-lg);
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: var(--ed-shadow-md);
    animation: edFloat 4.5s ease-in-out infinite;
}

@keyframes edFloat {

    0%,
    100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-8px);
    }
}

.ed-illo-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.ed-illo-placeholder {
    display: none;
    flex-direction: column;
    align-items: center;
    gap: 10px;
    color: #94a3b8;
    text-align: center;
    padding: 20px;
    font-size: 0.8rem;
    line-height: 1.5;
}

.ed-illo-placeholder code {
    background: #f1f2fa;
    padding: 2px 6px;
    border-radius: 6px;
    color: var(--ed-primary);
    font-size: 0.75rem;
}

.ed-illo-frame.ed-illo-empty .ed-illo-img {
    display: none;
}

.ed-illo-frame.ed-illo-empty .ed-illo-placeholder {
    display: flex;
}

@media (max-width: 900px) {
    .ed-hero-visual {
        order: -1;
        min-height: 320px;
    }

    .ed-illo-frame {
        max-width: 400px;
    }
}

@media (max-width: 560px) {
    .ed-stats-grid-full {
        grid-template-columns: 1fr 1fr;
    }
}

@media (max-width: 420px) {
    .ed-stats-grid-full {
        grid-template-columns: 1fr;
    }
}

/* ===== Why section ===== */
.ed-why-section {
    padding: 10px 0 54px;
}

.ed-why-card {
    display: grid;
    grid-template-columns: 1fr 260px;
    gap: 30px;
    background: var(--ed-surface);
    border: 1px solid var(--ed-line);
    border-radius: var(--ed-radius-lg);
    padding: 40px;
    box-shadow: var(--ed-shadow-sm);
}

.ed-why-eyebrow {
    font-size: 0.78rem;
    font-weight: 700;
    color: var(--ed-primary);
    text-transform: uppercase;
    letter-spacing: 0.04em;
    margin-bottom: 10px;
}

.ed-why-copy h2 {
    font-size: 1.7rem;
    font-weight: 800;
    letter-spacing: -0.02em;
    line-height: 1.2;
    margin-bottom: 10px;
}

.ed-why-sub {
    color: var(--ed-muted);
    max-width: 460px;
    line-height: 1.6;
    margin-bottom: 26px;
}

.ed-why-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 22px;
    margin-bottom: 28px;
}

.ed-why-item {
    display: flex;
    gap: 12px;
    align-items: flex-start;
}

.ed-why-icon {
    flex-shrink: 0;
    width: 36px;
    height: 36px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.ed-why-icon svg {
    width: 18px;
    height: 18px;
}

.ed-why-blue {
    background: #eaf0ff;
    color: var(--ed-primary-dark);
}

.ed-why-green {
    background: #ecfdf5;
    color: #047857;
}

.ed-why-purple {
    background: #f4f0ff;
    color: #7c3aed;
}

.ed-why-amber {
    background: #fffbeb;
    color: #b45309;
}

.ed-why-item h3 {
    font-size: 0.94rem;
    font-weight: 700;
    margin-bottom: 3px;
}

.ed-why-item p {
    font-size: 0.82rem;
    color: var(--ed-muted);
    line-height: 1.5;
}

.ed-why-stats {
    background: var(--ed-surface-soft);
    border-radius: var(--ed-radius-md);
    padding: 26px 20px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 22px;
    align-content: center;
}

.ed-why-stat {
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.ed-why-stat-num {
    font-size: 1.3rem;
    font-weight: 800;
    color: var(--ed-primary-dark);
    letter-spacing: -0.01em;
}

.ed-why-stat-label {
    font-size: 0.76rem;
    color: var(--ed-muted);
    font-weight: 500;
}

@media (max-width: 900px) {
    .ed-why-card {
        grid-template-columns: 1fr;
    }

    .ed-why-grid {
        grid-template-columns: 1fr;
    }
}

/* ===== Recent Activity ===== */
.ed-activity-section {
    padding: 10px 0 50px;
}

.ed-activity-section .section-head h2 {
    font-weight: 800;
    letter-spacing: -0.01em;
}

.ed-activity-section .section-head p {
    color: var(--ed-muted);
}

.ed-activity-card {
    background: var(--ed-surface);
    border: 1px solid var(--ed-line);
    border-radius: var(--ed-radius-lg);
    box-shadow: var(--ed-shadow-sm);
    overflow: hidden;
}

.ed-activity-row {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 18px 22px;
    border-bottom: 1px solid #f2f3f9;
    transition: background 0.15s ease;
}

.ed-activity-row:last-child {
    border-bottom: none;
}

.ed-activity-row:hover {
    background: var(--ed-surface-soft);
}

.ed-activity-icon {
    flex-shrink: 0;
    width: 40px;
    height: 40px;
    border-radius: 11px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.ed-activity-icon svg {
    width: 19px;
    height: 19px;
}

.ed-activity-blue {
    background: #eaf0ff;
    color: var(--ed-primary-dark);
}

.ed-activity-cyan {
    background: #ecfeff;
    color: #0e7490;
}

.ed-activity-amber {
    background: #fffbeb;
    color: #b45309;
}

.ed-activity-green {
    background: #ecfdf5;
    color: #047857;
}

.ed-activity-body {
    flex: 1;
    min-width: 0;
}

.ed-activity-body p {
    font-size: 0.9rem;
    color: var(--ed-ink);
    margin: 0;
}

.ed-activity-body span {
    font-size: 0.82rem;
    color: var(--ed-muted);
}

.ed-activity-time {
    flex-shrink: 0;
    font-size: 0.78rem;
    color: #9ca3af;
    font-weight: 500;
    white-space: nowrap;
}

@media (max-width: 560px) {
    .ed-activity-time {
        display: none;
    }
}

/* ===== Upcoming Deadlines ===== */
.ed-deadlines-section {
    padding: 10px 0 50px;
}

.ed-deadlines-section .section-head h2 {
    font-weight: 800;
    letter-spacing: -0.01em;
}

.ed-deadlines-section .section-head p {
    color: var(--ed-muted);
}

.ed-deadlines-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
}

.ed-deadline-card {
    background: var(--ed-surface);
    border: 1px solid var(--ed-line);
    border-radius: var(--ed-radius-md);
    padding: 20px;
    box-shadow: var(--ed-shadow-sm);
    transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
}

.ed-deadline-card:hover {
    transform: translateY(-3px);
    box-shadow: var(--ed-shadow-md);
    border-color: #dfe2f5;
}

.ed-deadline-pill {
    display: inline-block;
    font-size: 0.72rem;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 999px;
    margin-bottom: 12px;
}

.ed-deadline-soon {
    background: #fee2e2;
    color: #b91c1c;
}

.ed-deadline-week {
    background: #fef3c7;
    color: #92400e;
}

.ed-deadline-card h3 {
    font-size: 0.98rem;
    font-weight: 700;
    letter-spacing: -0.01em;
    margin-bottom: 4px;
}

.ed-deadline-card p {
    font-size: 0.84rem;
    color: var(--ed-muted);
}

@media (max-width: 900px) {
    .ed-deadlines-grid {
        grid-template-columns: 1fr 1fr;
    }
}

@media (max-width: 560px) {
    .ed-deadlines-grid {
        grid-template-columns: 1fr;
    }
}

/* ===== Startup Spotlight ===== */
.ed-startup-section {
    padding: 10px 0 50px;
}

.ed-startup-card {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 24px;
    background: linear-gradient(135deg, #2f5fdb 0%, #1e3a8a 100%);
    border-radius: var(--ed-radius-lg);
    padding: 32px 34px;
    color: #fff;
    box-shadow: 0 16px 32px rgba(30, 58, 138, 0.22);
}

.ed-startup-copy h2 {
    font-size: 1.35rem;
    font-weight: 800;
    letter-spacing: -0.01em;
    margin-bottom: 8px;
    color: #fff;
}

.ed-startup-copy p {
    font-size: 0.92rem;
    color: #dbe4ff;
    max-width: 480px;
    line-height: 1.6;
}

.ed-startup-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 0.76rem;
    font-weight: 600;
    color: #e0e7ff;
    background: rgba(255, 255, 255, 0.12);
    padding: 5px 12px;
    border-radius: 999px;
    margin-bottom: 12px;
}

.ed-startup-actions {
    flex-shrink: 0;
}

.ed-startup-actions .btn {
    background: #fff;
    color: var(--ed-primary-dark);
    border: none;
    font-weight: 700;
}

.ed-startup-actions .btn:hover {
    background: #eaf0ff;
    transform: translateY(-1px);
}

@media (max-width: 720px) {
    .ed-startup-card {
        flex-direction: column;
        align-items: flex-start;
        text-align: left;
    }
}

/* ===== Recent postings ===== */
.ed-recent-section {
    padding: 54px 0 60px;
}

.ed-recent-section .section-head {
    margin-bottom: 22px;
}

.ed-recent-section .section-head h2 {
    font-weight: 800;
    letter-spacing: -0.01em;
}

.ed-recent-section .section-head p {
    color: var(--ed-muted);
}

.ed-type-pill {
    font-size: 0.72rem;
    font-weight: 600;
    padding: 3px 10px;
    border-radius: 999px;
    text-transform: capitalize;
}

.ed-type-job {
    background: #eaf0ff;
    color: var(--ed-primary-dark);
}

.ed-type-internship {
    background: #ecfeff;
    color: #0e7490;
}

.ed-type-project {
    background: #fffbeb;
    color: #b45309;
}

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
    font-size: 0.86rem;
}

.listing-table th {
    text-align: left;
    padding: 13px 18px;
    background: var(--ed-surface-soft);
    color: var(--ed-muted);
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.7rem;
    letter-spacing: 0.04em;
    border-bottom: 1px solid var(--ed-line);
}

.listing-table td {
    padding: 15px 18px;
    border-bottom: 1px solid #f2f3f9;
    color: #374151;
}

.listing-table tr:last-child td {
    border-bottom: none;
}

.listing-table tbody tr {
    transition: background 0.15s ease;
}

.listing-table tbody tr:hover {
    background: #fafbff;
}

.cell-title {
    font-weight: 600;
    color: var(--ed-ink);
}

.badge {
    display: inline-block;
    padding: 3px 11px;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 600;
}

.badge-green {
    background: #dcfce7;
    color: #166534;
}

.badge-gray {
    background: #f3f4f6;
    color: #6b7280;
}

.text-right {
    text-align: right;
}

.actions-cell {
    white-space: nowrap;
}

.action-link {
    color: var(--ed-primary);
    text-decoration: none;
    font-weight: 600;
    margin-left: 14px;
    font-size: 0.83rem;
}

.action-link:hover {
    text-decoration: underline;
}

.empty-state {
    text-align: center;
    padding: 46px 16px;
    color: #9ca3af;
}

/* ===== Tips ===== */
.ed-tips-section {
    padding: 10px 0 74px;
}

.ed-tips-section .section-head h2 {
    font-weight: 800;
    letter-spacing: -0.01em;
}

.ed-tips-section .section-head p {
    color: var(--ed-muted);
}

.ed-tips-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}

.ed-tip-card {
    background: var(--ed-surface);
    border: 1px solid var(--ed-line);
    border-radius: var(--ed-radius-lg);
    padding: 24px 22px;
    box-shadow: var(--ed-shadow-sm);
    transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
}

.ed-tip-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--ed-shadow-md);
    border-color: #dfe2f5;
}

.ed-tip-icon {
    width: 42px;
    height: 42px;
    border-radius: 12px;
    background: var(--ed-surface-soft);
    color: var(--ed-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 12px;
    transition: transform 0.25s ease;
}

.ed-tip-card:hover .ed-tip-icon {
    transform: scale(1.08) rotate(-4deg);
}

.ed-tip-icon svg {
    width: 20px;
    height: 20px;
}

.ed-tip-card h3 {
    font-weight: 700;
    font-size: 1rem;
    margin-bottom: 6px;
    letter-spacing: -0.01em;
}

.ed-tip-card p {
    color: var(--ed-muted);
    font-size: 0.88rem;
    line-height: 1.55;
}

@media (max-width: 900px) {

    .ed-tips-grid {
        grid-template-columns: 1fr 1fr;
    }
}

@media (max-width: 640px) {

    .ed-tips-grid {
        grid-template-columns: 1fr;
    }

    .hero-actions {
        flex-direction: column;
        align-items: stretch;
    }
}

@media (prefers-reduced-motion: reduce) {

    .ed-illo-frame,
    .ed-live-dot,
    .ed-eyebrow-dot {
        animation: none !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Reveal-on-scroll, matching the homepage's animation
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

    // Animated stat counters, matching the homepage's counters
    const statNumbers = document.querySelectorAll('.ed-stat-number');
    const statObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const el = entry.target;
                const target = parseInt(el.getAttribute('data-count'), 10) || 0;
                const duration = 900;
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
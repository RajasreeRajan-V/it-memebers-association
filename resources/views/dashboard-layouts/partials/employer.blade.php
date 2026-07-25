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
                    <span class="ed-trust-icon ed-trust-blue">
                        <svg viewBox="0 0 24 24" fill="none">
                            <path d="M4 21V8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v13" stroke="currentColor" stroke-width="1.8"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M9 21V13h6v8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </span>
                    <span class="ed-trust-num">{{ $jobsCount ?? '' }}</span>
                    <span class="ed-trust-label">Opportunities Created</span>
                </div>
                <div class="ed-trust-item">
                    <span class="ed-trust-icon ed-trust-green">
                        <svg viewBox="0 0 24 24" fill="none">
                            <circle cx="12" cy="8" r="4" stroke="currentColor" stroke-width="1.8" />
                            <path d="M4 21c0-4.4 3.6-7 8-7s8 2.6 8 7" stroke="currentColor" stroke-width="1.8"
                                stroke-linecap="round" />
                        </svg>
                    </span>
                    <span class="ed-trust-num"></span>
                    <span class="ed-trust-label">Skilled Candidates</span>
                </div>
                <div class="ed-trust-item">
                    <span class="ed-trust-icon ed-trust-amber">
                        <svg viewBox="0 0 24 24" fill="none">
                            <path d="M13 2 3 14h7l-1 8 10-12h-7l1-8Z" stroke="currentColor" stroke-width="1.8"
                                stroke-linejoin="round" />
                        </svg>
                    </span>
                    <span class="ed-trust-num">{{ $hiredCount ?? '' }}</span>
                    <span class="ed-trust-label">Successful Hires</span>
                </div>
            </div>
        </div>

        <div class="hero-visual ed-hero-visual reveal reveal-delay-1">
           
            <div class="hero-dots"></div>
            
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

            <div class="ed-float-badge">
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
                <span class="ed-benefits-badge">For Employers</span>
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
                            style="background:{{ $job->logo_color ?? '#eaf0ff' }}; color:{{ $job->logo_text_color ?? '#2f5fdb' }};">{{ strtoupper(substr($job->company_name ?? $job->title, 0, 1)) }}</span>
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
                        <span class="ed-job-logo" style="background:#eaf0ff; color:#2f5fdb;">G</span>
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
                        <span class="ed-job-logo" style="background:#fffbeb; color:#b45309;">A</span>
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
    color: var(--ed-ink);
    font-size: 2.7rem;
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

/* Primary CTA now reads as a bold ink-navy button, matching the reference */
.btn-primary {
    background: var(--ed-ink);
    border: 1px solid var(--ed-ink);
    color: #fff;
    box-shadow: 0 6px 16px rgba(15, 23, 42, 0.22);
    transition: transform 0.15s ease, box-shadow 0.15s ease, background 0.15s ease;
}

.btn-primary:hover {
    background: #1e293b;
    transform: translateY(-1px);
    box-shadow: 0 10px 22px rgba(15, 23, 42, 0.28);
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
    border-color: var(--ed-ink);
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
    overflow: visible;
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

/* Trust row under hero copy -> icon stat row, matching reference */
.ed-trust-row {
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
    margin-top: 30px;
    padding-top: 22px;
    border-top: 1px solid var(--ed-line);
    max-width: 520px;
}

.ed-trust-item {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.ed-trust-icon {
    width: 30px;
    height: 30px;
    border-radius: 9px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 2px;
}

.ed-trust-icon svg {
    width: 15px;
    height: 15px;
}

.ed-trust-blue {
    background: #eaf0ff;
    color: var(--ed-primary-dark);
}

.ed-trust-green {
    background: #ecfdf5;
    color: #047857;
}

.ed-trust-amber {
    background: #fffbeb;
    color: #b45309;
}

.ed-trust-num {
    font-size: 1.2rem;
    font-weight: 800;
    color: var(--ed-ink);
    letter-spacing: -0.01em;
    line-height: 1.1;
}

.ed-trust-label {
    font-size: 0.78rem;
    color: var(--ed-muted);
    font-weight: 500;
}

/* Floating verified badge on hero image, matching reference */
.ed-float-badge {
    position: absolute;
    bottom: 18px;
    left: 18px;
    z-index: 5;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #ffffff;
    border-radius: 999px;
    box-shadow: var(--ed-shadow-md);
    padding: 9px 16px 9px 10px;
}

.ed-float-badge-icon {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background: #ecfdf5;
    color: #047857;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.ed-float-badge-icon svg {
    width: 14px;
    height: 14px;
}

.ed-float-badge-text {
    font-size: 0.8rem;
    font-weight: 700;
    color: var(--ed-ink);
    white-space: nowrap;
}

/* ===== Quick action strip -> Comprehensive Services cards ===== */
.ed-quickstrip-section {
    padding: 34px 0 8px;
}

.ed-quickstrip-section .section-head {
    margin-bottom: 24px;
}

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
    padding: 24px 20px;
    text-decoration: none;
    background: var(--ed-surface);
    border: 1px solid var(--ed-line);
    border-radius: var(--ed-radius-md);
    box-shadow: var(--ed-shadow-sm);
    transition: transform 0.18s ease, box-shadow 0.18s ease, border-color 0.18s ease;
}

.ed-quickstrip-item:hover {
    transform: translateY(-3px);
    box-shadow: var(--ed-shadow-md);
    border-color: #dfe2f5;
}

.ed-quickstrip-icon {
    width: 40px;
    height: 40px;
    border-radius: 11px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 10px;
}

.ed-quickstrip-icon svg {
    width: 19px;
    height: 19px;
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
    font-size: 0.96rem;
    font-weight: 700;
    color: var(--ed-ink);
    letter-spacing: -0.01em;
}

.ed-quickstrip-sub {
    font-size: 0.8rem;
    color: var(--ed-muted);
    line-height: 1.45;
    margin-bottom: 8px;
}

.ed-quickstrip-cta {
    font-size: 0.78rem;
    font-weight: 700;
    color: var(--ed-primary);
    margin-top: auto;
}

@media (max-width: 1000px) {
    .ed-quickstrip {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 640px) {
    .ed-quickstrip {
        grid-template-columns: 1fr 1fr;
    }
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
    border: none !important;
    box-shadow: none !important;
    background: transparent !important;
    padding: 0;
    overflow: hidden;
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

/* ===== Why section ===== */
.ed-why-section {
    padding: 10px 0 40px;
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
    gap: 20px;
    align-content: center;
}

.ed-why-stat {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.ed-why-stat-icon {
    width: 30px;
    height: 30px;
    border-radius: 9px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 4px;
}

.ed-why-stat-icon svg {
    width: 15px;
    height: 15px;
}

.ed-why-stat-blue {
    background: #eaf0ff;
    color: var(--ed-primary-dark);
}

.ed-why-stat-green {
    background: #ecfdf5;
    color: #047857;
}

.ed-why-stat-amber {
    background: #fffbeb;
    color: #b45309;
}

.ed-why-stat-purple {
    background: #f4f0ff;
    color: #7c3aed;
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

/* ===== Exclusive Benefits banner ===== */
.ed-benefits-section {
    padding: 10px 0 40px;
}

.ed-benefits-card {
    display: grid;
    grid-template-columns: 1.3fr 1fr;
    align-items: center;
    gap: 0;
    background: linear-gradient(135deg, #2f5fdb 0%, #1e3a8a 100%);
    border-radius: var(--ed-radius-lg);
    padding: 44px;
    box-shadow: 0 16px 32px rgba(30, 58, 138, 0.2);
}

.ed-benefits-badge {
    display: inline-flex;
    align-items: center;
    font-size: 0.76rem;
    font-weight: 600;
    color: #e0e7ff;
    background: rgba(255, 255, 255, 0.14);
    padding: 5px 12px;
    border-radius: 999px;
    margin-bottom: 14px;
}

.ed-benefits-copy h2 {
    font-size: 1.55rem;
    font-weight: 800;
    letter-spacing: -0.01em;
    color: #fff;
    margin-bottom: 20px;
    max-width: 380px;
}

.ed-benefits-list {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    gap: 14px;
    max-width: 420px;
}

.ed-benefits-list li {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    font-size: 0.88rem;
    color: #e3e9fb;
    line-height: 1.5;
}

.ed-benefits-check {
    flex-shrink: 0;
    width: 22px;
    height: 22px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.16);
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 1px;
}

.ed-benefits-check svg {
    width: 12px;
    height: 12px;
}

.ed-benefits-cta-card {
    background: #fff;
    border-radius: var(--ed-radius-md);
    padding: 30px 26px;
    margin-left: 36px;
    box-shadow: 0 20px 40px rgba(15, 23, 42, 0.18);
}

.ed-benefits-cta-card h3 {
    font-size: 1.15rem;
    font-weight: 800;
    color: var(--ed-ink);
    margin-bottom: 8px;
}

.ed-benefits-cta-card p {
    font-size: 0.85rem;
    color: var(--ed-muted);
    line-height: 1.55;
    margin-bottom: 20px;
}

.ed-benefits-btn {
    display: inline-flex;
    width: 100%;
    justify-content: center;
}

@media (max-width: 900px) {
    .ed-benefits-card {
        grid-template-columns: 1fr;
        padding: 32px 26px;
    }

    .ed-benefits-cta-card {
        margin-left: 0;
        margin-top: 28px;
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
    background: var(--ed-surface);
    border: 1px solid var(--ed-line);
    border-radius: var(--ed-radius-lg);
    padding: 32px 34px;
    box-shadow: var(--ed-shadow-sm);
}

.ed-startup-copy h2 {
    font-size: 1.35rem;
    font-weight: 800;
    letter-spacing: -0.01em;
    margin-bottom: 8px;
    color: var(--ed-ink);
}

.ed-startup-copy p {
    font-size: 0.92rem;
    color: var(--ed-muted);
    max-width: 480px;
    line-height: 1.6;
}

.ed-startup-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 0.76rem;
    font-weight: 600;
    color: var(--ed-primary-dark);
    background: #eaf0ff;
    padding: 5px 12px;
    border-radius: 999px;
    margin-bottom: 12px;
}

.ed-startup-actions {
    flex-shrink: 0;
}

.ed-startup-actions .btn {
    background: var(--ed-ink);
    color: #fff;
    border: none;
    font-weight: 700;
}

.ed-startup-actions .btn:hover {
    background: #1e293b;
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
    padding: 30px 0 60px;
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
    color: var(--ed-primary-dark);
    font-weight: 700;
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
    padding: 8px 14px;
    border-radius: 8px;
    background: #2563eb;
    color: white;
    font-size: 14px;
}

.action-link:hover {
    text-decoration: underline;
    background: #fcfdff;
}

.empty-state {
    text-align: center;
    padding: 46px 16px;
    color: #9ca3af;
}

/* ===== Latest Opportunities & Upcoming Events feed ===== */
.ed-feed-section {
    padding: 10px 0 50px;
}

.ed-feed-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.ed-feed-card {
    background: var(--ed-surface);
    border: 1px solid var(--ed-line);
    border-radius: var(--ed-radius-lg);
    box-shadow: var(--ed-shadow-sm);
    padding: 22px 22px 8px;
}

.ed-feed-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 6px;
}

.ed-feed-head h2 {
    font-size: 1.05rem;
    font-weight: 800;
    letter-spacing: -0.01em;
    color: var(--ed-ink);
}

.ed-feed-viewall {
    font-size: 0.78rem;
    font-weight: 700;
    color: var(--ed-primary);
    text-decoration: none;
    white-space: nowrap;
}

.ed-feed-viewall:hover {
    color: var(--ed-primary-dark);
}

.ed-feed-list {
    display: flex;
    flex-direction: column;
}

/* Job rows */
.ed-job-row {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 16px 0;
    border-bottom: 1px solid #f2f3f9;
}

.ed-feed-list .ed-job-row:last-child,
.ed-feed-list .ed-event-row:last-child {
    border-bottom: none;
}

.ed-job-logo {
    flex-shrink: 0;
    width: 40px;
    height: 40px;
    border-radius: 11px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    font-size: 0.9rem;
}

.ed-job-info {
    flex: 1;
    min-width: 0;
}

.ed-job-title {
    font-size: 0.88rem;
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

.ed-job-salary {
    font-size: 0.82rem;
    font-weight: 700;
    color: var(--ed-ink);
    white-space: nowrap;
}

.ed-job-type {
    font-size: 0.72rem;
    color: var(--ed-muted);
    white-space: nowrap;
}

/* Event rows */
.ed-event-row {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 16px 0;
    border-bottom: 1px solid #f2f3f9;
}

.ed-event-date {
    flex-shrink: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 46px;
    height: 46px;
    border-radius: 11px;
    background: var(--ed-ink);
    color: #fff;
    line-height: 1.1;
}

.ed-event-month {
    font-size: 0.62rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.03em;
    opacity: 0.75;
}

.ed-event-day {
    font-size: 1.02rem;
    font-weight: 800;
}

.ed-event-info {
    flex: 1;
    min-width: 0;
}

.ed-event-title {
    font-size: 0.88rem;
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

.ed-feed-btn {
    flex-shrink: 0;
    padding: 7px 16px;
    font-size: 0.78rem;
    border-radius: 9px;
}

@media (max-width: 900px) {
    .ed-feed-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 560px) {

    .ed-job-row,
    .ed-event-row {
        flex-wrap: wrap;
    }

    .ed-job-side {
        order: 3;
        flex-direction: row;
        align-items: center;
        gap: 8px;
        margin-left: 54px;
        margin-right: 0;
    }

    .ed-feed-btn {
        order: 4;
        margin-left: auto;
    }
}

/* ===== Tips ===== */
.ed-tips-section {
    padding: 10px 0 60px;
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

/* ===== Trusted by / Partners ===== */
.ed-partners-section {
    padding: 10px 0 70px;
}

.ed-partners-head {
    text-align: center;
    margin-bottom: 26px;
}

.ed-partners-head p {
    font-size: 0.8rem;
    font-weight: 600;
    letter-spacing: 0.03em;
    text-transform: uppercase;
    color: var(--ed-muted);
}

.ed-partners-row {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 14px;
}

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

.ed-partner-chip:hover {
    transform: translateY(-2px);
    box-shadow: var(--ed-shadow-md);
}

.ed-partner-dot {
    width: 26px;
    height: 26px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    font-weight: 800;
    color: #fff;
    flex-shrink: 0;
}

.ed-partner-blue {
    background: var(--ed-primary);
}

.ed-partner-green {
    background: #10b981;
}

.ed-partner-amber {
    background: #f59e0b;
}

.ed-partner-purple {
    background: #7c3aed;
}

.ed-partner-cyan {
    background: #0891b2;
}

.pagination-wrapper {
    margin-top: 24px;
    display: flex;
    justify-content: center;
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

@media (prefers-reduced-motion: reduce) {

    .ed-illo-frame,
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
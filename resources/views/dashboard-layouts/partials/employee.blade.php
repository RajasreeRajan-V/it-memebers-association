@extends('layouts.app')

@section('content')

<!-- Hero -->
<section class="career-hero">
    <div class="container career-hero-inner">

        <div class="career-hero-content">
            <h1 class="career-hero-title">
                Empowering Your Career,
                <span class="accent">Building a Better Tomorrow</span>
            </h1>
            <p class="career-hero-text">
                Explore opportunities, enhance your skills, and grow your professional journey with Tech Leaders Network.
            </p>

            <div class="career-hero-actions">
                <a href="{{ route('employee.jobs.index') }}" class="btn btn-dark">
                    Explore Opportunities <i class="fa-solid fa-arrow-right"></i>
                </a>
                <a href="{{ route('profile') }}" class="btn btn-outline-dark">
                    Complete Your Profile
                </a>
            </div>

            <div class="career-hero-stats">
                <div class="hero-stat">
                    <div class="hero-stat-icon"><i class="fa-solid fa-briefcase"></i></div>
                    <div class="hero-stat-text">
                        <span class="hero-stat-value">150+</span>
                        <span class="hero-stat-label">Applications</span>
                    </div>
                </div>
                <div class="hero-stat">
                    <div class="hero-stat-icon"><i class="fa-solid fa-user-tie"></i></div>
                    <div class="hero-stat-text">
                        <span class="hero-stat-value">40+</span>
                        <span class="hero-stat-label">Interviews</span>
                    </div>
                </div>
                <div class="hero-stat">
                    <div class="hero-stat-icon"><i class="fa-solid fa-building"></i></div>
                    <div class="hero-stat-text">
                        <span class="hero-stat-value">300+</span>
                        <span class="hero-stat-label">Companies</span>
                    </div>
                </div>
                <div class="hero-stat">
                    <div class="hero-stat-icon"><i class="fa-solid fa-chart-line"></i></div>
                    <div class="hero-stat-text">
                        <span class="hero-stat-value">95%</span>
                        <span class="hero-stat-label">Success Rate</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="career-hero-visual">
            <div class="hero-photo-frame">
                {{-- Swap in the user's actual profile/marketing photo here --}}
                <img src="{{ asset('assets/img/bobwomen.png') }}" alt="Professional working on laptop">
            </div>

            <div class="float-card float-card-premium">
                <div class="float-card-icon"><i class="fa-solid fa-crown"></i></div>
                <div class="float-card-text">
                    <span class="float-card-label">Premium Member</span>
                    <span class="float-card-value">Valid till {{ $user->premium_until ?? '31 Mar, 2026' }}</span>
                </div>
            </div>

            <div class="float-card float-card-completion">
                <div class="float-card-icon"><i class="fa-solid fa-user-check"></i></div>
                <div class="float-card-text">
                    <span class="float-card-label">Profile Completion</span>
                    <span class="float-card-value">{{ $profileCompletion ?? 85 }}% Complete</span>
                </div>
            </div>

            <div class="float-card float-card-interview">
                <div class="float-card-icon"><i class="fa-solid fa-calendar-days"></i></div>
                <div class="float-card-text">
                    <span class="float-card-label">Next Interview</span>
                    <span class="float-card-value">{{ $nextInterview ?? '29 May, 2026 · 10:30 AM' }}</span>
                </div>
            </div>

            <div class="float-card float-card-membership">
                <div class="float-card-icon"><i class="fa-solid fa-shield-halved"></i></div>
                <div class="float-card-text">
                    <span class="float-card-label">Membership</span>
                    <span class="float-card-value">{{ $user->membership_status ?? 'Active' }}</span>
                </div>
            </div>
        </div>

    </div>
</section>



<!-- Choose Your Path -->
<section class="path-section">
    <div class="container">
        <div class="path-header">
            <span class="path-kicker">Choose Your Path</span>
            <h2 class="path-title">Explore. Connect. Grow.</h2>
            <p class="path-subtitle">Find the right opportunities and resources tailored for you.</p>
        </div>

        <div class="path-grid">

            <div class="path-card path-card-green">
                <div class="path-icon path-icon-green"><i class="fa-solid fa-briefcase"></i></div>
                <h3 class="path-card-title">Jobs</h3>
                <p class="path-card-text">Find full-time, part-time and remote jobs.</p>
                <a href="{{ route('employee.jobs.index') }}" class="path-card-link">
                    Explore Jobs <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <div class="path-card path-card-blue">
                <div class="path-icon path-icon-blue"><i class="fa-solid fa-file-lines"></i></div>
                <h3 class="path-card-title">Articles</h3>
                <p class="path-card-text">Read, write and share knowledge with the community.</p>
                <a href="{{ route('employee.articles.index') }}" class="path-card-link">
                    Explore Articles <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <div class="path-card path-card-red">
                <div class="path-icon path-icon-red"><i class="fa-solid fa-chalkboard-user"></i></div>
                <h3 class="path-card-title">Training &amp; Workshops</h3>
                <p class="path-card-text">Learn from experts and upgrade your skills.</p>
                <a href="" class="path-card-link">
                    Explore Training <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <div class="path-card path-card-yellow">
                <div class="path-icon path-icon-yellow"><i class="fa-solid fa-people-group"></i></div>
                <h3 class="path-card-title">Support &amp; Legal Help</h3>
                <p class="path-card-text">Get expert guidance for workplace concerns, rights.</p>
                <a href="{{ route('employee.legal-help.index') }}" class="path-card-link">
                    Explore Support <i class="fa-solid fa-arrow-right"></i>
                </a>
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
});
</script>

@endsection
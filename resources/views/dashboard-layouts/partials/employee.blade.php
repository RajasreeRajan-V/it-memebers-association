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
                Explore opportunities, enhance your skills, and grow your professional journey with SkillConnect.
            </p>

            <div class="career-hero-actions">
                <a href="{{ url('/jobs') }}" class="btn btn-dark">
                    Explore Opportunities <i class="fa-solid fa-arrow-right"></i>
                </a>
                <a href="{{ route('profile.edit') }}" class="btn btn-outline-dark">
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
    }, { threshold: 0.15 });
    revealEls.forEach(el => observer.observe(el));
});
</script>

@endsection
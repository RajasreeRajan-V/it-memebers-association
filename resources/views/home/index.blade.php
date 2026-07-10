@extends('layouts.app')

@section('content')

<!-- Hero -->
<section class="hero" id="home">
    <div class="container hero-inner">
        <div class="hero-copy">
            <p class="eyebrow">Careers · Freelance · Learning · Capital</p>
            <h1>
                One Platform,<br />
                <span class="accent-text">Endless Opportunities</span>
            </h1>
            <p class="hero-sub">
                Jobs, internships, projects, courses, investments and mentorship —
                everything in one place, built around the way you actually work.
            </p>
            <div class="hero-actions">
                <a href="#register" class="btn btn-primary btn-lg">Join Now</a>
                <a href="#portals" class="btn btn-outline btn-lg">Learn More</a>
            </div>

            <div class="hero-stats">

            </div>
        </div>

        <div class="hero-visual">
            <div class="hero-blob" aria-hidden="true"></div>
            <div class="hero-dots" aria-hidden="true"></div>
            <div class="hero-card">
                <!-- Replace the src below with your own image, e.g. "images/hero-team.png" -->
                <img src="{{ asset('assets/img/hero-team.png') }}" alt="Hero Image" loading="lazy" />
            </div>

        </div>
</section>

<!-- Portals -->
<section class="portals" id="portals">
    <div class="container">
        <div class="section-head">
            <h2>Choose your portal</h2>
            <p>Every path onto SkillConnect is purpose-built — pick the door that matches where you're headed.</p>
        </div>

        <div class="portal-grid">

            <article class="portal-card portal-blue">
                <div class="portal-icon">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M4 21V8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v13" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M9 21V13h6v8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M9 6V4a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="portal-body">
                    <h3>Employer Portal</h3>
                    <p>Post jobs, screen applicants, and build your team.</p>
                    <a href="#" class="portal-link">Enter <span aria-hidden="true">→</span></a>
                </div>
            </article>

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
                    <p>Find jobs, build skills, grow your career.</p>
                    <a href="#" class="portal-link">Enter <span aria-hidden="true">→</span></a>
                </div>
            </article>

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
                    <a href="#" class="portal-link">Enter <span aria-hidden="true">→</span></a>
                </div>
            </article>

            <article class="portal-card portal-yellow">
                <div class="portal-icon">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M13 2 3 14h7l-1 8 10-12h-7l1-8Z" stroke="currentColor" stroke-width="1.8"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="portal-body">
                    <h3>Freelancer Portal</h3>
                    <p>Bid on projects, showcase work, get paid.</p>
                    <a href="#" class="portal-link">Enter <span aria-hidden="true">→</span></a>
                </div>
            </article>

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
                    <a href="#" class="portal-link">Enter <span aria-hidden="true">→</span></a>
                </div>
            </article>

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
                    <a href="#" class="portal-link">Enter <span aria-hidden="true">→</span></a>
                </div>
            </article>

        </div>
    </div>
</section>

<script>
const navToggle = document.getElementById('navToggle');
const mainNav = document.querySelector('.main-nav');
if (navToggle && mainNav) {
    navToggle.addEventListener('click', () => {
        const open = mainNav.classList.toggle('is-open');
        navToggle.classList.toggle('is-open', open);
        navToggle.setAttribute('aria-expanded', open);
    });
}
</script>
</body>

</html>

@endsection
@extends('layouts.app')

@section('content')

<style>
    /* ===== Freelancer About Page Styles ===== */
    .freelancer-about-page {
        background: #f5f8fc;
        min-height: 100vh;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 24px;
    }

    /* ===== Hero Section ===== */
    .about-hero {
        padding: 80px 0 60px;
        background: linear-gradient(135deg, #f8faff 0%, #eef3fa 100%);
        border-bottom: 1px solid rgba(79, 70, 229, 0.08);
    }

    .about-hero-content {
        max-width: 800px;
        margin: 0 auto;
        text-align: center;
    }

    .about-hero-content .eyebrow {
        color: #4F46E5;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        font-size: 0.85rem;
        margin-bottom: 12px;
        display: inline-block;
        background: rgba(79, 70, 229, 0.1);
        padding: 6px 18px;
        border-radius: 50px;
    }

    .about-hero-content h1 {
        font-size: 3.2rem;
        font-weight: 800;
        color: #1a2634;
        margin-bottom: 20px;
        line-height: 1.2;
    }

    .accent-text {
        background: linear-gradient(135deg, #4F46E5, #2080D4);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero-description {
        font-size: 1.15rem;
        color: #5a6a7a;
        max-width: 650px;
        margin: 0 auto 32px;
        line-height: 1.7;
    }

    .hero-actions {
        display: flex;
        gap: 16px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn {
        display: inline-block;
        padding: 10px 28px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.95rem;
        text-decoration: none;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .btn-primary {
        background: #4F46E5;
        color: #fff;
    }

    .btn-primary:hover {
        background: #4338ca;
        transform: translateY(-2px);
        box-shadow: 0 4px 16px rgba(79, 70, 229, 0.3);
    }

    .btn-outline {
        background: transparent;
        color: #4F46E5;
        border: 2px solid #4F46E5;
    }

    .btn-outline:hover {
        background: #4F46E5;
        color: #fff;
    }

    .btn-lg {
        padding: 12px 36px;
        font-size: 1.05rem;
    }

    /* ===== Stats Section ===== */
    .about-stats {
        padding: 60px 0;
        background: #ffffff;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
    }

    .stat-card {
        text-align: center;
        padding: 30px 20px;
        background: #f8faff;
        border-radius: 16px;
        border: 1px solid rgba(79, 70, 229, 0.06);
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
        border-color: rgba(79, 70, 229, 0.12);
    }

    .stat-number {
        font-size: 2.8rem;
        font-weight: 800;
        color: #1a2634;
        display: block;
        line-height: 1.2;
        margin-bottom: 6px;
    }

    .stat-card p {
        color: #6c7a8c;
        font-size: 0.95rem;
        margin: 0;
    }

    /* ===== Why Section ===== */
    .why-section {
        padding: 80px 0;
        background: #f5f8fc;
    }

    .section-head {
        text-align: center;
        max-width: 700px;
        margin: 0 auto 48px;
    }

    .section-head h2 {
        font-size: 2.4rem;
        font-weight: 800;
        color: #1a2634;
        margin-bottom: 12px;
    }

    .section-head p {
        color: #6c7a8c;
        font-size: 1.1rem;
        line-height: 1.6;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 28px;
    }

    .feature-card {
        background: #ffffff;
        padding: 32px 28px;
        border-radius: 16px;
        border: 1px solid rgba(0, 0, 0, 0.04);
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
        transition: all 0.3s ease;
    }

    .feature-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.08);
        border-color: rgba(79, 70, 229, 0.1);
    }

    .feature-icon {
        width: 56px;
        height: 56px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 18px;
        color: #fff;
    }

    .feature-icon-blue { background: linear-gradient(135deg, #4F46E5, #4338ca); }
    .feature-icon-green { background: linear-gradient(135deg, #22c55e, #16a34a); }
    .feature-icon-purple { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }
    .feature-icon-pink { background: linear-gradient(135deg, #ec4899, #db2777); }
    .feature-icon-gold { background: linear-gradient(135deg, #f59e0b, #d97706); }
    .feature-icon-cyan { background: linear-gradient(135deg, #06b6d4, #0891b2); }

    .feature-card h3 {
        font-size: 1.15rem;
        font-weight: 700;
        color: #1a2634;
        margin-bottom: 10px;
    }

    .feature-card p {
        color: #6c7a8c;
        line-height: 1.7;
        font-size: 0.95rem;
        margin: 0;
    }

    /* ===== How It Works ===== */
    .how-it-works-section {
        padding: 80px 0;
        background: #ffffff;
    }

    .steps-container {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 32px;
        max-width: 1024px;
        margin: 0 auto;
    }

    .step {
        text-align: center;
        padding: 32px 24px;
        background: #f8faff;
        border-radius: 16px;
        border: 1px solid rgba(79, 70, 229, 0.06);
        transition: all 0.3s ease;
        position: relative;
    }

    .step:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
    }

    .step-number {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: linear-gradient(135deg, #4F46E5, #2080D4);
        color: #fff;
        font-size: 1.2rem;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 18px;
    }

    .step-content h3 {
        font-size: 1.15rem;
        font-weight: 700;
        color: #1a2634;
        margin-bottom: 10px;
    }

    .step-content p {
        color: #6c7a8c;
        line-height: 1.7;
        font-size: 0.95rem;
        margin-bottom: 12px;
    }

    .step-time {
        display: inline-block;
        font-size: 0.85rem;
        color: #4F46E5;
        font-weight: 500;
        background: rgba(79, 70, 229, 0.08);
        padding: 4px 14px;
        border-radius: 50px;
    }

    /* ===== Testimonials ===== */
    .testimonials-section {
        padding: 80px 0;
        background: #f5f8fc;
    }

    .testimonials-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 28px;
    }

    .testimonial-card {
        background: #ffffff;
        padding: 28px 24px;
        border-radius: 16px;
        border: 1px solid rgba(0, 0, 0, 0.04);
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
        transition: all 0.3s ease;
    }

    .testimonial-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
    }

    .testimonial-rating {
        font-size: 1.1rem;
        margin-bottom: 12px;
        color: #f59e0b;
    }

    .testimonial-text {
        font-size: 0.95rem;
        line-height: 1.7;
        color: #1a2634;
        margin-bottom: 18px;
        font-style: italic;
    }

    .testimonial-author {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .author-avatar {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: linear-gradient(135deg, #4F46E5, #2080D4);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-weight: 700;
        font-size: 14px;
        flex-shrink: 0;
    }

    .author-info h4 {
        font-size: 0.95rem;
        font-weight: 600;
        color: #1a2634;
        margin: 0 0 2px;
    }

    .author-info p {
        font-size: 0.85rem;
        color: #6c7a8c;
        margin: 0;
    }

    /* ===== CTA Section ===== */
    .cta-section {
        padding: 80px 0;
        background: linear-gradient(135deg, #0F172A 0%, #1e293b 100%);
        border-top: 1px solid rgba(255, 255, 255, 0.06);
    }

    .cta-content {
        text-align: center;
        max-width: 700px;
        margin: 0 auto;
    }

    .cta-content h2 {
        font-size: 2.4rem;
        font-weight: 800;
        color: #ffffff;
        margin-bottom: 14px;
    }

    .cta-content p {
        font-size: 1.1rem;
        color: rgba(255, 255, 255, 0.7);
        margin-bottom: 32px;
        line-height: 1.6;
    }

    .cta-actions {
        display: flex;
        gap: 16px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .cta-content .btn-primary {
        background: #4F46E5;
    }

    .cta-content .btn-primary:hover {
        background: #4338ca;
    }

    .cta-content .btn-outline {
        border-color: rgba(255, 255, 255, 0.3);
        color: #ffffff;
    }

    .cta-content .btn-outline:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: #ffffff;
        color: #ffffff;
    }

    /* ===== Reveal Animations ===== */
    .reveal {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .reveal.is-visible {
        opacity: 1;
        transform: translateY(0);
    }

    .reveal-delay-1 { transition-delay: 0.1s; }
    .reveal-delay-2 { transition-delay: 0.2s; }
    .reveal-delay-3 { transition-delay: 0.3s; }

    /* ===== Responsive ===== */
    @media (max-width: 1024px) {
        .features-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .testimonials-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .about-hero-content h1 {
            font-size: 2.4rem;
        }
        .hero-description {
            font-size: 1rem;
        }
        .features-grid {
            grid-template-columns: 1fr;
        }
        .steps-container {
            grid-template-columns: 1fr;
        }
        .testimonials-grid {
            grid-template-columns: 1fr;
        }
        .stats-grid {
            grid-template-columns: 1fr 1fr;
        }
        .stat-number {
            font-size: 2.2rem;
        }
        .section-head h2 {
            font-size: 2rem;
        }
        .cta-content h2 {
            font-size: 2rem;
        }
        .cta-actions {
            flex-direction: column;
            align-items: center;
        }
        .cta-actions .btn {
            width: 100%;
            max-width: 300px;
            text-align: center;
        }
        .hero-actions {
            flex-direction: column;
            align-items: center;
        }
        .hero-actions .btn {
            width: 100%;
            max-width: 280px;
            text-align: center;
        }
    }

    @media (max-width: 480px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
        .about-hero-content h1 {
            font-size: 1.8rem;
        }
        .about-hero {
            padding: 40px 0 30px;
        }
        .why-section,
        .how-it-works-section,
        .testimonials-section,
        .cta-section {
            padding: 50px 0;
        }
        .feature-card {
            padding: 24px 20px;
        }
        .step {
            padding: 24px 20px;
        }
    }
</style>

<!-- Freelancer About Page -->
<main class="freelancer-about-page">

    <!-- Hero Section -->
    <section class="about-hero">
        <div class="container">
            <div class="about-hero-content reveal">
                <p class="eyebrow">🚀 About Freelancer Portal</p>
                <h1>Your Gateway to <span class="accent-text">Freelance Success</span></h1>
                <p class="hero-description">
                    Tech Leaders Network's Freelancer Portal is purpose-built to help independent professionals 
                    find meaningful work, build lasting client relationships, and grow their freelance 
                    career — all in one place.
                </p>
                <div class="hero-actions">
                    <a href="#get-started" class="btn btn-primary">Get Started</a>
                    <a href="#features" class="btn btn-outline">Explore Features</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="about-stats">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-card reveal">
                    <div class="stat-number" data-count="15000">0</div>
                    <p>Active Freelancers</p>
                </div>
                <div class="stat-card reveal reveal-delay-1">
                    <div class="stat-number" data-count="8500">0</div>
                    <p>Projects Completed</p>
                </div>
                <div class="stat-card reveal reveal-delay-2">
                    <div class="stat-number" data-count="98">0</div>
                    <p>% Client Satisfaction</p>
                </div>
                <div class="stat-card reveal reveal-delay-3">
                    <div class="stat-number" data-count="12.5">0</div>
                    <p>Million+ Earned</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Freelance with Us -->
    <section class="why-section" id="features">
        <div class="container">
            <div class="section-head reveal">
                <h2>Why Freelance with Tech Leaders Network?</h2>
                <p>Everything you need to succeed as a freelancer, built into one powerful platform.</p>
            </div>

            <div class="features-grid">
                <div class="feature-card reveal">
                    <div class="feature-icon feature-icon-blue">
                        <svg viewBox="0 0 24 24" fill="none" width="28" height="28">
                            <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="2"/>
                            <path d="M16.5 16.5 21 21" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <h3>Smart Project Matching</h3>
                    <p>Our AI-powered algorithm connects you with projects that match your skills, experience, and preferences — so you spend less time searching and more time working.</p>
                </div>

                <div class="feature-card reveal reveal-delay-1">
                    <div class="feature-icon feature-icon-green">
                        <svg viewBox="0 0 24 24" fill="none" width="28" height="28">
                            <path d="M12 2 3 6v6c0 5 4 8 9 10 5-2 9-5 9-10V6l-9-4Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                            <path d="m8.5 12 2.5 2.5L16 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <h3>Secure Payments</h3>
                    <p>Get paid reliably with our escrow system. Funds are held securely and released only when you and your client are both satisfied with the work delivered.</p>
                </div>

                <div class="feature-card reveal reveal-delay-2">
                    <div class="feature-icon feature-icon-purple">
                        <svg viewBox="0 0 24 24" fill="none" width="28" height="28">
                            <path d="M4 21V8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9 21V13h6v8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <h3>Portfolio Showcase</h3>
                    <p>Create a professional portfolio that highlights your best work. Attract clients with your unique style, skills, and proven track record.</p>
                </div>

                <div class="feature-card reveal">
                    <div class="feature-icon feature-icon-pink">
                        <svg viewBox="0 0 24 24" fill="none" width="28" height="28">
                            <path d="M13 2 3 14h7l-1 8 10-12h-7l1-8Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <h3>Flexible Bidding</h3>
                    <p>Browse projects and submit competitive bids. Set your own rates, negotiate terms, and choose projects that align with your career goals.</p>
                </div>

                <div class="feature-card reveal reveal-delay-1">
                    <div class="feature-icon feature-icon-gold">
                        <svg viewBox="0 0 24 24" fill="none" width="28" height="28">
                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                            <path d="M12 6v6l4 2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <h3>Analytics & Insights</h3>
                    <p>Track your earnings, project performance, and client feedback. Use data-driven insights to improve your services and grow your freelance business.</p>
                </div>

                <div class="feature-card reveal reveal-delay-2">
                    <div class="feature-icon feature-icon-cyan">
                        <svg viewBox="0 0 24 24" fill="none" width="28" height="28">
                            <path d="M12 3 2 8l10 5 10-5-10-5Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                            <path d="M6 10.5V16c0 1.9 2.7 3.5 6 3.5s6-1.6 6-3.5v-5.5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <path d="M22 8v6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <h3>Community & Support</h3>
                    <p>Join a community of like-minded freelancers. Access resources, webinars, and 24/7 support to help you overcome challenges and achieve success.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="how-it-works-section" id="get-started">
        <div class="container">
            <div class="section-head reveal">
                <h2>How to Get Started</h2>
                <p>Three simple steps to launch your freelance career on Tech Leaders Network</p>
            </div>

            <div class="steps-container">
                <div class="step reveal">
                    <div class="step-number">01</div>
                    <div class="step-content">
                        <h3>Create Your Profile</h3>
                        <p>Sign up as a freelancer and build your professional profile. Showcase your skills, experience, and portfolio to attract the right clients.</p>
                        <span class="step-time">⏱️ Takes 5 minutes</span>
                    </div>
                </div>

                <div class="step reveal reveal-delay-1">
                    <div class="step-number">02</div>
                    <div class="step-content">
                        <h3>Find & Bid on Projects</h3>
                        <p>Browse thousands of projects across various categories. Submit proposals that highlight your expertise and win projects that match your goals.</p>
                        <span class="step-time">⏱️ Browse anytime</span>
                    </div>
                </div>

                <div class="step reveal reveal-delay-2">
                    <div class="step-number">03</div>
                    <div class="step-content">
                        <h3>Deliver & Get Paid</h3>
                        <p>Work on your projects, deliver high-quality results, and receive payments securely through our trusted escrow system. Build your reputation one project at a time.</p>
                        <span class="step-time">⏱️ Get paid instantly</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="testimonials-section">
        <div class="container">
            <div class="section-head reveal">
                <h2>What Freelancers Say</h2>
                <p>Real stories from freelancers who found success on Tech Leaders Network</p>
            </div>

            <div class="testimonials-grid">
                <div class="testimonial-card reveal">
                    <div class="testimonial-rating">⭐⭐⭐⭐⭐</div>
                    <p class="testimonial-text">
                        "Tech Leaders Network has completely transformed my freelance career. I've found consistent work, built amazing client relationships, and doubled my income in just 6 months."
                    </p>
                    <div class="testimonial-author">
                        <div class="author-avatar">JD</div>
                        <div class="author-info">
                            <h4>John Doe</h4>
                            <p>UI/UX Designer, 5+ projects</p>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card reveal reveal-delay-1">
                    <div class="testimonial-rating">⭐⭐⭐⭐⭐</div>
                    <p class="testimonial-text">
                        "The platform is intuitive and the client base is amazing. I love how easy it is to showcase my portfolio and connect with clients who value quality work."
                    </p>
                    <div class="testimonial-author">
                        <div class="author-avatar">SM</div>
                        <div class="author-info">
                            <h4>Sarah Miller</h4>
                            <p>Content Writer, 3+ years</p>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card reveal reveal-delay-2">
                    <div class="testimonial-rating">⭐⭐⭐⭐⭐</div>
                    <p class="testimonial-text">
                        "The secure payment system gives me peace of mind. I never have to worry about getting paid, and the support team is always there when I need them."
                    </p>
                    <div class="testimonial-author">
                        <div class="author-avatar">AK</div>
                        <div class="author-info">
                            <h4>Alex Kim</h4>
                            <p>Web Developer, 10+ projects</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        // ---- Animated stat counters ----
        const statNumbers = document.querySelectorAll('.stat-number');
        const statObserver = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    var el = entry.target;
                    var target = parseFloat(el.getAttribute('data-count'));
                    var duration = 1500;
                    var start = performance.now();

                    function tick(now) {
                        var progress = Math.min((now - start) / duration, 1);
                        if (Number.isInteger(target)) {
                            el.textContent = Math.floor(progress * target).toLocaleString();
                        } else {
                            el.textContent = (progress * target).toFixed(1);
                        }
                        if (progress < 1) {
                            requestAnimationFrame(tick);
                        } else {
                            if (Number.isInteger(target)) {
                                el.textContent = target.toLocaleString();
                            } else {
                                el.textContent = target.toFixed(1);
                            }
                        }
                    }
                    requestAnimationFrame(tick);
                    statObserver.unobserve(el);
                }
            });
        }, { threshold: 0.4 });
        statNumbers.forEach(function(el) {
            statObserver.observe(el);
        });

        // ---- Scroll reveal animation ----
        var revealEls = document.querySelectorAll('.reveal');
        var revealObserver = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });
        revealEls.forEach(function(el) {
            revealObserver.observe(el);
        });

    });
</script>

@endsection
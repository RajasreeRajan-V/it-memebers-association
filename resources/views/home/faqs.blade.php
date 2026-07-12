@extends('layouts.app')

@section('content')

<!-- FAQs Hero -->
<section class="hero" id="faqs">
    <div class="container hero-inner">

        <!-- Left Side Content -->
        <div class="hero-copy reveal">
            <p class="eyebrow">💬 Support Center</p>

            <h1>
                Frequently Asked<br />
                <span class="accent-text">Questions</span>
            </h1>

            <p class="home-hero-subtitle">Quick answers. No waiting around.</p>

            <p class="hero-sub">
                Answers to the most common questions about using SkillConnect —
                whatever portal you're coming from. Browse by topic below, or
                reach out to our support team if you can't find what you need.
            </p>

            <div class="hero-actions">
                <a href="#faq-list" class="btn btn-primary btn-lg">Browse Questions</a>
                <!-- <a href="#" class="btn btn-outline btn-lg">Contact Support</a> -->
            </div>

            <div class="hero-stats">
               
            </div>
        </div>

        <!-- Right Side Image -->
        <div class="hero-image reveal reveal-delay-1">
            <img
                src="{{ asset('assets/img/faq.png') }}"
                alt="FAQ"
                style="width: 800px; max-width: 100%; height: auto;">
        </div>

    </div>

    <!-- Quick Category Links -->
    <div class="container">
      
    </div>
</section>


<!-- FAQ Grid -->
<section class="portals" id="faq-list">
    <div class="container">
        <div class="section-head reveal">
            <h2>Common Questions</h2>
            <p>Can't find what you're looking for? Reach out to our support team.</p>
        </div>

        <div class="faq-grid" id="faqGrid">

            <div class="faq-card faq-blue reveal">
                <button type="button" class="faq-summary">
                    <span class="faq-tag">Getting Started</span>
                    <span class="faq-q">How do I create an account on SkillConnect?</span>
                    <span class="faq-toggle">+</span>
                </button>
                <div class="faq-panel">
                    <p>Click "Join Now" on the homepage, choose the portal that matches you
                        (Employer, Employee, Student, Freelancer, Investor or Mentor), and
                        fill in your details to get started in minutes.</p>
                </div>
            </div>

            <div class="faq-card faq-green reveal">
                <button type="button" class="faq-summary">
                    <span class="faq-tag">Pricing</span>
                    <span class="faq-q">Is SkillConnect free to use?</span>
                    <span class="faq-toggle">+</span>
                </button>
                <div class="faq-panel">
                    <p>Creating an account and browsing opportunities is free. Some premium
                        features for employers and investors may have associated plans —
                        check the pricing page for details.</p>
                </div>
            </div>

            <div class="faq-card faq-pink reveal">
                <button type="button" class="faq-summary">
                    <span class="faq-tag">Account</span>
                    <span class="faq-q">Can I switch between portals later?</span>
                    <span class="faq-toggle">+</span>
                </button>
                <div class="faq-panel">
                    <p>Yes. Your account isn't locked to a single portal — you can access
                        multiple portals (for example, Freelancer and Investor) from the
                        same login.</p>
                </div>
            </div>

            <div class="faq-card faq-yellow reveal">
                <button type="button" class="faq-summary">
                    <span class="faq-tag">Employers</span>
                    <span class="faq-q">How do employers verify applicants?</span>
                    <span class="faq-toggle">+</span>
                </button>
                <div class="faq-panel">
                    <p>Employers can review applicant profiles, portfolios and verified
                        skill badges directly within the Employer Portal before reaching
                        out.</p>
                </div>
            </div>

            <div class="faq-card faq-purple reveal">
                <button type="button" class="faq-summary">
                    <span class="faq-tag">Account</span>
                    <span class="faq-q">How do I reset my password?</span>
                    <span class="faq-toggle">+</span>
                </button>
                <div class="faq-panel">
                    <p>Go to the login page and click "Forgot password" — you'll receive a
                        reset link by email within a few minutes.</p>
                </div>
            </div>

            <div class="faq-card faq-cyan reveal">
                <button type="button" class="faq-summary">
                    <span class="faq-tag">Support</span>
                    <span class="faq-q">Who can I contact for support?</span>
                    <span class="faq-toggle">+</span>
                </button>
                <div class="faq-panel">
                    <p>You can reach our support team anytime through the contact form
                        linked in the footer, or email us directly and we'll get back to
                        you within 24 hours.</p>
                </div>
            </div>

            <div class="faq-card faq-blue reveal">
                <button type="button" class="faq-summary">
                    <span class="faq-tag">Payments</span>
                    <span class="faq-q">How do freelancers get paid?</span>
                    <span class="faq-toggle">+</span>
                </button>
                <div class="faq-panel">
                    <p>Payments are held securely until a project milestone is marked
                        complete, then released directly to the freelancer's linked
                        account.</p>
                </div>
            </div>

            <div class="faq-card faq-green reveal">
                <button type="button" class="faq-summary">
                    <span class="faq-tag">Privacy</span>
                    <span class="faq-q">Is my personal data safe on SkillConnect?</span>
                    <span class="faq-toggle">+</span>
                </button>
                <div class="faq-panel">
                    <p>Yes. We use industry-standard encryption and never sell your
                        personal data to third parties.</p>
                </div>
            </div>

        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
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

// FAQ accordion — event delegation, runs exactly once, guaranteed single-open
if (!window.__faqAccordionInit) {
    window.__faqAccordionInit = true;

    document.addEventListener('DOMContentLoaded', () => {
        const faqGrid = document.getElementById('faqGrid');
        if (!faqGrid) return;

        faqGrid.addEventListener('click', (e) => {
            const btn = e.target.closest('.faq-summary');
            if (!btn) return;

            const clickedCard = btn.closest('.faq-card');
            const wasOpen = clickedCard.classList.contains('is-open');

            faqGrid.querySelectorAll('.faq-card').forEach(card => {
                card.classList.remove('is-open');
                const p = card.querySelector('.faq-panel');
                if (p) p.style.maxHeight = null;
            });

            if (!wasOpen) {
                clickedCard.classList.add('is-open');
                const panel = clickedCard.querySelector('.faq-panel');
                panel.style.maxHeight = panel.scrollHeight + 'px';
            }
        });
    });
}
</script>

@endsection
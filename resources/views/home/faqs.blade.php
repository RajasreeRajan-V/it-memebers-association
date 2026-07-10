@extends('layouts.app')

@section('content')

<!-- FAQs Hero -->
<section class="hero" id="faqs">
    <div class="container hero-inner">
        <div class="hero-copy">
            <p class="eyebrow">Support</p>
            <h1>
                Frequently Asked<br />
                <span class="accent-text">Questions</span>
            </h1>
            <p class="hero-sub">
                Answers to the most common questions about using SkillConnect —
                whatever portal you're coming from.
            </p>
        </div>
    </div>
</section>

<!-- FAQ List -->
<section class="portals">
    <div class="container">
        <div class="section-head">
            <h2>Common Questions</h2>
            <p>Can't find what you're looking for? Reach out to our support team.</p>
        </div>

        <div class="faq-list">

            <details class="faq-item">
                <summary>How do I create an account on SkillConnect?</summary>
                <p>Click "Join Now" on the homepage, choose the portal that matches you
                    (Employer, Employee, Student, Freelancer, Investor or Mentor), and
                    fill in your details to get started in minutes.</p>
            </details>

            <details class="faq-item">
                <summary>Is SkillConnect free to use?</summary>
                <p>Creating an account and browsing opportunities is free. Some premium
                    features for employers and investors may have associated plans —
                    check the pricing page for details.</p>
            </details>

            <details class="faq-item">
                <summary>Can I switch between portals later?</summary>
                <p>Yes. Your account isn't locked to a single portal — you can access
                    multiple portals (for example, Freelancer and Investor) from the
                    same login.</p>
            </details>

            <details class="faq-item">
                <summary>How do employers verify applicants?</summary>
                <p>Employers can review applicant profiles, portfolios and verified
                    skill badges directly within the Employer Portal before reaching
                    out.</p>
            </details>

            <details class="faq-item">
                <summary>How do I reset my password?</summary>
                <p>Go to the login page and click "Forgot password" — you'll receive a
                    reset link by email within a few minutes.</p>
            </details>

            <details class="faq-item">
                <summary>Who can I contact for support?</summary>
                <p>You can reach our support team anytime through the contact form
                    linked in the footer, or email us directly and we'll get back to
                    you within 24 hours.</p>
            </details>

        </div>
    </div>
</section>

@endsection
@extends('layouts.app')

@section('content')

<!-- Contact Hero -->
<section class="hero hero-contact" id="contact">
    <div class="container hero-inner">

        <!-- Left Side Content -->
        <div class="hero-copy reveal">
            <p class="eyebrow">💬 Get in Touch</p>

            <h1>
                We'd Love<br />
                <span class="accent-text">to Hear From You</span>
            </h1>

            <p class="home-hero-subtitle">Real people. Real answers. No bots.</p>

            <p class="hero-sub">
                Questions, feedback or partnership ideas — send us a message and
                our team will get back to you within 24 hours. Whichever portal
                you're on, we're here to help you get the most out of Tech Leaders Network.
            </p>

            <div class="hero-actions">
                <a href="#contact-form" class="btn btn-primary btn-lg">Send a Message</a>
                <a href="mailto:support@Tech Leaders Network.com" class="btn btn-outline btn-lg">Email Us</a>
            </div>

            <div class="hero-stats">
                
            </div>
        </div>

        <!-- Right Side Image -->
        <div class="hero-image reveal reveal-delay-1">
            <img src="{{ asset('assets/img/contact.1.png') }}" alt="Contact Us">
        </div>

    </div>
</section>

<!-- Contact Form + Info -->
<section class="portals" id="contact-form">
    <div class="container">
        <div class="section-head reveal">
            <h2>Contact Us</h2>
            <p>Fill out the form below or reach us directly using the details provided.</p>
        </div>

        <div class="contact-grid">

            <!-- Left Column: Form + Support Hours -->
            <div class="contact-left-column">
                <form class="contact-form reveal" method="POST" action="">
                    @csrf

                    <div class="form-grid">
                        <div class="form-row">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" name="name" placeholder="Your name" required>
                        </div>

                        <div class="form-row">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" placeholder="you@example.com" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" name="subject" placeholder="What's this about?" required>
                    </div>

                    <div class="form-row">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="5" placeholder="Write your message..." required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg">Send Message</button>
                </form>

                <!-- Support Hours - Below Form on Left Side -->
                <div class="support-hours-section reveal reveal-delay-3" style="margin-top: 40px; padding: 30px; background: #f8f9fa; border-radius: 16px;">
                    <h4 style="font-size: 20px; margin-bottom: 20px; color: #1a1a2e;">Support Hours</h4>
                    <div class="hours-row" style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #e0e0e0;">
                        <span style="font-weight: 500;">Monday – Friday</span>
                        <span style="color: #555;">9:00 AM – 7:00 PM</span>
                    </div>
                    <div class="hours-row" style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #e0e0e0;">
                        <span style="font-weight: 500;">Saturday</span>
                        <span style="color: #555;">10:00 AM – 4:00 PM</span>
                    </div>
                    <div class="hours-row" style="display: flex; justify-content: space-between; padding: 10px 0;">
                        <span style="font-weight: 500;">Sunday</span>
                        <span style="color: #999;">Closed</span>
                    </div>
                </div>
            </div>

            <!-- Right Column: Contact Info Cards -->
            <div class="contact-info">

                <article class="portal-card portal-blue reveal reveal-delay-1">
                    <div class="portal-icon">
                        <svg viewBox="0 0 24 24" fill="none">
                            <path d="M4 4h16v16H4V4Z" stroke="currentColor" stroke-width="1.8"
                                stroke-linejoin="round" />
                            <path d="m4 6 8 7 8-7" stroke="currentColor" stroke-width="1.8"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div class="portal-body">
                        <h3>Email</h3>
                        <p>support@Tech Leaders Network.com</p>
                    </div>
                </article>

                <article class="portal-card portal-green reveal reveal-delay-2">
                    <div class="portal-icon">
                        <svg viewBox="0 0 24 24" fill="none">
                            <path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1.9.3 1.8.6 2.7a2 2 0 0 1-.4 2.1L8 9.9a16 16 0 0 0 6 6l1.4-1.4a2 2 0 0 1 2.1-.4c.9.3 1.8.5 2.7.6a2 2 0 0 1 1.8 2Z"
                                stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div class="portal-body">
                        <h3>Phone</h3>
                        <p>+1 (555) 123-4567</p>
                    </div>
                </article>

                <article class="portal-card portal-purple reveal reveal-delay-3">
                    <div class="portal-icon">
                        <svg viewBox="0 0 24 24" fill="none">
                            <path d="M12 21s-7-6.2-7-11a7 7 0 1 1 14 0c0 4.8-7 11-7 11Z" stroke="currentColor"
                                stroke-width="1.8" stroke-linejoin="round" />
                            <circle cx="12" cy="10" r="2.5" stroke="currentColor" stroke-width="1.8" />
                        </svg>
                    </div>
                    <div class="portal-body">
                        <h3>Office</h3>
                        <p>123 Innovation Street, Suite 400</p>
                    </div>
                </article>

            </div>
        </div>
    </div>
</section>

<script>
if (!window.__contactRevealInit) {
    window.__contactRevealInit = true;

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
}
</script>

<style>
/* Add this to your existing CSS or keep it inline */
.contact-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
    align-items: start;
}

.contact-left-column {
    display: flex;
    flex-direction: column;
}

@media (max-width: 768px) {
    .contact-grid {
        grid-template-columns: 1fr;
    }
}
</style>

@endsection
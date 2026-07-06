@extends('layouts.app')

@section('title','Terms of Service')

@section('content')

<style>
/*==================================================
            LEGAL PAGE — SHARED STYLE
==================================================*/
:root{
    --legal-ink:#181433;
    --legal-muted:#5c5a78;
    --legal-border:#dcdaec;
    --legal-bg:#e7e6f2;
    --legal-navy:#1E1B3A;
    --legal-gold:#E3A028;
}

body{ background:var(--legal-bg); }

.legal-hero{
    position:relative;
    background:linear-gradient(120deg,rgba(30,27,58,.93),rgba(22,20,50,.88));
    padding:72px 0 60px;
    text-align:center;
    color:#fff;
    overflow:hidden;
}

.legal-hero::after{
    content:"";
    position:absolute;
    inset:auto 0 0 0;
    height:60px;
    background:linear-gradient(to bottom, transparent, var(--legal-bg));
    pointer-events:none;
}

.legal-hero .eyebrow{
    display:inline-block;
    letter-spacing:.14em;
    text-transform:uppercase;
    font-size:11px;
    font-weight:700;
    color:var(--legal-gold);
    background:rgba(255,255,255,.06);
    border:1px solid rgba(255,255,255,.25);
    padding:6px 16px;
    border-radius:999px;
    margin-bottom:18px;
}

.legal-hero h1{
    font-size:36px;
    font-weight:800;
    margin-bottom:10px;
    letter-spacing:-.02em;
}

.legal-hero p.updated{
    font-size:13.5px;
    color:#d7d5e8;
    margin:0;
}

.legal-section{
    padding:0 0 90px;
    margin-top:-40px;
    position:relative;
    z-index:2;
}

.legal-card{
    background:#fff;
    border:1px solid var(--legal-border);
    border-radius:20px;
    box-shadow:0 10px 30px rgba(20,17,48,.08);
    padding:2.75rem 2.5rem;
    max-width:880px;
    margin:0 auto;
}

.legal-card h2{
    font-size:1.2rem;
    font-weight:800;
    color:var(--legal-ink);
    margin:2rem 0 .85rem;
    display:flex;
    align-items:center;
    gap:.6rem;
}

.legal-card h2:first-child{ margin-top:0; }

.legal-card h2 .num{
    width:30px;
    height:30px;
    border-radius:9px;
    background:rgba(227,160,40,.14);
    color:var(--legal-gold);
    font-size:.85rem;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    flex-shrink:0;
}

.legal-card p{
    color:var(--legal-muted);
    font-size:.94rem;
    line-height:1.8;
    margin-bottom:.9rem;
}

.legal-card ul{
    color:var(--legal-muted);
    font-size:.94rem;
    line-height:1.8;
    padding-left:1.25rem;
    margin-bottom:.9rem;
}

.legal-card ul li{ margin-bottom:.4rem; }

.legal-card a{
    color:var(--legal-navy);
    font-weight:600;
    text-decoration:underline;
}

.legal-toc{
    background:#f6f5fb;
    border:1px solid var(--legal-border);
    border-radius:14px;
    padding:1.25rem 1.5rem;
    margin-bottom:2rem;
}

.legal-toc h6{
    font-size:.78rem;
    font-weight:800;
    letter-spacing:.08em;
    text-transform:uppercase;
    color:var(--legal-muted);
    margin-bottom:.75rem;
}

.legal-toc ol{
    columns:2;
    -webkit-columns:2;
    padding-left:1.1rem;
    margin:0;
    font-size:.86rem;
}

.legal-toc ol li{ margin-bottom:.4rem; }

.legal-toc a{
    color:var(--legal-ink);
    text-decoration:none;
    font-weight:600;
}

.legal-toc a:hover{ color:var(--legal-navy); text-decoration:underline; }

@media(max-width:767px){
    .legal-card{ padding:1.75rem 1.4rem; }
    .legal-toc ol{ columns:1; }
    .legal-hero h1{ font-size:28px; }
}
</style>

<!-- HERO -->
<section class="legal-hero">
    <div class="container">
        <span class="eyebrow">Legal</span>
        <h1>Terms of Service</h1>
        <p class="updated">Last updated: {{ now()->format('F j, Y') }}</p>
    </div>
</section>

<!-- CONTENT -->
<section class="legal-section">
    <div class="container">
        <div class="legal-card">

            <div class="legal-toc">
                <h6>On this page</h6>
                <ol>
                    <li><a href="#acceptance">Acceptance of Terms</a></li>
                    <li><a href="#eligibility">Eligibility &amp; Roles</a></li>
                    <li><a href="#verification">Verification Process</a></li>
                    <li><a href="#conduct">Member Conduct</a></li>
                    <li><a href="#listings">Jobs, Bids &amp; Pitches</a></li>
                    <li><a href="#payments">Payments &amp; Payouts</a></li>
                    <li><a href="#content">Content &amp; Intellectual Property</a></li>
                    <li><a href="#termination">Suspension &amp; Termination</a></li>
                    <li><a href="#disclaimers">Disclaimers</a></li>
                    <li><a href="#liability">Limitation of Liability</a></li>
                    <li><a href="#changes">Changes to These Terms</a></li>
                    <li><a href="#contact-us">Contact Us</a></li>
                </ol>
            </div>

            <p>
                These Terms of Service ("Terms") govern your access to and use of the Nexus
                Association platform ("Nexus," "we," "us," or "our"). By creating an account or
                otherwise using Nexus, you agree to be bound by these Terms. If you do not agree,
                please do not use the platform.
            </p>

            <h2 id="acceptance"><span class="num">1</span> Acceptance of Terms</h2>
            <p>
                By registering for an account, you confirm that you have read, understood, and
                agree to these Terms and our <a href="{{ route('privacy-policy') }}">Privacy Policy</a>.
                We may update these Terms from time to time, and continued use of the platform after
                changes take effect constitutes your acceptance of the revised Terms.
            </p>

            <h2 id="eligibility"><span class="num">2</span> Eligibility &amp; Roles</h2>
            <p>
                Nexus is open to individuals and organizations registering under one of six roles:
                Student, Employee, Employer, Freelancer, Investor, or Mentor. You must be at least 16
                years old to register. You are responsible for selecting the role that accurately
                reflects your intended use of the platform, and for keeping your account details
                current. You may request a role upgrade at any time, subject to re-verification.
            </p>

            <h2 id="verification"><span class="num">3</span> Verification Process</h2>
            <p>
                All registrations, job posts, freelance bids, and investment pitches are subject to
                review by our admin team before becoming visible on the platform. We reserve the
                right to reject, suspend, or request additional information for any registration or
                listing that appears inaccurate, misleading, or in violation of these Terms.
            </p>

            <h2 id="conduct"><span class="num">4</span> Member Conduct</h2>
            <p>You agree not to:</p>
            <ul>
                <li>Provide false, misleading, or fraudulent information during registration or verification.</li>
                <li>Use the platform to harass, discriminate against, or defraud other members.</li>
                <li>Post job listings, pitches, or bids for illegal goods, services, or opportunities.</li>
                <li>Attempt to bypass the verification process or admin review workflows.</li>
                <li>Scrape, copy, or redistribute platform data without authorization.</li>
                <li>Circumvent the platform to avoid agreed fees on freelance transactions.</li>
            </ul>

            <h2 id="listings"><span class="num">5</span> Jobs, Bids &amp; Pitches</h2>
            <p>
                Employers are responsible for the accuracy of job and internship listings they post.
                Freelancers are responsible for the accuracy of bids and portfolio content. Investors
                and startups are responsible for the accuracy of pitch materials shared through the
                platform. Nexus verifies listings for authenticity but does not guarantee employment,
                funding, or business outcomes.
            </p>

            <h2 id="payments"><span class="num">6</span> Payments &amp; Payouts</h2>
            <p>
                Freelance payments made through Nexus are processed via our payment partners and
                released to freelancers only after admin confirmation that agreed work has been
                delivered. Nexus may charge a service fee on processed payments, which will be
                disclosed at the time of the transaction. Members are responsible for any taxes
                applicable to income earned through the platform.
            </p>

            <h2 id="content"><span class="num">7</span> Content &amp; Intellectual Property</h2>
            <p>
                You retain ownership of the content you submit (profiles, listings, pitches, articles,
                messages). By posting content on Nexus, you grant us a limited license to display,
                store, and distribute it within the platform for the purpose of operating our
                services. The Nexus name, logo, and platform design are the property of Nexus
                Association and may not be used without permission.
            </p>

            <h2 id="termination"><span class="num">8</span> Suspension &amp; Termination</h2>
            <p>
                We may suspend or terminate your account if you violate these Terms, provide false
                verification information, or engage in conduct that harms other members or the
                platform. You may close your account at any time by contacting our support team.
            </p>

            <h2 id="disclaimers"><span class="num">9</span> Disclaimers</h2>
            <p>
                Nexus provides a platform for connection and does not guarantee the accuracy of every
                member's claims, the outcome of any job application, freelance engagement, mentorship,
                or investment. The platform is provided "as is" without warranties of any kind, to the
                extent permitted by law.
            </p>

            <h2 id="liability"><span class="num">10</span> Limitation of Liability</h2>
            <p>
                To the maximum extent permitted by law, Nexus Association shall not be liable for any
                indirect, incidental, or consequential damages arising from your use of the platform,
                including disputes between members, failed transactions, or reliance on listings or
                pitches shared through the service.
            </p>

            <h2 id="changes"><span class="num">11</span> Changes to These Terms</h2>
            <p>
                We may revise these Terms periodically to reflect changes in our services or legal
                requirements. We will notify members of material changes via email or a notice on the
                platform prior to the changes taking effect.
            </p>

            <h2 id="contact-us"><span class="num">12</span> Contact Us</h2>
            <p>
                For questions about these Terms, please contact us at
                <a href="mailto:info@nexus.com">info@nexus.com</a> or visit our
                <a href="{{ route('contact') }}">Contact page</a>.
            </p>

        </div>
    </div>
</section>

@endsection
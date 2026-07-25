@extends('layouts.app')

@section('title','Privacy Policy')

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
        
        <h1>Privacy Policy</h1>
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
                    <li><a href="#info-we-collect">Information We Collect</a></li>
                    <li><a href="#how-we-use">How We Use Your Information</a></li>
                    <li><a href="#verification">Profile &amp; Listing Verification</a></li>
                    <li><a href="#sharing">How We Share Information</a></li>
                    <li><a href="#security">Data Security</a></li>
                    <li><a href="#retention">Data Retention</a></li>
                    <li><a href="#your-rights">Your Rights &amp; Choices</a></li>
                    <li><a href="#cookies">Cookies</a></li>
                    <li><a href="#children">Children's Privacy</a></li>
                    <li><a href="#changes">Changes to This Policy</a></li>
                    <li><a href="#contact-us">Contact Us</a></li>
                </ol>
            </div>

            <p>
                Nexus Association ("Nexus," "we," "us," or "our") operates a verified networking
                platform connecting students, employees, employers, freelancers, investors and
                mentors. This Privacy Policy explains what information we collect, how we use it,
                and the choices you have. By registering for or using Nexus, you agree to the
                practices described here.
            </p>

            <h2 id="info-we-collect"><span class="num">1</span> Information We Collect</h2>
            <p>We collect information you provide directly, information generated through your use of the platform, and information needed to verify accounts and listings:</p>
            <ul>
                <li><strong>Account information:</strong> name, email address, phone number, password, and the role you register under (Student, Employee, Employer, Freelancer, Investor, or Mentor).</li>
                <li><strong>Verification documents:</strong> ID proof, company details, resumes, portfolios, or pitch materials submitted for admin review.</li>
                <li><strong>Profile content:</strong> photos, bios, skills, job listings, project bids, startup pitches, and messages sent through the platform.</li>
                <li><strong>Usage data:</strong> pages visited, features used, device and browser information, and approximate location derived from IP address.</li>
                <li><strong>Payment information:</strong> for freelance payouts, processed through our payment partners; we do not store full card details on our servers.</li>
            </ul>

            <h2 id="how-we-use"><span class="num">2</span> How We Use Your Information</h2>
            <ul>
                <li>To create, verify, and maintain your account and role-based dashboard.</li>
                <li>To review and approve job posts, pitches, bids, and registrations before they go live.</li>
                <li>To match students, freelancers, mentors, employers, and investors with relevant opportunities.</li>
                <li>To process freelance payouts and monitor for fraudulent activity.</li>
                <li>To send account, verification, and transactional emails or WhatsApp updates.</li>
                <li>To improve platform features, security, and overall user experience.</li>
            </ul>

            <h2 id="verification"><span class="num">3</span> Profile &amp; Listing Verification</h2>
            <p>
                Every registration, job post, freelance bid, and investment pitch is reviewed by our
                admin team before it becomes visible to other members. Documents submitted for
                verification purposes are accessible only to authorized Nexus staff and are used
                solely to confirm authenticity — they are never displayed publicly on your profile.
            </p>

            <h2 id="sharing"><span class="num">4</span> How We Share Information</h2>
            <p>We do not sell your personal information. We may share information in these limited circumstances:</p>
            <ul>
                <li><strong>With other members:</strong> only the profile details you choose to display publicly (e.g., name, role, skills, listings).</li>
                <li><strong>With service providers:</strong> payment processors, email/WhatsApp delivery providers, and hosting infrastructure, under confidentiality obligations.</li>
                <li><strong>For legal reasons:</strong> if required by law, regulation, or valid legal process, or to protect the rights and safety of our members and platform.</li>
                <li><strong>Startup pitch data:</strong> shared only with verified Investors who request and are approved for access.</li>
            </ul>

            <h2 id="security"><span class="num">5</span> Data Security</h2>
            <p>
                We use encryption in transit, access controls, and regular security reviews to
                protect your data. Freelance payouts are released only after admin confirmation to
                reduce fraud risk. No method of transmission or storage is 100% secure, and we
                encourage you to use a strong, unique password for your account.
            </p>

            <h2 id="retention"><span class="num">6</span> Data Retention</h2>
            <p>
                We retain account and verification information for as long as your account is
                active, and for a reasonable period afterward to comply with legal obligations,
                resolve disputes, and enforce our agreements. You may request deletion of your
                account as described below.
            </p>

            <h2 id="your-rights"><span class="num">7</span> Your Rights &amp; Choices</h2>
            <ul>
                <li>Access, correct, or update your profile information at any time from your dashboard.</li>
                <li>Request a copy of the personal data we hold about you.</li>
                <li>Request deletion of your account and associated data, subject to legal retention requirements.</li>
                <li>Opt out of non-essential email or WhatsApp communications at any time.</li>
            </ul>

            <h2 id="cookies"><span class="num">8</span> Cookies</h2>
            <p>
                We use cookies and similar technologies to keep you signed in, remember your
                preferences, and understand how the platform is used.
            </p>

            <h2 id="children"><span class="num">9</span> Children's Privacy</h2>
            <p>
                Nexus is intended for users who are at least 16 years old. We do not knowingly
                collect personal information from children. If you believe a child has provided us
                with personal information, please contact us so we can remove it.
            </p>

            <h2 id="changes"><span class="num">10</span> Changes to This Policy</h2>
            <p>
                We may update this Privacy Policy from time to time. Material changes will be
                communicated via email or a notice on the platform before they take effect. Continued
                use of Nexus after changes take effect constitutes acceptance of the updated policy.
            </p>

            <h2 id="contact-us"><span class="num">11</span> Contact Us</h2>
            <p>
                If you have questions about this Privacy Policy or how your information is handled,
                reach out to us at <a href="mailto:info@nexus.com">info@nexus.com</a> or visit our
                <a href="{{ route('contact') }}">Contact page</a>.
            </p>

        </div>
    </div>
</section>

@endsection
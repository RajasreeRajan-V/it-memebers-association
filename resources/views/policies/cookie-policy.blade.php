@extends('layouts.app')

@section('title','Cookie Policy')

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

/* ---------- Cookie table ---------- */
.cookie-table{
    width:100%;
    border-collapse:collapse;
    margin:.5rem 0 1.5rem;
    font-size:.86rem;
}

.cookie-table th{
    text-align:left;
    background:#f6f5fb;
    color:var(--legal-ink);
    font-weight:800;
    padding:.65rem .85rem;
    border-bottom:1px solid var(--legal-border);
}

.cookie-table td{
    padding:.65rem .85rem;
    border-bottom:1px solid var(--legal-border);
    color:var(--legal-muted);
    vertical-align:top;
}

.cookie-table tr:last-child td{ border-bottom:none; }

@media(max-width:767px){
    .legal-card{ padding:1.75rem 1.4rem; }
    .legal-toc ol{ columns:1; }
    .legal-hero h1{ font-size:28px; }
    .cookie-table{ display:block; overflow-x:auto; white-space:nowrap; }
}
</style>

<!-- HERO -->
<section class="legal-hero">
    <div class="container">
        <span class="eyebrow">Legal</span>
        <h1>Cookie Policy</h1>
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
                    <li><a href="#what-are-cookies">What Are Cookies</a></li>
                    <li><a href="#how-we-use">How We Use Cookies</a></li>
                    <li><a href="#types">Types of Cookies We Use</a></li>
                    <li><a href="#third-party">Third-Party Cookies</a></li>
                    <li><a href="#managing">Managing Your Cookie Preferences</a></li>
                    <li><a href="#changes">Changes to This Policy</a></li>
                    <li><a href="#contact-us">Contact Us</a></li>
                </ol>
            </div>

            <p>
                This Cookie Policy explains how Nexus Association ("Nexus," "we," "us," or "our")
                uses cookies and similar technologies when you visit our platform, and how you can
                manage your preferences. It should be read alongside our
                <a href="{{ route('privacy-policy') }}">Privacy Policy</a>.
            </p>

            <h2 id="what-are-cookies"><span class="num">1</span> What Are Cookies</h2>
            <p>
                Cookies are small text files placed on your device when you visit a website. They
                help the site remember your actions and preferences over time, so you don't have to
                re-enter them every time you come back or move between pages.
            </p>

            <h2 id="how-we-use"><span class="num">2</span> How We Use Cookies</h2>
            <ul>
                <li>To keep you signed in to your Nexus dashboard securely.</li>
                <li>To remember your role, display preferences, and dismissed notifications.</li>
                <li>To understand how members use the platform, so we can improve features and performance.</li>
                <li>To protect the platform from fraudulent activity, such as fake registrations or bids.</li>
            </ul>

            <h2 id="types"><span class="num">3</span> Types of Cookies We Use</h2>
            <table class="cookie-table">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Purpose</th>
                        <th>Duration</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Essential</strong></td>
                        <td>Required for login, security, and core dashboard functionality. The platform cannot function properly without these.</td>
                        <td>Session / up to 30 days</td>
                    </tr>
                    <tr>
                        <td><strong>Preference</strong></td>
                        <td>Remembers settings like your selected role view, language, or dismissed banners.</td>
                        <td>Up to 6 months</td>
                    </tr>
                    <tr>
                        <td><strong>Analytics</strong></td>
                        <td>Helps us understand aggregate usage patterns, such as which features and listings are most viewed.</td>
                        <td>Up to 12 months</td>
                    </tr>
                    <tr>
                        <td><strong>Security</strong></td>
                        <td>Detects suspicious login attempts and helps prevent fraudulent registrations, bids, and payouts.</td>
                        <td>Session / up to 30 days</td>
                    </tr>
                </tbody>
            </table>

            <h2 id="third-party"><span class="num">4</span> Third-Party Cookies</h2>
            <p>
                Some cookies may be set by trusted third-party services we use for analytics,
                payment processing, or content delivery. These providers may collect information
                about your visits to Nexus and other websites in accordance with their own privacy
                policies. We do not control these third-party cookies directly.
            </p>

            <h2 id="managing"><span class="num">5</span> Managing Your Cookie Preferences</h2>
            <p>
                Most web browsers let you control cookies through their settings, including blocking
                or deleting them. Please note that disabling essential cookies may prevent you from
                logging in or using key features of the Nexus dashboard. You can typically manage
                cookie settings under your browser's "Privacy" or "Security" menu.
            </p>

            <h2 id="changes"><span class="num">6</span> Changes to This Policy</h2>
            <p>
                We may update this Cookie Policy from time to time to reflect changes in the cookies
                we use or for legal reasons. We encourage you to review this page periodically for
                the latest information.
            </p>

            <h2 id="contact-us"><span class="num">7</span> Contact Us</h2>
            <p>
                If you have questions about our use of cookies, contact us at
                <a href="mailto:info@nexus.com">info@nexus.com</a> or visit our
                <a href="{{ route('contact') }}">Contact page</a>.
            </p>

        </div>
    </div>
</section>

@endsection
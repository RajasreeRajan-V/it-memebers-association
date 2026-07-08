@extends('layouts.app')

@section('title','About')

@section('content')

<style>
/*==================================================
        ABOUT PAGE — EDITORIAL, FLOWING LAYOUT
==================================================*/

:root{
    --primary: #E3A028;
    --primary-dark:#1e1b3a;
    --ink:#181433;
    --muted:#5c5a78;
    --border:#dcdaec;
    --surface:#ffffff;
    --bg:#e7e6f2;
    --navy:#1e1b3a;
    --navy-2:#141130;
    --navy-border:#33305a;
    --teal-deep:#0f766e;
    --indigo:#6d5fd8;
    --sky:#2f6f9e;
    --amber:#c98a1e;
    --mint-strong:#0d9488;
    --radius-lg:20px;
    --radius-md:12px;
}

.about-page{ background:var(--bg); scroll-behavior:smooth; }
.about-page *{ box-sizing:border-box; }

#mission-vision{ scroll-margin-top:90px; }

.about-page .section-tag{
    color:var(--primary-dark);
    font-size:11px;
    font-weight:800;
    text-transform:uppercase;
    letter-spacing:.09em;
    display:inline-flex;
    align-items:center;
    gap:6px;
    margin-bottom:8px;
}

.about-page .section-tag::after{
    content:"";
    width:20px;
    height:2px;
    background:var(--teal-deep);
    display:inline-block;
    border-radius:2px;
}

.about-page .section-title{
    font-weight:800;
    color:var(--ink);
    letter-spacing:-.02em;
    font-size:24px;
    margin-bottom:10px;
}

.about-page .section-sub{
    color:var(--muted);
    font-size:14px;
    line-height:1.7;
    max-width:680px;
}

.about-page .lede{
    color:var(--muted);
    font-size:14.5px;
    line-height:1.75;
    max-width:760px;
}

/* ---------- Hero ---------- */
.about-hero{
    position:relative;
    padding:58px 0 48px;
    background:
        linear-gradient(125deg, rgba(19,16,45,.93) 0%, rgba(28,25,56,.88) 50%, rgba(22,19,48,.95) 100%),
        url('https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&w=1600&q=80') center 32% / cover no-repeat;
    color:#fff;
    overflow:hidden;
}

.about-hero::before{
    content:"";
    position:absolute;
    width:380px;
    height:380px;
    background:rgba(94,234,212,.08);
    border-radius:50%;
    top:-150px;
    right:-110px;
    filter:blur(2px);
}

.about-hero::after{
    content:"";
    position:absolute;
    width:280px;
    height:280px;
    background:rgba(109,95,216,.14);
    border-radius:50%;
    bottom:-140px;
    left:-80px;
}

.about-hero .eyebrow{
    display:inline-flex;
    align-items:center;
    gap:6px;
    letter-spacing:.1em;
    text-transform:uppercase;
    font-size:10.5px;
    font-weight:700;
    color:var(--primary);
    background:rgba(94,234,212,.1);
    border:1px solid rgba(94,234,212,.35);
    padding:5px 13px;
    border-radius:999px;
    margin-bottom:16px;
}

.about-hero h1{
    font-size:31px;
    font-weight:800;
    letter-spacing:-.02em;
    line-height:1.2;
    margin-bottom:14px;
    position:relative;
    z-index:2;
    max-width:640px;
}

.about-hero h1 .accent{ color:var(--primary); }

.about-hero p{
    font-size:14px;
    line-height:1.75;
    color:#d7d5e8;
    margin-bottom:12px;
    max-width:600px;
    position:relative;
    z-index:2;
}

.about-hero .hero-actions{ margin-top:10px; }

.btn-white-pill{
    background:#fff;
    color:#000;
    border:1px solid #e5e7eb;
    border-radius:50px;
    padding:10px 24px;
    font-weight:700;
    font-size:12.5px;
    text-decoration:none;
    display:inline-flex;
    align-items:center;
    gap:7px;
    margin-top:6px;
    position:relative;
    z-index:2;
    box-shadow:0 10px 20px rgba(0,0,0,.2);
    transition:all .2s ease;
}

.btn-white-pill:hover{
    background:#f8f9fa;
    color:#000;
    transform:translateY(-2px);
    box-shadow:0 12px 24px rgba(0,0,0,.25);
}

.btn-outline-pill{
    background:transparent;
    color:#fff;
    border:1px solid rgba(255,255,255,.35);
    border-radius:50px;
    padding:10px 24px;
    font-weight:700;
    font-size:12.5px;
    text-decoration:none;
    display:inline-flex;
    align-items:center;
    gap:7px;
    margin-top:6px;
    margin-left:10px;
    position:relative;
    z-index:2;
    transition:all .2s ease;
}

.btn-outline-pill:hover{ background:rgba(255,255,255,.1); color:#fff; border-color:rgba(255,255,255,.55); transform:translateY(-2px); }

/* ---- Hero stat panel (right rail) ---- */
.hero-stat-panel{
    position:relative;
    z-index:2;
    background:rgba(255,255,255,.06);
    border:1px solid rgba(255,255,255,.16);
    border-radius:var(--radius-lg);
    padding:22px 22px 18px;
    backdrop-filter:blur(8px);
    height:100%;
}

.hero-stat-panel .panel-label{
    font-size:10px;
    font-weight:800;
    letter-spacing:.1em;
    text-transform:uppercase;
    color:var(--primary);
    margin-bottom:16px;
    display:block;
}

.hero-stats{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:18px 20px;
}

.hero-stats .stat{ text-align:left; }

.hero-stats h3{
    color:var(--primary);
    font-weight:800;
    font-size:21px;
    margin-bottom:2px;
    line-height:1.1;
}

.hero-stats span{
    font-size:10.5px;
    text-transform:uppercase;
    letter-spacing:.06em;
    color:#a9a7c4;
}

/* ---------- Generic section spacing ---------- */
.about-section{ padding:46px 0; }
.about-section.bg-soft{ background:#f0effa; }
.about-section.tight{ padding-top:0; }
.about-section + .about-section{ border-top:1px solid var(--border); }
.about-section.bg-soft + .about-section.bg-soft{ border-top:none; }

/* ---------- Story: flowing text, no card ---------- */
.story-layout{
    display:flex;
    gap:44px;
    align-items:flex-start;
}

.story-layout .story-copy{ flex:1.5; }

.story-layout p{
    color:var(--muted);
    font-size:14px;
    line-height:1.78;
    margin:0 0 14px;
}

.pull-quote{
    flex:1;
    border-left:3px solid var(--primary);
    padding:4px 0 4px 22px;
    font-weight:700;
    font-size:17px;
    line-height:1.55;
    color:var(--ink);
    align-self:center;
    position:relative;
}

.pull-quote span{
    display:block;
    margin-top:12px;
    font-weight:600;
    font-size:11.5px;
    color:var(--muted);
    text-transform:uppercase;
    letter-spacing:.06em;
}

/* ---------- Mission / Vision: split statement with ghost numerals ---------- */
.mv-row{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:0;
    margin-top:8px;
    border-top:1px solid var(--border);
}

.mv-col{
    position:relative;
    padding:28px 40px 8px 0;
    overflow:hidden;
}

.mv-col:last-child{
    padding-left:44px;
    padding-right:0;
    border-left:1px solid var(--border);
}

.mv-col::before{
    content:attr(data-num);
    position:absolute;
    top:6px;
    right:8px;
    font-size:88px;
    font-weight:800;
    color:var(--ink);
    opacity:.05;
    line-height:1;
    z-index:0;
    pointer-events:none;
}

.mv-col:last-child::before{ right:auto; left:12px; }

.mv-col h4{
    font-weight:800;
    color:var(--ink);
    font-size:19px;
    letter-spacing:-.01em;
    margin-bottom:10px;
    position:relative;
    z-index:1;
}

.mv-col p{
    color:var(--muted);
    font-size:13.5px;
    line-height:1.8;
    margin:0;
    max-width:420px;
    position:relative;
    z-index:1;
}

/* ---------- How It Works: horizontal timeline, no cards ---------- */
.timeline{
    position:relative;
    display:grid;
    grid-template-columns:repeat(4, 1fr);
    gap:24px;
    margin-top:14px;
}

.timeline::before{
    content:"";
    position:absolute;
    top:11px;
    left:4%;
    right:4%;
    height:1px;
    background:var(--border);
}

.timeline-step{ position:relative; padding-top:38px; }

.timeline-step .dot{
    position:absolute;
    top:0;
    left:0;
    width:23px;
    height:23px;
    border-radius:50%;
    background:#8682AD;
    color:#fff;
    font-size:11px;
    font-weight:800;
    display:flex;
    align-items:center;
    justify-content:center;
    z-index:1;
    box-shadow:0 0 0 5px var(--bg);
}

.timeline-step h5{
    font-weight:700;
    color:var(--ink);
    font-size:14.5px;
    margin:0 0 6px;
    display:flex;
    align-items:center;
    gap:7px;
}

.timeline-step h5 svg{ color:var(--primary-dark); flex-shrink:0; }

.timeline-step p{
    margin:0;
    color:var(--muted);
    font-size:12.5px;
    line-height:1.65;
}

/* ---------- Values: soft-tinted panels (distinct model) ---------- */
.value-tint-grid{
    display:grid;
    grid-template-columns:repeat(2, 1fr);
    gap:20px;
    margin-top:16px;
}

.value-tint{
    border-radius:18px;
    padding:28px 26px;
    background:var(--tint-bg);
    transition:transform .18s ease, box-shadow .18s ease;
}

.value-tint:hover{
    transform:translateY(-3px);
    box-shadow:0 14px 30px rgba(24,20,51,.08);
}

.value-tint .tint-dot{
    width:10px;
    height:10px;
    border-radius:3px;
    background:var(--tint-accent);
    margin-bottom:14px;
}

.value-tint h5{
    font-weight:800;
    font-size:18px;
    letter-spacing:-.01em;
    color:var(--ink);
    margin-bottom:9px;
}

.value-tint p{
    color:var(--muted);
    font-size:13.3px;
    line-height:1.75;
    margin:0;
    max-width:420px;
}

@media(max-width:767px){
    .value-tint-grid{ grid-template-columns:1fr; }
}

/* ---------- Ecosystem: colorful icon tiles (catalog feel, distinct from lists above) ---------- */
.role-grid{
    display:grid;
    grid-template-columns:repeat(3, 1fr);
    gap:18px;
    margin-top:16px;
}

.role-tile{
    background:var(--surface);
    border:1px solid var(--border);
    border-radius:var(--radius-md);
    padding:22px 20px;
    transition:transform .18s ease, box-shadow .18s ease, border-color .18s ease;
}

.role-tile:hover{
    transform:translateY(-4px);
    box-shadow:0 16px 32px rgba(24,20,51,.10);
    border-color:transparent;
}

.role-tile .role-icon{
    width:40px;
    height:40px;
    border-radius:10px;
    display:flex;
    align-items:center;
    justify-content:center;
    color:#fff;
    margin-bottom:14px;
}

.role-tile h5{
    font-weight:700;
    color:var(--ink);
    font-size:14.5px;
    margin:0 0 6px;
}

.role-tile p{
    color:var(--muted);
    font-size:12.8px;
    line-height:1.62;
    margin:0;
}

.role-icon.rt-student{ background:var(--indigo); }
.role-icon.rt-employee{ background:var(--sky); }
.role-icon.rt-employer{ background:var(--teal-deep); }
.role-icon.rt-freelancer{ background:var(--mint-strong); }
.role-icon.rt-investor{ background:var(--amber); }
.role-icon.rt-mentor{ background:var(--navy); }

@media(max-width:991px){
    .role-grid{ grid-template-columns:repeat(2, 1fr); }
}
@media(max-width:576px){
    .role-grid{ grid-template-columns:1fr; }
}

/* ---------- Testimonials: quotes separated by rules, no card grid ---------- */
.quote-strip{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:0 40px;
}

.quote-item{
    padding:18px 0;
    border-top:1px solid var(--border);
}

.quote-item p{
    font-size:13.5px;
    line-height:1.7;
    color:var(--ink);
    font-style:italic;
    margin:0 0 8px;
}

.quote-item .who{
    font-size:12px;
    font-weight:700;
    color:var(--muted);
    font-style:normal;
}

/* ---------- FAQ: simple stacked Q&A ---------- */
.faq-list{ margin-top:10px; }

.faq-item{
    padding:18px 2px;
    border-bottom:1px solid var(--border);
    transition:background .18s ease, padding-left .18s ease;
    border-radius:8px;
}

.faq-item:hover{ background:rgba(94,234,212,.06); padding-left:10px; }

.faq-item:first-child{ border-top:1px solid var(--border); }

.faq-item h5{
    font-weight:700;
    color:var(--ink);
    font-size:14.5px;
    margin:0 0 6px;
    display:flex;
    align-items:center;
    gap:8px;
}

.faq-item h5::before{
    content:"Q.";
    color:var(--teal-deep);
    font-weight:800;
    font-size:12px;
}

.faq-item p{
    color:var(--muted);
    font-size:13.5px;
    line-height:1.72;
    margin:0 0 0 20px;
    max-width:760px;
}

/* ---------- CTA: plain, no heavy panel ---------- */
.cta-plain{
    text-align:center;
    max-width:560px;
    margin:0 auto;
}

.cta-plain h2{
    font-weight:800;
    letter-spacing:-.02em;
    font-size:23px;
    color:var(--ink);
    margin-bottom:9px;
}

.cta-plain p{
    font-size:13.5px;
    color:var(--muted);
    margin:0 0 18px;
}

.cta-plain .btn-dark-pill{
    background:var(--navy);
    color:#fff;
    border-radius:50px;
    padding:11px 28px;
    font-weight:700;
    font-size:12.5px;
    text-decoration:none;
    display:inline-flex;
    align-items:center;
    gap:7px;
    box-shadow:0 10px 22px rgba(30,27,58,.28);
    transition:all .2s ease;
}

.cta-plain .btn-dark-pill:hover{ background:var(--navy-2); color:#fff; transform:translateY(-2px); }

/* ---------- Responsive ---------- */
@media(max-width:991px){
    .timeline{ grid-template-columns:repeat(2, 1fr); }
    .timeline::before{ display:none; }
    .value-list{ grid-template-columns:1fr; }
    .quote-strip{ grid-template-columns:1fr; }
    .mv-row{ grid-template-columns:1fr; }
    .hero-stat-panel{ margin-top:28px; }
}

@media(max-width:767px){
    .story-layout{ flex-direction:column; }
    .pull-quote{ border-left:3px solid var(--primary); padding-left:16px; }
}

@media(max-width:576px){
    .timeline{ grid-template-columns:1fr; }
    .about-hero h1{ font-size:24px; }
    .hero-stats{ grid-template-columns:1fr 1fr; }
}

</style>

<div class="about-page">

  <!-- HERO -->
  <section class="about-hero">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-8">
                <span class="eyebrow">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none"><path d="M12 3 4 6v6c0 5 3.4 8.7 8 9 4.6-.3 8-4 8-9V6l-8-3Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg>
                    Trusted Professional Network
                </span>
                <h1>Connecting <span style="color:#E3A028;">Talent</span> with Real Opportunities</h1>
                <p>Nexus Association brings students, professionals, businesses, freelancers, investors, and mentors into one verified ecosystem — a single place where every profile is checked, every opportunity is real, and every connection is worth making.</p>
                <p>We built Nexus because talent is everywhere but opportunity isn't always easy to find. Whether you're looking for your first internship, hiring your next engineer, raising a seed round, or mentoring the next generation, Nexus gives you a trusted place to do it.</p>
                <div class="hero-actions">
                    <a href="/" class="btn-white-pill">
                        Explore Nexus
                        <svg viewBox="0 0 24 24" width="13" height="13" fill="none"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                    <a href="#HOW-IT-WORKS" class="btn-outline-pill">How it works</a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="hero-stat-panel">
                    <span class="panel-label">By the Numbers</span>
                    <div class="hero-stats">
                        <div class="stat">
                            <h3>10K+</h3>
                            <span>Members</span>
                        </div>
                        <div class="stat">
                            <h3>500+</h3>
                            <span>Employers</span>
                        </div>
                        <div class="stat">
                            <h3>300+</h3>
                            <span>Mentors</span>
                        </div>
                        <div class="stat">
                            <h3>₹45L+</h3>
                            <span>Deployed</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>





 <!-- MISSION & VISION -->
  <section class="about-section bg-soft" id="mission-vision">
    <div class="container">
        <span class="section-tag">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none"><path d="M12 21s-7-4.35-9.5-8.5C.5 8.5 3 5 6.5 5c2 0 3.3 1 4 2 .7-1 2-2 4-2C18 5 20.5 8.5 18.5 12.5 16 16.65 12 21 12 21Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg>
            Purpose
        </span>
        <h2 class="section-title">Mission & Vision</h2>

        <div class="mv-row">
            <div class="mv-col" data-num="01">
                <h4>Our Mission</h4>
                <p>To remove the friction between talent and opportunity by building a single, verified ecosystem where students, professionals, businesses, freelancers, investors, and mentors can find each other, trust each other, and grow together — without the noise, spam, and fake listings that plague open platforms.</p>
            </div>
            <div class="mv-col" data-num="02">
                <h4>Our Vision</h4>
                <p>A future where career growth, business hiring, freelance work, mentorship, and early-stage investment all run through trusted, transparent networks — where a verified badge means something, and where no one is left out of an opportunity simply because they didn't know the right person.</p>
            </div>
        </div>
    </div>
  </section>




  <!-- STORY -->
  <section class="about-section">
    <div class="container">
        <span class="section-tag">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none"><path d="M4 19.5V6a2 2 0 0 1 2-2h13v15H6a2 2 0 0 0-2 2Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg>
            Our Story
        </span>
        <h2 class="section-title">Why Nexus Was Built</h2>

        <div class="story-layout">
            <div class="story-copy">
                <p>Nexus started with a simple observation: talent has never been the scarce resource — trust has. A brilliant student in a small town, a freelancer with years of unseen work, a founder with a real idea but no warm introduction to investors — all of them are held back not by ability, but by the absence of a place where their credentials mean something to a stranger on the other side of the screen.</p>
                <p>So we built one. Every member who joins Nexus — student, employee, employer, freelancer, investor, or mentor — goes through a verification step before they can post, apply, or connect. It slows things down by a day or two. It also means that when a job is posted, it's a real job, and when a profile says "verified," it actually is.</p>
                <p>What started as a small directory has grown into a full ecosystem: job boards, mentorship, resume reviews, hackathons, freelance bidding, startup pitch access, legal help for employees, and more — all run through the same admin-verified pipeline, all inside one platform.</p>
            </div>
            <div class="pull-quote">
                “Every profile is verified. Every opportunity is real.”
                <span style="color:#E3A028;">The principle behind everything we build</span>
            </div>
        </div>
    </div>
  </section>






<section class="about-section bg-soft">
    <div class="container">
        <span class="section-tag">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none"><path d="M12 21s-7-4.35-9.5-8.5C.5 8.5 3 5 6.5 5c2 0 3.3 1 4 2 .7-1 2-2 4-2C18 5 20.5 8.5 18.5 12.5 16 16.65 12 21 12 21Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg>
            Core Values
        </span>
        <h2 class="section-title">What Drives Us</h2>

        <div class="value-tint-grid">
            <div class="value-tint" style="--tint-bg:rgba(13,148,136,.09); --tint-accent:var(--mint-strong);">
                <div class="tint-dot"></div>
                <h5>Trust</h5>
                <p>Every member is verified before they can post, apply, or connect. Trust isn't a badge we hand out — it's the reason the platform works at all.</p>
            </div>
            <div class="value-tint" style="--tint-bg:rgba(109,95,216,.09); --tint-accent:var(--indigo);">
                <div class="tint-dot"></div>
                <h5>Growth</h5>
                <p>Whether you're applying for your first internship or raising your Series A, Nexus is built to meet you at your current stage and grow with you.</p>
            </div>
            <div class="value-tint" style="--tint-bg:rgba(201,138,30,.10); --tint-accent:var(--amber);">
                <div class="tint-dot"></div>
                <h5>Transparency</h5>
                <p>Every approval, rejection, and payment goes through a clear, visible process, so you always know exactly where your application or listing stands.</p>
            </div>
            <div class="value-tint" style="--tint-bg:rgba(47,111,158,.09); --tint-accent:var(--sky);">
                <div class="tint-dot"></div>
                <h5>Community</h5>
                <p>Mentors review resumes for free, employees help each other with legal questions, and founders get real feedback — because a network is only as strong as its members' willingness to help.</p>
            </div>
        </div>
    </div>
  </section>




 

  <!-- HOW IT WORKS -->
  <section class="about-section">
    <div class="container">
        <span class="section-tag">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none"><path d="M4 20 10 4h4l6 16M7 14h10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
            Our Journey
        </span>
        <h2 class="section-title">How It Works</h2>
        <p class="section-sub">Getting onto Nexus takes four steps, and every one of them exists to keep the network trustworthy — for you and for everyone you'll connect with.</p>

        <div class="timeline">
            <div class="timeline-step">
                <span class="dot">1</span>
                <h5>
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none"><path d="m17 3 4 4L8 20H4v-4L17 3Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg>
                    Register
                </h5>
                <p>Create your profile as a student, employee, employer, freelancer, investor, or mentor, with details specific to your role.</p>
            </div>
            <div class="timeline-step">
                <span class="dot">2</span>
                <h5>
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none"><path d="m5 13 4 4L19 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    Get Verified
                </h5>
                <p>Our admin team checks your submitted details — ID, experience, GST, portfolio, or credentials — before approving your account.</p>
            </div>
            <div class="timeline-step">
                <span class="dot">3</span>
                <h5>
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none"><path d="M9 12a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" stroke="currentColor" stroke-width="1.8"/></svg>
                    Connect
                </h5>
                <p>Browse jobs, projects, pitch decks, or mentors, and reach out directly — every request still passes through a quick admin check.</p>
            </div>
            <div class="timeline-step">
                <span class="dot">4</span>
                <h5>
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none"><path d="M12 2c3 3 5 6.5 5 10a5 5 0 0 1-10 0c0-3.5 2-7 5-10Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg>
                    Grow
                </h5>
                <p>Land the job, close the bid, secure the investor, or finish the mentorship — then upgrade your role as your needs change.</p>
            </div>
        </div>
    </div>
  </section>

  <!-- VALUES -->
  

  <!-- ECOSYSTEM -->
  <section class="about-section">
    <div class="container">
        <span class="section-tag">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.8"/><path d="M3 12h18M12 3c2.5 2.5 4 5.7 4 9s-1.5 6.5-4 9c-2.5-2.5-4-5.7-4-9s1.5-6.5 4-9Z" stroke="currentColor" stroke-width="1.8"/></svg>
            Our Ecosystem
        </span>
        <h2 class="section-title">One Platform, Six Roles</h2>
        <p class="section-sub">Every member type has its own dashboard, its own verification checklist, and its own set of tools — but everyone shares the same trusted network.</p>

        <div class="role-grid">
            <div class="role-tile">
                <span class="role-icon rt-student"><svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#fff"><path d="m2 9 10-5 10 5-10 5-10-5Z" stroke-width="1.8" stroke-linejoin="round"/></svg></span>
                <h5>Student</h5>
                <p>Applies for jobs and internships, enrolls in courses, requests resume reviews, joins mentorship, and takes part in hackathons — all verified with a college ID.</p>
            </div>
            <div class="role-tile">
                <span class="role-icon rt-employee"><svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#fff"><rect x="4" y="8" width="16" height="12" rx="2" stroke-width="1.8"/><path d="M9 8V6a3 3 0 0 1 6 0v2" stroke-width="1.8"/></svg></span>
                <h5>Employee</h5>
                <p>Explores new roles on the side, publishes technical articles, requests legal help, and registers for training — while continuing to grow in a current job.</p>
            </div>
            <div class="role-tile">
                <span class="role-icon rt-employer"><svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#fff"><path d="M4 21V9l7-5 7 5v12" stroke-width="1.8" stroke-linejoin="round"/></svg></span>
                <h5>Employer</h5>
                <p>Posts jobs, outsourced projects, internships, and startup pitches after a GST/PAN check, then reviews applications and hires directly through the platform.</p>
            </div>
            <div class="role-tile">
                <span class="role-icon rt-freelancer"><svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#fff"><rect x="3" y="5" width="18" height="12" rx="2" stroke-width="1.8"/></svg></span>
                <h5>Freelancer</h5>
                <p>Bids on open projects, lists services, uploads a portfolio for review, and requests payment release once an employer confirms the work is complete.</p>
            </div>
            <div class="role-tile">
                <span class="role-icon rt-investor"><svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#fff"><path d="M21 12a9 9 0 1 1-6-8.5" stroke-width="1.8" stroke-linecap="round"/><path d="M21 3v6h-6" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                <h5>Investor</h5>
                <p>Browses verified startup profiles, requests full pitch-deck access, connects with founders, and posts investment criteria to be matched automatically.</p>
            </div>
            <div class="role-tile">
                <span class="role-icon rt-mentor"><svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#fff"><rect x="3" y="4" width="18" height="12" rx="2" stroke-width="1.8"/><path d="M8 20h8M12 16v4" stroke-width="1.8" stroke-linecap="round"/></svg></span>
                <h5>Mentor</h5>
                <p>Accepts mentee requests, reviews resumes, hosts webinars and workshops, uploads training material, and conducts mock interviews — free of charge.</p>
            </div>
        </div>
    </div>
  </section>

  

 

  <!-- CTA -->
  <section class="about-section bg-soft">
    <div class="container">
        <div class="cta-plain">
            <h2>Ready to Join Nexus?</h2>
            <p>Become part of a verified professional ecosystem built for students, professionals, businesses, freelancers, investors, and mentors alike.</p>
            <a href="#" class="btn-dark-pill">
                Join Now
                <svg viewBox="0 0 24 24" width="13" height="13" fill="none"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </a>
        </div>
    </div>
  </section>

</div>

@endsection
@extends('layouts.app')

@section('title','Events')

@section('content')

<style>
/*==================================================
            EVENTS PAGE — PROFESSIONAL REDESIGN
==================================================*/

:root{
    --primary:;
    --primary-dark:#1e1b3a;
    --ink:#181433;
    --muted:#5c5a78;
    --border:#dcdaec;
    --surface:#ffffff;
    --bg:#e7e6f2;
    --navy:#1e1b3a;
    --navy-2:#141130;
    --navy-border:#33305a;
    --radius-lg:22px;
    --radius-md:14px;
    --shadow-soft:0 10px 30px rgba(20,17,48,.08);
    --shadow-hover:0 20px 45px rgba(20,17,48,.14);
}

body{
    background:var(--bg);
}

/* ---------- Hero ---------- */
.events-hero{
    position:relative;
    background:
        linear-gradient(120deg,rgba(20,17,48,.93),rgba(30,27,58,.88)),
        url('{{ asset("assets/img/cloud1.png") }}') center center/cover;
    padding:64px 0 56px;
    text-align:center;
    color: #D89628;
    overflow:hidden;
}

.events-hero::after{
    content:"";
    position:absolute;
    inset:auto 0 0 0;
    height:50px;
    background:linear-gradient(to bottom, transparent, var(--bg));
    pointer-events:none;
}

.events-hero .eyebrow{
    display:inline-block;
    letter-spacing:.14em;
    text-transform:uppercase;
    font-size:11.5px;
    font-weight:700;
    color:var(--primary);
    background:rgba(94,234,212,.1);
    border:1px solid rgba(94,234,212,.35);
    padding:5px 15px;
    border-radius:999px;
    margin-bottom:14px;
}

.events-hero h1{
    font-size:32px;
    font-weight:800;
    margin-bottom:8px;
    letter-spacing:-.02em;
}

.events-hero p{
    max-width:560px;
    margin:auto;
    font-size:14.5px;
    line-height:1.6;
    color:#d7d5e8;
}

/* ---------- Filter Pills ---------- */
.event-filters{
    display:flex;
    flex-wrap:wrap;
    justify-content:center;
    gap:8px;
    margin-top:24px;
}

.event-filters button{
    background:rgba(255,255,255,.08);
    border:1px solid rgba(255,255,255,.18);
    color:#e2e0f0;
    padding:7px 18px;
    border-radius:999px;
    font-size:12.5px;
    font-weight:600;
    cursor:pointer;
    transition:.2s ease;
}

.event-filters button.active,
.event-filters button:hover{
    background:var(--primary);
    border-color:var(--primary);
    color:var(--navy);
}

/* ---------- Main Section ---------- */
.events-section{
    padding:0 0 60px;
    margin-top:-28px;
    position:relative;
    z-index:2;
}

/* ---------- Event Card ---------- */
.event-grid{
    display:grid;
    grid-template-columns:repeat(3, 1fr);
    gap:20px;
}

.event-card{
    background:var(--surface);
    border:1px solid var(--border);
    border-radius:var(--radius-lg);
    overflow:hidden;
    box-shadow:var(--shadow-soft);
    transition:transform .25s ease, box-shadow .25s ease;
    display:flex;
    flex-direction:column;
}

.event-card:hover{
    transform:translateY(-4px);
    box-shadow:var(--shadow-hover);
}

.event-banner{
    position:relative;
    height:160px;
    background-size:cover;
    background-position:center;
    display:flex;
    align-items:flex-end;
    justify-content:flex-end;
    padding:12px;
}

.event-banner::before{
    content:"";
    position:absolute;
    inset:0;
    background:linear-gradient(180deg, rgba(20,17,48,0) 40%, rgba(20,17,48,.55) 100%);
}

.event-date{
    position:relative;
    z-index:1;
    background:#fff;
    border-radius:14px;
    padding:8px 16px;
    text-align:center;
    box-shadow:0 8px 18px rgba(20,17,48,.18);
}

.event-date .day{
    font-size:20px;
    font-weight:800;
    color:var(--ink);
    line-height:1;
}

.event-date .month{
    font-size:10.5px;
    font-weight:700;
    letter-spacing:.06em;
    text-transform:uppercase;
    color:var(--muted);
}

.event-tag{
    position:absolute;
    top:10px;
    left:10px;
    background:rgba(20,17,48,.55);
    color:#fff;
    font-size:10.5px;
    font-weight:700;
    letter-spacing:.04em;
    text-transform:uppercase;
    padding:4px 10px;
    border-radius:999px;
    backdrop-filter:blur(3px);
}

.event-body{
    padding:18px 20px 20px;
    display:flex;
    flex-direction:column;
    flex:1;
}

.event-body h3{
    font-size:15.5px;
    font-weight:800;
    color:var(--ink);
    margin-bottom:8px;
    line-height:1.35;
}

.event-body p{
    font-size:13px;
    color:var(--muted);
    line-height:1.6;
    margin-bottom:14px;
    flex:1;
}

.event-meta{
    display:flex;
    flex-direction:column;
    gap:6px;
    font-size:12px;
    color:var(--muted);
}

.event-meta span{
    display:flex;
    align-items:center;
    gap:7px;
}

.event-meta svg{
    flex-shrink:0;
    color:var(--primary-dark);
}

/* ---------- Host CTA ---------- */
.events-cta{
    background:var(--navy);
    border-radius:var(--radius-lg);
    padding:26px 28px;
    text-align:center;
    margin-top:36px;
    box-shadow:var(--shadow-soft);
    border:1px solid var(--navy-border);
}

.events-cta h3{
    color:#fff;
    font-weight:800;
    font-size:18px;
    margin-bottom:4px;
}

.events-cta p{
    color:#a9a7c4;
    font-size:13px;
    margin-bottom:14px;
}

.events-cta .btn-cta{
    background:#ffffff;
    color:#000;
    border:1px solid #e5e7eb;
    border-radius:50px;
    padding:10px 26px;
    font-weight:700;
    font-size:13px;
    text-decoration:none;
    display:inline-flex;
    align-items:center;
    gap:7px;
    box-shadow:0 10px 20px rgba(0,0,0,.12);
    transition:all .2s ease;
}

.events-cta .btn-cta:hover{
    background:#f8f9fa;
    color:#000;
    transform:translateY(-2px);
    box-shadow:0 16px 30px rgba(0,0,0,.18);
}

/* ---------- Responsive ---------- */
@media(max-width:991px){
    .event-grid{ grid-template-columns:repeat(2, 1fr); }
}

@media(max-width:767px){
    .events-hero{ padding:50px 0 46px; }
    .events-hero h1{ font-size:26px; }
    .event-grid{ grid-template-columns:1fr; }
}

</style>

<!-- HERO -->
<section class="events-hero">
    <div class="container">
        <span class="eyebrow">What's Happening</span>
        <h1  style="color:#fff";>Upcoming Events</h1>
        <p>
            Join workshops, webinars, hackathons, and networking sessions
            designed to help you learn, connect, and grow.
        </p>

        <!-- <div class="event-filters">
            <button class="active">All</button>
            <button>Workshops</button>
            <button>Webinars</button>
            <button>Hackathons</button>
            <button>Networking</button>
        </div> -->
    </div>
</section>

<!-- EVENTS -->
<section class="events-section">
<div class="container">

    <div class="event-grid">

        <!-- Card 1 -->
        <div class="event-card">
            <div class="event-banner" style="background-image:url('{{ asset('assets/img/events/hackathon.jpg') }}')">
                <span class="event-tag">Hackathon</span>
                <div class="event-date">
                    <div class="day">14</div>
                    <div class="month">Aug</div>
                </div>
            </div>
            <div class="event-body">
                <h3>Campus Innovation Hackathon</h3>
                <p>A 24-hour build sprint for students to pitch and prototype real-world ideas in front of mentors and employers.</p>
                <div class="event-meta">
                    <span>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M12 8v5l3 2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.8"/></svg>
                        10:00 AM – Next Day
                    </span>
                    <span>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M12 22s7-7.05 7-12A7 7 0 0 0 5 10c0 4.95 7 12 7 12Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><circle cx="12" cy="10" r="2.5" stroke="currentColor" stroke-width="1.8"/></svg>
                        Online
                    </span>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="event-card">
            <div class="event-banner" style="background-image:url('{{ asset('assets/img/events/product-management.jpg') }}')">
                <span class="event-tag">Webinar</span>
                <div class="event-date">
                    <div class="day">21</div>
                    <div class="month">Aug</div>
                </div>
            </div>
            <div class="event-body">
                <h3>Breaking Into Product Management</h3>
                <p>An industry mentor shares a practical roadmap for transitioning into product roles, with time for live Q&amp;A.</p>
                <div class="event-meta">
                    <span>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M12 8v5l3 2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.8"/></svg>
                        6:00 PM – 7:00 PM
                    </span>
                    <span>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M12 22s7-7.05 7-12A7 7 0 0 0 5 10c0 4.95 7 12 7 12Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><circle cx="12" cy="10" r="2.5" stroke="currentColor" stroke-width="1.8"/></svg>
                        Online
                    </span>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="event-card">
            <div class="event-banner" style="background-image:url('{{ asset('assets/img/events/resume-bootcamp.jpg') }}')">
                <span class="event-tag">Workshop</span>
                <div class="event-date">
                    <div class="day">28</div>
                    <div class="month">Aug</div>
                </div>
            </div>
            <div class="event-body">
                <h3>Resume &amp; Portfolio Bootcamp</h3>
                <p>Hands-on workshop covering resume structure, portfolio storytelling, and how to stand out to employers.</p>
                <div class="event-meta">
                    <span>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M12 8v5l3 2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.8"/></svg>
                        3:00 PM – 5:00 PM
                    </span>
                    <span>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M12 22s7-7.05 7-12A7 7 0 0 0 5 10c0 4.95 7 12 7 12Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><circle cx="12" cy="10" r="2.5" stroke="currentColor" stroke-width="1.8"/></svg>
                        Kochi, Kerala
                    </span>
                </div>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="event-card">
            <div class="event-banner" style="background-image:url('{{ asset('assets/img/events/investor-mixer.jpg') }}')">
                <span class="event-tag">Networking</span>
                <div class="event-date">
                    <div class="day">04</div>
                    <div class="month">Sep</div>
                </div>
            </div>
            <div class="event-body">
                <h3>Founders &amp; Investors Mixer</h3>
                <p>An evening connecting early-stage founders with investors for informal conversations and warm introductions.</p>
                <div class="event-meta">
                    <span>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M12 8v5l3 2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.8"/></svg>
                        5:30 PM – 8:00 PM
                    </span>
                    <span>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M12 22s7-7.05 7-12A7 7 0 0 0 5 10c0 4.95 7 12 7 12Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><circle cx="12" cy="10" r="2.5" stroke="currentColor" stroke-width="1.8"/></svg>
                        Kochi, Kerala
                    </span>
                </div>
            </div>
        </div>

        <!-- Card 5 -->
        <div class="event-card">
            <div class="event-banner" style="background-image:url('{{ asset('assets/img/events/freelancing-101.jpg') }}')">
                <span class="event-tag">Webinar</span>
                <div class="event-date">
                    <div class="day">11</div>
                    <div class="month">Sep</div>
                </div>
            </div>
            <div class="event-body">
                <h3>Freelancing 101: Getting Your First Client</h3>
                <p>Practical tips on pricing, proposals, and building a portfolio that wins your first freelance projects.</p>
                <div class="event-meta">
                    <span>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M12 8v5l3 2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.8"/></svg>
                        7:00 PM – 8:00 PM
                    </span>
                    <span>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M12 22s7-7.05 7-12A7 7 0 0 0 5 10c0 4.95 7 12 7 12Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><circle cx="12" cy="10" r="2.5" stroke="currentColor" stroke-width="1.8"/></svg>
                        Online
                    </span>
                </div>
            </div>
        </div>

        <!-- Card 6 -->
        <div class="event-card">
            <div class="event-banner" style="background-image:url('{{ asset('assets/img/events/mock-interview.jpg') }}')">
                <span class="event-tag">Workshop</span>
                <div class="event-date">
                    <div class="day">18</div>
                    <div class="month">Sep</div>
                </div>
            </div>
            <div class="event-body">
                <h3>Mock Interview Marathon</h3>
                <p>Practice technical and behavioral interviews back-to-back with mentors and get instant, actionable feedback.</p>
                <div class="event-meta">
                    <span>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M12 8v5l3 2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.8"/></svg>
                        11:00 AM – 4:00 PM
                    </span>
                    <span>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M12 22s7-7.05 7-12A7 7 0 0 0 5 10c0 4.95 7 12 7 12Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><circle cx="12" cy="10" r="2.5" stroke="currentColor" stroke-width="1.8"/></svg>
                        Online
                    </span>
                </div>
            </div>
        </div>

    </div>

    <div class="events-cta">
        <h3>Want to host an event?</h3>
        <p>Mentors and employers can propose a workshop, webinar, or session for the community.</p>
        <a href="{{ route('contact') ?? '#' }}" class="btn-cta">
            Get In Touch
            <svg viewBox="0 0 24 24" width="15" height="15" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </a>
    </div>

</div>
</section>

@endsection
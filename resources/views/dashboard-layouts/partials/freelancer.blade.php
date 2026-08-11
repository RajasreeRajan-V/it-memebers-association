@extends('layouts.app')

@section('content')
    <style>
        :root {
            --blue: #2563eb;
            --blue-dark: #1d4ed8;
            --navy: #0f172a;
            --text: #1e2430;
            --muted: #64748b;
            --border: #e6e9ef;
            --bg-soft: #f6f8fc;
            --green: #16a34a;
            --amber: #f59e0b;
            --radius: 12px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        .wrap {
            max-width: 1180px;
            margin: 0 auto;
            padding: 0 24px;
        }

        button {
            font-family: inherit;
            cursor: pointer;
            border: none;
        }

        /* ---------- Buttons ---------- */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 11px 22px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14.5px;
            transition: .15s;
        }

        .btn-primary {
            background: var(--blue);
            color: #fff;
        }

        .btn-primary:hover {
            background: var(--blue-dark);
        }

        .btn-outline {
            background: #fff;
            color: var(--blue);
            border: 1.5px solid var(--blue);
        }

        .btn-outline:hover {
            background: #eff4ff;
        }

        .btn-sm {
            padding: 7px 16px;
            font-size: 13px;
            border-radius: 6px;
        }

        /* ---------- Hero ---------- */
        .hero {
            position: relative;
            overflow: hidden;
            padding: 64px 0 48px;
            background: linear-gradient(180deg, #fbfcff 0%, #fff 60%);
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            align-items: center;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #eaf1ff;
            color: var(--blue);
            font-size: 12.5px;
            font-weight: 700;
            padding: 6px 12px;
            border-radius: 20px;
            margin-bottom: 18px;
        }

        .hero h1 {
            font-size: 46px;
            line-height: 1.12;
            font-weight: 800;
            color: var(--navy);
            letter-spacing: -1px;
        }

        .hero h1 .accent {
            color: var(--blue);
        }

        .hero p {
            color: var(--muted);
            font-size: 16px;
            margin: 18px 0 28px;
            max-width: 480px;
        }

        .hero-ctas {
            display: flex;
            gap: 14px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }

        .stats {
            display: flex;
            gap: 38px;
            flex-wrap: wrap;
        }

        .stat {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .stat-icon {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            background: #eaf1ff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--blue);
            flex-shrink: 0;
        }

        .stat b {
            display: block;
            font-size: 18px;
            color: var(--navy);
        }

        .stat span {
            font-size: 12.5px;
            color: var(--muted);
        }

        .hero-art {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 500px;
        }

        .hero-image {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 650px;
            /* Increase or decrease as needed */
            height: auto;
            object-fit: contain;
        }

        .hero-blob {
            position: absolute;
            width: 650px;
            height: 650px;
            border-radius: 50%;
            background: radial-gradient(circle, #eaf2ff 0%, transparent 70%);
            z-index: 1;
        }

        .hero-person {
            position: absolute;
            bottom: 0;
            right: 60px;
            width: 340px;
            height: 400px;
            z-index: 2;
        }

        .float-card {
            position: absolute;
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 14px 16px;
            box-shadow: 0 12px 28px rgba(20, 30, 60, .09);
            z-index: 3;
        }

        .fc-1 {
            top: 100px;
            left: 0;
            width: 150px;
        }

        .fc-2 {
            top: 70px;
            right: 0;
            width: 158px;
        }

        .fc-3 {
            bottom: 30px;
            right: 10px;
            width: 190px;
        }

        .fc-label {
            font-size: 11.5px;
            color: var(--muted);
            margin-bottom: 2px;
        }

        .fc-value {
            font-size: 16px;
            font-weight: 800;
            color: var(--navy);
        }

        .fc-sub {
            font-size: 11px;
            color: var(--green);
            font-weight: 600;
            margin-top: 2px;
        }

        .fc-avatars {
            display: flex;
            margin-bottom: 8px;
        }

        .fc-avatars .av {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            border: 2px solid #fff;
            margin-left: -8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 9px;
            font-weight: 700;
            color: #fff;
        }

        .fc-avatars .av:first-child {
            margin-left: 0;
        }

        .fc-rating {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: var(--muted);
        }

        /* ---------- Sections generic ---------- */
        section {
            padding: 56px 0;
        }

        .section-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 26px;
        }

        .section-head h2 {
            font-size: 24px;
            font-weight: 800;
            color: var(--navy);
        }

        .view-all {
            font-size: 13.5px;
            font-weight: 700;
            color: var(--blue);
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* ---------- Categories ---------- */
        .cat-grid {
            display: grid;
            grid-template-columns: repeat(8, 1fr);
            gap: 14px;
        }

        .cat-card {
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 18px 10px;
            text-align: center;
            transition: .15s;
        }

        .cat-card:hover {
            border-color: var(--blue);
            box-shadow: 0 6px 18px rgba(37, 99, 235, .08);
            transform: translateY(-2px);
        }

        .cat-icon {
            width: 40px;
            height: 40px;
            border-radius: 9px;
            background: #eaf1ff;
            color: var(--blue);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
        }

        .cat-card span {
            font-size: 12.5px;
            font-weight: 600;
            color: #374151;
        }

        /* ---------- Jobs + sidebar ---------- */
        .main-grid {
            display: grid;
            grid-template-columns: 1.7fr 1fr;
            gap: 26px;
            align-items: start;
        }

        .card {
            border: 1px solid var(--border);
            border-radius: var(--radius);
        }

        .jobs-card {
            padding: 22px;
        }

        .job-row {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 0;
            border-bottom: 1px solid var(--border);
        }

        .job-row:last-of-type {
            border-bottom: none;
        }

        .job-icon {
            width: 42px;
            height: 42px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            flex-shrink: 0;
        }

        .job-title {
            font-size: 14.5px;
            font-weight: 700;
            color: var(--navy);
        }

        .job-meta {
            font-size: 12px;
            color: var(--muted);
            margin-top: 3px;
        }

        .job-right {
            margin-left: auto;
            text-align: right;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .job-pay {
            font-size: 13.5px;
            font-weight: 700;
            color: var(--navy);
        }

        .job-tag {
            display: inline-block;
            font-size: 11px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 20px;
            margin-top: 5px;
        }

        .tag-full {
            background: #e8f0ff;
            color: var(--blue);
        }

        .tag-fixed {
            background: #e7f8ee;
            color: var(--green);
        }

        .tag-hourly {
            background: #fdf1e0;
            color: #b4780f;
        }

        .bookmark {
            width: 16px;
            height: 16px;
            color: #c7cdd7;
            flex-shrink: 0;
        }

        .browse-all {
            display: block;
            text-align: center;
            margin-top: 16px;
            padding: 12px;
            border: 1.5px solid var(--blue);
            color: var(--blue);
            border-radius: 8px;
            font-weight: 700;
            font-size: 13.5px;
        }

        .browse-all:hover {
            background: #eff4ff;
        }

        .side-col {
            display: flex;
            flex-direction: column;
            gap: 22px;
        }

        .profile-promo {
            background: var(--bg-soft);
            border-radius: var(--radius);
            padding: 24px;
            position: relative;
        }

        .promo-badge {
            display: inline-block;
            background: #e8f0ff;
            color: var(--blue);
            font-size: 11.5px;
            font-weight: 700;
            padding: 5px 11px;
            border-radius: 20px;
            margin-bottom: 12px;
        }

        .profile-promo h3 {
            font-size: 19px;
            font-weight: 800;
            color: var(--navy);
            margin-bottom: 12px;
            line-height: 1.3;
        }

        .profile-promo p {
            font-size: 13.5px;
            color: var(--muted);
            margin-bottom: 16px;
        }

        .checklist {
            margin-bottom: 20px;
        }

        .checklist li {
            display: flex;
            align-items: center;
            gap: 9px;
            font-size: 13.5px;
            color: #374151;
            margin-bottom: 9px;
        }

        .check {
            width: 17px;
            height: 17px;
            border-radius: 50%;
            background: var(--blue);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            flex-shrink: 0;
        }

        .profile-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 18px;
            box-shadow: 0 14px 30px rgba(20, 30, 60, .07);
            position: relative;
            z-index: 2;
            margin: 20px 0 0 0;
        }

        .pc-top {
            display: flex;
            gap: 12px;
            align-items: center;
            margin-bottom: 14px;
        }

        .pc-avatar {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            background: linear-gradient(135deg, #93c5fd, #2563eb);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 800;
            font-size: 16px;
            flex-shrink: 0;
        }

        .pc-name {
            font-size: 14.5px;
            font-weight: 700;
            color: var(--navy);
        }

        .pc-role {
            font-size: 12px;
            color: var(--muted);
        }

        .pc-badge {
            display: inline-flex;
            align-items: center;
            gap: 3px;
            font-size: 10.5px;
            font-weight: 700;
            color: var(--blue);
            background: #eaf1ff;
            padding: 2px 8px;
            border-radius: 20px;
            margin-top: 4px;
        }

        .pc-bar-row {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: var(--muted);
            margin-bottom: 6px;
        }

        .pc-bar {
            height: 6px;
            background: #eef1f6;
            border-radius: 20px;
            overflow: hidden;
            margin-bottom: 16px;
        }

        .pc-bar-fill {
            height: 100%;
            width: 85%;
            background: var(--green);
            border-radius: 20px;
        }

        .pc-skills {
            display: flex;
            gap: 8px;
            margin-bottom: 16px;
            flex-wrap: wrap;
        }

        .pc-skill {
            font-size: 11px;
            font-weight: 600;
            background: #eaf1ff;
            color: var(--blue);
            padding: 4px 10px;
            border-radius: 20px;
        }

        .pc-stats {
            display: flex;
            justify-content: space-between;
            border-top: 1px solid var(--border);
            padding-top: 14px;
        }

        .pc-stats div span {
            display: block;
            font-size: 11.5px;
            color: var(--muted);
        }

        .pc-stats div b {
            font-size: 15px;
            color: var(--navy);
        }

        .pro-banner {
            background: var(--navy);
            border-radius: var(--radius);
            padding: 22px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            color: #fff;
            flex-wrap: wrap;
        }

        .pro-banner h4 {
            font-size: 15px;
            font-weight: 800;
            margin-bottom: 4px;
        }

        .pro-banner p {
            font-size: 12.5px;
            color: #b9c2d4;
        }

        .crown {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #1e293b;
            border: 2px solid var(--amber);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--amber);
            flex-shrink: 0;
        }

        /* ---------- How it works ---------- */
        .how-section {
            background: var(--bg-soft);
        }

        .how-section .section-head {
            justify-content: center;
            margin-bottom: 44px;
        }

        .how-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 0;
            position: relative;
        }

        .how-step {
            text-align: center;
            padding: 0 18px;
            position: relative;
        }

        .how-step::after {
            content: "";
            position: absolute;
            top: 32px;
            left: calc(50% + 40px);
            width: calc(100% - 80px);
            border-top: 2px dashed #c9d3e3;
        }

        .how-step:last-child::after {
            display: none;
        }

        .how-icon {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: #fff;
            border: 1px solid var(--border);
            color: var(--blue);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            position: relative;
            z-index: 1;
        }

        .how-step h4 {
            font-size: 15px;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 6px;
        }

        .how-step p {
            font-size: 12.5px;
            color: var(--muted);
            max-width: 200px;
            margin: 0 auto;
        }

        /* ---------- Testimonials ---------- */
        .testi-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
        }

        .testi-card {
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 24px;
        }

        .quote-mark {
            color: var(--blue);
            font-size: 26px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .testi-card p {
            font-size: 13.5px;
            color: #374151;
            margin-bottom: 16px;
            min-height: 66px;
        }

        .stars {
            color: var(--amber);
            font-size: 13px;
            margin-bottom: 12px;
            letter-spacing: 2px;
        }

        .testi-person {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .testi-person .av {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: 13px;
        }

        .testi-person b {
            display: block;
            font-size: 13.5px;
            color: var(--navy);
        }

        .testi-person span {
            font-size: 11.5px;
            color: var(--muted);
        }

        .dots {
            display: flex;
            justify-content: center;
            gap: 7px;
            margin-top: 28px;
        }

        .dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #d7dee8;
        }

        .dot.active {
            background: var(--blue);
            width: 20px;
            border-radius: 20px;
        }

        /* ---------- Newsletter ---------- */
        .newsletter {
            background: #eef3ff;
            border-radius: 16px;
            margin: 0 auto 0;
            padding: 30px 34px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }

        .nl-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .nl-icon {
            width: 46px;
            height: 46px;
            background: #fff;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--blue);
            flex-shrink: 0;
        }

        .nl-left h4 {
            font-size: 15.5px;
            font-weight: 700;
            color: var(--navy);
        }

        .nl-left p {
            font-size: 12.5px;
            color: var(--muted);
        }

        .nl-form {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .nl-form input {
            padding: 12px 16px;
            border-radius: 8px;
            border: 1px solid var(--border);
            font-size: 13.5px;
            width: 230px;
            outline: none;
        }

        .nl-form .btn {
            width: auto;
        }

        /* ---------- Enhanced Responsive Queries ---------- */
        @media (max-width:1200px) {
            .cat-grid {
                grid-template-columns: repeat(6, 1fr);
            }
        }

        @media (max-width:1024px) {
            .hero-grid {
                grid-template-columns: 1fr;
            }

            .hero-art {
                display: none;
            }

            .main-grid {
                grid-template-columns: 1fr;
            }

            .profile-card {
                margin: 20px 0 0 0;
            }

            .how-grid {
                grid-template-columns: 1fr 1fr;
                row-gap: 36px;
            }

            .how-step::after {
                display: none;
            }
        }

        @media (max-width:768px) {
            .cat-grid {
                grid-template-columns: repeat(4, 1fr);
            }

            .job-row {
                flex-wrap: wrap;
                gap: 8px;
            }

            .job-right {
                margin-left: 0;
                align-items: flex-start;
                flex-direction: column;
            }

            .pc-top {
                flex-direction: column;
                text-align: center;
            }

            .testi-grid {
                grid-template-columns: 1fr;
            }

            .nl-form input {
                width: 100%;
            }

            .nl-form .btn {
                width: 100%;
                justify-content: center;
            }

            .pro-banner {
                flex-direction: column;
                text-align: center;
            }
        }

        @media (max-width:480px) {
            .hero h1 {
                font-size: 32px;
            }

            .stats {
                gap: 20px;
            }

            .stat {
                width: calc(50% - 10px);
            }

            .cat-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .section-head {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .section-head h2 {
                font-size: 20px;
            }
        }
    </style>

    <!-- Main Content -->
    <div class="bg-white text-slate-800 antialiased font-sans">

        <!-- Hero Section -->
        <section class="hero">
            <div class="wrap hero-grid">
                <div>
                    <span class="badge">◆ #1 Platform for Freelancers</span>
                    <h1>Work Freely.<br><span class="accent">Earn Globally.</span></h1>
                    <p>SkillConnect helps freelancers find amazing projects, build their professional profile, and grow
                        their career worldwide.</p>
                    <div class="hero-ctas">
                        <a class="btn btn-primary" href="#projects">Find Projects →</a>
                        <a class="btn btn-outline" href="#join">Join as Freelancer</a>
                    </div>
                    <div class="stats">
                        <div class="stat">
                            <div class="stat-icon">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <rect x="3" y="7" width="18" height="13" rx="2" />
                                    <path d="M9 7V5a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2" />
                                </svg>
                            </div>
                            <div><b>25K+</b><span>Projects Posted</span></div>
                        </div>
                        <div class="stat">
                            <div class="stat-icon">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                    <circle cx="9" cy="7" r="4" />
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                </svg>
                            </div>
                            <div><b>18K+</b><span>Freelancers</span></div>
                        </div>
                        <div class="stat">
                            <div class="stat-icon">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M12 2l7 4v6c0 5-3.5 8-7 10-3.5-2-7-5-7-10V6l7-4z" />
                                </svg>
                            </div>
                            <div><b>98%</b><span>Success Rate</span></div>
                        </div>
                        <div class="stat">
                            <div class="stat-icon">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <circle cx="12" cy="12" r="10" />
                                    <line x1="2" y1="12" x2="22" y2="12" />
                                    <path d="M12 2a15 15 0 0 1 0 20 15 15 0 0 1 0-20" />
                                </svg>
                            </div>
                            <div><b>150+</b><span>Countries</span></div>
                        </div>
                    </div>
                </div>

                <div class="hero-art">
                    <div class="hero-blob"></div>
                    <img src="{{ asset('img/freelancer/freelancer-bg-rem.png') }}" alt="Freelancer" class="hero-image">

                    <div class="float-card fc-1">
                        <div class="fc-label">UI/UX Design</div>
                        <div class="fc-label" style="margin-bottom:8px">Budget<br><b
                                style="color:#0f172a;font-size:13px">$1,250 - $2,500</b></div>
                        <svg width="100%" height="34" viewBox="0 0 120 34">
                            <polyline points="0,30 20,22 40,26 60,14 80,18 100,6 120,10" fill="none" stroke="#16a34a"
                                stroke-width="2.5" />
                        </svg>
                    </div>
                    <div class="float-card fc-2">
                        <div class="fc-label">Earnings This Month</div>
                        <div class="fc-value">$4,250</div>
                        <div class="fc-sub">▲ 18.6% from last month</div>
                        <svg width="100%" height="30" viewBox="0 0 130 30" style="margin-top:6px">
                            <polyline points="0,26 18,20 36,24 54,12 72,16 90,8 108,14 130,4" fill="none"
                                stroke="#2563eb" stroke-width="2.5" />
                        </svg>
                    </div>
                    <div class="float-card fc-3">
                        <div class="fc-label" style="margin-bottom:10px">Top Rated Freelancer</div>
                        <div class="fc-avatars">
                            <div class="av" style="background:#f87171">A</div>
                            <div class="av" style="background:#60a5fa">B</div>
                            <div class="av" style="background:#34d399">C</div>
                        </div>
                        <div class="fc-rating">★★★★☆ 4.9 (120 reviews)</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Popular Categories -->
        <section id="jobs">
            <div class="wrap">
                <div class="section-head">
                    <h2>Popular Categories</h2>
                    <a class="view-all" href="#">View all categories →</a>
                </div>
                <div class="cat-grid">
                    <a class="cat-card" href="#">
                        <div class="cat-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <rect x="2" y="4" width="20" height="14" rx="2" />
                                <line x1="8" y1="21" x2="16" y2="21" />
                                <line x1="12" y1="18" x2="12" y2="21" />
                            </svg></div><span>Web Development</span>
                    </a>
                    <a class="cat-card" href="#">
                        <div class="cat-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <rect x="7" y="2" width="10" height="20" rx="2" />
                                <line x1="11" y1="18" x2="13" y2="18" />
                            </svg></div><span>Mobile Development</span>
                    </a>
                    <a class="cat-card" href="#">
                        <div class="cat-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <circle cx="8" cy="8" r="5" />
                                <circle cx="16" cy="16" r="5" />
                            </svg></div><span>UI/UX Design</span>
                    </a>
                    <a class="cat-card" href="#">
                        <div class="cat-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10" />
                                <path d="M8 12h8M12 8v8" />
                            </svg></div><span>WordPress</span>
                    </a>
                    <a class="cat-card" href="#">
                        <div class="cat-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <path d="M12 2l3 7h7l-5.5 4.5L18 21l-6-4-6 4 1.5-7.5L2 9h7z" />
                            </svg></div><span>Graphics &amp; Design</span>
                    </a>
                    <a class="cat-card" href="#">
                        <div class="cat-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <path d="M3 11l18-7-7 18-2-8-9-3z" />
                            </svg></div><span>Digital Marketing</span>
                    </a>
                    <a class="cat-card" href="#">
                        <div class="cat-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <path d="M4 19V5a2 2 0 0 1 2-2h8l6 6v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2z" />
                                <path d="M14 3v6h6" />
                            </svg></div><span>Writing &amp; Translation</span>
                    </a>
                    <a class="cat-card" href="#">
                        <div class="cat-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <rect x="2" y="6" width="14" height="12" rx="2" />
                                <path d="M16 10l6-4v12l-6-4" />
                            </svg></div><span>Video &amp; Animation</span>
                    </a>
                </div>
            </div>
        </section>

        <!-- Latest Jobs & Sidebar -->
        <section>
            <div class="wrap main-grid">
                <div class="jobs-card card">
                    <div class="section-head" style="margin-bottom:6px">
                        <h2 style="font-size:19px">Latest Freelance Jobs</h2>
                        <a class="view-all" href="#">View all jobs →</a>
                    </div>

                    <div class="job-row">
                        <div class="job-icon" style="background:#2563eb"><svg width="18" height="18"
                                viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2">
                                <rect x="3" y="4" width="18" height="14" rx="2" />
                            </svg></div>
                        <div>
                            <div class="job-title">Build a Responsive Website</div>
                            <div class="job-meta">🏢 TechVision Inc. &nbsp; 🌐 Web Development</div>
                        </div>
                        <div class="job-right">
                            <div>
                                <div class="job-pay">$1,500 - $2,300</div><span class="job-tag tag-full">Full Time</span>
                            </div>
                            <svg class="bookmark" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M6 3h12v18l-6-4-6 4z" />
                            </svg>
                        </div>
                    </div>

                    <div class="job-row">
                        <div class="job-icon" style="background:#16a34a"><svg width="18" height="18"
                                viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2">
                                <circle cx="8" cy="8" r="5" />
                                <circle cx="16" cy="16" r="5" />
                            </svg></div>
                        <div>
                            <div class="job-title">Mobile App UI/UX Design</div>
                            <div class="job-meta">🏢 Creative Studio &nbsp; 🎨 UI/UX Design</div>
                        </div>
                        <div class="job-right">
                            <div>
                                <div class="job-pay">$800 - $1,500</div><span class="job-tag tag-fixed">Fixed Price</span>
                            </div>
                            <svg class="bookmark" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M6 3h12v18l-6-4-6 4z" />
                            </svg>
                        </div>
                    </div>

                    <div class="job-row">
                        <div class="job-icon" style="background:#f97316"><svg width="18" height="18"
                                viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2">
                                <circle cx="12" cy="12" r="9" />
                                <path d="M8 12h8M12 8v8" />
                            </svg></div>
                        <div>
                            <div class="job-title">WordPress Website Development</div>
                            <div class="job-meta">🏢 BizGrowth &nbsp; 🌐 WordPress</div>
                        </div>
                        <div class="job-right">
                            <div>
                                <div class="job-pay">$1,000 - $1,800</div><span class="job-tag tag-full">Full Time</span>
                            </div>
                            <svg class="bookmark" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M6 3h12v18l-6-4-6 4z" />
                            </svg>
                        </div>
                    </div>

                    <div class="job-row">
                        <div class="job-icon" style="background:#7c3aed"><svg width="18" height="18"
                                viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2">
                                <circle cx="11" cy="11" r="7" />
                                <line x1="21" y1="21" x2="16.65" y2="16.65" />
                            </svg></div>
                        <div>
                            <div class="job-title">SEO Specialist Needed</div>
                            <div class="job-meta">🏢 RankBoost &nbsp; 📈 Digital Marketing</div>
                        </div>
                        <div class="job-right">
                            <div>
                                <div class="job-pay">$600 - $1,200</div><span class="job-tag tag-hourly">Hourly</span>
                            </div>
                            <svg class="bookmark" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M6 3h12v18l-6-4-6 4z" />
                            </svg>
                        </div>
                    </div>

                    <div class="job-row">
                        <div class="job-icon" style="background:#ec4899"><svg width="18" height="18"
                                viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2">
                                <path d="M4 19V5a2 2 0 0 1 2-2h8l6 6v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2z" />
                            </svg></div>
                        <div>
                            <div class="job-title">Content Writer for Tech Blog</div>
                            <div class="job-meta">🏢 Tech Insider &nbsp; ✍️ Writing</div>
                        </div>
                        <div class="job-right">
                            <div>
                                <div class="job-pay">$150 - $300</div><span class="job-tag tag-fixed">Fixed Price</span>
                            </div>
                            <svg class="bookmark" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M6 3h12v18l-6-4-6 4z" />
                            </svg>
                        </div>
                    </div>

                    <a class="browse-all" href="#">Browse All Jobs</a>
                </div>

                <div class="side-col">
                    <div class="profile-promo">
                        <span class="promo-badge">Grow Your Career</span>
                        <h3>Create Your Profile &amp; Get Hired Fast</h3>
                        <p>Join thousands of freelancers who are building successful careers on SkillConnect.</p>
                        <ul class="checklist">
                            <li><span class="check">✓</span> Create a professional profile</li>
                            <li><span class="check">✓</span> Showcase your skills &amp; experience</li>
                            <li><span class="check">✓</span> Get matched with top clients</li>
                            <li><span class="check">✓</span> Secure jobs and grow your earnings</li>
                        </ul>
                        <a class="btn btn-primary" href="#" style="width:100%;justify-content:center">Create Your
                            Profile</a>

                        <div class="profile-card">
                            <div class="pc-top">
                                <div class="pc-avatar">SW</div>
                                <div>
                                    <div class="pc-name">Sophia Williams</div>
                                    <div class="pc-role">UI/UX Designer</div>
                                    <span class="pc-badge">★ Top Rated</span>
                                </div>
                            </div>
                            <div class="pc-bar-row"><span>Profile Strength</span><span>85%</span></div>
                            <div class="pc-bar">
                                <div class="pc-bar-fill"></div>
                            </div>
                            <div class="pc-skills">
                                <span class="pc-skill">Figma</span>
                                <span class="pc-skill">UI Design</span>
                                <span class="pc-skill">Prototyping</span>
                            </div>
                            <div class="pc-stats">
                                <div><span>Earnings</span><b>$24,500</b></div>
                                <div><span>Projects Completed</span><b>48</b></div>
                            </div>
                        </div>
                    </div>

                    <div class="pro-banner">
                        <div>
                            <h4>Become a Pro Member</h4>
                            <p>Unlock premium features and get exclusive benefits.</p>
                        </div>
                        <a class="btn btn-primary btn-sm" href="#" style="background:#2563eb">Upgrade Now</a>
                        <div class="crown">♛</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- How It Works -->
        <section class="how-section">
            <div class="wrap">
                <div class="section-head">
                    <h2>How SkillConnect Works?</h2>
                </div>
                <div class="how-grid">
                    <div class="how-step">
                        <div class="how-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <circle cx="9" cy="8" r="4" />
                                <path d="M2 21v-1a6 6 0 0 1 6-6h2a6 6 0 0 1 6 6v1" />
                                <line x1="19" y1="8" x2="19" y2="14" />
                                <line x1="16" y1="11" x2="22" y2="11" />
                            </svg></div>
                        <h4>1. Create Account</h4>
                        <p>Sign up and create your professional freelancer profile.</p>
                    </div>
                    <div class="how-step">
                        <div class="how-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="7" />
                                <line x1="21" y1="21" x2="16.65" y2="16.65" />
                            </svg></div>
                        <h4>2. Find Opportunities</h4>
                        <p>Browse jobs that match your skills and experience.</p>
                    </div>
                    <div class="how-step">
                        <div class="how-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <line x1="22" y1="2" x2="11" y2="13" />
                                <polygon points="22 2 15 22 11 13 2 9 22 2" />
                            </svg></div>
                        <h4>3. Work &amp; Deliver</h4>
                        <p>Work with clients and deliver quality results on time.</p>
                    </div>
                    <div class="how-step">
                        <div class="how-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <rect x="2" y="7" width="20" height="13" rx="2" />
                                <path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2" />
                            </svg></div>
                        <h4>4. Get Paid</h4>
                        <p>Receive payments and build your reputation.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials -->
        <section>
            <div class="wrap">
                <div class="section-head" style="justify-content:center;position:relative">
                    <h2>What Freelancers Say</h2>
                    <a class="view-all" href="#" style="position:absolute;right:0">View all reviews →</a>
                </div>
                <div class="testi-grid">
                    <div class="testi-card">
                        <div class="quote-mark">“</div>
                        <p>SkillConnect helped me find amazing clients and scale my freelance career. Highly recommended!
                        </p>
                        <div class="stars">★★★★★</div>
                        <div class="testi-person">
                            <div class="av" style="background:#3b82f6">DS</div>
                            <div><b>Daniel Smith</b><span>Web Developer</span></div>
                        </div>
                    </div>
                    <div class="testi-card">
                        <div class="quote-mark">“</div>
                        <p>I've been able to work on exciting projects and increase my income. The platform is excellent!
                        </p>
                        <div class="stars">★★★★★</div>
                        <div class="testi-person">
                            <div class="av" style="background:#ec4899">JB</div>
                            <div><b>Jessica Brown</b><span>UI/UX Designer</span></div>
                        </div>
                    </div>
                    <div class="testi-card">
                        <div class="quote-mark">“</div>
                        <p>The best freelance platform I've used so far. Smooth experience and great support!</p>
                        <div class="stars">★★★★★</div>
                        <div class="testi-person">
                            <div class="av" style="background:#16a34a">MJ</div>
                            <div><b>Michael Johnson</b><span>Digital Marketer</span></div>
                        </div>
                    </div>
                </div>
                <div class="dots"><span class="dot active"></span><span class="dot"></span><span
                        class="dot"></span><span class="dot"></span></div>
            </div>
        </section>

        <!-- Newsletter -->
        <section style="padding-top:0">
            <div class="wrap">
                <div class="newsletter">
                    <div class="nl-left">
                        <div class="nl-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <rect x="2" y="4" width="20" height="16" rx="2" />
                                <path d="M2 6l10 7 10-7" />
                            </svg></div>
                        <div>
                            <h4>Get the best freelance opportunities straight to your inbox.</h4>
                            <p>Join our newsletter and never miss an update.</p>
                        </div>
                    </div>
                    <form class="nl-form" onsubmit="return false">
                        <input type="email" placeholder="Enter your email">
                        <button class="btn btn-primary" type="submit">Subscribe</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

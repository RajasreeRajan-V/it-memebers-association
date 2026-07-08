<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account — {{ config('app.name', 'The Network') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@500;600&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --abyss: #231932;
            --mist: #DAD9E7;
            --orchid: #504482;
            --denim: #3C527B;
            --slate: #3A5079;
            --paper: #F4F3F8;
            --white: #FFFFFF;
            --danger: #B4425C;
            --success: #24603C;
            --radius: 14px;
            /* the "active role" accent — swapped by JS per role */
            --role-accent: var(--orchid);
            --role-accent-2: var(--denim);
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            background: var(--mist);
            color: var(--abyss);
            font-family: 'Inter', sans-serif;
        }

        a {
            color: inherit;
        }

        /* ============ SPLIT SHELL ============ */
        .auth-shell {
            display: flex;
            min-height: 100vh;
            align-items: stretch;
        }

        /* ============ LEFT BRAND PANEL (desktop only) ============ */
        .brand-panel {
            display: none;
            /* revealed at desktop widths, see media query below */
            flex-direction: column;
            justify-content: space-between;
            width: 400px;
            flex-shrink: 0;
            padding: 40px 36px 30px;
            position: sticky;
            top: 0;
            height: 100vh;
            color: var(--mist);
            background:
                radial-gradient(circle at 15% 8%, rgba(80, 68, 130, 0.55), transparent 55%),
                radial-gradient(circle at 90% 95%, rgba(60, 82, 123, 0.55), transparent 55%),
                var(--abyss);
        }

        .brand-panel .brand-mark {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 12.5px;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            opacity: 0.85;
        }

        .brand-panel .brand-mark .dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--mist), var(--denim));
        }

        .brand-copy {
            margin: 30px 0 34px;
        }

        .brand-copy h1 {
            font-family: 'Fraunces', serif;
            font-weight: 500;
            font-size: clamp(24px, 2.2vw, 30px);
            margin: 0 0 12px;
            line-height: 1.15;
        }

        .brand-copy p {
            margin: 0;
            font-size: 14px;
            line-height: 1.6;
            color: rgba(218, 217, 231, 0.75);
        }

        /* the "comb" — a 2x3 grid of role cells, one lights up as the visitor picks a role */
        .comb {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        .cell {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
            padding: 14px 12px;
            border-radius: 12px;
            border: 1.5px solid rgba(218, 217, 231, 0.14);
            background: rgba(255, 255, 255, 0.03);
            transition: border-color .25s ease, background .25s ease, transform .25s ease;
        }

        .cell .hex {
            width: 32px;
            height: 32px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.06);
            transition: background .25s ease;
        }

        .cell .hex svg {
            width: 16px;
            height: 16px;
            stroke: rgba(218, 217, 231, 0.75);
            transition: stroke .25s ease;
        }

        .cell .role-label {
            font-size: 12px;
            font-weight: 600;
            color: rgba(218, 217, 231, 0.75);
            transition: color .25s ease;
        }

        .cell.is-selected {
            border-color: rgba(218, 217, 231, 0.5);
            background: linear-gradient(150deg, rgba(255, 255, 255, 0.12), rgba(255, 255, 255, 0.03));
            transform: translateY(-2px);
        }

        .cell.is-selected .hex {
            background: linear-gradient(135deg, var(--role-accent), var(--role-accent-2));
        }

        .cell.is-selected .hex svg {
            stroke: var(--white);
        }

        .cell.is-selected .role-label {
            color: var(--white);
        }

        .brand-foot {
            font-family: 'JetBrains Mono', monospace;
            font-size: 10.5px;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: rgba(218, 217, 231, 0.45);
        }

        /* ============ RIGHT FORM PANEL ============ */
        .form-panel {
            flex: 1;
            min-width: 0;
        }

        /* ============ TOP BRAND STRIP (mobile fallback header) ============ */
        .topbar {
            background:
                radial-gradient(circle at 10% 0%, rgba(80, 68, 130, 0.55), transparent 60%),
                radial-gradient(circle at 90% 100%, rgba(60, 82, 123, 0.55), transparent 60%),
                var(--abyss);
            color: var(--mist);
            padding: 30px 24px 46px;
            text-align: center;
        }

        .topbar .brand-mark {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 12.5px;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            opacity: 0.85;
        }

        .topbar .brand-mark .dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--mist), var(--denim));
        }

        .topbar h1 {
            font-family: 'Fraunces', serif;
            font-weight: 500;
            font-size: clamp(26px, 3.4vw, 38px);
            margin: 16px 0 6px;
        }

        .topbar p {
            margin: 0;
            font-size: 14.5px;
            color: rgba(218, 217, 231, 0.75);
        }

        /* ============ PAGE / CARD ============ */
        .wrap {
            max-width: 820px;
            margin: -30px auto 60px;
            padding: 0 20px;
        }

        .card {
            background: var(--white);
            border-radius: var(--radius);
            padding: 8px 32px 30px;
            box-shadow: 0 30px 60px -22px rgba(35, 25, 50, 0.35);
            overflow: hidden;
        }

        /* ============ SIGNATURE ELEMENT: the connection rail ============ */
        /* Two stations on a network line — the line fills as you travel it. */
        .rail {
            display: flex;
            align-items: center;
            padding: 26px 4px 24px;
            margin: 0 0 4px;
        }

        .rail-station {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            flex-shrink: 0;
        }

        .rail-node {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            border: 2px solid #DAD7E8;
            background: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'JetBrains Mono', monospace;
            font-size: 12px;
            font-weight: 600;
            color: #9891ab;
            transition: all .35s cubic-bezier(.4, 0, .2, 1);
            position: relative;
            z-index: 2;
        }

        .rail-node svg {
            width: 15px;
            height: 15px;
            stroke: var(--white);
            display: none;
        }

        .rail-station.done .rail-node {
            background: linear-gradient(135deg, var(--role-accent), var(--role-accent-2));
            border-color: transparent;
            color: transparent;
        }

        .rail-station.done .rail-node svg {
            display: block;
        }

        .rail-station.active .rail-node {
            border-color: var(--role-accent);
            color: var(--role-accent);
            box-shadow: 0 0 0 5px rgba(80, 68, 130, 0.13);
        }

        .rail-label {
            font-size: 11.5px;
            font-weight: 600;
            color: #9891ab;
            letter-spacing: 0.01em;
            white-space: nowrap;
        }

        .rail-station.active .rail-label,
        .rail-station.done .rail-label {
            color: var(--abyss);
        }

        .rail-track {
            flex: 1;
            height: 2px;
            background: #E3E1EC;
            margin: 0 2px 22px;
            position: relative;
            overflow: hidden;
            border-radius: 2px;
        }

        .rail-track::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, var(--role-accent), var(--role-accent-2));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform .45s cubic-bezier(.4, 0, .2, 1);
        }

        .rail-track.filled::after {
            transform: scaleX(1);
        }

        .banner {
            border-radius: 10px;
            padding: 11px 14px;
            font-size: 13.5px;
            margin-bottom: 20px;
        }

        .banner.status {
            background: #E8F3EC;
            color: var(--success);
            border: 1px solid #BFE3CA;
        }

        .banner.error {
            background: #FBEAEF;
            color: var(--danger);
            border: 1px solid #F1C6D2;
        }

        .banner ul {
            margin: 4px 0 0;
            padding-left: 18px;
        }

        .step-label {
            font-family: 'JetBrains Mono', monospace;
            font-size: 11px;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--denim);
            margin: 0 0 6px;
        }

        h2.section-title {
            font-family: 'Fraunces', serif;
            font-weight: 500;
            font-size: 21px;
            margin: 0 0 14px;
            color: var(--abyss);
        }

        /* ---- role selector ---- */
        fieldset {
            border: none;
            padding: 0;
            margin: 0 0 8px;
        }

        legend {
            font-size: 12px;
            font-weight: 600;
            color: var(--abyss);
            margin-bottom: 10px;
            padding: 0;
        }

        .role-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 8px;
        }

        @media (max-width: 700px) {
            .role-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 420px) {
            .role-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .role-pill {
            position: relative;
            cursor: pointer;
        }

        .role-pill input {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            margin: 0;
            cursor: pointer;
        }

        .role-pill .box {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 14px 4px 12px;
            border-radius: 12px;
            border: 1.5px solid #E3E1EC;
            background: var(--paper);
            transition: border-color .15s ease, background .15s ease, transform .12s ease;
        }

        .role-pill .box svg {
            width: 20px;
            height: 20px;
            stroke: var(--denim);
            transition: stroke .15s ease;
        }

        .role-pill .box .code {
            font-family: 'JetBrains Mono', monospace;
            font-size: 9px;
            letter-spacing: 0.06em;
            color: #9891ab;
        }

        .role-pill .box .name {
            font-size: 12px;
            font-weight: 600;
            color: var(--abyss);
        }

        .role-pill input:checked+.box {
            border-color: var(--role-accent);
            background: linear-gradient(180deg, #EFEDF6, #E4E1F0);
            transform: translateY(-2px);
            box-shadow: 0 8px 18px -8px rgba(35, 25, 50, 0.4);
        }

        .role-pill input:checked+.box svg {
            stroke: var(--role-accent);
        }

        .role-pill input:focus-visible+.box {
            outline: 2px solid var(--role-accent);
            outline-offset: 2px;
        }

        .role-pill:hover .box {
            transform: translateY(-1px);
        }

        hr.divider {
            border: none;
            border-top: 1px solid #ECEAF3;
            margin: 24px 0 22px;
        }

        /* ---- generic field grid ---- */
        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px 14px;
        }

        @media (max-width: 560px) {
            .grid-2 {
                grid-template-columns: 1fr;
            }
        }

        .field {
            margin-bottom: 16px;
        }

        .field.full {
            grid-column: 1 / -1;
        }

        .field label {
            display: block;
            font-size: 12.5px;
            font-weight: 600;
            color: var(--abyss);
            margin-bottom: 6px;
        }

        .field .hint {
            font-weight: 400;
            color: #8a84a0;
            font-size: 11.5px;
            margin-left: 4px;
        }

        .field input[type="text"],
        .field input[type="email"],
        .field input[type="password"],
        .field input[type="number"],
        .field input[type="url"],
        .field select,
        .field textarea {
            width: 100%;
            padding: 11px 13px;
            font-size: 14.5px;
            font-family: inherit;
            border-radius: 10px;
            border: 1.5px solid #E3E1EC;
            background: var(--paper);
            color: var(--abyss);
            outline: none;
            transition: border-color .15s ease, box-shadow .15s ease;
        }

        .field textarea {
            resize: vertical;
            min-height: 80px;
        }

        .field input:focus,
        .field select:focus,
        .field textarea:focus {
            border-color: var(--role-accent);
            box-shadow: 0 0 0 3px rgba(80, 68, 130, 0.15);
        }

        .field .err {
            font-size: 12px;
            color: var(--danger);
            margin-top: 5px;
        }

        .field input.invalid,
        .field select.invalid,
        .field textarea.invalid {
            border-color: var(--danger);
        }

        .file-field {
            display: flex;
            align-items: center;
            gap: 10px;
            border: 1.5px dashed #D2CEE0;
            border-radius: 10px;
            background: var(--paper);
            padding: 9px 12px;
        }

        .file-field label.btn {
            font-size: 12.5px;
            font-weight: 600;
            color: var(--white);
            background: linear-gradient(135deg, var(--role-accent), var(--role-accent-2));
            padding: 7px 12px;
            border-radius: 8px;
            cursor: pointer;
            white-space: nowrap;
        }

        .file-field .file-name {
            font-size: 12.5px;
            color: #6c6580;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .file-field input[type="file"] {
            display: none;
        }

        /* ---- dynamic role content ---- */
        #roleContent {
            min-height: 40px;
        }

        .role-head {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 18px;
        }

        .role-head .icon-badge {
            width: 42px;
            height: 42px;
            border-radius: 11px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(145deg, var(--role-accent), var(--role-accent-2));
            box-shadow: 0 8px 16px -6px rgba(35, 25, 50, 0.45);
        }

        .role-head .icon-badge svg {
            width: 20px;
            height: 20px;
            stroke: var(--white);
        }

        .role-head .role-title {
            font-family: 'Fraunces', serif;
            font-weight: 500;
            font-size: 19px;
            margin: 0;
            color: var(--abyss);
        }

        .role-head .role-desc {
            font-size: 12.5px;
            color: #6c6580;
            margin: 2px 0 0;
        }

        .role-fade {
            animation: fade .28s ease;
        }

        @keyframes fade {
            from {
                opacity: 0;
                transform: translateY(6px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .empty-note {
            font-size: 13.5px;
            color: #6c6580;
            background: var(--paper);
            border-radius: 10px;
            padding: 14px 16px;
        }

        /* ---- terms + submit ---- */
        .terms {
            display: flex;
            align-items: flex-start;
            gap: 9px;
            font-size: 12.5px;
            color: #4a4460;
            margin: 4px 0 22px;
        }

        .terms input {
            margin-top: 3px;
            accent-color: var(--role-accent);
        }

        .terms a {
            color: var(--denim);
            font-weight: 600;
            text-decoration: none;
        }

        .terms a:hover {
            text-decoration: underline;
        }

        /* ---- pagination controls ---- */
        .page-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 4px;
        }

        .btn-next,
        .btn-submit {
            flex: 1;
            padding: 13px 16px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--role-accent), var(--role-accent-2));
            color: var(--white);
            font-size: 15px;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            transition: filter .15s ease, transform .1s ease, background .2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-next:hover,
        .btn-submit:hover {
            filter: brightness(1.07);
        }

        .btn-next:active,
        .btn-submit:active {
            transform: translateY(1px);
        }

        .btn-next svg,
        .btn-back svg {
            width: 16px;
            height: 16px;
        }

        .btn-back {
            flex-shrink: 0;
            padding: 13px 18px;
            border-radius: 10px;
            border: 1.5px solid #E3E1EC;
            background: var(--white);
            color: var(--abyss);
            font-size: 14.5px;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            transition: border-color .15s ease, background .15s ease;
        }

        .btn-back:hover {
            background: var(--paper);
            border-color: #D2CEE0;
        }

        /* ---- the two "pages" ---- */
        .form-page {
            display: none;
        }

        .form-page.is-active {
            display: block;
            animation: pageIn .32s cubic-bezier(.4, 0, .2, 1);
        }

        @keyframes pageIn {
            from {
                opacity: 0;
                transform: translateX(14px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .signin {
            text-align: center;
            font-size: 13.5px;
            color: #6c6580;
            margin-top: 18px;
        }

        .signin a {
            color: var(--orchid);
            font-weight: 700;
            text-decoration: none;
        }

        .signin a:hover {
            text-decoration: underline;
        }

        @media (prefers-reduced-motion: reduce) {
            .role-fade {
                animation: none;
            }

            .form-page.is-active {
                animation: none;
            }

            .rail-track::after {
                transition: none;
            }
        }

        /* ---- desktop split: show brand panel, hide mobile topbar ---- */
        @media (min-width: 961px) {
            .brand-panel {
                display: flex;
            }

            .topbar {
                display: none;
            }

            .wrap {
                margin: 40px auto 60px;
            }
        }

        @media (max-width: 500px) {
            .rail-label {
                display: none;
            }

            .rail {
                padding-top: 20px;
            }
        }
    </style>
</head>

<body>

    <div class="auth-shell">

        <!-- ============ LEFT PANEL ============ -->
        <div class="brand-panel">
            <div class="brand-mark">
                <span class="dot"></span> {{ strtoupper(config('app.name', 'The Network')) }}
            </div>

            <div>
                <div class="brand-copy">
                    <h1>One signup, six ways in.</h1>
                    <p>Students, employees, employers, freelancers, investors and mentors all register here — pick a
                        role on the right and this page fills in the details that matter for it.</p>
                </div>

                <div class="comb" id="comb" aria-hidden="true">
                    <div class="cell" data-role="student">
                        <div class="hex"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"
                                stroke-linecap="round">
                                <path d="M22 10v6M2 10l10-5 10 5-10 5-10-5z" />
                                <path d="M6 12v5c3 2 9 2 12 0v-5" />
                            </svg></div>
                        <span class="role-label">Student</span>
                    </div>
                    <div class="cell" data-role="employee">
                        <div class="hex"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"
                                stroke-linecap="round">
                                <rect x="3" y="7" width="18" height="13" rx="2" />
                                <path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                            </svg></div>
                        <span class="role-label">Employee</span>
                    </div>
                    <div class="cell" data-role="employer">
                        <div class="hex"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"
                                stroke-linecap="round">
                                <path d="M3 21V9l9-6 9 6v12" />
                                <path d="M9 21v-6h6v6" />
                            </svg></div>
                        <span class="role-label">Employer</span>
                    </div>
                    <div class="cell" data-role="freelancer">
                        <div class="hex"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"
                                stroke-linecap="round">
                                <path d="M13 2 3 14h7l-1 8 10-12h-7l1-8z" />
                            </svg></div>
                        <span class="role-label">Freelancer</span>
                    </div>
                    <div class="cell" data-role="investor">
                        <div class="hex"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"
                                stroke-linecap="round">
                                <path d="M3 17l6-6 4 4 8-8" />
                                <path d="M21 7v6h-6" />
                            </svg></div>
                        <span class="role-label">Investor</span>
                    </div>
                    <div class="cell" data-role="mentor">
                        <div class="hex"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"
                                stroke-linecap="round">
                                <circle cx="12" cy="8" r="4" />
                                <path d="M4 21c1-4 5-6 8-6s7 2 8 6" />
                            </svg></div>
                        <span class="role-label">Mentor</span>
                    </div>
                </div>
            </div>

            <div class="brand-foot">MEMBERSHIP · VERIFIED ACCESS · EST. {{ date('Y') }}</div>
        </div>

        <!-- ============ FORM PANEL ============ -->
        <div class="form-panel">

            <div class="topbar">
                <div class="brand-mark"><span class="dot"></span> {{ strtoupper(config('app.name', 'The Network')) }}
                </div>
                <h1>Join the network</h1>
                <p>Two short pages — the second one reshapes itself around the role you pick.</p>
            </div>

            <div class="wrap">
                <div class="card">

                    <!-- ============ CONNECTION RAIL — the page-1/page-2 progress signature ============ -->
                    <div class="rail" id="rail">
                        <div class="rail-station active" data-station="1">
                            <span class="rail-node">
                                <span class="num">1</span>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12" />
                                </svg>
                            </span>
                            <span class="rail-label">Account</span>
                        </div>
                        <div class="rail-track" id="railTrack"></div>
                        <div class="rail-station" data-station="2">
                            <span class="rail-node">
                                <span class="num">2</span>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12" />
                                </svg>
                            </span>
                            <span class="rail-label">Details</span>
                        </div>
                    </div>

                    @if (session('status'))
                        <div class="banner status">{{ session('status') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="banner error">
                            Please fix the following:
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="banner error">{{ session('error') }}</div>
                    @endif
                    <form method="POST" action="{{ route('do_registration') }}" enctype="multipart/form-data"
                        id="registerForm" novalidate>
                        @csrf

                        <!-- ============================================================ -->
                        <!-- PAGE 1 — role + account                                       -->
                        <!-- ============================================================ -->
                        <section class="form-page is-active" id="page1" data-page="1">

                            {{-- ============ ROLE SELECTOR ============ --}}
                            <p class="step-label">Page 1 of 2</p>
                            <h2 class="section-title">Who's joining?</h2>

                            <fieldset>
                                <legend>Select your role</legend>
                                <div class="role-grid">
                                    @php
                                        $roles = [
                                            'student' => 'R01',
                                            'employee' => 'R02',
                                            'employer' => 'R03',
                                            'freelancer' => 'R04',
                                            'investor' => 'R05',
                                            'mentor' => 'R06',
                                        ];
                                        $icons = [
                                            'student' =>
                                                '<path d="M22 10v6M2 10l10-5 10 5-10 5-10-5z"/><path d="M6 12v5c3 2 9 2 12 0v-5"/>',
                                            'employee' =>
                                                '<rect x="3" y="7" width="18" height="13" rx="2"/><path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>',
                                            'employer' => '<path d="M3 21V9l9-6 9 6v12"/><path d="M9 21v-6h6v6"/>',
                                            'freelancer' => '<path d="M13 2 3 14h7l-1 8 10-12h-7l1-8z"/>',
                                            'investor' => '<path d="M3 17l6-6 4 4 8-8"/><path d="M21 7v6h-6"/>',
                                            'mentor' =>
                                                '<circle cx="12" cy="8" r="4"/><path d="M4 21c1-4 5-6 8-6s7 2 8 6"/>',
                                        ];
                                        $selectedRole = old('role', 'student');
                                    @endphp

                                    @foreach ($roles as $value => $code)
                                        <label class="role-pill">
                                            <input type="radio" name="role" value="{{ $value }}"
                                                class="role-radio" data-role="{{ $value }}"
                                                {{ $selectedRole === $value ? 'checked' : '' }} required>
                                            <span class="box">
                                                <svg viewBox="0 0 24 24" fill="none" stroke-width="2"
                                                    stroke-linecap="round">{!! $icons[$value] !!}</svg>
                                                <span class="name">{{ ucfirst($value) }}</span>
                                                <span class="code">{{ $code }}</span>
                                            </span>
                                        </label>
                                    @endforeach
                                </div>
                            </fieldset>

                            <hr class="divider">

                            {{-- ============ COMMON ACCOUNT FIELDS ============ --}}
                            <h2 class="section-title">Your account</h2>

                            <div class="grid-2">
                                <div class="field full">
                                    <label for="name">Full name</label>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                                        required>
                                    @error('name')
                                        <div class="err">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="field">
                                    <label for="email">Email address</label>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                                        required>
                                    @error('email')
                                        <div class="err">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="field">
                                    <label for="phone">Phone number</label>
                                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                                        placeholder="+91 9XXXXXXXXX">
                                    @error('phone')
                                        <div class="err">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="page-actions">
                                <button type="button" class="btn-next" id="toPage2">
                                    Continue to details
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                        <polyline points="12 5 19 12 12 19" />
                                    </svg>
                                </button>
                            </div>
                        </section>

                        <!-- ============================================================ -->
                        <!-- PAGE 2 — role-specific details + terms + submit              -->
                        <!-- ============================================================ -->
                        <section class="form-page" id="page2" data-page="2">

                            <p class="step-label">Page 2 of 2</p>
                            <div id="roleContent"></div>

                            <hr class="divider">

                            <label class="terms">
                                <input type="checkbox" name="terms" required>
                                <span>I agree to the <a href="#">Terms of Service</a> and <a
                                        href="#">Privacy Policy</a>, and understand my details will be reviewed
                                    as part of membership verification.</span>
                            </label>

                            <div class="page-actions">
                                <button type="button" class="btn-back" id="toPage1">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="19" y1="12" x2="5" y2="12" />
                                        <polyline points="12 19 5 12 12 5" />
                                    </svg>
                                    Back
                                </button>
                                <button type="submit" class="btn-submit" id="submitBtn">Create account</button>
                            </div>
                        </section>

                        <p class="signin">
                            Already a member?
                            @if (Route::has('membership'))
                                <a href="{{ route('membership') }}">Sign in</a>
                            @else
                                <a href="#">Sign in</a>
                            @endif
                        </p>
                    </form>
                </div>
            </div>

        </div>
        <!-- /form-panel -->

    </div>
    <!-- /auth-shell -->

    {{-- ============ ROLE TEMPLATES — each is the *entire* dynamic content for that role ============ --}}

    <template id="tpl-student">
        <div class="role-head">
            <span class="icon-badge"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"
                    stroke-linecap="round">
                    <path d="M22 10v6M2 10l10-5 10 5-10 5-10-5z" />
                    <path d="M6 12v5c3 2 9 2 12 0v-5" />
                </svg></span>
            <div>
                <p class="role-title">Student details</p>
                <p class="role-desc">College, course and the skills you're building.</p>
            </div>
        </div>
        <div class="grid-2">
            <div class="field">
                <label for="college_name">College name</label>
                <input type="text" id="college_name" name="college_name" value="{{ old('college_name') }}">
            </div>
            <div class="field">
                <label for="university">University</label>
                <input type="text" id="university" name="university" value="{{ old('university') }}">
            </div>
            <div class="field">
                <label for="course">Course</label>
                <input type="text" id="course" name="course" value="{{ old('course') }}"
                    placeholder="e.g. B.Tech CSE">
            </div>
            <div class="field">
                <label for="year">Year of study</label>
                <select id="year" name="year">
                    <option value="">Select year</option>
                    <option value="1st Year">1st Year</option>
                    <option value="2nd Year">2nd Year</option>
                    <option value="3rd Year">3rd Year</option>
                    <option value="4th Year">4th Year</option>
                    <option value="Final Year">Final Year</option>
                    <option value="Graduated">Graduated</option>
                </select>
            </div>
            <div class="field full">
                <label for="interested_domain">Interested domain <span class="hint">optional</span></label>
                <input type="text" id="interested_domain" name="interested_domain"
                    value="{{ old('interested_domain') }}" placeholder="e.g. Web Development">
            </div>
            <div class="field full">
                <label for="skills">Skills <span class="hint">optional, comma separated</span></label>
                <textarea id="skills" name="skills"></textarea>
            </div>
            <div class="field">
                <label>Resume <span class="hint">optional</span></label>
                <div class="file-field">
                    <label class="btn" for="resume">Choose file</label>
                    <input type="file" id="resume" name="resume">
                    <span class="file-name">No file selected</span>
                </div>
            </div>
            <div class="field">
                <label>College ID card <span class="hint">optional</span></label>
                <div class="file-field">
                    <label class="btn" for="college_id_card">Choose file</label>
                    <input type="file" id="college_id_card" name="college_id_card">
                    <span class="file-name">No file selected</span>
                </div>
            </div>
        </div>
    </template>

    <template id="tpl-employee">
        <div class="role-head">
            <span class="icon-badge"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"
                    stroke-linecap="round">
                    <rect x="3" y="7" width="18" height="13" rx="2" />
                    <path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                </svg></span>
            <div>
                <p class="role-title">Employee details</p>
                <p class="role-desc">Where you work now, and what you're aiming for next.</p>
            </div>
        </div>
        <div class="grid-2">
            <div class="field">
                <label for="company_name">Current company</label>
                <input type="text" id="company_name" name="company_name" value="{{ old('company_name') }}">
            </div>
            <div class="field">
                <label for="designation">Designation</label>
                <input type="text" id="designation" name="designation" value="{{ old('designation') }}">
            </div>
            <div class="field">
                <label for="experience_years">Years of experience</label>
                <input type="number" min="0" id="experience_years" name="experience_years"
                    value="{{ old('experience_years') }}">
            </div>
            <div class="field">
                <label for="linkedin">LinkedIn <span class="hint">optional</span></label>
                <input type="url" id="linkedin" name="linkedin" value="{{ old('linkedin') }}"
                    placeholder="https://linkedin.com/in/...">
            </div>
            <div class="field">
                <label for="current_ctc">Current CTC <span class="hint">optional, LPA</span></label>
                <input type="number" step="0.01" min="0" id="current_ctc" name="current_ctc"
                    value="{{ old('current_ctc') }}">
            </div>
            <div class="field">
                <label for="expected_ctc">Expected CTC <span class="hint">optional, LPA</span></label>
                <input type="number" step="0.01" min="0" id="expected_ctc" name="expected_ctc"
                    value="{{ old('expected_ctc') }}">
            </div>
            <div class="field full">
                <label for="skills">Skills <span class="hint">optional, comma separated</span></label>
                <textarea id="skills" name="skills"></textarea>
            </div>
            <div class="field">
                <label>Resume <span class="hint">optional</span></label>
                <div class="file-field">
                    <label class="btn" for="resume">Choose file</label>
                    <input type="file" id="resume" name="resume">
                    <span class="file-name">No file selected</span>
                </div>
            </div>
            <div class="field">
                <label>Experience proof <span class="hint">optional</span></label>
                <div class="file-field">
                    <label class="btn" for="experience_proof">Choose file</label>
                    <input type="file" id="experience_proof" name="experience_proof">
                    <span class="file-name">No file selected</span>
                </div>
            </div>
        </div>
    </template>

    <template id="tpl-employer">
        <div class="role-head">
            <span class="icon-badge"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"
                    stroke-linecap="round">
                    <path d="M3 21V9l9-6 9 6v12" />
                    <path d="M9 21v-6h6v6" />
                </svg></span>
            <div>
                <p class="role-title">Company details</p>
                <p class="role-desc">Tell us about the organisation you're hiring for.</p>
            </div>
        </div>
        <div class="grid-2">
            <div class="field">
                <label for="company_name">Company name</label>
                <input type="text" id="company_name" name="company_name" value="{{ old('company_name') }}">
            </div>
            <div class="field">
                <label for="industry">Industry <span class="hint">optional</span></label>
                <input type="text" id="industry" name="industry" value="{{ old('industry') }}">
            </div>
            <div class="field">
                <label for="gst_number">GST number <span class="hint">optional</span></label>
                <input type="text" id="gst_number" name="gst_number" value="{{ old('gst_number') }}">
            </div>
            <div class="field">
                <label for="pan_number">PAN number <span class="hint">optional</span></label>
                <input type="text" id="pan_number" name="pan_number" value="{{ old('pan_number') }}">
            </div>
            <div class="field">
                <label for="company_size">Company size <span class="hint">optional</span></label>
                <select id="company_size" name="company_size">
                    <option value="">Select range</option>
                    <option value="1-10">1–10</option>
                    <option value="11-50">11–50</option>
                    <option value="51-200">51–200</option>
                    <option value="201-500">201–500</option>
                    <option value="500+">500+</option>
                </select>
            </div>
            <div class="field">
                <label for="website">Website <span class="hint">optional</span></label>
                <input type="url" id="website" name="website" value="{{ old('website') }}"
                    placeholder="https://...">
            </div>
            <div class="field full">
                <label for="company_address">Company address</label>
                <textarea id="company_address" name="company_address"></textarea>
            </div>
            <div class="field">
                <label>Company logo <span class="hint">optional</span></label>
                <div class="file-field">
                    <label class="btn" for="company_logo">Choose file</label>
                    <input type="file" id="company_logo" name="company_logo">
                    <span class="file-name">No file selected</span>
                </div>
            </div>
            <div class="field">
                <label>Company documents <span class="hint">optional</span></label>
                <div class="file-field">
                    <label class="btn" for="company_documents">Choose file</label>
                    <input type="file" id="company_documents" name="company_documents">
                    <span class="file-name">No file selected</span>
                </div>
            </div>
        </div>
    </template>

    <template id="tpl-freelancer">
        <div class="role-head">
            <span class="icon-badge"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"
                    stroke-linecap="round">
                    <path d="M13 2 3 14h7l-1 8 10-12h-7l1-8z" />
                </svg></span>
            <div>
                <p class="role-title">Freelancer details</p>
                <p class="role-desc">What you do, your rate, and where to see your work.</p>
            </div>
        </div>
        <div class="grid-2">
            <div class="field">
                <label for="specialization">Specialization</label>
                <input type="text" id="specialization" name="specialization" value="{{ old('specialization') }}"
                    placeholder="e.g. UI/UX Design">
            </div>
            <div class="field">
                <label for="experience">Years of experience</label>
                <input type="number" min="0" id="experience" name="experience"
                    value="{{ old('experience') }}">
            </div>
            <div class="field">
                <label for="hourly_rate">Hourly rate <span class="hint">optional</span></label>
                <input type="number" step="0.01" min="0" id="hourly_rate" name="hourly_rate"
                    value="{{ old('hourly_rate') }}">
            </div>
            <div class="field">
                <label for="availability">Availability <span class="hint">optional</span></label>
                <select id="availability" name="availability">
                    <option value="">Select</option>
                    <option value="Full-time">Full-time</option>
                    <option value="Part-time">Part-time</option>
                    <option value="Weekends">Weekends</option>
                    <option value="Not available">Not available right now</option>
                </select>
            </div>
            <div class="field">
                <label for="portfolio_link">Portfolio link <span class="hint">optional</span></label>
                <input type="url" id="portfolio_link" name="portfolio_link"
                    value="{{ old('portfolio_link') }}">
            </div>
            <div class="field">
                <label for="github">GitHub <span class="hint">optional</span></label>
                <input type="url" id="github" name="github" value="{{ old('github') }}">
            </div>
            <div class="field full">
                <label for="linkedin">LinkedIn <span class="hint">optional</span></label>
                <input type="url" id="linkedin" name="linkedin" value="{{ old('linkedin') }}">
            </div>
            <div class="field full">
                <label for="skills">Skills <span class="hint">optional, comma separated</span></label>
                <textarea id="skills" name="skills"></textarea>
            </div>
        </div>
    </template>

    <template id="tpl-investor">
        <div class="role-head">
            <span class="icon-badge"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"
                    stroke-linecap="round">
                    <path d="M3 17l6-6 4 4 8-8" />
                    <path d="M21 7v6h-6" />
                </svg></span>
            <div>
                <p class="role-title">Investor details</p>
                <p class="role-desc">Your focus areas, so we can match relevant opportunities.</p>
            </div>
        </div>
        <div class="grid-2">
            <div class="field">
                <label for="organization">Organization</label>
                <input type="text" id="organization" name="organization" value="{{ old('organization') }}"
                    placeholder="Fund, firm, or 'Individual'">
            </div>
            <div class="field">
                <label for="investment_stage">Preferred stage</label>
                <select id="investment_stage" name="investment_stage">
                    <option value="">Select stage</option>
                    <option value="Idea">Idea</option>
                    <option value="Pre-seed">Pre-seed</option>
                    <option value="Seed">Seed</option>
                    <option value="Series A">Series A</option>
                    <option value="Series B+">Series B+</option>
                    <option value="Growth">Growth</option>
                </select>
            </div>
            <div class="field">
                <label for="investment_range">Investment range</label>
                <select id="investment_range" name="investment_range">
                    <option value="">Select range</option>
                    <option value="Under ₹5L">Under ₹5L</option>
                    <option value="₹5L - ₹25L">₹5L – ₹25L</option>
                    <option value="₹25L - ₹1Cr">₹25L – ₹1Cr</option>
                    <option value="₹1Cr - ₹5Cr">₹1Cr – ₹5Cr</option>
                    <option value="₹5Cr+">₹5Cr+</option>
                </select>
            </div>
            <div class="field">
                <label for="preferred_sectors">Preferred sectors</label>
                <input type="text" id="preferred_sectors" name="preferred_sectors"
                    value="{{ old('preferred_sectors') }}" placeholder="e.g. Fintech, HealthTech">
            </div>
            <div class="field">
                <label for="linkedin">LinkedIn <span class="hint">optional</span></label>
                <input type="url" id="linkedin" name="linkedin" value="{{ old('linkedin') }}">
            </div>
            <div class="field">
                <label for="website">Website <span class="hint">optional</span></label>
                <input type="url" id="website" name="website" value="{{ old('website') }}">
            </div>
            <div class="field full">
                <label for="bio">Short bio <span class="hint">optional</span></label>
                <textarea id="bio" name="bio"></textarea>
            </div>
            <div class="field full">
                <label>Verification document <span class="hint">optional — e.g. accreditation or fund
                        proof</span></label>
                <div class="file-field">
                    <label class="btn" for="verification_document">Choose file</label>
                    <input type="file" id="verification_document" name="verification_document">
                    <span class="file-name">No file selected</span>
                </div>
            </div>
        </div>
    </template>

    <template id="tpl-mentor">
        <div class="role-head">
            <span class="icon-badge"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"
                    stroke-linecap="round">
                    <circle cx="12" cy="8" r="4" />
                    <path d="M4 21c1-4 5-6 8-6s7 2 8 6" />
                </svg></span>
            <div>
                <p class="role-title">Mentor details</p>
                <p class="role-desc">Your background, and where you can guide others.</p>
            </div>
        </div>
        <div class="grid-2">
            <div class="field">
                <label for="company">Company</label>
                <input type="text" id="company" name="company" value="{{ old('company') }}">
            </div>
            <div class="field">
                <label for="designation">Designation</label>
                <input type="text" id="designation" name="designation" value="{{ old('designation') }}">
            </div>
            <div class="field">
                <label for="expertise">Area of expertise</label>
                <input type="text" id="expertise" name="expertise" value="{{ old('expertise') }}"
                    placeholder="e.g. Product Management">
            </div>
            <div class="field">
                <label for="years_of_experience">Years of experience</label>
                <input type="number" min="0" id="years_of_experience" name="years_of_experience"
                    value="{{ old('years_of_experience') }}">
            </div>
            <div class="field">
                <label for="availability">Availability <span class="hint">optional</span></label>
                <select id="availability" name="availability">
                    <option value="">Select</option>
                    <option value="Weekdays">Weekdays</option>
                    <option value="Weekends">Weekends</option>
                    <option value="Flexible">Flexible</option>
                </select>
            </div>
            <div class="field">
                <label for="linkedin">LinkedIn <span class="hint">optional</span></label>
                <input type="url" id="linkedin" name="linkedin" value="{{ old('linkedin') }}">
            </div>
            <div class="field full">
                <label for="bio">Short bio <span class="hint">optional</span></label>
                <textarea id="bio" name="bio"></textarea>
            </div>
            <div class="field">
                <label>Resume <span class="hint">optional</span></label>
                <div class="file-field">
                    <label class="btn" for="resume">Choose file</label>
                    <input type="file" id="resume" name="resume">
                    <span class="file-name">No file selected</span>
                </div>
            </div>
        </div>
    </template>

    <script>
        const roleRadios = document.querySelectorAll('.role-radio');
        const roleContent = document.getElementById('roleContent');
        const page1 = document.getElementById('page1');
        const page2 = document.getElementById('page2');
        const railTrack = document.getElementById('railTrack');
        const railStations = document.querySelectorAll('.rail-station');
        const form = document.getElementById('registerForm');
        const combCells = document.querySelectorAll('.comb .cell');

        // per-role accent, drawn from the same violet/blue family
        const accents = {
            student: ['#504482', '#3C527B'],
            employee: ['#3C527B', '#3A5079'],
            employer: ['#3A5079', '#231932'],
            freelancer: ['#5C4E96', '#504482'],
            investor: ['#3A5079', '#3C527B'],
            mentor: ['#6659A0', '#504482'],
        };

        // required-field map per role (matches each table's non-nullable columns)
        const requiredMap = {
            student: ['college_name', 'university', 'course', 'year'],
            employee: ['company_name', 'designation', 'experience_years'],
            employer: ['company_name', 'company_address'],
            freelancer: ['specialization', 'experience'],
            investor: ['organization', 'investment_range', 'preferred_sectors', 'investment_stage'],
            mentor: ['company', 'designation', 'expertise', 'years_of_experience'],
        };

        function renderRole(role) {
            const tpl = document.getElementById('tpl-' + role);
            if (!tpl) return;

            // swap the accent colors driving buttons, focus rings, badge selection, rail fill
            const [c1, c2] = accents[role] || accents.student;
            document.documentElement.style.setProperty('--role-accent', c1);
            document.documentElement.style.setProperty('--role-accent-2', c2);

            // light up the matching cell in the left panel's role comb, dim the rest
            combCells.forEach(cell => {
                cell.classList.toggle('is-selected', cell.dataset.role === role);
            });

            // replace the entire dynamic block with this role's fresh template content
            roleContent.innerHTML = '';
            const clone = tpl.content.cloneNode(true);
            roleContent.appendChild(clone);
            roleContent.classList.remove('role-fade');
            void roleContent.offsetWidth; // restart animation
            roleContent.classList.add('role-fade');

            // mark required fields for this role
            (requiredMap[role] || []).forEach(id => {
                const el = roleContent.querySelector('#' + id);
                if (el) el.required = true;
            });

            // wire up file-name display for any file inputs in the new content
            roleContent.querySelectorAll('input[type="file"]').forEach(input => {
                input.addEventListener('change', () => {
                    const label = input.closest('.file-field').querySelector('.file-name');
                    label.textContent = input.files.length ? input.files[0].name : 'No file selected';
                });
            });
        }

        roleRadios.forEach(radio => {
            radio.addEventListener('change', () => renderRole(radio.value));
        });

        // initialize with whichever role is pre-checked (old input or default)
        const initialRole = document.querySelector('.role-radio:checked');
        renderRole(initialRole ? initialRole.value : 'student');

        /* ============ TWO-PAGE NAVIGATION ============ */

        function setStation(n) {
            railStations.forEach(st => {
                const stationNum = parseInt(st.dataset.station, 10);
                st.classList.toggle('active', stationNum === n);
                st.classList.toggle('done', stationNum < n);
            });
            railTrack.classList.toggle('filled', n >= 2);
        }

        function goToPage(n) {
            page1.classList.toggle('is-active', n === 1);
            page2.classList.toggle('is-active', n === 2);
            setStation(n);
            document.querySelector('.card').scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }

        function validatePage1() {
            let valid = true;

            // run native validity check on every visible field in page 1
            page1.querySelectorAll('input, select, textarea').forEach(el => {
                el.classList.remove('invalid');
                if (!el.checkValidity()) {
                    el.classList.add('invalid');
                    valid = false;
                }
            });

            if (!valid) {
                const firstInvalid = page1.querySelector('.invalid');
                if (firstInvalid) firstInvalid.focus();
            }

            return valid;
        }

        document.getElementById('toPage2').addEventListener('click', () => {
            if (validatePage1()) goToPage(2);
        });

        document.getElementById('toPage1').addEventListener('click', () => {
            goToPage(1);
        });

        // safety net: if a page-1 field is somehow still invalid on submit, jump back
        form.addEventListener('submit', (e) => {
            if (!page1.checkValidity()) {
                e.preventDefault();
                goToPage(1);
                validatePage1();
            }
        });
    </script>

</body>

</html>

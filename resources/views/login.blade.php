<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In — {{ config('app.name', 'The Network') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --abyss: #231932;   /* deep violet-black — dark surfaces */
            --mist: #DAD9E7;    /* pale lavender — light surfaces / text-on-dark */
            --orchid: #504482;  /* mid violet — primary accent */
            --denim: #3C527B;   /* blue-violet — secondary accent */
            --slate: #3A5079;   /* steel blue-violet — borders / hover */
            --paper: #F4F3F8;   /* near-white card ground, mixed from mist */
            --white: #FFFFFF;
            --danger: #B4425C;
            --radius: 14px;
        }

        * { box-sizing: border-box; }

        html, body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
            background: var(--abyss);
            color: var(--abyss);
        }

        a { color: inherit; }

        .screen {
            min-height: 100vh;
            display: grid;
            grid-template-columns: minmax(0, 1.05fr) minmax(360px, 620px);
        }

        /* ============ LEFT — IDENTITY / BRAND PANEL ============ */
        .brand-panel {
            position: relative;
            background:
                radial-gradient(circle at 15% 12%, rgba(80,68,130,0.55), transparent 55%),
                radial-gradient(circle at 85% 88%, rgba(60,82,123,0.55), transparent 55%),
                var(--abyss);
            color: var(--mist);
            padding: 56px 64px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
        }

        .brand-mark {
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 13px;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: var(--mist);
            opacity: 0.85;
        }
        .brand-mark .dot {
            width: 8px; height: 8px; border-radius: 50%;
            background: linear-gradient(135deg, var(--mist), var(--denim));
        }

        .brand-copy h1 {
            font-family: 'Fraunces', serif;
            font-weight: 500;
            font-size: clamp(34px, 4vw, 50px);
            line-height: 1.08;
            margin: 28px 0 14px;
            max-width: 9.5ch;
        }
        .brand-copy p {
            font-size: 15.5px;
            line-height: 1.6;
            max-width: 40ch;
            color: rgba(218,217,231,0.75);
            margin: 0;
        }

        /* honeycomb of six role badges converging on one emblem */
        .comb {
            position: relative;
            width: 100%;
            max-width: 430px;
            margin: 40px auto 0;
            aspect-ratio: 1 / 0.86;
        }
        .cell {
            position: absolute;
            width: 108px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            text-align: center;
            animation: rise 0.7s ease both;
        }
        .cell .hex {
            width: 56px; height: 56px;
            clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
            background: linear-gradient(145deg, var(--orchid), var(--slate));
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 8px 20px rgba(35,25,50,0.45);
        }
        .cell .hex svg { width: 24px; height: 24px; stroke: var(--mist); }
        .cell span.role-label {
            font-family: 'JetBrains Mono', monospace;
            font-size: 10.5px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: rgba(218,217,231,0.7);
        }

        .cell.c1 { top: 0%;   left: 4%;  }
        .cell.c2 { top: 0%;   left: 62%; }
        .cell.c3 { top: 34%;  left: 33%; }
        .cell.c4 { top: 60%;  left: -2%; }
        .cell.c5 { top: 60%;  left: 66%; }
        .cell.c6 { top: 86%;  left: 33%; }

        .cell.c1{animation-delay:.05s}.cell.c2{animation-delay:.1s}.cell.c3{animation-delay:.15s}
        .cell.c4{animation-delay:.2s}.cell.c5{animation-delay:.25s}.cell.c6{animation-delay:.3s}

        @keyframes rise {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .brand-foot {
            font-family: 'JetBrains Mono', monospace;
            font-size: 11.5px;
            letter-spacing: 0.05em;
            color: rgba(218,217,231,0.5);
        }

        /* ============ RIGHT — LOGIN CARD ============ */
        .form-panel {
            background: var(--mist);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 32px;
        }

        .card {
            width: 100%;
            max-width: 420px;
            background: var(--white);
            border-radius: var(--radius);
            padding: 40px 36px 34px;
            box-shadow: 0 30px 60px -20px rgba(35,25,50,0.35);
        }

        .card-eyebrow {
            font-family: 'JetBrains Mono', monospace;
            font-size: 11px;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--denim);
            margin: 0 0 8px;
        }
        .card h2 {
            font-family: 'Fraunces', serif;
            font-weight: 500;
            font-size: 28px;
            margin: 0 0 6px;
            color: var(--abyss);
        }
        .card .sub {
            font-size: 14px;
            color: #6c6580;
            margin: 0 0 26px;
        }

        /* status / error banners */
        .banner {
            border-radius: 10px;
            padding: 11px 14px;
            font-size: 13.5px;
            margin-bottom: 18px;
        }
        .banner.status { background: #E8F3EC; color: #24603C; border: 1px solid #BFE3CA; }
        .banner.error   { background: #FBEAEF; color: var(--danger); border: 1px solid #F1C6D2; }
        .banner ul { margin: 4px 0 0; padding-left: 18px; }

        /* inputs */
        .field { margin-bottom: 16px; }
        .field label {
            display: block;
            font-size: 12.5px;
            font-weight: 600;
            color: var(--abyss);
            margin-bottom: 6px;
        }
        .field input[type="text"],
        .field input[type="email"],
        .field input[type="password"] {
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
        .field input:focus {
            border-color: var(--orchid);
            box-shadow: 0 0 0 3px rgba(80,68,130,0.15);
        }
        .field .err {
            font-size: 12px;
            color: var(--danger);
            margin-top: 5px;
        }

        .row-between {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 13px;
            margin-bottom: 22px;
        }
        .remember { display: flex; align-items: center; gap: 7px; color: #4a4460; }
        .remember input { accent-color: var(--orchid); }
        .forgot { color: var(--denim); font-weight: 600; text-decoration: none; }
        .forgot:hover { text-decoration: underline; }

        .btn-submit {
            width: 100%;
            padding: 13px 16px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--orchid), var(--denim));
            color: var(--white);
            font-size: 15px;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            transition: filter .15s ease, transform .1s ease;
        }
        .btn-submit:hover { filter: brightness(1.07); }
        .btn-submit:active { transform: translateY(1px); }

        .divider {
            display: flex; align-items: center; gap: 12px;
            margin: 22px 0 18px;
            color: #9c96ab;
            font-size: 12px;
        }
        .divider::before, .divider::after {
            content: ""; flex: 1; height: 1px; background: #E7E5F0;
        }

        .signup {
            text-align: center;
            font-size: 13.5px;
            color: #6c6580;
        }
        .signup a { color: var(--orchid); font-weight: 700; text-decoration: none; }
        .signup a:hover { text-decoration: underline; }

        @media (max-width: 900px) {
            .screen { grid-template-columns: 1fr; }
            .brand-panel { padding: 40px 28px; min-height: 320px; }
            .comb { display: none; }
            .brand-copy p { display: none; }
            .brand-copy h1 { font-size: 28px; margin-bottom: 0; }
        }

        @media (prefers-reduced-motion: reduce) {
            .cell { animation: none; }
        }
    </style>
</head>
<body>

    <div class="screen">

        <!-- ============ LEFT PANEL ============ -->
        <div class="brand-panel">
            <div class="brand-mark">
                <span class="dot"></span> {{ strtoupper(config('app.name', 'The Network')) }}
            </div>

            <div>
                <div class="brand-copy">
                    <h1>Six roles. One door in.</h1>
                    <p>Students, employees, employers, freelancers, investors and mentors all sign in here — your dashboard is shaped by who you are.</p>
                </div>

                <div class="comb" aria-hidden="true">
                    <div class="cell c1">
                        <div class="hex"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round"><path d="M22 10v6M2 10l10-5 10 5-10 5-10-5z"/><path d="M6 12v5c3 2 9 2 12 0v-5"/></svg></div>
                        <span class="role-label">Student</span>
                    </div>
                    <div class="cell c2">
                        <div class="hex"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round"><rect x="3" y="7" width="18" height="13" rx="2"/><path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg></div>
                        <span class="role-label">Employee</span>
                    </div>
                    <div class="cell c3">
                        <div class="hex"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round"><path d="M3 21V9l9-6 9 6v12"/><path d="M9 21v-6h6v6"/></svg></div>
                        <span class="role-label">Employer</span>
                    </div>
                    <div class="cell c4">
                        <div class="hex"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round"><path d="M13 2 3 14h7l-1 8 10-12h-7l1-8z"/></svg></div>
                        <span class="role-label">Freelancer</span>
                    </div>
                    <div class="cell c5">
                        <div class="hex"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round"><path d="M3 17l6-6 4 4 8-8"/><path d="M21 7v6h-6"/></svg></div>
                        <span class="role-label">Investor</span>
                    </div>
                    <div class="cell c6">
                        <div class="hex"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="8" r="4"/><path d="M4 21c1-4 5-6 8-6s7 2 8 6"/></svg></div>
                        <span class="role-label">Mentor</span>
                    </div>
                </div>
            </div>

            <div class="brand-foot">MEMBERSHIP · VERIFIED ACCESS · EST. {{ date('Y') }}</div>
        </div>

        <!-- ============ RIGHT PANEL — LOGIN FORM ============ -->
        <div class="form-panel">
            <div class="card">
                <p class="card-eyebrow">Member Sign In</p>
                <h2>Welcome back</h2>
                <p class="sub">Enter your details to continue.</p>

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

                <form method="POST" action="{{ route('do_login') }}" novalidate>
                    @csrf

                    <div class="field">
                        <label for="email">Email or phone</label>
                        <input
                            type="text"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="you@example.com"
                            autocomplete="username"
                            required
                            autofocus
                        >
                        @error('email')
                            <div class="err">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="password">Password</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="••••••••"
                            autocomplete="current-password"
                            required
                        >
                        @error('password')
                            <div class="err">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row-between">
                        <label class="remember">
                            <input type="checkbox" name="remember">
                            Remember me
                        </label>
                        @if (Route::has('password.request'))
                            <a class="forgot" href="{{ route('password.request') }}">Forgot password?</a>
                        @endif
                    </div>

                    <button type="submit" class="btn-submit">Sign in</button>

                    <div class="divider">or</div>

                    <p class="signup">
                        New to the network?
                        @if (Route::has('registration'))
                            <a href="{{ route('registration') }}">Create an account</a>
                        @else
                            <a href="">Create an account</a>
                        @endif
                    </p>
                </form>
            </div>
        </div>

    </div>

</body>
</html>
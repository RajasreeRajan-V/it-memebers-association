<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Payment — {{ config('app.name', 'The Network') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@500;600&display=swap" rel="stylesheet">

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
            --role-accent: var(--orchid);
            --role-accent-2: var(--denim);
        }

        * { box-sizing: border-box; }

        html, body {
            margin: 0; padding: 0;
            background: var(--mist);
            color: var(--abyss);
            font-family: 'Inter', sans-serif;
        }

        .topbar {
            background:
                radial-gradient(circle at 10% 0%, rgba(80,68,130,0.55), transparent 60%),
                radial-gradient(circle at 90% 100%, rgba(60,82,123,0.55), transparent 60%),
                var(--abyss);
            color: var(--mist);
            padding: 30px 24px 46px;
            text-align: center;
        }
        .topbar .brand-mark {
            display: inline-flex; align-items: center; gap: 9px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 12.5px; letter-spacing: 0.16em; text-transform: uppercase;
            opacity: 0.85;
        }
        .topbar .brand-mark .dot {
            width: 7px; height: 7px; border-radius: 50%;
            background: linear-gradient(135deg, var(--mist), var(--denim));
        }
        .topbar h1 {
            font-family: 'Fraunces', serif; font-weight: 500;
            font-size: clamp(26px, 3.4vw, 34px); margin: 16px 0 6px;
        }
        .topbar p { margin: 0; font-size: 14.5px; color: rgba(218,217,231,0.75); }

        .wrap { max-width: 480px; margin: -30px auto 60px; padding: 0 20px; }

        .card {
            background: var(--white);
            border-radius: var(--radius);
            padding: 30px 30px 28px;
            box-shadow: 0 30px 60px -22px rgba(35,25,50,0.35);
        }

        .rail { display: flex; align-items: center; padding: 4px 2px 26px; }
        .rail-station { display: flex; flex-direction: column; align-items: center; gap: 8px; flex-shrink: 0; }
        .rail-node {
            width: 30px; height: 30px; border-radius: 50%;
            border: 2px solid #DAD7E8; background: var(--white);
            display: flex; align-items: center; justify-content: center;
            font-family: 'JetBrains Mono', monospace; font-size: 11px; font-weight: 600;
            color: #9891ab; position: relative; z-index: 2;
        }
        .rail-node svg { width: 13px; height: 13px; stroke: var(--white); display: none; }
        .rail-station.done .rail-node {
            background: linear-gradient(135deg, var(--role-accent), var(--role-accent-2));
            border-color: transparent; color: transparent;
        }
        .rail-station.done .rail-node svg { display: block; }
        .rail-station.active .rail-node {
            border-color: var(--role-accent); color: var(--role-accent);
            box-shadow: 0 0 0 5px rgba(80,68,130,0.13);
        }
        .rail-label { font-size: 10.5px; font-weight: 600; color: #9891ab; white-space: nowrap; }
        .rail-station.active .rail-label, .rail-station.done .rail-label { color: var(--abyss); }
        .rail-track { flex: 1; height: 2px; background: linear-gradient(90deg, var(--role-accent), var(--role-accent-2)); margin: 0 2px 20px; border-radius: 2px; }

        .role-head { display: flex; align-items: center; gap: 12px; margin-bottom: 22px; }
        .icon-badge {
            width: 44px; height: 44px; border-radius: 12px; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            background: linear-gradient(145deg, var(--role-accent), var(--role-accent-2));
            box-shadow: 0 8px 16px -6px rgba(35,25,50,0.45);
        }
        .icon-badge svg { width: 21px; height: 21px; stroke: var(--white); }
        .role-title { font-family: 'Fraunces', serif; font-weight: 500; font-size: 19px; margin: 0; color: var(--abyss); }
        .role-desc { font-size: 12.5px; color: #6c6580; margin: 2px 0 0; }

        .summary-row {
            display: flex; justify-content: space-between; align-items: baseline;
            padding: 10px 0; font-size: 13.5px; color: #6c6580;
            border-top: 1px solid #ECEAF3;
        }
        .summary-row:first-of-type { border-top: none; }
        .summary-row strong { color: var(--abyss); font-weight: 500; }

        .total {
            display: flex; justify-content: space-between; align-items: center;
            margin-top: 10px; padding-top: 16px; border-top: 1.5px dashed #DAD7E8;
        }
        .total-label { font-size: 11.5px; color: #9891ab; text-transform: uppercase; letter-spacing: 0.1em; }
        .total-amount { font-family: 'Fraunces', serif; font-size: 28px; font-weight: 600; color: var(--role-accent); }

        .btn-pay {
            width: 100%; margin-top: 22px; padding: 14px 18px; border: none; border-radius: 10px;
            background: linear-gradient(135deg, var(--role-accent), var(--role-accent-2));
            color: var(--white); font-size: 15px; font-weight: 600; font-family: inherit;
            cursor: pointer; transition: filter .15s ease, transform .1s ease;
        }
        .btn-pay:hover { filter: brightness(1.07); }
        .btn-pay:active { transform: translateY(1px); }
        .btn-pay:disabled { opacity: 0.6; cursor: not-allowed; }
        .btn-pay:focus-visible { outline: 2px solid var(--orchid); outline-offset: 3px; }

        .secure-note { margin-top: 14px; text-align: center; font-size: 12px; color: #9891ab; }

        .banner.error {
            display: none; margin-top: 14px; border-radius: 10px; padding: 11px 14px;
            font-size: 13px; background: #FBEAEF; color: var(--danger); border: 1px solid #F1C6D2;
        }
    </style>
</head>
<body>

    <div class="topbar">
        <div class="brand-mark"><span class="dot"></span> {{ strtoupper(config('app.name', 'The Network')) }}</div>
        <h1>Almost there</h1>
        <p>One payment step stands between you and membership.</p>
    </div>

    <div class="wrap">
        <div class="card">

            @php
                $roleMeta = [
                    'student'    => ['label' => 'Student Membership',    'accent' => ['#504482', '#3C527B'], 'icon' => '<path d="M22 10v6M2 10l10-5 10 5-10 5-10-5z"/><path d="M6 12v5c3 2 9 2 12 0v-5"/>', 'desc' => 'Placement drives, resume review, mentor access.'],
                    'employee'   => ['label' => 'Employee Membership',   'accent' => ['#3C527B', '#3A5079'], 'icon' => '<rect x="3" y="7" width="18" height="13" rx="2"/><path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>', 'desc' => 'Verified job-switch network and referrals.'],
                    'employer'   => ['label' => 'Employer Membership',   'accent' => ['#3A5079', '#231932'], 'icon' => '<path d="M3 21V9l9-6 9 6v12"/><path d="M9 21v-6h6v6"/>', 'desc' => 'Unlimited job posts, verified candidate reach.'],
                    'freelancer' => ['label' => 'Freelancer Membership', 'accent' => ['#5C4E96', '#504482'], 'icon' => '<path d="M13 2 3 14h7l-1 8 10-12h-7l1-8z"/>', 'desc' => 'Featured portfolio placement and client leads.'],
                    'investor'   => ['label' => 'Investor Membership',   'accent' => ['#3A5079', '#3C527B'], 'icon' => '<path d="M3 17l6-6 4 4 8-8"/><path d="M21 7v6h-6"/>', 'desc' => 'Curated deal flow matched to your sectors.'],
                    'mentor'     => ['label' => 'Mentor Membership',     'accent' => ['#6659A0', '#504482'], 'icon' => '<circle cx="12" cy="8" r="4"/><path d="M4 21c1-4 5-6 8-6s7 2 8 6"/>', 'desc' => 'Free — thank you for giving back.'],
                ];
                $role = $user->role ?? 'student';
                $meta = $roleMeta[$role] ?? $roleMeta['student'];
                [$accent1, $accent2] = $meta['accent'];
                $amountPaise = (int) round($amount * 100);
            @endphp

            <div class="rail" style="--role-accent: {{ $accent1 }}; --role-accent-2: {{ $accent2 }};">
                <div class="rail-station done" data-station="1">
                    <span class="rail-node"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span>
                    <span class="rail-label">Account</span>
                </div>
                <div class="rail-track"></div>
                <div class="rail-station done" data-station="2">
                    <span class="rail-node"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span>
                    <span class="rail-label">Details</span>
                </div>
                <div class="rail-track"></div>
                <div class="rail-station active" data-station="3">
                    <span class="rail-node">3</span>
                    <span class="rail-label">Payment</span>
                </div>
            </div>

            <div class="role-head" style="--role-accent: {{ $accent1 }}; --role-accent-2: {{ $accent2 }};">
                <span class="icon-badge"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round">{!! $meta['icon'] !!}</svg></span>
                <div>
                    <p class="role-title">{{ $meta['label'] }}</p>
                    <p class="role-desc">{{ $meta['desc'] }}</p>
                </div>
            </div>

            <div class="summary-row">
                <span>Registered as</span>
                <strong>{{ $user->name }}</strong>
            </div>
            <div class="summary-row">
                <span>Email</span>
                <strong>{{ $user->email }}</strong>
            </div>
            <div class="summary-row">
                <span>Reference ID</span>
                <strong>#{{ str_pad($user->id, 6, '0', STR_PAD_LEFT) }}</strong>
            </div>

            <div class="total">
                <span class="total-label">Amount due</span>
                <span class="total-amount" style="color: {{ $accent1 }};">&#8377;{{ number_format($amount, 0) }}</span>
            </div>

            <button id="pay-btn" class="btn-pay" type="button" style="--role-accent: {{ $accent1 }}; --role-accent-2: {{ $accent2 }};">
                Pay &#8377;{{ number_format($amount, 0) }} &amp; Activate Account
            </button>

            <div id="pay-error" class="banner error"></div>

            <p class="secure-note">Secured by Razorpay. Your account activates once payment and admin approval are complete.</p>
        </div>
    </div>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        document.getElementById('pay-btn').addEventListener('click', function () {
            const btn = document.getElementById('pay-btn');
            const errorBox = document.getElementById('pay-error');
            errorBox.style.display = 'none';
            btn.disabled = true;
            const originalText = btn.textContent;
            btn.textContent = 'Opening secure checkout…';

            const options = {
                key: @json($razorpay_key ?? config('services.razorpay.key')),
                amount: {{ $amountPaise }},
                currency: 'INR',
                name: @json(config('app.name', 'The Network')),
                description: @json($meta['label']),
                // For production: create the order server-side via the Razorpay
                // Orders API and pass order_id here, then verify the payment
                // signature on your callback route before marking paid.
                prefill: {
                    name: @json($user->name),
                    email: @json($user->email),
                    contact: @json($user->phone ?? '')
                },
                notes: {
                    user_id: @json($user->id),
                    role: @json($role)
                },
                theme: { color: @json($accent1) },
                handler: function (response) {
                    window.location.href = @json(route('payment.verify', ['user' => $user->id]))
                        + '?razorpay_payment_id=' + encodeURIComponent(response.razorpay_payment_id)
                        + '&razorpay_order_id=' + encodeURIComponent(response.razorpay_order_id ?? '')
                        + '&razorpay_signature=' + encodeURIComponent(response.razorpay_signature ?? '');
                },
                modal: {
                    ondismiss: function () {
                        btn.disabled = false;
                        btn.textContent = originalText;
                    }
                }
            };

            try {
                const rzp = new Razorpay(options);
                rzp.on('payment.failed', function (response) {
                    errorBox.textContent = response.error.description || 'Payment failed. Please try again.';
                    errorBox.style.display = 'block';
                    btn.disabled = false;
                    btn.textContent = originalText;
                });
                rzp.open();
            } catch (e) {
                errorBox.textContent = 'Unable to start checkout. Please refresh and try again.';
                errorBox.style.display = 'block';
                btn.disabled = false;
                btn.textContent = originalText;
            }
        });
    </script>

</body>
</html>
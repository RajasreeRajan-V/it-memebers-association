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
            --mist: #F4F3F8;
            --orchid: #504482;
            --denim: #3C527B;
            --slate: #3A5079;
            --paper: #F4F3F8;
            --white: #FFFFFF;
            --danger: #B4425C;
            --success: #24603C;
            --radius: 16px;
            --accent-color: #4A90D9;
            --accent-gradient: linear-gradient(135deg, #4A90D9, #357ABD);
        }

        * { box-sizing: border-box; }

        html, body {
            margin: 0; padding: 0;
            background: var(--mist);
            color: var(--abyss);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
        }

        /* Hero Section */
        .payment-hero {
            padding: 60px 0 40px;
            background: linear-gradient(135deg, #F8F9FC 0%, #FFFFFF 100%);
            position: relative;
            overflow: hidden;
            text-align: center;
        }

        .payment-hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(74, 144, 217, 0.05) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .payment-hero .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            position: relative;
            z-index: 1;
        }

        .payment-hero .brand-mark {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 13px;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: #6c757d;
            margin-bottom: 20px;
        }

        .payment-hero .brand-mark .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--orchid), var(--denim));
        }

        .payment-hero .eyebrow {
            display: inline-block;
            font-size: 13px;
            font-weight: 700;
            color: #4A90D9;
            text-transform: uppercase;
            letter-spacing: 2px;
            background: linear-gradient(90deg, rgba(74, 144, 217, 0.1), rgba(74, 144, 217, 0.05));
            padding: 6px 16px;
            border-radius: 50px;
            margin-bottom: 16px;
        }

        .payment-hero h1 {
            font-size: 42px;
            font-weight: 800;
            color: #2d3748;
            margin: 0 0 12px;
            line-height: 1.2;
        }

        .payment-hero h1 .accent-text {
            background: var(--accent-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .payment-hero .hero-sub {
            font-size: 18px;
            line-height: 1.7;
            color: #6c757d;
            margin: 0 auto;
            max-width: 550px;
        }

        /* Payment Wrapper */
        .payment-wrapper {
            max-width: 560px;
            margin: -20px auto 60px;
            padding: 0 20px;
        }

        /* Main Card */
        .payment-card {
            background: var(--white);
            border-radius: var(--radius);
            padding: 36px 36px 32px;
            border: 1px solid #E3E1EC;
            box-shadow: 0 20px 60px -12px rgba(35, 25, 50, 0.15);
            animation: slideUp 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Progress Steps */
        .progress-steps {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 28px;
            padding: 0 10px;
        }

        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            position: relative;
        }

        .step-circle {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: white;
            border: 2px solid #E3E1EC;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .step-number {
            font-weight: 700;
            color: #9891ab;
            font-size: 13px;
            transition: all 0.4s ease;
        }

        .step-check {
            position: absolute;
            opacity: 0;
            transform: scale(0);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            color: white;
        }

        .step.done .step-circle {
            background: linear-gradient(135deg, #2ECC71, #27AE60);
            border-color: #2ECC71;
            box-shadow: 0 4px 12px rgba(46, 204, 113, 0.3);
        }

        .step.done .step-number {
            opacity: 0;
            transform: scale(0);
        }

        .step.done .step-check {
            opacity: 1;
            transform: scale(1);
        }

        .step.active .step-circle {
            border-color: var(--accent-color);
            background: var(--accent-gradient);
            box-shadow: 0 0 0 6px rgba(74, 144, 217, 0.15);
        }

        .step.active .step-number {
            color: white;
        }

        .step-label {
            font-size: 11px;
            font-weight: 600;
            color: #9891ab;
            transition: color 0.3s ease;
            white-space: nowrap;
        }

        .step.active .step-label,
        .step.done .step-label {
            color: #231932;
        }

        .step-connector {
            width: 60px;
            height: 2px;
            background: #E3E1EC;
            margin: 0 6px 24px;
            position: relative;
            overflow: hidden;
            border-radius: 2px;
        }

        .step-connector::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, #2ECC71, #27AE60);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .step-connector.done::after {
            transform: scaleX(1);
        }

        /* Role Header */
        .role-header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 24px;
            padding-bottom: 20px;
            border-bottom: 2px solid #F4F3F8;
        }

        .role-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--accent-gradient);
            box-shadow: 0 8px 20px -6px rgba(74, 144, 217, 0.35);
        }

        .role-icon svg {
            width: 24px;
            height: 24px;
            stroke: white;
            fill: none;
            stroke-width: 2;
        }

        .role-title {
            font-family: 'Fraunces', serif;
            font-weight: 500;
            font-size: 20px;
            margin: 0;
            color: var(--abyss);
        }

        .role-desc {
            font-size: 13px;
            color: #6c6580;
            margin: 2px 0 0;
        }

        /* Summary */
        .summary-list {
            margin-bottom: 16px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            padding: 10px 0;
            font-size: 14px;
            color: #6c6580;
            border-top: 1px solid #ECEAF3;
        }

        .summary-row:first-of-type {
            border-top: none;
        }

        .summary-row strong {
            color: var(--abyss);
            font-weight: 600;
        }

        /* Total */
        .total-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 8px;
            padding-top: 18px;
            border-top: 2px dashed #DAD7E8;
        }

        .total-label {
            font-size: 12px;
            color: #9891ab;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            font-weight: 600;
        }

        .total-amount {
            font-family: 'Fraunces', serif;
            font-size: 32px;
            font-weight: 600;
            color: var(--accent-color);
        }

        /* Pay Button */
        .pay-btn {
            width: 100%;
            margin-top: 24px;
            padding: 16px 24px;
            border: none;
            border-radius: 12px;
            background: var(--accent-gradient);
            color: var(--white);
            font-size: 16px;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            position: relative;
            overflow: hidden;
        }

        .pay-btn::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.2), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .pay-btn:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(74, 144, 217, 0.35);
        }

        .pay-btn:hover:not(:disabled)::before {
            opacity: 1;
        }

        .pay-btn:active:not(:disabled) {
            transform: translateY(0);
        }

        .pay-btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .pay-btn:focus-visible {
            outline: 2px solid var(--accent-color);
            outline-offset: 3px;
        }

        .pay-btn svg {
            transition: transform 0.3s ease;
        }

        .pay-btn:hover:not(:disabled) svg {
            transform: translateX(4px);
        }

        /* Error Banner */
        .error-banner {
            display: none;
            margin-top: 16px;
            padding: 14px 18px;
            border-radius: 12px;
            font-size: 14px;
            background: #FBEAEF;
            color: var(--danger);
            border: 1px solid #F1C6D2;
            align-items: flex-start;
            gap: 10px;
            animation: shake 0.4s ease;
        }

        .error-banner.visible {
            display: flex;
        }

        .error-banner svg {
            flex-shrink: 0;
            margin-top: 1px;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-6px); }
            75% { transform: translateX(6px); }
        }

        /* Secure Note */
        .secure-note {
            margin-top: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 13px;
            color: #9891ab;
        }

        .secure-note svg {
            flex-shrink: 0;
            stroke: #9891ab;
        }

        /* Responsive */
        @media (max-width: 640px) {
            .payment-hero {
                padding: 40px 0 30px;
            }

            .payment-hero h1 {
                font-size: 28px;
            }

            .payment-hero .hero-sub {
                font-size: 15px;
            }

            .payment-wrapper {
                margin: -10px auto 40px;
                padding: 0 16px;
            }

            .payment-card {
                padding: 24px 20px 24px;
                border-radius: 14px;
            }

            .progress-steps {
                gap: 0;
            }

            .step-connector {
                width: 30px;
                margin: 0 4px 22px;
            }

            .step-circle {
                width: 30px;
                height: 30px;
            }

            .step-number {
                font-size: 11px;
            }

            .step-label {
                font-size: 9px;
            }

            .role-header {
                flex-direction: column;
                text-align: center;
                gap: 10px;
            }

            .role-icon {
                width: 44px;
                height: 44px;
            }

            .role-icon svg {
                width: 20px;
                height: 20px;
            }

            .role-title {
                font-size: 17px;
            }

            .role-desc {
                font-size: 12px;
            }

            .summary-row {
                font-size: 13px;
                padding: 8px 0;
            }

            .total-amount {
                font-size: 26px;
            }

            .pay-btn {
                font-size: 15px;
                padding: 14px 20px;
            }

            .secure-note {
                font-size: 12px;
                flex-wrap: wrap;
            }
        }

        @media (max-width: 400px) {
            .payment-card {
                padding: 18px 14px;
            }

            .step-connector {
                width: 20px;
            }
        }
    </style>
</head>
<body>

    <!-- Payment Hero -->
    <section class="payment-hero">
        <div class="container">
            <div class="brand-mark">
                <span class="dot"></span>
                {{ strtoupper(config('app.name', 'The Network')) }}
            </div>
            <p class="eyebrow">Secure Checkout</p>
            <h1>Complete Your <span class="accent-text">Membership</span></h1>
            <p class="hero-sub">One payment step stands between you and your professional community.</p>
        </div>
    </section>

    <!-- Payment Card -->
    <div class="payment-wrapper">
        <div class="payment-card">

            @php
                $roleMeta = [
                    'student'    => ['label' => 'Student Membership',    'accent' => ['#504482', '#3C527B'], 'icon' => '<path d="M22 10v6M2 10l10-5 10 5-10 5-10-5z"/><path d="M6 12v5c3 2 9 2 12 0v-5"/>', 'desc' => 'Placement drives, resume review, mentor access.'],
                    'employee'   => ['label' => 'Employee Membership',   'accent' => ['#2ECC71', '#27AE60'], 'icon' => '<rect x="3" y="7" width="18" height="13" rx="2"/><path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>', 'desc' => 'Verified job-switch network and referrals.'],
                    'employer'   => ['label' => 'Employer Membership',   'accent' => ['#F39C12', '#E67E22'], 'icon' => '<path d="M3 21V9l9-6 9 6v12"/><path d="M9 21v-6h6v6"/>', 'desc' => 'Unlimited job posts, verified candidate reach.'],
                    'freelancer' => ['label' => 'Freelancer Membership', 'accent' => ['#9B59B6', '#8E44AD'], 'icon' => '<path d="M13 2 3 14h7l-1 8 10-12h-7l1-8z"/>', 'desc' => 'Featured portfolio placement and client leads.'],
                    'investor'   => ['label' => 'Investor Membership',   'accent' => ['#E74C3C', '#C0392B'], 'icon' => '<path d="M3 17l6-6 4 4 8-8"/><path d="M21 7v6h-6"/>', 'desc' => 'Curated deal flow matched to your sectors.'],
                    'mentor'     => ['label' => 'Mentor Membership',     'accent' => ['#3498DB', '#2980B9'], 'icon' => '<circle cx="12" cy="8" r="4"/><path d="M4 21c1-4 5-6 8-6s7 2 8 6"/>', 'desc' => 'Free — thank you for giving back.'],
                ];
                $role = $user->role ?? 'student';
                $meta = $roleMeta[$role] ?? $roleMeta['student'];
                [$accent1, $accent2] = $meta['accent'];
                $amountPaise = (int) round($amount * 100);
                $accentGradient = "linear-gradient(135deg, {$accent1}, {$accent2})";
            @endphp

            <!-- Progress Steps -->
            <div class="progress-steps">
                <div class="step done">
                    <span class="step-circle">
                        <span class="step-number">1</span>
                        <svg class="step-check" viewBox="0 0 24 24" width="14" height="14">
                            <polyline points="20 6 9 17 4 12" stroke="currentColor" stroke-width="3" fill="none" stroke-linecap="round"/>
                        </svg>
                    </span>
                    <span class="step-label">Account</span>
                </div>
                <div class="step-connector done"></div>
                <div class="step done">
                    <span class="step-circle">
                        <span class="step-number">2</span>
                        <svg class="step-check" viewBox="0 0 24 24" width="14" height="14">
                            <polyline points="20 6 9 17 4 12" stroke="currentColor" stroke-width="3" fill="none" stroke-linecap="round"/>
                        </svg>
                    </span>
                    <span class="step-label">Details</span>
                </div>
                <div class="step-connector done"></div>
                <div class="step active">
                    <span class="step-circle">
                        <span class="step-number">3</span>
                    </span>
                    <span class="step-label">Payment</span>
                </div>
            </div>

            <!-- Role Header -->
            <div class="role-header" style="--accent-gradient: {{ $accentGradient }}; --accent-color: {{ $accent1 }};">
                <span class="role-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round">
                        {!! $meta['icon'] !!}
                    </svg>
                </span>
                <div>
                    <p class="role-title">{{ $meta['label'] }}</p>
                    <p class="role-desc">{{ $meta['desc'] }}</p>
                </div>
            </div>

            <!-- Summary -->
            <div class="summary-list">
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
            </div>

            <!-- Total -->
            <div class="total-section" style="--accent-color: {{ $accent1 }};">
                <span class="total-label">Amount Due</span>
                <span class="total-amount">&#8377;{{ number_format($amount, 0) }}</span>
            </div>

            <!-- Pay Button -->
            <button id="pay-btn" class="pay-btn" type="button" style="--accent-gradient: {{ $accentGradient }}; --accent-color: {{ $accent1 }};">
                Pay &#8377;{{ number_format($amount, 0) }} &amp; Activate
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                    <path d="M5 12h14M13 6l6 6-6 6"/>
                </svg>
            </button>

            <!-- Error Banner -->
            <div id="pay-error" class="error-banner">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/>
                    <path d="M12 8v4M12 16h.01" stroke-linecap="round"/>
                </svg>
                <span id="error-text">Payment failed. Please try again.</span>
            </div>

            <!-- Secure Note -->
            <p class="secure-note">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="11" width="18" height="11" rx="2"/>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
                Secured by Razorpay. Your account activates once payment and admin approval are complete.
            </p>
        </div>
    </div>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('pay-btn');
            const errorBox = document.getElementById('pay-error');
            const errorText = document.getElementById('error-text');

            btn.addEventListener('click', function() {
                errorBox.classList.remove('visible');
                errorBox.style.display = 'none';
                btn.disabled = true;
                const originalText = btn.innerHTML;
                btn.innerHTML = 'Opening secure checkout…';

                const options = {
                    key: @json($razorpay_key ?? config('services.razorpay.key')),
                    amount: {{ $amountPaise }},
                    currency: 'INR',
                    name: @json(config('app.name', 'The Network')),
                    description: @json($meta['label']),
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
                            btn.innerHTML = originalText;
                        }
                    }
                };

                try {
                    const rzp = new Razorpay(options);
                    rzp.on('payment.failed', function (response) {
                        errorText.textContent = response.error.description || 'Payment failed. Please try again.';
                        errorBox.style.display = 'flex';
                        errorBox.classList.add('visible');
                        btn.disabled = false;
                        btn.innerHTML = originalText;
                    });
                    rzp.open();
                } catch (e) {
                    errorText.textContent = 'Unable to start checkout. Please refresh and try again.';
                    errorBox.style.display = 'flex';
                    errorBox.classList.add('visible');
                    btn.disabled = false;
                    btn.innerHTML = originalText;
                }
            });
        });
    </script>

</body>
</html>
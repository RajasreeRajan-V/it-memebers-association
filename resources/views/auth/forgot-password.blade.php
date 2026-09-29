<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password · Tech Leaders Network</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* ----- global reset & variables ----- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --bg-dark: #0F172A;
            --card-bg: #ffffff;
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --secondary: #4f46e5;
            --text-dark: #0b1b33;
            --text-muted: #5b6c84;
            --border-light: #dce3ec;
            --border-focus: #2563eb;
            --shadow: 0 12px 32px -8px rgba(0, 20, 40, 0.12), 0 4px 12px rgba(0, 0, 0, 0.04);
            --radius: 20px;
            --radius-sm: 14px;
            --transition: 0.2s ease;
        }

        body {
            margin: 0;
            font-family: 'Inter', 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: var(--bg-dark);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            line-height: 1.5;
        }

        /* ----- auth wrapper & card ----- */
        .auth-wrapper {
            width: 100%;
            max-width: 460px;
        }

        .auth-logo {
            text-align: center;
            margin-bottom: 28px;
        }
        .auth-logo a {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: #fff;
            font-weight: 700;
            font-size: 1.5rem;
            text-decoration: none;
            letter-spacing: -0.3px;
        }
        .auth-logo i {
            color: var(--secondary);
            font-size: 1.7rem;
        }

        .auth-card {
            background: var(--card-bg);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 40px 36px 36px;
            transition: box-shadow 0.2s;
        }

        .auth-card h1 {
            font-size: 1.7rem;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0 0 6px;
            letter-spacing: -0.4px;
        }

        .subheading {
            font-size: 0.95rem;
            color: var(--text-muted);
            margin: 0 0 28px;
            font-weight: 400;
            border-left: 3px solid var(--secondary);
            padding-left: 14px;
            background: #f8faff;
            border-radius: 0 8px 8px 0;
            line-height: 1.4;
        }

        /* ----- alerts ----- */
        .alert {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 14px 16px;
            border-radius: var(--radius-sm);
            margin-bottom: 24px;
            font-size: 0.9rem;
            border: 1px solid transparent;
        }
        .alert i {
            margin-top: 2px;
            font-size: 1.1rem;
        }
        .alert-success {
            background: #edfaf3;
            border-color: #b7e4d0;
            color: #0d6b3e;
        }
        .alert-error {
            background: #fff1f0;
            border-color: #fccfcd;
            color: #b3403a;
        }
        .alert-error ul {
            margin: 0 0 0 6px;
            padding-left: 18px;
        }
        .alert-error li {
            list-style: disc;
        }

        /* ----- form ----- */
        .form-group {
            margin-bottom: 22px;
        }

        .form-label {
            display: block;
            font-weight: 600;
            font-size: 0.85rem;
            letter-spacing: 0.3px;
            text-transform: uppercase;
            color: #334155;
            margin-bottom: 6px;
        }

        /* ---------- redesigned input field – clean, neat, modern ---------- */
        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            background: #f9fbfd;
            border: 1.5px solid var(--border-light);
            border-radius: var(--radius-sm);
            transition: border 0.15s, box-shadow 0.15s, background 0.15s;
        }
        .input-wrapper:focus-within {
            border-color: var(--border-focus);
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.08);
        }
        .input-wrapper .input-icon {
            color: #8596ad;
            padding: 0 0 0 16px;
            font-size: 1rem;
            display: flex;
            align-items: center;
            transition: color 0.2s;
        }
        .input-wrapper:focus-within .input-icon {
            color: var(--primary);
        }

        .form-control {
            width: 100%;
            border: none;
            background: transparent;
            padding: 14px 16px 14px 12px;
            font-size: 0.95rem;
            font-weight: 500;
            color: var(--text-dark);
            outline: none;
            font-family: inherit;
            letter-spacing: -0.2px;
        }
        .form-control::placeholder {
            color: #a0b3cc;
            font-weight: 400;
            font-size: 0.9rem;
        }
        .form-control:-webkit-autofill {
            background: transparent !important;
            -webkit-box-shadow: 0 0 0 1000px #f9fbfd inset !important;
        }

        /* error state */
        .input-wrapper.is-invalid {
            border-color: #dc2626;
            background: #fef6f6;
        }
        .input-wrapper.is-invalid:focus-within {
            box-shadow: 0 0 0 4px rgba(220, 38, 38, 0.08);
        }
        .input-wrapper.is-invalid .input-icon {
            color: #dc2626;
        }

        .field-error {
            display: block;
            margin-top: 6px;
            font-size: 0.8rem;
            font-weight: 500;
            color: #dc2626;
            padding-left: 4px;
        }

        /* ----- button ----- */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 14px 24px;
            font-weight: 600;
            font-size: 0.95rem;
            border: none;
            border-radius: var(--radius-sm);
            background: var(--primary);
            color: #fff;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s, box-shadow 0.2s;
            width: 100%;
            letter-spacing: 0.2px;
            box-shadow: 0 4px 8px -2px rgba(37, 99, 235, 0.2);
        }
        .btn:hover {
            background: var(--primary-hover);
            box-shadow: 0 6px 14px -3px rgba(37, 99, 235, 0.3);
            transform: translateY(-1px);
        }
        .btn:active {
            transform: scale(0.98);
        }
        .btn i {
            font-size: 1rem;
        }

        /* ----- footer link ----- */
        .auth-footer-link {
            text-align: center;
            margin-top: 28px;
            font-size: 0.9rem;
            color: var(--text-muted);
        }
        .auth-footer-link a {
            color: var(--secondary);
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border-bottom: 1.5px solid transparent;
            transition: border 0.15s;
        }
        .auth-footer-link a:hover {
            border-bottom-color: var(--secondary);
        }
        .auth-footer-link i {
            font-size: 0.8rem;
        }

        /* ----- responsive fine-tune ----- */
        @media (max-width: 480px) {
            .auth-card {
                padding: 28px 20px;
            }
            .auth-card h1 {
                font-size: 1.4rem;
            }
            .input-wrapper .form-control {
                padding: 12px 12px 12px 10px;
                font-size: 0.9rem;
            }
            .input-wrapper .input-icon {
                padding-left: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-logo">
            <a href="#">
                <i class="fa-solid fa-people-arrows"></i> Tech Leaders Network
            </a>
        </div>

        <div class="auth-card">
            <h1>Forgot password?</h1>
            <p class="subheading">
                <i class="fa-regular fa-envelope" style="margin-right: 6px;"></i>
                Enter your email and we’ll send a reset link.
            </p>

            <!-- success / error messages -->
            @if (session('status'))
                <div class="alert alert-success">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-error">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" novalidate>
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">
                        <i class="fa-regular fa-envelope" style="margin-right: 6px;"></i> Email address
                    </label>
                    <div class="input-wrapper @error('email') is-invalid @enderror">
                        <span class="input-icon"><i class="fa-regular fa-envelope"></i></span>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email') }}"
                            autocomplete="email"
                            autofocus
                            required
                            placeholder="you@example.com"
                        >
                    </div>
                    @error('email')
                        <span class="field-error"><i class="fa-regular fa-circle-exclamation" style="margin-right: 4px;"></i>{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn">
                    <i class="fa-solid fa-paper-plane"></i> Send reset link
                </button>
            </form>

            <div class="auth-footer-link">
                <a href="{{ route('membership') }}">
                    <i class="fa-solid fa-arrow-left"></i> Back to login
                </a>
            </div>
        </div>
    </div>
</body>
</html>
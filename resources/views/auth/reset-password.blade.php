<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reset Password — Tech Leaders Network</title>
    <!-- Font Awesome 6 (solid + regular) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <style>
        /* ----- GLOBAL / VARIABLES (dark background preserved) ----- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --bg-dark: #0b1424;
            --card-bg: #ffffff;
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --secondary: #4f46e5;
            --text-dark: #0f1a2f;
            --text-muted: #475569;
            --border-light: #dce3ec;
            --border-focus: #2563eb;
            --shadow: 0 16px 40px -12px rgba(0, 0, 0, 0.45);
            --radius: 24px;
            --radius-sm: 14px;
            --transition: 0.18s ease;
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

        /* ----- AUTH WRAPPER & CARD ----- */
        .auth-wrapper {
            width: 100%;
            max-width: 480px;
        }

        .auth-logo {
            text-align: center;
            margin-bottom: 28px;
        }
        .auth-logo a {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: #ffffff;
            font-weight: 700;
            font-size: 1.6rem;
            text-decoration: none;
            letter-spacing: -0.3px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }
        .auth-logo i {
            color: #818cf8;
            font-size: 1.8rem;
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
            border-left: 4px solid var(--secondary);
            padding-left: 16px;
            background: #f8faff;
            border-radius: 0 10px 10px 0;
            line-height: 1.4;
        }
        .subheading i {
            color: var(--secondary);
        }

        /* ----- ALERT (error) ----- */
        .alert-error {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 14px 16px;
            border-radius: var(--radius-sm);
            margin-bottom: 24px;
            font-size: 0.9rem;
            border: 1px solid #fccfcd;
            background: #fff1f0;
            color: #b3403a;
        }
        .alert-error i {
            margin-top: 2px;
            font-size: 1.1rem;
            color: #dc2626;
        }
        .alert-error ul {
            margin: 0 0 0 6px;
            padding-left: 18px;
        }
        .alert-error li {
            list-style: disc;
        }

        /* ----- FORM GROUP ----- */
        .form-group {
            margin-bottom: 22px;
        }

        .form-label {
            display: block;
            font-weight: 600;
            font-size: 0.82rem;
            letter-spacing: 0.4px;
            text-transform: uppercase;
            color: #334155;
            margin-bottom: 6px;
        }
        .form-label i {
            margin-right: 8px;
            color: var(--secondary);
            font-size: 0.85rem;
        }

        /* ---------- REDESIGNED INPUT – clean, crisp, modern ---------- */
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
            min-width: 20px;
            justify-content: center;
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

        /* error state on wrapper */
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
        .field-error i {
            margin-right: 4px;
        }

        .field-hint {
            display: block;
            margin-top: 6px;
            font-size: 0.75rem;
            color: #64748b;
            padding-left: 4px;
            font-weight: 400;
        }
        .field-hint i {
            margin-right: 4px;
            color: #22c55e;
        }

        /* ----- BUTTON (primary, full-width) ----- */
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
            box-shadow: 0 4px 10px -2px rgba(37, 99, 235, 0.25);
        }
        .btn:hover {
            background: var(--primary-hover);
            box-shadow: 0 8px 18px -4px rgba(37, 99, 235, 0.35);
            transform: translateY(-2px);
        }
        .btn:active {
            transform: scale(0.97);
        }
        .btn i {
            font-size: 1rem;
        }

        /* ----- FOOTER LINK (on light card) ----- */
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

        /* ----- small screen tweaks ----- */
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
        <!-- Logo – unchanged style, dark bg -->
        <div class="auth-logo">
            <a href="{{ url('/') }}">
                <i class="fa-solid fa-people-arrows"></i> Tech Leaders Network
            </a>
        </div>

        <div class="auth-card">
            <h1>Reset password</h1>
            <p class="subheading">
                <i class="fa-solid fa-key" style="margin-right: 6px;"></i>
                Choose a new password to regain access.
            </p>

            <!-- error alert (if any) -->
            @if ($errors->any())
                <div class="alert-error">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}" novalidate>
                @csrf

                <!-- hidden token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}" />

                <!-- Email -->
                <div class="form-group">
                    <label for="email" class="form-label">
                        <i class="fa-solid fa-envelope"></i> Email address
                    </label>
                    <div class="input-wrapper @error('email') is-invalid @enderror">
                        <span class="input-icon"><i class="fa-solid fa-envelope"></i></span>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email', $request->email) }}"
                            autocomplete="email"
                            autofocus
                            required
                            placeholder="you@example.com"
                        />
                    </div>
                    @error('email')
                        <span class="field-error"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</span>
                    @enderror
                </div>

                <!-- New Password -->
                <div class="form-group">
                    <label for="password" class="form-label">
                        <i class="fa-solid fa-lock"></i> New password
                    </label>
                    <div class="input-wrapper @error('password') is-invalid @enderror">
                        <span class="input-icon"><i class="fa-solid fa-lock"></i></span>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            minlength="8"
                            class="form-control"
                            autocomplete="new-password"
                            required
                            placeholder="••••••••"
                        />
                    </div>
                    @error('password')
                        <span class="field-error"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</span>
                    @enderror
                    <small class="field-hint">
                        <i class="fa-solid fa-circle-check"></i> Min. 8 characters, with uppercase, lowercase &amp; number.
                    </small>
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">
                        <i class="fa-solid fa-check-circle"></i> Confirm new password
                    </label>
                    <div class="input-wrapper">
                        <span class="input-icon"><i class="fa-solid fa-check-circle"></i></span>
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            class="form-control"
                            autocomplete="new-password"
                            required
                            placeholder="••••••••"
                        />
                    </div>
                    <span class="field-error"></span>
                </div>

                <button type="submit" class="btn">
                    <i class="fa-solid fa-key"></i> Reset password
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
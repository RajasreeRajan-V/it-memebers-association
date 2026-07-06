<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Admin Panel</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <style>
        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--light-lilac);
            padding: 1rem;
        }

        .login-card {
            width: 100%;
            max-width: 380px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 16px rgba(35, 25, 50, 0.15);
            overflow: hidden;
        }

        .login-header {
            background-color: var(--dark-purple);
            color: var(--light-lilac);
            text-align: center;
            padding: 2rem 1.5rem 1.5rem;
        }

        .login-header .logo-circle {
            width: 56px;
            height: 56px;
            margin: 0 auto 0.75rem;
            border-radius: 50%;
            background-color: var(--mid-purple);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            font-weight: 700;
        }

        .login-header h1 {
            font-size: 1.25rem;
            font-weight: 600;
        }

        .login-header p {
            font-size: 0.85rem;
            opacity: 0.75;
            margin-top: 0.25rem;
        }

        .login-body {
            padding: 1.75rem 1.75rem 2rem;
        }

        .form-group {
            margin-bottom: 1.1rem;
        }

        .form-group label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--dark-purple);
            margin-bottom: 0.4rem;
        }

        .form-control {
            width: 100%;
            padding: 0.65rem 0.85rem;
            border: 1px solid #c9c7dd;
            border-radius: 6px;
            font-size: 0.95rem;
            color: var(--dark-purple);
            background-color: #fbfbfd;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--mid-purple);
            box-shadow: 0 0 0 3px rgba(80, 68, 130, 0.15);
        }

        .form-control.is-invalid {
            border-color: #c0392b;
        }

        .invalid-feedback {
            color: #c0392b;
            font-size: 0.8rem;
            margin-top: 0.3rem;
        }

        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.4rem;
            font-size: 0.85rem;
        }

        .form-options label {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            color: var(--dark-purple);
            cursor: pointer;
        }

        .form-options a {
            color: var(--mid-purple);
            font-weight: 600;
        }

        .form-options a:hover {
            color: var(--deep-blue);
            text-decoration: underline;
        }

        .btn-login {
            width: 100%;
            padding: 0.75rem;
            border: none;
            border-radius: 6px;
            background-color: var(--blue-purple);
            color: #ffffff;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .btn-login:hover {
            background-color: var(--deep-blue);
        }

        .login-footer {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.8rem;
            color: var(--mid-purple);
        }

        .alert-error {
            background-color: #fdecea;
            border-left: 4px solid #c0392b;
            color: #7a2b21;
            padding: 0.65rem 0.9rem;
            border-radius: 6px;
            font-size: 0.85rem;
            margin-bottom: 1.1rem;
        }
    </style>
</head>
<body>

    <div class="login-wrapper">
        <div class="login-card">

            <div class="login-header">
                <div class="logo-circle">A</div>
                <h1>Admin Panel</h1>
                <p>Sign in to continue to your dashboard</p>
            </div>

            <div class="login-body">

                @if ($errors->any())
                    <div class="alert-error">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.do.login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}"
                            placeholder="you@example.com"
                            required
                            autofocus
                        >
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="••••••••"
                            required
                        >
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-options">
                        <label>
                            <input type="checkbox" name="remember">
                            Remember me
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">Forgot password?</a>
                        @endif
                    </div>

                    <button type="submit" class="btn-login">Sign In</button>
                </form>

            </div>
        </div>
    </div>

    <div class="login-footer">
        &copy; {{ date('Y') }} My Company. All rights reserved.
    </div>

</body>
</html>
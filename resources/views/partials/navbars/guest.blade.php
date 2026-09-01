<link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
    rel="stylesheet"
>

{{-- Font Awesome --}}
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
>

<header class="guest-site-header">

    {{-- ========================================================
         FIRST NAVBAR
    ========================================================= --}}
    <div class="guest-header-top">

        <div class="guest-container guest-top-inner">

            {{-- LOGO + WEBSITE NAME --}}
            <a
                href="{{ route('home') }}"
                class="guest-logo"
            >

                <img
                    src="{{ asset('assets/img/logo1.png') }}"
                    alt="Tech Leaders Network"
                    class="guest-logo-image"
                >

             

            </a>


            {{-- RIGHT SIDE BUTTONS --}}
            <div class="guest-header-actions">

                {{-- MEMBERSHIP --}}
                <a
                    href="{{ route('registration') }}"
                    class="guest-membership-btn"
                >
                    Membership
                </a>

                {{-- LOGIN --}}
                <button
                    type="button"
                    id="loginBtn"
                    class="guest-login-btn"
                >
                    Login
                </button>

            </div>


            {{-- MOBILE MENU BUTTON --}}
            <button
                type="button"
                class="guest-nav-toggle"
                id="guestNavToggle"
                aria-label="Toggle navigation"
                aria-expanded="false"
            >
                <span></span>
                <span></span>
                <span></span>
            </button>

        </div>

    </div>


    {{-- ========================================================
         SECOND NAVBAR
    ========================================================= --}}
    <div
        class="guest-header-bottom"
        id="guestHeaderBottom"
    >

        <div class="guest-container">

            <nav
                class="guest-main-nav"
                id="guestMainNav"
                aria-label="Primary Navigation"
            >

                {{-- HOME --}}
                <a
                    href="{{ route('home') }}"
                    class="{{ request()->routeIs('home') ? 'active' : '' }}"
                >
                    <i class="fa-solid fa-house"></i>
                    <span>Home</span>
                </a>

                {{-- ABOUT --}}
                <a
                    href="{{ route('about') }}"
                    class="{{ request()->routeIs('about') ? 'active' : '' }}"
                >
                    <i class="fa-solid fa-circle-info"></i>
                    <span>About</span>
                </a>

                {{-- FAQS --}}
                <a
                    href="{{ route('FAQs') }}"
                    class="{{ request()->routeIs('FAQs') ? 'active' : '' }}"
                >
                    <i class="fa-solid fa-circle-question"></i>
                    <span>FAQs</span>
                </a>

                {{-- HOW TO BE A MEMBER --}}
                <a
                    href="{{ route('members') }}"
                    class="{{ request()->routeIs('members') ? 'active' : '' }}"
                >
                    <i class="fa-solid fa-user-plus"></i>
                    <span>How to be a Member</span>
                </a>

                {{-- CONTACT --}}
                <a
                    href="{{ route('contact') }}"
                    class="{{ request()->routeIs('contact') ? 'active' : '' }}"
                >
                    <i class="fa-solid fa-envelope"></i>
                    <span>Contact</span>
                </a>

            </nav>

        </div>

    </div>

</header>


{{-- ============================================================
     LOGIN MODAL
============================================================ --}}

<div
    class="login-modal-overlay"
    id="loginModal"
>

    <div class="login-modal">

        {{-- CLOSE BUTTON --}}
        <button
            type="button"
            class="modal-close"
            id="modalCloseBtn"
            aria-label="Close login"
        >

            <svg
                viewBox="0 0 24 24"
                width="24"
                height="24"
            >

                <line
                    x1="18"
                    y1="6"
                    x2="6"
                    y2="18"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                />

                <line
                    x1="6"
                    y1="6"
                    x2="18"
                    y2="18"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                />

            </svg>

        </button>


        <div class="login-modal-container">

            {{-- =================================================
                 LOGIN LEFT SIDE
            ================================================== --}}
            <div class="login-modal-branding">

                <div class="branding-content">

                    {{-- YOUR LOGO --}}
                    <div class="brand-logo">

                        <img
                            src="{{ asset('assets/img/logo1.png') }}"
                            alt="Tech Leaders Network"
                            class="modal-logo-image"
                        >

                    </div>

                    <h2>
                        Welcome Back
                    </h2>

                    <p class="branding-subtitle">
                        Sign in to continue your professional journey
                        and unlock exclusive opportunities.
                    </p>

                    <div class="branding-features">

                        {{-- FEATURE 1 --}}
                        <div class="feature-item">

                            <div class="feature-icon">

                                <svg
                                    viewBox="0 0 24 24"
                                    width="18"
                                    height="18"
                                >

                                    <path
                                        d="M22 11.08V12a10 10 0 1 1-5.93-9.14"
                                        stroke="white"
                                        stroke-width="2"
                                        fill="none"
                                    />

                                    <path
                                        d="M22 4L12 14.01l-3-3"
                                        stroke="white"
                                        stroke-width="2"
                                        fill="none"
                                    />

                                </svg>

                            </div>

                            <span>
                                Secure access
                            </span>

                        </div>


                        {{-- FEATURE 2 --}}
                        <div class="feature-item">

                            <div class="feature-icon">

                                <svg
                                    viewBox="0 0 24 24"
                                    width="18"
                                    height="18"
                                >

                                    <circle
                                        cx="12"
                                        cy="12"
                                        r="10"
                                        stroke="white"
                                        stroke-width="2"
                                        fill="none"
                                    />

                                    <path
                                        d="M12 6v6l4 2"
                                        stroke="white"
                                        stroke-width="2"
                                        fill="none"
                                    />

                                </svg>

                            </div>

                            <span>
                                Real-time updates
                            </span>

                        </div>


                        {{-- FEATURE 3 --}}
                        <div class="feature-item">

                            <div class="feature-icon">

                                <svg
                                    viewBox="0 0 24 24"
                                    width="18"
                                    height="18"
                                >

                                    <path
                                        d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"
                                        stroke="white"
                                        stroke-width="2"
                                        fill="none"
                                    />

                                    <circle
                                        cx="9"
                                        cy="7"
                                        r="4"
                                        stroke="white"
                                        stroke-width="2"
                                        fill="none"
                                    />

                                    <path
                                        d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"
                                        stroke="white"
                                        stroke-width="2"
                                        fill="none"
                                    />

                                </svg>

                            </div>

                            <span>
                                Connect with leaders
                            </span>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 LOGIN RIGHT SIDE
            ================================================== --}}
            <div class="login-modal-form">

                <div class="login-form-wrapper">

                    {{-- FORM HEADER --}}
                    <div class="form-header-login">

                        <h3>
                            Sign In
                        </h3>

                        <p>
                            Enter your credentials to access your account
                        </p>

                    </div>


                    {{-- SUCCESS --}}
                    @if (session('status'))

                        <div class="login-alert login-alert-success">

                            <svg
                                viewBox="0 0 24 24"
                                width="18"
                                height="18"
                            >

                                <path
                                    d="M22 11.08V12a10 10 0 1 1-5.93-9.14"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    fill="none"
                                />

                                <path
                                    d="M22 4L12 14.01l-3-3"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    fill="none"
                                />

                            </svg>

                            <span>
                                {{ session('status') }}
                            </span>

                        </div>

                    @endif


                    {{-- ERRORS --}}
                    @if ($errors->any())

                        <div class="login-alert login-alert-error">

                            <svg
                                viewBox="0 0 24 24"
                                width="18"
                                height="18"
                            >

                                <circle
                                    cx="12"
                                    cy="12"
                                    r="10"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    fill="none"
                                />

                                <path
                                    d="M12 8v4M12 16h.01"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    fill="none"
                                />

                            </svg>

                            <div>

                                <strong>
                                    Please fix the following errors:
                                </strong>

                                <ul>

                                    @foreach ($errors->all() as $error)

                                        <li>
                                            {{ $error }}
                                        </li>

                                    @endforeach

                                </ul>

                            </div>

                        </div>

                    @endif


                    {{-- SESSION ERROR --}}
                    @if (session('error'))

                        <div class="login-alert login-alert-error">

                            <svg
                                viewBox="0 0 24 24"
                                width="18"
                                height="18"
                            >

                                <circle
                                    cx="12"
                                    cy="12"
                                    r="10"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    fill="none"
                                />

                                <path
                                    d="M12 8v4M12 16h.01"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    fill="none"
                                />

                            </svg>

                            <span>
                                {{ session('error') }}
                            </span>

                        </div>

                    @endif


                    {{-- LOGIN FORM --}}
                    <form
                        method="POST"
                        action="{{ route('do_login') }}"
                        class="login-form"
                    >

                        @csrf

                        {{-- EMAIL --}}
                        <div class="form-group-login">

                            <label class="form-label-login">
                                Email Address
                            </label>

                            <div class="input-wrapper-login">

                                <svg
                                    class="input-icon-login"
                                    viewBox="0 0 24 24"
                                    width="18"
                                    height="18"
                                >

                                    <path
                                        d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        fill="none"
                                    />

                                    <polyline
                                        points="22,6 12,13 2,6"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        fill="none"
                                    />

                                </svg>

                                <input
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    placeholder="your@email.com"
                                />

                            </div>

                            @error('email')

                                <span class="error-message-login">
                                    {{ $message }}
                                </span>

                            @enderror

                        </div>


                        {{-- PASSWORD --}}
                        <div class="form-group-login">

                            <label class="form-label-login">
                                Password
                            </label>

                            <div class="input-wrapper-login">

                                <svg
                                    class="input-icon-login"
                                    viewBox="0 0 24 24"
                                    width="18"
                                    height="18"
                                >

                                    <rect
                                        x="3"
                                        y="11"
                                        width="18"
                                        height="11"
                                        rx="2"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        fill="none"
                                    />

                                    <path
                                        d="M7 11V7a5 5 0 0 1 10 0v4"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        fill="none"
                                    />

                                </svg>

                                <input
                                    type="password"
                                    name="password"
                                    id="loginPassword"
                                    required
                                    placeholder="Enter your password"
                                />

                                <button
                                    type="button"
                                    class="password-toggle"
                                    id="passwordToggle"
                                    aria-label="Show password"
                                >

                                    <svg
                                        viewBox="0 0 24 24"
                                        width="18"
                                        height="18"
                                    >

                                        <path
                                            d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            fill="none"
                                        />

                                        <circle
                                            cx="12"
                                            cy="12"
                                            r="3"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            fill="none"
                                        />

                                    </svg>

                                </button>

                            </div>

                            @error('password')

                                <span class="error-message-login">
                                    {{ $message }}
                                </span>

                            @enderror

                        </div>


                        {{-- OPTIONS --}}
                        <div class="login-options-login">

                            <label class="checkbox-label-login">

                                <input
                                    type="checkbox"
                                    name="remember"
                                    {{ old('remember') ? 'checked' : '' }}
                                >

                                <span class="checkbox-custom-login">

                                    <svg
                                        viewBox="0 0 24 24"
                                        width="12"
                                        height="12"
                                    >

                                        <polyline
                                            points="20 6 9 17 4 12"
                                            stroke="white"
                                            stroke-width="3"
                                            fill="none"
                                            stroke-linecap="round"
                                        />

                                    </svg>

                                </span>

                                <span class="checkbox-text-login">
                                    Remember me
                                </span>

                            </label>

                            <a
                                href="#"
                                class="forgot-link-login"
                            >
                                Forgot Password?
                            </a>

                        </div>


                        {{-- LOGIN BUTTON --}}
                        <button
                            type="submit"
                            class="login-submit-btn-login"
                        >

                            <span>
                                Sign In
                            </span>

                            <svg
                                viewBox="0 0 24 24"
                                width="18"
                                height="18"
                            >

                                <path
                                    d="M5 12h14M13 6l6 6-6 6"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    fill="none"
                                    stroke-linecap="round"
                                />

                            </svg>

                        </button>


                        {{-- DIVIDER --}}
                        <div class="login-divider-login">

                            <span>
                                Or continue with
                            </span>

                        </div>


                        {{-- SOCIAL BUTTONS --}}
                        <div class="social-login-login">

                            <button
                                type="button"
                                class="social-btn-login"
                            >
                                Google
                            </button>

                            <button
                                type="button"
                                class="social-btn-login"
                            >
                                GitHub
                            </button>

                        </div>


                        {{-- REGISTER --}}
                        <p class="signup-text-login">

                            Don't have an account?

                            <a
                                href="{{ route('registration') }}"
                                class="signup-link-login"
                            >
                                Create one now
                            </a>

                        </p>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- ============================================================
     CSS
============================================================ --}}

<style>

* {
    box-sizing: border-box;
}

html {
    scroll-behavior: smooth;
}

body {
    margin: 0;
}


/* ============================================================
   HEADER
============================================================ */

.guest-site-header {
    width: 100%;
    position: sticky;
    top: 0;
    z-index: 5000;
    font-family: 'Poppins', sans-serif;
    background: #ffffff;
    box-shadow: 0 4px 20px rgba(15, 23, 42, 0.08);
}


/* ============================================================
   CONTAINER
============================================================ */

.guest-container {
    width: 100%;
    max-width: 1440px;
    margin: 0 auto;
    padding-left: 32px;
    padding-right: 32px;
}


/* ============================================================
   FIRST WHITE NAVBAR
   REDUCED HEIGHT
============================================================ */

.guest-header-top {
    width: 100%;
    background: #ffffff;
    border-bottom: 1px solid #edf0f5;
}


/* REDUCED FROM 100px TO 78px */

.guest-top-inner {
    min-height: 78px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 25px;
}


/* ============================================================
   LOGO
============================================================ */

.guest-logo {
    display: flex;
    align-items: center;
    gap: 12px;

    text-decoration: none;
    flex-shrink: 0;
}


/* INCREASED LOGO */

.guest-logo-image {
    width: 245px;
    height: auto;

    max-height: 62px;

    object-fit: contain;
    object-position: left center;

    display: block;
}


/* ============================================================
   LOGO TEXT
============================================================ */

.guest-logo-text {
    color: #172554;

    font-size: 18px;
    font-weight: 700;

    letter-spacing: -0.3px;
    white-space: nowrap;
}


/* ============================================================
   RIGHT SIDE BUTTONS
============================================================ */

.guest-header-actions {
    display: flex;
    align-items: center;

    gap: 10px;
    margin-left: auto;
}


/* ============================================================
   MEMBERSHIP BUTTON
============================================================ */

.guest-membership-btn {
    min-height: 40px;

    padding: 0 20px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    border-radius: 999px;

    background: #4f46e5;
    color: #ffffff;

    text-decoration: none;

    font-size: 13px;
    font-weight: 600;

    transition: all 0.25s ease;
}

.guest-membership-btn:hover {
    background: #4338ca;
    color: #ffffff;

    transform: translateY(-1px);

    box-shadow:
        0 8px 20px rgba(79,70,229,0.22);
}


/* ============================================================
   LOGIN BUTTON
============================================================ */

.guest-login-btn {
    min-height: 40px;

    padding: 0 20px;

    border-radius: 999px;

    background: #ffffff;

    border: 1px solid #d9deea;

    color: #263246;

    font-family: 'Poppins', sans-serif;

    font-size: 13px;
    font-weight: 600;

    cursor: pointer;

    transition: all 0.25s ease;
}

.guest-login-btn:hover {
    border-color: #4f46e5;

    color: #4f46e5;

    background: #f8f7ff;
}


/* ============================================================
   SECOND BLUE NAVBAR
============================================================ */

.guest-header-bottom {
    width: 100%;

    background:
        linear-gradient(
            90deg,
            #2f57c9 0%,
            #3364d7 50%,
            #2f57c9 100%
        );
}


.guest-main-nav {
    min-height: 55px;

    display: flex;
    align-items: center;
    justify-content: center;

    gap: 8px;
}


.guest-main-nav a {
    min-height: 38px;

    padding: 7px 17px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 8px;

    border-radius: 8px;

    color: rgba(255,255,255,0.88);

    text-decoration: none;

    font-size: 13px;
    font-weight: 500;

    white-space: nowrap;

    transition: all 0.2s ease;
}


.guest-main-nav a i {
    font-size: 13px;
    color: rgba(255,255,255,0.72);
}


.guest-main-nav a:hover {
    color: #ffffff;

    background:
        rgba(255,255,255,0.14);
}


.guest-main-nav a:hover i {
    color: #ffffff;
}


/* ACTIVE */

.guest-main-nav a.active {
    color: #1f2937;

    background: #ffffff;

    font-weight: 600;

    box-shadow:
        0 3px 10px rgba(0,0,0,0.08);
}


.guest-main-nav a.active i {
    color: #4f46e5;
}


/* ============================================================
   MOBILE MENU BUTTON
============================================================ */

.guest-nav-toggle {
    display: none;

    width: 42px;
    height: 42px;

    padding: 8px;

    border: 1px solid #e1e5ed;

    border-radius: 9px;

    background: #ffffff;

    cursor: pointer;

    flex-direction: column;

    align-items: center;
    justify-content: center;

    gap: 5px;
}


.guest-nav-toggle span {
    display: block;

    width: 21px;
    height: 2px;

    border-radius: 3px;

    background: #374151;
}


/* ============================================================
   LOGIN MODAL OVERLAY
============================================================ */

.login-modal-overlay {
    position: fixed;

    inset: 0;

    display: none;

    align-items: center;
    justify-content: center;

    padding: 20px;

    background:
        rgba(15,23,42,0.62);

    backdrop-filter: blur(8px);

    z-index: 99999;
}


.login-modal-overlay.visible {
    display: flex;
}


/* ============================================================
   LOGIN MODAL
============================================================ */

.login-modal {
    position: relative;

    width: 100%;

    max-width: 900px;

    max-height: 92vh;

    overflow-y: auto;

    background: #ffffff;

    border-radius: 24px;

    box-shadow:
        0 40px 100px rgba(0,0,0,0.28);

    animation:
        loginModalOpen 0.35s ease;
}


@keyframes loginModalOpen {

    from {
        opacity: 0;

        transform:
            translateY(25px)
            scale(0.96);
    }

    to {
        opacity: 1;

        transform:
            translateY(0)
            scale(1);
    }

}


/* ============================================================
   MODAL CLOSE
============================================================ */

.modal-close {
    position: absolute;

    top: 16px;
    right: 16px;

    width: 40px;
    height: 40px;

    display: flex;

    align-items: center;
    justify-content: center;

    border: none;

    border-radius: 50%;

    background:
        rgba(255,255,255,0.94);

    color: #374151;

    cursor: pointer;

    z-index: 20;

    box-shadow:
        0 3px 14px rgba(0,0,0,0.10);

    transition: all 0.25s ease;
}


.modal-close:hover {
    background: #f1f3f7;

    transform: rotate(90deg);
}


/* ============================================================
   MODAL GRID
============================================================ */

.login-modal-container {
    display: grid;

    grid-template-columns: 1fr 1fr;

    min-height: 520px;
}


/* ============================================================
   BRANDING
============================================================ */

.login-modal-branding {
    position: relative;

    padding: 45px 38px;

    display: flex;

    align-items: center;

    overflow: hidden;

    background:
        linear-gradient(
            135deg,
            #263b86 0%,
            #2f57c9 55%,
            #3364d7 100%
        );

    border-radius:
        24px 0 0 24px;
}


.login-modal-branding::before {
    content: "";

    position: absolute;

    width: 400px;
    height: 400px;

    top: -180px;
    right: -170px;

    border-radius: 50%;

    background:
        rgba(255,255,255,0.08);
}


.login-modal-branding::after {
    content: "";

    position: absolute;

    width: 280px;
    height: 280px;

    bottom: -150px;
    left: -120px;

    border-radius: 50%;

    background:
        rgba(255,255,255,0.06);
}


.branding-content {
    position: relative;

    z-index: 2;
}


/* ============================================================
   MODAL LOGO
============================================================ */

.brand-logo {
    display: flex;

    align-items: center;

    margin-bottom: 35px;
}


.modal-logo-image {
    width: 190px;

    max-width: 100%;

    height: auto;

    max-height: 65px;

    object-fit: contain;

    object-position: left center;

    background: #ffffff;

    padding: 8px 12px;

    border-radius: 8px;
}


/* ============================================================
   BRANDING TEXT
============================================================ */

.login-modal-branding h2 {
    margin: 0 0 10px;

    color: #ffffff;

    font-size: 32px;

    font-weight: 700;

    line-height: 1.2;
}


.branding-subtitle {
    max-width: 350px;

    margin: 0 0 32px;

    color:
        rgba(255,255,255,0.78);

    font-size: 14px;

    line-height: 1.7;
}


/* ============================================================
   FEATURES
============================================================ */

.branding-features {
    display: flex;

    flex-direction: column;

    gap: 14px;
}


.feature-item {
    display: flex;

    align-items: center;

    gap: 12px;

    color:
        rgba(255,255,255,0.88);

    font-size: 13px;

    font-weight: 500;
}


.feature-icon {
    width: 34px;
    height: 34px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background:
        rgba(255,255,255,0.12);
}


/* ============================================================
   FORM SIDE
============================================================ */

.login-modal-form {
    display: flex;

    align-items: center;
    justify-content: center;

    padding: 42px 38px;

    background: #ffffff;

    border-radius:
        0 24px 24px 0;
}


.login-form-wrapper {
    width: 100%;

    max-width: 370px;
}


/* ============================================================
   FORM HEADER
============================================================ */

.form-header-login {
    margin-bottom: 25px;
}


.form-header-login h3 {
    margin: 0 0 5px;

    color: #1f2937;

    font-size: 25px;

    font-weight: 700;
}


.form-header-login p {
    margin: 0;

    color: #737b8c;

    font-size: 13px;
}


/* ============================================================
   FORM GROUP
============================================================ */

.form-group-login {
    display: flex;

    flex-direction: column;

    gap: 6px;

    margin-bottom: 17px;
}


.form-label-login {
    color: #303846;

    font-size: 13px;

    font-weight: 600;
}


.input-wrapper-login {
    position: relative;
}


.input-icon-login {
    position: absolute;

    left: 13px;

    top: 50%;

    transform:
        translateY(-50%);

    color: #9aa2b2;

    pointer-events: none;
}


.input-wrapper-login input {
    width: 100%;

    height: 46px;

    padding:
        0 42px;

    border: 1px solid #e1e5ed;

    border-radius: 10px;

    outline: none;

    background: #fafbfc;

    color: #1f2937;

    font-family: 'Poppins', sans-serif;

    font-size: 13px;

    transition: all 0.25s ease;
}


.input-wrapper-login input:focus {
    border-color: #4f46e5;

    background: #ffffff;

    box-shadow:
        0 0 0 4px rgba(79,70,229,0.08);
}


.password-toggle {
    position: absolute;

    right: 10px;

    top: 50%;

    transform:
        translateY(-50%);

    display: flex;

    border: none;

    background: transparent;

    color: #9aa2b2;

    cursor: pointer;

    padding: 5px;
}


.password-toggle:hover {
    color: #4f46e5;
}


.error-message-login {
    color: #dc2626;

    font-size: 11px;
}


/* ============================================================
   OPTIONS
============================================================ */

.login-options-login {
    display: flex;

    align-items: center;

    justify-content: space-between;

    margin:
        3px 0 20px;
}


.checkbox-label-login {
    display: flex;

    align-items: center;

    gap: 8px;

    cursor: pointer;
}


.checkbox-label-login input {
    display: none;
}


.checkbox-custom-login {
    width: 18px;
    height: 18px;

    display: flex;

    align-items: center;
    justify-content: center;

    border:
        1.5px solid #d4d9e3;

    border-radius: 5px;
}


.checkbox-custom-login svg {
    opacity: 0;
}


.checkbox-label-login input:checked
+ .checkbox-custom-login {
    background: #4f46e5;

    border-color: #4f46e5;
}


.checkbox-label-login input:checked
+ .checkbox-custom-login svg {
    opacity: 1;
}


.checkbox-text-login {
    color: #687184;

    font-size: 12px;
}


.forgot-link-login {
    color: #4f46e5;

    font-size: 12px;

    font-weight: 600;

    text-decoration: none;
}


/* ============================================================
   SUBMIT BUTTON
============================================================ */

.login-submit-btn-login {
    width: 100%;

    min-height: 46px;

    display: flex;

    align-items: center;
    justify-content: center;

    gap: 8px;

    border: none;

    border-radius: 10px;

    background:
        linear-gradient(
            135deg,
            #4f46e5,
            #3364d7
        );

    color: #ffffff;

    font-family: 'Poppins', sans-serif;

    font-size: 14px;

    font-weight: 600;

    cursor: pointer;

    transition: all 0.25s ease;
}


.login-submit-btn-login:hover {
    transform: translateY(-2px);

    box-shadow:
        0 10px 25px rgba(79,70,229,0.25);
}


/* ============================================================
   DIVIDER
============================================================ */

.login-divider-login {
    display: flex;

    align-items: center;

    gap: 12px;

    margin:
        21px 0 16px;
}


.login-divider-login::before,
.login-divider-login::after {
    content: "";

    flex: 1;

    height: 1px;

    background: #e5e8ee;
}


.login-divider-login span {
    color: #9aa1af;

    font-size: 11px;
}


/* ============================================================
   SOCIAL
============================================================ */

.social-login-login {
    display: flex;

    gap: 10px;

    margin-bottom: 20px;
}


.social-btn-login {
    flex: 1;

    height: 43px;

    display: flex;

    align-items: center;
    justify-content: center;

    border:
        1px solid #e0e4eb;

    border-radius: 9px;

    background: #ffffff;

    color: #303846;

    font-family: 'Poppins', sans-serif;

    font-size: 12px;

    font-weight: 600;

    cursor: pointer;
}


.social-btn-login:hover {
    background: #f8f9fb;

    border-color: #cdd3df;
}


/* ============================================================
   SIGNUP
============================================================ */

.signup-text-login {
    margin: 0;

    text-align: center;

    color: #737b8c;

    font-size: 12px;
}


.signup-link-login {
    color: #4f46e5;

    font-weight: 700;

    text-decoration: none;
}


/* ============================================================
   ALERTS
============================================================ */

.login-alert {
    display: flex;

    align-items: flex-start;

    gap: 9px;

    padding: 11px 13px;

    margin-bottom: 16px;

    border-radius: 9px;

    font-size: 12px;
}


.login-alert-success {
    color: #24603c;

    background: #e9f6ed;

    border: 1px solid #c7e7d0;
}


.login-alert-error {
    color: #b4233e;

    background: #fff0f2;

    border: 1px solid #f2c8d0;
}


.login-alert ul {
    margin: 5px 0 0;

    padding-left: 16px;
}


/* ============================================================
   TABLET
============================================================ */

@media (max-width: 1100px) {

    .guest-container {
        padding-left: 25px;
        padding-right: 25px;
    }

    .guest-logo-image {
        width: 215px;
        max-height: 58px;
    }

    .guest-logo-text {
        font-size: 16px;
    }

    .guest-main-nav a {
        padding-left: 12px;
        padding-right: 12px;

        font-size: 12px;
    }

}


/* ============================================================
   MOBILE
============================================================ */

@media (max-width: 768px) {

    .guest-top-inner {
        min-height: 72px;

        gap: 10px;
    }

    .guest-logo {
        gap: 8px;
    }

    .guest-logo-image {
        width: 175px;

        max-height: 55px;
    }

    .guest-logo-text {
        display: none;
    }

    .guest-header-actions {
        gap: 7px;
    }

    .guest-membership-btn,
    .guest-login-btn {

        min-height: 36px;

        padding-left: 14px;
        padding-right: 14px;

        font-size: 11px;
    }

    .guest-nav-toggle {
        display: flex;
    }

    .guest-header-bottom {
        display: none;
    }

    .guest-header-bottom.mobile-open {
        display: block;
    }

    .guest-main-nav {

        flex-direction: column;

        align-items: stretch;

        justify-content: flex-start;

        gap: 4px;

        padding:
            12px 0;
    }

    .guest-main-nav a {

        width: 100%;

        justify-content: flex-start;

        padding:
            12px 15px;

        font-size: 13px;
    }


    /* LOGIN MODAL */

    .login-modal-container {

        grid-template-columns: 1fr;
    }

    .login-modal-branding {

        min-height: 260px;

        padding: 30px;

        border-radius:
            24px 24px 0 0;
    }

    .login-modal-form {

        padding: 30px;

        border-radius:
            0 0 24px 24px;
    }

    .login-modal {

        max-width: 520px;
    }

}


/* ============================================================
   SMALL MOBILE
============================================================ */

@media (max-width: 560px) {

    .guest-container {

        padding-left: 15px;
        padding-right: 15px;
    }

    .guest-top-inner {

        min-height: 68px;
    }

    .guest-logo-image {

        width: 150px;

        max-height: 50px;
    }

    .guest-membership-btn,
    .guest-login-btn {

        padding-left: 10px;
        padding-right: 10px;

        font-size: 10px;
    }

    .guest-nav-toggle {

        width: 38px;
        height: 38px;
    }

    .login-modal-overlay {

        padding: 10px;
    }

    .login-modal {

        border-radius: 18px;

        max-height: 96vh;
    }

    .login-modal-branding {

        padding: 25px 20px;

        min-height: 230px;

        border-radius:
            18px 18px 0 0;
    }

    .login-modal-branding h2 {

        font-size: 24px;
    }

    .branding-subtitle {

        font-size: 12px;
    }

    .login-modal-form {

        padding: 25px 20px;

        border-radius:
            0 0 18px 18px;
    }

    .social-login-login {

        flex-direction: column;
    }

}


/* ============================================================
   VERY SMALL MOBILE
============================================================ */

@media (max-width: 400px) {

    .guest-logo-image {

        width: 125px;
    }

    .guest-membership-btn,
    .guest-login-btn {

        padding-left: 8px;
        padding-right: 8px;
    }

}

</style>


{{-- ============================================================
     JAVASCRIPT
============================================================ --}}

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {


    /* ========================================================
       MOBILE NAVIGATION
    ======================================================== */

    const guestNavToggle =
        document.getElementById('guestNavToggle');

    const guestHeaderBottom =
        document.getElementById('guestHeaderBottom');


    if (
        guestNavToggle &&
        guestHeaderBottom
    ) {

        guestNavToggle.addEventListener(
            'click',
            function () {

                const isOpen =
                    guestHeaderBottom.classList.toggle(
                        'mobile-open'
                    );


                guestNavToggle.setAttribute(
                    'aria-expanded',
                    isOpen ? 'true' : 'false'
                );

            }
        );

    }


    /* ========================================================
       CLOSE MOBILE MENU
    ======================================================== */

    const mobileNavLinks =
        document.querySelectorAll(
            '.guest-main-nav a'
        );


    mobileNavLinks.forEach(
        function (link) {

            link.addEventListener(
                'click',
                function () {

                    if (
                        window.innerWidth <= 768 &&
                        guestHeaderBottom
                    ) {

                        guestHeaderBottom.classList.remove(
                            'mobile-open'
                        );

                    }

                    if (guestNavToggle) {

                        guestNavToggle.setAttribute(
                            'aria-expanded',
                            'false'
                        );

                    }

                }
            );

        }
    );


    /* ========================================================
       LOGIN MODAL
    ======================================================== */

    const loginBtn =
        document.getElementById('loginBtn');

    const loginModal =
        document.getElementById('loginModal');

    const modalCloseBtn =
        document.getElementById('modalCloseBtn');


    function showLoginModal() {

        if (!loginModal) {
            return;
        }

        loginModal.classList.add('visible');

        document.body.style.overflow =
            'hidden';

        setTimeout(
            function () {

                const emailInput =
                    loginModal.querySelector(
                        'input[name="email"]'
                    );

                if (emailInput) {

                    emailInput.focus();

                }

            },
            300
        );

    }


    function hideLoginModal() {

        if (!loginModal) {
            return;
        }

        loginModal.classList.remove(
            'visible'
        );

        document.body.style.overflow = '';

    }


    /* ========================================================
       LOGIN BUTTON
    ======================================================== */

    if (loginBtn) {

        loginBtn.addEventListener(
            'click',
            function (event) {

                event.preventDefault();

                showLoginModal();

            }
        );

    }


    /* ========================================================
       CLOSE BUTTON
    ======================================================== */

    if (modalCloseBtn) {

        modalCloseBtn.addEventListener(
            'click',
            function () {

                hideLoginModal();

            }
        );

    }


    /* ========================================================
       CLICK OUTSIDE MODAL
    ======================================================== */

    if (loginModal) {

        loginModal.addEventListener(
            'click',
            function (event) {

                if (
                    event.target === loginModal
                ) {

                    hideLoginModal();

                }

            }
        );

    }


    /* ========================================================
       ESCAPE KEY
    ======================================================== */

    document.addEventListener(
        'keydown',
        function (event) {

            if (
                event.key === 'Escape' &&
                loginModal &&
                loginModal.classList.contains(
                    'visible'
                )
            ) {

                hideLoginModal();

            }

        }
    );


    /* ========================================================
       PASSWORD SHOW / HIDE
    ======================================================== */

    const passwordToggle =
        document.getElementById(
            'passwordToggle'
        );

    const loginPassword =
        document.getElementById(
            'loginPassword'
        );


    if (
        passwordToggle &&
        loginPassword
    ) {

        passwordToggle.addEventListener(
            'click',
            function () {

                if (
                    loginPassword.type ===
                    'password'
                ) {

                    loginPassword.type =
                        'text';

                    passwordToggle.setAttribute(
                        'aria-label',
                        'Hide password'
                    );

                    passwordToggle.innerHTML = `

                        <svg
                            viewBox="0 0 24 24"
                            width="18"
                            height="18"
                        >

                            <path
                                d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"
                                stroke="currentColor"
                                stroke-width="2"
                                fill="none"
                                stroke-linecap="round"
                            />

                            <path
                                d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"
                                stroke="currentColor"
                                stroke-width="2"
                                fill="none"
                                stroke-linecap="round"
                            />

                            <line
                                x1="1"
                                y1="1"
                                x2="23"
                                y2="23"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                            />

                        </svg>

                    `;

                }

                else {

                    loginPassword.type =
                        'password';

                    passwordToggle.setAttribute(
                        'aria-label',
                        'Show password'
                    );

                    passwordToggle.innerHTML = `

                        <svg
                            viewBox="0 0 24 24"
                            width="18"
                            height="18"
                        >

                            <path
                                d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"
                                stroke="currentColor"
                                stroke-width="2"
                                fill="none"
                            />

                            <circle
                                cx="12"
                                cy="12"
                                r="3"
                                stroke="currentColor"
                                stroke-width="2"
                                fill="none"
                            />

                        </svg>

                    `;

                }

            }
        );

    }


    /* ========================================================
       OPEN LOGIN AFTER ERROR
    ======================================================== */

    @if (
        $errors->any() ||
        session('error') ||
        session('status') ||
        session('open_login_modal')
    )

        showLoginModal();

    @endif


});

</script>
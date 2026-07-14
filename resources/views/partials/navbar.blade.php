<!-- Updated Site Header -->
<header class="site-header">
  <div class="container header-inner">
    <a href="#" class="logo">
      <span class="logo-mark" aria-hidden="true">
        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M15 2L27 8.5V21.5L15 28L3 21.5V8.5L15 2Z" fill="url(#lg)"/>
          <path d="M15 9L20 12V18L15 21L10 18V12L15 9Z" fill="white" fill-opacity="0.9"/>
          <defs>
            <linearGradient id="lg" x1="3" y1="2" x2="27" y2="28" gradientUnits="userSpaceOnUse">
              <stop stop-color="#4F46E5"/>
              <stop offset="1" stop-color="#14B8A6"/>
            </linearGradient>
          </defs>
        </svg>
      </span>
      SkillConnect
    </a>

      <nav class="main-nav" aria-label="Primary">
        <a href="{{ route('home') }}" style="color: white; font-weight: bold;">Home</a>
        <a href="{{ route('about') }}" style="color: white; font-weight: bold">About</a>
        <a href="{{ route('events') }}" style="color: white; font-weight: bold;">events</a>
        <a href="{{ route('FAQs') }}" style="color: white; font-weight: bold;">FAQs</a>
        <a href="{{ route('members') }}" style="color: white; font-weight: bold;">How to be a Member</a>
        <a href="{{ route('contact') }}" style="color: white; font-weight: bold;">Contact</a>

    <div class="header-actions">
      <!-- Login button opens the modal -->
      <button id="loginBtn" class="btn btn-ghost" style="background:none;border:none;cursor:pointer;font-weight:600;font-size:1rem;">Login</button>
      <a href="{{ route('registration') }}" class="btn btn-primary">Membership</a>
    </div>

    <button class="nav-toggle" id="navToggle" aria-label="Toggle menu" aria-expanded="false">
      <span></span><span></span><span></span>
    </button>
  </div>
</header>

<!-- ===== LOGIN MODAL (from provided code) ===== -->
<div class="login-modal-overlay" id="loginModal">
  <div class="login-modal">
    <!-- Close Button -->
    <button class="modal-close" id="modalCloseBtn">
      <svg viewBox="0 0 24 24" width="24" height="24">
        <line x1="18" y1="6" x2="6" y2="18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
        <line x1="6" y1="6" x2="18" y2="18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
      </svg>
    </button>

    <div class="login-modal-container">
      <!-- Left Side - Branding -->
      <div class="login-modal-branding">
        <div class="branding-content">
          <div class="brand-logo">
            <svg viewBox="0 0 24 24" width="40" height="40">
              <path d="M12 2l2.4 7.2H22l-6 4.6 2.3 7.2-6.3-4.6-6.3 4.6 2.3-7.2-6-4.6h7.6z" fill="white" stroke="none"/>
            </svg>
            <span>Premium</span>
          </div>
          <h2>Welcome Back</h2>
          <p class="branding-subtitle">Sign in to continue your professional journey and unlock exclusive opportunities.</p>
          
          <div class="branding-features">
            <div class="feature-item">
              <div class="feature-icon">
                <svg viewBox="0 0 24 24" width="18" height="18">
                  <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" stroke="white" stroke-width="2" fill="none"/>
                  <path d="M22 4L12 14.01l-3-3" stroke="white" stroke-width="2" fill="none"/>
                </svg>
              </div>
              <span>Secure access</span>
            </div>
            <div class="feature-item">
              <div class="feature-icon">
                <svg viewBox="0 0 24 24" width="18" height="18">
                  <circle cx="12" cy="12" r="10" stroke="white" stroke-width="2" fill="none"/>
                  <path d="M12 6v6l4 2" stroke="white" stroke-width="2" fill="none"/>
                </svg>
              </div>
              <span>Real-time updates</span>
            </div>
            <div class="feature-item">
              <div class="feature-icon">
                <svg viewBox="0 0 24 24" width="18" height="18">
                  <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" stroke="white" stroke-width="2" fill="none"/>
                  <circle cx="9" cy="7" r="4" stroke="white" stroke-width="2" fill="none"/>
                  <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" stroke="white" stroke-width="2" fill="none"/>
                </svg>
              </div>
              <span>Connect with leaders</span>
            </div>
          </div>

          <div class="branding-testimonial">
            <div class="testimonial-avatars">
              <img src="https://ui-avatars.com/api/?name=John+Doe&background=4A90D9&color=fff&size=28" alt="User">
              <img src="https://ui-avatars.com/api/?name=Jane+Smith&background=2ECC71&color=fff&size=28" alt="User">
              <img src="https://ui-avatars.com/api/?name=Mike+Johnson&background=F39C12&color=fff&size=28" alt="User">
              <span class="more-users">+2K</span>
            </div>
            <p class="testimonial-text">"Joining this community transformed my career."</p>
            <p class="testimonial-author">— Alex Rivera</p>
          </div>
        </div>
      </div>

      <!-- Right Side - Login Form -->
      <div class="login-modal-form">
        <div class="login-form-wrapper">
          <div class="form-header-login">
            <h3>Sign In</h3>
            <p>Enter your credentials to access your account</p>
          </div>

          @if (session('status'))
            <div class="alert alert-success animate-fadeIn">
              <svg viewBox="0 0 24 24" width="18" height="18">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/>
                <path d="M22 4L12 14.01l-3-3" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/>
              </svg>
              {{ session('status') }}
            </div>
          @endif

          @if ($errors->any())
            <div class="alert alert-error animate-shake">
              <svg viewBox="0 0 24 24" width="18" height="18">
                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"/>
                <path d="M12 8v4M12 16h.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              </svg>
              <div>
                <strong>Please fix the following errors:</strong>
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            </div>
          @endif

          @if (session('error'))
            <div class="alert alert-error animate-shake">
              <svg viewBox="0 0 24 24" width="18" height="18">
                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"/>
                <path d="M12 8v4M12 16h.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              </svg>
              {{ session('error') }}
            </div>
          @endif

          <form method="POST" action="{{ route('do_login') }}" class="login-form">
            @csrf

            <div class="form-group-login">
              <label class="form-label-login">Email Address</label>
              <div class="input-wrapper-login">
                <svg class="input-icon-login" viewBox="0 0 24 24" width="18" height="18">
                  <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" stroke="currentColor" stroke-width="2" fill="none"/>
                  <polyline points="22,6 12,13 2,6" stroke="currentColor" stroke-width="2" fill="none"/>
                </svg>
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="your@email.com" autofocus>
              </div>
              @error('email')
                <span class="error-message-login">{{ $message }}</span>
              @enderror
            </div>

            <div class="form-group-login">
              <label class="form-label-login">Password</label>
              <div class="input-wrapper-login">
                <svg class="input-icon-login" viewBox="0 0 24 24" width="18" height="18">
                  <rect x="3" y="11" width="18" height="11" rx="2" stroke="currentColor" stroke-width="2" fill="none"/>
                  <path d="M7 11V7a5 5 0 0 1 10 0v4" stroke="currentColor" stroke-width="2" fill="none"/>
                </svg>
                <input type="password" name="password" required placeholder="Enter your password">
                <button type="button" class="password-toggle" id="passwordToggle">
                  <svg viewBox="0 0 24 24" width="18" height="18">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="currentColor" stroke-width="2" fill="none"/>
                    <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2" fill="none"/>
                  </svg>
                </button>
              </div>
              @error('password')
                <span class="error-message-login">{{ $message }}</span>
              @enderror
            </div>

            <div class="login-options-login">
              <label class="checkbox-label-login">
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <span class="checkbox-custom-login">
                  <svg viewBox="0 0 24 24" width="12" height="12">
                    <polyline points="20 6 9 17 4 12" stroke="white" stroke-width="3" fill="none" stroke-linecap="round"/>
                  </svg>
                </span>
                <span class="checkbox-text-login">Remember me</span>
              </label>
              <a href="#" class="forgot-link-login">Forgot Password?</a>
            </div>

            <button type="submit" class="login-submit-btn-login">
              <span>Sign In</span>
              <svg viewBox="0 0 24 24" width="18" height="18">
                <path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/>
              </svg>
            </button>

            <div class="login-divider-login">
              <span>Or continue with</span>
            </div>

            <div class="social-login-login">
              <button type="button" class="social-btn-login google">
                <svg viewBox="0 0 24 24" width="18" height="18">
                  <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 0 1-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z" fill="#4285F4"/>
                  <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                  <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                  <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                </svg>
                <span>Google</span>
              </button>
              <button type="button" class="social-btn-login github">
                <svg viewBox="0 0 24 24" width="18" height="18">
                  <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" fill="currentColor"/>
                </svg>
                <span>GitHub</span>
              </button>
            </div>

            <p class="signup-text-login">
              Don't have an account? 
              <a href="{{ route('registration') }}" class="signup-link-login">Create one now</a>
            </p>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  /* ===== Header Styles ===== */
  .site-header {
    background: #fff;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    position: sticky;
    top: 0;
    z-index: 1000;
    padding: 12px 0;
  }
  .header-inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
  }
  .logo {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 1.5rem;
    font-weight: 800;
    color: #1a202c;
    text-decoration: none;
  }
  .logo-mark {
    display: flex;
    align-items: center;
  }
  .main-nav {
    display: flex;
    align-items: center;
    gap: 24px;
  }
  .main-nav a {
    text-decoration: none;
    font-weight: 600;
    color: #2d3748;
    transition: color 0.3s;
  }
  .main-nav a:hover {
    color: #4A90D9;
  }
  .header-actions {
    display: flex;
    align-items: center;
    gap: 12px;
  }
  .btn-ghost {
    background: transparent;
    border: none;
    padding: 8px 16px;
    font-weight: 600;
    color: #2d3748;
    cursor: pointer;
    transition: color 0.3s;
  }
  .btn-ghost:hover {
    color: #4A90D9;
  }
  .btn-primary {
    background: linear-gradient(135deg, #4A90D9, #357ABD);
    color: #fff;
    border: none;
    padding: 10px 24px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
    text-decoration: none;
    display: inline-block;
  }
  .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(74,144,217,0.3);
  }
  .nav-toggle {
    display: none;
    flex-direction: column;
    gap: 5px;
    background: none;
    border: none;
    cursor: pointer;
    padding: 4px;
  }
  .nav-toggle span {
    width: 25px;
    height: 3px;
    background: #2d3748;
    border-radius: 2px;
    transition: 0.3s;
  }

  /* Responsive header */
  @media (max-width: 1024px) {
    .main-nav {
      gap: 16px;
      flex-wrap: wrap;
    }
    .main-nav a {
      font-size: 0.9rem;
    }
  }
  @media (max-width: 768px) {
    .main-nav {
      display: none;
      position: absolute;
      top: 70px;
      left: 0;
      right: 0;
      background: white;
      flex-direction: column;
      padding: 20px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
      border-radius: 0 0 12px 12px;
      gap: 12px;
    }
    .main-nav.open {
      display: flex;
    }
    .nav-toggle {
      display: flex;
    }
    .header-actions .btn-ghost {
      padding: 6px 12px;
      font-size: 0.9rem;
    }
    .header-actions .btn-primary {
      padding: 6px 16px;
      font-size: 0.9rem;
    }
  }
  @media (max-width: 480px) {
    .header-inner {
      flex-wrap: wrap;
      gap: 10px;
    }
    .logo {
      font-size: 1.2rem;
    }
    .header-actions {
      gap: 8px;
    }
  }

  /* ===== Login Modal Styles ===== */
  .login-modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(8px);
    z-index: 9999;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 20px;
    animation: fadeInModal 0.3s ease;
  }
  .login-modal-overlay.visible {
    display: flex;
  }
  @keyframes fadeInModal {
    from { opacity: 0; }
    to { opacity: 1; }
  }
  .login-modal {
    background: white;
    border-radius: 24px;
    max-width: 900px;
    width: 100%;
    max-height: 90vh;
    overflow-y: auto;
    position: relative;
    animation: slideUpModal 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 40px 100px rgba(0, 0, 0, 0.3);
  }
  @keyframes slideUpModal {
    from { opacity: 0; transform: translateY(30px) scale(0.95); }
    to { opacity: 1; transform: translateY(0) scale(1); }
  }
  .modal-close {
    position: absolute;
    top: 16px;
    right: 16px;
    background: rgba(255,255,255,0.9);
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    color: #2d3748;
    z-index: 10;
    box-shadow: 0 2px 12px rgba(0,0,0,0.1);
  }
  .modal-close:hover {
    background: #F4F3F8;
    transform: rotate(90deg);
  }
  .login-modal-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    min-height: 500px;
  }
  .login-modal-branding {
    background: linear-gradient(135deg, #2d3748 0%, #1a202c 100%);
    padding: 40px 36px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    position: relative;
    overflow: hidden;
    border-radius: 24px 0 0 24px;
  }
  .login-modal-branding::before {
    content: '';
    position: absolute;
    top: -30%;
    right: -30%;
    width: 400px;
    height: 400px;
    background: radial-gradient(circle, rgba(74, 144, 217, 0.15), transparent 70%);
    border-radius: 50%;
    pointer-events: none;
  }
  .login-modal-branding .branding-content {
    position: relative;
    z-index: 1;
  }
  .login-modal-branding .brand-logo {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 32px;
  }
  .login-modal-branding .brand-logo span {
    font-size: 22px;
    font-weight: 800;
    color: white;
  }
  .login-modal-branding h2 {
    font-size: 32px;
    font-weight: 800;
    color: white;
    margin: 0 0 8px;
  }
  .login-modal-branding .branding-subtitle {
    font-size: 15px;
    color: rgba(255,255,255,0.7);
    line-height: 1.6;
    margin: 0 0 30px;
  }
  .login-modal-branding .branding-features {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-bottom: 30px;
  }
  .login-modal-branding .feature-item {
    display: flex;
    align-items: center;
    gap: 12px;
    color: rgba(255,255,255,0.8);
    font-size: 14px;
    font-weight: 500;
  }
  .login-modal-branding .feature-icon {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(8px);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    border: 1px solid rgba(255,255,255,0.08);
  }
  .login-modal-branding .branding-testimonial {
    background: rgba(255,255,255,0.06);
    backdrop-filter: blur(8px);
    border-radius: 12px;
    padding: 18px 20px;
    border: 1px solid rgba(255,255,255,0.08);
  }
  .login-modal-branding .testimonial-avatars {
    display: flex;
    align-items: center;
    gap: 4px;
    margin-bottom: 8px;
  }
  .login-modal-branding .testimonial-avatars img {
    border-radius: 50%;
    border: 2px solid rgba(255,255,255,0.2);
    width: 28px;
    height: 28px;
  }
  .login-modal-branding .more-users {
    font-size: 12px;
    font-weight: 600;
    color: rgba(255,255,255,0.6);
    margin-left: 6px;
  }
  .login-modal-branding .testimonial-text {
    font-size: 14px;
    color: rgba(255,255,255,0.85);
    line-height: 1.5;
    margin: 0 0 4px;
    font-style: italic;
  }
  .login-modal-branding .testimonial-author {
    font-size: 12px;
    color: rgba(255,255,255,0.5);
    margin: 0;
    font-weight: 500;
  }
  .login-modal-form {
    padding: 40px 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: white;
    border-radius: 0 24px 24px 0;
  }
  .login-modal-form .login-form-wrapper {
    width: 100%;
    max-width: 380px;
  }
  .login-modal-form .form-header-login {
    margin-bottom: 24px;
  }
  .login-modal-form .form-header-login h3 {
    font-size: 24px;
    font-weight: 800;
    color: #2d3748;
    margin: 0 0 4px;
  }
  .login-modal-form .form-header-login p {
    font-size: 14px;
    color: #6c757d;
    margin: 0;
  }
  .login-modal-form .form-group-login {
    display: flex;
    flex-direction: column;
    gap: 4px;
    margin-bottom: 16px;
  }
  .login-modal-form .form-label-login {
    font-size: 13px;
    font-weight: 600;
    color: #2d3748;
  }
  .login-modal-form .input-wrapper-login {
    position: relative;
  }
  .login-modal-form .input-icon-login {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #9891ab;
    pointer-events: none;
  }
  .login-modal-form .input-wrapper-login input {
    width: 100%;
    padding: 12px 12px 12px 42px;
    border: 2px solid #E3E1EC;
    border-radius: 10px;
    font-size: 14px;
    font-family: inherit;
    color: #2d3748;
    background: #FAFAFC;
    transition: all 0.3s ease;
    outline: none;
  }
  .login-modal-form .input-wrapper-login input:focus {
    border-color: #4A90D9;
    background: white;
    box-shadow: 0 0 0 4px rgba(74, 144, 217, 0.1);
  }
  .login-modal-form .password-toggle {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #9891ab;
    cursor: pointer;
    padding: 4px;
  }
  .login-modal-form .error-message-login {
    font-size: 12px;
    color: #E74C3C;
    margin-top: 4px;
  }
  .login-modal-form .login-options-login {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin: 4px 0 20px;
  }
  .login-modal-form .checkbox-label-login {
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
  }
  .login-modal-form .checkbox-label-login input[type="checkbox"] {
    display: none;
  }
  .login-modal-form .checkbox-custom-login {
    width: 18px;
    height: 18px;
    border: 2px solid #D2CEE0;
    border-radius: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    transition: all 0.3s ease;
  }
  .login-modal-form .checkbox-custom-login svg {
    opacity: 0;
    transform: scale(0);
    transition: all 0.3s ease;
  }
  .login-modal-form .checkbox-label-login input:checked + .checkbox-custom-login {
    background: #4A90D9;
    border-color: #4A90D9;
  }
  .login-modal-form .checkbox-label-login input:checked + .checkbox-custom-login svg {
    opacity: 1;
    transform: scale(1);
  }
  .login-modal-form .checkbox-text-login {
    font-size: 13px;
    color: #6c757d;
  }
  .login-modal-form .forgot-link-login {
    font-size: 13px;
    font-weight: 600;
    color: #4A90D9;
    text-decoration: none;
  }
  .login-modal-form .forgot-link-login:hover {
    color: #2d3748;
    text-decoration: underline;
  }
  .login-modal-form .login-submit-btn-login {
    width: 100%;
    padding: 14px;
    font-size: 15px;
    font-weight: 700;
    font-family: inherit;
    border-radius: 10px;
    background: linear-gradient(135deg, #4A90D9, #357ABD);
    color: white;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    margin-bottom: 20px;
  }
  .login-modal-form .login-submit-btn-login:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(74, 144, 217, 0.3);
  }
  .login-modal-form .login-divider-login {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 16px;
  }
  .login-modal-form .login-divider-login::before,
  .login-modal-form .login-divider-login::after {
    content: '';
    flex: 1;
    height: 1px;
    background: #E3E1EC;
  }
  .login-modal-form .login-divider-login span {
    font-size: 12px;
    color: #9891ab;
    font-weight: 500;
  }
  .login-modal-form .social-login-login {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
  }
  .login-modal-form .social-btn-login {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 12px;
    border-radius: 10px;
    border: 2px solid #E3E1EC;
    background: white;
    font-size: 14px;
    font-weight: 600;
    color: #2d3748;
    cursor: pointer;
    transition: all 0.3s ease;
    font-family: inherit;
  }
  .login-modal-form .social-btn-login:hover {
    border-color: #D2CEE0;
    background: #FAFAFC;
  }
  .login-modal-form .signup-text-login {
    text-align: center;
    font-size: 14px;
    color: #6c757d;
    margin: 0;
  }
  .login-modal-form .signup-link-login {
    background: none;
    border: none;
    font-weight: 700;
    color: #4A90D9;
    cursor: pointer;
    font-size: 14px;
    padding: 0;
    text-decoration: none;
  }
  .login-modal-form .signup-link-login:hover {
    color: #2d3748;
    text-decoration: underline;
  }
  .login-modal-form .alert {
    padding: 12px 14px;
    border-radius: 10px;
    margin-bottom: 16px;
    display: flex;
    align-items: flex-start;
    gap: 10px;
    font-size: 13px;
  }
  .login-modal-form .alert-success {
    background: #E8F3EC;
    color: #24603C;
    border: 1px solid #BFE3CA;
  }
  .login-modal-form .alert-error {
    background: #FBEAEF;
    color: #B4425C;
    border: 1px solid #F1C6D2;
  }
  .login-modal-form .alert svg {
    flex-shrink: 0;
    margin-top: 2px;
    stroke: currentColor;
  }
  .login-modal-form .alert ul {
    margin: 6px 0 0;
    padding-left: 18px;
  }

  @media (max-width: 1024px) {
    .login-modal-container {
      grid-template-columns: 1fr;
      min-height: auto;
    }
    .login-modal-branding {
      border-radius: 24px 24px 0 0;
      padding: 32px 28px;
    }
    .login-modal-form {
      border-radius: 0 0 24px 24px;
      padding: 32px 28px;
    }
    .login-modal {
      max-width: 500px;
    }
  }
  @media (max-width: 768px) {
    .login-modal {
      max-width: 100%;
      margin: 10px;
      max-height: 95vh;
    }
    .login-modal-branding {
      padding: 24px 20px;
    }
    .login-modal-branding h2 {
      font-size: 24px;
    }
    .login-modal-form {
      padding: 24px 20px;
    }
    .login-modal-form .social-login-login {
      flex-direction: column;
    }
    .login-modal-form .login-options-login {
      flex-direction: column;
      align-items: flex-start;
      gap: 8px;
    }
  }
  @media (max-width: 480px) {
    .login-modal-branding {
      padding: 20px 16px;
    }
    .login-modal-branding h2 {
      font-size: 22px;
    }
    .login-modal-form {
      padding: 20px 16px;
    }
    .modal-close {
      width: 34px;
      height: 34px;
      top: 12px;
      right: 12px;
    }
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Toggle mobile nav
    const navToggle = document.getElementById('navToggle');
    const mainNav = document.querySelector('.main-nav');
    if (navToggle && mainNav) {
      navToggle.addEventListener('click', function() {
        const expanded = this.getAttribute('aria-expanded') === 'true' ? false : true;
        this.setAttribute('aria-expanded', expanded);
        mainNav.classList.toggle('open');
      });
    }

    // Login Modal Elements
const loginModal = document.getElementById('loginModal');
const loginTriggers = document.querySelectorAll('[data-login-trigger]');
const modalCloseBtn = document.getElementById('modalCloseBtn');

 function showLoginModal() {
  if (loginModal) {
    loginModal.classList.add('visible');
    loginModal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
    setTimeout(() => {
      const emailInput = loginModal.querySelector('input[name="email"]');
      if (emailInput) emailInput.focus();
    }, 400);
  }
}

function hideLoginModal() {
  if (loginModal) {
    loginModal.classList.remove('visible');
    loginModal.style.display = 'none';
    document.body.style.overflow = 'auto';
  }
}
  
loginTriggers.forEach(function(trigger) {
  trigger.addEventListener('click', function(e) {
    e.preventDefault();
    showLoginModal();
  });
});

if (loginBtn) {
      loginBtn.addEventListener('click', function(e) {
        e.preventDefault();
        showLoginModal();
      });
    }

    if (modalCloseBtn) {
      modalCloseBtn.addEventListener('click', hideLoginModal);
    }

    if (loginModal) {
      loginModal.addEventListener('click', function(e) {
        if (e.target === this) hideLoginModal();
      });
    }

    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape' && loginModal && loginModal.classList.contains('visible')) {
        hideLoginModal();
      }
    });

    // Password toggle
    const passwordToggle = document.getElementById('passwordToggle');
    if (passwordToggle) {
      passwordToggle.addEventListener('click', function() {
        const passwordInput = this.closest('.input-wrapper-login').querySelector('input[type="password"]');
        if (passwordInput) {
          if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            this.innerHTML = `
              <svg viewBox="0 0 24 24" width="18" height="18">
                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/>
                <line x1="1" y1="1" x2="23" y2="23" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              </svg>
            `;
          } else {
            passwordInput.type = 'password';
            this.innerHTML = `
              <svg viewBox="0 0 24 24" width="18" height="18">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="currentColor" stroke-width="2" fill="none"/>
                <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2" fill="none"/>
              </svg>
            `;
          }
        }
      });
    }

    // Check for errors to show modal if login errors exist
    const hasErrors = document.querySelector('.alert-error');
    if (hasErrors && loginModal && loginModal.querySelector('.alert-error')) {
      showLoginModal();
    }

    const hasStatus = document.querySelector('.alert-success');
    if (hasStatus && loginModal && loginModal.querySelector('.alert-success')) {
      showLoginModal();
    }
    @if (session('open_login_modal'))
      showLoginModal();
    @endif
  });
</script>
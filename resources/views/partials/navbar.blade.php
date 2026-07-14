  <!-- Header -->
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

      </nav>

      <div class="header-actions">
        <a href="#login" class="btn btn-ghost">Login</a>
        <a href="{{ route('registration') }}" class="btn btn-primary">Membership</a>
      </div>

      <button class="nav-toggle" id="navToggle" aria-label="Toggle menu" aria-expanded="false">
        <span></span><span></span><span></span>
      </button>
    </div>
  </header>
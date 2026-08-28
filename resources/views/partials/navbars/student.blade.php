<!-- Tech Leaders Network Site Header (Student Portal) -->

<header class="site-header pt-1">
    <!-- ROW 1: Logo / Actions -->
    <div class="container header-top pb-2 pt-1">
        <a href="{{ route('dashboard') }}" class="logo">
            <span class="logo-mark" aria-hidden="true">
                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15 2L27 8.5V21.5L15 28L3 21.5V8.5L15 2Z" fill="url(#lg)" />
                    <path d="M15 9L20 12V18L15 21L10 18V12L15 9Z" fill="white" fill-opacity="0.9" />
                    <defs>
                        <linearGradient id="lg" x1="3" y1="2" x2="27" y2="28" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#4F46E5" />
                            <stop offset="1" stop-color="#2080D4" />
                        </linearGradient>
                    </defs>
                </svg>
            </span>
            <span class="logo-text">
                Tech Leaders Network
                <small>Student Portal</small>
            </span>
        </a>

        <div class="header-actions">
            <a href="{{ route('employee.legal-help.index') }}#messages-section" class="action-item">
                <i class="fa-regular fa-comment-dots"></i>
                <span>Legal help</span>
            </a>

            <a href="#" class="action-item">
                <i class="fa-regular fa-bell"></i>
                <span>Notifications</span>
                <span class="pill-badge">12</span>
            </a>

            <div class="settings-menu-wrap">
                <button class="settings-top-btn" id="settingsTopBtn" type="button">
                    <span class="settings-icon-circle">
                        <i class="fa-solid fa-gear"></i>
                    </span>
                    <span class="settings-top-label">Settings</span>
                    <i class="fa-solid fa-chevron-down arrow" id="settingsTopArrow"></i>
                </button>

                <div class="settings-top-dropdown" id="settingsTopDropdown">
                    <a href="{{ route('profile') }}" class="settings-menu-item profile">
                        <i class="fa-solid fa-user"></i>
                        <span>My Profile</span>
                    </a>

                    <form method="POST" action="{{ route('membership-logout') }}">
                        @csrf
                        <button type="submit" class="settings-menu-item logout">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>

            <button class="nav-toggle" id="navToggle" type="button" aria-label="Toggle navigation" aria-expanded="false">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>

    <!-- ROW 2: Icon nav -->
    <div class="container header-bottom">
        <nav class="main-nav" id="mainNav" aria-label="Primary">
            <a href="{{ route('student.dashboard') }}"
               class="{{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-house"></i> Home
            </a>

            <a href="{{ route('student.mentorship.index') }}"
               class="{{ request()->routeIs('student.mentorship.*') || request()->routeIs('student.mentors.*') ? 'active' : '' }}">
                <i class="fa-solid fa-user-group"></i> My Mentorship
            </a>

            <a href="{{ route('student.sessions.upcoming') }}"
               class="{{ request()->routeIs('student.sessions.*') ? 'active' : '' }}">
                <i class="fa-solid fa-calendar-days"></i> My Sessions
            </a>

           <a href="{{ route('student.resume-review.index') }}"
   class="{{ request()->routeIs('student.resume-review.*') ? 'active' : '' }}">
    <i class="fa-solid fa-file-lines"></i> Resume Reviews
</a>

           <a href="{{ route('student.webinars.index') }}"
   class="{{ request()->routeIs('student.webinars.*') ? 'active' : '' }}">
    <i class="fa-solid fa-video"></i> Webinars
</a>

            <a href="" class="">
                <i class="fa-solid fa-graduation-cap"></i>
                Training
            </a>

            <a href="" class="">
                <i class="fa-solid fa-comments"></i> Mock Interviews
            </a>
        </nav>
    </div>
</header>

<style>
    .site-header{background:#F7F9FF;box-shadow:0 2px 20px rgba(0,0,0,.06);position:sticky;top:0;z-index:1000;font-family:"Inter","Segoe UI",system-ui,-apple-system,sans-serif;border-bottom:1px solid rgba(0,0,0,.06);padding-bottom:0;}
    .site-header .container{max-width:1440px;width:100%;margin:0 auto;padding:0 32px;}
    .header-top{max-width:1650px;width:100%;margin:0 auto;display:flex;align-items:center;gap:36px;padding:26px 40px;box-sizing:border-box;}
    .logo{display:flex;align-items:center;gap:12px;text-decoration:none;flex-shrink:0;}
    .logo-text{display:flex;flex-direction:column;line-height:1.15;font-size:1.3rem;font-weight:700;color:#1f2937;letter-spacing:-.3px;}
    .logo-text small{font-size:.72rem;font-weight:500;color:#3b404b;letter-spacing:.2px;}
    .header-actions{display:flex;align-items:center;gap:34px;flex-shrink:0;margin-left:auto;}
    .action-item{position:relative;display:flex;align-items:center;gap:9px;text-decoration:none;color:#374151;font-size:.87rem;font-weight:500;}
    .action-item i{font-size:17px;color:#4b5563;}
    .action-item:hover{color:#3364d7;}
    .action-item:hover i{color:#3364d7;}
    .pill-badge{position:absolute;top:-8px;right:-14px;background:#3364d7;color:#fff;font-size:.65rem;font-weight:700;min-width:16px;height:16px;border-radius:50px;display:flex;align-items:center;justify-content:center;padding:0 4px;}
    .settings-menu-wrap{position:relative;}
    .settings-top-btn{display:flex;align-items:center;gap:10px;border:none;background:transparent;cursor:pointer;padding:4px;font-family:inherit;}
    .settings-icon-circle{width:42px;height:42px;border-radius:50%;background:#3364d7;display:flex;align-items:center;justify-content:center;color:#fff;font-size:16px;flex-shrink:0;}
    .settings-top-label{font-weight:600;font-size:.9rem;color:#111827;white-space:nowrap;}
    .settings-top-btn .arrow{font-size:11px;color:#9ca3af;margin-left:2px;transition:transform .25s ease;}
    .settings-top-btn.open .arrow{transform:rotate(180deg);}
    .settings-top-dropdown{position:absolute;right:0;top:calc(100% + 12px);width:200px;background:#fff;border-radius:14px;box-shadow:0 20px 50px rgba(0,0,0,.18);display:none;overflow:hidden;z-index:999;border:1px solid rgba(0,0,0,.08);animation:slideDown .25s ease;}
    @keyframes slideDown{from{opacity:0;transform:translateY(-8px);}to{opacity:1;transform:translateY(0);}}
    .settings-top-dropdown.show{display:block;}
    .settings-menu-item{display:flex;align-items:center;gap:10px;width:100%;padding:12px 18px;text-decoration:none;color:#111827;background:none;border:none;text-align:left;cursor:pointer;font-size:.87rem;font-weight:500;font-family:inherit;transition:background .2s ease;}
    .settings-menu-item i{width:16px;text-align:center;color:#6b7280;font-size:14px;}
    .settings-menu-item:hover{background:rgba(0,0,0,.04);}
    .settings-menu-item.profile{color:#1e3a8a;}
    .settings-menu-item.profile i{color:#1e3a8a;opacity:.85;}
    .settings-menu-item.logout{color:#dc2626;border-top:1px solid rgba(0,0,0,.06);}
    .settings-menu-item.logout i{color:#dc2626;opacity:.75;}
    .settings-menu-item.logout:hover{background:rgba(220,38,38,.06);}
    .header-bottom{background:linear-gradient(90deg,#2f57c9,#3364d7);padding:0 32px;box-shadow:inset 0 -1px 0 rgba(255,255,255,.08);position:relative;margin-bottom:0;}
    .header-bottom .container{display:flex;justify-content:center;}
    .main-nav{display:flex;align-items:center;justify-content:center;gap:10px;flex-wrap:wrap;}
    .main-nav>a{display:flex;align-items:center;gap:7px;text-decoration:none;font-weight:500;font-size:.85rem;color:rgba(255,255,255,.82);padding:12px 16px;margin:8px 0;white-space:nowrap;position:relative;border-radius:8px;transition:background .2s ease,color .2s ease;}
    .main-nav>a i{font-size:13px;color:rgba(255,255,255,.65);}
    .main-nav>a:hover{color:#fff;background:rgba(255,255,255,.14);}
    .main-nav>a:hover i{color:#fff;}
    .main-nav>a.active{color:#1f2937;font-weight:600;background:#fff;}
    .main-nav>a.active i{color:#3364d7;}
    .nav-toggle{display:none;flex-direction:column;gap:5px;background:none;border:none;cursor:pointer;padding:4px;}
    .nav-toggle span{width:22px;height:2px;background:#374151;border-radius:2px;}
    @media (max-width:900px){.action-item span:not(.pill-badge){display:none;}.settings-top-label{display:none;}.header-actions{gap:16px;}}
    @media (max-width:768px){.header-top{flex-wrap:wrap;gap:16px;padding:18px 32px;}.nav-toggle{display:flex;}.header-bottom{display:none;}.header-bottom.open{display:block;}.header-bottom .container{display:block;}.main-nav{flex-direction:column;align-items:stretch;justify-content:flex-start;gap:2px;padding:10px 0;}.main-nav>a{width:100%;}}
    @media (max-width:480px){.header-top{padding:14px 16px;gap:12px;}.logo-text{font-size:1.1rem;}}
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const settingsTopBtn = document.getElementById('settingsTopBtn');
        const settingsTopDropdown = document.getElementById('settingsTopDropdown');
        const navToggle = document.getElementById('navToggle');
        const headerBottom = document.querySelector('.header-bottom');

        settingsTopBtn?.addEventListener('click', function (e) {
            e.stopPropagation();
            settingsTopDropdown.classList.toggle('show');
            settingsTopBtn.classList.toggle('open');
        });

        document.addEventListener('click', function (e) {
            if (!settingsTopDropdown?.contains(e.target) && !settingsTopBtn?.contains(e.target)) {
                settingsTopDropdown?.classList.remove('show');
                settingsTopBtn?.classList.remove('open');
            }
        });

        navToggle?.addEventListener('click', function () {
            const isOpen = headerBottom.classList.toggle('open');
            navToggle.setAttribute('aria-expanded', isOpen);
        });
    });
</script>

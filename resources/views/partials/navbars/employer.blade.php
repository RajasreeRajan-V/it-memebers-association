<!-- Tech Leaders Network Employer Header — two-row style, employer routes/content kept -->

<header class="site-header pt-1">
    <!-- ROW 1: Logo / Search / Actions -->
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
                <small>Employer Portal</small>
            </span>
        </a>



        
        

        <div class="header-actions">
            <a href="#" class="action-item">
                <i class="fa-regular fa-bell"></i>
                <span>Notifications</span>
                <span class="pill-badge">12</span>
            </a>

            <a href="{{ route('employer.articles.index') }}" class="action-item">
              <i class="fa-solid fa-file-lines"></i>
                <span>View Articles</span>
            </a>

            <!-- Settings dropdown: My Profile, Logout -->
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
        </div>

        <button class="nav-toggle" id="navToggle" aria-label="Toggle menu" aria-expanded="false">
            <span></span><span></span><span></span>
        </button>
    </div>

    <!-- ROW 2: Icon nav (employer routes, with dropdowns) -->
    <div class="container header-bottom">
        <nav class="main-nav" id="mainNav" aria-label="Primary">
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-house"></i> Home
            </a>

            <div class="dropdown">
                <a href="{{ route('employer.jobs.index') }}" class="{{ request()->routeIs('employer.jobs.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-briefcase"></i> Jobs
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('employer.jobs.create') }}"><i class="fa-solid fa-plus"></i> Create Job</a></li>
                    <li><a href="{{ route('employer.jobs.index') }}"><i class="fa-solid fa-list"></i> View Jobs</a></li>
                </ul>
            </div>

            <div class="dropdown">
                <a href="{{ route('employer.internships.index') }}" class="{{ request()->routeIs('employer.internships.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-user-graduate"></i> Internships
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('employer.internships.create') }}"><i class="fa-solid fa-plus"></i> Create Internship</a></li>
                    <li><a href="{{ route('employer.internships.index') }}"><i class="fa-solid fa-list"></i> View Internships</a></li>
                </ul>
            </div>

            <div class="dropdown">
                <a href="{{ route('employer.projects.index') }}" class="{{ request()->routeIs('employer.projects.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-diagram-project"></i> Projects
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('employer.projects.create') }}"><i class="fa-solid fa-plus"></i> Create Project</a></li>
                    <li><a href="{{ route('employer.projects.index') }}"><i class="fa-solid fa-list"></i> View Projects</a></li>
                </ul>
            </div>

            <div class="dropdown">
                <a href="{{ route('employer.startup-profile.index') }}" class="{{ request()->routeIs('employer.startup-profile.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-rocket"></i> Startup
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('employer.startup-profile.create') }}"><i class="fa-solid fa-plus"></i> Create Startup</a></li>
                    <li><a href="{{ route('employer.startup-profile.index') }}"><i class="fa-solid fa-list"></i> View Startups</a></li>
                </ul>
            </div>

            <a href="{{ route('employer.applicants.index') }}" class="{{ request()->routeIs('employer.applicants.*') ? 'active' : '' }}">
                <i class="fa-solid fa-users"></i> Applicants
            </a>
        </nav>
    </div>
</header>

<style>
    /* ===== Base ===== */
    .site-header {
        background: #F7F9FF;
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.06);
        position: sticky;
        top: 0;
        z-index: 1000;
        font-family: "Inter", "Segoe UI", system-ui, -apple-system, sans-serif;
        border-bottom: 1px solid rgba(0, 0, 0, 0.06);
        padding-bottom: 0;
    }

    .site-header .container {
        max-width: 1440px;
        width: 100%;
        margin: 0 auto;
        padding: 0 32px;
    }

    /* ===== Row 1 ===== */
    .header-top {
        max-width: 1650px;
        width: 100%;
        margin: 0 auto;
        display: flex;
        align-items: center;
        gap: 36px;
        padding: 26px 40px;
        box-sizing: border-box;
    }

    .logo {
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
        flex-shrink: 0;
    }

    .logo-text {
        display: flex;
        flex-direction: column;
        line-height: 1.15;
        font-size: 1.3rem;
        font-weight: 700;
        color: #1d2837;
        letter-spacing: -0.3px;
    }

    .logo-text small {
        font-size: 0.72rem;
        font-weight: 500;
        color: #353a44;
        letter-spacing: 0.2px;
    }

    .header-search {
        flex: 0 1 460px;
        display: flex;
        align-items: center;
        gap: 10px;
        background: #f3f4f6;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 8px 14px;
        transition: border-color 0.2s ease;
    }

    .header-search:focus-within {
        border-color: #3364d7;
        background: #ffffff;
    }

    .header-search i { color: #9ca3af; font-size: 13px; }

    .header-search input {
        border: none;
        outline: none;
        background: transparent;
        width: 100%;
        font-size: 0.8rem;
        color: #111827;
    }

    .header-search input::placeholder { color: #9ca3af; }

    .header-actions {
        display: flex;
        align-items: center;
        gap: 34px;
        flex-shrink: 0;
        margin-left: auto;
    }

    .action-item {
        position: relative;
        display: flex;
        align-items: center;
        gap: 9px;
        text-decoration: none;
        color: #374151;
        font-size: 0.87rem;
        font-weight: 500;
    }

    .action-item i { font-size: 17px; color: #4b5563; }
    .action-item:hover { color: #3364d7; }
    .action-item:hover i { color: #3364d7; }

    .pill-badge {
        position: absolute;
        top: -8px;
        right: -14px;
        background: #3364d7;
        color: #fff;
        font-size: 0.65rem;
        font-weight: 700;
        min-width: 16px;
        height: 16px;
        border-radius: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 4px;
    }

    /* ===== Settings (row 1) ===== */
    .settings-menu-wrap { position: relative; }

    .settings-top-btn {
        display: flex;
        align-items: center;
        gap: 10px;
        border: none;
        background: transparent;
        cursor: pointer;
        padding: 4px;
        font-family: inherit;
    }

    .settings-icon-circle {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: #3364d7;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 16px;
        flex-shrink: 0;
    }

    .settings-top-label {
        font-weight: 600;
        font-size: 0.9rem;
        color: #111827;
        white-space: nowrap;
    }

    .settings-top-btn .arrow {
        font-size: 11px;
        color: #9ca3af;
        margin-left: 2px;
        transition: transform 0.25s ease;
    }

    .settings-top-btn.open .arrow { transform: rotate(180deg); }

    .settings-top-dropdown {
        position: absolute;
        right: 0;
        top: calc(100% + 12px);
        width: 200px;
        background: #ffffff;
        border-radius: 14px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.18);
        display: none;
        overflow: hidden;
        z-index: 999;
        border: 1px solid rgba(0, 0, 0, 0.08);
        animation: slideDown 0.25s ease;
    }

    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-8px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .settings-top-dropdown.show { display: block; }

    .settings-menu-item {
        display: flex;
        align-items: center;
        gap: 10px;
        width: 100%;
        padding: 12px 18px;
        text-decoration: none;
        color: #111827;
        background: none;
        border: none;
        text-align: left;
        cursor: pointer;
        font-size: 0.87rem;
        font-weight: 500;
        font-family: inherit;
        transition: background 0.2s ease;
    }

    .settings-menu-item i { width: 16px; text-align: center; color: #6b7280; font-size: 14px; }
    .settings-menu-item:hover { background: rgba(0, 0, 0, 0.04); }

    .settings-menu-item.profile { color: #1e3a8a; }
    .settings-menu-item.profile i { color: #1e3a8a; opacity: 0.85; }
    .settings-menu-item.profile:hover { color: #1e3a8a; background: rgba(0, 0, 0, 0.04); }
    .settings-menu-item.profile:hover i { color: #1e3a8a; opacity: 1; }

    .settings-menu-item.logout { color: #dc2626; border-top: 1px solid rgba(0, 0, 0, 0.06); }
    .settings-menu-item.logout i { color: #dc2626; opacity: 0.75; }
    .settings-menu-item.logout:hover { background: rgba(220, 38, 38, 0.06); }
    .settings-menu-item.logout:hover i { opacity: 1; }

    /* ===== Row 2: BLUE bar, CENTERED =====
       FIX: this section had a cramped look because gaps and link padding
       were too tight, and the caret sat almost flush against the label.
       Widened gaps/padding and gave the bar a bit more vertical breathing
       room below. */
    .header-bottom {
        background: linear-gradient(90deg, #2f57c9, #3364d7);
        padding: 6px 32px;
        box-shadow: inset 0 -1px 0 rgba(255, 255, 255, 0.08);
        position: relative;
        margin-bottom: 0;
    }

    .header-bottom .container {
        display: flex;
        justify-content: center;
    }

    .main-nav {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 24px;               /* was 10px — more room between each nav item */
        flex-wrap: wrap;
    }

    .main-nav > a {
        display: flex;
        align-items: center;
        gap: 9px;                 /* was 7px — a touch more space between icon and label */
        text-decoration: none;
        font-weight: 500;
        font-size: 0.88rem;       /* was 0.85rem */
        color: rgba(255, 255, 255, 0.82);
        padding: 13px 18px;       /* was 12px 16px */
        margin: 8px 0;
        white-space: nowrap;
        position: relative;
        border-radius: 8px;
        transition: background 0.2s ease, color 0.2s ease;
    }


    .main-nav > a i { font-size: 13px; color: rgba(255, 255, 255, 0.65); }

    .main-nav > a:hover {
        color: #ffffff;
        background: rgba(255, 255, 255, 0.14);
    }

    .main-nav > a:hover i { color: #ffffff; }

    .main-nav > a.active {
        color: #ffffff;
        font-weight: 600;
        background: rgba(255, 255, 255, 0.18);
    }

    .main-nav > a.active i { color: #ffffff; }

    /* ---- Dropdowns inside blue bar (Jobs / Internships / Projects / Startup) ---- */
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        top: calc(100% + 8px);
        left: 50%;
        transform: translateX(-50%);
        min-width: 190px;
        background: #ffffff;
        border: 1px solid #eef0f3;
        border-radius: 10px;
        padding: 6px;
        list-style: none;
        margin: 0;
        box-shadow: 0 12px 28px rgba(17, 24, 39, 0.18);
        overflow: hidden;
        z-index: 1000;
    }

    .dropdown-menu li { margin: 0; }

    .dropdown-menu li a {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 9px 12px;
        color: #374151;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 500;
        border-radius: 6px;
        transition: background 0.15s ease, color 0.15s ease;
    }

    .dropdown-menu li a i { font-size: 12px; color: #9ca3af; }

    .dropdown-menu li a:hover {
        background: #eef2ff;
        color: #3364d7;
    }

    .dropdown-menu li a:hover i { color: #3364d7; }

    .dropdown:hover .dropdown-menu { display: block; }

    .nav-toggle {
        display: none;
        flex-direction: column;
        gap: 5px;
        background: none;
        border: none;
        cursor: pointer;
        padding: 4px;
    }

    .nav-toggle span { width: 22px; height: 2px; background: #374151; border-radius: 2px; }

    /* ===== Responsive ===== */
    @media (max-width: 1100px) {
        .header-search { flex-basis: 340px; }
        .header-actions { gap: 20px; }
        .main-nav { gap: 14px; }   /* keep some breathing room as space tightens */
    }

    @media (max-width: 900px) {
        .action-item span:not(.pill-badge) { display: none; }
        .settings-top-label { display: none; }
        .header-actions { gap: 16px; }
    }

    @media (max-width: 768px) {
        .header-search { display: none; }
        .header-top { flex-wrap: wrap; gap: 16px; padding: 18px 32px; }
        .nav-toggle { display: flex; }
        .header-bottom { display: none; }
        .header-bottom.open { display: block; }
        .header-bottom .container { display: block; }
        .main-nav { flex-direction: column; align-items: stretch; justify-content: flex-start; gap: 2px; padding: 10px 0; }
        .main-nav > a { width: 100%; }

        .dropdown-menu {
            position: static;
            transform: none;
            box-shadow: none;
            border: none;
            background: #274ea3;
            margin-top: 4px;
            display: none;
        }

        .dropdown-menu li a { color: #ffffff; }
        .dropdown-menu li a:hover { background: rgba(255, 255, 255, 0.12); color: #ffffff; }
        .dropdown-menu li a i { color: rgba(255, 255, 255, 0.7); }

        .dropdown.open .dropdown-menu { display: block; }
        .dropdown:hover .dropdown-menu { display: none; } /* disable hover on mobile */
        .dropdown.open .dropdown-menu { display: block; }
    }

    @media (max-width: 480px) {
        .header-top { padding: 14px 16px; gap: 12px; }
        .logo-text { font-size: 1.1rem; }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const settingsTopBtn = document.getElementById('settingsTopBtn');
        const settingsTopDropdown = document.getElementById('settingsTopDropdown');
        const navToggle = document.getElementById('navToggle');
        const headerBottom = document.querySelector('.header-bottom');
        const mainNav = document.getElementById('mainNav');

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

        // On mobile, tapping a dropdown label toggles its submenu instead of navigating
        mainNav?.querySelectorAll('.dropdown > a').forEach(function (link) {
            link.addEventListener('click', function (e) {
                if (window.innerWidth <= 768) {
                    e.preventDefault();
                    this.parentElement.classList.toggle('open');
                }
            });
        });
    });
</script>
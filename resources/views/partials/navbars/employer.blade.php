<header class="site-header">

    {{-- =====================================================
         ROW 1: LOGO / ACTION ICONS
    ====================================================== --}}
    <div class="container header-top">

        <a href="{{ route('dashboard') }}" class="logo">
            <span class="logo-mark" aria-hidden="true">
                <img src="{{ asset('assets/img/logo1.png') }}" alt="Tech Leaders Network Logo">
            </span>
        </a>

        <div class="header-actions">

            {{-- Notifications --}}
            <a href="{{ route('employer.notifications.index') }}"
               class="action-item notification-btn"
               aria-label="Notifications" title="Notifications">
                <i class="fa-regular fa-bell"></i>

                @auth
                    @php
                        $unreadNotificationsCount = \App\Models\EmployerPortalNotification::where('employer_id', auth()->id())
                            ->where('is_read', false)
                            ->count();
                    @endphp

                    @if($unreadNotificationsCount > 0)
                        <span class="pill-badge">
                            {{ $unreadNotificationsCount > 99 ? '99+' : $unreadNotificationsCount }}
                        </span>
                    @endif
                @endauth
            </a>

            {{-- View Articles (pill with label) --}}
            <a href="{{ route('employer.articles.index') }}" class="action-item action-item--label">
                <i class="fa-solid fa-file-lines"></i>
                <span>View Articles</span>
            </a>

            {{-- Settings --}}
            <div class="settings-menu-wrap">
                <button class="settings-top-btn" id="settingsTopBtn" type="button"
                        aria-label="Settings" title="Settings" aria-expanded="false">
                    <span class="settings-icon-circle">
                        <i class="fa-solid fa-gear"></i>
                    </span>
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

            {{-- Mobile menu button --}}
            <button class="nav-toggle" id="navToggle" type="button"
                    aria-label="Toggle navigation" aria-expanded="false">
                <span></span>
                <span></span>
                <span></span>
            </button>

        </div>
    </div>


    {{-- =====================================================
         ROW 2: BLUE NAVIGATION BAR
    ====================================================== --}}
    <div class="header-bottom">
        <div class="container header-bottom-inner">

            <nav class="main-nav" id="mainNav" aria-label="Primary">

                <a href="{{ route('dashboard') }}"
                   class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-house"></i>
                    <span>Home</span>
                </a>

                {{-- Jobs --}}
                <div class="dropdown">
                    <a href="{{ route('employer.jobs.index') }}"
                       class="{{ request()->routeIs('employer.jobs.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-briefcase"></i>
                        <span>Jobs</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('employer.jobs.create') }}"><i class="fa-solid fa-plus"></i> Create Job</a></li>
                        <li><a href="{{ route('employer.jobs.index') }}"><i class="fa-solid fa-list"></i> View Jobs</a></li>
                    </ul>
                </div>

                {{-- Internships --}}
                <div class="dropdown">
                    <a href="{{ route('employer.internships.index') }}"
                       class="{{ request()->routeIs('employer.internships.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-user-graduate"></i>
                        <span>Internships</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('employer.internships.create') }}"><i class="fa-solid fa-plus"></i> Create Internship</a></li>
                        <li><a href="{{ route('employer.internships.index') }}"><i class="fa-solid fa-list"></i> View Internships</a></li>
                    </ul>
                </div>

                {{-- Projects --}}
                <div class="dropdown">
                    <a href="{{ route('employer.projects.index') }}"
                       class="{{ request()->routeIs('employer.projects.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-diagram-project"></i>
                        <span>Projects</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('employer.projects.create') }}"><i class="fa-solid fa-plus"></i> Create Project</a></li>
                        <li><a href="{{ route('employer.projects.index') }}"><i class="fa-solid fa-list"></i> View Projects</a></li>
                    </ul>
                </div>

                {{-- Startup --}}
                <div class="dropdown">
                    <a href="{{ route('employer.startup-profile.index') }}"
                       class="{{ request()->routeIs('employer.startup-profile.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-rocket"></i>
                        <span>Startup</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('employer.startup-profile.create') }}"><i class="fa-solid fa-plus"></i> Create Startup</a></li>
                        <li><a href="{{ route('employer.startup-profile.index') }}"><i class="fa-solid fa-list"></i> View Startups</a></li>
                    </ul>
                </div>

                {{-- Applicants --}}
                <a href="{{ route('employer.applicants.index') }}"
                   class="{{ request()->routeIs('employer.applicants.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-users"></i>
                    <span>Applicants</span>
                </a>

                {{-- Freelancer Bids --}}
                <a href="{{ route('employer.freelancer.bids.index') }}"
                   class="{{ request()->routeIs('employer.freelancer.bids.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-user-check"></i>
                    <span>Freelancer Bids</span>
                </a>

            </nav>

        </div>
    </div>

</header>


<style>
/* =========================================================
   TECH LEADERS NETWORK - EMPLOYER HEADER
========================================================= */

.site-header {
    background: #F7F9FF;
    box-shadow: 0 2px 20px rgba(0, 0, 0, .06);
    position: sticky;
    top: 0;
    z-index: 1000;
    font-family: "Inter", "Segoe UI", system-ui, -apple-system, sans-serif;
    border-bottom: 1px solid rgba(0, 0, 0, .06);
}

.site-header .container {
    max-width: 1440px;
    width: 100%;
    margin: 0 auto;
    padding: 0 32px;
}

/* ---------- Row 1 ---------- */
.header-top {
    max-width: 1650px;
    height: 76px;
    display: flex;
    align-items: center;
    gap: 36px;
    padding: 8px 40px;
    box-sizing: border-box;
}

.logo {
    display: flex;
    align-items: center;
    text-decoration: none;
    flex-shrink: 0;
    height: 60px;
}

.logo-mark {
    width: 175px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    flex-shrink: 0;
    border-radius: 8px;
}

.logo-mark img {
    width: 175px;
    height: 82px;
    object-fit: contain;
    display: block;
}

.header-actions {
    display: flex;
    align-items: center;
    gap: 18px;
    flex-shrink: 0;
    margin-left: auto;
}

/* ---------- Action items ---------- */
.action-item {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    border-radius: 50%;
    text-decoration: none;
    color: #374151;
    transition: background .2s ease;
}

.action-item i {
    font-size: 18px;
    color: #4b5563;
    transition: color .2s ease;
}

/* "View Articles": pill with label, no wrapping */
.action-item--label {
    width: auto;
    gap: 8px;
    padding: 0 16px;
    border-radius: 999px;
    font-size: .87rem;
    font-weight: 500;
    white-space: nowrap;
}

.action-item:hover {
    background: rgba(51, 100, 215, .08);
    color: #3364d7;
}

.action-item:hover i {
    color: #3364d7;
}

.pill-badge {
    position: absolute;
    top: 0;
    right: 0;
    background: #3364d7;
    color: #fff;
    font-size: .65rem;
    font-weight: 700;
    min-width: 17px;
    height: 17px;
    border-radius: 999px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0 4px;
    border: 2px solid #F7F9FF;
    box-sizing: content-box;
}

/* ---------- Settings ---------- */
.settings-menu-wrap {
    position: relative;
}

.settings-top-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    border: none;
    background: transparent;
    cursor: pointer;
    padding: 0;
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
    transition: background .2s ease, transform .2s ease;
}

.settings-top-btn:hover .settings-icon-circle {
    background: #2456c5;
    transform: translateY(-1px);
}

.settings-top-dropdown {
    position: absolute;
    right: 0;
    top: calc(100% + 12px);
    width: 200px;
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 20px 50px rgba(0, 0, 0, .18);
    display: none;
    overflow: hidden;
    z-index: 1300;
    border: 1px solid rgba(0, 0, 0, .08);
    animation: slideDown .25s ease;
}

.settings-top-dropdown.show {
    display: block;
}

@keyframes slideDown {
    from { opacity: 0; transform: translateY(-8px); }
    to   { opacity: 1; transform: translateY(0); }
}

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
    font-size: .87rem;
    font-weight: 500;
    font-family: inherit;
    transition: background .2s ease;
    box-sizing: border-box;
}

.settings-menu-item i {
    width: 16px;
    text-align: center;
    color: #6b7280;
    font-size: 14px;
}

.settings-menu-item:hover { background: rgba(0, 0, 0, .04); }

.settings-menu-item.profile,
.settings-menu-item.profile i { color: #1e3a8a; }

.settings-menu-item.logout {
    color: #dc2626;
    border-top: 1px solid rgba(0, 0, 0, .06);
}
.settings-menu-item.logout i { color: #dc2626; opacity: .75; }
.settings-menu-item.logout:hover { background: rgba(220, 38, 38, .06); }

/* ---------- Row 2: blue bar ---------- */
.header-bottom {
    background: linear-gradient(90deg, #2f57c9, #3364d7);
    padding: 0 32px;
    box-shadow: inset 0 -1px 0 rgba(255, 255, 255, .08);
    position: relative;
}

.header-bottom-inner {
    display: flex;
    align-items: center;
    justify-content: center;
}

.main-nav {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    flex-wrap: wrap;
}

/* Top-level links: plain links AND dropdown parent links */
.main-nav > a,
.dropdown > a {
    display: flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
    font-weight: 500;
    font-size: .88rem;
    color: rgba(255, 255, 255, .82);
    padding: 12px 16px;
    margin: 8px 0;
    white-space: nowrap;
    border-radius: 8px;
    cursor: pointer;
    transition: background .2s ease, color .2s ease;
}

.main-nav > a > i,
.dropdown > a > i {
    font-size: 13px;
    color: rgba(255, 255, 255, .65);
}

.main-nav > a:hover,
.dropdown > a:hover,
.dropdown:hover > a {
    color: #fff;
    background: rgba(255, 255, 255, .14);
}

.main-nav > a:hover i,
.dropdown > a:hover i,
.dropdown:hover > a i { color: #fff; }

.main-nav > a.active,
.dropdown > a.active {
    color: #fff;
    font-weight: 600;
    background: rgba(255, 255, 255, .18);
}

.main-nav > a.active i,
.dropdown > a.active i { color: #fff; }

/* ---------- Dropdown menus ---------- */
.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-menu {
    display: none;
    position: absolute;
    top: 100%;                 /* flush: no hover gap */
    left: 50%;
    transform: translateX(-50%);
    min-width: 200px;
    background: #fff;
    border: 1px solid #eef0f3;
    border-radius: 10px;
    padding: 6px;
    list-style: none;
    margin: 0;
    box-shadow: 0 12px 28px rgba(17, 24, 39, .18);
    z-index: 1200;
}

/* invisible bridge so :hover survives the link's bottom margin */
.dropdown-menu::before {
    content: "";
    position: absolute;
    left: 0;
    right: 0;
    top: -12px;
    height: 12px;
}

.dropdown-menu li { margin: 0; }

.dropdown-menu li a {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 12px;
    border-radius: 8px;
    text-decoration: none;
    font-size: .85rem;
    font-weight: 500;
    color: #1f2937;
    white-space: nowrap;
    transition: background .2s ease, color .2s ease;
}

.dropdown-menu li a i {
    width: 14px;
    text-align: center;
    font-size: 12px;
    color: #9ca3af;
}

.dropdown-menu li a:hover {
    background: #eef2ff;
    color: #3364d7;
}

.dropdown-menu li a:hover i { color: #3364d7; }

/* open on hover (mouse) or via JS .open (touch) */
@media (hover: hover) and (pointer: fine) {
    .dropdown:hover > .dropdown-menu { display: block; }
}
.dropdown.open > .dropdown-menu { display: block; }

/* ---------- Mobile toggle ---------- */
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
    width: 22px;
    height: 2px;
    background: #374151;
    border-radius: 2px;
}

.settings-top-btn:focus-visible,
.nav-toggle:focus-visible,
.action-item:focus-visible {
    outline: 2px solid #3364d7;
    outline-offset: 3px;
}

/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 1100px) {
    .main-nav > a,
    .dropdown > a { padding: 12px 12px; }
}

@media (max-width: 900px) {
    .header-actions { gap: 14px; }
    .logo-mark,
    .logo-mark img { width: 150px; }

    /* keep only the icon for View Articles */
    .action-item--label { width: 42px; padding: 0; }
    .action-item--label span { display: none; }
}

@media (max-width: 768px) {
    .header-top {
        height: 70px;
        gap: 16px;
        padding: 8px 20px;
    }

    .logo { height: 54px; }
    .logo-mark { width: 140px; height: 54px; }
    .logo-mark img { width: 140px; height: 68px; }

    .nav-toggle { display: flex; }

    .header-bottom { display: none; padding: 0 20px; }
    .header-bottom.open { display: block; }

    .header-bottom-inner { display: block; padding: 0; }

    .main-nav {
        flex-direction: column;
        align-items: stretch;
        justify-content: flex-start;
        gap: 2px;
        padding: 10px 0;
    }

    .main-nav > a,
    .dropdown > a {
        width: 100%;
        margin: 2px 0;
        box-sizing: border-box;
    }

    .dropdown { display: block; width: 100%; }

    .dropdown-menu,
    .dropdown:hover > .dropdown-menu {
        position: static;
        transform: none;
        box-shadow: none;
        border: none;
        background: #274ea3;
        margin: 4px 0 6px;
        min-width: 0;
        width: 100%;
        padding: 4px 6px;
        box-sizing: border-box;
        display: none;
    }

    .dropdown.open > .dropdown-menu { display: block; }

    .dropdown-menu::before { display: none; }

    .dropdown-menu li a { color: #fff; }
    .dropdown-menu li a i { color: rgba(255, 255, 255, .7); }
    .dropdown-menu li a:hover { background: rgba(255, 255, 255, .12); color: #fff; }
    .dropdown-menu li a:hover i { color: #fff; }
}

@media (max-width: 480px) {
    .site-header .container { padding-left: 16px; padding-right: 16px; }

    .header-top { height: 64px; padding: 8px 16px; gap: 12px; }

    .logo { height: 50px; }
    .logo-mark { width: 125px; height: 50px; }
    .logo-mark img { width: 125px; height: 62px; }

    .header-actions { gap: 10px; }

    .settings-icon-circle { width: 38px; height: 38px; font-size: 14px; }
    .action-item,
    .action-item--label { width: 38px; height: 38px; }
    .action-item i { font-size: 17px; }
}

@media (max-width: 360px) {
    .logo-mark,
    .logo-mark img { width: 105px; }
    .header-actions { gap: 7px; }
}
</style>


<script>
document.addEventListener('DOMContentLoaded', function () {

    /* ---------- Settings dropdown ---------- */
    const settingsBtn = document.getElementById('settingsTopBtn');
    const settingsDropdown = document.getElementById('settingsTopDropdown');

    if (settingsBtn && settingsDropdown) {
        settingsBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            const isOpen = settingsDropdown.classList.toggle('show');
            settingsBtn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });

        document.addEventListener('click', function (e) {
            if (!settingsDropdown.contains(e.target) && !settingsBtn.contains(e.target)) {
                settingsDropdown.classList.remove('show');
                settingsBtn.setAttribute('aria-expanded', 'false');
            }
        });
    }

    /* ---------- Mobile navigation ---------- */
    const navToggle = document.getElementById('navToggle');
    const headerBottom = document.querySelector('.header-bottom');
    const mainNav = document.getElementById('mainNav');

    if (navToggle && headerBottom) {
        navToggle.addEventListener('click', function () {
            const isOpen = headerBottom.classList.toggle('open');
            navToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });
    }

    /* ---------- Nav dropdowns ---------- */
    const isHoverDevice = () =>
        window.matchMedia('(hover: hover) and (pointer: fine)').matches;

    const closeAllDropdowns = function (except = null) {
        if (!mainNav) return;
        mainNav.querySelectorAll('.dropdown.open').forEach(function (dd) {
            if (dd !== except) dd.classList.remove('open');
        });
    };

    if (mainNav) {
        mainNav.querySelectorAll('.dropdown > a').forEach(function (link) {
            link.addEventListener('click', function (e) {
                // Desktop mouse: normal navigation
                if (isHoverDevice() && window.innerWidth > 768) return;

                // Touch / mobile: toggle the submenu instead of navigating
                e.preventDefault();
                const parent = this.parentElement;
                const willOpen = !parent.classList.contains('open');
                closeAllDropdowns(parent);
                parent.classList.toggle('open', willOpen);
            });
        });

        // Close mobile nav after clicking a normal link (":scope >" is the valid form)
        mainNav.querySelectorAll(':scope > a').forEach(function (link) {
            link.addEventListener('click', function () {
                if (window.innerWidth <= 768) {
                    headerBottom?.classList.remove('open');
                    navToggle?.setAttribute('aria-expanded', 'false');
                }
            });
        });
    }

    /* ---------- Close dropdowns on outside click ---------- */
    document.addEventListener('click', function (e) {
        if (!e.target.closest('.dropdown')) closeAllDropdowns();
    });

    /* ---------- Resize ---------- */
    window.addEventListener('resize', function () {
        if (window.innerWidth > 768) {
            headerBottom?.classList.remove('open');
            navToggle?.setAttribute('aria-expanded', 'false');
            closeAllDropdowns();
        }
    });
});
</script>
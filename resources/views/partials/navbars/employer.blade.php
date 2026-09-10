<header class="site-header">

    {{-- =====================================================
         ROW 1: LOGO / ACTIONS
    ====================================================== --}}
    <div class="container header-top">

        {{-- Logo --}}
        <a href="{{ route('dashboard') }}" class="logo">
            <span class="logo-mark" aria-hidden="true">
                <img
                    src="{{ asset('assets/img/logo1.png') }}"
                    alt="Tech Leaders Network Logo"
                >
            </span>
        </a>

        {{-- Header Actions --}}
        <div class="header-actions">

            {{-- Notifications --}}
            <a href="#" class="action-item">
                <i class="fa-regular fa-bell"></i>
                <span>Notifications</span>
                <span class="pill-badge">12</span>
            </a>

            {{-- Settings --}}
            <div class="settings-menu-wrap">

                <button
                    class="settings-top-btn"
                    id="settingsTopBtn"
                    type="button"
                >
                    <span class="settings-icon-circle">
                        <i class="fa-solid fa-gear"></i>
                    </span>

                    <span class="settings-top-label">
                        Settings
                    </span>

                    <i
                        class="fa-solid fa-chevron-down arrow"
                        id="settingsTopArrow"
                    ></i>
                </button>

                {{-- Settings Dropdown --}}
                <div
                    class="settings-top-dropdown"
                    id="settingsTopDropdown"
                >

                    {{-- Profile --}}
                    <a
                        href="{{ route('profile') }}"
                        class="settings-menu-item profile"
                    >
                        <i class="fa-solid fa-user"></i>
                        <span>My Profile</span>
                    </a>

                    {{-- Logout --}}
                    <form
                        method="POST"
                        action="{{ route('membership-logout') }}"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="settings-menu-item logout"
                        >
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span>Logout</span>
                        </button>
                    </form>

                </div>
            </div>

            {{-- Mobile Menu --}}
            <button
                class="nav-toggle"
                id="navToggle"
                type="button"
                aria-label="Toggle navigation"
                aria-expanded="false"
            >
                <span></span>
                <span></span>
                <span></span>
            </button>

        </div>
    </div>


    {{-- =====================================================
         ROW 2: BLUE NAVIGATION BAR
         Employer Navigation
    ====================================================== --}}
    <div class="header-bottom">

        <div class="container header-bottom-inner">

            <nav
                class="main-nav"
                id="mainNav"
                aria-label="Primary"
            >

                {{-- =================================================
                     HOME
                ================================================== --}}
                <a
                    href="{{ route('dashboard') }}"
                    class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"
                >
                    <i class="fa-solid fa-house"></i>
                    <span>Home</span>
                </a>


                {{-- =================================================
                     JOBS
                     Plain Link
                ================================================== --}}
                <a
                    href="{{ route('employer.jobs.index') }}"
                    class="{{ request()->routeIs('employer.jobs.*') ? 'active' : '' }}"
                >
                    <i class="fa-solid fa-briefcase"></i>
                    <span>Jobs</span>
                </a>


                {{-- =================================================
                     INTERNSHIPS
                     Plain Link
                ================================================== --}}
                <a
                    href="{{ route('employer.internships.index') }}"
                    class="{{ request()->routeIs('employer.internships.*') ? 'active' : '' }}"
                >
                    <i class="fa-solid fa-user-graduate"></i>
                    <span>Internships</span>
                </a>


                {{-- =================================================
                     PROJECTS
                     Plain Link
                ================================================== --}}
                <a
                    href="{{ route('employer.projects.index') }}"
                    class="{{ request()->routeIs('employer.projects.*') ? 'active' : '' }}"
                >
                    <i class="fa-solid fa-diagram-project"></i>
                    <span>Projects</span>
                </a>


                {{-- =================================================
                     STARTUP
                     Plain Link - SAME AS JOBS
                ================================================== --}}
                <a
                    href="{{ route('employer.startup-profile.index') }}"
                    class="{{ request()->routeIs('employer.startup-profile.*') ? 'active' : '' }}"
                >
                    <i class="fa-solid fa-rocket"></i>
                    <span>Startup</span>
                </a>


                {{-- =================================================
                     APPLICANTS
                ================================================== --}}
                <a
                    href="{{ route('employer.applicants.index') }}"
                    class="{{ request()->routeIs('employer.applicants.*') ? 'active' : '' }}"
                >
                    <i class="fa-solid fa-users"></i>
                    <span>Applicants</span>
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


/* =========================================================
   CONTAINER
========================================================= */

.site-header .container {
    max-width: 1440px;
    width: 100%;
    margin: 0 auto;
    padding: 0 32px;
}


/* =========================================================
   HEADER TOP
========================================================= */

.header-top {
    max-width: 1650px;
    width: 100%;
    height: 76px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    gap: 36px;
    padding: 8px 40px;
    box-sizing: border-box;
}


/* =========================================================
   LOGO
========================================================= */

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
    overflow: visible;
    border-radius: 8px;
}

.logo-mark img {
    width: 175px;
    height: 82px;
    object-fit: contain;
    display: block;
}


/* =========================================================
   HEADER ACTIONS
========================================================= */

.header-actions {
    display: flex;
    align-items: center;
    gap: 34px;
    flex-shrink: 0;
    margin-left: auto;
}


/* =========================================================
   ACTION ITEMS
========================================================= */

.action-item {
    position: relative;
    display: flex;
    align-items: center;
    gap: 9px;
    text-decoration: none;
    color: #374151;
    font-size: .87rem;
    font-weight: 500;
}

.action-item i {
    font-size: 17px;
    color: #4b5563;
}

.action-item:hover {
    color: #3364d7;
}

.action-item:hover i {
    color: #3364d7;
}


/* =========================================================
   NOTIFICATION BADGE
========================================================= */

.pill-badge {
    position: absolute;
    top: -8px;
    right: -14px;
    background: #3364d7;
    color: #fff;
    font-size: .65rem;
    font-weight: 700;
    min-width: 16px;
    height: 16px;
    border-radius: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0 4px;
}


/* =========================================================
   SETTINGS
========================================================= */

.settings-menu-wrap {
    position: relative;
}

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
    font-size: .9rem;
    color: #111827;
    white-space: nowrap;
}

.settings-top-btn .arrow {
    font-size: 11px;
    color: #9ca3af;
    margin-left: 2px;
    transition: transform .25s ease;
}

.settings-top-btn.open .arrow {
    transform: rotate(180deg);
}


/* =========================================================
   SETTINGS DROPDOWN
========================================================= */

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
    z-index: 999;
    border: 1px solid rgba(0, 0, 0, .08);
    animation: slideDown .25s ease;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-8px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.settings-top-dropdown.show {
    display: block;
}


/* =========================================================
   SETTINGS ITEMS
========================================================= */

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
}

.settings-menu-item i {
    width: 16px;
    text-align: center;
    color: #6b7280;
    font-size: 14px;
}

.settings-menu-item:hover {
    background: rgba(0, 0, 0, .04);
}


/* PROFILE */

.settings-menu-item.profile {
    color: #1e3a8a;
}

.settings-menu-item.profile i {
    color: #1e3a8a;
    opacity: .85;
}


/* LOGOUT */

.settings-menu-item.logout {
    color: #dc2626;
    border-top: 1px solid rgba(0, 0, 0, .06);
}

.settings-menu-item.logout i {
    color: #dc2626;
    opacity: .75;
}

.settings-menu-item.logout:hover {
    background: rgba(220, 38, 38, .06);
}


/* =========================================================
   BLUE NAVIGATION BAR
========================================================= */

.header-bottom {
    background: linear-gradient(
        90deg,
        #2f57c9,
        #3364d7
    );

    padding: 0 32px;

    box-shadow:
        inset 0 -1px 0 rgba(255, 255, 255, .08);

    position: relative;
    margin-bottom: 0;
}


/* =========================================================
   NAV INNER
========================================================= */

.header-bottom-inner {
    display: flex;
    align-items: center;
    justify-content: center;
}


/* =========================================================
   MAIN NAV
========================================================= */

.main-nav {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    flex-wrap: wrap;
}


/* =========================================================
   NORMAL NAV LINKS
   Home / Jobs / Internships / Projects / Startup / Applicants
========================================================= */

.main-nav > a {
    display: flex;
    align-items: center;
    gap: 7px;
    text-decoration: none;
    font-weight: 500;
    font-size: .85rem;
    color: rgba(255, 255, 255, .82);
    padding: 12px 16px;
    margin: 8px 0;
    white-space: nowrap;
    position: relative;
    border-radius: 8px;
    transition:
        background .2s ease,
        color .2s ease;
}


/* =========================================================
   NAV ICON
========================================================= */

.main-nav > a > i {
    font-size: 13px;
    color: rgba(255, 255, 255, .65);
}


/* =========================================================
   HOVER
========================================================= */

.main-nav > a:hover {
    color: #fff;
    background: rgba(255, 255, 255, .14);
}

.main-nav > a:hover i {
    color: #fff;
}


/* =========================================================
   ACTIVE
========================================================= */

.main-nav > a.active {
    color: #fff;
    font-weight: 600;
    background: rgba(255, 255, 255, .18);
}

.main-nav > a.active i {
    color: #fff;
}


/* =========================================================
   MOBILE TOGGLE
========================================================= */

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
    transition: .25s ease;
}


/* =========================================================
   TABLET
========================================================= */

@media (max-width: 900px) {

    .action-item span:not(.pill-badge) {
        display: none;
    }

    .header-actions {
        gap: 16px;
    }

    .settings-top-label {
        display: none;
    }

    .logo-mark {
        width: 150px;
    }

    .logo-mark img {
        width: 150px;
    }
}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 768px) {

    .site-header .container {
        padding-left: 32px;
        padding-right: 32px;
    }

    .header-top {
        height: 70px;
        flex-wrap: wrap;
        gap: 16px;
        padding: 8px 32px;
    }


    /* LOGO */

    .logo {
        height: 54px;
    }

    .logo-mark {
        width: 140px;
        height: 54px;
    }

    .logo-mark img {
        width: 140px;
        height: 68px;
    }


    /* MOBILE TOGGLE */

    .nav-toggle {
        display: flex;
    }


    /* HIDE NAV */

    .header-bottom {
        display: none;
        padding: 0 32px;
    }


    /* SHOW NAV */

    .header-bottom.open {
        display: block;
    }


    /* NAV INNER */

    .header-bottom-inner {
        display: block;
    }


    /* MAIN NAV */

    .main-nav {
        flex-direction: column;
        align-items: stretch;
        justify-content: flex-start;
        gap: 2px;
        padding: 10px 0;
    }


    /* NORMAL LINKS */

    .main-nav > a {
        width: 100%;
        margin: 2px 0;
        justify-content: flex-start;
        box-sizing: border-box;
    }
}


/* =========================================================
   SMALL MOBILE
========================================================= */

@media (max-width: 480px) {

    .site-header .container {
        padding-left: 16px;
        padding-right: 16px;
    }

    .header-top {
        height: 64px;
        padding: 8px 16px;
        gap: 12px;
    }

    .logo {
        height: 50px;
    }

    .logo-mark {
        width: 125px;
        height: 50px;
    }

    .logo-mark img {
        width: 125px;
        height: 62px;
    }

    .header-actions {
        gap: 12px;
    }

    .settings-icon-circle {
        width: 38px;
        height: 38px;
        font-size: 14px;
    }
}


/* =========================================================
   VERY SMALL DEVICES
========================================================= */

@media (max-width: 360px) {

    .logo-mark {
        width: 105px;
    }

    .logo-mark img {
        width: 105px;
    }

    .header-actions {
        gap: 8px;
    }
}

</style>


<script>

document.addEventListener('DOMContentLoaded', function () {

    /* =====================================================
       SETTINGS DROPDOWN
    ===================================================== */

    const settingsTopBtn =
        document.getElementById('settingsTopBtn');

    const settingsTopDropdown =
        document.getElementById('settingsTopDropdown');


    if (settingsTopBtn && settingsTopDropdown) {

        settingsTopBtn.addEventListener('click', function (e) {

            e.stopPropagation();

            settingsTopDropdown.classList.toggle('show');

            settingsTopBtn.classList.toggle('open');

        });
    }


    /* =====================================================
       CLOSE SETTINGS OUTSIDE CLICK
    ===================================================== */

    document.addEventListener('click', function (e) {

        if (
            !settingsTopDropdown?.contains(e.target) &&
            !settingsTopBtn?.contains(e.target)
        ) {

            settingsTopDropdown?.classList.remove('show');

            settingsTopBtn?.classList.remove('open');
        }
    });


    /* =====================================================
       MOBILE NAVIGATION
    ===================================================== */

    const navToggle =
        document.getElementById('navToggle');

    const headerBottom =
        document.querySelector('.header-bottom');


    if (navToggle && headerBottom) {

        navToggle.addEventListener('click', function () {

            const isOpen =
                headerBottom.classList.toggle('open');

            navToggle.setAttribute(
                'aria-expanded',
                isOpen ? 'true' : 'false'
            );

        });
    }


    /* =====================================================
       CLOSE MOBILE NAV AFTER NORMAL LINK CLICK

       Home
       Jobs
       Internships
       Projects
       Startup
       Applicants
    ===================================================== */

    document
        .querySelectorAll('.main-nav > a')
        .forEach(function (link) {

            link.addEventListener('click', function () {

                if (window.innerWidth <= 768) {

                    headerBottom?.classList.remove('open');

                    navToggle?.setAttribute(
                        'aria-expanded',
                        'false'
                    );

                }

            });

        });


    /* =====================================================
       WINDOW RESIZE
    ===================================================== */

    window.addEventListener('resize', function () {

        if (window.innerWidth > 768) {

            headerBottom?.classList.remove('open');

            navToggle?.setAttribute(
                'aria-expanded',
                'false'
            );

        }

    });

});

</script>
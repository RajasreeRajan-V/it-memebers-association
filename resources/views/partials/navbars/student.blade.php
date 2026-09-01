
<header class="site-header">

    <!-- ROW 1: Logo / Actions -->
    <div class="container header-top">

        <!-- Logo -->
        <a href="{{ route('dashboard') }}" class="logo">
            <span class="logo-mark" aria-hidden="true">
                <img src="{{ asset('assets/img/logo1.png') }}"
                     alt="Tech Leaders Network Logo">
            </span>
        </a>

        <!-- Header Actions -->
        <div class="header-actions">

       

            <!-- Notifications -->
            <a href="#" class="action-item">
                <i class="fa-regular fa-bell"></i>
                <span>Notifications</span>
                <span class="pill-badge">12</span>
            </a>

            <!-- Settings -->
            <div class="settings-menu-wrap">

                <button class="settings-top-btn"
                        id="settingsTopBtn"
                        type="button">

                    <span class="settings-icon-circle">
                        <i class="fa-solid fa-gear"></i>
                    </span>

                    <span class="settings-top-label">
                        Settings
                    </span>

                    <i class="fa-solid fa-chevron-down arrow"
                       id="settingsTopArrow"></i>

                </button>

                <!-- Settings Dropdown -->
                <div class="settings-top-dropdown"
                     id="settingsTopDropdown">

                    <a href="{{ route('profile') }}"
                       class="settings-menu-item profile">

                        <i class="fa-solid fa-user"></i>

                        <span>My Profile</span>

                    </a>

                    <form method="POST"
                          action="{{ route('membership-logout') }}">

                        @csrf

                        <button type="submit"
                                class="settings-menu-item logout">

                            <i class="fa-solid fa-right-from-bracket"></i>

                            <span>Logout</span>

                        </button>

                    </form>

                </div>

            </div>

            <!-- Mobile Menu Button -->
            <button
                class="nav-toggle"
                id="navToggle"
                type="button"
                aria-label="Toggle navigation"
                aria-expanded="false">

                <span></span>
                <span></span>
                <span></span>

            </button>

        </div>

    </div>


    <!-- =====================================================
         ROW 2: BLUE NAVIGATION
    ====================================================== -->

    <div class="header-bottom">

        <div class="container header-bottom-inner">

            <nav class="main-nav"
                 id="mainNav"
                 aria-label="Primary">

                <!-- Home -->
                <a href="{{ route('student.dashboard') }}"
                   class="{{ request()->routeIs('student.dashboard') ? 'active' : '' }}">

                    <i class="fa-solid fa-house"></i>

                    <span>Home</span>

                </a>


                <!-- My Mentorship -->
                <a href="{{ route('student.mentorship.index') }}"
                   class="{{ request()->routeIs('student.mentorship.*') || request()->routeIs('student.mentors.*') ? 'active' : '' }}">

                    <i class="fa-solid fa-user-group"></i>

                    <span>My Mentorship</span>

                </a>


                <!-- My Sessions -->
                <a href="{{ route('student.sessions.upcoming') }}"
                   class="{{ request()->routeIs('student.sessions.*') ? 'active' : '' }}">

                    <i class="fa-solid fa-calendar-days"></i>

                    <span>My Sessions</span>

                </a>


                <!-- Resume Reviews -->
                <a href="{{ route('student.resume-review.index') }}"
                   class="{{ request()->routeIs('student.resume-review.*') ? 'active' : '' }}">

                    <i class="fa-solid fa-file-lines"></i>

                    <span>Resume Reviews</span>

                </a>


                <!-- Webinars -->
                <a href="{{ route('student.webinars.index') }}"
                   class="{{ request()->routeIs('student.webinars.*') ? 'active' : '' }}">

                    <i class="fa-solid fa-video"></i>

                    <span>Webinars</span>

                </a>


                <!-- Training -->
                <a href="{{ route('student.trainings.index') }}"
                   class="{{ request()->routeIs('student.trainings.*') ? 'active' : '' }}">

                    <i class="fa-solid fa-graduation-cap"></i>

                    <span>Training</span>

                </a>


                <!-- Mock Interviews -->
                <a href="{{ route('student.mock-interviews.index') }}"
                   class="{{ request()->routeIs('student.mock-interviews.*') ? 'active' : '' }}">

                    <i class="fa-solid fa-comments"></i>

                    <span>Mock Interviews</span>

                </a>

            </nav>

        </div>

    </div>

</header>


<style>

/* =========================================================
   TECH LEADERS NETWORK - STUDENT HEADER
========================================================= */

.site-header {
    background: #F7F9FF;
    box-shadow: 0 2px 20px rgba(0, 0, 0, .06);

    position: sticky;
    top: 0;

    z-index: 1000;

    font-family:
        "Inter",
        "Segoe UI",
        system-ui,
        -apple-system,
        sans-serif;

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

    box-sizing: border-box;
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
   SETTINGS MENU ITEM
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
   BLUE SECOND NAVBAR
========================================================= */

.header-bottom {
    width: 100%;

    background: linear-gradient(
        90deg,
        #2f57c9,
        #3364d7
    );

    padding: 0;

    box-shadow:
        inset 0 -1px 0 rgba(255, 255, 255, .08);

    position: relative;

    display: block;
}


/* =========================================================
   NAV INNER
========================================================= */

.header-bottom-inner {
    display: flex;

    align-items: center;

    justify-content: center;

    min-height: 52px;
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

    width: 100%;
}


/* =========================================================
   NAV LINKS
========================================================= */

.main-nav > a {
    display: flex;

    align-items: center;

    justify-content: center;

    gap: 7px;

    text-decoration: none;

    font-weight: 500;

    font-size: .85rem;

    color: rgba(255, 255, 255, .82);

    padding: 10px 16px;

    margin: 5px 0;

    white-space: nowrap;

    position: relative;

    border-radius: 8px;

    transition:
        background .2s ease,
        color .2s ease;
}


.main-nav > a i {
    font-size: 13px;

    color: rgba(255, 255, 255, .65);
}


.main-nav > a:hover {
    color: #fff;

    background: rgba(255, 255, 255, .14);
}


.main-nav > a:hover i {
    color: #fff;
}


/* =========================================================
   ACTIVE NAV
========================================================= */

.main-nav > a.active {
    color: #1f2937;

    font-weight: 600;

    background: #fff;
}


.main-nav > a.active i {
    color: #3364d7;
}


/* =========================================================
   MOBILE NAV BUTTON
========================================================= */

.nav-toggle {
    display: none;

    flex-direction: column;

    align-items: center;

    justify-content: center;

    gap: 5px;

    background: none;

    border: none;

    cursor: pointer;

    padding: 6px;

    width: 40px;

    height: 40px;
}


.nav-toggle span {
    display: block;

    width: 22px;

    height: 2px;

    background: #374151;

    border-radius: 2px;
}


/* =========================================================
   TABLET
========================================================= */

@media (max-width: 1100px) {

    .main-nav {
        gap: 4px;
    }

    .main-nav > a {
        padding: 10px 11px;
        font-size: .82rem;
    }

    .header-actions {
        gap: 20px;
    }

}


/* =========================================================
   SMALL TABLET
========================================================= */

@media (max-width: 900px) {

    .action-item span:not(.pill-badge) {
        display: none;
    }


    .settings-top-label {
        display: none;
    }


    .header-actions {
        gap: 16px;
    }


    .logo-mark {
        width: 150px;
    }


    .logo-mark img {
        width: 150px;
    }


    .main-nav {
        gap: 2px;
    }


    .main-nav > a {
        padding: 10px 9px;
        font-size: .78rem;
    }

}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 768px) {

    .header-top {

        height: 70px;

        flex-wrap: wrap;

        gap: 16px;

        padding: 8px 32px;
    }


    /* Mobile Logo */

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


    /* Show hamburger */

    .nav-toggle {
        display: flex;
    }


    /*
       Hide second navbar initially on mobile.
       It will show when .open is added by JS.
    */

    .header-bottom {
        display: none;

        padding: 0;
    }


    .header-bottom.open {
        display: block;
    }


    .header-bottom-inner {
        display: block;

        min-height: auto;

        padding: 8px 32px;
    }


    .main-nav {

        width: 100%;

        flex-direction: column;

        align-items: stretch;

        justify-content: flex-start;

        gap: 2px;

        padding: 0;
    }


    .main-nav > a {

        width: 100%;

        margin: 2px 0;

        padding: 12px 16px;

        justify-content: flex-start;

        box-sizing: border-box;
    }

}


/* =========================================================
   SMALL MOBILE
========================================================= */

@media (max-width: 480px) {

    .header-top {

        height: 64px;

        padding: 8px 16px;

        gap: 12px;
    }


    /* Logo */

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


    /* Actions */

    .header-actions {
        gap: 12px;
    }


    /* Settings */

    .settings-icon-circle {

        width: 38px;

        height: 38px;

        font-size: 14px;
    }


    /* Mobile navbar */

    .header-bottom-inner {
        padding: 8px 16px;
    }


    .main-nav > a {
        padding: 11px 14px;

        font-size: .84rem;
    }

}


/* =========================================================
   VERY SMALL MOBILE
========================================================= */

@media (max-width: 360px) {

    .logo-mark {
        width: 110px;
    }


    .logo-mark img {
        width: 110px;
    }


    .header-actions {
        gap: 8px;
    }


    .nav-toggle {
        width: 36px;
        height: 36px;
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
       CLOSE SETTINGS WHEN CLICKING OUTSIDE
    ===================================================== */

    document.addEventListener('click', function (e) {

        if (
            settingsTopDropdown &&
            settingsTopBtn &&
            !settingsTopDropdown.contains(e.target) &&
            !settingsTopBtn.contains(e.target)
        ) {

            settingsTopDropdown.classList.remove('show');

            settingsTopBtn.classList.remove('open');

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
       CLOSE MOBILE NAV AFTER CLICKING A LINK
    ===================================================== */

    const navLinks =
        document.querySelectorAll('.main-nav a');


    navLinks.forEach(function (link) {

        link.addEventListener('click', function () {

            if (window.innerWidth <= 768) {

                headerBottom.classList.remove('open');

                navToggle.setAttribute(
                    'aria-expanded',
                    'false'
                );

            }

        });

    });


    /* =====================================================
       RESET MOBILE NAV WHEN RESIZING TO DESKTOP
    ===================================================== */

    window.addEventListener('resize', function () {

        if (window.innerWidth > 768) {

            headerBottom.classList.remove('open');

            navToggle.setAttribute(
                'aria-expanded',
                'false'
            );

        }

    });

});

</script>


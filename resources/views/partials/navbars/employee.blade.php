
<header class="site-header pt-1">

    <!-- ROW 1: Logo / Actions -->
    <div class="container header-top pb-2 pt-1">

        <a href="{{ route('dashboard') }}" class="logo">

            <!-- YOUR CUSTOM LOGO -->
            <span class="logo-mark" aria-hidden="true">
                <img
                    src="{{ asset('assets/img/logo.png') }}"
                    alt="Tech Leaders Network Logo"
                >
            </span>

            <span class="logo-text">
                Tech Leaders Network
                <small>Student Portal</small>
            </span>

        </a>


        <div class="header-actions">

            <!-- Legal Help -->
            <a
                href="{{ route('employee.legal-help.index') }}#messages-section"
                class="action-item"
            >
                <i class="fa-regular fa-comment-dots"></i>
                <span>Legal help</span>
            </a>


            <!-- Notifications -->
            <a href="#" class="action-item">
                <i class="fa-regular fa-bell"></i>
                <span>Notifications</span>
                <span class="pill-badge">12</span>
            </a>


            <!-- Settings -->
            <div class="settings-menu-wrap">

                <button
                    class="settings-top-btn"
                    id="settingsTopBtn"
                    type="button"
                    aria-expanded="false"
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


                <div
                    class="settings-top-dropdown"
                    id="settingsTopDropdown"
                >

                    <!-- Profile -->
                    <a
                        href="{{ route('profile') }}"
                        class="settings-menu-item profile"
                    >
                        <i class="fa-solid fa-user"></i>
                        <span>My Profile</span>
                    </a>


                    <!-- Logout -->
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

        </div>


        <!-- Mobile Menu -->
        <button
            class="nav-toggle"
            id="navToggle"
            aria-label="Toggle menu"
            aria-expanded="false"
            type="button"
        >
            <span></span>
            <span></span>
            <span></span>
        </button>

    </div>


    <!-- ROW 2: Icon nav -->
    <div class="container header-bottom">

        <nav
            class="main-nav"
            id="mainNav"
            aria-label="Primary"
        >

            <!-- Dashboard -->
            <a
                href="{{ route('dashboard') }}"
                class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"
            >
                <i class="fa-solid fa-gauge"></i>
                Dashboard
            </a>


            <!-- Jobs -->
            <a
                href="{{ route('employee.jobs.index') }}"
                class="{{ request()->routeIs('employee.jobs.*') ? 'active' : '' }}"
            >
                <i class="fa-solid fa-briefcase"></i>
                Jobs
            </a>


            <!-- Articles -->
            <a
                href="{{ route('employee.articles.index') }}"
                class="{{ request()->routeIs('employee.articles.*') ? 'active' : '' }}"
            >
                <i class="fa-solid fa-file-lines"></i>
                Articles
            </a>


            <!-- Training -->
            <a href="#" class="">
                <i class="fa-regular fa-life-ring"></i>
                Training
            </a>


            <!-- Webinar -->
            <a
                href="{{ route('employee.webinars') }}"
                class="{{ request()->routeIs('employee.webinars*') ? 'active' : '' }}"
            >
                <i class="fa-solid fa-chalkboard-user"></i>
                Webinar
            </a>


            <!-- Workplace Support -->
            <a
                href="{{ route('employee.legal-help.create') }}"
                class="{{ request()->routeIs('employee.legal-help.*') ? 'active' : '' }}"
            >
                <i class="fa-regular fa-comment-dots"></i>
                Workplace Support
            </a>

        </nav>

    </div>

</header>


<style>

/* =========================================================
   BASE
========================================================= */

.site-header {
    background: #F7F9FF;

    box-shadow:
        0 2px 20px rgba(0, 0, 0, 0.06);

    position: sticky;
    top: 0;
    z-index: 1000;

    font-family:
        "Inter",
        "Segoe UI",
        system-ui,
        -apple-system,
        sans-serif;

    border-bottom:
        1px solid rgba(0, 0, 0, 0.06);

    padding-bottom: 0;
}


.site-header .container {
    max-width: 1440px;

    width: 100%;

    margin: 0 auto;

    padding: 0 32px;
}


/* =========================================================
   ROW 1
   SAME AS ORIGINAL
========================================================= */

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


/* =========================================================
   LOGO
   ONLY THIS PART IS INCREASED
========================================================= */

.logo {
    display: flex;

    align-items: center;

    gap: 15px;

    text-decoration: none;

    flex-shrink: 0;
}


/*
   Logo increased from 48px to 70px.
   Nothing else in the header was increased.
*/
.logo-mark {
    width: 70px;

    height: 70px;

    display: flex;

    align-items: center;

    justify-content: center;

    flex-shrink: 0;
}


.logo-mark img {
    width: 100%;

    height: 100%;

    object-fit: contain;

    display: block;
}


/* =========================================================
   LOGO TEXT
========================================================= */

.logo-text {
    display: flex;

    flex-direction: column;

    line-height: 1.15;

    font-size: 1.3rem;

    font-weight: 700;

    color: #1f2937;

    letter-spacing: -0.3px;
}


.logo-text small {
    font-size: 0.72rem;

    font-weight: 500;

    color: #3b404b;

    letter-spacing: 0.2px;
}


/* =========================================================
   SEARCH BAR
========================================================= */

.header-search {
    flex: 0 1 320px;

    display: flex;

    align-items: center;

    gap: 10px;

    background: #f3f4f6;

    border: 1px solid #e5e7eb;

    border-radius: 8px;

    padding: 8px 14px;

    transition:
        border-color 0.2s ease;
}


.header-search:focus-within {
    border-color: #3364d7;

    background: #ffffff;
}


.header-search i {
    color: #9ca3af;

    font-size: 13px;
}


.header-search input {
    border: none;

    outline: none;

    background: transparent;

    width: 100%;

    font-size: 0.8rem;

    color: #111827;
}


.header-search input::placeholder {
    color: #9ca3af;
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

    font-size: 0.9rem;

    color: #111827;

    white-space: nowrap;
}


.settings-top-btn .arrow {
    font-size: 11px;

    color: #9ca3af;

    margin-left: 2px;

    transition:
        transform 0.25s ease;
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

    background: #ffffff;

    border-radius: 14px;

    box-shadow:
        0 20px 50px rgba(0, 0, 0, 0.18);

    display: none;

    overflow: hidden;

    z-index: 999;

    border:
        1px solid rgba(0, 0, 0, 0.08);

    animation:
        slideDown 0.25s ease;
}


@keyframes slideDown {

    from {
        opacity: 0;

        transform:
            translateY(-8px);
    }

    to {
        opacity: 1;

        transform:
            translateY(0);
    }

}


.settings-top-dropdown.show {
    display: block;
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

    font-size: 0.87rem;

    font-weight: 500;

    font-family: inherit;

    transition:
        background 0.2s ease;
}


.settings-menu-item i {
    width: 16px;

    text-align: center;

    color: #6b7280;

    font-size: 14px;
}


.settings-menu-item:hover {
    background:
        rgba(0, 0, 0, 0.04);
}


/* Profile */

.settings-menu-item.profile {
    color: #1e3a8a;
}


.settings-menu-item.profile i {
    color: #1e3a8a;

    opacity: 0.85;
}


.settings-menu-item.profile:hover {
    color: #1e3a8a;

    background:
        rgba(0, 0, 0, 0.04);
}


/* Logout */

.settings-menu-item.logout {
    color: #dc2626;

    border-top:
        1px solid rgba(0, 0, 0, 0.06);
}


.settings-menu-item.logout i {
    color: #dc2626;

    opacity: 0.75;
}


.settings-menu-item.logout:hover {
    background:
        rgba(220, 38, 38, 0.06);
}


/* =========================================================
   ROW 2 NAV
   ORIGINAL SIZE - NOT CHANGED
========================================================= */

.header-bottom {
    background:
        linear-gradient(
            90deg,
            #2f57c9,
            #3364d7
        );

    padding: 0 32px;

    box-shadow:
        inset 0 -1px 0
        rgba(255, 255, 255, 0.08);

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

    gap: 10px;

    flex-wrap: wrap;
}


.main-nav > a {
    display: flex;

    align-items: center;

    gap: 7px;

    text-decoration: none;

    font-weight: 500;

    font-size: 0.85rem;

    color:
        rgba(255, 255, 255, 0.82);

    padding: 12px 16px;

    margin: 8px 0;

    white-space: nowrap;

    position: relative;

    border-radius: 8px;

    transition:
        background 0.2s ease,
        color 0.2s ease;
}


.main-nav > a i {
    font-size: 13px;

    color:
        rgba(255, 255, 255, 0.65);
}


.main-nav > a:hover {
    color: #ffffff;

    background:
        rgba(255, 255, 255, 0.14);
}


.main-nav > a:hover i {
    color: #ffffff;
}


.main-nav > a.active {
    color: #ffffff;

    font-weight: 600;

    background:
        rgba(255, 255, 255, 0.18);
}


.main-nav > a.active i {
    color: #ffffff;
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
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 1100px) {

    .header-search {
        flex-basis: 260px;
    }

    .header-actions {
        gap: 20px;
    }

}


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

}


@media (max-width: 768px) {

    .header-search {
        display: none;
    }


    .header-top {
        flex-wrap: wrap;

        gap: 16px;

        padding: 18px 32px;
    }


    /*
     * Logo only:
     * 70px desktop
     * 60px tablet
     */
    .logo-mark {
        width: 60px;

        height: 60px;
    }


    .nav-toggle {
        display: flex;
    }


    .header-bottom {
        display: none;
    }


    .header-bottom.open {
        display: block;
    }


    .header-bottom .container {
        display: block;
    }


    .main-nav {
        flex-direction: column;

        align-items: stretch;

        justify-content: flex-start;

        gap: 2px;

        padding: 10px 0;
    }


    .main-nav > a {
        width: 100%;
    }

}


@media (max-width: 480px) {

    .header-top {
        padding: 14px 16px;

        gap: 12px;
    }


    /*
     * Logo only:
     * 52px on mobile
     */
    .logo-mark {
        width: 52px;

        height: 52px;
    }


    .logo-text {
        font-size: 1.1rem;
    }

}


/* =========================================================
   SCRIPT
========================================================= */

</style>


<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {

        /* ==============================
           SETTINGS DROPDOWN
        ============================== */

        const settingsTopBtn =
            document.getElementById(
                'settingsTopBtn'
            );

        const settingsTopDropdown =
            document.getElementById(
                'settingsTopDropdown'
            );


        settingsTopBtn?.addEventListener(
            'click',
            function (e) {

                e.stopPropagation();

                settingsTopDropdown.classList.toggle(
                    'show'
                );

                settingsTopBtn.classList.toggle(
                    'open'
                );

            }
        );


        /* ==============================
           CLOSE SETTINGS
        ============================== */

        document.addEventListener(
            'click',
            function (e) {

                if (
                    !settingsTopDropdown?.contains(
                        e.target
                    ) &&
                    !settingsTopBtn?.contains(
                        e.target
                    )
                ) {

                    settingsTopDropdown?.classList.remove(
                        'show'
                    );

                    settingsTopBtn?.classList.remove(
                        'open'
                    );

                }

            }
        );


        /* ==============================
           MOBILE NAVIGATION
        ============================== */

        const navToggle =
            document.getElementById(
                'navToggle'
            );

        const headerBottom =
            document.querySelector(
                '.header-bottom'
            );


        navToggle?.addEventListener(
            'click',
            function () {

                const isOpen =
                    headerBottom.classList.toggle(
                        'open'
                    );

                navToggle.setAttribute(
                    'aria-expanded',
                    isOpen
                );

            }
        );

    }
);

</script>


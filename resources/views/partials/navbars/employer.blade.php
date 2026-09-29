<header class="site-header">

    {{-- =====================================================
         ROW 1: LOGO / ACTION ICONS
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


        {{-- =================================================
             HEADER ACTIONS
        ================================================== --}}
        <div class="header-actions">

            {{-- =================================================
                 NOTIFICATIONS - ICON ONLY
            ================================================== --}}
            <a
                href="{{ route('employer.notifications.index') }}"
                class="action-item notification-btn"
                aria-label="Notifications"
                title="Notifications"
            >
                <i class="fa-regular fa-bell"></i>

                @auth
                    @php
                        $unreadNotificationsCount =
                            \App\Models\EmployerPortalNotification::where(
                                'employer_id',
                                auth()->id()
                            )
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

            <a href="{{ route('employer.articles.index') }}" class="action-item">
                <i class="fa-solid fa-file-lines"></i>
                <span>View Articles</span>
            </a>

            {{-- =================================================
                 SETTINGS - ICON ONLY + DROPDOWN
            ================================================== --}}
            <div class="settings-menu-wrap">

                <button
                    class="settings-top-btn"
                    id="settingsTopBtn"
                    type="button"
                    aria-label="Settings"
                    title="Settings"
                    aria-expanded="false"
                >
                    <span class="settings-icon-circle">
                        <i class="fa-solid fa-gear"></i>
                    </span>
                </button>


                {{-- =================================================
                     SETTINGS DROPDOWN
                ================================================== --}}
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


            {{-- =================================================
                 MOBILE MENU BUTTON
            ================================================== --}}
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


            <div class="dropdown">
                <a href="{{ route('employer.jobs.index') }}"
                    class="{{ request()->routeIs('employer.jobs.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-briefcase"></i> Jobs
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('employer.jobs.create') }}"><i class="fa-solid fa-plus"></i> Create Job</a>
                    </li>
                    <li><a href="{{ route('employer.jobs.index') }}"><i class="fa-solid fa-list"></i> View Jobs</a></li>
                </ul>
            </div>

            <div class="dropdown">
                <a href="{{ route('employer.internships.index') }}"
                    class="{{ request()->routeIs('employer.internships.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-user-graduate"></i> Internships
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('employer.internships.create') }}"><i class="fa-solid fa-plus"></i> Create
                            Internship</a></li>
                    <li><a href="{{ route('employer.internships.index') }}"><i class="fa-solid fa-list"></i> View
                            Internships</a></li>
                </ul>
            </div>

            <div class="dropdown">
                <a href="{{ route('employer.projects.index') }}"
                    class="{{ request()->routeIs('employer.projects.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-diagram-project"></i> Projects
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('employer.projects.create') }}"><i class="fa-solid fa-plus"></i> Create
                            Project</a></li>
                    <li><a href="{{ route('employer.projects.index') }}"><i class="fa-solid fa-list"></i> View
                            Projects</a></li>
                </ul>
            </div>

            <div class="dropdown">
                <a href="{{ route('employer.startup-profile.index') }}"
                    class="{{ request()->routeIs('employer.startup-profile.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-rocket"></i> Startup
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('employer.startup-profile.create') }}"><i class="fa-solid fa-plus"></i>
                            Create Startup</a></li>
                    <li><a href="{{ route('employer.startup-profile.index') }}"><i class="fa-solid fa-list"></i> View
                            Startups</a></li>
                </ul>
            </div>

            <a href="{{ route('employer.applicants.index') }}"
                class="{{ request()->routeIs('employer.applicants.*') ? 'active' : '' }}">
                <i class="fa-solid fa-users"></i> Applicants
            </a>

            <div class="dropdown">
                <a href="{{ route('employer.freelancer.bids.index') }}"
                    class="{{ request()->routeIs('employer.freelancer.bids.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-user-check"></i> Freelancer Bids
                </a>

                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('employer.freelancer.bids.index') }}">
                            <i class="fa-solid fa-clock"></i> Freelancer Bids
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    {{-- =====================================================
         ROW 2: BLUE NAVIGATION BAR
         EMPLOYER NAVIGATION
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
    gap: 18px;
    flex-shrink: 0;
    margin-left: auto;
}


/* =========================================================
   NOTIFICATION ICON
========================================================= */

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
    transition: all .2s ease;
}

.action-item i {
    font-size: 18px;
    color: #4b5563;
    transition: color .2s ease;
}

.action-item:hover {
    background: rgba(51, 100, 215, .08);
}

.action-item:hover i {
    color: #3364d7;
}


/* =========================================================
   NOTIFICATION BADGE
========================================================= */

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
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0 4px;
    border: 2px solid #F7F9FF;
}


/* =========================================================
   SETTINGS
========================================================= */

.settings-menu-wrap {
    position: relative;
}


/* Settings button */

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


/* Settings icon circle */

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
    transition: all .2s ease;
}


/* Settings hover */

.settings-top-btn:hover .settings-icon-circle {
    background: #2456c5;
    transform: translateY(-1px);
}


/* Remove settings text */

.settings-top-label {
    display: none !important;
}


/* Remove arrow */

.settings-top-btn .arrow {
    display: none !important;
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


/* Show dropdown */

.settings-top-dropdown.show {
    display: block;
}


/* =========================================================
   SETTINGS MENU ITEMS
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
    box-sizing: border-box;
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

    .header-actions {
        gap: 14px;
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
        transition: transform 0.25s ease;
    }

    .settings-top-btn.open .arrow {
        transform: rotate(180deg);
    }

    .settings-top-dropdown {
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

    .settings-menu-item i {
        width: 16px;
        text-align: center;
        color: #6b7280;
        font-size: 14px;
    }

    .settings-menu-item:hover {
        background: rgba(0, 0, 0, 0.04);
    }

    .settings-menu-item.profile {
        color: #1e3a8a;
    }

    .settings-menu-item.profile i {
        color: #1e3a8a;
        opacity: 0.85;
    }

    .settings-menu-item.profile:hover {
        color: #1e3a8a;
        background: rgba(0, 0, 0, 0.04);
    }

    .settings-menu-item.profile:hover i {
        color: #1e3a8a;
        opacity: 1;
    }

    .settings-menu-item.logout {
        color: #dc2626;
        border-top: 1px solid rgba(0, 0, 0, 0.06);
    }

    .settings-menu-item.logout i {
        color: #dc2626;
        opacity: 0.75;
    }

    .settings-menu-item.logout:hover {
        background: rgba(220, 38, 38, 0.06);
    }

    .settings-menu-item.logout:hover i {
        opacity: 1;
    }

    /* ===== Row 2: BLUE bar, CENTERED ===== */
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
        gap: 24px;
        flex-wrap: wrap;
    }

    /* =========================================================
       FIX #1 — the dropdown parents (.dropdown > a) were never
       styled, because the old selector was `.main-nav > a` only
       (Jobs / Internships / Projects / Startup / Freelancer Bids
       live inside a .dropdown wrapper, so they were left unstyled
       and their hover box didn't line up with the menu).
       Both selectors are now covered.
       ========================================================= */
    .main-nav>a,
    .dropdown>a {
        display: flex;
        align-items: center;
        gap: 9px;
        text-decoration: none;
        font-weight: 500;
        font-size: 0.88rem;
        color: rgba(255, 255, 255, 0.82);
        padding: 13px 18px;
        margin: 8px 0;
        white-space: nowrap;
        position: relative;
        border-radius: 8px;
        cursor: pointer;
        transition: background 0.2s ease, color 0.2s ease;
    }

    .main-nav>a i,
    .dropdown>a i {
        font-size: 13px;
        color: rgba(255, 255, 255, 0.65);
    }

    .main-nav>a:hover,
    .dropdown>a:hover {
        color: #ffffff;
        background: rgba(255, 255, 255, 0.14);
    }

    .main-nav>a:hover i,
    .dropdown>a:hover i {
        color: #ffffff;
    }

    .main-nav>a.active,
    .dropdown>a.active {
        color: #ffffff;
        font-weight: 600;
        background: rgba(255, 255, 255, 0.18);
    }

    .main-nav>a.active i,
    .dropdown>a.active i {
        color: #ffffff;
    }

    /* =========================================================
       FIX #2 — the real reason the menu items were unclickable.

       The menu used `top: calc(100% + 8px)`, which left a gap
       OUTSIDE the .dropdown box. The moment the pointer crossed
       that gap, :hover was lost and the menu closed before the
       user could reach an item.

       Now:
        • the menu starts at top:100% (the parent already has an
          8px bottom margin on the link, so the visual gap stays)
        • an invisible ::before bridge covers any remaining gap
        • `overflow:hidden` removed so the bridge isn't clipped
       ========================================================= */
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        top: 100%;
        /* flush with the wrapper box → no hover hole */
        left: 50%;
        transform: translateX(-50%);
        min-width: 200px;
        background: #ffffff;
        border: 1px solid #eef0f3;
        border-radius: 10px;
        padding: 6px;
        list-style: none;
        margin: 0;
        box-shadow: 0 12px 28px rgba(17, 24, 39, 0.18);
        z-index: 1200;
    }

    /* invisible bridge that keeps :hover alive between link and menu */
    .dropdown-menu::before {
        content: "";
        position: absolute;
        left: 0;
        right: 0;
        top: -14px;
        height: 14px;
    }

    .dropdown-menu li {
        margin: 0;
    }


/* =========================================================
   SMALL MOBILE
========================================================= */

@media (max-width: 480px) {

    .site-header .container {
        padding-left: 16px;
        padding-right: 16px;
    }

    .dropdown-menu li a i {
        font-size: 12px;
        color: #9ca3af;
    }

    .header-top {
        height: 64px;
        padding: 8px 16px;
        gap: 12px;
    }

    .dropdown-menu li a:hover i {
        color: #3364d7;
    }

    /* open on hover (mouse) — kept open by the ::before bridge */
    .dropdown:hover .dropdown-menu,
    .dropdown.open .dropdown-menu {
        display: block;
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
        width: 22px;
        height: 2px;
        background: #374151;
        border-radius: 2px;
    }

    /* =========================================================
       FIX #3 — touch / no-hover devices (tablets, touch laptops).
       Hover styles are disabled there and the menu is opened by
       the JS click toggle instead (.dropdown.open).
       ========================================================= */
    @media (hover: none) {
        .dropdown:hover .dropdown-menu {
            display: none;
        }

        .dropdown.open .dropdown-menu {
            display: block;
        }
    }

    /* ===== Responsive ===== */
    @media (max-width: 1100px) {
        .header-search {
            flex-basis: 340px;
        }

        .header-actions {
            gap: 20px;
        }

        .main-nav {
            gap: 14px;
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

        .main-nav>a,
        .dropdown>a {
            width: 100%;
            margin: 0;
        }

        .dropdown {
            display: block;
            width: 100%;
        }

        .dropdown-menu {
            position: static;
            transform: none;
            box-shadow: none;
            border: none;
            background: #274ea3;
            margin: 4px 0 6px;
            min-width: 0;
            width: 100%;
            padding: 4px 6px;
            border-radius: 8px;
            display: none;
        }

        .dropdown-menu::before {
            display: none;
        }

        .dropdown-menu li a {
            color: #ffffff;
        }

        .dropdown-menu li a:hover {
            background: rgba(255, 255, 255, 0.12);
            color: #ffffff;
        }

        .dropdown-menu li a i {
            color: rgba(255, 255, 255, 0.7);
        }

        /* on mobile only the JS .open class controls visibility */
        .dropdown:hover .dropdown-menu {
            display: none;
        }

        .dropdown.open .dropdown-menu {
            display: block;
        }
    }

    @media (max-width: 480px) {
        .header-top {
            padding: 14px 16px;
            gap: 12px;
        }

        .logo-text {
            font-size: 1.1rem;
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
        gap: 10px;
    }


    .settings-icon-circle {
        width: 38px;
        height: 38px;
        font-size: 14px;
    }


    .action-item {
        width: 38px;
        height: 38px;
    }


    .action-item i {
        font-size: 17px;
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
        gap: 7px;
    }

}


/* =========================================================
   OPTIONAL: PREVENT BUTTON FOCUS OUTLINE LOOK
========================================================= */

.settings-top-btn:focus-visible,
.nav-toggle:focus-visible,
.action-item:focus-visible {
    outline: 2px solid #3364d7;
    outline-offset: 3px;
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

            const isOpen =
                settingsTopDropdown.classList.toggle('show');

            settingsTopBtn.setAttribute(
                'aria-expanded',
                isOpen ? 'true' : 'false'
            );
        });

        document.addEventListener('click', function (e) {

            if (
                !settingsTopDropdown.contains(e.target) &&
                !settingsTopBtn.contains(e.target)
            ) {
                settingsTopDropdown.classList.remove('show');

                settingsTopBtn.setAttribute(
                    'aria-expanded',
                    'false'
                );
            }

        });
    }


    /* =====================================================
       MOBILE NAVIGATION
    ===================================================== */

    const navToggle =
        document.getElementById('navToggle');

    const headerBottom =
        document.querySelector('.header-bottom');

    const mainNav =
        document.getElementById('mainNav');


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
       DROPDOWN MENUS
       Jobs / Internships / Projects / Startup /
       Freelancer Bids
    ===================================================== */

    const isHoverDevice = () =>
        window.matchMedia(
            '(hover: hover) and (pointer: fine)'
        ).matches;


    const closeAllDropdowns = function (except = null) {

        if (!mainNav) return;

        mainNav
            .querySelectorAll('.dropdown.open')
            .forEach(function (dropdown) {

                if (dropdown !== except) {
                    dropdown.classList.remove('open');
                }

            });
    };


    if (mainNav) {

        mainNav
            .querySelectorAll('.dropdown > a')
            .forEach(function (link) {

                link.addEventListener('click', function (e) {

                    /*
                     * Desktop mouse:
                     * allow normal navigation.
                     */
                    if (
                        isHoverDevice() &&
                        window.innerWidth > 768
                    ) {
                        return;
                    }

                    /*
                     * Mobile / touch:
                     * open the dropdown instead of navigating.
                     */
                    e.preventDefault();

                    const parent =
                        this.parentElement;

                    const willOpen =
                        !parent.classList.contains('open');

                    closeAllDropdowns(parent);

                    parent.classList.toggle(
                        'open',
                        willOpen
                    );
                });

            });
    }


    /* =====================================================
       CLOSE DROPDOWNS WHEN CLICKING OUTSIDE
    ===================================================== */

    document.addEventListener('click', function (e) {

        if (!mainNav) return;

        if (!e.target.closest('.dropdown')) {
            closeAllDropdowns();
        }

    });


    /* =====================================================
       CLOSE MOBILE NAV AFTER NORMAL LINK CLICK
    ===================================================== */

    if (mainNav) {

        mainNav
            .querySelectorAll('> a')
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
    }


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

            closeAllDropdowns();
        }

    });

});
</script>
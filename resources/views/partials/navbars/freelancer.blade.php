<!-- resources/views/components/navbar.blade.php -->
<header class="site-header">

    <!-- =========================================================
         ROW 1: LOGO / ACTIONS
    ========================================================== -->
    <div class="container header-top">

        <!-- LOGO -->
        <a href="{{ route('dashboard') }}" class="logo" aria-label="Tech Leaders Network Home">
            <span class="logo-mark" aria-hidden="true">
                <img src="{{ asset('assets/img/logo1.png') }}" alt="Tech Leaders Network Logo">
            </span>
        </a>

        <!-- HEADER ACTIONS -->
        <div class="header-actions">

            <!-- Notifications -->
            <a href="#" class="action-item" aria-label="Notifications (3 unread)">
                <i class="fa-regular fa-bell"></i>
                <span>Notifications</span>
                <span class="pill-badge">3</span>
            </a>
             {{-- View Articles (pill with label) --}}
            <a href="{{ route('freelancer.articles.index') }}" class="action-item action-item--label">
                <i class="fa-solid fa-file-lines"></i>
                <span>View Articles</span>
            </a>
            <!-- ACCOUNT / SETTINGS MENU -->
            <div class="settings-menu-wrap">

                <button class="settings-top-btn" id="accountBtn" type="button" aria-expanded="false"
                    aria-haspopup="true" aria-controls="accountDropdown" aria-label="Account menu">
                    <span class="settings-icon-circle">
                        {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                    </span>

                    <span class="account-info">
                        <span class="settings-top-label">{{ Auth::user()->name ?? 'Account' }}</span>
                        <span class="account-role">{{ Auth::user()->role ?? 'Member' }}</span>
                    </span>

                    <i class="fa-solid fa-chevron-down arrow" id="accountArrow" aria-hidden="true"></i>
                </button>

                <!-- ACCOUNT DROPDOWN (Profile + Logout live here) -->
                <div class="settings-top-dropdown" id="accountDropdown" role="menu">

                    <div class="dropdown-header">
                        <div class="dropdown-avatar">
                            {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                        </div>
                        <div class="dropdown-user-info">
                            <span class="dropdown-name">{{ Auth::user()->name ?? 'User' }}</span>
                            <span class="dropdown-email">{{ Auth::user()->email ?? 'user@example.com' }}</span>
                        </div>
                    </div>

                    <div class="dropdown-body">
                        <a href="{{ route('profile') }}" class="dropdown-item" role="menuitem">
                            <i class="fa-solid fa-user"></i>
                            <span>My Profile</span>
                            <i class="fa-solid fa-chevron-right dropdown-arrow" aria-hidden="true"></i>
                        </a>
                    </div>

                    <form method="POST" action="{{ route('membership-logout') }}" class="dropdown-footer">
                        @csrf
                        <button type="submit" class="dropdown-item logout-item" role="menuitem">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span>Logout</span>
                            <i class="fa-solid fa-chevron-right dropdown-arrow" aria-hidden="true"></i>
                        </button>
                    </form>

                </div>
            </div>

            <!-- MOBILE MENU BUTTON -->
            <button class="nav-toggle" id="navToggle" type="button" aria-label="Toggle navigation"
                aria-expanded="false" aria-controls="mainNav">
                <span></span>
                <span></span>
                <span></span>
            </button>

        </div>
    </div>


    <!-- =========================================================
         ROW 2: MAIN NAVIGATION
    ========================================================== -->
    <div class="header-bottom">
        <div class="container header-bottom-inner">

            <nav class="main-nav" id="mainNav" aria-label="Primary">

                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-house"></i>
                    <span>Home</span>
                </a>

                <a href="{{ route('freelancer.job') }}"
                    class="{{ request()->routeIs('freelancer.job') ? 'active' : '' }}">
                    <i class="fa-solid fa-briefcase"></i>
                    <span>Jobs</span>
                </a>

                {{-- My Services (with dropdown) --}}
                <div class="dropdown">
                    <a href="{{ route('freelancer.services.index') }}"
                        class="{{ request()->routeIs('freelancer.services.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-handshake"></i>
                        <span>My Services</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route('freelancer.services.index') }}">
                                <i class="fa-solid fa-list"></i>  Services
                            </a>
                        </li>
                          <li>
                            <a href="{{ route('freelancer.inquiries.index') }}">
                                <i class="fa-solid fa-plus"></i>  Inquiries
                            </a>
                        </li>
                    </ul>
                </div>

                <a href="{{ route('events') }}" class="{{ request()->routeIs('events') ? 'active' : '' }}">
                    <i class="fa-solid fa-calendar"></i>
                    <span>Events</span>
                </a>
                <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">
                    <i class="fa-solid fa-envelope"></i>
                    <span>Contact</span>
                </a>
                <a href="{{ route('freelancer.signed-jobs') }}"
                    class="{{ request()->routeIs('freelancer.signed-jobs') ? 'active' : '' }}">
                    <i class="fa-solid fa-briefcase"></i>
                    <span>My Jobs</span>
                </a>

            </nav>

        </div>
    </div>

</header>


<style>
    /* =========================================================
       TECH LEADERS NETWORK - HEADER (TWO-ROW STYLE)
    ========================================================= */

    :root {
        --tln-primary: #3364d7;
        --tln-primary-dark: #2f57c9;
        --tln-primary-light: #eaf0ff;
        --tln-text-dark: #111827;
        --tln-text-mid: #374151;
        --tln-text-muted: #6b7280;
        --tln-border: rgba(0, 0, 0, 0.07);
        --tln-surface: #F7F9FF;
        --tln-white: #ffffff;
        --tln-radius: 12px;
        --tln-radius-sm: 8px;
        --tln-shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.06);
        --tln-shadow-md: 0 8px 28px rgba(17, 24, 39, 0.10);
        --tln-shadow-lg: 0 20px 50px rgba(17, 24, 39, 0.18);
        --tln-transition: 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .site-header {
        background: var(--tln-surface);
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.05);
        position: sticky;
        top: 0;
        z-index: 1000;
        font-family: "Inter", "Segoe UI", system-ui, -apple-system, sans-serif;
        border-bottom: 1px solid var(--tln-border);
        backdrop-filter: saturate(180%) blur(6px);
    }

    .site-header .container {
        max-width: 1440px;
        width: 100%;
        margin: 0 auto;
        padding: 0 32px;
        box-sizing: border-box;
    }

    /* ---------- Header top ---------- */
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

    /* ---------- Logo ---------- */
    .logo {
        display: flex;
        align-items: center;
        text-decoration: none;
        flex-shrink: 0;
        height: 60px;
        transition: transform var(--tln-transition);
    }

    .logo:hover {
        transform: translateY(-1px);
    }

    .logo-mark {
        width: 175px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        flex-shrink: 0;
        overflow: visible;
        border-radius: var(--tln-radius-sm);
    }

    .logo-mark img {
        width: 175px;
        height: 82px;
        object-fit: contain;
        display: block;
    }

    /* ---------- Header actions ---------- */
    .header-actions {
        display: flex;
        align-items: center;
        gap: 34px;
        flex-shrink: 0;
        margin-left: auto;
        position: relative;
        z-index: 2;
        /* keep above any accidental overlay */
    }

    .action-item {
        position: relative;
        display: flex;
        align-items: center;
        gap: 9px;
        text-decoration: none;
        color: var(--tln-text-mid);
        font-size: 0.87rem;
        font-weight: 500;
        padding: 8px 12px;
        border-radius: var(--tln-radius-sm);
        transition: color var(--tln-transition), background var(--tln-transition);
    }

    .action-item i {
        font-size: 17px;
        color: #4b5563;
        transition: color var(--tln-transition), transform var(--tln-transition);
    }

    .action-item:hover {
        color: var(--tln-primary);
        background: rgba(51, 100, 215, 0.06);
    }

    .action-item:hover i {
        color: var(--tln-primary);
        transform: translateY(-1px);
    }

    .pill-badge {
        position: absolute;
        top: 0;
        right: 2px;
        background: linear-gradient(135deg, #3364d7, #2f57c9);
        color: #ffffff;
        font-size: 0.62rem;
        font-weight: 700;
        min-width: 17px;
        height: 17px;
        border-radius: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 4px;
        box-shadow: 0 0 0 2px var(--tln-surface);
        animation: pulseBadge 2.5s ease-in-out infinite;
    }

    @keyframes pulseBadge {

        0%,
        100% {
            box-shadow: 0 0 0 2px var(--tln-surface), 0 0 0 0 rgba(51, 100, 215, 0.4);
        }

        50% {
            box-shadow: 0 0 0 2px var(--tln-surface), 0 0 0 5px rgba(51, 100, 215, 0);
        }
    }

    /* ---------- Account button ---------- */
    .settings-menu-wrap {
        position: relative;
        z-index: 1001;
        /* above header-actions */
    }

    .settings-top-btn {
        display: flex;
        align-items: center;
        gap: 10px;
        border: none;
        background: transparent;
        cursor: pointer;
        padding: 5px 8px;
        border-radius: var(--tln-radius);
        font-family: inherit;
        pointer-events: auto;
        /* ensure clickable even if parent has issues */
        position: relative;
        z-index: 1;
        transition: background var(--tln-transition);
    }

    .settings-top-btn:hover {
        background: rgba(51, 100, 215, 0.06);
    }

    .settings-top-btn:focus-visible {
        outline: 2px solid var(--tln-primary);
        outline-offset: 2px;
    }

    .settings-icon-circle {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: linear-gradient(135deg, #3364d7, #2f57c9);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 16px;
        font-weight: 700;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(51, 100, 215, 0.28);
        transition: transform var(--tln-transition), box-shadow var(--tln-transition);
    }

    .settings-top-btn:hover .settings-icon-circle {
        transform: scale(1.05);
        box-shadow: 0 6px 16px rgba(51, 100, 215, 0.38);
    }

    .account-info {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        line-height: 1.2;
        min-width: 0;
    }

    .settings-top-label {
        font-weight: 600;
        font-size: 0.9rem;
        color: var(--tln-text-dark);
        white-space: nowrap;
        max-width: 140px;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .account-role {
        font-size: 0.68rem;
        color: var(--tln-text-muted);
        text-transform: uppercase;
        letter-spacing: 0.6px;
        font-weight: 600;
    }

    .settings-top-btn .arrow {
        font-size: 11px;
        color: #9ca3af;
        margin-left: 2px;
        transition: transform var(--tln-transition), color var(--tln-transition);
    }

    .settings-top-btn:hover .arrow {
        color: var(--tln-primary);
    }

    .settings-top-btn.open .arrow {
        transform: rotate(180deg);
        color: var(--tln-primary);
    }

    /* ---------- Account dropdown ---------- */
    .settings-top-dropdown {
        position: absolute;
        right: 0;
        top: calc(100% + 14px);
        width: 280px;
        background: var(--tln-white);
        border-radius: 16px;
        box-shadow: var(--tln-shadow-lg);
        display: none;
        overflow: hidden;
        z-index: 999;
        border: 1px solid var(--tln-border);
        transform-origin: top right;
    }

    .settings-top-dropdown.show {
        display: block;
        animation: dropdownIn 0.22s cubic-bezier(0.16, 1, 0.3, 1);
    }

    @keyframes dropdownIn {
        from {
            opacity: 0;
            transform: translateY(-10px) scale(0.97);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .dropdown-header {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 18px;
        background: linear-gradient(135deg, #f5f8ff, #eef3ff);
        border-bottom: 1px solid var(--tln-border);
        position: relative;
    }

    .dropdown-header::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at top right, rgba(51, 100, 215, 0.08), transparent 70%);
        pointer-events: none;
    }

    .dropdown-avatar {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: linear-gradient(135deg, #3364d7, #2f57c9);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-weight: 700;
        font-size: 16px;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(51, 100, 215, 0.28);
        position: relative;
        z-index: 1;
    }

    .dropdown-user-info {
        display: flex;
        flex-direction: column;
        min-width: 0;
        position: relative;
        z-index: 1;
    }

    .dropdown-name {
        font-weight: 600;
        color: var(--tln-text-dark);
        font-size: 0.92rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .dropdown-email {
        font-size: 0.78rem;
        color: var(--tln-text-muted);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin-top: 2px;
    }

    .dropdown-body {
        padding: 6px 0;
    }

    .dropdown-footer {
        border-top: 1px solid var(--tln-border);
        padding: 6px 0;
        margin: 0;
    }

    .dropdown-item {
        display: flex;
        align-items: center;
        gap: 12px;
        width: 100%;
        padding: 12px 18px;
        text-decoration: none;
        color: var(--tln-text-mid);
        background: none;
        border: none;
        text-align: left;
        cursor: pointer;
        font-size: 0.87rem;
        font-weight: 500;
        font-family: inherit;
        box-sizing: border-box;
        transition: background var(--tln-transition), color var(--tln-transition), padding-left var(--tln-transition);
    }

    .dropdown-item i {
        width: 18px;
        text-align: center;
        color: var(--tln-primary);
        font-size: 14px;
        transition: color var(--tln-transition), transform var(--tln-transition);
    }

    .dropdown-item:hover {
        background: rgba(51, 100, 215, 0.07);
        color: var(--tln-primary);
        padding-left: 22px;
    }

    .dropdown-item:hover i {
        color: var(--tln-primary);
    }

    .dropdown-item:hover i:first-child {
        transform: scale(1.1);
    }

    .dropdown-item .dropdown-arrow {
        margin-left: auto;
        font-size: 11px;
        opacity: 0;
        transform: translateX(-6px);
        transition: all var(--tln-transition);
        color: #9ca3af;
    }

    .dropdown-item:hover .dropdown-arrow {
        opacity: 1;
        transform: translateX(0);
        color: var(--tln-primary);
    }

    .logout-item {
        color: #dc2626;
    }

    .logout-item i {
        color: #dc2626;
    }

    .logout-item:hover {
        background: rgba(220, 38, 38, 0.07);
        color: #b91c1c;
    }

    .logout-item:hover i {
        color: #b91c1c;
    }

    /* ---------- Blue navigation bar ---------- */
    .header-bottom {
        width: 100%;
        background: linear-gradient(90deg, #2f57c9 0%, #3364d7 50%, #3a6ee0 100%);
        padding: 0;
        box-shadow: inset 0 -1px 0 rgba(255, 255, 255, 0.08), 0 4px 20px rgba(47, 87, 201, 0.15);
        position: relative;
        display: block;
    }

    .header-bottom::after {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse at top, rgba(255, 255, 255, 0.06), transparent 60%);
        pointer-events: none;
    }

    .header-bottom-inner {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 54px;
        position: relative;
        z-index: 1;
    }

    .main-nav {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        flex-wrap: wrap;
        width: 100%;
    }

    /* Top-level links: plain links AND dropdown parent links */
    .main-nav>a,
    .dropdown>a {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        text-decoration: none;
        font-weight: 500;
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.82);
        padding: 10px 18px;
        margin: 5px 0;
        white-space: nowrap;
        position: relative;
        border-radius: 10px;
        cursor: pointer;
        transition: background var(--tln-transition), color var(--tln-transition), transform var(--tln-transition);
    }

    .main-nav>a i,
    .dropdown>a>i {
        font-size: 13px;
        color: rgba(255, 255, 255, 0.65);
        transition: color var(--tln-transition), transform var(--tln-transition);
    }

    .main-nav>a:hover,
    .dropdown>a:hover,
    .dropdown:hover>a {
        color: #ffffff;
        background: rgba(255, 255, 255, 0.14);
        transform: translateY(-1px);
    }

    .main-nav>a:hover i,
    .dropdown>a:hover i,
    .dropdown:hover>a i {
        color: #ffffff;
        transform: scale(1.08);
    }

    .main-nav>a:focus-visible,
    .dropdown>a:focus-visible {
        outline: 2px solid #ffffff;
        outline-offset: 2px;
    }

    .main-nav>a.active,
    .dropdown>a.active {
        color: #1f2937;
        font-weight: 600;
        background: #ffffff;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.12), 0 1px 3px rgba(0, 0, 0, 0.08);
    }

    .main-nav>a.active i,
    .dropdown>a.active i {
        color: var(--tln-primary);
    }

    /* ---------- Nav dropdown menus ---------- */
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        top: 100%;
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

    /* invisible bridge so :hover survives the gap under the link */
    .dropdown-menu::before {
        content: "";
        position: absolute;
        left: 0;
        right: 0;
        top: -12px;
        height: 12px;
    }

    .dropdown-menu li {
        margin: 0;
    }

    .dropdown-menu li a {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 12px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 500;
        color: #1f2937;
        white-space: nowrap;
        transition: background var(--tln-transition), color var(--tln-transition);
    }

    .dropdown-menu li a i {
        width: 14px;
        text-align: center;
        font-size: 12px;
        color: #9ca3af;
    }

    .dropdown-menu li a:hover {
        background: #eef2ff;
        color: var(--tln-primary);
    }

    .dropdown-menu li a:hover i {
        color: var(--tln-primary);
    }

    /* open on hover (mouse) or via JS .open (touch) */
    @media (hover: hover) and (pointer: fine) {
        .dropdown:hover>.dropdown-menu {
            display: block;
        }
    }

    .dropdown.open>.dropdown-menu {
        display: block;
    }

    /* ---------- Mobile toggle ---------- */
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
        border-radius: var(--tln-radius-sm);
        transition: background var(--tln-transition);
    }

    .nav-toggle:hover {
        background: rgba(51, 100, 215, 0.08);
    }

    .nav-toggle span {
        display: block;
        width: 22px;
        height: 2px;
        background: var(--tln-text-mid);
        border-radius: 2px;
        transition: transform var(--tln-transition), opacity var(--tln-transition), background var(--tln-transition);
    }

    .nav-toggle[aria-expanded="true"] span:nth-child(1) {
        transform: translateY(7px) rotate(45deg);
    }

    .nav-toggle[aria-expanded="true"] span:nth-child(2) {
        opacity: 0;
        transform: scaleX(0);
    }

    .nav-toggle[aria-expanded="true"] span:nth-child(3) {
        transform: translateY(-7px) rotate(-45deg);
    }

    /* ---------- Tablet ---------- */
    @media (max-width: 1100px) {
        .main-nav {
            gap: 4px;
        }

        .main-nav>a,
        .dropdown>a {
            padding: 10px 13px;
            font-size: 0.82rem;
        }

        .header-actions {
            gap: 20px;
        }
    }

    @media (max-width: 900px) {

        .action-item span:not(.pill-badge),
        .account-info {
            display: none;
        }

        .header-actions {
            gap: 16px;
        }

        .logo-mark,
        .logo-mark img {
            width: 150px;
        }

        .main-nav {
            gap: 2px;
        }

        .main-nav>a,
        .dropdown>a {
            padding: 10px 11px;
            font-size: 0.78rem;
        }
    }

    /* ---------- Mobile ---------- */
    @media (max-width: 768px) {
        .header-top {
            height: 70px;
            gap: 16px;
            padding: 8px 32px;
        }

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

        .nav-toggle {
            display: flex;
        }

        .header-bottom {
            display: none;
            animation: slideDown 0.25s ease;
        }

        .header-bottom.open {
            display: block;
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

        .header-bottom-inner {
            display: block;
            min-height: auto;
            padding: 10px 32px 14px;
        }

        .main-nav {
            flex-direction: column;
            align-items: stretch;
            justify-content: flex-start;
            gap: 4px;
            padding: 0;
        }

        .main-nav>a,
        .dropdown>a {
            width: 100%;
            margin: 2px 0;
            padding: 13px 16px;
            justify-content: flex-start;
            box-sizing: border-box;
            border-radius: var(--tln-radius-sm);
        }

        .dropdown {
            display: block;
            width: 100%;
        }

        .dropdown-menu,
        .dropdown:hover>.dropdown-menu {
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

        .dropdown.open>.dropdown-menu {
            display: block;
        }

        .dropdown-menu::before {
            display: none;
        }

        .dropdown-menu li a {
            color: #ffffff;
        }

        .dropdown-menu li a i {
            color: rgba(255, 255, 255, 0.7);
        }

        .dropdown-menu li a:hover {
            background: rgba(255, 255, 255, 0.12);
            color: #ffffff;
        }

        .dropdown-menu li a:hover i {
            color: #ffffff;
        }
    }

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

        .header-bottom-inner {
            padding: 10px 16px 14px;
        }

        .main-nav>a,
        .dropdown>a {
            padding: 12px 14px;
            font-size: 0.84rem;
        }
    }

    @media (max-width: 360px) {

        .logo-mark,
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

    /* ---------- Reduced motion ---------- */
    @media (prefers-reduced-motion: reduce) {

        *,
        *::before,
        *::after {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
        }
    }
</style>

<script>
    (function() {
        function initNavbar() {
            /* ---------- Account dropdown (event delegation) ---------- */
            const accountDropdown = document.getElementById('accountDropdown');

            function closeAccountDropdown() {
                if (!accountDropdown) return;
                accountDropdown.classList.remove('show');
                const btn = document.getElementById('accountBtn');
                if (btn) {
                    btn.classList.remove('open');
                    btn.setAttribute('aria-expanded', 'false');
                }
            }

            function openAccountDropdown() {
                if (!accountDropdown) return;
                accountDropdown.classList.add('show');
                const btn = document.getElementById('accountBtn');
                if (btn) {
                    btn.classList.add('open');
                    btn.setAttribute('aria-expanded', 'true');
                }
            }

            // Delegate: works even if the button is re-rendered.
            document.addEventListener('click', function(e) {
                const btn = e.target.closest('#accountBtn');
                if (btn) {
                    e.preventDefault();
                    e.stopPropagation();
                    const isOpen = accountDropdown && accountDropdown.classList.contains('show');
                    if (isOpen) closeAccountDropdown();
                    else openAccountDropdown();
                    return;
                }

                // Click outside → close
                if (accountDropdown && accountDropdown.classList.contains('show')) {
                    if (!accountDropdown.contains(e.target)) {
                        closeAccountDropdown();
                    }
                }
            });

            // Escape closes
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeAccountDropdown();
                }
            });

            /* ---------- Mobile navigation ---------- */
            document.addEventListener('click', function(e) {
                const toggle = e.target.closest('#navToggle');
                if (toggle) {
                    const headerBottom = document.querySelector('.header-bottom');
                    if (!headerBottom) return;
                    const isOpen = headerBottom.classList.toggle('open');
                    toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                }
            });

            // Close mobile nav after a normal link or a submenu link is clicked
            document.addEventListener('click', function(e) {
                const link = e.target.closest('.main-nav > a, .main-nav .dropdown-menu a');
                if (link && window.innerWidth <= 768) {
                    const headerBottom = document.querySelector('.header-bottom');
                    const navToggle = document.getElementById('navToggle');
                    headerBottom?.classList.remove('open');
                    navToggle?.setAttribute('aria-expanded', 'false');
                }
            });

            /* ---------- Nav dropdowns (My Services) ---------- */
            const isHoverDevice = () =>
                window.matchMedia('(hover: hover) and (pointer: fine)').matches;

            function closeAllDropdowns(except = null) {
                document.querySelectorAll('.main-nav .dropdown.open').forEach(function(dd) {
                    if (dd !== except) dd.classList.remove('open');
                });
            }

            document.addEventListener('click', function(e) {
                const link = e.target.closest('.main-nav .dropdown > a');

                if (link) {
                    // Desktop mouse: normal navigation (menu opens on hover)
                    if (isHoverDevice() && window.innerWidth > 768) return;

                    // Touch / mobile: toggle submenu instead of navigating
                    e.preventDefault();
                    const parent = link.parentElement;
                    const willOpen = !parent.classList.contains('open');
                    closeAllDropdowns(parent);
                    parent.classList.toggle('open', willOpen);
                    return;
                }

                // Click outside any dropdown → close all
                if (!e.target.closest('.dropdown')) closeAllDropdowns();
            });

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') closeAllDropdowns();
            });

            // Reset mobile nav on desktop resize
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    document.querySelector('.header-bottom')?.classList.remove('open');
                    document.getElementById('navToggle')?.setAttribute('aria-expanded', 'false');
                    closeAllDropdowns();
                }
            });

            /* ---------- Scroll shadow ---------- */
            const siteHeader = document.querySelector('.site-header');
            if (siteHeader) {
                window.addEventListener('scroll', function() {
                    if (window.pageYOffset > 10) {
                        siteHeader.style.boxShadow = '0 6px 28px rgba(0, 0, 0, 0.10)';
                    } else {
                        siteHeader.style.boxShadow = '0 2px 20px rgba(0, 0, 0, 0.05)';
                    }
                }, {
                    passive: true
                });
            }
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initNavbar);
        } else {
            initNavbar();
        }
    })();
</script>
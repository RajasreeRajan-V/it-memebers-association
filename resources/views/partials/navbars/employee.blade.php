<!-- Updated Site Header -->

<header class="site-header">
    <div class="container header-inner">
        <a href="#" class="logo">
            <span class="logo-mark" aria-hidden="true">
                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15 2L27 8.5V21.5L15 28L3 21.5V8.5L15 2Z" fill="url(#lg)" />
                    <path d="M15 9L20 12V18L15 21L10 18V12L15 9Z" fill="white" fill-opacity="0.9" />
                    <defs>
                        <linearGradient id="lg" x1="3" y1="2" x2="27" y2="28"
                            gradientUnits="userSpaceOnUse">
                            <stop stop-color="#4F46E5" />
                            <stop offset="1" stop-color="#2080D4" />
                        </linearGradient>
                    </defs>
                </svg>
            </span>
            SkillConnect
        </a>

        <nav class="main-nav" aria-label="Primary">
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
           <a href="{{ route('employee.jobs.index') }}"
   class="{{ request()->routeIs('employee.jobs.*') ? 'active' : '' }}">
    Jobs
</a>
            <a href="{{ route('employee.articles.index') }}" class="{{ request()->routeIs('employee.articles.*') ? 'active' : '' }}">Articles</a>

            <a href="">Training & Webinars</a>
            <a href="{{ route('employee.legal-help.index') }}" class="{{ request()->routeIs('employee.legal-help.*') ? 'active' : '' }}">Legal help</a>
          
           <a href="">Workspace Support</a>
        </nav>

        <div class="header-actions">
            <div class="account-menu">
                <button class="account-btn" id="accountBtn">
                    <div class="avatar-wrapper">
                        <span class="avatar">
                            {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                        </span>
                        <span class="status-indicator"></span>
                    </div>
                    <div class="account-info">
                        <span class="account-name">
                            {{ Auth::user()->name ?? 'Account' }}
                        </span>
                        <span class="account-role">
                            {{ Auth::user()->role ?? 'Member' }}
                        </span>
                    </div>
                    <span class="arrow">
                        <i class="fa-solid fa-chevron-down"></i>
                    </span>
                </button>

                <div class="account-dropdown" id="accountDropdown">
                    <div class="dropdown-header">
                        <div class="dropdown-avatar">
                            {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                        </div>
                        <div class="dropdown-user-info">
                            <span class="dropdown-name">{{ Auth::user()->name ?? 'User' }}</span>
                            <span class="dropdown-email">{{ Auth::user()->email ?? 'user@example.com' }}</span>
                        </div>
                    </div>

                    <div class="dropdown-divider"></div>

                    <a href="{{ route('profile') }}" class="dropdown-item">
                        <i class="fa-solid fa-user"></i>
                        <span>My Profile</span>
                        <i class="fa-solid fa-chevron-right dropdown-arrow"></i>
                    </a>

                    <a href="#" class="dropdown-item">
                        <i class="fa-solid fa-gear"></i>
                        <span>Account Settings</span>
                        <i class="fa-solid fa-chevron-right dropdown-arrow"></i>
                    </a>

                    <a href="#" class="dropdown-item">
                        <i class="fa-solid fa-bell"></i>
                        <span>Notifications</span>
                        <span class="badge">3</span>
                    </a>

                    <div class="dropdown-divider"></div>

                    <form method="POST" action="{{ route('membership-logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item logout-item">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span>Logout</span>
                            <i class="fa-solid fa-chevron-right dropdown-arrow"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <button class="nav-toggle" id="navToggle" aria-label="Toggle menu" aria-expanded="false">
            <span></span><span></span><span></span>
        </button>
    </div>
</header>

<style>
    /* ===== Header Styles ===== */
    .site-header {
        background: #3364d7;
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.15);
        position: sticky;
        top: 0;
        z-index: 1000;
        padding: 10px 0;
        font-family: "Inter", "Segoe UI", system-ui, -apple-system, sans-serif;
    }

    .header-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
        max-width: 1440px;
        width: 100%;
        margin: 0 auto;
        padding: 0 32px;
    }

    .logo {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 1.25rem;
        font-weight: 700;
        color: #ffffff;
        text-decoration: none;
        letter-spacing: -0.3px;
        flex-shrink: 0;
    }

    .logo-mark {
        display: flex;
        align-items: center;
    }

    .main-nav {
        display: flex;
        align-items: center;
        gap: 32px;
        flex: 1;
        justify-content: center;
    }

    .main-nav a {
        text-decoration: none;
        font-weight: 500;
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.85);
        transition: color 0.25s ease;
        position: relative;
        padding: 6px 2px;
        letter-spacing: 0.1px;
    }

    .main-nav a:hover {
        color: #ffffff;
    }

    .main-nav a.active {
        color: #ffffff;
        font-weight: 600;
    }

    .main-nav a.active::after {
        content: '';
        position: absolute;
        left: 0;
        right: 0;
        bottom: -4px;
        height: 2px;
        background: #ffffff;
        border-radius: 2px;
    }

    .header-actions {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-shrink: 0;
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
        height: 2px;
        background: #ffffff;
        border-radius: 2px;
        transition: 0.3s;
    }

    /* Responsive header */
    @media (max-width: 1100px) {
        .main-nav {
            gap: 18px;
        }

        .main-nav a {
            font-size: 0.85rem;
        }
    }

    @media (max-width: 768px) {
        .main-nav {
            display: none;
            position: absolute;
            top: 66px;
            left: 0;
            right: 0;
            background: #274ea3;
            flex-direction: column;
            padding: 20px 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            gap: 16px;
        }

        .main-nav.open {
            display: flex;
        }

        .main-nav a {
            color: rgba(255, 255, 255, 0.85);
            font-size: 0.95rem;
            padding: 8px 0;
        }

        .nav-toggle {
            display: flex;
        }

        .account-name {
            display: none;
        }

        .account-role {
            display: none;
        }

        .account-btn {
            padding: 6px 10px;
        }
    }

    @media (max-width: 480px) {
        .header-inner {
            flex-wrap: wrap;
            gap: 10px;
            padding: 0 16px;
        }

        .logo {
            font-size: 1.05rem;
        }

        .header-actions {
            gap: 8px;
        }
    }

    /* ===== Account Menu ===== */
    .account-menu {
        position: relative;
    }

    .account-btn {
        display: flex;
        align-items: center;
        gap: 12px;
        border: none;
        background: rgba(255, 255, 255, 0.1);
        color: #fff;
        padding: 6px 16px 6px 8px;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.25s ease;
        border: 1px solid rgba(255, 255, 255, 0.12);
    }

    .account-btn:hover {
        background: rgba(255, 255, 255, 0.18);
        border-color: rgba(255, 255, 255, 0.22);
    }

    .avatar-wrapper {
        position: relative;
        flex-shrink: 0;
    }

    .avatar {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: #274ea3;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 13px;
        letter-spacing: 0.3px;
        text-transform: uppercase;
    }

    .status-indicator {
        position: absolute;
        bottom: 0;
        right: 0;
        width: 9px;
        height: 9px;
        background: #22c55e;
        border-radius: 50%;
        border: 2px solid #3364d7;
    }

    .account-info {
        display: flex;
        flex-direction: column;
        line-height: 1.25;
        min-width: 0;
    }

    .account-name {
        font-weight: 600;
        font-size: 0.85rem;
        color: #ffffff;
        white-space: nowrap;
    }

    .account-role {
        font-size: 0.7rem;
        color: rgba(255, 255, 255, 0.65);
        text-transform: uppercase;
        letter-spacing: 0.4px;
        font-weight: 500;
    }

    .arrow {
        font-size: 10px;
        color: rgba(255, 255, 255, 0.6);
        margin-left: 4px;
        transition: transform 0.25s ease;
    }

    .account-btn:hover .arrow {
        transform: rotate(180deg);
    }

    /* ===== Account Dropdown ===== */
    .account-dropdown {
        position: absolute;
        right: 0;
        top: calc(100% + 10px);
        width: 280px;
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

    .account-dropdown.show {
        display: block;
    }

    .dropdown-header {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 18px 20px 14px 20px;
        background: #ffffff;
    }

    .dropdown-avatar {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: #274ea3;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 15px;
        text-transform: uppercase;
        flex-shrink: 0;
    }

    .dropdown-user-info {
        display: flex;
        flex-direction: column;
        min-width: 0;
    }

    .dropdown-name {
        font-weight: 600;
        color: #111827;
        font-size: 0.9rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .dropdown-email {
        font-size: 0.78rem;
        color: #6b7280;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .dropdown-divider {
        height: 1px;
        background: rgba(0, 0, 0, 0.08);
        margin: 0 16px;
    }

    .dropdown-item {
        display: flex;
        align-items: center;
        gap: 12px;
        width: 100%;
        padding: 12px 20px;
        text-decoration: none;
        color: #111827;
        background: none;
        border: none;
        text-align: left;
        cursor: pointer;
        font-size: 0.87rem;
        font-weight: 500;
        transition: all 0.2s ease;
        position: relative;
    }

    .dropdown-item i {
        width: 18px;
        text-align: center;
        color: #6b7280;
        font-size: 14px;
        transition: color 0.2s ease;
    }

    .dropdown-item:hover {
        background: rgba(0, 0, 0, 0.04);
        color: #000000;
    }

    .dropdown-item:hover i {
        color: #3364d7;
    }

    .dropdown-item .badge {
        margin-left: auto;
        background: #3364d7;
        color: white;
        font-size: 0.68rem;
        font-weight: 600;
        padding: 2px 10px;
        border-radius: 50px;
        letter-spacing: 0.3px;
    }

    .dropdown-arrow {
        margin-left: auto;
        font-size: 12px !important;
        opacity: 0;
        transform: translateX(-5px);
        transition: all 0.2s ease;
    }

    .dropdown-item:hover .dropdown-arrow {
        opacity: 1;
        transform: translateX(0);
        color: #9ca3af !important;
    }

    .logout-item {
        color: #dc2626;
    }

    .logout-item i {
        color: #dc2626;
        opacity: 0.7;
    }

    .logout-item:hover {
        background: rgba(220, 38, 38, 0.06);
        color: #dc2626;
    }

    .logout-item:hover i {
        color: #dc2626 !important;
        opacity: 1;
    }
</style>
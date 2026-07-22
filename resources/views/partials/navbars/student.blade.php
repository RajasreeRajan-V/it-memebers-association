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
                            <stop offset="1" stop-color="#14B8A6" />
                        </linearGradient>
                    </defs>
                </svg>
            </span>
            SkillConnect
        </a>

        <nav class="main-nav" aria-label="Primary">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a>
            <a href="{{ route('events') }}" class="{{ request()->routeIs('events') ? 'active' : '' }}">events</a>
            <a href="{{ route('FAQs') }}" class="{{ request()->routeIs('FAQs') ? 'active' : '' }}">FAQs</a>
            <a href="{{ route('members') }}" class="{{ request()->routeIs('members') ? 'active' : '' }}">How to be a
                Member</a>
            <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
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
        background: #0F172A;
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.3);
        position: sticky;
        top: 0;
        z-index: 1000;
        padding: 8px 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.06);
    }

    .header-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .logo {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 1.4rem;
        font-weight: 800;
        color: #ffffff;
        text-decoration: none;
        letter-spacing: -0.5px;
    }

    .logo-mark {
        display: flex;
        align-items: center;
    }

    .main-nav {
        display: flex;
        align-items: center;
        gap: 28px;
    }

    .main-nav a {
        text-decoration: none;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.75);
        transition: color 0.3s;
        position: relative;
        padding: 6px 2px;
    }

    .main-nav a:hover {
        color: #ffffff;
    }

    .main-nav a.active {
        color: #ffffff;
    }

    .main-nav a.active::after {
        content: '';
        position: absolute;
        left: 0;
        right: 0;
        bottom: -4px;
        height: 2px;
        background: linear-gradient(135deg, #4F46E5, #14B8A6);
        border-radius: 2px;
    }

    .header-actions {
        display: flex;
        align-items: center;
        gap: 12px;
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
    @media (max-width: 1024px) {
        .main-nav {
            gap: 16px;
            flex-wrap: wrap;
        }

        .main-nav a {
            font-size: 0.9rem;
        }
    }

    @media (max-width: 768px) {
        .main-nav {
            display: none;
            position: absolute;
            top: 66px;
            left: 0;
            right: 0;
            background: #0F172A;
            flex-direction: column;
            padding: 20px 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            gap: 16px;
        }

        .main-nav.open {
            display: flex;
        }

        .main-nav a {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1rem;
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
        }

        .logo {
            font-size: 1.1rem;
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
        background: rgba(255, 255, 255, 0.06);
        color: #fff;
        padding: 6px 16px 6px 8px;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.08);
    }

    .account-btn:hover {
        background: rgba(255, 255, 255, 0.12);
        border-color: rgba(255, 255, 255, 0.15);
        transform: translateY(-1px);
        box-shadow: 0 4px 15px rgba(79, 70, 229, 0.2);
    }

    .avatar-wrapper {
        position: relative;
        flex-shrink: 0;
    }

    .avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: linear-gradient(135deg, #4F46E5, #14B8A6);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 14px;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        transition: all 0.3s ease;
    }

    .status-indicator {
        position: absolute;
        bottom: 0;
        right: 0;
        width: 10px;
        height: 10px;
        background: #22c55e;
        border-radius: 50%;
        border: 2px solid #0F172A;
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {

        0%,
        100% {
            opacity: 1;
            transform: scale(1);
        }

        50% {
            opacity: 0.7;
            transform: scale(0.9);
        }
    }

    .account-info {
        display: flex;
        flex-direction: column;
        line-height: 1.2;
        min-width: 0;
    }

    .account-name {
        font-weight: 600;
        font-size: 0.9rem;
        color: #ffffff;
        white-space: nowrap;
    }

    .account-role {
        font-size: 0.7rem;
        color: rgba(255, 255, 255, 0.5);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 500;
    }

    .arrow {
        font-size: 10px;
        color: rgba(255, 255, 255, 0.4);
        margin-left: 4px;
        transition: transform 0.3s ease;
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
        background: #1a2332;
        border-radius: 16px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        display: none;
        overflow: hidden;
        z-index: 999;
        border: 1px solid rgba(255, 255, 255, 0.06);
        backdrop-filter: blur(20px);
        animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px) scale(0.98);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
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
        background: rgba(255, 255, 255, 0.03);
    }

    .dropdown-avatar {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: linear-gradient(135deg, #4F46E5, #14B8A6);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 16px;
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
        color: #ffffff;
        font-size: 0.95rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .dropdown-email {
        font-size: 0.8rem;
        color: rgba(255, 255, 255, 0.4);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .dropdown-divider {
        height: 1px;
        background: rgba(255, 255, 255, 0.06);
        margin: 0 16px;
    }

    .dropdown-item {
        display: flex;
        align-items: center;
        gap: 12px;
        width: 100%;
        padding: 12px 20px;
        text-decoration: none;
        color: rgba(255, 255, 255, 0.7);
        background: none;
        border: none;
        text-align: left;
        cursor: pointer;
        font-size: 0.9rem;
        transition: all 0.25s ease;
        position: relative;
    }

    .dropdown-item i {
        width: 18px;
        text-align: center;
        color: rgba(255, 255, 255, 0.3);
        font-size: 15px;
        transition: color 0.25s ease;
    }

    .dropdown-item:hover {
        background: rgba(255, 255, 255, 0.05);
        color: #ffffff;
    }

    .dropdown-item:hover i {
        color: #4F46E5;
    }

    .dropdown-item .badge {
        margin-left: auto;
        background: #4F46E5;
        color: white;
        font-size: 0.7rem;
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
        transition: all 0.25s ease;
    }

    .dropdown-item:hover .dropdown-arrow {
        opacity: 1;
        transform: translateX(0);
        color: rgba(255, 255, 255, 0.3) !important;
    }

    .logout-item {
        color: rgba(239, 68, 68, 0.7);
    }

    .logout-item i {
        color: rgba(239, 68, 68, 0.3);
    }

    .logout-item:hover {
        background: rgba(239, 68, 68, 0.08);
        color: #ef4444;
    }

    .logout-item:hover i {
        color: #ef4444 !important;
    }

    /* Font Awesome fallback - using Unicode as fallback */
    .fa-regular {
        font-family: 'Segoe UI', system-ui, sans-serif;
    }

    /* Adding simple icon fallbacks */
    .dropdown-item i {
        display: inline-block;
        width: 18px;
        text-align: center;
        font-style: normal;
    }
</style>

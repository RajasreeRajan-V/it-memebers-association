<!-- Updated Site Header -->

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<header class="site-header">
    <div class="container header-inner">
        <a href="{{ route('dashboard') }}" class="logo">
            <span class="logo-mark" aria-hidden="true">
                <svg width="18" height="18" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15 2L27 8.5V21.5L15 28L3 21.5V8.5L15 2Z" fill="white" />
                    <path d="M15 9L20 12V18L15 21L10 18V12L15 9Z" fill="#4F46E5" fill-opacity="0.9" />
                </svg>
            </span>
            SkillConnect
        </a>

        <nav class="main-nav" id="mainNav" aria-label="Primary">
            <a href="{{ route('dashboard') }}" class="nav-link">Home</a>

            <div class="dropdown">
                <a href="{{ route('employer.jobs.index') }}" class="nav-link">
                    Jobs
                    <svg class="caret" width="9" height="6" viewBox="0 0 10 6" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('employer.jobs.create') }}">Create Job</a></li>
                    <li><a href="{{ route('employer.jobs.index') }}">View Jobs</a></li>
                </ul>
            </div>

            <div class="dropdown">
                <a href="{{ route('employer.internships.index') }}" class="nav-link">
                    Internships
                    <svg class="caret" width="9" height="6" viewBox="0 0 10 6" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('employer.internships.create') }}">Create Internship</a></li>
                    <li><a href="{{ route('employer.internships.index') }}">View Internships</a></li>
                </ul>
            </div>

            <div class="dropdown">
                <a href="{{ route('employer.projects.index') }}" class="nav-link">
                    Projects
                    <svg class="caret" width="9" height="6" viewBox="0 0 10 6" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('employer.projects.create') }}">Create Project</a></li>
                    <li><a href="{{ route('employer.projects.index') }}">View Projects</a></li>
                </ul>
            </div>

            <div class="dropdown">
                <a href="{{ route('employer.startup-profile.index') }}" class="nav-link">
                    Startup
                    <svg class="caret" width="9" height="6" viewBox="0 0 10 6" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('employer.startup-profile.create') }}">Create Startup</a></li>
                    <li><a href="{{ route('employer.startup-profile.index') }}">View Startups</a></li>
                </ul>

            </div>
            <a href="" class="nav-link">Applicants</a>
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
    * {
        box-sizing: border-box;
    }

    .site-header {
        background: #3364d7;
        border-bottom: 1px solid #eef0f3;
        position: sticky;
        top: 0;
        z-index: 1000;
        font-family: 'Poppins', sans-serif;
    }

    .header-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
        max-width: 1280px;
        margin: 0 auto;
        padding: 16px 24px;
    }

    /* ---- Logo ---- */
    .logo {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 1rem;
        font-weight: 600;
        color: #ffffff;
        text-decoration: none;
        flex-shrink: 0;
    }

    .logo-mark {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 26px;
        height: 26px;
        border-radius: 7px;
        background: #4F46E5;
        flex-shrink: 0;
    }

    /* ---- Main Nav ---- */
    .main-nav {
        display: flex;
        gap: 4px;
        align-items: center;
        flex: 1;
        justify-content: center;
    }

    .main-nav a,
    .nav-link {
        display: flex;
        align-items: center;
        gap: 5px;
        font-family: 'Poppins', sans-serif;
        font-size: 0.9rem;
        font-weight: 500;
        color: #ffffff;
        text-decoration: none;
        padding: 8px 14px;
        border-radius: 6px;
        transition: color 0.2s ease, background 0.2s ease;
        white-space: nowrap;
    }

    .main-nav a:hover,
    .nav-link:hover {
        color: #111827;
        background: #f5f6f8;
    }

    .caret {
        color: #9ca3af;
        transition: transform 0.2s ease;
    }

    .dropdown:hover .caret {
        transform: rotate(180deg);
    }

    /* ---- Nav Dropdown (Jobs/Internships/Projects/Startup) ---- */
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

        min-width: 170px;
        background: #ffffff;
        border: 1px solid #eef0f3;

        border-radius: 10px;
        padding: 6px;

        list-style: none;
        margin: 0;
        box-shadow: 0 12px 28px rgba(17, 24, 39, 0.08);

        overflow: hidden;
        z-index: 1000;
    }

    .dropdown-menu li {
        margin: 0;
    }

    .dropdown-menu li a {
        display: block;
        padding: 9px 12px;

        color: #374151;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        border-radius: 6px;

        transition: background 0.15s ease, color 0.15s ease;
    }

    .dropdown-menu li a:hover {
        background: #f5f3ff;
        color: #4F46E5;
    }

    .dropdown:hover .dropdown-menu {
        display: block;
    }

    /* ---- Header Actions ---- */
    .header-actions {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-shrink: 0;
    }

    .btn-primary {
        background: #4F46E5;
        color: #fff;
        border: none;
        padding: 9px 22px;
        border-radius: 999px;
        font-family: 'Poppins', sans-serif;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-primary:hover {
        background: #4338CA;
        transform: translateY(-1px);
        box-shadow: 0 8px 18px rgba(79, 70, 229, 0.28);
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
        background: rgba(255, 255, 255, 0.12);
        color: #fff;
        padding: 6px 16px 6px 8px;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.18);
    }

    .account-btn:hover {
        background: rgba(255, 255, 255, 0.2);
        border-color: rgba(255, 255, 255, 0.3);
        transform: translateY(-1px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
    }

    .avatar-wrapper {
        position: relative;
        flex-shrink: 0;
    }

    .avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #3364d7;
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
        border: 2px solid #3364d7;
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% {
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
        color: rgba(255, 255, 255, 0.75);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 500;
    }

    .arrow {
        font-size: 10px;
        color: rgba(255, 255, 255, 0.7);
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
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 20px 60px rgba(17, 24, 39, 0.18);
        display: none;
        overflow: hidden;
        z-index: 999;
        border: 1px solid #eef0f3;
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
        background: #f9fafb;
    }

    .dropdown-avatar {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: #3364d7;
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
        color: #111827;
        font-size: 0.95rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .dropdown-email {
        font-size: 0.8rem;
        color: #6b7280;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .dropdown-divider {
        height: 1px;
        background: #eef0f3;
        margin: 0 16px;
    }

    .dropdown-item {
        display: flex;
        align-items: center;
        gap: 12px;
        width: 100%;
        padding: 12px 20px;
        text-decoration: none;
        color: #374151;
        background: none;
        border: none;
        text-align: left;
        cursor: pointer;
        font-size: 0.9rem;
        font-family: 'Poppins', sans-serif;
        transition: all 0.25s ease;
        position: relative;
    }

    .dropdown-item i {
        width: 18px;
        text-align: center;
        color: #9ca3af;
        font-size: 15px;
        transition: color 0.25s ease;
    }

    .dropdown-item:hover {
        background: #f5f3ff;
        color: #4F46E5;
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
        color: #9ca3af !important;
    }

    .logout-item {
        color: #ef4444cc;
    }

    .logout-item i {
        color: rgba(239, 68, 68, 0.5);
    }

    .logout-item:hover {
        background: rgba(239, 68, 68, 0.08);
        color: #ef4444;
    }

    .logout-item:hover i {
        color: #ef4444 !important;
    }

    /* ---- Mobile Toggle ---- */
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
        background: #111827;
        border-radius: 2px;
        transition: 0.3s;
    }

    /* ---- Responsive ---- */
    @media (max-width: 1024px) {

        .main-nav a,
        .nav-link {
            font-size: 0.85rem;
            padding: 8px 10px;
        }
    }

    @media (max-width: 768px) {
        .main-nav {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: #ffffff;
            border-bottom: 1px solid #eef0f3;
            flex-direction: column;
            align-items: stretch;
            padding: 12px;
            box-shadow: 0 10px 30px rgba(17, 24, 39, 0.08);
            gap: 4px;
        }

        .main-nav.open {
            display: flex;
        }

        .dropdown-menu {
            position: static;
            transform: none;
            box-shadow: none;
            border: none;
            background: #f9fafb;
            margin-top: 4px;
            display: none;
        }

        .dropdown.open .dropdown-menu {
            display: block;
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
            padding: 12px 16px;
        }

        .logo {
            font-size: 0.95rem;
        }

        .header-actions {
            gap: 8px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const navToggle = document.getElementById('navToggle');
        const mainNav = document.getElementById('mainNav');

        if (navToggle && mainNav) {
            navToggle.addEventListener('click', function() {
                const expanded = this.getAttribute('aria-expanded') === 'true';
                this.setAttribute('aria-expanded', !expanded);
                mainNav.classList.toggle('open');
            });
        }

        // On mobile, tapping a dropdown label toggles its submenu instead of navigating
        if (mainNav) {
            mainNav.querySelectorAll('.dropdown > a').forEach(function(link) {
                link.addEventListener('click', function(e) {
                    if (window.innerWidth <= 768) {
                        e.preventDefault();
                        this.parentElement.classList.toggle('open');
                    }
                });
            });
        }

     
    });
</script>
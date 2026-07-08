{{-- resources/views/employees/layout/app.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Employee Dashboard')</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @stack('styles')

    <style>
        /* ===== RESET & BASE ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f0f2f5;
            color: #1a1a2e;
            line-height: 1.6;
        }

        /* ===== ADMIN WRAPPER (employee version) ===== */
        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: 260px;
            background: #1a1a2e;
            color: #fff;
            padding: 1.5rem 1rem;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 1000;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 2px 0 12px rgba(0, 0, 0, 0.15);
            overflow-y: auto;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0 0.5rem 1.5rem 0.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            margin-bottom: 1.5rem;
        }

        .sidebar-brand .brand-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
        }

        .sidebar-brand .brand-text {
            font-size: 1.25rem;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .sidebar-brand .brand-text span {
            color: #60a5fa;
        }

        .sidebar-close {
            display: none;
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.5);
            font-size: 1.5rem;
            cursor: pointer;
            margin-left: auto;
            padding: 0.25rem;
            transition: color 0.2s;
        }

        .sidebar-close:hover {
            color: #fff;
        }

        .sidebar-nav {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .sidebar-nav .nav-label {
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: rgba(255, 255, 255, 0.3);
            padding: 0.75rem 0.5rem 0.5rem;
            font-weight: 600;
        }

        .sidebar .nav-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.65rem 0.75rem;
            border-radius: 8px;
            color: rgba(255, 255, 255, 0.65);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s ease;
            cursor: pointer;
            position: relative;
        }

        .sidebar .nav-item i {
            width: 20px;
            font-size: 1rem;
            text-align: center;
            flex-shrink: 0;
        }

        .sidebar .nav-item:hover {
            background: rgba(255, 255, 255, 0.08);
            color: #fff;
        }

        .sidebar .nav-item.active {
            background: rgba(59, 130, 246, 0.2);
            color: #fff;
        }

        .sidebar .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 24px;
            background: #3b82f6;
            border-radius: 0 4px 4px 0;
        }

        .sidebar .nav-item .badge {
            margin-left: auto;
            background: #3b82f6;
            color: #fff;
            font-size: 0.65rem;
            padding: 0.15rem 0.55rem;
            border-radius: 12px;
            font-weight: 600;
        }

        .sidebar-footer {
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            padding-top: 1rem;
            margin-top: auto;
        }

        .sidebar-footer .nav-item {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.85rem;
        }

        .sidebar-footer .nav-item:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.05);
        }

        /* ===== SIDEBAR OVERLAY ===== */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(4px);
            z-index: 999;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .sidebar-overlay.active {
            display: block;
            opacity: 1;
        }

        /* ===== MAIN CONTENT ===== */
        .main-content {
            flex: 1;
            margin-left: 260px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ===== TOPBAR ===== */
        .topbar {
            background: #ffffff;
            padding: 0.75rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #e9edf4;
            position: sticky;
            top: 0;
            z-index: 100;
            min-height: 64px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
        }

        .topbar .left-section {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.4rem;
            color: #1a1a2e;
            cursor: pointer;
            padding: 0.25rem 0.5rem;
            border-radius: 6px;
            transition: background 0.2s;
        }

        .menu-toggle:hover {
            background: #f0f2f5;
        }

        .topbar .page-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1a1a2e;
            letter-spacing: -0.3px;
        }

        .topbar .page-title small {
            font-weight: 400;
            font-size: 0.8rem;
            color: #8a8fa8;
            margin-left: 0.5rem;
        }

        .topbar .breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.8rem;
            color: #8a8fa8;
        }

        .topbar .breadcrumb a {
            color: #3b82f6;
            text-decoration: none;
        }

        .topbar .breadcrumb a:hover {
            text-decoration: underline;
        }

        .topbar .breadcrumb .separator {
            color: #d0d4e0;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-menu .user-name {
            font-size: 0.9rem;
            font-weight: 500;
            color: #1a1a2e;
        }

        .user-menu .user-role {
            font-size: 0.7rem;
            color: #8a8fa8;
            font-weight: 400;
        }

        .user-menu .avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.9rem;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);
        }

        .user-menu .notif-btn {
            background: none;
            border: none;
            color: #5a5f7a;
            font-size: 1.1rem;
            cursor: pointer;
            padding: 0.4rem;
            border-radius: 50%;
            transition: background 0.2s, color 0.2s;
            position: relative;
        }

        .user-menu .notif-btn:hover {
            background: #f0f2f5;
            color: #1a1a2e;
        }

        .user-menu .notif-btn .dot {
            position: absolute;
            top: 6px;
            right: 6px;
            width: 8px;
            height: 8px;
            background: #ef4444;
            border-radius: 50%;
            border: 2px solid #fff;
        }

        /* ===== PAGE CONTENT ===== */
        .page-content {
            padding: 2rem;
            flex: 1;
        }

        /* ===== ALERT ===== */
        .alert {
            padding: 0.9rem 1.2rem;
            border-radius: 10px;
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #065f46;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.9rem;
            animation: slideDown 0.3s ease;
        }

        .alert i {
            font-size: 1.1rem;
            color: #10b981;
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

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: 280px;
                padding: 1.25rem 1rem;
            }

            .sidebar.sidebar-open {
                transform: translateX(0);
            }

            .sidebar-close {
                display: block;
            }

            .menu-toggle {
                display: block;
            }

            .main-content {
                margin-left: 0;
            }

            .topbar {
                padding: 0.5rem 1rem;
            }

            .topbar .page-title small {
                display: none;
            }

            .topbar .breadcrumb {
                display: none;
            }

            .user-menu .user-name {
                display: none;
            }

            .page-content {
                padding: 1.25rem;
            }
        }

        @media (min-width: 769px) {
            .sidebar {
                transform: translateX(0) !important;
            }

            .sidebar-overlay {
                display: none !important;
            }
        }

        /* ===== SCROLLBAR ===== */
        .sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 4px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
<body>

    <div class="admin-wrapper">

        {{-- Sidebar overlay (mobile) --}}
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        {{-- Sidebar / Navigation --}}
        @include('employees.layout.navigation')

        <div class="main-content">

            {{-- Topbar --}}
            <header class="topbar">
                <div class="left-section">
                    <button class="menu-toggle" id="menuToggle" aria-label="Toggle menu">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="page-title">
                        @yield('page-title', 'Dashboard')
                        <small>@yield('page-subtitle', 'Employee overview')</small>
                    </div>
                    <div class="breadcrumb">
                        <a href="#">Home</a>
                        <span class="separator">/</span>
                        <span>@yield('page-title', 'Dashboard')</span>
                    </div>
                </div>

                <div class="user-menu">
                    <button class="notif-btn" aria-label="Notifications">
                        <i class="fas fa-bell"></i>
                        <span class="dot"></span>
                    </button>
                    <div>
                        <div class="user-name">{{ auth()->user()->name ?? 'Employee' }}</div>
                        <div class="user-role">{{ auth()->user()->role ?? 'Employee' }}</div>
                    </div>
                    <div class="avatar">
                        {{ strtoupper(substr(auth()->user()->name ?? 'E', 0, 1)) }}
                    </div>
                </div>
            </header>

            {{-- Page Content --}}
            <div class="page-content">

                @if (session('success'))
                    <div class="alert">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @yield('content')

            </div>

        </div>

    </div>

    <script>
        const menuToggle = document.getElementById('menuToggle');
        const sidebarClose = document.getElementById('sidebarClose');
        const sidebar = document.querySelector('.sidebar');
        const overlay = document.getElementById('sidebarOverlay');

        function openSidebar() {
            sidebar.classList.add('sidebar-open');
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeSidebar() {
            sidebar.classList.remove('sidebar-open');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        menuToggle?.addEventListener('click', openSidebar);
        sidebarClose?.addEventListener('click', closeSidebar);
        overlay?.addEventListener('click', closeSidebar);

        // Close sidebar when a nav link is tapped (mobile)
        document.querySelectorAll('.sidebar .nav-item').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 768) closeSidebar();
            });
        });

        // Close on Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeSidebar();
        });

        // Reset state if resized back to desktop
        window.addEventListener('resize', () => {
            if (window.innerWidth > 768) {
                closeSidebar();
                document.body.style.overflow = '';
            }
        });

        // Active nav item highlight
        document.querySelectorAll('.sidebar .nav-item').forEach(item => {
            if (item.href && window.location.href.includes(item.href)) {
                item.classList.add('active');
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
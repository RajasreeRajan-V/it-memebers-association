<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Dashboard · Sidebar Nav</title>
    <!-- Font Awesome 6 (free) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <style>
        /* ----- RESET & BASE ----- */
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
            display: flex;
            min-height: 100vh;
        }

        /* ===== SIDEBAR (student version – matches admin panel style) ===== */
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

        /* Sidebar close button (mobile) */
        .sidebar-close {
            display: none;
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.5);
            font-size: 1.8rem;
            cursor: pointer;
            margin-left: auto;
            padding: 0.25rem;
            transition: color 0.2s;
            align-self: flex-end;
        }
        .sidebar-close:hover {
            color: #fff;
        }

        /* Brand */
        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0 0.5rem 1.5rem 0.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            margin-bottom: 1.5rem;
        }
        .brand-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #f97316, #ea580c);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
        }
        .brand-text {
            font-size: 1.25rem;
            font-weight: 700;
            letter-spacing: -0.5px;
        }
        .brand-text span {
            color: #fb923c;
        }

        /* Navigation */
        .sidebar-nav {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }
        .nav-label {
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: rgba(255, 255, 255, 0.3);
            padding: 0.75rem 0.5rem 0.5rem;
            font-weight: 600;
        }
        .nav-item {
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
        .nav-item i {
            width: 20px;
            font-size: 1rem;
            text-align: center;
            flex-shrink: 0;
        }
        .nav-item:hover {
            background: rgba(255, 255, 255, 0.08);
            color: #fff;
        }
        .nav-item.active {
            background: rgba(249, 115, 22, 0.2);
            color: #fff;
        }
        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 24px;
            background: #f97316;
            border-radius: 0 4px 4px 0;
        }
        .nav-item .badge {
            margin-left: auto;
            background: #f97316;
            color: #fff;
            font-size: 0.65rem;
            padding: 0.15rem 0.55rem;
            border-radius: 12px;
            font-weight: 600;
        }

        /* Sidebar footer */
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
        .sidebar-footer .copy {
            padding: 0.75rem 0.5rem 0;
            font-size: 0.7rem;
            color: rgba(255, 255, 255, 0.2);
            text-align: center;
        }

        /* ===== SIDEBAR OVERLAY (mobile) ===== */
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
            padding: 2rem 2rem 2rem 2rem;
            min-height: 100vh;
        }

        /* ===== DEMO PAGE CONTENT (just to fill) ===== */
        .demo-card {
            background: #fff;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
            border: 1px solid #edf2f7;
            max-width: 800px;
        }
        .demo-card h2 {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        .demo-card p {
            color: #475569;
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

            .main-content {
                margin-left: 0;
                padding: 1.25rem;
            }

            /* show a small hamburger in main content */
            .mobile-menu-btn {
                display: inline-flex !important;
                background: #1a1a2e;
                color: #fff;
                border: none;
                padding: 0.6rem 1rem;
                border-radius: 30px;
                font-size: 1.2rem;
                gap: 0.6rem;
                align-items: center;
                cursor: pointer;
                margin-bottom: 1.2rem;
                box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                transition: 0.2s;
            }
            .mobile-menu-btn:hover {
                background: #2d2d4a;
            }
        }

        @media (min-width: 769px) {
            .sidebar {
                transform: translateX(0) !important;
            }
            .sidebar-overlay {
                display: none !important;
            }
            .mobile-menu-btn {
                display: none !important;
            }
        }

        /* scrollbar */
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

        /* mobile hamburger (hidden on desktop) */
        .mobile-menu-btn {
            display: none;
        }
    </style>
</head>
<body>

    <!-- ===== SIDEBAR OVERLAY (mobile) ===== -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- ===== SIDEBAR (student version – redesigned from admin panel) ===== -->
    <aside class="sidebar" id="sidebar">
        <!-- Close button (mobile) -->
        <button class="sidebar-close" id="sidebarClose" aria-label="Close menu">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <!-- Brand -->
        <div class="sidebar-brand">
            <div class="brand-icon">
                <i class="fa-solid fa-graduation-cap"></i>
            </div>
            <div class="brand-text">
                Astra<span>Student</span>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="sidebar-nav">
            <div class="nav-label">Main</div>

            <a href="#" class="nav-item active">
                <i class="fa-solid fa-house"></i>
                <span>Dashboard</span>
            </a>

            <a href="#" class="nav-item">
                <i class="fa-solid fa-book-open"></i>
                <span>My Courses</span>
                <span class="badge">4</span>
            </a>

            <a href="#" class="nav-item">
                <i class="fa-solid fa-tasks"></i>
                <span>Assignments</span>
                <span class="badge">6</span>
            </a>

            <a href="#" class="nav-item">
                <i class="fa-solid fa-calendar-check"></i>
                <span>Schedule</span>
            </a>

            <div class="nav-label">Progress</div>

            <a href="#" class="nav-item">
                <i class="fa-solid fa-chart-line"></i>
                <span>Grades</span>
            </a>

            <a href="#" class="nav-item">
                <i class="fa-solid fa-clock"></i>
                <span>Study Hours</span>
            </a>

            <a href="#" class="nav-item">
                <i class="fa-solid fa-star"></i>
                <span>Achievements</span>
            </a>

            <div class="nav-label">Community</div>

            <a href="#" class="nav-item">
                <i class="fa-solid fa-comment-dots"></i>
                <span>Messages</span>
                <span class="badge">3</span>
            </a>

            <a href="#" class="nav-item">
                <i class="fa-solid fa-people-group"></i>
                <span>Study Groups</span>
            </a>
        </nav>

        <!-- Footer -->
        <!-- Footer -->
<div class="sidebar-footer">
    <form id="logoutForm" action="{{ route('membership-logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <a href="#" class="nav-item" id="logoutBtn">
        <i class="fa-solid fa-arrow-right-from-bracket"></i>
        <span>Logout</span>
    </a>
    <div class="copy">
        &copy; 2026 Astra Student
    </div>
</div>
    </aside>

    <!-- ===== MAIN CONTENT ===== -->
    <main class="main-content">

        <!-- Mobile menu button (visible only on small screens) -->
        <button class="mobile-menu-btn" id="menuToggle" aria-label="Toggle menu">
            <i class="fa-solid fa-bars"></i> Menu
        </button>

        <!-- Demo content -->
        <div class="demo-card">
            <h2>Student Dashboard</h2>
            <p style="margin-bottom: 0.5rem;">This is the redesigned sidebar navigation, matching the admin panel style you provided.</p>
            <p style="color: #64748b; font-size: 0.9rem;">
                <i class="fa-regular fa-circle-check" style="color: #f97316;"></i> 
                Active item: <strong>Dashboard</strong> (with orange indicator)
            </p>
            <p style="color: #64748b; font-size: 0.9rem; margin-top: 0.5rem;">
                <i class="fa-regular fa-bell" style="color: #f97316;"></i> 
                Notifications badge, course count, and assignment badges are displayed.
            </p>
            <div style="margin-top: 1.5rem; display: flex; gap: 0.8rem; flex-wrap: wrap;">
                <span style="background: #f1f5f9; padding: 0.3rem 1rem; border-radius: 30px; font-size: 0.8rem;"><i class="fa-regular fa-clock"></i> 4 active courses</span>
                <span style="background: #f1f5f9; padding: 0.3rem 1rem; border-radius: 30px; font-size: 0.8rem;"><i class="fa-regular fa-file-lines"></i> 2 pending assignments</span>
            </div>
        </div>

        <!-- quick note about mobile -->
        <div style="margin-top: 1.5rem; font-size: 0.8rem; color: #94a3b8; border-top: 1px solid #e9edf4; padding-top: 1.2rem;">
            <i class="fa-regular fa-hand-point-left"></i> Resize to &lt; 768px to see the mobile sidebar with overlay.
        </div>
    </main>

    <!-- ===== SCRIPTS ===== -->
   <script>
    (function() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const menuToggle = document.getElementById('menuToggle');
        const sidebarClose = document.getElementById('sidebarClose');
        const logoutBtn = document.getElementById('logoutBtn'); // ADDED

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

        // Open from mobile hamburger
        if (menuToggle) {
            menuToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                openSidebar();
            });
        }

        // Close from X button
        if (sidebarClose) {
            sidebarClose.addEventListener('click', closeSidebar);
        }

        // Close on overlay click
        if (overlay) {
            overlay.addEventListener('click', closeSidebar);
        }

        // Close on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeSidebar();
        });

        // Close sidebar when a nav link is clicked (mobile)
        document.querySelectorAll('.sidebar .nav-item').forEach(function(link) {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 768) closeSidebar();
            });
        });

        // Reset state on resize to desktop
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                closeSidebar();
                document.body.style.overflow = '';
            }
        });

        // Logout handler -- ADDED
        logoutBtn?.addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('logoutForm').submit();
        });

        // Highlight active link based on current URL (simple demo)
        const currentPath = window.location.pathname;
        document.querySelectorAll('.sidebar .nav-item').forEach(function(item) {
            // remove any existing active class from others
            if (item.href && currentPath.includes(item.href.split('/').pop())) {
                document.querySelectorAll('.sidebar .nav-item').forEach(el => el.classList.remove('active'));
                item.classList.add('active');
            }
        });

        // if no active found, keep first as active (demo)
        const hasActive = document.querySelector('.sidebar .nav-item.active');
        if (!hasActive) {
            const first = document.querySelector('.sidebar .nav-item');
            if (first) first.classList.add('active');
        }
    })();
</script>

</body>
</html>
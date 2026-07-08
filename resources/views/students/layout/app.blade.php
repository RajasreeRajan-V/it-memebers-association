<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard · redesigned</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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

        /* ===== ADMIN WRAPPER (student version) ===== */
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
            background: linear-gradient(135deg, #f97316, #ea580c);
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
            color: #fb923c;
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
            background: rgba(249, 115, 22, 0.2);
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
            background: #f97316;
            border-radius: 0 4px 4px 0;
        }

        .sidebar .nav-item .badge {
            margin-left: auto;
            background: #f97316;
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
            color: #f97316;
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
            background: linear-gradient(135deg, #f97316, #ea580c);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.9rem;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(249, 115, 22, 0.3);
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

        /* ===== STATS GRID (student cards) ===== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: #fff;
            border-radius: 16px;
            padding: 1.25rem 1.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
            border: 1px solid #edf2f7;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
        }

        .stat-label {
            font-size: 0.85rem;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
        }

        .stat-number {
            font-size: 2.2rem;
            font-weight: 700;
            color: #0f172a;
            margin: 0.3rem 0 0.2rem;
            letter-spacing: -0.5px;
        }

        .stat-sub {
            font-size: 0.8rem;
            color: #94a3b8;
        }

        /* ===== TWO COLUMN ===== */
        .two-col {
            display: grid;
            grid-template-columns: 1.6fr 1fr;
            gap: 1.5rem;
            margin-top: 0.5rem;
        }

        /* ===== CARDS ===== */
        .card {
            background: #fff;
            border-radius: 16px;
            padding: 1.5rem 1.5rem 1.2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
            border: 1px solid #edf2f7;
            margin-bottom: 1.5rem;
        }

        .card-title {
            font-weight: 600;
            font-size: 1rem;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            margin-bottom: 1.2rem;
        }

        .card-title i {
            color: #f97316;
            font-size: 1.1rem;
            width: 1.6rem;
        }

        /* grade items */
        .grade-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.9rem;
        }

        .grade-item .subject {
            width: 85px;
            font-size: 0.9rem;
            font-weight: 500;
            color: #1e293b;
            flex-shrink: 0;
        }

        .progress-track {
            flex: 1;
            height: 6px;
            background: #e9edf4;
            border-radius: 20px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #f97316, #fb923c);
            border-radius: 20px;
            transition: width 0.6s cubic-bezier(0.22, 1, 0.36, 1);
            width: 0%;
        }

        .grade-value {
            font-weight: 600;
            font-size: 0.9rem;
            color: #0f172a;
            min-width: 42px;
            text-align: right;
        }

        .grade-value small {
            font-weight: 400;
            font-size: 0.7rem;
            color: #94a3b8;
        }

        /* activity */
        .activity-item {
            display: flex;
            gap: 0.9rem;
            padding: 0.6rem 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 34px;
            height: 34px;
            background: #f1f5f9;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #f97316;
            flex-shrink: 0;
        }

        .activity-content .act-title {
            font-weight: 500;
            font-size: 0.9rem;
            color: #0f172a;
        }

        .activity-content .act-meta {
            font-size: 0.78rem;
            color: #94a3b8;
            display: flex;
            align-items: center;
            gap: 0.3rem;
            margin-top: 0.1rem;
        }

        .activity-content .act-meta i {
            font-size: 0.7rem;
        }

        /* upcoming */
        .upcoming-item {
            display: flex;
            gap: 0.75rem;
            margin-bottom: 1rem;
            align-items: flex-start;
        }

        .upcoming-badge {
            background: #f1f5f9;
            color: #1e293b;
            font-size: 0.7rem;
            font-weight: 600;
            padding: 0.15rem 0.7rem;
            border-radius: 20px;
            white-space: nowrap;
            margin-top: 0.1rem;
            border: 1px solid #e2e8f0;
        }

        .upcoming-info .title {
            font-weight: 500;
            font-size: 0.9rem;
            color: #0f172a;
        }

        .upcoming-info .detail {
            font-size: 0.8rem;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 0.4rem;
            margin-top: 0.1rem;
        }

        .upcoming-info .detail i {
            font-size: 0.7rem;
            color: #94a3b8;
        }

        /* quick buttons */
        .quick-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            width: 100%;
            padding: 0.8rem;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.9rem;
            background: #f97316;
            color: #fff;
            box-shadow: 0 6px 0 #c2410c;
            cursor: pointer;
            transition: all 0.1s ease;
        }

        .quick-btn:active {
            transform: translateY(3px);
            box-shadow: 0 3px 0 #c2410c;
        }

        .quick-btn i {
            font-size: 1rem;
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

            .two-col {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 480px) {
            .stats-grid {
                grid-template-columns: 1fr;
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
    </style>
</head>
<body>

    <div class="admin-wrapper">

        <!-- Sidebar overlay (mobile) -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <!-- ===== SIDEBAR (student version) ===== -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-brand">
                <div class="brand-icon"><i class="fas fa-graduation-cap"></i></div>
                <div class="brand-text">Edu<span>Hub</span></div>
                <button class="sidebar-close" id="sidebarClose" aria-label="Close sidebar">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <nav class="sidebar-nav">
                <div class="nav-label">Main</div>
                <a href="#" class="nav-item active"><i class="fas fa-gauge-high"></i> Dashboard</a>
                <a href="#" class="nav-item"><i class="fas fa-book-open"></i> My Courses</a>
                <a href="#" class="nav-item"><i class="fas fa-tasks"></i> Assignments <span class="badge">6</span></a>
                <a href="#" class="nav-item"><i class="fas fa-calendar-check"></i> Schedule</a>

                <div class="nav-label">Progress</div>
                <a href="#" class="nav-item"><i class="fas fa-chart-line"></i> Grades</a>
                <a href="#" class="nav-item"><i class="fas fa-clock"></i> Study Hours</a>
                <a href="#" class="nav-item"><i class="fas fa-star"></i> Achievements</a>

                <div class="sidebar-footer">
                    <a href="#" class="nav-item"><i class="fas fa-user"></i> Profile</a>
                    <a href="#" class="nav-item"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
            </nav>
        </aside>

        <!-- ===== MAIN ===== -->
        <div class="main-content">

            <!-- Topbar -->
            <header class="topbar">
                <div class="left-section">
                    <button class="menu-toggle" id="menuToggle" aria-label="Toggle menu">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="page-title">
                        Dashboard
                        <small>Student overview</small>
                    </div>
                    <div class="breadcrumb">
                        <a href="#">Home</a>
                        <span class="separator">/</span>
                        <span>Dashboard</span>
                    </div>
                </div>

                <div class="user-menu">
                    <button class="notif-btn" aria-label="Notifications">
                        <i class="fas fa-bell"></i>
                        <span class="dot"></span>
                    </button>
                    <div>
                        <div class="user-name">Alex Rivera</div>
                        <div class="user-role">Student</div>
                    </div>
                    <div class="avatar">A</div>
                </div>
            </header>

            <!-- ===== PAGE CONTENT ===== -->
            <div class="page-content">

                <!-- Statistics Cards (exactly the same data, redesigned) -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-label"><i class="fas fa-book-open"></i> Courses</div>
                        <div class="stat-number">8</div>
                        <div class="stat-sub">4 active · 2 completed</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-label"><i class="fas fa-tasks"></i> Assignments</div>
                        <div class="stat-number">14</div>
                        <div class="stat-sub">6 pending · 8 submitted</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-label"><i class="fas fa-star"></i> GPA</div>
                        <div class="stat-number">3.84</div>
                        <div class="stat-sub">↑ 0.12 from last term</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-label"><i class="fas fa-clock"></i> Study hours</div>
                        <div class="stat-number">26</div>
                        <div class="stat-sub">this week · +4h</div>
                    </div>
                </div>

                <!-- Two Column Layout -->
                <div class="two-col">

                    <!-- Left Panel -->
                    <div class="left-panel">

                        <!-- Grade Overview -->
                        <div class="card">
                            <div class="card-title"><i class="fas fa-chart-simple"></i> Grade overview</div>
                            <div class="grade-item">
                                <span class="subject">Mathematics</span>
                                <div class="progress-track"><div class="progress-fill" style="width:88%"></div></div>
                                <span class="grade-value">88<small>%</small></span>
                            </div>
                            <div class="grade-item">
                                <span class="subject">Physics</span>
                                <div class="progress-track"><div class="progress-fill" style="width:74%"></div></div>
                                <span class="grade-value">74<small>%</small></span>
                            </div>
                            <div class="grade-item">
                                <span class="subject">Chemistry</span>
                                <div class="progress-track"><div class="progress-fill" style="width:92%"></div></div>
                                <span class="grade-value">92<small>%</small></span>
                            </div>
                            <div class="grade-item">
                                <span class="subject">English</span>
                                <div class="progress-track"><div class="progress-fill" style="width:79%"></div></div>
                                <span class="grade-value">79<small>%</small></span>
                            </div>
                            <div class="grade-item">
                                <span class="subject">History</span>
                                <div class="progress-track"><div class="progress-fill" style="width:66%"></div></div>
                                <span class="grade-value">66<small>%</small></span>
                            </div>
                        </div>

                        <!-- Recent Activity -->
                        <div class="card">
                            <div class="card-title"><i class="fas fa-bolt"></i> Recent activity</div>
                            <div class="activity-item">
                                <div class="activity-icon"><i class="fas fa-pen-fancy"></i></div>
                                <div class="activity-content">
                                    <div class="act-title">Submitted essay · Philosophy</div>
                                    <div class="act-meta"><i class="far fa-clock"></i> 2 hours ago · pending review</div>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon"><i class="fas fa-video"></i></div>
                                <div class="activity-content">
                                    <div class="act-title">Attended lecture · Quantum Mechanics</div>
                                    <div class="act-meta"><i class="far fa-clock"></i> Yesterday, 10:30 AM · completed</div>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon"><i class="fas fa-file-alt"></i></div>
                                <div class="activity-content">
                                    <div class="act-title">Quiz result · Data Structures</div>
                                    <div class="act-meta"><i class="far fa-clock"></i> 2 days ago · score 92%</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Panel -->
                    <div class="right-panel">

                        <!-- Upcoming -->
                        <div class="card">
                            <div class="card-title"><i class="fas fa-calendar-check"></i> Upcoming</div>
                            <div class="upcoming-item">
                                <span class="upcoming-badge">Today</span>
                                <div class="upcoming-info">
                                    <div class="title">Calculus III · assignment</div>
                                    <div class="detail"><i class="far fa-clock"></i> 11:59 PM · 2 problems left</div>
                                </div>
                            </div>
                            <div class="upcoming-item">
                                <span class="upcoming-badge">Tomorrow</span>
                                <div class="upcoming-info">
                                    <div class="title">Organic Chemistry lab</div>
                                    <div class="detail"><i class="fas fa-flask"></i> 2:00 PM · prepare report</div>
                                </div>
                            </div>
                            <div class="upcoming-item">
                                <span class="upcoming-badge">Thu</span>
                                <div class="upcoming-info">
                                    <div class="title">Literature review</div>
                                    <div class="detail"><i class="far fa-file-pdf"></i> 2 chapters · peer feedback</div>
                                </div>
                            </div>
                            <div class="upcoming-item">
                                <span class="upcoming-badge">Fri</span>
                                <div class="upcoming-info">
                                    <div class="title">Statistics quiz</div>
                                    <div class="detail"><i class="fas fa-chart-pie"></i> chapters 5–7 · 30 min</div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="card" style="padding-bottom: 22px;">
                            <div class="card-title"><i class="fas fa-rocket"></i> Quick actions</div>
                            <button class="quick-btn" onclick="window.location.href='#'">
                                <i class="fas fa-plus-circle"></i> New assignment
                            </button>
                            <button class="quick-btn" style="margin-top:12px; background:#3A5079; box-shadow:0 6px 0 #253a57;" onclick="window.location.href='#'">
                                <i class="fas fa-people-group"></i> Study group
                            </button>
                            <button class="quick-btn" style="margin-top:12px; background:#504482; box-shadow:0 6px 0 #352d5a;" onclick="window.location.href='#'">
                                <i class="fas fa-calendar-plus"></i> Schedule session
                            </button>
                        </div>

                    </div><!-- right-panel -->
                </div><!-- two-col -->
            </div><!-- page-content -->
        </div><!-- main-content -->
    </div><!-- admin-wrapper -->

    <script>
        // Sidebar toggle
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

        document.querySelectorAll('.sidebar .nav-item').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 768) closeSidebar();
            });
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeSidebar();
        });

        window.addEventListener('resize', () => {
            if (window.innerWidth > 768) {
                closeSidebar();
                document.body.style.overflow = '';
            }
        });

        // active highlight
        document.querySelectorAll('.sidebar .nav-item').forEach(item => {
            if (item.href && window.location.href.includes(item.href)) {
                item.classList.add('active');
            }
        });

        // Animate progress bars on load
        document.addEventListener('DOMContentLoaded', function() {
            const fills = document.querySelectorAll('.progress-fill');
            fills.forEach(function(el, index) {
                const w = el.style.width;
                el.style.width = '0%';
                setTimeout(() => {
                    el.style.width = w;
                }, 80 + (index * 80));
            });
        });
    </script>

</body>
</html>
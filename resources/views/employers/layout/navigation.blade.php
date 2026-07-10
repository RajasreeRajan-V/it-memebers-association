{{-- resources/views/employer/layout/navigation.blade.php --}}
<aside class="sidebar" id="sidebar">
    {{-- Close button (mobile) --}}
    <button class="sidebar-close" id="sidebarClose" aria-label="Close menu">
        <i class="fa-solid fa-xmark"></i>
    </button>

    {{-- Brand --}}
    <div class="sidebar-brand">
        <div class="brand-icon">
            <i class="fa-solid fa-building"></i>
        </div>
        <div class="brand-text">
            Hire<span>Flow</span>
        </div>
    </div>

    {{-- Navigation --}}
 <nav class="sidebar-nav">

    {{-- ================= Dashboard ================= --}}
    <div class="nav-label">Dashboard</div>

    <a href="{{ route('employer.dashboard') }}"
        class="nav-item {{ request()->routeIs('employer.dashboard') ? 'active' : '' }}">
        <i class="fa-solid fa-house"></i>
        <span>Dashboard</span>
    </a>


    {{-- ================= Company ================= --}}
    <div class="nav-label">Company</div>

    <a href="{{ route('employer.startup-profile.show') }}"
        class="nav-item {{ request()->routeIs('employer.startup-profile.*') ? 'active' : '' }}">
        <i class="fa-solid fa-building"></i>
        <span>Company Profile</span>
    </a>


    {{-- ================= Recruitment ================= --}}
    <div class="nav-label">Recruitment</div>

    <a href="{{ route('employer.jobs.index') }}"
        class="nav-item {{ request()->routeIs('employer.jobs.*') ? 'active' : '' }}">
        <i class="fa-solid fa-briefcase"></i>
        <span>Jobs</span>
    </a>

    <a href="{{ route('employer.internships.index') }}"
        class="nav-item {{ request()->routeIs('employer.internships.*') ? 'active' : '' }}">
        <i class="fa-solid fa-user-graduate"></i>
        <span>Internships</span>
    </a>

    <a href="{{ route('employer.projects.index') }}"
        class="nav-item {{ request()->routeIs('employer.projects.*') ? 'active' : '' }}">
        <i class="fa-solid fa-diagram-project"></i>
        <span>Projects</span>
    </a>


    {{-- ================= Startup ================= --}}
    <div class="nav-label">Startup</div>

    <a href="{{ route('employer.startup-profile.show') }}"
        class="nav-item {{ request()->routeIs('employer.startup-profile.*') ? 'active' : '' }}">
        <i class="fa-solid fa-rocket"></i>
        <span>Startup Profile</span>
    </a>


    {{-- ================= Applications ================= --}}
    <!-- <div class="nav-label">Applications</div>

    <a href="#">
        <i class="fa-solid fa-file-lines"></i>
        <span>Applications</span>
    </a> -->

    <!-- <a href="#">
        <i class="fa-solid fa-user-check"></i>
        <span>Shortlisted</span>
    </a> -->

    <!-- <a href="#">
        <i class="fa-solid fa-calendar-check"></i>
        <span>Interviews</span>
    </a> -->

    <!-- <a href="#">
        <i class="fa-solid fa-user-tie"></i>
        <span>Hired Candidates</span>
    </a> -->


    {{-- ================= Membership ================= --}}
    <!-- <div class="nav-label">Membership</div>

    <a href="#">
        <i class="fa-solid fa-crown"></i>
        <span>Membership</span>
    </a> -->

    <!-- <a href="#">
        <i class="fa-solid fa-credit-card"></i>
        <span>Payments</span>
    </a> -->


    {{-- ================= Notifications ================= --}}
    <!-- <div class="nav-label">Notifications</div>

    <a href="#">
        <i class="fa-solid fa-bell"></i>
        <span>Notifications</span>
    </a> -->


    {{-- ================= Settings ================= --}}
    <!-- <div class="nav-label">Settings</div>

    <a href="">
        <i class="fa-solid fa-gear"></i>
        <span>Settings</span>
    </a> -->

</nav>

    {{-- Footer --}}
    <div class="sidebar-footer">
        <a href="#" class="nav-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
            <span>Logout</span>
        </a>
        <form id="logout-form" action="{{ route('membership-logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <div class="copy">
            &copy; {{ date('Y') }} HireFlow
        </div>
    </div>
</aside>

<style>
    /* ===== SIDEBAR OVERRIDES (employer theme - purple/indigo) ===== */
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
        background: linear-gradient(135deg, #8b5cf6, #7c3aed);
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
        color: #a78bfa;
    }

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
        background: rgba(139, 92, 246, 0.2);
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
        background: #8b5cf6;
        border-radius: 0 4px 4px 0;
    }
    .nav-item .badge {
        margin-left: auto;
        background: #8b5cf6;
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
    .sidebar-footer .copy {
        padding: 0.75rem 0.5rem 0;
        font-size: 0.7rem;
        color: rgba(255, 255, 255, 0.2);
        text-align: center;
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
    }

    @media (min-width: 769px) {
        .sidebar {
            transform: translateX(0) !important;
        }
    }

    /* Scrollbar */
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

<script>
    (function() {
        const sidebar = document.getElementById('sidebar');
        const sidebarClose = document.getElementById('sidebarClose');

        // Close sidebar from X button
        if (sidebarClose) {
            sidebarClose.addEventListener('click', function() {
                sidebar.classList.remove('sidebar-open');
                document.getElementById('sidebarOverlay')?.classList.remove('active');
                document.body.style.overflow = '';
            });
        }

        // Close sidebar when a nav link is clicked (mobile)
        document.querySelectorAll('.sidebar .nav-item').forEach(function(link) {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    sidebar.classList.remove('sidebar-open');
                    document.getElementById('sidebarOverlay')?.classList.remove('active');
                    document.body.style.overflow = '';
                }
            });
        });

        // Auto-highlight active nav item based on current route
        const currentPath = window.location.pathname;
        document.querySelectorAll('.sidebar .nav-item').forEach(function(item) {
            if (item.href && currentPath.includes(item.href.split('/').pop())) {
                document.querySelectorAll('.sidebar .nav-item').forEach(el => el.classList.remove('active'));
                item.classList.add('active');
            }
        });

        // If no active item, keep first as active (fallback)
        if (!document.querySelector('.sidebar .nav-item.active')) {
            const first = document.querySelector('.sidebar .nav-item');
            if (first) first.classList.add('active');
        }
    })();
</script>
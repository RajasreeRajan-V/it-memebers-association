<!-- Updated Site Header -->

<header class="site-header">
    <div class="container header-inner">
        <a href="#" class="logo">
            <span class="logo-mark" aria-hidden="true">
                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15 2L27 8.5V21.5L15 28L3 21.5V8.5L15 2Z" fill="url(#lg)" />
                    <path d="M15 9L20 12V18L15 21L10 18V12L15 9Z" fill="white" fill-opacity="0.9" />
                    <defs>
                        <linearGradient id="lg" x1="3" y1="2" x2="27" y2="28" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#4F46E5" />
                            <stop offset="1" stop-color="#14B8A6" />
                        </linearGradient>
                    </defs>
                </svg>
            </span>
            SkillConnect
        </a>

        <nav class="main-nav" aria-label="Primary">
            <nav class="main-nav" aria-label="Primary">
                <a href="{{ route('dashboard') }}" style="color: white; font-weight: bold;">
                    Home
                </a>

                <div class="dropdown">
                    <a href="" style="color: white; font-weight: bold;">
                        Job Management
                    </a>

                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route('employer.jobs.create') }}">
                                Create Job
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('employer.jobs.index') }}">
                                View Jobs
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="dropdown">
                <a href="#" style="color: white; font-weight: bold;">
                    Internship Programs
                </a>

                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('employer.internships.create') }}">
                            Create Internship
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('employer.internships.index') }}">
                            View Internships
                        </a>
                    </li>
                </ul>
            </div>
            <div class="dropdown">
                <a href="#" style="color: white; font-weight: bold;">
                    Projects
                </a>

                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('employer.projects.create') }}">
                            Create Project
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('employer.projects.index') }}">
                            View Projects
                        </a>
                    </li>
                </ul>
            </div>
            <div class="dropdown">
                <a href="#" style="color: white; font-weight: bold;">
                    Startup Profile
                </a>

                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('employer.startup-profile.create') }}">
                            Create StartUp
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('employer.startup-profile.index') }}">
                            View StartUps
                        </a>
                    </li>
                </ul>
            </div>
            <a href="{{ route('contact') }}" style="color: white; font-weight: bold;">Contact</a>
        </nav>

        <div class="header-actions">
            <!-- Login button opens the modal -->
            <form method="POST" action="{{ route('membership-logout') }}">
                @csrf
                <button type="submit" class="btn btn-primary">
                    Logout
                </button>
            </form>
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
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    position: sticky;
    top: 0;
    z-index: 1000;
    padding: 12px 0;
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
    font-size: 1.5rem;
    font-weight: 800;
    color: #ffffff;
    text-decoration: none;
}

.logo-mark {
    display: flex;
    align-items: center;
}

.main-nav {
    display: flex;
    gap: 20px;
    align-items: center;
}

.nav-link {
    color: white;
    font-weight: bold;
    text-decoration: none;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-toggle {
    color: white;
    font-weight: bold;
    text-decoration: none;
}

.dropdown-menu {
    display: none;
    position: absolute;
    top: 110%;
    left: 50%;
    transform: translateX(-50%);

    min-width: 140px;
    /* decrease width */
    background: #fff;

    border-radius: 10px;
    padding: 6px 0;

    list-style: none;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);

    overflow: hidden;
    z-index: 1000;
}

.dropdown-menu li {
    margin: 0;
}

.dropdown-menu li a {
    display: block;
    padding: 10px 14px;

    color: #1f2937;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;

    transition: all 0.2s ease;
}

.dropdown-menu li a:hover {
    background: #f3f4f6;
    color: #2563eb;
}

.dropdown:hover .dropdown-menu {
    display: block;
}

.main-nav a {
    text-decoration: none;
    font-weight: 600;
    color: #2d3748;
    transition: color 0.3s;
}

.main-nav a:hover {
    color: #4A90D9;
}

.header-actions {
    display: flex;
    align-items: center;
    gap: 12px;
}

.btn-ghost {
    background: transparent;
    border: none;
    padding: 8px 16px;
    font-weight: 600;
    color: #2d3748;
    cursor: pointer;
    transition: color 0.3s;
}

.btn-ghost:hover {
    color: #4A90D9;
}

.btn-primary {
    background: linear-gradient(135deg, #4A90D9, #357ABD);
    color: #fff;
    border: none;
    padding: 10px 24px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
    text-decoration: none;
    display: inline-block;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(74, 144, 217, 0.3);
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
    height: 3px;
    background: #2d3748;
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
        top: 70px;
        left: 0;
        right: 0;
        background: white;
        flex-direction: column;
        padding: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        border-radius: 0 0 12px 12px;
        gap: 12px;
    }

    .main-nav.open {
        display: flex;
    }

    .nav-toggle {
        display: flex;
    }

    .header-actions .btn-ghost {
        padding: 6px 12px;
        font-size: 0.9rem;
    }

    .header-actions .btn-primary {
        padding: 6px 16px;
        font-size: 0.9rem;
    }
}

@media (max-width: 480px) {
    .header-inner {
        flex-wrap: wrap;
        gap: 10px;
    }

    .logo {
        font-size: 1.2rem;
    }

    .header-actions {
        gap: 8px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle mobile nav
    const navToggle = document.getElementById('navToggle');
    const mainNav = document.querySelector('.main-nav');
    if (navToggle && mainNav) {
        navToggle.addEventListener('click', function() {
            const expanded = this.getAttribute('aria-expanded') === 'true' ? false : true;
            this.setAttribute('aria-expanded', expanded);
            mainNav.classList.toggle('open');
        });
    }
});
</script>

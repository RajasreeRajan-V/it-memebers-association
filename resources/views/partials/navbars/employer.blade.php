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
                    <svg class="caret" width="9" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
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
                    <svg class="caret" width="9" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
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
                    <svg class="caret" width="9" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
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
                    <svg class="caret" width="9" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('employer.startup-profile.create') }}">Create Startup</a></li>
                    <li><a href="{{ route('employer.startup-profile.index') }}">View Startups</a></li>
                </ul>
                
            </div>
            <a href="{{ route('employer.applicants.index') }}" class="nav-link">Applicants</a>
        </nav>

        <div class="header-actions">
            <form method="POST" action="{{ route('membership-logout') }}">
                @csrf
                <button type="submit" class="btn btn-primary">Logout</button>
            </form>
        </div>

        <button class="nav-toggle" id="navToggle" aria-label="Toggle menu" aria-expanded="false">
            <span></span><span></span><span></span>
        </button>
    </div>
</header>

<style>
/* ===== Header Styles ===== */
* { box-sizing: border-box; }

.site-header {
    background:  #3364d7;
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

/* ---- Dropdown ---- */
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
}

@media (max-width: 480px) {
    .header-inner {
        flex-wrap: wrap;
        padding: 12px 16px;
    }

    .logo {
        font-size: 0.95rem;
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
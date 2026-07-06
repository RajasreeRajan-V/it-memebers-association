<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @stack('styles')
</head>
<body>

    <div class="admin-wrapper">

        {{-- Sidebar overlay (mobile) --}}
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        {{-- Sidebar / Navigation --}}
        @include('admin.layout.navigation')

        <div class="main-content">

            {{-- Topbar --}}
            <div class="topbar">
                <div style="display:flex; align-items:center; gap:0.75rem;">
                    <button class="menu-toggle" id="menuToggle" aria-label="Toggle menu">☰</button>
                    <div class="page-title">@yield('page-title', 'Dashboard')</div>
                </div>

                <div class="user-menu">
                    <span>{{ auth()->user()->name ?? 'Admin' }}</span>
                    <div class="avatar">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                </div>
            </div>

            {{-- Page Content --}}
            <div class="page-content">

                @if (session('success'))
                    <div class="alert">
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
    }

    function closeSidebar() {
        sidebar.classList.remove('sidebar-open');
        overlay.classList.remove('active');
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
        if (window.innerWidth > 768) closeSidebar();
    });
</script>
    @stack('scripts')
</body>
</html>
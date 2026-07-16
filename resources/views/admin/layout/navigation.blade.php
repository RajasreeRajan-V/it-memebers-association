{{-- resources/views/partials/navigation.blade.php --}}
<div class="sidebar">
    {{-- Sidebar Close (mobile) --}}
    <button class="sidebar-close" id="sidebarClose" aria-label="Close menu">
        <i class="fa-solid fa-xmark"></i>
    </button>

    {{-- Brand --}}
    <div class="sidebar-brand">
        <div class="brand-icon">
            <i class="fa-solid fa-cube"></i>
        </div>
        <div class="brand-text">
            Admin<span>Panel</span>
        </div>
    </div>

    {{-- Navigation --}}
    <nav class="sidebar-nav">
        <div class="nav-label">Main</div>

        <a href="{{ Route::has('admin.dashboard') ? route('admin.dashboard') : '#' }}"
            class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-house"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ Route::has('admin.users.index') ? route('admin.users.index') : '#' }}"
            class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
            <i class="fa-solid fa-users"></i>
            <span>Users</span>
            <span class="badge">12</span>
        </a>

        <a href="{{ Route::has('admin.registrations.index') ? route('admin.registrations.index') : '#' }}"
            class="nav-item {{ request()->routeIs('admin.registrations.*') ? 'active' : '' }}">
            <i class="fa-solid fa-user-clock"></i>
            <span>Registration Approvals</span>
            @if($pendingApprovals ?? 0 > 0)
                <span class="badge">{{ $pendingApprovals }}</span>
            @endif
        </a>



        <a href="{{ Route::has('admin.jobs.index') ? route('admin.jobs.index') : '#' }}"
    class="nav-item {{ request()->routeIs('admin.jobs.*') ? 'active' : '' }}">
    <i class="fa-solid fa-briefcase"></i>
    <span>Job Approvals</span>
    @if(($pendingJobApprovals ?? 0) > 0)
        <span class="badge">{{ $pendingJobApprovals }}</span>
    @endif
</a>



<a href="{{ Route::has('admin.startups.index') ? route('admin.startups.index') : '#' }}"
    class="nav-item {{ request()->routeIs('admin.startups.*') ? 'active' : '' }}">
    <i class="fa-solid fa-rocket"></i>
    <span>Startup Approvals</span>
    @if(($pendingStartupApprovals ?? 0) > 0)
        <span class="badge">{{ $pendingStartupApprovals }}</span>
    @endif
</a>
        <div class="nav-label">Management</div>

        <a href="{{ Route::has('admin.products.index') ? route('admin.products.index') : '#' }}"
            class="nav-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
            <i class="fa-solid fa-box"></i>
            <span>Products</span>
        </a>

        <a href="{{ Route::has('admin.reports.index') ? route('admin.reports.index') : '#' }}"
            class="nav-item {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
            <i class="fa-solid fa-chart-line"></i>
            <span>Reports</span>
        </a>

        <div class="nav-label">System</div>

        <a href="{{ Route::has('admin.settings.index') ? route('admin.settings.index') : '#' }}"
            class="nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
            <i class="fa-solid fa-gear"></i>
            <span>Settings</span>
        </a>
    </nav>

    {{-- Footer --}}
    <div class="sidebar-footer">
        <a href="#" class="nav-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
            <span>Logout</span>
        </a>
        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <div style="padding: 0.75rem 0.5rem 0; font-size: 0.7rem; color: rgba(255,255,255,0.2); text-align: center;">
            &copy; {{ date('Y') }} My Company
        </div>
    </div>
</div>
{{-- resources/views/partials/navigation.blade.php --}}
<div class="sidebar">
    <div class="brand">
        <span>Admin Panel</span>
        <button class="sidebar-close" id="sidebarClose" aria-label="Close menu">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <nav>
        <a href="{{ Route::has('admin.dashboard') ? route('admin.dashboard') : '#' }}"
           class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="nav-icon"><i class="fa-solid fa-house"></i></span>
            <span>Dashboard</span>
        </a>

        <a href="{{ Route::has('admin.users.index') ? route('admin.users.index') : '#' }}"
           class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
            <span class="nav-icon"><i class="fa-solid fa-users"></i></span>
            <span>Users</span>
        </a>

        <a href="{{ Route::has('admin.orders.index') ? route('admin.orders.index') : '#' }}"
           class="nav-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
            <span class="nav-icon"><i class="fa-solid fa-cart-shopping"></i></span>
            <span>Orders</span>
        </a>

        <a href="{{ Route::has('admin.products.index') ? route('admin.products.index') : '#' }}"
           class="nav-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
            <span class="nav-icon"><i class="fa-solid fa-box"></i></span>
            <span>Products</span>
        </a>

        <a href="{{ Route::has('admin.reports.index') ? route('admin.reports.index') : '#' }}"
           class="nav-item {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
            <span class="nav-icon"><i class="fa-solid fa-chart-column"></i></span>
            <span>Reports</span>
        </a>

        <a href="{{ Route::has('admin.settings.index') ? route('admin.settings.index') : '#' }}"
           class="nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
            <span class="nav-icon"><i class="fa-solid fa-gear"></i></span>
            <span>Settings</span>
        </a>
    </nav>

    <div class="sidebar-footer">
        &copy; {{ date('Y') }} My Company
    </div>
</div>
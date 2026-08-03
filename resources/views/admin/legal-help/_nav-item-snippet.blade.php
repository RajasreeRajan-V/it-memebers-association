{{-- Add this inside <nav class="sidebar-nav"> in resources/views/partials/navigation.blade.php,
     alongside your other approval nav items (Jobs, Startups, Articles). --}}

<a href="{{ Route::has('admin.legal-help.index') ? route('admin.legal-help.index') : '#' }}"
    class="nav-item {{ request()->routeIs('admin.legal-help.*') ? 'active' : '' }}">
    <i class="fa-solid fa-scale-balanced"></i>
    <span>Legal Help</span>
    @if(($pendingLegalRequests ?? 0) > 0)
        <span class="badge">{{ $pendingLegalRequests }}</span>
    @endif
</a>

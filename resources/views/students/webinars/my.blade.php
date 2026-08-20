@extends('layouts.app')

@section('title', 'My Webinars')

@section('content')

@if(session('success'))
    <div class="registration-success">{{ session('success') }}</div>
@endif

<div class="container" style="padding:48px 0;">
    <h1 style="font-size:1.5rem;font-weight:700;color:var(--primary);font-family:var(--font-display);margin-bottom:20px;">
        My Webinars
    </h1>

    <div class="tab-switch" style="display:flex;gap:8px;margin-bottom:24px;">
        <button class="tab-btn active" data-tab="upcoming" onclick="showTab('upcoming')">
            Upcoming ({{ $upcoming->count() }})
        </button>
        <button class="tab-btn" data-tab="completed" onclick="showTab('completed')">
            Completed ({{ $completed->count() }})
        </button>
    </div>

    <div id="tab-upcoming" class="tab-panel">
        @forelse($upcoming as $reg)
            @include('students.webinars._my-card', ['reg' => $reg, 'isPast' => false])
        @empty
            <div class="sidebar-card" style="text-align:center;padding:50px 20px;color:var(--muted);">
                No upcoming registrations yet.
                <div style="margin-top:14px;">
                    <a href="{{ route('student.webinars') }}" class="btn btn-primary">Browse Events</a>
                </div>
            </div>
        @endforelse
    </div>

    <div id="tab-completed" class="tab-panel" style="display:none;">
        @forelse($completed as $reg)
            @include('students.webinars._my-card', ['reg' => $reg, 'isPast' => true])
        @empty
            <div class="sidebar-card" style="text-align:center;padding:50px 20px;color:var(--muted);">
                No completed webinars yet.
            </div>
        @endforelse
    </div>
</div>

<style>
.tab-btn {
    padding:8px 18px;border-radius:8px;border:1px solid #e5e7eb;background:#fff;
    font-size:0.85rem;font-weight:600;color:var(--muted);cursor:pointer;
}
.tab-btn.active { background:var(--secondary);color:#fff;border-color:var(--secondary); }
.registration-success { max-width:1200px;margin:0 auto 20px;padding:14px 20px;background:#ecfdf5;border:1px solid #10b981;color:#047857;border-radius:10px;font-weight:600; }
</style>

<script>
function showTab(tab) {
    document.querySelectorAll('.tab-panel').forEach(p => p.style.display = 'none');
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById('tab-' + tab).style.display = 'block';
    document.querySelector('.tab-btn[data-tab="' + tab + '"]').classList.add('active');
}
</script>

@endsection
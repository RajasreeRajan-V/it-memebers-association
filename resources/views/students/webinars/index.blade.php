@extends('layouts.app')

@section('title', 'Events & Webinars')

@section('content')

@if(session('success'))
    <div class="registration-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="registration-error">
        {{ session('error') }}
    </div>
@endif

{{-- ===== Hero ===== --}}
<section class="hero">
    <div class="container hero-inner">
        <div>
            <span class="eyebrow">Events &amp; Webinars</span>
            <h1>Learn. Connect. <span class="accent-text">Grow.</span></h1>
            <p class="hero-sub">
                Join live sessions with mentors, attend webinars and workshops,
                and sharpen your skills for what's next.
            </p>
            <div class="hero-actions">
                <a href="#event-list" class="btn btn-primary btn-lg">Browse Events</a>
                <a href="{{ route('student.webinars.my') }}" class="btn btn-outline btn-lg">My Webinars</a>
            </div>
        </div>

        <div class="hero-visual">
            <div class="hero-blob"></div>
            <div class="hero-dots"></div>

            <div class="hero-float-chip hero-float-chip-brand">
                <span class="hero-float-chip-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75L22.5 3v13.5l-5.25-3.75m-9.75 3.75h9.75V4.5H1.5v12h6.75z"/></svg>
                </span>
                <span class="hero-float-chip-text">
                    <strong>{{ $counts['all'] }}</strong>
                    <span>Live Events</span>
                </span>
            </div>

            <div class="hero-float-chip hero-float-chip-round">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.288 15.038a5.25 5.25 0 017.424 0M5.106 11.856c3.807-3.808 9.98-3.808 13.788 0M1.924 8.674c5.565-5.565 14.587-5.565 20.152 0M12.75 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"/></svg>
            </div>

            <div class="hero-float-chip hero-float-chip-person">
                <span class="hero-float-chip-avatar">M</span>
                <span class="hero-float-chip-text">
                    <strong>Mentor-led</strong>
                    <span>Small groups</span>
                </span>
            </div>
        </div>
    </div>
</section>

<div class="container" id="event-list" style="display:grid;grid-template-columns:200px 1fr 300px;gap:24px;padding:48px 0 72px;align-items:start;">

    {{-- ===== Filters ===== --}}
    <aside class="sidebar-card" style="padding:14px;">
        <form method="GET" action="{{ route('student.webinars') }}">
            <div class="sidebar-card-header" style="margin-bottom:10px;">
                <h3 style="font-size:12.5px;">Filters</h3>
                <a href="{{ route('student.webinars') }}" style="font-size:11px;">Clear all</a>
            </div>

            {{-- Search --}}
            <div class="form-row" style="margin-bottom:14px;gap:4px;">
                <label for="q" style="font-size:12px;">Search Events</label>
                <input type="text" id="q" name="q" value="{{ $search }}" placeholder="Search events..." style="padding:7px 10px;font-size:12.5px;">
            </div>

            {{-- Event type --}}
            <div style="margin-bottom:14px;">
                <label style="font-size:11.5px;font-weight:600;color:var(--primary);display:block;margin-bottom:6px;">Event Type</label>
                <div class="role-radio-grid" style="grid-template-columns:1fr;gap:6px;">
                    <label class="role-radio-card" style="padding:7px 10px;">
                        <input type="radio" name="type" value="" {{ !$activeType ? 'checked' : '' }} onchange="this.form.submit()">
                        <span class="radio-circle" style="width:16px;height:16px;"></span>
                        <span class="radio-label" style="font-size:12px;">All Types ({{ $counts['all'] }})</span>
                    </label>
                    <label class="role-radio-card" style="padding:7px 10px;">
                        <input type="radio" name="type" value="webinar" {{ $activeType === 'webinar' ? 'checked' : '' }} onchange="this.form.submit()">
                        <span class="radio-circle" style="width:16px;height:16px;"></span>
                        <span class="radio-label" style="font-size:12px;">Webinars ({{ $counts['webinar'] }})</span>
                    </label>
                    <label class="role-radio-card" style="padding:7px 10px;">
                        <input type="radio" name="type" value="workshop" {{ $activeType === 'workshop' ? 'checked' : '' }} onchange="this.form.submit()">
                        <span class="radio-circle" style="width:16px;height:16px;"></span>
                        <span class="radio-label" style="font-size:12px;">Workshops ({{ $counts['workshop'] }})</span>
                    </label>
                </div>
            </div>

            {{-- Date --}}
            <div style="margin-bottom:16px;">
                <label style="font-size:11.5px;font-weight:600;color:var(--primary);display:block;margin-bottom:6px;">Date</label>
                <div class="role-radio-grid" style="grid-template-columns:1fr;gap:6px;">
                    @foreach(['' => 'All', 'today' => 'Today', 'week' => 'This Week', 'month' => 'This Month'] as $value => $label)
                        <label class="role-radio-card" style="padding:7px 10px;">
                            <input type="radio" name="date" value="{{ $value }}"
                                   {{ $activeDate === $value || (!$activeDate && $value === '') ? 'checked' : '' }}
                                   onchange="this.form.submit()">
                            <span class="radio-circle" style="width:16px;height:16px;"></span>
                            <span class="radio-label" style="font-size:12px;">{{ $label }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;padding:8px 14px;font-size:0.8rem;">
                Apply Filters
            </button>
        </form>
    </aside>

    {{-- ===== Main: event list ===== --}}
    <main>
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
            <div>
                <h2 style="font-size:1.3rem;font-weight:700;color:var(--primary);font-family:var(--font-display);">All Events</h2>
                <p style="color:var(--muted);font-size:0.9rem;margin-top:2px;">
                    {{ $events->total() }} {{ \Illuminate\Support\Str::plural('event', $events->total()) }} found
                </p>
            </div>
            <form method="GET" action="{{ route('student.webinars') }}" style="display:flex;align-items:center;gap:8px;">
                @foreach(request()->except(['sort', 'page']) as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach
                <label style="font-size:0.85rem;color:var(--muted);">Sort by:</label>
                <select name="sort" onchange="this.form.submit()" class="mentor-select">
                    <option value="upcoming" {{ $activeSort === 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                    <option value="newest" {{ $activeSort === 'newest' ? 'selected' : '' }}>Newest</option>
                </select>
            </form>
        </div>

        @if($events->isEmpty())
            <div class="sidebar-card" style="text-align:center;padding:60px 20px;color:var(--muted);">
                No events match your filters right now. Try clearing filters or check back soon.
            </div>
        @else
            <div class="material-list">
                @foreach($events as $event)
                    @php
                        $isWorkshop = $event->type === 'workshop';
                        $scheduledDate = \Illuminate\Support\Carbon::parse($event->scheduled_date);
                        $scheduledTime = $event->scheduled_time
                            ? (function () use ($event) {
                                try {
                                    return \Illuminate\Support\Carbon::parse($event->scheduled_time)->format('h:i A');
                                } catch (\Throwable $e) {
                                    return $event->scheduled_time;
                                }
                            })()
                            : null;
                    @endphp
                    <div class="material-card">
                        @if($event->banner)
                            <div class="material-thumb">
                                <img src="{{ Storage::url($event->banner) }}" alt="{{ $event->title }}">
                            </div>
                        @else
                            <div class="material-icon {{ $isWorkshop ? 'c2' : 'c1' }}">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    @if($isWorkshop)
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                    @else
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5l4.72-2.72a.75.75 0 011.125.65v8.14a.75.75 0 01-1.125.65L15.75 15M4.5 18.75h9a1.5 1.5 0 001.5-1.5v-7.5a1.5 1.5 0 00-1.5-1.5h-9a1.5 1.5 0 00-1.5 1.5v7.5a1.5 1.5 0 001.5 1.5z" />
                                    @endif
                                </svg>
                            </div>
                        @endif

                        <div class="material-card-body">
                            <h3 class="material-card-title">{{ $event->title }}</h3>
                            <p class="material-card-desc">{{ \Illuminate\Support\Str::limit($event->description, 110) }}</p>

                            <div class="material-card-tags">
                                @if($event->category)
                                    <span class="tag-pill category-pill">{{ strtoupper($event->category) }}</span>
                                @endif
                                <span class="tag-pill">{{ strtoupper($event->type) }}</span>
                            </div>

                            <div class="material-card-meta">
                                {{ $scheduledDate->format('d M, Y') }}
                                @if($scheduledTime) &middot; {{ $scheduledTime }} @endif
                                @if($event->platform) &middot; {{ $event->platform }} @endif
                                @if($event->mentor) &middot; {{ $event->mentor->name }} @endif
                            </div>
                        </div>

                        <div class="material-card-stats">
                            <div class="stat-top">
                                <span class="stat-views">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                                    {{ $event->capacity ?: '—' }}
                                </span>
                            </div>
                            <div class="stat-date">{{ $scheduledDate->diffForHumans() }}</div>
                            <div style="margin-top:10px;">
                                @include('students.webinars._action', ['event' => $event, 'myRegistrations' => $myRegistrations])
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mentor-pagination" style="justify-content:center;margin-top:32px;">
                {{ $events->onEachSide(1)->links() }}
            </div>
        @endif
    </main>

    {{-- ===== Right sidebar ===== --}}
    <aside>
        {{-- Upcoming events --}}
        <div class="sidebar-card">
            <div class="sidebar-card-header">
                <h3>Upcoming Events</h3>
                <a href="{{ route('student.webinars') }}?sort=upcoming">View all</a>
            </div>
            @forelse($upcoming as $item)
                @php $d = \Illuminate\Support\Carbon::parse($item->scheduled_date); @endphp
                <a href="{{ route('student.webinars.show', $item) }}" style="text-decoration:none;color:inherit;">
                    <div class="ranked-row">
                        <div style="display:flex;align-items:center;gap:10px;">
                            <span class="rank">{{ $d->format('d') }}</span>
                            <span class="name">
                                {{ $item->title }}
                                <small>{{ $d->format('M') }} &middot; {{ $d->format('h:i A') }} &middot; {{ ucfirst($item->type) }}</small>
                            </span>
                        </div>
                        <span class="count">&rarr;</span>
                    </div>
                </a>
            @empty
                <p style="font-size:12.5px;color:var(--muted);">No upcoming events yet.</p>
            @endforelse
        </div>

        {{-- Categories --}}
        <div class="sidebar-card">
            <div class="sidebar-card-header">
                <h3>Event Categories</h3>
            </div>
            @php $dotColors = ['--blue-fg', '--green-fg', '--pink-fg', '--yellow-fg', '--purple-fg', '--cyan-fg']; @endphp
            <a href="{{ route('student.webinars') }}" style="text-decoration:none;color:inherit;">
                <div class="category-row">
                    <span style="display:flex;align-items:center;font-weight:{{ !$activeType ? '700' : '400' }};color:{{ !$activeType ? 'var(--secondary)' : 'var(--text)' }};">
                        <span class="dot" style="background:var(--secondary);"></span>
                        All Categories
                    </span>
                    <span class="count">{{ $counts['all'] }}</span>
                </div>
            </a>
            @foreach($categories as $i => $cat)
                <a href="{{ route('student.webinars', ['q' => $cat->category]) }}" style="text-decoration:none;color:inherit;">
                    <div class="category-row">
                        <span style="display:flex;align-items:center;">
                            <span class="dot" style="background:var({{ $dotColors[$i % count($dotColors)] }});"></span>
                            {{ $cat->category }}
                        </span>
                        <span class="count">{{ $cat->total }}</span>
                    </div>
                </a>
            @endforeach
        </div>

        {{-- CTA --}}
        <div class="sidebar-card">
            <div class="help-card">
                <span class="help-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zM12 17.25h.007v.008H12v-.008z"/></svg>
                </span>
                <div>
                    <h3>Can't find an event?</h3>
                    <p>Suggest a topic or mentor you'd like to see.</p>
                    <a href="{{ route('student.support') }}" class="btn btn-primary" style="width:100%;justify-content:center;">
                        Suggest Now
                    </a>
                </div>
            </div>
        </div>
    </aside>
</div>

<style>
    .registration-success {
        max-width: 1200px;
        margin: 20px auto;
        padding: 14px 20px;
        background: #ecfdf5;
        border: 1px solid #10b981;
        color: #047857;
        border-radius: 10px;
        font-weight: 600;
    }

    .registration-error {
        max-width: 1200px;
        margin: 20px auto;
        padding: 14px 20px;
        background: #fef2f2;
        border: 1px solid #ef4444;
        color: #b91c1c;
        border-radius: 10px;
        font-weight: 600;
    }

    .status-badge {
        display: inline-block;
        padding: 7px 16px;
        border-radius: 8px;
        font-size: 0.78rem;
        font-weight: 600;
        text-decoration: none;
    }
    .status-registered { background: #ecfdf5; color: #047857; border: 1px solid #10b981; }
    .status-pending     { background: #fffbeb; color: #b45309; border: 1px solid #f59e0b; }
    .status-completed   { background: #f3f4f6; color: #374151; border: 1px solid #d1d5db; }
</style>

@endsection
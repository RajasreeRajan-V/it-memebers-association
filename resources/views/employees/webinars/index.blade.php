@extends('layouts.app')

@section('title', 'Events & Webinars')

@section('content')

@push('styles')
{{-- Remove this <script> tag if Tailwind is already compiled into your app's build.
     Kept here only so this page renders standalone for preview. --}}
<script src="https://cdn.tailwindcss.com"></script>
<style>
    .line-clamp-2{display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
</style>
@endpush

<div class="bg-white min-h-screen overflow-x-hidden">

    @if(session('success'))
        <div class="max-w-6xl mx-auto px-6 pt-6">
            <div class="rounded-xl border border-emerald-200 bg-emerald-50 text-emerald-700 font-semibold text-sm px-5 py-3.5">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-6xl mx-auto px-6 pt-6">
            <div class="rounded-xl border border-red-200 bg-red-50 text-red-700 font-semibold text-sm px-5 py-3.5">
                {{ session('error') }}
            </div>
        </div>
    @endif

    {{-- ============ HERO ============ --}}
    <div class="bg-gradient-to-b from-[#F5F8FF] to-white border-b border-slate-100">
        <div class="max-w-6xl mx-auto px-6 py-14 grid md:grid-cols-2 gap-10 items-center">

            {{-- Left: text content --}}
            <div class="flex flex-col items-start text-left">
                <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-blue-700 bg-blue-100/70 px-3.5 py-1.5 rounded-full mb-5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17.25 6.75L22.5 3v13.5l-5.25-3.75m-9.75 3.75h9.75V4.5H1.5v12h6.75z"/>
                    </svg>
                    EVENTS &amp; WEBINARS
                </span>

                <h1 class="text-4xl sm:text-5xl font-extrabold text-slate-900 leading-tight mb-4">
                    Learn. Connect.<br>
                    <span class="text-blue-600">Grow.</span>
                </h1>

                <p class="text-slate-500 text-base mb-7 max-w-md">
                    Join live sessions with mentors, attend webinars and workshops,
                    and sharpen your skills for what's next.
                </p>

                <div class="flex items-center gap-3">
                    <a href="#event-list" class="inline-flex items-center gap-1.5 rounded-lg bg-blue-600 text-white text-sm font-semibold px-5 py-2.5 hover:bg-blue-700 transition">
                        Browse Events
                    </a>
                    <a href="{{ route('employee.webinars.my') }}" class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-white text-slate-700 text-sm font-semibold px-5 py-2.5 hover:border-blue-400 hover:text-blue-600 transition">
                        My Webinars
                    </a>
                </div>
            </div>

            {{-- Right: hero image with floating stat chips --}}
            <div class="relative flex justify-center md:justify-end">
                <img
                    src="{{ asset('assets/img/web.png') }}"
                    alt="Events and webinars hero"
                    class="w-full max-w-sm h-auto rounded-xl object-cover"
                    onerror="this.style.display='none'"
                >

                <div class="absolute top-4 left-0 md:left-4 flex items-center gap-2 bg-white rounded-xl shadow-lg shadow-blue-900/10 px-4 py-2.5">
                    <span class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17.25 6.75L22.5 3v13.5l-5.25-3.75m-9.75 3.75h9.75V4.5H1.5v12h6.75z"/>
                        </svg>
                    </span>
                    <span class="text-sm font-semibold text-slate-800 whitespace-nowrap">
                        {{ $counts['all'] }} Live Events
                    </span>
                </div>

                <div class="absolute top-1/2 -translate-y-1/2 right-0 md:-right-4 w-11 h-11 rounded-full bg-white shadow-lg shadow-blue-900/10 flex items-center justify-center text-blue-600">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.288 15.038a5.25 5.25 0 017.424 0M5.106 11.856c3.807-3.808 9.98-3.808 13.788 0M1.924 8.674c5.565-5.565 14.587-5.565 20.152 0M12.75 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" /></svg>
                </div>

                <div class="absolute bottom-6 left-0 md:-left-6 flex items-center gap-2 bg-white rounded-xl shadow-lg shadow-blue-900/10 px-4 py-2.5">
                    <span class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center shrink-0 text-emerald-700 font-bold text-sm">
                        M
                    </span>
                    <span class="text-sm font-semibold text-slate-800 whitespace-nowrap">
                        Mentor-led <span class="block text-xs font-medium text-slate-400">Small groups</span>
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- ============ BODY ============ --}}
    <div class="max-w-7xl mx-auto px-4 py-8 grid lg:grid-cols-[260px_1fr_300px] gap-6" id="event-list">

        {{-- ---------- LEFT: Filters ---------- --}}
        <aside class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 h-fit lg:sticky lg:top-6">
            <form method="GET" action="{{ route('employee.webinars') }}">

                <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                    <h3 class="flex items-center gap-2 text-base font-semibold text-slate-800">
                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 6h16M7 12h10M10 18h4"/>
                        </svg>
                        Filters
                    </h3>
                    <a href="{{ route('employee.webinars') }}" class="text-sm font-medium text-blue-600 hover:underline">Clear all</a>
                </div>

                {{-- Search --}}
                <div class="py-4 border-b border-slate-100">
                    <h4 class="text-xs font-semibold tracking-widest text-slate-400 uppercase mb-3">Search Events</h4>
                    <input
                        type="text" id="q" name="q" value="{{ $search }}"
                        placeholder="Search events..."
                        class="w-full border border-slate-200 rounded-md text-sm py-1.5 px-2.5 text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500/40"
                    >
                </div>

                {{-- Event type --}}
                <div class="py-4 border-b border-slate-100">
                    <h4 class="text-xs font-semibold tracking-widest text-slate-400 uppercase mb-3">Event Type</h4>
                    <ul class="space-y-1">
                        <li>
                            <label class="flex items-center gap-2.5 px-2.5 py-1.5 rounded-md text-sm cursor-pointer transition
                                          {{ !$activeType ? 'bg-blue-50 text-blue-600 font-medium' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-800' }}">
                                <input type="radio" name="type" value="" {{ !$activeType ? 'checked' : '' }}
                                       class="accent-blue-600" onchange="this.form.submit()">
                                All Types ({{ $counts['all'] }})
                            </label>
                        </li>
                        <li>
                            <label class="flex items-center gap-2.5 px-2.5 py-1.5 rounded-md text-sm cursor-pointer transition
                                          {{ $activeType === 'webinar' ? 'bg-blue-50 text-blue-600 font-medium' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-800' }}">
                                <input type="radio" name="type" value="webinar" {{ $activeType === 'webinar' ? 'checked' : '' }}
                                       class="accent-blue-600" onchange="this.form.submit()">
                                Webinars ({{ $counts['webinar'] }})
                            </label>
                        </li>
                        <li>
                            <label class="flex items-center gap-2.5 px-2.5 py-1.5 rounded-md text-sm cursor-pointer transition
                                          {{ $activeType === 'workshop' ? 'bg-blue-50 text-blue-600 font-medium' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-800' }}">
                                <input type="radio" name="type" value="workshop" {{ $activeType === 'workshop' ? 'checked' : '' }}
                                       class="accent-blue-600" onchange="this.form.submit()">
                                Workshops ({{ $counts['workshop'] }})
                            </label>
                        </li>
                    </ul>
                </div>

                {{-- Date --}}
                <div class="py-4">
                    <h4 class="text-xs font-semibold tracking-widest text-slate-400 uppercase mb-3">Date</h4>
                    <ul class="space-y-1">
                        @foreach(['' => 'All', 'today' => 'Today', 'week' => 'This Week', 'month' => 'This Month'] as $value => $label)
                            @php $isActive = $activeDate === $value || (!$activeDate && $value === ''); @endphp
                            <li>
                                <label class="flex items-center gap-2.5 px-2.5 py-1.5 rounded-md text-sm cursor-pointer transition
                                              {{ $isActive ? 'bg-blue-50 text-blue-600 font-medium' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-800' }}">
                                    <input type="radio" name="date" value="{{ $value }}" {{ $isActive ? 'checked' : '' }}
                                           class="accent-blue-600" onchange="this.form.submit()">
                                    {{ $label }}
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <button type="submit" class="w-full rounded-lg bg-blue-600 text-white text-sm font-medium py-2 hover:bg-blue-700 transition">
                    Apply Filters
                </button>
            </form>
        </aside>

        {{-- ---------- CENTER: Event list ---------- --}}
        <main>
            <div class="flex items-center justify-between gap-4 mb-5">
                <div>
                    <h2 class="text-[13px] font-bold text-slate-500 uppercase tracking-[0.12em]">All Events</h2>
                    <p class="text-sm text-slate-400 mt-1">
                        {{ $events->total() }} {{ \Illuminate\Support\Str::plural('event', $events->total()) }} found
                    </p>
                </div>

                <form method="GET" action="{{ route('employee.webinars') }}" class="flex items-center gap-2 shrink-0">
                    @foreach(request()->except(['sort', 'page']) as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach
                    <label class="text-sm font-medium text-slate-500">Sort by:</label>
                    <select name="sort" onchange="this.form.submit()"
                            class="border border-slate-200 rounded-md text-sm font-medium py-1.5 px-2.5 text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500/40">
                        <option value="upcoming" {{ $activeSort === 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                        <option value="newest" {{ $activeSort === 'newest' ? 'selected' : '' }}>Newest</option>
                    </select>
                </form>
            </div>

            @if($events->isEmpty())
                <div class="bg-white border border-slate-200 rounded-xl text-center text-slate-400 py-14 text-base font-medium">
                    No events match your filters right now. Try clearing filters or check back soon.
                </div>
            @else
                <div class="space-y-3">
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
                        <article class="bg-white border border-slate-200 rounded-xl px-4 py-3.5 hover:shadow-sm hover:border-slate-300 transition">
                            <div class="flex items-start gap-3">
                                @if($event->banner)
                                    <img src="{{ Storage::url($event->banner) }}" alt="{{ $event->title }}"
                                         class="w-14 h-14 object-cover rounded-lg bg-slate-100 shrink-0">
                                @else
                                    <span class="w-14 h-14 rounded-lg flex items-center justify-center shrink-0
                                                 {{ $isWorkshop ? 'bg-emerald-50 text-emerald-600' : 'bg-blue-50 text-blue-600' }}">
                                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                            @if($isWorkshop)
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                            @else
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5l4.72-2.72a.75.75 0 011.125.65v8.14a.75.75 0 01-1.125.65L15.75 15M4.5 18.75h9a1.5 1.5 0 001.5-1.5v-7.5a1.5 1.5 0 00-1.5-1.5h-9a1.5 1.5 0 00-1.5 1.5v7.5a1.5 1.5 0 001.5 1.5z" />
                                            @endif
                                        </svg>
                                    </span>
                                @endif

                                <div class="flex-1 min-w-0">
                                    <div class="flex items-start justify-between gap-3">
                                        <div class="min-w-0">
                                            <div class="flex items-center flex-wrap gap-2">
                                                <h3 class="text-[14.5px] font-bold text-slate-900 leading-snug tracking-tight">
                                                    {{ $event->title }}
                                                </h3>
                                                @if($event->category)
                                                    <span class="inline-flex items-center text-[10px] font-bold tracking-wide text-amber-700 bg-amber-50 px-2 py-0.5 rounded-full uppercase shrink-0">
                                                        {{ $event->category }}
                                                    </span>
                                                @endif
                                                <span class="inline-flex items-center text-[10px] font-bold tracking-wide {{ $isWorkshop ? 'text-emerald-700 bg-emerald-50' : 'text-blue-700 bg-blue-50' }} px-2 py-0.5 rounded-full uppercase shrink-0">
                                                    {{ $event->type }}
                                                </span>
                                            </div>

                                            <p class="text-[13px] text-slate-500 leading-relaxed line-clamp-2 mt-1.5">
                                                {{ \Illuminate\Support\Str::limit($event->description, 110) }}
                                            </p>

                                            <p class="text-[12.5px] text-slate-400 font-medium mt-2">
                                                {{ $scheduledDate->format('d M, Y') }}
                                                @if($scheduledTime) &middot; {{ $scheduledTime }} @endif
                                                @if($event->platform) &middot; {{ $event->platform }} @endif
                                                @if($event->mentor) &middot; {{ $event->mentor->name }} @endif
                                            </p>
                                        </div>

                                        <div class="text-right shrink-0">
                                            <p class="text-slate-600 font-bold text-[13.5px] flex items-center justify-end gap-1">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                                                {{ $event->capacity ?: '—' }}
                                            </p>
                                            <p class="text-[11.5px] text-slate-400 font-medium mt-1">
                                                {{ $scheduledDate->diffForHumans() }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        @include('employees.webinars._action', ['event' => $event, 'myRegistrations' => $myRegistrations])
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="mt-6 flex justify-center">
                    {{ $events->onEachSide(1)->links() }}
                </div>
            @endif
        </main>

        {{-- ---------- RIGHT: Upcoming + Categories ---------- --}}
        <aside class="space-y-6">
            {{-- Upcoming events --}}
            <div>
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-xs font-semibold tracking-widest text-slate-400 uppercase">Upcoming Events</h3>
                    <a href="{{ route('employee.webinars') }}?sort=upcoming" class="text-sm font-medium text-blue-600 hover:underline">View all</a>
                </div>
                <ul class="space-y-3">
                    @forelse($upcoming as $item)
                        @php $d = \Illuminate\Support\Carbon::parse($item->scheduled_date); @endphp
                        <li>
                            <a href="{{ route('employee.webinars.show', $item) }}" class="flex items-center gap-3 group">
                                <span class="w-11 h-11 rounded-lg bg-blue-50 text-blue-600 font-bold text-sm flex items-center justify-center shrink-0">
                                    {{ $d->format('d') }}
                                </span>
                                <div class="min-w-0 flex-1">
                                    <p class="text-sm font-medium text-slate-800 group-hover:text-blue-600 leading-snug line-clamp-2">
                                        {{ $item->title }}
                                    </p>
                                    <p class="text-xs text-slate-400 mt-1">
                                        {{ $d->format('M') }} &middot; {{ $d->format('h:i A') }} &middot; {{ ucfirst($item->type) }}
                                    </p>
                                </div>
                                <span class="text-slate-300 group-hover:text-blue-600 transition shrink-0">&rarr;</span>
                            </a>
                        </li>
                    @empty
                        <p class="text-sm text-slate-400">No upcoming events yet.</p>
                    @endforelse
                </ul>
            </div>

            {{-- Categories --}}
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
                <h3 class="text-xs font-semibold tracking-widest text-slate-400 uppercase mb-3">Event Categories</h3>
                @php $dotColors = ['bg-blue-500', 'bg-emerald-500', 'bg-pink-500', 'bg-amber-500', 'bg-purple-500', 'bg-cyan-500']; @endphp

                <a href="{{ route('employee.webinars') }}"
                   class="flex items-center justify-between px-2.5 py-1.5 rounded-md text-sm transition
                          {{ !$activeType ? 'bg-blue-50 text-blue-600 font-medium' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-800' }}">
                    <span class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                        All Categories
                    </span>
                    <span class="text-xs {{ !$activeType ? 'text-blue-500' : 'text-slate-400' }}">{{ $counts['all'] }}</span>
                </a>

                @foreach($categories as $i => $cat)
                    <a href="{{ route('employee.webinars', ['q' => $cat->category]) }}"
                       class="flex items-center justify-between px-2.5 py-1.5 rounded-md text-sm text-slate-600 hover:bg-slate-50 hover:text-slate-800 transition">
                        <span class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full {{ $dotColors[$i % count($dotColors)] }}"></span>
                            {{ $cat->category }}
                        </span>
                        <span class="text-xs text-slate-400">{{ $cat->total }}</span>
                    </a>
                @endforeach
            </div>
        </aside>
    </div>
</div>

<style>
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
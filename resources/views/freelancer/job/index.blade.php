@extends('layouts.app')

@section('content')
    {{-- ================= PAGE STYLES ================= --}}
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        h1,
        h2,
        h3,
        .font-display {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .job-card {
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .job-card:hover {
            transform: translateY(-3px);
        }

        .shadow-card {
            box-shadow: 0 1px 3px rgba(16, 24, 40, .06), 0 1px 2px rgba(16, 24, 40, .04);
        }

        .shadow-cardHover {
            box-shadow: 0 12px 24px -8px rgba(16, 24, 40, .14), 0 4px 8px -4px rgba(16, 24, 40, .08);
        }

        .btn-primary {
            transition: transform .15s ease, box-shadow .15s ease, background-color .15s ease;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 18px -6px rgba(59, 91, 219, .45);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .sidebar-card {
            transition: box-shadow .2s ease, transform .2s ease;
        }

        .sidebar-card:hover {
            box-shadow: 0 10px 20px -6px rgba(16, 24, 40, .10);
        }

        ::selection {
            background: rgba(59, 91, 219, .18);
        }

        /* Status badges */
        .status-badge {
            font-size: 10px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 9999px;
            text-transform: uppercase;
            letter-spacing: 0.025em;
        }

        .status-approved {
            background: #dcfce7;
            color: #166534;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-rejected {
            background: #fee2e2;
            color: #991b1b;
        }

        .status-closed {
            background: #e5e7eb;
            color: #374151;
        }

        .status-draft {
            background: #e0e7ff;
            color: #3730a3;
        }

        .verified-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: #dcfce7;
            color: #166534;
            font-size: 10px;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 9999px;
        }

        .verified-badge svg {
            width: 12px;
            height: 12px;
        }
    </style>

    {{-- ================= TAILWIND CONFIG ================= --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        display: ['"Plus Jakarta Sans"', 'sans-serif'],
                        body: ['"Inter"', 'sans-serif'],
                    },
                    colors: {
                        ink: '#12203D',
                        slate2: '#5B6478',
                        brand: '#3457D5',
                        brand2: '#7B8FF7',
                        coral: '#FF6B4A',
                        surface: '#F5F7FC',
                        line: '#E8EAF3',
                        mint: '#16A34A',
                    },
                    boxShadow: {
                        card: '0 1px 2px rgba(18,32,61,0.04), 0 8px 24px -12px rgba(18,32,61,0.10)',
                        cardHover: '0 4px 10px rgba(18,32,61,0.06), 0 16px 32px -14px rgba(52,87,213,0.18)',
                    }
                }
            }
        }
    </script>

    {{-- ================= HERO / SEARCH ================= --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-[#EAF0FF] via-[#F3F6FF] to-[#FBF4EF]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 pt-10 sm:pt-16 pb-20 sm:pb-28 relative z-10">
            <div class="grid lg:grid-cols-[1.15fr_0.85fr] gap-10 items-center">

                {{-- LEFT: COPY + SEARCH --}}
                <div class="flex flex-col items-center text-center">
                    <div class="max-w-2xl">
                        <span
                            class="inline-flex items-center gap-1.5 text-[11px] font-semibold tracking-wide uppercase text-brand bg-brand/10 px-3 py-1.5 rounded-full">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            {{ $projects->total() }} open roles
                        </span>

                        <h1
                            class="font-display text-3xl sm:text-4xl md:text-5xl font-extrabold leading-[1.1] tracking-tight text-ink mt-4 sm:mt-5">
                            Find the Right Job,<br>
                            <span class="text-brand">Build Your Future</span>
                        </h1>
                        <p class="mt-3 sm:mt-4 text-slate2 max-w-md mx-auto text-sm md:text-base leading-relaxed">
                            Explore thousands of opportunities from vetted employers and take the next step in your career
                            journey.
                        </p>
                    </div>

                    <form action="{{ route('freelancer.job') }}" method="GET"
                        class="mt-6 sm:mt-8 bg-white rounded-xl shadow-card ring-1 ring-black/[0.03] p-1 flex flex-col md:flex-row gap-1 max-w-2xl w-full">
                        <label
                            class="flex items-center gap-2 px-3 py-2.5 md:py-2 flex-1 border-b md:border-b-0 md:border-r border-line">
                            <svg class="w-3.5 h-3.5 text-slate2 shrink-0" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <input type="text" name="q" placeholder="Job title, keywords or company"
                                value="{{ request('q') }}"
                                class="w-full text-xs sm:text-sm text-ink outline-none placeholder:text-slate2/70">
                        </label>
                        <label
                            class="flex items-center gap-2 px-3 py-2.5 md:py-2 flex-1 border-b md:border-b-0 md:border-r border-line">
                            <svg class="w-3.5 h-3.5 text-slate2 shrink-0" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <input type="text" name="location" placeholder="City, State, or Country"
                                value="{{ request('location') }}"
                                class="w-full text-xs sm:text-sm text-ink outline-none placeholder:text-slate2/70">
                        </label>
                        <button type="submit"
                            class="btn-primary bg-brand hover:bg-brand/90 focus-visible:ring-2 focus-visible:ring-brand focus-visible:ring-offset-2 text-white text-xs sm:text-sm font-semibold px-5 py-2.5 md:py-2 rounded-lg whitespace-nowrap self-center">
                            Search Jobs
                        </button>
                    </form>

                    <div class="mt-4 flex flex-wrap items-center justify-center gap-2 text-xs px-2">
                        <span class="font-semibold text-ink/70 mr-1">Popular:</span>
                        @foreach (['Web Developer', 'UI/UX Designer', 'Flutter Developer', 'Data Analyst'] as $tag)
                            <a href="?q={{ urlencode($tag) }}"
                                class="px-3 py-1.5 rounded-full bg-white/80 hover:bg-white hover:text-brand hover:shadow-sm transition-all border border-line text-slate2 font-medium">{{ $tag }}</a>
                        @endforeach
                    </div>
                </div>

                {{-- RIGHT: HERO IMAGE --}}
                <div class="hidden lg:flex justify-center items-center relative max-h-72">
                    <div class="absolute -top-2 left-2 z-20 bg-white rounded-2xl shadow-xl p-2.5 flex items-center gap-2">
                        <span class="w-7 h-7 rounded-lg bg-brand/10 flex items-center justify-center shrink-0">
                            <svg class="w-3.5 h-3.5 text-brand" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12h6m-6 4h6M9 8h1M5 21h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </span>
                        <span class="text-[11px] font-semibold text-ink pr-1">{{ $projects->total() }} Jobs</span>
                    </div>

                    <div class="absolute bottom-6 left-0 z-20 bg-white rounded-2xl shadow-xl p-2.5 flex items-center gap-2">
                        <span class="w-7 h-7 rounded-lg bg-mint/10 flex items-center justify-center shrink-0">
                            <svg class="w-3.5 h-3.5 text-mint" fill="none" stroke="currentColor" stroke-width="2.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        </span>
                        <span class="text-[11px] font-semibold text-ink pr-1">Browse The Jobs</span>
                    </div>

                    <img src="{{ asset('assets/img/bagg.png') }}" alt="Find your next job"
                        class="relative z-10 w-full max-w-md max-h-72 h-auto object-contain border-0 m-0 select-none pointer-events-none"
                        onerror="this.style.display='none'">
                </div>
            </div>
        </div>
    </section>

    {{-- ================= MAIN CONTENT ================= --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 -mt-8 sm:-mt-12 relative z-10 pb-24">

        <div class="grid grid-cols-1 lg:grid-cols-[248px_1fr_300px] gap-6">

            {{-- FILTERS SIDEBAR --}}
            <aside class="bg-white rounded-2xl shadow-card ring-1 ring-black/[0.03] p-5 h-fit lg:sticky lg:top-6">
                <input type="checkbox" id="mobile-filters-toggle" class="peer hidden">

                <div class="flex items-center justify-between mb-5 pb-4 border-b border-line">
                    <h3 class="font-display font-bold text-sm text-ink flex items-center gap-2">
                        <svg class="w-4 h-4 text-brand" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 4h18M6 9h12M10 14h4M11 19h2" />
                        </svg>
                        Filters
                    </h3>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('freelancer.job') }}"
                            class="text-xs text-brand font-semibold hover:underline">Clear
                            all</a>
                        <label for="mobile-filters-toggle"
                            class="lg:hidden flex items-center justify-center w-7 h-7 rounded-lg border border-line text-slate2 cursor-pointer">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </label>
                    </div>
                </div>

                <div class="hidden peer-checked:block lg:block">
                    <form id="filter-form" method="GET" action="{{ route('freelancer.job') }}">
                        <input type="hidden" name="q" value="{{ request('q') }}">
                        <input type="hidden" name="location" value="{{ request('location') }}">
                        <div class="mb-6 pb-6 border-b border-line">
                            <h4 class="text-[11px] font-bold text-slate2 uppercase tracking-wider mb-3">Project Type</h4>
                            <div class="space-y-2.5 text-sm">
                                @foreach (['' => 'All Types', 'fixed' => 'Fixed Price', 'hourly' => 'Hourly'] as $value => $label)
                                    <label class="group flex items-center gap-2.5 cursor-pointer">
                                        <span
                                            class="relative flex items-center justify-center w-4 h-4 shrink-0 rounded-full border-2 border-line group-hover:border-brand/60 peer-checked:border-brand transition-colors">
                                            <input type="radio" name="project_type" value="{{ $value }}"
                                                {{ request('project_type') == $value ? 'checked' : '' }}
                                                onchange="this.form.submit()"
                                                class="peer appearance-none absolute inset-0 w-full h-full cursor-pointer">
                                            <span
                                                class="w-2 h-2 rounded-full bg-brand scale-0 peer-checked:scale-100 transition-transform"></span>
                                        </span>
                                        <span
                                            class="text-ink/80 group-hover:text-ink transition-colors">{{ $label }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-6 pb-6 border-b border-line">
                            <h4 class="text-[11px] font-bold text-slate2 uppercase tracking-wider mb-3">
                                Work Mode
                            </h4>

                            <div class="space-y-2.5 text-sm">
                                @foreach (['' => 'All Modes', 'onsite' => 'Onsite', 'hybrid' => 'Hybrid', 'remote' => 'Remote'] as $value => $label)
                                    <label class="group flex items-center gap-2.5 cursor-pointer">
                                        <span
                                            class="relative flex items-center justify-center w-4 h-4 shrink-0 rounded-full border-2 border-line group-hover:border-brand/60 peer-checked:border-brand transition-colors">

                                            <input type="radio" name="work_mode" value="{{ $value }}"
                                                {{ request('work_mode') == $value ? 'checked' : '' }}
                                                onchange="this.form.submit()"
                                                class="peer appearance-none absolute inset-0 w-full h-full cursor-pointer">

                                            <span
                                                class="w-2 h-2 rounded-full bg-brand scale-0 peer-checked:scale-100 transition-transform"></span>
                                        </span>

                                        <span class="text-ink/80 group-hover:text-ink transition-colors">
                                            {{ $label }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- Budget Range --}}
                        <div class="mb-6 pb-6 border-b border-line">
                            <h4 class="text-[11px] font-bold text-slate2 uppercase tracking-wider mb-3">Budget Range</h4>
                            <div class="flex gap-2">
                                <input type="number" name="min_budget" id="min-budget" placeholder="Min"
                                    value="{{ request('min_budget') }}"
                                    class="w-full text-xs border border-line rounded-lg px-3 py-2 outline-none focus:border-brand focus:ring-1 focus:ring-brand/30">
                                <input type="number" name="max_budget" id="max-budget" placeholder="Max"
                                    value="{{ request('max_budget') }}"
                                    class="w-full text-xs border border-line rounded-lg px-3 py-2 outline-none focus:border-brand focus:ring-1 focus:ring-brand/30">
                            </div>
                        </div>

                        {{-- Duration --}}
                        <div class="mb-6 pb-6 border-b border-line">
                            <h4 class="text-[11px] font-bold text-slate2 uppercase tracking-wider mb-3">Duration</h4>
                            <select name="duration" onchange="this.form.submit()"
                                class="w-full text-xs border border-line rounded-lg px-3 py-2 outline-none focus:border-brand focus:ring-1 focus:ring-brand/30 bg-white">
                                <option value="">Any Duration</option>
                                <option value="less_than_1_week"
                                    {{ request('duration') == 'less_than_1_week' ? 'selected' : '' }}>Less than 1 week
                                </option>
                                <option value="1_4_weeks" {{ request('duration') == '1_4_weeks' ? 'selected' : '' }}>1-4
                                    weeks
                                </option>
                                <option value="1_3_months" {{ request('duration') == '1_3_months' ? 'selected' : '' }}>1-3
                                    months
                                </option>
                                <option value="3_6_months" {{ request('duration') == '3_6_months' ? 'selected' : '' }}>3-6
                                    months
                                </option>
                                <option value="more_than_6_months"
                                    {{ request('duration') == 'more_than_6_months' ? 'selected' : '' }}>More than 6 months
                                </option>
                            </select>
                        </div>

                        {{-- SAVED / APPLIED / INTERVIEWS / IN PROGRESS / HIRED / ARCHIVED NAV --}}
                        {{-- ================= FREELANCER WORK NAVIGATION ================= --}}
                        <div class="pt-5 border-t border-line space-y-2">

                            {{-- Saved Jobs --}}
                            <a href="{{ route('freelancer.saved-jobs') }}"
                                class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold
        {{ request()->routeIs('freelancer.saved-jobs') ? 'bg-brand/10 text-brand' : 'text-ink hover:bg-surface' }}
        transition-colors">

                                <svg class="w-4 h-4 {{ request()->routeIs('freelancer.saved-jobs') ? 'text-brand' : 'text-slate2' }}"
                                    fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-4-7 4V5z" />
                                </svg>

                                <span>Saved Jobs</span>
                            </a>


                            {{-- Applied Jobs --}}
                            <a href="{{ route('freelancer.applied') }}"
                                class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold
        {{ request()->routeIs('freelancer.applied') ? 'bg-brand/10 text-brand' : 'text-ink hover:bg-surface' }}
        transition-colors">

                                <svg class="w-4 h-4 {{ request()->routeIs('freelancer.applied') ? 'text-brand' : 'text-slate2' }}"
                                    fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>

                                <span>Applied Jobs</span>
                            </a>


                            {{-- My Proposals --}}
                            <a href="{{ route('freelancer.proposals') }}"
                                class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold
        {{ request()->routeIs('freelancer.proposals') ? 'bg-brand/10 text-brand' : 'text-ink hover:bg-surface' }}
        transition-colors">

                                <svg class="w-4 h-4 {{ request()->routeIs('freelancer.proposals') ? 'text-amber-500' : 'text-amber-500' }}"
                                    fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m-6 4h6m-6 4h6" />
                                </svg>

                                <span>My Proposals</span>
                            </a>


                            {{-- Interviews --}}
                            <a href="{{ route('freelancer.interviews') }}"
                                class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold
        {{ request()->routeIs('freelancer.interviews') ? 'bg-brand/10 text-brand' : 'text-ink hover:bg-surface' }}
        transition-colors">

                                <svg class="w-4 h-4 {{ request()->routeIs('freelancer.interviews') ? 'text-brand' : 'text-slate2' }}"
                                    fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5v12a2 2 0 002 2z" />
                                </svg>

                                <span>Interviews</span>
                            </a>


                            {{-- In Progress --}}
                            <a href="{{ route('freelancer.in-progress') }}"
                                class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold
        {{ request()->routeIs('freelancer.in-progress') ? 'bg-brand/10 text-brand' : 'text-ink hover:bg-surface' }}
        transition-colors">

                                <svg class="w-4 h-4 {{ request()->routeIs('freelancer.in-progress') ? 'text-amber-500' : 'text-amber-500' }}"
                                    fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6v6l4 2m5-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>

                                <span>In Progress</span>
                            </a>


                            {{-- Hired --}}
                            <a href="{{ route('freelancer.hired') }}"
                                class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold
        {{ request()->routeIs('freelancer.hired') ? 'bg-brand/10 text-brand' : 'text-ink hover:bg-surface' }}
        transition-colors">

                                <svg class="w-4 h-4 {{ request()->routeIs('freelancer.hired') ? 'text-green-600' : 'text-green-600' }}"
                                    fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 6V5a3 3 0 013-3h0a3 3 0 013 3v1m-9 3h12a2 2 0 012 2v7a2 2 0 01-2 2H6a2 2 0 01-2-2v-7a2 2 0 012-2zm6 4l2 2 4-4" />
                                </svg>

                                <span>Hired</span>
                            </a>


                            {{-- Archived --}}
                            <a href="{{ route('freelancer.archived') }}"
                                class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold
        {{ request()->routeIs('freelancer.archived') ? 'bg-brand/10 text-brand' : 'text-ink hover:bg-surface' }}
        transition-colors">

                                <svg class="w-4 h-4 {{ request()->routeIs('freelancer.archived') ? 'text-slate2' : 'text-slate2' }}"
                                    fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M20.54 5.23l-1.39-2.09A1 1 0 0018.32 2H5.68a1 1 0 00-.83.45L3.46 5.23A2 2 0 003 6.34V8a2 2 0 002 2h14a2 2 0 002-2V6.34a2 2 0 00-.46-1.11zM5 10v8a2 2 0 002 2h10a2 2 0 002-2v-8M9 14h6" />
                                </svg>

                                <span>Archived</span>
                            </a>

                        </div>
                    </form>
                </div>
            </aside>

            {{-- JOB LIST --}}
            <div id="jobs-list" class="scroll-mt-24">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-5">
                    <div class="flex items-baseline gap-2 flex-wrap">
                        <h2 class="font-display font-bold text-lg sm:text-xl text-ink">JOBS FOR YOU</h2>
                        <span class="text-xs text-slate2">{{ $projects->total() }} jobs found</span>
                    </div>

                    <label
                        class="text-xs text-slate2 flex items-center gap-2 bg-white border border-line rounded-lg px-3 py-2">
                        Sort by
                        <select name="sort" onchange="this.form.submit()"
                            class="text-ink font-semibold outline-none bg-transparent">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                            <option value="budget_high" {{ request('sort') == 'budget_high' ? 'selected' : '' }}>Budget:
                                High to Low</option>
                            <option value="budget_low" {{ request('sort') == 'budget_low' ? 'selected' : '' }}>Budget: Low
                                to High</option>
                        </select>
                    </label>
                </div>

                <div class="space-y-4">
                    @forelse ($projects as $project)
                        @php
                            $employerRegistration = optional($project->employer)->employerRegistration;

                            $companyName = $employerRegistration->company_name ?? 'Company Not Available';

                            $isVerified = $employerRegistration->is_verified ?? false;

                            $companyLogo = $employerRegistration->profile_photo ?? null;

                            $companyLogoUrl = $companyLogo ? asset('storage/' . ltrim($companyLogo, '/')) : null;

                            $applicationsCount = $project->applications()->count();

                            $maxBids = $project->maximum_bids ?? 0;

                            $contactPerson = optional($project->employer)->name ?? 'N/A';

                            $allocatedBids = $project->maximum_bids ?? 0;
                            $receivedBids = $applicationsCount;
                            $remainingBids = max(0, $allocatedBids - $receivedBids);

                            $isSaved = in_array($project->id, $savedProjectIds ?? []);
                        @endphp


                        {{-- ================= JOB CARD ================= --}}
                        <div class="job-card bg-white rounded-2xl shadow-card ring-1 ring-black/[0.03]
               p-5 sm:p-6 cursor-pointer transition-all hover:shadow-cardHover"
                            onclick="openJobModal({{ $project->id }})">

                            {{-- ===================================================== --}}
                            {{-- TOP ROW: TITLE + STATUS + PROJECT TYPE + SAVE BUTTON --}}
                            {{-- ===================================================== --}}
                            <div class="flex items-start justify-between gap-4">

                                {{-- LEFT SIDE --}}
                                <div class="min-w-0 flex-1">

                                    {{-- Project Title --}}
                                    <div class="flex items-start gap-2 flex-wrap">

                                        <h3
                                            class="font-display font-bold text-base sm:text-lg
                               text-ink leading-snug">
                                            {{ $project->title }}
                                        </h3>

                                        {{-- Status --}}
                                        @if ($project->status)
                                            <span
                                                class="status-badge
                            {{ $project->status === 'approved'
                                ? 'status-approved'
                                : ($project->status === 'pending'
                                    ? 'status-pending'
                                    : ($project->status === 'rejected'
                                        ? 'status-rejected'
                                        : 'status-closed')) }}">
                                                {{ strtoupper($project->status) }}
                                            </span>
                                        @endif

                                    </div>

                                </div>


                                {{-- ================================================= --}}
                                {{-- RIGHT SIDE: PROJECT TYPE + SAVE BUTTON --}}
                                {{-- ================================================= --}}
                                <div class="flex items-center gap-2 shrink-0" onclick="event.stopPropagation()">

                                    @php
                                        $isSaved = in_array($project->id, $savedProjectIds ?? []);
                                    @endphp

                                    <div class="flex items-center gap-2 shrink-0" onclick="event.stopPropagation()">


                                        {{-- Project Type --}}
                                        @if ($project->project_type)
                                            <span
                                                class="inline-flex items-center px-3 py-1.5
               rounded-full bg-indigo-50 text-indigo-600
               text-xs font-semibold whitespace-nowrap">
                                                {{ ucfirst($project->project_type) }}
                                            </span>
                                        @endif


                                        {{-- Save / Unsave --}}
                                        @if ($isSaved)
                                            <form
                                                action="{{ route('freelancer.unsave-job', ['project' => $project->id]) }}"
                                                method="POST" onclick="event.stopPropagation()">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="w-9 h-9 flex items-center justify-center
                   rounded-full border border-green-200
                   bg-green-50 shadow-sm
                   hover:bg-green-100 transition-all"
                                                    title="Remove from saved jobs">

                                                    <svg class="w-5 h-5 text-green-600" fill="currentColor"
                                                        stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M6 3a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18l-6-4-6 4V3z" />
                                                    </svg>

                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('freelancer.save-job', ['project' => $project->id]) }}"
                                                method="POST" onclick="event.stopPropagation()">
                                                @csrf

                                                <button type="submit"
                                                    class="w-9 h-9 flex items-center justify-center
                   rounded-full border border-gray-200
                   bg-white shadow-sm
                   hover:border-brand hover:bg-brand/5
                   transition-all"
                                                    title="Save job">

                                                    <svg class="w-5 h-5 text-gray-500" fill="none"
                                                        stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M6 3a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18l-6-4-6 4V3z" />
                                                    </svg>

                                                </button>

                                            </form>
                                        @endif


                                    </div>

                                </div>

                            </div>


                            {{-- ===================================================== --}}
                            {{-- EMPLOYER INFO --}}
                            {{-- ===================================================== --}}
                            <div class="flex items-center gap-2 mt-2 flex-wrap">

                                {{-- Company Logo --}}
                                <div
                                    class="w-10 h-10 rounded-xl bg-gray-100 border border-line
               flex items-center justify-center overflow-hidden shrink-0">

                                    @if ($companyLogoUrl)
                                        <img src="{{ $companyLogoUrl }}" alt="{{ $companyName }}"
                                            class="w-full h-full object-cover"
                                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">

                                        {{-- Fallback --}}
                                        <div class="w-full h-full items-center justify-center bg-brand/10 text-brand font-bold text-sm"
                                            style="display:none;">
                                            {{ strtoupper(substr($companyName, 0, 1)) }}
                                        </div>
                                    @else
                                        <div
                                            class="w-full h-full flex items-center justify-center
                       bg-brand/10 text-brand font-bold text-sm">
                                            {{ strtoupper(substr($companyName, 0, 1)) }}
                                        </div>
                                    @endif

                                </div>

                                {{-- Company Name + Verification --}}
                                <div class="flex items-center gap-2 flex-wrap">

                                    <span class="text-sm font-semibold text-ink">
                                        {{ $companyName }}
                                    </span>

                                    @if ($isVerified)
                                        <span class="verified-badge">

                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor">

                                                <path fill-rule="evenodd"
                                                    d="M8.603 3.799A4.49 4.49 0 0112 2.25c1.357 0 2.573.6 3.397 1.549a4.49 4.49 0 013.498 1.307 4.491 4.491 0 011.307 3.497A4.49 4.49 0 0121.75 12a4.49 4.49 0 01-1.549 3.397 4.49 4.49 0 01-1.307 3.497A4.49 4.49 0 0115.603 20.2 4.49 4.49 0 0112 21.75a4.49 4.49 0 01-3.397-1.549 4.49 4.49 0 01-3.498-1.306 4.491 4.491 0 01-1.307-3.498A4.49 4.49 0 012.25 12c0-1.357.6-2.573 1.549-3.397a4.49 4.49 0 011.307-3.497 4.49 4.49 0 013.497-1.307z"
                                                    clip-rule="evenodd" />

                                                <path d="M16.5 9.5l-5 6-3-3" fill="none" stroke="white"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>

                                            Verified Employer

                                        </span>
                                    @endif

                                </div>

                            </div>


                            {{-- ===================================================== --}}
                            {{-- CONTACT PERSON + POSTED DATE --}}
                            {{-- ===================================================== --}}
                            <div class="flex flex-wrap items-center gap-x-3 gap-y-1 mt-1">

                                <span class="text-xs text-slate2">
                                    Contact Person:
                                    <span class="font-medium text-ink">
                                        {{ $contactPerson }}
                                    </span>
                                </span>

                                <span class="text-xs text-slate2">
                                    Posted:
                                    <span class="font-medium">
                                        {{ $project->created_at->diffForHumans() }}
                                    </span>
                                </span>

                            </div>


                            {{-- ===================================================== --}}
                            {{-- LOCATION + WORK MODE --}}
                            {{-- ===================================================== --}}
                            <div
                                class="flex flex-wrap items-center gap-x-3 gap-y-1
                   mt-2 text-xs text-slate2">

                                @if ($project->work_mode === 'remote')
                                    <span class="flex items-center gap-1 text-blue-600">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 2a10 10 0 100 20 10 10 0 000-20zm0 0c2.5 2.5 4 6 4 10s-1.5 7.5-4 10m0-20c-2.5 2.5-4 6-4 10s1.5 7.5 4 10M2 12h20" />
                                        </svg>

                                        Remote

                                    </span>
                                @elseif ($project->work_mode === 'hybrid')
                                    <span class="flex items-center gap-1 text-indigo-600">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3 21h18M5 21V7l7-4 7 4v14M9 9h.01M9 13h.01M15 9h.01M15 13h.01" />
                                        </svg>

                                        Hybrid

                                    </span>
                                @else
                                    <span class="flex items-center gap-1 text-red-500">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 21s-6-5.33-6-10a6 6 0 1112 0c0 4.67-6 10-6 10z" />

                                            <circle cx="12" cy="11" r="2" />
                                        </svg>

                                        {{ collect([$project->city, $project->state, $project->country])->filter()->implode(', ') ?:
                                            'Onsite' }}

                                    </span>
                                @endif


                                @if ($project->visibility === 'private')
                                    <span class="flex items-center gap-1 text-gray-600">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16 10V7a4 4 0 10-8 0v3M5 10h14v10H5V10z" />
                                        </svg>

                                        Private

                                    </span>
                                @endif

                            </div>


                            {{-- ===================================================== --}}
                            {{-- DESCRIPTION --}}
                            {{-- ===================================================== --}}
                            <p class="text-xs text-slate2 mt-3 line-clamp-2">
                                {{ Str::limit($project->description, 140) }}
                            </p>


                            {{-- ===================================================== --}}
                            {{-- SKILLS --}}
                            {{-- ===================================================== --}}
                            @if ($project->skills)
                                @php
                                    $skillsList = is_array($project->skills)
                                        ? $project->skills
                                        : array_map('trim', explode(',', $project->skills));
                                @endphp

                                <div class="flex flex-wrap gap-1.5 mt-3">

                                    @foreach (array_slice($skillsList, 0, 5) as $skill)
                                        <span
                                            class="text-[11px] font-medium text-ink/70
                               bg-surface px-2.5 py-1 rounded-full">
                                            {{ $skill }}
                                        </span>
                                    @endforeach


                                    @if (count($skillsList) > 5)
                                        <span
                                            class="text-[11px] font-medium text-slate2
                               bg-surface px-2.5 py-1 rounded-full">
                                            +{{ count($skillsList) - 5 }} more
                                        </span>
                                    @endif

                                </div>
                            @endif


                            {{-- ===================================================== --}}
                            {{-- BOTTOM ROW --}}
                            {{-- ===================================================== --}}
                            <div
                                class="flex flex-wrap items-center justify-between gap-3
                   mt-4 pt-4 border-t border-line">

                                <div class="flex flex-wrap items-center gap-x-4 gap-y-1">

                                    {{-- Budget --}}
                                    <span class="text-sm font-bold text-brand">
                                        {{ $project->budget }}
                                    </span>


                                    {{-- Duration --}}
                                    @if ($project->duration)
                                        <span class="flex items-center gap-1 text-xs text-slate2">

                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <circle cx="12" cy="12" r="9" />

                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 7v5l3 3" />
                                            </svg>

                                            {{ $project->duration }}

                                        </span>
                                    @endif


                                    {{-- Deadline --}}
                                    @if ($project->deadline)
                                        <span class="flex items-center gap-1 text-xs text-slate2">

                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>

                                            {{ $project->deadline->format('M d, Y') }}

                                        </span>
                                    @endif


                                    {{-- Bids --}}
                                    <span class="text-xs text-slate2">

                                        <span class="font-semibold text-ink">
                                            {{ $receivedBids }}
                                        </span>

                                        Received •

                                        <span class="font-semibold text-green-600">
                                            {{ $remainingBids }}
                                        </span>

                                        of

                                        <span class="font-semibold text-ink">
                                            {{ $allocatedBids }}
                                        </span>

                                        Slots Remaining

                                    </span>

                                </div>


                                {{-- ================================================= --}}
                                {{-- BID BUTTON --}}
                                {{-- ================================================= --}}
                                @if ($project->status === 'approved')
                                    @if (!in_array($project->id, $biddedProjectIds))
                                        <button type="button"
                                            onclick="event.stopPropagation(); openBidModal({{ $project->id }})"
                                            class="btn-primary bg-brand hover:bg-brand/90
                               text-white text-xs font-semibold
                               px-4 py-2 rounded-lg transition-colors
                               flex items-center gap-1.5">
                                            Place Bid

                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 5l7 7-7 7" />
                                            </svg>

                                        </button>
                                    @else
                                        <span
                                            class="inline-flex items-center px-4 py-2
                               rounded-lg bg-green-100 text-green-700
                               text-xs font-semibold">
                                            Proposal Submitted
                                        </span>
                                    @endif
                                @endif

                            </div>

                        </div>

                    @empty

                        {{-- ===================================================== --}}
                        {{-- NO JOBS --}}
                        {{-- ===================================================== --}}
                        <div class="bg-white rounded-2xl shadow-card
               p-8 sm:p-14 text-center">

                            <div
                                class="w-12 h-12 rounded-full bg-surface
                   flex items-center justify-center mx-auto mb-4">

                                <svg class="w-5 h-5 text-slate2" fill="none" stroke="currentColor" stroke-width="1.8"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>

                            </div>

                            <p class="font-display font-bold text-sm text-ink">
                                No jobs match your filters
                            </p>

                            <p class="text-xs text-slate2 mt-1">
                                Try adjusting your filters or create a profile to get
                                personalized recommendations.
                            </p>

                            <a href="{{ route('freelancer.job') }}"
                                class="inline-block mt-4 text-brand
                   text-xs font-semibold hover:underline">
                                Clear Filters
                            </a>

                        </div>
                    @endforelse
                </div>

                <div class="mt-8 overflow-x-auto">
                    {{ $projects->appends(request()->query())->links() }}
                </div>
            </div>

            {{-- RIGHT SIDEBAR --}}
            <aside class="space-y-5 h-fit lg:sticky lg:top-6">
                @php
                    $hasResume = !empty($freelancer->resume ?? null);
                @endphp

                <div
                    class="sidebar-card bg-gradient-to-br from-brand to-brand2 rounded-2xl p-5 text-white relative overflow-hidden">
                    <svg class="w-8 h-8 mb-3 relative z-10" fill="none" stroke="currentColor" stroke-width="1.6"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>

                    @if ($hasResume)
                        <h4 class="font-display font-bold text-sm relative z-10 flex items-center gap-1.5">
                            Resume Uploaded
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        </h4>
                        <p class="text-xs text-white/85 mt-1.5 relative z-10 leading-relaxed">
                            Your resume is on file and ready to be attached to new bids.
                        </p>
                        <div class="flex items-center gap-2 mt-4 relative z-10">
                            <a href="{{ asset('storage/' . $freelancer->resume) }}" target="_blank"
                                class="inline-block bg-white text-brand text-xs font-semibold px-4 py-2.5 rounded-lg hover:bg-white/90 transition-colors">
                                View Resume
                            </a>
                            <a href="{{ route('profile') }}"
                                class="inline-block bg-white/15 text-white text-xs font-semibold px-4 py-2.5 rounded-lg hover:bg-white/25 transition-colors">
                                Replace
                            </a>
                        </div>
                    @else
                        <h4 class="font-display font-bold text-sm relative z-10">Upload Your Resume</h4>
                        <p class="text-xs text-white/85 mt-1.5 relative z-10 leading-relaxed">
                            Add a resume so you don't have to upload one for every bid.
                        </p>

                        <form action="{{ route('freelancer.resume.upload') }}" method="POST"
                            enctype="multipart/form-data" class="mt-4 relative z-10">
                            @csrf
                            <label class="block cursor-pointer">
                                <input type="file" name="resume" accept=".pdf,.doc,.docx" required
                                    onchange="this.form.submit()" class="hidden">
                                <span
                                    class="inline-block bg-white text-brand text-xs font-semibold px-4 py-2.5 rounded-lg hover:bg-white/90 transition-colors">
                                    Upload Resume
                                </span>
                            </label>
                        </form>
                    @endif

                    <div class="absolute -right-6 -bottom-8 w-28 h-28 rounded-full bg-white/10"></div>
                    <div class="absolute right-8 -top-6 w-16 h-16 rounded-full bg-white/10"></div>
                </div>

                <div class="sidebar-card bg-white rounded-2xl shadow-card ring-1 ring-black/[0.03] p-5">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="font-display font-bold text-sm text-ink">Top Companies Hiring</h4>
                    </div>
                    <div class="space-y-1">
                        <p class="text-xs text-slate2">No active listings yet.</p>
                    </div>
                </div>

                <div class="sidebar-card bg-[#E7F1FF] rounded-2xl p-5 relative overflow-hidden">
                    <div class="flex items-start justify-between gap-3 relative z-10">
                        <div class="min-w-0">
                            <h4 class="font-display font-bold text-sm text-ink">Work From Anywhere</h4>
                            <p class="text-xs text-slate2 mt-1.5 leading-relaxed max-w-[150px]">
                                Explore remote jobs from top companies hiring globally.
                            </p>
                        </div>
                        <img src="{{ asset('images/earth-icon.png') }}" alt="Globe"
                            class="w-16 h-16 object-contain shrink-0 -mt-1 -mr-1" onerror="this.style.display='none'">
                    </div>

                    <a href="{{ route('freelancer.job', ['work_mode' => 'remote']) }}"
                        class="btn-primary inline-flex items-center gap-1.5 mt-4 bg-brand text-white text-xs font-semibold px-4 py-2.5 rounded-lg hover:bg-brand/90 relative z-10">
                        Explore Remote Jobs
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>

                    <div class="absolute -right-8 -bottom-10 w-32 h-32 rounded-full bg-brand/10"></div>
                </div>

                <div class="sidebar-card bg-white rounded-2xl shadow-card ring-1 ring-black/[0.03] p-5">
                    <h4 class="font-display font-bold text-sm text-ink">Get Job Alerts</h4>
                    <p class="text-xs text-slate2 mt-1.5 leading-relaxed">Subscribe and never miss an opportunity that
                        matches your profile.</p>
                    <form action="#" method="POST" class="mt-3.5 flex flex-col gap-2">
                        <input type="email" name="email" placeholder="Enter your email" required
                            class="w-full text-xs border border-line rounded-lg px-3 py-2.5 outline-none focus:border-brand focus:ring-1 focus:ring-brand/30 transition-colors">
                        <button type="submit"
                            class="btn-primary bg-brand text-white text-xs font-semibold px-4 py-2.5 rounded-lg hover:bg-brand/90 focus-visible:ring-2 focus-visible:ring-brand focus-visible:ring-offset-2">
                            Subscribe
                        </button>
                    </form>
                </div>
            </aside>
        </div>
    </section>

    {{-- ================= JOB DETAILS MODAL ================= --}}
    <div id="job-modal" class="hidden fixed inset-0 z-[1100]">
        <div id="job-modal-backdrop" class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>
        <div class="relative min-h-full flex items-start justify-center p-4 sm:p-6 pt-12 sm:pt-28">
            <div
                class="bg-white rounded-2xl shadow-lg ring-1 ring-black/[0.03] w-full max-w-2xl max-h-[75vh] flex flex-col overflow-hidden">
                <div class="flex items-center justify-between px-4 sm:px-6 py-4 border-b border-gray-100 shrink-0">
                    <h2 class="font-display font-bold text-base sm:text-lg text-ink">Project Details</h2>
                    <button type="button" id="job-modal-close" aria-label="Close"
                        class="w-9 h-9 flex items-center justify-center rounded-lg border border-gray-200 text-gray-500 hover:text-gray-700 hover:bg-gray-50 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div id="job-modal-content" class="overflow-y-auto p-4 sm:p-6"></div>
            </div>
        </div>
    </div>
    {{-- ================= BID FORM MODAL ================= --}}
    <div id="bid-modal" class="hidden fixed inset-0 z-[1200]">
        <div id="bid-modal-backdrop" class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>
        <div class="relative min-h-full flex items-start justify-center p-4 sm:p-6 pt-12 sm:pt-20">
            <div
                class="bg-white rounded-2xl shadow-xl ring-1 ring-black/[0.03] w-full max-w-2xl max-h-[80vh] flex flex-col overflow-hidden">
                <div class="flex items-center justify-between px-4 sm:px-6 py-4 border-b border-gray-100 shrink-0">
                    <div>
                        <h2 class="font-display font-bold text-base sm:text-lg text-ink">Submit Your Proposal</h2>
                        <p class="text-xs text-slate2 mt-0.5" id="bid-project-title">For: Project Name</p>
                    </div>
                    <button type="button" id="bid-modal-close" aria-label="Close"
                        class="w-9 h-9 flex items-center justify-center rounded-lg border border-gray-200 text-gray-500 hover:text-gray-700 hover:bg-gray-50 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="overflow-y-auto p-4 sm:p-6">
                    <form id="bid-form" method="POST" action="{{ route('freelancer.bid.submit') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="project_id" id="bid-project-id" value="">

                        <div class="space-y-5">
                            {{-- Project Budget Display --}}
                            <div class="bg-surface rounded-lg p-4 flex items-center justify-between">
                                <div>
                                    <p class="text-[10px] text-slate2 uppercase tracking-wider">Project Budget</p>
                                    <p class="text-lg font-bold text-brand" id="bid-project-budget">₹0</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-[10px] text-slate2 uppercase tracking-wider">Type</p>
                                    <p class="text-sm font-semibold text-ink" id="bid-project-type">Fixed</p>
                                </div>
                            </div>

                            {{-- Bid Amount --}}
                            <div>
                                <label for="bid-amount" class="block text-xs font-semibold text-ink mb-1.5">
                                    Your Bid Amount <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <span
                                        class="absolute left-3 top-1/2 -translate-y-1/2 text-slate2 font-semibold text-sm">₹</span>
                                    <input type="number" name="bid_amount" id="bid-amount" step="0.01"
                                        min="1" required placeholder="Enter your bid amount"
                                        class="w-full text-sm border border-line rounded-lg pl-8 pr-3 py-2.5 outline-none focus:border-brand focus:ring-1 focus:ring-brand/30 transition-colors"
                                        value="{{ old('bid_amount', $bid->bid_amount ?? '') }}">
                                </div>
                                <p class="text-[10px]
                                        text-slate2 mt-1">Enter your
                                    competitive bid amount</p>
                            </div>

                            {{-- Estimated Delivery --}}
                            <div>
                                <label for="estimated-delivery" class="block text-xs font-semibold text-ink mb-1.5">
                                    Estimated Delivery <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="text" name="estimated_delivery" id="estimated-delivery" required
                                        placeholder="e.g., 15 Days, 2 Weeks, 1 Month"
                                        class="w-full text-sm border border-line rounded-lg px-3 py-2.5 outline-none focus:border-brand focus:ring-1 focus:ring-brand/30 transition-colors"
                                        value="{{ old('estimated_delivery', $bid->estimated_delivery ?? '') }}">
                                </div>
                                <p class="text-[10px] text-slate2 mt-1">How long will it take to complete?</p>
                            </div>

                            {{-- Cover Letter --}}
                            <div>
                                <label for="cover-letter" class="block text-xs font-semibold text-ink mb-1.5">
                                    Cover Letter <span class="text-red-500">*</span>
                                </label>
                                <textarea name="cover_letter" id="cover-letter" rows="4" required
                                    placeholder="Introduce yourself, highlight your relevant experience, and explain why you're the best fit for this project..."
                                    class="w-full text-sm border border-line rounded-lg px-3 py-2.5 outline-none focus:border-brand focus:ring-1 focus:ring-brand/30 transition-colors resize-y min-h-[100px]">{{ old('cover_letter', $bid->cover_letter ?? '') }}</textarea>
                                <p class="text-[10px] text-slate2 mt-1">Minimum 50 characters recommended</p>
                            </div>

                            {{-- Resume Upload --}}
                            <div>
                                <label for="resume" class="block text-xs font-semibold text-ink mb-1.5">
                                    Resume <span class="text-red-500">*</span>
                                </label>
                                <div class="flex items-center gap-3">
                                    <label class="flex-1 cursor-pointer">
                                        <div
                                            class="border-2 border-dashed border-line hover:border-brand rounded-lg px-4 py-3 text-center transition-colors">
                                            <input type="file" name="resume" id="resume" accept=".pdf,.doc,.docx"
                                                required class="hidden">
                                            <div class="flex items-center justify-center gap-2 text-xs text-slate2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                </svg>
                                                <span>Upload Resume</span>
                                            </div>
                                        </div>
                                    </label>
                                    <span class="text-[10px] text-slate2 shrink-0">PDF, DOC, DOCX (Max 5MB)</span>
                                </div>
                                <p id="resume-file-name" class="text-[10px] text-brand mt-1 hidden"></p>
                            </div>

                            {{-- Portfolio Upload --}}
                            <div>
                                <label for="portfolio" class="block text-xs font-semibold text-ink mb-1.5">
                                    Portfolio (Optional)
                                </label>
                                <div class="flex items-center gap-3">
                                    <label class="flex-1 cursor-pointer">
                                        <div
                                            class="border-2 border-dashed border-line hover:border-brand rounded-lg px-4 py-3 text-center transition-colors">
                                            <input type="file" name="portfolio" id="portfolio"
                                                accept=".pdf,.zip,.rar" class="hidden">
                                            <div class="flex items-center justify-center gap-2 text-xs text-slate2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                </svg>
                                                <span>Upload Portfolio</span>
                                            </div>
                                        </div>
                                    </label>
                                    <span class="text-[10px] text-slate2 shrink-0">PDF, ZIP, RAR (Max 20MB)</span>
                                </div>
                                <p id="portfolio-file-name" class="text-[10px] text-brand mt-1 hidden"></p>
                            </div>

                            {{-- GitHub --}}
                            <div>
                                <label for="github" class="block text-xs font-semibold text-ink mb-1.5">
                                    GitHub Profile (Optional)
                                </label>
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate2">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M12 2C6.477 2 2 6.477 2 12c0 4.42 2.865 8.167 6.839 9.49.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.603-3.369-1.34-3.369-1.34-.454-1.156-1.11-1.462-1.11-1.462-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.03-2.682-.103-.253-.447-1.27.098-2.646 0 0 .84-.269 2.75 1.025.8-.223 1.65-.334 2.5-.334.85 0 1.7.111 2.5.334 1.91-1.294 2.75-1.025 2.75-1.025.545 1.376.201 2.393.099 2.646.64.698 1.03 1.591 1.03 2.682 0 3.841-2.337 4.687-4.565 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.578.688.48C19.138 20.167 22 16.42 22 12c0-5.523-4.477-10-10-10z" />
                                        </svg>
                                    </span>
                                    <input type="url" name="github" id="github"
                                        placeholder="https://github.com/yourusername"
                                        class="w-full text-sm border border-line rounded-lg pl-10 pr-3 py-2.5 outline-none focus:border-brand focus:ring-1 focus:ring-brand/30 transition-colors"
                                        value="{{ old('github', $bid->github ?? ($freelancer->github ?? '')) }}">
                                </div>
                            </div>

                            {{-- LinkedIn --}}
                            <div>
                                <label for="linkedin" class="block text-xs font-semibold text-ink mb-1.5">
                                    LinkedIn Profile (Optional)
                                </label>
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate2">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                                        </svg>
                                    </span>
                                    <input type="url" name="linkedin" id="linkedin"
                                        placeholder="https://linkedin.com/in/yourusername"
                                        class="w-full text-sm border border-line rounded-lg pl-10 pr-3 py-2.5 outline-none focus:border-brand focus:ring-1 focus:ring-brand/30 transition-colors"
                                        value="{{ old('linkedin', $bid->linkedin ?? ($freelancer->linkedin ?? '')) }}">
                                </div>
                            </div>

                            {{-- Availability --}}
                            <div>
                                <label class="block text-xs font-semibold text-ink mb-2">
                                    Availability <span class="text-red-500">*</span>
                                </label>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">
                                    @foreach (['full_time' => 'Full Time', 'part_time' => 'Part Time', 'flexible' => 'Flexible'] as $value => $label)
                                        <label
                                            class="flex items-center gap-2.5 p-3 border border-line rounded-lg cursor-pointer hover:border-brand/60 transition-colors has-[:checked]:border-brand has-[:checked]:bg-brand/5">
                                            <input type="radio" name="availability" value="full_time"
                                                {{ old('availability', $bid->availability ?? ($freelancer->availability ?? '')) == 'full_time' ? 'checked' : '' }}
                                                required class="w-4 h-4 text-brand border-line focus:ring-brand/30">
                                            <span class="text-sm font-medium text-ink">{{ $label }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Terms and Submit --}}
                            <div class="pt-4 border-t border-line">
                                <div class="flex items-start gap-2.5 mb-4">
                                    <input type="checkbox" name="terms" id="terms" required
                                        class="mt-0.5 w-4 h-4 text-brand border-line rounded focus:ring-brand/30">
                                    <label for="terms" class="text-xs text-slate2">
                                        I confirm that the information provided is accurate and I agree to the
                                        <a href="#" class="text-brand hover:underline">Terms of Service</a> and
                                        <a href="#" class="text-brand hover:underline">Privacy Policy</a>.
                                    </label>
                                </div>
                                <button type="submit"
                                    class="w-full btn-primary bg-brand hover:bg-brand/90 text-white text-sm font-semibold px-6 py-3 rounded-lg transition-colors flex items-center justify-center gap-2">
                                    Submit Proposal
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 5l7 7-7 7" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= ADD BID FORM JAVASCRIPT ================= --}}

    {{-- ================= PASS PROJECT DATA TO JAVASCRIPT ================= --}}
    <script>
        // Store all project data in JavaScript from the Blade data
        window.projectsData = {
            @foreach ($projects as $project)
                {{ $project->id }}: {
                    id: {{ $project->id }},
                    title: {!! json_encode($project->title) !!},
                    description: {!! json_encode($project->description) !!},
                    project_type: {!! json_encode($project->project_type) !!},
                    budget: {!! json_encode($project->budget) !!},
                    duration: {!! json_encode($project->duration) !!},
                    skills: {!! json_encode(is_array($project->skills) ? $project->skills : explode(',', $project->skills ?? '')) !!},
                    deadline: {!! json_encode($project->deadline) !!},
                    status: {!! json_encode($project->status) !!},
                    work_mode: {!! json_encode($project->work_mode) !!},
                    visibility: {!! json_encode($project->visibility) !!},
                    maximum_bids: {{ $project->maximum_bids ?? 0 }},
                    rejection_reason: {!! json_encode($project->rejection_reason) !!},
                    city: {!! json_encode($project->city) !!},
                    state: {!! json_encode($project->state) !!},
                    country: {!! json_encode($project->country) !!},
                    created_at: {!! json_encode($project->created_at) !!},
                    employer: {
                        name: {!! json_encode($project->employer->name ?? 'N/A') !!},
                        employer_registration: {
                            company_name: {!! json_encode(optional($project->employer->employerRegistration)->company_name ?? 'Company Not Available') !!},
                            is_verified: {{ optional($project->employer->employerRegistration)->is_verified ? 'true' : 'false' }}
                        }
                    },
                    applications_count: {{ $project->applications()->count() }},
                    already_bid: {{ in_array($project->id, $biddedProjectIds) ? 'true' : 'false' }}
                },
            @endforeach
        };
    </script>

    <script>
        (function() {
            var modal = document.getElementById('job-modal');
            var content = document.getElementById('job-modal-content');

            function closeModal() {
                modal.classList.add('hidden');
                content.innerHTML = '';
                document.body.style.overflow = '';
            }

            window.openJobModal = function(projectId) {
                var project = window.projectsData[projectId];
                if (!project) {
                    content.innerHTML = `<div class="text-center py-8">
            <svg class="w-12 h-12 text-red-400 mx-auto mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
            </svg>
            <p class="text-sm text-red-600 font-medium">Project data not available</p>
            <p class="text-xs text-slate2 mt-1">Please try refreshing the page</p>
            <button onclick="closeModal()" class="mt-4 text-brand text-xs font-semibold hover:underline">Close</button>
        </div>`;
                    modal.classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                    return;
                }

                // FIX: Build the bid edit URL dynamically without using route() with empty parameters
                var bidUrl = "{{ url('/freelancer/bid') }}/" + projectId + "/edit";

                var companyName = (project.employer && project.employer.employer_registration && project.employer
                    .employer_registration.company_name) || 'Company Not Available';
                var isVerified = !!(project.employer && project.employer.employer_registration && project.employer
                    .employer_registration.is_verified);
                var contactPerson = (project.employer && project.employer.name) || 'N/A';
                var applicationsCount = project.applications_count || 0;
                var maxBids = project.maximum_bids || 0;
                var formattedDate = '';
                if (project.created_at) {
                    var d = new Date(project.created_at);
                    if (!isNaN(d)) {
                        formattedDate = d.toLocaleDateString('en-US', {
                            year: 'numeric',
                            month: 'short',
                            day: 'numeric'
                        });
                    }
                }
                var formattedDeadline = '';
                if (project.deadline) {
                    var dd = new Date(project.deadline);
                    if (!isNaN(dd)) {
                        formattedDeadline = dd.toLocaleDateString('en-US', {
                            year: 'numeric',
                            month: 'short',
                            day: 'numeric'
                        });
                    }
                }
                var statusMap = {
                    approved: 'status-approved',
                    pending: 'status-pending',
                    rejected: 'status-rejected',
                    closed: 'status-closed',
                    draft: 'status-draft'
                };
                var statusClass = statusMap[project.status] || 'status-pending';
                var statusLabel = project.status ? (project.status.charAt(0).toUpperCase() + project.status.slice(
                    1)) : 'Pending';
                var locationStr = [project.city, project.state, project.country].filter(Boolean).join(', ');
                var skillsArr = Array.isArray(project.skills) ? project.skills : (project.skills ? String(project
                    .skills).split(',').map(function(s) {
                    return s.trim();
                }) : []);
                var skills = skillsArr.filter(Boolean).map(function(s) {
                    return '<span class="text-[11px] font-medium text-ink/70 bg-surface px-2.5 py-1 rounded-full">' +
                        s + '</span>';
                }).join('');

                content.innerHTML = `
        <div class="space-y-5">
            <!-- Header -->
            <div class="flex items-start justify-between gap-4 flex-wrap">
                <div class="flex-1 min-w-[200px]">
                    <h3 class="font-display font-bold text-lg sm:text-xl text-ink">${project.title || 'Untitled Project'}</h3>
                    <div class="flex items-center gap-2 mt-1.5 flex-wrap">
                        <span class="text-sm font-semibold text-ink">${companyName}</span>
                        ${isVerified ? `<span class="verified-badge">
                                                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="currentColor">
                                                                                                        <path fill-rule="evenodd" d="M8.603 3.799A4.49 4.49 0 0112 2.25c1.357 0 2.573.6 3.397 1.549a4.49 4.49 0 013.498 1.307 4.491 4.491 0 011.307 3.497A4.49 4.49 0 0121.75 12a4.49 4.49 0 01-1.549 3.397 4.491 4.491 0 01-1.307 3.497 4.491 4.491 0 01-3.497 1.307A4.49 4.49 0 0112 21.75a4.49 4.49 0 01-3.397-1.549 4.49 4.49 0 01-3.498-1.306 4.491 4.491 0 01-1.307-3.498A4.49 4.49 0 012.25 12c0-1.357.6-2.573 1.549-3.397a4.49 4.49 0 011.307-3.497 4.49 4.49 0 013.497-1.307zm7.007 6.387a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                                                                                                    </svg>
                                                                                                    Verified
                                                                                                </span>` : ''}
                    </div>
                    <p class="text-xs text-slate2 mt-1">
                        <span class="font-medium">Contact Person:</span> ${contactPerson}
                    </p>
                    <p class="text-xs text-slate2">
                        <span class="font-medium">Posted:</span> ${formattedDate}
                    </p>
                </div>
                <span class="status-badge ${statusClass} shrink-0">${statusLabel}</span>
            </div>
            
            <!-- Key Details -->
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 p-3 bg-surface rounded-lg">
                <div>
                    <p class="text-[10px] text-slate2 uppercase tracking-wider">Type</p>
                    <p class="text-sm font-semibold text-ink">${project.project_type ? project.project_type.charAt(0).toUpperCase() + project.project_type.slice(1) : 'N/A'}</p>
                </div>
                <div>
                    <p class="text-[10px] text-slate2 uppercase tracking-wider">Budget</p>
                    <p class="text-sm font-semibold text-brand">${project.budget || 'Not specified'}</p>
                </div>
                ${project.duration ? `<div>
                                                                                            <p class="text-[10px] text-slate2 uppercase tracking-wider">Duration</p>
                                                                                            <p class="text-sm font-semibold text-ink">${project.duration}</p>
                                                                                        </div>` : ''}
                ${formattedDeadline ? `<div>
                                                                                            <p class="text-[10px] text-slate2 uppercase tracking-wider">Deadline</p>
                                                                                            <p class="text-sm font-semibold text-ink">${formattedDeadline}</p>
                                                                                        </div>` : ''}
                <div>
                    <p class="text-[10px] text-slate2 uppercase tracking-wider">Bids</p>
                    <p class="text-sm font-semibold text-ink">${applicationsCount} ${maxBids ? '/ ' + maxBids : ''}</p>
                </div>
            </div>
            
            <!-- Tags -->
            <div class="flex flex-wrap gap-2">
                ${project.work_mode ? `<span class="text-xs font-medium px-3 py-1 rounded-full bg-brand/10 text-brand capitalize">${project.work_mode}</span>` : ''}
                ${project.visibility ? `<span class="text-xs font-medium px-3 py-1 rounded-full bg-gray-100 text-gray-600 capitalize">${project.visibility}</span>` : ''}
            </div>
            
            <!-- Location -->
            ${locationStr ? `<div>
                                                                                        <h4 class="font-display font-semibold text-sm text-ink mb-1">Location</h4>
                                                                                        <p class="text-sm text-slate2">${locationStr}</p>
                                                                                    </div>` : ''}
            
            <!-- Description -->
            ${project.description ? `<div>
                                                                                        <h4 class="font-display font-semibold text-sm text-ink mb-1">Description</h4>
                                                                                        <p class="text-sm text-slate2 leading-relaxed">${project.description}</p>
                                                                                    </div>` : ''}
            
            <!-- Skills -->
            ${skills ? `<div>
                                                                                        <h4 class="font-display font-semibold text-sm text-ink mb-1">Required Skills</h4>
                                                                                        <div class="flex flex-wrap gap-1.5">${skills}</div>
                                                                                    </div>` : ''}
            
            <!-- Rejection Reason -->
            ${project.rejection_reason ? `<div class="bg-red-50 rounded-lg p-4 border border-red-200">
                                                                                        <h4 class="font-display font-semibold text-sm text-red-700 mb-1">Rejection Reason</h4>
                                                                                        <p class="text-sm text-red-600">${project.rejection_reason}</p>
                                                                                    </div>` : ''}
            
            <!-- Action Button with Bid - FIXED with dynamic URL -->
           <div class="flex items-center justify-between pt-4 border-t border-line">
    <span class="text-xs text-slate2">Posted ${formattedDate}</span>

    ${
        project.already_bid
            ? `<span class="inline-flex items-center px-4 py-2 rounded-lg bg-green-100 text-green-700 text-xs font-semibold">
                                                                            Proposal Submitted
                                                                       </span>`
            : `<a href="${bidUrl}"
                                                                            onclick="event.stopPropagation()"
                                                                            class="btn-primary bg-brand hover:bg-brand/90 text-white text-xs font-semibold px-4 py-2 rounded-lg transition-colors flex items-center gap-1.5">
                                                                            Place Bid
                                                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 5l7 7-7 7" />
                                                                            </svg>
                                                                       </a>`
    }
</div>
        </div>
    `;

                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            };
            // Expose closeModal globally
            window.closeModal = closeModal;

            document.addEventListener('click', function(e) {
                if (e.target.closest('#job-modal-close') || e.target.id === 'job-modal-backdrop') {
                    closeModal();
                }
            });

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') closeModal();
            });

            // Auto-submit filters when radio buttons change
            document.querySelectorAll('input[type="radio"][name]').forEach(function(input) {
                input.addEventListener('change', function() {
                    document.getElementById('filter-form').submit();
                });
            });

            // Auto-submit budget inputs with debounce
            // Submit budget inputs only when the user finishes (blur) or presses Enter
            (function() {
                var minBudget = document.getElementById('min-budget');
                var maxBudget = document.getElementById('max-budget');
                var filterForm = document.getElementById('filter-form');
                var submitted = false;

                function safeSubmit() {
                    if (submitted) return;
                    submitted = true;
                    filterForm.submit();
                }

                [minBudget, maxBudget].forEach(function(input) {
                    if (!input) return;

                    // Submit once the user leaves the field, but only if the value actually changed
                    input.addEventListener('blur', function() {
                        if (input.dataset.lastValue !== input.value) {
                            safeSubmit();
                        }
                    });

                    // Track the value on focus so blur can compare against it
                    input.addEventListener('focus', function() {
                        input.dataset.lastValue = input.value;
                        submitted = false;
                    });

                    // Allow explicit submit on Enter
                    input.addEventListener('keydown', function(e) {
                        if (e.key === 'Enter') {
                            e.preventDefault();
                            safeSubmit();
                        }
                    });
                });
            })();
        })();
    </script>
@endsection

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

{{-- Holds the CSRF token for AJAX calls --}}
<div id="csrf-holder" data-token="{{ csrf_token() }}" class="hidden"></div>

{{-- ================= HERO / SEARCH ================= --}}
<section class="relative overflow-hidden bg-gradient-to-br from-[#EAF0FF] via-[#F3F6FF] to-[#FBF4EF]">
    <div class="max-w-7xl mx-auto px-6 pt-16 pb-28 relative z-10">
        <div class="grid lg:grid-cols-[1.15fr_0.85fr] gap-10 items-center">

            {{-- LEFT: COPY + SEARCH --}}
            <div class="flex flex-col items-center text-center">
                <div class="max-w-2xl">
                    <span
                        class="inline-flex items-center gap-1.5 text-[11px] font-semibold tracking-wide uppercase text-brand bg-brand/10 px-3 py-1.5 rounded-full">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        0+ open roles this week
                    </span>

                    <h1
                        class="font-display text-4xl md:text-5xl font-extrabold leading-[1.08] tracking-tight text-ink mt-5">
                        Find the Right Job,<br>
                        <span class="text-brand">Build Your Future</span>
                    </h1>
                    <p class="mt-4 text-slate2 max-w-md mx-auto text-sm md:text-base leading-relaxed">
                        Explore thousands of opportunities from vetted employers and take the next step in your career
                        journey.
                    </p>
                </div>

                <form action="#" method="GET"
                    class="mt-8 bg-white rounded-xl shadow-card ring-1 ring-black/[0.03] p-1 flex flex-col md:flex-row gap-1 max-w-2xl w-full">
                    <label
                        class="flex items-center gap-2 px-3 py-2 flex-1 border-b md:border-b-0 md:border-r border-line">
                        <svg class="w-3.5 h-3.5 text-slate2 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" name="q" placeholder="Job title, keywords or company"
                            class="w-full text-xs text-ink outline-none placeholder:text-slate2/70">
                    </label>
                    <label
                        class="flex items-center gap-2 px-3 py-2 flex-1 border-b md:border-b-0 md:border-r border-line">
                        <svg class="w-3.5 h-3.5 text-slate2 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <input type="text" name="location" placeholder="Location"
                            class="w-full text-xs text-ink outline-none placeholder:text-slate2/70">
                    </label>
                    <label class="flex items-center gap-2 px-3 py-2">
                        <svg class="w-3.5 h-3.5 text-slate2 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                        <select name="category"
                            class="text-xs text-ink outline-none bg-transparent pr-2 min-w-[8rem] max-w-[10rem] truncate">
                            <option value="">All Categories</option>
                            <option value="tech">Technology</option>
                            <option value="design">Design</option>
                            <option value="marketing">Marketing</option>
                            <option value="finance">Finance</option>
                        </select>
                    </label>
                    <button type="submit"
                        class="btn-primary bg-brand hover:bg-brand/90 focus-visible:ring-2 focus-visible:ring-brand focus-visible:ring-offset-2 text-white text-xs font-semibold px-5 py-2 rounded-lg whitespace-nowrap self-center">
                        Search Jobs
                    </button>
                </form>

                <div class="mt-4 flex flex-wrap items-center justify-center gap-2 text-xs">
                    <span class="font-semibold text-ink/70 mr-1">Popular:</span>
                    @foreach (['Web Developer','UI/UX Designer','Flutter Developer','Data Analyst'] as $tag)
                    <a href="#"
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
                    <span class="text-[11px] font-semibold text-ink pr-1">Applications</span>
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
<section class="max-w-7xl mx-auto px-6 -mt-12 relative z-10 pb-24">
    <div class="grid grid-cols-1 lg:grid-cols-[248px_1fr_300px] gap-6">

        {{-- FILTERS SIDEBAR --}}
        <aside class="bg-white rounded-2xl shadow-card ring-1 ring-black/[0.03] p-5 h-fit lg:sticky lg:top-6">
            <div class="flex items-center justify-between mb-5 pb-4 border-b border-line">
                <h3 class="font-display font-bold text-sm text-ink flex items-center gap-2">
                    <svg class="w-4 h-4 text-brand" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 4h18M6 9h12M10 14h4M11 19h2" />
                    </svg>
                    Filters
                </h3>
                <a href="#" class="text-xs text-brand font-semibold hover:underline">Clear all</a>
            </div>

            <div class="mb-6 pb-6 border-b border-line">
                <h4 class="text-[11px] font-bold text-slate2 uppercase tracking-wider mb-3">Job Type</h4>
                <div class="space-y-2.5 text-sm">
                    @foreach (['' => 'All Job Types', 'full-time' => 'Full Time', 'part-time' => 'Part Time',
                    'contract' => 'Contract', 'freelance' => 'Freelance'] as $value => $label)
                    <label class="group flex items-center gap-2.5 cursor-pointer">
                        <span
                            class="relative flex items-center justify-center w-4 h-4 shrink-0 rounded-full border-2 border-line group-hover:border-brand/60 peer-checked:border-brand transition-colors">
                            <input type="radio" name="employment_type" value="{{ $value }}"
                                class="peer appearance-none absolute inset-0 w-full h-full cursor-pointer">
                            <span
                                class="w-2 h-2 rounded-full bg-brand scale-0 peer-checked:scale-100 transition-transform"></span>
                        </span>
                        <span class="text-ink/80 group-hover:text-ink transition-colors">{{ $label }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            <div class="mb-6">
                <h4 class="text-[11px] font-bold text-slate2 uppercase tracking-wider mb-3">Work Mode</h4>
                <div class="space-y-2.5 text-sm">
                    @foreach (['' => 'All Modes', 'onsite' => 'Onsite', 'hybrid' => 'Hybrid', 'remote' => 'Remote']
                    as $value => $label)
                    <label class="group flex items-center gap-2.5 cursor-pointer">
                        <span
                            class="relative flex items-center justify-center w-4 h-4 shrink-0 rounded-full border-2 border-line group-hover:border-brand/60 peer-checked:border-brand transition-colors">
                            <input type="radio" name="work_mode" value="{{ $value }}"
                                class="peer appearance-none absolute inset-0 w-full h-full cursor-pointer">
                            <span
                                class="w-2 h-2 rounded-full bg-brand scale-0 peer-checked:scale-100 transition-transform"></span>
                        </span>
                        <span class="text-ink/80 group-hover:text-ink transition-colors">{{ $label }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            {{-- SAVED / APPLIED / INTERVIEWS / IN PROGRESS / HIRED / ARCHIVED NAV --}}
            <div class="pt-5 border-t border-line space-y-2">
                <a href="#" class="flex items-center justify-between gap-2 rounded-xl px-3 py-2.5 text-sm font-semibold text-ink hover:bg-surface transition-colors">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-slate2" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-4-7 4V5z" />
                        </svg>
                        Saved Jobs
                    </span>
                </a>

                <a href="#" class="flex items-center justify-between gap-2 rounded-xl px-3 py-2.5 text-sm font-semibold text-ink hover:bg-surface transition-colors">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-slate2" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        Applied Jobs
                    </span>
                </a>

                <a href="#" class="flex items-center justify-between gap-2 rounded-xl px-3 py-2.5 text-sm font-semibold text-ink hover:bg-surface transition-colors">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m-6 4h6m-6 4h6" />
                        </svg>
                        My Proposals
                    </span>
                </a>

                <a href="#" class="flex items-center justify-between gap-2 rounded-xl px-3 py-2.5 text-sm font-semibold text-ink hover:bg-surface transition-colors">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-slate2" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Interviews
                    </span>
                </a>

                <a href="#" class="flex items-center justify-between gap-2 rounded-xl px-3 py-2.5 text-sm font-semibold text-ink hover:bg-surface transition-colors">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v6l4 2m5-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        In Progress
                    </span>
                </a>

                <a href="#" class="flex items-center justify-between gap-2 rounded-xl px-3 py-2.5 text-sm font-semibold text-ink hover:bg-surface transition-colors">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 6V5a3 3 0 013-3h0a3 3 0 013 3v1m-9 3h12a2 2 0 012 2v7a2 2 0 01-2 2H6a2 2 0 01-2-2v-7a2 2 0 012-2zm6 4l2 2 4-4" />
                        </svg>
                        Hired
                    </span>
                </a>

                <a href="#" class="flex items-center justify-between gap-2 rounded-xl px-3 py-2.5 text-sm font-semibold text-ink hover:bg-surface transition-colors">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M20.54 5.23l-1.39-2.09A1 1 0 0018.32 2H5.68a1 1 0 00-.83.45L3.46 5.23A2 2 0 003 6.34V8a2 2 0 002 2h14a2 2 0 002-2V6.34a2 2 0 00-.46-1.11zM5 10v8a2 2 0 002 2h10a2 2 0 002-2v-8M9 14h6" />
                        </svg>
                        Archived
                    </span>
                </a>
            </div>
        </aside>

        {{-- JOB LIST --}}
        <div id="jobs-list" class="scroll-mt-24">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-5">
                <div class="flex items-baseline gap-2">
                    <h2 class="font-display font-bold text-xl text-ink">JOBS FOR YOU</h2>
                    <span class="text-xs text-slate2">0 jobs found</span>
                </div>

                <label class="text-xs text-slate2 flex items-center gap-2 bg-white border border-line rounded-lg px-3 py-2">
                    Sort by
                    <select name="sort" class="text-ink font-semibold outline-none bg-transparent">
                        <option value="relevant">Most Relevant</option>
                        <option value="newest">Newest</option>
                    </select>
                </label>
            </div>

            <div class="space-y-3">
                {{-- Empty State --}}
                <div class="bg-white rounded-2xl shadow-card p-14 text-center">
                    <div class="w-12 h-12 rounded-full bg-surface flex items-center justify-center mx-auto mb-4">
                        <svg class="w-5 h-5 text-slate2" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <p class="font-display font-bold text-sm text-ink">No jobs match your filters</p>
                    <p class="text-xs text-slate2 mt-1">Try adjusting your filters or create a profile to get personalized recommendations.</p>
                    <a href="#" class="inline-block mt-4 text-brand text-xs font-semibold hover:underline">Clear Filters</a>
                </div>
            </div>

            <div class="mt-8">
                <nav class="flex items-center justify-between">
                    <p class="text-xs text-slate2">Showing 0 results</p>
                </nav>
            </div>
        </div>

        {{-- RIGHT SIDEBAR --}}
        <aside class="space-y-5 h-fit lg:sticky lg:top-6">
            <div
                class="sidebar-card bg-gradient-to-br from-brand to-brand2 rounded-2xl p-5 text-white relative overflow-hidden">
                <svg class="w-8 h-8 mb-3 relative z-10" fill="none" stroke="currentColor" stroke-width="1.6"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
                <h4 class="font-display font-bold text-sm relative z-10">Boost Your Profile</h4>
                <p class="text-xs text-white/85 mt-1.5 relative z-10 leading-relaxed">Add your skills and get
                    personalized job recommendations.</p>
                <a href="#"
                    class="inline-block mt-4 bg-white text-brand text-xs font-semibold px-4 py-2.5 rounded-lg relative z-10 hover:bg-white/90 transition-colors">
                    Create Profile
                </a>
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

                <a href="#"
                    class="btn-primary inline-flex items-center gap-1.5 mt-4 bg-brand text-white text-xs font-semibold px-4 py-2.5 rounded-lg hover:bg-brand/90 relative z-10">
                    Explore Remote Jobs
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
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
    <div class="relative min-h-full flex items-start justify-center p-4 sm:p-6 pt-24 sm:pt-28">
        <div class="bg-white rounded-2xl shadow-lg ring-1 ring-black/[0.03] w-full max-w-2xl max-h-[75vh] flex flex-col overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 shrink-0">
                <h2 class="font-display font-bold text-lg text-ink">Job Details</h2>
                <button type="button" id="job-modal-close" aria-label="Close"
                    class="w-9 h-9 flex items-center justify-center rounded-lg border border-gray-200 text-gray-500 hover:text-gray-700 hover:bg-gray-50 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div id="job-modal-content" class="overflow-y-auto p-6"></div>
        </div>
    </div>
</div>

<script>
    (function() {
        var modal = document.getElementById('job-modal');
        var content = document.getElementById('job-modal-content');

        function closeModal() {
            modal.classList.add('hidden');
            content.innerHTML = '';
            document.body.style.overflow = '';
        }

        document.addEventListener('click', function(e) {
            if (e.target.closest('#job-modal-close') || e.target.id === 'job-modal-backdrop') {
                closeModal();
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeModal();
        });
    })();
</script>

@endsection
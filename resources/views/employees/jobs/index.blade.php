@extends('layouts.app')

@section('content')

@include('employees.jobs._styles')
@include('employees.jobs._scripts')

{{-- Holds the CSRF token for the AJAX apply/save calls below --}}
<div id="csrf-holder" data-token="{{ csrf_token() }}" class="hidden"></div>

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

{{-- ================= HERO / SEARCH ================= --}}
<section class="relative overflow-hidden bg-gradient-to-br from-[#EAF0FF] via-[#F3F6FF] to-[#FBF4EF]">
    <div class="max-w-7xl mx-auto px-6 pt-16 pb-28 relative z-10">
        <div class="grid lg:grid-cols-[1.15fr_0.85fr] gap-10 items-center">

            {{-- ---------- LEFT: COPY + SEARCH ---------- --}}
            <div class="flex flex-col items-center text-center">
                <div class="max-w-2xl">
                    <span
                        class="inline-flex items-center gap-1.5 text-[11px] font-semibold tracking-wide uppercase text-brand bg-brand/10 px-3 py-1.5 rounded-full">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        {{ number_format($jobsCount) }}+ open roles this week
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

                <form action="{{ route('employee.jobs.index') }}#jobs-list" method="GET"
                    class="mt-8 bg-white rounded-xl shadow-card ring-1 ring-black/[0.03] p-1 flex flex-col md:flex-row gap-1 max-w-2xl w-full">
                    <label
                        class="flex items-center gap-2 px-3 py-2 flex-1 border-b md:border-b-0 md:border-r border-line">
                        <svg class="w-3.5 h-3.5 text-slate2 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" name="q" value="{{ $filters['q'] ?? '' }}"
                            placeholder="Job title, keywords or company"
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
                        <input type="text" name="location" value="{{ $filters['location'] ?? '' }}"
                            placeholder="Location"
                            class="w-full text-xs text-ink outline-none placeholder:text-slate2/70">
                    </label>
                    <label class="flex items-center gap-2 px-3 py-2">
                        <svg class="w-3.5 h-3.5 text-slate2 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                        <select name="category" onchange="this.form.submit()"
                            class="text-xs text-ink outline-none bg-transparent pr-2 min-w-[8rem] max-w-[10rem] truncate">
                            <option value="">All Categories</option>
                            @foreach (config('job_categories') as $value => $category)
                            <option value="{{ $value }}" @selected(($filters['category'] ?? '' )===$value)>
                                {{ $category['label'] }}</option>
                            @endforeach
                        </select>
                    </label>
                    <input type="hidden" name="employment_type" value="{{ $filters['employment_type'] ?? '' }}">
                    <input type="hidden" name="work_mode" value="{{ $filters['work_mode'] ?? '' }}">
                    <input type="hidden" name="sort" value="{{ $filters['sort'] ?? '' }}">
                    <button type="submit"
                        class="btn-primary bg-brand hover:bg-brand/90 focus-visible:ring-2 focus-visible:ring-brand focus-visible:ring-offset-2 text-white text-xs font-semibold px-5 py-2 rounded-lg whitespace-nowrap self-center">
                        Search Jobs
                    </button>
                </form>

                <div class="mt-4 flex flex-wrap items-center justify-center gap-2 text-xs">
                    <span class="font-semibold text-ink/70 mr-1">Popular:</span>
                    @foreach (['Web Developer','UI/UX Designer','Flutter Developer','Data Analyst',] as $tag)
                    <a href="{{ route('employee.jobs.index', ['q' => $tag]) }}"
                        class="px-3 py-1.5 rounded-full bg-white/80 hover:bg-white hover:text-brand hover:shadow-sm transition-all border border-line text-slate2 font-medium">{{ $tag }}</a>
                    @endforeach
                </div>
            </div>

            {{-- ---------- RIGHT: HERO IMAGE ---------- --}}
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

        {{-- ---------- FILTERS SIDEBAR ---------- --}}
        <aside class="bg-white rounded-2xl shadow-card ring-1 ring-black/[0.03] p-5 h-fit lg:sticky lg:top-6">
            <form id="sidebar-filter-form" action="{{ route('employee.jobs.index') }}#jobs-list" method="GET">
                <input type="hidden" name="q" value="{{ $filters['q'] ?? '' }}">
                <input type="hidden" name="category" value="{{ $filters['category'] ?? '' }}">
                <input type="hidden" name="sort" value="{{ $filters['sort'] ?? '' }}">

                <div class="flex items-center justify-between mb-5 pb-4 border-b border-line">
                    <h3 class="font-display font-bold text-sm text-ink flex items-center gap-2">
                        <svg class="w-4 h-4 text-brand" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 4h18M6 9h12M10 14h4M11 19h2" />
                        </svg>
                        Filters
                    </h3>
                    <a href="{{ route('employee.jobs.index') }}"
                        class="text-xs text-brand font-semibold hover:underline">Clear all</a>
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
                                    @checked(($filters['employment_type'] ?? '' )===$value)
                                    onchange="this.form.submit()"
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
                                    @checked(($filters['work_mode'] ?? '' )===$value) onchange="this.form.submit()"
                                    class="peer appearance-none absolute inset-0 w-full h-full cursor-pointer">
                                <span
                                    class="w-2 h-2 rounded-full bg-brand scale-0 peer-checked:scale-100 transition-transform"></span>
                            </span>
                            <span class="text-ink/80 group-hover:text-ink transition-colors">{{ $label }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

            </form>

            {{-- ---------- SAVED / APPLIED / INTERVIEWS / IN PROGRESS / HIRED / ARCHIVED NAV ---------- --}}
            {{-- These are plain links to their own dedicated pages. They do NOT touch the hero
                 section on this page - navigating here is normal browser navigation. --}}
            <div class="pt-5 border-t border-line space-y-2">
                <a href="{{ route('employee.jobs.saved') }}"
                    class="flex items-center justify-between gap-2 rounded-xl px-3 py-2.5 text-sm font-semibold text-ink hover:bg-surface transition-colors">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-slate2" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-4-7 4V5z" />
                        </svg>
                        Saved Jobs
                    </span>
                    @if (($savedJobsCount ?? 0) > 0)
                    <span
                        class="text-[11px] font-bold bg-brand/10 text-brand rounded-full px-2 py-0.5">{{ $savedJobsCount }}</span>
                    @endif
                </a>

                <a href="{{ route('employee.jobs.applied') }}"
                    class="flex items-center justify-between gap-2 rounded-xl px-3 py-2.5 text-sm font-semibold text-ink hover:bg-surface transition-colors">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-slate2" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        Applied Jobs
                    </span>
                    @if (($appliedJobsCount ?? 0) > 0)
                    <span
                        class="text-[11px] font-bold bg-mint/10 text-mint rounded-full px-2 py-0.5">{{ $appliedJobsCount }}</span>
                    @endif
                </a>

                <a href="{{ route('employee.projects.proposals') }}"
                    class="flex items-center justify-between gap-2 rounded-xl px-3 py-2.5 text-sm font-semibold text-ink hover:bg-surface transition-colors">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m-6 4h6m-6 4h6" />
                        </svg>
                        My Proposals
                    </span>
                    @if (($proposalsCount ?? 0) > 0)
                    <span
                        class="text-[11px] font-bold bg-amber-100 text-amber-600 rounded-full px-2 py-0.5">{{ $proposalsCount }}</span>
                    @endif
                </a>

                <a href="{{ route('employee.jobs.interviews') }}"
                    class="flex items-center justify-between gap-2 rounded-xl px-3 py-2.5 text-sm font-semibold text-ink hover:bg-surface transition-colors">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-slate2" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Interviews
                    </span>
                    @if (($interviewsCount ?? 0) > 0)
                    <span
                        class="text-[11px] font-bold bg-brand/10 text-brand rounded-full px-2 py-0.5">{{ $interviewsCount }}</span>
                    @endif
                </a>

                <a href="{{ route('employee.jobs.inProgress') }}"
                    class="flex items-center justify-between gap-2 rounded-xl px-3 py-2.5 text-sm font-semibold text-ink hover:bg-surface transition-colors">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v6l4 2m5-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        In Progress
                    </span>
                    @if (($inprogress ?? 0) > 0)
                    <span class="text-[11px] font-bold bg-amber-100 text-amber-600 rounded-full px-2 py-0.5">
                        {{ $inprogress }}
                    </span>
                    @endif
                </a>

                <a href="{{ route('employee.jobs.hired') }}"
                    class="flex items-center justify-between gap-2 rounded-xl px-3 py-2.5 text-sm font-semibold text-ink hover:bg-surface transition-colors">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 6V5a3 3 0 013-3h0a3 3 0 013 3v1m-9 3h12a2 2 0 012 2v7a2 2 0 01-2 2H6a2 2 0 01-2-2v-7a2 2 0 012-2zm6 4l2 2 4-4" />
                        </svg>
                        Hired
                    </span>
                    @if (($hiredJobsCount ?? 0) > 0)
                    <span class="text-[11px] font-bold bg-mint/10 text-mint rounded-full px-2 py-0.5">
                        {{ $hiredJobsCount }}
                    </span>
                    @endif
                </a>

                <a href="{{ route('employee.jobs.archived') }}"
                    class="flex items-center justify-between gap-2 rounded-xl px-3 py-2.5 text-sm font-semibold text-ink hover:bg-surface transition-colors">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M20.54 5.23l-1.39-2.09A1 1 0 0018.32 2H5.68a1 1 0 00-.83.45L3.46 5.23A2 2 0 003 6.34V8a2 2 0 002 2h14a2 2 0 002-2V6.34a2 2 0 00-.46-1.11zM5 10v8a2 2 0 002 2h10a2 2 0 002-2v-8M9 14h6" />
                        </svg>
                        Archived
                    </span>
                    @if (($archivedCount ?? 0) > 0)
                    <span class="text-[11px] font-bold bg-slate-100 text-slate-600 rounded-full px-2 py-0.5">
                        {{ $archivedCount }}
                    </span>
                    @endif
                </a>
            </div>
        </aside>

        {{-- ---------- JOB LIST ---------- --}}
        <div id="jobs-list" class="scroll-mt-24">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-5">
                <div class="flex items-baseline gap-2">
                    <h2 class="font-display font-bold text-xl text-ink">JOBS FOR YOU</h2>
                    <span class="text-xs text-slate2">{{ number_format($jobsCount) }}
                        {{ Str::plural('job', $jobsCount) }} found</span>
                </div>

                <label
                    class="text-xs text-slate2 flex items-center gap-2 bg-white border border-line rounded-lg px-3 py-2">
                    Sort by
                    <select name="sort" onchange="window.location = this.value + '#jobs-list'"
                        class="text-ink font-semibold outline-none bg-transparent">
                        <option value="{{ request()->fullUrlWithQuery(['sort' => 'relevant']) }}"
                            @selected(($filters['sort'] ?? 'relevant' )==='relevant' )>Most Relevant</option>
                        <option value="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}"
                            @selected(($filters['sort'] ?? '' )==='newest' )>Newest</option>
                    </select>
                </label>
            </div>

            <div class="space-y-3">
              @forelse ($jobs as $job)
                @php
                $isProject = ($job->listing_type ?? 'job') === 'project';

                $companyName = $job->employer->company_name
                ?? $job->employer->name
                ?? 'Company';

                $companyLogo = $job->employer->employerRegistration->company_logo ?? null;

                $location = collect([$job->city, $job->state, $job->country])
                ->filter()
                ->implode(', ') ?: 'Location not specified';

                if ($isProject) {
                    $employmentType    = $job->project_type === 'hourly' ? 'Hourly Contract' : 'Fixed-Price Contract';
                    $payDisplay        = $job->budget ?: 'Budget not disclosed';
                    $experienceDisplay = $job->experience_level ? ucfirst($job->experience_level) : null;
                    $extraMeta         = $job->duration ?: null; // e.g. "2-4 weeks"
                } else {
                    $employmentType    = $job->employment_type
                        ? ucfirst(str_replace('-', ' ', $job->employment_type))
                        : null;
                    $payDisplay        = $job->salary ?: 'Not disclosed';
                    $experienceDisplay = $job->experience;
                    $extraMeta         = null;
                }

                $skills = is_array($job->skills) ? $job->skills : [];

                $palette = ['bg-blue-50 text-blue-600', 'bg-orange-50 text-orange-600', 'bg-violet-50 text-violet-600',
                'bg-emerald-50 text-emerald-600', 'bg-rose-50 text-rose-600'];
                $avatarClass = $palette[crc32($companyName) % count($palette)];

                // Save/Apply only apply to real JobPost rows for now -
                // Projects don't share the SavedJob / JobApplication tables.
                $isSaved    = !$isProject && in_array($job->id, $savedJobIds ?? []);
                $hasApplied = !$isProject && in_array($job->id, $appliedJobIds ?? []);

                // Whether the logged-in employee has already sent a proposal for this project.
                $hasProposed = $isProject && in_array($job->id, $appliedProjectIds ?? []);
                @endphp

                <article data-job-open="{{ $job->listing_type }}-{{ $job->id }}"
                    class="job-card group relative bg-white rounded-2xl shadow-card hover:shadow-cardHover transition-all duration-200 p-4 sm:p-5 flex gap-4 items-start overflow-hidden ring-1 {{ $isProject ? 'ring-amber-300 bg-amber-50/30' : 'ring-transparent' }} hover:ring-brand/10 cursor-pointer">
                    <span
                        class="absolute left-0 top-0 h-full w-1 {{ $isProject ? 'bg-amber-400' : 'bg-brand' }} scale-y-0 group-hover:scale-y-100 origin-top transition-transform duration-200"></span>

                    @if ($companyLogo)
                    <img src="{{ asset('storage/' . $companyLogo) }}" alt="{{ $companyName }}"
                        class="w-11 h-11 rounded-xl object-cover shrink-0 border border-line">
                    @else
                    <div class="w-11 h-11 rounded-xl {{ $avatarClass }} flex items-center justify-center shrink-0">
                        <span class="font-display font-bold text-lg">{{ strtoupper(substr($companyName, 0, 1)) }}</span>
                    </div>
                    @endif

                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between gap-3">
                            <div class="min-w-0">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <span
                                        class="font-display font-bold text-sm sm:text-base text-ink group-hover:text-brand transition-colors">
                                        {{ $job->title }}
                                    </span>
                                    @if ($isProject)
                                    <span
                                        title="This is a contract project posted specifically for employees, not a regular job listing."
                                        class="inline-flex items-center gap-1 text-[10px] font-bold uppercase tracking-wide px-2 py-0.5 rounded-full bg-amber-100 text-amber-700 border border-amber-200">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m-6 4h6m-6 4h6" />
                                        </svg>
                                        Contract Project
                                    </span>
                                    @endif
                                </div>
                                <p class="text-xs text-slate2 mt-1 flex flex-wrap items-center gap-x-1.5">
                                    <span class="font-medium text-ink/70">{{ $companyName }}</span>
                                    <span>&middot;</span>
                                    <span>{{ $location }}</span>
                                    @if ($employmentType) <span>&middot;</span><span>{{ $employmentType }}</span> @endif
                                    @if ($experienceDisplay) <span>&middot;</span><span>{{ $experienceDisplay }}</span>
                                    @endif
                                    @if ($extraMeta) <span>&middot;</span><span>{{ $extraMeta }}</span> @endif
                                </p>
                            </div>
                            <div class="text-right shrink-0">
                                <p class="font-display font-bold text-mint text-sm">
                                    {{ $payDisplay }}</p>
                                <p class="text-[11px] text-slate2 mt-1">{{ $job->created_at?->diffForHumans() }}</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-3.5">
                            <div id="job-tags-{{ $job->listing_type }}-{{ $job->id }}" class="flex flex-wrap gap-1.5 items-center">
                                @if ($job->work_mode)
                                <span
                                    class="text-[11px] font-medium px-2.5 py-1 rounded-full bg-brand/5 text-brand border border-brand/10 capitalize">{{ $job->work_mode }}</span>
                                @endif
                                @foreach (array_slice($skills, 0, 4) as $tag)
                                <span
                                    class="text-[11px] font-medium px-2.5 py-1 rounded-full bg-surface text-slate2 border border-line">{{ $tag }}</span>
                                @endforeach

                                @if ($hasApplied)
                                <span
                                    class="applied-chip-{{ $job->id }} text-[11px] font-semibold px-2.5 py-1 rounded-full bg-mint/10 text-mint border border-mint/20 inline-flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Applied
                                </span>
                                @endif
                            </div>

                            @if (!$isProject)
                            <button type="button"
                                class="job-save-btn shrink-0 ml-2 w-8 h-8 flex items-center justify-center rounded-lg transition-colors
                                       {{ $isSaved ? 'text-brand bg-brand/10' : 'text-slate2 hover:text-brand hover:bg-brand/5' }}
                                       focus-visible:ring-2 focus-visible:ring-brand"
                                data-context="card"
                                data-job-id="{{ $job->id }}"
                                data-save-url="{{ route('employee.jobs.save', $job->id) }}"
                                data-saved="{{ $isSaved ? '1' : '0' }}"
                                aria-label="{{ $isSaved ? 'Unsave job' : 'Save job' }}">
                                <svg class="w-4 h-4" fill="{{ $isSaved ? 'currentColor' : 'none' }}"
                                    stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-4-7 4V5z" />
                                </svg>
                            </button>
                            @endif
                        </div>
                    </div>
                </article>

                {{-- Hidden template with FULL details for this listing.
                             JS copies this into the modal when the card is clicked. --}}
                <template id="job-template-{{ $job->listing_type }}-{{ $job->id }}">
                    <div class="flex items-center gap-4">
                        @if ($companyLogo)
                        <img src="{{ asset('storage/' . $companyLogo) }}" alt="{{ $companyName }}"
                            class="w-14 h-14 rounded-xl object-cover shrink-0 border border-line">
                        @else
                        <div class="w-14 h-14 rounded-xl {{ $avatarClass }} flex items-center justify-center shrink-0">
                            <span class="font-display font-bold text-lg">{{ strtoupper(substr($companyName, 0, 1)) }}</span>
                        </div>
                        @endif
                        <div class="min-w-0">
                            <div class="flex items-center gap-2 flex-wrap">
                                <h3 class="font-display font-bold text-lg text-ink">{{ $job->title }}</h3>
                                @if ($isProject)
                                <span class="inline-flex items-center text-[10px] font-bold uppercase tracking-wide px-2 py-0.5 rounded-full bg-amber-100 text-amber-700 border border-amber-200">
                                    Contract Project &middot; For You
                                </span>
                                @endif
                            </div>
                            <p class="text-sm text-slate2">{{ $companyName }} &middot; {{ $location }}</p>
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-2 gap-3">
                        <div class="bg-surface rounded-xl px-4 py-3">
                            <p class="text-[11px] font-bold text-slate2 uppercase tracking-wide">{{ $isProject ? 'Budget' : 'Salary' }}</p>
                            <p class="text-ink font-semibold mt-1">{{ $payDisplay }}</p>
                        </div>

                        @if ($employmentType)
                        <div class="bg-surface rounded-xl px-4 py-3">
                            <p class="text-[11px] font-bold text-slate2 uppercase tracking-wide">{{ $isProject ? 'Contract Type' : 'Employment Type' }}</p>
                            <p class="text-ink font-semibold mt-1">{{ $employmentType }}</p>
                        </div>
                        @endif

                        @if ($job->work_mode)
                        <div class="bg-surface rounded-xl px-4 py-3">
                            <p class="text-[11px] font-bold text-slate2 uppercase tracking-wide">Work Mode</p>
                            <p class="text-ink font-semibold mt-1 capitalize">{{ $job->work_mode }}</p>
                        </div>
                        @endif

                        @if ($experienceDisplay)
                        <div class="bg-surface rounded-xl px-4 py-3">
                            <p class="text-[11px] font-bold text-slate2 uppercase tracking-wide">Experience</p>
                            <p class="text-ink font-semibold mt-1">{{ $experienceDisplay }}</p>
                        </div>
                        @endif

                        @if ($isProject && $extraMeta)
                        <div class="bg-surface rounded-xl px-4 py-3">
                            <p class="text-[11px] font-bold text-slate2 uppercase tracking-wide">Duration</p>
                            <p class="text-ink font-semibold mt-1">{{ $extraMeta }}</p>
                        </div>
                        @endif

                        @if (!$isProject && $job->qualification)
                        <div class="bg-surface rounded-xl px-4 py-3 col-span-2">
                            <p class="text-[11px] font-bold text-slate2 uppercase tracking-wide">Qualification</p>
                            <p class="text-ink font-semibold mt-1">{{ $job->qualification }}</p>
                        </div>
                        @endif
                    </div>

                    @if (count($skills))
                    <div class="mt-5 bg-surface rounded-xl px-4 py-3">
                        <p class="text-[11px] font-bold text-slate2 uppercase tracking-wide mb-2">Skills</p>
                        <div class="flex flex-wrap gap-1.5">
                            @foreach ($skills as $tag)
                            <span class="text-[11px] font-medium px-2.5 py-1 rounded-full bg-white text-slate2 border border-line">{{ $tag }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <div class="mt-5">
                        <h3 class="font-display font-bold text-sm text-ink mb-2">Description</h3>
                        <p class="text-sm text-ink/80 leading-relaxed whitespace-pre-line">{{ $job->description }}</p>
                    </div>

                    <div class="flex items-center gap-3 mt-6 pt-6 border-t border-line">
                        @if ($isProject)
                            @if ($hasProposed)
                            <div class="w-full flex items-center gap-2 text-xs text-mint bg-mint/10 border border-mint/20 rounded-xl px-4 py-3">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                                Proposal submitted — the employer will be in touch if you're shortlisted.
                            </div>
                            @else
                            <form class="project-proposal-form w-full"
                                data-project-id="{{ $job->id }}"
                                data-apply-url="{{ route('employee.projects.apply', $job->id) }}">
                                <div class="space-y-3">
                                    <div>
                                        <label class="text-xs font-semibold text-ink block mb-1">Cover Note</label>
                                        <textarea name="cover_note" rows="3" required maxlength="2000"
                                            class="w-full text-sm border border-line rounded-lg px-3 py-2 outline-none focus:border-brand focus:ring-1 focus:ring-brand/30"
                                            placeholder="Briefly explain why you're a good fit for this project..."></textarea>
                                    </div>
                                    <div class="grid grid-cols-2 gap-3">
                                        <div>
                                            <label class="text-xs font-semibold text-ink block mb-1">Proposed Rate</label>
                                            <input type="text" name="proposed_rate" required maxlength="100"
                                                class="w-full text-sm border border-line rounded-lg px-3 py-2 outline-none focus:border-brand focus:ring-1 focus:ring-brand/30"
                                                placeholder="e.g. ₹800/hr or ₹40,000 fixed">
                                        </div>
                                        <div>
                                            <label class="text-xs font-semibold text-ink block mb-1">Estimated Timeline</label>
                                            <input type="text" name="estimated_timeline" required maxlength="100"
                                                class="w-full text-sm border border-line rounded-lg px-3 py-2 outline-none focus:border-brand focus:ring-1 focus:ring-brand/30"
                                                placeholder="e.g. 3 weeks">
                                        </div>
                                    </div>
                                    <p class="proposal-error text-xs text-rose-600 hidden"></p>
                                    <button type="submit"
                                        class="proposal-submit-btn bg-brand hover:bg-brand/90 text-white text-sm font-semibold px-6 py-3 rounded-xl transition-colors w-full sm:w-auto">
                                        Submit Proposal
                                    </button>
                                </div>
                            </form>
                            @endif
                        @else
                        <button type="button"
                            class="job-apply-btn {{ $hasApplied ? 'bg-mint/10 text-mint cursor-default' : 'bg-brand hover:bg-brand/90 text-white' }} text-sm font-semibold px-6 py-3 rounded-xl transition-colors"
                            data-job-id="{{ $job->id }}"
                            data-apply-url="{{ route('employee.jobs.apply', $job->id) }}"
                            {{ $hasApplied ? 'disabled' : '' }}>
                            {{ $hasApplied ? 'Applied' : 'Apply Now' }}
                        </button>

                        <button type="button"
                            class="job-save-btn {{ $isSaved ? 'bg-brand/10 text-brand' : 'bg-surface text-slate2 hover:text-brand' }} text-sm font-semibold px-6 py-3 rounded-xl transition-colors"
                            data-context="modal"
                            data-job-id="{{ $job->id }}"
                            data-save-url="{{ route('employee.jobs.save', $job->id) }}"
                            data-saved="{{ $isSaved ? '1' : '0' }}">
                            {{ $isSaved ? 'Saved' : 'Save Job' }}
                        </button>
                        @endif
                    </div>
                </template>
                @empty
                <div class="bg-white rounded-2xl shadow-card p-14 text-center">
                    <div class="w-12 h-12 rounded-full bg-surface flex items-center justify-center mx-auto mb-4">
                        <svg class="w-5 h-5 text-slate2" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <p class="font-display font-bold text-sm text-ink">No jobs found</p>
                    <p class="text-xs text-slate2 mt-1">Try adjusting your search or filters.</p>
                </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $jobs->onEachSide(1)->fragment('jobs-list')->links() }}
            </div>
        </div>

        {{-- ---------- RIGHT SIDEBAR ---------- --}}
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
                <a href=""
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
                    @forelse ($topCompanies as $company)
                    <a href=""
                        class="flex items-center justify-between text-sm -mx-2 px-2 py-2 rounded-lg hover:bg-surface transition-colors">
                        <div class="flex items-center gap-2.5 min-w-0">
                            <span
                                class="w-8 h-8 rounded-lg bg-surface border border-line flex items-center justify-center text-[11px] font-bold text-brand shrink-0">
                                {{ strtoupper(substr($company['name'], 0, 1)) }}
                            </span>
                            <span class="text-ink/85 font-medium truncate">{{ $company['name'] }}</span>
                        </div>
                        <span class="text-xs text-slate2 shrink-0 ml-2">{{ $company['openings'] }}
                            {{ Str::plural('opening', $company['openings']) }}</span>
                    </a>
                    @empty
                    <p class="text-xs text-slate2">No active listings yet.</p>
                    @endforelse
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

                <a href="{{ route('employee.jobs.index', ['work_mode' => 'remote']) }}"
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
                <form action="" method="POST" class="mt-3.5 flex flex-col gap-2">
                    @csrf
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

            {{-- Header row: title left, bordered square close button right --}}
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 shrink-0">
                <h2 class="font-display font-bold text-lg text-ink">Job Details</h2>
                <button type="button" id="job-modal-close" aria-label="Close"
                    class="w-9 h-9 flex items-center justify-center rounded-lg border border-gray-200 text-gray-500 hover:text-gray-700 hover:bg-gray-50 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Scrollable content area --}}
            <div id="job-modal-content" class="overflow-y-auto p-6"></div>
        </div>
    </div>
</div>

<script>
(function() {
    var modal = document.getElementById('job-modal');
    var content = document.getElementById('job-modal-content');
    var csrfHolder = document.getElementById('csrf-holder');
    var csrfToken = csrfHolder ? csrfHolder.dataset.token : '';

    function openModal(jobId) {
        var tpl = document.getElementById('job-template-' + jobId);
        if (!tpl) return;
        content.innerHTML = '';
        content.appendChild(tpl.content.cloneNode(true));
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        modal.classList.add('hidden');
        content.innerHTML = '';
        document.body.style.overflow = '';
    }

    // Fire-and-forget POST. Because this is fetch (not a form submit),
    // the browser never navigates away - no reload, no jump to the hero section.
    function postAction(url) {
        return fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        });
    }

    function setApplied(jobId) {
        document.querySelectorAll('.job-apply-btn[data-job-id="' + jobId + '"]').forEach(function(btn) {
            btn.disabled = true;
            btn.textContent = 'Applied';
            btn.classList.remove('bg-brand', 'hover:bg-brand/90', 'text-white');
            btn.classList.add('bg-mint/10', 'text-mint', 'cursor-default');
        });

        var tagWrap = document.getElementById('job-tags-' + jobId);
        if (tagWrap && !tagWrap.querySelector('.applied-chip-' + jobId)) {
            var chip = document.createElement('span');
            chip.className = 'applied-chip-' + jobId +
                ' text-[11px] font-semibold px-2.5 py-1 rounded-full bg-mint/10 text-mint border border-mint/20 inline-flex items-center gap-1';
            chip.innerHTML = '<svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">' +
                '<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>Applied';
            tagWrap.appendChild(chip);
        }
    }

    function setSaved(jobId, saved) {
        document.querySelectorAll('.job-save-btn[data-job-id="' + jobId + '"]').forEach(function(btn) {
            btn.dataset.saved = saved ? '1' : '0';

            if (btn.dataset.context === 'modal') {
                btn.textContent = saved ? 'Saved' : 'Save Job';
                btn.classList.toggle('bg-brand/10', saved);
                btn.classList.toggle('text-brand', saved);
                btn.classList.toggle('bg-surface', !saved);
                btn.classList.toggle('text-slate2', !saved);
            } else {
                btn.setAttribute('aria-label', saved ? 'Unsave job' : 'Save job');
                btn.classList.toggle('text-brand', saved);
                btn.classList.toggle('bg-brand/10', saved);
                btn.classList.toggle('text-slate2', !saved);
                var svg = btn.querySelector('svg');
                if (svg) svg.setAttribute('fill', saved ? 'currentColor' : 'none');
            }
        });
    }

    document.addEventListener('click', function(e) {
        var applyBtn = e.target.closest('.job-apply-btn');
        if (applyBtn) {
            e.stopPropagation();
            if (applyBtn.disabled) return;
            var jobId = applyBtn.dataset.jobId;
            setApplied(jobId);
            postAction(applyBtn.dataset.applyUrl).catch(function() {
                // network/server error - the optimistic UI stays as "Applied";
                // refresh the page to re-sync if this happens repeatedly.
            });
            return;
        }

        var saveBtn = e.target.closest('.job-save-btn');
        if (saveBtn) {
            e.stopPropagation();
            var jobId2 = saveBtn.dataset.jobId;
            var nowSaved = saveBtn.dataset.saved !== '1';
            setSaved(jobId2, nowSaved);
            postAction(saveBtn.dataset.saveUrl).catch(function() {
                setSaved(jobId2, !nowSaved); // revert on failure
            });
            return;
        }

        var trigger = e.target.closest('[data-job-open]');
        if (trigger) {
            openModal(trigger.getAttribute('data-job-open'));
            return;
        }
        if (e.target.closest('#job-modal-close') || e.target.id === 'job-modal-backdrop') {
            closeModal();
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeModal();
    });

    // ---- Project proposal form (full-form apply for contract projects) ----
    document.addEventListener('submit', function(e) {
        var form = e.target.closest('.project-proposal-form');
        if (!form) return;
        e.preventDefault();

        var btn = form.querySelector('.proposal-submit-btn');
        var errorEl = form.querySelector('.proposal-error');
        var projectId = form.dataset.projectId;
        var url = form.dataset.applyUrl;
        var originalText = btn.textContent;

        errorEl.classList.add('hidden');
        btn.disabled = true;
        btn.textContent = 'Submitting...';

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                cover_note: form.cover_note.value,
                proposed_rate: form.proposed_rate.value,
                estimated_timeline: form.estimated_timeline.value
            })
        })
        .then(function(res) {
            return res.json().then(function(data) { return { ok: res.ok, data: data }; });
        })
        .then(function(result) {
            if (!result.ok) {
                var msg = result.data.message || 'Something went wrong. Please try again.';
                if (result.data.errors) {
                    msg = Object.values(result.data.errors).flat().join(' ');
                }
                errorEl.textContent = msg;
                errorEl.classList.remove('hidden');
                btn.disabled = false;
                btn.textContent = originalText;
                return;
            }

            form.outerHTML = '<div class="w-full flex items-center gap-2 text-xs text-mint bg-mint/10 border border-mint/20 rounded-xl px-4 py-3">' +
                '<svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">' +
                '<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>' +
                'Proposal submitted — the employer will be in touch if you\'re shortlisted.</div>';

            var tagWrap = document.getElementById('job-tags-project-' + projectId);
            if (tagWrap && !tagWrap.querySelector('.proposal-chip-' + projectId)) {
                var chip = document.createElement('span');
                chip.className = 'proposal-chip-' + projectId +
                    ' text-[11px] font-semibold px-2.5 py-1 rounded-full bg-mint/10 text-mint border border-mint/20 inline-flex items-center gap-1';
                chip.textContent = 'Proposal Sent';
                tagWrap.appendChild(chip);
            }
        })
        .catch(function() {
            errorEl.textContent = 'Network error. Please try again.';
            errorEl.classList.remove('hidden');
            btn.disabled = false;
            btn.textContent = originalText;
        });
    });
})();
</script>

@endsection
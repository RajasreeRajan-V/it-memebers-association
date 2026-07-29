@extends('layouts.app')

@section('content')

@include('employees.jobs._styles')
@include('employees.jobs._scripts')

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
                    <h2 class="font-display font-bold text-xl text-ink">Jobs for you</h2>
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
                $companyName = $job->employer->company_name
                ?? $job->employer->name
                ?? 'Company';

                $location = collect([$job->city, $job->state, $job->country])
                ->filter()
                ->implode(', ') ?: 'Location not specified';

                $employmentType = $job->employment_type
                ? ucfirst(str_replace('-', ' ', $job->employment_type))
                : null;

                $skills = is_array($job->skills) ? $job->skills : [];

                $palette = ['bg-blue-50 text-blue-600', 'bg-orange-50 text-orange-600', 'bg-violet-50 text-violet-600',
                'bg-emerald-50 text-emerald-600', 'bg-rose-50 text-rose-600'];
                $avatarClass = $palette[crc32($companyName) % count($palette)];

                $isSaved = in_array($job->id, $savedJobIds ?? []);
                $hasApplied = in_array($job->id, $appliedJobIds ?? []);
                @endphp

                <article data-job-open="{{ $job->id }}"
                    class="job-card group relative bg-white rounded-2xl shadow-card hover:shadow-cardHover transition-all duration-200 p-4 sm:p-5 flex gap-4 items-start overflow-hidden ring-1 ring-transparent hover:ring-brand/10 cursor-pointer">
                    <span
                        class="absolute left-0 top-0 h-full w-1 bg-brand scale-y-0 group-hover:scale-y-100 origin-top transition-transform duration-200"></span>

                    <div class="w-11 h-11 rounded-xl {{ $avatarClass }} flex items-center justify-center shrink-0">
                        <span class="font-display font-bold text-lg">{{ strtoupper(substr($companyName, 0, 1)) }}</span>
                    </div>

                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between gap-3">
                            <div class="min-w-0">
                                <span
                                    class="font-display font-bold text-sm sm:text-base text-ink group-hover:text-brand transition-colors">
                                    {{ $job->title }}
                                </span>
                                <p class="text-xs text-slate2 mt-1 flex flex-wrap items-center gap-x-1.5">
                                    <span class="font-medium text-ink/70">{{ $companyName }}</span>
                                    <span>&middot;</span>
                                    <span>{{ $location }}</span>
                                    @if ($employmentType) <span>&middot;</span><span>{{ $employmentType }}</span> @endif
                                    @if ($job->experience) <span>&middot;</span><span>{{ $job->experience }}</span>
                                    @endif
                                </p>
                            </div>
                            <div class="text-right shrink-0">
                                <p class="font-display font-bold text-mint text-sm">
                                    {{ $job->salary ?: 'Not disclosed' }}</p>
                                <p class="text-[11px] text-slate2 mt-1">{{ $job->created_at?->diffForHumans() }}</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-3.5">
                            <div class="flex flex-wrap gap-1.5">
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
                                    class="text-[11px] font-semibold px-2.5 py-1 rounded-full bg-mint/10 text-mint border border-mint/20 inline-flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Applied
                                </span>
                                @endif
                            </div>

                            <form action="{{ route('employee.jobs.save', $job->id) }}" method="POST"
                                class="shrink-0 ml-2" onclick="event.stopPropagation()">
                                @csrf
                                <button type="submit" aria-label="{{ $isSaved ? 'Unsave job' : 'Save job' }}" class="w-8 h-8 flex items-center justify-center rounded-lg transition-colors
                                                       {{ $isSaved ? 'text-brand bg-brand/10' : 'text-slate2 hover:text-brand hover:bg-brand/5' }}
                                                       focus-visible:ring-2 focus-visible:ring-brand">
                                    <svg class="w-4 h-4" fill="{{ $isSaved ? 'currentColor' : 'none' }}"
                                        stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-4-7 4V5z" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </article>

                <template id="job-template-{{ $job->id }}">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h2 class="font-display font-bold text-2xl text-ink">{{ $job->title }}</h2>
                            <p class="text-sm text-slate2 mt-2">
                                {{ $companyName }} &middot; {{ $location }}
                                @if ($employmentType) &middot; {{ $employmentType }} @endif
                                @if ($job->experience) &middot; {{ $job->experience }} @endif
                            </p>
                        </div>
                        <p class="font-display font-bold text-mint text-lg shrink-0">
                            {{ $job->salary ?: 'Not disclosed' }}</p>
                    </div>

                    <div class="flex flex-wrap gap-1.5 mt-4">
                        @if ($job->work_mode)
                        <span
                            class="text-[11px] font-medium px-2.5 py-1 rounded-full bg-brand/5 text-brand border border-brand/10 capitalize">{{ $job->work_mode }}</span>
                        @endif
                        @foreach ($skills as $tag)
                        <span
                            class="text-[11px] font-medium px-2.5 py-1 rounded-full bg-surface text-slate2 border border-line">{{ $tag }}</span>
                        @endforeach
                    </div>

                    @if ($job->qualification)
                    <p class="text-sm text-ink/80 mt-5"><span class="font-semibold">Qualification:</span>
                        {{ $job->qualification }}</p>
                    @endif

                    <div class="mt-6">
                        <h3 class="font-display font-bold text-sm text-ink mb-2">Job Description</h3>
                        <p class="text-sm text-ink/80 leading-relaxed whitespace-pre-line">{{ $job->description }}</p>
                    </div>

                    <div class="flex items-center gap-3 mt-8 pt-6 border-t border-line">
                        <form action="{{ route('employee.jobs.apply', $job->id) }}" method="POST">
                            @csrf
                            <button type="submit" @disabled($hasApplied)
                                class="{{ $hasApplied ? 'bg-mint/10 text-mint cursor-default' : 'bg-brand hover:bg-brand/90 text-white' }} text-sm font-semibold px-6 py-3 rounded-xl transition-colors">
                                {{ $hasApplied ? 'Applied' : 'Apply Now' }}
                            </button>
                        </form>

                        <form action="{{ route('employee.jobs.save', $job->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="{{ $isSaved ? 'bg-brand/10 text-brand' : 'bg-surface text-slate2 hover:text-brand' }} text-sm font-semibold px-6 py-3 rounded-xl transition-colors">
                                {{ $isSaved ? 'Saved' : 'Save Job' }}
                            </button>
                        </form>
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
                {{ $jobs->onEachSide(1)->links() }}
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
<div id="job-modal" class="hidden fixed inset-0 z-50">
    <div id="job-modal-backdrop" class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>
    <div class="relative min-h-full flex items-start sm:items-center justify-center p-4">
        <div
            class="bg-white rounded-2xl shadow-card ring-1 ring-black/[0.03] w-full max-w-2xl mt-10 sm:mt-0 max-h-[90vh] overflow-y-auto p-6">
            <div class="flex justify-end">
                <button type="button" id="job-modal-close" aria-label="Close"
                    class="w-8 h-8 flex items-center justify-center rounded-lg text-slate2 hover:text-ink hover:bg-surface transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div id="job-modal-content"></div>
        </div>
    </div>
</div>

<script>
(function() {
    var modal = document.getElementById('job-modal');
    var content = document.getElementById('job-modal-content');

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

    document.addEventListener('click', function(e) {
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
})();
</script>

@endsection
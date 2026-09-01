@extends('layouts.app')

@section('content')

@include('employees.jobs._styles')
@include('employees.jobs._scripts')

{{-- Holds the CSRF token for the AJAX apply/save calls below --}}
<div id="csrf-holder" data-token="{{ csrf_token() }}" class="hidden"></div>

{{-- ================= PAGE STYLES ================= --}}
<style>
    .line-clamp-2{display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
    .job-card{transition:box-shadow .15s ease,border-color .15s ease}
</style>

<div class="bg-white min-h-screen">

    {{-- ============ HERO (content left, image right) ============ --}}
    <div class="bg-gradient-to-b from-[#F5F8FF] to-white border-b border-slate-100">
        <div class="max-w-6xl mx-auto px-6 py-14 grid md:grid-cols-2 gap-10 items-center">

            {{-- Left: text content --}}
            <div class="flex flex-col items-start text-left">
                <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-blue-700 bg-blue-100/70 px-3.5 py-1.5 rounded-full mb-5">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M13 2 3 14h7l-1 8 11-14h-7l0-6z"/></svg>
                    {{ number_format($jobsCount) }}+ OPEN ROLES THIS WEEK
                </span>

                <h1 class="text-4xl sm:text-5xl font-bold text-slate-900 leading-tight mb-4">
                    Find the Right Job,<br>
                    <span class="text-blue-600">Build Your Future</span>
                </h1>

                <p class="text-slate-500 text-base mb-7 max-w-md">
                    Explore thousands of opportunities from vetted employers and take the
                    next step in your career journey.
                </p>

                <form action="{{ route('employee.jobs.index') }}#jobs-list" method="GET"
                      class="w-full flex items-stretch bg-white rounded-xl shadow-lg shadow-blue-900/5 border border-slate-100 p-1.5 mb-6 gap-1">
                    <div class="relative flex-[1.3]">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5" stroke-linecap="round"/>
                        </svg>
                        <input
                            type="text" name="q" value="{{ $filters['q'] ?? '' }}"
                            placeholder="Job title, keywords or company"
                            class="w-full h-full pl-9 pr-3 py-2.5 rounded-lg text-sm text-slate-700 placeholder-slate-400 focus:outline-none"
                        >
                    </div>

                    <div class="w-px bg-slate-200 my-1.5"></div>

                    <div class="relative flex-1">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17.657 16.657 13.414 20.9a2 2 0 0 1-2.828 0l-4.243-4.243a8 8 0 1 1 11.314 0Z"/>
                            <circle cx="12" cy="11" r="3"/>
                        </svg>
                        <input
                            type="text" name="location" value="{{ $filters['location'] ?? '' }}"
                            placeholder="Location"
                            class="w-full h-full pl-9 pr-3 py-2.5 rounded-lg text-sm text-slate-700 placeholder-slate-400 focus:outline-none"
                        >
                    </div>

                    <div class="w-px bg-slate-200 my-1.5"></div>

                    <div class="relative flex-1">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 6h16M7 12h10M10 18h4"/>
                        </svg>
                        <select name="category" class="w-full h-full appearance-none pl-9 pr-6 py-2.5 rounded-lg text-sm text-slate-700 bg-transparent focus:outline-none cursor-pointer">
                            <option value="">All Categories</option>
                            @foreach (config('job_categories') as $value => $category)
                                <option value="{{ $value }}" @selected(($filters['category'] ?? '') === $value)>{{ $category['label'] }}</option>
                            @endforeach
                        </select>
                        <svg class="absolute right-2 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-slate-400 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="m6 9 6 6 6-6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>

                    <input type="hidden" name="employment_type" value="{{ $filters['employment_type'] ?? '' }}">
                    <input type="hidden" name="work_mode" value="{{ $filters['work_mode'] ?? '' }}">
                    <input type="hidden" name="sort" value="{{ $filters['sort'] ?? '' }}">

                    <button type="submit" class="px-6 py-2.5 rounded-lg bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700 transition shrink-0">
                        Search
                    </button>
                </form>

                {{-- Popular tags — single row --}}
                <div class="flex flex-nowrap items-center justify-start gap-2 text-sm w-full overflow-x-auto">
                    <span class="text-slate-400 font-medium mr-1 shrink-0">Popular:</span>
                    @foreach (['Web Developer','Flutter Developer', 'Data Analyst'] as $tag)
                        <a href="{{ route('employee.jobs.index', ['q' => $tag]) }}"
                           class="shrink-0 px-3.5 py-1.5 rounded-full bg-white border border-slate-200 text-slate-600 hover:border-blue-400 hover:text-blue-600 transition whitespace-nowrap">
                            {{ $tag }}
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Right: hero image with floating badge cards --}}
            <div class="relative flex justify-center md:justify-end">
                <img
                    src="{{ asset('assets/img/bagg.png') }}"
                    alt="Find your next job"
                    class="w-full max-w-md h-auto rounded-xl object-contain"
                    onerror="this.style.display='none'"
                >

                <div class="absolute top-6 left-0 md:left-4 flex items-center gap-2 bg-white rounded-xl shadow-lg shadow-blue-900/10 px-4 py-2.5">
                    <span class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 12h6m-6 4h6M9 8h1M5 21h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2Z"/>
                        </svg>
                    </span>
                    <span class="text-sm font-semibold text-slate-800 whitespace-nowrap">Applications</span>
                </div>

                <div class="absolute bottom-6 left-0 md:-left-6 flex items-center gap-2 bg-white rounded-xl shadow-lg shadow-blue-900/10 px-4 py-2.5">
                    <span class="w-6 h-6 rounded-full bg-emerald-100 flex items-center justify-center shrink-0">
                        <svg class="w-3.5 h-3.5 text-emerald-600" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                    </span>
                    <span class="text-sm font-semibold text-slate-800 whitespace-nowrap">Browse The Jobs</span>
                </div>
            </div>
        </div>
    </div>

    {{-- ============ BODY ============ --}}
    <div class="max-w-7xl mx-auto px-4 py-8 grid lg:grid-cols-[280px_1fr_300px] gap-6">

        {{-- ---------- LEFT: Filters ---------- --}}
        <aside class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 h-fit lg:sticky lg:top-6">

            {{-- Header --}}
            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                <h3 class="flex items-center gap-2 text-base font-semibold text-slate-800">
                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 6h16M7 12h10M10 18h4"/>
                    </svg>
                    Filters
                </h3>
                <a href="{{ route('employee.jobs.index') }}" class="text-sm font-medium text-blue-600 hover:underline">Clear all</a>
            </div>

            {{-- Categories --}}
            <div class="py-4 border-b border-slate-100">
                <h4 class="text-xs font-semibold tracking-widest text-slate-400 uppercase mb-3">Categories</h4>
                <ul class="space-y-1 max-h-72 overflow-y-auto pr-1">
                    @php $activeCategory = $filters['category'] ?? ''; @endphp
                    <li>
                        <a href="{{ route('employee.jobs.index') }}#jobs-list"
                           class="flex items-center px-2.5 py-1.5 rounded-md text-sm transition
                                  {{ $activeCategory === '' ? 'bg-blue-50 text-blue-600 font-medium' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-800' }}">
                            All Categories
                        </a>
                    </li>
                    @foreach (config('job_categories') as $value => $category)
                        @php $isActive = $activeCategory === $value; @endphp
                        <li>
                            <a href="{{ route('employee.jobs.index', array_filter(['category' => $value])) }}#jobs-list"
                               class="flex items-center px-2.5 py-1.5 rounded-md text-sm transition
                                      {{ $isActive ? 'bg-blue-50 text-blue-600 font-medium' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-800' }}">
                                {{ $category['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <form action="{{ route('employee.jobs.index') }}#jobs-list" method="GET">
                <input type="hidden" name="q" value="{{ $filters['q'] ?? '' }}">
                <input type="hidden" name="category" value="{{ $filters['category'] ?? '' }}">

                {{-- Job Type --}}
                <div class="py-4 border-b border-slate-100">
                    <h4 class="text-xs font-semibold tracking-widest text-slate-400 uppercase mb-3">Job Type</h4>
                    <select name="employment_type" class="w-full border border-slate-200 rounded-md text-sm py-1.5 px-2 text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500/40">
                        <option value="" {{ ($filters['employment_type'] ?? '') === '' ? 'selected' : '' }}>All Job Types</option>
                        <option value="full-time" {{ ($filters['employment_type'] ?? '') === 'full-time' ? 'selected' : '' }}>Full Time</option>
                        <option value="part-time" {{ ($filters['employment_type'] ?? '') === 'part-time' ? 'selected' : '' }}>Part Time</option>
                        <option value="contract" {{ ($filters['employment_type'] ?? '') === 'contract' ? 'selected' : '' }}>Contract</option>
                        <option value="freelance" {{ ($filters['employment_type'] ?? '') === 'freelance' ? 'selected' : '' }}>Freelance</option>
                    </select>
                </div>

                {{-- Work Mode --}}
                <div class="py-4 border-b border-slate-100">
                    <h4 class="text-xs font-semibold tracking-widest text-slate-400 uppercase mb-3">Work Mode</h4>
                    <select name="work_mode" class="w-full border border-slate-200 rounded-md text-sm py-1.5 px-2 text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500/40">
                        <option value="" {{ ($filters['work_mode'] ?? '') === '' ? 'selected' : '' }}>All Modes</option>
                        <option value="onsite" {{ ($filters['work_mode'] ?? '') === 'onsite' ? 'selected' : '' }}>Onsite</option>
                        <option value="hybrid" {{ ($filters['work_mode'] ?? '') === 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                        <option value="remote" {{ ($filters['work_mode'] ?? '') === 'remote' ? 'selected' : '' }}>Remote</option>
                    </select>
                </div>

                {{-- Sort By --}}
                <div class="py-4">
                    <h4 class="text-xs font-semibold tracking-widest text-slate-400 uppercase mb-3">Sort By</h4>
                    <select name="sort" class="w-full border border-slate-200 rounded-md text-sm py-1.5 px-2 text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500/40">
                        <option value="relevant" {{ ($filters['sort'] ?? 'relevant') === 'relevant' ? 'selected' : '' }}>Most Relevant</option>
                        <option value="newest" {{ ($filters['sort'] ?? '') === 'newest' ? 'selected' : '' }}>Newest</option>
                    </select>
                </div>

                <button type="submit" class="w-full rounded-lg bg-blue-600 text-white text-sm font-medium py-2 hover:bg-blue-700 transition">
                    Apply Filters
                </button>
            </form>

            {{-- ---------- SAVED / APPLIED / etc NAV ---------- --}}
            <div class="pt-5 mt-5 border-t border-slate-100 space-y-1">
                <a href="{{ route('employee.jobs.saved') }}"
                   class="flex items-center justify-between gap-2 rounded-md px-2.5 py-2 text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-800 transition">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16l-7-4-7 4V5Z"/></svg>
                        Saved Jobs
                    </span>
                    @if (($savedJobsCount ?? 0) > 0)
                        <span class="text-xs font-semibold text-blue-500 bg-blue-50 rounded-full px-2 py-0.5">{{ $savedJobsCount }}</span>
                    @endif
                </a>
                <a href="{{ route('employee.jobs.applied') }}"
                   class="flex items-center justify-between gap-2 rounded-md px-2.5 py-2 text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-800 transition">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        Applied Jobs
                    </span>
                    @if (($appliedJobsCount ?? 0) > 0)
                        <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 rounded-full px-2 py-0.5">{{ $appliedJobsCount }}</span>
                    @endif
                </a>
                <a href="{{ route('employee.projects.proposals') }}"
                   class="flex items-center justify-between gap-2 rounded-md px-2.5 py-2 text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-800 transition">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-2M9 5a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2M9 5a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2m0 0h2a2 2 0 0 1 2 2v3m-6 4h6m-6 4h6"/></svg>
                        My Proposals
                    </span>
                    @if (($proposalsCount ?? 0) > 0)
                        <span class="text-xs font-semibold text-amber-600 bg-amber-50 rounded-full px-2 py-0.5">{{ $proposalsCount }}</span>
                    @endif
                </a>
                <a href="{{ route('employee.jobs.interviews') }}"
                   class="flex items-center justify-between gap-2 rounded-md px-2.5 py-2 text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-800 transition">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2Z"/></svg>
                        Interviews
                    </span>
                    @if (($interviewsCount ?? 0) > 0)
                        <span class="text-xs font-semibold text-blue-500 bg-blue-50 rounded-full px-2 py-0.5">{{ $interviewsCount }}</span>
                    @endif
                </a>
                <a href="{{ route('employee.jobs.inProgress') }}"
                   class="flex items-center justify-between gap-2 rounded-md px-2.5 py-2 text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-800 transition">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2m5-2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                        In Progress
                    </span>
                    @if (($inprogress ?? 0) > 0)
                        <span class="text-xs font-semibold text-amber-600 bg-amber-50 rounded-full px-2 py-0.5">{{ $inprogress }}</span>
                    @endif
                </a>
                <a href="{{ route('employee.jobs.hired') }}"
                   class="flex items-center justify-between gap-2 rounded-md px-2.5 py-2 text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-800 transition">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 6V5a3 3 0 0 1 3-3 3 3 0 0 1 3 3v1m-9 3h12a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2Zm6 4 2 2 4-4"/></svg>
                        Hired
                    </span>
                    @if (($hiredJobsCount ?? 0) > 0)
                        <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 rounded-full px-2 py-0.5">{{ $hiredJobsCount }}</span>
                    @endif
                </a>
                <a href="{{ route('employee.jobs.archived') }}"
                   class="flex items-center justify-between gap-2 rounded-md px-2.5 py-2 text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-800 transition">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.54 5.23 19.15 3.14A1 1 0 0 0 18.32 2H5.68a1 1 0 0 0-.83.45L3.46 5.23A2 2 0 0 0 3 6.34V8a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.34a2 2 0 0 0-.46-1.11ZM5 10v8a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-8M9 14h6"/></svg>
                        Archived
                    </span>
                    @if (($archivedCount ?? 0) > 0)
                        <span class="text-xs font-semibold text-slate-500 bg-slate-100 rounded-full px-2 py-0.5">{{ $archivedCount }}</span>
                    @endif
                </a>
            </div>
        </aside>

        {{-- ---------- CENTER: Tabs + Job list ---------- --}}
        <main id="jobs-list">
            <div class="flex items-center justify-between gap-4 mb-5">
                <h2 class="text-[13px] font-bold text-slate-500 uppercase tracking-[0.12em]">
                    Jobs For You <span class="text-slate-400 font-medium normal-case tracking-normal">&middot; {{ number_format($jobsCount) }} {{ Str::plural('job', $jobsCount) }} found</span>
                </h2>
            </div>

            <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-100 pb-2 mb-5">
                <div class="flex items-center gap-6 text-[15px]">
                    <span class="pb-2 -mb-[9px] border-b-2 border-blue-600 text-blue-600 font-semibold tracking-tight">
                        All Jobs
                    </span>
                </div>

                <label class="flex items-center gap-2 text-sm font-medium text-slate-500">
                    Sort by:
                    <select name="sort" onchange="updateSort(this.value)" class="border border-slate-200 rounded-md text-sm font-medium py-1.5 px-2.5 text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500/40">
                        <option value="relevant" {{ ($filters['sort'] ?? 'relevant') === 'relevant' ? 'selected' : '' }}>Most Relevant</option>
                        <option value="newest" {{ ($filters['sort'] ?? '') === 'newest' ? 'selected' : '' }}>Newest</option>
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
                            $employmentType = $job->project_type === 'hourly' ? 'Hourly Contract' : 'Fixed-Price Contract';
                            $payDisplay = $job->budget ?: 'Budget not disclosed';
                            $experienceDisplay = $job->experience_level ? ucfirst($job->experience_level) : null;
                            $extraMeta = $job->duration ?: null;
                        } else {
                            $employmentType = $job->employment_type
                                ? ucfirst(str_replace('-', ' ', $job->employment_type))
                                : null;
                            $payDisplay = $job->salary ?: 'Not disclosed';
                            $experienceDisplay = $job->experience;
                            $extraMeta = null;
                        }

                        $skills = is_array($job->skills) ? $job->skills : [];

                        $palette = ['bg-blue-50 text-blue-600', 'bg-orange-50 text-orange-600', 'bg-violet-50 text-violet-600', 'bg-emerald-50 text-emerald-600', 'bg-rose-50 text-rose-600'];
                        $avatarClass = $palette[crc32($companyName) % count($palette)];

                        $isSaved = !$isProject && in_array($job->id, $savedJobIds ?? []);
                        $hasApplied = !$isProject && in_array($job->id, $appliedJobIds ?? []);
                        $hasProposed = $isProject && in_array($job->id, $appliedProjectIds ?? []);
                    @endphp

                    <article data-job-open="{{ $job->listing_type }}-{{ $job->id }}"
                             class="job-card bg-white border rounded-xl px-4 py-3.5 hover:shadow-sm hover:border-slate-300 transition cursor-pointer {{ $isProject ? 'border-amber-200 bg-amber-50/30' : 'border-slate-200' }}">
                        <div class="flex items-start gap-3">
                            @if ($companyLogo)
                                <img src="{{ asset('storage/' . $companyLogo) }}" alt="{{ $companyName }}"
                                     class="w-11 h-11 sm:w-12 sm:h-12 object-cover rounded-lg bg-slate-100 shrink-0">
                            @else
                                <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-lg {{ $avatarClass }} flex items-center justify-center shrink-0">
                                    <span class="font-bold text-lg">{{ strtoupper(substr($companyName, 0, 1)) }}</span>
                                </div>
                            @endif

                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-3">
                                    <div class="min-w-0">
                                        <div class="flex items-center flex-wrap gap-2">
                                            <h2 class="text-[14.5px] font-bold text-slate-900 hover:text-blue-600 transition leading-snug tracking-tight">
                                                {{ $job->title }}
                                            </h2>
                                            @if ($isProject)
                                                <span title="Contract project posted specifically for employees, not a regular job listing."
                                                      class="inline-flex items-center gap-1 text-[10px] font-bold tracking-wide text-amber-700 bg-amber-50 border border-amber-200 px-2 py-0.5 rounded-full uppercase shrink-0">
                                                    Contract Project
                                                </span>
                                            @elseif ($employmentType)
                                                <span class="inline-flex items-center gap-1 text-[10px] font-bold tracking-wide text-amber-700 bg-amber-50 px-2 py-0.5 rounded-full uppercase shrink-0">
                                                    {{ $employmentType }}
                                                </span>
                                            @endif
                                        </div>

                                        <p class="text-[12.5px] text-slate-500 font-medium mt-1 truncate">
                                            {{ $companyName }} &middot; {{ $location }}
                                            @if ($experienceDisplay) &middot; {{ $experienceDisplay }} @endif
                                            @if ($extraMeta) &middot; {{ $extraMeta }} @endif
                                        </p>
                                    </div>

                                    <div class="text-right shrink-0">
                                        <p class="text-emerald-600 font-bold text-[13.5px]">
                                            {{ $payDisplay }}
                                        </p>
                                        <p class="text-[11.5px] text-slate-400 font-medium mt-1">
                                            {{ $job->created_at?->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-1.5 mt-2.5 flex-wrap">
                                    @if ($job->work_mode)
                                        <span class="text-[11px] font-medium px-2.5 py-1 rounded-full bg-blue-50 text-blue-600 capitalize">{{ $job->work_mode }}</span>
                                    @endif
                                    @foreach (array_slice($skills, 0, 4) as $tag)
                                        <span class="text-[11px] font-medium px-2.5 py-1 rounded-full bg-slate-50 text-slate-500 border border-slate-100">{{ $tag }}</span>
                                    @endforeach

                                    <span id="job-tags-{{ $job->listing_type }}-{{ $job->id }}" class="contents">
                                        @if ($hasApplied)
                                            <span class="applied-chip-{{ $job->id }} text-[11px] font-semibold px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-600 inline-flex items-center gap-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                                Applied
                                            </span>
                                        @endif
                                        @if ($hasProposed)
                                            <span class="proposal-chip-{{ $job->id }} text-[11px] font-semibold px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-600">Proposal Sent</span>
                                        @endif
                                    </span>

                                    @if (!$isProject)
                                        <button type="button"
                                                class="job-save-btn ml-auto flex items-center gap-1 text-[12.5px] font-medium transition {{ $isSaved ? 'text-blue-600' : 'text-slate-400 hover:text-blue-500' }}"
                                                data-context="card" data-job-id="{{ $job->id }}"
                                                data-save-url="{{ route('employee.jobs.save', $job->id) }}"
                                                data-saved="{{ $isSaved ? '1' : '0' }}"
                                                aria-label="{{ $isSaved ? 'Unsave job' : 'Save job' }}">
                                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="{{ $isSaved ? 'currentColor' : 'none' }}">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16l-7-4-7 4V5Z"/>
                                            </svg>
                                            {{ $isSaved ? 'Saved' : 'Save' }}
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </article>

                    {{-- Hidden template with FULL details for this listing. JS copies this into the modal. --}}
                    <template id="job-template-{{ $job->listing_type }}-{{ $job->id }}">
                        <div class="flex items-center gap-4">
                            @if ($companyLogo)
                                <img src="{{ asset('storage/' . $companyLogo) }}" alt="{{ $companyName }}" class="w-14 h-14 rounded-xl object-cover shrink-0 border border-slate-100">
                            @else
                                <div class="w-14 h-14 rounded-xl {{ $avatarClass }} flex items-center justify-center shrink-0">
                                    <span class="font-bold text-lg">{{ strtoupper(substr($companyName, 0, 1)) }}</span>
                                </div>
                            @endif
                            <div class="min-w-0">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <h3 class="font-bold text-lg text-slate-900">{{ $job->title }}</h3>
                                    @if ($isProject)
                                        <span class="inline-flex items-center text-[10px] font-bold uppercase tracking-wide px-2 py-0.5 rounded-full bg-amber-50 text-amber-700 border border-amber-200">Contract Project</span>
                                    @endif
                                </div>
                                <p class="text-sm text-slate-500">{{ $companyName }} &middot; {{ $location }}</p>
                            </div>
                        </div>

                        <div class="mt-6 grid grid-cols-2 gap-3">
                            <div class="bg-slate-50 rounded-xl px-4 py-3">
                                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wide">{{ $isProject ? 'Budget' : 'Salary' }}</p>
                                <p class="text-slate-900 font-semibold mt-1">{{ $payDisplay }}</p>
                            </div>

                            @if ($employmentType)
                                <div class="bg-slate-50 rounded-xl px-4 py-3">
                                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wide">{{ $isProject ? 'Contract Type' : 'Employment Type' }}</p>
                                    <p class="text-slate-900 font-semibold mt-1">{{ $employmentType }}</p>
                                </div>
                            @endif

                            @if ($job->work_mode)
                                <div class="bg-slate-50 rounded-xl px-4 py-3">
                                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wide">Work Mode</p>
                                    <p class="text-slate-900 font-semibold mt-1 capitalize">{{ $job->work_mode }}</p>
                                </div>
                            @endif

                            @if ($experienceDisplay)
                                <div class="bg-slate-50 rounded-xl px-4 py-3">
                                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wide">Experience</p>
                                    <p class="text-slate-900 font-semibold mt-1">{{ $experienceDisplay }}</p>
                                </div>
                            @endif

                            @if ($isProject && $extraMeta)
                                <div class="bg-slate-50 rounded-xl px-4 py-3">
                                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wide">Duration</p>
                                    <p class="text-slate-900 font-semibold mt-1">{{ $extraMeta }}</p>
                                </div>
                            @endif

                            @if (!$isProject && $job->qualification)
                                <div class="bg-slate-50 rounded-xl px-4 py-3 col-span-2">
                                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wide">Qualification</p>
                                    <p class="text-slate-900 font-semibold mt-1">{{ $job->qualification }}</p>
                                </div>
                            @endif
                        </div>

                        @if (count($skills))
                            <div class="mt-5 bg-slate-50 rounded-xl px-4 py-3">
                                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wide mb-2">Skills</p>
                                <div class="flex flex-wrap gap-1.5">
                                    @foreach ($skills as $tag)
                                        <span class="text-[11px] font-medium px-2.5 py-1 rounded-full bg-white text-slate-500 border border-slate-200">{{ $tag }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="mt-5">
                            <h3 class="font-bold text-sm text-slate-900 mb-2">Description</h3>
                            <p class="text-sm text-slate-600 leading-relaxed whitespace-pre-line">{{ $job->description }}</p>
                        </div>

                        <div class="flex items-center gap-3 mt-6 pt-6 border-t border-slate-100">
                            @if ($isProject)
                                @if ($hasProposed)
                                    <div class="w-full flex items-center gap-2 text-xs text-emerald-600 bg-emerald-50 border border-emerald-100 rounded-xl px-4 py-3">
                                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                        Proposal submitted — the employer will be in touch if you're shortlisted.
                                    </div>
                                @else
                                    <form class="project-proposal-form w-full" data-project-id="{{ $job->id }}" data-apply-url="{{ route('employee.projects.apply', $job->id) }}">
                                        <div class="space-y-3">
                                            <div>
                                                <label class="text-xs font-semibold text-slate-700 block mb-1">Cover Note</label>
                                                <textarea name="cover_note" rows="3" required maxlength="2000"
                                                          class="w-full text-sm border border-slate-200 rounded-lg px-3 py-2 outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500/30"
                                                          placeholder="Briefly explain why you're a good fit for this project..."></textarea>
                                            </div>
                                            <div class="grid grid-cols-2 gap-3">
                                                <div>
                                                    <label class="text-xs font-semibold text-slate-700 block mb-1">Proposed Rate</label>
                                                    <input type="text" name="proposed_rate" required maxlength="100"
                                                           class="w-full text-sm border border-slate-200 rounded-lg px-3 py-2 outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500/30"
                                                           placeholder="e.g. ₹800/hr or ₹40,000 fixed">
                                                </div>
                                                <div>
                                                    <label class="text-xs font-semibold text-slate-700 block mb-1">Estimated Timeline</label>
                                                    <input type="text" name="estimated_timeline" required maxlength="100"
                                                           class="w-full text-sm border border-slate-200 rounded-lg px-3 py-2 outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500/30"
                                                           placeholder="e.g. 3 weeks">
                                                </div>
                                            </div>
                                            <p class="proposal-error text-xs text-rose-600 hidden"></p>
                                            <button type="submit" class="proposal-submit-btn bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-6 py-3 rounded-xl transition-colors w-full sm:w-auto">
                                                Submit Proposal
                                            </button>
                                        </div>
                                    </form>
                                @endif
                            @else
                                <button type="button"
                                        class="job-apply-btn {{ $hasApplied ? 'bg-emerald-50 text-emerald-600 cursor-default' : 'bg-blue-600 hover:bg-blue-700 text-white' }} text-sm font-semibold px-6 py-3 rounded-xl transition-colors"
                                        data-job-id="{{ $job->id }}" data-apply-url="{{ route('employee.jobs.apply', $job->id) }}"
                                        {{ $hasApplied ? 'disabled' : '' }}>
                                    {{ $hasApplied ? 'Applied' : 'Apply Now' }}
                                </button>

                                <button type="button"
                                        class="job-save-btn {{ $isSaved ? 'bg-blue-50 text-blue-600' : 'bg-slate-50 text-slate-500 hover:text-blue-600' }} text-sm font-semibold px-6 py-3 rounded-xl transition-colors"
                                        data-context="modal" data-job-id="{{ $job->id }}"
                                        data-save-url="{{ route('employee.jobs.save', $job->id) }}"
                                        data-saved="{{ $isSaved ? '1' : '0' }}">
                                    {{ $isSaved ? 'Saved' : 'Save Job' }}
                                </button>
                            @endif
                        </div>
                    </template>
                @empty
                    <div class="text-center text-slate-400 py-14 text-base font-medium">
                        No jobs found. Try a different search or filter.
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="mt-6">{{ $jobs->onEachSide(1)->fragment('jobs-list')->links() }}</div>
        </main>

        {{-- ---------- RIGHT: Companies + Promo ---------- --}}
        <aside class="space-y-6">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-xs font-semibold tracking-widest text-slate-400 uppercase">Top Companies Hiring</h3>
                </div>
                <ul class="space-y-3">
                    @forelse ($topCompanies as $company)
                        <li>
                            <a href="" class="flex items-center gap-3 group">
                                <span class="w-11 h-11 rounded-lg bg-slate-50 border border-slate-100 flex items-center justify-center text-sm font-bold text-blue-600 shrink-0">
                                    {{ strtoupper(substr($company['name'], 0, 1)) }}
                                </span>
                                <div class="min-w-0">
                                    <p class="text-sm font-medium text-slate-800 group-hover:text-blue-600 leading-snug truncate">
                                        {{ $company['name'] }}
                                    </p>
                                    <p class="text-xs text-slate-400 mt-1">{{ $company['openings'] }} {{ Str::plural('opening', $company['openings']) }}</p>
                                </div>
                            </a>
                        </li>
                    @empty
                        <p class="text-sm text-slate-400">No active listings yet.</p>
                    @endforelse
                </ul>
            </div>

            <div class="rounded-xl bg-gradient-to-br from-blue-600 to-blue-500 p-6 text-white">
                <h3 class="font-semibold text-lg mb-3">Boost Your Profile</h3>

                <p class="text-sm text-blue-100 leading-6 mb-5">
                    Add your skills and experience so employers can find you faster, and get
                    job recommendations tailored to what you're looking for.
                </p>

                <div class="space-y-2 text-sm mb-5">
                    <div class="flex items-center gap-2"><span>📄</span><span>Complete Profile</span></div>
                    <div class="flex items-center gap-2"><span>🎯</span><span>Personalized Matches</span></div>
                    <div class="flex items-center gap-2"><span>🚀</span><span>Faster Applications</span></div>
                </div>

                <a href="{{ route('profile') }}" class="inline-block bg-white text-blue-600 text-sm font-semibold px-4 py-2.5 rounded-lg hover:bg-white/90 transition">
                    Create Profile
                </a>
            </div>

            <div class="rounded-xl border border-slate-200 p-5">
                <h3 class="font-semibold text-sm text-slate-800 mb-1.5">Work From Anywhere</h3>
                <p class="text-xs text-slate-500 leading-relaxed mb-4">Explore remote jobs from top companies hiring globally.</p>
                <a href="{{ route('employee.jobs.index', ['work_mode' => 'remote']) }}"
                   class="inline-flex items-center gap-1.5 text-blue-600 text-sm font-semibold hover:underline">
                    Explore Remote Jobs
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            <div class="rounded-xl border border-slate-200 p-5">
                <h3 class="font-semibold text-sm text-slate-800">Get Job Alerts</h3>
                <p class="text-xs text-slate-500 mt-1.5 leading-relaxed mb-3.5">Subscribe and never miss an opportunity that matches your profile.</p>
                <form action="" method="POST" class="flex flex-col gap-2">
                    @csrf
                    <input type="email" name="email" placeholder="Enter your email" required
                           class="w-full text-xs border border-slate-200 rounded-lg px-3 py-2.5 outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500/30 transition">
                    <button type="submit" class="rounded-lg bg-blue-600 text-white text-xs font-semibold px-4 py-2.5 hover:bg-blue-700 transition">
                        Subscribe
                    </button>
                </form>
            </div>
        </aside>
    </div>
</div>

{{-- ================= JOB DETAILS MODAL ================= --}}
<div id="job-modal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4 pt-20 overflow-y-auto">
    <div class="bg-white rounded-xl max-w-2xl w-full my-8 relative shadow-2xl max-h-[90vh] flex flex-col">
        <button id="job-modal-close" type="button" aria-label="Close"
                class="absolute top-5 right-5 w-9 h-9 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 flex items-center justify-center text-slate-500 hover:text-slate-800 shadow-sm z-20">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round"><path d="M6 6l12 12M18 6L6 18"/></svg>
        </button>

        <div id="job-modal-content" class="p-8 overflow-y-auto"></div>
    </div>
</div>
<div id="job-modal-backdrop" class="hidden"></div>

<script>
(function() {
    var modal = document.getElementById('job-modal');
    var content = document.getElementById('job-modal-content');
    var csrfHolder = document.getElementById('csrf-holder');
    var csrfToken = csrfHolder ? csrfHolder.dataset.token : '';

    window.updateSort = function (value) {
        var url = new URL(window.location.href);
        url.searchParams.set('sort', value);
        url.hash = 'jobs-list';
        window.location.href = url.toString();
    };

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
            btn.classList.remove('bg-blue-600', 'hover:bg-blue-700', 'text-white');
            btn.classList.add('bg-emerald-50', 'text-emerald-600', 'cursor-default');
        });

        var tagWrap = document.getElementById('job-tags-' + jobId);
        if (tagWrap && !tagWrap.querySelector('.applied-chip-' + jobId)) {
            var chip = document.createElement('span');
            chip.className = 'applied-chip-' + jobId + ' text-[11px] font-semibold px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-600 inline-flex items-center gap-1';
            chip.innerHTML = '<svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>Applied';
            tagWrap.appendChild(chip);
        }
    }

    function setSaved(jobId, saved) {
        document.querySelectorAll('.job-save-btn[data-job-id="' + jobId + '"]').forEach(function(btn) {
            btn.dataset.saved = saved ? '1' : '0';

            if (btn.dataset.context === 'modal') {
                btn.textContent = saved ? 'Saved' : 'Save Job';
                btn.classList.toggle('bg-blue-50', saved);
                btn.classList.toggle('text-blue-600', saved);
                btn.classList.toggle('bg-slate-50', !saved);
                btn.classList.toggle('text-slate-500', !saved);
            } else {
                btn.setAttribute('aria-label', saved ? 'Unsave job' : 'Save job');
                btn.classList.toggle('text-blue-600', saved);
                btn.classList.toggle('text-slate-400', !saved);
                btn.textContent = saved ? ' Saved' : ' Save';
                var svg = btn.querySelector('svg');
                if (svg) {
                    svg.setAttribute('fill', saved ? 'currentColor' : 'none');
                    btn.prepend(svg);
                }
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
            postAction(applyBtn.dataset.applyUrl).catch(function() {});
            return;
        }

        var saveBtn = e.target.closest('.job-save-btn');
        if (saveBtn) {
            e.stopPropagation();
            var jobId2 = saveBtn.dataset.jobId;
            var nowSaved = saveBtn.dataset.saved !== '1';
            setSaved(jobId2, nowSaved);
            postAction(saveBtn.dataset.saveUrl).catch(function() {
                setSaved(jobId2, !nowSaved);
            });
            return;
        }

        var trigger = e.target.closest('[data-job-open]');
        if (trigger) {
            openModal(trigger.getAttribute('data-job-open'));
            return;
        }
        if (e.target.closest('#job-modal-close') || e.target.id === 'job-modal') {
            closeModal();
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeModal();
    });

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
                if (result.data.errors) msg = Object.values(result.data.errors).flat().join(' ');
                errorEl.textContent = msg;
                errorEl.classList.remove('hidden');
                btn.disabled = false;
                btn.textContent = originalText;
                return;
            }

            form.outerHTML = '<div class="w-full flex items-center gap-2 text-xs text-emerald-600 bg-emerald-50 border border-emerald-100 rounded-xl px-4 py-3">' +
                '<svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>' +
                'Proposal submitted — the employer will be in touch if you\'re shortlisted.</div>';

            var tagWrap = document.getElementById('job-tags-project-' + projectId);
            if (tagWrap && !tagWrap.querySelector('.proposal-chip-' + projectId)) {
                var chip = document.createElement('span');
                chip.className = 'proposal-chip-' + projectId + ' text-[11px] font-semibold px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-600';
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
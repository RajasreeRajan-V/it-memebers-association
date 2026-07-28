@extends('layouts.app')

@section('content')

    {{-- Load Tailwind FIRST, before any markup that depends on it, so the browser
         doesn't paint the raw unstyled Bootstrap HTML before Tailwind's utility
         classes are injected. This is what was causing the "unstyled flash until
         you click something" bug — the script used to sit at the bottom of the
         page, so everything above it painted unstyled first. --}}
    @include('employees.jobs._styles')
    @include('employees.jobs._scripts')

    {{-- ================= HERO / SEARCH ================= --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-[#EAF0FF] via-[#F3F6FF] to-[#FBF4EF]">
        {{-- subtle dot-grid texture --}}
        <div class="absolute inset-0 opacity-[0.4] pointer-events-none"
             style="background-image:radial-gradient(currentColor 1px, transparent 1px); background-size:22px 22px; color:#C9D3EE;"></div>

        <div class="max-w-7xl mx-auto px-6 pt-16 pb-28 relative z-10">
            <div class="max-w-2xl">
                <span class="inline-flex items-center gap-1.5 text-[11px] font-semibold tracking-wide uppercase text-brand bg-brand/10 px-3 py-1.5 rounded-full">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    {{ number_format($jobsCount) }}+ open roles this week
                </span>

                <h1 class="font-display text-4xl md:text-5xl font-extrabold leading-[1.08] tracking-tight text-ink mt-5">
                    Find the Right Job,<br>
                    <span class="text-brand">Build Your Future</span>
                </h1>
                <p class="mt-4 text-slate2 max-w-md text-sm md:text-base leading-relaxed">
                    Explore thousands of opportunities from vetted employers and take the next step in your career journey.
                </p>
            </div>

            {{-- search bar --}}
            <form action="{{ route('employee.jobs.index') }}#jobs-list" method="GET"
                  class="mt-9 bg-white rounded-2xl shadow-card ring-1 ring-black/[0.03] p-2 flex flex-col md:flex-row gap-1 max-w-3xl">
                <label class="flex items-center gap-2.5 px-4 py-3 flex-1 border-b md:border-b-0 md:border-r border-line">
                    <svg class="w-4 h-4 text-slate2 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input type="text" name="q" value="{{ $filters['q'] ?? '' }}" placeholder="Job title, keywords or company"
                           class="w-full text-sm text-ink outline-none placeholder:text-slate2/70">
                </label>
                <label class="flex items-center gap-2.5 px-4 py-3 flex-1 border-b md:border-b-0 md:border-r border-line">
                    <svg class="w-4 h-4 text-slate2 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <input type="text" name="location" value="{{ $filters['location'] ?? '' }}" placeholder="Location"
                           class="w-full text-sm text-ink outline-none placeholder:text-slate2/70">
                </label>
                <label class="flex items-center gap-2.5 px-4 py-3">
                    <svg class="w-4 h-4 text-slate2 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7"/></svg>
                    <select name="category" class="text-sm text-ink outline-none bg-transparent pr-2 min-w-[10rem] max-w-[12rem] truncate">
                        <option value="">All Categories</option>
                        @foreach ([
                            'software-development'   => 'Software Development',
                            'web-development'        => 'Web Development',
                            'mobile-app-development' => 'Mobile App Development',
                            'ui-ux-design'            => 'UI/UX Design',
                            'qa-testing'              => 'QA & Testing',
                            'devops-cloud'            => 'DevOps & Cloud',
                            'data-science-analytics'  => 'Data Science & Analytics',
                            'ai-machine-learning'     => 'AI & Machine Learning',
                            'cybersecurity'           => 'Cybersecurity',
                            'database-administration' => 'Database Administration',
                            'network-system-administration' => 'Network & System Administration',
                            'it-support-help-desk'    => 'IT Support & Help Desk',
                            'product-management'      => 'Product Management',
                            'project-management'      => 'Project Management',
                            'business-analysis'       => 'Business Analysis',
                            'erp-crm'                 => 'ERP & CRM',
                            'blockchain-development'  => 'Blockchain Development',
                            'game-development'        => 'Game Development',
                            'embedded-systems-iot'    => 'Embedded Systems & IoT',
                            'technical-writing'       => 'Technical Writing',
                        ] as $value => $label)
                            <option value="{{ $value }}" @selected(($filters['category'] ?? '') === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                </label>
                {{-- keep employment_type / work_mode / sort selections alive when searching from the hero bar --}}
                <input type="hidden" name="employment_type" value="{{ $filters['employment_type'] ?? '' }}">
                <input type="hidden" name="work_mode" value="{{ $filters['work_mode'] ?? '' }}">
                <input type="hidden" name="sort" value="{{ $filters['sort'] ?? '' }}">
                <button type="submit"
                        class="bg-brand hover:bg-brand/90 focus-visible:ring-2 focus-visible:ring-brand focus-visible:ring-offset-2 transition-colors text-white text-sm font-semibold px-7 py-3 rounded-xl whitespace-nowrap">
                    Search Jobs
                </button>
            </form>

            {{-- popular searches --}}
            <div class="mt-5 flex flex-wrap items-center gap-2 text-xs">
                <span class="font-semibold text-ink/70 mr-1">Popular:</span>
                @foreach (['Web Developer','UI/UX Designer','Flutter Developer','Data Analyst','Product Manager'] as $tag)
                    <a href="{{ route('employee.jobs.index', ['q' => $tag]) }}"
                       class="px-3 py-1.5 rounded-full bg-white/80 hover:bg-white hover:text-brand hover:shadow-sm transition-all border border-line text-slate2 font-medium">{{ $tag }}</a>
                @endforeach
            </div>
        </div>

        {{-- signature hero graphic: an overlapping "job card stack" instead of a generic briefcase --}}
        <div class="hidden lg:block absolute right-12 top-16 w-64 select-none pointer-events-none">
            <div class="absolute inset-0 rotate-6 translate-x-6 translate-y-8 w-52 h-32 rounded-2xl bg-white/60 shadow-lg"></div>
            <div class="absolute inset-0 -rotate-3 translate-x-2 translate-y-3 w-56 h-32 rounded-2xl bg-white shadow-lg border border-line"></div>
            <div class="relative w-56 h-32 rounded-2xl bg-gradient-to-br from-brand to-brand2 shadow-xl p-4 flex flex-col justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 rounded-lg bg-white/20 flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7H4a1 1 0 00-1 1v10a1 1 0 001 1h16a1 1 0 001-1V8a1 1 0 00-1-1z"/><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V5a2 2 0 012-2h4a2 2 0 012 2v2"/></svg>
                    </div>
                    <div class="h-2 w-20 rounded-full bg-white/30"></div>
                </div>
                <div class="space-y-1.5">
                    <div class="h-2 w-32 rounded-full bg-white/40"></div>
                    <div class="h-2 w-20 rounded-full bg-white/25"></div>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= MAIN CONTENT ================= --}}
    <section class="max-w-7xl mx-auto px-6 -mt-12 relative z-10 pb-24">
        <div class="grid grid-cols-1 lg:grid-cols-[248px_1fr_300px] gap-6">

            {{-- ---------- FILTERS SIDEBAR ---------- --}}
            {{--
                This whole sidebar is now its own GET form that posts straight to the jobs
                index route. Every radio input has onchange="this.form.submit()" so picking
                "Full Time" or "Remote" instantly re-filters the list — no submit button needed.
                Hidden inputs carry over q/category/sort so those aren't lost on auto-submit.
            --}}
            <aside class="bg-white rounded-2xl shadow-card ring-1 ring-black/[0.03] p-5 h-fit lg:sticky lg:top-6">
                <form id="sidebar-filter-form" action="{{ route('employee.jobs.index') }}#jobs-list" method="GET">
                    {{-- preserve the other active filters when a radio auto-submits --}}
                    <input type="hidden" name="q" value="{{ $filters['q'] ?? '' }}">
                    <input type="hidden" name="category" value="{{ $filters['category'] ?? '' }}">
                    <input type="hidden" name="sort" value="{{ $filters['sort'] ?? '' }}">

                    <div class="flex items-center justify-between mb-5 pb-4 border-b border-line">
                        <h3 class="font-display font-bold text-sm text-ink flex items-center gap-2">
                            <svg class="w-4 h-4 text-brand" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4h18M6 9h12M10 14h4M11 19h2"/></svg>
                            Filters
                        </h3>
                        <a href="{{ route('employee.jobs.index') }}" class="text-xs text-brand font-semibold hover:underline">Clear all</a>
                    </div>

                    <div class="mb-6 pb-6 border-b border-line">
                        <h4 class="text-[11px] font-bold text-slate2 uppercase tracking-wider mb-3">Job Type</h4>
                        <div class="space-y-2.5 text-sm">
                            @foreach (['' => 'All Job Types', 'full-time' => 'Full Time', 'part-time' => 'Part Time', 'contract' => 'Contract', 'freelance' => 'Freelance'] as $value => $label)
                                <label class="group flex items-center gap-2.5 cursor-pointer">
                                    <span class="relative flex items-center justify-center w-4 h-4 shrink-0 rounded-full border-2 border-line group-hover:border-brand/60 peer-checked:border-brand transition-colors">
                                        <input type="radio" name="employment_type" value="{{ $value }}"
                                               @checked(($filters['employment_type'] ?? '') === $value)
                                               onchange="this.form.submit()"
                                               class="peer appearance-none absolute inset-0 w-full h-full cursor-pointer">
                                        <span class="w-2 h-2 rounded-full bg-brand scale-0 peer-checked:scale-100 transition-transform"></span>
                                    </span>
                                    <span class="text-ink/80 group-hover:text-ink transition-colors">{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-6 pb-6 border-b border-line">
                        <h4 class="text-[11px] font-bold text-slate2 uppercase tracking-wider mb-3">Work Mode</h4>
                        <div class="space-y-2.5 text-sm">
                            @foreach (['' => 'All Modes', 'onsite' => 'Onsite', 'hybrid' => 'Hybrid', 'remote' => 'Remote'] as $value => $label)
                                <label class="group flex items-center gap-2.5 cursor-pointer">
                                    <span class="relative flex items-center justify-center w-4 h-4 shrink-0 rounded-full border-2 border-line group-hover:border-brand/60 peer-checked:border-brand transition-colors">
                                        <input type="radio" name="work_mode" value="{{ $value }}"
                                               @checked(($filters['work_mode'] ?? '') === $value)
                                               onchange="this.form.submit()"
                                               class="peer appearance-none absolute inset-0 w-full h-full cursor-pointer">
                                        <span class="w-2 h-2 rounded-full bg-brand scale-0 peer-checked:scale-100 transition-transform"></span>
                                    </span>
                                    <span class="text-ink/80 group-hover:text-ink transition-colors">{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <h4 class="text-[11px] font-bold text-slate2 uppercase tracking-wider mb-3">Location</h4>
                        <div class="relative">
                            <svg class="w-3.5 h-3.5 text-slate2 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <input type="text" name="location" value="{{ $filters['location'] ?? '' }}" placeholder="Search location"
                                   class="w-full text-sm border border-line rounded-lg pl-9 pr-3 py-2.5 outline-none focus:border-brand focus:ring-1 focus:ring-brand/30 transition-colors">
                        </div>
                        <button type="submit"
                                class="mt-3 w-full bg-brand/10 text-brand text-xs font-semibold px-4 py-2.5 rounded-lg hover:bg-brand/15 transition-colors">
                            Apply Location
                        </button>
                    </div>
                </form>
            </aside>

            {{-- ---------- JOB LIST ---------- --}}
            {{-- id="jobs-list" is the scroll target for the filter forms (they submit to
                 #jobs-list) so picking a filter jumps straight to the results instead of
                 reloading back at the very top of the page. scroll-mt-24 keeps it clear
                 of the sticky navbar. --}}
            <div id="jobs-list" class="scroll-mt-24">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-5">
                    <div class="flex items-baseline gap-2">
                        <h2 class="font-display font-bold text-xl text-ink">Jobs for you</h2>
                        <span class="text-xs text-slate2">{{ number_format($jobsCount) }} {{ Str::plural('job', $jobsCount) }} found</span>
                    </div>

                    <label class="text-xs text-slate2 flex items-center gap-2 bg-white border border-line rounded-lg px-3 py-2">
                        Sort by
                        <select name="sort" onchange="window.location = this.value + '#jobs-list'"
                                class="text-ink font-semibold outline-none bg-transparent">
                            <option value="{{ request()->fullUrlWithQuery(['sort' => 'relevant']) }}"
                                    @selected(($filters['sort'] ?? 'relevant') === 'relevant')>Most Relevant</option>
                            <option value="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}"
                                    @selected(($filters['sort'] ?? '') === 'newest')>Newest</option>
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

                            // deterministic pastel color for the company avatar, based on the company name
                            $palette = ['bg-blue-50 text-blue-600', 'bg-orange-50 text-orange-600', 'bg-violet-50 text-violet-600', 'bg-emerald-50 text-emerald-600', 'bg-rose-50 text-rose-600'];
                            $avatarClass = $palette[crc32($companyName) % count($palette)];
                        @endphp
                        <article class="job-card group relative bg-white rounded-2xl shadow-card hover:shadow-cardHover transition-all duration-200 p-4 sm:p-5 flex gap-4 items-start overflow-hidden ring-1 ring-transparent hover:ring-brand/10">
                            {{-- accent bar, reveals on hover --}}
                            <span class="absolute left-0 top-0 h-full w-1 bg-brand scale-y-0 group-hover:scale-y-100 origin-top transition-transform duration-200"></span>

                            <div class="w-11 h-11 rounded-xl {{ $avatarClass }} flex items-center justify-center shrink-0">
                                <span class="font-display font-bold text-lg">{{ strtoupper(substr($companyName, 0, 1)) }}</span>
                            </div>

                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-3">
                                    <div class="min-w-0">
                                        <a href="{{ route('employee.jobs.show', $job->id) }}" class="font-display font-bold text-sm sm:text-base text-ink hover:text-brand transition-colors">
                                            {{ $job->title }}
                                        </a>
                                        <p class="text-xs text-slate2 mt-1 flex flex-wrap items-center gap-x-1.5">
                                            <span class="font-medium text-ink/70">{{ $companyName }}</span>
                                            <span>&middot;</span>
                                            <span>{{ $location }}</span>
                                            @if ($employmentType) <span>&middot;</span><span>{{ $employmentType }}</span> @endif
                                            @if ($job->experience) <span>&middot;</span><span>{{ $job->experience }}</span> @endif
                                        </p>
                                    </div>
                                    <div class="text-right shrink-0">
                                        <p class="font-display font-bold text-mint text-sm">{{ $job->salary ?: 'Not disclosed' }}</p>
                                        <p class="text-[11px] text-slate2 mt-1">{{ $job->created_at?->diffForHumans() }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between mt-3.5">
                                    <div class="flex flex-wrap gap-1.5">
                                        @if ($job->work_mode)
                                            <span class="text-[11px] font-medium px-2.5 py-1 rounded-full bg-brand/5 text-brand border border-brand/10 capitalize">{{ $job->work_mode }}</span>
                                        @endif
                                        @foreach (array_slice($skills, 0, 4) as $tag)
                                            <span class="text-[11px] font-medium px-2.5 py-1 rounded-full bg-surface text-slate2 border border-line">{{ $tag }}</span>
                                        @endforeach
                                    </div>
                                    <form action="" method="POST" class="shrink-0 ml-2">
                                        @csrf
                                        <button type="submit" aria-label="Save job"
                                                class="w-8 h-8 flex items-center justify-center rounded-lg text-slate2 hover:text-brand hover:bg-brand/5 focus-visible:ring-2 focus-visible:ring-brand transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-4-7 4V5z"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="bg-white rounded-2xl shadow-card p-14 text-center">
                            <div class="w-12 h-12 rounded-full bg-surface flex items-center justify-center mx-auto mb-4">
                                <svg class="w-5 h-5 text-slate2" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </div>
                            <p class="font-display font-bold text-sm text-ink">No jobs found</p>
                            <p class="text-xs text-slate2 mt-1">Try adjusting your search or filters.</p>
                        </div>
                    @endforelse
                </div>

                {{-- pagination --}}
                <div class="mt-8">
                    {{ $jobs->onEachSide(1)->links() }}
                </div>
            </div>

            {{-- ---------- RIGHT SIDEBAR ---------- --}}
            <aside class="space-y-5 h-fit lg:sticky lg:top-6">
                {{-- boost profile --}}
                <div class="bg-gradient-to-br from-brand to-brand2 rounded-2xl p-5 text-white relative overflow-hidden">
                    <svg class="w-8 h-8 mb-3 relative z-10" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    <h4 class="font-display font-bold text-sm relative z-10">Boost Your Profile</h4>
                    <p class="text-xs text-white/85 mt-1.5 relative z-10 leading-relaxed">Add your skills and get personalized job recommendations.</p>
                    <a href=""
                       class="inline-block mt-4 bg-white text-brand text-xs font-semibold px-4 py-2.5 rounded-lg relative z-10 hover:bg-white/90 transition-colors">
                        Create Profile
                    </a>
                    <div class="absolute -right-6 -bottom-8 w-28 h-28 rounded-full bg-white/10"></div>
                    <div class="absolute right-8 -top-6 w-16 h-16 rounded-full bg-white/10"></div>
                </div>

                {{-- top companies --}}
                <div class="bg-white rounded-2xl shadow-card ring-1 ring-black/[0.03] p-5">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="font-display font-bold text-sm text-ink">Top Companies Hiring</h4>
                    </div>
                    <div class="space-y-1">
                        @forelse ($topCompanies as $company)
                            <a href="" class="flex items-center justify-between text-sm -mx-2 px-2 py-2 rounded-lg hover:bg-surface transition-colors">
                                <div class="flex items-center gap-2.5 min-w-0">
                                    <span class="w-8 h-8 rounded-lg bg-surface border border-line flex items-center justify-center text-[11px] font-bold text-brand shrink-0">
                                        {{ strtoupper(substr($company['name'], 0, 1)) }}
                                    </span>
                                    <span class="text-ink/85 font-medium truncate">{{ $company['name'] }}</span>
                                </div>
                                <span class="text-xs text-slate2 shrink-0 ml-2">{{ $company['openings'] }} {{ Str::plural('opening', $company['openings']) }}</span>
                            </a>
                        @empty
                            <p class="text-xs text-slate2">No active listings yet.</p>
                        @endforelse
                    </div>
                </div>

                {{-- work from anywhere --}}
                <div class="bg-white rounded-2xl shadow-card ring-1 ring-black/[0.03] p-5">
                    <h4 class="font-display font-bold text-sm text-ink">Work From Anywhere</h4>
                    <p class="text-xs text-slate2 mt-1.5 leading-relaxed">Explore remote jobs from top companies hiring globally.</p>
                    <div class="w-full h-24 rounded-xl bg-gradient-to-br from-surface to-brand2/10 mt-3.5 flex items-center justify-center">
                        <svg class="w-10 h-10 text-brand/70" fill="none" stroke="currentColor" stroke-width="1.4" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.6 9h16.8M3.6 15h16.8M11.5 3a17 17 0 000 18M12.5 3a17 17 0 010 18"/><circle cx="12" cy="12" r="9"/></svg>
                    </div>
                    <a href="{{ route('employee.jobs.index', ['work_mode' => 'remote']) }}" class="inline-flex items-center gap-1 mt-3.5 text-xs font-semibold text-brand hover:underline">
                        Explore remote jobs
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>

                {{-- job alerts --}}
                <div class="bg-white rounded-2xl shadow-card ring-1 ring-black/[0.03] p-5">
                    <h4 class="font-display font-bold text-sm text-ink">Get Job Alerts</h4>
                    <p class="text-xs text-slate2 mt-1.5 leading-relaxed">Subscribe and never miss an opportunity that matches your profile.</p>
                    <form action="" method="POST" class="mt-3.5 flex flex-col gap-2">
                        @csrf
                        <input type="email" name="email" placeholder="Enter your email" required
                               class="w-full text-xs border border-line rounded-lg px-3 py-2.5 outline-none focus:border-brand focus:ring-1 focus:ring-brand/30 transition-colors">
                        <button type="submit" class="bg-brand text-white text-xs font-semibold px-4 py-2.5 rounded-lg hover:bg-brand/90 focus-visible:ring-2 focus-visible:ring-brand focus-visible:ring-offset-2 transition-colors">
                            Subscribe
                        </button>
                    </form>
                </div>
            </aside>
        </div>
    </section>

@endsection
@extends('layouts.app')

@section('content')

@include('employees.jobs._styles')
@include('employees.jobs._scripts')

    <section class="max-w-5xl mx-auto px-6 pt-10 pb-24">

        <div class="flex items-center justify-between mb-6">
            <div>
                <a href="{{ route('employee.jobs.index') }}#jobs-list" class="text-xs font-semibold text-brand hover:underline inline-flex items-center gap-1 mb-2">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                    Back to all jobs
                </a>
                <h1 class="font-display font-bold text-2xl text-ink">Saved Jobs</h1>
                <p class="text-sm text-slate2 mt-1">{{ $jobs->total() }} {{ Str::plural('job', $jobs->total()) }} saved</p>
            </div>
            <a href="{{ route('employee.jobs.applied') }}"
               class="inline-flex items-center gap-2 bg-white border border-line rounded-xl px-4 py-2.5 text-sm font-semibold text-ink hover:border-brand/40 hover:text-brand transition-colors shadow-card">
                View Applied Jobs
            </a>
        </div>

        <div class="space-y-3">
            @forelse ($jobs as $job)
                @php
                    $companyName = $job->employer->company_name ?? $job->employer->name ?? 'Company';
                    $location = collect([$job->city, $job->state, $job->country])->filter()->implode(', ') ?: 'Location not specified';
                    $employmentType = $job->employment_type ? ucfirst(str_replace('-', ' ', $job->employment_type)) : null;
                    $palette = ['bg-blue-50 text-blue-600', 'bg-orange-50 text-orange-600', 'bg-violet-50 text-violet-600', 'bg-emerald-50 text-emerald-600', 'bg-rose-50 text-rose-600'];
                    $avatarClass = $palette[crc32($companyName) % count($palette)];
                    $hasApplied = in_array($job->id, $appliedJobIds ?? []);
                @endphp

                <article class="bg-white rounded-2xl shadow-card ring-1 ring-black/[0.03] p-4 sm:p-5 flex gap-4 items-start">
                    <div class="w-11 h-11 rounded-xl {{ $avatarClass }} flex items-center justify-center shrink-0">
                        <span class="font-display font-bold text-lg">{{ strtoupper(substr($companyName, 0, 1)) }}</span>
                    </div>

                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between gap-3">
                            <div class="min-w-0">
                                <a href="{{ route('employee.jobs.show', $job->id) }}"
                                   class="font-display font-bold text-sm sm:text-base text-ink hover:text-brand transition-colors">
                                    {{ $job->title }}
                                </a>
                                <p class="text-xs text-slate2 mt-1 flex flex-wrap items-center gap-x-1.5">
                                    <span class="font-medium text-ink/70">{{ $companyName }}</span>
                                    <span>&middot;</span><span>{{ $location }}</span>
                                    @if ($employmentType) <span>&middot;</span><span>{{ $employmentType }}</span> @endif
                                </p>
                            </div>
                            <p class="font-display font-bold text-mint text-sm shrink-0">{{ $job->salary ?: 'Not disclosed' }}</p>
                        </div>

                        <div class="flex items-center justify-between mt-3.5">
                            <div class="flex flex-wrap gap-1.5">
                                @if ($job->work_mode)
                                    <span class="text-[11px] font-medium px-2.5 py-1 rounded-full bg-brand/5 text-brand border border-brand/10 capitalize">{{ $job->work_mode }}</span>
                                @endif
                                @if ($hasApplied)
                                    <span class="text-[11px] font-semibold px-2.5 py-1 rounded-full bg-mint/10 text-mint border border-mint/20">Applied</span>
                                @endif
                            </div>

                            <div class="flex items-center gap-2">
                                <a href="{{ route('employee.jobs.show', $job->id) }}"
                                   class="text-xs font-semibold text-brand hover:underline">View details</a>

                                <form action="{{ route('employee.jobs.save', $job->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" aria-label="Unsave job"
                                            class="w-8 h-8 flex items-center justify-center rounded-lg text-brand bg-brand/10 hover:bg-brand/20 transition-colors focus-visible:ring-2 focus-visible:ring-brand">
                                        <svg class="w-4 h-4" fill="currentColor" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-4-7 4V5z"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </article>
            @empty
                <div class="bg-white rounded-2xl shadow-card p-14 text-center">
                    <div class="w-12 h-12 rounded-full bg-surface flex items-center justify-center mx-auto mb-4">
                        <svg class="w-5 h-5 text-slate2" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-4-7 4V5z"/></svg>
                    </div>
                    <p class="font-display font-bold text-sm text-ink">No saved jobs yet</p>
                    <p class="text-xs text-slate2 mt-1">Jobs you save will show up here.</p>
                    <a href="{{ route('employee.jobs.index') }}#jobs-list" class="inline-block mt-4 bg-brand text-white text-xs font-semibold px-5 py-2.5 rounded-lg hover:bg-brand/90 transition-colors">Browse jobs</a>
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $jobs->onEachSide(1)->links() }}
        </div>
    </section>

@endsection
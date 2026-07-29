@extends('layouts.app')

@section('content')

@include('employees.jobs._styles')
@include('employees.jobs._scripts')

<section class="max-w-5xl mx-auto px-6 py-10">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="font-display font-bold text-2xl text-ink">Interviews</h1>
            <p class="text-sm text-slate2 mt-1">Upcoming and past interview schedules.</p>
        </div>
        <a href="{{ route('employee.jobs.index') }}#jobs-list" class="text-xs font-semibold text-brand hover:underline">
            &larr; Back to all jobs
        </a>
    </div>

    <div class="space-y-3">
        @forelse ($jobs as $job)
            @php
                $companyName = $job->employer->company_name ?? $job->employer->name ?? 'Company';
                $location = collect([$job->city, $job->state, $job->country])->filter()->implode(', ') ?: 'Location not specified';
                $application = $applicationsByJob->get($job->id);
                $interview = $application?->interview;
            @endphp

            <article class="job-card bg-white rounded-2xl shadow-card p-4 sm:p-5 flex gap-4 items-start">
                <div class="w-11 h-11 rounded-xl bg-brand/10 text-brand flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>

                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between gap-3">
                        <div class="min-w-0">
                            <a href="{{ route('employee.jobs.show', $job->id) }}"
                                class="font-display font-bold text-sm sm:text-base text-ink hover:text-brand transition-colors">
                                {{ $job->title }}
                            </a>
                            <p class="text-xs text-slate2 mt-1">
                                <span class="font-medium text-ink/70">{{ $companyName }}</span>
                                &middot; {{ $location }}
                            </p>
                        </div>

                        @if ($interview)
                            <span class="text-[11px] font-semibold px-2.5 py-1 rounded-full bg-brand/10 text-brand capitalize whitespace-nowrap">
                                {{ $interview->status }}
                            </span>
                        @endif
                    </div>

                    @if ($interview)
                        <div class="mt-3.5 flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-ink/80">
                            <span class="flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-slate2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ $interview->scheduled_at->format('D, M j, Y g:i A') }}
                            </span>
                            <span class="capitalize">{{ str_replace('_', ' ', $interview->mode) }}</span>
                            @if ($interview->location)
                                <span class="truncate max-w-[220px]">{{ $interview->location }}</span>
                            @endif
                        </div>
                    @else
                        <p class="text-xs text-slate2 mt-3">Interview details pending from the employer.</p>
                    @endif
                </div>
            </article>
        @empty
            <div class="bg-white rounded-2xl shadow-card p-14 text-center">
                <p class="font-display font-bold text-sm text-ink">No interviews scheduled</p>
                <p class="text-xs text-slate2 mt-1">When an employer schedules an interview, it'll appear here.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $jobs->onEachSide(1)->links() }}
    </div>
</section>

@endsection
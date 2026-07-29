@extends('layouts.app')

@section('content')

@include('employees.jobs._styles')
@include('employees.jobs._scripts')

<section class="max-w-5xl mx-auto px-6 py-10">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="font-display font-bold text-2xl text-ink">Hired</h1>
            <p class="text-sm text-slate2 mt-1">Congratulations — these are jobs you've been hired for.</p>
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
            @endphp

            <article class="job-card bg-white rounded-2xl shadow-card p-4 sm:p-5 flex gap-4 items-start">
                <div class="w-11 h-11 rounded-xl bg-mint/10 text-mint flex items-center justify-center shrink-0">
                    <span class="font-display font-bold text-lg">{{ strtoupper(substr($companyName, 0, 1)) }}</span>
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
                        <span class="text-[11px] font-semibold px-2.5 py-1 rounded-full bg-mint/10 text-mint inline-flex items-center gap-1 whitespace-nowrap">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            Hired
                        </span>
                    </div>
                </div>
            </article>
        @empty
            <div class="bg-white rounded-2xl shadow-card p-14 text-center">
                <p class="font-display font-bold text-sm text-ink">No offers yet</p>
                <p class="text-xs text-slate2 mt-1">Keep applying — your next offer could be right around the corner.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $jobs->onEachSide(1)->links() }}
    </div>
</section>

@endsection
@extends('layouts.app')

@section('content')

@include('employees.jobs._styles')
@include('employees.jobs._scripts')

<section class="max-w-5xl mx-auto px-6 py-10">
    <div class="flex items-center justify-between mb-6">
        <div>
            <a href="{{ route('employee.jobs.index') }}" class="text-xs text-slate2 hover:text-brand">&larr; Back to Jobs</a>
            <h1 class="font-display font-bold text-2xl text-ink mt-1">My Proposals</h1>
            <p class="text-sm text-slate2 mt-1">Track the contract projects you've applied to and their status.</p>
        </div>
    </div>

    <div class="space-y-3">
        @forelse ($proposals as $proposal)
            @php
                $project = $proposal->project;
                $companyName = $project?->employer?->company_name
                    ?? $project?->employer?->name
                    ?? 'Company';

                $statusStyles = match ($proposal->status) {
                    'accepted'    => 'bg-mint/10 text-mint border-mint/20',
                    'rejected'    => 'bg-rose-50 text-rose-600 border-rose-200',
                    'shortlisted' => 'bg-brand/10 text-brand border-brand/20',
                    'withdrawn'   => 'bg-slate-100 text-slate-500 border-slate-200',
                    default       => 'bg-amber-50 text-amber-600 border-amber-200',
                };
            @endphp

            <div class="bg-white rounded-2xl shadow-card ring-1 ring-black/[0.03] p-5">
                <div class="flex items-start justify-between gap-3 flex-wrap">
                    <div class="min-w-0">
                        <div class="flex items-center gap-2 flex-wrap">
                            <h3 class="font-display font-bold text-sm sm:text-base text-ink">
                                {{ $project->title ?? 'Project no longer available' }}
                            </h3>
                            <span class="text-[11px] font-bold uppercase tracking-wide px-2.5 py-0.5 rounded-full border {{ $statusStyles }}">
                                {{ ucfirst($proposal->status) }}
                            </span>
                        </div>
                        <p class="text-xs text-slate2 mt-1">{{ $companyName }}</p>
                    </div>
                    <p class="text-[11px] text-slate2 shrink-0">
                        Submitted {{ $proposal->created_at->diffForHumans() }}
                    </p>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 mt-4">
                    <div class="bg-surface rounded-xl px-4 py-2.5">
                        <p class="text-[10px] font-bold text-slate2 uppercase tracking-wide">Your Rate</p>
                        <p class="text-ink font-semibold text-sm mt-0.5">{{ $proposal->proposed_rate }}</p>
                    </div>
                    <div class="bg-surface rounded-xl px-4 py-2.5">
                        <p class="text-[10px] font-bold text-slate2 uppercase tracking-wide">Timeline</p>
                        <p class="text-ink font-semibold text-sm mt-0.5">{{ $proposal->estimated_timeline }}</p>
                    </div>
                </div>

                <div class="mt-3">
                    <p class="text-[10px] font-bold text-slate2 uppercase tracking-wide mb-1">Your Cover Note</p>
                    <p class="text-sm text-ink/80 leading-relaxed whitespace-pre-line">{{ $proposal->cover_note }}</p>
                </div>

                @if ($proposal->status === 'accepted')
                    <div class="mt-4 flex items-center gap-2 text-xs text-mint bg-mint/10 border border-mint/20 rounded-xl px-4 py-2.5">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        Congrats — the employer accepted your proposal. They'll be in touch to get started.
                    </div>
                @elseif ($proposal->status === 'rejected')
                    <div class="mt-4 flex items-center gap-2 text-xs text-rose-600 bg-rose-50 border border-rose-200 rounded-xl px-4 py-2.5">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        This proposal wasn't selected this time.
                    </div>
                @elseif ($proposal->status === 'shortlisted')
                    <div class="mt-4 flex items-center gap-2 text-xs text-brand bg-brand/10 border border-brand/20 rounded-xl px-4 py-2.5">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        You've been shortlisted — the employer is still reviewing proposals.
                    </div>
                @endif
            </div>
        @empty
            <div class="bg-white rounded-2xl shadow-card p-14 text-center">
                <div class="w-12 h-12 rounded-full bg-surface flex items-center justify-center mx-auto mb-4">
                    <svg class="w-5 h-5 text-slate2" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6M9 8h1M5 21h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                </div>
                <p class="font-display font-bold text-sm text-ink">No proposals yet</p>
                <p class="text-xs text-slate2 mt-1">Submit a proposal on a contract project to see it tracked here.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $proposals->links() }}
    </div>
</section>

@endsection
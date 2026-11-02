@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#F8FAFC] text-slate-800 font-['Inter'] py-8 px-4 sm:px-6 lg:px-8 flex justify-center">
    <div class="w-full max-w-5xl">

        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Work Report Analysis</h1>
            <p class="text-sm text-slate-500 mt-1 font-medium">
                How each freelancer is progressing against the contract schedule.
            </p>
        </div>

        {{-- Summary --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 mb-6">
            @foreach ([
                ['Active contracts', $summary['total'], 'text-slate-900'],
                ['On track', $summary['on_track'], 'text-emerald-600'],
                ['Need attention', $summary['attention'], $summary['attention'] ? 'text-red-600' : 'text-slate-900'],
                ['Avg. report submission', $summary['avg_rate'] === null ? '-' : $summary['avg_rate'] . '%', 'text-slate-900'],
            ] as [$label, $value, $color])
                <div class="bg-white border border-slate-200 rounded-xl p-4">
                    <p class="text-xs font-semibold text-slate-500">{{ $label }}</p>
                    <p class="text-2xl font-bold mt-1 {{ $color }}">{{ $value }}</p>
                </div>
            @endforeach
        </div>

        {{-- Filters --}}
        <div class="flex flex-wrap gap-2 mb-5 text-sm font-semibold">
            @foreach ([null => 'All', 'attention' => 'Need attention', 'on_track' => 'On track', 'completed' => 'Completed', 'not_started' => 'Not started'] as $key => $text)
                <a href="{{ route('employer.work-reports.index', $key ? ['status' => $key] : []) }}"
                   class="px-3.5 py-1.5 rounded-lg border {{ ($filter ?? null) === $key ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-slate-600 border-slate-200 hover:border-blue-300' }}">
                    {{ $text }}
                </a>
            @endforeach
        </div>

        @forelse ($rows as $row)
            @php
                $bid = $row['bid'];
                $a   = $row['a'];
                $title = $bid->project?->title ?? ('Project #' . $bid->project_id);
                $who   = $bid->freelancer?->user?->name ?? 'Freelancer';
            @endphp

            <a href="{{ route('employer.work-reports.show', $bid->id) }}"
               class="block bg-white border border-slate-200 rounded-2xl p-5 sm:p-6 mb-4 hover:border-blue-300 hover:shadow-md transition-shadow">
                <div class="flex items-start justify-between gap-3">
                    <div class="min-w-0">
                        <h2 class="text-lg font-bold text-slate-900 truncate">{{ $title }}</h2>
                        <p class="text-sm text-slate-500 mt-0.5">{{ $who }}</p>
                    </div>
                    @include('employers.freelance-bid.work-report.status', ['status' => $a['status'], 'label' => $a['status_label']])
                </div>

                {{-- Reported vs expected progress --}}
                <div class="mt-4">
                    <div class="flex justify-between text-xs font-semibold text-slate-500 mb-1.5">
                        <span>Reported {{ $a['latest'] }}%</span>
                        <span>Expected {{ $a['expected'] }}%</span>
                    </div>
                    <div class="relative bg-slate-200 rounded-full h-2">
                        <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $a['latest'] }}%"></div>
                        <div class="absolute -top-1 w-0.5 h-4 bg-slate-700 rounded" style="left: {{ $a['expected'] }}%" title="Expected progress"></div>
                    </div>
                </div>

                <div class="flex flex-wrap gap-x-6 gap-y-1 mt-4 text-xs font-semibold text-slate-500">
                    <span>{{ $a['submitted'] }} of {{ $a['submitted'] + $a['missed'] }} reports on past days</span>
                    <span class="{{ $a['missed'] ? 'text-red-600' : '' }}">{{ $a['missed'] }} missed</span>
                    <span>
                        Last report:
                        {{ $a['last_report'] ? $a['last_report']->report_date->format('M j') : 'none yet' }}
                    </span>
                    <span>{{ $a['start']->format('M j') }} to {{ $a['end']->format('M j, Y') }}</span>
                </div>

                @if (!empty($a['insights']) && $a['status'] !== 'not_started')
                    <p class="mt-3 text-sm text-slate-600">{{ $a['insights'][0]['text'] }}</p>
                @endif
            </a>
        @empty
            <div class="bg-white border border-slate-200 rounded-2xl p-10 text-center">
                <h2 class="text-lg font-bold text-slate-900 mb-1">No contracts to analyse</h2>
                <p class="text-sm text-slate-500">
                    Reports appear here once a freelancer returns the signed contract and starts work.
                </p>
            </div>
        @endforelse
    </div>
</div>
@endsection
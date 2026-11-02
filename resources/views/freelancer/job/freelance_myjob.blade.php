@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#F8FAFC] text-slate-800 font-['Inter'] py-8 px-4 sm:px-6 lg:px-8 flex justify-center">
    <div class="w-full max-w-5xl">

        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Signed Jobs</h1>
            <p class="text-sm text-slate-500 mt-1 font-medium">
                Select a job to open its work reports.
            </p>
        </div>

        @forelse ($signedJobs as $job)
            @php
                $total   = $job->estimatedWorkingDays();
                $done    = $job->work_reports_count;
                $percent = $total > 0 ? min(100, (int) round(($done / $total) * 100)) : 0;
                $title   = $job->project?->title ?? ('Project #' . $job->project_id);

                // Opens /freelancer/work-reports?bid=ID
                $reportsUrl = route('freelancer.work-reports.index', ['bid' => $job->id]);
            @endphp

            <a href="{{ $reportsUrl }}"
               class="block bg-white border border-slate-200 rounded-2xl p-5 sm:p-6 mb-4
                      shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:border-blue-300 hover:shadow-md transition-all">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">

                    <div class="min-w-0 flex-1">
                        <h2 class="text-lg font-bold text-slate-900 truncate">{{ $title }}</h2>
                        <p class="text-sm text-slate-500 mt-0.5">
                            {{ $job->project?->employer?->name ?? 'Employer' }}
                        </p>

                        <div class="flex flex-wrap gap-x-5 gap-y-1 mt-3 text-xs font-semibold text-slate-500">
                            <span>Signed: {{ $job->signed_contract_received_at?->format('M j, Y') ?? '-' }}</span>
                            <span>Started: {{ $job->work_started_at?->format('M j, Y') ?? '-' }}</span>
                            <span>{{ $total }} working days</span>
                        </div>

                        <div class="mt-4 max-w-sm">
                            <div class="flex justify-between text-[11px] font-semibold text-slate-500 mb-1">
                                <span>{{ $done }}/{{ $total }} reports submitted</span>
                                <span>{{ $percent }}%</span>
                            </div>
                            <div class="bg-slate-200 rounded-full h-1.5">
                                <div class="bg-blue-600 h-1.5 rounded-full" style="width: {{ $percent }}%"></div>
                            </div>
                        </div>
                    </div>

                    <span class="shrink-0 text-center bg-blue-600 text-white text-sm font-semibold px-5 py-2.5 rounded-lg shadow-md">
                        Open Work Reports →
                    </span>
                </div>
            </a>
        @empty
            <div class="bg-white border border-slate-200 rounded-2xl p-10 text-center shadow-sm">
                <h2 class="text-lg font-bold text-slate-900 mb-1">No signed jobs yet</h2>
                <p class="text-sm text-slate-500">Upload a signed contract on an accepted project and it will appear here.</p>
            </div>
        @endforelse

        <div class="mt-6">{{ $signedJobs->links() }}</div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('title', 'My Internship Applications')

@section('content')

<style>
    .sia-page { max-width: 820px; margin: 0 auto; padding: 30px 20px 60px; color: #172033; }
    .sia-page h1 { font-size: 22px; font-weight: 800; margin: 0 0 4px; }
    .sia-page > p { color: #64748b; font-size: 13px; margin: 0 0 20px; }

    .sia-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 14px; padding: 16px 18px; margin-bottom: 12px; display: flex; justify-content: space-between; align-items: center; gap: 14px; flex-wrap: wrap; }
    .sia-title { margin: 0 0 3px; font-size: 15px; font-weight: 800; }
    .sia-meta { margin: 0; color: #64748b; font-size: 12px; }

    .sia-status { display: inline-flex; align-items: center; gap: 5px; padding: 6px 12px; border-radius: 999px; font-size: 11px; font-weight: 800; }
    .sia-status-applied { background: #fef9c3; color: #854d0e; }
    .sia-status-selected { background: #ecfdf5; color: #047857; }
    .sia-status-rejected { background: #fef2f2; color: #b91c1c; }
    .sia-status-completed { background: #f5f3ff; color: #7c3aed; }

    .sia-empty { text-align: center; padding: 50px 20px; color: #64748b; background: #fff; border: 1px solid #e2e8f0; border-radius: 14px; }
</style>

<div class="sia-page">

    <h1>My Applications</h1>
    <p>Track the status of every internship you've applied to.</p>

    @if(session('success'))
        <div style="background:#ecfdf5;color:#047857;border:1px solid #d1fae5;padding:12px 16px;border-radius:10px;font-size:13px;font-weight:600;margin-bottom:16px;">
            {{ session('success') }}
        </div>
    @endif

    @forelse($applications as $application)

        @php
            $labelMap = [
                'applied' => ['Under Review', 'sia-status-applied'],
                'selected' => ['Selected', 'sia-status-selected'],
                'rejected' => ['Rejected', 'sia-status-rejected'],
                'completed' => ['Completed', 'sia-status-completed'],
            ];

            [$statusLabel, $statusClass] = $labelMap[$application->status] ?? ['Applied', 'sia-status-applied'];
        @endphp

        <div class="sia-card">
            <div>
                <h3 class="sia-title">{{ $application->internship->title ?? 'Internship' }}</h3>
                <p class="sia-meta">
                    {{ optional($application->internship->employer)->company_name ?? optional($application->internship->employer)->name ?? 'Company' }}
                    &middot;
                    Applied {{ optional($application->applied_at ?? $application->created_at)->format('d M Y') }}
                </p>
            </div>

            <span class="sia-status {{ $statusClass }}">{{ $statusLabel }}</span>
        </div>

    @empty

        <div class="sia-empty">
            <p>You haven't applied to any internships yet.</p>
        </div>

    @endforelse

    <div style="margin-top: 20px;">
        {{ $applications->links() }}
    </div>

</div>

@endsection

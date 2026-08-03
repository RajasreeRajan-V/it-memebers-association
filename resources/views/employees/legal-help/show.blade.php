@extends('layouts.app')

@section('content')
@push('styles')
<script src="https://cdn.tailwindcss.com"></script>
<style>
    .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    .modal-body-text { white-space: pre-line; }
</style>
@endpush

<div class="mx-auto max-w-6xl">

    <a href="{{ route('employee.legal-help.index') }}"
       class="inline-flex items-center gap-1.5 text-sm font-medium text-slate-500 hover:text-slate-800 transition-colors">
        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
        </svg>
        Back to Legal Help
    </a>

    <div class="mt-4 flex flex-col gap-3 border-b border-slate-200 pb-6 sm:flex-row sm:items-start sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight text-slate-900">Legal Help Request</h1>
            <p class="mt-1 text-sm text-slate-500">Track the status of your request and communicate with the legal team.</p>
        </div>

        @php
            $statusStyles = [
                'submitted'   => 'bg-blue-50 text-blue-700 ring-blue-200',
                'in_progress' => 'bg-amber-50 text-amber-700 ring-amber-200',
                'resolved'    => 'bg-green-50 text-green-700 ring-green-200',
                'closed'      => 'bg-slate-100 text-slate-600 ring-slate-200',
            ];
            $statusKey = strtolower(str_replace(' ', '_', $legalRequest->status ?? 'submitted'));
            $statusClass = $statusStyles[$statusKey] ?? 'bg-slate-100 text-slate-600 ring-slate-200';
        @endphp
        <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1.5 text-xs font-semibold ring-1 ring-inset {{ $statusClass }}">
            <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
            {{ ucfirst(str_replace('_', ' ', $legalRequest->status ?? 'Submitted')) }}
        </span>
    </div>

    @if(session('success'))
        <div class="mt-6 flex items-start gap-3 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            <svg class="mt-0.5 h-4 w-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-3">
        <div class="lg:col-span-1 rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            @include('employees.legal-help.partials.request-details', ['legalRequest' => $legalRequest])
        </div>

        <div class="lg:col-span-2 rounded-xl border border-slate-200 bg-white shadow-sm flex flex-col" style="min-height: 480px;">
            @include('employees.legal-help.partials.messages', ['legalRequest' => $legalRequest])
        </div>
    </div>

</div>
@endsection
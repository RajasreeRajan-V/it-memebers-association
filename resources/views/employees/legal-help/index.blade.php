@extends('layouts.app')

@section('content')
@push('styles')

<script src="https://cdn.tailwindcss.com"></script>
<style>
    .line-clamp-2{display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
    .modal-body-text{white-space:pre-line}

    /* ---- custom thin scrollbar for the messages box ---- */
    .messages-scroll-box{scrollbar-width:thin;scrollbar-color:#93c5fd transparent}
    .messages-scroll-box::-webkit-scrollbar{width:6px}
    .messages-scroll-box::-webkit-scrollbar-track{background:transparent}
    .messages-scroll-box::-webkit-scrollbar-thumb{background:#93c5fd;border-radius:9999px}
    .messages-scroll-box::-webkit-scrollbar-thumb:hover{background:#60a5fa}

    .card-hover{transition:box-shadow .2s ease, transform .2s ease}
    .card-hover:hover{box-shadow:0 8px 24px -8px rgba(15,23,42,.12);transform:translateY(-1px)}

    /* ---- stat card upgrade ---- */
    .stat-card{position:relative;overflow:hidden;transition:box-shadow .25s ease, transform .25s ease, border-color .25s ease}
    .stat-card:hover{transform:translateY(-2px);box-shadow:0 10px 28px -10px rgba(15,23,42,.15)}
    .stat-icon{transition:transform .25s ease}
    .stat-card:hover .stat-icon{transform:scale(1.08) rotate(-4deg)}

    /* ---- table upgrade ---- */
    .req-table thead th{position:sticky;top:0;background:#f8fafc}
    .req-table tbody tr{transition:background-color .15s ease}
    .req-row-id{position:relative}
    .req-row-id::before{content:"";position:absolute;left:-1.25rem;top:50%;transform:translateY(-50%);height:0;width:3px;border-radius:9999px;background:#2563eb;transition:height .2s ease}
    .req-table tbody tr:hover .req-row-id::before{height:60%}

    /* ---- how it works upgrade ---- */
    .hiw-step{position:relative}
    .hiw-step:not(:last-child)::after{
        content:"";position:absolute;left:15px;top:34px;bottom:-16px;width:2px;
        background:repeating-linear-gradient(to bottom,#bfdbfe 0,#bfdbfe 4px,transparent 4px,transparent 8px);
    }
    .hiw-num{position:relative;z-index:1}
</style>
@endpush
<div class="mx-auto w-full max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">

    {{-- ================= HERO ================= --}}
    <div class="relative overflow-hidden rounded-2xl bg-white">
        {{-- soft decorative light-blue blobs --}}
        <div class="pointer-events-none absolute -right-16 -top-10 h-72 w-72 rounded-full bg-blue-100/70 blur-2xl"></div>
        <div class="pointer-events-none absolute -left-20 top-1/3 h-56 w-56 rounded-full bg-sky-100/70 blur-2xl"></div>
        <div class="pointer-events-none absolute -bottom-16 right-1/4 h-64 w-64 rounded-full bg-blue-50 blur-2xl"></div>

        <div class="relative flex flex-col items-center gap-10 px-8 py-12 lg:flex-row lg:items-center">
            {{-- Left: copy, centered --}}
            <div class="flex w-full flex-col items-center text-center lg:w-1/2 lg:items-center">
                {{-- top pill badge --}}
                <span class="inline-flex items-center gap-1.5 rounded-full bg-blue-100/80 px-4 py-1.5 text-sm font-semibold text-blue-700">
                    ⚡ 500+ Verified Legal Experts
                </span>

                <h1 class="mt-4 text-3xl font-extrabold leading-tight text-slate-900 sm:text-4xl">
                    Legal Help & Workplace Support<br>
                    <span class="text-blue-600">When You Need It</span>
                </h1>
                <p class="mt-4 max-w-sm text-base text-slate-500">
                    Facing challenges at work? Connect with experienced professionals for legal advice, 
                    workplace guidance, and confidential support to resolve employment-related issues.
                </p>

             <div class="mt-6 flex items-center justify-center gap-3">
    <a href="#messages-section"
       class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-base font-semibold text-white hover:bg-blue-700 transition"
       onclick="event.preventDefault(); document.getElementById('messages-section').scrollIntoView({behavior: 'smooth', block: 'start'});">
        Get Legal Help
    </a>
</div>
            </div>

            {{-- Right: illustration with floating cards --}}
            <div class="relative flex w-full items-center justify-center lg:w-1/2">
                <div class="relative w-full max-w-md">
                    <img src="{{ asset('assets/img/legal.png') }}"
                         alt="Legal Help"
                         class="w-full object-cover block border-0 outline-none shadow-none rounded-none"
                         style="border:0;box-shadow:none;">

                    {{-- floating card: top left --}}
                    <div class="absolute -top-4 left-2 flex items-center gap-2 rounded-xl bg-white px-4 py-2.5 shadow-md sm:-left-6">
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-100 text-blue-600">📄</span>
                        <span class="text-sm font-semibold text-slate-800">Case Files</span>
                    </div>

                    {{-- floating card: bottom left --}}
                    <div class="absolute -bottom-4 left-2 flex items-center gap-2 rounded-xl bg-white px-4 py-2.5 shadow-md sm:-left-6">
                        <span class="flex h-8 w-8 items-center justify-center rounded-full bg-green-100 text-green-600">✔️</span>
                        <span class="text-sm font-semibold text-slate-800">Talk to a Lawyer</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= MY LEGAL REQUESTS ================= --}}
    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

        {{-- header --}}
        <div class="flex flex-col gap-3 border-b border-slate-100 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-center gap-3">
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-600/10 text-lg text-blue-600">📋</span>
                <div>
                    <h2 class="text-base font-semibold text-slate-800">My Workplace Support Requests</h2>
                    <p class="text-xs text-slate-400">Track and manage all the Workplace Support  you've requested</p>
                </div>
            </div>
            <a href="{{ route('employee.legal-help.create') }}"
               class="inline-flex items-center justify-center gap-1.5 rounded-lg bg-blue-600 px-4 py-2.5 text-xs font-semibold text-white shadow-sm shadow-blue-600/20 hover:bg-blue-700 hover:shadow-md transition">
                <span class="text-sm leading-none">+</span> Workplace Support
            </a>
        </div>

        {{-- stat cards --}}
        <div class="grid grid-cols-2 gap-4 px-6 py-6 sm:grid-cols-4">
            <div class="stat-card rounded-xl border border-slate-100 bg-gradient-to-br from-blue-50/80 to-white px-4 py-4">
                <div class="flex items-center gap-3">
                    <span class="stat-icon flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-100 text-lg text-blue-600">📁</span>
                    <div>
                        <p class="text-xl font-bold text-slate-800">{{ str_pad($stats['total'], 2, '0', STR_PAD_LEFT) }}</p>
                        <p class="text-xs font-medium text-slate-500">Total Requests</p>
                    </div>
                </div>
            </div>
            <div class="stat-card rounded-xl border border-slate-100 bg-gradient-to-br from-orange-50/80 to-white px-4 py-4">
                <div class="flex items-center gap-3">
                    <span class="stat-icon flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-orange-100 text-lg text-orange-600">⏱️</span>
                    <div>
                        <p class="text-xl font-bold text-slate-800">{{ str_pad($stats['under_review'], 2, '0', STR_PAD_LEFT) }}</p>
                        <p class="text-xs font-medium text-slate-500">Under Review</p>
                    </div>
                </div>
            </div>
            <div class="stat-card rounded-xl border border-slate-100 bg-gradient-to-br from-green-50/80 to-white px-4 py-4">
                <div class="flex items-center gap-3">
                    <span class="stat-icon flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-green-100 text-lg text-green-600">✅</span>
                    <div>
                        <p class="text-xl font-bold text-slate-800">{{ str_pad($stats['resolved'], 2, '0', STR_PAD_LEFT) }}</p>
                        <p class="text-xs font-medium text-slate-500">Resolved</p>
                    </div>
                </div>
            </div>
            <div class="stat-card rounded-xl border border-slate-100 bg-gradient-to-br from-slate-100/80 to-white px-4 py-4">
                <div class="flex items-center gap-3">
                    <span class="stat-icon flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-slate-200 text-lg text-slate-500">📦</span>
                    <div>
                        <p class="text-xl font-bold text-slate-800">{{ str_pad($stats['closed'], 2, '0', STR_PAD_LEFT) }}</p>
                        <p class="text-xs font-medium text-slate-500">Closed</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- table --}}
        <div class="overflow-x-auto px-6 pb-2">
            <table class="req-table min-w-full text-left text-sm">
                <thead>
                    <tr class="border-b border-slate-100 text-xs uppercase tracking-wide text-slate-400">
                        <th class="py-3 pl-5 pr-4">Request ID</th>
                        <th class="py-3 pr-4">Issue Title</th>
                        <th class="py-3 pr-4">Category</th>
                        <th class="py-3 pr-4">Priority</th>
                        <th class="py-3 pr-4">Status</th>
                        <th class="py-3 pr-4">Last Updated</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @forelse($legalRequests as $legalRequest)
                        <tr class="border-b border-slate-50 hover:bg-blue-50/30">
                            <td class="req-row-id py-4 pl-5 pr-4 font-semibold text-blue-600">
                                <a href="{{ route('employee.legal-help.show', $legalRequest) }}" class="hover:underline">
                                    {{ $legalRequest->request_number }}
                                </a>
                            </td>
                            <td class="py-4 pr-4 text-slate-700">
                                <span class="line-clamp-2 max-w-xs">{{ $legalRequest->issue_title }}</span>
                            </td>
                            <td class="py-4 pr-4">
                                <span class="inline-flex items-center rounded-md bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-600">
                                    {{ $legalRequest->category }}
                                </span>
                            </td>
                            <td class="py-4 pr-4">
                                @php
                                    $priorityClasses = [
                                        'red'    => 'bg-red-50 text-red-600 ring-1 ring-inset ring-red-100',
                                        'orange' => 'bg-orange-50 text-orange-600 ring-1 ring-inset ring-orange-100',
                                        'green'  => 'bg-green-50 text-green-600 ring-1 ring-inset ring-green-100',
                                    ];
                                @endphp
                                <span class="rounded-full px-2.5 py-1 text-xs font-medium {{ $priorityClasses[$legalRequest->priority_color] ?? 'bg-slate-100 text-slate-600' }}">
                                    {{ $legalRequest->priority_label }}
                                </span>
                            </td>
                            <td class="py-4 pr-4">
                                @php
                                    $statusClasses = [
                                        'gray'   => 'bg-slate-100 text-slate-600 ring-1 ring-inset ring-slate-200',
                                        'orange' => 'bg-orange-50 text-orange-600 ring-1 ring-inset ring-orange-100',
                                        'blue'   => 'bg-blue-50 text-blue-600 ring-1 ring-inset ring-blue-100',
                                        'green'  => 'bg-green-50 text-green-600 ring-1 ring-inset ring-green-100',
                                    ];
                                @endphp
                                <span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs font-medium {{ $statusClasses[$legalRequest->status_color] ?? 'bg-slate-100 text-slate-600' }}">
                                    <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                    {{ $legalRequest->status_label }}
                                </span>
                            </td>
                            <td class="py-4 pr-4 text-slate-500">{{ $legalRequest->updated_at->format('d M Y') }}</td>
                            <td class="py-4 pr-4 text-right">
                                
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-14 text-center">
                                <div class="mx-auto flex max-w-xs flex-col items-center gap-2">
                                    <span class="flex h-12 w-12 items-center justify-center rounded-full bg-blue-50 text-2xl">📭</span>
                                    <p class="text-sm text-slate-400">You haven't raised any legal requests yet.</p>
                                    <a href="{{ route('employee.legal-help.create') }}" class="text-sm font-semibold text-blue-600 hover:underline">Create one now</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($legalRequests->hasPages())
            <div class="border-t border-slate-100 px-6 py-3">
                {{ $legalRequests->links() }}
            </div>
        @endif
    </div>

    {{-- ================= REQUEST DETAILS + MESSAGES + HOW IT WORKS ================= --}}
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3 lg:items-stretch">

        {{-- Request details / timeline --}}
        <div class="lg:col-span-1 flex flex-col rounded-2xl border border-slate-200 bg-white shadow-sm p-6">
            <div class="mb-5 flex items-center justify-between border-b border-slate-100 pb-4">
                <div class="flex items-center gap-2.5">
                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-gradient-to-br from-blue-100 to-blue-50 text-blue-600 shadow-sm">🗂️</span>
                    <div>
                        <h3 class="text-sm font-semibold text-slate-800">Workplace Tracking Details</h3>
                        @if($selectedRequest)
                            <p class="text-xs text-slate-400">{{ $selectedRequest->request_number }}</p>
                        @endif
                    </div>
                </div>
                @if($selectedRequest)
                    @php
                        $statusClasses = [
                            'gray'   => 'bg-slate-100 text-slate-600 ring-1 ring-inset ring-slate-200',
                            'orange' => 'bg-orange-50 text-orange-600 ring-1 ring-inset ring-orange-100',
                            'blue'   => 'bg-blue-50 text-blue-600 ring-1 ring-inset ring-blue-100',
                            'green'  => 'bg-green-50 text-green-600 ring-1 ring-inset ring-green-100',
                        ];
                    @endphp
                    <span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs font-medium {{ $statusClasses[$selectedRequest->status_color] ?? 'bg-slate-100 text-slate-600' }}">
                        <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                        {{ $selectedRequest->status_label }}
                    </span>
                @endif
            </div>
            @if($selectedRequest)
                <div class="[&_h4]:text-slate-800 [&_p]:text-slate-500 [&_.text-gray-500]:text-slate-400">
                    @include('employees.legal-help.partials.request-details', ['legalRequest' => $selectedRequest])
                </div>
            @else
                <div class="flex flex-1 flex-col items-center justify-center gap-2 py-6">
                    <span class="flex h-12 w-12 items-center justify-center rounded-full bg-blue-50 text-2xl">🗂️</span>
                    <p class="text-sm text-slate-400 text-center">Select a request above to see its details and timeline.</p>
                </div>
            @endif
        </div>

{{-- Messages: exact square box, internal scroll only, light blue background --}}
<div id="messages-section" class="lg:col-span-1 flex flex-col self-start rounded-2xl border border-blue-100 bg-blue-50 shadow-sm p-6">
    <div class="mb-4 flex items-center gap-2">
        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-white text-green-600 shadow-sm">💬</span>
        <h3 class="text-sm font-semibold text-slate-800">Legal Requests</h3>
    </div>

    <div class="aspect-square w-full min-h-0 rounded-xl bg-white/60 p-3 overflow-hidden flex flex-col">
        @if($selectedRequest)
            @include('employees.legal-help.partials.messages', ['legalRequest' => $selectedRequest])
        @else
            <div class="flex h-full items-center justify-center">
                <p class="text-sm text-slate-400">No conversation yet.</p>
            </div>
        @endif
    </div>
</div>

        {{-- How it works + quick help sidebar (redesigned) --}}
        <div class="lg:col-span-1 space-y-6">
            <div class="card-hover relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-600 to-blue-500 shadow-sm p-6 text-white">
                <div class="pointer-events-none absolute -right-6 -top-6 h-28 w-28 rounded-full bg-white/10"></div>
                <div class="pointer-events-none absolute -bottom-8 -left-4 h-24 w-24 rounded-full bg-white/10"></div>
                <span class="relative flex h-10 w-10 items-center justify-center rounded-lg bg-white/20 text-lg backdrop-blur-sm">📞</span>
                <h3 class="relative mt-3 text-sm font-semibold">Need Immediate Legal Assistance?</h3>
                <p class="relative mt-1 text-xs text-blue-50">Talk to our legal experts now.</p>
                <a href="{{ route('employee.legal-help.create') }}"
                   class="relative mt-4 inline-flex w-full items-center justify-center rounded-lg bg-white px-4 py-2.5 text-sm font-semibold text-blue-600 shadow-sm hover:bg-blue-50 hover:shadow transition">
                    Talk to a Lawyer
                </a>
            </div>

           <div class="card-hover rounded-2xl border border-slate-200 bg-white shadow-sm p-6">
    <div class="mb-2 flex items-center gap-2">
        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-blue-600">🧭</span>
        <h3 class="text-sm font-semibold text-slate-800">How It Works</h3>
    </div>

    <ol class="mt-4 space-y-5">

        <li class="hiw-step flex gap-3">
            <span class="hiw-num flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-blue-600 text-xs font-semibold text-white shadow-sm shadow-blue-600/30">1</span>
            <div>
                <p class="text-sm font-medium text-slate-700">Submit Support Request</p>
                <p class="text-xs text-slate-500">Describe your workplace issue and provide the necessary details.</p>
            </div>
        </li>

        <li class="hiw-step flex gap-3">
            <span class="hiw-num flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-blue-100 text-xs font-semibold text-blue-600">2</span>
            <div>
                <p class="text-sm font-medium text-slate-700">Review & Assign</p>
                <p class="text-xs text-slate-500">Our team reviews your request and assigns the appropriate expert.</p>
            </div>
        </li>

        <li class="hiw-step flex gap-3">
            <span class="hiw-num flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-blue-100 text-xs font-semibold text-blue-600">3</span>
            <div>
                <p class="text-sm font-medium text-slate-700">Expert Assistance</p>
                <p class="text-xs text-slate-500">A workplace support specialist communicates with you and reviews your case.</p>
            </div>
        </li>

        <li class="hiw-step flex gap-3">
            <span class="hiw-num flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-blue-100 text-xs font-semibold text-blue-600">4</span>
            <div>
                <p class="text-sm font-medium text-slate-700">Guidance & Updates</p>
                <p class="text-xs text-slate-500">Receive recommendations, updates, and support through the conversation panel.</p>
            </div>
        </li>

        <li class="hiw-step flex gap-3">
            <span class="hiw-num flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-green-100 text-xs font-semibold text-green-600">✓</span>
            <div>
                <p class="text-sm font-medium text-slate-700">Issue Resolved</p>
                <p class="text-xs text-slate-500">Your request is completed and marked as resolved once assistance is provided.</p>
            </div>
        </li>

    </ol>
</div>
        </div>
    </div>
</div>
@endsection
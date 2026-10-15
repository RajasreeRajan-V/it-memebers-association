{{--
    resources/views/employee/freelance-job/my-jobs.blade.php

    Expects from the controller:
      $applications  -> LengthAwarePaginator of JobApplication (with 'job.company')
      $counts        -> ['all' => int, 'pending' => int, 'shortlisted' => int, 'hired' => int, 'rejected' => int]
--}}
@extends('layouts.app')

@section('title', 'My Jobs')

@push('styles')
<style>
    .mj-wrap { max-width: 1140px; margin: 0 auto; padding: 40px 20px 72px; font-family: 'Inter', system-ui, sans-serif; color: #0f1b3d; }
    .mj-head { display: flex; justify-content: space-between; align-items: flex-end; gap: 16px; flex-wrap: wrap; margin-bottom: 28px; }
    .mj-head h1 { font-size: 32px; font-weight: 800; margin: 0 0 4px; letter-spacing: -.02em; }
    .mj-head p { margin: 0; color: #5b6685; }
    .mj-btn { display: inline-flex; align-items: center; gap: 8px; background: #1f6fd6; color: #fff; padding: 11px 20px; border-radius: 10px; font-weight: 600; text-decoration: none; border: 0; cursor: pointer; }
    .mj-btn:hover { background: #1859b0; color: #fff; }
    .mj-btn.ghost { background: #fff; color: #1f6fd6; border: 1px solid #cfdcf5; padding: 8px 14px; font-size: 14px; }
    .mj-btn.ghost:hover { background: #eef4ff; color: #1859b0; }

    .mj-stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(170px, 1fr)); gap: 14px; margin-bottom: 28px; }
    .mj-stat { background: #fff; border: 1px solid #e3e9f6; border-radius: 14px; padding: 18px 20px; text-decoration: none; color: inherit; transition: border-color .15s; }
    .mj-stat:hover, .mj-stat.active { border-color: #1f6fd6; }
    .mj-stat b { display: block; font-size: 28px; font-weight: 800; line-height: 1.1; }
    .mj-stat span { font-size: 14px; color: #5b6685; }

    .mj-bar { display: flex; gap: 12px; flex-wrap: wrap; margin-bottom: 18px; }
    .mj-bar form { display: flex; gap: 10px; flex: 1; min-width: 260px; }
    .mj-bar input, .mj-bar select { border: 1px solid #d8e0f1; border-radius: 10px; padding: 11px 14px; font: inherit; background: #fff; }
    .mj-bar input { flex: 1; }
    .mj-bar input:focus, .mj-bar select:focus { outline: 2px solid #1f6fd6; outline-offset: 1px; }

    .mj-list { display: flex; flex-direction: column; gap: 12px; }
    .mj-card { display: grid; grid-template-columns: 56px 1fr auto; gap: 18px; align-items: center; background: #fff; border: 1px solid #e3e9f6; border-radius: 14px; padding: 18px 20px; }
    .mj-logo { width: 56px; height: 56px; border-radius: 12px; background: #eef4ff; color: #1f6fd6; display: grid; place-items: center; font-weight: 800; font-size: 20px; overflow: hidden; }
    .mj-logo img { width: 100%; height: 100%; object-fit: cover; }
    .mj-title { font-size: 18px; font-weight: 700; margin: 0 0 2px; }
    .mj-company { color: #5b6685; font-size: 14px; margin-bottom: 8px; }
    .mj-meta { display: flex; flex-wrap: wrap; gap: 6px 18px; font-size: 14px; color: #3d4a6b; }
    .mj-side { text-align: right; display: flex; flex-direction: column; gap: 10px; align-items: flex-end; }
    .mj-date { font-size: 13px; color: #7a85a3; }

    .mj-badge { padding: 5px 12px; border-radius: 999px; font-size: 13px; font-weight: 600; }
    .mj-badge.pending { background: #fff4db; color: #8a5a00; }
    .mj-badge.shortlisted { background: #e6f0ff; color: #1859b0; }
    .mj-badge.hired { background: #dff6e7; color: #17713a; }
    .mj-badge.rejected { background: #fde6e6; color: #a32121; }

    .mj-empty { text-align: center; background: #fff; border: 1px dashed #c7d3ee; border-radius: 16px; padding: 56px 20px; }
    .mj-empty h3 { margin: 0 0 6px; font-size: 20px; }
    .mj-empty p { margin: 0 0 20px; color: #5b6685; }
.mj-contract { margin-top: 10px; display: flex; flex-wrap: wrap; gap: 6px 14px; align-items: center; font-size: 13px; color: #17713a; background: #f0faf4; border: 1px solid #cdeedb; border-radius: 8px; padding: 6px 10px; width: fit-content; }
.mj-contract a { color: #1859b0; font-weight: 600; text-decoration: none; }
.mj-contract a:hover { text-decoration: underline; }
    .mj-pager { margin-top: 24px; }

    @media (max-width: 640px) {
        .mj-card { grid-template-columns: 48px 1fr; }
        .mj-logo { width: 48px; height: 48px; }
        .mj-side { grid-column: 1 / -1; flex-direction: row; justify-content: space-between; align-items: center; text-align: left; }
    }
</style>
@endpush

@section('content')
@php
    $status = request('status', 'all');
    $tabs = [
        'all'         => 'All applied',
        'pending'     => 'Under review',
        'shortlisted' => 'Shortlisted',
        'hired'       => 'Hired',
        'rejected'    => 'Not selected',
    ];
@endphp

<div class="mj-wrap">

    <div class="mj-head">
        <div>
            <h1>My jobs</h1>
            <p>Track every job you have applied for and see where each one stands.</p>
        </div>
    
    </div>

    {{-- Status summary (each box filters the list) --}}
    <div class="mj-stats">
        @foreach ($tabs as $key => $label)
            <a href="{{ request()->fullUrlWithQuery(['status' => $key, 'page' => null]) }}"
               class="mj-stat {{ $status === $key ? 'active' : '' }}">
                <b>{{ $counts[$key] ?? 0 }}</b>
                <span>{{ $label }}</span>
            </a>
        @endforeach
    </div>

    {{-- Search + sort --}}
    <div class="mj-bar">
        <form method="GET" action="{{ url()->current() }}">
            <input type="hidden" name="status" value="{{ $status }}">
            <input type="search" name="q" value="{{ request('q') }}" placeholder="Search by job title or company">
            <select name="sort" onchange="this.form.submit()" aria-label="Sort applications">
                <option value="newest" @selected(request('sort', 'newest') === 'newest')>Newest first</option>
                <option value="oldest" @selected(request('sort') === 'oldest')>Oldest first</option>
            </select>
            <button type="submit" class="mj-btn">Search</button>
        </form>
    </div>

    {{-- Applications --}}
    @if ($applications->count())
        <div class="mj-list">
@foreach ($applications as $application)
@php
    $job = $application->project;
    $employer = $job?->employer;
    $company = $employer?->employerRegistration?->company_name ?? $employer?->name ?? 'Company';
    $logo = $employer?->employerRegistration?->logo ?? null; // adjust column name if different

    $raw = str_replace([' ', '-'], '_', strtolower(trim($application->status ?? 'pending')));
    $hasContract = !empty($application->contract_path);

    if ($hasContract || in_array($raw, ['hired','accepted','approved','in_progress','ongoing','started'])) {
        $state = 'hired';
    } elseif ($raw === 'shortlisted') {
        $state = 'shortlisted';
    } elseif (in_array($raw, ['rejected','declined','not_selected'])) {
        $state = 'rejected';
    } else {
        $state = 'pending';
    }

    // More specific badge text for the hired group
    if ($hasContract) {
        $stateLabel = 'Contract sent';
    } elseif ($state === 'hired') {
        $stateLabel = in_array($raw, ['accepted', 'approved']) ? 'Accepted' : 'Hired';
    } else {
        $stateLabel = $tabs[$state] ?? ucfirst($state);
    }

    $location = collect([$job->city, $job->state, $job->country])->filter()->implode(', ');
@endphp

<article class="mj-card">
    <div class="mj-logo">
        @if (!empty($logo))
            <img src="{{ asset('storage/' . $logo) }}" alt="{{ $company }} logo">
        @else
            {{ strtoupper(substr($company, 0, 1)) }}
        @endif
    </div>

    <div>
        <h3 class="mj-title">{{ $job->title }}</h3>
        <div class="mj-company">{{ $company }}</div>
        <div class="mj-meta">
            @if ($location)<span>{{ $location }}</span>@endif
            @if ($job->project_type)<span>{{ ucfirst($job->project_type) }}</span>@endif
            @if ($job->work_mode)<span>{{ ucfirst($job->work_mode) }}</span>@endif
            @if ($job->budget)<span>{{ $job->budget }}</span>@endif
        </div>

        @if ($hasContract)
            <div class="mj-contract">
                <span>
                    Contract sent
                    {{ $application->contract_sent_at?->format('d M Y') ?? $application->updated_at->format('d M Y') }}
                </span>
                <a href="{{ asset('storage/' . $application->contract_path) }}" target="_blank" rel="noopener">View contract</a>
            </div>
        @endif
    </div>

    <div class="mj-side">
        <span class="mj-badge {{ $state }}">{{ $stateLabel }}</span>
        <span class="mj-date">Applied {{ $application->created_at->diffForHumans() }}</span>
@if ($hasContract)
    @if ($application->signed_contract_path)
        <a href="{{ asset('storage/' . $application->signed_contract_path) }}" target="_blank" rel="noopener" class="mj-btn ghost">View signed contract</a>
    @else
        <form method="POST"
              action="{{ route('employee.freelance-job.signed-contract', $application) }}"
              enctype="multipart/form-data">
            @csrf
            <input type="file" name="signed_contract" id="sc-{{ $application->id }}"
                   accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" hidden
                   onchange="this.form.submit()">
            <label for="sc-{{ $application->id }}" class="mj-btn ghost">Upload signed contract</label>
        </form>
    @endif
@endif
</article>
@endforeach
        </div>

        <div class="mj-pager">
            {{ $applications->withQueryString()->links() }}
        </div>
    @else
        <div class="mj-empty">
            <h3>No applications here yet</h3>
           <p>
    @if ($status !== 'all' || request('q'))
        Nothing matches these filters. Clear them to see all your applications.
    @else
        Jobs you apply for will show up here so you can follow their progress.
    @endif
</p>
            <a href="{{ url('/employee/freelance-job') }}" class="mj-btn">Find a job to apply for</a>
        </div>
    @endif

</div>
@endsection
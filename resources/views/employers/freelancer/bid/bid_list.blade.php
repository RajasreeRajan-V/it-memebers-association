@extends('layouts.app')

@section('title', 'Project Bids')

@section('page-title', 'Project Bids')

@section('page-subtitle', 'Review freelancer bids for this project')

@section('content')

@php
    // Format budget: works for "80000", 80000 or "80000 - 120000"
    $budgetText = preg_replace_callback(
        '/\d+(\.\d+)?/',
        fn ($m) => number_format((float) $m[0]),
        (string) $project->budget
    );
@endphp

<div class="pb-page">

    {{-- Back --}}
    <a href="{{ route('employer.freelancer.bids.index') }}" class="pb-btn pb-btn--ghost pb-back">
        <i class="fa-solid fa-arrow-left"></i>
        Back to projects
    </a>

    {{-- Project summary --}}
    <section class="pb-card pb-project">

        <div class="pb-project__info">
            <span class="pb-eyebrow">Project</span>
            <h1 class="pb-project__title">{{ $project->title }}</h1>
            <span class="pb-chip">
                <i class="fa-solid fa-hashtag"></i>{{ $project->id }}
            </span>
        </div>

        <div class="pb-project__budget">
            <span class="pb-eyebrow">Project Budget</span>
            <strong>₹{{ $budgetText }}</strong>
        </div>

    </section>


    {{-- Bids --}}
    <section class="pb-card">

        <header class="pb-card__header">
            <h2>
                <span class="pb-card__icon"><i class="fa-solid fa-users"></i></span>
                Freelancer Bids
            </h2>
            <span class="pb-count">
                {{ $bids->total() }} bid{{ $bids->total() === 1 ? '' : 's' }}
            </span>
        </header>

        @if($bids->count())

            <div class="pb-table-wrap">
                <table class="pb-table">

                    <thead>
                        <tr>
                            <th>Bid #</th>
                            <th>Freelancer</th>
                            <th>Bid Amount</th>
                            <th>Timeline</th>
                            <th>Cover Letter</th>
                            <th>Status</th>
                            <th>Submitted</th>
                            <th class="pb-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($bids as $bid)

                            @php
                                $freelancerName = $bid->freelancer->name
                                    ?? $bid->freelancer->full_name
                                    ?? $bid->freelancer->user->name
                                    ?? 'N/A';

                                $days = $bid->estimated_days;
                                $timeline = $days
                                    ? (preg_match('/[a-zA-Z]/', (string) $days) ? $days : $days . ' days')
                                    : 'N/A';
                            @endphp

                            <tr>

                                <td>
                                    <span class="pb-strong">{{ $bid->bid_number ?? '#' . $bid->id }}</span>
                                </td>

                                <td>
                                    <div class="pb-person">
                                        <div class="pb-avatar">
                                            {{ strtoupper(substr($freelancerName, 0, 1)) }}
                                        </div>
                                        <span class="pb-strong">{{ $freelancerName }}</span>
                                    </div>
                                </td>

                                <td>
                                    <span class="pb-amount">₹{{ number_format($bid->bid_amount, 2) }}</span>
                                </td>

                                <td>
                                    <span class="pb-muted">
                                        <i class="fa-regular fa-clock"></i> {{ $timeline }}
                                    </span>
                                </td>

                                <td>
                                    <span class="pb-truncate" title="{{ $bid->cover_letter }}">
                                        {{ $bid->cover_letter ?? 'N/A' }}
                                    </span>
                                </td>

                                <td>
                                    @if($bid->status === 'pending')
                                        <span class="pb-badge pb-badge--pending">
                                            <i class="fa-solid fa-clock"></i> Pending
                                        </span>
                                    @elseif($bid->status === 'accepted')
                                        <span class="pb-badge pb-badge--accepted">
                                            <i class="fa-solid fa-circle-check"></i> Accepted
                                        </span>
                                    @elseif($bid->status === 'rejected')
                                        <span class="pb-badge pb-badge--rejected">
                                            <i class="fa-solid fa-circle-xmark"></i> Rejected
                                        </span>
                                    @else
                                        <span class="pb-badge">{{ ucfirst($bid->status) }}</span>
                                    @endif
                                </td>

                                <td>
                                    <span class="pb-muted">{{ $bid->created_at?->format('d M Y') }}</span>
                                </td>

                                <td class="pb-center">
                                    <a href="{{ route('employer.freelancer.bids.show', $bid->id) }}"
                                       class="pb-btn pb-btn--outline">
                                        <i class="fa-solid fa-eye"></i> View
                                    </a>
                                </td>

                            </tr>

                        @endforeach
                    </tbody>

                </table>
            </div>

            <footer class="pb-footer">
                <div class="pb-footer__meta">
                    Showing
                    <strong>{{ $bids->firstItem() ?? 0 }}</strong>
                    to
                    <strong>{{ $bids->lastItem() ?? 0 }}</strong>
                    of
                    <strong>{{ $bids->total() }}</strong>
                    bids
                </div>

                @if($bids->hasPages())
                    <div class="pb-pagination">
                        {{ $bids->appends(request()->query())->links() }}
                    </div>
                @endif
            </footer>

        @else

            <div class="pb-empty">
                <div class="pb-empty__icon"><i class="fa-solid fa-file-invoice"></i></div>
                <h3>No bids yet</h3>
                <p>There are currently no bids for this project.</p>
            </div>

        @endif

    </section>

</div>

@endsection

@push('styles')
<style>

    /* All classes are prefixed with "pb-" so they never clash with global
       layout styles (.btn, .badge, .panel, .avatar ...). */

    .pb-page {
        --pb-primary: #3b5bdb;
        --pb-primary-soft: #eef2ff;
        --pb-text: #111827;
        --pb-text-2: #4b5563;
        --pb-muted: #6b7280;
        --pb-border: #e5e7eb;
        --pb-bg-soft: #f9fafb;
        --pb-green: #059669;

        max-width: 1280px;
        margin: 0 auto;
        padding: 1.75rem 2rem 3rem;
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
        color: var(--pb-text);
    }

    /* ---------- Cards ---------- */
    .pb-card {
        background: #fff;
        border: 1px solid var(--pb-border);
        border-radius: 16px;
        box-shadow: 0 1px 2px rgba(16, 24, 40, .04), 0 4px 16px rgba(16, 24, 40, .04);
        overflow: hidden;
    }

    .pb-card__header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1.25rem 1.75rem;
        border-bottom: 1px solid var(--pb-border);
    }

    .pb-card__header h2 {
        display: flex;
        align-items: center;
        gap: .75rem;
        margin: 0;
        font-size: 1.05rem;
        font-weight: 700;
    }

    .pb-card__icon {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        background: var(--pb-primary-soft);
        color: var(--pb-primary);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: .85rem;
    }

    .pb-count {
        padding: .35rem .85rem;
        border-radius: 999px;
        background: var(--pb-primary-soft);
        color: var(--pb-primary);
        font-size: .8rem;
        font-weight: 600;
    }

    /* ---------- Buttons ---------- */
    .pb-btn {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        padding: .5rem 1rem;
        border-radius: 10px;
        font-size: .85rem;
        font-weight: 600;
        line-height: 1;
        text-decoration: none;
        cursor: pointer;
        transition: all .2s ease;
        white-space: nowrap;
    }

    .pb-btn--ghost {
        background: #fff;
        border: 1px solid var(--pb-border);
        color: var(--pb-text-2);
    }

    .pb-btn--ghost:hover {
        border-color: var(--pb-primary);
        color: var(--pb-primary);
        background: var(--pb-primary-soft);
    }

    .pb-btn--outline {
        background: #fff;
        border: 1px solid #c7d2fe;
        color: var(--pb-primary);
    }

    .pb-btn--outline:hover {
        background: var(--pb-primary);
        border-color: var(--pb-primary);
        color: #fff;
        box-shadow: 0 4px 12px rgba(59, 91, 219, .25);
    }

    .pb-back { align-self: flex-start; }
    .pb-back i { font-size: .75rem; transition: transform .2s ease; }
    .pb-back:hover i { transform: translateX(-3px); }

    /* ---------- Project summary ---------- */
    .pb-project {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 2rem;
        padding: 1.75rem 2rem;
        position: relative;
    }

    .pb-project::before {
        content: "";
        position: absolute;
        inset: 0 auto 0 0;
        width: 5px;
        background: linear-gradient(180deg, #3b5bdb, #7048e8);
    }

    .pb-eyebrow {
        display: block;
        margin-bottom: .5rem;
        font-size: .7rem;
        font-weight: 700;
        letter-spacing: .1em;
        text-transform: uppercase;
        color: var(--pb-muted);
    }

    .pb-project__title {
        margin: 0 0 .75rem;
        font-size: 1.55rem;
        font-weight: 700;
        letter-spacing: -.02em;
        line-height: 1.25;
    }

    .pb-chip {
        display: inline-flex;
        align-items: center;
        gap: .3rem;
        padding: .25rem .7rem;
        border-radius: 999px;
        background: var(--pb-bg-soft);
        border: 1px solid var(--pb-border);
        color: var(--pb-muted);
        font-size: .78rem;
        font-weight: 600;
    }

    .pb-chip i { font-size: .65rem; }

    .pb-project__budget {
        text-align: right;
        padding: 1rem 1.5rem;
        border-radius: 14px;
        background: #ecfdf5;
        border: 1px solid #d1fae5;
        flex-shrink: 0;
    }

    .pb-project__budget .pb-eyebrow { color: #047857; margin-bottom: .25rem; }

    .pb-project__budget strong {
        font-size: 1.6rem;
        font-weight: 800;
        letter-spacing: -.02em;
        color: var(--pb-green);
    }

    /* ---------- Table ---------- */
    .pb-table-wrap { overflow-x: auto; }

    .pb-table {
        width: 100%;
        min-width: 900px;
        border-collapse: collapse;
        font-size: .88rem;
    }

    .pb-table thead th {
        padding: .9rem 1.75rem;
        background: var(--pb-bg-soft);
        border-bottom: 1px solid var(--pb-border);
        color: var(--pb-muted);
        font-size: .7rem;
        font-weight: 700;
        letter-spacing: .07em;
        text-transform: uppercase;
        text-align: left;
        white-space: nowrap;
    }

    .pb-table tbody td {
        padding: 1.1rem 1.75rem;
        border-bottom: 1px solid #f3f4f6;
        vertical-align: middle;
    }

    .pb-table tbody tr:last-child td { border-bottom: 0; }
    .pb-table tbody tr { transition: background .15s ease; }
    .pb-table tbody tr:hover { background: #f8faff; }

    .pb-center { text-align: center !important; }

    .pb-strong { font-weight: 600; color: var(--pb-text); }

    .pb-muted {
        color: var(--pb-muted);
        font-size: .85rem;
        white-space: nowrap;
    }

    .pb-muted i { margin-right: .25rem; font-size: .75rem; }

    .pb-amount {
        font-weight: 700;
        color: var(--pb-green);
        white-space: nowrap;
    }

    .pb-truncate {
        display: inline-block;
        max-width: 240px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        color: var(--pb-text-2);
        vertical-align: middle;
        cursor: default;
    }

    /* Person */
    .pb-person { display: flex; align-items: center; gap: .75rem; }

    .pb-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: linear-gradient(135deg, #3b5bdb, #7048e8);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: .85rem;
        font-weight: 700;
        flex-shrink: 0;
        box-shadow: 0 2px 8px rgba(59, 91, 219, .3);
    }

    /* Badges */
    .pb-badge {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        padding: .35rem .8rem;
        border-radius: 999px;
        background: #f3f4f6;
        color: var(--pb-text-2);
        font-size: .75rem;
        font-weight: 600;
        white-space: nowrap;
    }

    .pb-badge i { font-size: .7rem; }
    .pb-badge--pending  { background: #fffbeb; color: #b45309; }
    .pb-badge--accepted { background: #ecfdf5; color: #047857; }
    .pb-badge--rejected { background: #fef2f2; color: #b91c1c; }

    /* ---------- Footer / pagination ---------- */
    .pb-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
        padding: 1rem 1.75rem;
        border-top: 1px solid var(--pb-border);
        background: var(--pb-bg-soft);
    }

    .pb-footer__meta { font-size: .83rem; color: var(--pb-muted); }
    .pb-footer__meta strong { color: var(--pb-text); font-weight: 600; }

    .pb-pagination nav { display: flex; }

    .pb-pagination ul {
        display: flex;
        align-items: center;
        gap: .3rem;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .pb-pagination li > * {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 34px;
        height: 34px;
        padding: 0 .6rem;
        border: 1px solid var(--pb-border);
        border-radius: 8px;
        background: #fff;
        color: var(--pb-text-2);
        font-size: .82rem;
        font-weight: 500;
        text-decoration: none;
        transition: all .15s ease;
    }

    .pb-pagination li.active > * {
        background: var(--pb-primary);
        border-color: var(--pb-primary);
        color: #fff;
    }

    .pb-pagination li:not(.active):not(.disabled) > *:hover { background: var(--pb-primary-soft); }
    .pb-pagination li.disabled > * { color: #d1d5db; cursor: not-allowed; }

    /* ---------- Empty state ---------- */
    .pb-empty {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 4.5rem 1.5rem;
    }

    .pb-empty__icon {
        width: 72px;
        height: 72px;
        margin-bottom: 1.1rem;
        border-radius: 50%;
        background: var(--pb-primary-soft);
        color: var(--pb-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
    }

    .pb-empty h3 { margin: 0 0 .4rem; font-size: 1.05rem; font-weight: 700; }
    .pb-empty p  { margin: 0; color: var(--pb-muted); font-size: .88rem; }

    /* ---------- Responsive ---------- */
    @media (max-width: 768px) {
        .pb-page { padding: 1.25rem 1rem 2rem; }

        .pb-project {
            flex-direction: column;
            align-items: flex-start;
            gap: 1.25rem;
            padding: 1.5rem;
        }

        .pb-project__budget { text-align: left; width: 100%; }
        .pb-project__title { font-size: 1.3rem; }
        .pb-card__header, .pb-footer { padding-left: 1.25rem; padding-right: 1.25rem; }
        .pb-footer { flex-direction: column; align-items: flex-start; }
    }

</style>
@endpush
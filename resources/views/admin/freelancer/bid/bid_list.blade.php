@extends('admin.layout.app')

@section('title', 'Project Bids')

@section('page-title', 'Project Bids')

@section('page-subtitle', 'Review freelancer bids for this project')

@section('content')

<div class="bids-page">

    {{-- Project Information --}}
    <div class="panel project-header">

        <div>
            <span class="project-label">PROJECT</span>

            <h4>
                {{ $project->title }}
            </h4>

            <span class="project-id">
                Project #{{ $project->id }}
            </span>
        </div>

        <div class="project-budget">
            <span>Project Budget</span>
            <strong>
                ₹{{$project->budget }}
            </strong>
        </div>

    </div>


    {{-- Bids Table --}}
    <div class="panel">

        <div class="panel-header">

            <h6>
                <i class="fa-solid fa-users"></i>
                Freelancer Bids
            </h6>

            <span class="panel-header__meta">
                {{ $bids->total() }} bid{{ $bids->total() === 1 ? '' : 's' }}
            </span>

        </div>


        <div class="panel-body panel-body--flush">

            @if($bids->count())

                <div class="table-scroll">

                    <table class="data-table">

                        <thead>
                            <tr>
                                <th>Bid Number</th>
                                <th>Freelancer</th>
                                <th>Bid Amount</th>
                                <th>Estimated Days</th>
                                <th>Cover Letter</th>
                                <th>Status</th>
                                <th>Submitted</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($bids as $bid)

                                <tr>

                                    {{-- Bid Number --}}
                                    <td>
                                        <span class="cell-strong">
                                            {{ $bid->bid_number ?? '#' . $bid->id }}
                                        </span>
                                    </td>


                                    {{-- Freelancer --}}
                                    <td>

                                        <div class="person">

                                            <div class="avatar avatar--sm">
                                                {{
                                                    strtoupper(
                                                        substr(
                                                            $bid->freelancer->name ?? 'N',
                                                            0,
                                                            1
                                                        )
                                                    )
                                                }}
                                            </div>

                                            <div>
                                                <span class="cell-strong">
                                                    {{ $bid->freelancer->name ?? 'N/A' }}
                                                </span>
                                            </div>

                                        </div>

                                    </td>


                                    {{-- Bid Amount --}}
                                    <td>

                                        <span class="cell-amount">
                                            ₹{{ number_format($bid->bid_amount, 2) }}
                                        </span>

                                    </td>


                                    {{-- Estimated Days --}}
                                    <td>

                                        <span class="cell-muted">
                                            {{ $bid->estimated_days ?? 'N/A' }}
                                            @if($bid->estimated_days)
                                                days
                                            @endif
                                        </span>

                                    </td>


                                    {{-- Cover Letter --}}
                                    <td>

                                        <span
                                            class="cell-truncate"
                                            title="{{ $bid->cover_letter }}"
                                        >
                                            {{ $bid->cover_letter ?? 'N/A' }}
                                        </span>

                                    </td>


                                    {{-- Status --}}
                                    <td>

                                        @if($bid->status === 'pending')

                                            <span class="badge badge--pending">
                                                <i class="fa-solid fa-clock"></i>
                                                Pending
                                            </span>

                                        @elseif($bid->status === 'accepted')

                                            <span class="badge badge--approved">
                                                <i class="fa-solid fa-circle-check"></i>
                                                Accepted
                                            </span>

                                        @elseif($bid->status === 'rejected')

                                            <span class="badge badge--rejected">
                                                <i class="fa-solid fa-circle-xmark"></i>
                                                Rejected
                                            </span>

                                        @else

                                            <span class="badge">
                                                {{ ucfirst($bid->status) }}
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Submitted --}}
                                    <td>

                                        <span class="cell-muted">
                                            {{ $bid->created_at?->format('d M Y') }}
                                        </span>

                                    </td>


                                    {{-- Action --}}
                                    <td class="text-center">

                                        <a
                                            href="{{ route('admin.freelancer.bids.show', $bid->id) }}"
                                            class="btn btn-outline btn-sm"
                                        >
                                            <i class="fa-solid fa-eye"></i>
                                            View
                                        </a>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>


                {{-- Pagination --}}
                <div class="table-footer">

                    <div class="table-footer__meta">

                        Showing
                        <strong>{{ $bids->firstItem() ?? 0 }}</strong>
                        to
                        <strong>{{ $bids->lastItem() ?? 0 }}</strong>
                        of
                        <strong>{{ $bids->total() }}</strong>
                        bids

                    </div>

                    <div class="table-footer__pagination">

                        {{ $bids->appends(request()->query())->links() }}

                    </div>

                </div>

            @else

                <div class="empty-state">

                    <div class="empty-state__icon">
                        <i class="fa-solid fa-file-invoice"></i>
                    </div>

                    <h5>No Bids Found</h5>

                    <p>
                        There are currently no bids for this project.
                    </p>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection

@push('styles')
<style>

    /* ===== BIDS PAGE ===== */
    .bids-page {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    /* ===== PANEL (shared card) ===== */
    .panel {
        background: #ffffff;
        border: 1px solid #e9edf4;
        border-radius: 14px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
    }

    .panel-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1.1rem 1.5rem;
        border-bottom: 1px solid #e9edf4;
    }

    .panel-header h6 {
        display: flex;
        align-items: center;
        gap: 0.55rem;
        margin: 0;
        font-size: 0.95rem;
        font-weight: 700;
        color: #1a1a2e;
    }

    .panel-header h6 i {
        color: #4a6cf7;
        font-size: 0.9rem;
    }

    .panel-header__meta {
        font-size: 0.8rem;
        font-weight: 500;
        color: #8a8fa8;
        background: #f0f2f5;
        padding: 0.3rem 0.75rem;
        border-radius: 999px;
    }

    .panel-body {
        padding: 1.5rem;
    }

    .panel-body--flush {
        padding: 0;
    }

    /* ===== PROJECT HEADER ===== */
    .project-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.5rem 1.75rem;
    }

    .project-label {
        display: block;
        font-size: 0.7rem;
        font-weight: 700;
        color: #8a8fa8;
        letter-spacing: 0.08em;
        margin-bottom: 0.4rem;
    }

    .project-header h4 {
        margin: 0;
        color: #1a1a2e;
        font-size: 1.25rem;
        font-weight: 700;
        letter-spacing: -0.3px;
    }

    .project-id {
        display: block;
        margin-top: 0.35rem;
        color: #8a8fa8;
        font-size: 0.8rem;
    }

    .project-budget {
        text-align: right;
    }

    .project-budget span {
        display: block;
        color: #8a8fa8;
        font-size: 0.75rem;
        font-weight: 500;
        margin-bottom: 0.3rem;
    }

    .project-budget strong {
        font-size: 1.5rem;
        font-weight: 700;
        color: #10b981;
        letter-spacing: -0.3px;
    }

    /* ===== TABLE ===== */
    .table-scroll {
        overflow-x: auto;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.87rem;
    }

    .data-table thead th {
        text-align: left;
        padding: 0.85rem 1.5rem;
        background: #f8f9fc;
        color: #8a8fa8;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        border-bottom: 1px solid #e9edf4;
        white-space: nowrap;
    }

    .data-table tbody td {
        padding: 0.9rem 1.5rem;
        border-bottom: 1px solid #f0f2f5;
        color: #1a1a2e;
        vertical-align: middle;
    }

    .data-table tbody tr:last-child td {
        border-bottom: none;
    }

    .data-table tbody tr {
        transition: background 0.15s ease;
    }

    .data-table tbody tr:hover {
        background: #f8f9fc;
    }

    .text-center {
        text-align: center;
    }

    .cell-strong {
        font-weight: 600;
        color: #1a1a2e;
    }

    .cell-muted {
        color: #8a8fa8;
        font-size: 0.85rem;
    }

    .cell-amount {
        font-weight: 700;
        color: #10b981;
    }

    .cell-truncate {
        display: inline-block;
        max-width: 220px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        color: #5a5f7a;
        cursor: default;
    }

    /* ===== PERSON (avatar + name) ===== */
    .person {
        display: flex;
        align-items: center;
        gap: 0.65rem;
    }

    .avatar--sm {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: linear-gradient(135deg, #4a6cf7, #6a4cf7);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.8rem;
        flex-shrink: 0;
        box-shadow: 0 2px 6px rgba(74, 108, 247, 0.25);
    }

    /* ===== BADGES ===== */
    .badge {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.3rem 0.7rem;
        border-radius: 999px;
        font-size: 0.72rem;
        font-weight: 600;
        background: #f0f2f5;
        color: #5a5f7a;
    }

    .badge i {
        font-size: 0.65rem;
    }

    .badge--pending {
        background: #fff7ed;
        color: #b45309;
    }

    .badge--approved {
        background: #ecfdf5;
        color: #047857;
    }

    .badge--rejected {
        background: #fef2f2;
        color: #b91c1c;
    }

    /* ===== BUTTONS ===== */
    .btn {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.82rem;
        font-weight: 600;
        border-radius: 8px;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.2s ease;
        border: 1px solid transparent;
    }

    .btn-sm {
        padding: 0.4rem 0.85rem;
    }

    .btn-outline {
        background: #ffffff;
        border-color: #dde2ee;
        color: #4a6cf7;
    }

    .btn-outline:hover {
        background: #4a6cf7;
        border-color: #4a6cf7;
        color: #ffffff;
    }

    /* ===== TABLE FOOTER / PAGINATION ===== */
    .table-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        padding: 1.1rem 1.5rem;
        border-top: 1px solid #e9edf4;
        flex-wrap: wrap;
    }

    .table-footer__meta {
        font-size: 0.82rem;
        color: #8a8fa8;
    }

    .table-footer__meta strong {
        color: #1a1a2e;
        font-weight: 600;
    }

    .table-footer__pagination nav {
        display: flex;
    }

    .table-footer__pagination ul {
        display: flex;
        align-items: center;
        gap: 0.25rem;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .table-footer__pagination li > * {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 32px;
        height: 32px;
        padding: 0 0.5rem;
        border-radius: 8px;
        font-size: 0.82rem;
        font-weight: 500;
        color: #5a5f7a;
        text-decoration: none;
        border: 1px solid #e9edf4;
        background: #fff;
        transition: all 0.15s ease;
    }

    .table-footer__pagination li.active > * {
        background: #4a6cf7;
        border-color: #4a6cf7;
        color: #fff;
    }

    .table-footer__pagination li:not(.active) > *:hover {
        background: #f0f2f5;
    }

    .table-footer__pagination li.disabled > * {
        color: #c3c8d6;
        cursor: not-allowed;
    }

    /* ===== EMPTY STATE ===== */
    .empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 4rem 1.5rem;
    }

    .empty-state__icon {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background: #f0f2f5;
        color: #8a8fa8;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }

    .empty-state h5 {
        margin: 0 0 0.4rem;
        color: #1a1a2e;
        font-size: 1rem;
        font-weight: 700;
    }

    .empty-state p {
        margin: 0;
        color: #8a8fa8;
        font-size: 0.85rem;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 640px) {

        .project-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .project-budget {
            text-align: left;
        }

        .table-footer {
            flex-direction: column;
            align-items: flex-start;
        }

    }

</style>
@endpush
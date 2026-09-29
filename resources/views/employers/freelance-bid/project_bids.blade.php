
@extends('layouts.app')

@section('content')

<style>
    .project-bids-page {
        max-width: 1400px;
        margin: 0 auto;
        padding: 35px 25px 60px;
        font-family: "Inter", "Segoe UI", system-ui, sans-serif;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 20px;
        margin-bottom: 28px;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        color: #315bc9;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 12px;
    }

    .back-link:hover {
        color: #1d4ed8;
    }

    .page-title h1 {
        margin: 0;
        font-size: 28px;
        font-weight: 700;
        color: #172033;
    }

    .page-title p {
        margin: 7px 0 0;
        color: #6b7280;
        font-size: 14px;
    }

    .bid-count {
        background: #eef2ff;
        color: #315bc9;
        border-radius: 30px;
        padding: 9px 16px;
        font-size: 14px;
        font-weight: 600;
        white-space: nowrap;
    }

    /* Alerts */

    .alert {
        padding: 14px 18px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-size: 14px;
        font-weight: 500;
    }

    .alert-success {
        background: #ecfdf5;
        color: #047857;
        border: 1px solid #a7f3d0;
    }

    .alert-error {
        background: #fef2f2;
        color: #b91c1c;
        border: 1px solid #fecaca;
    }

    /* Project information */

    .project-box {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        padding: 20px 22px;
        margin-bottom: 25px;
        box-shadow: 0 5px 20px rgba(17, 24, 39, 0.05);
    }

    .project-label {
        color: #9ca3af;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .04em;
        margin-bottom: 6px;
    }

    .project-title {
        margin: 0;
        color: #172033;
        font-size: 20px;
        font-weight: 700;
    }

    /* Empty state */

    .empty-state {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        padding: 70px 25px;
        text-align: center;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.04);
    }

    .empty-icon {
        width: 70px;
        height: 70px;
        margin: 0 auto 18px;
        border-radius: 50%;
        background: #eef2ff;
        color: #3364d7;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
    }

    .empty-state h3 {
        margin: 0 0 8px;
        color: #1f2937;
        font-size: 20px;
    }

    .empty-state p {
        margin: 0;
        color: #6b7280;
        font-size: 14px;
    }

    /* Bid cards */

    .bids-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 22px;
    }

    .bid-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(17, 24, 39, 0.05);
        transition: .2s ease;
    }

    .bid-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(17, 24, 39, 0.09);
    }

    .bid-card-header {
        padding: 20px 22px;
        border-bottom: 1px solid #eef0f4;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 15px;
    }

    .freelancer {
        display: flex;
        align-items: center;
        gap: 13px;
    }

    .freelancer-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: linear-gradient(135deg, #3364d7, #4f46e5);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .freelancer-info h3 {
        margin: 0;
        font-size: 15px;
        color: #1f2937;
        font-weight: 650;
    }

    .freelancer-info p {
        margin: 4px 0 0;
        font-size: 12px;
        color: #6b7280;
    }

    /* Status */

    .status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 11px;
        border-radius: 30px;
        font-size: 11px;
        font-weight: 700;
        text-transform: capitalize;
        white-space: nowrap;
    }

    .status-pending {
        background: #fff7ed;
        color: #c2410c;
    }

    .status-shortlisted {
        background: #eff6ff;
        color: #2563eb;
    }

    .status-interview {
        background: #f5f3ff;
        color: #7c3aed;
    }

    .status-accepted {
        background: #ecfdf5;
        color: #047857;
    }

    .status-rejected {
        background: #fef2f2;
        color: #b91c1c;
    }

    .status-withdrawn {
        background: #f3f4f6;
        color: #4b5563;
    }

    /* Card body */

    .bid-card-body {
        padding: 22px;
    }

    .details-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
        margin-bottom: 20px;
    }

    .detail-box {
        background: #f8fafc;
        border: 1px solid #eef0f3;
        border-radius: 10px;
        padding: 12px 14px;
    }

    .detail-label {
        color: #9ca3af;
        font-size: 11px;
        margin-bottom: 5px;
    }

    .detail-value {
        color: #1f2937;
        font-size: 14px;
        font-weight: 650;
    }

    .amount {
        color: #2563eb;
        font-size: 16px;
    }

    .cover-letter-title {
        font-size: 12px;
        font-weight: 700;
        color: #374151;
        margin-bottom: 7px;
    }

    .cover-letter-text {
        background: #f9fafb;
        border-radius: 9px;
        padding: 11px 13px;
        color: #6b7280;
        font-size: 13px;
        line-height: 1.6;

        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Footer */

    .bid-card-footer {
        padding: 16px 22px;
        background: #fafbfc;
        border-top: 1px solid #eef0f4;

        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
    }

    .submitted {
        color: #9ca3af;
        font-size: 11px;
    }

    .actions {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn {
        border: none;
        border-radius: 8px;
        padding: 9px 13px;
        font-size: 12px;
        font-weight: 650;
        cursor: pointer;
        text-decoration: none;

        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;

        transition: .2s ease;
    }

    .btn-view {
        background: #eef2ff;
        color: #315bc9;
    }

    .btn-view:hover {
        background: #e0e7ff;
    }

    .btn-proceed {
        background: #2563eb;
        color: #ffffff;
    }

    .btn-proceed:hover {
        background: #1d4ed8;
    }

    .btn-reject {
        background: #fff1f2;
        color: #dc2626;
    }

    .btn-reject:hover {
        background: #ffe4e6;
    }

    .pagination-wrap {
        margin-top: 30px;
    }

    /* Responsive */

    @media (max-width: 950px) {
        .bids-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 600px) {
        .project-bids-page {
            padding: 25px 15px 45px;
        }

        .page-header {
            flex-direction: column;
        }

        .page-title h1 {
            font-size: 23px;
        }

        .details-grid {
            grid-template-columns: 1fr;
        }

        .bid-card-footer {
            flex-direction: column;
            align-items: stretch;
        }

        .actions {
            width: 100%;
        }

        .actions .btn {
            flex: 1;
        }
    }
</style>


<div class="project-bids-page">

    {{-- Header --}}
    <div class="page-header">

        <div class="page-title">

            <a href="{{ route('employer.bids.index') }}" class="back-link">
                <i class="fa-solid fa-arrow-left"></i>
                Back to all bids
            </a>

            <h1>Project Bids</h1>

            <p>
                Review freelancers who submitted bids for this project.
            </p>

        </div>

        <div class="bid-count">
            {{ $bids->total() }}
            {{ $bids->total() == 1 ? 'Bid' : 'Bids' }}
        </div>

    </div>


    {{-- Alerts --}}

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            <i class="fa-solid fa-circle-exclamation"></i>
            {{ session('error') }}
        </div>
    @endif


    {{-- Project Information --}}

    <div class="project-box">

        <div class="project-label">
            Project
        </div>

        <h2 class="project-title">
            {{ $project->title }}
        </h2>

    </div>


    {{-- Bids --}}

    @if($bids->count())

        <div class="bids-grid">

            @foreach($bids as $bid)

                @php

                    $freelancerName =
                        $bid->freelancer?->user?->name
                        ?? 'Freelancer';

                    $initial = strtoupper(
                        mb_substr($freelancerName, 0, 1)
                    );

                    $status = $bid->status ?? 'pending';

                    $statusClass = match($status) {

                        'pending' =>
                            'status-pending',

                        'shortlisted' =>
                            'status-shortlisted',

                        'interview' =>
                            'status-interview',

                        'accepted' =>
                            'status-accepted',

                        'rejected' =>
                            'status-rejected',

                        'withdrawn' =>
                            'status-withdrawn',

                        default =>
                            'status-pending',
                    };

                @endphp


                <div class="bid-card">

                    {{-- Header --}}

                    <div class="bid-card-header">

                        <div class="freelancer">

                            <div class="freelancer-avatar">
                                {{ $initial }}
                            </div>

                            <div class="freelancer-info">

                                <h3>
                                    {{ $freelancerName }}
                                </h3>

                                <p>
                                    Freelancer · Bid #{{ $bid->id }}
                                </p>

                            </div>

                        </div>


                        <span class="status {{ $statusClass }}">

                            <i
                                class="fa-solid fa-circle"
                                style="font-size: 6px;"
                            ></i>

                            {{ ucfirst($status) }}

                        </span>

                    </div>


                    {{-- Body --}}

                    <div class="bid-card-body">

                        <div class="details-grid">

                            {{-- Bid Amount --}}

                            <div class="detail-box">

                                <div class="detail-label">
                                    Bid Amount
                                </div>

                                <div class="detail-value amount">
                                    ₹{{ number_format((float) $bid->bid_amount, 2) }}
                                </div>

                            </div>


                            {{-- Estimated Time --}}

                            <div class="detail-box">

                                <div class="detail-label">
                                    Estimated Time
                                </div>

                                <div class="detail-value">
                                    {{ $bid->estimated_days ?? 'N/A' }}
                                </div>

                            </div>


                            {{-- Submitted --}}

                            <div class="detail-box">

                                <div class="detail-label">
                                    Submitted
                                </div>

                                <div class="detail-value">
                                    {{ $bid->created_at?->format('d M Y') ?? 'N/A' }}
                                </div>

                            </div>


                            {{-- Updated --}}

                            <div class="detail-box">

                                <div class="detail-label">
                                    Last Updated
                                </div>

                                <div class="detail-value">
                                    {{ $bid->updated_at?->format('d M Y') ?? 'N/A' }}
                                </div>

                            </div>

                        </div>


                        {{-- Cover Letter --}}

                        @if($bid->cover_letter)

                            <div class="cover-letter">

                                <div class="cover-letter-title">
                                    Cover Letter
                                </div>

                                <div class="cover-letter-text">
                                    {{ $bid->cover_letter }}
                                </div>

                            </div>

                        @endif

                    </div>


                    {{-- Footer --}}

                    <div class="bid-card-footer">

                        <div class="submitted">

                            Received
                            {{ $bid->created_at?->diffForHumans() ?? '' }}

                        </div>


                        <div class="actions">

                            {{-- View --}}

                            <a
                                href="{{ route('employer.bids.show', $bid->id) }}"
                                class="btn btn-view"
                            >

                                <i class="fa-solid fa-eye"></i>

                                View

                            </a>


                            {{-- Proceed / Reject --}}

                            @if(in_array($status, [

                                \App\Models\FreelancerBid::STATUS_PENDING,

                                \App\Models\FreelancerBid::STATUS_SHORTLISTED,

                                \App\Models\FreelancerBid::STATUS_INTERVIEW,

                            ]))

                                <form
                                    action="{{ route('employer.bids.proceed', $bid->id) }}"
                                    method="POST"
                                    style="display:inline;"
                                    onsubmit="return confirm('Are you sure you want to proceed with this freelancer?');"
                                >

                                    @csrf

                                    <button
                                        type="submit"
                                        class="btn btn-proceed"
                                    >

                                        <i class="fa-solid fa-check"></i>

                                        Proceed

                                    </button>

                                </form>


                                <form
                                    action="{{ route('employer.bids.reject', $bid->id) }}"
                                    method="POST"
                                    style="display:inline;"
                                    onsubmit="return confirm('Are you sure you want to reject this bid?');"
                                >

                                    @csrf

                                    <button
                                        type="submit"
                                        class="btn btn-reject"
                                    >

                                        <i class="fa-solid fa-xmark"></i>

                                        Reject

                                    </button>

                                </form>

                            @elseif($status === \App\Models\FreelancerBid::STATUS_ACCEPTED)

                                <span class="btn btn-proceed">

                                    <i class="fa-solid fa-check"></i>

                                    Accepted

                                </span>

                            @elseif($status === \App\Models\FreelancerBid::STATUS_REJECTED)

                                <span class="btn btn-reject">

                                    <i class="fa-solid fa-xmark"></i>

                                    Rejected

                                </span>

                            @endif

                        </div>

                    </div>

                </div>

            @endforeach

        </div>


        {{-- Pagination --}}

        <div class="pagination-wrap">
            {{ $bids->links() }}
        </div>


    @else

        <div class="empty-state">

            <div class="empty-icon">
                <i class="fa-solid fa-users"></i>
            </div>

            <h3>No Freelancer Bids</h3>

            <p>
                No freelancers have submitted bids for this project yet.
            </p>

        </div>

    @endif

</div>

@endsection
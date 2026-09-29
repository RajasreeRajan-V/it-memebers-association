{{-- resources/views/employers/freelance-bid/index.blade.php --}}

@extends('layouts.app')

@section('content')

    <style>
        .bids-page {
            max-width: 1400px;
            margin: 0 auto;
            padding: 35px 25px 60px;
            font-family: "Inter", "Segoe UI", system-ui, sans-serif;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 28px;
        }

        .page-title-wrap h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
            color: #172033;
        }

        .page-title-wrap p {
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
            transition: 0.2s ease;
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

        .project-info h2 {
            margin: 0;
            color: #172033;
            font-size: 18px;
            font-weight: 700;
        }

        .project-info h2 a {
            color: inherit;
            text-decoration: none;
        }

        .project-info h2 a:hover {
            color: #3364d7;
        }

        .bid-id {
            margin-top: 6px;
            color: #9ca3af;
            font-size: 12px;
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

        .status-processed {
            background: #ecfeff;
            color: #0e7490;
        }

        /* Card body */
        .bid-card-body {
            padding: 22px;
        }

        .freelancer {
            display: flex;
            align-items: center;
            gap: 13px;
            margin-bottom: 22px;
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

        .cover-letter {
            margin-bottom: 20px;
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
            justify-content: flex-end;
            gap: 8px;
            flex-wrap: wrap;
        }

        .actions form {
            margin: 0;
            display: inline-flex !important;
        }

        .actions .btn {
            white-space: nowrap;
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
            transition: 0.2s ease;
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
            .bids-page {
                padding: 25px 15px 45px;
            }

            .page-header {
                align-items: flex-start;
            }

            .page-title-wrap h1 {
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

        .rejection-modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.55);
            z-index: 9999;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .rejection-modal.show {
            display: flex;
        }

        .rejection-modal-content {
            width: 100%;
            max-width: 600px;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.18);
            overflow: hidden;
            animation: rejectionModalIn 0.2s ease;
        }

        @keyframes rejectionModalIn {
            from {
                opacity: 0;
                transform: translateY(10px) scale(0.98);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .rejection-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
            padding: 22px 24px;
            border-bottom: 1px solid #eef0f4;
        }

        .rejection-modal-header h3 {
            margin: 0;
            color: #172033;
            font-size: 19px;
            font-weight: 700;
        }

        .rejection-modal-header p {
            margin: 6px 0 0;
            color: #6b7280;
            font-size: 13px;
        }

        .rejection-close {
            width: 34px;
            height: 34px;
            border: none;
            border-radius: 8px;
            background: #f3f4f6;
            color: #4b5563;
            font-size: 22px;
            cursor: pointer;
            line-height: 1;
        }

        .rejection-close:hover {
            background: #e5e7eb;
        }

        .rejection-modal-body {
            padding: 24px;
        }

        .rejection-info {
            margin-bottom: 18px;
            color: #374151;
            font-size: 14px;
        }

        .rejection-comment-box {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 12px;
            padding: 18px;
        }

        .rejection-comment-title {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 10px;
            color: #b91c1c;
            font-size: 13px;
            font-weight: 700;
        }

        .rejection-comment-text {
            color: #4b5563;
            font-size: 14px;
            line-height: 1.7;
            white-space: pre-line;
        }

        .rejection-modal-footer {
            padding: 16px 24px;
            background: #fafbfc;
            border-top: 1px solid #eef0f4;
            display: flex;
            justify-content: flex-end;
        }
    </style>


    <div class="bids-page">

        {{-- Page Header --}}
        <div class="page-header">
            <div class="page-title-wrap">
                <h1>Freelancer Bids</h1>
                <p>Review and manage bids received for your projects.</p>
            </div>

            <div class="bid-count">
                {{ $bids->total() }} {{ $bids->total() == 1 ? 'Bid' : 'Bids' }}
            </div>
        </div>


        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert alert-success">
                <i class="fa-solid fa-circle-check"></i>
                {{ session('success') }}
            </div>
        @endif


        {{-- Error Message --}}
        @if (session('error'))
            <div class="alert alert-error">
                <i class="fa-solid fa-circle-exclamation"></i>
                {{ session('error') }}
            </div>
        @endif

        {{-- Bids --}}
        @if ($bids->count())
            <div class="bids-grid">

                @foreach ($bids as $bid)
                    {{-- Bid Card --}}
                    <div class="bid-card">

                        {{-- Card Header --}}
                        <div class="bid-card-header">

                            <div class="project-info">
                                <h2>
                                    {{ $bid->project?->title ?? 'Project' }}
                                </h2>

                                <div class="bid-id">
                                    Bid #{{ $bid->id }}
                                </div>
                            </div>

                            <span class="status status-{{ $bid->status }}">
                                <i class="fa-solid fa-circle" style="font-size: 7px;"></i>
                                {{ ucfirst($bid->status) }}
                            </span>

                        </div>


                        {{-- Card Body --}}
                        <div class="bid-card-body">

                            {{-- Freelancer --}}
                            <div class="freelancer">

                                <div class="freelancer-avatar">
                                    {{ strtoupper(substr($bid->freelancer?->user?->name ?? 'F', 0, 1)) }}
                                </div>

                                <div class="freelancer-info">

                                    <h3>
                                        {{ $bid->freelancer?->user?->name ?? 'Freelancer' }}
                                    </h3>

                                    <p>
                                        {{ $bid->freelancer?->user?->email ?? 'No email available' }}
                                    </p>

                                </div>

                            </div>


                            {{-- Bid Details --}}
                            <div class="details-grid">

                                <div class="detail-box">

                                    <div class="detail-label">
                                        Bid Amount
                                    </div>

                                    <div class="detail-value amount">
                                        ₹{{ number_format((float) $bid->bid_amount, 2) }}
                                    </div>

                                </div>


                                <div class="detail-box">

                                    <div class="detail-label">
                                        Estimated Days
                                    </div>

                                    <div class="detail-value">
                                        {{ $bid->estimated_days ?? 'N/A' }}
                                        {{ $bid->estimated_days ? 'Days' : '' }}
                                    </div>

                                </div>


                                <div class="detail-box">

                                    <div class="detail-label">
                                        Project
                                    </div>

                                    <div class="detail-value">
                                        {{ $bid->project?->title ?? 'N/A' }}
                                    </div>

                                </div>


                                <div class="detail-box">

                                    <div class="detail-label">
                                        Status
                                    </div>

                                    <div class="detail-value">
                                        {{ ucfirst($bid->status) }}
                                    </div>

                                </div>

                            </div>


                            {{-- Cover Letter --}}
                            <div class="cover-letter">

                                <div class="cover-letter-title">
                                    Cover Letter
                                </div>

                                <div class="cover-letter-text">
                                    {{ $bid->cover_letter ?? 'No cover letter provided.' }}
                                </div>

                            </div>

                        </div>


                        {{-- Card Footer --}}
                        <div class="bid-card-footer">

                            <div class="submitted">
                                Submitted
                                {{ $bid->created_at?->format('d M Y, h:i A') }}
                            </div>


                            <div class="actions">

                                {{-- View / Proceed --}}
                                <a href="{{ route('employer.bids.show', $bid) }}" class="btn btn-view">
                                    <i class="fa-solid fa-eye"></i>
                                    View
                                </a>


{{-- Employer Actions --}}
@if (in_array($bid->status, [
        \App\Models\FreelancerBid::STATUS_PENDING,
        \App\Models\FreelancerBid::STATUS_SHORTLISTED,
        \App\Models\FreelancerBid::STATUS_INTERVIEW,
    ]))

    {{-- Proceed / Accept --}}
    <form action="{{ route('employer.bids.proceed', $bid) }}"
        method="POST"
        style="display:inline;"
        onsubmit="return confirm('Are you sure you want to accept this freelancer bid and proceed with the project?');">

        @csrf
        @method('PATCH')

        <button type="submit" class="btn btn-proceed">
            <i class="fa-solid fa-check"></i>
            Proceed
        </button>
    </form>


    {{-- Reject Bid --}}
    <form action="{{ route('employer.bids.reject', $bid) }}"
        method="POST"
        style="display:inline;"
        onsubmit="return confirm('Are you sure you want to reject this freelancer bid? This action cannot be undone.');">

        @csrf
        @method('PATCH')

        <button type="submit" class="btn btn-reject">
            <i class="fa-solid fa-xmark"></i>
            Reject
        </button>
    </form>


@elseif($bid->status === \App\Models\FreelancerBid::STATUS_REJECTED)

    {{-- View Rejection Reason --}}
    <button type="button"
        class="btn btn-reject"
        onclick="openRejectionModal({{ $bid->id }})">

        <i class="fa-solid fa-message"></i>
        View Reason
    </button>


@elseif($bid->status === \App\Models\FreelancerBid::STATUS_ACCEPTED)

    {{-- Already Accepted --}}
    <span class="btn btn-proceed">
        <i class="fa-solid fa-check-circle"></i>
        Accepted
    </span>


@elseif($bid->status === \App\Models\FreelancerBid::STATUS_WITHDRAWN)

    {{-- Withdrawn by Freelancer --}}
    <span class="btn"
        style="
            background:#f3f4f6;
            color:#6b7280;
            cursor:not-allowed;
        ">

        <i class="fa-solid fa-ban"></i>
        Withdrawn
    </span>

@else

    {{-- Awaiting Review --}}
    <span class="btn"
        style="
            background:#f3f4f6;
            color:#6b7280;
            cursor:not-allowed;
        ">

        <i class="fa-solid fa-clock"></i>
        Awaiting Review
    </span>

@endif



                            </div>

                        </div>

                    </div>


                    {{-- Rejection Modal --}}
                    @if ($bid->status === \App\Models\FreelancerBid::STATUS_REJECTED)
                        <div id="rejectionModal{{ $bid->id }}" class="rejection-modal"
                            onclick="closeRejectionModal({{ $bid->id }}, event)">

                            <div class="rejection-modal-content">

                                <div class="rejection-modal-header">

                                    <div>
                                        <h3>Rejection Reason</h3>

                                        <p>
                                            Bid #{{ $bid->id }} —
                                            {{ $bid->project?->title ?? 'Project' }}
                                        </p>
                                    </div>

                                    <button type="button" class="rejection-close"
                                        onclick="closeRejectionModal({{ $bid->id }})">
                                        &times;
                                    </button>

                                </div>


                                <div class="rejection-modal-body">

                                    <div class="rejection-info">

                                        <strong>Freelancer:</strong>

                                        {{ $bid->freelancer?->user?->name ?? 'Freelancer' }}

                                    </div>


                                    <div class="rejection-comment-box">

                                        <div class="rejection-comment-title">

                                            <i class="fa-solid fa-message"></i>

                                            Admin Comment

                                        </div>


                                        <div class="rejection-comment-text">

                                            {{ $bid->comments ?? 'No rejection comment was provided.' }}

                                        </div>

                                    </div>

                                </div>


                                <div class="rejection-modal-footer">

                                    <button type="button" class="btn btn-view"
                                        onclick="closeRejectionModal({{ $bid->id }})">
                                        Close
                                    </button>

                                </div>

                            </div>

                        </div>
                    @endif
                @endforeach

            </div>


            {{-- Pagination --}}
            <div class="pagination-wrap">
                {{ $bids->links() }}
            </div>
        @else
            {{-- No bids --}}
            <div class="empty-state">

                <div class="empty-icon">
                    <i class="fa-solid fa-users"></i>
                </div>

                <h3>No Freelancer Bids Yet</h3>

                <p>
                    You haven't received any freelancer bids for your projects yet.
                </p>

            </div>
        @endif

    </div>
    <script>
        function openRejectionModal(id) {
            const modal = document.getElementById('rejectionModal' + id);

            if (modal) {
                modal.classList.add('show');
                document.body.style.overflow = 'hidden';
            }
        }

        function closeRejectionModal(id, event = null) {
            if (event && event.target.id !== 'rejectionModal' + id) {
                return;
            }

            const modal = document.getElementById('rejectionModal' + id);

            if (modal) {
                modal.classList.remove('show');
                document.body.style.overflow = '';
            }
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                document.querySelectorAll('.rejection-modal.show').forEach(function(modal) {
                    modal.classList.remove('show');
                });

                document.body.style.overflow = '';
            }
        });
    </script>
@endsection

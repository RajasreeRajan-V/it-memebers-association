@extends('layouts.app')

@push('styles')
    <style>
        .jobpost-wrapper {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px 20px 80px;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            color: #1f2937;
        }

        .jobpost-header h1 {
            font-size: 1.75rem;
            font-weight: 600;
            margin: 0 0 4px;
            color: #111827;
        }

        .jobpost-header p {
            font-size: 0.9rem;
            color: #6b7280;
            margin: 0 0 32px;
        }

        .jobpost-alert {
            border-radius: 10px;
            padding: 16px;
            margin-bottom: 24px;
        }

        .jobpost-alert-success {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #166534;
        }

        .jobpost-alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
        }

        .jobpost-alert-title {
            font-size: 0.875rem;
            font-weight: 600;
            color: #991b1b;
            margin: 0 0 8px;
        }

        .jobpost-alert-error ul {
            margin: 0;
            padding-left: 18px;
            color: #b91c1c;
            font-size: 0.85rem;
        }

        .jobpost-form {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 32px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
        }

        .jobpost-back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.85rem;
            font-weight: 600;
            color: #64748b;
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            padding: 8px 16px;
            border-radius: 999px;
            text-decoration: none;
            margin-bottom: 24px;
            transition: all 0.2s ease;
        }

        .jobpost-back:hover {
            color: #2563eb;
            background: #eff6ff;
            border-color: #bfdbfe;
        }

        .bid-freelancer-card {
            display: flex;
            align-items: center;
            gap: 16px;
            background: #f9fafb;
            border: 1px solid #f3f4f6;
            border-radius: 10px;
            padding: 20px;
            margin-top: 24px;
        }

        .bid-freelancer-avatar {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            object-fit: cover;
            background: #e5e7eb;
            flex-shrink: 0;
        }

        .bid-freelancer-info h3 {
            margin: 0 0 4px;
            font-size: 1rem;
            font-weight: 600;
            color: #111827;
        }

        .bid-freelancer-info p {
            margin: 0;
            font-size: 0.82rem;
            color: #6b7280;
        }

        .bid-freelancer-links {
            margin-top: 6px;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .bid-freelancer-links a {
            font-size: 0.78rem;
            color: #4f46e5;
            text-decoration: none;
        }

        .bid-freelancer-links a:hover {
            text-decoration: underline;
        }

        .bid-meta-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            margin-top: 24px;
        }

        .bid-meta-item label {
            display: block;
            font-size: 0.85rem;
            font-weight: 500;
            color: #374151;
            margin-bottom: 6px;
        }

        .bid-meta-value {
            font-size: 0.95rem;
            color: #111827;
            font-weight: 600;
        }

        .bid-cover-letter {
            margin-top: 24px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 14px;
            font-size: 0.88rem;
            line-height: 1.6;
            color: #1f2937;
            background: #fff;
            white-space: pre-line;
        }

        .bid-status-badge {
            display: inline-block;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 999px;
            text-transform: capitalize;
        }

        .bid-status-pending {
            background: #fef9c3;
            color: #854d0e;
        }

        .bid-status-shortlisted {
            background: #dbeafe;
            color: #1e40af;
        }

        .bid-status-interview {
            background: #ede9fe;
            color: #5b21b6;
        }

        .bid-status-accepted {
            background: #dcfce7;
            color: #166534;
        }

        .bid-status-rejected {
            background: #fee2e2;
            color: #991b1b;
        }

        .bid-status-withdrawn {
            background: #f3f4f6;
            color: #4b5563;
        }

        .jobpost-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            padding-top: 20px;
            margin-top: 28px;
            border-top: 1px solid #f3f4f6;
        }

        .jobpost-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 500;
            padding: 10px 20px;
            cursor: pointer;
            border: none;
            text-decoration: none;
            transition: background-color 0.15s ease;
        }

        .jobpost-btn-secondary {
            background: transparent;
            color: #4b5563;
            border: 1px solid #d1d5db;
        }

        .jobpost-btn-secondary:hover {
            background: #f3f4f6;
            color: #1f2937;
        }

        .jobpost-btn-primary {
            background: #4f46e5;
            color: #ffffff;
        }

        .jobpost-btn-primary:hover {
            background: #4338ca;
        }

        .jobpost-btn-danger {
            background: #dc2626;
            color: #ffffff;
        }

        .jobpost-btn-danger:hover {
            background: #b91c1c;
        }

        .bid-notice {
            margin-top: 20px;
            font-size: 0.82rem;
            color: #9ca3af;
            background: #f9fafb;
            border: 1px dashed #e5e7eb;
            border-radius: 8px;
            padding: 12px 14px;
        }

        @media (max-width: 640px) {
            .jobpost-form {
                padding: 20px;
            }

            .bid-meta-grid {
                grid-template-columns: 1fr;
            }

            .bid-freelancer-card {
                flex-direction: column;
                align-items: flex-start;
            }

            .jobpost-actions {
                flex-direction: column;
            }

            .jobpost-btn {
                width: 100%;
            }
        }
    </style>
@endpush

@section('content')

    <div class="jobpost-wrapper">


        <a href="{{ route('employer.bids.index', $bid->project_id) }}" class="jobpost-back">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M15 18l-6-6 6-6" />
            </svg>
            Back to bids
        </a>

        <div class="jobpost-header">
            <h1>Bid on "{{ $bid->project->title }}"</h1>
            <p>Review the freelancer's proposal before proceeding.</p>
        </div>

        @if (session('success'))
            <div class="jobpost-alert jobpost-alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="jobpost-alert jobpost-alert-error">
                <p class="jobpost-alert-title">Unable to proceed</p>
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="jobpost-alert jobpost-alert-error">
                <p class="jobpost-alert-title">There was a problem</p>

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="jobpost-form">

            {{-- Freelancer --}}
            <div class="bid-freelancer-card">

                <img src="{{ $bid->freelancer->profile_photo
                    ? asset('storage/' . $bid->freelancer->profile_photo)
                    : asset('images/default-avatar.png') }}"
                    alt="{{ $bid->freelancer->user->name ?? 'Freelancer' }}" class="bid-freelancer-avatar">

                <div class="bid-freelancer-info">

                    <h3>
                        {{ $bid->freelancer->user->name ?? 'Freelancer' }}
                    </h3>

                    <p>
                        {{ $bid->freelancer->specialization ?? 'Freelancer' }}

                        @if ($bid->freelancer->experience)
                            &middot; {{ $bid->freelancer->experience }} yrs experience
                        @endif

                        @if ($bid->freelancer->hourly_rate)
                            &middot; ${{ number_format($bid->freelancer->hourly_rate, 2) }}/hr
                        @endif
                    </p>

                    <div class="bid-freelancer-links">

                        @if ($bid->freelancer->portfolio_link)
                            <a href="{{ $bid->freelancer->portfolio_link }}" target="_blank" rel="noopener">
                                Portfolio
                            </a>
                        @endif

                        @if ($bid->freelancer->github)
                            <a href="{{ $bid->freelancer->github }}" target="_blank" rel="noopener">
                                GitHub
                            </a>
                        @endif

                        @if ($bid->freelancer->linkedin)
                            <a href="{{ $bid->freelancer->linkedin }}" target="_blank" rel="noopener">
                                LinkedIn
                            </a>
                        @endif

                        @if ($bid->freelancer->resume)
                            <a href="{{ asset('storage/' . $bid->freelancer->resume) }}" target="_blank" rel="noopener">
                                Resume
                            </a>
                        @endif

                    </div>

                </div>
            </div>

            {{-- Bid details --}}
            <div class="bid-meta-grid">

                <div class="bid-meta-item">
                    <label>Bid Amount</label>

                    <div class="bid-meta-value">
                        ${{ number_format($bid->bid_amount, 2) }}
                    </div>
                </div>

                <div class="bid-meta-item">
                    <label>Estimated Days</label>

                    <div class="bid-meta-value">
                        {{ $bid->estimated_days }}
                        day{{ $bid->estimated_days == 1 ? '' : 's' }}
                    </div>
                </div>

                <div class="bid-meta-item">
                    <label>Status</label>

                    <span class="bid-status-badge bid-status-{{ $bid->status }}">
                        {{ str_replace('_', ' ', $bid->status) }}
                    </span>
                </div>

                <div class="bid-meta-item">
                    <label>Submitted</label>

                    <div class="bid-meta-value">
                        {{ $bid->created_at->format('M d, Y') }}
                    </div>
                </div>

            </div>

            {{-- Cover Letter --}}
            <div class="jobpost-form-group" style="margin-top:24px;">

                <label>Cover Letter</label>

                <div class="bid-cover-letter">
                    {{ $bid->cover_letter ?: 'No cover letter provided.' }}
                </div>

            </div>

            {{-- Additional comments --}}
            @if ($bid->comments)
                <div class="jobpost-form-group">

                    <label>Additional Comments</label>

                    <div class="bid-cover-letter">
                        {{ $bid->comments }}
                    </div>

                </div>
            @endif

            {{-- IMPORTANT: Only project owner --}}
            @if (auth()->id() === $bid->project->employer_id)
                @if (in_array($bid->status, [
                        \App\Models\FreelancerBid::STATUS_PENDING,
                        \App\Models\FreelancerBid::STATUS_SHORTLISTED,
                        \App\Models\FreelancerBid::STATUS_INTERVIEW,
                    ]))
                    <div class="jobpost-actions">

                        {{-- Reject --}}
                        <form action="{{ route('employer.bids.reject', $bid->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to reject this bid?');">
                            @csrf

                            <button type="submit" class="jobpost-btn jobpost-btn-secondary">
                                Reject
                            </button>
                        </form>

                        {{-- Proceed --}}
                        <form action="{{ route('employer.bids.proceed', $bid->id) }}" method="POST"
                            onsubmit="return confirm('Proceed with this freelancer? This will accept the bid.');">
                            @csrf

                            <button type="submit" class="jobpost-btn jobpost-btn-primary">
                                Proceed with this Freelancer
                            </button>
                        </form>

                    </div>
                @else
                    <div class="bid-notice">
                        This bid has been
                        <strong>{{ ucfirst(str_replace('_', ' ', $bid->status)) }}</strong>
                        by the admin.
                        You can now proceed with the freelancer or reject this bid.
                    </div>
                @endif
            @else
                <div class="bid-notice">
                    Only the employer who posted this project can proceed with this bid.
                </div>
            @endif

        </div>


    </div>

@endsection

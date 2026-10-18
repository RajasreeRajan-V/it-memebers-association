@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/freelancer/_work-styles.css') }}">

<div class="container work-page">

    <div class="page-heading">
        <h1>Hired Projects</h1>
        <p>Projects where your proposal was accepted and you have sent the signed contract.</p>
    </div>

    <div class="work-nav">
        <a href="{{ route('freelancer.saved-jobs') }}">Saved</a>
        <a href="{{ route('freelancer.applied') }}">Applied</a>
        <a href="{{ route('freelancer.proposals') }}">Proposals</a>
        <a href="{{ route('freelancer.in-progress') }}">In Progress</a>
        <a href="{{ route('freelancer.hired') }}" class="active">Hired</a>
        <a href="{{ route('freelancer.archived') }}">Archived</a>
    </div>

    @forelse($proposals as $bid)
        @php
            $project  = $bid->project;
            $employer = $project?->employer ?? $bid->employer;
            $bidNo    = $bid->bid_number ?? $bid->id;
            $days     = $bid->estimated_days;
        @endphp

        <div class="ip-card">

            <div class="ip-card__head">
                <div>
                    <h3>{{ $project->title ?? 'Untitled Project' }}</h3>
                    <small>Bid #{{ $bidNo }} · Submitted {{ $bid->created_at->format('M d, Y') }}</small>
                </div>
                <span class="ip-badge">
                    <i class="bi bi-patch-check-fill"></i> Hired
                </span>
            </div>

            <div class="ip-grid">
                <div>
                    <span class="ip-label">Your Bid Amount</span>
                    <span class="ip-amount">₹{{ number_format((float) $bid->bid_amount, 2) }}</span>
                </div>

                <div>
                    <span class="ip-label">Estimated Duration</span>
                    <span>{{ $days ? $days . (is_numeric($days) ? ' days' : '') : 'Not specified' }}</span>
                </div>

                <div>
                    <span class="ip-label">Signed Contract Sent</span>
                    <span>{{ optional($bid->signed_contract_received_at)->format('M d, Y H:i') ?? '—' }}</span>
                </div>

                <div>
                    <span class="ip-label">Employer</span>
                    <span>{{ $employer->name ?? 'Unknown' }}</span>
                    @if (!empty($employer?->email))
                        <small><i class="bi bi-envelope"></i> {{ $employer->email }}</small>
                    @endif
                </div>
            </div>

            <div class="ip-block ip-contract">
                <span class="ip-label"><i class="bi bi-file-earmark-text"></i> Contract Documents</span>

                <div class="ip-contract__row">
                    <div class="ip-contract__info">
                        <strong>Contract from Employer</strong>
                        <small>
                            {{ basename($bid->contract_document) }}
                            @if ($bid->contract_sent_at)
                                · Sent {{ $bid->contract_sent_at->format('M d, Y H:i') }}
                            @endif
                        </small>
                    </div>
                    <a href="{{ route('freelancer.contract.download', [$bid->id, 'contract']) }}"
                       target="_blank" rel="noopener" class="ip-btn">
                        <i class="bi bi-download"></i> View / Download
                    </a>
                </div>

                <div class="ip-contract__row">
                    <div class="ip-contract__info">
                        <strong>Your Signed Contract</strong>
                        <small>{{ basename($bid->signed_contract_document) }}</small>
                    </div>
                    <a href="{{ route('freelancer.contract.download', [$bid->id, 'signed']) }}"
                       target="_blank" rel="noopener" class="ip-btn">
                        <i class="bi bi-download"></i> View / Download
                    </a>
                </div>
            </div>

        </div>

    @empty

        <div class="empty-state">
            <div class="empty-icon"><i class="bi bi-check-circle"></i></div>
            <h3>No Hired Projects</h3>
            <p>Projects will appear here once you have sent the signed contract to the employer.</p>
        </div>

    @endforelse

    @if($proposals->hasPages())
        <div class="pagination-wrapper">
            {{ $proposals->links() }}
        </div>
    @endif

</div>

@endsection
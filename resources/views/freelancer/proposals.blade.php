@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/freelancer/_work-styles.css') }}">

    <div class="container work-page">

        <div class="page-heading">
            <h1>My Proposals</h1>
            <p>Manage and track all the proposals you have submitted.</p>
        </div>

        <div class="work-nav">

            <a href="{{ route('freelancer.saved-jobs') }}">
                Saved
            </a>

            <a href="{{ route('freelancer.applied') }}">
                Applied
            </a>

            <a href="{{ route('freelancer.proposals') }}" class="active">
                Proposals
            </a>

            <a href="{{ route('freelancer.interviews') }}">
                Interviews
            </a>

            <a href="{{ route('freelancer.in-progress') }}">
                In Progress
            </a>

            <a href="{{ route('freelancer.hired') }}">
                Hired
            </a>

            <a href="{{ route('freelancer.archived') }}">
                Archived
            </a>

        </div>


        @forelse($proposals as $proposal)
            @php
                $project = $proposal->project;

                $employer = $project?->employer;

                $registration = $employer?->employerRegistration;

                $companyName =
                    $registration?->company_name ?? ($employer?->company_name ?? ($employer?->name ?? 'Company'));
            @endphp


            <div class="work-card">

                {{-- Header --}}
                <div class="work-card-header">

                    <div class="company-logo">
                        {{ strtoupper(substr($companyName, 0, 1)) }}
                    </div>

                    <div class="flex-grow-1">

                        <h3 class="job-title">
                            {{ $project?->title ?? 'Untitled Project' }}
                        </h3>

                        <div class="company-name">
                            {{ $companyName }}
                        </div>

                    </div>


                    @if ($proposal->status)
                        <span class="status-badge status-{{ strtolower(str_replace('_', '-', $proposal->status)) }}">
                            {{ ucwords(str_replace('_', ' ', $proposal->status)) }}
                        </span>
                    @endif

                </div>


                {{-- Proposal / Bid Description --}}
                @if ($proposal->proposal)
                    <div class="job-description">

                        <strong>Your Proposal</strong>

                        <p>
                            {{ Str::limit($proposal->proposal, 250) }}
                        </p>

                    </div>
                @elseif($proposal->cover_letter)
                    <div class="job-description">

                        <strong>Your Cover Letter</strong>

                        <p>
                            {{ Str::limit($proposal->cover_letter, 250) }}
                        </p>

                    </div>
                @endif


                {{-- BID DATA --}}
                <div class="job-meta">

                    @if ($proposal->bid_amount)
                        <div class="meta-item">

                            <i class="bi bi-currency-rupee"></i>

                            <span>
                                <strong>Your Bid</strong>
                                ₹{{ number_format((float) $proposal->bid_amount) }}
                            </span>

                        </div>
                    @endif


                    @if ($proposal->estimated_delivery)
                        <div class="meta-item">

                            <i class="bi bi-calendar-check"></i>

                            <span>
                                <strong>Delivery</strong>
                                {{ $proposal->estimated_delivery }}
                            </span>

                        </div>
                    @endif


                    <div class="meta-item">

                        <i class="bi bi-clock"></i>

                        <span>
                            <strong>Submitted</strong>
                            {{ $proposal->created_at?->diffForHumans() }}
                        </span>

                    </div>

                </div>


         
                {{-- Proposal Actions --}}
                <div class="work-card-footer">

                    <div>
                        <span class="text-muted small">
                            Proposal #{{ $proposal->id }}
                        </span>
                    </div>

                    <div class="d-flex gap-2">

                        {{-- Edit only while proposal is pending --}}
                        @if (strtolower($proposal->status) === 'pending')
                            <a href="{{ route('freelancer.bid.edit', $project->id) }}"
                                class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-pencil-square"></i>
                                Edit Proposal
                            </a>
                        @endif



                    </div>

                </div>
            


            </div>


        @empty

            <div class="empty-state">

                <div class="empty-icon">
                    <i class="bi bi-file-earmark-text"></i>
                </div>

                <h3>No Proposals Yet</h3>

                <p>
                    Your submitted proposals will appear here.
                </p>

            </div>
        @endforelse


        @if ($proposals->hasPages())
            <div class="pagination-wrapper">
                {{ $proposals->links() }}
            </div>
        @endif

    </div>
@endsection

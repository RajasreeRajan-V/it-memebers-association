
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

            /*
             * The proposal is the FreelancerBid record.
             * The project is only used for related job information.
             */

            $project = $proposal->project;

            $employer = $project?->employer;

            $registration = $employer?->employerRegistration;


            $companyName =
                $registration?->company_name ??
                $employer?->company_name ??
                $employer?->name ??
                'Company';


            $projectTitle =
                $project?->title ??
                'Untitled Project';

        @endphp


        <div class="work-card">


            {{-- =========================
                 PROPOSAL HEADER
            ========================== --}}

            <div class="work-card-header">

                <div class="company-logo">
                    {{ strtoupper(substr($companyName, 0, 1)) }}
                </div>


                <div class="flex-grow-1">

                    <h3 class="job-title">
                        {{ $projectTitle }}
                    </h3>

                    <div class="company-name">
                        {{ $companyName }}

                        @if($registration?->is_verified)
                            <i class="bi bi-patch-check-fill verified-icon"></i>
                        @endif
                    </div>

                </div>


                {{-- Proposal Status --}}

                @if($proposal->status)

                    <span class="status-badge status-{{ strtolower(str_replace('_', '-', $proposal->status)) }}">

                        {{ ucwords(str_replace('_', ' ', $proposal->status)) }}

                    </span>

                @endif

            </div>



            {{-- =========================
                 PROPOSAL DETAILS
            ========================== --}}

            <div class="proposal-details">

                <h4 class="mb-3">
                    Your Proposal
                </h4>


                <div class="job-meta">


                    {{-- Bid Amount --}}

                    @if($proposal->bid_amount)

                        <div class="meta-item">

                            <i class="bi bi-currency-rupee"></i>

                            <span>
                                <strong>Your Bid</strong>
                                ₹{{ number_format((float) $proposal->bid_amount) }}
                            </span>

                        </div>

                    @endif



                    {{-- Estimated Delivery --}}

                    @if($proposal->estimated_delivery)

                        <div class="meta-item">

                            <i class="bi bi-calendar-check"></i>

                            <span>
                                <strong>Estimated Delivery</strong>
                                {{ $proposal->estimated_delivery }}
                            </span>

                        </div>

                    @endif



                    {{-- Submitted Date --}}

                    <div class="meta-item">

                        <i class="bi bi-clock"></i>

                        <span>
                            <strong>Submitted</strong>
                            {{ $proposal->created_at?->diffForHumans() }}
                        </span>

                    </div>


                </div>

            </div>



            {{-- =========================
                 PROPOSAL MESSAGE
            ========================== --}}

            @if(!empty($proposal->proposal))

                <div class="proposal-message">

                    <h4>
                        Proposal Message
                    </h4>

                    <p>
                        {{ $proposal->proposal }}
                    </p>

                </div>

            @elseif(!empty($proposal->cover_letter))

                <div class="proposal-message">

                    <h4>
                        Cover Letter
                    </h4>

                    <p>
                        {{ $proposal->cover_letter }}
                    </p>

                </div>

            @endif



            {{-- =========================
                 PROJECT INFORMATION
            ========================== --}}

            @if($project)

                <div class="proposal-project">

                    <h4>
                        Project
                    </h4>

                    <p class="job-description">

                        {{ Str::limit($project->description ?? '', 200) }}

                    </p>

                </div>

            @endif



            {{-- =========================
                 FOOTER
            ========================== --}}

            <div class="work-card-footer">

                <div></div>

                <a href="{{ url('/freelancer/projects/' . $project?->id) }}"
                   class="view-job-btn">

                    View Project

                    <i class="bi bi-arrow-right"></i>

                </a>

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



    @if($proposals->hasPages())

        <div class="pagination-wrapper">

            {{ $proposals->links() }}

        </div>

    @endif


</div>

@endsection


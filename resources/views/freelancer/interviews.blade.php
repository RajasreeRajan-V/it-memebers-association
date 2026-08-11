@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/freelancer/_work-styles.css') }}">

<div class="container work-page">

    <div class="page-heading">
        <h1>Interviews</h1>
        <p>View projects where you have been shortlisted or invited for an interview.</p>
    </div>

    <div class="work-nav">

        <a href="{{ route('freelancer.saved-jobs') }}">Saved</a>
        <a href="{{ route('freelancer.applied') }}">Applied</a>
        <a href="{{ route('freelancer.proposals') }}">Proposals</a>

        <a href="{{ route('freelancer.interviews') }}" class="active">
            Interviews
        </a>

        <a href="{{ route('freelancer.in-progress') }}">In Progress</a>
        <a href="{{ route('freelancer.hired') }}">Hired</a>
        <a href="{{ route('freelancer.archived') }}">Archived</a>

    </div>


    @forelse($proposals as $proposal)

        @include('freelancer.partials.work-card', [
            'item' => $proposal
        ])

    @empty

        <div class="empty-state">

            <div class="empty-icon">
                <i class="bi bi-camera-video"></i>
            </div>

            <h3>No Interviews</h3>

            <p>
                Interview invitations and shortlisted projects will appear here.
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
@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/freelancer/_work-styles.css') }}">

<div class="container work-page">

    <div class="page-heading">
        <h1>Saved Jobs</h1>
        <p>Jobs you've saved to review or apply later.</p>
    </div>

    <div class="work-nav">

        <a href="{{ route('freelancer.saved-jobs') }}" class="active">
            <i class="bi bi-bookmark me-1"></i>
            Saved
        </a>

        <a href="{{ route('freelancer.applied') }}">
            Applied
        </a>

        <a href="{{ route('freelancer.proposals') }}">
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


    @forelse($savedJobs as $savedJob)

        @include('freelancer.partials.work-card', [
            'item' => $savedJob
        ])

    @empty

        <div class="empty-state">

            <div class="empty-icon">
                <i class="bi bi-bookmark"></i>
            </div>

            <h3>No Saved Jobs</h3>

            <p>
                Jobs you save will appear here.
            </p>

        </div>

    @endforelse


    @if($savedJobs->hasPages())
        <div class="pagination-wrapper">
            {{ $savedJobs->links() }}
        </div>
    @endif

</div>

@endsection
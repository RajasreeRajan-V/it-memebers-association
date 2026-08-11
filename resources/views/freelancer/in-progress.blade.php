@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/freelancer/_work-styles.css') }}">

<div class="container work-page">

    <div class="page-heading">
        <h1>In Progress</h1>
        <p>Projects that you have accepted and are currently working on.</p>
    </div>

    <div class="work-nav">

        <a href="{{ route('freelancer.saved-jobs') }}">Saved</a>
        <a href="{{ route('freelancer.applied') }}">Applied</a>
        <a href="{{ route('freelancer.proposals') }}">Proposals</a>
        <a href="{{ route('freelancer.interviews') }}">Interviews</a>

        <a href="{{ route('freelancer.in-progress') }}" class="active">
            In Progress
        </a>

        <a href="{{ route('freelancer.hired') }}">Hired</a>
        <a href="{{ route('freelancer.archived') }}">Archived</a>

    </div>


    @forelse($proposals as $proposal)

        @include('freelancer.partials/work-card', [
            'item' => $proposal
        ])

    @empty

        <div class="empty-state">

            <div class="empty-icon">
                <i class="bi bi-hourglass-split"></i>
            </div>

            <h3>No Active Projects</h3>

            <p>
                Projects currently in progress will appear here.
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
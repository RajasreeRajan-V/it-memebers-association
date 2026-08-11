@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/freelancer/_work-styles.css') }}">

<div class="container work-page">

    <div class="page-heading">
        <h1>Applied Jobs</h1>
        <p>Track the projects you have applied for.</p>
    </div>

    <div class="work-nav">

        <a href="{{ route('freelancer.saved-jobs') }}">Saved</a>

        <a href="{{ route('freelancer.applied') }}" class="active">
            Applied
        </a>

        <a href="{{ route('freelancer.proposals') }}">Proposals</a>

        <a href="{{ route('freelancer.interviews') }}">Interviews</a>

        <a href="{{ route('freelancer.in-progress') }}">In Progress</a>

        <a href="{{ route('freelancer.hired') }}">Hired</a>

        <a href="{{ route('freelancer.archived') }}">Archived</a>

    </div>


    @forelse($projects as $project)

        @include('freelancer.partials.work-card', [
            'item' => $project
        ])

    @empty

        <div class="empty-state">

            <div class="empty-icon">
                <i class="bi bi-send"></i>
            </div>

            <h3>No Applied Jobs</h3>

            <p>
                Projects you apply for will appear here.
            </p>

        </div>

    @endforelse


    @if($projects->hasPages())
        <div class="pagination-wrapper">
            {{ $projects->links() }}
        </div>
    @endif

</div>

@endsection
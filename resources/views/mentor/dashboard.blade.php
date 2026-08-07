@extends('layouts.app')

@section('content')

    @include('dashboard-layouts.partials.mentor')

    <div class="container py-4">

        <div class="dashboard-header mb-4">
            <h1>Welcome back, {{ Auth::user()->name }} 👋</h1>
            <p class="text-muted">Here's what's happening with your mentorship activity.</p>
        </div>

        {{-- Quick stats --}}
        <div class="row g-3 mb-4">
            <div class="col-md-3 col-sm-6">
                <div class="card p-3 text-center shadow-sm">
                    <h3>{{ $menteeCount }}</h3>
                    <p class="text-muted mb-0">My Mentees</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card p-3 text-center shadow-sm">
                    <h3>{{ $pendingReviews }}</h3>
                    <p class="text-muted mb-0">Pending Resume Reviews</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card p-3 text-center shadow-sm">
                    <h3>{{ $upcomingWebinars }}</h3>
                    <p class="text-muted mb-0">Upcoming Webinars</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card p-3 text-center shadow-sm">
                    <h3>{{ $scheduledInterviews }}</h3>
                    <p class="text-muted mb-0">Mock Interviews Scheduled</p>
                </div>
            </div>
        </div>

        {{-- Quick actions --}}
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Quick Actions</h5>
            </div>
            <div class="card-body d-flex flex-wrap gap-2">
                <a href="{{ route('mentor.mentees.index') }}" class="btn btn-outline-primary">View Mentees</a>
                <a href="{{ route('mentor.resume-reviews.index') }}" class="btn btn-outline-primary">Resume Reviews</a>
                <a href="{{ route('mentor.webinars.create') }}" class="btn btn-outline-primary">Host a Webinar</a>
                <a href="{{ route('mentor.training-materials.create') }}" class="btn btn-outline-primary">Upload Training Material</a>
                <a href="{{ route('mentor.mock-interviews.index') }}" class="btn btn-outline-primary">Mock Interviews</a>
            </div>
        </div>

        <div class="row g-4">

            {{-- Recent mentees --}}
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Recent Mentees</h5>
                        <a href="{{ route('mentor.mentees.index') }}" class="small">View all</a>
                    </div>
                    <div class="card-body">
                        @forelse ($recentMentees as $mentee)
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span>{{ $mentee->student->name ?? 'Unknown' }}</span>
                                <a href="{{ route('mentor.mentees.show', $mentee->id) }}" class="btn btn-sm btn-light">
                                    View
                                </a>
                            </div>
                        @empty
                            <p class="text-muted mb-0">No mentees assigned yet.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Pending resume reviews --}}
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Pending Resume Reviews</h5>
                        <a href="{{ route('mentor.resume-reviews.index') }}" class="small">View all</a>
                    </div>
                    <div class="card-body">
                        @forelse ($recentResumeReviews as $review)
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span>{{ $review->student->name ?? 'Unknown' }}</span>
                                <a href="{{ route('mentor.resume-reviews.show', $review->id) }}" class="btn btn-sm btn-light">
                                    Review
                                </a>
                            </div>
                        @empty
                            <p class="text-muted mb-0">No pending reviews.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Upcoming webinars --}}
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Upcoming Webinars</h5>
                        <a href="{{ route('mentor.webinars.index') }}" class="small">View all</a>
                    </div>
                    <div class="card-body">
                        @forelse ($upcomingWebinarsList as $webinar)
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span>{{ $webinar->title }} — {{ $webinar->scheduled_date->format('M d') }}</span>
                                <a href="{{ route('mentor.webinars.edit', $webinar->id) }}" class="btn btn-sm btn-light">
                                    Edit
                                </a>
                            </div>
                        @empty
                            <p class="text-muted mb-0">No webinars scheduled.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Mock interviews --}}
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Mock Interviews</h5>
                        <a href="{{ route('mentor.mock-interviews.index') }}" class="small">View all</a>
                    </div>
                    <div class="card-body">
                        @forelse ($recentInterviews as $interview)
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span>{{ $interview->student->name ?? 'Unknown' }}</span>
                                <a href="{{ route('mentor.mock-interviews.show', $interview->id) }}" class="btn btn-sm btn-light">
                                    View
                                </a>
                            </div>
                        @empty
                            <p class="text-muted mb-0">No interviews scheduled.</p>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection
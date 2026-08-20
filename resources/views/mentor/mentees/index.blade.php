@extends('layouts.app')

@section('content')

<div class="container py-4">

    <h1 class="h4 mb-4">My Mentees</h1>

    {{-- Statistics --}}
    <div class="row g-3 mb-4">

        <div class="col-md-4">
            <div class="card p-3 text-center">
                <div class="h4 mb-0">
                    {{ $stats['active_count'] }}
                </div>
                <div class="text-muted small">
                    Active Mentees
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 text-center">
                <div class="h4 mb-0">
                    {{ $stats['pending_count'] }}
                </div>
                <div class="text-muted small">
                    Pending Requests
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 text-center">
                <div class="h4 mb-0">
                    {{ $stats['completed_count'] }}
                </div>
                <div class="text-muted small">
                    Completed Mentorships
                </div>
            </div>
        </div>

    </div>


    {{-- Tabs --}}
    <ul class="nav nav-tabs mb-3" id="menteeTabs">

        <li class="nav-item">
            <a class="nav-link active"
               data-bs-toggle="tab"
               href="#pending">

                Pending Requests
                ({{ $pendingRequests->count() }})

            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link"
               data-bs-toggle="tab"
               href="#active">

                Active Mentees
                ({{ $activeMentees->count() }})

            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link"
               data-bs-toggle="tab"
               href="#completed">

                Completed
                ({{ $completed->count() }})

            </a>
        </li>

    </ul>


    <div class="tab-content">

        {{-- ========================================================= --}}
        {{-- PENDING REQUESTS --}}
        {{-- ========================================================= --}}

        <div class="tab-pane fade show active" id="pending">

            @forelse ($pendingRequests as $req)

                <div class="card p-3 mb-3">

                    <h5>
                        {{ $req->student->name ?? 'Student' }}
                    </h5>

                    <p class="mb-1">
                        <strong>Goal:</strong>
                        {{ $req->career_goal }}
                    </p>

                    <p class="mb-1 small text-muted">
                        <strong>Skills:</strong>
                        {{ $req->current_skills ?? 'Not provided' }}
                    </p>

                    <p class="mb-1 small text-muted">

                        <strong>Preferred:</strong>

                        {{ ucfirst($req->frequency) }},

                        @if($req->preferred_days)

                            {{ collect($req->preferred_days)
                                ->map(fn($d) => ucfirst($d))
                                ->implode(', ') }}

                        @endif

                        @if($req->preferred_time)
                            {{ $req->preferred_time }}
                        @endif

                    </p>

                    @if($req->message)

                        <p class="mb-2">
                            <em>{{ $req->message }}</em>
                        </p>

                    @endif


                    <div class="d-flex gap-2 flex-wrap">

                        {{-- Profile button --}}
                        <button type="button"
                                class="btn btn-sm btn-outline-secondary"
                                disabled>

                            <i class="fa-solid fa-user me-1"></i>
                            View Profile

                        </button>


                        {{-- Accept --}}
                        <form method="POST"
                              action="{{ route('mentor.mentees.requests.accept', $req) }}">

                            @csrf

                            <button type="submit"
                                    class="btn btn-sm btn-success">

                                <i class="fa-solid fa-check me-1"></i>
                                Accept

                            </button>

                        </form>


                        {{-- Reject --}}
                        <form method="POST"
                              action="{{ route('mentor.mentees.requests.reject', $req) }}">

                            @csrf

                            <button type="submit"
                                    class="btn btn-sm btn-outline-danger">

                                <i class="fa-solid fa-xmark me-1"></i>
                                Reject

                            </button>

                        </form>

                    </div>

                </div>

            @empty

                <p class="text-muted">
                    No pending requests.
                </p>

            @endforelse

        </div>


        {{-- ========================================================= --}}
        {{-- ACTIVE MENTEES --}}
        {{-- ========================================================= --}}

        <div class="tab-pane fade" id="active">

            @forelse ($activeMentees as $mentorship)

                @php
                    $next = $mentorship->upcomingSession();
                @endphp

                <div class="card p-3 mb-3">

                    <h5>
                        {{ $mentorship->student->name ?? 'Student' }}
                    </h5>

                    <p class="mb-1">
                        {{ $mentorship->career_goal }}
                    </p>

                    <p class="mb-1">

                        Progress:
                        <strong>
                            {{ $mentorship->progress_percent }}%
                        </strong>

                    </p>


                    @if ($next)

                        <p class="mb-2 small text-muted">

                            <i class="fa-regular fa-calendar me-1"></i>

                            Next Session:

                            {{ $next->session_date->format('d M') }}

                            •
                            {{ $next->start_time }}

                        </p>

                    @endif


                    <div class="d-flex gap-2 flex-wrap">

                        <a href="{{ route('mentor.mentees.show', $mentorship) }}"
                           class="btn btn-sm btn-outline-primary">

                            <i class="fa-solid fa-eye me-1"></i>
                            View

                        </a>


                        <a href="{{ route('mentor.mentees.show', $mentorship) }}#schedule"
                           class="btn btn-sm btn-primary">

                            <i class="fa-solid fa-calendar-plus me-1"></i>
                            Schedule Session

                        </a>

                    </div>

                </div>

            @empty

                <p class="text-muted">
                    No active mentees yet.
                </p>

            @endforelse

        </div>


        {{-- ========================================================= --}}
        {{-- COMPLETED --}}
        {{-- ========================================================= --}}

        <div class="tab-pane fade" id="completed">

            @forelse ($completed as $mentorship)

                <div class="card p-3 mb-3">

                    <h5>
                        {{ $mentorship->student->name ?? 'Student' }}
                    </h5>

                    <p class="mb-1 text-muted small">

                        Completed

                        {{ $mentorship->completed_at
                            ? $mentorship->completed_at->format('d M Y')
                            : 'N/A' }}

                    </p>


                    <a href="{{ route('mentor.mentees.show', $mentorship) }}"
                       class="btn btn-sm btn-outline-secondary">

                        <i class="fa-solid fa-eye me-1"></i>
                        View

                    </a>

                </div>

            @empty

                <p class="text-muted">
                    No completed mentorships yet.
                </p>

            @endforelse

        </div>

    </div>

</div>

@endsection
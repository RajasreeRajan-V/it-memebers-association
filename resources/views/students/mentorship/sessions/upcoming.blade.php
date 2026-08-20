@extends('layouts.app')

@section('content')

<div class="container py-4">

    {{-- PAGE HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="h3 mb-1">
                My Mentorship Sessions
            </h1>

            <p class="text-muted mb-0">
                View your upcoming and scheduled sessions with mentors.
            </p>
        </div>

    </div>


    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    {{-- ERROR MESSAGE --}}
    @if(session('error'))

        <div class="alert alert-danger">
            {{ session('error') }}
        </div>

    @endif


    {{-- TABS --}}
    <div class="mb-4">

        <a href="{{ route('student.sessions.upcoming') }}"
           class="btn btn-primary me-2">

            Upcoming Sessions

        </a>

        <a href="{{ route('student.sessions.completed') }}"
           class="btn btn-outline-secondary">

            Completed Sessions

        </a>

    </div>


    {{-- SESSIONS --}}
    @if($sessions->count())

        <div class="row g-4">

            @foreach($sessions as $session)

                <div class="col-md-6 col-lg-4">

                    <div class="card h-100 shadow-sm border-0">

                        <div class="card-body">

                            {{-- STATUS --}}
                            <div class="d-flex justify-content-between mb-3">

                                <span class="badge bg-warning text-dark">

                                    {{ ucfirst($session->status) }}

                                </span>

                                <span class="text-muted small">

                                    {{ $session->meeting_type === 'online'
                                        ? 'Online'
                                        : 'Offline' }}

                                </span>

                            </div>


                            {{-- TOPIC --}}
                            <h5 class="card-title">

                                {{ $session->topic }}

                            </h5>


                            {{-- MENTOR --}}
                            <p class="mb-2">

                                <strong>Mentor:</strong>

                                {{ $session->mentor->name ?? 'Mentor' }}

                            </p>


                            {{-- DATE --}}
                            <p class="mb-2">

                                <strong>Date:</strong>

                                {{ \Carbon\Carbon::parse($session->session_date)->format('d M Y') }}

                            </p>


                            {{-- TIME --}}
                            <p class="mb-2">

                                <strong>Time:</strong>

                                {{ \Carbon\Carbon::parse($session->start_time)->format('h:i A') }}

                            </p>


                            {{-- DURATION --}}
                            <p class="mb-2">

                                <strong>Duration:</strong>

                                {{ $session->duration_minutes }} minutes

                            </p>


                            {{-- AGENDA --}}
                            @if($session->agenda)

                                <div class="mt-3">

                                    <strong>Agenda</strong>

                                    <p class="text-muted small mt-1">
                                        {!! nl2br(e($session->agenda)) !!}
                                    </p>

                                </div>

                            @endif


                            {{-- MEETING LINK --}}
                            @if($session->meeting_type === 'online' && $session->meeting_link)

                                <div class="mt-3">

                                    <a href="{{ $session->meeting_link }}"
                                       target="_blank"
                                       class="btn btn-primary w-100">

                                        Join Meeting

                                    </a>

                                </div>

                            @endif


                            {{-- CONFIRM BUTTON --}}
                            @if($session->status === 'scheduled')

                                <form method="POST"
                                      action="{{ route('student.sessions.confirm', $session) }}"
                                      class="mt-2">

                                    @csrf

                                    <button type="submit"
                                            class="btn btn-outline-primary w-100">

                                        Confirm Session

                                    </button>

                                </form>

                            @elseif($session->status === 'confirmed')

                                <div class="alert alert-success mt-3 mb-0">

                                    Session Confirmed

                                </div>

                            @endif

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <div class="card border-0 shadow-sm">

            <div class="card-body text-center py-5">

                <h5>
                    No Upcoming Sessions
                </h5>

                <p class="text-muted mb-3">

                    Your mentor has not scheduled any upcoming sessions yet.

                </p>

                <a href="{{ route('student.mentors.index') }}"
                   class="btn btn-primary">

                    Find a Mentor

                </a>

            </div>

        </div>

    @endif

</div>

@endsection
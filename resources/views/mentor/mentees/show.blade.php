@extends('layouts.app')

@section('content')

<div class="container py-4">

    {{-- ========================================================= --}}
    {{-- SUCCESS MESSAGE --}}
    {{-- ========================================================= --}}

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- ========================================================= --}}
    {{-- VALIDATION ERRORS --}}
    {{-- ========================================================= --}}

    @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- ========================================================= --}}
    {{-- MENTEE HEADER --}}
    {{-- ========================================================= --}}

    <div class="d-flex justify-content-between align-items-start mb-4">

        <div>

            <h1 class="h3 fw-bold mb-2">

                {{ $mentorship->student->name }}

            </h1>

            <span class="badge bg-success">

                {{ strtoupper($mentorship->status) }}

            </span>

        </div>

        <a
            href="{{ route('mentor.mentees.index') }}"
            class="btn btn-outline-secondary"
        >
            Back to My Mentees
        </a>

    </div>


    {{-- ========================================================= --}}
    {{-- MENTORSHIP INFORMATION --}}
    {{-- ========================================================= --}}

    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body">

            <div class="row">

                <div class="col-md-6">

                    <p>
                        <strong>Goal:</strong>
                        {{ $mentorship->career_goal }}
                    </p>

                    <p>
                        <strong>Mentorship Started:</strong>

                        {{ $mentorship->started_at
                            ? $mentorship->started_at->format('d M Y')
                            : '-' }}
                    </p>

                </div>

                <div class="col-md-6">

                    <p>

                        <strong>Sessions:</strong>

                        Completed:
                        {{ $mentorship->sessions
                            ->where('status', 'completed')
                            ->count() }}

                        &nbsp; | &nbsp;

                        Upcoming:
                        {{ $mentorship->sessions
                            ->whereIn('status', ['scheduled', 'confirmed'])
                            ->count() }}

                    </p>

                    <p>

                        <strong>Progress:</strong>

                        {{ $mentorship->progress_percent }}%

                    </p>

                    <div
                        class="progress"
                        style="height: 8px;"
                    >

                        <div
                            class="progress-bar"
                            style="width: {{ $mentorship->progress_percent }}%;"
                        ></div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- UPCOMING SESSION --}}
    {{-- ========================================================= --}}

    @if($upcoming)

        <div class="alert alert-primary border">

            <strong>Next Session</strong>

            <div class="mt-2">

                {{ $upcoming->session_date->format('d M Y') }}

                •
                {{ \Carbon\Carbon::parse($upcoming->start_time)->format('h:i A') }}

                •
                {{ $upcoming->duration_minutes }} minutes

            </div>

            <div class="mt-1">

                Type:
                {{ ucfirst($upcoming->meeting_type) }}

            </div>

        </div>

    @endif


    <hr class="my-4">


    {{-- ========================================================= --}}
    {{-- SCHEDULE SESSION --}}
    {{-- ========================================================= --}}

    <div id="schedule" class="mb-5">

        <h5 class="fw-bold mb-3">

            Schedule Mentorship Session

        </h5>


        <form
            method="POST"
            action="{{ route('mentor.mentees.sessions.store', $mentorship) }}"
            style="max-width: 600px;"
        >

            @csrf


            {{-- TOPIC --}}

            <div class="mb-3">

                <label class="form-label">

                    Topic <span class="text-danger">*</span>

                </label>

                <input
                    type="text"
                    name="topic"
                    class="form-control"
                    required
                    value="{{ old('topic') }}"
                    placeholder="Example: Laravel Career Guidance"
                >

            </div>


            {{-- DATE + TIME --}}

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Date <span class="text-danger">*</span>

                    </label>

                    <input
                        type="date"
                        name="session_date"
                        class="form-control"
                        required
                        min="{{ now()->toDateString() }}"
                        value="{{ old('session_date') }}"
                    >

                </div>


                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Time <span class="text-danger">*</span>

                    </label>

                    <input
                        type="time"
                        name="start_time"
                        class="form-control"
                        required
                        value="{{ old('start_time') }}"
                    >

                </div>

            </div>


            {{-- DURATION --}}

            <div class="mb-3">

                <label class="form-label">

                    Duration

                </label>

                <select
                    name="duration_minutes"
                    class="form-select"
                >

                    <option value="30">
                        30 Minutes
                    </option>

                    <option value="60" selected>
                        60 Minutes
                    </option>

                    <option value="90">
                        90 Minutes
                    </option>

                </select>

            </div>


            {{-- MEETING TYPE --}}

            <div class="mb-3">

                <label class="form-label">

                    Meeting Type

                </label>

                <select
                    name="meeting_type"
                    class="form-select"
                >

                    <option value="online" selected>
                        Online
                    </option>

                    <option value="offline">
                        Offline
                    </option>

                </select>

            </div>


            {{-- AGENDA --}}

            <div class="mb-3">

                <label class="form-label">

                    Agenda

                </label>

                <textarea
                    name="agenda"
                    class="form-control"
                    rows="4"
                    placeholder="Example: Career discussion, Laravel skills review, project guidance, next steps."
                >{{ old('agenda') }}</textarea>

            </div>


            <button
                type="submit"
                class="btn btn-primary"
            >

                Schedule Session

            </button>

        </form>

    </div>


    {{-- ========================================================= --}}
    {{-- SESSIONS --}}
    {{-- ========================================================= --}}

    <div id="sessions" class="mb-5">

        <h5 class="fw-bold mb-3">

            Sessions

        </h5>


        @if($mentorship->sessions->count() === 0)

            <div class="alert alert-light border">

                No sessions scheduled yet.

            </div>

        @else

            @foreach($mentorship->sessions->sortByDesc('session_date') as $session)

                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-body">


                        {{-- SESSION HEADER --}}

                        <div class="d-flex justify-content-between align-items-start mb-3">

                            <div>

                                <h6 class="fw-bold mb-1">

                                    {{ $session->topic }}

                                </h6>

                                <small class="text-muted">

                                    Session #{{ $session->id }}

                                </small>

                            </div>


                            @if($session->status === 'scheduled')

                                <span class="badge bg-warning text-dark">

                                    Scheduled

                                </span>

                            @elseif($session->status === 'confirmed')

                                <span class="badge bg-success">

                                    Confirmed

                                </span>

                            @elseif($session->status === 'in_progress')

                                <span class="badge bg-primary">

                                    In Progress

                                </span>

                            @elseif($session->status === 'completed')

                                <span class="badge bg-dark">

                                    Completed

                                </span>

                            @elseif($session->status === 'cancelled')

                                <span class="badge bg-danger">

                                    Cancelled

                                </span>

                            @else

                                <span class="badge bg-secondary">

                                    {{ ucfirst($session->status) }}

                                </span>

                            @endif

                        </div>


                        {{-- SESSION DETAILS --}}

                        <div class="row mb-3">

                            <div class="col-md-3">

                                <strong>Date</strong>

                                <div>

                                    {{ $session->session_date->format('d M Y') }}

                                </div>

                            </div>


                            <div class="col-md-3">

                                <strong>Time</strong>

                                <div>

                                    {{ \Carbon\Carbon::parse($session->start_time)->format('h:i A') }}

                                </div>

                            </div>


                            <div class="col-md-3">

                                <strong>Duration</strong>

                                <div>

                                    {{ $session->duration_minutes }} min

                                </div>

                            </div>


                            <div class="col-md-3">

                                <strong>Type</strong>

                                <div>

                                    {{ ucfirst($session->meeting_type) }}

                                </div>

                            </div>

                        </div>


                        {{-- AGENDA --}}

                        @if($session->agenda)

                            <div class="bg-light rounded p-3 mb-3">

                                <strong>Agenda</strong>

                                <div class="mt-1">

                                    {!! nl2br(e($session->agenda)) !!}

                                </div>

                            </div>

                        @endif


                        {{-- ================================================= --}}
                        {{-- MEETING LINK --}}
                        {{-- ================================================= --}}

                        @if(
                            $session->meeting_type === 'online'
                            && $session->meeting_link
                        )

                            <a
                                href="{{ $session->meeting_link }}"
                                target="_blank"
                                class="btn btn-primary btn-sm mb-3"
                            >

                                Join Meeting

                            </a>

                        @endif


                        {{-- ================================================= --}}
                        {{-- CONDUCT SESSION --}}
                        {{-- ================================================= --}}

                        @if(
                            in_array($session->status, [
                                'scheduled',
                                'confirmed'
                            ])
                        )

                            <form
                                method="POST"
                                action="{{ route('mentor.sessions.conduct', $session) }}"
                                class="d-inline"
                            >

                                @csrf

                                <button
                                    type="submit"
                                    class="btn btn-outline-primary btn-sm mb-3"
                                >

                                    Conduct Session

                                </button>

                            </form>

                        @endif


                        {{-- ================================================= --}}
                        {{-- SESSION NOTES --}}
                        {{-- ================================================= --}}

                        <div class="border-top pt-3 mt-2">

                            <h6 class="fw-bold">

                                Session Notes

                            </h6>


                            {{-- EXISTING NOTES --}}

                            @if($session->mentor_notes)

                                <div class="alert alert-light border">

                                    <strong>
                                        Mentor Notes
                                    </strong>

                                    <div class="mt-2">

                                        {!! nl2br(e($session->mentor_notes)) !!}

                                    </div>

                                </div>

                            @endif


                            {{-- ADD NOTES --}}

                            @if(
                                in_array($session->status, [
                                    'scheduled',
                                    'confirmed',
                                    'in_progress'
                                ])
                            )

                                <form
                                    method="POST"
                                    action="{{ route('mentor.sessions.notes.store', $session) }}"
                                >

                                    @csrf

                                    <div class="mb-3">

                                        <label class="form-label">

                                            Add / Update Notes

                                        </label>

                                        <textarea
                                            name="mentor_notes"
                                            class="form-control"
                                            rows="5"
                                            placeholder="Enter what was discussed, student's progress, guidance given, tasks, resources and next steps..."
                                            required
                                        >{{ old('mentor_notes', $session->mentor_notes) }}</textarea>

                                    </div>


                                    <button
                                        type="submit"
                                        class="btn btn-primary btn-sm"
                                    >

                                        Save Notes

                                    </button>

                                </form>

                            @endif

                        </div>


                        {{-- ================================================= --}}
                        {{-- COMPLETE SESSION --}}
                        {{-- ================================================= --}}

                        @if(
                            in_array($session->status, [
                                'scheduled',
                                'confirmed',
                                'in_progress'
                            ])
                        )

                            <div class="border-top mt-4 pt-3">

                                <form
                                    method="POST"
                                    action="{{ route('mentor.sessions.complete', $session) }}"
                                >

                                    @csrf

                                    <button
                                        type="submit"
                                        class="btn btn-success"
                                    >

                                        Mark Session Completed

                                    </button>

                                </form>

                            </div>

                        @endif


                        {{-- COMPLETED MESSAGE --}}

                        @if($session->status === 'completed')

                            <div class="alert alert-success mt-3 mb-0">

                                <strong>
                                    Session Completed
                                </strong>

                                <div class="mt-1">

                                    This session has been completed.

                                </div>

                            </div>

                        @endif

                    </div>

                </div>

            @endforeach

        @endif

    </div>


    {{-- ========================================================= --}}
    {{-- END MENTORSHIP --}}
    {{-- ========================================================= --}}

    <div class="border-top pt-4">

        <form
            method="POST"
            action="{{ route('mentor.mentees.complete', $mentorship) }}"
        >

            @csrf

            <button
                type="submit"
                class="btn btn-outline-danger"
            >

                End Mentorship

            </button>

        </form>

    </div>

</div>

@endsection
@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h4 mb-1">Pending Mentorship Verification</h1>
            <p class="text-muted mb-0">
                Review mentorship requests accepted by mentors.
            </p>
        </div>

        <a href="{{ route('admin.mentorship.active') }}"
           class="btn btn-outline-primary">
            Active Mentorships
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    @forelse($requests as $request)

        <div class="card mb-3 shadow-sm">
            <div class="card-body">

                <div class="row">

                    {{-- Student --}}
                    <div class="col-md-4">
                        <h6 class="text-muted mb-1">Student</h6>

                        <h5 class="mb-1">
                            {{ $request->student?->name ?? 'N/A' }}
                        </h5>

                        @if($request->student?->email)
                            <div class="small text-muted">
                                {{ $request->student->email }}
                            </div>
                        @endif
                    </div>

                    {{-- Mentor --}}
                    <div class="col-md-4">
                        <h6 class="text-muted mb-1">Mentor</h6>

                        <h5 class="mb-1">
                            {{ $request->mentor?->name ?? 'N/A' }}
                        </h5>

                        @if($request->mentor?->email)
                            <div class="small text-muted">
                                {{ $request->mentor->email }}
                            </div>
                        @endif

                        <div class="small text-muted mt-1">
                            Active mentees:
                            <strong>{{ $request->mentor_active_count }}</strong>
                        </div>
                    </div>

                    {{-- Status --}}
                    <div class="col-md-4 text-md-end">
                        <span class="badge bg-warning text-dark">
                            ADMIN VERIFICATION
                        </span>

                        <div class="small text-muted mt-2">
                            Accepted:
                            {{ $request->accepted_at?->format('d M Y, h:i A') ?? 'N/A' }}
                        </div>
                    </div>

                </div>

                <hr>

                {{-- Request details --}}
                <div class="row">

                    <div class="col-md-6">
                        <p class="mb-2">
                            <strong>Career Goal:</strong><br>
                            {{ $request->career_goal ?? 'N/A' }}
                        </p>

                        <p class="mb-2">
                            <strong>Current Skills:</strong><br>
                            {{ $request->current_skills ?? 'N/A' }}
                        </p>
                    </div>

                    <div class="col-md-6">
                        <p class="mb-2">
                            <strong>Goal:</strong><br>
                            {{ $request->goal ?? 'N/A' }}
                        </p>

                        <p class="mb-2">
                            <strong>Frequency:</strong>
                            {{ ucfirst($request->frequency ?? 'N/A') }}
                        </p>
                    </div>

                </div>

                @if($request->message)
                    <div class="alert alert-light border mt-2">
                        <strong>Student Message:</strong><br>
                        {{ $request->message }}
                    </div>
                @endif

                {{-- Actions --}}
                <div class="d-flex gap-2 mt-3">

                    <a href="{{ route('admin.mentorship.pending.show', $request) }}"
                       class="btn btn-sm btn-outline-primary">
                        View Details
                    </a>

                    <form method="POST"
                          action="{{ route('admin.mentorship.approve', $request) }}">
                        @csrf

                        <button type="submit"
                                class="btn btn-sm btn-success"
                                onclick="return confirm('Approve this mentorship request?')">
                            Approve
                        </button>
                    </form>

                    <form method="POST"
                          action="{{ route('admin.mentorship.reject', $request) }}">
                        @csrf

                        <button type="submit"
                                class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('Reject this mentorship request?')">
                            Reject
                        </button>
                    </form>

                </div>

            </div>
        </div>

    @empty

        <div class="card">
            <div class="card-body text-center py-5">
                <h5>No Pending Verifications</h5>

                <p class="text-muted mb-0">
                    There are currently no mentorship requests waiting for admin verification.
                </p>
            </div>
        </div>

    @endforelse

</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h4 mb-1">Active Mentorships</h1>
            <p class="text-muted mb-0">
                View and monitor all currently active mentorships.
            </p>
        </div>

        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
            Back
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">

            @if($mentorships->count())

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Student</th>
                                <th>Mentor</th>
                                <th>Goal</th>
                                <th>Sessions</th>
                                <th>Started</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($mentorships as $mentorship)
                                <tr>
                                    <td>
                                        {{ $mentorships->firstItem() + $loop->index }}
                                    </td>

                                    <td>
                                        <strong>
                                            {{ $mentorship->student?->name ?? 'N/A' }}
                                        </strong>

                                        @if($mentorship->student?->email)
                                            <div class="small text-muted">
                                                {{ $mentorship->student->email }}
                                            </div>
                                        @endif
                                    </td>

                                    <td>
                                        <strong>
                                            {{ $mentorship->mentor?->name ?? 'N/A' }}
                                        </strong>

                                        @if($mentorship->mentor?->email)
                                            <div class="small text-muted">
                                                {{ $mentorship->mentor->email }}
                                            </div>
                                        @endif
                                    </td>

                                    <td>
                                        {{ $mentorship->career_goal ?? 'N/A' }}
                                    </td>

                                    <td>
                                        {{ $mentorship->sessions_count }}
                                    </td>

                                    <td>
                                        {{ $mentorship->started_at?->format('d M Y') ?? 'N/A' }}
                                    </td>

                                    <td>
                                        <span class="badge bg-success">
                                            {{ strtoupper($mentorship->status) }}
                                        </span>
                                    </td>

                                    <td>
                                        <a href="{{ route('admin.mentorship.active.show', $mentorship) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $mentorships->links() }}
                </div>

            @else

                <div class="text-center py-5">
                    <h5>No Active Mentorships</h5>
                    <p class="text-muted mb-0">
                        There are currently no active mentorships.
                    </p>
                </div>

            @endif

        </div>
    </div>

</div>
@endsection
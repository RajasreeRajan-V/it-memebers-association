@extends('admin.layout')

@section('content')
<div class="container py-4">
    <h1 class="h4 mb-4">Mentorship — Pending Verification</h1>

    @forelse ($requests as $req)
        <div class="card p-3 mb-3">
            <div class="row">
                <div class="col-md-3">
                    <strong>Mentor</strong><br>{{ $req->mentor->name }}
                </div>
                <div class="col-md-3">
                    <strong>Student</strong><br>{{ $req->student->name }}
                </div>
                <div class="col-md-3">
                    <strong>Goal</strong><br>{{ $req->career_goal }}
                </div>
                <div class="col-md-3">
                    <strong>Frequency</strong><br>{{ ucfirst($req->frequency) }}
                </div>
            </div>

            <div class="mt-3 d-flex gap-2">
                <a href="{{ route('admin.mentors.show', $req->mentor) ?? '#' }}" class="btn btn-sm btn-outline-secondary">View Mentor</a>
                <a href="{{ route('admin.students.show', $req->student) ?? '#' }}" class="btn btn-sm btn-outline-secondary">View Student</a>

                <form method="POST" action="{{ route('admin.mentorship.approve', $req) }}" class="ms-auto">
                    @csrf
                    <button class="btn btn-sm btn-success">Approve Mentorship</button>
                </form>
                <form method="POST" action="{{ route('admin.mentorship.reject', $req) }}">
                    @csrf
                    <button class="btn btn-sm btn-outline-danger">Reject</button>
                </form>
            </div>
        </div>
    @empty
        <p class="text-muted">No requests awaiting verification.</p>
    @endforelse
</div>
@endsection

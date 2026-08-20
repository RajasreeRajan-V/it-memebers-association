@extends('layouts.app')



@section('content')
<div class="container py-4">
    <h1 class="h4 mb-4">Find a Mentor</h1>

    <form method="GET" class="mb-4 d-flex gap-2">
        <input type="text" name="skill" value="{{ request('skill') }}"
               class="form-control" placeholder="Search by skill (e.g. Laravel)">
        <button class="btn btn-primary">Search</button>
    </form>

    <div class="row g-3">
        @forelse ($mentors as $mentor)
            <div class="col-md-4">
                <div class="card h-100 p-3">
                    <h5 class="mb-1">{{ $mentor->name }}</h5>
                    <p class="text-muted mb-1">{{ $mentor->title }}</p>
                    <p class="mb-1">⭐ {{ number_format($mentor->rating, 1) }}</p>
                    <p class="small text-muted">{{ $mentor->skills }}</p>
                    <p class="small">{{ $mentor->active_mentees_count }} Active Mentees</p>
                    <a href="{{ route('student.mentors.show', $mentor) }}" class="btn btn-outline-primary mt-auto">
                        View Profile
                    </a>
                </div>
            </div>
        @empty
            <p class="text-muted">No mentors found.</p>
        @endforelse
    </div>

    <div class="mt-4">{{ $mentors->links() }}</div>
</div>
@endsection

@extends('layouts.app')



@section('content')
<div class="container py-4">
    <h1 class="h4">{{ $mentor->name }}</h1>
    <p class="text-muted">{{ $mentor->title }}</p>

    <div class="row mt-4">
        <div class="col-md-8">
            <h6>About</h6>
            <p>{{ $mentor->about }}</p>

            <h6>Skills</h6>
            <p>{{ $mentor->skills }}</p>

            <h6>Areas I Can Help With</h6>
            <ul>
                @foreach (explode(',', $mentor->help_areas ?? '') as $area)
                    <li>{{ trim($area) }}</li>
                @endforeach
            </ul>
        </div>

        <div class="col-md-4">
            <div class="card p-3">
                <p class="mb-1">Active Mentees: {{ $mentor->active_mentees_count }}</p>
                <p class="mb-3">Rating: ⭐ {{ number_format($mentor->rating, 1) }}</p>

                @if ($existingRequest)
                    <div class="alert alert-info small">
                        You already have a
                        <strong>{{ str_replace('_', ' ', $existingRequest->status) }}</strong>
                        request with this mentor.
                    </div>
                @else
                    <a href="{{ route('student.mentors.request', $mentor) }}" class="btn btn-primary w-100">
                        Request Mentorship
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

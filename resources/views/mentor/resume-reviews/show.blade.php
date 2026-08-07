@extends('layouts.app')

@section('content')
<div class="mentor-card">
    <h3>{{ $review->student->name }}</h3>
    <p><a class="btn btn-outline" href="{{ asset('storage/' . $review->resume_path) }}" target="_blank">
        <i class="fa-solid fa-file-pdf"></i> View Resume
    </a></p>
</div>

<div class="mentor-card">
    <h4>Submit Feedback</h4>
    <form method="POST" action="{{ route('mentor.resume-reviews.submit', $review) }}">
        @csrf
        <div class="form-group">
            <label>ATS Score (0-100)</label>
            <input type="number" name="ats_score" min="0" max="100" value="{{ $review->ats_score }}" required>
        </div>
        <div class="form-group">
            <label>Comments</label>
            <textarea name="comments" rows="5" required>{{ $review->comments }}</textarea>
        </div>
        <button class="btn btn-primary" type="submit">Submit Review</button>
    </form>
</div>
@endsection

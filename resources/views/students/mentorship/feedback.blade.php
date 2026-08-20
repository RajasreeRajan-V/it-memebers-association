@extends('layouts.app')



@section('content')
<div class="container py-4" style="max-width:480px">
    <h1 class="h4 mb-4">Rate Your Mentor</h1>
    <p class="h5">{{ $mentorship->mentor->name }}</p>

    <form method="POST" action="{{ route('student.mentorship.feedback.store', $mentorship) }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Rating</label><br>
            @for ($i = 5; $i >= 1; $i--)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="rating" value="{{ $i }}" id="r{{ $i }}" required>
                    <label class="form-check-label" for="r{{ $i }}">{{ $i }} ★</label>
                </div>
            @endfor
        </div>

        <div class="mb-3">
            <label class="form-label">How was your mentorship experience?</label>
            <textarea name="comment" class="form-control" rows="4"></textarea>
        </div>

        <button class="btn btn-primary">Submit Review</button>
    </form>
</div>
@endsection

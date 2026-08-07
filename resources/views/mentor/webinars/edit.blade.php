@extends('layouts.app')

@section('content')
<div class="mentor-card">
    <form method="POST" action="{{ route('mentor.webinars.update', $webinar) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" value="{{ $webinar->title }}" required>
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" rows="4" required>{{ $webinar->description }}</textarea>
        </div>
        <div class="form-group">
            <label>Date</label>
            <input type="date" name="scheduled_date" value="{{ $webinar->scheduled_date->format('Y-m-d') }}" required>
        </div>
        <div class="form-group">
            <label>Time</label>
            <input type="time" name="scheduled_time" value="{{ $webinar->scheduled_time }}" required>
        </div>
        <div class="form-group">
            <label>Meeting Link (optional)</label>
            <input type="text" name="meeting_link" value="{{ $webinar->meeting_link }}">
        </div>
        <div class="form-group">
            <label>Banner Image</label>
            <input type="file" name="banner" accept="image/*">
        </div>
        <button class="btn btn-primary" type="submit">Update &amp; Resubmit</button>
    </form>
</div>
@endsection

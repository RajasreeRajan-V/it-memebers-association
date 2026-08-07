@extends('layouts.app')

@section('content')
<div class="mentor-card">
    <form method="POST" action="{{ route('mentor.webinars.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" required>
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label>Date</label>
            <input type="date" name="scheduled_date" required>
        </div>
        <div class="form-group">
            <label>Time</label>
            <input type="time" name="scheduled_time" required>
        </div>
        <div class="form-group">
            <label>Meeting Link (optional)</label>
            <input type="text" name="meeting_link">
        </div>
        <div class="form-group">
            <label>Banner Image</label>
            <input type="file" name="banner" accept="image/*">
        </div>
        <button class="btn btn-primary" type="submit">Submit for Admin Approval</button>
    </form>
</div>
@endsection

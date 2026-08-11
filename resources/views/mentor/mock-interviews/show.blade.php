@extends('layouts.app')

@section('content')
<div class="mentor-card">
    <h3>{{ $interview->student->name }}</h3>
    <p>Status: <span class="badge-status badge-{{ $interview->status }}">{{ ucfirst($interview->status) }}</span></p>
</div>

@if($interview->status === 'assigned')
<div class="mentor-card">
    <h4>Schedule Interview</h4>
    <form method="POST" action="{{ route('mentor.mock-interviews.schedule', $interview) }}">
        @csrf
        <div class="form-group">
            <label>Date &amp; Time</label>
            <input type="datetime-local" name="scheduled_at" required>
        </div>
        <div class="form-group">
            <label>Mode</label>
            <select name="mode" required>
                <option value="online">Online</option>
                <option value="offline">Offline</option>
            </select>
        </div>
        <div class="form-group">
            <label>Meeting Link (optional)</label>
            <input type="text" name="meeting_link">
        </div>
        <button class="btn btn-primary" type="submit">Schedule</button>
    </form>
</div>
@endif

@if($interview->status === 'scheduled')
<div class="mentor-card">
    <p>Scheduled for {{ $interview->scheduled_at->format('d M Y, h:i A') }} ({{ ucfirst($interview->mode) }})</p>
    <form method="POST" action="{{ route('mentor.mock-interviews.conduct', $interview) }}">
        @csrf
        <button class="btn btn-outline" type="submit">Mark as Conducted</button>
    </form>
</div>
@endif

@if(in_array($interview->status, ['scheduled', 'conducted']))
<div class="mentor-card">
    <h4>Evaluation Form</h4>
    <form method="POST" action="{{ route('mentor.mock-interviews.feedback', $interview) }}">
        @csrf
        <div class="form-group">
            <label>Technical Skills (1-10)</label>
            <input type="number" name="technical_rating" min="1" max="10" value="{{ $interview->technical_rating }}" required>
        </div>
        <div class="form-group">
            <label>Communication (1-10)</label>
            <input type="number" name="communication_rating" min="1" max="10" value="{{ $interview->communication_rating }}" required>
        </div>
        <div class="form-group">
            <label>Confidence (1-10)</label>
            <input type="number" name="confidence_rating" min="1" max="10" value="{{ $interview->confidence_rating }}" required>
        </div>
        <div class="form-group">
            <label>Overall Rating (1-10)</label>
            <input type="number" name="overall_rating" min="1" max="10" value="{{ $interview->overall_rating }}" required>
        </div>
        <div class="form-group">
            <label>Feedback</label>
            <textarea name="feedback" rows="5" required>{{ $interview->feedback }}</textarea>
        </div>
        <button class="btn btn-primary" type="submit">Submit Feedback</button>
    </form>
</div>
@endif
@endsection

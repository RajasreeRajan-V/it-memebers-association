@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-3">Mock Interview with {{ $mockInterview->student->name }}</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Topic:</strong> {{ $mockInterview->topic }}</p>
            <p><strong>Status:</strong> {{ ucfirst($mockInterview->status) }}</p>
            @if ($mockInterview->student_notes)
                <p><strong>Student's notes:</strong> {{ $mockInterview->student_notes }}</p>
            @endif
            @if ($mockInterview->status === 'pending')
                <p><strong>Student's requested time:</strong> {{ $mockInterview->requested_at->format('d M Y, h:i A') }}</p>
            @elseif (in_array($mockInterview->status, ['scheduled', 'completed']))
                <p><strong>Scheduled for:</strong> {{ $mockInterview->scheduled_at->format('d M Y, h:i A') }}</p>
                <p><strong>Meeting link:</strong>
                    <a href="{{ $mockInterview->meeting_link }}" target="_blank">{{ $mockInterview->meeting_link }}</a>
                </p>
            @endif
        </div>
    </div>

    {{-- Schedule form: only while pending --}}
    @if ($mockInterview->status === 'pending')
        <div class="card mb-4">
            <div class="card-header">Confirm Slot & Schedule</div>
            <div class="card-body">
                <form method="POST" action="{{ route('mentor.mock-interviews.schedule', $mockInterview) }}">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label class="form-label">Confirmed Date & Time</label>
                        <input type="datetime-local" name="scheduled_at" class="form-control"
                               value="{{ old('scheduled_at', $mockInterview->requested_at?->format('Y-m-d\TH:i')) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Meeting Link</label>
                        <input type="url" name="meeting_link" class="form-control"
                               placeholder="https://meet.google.com/..." value="{{ old('meeting_link') }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Confirm & Schedule</button>
                </form>
            </div>
        </div>

        <form method="POST" action="{{ route('mentor.mock-interviews.cancel', $mockInterview) }}" class="mb-4">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-outline-danger btn-sm"
                    onclick="return confirm('Decline/cancel this request?')">
                Decline Request
            </button>
        </form>
    @endif

    {{-- Mark complete: only while scheduled --}}
    @if ($mockInterview->status === 'scheduled')
        <form method="POST" action="{{ route('mentor.mock-interviews.complete', $mockInterview) }}" class="mb-4">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-success btn-sm">Mark as Completed</button>
        </form>

        <form method="POST" action="{{ route('mentor.mock-interviews.cancel', $mockInterview) }}" class="mb-4">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-outline-danger btn-sm"
                    onclick="return confirm('Cancel this scheduled interview?')">
                Cancel Interview
            </button>
        </form>
    @endif

    {{-- Student's feedback, once given --}}
    @if ($mockInterview->student_feedback)
        <div class="card mb-4">
            <div class="card-header">Student's Feedback</div>
            <div class="card-body">
                <p><strong>Rating:</strong> {{ $mockInterview->student_rating }}/5</p>
                <p>{{ $mockInterview->student_feedback }}</p>
            </div>
        </div>
    @endif

    {{-- Mentor's own feedback form, only after completion --}}
    @if ($mockInterview->status === 'completed')
        <div class="card">
            <div class="card-header">Your Feedback for the Student</div>
            <div class="card-body">
                @if ($mockInterview->mentor_feedback)
                    <p><strong>Your rating:</strong> {{ $mockInterview->mentor_rating }}/5</p>
                    <p>{{ $mockInterview->mentor_feedback }}</p>
                @else
                    <form method="POST" action="{{ route('mentor.mock-interviews.feedback', $mockInterview) }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Rate the student (1-5)</label>
                            <select name="mentor_rating" class="form-select" required>
                                @for ($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Feedback</label>
                            <textarea name="mentor_feedback" class="form-control" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Feedback</button>
                    </form>
                @endif
            </div>
        </div>
    @endif
</div>
@endsection

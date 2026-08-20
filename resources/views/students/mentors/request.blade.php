@extends('layouts.app')



@section('content')
<div class="container py-4" style="max-width:640px">
    <h1 class="h4 mb-4">Request Mentorship</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('student.mentors.request.store', $mentor) }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Mentor</label>
            <input type="text" class="form-control" value="{{ $mentor->name }}" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Mentorship Goal *</label>
            <textarea name="goal" class="form-control" rows="3" required>{{ old('goal') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Your Current Skills</label>
            <input type="text" name="current_skills" class="form-control"
                   value="{{ old('current_skills') }}" placeholder="PHP, Laravel, MySQL">
        </div>

        <div class="mb-3">
            <label class="form-label">Career Goal *</label>
            <input type="text" name="career_goal" class="form-control"
                   value="{{ old('career_goal') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Preferred Session Frequency</label><br>
            @foreach (['weekly' => 'Weekly', 'biweekly' => 'Biweekly', 'monthly' => 'Monthly'] as $val => $label)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="frequency" value="{{ $val }}"
                           id="freq_{{ $val }}" {{ old('frequency', 'weekly') === $val ? 'checked' : '' }}>
                    <label class="form-check-label" for="freq_{{ $val }}">{{ $label }}</label>
                </div>
            @endforeach
        </div>

        <div class="mb-3">
            <label class="form-label">Preferred Days</label><br>
            @foreach (['saturday' => 'Saturday', 'sunday' => 'Sunday'] as $val => $label)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="preferred_days[]"
                           value="{{ $val }}" id="day_{{ $val }}">
                    <label class="form-check-label" for="day_{{ $val }}">{{ $label }}</label>
                </div>
            @endforeach
        </div>

        <div class="mb-3">
            <label class="form-label">Preferred Time</label>
            <input type="text" name="preferred_time" class="form-control"
                   value="{{ old('preferred_time') }}" placeholder="6:00 PM - 8:00 PM">
        </div>

        <div class="mb-3">
            <label class="form-label">Message</label>
            <textarea name="message" class="form-control" rows="3"
                      placeholder="Tell the mentor about your goals...">{{ old('message') }}</textarea>
        </div>

        <button class="btn btn-primary">Send Request</button>
    </form>
</div>
@endsection

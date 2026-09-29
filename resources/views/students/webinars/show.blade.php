@extends('layouts.app')

@section('title', $webinar->title)

@section('content')

@if(session('success'))
    <div class="registration-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="registration-error">{{ session('error') }}</div>
@endif

@php
    $scheduledDate = \Illuminate\Support\Carbon::parse($webinar->scheduled_date);
    $scheduledTime = $webinar->scheduled_time
        ? \Illuminate\Support\Carbon::parse($webinar->scheduled_time)->format('h:i A')
        : null;
@endphp

<div class="container" style="max-width:800px;padding:48px 0;">
   <a href="{{ route('student.webinars.index') }}" style="font-size:0.85rem;color:var(--muted);">
    &larr; Back to Events
</a>

    <div class="sidebar-card" style="padding:28px;margin-top:16px;">
        <div class="material-card-tags" style="margin-bottom:10px;">
            @if($webinar->category)
                <span class="tag-pill category-pill">{{ strtoupper($webinar->category) }}</span>
            @endif
            <span class="tag-pill">{{ strtoupper($webinar->type) }}</span>
        </div>

        <h1 style="font-size:1.6rem;font-weight:700;color:var(--primary);font-family:var(--font-display);">
            {{ $webinar->title }}
        </h1>

        <p style="color:var(--muted);margin:14px 0;line-height:1.6;">{{ $webinar->description }}</p>

        <table style="width:100%;border-collapse:collapse;margin:20px 0;font-size:0.9rem;">
            <tr>
                <td style="padding:6px 0;color:var(--muted);width:140px;">Mentor</td>
                <td style="padding:6px 0;">{{ $webinar->mentor->name ?? '—' }}</td>
            </tr>
            <tr>
                <td style="padding:6px 0;color:var(--muted);">Date</td>
                <td style="padding:6px 0;">{{ $scheduledDate->format('d M, Y') }}</td>
            </tr>
            @if($scheduledTime)
            <tr>
                <td style="padding:6px 0;color:var(--muted);">Time</td>
                <td style="padding:6px 0;">{{ $scheduledTime }}</td>
            </tr>
            @endif
            <tr>
                <td style="padding:6px 0;color:var(--muted);">Platform</td>
                <td style="padding:6px 0;">{{ $webinar->platform ?? '—' }}</td>
            </tr>
            <tr>
                <td style="padding:6px 0;color:var(--muted);">Seats</td>
                <td style="padding:6px 0;">
                    {{ $webinar->confirmedRegistrationsCount() }}{{ $webinar->capacity ? '/' . $webinar->capacity : '' }}
                </td>
            </tr>
        </table>

        @if($webinar->learning_outcomes)
            <h3 style="font-size:1rem;margin-bottom:8px;">What you'll learn</h3>
            <ul style="margin-bottom:20px;padding-left:20px;color:var(--muted);">
                @foreach($webinar->learning_outcomes as $point)
                    <li style="margin-bottom:4px;">{{ $point }}</li>
                @endforeach
            </ul>
        @endif

        <div style="margin-top:24px;">
            @if(!$registration)
                <form method="POST" action="{{ route('student.webinars.register', $webinar) }}">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-lg">Register Now</button>
                </form>
            @elseif($registration->status === 'pending')
                <span class="status-badge status-pending">⏳ You're on the waitlist</span>
          @elseif($scheduledDate->lt(\Illuminate\Support\Carbon::today()))
    <span class="status-badge status-completed">✓ Completed</span>
    <p style="margin-top:10px;color:var(--muted);font-size:0.85rem;">
        Attendance: {{ ucfirst($registration->attendance_status ?? 'registered') }}
    </p>

    @if($registration->attendance_status === 'attended')
        <a href="{{ route('student.webinars.certificate', $webinar) }}" class="btn btn-primary" style="margin-top:10px;display:inline-block;">
            🏆 Download Certificate
        </a>
    @endif

                @if($webinar->resources->isNotEmpty())
                    <div style="margin-top:16px;">
                        <h3 style="font-size:1rem;margin-bottom:10px;">Recording & Resources</h3>
                        @foreach($webinar->resources as $res)
                            <div style="margin-bottom:8px;">
                                <a href="{{ $res->link }}" target="_blank" class="btn btn-primary" style="padding:8px 16px;font-size:0.82rem;">
                                    @if($res->type === 'recording') 🎬 @else 📄 @endif
                                    {{ $res->title }}
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Feedback --}}
                <div style="margin-top:24px;padding-top:20px;border-top:1px solid #e5e7eb;">
                    <h3 style="font-size:1rem;margin-bottom:12px;">How was this webinar?</h3>

                    <form method="POST" action="{{ route('student.webinars.feedback', $webinar) }}" id="feedback-form"
                          onsubmit="return document.getElementById('rating-input').value !== '' || alert('Please select a star rating.')">
                        @csrf
                        <div id="star-rating" style="font-size:28px;letter-spacing:4px;cursor:pointer;margin-bottom:10px;">
                            @for($i = 1; $i <= 5; $i++)
                                <span class="star" data-value="{{ $i }}" style="color:{{ $myFeedback && $i <= $myFeedback->rating ? '#f59e0b' : '#d1d5db' }};">★</span>
                            @endfor
                        </div>
                        <input type="hidden" name="rating" id="rating-input" value="{{ $myFeedback->rating ?? '' }}">

                        <textarea name="review" placeholder="What did you think? (optional)" rows="3"
                                  style="width:100%;padding:10px;border:1px solid #e5e7eb;border-radius:8px;font-size:0.85rem;margin-bottom:10px;">{{ $myFeedback->review ?? '' }}</textarea>

                        <button type="submit" class="btn btn-primary">
                            {{ $myFeedback ? 'Update Feedback' : 'Submit Feedback' }}
                        </button>
                    </form>
                </div>

                <script>
                    document.querySelectorAll('#star-rating .star').forEach(function (star) {
                        star.addEventListener('click', function () {
                            var value = this.dataset.value;
                            document.getElementById('rating-input').value = value;
                            document.querySelectorAll('#star-rating .star').forEach(function (s) {
                                s.style.color = s.dataset.value <= value ? '#f59e0b' : '#d1d5db';
                            });
                        });
                    });
                </script>
            @else
                <span class="status-badge status-registered">✓ Registered</span>
                @if($webinar->meeting_link)
                    <a href="{{ $webinar->meeting_link }}" target="_blank" class="btn btn-primary" style="margin-left:10px;">
                        🎥 Join Webinar
                    </a>
                @endif
            @endif
        </div>
    </div>
</div>

<style>
.status-badge { display:inline-block;padding:9px 18px;border-radius:8px;font-size:0.85rem;font-weight:600; }
.status-registered { background:#ecfdf5;color:#047857;border:1px solid #10b981; }
.status-pending     { background:#fffbeb;color:#b45309;border:1px solid #f59e0b; }
.status-completed   { background:#f3f4f6;color:#374151;border:1px solid #d1d5db; }
.registration-success { max-width:800px;margin:20px auto;padding:14px 20px;background:#ecfdf5;border:1px solid #10b981;color:#047857;border-radius:10px;font-weight:600; }
.registration-error   { max-width:800px;margin:20px auto;padding:14px 20px;background:#fef2f2;border:1px solid #ef4444;color:#b91c1c;border-radius:10px;font-weight:600; }
</style>

@endsection
@extends('layouts.app')

@php($portal = 'student')

@section('title', 'Mock Interview Details')

@section('content')

<style>
    :root {
        --mi-primary: #3376F2;
        --mi-primary-dark: #245ED1;
        --mi-purple: #7C4DFF;
        --mi-bg: #F7F9FC;
        --mi-card: #FFFFFF;
        --mi-text: #172033;
        --mi-muted: #6B7280;
        --mi-border: #E6EAF0;
        --mi-success: #16A34A;
        --mi-danger: #EF4444;
        --mi-shadow: 0 2px 10px rgba(23, 32, 51, 0.04);
    }

    .mi-page {
        min-height: 100vh;
        background: var(--mi-bg);
        padding: 28px 0 60px;
    }

    .mi-container {
        width: min(880px, calc(100% - 40px));
        margin: 0 auto;
    }

    /* =========================
       PAGE HEADER
    ========================= */

    .mi-page-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 22px;
    }

    .mi-page-heading {
        color: var(--mi-text);
        font-size: 24px;
        font-weight: 800;
        margin: 0;
        letter-spacing: -0.3px;
    }

    .mi-page-subheading {
        color: var(--mi-muted);
        font-size: 13.5px;
        margin: 6px 0 0;
    }

    .mi-back-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        background: #fff;
        border: 1px solid var(--mi-border);
        color: var(--mi-text);
        padding: 10px 16px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        transition: .2s ease;
        flex-shrink: 0;
    }

    .mi-back-btn:hover {
        border-color: var(--mi-primary);
        color: var(--mi-primary);
    }

    /* =========================
       ALERT
    ========================= */

    .mi-alert {
        padding: 13px 15px;
        border-radius: 12px;
        background: #ECFDF3;
        border: 1px solid #CFF5DC;
        color: #148548;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 20px;
    }

    /* =========================
       CARDS (shared)
    ========================= */

    .mi-card {
        background: #fff;
        border: 1px solid var(--mi-border);
        border-radius: 18px;
        box-shadow: var(--mi-shadow);
        margin-bottom: 20px;
        overflow: hidden;
    }

    .mi-card-header {
        padding: 18px 22px;
        border-bottom: 1px solid var(--mi-border);
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .mi-card-header-icon {
        width: 38px;
        height: 38px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        background: #EEF4FF;
        color: var(--mi-primary);
        font-size: 14px;
    }

    .mi-card-header-title {
        color: var(--mi-text);
        font-size: 15px;
        font-weight: 700;
    }

    .mi-card-body {
        padding: 22px;
    }

    /* =========================
       STATUS SUMMARY
    ========================= */

    .mi-summary-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 14px;
        margin-bottom: 20px;
    }

    .mi-summary-mentor {
        display: flex;
        align-items: center;
        gap: 13px;
    }

    .mi-mentor-avatar {
        width: 50px;
        height: 50px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        background: linear-gradient(135deg, #3376F2, #7C4DFF);
        color: #fff;
        font-size: 17px;
        font-weight: 800;
    }

    .mi-summary-topic {
        color: var(--mi-text);
        font-size: 16px;
        font-weight: 800;
        margin-bottom: 3px;
    }

    .mi-summary-with {
        color: var(--mi-muted);
        font-size: 12.5px;
    }

    /* -- status pill (shared with index page) -- */

    .mi-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 12px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .mi-status-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
    }

    .mi-status.pending {
        background: #FFF7E8;
        color: #B77908;
        border: 1px solid #FBE4B3;
    }

    .mi-status.scheduled {
        background: #EAF1FF;
        color: var(--mi-primary);
        border: 1px solid #D9E6FF;
    }

    .mi-status.completed {
        background: #ECFDF3;
        color: var(--mi-success);
        border: 1px solid #CFF5DC;
    }

    .mi-status.cancelled {
        background: #F4F5F7;
        color: #6B7280;
        border: 1px solid #E3E6EC;
    }

    /* -- info rows -- */

    .mi-info-list {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .mi-info-row {
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .mi-info-icon {
        width: 34px;
        height: 34px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: #F4F6FA;
        color: var(--mi-primary);
        font-size: 13px;
    }

    .mi-info-label {
        color: #8792A7;
        font-size: 10.5px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .4px;
        margin-bottom: 3px;
    }

    .mi-info-value {
        color: var(--mi-text);
        font-size: 13px;
        font-weight: 600;
        line-height: 1.5;
        word-break: break-word;
    }

    .mi-info-value a {
        color: var(--mi-primary);
        text-decoration: none;
    }

    .mi-info-value a:hover {
        text-decoration: underline;
    }

    .mi-hint {
        color: var(--mi-muted);
        font-size: 12px;
        font-style: italic;
        margin-top: 2px;
    }

    .mi-join-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-top: 4px;
        padding: 9px 14px;
        border-radius: 9px;
        text-decoration: none;
        font-size: 12px;
        font-weight: 700;
        background: #ECFDF3;
        color: var(--mi-success);
        border: 1px solid #CFF5DC;
        transition: .2s ease;
    }

    .mi-join-btn:hover {
        background: var(--mi-success);
        color: #fff;
    }

    /* =========================
       CANCEL
    ========================= */

    .mi-cancel-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: 1px solid #FBD5D5;
        background: #FFF5F5;
        color: var(--mi-danger);
        padding: 10px 16px;
        border-radius: 10px;
        font-size: 12.5px;
        font-weight: 700;
        cursor: pointer;
        transition: .2s ease;
    }

    .mi-cancel-btn:hover {
        background: var(--mi-danger);
        color: #fff;
        border-color: var(--mi-danger);
    }

    /* =========================
       FEEDBACK (mentor -> student, read only)
    ========================= */

    .mi-rating-display {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 12px;
    }

    .mi-rating-stars {
        display: flex;
        gap: 2px;
        color: #F59E0B;
        font-size: 15px;
    }

    .mi-rating-stars .empty {
        color: #E3E6EC;
    }

    .mi-rating-number {
        color: var(--mi-text);
        font-size: 13px;
        font-weight: 700;
    }

    .mi-feedback-text {
        color: #4B5563;
        font-size: 13px;
        line-height: 1.7;
        background: #F7F9FC;
        border: 1px solid var(--mi-border);
        border-radius: 12px;
        padding: 14px 16px;
    }

    /* =========================
       STUDENT FEEDBACK FORM
    ========================= */

    .mi-form-group {
        margin-bottom: 20px;
    }

    .mi-form-group:last-of-type {
        margin-bottom: 0;
    }

    .mi-form-group label {
        display: block;
        color: #4B5563;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 10px;
    }

    .mi-form-control {
        width: 100%;
        box-sizing: border-box;
        padding: 12px 13px;
        border: 1px solid var(--mi-border);
        border-radius: 10px;
        background: #FBFCFE;
        color: var(--mi-text);
        font-size: 13px;
        outline: none;
        transition: .2s ease;
    }

    .mi-form-control:hover {
        border-color: #CBD5E6;
    }

    .mi-form-control:focus {
        border-color: var(--mi-primary);
        background: #fff;
        box-shadow: 0 0 0 3px rgba(51,118,242,.10);
    }

    textarea.mi-form-control {
        min-height: 100px;
        resize: vertical;
        line-height: 1.6;
    }

    /* -- star picker -- */

    .mi-star-picker {
        display: inline-flex;
        flex-direction: row-reverse;
        gap: 4px;
    }

    .mi-star-picker input {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .mi-star-picker label {
        font-size: 24px;
        color: #E3E6EC;
        cursor: pointer;
        transition: color .15s ease;
        text-transform: none;
        letter-spacing: 0;
        margin: 0;
    }

    .mi-star-picker label:hover,
    .mi-star-picker label:hover ~ label,
    .mi-star-picker input:checked ~ label {
        color: #F59E0B;
    }

    .mi-btn-submit {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        border: 0;
        border-radius: 10px;
        padding: 12px 20px;
        background: var(--mi-primary);
        color: #fff;
        font-size: 12.5px;
        font-weight: 700;
        cursor: pointer;
        transition: .2s ease;
    }

    .mi-btn-submit:hover {
        background: var(--mi-primary-dark);
        transform: translateY(-1px);
        box-shadow: 0 10px 20px rgba(51,118,242,.20);
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 600px) {

        .mi-page-header {
            flex-direction: column;
        }

        .mi-summary-top {
            flex-direction: column;
        }

        .mi-card-body {
            padding: 18px;
        }
    }
</style>


<div class="mi-page">

    <div class="mi-container">

        {{-- =====================================================
             PAGE HEADER
        ====================================================== --}}
        <div class="mi-page-header">

            <div>
                <h1 class="mi-page-heading">
                    Mock Interview with {{ $mockInterview->mentor->name }}
                </h1>

                <p class="mi-page-subheading">
                    Track the status, schedule and feedback for this session
                </p>
            </div>

            <a href="{{ route('student.mock-interviews.index') }}" class="mi-back-btn">
                <i class="fa-solid fa-arrow-left"></i>
                Back
            </a>

        </div>


        @if (session('success'))
            <div class="mi-alert">
                {{ session('success') }}
            </div>
        @endif


        {{-- =====================================================
             SUMMARY CARD
        ====================================================== --}}
        <div class="mi-card">

            <div class="mi-card-body">

                <div class="mi-summary-top">

                    <div class="mi-summary-mentor">

                        <div class="mi-mentor-avatar">
                            {{ strtoupper(substr($mockInterview->mentor->name ?? 'M', 0, 1)) }}
                        </div>

                        <div>
                            <div class="mi-summary-topic">
                                {{ $mockInterview->topic }}
                            </div>

                            <div class="mi-summary-with">
                                with {{ $mockInterview->mentor->name }}
                            </div>
                        </div>

                    </div>

                    <span class="mi-status
                        @class([
                            'pending'   => $mockInterview->status === 'pending',
                            'scheduled' => $mockInterview->status === 'scheduled',
                            'completed' => $mockInterview->status === 'completed',
                            'cancelled' => $mockInterview->status === 'cancelled',
                        ])">
                        <span class="mi-status-dot"></span>
                        {{ ucfirst($mockInterview->status) }}
                    </span>

                </div>


                <div class="mi-info-list">

                    @if ($mockInterview->status === 'pending')

                        <div class="mi-info-row">

                            <div class="mi-info-icon">
                                <i class="fa-regular fa-clock"></i>
                            </div>

                            <div>
                                <div class="mi-info-label">
                                    Your Requested Time
                                </div>

                                <div class="mi-info-value">
                                    {{ $mockInterview->requested_at->format('d M Y, h:i A') }}
                                </div>

                                <div class="mi-hint">
                                    Waiting for the mentor to confirm a slot.
                                </div>
                            </div>

                        </div>

                    @elseif ($mockInterview->status === 'scheduled')

                        <div class="mi-info-row">

                            <div class="mi-info-icon">
                                <i class="fa-regular fa-calendar-check"></i>
                            </div>

                            <div>
                                <div class="mi-info-label">
                                    Scheduled For
                                </div>

                                <div class="mi-info-value">
                                    {{ $mockInterview->scheduled_at->format('d M Y, h:i A') }}
                                </div>
                            </div>

                        </div>


                        <div class="mi-info-row">

                            <div class="mi-info-icon">
                                <i class="fa-solid fa-video"></i>
                            </div>

                            <div>
                                <div class="mi-info-label">
                                    Meeting Link
                                </div>

                                <a href="{{ $mockInterview->meeting_link }}" target="_blank" rel="noopener noreferrer" class="mi-join-btn">
                                    <i class="fa-solid fa-video"></i>
                                    Join Meeting
                                </a>
                            </div>

                        </div>

                    @elseif ($mockInterview->status === 'completed')

                        <div class="mi-info-row">

                            <div class="mi-info-icon">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>

                            <div>
                                <div class="mi-info-label">
                                    Held On
                                </div>

                                <div class="mi-info-value">
                                    {{ $mockInterview->scheduled_at->format('d M Y, h:i A') }}
                                </div>
                            </div>

                        </div>

                    @endif


                    @if ($mockInterview->student_notes)

                        <div class="mi-info-row">

                            <div class="mi-info-icon">
                                <i class="fa-regular fa-note-sticky"></i>
                            </div>

                            <div>
                                <div class="mi-info-label">
                                    Your Notes
                                </div>

                                <div class="mi-info-value">
                                    {{ $mockInterview->student_notes }}
                                </div>
                            </div>

                        </div>

                    @endif

                </div>

            </div>

        </div>


        {{-- =====================================================
             CANCEL
        ====================================================== --}}
        @if (in_array($mockInterview->status, ['pending', 'scheduled']))

            <form method="POST" action="{{ route('student.mock-interviews.cancel', $mockInterview) }}" style="margin-bottom: 20px;">

                @csrf
                @method('PATCH')

                <button
                    type="submit"
                    class="mi-cancel-btn"
                    onclick="return confirm('Cancel this mock interview?')"
                >
                    <i class="fa-solid fa-xmark"></i>
                    Cancel Request
                </button>

            </form>

        @endif


        {{-- =====================================================
             MENTOR FEEDBACK
        ====================================================== --}}
        @if ($mockInterview->mentor_feedback)

            <div class="mi-card">

                <div class="mi-card-header">

                    <div class="mi-card-header-icon">
                        <i class="fa-solid fa-comments"></i>
                    </div>

                    <div class="mi-card-header-title">
                        Mentor's Feedback
                    </div>

                </div>

                <div class="mi-card-body">

                    <div class="mi-rating-display">

                        <div class="mi-rating-stars">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fa-solid fa-star {{ $i > $mockInterview->mentor_rating ? 'empty' : '' }}"></i>
                            @endfor
                        </div>

                        <div class="mi-rating-number">
                            {{ $mockInterview->mentor_rating }}/5
                        </div>

                    </div>

                    <div class="mi-feedback-text">
                        {{ $mockInterview->mentor_feedback }}
                    </div>

                </div>

            </div>

        @endif


        {{-- =====================================================
             STUDENT FEEDBACK
        ====================================================== --}}
        @if ($mockInterview->status === 'completed')

            <div class="mi-card">

                <div class="mi-card-header">

                    <div class="mi-card-header-icon">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </div>

                    <div class="mi-card-header-title">
                        Your Feedback for the Mentor
                    </div>

                </div>

                <div class="mi-card-body">

                    @if ($mockInterview->student_feedback)

                        <div class="mi-rating-display">

                            <div class="mi-rating-stars">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fa-solid fa-star {{ $i > $mockInterview->student_rating ? 'empty' : '' }}"></i>
                                @endfor
                            </div>

                            <div class="mi-rating-number">
                                {{ $mockInterview->student_rating }}/5
                            </div>

                        </div>

                        <div class="mi-feedback-text">
                            {{ $mockInterview->student_feedback }}
                        </div>

                    @else

                        <form method="POST" action="{{ route('student.mock-interviews.feedback', $mockInterview) }}">

                            @csrf

                            <div class="mi-form-group">

                                <label>
                                    Rate the Mentor
                                </label>

                                <div class="mi-star-picker">

                                    @for ($i = 5; $i >= 1; $i--)
                                        <input type="radio" name="student_rating" id="star_{{ $i }}" value="{{ $i }}" required>
                                        <label for="star_{{ $i }}">
                                            <i class="fa-solid fa-star"></i>
                                        </label>
                                    @endfor

                                </div>

                            </div>

                            <div class="mi-form-group">

                                <label for="student_feedback">
                                    Feedback
                                </label>

                                <textarea
                                    id="student_feedback"
                                    name="student_feedback"
                                    class="mi-form-control"
                                    placeholder="How was your mock interview experience?"
                                    required
                                ></textarea>

                            </div>

                            <button type="submit" class="mi-btn-submit">
                                <i class="fa-solid fa-paper-plane"></i>
                                Submit Feedback
                            </button>

                        </form>

                    @endif

                </div>

            </div>

        @endif

    </div>

</div>

@endsection
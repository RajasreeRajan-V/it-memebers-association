@extends('layouts.app')

@section('content')

<style>
    /* =========================================================
       MOCK INTERVIEW PAGE
    ========================================================= */

    :root {
        --mi-primary: #3376F2;
        --mi-primary-dark: #245FD0;
        --mi-primary-light: #EEF4FF;
        --mi-success: #198754;
        --mi-success-light: #EAF8F0;
        --mi-danger: #DC3545;
        --mi-danger-light: #FFF0F1;
        --mi-warning: #F59E0B;
        --mi-warning-light: #FFF7E6;
        --mi-text: #172033;
        --mi-muted: #6B7280;
        --mi-border: #E5E7EB;
        --mi-bg: #F6F8FC;
        --mi-white: #FFFFFF;
        --mi-shadow: 0 8px 28px rgba(23, 32, 51, 0.07);
        --mi-radius: 16px;
    }

    .mock-interview-page {
        background: var(--mi-bg);
        min-height: calc(100vh - 70px);
        padding: 36px 0 60px;
    }

    .mock-interview-container {
        max-width: 1050px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* =========================================================
       PAGE HEADER
    ========================================================= */

    .mi-page-header {
        margin-bottom: 28px;
    }

    .mi-back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--mi-muted);
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 16px;
        transition: 0.2s ease;
    }

    .mi-back-link:hover {
        color: var(--mi-primary);
    }

    .mi-title-row {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
    }

    .mi-title-area {
        min-width: 0;
    }

    .mi-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        color: var(--mi-primary);
        background: var(--mi-primary-light);
        padding: 7px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: .02em;
        margin-bottom: 10px;
    }

    .mi-page-title {
        margin: 0;
        color: var(--mi-text);
        font-size: 30px;
        line-height: 1.25;
        font-weight: 700;
        letter-spacing: -0.02em;
    }

    .mi-page-subtitle {
        margin: 8px 0 0;
        color: var(--mi-muted);
        font-size: 15px;
        line-height: 1.6;
    }

    /* =========================================================
       STATUS BADGE
    ========================================================= */

    .mi-status-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 14px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 700;
        white-space: nowrap;
    }

    .mi-status-badge i {
        font-size: 8px;
    }

    .mi-status-pending {
        color: #9A6700;
        background: var(--mi-warning-light);
    }

    .mi-status-scheduled {
        color: #1769AA;
        background: var(--mi-primary-light);
    }

    .mi-status-completed {
        color: #146C43;
        background: var(--mi-success-light);
    }

    .mi-status-cancelled {
        color: #B02A37;
        background: var(--mi-danger-light);
    }

    /* =========================================================
       ALERTS
    ========================================================= */

    .mi-alert {
        border: 0;
        border-radius: 13px;
        padding: 14px 16px;
        margin-bottom: 22px;
        font-size: 14px;
        box-shadow: 0 3px 12px rgba(0, 0, 0, .03);
    }

    .mi-alert ul {
        padding-left: 20px;
    }

    .mi-alert li {
        margin-bottom: 3px;
    }

    /* =========================================================
       CARDS
    ========================================================= */

    .mi-card {
        background: var(--mi-white);
        border: 1px solid var(--mi-border);
        border-radius: var(--mi-radius);
        box-shadow: var(--mi-shadow);
        margin-bottom: 24px;
        overflow: hidden;
    }

    .mi-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 18px 22px;
        border-bottom: 1px solid var(--mi-border);
        background: #FCFDFF;
    }

    .mi-card-header-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .mi-card-icon {
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--mi-primary-light);
        color: var(--mi-primary);
        border-radius: 10px;
        flex-shrink: 0;
    }

    .mi-card-icon i {
        font-size: 15px;
    }

    .mi-card-title {
        margin: 0;
        color: var(--mi-text);
        font-size: 17px;
        font-weight: 700;
    }

    .mi-card-body {
        padding: 22px;
    }

    /* =========================================================
       INTERVIEW OVERVIEW
    ========================================================= */

    .mi-overview-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .mi-info-item {
        padding: 16px;
        border: 1px solid var(--mi-border);
        border-radius: 12px;
        background: #FAFBFD;
    }

    .mi-info-label {
        display: flex;
        align-items: center;
        gap: 7px;
        color: var(--mi-muted);
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .04em;
        margin-bottom: 7px;
    }

    .mi-info-label i {
        color: var(--mi-primary);
        font-size: 12px;
    }

    .mi-info-value {
        color: var(--mi-text);
        font-size: 15px;
        line-height: 1.55;
        font-weight: 600;
        word-break: break-word;
    }

    .mi-info-value.normal {
        font-weight: 500;
    }

    .mi-notes-box {
        margin-top: 18px;
        padding: 16px;
        background: #F8FAFF;
        border: 1px solid #DDE8FF;
        border-radius: 12px;
    }

    .mi-notes-title {
        color: var(--mi-text);
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 7px;
    }

    .mi-notes-text {
        margin: 0;
        color: #4B5563;
        font-size: 14px;
        line-height: 1.7;
        white-space: pre-line;
    }

    /* =========================================================
       MEETING LINK
    ========================================================= */

    .mi-meeting-link {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-top: 5px;
        color: var(--mi-primary);
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        word-break: break-all;
    }

    .mi-meeting-link:hover {
        color: var(--mi-primary-dark);
        text-decoration: underline;
    }

    /* =========================================================
       FORM
    ========================================================= */

    .mi-form-group {
        margin-bottom: 20px;
    }

    .mi-form-group:last-child {
        margin-bottom: 0;
    }

    .mi-label {
        display: block;
        color: var(--mi-text);
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .mi-required {
        color: var(--mi-danger);
    }

    .mi-input,
    .mi-select,
    .mi-textarea {
        width: 100%;
        border: 1px solid #D9DEE8;
        border-radius: 10px;
        padding: 11px 13px;
        color: var(--mi-text);
        background: #fff;
        font-size: 14px;
        outline: none;
        transition: border-color .2s ease, box-shadow .2s ease;
    }

    .mi-input,
    .mi-select {
        min-height: 44px;
    }

    .mi-textarea {
        resize: vertical;
        min-height: 115px;
    }

    .mi-input:focus,
    .mi-select:focus,
    .mi-textarea:focus {
        border-color: var(--mi-primary);
        box-shadow: 0 0 0 3px rgba(51, 118, 242, .11);
    }

    .mi-input.is-invalid,
    .mi-select.is-invalid,
    .mi-textarea.is-invalid {
        border-color: var(--mi-danger);
    }

    .mi-form-help {
        margin-top: 7px;
        color: var(--mi-muted);
        font-size: 12px;
        line-height: 1.5;
    }

    .mi-form-error {
        margin-top: 6px;
        color: var(--mi-danger);
        font-size: 12px;
    }

    .mi-form-row {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    /* =========================================================
       ACTION BUTTONS
    ========================================================= */

    .mi-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .mi-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 42px;
        padding: 10px 17px;
        border-radius: 10px;
        border: 1px solid transparent;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        transition: all .2s ease;
    }

    .mi-btn-primary {
        color: #fff;
        background: var(--mi-primary);
        border-color: var(--mi-primary);
    }

    .mi-btn-primary:hover {
        color: #fff;
        background: var(--mi-primary-dark);
        border-color: var(--mi-primary-dark);
        transform: translateY(-1px);
    }

    .mi-btn-success {
        color: #fff;
        background: var(--mi-success);
        border-color: var(--mi-success);
    }

    .mi-btn-success:hover {
        color: #fff;
        background: #157347;
        border-color: #157347;
        transform: translateY(-1px);
    }

    .mi-btn-danger {
        color: var(--mi-danger);
        background: #fff;
        border-color: #F0B7BD;
    }

    .mi-btn-danger:hover {
        color: #fff;
        background: var(--mi-danger);
        border-color: var(--mi-danger);
    }

    .mi-btn-secondary {
        color: #4B5563;
        background: #fff;
        border-color: var(--mi-border);
    }

    .mi-btn-secondary:hover {
        color: var(--mi-text);
        border-color: #C9CED8;
        background: #F9FAFB;
    }

    /* =========================================================
       FEEDBACK
    ========================================================= */

    .mi-rating {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        color: var(--mi-warning);
    }

    .mi-rating-number {
        color: var(--mi-text);
        margin-left: 5px;
        font-weight: 700;
    }

    .mi-feedback-content {
        padding: 16px;
        border-radius: 12px;
        background: #F8FAFC;
        border: 1px solid var(--mi-border);
    }

    .mi-feedback-content p {
        margin: 0;
        color: #4B5563;
        font-size: 14px;
        line-height: 1.75;
        white-space: pre-line;
    }

    .mi-feedback-rating {
        margin-bottom: 14px;
    }

    /* =========================================================
       RATING SELECT
    ========================================================= */

    .mi-rating-select {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 8px;
    }

    .mi-rating-option {
        position: relative;
    }

    .mi-rating-option input {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .mi-rating-option label {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 44px;
        border: 1px solid var(--mi-border);
        border-radius: 9px;
        color: var(--mi-muted);
        background: #fff;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        transition: .2s ease;
    }

    .mi-rating-option input:checked + label {
        color: #fff;
        background: var(--mi-primary);
        border-color: var(--mi-primary);
    }

    .mi-rating-option label:hover {
        border-color: var(--mi-primary);
        color: var(--mi-primary);
    }

    .mi-rating-option input:checked + label:hover {
        color: #fff;
    }

    /* =========================================================
       DIVIDER
    ========================================================= */

    .mi-divider {
        height: 1px;
        background: var(--mi-border);
        margin: 22px 0;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 767px) {

        .mock-interview-page {
            padding: 25px 0 45px;
        }

        .mock-interview-container {
            padding: 0 14px;
        }

        .mi-title-row {
            flex-direction: column;
            gap: 12px;
        }

        .mi-page-title {
            font-size: 24px;
        }

        .mi-page-subtitle {
            font-size: 14px;
        }

        .mi-status-badge {
            align-self: flex-start;
        }

        .mi-overview-grid,
        .mi-form-row {
            grid-template-columns: 1fr;
        }

        .mi-card-header,
        .mi-card-body {
            padding: 17px;
        }

        .mi-actions {
            width: 100%;
        }

        .mi-btn {
            width: 100%;
        }

        .mi-rating-select {
            gap: 6px;
        }
    }

    @media (max-width: 420px) {

        .mi-page-title {
            font-size: 22px;
        }

        .mi-card-title {
            font-size: 15px;
        }

        .mi-info-value {
            font-size: 14px;
        }

        .mi-rating-option label {
            height: 40px;
        }
    }
</style>


<div class="mock-interview-page">

    <div class="mock-interview-container">

        {{-- =====================================================
             PAGE HEADER
        ====================================================== --}}
        <div class="mi-page-header">

            <a href="{{ url()->previous() }}" class="mi-back-link">
                <i class="fa-solid fa-arrow-left"></i>
                Back
            </a>

            <div class="mi-title-row">

                <div class="mi-title-area">

                    <div class="mi-eyebrow">
                        <i class="fa-solid fa-video"></i>
                        Mock Interview
                    </div>

                    <h1 class="mi-page-title">
                        Mock Interview with {{ $mockInterview->student->name }}
                    </h1>

                    <p class="mi-page-subtitle">
                        Review the interview request, confirm the session, and provide feedback to the student.
                    </p>

                </div>

                @php
                    $statusClass = match($mockInterview->status) {
                        'pending' => 'mi-status-pending',
                        'scheduled' => 'mi-status-scheduled',
                        'completed' => 'mi-status-completed',
                        'cancelled' => 'mi-status-cancelled',
                        default => 'mi-status-pending',
                    };
                @endphp

                <span class="mi-status-badge {{ $statusClass }}">
                    <i class="fa-solid fa-circle"></i>
                    {{ ucfirst($mockInterview->status) }}
                </span>

            </div>
        </div>


        {{-- =====================================================
             SUCCESS MESSAGE
        ====================================================== --}}
        @if (session('success'))
            <div class="alert alert-success mi-alert">
                <i class="fa-solid fa-circle-check me-2"></i>
                {{ session('success') }}
            </div>
        @endif


        {{-- =====================================================
             VALIDATION ERRORS
        ====================================================== --}}
        @if ($errors->any())
            <div class="alert alert-danger mi-alert">

                <strong>
                    <i class="fa-solid fa-triangle-exclamation me-1"></i>
                    Please fix the following:
                </strong>

                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>
        @endif


        {{-- =====================================================
             INTERVIEW DETAILS
        ====================================================== --}}
        <div class="mi-card">

            <div class="mi-card-header">

                <div class="mi-card-header-left">

                    <div class="mi-card-icon">
                        <i class="fa-solid fa-clipboard-list"></i>
                    </div>

                    <h2 class="mi-card-title">
                        Interview Details
                    </h2>

                </div>

            </div>

            <div class="mi-card-body">

                <div class="mi-overview-grid">

                    {{-- Student --}}
                    <div class="mi-info-item">

                        <div class="mi-info-label">
                            <i class="fa-solid fa-user"></i>
                            Student
                        </div>

                        <div class="mi-info-value">
                            {{ $mockInterview->student->name }}
                        </div>

                    </div>


                    {{-- Topic --}}
                    <div class="mi-info-item">

                        <div class="mi-info-label">
                            <i class="fa-solid fa-book-open"></i>
                            Topic
                        </div>

                        <div class="mi-info-value">
                            {{ $mockInterview->topic }}
                        </div>

                    </div>


                    {{-- Requested Time --}}
                    @if ($mockInterview->status === 'pending')

                        <div class="mi-info-item">

                            <div class="mi-info-label">
                                <i class="fa-regular fa-clock"></i>
                                Requested Time
                            </div>

                            <div class="mi-info-value">
                                {{ $mockInterview->requested_at?->format('d M Y, h:i A') ?? 'Not specified' }}
                            </div>

                        </div>

                    @elseif (in_array($mockInterview->status, ['scheduled', 'completed']))

                        <div class="mi-info-item">

                            <div class="mi-info-label">
                                <i class="fa-regular fa-calendar-check"></i>
                                Scheduled For
                            </div>

                            <div class="mi-info-value">
                                {{ $mockInterview->scheduled_at?->format('d M Y, h:i A') ?? 'Not specified' }}
                            </div>

                        </div>

                    @endif


                    {{-- Meeting --}}
                    @if (in_array($mockInterview->status, ['scheduled', 'completed']))

                        <div class="mi-info-item">

                            <div class="mi-info-label">
                                <i class="fa-solid fa-link"></i>
                                Meeting
                            </div>

                            @if ($mockInterview->meeting_link)

                                <a
                                    href="{{ $mockInterview->meeting_link }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="mi-meeting-link"
                                >
                                    <i class="fa-solid fa-video"></i>
                                    Join Meeting
                                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                </a>

                            @else

                                <div class="mi-info-value normal">
                                    Meeting link not available
                                </div>

                            @endif

                        </div>

                    @endif

                </div>


                {{-- Student Notes --}}
                @if ($mockInterview->student_notes)

                    <div class="mi-notes-box">

                        <div class="mi-notes-title">
                            <i class="fa-regular fa-note-sticky me-1"></i>
                            Student's Notes
                        </div>

                        <p class="mi-notes-text">
                            {{ $mockInterview->student_notes }}
                        </p>

                    </div>

                @endif

            </div>

        </div>


        {{-- =====================================================
             SCHEDULE FORM
        ====================================================== --}}
        @if ($mockInterview->status === 'pending')

            <div class="mi-card">

                <div class="mi-card-header">

                    <div class="mi-card-header-left">

                        <div class="mi-card-icon">
                            <i class="fa-solid fa-calendar-plus"></i>
                        </div>

                        <h2 class="mi-card-title">
                            Confirm Slot & Schedule
                        </h2>

                    </div>

                </div>

                <div class="mi-card-body">

                    <form
                        method="POST"
                        action="{{ route('mentor.mock-interviews.schedule', $mockInterview) }}"
                    >

                        @csrf
                        @method('PATCH')


                        <div class="mi-form-row">

                            {{-- Date --}}
                            <div class="mi-form-group">

                                <label class="mi-label">
                                    Confirmed Date & Time
                                    <span class="mi-required">*</span>
                                </label>

                                <input
                                    type="datetime-local"
                                    name="scheduled_at"
                                    class="mi-input @error('scheduled_at') is-invalid @enderror"
                                    value="{{ old('scheduled_at', $mockInterview->requested_at?->format('Y-m-d\TH:i')) }}"
                                    required
                                >

                                @error('scheduled_at')
                                    <div class="mi-form-error">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- Meeting Link --}}
                            <div class="mi-form-group">

                                <label class="mi-label">
                                    Meeting Link
                                    <span class="mi-required">*</span>
                                </label>

                                <input
                                    type="url"
                                    name="meeting_link"
                                    class="mi-input @error('meeting_link') is-invalid @enderror"
                                    placeholder="https://meet.google.com/..."
                                    value="{{ old('meeting_link') }}"
                                    required
                                >

                                <div class="mi-form-help">
                                    Add your Google Meet, Zoom, Microsoft Teams, or other meeting link.
                                </div>

                                @error('meeting_link')
                                    <div class="mi-form-error">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>


                        <div class="mi-divider"></div>


                        <div class="mi-actions">

                            <button type="submit" class="mi-btn mi-btn-primary">
                                <i class="fa-solid fa-calendar-check"></i>
                                Confirm & Schedule
                            </button>

                        </div>

                    </form>

                </div>

            </div>


            {{-- Decline --}}
            <form
                method="POST"
                action="{{ route('mentor.mock-interviews.cancel', $mockInterview) }}"
                class="mb-4"
            >

                @csrf
                @method('PATCH')

                <button
                    type="submit"
                    class="mi-btn mi-btn-danger"
                    onclick="return confirm('Decline/cancel this request?')"
                >
                    <i class="fa-solid fa-xmark"></i>
                    Decline Request
                </button>

            </form>

        @endif


        {{-- =====================================================
             SCHEDULED ACTIONS
        ====================================================== --}}
        @if ($mockInterview->status === 'scheduled')

            <div class="mi-card">

                <div class="mi-card-header">

                    <div class="mi-card-header-left">

                        <div class="mi-card-icon">
                            <i class="fa-solid fa-gear"></i>
                        </div>

                        <h2 class="mi-card-title">
                            Interview Actions
                        </h2>

                    </div>

                </div>

                <div class="mi-card-body">

                    <div class="mi-actions">

                        {{-- Complete --}}
                        <form
                            method="POST"
                            action="{{ route('mentor.mock-interviews.complete', $mockInterview) }}"
                            class="m-0"
                        >

                            @csrf
                            @method('PATCH')

                            <button type="submit" class="mi-btn mi-btn-success">
                                <i class="fa-solid fa-circle-check"></i>
                                Mark as Completed
                            </button>

                        </form>


                        {{-- Cancel --}}
                        <form
                            method="POST"
                            action="{{ route('mentor.mock-interviews.cancel', $mockInterview) }}"
                            class="m-0"
                        >

                            @csrf
                            @method('PATCH')

                            <button
                                type="submit"
                                class="mi-btn mi-btn-danger"
                                onclick="return confirm('Cancel this scheduled interview?')"
                            >
                                <i class="fa-solid fa-calendar-xmark"></i>
                                Cancel Interview
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        @endif


        {{-- =====================================================
             STUDENT FEEDBACK
        ====================================================== --}}
        @if ($mockInterview->student_feedback)

            <div class="mi-card">

                <div class="mi-card-header">

                    <div class="mi-card-header-left">

                        <div class="mi-card-icon">
                            <i class="fa-solid fa-comment-dots"></i>
                        </div>

                        <h2 class="mi-card-title">
                            Student's Feedback
                        </h2>

                    </div>

                </div>

                <div class="mi-card-body">

                    @if ($mockInterview->student_rating)

                        <div class="mi-feedback-rating">

                            <span class="mi-info-label mb-2">
                                <i class="fa-solid fa-star"></i>
                                Rating
                            </span>

                            <div class="mi-rating">

                                @for ($i = 1; $i <= 5; $i++)

                                    @if ($i <= $mockInterview->student_rating)
                                        <i class="fa-solid fa-star"></i>
                                    @else
                                        <i class="fa-regular fa-star"></i>
                                    @endif

                                @endfor

                                <span class="mi-rating-number">
                                    {{ $mockInterview->student_rating }}/5
                                </span>

                            </div>

                        </div>

                    @endif


                    <div class="mi-feedback-content">
                        <p>{{ $mockInterview->student_feedback }}</p>
                    </div>

                </div>

            </div>

        @endif


        {{-- =====================================================
             MENTOR FEEDBACK
        ====================================================== --}}
        @if ($mockInterview->status === 'completed')

            <div class="mi-card">

                <div class="mi-card-header">

                    <div class="mi-card-header-left">

                        <div class="mi-card-icon">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </div>

                        <h2 class="mi-card-title">
                            Your Feedback for the Student
                        </h2>

                    </div>

                </div>

                <div class="mi-card-body">

                    @if ($mockInterview->mentor_feedback)

                        <div class="mi-feedback-rating">

                            <div class="mi-info-label mb-2">
                                <i class="fa-solid fa-star"></i>
                                Your Rating
                            </div>

                            <div class="mi-rating">

                                @for ($i = 1; $i <= 5; $i++)

                                    @if ($i <= $mockInterview->mentor_rating)
                                        <i class="fa-solid fa-star"></i>
                                    @else
                                        <i class="fa-regular fa-star"></i>
                                    @endif

                                @endfor

                                <span class="mi-rating-number">
                                    {{ $mockInterview->mentor_rating }}/5
                                </span>

                            </div>

                        </div>


                        <div class="mi-feedback-content">
                            <p>{{ $mockInterview->mentor_feedback }}</p>
                        </div>

                    @else

                        <form
                            method="POST"
                            action="{{ route('mentor.mock-interviews.feedback', $mockInterview) }}"
                        >

                            @csrf


                            {{-- Rating --}}
                            <div class="mi-form-group">

                                <label class="mi-label">
                                    Rate the Student
                                    <span class="mi-required">*</span>
                                </label>

                                <div class="mi-rating-select">

                                    @for ($i = 1; $i <= 5; $i++)

                                        <div class="mi-rating-option">

                                            <input
                                                type="radio"
                                                id="rating{{ $i }}"
                                                name="mentor_rating"
                                                value="{{ $i }}"
                                                {{ old('mentor_rating', 5) == $i ? 'checked' : '' }}
                                                required
                                            >

                                            <label for="rating{{ $i }}">
                                                {{ $i }}
                                                <i class="fa-solid fa-star ms-1"></i>
                                            </label>

                                        </div>

                                    @endfor

                                </div>

                                @error('mentor_rating')
                                    <div class="mi-form-error">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- Feedback --}}
                            <div class="mi-form-group">

                                <label class="mi-label">
                                    Feedback
                                    <span class="mi-required">*</span>
                                </label>

                                <textarea
                                    name="mentor_feedback"
                                    class="mi-textarea @error('mentor_feedback') is-invalid @enderror"
                                    rows="5"
                                    placeholder="Share constructive feedback about the student's interview performance..."
                                    required
                                >{{ old('mentor_feedback') }}</textarea>

                                @error('mentor_feedback')
                                    <div class="mi-form-error">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            <div class="mi-divider"></div>


                            <div class="mi-actions">

                                <button type="submit" class="mi-btn mi-btn-primary">
                                    <i class="fa-solid fa-paper-plane"></i>
                                    Submit Feedback
                                </button>

                            </div>

                        </form>

                    @endif

                </div>

            </div>

        @endif

    </div>

</div>

@endsection
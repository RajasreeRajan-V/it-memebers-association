{{-- resources/views/students/resume/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Resume Feedback')

@section('content')

<div class="resume-feedback-page">

    {{-- =========================================================
        HERO - WEBINAR STYLE WITH WHITE BG (FULL WIDTH)
    ========================================================== --}}
    <div class="resume-hero mb-4">
        <div class="hero-content">
            <span class="hero-eyebrow">
                <i class="fa-solid fa-graduation-cap"></i>
                {{ $counts['pending'] ?? 0 }}+ Awaiting Review
            </span>

            <h1>
                Resume Reviews
                <span>Built By Mentors, For Mentees</span>
            </h1>

            <p>
                Review students' resumes and provide constructive feedback to help them
                improve, stand out, and land the roles they're aiming for.
            </p>

            <div class="mentor-header-actions">
                <a href="{{ route('mentor.resume-reviews.index', ['tab' => 'pending']) }}" class="hero-btn">
                    <i class="fa-solid fa-arrow-right-to-bracket"></i>
                    Start Reviewing
                </a>
            </div>
        </div>

        <div class="hero-visual">
            <div class="resume-paper">
                <div class="paper-top">
                    <div class="paper-avatar"></div>
                    <div class="paper-lines">
                        <span></span>
                        <span style="width: 70%;"></span>
                    </div>
                </div>
                <div class="paper-section"></div>
                <div class="paper-line long"></div>
                <div class="paper-line medium"></div>
                <div class="paper-line long"></div>
                <div class="paper-line medium"></div>
                <div class="paper-line long" style="width: 55%;"></div>
            </div>
            <div class="hero-search">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <div class="hero-check">
                <i class="fa-solid fa-check"></i>
            </div>
        </div>

        <div class="hero-benefits">
            <div class="hero-benefit">
                <div class="benefit-icon blue">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div>
                    <strong>Expert Mentors</strong>
                    <small>Verified professionals</small>
                </div>
            </div>
            <div class="hero-benefit">
                <div class="benefit-icon purple">
                    <i class="fa-solid fa-clock"></i>
                </div>
                <div>
                    <strong>Quick Turnaround</strong>
                    <small>Feedback within days</small>
                </div>
            </div>
            <div class="hero-benefit">
                <div class="benefit-icon orange">
                    <i class="fa-solid fa-star"></i>
                </div>
                <div>
                    <strong>Quality Feedback</strong>
                    <small>Actionable insights</small>
                </div>
            </div>
        </div>
    </div>

    {{-- =========================================================
        MAIN GRID
    ========================================================== --}}
    <div class="resume-main-grid">

        {{-- =====================================================
            LEFT - SUBMIT RESUME REQUEST
        ====================================================== --}}
        <section class="resume-panel submit-panel" id="submit-resume-request">

            <div class="panel-header">
                <div>
                    <h2>
                        <span class="step-number">1</span>
                        Submit Resume Request
                    </h2>
                    <p>Fill in the details below to request a resume review.</p>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success" style="margin: 14px 18px; padding: 14px; border-radius: 9px; background: #e8f8f0; color: #0f7b4e; font-size: 13px; border: 1px solid #b8e6d0;">
                    <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger" style="margin: 14px 18px; padding: 14px; border-radius: 9px; background: #fde8e8; color: #c0392b; font-size: 13px; border: 1px solid #f5c6c6;">
                    <i class="fa-solid fa-exclamation-circle"></i> Please fix the errors below.
                </div>
            @endif

            <form
                action="{{ route('student.resume-review.store') }}"
                method="POST"
                enctype="multipart/form-data"
                id="resumeReviewForm"
                class="resume-request-form"
                novalidate
            >
                @csrf

                {{-- MENTOR SELECTION --}}
                <div class="form-group">
                    <label for="mentor_id">
                        Select Mentor <span class="required">*</span>
                    </label>

                    <select name="mentor_id" id="mentor_id" required>
                        <option value="">Choose a mentor</option>
                        @foreach($mentors as $mentor)
                            <option value="{{ $mentor->id }}" {{ old('mentor_id') == $mentor->id ? 'selected' : '' }}>
                                {{ $mentor->name }} - {{ $mentor->title ?? 'Resume Mentor' }}
                            </option>
                        @endforeach
                    </select>

                    @error('mentor_id')
                        <small class="form-error">{{ $message }}</small>
                    @enderror
                </div>

                {{-- RESUME UPLOAD --}}
                <div class="form-group">
                    <label for="resume">
                        Upload Your Resume <span class="required">*</span>
                    </label>

                    <div class="resume-upload-box" id="resumeUploadBox">
                        <input
                            type="file"
                            name="resume"
                            id="resume"
                            accept=".pdf,.doc,.docx"
                            hidden
                        >

                        <label for="resume" class="upload-label" id="uploadLabel">
                            <div class="upload-icon">
                                <i class="fa-solid fa-cloud-arrow-up"></i>
                            </div>

                            <div class="upload-content">
                                <strong>Click to upload or drag and drop</strong>
                                <span>PDF, DOC, DOCX (Max. 5MB)</span>
                            </div>
                        </label>

                        <div class="selected-file" id="selectedFile" style="display:none;">
                            <div class="selected-file-icon">
                                <i class="fa-solid fa-file-pdf"></i>
                            </div>

                            <div class="selected-file-info">
                                <strong id="fileName">Resume.pdf</strong>
                                <span id="fileSize">0 KB</span>
                            </div>

                            <button type="button" class="remove-file" id="removeFile" aria-label="Remove resume">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </div>

                    @error('resume')
                        <small class="form-error">{{ $message }}</small>
                    @enderror
                </div>

                {{-- REVIEW TYPE --}}
                <div class="form-group">
                    <label for="review_type">
                        What type of review do you need? <span class="required">*</span>
                    </label>

                    <select name="review_type" id="review_type" required>
                        <option value="">Select review type</option>
                        <option value="General Resume Review" {{ old('review_type') === 'General Resume Review' ? 'selected' : '' }}>General Resume Review</option>
                        <option value="ATS Optimization" {{ old('review_type') === 'ATS Optimization' ? 'selected' : '' }}>ATS Optimization</option>
                        <option value="Job Specific Review" {{ old('review_type') === 'Job Specific Review' ? 'selected' : '' }}>Job Specific Review</option>
                        <option value="Career Change" {{ old('review_type') === 'Career Change' ? 'selected' : '' }}>Career Change</option>
                        <option value="Experienced Professional" {{ old('review_type') === 'Experienced Professional' ? 'selected' : '' }}>Experienced Professional</option>
                        <option value="Fresher Resume" {{ old('review_type') === 'Fresher Resume' ? 'selected' : '' }}>Fresher Resume</option>
                    </select>

                    @error('review_type')
                        <small class="form-error">{{ $message }}</small>
                    @enderror
                </div>

                {{-- GOAL --}}
                <div class="form-group">
                    <label for="goal">
                        What is your goal? <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        name="goal"
                        id="goal"
                        value="{{ old('goal') }}"
                        placeholder="I want to improve my resume for job applications in software development."
                        required
                    >

                    @error('goal')
                        <small class="form-error">{{ $message }}</small>
                    @enderror
                </div>

                {{-- FEEDBACK FOCUS --}}
                <div class="form-group">
                    <label>
                        What specific areas would you like feedback on? <span class="required">*</span>
                    </label>

                    <div class="feedback-select">
                        @foreach (['Overall Structure', 'Skills Section', 'Experience', 'Projects'] as $focus)
                            <label class="checkbox-option">
                                <input
                                    type="checkbox"
                                    name="feedback_focus[]"
                                    value="{{ $focus }}"
                                    {{ in_array($focus, old('feedback_focus', [])) ? 'checked' : '' }}
                                >
                                <span>{{ $focus }}</span>
                            </label>
                        @endforeach
                    </div>

                    @error('feedback_focus')
                        <small class="form-error">{{ $message }}</small>
                    @enderror
                </div>

                {{-- PREFERRED TIME + NOTES --}}
                <div class="form-row">
                    <div class="form-group">
                        <label for="preferred_completion_time">Preferred Completion Time</label>

                        <select name="preferred_completion_time" id="preferred_completion_time">
                            <option value="">Select time</option>
                            <option value="Within 1 day" {{ old('preferred_completion_time') === 'Within 1 day' ? 'selected' : '' }}>Within 1 day</option>
                            <option value="Within 3 days" {{ old('preferred_completion_time') === 'Within 3 days' ? 'selected' : '' }}>Within 3 days</option>
                            <option value="Within 5 days" {{ old('preferred_completion_time') === 'Within 5 days' ? 'selected' : '' }}>Within 5 days</option>
                            <option value="Within 7 days" {{ old('preferred_completion_time') === 'Within 7 days' ? 'selected' : '' }}>Within 7 days</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="additional_instructions">Additional Notes</label>

                        <input
                            type="text"
                            name="additional_instructions"
                            id="additional_instructions"
                            value="{{ old('additional_instructions') }}"
                            placeholder="Any specific instructions for the mentor..."
                        >
                    </div>
                </div>

                {{-- SUBMIT --}}
                <button type="submit" class="submit-request-btn" id="submitRequestBtn">
                    <i class="fa-solid fa-paper-plane"></i>
                    <span>Submit Request</span>
                </button>

                <div class="secure-note">
                    <i class="fa-solid fa-shield-halved"></i>
                    Your resume will be sent to the mentor after submission.
                </div>
            </form>
        </section>

        {{-- =====================================================
            CENTER - SELECT MENTOR + HOW IT WORKS
        ====================================================== --}}
        <div class="mentor-column">

        <section class="resume-panel mentor-panel">

            <div class="panel-header">

                <div>

                    <h2>
                        <i class="fa-solid fa-user-tie"></i>
                        Select a Mentor
                    </h2>

                    <p>
                        Choose the right mentor for your resume
                    </p>

                </div>

                <a
                    href="{{ route('student.mentors.index') }}"
                    class="view-link"
                >
                    View All Mentors
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

            </div>

            <div class="mentor-list">

                @forelse ($mentors as $mentor)

                    <div class="mentor-item">

                        <img
                            src="{{ $mentor->avatar_url
                                ?? 'https://ui-avatars.com/api/?name='
                                . urlencode($mentor->name)
                                . '&background=random'
                            }}"
                            alt="{{ $mentor->name }}"
                            class="mentor-avatar"
                        >

                        <div class="mentor-info">

                            <strong>
                                {{ $mentor->name }}
                            </strong>

                            <span>
                                {{ $mentor->title ?? 'Resume Mentor' }}
                            </span>

                            <small>
                                <i class="fa-solid fa-circle-check"></i>
                                Verified Mentor
                            </small>

                        </div>

                        <button 
                            type="button"
                            class="select-mentor-btn"
                            data-mentor-id="{{ $mentor->id }}"
                            data-mentor-name="{{ $mentor->name }}"
                        >
                            Select
                        </button>

                    </div>

                @empty

                    <div class="empty-mentor">

                        <i class="fa-solid fa-user-slash"></i>

                        <p>
                            No mentors available right now.
                        </p>

                    </div>

                @endforelse

            </div>

            @if(method_exists($mentors, 'hasPages') && $mentors->hasPages())
                <div class="request-pagination">
                    {{ $mentors->links() }}
                </div>
            @endif

            <div class="mentor-note">

                <i class="fa-solid fa-circle-info"></i>

                <span>
                    All mentors are verified professionals with
                    experience in resume development and career guidance.
                </span>

            </div>

        </section>

        {{-- =====================================================
            HOW IT WORKS - placed under Select a Mentor
        ====================================================== --}}
        <section class="resume-panel how-it-works-section">

            <div class="panel-header">
                <div>
                    <h2>
                        <i class="fa-regular fa-lightbulb"></i>
                        How It Works
                    </h2>
                    <p>Get better feedback in four simple steps</p>
                </div>
            </div>

            <div class="steps-grid">

                <div class="step-row-item">
                    <span class="step-icon step-blue">
                        <i class="fa-solid fa-file-arrow-up"></i>
                    </span>
                    <strong>Submit Request</strong>
                    <p>Upload your resume and tell us what you want to improve.</p>
                </div>

                <div class="step-row-item">
                    <span class="step-icon step-purple">
                        <i class="fa-solid fa-user-check"></i>
                    </span>
                    <strong>Choose a Mentor</strong>
                    <p>Select a mentor based on their expertise and experience.</p>
                </div>

                <div class="step-row-item">
                    <span class="step-icon step-green">
                        <i class="fa-solid fa-comments"></i>
                    </span>
                    <strong>Get Feedback</strong>
                    <p>Your mentor reviews your resume and provides useful suggestions.</p>
                </div>

                <div class="step-row-item">
                    <span class="step-icon step-orange">
                        <i class="fa-solid fa-arrow-up-right-dots"></i>
                    </span>
                    <strong>Improve & Apply</strong>
                    <p>Update your resume and apply confidently for opportunities.</p>
                </div>

            </div>

        </section>

        </div>

        {{-- =====================================================
            RIGHT - YOUR RECENT REQUESTS + JOURNEY STATS
        ====================================================== --}}
        <div class="requests-column">

        <aside class="resume-panel requests-panel">

            <div class="panel-header">

                <div>

                    <h2>
                        <i class="fa-solid fa-file-lines"></i>
                        Your Recent Requests
                    </h2>

                    <p>
                        Track the status of your submissions
                    </p>

                </div>

            </div>

            @if($myRequests->count() > 0)

                <div class="request-list">
                    @foreach($myRequests as $request)
                        @php
                            $badge = match ($request->status) {
                                'completed' => ['label' => 'Reviewed', 'class' => 'status-completed'],
                                'in_review' => ['label' => 'In Progress', 'class' => 'status-progress'],
                                default => ['label' => 'Pending', 'class' => 'status-pending'],
                            };
                        @endphp
                        <div class="request-item" data-bs-toggle="modal" data-bs-target="#requestModal{{ $request->id }}" style="cursor: pointer;">
                            <div class="request-item-icon">
                                <i class="fa-solid fa-file-lines"></i>
                            </div>
                            <div class="request-item-content">
                                <div class="request-title-row">
                                    <strong>{{ $request->review_type }}</strong>
                                    <span class="status-pill {{ $badge['class'] }}">{{ $badge['label'] }}</span>
                                </div>
                                <div class="request-meta">
                                    <span>{{ $request->created_at ? $request->created_at->format('d M Y') : '—' }}</span>
                                    <span>•</span>
                                    <span>{{ $request->mentor->name ?? 'Unassigned' }}</span>
                                </div>
                            </div>
                            <div class="request-arrow">
                                <i class="fa-solid fa-chevron-right"></i>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($myRequests->hasPages())
                    <div class="request-pagination">
                        {{ $myRequests->links() }}
                    </div>
                @endif

            @else

                <div class="empty-request">

                    <div class="empty-icon">
                        <i class="fa-solid fa-file-circle-plus"></i>
                    </div>

                    <h3>No Requests Yet</h3>

                    <p>
                        Submit your resume to get feedback from a mentor.
                    </p>

                    <a href="#submit-resume-request" class="small-primary-btn">
                        <i class="fa-solid fa-paper-plane"></i>
                        Submit Request
                    </a>

                </div>

            @endif

        </aside>

        {{-- =====================================================
            YOUR RESUME REVIEW JOURNEY - placed under Your Recent Requests
        ====================================================== --}}
        <section class="resume-panel status-section">

            <div class="status-section-header">

                <div>

                    <span class="section-label">
                        REQUEST OVERVIEW
                    </span>

                    <h2>
                        Your Resume Review Journey
                    </h2>

                </div>

            </div>

            <div class="status-grid">

                <div class="status-card">

                    <div class="status-card-icon blue">
                        <i class="fa-solid fa-file-lines"></i>
                    </div>

                    <div>

                        <strong>
                            {{ $requestCounts['total'] ?? 0 }}
                        </strong>

                        <span>
                            Total Requests
                        </span>

                    </div>

                </div>

                <div class="status-card">

                    <div class="status-card-icon orange">
                        <i class="fa-regular fa-clock"></i>
                    </div>

                    <div>

                        <strong>
                            {{ $requestCounts['pending'] ?? 0 }}
                        </strong>

                        <span>
                            Awaiting Mentor
                        </span>

                    </div>

                </div>

                <div class="status-card">

                    <div class="status-card-icon purple">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>

                    <div>

                        <strong>
                            {{ $requestCounts['in_review'] ?? 0 }}
                        </strong>

                        <span>
                            In Progress
                        </span>

                    </div>

                </div>

                <div class="status-card">

                    <div class="status-card-icon green">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>

                    <div>

                        <strong>
                            {{ $requestCounts['completed'] ?? 0 }}
                        </strong>

                        <span>
                            Reviewed
                        </span>

                    </div>

                </div>

            </div>
        </section>

        </div>

    </div>

    {{-- =========================================================
        REQUEST DETAIL MODALS
    ========================================================== --}}

    @foreach ($myRequests as $request)

        @php

            $badge = match ($request->status) {

                'completed' => [
                    'label' => 'Reviewed',
                    'class' => 'status-completed'
                ],

                'in_review' => [
                    'label' => 'In Progress',
                    'class' => 'status-progress'
                ],

                default => [
                    'label' => 'Pending',
                    'class' => 'status-pending'
                ],

            };

            $ratings = [
                'Overall Rating' => $request->overall_rating,
                'Resume Quality' => $request->resume_quality,
                'Relevance' => $request->relevance,
                'Presentation' => $request->presentation,
            ];

        @endphp

        <div
            class="modal fade"
            id="requestModal{{ $request->id }}"
            tabindex="-1"
            aria-labelledby="requestModalLabel{{ $request->id }}"
            aria-hidden="true"
        >

            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">

                <div class="modal-content modern-modal">

                    {{-- MODAL HEADER --}}
                    <div class="modal-header">

                        <div>

                            <span class="modal-label">
                                RESUME REVIEW
                            </span>

                            <h5
                                class="modal-title"
                                id="requestModalLabel{{ $request->id }}"
                            >
                                {{ $request->review_type }}
                            </h5>

                            <span class="status-pill {{ $badge['class'] }}">
                                {{ $badge['label'] }}
                            </span>

                        </div>

                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>

                    </div>

                    {{-- MODAL BODY --}}
                    <div class="modal-body">

                        <div class="modal-info-grid">

                            <div>

                                <span>
                                    Mentor
                                </span>

                                <strong>

                                    @if ($request->mentor)

                                        <img
                                            src="https://ui-avatars.com/api/?name={{ urlencode($request->mentor->name) }}&background=random"
                                            width="28"
                                            height="28"
                                            class="rounded-circle me-1"
                                            alt=""
                                        >

                                        {{ $request->mentor->name }}

                                    @else

                                        Unassigned

                                    @endif

                                </strong>

                            </div>

                            <div>

                                <span>
                                    Requested
                                </span>

                                <strong>
                                    {{ $request->created_at
                                        ? $request->created_at->format('d M Y, h:i A')
                                        : '—'
                                    }}
                                </strong>

                            </div>

                            <div>

                                <span>
                                    Preferred Completion
                                </span>

                                <strong>
                                    {{ $request->preferred_completion_time ?? '—' }}
                                </strong>

                            </div>

                            <div>

                                <span>
                                    Resume
                                </span>

                                @if ($request->resume_path)

                                    <a
                                        href="{{ Storage::url($request->resume_path) }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                    >
                                        <i class="fa-solid fa-file-arrow-down"></i>
                                        {{ $request->resume_original_name ?? 'View Resume' }}
                                    </a>

                                @else

                                    <strong>
                                        Resume unavailable
                                    </strong>

                                @endif

                            </div>

                        </div>

                        {{-- GOAL --}}
                        @if ($request->goal)

                            <div class="modal-content-block">

                                <span>
                                    Goal
                                </span>

                                <p>
                                    {{ $request->goal }}
                                </p>

                            </div>

                        @endif

                        {{-- FEEDBACK FOCUS --}}
                        @if (!empty($request->feedback_focus))

                            <div class="modal-content-block">

                                <span>
                                    Feedback Focus
                                </span>

                                <div class="focus-tags">

                                    @foreach ($request->feedback_focus as $focus)

                                        <span>
                                            {{ $focus }}
                                        </span>

                                    @endforeach

                                </div>

                            </div>

                        @endif

                        <hr>

                        {{-- COMPLETED --}}
                        @if ($request->status === 'completed')

                            <div class="feedback-heading">

                                <div>

                                    <span class="modal-label">
                                        MENTOR FEEDBACK
                                    </span>

                                    <h5>
                                        Your Resume Evaluation
                                    </h5>

                                </div>

                            </div>

                            <div class="rating-grid">

                                @foreach ($ratings as $label => $value)

                                    <div class="rating-box">

                                        <span>
                                            {{ $label }}
                                        </span>

                                        <strong>

                                            @if ($value !== null)

                                                {{ $value }}/5

                                                <i class="fa-solid fa-star"></i>

                                            @else

                                                —

                                            @endif

                                        </strong>

                                    </div>

                                @endforeach

                            </div>

                            @if ($request->strengths)

                                <div class="feedback-block success">

                                    <div class="feedback-icon">
                                        <i class="fa-solid fa-circle-check"></i>
                                    </div>

                                    <div>

                                        <strong>
                                            Strengths
                                        </strong>

                                        <p>
                                            {{ $request->strengths }}
                                        </p>

                                    </div>

                                </div>

                            @endif

                            @if ($request->areas_to_improve)

                                <div class="feedback-block warning">

                                    <div class="feedback-icon">
                                        <i class="fa-solid fa-triangle-exclamation"></i>
                                    </div>

                                    <div>

                                        <strong>
                                            Areas to Improve
                                        </strong>

                                        <p>
                                            {{ $request->areas_to_improve }}
                                        </p>

                                    </div>

                                </div>

                            @endif

                            @if ($request->additional_comments)

                                <div class="feedback-block">

                                    <div class="feedback-icon">
                                        <i class="fa-solid fa-message"></i>
                                    </div>

                                    <div>

                                        <strong>
                                            Additional Comments
                                        </strong>

                                        <p>
                                            {{ $request->additional_comments }}
                                        </p>

                                    </div>

                                </div>

                            @endif

                        {{-- PENDING / IN REVIEW --}}
                        @else

                            <div class="waiting-feedback">

                                <div class="waiting-icon">
                                    <i class="fa-regular fa-clock"></i>
                                </div>

                                <h4>
                                    Feedback Is On The Way
                                </h4>

                                <p>
                                    Your mentor hasn't submitted feedback yet.
                                    We'll update this request once the review is complete.
                                </p>

                            </div>

                        @endif

                    </div>

                    {{-- MODAL FOOTER --}}
                    <div class="modal-footer">

                        <button
                            type="button"
                            class="modal-close-btn"
                            data-bs-dismiss="modal"
                        >
                            Close
                        </button>

                    </div>

                </div>

            </div>

        </div>

    @endforeach

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('SCRIPT RAN. fileInput:', document.getElementById('resume'));
    console.log('mentor buttons found:', document.querySelectorAll('.select-mentor-btn').length);
    console.log('form found:', document.getElementById('resumeReviewForm'));
    // ============================================
    // 1. FILE UPLOAD HANDLING
    // ============================================
    const fileInput = document.getElementById('resume');
    const uploadBox = document.getElementById('resumeUploadBox');
    const uploadLabel = document.getElementById('uploadLabel');
    const selectedFile = document.getElementById('selectedFile');
    const fileName = document.getElementById('fileName');
    const fileSize = document.getElementById('fileSize');
    const removeFileBtn = document.getElementById('removeFile');

    if (fileInput) {
        // Handle file selection
        fileInput.addEventListener('change', function() {
            if (this.files && this.files.length > 0) {
                const file = this.files[0];
                const validExtensions = ['pdf', 'doc', 'docx'];
                const ext = file.name.split('.').pop().toLowerCase();
                const maxSize = 5 * 1024 * 1024;

                if (!validExtensions.includes(ext)) {
                    alert('Please upload a PDF, DOC, or DOCX file.');
                    this.value = '';
                    return;
                }

                if (file.size > maxSize) {
                    alert('File size must be less than 5MB.');
                    this.value = '';
                    return;
                }

                // Show file info
                fileName.textContent = file.name;
                const sizeInKB = (file.size / 1024).toFixed(1);
                fileSize.textContent = sizeInKB >= 1024 ? (file.size / (1024 * 1024)).toFixed(2) + ' MB' : sizeInKB + ' KB';
                uploadLabel.style.display = 'none';
                selectedFile.style.display = 'flex';
            }
        });

        // Handle remove file
        if (removeFileBtn) {
            removeFileBtn.addEventListener('click', function(e) {
                e.preventDefault();
                fileInput.value = '';
                uploadLabel.style.display = 'flex';
                selectedFile.style.display = 'none';
            });
        }

        // Drag and drop
        if (uploadBox) {
            uploadBox.addEventListener('dragover', function(e) {
                e.preventDefault();
                this.classList.add('drag-over');
            });

            uploadBox.addEventListener('dragleave', function(e) {
                e.preventDefault();
                this.classList.remove('drag-over');
            });

            uploadBox.addEventListener('drop', function(e) {
                e.preventDefault();
                this.classList.remove('drag-over');
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    fileInput.files = files;
                    fileInput.dispatchEvent(new Event('change'));
                }
            });
        }
    }

    // ============================================
    // 2. MENTOR SELECT BUTTONS
    // ============================================
    document.querySelectorAll('.select-mentor-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const mentorId = this.getAttribute('data-mentor-id');
            const mentorName = this.getAttribute('data-mentor-name');
            
            const selectElement = document.getElementById('mentor_id');
            if (selectElement) {
                selectElement.value = mentorId;
                // Trigger change event
                const event = new Event('change');
                selectElement.dispatchEvent(event);
                
                // Show feedback
                const mentorInfo = document.querySelector('.mentor-item [data-mentor-id="' + mentorId + '"]');
                const submitPanel = document.getElementById('submit-resume-request');
                if (submitPanel) {
                    submitPanel.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
                
                // Highlight the selection
                const mentorItems = document.querySelectorAll('.mentor-item');
                mentorItems.forEach(item => {
                    item.style.border = 'none';
                });
                const parentItem = this.closest('.mentor-item');
                if (parentItem) {
                    parentItem.style.border = '2px solid #3378e5';
                    parentItem.style.borderRadius = '8px';
                    parentItem.style.padding = '7px 5px';
                }
            }
        });
    });

    // ============================================
    // 3. FORM SUBMISSION
    // ============================================
    const form = document.getElementById('resumeReviewForm');
    const submitBtn = document.getElementById('submitRequestBtn');

    if (form) {
        form.addEventListener('submit', function(e) {
            // Check if file is selected
            const fileInput = document.getElementById('resume');
            if (!fileInput || !fileInput.files || fileInput.files.length === 0) {
                e.preventDefault();
                alert('Please upload your resume.');
                return false;
            }

            // Check if mentor is selected
            const mentorSelect = document.getElementById('mentor_id');
            if (!mentorSelect || !mentorSelect.value) {
                e.preventDefault();
                alert('Please select a mentor.');
                mentorSelect.focus();
                return false;
            }

            // Check if review type is selected
            const reviewType = document.getElementById('review_type');
            if (!reviewType || !reviewType.value) {
                e.preventDefault();
                alert('Please select a review type.');
                reviewType.focus();
                return false;
            }

            // Check if goal is filled
            const goal = document.getElementById('goal');
            if (!goal || !goal.value.trim()) {
                e.preventDefault();
                alert('Please describe your goal.');
                goal.focus();
                return false;
            }

            // Check if at least one feedback focus is selected
            const focusCheckboxes = form.querySelectorAll('input[name="feedback_focus[]"]:checked');
            if (focusCheckboxes.length === 0) {
                e.preventDefault();
                alert('Please select at least one feedback area.');
                return false;
            }

            // Disable submit button
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i><span>Submitting...</span>';
            }

            return true;
        });
    }

    // ============================================
    // 4. MODAL HANDLING (Fallback if Bootstrap JS is missing)
    // ============================================
    document.querySelectorAll('.request-item').forEach(function(item) {
        item.addEventListener('click', function() {
            const target = this.getAttribute('data-bs-target');
            if (target) {
                const modal = document.querySelector(target);
                if (modal) {
                    // Check if Bootstrap is available
                    if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                        const modalInstance = bootstrap.Modal.getOrCreateInstance(modal);
                        modalInstance.show();
                    } else {
                        // Fallback: simple show/hide
                        modal.style.display = 'block';
                        modal.classList.add('show');
                        document.body.classList.add('modal-open');
                        
                        // Add backdrop
                        let backdrop = document.querySelector('.modal-backdrop');
                        if (!backdrop) {
                            backdrop = document.createElement('div');
                            backdrop.className = 'modal-backdrop fade show';
                            document.body.appendChild(backdrop);
                        }
                        
                        // Close button
                        const closeBtn = modal.querySelector('.btn-close, .modal-close-btn');
                        if (closeBtn) {
                            closeBtn.addEventListener('click', function() {
                                modal.style.display = 'none';
                                modal.classList.remove('show');
                                document.body.classList.remove('modal-open');
                                const backdrop = document.querySelector('.modal-backdrop');
                                if (backdrop) backdrop.remove();
                            });
                        }
                    }
                }
            }
        });
    });
});
</script>

<style>
/* ============================================================
   GLOBAL - FULL WIDTH HERO
   Redesigned spacing pass: larger type, more breathing room.
============================================================ */

html, body {
    overflow-x: hidden;
    max-width: 100%;
}

.resume-feedback-page {
    max-width: 1420px;
    margin: 0 auto;
    padding: 28px 24px 56px;
    background: #f8faff;
    color: #182230;
    font-size: 15px;
    overflow-x: hidden;
}

.resume-feedback-page * {
    box-sizing: border-box;
}

.resume-feedback-page a {
    text-decoration: none;
}


/* ============================================================
   HERO - FULL WIDTH WITH WHITE BACKGROUND
============================================================ */

.resume-hero {
    position: relative;
    min-height: 250px;
    display: flex;
    align-items: center;
    overflow: visible;
    padding: 40px 48px;
    margin-bottom: 28px;
    margin-left: -24px;
    margin-right: -24px;
    border: 1px solid #e5edfa;
    border-radius: 16px;
    background: #ffffff;
    width: calc(100% + 48px);
}

.hero-content {
    position: relative;
    z-index: 3;
    width: 44%;
}

.hero-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 14px;
    padding: 7px 15px 7px 12px;
    border-radius: 20px;
    background: rgba(51, 120, 229, 0.08);
    color: #3378e5;
    font-size: 12.5px;
    font-weight: 700;
    letter-spacing: 0.3px;
}

.hero-eyebrow i {
    font-size: 14px;
}

.hero-content h1 {
    margin: 0;
    color: #17243a;
    font-size: 38px;
    line-height: 1.2;
    font-weight: 800;
    letter-spacing: -0.8px;
}

.hero-content h1 span {
    display: block;
    color: #286ed8;
}

.hero-content p {
    max-width: 520px;
    margin: 16px 0 24px;
    color: #5a687c;
    font-size: 15px;
    line-height: 1.7;
}

.hero-btn {
    display: inline-flex;
    align-items: center;
    gap: 9px;
    padding: 14px 26px;
    border-radius: 8px;
    background: #3378e5;
    color: white !important;
    font-size: 14px;
    font-weight: 700;
    box-shadow: 0 6px 15px rgba(51, 120, 229, .2);
    transition: .2s;
}

.hero-btn:hover {
    transform: translateY(-1px);
    background: #2468d3;
    color: white !important;
}


/* ============================================================
   HERO VISUAL
============================================================ */

.hero-visual {
    position: absolute;
    left: 47%;
    top: 34px;
    width: 230px;
    height: 160px;
}

.resume-paper {
    position: absolute;
    left: 25px;
    top: 5px;
    width: 108px;
    height: 145px;
    padding: 12px;
    border-radius: 5px;
    background: white;
    border: 1px solid #dfe8f7;
    box-shadow: 0 10px 25px rgba(42, 76, 130, .08);
    transform: rotate(-3deg);
}

.paper-top {
    display: flex;
    gap: 7px;
    align-items: center;
    margin-bottom: 12px;
}

.paper-avatar {
    width: 25px;
    height: 25px;
    border-radius: 50%;
    background: #d9e8ff;
}

.paper-lines {
    flex: 1;
}

.paper-lines span {
    display: block;
    height: 4px;
    margin-bottom: 4px;
    border-radius: 4px;
    background: #dce6f4;
}

.paper-section {
    width: 40%;
    height: 5px;
    margin: 10px 0 7px;
    border-radius: 4px;
    background: #6a9ce9;
}

.paper-line {
    width: 80%;
    height: 4px;
    margin-bottom: 5px;
    border-radius: 4px;
    background: #e3e9f1;
}

.paper-line.long {
    width: 100%;
}

.paper-line.medium {
    width: 62%;
}

.hero-search {
    position: absolute;
    left: 108px;
    top: 54px;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 57px;
    height: 57px;
    border: 6px solid #3378e5;
    border-radius: 50%;
    background: rgba(255,255,255,.95);
    color: #3378e5;
    font-size: 22px;
    transform: rotate(-10deg);
    box-shadow: 0 8px 20px rgba(51,120,229,.12);
}

.hero-search::after {
    content: "";
    position: absolute;
    width: 28px;
    height: 7px;
    right: -22px;
    bottom: -10px;
    border-radius: 8px;
    background: #3378e5;
    transform: rotate(45deg);
}

.hero-check {
    position: absolute;
    top: 8px;
    right: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: #e5f8ef;
    color: #15a467;
    font-size: 11px;
}

.hero-benefits {
    position: absolute;
    right: 38px;
    top: 40px;
    width: 260px;
}

.hero-benefit {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 20px;
}

.benefit-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 34px;
    height: 34px;
    flex: 0 0 34px;
    border-radius: 9px;
    font-size: 13px;
}

.benefit-icon.blue {
    color: #3276df;
    background: #e6f0ff;
}

.benefit-icon.purple {
    color: #8a64df;
    background: #f0eaff;
}

.benefit-icon.orange {
    color: #ec9a31;
    background: #fff2df;
}

.hero-benefit strong {
    display: block;
    color: #27364d;
    font-size: 14px;
}

.hero-benefit small {
    display: block;
    margin-top: 3px;
    color: #7b8798;
    font-size: 12px;
}


/* ============================================================
   IMPORTANT BUTTON FIXES
============================================================ */

.resume-feedback-page button,
.resume-feedback-page a {
    -webkit-tap-highlight-color: transparent;
}

.resume-feedback-page button {
    font-family: inherit;
}

.request-item {
    appearance: none;
    -webkit-appearance: none;
}


/* ============================================================
   SUBMIT RESUME FORM
============================================================ */
.submit-panel {
    overflow: hidden;
}

.step-number {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 26px;
    height: 26px;
    margin-right: 3px;
    border-radius: 50%;
    background: #3378e5;
    color: #fff;
    font-size: 12px;
    font-weight: 800;
}

.resume-request-form {
    padding: 20px 22px 22px;
}

.resume-request-form .form-group {
    margin-bottom: 20px;
}

.resume-request-form .form-group > label {
    display: block;
    margin-bottom: 9px;
    color: #344258;
    font-size: 13px;
    font-weight: 700;
}

.resume-request-form .required {
    color: #ef5350;
    font-size: 14px;
}

.resume-upload-box {
    position: relative;
    overflow: hidden;
    border: 1px dashed #cbd9ee;
    border-radius: 9px;
    background: #f8fbff;
    transition: .2s;
}

.resume-upload-box:hover,
.resume-upload-box.drag-over {
    border-color: #3378e5;
    background: #f2f7ff;
}

.upload-label {
    display: flex !important;
    align-items: center;
    gap: 12px;
    margin: 0 !important;
    padding: 20px 18px;
    cursor: pointer;
}

.upload-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    flex: 0 0 42px;
    border-radius: 8px;
    background: #e8f2ff;
    color: #3378e5;
    font-size: 16px;
}

.upload-content strong,
.upload-content span {
    display: block;
}

.upload-content strong {
    color: #405069;
    font-size: 13px;
}

.upload-content span {
    margin-top: 4px;
    color: #9aa4b3;
    font-size: 11.5px;
}

.selected-file {
    display: flex !important;
    align-items: center;
    gap: 10px;
    padding: 12px 14px;
    border-top: 1px solid #e7edf6;
    background: #fff;
}

.selected-file-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 38px;
    height: 38px;
    border-radius: 7px;
    background: #fff0f0;
    color: #e74c3c;
    font-size: 15px;
}

.selected-file-info {
    min-width: 0;
    flex: 1;
}

.selected-file-info strong,
.selected-file-info span {
    display: block;
}

.selected-file-info strong {
    overflow: hidden;
    color: #39475c;
    font-size: 13px;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.selected-file-info span {
    margin-top: 3px;
    color: #929baa;
    font-size: 11px;
}

.remove-file {
    width: 32px;
    height: 32px;
    padding: 0;
    border: 0;
    border-radius: 6px;
    background: #fff2f2;
    color: #e25454;
    font-size: 14px;
    cursor: pointer;
}

.resume-request-form input[type="text"],
.resume-request-form select {
    width: 100%;
    height: 44px;
    padding: 0 14px;
    border: 1px solid #dce4ef;
    border-radius: 7px;
    outline: none;
    background: #fff;
    color: #4a586d;
    font-family: inherit;
    font-size: 14px;
    transition: .15s;
}

.resume-request-form input[type="text"]:focus,
.resume-request-form select:focus {
    border-color: #79a7e8;
    box-shadow: 0 0 0 3px rgba(51,120,229,.1);
}

.feedback-select {
    display: flex;
    gap: 9px;
    flex-wrap: wrap;
}

.checkbox-option {
    display: inline-flex !important;
    align-items: center;
    gap: 6px;
    padding: 9px 14px;
    margin: 0 !important;
    border: 1px solid #e0e6ef;
    border-radius: 7px;
    background: #fafbfd;
    color: #667386 !important;
    font-size: 12.5px !important;
    font-weight: 500 !important;
    cursor: pointer;
}

.checkbox-option input {
    width: 15px;
    height: 15px;
    margin: 0;
    accent-color: #3378e5;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}

.submit-request-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 9px;
    width: 100%;
    height: 48px;
    margin-top: 6px;
    padding: 0 12px;
    border: 0;
    border-radius: 7px;
    background: #3378e5;
    color: #fff;
    font-family: inherit;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    box-shadow: 0 5px 12px rgba(51,120,229,.15);
    transition: .2s;
}

.submit-request-btn:hover {
    background: #246bd7;
    transform: translateY(-1px);
}

.submit-request-btn:disabled {
    opacity: .65;
    cursor: not-allowed;
    transform: none;
}

.secure-note {
    display: flex;
    align-items: center;
    gap: 6px;
    margin-top: 12px;
    color: #8994a3;
    font-size: 12px;
}

.secure-note i {
    color: #35a66f;
    font-size: 14px;
}

.form-error {
    display: block;
    margin-top: 6px;
    color: #e05252;
    font-size: 12px;
}

/* ============================================================
   MAIN GRID
============================================================ */

.resume-main-grid {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 22px;
    align-items: start;
}

.resume-panel {
    min-width: 0;
    border: 1px solid #e4eaf2;
    border-radius: 12px;
    background: #fff;
    box-shadow: 0 3px 12px rgba(32, 52, 80, .04);
}

.panel-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    min-height: 64px;
    padding: 18px 20px;
    border-bottom: 1px solid #edf0f5;
}

.panel-header h2 {
    display: flex;
    align-items: center;
    gap: 8px;
    margin: 0;
    color: #25344a;
    font-size: 17px;
    font-weight: 800;
}

.panel-header h2 i {
    color: #3478df;
    font-size: 17px;
}

.panel-header p {
    margin: 6px 0 0;
    color: #8a95a5;
    font-size: 13px;
}

.request-count {
    padding: 5px 9px;
    border-radius: 20px;
    background: #eef5ff;
    color: #3776d7;
    font-size: 12px;
    font-weight: 700;
}


/* ============================================================
   REQUESTS
============================================================ */

.request-list {
    padding: 10px;
}

.request-item {
    width: 100%;
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 16px 12px;
    border: 0;
    border-bottom: 1px solid #f1f3f7;
    background: transparent;
    text-align: left;
    cursor: pointer;
    transition: .15s;
}

.request-item:last-child {
    border-bottom: 0;
}

.request-item:hover {
    border-radius: 8px;
    background: #f7faff;
}

.request-item-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    flex: 0 0 42px;
    border-radius: 8px;
    color: #3979dc;
    background: #edf4ff;
    font-size: 15px;
}

.request-item-content {
    min-width: 0;
    flex: 1;
}

.request-title-row {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
}

.request-title-row strong {
    color: #314057;
    font-size: 14px;
}

.status-pill {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 5px 11px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 700;
}

.status-completed {
    color: #15945f;
    background: #e9f8f0;
}

.status-progress {
    color: #357bdc;
    background: #eaf3ff;
}

.status-pending {
    color: #d88a19;
    background: #fff4df;
}

.request-meta {
    display: flex;
    gap: 9px;
    margin-top: 5px;
    color: #98a1af;
    font-size: 12px;
}

.request-meta span {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.request-arrow {
    color: #bbc3ce;
    font-size: 12px;
}

.empty-request {
    padding: 42px 20px;
    text-align: center;
}

.empty-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 60px;
    height: 60px;
    margin: 0 auto 14px;
    border-radius: 14px;
    color: #6e94d0;
    background: #edf4ff;
    font-size: 22px;
}

.empty-request h3 {
    margin: 0 0 6px;
    color: #36445a;
    font-size: 15px;
    font-weight: 800;
}

.empty-request p {
    max-width: 240px;
    margin: 0 auto 16px;
    color: #8b96a6;
    font-size: 13px;
    line-height: 1.6;
}

.small-primary-btn {
    display: inline-flex;
    padding: 11px 15px;
    border-radius: 7px;
    background: #3378e5;
    color: white !important;
    font-size: 12px;
    font-weight: 700;
}

.request-pagination {
    padding: 16px 14px;
    border-top: 1px solid #edf0f5;
}


/* ============================================================
   MENTORS
============================================================ */

.mentor-column {
    display: flex;
    flex-direction: column;
    gap: 22px;
    min-width: 0;
}

.requests-column {
    display: flex;
    flex-direction: column;
    gap: 22px;
    min-width: 0;
}

.mentor-panel {
    display: flex;
    flex-direction: column;
}

.mentor-list {
    max-height: 260px;
    padding: 8px 12px;
    overflow-y: auto;
}

.mentor-list::-webkit-scrollbar {
    width: 5px;
}

.mentor-list::-webkit-scrollbar-thumb {
    border-radius: 4px;
    background: #d7e1f0;
}

.mentor-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 8px;
    border-bottom: 1px solid #f0f2f6;
    transition: all 0.3s ease;
}

.mentor-item:last-child {
    border-bottom: 0;
}

.mentor-avatar {
    width: 40px;
    height: 40px;
    flex: 0 0 40px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #edf4ff;
}

.mentor-info {
    min-width: 0;
    flex: 1;
}

.mentor-info strong,
.mentor-info span,
.mentor-info small {
    display: block;
}

.mentor-info strong {
    color: #2e3d53;
    font-size: 14px;
}

.mentor-info span {
    margin-top: 3px;
    color: #7e8999;
    font-size: 12.5px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.mentor-info small {
    margin-top: 4px;
    color: #1b9a67;
    font-size: 11px;
    font-weight: 600;
}

.mentor-info small i {
    font-size: 10px;
}

.select-mentor-btn {
    padding: 9px 16px;
    border: 1px solid #cbdcf6;
    border-radius: 6px;
    color: #3478dc !important;
    background: #f8fbff;
    font-size: 12px;
    font-weight: 700;
    cursor: pointer;
    transition: .15s;
}

.select-mentor-btn:hover {
    color: white !important;
    background: #3478dc;
    border-color: #3478dc;
}

.view-link {
    color: #3378df !important;
    font-size: 12.5px;
    font-weight: 700;
    white-space: nowrap;
}

.view-link i {
    margin-left: 3px;
    font-size: 10px;
}

.mentor-note {
    display: flex;
    align-items: flex-start;
    gap: 9px;
    margin: 10px 16px 14px;
    padding: 12px 14px;
    border-radius: 8px;
    background: #f6f9fd;
    color: #7d8999;
    font-size: 12px;
    line-height: 1.55;
}

.mentor-note i {
    color: #4d83d8;
    margin-top: 1px;
    font-size: 14px;
}

.empty-mentor {
    padding: 40px;
    text-align: center;
    color: #9aa4b2;
    font-size: 14px;
}

.empty-mentor i {
    margin-bottom: 10px;
    font-size: 26px;
}


/* ============================================================
   HOW IT WORKS
============================================================ */

.step-icon {
    position: relative;
    z-index: 2;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    flex: 0 0 42px;
    border-radius: 50%;
    font-size: 14px;
}

.step-blue {
    color: #3679dd;
    background: #e9f2ff;
}

.step-purple {
    color: #8762dc;
    background: #f0eaff;
}

.step-green {
    color: #18a36a;
    background: #e8f8f0;
}

.step-orange {
    color: #e4942b;
    background: #fff2df;
}

.steps-row {
    display: flex;
    align-items: stretch;
    gap: 12px;
    flex-wrap: wrap;
}

.step-row-item {
    flex: 1 1 190px;
    min-width: 160px;
    padding: 22px 16px;
    text-align: center;
    border: 1px solid #edf0f5;
    border-radius: 11px;
    background: #fbfcfe;
    transition: .15s;
}

.step-row-item:hover {
    border-color: #cfe0f7;
    background: #f7faff;
}

.step-row-item .step-icon {
    margin: 0 auto 14px;
}

.step-row-item strong {
    display: block;
    color: #344258;
    font-size: 14px;
    font-weight: 700;
}

.step-row-item p {
    margin: 8px 0 0;
    color: #8a95a4;
    font-size: 12px;
    line-height: 1.6;
}

.step-row-arrow {
    display: flex;
    align-items: center;
    justify-content: center;
    flex: 0 0 auto;
    padding-top: 34px;
    color: #c3cbd6;
    font-size: 13px;
}

.steps-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    padding: 20px 18px;
}


/* ============================================================
   STATUS SECTION
============================================================ */

.status-section {
    padding: 24px 20px 26px;
}

.status-section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.section-label {
    display: block;
    margin-bottom: 4px;
    color: #4381dc;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: .8px;
}

.status-section-header h2 {
    margin: 0;
    color: #27364b;
    font-size: 17px;
    font-weight: 800;
}

.new-request-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 11px 16px;
    border-radius: 7px;
    background: #3378e5;
    color: #fff !important;
    font-size: 12px;
    font-weight: 700;
}

.status-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 14px;
}

.status-card {
    display: flex;
    align-items: center;
    gap: 13px;
    padding: 16px 14px;
    border: 1px solid #edf0f5;
    border-radius: 10px;
    background: #fbfcfe;
}

.status-card-icon,
.feature-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 9px;
}

.status-card-icon {
    width: 46px;
    height: 46px;
    flex: 0 0 46px;
    font-size: 16px;
}

.status-card-icon.blue,
.feature-icon.blue {
    color: #3378df;
    background: #eaf2ff;
}

.status-card-icon.orange,
.feature-icon.orange {
    color: #e39a31;
    background: #fff3e1;
}

.status-card-icon.purple,
.feature-icon.purple {
    color: #8863dc;
    background: #f0eaff;
}

.status-card-icon.green,
.feature-icon.green {
    color: #16a267;
    background: #e8f8f0;
}

.status-card strong {
    display: block;
    color: #2d3b51;
    font-size: 20px;
    line-height: 1;
}

.status-card span {
    display: block;
    margin-top: 5px;
    color: #8792a1;
    font-size: 12px;
}


/* ============================================================
   FEATURE STRIP
============================================================ */

.feature-strip {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 14px;
    margin-top: 22px;
}

.feature-box {
    display: flex;
    align-items: center;
    gap: 11px;
    padding: 16px 14px;
    border: 1px solid #e7ecf3;
    border-radius: 10px;
    background: #fff;
}

.feature-icon {
    width: 42px;
    height: 42px;
    flex: 0 0 42px;
    font-size: 15px;
}

.feature-box strong,
.feature-box span {
    display: block;
}

.feature-box strong {
    color: #344157;
    font-size: 13px;
}

.feature-box span {
    margin-top: 3px;
    color: #8993a2;
    font-size: 11px;
    line-height: 1.4;
}


/* ============================================================
   MODAL
============================================================ */

.modern-modal {
    overflow: hidden;
    border: 0;
    border-radius: 16px;
    box-shadow: 0 24px 64px rgba(25, 49, 83, .16);
}

.modern-modal .modal-header {
    padding: 24px 26px;
    border-bottom: 1px solid #edf0f5;
    background: #f8fbff;
}

.modal-label {
    display: block;
    margin-bottom: 5px;
    color: #3679dc;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: .8px;
}

.modern-modal .modal-title {
    margin-bottom: 9px;
    color: #26364d;
    font-size: 22px;
    font-weight: 800;
}

.modern-modal .modal-body {
    padding: 26px;
}

.modal-info-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    margin-bottom: 24px;
}

.modal-info-grid span,
.modal-content-block > span {
    display: block;
    margin-bottom: 6px;
    color: #8b96a6;
    font-size: 12.5px;
}

.modal-info-grid strong,
.modal-info-grid a {
    color: #344258;
    font-size: 14.5px;
    font-weight: 600;
}

.modal-info-grid a {
    color: #3378df;
}

.modal-content-block {
    margin-bottom: 20px;
}

.modal-content-block p {
    margin: 0;
    color: #59677b;
    font-size: 14px;
    line-height: 1.65;
}

.focus-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 7px;
}

.focus-tags span {
    display: inline-flex;
    padding: 8px 14px;
    border: 1px solid #e1e7ef;
    border-radius: 20px;
    background: #f8fafc;
    color: #647184;
    font-size: 12px;
}

.feedback-heading h5 {
    margin: 0 0 16px;
    color: #334258;
    font-size: 19px;
    font-weight: 800;
}

.rating-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 12px;
    margin-bottom: 20px;
}

.rating-box {
    padding: 14px 12px;
    border: 1px solid #edf0f5;
    border-radius: 9px;
    background: #fafbfd;
}

.rating-box span {
    display: block;
    color: #8b96a5;
    font-size: 12px;
}

.rating-box strong {
    display: block;
    margin-top: 6px;
    color: #334258;
    font-size: 17px;
}

.rating-box i {
    color: #f5b52e;
    font-size: 14px;
}

.feedback-block {
    display: flex;
    gap: 12px;
    margin-bottom: 14px;
    padding: 16px 18px;
    border-radius: 10px;
    background: #f7f9fc;
}

.feedback-block.success {
    background: #effaf5;
}

.feedback-block.warning {
    background: #fff8eb;
}

.feedback-icon {
    color: #4380d9;
    font-size: 17px;
}

.feedback-block.success .feedback-icon {
    color: #18a167;
}

.feedback-block.warning .feedback-icon {
    color: #dc941f;
}

.feedback-block strong {
    display: block;
    margin-bottom: 5px;
    color: #39475b;
    font-size: 14px;
}

.feedback-block p {
    margin: 0;
    color: #697689;
    font-size: 13px;
    line-height: 1.65;
}

.waiting-feedback {
    padding: 42px 20px;
    text-align: center;
}

.waiting-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 60px;
    height: 60px;
    margin: 0 auto 14px;
    border-radius: 50%;
    color: #d89426;
    background: #fff4df;
    font-size: 24px;
}

.waiting-feedback h4 {
    margin-bottom: 8px;
    color: #344258;
    font-size: 19px;
}

.waiting-feedback p {
    max-width: 400px;
    margin: auto;
    color: #8a95a4;
    font-size: 13px;
    line-height: 1.6;
}

.modern-modal .modal-footer {
    padding: 16px 26px;
    border-top: 1px solid #edf0f5;
}

.modal-close-btn {
    padding: 11px 20px;
    border: 1px solid #dfe5ed;
    border-radius: 7px;
    background: white;
    color: #657184;
    font-size: 13px;
    cursor: pointer;
}


/* ============================================================
   RESPONSIVE
============================================================ */

@media (max-width: 1100px) {

    .resume-main-grid {
        grid-template-columns: 1fr 1fr;
    }

    .requests-column {
        grid-column: span 2;
    }

    .hero-benefits {
        right: 24px;
        width: 220px;
    }

    .hero-content {
        width: 50%;
    }

    .hero-visual {
        left: 52%;
    }

}


@media (max-width: 768px) {

    .resume-hero {
        margin-left: 0;
        margin-right: 0;
        width: 100%;
        padding: 30px 24px;
    }

    .form-row {
        grid-template-columns: 1fr;
        gap: 0;
    }

    .resume-feedback-page {
        padding: 18px 14px 36px;
        font-size: 14px;
    }

    .resume-hero {
        min-height: auto;
    }

    .hero-content {
        width: 100%;
    }

    .hero-content h1 {
        font-size: 28px;
    }

    .hero-content p {
        font-size: 13.5px;
    }

    .hero-visual {
        display: none;
    }

    .hero-benefits {
        display: none;
    }

    .resume-main-grid {
        grid-template-columns: 1fr;
        gap: 22px;
    }

    .requests-column {
        grid-column: auto;
    }

    .status-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .feature-strip {
        grid-template-columns: repeat(2, 1fr);
    }

    .panel-header h2 {
        font-size: 16px;
    }

    .rating-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .steps-grid {
        grid-template-columns: 1fr;
    }

    .steps-row {
        flex-direction: column;
    }

    .step-row-arrow {
        transform: rotate(90deg);
        padding: 4px 0;
    }

}


@media (max-width: 480px) {

    .resume-feedback-page {
        font-size: 13px;
        padding: 14px 10px 22px;
    }

    .hero-content h1 {
        font-size: 24px;
    }

    .hero-content p {
        font-size: 12.5px;
    }

    .hero-btn {
        font-size: 13px;
        padding: 12px 20px;
    }

    .panel-header {
        align-items: flex-start;
    }

    .panel-header h2 {
        font-size: 15px;
    }

    .view-link {
        display: none;
    }

    .status-grid {
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .feature-strip {
        grid-template-columns: 1fr;
        gap: 10px;
    }

    .status-section-header {
        align-items: flex-start;
        gap: 10px;
        flex-direction: column;
    }

    .status-section-header h2 {
        font-size: 15px;
    }

    .new-request-btn {
        font-size: 11px;
        padding: 9px 14px;
    }

    .request-meta {
        flex-direction: column;
        gap: 3px;
    }

    .modal-info-grid {
        grid-template-columns: 1fr;
    }

    .rating-grid {
        grid-template-columns: 1fr 1fr;
        gap: 8px;
    }

    .modern-modal .modal-title {
        font-size: 18px;
    }

    .resume-request-form input[type="text"],
    .resume-request-form select {
        height: 40px;
        font-size: 13px;
    }

    .submit-request-btn {
        height: 42px;
        font-size: 13px;
    }

    .checkbox-option {
        font-size: 11px !important;
        padding: 7px 11px;
    }

    .feature-box {
        padding: 10px 8px;
    }

    .feature-box strong {
        font-size: 12px;
    }

    .feature-box span {
        font-size: 10px;
    }

    .status-card {
        padding: 10px 8px;
        gap: 8px;
    }

    .status-card strong {
        font-size: 16px;
    }

    .status-card span {
        font-size: 10px;
    }

    .status-card-icon {
        width: 36px;
        height: 36px;
        flex: 0 0 36px;
        font-size: 13px;
    }

    .upload-label {
        padding: 14px 12px;
    }

    .upload-icon {
        width: 34px;
        height: 34px;
        flex: 0 0 34px;
        font-size: 13px;
    }

    .upload-content strong {
        font-size: 12px;
    }

    .upload-content span {
        font-size: 10px;
    }

    .step-row-item {
        padding: 14px 12px;
    }
}
</style>

@endsection
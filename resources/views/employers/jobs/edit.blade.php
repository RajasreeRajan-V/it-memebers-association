@extends('layouts.app')

@section('content')

<div class="jobpost-wrapper">

    {{-- ============================================================
        PAGE HEADER
    ============================================================ --}}

    <div class="jobpost-header">

        <h1>Edit Job</h1>

        <p>
            Update the details of "{{ $job->title }}".
        </p>

    </div>


    {{-- ============================================================
        VALIDATION ERRORS
    ============================================================ --}}

    @if ($errors->any())

        <div class="jobpost-alert jobpost-alert-danger">

            <ul>

                @foreach ($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- ============================================================
        SUCCESS MESSAGE
    ============================================================ --}}

    @if (session('success'))

        <div class="jobpost-alert jobpost-alert-success">
            {{ session('success') }}
        </div>

    @endif


    {{-- ============================================================
        MAIN LAYOUT
    ============================================================ --}}

    <div class="jobpost-layout">


        {{-- ========================================================
            LEFT / MAIN CONTENT
        ======================================================== --}}

        <div class="jobpost-main">


            {{-- ====================================================
                STEP PROGRESS
            ==================================================== --}}

            <div class="job-wizard-progress">

                <div class="job-progress-track">


                    {{-- STEP 1 --}}
                    <div
                        class="job-progress-item active"
                        data-progress="1"
                    >

                        <div class="job-progress-number">
                            1
                        </div>

                        <div class="job-progress-label">
                            Basic Information
                        </div>

                    </div>


                    {{-- LINE 1 --}}
                    <div
                        class="job-progress-line"
                        data-line="1"
                    ></div>


                    {{-- STEP 2 --}}
                    <div
                        class="job-progress-item"
                        data-progress="2"
                    >

                        <div class="job-progress-number">
                            2
                        </div>

                        <div class="job-progress-label">
                            Job Description
                        </div>

                    </div>


                    {{-- LINE 2 --}}
                    <div
                        class="job-progress-line"
                        data-line="2"
                    ></div>


                    {{-- STEP 3 --}}
                    <div
                        class="job-progress-item"
                        data-progress="3"
                    >

                        <div class="job-progress-number">
                            3
                        </div>

                        <div class="job-progress-label">
                            Job Location
                        </div>

                    </div>

                </div>

            </div>


            {{-- ====================================================
                JOB FORM
            ==================================================== --}}

            <form
                action="{{ route('employer.jobs.update', $job) }}"
                method="POST"
                class="jobpost-form"
            >

                @csrf

                @method('PUT')


                {{-- ==================================================
                    ALL THREE WIZARD SECTIONS
                ================================================== --}}

                @include(
                    'employers.jobs._form',
                    ['job' => $job]
                )


                {{-- ==================================================
                    FORM ACTIONS
                ================================================== --}}

                <div class="jobpost-actions">


                    {{-- LEFT SIDE --}}
                    <div>

                        <a
                            href="{{ route('employer.jobs.show', $job) }}"
                            class="jobpost-cancel"
                        >
                            Cancel
                        </a>

                    </div>


                    {{-- RIGHT SIDE --}}
                    <div class="jobpost-actions-right">


                        {{-- ==========================================
                            STEP 1 → STEP 2
                        ========================================== --}}

                        <button
                            type="button"
                            class="jobpost-btn"
                            data-next-step="2"
                        >
                            Next

                            <i class="bi bi-arrow-right"></i>
                        </button>


                        {{-- ==========================================
                            STEP 2 → STEP 1
                        ========================================== --}}

                        <button
                            type="button"
                            class="jobpost-back"
                            data-prev-step="1"
                        >
                            <i class="bi bi-arrow-left"></i>

                            Back
                        </button>


                        {{-- ==========================================
                            STEP 2 → STEP 3
                        ========================================== --}}

                        <button
                            type="button"
                            class="jobpost-btn"
                            data-next-step="3"
                        >
                            Next

                            <i class="bi bi-arrow-right"></i>
                        </button>


                        {{-- ==========================================
                            STEP 3 → STEP 2
                        ========================================== --}}

                        <button
                            type="button"
                            class="jobpost-back"
                            data-prev-step="2"
                        >
                            <i class="bi bi-arrow-left"></i>

                            Back
                        </button>


                        {{-- ==========================================
                            STEP 3 → SAVE
                        ========================================== --}}

                        <button
                            type="submit"
                            class="jobpost-btn"
                            data-publish-button
                        >
                            <i class="bi bi-check2-circle"></i>

                            Save Changes
                        </button>

                    </div>

                </div>

            </form>

        </div>


        {{-- ========================================================
            RIGHT SIDEBAR
        ======================================================== --}}

        <aside class="jobpost-sidebar">


            {{-- ====================================================
                EDITING TIPS
            ==================================================== --}}

            <div class="job-side-card">

                <div class="job-side-card-head">

                    <div class="job-side-card-head-icon">
                        <i class="bi bi-lightbulb"></i>
                    </div>

                    <h3>
                        Job Posting Tips
                    </h3>

                </div>


                <ul class="job-tips-list">

                    <li>
                        <i class="bi bi-check2-circle"></i>

                        <span>
                            Keep the job title clear and specific.
                        </span>
                    </li>


                    <li>
                        <i class="bi bi-check2-circle"></i>

                        <span>
                            Keep the required skills relevant to the position.
                        </span>
                    </li>


                    <li>
                        <i class="bi bi-check2-circle"></i>

                        <span>
                            Make responsibilities easy for candidates to understand.
                        </span>
                    </li>


                    <li>
                        <i class="bi bi-check2-circle"></i>

                        <span>
                            Keep the job location information accurate.
                        </span>
                    </li>

                </ul>

            </div>


            {{-- ====================================================
                NOTICE
            ==================================================== --}}

            <div class="job-side-notice">

                <i class="bi bi-info-circle"></i>

                <div>

                    <strong>
                        Review your changes
                    </strong>

                    <span>
                        Check each section before saving your updated job.
                    </span>

                </div>

            </div>


            {{-- ====================================================
                CHECKLIST
            ==================================================== --}}

            <div class="job-side-card">

                <div class="job-side-card-head">

                    <div class="job-side-card-head-icon">
                        <i class="bi bi-list-check"></i>
                    </div>

                    <h3>
                        Job Checklist
                    </h3>

                </div>


                <ul class="job-checklist">


                    {{-- TITLE --}}
                    <li data-check="title">

                        <i class="bi bi-check"></i>

                        <span>
                            Job title added
                        </span>

                    </li>


                    {{-- TYPE --}}
                    <li data-check="type">

                        <i class="bi bi-check"></i>

                        <span>
                            Employment type selected
                        </span>

                    </li>


                    {{-- DESCRIPTION --}}
                    <li data-check="description">

                        <i class="bi bi-check"></i>

                        <span>
                            Description added
                        </span>

                    </li>


                    {{-- LOCATION --}}
                    <li data-check="location">

                        <i class="bi bi-check"></i>

                        <span>
                            Location completed
                        </span>

                    </li>

                </ul>

            </div>

        </aside>

    </div>

</div>


{{-- ================================================================
    PAGE STYLES
================================================================ --}}

@include('employers.jobs._styles')


{{-- ================================================================
    PAGE JAVASCRIPT
================================================================ --}}

@include('employers.jobs._scripts')

@endsection
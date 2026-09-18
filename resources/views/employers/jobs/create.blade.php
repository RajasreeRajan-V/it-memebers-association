@extends('layouts.app')

@section('title', 'Post a New Job')

@section('content')

<div class="jobpost-page">

    <div class="container-fluid">

        {{-- =====================================================
             PAGE HEADER
        ====================================================== --}}

        <div class="jobpost-header">

            <h1>Post a New Job</h1>

            <p>
                Create a job posting and connect with qualified candidates.
            </p>

        </div>


        {{-- =====================================================
             ALERTS
        ====================================================== --}}

        @if ($errors->any())

            <div class="jobpost-alert jobpost-alert-danger">

                <i class="bi bi-exclamation-circle"></i>

                <div>
                    <strong>
                        Please check the form.
                    </strong>

                    <div>
                        {{ $errors->first() }}
                    </div>
                </div>

            </div>

        @endif


        @if (session('success'))

            <div class="jobpost-alert jobpost-alert-success">

                <i class="bi bi-check-circle"></i>

                <div>
                    {{ session('success') }}
                </div>

            </div>

        @endif


        {{-- =====================================================
             MAIN LAYOUT
        ====================================================== --}}

        <div class="jobpost-layout">

            {{-- =================================================
                 MAIN
            ================================================== --}}

            <div class="jobpost-main">

                {{-- PROGRESS --}}
                <div class="job-progress">

                    <div class="job-progress-track">

                        <div
                            class="job-progress-item active"
                            data-step="1"
                        >

                            <div class="job-progress-circle">
                                1
                            </div>

                            <div class="job-progress-label">
                                Basic Information
                            </div>

                        </div>


                        <div class="job-progress-line"></div>


                        <div
                            class="job-progress-item"
                            data-step="2"
                        >

                            <div class="job-progress-circle">
                                2
                            </div>

                            <div class="job-progress-label">
                                Description
                            </div>

                        </div>


                        <div class="job-progress-line"></div>


                        <div
                            class="job-progress-item"
                            data-step="3"
                        >

                            <div class="job-progress-circle">
                                3
                            </div>

                            <div class="job-progress-label">
                                Location
                            </div>

                        </div>

                    </div>

                </div>


                {{-- FORM CARD --}}
                <div class="jobpost-card">

                    <form
                        action="{{ route('employer.jobs.store') }}"
                        method="POST"
                        class="jobpost-form"
                    >

                        @csrf


                        {{-- FORM FIELDS --}}
                        @include('employers.jobs._form')


                        {{-- ACTIONS --}}
                        <div class="jobpost-actions">

                            <div class="jobpost-actions-left">

                                <a
                                    href="{{ route('employer.jobs.index') }}"
                                    class="jobpost-btn jobpost-btn-secondary"
                                >
                                    <i class="bi bi-x-lg"></i>
                                    Cancel
                                </a>

                            </div>


                            <div class="jobpost-actions-right">

                                {{-- STEP 2 BACK --}}
                                <button
                                    type="button"
                                    class="jobpost-btn jobpost-btn-secondary"
                                    data-prev-step="1"
                                >
                                    <i class="bi bi-arrow-left"></i>
                                    Back
                                </button>


                                {{-- STEP 1 NEXT --}}
                                <button
                                    type="button"
                                    class="jobpost-btn jobpost-btn-primary"
                                    data-next-step="2"
                                >
                                    Next
                                    <i class="bi bi-arrow-right"></i>
                                </button>


                                {{-- STEP 3 BACK --}}
                                <button
                                    type="button"
                                    class="jobpost-btn jobpost-btn-secondary"
                                    data-prev-step="2"
                                >
                                    <i class="bi bi-arrow-left"></i>
                                    Back
                                </button>


                                {{-- STEP 2 NEXT --}}
                                <button
                                    type="button"
                                    class="jobpost-btn jobpost-btn-primary"
                                    data-next-step="3"
                                >
                                    Next
                                    <i class="bi bi-arrow-right"></i>
                                </button>


                                {{-- PUBLISH --}}
                                <button
                                    type="submit"
                                    class="jobpost-btn jobpost-btn-success"
                                    data-publish-button
                                >
                                    <i class="bi bi-check2-circle"></i>
                                    Publish Job
                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>


            {{-- =================================================
                 SIDEBAR
            ================================================== --}}

            <aside class="jobpost-sidebar">

                {{-- POSTING TIPS --}}
                <div class="jobpost-side-card">

                    <h3>Posting Tips</h3>

                    <div class="jobpost-tips">

                        <div class="jobpost-tip">

                            <div class="jobpost-tip-icon">
                                <i class="bi bi-type"></i>
                            </div>

                            <div class="jobpost-tip-text">

                                <strong>Clear Job Title</strong>

                                <span>
                                    Use a simple and specific title.
                                </span>

                            </div>

                        </div>


                        <div class="jobpost-tip">

                            <div class="jobpost-tip-icon">
                                <i class="bi bi-list-check"></i>
                            </div>

                            <div class="jobpost-tip-text">

                                <strong>Relevant Skills</strong>

                                <span>
                                    Add the technical skills candidates need.
                                </span>

                            </div>

                        </div>


                        <div class="jobpost-tip">

                            <div class="jobpost-tip-icon">
                                <i class="bi bi-file-text"></i>
                            </div>

                            <div class="jobpost-tip-text">

                                <strong>Detailed Description</strong>

                                <span>
                                    Explain responsibilities and requirements.
                                </span>

                            </div>

                        </div>


                        <div class="jobpost-tip">

                            <div class="jobpost-tip-icon">
                                <i class="bi bi-geo-alt"></i>
                            </div>

                            <div class="jobpost-tip-text">

                                <strong>Location</strong>

                                <span>
                                    Location requirements depend on work mode.
                                </span>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- NOTICE --}}
                <div class="jobpost-side-card">

                    <h3>Important</h3>

                    <div class="jobpost-notice">

                        <strong>
                            Review before publishing
                        </strong>

                        <p>
                            Make sure your job details are accurate
                            before publishing the job.
                        </p>

                    </div>

                </div>


                {{-- CHECKLIST --}}
                <div class="jobpost-side-card">

                    <h3>Job Checklist</h3>

                    <div class="jobpost-checklist">

                        <div
                            class="jobpost-check-item"
                            data-check="title"
                        >
                            <i class="bi bi-circle"></i>
                            Job title added
                        </div>

                        <div
                            class="jobpost-check-item"
                            data-check="employment"
                        >
                            <i class="bi bi-circle"></i>
                            Employment type selected
                        </div>

                        <div
                            class="jobpost-check-item"
                            data-check="description"
                        >
                            <i class="bi bi-circle"></i>
                            Description added
                        </div>

                        <div
                            class="jobpost-check-item"
                            data-check="location"
                        >
                            <i class="bi bi-circle"></i>
                            Location completed
                        </div>

                    </div>

                </div>

            </aside>

        </div>

    </div>

</div>


{{-- =========================================================
     STYLES
========================================================= --}}

@include('employers.jobs._styles')


{{-- =========================================================
     SCRIPTS
========================================================= --}}

@include('employers.jobs._scripts')

@endsection
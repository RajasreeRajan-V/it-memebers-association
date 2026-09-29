@extends('layouts.app')

@section('title', 'Edit Job')

@section('content')

<div class="jobpost-page">

    <div class="container-fluid">

        {{-- =====================================================
             PAGE HEADER
        ====================================================== --}}

        <div class="jobpost-header">

            <h1>Edit Job</h1>

            <p>
                Update your job posting and keep the information accurate.
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
                        action="{{ route('employer.jobs.update', $job) }}"
                        method="POST"
                        class="jobpost-form"
                    >

                        @csrf

                        @method('PUT')


                        {{-- =================================================
                             STARTUP PROFILE
                        ================================================== --}}

                        <div class="job-startup-profile-card">

                            <div class="job-startup-profile-header">

                                <div class="job-startup-profile-icon">

                                    <i class="bi bi-buildings"></i>

                                </div>

                                <div>

                                    <h3>
                                        Startup Profile
                                    </h3>

                                    <p>
                                        Connect this job with one of your existing startup profiles.
                                    </p>

                                </div>

                            </div>


                            <div class="job-startup-profile-field">

                                <label for="startup_profile_id">

                                    Startup Profile

                                    <span class="optional">
                                        (Optional)
                                    </span>

                                </label>


                                <select
                                    name="startup_profile_id"
                                    id="startup_profile_id"
                                    class="form-control @error('startup_profile_id') is-invalid @enderror"
                                >

                                    <option value="">
                                        No specific startup
                                    </option>


                                    @foreach($startupProfiles as $startup)

                                        <option
                                            value="{{ $startup->id }}"
                                            {{ old('startup_profile_id', $job->startup_profile_id) == $startup->id ? 'selected' : '' }}
                                        >
                                            {{ $startup->startup_name }}
                                        </option>

                                    @endforeach

                                </select>


                                @error('startup_profile_id')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror


                                <small class="form-text text-muted">

                                    If you select a startup, this job will automatically appear
                                    under that startup's public profile.

                                </small>

                            </div>

                        </div>


                        {{-- =================================================
                             FORM FIELDS
                        ================================================== --}}

                        @include(
                            'employers.jobs._form',
                            ['job' => $job]
                        )


                        {{-- =================================================
                             ACTIONS
                        ================================================== --}}

                        <div class="jobpost-actions">

                            <div class="jobpost-actions-left">

                                <a
                                    href="{{ route('employer.jobs.show', $job) }}"
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


                                {{-- SAVE --}}

                                <button
                                    type="submit"
                                    class="jobpost-btn jobpost-btn-success"
                                    data-publish-button
                                >

                                    <i class="bi bi-check2-circle"></i>

                                    Save Changes

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


                {{-- =================================================
                     EDITING TIPS
                ================================================== --}}

                <div class="jobpost-side-card">

                    <h3>
                        Editing Tips
                    </h3>


                    <div class="jobpost-tips">


                        <div class="jobpost-tip">

                            <div class="jobpost-tip-icon">

                                <i class="bi bi-pencil"></i>

                            </div>


                            <div class="jobpost-tip-text">

                                <strong>
                                    Keep It Accurate
                                </strong>

                                <span>
                                    Make sure the job information is up to date.
                                </span>

                            </div>

                        </div>


                        <div class="jobpost-tip">

                            <div class="jobpost-tip-icon">

                                <i class="bi bi-list-check"></i>

                            </div>


                            <div class="jobpost-tip-text">

                                <strong>
                                    Update Skills
                                </strong>

                                <span>
                                    Add or remove skills based on the current role.
                                </span>

                            </div>

                        </div>


                        <div class="jobpost-tip">

                            <div class="jobpost-tip-icon">

                                <i class="bi bi-file-text"></i>

                            </div>


                            <div class="jobpost-tip-text">

                                <strong>
                                    Improve Description
                                </strong>

                                <span>
                                    Keep responsibilities and requirements clear.
                                </span>

                            </div>

                        </div>


                        <div class="jobpost-tip">

                            <div class="jobpost-tip-icon">

                                <i class="bi bi-geo-alt"></i>

                            </div>


                            <div class="jobpost-tip-text">

                                <strong>
                                    Check Location
                                </strong>

                                <span>
                                    Location requirements depend on work mode.
                                </span>

                            </div>

                        </div>


                    </div>

                </div>


                {{-- =================================================
                     NOTICE
                ================================================== --}}

                <div class="jobpost-side-card">

                    <h3>
                        Important
                    </h3>


                    <div class="jobpost-notice">

                        <strong>
                            Save your changes
                        </strong>

                        <p>
                            Review the updated information before saving
                            the job posting.
                        </p>

                    </div>

                </div>


                {{-- =================================================
                     CHECKLIST
                ================================================== --}}

                <div class="jobpost-side-card">

                    <h3>
                        Job Checklist
                    </h3>


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
     STARTUP PROFILE STYLES
========================================================= --}}

<style>

.job-startup-profile-card {
    margin-bottom: 28px;
    padding: 22px 24px;
    background: #f8faff;
    border: 1px solid #e5eaf3;
    border-radius: 14px;
}


.job-startup-profile-header {
    display: flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 20px;
}


.job-startup-profile-icon {
    width: 44px;
    height: 44px;

    border-radius: 10px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #eef4ff;
    color: #3376f2;

    font-size: 20px;

    flex-shrink: 0;
}


.job-startup-profile-header h3 {
    margin: 0 0 4px;

    font-size: 17px;
    font-weight: 700;

    color: #172033;
}


.job-startup-profile-header p {
    margin: 0;

    font-size: 13px;

    color: #7b8498;
}


.job-startup-profile-field {
    max-width: 650px;
}


.job-startup-profile-field label {
    display: block;

    margin-bottom: 8px;

    font-size: 14px;
    font-weight: 600;

    color: #172033;
}


.job-startup-profile-field .optional {
    color: #8a94a6;

    font-size: 12px;
    font-weight: 500;
}


.job-startup-profile-field .form-control {
    width: 100%;

    min-height: 46px;

    padding: 10px 14px;

    border: 1px solid #dfe5ef;
    border-radius: 9px;

    background: #fff;

    color: #172033;

    font-size: 14px;

    outline: none;

    transition:
        border-color .2s ease,
        box-shadow .2s ease;
}


.job-startup-profile-field .form-control:focus {
    border-color: #3376f2;

    box-shadow:
        0 0 0 3px rgba(51, 118, 242, .10);
}


.job-startup-profile-field .form-control.is-invalid {
    border-color: #dc3545;
}


.job-startup-profile-field .form-text {
    display: block;

    margin-top: 8px;

    font-size: 12px;

    line-height: 1.5;

    color: #7b8498;
}


.job-startup-profile-field .invalid-feedback {
    display: block;

    margin-top: 6px;

    font-size: 12px;

    color: #dc3545;
}


@media (max-width: 575px) {

    .job-startup-profile-card {
        padding: 18px;
    }

    .job-startup-profile-header {
        align-items: flex-start;
    }

}

</style>


{{-- =========================================================
     EXISTING STYLES
========================================================= --}}

@include('employers.jobs._styles')


{{-- =========================================================
     SCRIPTS
========================================================= --}}

@include('employers.jobs._scripts')

@endsection
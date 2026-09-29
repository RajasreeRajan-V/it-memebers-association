@extends('layouts.app')

@section('title', 'Create Project')

@section('content')

<style>
    /* =========================================================
       PROJECT CREATE PAGE
    ========================================================= */

    :root {
        --project-blue: #3376f2;
        --project-blue-dark: #245fd0;
        --project-blue-light: #eef4ff;
        --project-cyan: #06b6d4;

        --project-text: #172033;
        --project-muted: #718096;
        --project-border: #e2e8f0;
        --project-bg: #f8fafc;
        --project-white: #ffffff;

        --project-success: #16a34a;
        --project-danger: #dc2626;
    }


    /* =========================================================
       PAGE
    ========================================================= */

    .project-create-page {
        background: #f8fafc;
        min-height: calc(100vh - 140px);
        padding: 28px 20px 60px;
    }


    .project-page-wrapper {
        width: 100%;
        max-width: 1080px;
        margin: 0 auto;
    }


    /* =========================================================
       TOP INTRO
    ========================================================= */

    .project-intro {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 22px 25px;
        margin-bottom: 20px;

        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;

        box-shadow: 0 2px 8px rgba(15, 23, 42, 0.025);
    }


    .project-intro-left {
        display: flex;
        align-items: center;
        gap: 15px;
    }


    .project-intro-icon {
        width: 52px;
        height: 52px;
        min-width: 52px;

        border-radius: 12px;

        background: #eef4ff;
        color: #3376f2;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 21px;
    }


    .project-intro h1 {
        margin: 0 0 5px;

        font-size: 22px;
        line-height: 1.3;
        font-weight: 650;

        color: #172033;
    }


    .project-intro p {
        margin: 0;

        font-size: 14px;
        line-height: 1.6;

        color: #718096;
    }


    .project-intro-badge {
        flex-shrink: 0;

        padding: 8px 13px;

        border-radius: 30px;

        background: #f1f6ff;
        color: #3376f2;

        font-size: 12px;
        font-weight: 600;
    }


    /* =========================================================
       TWO COLUMN LAYOUT
    ========================================================= */

    .project-content-grid {
        display: grid;

        grid-template-columns: minmax(0, 1fr) 285px;

        gap: 22px;

        align-items: start;
    }


    /* =========================================================
       MAIN FORM CARD
    ========================================================= */

    .project-form-card {
        background: #ffffff;

        border: 1px solid #e2e8f0;

        border-radius: 12px;

        overflow: hidden;

        box-shadow: 0 2px 8px rgba(15, 23, 42, 0.025);
    }


    .project-form-body {
        padding: 24px 26px 28px;
    }


    /* =========================================================
       SECTION
    ========================================================= */

    .project-section {
        margin-bottom: 27px;
    }


    .project-section:last-child {
        margin-bottom: 0;
    }


    .project-section-heading {
        display: flex;
        align-items: center;
        gap: 11px;

        margin-bottom: 19px;
    }


    .project-section-number {
        width: 32px;
        height: 32px;
        min-width: 32px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 8px;

        background: #eef4ff;

        color: #3376f2;

        font-size: 11px;
        font-weight: 700;
    }


    .project-section-heading h2 {
        margin: 0;

        color: #172033;

        font-size: 16px;
        font-weight: 650;

        line-height: 1.3;
    }


    .project-section-heading p {
        margin: 3px 0 0;

        color: #8a94a6;

        font-size: 12px;
        line-height: 1.4;
    }


    .project-section-divider {
        height: 1px;

        background: #edf0f5;

        margin: 25px 0;
    }


    /* =========================================================
       FORM GRID
    ========================================================= */

    .project-form-row {
        display: grid;

        grid-template-columns: repeat(2, minmax(0, 1fr));

        gap: 17px;
    }


    .project-form-group {
        margin-bottom: 17px;
        min-width: 0;
    }


    .project-form-group.full-width {
        grid-column: 1 / -1;
    }


    /* =========================================================
       LABEL
    ========================================================= */

    .project-label {
        display: flex;
        align-items: center;

        gap: 7px;

        margin-bottom: 7px;

        color: #354052;

        font-size: 13px;
        font-weight: 600;

        line-height: 1.4;
    }


    .project-label i {
        width: 16px;

        color: #8b98aa;

        font-size: 12px;

        text-align: center;
    }


    .project-required {
        color: #ef4444;

        font-size: 12px;

        margin-left: -3px;
    }


    /* =========================================================
       INPUT
    ========================================================= */

    .project-input-wrap {
        position: relative;
    }


    .project-input-icon {
        position: absolute;

        left: 13px;
        top: 50%;

        transform: translateY(-50%);

        color: #9aa6b7;

        font-size: 13px;

        pointer-events: none;

        z-index: 2;
    }


    .project-input,
    .project-select,
    .project-textarea {
        width: 100%;

        border: 1px solid #d9e1ec;

        border-radius: 8px;

        background: #ffffff;

        color: #263247;

        font-family: inherit;

        font-size: 13.5px;

        transition: all 0.2s ease;

        box-sizing: border-box;
    }


    .project-input,
    .project-select {
        height: 44px;

        padding: 0 13px;
    }


    .project-input.has-icon,
    .project-select.has-icon {
        padding-left: 38px;
    }


    .project-input::placeholder,
    .project-textarea::placeholder {
        color: #a2adbc;
    }


    .project-input:focus,
    .project-select:focus,
    .project-textarea:focus {
        outline: none;

        border-color: #3376f2;

        box-shadow: 0 0 0 3px rgba(51, 118, 242, 0.09);
    }


    .project-input:hover,
    .project-select:hover,
    .project-textarea:hover {
        border-color: #c7d2e1;
    }


    /* =========================================================
       SELECT
    ========================================================= */

    .project-select {
        appearance: none;

        cursor: pointer;

        padding-right: 38px;

        background-image:
            url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23718096' d='M2.2 4.4 6 8.2l3.8-3.8.9.9L6 10 1.3 5.3z'/%3E%3C/svg%3E");

        background-repeat: no-repeat;

        background-position: right 13px center;
    }


    /* =========================================================
       TEXTAREA
    ========================================================= */

    .project-textarea {
        min-height: 145px;

        padding: 13px 14px;

        resize: vertical;

        line-height: 1.6;
    }


    /* =========================================================
       HELP TEXT
    ========================================================= */

    .project-help-text {
        display: flex;
        align-items: center;

        gap: 5px;

        margin-top: 5px;

        color: #8a94a6;

        font-size: 11.5px;

        line-height: 1.5;
    }


    .project-help-text i {
        font-size: 10px;
    }


    /* =========================================================
       ERROR
    ========================================================= */

    .project-input.is-invalid,
    .project-select.is-invalid,
    .project-textarea.is-invalid {
        border-color: #ef4444;
    }


    .project-invalid-feedback {
        display: block;

        margin-top: 5px;

        color: #dc2626;

        font-size: 11.5px;

        line-height: 1.4;
    }


    /* =========================================================
       LOCATION BOX
    ========================================================= */

    #locationFields {
        padding: 17px;

        margin-top: 4px;

        background: #fafcff;

        border: 1px solid #e5ebf5;

        border-radius: 10px;
    }


    .location-title {
        display: flex;
        align-items: center;

        gap: 9px;

        margin-bottom: 16px;
    }


    .location-title-icon {
        width: 31px;
        height: 31px;

        border-radius: 7px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: #eef4ff;

        color: #3376f2;

        font-size: 12px;
    }


    .location-title h3 {
        margin: 0;

        font-size: 13px;
        font-weight: 650;

        color: #354052;
    }


    .location-title p {
        margin: 2px 0 0;

        color: #8a94a6;

        font-size: 11px;
    }


    /* =========================================================
       ALERTS
    ========================================================= */

    .project-alert {
        padding: 13px 15px;

        border-radius: 9px;

        margin-bottom: 20px;

        font-size: 13px;

        line-height: 1.5;
    }


    .project-alert-success {
        color: #166534;

        background: #f0fdf4;

        border: 1px solid #bbf7d0;
    }


    .project-alert-danger {
        color: #991b1b;

        background: #fef2f2;

        border: 1px solid #fecaca;
    }


    .project-alert-title {
        font-weight: 650;

        margin-bottom: 5px;
    }


    .project-alert ul {
        margin: 5px 0 0 20px;

        padding: 0;
    }


    .project-alert li {
        margin-bottom: 2px;
    }


    /* =========================================================
       ACTIONS
    ========================================================= */

    .project-form-actions {
        display: flex;

        align-items: center;

        justify-content: flex-end;

        gap: 10px;

        padding-top: 21px;

        margin-top: 5px;

        border-top: 1px solid #edf0f5;
    }


    .project-btn {
        height: 43px;

        padding: 0 19px;

        border-radius: 8px;

        border: none;

        font-family: inherit;

        font-size: 13px;

        font-weight: 600;

        text-decoration: none;

        display: inline-flex;

        align-items: center;

        justify-content: center;

        gap: 7px;

        cursor: pointer;

        transition: all 0.2s ease;
    }


    .project-btn-primary {
        background: #3376f2;

        color: #ffffff;

        min-width: 155px;
    }


    .project-btn-primary:hover {
        background: #2867dc;

        color: #ffffff;

        transform: translateY(-1px);

        box-shadow: 0 5px 12px rgba(51, 118, 242, 0.18);
    }


    .project-btn-primary:disabled {
        opacity: 0.7;

        cursor: not-allowed;

        transform: none;
    }


    .project-btn-secondary {
        background: #f1f3f6;

        color: #4b5563;
    }


    .project-btn-secondary:hover {
        background: #e5e7eb;

        color: #1f2937;
    }


    /* =========================================================
       RIGHT SIDEBAR
    ========================================================= */

    .project-side-column {
        position: sticky;

        top: 20px;
    }


    .project-side-card {
        background: #ffffff;

        border: 1px solid #e2e8f0;

        border-radius: 12px;

        padding: 19px 18px;

        margin-bottom: 15px;

        box-shadow: 0 2px 8px rgba(15, 23, 42, 0.025);
    }


    .project-side-heading {
        display: flex;

        align-items: center;

        gap: 9px;

        margin-bottom: 17px;
    }


    .project-side-heading-icon {
        width: 30px;
        height: 30px;

        border-radius: 7px;

        background: #eef4ff;

        color: #3376f2;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 12px;
    }


    .project-side-heading h3 {
        margin: 0;

        color: #354052;

        font-size: 14px;

        font-weight: 650;
    }


    /* =========================================================
       TIPS
    ========================================================= */

    .project-tip {
        display: flex;

        align-items: flex-start;

        gap: 9px;

        margin-bottom: 15px;
    }


    .project-tip:last-child {
        margin-bottom: 0;
    }


    .project-tip-check {
        width: 20px;
        height: 20px;

        min-width: 20px;

        border-radius: 50%;

        background: #eef4ff;

        color: #3376f2;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 9px;

        margin-top: 1px;
    }


    .project-tip p {
        margin: 0;

        color: #6d788b;

        font-size: 11.5px;

        line-height: 1.55;
    }


    .project-tip strong {
        color: #465268;

        font-weight: 650;
    }


    /* =========================================================
       BEFORE POST CARD
    ========================================================= */

    .project-before-post {
        background: #f5f8ff;

        border: 1px solid #dfe9ff;
    }


    .project-before-post .project-side-heading-icon {
        background: #ffffff;
    }


    .project-before-post-text {
        margin: 0;

        color: #6d788b;

        font-size: 11.5px;

        line-height: 1.6;
    }


    /* =========================================================
       MOBILE
    ========================================================= */

    @media (max-width: 900px) {

        .project-content-grid {
            grid-template-columns: 1fr;
        }


        .project-side-column {
            position: static;

            display: grid;

            grid-template-columns: repeat(2, minmax(0, 1fr));

            gap: 15px;
        }


        .project-side-card {
            margin-bottom: 0;
        }

    }


    @media (max-width: 700px) {

        .project-create-page {
            padding: 18px 10px 40px;
        }


        .project-intro {
            padding: 18px;

            align-items: flex-start;
        }


        .project-intro-badge {
            display: none;
        }


        .project-intro h1 {
            font-size: 19px;
        }


        .project-intro p {
            font-size: 12.5px;
        }


        .project-content-grid {
            gap: 15px;
        }


        .project-form-body {
            padding: 20px 17px 22px;
        }


        .project-form-row {
            grid-template-columns: 1fr;

            gap: 0;
        }


        .project-side-column {
            grid-template-columns: 1fr;
        }


        .project-form-actions {
            flex-direction: column-reverse;

            align-items: stretch;
        }


        .project-btn {
            width: 100%;
        }


        .project-btn-primary {
            min-width: 0;
        }

    }


    @media (max-width: 450px) {

        .project-intro-left {
            gap: 11px;
        }


        .project-intro-icon {
            width: 43px;
            height: 43px;
            min-width: 43px;

            font-size: 17px;
        }


        .project-intro h1 {
            font-size: 17px;
        }


        .project-intro p {
            font-size: 11.5px;
        }


        .project-form-body {
            padding: 17px 14px 20px;
        }


        .project-section-heading {
            margin-bottom: 16px;
        }

    }

</style>


<div class="project-create-page">

    <div class="project-page-wrapper">


        {{-- =====================================================
             INTRO
        ====================================================== --}}

        <div class="project-intro">

            <div class="project-intro-left">

                <div class="project-intro-icon">
                    <i class="fas fa-briefcase"></i>
                </div>

                <div>

                    <h1>Create a Project</h1>

                    <p>
                        Share your project requirements and connect with the right professionals.
                    </p>

                </div>

            </div>


            <div class="project-intro-badge">

                <i class="fas fa-shield-check"></i>

                Employer Project

            </div>

        </div>



        {{-- =====================================================
             MAIN CONTENT
        ====================================================== --}}

        <div class="project-content-grid">


            {{-- =================================================
                 FORM
            ================================================== --}}

            <div class="project-form-card">

                <div class="project-form-body">


                    {{-- SUCCESS --}}
                    @if(session('success'))

                        <div class="project-alert project-alert-success">

                            <i class="fas fa-circle-check"></i>

                            {{ session('success') }}

                        </div>

                    @endif


                    {{-- VALIDATION ERRORS --}}
                    @if($errors->any())

                        <div class="project-alert project-alert-danger">

                            <div class="project-alert-title">

                                <i class="fas fa-circle-exclamation"></i>

                                Please fix the following errors

                            </div>


                            <ul>

                                @foreach($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                    @endif



                    <form
                        action="{{ route('employer.projects.store') }}"
                        method="POST"
                        id="projectForm"
                    >

                        @csrf


                        @include('employers.projects._form')


                        {{-- ACTION BUTTONS --}}

                        <div class="project-form-actions">

                            <a
                                href="{{ route('employer.projects.index') }}"
                                class="project-btn project-btn-secondary"
                            >
                                <i class="fas fa-arrow-left"></i>

                                Cancel
                            </a>


                            <button
                                type="submit"
                                class="project-btn project-btn-primary"
                            >

                                <i class="fas fa-paper-plane"></i>

                                Post Project

                            </button>

                        </div>

                    </form>

                </div>

            </div>



            {{-- =================================================
                 RIGHT SIDE
            ================================================== --}}

            <div class="project-side-column">


                {{-- POSTING TIPS --}}

                <div class="project-side-card">

                    <div class="project-side-heading">

                        <div class="project-side-heading-icon">
                            <i class="fas fa-lightbulb"></i>
                        </div>

                        <h3>
                            Make your project attractive
                        </h3>

                    </div>


                    <div class="project-tip">

                        <div class="project-tip-check">
                            <i class="fas fa-check"></i>
                        </div>

                        <p>
                            Use a <strong>specific project title</strong>
                            that clearly explains what you need.
                        </p>

                    </div>


                    <div class="project-tip">

                        <div class="project-tip-check">
                            <i class="fas fa-check"></i>
                        </div>

                        <p>
                            Clearly mention the
                            <strong>budget and expected duration</strong>
                            of the project.
                        </p>

                    </div>


                    <div class="project-tip">

                        <div class="project-tip-check">
                            <i class="fas fa-check"></i>
                        </div>

                        <p>
                            Add the important
                            <strong>technical skills</strong>
                            professionals should have.
                        </p>

                    </div>


                    <div class="project-tip">

                        <div class="project-tip-check">
                            <i class="fas fa-check"></i>
                        </div>

                        <p>
                            Keep the project description
                            <strong>clear and detailed</strong>
                            so candidates understand the work.
                        </p>

                    </div>


                    <div class="project-tip">

                        <div class="project-tip-check">
                            <i class="fas fa-check"></i>
                        </div>

                        <p>
                            Make sure the
                            <strong>work mode and location</strong>
                            are accurate.
                        </p>

                    </div>

                </div>



                {{-- BEFORE POST --}}

                <div class="project-side-card project-before-post">

                    <div class="project-side-heading">

                        <div class="project-side-heading-icon">
                            <i class="fas fa-circle-info"></i>
                        </div>

                        <h3>
                            Before you post
                        </h3>

                    </div>


                    <p class="project-before-post-text">

                        Review all project details carefully.
                        A complete and clear project helps you
                        receive better proposals from qualified
                        professionals.

                    </p>

                </div>


            </div>

        </div>

    </div>

</div>


@include('employers.projects._scripts')

@endsection
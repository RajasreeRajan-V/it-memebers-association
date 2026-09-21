@extends('layouts.app')

@section('title', 'Edit Startup Profile')

@section('content')

<style>
    :root {
        --sp-blue: #3376F2;
        --sp-blue-dark: #245fd0;
        --sp-blue-light: #EEF4FF;
        --sp-navy: #0F172A;
        --sp-text: #172033;
        --sp-muted: #64748B;
        --sp-border: #E2E8F0;
        --sp-bg: #F8FAFC;
        --sp-green: #047857;
        --sp-green-bg: #ECFDF5;
        --sp-red: #DC2626;
        --sp-red-bg: #FEF2F2;
    }

    * {
        box-sizing: border-box;
    }

    .sp-edit-page {
        min-height: 100vh;
        background: var(--sp-bg);
        padding: 28px 0 60px;
    }

    .sp-container {
        width: min(1100px, calc(100% - 30px));
        margin: 0 auto;
    }

    /* =====================================================
       PAGE HEADER
    ===================================================== */

    .sp-page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 25px;
    }

    .sp-heading-left {
        min-width: 0;
    }

    .sp-back {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        color: var(--sp-muted);
        text-decoration: none;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 10px;
        transition: .2s;
    }

    .sp-back:hover {
        color: var(--sp-blue);
    }

    .sp-heading-left h1 {
        margin: 0;
        color: var(--sp-navy);
        font-size: 27px;
        font-weight: 800;
        letter-spacing: -.4px;
    }

    .sp-heading-left p {
        margin: 6px 0 0;
        color: var(--sp-muted);
        font-size: 13px;
        line-height: 1.6;
    }

    .sp-header-actions {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-shrink: 0;
    }

    .sp-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        min-height: 40px;
        padding: 0 15px;
        border-radius: 9px;
        border: 1px solid transparent;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        transition: .2s;
    }

    .sp-btn-secondary {
        color: var(--sp-text);
        background: #fff;
        border-color: var(--sp-border);
    }

    .sp-btn-secondary:hover {
        color: var(--sp-blue);
        border-color: #C9D8F7;
        background: var(--sp-blue-light);
    }

    .sp-btn-primary {
        color: #fff;
        background: var(--sp-blue);
        border-color: var(--sp-blue);
    }

    .sp-btn-primary:hover {
        color: #fff;
        background: var(--sp-blue-dark);
        border-color: var(--sp-blue-dark);
    }

    /* =====================================================
       ALERTS
    ===================================================== */

    .sp-alert {
        display: flex;
        align-items: flex-start;
        gap: 9px;
        padding: 13px 15px;
        border-radius: 11px;
        margin-bottom: 18px;
        font-size: 12px;
        line-height: 1.5;
    }

    .sp-alert-success {
        color: var(--sp-green);
        background: var(--sp-green-bg);
        border: 1px solid #A7F3D0;
    }

    .sp-alert-error {
        color: #B91C1C;
        background: var(--sp-red-bg);
        border: 1px solid #FECACA;
    }

    .sp-alert i {
        margin-top: 2px;
    }

    /* =====================================================
       FORM
    ===================================================== */

    .sp-profile-form {
        display: grid;
        gap: 18px;
    }

    .sp-form-card {
        background: #fff;
        border: 1px solid var(--sp-border);
        border-radius: 17px;
        overflow: hidden;
    }

    .sp-form-card-head {
        display: flex;
        align-items: center;
        gap: 11px;
        padding: 18px 22px;
        border-bottom: 1px solid var(--sp-border);
    }

    .sp-form-card-icon {
        width: 34px;
        height: 34px;
        flex: 0 0 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        background: var(--sp-blue-light);
        color: var(--sp-blue);
        font-size: 13px;
    }

    .sp-form-card-head h2 {
        margin: 0;
        color: var(--sp-navy);
        font-size: 15px;
        font-weight: 800;
    }

    .sp-form-card-head p {
        margin: 3px 0 0;
        color: var(--sp-muted);
        font-size: 11px;
    }

    .sp-form-card-body {
        padding: 22px;
    }

    /* =====================================================
       GRID
    ===================================================== */

    .sp-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 17px;
    }

    .sp-grid-3 {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 17px;
    }

    .sp-full {
        grid-column: 1 / -1;
    }

    /* =====================================================
       LABELS
    ===================================================== */

    .sp-field {
        min-width: 0;
    }

    .sp-label {
        display: block;
        color: var(--sp-text);
        font-size: 11px;
        font-weight: 700;
        margin-bottom: 7px;
    }

    .sp-required {
        color: #DC2626;
    }

    .sp-help {
        margin-top: 5px;
        color: #94A3B8;
        font-size: 10px;
        line-height: 1.5;
    }

    /* =====================================================
       INPUTS
    ===================================================== */

    .sp-input,
    .sp-select,
    .sp-textarea {
        width: 100%;
        border: 1px solid #DCE3ED;
        background: #fff;
        color: var(--sp-text);
        border-radius: 9px;
        outline: none;
        font-family: inherit;
        font-size: 12px;
        transition: .2s;
    }

    .sp-input,
    .sp-select {
        height: 42px;
        padding: 0 12px;
    }

    .sp-textarea {
        min-height: 120px;
        padding: 11px 12px;
        resize: vertical;
        line-height: 1.7;
    }

    .sp-input:focus,
    .sp-select:focus,
    .sp-textarea:focus {
        border-color: var(--sp-blue);
        box-shadow: 0 0 0 3px rgba(51,118,242,.08);
    }

    .sp-input::placeholder,
    .sp-textarea::placeholder {
        color: #A3ADBB;
    }

    .sp-input[readonly],
    .sp-input:disabled,
    .sp-select:disabled,
    .sp-textarea[readonly] {
        background: #F8FAFC;
        color: #64748B;
        cursor: not-allowed;
    }

    /* =====================================================
       ERROR
    ===================================================== */

    .sp-error {
        margin-top: 5px;
        color: #DC2626;
        font-size: 10px;
        line-height: 1.5;
    }

    .sp-invalid {
        border-color: #FCA5A5 !important;
        background: #FFF7F7 !important;
    }

    /* =====================================================
       FILE UPLOAD
    ===================================================== */

    .sp-file-box {
        border: 1px dashed #CBD5E1;
        background: #F8FAFC;
        border-radius: 11px;
        padding: 14px;
    }

    .sp-current-image {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
        padding-bottom: 12px;
        border-bottom: 1px solid var(--sp-border);
    }

    .sp-current-image img {
        width: 65px;
        height: 65px;
        object-fit: cover;
        border-radius: 10px;
        background: #fff;
        border: 1px solid var(--sp-border);
    }

    .sp-current-image-info {
        min-width: 0;
    }

    .sp-current-image-info strong {
        display: block;
        color: var(--sp-text);
        font-size: 11px;
        margin-bottom: 3px;
    }

    .sp-current-image-info span {
        color: var(--sp-muted);
        font-size: 10px;
    }

    .sp-file-box input[type="file"] {
        width: 100%;
        font-size: 11px;
        color: var(--sp-muted);
    }

    /* =====================================================
       CHECKBOXES
    ===================================================== */

    .sp-checkbox-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 9px;
    }

    .sp-checkbox {
        position: relative;
    }

    .sp-checkbox input {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .sp-checkbox label {
        display: flex;
        align-items: center;
        gap: 9px;
        min-height: 43px;
        padding: 9px 11px;
        background: #fff;
        border: 1px solid #DCE3ED;
        border-radius: 9px;
        color: var(--sp-text);
        font-size: 11px;
        font-weight: 600;
        cursor: pointer;
        transition: .2s;
    }

    .sp-checkbox label::before {
        content: "";
        width: 16px;
        height: 16px;
        flex: 0 0 16px;
        border-radius: 4px;
        border: 1px solid #CBD5E1;
        background: #fff;
        transition: .2s;
    }

    .sp-checkbox input:checked + label {
        background: var(--sp-blue-light);
        border-color: #AFC8FA;
        color: var(--sp-blue);
    }

    .sp-checkbox input:checked + label::before {
        background: var(--sp-blue);
        border-color: var(--sp-blue);
        box-shadow: inset 0 0 0 3px #fff;
    }

    /* =====================================================
       STATUS
    ===================================================== */

    .sp-status-box {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    .sp-status-item {
        padding: 13px;
        background: #F8FAFC;
        border: 1px solid var(--sp-border);
        border-radius: 10px;
    }

    .sp-status-label {
        display: block;
        color: #94A3B8;
        font-size: 9px;
        margin-bottom: 5px;
    }

    .sp-status-value {
        color: var(--sp-text);
        font-size: 12px;
        font-weight: 700;
    }

    .sp-status-approved {
        color: #047857;
    }

    .sp-status-pending {
        color: #C2410C;
    }

    .sp-status-rejected {
        color: #DC2626;
    }

    /* =====================================================
       BOTTOM ACTIONS
    ===================================================== */

    .sp-form-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 18px 20px;
        background: #fff;
        border: 1px solid var(--sp-border);
        border-radius: 15px;
    }

    .sp-form-actions-left {
        color: #94A3B8;
        font-size: 10px;
        line-height: 1.5;
    }

    .sp-form-actions-right {
        display: flex;
        align-items: center;
        gap: 9px;
    }

    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media (max-width: 850px) {

        .sp-grid-3 {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .sp-checkbox-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

    }

    @media (max-width: 700px) {

        .sp-page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .sp-header-actions {
            width: 100%;
        }

        .sp-header-actions .sp-btn {
            flex: 1;
        }

        .sp-grid,
        .sp-grid-3 {
            grid-template-columns: 1fr;
        }

        .sp-checkbox-grid {
            grid-template-columns: 1fr;
        }

        .sp-status-box {
            grid-template-columns: 1fr;
        }

        .sp-form-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .sp-form-actions-right {
            width: 100%;
        }

        .sp-form-actions-right .sp-btn {
            flex: 1;
        }

    }

    @media (max-width: 480px) {

        .sp-container {
            width: calc(100% - 20px);
        }

        .sp-form-card-body {
            padding: 16px;
        }

        .sp-form-card-head {
            padding: 16px;
        }

        .sp-header-actions {
            flex-direction: column;
        }

        .sp-header-actions .sp-btn {
            width: 100%;
        }

    }
</style>


@php

    /*
    |--------------------------------------------------------------------------
    | Existing selected values
    |--------------------------------------------------------------------------
    */

    $lookingFor = old(
        'looking_for',
        !empty($profile?->looking_for)
            ? (
                is_array($profile->looking_for)
                    ? $profile->looking_for
                    : json_decode($profile->looking_for, true)
            )
            : []
    );

    $lookingFor = is_array($lookingFor)
        ? $lookingFor
        : [];


    $opportunities = old(
        'opportunities',
        !empty($profile?->opportunities)
            ? (
                is_array($profile->opportunities)
                    ? $profile->opportunities
                    : json_decode($profile->opportunities, true)
            )
            : []
    );

    $opportunities = is_array($opportunities)
        ? $opportunities
        : [];

@endphp


<div class="sp-edit-page">

    <div class="sp-container">

        {{-- =====================================================
             PAGE HEADER
        ====================================================== --}}

        <div class="sp-page-header">

            <div class="sp-heading-left">

                <a href="{{ route('employer.startup-profile.show', ['startupProfile' => $profile->id]) }}"
                   class="sp-back">

                    <i class="fa-solid fa-arrow-left"></i>

                    Back to Startup Profile

                </a>

                <h1>
                    Edit Startup Profile
                </h1>

                <p>
                    Update the information displayed on your startup showcase.
                </p>

            </div>


            <div class="sp-header-actions">

                <a href="{{ route('employer.startup-profile.show', ['startupProfile' => $profile->id]) }}"
                   class="sp-btn sp-btn-secondary">

                    <i class="fa-regular fa-eye"></i>

                    View Profile

                </a>

            </div>

        </div>


        {{-- =====================================================
             SUCCESS
        ====================================================== --}}

        @if(session('success'))

            <div class="sp-alert sp-alert-success">

                <i class="fa-solid fa-circle-check"></i>

                <span>
                    {{ session('success') }}
                </span>

            </div>

        @endif


        {{-- =====================================================
             ERROR
        ====================================================== --}}

        @if(session('error'))

            <div class="sp-alert sp-alert-error">

                <i class="fa-solid fa-circle-exclamation"></i>

                <span>
                    {{ session('error') }}
                </span>

            </div>

        @endif


        {{-- =====================================================
             VALIDATION ERRORS
        ====================================================== --}}

        @if($errors->any())

            <div class="sp-alert sp-alert-error">

                <i class="fa-solid fa-circle-exclamation"></i>

                <div>

                    <strong>
                        Please correct the following:
                    </strong>

                    <ul style="margin:5px 0 0 16px;padding:0;">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>

        @endif


        {{-- =====================================================
             MAIN FORM
             IMPORTANT:
             startupProfile PARAMETER IS PASSED HERE
        ====================================================== --}}

        <form action="{{ route('employer.startup-profile.update', ['startupProfile' => $profile->id]) }}"
              method="POST"
              enctype="multipart/form-data"
              class="sp-profile-form"
              id="startupProfileForm">

            @csrf

            @method('PUT')


            {{-- =================================================
                 STARTUP INFORMATION
            ================================================== --}}

            <div class="sp-form-card">

                <div class="sp-form-card-head">

                    <div class="sp-form-card-icon">

                        <i class="fa-solid fa-building"></i>

                    </div>

                    <div>

                        <h2>
                            Startup Information
                        </h2>

                        <p>
                            Basic information about your startup.
                        </p>

                    </div>

                </div>


                <div class="sp-form-card-body">

                    <div class="sp-grid">

                        {{-- Startup Name --}}
                        <div class="sp-field">

                            <label class="sp-label">
                                Startup Name
                                <span class="sp-required">*</span>
                            </label>

                            <input
                                type="text"
                                name="startup_name"
                                value="{{ old('startup_name', $profile->startup_name) }}"
                                class="sp-input @error('startup_name') sp-invalid @enderror"
                                placeholder="Enter startup name"
                                required
                            >

                            @error('startup_name')

                                <div class="sp-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- Slug --}}
                        <div class="sp-field">

                            <label class="sp-label">
                                Profile Slug
                                <span class="sp-required">*</span>
                            </label>

                            <input
                                type="text"
                                name="slug"
                                value="{{ old('slug', $profile->slug) }}"
                                class="sp-input @error('slug') sp-invalid @enderror"
                                placeholder="example-startup"
                                required
                            >

                            <div class="sp-help">
                                Use lowercase letters, numbers and hyphens.
                            </div>

                            @error('slug')

                                <div class="sp-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- Tagline --}}
                        <div class="sp-field sp-full">

                            <label class="sp-label">
                                Tagline
                            </label>

                            <input
                                type="text"
                                name="tagline"
                                value="{{ old('tagline', $profile->tagline) }}"
                                class="sp-input @error('tagline') sp-invalid @enderror"
                                placeholder="A short sentence describing your startup"
                            >

                            @error('tagline')

                                <div class="sp-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- Category --}}
                        <div class="sp-field">

                            <label class="sp-label">
                                Category
                                <span class="sp-required">*</span>
                            </label>

                            <select
                                name="category"
                                class="sp-select @error('category') sp-invalid @enderror"
                                required
                            >

                                <option value="">
                                    Select Category
                                </option>

                                @php
                                    $categories = [
                                        'IT & Software',
                                        'Business Services',
                                        'FinTech',
                                        'EdTech',
                                        'HealthTech',
                                        'E-Commerce',
                                        'SaaS',
                                        'AI & Machine Learning',
                                        'Technology Products',
                                        'Other',
                                    ];
                                @endphp

                                @foreach($categories as $category)

                                    <option
                                        value="{{ $category }}"
                                        @selected(old('category', $profile->category) === $category)
                                    >
                                        {{ $category }}
                                    </option>

                                @endforeach

                            </select>

                            @error('category')

                                <div class="sp-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- Industry --}}
                        <div class="sp-field">

                            <label class="sp-label">
                                Industry
                                <span class="sp-required">*</span>
                            </label>

                            <input
                                type="text"
                                name="industry"
                                value="{{ old('industry', $profile->industry) }}"
                                class="sp-input @error('industry') sp-invalid @enderror"
                                placeholder="Information Technology"
                                required
                            >

                            @error('industry')

                                <div class="sp-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- Startup Type --}}
                        <div class="sp-field">

                            <label class="sp-label">
                                Startup Type
                                <span class="sp-required">*</span>
                            </label>

                            <select
                                name="startup_type"
                                class="sp-select @error('startup_type') sp-invalid @enderror"
                                required
                            >

                                <option value="">
                                    Select Type
                                </option>

                                @php
                                    $startupTypes = [
                                        'SaaS Startup',
                                        'Technology Startup',
                                        'Product Startup',
                                        'Service Startup',
                                        'E-Commerce Startup',
                                        'Social Enterprise',
                                        'FinTech Startup',
                                        'EdTech Startup',
                                        'HealthTech Startup',
                                        'Other',
                                    ];
                                @endphp

                                @foreach($startupTypes as $type)

                                    <option
                                        value="{{ $type }}"
                                        @selected(old('startup_type', $profile->startup_type) === $type)
                                    >
                                        {{ $type }}
                                    </option>

                                @endforeach

                            </select>

                            @error('startup_type')

                                <div class="sp-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- Founded Year --}}
                        <div class="sp-field">

                            <label class="sp-label">
                                Founded Year
                            </label>

                            <input
                                type="number"
                                name="founded_year"
                                value="{{ old('founded_year', $profile->founded_year) }}"
                                class="sp-input @error('founded_year') sp-invalid @enderror"
                                min="1900"
                                max="{{ date('Y') }}"
                                placeholder="{{ date('Y') }}"
                            >

                            @error('founded_year')

                                <div class="sp-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- Startup Stage --}}
                        <div class="sp-field">

                            <label class="sp-label">
                                Startup Stage
                            </label>

                            <select
                                name="startup_stage"
                                class="sp-select @error('startup_stage') sp-invalid @enderror"
                            >

                                <option value="">
                                    Select Stage
                                </option>

                                @php
                                    $stages = [
                                        'Idea',
                                        'Pre-Seed',
                                        'Seed',
                                        'Series A',
                                        'Series B',
                                        'Series C',
                                        'Growth',
                                        'Established',
                                    ];
                                @endphp

                                @foreach($stages as $stage)

                                    <option
                                        value="{{ $stage }}"
                                        @selected(old('startup_stage', $profile->startup_stage) === $stage)
                                    >
                                        {{ $stage }}
                                    </option>

                                @endforeach

                            </select>

                            @error('startup_stage')

                                <div class="sp-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- Team Size --}}
                        <div class="sp-field">

                            <label class="sp-label">
                                Team Size
                            </label>

                            <select
                                name="team_size"
                                class="sp-select @error('team_size') sp-invalid @enderror"
                            >

                                <option value="">
                                    Select Team Size
                                </option>

                                @php
                                    $teamSizes = [
                                        '1-10',
                                        '11-50',
                                        '51-200',
                                        '201-500',
                                        '501-1000',
                                        '1000+',
                                    ];
                                @endphp

                                @foreach($teamSizes as $size)

                                    <option
                                        value="{{ $size }}"
                                        @selected(old('team_size', $profile->team_size) === $size)
                                    >
                                        {{ $size }}
                                    </option>

                                @endforeach

                            </select>

                            @error('team_size')

                                <div class="sp-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- Location --}}
                        <div class="sp-field">

                            <label class="sp-label">
                                Location
                            </label>

                            <input
                                type="text"
                                name="location"
                                value="{{ old('location', $profile->location) }}"
                                class="sp-input @error('location') sp-invalid @enderror"
                                placeholder="Bengaluru, Karnataka, India"
                            >

                            @error('location')

                                <div class="sp-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- Website --}}
                        <div class="sp-field">

                            <label class="sp-label">
                                Website
                            </label>

                            <input
                                type="url"
                                name="website"
                                value="{{ old('website', $profile->website) }}"
                                class="sp-input @error('website') sp-invalid @enderror"
                                placeholder="https://example.com"
                            >

                            @error('website')

                                <div class="sp-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 BRANDING
            ================================================== --}}

            <div class="sp-form-card">

                <div class="sp-form-card-head">

                    <div class="sp-form-card-icon">

                        <i class="fa-solid fa-image"></i>

                    </div>

                    <div>

                        <h2>
                            Branding
                        </h2>

                        <p>
                            Add your startup logo and cover image.
                        </p>

                    </div>

                </div>


                <div class="sp-form-card-body">

                    <div class="sp-grid">

                        {{-- Logo --}}
                        <div class="sp-field">

                            <label class="sp-label">
                                Startup Logo
                            </label>

                            <div class="sp-file-box">

                                @if($profile->logo)

                                    <div class="sp-current-image">

                                        <img
                                            src="{{ asset('storage/' . $profile->logo) }}"
                                            alt="{{ $profile->startup_name }}"
                                        >

                                        <div class="sp-current-image-info">

                                            <strong>
                                                Current Logo
                                            </strong>

                                            <span>
                                                Upload a new image to replace it.
                                            </span>

                                        </div>

                                    </div>

                                @endif

                                <input
                                    type="file"
                                    name="logo"
                                    accept=".jpg,.jpeg,.png,.webp"
                                >

                                <div class="sp-help">
                                    JPG, JPEG, PNG or WEBP. Maximum 2MB.
                                </div>

                            </div>

                            @error('logo')

                                <div class="sp-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- Cover --}}
                        <div class="sp-field">

                            <label class="sp-label">
                                Cover Image
                            </label>

                            <div class="sp-file-box">

                                @if($profile->cover_image)

                                    <div class="sp-current-image">

                                        <img
                                            src="{{ asset('storage/' . $profile->cover_image) }}"
                                            alt="{{ $profile->startup_name }} cover"
                                        >

                                        <div class="sp-current-image-info">

                                            <strong>
                                                Current Cover
                                            </strong>

                                            <span>
                                                Upload a new image to replace it.
                                            </span>

                                        </div>

                                    </div>

                                @endif

                                <input
                                    type="file"
                                    name="cover_image"
                                    accept=".jpg,.jpeg,.png,.webp"
                                >

                                <div class="sp-help">
                                    JPG, JPEG, PNG or WEBP. Maximum 5MB.
                                </div>

                            </div>

                            @error('cover_image')

                                <div class="sp-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 DESCRIPTION
            ================================================== --}}

            <div class="sp-form-card">

                <div class="sp-form-card-head">

                    <div class="sp-form-card-icon">

                        <i class="fa-solid fa-align-left"></i>

                    </div>

                    <div>

                        <h2>
                            About Your Startup
                        </h2>

                        <p>
                            Explain what your startup does and what it stands for.
                        </p>

                    </div>

                </div>


                <div class="sp-form-card-body">

                    <div class="sp-grid">

                        {{-- Short Description --}}
                        <div class="sp-field sp-full">

                            <label class="sp-label">
                                Short Description
                                <span class="sp-required">*</span>
                            </label>

                            <textarea
                                name="short_description"
                                class="sp-textarea @error('short_description') sp-invalid @enderror"
                                maxlength="1000"
                                placeholder="Write a short description of your startup..."
                                required
                            >{{ old('short_description', $profile->short_description) }}</textarea>

                            <div class="sp-help">
                                This is the short description shown on startup cards.
                            </div>

                            @error('short_description')

                                <div class="sp-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- About --}}
                        <div class="sp-field sp-full">

                            <label class="sp-label">
                                About
                            </label>

                            <textarea
                                name="about"
                                class="sp-textarea @error('about') sp-invalid @enderror"
                                placeholder="Describe your startup in detail..."
                            >{{ old('about', $profile->about) }}</textarea>

                            @error('about')

                                <div class="sp-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- Mission --}}
                        <div class="sp-field">

                            <label class="sp-label">
                                Mission
                            </label>

                            <textarea
                                name="mission"
                                class="sp-textarea @error('mission') sp-invalid @enderror"
                                placeholder="What is your startup's mission?"
                            >{{ old('mission', $profile->mission) }}</textarea>

                            @error('mission')

                                <div class="sp-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- Vision --}}
                        <div class="sp-field">

                            <label class="sp-label">
                                Vision
                            </label>

                            <textarea
                                name="vision"
                                class="sp-textarea @error('vision') sp-invalid @enderror"
                                placeholder="What is your startup's vision?"
                            >{{ old('vision', $profile->vision) }}</textarea>

                            @error('vision')

                                <div class="sp-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 PRODUCTS & TECHNOLOGIES
            ================================================== --}}

            <div class="sp-form-card">

                <div class="sp-form-card-head">

                    <div class="sp-form-card-icon">

                        <i class="fa-solid fa-code"></i>

                    </div>

                    <div>

                        <h2>
                            Products & Technologies
                        </h2>

                        <p>
                            Tell visitors what you build and which technologies you use.
                        </p>

                    </div>

                </div>


                <div class="sp-form-card-body">

                    <div class="sp-grid">

                        {{-- Products --}}
                        <div class="sp-field">

                            <label class="sp-label">
                                Products / Services
                            </label>

                            <textarea
                                name="products_services"
                                class="sp-textarea @error('products_services') sp-invalid @enderror"
                                placeholder="List your products or services..."
                            >{{ old('products_services', $profile->products_services) }}</textarea>

                            @error('products_services')

                                <div class="sp-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- Technologies --}}
                        <div class="sp-field">

                            <label class="sp-label">
                                Technologies
                            </label>

                            <textarea
                                name="technologies"
                                class="sp-textarea @error('technologies') sp-invalid @enderror"
                                placeholder="Laravel&#10;PHP&#10;MySQL&#10;React&#10;AWS"
                            >{{ old('technologies', $profile->technologies) }}</textarea>

                            @error('technologies')

                                <div class="sp-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 WHO YOU ARE LOOKING FOR
            ================================================== --}}

            <div class="sp-form-card">

                <div class="sp-form-card-head">

                    <div class="sp-form-card-icon">

                        <i class="fa-solid fa-users"></i>

                    </div>

                    <div>

                        <h2>
                            Who Are You Looking For?
                        </h2>

                        <p>
                            Select the member roles your startup wants to connect with.
                        </p>

                    </div>

                </div>


                <div class="sp-form-card-body">

                    <div class="sp-checkbox-grid">

                        @php
                            $lookingForOptions = [
                                'employee' => 'Employees',
                                'freelancer' => 'Freelancers',
                                'investor' => 'Investors',
                                'mentor' => 'Mentors',
                                'student' => 'Students',
                                'business_partner' => 'Business Partners',
                            ];
                        @endphp


                        @foreach($lookingForOptions as $value => $label)

                            <div class="sp-checkbox">

                                <input
                                    type="checkbox"
                                    id="looking_{{ $value }}"
                                    name="looking_for[]"
                                    value="{{ $value }}"
                                    @checked(in_array($value, $lookingFor))
                                >

                                <label for="looking_{{ $value }}">
                                    {{ $label }}
                                </label>

                            </div>

                        @endforeach

                    </div>

                    @error('looking_for')

                        <div class="sp-error">
                            {{ $message }}
                        </div>

                    @enderror

                    @error('looking_for.*')

                        <div class="sp-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

            </div>


            {{-- =================================================
                 OPPORTUNITIES
            ================================================== --}}

            <div class="sp-form-card">

                <div class="sp-form-card-head">

                    <div class="sp-form-card-icon">

                        <i class="fa-solid fa-bullhorn"></i>

                    </div>

                    <div>

                        <h2>
                            Opportunities
                        </h2>

                        <p>
                            Select the opportunities your startup may offer.
                        </p>

                    </div>

                </div>


                <div class="sp-form-card-body">

                    <div class="sp-checkbox-grid">

                        @php
                            $opportunityOptions = [
                                'jobs' => 'Jobs',
                                'internships' => 'Internships',
                                'freelance_projects' => 'Freelance Projects',
                                'student_projects' => 'Student Projects',
                                'mentorship' => 'Mentorship',
                                'business_partnerships' => 'Business Partnerships',
                                'investment' => 'Investment',
                            ];
                        @endphp


                        @foreach($opportunityOptions as $value => $label)

                            <div class="sp-checkbox">

                                <input
                                    type="checkbox"
                                    id="opportunity_{{ $value }}"
                                    name="opportunities[]"
                                    value="{{ $value }}"
                                    @checked(in_array($value, $opportunities))
                                >

                                <label for="opportunity_{{ $value }}">
                                    {{ $label }}
                                </label>

                            </div>

                        @endforeach

                    </div>

                    @error('opportunities')

                        <div class="sp-error">
                            {{ $message }}
                        </div>

                    @enderror

                    @error('opportunities.*')

                        <div class="sp-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

            </div>


            {{-- =================================================
                 CONTACT
            ================================================== --}}

            <div class="sp-form-card">

                <div class="sp-form-card-head">

                    <div class="sp-form-card-icon">

                        <i class="fa-solid fa-address-card"></i>

                    </div>

                    <div>

                        <h2>
                            Contact Information
                        </h2>

                        <p>
                            Optional contact details for your startup.
                        </p>

                    </div>

                </div>


                <div class="sp-form-card-body">

                    <div class="sp-grid">

                        {{-- Email --}}
                        <div class="sp-field">

                            <label class="sp-label">
                                Startup Email
                            </label>

                            <input
                                type="email"
                                name="startup_email"
                                value="{{ old('startup_email', $profile->startup_email) }}"
                                class="sp-input @error('startup_email') sp-invalid @enderror"
                                placeholder="hello@example.com"
                            >

                            @error('startup_email')

                                <div class="sp-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- Phone --}}
                        <div class="sp-field">

                            <label class="sp-label">
                                Startup Phone
                            </label>

                            <input
                                type="text"
                                name="startup_phone"
                                value="{{ old('startup_phone', $profile->startup_phone) }}"
                                class="sp-input @error('startup_phone') sp-invalid @enderror"
                                placeholder="+91 98765 43210"
                            >

                            @error('startup_phone')

                                <div class="sp-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- LinkedIn --}}
                        <div class="sp-field sp-full">

                            <label class="sp-label">
                                LinkedIn
                            </label>

                            <input
                                type="url"
                                name="linkedin"
                                value="{{ old('linkedin', $profile->linkedin) }}"
                                class="sp-input @error('linkedin') sp-invalid @enderror"
                                placeholder="https://www.linkedin.com/company/example"
                            >

                            @error('linkedin')

                                <div class="sp-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 FUNDING
            ================================================== --}}

            <div class="sp-form-card">

                <div class="sp-form-card-head">

                    <div class="sp-form-card-icon">

                        <i class="fa-solid fa-chart-pie"></i>

                    </div>

                    <div>

                        <h2>
                            Funding Information
                        </h2>

                        <p>
                            Optional information about your startup's funding.
                        </p>

                    </div>

                </div>


                <div class="sp-form-card-body">

                    <div class="sp-grid-3">

                        {{-- Funding Stage --}}
                        <div class="sp-field">

                            <label class="sp-label">
                                Funding Stage
                            </label>

                            <select
                                name="funding_stage"
                                class="sp-select @error('funding_stage') sp-invalid @enderror"
                            >

                                <option value="">
                                    Select Funding Stage
                                </option>

                                @php
                                    $fundingStages = [
                                        'Bootstrapped',
                                        'Pre-Seed',
                                        'Seed',
                                        'Series A',
                                        'Series B',
                                        'Series C',
                                        'Growth',
                                        'Other',
                                    ];
                                @endphp

                                @foreach($fundingStages as $stage)

                                    <option
                                        value="{{ $stage }}"
                                        @selected(old('funding_stage', $profile->funding_stage) === $stage)
                                    >
                                        {{ $stage }}
                                    </option>

                                @endforeach

                            </select>

                            @error('funding_stage')

                                <div class="sp-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- Currently Raising --}}
                        <div class="sp-field">

                            <label class="sp-label">
                                Currently Raising
                            </label>

                            <select
                                name="currently_raising"
                                class="sp-select @error('currently_raising') sp-invalid @enderror"
                            >

                                <option value="">
                                    Select
                                </option>

                                <option
                                    value="yes"
                                    @selected(old('currently_raising', $profile->currently_raising) === 'yes')
                                >
                                    Yes
                                </option>

                                <option
                                    value="no"
                                    @selected(old('currently_raising', $profile->currently_raising) === 'no')
                                >
                                    No
                                </option>

                            </select>

                            @error('currently_raising')

                                <div class="sp-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- Funding Requirement --}}
                        <div class="sp-field">

                            <label class="sp-label">
                                Funding Requirement
                            </label>

                            <input
                                type="number"
                                name="funding_requirement"
                                value="{{ old('funding_requirement', $profile->funding_requirement) }}"
                                class="sp-input @error('funding_requirement') sp-invalid @enderror"
                                placeholder="25000000"
                                min="0"
                                step="0.01"
                            >

                            <div class="sp-help">
                                Enter the amount in INR.
                            </div>

                            @error('funding_requirement')

                                <div class="sp-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 PROFILE STATUS
            ================================================== --}}

            <div class="sp-form-card">

                <div class="sp-form-card-head">

                    <div class="sp-form-card-icon">

                        <i class="fa-solid fa-circle-info"></i>

                    </div>

                    <div>

                        <h2>
                            Profile Status
                        </h2>

                        <p>
                            Status is managed by the system and administrator.
                        </p>

                    </div>

                </div>


                <div class="sp-form-card-body">

                    <div class="sp-status-box">

                        <div class="sp-status-item">

                            <span class="sp-status-label">
                                Approval Status
                            </span>

                            <strong
                                class="sp-status-value
                                @if($profile->status === 'approved')
                                    sp-status-approved
                                @elseif($profile->status === 'pending')
                                    sp-status-pending
                                @elseif($profile->status === 'rejected')
                                    sp-status-rejected
                                @endif"
                            >

                                @if($profile->status === 'approved')

                                    Approved

                                @elseif($profile->status === 'pending')

                                    Pending Approval

                                @elseif($profile->status === 'rejected')

                                    Rejected

                                @else

                                    {{ ucfirst($profile->status ?? 'Draft') }}

                                @endif

                            </strong>

                        </div>


                        <div class="sp-status-item">

                            <span class="sp-status-label">
                                Publication Status
                            </span>

                            <strong class="sp-status-value">

                                @if($profile->is_published)

                                    Published

                                @else

                                    Unpublished

                                @endif

                            </strong>

                        </div>

                    </div>


                    @if($profile->rejection_reason)

                        <div style="
                            margin-top:15px;
                            padding:13px;
                            background:#FEF2F2;
                            border:1px solid #FECACA;
                            border-radius:10px;
                        ">

                            <div style="
                                color:#B91C1C;
                                font-size:11px;
                                font-weight:800;
                                margin-bottom:5px;
                            ">

                                <i class="fa-solid fa-circle-exclamation"></i>

                                Admin Feedback

                            </div>

                            <div style="
                                color:#991B1B;
                                font-size:11px;
                                line-height:1.6;
                            ">

                                {{ $profile->rejection_reason }}

                            </div>

                        </div>

                    @endif

                </div>

            </div>


            {{-- =================================================
                 FORM ACTIONS
            ================================================== --}}

            <div class="sp-form-actions">

                <div class="sp-form-actions-left">

                    <i class="fa-solid fa-circle-info"></i>

                    Saving changes will submit the profile for approval again.

                </div>


                <div class="sp-form-actions-right">

                    <a href="{{ route('employer.startup-profile.show', ['startupProfile' => $profile->id]) }}"
                       class="sp-btn sp-btn-secondary">

                        Cancel

                    </a>


                    <button
                        type="submit"
                        class="sp-btn sp-btn-primary"
                        id="saveStartupBtn"
                    >

                        <i class="fa-solid fa-floppy-disk"></i>

                        Save Changes

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('startupProfileForm');
    const button = document.getElementById('saveStartupBtn');

    if (!form || !button) {
        return;
    }

    form.addEventListener('submit', function () {

        button.disabled = true;

        button.innerHTML = `
            <i class="fa-solid fa-spinner fa-spin"></i>
            Saving...
        `;

    });


    /*
    |--------------------------------------------------------------------------
    | Slug helper
    |--------------------------------------------------------------------------
    */

    const startupName = document.querySelector('[name="startup_name"]');
    const slugInput = document.querySelector('[name="slug"]');

    if (startupName && slugInput) {

        startupName.addEventListener('input', function () {

            /*
             * Only generate automatically when the slug is empty.
             * This prevents accidentally changing an existing custom slug.
             */

            if (slugInput.value.trim() !== '') {
                return;
            }

            slugInput.value = startupName.value
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');

        });

    }


    /*
    |--------------------------------------------------------------------------
    | Remove invalid state after user starts typing
    |--------------------------------------------------------------------------
    */

    document.querySelectorAll('.sp-input, .sp-select, .sp-textarea')
        .forEach(function (field) {

            field.addEventListener('input', function () {
                this.classList.remove('sp-invalid');
            });

            field.addEventListener('change', function () {
                this.classList.remove('sp-invalid');
            });

        });

});
</script>

@endsection
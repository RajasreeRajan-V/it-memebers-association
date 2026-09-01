@extends('layouts.app')

@section('title', $training->title)

@section('content')

@push('styles')
<style>

    .training-standalone {
        max-width: 760px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    .training-back-link {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 20px;
        color: #64748b;
        font-size: 13px;
        font-weight: 500;
        text-decoration: none;
    }

    .training-back-link:hover {
        color: #2563eb;
    }

    .training-back-link svg {
        width: 16px;
        height: 16px;
    }


    /* =========================================================
       DETAILS
    ========================================================= */

    .training-details {
        width: 100%;
        background: #ffffff;
    }


    /* =========================================================
       HEADER
    ========================================================= */

    .training-details-header {
        padding: 22px 54px 18px 22px;
        border: 1px solid #edf2f7;
        border-bottom: 0;
        border-radius: 18px 18px 0 0;
        background: #ffffff;
    }

    .training-details-header-row {
        display: flex;
        align-items: flex-start;
        gap: 13px;
    }

    .training-details-icon {
        width: 46px;
        height: 46px;
        flex: 0 0 46px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: #eff6ff;
        border: 1px solid #dbeafe;
        color: #2563eb;
    }

    .training-details-icon svg {
        width: 23px;
        height: 23px;
    }

    .training-details-heading {
        min-width: 0;
    }

    .training-details-category-row {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 7px;
        margin-bottom: 4px;
    }

    .training-details-category {
        color: #2563eb;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .8px;
        text-transform: uppercase;
    }

    .training-details-level {
        padding: 3px 8px;
        border-radius: 999px;
        background: #eff6ff;
        color: #2563eb;
        font-size: 9px;
        font-weight: 700;
        letter-spacing: .4px;
        text-transform: uppercase;
    }

    .training-details-title {
        margin: 0;
        color: #0f172a;
        font-size: 22px;
        line-height: 1.25;
        font-weight: 700;
    }

    .training-details-short-description {
        margin: 6px 0 0;
        color: #64748b;
        font-size: 13px;
        line-height: 1.55;
    }


    /* =========================================================
       BODY
    ========================================================= */

    .training-details-body {
        padding: 20px 22px 24px;
        border: 1px solid #edf2f7;
        border-radius: 0 0 18px 18px;
    }


    /* =========================================================
       IMAGE
    ========================================================= */

    .training-details-image {
        width: 100%;
        height: 250px;
        display: block;
        object-fit: cover;
        border-radius: 12px;
        background: #f1f5f9;
        border: 1px solid #e2e8f0;
        margin-bottom: 18px;
    }


    /* =========================================================
       INFO
    ========================================================= */

    .training-info-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
        margin-bottom: 22px;
    }

    .training-info-card {
        min-height: 67px;
        padding: 12px 13px;
        background: #f8fafc;
        border: 1px solid #f1f5f9;
        border-radius: 11px;
    }

    .training-info-label {
        display: block;
        margin-bottom: 5px;
        color: #94a3b8;
        font-size: 9px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .training-info-value {
        display: block;
        color: #1e293b;
        font-size: 13px;
        line-height: 1.35;
        font-weight: 600;
        word-break: break-word;
    }


    /* =========================================================
       SECTIONS
    ========================================================= */

    .training-detail-section {
        margin-bottom: 22px;
    }

    .training-detail-section-title {
        margin: 0 0 10px;
        color: #1e293b;
        font-size: 14px;
        font-weight: 700;
    }

    .training-detail-description {
        margin: 0;
        color: #475569;
        font-size: 13px;
        line-height: 1.8;
        white-space: pre-line;
    }


    /* =========================================================
       SCHEDULE
    ========================================================= */

    .training-schedule-box {
        margin-bottom: 22px;
        padding: 15px;
        background: #eff6ff;
        border: 1px solid #dbeafe;
        border-radius: 12px;
    }

    .training-schedule-header {
        display: flex;
        align-items: center;
        gap: 9px;
        margin-bottom: 13px;
    }

    .training-schedule-icon {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        background: #dbeafe;
        color: #2563eb;
    }

    .training-schedule-icon svg {
        width: 16px;
        height: 16px;
    }

    .training-schedule-title {
        margin: 0;
        color: #1e293b;
        font-size: 13px;
        font-weight: 700;
    }

    .training-schedule-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .training-schedule-label {
        display: block;
        color: #94a3b8;
        font-size: 10px;
        margin-bottom: 3px;
    }

    .training-schedule-value {
        color: #334155;
        font-size: 12px;
        font-weight: 600;
    }

    .training-meeting-button {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-top: 13px;
        padding: 8px 13px;
        border-radius: 7px;
        background: #2563eb;
        color: #ffffff;
        text-decoration: none;
        font-size: 11px;
        font-weight: 600;
    }

    .training-meeting-button:hover {
        background: #1d4ed8;
    }


    /* =========================================================
       LISTS
    ========================================================= */

    .training-list-items {
        display: flex;
        flex-direction: column;
        gap: 9px;
    }

    .training-list-item {
        display: flex;
        align-items: flex-start;
        gap: 9px;
        color: #475569;
        font-size: 13px;
        line-height: 1.6;
    }

    .training-list-icon {
        width: 20px;
        height: 20px;
        flex: 0 0 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #eff6ff;
        color: #2563eb;
        margin-top: 1px;
    }

    .training-list-icon svg {
        width: 11px;
        height: 11px;
    }


    /* =========================================================
       CURRICULUM
    ========================================================= */

    .training-curriculum {
        overflow: hidden;
        border: 1px solid #e2e8f0;
        border-radius: 11px;
    }

    .training-module {
        border-bottom: 1px solid #e2e8f0;
    }

    .training-module:last-child {
        border-bottom: 0;
    }

    .training-module-summary {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 12px 13px;
        color: #1e293b;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        list-style: none;
    }

    .training-module-summary::-webkit-details-marker {
        display: none;
    }

    .training-module-summary:hover {
        background: #f8fbff;
    }

    .training-module-title {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .training-module-number {
        width: 27px;
        height: 27px;
        flex: 0 0 27px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        background: #eff6ff;
        color: #2563eb;
        font-size: 10px;
        font-weight: 700;
    }

    .training-module-arrow {
        width: 15px;
        height: 15px;
        color: #94a3b8;
        transition: .2s;
    }

    .training-module[open] .training-module-arrow {
        transform: rotate(45deg);
    }

    .training-sessions {
        padding: 0 13px 10px;
        background: #f8fafc;
    }

    .training-session {
        padding: 11px 0;
        border-top: 1px solid #e2e8f0;
    }

    .training-session:first-child {
        border-top: 0;
    }

    .training-session-title {
        margin: 0;
        color: #334155;
        font-size: 12px;
        font-weight: 600;
    }

    .training-session-description {
        margin: 4px 0 7px;
        color: #64748b;
        font-size: 11px;
        line-height: 1.6;
    }

    .training-session-links {
        display: flex;
        gap: 15px;
    }

    .training-session-link {
        color: #2563eb;
        font-size: 11px;
        font-weight: 600;
        text-decoration: none;
    }

    .training-session-link:hover {
        text-decoration: underline;
    }


    /* =========================================================
       RESOURCES
    ========================================================= */

    .training-resources {
        overflow: hidden;
        border: 1px solid #e2e8f0;
        border-radius: 11px;
    }

    .training-resource {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 11px 13px;
        border-bottom: 1px solid #e2e8f0;
    }

    .training-resource:last-child {
        border-bottom: 0;
    }

    .training-resource:hover {
        background: #f8fbff;
    }

    .training-resource-title {
        color: #475569;
        font-size: 12px;
    }

    .training-resource-download {
        color: #2563eb;
        font-size: 11px;
        font-weight: 600;
        text-decoration: none;
    }


    /* =========================================================
       CERTIFICATE
    ========================================================= */

    .training-certificate {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 13px;
        background: #eff6ff;
        border: 1px solid #dbeafe;
        border-radius: 11px;
        color: #1d4ed8;
        font-size: 12px;
        font-weight: 500;
    }

    .training-certificate-icon {
        width: 27px;
        height: 27px;
        flex: 0 0 27px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #dbeafe;
    }

    .training-certificate-icon svg {
        width: 14px;
        height: 14px;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 650px) {

        .training-standalone {
            padding: 25px 15px;
        }

        .training-details-header {
            padding: 18px 45px 16px 17px;
        }

        .training-details-body {
            padding: 17px;
        }

        .training-details-title {
            font-size: 19px;
        }

        .training-details-image {
            height: 190px;
        }

        .training-info-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .training-schedule-grid {
            grid-template-columns: 1fr;
        }

    }

</style>
@endpush


<div class="training-standalone">


    {{-- BACK --}}

    <a
        href="{{ route('employee.trainings.index') }}"
        class="training-back-link">

        <svg
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            viewBox="0 0 24 24"
            stroke-linecap="round"
            stroke-linejoin="round">

            <path d="M19 12H5M12 19l-7-7 7-7"/>

        </svg>

        Back to trainings

    </a>


    {{-- =========================================================
         TRAINING DETAILS
    ========================================================== --}}

    <div
        id="training-details"
        class="training-details">


        {{-- HEADER --}}

        <div class="training-details-header">

            <div class="training-details-header-row">


                {{-- Icon --}}

                <div class="training-details-icon">

                    <svg
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        viewBox="0 0 24 24">

                        <path
                            d="M12 3 2.5 8 12 13l9.5-5L12 3Z"
                            stroke-linejoin="round"/>

                        <path
                            d="M6 10.5V15c0 2.2 2.7 4 6 4s6-1.8 6-4v-4.5"
                            stroke-linecap="round"/>

                        <path
                            d="M21.5 8v6"
                            stroke-linecap="round"/>

                    </svg>

                </div>


                {{-- Heading --}}

                <div class="training-details-heading">


                    <div class="training-details-category-row">

                        @if($training->category)

                            <span class="training-details-category">

                                {{ $training->category }}

                            </span>

                        @endif


                        @if($training->level)

                            <span class="training-details-level">

                                {{ ucfirst($training->level) }}

                            </span>

                        @endif

                    </div>


                    <h1 class="training-details-title">

                        {{ $training->title }}

                    </h1>


                    @if($training->short_description)

                        <p class="training-details-short-description">

                            {{ $training->short_description }}

                        </p>

                    @endif

                </div>

            </div>

        </div>


        {{-- BODY --}}

        <div class="training-details-body">


            {{-- IMAGE --}}

            <img
                src="{{ $training->thumbnail
                    ? asset('storage/'.$training->thumbnail)
                    : asset('assets/img/training-placeholder.png') }}"
                alt="{{ $training->title }}"
                onerror="this.src='https://via.placeholder.com/700x260?text=Training'"
                class="training-details-image">


            {{-- INFO GRID --}}

            <div class="training-info-grid">


                <div class="training-info-card">

                    <span class="training-info-label">
                        Technology
                    </span>

                    <span class="training-info-value">
                        {{ $training->technology ?: '—' }}
                    </span>

                </div>


                <div class="training-info-card">

                    <span class="training-info-label">
                        Training Type
                    </span>

                    <span class="training-info-value">
                        {{ ucfirst($training->training_type) }}
                    </span>

                </div>


                <div class="training-info-card">

                    <span class="training-info-label">
                        Duration
                    </span>

                    <span class="training-info-value">
                        {{ $training->duration ?: '—' }}
                    </span>

                </div>


                <div class="training-info-card">

                    <span class="training-info-label">
                        Sessions
                    </span>

                    <span class="training-info-value">
                        {{ $training->total_sessions ?: '—' }}
                    </span>

                </div>


                <div class="training-info-card">

                    <span class="training-info-label">
                        Language
                    </span>

                    <span class="training-info-value">
                        {{ $training->language ?: '—' }}
                    </span>

                </div>


                <div class="training-info-card">

                    <span class="training-info-label">
                        Seats
                    </span>

                    <span class="training-info-value">
                        {{ $training->max_participants ?? 'Unlimited' }}
                    </span>

                </div>

            </div>


            {{-- ABOUT --}}

            @if($training->full_description)

                <div class="training-detail-section">

                    <h2 class="training-detail-section-title">
                        About This Training
                    </h2>

                    <p class="training-detail-description">
                        {{ $training->full_description }}
                    </p>

                </div>

            @endif


            {{-- LIVE / HYBRID --}}

            @if (in_array($training->training_type, ['live', 'hybrid']))

                <div class="training-schedule-box">


                    <div class="training-schedule-header">

                        <span class="training-schedule-icon">

                            <svg
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24">

                                <path
                                    d="M15 10l4.5-2.5v9L15 14"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"/>

                                <rect
                                    x="3"
                                    y="6"
                                    width="12"
                                    height="12"
                                    rx="2"/>

                            </svg>

                        </span>


                        <h2 class="training-schedule-title">
                            Training Schedule
                        </h2>

                    </div>


                    <div class="training-schedule-grid">


                        <div>

                            <span class="training-schedule-label">
                                Platform
                            </span>

                            <span class="training-schedule-value">
                                {{ $training->platform ?? '—' }}
                            </span>

                        </div>


                        <div>

                            <span class="training-schedule-label">
                                Schedule
                            </span>

                            <span class="training-schedule-value">
                                {{ $training->schedule ?? '—' }}
                            </span>

                        </div>

                    </div>


                    @if ($training->meeting_link)

                        <a
                            href="{{ $training->meeting_link }}"
                            target="_blank"
                            class="training-meeting-button">

                            Join Meeting

                        </a>

                    @endif

                </div>

            @endif


            {{-- WHAT YOU'LL LEARN --}}

            @if ($training->outcomes->count())

                <div class="training-detail-section">

                    <h2 class="training-detail-section-title">
                        What You'll Learn
                    </h2>


                    <div class="training-list-items">

                        @foreach ($training->outcomes as $o)

                            <div class="training-list-item">

                                <span class="training-list-icon">

                                    <svg
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2.5"
                                        viewBox="0 0 24 24">

                                        <path
                                            d="M20 6 9 17l-5-5"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"/>

                                    </svg>

                                </span>


                                <span>
                                    {{ $o->outcome }}
                                </span>

                            </div>

                        @endforeach

                    </div>

                </div>

            @endif


            {{-- REQUIREMENTS --}}

            @if ($training->requirements->count())

                <div class="training-detail-section">

                    <h2 class="training-detail-section-title">
                        Requirements
                    </h2>


                    <div class="training-list-items">

                        @foreach ($training->requirements as $r)

                            <div class="training-list-item">

                                <span class="training-list-icon">

                                    <svg
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2.5"
                                        viewBox="0 0 24 24">

                                        <path
                                            d="M20 6 9 17l-5-5"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"/>

                                    </svg>

                                </span>


                                <span>
                                    {{ $r->requirement }}
                                </span>

                            </div>

                        @endforeach

                    </div>

                </div>

            @endif


            {{-- CURRICULUM --}}

            @if ($training->modules->count())

                <div class="training-detail-section">

                    <h2 class="training-detail-section-title">
                        Curriculum
                    </h2>


                    <div class="training-curriculum">

                        @foreach ($training->modules as $mi => $module)

                            <details class="training-module">

                                <summary class="training-module-summary">


                                    <span class="training-module-title">

                                        <span class="training-module-number">

                                            {{ $mi + 1 }}

                                        </span>


                                        <span>
                                            {{ $module->title }}
                                        </span>

                                    </span>


                                    <svg
                                        class="training-module-arrow"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        viewBox="0 0 24 24">

                                        <path d="M12 5v14M5 12h14"/>

                                    </svg>

                                </summary>


                                <div class="training-sessions">


                                    @foreach ($module->sessions as $session)

                                        <div class="training-session">


                                            <h3 class="training-session-title">

                                                {{ $session->title }}

                                            </h3>


                                            @if($session->description)

                                                <p class="training-session-description">

                                                    {{ $session->description }}

                                                </p>

                                            @endif


                                            <div class="training-session-links">

                                                @if ($session->video_path)

                                                    <a
                                                        href="{{ asset('storage/'.$session->video_path) }}"
                                                        target="_blank"
                                                        class="training-session-link">

                                                        Watch Video

                                                    </a>

                                                @endif


                                                @if ($session->pdf_path)

                                                    <a
                                                        href="{{ asset('storage/'.$session->pdf_path) }}"
                                                        target="_blank"
                                                        class="training-session-link">

                                                        Session PDF

                                                    </a>

                                                @endif

                                            </div>

                                        </div>

                                    @endforeach

                                </div>

                            </details>

                        @endforeach

                    </div>

                </div>

            @endif


            {{-- RESOURCES --}}

            @if ($training->resources->count())

                <div class="training-detail-section">

                    <h2 class="training-detail-section-title">
                        Resources
                    </h2>


                    <div class="training-resources">

                        @foreach ($training->resources as $resource)

                            <div class="training-resource">

                                <span class="training-resource-title">

                                    {{ $resource->title }}

                                </span>


                                <a
                                    href="{{ asset('storage/'.$resource->file_path) }}"
                                    target="_blank"
                                    class="training-resource-download">

                                    Download

                                </a>

                            </div>

                        @endforeach

                    </div>

                </div>

            @endif


            {{-- CERTIFICATE --}}

            @if ($training->certificate_enabled)

                <div class="training-certificate">

                    <span class="training-certificate-icon">

                        <svg
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24">

                            <path
                                d="M20 6 9 17l-5-5"
                                stroke-linecap="round"
                                stroke-linejoin="round"/>

                        </svg>

                    </span>


                    <span>

                        A certificate is issued on completing
                        this training.

                    </span>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection
@extends('layouts.app')

@section('title', 'My Internship Applications')

@section('content')

<style>

    :root {
        --app-blue: #3376F2;
        --app-blue-dark: #245ED1;
        --app-purple: #7C4DFF;
        --app-bg: #F6F8FC;
        --app-text: #172033;
        --app-muted: #64748B;
        --app-border: #E6EAF0;
    }

    .student-applications-page {
        background: var(--app-bg);
        min-height: calc(100vh - 80px);
        padding: 35px 0 60px;
    }

    .applications-container {
        width: min(1100px, calc(100% - 30px));
        margin: 0 auto;
    }

    .applications-header {
        background: #fff;
        border: 1px solid var(--app-border);
        border-radius: 20px;
        padding: 28px;
        margin-bottom: 22px;
    }

    .applications-header h1 {
        margin: 0;
        color: var(--app-text);
        font-size: 26px;
        font-weight: 750;
    }

    .applications-header p {
        margin: 7px 0 0;
        color: var(--app-muted);
        font-size: 13px;
    }

    .application-card {
        background: #fff;
        border: 1px solid var(--app-border);
        border-radius: 17px;
        padding: 20px;
        margin-bottom: 14px;
        transition: .2s ease;
    }

    .application-card:hover {
        border-color: #C8D7F2;
        box-shadow: 0 10px 28px rgba(31,41,55,.07);
    }

    .application-card-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 15px;
    }

    .application-title {
        margin: 0;
        font-size: 17px;
        font-weight: 700;
        color: var(--app-text);
    }

    .application-company {
        margin-top: 5px;
        color: var(--app-muted);
        font-size: 12px;
    }

    .application-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 11px;
        border-radius: 999px;
        font-size: 10px;
        font-weight: 700;
        white-space: nowrap;
    }

    .status-applied {
        background: #EEF4FF;
        color: var(--app-blue);
    }

    .status-selected {
        background: #ECFDF5;
        color: #047857;
    }

    .status-rejected {
        background: #FEF2F2;
        color: #B91C1C;
    }

    .status-completed {
        background: #F3EEFF;
        color: var(--app-purple);
    }

    .application-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 15px;
    }

    .application-meta-item {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #F7F9FC;
        border: 1px solid #E8ECF2;
        border-radius: 999px;
        padding: 6px 10px;
        color: #64748B;
        font-size: 10px;
        font-weight: 600;
    }

    .application-actions {
        border-top: 1px solid #F0F2F6;
        margin-top: 16px;
        padding-top: 14px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        flex-wrap: wrap;
    }

    .application-date {
        color: #94A3B8;
        font-size: 11px;
    }

    .application-buttons {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .application-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        min-height: 36px;
        padding: 0 14px;
        border-radius: 9px;
        text-decoration: none;
        font-size: 11px;
        font-weight: 650;
        border: 0;
        transition: .2s ease;
    }

    .application-btn-primary {
        background: var(--app-blue);
        color: #fff;
    }

    .application-btn-primary:hover {
        background: var(--app-blue-dark);
        color: #fff;
    }

    .application-btn-purple {
        background: var(--app-purple);
        color: #fff;
    }

    .application-btn-purple:hover {
        background: #6639E8;
        color: #fff;
    }

    .application-btn-light {
        background: #fff;
        border: 1px solid #DDE3EC;
        color: #64748B;
    }

    .application-btn-light:hover {
        background: #F7F9FC;
        color: var(--app-text);
    }

    .applications-empty {
        background: #fff;
        border: 1px dashed #D8DEE8;
        border-radius: 20px;
        padding: 60px 20px;
        text-align: center;
    }

    .applications-empty-icon {
        width: 70px;
        height: 70px;
        margin: 0 auto 16px;
        border-radius: 20px;
        background: #EEF4FF;
        color: var(--app-blue);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
    }

    .applications-empty h3 {
        margin: 0 0 7px;
        color: var(--app-text);
        font-size: 18px;
        font-weight: 700;
    }

    .applications-empty p {
        margin: 0 0 18px;
        color: var(--app-muted);
        font-size: 13px;
    }

    .applications-empty a {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: var(--app-blue);
        color: #fff;
        text-decoration: none;
        padding: 10px 17px;
        border-radius: 9px;
        font-size: 12px;
        font-weight: 650;
    }

    @media (max-width: 650px) {

        .application-card-top {
            flex-direction: column;
        }

        .application-actions {
            align-items: stretch;
            flex-direction: column;
        }

        .application-buttons {
            width: 100%;
        }

        .application-btn {
            flex: 1;
        }

    }

</style>


<div class="student-applications-page">

    <div class="applications-container">

        {{-- HEADER --}}

        <div class="applications-header">

            <h1>
                My Internship Applications
            </h1>

            <p>
                Track your internship applications, selection status,
                learning progress and certificates.
            </p>

        </div>


        {{-- FLASH --}}

        @if(session('success'))

            <div class="alert alert-success mb-3">
                {{ session('success') }}
            </div>

        @endif


        @if(session('error'))

            <div class="alert alert-danger mb-3">
                {{ session('error') }}
            </div>

        @endif


        {{-- APPLICATIONS --}}

        @forelse($applications as $application)

            @php

                $internship = $application->internship;

                $status = $application->status;

                $statusClass = match($status) {

                    \App\Models\InternshipApplication::STATUS_SELECTED
                        => 'status-selected',

                    \App\Models\InternshipApplication::STATUS_REJECTED
                        => 'status-rejected',

                    \App\Models\InternshipApplication::STATUS_COMPLETED
                        => 'status-completed',

                    default
                        => 'status-applied',

                };

                $statusIcon = match($status) {

                    \App\Models\InternshipApplication::STATUS_SELECTED
                        => 'bi-person-check-fill',

                    \App\Models\InternshipApplication::STATUS_REJECTED
                        => 'bi-x-circle-fill',

                    \App\Models\InternshipApplication::STATUS_COMPLETED
                        => 'bi-patch-check-fill',

                    default
                        => 'bi-check-circle-fill',

                };

                $companyName =
                    $internship?->employer?->company_name
                    ?? $internship?->employer?->name
                    ?? 'Company';

            @endphp


            <div class="application-card">

                <div class="application-card-top">

                    <div>

                        <h2 class="application-title">
                            {{ $internship?->title ?? 'Internship' }}
                        </h2>

                        <div class="application-company">

                            <i class="bi bi-building"></i>

                            {{ $companyName }}

                        </div>

                    </div>


                    <span class="application-status {{ $statusClass }}">

                        <i class="bi {{ $statusIcon }}"></i>

                        {{ ucfirst(str_replace('_', ' ', $status)) }}

                    </span>

                </div>


                {{-- META --}}

                <div class="application-meta">

                    @if($internship?->internship_type)

                        <span class="application-meta-item">

                            <i class="bi bi-briefcase"></i>

                            {{ ucfirst(str_replace(
                                '-',
                                ' ',
                                $internship->internship_type
                            )) }}

                        </span>

                    @endif


                    @if($internship?->duration)

                        <span class="application-meta-item">

                            <i class="bi bi-calendar3"></i>

                            {{ $internship->duration }}

                        </span>

                    @endif


                    @if($internship?->city)

                        <span class="application-meta-item">

                            <i class="bi bi-geo-alt"></i>

                            {{ $internship->city }}

                        </span>

                    @endif

                </div>


                {{-- ACTIONS --}}

                <div class="application-actions">

                    <span class="application-date">

                        Applied
                        {{ $application->created_at?->diffForHumans() }}

                    </span>


                    <div class="application-buttons">


                        {{-- VIEW INTERNSHIP --}}

                        @if($internship)

                            <a
                                href="{{ route(
                                    'student.internships.show',
                                    ['internship' => $internship->id]
                                ) }}"
                                class="application-btn application-btn-light"
                            >

                                <i class="bi bi-eye"></i>

                                View Internship

                            </a>

                        @endif


                        {{-- SELECTED --}}

                        @if(
                            $status ===
                            \App\Models\InternshipApplication::STATUS_SELECTED
                        )

                            <a
                                href="{{ route(
                                    'student.internships.modules.index',
                                    ['internship' => $internship->id]
                                ) }}"
                                class="application-btn application-btn-purple"
                            >

                                <i class="bi bi-journal-text"></i>

                                Learning Modules

                            </a>

                        @endif


                        {{-- COMPLETED CERTIFICATE --}}

                        @if(
                            $status ===
                            \App\Models\InternshipApplication::STATUS_COMPLETED
                            && $application->certificate
                        )

                            <a
                                href="{{ route(
                                    'student.internships.certificates.show',
                                    $application
                                ) }}"
                                class="application-btn application-btn-primary"
                            >

                                <i class="bi bi-patch-check-fill"></i>

                                View Certificate

                            </a>

                        @endif

                    </div>

                </div>

            </div>

        @empty

            <div class="applications-empty">

                <div class="applications-empty-icon">

                    <i class="bi bi-file-earmark-text"></i>

                </div>


                <h3>
                    No Applications Yet
                </h3>


                <p>
                    You haven't applied for any internships yet.
                </p>


                <a
                    href="{{ route('student.internships.index') }}"
                >

                    <i class="bi bi-search"></i>

                    Browse Internships

                </a>

            </div>

        @endforelse


        {{-- PAGINATION --}}

        @if(method_exists($applications, 'links'))

            <div class="mt-4">

                {{ $applications->links() }}

            </div>

        @endif

    </div>

</div>

@endsection
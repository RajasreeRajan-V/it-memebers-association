@extends('layouts.app')

@section('title', 'Jobs In Progress')

@section('content')

<style>
    .ip-page {
        min-height:calc(100vh - 80px);
        background:#f7f9fd;
        padding:38px 0 60px;
        font-family:"Inter","Segoe UI",Arial,sans-serif;
    }

    .ip-container {
        width:min(1180px,calc(100% - 32px));
        margin:auto;
    }

    .ip-header {
        background:linear-gradient(135deg,#fff,#eefaf6);
        border:1px solid #dff2eb;
        border-radius:20px;
        padding:30px;
        margin-bottom:24px;
        box-shadow:0 8px 30px rgba(35,61,105,.06);
    }

    .ip-header-row {
        display:flex;
        justify-content:space-between;
        align-items:center;
        gap:20px;
    }

    .ip-title {
        margin:0;
        color:#17213a;
        font-size:30px;
        font-weight:750;
    }

    .ip-subtitle {
        margin:7px 0 0;
        color:#7b879a;
        font-size:14px;
    }

    .ip-count {
        background:#eaf9f2;
        color:#159866;
        padding:12px 20px;
        border-radius:14px;
        font-size:22px;
        font-weight:750;
    }

    .ip-list {
        display:grid;
        gap:16px;
    }

    .ip-card {
        background:#fff;
        border:1px solid #e5eaf2;
        border-radius:18px;
        padding:22px;
        box-shadow:0 5px 20px rgba(35,61,105,.045);
    }

    .ip-top {
        display:flex;
        justify-content:space-between;
        gap:20px;
    }

    .ip-job {
        margin:0 0 7px;
        color:#17213a;
        font-size:20px;
        font-weight:700;
    }

    .ip-company {
        color:#159866;
        font-size:14px;
        font-weight:650;
        margin-bottom:12px;
    }

    .ip-description {
        margin:0;
        color:#68758b;
        font-size:14px;
        line-height:1.6;
    }

    .ip-badge {
        height:max-content;
        background:#eaf9f2;
        color:#159866;
        padding:8px 13px;
        border-radius:9px;
        font-size:12px;
        font-weight:700;
        white-space:nowrap;
    }

    .ip-meta {
        display:flex;
        flex-wrap:wrap;
        gap:8px;
        margin-top:16px;
    }

    .ip-meta span {
        background:#f8fbfa;
        border:1px solid #e9f3ef;
        color:#69758b;
        padding:7px 10px;
        border-radius:8px;
        font-size:12px;
    }

    .ip-meta i {
        color:#159866;
        margin-right:5px;
    }

    .ip-btn {
        display:inline-flex;
        align-items:center;
        gap:7px;
        margin-top:17px;
        padding:9px 14px;
        border-radius:9px;
        background:#159866;
        color:#fff;
        text-decoration:none;
        font-size:13px;
        font-weight:650;
    }

    .ip-btn:hover {
        background:#0d7d52;
        color:#fff;
    }

    .ip-empty {
        background:#fff;
        border:1px solid #e5eaf2;
        border-radius:20px;
        padding:70px 25px;
        text-align:center;
    }

    .ip-empty-icon {
        width:70px;
        height:70px;
        margin:0 auto 18px;
        border-radius:20px;
        background:#eaf9f2;
        color:#159866;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:28px;
    }

    .ip-empty h3 {
        margin:0 0 7px;
        color:#17213a;
        font-size:20px;
    }

    .ip-empty p {
        margin:0;
        color:#8a95a8;
        font-size:14px;
    }

    @media(max-width:700px) {
        .ip-header-row,
        .ip-top {
            flex-direction:column;
            align-items:flex-start;
        }
    }
</style>

<div class="ip-page">
    <div class="ip-container">

        <div class="ip-header">
            <div class="ip-header-row">

                <div>
                    <h1 class="ip-title">Applications In Progress</h1>

                    <p class="ip-subtitle">
                        Keep track of applications that are currently being processed.
                    </p>
                </div>

                <div class="ip-count">
                    {{ $jobs->total() }}
                </div>

            </div>
        </div>

        @if($jobs->count())

            <div class="ip-list">

                @foreach($jobs as $job)

                    <article class="ip-card">

                        <div class="ip-top">

                            <div style="flex:1;min-width:0;">

                                <h2 class="ip-job">
                                    {{ $job->job_title ?? 'Untitled Job' }}
                                </h2>

                                <div class="ip-company">
                                    <i class="fas fa-building"></i>
                                    {{ optional($job->employer)->company_name ?? 'Company' }}
                                </div>

                                <p class="ip-description">
                                    {{ $job->job_description ?? 'No job description available.' }}
                                </p>

                                <div class="ip-meta">

                                    @if($job->location)
                                        <span>
                                            <i class="fas fa-location-dot"></i>
                                            {{ $job->location }}
                                        </span>
                                    @endif

                                    @if($job->job_type)
                                        <span>
                                            <i class="fas fa-briefcase"></i>
                                            {{ ucwords(str_replace('_',' ',$job->job_type)) }}
                                        </span>
                                    @endif

                                    @if($job->experience_level)
                                        <span>
                                            <i class="fas fa-layer-group"></i>
                                            {{ ucwords(str_replace('_',' ',$job->experience_level)) }}
                                        </span>
                                    @endif

                                </div>

                                <a href="{{ route('student.jobs.show', $job) }}"
                                   class="ip-btn">
                                    View Application
                                    <i class="fas fa-arrow-right"></i>
                                </a>

                            </div>

                            <div class="ip-badge">
                                <i class="fas fa-spinner"></i>
                                In Progress
                            </div>

                        </div>

                    </article>

                @endforeach

            </div>

            <div style="margin-top:24px;">
                {{ $jobs->withQueryString()->links() }}
            </div>

        @else

            <div class="ip-empty">

                <div class="ip-empty-icon">
                    <i class="fas fa-clock"></i>
                </div>

                <h3>No Applications In Progress</h3>

                <p>
                    You currently don't have any applications being processed.
                </p>

            </div>

        @endif

    </div>
</div>

@endsection
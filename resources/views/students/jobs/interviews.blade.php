@extends('layouts.app')

@section('title', 'Interview Jobs')

@section('content')

<style>
    .iv-page {
        min-height:calc(100vh - 80px);
        background:#f7f9fd;
        padding:38px 0 60px;
        font-family:"Inter","Segoe UI",Arial,sans-serif;
    }

    .iv-container {
        width:min(1180px,calc(100% - 32px));
        margin:auto;
    }

    .iv-header {
        background:linear-gradient(135deg,#fff,#f4f0ff);
        border:1px solid #e7e1fa;
        border-radius:20px;
        padding:30px;
        margin-bottom:24px;
        box-shadow:0 8px 30px rgba(35,61,105,.06);
    }

    .iv-header-row {
        display:flex;
        justify-content:space-between;
        align-items:center;
    }

    .iv-title {
        margin:0;
        color:#17213a;
        font-size:30px;
        font-weight:750;
    }

    .iv-subtitle {
        margin:7px 0 0;
        color:#7b879a;
        font-size:14px;
    }

    .iv-count {
        background:#f3efff;
        color:#7257e8;
        border-radius:14px;
        padding:12px 20px;
        font-size:22px;
        font-weight:750;
    }

    .iv-list {
        display:grid;
        gap:16px;
    }

    .iv-card {
        background:#fff;
        border:1px solid #e5eaf2;
        border-radius:18px;
        padding:22px;
        box-shadow:0 5px 20px rgba(35,61,105,.045);
    }

    .iv-card:hover {
        border-color:#ddd4fa;
        box-shadow:0 12px 30px rgba(90,70,160,.08);
    }

    .iv-top {
        display:flex;
        justify-content:space-between;
        gap:20px;
    }

    .iv-job {
        margin:0 0 7px;
        color:#17213a;
        font-size:20px;
        font-weight:700;
    }

    .iv-company {
        color:#7257e8;
        font-size:14px;
        font-weight:650;
        margin-bottom:12px;
    }

    .iv-description {
        margin:0;
        color:#68758b;
        font-size:14px;
        line-height:1.6;
    }

    .iv-badge {
        height:max-content;
        background:#f3efff;
        color:#7257e8;
        padding:8px 13px;
        border-radius:9px;
        font-size:12px;
        font-weight:700;
        white-space:nowrap;
    }

    .iv-meta {
        display:flex;
        flex-wrap:wrap;
        gap:8px;
        margin-top:16px;
    }

    .iv-meta span {
        background:#f8f7ff;
        border:1px solid #ece8fa;
        color:#69758b;
        padding:7px 10px;
        border-radius:8px;
        font-size:12px;
    }

    .iv-meta i {
        color:#7257e8;
        margin-right:5px;
    }

    .iv-btn {
        display:inline-flex;
        align-items:center;
        gap:7px;
        margin-top:17px;
        padding:9px 14px;
        border-radius:9px;
        background:#7257e8;
        color:#fff;
        text-decoration:none;
        font-size:13px;
        font-weight:650;
    }

    .iv-btn:hover {
        background:#5e46ce;
        color:#fff;
    }

    .iv-empty {
        background:#fff;
        border:1px solid #e5eaf2;
        border-radius:20px;
        padding:70px 25px;
        text-align:center;
    }

    .iv-empty-icon {
        width:70px;
        height:70px;
        margin:0 auto 18px;
        border-radius:20px;
        background:#f3efff;
        color:#7257e8;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:28px;
    }

    .iv-empty h3 {
        margin:0 0 7px;
        color:#17213a;
        font-size:20px;
    }

    .iv-empty p {
        margin:0;
        color:#8a95a8;
        font-size:14px;
    }

    @media(max-width:700px) {
        .iv-header-row,
        .iv-top {
            flex-direction:column;
            align-items:flex-start;
        }
    }
</style>

<div class="iv-page">
    <div class="iv-container">

        <div class="iv-header">
            <div class="iv-header-row">
                <div>
                    <h1 class="iv-title">Interview Stage</h1>
                    <p class="iv-subtitle">
                        Jobs where your application has moved to the interview stage.
                    </p>
                </div>

                <div class="iv-count">
                    {{ $jobs->total() }}
                </div>
            </div>
        </div>

        @if($jobs->count())

            <div class="iv-list">

                @foreach($jobs as $job)

                    <article class="iv-card">

                        <div class="iv-top">

                            <div style="flex:1;min-width:0;">

                                <h2 class="iv-job">
                                    {{ $job->job_title ?? 'Untitled Job' }}
                                </h2>

                                <div class="iv-company">
                                    <i class="fas fa-building"></i>
                                    {{ optional($job->employer)->company_name ?? 'Company' }}
                                </div>

                                <p class="iv-description">
                                    {{ $job->job_description ?? 'No job description available.' }}
                                </p>

                                <div class="iv-meta">

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
                                   class="iv-btn">
                                    View Interview Job
                                    <i class="fas fa-arrow-right"></i>
                                </a>

                            </div>

                            <div class="iv-badge">
                                <i class="fas fa-video"></i>
                                Interview
                            </div>

                        </div>

                    </article>

                @endforeach

            </div>

            <div style="margin-top:24px;">
                {{ $jobs->withQueryString()->links() }}
            </div>

        @else

            <div class="iv-empty">

                <div class="iv-empty-icon">
                    <i class="fas fa-video"></i>
                </div>

                <h3>No Interviews Yet</h3>

                <p>
                    No applications have reached the interview stage yet.
                </p>

            </div>

        @endif

    </div>
</div>

@endsection
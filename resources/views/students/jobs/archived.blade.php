@extends('layouts.app')

@section('title', 'Archived Jobs')

@section('content')

<style>
    .ar-page {
        min-height:calc(100vh - 80px);
        background:#f7f9fd;
        padding:38px 0 60px;
        font-family:"Inter","Segoe UI",Arial,sans-serif;
    }

    .ar-container {
        width:min(1180px,calc(100% - 32px));
        margin:auto;
    }

    .ar-header {
        background:linear-gradient(135deg,#fff,#f5f6f8);
        border:1px solid #e3e6eb;
        border-radius:20px;
        padding:30px;
        margin-bottom:24px;
        box-shadow:0 8px 30px rgba(35,61,105,.06);
    }

    .ar-header-row {
        display:flex;
        justify-content:space-between;
        align-items:center;
        gap:20px;
    }

    .ar-title {
        margin:0;
        color:#17213a;
        font-size:30px;
        font-weight:750;
    }

    .ar-subtitle {
        margin:7px 0 0;
        color:#7b879a;
        font-size:14px;
    }

    .ar-count {
        background:#f0f2f5;
        color:#6d7788;
        padding:12px 20px;
        border-radius:14px;
        font-size:22px;
        font-weight:750;
    }

    .ar-list {
        display:grid;
        gap:16px;
    }

    .ar-card {
        background:#fff;
        border:1px solid #e5e8ed;
        border-radius:18px;
        padding:22px;
        box-shadow:0 5px 20px rgba(35,61,105,.04);
    }

    .ar-top {
        display:flex;
        justify-content:space-between;
        gap:20px;
    }

    .ar-job {
        margin:0 0 7px;
        color:#283249;
        font-size:20px;
        font-weight:700;
    }

    .ar-company {
        color:#69758a;
        font-size:14px;
        font-weight:650;
        margin-bottom:12px;
    }

    .ar-description {
        margin:0;
        color:#7c8798;
        font-size:14px;
        line-height:1.6;
    }

    .ar-badge {
        height:max-content;
        background:#f0f2f5;
        color:#6d7788;
        padding:8px 13px;
        border-radius:9px;
        font-size:12px;
        font-weight:700;
        white-space:nowrap;
    }

    .ar-meta {
        display:flex;
        flex-wrap:wrap;
        gap:8px;
        margin-top:16px;
    }

    .ar-meta span {
        background:#f8f9fb;
        border:1px solid #eceef2;
        color:#737e8f;
        padding:7px 10px;
        border-radius:8px;
        font-size:12px;
    }

    .ar-meta i {
        color:#788397;
        margin-right:5px;
    }

    .ar-btn {
        display:inline-flex;
        align-items:center;
        gap:7px;
        margin-top:17px;
        padding:9px 14px;
        border-radius:9px;
        background:#5d6675;
        color:#fff;
        text-decoration:none;
        font-size:13px;
        font-weight:650;
    }

    .ar-btn:hover {
        background:#464f5d;
        color:#fff;
    }

    .ar-empty {
        background:#fff;
        border:1px solid #e5e8ed;
        border-radius:20px;
        padding:70px 25px;
        text-align:center;
    }

    .ar-empty-icon {
        width:70px;
        height:70px;
        margin:0 auto 18px;
        border-radius:20px;
        background:#f0f2f5;
        color:#6d7788;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:28px;
    }

    .ar-empty h3 {
        margin:0 0 7px;
        color:#283249;
        font-size:20px;
    }

    .ar-empty p {
        margin:0;
        color:#8a95a8;
        font-size:14px;
    }

    @media(max-width:700px) {
        .ar-header-row,
        .ar-top {
            flex-direction:column;
            align-items:flex-start;
        }
    }
</style>

<div class="ar-page">
    <div class="ar-container">

        <div class="ar-header">
            <div class="ar-header-row">

                <div>
                    <h1 class="ar-title">Archived Applications</h1>

                    <p class="ar-subtitle">
                        Review jobs and applications that have been closed or archived.
                    </p>
                </div>

                <div class="ar-count">
                    {{ $jobs->total() }}
                </div>

            </div>
        </div>

        @if($jobs->count())

            <div class="ar-list">

                @foreach($jobs as $job)

                    <article class="ar-card">

                        <div class="ar-top">

                            <div style="flex:1;min-width:0;">

                                <h2 class="ar-job">
                                    {{ $job->job_title ?? 'Untitled Job' }}
                                </h2>

                                <div class="ar-company">
                                    <i class="fas fa-building"></i>
                                    {{ optional($job->employer)->company_name ?? 'Company' }}
                                </div>

                                <p class="ar-description">
                                    {{ $job->job_description ?? 'No job description available.' }}
                                </p>

                                <div class="ar-meta">

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
                                   class="ar-btn">
                                    View Job
                                    <i class="fas fa-arrow-right"></i>
                                </a>

                            </div>

                            <div class="ar-badge">
                                <i class="fas fa-box-archive"></i>
                                Archived
                            </div>

                        </div>

                    </article>

                @endforeach

            </div>

            <div style="margin-top:24px;">
                {{ $jobs->withQueryString()->links() }}
            </div>

        @else

            <div class="ar-empty">

                <div class="ar-empty-icon">
                    <i class="fas fa-box-archive"></i>
                </div>

                <h3>No Archived Applications</h3>

                <p>
                    Archived applications will appear here when an application is closed.
                </p>

            </div>

        @endif

    </div>
</div>

@endsection
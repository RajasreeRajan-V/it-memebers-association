@extends('layouts.app')

@section('title', 'Hired Jobs')

@section('content')

<style>
    .hi-page {
        min-height:calc(100vh - 80px);
        background:#f7f9fd;
        padding:38px 0 60px;
        font-family:"Inter","Segoe UI",Arial,sans-serif;
    }

    .hi-container {
        width:min(1180px,calc(100% - 32px));
        margin:auto;
    }

    .hi-header {
        background:linear-gradient(135deg,#fff,#eefaf5);
        border:1px solid #dcefe7;
        border-radius:20px;
        padding:30px;
        margin-bottom:24px;
        box-shadow:0 8px 30px rgba(35,61,105,.06);
    }

    .hi-header-row {
        display:flex;
        justify-content:space-between;
        align-items:center;
        gap:20px;
    }

    .hi-title {
        margin:0;
        color:#17213a;
        font-size:30px;
        font-weight:750;
    }

    .hi-subtitle {
        margin:7px 0 0;
        color:#7b879a;
        font-size:14px;
    }

    .hi-count {
        background:#eaf9f2;
        color:#159866;
        padding:12px 20px;
        border-radius:14px;
        font-size:22px;
        font-weight:750;
    }

    .hi-list {
        display:grid;
        gap:16px;
    }

    .hi-card {
        background:#fff;
        border:1px solid #e5eaf2;
        border-radius:18px;
        padding:22px;
        box-shadow:0 5px 20px rgba(35,61,105,.045);
    }

    .hi-top {
        display:flex;
        justify-content:space-between;
        gap:20px;
    }

    .hi-job {
        margin:0 0 7px;
        color:#17213a;
        font-size:20px;
        font-weight:700;
    }

    .hi-company {
        color:#159866;
        font-size:14px;
        font-weight:650;
        margin-bottom:12px;
    }

    .hi-description {
        margin:0;
        color:#68758b;
        font-size:14px;
        line-height:1.6;
    }

    .hi-badge {
        height:max-content;
        background:#eaf9f2;
        color:#159866;
        padding:8px 13px;
        border-radius:9px;
        font-size:12px;
        font-weight:700;
        white-space:nowrap;
    }

    .hi-meta {
        display:flex;
        flex-wrap:wrap;
        gap:8px;
        margin-top:16px;
    }

    .hi-meta span {
        background:#f8fbfa;
        border:1px solid #e9f3ef;
        color:#69758b;
        padding:7px 10px;
        border-radius:8px;
        font-size:12px;
    }

    .hi-meta i {
        color:#159866;
        margin-right:5px;
    }

    .hi-btn {
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

    .hi-btn:hover {
        background:#0d7d52;
        color:#fff;
    }

    .hi-empty {
        background:#fff;
        border:1px solid #e5eaf2;
        border-radius:20px;
        padding:70px 25px;
        text-align:center;
    }

    .hi-empty-icon {
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

    .hi-empty h3 {
        margin:0 0 7px;
        color:#17213a;
        font-size:20px;
    }

    .hi-empty p {
        margin:0;
        color:#8a95a8;
        font-size:14px;
    }

    @media(max-width:700px) {
        .hi-header-row,
        .hi-top {
            flex-direction:column;
            align-items:flex-start;
        }
    }
</style>

<div class="hi-page">
    <div class="hi-container">

        <div class="hi-header">
            <div class="hi-header-row">

                <div>
                    <h1 class="hi-title">Hired Jobs</h1>

                    <p class="hi-subtitle">
                        Congratulations! These are the positions where you have been hired.
                    </p>
                </div>

                <div class="hi-count">
                    {{ $jobs->total() }}
                </div>

            </div>
        </div>

        @if($jobs->count())

            <div class="hi-list">

                @foreach($jobs as $job)

                    <article class="hi-card">

                        <div class="hi-top">

                            <div style="flex:1;min-width:0;">

                                <h2 class="hi-job">
                                    {{ $job->job_title ?? 'Untitled Job' }}
                                </h2>

                                <div class="hi-company">
                                    <i class="fas fa-building"></i>
                                    {{ optional($job->employer)->company_name ?? 'Company' }}
                                </div>

                                <p class="hi-description">
                                    {{ $job->job_description ?? 'No job description available.' }}
                                </p>

                                <div class="hi-meta">

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

                                    @if($job->salary_range)
                                        <span>
                                            <i class="fas fa-indian-rupee-sign"></i>
                                            {{ $job->salary_range }}
                                        </span>
                                    @endif

                                </div>

                                <a href="{{ route('student.jobs.show', $job) }}"
                                   class="hi-btn">
                                    View Job
                                    <i class="fas fa-arrow-right"></i>
                                </a>

                            </div>

                            <div class="hi-badge">
                                <i class="fas fa-circle-check"></i>
                                Hired
                            </div>

                        </div>

                    </article>

                @endforeach

            </div>

            <div style="margin-top:24px;">
                {{ $jobs->withQueryString()->links() }}
            </div>

        @else

            <div class="hi-empty">

                <div class="hi-empty-icon">
                    <i class="fas fa-briefcase"></i>
                </div>

                <h3>No Hired Jobs</h3>

                <p>
                    Your hired positions will appear here once an employer selects you.
                </p>

            </div>

        @endif

    </div>
</div>

@endsection
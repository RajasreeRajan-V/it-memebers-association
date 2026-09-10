@extends('layouts.app')

@section('title', 'Applied Jobs')

@section('content')

<style>
    .aj-page {
        min-height: calc(100vh - 80px);
        background: #f7f9fd;
        padding: 38px 0 60px;
        font-family: "Inter","Segoe UI",Arial,sans-serif;
    }

    .aj-container {
        width: min(1180px, calc(100% - 32px));
        margin: auto;
    }

    .aj-header {
        background: linear-gradient(135deg,#fff,#f3f7ff);
        border: 1px solid #e5ebf5;
        border-radius: 20px;
        padding: 28px 30px;
        margin-bottom: 24px;
        box-shadow: 0 8px 30px rgba(35,61,105,.06);
    }

    .aj-header-row {
        display:flex;
        justify-content:space-between;
        align-items:center;
        gap:20px;
    }

    .aj-title {
        margin:0;
        color:#17213a;
        font-size:30px;
        font-weight:750;
    }

    .aj-subtitle {
        margin:7px 0 0;
        color:#7b879a;
        font-size:14px;
    }

    .aj-count {
        background:#eef4ff;
        color:#3376f2;
        padding:12px 20px;
        border-radius:14px;
        font-size:22px;
        font-weight:750;
    }

    .aj-list {
        display:grid;
        gap:16px;
    }

    .aj-card {
        background:#fff;
        border:1px solid #e5eaf2;
        border-radius:18px;
        padding:22px;
        box-shadow:0 5px 20px rgba(35,61,105,.045);
    }

    .aj-top {
        display:flex;
        justify-content:space-between;
        gap:20px;
    }

    .aj-title-job {
        margin:0 0 7px;
        color:#17213a;
        font-size:20px;
        font-weight:700;
    }

    .aj-company {
        color:#3376f2;
        font-size:14px;
        font-weight:650;
        margin-bottom:12px;
    }

    .aj-description {
        color:#68758b;
        font-size:14px;
        line-height:1.6;
        margin:0;
        display:-webkit-box;
        -webkit-line-clamp:2;
        -webkit-box-orient:vertical;
        overflow:hidden;
    }

    .aj-meta {
        display:flex;
        flex-wrap:wrap;
        gap:8px;
        margin-top:16px;
    }

    .aj-meta span {
        padding:7px 10px;
        border-radius:8px;
        background:#f8faff;
        border:1px solid #edf0f5;
        color:#657289;
        font-size:12px;
    }

    .aj-meta i {
        color:#3376f2;
        margin-right:4px;
    }

    .aj-status {
        flex-shrink:0;
        height:max-content;
        padding:8px 12px;
        border-radius:9px;
        font-size:12px;
        font-weight:700;
        background:#eef4ff;
        color:#3376f2;
    }

    .aj-status.interview {
        background:#f3efff;
        color:#7257e8;
    }

    .aj-status.hired {
        background:#ecfdf5;
        color:#07804f;
    }

    .aj-status.rejected,
    .aj-status.archived {
        background:#fff1f2;
        color:#dc3545;
    }

    .aj-view {
        display:inline-flex;
        margin-top:17px;
        align-items:center;
        gap:7px;
        background:#3376f2;
        color:#fff;
        text-decoration:none;
        padding:9px 14px;
        border-radius:9px;
        font-size:13px;
        font-weight:650;
    }

    .aj-view:hover {
        background:#245fd0;
        color:#fff;
    }

    .aj-empty {
        background:#fff;
        border:1px solid #e5eaf2;
        border-radius:20px;
        padding:70px 25px;
        text-align:center;
    }

    .aj-empty-icon {
        width:70px;
        height:70px;
        margin:0 auto 18px;
        display:flex;
        align-items:center;
        justify-content:center;
        background:#eef4ff;
        color:#3376f2;
        border-radius:20px;
        font-size:28px;
    }

    .aj-empty h3 {
        margin:0 0 7px;
        color:#17213a;
        font-size:20px;
    }

    .aj-empty p {
        margin:0;
        color:#8a95a8;
        font-size:14px;
    }

    .aj-pagination {
        margin-top:24px;
    }

    @media(max-width:700px) {
        .aj-header-row,
        .aj-top {
            flex-direction:column;
            align-items:flex-start;
        }
    }
</style>

<div class="aj-page">
    <div class="aj-container">

        <div class="aj-header">
            <div class="aj-header-row">
                <div>
                    <h1 class="aj-title">Applied Jobs</h1>
                    <p class="aj-subtitle">
                        Track every job application you've submitted.
                    </p>
                </div>

                <div class="aj-count">
                    {{ $jobs->total() }}
                </div>
            </div>
        </div>

        @if($jobs->count())

            <div class="aj-list">

                @foreach($jobs as $job)

                    @php
                        $application = null;

                        if (isset($applications)) {
                            if ($applications instanceof \Illuminate\Pagination\AbstractPaginator) {
                                $application = $applications->getCollection()
                                    ->firstWhere('job_post_id', $job->id);
                            } else {
                                $application = collect($applications)
                                    ->firstWhere('job_post_id', $job->id);
                            }
                        }

                        $status = $application->status ?? 'applied';
                        $statusLabel = ucwords(str_replace('_', ' ', $status));
                    @endphp

                    <article class="aj-card">

                        <div class="aj-top">

                            <div style="flex:1;min-width:0;">

                                <h2 class="aj-title-job">
                                    {{ $job->job_title ?? 'Untitled Job' }}
                                </h2>

                                <div class="aj-company">
                                    <i class="fas fa-building"></i>
                                    {{ optional($job->employer)->company_name ?? 'Company' }}
                                </div>

                                <p class="aj-description">
                                    {{ $job->job_description ?? 'No description available.' }}
                                </p>

                                <div class="aj-meta">

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
                                   class="aj-view">
                                    View Job
                                    <i class="fas fa-arrow-right"></i>
                                </a>

                            </div>

                            <div class="aj-status {{ $status }}">
                                {{ $statusLabel }}
                            </div>

                        </div>

                    </article>

                @endforeach

            </div>

            @if(method_exists($jobs,'links'))
                <div class="aj-pagination">
                    {{ $jobs->withQueryString()->links() }}
                </div>
            @endif

        @else

            <div class="aj-empty">
                <div class="aj-empty-icon">
                    <i class="fas fa-paper-plane"></i>
                </div>

                <h3>No Applications Yet</h3>

                <p>
                    You haven't applied for any jobs yet.
                </p>
            </div>

        @endif

    </div>
</div>

@endsection
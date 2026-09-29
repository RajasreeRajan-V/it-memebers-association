@extends('layouts.app')

@section('title', 'Saved Jobs')

@section('content')

<style>
    .sj-page {
        min-height: calc(100vh - 80px);
        background: #f7f9fd;
        padding: 38px 0 60px;
        font-family: "Inter", "Segoe UI", Arial, sans-serif;
    }

    .sj-container {
        width: min(1180px, calc(100% - 32px));
        margin: auto;
    }

    .sj-header {
        background: linear-gradient(135deg, #ffffff 0%, #f3f7ff 100%);
        border: 1px solid #e5ebf5;
        border-radius: 20px;
        padding: 28px 30px;
        margin-bottom: 24px;
        box-shadow: 0 8px 30px rgba(35, 61, 105, .06);
    }

    .sj-header-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
    }

    .sj-title {
        margin: 0;
        color: #17213a;
        font-size: 30px;
        font-weight: 750;
        letter-spacing: -.5px;
    }

    .sj-subtitle {
        margin: 7px 0 0;
        color: #7b879a;
        font-size: 14px;
    }

    .sj-count {
        min-width: 75px;
        padding: 12px 18px;
        border-radius: 14px;
        background: #eef4ff;
        color: #3376f2;
        text-align: center;
        font-size: 22px;
        font-weight: 750;
    }

    .sj-list {
        display: grid;
        gap: 16px;
    }

    .sj-card {
        background: #fff;
        border: 1px solid #e6ebf3;
        border-radius: 18px;
        padding: 22px;
        transition: .2s ease;
        box-shadow: 0 5px 20px rgba(35,61,105,.045);
    }

    .sj-card:hover {
        transform: translateY(-2px);
        border-color: #cfdcff;
        box-shadow: 0 12px 30px rgba(35,61,105,.09);
    }

    .sj-card-top {
        display: flex;
        justify-content: space-between;
        gap: 20px;
    }

    .sj-main {
        min-width: 0;
    }

    .sj-job-title {
        color: #17213a;
        font-size: 20px;
        font-weight: 700;
        margin: 0 0 7px;
    }

    .sj-company {
        color: #3376f2;
        font-size: 14px;
        font-weight: 650;
        margin-bottom: 13px;
    }

    .sj-description {
        color: #68758b;
        font-size: 14px;
        line-height: 1.65;
        margin: 0;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .sj-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 16px;
    }

    .sj-meta span {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 10px;
        border-radius: 8px;
        background: #f7f9fd;
        color: #657289;
        font-size: 12px;
        border: 1px solid #edf0f5;
    }

    .sj-meta i {
        color: #3376f2;
    }

    .sj-action {
        flex-shrink: 0;
    }

    .sj-view-btn {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 10px 15px;
        border-radius: 9px;
        background: #3376f2;
        color: #fff;
        text-decoration: none;
        font-size: 13px;
        font-weight: 650;
        transition: .2s;
    }

    .sj-view-btn:hover {
        background: #245fd0;
        color: #fff;
    }

    .sj-applied {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-top: 9px;
        padding: 6px 9px;
        background: #ecfdf5;
        color: #07804f;
        border-radius: 7px;
        font-size: 11px;
        font-weight: 650;
    }

    .sj-empty {
        text-align: center;
        background: #fff;
        border: 1px solid #e6ebf3;
        border-radius: 20px;
        padding: 70px 25px;
        box-shadow: 0 5px 20px rgba(35,61,105,.04);
    }

    .sj-empty-icon {
        width: 70px;
        height: 70px;
        margin: 0 auto 18px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eef4ff;
        color: #3376f2;
        font-size: 28px;
    }

    .sj-empty h3 {
        margin: 0 0 7px;
        color: #17213a;
        font-size: 20px;
    }

    .sj-empty p {
        margin: 0;
        color: #8a95a8;
        font-size: 14px;
    }

    .sj-pagination {
        margin-top: 24px;
    }

    @media(max-width:700px) {
        .sj-header-top,
        .sj-card-top {
            flex-direction: column;
            align-items: flex-start;
        }

        .sj-count {
            min-width: 60px;
        }

        .sj-action {
            width: 100%;
        }

        .sj-view-btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="sj-page">
    <div class="sj-container">

        <div class="sj-header">
            <div class="sj-header-top">
                <div>
                    <h1 class="sj-title">Saved Jobs</h1>
                    <p class="sj-subtitle">
                        Jobs you saved for later. Review them whenever you're ready to apply.
                    </p>
                </div>

                <div class="sj-count">
                    {{ $jobs->total() }}
                </div>
            </div>
        </div>

        @if($jobs->count())

            <div class="sj-list">

                @foreach($jobs as $job)

                    <article class="sj-card">

                        <div class="sj-card-top">

                            <div class="sj-main">

                                <h2 class="sj-job-title">
                                    {{ $job->job_title ?? 'Untitled Job' }}
                                </h2>

                                <div class="sj-company">
                                    <i class="fas fa-building"></i>
                                    {{ optional($job->employer)->company_name ?? 'Company' }}
                                </div>

                                <p class="sj-description">
                                    {{ $job->job_description ?? 'No job description available.' }}
                                </p>

                                <div class="sj-meta">

                                    @if($job->location)
                                        <span>
                                            <i class="fas fa-location-dot"></i>
                                            {{ $job->location }}
                                        </span>
                                    @endif

                                    @if($job->job_type)
                                        <span>
                                            <i class="fas fa-briefcase"></i>
                                            {{ ucwords(str_replace('_', ' ', $job->job_type)) }}
                                        </span>
                                    @endif

                                    @if($job->experience_level)
                                        <span>
                                            <i class="fas fa-layer-group"></i>
                                            {{ ucwords(str_replace('_', ' ', $job->experience_level)) }}
                                        </span>
                                    @endif

                                    @if($job->salary_range)
                                        <span>
                                            <i class="fas fa-indian-rupee-sign"></i>
                                            {{ $job->salary_range }}
                                        </span>
                                    @endif

                                </div>

                                @if(isset($appliedJobIds) && in_array($job->id, $appliedJobIds))
                                    <div class="sj-applied">
                                        <i class="fas fa-check-circle"></i>
                                        Already Applied
                                    </div>
                                @endif

                            </div>

                            <div class="sj-action">
                                <a href="{{ route('student.jobs.show', $job) }}"
                                   class="sj-view-btn">
                                    View Job
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>

                        </div>

                    </article>

                @endforeach

            </div>

            @if(method_exists($jobs, 'links'))
                <div class="sj-pagination">
                    {{ $jobs->withQueryString()->links() }}
                </div>
            @endif

        @else

            <div class="sj-empty">

                <div class="sj-empty-icon">
                    <i class="far fa-bookmark"></i>
                </div>

                <h3>No Saved Jobs</h3>

                <p>
                    You haven't saved any jobs yet. Save interesting jobs and come back to them later.
                </p>

            </div>

        @endif

    </div>
</div>

@endsection
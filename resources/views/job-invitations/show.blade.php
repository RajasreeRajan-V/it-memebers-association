@extends('layouts.app')

@section('title', 'Job Invitation')

@section('content')

<style>
    .invitation-page {
        min-height: calc(100vh - 100px);
        background: #f7faff;
        padding: 55px 20px;
        font-family: Inter, Poppins, sans-serif;
    }

    .invitation-container {
        width: min(760px, 100%);
        margin: 0 auto;
    }

    .invitation-card {
        background: #fff;
        border: 1px solid #e1e9f4;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 15px 45px rgba(35, 75, 130, .08);
    }

    .invitation-top {
        background: linear-gradient(135deg, #3376f2, #245fd0);
        padding: 35px;
        color: #fff;
    }

    .invitation-top small {
        display: block;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .08em;
        text-transform: uppercase;
        opacity: .85;
        margin-bottom: 8px;
    }

    .invitation-top h1 {
        margin: 0;
        font-size: 28px;
        font-weight: 800;
    }

    .invitation-body {
        padding: 32px;
    }

    .invitation-message {
        color: #68778c;
        font-size: 14px;
        line-height: 1.8;
        margin-bottom: 25px;
    }

    .job-box {
        background: #f7faff;
        border: 1px solid #e1eafa;
        border-radius: 13px;
        padding: 23px;
        margin-bottom: 25px;
    }

    .job-box h2 {
        margin: 0 0 15px;
        color: #1c3454;
        font-size: 22px;
        font-weight: 800;
    }

    .job-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 20px;
    }

    .job-meta span {
        padding: 7px 11px;
        background: #fff;
        border: 1px solid #e2eaf4;
        border-radius: 7px;
        color: #667991;
        font-size: 12px;
        font-weight: 600;
    }

    .job-description {
        color: #718096;
        font-size: 13px;
        line-height: 1.8;
    }

    .apply-area {
        text-align: center;
        padding-top: 8px;
    }

    .apply-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 13px 28px;
        border-radius: 9px;
        background: #3376f2;
        color: #fff;
        text-decoration: none;
        font-size: 14px;
        font-weight: 800;
        transition: .2s ease;
    }

    .apply-btn:hover {
        background: #245fd0;
        color: #fff;
        transform: translateY(-1px);
    }

    .invitation-footer {
        border-top: 1px solid #edf2f7;
        padding: 18px 30px;
        text-align: center;
        color: #94a3b8;
        font-size: 11px;
    }
</style>

<div class="invitation-page">

    <div class="invitation-container">

        <div class="invitation-card">

            <div class="invitation-top">

                <small>SkillConnect Job Invitation</small>

                <h1>
                    You're Invited to Apply
                </h1>

            </div>

            <div class="invitation-body">

                <p class="invitation-message">

                    Hello
                    <strong>
                        {{ $invitation->candidate->name ?? 'Candidate' }}
                    </strong>,

                    <br><br>

                    <strong>
                        {{ $invitation->employer->name ?? 'An employer' }}
                    </strong>
                    has invited you to apply for this job opportunity.

                </p>

                <div class="job-box">

                    <h2>
                        {{ $invitation->job->title }}
                    </h2>

                    <div class="job-meta">

                        @if(!empty($invitation->job->employment_type))
                            <span>
                                {{ $invitation->job->employment_type }}
                            </span>
                        @endif

                        @if(!empty($invitation->job->location))
                            <span>
                                <i class="fas fa-location-dot"></i>
                                {{ $invitation->job->location }}
                            </span>
                        @endif

                        @if(!empty($invitation->job->experience))
                            <span>
                                {{ $invitation->job->experience }}
                            </span>
                        @endif

                    </div>

                    @if(!empty($invitation->job->description))

                        <div class="job-description">

                            {!! nl2br(e(
                                \Illuminate\Support\Str::limit(
                                    strip_tags($invitation->job->description),
                                    1000
                                )
                            )) !!}

                        </div>

                    @endif

                </div>

                <div class="apply-area">

                    {{-- 
                        Change this route only if your employee job-details
                        route has a different name.
                    --}}

                    <a
                        href="{{ route('employee.jobs.show', $invitation->job) }}"
                        class="apply-btn"
                    >
                        <i class="fas fa-paper-plane"></i>
                        View Job & Apply Now
                    </a>

                </div>

            </div>

            <div class="invitation-footer">

                This invitation was sent through SkillConnect

            </div>

        </div>

    </div>

</div>

@endsection
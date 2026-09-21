@extends('layouts.app')

@section('title', $startupProfile->startup_name . ' - Jobs')

@section('content')

<style>
    :root {
        --sp-blue: #3376F2;
        --sp-blue-dark: #245fd0;
        --sp-blue-light: #eef4ff;
        --sp-navy: #172033;
        --sp-muted: #718096;
        --sp-border: #e5eaf2;
        --sp-bg: #f7f9fc;
        --sp-success: #10b981;
    }

    .startup-jobs-page {
        min-height: calc(100vh - 160px);
        background: var(--sp-bg);
        padding: 35px 0 60px;
    }

    .startup-jobs-container {
        max-width: 1250px;
        margin: 0 auto;
        padding: 0 25px;
    }

    /* =========================================================
       HEADER
    ========================================================= */

    .startup-jobs-header {
        background: #fff;
        border: 1px solid var(--sp-border);
        border-radius: 18px;
        padding: 28px 30px;
        margin-bottom: 25px;

        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .startup-jobs-header-left {
        display: flex;
        align-items: center;
        gap: 18px;
    }

    .startup-jobs-icon {
        width: 58px;
        height: 58px;
        border-radius: 14px;
        background: var(--sp-blue-light);
        color: var(--sp-blue);

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 25px;
        flex-shrink: 0;
    }

    .startup-jobs-header h1 {
        margin: 0 0 5px;
        color: var(--sp-navy);
        font-size: 27px;
        font-weight: 700;
    }

    .startup-jobs-header p {
        margin: 0;
        color: var(--sp-muted);
        font-size: 14px;
    }

    .startup-back-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;

        padding: 11px 17px;
        border-radius: 9px;

        background: var(--sp-blue-light);
        color: var(--sp-blue);

        text-decoration: none;
        font-size: 14px;
        font-weight: 600;

        white-space: nowrap;
    }

    .startup-back-btn:hover {
        background: #dfeaff;
        color: var(--sp-blue-dark);
    }

    /* =========================================================
       JOBS CARD
    ========================================================= */

    .startup-jobs-card {
        background: #fff;
        border: 1px solid var(--sp-border);
        border-radius: 18px;
        padding: 25px;
    }

    .startup-jobs-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 20px;
    }

    .startup-jobs-card-header h2 {
        margin: 0;
        color: var(--sp-navy);
        font-size: 20px;
        font-weight: 700;
    }

    .startup-jobs-count {
        background: var(--sp-blue-light);
        color: var(--sp-blue);
        border-radius: 20px;
        padding: 6px 12px;
        font-size: 13px;
        font-weight: 600;
    }

    /* =========================================================
       JOB ITEM
    ========================================================= */

    .startup-job-item {
        border: 1px solid var(--sp-border);
        border-radius: 14px;
        padding: 20px;
        margin-bottom: 15px;
        transition: .2s ease;
    }

    .startup-job-item:last-child {
        margin-bottom: 0;
    }

    .startup-job-item:hover {
        border-color: #bfd3ff;
        box-shadow: 0 5px 18px rgba(51, 118, 242, .07);
    }

    .startup-job-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 20px;
    }

    .startup-job-title {
        margin: 0 0 8px;
        color: var(--sp-navy);
        font-size: 18px;
        font-weight: 700;
    }

    .startup-job-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 14px;
        color: var(--sp-muted);
        font-size: 13px;
    }

    .startup-job-meta span {
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .startup-job-meta i {
        color: var(--sp-blue);
    }

    /* =========================================================
       STATUS
    ========================================================= */

    .startup-job-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;

        padding: 6px 11px;
        border-radius: 20px;

        background: #ecfdf5;
        color: #059669;

        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    .startup-job-status i {
        font-size: 7px;
    }

    .startup-job-status.inactive {
        background: #f1f5f9;
        color: #64748b;
    }

    /* =========================================================
       BOTTOM
    ========================================================= */

    .startup-job-bottom {
        border-top: 1px solid var(--sp-border);

        margin-top: 17px;
        padding-top: 15px;

        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
    }

    .startup-job-description {
        color: var(--sp-muted);
        font-size: 13px;
        line-height: 1.6;
        max-width: 75%;
    }

    .startup-view-job {
        border: none;

        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;

        padding: 9px 15px;

        background: var(--sp-blue);
        color: #fff;

        border-radius: 8px;

        font-size: 13px;
        font-weight: 600;

        white-space: nowrap;
        cursor: pointer;

        transition: .2s ease;
    }

    .startup-view-job:hover {
        background: var(--sp-blue-dark);
    }

    /* =========================================================
       EMPTY
    ========================================================= */

    .startup-jobs-empty {
        text-align: center;
        padding: 65px 20px;
    }

    .startup-jobs-empty-icon {
        width: 70px;
        height: 70px;
        margin: 0 auto 18px;

        border-radius: 50%;

        background: var(--sp-blue-light);
        color: var(--sp-blue);

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 28px;
    }

    .startup-jobs-empty h3 {
        margin: 0 0 8px;
        color: var(--sp-navy);
        font-size: 19px;
    }

    .startup-jobs-empty p {
        margin: 0 0 20px;
        color: var(--sp-muted);
        font-size: 14px;
    }

    .startup-create-job {
        display: inline-flex;
        align-items: center;
        gap: 8px;

        padding: 11px 18px;

        border-radius: 9px;

        background: var(--sp-blue);
        color: #fff;

        text-decoration: none;

        font-size: 14px;
        font-weight: 600;
    }

    .startup-create-job:hover {
        background: var(--sp-blue-dark);
        color: #fff;
    }

    /* =========================================================
       PAGINATION
    ========================================================= */

    .startup-pagination {
        margin-top: 25px;
    }

    /* =========================================================
       JOB POPUP
    ========================================================= */

    .job-popup-overlay {
        position: fixed;
        inset: 0;

        background: rgba(15, 23, 42, .60);

        display: none;
        align-items: center;
        justify-content: center;

        padding: 25px;

        z-index: 9999;

        backdrop-filter: blur(3px);
    }

    .job-popup-overlay.show {
        display: flex;
    }

    .job-popup {
        width: 100%;
        max-width: 850px;

        max-height: 90vh;

        background: #fff;

        border-radius: 20px;

        overflow: hidden;

        box-shadow: 0 25px 70px rgba(15, 23, 42, .25);

        animation: jobPopupIn .2s ease;
    }

    @keyframes jobPopupIn {
        from {
            opacity: 0;
            transform: translateY(15px) scale(.98);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    /* =========================================================
       POPUP HEADER
    ========================================================= */

    .job-popup-header {
        padding: 24px 28px;

        border-bottom: 1px solid var(--sp-border);

        display: flex;
        align-items: flex-start;
        justify-content: space-between;

        gap: 20px;
    }

    .job-popup-header-left {
        display: flex;
        align-items: flex-start;
        gap: 15px;
    }

    .job-popup-icon {
        width: 52px;
        height: 52px;

        flex-shrink: 0;

        border-radius: 13px;

        background: var(--sp-blue-light);
        color: var(--sp-blue);

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 22px;
    }

    .job-popup-title {
        margin: 0 0 6px;

        color: var(--sp-navy);

        font-size: 23px;
        font-weight: 700;
    }

    .job-popup-company {
        margin: 0;

        color: var(--sp-muted);

        font-size: 14px;
    }

    .job-popup-close {
        width: 38px;
        height: 38px;

        flex-shrink: 0;

        border: none;
        border-radius: 9px;

        background: #f1f5f9;
        color: #64748b;

        cursor: pointer;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 18px;

        transition: .2s ease;
    }

    .job-popup-close:hover {
        background: #e2e8f0;
        color: var(--sp-navy);
    }

    /* =========================================================
       POPUP BODY
    ========================================================= */

    .job-popup-body {
        padding: 25px 28px;

        max-height: calc(90vh - 160px);

        overflow-y: auto;
    }

    /* =========================================================
       DETAILS GRID
    ========================================================= */

    .job-popup-details {
        display: grid;

        grid-template-columns: repeat(2, minmax(0, 1fr));

        gap: 12px;

        margin-bottom: 28px;
    }

    .job-popup-detail {
        background: #f8fafc;

        border: 1px solid #edf1f6;

        border-radius: 11px;

        padding: 13px 15px;
    }

    .job-popup-detail-label {
        display: block;

        margin-bottom: 4px;

        color: #94a3b8;

        font-size: 11px;

        font-weight: 600;

        text-transform: uppercase;

        letter-spacing: .4px;
    }

    .job-popup-detail-value {
        color: var(--sp-navy);

        font-size: 14px;

        font-weight: 600;
    }

    /* =========================================================
       POPUP SECTIONS
    ========================================================= */

    .job-popup-section {
        margin-bottom: 25px;
    }

    .job-popup-section:last-child {
        margin-bottom: 0;
    }

    .job-popup-section-title {
        margin: 0 0 10px;

        color: var(--sp-navy);

        font-size: 16px;

        font-weight: 700;
    }

    .job-popup-section-content {
        color: #5f6b7d;

        font-size: 14px;

        line-height: 1.75;

        white-space: pre-line;
    }

    /* =========================================================
       SKILLS
    ========================================================= */

    .job-popup-skills {
        display: flex;

        flex-wrap: wrap;

        gap: 8px;
    }

    .job-popup-skill {
        display: inline-flex;

        padding: 7px 11px;

        border-radius: 7px;

        background: var(--sp-blue-light);
        color: var(--sp-blue);

        font-size: 12px;

        font-weight: 600;
    }

    /* =========================================================
       POPUP FOOTER
    ========================================================= */

    .job-popup-footer {
        padding: 18px 28px;

        border-top: 1px solid var(--sp-border);

        display: flex;

        justify-content: flex-end;

        gap: 10px;
    }

    .job-popup-footer-close {
        border: none;

        padding: 10px 18px;

        border-radius: 9px;

        background: #f1f5f9;
        color: #475569;

        font-size: 13px;
        font-weight: 600;

        cursor: pointer;
    }

    .job-popup-footer-close:hover {
        background: #e2e8f0;
    }

    /* =========================================================
       MOBILE
    ========================================================= */

    @media (max-width: 700px) {

        .startup-jobs-container {
            padding: 0 15px;
        }

        .startup-jobs-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .startup-jobs-header h1 {
            font-size: 22px;
        }

        .startup-job-top {
            flex-direction: column;
        }

        .startup-job-bottom {
            align-items: flex-start;
            flex-direction: column;
        }

        .startup-job-description {
            max-width: 100%;
        }

        .startup-view-job {
            width: 100%;
        }

        .job-popup-overlay {
            padding: 10px;
        }

        .job-popup {
            max-height: 95vh;
            border-radius: 15px;
        }

        .job-popup-header {
            padding: 18px;
        }

        .job-popup-body {
            padding: 20px 18px;
        }

        .job-popup-footer {
            padding: 15px 18px;
        }

        .job-popup-details {
            grid-template-columns: 1fr;
        }

        .job-popup-title {
            font-size: 19px;
        }
    }
</style>


<div class="startup-jobs-page">

    <div class="startup-jobs-container">

        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <div class="startup-jobs-header">

            <div class="startup-jobs-header-left">

                <div class="startup-jobs-icon">
                    <i class="bi bi-briefcase"></i>
                </div>

                <div>

                    <h1>
                        {{ $startupProfile->startup_name }}
                    </h1>

                    <p>
                        Jobs associated with this startup profile
                    </p>

                </div>

            </div>


            <a
                href="{{ route('employer.startup-profile.index') }}"
                class="startup-back-btn"
            >
                <i class="bi bi-arrow-left"></i>

                Back to Startup Profiles
            </a>

        </div>


        {{-- =====================================================
             JOBS CARD
        ====================================================== --}}

        <div class="startup-jobs-card">

            <div class="startup-jobs-card-header">

                <h2>
                    Job Openings
                </h2>

                <span class="startup-jobs-count">

                    {{ $jobs->total() }}

                    {{ $jobs->total() == 1 ? 'Job' : 'Jobs' }}

                </span>

            </div>


            {{-- =================================================
                 JOB LIST
            ================================================== --}}

            @forelse($jobs as $job)

                <div class="startup-job-item">

                    <div class="startup-job-top">

                        <div>

                            <h3 class="startup-job-title">
                                {{ $job->title }}
                            </h3>


                            <div class="startup-job-meta">

                                @if($job->employment_type)
                                    <span>
                                        <i class="bi bi-briefcase"></i>
                                        {{ ucfirst(str_replace('-', ' ', $job->employment_type)) }}
                                    </span>
                                @endif


                                @if($job->work_mode)
                                    <span>
                                        <i class="bi bi-laptop"></i>
                                        {{ ucfirst($job->work_mode) }}
                                    </span>
                                @endif


                                @if($job->city || $job->state || $job->country)

                                    <span>

                                        <i class="bi bi-geo-alt"></i>

                                        {{ collect([
                                            $job->city,
                                            $job->state,
                                            $job->country
                                        ])->filter()->implode(', ') }}

                                    </span>

                                @endif


                                @if($job->experience)

                                    <span>

                                        <i class="bi bi-person-workspace"></i>

                                        {{ $job->experience }}

                                    </span>

                                @endif

                            </div>

                        </div>


                        @if($job->is_active)

                            <span class="startup-job-status">

                                <i class="bi bi-circle-fill"></i>

                                Active

                            </span>

                        @else

                            <span class="startup-job-status inactive">

                                <i class="bi bi-circle-fill"></i>

                                Inactive

                            </span>

                        @endif

                    </div>


                    {{-- =================================================
                         DESCRIPTION + VIEW BUTTON
                    ================================================== --}}

                    <div class="startup-job-bottom">

                        <div class="startup-job-description">

                            @if($job->description)

                                {{ \Illuminate\Support\Str::limit(
                                    strip_tags($job->description),
                                    180
                                ) }}

                            @else

                                No job description available.

                            @endif

                        </div>


                        {{-- POPUP BUTTON --}}

                        <button
                            type="button"
                            class="startup-view-job"
                            onclick="openJobPopup({{ $job->id }})"
                        >

                            View Job

                            <i class="bi bi-arrow-right"></i>

                        </button>

                    </div>

                </div>


                {{-- =================================================
                     HIDDEN JOB DATA FOR POPUP
                ================================================== --}}

                <div
                    id="job-data-{{ $job->id }}"
                    class="job-popup-data"
                    style="display:none;"
                >

                    <div
                        data-title="{{ e($job->title) }}"
                        data-employment-type="{{ e($job->employment_type ?? '') }}"
                        data-work-mode="{{ e($job->work_mode ?? '') }}"
                        data-experience="{{ e($job->experience ?? '') }}"
                        data-salary="{{ e($job->salary ?? '') }}"
                        data-qualification="{{ e($job->qualification ?? '') }}"
                        data-country="{{ e($job->country ?? '') }}"
                        data-state="{{ e($job->state ?? '') }}"
                        data-district="{{ e($job->district ?? '') }}"
                        data-city="{{ e($job->city ?? '') }}"
                        data-description="{{ e($job->description ?? '') }}"
                        data-skills="{{ e(is_array($job->skills) ? implode(', ', $job->skills) : ($job->skills ?? '')) }}"
                        data-expires-at="{{ $job->expires_at ? $job->expires_at->format('d M Y') : '' }}"
                        data-active="{{ $job->is_active ? '1' : '0' }}"
                    ></div>

                </div>

            @empty

                {{-- =================================================
                     EMPTY STATE
                ================================================== --}}

                <div class="startup-jobs-empty">

                    <div class="startup-jobs-empty-icon">

                        <i class="bi bi-briefcase"></i>

                    </div>

                    <h3>
                        No Jobs Linked Yet
                    </h3>

                    <p>
                        You have not connected any job posting
                        to this startup profile yet.
                    </p>

                    <a
                        href="{{ route('employer.jobs.create') }}"
                        class="startup-create-job"
                    >

                        <i class="bi bi-plus-lg"></i>

                        Create Job

                    </a>

                </div>

            @endforelse


            @if($jobs->hasPages())

                <div class="startup-pagination">

                    {{ $jobs->links() }}

                </div>

            @endif

        </div>

    </div>

</div>


{{-- =============================================================
     JOB POPUP
============================================================= --}}

<div
    id="jobPopupOverlay"
    class="job-popup-overlay"
    onclick="closeJobPopupFromOverlay(event)"
>

    <div
        class="job-popup"
        onclick="event.stopPropagation()"
    >

        {{-- POPUP HEADER --}}

        <div class="job-popup-header">

            <div class="job-popup-header-left">

                <div class="job-popup-icon">

                    <i class="bi bi-briefcase"></i>

                </div>

                <div>

                    <h2
                        id="popupJobTitle"
                        class="job-popup-title"
                    >
                        Job Title
                    </h2>

                    <p class="job-popup-company">

                        {{ $startupProfile->startup_name }}

                    </p>

                </div>

            </div>


            <button
                type="button"
                class="job-popup-close"
                onclick="closeJobPopup()"
            >

                <i class="bi bi-x-lg"></i>

            </button>

        </div>


        {{-- POPUP BODY --}}

        <div class="job-popup-body">


            {{-- DETAILS --}}

            <div class="job-popup-details">

                <div class="job-popup-detail">

                    <span class="job-popup-detail-label">
                        Employment Type
                    </span>

                    <span
                        id="popupEmploymentType"
                        class="job-popup-detail-value"
                    >
                        -
                    </span>

                </div>


                <div class="job-popup-detail">

                    <span class="job-popup-detail-label">
                        Work Mode
                    </span>

                    <span
                        id="popupWorkMode"
                        class="job-popup-detail-value"
                    >
                        -
                    </span>

                </div>


                <div class="job-popup-detail">

                    <span class="job-popup-detail-label">
                        Experience
                    </span>

                    <span
                        id="popupExperience"
                        class="job-popup-detail-value"
                    >
                        -
                    </span>

                </div>


                <div class="job-popup-detail">

                    <span class="job-popup-detail-label">
                        Salary
                    </span>

                    <span
                        id="popupSalary"
                        class="job-popup-detail-value"
                    >
                        -
                    </span>

                </div>


                <div class="job-popup-detail">

                    <span class="job-popup-detail-label">
                        Qualification
                    </span>

                    <span
                        id="popupQualification"
                        class="job-popup-detail-value"
                    >
                        -
                    </span>

                </div>


                <div class="job-popup-detail">

                    <span class="job-popup-detail-label">
                        Location
                    </span>

                    <span
                        id="popupLocation"
                        class="job-popup-detail-value"
                    >
                        -
                    </span>

                </div>


                <div class="job-popup-detail">

                    <span class="job-popup-detail-label">
                        Deadline
                    </span>

                    <span
                        id="popupDeadline"
                        class="job-popup-detail-value"
                    >
                        -
                    </span>

                </div>


                <div class="job-popup-detail">

                    <span class="job-popup-detail-label">
                        Status
                    </span>

                    <span
                        id="popupStatus"
                        class="job-popup-detail-value"
                    >
                        -
                    </span>

                </div>

            </div>


            {{-- SKILLS --}}

            <div
                id="popupSkillsSection"
                class="job-popup-section"
                style="display:none;"
            >

                <h3 class="job-popup-section-title">
                    Skills
                </h3>

                <div
                    id="popupSkills"
                    class="job-popup-skills"
                ></div>

            </div>


            {{-- DESCRIPTION --}}

            <div class="job-popup-section">

                <h3 class="job-popup-section-title">
                    Job Description
                </h3>

                <div
                    id="popupDescription"
                    class="job-popup-section-content"
                >
                    -
                </div>

            </div>

        </div>


        {{-- POPUP FOOTER --}}

        <div class="job-popup-footer">

            <button
                type="button"
                class="job-popup-footer-close"
                onclick="closeJobPopup()"
            >

                Close

            </button>

        </div>

    </div>

</div>


<script>

    /* =========================================================
       OPEN JOB POPUP
    ========================================================= */

    function openJobPopup(jobId)
    {
        const dataContainer = document.querySelector(
            '#job-data-' + jobId + ' > div'
        );

        if (!dataContainer) {
            return;
        }

        const data = dataContainer.dataset;


        /* -----------------------------------------------------
           BASIC INFORMATION
        ----------------------------------------------------- */

        document.getElementById('popupJobTitle').textContent =
            data.title || 'Job Details';


        document.getElementById('popupEmploymentType').textContent =
            formatText(data.employmentType);


        document.getElementById('popupWorkMode').textContent =
            formatText(data.workMode);


        document.getElementById('popupExperience').textContent =
            data.experience || 'Not specified';


        document.getElementById('popupSalary').textContent =
            data.salary || 'Not specified';


        document.getElementById('popupQualification').textContent =
            data.qualification || 'Not specified';


        /* -----------------------------------------------------
           LOCATION
        ----------------------------------------------------- */

        const locationParts = [
            data.city,
            data.district,
            data.state,
            data.country
        ].filter(Boolean);

        document.getElementById('popupLocation').textContent =
            locationParts.length
                ? locationParts.join(', ')
                : 'Not specified';


        /* -----------------------------------------------------
           DEADLINE
        ----------------------------------------------------- */

        document.getElementById('popupDeadline').textContent =
            data.expiresAt || 'No deadline';


        /* -----------------------------------------------------
           STATUS
        ----------------------------------------------------- */

        document.getElementById('popupStatus').textContent =
            data.active === '1'
                ? 'Active'
                : 'Inactive';


        /* -----------------------------------------------------
           DESCRIPTION
        ----------------------------------------------------- */

        document.getElementById('popupDescription').textContent =
            data.description || 'No job description available.';


        /* -----------------------------------------------------
           SKILLS
        ----------------------------------------------------- */

        const skillsSection =
            document.getElementById('popupSkillsSection');

        const skillsContainer =
            document.getElementById('popupSkills');

        skillsContainer.innerHTML = '';

        if (data.skills) {

            let skills = [];

            try {

                const decoded = JSON.parse(data.skills);

                if (Array.isArray(decoded)) {
                    skills = decoded;
                }

            } catch (error) {

                skills = data.skills
                    .split(',')
                    .map(skill => skill.trim())
                    .filter(Boolean);

            }


            if (skills.length) {

                skills.forEach(function(skill) {

                    const span =
                        document.createElement('span');

                    span.className =
                        'job-popup-skill';

                    span.textContent = skill;

                    skillsContainer.appendChild(span);

                });

                skillsSection.style.display = 'block';

            } else {

                skillsSection.style.display = 'none';

            }

        } else {

            skillsSection.style.display = 'none';

        }


        /* -----------------------------------------------------
           SHOW POPUP
        ----------------------------------------------------- */

        const popup =
            document.getElementById('jobPopupOverlay');

        popup.classList.add('show');

        document.body.style.overflow = 'hidden';
    }


    /* =========================================================
       CLOSE POPUP
    ========================================================= */

    function closeJobPopup()
    {
        const popup =
            document.getElementById('jobPopupOverlay');

        popup.classList.remove('show');

        document.body.style.overflow = '';
    }


    /* =========================================================
       CLOSE WHEN CLICKING OUTSIDE POPUP
    ========================================================= */

    function closeJobPopupFromOverlay(event)
    {
        if (
            event.target.id === 'jobPopupOverlay'
        ) {
            closeJobPopup();
        }
    }


    /* =========================================================
       ESC KEY
    ========================================================= */

    document.addEventListener('keydown', function(event) {

        if (event.key === 'Escape') {

            closeJobPopup();

        }

    });


    /* =========================================================
       TEXT FORMATTER
    ========================================================= */

    function formatText(value)
    {
        if (!value) {
            return 'Not specified';
        }

        return value
            .replace(/-/g, ' ')
            .replace(/\b\w/g, function(letter) {
                return letter.toUpperCase();
            });
    }

</script>

@endsection
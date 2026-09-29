@php
    $job = $job ?? null;

    /*
    |--------------------------------------------------------------------------
    | Normalize Employment Type
    |--------------------------------------------------------------------------
    | Supports old database values:
    | full_time  -> full-time
    | part_time  -> part-time
    | Full Time  -> full-time
    | Part Time  -> part-time
    |--------------------------------------------------------------------------
    */

    $employmentType = old(
        'employment_type',
        $job?->employment_type ?? ''
    );

    $employmentType = strtolower(trim((string) $employmentType));

    $employmentType = str_replace('_', '-', $employmentType);

    $employmentType = match ($employmentType) {

        'full time',
        'fulltime' => 'full-time',

        'part time',
        'parttime' => 'part-time',

        'contract' => 'contract',

        'internship' => 'internship',

        'freelance' => 'freelance',

        default => $employmentType,

    };


    /*
    |--------------------------------------------------------------------------
    | Prepare Skills
    |--------------------------------------------------------------------------
    */

    $jobSkills = old(
        'skills',
        $job?->skills ?? ''
    );


    // If skills are stored as an array
    if (is_array($jobSkills)) {

        $jobSkills = implode(', ', $jobSkills);

    }


    // If skills are stored as JSON
    if (is_string($jobSkills)) {

        $decodedSkills = json_decode(
            $jobSkills,
            true
        );

        if (
            json_last_error() === JSON_ERROR_NONE &&
            is_array($decodedSkills)
        ) {

            $jobSkills = implode(
                ', ',
                $decodedSkills
            );

        }

    }


    $jobSkills = is_string($jobSkills)
        ? $jobSkills
        : '';
@endphp


{{-- =========================================================
    STEP 1: BASIC INFORMATION
========================================================= --}}

<div class="job-wizard-step" data-step="1">

    <div class="job-step-heading">

        <span class="job-step-number">
            1
        </span>

        <div>

            <h2>
                Basic Information
            </h2>

            <p>
                Start with the basic details of the job.
            </p>

        </div>

    </div>


    <div class="job-form-grid">


        {{-- =================================================
            JOB TITLE
        ================================================== --}}

        <div class="job-form-field job-form-field-full">

            <label for="title">

                Job Title

                <span class="required-mark">
                    *
                </span>

            </label>


            <input
                type="text"
                id="title"
                name="title"
                value="{{ old('title', $job?->title ?? '') }}"
                placeholder="e.g. Laravel Developer"
                maxlength="120"
                required
            >


            <div class="job-input-meta">

                <span>
                    Enter a clear and specific job title.
                </span>

                <span>
                    <span id="titleCounter">0</span>/120
                </span>

            </div>


            @error('title')

                <div class="job-field-error">
                    {{ $message }}
                </div>

            @enderror

        </div>



        {{-- =================================================
            EMPLOYMENT TYPE
        ================================================== --}}

        <div class="job-form-field">

            <label for="employment_type">

                Employment Type

                <span class="required-mark">
                    *
                </span>

            </label>


            <select
                id="employment_type"
                name="employment_type"
                required
            >

                <option value="">
                    Select employment type
                </option>


                {{-- FULL TIME --}}

                <option
                    value="full-time"
                    {{ $employmentType === 'full-time' ? 'selected' : '' }}
                >
                    Full Time
                </option>


                {{-- PART TIME --}}

                <option
                    value="part-time"
                    {{ $employmentType === 'part-time' ? 'selected' : '' }}
                >
                    Part Time
                </option>


                {{-- CONTRACT --}}

                <option
                    value="contract"
                    {{ $employmentType === 'contract' ? 'selected' : '' }}
                >
                    Contract
                </option>


                {{-- INTERNSHIP --}}

                <option
                    value="internship"
                    {{ $employmentType === 'internship' ? 'selected' : '' }}
                >
                    Internship
                </option>


                {{-- FREELANCE --}}

                <option
                    value="freelance"
                    {{ $employmentType === 'freelance' ? 'selected' : '' }}
                >
                    Freelance
                </option>

            </select>


            @error('employment_type')

                <div class="job-field-error">
                    {{ $message }}
                </div>

            @enderror

        </div>



        {{-- =================================================
            WORK MODE
        ================================================== --}}

        <div class="job-form-field">

            <label for="work_mode">

                Work Mode

                <span class="required-mark">
                    *
                </span>

            </label>


            <select
                id="work_mode"
                name="work_mode"
                required
            >

                <option value="">
                    Select work mode
                </option>


                {{-- REMOTE --}}

                <option
                    value="remote"
                    {{ old('work_mode', $job?->work_mode ?? '') === 'remote' ? 'selected' : '' }}
                >
                    Remote
                </option>


                {{-- HYBRID --}}

                <option
                    value="hybrid"
                    {{ old('work_mode', $job?->work_mode ?? '') === 'hybrid' ? 'selected' : '' }}
                >
                    Hybrid
                </option>


                {{-- ON-SITE --}}

                <option
                    value="onsite"
                    {{ old('work_mode', $job?->work_mode ?? '') === 'onsite' ? 'selected' : '' }}
                >
                    On-site
                </option>

            </select>


            <div class="job-input-hint">

                Remote jobs do not require a physical location.

            </div>


            @error('work_mode')

                <div class="job-field-error">
                    {{ $message }}
                </div>

            @enderror

        </div>



        {{-- =================================================
            EXPERIENCE
        ================================================== --}}

        <div class="job-form-field">

            <label for="experience">
                Experience
            </label>


            <input
                type="text"
                id="experience"
                name="experience"
                value="{{ old('experience', $job?->experience ?? '') }}"
                placeholder="e.g. 2-4 years"
            >


            @error('experience')

                <div class="job-field-error">
                    {{ $message }}
                </div>

            @enderror

        </div>



        {{-- =================================================
            SALARY
        ================================================== --}}

        <div class="job-form-field">

            <label for="salary">
                Salary
            </label>


            <input
                type="text"
                id="salary"
                name="salary"
                value="{{ old('salary', $job?->salary ?? '') }}"
                placeholder="e.g. ₹25,000 - ₹40,000 / month"
            >


            @error('salary')

                <div class="job-field-error">
                    {{ $message }}
                </div>

            @enderror

        </div>



        {{-- =================================================
            QUALIFICATION
        ================================================== --}}

        <div class="job-form-field">

            <label for="qualification">
                Qualification
            </label>


            <input
                type="text"
                id="qualification"
                name="qualification"
                value="{{ old('qualification', $job?->qualification ?? '') }}"
                placeholder="e.g. BCA, B.Tech, MCA"
            >


            @error('qualification')

                <div class="job-field-error">
                    {{ $message }}
                </div>

            @enderror

        </div>



        {{-- =================================================
            SKILLS
        ================================================== --}}

        <div class="job-form-field job-form-field-full">

            <label for="skills">
                Skills
            </label>


            <input
                type="text"
                id="skills"
                name="skills"
                value="{{ $jobSkills }}"
                placeholder="e.g. Laravel, PHP, MySQL, REST API, JavaScript"
            >


            <div class="job-input-hint">

                Separate multiple skills using commas.

            </div>


            @error('skills')

                <div class="job-field-error">
                    {{ $message }}
                </div>

            @enderror

        </div>

    </div>

</div>



{{-- =========================================================
    STEP 2: JOB DESCRIPTION
========================================================= --}}

<div class="job-wizard-step" data-step="2">

    <div class="job-step-heading">

        <span class="job-step-number">
            2
        </span>

        <div>

            <h2>
                Job Description
            </h2>

            <p>
                Describe the role, responsibilities and requirements.
            </p>

        </div>

    </div>


    <div class="job-form-field">

        <label for="description">

            Job Description

            <span class="required-mark">
                *
            </span>

        </label>


        <textarea
            id="description"
            name="description"
            rows="12"
            maxlength="5000"
            placeholder="Describe the responsibilities, requirements, skills and other important details..."
            required
        >{{ old('description', $job?->description ?? '') }}</textarea>


        <div class="job-input-meta">

            <span>
                Give candidates enough information to understand the role.
            </span>

            <span>
                <span id="descriptionCounter">0</span>/5000
            </span>

        </div>


        @error('description')

            <div class="job-field-error">
                {{ $message }}
            </div>

        @enderror

    </div>



    {{-- DESCRIPTION TIPS --}}

    <div class="job-description-tips">

        <div class="job-description-tip">

            <i class="bi bi-check-circle"></i>

            <span>
                Mention the main responsibilities.
            </span>

        </div>


        <div class="job-description-tip">

            <i class="bi bi-check-circle"></i>

            <span>
                Include important technical requirements.
            </span>

        </div>


        <div class="job-description-tip">

            <i class="bi bi-check-circle"></i>

            <span>
                Clearly mention what candidates should know.
            </span>

        </div>

    </div>

</div>



{{-- =========================================================
    STEP 3: JOB LOCATION
========================================================= --}}

<div class="job-wizard-step" data-step="3">

    <div class="job-step-heading">

        <span class="job-step-number">
            3
        </span>

        <div>

            <h2>
                Job Location
            </h2>

            <p>
                Tell candidates where this job is based.
            </p>

        </div>

    </div>



    {{-- LOCATION INFORMATION --}}

    <div class="job-location-mode-info">

        <div class="job-location-mode-icon">

            <i class="bi bi-info-circle"></i>

        </div>


        <div>

            <strong>
                Location requirements depend on Work Mode
            </strong>

            <p>
                Remote jobs do not require location details.
                For Hybrid and On-site jobs, State, District and City are required.
                Country is always optional.
            </p>

        </div>

    </div>



    <div class="job-form-grid">


        {{-- =================================================
            COUNTRY
        ================================================== --}}

        <div class="job-form-field">

            <label for="country">

                Country

                <span class="optional-label">
                    (Optional)
                </span>

            </label>


            <input
                type="text"
                id="country"
                name="country"
                value="{{ old('country', $job?->country ?? '') }}"
                placeholder="e.g. India"
            >


            @error('country')

                <div class="job-field-error">
                    {{ $message }}
                </div>

            @enderror

        </div>



        {{-- =================================================
            STATE
        ================================================== --}}

        <div class="job-form-field">

            <label for="state">

                State

                <span class="required-mark state-required">
                    *
                </span>

            </label>


            <input
                type="text"
                id="state"
                name="state"
                value="{{ old('state', $job?->state ?? '') }}"
                placeholder="e.g. Kerala"
            >


            @error('state')

                <div class="job-field-error">
                    {{ $message }}
                </div>

            @enderror

        </div>



        {{-- =================================================
            DISTRICT
        ================================================== --}}

        <div class="job-form-field">

            <label for="district">

                District

                <span class="required-mark district-required">
                    *
                </span>

            </label>


            <input
                type="text"
                id="district"
                name="district"
                value="{{ old('district', $job?->district ?? '') }}"
                placeholder="e.g. Kasaragod"
            >


            @error('district')

                <div class="job-field-error">
                    {{ $message }}
                </div>

            @enderror

        </div>



        {{-- =================================================
            CITY
        ================================================== --}}

        <div class="job-form-field">

            <label for="city">

                City

                <span class="required-mark city-required">
                    *
                </span>

            </label>


            <input
                type="text"
                id="city"
                name="city"
                value="{{ old('city', $job?->city ?? '') }}"
                placeholder="e.g. Kanhangad"
            >


            @error('city')

                <div class="job-field-error">
                    {{ $message }}
                </div>

            @enderror

        </div>

    </div>



    {{-- =================================================
        LOCATION PREVIEW
    ================================================== --}}

    <div class="job-location-preview">

        <div class="job-location-icon">

            <i class="bi bi-geo-alt"></i>

        </div>


        <div>

            <strong>
                Location Preview
            </strong>

            <p id="locationPreview">
                Location will appear here
            </p>

        </div>

    </div>

</div>
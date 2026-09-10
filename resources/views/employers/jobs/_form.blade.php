@php
    $job = $job ?? null;

    $jobSkills = old('skills', $job->skills ?? '');

    if (is_array($jobSkills)) {
        $jobSkills = implode(', ', $jobSkills);
    }

    $jobSkills = is_string($jobSkills) ? $jobSkills : '';
@endphp

{{-- ============================================================
    STEP 1 — BASIC INFORMATION
============================================================ --}}
<div class="job-wizard-step" data-step="1">

    <div class="job-form-card">

        <div class="job-form-card-head">
            <div class="job-form-card-icon">
                <i class="bi bi-briefcase"></i>
            </div>

            <div>
                <h2>Basic Information</h2>
                <p>Start with the basic details of your job opening.</p>
            </div>
        </div>

        <div class="job-form-tip">
            <i class="bi bi-lightbulb"></i>
            <div>
                <strong>Tip</strong>
                <span>
                    Use a clear and specific job title so candidates can easily understand the role.
                </span>
            </div>
        </div>

        <div class="job-form-row">

            {{-- Job Title --}}
            <div class="job-form-field job-field-full">
                <label for="title">
                    Job Title
                    <span class="job-required">*</span>
                </label>

                <input
                    type="text"
                    name="title"
                    id="title"
                    maxlength="120"
                    required
                    value="{{ old('title', $job->title ?? '') }}"
                    placeholder="e.g. Senior Backend Developer"
                >

                <div class="job-field-bottom">
                    <small>Choose a title that clearly describes the position.</small>
                    <span class="job-counter">
                        <span id="titleCounter">0</span>/120
                    </span>
                </div>

                @error('title')
                    <p class="job-field-error">{{ $message }}</p>
                @enderror
            </div>


            {{-- Employment Type --}}
            <div class="job-form-field">

                <label for="employment_type">
                    Employment Type
                    <span class="job-required">*</span>
                </label>

                <div class="job-select-wrap">
                    <select name="employment_type" id="employment_type" required>
                        <option value="">Select employment type</option>

                        <option value="full-time"
                            {{ old('employment_type', $job->employment_type ?? '') === 'full-time' ? 'selected' : '' }}>
                            Full Time
                        </option>

                        <option value="part-time"
                            {{ old('employment_type', $job->employment_type ?? '') === 'part-time' ? 'selected' : '' }}>
                            Part Time
                        </option>

                        <option value="contract"
                            {{ old('employment_type', $job->employment_type ?? '') === 'contract' ? 'selected' : '' }}>
                            Contract
                        </option>

                        <option value="freelance"
                            {{ old('employment_type', $job->employment_type ?? '') === 'freelance' ? 'selected' : '' }}>
                            Freelance
                        </option>
                    </select>

                    <i class="bi bi-chevron-down"></i>
                </div>

                @error('employment_type')
                    <p class="job-field-error">{{ $message }}</p>
                @enderror

            </div>


            {{-- Work Mode --}}
            <div class="job-form-field">

                <label for="work_mode">
                    Work Mode
                    <span class="job-required">*</span>
                </label>

                <div class="job-select-wrap">
                    <select name="work_mode" id="work_mode" required>
                        <option value="">Select work mode</option>

                        <option value="onsite"
                            {{ old('work_mode', $job->work_mode ?? '') === 'onsite' ? 'selected' : '' }}>
                            On-site
                        </option>

                        <option value="hybrid"
                            {{ old('work_mode', $job->work_mode ?? '') === 'hybrid' ? 'selected' : '' }}>
                            Hybrid
                        </option>

                        <option value="remote"
                            {{ old('work_mode', $job->work_mode ?? '') === 'remote' ? 'selected' : '' }}>
                            Remote
                        </option>
                    </select>

                    <i class="bi bi-chevron-down"></i>
                </div>

                @error('work_mode')
                    <p class="job-field-error">{{ $message }}</p>
                @enderror

            </div>


            {{-- Experience --}}
            <div class="job-form-field">

                <label for="experience">
                    Experience
                </label>

                <input
                    type="text"
                    name="experience"
                    id="experience"
                    maxlength="80"
                    value="{{ old('experience', $job->experience ?? '') }}"
                    placeholder="e.g. 2–4 years"
                >

                <small class="job-field-help">
                    Mention the preferred experience level.
                </small>

                @error('experience')
                    <p class="job-field-error">{{ $message }}</p>
                @enderror

            </div>


            {{-- Salary --}}
            <div class="job-form-field">

                <label for="salary">
                    Salary
                </label>

                <input
                    type="text"
                    name="salary"
                    id="salary"
                    maxlength="80"
                    value="{{ old('salary', $job->salary ?? '') }}"
                    placeholder="e.g. ₹4 LPA – ₹8 LPA"
                >

                <small class="job-field-help">
                    Add a salary range or compensation details.
                </small>

                @error('salary')
                    <p class="job-field-error">{{ $message }}</p>
                @enderror

            </div>


            {{-- Qualification --}}
            <div class="job-form-field job-field-full">

                <label for="qualification">
                    Qualification
                </label>

                <input
                    type="text"
                    name="qualification"
                    id="qualification"
                    maxlength="150"
                    value="{{ old('qualification', $job->qualification ?? '') }}"
                    placeholder="e.g. BCA, B.Tech, MCA or equivalent"
                >

                <small class="job-field-help">
                    Mention the required educational qualification.
                </small>

                @error('qualification')
                    <p class="job-field-error">{{ $message }}</p>
                @enderror

            </div>


            {{-- Skills --}}
            <div class="job-form-field job-field-full">

                <label for="skills">
                    Skills
                </label>

                <input
                    type="text"
                    name="skills"
                    id="skills"
                    maxlength="300"
                    value="{{ $jobSkills }}"
                    placeholder="e.g. Laravel, PHP, MySQL, REST API, Git"
                >

                <div class="job-field-bottom">
                    <small>
                        Separate multiple skills using commas.
                    </small>
                </div>

                @error('skills')
                    <p class="job-field-error">{{ $message }}</p>
                @enderror

            </div>

        </div>

    </div>

</div>


{{-- ============================================================
    STEP 2 — JOB DESCRIPTION
============================================================ --}}
<div class="job-wizard-step" data-step="2">

    <div class="job-form-card">

        <div class="job-form-card-head">
            <div class="job-form-card-icon job-icon-purple">
                <i class="bi bi-file-earmark-text"></i>
            </div>

            <div>
                <h2>Job Description</h2>
                <p>Tell candidates what the role is about.</p>
            </div>
        </div>

        <div class="job-form-tip">
            <i class="bi bi-lightbulb"></i>
            <div>
                <strong>Tip</strong>
                <span>
                    Include responsibilities, expectations and what makes this opportunity valuable.
                </span>
            </div>
        </div>

        <div class="job-form-row">

            <div class="job-form-field job-field-full">

                <label for="description">
                    Job Description
                    <span class="job-required">*</span>
                </label>

                <textarea
                    name="description"
                    id="description"
                    rows="12"
                    maxlength="5000"
                    required
                    placeholder="Describe the role, responsibilities, expectations, team and other important details..."
                >{{ old('description', $job->description ?? '') }}</textarea>

                <div class="job-field-bottom">
                    <small>
                        Write a clear description that helps candidates understand the position.
                    </small>

                    <span class="job-counter">
                        <span id="descriptionCounter">0</span>/5000
                    </span>
                </div>

                @error('description')
                    <p class="job-field-error">{{ $message }}</p>
                @enderror

            </div>

        </div>

    </div>

</div>


{{-- ============================================================
    STEP 3 — JOB LOCATION
============================================================ --}}
<div class="job-wizard-step" data-step="3">

    <div class="job-form-card">

        <div class="job-form-card-head">
            <div class="job-form-card-icon job-icon-green">
                <i class="bi bi-geo-alt"></i>
            </div>

            <div>
                <h2>Job Location</h2>
                <p>Tell candidates where this opportunity is based.</p>
            </div>
        </div>

        <div class="job-form-tip">
            <i class="bi bi-info-circle"></i>
            <div>
                <strong>Location Details</strong>
                <span>
                    Provide an accurate location so candidates can understand where they will work.
                </span>
            </div>
        </div>

        <div class="job-form-row">

            {{-- Country --}}
            <div class="job-form-field">

                <label for="country">
                    Country
                </label>

                <input
                    type="text"
                    name="country"
                    id="country"
                    maxlength="100"
                    value="{{ old('country', $job->country ?? '') }}"
                    placeholder="e.g. India"
                >

                @error('country')
                    <p class="job-field-error">{{ $message }}</p>
                @enderror

            </div>


            {{-- State --}}
            <div class="job-form-field">

                <label for="state">
                    State
                    <span class="job-required">*</span>
                </label>

                <input
                    type="text"
                    name="state"
                    id="state"
                    maxlength="100"
                    required
                    value="{{ old('state', $job->state ?? '') }}"
                    placeholder="e.g. Kerala"
                >

                @error('state')
                    <p class="job-field-error">{{ $message }}</p>
                @enderror

            </div>


            {{-- District --}}
            <div class="job-form-field">

                <label for="district">
                    District
                    <span class="job-required">*</span>
                </label>

                <input
                    type="text"
                    name="district"
                    id="district"
                    maxlength="100"
                    required
                    value="{{ old('district', $job->district ?? '') }}"
                    placeholder="e.g. Kasaragod"
                >

                @error('district')
                    <p class="job-field-error">{{ $message }}</p>
                @enderror

            </div>


            {{-- City --}}
            <div class="job-form-field">

                <label for="city">
                    City
                    <span class="job-required">*</span>
                </label>

                <input
                    type="text"
                    name="city"
                    id="city"
                    maxlength="100"
                    required
                    value="{{ old('city', $job->city ?? '') }}"
                    placeholder="e.g. Kanhangad"
                >

                @error('city')
                    <p class="job-field-error">{{ $message }}</p>
                @enderror

            </div>


            {{-- Location summary --}}
            <div class="job-location-preview job-field-full">

                <div class="job-location-preview-icon">
                    <i class="bi bi-pin-map"></i>
                </div>

                <div>
                    <strong>Job location</strong>
                    <span id="locationPreview">
                        Enter the location details above.
                    </span>
                </div>

            </div>

        </div>

    </div>

</div>
@php
    $project = $project ?? null;

    $deadlineValue = '';

    if (!empty($project?->deadline)) {
        try {
            $deadlineValue = \Carbon\Carbon::parse($project->deadline)->format('Y-m-d');
        } catch (\Throwable $e) {
            $deadlineValue = $project->deadline;
        }
    }

    $skillsValue = '';

    if (!empty($project?->skills)) {
        if (is_array($project->skills)) {
            $skillsValue = implode(', ', $project->skills);
        } else {
            $skillsValue = $project->skills;
        }
    }
@endphp


{{-- =========================================================
     01 BASIC INFORMATION
========================================================= --}}

<div class="project-section">

    <div class="project-section-heading">

        <div class="project-section-number">
            01
        </div>

        <div>

            <h2>Basic Information</h2>

            <p>
                Tell professionals what this project is about.
            </p>

        </div>

    </div>


    {{-- PROJECT TITLE --}}

    <div class="project-form-group">

        <label
            for="title"
            class="project-label"
        >

            <i class="fas fa-heading"></i>

            Project Title

            <span class="project-required">*</span>

        </label>


        <div class="project-input-wrap">

            <i class="fas fa-heading project-input-icon"></i>

            <input
                type="text"
                id="title"
                name="title"
                class="project-input has-icon @error('title') is-invalid @enderror"
                value="{{ old('title', $project->title ?? '') }}"
                placeholder="e.g. Build a Laravel Job Portal"
                required
            >

        </div>


        @error('title')

            <div class="project-invalid-feedback">
                {{ $message }}
            </div>

        @else

            <div class="project-help-text">

                <i class="fas fa-circle-info"></i>

                Use a clear and specific project title.

            </div>

        @enderror

    </div>



    {{-- PROJECT TYPE + WORK MODE --}}

    <div class="project-form-row">


        {{-- PROJECT TYPE --}}

        <div class="project-form-group">

            <label
                for="project_type"
                class="project-label"
            >

                <i class="fas fa-tag"></i>

                Project Type

                <span class="project-required">*</span>

            </label>


            <div class="project-input-wrap">

                <i class="fas fa-tag project-input-icon"></i>

                <select
                    id="project_type"
                    name="project_type"
                    class="project-select has-icon @error('project_type') is-invalid @enderror"
                    required
                >

                    <option value="">
                        Select type
                    </option>

                    <option
                        value="fixed"
                        @selected(old('project_type', $project->project_type ?? '') === 'fixed')
                    >
                        Fixed Price
                    </option>

                    <option
                        value="hourly"
                        @selected(old('project_type', $project->project_type ?? '') === 'hourly')
                    >
                        Hourly Rate
                    </option>

                </select>

            </div>


            @error('project_type')

                <div class="project-invalid-feedback">
                    {{ $message }}
                </div>

            @enderror

        </div>



        {{-- WORK MODE --}}

        <div class="project-form-group">

            <label
                for="work_mode"
                class="project-label"
            >

                <i class="fas fa-building"></i>

                Work Mode

                <span class="project-required">*</span>

            </label>


            <div class="project-input-wrap">

                <i class="fas fa-building project-input-icon"></i>

                <select
                    id="work_mode"
                    name="work_mode"
                    class="project-select has-icon @error('work_mode') is-invalid @enderror"
                    required
                >

                    <option value="">
                        Select mode
                    </option>

                    <option
                        value="remote"
                        @selected(old('work_mode', $project->work_mode ?? '') === 'remote')
                    >
                        Remote
                    </option>

                    <option
                        value="onsite"
                        @selected(old('work_mode', $project->work_mode ?? '') === 'onsite')
                    >
                        On-site
                    </option>

                    <option
                        value="hybrid"
                        @selected(old('work_mode', $project->work_mode ?? '') === 'hybrid')
                    >
                        Hybrid
                    </option>

                </select>

            </div>


            @error('work_mode')

                <div class="project-invalid-feedback">
                    {{ $message }}
                </div>

            @enderror

        </div>

    </div>



    {{-- DURATION + BUDGET --}}

    <div class="project-form-row">


        {{-- DURATION --}}

        <div class="project-form-group">

            <label
                for="duration"
                class="project-label"
            >

                <i class="fas fa-clock"></i>

                Duration

                <span class="project-required">*</span>

            </label>


            <div class="project-input-wrap">

                <i class="fas fa-clock project-input-icon"></i>

                <input
                    type="text"
                    id="duration"
                    name="duration"
                    class="project-input has-icon @error('duration') is-invalid @enderror"
                    value="{{ old('duration', $project->duration ?? '') }}"
                    placeholder="e.g. 2-4 weeks"
                    required
                >

            </div>


            @error('duration')

                <div class="project-invalid-feedback">
                    {{ $message }}
                </div>

            @enderror

        </div>



        {{-- BUDGET --}}

        <div class="project-form-group">

            <label
                for="budget"
                class="project-label"
            >

                <i class="fas fa-money-bill-wave"></i>

                Budget

                <span class="project-required">*</span>

            </label>


            <div class="project-input-wrap">

                <i class="fas fa-money-bill-wave project-input-icon"></i>

                <input
                    type="text"
                    id="budget"
                    name="budget"
                    class="project-input has-icon @error('budget') is-invalid @enderror"
                    value="{{ old('budget', $project->budget ?? '') }}"
                    placeholder="e.g. ₹25,000 - ₹50,000"
                    required
                >

            </div>


            @error('budget')

                <div class="project-invalid-feedback">
                    {{ $message }}
                </div>

            @else

                <div class="project-help-text">

                    <i class="fas fa-circle-info"></i>

                    Enter the expected project budget.

                </div>

            @enderror

        </div>

    </div>



    {{-- EXPERIENCE + SKILLS --}}

    <div class="project-form-row">


        {{-- EXPERIENCE --}}

        <div class="project-form-group">

            <label
                for="experience_level"
                class="project-label"
            >

                <i class="fas fa-chart-line"></i>

                Experience Level

            </label>


            <div class="project-input-wrap">

                <i class="fas fa-chart-line project-input-icon"></i>

                <select
                    id="experience_level"
                    name="experience_level"
                    class="project-select has-icon @error('experience_level') is-invalid @enderror"
                >

                    <option value="">
                        Select level
                    </option>

                    <option
                        value="entry"
                        @selected(old('experience_level', $project->experience_level ?? '') === 'entry')
                    >
                        Entry Level
                    </option>

                    <option
                        value="intermediate"
                        @selected(old('experience_level', $project->experience_level ?? '') === 'intermediate')
                    >
                        Intermediate
                    </option>

                    <option
                        value="expert"
                        @selected(old('experience_level', $project->experience_level ?? '') === 'expert')
                    >
                        Expert
                    </option>

                </select>

            </div>


            @error('experience_level')

                <div class="project-invalid-feedback">
                    {{ $message }}
                </div>

            @enderror

        </div>



        {{-- SKILLS --}}

        <div class="project-form-group">

            <label
                for="skills"
                class="project-label"
            >

                <i class="fas fa-code"></i>

                Required Skills

            </label>


            <div class="project-input-wrap">

                <i class="fas fa-code project-input-icon"></i>

                <input
                    type="text"
                    id="skills"
                    name="skills"
                    class="project-input has-icon @error('skills') is-invalid @enderror"
                    value="{{ old('skills', $skillsValue) }}"
                    placeholder="e.g. Laravel, MySQL, React"
                >

            </div>


            @error('skills')

                <div class="project-invalid-feedback">
                    {{ $message }}
                </div>

            @else

                <div class="project-help-text">

                    <i class="fas fa-circle-info"></i>

                    Separate multiple skills with commas.

                </div>

            @enderror

        </div>

    </div>

</div>



<div class="project-section-divider"></div>



{{-- =========================================================
     02 PROJECT DETAILS
========================================================= --}}

<div class="project-section">

    <div class="project-section-heading">

        <div class="project-section-number">
            02
        </div>

        <div>

            <h2>Project Details</h2>

            <p>
                Add requirements and publishing preferences.
            </p>

        </div>

    </div>



    {{-- DEADLINE + VISIBILITY --}}

    <div class="project-form-row">


        {{-- DEADLINE --}}

        <div class="project-form-group">

            <label
                for="deadline"
                class="project-label"
            >

                <i class="fas fa-calendar-days"></i>

                Submission Deadline

            </label>


            <div class="project-input-wrap">

                <i class="fas fa-calendar-days project-input-icon"></i>

                <input
                    type="date"
                    id="deadline"
                    name="deadline"
                    class="project-input has-icon @error('deadline') is-invalid @enderror"
                    value="{{ old('deadline', $deadlineValue) }}"
                >

            </div>


            @error('deadline')

                <div class="project-invalid-feedback">
                    {{ $message }}
                </div>

            @enderror

        </div>



        {{-- VISIBILITY --}}

        <div class="project-form-group">

            <label
                for="visibility"
                class="project-label"
            >

                <i class="fas fa-eye"></i>

                Visibility

                <span class="project-required">*</span>

            </label>


            <div class="project-input-wrap">

                <i class="fas fa-eye project-input-icon"></i>

                <select
                    id="visibility"
                    name="visibility"
                    class="project-select has-icon @error('visibility') is-invalid @enderror"
                    required
                >

                    <option value="">
                        Select visibility
                    </option>

                    <option
                        value="public"
                        @selected(old('visibility', $project->visibility ?? '') === 'public')
                    >
                        Public
                    </option>

                    <option
                        value="private"
                        @selected(old('visibility', $project->visibility ?? '') === 'private')
                    >
                        Private
                    </option>

                </select>

            </div>


            @error('visibility')

                <div class="project-invalid-feedback">
                    {{ $message }}
                </div>

            @enderror

        </div>

    </div>



    {{-- MAXIMUM BIDS --}}

    <div class="project-form-group">

        <label
            for="maximum_bids"
            class="project-label"
        >

            <i class="fas fa-gavel"></i>

            Maximum Bids

            <span class="project-required">*</span>

        </label>


        <div class="project-input-wrap">

            <i class="fas fa-gavel project-input-icon"></i>

            <input
                type="number"
                id="maximum_bids"
                name="maximum_bids"
                min="1"
                step="1"
                class="project-input has-icon @error('maximum_bids') is-invalid @enderror"
                value="{{ old('maximum_bids', $project->maximum_bids ?? '') }}"
                placeholder="e.g. 20"
                required
            >

        </div>


        @error('maximum_bids')

            <div class="project-invalid-feedback">
                {{ $message }}
            </div>

        @else

            <div class="project-help-text">

                <i class="fas fa-circle-info"></i>

                Set the maximum number of proposals you want to receive.

            </div>

        @enderror

    </div>

</div>



<div class="project-section-divider"></div>



{{-- =========================================================
     03 LOCATION
========================================================= --}}

<div class="project-section">

    <div class="project-section-heading">

        <div class="project-section-number">
            03
        </div>

        <div>

            <h2>Location</h2>

            <p>
                Add location details for onsite or hybrid projects.
            </p>

        </div>

    </div>


    <div id="locationFields">

        <div class="location-title">

            <div class="location-title-icon">

                <i class="fas fa-location-dot"></i>

            </div>

            <div>

                <h3>Project Location</h3>

                <p>
                    Location is only required when applicable.
                </p>

            </div>

        </div>


        <div class="project-form-row">


            {{-- COUNTRY --}}

            <div class="project-form-group">

                <label
                    for="country"
                    class="project-label"
                >

                    <i class="fas fa-globe"></i>

                    Country

                </label>


                <div class="project-input-wrap">

                    <i class="fas fa-globe project-input-icon"></i>

                    <input
                        type="text"
                        id="country"
                        name="country"
                        class="project-input has-icon @error('country') is-invalid @enderror"
                        value="{{ old('country', $project->country ?? '') }}"
                        placeholder="e.g. India"
                    >

                </div>


                @error('country')

                    <div class="project-invalid-feedback">
                        {{ $message }}
                    </div>

                @enderror

            </div>



            {{-- STATE --}}

            <div class="project-form-group">

                <label
                    for="state"
                    class="project-label"
                >

                    <i class="fas fa-map"></i>

                    State

                </label>


                <div class="project-input-wrap">

                    <i class="fas fa-map project-input-icon"></i>

                    <input
                        type="text"
                        id="state"
                        name="state"
                        class="project-input has-icon @error('state') is-invalid @enderror"
                        value="{{ old('state', $project->state ?? '') }}"
                        placeholder="e.g. Kerala"
                    >

                </div>


                @error('state')

                    <div class="project-invalid-feedback">
                        {{ $message }}
                    </div>

                @enderror

            </div>



            {{-- DISTRICT --}}

            <div class="project-form-group">

                <label
                    for="district"
                    class="project-label"
                >

                    <i class="fas fa-map-location-dot"></i>

                    District

                </label>


                <div class="project-input-wrap">

                    <i class="fas fa-map-location-dot project-input-icon"></i>

                    <input
                        type="text"
                        id="district"
                        name="district"
                        class="project-input has-icon @error('district') is-invalid @enderror"
                        value="{{ old('district', $project->district ?? '') }}"
                        placeholder="e.g. Kasaragod"
                    >

                </div>


                @error('district')

                    <div class="project-invalid-feedback">
                        {{ $message }}
                    </div>

                @enderror

            </div>



            {{-- CITY --}}

            <div class="project-form-group">

                <label
                    for="city"
                    class="project-label"
                >

                    <i class="fas fa-city"></i>

                    City

                </label>


                <div class="project-input-wrap">

                    <i class="fas fa-city project-input-icon"></i>

                    <input
                        type="text"
                        id="city"
                        name="city"
                        class="project-input has-icon @error('city') is-invalid @enderror"
                        value="{{ old('city', $project->city ?? '') }}"
                        placeholder="e.g. Kanhangad"
                    >

                </div>


                @error('city')

                    <div class="project-invalid-feedback">
                        {{ $message }}
                    </div>

                @enderror

            </div>

        </div>

    </div>

</div>



<div class="project-section-divider"></div>



{{-- =========================================================
     04 DESCRIPTION
========================================================= --}}

<div class="project-section">

    <div class="project-section-heading">

        <div class="project-section-number">
            04
        </div>

        <div>

            <h2>Project Description</h2>

            <p>
                Explain the work, requirements and expected outcome.
            </p>

        </div>

    </div>


    <div class="project-form-group">

        <label
            for="description"
            class="project-label"
        >

            <i class="fas fa-align-left"></i>

            Description

            <span class="project-required">*</span>

        </label>


        <textarea
            id="description"
            name="description"
            class="project-textarea @error('description') is-invalid @enderror"
            rows="6"
            placeholder="Describe the project, responsibilities, deliverables, requirements and expectations..."
            required
        >{{ old('description', $project->description ?? '') }}</textarea>


        @error('description')

            <div class="project-invalid-feedback">
                {{ $message }}
            </div>

        @else

            <div class="project-help-text">

                <i class="fas fa-circle-info"></i>

                Give enough information so professionals can understand the project before applying.

            </div>

        @enderror

    </div>

</div>
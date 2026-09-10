@csrf

@if($training->exists)
    @method('PUT')
@endif

@push('styles')
<style>
    :root {
        --wz-primary: #315FE8;
        --wz-primary-dark: #2449C7;
        --wz-primary-light: #EEF3FF;
        --wz-green: #059669;
        --wz-border: #E7EAF0;
        --wz-radius: 14px;
        --wz-shadow: 0 1px 3px rgba(16,24,40,.06), 0 4px 12px rgba(16,24,40,.04);
    }

    /* ---- Shell / grid ---- */
    .wizard-shell {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 320px;
        gap: 24px;
        align-items: start;
    }
    .wizard-main { min-width: 0; }
    .wizard-sidebar { position: sticky; top: 20px; }

    /* ---- Step nav pills ---- */
    .wizard-steps-nav {
        display: flex;
        align-items: flex-start;
        gap: 0;
        margin-bottom: 30px;
        overflow-x: auto;
        padding-bottom: 6px;
    }
    .wizard-step-pill {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 6px;
        flex: 1;
        min-width: 84px;
        position: relative;
        cursor: pointer;
        background: none;
        border: none;
        padding: 0;
    }
    .wizard-step-pill:not(:last-child)::after {
        content: '';
        position: absolute;
        top: 17px;
        left: 56%;
        width: 100%;
        height: 2px;
        background: #E5E7EB;
        z-index: 0;
    }
    .wizard-step-pill.completed:not(:last-child)::after { background: var(--wz-primary); }
    .wizard-step-circle {
        width: 34px; height: 34px; border-radius: 50%;
        background: #F3F4F6; color: #9CA3AF;
        display: flex; align-items: center; justify-content: center;
        font-weight: 700; font-size: 13px; z-index: 1;
        border: 2px solid #F3F4F6; transition: all .2s ease;
    }
    .wizard-step-pill.active .wizard-step-circle { background: var(--wz-primary); border-color: var(--wz-primary); color: #fff; }
    .wizard-step-pill.completed .wizard-step-circle { background: var(--wz-green); border-color: var(--wz-green); color: #fff; }
    .wizard-step-label { font-size: 10.5px; font-weight: 700; color: #9CA3AF; text-align: center; white-space: nowrap; }
    .wizard-step-pill.active .wizard-step-label { color: var(--wz-primary); }
    .wizard-step-pill.completed .wizard-step-label { color: var(--wz-green); }

    /* ---- Step panels ---- */
    .wizard-step { display: none; }
    .wizard-step.active { display: block; animation: wizardFade .25s ease; }
    @keyframes wizardFade {
        from { opacity: 0; transform: translateY(6px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .wizard-nav-buttons {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 4px;
        margin-bottom: 34px;
    }
    .wizard-nav-buttons .spacer { visibility: hidden; }

    /* ---- Sidebar cards ---- */
    .sidebar-card {
        background: #fff;
        border: 1px solid var(--wz-border);
        border-radius: var(--wz-radius);
        box-shadow: var(--wz-shadow);
        padding: 18px;
        margin-bottom: 18px;
    }
    .sidebar-card h6 {
        display: flex; align-items: center; gap: 8px;
        font-size: 13px; font-weight: 700; color: #374151;
        text-transform: uppercase; letter-spacing: .03em;
        margin-bottom: 14px;
    }
    .sidebar-card h6 i { color: var(--wz-primary); }

    .progress-item { display: flex; align-items: center; gap: 10px; padding: 7px 0; font-size: 13px; color: #6B7280; }
    .progress-check {
        width: 20px; height: 20px; border-radius: 50%; border: 2px solid #E5E7EB;
        display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 10.5px; color: transparent;
    }
    .progress-item.done { color: var(--wz-green); font-weight: 600; }
    .progress-item.done .progress-check { background: var(--wz-green); border-color: var(--wz-green); color: #fff; }
    .progress-item.current { color: var(--wz-primary); font-weight: 700; }
    .progress-item.current .progress-check { border-color: var(--wz-primary); color: var(--wz-primary); }

    .approval-score {
        display: flex; align-items: center; justify-content: space-between;
        background: var(--wz-primary-light); border-radius: 10px; padding: 10px 12px; margin-bottom: 14px;
        font-size: 12.5px; font-weight: 700; color: var(--wz-primary);
    }

    .tip-item { display: flex; gap: 9px; align-items: flex-start; padding: 8px 0; border-bottom: 1px dashed #F0F2F5; }
    .tip-item:last-child { border-bottom: 0; }
    .tip-checkbox { width: 17px; height: 17px; margin-top: 2px; accent-color: var(--wz-primary); flex-shrink: 0; cursor: pointer; }
    .tip-text { font-size: 12.5px; color: #4B5563; line-height: 1.55; }
    .tip-text.checked { text-decoration: line-through; color: #9CA3AF; }

    .sidebar-note {
        font-size: 12px; color: #6B7280; background: #F8FAFF; border-radius: 10px; padding: 10px 12px; line-height: 1.6;
    }

    @media (max-width: 991px) {
        .wizard-shell { grid-template-columns: 1fr; }
        .wizard-sidebar { position: static; order: -1; }
    }
</style>
@endpush


<div class="wizard-shell">

    <div class="wizard-main">

        {{-- ===================== STEP NAV ===================== --}}
        <div class="wizard-steps-nav" id="wizard-steps-nav">
            @foreach ([
                1 => ['icon' => 'bi-info-circle', 'label' => 'Basic Info'],
                2 => ['icon' => 'bi-sliders', 'label' => 'Details'],
                3 => ['icon' => 'bi-lightbulb', 'label' => 'Outcomes'],
                4 => ['icon' => 'bi-list-check', 'label' => 'Requirements'],
                5 => ['icon' => 'bi-diagram-3', 'label' => 'Curriculum'],
                6 => ['icon' => 'bi-folder2-open', 'label' => 'Resources'],
                7 => ['icon' => 'bi-camera-video', 'label' => 'Live Details'],
                8 => ['icon' => 'bi-patch-check', 'label' => 'Certificate'],
            ] as $stepNum => $stepInfo)
                <button type="button" class="wizard-step-pill {{ $stepNum === 1 ? 'active' : '' }}" data-step="{{ $stepNum }}">
                    <span class="wizard-step-circle"><i class="bi {{ $stepInfo['icon'] }}"></i></span>
                    <span class="wizard-step-label">{{ $stepInfo['label'] }}</span>
                </button>
            @endforeach
        </div>


        {{-- =========================================================
             STEP 1: BASIC INFORMATION
        ========================================================= --}}

        <div class="wizard-step active" data-step-content="1">
            <div class="card mb-4 shadow-sm">

                <div class="card-header fw-bold">
                    <i class="bi bi-info-circle"></i>
                    1. Basic Information
                </div>

                <div class="card-body row g-3">

                    <div class="col-md-6">
                        <label class="form-label">
                            Training Title <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="title"
                            class="form-control"
                            value="{{ old('title', $training->title) }}"
                            required
                        >
                    </div>


                    <div class="col-md-6">
                        <label class="form-label">
                            Category <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="category"
                            class="form-control"
                            value="{{ old('category', $training->category) }}"
                            required
                        >
                    </div>


                    <div class="col-12">
                        <label class="form-label">
                            Short Description <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="short_description"
                            maxlength="500"
                            class="form-control"
                            value="{{ old('short_description', $training->short_description) }}"
                            required
                        >
                    </div>


                    <div class="col-12">
                        <label class="form-label">
                            Full Description <span class="text-danger">*</span>
                        </label>

                        <textarea
                            name="full_description"
                            rows="5"
                            class="form-control"
                            required
                        >{{ old('full_description', $training->full_description) }}</textarea>
                    </div>


                    <div class="col-md-4">
                        <label class="form-label">
                            Technology / Skill <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="technology"
                            class="form-control"
                            value="{{ old('technology', $training->technology) }}"
                            required
                        >
                    </div>


                    <div class="col-md-4">
                        <label class="form-label">
                            Level <span class="text-danger">*</span>
                        </label>

                        <select name="level" class="form-select" required>

                            @foreach([
                                'beginner' => 'Beginner',
                                'intermediate' => 'Intermediate',
                                'advanced' => 'Advanced'
                            ] as $val => $label)

                                <option
                                    value="{{ $val }}"
                                    @selected(old('level', $training->level) === $val)
                                >
                                    {{ $label }}
                                </option>

                            @endforeach

                        </select>
                    </div>


                    <div class="col-md-4">
                        <label class="form-label">
                            Training Type <span class="text-danger">*</span>
                        </label>

                        <select
                            name="training_type"
                            id="training_type"
                            class="form-select"
                            required
                        >

                            @foreach([
                                'recorded' => 'Recorded',
                                'live' => 'Live',
                                'hybrid' => 'Hybrid'
                            ] as $val => $label)

                                <option
                                    value="{{ $val }}"
                                    @selected(old('training_type', $training->training_type) === $val)
                                >
                                    {{ $label }}
                                </option>

                            @endforeach

                        </select>
                    </div>


                    <div class="col-12">

                        <label class="form-label">
                            Thumbnail <span class="text-danger">*</span>
                        </label>

                        <input
                            type="file"
                            name="thumbnail"
                            accept="image/*"
                            class="form-control"
                            {{ $training->exists ? '' : 'required' }}
                        >

                        @if($training->thumbnail)

                            <div class="mt-2">
                                <img
                                    src="{{ asset('storage/'.$training->thumbnail) }}"
                                    class="rounded border"
                                    height="80"
                                    alt="Current thumbnail"
                                >
                            </div>

                        @endif

                    </div>

                </div>
            </div>

            <div class="wizard-nav-buttons">
                <span class="spacer"></span>
                <button type="button" class="btn btn-primary wizard-next">
                    Next <i class="bi bi-arrow-right"></i>
                </button>
            </div>
        </div>


        {{-- =========================================================
             STEP 2: TRAINING DETAILS
        ========================================================= --}}

        <div class="wizard-step" data-step-content="2">
            <div class="card mb-4 shadow-sm">

                <div class="card-header fw-bold">
                    <i class="bi bi-sliders"></i>
                    2. Training Details
                </div>

                <div class="card-body row g-3">

                    <div class="col-md-3">
                        <label class="form-label">
                            Duration <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="duration"
                            class="form-control"
                            placeholder="e.g. 6 Weeks"
                            value="{{ old('duration', $training->duration) }}"
                            required
                        >
                    </div>


                    <div class="col-md-3">
                        <label class="form-label">
                            Total Sessions <span class="text-danger">*</span>
                        </label>

                        <input
                            type="number"
                            min="1"
                            name="total_sessions"
                            class="form-control"
                            value="{{ old('total_sessions', $training->total_sessions) }}"
                            required
                        >
                    </div>


                    <div class="col-md-3">
                        <label class="form-label">
                            Session Duration <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="session_duration"
                            class="form-control"
                            placeholder="e.g. 1.5 hrs"
                            value="{{ old('session_duration', $training->session_duration) }}"
                            required
                        >
                    </div>


                    <div class="col-md-3">
                        <label class="form-label">
                            Language <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="language"
                            class="form-control"
                            value="{{ old('language', $training->language ?? '') }}"
                            required
                        >
                    </div>


                    <div class="col-md-4">
                        <label class="form-label">Start Date</label>

                        <input
                            type="date"
                            name="start_date"
                            class="form-control"
                            value="{{ old('start_date', optional($training->start_date)->format('Y-m-d')) }}"
                        >
                    </div>


                    <div class="col-md-4">
                        <label class="form-label">End Date</label>

                        <input
                            type="date"
                            name="end_date"
                            class="form-control"
                            value="{{ old('end_date', optional($training->end_date)->format('Y-m-d')) }}"
                        >
                    </div>


                    <div class="col-md-4">
                        <label class="form-label">Maximum Participants</label>

                        <input
                            type="number"
                            min="1"
                            name="max_participants"
                            class="form-control"
                            value="{{ old('max_participants', $training->max_participants) }}"
                        >
                    </div>

                </div>
            </div>

            <div class="wizard-nav-buttons">
                <button type="button" class="btn btn-outline-secondary wizard-prev">
                    <i class="bi bi-arrow-left"></i> Previous
                </button>
                <button type="button" class="btn btn-primary wizard-next">
                    Next <i class="bi bi-arrow-right"></i>
                </button>
            </div>
        </div>


        {{-- =========================================================
             STEP 3: WHAT YOU'LL LEARN
        ========================================================= --}}

        <div class="wizard-step" data-step-content="3">
            <div class="card mb-4 shadow-sm">

                <div class="card-header fw-bold">
                    <i class="bi bi-lightbulb"></i>
                    3. What You'll Learn
                </div>

                <div class="card-body">

                    <div id="outcomes-wrapper">

                        @php
                            $oldOutcomes = old(
                                'outcomes',
                                $training->outcomes->pluck('outcome')->toArray() ?: ['']
                            );
                        @endphp

                        @foreach($oldOutcomes as $outcome)

                            <div class="input-group mb-2 outcome-row">

                                <input
                                    type="text"
                                    name="outcomes[]"
                                    class="form-control"
                                    placeholder="Learning outcome"
                                    value="{{ $outcome }}"
                                >

                                <button
                                    type="button"
                                    class="btn btn-outline-danger remove-row"
                                >
                                    <i class="bi bi-trash"></i>
                                </button>

                            </div>

                        @endforeach

                    </div>


                    <button
                        type="button"
                        class="btn btn-sm btn-outline-primary"
                        id="add-outcome"
                    >
                        <i class="bi bi-plus-circle"></i>
                        Add Outcome
                    </button>

                </div>
            </div>

            <div class="wizard-nav-buttons">
                <button type="button" class="btn btn-outline-secondary wizard-prev">
                    <i class="bi bi-arrow-left"></i> Previous
                </button>
                <button type="button" class="btn btn-primary wizard-next">
                    Next <i class="bi bi-arrow-right"></i>
                </button>
            </div>
        </div>


        {{-- =========================================================
             STEP 4: REQUIREMENTS
        ========================================================= --}}

        <div class="wizard-step" data-step-content="4">
            <div class="card mb-4 shadow-sm">

                <div class="card-header fw-bold">
                    <i class="bi bi-list-check"></i>
                    4. Requirements
                </div>

                <div class="card-body">

                    <div id="requirements-wrapper">

                        @php
                            $oldReqs = old(
                                'requirements',
                                $training->requirements->pluck('requirement')->toArray() ?: ['']
                            );
                        @endphp

                        @foreach($oldReqs as $req)

                            <div class="input-group mb-2 requirement-row">

                                <input
                                    type="text"
                                    name="requirements[]"
                                    class="form-control"
                                    placeholder="Prerequisite"
                                    value="{{ $req }}"
                                >

                                <button
                                    type="button"
                                    class="btn btn-outline-danger remove-row"
                                >
                                    <i class="bi bi-trash"></i>
                                </button>

                            </div>

                        @endforeach

                    </div>


                    <button
                        type="button"
                        class="btn btn-sm btn-outline-primary"
                        id="add-requirement"
                    >
                        <i class="bi bi-plus-circle"></i>
                        Add Requirement
                    </button>

                </div>
            </div>

            <div class="wizard-nav-buttons">
                <button type="button" class="btn btn-outline-secondary wizard-prev">
                    <i class="bi bi-arrow-left"></i> Previous
                </button>
                <button type="button" class="btn btn-primary wizard-next">
                    Next <i class="bi bi-arrow-right"></i>
                </button>
            </div>
        </div>


        {{-- =========================================================
             STEP 5: CURRICULUM
        ========================================================= --}}

        <div class="wizard-step" data-step-content="5">
            <div class="card mb-4 shadow-sm">

                <div class="card-header fw-bold">
                    <i class="bi bi-diagram-3"></i>
                    5. Curriculum
                </div>

                <div class="card-body">

                    <div id="modules-wrapper">

                        @forelse($training->modules as $mi => $module)

                            @include(
                                'mentor.trainings._module-row',
                                [
                                    'mi' => $mi,
                                    'module' => $module
                                ]
                            )

                        @empty

                            @include(
                                'mentor.trainings._module-row',
                                [
                                    'mi' => 0,
                                    'module' => null
                                ]
                            )

                        @endforelse

                    </div>


                    <button
                        type="button"
                        class="btn btn-sm btn-outline-primary"
                        id="add-module"
                    >
                        <i class="bi bi-plus-circle"></i>
                        Add Module
                    </button>

                </div>
            </div>

            <div class="wizard-nav-buttons">
                <button type="button" class="btn btn-outline-secondary wizard-prev">
                    <i class="bi bi-arrow-left"></i> Previous
                </button>
                <button type="button" class="btn btn-primary wizard-next">
                    Next <i class="bi bi-arrow-right"></i>
                </button>
            </div>
        </div>


        {{-- =========================================================
             STEP 6: TRAINING RESOURCES
        ========================================================= --}}

        <div class="wizard-step" data-step-content="6">
            <div class="card mb-4 shadow-sm">

                <div class="card-header fw-bold">
                    <i class="bi bi-folder2-open"></i>
                    6. Training Resources
                </div>

                <div class="card-body">

                    <label class="form-label">
                        PDF / Documents
                        <small class="text-muted">
                            (You can select multiple files)
                        </small>
                    </label>

                    <input
                        type="file"
                        name="resources[]"
                        class="form-control"
                        multiple
                        accept=".pdf,.doc,.docx"
                    >


                    @if($training->resources->count())

                        <ul class="list-group mt-3">

                            @foreach($training->resources as $resource)

                                <li class="list-group-item d-flex justify-content-between">

                                    <span>
                                        <i class="bi bi-file-earmark"></i>
                                        {{ $resource->title }}
                                    </span>

                                    <a
                                        href="{{ asset('storage/'.$resource->file_path) }}"
                                        target="_blank"
                                    >
                                        View
                                    </a>

                                </li>

                            @endforeach

                        </ul>

                    @endif

                </div>
            </div>

            <div class="wizard-nav-buttons">
                <button type="button" class="btn btn-outline-secondary wizard-prev">
                    <i class="bi bi-arrow-left"></i> Previous
                </button>
                <button type="button" class="btn btn-primary wizard-next">
                    Next <i class="bi bi-arrow-right"></i>
                </button>
            </div>
        </div>


        {{-- =========================================================
             STEP 7: LIVE TRAINING DETAILS
        ========================================================= --}}

        <div class="wizard-step" data-step-content="7">
            <div class="card mb-4 shadow-sm">

                <div class="card-header fw-bold">
                    <i class="bi bi-camera-video"></i>
                    7. Live Training Details
                </div>

                <div class="card-body">

                    <div id="live-details-note" class="sidebar-note mb-3" style="display:none;">
                        <i class="bi bi-info-circle me-1"></i>
                        This section only applies to <strong>Live</strong> or <strong>Hybrid</strong> trainings.
                        You picked a different training type in Step 2, so you can leave this blank and move on.
                    </div>

                    <div id="live-details-fields" class="row g-3">

                        <div class="col-md-4">

                            <label class="form-label">
                                Platform
                            </label>

                            <input
                                type="text"
                                name="platform"
                                class="form-control"
                                placeholder="Zoom / Google Meet / MS Teams"
                                value="{{ old('platform', $training->platform) }}"
                            >

                        </div>


                        <div class="col-md-4">

                            <label class="form-label">
                                Meeting Link
                            </label>

                            <input
                                type="url"
                                name="meeting_link"
                                class="form-control"
                                placeholder="https://..."
                                value="{{ old('meeting_link', $training->meeting_link) }}"
                            >

                        </div>


                        <div class="col-md-4">

                            <label class="form-label">
                                Schedule
                            </label>

                            <input
                                type="text"
                                name="schedule"
                                class="form-control"
                                placeholder="e.g. Mon/Wed 7 PM IST"
                                value="{{ old('schedule', $training->schedule) }}"
                            >

                        </div>

                    </div>

                </div>
            </div>

            <div class="wizard-nav-buttons">
                <button type="button" class="btn btn-outline-secondary wizard-prev">
                    <i class="bi bi-arrow-left"></i> Previous
                </button>
                <button type="button" class="btn btn-primary wizard-next">
                    Next <i class="bi bi-arrow-right"></i>
                </button>
            </div>
        </div>


        {{-- =========================================================
             STEP 8: CERTIFICATE & REVIEW
        ========================================================= --}}

        <div class="wizard-step" data-step-content="8">
            <div class="card mb-4 shadow-sm">

                <div class="card-header fw-bold">
                    <i class="bi bi-patch-check"></i>
                    8. Certificate
                </div>

                <div class="card-body">

                    <div class="form-check form-switch">

                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="certificate_enabled"
                            value="1"
                            id="certificate_enabled"
                            {{ old('certificate_enabled', $training->certificate_enabled) ? 'checked' : '' }}
                        >

                        <label
                            class="form-check-label"
                            for="certificate_enabled"
                        >
                            Enable Certificate on completion
                        </label>

                    </div>

                </div>

            </div>

            <div class="card mb-4 shadow-sm border-0" style="background:#F8FAFF;">
                <div class="card-body d-flex align-items-start gap-3">
                    <i class="bi bi-check-circle-fill text-success fs-4"></i>
                    <div class="small text-muted">
                        You're on the last step. Double-check the tips in the sidebar, then either save your progress
                        as a draft or submit the training for admin approval below.
                    </div>
                </div>
            </div>

            <div class="wizard-nav-buttons">
                <button type="button" class="btn btn-outline-secondary wizard-prev">
                    <i class="bi bi-arrow-left"></i> Previous
                </button>
                <span class="spacer"></span>
            </div>

            {{-- =========================================================
                 ACTION BUTTONS
            ========================================================= --}}

            <div class="d-flex gap-2 justify-content-end bg-white py-3 border-top">

                <button
                    type="submit"
                    name="action"
                    value="draft"
                    class="btn btn-outline-secondary"
                >
                    <i class="bi bi-save"></i>
                    Save as Draft
                </button>


                <button
                    type="submit"
                    name="action"
                    value="submit"
                    class="btn btn-success"
                >
                    <i class="bi bi-send-check"></i>
                    Submit for Admin Approval
                </button>

            </div>
        </div>

    </div>


    {{-- =========================================================
         SIDEBAR
    ========================================================= --}}

    <div class="wizard-sidebar">

        {{-- PROGRESS --}}
        <div class="sidebar-card">
            <h6><i class="bi bi-list-ol"></i> Your Progress</h6>

            <div class="approval-score">
                <span>Step <span id="progress-current">1</span> of 8</span>
                <span id="progress-percent">13%</span>
            </div>

            @foreach ([
                1 => 'Basic Information',
                2 => 'Training Details',
                3 => "What You'll Learn",
                4 => 'Requirements',
                5 => 'Curriculum',
                6 => 'Training Resources',
                7 => 'Live Training Details',
                8 => 'Certificate & Review',
            ] as $stepNum => $stepLabel)
                <div class="progress-item {{ $stepNum === 1 ? 'current' : '' }}" data-step="{{ $stepNum }}">
                    <span class="progress-check"><i class="bi bi-check-lg"></i></span>
                    <span>{{ $stepLabel }}</span>
                </div>
            @endforeach
        </div>


        {{-- APPROVAL TIPS --}}
        <div class="sidebar-card">
            <h6><i class="bi bi-shield-check"></i> Get Approved Faster</h6>

            @foreach ([
                'Use a clear, benefit-driven title that says what learners will gain',
                'Keep the short description under 160 characters and specific',
                'Upload a high-quality, well-lit thumbnail (16:9 works best)',
                'Break curriculum into small, focused modules and sessions',
                'List at least 3 concrete learning outcomes',
                'Mention any prerequisites so learners self-select correctly',
                'Attach at least one supporting resource (slides, notes, etc.)',
                'Double-check live session links before submitting',
            ] as $i => $tip)
                <label class="tip-item">
                    <input type="checkbox" class="tip-checkbox" data-tip-index="{{ $i }}">
                    <span class="tip-text">{{ $tip }}</span>
                </label>
            @endforeach
        </div>


        {{-- REVIEW TIMELINE NOTE --}}
        <div class="sidebar-card">
            <h6><i class="bi bi-clock-history"></i> What Happens Next</h6>
            <p class="sidebar-note mb-0">
                Once submitted, the admin team typically reviews new trainings within
                1–2 business days. You'll be notified by email if it's approved or if
                changes are requested.
            </p>
        </div>

    </div>

</div>



{{-- =========================================================
     DYNAMIC TEMPLATES
========================================================= --}}

<template id="module-template">

    <div
        class="module-block card mb-3"
        data-mi="__MI__"
    >

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-2">

                <label class="form-label fw-bold mb-0">
                    Module <span class="module-number">__NUMBER__</span>
                </label>

                <button
                    type="button"
                    class="btn btn-sm btn-outline-danger remove-module"
                >
                    <i class="bi bi-trash"></i>
                    Remove Module
                </button>

            </div>


            <input
                type="text"
                name="modules[__MI__][title]"
                class="form-control mb-3"
                placeholder="Module title"
            >


            <div class="sessions-wrapper ps-3 border-start">

                <div
                    class="session-block border rounded p-2 mb-2"
                    data-si="0"
                >

                    <div class="d-flex justify-content-between align-items-center mb-2">

                        <strong class="small">
                            Session 1
                        </strong>

                        <button
                            type="button"
                            class="btn btn-sm btn-outline-danger remove-session"
                        >
                            &times;
                        </button>

                    </div>


                    <input
                        type="text"
                        name="modules[__MI__][sessions][0][title]"
                        class="form-control form-control-sm mb-2"
                        placeholder="Session title"
                    >


                    <textarea
                        name="modules[__MI__][sessions][0][description]"
                        class="form-control form-control-sm mb-2"
                        rows="2"
                        placeholder="Description"
                    ></textarea>


                    <div class="row g-2">

                        <div class="col-md-6">

                            <label class="form-label small mb-1">
                                Video
                            </label>

                            <input
                                type="file"
                                name="modules[__MI__][sessions][0][video]"
                                class="form-control form-control-sm"
                                accept="video/*"
                            >

                        </div>


                        <div class="col-md-6">

                            <label class="form-label small mb-1">
                                PDF
                            </label>

                            <input
                                type="file"
                                name="modules[__MI__][sessions][0][pdf]"
                                class="form-control form-control-sm"
                                accept="application/pdf"
                            >

                        </div>

                    </div>

                </div>

            </div>


            <button
                type="button"
                class="btn btn-sm btn-outline-primary mt-2 add-session"
            >
                <i class="bi bi-plus-circle"></i>
                Add Session
            </button>

        </div>

    </div>

</template>



<template id="session-template">

    <div
        class="session-block border rounded p-2 mb-2"
        data-si="__SI__"
    >

        <div class="d-flex justify-content-between align-items-center mb-2">

            <strong class="small">
                Session __NUMBER__
            </strong>

            <button
                type="button"
                class="btn btn-sm btn-outline-danger remove-session"
            >
                &times;
            </button>

        </div>


        <input
            type="text"
            name="modules[__MI__][sessions][__SI__][title]"
            class="form-control form-control-sm mb-2"
            placeholder="Session title"
        >


        <textarea
            name="modules[__MI__][sessions][__SI__][description]"
            class="form-control form-control-sm mb-2"
            rows="2"
            placeholder="Description"
        ></textarea>


        <div class="row g-2">

            <div class="col-md-6">

                <label class="form-label small mb-1">
                    Video
                </label>

                <input
                    type="file"
                    name="modules[__MI__][sessions][__SI__][video]"
                    class="form-control form-control-sm"
                    accept="video/*"
                >

            </div>


            <div class="col-md-6">

                <label class="form-label small mb-1">
                    PDF
                </label>

                <input
                    type="file"
                    name="modules[__MI__][sessions][__SI__][pdf]"
                    class="form-control form-control-sm"
                    accept="application/pdf"
                >

            </div>

        </div>

    </div>

</template>



{{-- =========================================================
     JAVASCRIPT
========================================================= --}}

@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | WIZARD NAVIGATION
    |--------------------------------------------------------------------------
    */

    const steps = Array.from(document.querySelectorAll('.wizard-step'));
    const pills = Array.from(document.querySelectorAll('.wizard-step-pill'));
    const progressItems = Array.from(document.querySelectorAll('.progress-item'));
    const progressCurrentEl = document.getElementById('progress-current');
    const progressPercentEl = document.getElementById('progress-percent');

    const totalSteps = steps.length;
    let currentStep = 1;
    const completedSteps = new Set();

    function validateStep(stepNumber) {

        const stepEl = document.querySelector(`.wizard-step[data-step-content="${stepNumber}"]`);

        if (!stepEl) {
            return true;
        }

        const fields = stepEl.querySelectorAll('input, select, textarea');

        for (const field of fields) {

            if (field.offsetParent === null) {
                // not visible (e.g. hidden live-details fields), skip
                continue;
            }

            if (!field.checkValidity()) {
                field.reportValidity();
                return false;
            }
        }

        return true;
    }

    function showStep(stepNumber) {

        steps.forEach(function (stepEl) {
            stepEl.classList.toggle(
                'active',
                parseInt(stepEl.dataset.stepContent) === stepNumber
            );
        });

        pills.forEach(function (pill) {
            const pillStep = parseInt(pill.dataset.step);
            pill.classList.toggle('active', pillStep === stepNumber);
            pill.classList.toggle('completed', completedSteps.has(pillStep));
        });

        progressItems.forEach(function (item) {
            const itemStep = parseInt(item.dataset.step);
            item.classList.remove('current', 'done');

            if (completedSteps.has(itemStep)) {
                item.classList.add('done');
            } else if (itemStep === stepNumber) {
                item.classList.add('current');
            }
        });

        currentStep = stepNumber;

        if (progressCurrentEl) {
            progressCurrentEl.textContent = stepNumber;
        }

        if (progressPercentEl) {
            progressPercentEl.textContent = Math.round((stepNumber / totalSteps) * 100) + '%';
        }

        const mainCol = document.querySelector('.wizard-main');

        if (mainCol) {
            window.scrollTo({
                top: mainCol.getBoundingClientRect().top + window.scrollY - 20,
                behavior: 'smooth'
            });
        }
    }

    document.querySelectorAll('.wizard-next').forEach(function (button) {
        button.addEventListener('click', function () {

            if (!validateStep(currentStep)) {
                return;
            }

            completedSteps.add(currentStep);

            if (currentStep < totalSteps) {
                showStep(currentStep + 1);
            }
        });
    });

    document.querySelectorAll('.wizard-prev').forEach(function (button) {
        button.addEventListener('click', function () {
            if (currentStep > 1) {
                showStep(currentStep - 1);
            }
        });
    });

    pills.forEach(function (pill) {
        pill.addEventListener('click', function () {

            const targetStep = parseInt(pill.dataset.step);

            const canJump =
                targetStep <= currentStep ||
                completedSteps.has(targetStep - 1) ||
                targetStep === 1;

            if (canJump) {
                showStep(targetStep);
            }
        });
    });

    showStep(1);



    /*
    |--------------------------------------------------------------------------
    | TRAINING TYPE -> LIVE DETAILS TOGGLE
    |--------------------------------------------------------------------------
    */

    const trainingType = document.getElementById('training_type');
    const liveFields = document.getElementById('live-details-fields');
    const liveNote = document.getElementById('live-details-note');

    function updateLiveDetails() {

        if (!trainingType || !liveFields || !liveNote) {
            return;
        }

        if (
            trainingType.value === 'live' ||
            trainingType.value === 'hybrid'
        ) {
            liveFields.style.display = '';
            liveNote.style.display = 'none';
        } else {
            liveFields.style.display = 'none';
            liveNote.style.display = 'block';
        }
    }

    if (trainingType) {

        trainingType.addEventListener(
            'change',
            updateLiveDetails
        );

        updateLiveDetails();
    }



    /*
    |--------------------------------------------------------------------------
    | ADD OUTCOME
    |--------------------------------------------------------------------------
    */

    const addOutcomeButton =
        document.getElementById('add-outcome');

    const outcomesWrapper =
        document.getElementById('outcomes-wrapper');

    if (addOutcomeButton && outcomesWrapper) {

        addOutcomeButton.addEventListener('click', function () {

            const row =
                document.createElement('div');

            row.className =
                'input-group mb-2 outcome-row';

            row.innerHTML = `
                <input
                    type="text"
                    name="outcomes[]"
                    class="form-control"
                    placeholder="Learning outcome"
                >

                <button
                    type="button"
                    class="btn btn-outline-danger remove-row"
                >
                    <i class="bi bi-trash"></i>
                </button>
            `;

            outcomesWrapper.appendChild(row);

        });

    }



    /*
    |--------------------------------------------------------------------------
    | ADD REQUIREMENT
    |--------------------------------------------------------------------------
    */

    const addRequirementButton =
        document.getElementById('add-requirement');

    const requirementsWrapper =
        document.getElementById('requirements-wrapper');

    if (addRequirementButton && requirementsWrapper) {

        addRequirementButton.addEventListener('click', function () {

            const row =
                document.createElement('div');

            row.className =
                'input-group mb-2 requirement-row';

            row.innerHTML = `
                <input
                    type="text"
                    name="requirements[]"
                    class="form-control"
                    placeholder="Prerequisite"
                >

                <button
                    type="button"
                    class="btn btn-outline-danger remove-row"
                >
                    <i class="bi bi-trash"></i>
                </button>
            `;

            requirementsWrapper.appendChild(row);

        });

    }



    /*
    |--------------------------------------------------------------------------
    | MODULE INDEX
    |--------------------------------------------------------------------------
    */

    const modulesWrapper =
        document.getElementById('modules-wrapper');

    const moduleTemplate =
        document.getElementById('module-template');

    const sessionTemplate =
        document.getElementById('session-template');

    const addModuleButton =
        document.getElementById('add-module');


    let moduleIndex = 0;


    /*
    |--------------------------------------------------------------------------
    | FIND NEXT MODULE INDEX
    |--------------------------------------------------------------------------
    */

    function getNextModuleIndex() {

        let highest = -1;

        const modules =
            modulesWrapper.querySelectorAll('.module-block');

        modules.forEach(function (module) {

            const value =
                parseInt(module.dataset.mi);

            if (!isNaN(value) && value > highest) {
                highest = value;
            }

        });

        return highest + 1;
    }



    /*
    |--------------------------------------------------------------------------
    | RENUMBER MODULE DISPLAY
    |--------------------------------------------------------------------------
    */

    function refreshModuleNumbers() {

        const modules =
            modulesWrapper.querySelectorAll('.module-block');

        modules.forEach(function (module, index) {

            const number =
                module.querySelector('.module-number');

            if (number) {
                number.textContent = index + 1;
            }

        });

    }



    /*
    |--------------------------------------------------------------------------
    | ADD MODULE
    |--------------------------------------------------------------------------
    */

    if (
        addModuleButton &&
        modulesWrapper &&
        moduleTemplate
    ) {

        addModuleButton.addEventListener(
            'click',
            function () {

                moduleIndex =
                    getNextModuleIndex();

                let html =
                    moduleTemplate.innerHTML;

                html =
                    html.replaceAll(
                        '__MI__',
                        moduleIndex
                    );

                html =
                    html.replaceAll(
                        '__NUMBER__',
                        modulesWrapper.querySelectorAll(
                            '.module-block'
                        ).length + 1
                    );


                const temp =
                    document.createElement('div');

                temp.innerHTML =
                    html.trim();


                const moduleBlock =
                    temp.firstElementChild;


                modulesWrapper.appendChild(
                    moduleBlock
                );


                moduleIndex++;

                refreshModuleNumbers();

            }
        );

    }



    /*
    |--------------------------------------------------------------------------
    | ADD SESSION
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        'click',
        function (event) {

            const addSessionButton =
                event.target.closest('.add-session');

            if (!addSessionButton) {
                return;
            }


            const moduleBlock =
                addSessionButton.closest('.module-block');

            if (!moduleBlock) {
                return;
            }


            const sessionsWrapper =
                moduleBlock.querySelector(
                    '.sessions-wrapper'
                );

            if (!sessionsWrapper || !sessionTemplate) {
                return;
            }


            const moduleIndexValue =
                moduleBlock.dataset.mi;


            /*
             * Find the next available session index.
             */

            let highestSessionIndex = -1;

            sessionsWrapper
                .querySelectorAll('.session-block')
                .forEach(function (session) {

                    const value =
                        parseInt(session.dataset.si);

                    if (
                        !isNaN(value) &&
                        value > highestSessionIndex
                    ) {
                        highestSessionIndex = value;
                    }

                });


            const sessionIndex =
                highestSessionIndex + 1;


            const sessionNumber =
                sessionsWrapper.querySelectorAll(
                    '.session-block'
                ).length + 1;


            let html =
                sessionTemplate.innerHTML;


            html =
                html.replaceAll(
                    '__MI__',
                    moduleIndexValue
                );


            html =
                html.replaceAll(
                    '__SI__',
                    sessionIndex
                );


            html =
                html.replaceAll(
                    '__NUMBER__',
                    sessionNumber
                );


            const temp =
                document.createElement('div');

            temp.innerHTML =
                html.trim();


            const sessionBlock =
                temp.firstElementChild;


            sessionsWrapper.appendChild(
                sessionBlock
            );

        }
    );



    /*
    |--------------------------------------------------------------------------
    | REMOVE MODULE
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        'click',
        function (event) {

            const button =
                event.target.closest('.remove-module');

            if (!button) {
                return;
            }


            const moduleBlock =
                button.closest('.module-block');

            if (!moduleBlock) {
                return;
            }


            const modules =
                modulesWrapper.querySelectorAll(
                    '.module-block'
                );


            /*
             * Keep at least one module.
             */

            if (modules.length <= 1) {

                alert(
                    'At least one module is required.'
                );

                return;
            }


            moduleBlock.remove();

            refreshModuleNumbers();

        }
    );



    /*
    |--------------------------------------------------------------------------
    | REMOVE SESSION
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        'click',
        function (event) {

            const button =
                event.target.closest('.remove-session');

            if (!button) {
                return;
            }


            const sessionBlock =
                button.closest('.session-block');

            if (!sessionBlock) {
                return;
            }


            const moduleBlock =
                button.closest('.module-block');

            if (!moduleBlock) {
                return;
            }


            const sessionsWrapper =
                moduleBlock.querySelector(
                    '.sessions-wrapper'
                );


            const sessions =
                sessionsWrapper.querySelectorAll(
                    '.session-block'
                );


            /*
             * Keep at least one session.
             */

            if (sessions.length <= 1) {

                alert(
                    'At least one session is required.'
                );

                return;
            }


            sessionBlock.remove();


            /*
             * Update visible session numbers.
             */

            sessionsWrapper
                .querySelectorAll('.session-block')
                .forEach(function (session, index) {

                    const title =
                        session.querySelector('strong');

                    if (title) {
                        title.textContent =
                            'Session ' + (index + 1);
                    }

                });

        }
    );



    /*
    |--------------------------------------------------------------------------
    | REMOVE OUTCOME / REQUIREMENT
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        'click',
        function (event) {

            const button =
                event.target.closest('.remove-row');

            if (!button) {
                return;
            }


            const row =
                button.closest('.input-group');

            if (!row) {
                return;
            }


            const wrapper =
                row.parentElement;


            const rows =
                wrapper.querySelectorAll(
                    '.input-group'
                );


            /*
             * Keep one empty row.
             */

            if (rows.length <= 1) {

                const input =
                    row.querySelector('input');

                if (input) {
                    input.value = '';
                }

                return;
            }


            row.remove();

        }
    );



    /*
    |--------------------------------------------------------------------------
    | APPROVAL TIPS CHECKLIST (cosmetic, saved locally per browser)
    |--------------------------------------------------------------------------
    */

    document.querySelectorAll('.tip-checkbox').forEach(function (checkbox) {

        const key = 'training_tip_' + checkbox.dataset.tipIndex;
        const textEl = checkbox.closest('.tip-item').querySelector('.tip-text');

        checkbox.checked = window.localStorage.getItem(key) === '1';

        if (checkbox.checked && textEl) {
            textEl.classList.add('checked');
        }

        checkbox.addEventListener('change', function () {

            window.localStorage.setItem(key, checkbox.checked ? '1' : '0');

            if (textEl) {
                textEl.classList.toggle('checked', checkbox.checked);
            }

        });

    });



    /*
    |--------------------------------------------------------------------------
    | INITIALIZE
    |--------------------------------------------------------------------------
    */

    refreshModuleNumbers();

});

</script>

@endpush
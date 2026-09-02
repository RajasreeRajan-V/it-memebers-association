@csrf

@if($training->exists)
    @method('PUT')
@endif


{{-- =========================================================
     1. BASIC INFORMATION
========================================================= --}}

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



{{-- =========================================================
     2. TRAINING DETAILS
========================================================= --}}

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



{{-- =========================================================
     3. WHAT YOU'LL LEARN
========================================================= --}}

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



{{-- =========================================================
     4. REQUIREMENTS
========================================================= --}}

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



{{-- =========================================================
     5. CURRICULUM
========================================================= --}}

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



{{-- =========================================================
     6. TRAINING RESOURCES
========================================================= --}}

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



{{-- =========================================================
     7. LIVE TRAINING DETAILS
========================================================= --}}

<div
    class="card mb-4 shadow-sm"
    id="live-details"
    style="
        {{
            old('training_type', $training->training_type) === 'live'
            || old('training_type', $training->training_type) === 'hybrid'
            ? ''
            : 'display:none;'
        }}
    "
>

    <div class="card-header fw-bold">
        <i class="bi bi-camera-video"></i>
        7. Live Training Details
    </div>

    <div class="card-body row g-3">

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



{{-- =========================================================
     8. CERTIFICATE
========================================================= --}}

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



{{-- =========================================================
     ACTION BUTTONS
========================================================= --}}

<div class="d-flex gap-2 justify-content-end sticky-bottom bg-white py-3 border-top">

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
    | TRAINING TYPE
    |--------------------------------------------------------------------------
    */

    const trainingType = document.getElementById('training_type');
    const liveDetails = document.getElementById('live-details');

    function updateLiveDetails() {

        if (!trainingType || !liveDetails) {
            return;
        }

        if (
            trainingType.value === 'live' ||
            trainingType.value === 'hybrid'
        ) {
            liveDetails.style.display = '';
        } else {
            liveDetails.style.display = 'none';
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
    | INITIALIZE
    |--------------------------------------------------------------------------
    */

    refreshModuleNumbers();

});

</script>

@endpush
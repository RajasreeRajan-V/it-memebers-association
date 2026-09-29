@php
    $internship = $internship ?? null;

    /*
    |--------------------------------------------------------------------------
    | Current Internship Type
    |--------------------------------------------------------------------------
    */

    $currentInternshipType = old(
        'internship_type',
        $internship->internship_type ?? ''
    );

    /*
    |--------------------------------------------------------------------------
    | Current Stipend
    |--------------------------------------------------------------------------
    */

    $currentStipend = old(
        'stipend',
        $internship->stipend ?? ''
    );
@endphp


{{-- =========================================================
     BASIC INFORMATION
========================================================= --}}

<div class="form-section">

    <div class="form-section-heading">

        <div class="form-section-number">
            01
        </div>

        <div>

            <h3>Basic Information</h3>

            <p>
                Tell candidates what this internship is about.
            </p>

        </div>

    </div>


    {{-- =====================================================
         TITLE
    ====================================================== --}}

    <div class="form-group-custom full-width">

        <label for="title">

            Internship Title

            <span class="required">
                *
            </span>

        </label>


        <div class="input-wrapper">

            <i class="fas fa-heading"></i>

            <input
                type="text"
                id="title"
                name="title"
                class="form-control-custom @error('title') is-invalid @enderror"
                value="{{ old('title', $internship->title ?? '') }}"
                placeholder="e.g. Laravel Developer Intern"
                required
            >

        </div>


        @error('title')

            <div class="invalid-feedback">
                {{ $message }}
            </div>

        @enderror


        <div class="helper-text">

            <i class="fas fa-info-circle"></i>

            Use a clear and specific internship title.

        </div>

    </div>



    {{-- =====================================================
         STARTUP PROFILE
    ====================================================== --}}

    <div class="form-group-custom full-width">

        <label for="startup_profile_id">

            Startup Profile

            <span
                class="optional-label"
                style="font-size: 12px; color: #94a3b8; font-weight: 600;"
            >
                (Optional)
            </span>

        </label>


        <div class="input-wrapper select-wrapper">

            <i class="fas fa-rocket"></i>

            <select
                id="startup_profile_id"
                name="startup_profile_id"
                class="form-control-custom @error('startup_profile_id') is-invalid @enderror"
            >

                <option value="">
                    No specific startup
                </option>


                @foreach($startupProfiles ?? [] as $startup)

                    <option
                        value="{{ $startup->id }}"
                        @selected(
                            old(
                                'startup_profile_id',
                                $internship->startup_profile_id ?? ''
                            ) == $startup->id
                        )
                    >

                        {{ $startup->startup_name }}

                    </option>

                @endforeach

            </select>

        </div>


        @error('startup_profile_id')

            <div class="invalid-feedback">
                {{ $message }}
            </div>

        @enderror


        <div class="helper-text">

            <i class="fas fa-info-circle"></i>

            Leave this empty for a normal employer internship.
            Select a startup to publish this internship under that startup profile.

        </div>

    </div>



    {{-- =====================================================
         INTERNSHIP TYPE + WORK MODE
    ====================================================== --}}

    <div class="form-grid-2">


        {{-- =================================================
             INTERNSHIP TYPE
        ================================================== --}}

        <div class="form-group-custom">

            <label for="internship_type">

                Internship Type

                <span class="required">
                    *
                </span>

            </label>


            <div class="input-wrapper select-wrapper">

                <i class="fas fa-tag"></i>


                <select
                    id="internship_type"
                    name="internship_type"
                    class="form-control-custom @error('internship_type') is-invalid @enderror"
                    required
                >

                    <option value="">
                        Select type
                    </option>


                    <option
                        value="paid"
                        @selected($currentInternshipType === 'paid')
                    >
                        Paid
                    </option>


                    <option
                        value="unpaid"
                        @selected($currentInternshipType === 'unpaid')
                    >
                        Unpaid
                    </option>

                </select>

            </div>


            @error('internship_type')

                <div class="invalid-feedback">
                    {{ $message }}
                </div>

            @enderror


            <div class="helper-text">

                <i class="fas fa-info-circle"></i>

                Select whether the internship provides a monthly stipend.

            </div>

        </div>



        {{-- =================================================
             WORK MODE
        ================================================== --}}

        <div class="form-group-custom">

            <label for="work_mode">

                Work Mode

                <span class="required">
                    *
                </span>

            </label>


            <div class="input-wrapper select-wrapper">

                <i class="fas fa-laptop-house"></i>


                <select
                    id="work_mode"
                    name="work_mode"
                    class="form-control-custom @error('work_mode') is-invalid @enderror"
                    required
                >

                    <option value="">
                        Select mode
                    </option>


                    @foreach([
                        'onsite' => 'Onsite',
                        'hybrid' => 'Hybrid',
                        'remote' => 'Remote'
                    ] as $value => $label)

                        <option
                            value="{{ $value }}"
                            @selected(
                                old(
                                    'work_mode',
                                    $internship->work_mode ?? ''
                                ) == $value
                            )
                        >

                            {{ $label }}

                        </option>

                    @endforeach

                </select>

            </div>


            @error('work_mode')

                <div class="invalid-feedback">
                    {{ $message }}
                </div>

            @enderror

        </div>

    </div>



    {{-- =====================================================
         MONTHLY STIPEND
    ====================================================== --}}

    <div
        class="form-group-custom full-width stipend-field"
        id="stipendField"
        style="{{ $currentInternshipType === 'paid' ? '' : 'display:none;' }}"
    >

        <label for="stipend">

            Monthly Stipend

            <span class="required">
                *
            </span>

        </label>


        <div class="input-wrapper">

            <i class="fas fa-indian-rupee-sign"></i>

            <input
                type="text"
                id="stipend"
                name="stipend"
                class="form-control-custom @error('stipend') is-invalid @enderror"
                value="{{ $currentStipend }}"
                placeholder="e.g. ₹10,000 per month"
                {{ $currentInternshipType === 'paid' ? 'required' : '' }}
            >

        </div>


        @error('stipend')

            <div class="invalid-feedback">
                {{ $message }}
            </div>

        @enderror


        <div class="helper-text">

            <i class="fas fa-info-circle"></i>

            Enter the amount the intern will receive every month.

        </div>

    </div>



    {{-- =====================================================
         DURATION + POSITIONS
    ====================================================== --}}

    <div class="form-grid-2">


        {{-- =================================================
             DURATION
        ================================================== --}}

        <div class="form-group-custom">

            <label for="duration">

                Duration

                <span class="required">
                    *
                </span>

            </label>


            <div class="input-wrapper">

                <i class="fas fa-clock"></i>


                <input
                    type="text"
                    id="duration"
                    name="duration"
                    class="form-control-custom @error('duration') is-invalid @enderror"
                    value="{{ old('duration', $internship->duration ?? '') }}"
                    placeholder="e.g. 3 months"
                    required
                >

            </div>


            @error('duration')

                <div class="invalid-feedback">
                    {{ $message }}
                </div>

            @enderror

        </div>



        {{-- =================================================
             POSITIONS
        ================================================== --}}

        <div class="form-group-custom">

            <label for="positions">
                Available Positions
            </label>


            <div class="input-wrapper">

                <i class="fas fa-users"></i>


                <input
                    type="number"
                    id="positions"
                    name="positions"
                    min="1"
                    class="form-control-custom @error('positions') is-invalid @enderror"
                    value="{{ old('positions', $internship->positions ?? 1) }}"
                    placeholder="1"
                >

            </div>


            @error('positions')

                <div class="invalid-feedback">
                    {{ $message }}
                </div>

            @enderror

        </div>

    </div>



    {{-- =====================================================
         QUALIFICATION
    ====================================================== --}}

    <div class="form-group-custom full-width">

        <label for="qualification">
            Qualification
        </label>


        <div class="input-wrapper">

            <i class="fas fa-graduation-cap"></i>


            <input
                type="text"
                id="qualification"
                name="qualification"
                class="form-control-custom @error('qualification') is-invalid @enderror"
                value="{{ old('qualification', $internship->qualification ?? '') }}"
                placeholder="e.g. Bachelor's Degree / BCA / MCA"
            >

        </div>


        @error('qualification')

            <div class="invalid-feedback">
                {{ $message }}
            </div>

        @enderror

    </div>

</div>



{{-- =========================================================
     SKILLS
========================================================= --}}

<div class="form-section">

    <div class="form-section-heading">

        <div class="form-section-number">
            02
        </div>

        <div>

            <h3>Required Skills</h3>

            <p>
                Help candidates understand the skills needed.
            </p>

        </div>

    </div>


    <div class="form-group-custom">

        <label for="skills">
            Required Skills
        </label>


        <div class="input-wrapper">

            <i class="fas fa-code"></i>


            <input
                type="text"
                id="skills"
                name="skills"
                class="form-control-custom @error('skills') is-invalid @enderror"
                value="{{ old(
                    'skills',
                    isset($internship->skills)
                        ? (
                            is_array($internship->skills)
                                ? implode(', ', $internship->skills)
                                : $internship->skills
                        )
                        : ''
                ) }}"
                placeholder="PHP, Laravel, MySQL, JavaScript"
            >

        </div>


        @error('skills')

            <div class="invalid-feedback">
                {{ $message }}
            </div>

        @enderror


        <div class="helper-text">

            <i class="fas fa-info-circle"></i>

            Separate multiple skills with commas.

        </div>

    </div>

</div>



{{-- =========================================================
     DATES
========================================================= --}}

<div class="form-section">

    <div class="form-section-heading">

        <div class="form-section-number">
            03
        </div>

        <div>

            <h3>
                Internship Period
            </h3>

            <p>
                Specify when the internship will take place.
            </p>

        </div>

    </div>


    <div class="form-grid-2">


        {{-- START DATE --}}

        <div class="form-group-custom">

            <label for="start_date">
                Start Date
            </label>


            <div class="input-wrapper">

                <i class="fas fa-calendar-plus"></i>


                <input
                    type="date"
                    id="start_date"
                    name="start_date"
                    class="form-control-custom @error('start_date') is-invalid @enderror"
                    value="{{ old(
                        'start_date',
                        optional($internship->start_date ?? null)->format('Y-m-d')
                    ) }}"
                >

            </div>


            @error('start_date')

                <div class="invalid-feedback">
                    {{ $message }}
                </div>

            @enderror

        </div>



        {{-- END DATE --}}

        <div class="form-group-custom">

            <label for="end_date">
                End Date
            </label>


            <div class="input-wrapper">

                <i class="fas fa-calendar-minus"></i>


                <input
                    type="date"
                    id="end_date"
                    name="end_date"
                    class="form-control-custom @error('end_date') is-invalid @enderror"
                    value="{{ old(
                        'end_date',
                        optional($internship->end_date ?? null)->format('Y-m-d')
                    ) }}"
                >

            </div>


            @error('end_date')

                <div class="invalid-feedback">
                    {{ $message }}
                </div>

            @enderror

        </div>

    </div>

</div>



{{-- =========================================================
     LOCATION
========================================================= --}}

<div class="form-section">

    <div class="form-section-heading">

        <div class="form-section-number">
            04
        </div>

        <div>

            <h3>
                Location
            </h3>

            <p>
                Where will the intern work?
            </p>

        </div>

    </div>


    <div class="location-grid">


        {{-- COUNTRY --}}

        <div class="form-group-custom">

            <label for="country">
                Country
            </label>


            <div class="input-wrapper">

                <i class="fas fa-globe"></i>


                <input
                    type="text"
                    id="country"
                    name="country"
                    class="form-control-custom @error('country') is-invalid @enderror"
                    value="{{ old('country', $internship->country ?? '') }}"
                    placeholder="India"
                >

            </div>


            @error('country')

                <div class="invalid-feedback">
                    {{ $message }}
                </div>

            @enderror

        </div>



        {{-- STATE --}}

        <div class="form-group-custom">

            <label for="state">

                State

                <span class="required">
                    *
                </span>

            </label>


            <div class="input-wrapper">

                <i class="fas fa-map-pin"></i>


                <input
                    type="text"
                    id="state"
                    name="state"
                    class="form-control-custom @error('state') is-invalid @enderror"
                    value="{{ old('state', $internship->state ?? '') }}"
                    placeholder="Kerala"
                    required
                >

            </div>


            @error('state')

                <div class="invalid-feedback">
                    {{ $message }}
                </div>

            @enderror

        </div>



        {{-- DISTRICT --}}

        <div class="form-group-custom">

            <label for="district">

                District

                <span class="required">
                    *
                </span>

            </label>


            <div class="input-wrapper">

                <i class="fas fa-map-marked-alt"></i>


                <input
                    type="text"
                    id="district"
                    name="district"
                    class="form-control-custom @error('district') is-invalid @enderror"
                    value="{{ old('district', $internship->district ?? '') }}"
                    placeholder="Kasargod"
                    required
                >

            </div>


            @error('district')

                <div class="invalid-feedback">
                    {{ $message }}
                </div>

            @enderror

        </div>



        {{-- CITY --}}

        <div class="form-group-custom">

            <label for="city">

                City

                <span class="required">
                    *
                </span>

            </label>


            <div class="input-wrapper">

                <i class="fas fa-city"></i>


                <input
                    type="text"
                    id="city"
                    name="city"
                    class="form-control-custom @error('city') is-invalid @enderror"
                    value="{{ old('city', $internship->city ?? '') }}"
                    placeholder="Kanhangad"
                    required
                >

            </div>


            @error('city')

                <div class="invalid-feedback">
                    {{ $message }}
                </div>

            @enderror

        </div>

    </div>

</div>



{{-- =========================================================
     DESCRIPTION
========================================================= --}}

<div class="form-section">

    <div class="form-section-heading">

        <div class="form-section-number">
            05
        </div>

        <div>

            <h3>
                Internship Description
            </h3>

            <p>
                Give candidates a clear idea about the opportunity.
            </p>

        </div>

    </div>


    <div class="form-group-custom">

        <label for="description">

            Description

            <span class="required">
                *
            </span>

        </label>


        <textarea
            id="description"
            name="description"
            rows="6"
            class="form-control-custom textarea-custom @error('description') is-invalid @enderror"
            placeholder="Describe the internship, responsibilities, projects, learning opportunities and expectations..."
            required
        >{{ old('description', $internship->description ?? '') }}</textarea>


        @error('description')

            <div class="invalid-feedback">
                {{ $message }}
            </div>

        @enderror


        <div class="helper-text">

            <i class="fas fa-info-circle"></i>

            Include responsibilities, projects, learning opportunities and expectations.

        </div>

    </div>

</div>


{{-- =========================================================
     STIPEND DYNAMIC JAVASCRIPT
========================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const internshipType = document.getElementById('internship_type');

    const stipendField = document.getElementById('stipendField');

    const stipendInput = document.getElementById('stipend');


    if (!internshipType || !stipendField || !stipendInput) {
        return;
    }


    function updateStipendField() {

        const selectedType = internshipType.value;


        /*
        |--------------------------------------------------------------------------
        | PAID INTERNSHIP
        |--------------------------------------------------------------------------
        */

        if (selectedType === 'paid') {

            stipendField.style.display = '';

            stipendInput.required = true;

        }


        /*
        |--------------------------------------------------------------------------
        | UNPAID INTERNSHIP
        |--------------------------------------------------------------------------
        */

        else {

            stipendField.style.display = 'none';

            stipendInput.required = false;

            stipendInput.value = '';

        }

    }


    internshipType.addEventListener(
        'change',
        updateStipendField
    );


    /*
    |--------------------------------------------------------------------------
    | INITIAL STATE
    |--------------------------------------------------------------------------
    */

    updateStipendField();

});

</script>
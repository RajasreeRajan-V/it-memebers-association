@extends('layouts.app')

@php($portal = 'mentor')

@section('title', 'Schedule Session')

@section('content')

<style>
    .schedule-page {
        width: 100%;
        padding: 5px 0 40px;
    }

    .schedule-card {
        max-width: 760px;
        margin: 0 auto;
        background: #fff;
        border: 1px solid #E8ECF5;
        border-radius: 20px;
        box-shadow: 0 12px 35px rgba(40,64,120,.07);
        overflow: hidden;
    }

    /* ============================
       HEADER
    ============================= */

    .schedule-header {
        position: relative;
        padding: 26px 30px;
        background: linear-gradient(
            135deg,
            #3376F2 0%,
            #526EF3 55%,
            #7C4DFF 100%
        );
        color: #fff;
        overflow: hidden;
    }

    .schedule-header::before {
        content: "";
        position: absolute;
        width: 190px;
        height: 190px;
        border-radius: 50%;
        right: -70px;
        top: -100px;
        background: rgba(255,255,255,.08);
    }

    .schedule-header::after {
        content: "";
        position: absolute;
        width: 130px;
        height: 130px;
        border-radius: 50%;
        left: 45%;
        bottom: -90px;
        background: rgba(255,255,255,.06);
    }

    .schedule-header-content {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .schedule-icon {
        width: 52px;
        height: 52px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 15px;
        background: rgba(255,255,255,.14);
        border: 1px solid rgba(255,255,255,.2);
        font-size: 20px;
    }

    .schedule-title {
        margin: 0;
        color: #fff;
        font-size: 21px;
        font-weight: 800;
    }

    .schedule-subtitle {
        margin-top: 5px;
        color: rgba(255,255,255,.78);
        font-size: 12px;
    }

    /* ============================
       FORM
    ============================= */

    .schedule-form {
        padding: 30px;
    }

    .schedule-section-title {
        display: flex;
        align-items: center;
        gap: 9px;
        margin-bottom: 20px;
        color: #172033;
        font-size: 14px;
        font-weight: 800;
    }

    .schedule-section-title i {
        color: #3376F2;
    }

    .form-group {
        margin-bottom: 19px;
    }

    .schedule-form label {
        display: block;
        margin-bottom: 7px;
        color: #354157;
        font-size: 11px;
        font-weight: 800;
    }

    .required {
        color: #E5484D;
    }

    .optional {
        color: #9AA4B6;
        font-size: 9px;
        font-weight: 500;
    }

    .form-control {
        width: 100%;
        min-height: 43px;
        padding: 10px 13px;
        border: 1px solid #DDE3EF;
        border-radius: 10px;
        background: #FBFCFF;
        color: #172033;
        font-size: 12px;
        outline: none;
        box-sizing: border-box;
        transition: .2s ease;
    }

    .form-control:focus {
        border-color: #3376F2;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(51,118,242,.10);
    }

    textarea.form-control {
        min-height: 105px;
        resize: vertical;
        line-height: 1.6;
    }

    .schedule-row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }

    /* ============================
       MEETING LINK
    ============================= */

    .meeting-link-field {
        position: relative;
    }

    .meeting-link-field .form-control {
        padding-left: 38px;
    }

    .meeting-link-icon {
        position: absolute;
        left: 13px;
        top: 38px;
        color: #3376F2;
        font-size: 13px;
        pointer-events: none;
    }

    .meeting-link-hint {
        margin-top: 6px;
        color: #9AA4B6;
        font-size: 9px;
        line-height: 1.5;
    }

    /* ============================
       INFO
    ============================= */

    .schedule-info {
        display: flex;
        align-items: flex-start;
        gap: 11px;
        margin: 5px 0 23px;
        padding: 13px 15px;
        border: 1px solid #E1E8F7;
        border-radius: 12px;
        background: linear-gradient(
            135deg,
            #F3F7FF,
            #F8F5FF
        );
    }

    .schedule-info-icon {
        width: 30px;
        height: 30px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        background: #fff;
        color: #3376F2;
    }

    .schedule-info-title {
        margin-bottom: 3px;
        color: #26334A;
        font-size: 11px;
        font-weight: 800;
    }

    .schedule-info-text {
        color: #718096;
        font-size: 10px;
        line-height: 1.55;
    }

    /* ============================
       ACTIONS
    ============================= */

    .schedule-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        padding-top: 5px;
    }

    .schedule-btn {
        min-height: 41px;
        padding: 10px 17px;
        border-radius: 9px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        font-size: 11px;
        font-weight: 800;
        text-decoration: none;
        cursor: pointer;
        transition: .2s ease;
    }

    .schedule-btn-primary {
        border: 1px solid #3376F2;
        background: #3376F2;
        color: #fff;
    }

    .schedule-btn-primary:hover {
        background: #245ED1;
        color: #fff;
    }

    .schedule-btn-outline {
        border: 1px solid #DDE3EF;
        background: #fff;
        color: #536176;
    }

    .schedule-btn-outline:hover {
        background: #F5F8FF;
        color: #3376F2;
    }

    /* ============================
       ERRORS
    ============================= */

    .field-error {
        display: block;
        margin-top: 5px;
        color: #E5484D;
        font-size: 10px;
    }

    .slot-error-banner {
        display: flex;
        align-items: flex-start;
        gap: 11px;
        margin: 0 0 22px;
        padding: 13px 15px;
        border: 1px solid #FFD6D6;
        border-radius: 12px;
        background: #FFF5F5;
    }

    .slot-error-icon {
        width: 30px;
        height: 30px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        background: #fff;
        color: #E5484D;
    }

    .slot-error-title {
        margin-bottom: 3px;
        color: #B42318;
        font-size: 11px;
        font-weight: 800;
    }

    .slot-error-text {
        color: #C9494F;
        font-size: 10px;
        line-height: 1.55;
    }

    /* ============================
       RESPONSIVE
    ============================= */

    @media(max-width:700px) {

        .schedule-row {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .schedule-header {
            padding: 22px;
        }

        .schedule-form {
            padding: 22px;
        }
    }

    @media(max-width:480px) {

        .schedule-card {
            border-radius: 16px;
        }

        .schedule-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .schedule-btn {
            width: 100%;
        }
    }
</style>


<div class="schedule-page">

    <div class="schedule-card">

        {{-- HEADER --}}
        <div class="schedule-header">

            <div class="schedule-header-content">

                <div class="schedule-icon">
                    <i class="fa-regular fa-calendar-plus"></i>
                </div>

                <div>

                    <h1 class="schedule-title">
                        Schedule Session
                    </h1>

                    <div class="schedule-subtitle">
                        Create a mentorship session with
                        {{ $mentorship->student->name }}
                    </div>

                </div>

            </div>

        </div>


        {{-- FORM --}}
        <form
            method="POST"
            action="{{ route('mentor.sessions.store', $mentorship) }}"
            class="schedule-form"
        >

            @csrf


            {{-- SECTION TITLE --}}
            <div class="schedule-section-title">

                <i class="fa-solid fa-calendar-days"></i>

                Session Details

            </div>


            {{-- DOUBLE BOOKING ERROR --}}
            @error('slot')

                <div class="slot-error-banner">

                    <div class="slot-error-icon">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>

                    <div>

                        <div class="slot-error-title">
                            This time isn't available
                        </div>

                        <div class="slot-error-text">
                            {{ $message }}
                        </div>

                    </div>

                </div>

            @enderror


            {{-- TOPIC --}}
            <div class="form-group">

                <label>
                    Session Topic
                    <span class="required">*</span>
                </label>

                <input
                    type="text"
                    name="topic"
                    class="form-control"
                    placeholder="e.g. Resume review & backend roadmap"
                    value="{{ old('topic') }}"
                    required
                >

                @error('topic')
                    <span class="field-error">
                        {{ $message }}
                    </span>
                @enderror

            </div>


            {{-- DATE + TIME --}}
            <div class="schedule-row">

                {{-- DATE --}}
                <div class="form-group">

                    <label>
                        Date
                        <span class="required">*</span>
                    </label>

                    <input
                        type="date"
                        name="session_date"
                        class="form-control"
                        value="{{ old('session_date') }}"
                        min="{{ date('Y-m-d') }}"
                        required
                    >

                    @error('session_date')
                        <span class="field-error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>


                {{-- TIME --}}
                <div class="form-group">

                    <label>
                        Time
                        <span class="required">*</span>
                    </label>

                    <input
                        type="time"
                        name="start_time"
                        class="form-control"
                        value="{{ old('start_time') }}"
                        required
                    >

                    @error('start_time')
                        <span class="field-error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

            </div>


            {{-- DURATION + MEETING MODE --}}
            <div class="schedule-row">

                {{-- DURATION --}}
                <div class="form-group">

                    <label>
                        Duration
                        <span class="required">*</span>
                    </label>

                    <select
                        name="duration_minutes"
                        class="form-control"
                        required
                    >

                        <option
                            value="30"
                            {{ old('duration_minutes') == '30' ? 'selected' : '' }}
                        >
                            30 minutes
                        </option>

                        <option
                            value="60"
                            {{ old('duration_minutes', '60') == '60' ? 'selected' : '' }}
                        >
                            60 minutes
                        </option>

                        <option
                            value="90"
                            {{ old('duration_minutes') == '90' ? 'selected' : '' }}
                        >
                            90 minutes
                        </option>

                    </select>

                    @error('duration_minutes')
                        <span class="field-error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>


                {{-- MEETING TYPE --}}
                <div class="form-group">

                    <label>
                        Meeting Mode
                        <span class="required">*</span>
                    </label>

                    <select
                        name="meeting_type"
                        id="meeting_type"
                        class="form-control"
                        required
                    >

                        <option
                            value="online"
                            {{ old('meeting_type', 'online') == 'online' ? 'selected' : '' }}
                        >
                            Online
                        </option>

                        <option
                            value="offline"
                            {{ old('meeting_type') == 'offline' ? 'selected' : '' }}
                        >
                            Offline (in person)
                        </option>

                    </select>

                    @error('meeting_type')
                        <span class="field-error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

            </div>


            {{-- MEETING LINK --}}
            <div
                class="form-group meeting-link-field"
                id="meeting-link-group"
            >

                <label>

                    Meeting Link

                    <span
                        class="required"
                        id="meeting-link-required"
                    >
                        *
                    </span>

                </label>


                <i class="fa-solid fa-video meeting-link-icon"></i>


                <input
                    type="url"
                    name="meeting_link"
                    id="meeting_link"
                    class="form-control"
                    placeholder="https://meet.google.com/xxx-xxxx-xxx"
                    value="{{ old('meeting_link') }}"
                >


                <div class="meeting-link-hint">

                    Add the meeting link created by you using
                    Google Meet, Zoom, or Microsoft Teams.
                    This link will be shared with the mentee.

                </div>


                @error('meeting_link')

                    <span class="field-error">
                        {{ $message }}
                    </span>

                @enderror

            </div>


            {{-- INFO --}}
            <div class="schedule-info">

                <div class="schedule-info-icon">

                    <i class="fa-solid fa-circle-info"></i>

                </div>

                <div>

                    <div class="schedule-info-title">
                        Session scheduling
                    </div>

                    <div class="schedule-info-text">

                        Choose a convenient date and time for your mentee.
                        The system will automatically check whether you
                        already have another session during this time.

                    </div>

                </div>

            </div>


            {{-- AGENDA --}}
            <div class="form-group">

                <label>

                    Agenda

                    <span class="optional">
                        (Optional)
                    </span>

                </label>

                <textarea
                    name="agenda"
                    class="form-control"
                    placeholder="What will you cover in this session?"
                >{{ old('agenda') }}</textarea>

                @error('agenda')

                    <span class="field-error">
                        {{ $message }}
                    </span>

                @enderror

            </div>


            {{-- ACTIONS --}}
            <div class="schedule-actions">

                <button
                    type="submit"
                    class="schedule-btn schedule-btn-primary"
                >

                    <i class="fa-solid fa-calendar-check"></i>

                    Confirm Session

                </button>


                <a
                    href="{{ route('mentor.mentees.show', $mentorship) }}"
                    class="schedule-btn schedule-btn-outline"
                >

                    <i class="fa-solid fa-arrow-left"></i>

                    Cancel

                </a>

            </div>

        </form>

    </div>

</div>


<script>

(function () {

    const meetingTypeSelect =
        document.getElementById('meeting_type');

    const linkGroup =
        document.getElementById('meeting-link-group');

    const linkInput =
        document.getElementById('meeting_link');

    const linkRequiredMark =
        document.getElementById('meeting-link-required');


    function toggleMeetingLink() {

        const isOnline =
            meetingTypeSelect.value === 'online';


        /*
        |--------------------------------------------------------------------------
        | SHOW / HIDE MEETING LINK
        |--------------------------------------------------------------------------
        */

        linkGroup.style.display =
            isOnline ? 'block' : 'none';


        /*
        |--------------------------------------------------------------------------
        | REQUIRED ONLY FOR ONLINE
        |--------------------------------------------------------------------------
        */

        linkInput.required = isOnline;

        linkRequiredMark.style.display =
            isOnline ? 'inline' : 'none';


        /*
        |--------------------------------------------------------------------------
        | CLEAR LINK WHEN OFFLINE
        |--------------------------------------------------------------------------
        */

        if (!isOnline) {
            linkInput.value = '';
        }

    }


    meetingTypeSelect.addEventListener(
        'change',
        toggleMeetingLink
    );


    /*
    |--------------------------------------------------------------------------
    | RUN ON PAGE LOAD
    |--------------------------------------------------------------------------
    */

    toggleMeetingLink();

})();

</script>

@endsection
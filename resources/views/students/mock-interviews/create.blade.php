@extends('layouts.app')

@php
    $portal = 'student';

    // Always define this before the checkbox loop.
    $selectedFocusAreas = old('focus_areas', []);

    if (!is_array($selectedFocusAreas)) {
        $selectedFocusAreas = [];
    }
@endphp

@section('title', 'Request Mock Interview')

@section('content')

<style>
    :root {
        --mi-primary: #3376F2;
        --mi-primary-dark: #245ED1;
        --mi-purple: #7C4DFF;
        --mi-bg: #F7F9FC;
        --mi-card: #FFFFFF;
        --mi-text: #172033;
        --mi-muted: #6B7280;
        --mi-border: #E6EAF0;
        --mi-success: #16A34A;
        --mi-danger: #EF4444;
        --mi-shadow: 0 2px 10px rgba(23, 32, 51, 0.04);
    }

    .mi-page {
        min-height: 100vh;
        background: var(--mi-bg);
        padding: 28px 0 60px;
    }

    .mi-container {
        width: min(1180px, calc(100% - 40px));
        margin: 0 auto;
    }

    /* =========================
       PAGE HEADER
    ========================= */

    .mi-page-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 22px;
    }

    .mi-page-heading {
        color: var(--mi-text);
        font-size: 26px;
        font-weight: 800;
        margin: 0;
        letter-spacing: -0.3px;
    }

    .mi-page-subheading {
        color: var(--mi-muted);
        font-size: 13.5px;
        margin: 6px 0 0;
    }

    .mi-back-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        background: #fff;
        border: 1px solid var(--mi-border);
        color: var(--mi-text);
        padding: 10px 16px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        transition: .2s ease;
        flex-shrink: 0;
    }

    .mi-back-btn:hover {
        border-color: var(--mi-primary);
        color: var(--mi-primary);
    }

    /* =========================
       LAYOUT
    ========================= */

    .mi-layout {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 300px;
        gap: 22px;
        align-items: start;
    }

    /* =========================
       CHECKLIST STRIP
    ========================= */

    .mi-checklist {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 20px;
        background: #F6F8FC;
        border: 1px solid var(--mi-border);
        border-radius: 14px;
        padding: 16px 20px;
        margin-bottom: 22px;
    }

    .mi-checklist-item {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #9AA4B5;
        font-size: 12.5px;
        font-weight: 600;
    }

    .mi-checklist-box {
        width: 16px;
        height: 16px;
        border-radius: 5px;
        border: 1.5px solid #D3DAE6;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .mi-checklist-item.done {
        color: var(--mi-text);
    }

    .mi-checklist-item.done .mi-checklist-box {
        background: var(--mi-primary);
        border-color: var(--mi-primary);
        color: #fff;
        font-size: 9px;
    }

    /* =========================
       FORM CARD
    ========================= */

    .mi-form-card {
        background: #fff;
        border: 1px solid var(--mi-border);
        border-radius: 18px;
        box-shadow: var(--mi-shadow);
        padding: 26px;
    }

    .mi-section-header {
        display: flex;
        align-items: flex-start;
        gap: 13px;
        margin-bottom: 18px;
    }

    .mi-section-icon {
        width: 42px;
        height: 42px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: #EEF4FF;
        color: var(--mi-primary);
        font-size: 16px;
    }

    .mi-section-title {
        color: var(--mi-text);
        font-size: 16px;
        font-weight: 800;
    }

    .mi-section-subtitle {
        color: var(--mi-muted);
        font-size: 12.5px;
        margin-top: 3px;
    }

    .mi-callout {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        background: #EEF4FF;
        border: 1px solid #DCE8FF;
        border-radius: 12px;
        padding: 13px 15px;
        margin-bottom: 24px;
        color: #2E5FCB;
        font-size: 12.5px;
        line-height: 1.6;
    }

    .mi-callout i {
        margin-top: 1px;
        flex-shrink: 0;
    }

    .mi-form-alert {
        padding: 13px 15px;
        border-radius: 11px;
        background: #FEF2F2;
        border: 1px solid #FECACA;
        color: #B42318;
        font-size: 11.5px;
        line-height: 1.6;
        margin-bottom: 22px;
    }

    .mi-form-alert ul {
        margin: 6px 0 0 18px;
        padding: 0;
    }

    /* =========================
       FIELDS
    ========================= */

    .mi-form-group {
        margin-bottom: 22px;
    }

    .mi-form-group:last-of-type {
        margin-bottom: 0;
    }

    .mi-form-group label {
        display: block;
        color: #4B5563;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 9px;
    }

    .mi-required {
        color: var(--mi-danger);
    }

    .mi-optional-label {
        color: #9AA4B5;
        font-weight: 600;
        text-transform: none;
        letter-spacing: 0;
        font-size: 10.5px;
    }

    .mi-form-control {
        width: 100%;
        box-sizing: border-box;
        padding: 12px 13px;
        border: 1px solid var(--mi-border);
        border-radius: 10px;
        background: #FBFCFE;
        color: var(--mi-text);
        font-size: 13px;
        outline: none;
        transition: .2s ease;
        appearance: none;
    }

    select.mi-form-control {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8' fill='none'%3E%3Cpath d='M1 1.5L6 6.5L11 1.5' stroke='%236B7280' stroke-width='1.6' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 14px center;
        padding-right: 36px;
    }

    .mi-form-control::placeholder {
        color: #A8B0BF;
    }

    .mi-form-control:hover {
        border-color: #CBD5E6;
    }

    .mi-form-control:focus {
        border-color: var(--mi-primary);
        background: #fff;
        box-shadow: 0 0 0 3px rgba(51,118,242,.10);
    }

    textarea.mi-form-control {
        min-height: 100px;
        resize: vertical;
        line-height: 1.6;
    }

    .mi-field-error {
        color: var(--mi-danger);
        font-size: 10.5px;
        margin-top: 6px;
    }

    .mi-field-helper {
        color: #8C96A7;
        font-size: 11px;
        line-height: 1.5;
        margin-top: 8px;
    }

    .mi-divider {
        height: 1px;
        background: #F0F2F7;
        margin: 26px 0;
    }

    /* =========================
       FOCUS AREAS (dropdown multi-select)
    ========================= */

    .focus-dropdown {
        position: relative;
    }

    .focus-dropdown summary {
        list-style: none;
        cursor: pointer;
    }

    .focus-dropdown summary::-webkit-details-marker {
        display: none;
    }

    .focus-dropdown-trigger {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        width: 100%;
        box-sizing: border-box;
        padding: 12px 13px;
        border: 1px solid var(--mi-border);
        border-radius: 10px;
        background: #FBFCFE;
        color: var(--mi-text);
        font-size: 13px;
        transition: .2s ease;
    }

    .focus-dropdown-trigger:hover {
        border-color: #CBD5E6;
    }

    .focus-dropdown[open] .focus-dropdown-trigger {
        border-color: var(--mi-primary);
        background: #fff;
        box-shadow: 0 0 0 3px rgba(51,118,242,.10);
    }

    .focus-dropdown-trigger-label {
        color: #A8B0BF;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .focus-dropdown-trigger.has-value .focus-dropdown-trigger-label {
        color: var(--mi-text);
        font-weight: 600;
    }

    .focus-dropdown-trigger i {
        color: #9AA4B5;
        font-size: 12px;
        flex-shrink: 0;
        transition: transform .2s ease;
    }

    .focus-dropdown[open] .focus-dropdown-trigger i {
        transform: rotate(180deg);
        color: var(--mi-primary);
    }

    .focus-dropdown-panel {
        position: absolute;
        z-index: 20;
        top: calc(100% + 8px);
        left: 0;
        right: 0;
        background: #fff;
        border: 1px solid var(--mi-border);
        border-radius: 12px;
        box-shadow: 0 14px 34px rgba(23,32,51,.12);
        padding: 8px;
        max-height: 260px;
        overflow-y: auto;
    }

    .focus-row {
        display: flex;
        align-items: center;
        gap: 11px;
        padding: 10px 10px;
        border-radius: 9px;
        cursor: pointer;
        transition: .15s ease;
    }

    .focus-row:hover {
        background: #F6F8FC;
    }

    .focus-row input {
        width: 16px;
        height: 16px;
        flex-shrink: 0;
        accent-color: var(--mi-primary);
        cursor: pointer;
    }

    .focus-row-icon {
        width: 30px;
        height: 30px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        background: #EEF4FF;
        color: var(--mi-primary);
        font-size: 12px;
    }

    .focus-row-label {
        font-size: 12.5px;
        font-weight: 600;
        color: #354157;
        text-transform: none;
        letter-spacing: 0;
    }

    /* -- selected chips shown under the dropdown -- */

    .focus-chips {
        display: flex;
        flex-wrap: wrap;
        gap: 7px;
        margin-top: 10px;
    }

    .focus-chip {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #EEF4FF;
        border: 1px solid #DCE8FF;
        color: var(--mi-primary);
        padding: 5px 10px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 700;
    }

    /* =========================
       FOOTER
    ========================= */

    .mi-form-footer {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 10px;
        padding-top: 22px;
        margin-top: 26px;
        border-top: 1px solid var(--mi-border);
    }

    .mi-btn-submit,
    .mi-btn-cancel {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        border-radius: 10px;
        text-decoration: none;
        cursor: pointer;
        transition: .2s ease;
        border: 1px solid transparent;
    }

    .mi-btn-submit {
        padding: 12px 20px;
        background: var(--mi-primary);
        color: #fff;
        font-size: 12.5px;
        font-weight: 700;
    }

    .mi-btn-submit:hover {
        background: var(--mi-primary-dark);
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 10px 20px rgba(51,118,242,.20);
    }

    .mi-btn-cancel {
        padding: 11px 18px;
        border-color: var(--mi-border);
        background: #fff;
        color: #647086;
        font-size: 12.5px;
        font-weight: 700;
    }

    .mi-btn-cancel:hover {
        background: #F7F9FC;
        color: var(--mi-text);
    }

    /* =========================
       TIPS SIDEBAR
    ========================= */

    .mi-tips-card {
        background: #fff;
        border: 1px solid var(--mi-border);
        border-radius: 18px;
        box-shadow: var(--mi-shadow);
        padding: 22px;
        position: sticky;
        top: 20px;
    }

    .mi-tips-heading {
        display: flex;
        align-items: center;
        gap: 9px;
        color: var(--mi-primary);
        font-size: 14.5px;
        font-weight: 800;
        margin-bottom: 16px;
    }

    .mi-tips-list {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .mi-tips-list li {
        display: flex;
        align-items: flex-start;
        gap: 9px;
        color: #4B5563;
        font-size: 12.5px;
        line-height: 1.55;
    }

    .mi-tips-list li::before {
        content: "";
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: var(--mi-primary);
        margin-top: 6px;
        flex-shrink: 0;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 980px) {

        .mi-layout {
            grid-template-columns: 1fr;
        }

        .mi-tips-card {
            position: static;
        }
    }

    @media (max-width: 650px) {

        .mi-page-header {
            flex-direction: column;
        }

        .mi-checklist {
            gap: 12px 18px;
        }

        .focus-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .mi-form-card {
            padding: 18px;
        }

        .mi-form-footer {
            flex-direction: column-reverse;
            align-items: stretch;
        }

        .mi-btn-submit,
        .mi-btn-cancel {
            width: 100%;
        }
    }

    @media (max-width: 420px) {

        .focus-option label {
            aspect-ratio: auto;
            flex-direction: row;
            justify-content: flex-start;
            text-align: left;
            padding: 10px 12px;
        }
    }
</style>


<div class="mi-page">

    <div class="mi-container">

        {{-- =====================================================
             PAGE HEADER
        ====================================================== --}}
        <div class="mi-page-header">

            <div>
                <h1 class="mi-page-heading">
                    Request a Mock Interview
                </h1>

                <p class="mi-page-subheading">
                    Share the details below and your mentor will confirm the session
                </p>
            </div>

            <a href="{{ route('student.mock-interviews.index') }}" class="mi-back-btn">
                <i class="fa-solid fa-arrow-left"></i>
                Back
            </a>

        </div>


        {{-- =====================================================
             LAYOUT
        ====================================================== --}}
        <div class="mi-layout">

            {{-- LEFT: FORM --}}
            <div>

                {{-- CHECKLIST STRIP --}}
                <div class="mi-checklist">

                    <div class="mi-checklist-item">
                        <span class="mi-checklist-box"></span>
                        Mentor
                    </div>

                    <div class="mi-checklist-item">
                        <span class="mi-checklist-box"></span>
                        Topic
                    </div>

                    <div class="mi-checklist-item">
                        <span class="mi-checklist-box"></span>
                        Date &amp; Time
                    </div>

                    <div class="mi-checklist-item">
                        <span class="mi-checklist-box"></span>
                        Focus Areas
                    </div>

                    <div class="mi-checklist-item">
                        <span class="mi-checklist-box"></span>
                        Notes
                    </div>

                </div>


                <div class="mi-form-card">

                    <div class="mi-section-header">

                        <div class="mi-section-icon">
                            <i class="fa-solid fa-user-tie"></i>
                        </div>

                        <div>
                            <div class="mi-section-title">
                                Interview Details
                            </div>

                            <div class="mi-section-subtitle">
                                Core details about your mock interview request
                            </div>
                        </div>

                    </div>


                    <div class="mi-callout">
                        <i class="fa-solid fa-lightbulb"></i>
                        <span>
                            Choose a mentor familiar with your target role,
                            and tick a few focus areas — specific requests
                            are far easier for mentors to accept quickly.
                        </span>
                    </div>


                    @if ($errors->any())
                        <div class="mi-form-alert">
                            <strong>Please check the following:</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <form method="POST" action="{{ route('student.mock-interviews.store') }}">

                        @csrf

                        <div class="mi-form-group">

                            <label for="mentor_id">
                                Mentor <span class="mi-required">*</span>
                            </label>

                            <select name="mentor_id" id="mentor_id" class="mi-form-control @error('mentor_id') is-error @enderror" required>

                                <option value="">
                                    Select a mentor
                                </option>

                                @foreach ($mentors as $mentor)
                                    <option value="{{ $mentor->id }}" @selected(old('mentor_id', $selectedMentorId) == $mentor->id)>
                                        {{ $mentor->name }}
                                    </option>
                                @endforeach

                            </select>

                            @error('mentor_id')
                                <div class="mi-field-error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <div class="mi-form-group">

                            <label for="topic">
                                Topic <span class="mi-required">*</span>
                            </label>

                            <input
                                type="text"
                                id="topic"
                                name="topic"
                                class="mi-form-control @error('topic') is-error @enderror"
                                value="{{ old('topic') }}"
                                placeholder="e.g. Frontend Developer Interview"
                                required
                            >

                            @error('topic')
                                <div class="mi-field-error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <div class="mi-form-group">

                            <label for="requested_at">
                                Preferred Date &amp; Time <span class="mi-required">*</span>
                            </label>

                            <input
                                type="datetime-local"
                                id="requested_at"
                                name="requested_at"
                                class="mi-form-control @error('requested_at') is-error @enderror"
                                value="{{ old('requested_at') }}"
                                required
                            >

                            @error('requested_at')
                                <div class="mi-field-error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <div class="mi-divider"></div>


                        {{-- =========================
                             FOCUS AREAS
                        ========================== --}}

                        <div class="mi-form-group">

                            <label>
                                What should the mentor focus on?
                                <span class="mi-optional-label">Select all that apply</span>
                            </label>

                            @php
                                $focusAreas = [
                                    'technical'        => ['label' => 'Technical Skills', 'icon' => 'fa-code'],
                                    'communication'     => ['label' => 'Communication',    'icon' => 'fa-comments'],
                                    'system_design'     => ['label' => 'System Design',    'icon' => 'fa-sitemap'],
                                    'behavioral'        => ['label' => 'Behavioral',       'icon' => 'fa-user-check'],
                                    'problem_solving'   => ['label' => 'Problem Solving',  'icon' => 'fa-puzzle-piece'],
                                    'resume'            => ['label' => 'Resume Review',    'icon' => 'fa-file-lines'],
                                    'coding_round'      => ['label' => 'Coding Round',     'icon' => 'fa-laptop-code'],
                                    'hr_round'          => ['label' => 'HR Round',         'icon' => 'fa-people-arrows'],
                                    'body_language'     => ['label' => 'Body Language',    'icon' => 'fa-person'],
                                ];
                            @endphp

                            <details class="focus-dropdown" id="focusDropdown">

                                <summary>
                                    <span class="focus-dropdown-trigger" id="focusDropdownTrigger">
                                        <span class="focus-dropdown-trigger-label" id="focusDropdownLabel">
                                            Select focus areas
                                        </span>
                                        <i class="fa-solid fa-chevron-down"></i>
                                    </span>
                                </summary>

                                <div class="focus-dropdown-panel">

                                    @foreach ($focusAreas as $value => $area)

                                        <label class="focus-row" for="focus_{{ $value }}">

                                            <input
                                                type="checkbox"
                                                id="focus_{{ $value }}"
                                                name="focus_areas[]"
                                                value="{{ $value }}"
                                                data-label="{{ $area['label'] }}"
                                                {{ in_array($value, $selectedFocusAreas, true) ? 'checked' : '' }}
                                            >

                                            <span class="focus-row-icon">
                                                <i class="fa-solid {{ $area['icon'] }}"></i>
                                            </span>

                                            <span class="focus-row-label">
                                                {{ $area['label'] }}
                                            </span>

                                        </label>

                                    @endforeach

                                </div>

                            </details>

                            <div class="focus-chips" id="focusChips"></div>

                            @error('focus_areas')
                                <div class="mi-field-error">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="mi-field-helper">
                                Selecting a few clear focus areas helps your mentor
                                understand exactly what to prepare — and makes it
                                much easier for them to accept your request.
                            </div>

                        </div>


                        <div class="mi-divider"></div>


                        <div class="mi-form-group">

                            <label for="student_notes">
                                Notes for the mentor
                                <span class="mi-optional-label">Optional</span>
                            </label>

                            <textarea
                                id="student_notes"
                                name="student_notes"
                                class="mi-form-control"
                                placeholder="Anything specific you'd like to focus on?"
                            >{{ old('student_notes') }}</textarea>

                        </div>


                        <div class="mi-form-footer">

                            <a href="{{ route('student.mock-interviews.index') }}" class="mi-btn-cancel">
                                <i class="fa-solid fa-arrow-left"></i>
                                Cancel
                            </a>

                            <button type="submit" class="mi-btn-submit">
                                <i class="fa-solid fa-paper-plane"></i>
                                Send Request
                            </button>

                        </div>

                    </form>

                </div>

            </div>


            {{-- RIGHT: TIPS --}}
            <aside class="mi-tips-card">

                <div class="mi-tips-heading">
                    <i class="fa-solid fa-lightbulb"></i>
                    Tips
                </div>

                <ul class="mi-tips-list">

                    <li>Choose a mentor experienced in your target role for the most relevant feedback.</li>

                    <li>Pick a specific topic — "System Design Interview" beats "Interview Practice".</li>

                    <li>Select a few focus areas so your mentor knows exactly what to prepare.</li>

                    <li>Book at least 2–3 days in advance to give your mentor time to confirm.</li>

                    <li>Add a note about anything you're nervous about — mentors can tailor the session.</li>

                    <li>Double-check the date &amp; time before submitting your request.</li>

                </ul>

            </aside>

        </div>

    </div>

</div>

<script>
    (function () {
        const dropdown  = document.getElementById('focusDropdown');
        const label     = document.getElementById('focusDropdownLabel');
        const trigger   = document.getElementById('focusDropdownTrigger');
        const chipsWrap = document.getElementById('focusChips');

        if (!dropdown) return;

        const checkboxes = dropdown.querySelectorAll('input[type="checkbox"]');

        function refresh() {
            const checked = Array.from(checkboxes).filter(cb => cb.checked);

            if (checked.length === 0) {
                label.textContent = 'Select focus areas';
                trigger.classList.remove('has-value');
            } else if (checked.length <= 2) {
                label.textContent = checked.map(cb => cb.dataset.label).join(', ');
                trigger.classList.add('has-value');
            } else {
                label.textContent = checked.length + ' focus areas selected';
                trigger.classList.add('has-value');
            }

            chipsWrap.innerHTML = '';

            checked.forEach(function (cb) {
                const chip = document.createElement('span');
                chip.className = 'focus-chip';
                chip.innerHTML = '<i class="fa-solid fa-check"></i>' + cb.dataset.label;
                chipsWrap.appendChild(chip);
            });
        }

        checkboxes.forEach(cb => cb.addEventListener('change', refresh));

        document.addEventListener('click', function (event) {
            if (dropdown.open && !dropdown.contains(event.target)) {
                dropdown.open = false;
            }
        });

        refresh();
    })();
</script>

@endsection
@extends('layouts.app')

@section('title', $internship->title . ' - Internship Modules')

@section('content')

<style>
    :root {
        --im-primary: #3376F2;
        --im-primary-dark: #245ED1;
        --im-primary-light: #EEF4FF;

        --im-navy: #0F172A;
        --im-text: #172033;
        --im-muted: #64748B;

        --im-border: #E2E8F0;
        --im-border-light: #EEF2F7;

        --im-bg: #F7F9FC;
        --im-white: #FFFFFF;

        --im-green: #16A34A;
        --im-green-bg: #ECFDF3;

        --im-red: #DC2626;
        --im-red-bg: #FFF1F2;

        --im-purple: #7C3AED;
        --im-purple-bg: #F5F3FF;

        --im-shadow-sm: 0 3px 12px rgba(15, 23, 42, 0.04);
        --im-shadow: 0 10px 35px rgba(15, 23, 42, 0.07);
    }

    * {
        box-sizing: border-box;
    }

    .module-page {
        min-height: calc(100vh - 70px);
        background:
            radial-gradient(
                circle at 90% 0%,
                rgba(51, 118, 242, 0.06),
                transparent 28%
            ),
            var(--im-bg);

        padding: 32px 0 70px;
    }

    .module-container {
        width: min(1180px, calc(100% - 40px));
        margin: 0 auto;
    }

    /* =========================================================
       HEADER
    ========================================================== */

    .page-header {
        position: relative;
        overflow: hidden;

        background: var(--im-white);
        border: 1px solid var(--im-border);
        border-radius: 22px;

        padding: 30px;

        margin-bottom: 24px;

        box-shadow: var(--im-shadow);
    }

    .page-header::before {
        content: "";

        position: absolute;

        width: 260px;
        height: 260px;

        border-radius: 50%;

        background: rgba(51, 118, 242, 0.045);

        right: -100px;
        top: -130px;
    }

    .page-header::after {
        content: "";

        position: absolute;

        width: 90px;
        height: 90px;

        border-radius: 50%;

        border: 18px solid rgba(51, 118, 242, 0.035);

        right: 170px;
        bottom: -45px;
    }

    .back-link {
        position: relative;
        z-index: 2;

        display: inline-flex;
        align-items: center;
        gap: 8px;

        color: var(--im-primary);

        text-decoration: none;

        font-size: 13px;
        font-weight: 700;

        margin-bottom: 18px;

        transition: .2s ease;
    }

    .back-link:hover {
        color: var(--im-primary-dark);
        transform: translateX(-2px);
    }

    .header-content {
        position: relative;
        z-index: 2;
    }

    .header-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;

        padding: 6px 11px;

        border-radius: 999px;

        background: var(--im-primary-light);
        color: var(--im-primary);

        font-size: 10px;
        font-weight: 800;

        text-transform: uppercase;
        letter-spacing: .06em;

        margin-bottom: 13px;
    }

    .header-label-dot {
        width: 7px;
        height: 7px;

        border-radius: 50%;

        background: var(--im-primary);

        box-shadow: 0 0 0 4px rgba(51,118,242,.10);
    }

    .page-header h1 {
        margin: 0 0 9px;

        color: var(--im-navy);

        font-size: 29px;
        line-height: 1.25;

        font-weight: 750;

        letter-spacing: -0.025em;
    }

    .page-header p {
        max-width: 720px;

        margin: 0;

        color: var(--im-muted);

        font-size: 14px;
        line-height: 1.75;
    }

    /* =========================================================
       SUCCESS MESSAGE
    ========================================================== */

    .alert-success {
        display: flex;
        align-items: center;
        gap: 11px;

        background: var(--im-green-bg);

        border: 1px solid #BBF7D0;

        color: #166534;

        border-radius: 12px;

        padding: 13px 16px;

        margin-bottom: 23px;

        font-size: 13px;
        font-weight: 600;
    }

    .alert-success-icon {
        width: 27px;
        height: 27px;

        flex-shrink: 0;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 50%;

        background: #FFFFFF;

        font-size: 13px;
        font-weight: 800;
    }

    /* =========================================================
       SECTION HEADER
    ========================================================== */

    .top-actions {
        display: flex;

        justify-content: space-between;
        align-items: center;

        gap: 20px;

        margin-bottom: 19px;
    }

    .section-heading {
        display: flex;
        align-items: center;

        gap: 12px;
    }

    .section-icon {
        width: 43px;
        height: 43px;

        flex-shrink: 0;

        border-radius: 12px;

        background: var(--im-primary-light);

        color: var(--im-primary);

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 18px;
    }

    .section-heading h2 {
        margin: 0;

        color: var(--im-navy);

        font-size: 20px;
        line-height: 1.3;

        font-weight: 750;
    }

    .section-heading span {
        display: block;

        margin-top: 4px;

        color: var(--im-muted);

        font-size: 12px;
    }

    /* =========================================================
       BUTTONS
    ========================================================== */

    .btn {
        border: 0;

        border-radius: 10px;

        padding: 10px 15px;

        font-size: 12px;
        font-weight: 700;

        cursor: pointer;

        text-decoration: none;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        gap: 7px;

        transition:
            background .2s ease,
            border-color .2s ease,
            color .2s ease,
            transform .2s ease,
            box-shadow .2s ease;
    }

    .btn:hover {
        transform: translateY(-1px);
    }

    .btn-primary {
        background: var(--im-primary);
        color: #FFFFFF;

        box-shadow: 0 5px 15px rgba(51,118,242,.17);
    }

    .btn-primary:hover {
        background: var(--im-primary-dark);

        box-shadow: 0 8px 20px rgba(51,118,242,.22);
    }

    .btn-outline {
        background: #FFFFFF;

        color: var(--im-primary);

        border: 1px solid #CBD8EF;
    }

    .btn-outline:hover {
        background: var(--im-primary-light);

        border-color: #B8CCEF;
    }

    .btn-danger {
        background: var(--im-red-bg);

        color: var(--im-red);

        border: 1px solid #FECACA;
    }

    .btn-danger:hover {
        background: #FEE2E2;
    }

    .btn-add {
        padding: 12px 18px;
    }

    /* =========================================================
       MODULE GRID
    ========================================================== */

    .modules-grid {
        display: grid;

        grid-template-columns:
            repeat(2, minmax(0, 1fr));

        gap: 18px;
    }

    /* =========================================================
       MODULE CARD
    ========================================================== */

    .module-card {
        position: relative;

        display: flex;
        flex-direction: column;

        background: var(--im-white);

        border: 1px solid var(--im-border);

        border-radius: 18px;

        overflow: hidden;

        box-shadow: var(--im-shadow-sm);

        transition:
            transform .22s ease,
            box-shadow .22s ease,
            border-color .22s ease;
    }

    .module-card:hover {
        transform: translateY(-3px);

        border-color: #D2DDF1;

        box-shadow: var(--im-shadow);
    }

    .module-card-top {
        padding: 22px 22px 19px;
    }

    .module-top-row {
        display: flex;

        justify-content: space-between;
        align-items: flex-start;

        gap: 15px;

        margin-bottom: 17px;
    }

    .module-number {
        width: 44px;
        height: 44px;

        flex-shrink: 0;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 12px;

        background: var(--im-primary-light);

        color: var(--im-primary);

        font-size: 13px;
        font-weight: 800;

        border: 1px solid #DCE8FF;
    }

    .module-status {
        display: inline-flex;
        align-items: center;

        gap: 6px;

        padding: 6px 10px;

        border-radius: 999px;

        background: var(--im-green-bg);

        color: var(--im-green);

        font-size: 10px;
        font-weight: 800;

        text-transform: uppercase;
        letter-spacing: .03em;
    }

    .module-status-dot {
        width: 6px;
        height: 6px;

        border-radius: 50%;

        background: var(--im-green);
    }

    .module-status.inactive {
        background: #F1F5F9;

        color: var(--im-muted);
    }

    .module-status.inactive .module-status-dot {
        background: #94A3B8;
    }

    .module-card h3 {
        margin: 0 0 9px;

        color: var(--im-navy);

        font-size: 18px;

        font-weight: 750;

        line-height: 1.4;

        letter-spacing: -0.01em;
    }

    .module-description {
        color: var(--im-muted);

        font-size: 13px;

        line-height: 1.7;

        min-height: 44px;
    }

    /* =========================================================
       META
    ========================================================== */

    .module-meta {
        display: flex;

        flex-wrap: wrap;

        gap: 8px;

        margin-top: 18px;
    }

    .meta-item {
        display: inline-flex;

        align-items: center;

        gap: 6px;

        background: #F8FAFC;

        border: 1px solid var(--im-border-light);

        border-radius: 8px;

        padding: 7px 10px;

        font-size: 11px;

        color: var(--im-muted);

        font-weight: 600;
    }

    .meta-item strong {
        color: var(--im-text);
    }

    .meta-item.blue {
        background: var(--im-primary-light);

        border-color: #DCE8FF;

        color: var(--im-primary);
    }

    .meta-item.purple {
        background: var(--im-purple-bg);

        border-color: #E9D5FF;

        color: var(--im-purple);
    }

    /* =========================================================
       CARD ACTIONS
    ========================================================== */

    .module-actions {
        margin-top: auto;

        display: flex;

        align-items: center;

        gap: 8px;

        padding: 15px 22px;

        border-top: 1px solid var(--im-border-light);

        background: #FCFDFE;

        flex-wrap: wrap;
    }

    .module-actions .btn {
        padding: 9px 13px;

        font-size: 11px;
    }

    .module-actions .manage-btn {
        flex: 1;
    }

    .module-actions form {
        margin: 0;
    }

    /* =========================================================
       EMPTY STATE
    ========================================================== */

    .empty-state {
        background: #FFFFFF;

        border: 1px dashed #CBD5E1;

        border-radius: 18px;

        padding: 65px 25px;

        text-align: center;
    }

    .empty-icon {
        width: 70px;
        height: 70px;

        margin: 0 auto 18px;

        border-radius: 20px;

        background: var(--im-primary-light);

        color: var(--im-primary);

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 25px;
    }

    .empty-state h3 {
        margin: 0 0 8px;

        color: var(--im-navy);

        font-size: 20px;
        font-weight: 750;
    }

    .empty-state p {
        max-width: 510px;

        margin: 0 auto 23px;

        color: var(--im-muted);

        font-size: 13px;

        line-height: 1.7;
    }

    /* =========================================================
       MODAL
    ========================================================== */

    .modal {
        display: none;

        position: fixed;

        inset: 0;

        background: rgba(15,23,42,.58);

        backdrop-filter: blur(5px);

        z-index: 9999;

        align-items: center;
        justify-content: center;

        padding: 20px;
    }

    .modal.show {
        display: flex;
    }

    .modal-box {
        width: 100%;

        max-width: 650px;

        background: #FFFFFF;

        border-radius: 20px;

        box-shadow:
            0 25px 70px rgba(15,23,42,.20);

        max-height: 90vh;

        overflow-y: auto;

        animation: modalIn .18s ease;
    }

    @keyframes modalIn {

        from {
            opacity: 0;
            transform: translateY(10px) scale(.98);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

    }

    .modal-header {
        display: flex;

        justify-content: space-between;
        align-items: center;

        padding: 22px 24px;

        border-bottom: 1px solid var(--im-border-light);
    }

    .modal-title-wrapper {
        display: flex;

        align-items: center;

        gap: 12px;
    }

    .modal-icon {
        width: 40px;
        height: 40px;

        flex-shrink: 0;

        border-radius: 11px;

        background: var(--im-primary-light);

        color: var(--im-primary);

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 18px;
        font-weight: 700;
    }

    .modal-header h3 {
        margin: 0;

        color: var(--im-navy);

        font-size: 17px;

        font-weight: 750;
    }

    .modal-header p {
        margin: 3px 0 0;

        color: var(--im-muted);

        font-size: 11px;
    }

    .close-modal {
        border: 0;

        background: #F1F5F9;

        width: 34px;
        height: 34px;

        border-radius: 50%;

        cursor: pointer;

        color: var(--im-muted);

        font-size: 19px;

        transition: .2s;
    }

    .close-modal:hover {
        background: #E2E8F0;

        color: var(--im-navy);

        transform: rotate(4deg);
    }

    .modal-body {
        padding: 24px;
    }

    .form-group {
        margin-bottom: 17px;
    }

    .form-group:last-child {
        margin-bottom: 0;
    }

    .form-group label {
        display: block;

        margin-bottom: 7px;

        color: var(--im-text);

        font-size: 12px;

        font-weight: 700;
    }

    .required {
        color: var(--im-red);
    }

    .form-control {
        width: 100%;

        border: 1px solid var(--im-border);

        border-radius: 10px;

        padding: 11px 12px;

        font-family: inherit;

        font-size: 13px;

        color: var(--im-text);

        background: #FFFFFF;

        outline: none;

        transition: .2s;
    }

    .form-control:hover {
        border-color: #CBD5E1;
    }

    .form-control:focus {
        border-color: var(--im-primary);

        box-shadow:
            0 0 0 3px rgba(51,118,242,.09);
    }

    .form-control::placeholder {
        color: #94A3B8;
    }

    textarea.form-control {
        min-height: 100px;

        resize: vertical;

        line-height: 1.6;
    }

    .form-hint {
        margin-top: 6px;

        color: #94A3B8;

        font-size: 11px;

        line-height: 1.5;
    }

    .modal-footer {
        display: flex;

        justify-content: flex-end;

        gap: 9px;

        padding: 17px 24px;

        border-top: 1px solid var(--im-border-light);

        background: #FCFDFE;
    }

    /* =========================================================
       FORM VALIDATION ERROR
    ========================================================== */

    .field-error {
        margin-top: 5px;

        color: var(--im-red);

        font-size: 11px;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 900px) {

        .modules-grid {
            grid-template-columns: 1fr;
        }

    }

    @media (max-width: 650px) {

        .module-container {
            width: min(100% - 24px, 1180px);
        }

        .module-page {
            padding-top: 20px;
        }

        .page-header {
            padding: 22px;

            border-radius: 17px;
        }

        .page-header h1 {
            font-size: 23px;
        }

        .top-actions {
            align-items: flex-start;

            flex-direction: column;
        }

        .top-actions > .btn {
            width: 100%;
        }

        .module-card-top {
            padding: 19px;
        }

        .module-actions {
            padding: 13px 19px;
        }

        .module-actions .manage-btn {
            flex: 1 1 100%;
        }

        .modal {
            padding: 12px;
        }

        .modal-box {
            border-radius: 17px;
        }

        .modal-body {
            padding: 20px;
        }

        .modal-footer {
            padding: 15px 20px;
        }

    }

    @media (max-width: 420px) {

        .module-actions .btn {
            flex: 1;
        }

        .module-actions form {
            flex: 1;
        }

        .module-actions form .btn {
            width: 100%;
        }

        .module-top-row {
            align-items: flex-start;
        }

    }
</style>


<div class="module-page">

    <div class="module-container">

        {{-- =====================================================
             PAGE HEADER
        ====================================================== --}}

        <div class="page-header">

            <a
                href="{{ route('employer.internships.show', $internship) }}"
                class="back-link"
            >
                <span>←</span>
                <span>Back to Internship</span>
            </a>

            <div class="header-content">

                <div class="header-label">
                    <span class="header-label-dot"></span>
                    Internship Learning Program
                </div>

                <h1>
                    {{ $internship->title }}
                </h1>

                <p>
                    Create structured learning modules and organize
                    this internship into practical learning stages,
                    activities, and tasks for students.
                </p>

            </div>

        </div>


        {{-- =====================================================
             SUCCESS MESSAGE
        ====================================================== --}}

        @if(session('success'))

            <div class="alert-success">

                <div class="alert-success-icon">
                    ✓
                </div>

                <span>
                    {{ session('success') }}
                </span>

            </div>

        @endif


        {{-- =====================================================
             VALIDATION ERRORS
        ====================================================== --}}

        @if($errors->any())

            <div
                style="
                    background:#FFF7ED;
                    border:1px solid #FED7AA;
                    color:#9A3412;
                    border-radius:12px;
                    padding:13px 16px;
                    margin-bottom:22px;
                    font-size:13px;
                "
            >

                <strong>
                    Please check the following:
                </strong>

                <ul style="margin:8px 0 0 18px;">

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- =====================================================
             SECTION HEADER
        ====================================================== --}}

        <div class="top-actions">

            <div class="section-heading">

                <div class="section-icon">
                    ☰
                </div>

                <div>

                    <h2>
                        Internship Modules
                    </h2>

                    <span>
                        Build the student's learning journey step by step
                    </span>

                </div>

            </div>


            <button
                type="button"
                class="btn btn-primary btn-add"
                onclick="openModal('createModuleModal')"
            >
                <span style="font-size:16px;line-height:1;">+</span>
                Add Module
            </button>

        </div>


        {{-- =====================================================
             MODULES
        ====================================================== --}}

        @if($modules->count())

            <div class="modules-grid">

                @foreach($modules as $index => $module)

                    @php

                        $isActive =
                            strtolower($module->status ?? '') === 'active';

                    @endphp


                    <div class="module-card">


                        {{-- =================================================
                             CARD CONTENT
                        ================================================== --}}

                        <div class="module-card-top">


                            <div class="module-top-row">

                                <div class="module-number">

                                    {{ str_pad(
                                        $index + 1,
                                        2,
                                        '0',
                                        STR_PAD_LEFT
                                    ) }}

                                </div>


                                <div
                                    class="module-status {{ $isActive ? '' : 'inactive' }}"
                                >

                                    <span class="module-status-dot"></span>

                                    {{ ucfirst($module->status ?? 'Draft') }}

                                </div>

                            </div>


                            <h3>
                                {{ $module->title }}
                            </h3>


                            <div class="module-description">

                                {{ $module->description
                                    ?: 'No description has been added for this learning module yet.'
                                }}

                            </div>


                            {{-- =================================================
                                 META
                            ================================================== --}}

                            <div class="module-meta">

                                <span class="meta-item blue">

                                    <strong>
                                        {{ $module->tasks_count }}
                                    </strong>

                                    {{ $module->tasks_count == 1 ? 'Task' : 'Tasks' }}

                                </span>


                                @if($module->duration)

                                    <span class="meta-item">

                                        <span>⏱</span>

                                        {{ $module->duration }}

                                    </span>

                                @endif


                                @if($module->learning_outcomes)

                                    <span class="meta-item purple">

                                        <span>✓</span>

                                        Learning Outcomes

                                    </span>

                                @endif

                            </div>

                        </div>


                        {{-- =================================================
                             ACTIONS
                        ================================================== --}}

                        <div class="module-actions">


                            <a
                                href="{{ route(
                                    'employer.internships.modules.tasks.index',
                                    [$internship, $module]
                                ) }}"
                                class="btn btn-primary manage-btn"
                            >

                                <span>
                                    Manage Tasks
                                </span>

                                <span>
                                    →
                                </span>

                            </a>


                            <button
                                type="button"
                                class="btn btn-outline"
                                onclick="openEditModule({{ $module->id }})"
                            >
                                Edit
                            </button>


                            <form
                                method="POST"
                                action="{{ route(
                                    'employer.internships.modules.destroy',
                                    [$internship, $module]
                                ) }}"
                                onsubmit="return confirm(
                                    'Delete this module and all its tasks?'
                                );"
                            >

                                @csrf

                                @method('DELETE')


                                <button
                                    type="submit"
                                    class="btn btn-danger"
                                >
                                    Delete
                                </button>

                            </form>

                        </div>

                    </div>

                @endforeach

            </div>


        @else


            {{-- =================================================
                 EMPTY STATE
            ================================================== --}}

            <div class="empty-state">

                <div class="empty-icon">
                    ☰
                </div>

                <h3>
                    No modules created yet
                </h3>

                <p>
                    Start building your internship learning journey
                    by creating the first module. You can then add
                    practical tasks and activities inside it.
                </p>

                <button
                    type="button"
                    class="btn btn-primary"
                    onclick="openModal('createModuleModal')"
                >
                    + Create First Module
                </button>

            </div>

        @endif

    </div>

</div>


{{-- ============================================================
     CREATE MODULE MODAL
============================================================= --}}

<div
    class="modal"
    id="createModuleModal"
>

    <div class="modal-box">


        <div class="modal-header">

            <div class="modal-title-wrapper">

                <div class="modal-icon">
                    +
                </div>

                <div>

                    <h3>
                        Create Learning Module
                    </h3>

                    <p>
                        Add a new stage to the internship
                    </p>

                </div>

            </div>


            <button
                type="button"
                class="close-modal"
                onclick="closeModal('createModuleModal')"
                aria-label="Close"
            >
                ×
            </button>

        </div>


        <form
            method="POST"
            action="{{ route(
                'employer.internships.modules.store',
                $internship
            ) }}"
        >

            @csrf


            <div class="modal-body">


                {{-- TITLE --}}

                <div class="form-group">

                    <label>
                        Module Title
                        <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        name="title"
                        class="form-control"
                        value="{{ old('title') }}"
                        placeholder="Example: Introduction to Laravel"
                        required
                    >

                </div>


                {{-- DESCRIPTION --}}

                <div class="form-group">

                    <label>
                        Description
                    </label>

                    <textarea
                        name="description"
                        class="form-control"
                        placeholder="Explain what students will learn in this module..."
                    >{{ old('description') }}</textarea>

                    <div class="form-hint">
                        Give students a short overview of this learning stage.
                    </div>

                </div>


                {{-- LEARNING OUTCOMES --}}

                <div class="form-group">

                    <label>
                        Learning Outcomes
                    </label>

                    <textarea
                        name="learning_outcomes"
                        class="form-control"
                        placeholder="Understand Laravel routing&#10;Create REST APIs&#10;Work with MySQL"
                    >{{ old('learning_outcomes') }}</textarea>

                    <div class="form-hint">
                        Add the skills or knowledge students should gain.
                    </div>

                </div>


                {{-- DURATION --}}

                <div class="form-group">

                    <label>
                        Duration
                    </label>

                    <input
                        type="text"
                        name="duration"
                        class="form-control"
                        value="{{ old('duration') }}"
                        placeholder="Example: 2 Weeks"
                    >

                </div>

            </div>


            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-outline"
                    onclick="closeModal('createModuleModal')"
                >
                    Cancel
                </button>


                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Create Module
                </button>

            </div>

        </form>

    </div>

</div>


{{-- ============================================================
     EDIT MODULE MODALS
============================================================= --}}

@foreach($modules as $module)

    <div
        class="modal"
        id="editModule{{ $module->id }}"
    >

        <div class="modal-box">


            <div class="modal-header">

                <div class="modal-title-wrapper">

                    <div class="modal-icon">
                        ✎
                    </div>

                    <div>

                        <h3>
                            Edit Learning Module
                        </h3>

                        <p>
                            Update this module's information
                        </p>

                    </div>

                </div>


                <button
                    type="button"
                    class="close-modal"
                    onclick="closeModal('editModule{{ $module->id }}')"
                    aria-label="Close"
                >
                    ×
                </button>

            </div>


            <form
                method="POST"
                action="{{ route(
                    'employer.internships.modules.update',
                    [$internship, $module]
                ) }}"
            >

                @csrf

                @method('PUT')


                <div class="modal-body">


                    {{-- TITLE --}}

                    <div class="form-group">

                        <label>

                            Module Title

                            <span class="required">
                                *
                            </span>

                        </label>


                        <input
                            type="text"
                            name="title"
                            class="form-control"
                            value="{{ $module->title }}"
                            required
                        >

                    </div>


                    {{-- DESCRIPTION --}}

                    <div class="form-group">

                        <label>
                            Description
                        </label>


                        <textarea
                            name="description"
                            class="form-control"
                            placeholder="Explain what students will learn..."
                        >{{ $module->description }}</textarea>

                    </div>


                    {{-- LEARNING OUTCOMES --}}

                    <div class="form-group">

                        <label>
                            Learning Outcomes
                        </label>


                        <textarea
                            name="learning_outcomes"
                            class="form-control"
                            placeholder="Add the skills or knowledge students should gain..."
                        >{{ $module->learning_outcomes }}</textarea>

                    </div>


                    {{-- DURATION --}}

                    <div class="form-group">

                        <label>
                            Duration
                        </label>


                        <input
                            type="text"
                            name="duration"
                            class="form-control"
                            value="{{ $module->duration }}"
                            placeholder="Example: 2 Weeks"
                        >

                    </div>

                </div>


                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-outline"
                        onclick="closeModal('editModule{{ $module->id }}')"
                    >
                        Cancel
                    </button>


                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Save Changes
                    </button>

                </div>

            </form>

        </div>

    </div>

@endforeach


{{-- ============================================================
     JAVASCRIPT
============================================================= --}}

<script>

    function openModal(id) {

        const modal = document.getElementById(id);

        if (!modal) {
            return;
        }

        modal.classList.add('show');

        document.body.style.overflow = 'hidden';
    }


    function closeModal(id) {

        const modal = document.getElementById(id);

        if (!modal) {
            return;
        }

        modal.classList.remove('show');

        document.body.style.overflow = '';
    }


    function openEditModule(id) {

        openModal('editModule' + id);

    }


    /*
    |--------------------------------------------------------------------------
    | CLOSE WHEN CLICKING OUTSIDE
    |--------------------------------------------------------------------------
    */

    document.querySelectorAll('.modal').forEach(function(modal) {

        modal.addEventListener('click', function(event) {

            if (event.target === modal) {

                modal.classList.remove('show');

                document.body.style.overflow = '';

            }

        });

    });


    /*
    |--------------------------------------------------------------------------
    | ESCAPE KEY
    |--------------------------------------------------------------------------
    */

    document.addEventListener('keydown', function(event) {

        if (event.key === 'Escape') {

            document.querySelectorAll('.modal.show').forEach(function(modal) {

                modal.classList.remove('show');

            });

            document.body.style.overflow = '';

        }

    });

</script>

@endsection
@extends('layouts.app')

@section('title', $module->title . ' - Tasks')

@section('content')

<style>
    :root {
        --task-primary: #3376F2;
        --task-primary-dark: #245ED1;
        --task-primary-light: #EEF4FF;

        --task-bg: #F6F8FC;
        --task-card: #FFFFFF;

        --task-text: #172033;
        --task-heading: #0F172A;
        --task-muted: #64748B;

        --task-border: #E5EAF1;

        --task-green: #16A34A;
        --task-green-bg: #ECFDF3;

        --task-orange: #D97706;
        --task-orange-bg: #FFF7ED;

        --task-red: #DC2626;
        --task-red-bg: #FEF2F2;

        --task-purple: #7C3AED;
        --task-purple-bg: #F5F3FF;

        --task-radius: 16px;
    }

    * {
        box-sizing: border-box;
    }

    .task-page {
        min-height: calc(100vh - 70px);
        background: var(--task-bg);
        padding: 32px 0 70px;
    }

    .task-container {
        width: min(1180px, calc(100% - 40px));
        margin: 0 auto;
    }

    /* =====================================================
       TOP HEADER
    ===================================================== */

    .task-header {
        background: #ffffff;
        border: 1px solid var(--task-border);
        border-radius: 20px;
        padding: 28px 30px;
        margin-bottom: 24px;
        box-shadow: 0 4px 18px rgba(15, 23, 42, 0.035);
    }

    .breadcrumb {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 20px;
        font-size: 13px;
        color: var(--task-muted);
    }

    .breadcrumb a {
        color: var(--task-primary);
        text-decoration: none;
        font-weight: 600;
    }

    .breadcrumb a:hover {
        text-decoration: underline;
    }

    .breadcrumb-separator {
        color: #94A3B8;
    }

    .breadcrumb-current {
        color: var(--task-text);
        font-weight: 600;
    }

    .header-main {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 30px;
    }

    .header-content {
        flex: 1;
        min-width: 0;
    }

    .module-label {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 6px 10px;
        border-radius: 8px;
        background: var(--task-primary-light);
        color: var(--task-primary);
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .5px;
        margin-bottom: 10px;
    }

    .module-label-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: var(--task-primary);
    }

    .task-header h1 {
        margin: 0 0 8px;
        color: var(--task-heading);
        font-size: 28px;
        line-height: 1.25;
        font-weight: 750;
        letter-spacing: -0.5px;
    }

    .module-description {
        margin: 0;
        max-width: 760px;
        color: var(--task-muted);
        font-size: 14px;
        line-height: 1.7;
    }

    .header-stats {
        display: flex;
        gap: 10px;
        flex-shrink: 0;
    }

    .header-stat {
        min-width: 100px;
        padding: 13px 15px;
        border: 1px solid var(--task-border);
        border-radius: 12px;
        background: #FAFBFD;
        text-align: center;
    }

    .header-stat-number {
        display: block;
        color: var(--task-heading);
        font-size: 20px;
        font-weight: 800;
        line-height: 1.2;
    }

    .header-stat-label {
        display: block;
        margin-top: 4px;
        color: var(--task-muted);
        font-size: 11px;
        font-weight: 600;
    }

    /* =====================================================
       ALERT
    ===================================================== */

    .success-alert {
        display: flex;
        align-items: center;
        gap: 12px;
        background: var(--task-green-bg);
        color: #166534;
        border: 1px solid #BBF7D0;
        padding: 13px 16px;
        border-radius: 12px;
        margin-bottom: 22px;
        font-size: 13px;
        font-weight: 600;
    }

    .success-icon {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: #DCFCE7;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        flex-shrink: 0;
    }

    /* =====================================================
       TOOLBAR
    ===================================================== */

    .tasks-section {
        margin-top: 4px;
    }

    .section-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 16px;
    }

    .section-heading {
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .section-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: var(--task-primary-light);
        color: var(--task-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        font-weight: 700;
    }

    .section-heading h2 {
        margin: 0;
        color: var(--task-heading);
        font-size: 19px;
        font-weight: 750;
    }

    .section-heading p {
        margin: 3px 0 0;
        color: var(--task-muted);
        font-size: 12px;
    }

    .task-count {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 25px;
        height: 25px;
        padding: 0 8px;
        border-radius: 7px;
        background: #EEF2F7;
        color: #475569;
        font-size: 12px;
        font-weight: 800;
        margin-left: 3px;
    }

    /* =====================================================
       BUTTONS
    ===================================================== */

    .btn {
        border: 0;
        border-radius: 9px;
        padding: 10px 15px;
        font-size: 12.5px;
        font-weight: 700;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        transition: all .18s ease;
        white-space: nowrap;
    }

    .btn-primary {
        background: var(--task-primary);
        color: #ffffff;
        box-shadow: 0 4px 10px rgba(51, 118, 242, .15);
    }

    .btn-primary:hover {
        background: var(--task-primary-dark);
        transform: translateY(-1px);
        box-shadow: 0 6px 14px rgba(51, 118, 242, .2);
    }

    .btn-outline {
        background: #ffffff;
        color: #334155;
        border: 1px solid #D8E0EA;
    }

    .btn-outline:hover {
        background: #F8FAFC;
        border-color: #CBD5E1;
    }

    .btn-danger {
        background: #ffffff;
        color: var(--task-red);
        border: 1px solid #FECACA;
    }

    .btn-danger:hover {
        background: var(--task-red-bg);
        border-color: #FCA5A5;
    }

    .btn-icon {
        width: 15px;
        height: 15px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    /* =====================================================
       TASK LIST
    ===================================================== */

    .tasks {
        display: flex;
        flex-direction: column;
        gap: 13px;
    }

    .task-card {
        position: relative;
        background: var(--task-card);
        border: 1px solid var(--task-border);
        border-radius: var(--task-radius);
        overflow: hidden;
        transition: all .2s ease;
    }

    .task-card:hover {
        border-color: #D4DEEC;
        box-shadow: 0 8px 25px rgba(15, 23, 42, .055);
        transform: translateY(-1px);
    }

    .task-card-inner {
        padding: 20px 21px 0;
    }

    .task-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 20px;
    }

    .task-main {
        display: flex;
        gap: 14px;
        flex: 1;
        min-width: 0;
    }

    .task-number {
        width: 40px;
        height: 40px;
        min-width: 40px;
        border-radius: 10px;
        background: linear-gradient(135deg, #EEF4FF, #F4F7FF);
        border: 1px solid #DDE8FF;
        color: var(--task-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 800;
    }

    .task-content {
        min-width: 0;
        flex: 1;
    }

    .task-title-row {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 9px;
        margin-bottom: 6px;
    }

    .task-main h3 {
        margin: 0;
        color: var(--task-heading);
        font-size: 16px;
        line-height: 1.4;
        font-weight: 750;
    }

    .task-description {
        color: var(--task-muted);
        font-size: 13px;
        line-height: 1.65;
        max-width: 780px;
    }

    /* =====================================================
       TYPE BADGE
    ===================================================== */

    .type-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 9px;
        border-radius: 7px;
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        color: #475569;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .2px;
        white-space: nowrap;
    }

    .type-badge.github {
        background: #F8FAFC;
        color: #24292F;
    }

    .type-badge.file {
        background: #EFF6FF;
        color: #2563EB;
        border-color: #DBEAFE;
    }

    .type-badge.text {
        background: #F5F3FF;
        color: #7C3AED;
        border-color: #EDE9FE;
    }

    /* =====================================================
       STATS
    ===================================================== */

    .task-stats {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        margin: 18px 0 17px;
        padding-left: 54px;
    }

    .stat {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 10px;
        border: 1px solid var(--task-border);
        border-radius: 8px;
        background: #FAFBFC;
        color: var(--task-muted);
        font-size: 11.5px;
        font-weight: 600;
    }

    .stat strong {
        color: var(--task-heading);
        font-weight: 800;
    }

    .stat-icon {
        width: 16px;
        height: 16px;
        border-radius: 5px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 9px;
        font-weight: 800;
    }

    .stat-total .stat-icon {
        background: #EEF4FF;
        color: var(--task-primary);
    }

    .stat-completed .stat-icon {
        background: #DCFCE7;
        color: var(--task-green);
    }

    .stat-pending .stat-icon {
        background: #FEF3C7;
        color: var(--task-orange);
    }

    /* =====================================================
       ACTION BAR
    ===================================================== */

    .task-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 13px 21px;
        border-top: 1px solid #EEF2F6;
        background: #FCFDFE;
    }

    .submission-info {
        color: var(--task-muted);
        font-size: 11.5px;
    }

    .submission-info strong {
        color: var(--task-heading);
    }

    .action-buttons {
        display: flex;
        align-items: center;
        gap: 7px;
        flex-wrap: wrap;
    }

    .action-buttons .btn {
        padding: 8px 12px;
        font-size: 11.5px;
    }

    /* =====================================================
       EMPTY STATE
    ===================================================== */

    .empty {
        background: #ffffff;
        border: 1px dashed #CBD5E1;
        border-radius: 17px;
        padding: 70px 25px;
        text-align: center;
    }

    .empty-icon {
        width: 64px;
        height: 64px;
        margin: 0 auto 17px;
        border-radius: 16px;
        background: var(--task-primary-light);
        color: var(--task-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        font-weight: 700;
    }

    .empty h3 {
        margin: 0 0 7px;
        color: var(--task-heading);
        font-size: 18px;
    }

    .empty p {
        max-width: 480px;
        margin: 0 auto 20px;
        color: var(--task-muted);
        font-size: 13px;
        line-height: 1.6;
    }

    /* =====================================================
       MODAL
    ===================================================== */

    .modal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, .58);
        backdrop-filter: blur(3px);
        -webkit-backdrop-filter: blur(3px);
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
        background: #ffffff;
        border-radius: 19px;
        overflow: hidden;
        box-shadow: 0 25px 70px rgba(15, 23, 42, .2);
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

    .modal-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        padding: 22px 24px;
        border-bottom: 1px solid var(--task-border);
    }

    .modal-title-wrap h3 {
        margin: 0 0 4px;
        color: var(--task-heading);
        font-size: 18px;
        font-weight: 750;
    }

    .modal-title-wrap p {
        margin: 0;
        color: var(--task-muted);
        font-size: 12px;
    }

    .close {
        width: 34px;
        height: 34px;
        min-width: 34px;
        border: 1px solid #E2E8F0;
        background: #F8FAFC;
        color: #64748B;
        border-radius: 9px;
        cursor: pointer;
        font-size: 20px;
        line-height: 1;
        transition: .15s ease;
    }

    .close:hover {
        background: #F1F5F9;
        color: #0F172A;
    }

    .modal-body {
        padding: 23px 24px 8px;
    }

    .form-group {
        margin-bottom: 17px;
    }

    .form-group:last-child {
        margin-bottom: 0;
    }

    label {
        display: block;
        margin-bottom: 7px;
        color: var(--task-text);
        font-size: 12.5px;
        font-weight: 700;
    }

    .required {
        color: var(--task-red);
    }

    .form-control {
        width: 100%;
        border: 1px solid #D9E1EB;
        border-radius: 9px;
        padding: 11px 12px;
        background: #ffffff;
        color: var(--task-heading);
        font-family: inherit;
        font-size: 13px;
        outline: none;
        transition: border-color .15s ease, box-shadow .15s ease;
    }

    .form-control::placeholder {
        color: #94A3B8;
    }

    .form-control:focus {
        border-color: var(--task-primary);
        box-shadow: 0 0 0 3px rgba(51, 118, 242, .10);
    }

    textarea.form-control {
        min-height: 105px;
        resize: vertical;
        line-height: 1.55;
    }

    select.form-control {
        cursor: pointer;
    }

    .input-help {
        margin-top: 5px;
        color: #94A3B8;
        font-size: 10.5px;
        line-height: 1.5;
    }

    .modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: 8px;
        padding: 16px 24px 22px;
        margin-top: 10px;
        border-top: 1px solid #EEF2F6;
    }

    /* =====================================================
       VALIDATION
    ===================================================== */

    .field-error {
        margin-top: 5px;
        color: var(--task-red);
        font-size: 11px;
    }

    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media (max-width: 850px) {

        .header-main {
            flex-direction: column;
        }

        .header-stats {
            width: 100%;
        }

        .header-stat {
            flex: 1;
        }
    }

    @media (max-width: 700px) {

        .task-page {
            padding-top: 20px;
        }

        .task-container {
            width: min(100% - 24px, 1180px);
        }

        .task-header {
            padding: 21px;
            border-radius: 16px;
        }

        .task-header h1 {
            font-size: 23px;
        }

        .section-toolbar {
            align-items: flex-start;
            flex-direction: column;
        }

        .section-toolbar .btn {
            width: 100%;
        }

        .task-top {
            flex-direction: column;
        }

        .type-badge {
            align-self: flex-start;
        }

        .task-stats {
            padding-left: 0;
            margin-top: 16px;
        }

        .task-actions {
            align-items: flex-start;
            flex-direction: column;
        }

        .action-buttons {
            width: 100%;
        }

        .action-buttons .btn {
            flex: 1;
        }

        .submission-info {
            display: none;
        }

        .modal {
            padding: 12px;
        }

        .modal-box {
            border-radius: 15px;
        }

        .modal-head,
        .modal-body,
        .modal-footer {
            padding-left: 18px;
            padding-right: 18px;
        }
    }

    @media (max-width: 480px) {

        .header-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
        }

        .task-main {
            gap: 10px;
        }

        .task-number {
            width: 35px;
            height: 35px;
            min-width: 35px;
        }

        .task-card-inner {
            padding: 17px;
        }

        .task-actions {
            padding: 12px 17px;
        }

        .action-buttons {
            flex-direction: column;
        }

        .action-buttons .btn {
            width: 100%;
            flex: none;
        }
    }
</style>


<div class="task-page">

    <div class="task-container">

        {{-- =====================================================
             HEADER
        ====================================================== --}}
        <div class="task-header">

            <div class="breadcrumb">

                <a href="{{ route('employer.internships.modules.index', $internship) }}">
                    Internship Modules
                </a>

                <span class="breadcrumb-separator">/</span>

                <span class="breadcrumb-current">
                    {{ $module->title }}
                </span>

            </div>


            <div class="header-main">

                <div class="header-content">

                    <div class="module-label">
                        <span class="module-label-dot"></span>
                        Learning Module
                    </div>

                    <h1>
                        {{ $module->title }}
                    </h1>

                    <p class="module-description">
                        {{ $module->description ?: 'Create and manage the practical tasks students need to complete as part of this learning module.' }}
                    </p>

                </div>


                <div class="header-stats">

                    <div class="header-stat">
                        <span class="header-stat-number">
                            {{ $tasks->count() }}
                        </span>

                        <span class="header-stat-label">
                            Total Tasks
                        </span>
                    </div>

                    <div class="header-stat">
                        <span class="header-stat-number">
                            {{ $tasks->sum('submissions_count') }}
                        </span>

                        <span class="header-stat-label">
                            Submissions
                        </span>
                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
             SUCCESS MESSAGE
        ====================================================== --}}
        @if(session('success'))

            <div class="success-alert">

                <div class="success-icon">
                    ✓
                </div>

                <div>
                    {{ session('success') }}
                </div>

            </div>

        @endif


        {{-- =====================================================
             TASK SECTION
        ====================================================== --}}
        <div class="tasks-section">

            <div class="section-toolbar">

                <div class="section-heading">

                    <div class="section-icon">
                        ✓
                    </div>

                    <div>

                        <h2>
                            Module Tasks

                            <span class="task-count">
                                {{ $tasks->count() }}
                            </span>
                        </h2>

                        <p>
                            Define practical activities and track student submissions
                        </p>

                    </div>

                </div>


                <button
                    type="button"
                    class="btn btn-primary"
                    onclick="openModal('createTaskModal')"
                >
                    <span class="btn-icon">+</span>
                    Add New Task
                </button>

            </div>


            {{-- =================================================
                 TASKS
            ================================================== --}}
            @if($tasks->count())

                <div class="tasks">

                    @foreach($tasks as $index => $task)

                        @php

                            $submissionType = strtolower($task->submission_type ?? 'text');

                            $typeClass = match($submissionType) {
                                'github_link' => 'github',
                                'file_upload' => 'file',
                                default => 'text',
                            };

                            $typeLabel = match($submissionType) {
                                'github_link' => 'GITHUB LINK',
                                'file_upload' => 'FILE UPLOAD',
                                default => 'TEXT ANSWER',
                            };

                        @endphp


                        <div class="task-card">

                            <div class="task-card-inner">

                                <div class="task-top">

                                    <div class="task-main">

                                        <div class="task-number">
                                            {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                        </div>


                                        <div class="task-content">

                                            <div class="task-title-row">

                                                <h3>
                                                    {{ $task->title }}
                                                </h3>

                                                <span class="type-badge {{ $typeClass }}">

                                                    @if($submissionType === 'github_link')
                                                        ↗
                                                    @elseif($submissionType === 'file_upload')
                                                        ↑
                                                    @else
                                                        Aa
                                                    @endif

                                                    {{ $typeLabel }}

                                                </span>

                                            </div>


                                            <div class="task-description">

                                                {{ $task->description ?: 'No description has been added for this task.' }}

                                            </div>

                                        </div>

                                    </div>

                                </div>


                                {{-- =================================================
                                     STATISTICS
                                ================================================== --}}
                                <div class="task-stats">

                                    <span class="stat stat-total">

                                        <span class="stat-icon">
                                            #
                                        </span>

                                        Submissions:

                                        <strong>
                                            {{ $task->submissions_count }}
                                        </strong>

                                    </span>


                                    <span class="stat stat-completed">

                                        <span class="stat-icon">
                                            ✓
                                        </span>

                                        Completed:

                                        <strong>
                                            {{ $task->completed_submissions_count }}
                                        </strong>

                                    </span>


                                    <span class="stat stat-pending">

                                        <span class="stat-icon">
                                            !
                                        </span>

                                        Pending:

                                        <strong>
                                            {{ $task->pending_submissions_count }}
                                        </strong>

                                    </span>

                                </div>

                            </div>


                            {{-- =================================================
                                 ACTION BAR
                            ================================================== --}}
                            <div class="task-actions">

                                <div class="submission-info">

                                    @if($task->submissions_count > 0)

                                        <strong>
                                            {{ $task->submissions_count }}
                                        </strong>

                                        student
                                        {{ $task->submissions_count == 1 ? 'submission' : 'submissions' }}
                                        received

                                    @else

                                        No student submissions yet.

                                    @endif

                                </div>


                                <div class="action-buttons">

                                    <a
                                        href="{{ route('employer.internships.tasks.submissions.index', [$internship, $task]) }}"
                                        class="btn btn-primary"
                                    >
                                        <span class="btn-icon">☷</span>
                                        View Submissions
                                    </a>


                                    <button
                                        type="button"
                                        class="btn btn-outline"
                                        onclick="openEditTask({{ $task->id }})"
                                    >
                                        <span class="btn-icon">✎</span>
                                        Edit
                                    </button>


                                    <form
                                        method="POST"
                                        action="{{ route('employer.internships.modules.tasks.destroy', [$internship, $module, $task]) }}"
                                        onsubmit="return confirm('Delete this task and all submissions?');"
                                        style="margin:0;"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-danger"
                                        >
                                            <span class="btn-icon">⌫</span>
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                {{-- =================================================
                     EMPTY STATE
                ================================================== --}}
                <div class="empty">

                    <div class="empty-icon">
                        +
                    </div>

                    <h3>
                        No tasks created yet
                    </h3>

                    <p>
                        Add practical tasks to this module so students know exactly
                        what they need to learn, build and submit during the internship.
                    </p>

                    <button
                        type="button"
                        class="btn btn-primary"
                        onclick="openModal('createTaskModal')"
                    >
                        <span class="btn-icon">+</span>
                        Create First Task
                    </button>

                </div>

            @endif

        </div>

    </div>

</div>



{{-- =============================================================
     CREATE TASK MODAL
============================================================== --}}

<div class="modal" id="createTaskModal">

    <div class="modal-box">

        <div class="modal-head">

            <div class="modal-title-wrap">

                <h3>
                    Create New Task
                </h3>

                <p>
                    Add a practical activity for students to complete.
                </p>

            </div>


            <button
                type="button"
                class="close"
                onclick="closeModal('createTaskModal')"
            >
                ×
            </button>

        </div>


        <form
            method="POST"
            action="{{ route('employer.internships.modules.tasks.store', [$internship, $module]) }}"
        >

            @csrf


            <div class="modal-body">

                {{-- Task Title --}}
                <div class="form-group">

                    <label>
                        Task Title
                        <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        name="title"
                        class="form-control"
                        placeholder="Example: Create a Laravel REST API"
                        required
                    >

                </div>


                {{-- Description --}}
                <div class="form-group">

                    <label>
                        Description
                    </label>

                    <textarea
                        name="description"
                        class="form-control"
                        placeholder="Describe what the student needs to accomplish..."
                    ></textarea>

                </div>


                {{-- Instructions --}}
                <div class="form-group">

                    <label>
                        Instructions
                    </label>

                    <textarea
                        name="instructions"
                        class="form-control"
                        placeholder="Give clear step-by-step instructions for the student..."
                    ></textarea>

                    <div class="input-help">
                        Clear instructions help students understand exactly what is expected.
                    </div>

                </div>


                {{-- Submission Type --}}
                <div class="form-group">

                    <label>
                        Submission Type
                        <span class="required">*</span>
                    </label>

                    <select
                        name="submission_type"
                        class="form-control"
                        required
                    >

                        <option value="text">
                            Text Answer
                        </option>

                        <option value="github_link">
                            GitHub Link
                        </option>

                        <option value="file_upload">
                            File Upload
                        </option>

                    </select>

                </div>

            </div>


            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-outline"
                    onclick="closeModal('createTaskModal')"
                >
                    Cancel
                </button>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Create Task
                </button>

            </div>

        </form>

    </div>

</div>



{{-- =============================================================
     EDIT TASK MODALS
============================================================== --}}

@foreach($tasks as $task)

    <div
        class="modal"
        id="editTask{{ $task->id }}"
    >

        <div class="modal-box">

            <div class="modal-head">

                <div class="modal-title-wrap">

                    <h3>
                        Edit Task
                    </h3>

                    <p>
                        Update the task details and submission requirements.
                    </p>

                </div>


                <button
                    type="button"
                    class="close"
                    onclick="closeModal('editTask{{ $task->id }}')"
                >
                    ×
                </button>

            </div>


            <form
                method="POST"
                action="{{ route('employer.internships.modules.tasks.update', [$internship, $module, $task]) }}"
            >

                @csrf

                @method('PUT')


                <div class="modal-body">

                    {{-- Task Title --}}
                    <div class="form-group">

                        <label>
                            Task Title
                            <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            name="title"
                            class="form-control"
                            value="{{ $task->title }}"
                            required
                        >

                    </div>


                    {{-- Description --}}
                    <div class="form-group">

                        <label>
                            Description
                        </label>

                        <textarea
                            name="description"
                            class="form-control"
                        >{{ $task->description }}</textarea>

                    </div>


                    {{-- Instructions --}}
                    <div class="form-group">

                        <label>
                            Instructions
                        </label>

                        <textarea
                            name="instructions"
                            class="form-control"
                        >{{ $task->instructions }}</textarea>

                    </div>


                    {{-- Submission Type --}}
                    <div class="form-group">

                        <label>
                            Submission Type
                            <span class="required">*</span>
                        </label>

                        <select
                            name="submission_type"
                            class="form-control"
                            required
                        >

                            <option
                                value="text"
                                {{ $task->submission_type === 'text' ? 'selected' : '' }}
                            >
                                Text Answer
                            </option>

                            <option
                                value="github_link"
                                {{ $task->submission_type === 'github_link' ? 'selected' : '' }}
                            >
                                GitHub Link
                            </option>

                            <option
                                value="file_upload"
                                {{ $task->submission_type === 'file_upload' ? 'selected' : '' }}
                            >
                                File Upload
                            </option>

                        </select>

                    </div>

                </div>


                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-outline"
                        onclick="closeModal('editTask{{ $task->id }}')"
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



<script>

    /* =========================================================
       MODAL FUNCTIONS
    ========================================================== */

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


    function openEditTask(id) {

        openModal('editTask' + id);

    }


    /* =========================================================
       CLOSE WHEN CLICKING OUTSIDE MODAL
    ========================================================== */

    document.addEventListener('click', function(event) {

        if (event.target.classList.contains('modal')) {

            event.target.classList.remove('show');

            document.body.style.overflow = '';

        }

    });


    /* =========================================================
       ESC KEY
    ========================================================== */

    document.addEventListener('keydown', function(event) {

        if (event.key === 'Escape') {

            const openModalElement =
                document.querySelector('.modal.show');

            if (openModalElement) {

                openModalElement.classList.remove('show');

                document.body.style.overflow = '';

            }

        }

    });

</script>

@endsection
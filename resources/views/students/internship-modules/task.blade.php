@extends('layouts.app')

@section('title', $task->title . ' - Task')

@section('content')

<style>
    :root {
        --blue: #3376F2;
        --blue-dark: #245fd0;
        --navy: #0f172a;
        --text: #172033;
        --muted: #64748b;
        --border: #e2e8f0;
        --bg: #f8fafc;
        --green: #16a34a;
        --orange: #d97706;
    }

    .task-page {
        min-height: 100vh;
        background: var(--bg);
        padding: 30px 0 60px;
    }

    .task-container {
        max-width: 900px;
        margin: auto;
        padding: 0 20px;
    }

    .card {
        background: white;
        border: 1px solid var(--border);
        border-radius: 18px;
        padding: 27px;
        margin-bottom: 18px;
    }

    .back {
        color: var(--blue);
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
    }

    h1 {
        color: var(--navy);
        margin: 15px 0 7px;
        font-size: 27px;
    }

    .subtitle {
        color: var(--muted);
        margin: 0;
        font-size: 14px;
    }

    .section-title {
        color: var(--navy);
        font-size: 18px;
        margin: 0 0 10px;
    }

    .description,
    .instructions {
        color: var(--text);
        font-size: 14px;
        line-height: 1.75;
        white-space: pre-wrap;
    }

    .type {
        display: inline-block;
        margin-top: 15px;
        padding: 7px 10px;
        border-radius: 8px;
        background: #eef4ff;
        color: var(--blue);
        font-size: 11px;
        font-weight: 700;
    }

    .feedback {
        background: #fff7ed;
        border: 1px solid #fed7aa;
        color: #9a3412;
        border-radius: 11px;
        padding: 14px;
        font-size: 13px;
        line-height: 1.6;
    }

    .form-group {
        margin-bottom: 17px;
    }

    label {
        display: block;
        margin-bottom: 7px;
        font-size: 13px;
        font-weight: 700;
        color: var(--text);
    }

    input,
    textarea {
        width: 100%;
        box-sizing: border-box;
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 12px;
        font-size: 14px;
        outline: none;
    }

    textarea {
        min-height: 150px;
        resize: vertical;
    }

    input:focus,
    textarea:focus {
        border-color: var(--blue);
        box-shadow: 0 0 0 3px rgba(51,118,242,.1);
    }

    .help {
        color: var(--muted);
        font-size: 12px;
        margin-top: 6px;
    }

    .btn {
        border: 0;
        background: var(--blue);
        color: white;
        border-radius: 10px;
        padding: 12px 18px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
    }

    .btn:hover {
        background: var(--blue-dark);
    }

    .success {
        background: #ecfdf3;
        border: 1px solid #bbf7d0;
        color: #166534;
        padding: 13px;
        border-radius: 10px;
        margin-bottom: 18px;
    }

    .error {
        background: #fff1f2;
        border: 1px solid #fecdd3;
        color: #be123c;
        padding: 13px;
        border-radius: 10px;
        margin-bottom: 18px;
    }
</style>

<div class="task-page">

    <div class="task-container">

        <div class="card">

            <a href="{{ route('student.internships.modules.show', [$internship, $module]) }}"
               class="back">
                ← Back to {{ $module->title }}
            </a>

            <h1>
                {{ $task->title }}
            </h1>

            <p class="subtitle">
                {{ $internship->title }} · {{ $module->title }}
            </p>

            <span class="type">
                {{ strtoupper(str_replace('_', ' ', $task->submission_type)) }}
            </span>

        </div>

        @if(session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())

            <div class="error">

                <strong>Please fix the following:</strong>

                <ul style="margin:7px 0 0;padding-left:20px;">

                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif

        <div class="card">

            <h2 class="section-title">
                Task Description
            </h2>

            <div class="description">
                {{ $task->description ?: 'No additional description provided.' }}
            </div>

        </div>

        <div class="card">

            <h2 class="section-title">
                Instructions
            </h2>

            <div class="instructions">
                {{ $task->instructions ?: 'Follow the task requirements and submit your work below.' }}
            </div>

        </div>

        @if($submission && $submission->employer_feedback)

            <div class="card">

                <h2 class="section-title">
                    Employer Feedback
                </h2>

                <div class="feedback">
                    {{ $submission->employer_feedback }}
                </div>

            </div>

        @endif

        <div class="card">

            <h2 class="section-title">
                {{ $submission ? 'Resubmit Task' : 'Submit Your Work' }}
            </h2>

            <p style="color:#64748b;font-size:13px;margin-bottom:20px;">
                Submit your work for employer review.
            </p>

            <form method="POST"
                  action="{{ route('student.internships.modules.tasks.submit', [$internship, $module, $task]) }}"
                  enctype="multipart/form-data">

                @csrf

                @if($task->submission_type === 'text')

                    <div class="form-group">

                        <label>
                            Your Answer *
                        </label>

                        <textarea name="submission_text"
                                  placeholder="Write your answer or describe the work you completed..."
                                  required>{{ old('submission_text', $submission?->submission_text) }}</textarea>

                    </div>

                @elseif($task->submission_type === 'github_link')

                    <div class="form-group">

                        <label>
                            GitHub Repository URL *
                        </label>

                        <input type="url"
                               name="submission_url"
                               value="{{ old('submission_url', $submission?->submission_url) }}"
                               placeholder="https://github.com/username/project"
                               required>

                        <div class="help">
                            Submit the GitHub repository containing your work.
                        </div>

                    </div>

                    <div class="form-group">

                        <label>
                            Comments
                        </label>

                        <textarea name="submission_text_comments"
                                  placeholder="Add any notes for the employer...">{{ old('submission_text_comments', $submission?->submission_text) }}</textarea>

                    </div>

                @elseif($task->submission_type === 'file_upload')

                    <div class="form-group">

                        <label>
                            Upload Your Work *
                        </label>

                        <input type="file"
                               name="submission_file"
                               required>

                        <div class="help">
                            Maximum file size: 10 MB.
                        </div>

                    </div>

                    <div class="form-group">

                        <label>
                            Comments
                        </label>

                        <textarea name="submission_text_comments"
                                  placeholder="Add any notes for the employer...">{{ old('submission_text_comments', $submission?->submission_text) }}</textarea>

                    </div>

                @endif

                <button type="submit"
                        class="btn">

                    {{ $submission ? 'Resubmit Task' : 'Submit Task' }}

                </button>

            </form>

        </div>

    </div>

</div>

@endsection
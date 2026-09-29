@extends('layouts.app')

@section('title', $task->title . ' - Submissions')

@section('content')

<style>
    :root {
        --blue: #3376F2;
        --navy: #0f172a;
        --text: #172033;
        --muted: #64748b;
        --border: #e2e8f0;
        --bg: #f8fafc;
        --green: #16a34a;
        --orange: #d97706;
        --red: #dc2626;
    }

    .submission-page {
        min-height: 100vh;
        background: var(--bg);
        padding: 30px 0 60px;
    }

    .submission-container {
        max-width: 1100px;
        margin: auto;
        padding: 0 20px;
    }

    .header {
        background: white;
        border: 1px solid var(--border);
        border-radius: 18px;
        padding: 25px;
        margin-bottom: 20px;
    }

    .back {
        color: var(--blue);
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
    }

    .header h1 {
        margin: 14px 0 7px;
        color: var(--navy);
        font-size: 25px;
    }

    .header p {
        margin: 0;
        color: var(--muted);
        font-size: 14px;
    }

    .success {
        background: #ecfdf3;
        border: 1px solid #bbf7d0;
        color: #166534;
        padding: 13px;
        border-radius: 10px;
        margin-bottom: 18px;
    }

    .submission-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: 15px;
        padding: 22px;
        margin-bottom: 15px;
    }

    .student-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
    }

    .student-info {
        display: flex;
        align-items: center;
        gap: 13px;
    }

    .avatar {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: #eef4ff;
        color: var(--blue);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
    }

    .student-info h3 {
        margin: 0 0 3px;
        color: var(--navy);
        font-size: 16px;
    }

    .student-info span {
        color: var(--muted);
        font-size: 12px;
    }

    .status {
        padding: 7px 11px;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 700;
    }

    .status-submitted {
        background: #fff7ed;
        color: #c2410c;
    }

    .status-completed {
        background: #ecfdf3;
        color: #15803d;
    }

    .status-changes_requested {
        background: #fff1f2;
        color: #be123c;
    }

    .submission-content {
        margin-top: 20px;
        border-top: 1px solid var(--border);
        padding-top: 18px;
    }

    .label {
        color: var(--muted);
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 7px;
    }

    .content-box {
        background: #f8fafc;
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 13px;
        color: var(--text);
        font-size: 14px;
        line-height: 1.6;
        white-space: pre-wrap;
        margin-bottom: 15px;
    }

    .submission-link {
        color: var(--blue);
        font-weight: 600;
        text-decoration: none;
    }

    .feedback {
        background: #fffaf0;
        border: 1px solid #fde68a;
        border-radius: 10px;
        padding: 12px;
        color: #92400e;
        font-size: 13px;
        margin-bottom: 15px;
    }

    .actions {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        margin-top: 15px;
    }

    .btn {
        border: 0;
        border-radius: 9px;
        padding: 10px 14px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
    }

    .btn-success {
        background: #16a34a;
        color: white;
    }

    .btn-warning {
        background: #fff7ed;
        color: #c2410c;
        border: 1px solid #fed7aa;
    }

    .empty {
        background: white;
        border: 1px dashed #cbd5e1;
        border-radius: 15px;
        padding: 55px;
        text-align: center;
        color: var(--muted);
    }

    .review-box {
        display: none;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid var(--border);
    }

    .review-box.show {
        display: block;
    }

    textarea {
        width: 100%;
        box-sizing: border-box;
        min-height: 90px;
        border: 1px solid var(--border);
        border-radius: 9px;
        padding: 11px;
        resize: vertical;
        font-size: 13px;
    }

    .review-buttons {
        display: flex;
        gap: 8px;
        margin-top: 9px;
    }
</style>

<div class="submission-page">

    <div class="submission-container">

        <div class="header">

            <a href="{{ route('employer.internships.modules.tasks.index', [$internship, $module]) }}"
               class="back">
                ← Back to Tasks
            </a>

            <h1>{{ $task->title }}</h1>

            <p>
                {{ $module->title }}
                ·
                {{ $internship->title }}
            </p>

        </div>

        @if(session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        @forelse($submissions as $submission)

            <div class="submission-card">

                <div class="student-header">

                    <div class="student-info">

                        <div class="avatar">
                            {{ strtoupper(substr($submission->student->name ?? 'S', 0, 1)) }}
                        </div>

                        <div>
                            <h3>
                                {{ $submission->student->name ?? 'Student' }}
                            </h3>

                            <span>
                                Submitted
                                {{ optional($submission->submitted_at)->format('d M Y, h:i A') }}
                            </span>
                        </div>

                    </div>

                    <span class="status status-{{ $submission->status }}">
                        {{ ucwords(str_replace('_', ' ', $submission->status)) }}
                    </span>

                </div>

                <div class="submission-content">

                    @if($submission->submission_text)

                        <div class="label">
                            Student Response
                        </div>

                        <div class="content-box">
                            {{ $submission->submission_text }}
                        </div>

                    @endif

                    @if($submission->submission_url)

                        <div class="label">
                            Submitted Link
                        </div>

                        <div class="content-box">

                            <a href="{{ $submission->submission_url }}"
                               target="_blank"
                               class="submission-link">
                                {{ $submission->submission_url }}
                            </a>

                        </div>

                    @endif

                    @if($submission->file_path)

                        <div class="label">
                            Uploaded File
                        </div>

                        <div class="content-box">

                            <a href="{{ Storage::url($submission->file_path) }}"
                               target="_blank"
                               class="submission-link">
                                View / Download Submitted File
                            </a>

                        </div>

                    @endif

                    @if($submission->employer_feedback)

                        <div class="feedback">

                            <strong>Employer Feedback:</strong><br>

                            {{ $submission->employer_feedback }}

                        </div>

                    @endif

                    @if($submission->status !== 'completed')

                        <div class="actions">

                            <button type="button"
                                    class="btn btn-success"
                                    onclick="showReview({{ $submission->id }}, 'complete')">
                                ✓ Mark Completed
                            </button>

                            <button type="button"
                                    class="btn btn-warning"
                                    onclick="showReview({{ $submission->id }}, 'request_changes')">
                                Request Changes
                            </button>

                        </div>

                        <div class="review-box"
                             id="review{{ $submission->id }}">

                            <form method="POST"
                                  action="{{ route('employer.submissions.review', $submission) }}">

                                @csrf
                                @method('PATCH')

                                <input type="hidden"
                                       name="action"
                                       id="action{{ $submission->id }}"
                                       value="complete">

                                <div class="label">
                                    Feedback
                                </div>

                                <textarea name="feedback"
                                          placeholder="Write feedback for the student..."></textarea>

                                <div class="review-buttons">

                                    <button type="submit"
                                            class="btn btn-success"
                                            id="submitReview{{ $submission->id }}">
                                        Submit Review
                                    </button>

                                    <button type="button"
                                            class="btn btn-warning"
                                            onclick="hideReview({{ $submission->id }})">
                                        Cancel
                                    </button>

                                </div>

                            </form>

                        </div>

                    @endif

                </div>

            </div>

        @empty

            <div class="empty">

                <h3>No submissions yet</h3>

                <p>
                    Students have not submitted this task yet.
                </p>

            </div>

        @endforelse

    </div>

</div>

<script>
function showReview(id, action) {

    const box = document.getElementById('review' + id);
    const actionInput = document.getElementById('action' + id);
    const button = document.getElementById('submitReview' + id);

    actionInput.value = action;

    if (action === 'complete') {
        button.textContent = 'Mark Completed';
        button.className = 'btn btn-success';
    } else {
        button.textContent = 'Request Changes';
        button.className = 'btn btn-warning';
    }

    box.classList.add('show');
}

function hideReview(id) {
    document.getElementById('review' + id).classList.remove('show');
}
</script>

@endsection
@extends('layouts.app')

@section('title', $module->title . ' - Tasks')

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
    }

    .page {
        min-height: 100vh;
        background: var(--bg);
        padding: 30px 0 60px;
    }

    .container {
        max-width: 1050px;
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
    }

    .header p {
        color: var(--muted);
        margin: 0;
    }

    .success {
        background: #ecfdf3;
        border: 1px solid #bbf7d0;
        color: #166534;
        padding: 13px;
        border-radius: 10px;
        margin-bottom: 18px;
    }

    .tasks {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .task {
        background: white;
        border: 1px solid var(--border);
        border-radius: 15px;
        padding: 20px;
    }

    .task-header {
        display: flex;
        gap: 13px;
        align-items: flex-start;
    }

    .number {
        min-width: 38px;
        height: 38px;
        background: #eef4ff;
        color: var(--blue);
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
    }

    .task h3 {
        margin: 0 0 7px;
        color: var(--navy);
    }

    .description {
        color: var(--muted);
        font-size: 13px;
        line-height: 1.6;
    }

    .meta {
        margin: 15px 0;
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .badge {
        border-radius: 8px;
        padding: 7px 9px;
        font-size: 11px;
        font-weight: 700;
    }

    .badge-submitted {
        background: #fff7ed;
        color: #c2410c;
    }

    .badge-completed {
        background: #ecfdf3;
        color: #15803d;
    }

    .badge-changes_requested {
        background: #fff1f2;
        color: #be123c;
    }

    .badge-pending {
        background: #f1f5f9;
        color: #64748b;
    }

    .btn {
        display: inline-flex;
        text-decoration: none;
        background: var(--blue);
        color: white;
        padding: 10px 14px;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 600;
    }
</style>

<div class="page">

    <div class="container">

        <div class="header">

            <a href="{{ route('student.internships.modules.index', $internship) }}"
               class="back">
                ← Back to Modules
            </a>

            <h1>{{ $module->title }}</h1>

            <p>
                {{ $module->description ?: 'Complete the tasks below.' }}
            </p>

        </div>

        @if(session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        <div class="tasks">

            @forelse($tasks as $index => $task)

                <div class="task">

                    <div class="task-header">

                        <div class="number">
                            {{ $index + 1 }}
                        </div>

                        <div style="flex:1">

                            <h3>
                                {{ $task->title }}
                            </h3>

                            <div class="description">
                                {{ $task->description ?: 'Complete this task according to the instructions.' }}
                            </div>

                        </div>

                    </div>

                    <div class="meta">

                        @if($task->my_submission)

                            <span class="badge badge-{{ $task->my_submission->status }}">
                                {{ ucwords(str_replace('_', ' ', $task->my_submission->status)) }}
                            </span>

                        @else

                            <span class="badge badge-pending">
                                Not Submitted
                            </span>

                        @endif

                        <span class="badge badge-pending">
                            {{ strtoupper(str_replace('_', ' ', $task->submission_type)) }}
                        </span>

                    </div>

                    <a href="{{ route('student.internships.modules.tasks.show', [$internship, $module, $task]) }}"
                       class="btn">

                        @if($task->my_submission)
                            View / Resubmit
                        @else
                            Start Task
                        @endif

                    </a>

                </div>

            @empty

                <div style="background:white;border:1px dashed #cbd5e1;padding:50px;text-align:center;border-radius:15px;color:#64748b;">
                    No tasks have been added to this module yet.
                </div>

            @endforelse

        </div>

    </div>

</div>

@endsection
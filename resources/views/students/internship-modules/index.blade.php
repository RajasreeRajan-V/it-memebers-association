@extends('layouts.app')

@section('title', $internship->title . ' - Learning Modules')

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
    }

    .learning-page {
        min-height: 100vh;
        background: var(--bg);
        padding: 30px 0 60px;
    }

    .container-learning {
        max-width: 1100px;
        margin: auto;
        padding: 0 20px;
    }

    .hero {
        background: white;
        border: 1px solid var(--border);
        border-radius: 18px;
        padding: 28px;
        margin-bottom: 20px;
    }

    .hero h1 {
        margin: 0 0 7px;
        color: var(--navy);
        font-size: 28px;
    }

    .hero p {
        margin: 0;
        color: var(--muted);
    }

    .progress-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 20px;
    }

    .progress-top {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        color: var(--text);
        font-size: 14px;
        font-weight: 600;
    }

    .progress-bar {
        height: 10px;
        background: #e2e8f0;
        border-radius: 20px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        background: var(--blue);
        border-radius: 20px;
    }

    .success {
        background: #ecfdf3;
        border: 1px solid #bbf7d0;
        color: #166534;
        padding: 13px;
        border-radius: 10px;
        margin-bottom: 18px;
    }

    .modules {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }

    .module {
        background: white;
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 22px;
    }

    .module-number {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: #eef4ff;
        color: var(--blue);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        margin-bottom: 13px;
    }

    .module h3 {
        margin: 0 0 7px;
        color: var(--navy);
    }

    .module p {
        color: var(--muted);
        font-size: 13px;
        line-height: 1.6;
        min-height: 42px;
    }

    .module-info {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        margin: 15px 0;
    }

    .badge {
        background: #f8fafc;
        border: 1px solid var(--border);
        border-radius: 8px;
        padding: 7px 9px;
        font-size: 12px;
        color: var(--muted);
    }

    .completed {
        color: var(--green);
    }

    .btn {
        display: inline-flex;
        text-decoration: none;
        border-radius: 9px;
        padding: 10px 15px;
        background: var(--blue);
        color: white;
        font-size: 13px;
        font-weight: 600;
    }

    @media(max-width: 700px) {
        .modules {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="learning-page">

    <div class="container-learning">

        <div class="hero">

            <h1>{{ $internship->title }}</h1>

            <p>
                Complete each module and submit the assigned tasks.
            </p>

        </div>

        @if(session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        <div class="progress-card">

            <div class="progress-top">

                <span>Internship Progress</span>

                <span>
                    {{ $completedTasks }} / {{ $totalTasks }} tasks
                    ({{ $progressPercent }}%)
                </span>

            </div>

            <div class="progress-bar">

                <div class="progress-fill"
                     style="width: {{ $progressPercent }}%;">
                </div>

            </div>

        </div>

        <div class="modules">

            @forelse($modules as $index => $module)

                <div class="module">

                    <div class="module-number">
                        {{ $index + 1 }}
                    </div>

                    <h3>
                        {{ $module->title }}
                    </h3>

                    <p>
                        {{ $module->description ?: 'Complete the tasks in this learning module.' }}
                    </p>

                    <div class="module-info">

                        <span class="badge">
                            {{ $module->tasks_count }}
                            {{ $module->tasks_count == 1 ? 'Task' : 'Tasks' }}
                        </span>

                        <span class="badge completed">
                            {{ $module->completed_tasks_count }}
                            Completed
                        </span>

                        @if($module->duration)
                            <span class="badge">
                                {{ $module->duration }}
                            </span>
                        @endif

                    </div>

                    <a href="{{ route('student.internships.modules.show', [$internship, $module]) }}"
                       class="btn">
                        Open Module →
                    </a>

                </div>

            @empty

                <div style="grid-column:1/-1;background:white;padding:50px;text-align:center;border-radius:15px;">
                    No learning modules are available yet.
                </div>

            @endforelse

        </div>

    </div>

</div>

@endsection
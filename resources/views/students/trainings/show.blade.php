@extends('layouts.app')

@section('title', $training->title)

@section('content')

<div class="container py-4">


{{-- Back --}}
<div class="mb-3">
    <a href="{{ route('student.trainings.index') }}"
       class="text-decoration-none text-muted">
        <i class="bi bi-arrow-left"></i> Back to Trainings
    </a>
</div>

<div class="card mb-4 shadow-sm border-0 overflow-hidden">

    {{-- Thumbnail --}}
    <img
        src="{{ $training->thumbnail
            ? asset('storage/' . $training->thumbnail)
            : 'https://via.placeholder.com/900x300?text=Training' }}"
        class="card-img-top"
        alt="{{ $training->title }}"
        style="height:320px; object-fit:cover;"
    >

    <div class="card-body p-4">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-start gap-3 mb-3">

            <div>
                <h2 class="fw-bold mb-2">
                    {{ $training->title }}
                </h2>

                <p class="text-muted mb-0">
                    <i class="bi bi-person"></i>
                    By {{ $training->mentor->name ?? 'Mentor' }}
                </p>
            </div>

            @if($training->level)
                <span class="badge bg-primary fs-6">
                    {{ ucfirst($training->level) }}
                </span>
            @endif

        </div>

        {{-- Category / Technology --}}
        <div class="mb-3">

            @if($training->category)
                <span class="badge bg-light text-dark border me-1">
                    {{ $training->category }}
                </span>
            @endif

            @if($training->technology)
                <span class="badge bg-light text-dark border">
                    {{ $training->technology }}
                </span>
            @endif

        </div>

        {{-- Description --}}
        @if($training->short_description)
            <p class="lead mb-3">
                {{ $training->short_description }}
            </p>
        @endif

        @if($training->full_description)
            <p class="text-muted">
                {{ $training->full_description }}
            </p>
        @endif


        {{-- Training Information --}}
        <div class="row g-3 my-4">

            <div class="col-6 col-md-3">
                <div class="border rounded p-3 text-center h-100">
                    <div class="fw-bold">
                        {{ $training->duration ?: 'N/A' }}
                    </div>
                    <small class="text-muted">
                        Duration
                    </small>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="border rounded p-3 text-center h-100">
                    <div class="fw-bold">
                        {{ $training->total_sessions ?: 0 }}
                    </div>
                    <small class="text-muted">
                        Sessions
                    </small>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="border rounded p-3 text-center h-100">
                    <div class="fw-bold">
                        {{ $training->training_type
                            ? ucfirst($training->training_type)
                            : 'N/A' }}
                    </div>
                    <small class="text-muted">
                        Type
                    </small>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="border rounded p-3 text-center h-100">
                    <div class="fw-bold">
                        {{ $training->language ?: 'N/A' }}
                    </div>
                    <small class="text-muted">
                        Language
                    </small>
                </div>
            </div>

        </div>


        {{-- What You'll Learn --}}
        @if($training->outcomes && $training->outcomes->count())

            <div class="mb-4">

                <h5 class="fw-bold mb-3">
                    <i class="bi bi-check-circle text-success"></i>
                    What You'll Learn
                </h5>

                <ul class="list-group">

                    @foreach($training->outcomes as $outcome)

                        <li class="list-group-item">
                            <i class="bi bi-check2 text-success me-2"></i>
                            {{ $outcome->outcome }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- Requirements --}}
        @if($training->requirements && $training->requirements->count())

            <div class="mb-4">

                <h5 class="fw-bold mb-3">
                    <i class="bi bi-list-check text-primary"></i>
                    Requirements
                </h5>

                <ul class="list-group">

                    @foreach($training->requirements as $requirement)

                        <li class="list-group-item">
                            <i class="bi bi-dot"></i>
                            {{ $requirement->requirement }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- Curriculum --}}
        @if($training->modules && $training->modules->count())

            <div class="mb-4">

                <h5 class="fw-bold mb-3">
                    <i class="bi bi-book"></i>
                    Curriculum
                </h5>

                <div class="accordion" id="curriculumAccordion">

                    @foreach($training->modules as $moduleIndex => $module)

                        <div class="accordion-item">

                            <h2 class="accordion-header"
                                id="heading{{ $moduleIndex }}">

                                <button
                                    class="accordion-button collapsed"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#module{{ $moduleIndex }}"
                                    aria-expanded="false"
                                    aria-controls="module{{ $moduleIndex }}"
                                >

                                    <strong>
                                        {{ $module->title }}
                                    </strong>

                                    <span class="badge bg-secondary ms-2">
                                        {{ $module->sessions->count() }}
                                        {{ $module->sessions->count() == 1 ? 'session' : 'sessions' }}
                                    </span>

                                </button>

                            </h2>

                            <div
                                id="module{{ $moduleIndex }}"
                                class="accordion-collapse collapse"
                                data-bs-parent="#curriculumAccordion"
                            >

                                <div class="accordion-body">

                                    @if($module->sessions->count())

                                        <ol class="mb-0">

                                            @foreach($module->sessions as $session)

                                                <li class="mb-2">
                                                    {{ $session->title }}
                                                </li>

                                            @endforeach

                                        </ol>

                                    @else

                                        <p class="text-muted mb-0">
                                            No sessions available.
                                        </p>

                                    @endif

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        @endif


        {{-- Certificate --}}
        @if($training->certificate_enabled)

            <div class="alert alert-success d-flex align-items-center">

                <i class="bi bi-patch-check-fill fs-4 me-2"></i>

                <div>
                    <strong>Certificate Available</strong>
                    <br>
                    <small>
                        Certificate will be awarded on successful completion.
                    </small>
                </div>

            </div>

        @endif


        <hr class="my-4">


        {{-- Enrollment --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

            @if($enrollment)

                <div>

                    <span class="text-muted d-block">
                        Your Progress
                    </span>

                    <strong class="fs-5">
                        {{ $enrollment->progress }}%
                    </strong>

                </div>

                <a
                    href="{{ route('student.trainings.learn', $training) }}"
                    class="btn btn-success btn-lg"
                >
                    <i class="bi bi-play-circle me-1"></i>
                    Continue Learning
                </a>

            @else

                <div>

                    @if($training->isFull())

                        <span class="text-danger">
                            <i class="bi bi-exclamation-circle"></i>
                            This training is currently full.
                        </span>

                    @else

                        <span class="text-muted">
                            Ready to start this training?
                        </span>

                    @endif

                </div>

                <form
                    action="{{ route('student.trainings.enroll', $training) }}"
                    method="POST"
                >

                    @csrf

                    <button
                        type="submit"
                        class="btn btn-primary btn-lg"
                        {{ $training->isFull() ? 'disabled' : '' }}
                    >

                        <i class="bi bi-journal-plus me-1"></i>

                        {{ $training->isFull()
                            ? 'Training Full'
                            : 'Register / Enroll' }}

                    </button>

                </form>

            @endif

        </div>

    </div>

</div>


</div>

@endsection

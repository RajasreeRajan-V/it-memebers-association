@extends('layouts.app')

@section('title', 'Create Training')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-1">
                <i class="bi bi-plus-circle"></i> Create Training
            </h3>
            <p class="text-muted mb-0">
                Create your training program, curriculum, requirements and learning outcomes.
            </p>
        </div>

        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    <form
        action="{{ route('mentor.trainings.store') }}"
        method="POST"
        enctype="multipart/form-data"
        id="training-form"
    >
        @include('mentor.trainings._form', ['training' => $training])
    </form>

</div>

@endsection
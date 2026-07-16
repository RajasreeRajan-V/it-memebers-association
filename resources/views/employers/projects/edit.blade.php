@extends('layouts.app')

@section('content')

@include('employer.projects._styles')

<div class="project-form-container">
    <div class="form-card">
        <div class="form-card-header">
            <h4><i class="fas fa-diagram-project"></i> Edit Project</h4>
        </div>
        <div class="form-card-body">
            @if ($errors->any())
                <div class="alert-custom alert-error-custom">Please fix the errors below.</div>
            @endif

            <form action="{{ route('employer.projects.update', $project) }}" method="POST" id="projectForm">
                @csrf
                @method('PUT')
                @include('employer.projects._form', ['project' => $project])

                <div class="form-actions">
                    <button type="submit" class="btn-custom btn-primary-custom">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
                    <a href="{{ route('employer.projects.show', $project) }}" class="btn-custom btn-secondary-custom">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

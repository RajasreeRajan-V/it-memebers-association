@extends('layouts.app')

@section('content')

@include('employers.projects._styles')

<div class="project-form-container">
    <div class="form-card">
        <div class="form-card-header">
            <h4><i class="fas fa-diagram-project"></i> Post a Project</h4>
        </div>
        <div class="form-card-body">
            @if(session('success'))
                <div class="alert-custom alert-success-custom">{{ session('success') }}</div>
            @endif

            <form action="{{ route('employer.projects.store') }}" method="POST" id="projectForm">
                @csrf
                @include('employers.projects._form')

                <div class="form-actions">
                    <button type="submit" class="btn-custom btn-primary-custom">
                        <i class="fas fa-paper-plane"></i> Submit
                    </button>
                    <a href="{{ route('employer.projects.index') }}" class="btn-custom btn-secondary-custom">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

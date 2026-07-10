{{-- resources/views/employer/projects/edit.blade.php --}}
@extends('employers.layout.app')

@section('title', 'Edit Project')
@section('page-title', 'Edit Project')
@section('page-subtitle', $project->title)

@section('content')
    <div class="form-card">
        <div class="form-card-header">
            <h2><i class="fas fa-diagram-project"></i> Edit Project Details</h2>
            <p>Updating this project will send it back to admin for re-approval.</p>
        </div>
        <div class="form-card-body">
            <form action="{{ route('employer.projects.update', $project) }}" method="POST">
                @csrf
                @method('PUT')
                @include('employers.projects._form')

                <div class="form-actions">
                    <button type="submit" class="btn-primary"><i class="fas fa-check"></i> Save Changes</button>
                    <a href="{{ route('employer.projects.index') }}" class="btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')
    @include('employers.partials.form-styles')
@endpush

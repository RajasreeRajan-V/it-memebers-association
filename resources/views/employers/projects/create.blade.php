{{-- resources/views/employer/projects/create.blade.php --}}
@extends('employers.layout.app')

@section('title', 'Post a Project')
@section('page-title', 'Post a Project')
@section('page-subtitle', 'Create a new freelance project listing')

@section('content')
    <div class="form-card">
        <div class="form-card-header">
            <h2><i class="fas fa-diagram-project"></i> Project Details</h2>
            <p>Fill in the details below. It will be visible to freelancers after admin approval.</p>
        </div>
        <div class="form-card-body">
            <form action="{{ route('employer.projects.store') }}" method="POST">
                @csrf
                @include('employers.projects._form')

                <div class="form-actions">
                    <button type="submit" class="btn-primary"><i class="fas fa-paper-plane"></i> Submit Project</button>
                    <a href="{{ route('employer.projects.index') }}" class="btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')
    @include('employers.partials.form-styles')
@endpush

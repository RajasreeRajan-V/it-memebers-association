{{-- resources/views/employer/jobs/create.blade.php --}}
@extends('employers.layout.app')

@section('title', 'Post a Job')
@section('page-title', 'Post a Job')
@section('page-subtitle', 'Create a new job listing')

@section('content')
    <div class="form-card">
        <div class="form-card-header">
            <h2><i class="fas fa-briefcase"></i> Job Details</h2>
            <p>Fill in the details below. Your job will go live after admin approval.</p>
        </div>
        <div class="form-card-body">
            <form action="{{ route('employer.jobs.store') }}" method="POST">
                @csrf
                @include('employers.jobs._form')

                <div class="form-actions">
                    <button type="submit" class="btn-primary"><i class="fas fa-paper-plane"></i> Submit Job</button>
                    <a href="{{ route('employer.jobs.index') }}" class="btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')
    @include('employers.partials.form-styles')
@endpush

{{-- resources/views/employer/jobs/edit.blade.php --}}
@extends('employers.layout.app')

@section('title', 'Edit Job')
@section('page-title', 'Edit Job')
@section('page-subtitle', $job->title)

@section('content')
    <div class="form-card">
        <div class="form-card-header">
            <h2><i class="fas fa-briefcase"></i> Edit Job Details</h2>
            <p>Updating this job will send it back to admin for re-approval.</p>
        </div>
        <div class="form-card-body">
            <form action="{{ route('employer.jobs.update', $job) }}" method="POST">
                @csrf
                @method('PUT')
                @include('employers.jobs._form')

                <div class="form-actions">
                    <button type="submit" class="btn-primary"><i class="fas fa-check"></i> Save Changes</button>
                    <a href="{{ route('employer.jobs.index') }}" class="btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')
    @include('employers.partials.form-styles')
@endpush

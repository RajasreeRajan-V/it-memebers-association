{{-- resources/views/employer/internships/create.blade.php --}}
@extends('employers.layout.app')

@section('title', 'Post an Internship')
@section('page-title', 'Post an Internship')
@section('page-subtitle', 'Create a new internship listing')

@section('content')
    <div class="form-card">
        <div class="form-card-header">
            <h2><i class="fas fa-user-graduate"></i> Internship Details</h2>
            <p>Fill in the details below. It will be visible to students after admin approval.</p>
        </div>
        <div class="form-card-body">
            <form action="{{ route('employer.internships.store') }}" method="POST">
                @csrf
                @include('employers.internships._form')

                <div class="form-actions">
                    <button type="submit" class="btn-primary"><i class="fas fa-paper-plane"></i> Submit Internship</button>
                    <a href="{{ route('employer.internships.index') }}" class="btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')
    @include('employers.partials.form-styles')
@endpush

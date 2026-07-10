{{-- resources/views/employer/internships/edit.blade.php --}}
@extends('employers.layout.app')

@section('title', 'Edit Internship')
@section('page-title', 'Edit Internship')
@section('page-subtitle', $internship->title)

@section('content')
    <div class="form-card">
        <div class="form-card-header">
            <h2><i class="fas fa-user-graduate"></i> Edit Internship Details</h2>
            <p>Updating this internship will send it back to admin for re-approval.</p>
        </div>
        <div class="form-card-body">
            <form action="{{ route('employer.internships.update', $internship) }}" method="POST">
                @csrf
                @method('PUT')
                @include('employers.internships._form')

                <div class="form-actions">
                    <button type="submit" class="btn-primary"><i class="fas fa-check"></i> Save Changes</button>
                    <a href="{{ route('employer.internships.index') }}" class="btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')
    @include('employers.partials.form-styles')
@endpush

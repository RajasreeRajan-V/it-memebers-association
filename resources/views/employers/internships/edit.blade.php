@extends('layouts.app')

@section('content')

@include('employers.internships._styles')

<div class="internship-form-container">
    <div class="form-card">
        <div class="form-card-header">
            <h4><i class="fas fa-user-graduate"></i> Edit Internship</h4>
        </div>
        <div class="form-card-body">
            @if ($errors->any())
                <div class="alert-custom alert-error-custom">Please fix the errors below.</div>
            @endif

            <form action="{{ route('employer.internships.update', $internship) }}" method="POST" id="internshipForm">
                @csrf
                @method('PUT')
                @include('employers.internships._form', ['internship' => $internship])

                <div class="form-actions">
                    <button type="submit" class="btn-custom btn-primary-custom">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
                    <a href="{{ route('employer.internships.show', $internship) }}" class="btn-custom btn-secondary-custom">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@include('employers.internships._scripts')

@endsection

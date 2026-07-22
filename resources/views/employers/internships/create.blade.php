@extends('layouts.app')

@section('content')

@include('employers.internships._styles')

<div class="internship-form-container">
    <div class="form-card">
        <div class="form-card-header">
            <h4><i class="fas fa-user-graduate"></i> Post an Internship</h4>
        </div>
        <div class="form-card-body">
            @if(session('success'))
                <div class="alert-custom alert-success-custom">{{ session('success') }}</div>
            @endif

            <form action="{{ route('employer.internships.store') }}" method="POST" id="internshipForm">
                @csrf
                @include('employers.internships._form')

                <div class="form-actions">
                    <button type="submit" class="btn-custom btn-primary-custom">
                        <i class="fas fa-paper-plane"></i> Submit
                    </button>
                    <a href="{{ route('employer.internships.index') }}" class="btn-custom btn-secondary-custom">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@include('employers.internships._scripts')

@endsection

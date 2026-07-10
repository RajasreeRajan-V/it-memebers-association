{{-- resources/views/employer/startup-profile/create.blade.php --}}
@extends('employers.layout.app')

@section('title', 'Create Startup Profile')
@section('page-title', 'Startup Profile')
@section('page-subtitle', 'Set up your startup profile')

@section('content')
    <div class="form-card">
        <div class="form-card-header">
            <h2><i class="fas fa-rocket"></i> Startup Information</h2>
            <p>This profile becomes visible to investors after admin approval.</p>
        </div>
        <div class="form-card-body">
            <form action="{{ route('employer.startup-profile.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('employers.startup-profile._form')

                <div class="form-actions">
                    <button type="submit" class="btn-primary"><i class="fas fa-paper-plane"></i> Submit Profile</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')
    @include('employers.partials.form-styles')
@endpush

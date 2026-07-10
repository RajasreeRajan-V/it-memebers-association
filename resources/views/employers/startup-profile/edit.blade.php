{{-- resources/views/employer/startup-profile/edit.blade.php --}}
@extends('employers.layout.app')

@section('title', 'Edit Startup Profile')
@section('page-title', 'Startup Profile')
@section('page-subtitle', 'Edit your startup profile')

@section('content')
    <div class="form-card">
        <div class="form-card-header">
            <h2><i class="fas fa-rocket"></i> Edit Startup Information</h2>
            <p>Updating this profile will send it back to admin for re-approval.</p>
        </div>
        <div class="form-card-body">
            <form action="{{ route('employer.startup-profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('employers.startup-profile._form')

                <div class="form-actions">
                    <button type="submit" class="btn-primary"><i class="fas fa-check"></i> Save Changes</button>
                    <a href="{{ route('employer.startup-profile.show') }}" class="btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')
    @include('employers.partials.form-styles')
@endpush

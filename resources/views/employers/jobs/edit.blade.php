@extends('layouts.app')

@section('content')

<div class="jobpost-wrapper">

    <div class="jobpost-header">
        <h1>Edit Job</h1>
        <p>Update the details of "{{ $job->title }}".</p>
    </div>

    @if ($errors->any())
        <div class="jobpost-alert jobpost-alert-error">
            <p class="jobpost-alert-title">Please fix the following:</p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('employer.jobs.update', $job) }}" method="POST" class="jobpost-form">
        @csrf
        @method('PUT')
        @include('employers.jobs._form', ['job' => $job])

        <div class="jobpost-actions jobpost-actions-split">
            <a href="{{ route('employer.jobs.show', $job) }}" class="jobpost-back">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                Back to Job
            </a>

            <div class="jobpost-actions-right">
                <a href="{{ route('employer.jobs.show', $job) }}" class="jobpost-btn jobpost-btn-secondary">Cancel</a>
                <button type="submit" class="jobpost-btn jobpost-btn-primary">
                    Save Changes
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
                </button>
            </div>
        </div>
    </form>
</div>

@include('employers.jobs._styles')

@endsection
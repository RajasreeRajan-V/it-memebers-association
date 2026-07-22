@extends('layouts.app')

@section('content')

<div class="job-form-wrapper">

    <div class="job-form-header">
        <h1>Edit Job</h1>
        <p>Update the details of "{{ $job->title }}".</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-error">
            <p class="alert-title">Please fix the following:</p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('employer.jobs.update', $job) }}" method="POST" class="job-form">
        @csrf
        @method('PUT')
        @include('employers.jobs._form', ['job' => $job])

        <div class="form-actions">
            <a href="{{ route('employer.jobs.show', $job) }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
    </form>
</div>

@include('employers.jobs._styles')

@endsection

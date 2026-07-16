@extends('layouts.app')

@section('content')

<div class="job-form-wrapper">

    <div class="job-form-header">
        <h1>Post a New Job</h1>
        <p>Fill in the details below to publish a job opening.</p>
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

    <form action="{{ route('employer.jobs.store') }}" method="POST" class="job-form">
        @csrf
        @include('employers.jobs._form')

        <div class="form-actions">
            <a href="{{ route('employer.jobs.index') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Publish Job</button>
        </div>
    </form>
</div>

@include('employers.jobs._styles')

@endsection

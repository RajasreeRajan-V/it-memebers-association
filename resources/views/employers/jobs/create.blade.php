@extends('layouts.app')

@section('content')

<div class="jobpost-wrapper">

    <div class="jobpost-header">
        <h1>Post a New Job</h1>
        <p>Fill in the details below to publish a job opening.</p>
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

    @if (session('success'))
        <div class="jobpost-alert jobpost-alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('employer.jobs.store') }}" method="POST" class="jobpost-form">
        @csrf
        @include('employers.jobs._form')

        <div class="jobpost-actions">
            <a href="{{ route('employer.jobs.index') }}" class="jobpost-btn jobpost-btn-secondary">Cancel</a>
            <button type="submit" class="jobpost-btn jobpost-btn-primary">Publish Job</button>
        </div>
    </form>
</div>

@include('employers.jobs._styles')

@endsection
@extends('layouts.app')
@section('title', 'Edit Training')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="mb-0"><i class="bi bi-pencil-square"></i> Edit Training</h3>
    @include('partials.status-badge', ['status' => $training->status])
</div>

@if ($training->status === 'rejected' && $training->rejection_reason)
    <div class="alert alert-danger">
        <strong>Admin feedback:</strong> {{ $training->rejection_reason }}
    </div>
@endif

<form action="{{ route('mentor.trainings.update', $training) }}" method="POST" enctype="multipart/form-data">
    @include('mentor.trainings._form', ['training' => $training])
</form>
@endsection

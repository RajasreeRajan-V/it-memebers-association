@extends('layouts.app')
@section('title', 'Create Training')

@section('content')
<h3 class="mb-4"><i class="bi bi-plus-circle"></i> Create Training</h3>

<form action="{{ route('mentor.trainings.store') }}" method="POST" enctype="multipart/form-data">
    @include('mentor.trainings._form', ['training' => $training])
</form>
@endsection

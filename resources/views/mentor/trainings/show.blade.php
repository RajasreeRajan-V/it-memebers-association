@extends('layouts.app')
@section('title', $training->title)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="mb-0">{{ $training->title }}</h3>
    @include('partials.status-badge', ['status' => $training->status])
</div>

@if ($training->status === 'rejected' && $training->rejection_reason)
    <div class="alert alert-danger">
        <strong>Rejection reason:</strong> {{ $training->rejection_reason }}
    </div>
@endif

<div class="card mb-4">
    <img src="{{ $training->thumbnail ? asset('storage/'.$training->thumbnail) : 'https://via.placeholder.com/900x300?text=Training' }}"
         class="card-img-top" style="max-height:320px;object-fit:cover;">
    <div class="card-body">
        <p class="text-muted">{{ $training->short_description }}</p>
        <p>{{ $training->full_description }}</p>

        <div class="row g-3 mb-3">
            <div class="col-md-3"><strong>Category:</strong> {{ $training->category }}</div>
            <div class="col-md-3"><strong>Technology:</strong> {{ $training->technology }}</div>
            <div class="col-md-3"><strong>Level:</strong> {{ ucfirst($training->level) }}</div>
            <div class="col-md-3"><strong>Type:</strong> {{ ucfirst($training->training_type) }}</div>
            <div class="col-md-3"><strong>Duration:</strong> {{ $training->duration }}</div>
            <div class="col-md-3"><strong>Total Sessions:</strong> {{ $training->total_sessions }}</div>
            <div class="col-md-3"><strong>Language:</strong> {{ $training->language }}</div>
            <div class="col-md-3"><strong>Max Participants:</strong> {{ $training->max_participants ?? 'Unlimited' }}</div>
        </div>

        @if ($training->outcomes->count())
            <h5>What You'll Learn</h5>
            <ul>
                @foreach ($training->outcomes as $o)
                    <li>{{ $o->outcome }}</li>
                @endforeach
            </ul>
        @endif

        @if ($training->requirements->count())
            <h5>Requirements</h5>
            <ul>
                @foreach ($training->requirements as $r)
                    <li>{{ $r->requirement }}</li>
                @endforeach
            </ul>
        @endif

        @if ($training->modules->count())
            <h5>Curriculum</h5>
            <div class="accordion mb-3" id="curriculumAccordion">
                @foreach ($training->modules as $mi => $module)
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#mod{{ $mi }}">{{ $module->title }}</button>
                        </h2>
                        <div id="mod{{ $mi }}" class="accordion-collapse collapse" data-bs-parent="#curriculumAccordion">
                            <div class="accordion-body">
                                <ol>
                                    @foreach ($module->sessions as $session)
                                        <li>
                                            <strong>{{ $session->title }}</strong>
                                            <p class="text-muted small mb-0">{{ $session->description }}</p>
                                        </li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <a href="{{ route('mentor.trainings.index') }}" class="btn btn-outline-secondary">Back</a>
        @if ($training->isEditableByMentor())
            <a href="{{ route('mentor.trainings.edit', $training) }}" class="btn btn-primary">Edit</a>
        @endif
    </div>
</div>
@endsection

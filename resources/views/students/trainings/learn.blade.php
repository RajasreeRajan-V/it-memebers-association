@extends('layouts.app')
@section('title', 'Learn: ' . $training->title)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">{{ $training->title }}</h3>
    <span class="badge bg-primary">{{ $enrollment->progress }}% complete</span>
</div>

<div class="progress mb-4" style="height:10px;">
    <div class="progress-bar" style="width: {{ $enrollment->progress }}%"></div>
</div>

@if ($training->training_type !== 'recorded' && $training->meeting_link)
    <div class="alert alert-info d-flex justify-content-between align-items-center">
        <span><i class="bi bi-camera-video"></i> Live session on {{ $training->platform }} — {{ $training->schedule }}</span>
        <a href="{{ $training->meeting_link }}" target="_blank" class="btn btn-sm btn-primary">Join Live Session</a>
    </div>
@endif

<div class="accordion mb-4" id="learnAccordion">
    @forelse ($training->modules as $mi => $module)
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button {{ $mi === 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse"
                        data-bs-target="#lm{{ $mi }}">{{ $module->title }}</button>
            </h2>
            <div id="lm{{ $mi }}" class="accordion-collapse collapse {{ $mi === 0 ? 'show' : '' }}" data-bs-parent="#learnAccordion">
                <div class="accordion-body">
                    @foreach ($module->sessions as $session)
                        <div class="border rounded p-3 mb-2">
                            <h6>{{ $session->title }}</h6>
                            <p class="text-muted small">{{ $session->description }}</p>
                            @if ($session->video_path)
                                <video controls class="w-100 rounded mb-2" style="max-height:400px;">
                                    <source src="{{ asset('storage/'.$session->video_path) }}">
                                </video>
                            @endif
                            @if ($session->pdf_path)
                                <a href="{{ asset('storage/'.$session->pdf_path) }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-file-earmark-pdf"></i> View PDF
                                </a>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-secondary">No curriculum content added yet.</div>
    @endforelse
</div>

@if ($training->resources->count())
    <h5>Additional Resources</h5>
    <ul class="list-group mb-4">
        @foreach ($training->resources as $resource)
            <li class="list-group-item d-flex justify-content-between">
                {{ $resource->title }}
                <a href="{{ asset('storage/'.$resource->file_path) }}" target="_blank">Download</a>
            </li>
        @endforeach
    </ul>
@endif

<div class="d-flex justify-content-between">
    <a href="{{ route('student.trainings.my-trainings') }}" class="btn btn-outline-secondary">Back to My Trainings</a>

    @if ($enrollment->status !== 'completed')
        <form action="{{ route('student.trainings.complete', $training) }}" method="POST"
              onsubmit="return confirm('Mark this training as completed?');">
            @csrf
            <button class="btn btn-success"><i class="bi bi-check2-circle"></i> Mark as Complete</button>
        </form>
    @else
        <span class="text-success fw-bold"><i class="bi bi-check-circle-fill"></i> Completed</span>
    @endif
</div>
@endsection

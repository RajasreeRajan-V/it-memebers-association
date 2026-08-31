@extends('layouts.app')
@section('title', 'Review Training')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="mb-0">{{ $training->title }}</h3>
    @include('partials.status-badge', ['status' => $training->status])
</div>

<p class="text-muted">Submitted by <strong>{{ $training->mentor->name ?? '—' }}</strong>
    on {{ optional($training->submitted_at)->format('d M Y, h:i A') ?? '—' }}</p>

@if ($training->status === 'rejected' && $training->rejection_reason)
    <div class="alert alert-danger"><strong>Previous rejection reason:</strong> {{ $training->rejection_reason }}</div>
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
            <div class="col-md-3"><strong>Start – End:</strong>
                {{ optional($training->start_date)->format('d M Y') ?? '—' }} –
                {{ optional($training->end_date)->format('d M Y') ?? '—' }}
            </div>
            <div class="col-md-3"><strong>Max Participants:</strong> {{ $training->max_participants ?? 'Unlimited' }}</div>
        </div>

        @if ($training->training_type !== 'recorded')
            <div class="alert alert-secondary">
                <strong>Live Details:</strong> {{ $training->platform }} —
                <a href="{{ $training->meeting_link }}" target="_blank">{{ $training->meeting_link }}</a>
                ({{ $training->schedule }})
            </div>
        @endif

        @if ($training->outcomes->count())
            <h5>What Students Will Learn</h5>
            <ul>@foreach ($training->outcomes as $o)<li>{{ $o->outcome }}</li>@endforeach</ul>
        @endif

        @if ($training->requirements->count())
            <h5>Requirements</h5>
            <ul>@foreach ($training->requirements as $r)<li>{{ $r->requirement }}</li>@endforeach</ul>
        @endif

        @if ($training->modules->count())
            <h5>Curriculum ({{ $training->modules->count() }} modules)</h5>
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
                                            @if ($session->video_path)<span class="badge bg-info text-dark">Video attached</span>@endif
                                            @if ($session->pdf_path)<span class="badge bg-secondary">PDF attached</span>@endif
                                        </li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <p><strong>Certificate on completion:</strong> {{ $training->certificate_enabled ? 'Yes' : 'No' }}</p>
    </div>
</div>

@if ($training->status === 'pending_approval')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Decision</h5>
            <div class="d-flex gap-2 mb-3">
                <form action="{{ route('admin.trainings.approve', $training) }}" method="POST">
                    @csrf
                    <button class="btn btn-success"><i class="bi bi-check-circle"></i> Approve</button>
                </form>
                <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#rejectModal">
                    <i class="bi bi-x-circle"></i> Reject
                </button>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div class="modal fade" id="rejectModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{ route('admin.trainings.reject', $training) }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Reject Training</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label">Rejection Reason *</label>
                    <textarea name="rejection_reason" class="form-control" rows="4" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Confirm Rejection</button>
                </div>
            </form>
        </div>
    </div>
@elseif ($training->status === 'approved')
    <div class="card">
        <div class="card-body d-flex justify-content-between align-items-center">
            <span>This training is approved. Publish it to make it visible to students.</span>
            <form action="{{ route('admin.trainings.publish', $training) }}" method="POST">
                @csrf
                <button class="btn btn-primary"><i class="bi bi-broadcast"></i> Publish</button>
            </form>
        </div>
    </div>
@elseif ($training->status === 'published')
    <div class="card">
        <div class="card-body d-flex justify-content-between align-items-center">
            <span class="text-success"><i class="bi bi-check-circle-fill"></i> Published and visible to students.</span>
            <form action="{{ route('admin.trainings.unpublish', $training) }}" method="POST">
                @csrf
                <button class="btn btn-outline-warning btn-sm">Unpublish</button>
            </form>
        </div>
    </div>
@endif

<a href="{{ route('admin.trainings.index') }}" class="btn btn-outline-secondary mt-3">Back to list</a>
@endsection

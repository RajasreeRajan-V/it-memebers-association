@extends('layouts.app')
@section('title', 'My Trainings')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="mb-0"><i class="bi bi-mortarboard"></i> My Trainings</h3>
    <a href="{{ route('mentor.trainings.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Create Training
    </a>
</div>

<div class="row g-4">
    @forelse ($trainings as $training)
        <div class="col-md-4">
            <div class="card card-training h-100">
                <img src="{{ $training->thumbnail ? asset('storage/'.$training->thumbnail) : 'https://via.placeholder.com/400x180?text=Training' }}"
                     class="training-thumb" alt="{{ $training->title }}">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h5 class="card-title mb-0">{{ $training->title }}</h5>
                        @include('partials.status-badge', ['status' => $training->status])
                    </div>
                    <p class="card-text text-muted small">{{ Str::limit($training->short_description, 80) }}</p>

                    @if ($training->status === 'rejected' && $training->rejection_reason)
                        <div class="alert alert-danger py-2 px-3 small mb-2">
                            <strong>Rejected:</strong> {{ $training->rejection_reason }}
                        </div>
                    @endif

                    <div class="d-flex gap-2 flex-wrap mt-3">
                        <a href="{{ route('mentor.trainings.show', $training) }}" class="btn btn-sm btn-outline-secondary">View</a>

                        @if ($training->isEditableByMentor())
                            <a href="{{ route('mentor.trainings.edit', $training) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                        @endif

                        @if ($training->status === 'draft')
                            <form action="{{ route('mentor.trainings.submit', $training) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-sm btn-success">Submit for Approval</button>
                            </form>
                            <form action="{{ route('mentor.trainings.destroy', $training) }}" method="POST"
                                  class="d-inline" onsubmit="return confirm('Delete this draft?');">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        @endif

                        @if ($training->status === 'rejected')
                            <form action="{{ route('mentor.trainings.submit', $training) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-sm btn-success">Resubmit</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info">You haven't created any trainings yet.</div>
        </div>
    @endforelse
</div>

<div class="mt-4">{{ $trainings->links() }}</div>
@endsection

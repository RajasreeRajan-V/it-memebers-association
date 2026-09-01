@extends('layouts.app')
@section('title', 'My Trainings')

@section('content')
<h3 class="mb-4"><i class="bi bi-journal-bookmark"></i> My Trainings</h3>

<div class="row g-4">
    @forelse ($enrollments as $enrollment)
        @php $training = $enrollment->training; @endphp
        <div class="col-md-4">
            <div class="card card-training h-100">
                <img src="{{ $training->thumbnail ? asset('storage/'.$training->thumbnail) : 'https://via.placeholder.com/400x180?text=Training' }}"
                     class="training-thumb">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $training->title }}</h5>
                    <p class="text-muted small">by {{ $training->mentor->name ?? 'Mentor' }}</p>

                    <div class="progress mb-2" style="height:8px;">
                        <div class="progress-bar" style="width: {{ $enrollment->progress }}%"></div>
                    </div>
                    <small class="text-muted mb-3">{{ $enrollment->progress }}% complete
                        · {{ ucfirst(str_replace('_',' ', $enrollment->status)) }}</small>

                    <div class="mt-auto d-flex gap-2">
                        @if ($enrollment->status !== 'completed')
                            <a href="{{ route('student.trainings.learn', $training) }}" class="btn btn-primary btn-sm flex-fill">
                                Continue
                            </a>
                        @else
                            <a href="{{ route('student.trainings.learn', $training) }}" class="btn btn-outline-secondary btn-sm flex-fill">
                                Review
                            </a>
                            @if ($enrollment->certificate)
                                <a href="{{ route('student.trainings.certificate', $training) }}" class="btn btn-success btn-sm flex-fill">
                                    Certificate
                                </a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info">
                You haven't enrolled in any trainings yet.
                <a href="{{ route('student.trainings.index') }}">Browse trainings</a>.
            </div>
        </div>
    @endforelse
</div>

<div class="mt-4">{{ $enrollments->links() }}</div>
@endsection

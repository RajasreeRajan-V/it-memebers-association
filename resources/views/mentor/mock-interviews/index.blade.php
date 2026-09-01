@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-3">Mock Interview Requests</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3">
        @foreach (['' => 'All', 'pending' => 'Pending', 'scheduled' => 'Scheduled', 'completed' => 'Completed', 'cancelled' => 'Cancelled'] as $value => $label)
            <a href="{{ route('mentor.mock-interviews.index', $value ? ['status' => $value] : []) }}"
               class="btn btn-sm {{ request('status', '') === $value ? 'btn-primary' : 'btn-outline-secondary' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>

    <table class="table table-bordered align-middle">
        <thead>
            <tr>
                <th>Student</th>
                <th>Topic</th>
                <th>Requested / Scheduled</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($interviews as $interview)
                <tr>
                    <td>{{ $interview->student->name }}</td>
                    <td>{{ $interview->topic }}</td>
                    <td>
                        {{ $interview->scheduled_at?->format('d M Y, h:i A')
                            ?? $interview->requested_at?->format('d M Y, h:i A') }}
                    </td>
                    <td>
                        <span class="badge
                            @class([
                                'bg-warning text-dark' => $interview->status === 'pending',
                                'bg-info text-dark'    => $interview->status === 'scheduled',
                                'bg-success'            => $interview->status === 'completed',
                                'bg-secondary'          => $interview->status === 'cancelled',
                            ])">
                            {{ ucfirst($interview->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('mentor.mock-interviews.show', $interview) }}" class="btn btn-sm btn-outline-primary">
                            View
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">No mock interview requests.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $interviews->links() }}
</div>
@endsection

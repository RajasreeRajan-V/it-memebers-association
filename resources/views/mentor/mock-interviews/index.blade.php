@extends('layouts.app')

@section('content')


<div class="mentor-card">
    <table class="mentor-table">
        <thead>
            <tr><th>Student</th><th>Scheduled At</th><th>Status</th><th></th></tr>
        </thead>
        <tbody>
            @forelse($interviews as $interview)
                <tr>
                    <td>{{ $interview->student->name ?? '-' }}</td>
                    <td>{{ $interview->scheduled_at ? $interview->scheduled_at->format('d M Y, h:i A') : 'Not scheduled' }}</td>
                    <td><span class="badge-status badge-{{ $interview->status }}">{{ ucfirst($interview->status) }}</span></td>
                    <td><a class="btn btn-outline" href="{{ route('mentor.mock-interviews.show', $interview) }}">Open</a></td>
                </tr>
            @empty
                <tr><td colspan="4">No interviews assigned yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
{{ $interviews->links() }}
@endsection

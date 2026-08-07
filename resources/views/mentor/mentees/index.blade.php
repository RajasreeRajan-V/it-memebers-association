@extends('layouts.app')

@section('content')
<div class="mentor-card">
    <table class="mentor-table">
        <thead>
            <tr>
                <th>Student</th>
                <th>Email</th>
                <th>Status</th>
                <th>Sessions</th>
                <th>Assigned On</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($mentees as $mentee)
                <tr>
                    <td>{{ $mentee->student->name ?? '-' }}</td>
                    <td>{{ $mentee->student->email ?? '-' }}</td>
                    <td><span class="badge-status badge-{{ $mentee->status }}">{{ ucfirst($mentee->status) }}</span></td>
                    <td>{{ $mentee->sessions->count() }}</td>
                    <td>{{ optional($mentee->assigned_at)->format('d M Y') }}</td>
                    <td><a class="btn btn-outline" href="{{ route('mentor.mentees.show', $mentee) }}">Open</a></td>
                </tr>
            @empty
                <tr><td colspan="6">No mentees assigned yet. The admin will assign mentees to you.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
{{ $mentees->links() }}
@endsection

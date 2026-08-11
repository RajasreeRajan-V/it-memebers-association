@extends('admin.layout.app')
@section('content')
<div class="content-header">
    <h2>Mentorship Management</h2>
    <p>Assign mentors to students, monitor sessions and progress.</p>
</div>

<div class="card" style="margin-bottom:1.5rem;padding:1.25rem;">
    <h4>Assign a Mentor</h4>
    <form method="POST" action="{{ route('admin.mentorship.assign') }}" style="display:flex;gap:1rem;flex-wrap:wrap;align-items:flex-end;">
        @csrf
        <div>
            <label>Mentor</label><br>
            <select name="mentor_id" required>
                <option value="">Select mentor</option>
                @foreach($mentors as $mentor)
                    <option value="{{ $mentor->id }}">{{ $mentor->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Student</label><br>
            <select name="student_id" required>
                <option value="">Select student</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Notes</label><br>
            <input type="text" name="admin_notes">
        </div>
        <button class="btn btn-primary" type="submit">Assign</button>
    </form>
</div>

<div class="card" style="padding:1.25rem;">
    <table class="table" style="width:100%;">
        <thead>
            <tr><th>Mentor</th><th>Student</th><th>Status</th><th>Sessions</th><th>Assigned</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @forelse($assignments as $assignment)
                <tr>
                    <td>{{ $assignment->mentor->name ?? '-' }}</td>
                    <td>{{ $assignment->student->name ?? '-' }}</td>
                    <td>{{ ucfirst($assignment->status) }}</td>
                    <td>{{ $assignment->sessions->count() }}</td>
                    <td>{{ optional($assignment->assigned_at)->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('admin.mentorship.sessions', $assignment) }}">View Sessions</a>
                        <form method="POST" action="{{ route('admin.mentorship.status', $assignment) }}" style="display:inline">
                            @csrf @method('PATCH')
                            <select name="status" onchange="this.form.submit()">
                                <option value="active" @selected($assignment->status==='active')>Active</option>
                                <option value="paused" @selected($assignment->status==='paused')>Paused</option>
                                <option value="completed" @selected($assignment->status==='completed')>Completed</option>
                            </select>
                        </form>
                        <form method="POST" action="{{ route('admin.mentorship.destroy', $assignment) }}" style="display:inline" onsubmit="return confirm('Remove this assignment?');">
                            @csrf @method('DELETE')
                            <button type="submit">Remove</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">No assignments yet.</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $assignments->links() }}
</div>
@endsection

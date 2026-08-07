@extends('admin.layout.app')
@section('content')
<div class="content-header">
    <h2>Mock Interview Management</h2>
    <p>Assign interviews to mentors, monitor schedules, and view stored feedback.</p>
</div>

<div class="card" style="margin-bottom:1.5rem;padding:1.25rem;">
    <h4>Assign an Interview</h4>
    <form method="POST" action="{{ route('admin.mock-interviews.assign') }}" style="display:flex;gap:1rem;flex-wrap:wrap;align-items:flex-end;">
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
        <button class="btn btn-primary" type="submit">Assign</button>
    </form>
</div>

<div class="card" style="padding:1.25rem;">
    <table class="table" style="width:100%;">
        <thead>
            <tr><th>Student</th><th>Mentor</th><th>Scheduled</th><th>Status</th><th></th></tr>
        </thead>
        <tbody>
            @forelse($interviews as $interview)
                <tr>
                    <td>{{ $interview->student->name ?? '-' }}</td>
                    <td>{{ $interview->mentor->name ?? '-' }}</td>
                    <td>{{ $interview->scheduled_at ? $interview->scheduled_at->format('d M Y, h:i A') : 'Not scheduled' }}</td>
                    <td>{{ ucfirst($interview->status) }}</td>
                    <td><a href="{{ route('admin.mock-interviews.show', $interview) }}">View</a></td>
                </tr>
            @empty
                <tr><td colspan="5">No interviews assigned yet.</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $interviews->links() }}
</div>
@endsection

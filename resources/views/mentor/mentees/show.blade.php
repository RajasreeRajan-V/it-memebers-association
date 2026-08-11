@extends('mentor.layouts.app')
@section('title', 'My Mentees')

@section('mentor-content')
<div class="mentor-card">
    <h3>{{ $mentee->student->name }}</h3>
    <p>Email: {{ $mentee->student->email }}</p>
    <p>Status: <span class="badge-status badge-{{ $mentee->status }}">{{ ucfirst($mentee->status) }}</span></p>
</div>

<div class="mentor-card">
    <h4>Schedule a New Session</h4>
    <form method="POST" action="{{ route('mentor.mentees.sessions.store', $mentee) }}">
        @csrf
        <div class="form-group">
            <label>Date &amp; Time</label>
            <input type="datetime-local" name="scheduled_at" required>
        </div>
        <div class="form-group">
            <label>Mode</label>
            <select name="mode" required>
                <option value="online">Online</option>
                <option value="offline">Offline</option>
            </select>
        </div>
        <div class="form-group">
            <label>Meeting Link (optional)</label>
            <input type="text" name="meeting_link" placeholder="https://meet.google.com/...">
        </div>
        <button class="btn btn-primary" type="submit">Schedule Session</button>
    </form>
</div>

<div class="mentor-card">
    <h4>Session History</h4>
    <table class="mentor-table">
        <thead>
            <tr><th>Date</th><th>Mode</th><th>Status</th><th>Notes</th><th></th></tr>
        </thead>
        <tbody>
            @forelse($mentee->sessions as $session)
                <tr>
                    <td>{{ $session->scheduled_at->format('d M Y, h:i A') }}</td>
                    <td>{{ ucfirst($session->mode) }}</td>
                    <td><span class="badge-status badge-{{ $session->status }}">{{ ucfirst($session->status) }}</span></td>
                    <td>{{ $session->session_notes ?? '-' }}</td>
                    <td>
                        @if($session->status === 'scheduled')
                            <form method="POST" action="{{ route('mentor.sessions.conduct', $session) }}" style="display:inline">
                                @csrf
                                <button class="btn btn-outline" type="submit">Mark Conducted</button>
                            </form>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        <form method="POST" action="{{ route('mentor.sessions.notes.store', $session) }}">
                            @csrf
                            <div class="form-group">
                                <textarea name="session_notes" rows="2" placeholder="Add session notes...">{{ $session->session_notes }}</textarea>
                            </div>
                            <button class="btn btn-outline" type="submit">Submit Notes</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">No sessions yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

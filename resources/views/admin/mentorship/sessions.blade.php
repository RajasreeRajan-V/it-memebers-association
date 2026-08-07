@extends('admin.layout.app')
@section('content')
<div class="content-header">
    <h2>Sessions — {{ $assignment->mentor->name }} &amp; {{ $assignment->student->name }}</h2>
</div>
<div class="card" style="padding:1.25rem;">
    <table class="table" style="width:100%;">
        <thead><tr><th>Date</th><th>Mode</th><th>Status</th><th>Notes</th></tr></thead>
        <tbody>
            @forelse($assignment->sessions as $session)
                <tr>
                    <td>{{ $session->scheduled_at->format('d M Y, h:i A') }}</td>
                    <td>{{ ucfirst($session->mode) }}</td>
                    <td>{{ ucfirst($session->status) }}</td>
                    <td>{{ $session->session_notes ?? '-' }}</td>
                </tr>
            @empty
                <tr><td colspan="4">No sessions recorded.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@extends('layouts.app')



@section('content')
<div class="container py-4">
    <h1 class="h4 mb-4">My Mentorship</h1>

    @if ($activeMentorship)
        @php $mentor = $activeMentorship->mentor; $upcoming = $activeMentorship->upcomingSession(); @endphp
        <div class="card p-3 mb-4">
            <h5>{{ $mentor->name }}</h5>
            <p class="text-muted mb-1">{{ $mentor->title }} &nbsp; ⭐ {{ number_format($mentor->rating, 1) }}</p>
            <span class="badge bg-success mb-2">ACTIVE</span>
            <p class="mb-1"><strong>Mentorship Goal:</strong> {{ $activeMentorship->career_goal }}</p>
            <p class="mb-1">Progress: {{ $activeMentorship->progress_percent }}%</p>
            <div class="progress mb-3" style="height:8px">
                <div class="progress-bar" style="width: {{ $activeMentorship->progress_percent }}%"></div>
            </div>

            @if ($upcoming)
                <div class="border rounded p-2 mb-2">
                    <strong>Upcoming Session</strong><br>
                    {{ $upcoming->session_date->format('d M Y') }} • {{ $upcoming->start_time }}
                    <div class="mt-2">
                        @if ($upcoming->status === 'scheduled')
                            <form method="POST" action="{{ route('student.sessions.confirm', $upcoming) }}" class="d-inline">
                                @csrf
                                <button class="btn btn-sm btn-outline-success">Confirm Session</button>
                            </form>
                        @endif
                        @if ($upcoming->meeting_link)
                            <a href="{{ $upcoming->meeting_link }}" class="btn btn-sm btn-primary">Join Session</a>
                        @endif
                    </div>
                </div>
            @endif

            <a href="{{ route('student.sessions.completed') }}" class="btn btn-sm btn-outline-secondary">
                View All Sessions
            </a>
        </div>
    @else
        <p class="text-muted mb-4">You don't have an active mentor yet.</p>
    @endif

    <h5 class="mb-3">Request History</h5>
    <div class="list-group">
        @foreach ($requests as $req)
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <strong>{{ $req->mentor->name }}</strong><br>
                    <span class="text-muted small">Sent {{ $req->created_at->format('d M Y') }}</span>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-secondary">{{ str_replace('_', ' ', $req->status) }}</span>
                    @if (in_array($req->status, ['pending', 'accepted', 'admin_verification']))
                        <form method="POST" action="{{ route('student.requests.cancel', $req) }}">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Cancel</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

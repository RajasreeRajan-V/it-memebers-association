@extends('layouts.mentorship')
@php($portal = 'student')
@section('title', 'Dashboard')

@section('content')

    <div class="hero">
        <span class="kicker">Mentorship Program</span>
        <h1>Learn. Connect. <span class="accent">Grow.</span></h1>
        <p>Get expert guidance, share knowledge and build a stronger future with our mentor community.</p>
        <div class="actions">
            <a href="{{ route('student.mentors.index') }}" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i> Find a Mentor</a>
            <a href="{{ route('student.mentorship.index') }}" class="btn btn-outline">My Mentorship</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <span class="icon-circle"><i class="fa-solid fa-graduation-cap"></i></span>
                <div>
                    My Mentorship
                    <div class="card-sub">Track your sessions and grow with your mentor</div>
                </div>
            </div>
        </div>

        @if($activeMentorship)
            <div class="mentee-card" style="margin-bottom:16px;">
                <div class="top">
                    <div class="person">
                        <div class="avatar">
                            @if($activeMentorship->mentor->mentorRegistration->profile_photo ?? null)
                                <img src="{{ asset('storage/' . $activeMentorship->mentor->mentorRegistration->profile_photo) }}" alt="">
                            @else
                                {{ strtoupper(substr($activeMentorship->mentor->name ?? 'M', 0, 1)) }}
                            @endif
                        </div>
                        <div>
                            <div class="name">{{ $activeMentorship->mentor->name }}</div>
                            <div class="role">{{ $activeMentorship->mentor->mentorRegistration->designation ?? 'Mentor' }}</div>
                        </div>
                    </div>
                    <span class="badge badge-green"><span class="badge-dot"></span> Active Mentor</span>
                </div>
            </div>

            <div class="stat-row">
                <div class="stat-box">
                    <div class="num">{{ $stats['upcoming_sessions'] }}</div>
                    <div class="lbl">Upcoming Session</div>
                </div>
                <div class="stat-box">
                    <div class="num">{{ $stats['completed_sessions'] }}</div>
                    <div class="lbl">Completed Sessions</div>
                </div>
                <div class="stat-box">
                    <div class="num">{{ $stats['upcoming_sessions'] + $stats['completed_sessions'] }}</div>
                    <div class="lbl">Total Sessions</div>
                </div>
            </div>

            @if($upcomingSession)
                <div class="card" style="background:#fbfcff;box-shadow:none;">
                    <div class="card-header">
                        <span class="badge badge-blue"><span class="badge-dot"></span> Confirmed</span>
                        <a href="{{ route('student.sessions.upcoming') }}" class="link-more">View All ›</a>
                    </div>
                    <div style="font-weight:700;margin-bottom:4px;">{{ $upcomingSession->topic }}</div>
                    <div style="color:var(--muted);font-size:.83rem;margin-bottom:10px;">Career guidance & backend development discussion</div>
                    <div style="display:flex;align-items:center;gap:16px;font-size:.82rem;color:var(--muted);">
                        <span><i class="fa-regular fa-calendar"></i> {{ $upcomingSession->session_date->format('d M Y') }}</span>
                        <span><i class="fa-regular fa-clock"></i> {{ \Carbon\Carbon::parse($upcomingSession->start_time)->format('h:i A') }}</span>
                        <span><i class="fa-solid fa-video"></i> {{ ucfirst($upcomingSession->meeting_type) }}</span>
                        @if($upcomingSession->meeting_link)
                            <a href="{{ $upcomingSession->meeting_link }}" target="_blank" class="btn btn-primary btn-sm" style="margin-left:auto;">Join Session</a>
                        @endif
                    </div>
                </div>
            @endif

            @if($sessionHistory && $sessionHistory->count())
                <div style="margin-top:18px;">
                    <div class="card-header"><div class="card-title" style="font-size:.92rem;">Session History</div></div>
                    <table class="simple">
                        <thead><tr><th>Topic</th><th>Date</th><th>Status</th><th></th></tr></thead>
                        <tbody>
                        @foreach($sessionHistory as $s)
                            <tr>
                                <td>{{ $s->topic }}</td>
                                <td>{{ $s->session_date->format('d M Y') }}</td>
                                <td>
                                    @if($s->status === 'completed')
                                        <span class="badge badge-green">Completed</span>
                                    @elseif(in_array($s->status,['scheduled','confirmed']))
                                        <span class="badge badge-blue">Upcoming</span>
                                    @else
                                        <span class="badge badge-red">{{ ucfirst($s->status) }}</span>
                                    @endif
                                </td>
                                <td><a href="{{ route('student.sessions.show', $s) }}" class="link-more">View</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        @else
            <div class="empty-state">
                <i class="fa-solid fa-user-graduate"></i>
                <p>You don't have an active mentor yet.</p>
            </div>
        @endif

        <div class="card" style="background:var(--blue-light);box-shadow:none;margin-top:18px;">
            <div style="display:flex;align-items:center;justify-content:space-between;">
                <div>
                    <div style="font-weight:700;">Need help finding the right mentor?</div>
                    <div style="color:var(--muted);font-size:.83rem;">Browse experienced professionals and request mentorship today.</div>
                </div>
                <a href="{{ route('student.mentors.index') }}" class="btn btn-primary">Find a Mentor</a>
            </div>
        </div>
    </div>

@endsection

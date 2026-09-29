@extends('layouts.mentorship')
@php($portal = 'mentor')
@section('title', 'Mentor Dashboard')

@section('content')

    <div class="hero">
        <span class="kicker">Mentor Program</span>
        <h1>Guide. Inspire. <span class="accent">Grow.</span></h1>
        <p>Manage your mentees, review requests and run great mentorship sessions.</p>
        <div class="actions">
            <a href="{{ route('mentor.mentees.index') }}" class="btn btn-primary"><i class="fa-solid fa-user-graduate"></i> Go to My Mentees</a>
        </div>
    </div>

    <div class="stat-row" style="margin-bottom:22px;">
        <div class="stat-box"><div class="num">{{ $stats['active_mentees'] }}</div><div class="lbl">Active Mentees</div></div>
        <div class="stat-box"><div class="num">{{ $stats['upcoming_sessions'] }}</div><div class="lbl">Upcoming Sessions</div></div>
        <div class="stat-box"><div class="num">{{ $stats['completed_sessions'] }}</div><div class="lbl">Completed Sessions</div></div>
    </div>

    <div class="grid-2">
        <div class="card">
            <div class="card-header">
                <div class="card-title" style="font-size:.95rem;">Pending Requests</div>
                <a href="{{ route('mentor.mentees.index') }}" class="link-more">View All ›</a>
            </div>
            @forelse($pendingRequests as $r)
                <div class="mentee-card" style="margin-bottom:10px;">
                    <div class="person">
                        <div class="avatar">{{ strtoupper(substr($r->student->name,0,1)) }}</div>
                        <div><div class="name">{{ $r->student->name }}</div><div class="role">{{ $r->career_goal }}</div></div>
                    </div>
                </div>
            @empty
                <div class="empty-state" style="padding:20px;"><p>No pending requests.</p></div>
            @endforelse
        </div>

        <div class="card">
            <div class="card-header">
                <div class="card-title" style="font-size:.95rem;">Active Mentees</div>
                <a href="{{ route('mentor.mentees.index') }}" class="link-more">View All ›</a>
            </div>
            @forelse($activeMentees as $m)
                <div class="mentee-card" style="margin-bottom:10px;">
                    <div class="person">
                        <div class="avatar">{{ strtoupper(substr($m->student->name,0,1)) }}</div>
                        <div><div class="name">{{ $m->student->name }}</div><div class="role">{{ $m->career_goal }}</div></div>
                    </div>
                </div>
            @empty
                <div class="empty-state" style="padding:20px;"><p>No active mentees yet.</p></div>
            @endforelse
        </div>
    </div>

@endsection

@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

@php
    $stats = [
        'jobs' => $jobsCount ?? 0,
        'active' => $activeCount ?? 0,
        'internships' => $internshipsCount ?? 0,
        'projects' => $projectsCount ?? 0,
        'applications' => $applicationsCount ?? 0,
        'newApplicants' => $newApplicantsCount ?? 0,
        'shortlisted' => $shortlistedCount ?? 0,
        'interviews' => $interviewsCount ?? 0,
        'hired' => $hiredCount ?? 0,
    ];
@endphp

@switch($role)

    @case('student')
        @include('dashboard-layouts.partials.student', ['stats' => $stats])
        @break

    @case('employee')
        @include('dashboard-layouts.partials.employee', ['stats' => $stats])
        @break

    @case('employer')
        @include('dashboard-layouts.partials.employer', [
            'stats' => $stats,
            'upcomingInterviews' => $upcomingInterviews ?? collect(),
            'recentApplicants' => $recentApplicants ?? collect(),
            'latestJobs' => $latestJobs ?? collect(),
        ])
        @break

    @case('freelancer')
        @include('dashboard-layouts.partials.freelancer', ['stats' => $stats])
        @break

    @case('investor')
        @include('dashboard-layouts.partials.investor', ['stats' => $stats])
        @break

    @case('mentor')
        @include('dashboard-layouts.partials.mentor', ['stats' => $stats])
        @break

    @case('admin')
        @include('dashboard-layouts.partials.admin', ['stats' => $stats])
        @break

    @default
        <p>No dashboard content available for your role.</p>

@endswitch

@endsection
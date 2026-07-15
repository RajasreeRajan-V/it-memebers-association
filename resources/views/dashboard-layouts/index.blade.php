@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    @switch($role)
        @case('student')
            @include('dashboard-layouts.partials.student', ['stats' => $stats])
            @break
        @case('employee')
            @include('dashboard-layouts.partials.employee', ['stats' => $stats])
            @break
        @case('employer')
            @include('dashboard-layouts.partials.employer', ['stats' => $stats])
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
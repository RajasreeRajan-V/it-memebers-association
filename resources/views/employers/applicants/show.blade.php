@extends('layouts.app')

@section('title', $applicant->name . ' — Profile')

@section('content')
<div style="max-width:800px;margin:40px auto;padding:0 20px;">

    <a href="{{ route('employer.applicants.index') }}" style="text-decoration:none;color:#3376f2;font-weight:600;">
        ← Back to Applicants
    </a>

    <h1 style="margin-top:16px;">{{ $applicant->name }}</h1>

    @php $reg = $applicant->employeeRegistration; @endphp

    <p style="color:#7b8498;">
        {{ $reg->designation ?? $reg->job_title ?? $reg->current_position ?? 'Job Seeker' }}
    </p>

    <p><strong>Email:</strong> {{ $applicant->email }}</p>

    @if($reg && $reg->skills)
        <p><strong>Skills:</strong> {{ $reg->skills }}</p>
    @endif

    @if($applications->count())
        <h3 style="margin-top:30px;">Applications</h3>
        <ul>
            @foreach($applications as $app)
                <li>{{ $app->jobPost->title ?? 'Job' }} — {{ ucfirst($app->status ?? 'applied') }}</li>
            @endforeach
        </ul>
    @endif

</div>
@endsection
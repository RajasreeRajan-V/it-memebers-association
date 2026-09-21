@extends('layouts.app')

@section('title', $profile->startup_name)

@section('content')

<div style="max-width:1180px;margin:0 auto;padding:40px 24px;">

    <h1>
        {{ $profile->startup_name }}
    </h1>

    @if($profile->tagline)
        <p>{{ $profile->tagline }}</p>
    @endif


    <hr>


    <h2>About</h2>

    <p>
        {{ $profile->about }}
    </p>


    @if($profile->mission)

        <h2>Mission</h2>

        <p>
            {{ $profile->mission }}
        </p>

    @endif


    @if($profile->vision)

        <h2>Vision</h2>

        <p>
            {{ $profile->vision }}
        </p>

    @endif


    @if($profile->products_services)

        <h2>Products & Services</h2>

        <p>
            {{ $profile->products_services }}
        </p>

    @endif


    @if($profile->technologies)

        <h2>Technologies</h2>

        <p>
            {{ $profile->technologies }}
        </p>

    @endif


    {{-- JOBS --}}

    @if($profile->jobs->count())

        <h2 style="margin-top:40px;">
            Open Jobs
        </h2>

        @foreach($profile->jobs as $job)

            <div style="
                border:1px solid #e5e7eb;
                padding:20px;
                margin-bottom:15px;
                border-radius:12px;
            ">

                <h3>
                    {{ $job->title }}
                </h3>

                <p>
                    {{ $job->employment_type }}

                    @if($job->city)
                        • {{ $job->city }}
                    @endif
                </p>

                <a href="{{ route('employee.jobs.show', $job->id) }}">
                    View Job
                </a>

            </div>

        @endforeach

    @endif


    {{-- INTERNSHIPS --}}

    @if($profile->internships->count())

        <h2 style="margin-top:40px;">
            Internships
        </h2>

        @foreach($profile->internships as $internship)

            <div style="
                border:1px solid #e5e7eb;
                padding:20px;
                margin-bottom:15px;
                border-radius:12px;
            ">

                <h3>
                    {{ $internship->title }}
                </h3>

                <p>
                    {{ $internship->internship_type }}

                    @if($internship->duration)
                        • {{ $internship->duration }}
                    @endif
                </p>

                <a
                    href="{{ route('employee.internships.show', $internship->id) }}"
                >
                    View Internship
                </a>

            </div>

        @endforeach

    @endif


    {{-- PROJECTS --}}

    @if($profile->projects->count())

        <h2 style="margin-top:40px;">
            Projects
        </h2>

        @foreach($profile->projects as $project)

            <div style="
                border:1px solid #e5e7eb;
                padding:20px;
                margin-bottom:15px;
                border-radius:12px;
            ">

                <h3>
                    {{ $project->title }}
                </h3>

                <p>
                    {{ $project->project_type }}

                    @if($project->work_mode)
                        • {{ $project->work_mode }}
                    @endif
                </p>

                <a
                    href="{{ route('employee.projects.show', $project->id) }}"
                >
                    View Project
                </a>

            </div>

        @endforeach

    @endif

</div>

@endsection
@extends('layouts.app')

@section('title', $applicant->name . ' — Candidate Profile')

@section('content')

<style>
    .candidate-profile {
        font-family:
            Inter,
            Poppins,
            ui-sans-serif,
            system-ui,
            sans-serif;
    }

    .profile-card {
        background: #fff;
        border: 1px solid #e8edf5;
        border-radius: 18px;
        box-shadow: 0 2px 10px rgba(15,23,42,.025);
    }

    .section-title {
        font-size: 15px;
        font-weight: 800;
        color: #172033;
    }

    .section-text {
        color: #64748b;
        font-size: 13px;
        line-height: 1.8;
    }

    .profile-label {
        color: #94a3b8;
        font-size: 10px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .05em;
    }

    .profile-value {
        color: #172033;
        font-size: 13px;
        font-weight: 600;
        margin-top: 3px;
    }

    .skill {
        display: inline-flex;
        padding: 6px 10px;
        border-radius: 8px;
        background: #eef4ff;
        color: #3376f2;
        font-size: 11px;
        font-weight: 700;
    }

    .profile-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 9px 14px;
        border-radius: 10px;
        font-size: 11px;
        font-weight: 800;
        text-decoration: none;
        border: 0;
        cursor: pointer;
    }
</style>


<div class="candidate-profile bg-slate-50 min-h-screen">

    {{-- HEADER --}}
    <section class="bg-gradient-to-b from-[#F5F8FF] to-white
                    border-b border-slate-100">

        <div class="max-w-7xl mx-auto px-5 md:px-8 py-7">

            <a href="{{ route('employer.applicants.index') }}"
               class="text-sm font-semibold text-blue-600 hover:text-blue-700">

                ← Back to Applicants

            </a>


            <div class="mt-6 flex flex-col lg:flex-row
                        lg:items-center lg:justify-between gap-5">

                <div class="flex items-center gap-4">

                  @if($profile?->profile_photo)

    <img src="{{ route('employer.applicants.photo', $applicant->id) }}"
         alt="{{ $applicant->name }}"
         class="w-20 h-20 rounded-2xl object-cover
                border border-slate-200"
         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">

    <div class="w-20 h-20 rounded-2xl
                bg-blue-100 text-blue-600
                items-center justify-center
                text-2xl font-bold"
         style="display:none;">

        {{ strtoupper(
            substr($applicant->name ?? 'C', 0, 1)
        ) }}

    </div>

@else

                        <div class="w-20 h-20 rounded-2xl
                                    bg-blue-100 text-blue-600
                                    flex items-center justify-center
                                    text-2xl font-bold">

                            {{ strtoupper(
                                substr($applicant->name ?? 'C', 0, 1)
                            ) }}

                        </div>

                    @endif


                    <div>

                        <h1 class="text-3xl font-bold text-slate-900">

                            {{ $applicant->name }}

                        </h1>

                        <p class="text-slate-500 mt-1">

                            {{ $profile?->designation
                                ?? $profile?->job_title
                                ?? $profile?->current_position
                                ?? 'Job Seeker'
                            }}

                        </p>

                        <div class="flex flex-wrap gap-3
                                    text-xs text-slate-400 mt-2">

                            @if($applicant->email)
                                <span>{{ $applicant->email }}</span>
                            @endif

                            @if($applicant->phone)
                                <span>• {{ $applicant->phone }}</span>
                            @endif

                        </div>

                    </div>

                </div>


                {{-- TOP ACTIONS --}}
                <div class="flex flex-wrap gap-2">

                    @if($profile?->resume)

                        <a href="{{ asset('storage/' . $profile->resume) }}"
                           target="_blank"
                           class="profile-action bg-blue-600 text-white">

                            Download Resume

                        </a>

                    @endif


                    @php
                        $primaryApplication = $application;
                    @endphp


                    <form method="POST"
                          action="{{ route(
                              'employer.applicants.updateStatus',
                              $primaryApplication->id
                          ) }}">

                        @csrf

                        <input type="hidden"
                               name="status"
                               value="in_progress">

                        <input type="hidden"
                               name="sub_status"
                               value="shortlisted">

                        <button class="profile-action bg-amber-100 text-amber-700">

                            Shortlist

                        </button>

                    </form>


                    <button type="button"
                            onclick="document.getElementById('scheduleInterview').classList.remove('hidden')"
                            class="profile-action bg-violet-100 text-violet-700">

                        Schedule Interview

                    </button>

                </div>

            </div>

        </div>

    </section>


    {{-- CONTENT --}}
    <main class="max-w-7xl mx-auto px-5 md:px-8 py-7">

        <div class="grid lg:grid-cols-[minmax(0,1fr)_310px] gap-6">


            {{-- LEFT --}}
            <div class="space-y-5">


                {{-- ABOUT --}}
                @php
                    $about =
                        $profile?->about
                        ?? $profile?->bio
                        ?? $profile?->description
                        ?? null;
                @endphp

                @if($about)

                    <section class="profile-card p-6">

                        <h2 class="section-title">
                            About
                        </h2>

                        <p class="section-text mt-3">
                            {{ $about }}
                        </p>

                    </section>

                @endif


                {{-- SKILLS --}}
                @php
                    $skills = $profile?->skills;

                    if (is_string($skills)) {
                        $skills = array_filter(
                            array_map('trim', explode(',', $skills))
                        );
                    }
                @endphp

                @if(!empty($skills))

                    <section class="profile-card p-6">

                        <h2 class="section-title">
                            Skills
                        </h2>

                        <div class="flex flex-wrap gap-2 mt-4">

                            @foreach($skills as $skill)

                                <span class="skill">
                                    {{ $skill }}
                                </span>

                            @endforeach

                        </div>

                    </section>

                @endif


                {{-- EXPERIENCE --}}
                <section class="profile-card p-6">

                    <h2 class="section-title">
                        Experience
                    </h2>

                    @if(
                        $profile?->experience_years !== null ||
                        $profile?->company_name ||
                        $profile?->designation
                    )

                        <div class="mt-5 grid sm:grid-cols-2 gap-5">

                            @if($profile?->designation)

                                <div>

                                    <p class="profile-label">
                                        Position
                                    </p>

                                    <p class="profile-value">
                                        {{ $profile->designation }}
                                    </p>

                                </div>

                            @endif


                            @if($profile?->company_name)

                                <div>

                                    <p class="profile-label">
                                        Company
                                    </p>

                                    <p class="profile-value">
                                        {{ $profile->company_name }}
                                    </p>

                                </div>

                            @endif


                            @if($profile?->experience_years !== null)

                                <div>

                                    <p class="profile-label">
                                        Experience
                                    </p>

                                    <p class="profile-value">
                                        {{ $profile->experience_years }} years
                                    </p>

                                </div>

                            @endif

                        </div>

                    @else

                        <p class="section-text mt-3">
                            No experience information provided.
                        </p>

                    @endif

                </section>


                {{-- EDUCATION --}}
                @php
                    $education =
                        $profile?->education
                        ?? $profile?->qualification
                        ?? $profile?->highest_qualification
                        ?? null;
                @endphp

                @if($education)

                    <section class="profile-card p-6">

                        <h2 class="section-title">
                            Education
                        </h2>

                        <p class="section-text mt-3">
                            {{ $education }}
                        </p>

                    </section>

                @endif


                {{-- PROJECTS --}}
                @php
                    $projects =
                        $profile?->projects
                        ?? $profile?->project_details
                        ?? null;
                @endphp

                @if($projects)

                    <section class="profile-card p-6">

                        <h2 class="section-title">
                            Projects
                        </h2>

                        <p class="section-text mt-3 whitespace-pre-line">
                            {{ $projects }}
                        </p>

                    </section>

                @endif


                {{-- CERTIFICATIONS --}}
                @php
                    $certifications =
                        $profile?->certifications
                        ?? $profile?->certificates
                        ?? null;
                @endphp

                @if($certifications)

                    <section class="profile-card p-6">

                        <h2 class="section-title">
                            Certifications
                        </h2>

                        <p class="section-text mt-3 whitespace-pre-line">
                            {{ $certifications }}
                        </p>

                    </section>

                @endif


                {{-- RESUME --}}
                <section class="profile-card p-6">

                    <h2 class="section-title">
                        Resume
                    </h2>

                    @if($profile?->resume)

                        <div class="mt-4 flex items-center
                                    justify-between gap-4
                                    bg-slate-50 rounded-xl p-4">

                            <div>

                                <p class="font-semibold text-sm text-slate-800">
                                    Candidate Resume
                                </p>

                                <p class="text-xs text-slate-400 mt-1">
                                    Uploaded resume document
                                </p>

                            </div>

                            <a href="{{ asset('storage/' . $profile->resume) }}"
                               target="_blank"
                               class="profile-action bg-blue-600 text-white">

                                View Resume

                            </a>

                        </div>

                    @else

                        <p class="section-text mt-3">
                            No resume uploaded.
                        </p>

                    @endif

                </section>


            </div>


            {{-- RIGHT SIDEBAR --}}
            <aside class="space-y-5">


                {{-- APPLICATION --}}
                <section class="profile-card p-5">

                    <h2 class="section-title">
                        Application
                    </h2>


                    <div class="mt-5 space-y-5">

                        <div>

                            <p class="profile-label">
                                Applied For
                            </p>

                            <p class="profile-value">
                                {{ $application->jobPost?->title ?? 'Job' }}
                            </p>

                        </div>


                        <div>

                            <p class="profile-label">
                                Applied
                            </p>

                            <p class="profile-value">
                                {{ $application->created_at->format('d M Y') }}
                            </p>

                        </div>


                        <div>

                            <p class="profile-label">
                                Status
                            </p>

                            @php

                                $isShortlisted =
                                    $application->status === 'in_progress'
                                    && $application->sub_status === 'shortlisted';

                                $displayStatus = match(true) {

                                    $isShortlisted =>
                                        'Shortlisted',

                                    $application->status === 'applied' =>
                                        'New',

                                    $application->status === 'interview' =>
                                        'Interview',

                                    $application->status === 'hired' =>
                                        'Selected',

                                    $application->status === 'rejected' =>
                                        'Rejected',

                                    default =>
                                        'In Progress',
                                };

                            @endphp

                            <span class="inline-flex mt-2
                                         px-3 py-1.5 rounded-full
                                         bg-blue-50 text-blue-600
                                         text-xs font-bold">

                                {{ $displayStatus }}

                            </span>

                        </div>


                        @if($application->sub_status)

                            <div>

                                <p class="profile-label">
                                    Recruitment Stage
                                </p>

                                <p class="profile-value">

                                    {{ ucwords(
                                        str_replace(
                                            '_',
                                            ' ',
                                            $application->sub_status
                                        )
                                    ) }}

                                </p>

                            </div>

                        @endif

                    </div>

                </section>


                {{-- APPLICATION HISTORY --}}
                <section class="profile-card p-5">

                    <h2 class="section-title">
                        Application History
                    </h2>

                    <div class="mt-4 space-y-4">

                        @foreach($applications as $candidateApplication)

                            <div class="border-b border-slate-100
                                        last:border-0 pb-4 last:pb-0">

                                <p class="text-sm font-semibold text-slate-800">

                                    {{ $candidateApplication->jobPost?->title ?? 'Job' }}

                                </p>

                                <p class="text-xs text-slate-400 mt-1">

                                    {{ $candidateApplication->created_at->format('d M Y') }}

                                </p>

                                <span class="inline-flex mt-2
                                             text-[10px] font-bold
                                             px-2.5 py-1 rounded-full
                                             bg-slate-100 text-slate-600">

                                    {{ ucwords(
                                        str_replace(
                                            '_',
                                            ' ',
                                            $candidateApplication->status
                                        )
                                    ) }}

                                </span>

                            </div>

                        @endforeach

                    </div>

                </section>


                {{-- CONTACT --}}
                <section class="profile-card p-5">

                    <h2 class="section-title">
                        Contact
                    </h2>

                    <div class="mt-4 space-y-3 text-sm">

                        <div>
                            <span class="profile-label">
                                Email
                            </span>

                            <p class="profile-value break-all">
                                {{ $applicant->email }}
                            </p>
                        </div>


                        @if($applicant->phone)

                            <div>
                                <span class="profile-label">
                                    Phone
                                </span>

                                <p class="profile-value">
                                    {{ $applicant->phone }}
                                </p>
                            </div>

                        @endif


                        @if($profile?->linkedin)

                            <div>

                                <span class="profile-label">
                                    LinkedIn
                                </span>

                                <a href="{{ $profile->linkedin }}"
                                   target="_blank"
                                   rel="noopener"
                                   class="block text-sm
                                          font-semibold text-blue-600
                                          mt-1 break-all">

                                    View LinkedIn Profile

                                </a>

                            </div>

                        @endif

                    </div>

                </section>


            </aside>

        </div>

    </main>

</div>


{{-- SCHEDULE INTERVIEW MODAL --}}
<div id="scheduleInterview"
     class="hidden fixed inset-0 z-50">

    <div class="absolute inset-0 bg-black/40"
         onclick="document.getElementById('scheduleInterview').classList.add('hidden')">
    </div>


    <div class="relative min-h-full
                flex items-center justify-center p-5">

        <div class="bg-white rounded-2xl
                    shadow-xl w-full max-w-md p-6">

            <h3 class="text-lg font-bold text-slate-900">
                Schedule Interview
            </h3>

            <p class="text-sm text-slate-500 mt-1">
                {{ $applicant->name }}
            </p>


            <form method="POST"
                  action="{{ route(
                      'employer.applicants.scheduleInterview',
                      $application->id
                  ) }}"
                  class="mt-5 space-y-4">

                @csrf


                <div>

                    <label class="text-xs font-semibold text-slate-600">
                        Date & Time
                    </label>

                    <input type="datetime-local"
                           name="scheduled_at"
                           required
                           class="w-full mt-1 border border-slate-200
                                  rounded-lg px-3 py-2 text-sm">

                </div>


                <div>

                    <label class="text-xs font-semibold text-slate-600">
                        Mode
                    </label>

                    <select name="mode"
                            required
                            class="w-full mt-1 border border-slate-200
                                   rounded-lg px-3 py-2 text-sm">

                        <option value="online">
                            Online
                        </option>

                        <option value="in_person">
                            In Person
                        </option>

                        <option value="phone">
                            Phone
                        </option>

                    </select>

                </div>


                <div>

                    <label class="text-xs font-semibold text-slate-600">
                        Meeting Link / Location
                    </label>

                    <input type="text"
                           name="location"
                           placeholder="Meeting link or office address"
                           class="w-full mt-1 border border-slate-200
                                  rounded-lg px-3 py-2 text-sm">

                </div>


                <div class="flex justify-end gap-2">

                    <button type="button"
                            onclick="document.getElementById('scheduleInterview').classList.add('hidden')"
                            class="profile-action bg-slate-100 text-slate-600">

                        Cancel

                    </button>

                    <button class="profile-action bg-blue-600 text-white">

                        Schedule Interview

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
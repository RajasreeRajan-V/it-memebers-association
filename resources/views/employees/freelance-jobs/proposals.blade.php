
@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-800">
            My Proposals
        </h1>
        <p class="mt-2 text-gray-500">
            Track the projects you have applied for and their current status.
        </p>
    </div>

    @if(session('success'))
        <div class="mb-5 rounded-lg bg-green-50 p-4 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @forelse($applications as $application)
        @php
            $project = $application->project;
            $status = strtolower(trim($application->status ?? 'pending'));
        @endphp

        <div class="mb-5 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">

            <div class="flex flex-col justify-between gap-4 sm:flex-row">
                <div>
                    <h2 class="text-xl font-bold text-slate-800">
                        {{ $project->title ?? 'Project no longer available' }}
                    </h2>

                    <p class="mt-2 text-sm text-gray-500">
                        Submitted:
                        {{ $application->created_at?->format('d M Y, h:i A') ?? 'N/A' }}
                    </p>

                    @if($project)
                        <p class="mt-2 text-sm text-gray-600">
                            Budget: {{ $project->budget ?? 'Not specified' }}
                        </p>

                        <p class="mt-1 text-sm text-gray-600">
                            Type: {{ ucfirst($project->project_type ?? 'N/A') }}
                        </p>
                    @endif
                </div>

                <div>
                    <span class="inline-block rounded-full px-4 py-2 text-xs font-semibold
                        {{ in_array($status, ['accepted', 'approved', 'hired', 'in_progress', 'in progress', 'ongoing', 'started'])
                            ? 'bg-green-100 text-green-700'
                            : (in_array($status, ['rejected', 'declined'])
                                ? 'bg-red-100 text-red-700'
                                : 'bg-yellow-100 text-yellow-700') }}">
                        {{ ucfirst(str_replace('_', ' ', $status)) }}
                    </span>
                </div>
            </div>

            <div class="mt-5 border-t border-gray-100 pt-4">
                <h3 class="mb-2 font-semibold text-gray-800">
                    Your Cover Letter
                </h3>

                <p class="whitespace-pre-line text-sm leading-6 text-gray-600">{{ $application->cover_letter }}</p>

                <div class="mt-4 flex flex-wrap gap-3">
                    @if($application->resume_path)
                        <a href="{{ asset('storage/' . $application->resume_path) }}"
                           target="_blank" rel="noopener noreferrer"
                           class="rounded-lg bg-blue-50 px-4 py-2 text-sm font-semibold text-blue-700 hover:bg-blue-100">
                            View Resume
                        </a>
                    @endif

                    @if($application->portfolio_path)
                        <a href="{{ asset('storage/' . $application->portfolio_path) }}"
                           target="_blank" rel="noopener noreferrer"
                           class="rounded-lg bg-purple-50 px-4 py-2 text-sm font-semibold text-purple-700 hover:bg-purple-100">
                            View Portfolio
                        </a>
                    @endif

                    @if($application->github)
                        <a href="{{ $application->github }}"
                           target="_blank" rel="noopener noreferrer"
                           class="rounded-lg border px-4 py-2 text-sm font-semibold text-gray-700">
                            GitHub
                        </a>
                    @endif

                    @if($application->linkedin)
                        <a href="{{ $application->linkedin }}"
                           target="_blank" rel="noopener noreferrer"
                           class="rounded-lg border px-4 py-2 text-sm font-semibold text-gray-700">
                            LinkedIn
                        </a>
                    @endif
                </div>
            </div>

        </div>
    @empty
        <div class="rounded-2xl border border-dashed border-gray-300 bg-white px-6 py-16 text-center">
            <h2 class="text-xl font-semibold text-gray-800">
                No proposals yet
            </h2>
            <p class="mt-2 text-sm text-gray-500">
                Apply for a project to see your submitted proposal here.
            </p>

            <a href="{{ route('employee.freelance-jobs.index') }}"
               class="mt-5 inline-block rounded-lg bg-blue-600 px-5 py-3 text-sm font-semibold text-white hover:bg-blue-700">
                Browse Projects
            </a>
        </div>
    @endforelse

    <div class="mt-6">
        {{ $applications->links() }}
    </div>

</div>
@endsection

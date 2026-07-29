@extends('layouts.app')

@section('content')

<section class="max-w-6xl mx-auto px-6 py-10">
    <div class="flex items-center justify-between mb-6 flex-wrap gap-3">
        <div>
            <h1 class="font-display font-bold text-2xl text-gray-900">Candidates</h1>
            <p class="text-sm text-gray-500 mt-1">Everyone who has applied to your job postings.</p>
        </div>

        <form method="GET" class="flex items-center gap-2">
            <select name="job" onchange="this.form.submit()"
                class="text-xs border border-gray-200 rounded-lg px-3 py-2 outline-none">
                <option value="">All Jobs</option>
                @foreach ($jobs as $job)
                    <option value="{{ $job->id }}" @selected(request('job') == $job->id)>{{ $job->title }}</option>
                @endforeach
            </select>

            <select name="status" onchange="this.form.submit()"
                class="text-xs border border-gray-200 rounded-lg px-3 py-2 outline-none">
                <option value="">All Statuses</option>
                <option value="applied" @selected(request('status') === 'applied')>Applied ({{ $counts['applied'] ?? 0 }})</option>
                <option value="in_progress" @selected(request('status') === 'in_progress')>In Progress ({{ $counts['in_progress'] ?? 0 }})</option>
                <option value="interview" @selected(request('status') === 'interview')>Interview ({{ $counts['interview'] ?? 0 }})</option>
                <option value="hired" @selected(request('status') === 'hired')>Hired ({{ $counts['hired'] ?? 0 }})</option>
                <option value="rejected" @selected(request('status') === 'rejected')>Rejected ({{ $counts['rejected'] ?? 0 }})</option>
                <option value="archived" @selected(request('status') === 'archived')>Archived ({{ $counts['archived'] ?? 0 }})</option>
            </select>
        </form>
    </div>

    @if (session('success'))
        <div class="mb-4 bg-green-50 text-green-700 text-sm px-4 py-3 rounded-lg">{{ session('success') }}</div>
    @endif

    <div class="space-y-3">
        @forelse ($applications as $application)
            @php
                $candidate = $application->user;
                $job = $application->jobPost;
                $interview = $application->interview;

                $statusColors = [
                    'applied'     => 'bg-blue-50 text-blue-600',
                    'in_progress' => 'bg-amber-100 text-amber-600',
                    'interview'   => 'bg-violet-50 text-violet-600',
                    'hired'       => 'bg-emerald-50 text-emerald-600',
                    'rejected'    => 'bg-rose-50 text-rose-600',
                    'archived'    => 'bg-gray-100 text-gray-600',
                ];
                $statusLabel = ucwords(str_replace('_', ' ', $application->status));
            @endphp

            <article class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <div class="flex items-start justify-between gap-4 flex-wrap">
                    <div class="min-w-0">
                        <div class="flex items-center gap-2 flex-wrap">
                            <h3 class="font-display font-bold text-sm text-gray-900">
                                {{ $candidate->name ?? 'Candidate' }}
                            </h3>
                            <span class="text-[11px] font-semibold px-2.5 py-1 rounded-full {{ $statusColors[$application->status] ?? 'bg-gray-100 text-gray-600' }}">
                                {{ $statusLabel }}
                            </span>
                            @if ($application->sub_status)
                                <span class="text-[11px] font-medium px-2.5 py-1 rounded-full bg-gray-50 text-gray-500 border border-gray-200">
                                    {{ $application->sub_status_label }}
                                </span>
                            @endif
                        </div>
                        <p class="text-xs text-gray-500 mt-1">
                            Applied for <span class="font-medium text-gray-700">{{ $job->title }}</span>
                            &middot; {{ $candidate->email ?? '' }}
                            &middot; {{ $application->created_at->diffForHumans() }}
                        </p>

                        @if ($interview)
                            <p class="text-xs text-violet-600 mt-2 flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Interview: {{ $interview->scheduled_at->format('D, M j, g:i A') }} ({{ str_replace('_', ' ', $interview->mode) }})
                            </p>
                        @endif
                    </div>

                    <div class="flex flex-wrap items-center gap-2 shrink-0">
                        {{-- Shortlist / In Progress --}}
                        <form action="{{ route('employer.applicants.updateStatus', $application->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="status" value="in_progress">
                            <input type="hidden" name="sub_status" value="shortlisted">
                            <button type="submit"
                                class="text-xs font-semibold px-3 py-2 rounded-lg bg-amber-50 text-amber-700 hover:bg-amber-100 transition-colors">
                                Shortlist
                            </button>
                        </form>

                        {{-- Schedule Interview --}}
                        <button type="button"
                            onclick="document.getElementById('interview-modal-{{ $application->id }}').classList.remove('hidden')"
                            class="text-xs font-semibold px-3 py-2 rounded-lg bg-violet-50 text-violet-700 hover:bg-violet-100 transition-colors">
                            Interview
                        </button>

                        {{-- Hire --}}
                        <form action="{{ route('employer.applicants.updateStatus', $application->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="status" value="hired">
                            <button type="submit"
                                class="text-xs font-semibold px-3 py-2 rounded-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-100 transition-colors">
                                Hire
                            </button>
                        </form>

                        {{-- Reject --}}
                        <form action="{{ route('employer.applicants.updateStatus', $application->id) }}" method="POST"
                            onsubmit="return confirm('Reject this candidate?')">
                            @csrf
                            <input type="hidden" name="status" value="rejected">
                            <button type="submit"
                                class="text-xs font-semibold px-3 py-2 rounded-lg bg-rose-50 text-rose-700 hover:bg-rose-100 transition-colors">
                                Reject
                            </button>
                        </form>

                        {{-- Archive --}}
                        <form action="{{ route('employer.applicants.updateStatus', $application->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="status" value="archived">
                            <button type="submit"
                                class="text-xs font-semibold px-3 py-2 rounded-lg bg-gray-100 text-gray-600 hover:bg-gray-200 transition-colors">
                                Archive
                            </button>
                        </form>
                    </div>
                </div>
            </article>

            {{-- Schedule Interview Modal --}}
            <div id="interview-modal-{{ $application->id }}" class="hidden fixed inset-0 z-50">
                <div class="absolute inset-0 bg-black/40" onclick="document.getElementById('interview-modal-{{ $application->id }}').classList.add('hidden')"></div>
                <div class="relative min-h-full flex items-center justify-center p-4">
                    <div class="bg-white rounded-2xl shadow-lg w-full max-w-md p-6">
                        <h3 class="font-display font-bold text-base text-gray-900 mb-4">
                            Schedule Interview — {{ $candidate->name ?? 'Candidate' }}
                        </h3>
                        <form action="{{ route('employer.applicants.scheduleInterview', $application->id) }}" method="POST" class="space-y-3">
                            @csrf
                            <div>
                                <label class="text-xs font-semibold text-gray-600">Date & Time</label>
                                <input type="datetime-local" name="scheduled_at" required
                                    value="{{ old('scheduled_at', $interview?->scheduled_at?->format('Y-m-d\TH:i')) }}"
                                    class="w-full mt-1 text-sm border border-gray-200 rounded-lg px-3 py-2 outline-none">
                            </div>
                            <div>
                                <label class="text-xs font-semibold text-gray-600">Mode</label>
                                <select name="mode" required class="w-full mt-1 text-sm border border-gray-200 rounded-lg px-3 py-2 outline-none">
                                    <option value="online" @selected(($interview?->mode ?? '') === 'online')>Online</option>
                                    <option value="in_person" @selected(($interview?->mode ?? '') === 'in_person')>In Person</option>
                                    <option value="phone" @selected(($interview?->mode ?? '') === 'phone')>Phone</option>
                                </select>
                            </div>
                            <div>
                                <label class="text-xs font-semibold text-gray-600">Location / Link</label>
                                <input type="text" name="location" value="{{ old('location', $interview?->location) }}"
                                    placeholder="Meeting link or office address"
                                    class="w-full mt-1 text-sm border border-gray-200 rounded-lg px-3 py-2 outline-none">
                            </div>
                            <div class="flex items-center justify-end gap-2 pt-2">
                                <button type="button"
                                    onclick="document.getElementById('interview-modal-{{ $application->id }}').classList.add('hidden')"
                                    class="text-xs font-semibold px-4 py-2 rounded-lg bg-gray-100 text-gray-600 hover:bg-gray-200">
                                    Cancel
                                </button>
                                <button type="submit"
                                    class="text-xs font-semibold px-4 py-2 rounded-lg bg-violet-600 text-white hover:bg-violet-700">
                                    Confirm Interview
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-14 text-center">
                <p class="font-display font-bold text-sm text-gray-900">No candidates yet</p>
                <p class="text-xs text-gray-500 mt-1">Once someone applies to your jobs, they'll show up here.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $applications->onEachSide(1)->links() }}
    </div>
</section>

@include('employees.jobs._styles')
    @include('employees.jobs._scripts')
@endsection
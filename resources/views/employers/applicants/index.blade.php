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
                $profile = $candidate?->employeeRegistration;
                $job = $application->jobPost;
                $interview = $application->interview;
                $hasActiveInterview = $interview && $interview->status !== \App\Models\Interview::STATUS_CANCELLED;

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

            {{-- CARD — clicking anywhere opens the candidate detail modal, except the action buttons --}}
            <article data-candidate-open="{{ $application->id }}"
                class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 cursor-pointer hover:shadow-md transition-shadow">
                <div class="flex items-start justify-between gap-4 flex-wrap">
                    <div class="min-w-0 flex items-start gap-3">
                        @if ($profile?->profile_photo)
                            <img src="{{ asset('storage/' . $profile->profile_photo) }}" alt=""
                                class="w-10 h-10 rounded-full object-cover shrink-0">
                        @else
                            <div class="w-10 h-10 rounded-full bg-brand/10 text-brand flex items-center justify-center shrink-0 font-bold text-sm">
                                {{ strtoupper(substr($candidate->name ?? 'C', 0, 1)) }}
                            </div>
                        @endif

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

                            @if ($hasActiveInterview)
                                <p class="text-xs text-violet-600 mt-2 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Interview: {{ $interview->scheduled_at->format('D, M j, g:i A') }} ({{ str_replace('_', ' ', $interview->mode) }})
                                    @if ($interview->status === 'rescheduled')
                                        <span class="text-[10px] font-semibold px-1.5 py-0.5 rounded bg-violet-50">Rescheduled</span>
                                    @endif
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="flex flex-wrap items-center gap-2 shrink-0" onclick="event.stopPropagation()">
                        <form action="{{ route('employer.applicants.updateStatus', $application->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="status" value="in_progress">
                            <input type="hidden" name="sub_status" value="shortlisted">
                            <button type="submit"
                                class="text-xs font-semibold px-3 py-2 rounded-lg bg-amber-50 text-amber-700 hover:bg-amber-100 transition-colors">
                                Shortlist
                            </button>
                        </form>

                        @if ($hasActiveInterview)
                            <button type="button"
                                onclick="document.getElementById('interview-modal-{{ $application->id }}').classList.remove('hidden')"
                                class="text-xs font-semibold px-3 py-2 rounded-lg bg-violet-50 text-violet-700 hover:bg-violet-100 transition-colors">
                                Reschedule
                            </button>

                            <form action="{{ route('employer.applicants.cancelInterview', $application->id) }}" method="POST"
                                onsubmit="return confirm('Cancel this interview?')">
                                @csrf
                                <button type="submit"
                                    class="text-xs font-semibold px-3 py-2 rounded-lg bg-gray-100 text-gray-600 hover:bg-gray-200 transition-colors">
                                    Cancel Interview
                                </button>
                            </form>
                        @else
                            <button type="button"
                                onclick="document.getElementById('interview-modal-{{ $application->id }}').classList.remove('hidden')"
                                class="text-xs font-semibold px-3 py-2 rounded-lg bg-violet-50 text-violet-700 hover:bg-violet-100 transition-colors">
                                Interview
                            </button>
                        @endif

                        <form action="{{ route('employer.applicants.updateStatus', $application->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="status" value="hired">
                            <button type="submit"
                                class="text-xs font-semibold px-3 py-2 rounded-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-100 transition-colors">
                                Hire
                            </button>
                        </form>

                        <form action="{{ route('employer.applicants.updateStatus', $application->id) }}" method="POST"
                            onsubmit="return confirm('Reject this candidate?')">
                            @csrf
                            <input type="hidden" name="status" value="rejected">
                            <button type="submit"
                                class="text-xs font-semibold px-3 py-2 rounded-lg bg-rose-50 text-rose-700 hover:bg-rose-100 transition-colors">
                                Reject
                            </button>
                        </form>

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

            {{-- Candidate detail template — copied into the shared modal on click --}}
            <template id="candidate-template-{{ $application->id }}">
                <div class="flex items-start gap-4">
                    @if ($profile?->profile_photo)
                        <img src="{{ asset('storage/' . $profile->profile_photo) }}" alt=""
                            class="w-16 h-16 rounded-xl object-cover shrink-0">
                    @else
                        <div class="w-16 h-16 rounded-xl bg-brand/10 text-brand flex items-center justify-center shrink-0 font-bold text-xl">
                            {{ strtoupper(substr($candidate->name ?? 'C', 0, 1)) }}
                        </div>
                    @endif
                    <div class="min-w-0">
                        <h2 class="font-display font-bold text-xl text-gray-900">{{ $candidate->name ?? 'Candidate' }}</h2>
                        <p class="text-sm text-gray-500 mt-1">{{ $candidate->email ?? '' }}</p>
                        @if ($candidate->phone)
                            <p class="text-sm text-gray-500">{{ $candidate->phone }}</p>
                        @endif
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wide">Applied For</p>
                        <p class="text-gray-800 mt-0.5">{{ $job->title }}</p>
                    </div>
                    @if ($profile?->designation)
                        <div>
                            <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wide">Current Designation</p>
                            <p class="text-gray-800 mt-0.5">{{ $profile->designation }}</p>
                        </div>
                    @endif
                    @if ($profile?->company_name)
                        <div>
                            <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wide">Current Company</p>
                            <p class="text-gray-800 mt-0.5">{{ $profile->company_name }}</p>
                        </div>
                    @endif
                    @if (!is_null($profile?->experience_years))
                        <div>
                            <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wide">Experience</p>
                            <p class="text-gray-800 mt-0.5">{{ $profile->experience_years }} years</p>
                        </div>
                    @endif
                    @if ($profile?->current_ctc)
                        <div>
                            <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wide">Current CTC</p>
                            <p class="text-gray-800 mt-0.5">{{ $profile->current_ctc }}</p>
                        </div>
                    @endif
                    @if ($profile?->expected_ctc)
                        <div>
                            <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wide">Expected CTC</p>
                            <p class="text-gray-800 mt-0.5">{{ $profile->expected_ctc }}</p>
                        </div>
                    @endif
                    @if ($profile?->linkedin)
                        <div class="col-span-2">
                            <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wide">LinkedIn</p>
                            <a href="{{ $profile->linkedin }}" target="_blank" rel="noopener"
                                class="text-brand hover:underline mt-0.5 inline-block break-all">{{ $profile->linkedin }}</a>
                        </div>
                    @endif
                </div>

                @if ($profile?->skills)
                    <div class="mt-5">
                        <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wide mb-2">Skills</p>
                        <div class="flex flex-wrap gap-1.5">
                            @foreach (is_array($profile->skills) ? $profile->skills : explode(',', $profile->skills) as $skill)
                                <span class="text-[11px] font-medium px-2.5 py-1 rounded-full bg-gray-50 text-gray-600 border border-gray-200">{{ trim($skill) }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="flex items-center gap-3 mt-6 pt-6 border-t border-gray-100">
                    @if ($profile?->resume)
                        <a href="{{ asset('storage/' . $profile->resume) }}" target="_blank"
                            class="inline-flex items-center gap-2 text-sm font-semibold px-4 py-2.5 rounded-xl bg-brand text-white hover:bg-brand/90 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3M5 21h14a2 2 0 002-2V7.5L14.5 3H5a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                            View Resume
                        </a>
                    @endif
                    @if ($profile?->experience_proof)
                        <a href="{{ asset('storage/' . $profile->experience_proof) }}" target="_blank"
                            class="inline-flex items-center gap-2 text-sm font-semibold px-4 py-2.5 rounded-xl bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors">
                            View Experience Proof
                        </a>
                    @endif
                    @if (!$profile?->resume && !$profile?->experience_proof)
                        <p class="text-xs text-gray-400">No documents uploaded.</p>
                    @endif
                </div>
            </template>

            {{-- Schedule / Reschedule Interview Modal --}}
            <div id="interview-modal-{{ $application->id }}" class="hidden fixed inset-0 z-50">
                <div class="absolute inset-0 bg-black/40" onclick="document.getElementById('interview-modal-{{ $application->id }}').classList.add('hidden')"></div>
                <div class="relative min-h-full flex items-center justify-center p-4">
                    <div class="bg-white rounded-2xl shadow-lg w-full max-w-md p-6">
                        <h3 class="font-display font-bold text-base text-gray-900 mb-4">
                            {{ $hasActiveInterview ? 'Reschedule' : 'Schedule' }} Interview — {{ $candidate->name ?? 'Candidate' }}
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
                                    {{ $hasActiveInterview ? 'Confirm Reschedule' : 'Confirm Interview' }}
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

{{-- ================= CANDIDATE DETAIL MODAL (shared) ================= --}}
<div id="candidate-modal" class="hidden fixed inset-0 z-[1100]">
    <div id="candidate-modal-backdrop" class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>
    <div class="relative min-h-full flex items-start justify-center p-4 sm:p-6 pt-24 sm:pt-28">
        <div class="bg-white rounded-2xl shadow-lg ring-1 ring-black/[0.03] w-full max-w-2xl max-h-[75vh] flex flex-col overflow-hidden">

            {{-- Header row: title left, bordered square close button right --}}
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 shrink-0">
                <h2 class="font-display font-bold text-lg text-gray-900">Candidate Details</h2>
                <button type="button" id="candidate-modal-close" aria-label="Close"
                    class="w-9 h-9 flex items-center justify-center rounded-lg border border-gray-200 text-gray-500 hover:text-gray-700 hover:bg-gray-50 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Scrollable content area --}}
            <div id="candidate-modal-content" class="overflow-y-auto p-6"></div>
        </div>
    </div>
</div>

<script>
(function() {
    var modal = document.getElementById('candidate-modal');
    var content = document.getElementById('candidate-modal-content');

    function openModal(id) {
        var tpl = document.getElementById('candidate-template-' + id);
        if (!tpl) return;
        content.innerHTML = '';
        content.appendChild(tpl.content.cloneNode(true));
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        modal.classList.add('hidden');
        content.innerHTML = '';
        document.body.style.overflow = '';
    }

    document.addEventListener('click', function(e) {
        var trigger = e.target.closest('[data-candidate-open]');
        if (trigger) {
            openModal(trigger.getAttribute('data-candidate-open'));
            return;
        }
        if (e.target.closest('#candidate-modal-close') || e.target.id === 'candidate-modal-backdrop') {
            closeModal();
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeModal();
    });
})();
</script>

@include('employees.jobs._styles')
@include('employees.jobs._scripts')
@endsection
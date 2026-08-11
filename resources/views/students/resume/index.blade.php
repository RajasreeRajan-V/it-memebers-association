{{-- resources/views/students/resume/index.blade.php --}}
@extends('layouts.app')
@section('title', 'Resume Reviews')

@section('content')
<div class="container py-4 resume-page">

    {{-- ===== Header ===== --}}
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
        <div class="d-flex align-items-start gap-3">
            <span class="header-icon">
                <i class="fa-solid fa-file-lines"></i>
            </span>
            <div>
                <h1 class="h3 fw-bold mb-1">Resume Reviews</h1>
                <p class="text-muted mb-0">Get expert feedback from mentors and build a resume that stands out.</p>
            </div>
        </div>

        <a href="{{ route('student.resume-review.create') }}" class="btn btn-primary btn-lg d-inline-flex align-items-center gap-2 shadow-sm">
            <i class="fa-solid fa-plus"></i> New Review Request
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success d-flex align-items-center gap-2">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
    @endif

    {{-- ===== Stat Cards ===== --}}
    <div class="row g-3 mb-4">
        @foreach ([
            ['Total Requests', $requestCounts['total'], 'fa-solid fa-file-lines', 'primary'],
            ['Awaiting Mentor', $requestCounts['pending'], 'fa-regular fa-clock', 'warning'],
            ['In Progress', $requestCounts['in_review'], 'fa-solid fa-magnifying-glass', 'info'],
            ['Reviewed', $requestCounts['completed'], 'fa-solid fa-circle-check', 'success'],
        ] as [$label, $value, $icon, $color])
            <div class="col-6 col-lg-3">
                <div class="stat-card stat-card-{{ $color }}">
                    <div class="stat-icon"><i class="{{ $icon }}"></i></div>
                    <div>
                        <p class="stat-value">{{ $value }}</p>
                        <p class="stat-label">{{ $label }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row g-4">

        {{-- ===== My Requests ===== --}}
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 section-card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                    <h2 class="h6 fw-bold mb-0"><i class="fa-solid fa-inbox text-primary me-2"></i>My Requests</h2>
                    <span class="small text-muted">{{ $requestCounts['total'] }} total</span>
                </div>

                <div class="card-body">
                    @forelse ($myRequests as $request)
                        @php
                            $badge = match ($request->status) {
                                'completed' => ['Reviewed', 'success', 'fa-solid fa-circle-check'],
                                'in_review' => ['In Progress', 'info', 'fa-solid fa-magnifying-glass'],
                                default => ['Pending', 'warning', 'fa-regular fa-clock'],
                            };
                        @endphp
                        <button type="button" data-bs-toggle="modal" data-bs-target="#request-modal-{{ $request->id }}"
                                class="request-row w-100 border-0 bg-transparent text-start">
                            <div class="request-icon">
                                <i class="fa-solid fa-file-lines"></i>
                            </div>

                            <div class="flex-grow-1 min-w-0">
                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                    <p class="fw-semibold mb-0">{{ $request->review_type }}</p>
                                    <span class="badge rounded-pill text-bg-{{ $badge[1] }}">
                                        <i class="{{ $badge[2] }} me-1"></i>{{ $badge[0] }}
                                    </span>
                                </div>
                                <p class="small text-muted mb-0 mt-1">
                                    <i class="fa-regular fa-calendar me-1"></i>{{ $request->created_at->diffForHumans() }}
                                </p>
                            </div>

                            <div class="text-end flex-shrink-0">
                                @if ($request->mentor)
                                    <div class="d-flex align-items-center gap-2 justify-content-end">
                                        <div class="text-end d-none d-sm-block">
                                            <p class="small fw-medium mb-0">{{ $request->mentor->name }}</p>
                                            <p class="text-muted mb-0" style="font-size:.7rem;">Mentor</p>
                                        </div>
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($request->mentor->name) }}&background=random"
                                             class="rounded-circle" width="34" height="34" alt="">
                                    </div>
                                @else
                                    <span class="small text-muted fst-italic">Unassigned</span>
                                @endif

                                @if ($request->status === 'completed' && $request->overall_rating)
                                    <div class="mt-1">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="fa-solid fa-star {{ $i <= $request->overall_rating ? 'text-warning' : 'text-secondary opacity-25' }}" style="font-size:.7rem;"></i>
                                        @endfor
                                    </div>
                                @endif
                            </div>

                            <i class="fa-solid fa-chevron-right text-muted flex-shrink-0 ms-2"></i>
                        </button>
                    @empty
                        <div class="text-center py-5">
                            <i class="fa-regular fa-file-lines fa-3x text-muted mb-3"></i>
                            <p class="text-muted mb-2">You haven't submitted a resume for review yet.</p>
                            <a href="{{ route('student.resume-review.create') }}" class="fw-semibold text-decoration-none">
                                Submit your first request &rarr;
                            </a>
                        </div>
                    @endforelse
                </div>

                @if ($myRequests->hasPages())
                    <div class="card-footer bg-white text-center">
                        {{ $myRequests->links() }}
                    </div>
                @endif
            </div>
        </div>

        {{-- ===== How It Works ===== --}}
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 section-card h-100">
                <div class="card-body">
                    <h2 class="h6 fw-bold mb-4"><i class="fa-solid fa-lightbulb text-primary me-2"></i>How It Works</h2>
                    <ol class="list-unstyled mb-0">
                        @foreach ([
                            ['Submit Request', 'Upload your resume and share details about your goals.'],
                            ['Mentor Reviews', 'A mentor reviews your resume and provides detailed feedback.'],
                            ['Get Feedback', "You'll receive feedback and suggestions within the promised time."],
                            ['Improve & Apply', 'Update your resume and increase your chances of success.'],
                        ] as $index => $step)
                            <li class="d-flex gap-3 {{ !$loop->last ? 'mb-4' : '' }}">
                                <span class="step-number">{{ $index + 1 }}</span>
                                <div>
                                    <p class="fw-medium mb-0">{{ $step[0] }}</p>
                                    <p class="small text-muted mb-0">{{ $step[1] }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== Select a Mentor ===== --}}
    <div class="card shadow-sm border-0 section-card mt-4">
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
            <div>
                <h2 class="h6 fw-bold mb-0"><i class="fa-solid fa-user-tie text-primary me-2"></i>Select a Mentor</h2>
                <p class="small text-muted mb-0">Choose a mentor for your resume review</p>
            </div>
            <a href="{{ route('student.mentors.index') }}" class="small fw-medium text-decoration-none">View All Mentors</a>
        </div>

        <div class="card-body">
            <div class="row g-3">
                @forelse ($mentors as $mentor)
                    <div class="col-sm-6 col-lg-3">
                        <div class="mentor-card">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <img src="{{ $mentor->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($mentor->name) . '&background=random' }}"
                                     alt="{{ $mentor->name }}" class="rounded-circle" width="44" height="44">
                                <div class="text-truncate">
                                    <p class="fw-medium mb-0 text-truncate">{{ $mentor->name }}</p>
                                    <p class="small text-muted mb-0 text-truncate">{{ $mentor->title ?? 'Mentor' }}</p>
                                </div>
                            </div>
                            <a href="{{ route('student.resume-review.create', ['mentor' => $mentor->id]) }}"
                               class="btn btn-sm btn-outline-primary mt-auto w-100">Select</a>
                        </div>
                    </div>
                @empty
                    <p class="text-muted text-center py-4 mb-0">No mentors available right now.</p>
                @endforelse
            </div>
        </div>
    </div>

    {{-- ===== Request Detail Modals ===== --}}
    @foreach ($myRequests as $request)
        @php
            $badge = match ($request->status) {
                'completed' => ['Reviewed', 'success'],
                'in_review' => ['In Progress', 'info'],
                default => ['Pending', 'warning'],
            };
            $ratings = [
                'Overall Rating' => $request->overall_rating,
                'Resume Quality' => $request->resume_quality,
                'Relevance' => $request->relevance,
                'Presentation' => $request->presentation,
            ];
        @endphp
        <div class="modal fade" id="request-modal-{{ $request->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <div>
                            <h5 class="modal-title mb-1">Resume Review — {{ $request->review_type }}</h5>
                            <span class="badge text-bg-{{ $badge[1] }} rounded-pill">{{ $badge[0] }}</span>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        {{-- Request info --}}
                        <div class="row g-3 mb-4">
                            <div class="col-sm-6">
                                <p class="small text-muted mb-1">Mentor</p>
                                <p class="fw-medium mb-0">
                                    @if ($request->mentor)
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($request->mentor->name) }}&background=random"
                                             class="rounded-circle me-1" width="20" height="20" alt="">
                                        {{ $request->mentor->name }}
                                    @else
                                        Unassigned
                                    @endif
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <p class="small text-muted mb-1">Requested</p>
                                <p class="fw-medium mb-0">{{ $request->created_at->format('d M Y, h:i A') }}</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="small text-muted mb-1">Preferred Completion</p>
                                <p class="fw-medium mb-0">{{ $request->preferred_completion_time ?? '—' }}</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="small text-muted mb-1">Resume File</p>
                                <a href="{{ $request->resume_url }}" target="_blank" class="fw-medium text-decoration-none">
                                    <i class="fa-solid fa-file-arrow-down me-1"></i> {{ $request->resume_original_name ?? 'View resume' }}
                                </a>
                            </div>
                        </div>

                        @if ($request->goal)
                            <div class="mb-3">
                                <p class="small text-muted mb-1">Goal</p>
                                <p class="mb-0">{{ $request->goal }}</p>
                            </div>
                        @endif

                        @if (!empty($request->feedback_focus))
                            <div class="mb-4">
                                <p class="small text-muted mb-2">Feedback Focus</p>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach ($request->feedback_focus as $focus)
                                        <span class="badge text-bg-light border">{{ $focus }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <hr>

                        {{-- Mentor feedback --}}
                        @if ($request->status === 'completed')
                            <h6 class="fw-semibold mb-3">Mentor's Feedback</h6>
                            <div class="row g-3 mb-4">
                                @foreach ($ratings as $label => $value)
                                    <div class="col-6 col-sm-3">
                                        <p class="small text-muted mb-1">{{ $label }}</p>
                                        <p class="fw-semibold mb-0">
                                            @if ($value)
                                                {{ $value }}/5 <i class="fa-solid fa-star text-warning small"></i>
                                            @else
                                                —
                                            @endif
                                        </p>
                                    </div>
                                @endforeach
                            </div>

                            @if ($request->strengths)
                                <div class="mb-3">
                                    <p class="small text-muted mb-1"><i class="fa-solid fa-circle-check text-success me-1"></i> Strengths</p>
                                    <p class="mb-0">{{ $request->strengths }}</p>
                                </div>
                            @endif

                            @if ($request->areas_to_improve)
                                <div class="mb-3">
                                    <p class="small text-muted mb-1"><i class="fa-solid fa-triangle-exclamation text-warning me-1"></i> Areas to Improve</p>
                                    <p class="mb-0">{{ $request->areas_to_improve }}</p>
                                </div>
                            @endif

                            @if ($request->additional_comments)
                                <div class="mb-0">
                                    <p class="small text-muted mb-1">Additional Comments</p>
                                    <p class="mb-0">{{ $request->additional_comments }}</p>
                                </div>
                            @endif
                        @else
                            <div class="text-center py-4">
                                <i class="fa-regular fa-clock fa-2x text-muted mb-2"></i>
                                <p class="text-muted mb-0">Your mentor hasn't submitted feedback yet.</p>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<style>
    .resume-page .header-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 52px;
        height: 52px;
        border-radius: 16px;
        flex-shrink: 0;
        font-size: 1.35rem;
        color: #fff;
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        box-shadow: 0 6px 16px rgba(79, 70, 229, .25);
    }

    .resume-page .section-card {
        border-radius: 16px;
        overflow: hidden;
    }
    .resume-page .section-card .card-header {
        border-bottom: 1px solid #eef0f4;
    }

    /* Stat cards */
    .resume-page .stat-card {
        display: flex;
        align-items: center;
        gap: 14px;
        background: #fff;
        border-radius: 14px;
        padding: 18px;
        box-shadow: 0 1px 3px rgba(16, 24, 40, .06);
        border: 1px solid #eef0f4;
        height: 100%;
        transition: transform .15s ease, box-shadow .15s ease;
    }
    .resume-page .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(16, 24, 40, .08);
    }
    .resume-page .stat-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 44px;
        height: 44px;
        border-radius: 12px;
        font-size: 1.05rem;
        flex-shrink: 0;
    }
    .resume-page .stat-value { font-size: 1.35rem; font-weight: 700; margin-bottom: 0; line-height: 1.1; }
    .resume-page .stat-label { font-size: .78rem; color: #6b7280; margin-bottom: 0; }

    .resume-page .stat-card-primary .stat-icon { background: rgba(79,70,229,.1); color: #4f46e5; }
    .resume-page .stat-card-warning .stat-icon { background: rgba(245,158,11,.12); color: #d97706; }
    .resume-page .stat-card-info .stat-icon    { background: rgba(14,165,233,.12); color: #0284c7; }
    .resume-page .stat-card-success .stat-icon { background: rgba(16,185,129,.12); color: #059669; }

    /* Request rows */
    .resume-page .request-row {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 14px;
        border-radius: 12px;
        transition: background .15s ease, transform .1s ease;
    }
    .resume-page .request-row:hover {
        background: #f8f9fc;
    }
    .resume-page .request-row:not(:last-child) {
        margin-bottom: 6px;
    }
    .resume-page .request-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: rgba(79,70,229,.1);
        color: #4f46e5;
        flex-shrink: 0;
        font-size: 1rem;
    }

    /* How it works numbers */
    .resume-page .step-number {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: rgba(79,70,229,.1);
        color: #4f46e5;
        font-weight: 700;
        font-size: .8rem;
        flex-shrink: 0;
    }

    /* Mentor cards */
    .resume-page .mentor-card {
        display: flex;
        flex-direction: column;
        height: 100%;
        border: 1px solid #eef0f4;
        border-radius: 14px;
        padding: 16px;
        transition: border-color .15s ease, box-shadow .15s ease, transform .15s ease;
    }
    .resume-page .mentor-card:hover {
        border-color: #c7d2fe;
        box-shadow: 0 8px 20px rgba(16, 24, 40, .08);
        transform: translateY(-2px);
    }
</style>
@endsection
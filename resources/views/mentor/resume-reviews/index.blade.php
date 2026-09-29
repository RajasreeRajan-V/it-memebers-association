{{-- resources/views/mentor/resume-reviews/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="rr-page">
    <div class="container-fluid px-3 px-md-4 py-4">

        @if (session('success'))
            <div class="rr-alert success">
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif


        {{-- =====================================================
             HERO
        ====================================================== --}}

        <section class="rr-hero mb-4">

            <div class="rr-hero-content">

                <div class="rr-breadcrumb">
                    <i class="fa-solid fa-house"></i>
                    <span>›</span>
                    Resume Reviews
                </div>

                <h1 class="rr-hero-title">
                    Resume Reviews
                    <br>
                    <span class="blue">Built By Mentors,For Mentees </span>
                    
                </h1>

                <p class="rr-hero-description">
                    Review students' resumes and provide constructive feedback to help
                    them improve, stand out, and land the roles they're aiming for.
                </p>

                <div class="rr-hero-actions">
                    <a href="{{ route('mentor.resume-reviews.index', ['tab' => 'pending']) }}" class="rr-hero-btn">
                        <i class="fa-solid fa-arrow-right-to-bracket"></i>
                        Start Reviewing
                    </a>
                </div>

                <div class="rr-hero-stats">

                    <div class="rr-mini-stat">
                        <div class="rr-mini-icon">
                            <i class="fa-regular fa-clock"></i>
                        </div>

                        <div>
                            <p class="rr-mini-value">{{ $counts['pending'] ?? 0 }}</p>
                            <p class="rr-mini-label">Pending Reviews</p>
                        </div>
                    </div>

                    <div class="rr-mini-stat orange">
                        <div class="rr-mini-icon">
                            <i class="fa-solid fa-spinner"></i>
                        </div>

                        <div>
                            <p class="rr-mini-value">{{ $counts['in_progress'] ?? 0 }}</p>
                            <p class="rr-mini-label">In Progress</p>
                        </div>
                    </div>

                    <div class="rr-mini-stat green">
                        <div class="rr-mini-icon">
                            <i class="fa-solid fa-check-double"></i>
                        </div>

                        <div>
                            <p class="rr-mini-value">{{ $counts['reviewed'] ?? 0 }}</p>
                            <p class="rr-mini-label">Reviewed</p>
                        </div>
                    </div>

                </div>

            </div>


            {{-- Decorative illustration: a resume being reviewed --}}

            <div class="rr-hero-visual">

                <div class="rr-visual-circle"></div>

                <div class="rr-visual-card card-one">
                    <small>
                        <i class="fa-solid fa-file-arrow-up"></i>
                        New Upload
                    </small>
                    <strong>Resume Received</strong>
                </div>

                <div class="rr-visual-card card-two">
                    <small>
                        <i class="fa-solid fa-star"></i>
                        Rating
                    </small>
                    <strong>4.8 / 5.0</strong>
                </div>

                <div class="rr-visual-card card-three">
                    <small>
                        <i class="fa-regular fa-comment-dots"></i>
                        Feedback
                    </small>
                    <strong>Sent to Student</strong>
                </div>

                <div class="rr-visual-resume">
                    <div class="rr-resume-head"></div>
                    <div class="rr-resume-line w-70"></div>
                    <div class="rr-resume-line w-50"></div>
                    <div class="rr-resume-line w-90"></div>
                    <div class="rr-resume-line w-60"></div>
                    <div class="rr-resume-line w-80"></div>
                    <div class="rr-resume-line w-40"></div>
                </div>

                <div class="rr-visual-magnifier">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>

                <div class="rr-visual-check">
                    <i class="fa-solid fa-check"></i>
                </div>

            </div>

        </section>


        {{-- =====================================================
             TABS
        ====================================================== --}}

        <div class="rr-tabbar mb-4">
            @php
                $tabMeta = [
                    'pending'     => ['label' => 'Pending Reviews', 'badge' => 'rr-badge-blue'],
                    'in_progress' => ['label' => 'In Progress',     'badge' => 'rr-badge-orange'],
                    'reviewed'    => ['label' => 'Reviewed',        'badge' => 'rr-badge-green'],
                    'all'         => ['label' => 'All Reviews',     'badge' => 'rr-badge-purple'],
                ];
            @endphp
            @foreach ($tabMeta as $key => $meta)
                <a href="{{ route('mentor.resume-reviews.index', ['tab' => $key, 'q' => $search]) }}"
                   class="rr-tab {{ $tab === $key ? 'rr-tab-active' : '' }}">
                    {{ $meta['label'] }}
                    <span class="rr-pill {{ $meta['badge'] }}">{{ $counts[$key] }}</span>
                </a>
            @endforeach
        </div>


        <div class="rr-row">


            <div class="rr-col-left">

                {{-- Review Requests --}}
                <div class="card rr-card border-0 mb-4">
                    <div class="card-header bg-white border-0 pb-3 pt-3 px-3">
                        <h2 class="h6 fw-semibold mb-3">Review Requests</h2>
                        <form method="GET" action="{{ route('mentor.resume-reviews.index') }}">
                            <input type="hidden" name="tab" value="{{ $tab }}">
                            <div class="input-group input-group-sm rr-search">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="fa-solid fa-magnifying-glass text-muted"></i>
                                </span>
                                <input type="text" name="q" value="{{ $search }}" placeholder="Search by name or skills"
                                       class="form-control border-start-0 ps-0">
                            </div>
                        </form>
                    </div>

                    <div class="list-group list-group-flush rr-scroll" id="reviewList">
                        @forelse ($reviews as $index => $item)
                            @php
                                $isActive = $selected && $selected->id === $item->id;
                                $itemBadge = match($item->status) {
                                    'completed' => ['label' => 'Approved', 'class' => 'rr-badge-green'],
                                    'in_review' => ['label' => 'In Review', 'class' => 'rr-badge-orange'],
                                    'rejected' => ['label' => 'Rejected', 'class' => 'rr-badge-red'],
                                    default => ['label' => ucfirst(str_replace('_', ' ', $item->status)), 'class' => 'rr-badge-blue'],
                                };
                            @endphp
                            <a href="{{ route('mentor.resume-reviews.show', ['review' => $item, 'tab' => $tab, 'q' => $search]) }}"
                               class="list-group-item list-group-item-action py-3 border-0 border-bottom rr-review-item {{ $isActive ? 'rr-item-active' : '' }} {{ $index >= 3 ? 'd-none rr-hidden-item' : '' }}"
                               data-index="{{ $index }}">
                                <div class="d-flex align-items-start gap-2">
                                    <img src="{{ $item->student->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode($item->student->name ?? 'Student').'&background=EDE9FE&color=6D28D9' }}"
                                         class="rounded-circle flex-shrink-0" width="36" height="36" alt="">
                                    <div class="flex-grow-1 min-w-0">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <p class="fw-semibold mb-0 text-truncate">{{ $item->student->name ?? 'Unknown Student' }}</p>
                                            <span class="rr-time flex-shrink-0">{{ $item->created_at->diffForHumans(null, true) }}</span>
                                        </div>
                                        <p class="small text-muted mb-2 text-truncate">{{ $item->student->college ?? $item->student->institution ?? '' }}</p>
                                        <div class="d-flex flex-wrap gap-1 align-items-center">
                                            @foreach (($item->skills ?? [$item->review_type]) as $i => $skill)
                                                @if($i < 3)
                                                    <span class="rr-tag rr-tag-{{ $i % 3 }}">{{ $skill }}</span>
                                                @endif
                                            @endforeach
                                            <span class="rr-pill {{ $itemBadge['class'] }}">{{ $itemBadge['label'] }}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="text-center text-muted py-5">No resumes in this tab.</div>
                        @endforelse
                    </div>

                    @if ($reviews->count() > 3)
                        <div class="text-center py-2" id="loadMoreContainer">
                            <a href="#" class="small text-muted text-decoration-none" id="loadMoreBtn">
                                Load More <i class="fa-solid fa-chevron-down ms-1"></i>
                            </a>
                        </div>
                    @endif

                    @if ($reviews->hasPages())
                        <div class="card-footer bg-white text-center border-0">
                            {{ $reviews->links() }}
                        </div>
                    @endif
                </div>

                {{-- Student Details + Review History --}}
                @if ($selected)
                    {{-- Student details --}}
                    <div class="card rr-card rr-side-card border-0 mb-4">
                        <div class="rr-side-card-accent"></div>
                        <div class="card-body">
                            <p class="rr-side-label mb-3">
                                <i class="fa-regular fa-id-card"></i> Student Details
                            </p>
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <img src="{{ $selected->student->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode($selected->student->name ?? 'Student').'&size=80&background=EDE9FE&color=6D28D9' }}"
                                     class="rounded-circle rr-side-avatar" width="56" height="56" alt="">
                                <div class="min-w-0">
                                    <h3 class="h6 fw-semibold mb-1 text-truncate">{{ $selected->student->name ?? 'Unknown Student' }}</h3>
                                    <p class="small text-muted mb-0 text-truncate">{{ $selected->student->college ?? $selected->student->institution ?? '' }}</p>
                                </div>
                            </div>
                            <ul class="list-unstyled small mb-3 rr-side-list">
                                @if ($selected->student->studentRegistration)
                                    <li class="mb-2 text-muted">
                                        <i class="fa-solid fa-graduation-cap"></i>
                                        {{ $selected->student->studentRegistration->course ?? 'N/A' }}
                                        @if($selected->student->studentRegistration->year)
                                            - Year {{ $selected->student->studentRegistration->year }}
                                        @endif
                                    </li>
                                    <li class="mb-2 text-muted">
                                        <i class="fa-solid fa-building"></i>
                                        {{ $selected->student->studentRegistration->college_name ?? $selected->student->studentRegistration->university ?? 'N/A' }}
                                    </li>
                                    <li class="mb-2 text-truncate">
                                        <i class="fa-regular fa-envelope"></i>{{ $selected->student->email ?? '—' }}
                                    </li>
                                    <li class="mb-2">
                                        <i class="fa-solid fa-phone"></i>{{ $selected->student->phone ?? '—' }}
                                    </li>
                                    @if($selected->student->studentRegistration && $selected->student->studentRegistration->skills)
                                        <li class="mb-2">
                                            <i class="fa-solid fa-code"></i>
                                            <span class="rr-side-skills">
                                                @php
                                                    $skills = is_array($selected->student->studentRegistration->skills) 
                                                        ? $selected->student->studentRegistration->skills 
                                                        : explode(',', $selected->student->studentRegistration->skills);
                                                @endphp
                                                {{ implode(', ', array_slice($skills, 0, 5)) }}
                                                @if(count($skills) > 5)
                                                    +{{ count($skills) - 5 }} more
                                                @endif
                                            </span>
                                        </li>
                                    @endif
                                    <li>
                                        <i class="fa-solid fa-location-dot"></i>{{ $selected->student->location ?? '—' }}
                                    </li>
                                @else
                                    <li class="mb-2 text-truncate">
                                        <i class="fa-regular fa-envelope"></i>{{ $selected->student->email ?? '—' }}
                                    </li>
                                    <li class="mb-2">
                                        <i class="fa-solid fa-phone"></i>{{ $selected->student->phone ?? '—' }}
                                    </li>
                                    <li>
                                        <i class="fa-solid fa-location-dot"></i>{{ $selected->student->location ?? '—' }}
                                    </li>
                                @endif
                            </ul>

                        </div>
                    </div>

                    {{-- Review history --}}
                    <div class="card rr-card rr-side-card border-0">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3 border-0">
                            <h3 class="h6 fw-semibold mb-0">
                                <i class="fa-solid fa-file-circle-check me-2" style="color: var(--rr-primary);"></i>Review History
                            </h3>
                            <a href="#" class="rr-side-link rr-side-link-sm">View All</a>
                        </div>
                        <div class="list-group list-group-flush">
                            @forelse ($reviewHistory as $past)
                                <div class="list-group-item py-3 border-0 border-bottom rr-history-item">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <span class="rr-pill {{ ($past->status ?? '') === 'in_progress' ? 'rr-badge-orange' : 'rr-badge-green' }}">
                                            {{ ($past->status ?? '') === 'in_progress' ? 'In Progress' : 'Reviewed' }}
                                        </span>
                                        <span class="small text-muted">{{ optional($past->reviewed_at)->format('d M Y') }}</span>
                                    </div>
                                    <p class="small mb-1">
                                        Overall Rating:
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="fa-solid fa-star {{ $i <= ($past->overall_rating ?? 0) ? 'text-warning' : 'text-secondary opacity-25' }} small"></i>
                                        @endfor
                                    </p>
                                    @if ($past->strengths)
                                        <p class="small text-muted mb-1 text-truncate">{{ $past->strengths }}</p>
                                    @endif
                                    <a href="#" class="rr-side-link rr-side-link-sm">View Feedback</a>
                                </div>
                            @empty
                                <div class="list-group-item text-center text-muted py-4 small border-0">No previous reviews for this student.</div>
                            @endforelse
                        </div>
                    </div>
                @else
                    <div class="card rr-card rr-side-card border-0">
                        <div class="card-body text-center py-5">
                            <i class="fa-regular fa-id-card fa-2x text-muted mb-3"></i>
                            <p class="fw-semibold mb-1">No student selected</p>
                            <p class="small text-muted mb-0">Pick a request to see student details and review history here.</p>
                        </div>
                    </div>
                @endif
            </div>

            {{-- ---- RIGHT COLUMN: Resume to Review ---- --}}
            <div class="rr-col-resume">
                @if ($selected)
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                        <h2 class="h6 fw-semibold mb-0">Resume to Review</h2>
                        <div class="d-flex gap-2">
                            <a href="{{ $selected->resume_url }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                <i class="fa-regular fa-eye me-1"></i> View Full Resume
                            </a>
                            <a href="{{ $selected->resume_url }}" download class="btn btn-sm btn-primary rounded-pill px-3">
                                <i class="fa-solid fa-download me-1"></i> Download Resume
                            </a>
                        </div>
                    </div>

                    {{-- Profile + summary card --}}
                    <div class="card rr-card border-0 mb-4 overflow-hidden">
                        <div class="rr-profile-row">
                            {{-- Dark profile panel --}}
                            <div class="rr-profile-panel p-4 text-center text-sm-start">
                                <img src="{{ $selected->student->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode($selected->student->name ?? 'Student').'&background=6D28D9&color=fff' }}"
                                     class="rounded-3 mb-3" width="72" height="72" alt="">
                                <p class="text-white fw-semibold mb-1">{{ $selected->student->name ?? 'Unknown Student' }}</p>
                                <span class="rr-role-badge mb-3 d-inline-block">{{ $selected->target_role ?? 'Data Scientist' }}</span>
                                <ul class="list-unstyled small text-white-50 mt-3 mb-0">
                                    <li class="mb-2 text-truncate">
                                        <i class="fa-regular fa-envelope me-2"></i>{{ $selected->student->email ?? '—' }}
                                    </li>
                                    <li class="mb-2"><i class="fa-solid fa-phone me-2"></i>{{ $selected->student->phone ?? '—' }}</li>
                                    <li><i class="fa-solid fa-location-dot me-2"></i>{{ $selected->student->location ?? '—' }}</li>
                                </ul>
                            </div>

                            {{-- Summary / skills / experience --}}
                            <div class="p-4">
                                @if ($selected->goal)
                                    <p class="rr-section-label mb-1">Summary</p>
                                    <p class="small text-muted mb-3">{{ $selected->goal }}</p>
                                @endif

                                @if (!empty($selected->feedback_focus))
                                    <p class="rr-section-label mb-2">Skills</p>
                                    <div class="d-flex flex-wrap gap-2 mb-3">
                                        @foreach ($selected->feedback_focus as $i => $focus)
                                            <span class="rr-tag rr-tag-{{ $i % 3 }}">{{ $focus }}</span>
                                        @endforeach
                                    </div>
                                @endif

                                <p class="rr-section-label mb-2">Experience</p>
                                <p class="small fw-semibold mb-0">{{ $selected->review_type }}</p>
                                <p class="small text-muted mb-0">
                                    {{ $selected->preferred_completion_time ?? '—' }} &middot;
                                    {{ ucfirst(str_replace('_', ' ', $selected->status)) }}
                                </p>
                            </div>
                        </div>

                        {{-- Embedded preview for PDFs --}}
                        @if (str_ends_with(strtolower($selected->resume_path), '.pdf'))
                            <div class="ratio ratio-4x3 border-top overflow-hidden">
                                <iframe src="{{ $selected->resume_url }}" title="Resume preview"></iframe>
                            </div>
                        @endif
                    </div>

                    {{-- Feedback form --}}
                    <div class="card rr-card border-0">
                        <div class="card-body p-4">

                            {{-- Admin confirmation status banner --}}
                            @if ($latestConfirmation && $latestConfirmation->status === 'rejected')
                                <div class="rr-confirm-banner rr-confirm-rejected mb-4">
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                    <div>
                                        <strong>This review was rejected by admin.</strong>
                                        <p class="mb-0 mt-1">
                                            {{ $latestConfirmation->admin_notes ?? 'No reason provided. Please revise and resubmit.' }}
                                        </p>
                                    </div>
                                </div>
                            @elseif ($latestConfirmation && $latestConfirmation->status === 'pending')
                                <div class="rr-confirm-banner rr-confirm-pending mb-4">
                                    <i class="fa-solid fa-clock"></i>
                                    <div>
                                        <strong>Awaiting admin confirmation.</strong>
                                        <p class="mb-0 mt-1">This review has been submitted and is waiting for admin to approve it before the student can see it.</p>
                                    </div>
                                </div>
                            @elseif ($latestConfirmation && $latestConfirmation->status === 'approved')
                                <div class="rr-confirm-banner rr-confirm-approved mb-4">
                                    <i class="fa-solid fa-circle-check"></i>
                                    <div>
                                        <strong>Approved.</strong>
                                        <p class="mb-0 mt-1">This review has been approved and is now visible to the student.</p>
                                    </div>
                                </div>
                            @endif

                            <h2 class="h6 fw-semibold mb-4">Your Review &amp; Feedback</h2>

                            <form method="POST" action="{{ route('mentor.resume-reviews.submit', $selected) }}">
                                @csrf
                                <input type="hidden" name="tab" value="{{ $tab }}">
                                <input type="hidden" name="q" value="{{ $search }}">

                                <div class="rr-ratings-grid mb-4">
                                    @foreach ([
                                        'overall_rating' => 'Overall Rating',
                                        'resume_quality' => 'Resume Quality',
                                        'relevance' => 'Relevance',
                                        'presentation' => 'Presentation',
                                    ] as $field => $label)
                                        <div>
                                            <label class="form-label fw-medium d-flex justify-content-between">
                                                {{ $label }}
                                                <span class="text-muted small">{{ (int) old($field, $selected->$field) ?: '—' }}/5</span>
                                            </label>
                                            <div class="star-rating">
                                                @for ($i = 5; $i >= 1; $i--)
                                                    <input type="radio" id="{{ $field }}-{{ $i }}" name="{{ $field }}" value="{{ $i }}"
                                                           {{ (int) old($field, $selected->$field) === $i ? 'checked' : '' }}>
                                                    <label for="{{ $field }}-{{ $i }}"><i class="fa-solid fa-star"></i></label>
                                                @endfor
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="rr-feedback-box rr-feedback-green mb-3">
                                    <label for="strengths" class="form-label fw-semibold">
                                        <i class="fa-solid fa-circle-check text-success me-1"></i> Strengths (What's Good)
                                    </label>
                                    <textarea id="strengths" name="strengths" rows="2" class="form-control border-0 bg-transparent p-0"
                                              placeholder="Well structured resume with clear sections, good use of metrics in projects, relevant skills highlighted.">{{ old('strengths', $selected->strengths) }}</textarea>
                                </div>

                                <div class="rr-feedback-box rr-feedback-red mb-3">
                                    <label for="areas_to_improve" class="form-label fw-semibold">
                                        <i class="fa-solid fa-triangle-exclamation text-danger me-1"></i> Areas to Improve
                                    </label>
                                    <textarea id="areas_to_improve" name="areas_to_improve" rows="2" class="form-control border-0 bg-transparent p-0"
                                              placeholder="Add more quantified achievements, improve project descriptions, include certifications and awards.">{{ old('areas_to_improve', $selected->areas_to_improve) }}</textarea>
                                </div>

                                <div class="rr-feedback-box rr-feedback-blue mb-4">
                                    <label for="additional_comments" class="form-label fw-semibold">Additional Comments (Optional)</label>
                                    <textarea id="additional_comments" name="additional_comments" rows="2" class="form-control border-0 bg-transparent p-0"
                                              placeholder="Sum up the overall resume with an overview and general advice.">{{ old('additional_comments', $selected->additional_comments) }}</textarea>
                                </div>

                                <div class="d-flex gap-2 flex-wrap">
                                    <button type="submit" name="save_as_draft" value="0" class="btn btn-primary rounded-pill flex-fill">
                                        <i class="fa-solid fa-paper-plane me-1"></i> Submit Review
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="card rr-card border-0">
                        <div class="card-body text-center py-5">
                            <i class="fa-solid fa-file-circle-question fa-3x text-muted mb-3"></i>
                            <h2 class="h6 fw-semibold">Select a student to review</h2>
                            <p class="text-muted mb-0">Pick a request from "Review Requests" on the left to open their resume here.</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
/* =========================================================
   RESUME REVIEWS - FULL PAGE UI
   Same design language as the Mentorship Requests page:
   soft blue/purple palette, card panels, CSS-drawn hero art.
   ========================================================= */

:root {
    --rr-primary: #3376F2;
    --rr-primary-dark: #245FD0;
    --rr-purple: #7257E8;

    --rr-green: #22B573;
    --rr-orange: #F5A623;
    --rr-red: #EF5350;

    --rr-bg: #F7F9FD;
    --rr-white: #FFFFFF;

    --rr-text: #17213A;
    --rr-text-dark: #1F2937;
    --rr-muted: #7B879A;
    --rr-light-muted: #9CA3AF;

    --rr-border: #E8EDF5;

    --rr-radius: 13px;
    --rr-shadow: 0 4px 15px rgba(35, 61, 105, .035);
}


/* =========================================================
   PAGE
   ========================================================= */

.rr-page {
    width: 100%;
    min-height: 100vh;
    background: var(--rr-bg);
    color: var(--rr-text);
    font-family: inherit;
    padding-bottom: 40px;
    padding-left: 28px;
    padding-right: 28px;
    font-size: 15px;
}

.rr-page .container-fluid {
    width: 100%;
    max-width: 1700px;
    margin: 0 auto;
    padding-left: 0 !important;
    padding-right: 0 !important;
}


/* =========================================================
   ALERT
   ========================================================= */

.rr-alert {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 13px 17px;
    border-radius: 10px;
    margin-bottom: 16px;
    font-size: 14px;
    font-weight: 600;
    color: #16764C;
    background: #EAF9F1;
    border: 1px solid #CBEEDC;
}


/* =========================================================
   MAIN PAGE GRID - 2 COLUMNS
   ========================================================= */

.rr-row {
    display: grid;
    grid-template-columns: 340px minmax(0, 1fr);
    gap: 20px;
    width: 100%;
    align-items: start;
}

.rr-col-left {
    width: 100%;
    min-width: 0;
}

.rr-col-resume {
    width: 100%;
    min-width: 0;
}


/* =========================================================
   HERO
   ========================================================= */

.rr-hero {
    position: relative;
    overflow: hidden;
    min-height: 300px;
    border: 1px solid #E9EDF6;
    border-radius: 22px;
    background:
        radial-gradient(circle at 78% 28%, rgba(117, 88, 232, .08), transparent 28%),
        radial-gradient(circle at 93% 80%, rgba(51, 118, 242, .08), transparent 30%),
        linear-gradient(110deg, #FFFFFF 0%, #FBFCFF 55%, #F5F7FF 100%);
    box-shadow: 0 5px 20px rgba(35, 61, 105, .055);
    padding: 34px 38px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 30px;
}

.rr-hero::before {
    content: "";
    position: absolute;
    width: 310px;
    height: 310px;
    right: -75px;
    top: -110px;
    border: 1px dashed rgba(51, 118, 242, .15);
    border-radius: 50%;
}

.rr-hero::after {
    content: "";
    position: absolute;
    width: 190px;
    height: 190px;
    right: 150px;
    bottom: -135px;
    border-radius: 50%;
    background: rgba(114, 87, 232, .055);
}

.rr-hero-content {
    position: relative;
    z-index: 3;
    width: 55%;
}

.rr-breadcrumb {
    display: flex;
    align-items: center;
    gap: 7px;
    margin-bottom: 14px;
    color: var(--rr-primary);
    font-size: 13px;
    font-weight: 700;
}

.rr-breadcrumb span {
    color: #9BA5B5;
}

.rr-hero-title {
    margin: 0;
    font-size: 36px;
    line-height: 1.2;
    font-weight: 800;
    letter-spacing: -.7px;
    color: #17213A;
}

.rr-hero-title .blue {
    color: var(--rr-primary);
}

.rr-hero-title .purple {
    color: var(--rr-purple);
}

.rr-hero-description {
    max-width: 570px;
    margin: 12px 0 20px;
    color: #7A8495;
    font-size: 15px;
    line-height: 1.65;
}

.rr-hero-actions {
    margin-bottom: 22px;
}

.rr-hero-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 9px;
    padding: 12px 24px;
    background: var(--rr-primary);
    color: #ffffff;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 700;
    text-decoration: none;
    box-shadow: 0 6px 14px rgba(51, 118, 242, .25);
    transition: all .2s ease;
}

.rr-hero-btn:hover {
    background: var(--rr-primary-dark);
    color: #ffffff;
    transform: translateY(-1px);
}


/* Hero stats */

.rr-hero-stats {
    display: flex;
    gap: 12px;
}

.rr-mini-stat {
    display: flex;
    align-items: center;
    gap: 10px;
    min-width: 145px;
    padding: 11px 14px;
    border: 1px solid #E8EDF5;
    background: rgba(255,255,255,.88);
    border-radius: 9px;
    box-shadow: 0 5px 14px rgba(35,61,105,.04);
}

.rr-mini-icon {
    width: 34px;
    height: 34px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 7px;
    background: #EEF4FF;
    color: var(--rr-primary);
    font-size: 14px;
}

.rr-mini-stat.orange .rr-mini-icon {
    background: #FFF6E7;
    color: var(--rr-orange);
}

.rr-mini-stat.green .rr-mini-icon {
    background: #EAF9F2;
    color: var(--rr-green);
}

.rr-mini-value {
    margin: 0;
    font-size: 20px;
    line-height: 1;
    font-weight: 800;
    color: #25304A;
}

.rr-mini-label {
    margin: 4px 0 0;
    font-size: 12px;
    color: #8993A4;
}


/* =========================================================
   HERO VISUAL - resume being reviewed
   ========================================================= */

.rr-hero-visual {
    position: relative;
    z-index: 2;
    width: 45%;
    height: 235px;
    flex-shrink: 0;
}

.rr-visual-circle {
    position: absolute;
    width: 210px;
    height: 210px;
    right: 55px;
    top: 5px;
    border-radius: 50%;
    background: linear-gradient(145deg, #F2EEFF, #EEF5FF);
}

.rr-visual-resume {
    position: absolute;
    z-index: 4;
    left: 42%;
    top: 18px;
    width: 118px;
    height: 155px;
    background: #FFFFFF;
    border-radius: 10px;
    box-shadow: 0 14px 30px rgba(35, 61, 105, .14);
    padding: 16px 14px;
    transform: rotate(-4deg);
}

.rr-resume-head {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    background: linear-gradient(145deg, #7A4EE8, #9A70FF);
    margin-bottom: 10px;
}

.rr-resume-line {
    height: 6px;
    border-radius: 4px;
    background: #E7ECF6;
    margin-bottom: 8px;
}

.rr-resume-line.w-70 { width: 70%; background: #D8E1F5; }
.rr-resume-line.w-50 { width: 50%; }
.rr-resume-line.w-90 { width: 90%; }
.rr-resume-line.w-60 { width: 60%; }
.rr-resume-line.w-80 { width: 80%; }
.rr-resume-line.w-40 { width: 40%; }

.rr-visual-magnifier {
    position: absolute;
    z-index: 6;
    right: 30%;
    bottom: 38px;
    width: 46px;
    height: 46px;
    border-radius: 50%;
    background: linear-gradient(145deg, #2770DF, #408AF5);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 17px;
    box-shadow: 0 10px 20px rgba(39, 112, 223, .3);
}

.rr-visual-check {
    position: absolute;
    z-index: 6;
    left: 39%;
    top: 4px;
    width: 26px;
    height: 26px;
    border-radius: 50%;
    background: var(--rr-green);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 11px;
    box-shadow: 0 6px 14px rgba(34, 181, 115, .35);
}

.rr-visual-card {
    position: absolute;
    z-index: 8;
    min-width: 120px;
    padding: 9px 12px;
    background: rgba(255,255,255,.94);
    border: 1px solid #E7ECF5;
    border-radius: 9px;
    box-shadow: 0 7px 18px rgba(48, 67, 103, .08);
}

.rr-visual-card small {
    display: block;
    color: #7B8799;
    font-size: 11px;
    margin-bottom: 3px;
}

.rr-visual-card strong {
    color: #25304A;
    font-size: 12px;
    font-weight: 800;
}

.rr-visual-card i {
    color: var(--rr-primary);
    margin-right: 4px;
}

.rr-visual-card.card-one {
    left: 0;
    top: 30px;
}

.rr-visual-card.card-two {
    right: 0;
    top: 16px;
}

.rr-visual-card.card-three {
    right: 4%;
    bottom: 14px;
}


/* =========================================================
   TABS
   ========================================================= */

.rr-tabbar {
    width: 100%;
    display: flex;
    align-items: center;
    gap: 30px;
    border-bottom: 1px solid #DDE2EA;
    margin-bottom: 14px;
    padding: 0 2px;
}

.rr-tab {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 12px 2px 11px;
    color: #667085;
    font-size: 15px;
    font-weight: 600;
    text-decoration: none;
    border-bottom: 2px solid transparent;
    white-space: nowrap;
}

.rr-tab:hover {
    color: var(--rr-primary);
}

.rr-tab-active {
    color: var(--rr-primary);
    font-weight: 700;
    border-bottom-color: var(--rr-primary);
}

.rr-pill {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 24px;
    height: 23px;
    padding: 0 8px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 700;
}

.rr-badge-blue {
    background: #EEF4FF;
    color: var(--rr-primary);
}

.rr-badge-orange {
    background: #FFF6E7;
    color: var(--rr-orange);
}

.rr-badge-green {
    background: #EAF9F2;
    color: var(--rr-green);
}

.rr-badge-purple {
    background: #F3EFFF;
    color: var(--rr-purple);
}

.rr-badge-red {
    background: #FFF0F2;
    color: var(--rr-red);
}


/* =========================================================
   ADMIN CONFIRMATION BANNER
   ========================================================= */

.rr-confirm-banner {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 14px 16px;
    border-radius: 10px;
    font-size: 13px;
    line-height: 1.5;
}

.rr-confirm-banner i {
    font-size: 16px;
    margin-top: 2px;
    flex-shrink: 0;
}

.rr-confirm-banner strong {
    display: block;
    font-size: 13.5px;
}

.rr-confirm-banner p {
    color: inherit;
    opacity: .9;
    font-size: 12.5px;
}

.rr-confirm-rejected {
    background: #FFF0F2;
    color: #B4233E;
    border: 1px solid #FFD4DB;
}

.rr-confirm-pending {
    background: #FFFBEB;
    color: #92400E;
    border: 1px solid #FDE68A;
}

.rr-confirm-approved {
    background: #EAF9F1;
    color: #16764C;
    border: 1px solid #CBEEDC;
}


/* =========================================================
   CARDS
   ========================================================= */

.rr-card {
    background: #ffffff;
    border: 1px solid var(--rr-border) !important;
    border-radius: var(--rr-radius);
    box-shadow: var(--rr-shadow);
    overflow: hidden;
}


/* =========================================================
   LEFT COLUMN
   ========================================================= */

.rr-col-left > .card:not(:last-child) {
    margin-bottom: 18px !important;
}

.rr-col-left .card-header {
    padding: 18px 16px !important;
}

.rr-col-left .card-header h2 {
    font-size: 17px !important;
    color: #1F2937;
    font-weight: 700 !important;
}


/* Search */

.rr-search {
    width: 100%;
    border: 1px solid #E2E6ED;
    border-radius: 8px;
    overflow: hidden;
}

.rr-search .input-group-text {
    border: 0 !important;
    background: #ffffff !important;
    padding-left: 10px;
    padding-right: 6px;
}

.rr-search .form-control {
    border: 0 !important;
    box-shadow: none !important;
    height: 42px;
    font-size: 14px;
    color: #374151;
}

.rr-search .form-control::placeholder {
    color: #9CA3AF;
    font-size: 13px;
}


/* List */

.rr-scroll {
    max-height: 440px;
    overflow-y: auto;
    scrollbar-width: thin;
}

.rr-scroll::-webkit-scrollbar {
    width: 5px;
}

.rr-scroll::-webkit-scrollbar-thumb {
    background: #D5DAE3;
    border-radius: 20px;
}


/* Request item */

.rr-col-left .list-group-item {
    padding: 15px 14px !important;
    border-bottom: 1px solid #F0F2F5 !important;
    transition: all .15s ease;
    background: #ffffff;
}

.rr-col-left .list-group-item:hover {
    background: #F8FAFF;
}

.rr-item-active {
    background: #EEF4FF !important;
    border-left: 3px solid var(--rr-primary) !important;
}


/* Student name */

.rr-col-left .fw-semibold {
    font-size: 15px;
    color: #1F2937;
}

.rr-col-left .small {
    font-size: 13px;
}

.rr-time {
    background: #FFF6E7;
    color: #C47A00;
    font-size: 11px;
    font-weight: 700;
    padding: 4px 8px;
    border-radius: 999px;
}


/* Tags */

.rr-tag {
    display: inline-flex;
    align-items: center;
    padding: 4px 10px;
    border-radius: 5px;
    font-size: 11px;
    font-weight: 600;
    white-space: nowrap;
}

.rr-tag-0 {
    background: #EEF4FF;
    color: var(--rr-primary);
}

.rr-tag-1 {
    background: #EAF9F2;
    color: var(--rr-green);
}

.rr-tag-2 {
    background: #F3EFFF;
    color: var(--rr-purple);
}


/* =========================================================
   STUDENT DETAILS & REVIEW HISTORY
   ========================================================= */

.rr-side-card {
    width: 100%;
    position: relative;
    overflow: hidden;
}

.rr-side-card-accent {
    height: 3px;
    width: 100%;
    background: var(--rr-primary);
}

.rr-side-card .card-body {
    padding: 18px !important;
}

.rr-side-label {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #374151;
    font-size: 13px;
    font-weight: 700;
    margin-bottom: 15px !important;
}

.rr-side-label i {
    color: var(--rr-primary);
}

.rr-side-avatar {
    width: 48px !important;
    height: 48px !important;
    border: 2px solid #EEF2FF;
}

.rr-side-card h3 {
    font-size: 14px !important;
    color: #1F2937;
    font-weight: 700;
}

.rr-side-card .small {
    font-size: 12px;
}

.rr-side-list {
    margin-bottom: 15px !important;
}

.rr-side-list li {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #667085;
    font-size: 12px;
    line-height: 1.5;
    margin-bottom: 10px !important;
}

.rr-side-list i {
    width: 16px;
    text-align: center;
    color: #7B8798;
    font-size: 11px;
    flex-shrink: 0;
}

.rr-side-skills {
    font-size: 11px;
    color: #374151;
    word-break: break-all;
}

.rr-side-link {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    color: var(--rr-primary);
    font-size: 12px;
    font-weight: 700;
    text-decoration: none;
}

.rr-side-link:hover {
    color: var(--rr-primary-dark);
}

.rr-side-link-sm {
    font-size: 11px;
}


/* =========================================================
   REVIEW HISTORY
   ========================================================= */

.rr-history-item {
    padding: 14px 16px !important;
    border-bottom: 1px solid #F0F2F5 !important;
    transition: background .15s ease;
}

.rr-history-item:hover {
    background: #FAFBFF;
}

.rr-history-item .rr-pill {
    font-size: 10px;
    min-width: auto;
    height: 22px;
    padding: 0 9px;
}

.rr-history-item .small {
    font-size: 11px;
    line-height: 1.5;
}

.rr-history-item .fa-star {
    font-size: 11px !important;
}

.rr-history-item p {
    margin-bottom: 7px !important;
}


/* =========================================================
   RESUME SECTION
   ========================================================= */

.rr-col-resume > .d-flex {
    min-height: 38px;
    margin-bottom: 8px !important;
}

.rr-col-resume > .d-flex h2 {
    font-size: 17px !important;
    font-weight: 700 !important;
    color: #1F2937;
}

.rr-col-resume > .d-flex .btn {
    font-size: 13px;
    padding: 9px 16px;
    border-radius: 7px !important;
}


/* =========================================================
   RESUME PROFILE CARD
   ========================================================= */

.rr-profile-row {
    display: grid;
    grid-template-columns: 185px minmax(0, 1fr);
    width: 100%;
}

.rr-profile-panel {
    width: 100%;
    max-width: none !important;
    min-height: 190px;
    background: linear-gradient(145deg, #1E293B, #111827);
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 25px !important;
}

.rr-profile-panel img {
    width: 72px;
    height: 72px;
    object-fit: cover;
    border: none;
    margin-bottom: 12px !important;
}

.rr-profile-panel p {
    font-size: 16px;
    color: #ffffff;
    font-weight: 700;
    margin-bottom: 7px !important;
}

.rr-profile-panel ul {
    margin-top: 10px !important;
}

.rr-profile-panel li {
    font-size: 12px;
    color: rgba(255,255,255,.65);
    line-height: 1.5;
    margin-bottom: 7px !important;
}

.rr-profile-panel li i {
    width: 14px;
}

.rr-role-badge {
    width: fit-content;
    background: rgba(255,255,255,.12);
    color: #DDE5FF;
    font-size: 11px;
    padding: 5px 10px;
    border-radius: 5px;
    margin-bottom: 4px !important;
}

.rr-profile-row > div:last-child {
    min-width: 0;
    padding: 24px !important;
}

.rr-section-label {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .05em;
    text-transform: uppercase;
    color: #8B95A5;
    margin-bottom: 8px !important;
}

.rr-profile-row > div:last-child p {
    font-size: 13px;
    line-height: 1.55;
    color: #6B7280;
}

.rr-profile-row > div:last-child .fw-semibold {
    font-size: 14px;
    color: #374151;
}


/* =========================================================
   PDF PREVIEW
   ========================================================= */

.rr-col-resume iframe {
    width: 100%;
    min-height: 600px;
    border: 0;
    background: #ffffff;
}


/* =========================================================
   FEEDBACK
   ========================================================= */

.rr-col-resume .card-body {
    padding: 22px !important;
}

.rr-col-resume .card-body > h2 {
    font-size: 17px !important;
    font-weight: 700 !important;
    color: #1F2937;
}

.rr-ratings-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 20px;
    margin-bottom: 22px !important;
}

.rr-ratings-grid label {
    font-size: 13px;
    color: #374151;
}

.rr-ratings-grid label span {
    font-size: 12px;
}

.star-rating {
    display: flex;
    flex-direction: row-reverse;
    justify-content: flex-end;
    gap: 3px;
    margin-top: 5px;
}

.star-rating input {
    display: none;
}

.star-rating label {
    font-size: 20px;
    color: #D9DEE8;
    cursor: pointer;
    transition: color .15s ease;
}

.star-rating label:hover,
.star-rating label:hover ~ label,
.star-rating input:checked ~ label {
    color: var(--rr-orange);
}

.rr-feedback-box {
    border-radius: 9px;
    padding: 13px 15px;
    border: 1px solid transparent;
}

.rr-feedback-green {
    background: #EAF9F2;
    border-color: #CBEEDC;
}

.rr-feedback-red {
    background: #FFF0F2;
    border-color: #FFD4DB;
}

.rr-feedback-blue {
    background: #EEF4FF;
    border-color: #D8E3F8;
}

.rr-feedback-box label {
    font-size: 13px;
    margin-bottom: 10px;
}

.rr-feedback-box textarea {
    font-size: 13px;
    line-height: 1.5;
    min-height: 60px;
    resize: vertical;
}

.rr-feedback-box textarea::placeholder {
    color: #9CA3AF;
    font-size: 12px;
}

.rr-col-resume .btn-primary {
    background: var(--rr-primary);
    border-color: var(--rr-primary);
    font-size: 13px;
    font-weight: 600;
}

.rr-col-resume .btn-outline-primary {
    color: var(--rr-primary);
    border-color: var(--rr-primary);
}


/* =========================================================
   PAGINATION
   ========================================================= */

.rr-col-left .pagination {
    justify-content: center;
    margin: 10px 0;
}

.rr-col-left .pagination .page-link {
    font-size: 13px;
    border-radius: 6px;
    margin: 0 2px;
    color: var(--rr-primary);
}

.rr-col-left .pagination .active .page-link {
    background: var(--rr-primary);
    border-color: var(--rr-primary);
    color: #ffffff;
}


/* =========================================================
   EMPTY STATE
   ========================================================= */

.rr-col-left .text-center.py-5 {
    padding: 55px 15px !important;
    color: #6B7280;
    font-size: 15px;
}

#loadMoreBtn {
    font-size: 13px;
}


/* =========================================================
   LARGE DESKTOP
   ========================================================= */

@media (min-width: 1500px) {

    .rr-row {
        grid-template-columns: 380px minmax(0, 1fr);
        gap: 24px;
    }

    .rr-hero-title {
        font-size: 40px;
    }
}


/* =========================================================
   TABLET / SMALL LAPTOP
   ========================================================= */

@media (max-width: 1200px) {

    .rr-page {
        padding-left: 20px;
        padding-right: 20px;
    }

    .rr-row {
        grid-template-columns: 300px minmax(0, 1fr);
        gap: 16px;
    }

    .rr-hero-title {
        font-size: 30px;
    }

    .rr-hero-content {
        width: 62%;
    }

    .rr-hero-visual {
        width: 38%;
    }

    .rr-profile-row {
        grid-template-columns: 160px minmax(0, 1fr);
    }

    .rr-scroll {
        max-height: 380px;
    }
}


/* =========================================================
   MOBILE / 991
   ========================================================= */

@media (max-width: 991px) {

    .rr-row {
        grid-template-columns: 1fr;
    }

    .rr-col-left {
        order: 1;
    }

    .rr-col-resume {
        order: 2;
    }

    .rr-hero {
        flex-direction: column;
        min-height: auto;
        padding: 26px 24px;
    }

    .rr-hero-content {
        width: 100%;
        text-align: center;
    }

    .rr-hero-description {
        max-width: 100%;
    }

    .rr-hero-actions {
        display: flex;
        justify-content: center;
    }

    .rr-hero-stats {
        justify-content: center;
    }

    .rr-hero-visual {
        opacity: .25;
        width: 70%;
    }

    .rr-scroll {
        max-height: 380px;
    }
}


/* =========================================================
   MOBILE
   ========================================================= */

@media (max-width: 767px) {

    .rr-page {
        font-size: 14px;
        padding-left: 12px;
        padding-right: 12px;
    }

    .rr-hero {
        padding: 22px 18px;
    }

    .rr-hero-title {
        font-size: 26px;
    }

    .rr-hero-description {
        font-size: 13px;
    }

    .rr-hero-stats {
        flex-direction: column;
        width: 100%;
    }

    .rr-mini-stat {
        min-width: 100%;
    }

    .rr-hero-visual {
        display: none;
    }

    .rr-tabbar {
        gap: 18px;
        overflow-x: auto;
        scrollbar-width: none;
    }

    .rr-tabbar::-webkit-scrollbar {
        display: none;
    }

    .rr-tab {
        font-size: 13px;
        gap: 7px;
    }

    .rr-pill {
        font-size: 11px;
        min-width: 22px;
        height: 21px;
        padding: 0 7px;
    }

    .rr-col-left .fw-semibold {
        font-size: 14px;
    }

    .rr-col-left .small {
        font-size: 12px;
    }

    .rr-profile-panel p {
        font-size: 15px;
    }

    .rr-col-resume > .d-flex h2 {
        font-size: 16px !important;
    }

    .rr-col-resume > .d-flex .btn {
        font-size: 12px;
        padding: 8px 14px;
    }

    .rr-profile-row {
        grid-template-columns: 1fr;
    }

    .rr-profile-panel {
        min-height: auto;
        padding: 22px !important;
    }

    .rr-ratings-grid {
        grid-template-columns: 1fr;
        gap: 14px;
    }

    .rr-scroll {
        max-height: 340px;
    }

    .rr-feedback-box textarea {
        font-size: 12px;
        min-height: 55px;
    }

    .rr-ratings-grid label {
        font-size: 12px;
    }

    .star-rating label {
        font-size: 18px;
    }
}


/* =========================================================
   VERY SMALL MOBILE
   ========================================================= */

@media (max-width: 480px) {

    .rr-page {
        font-size: 13px;
    }

    .rr-hero-title {
        font-size: 22px;
    }

    .rr-hero-description {
        font-size: 12px;
    }

    .rr-hero-btn {
        width: 100%;
    }

    .rr-tab {
        font-size: 12px;
        gap: 6px;
        padding: 10px 2px 9px;
    }

    .rr-pill {
        font-size: 10px;
        min-width: 20px;
        height: 19px;
        padding: 0 6px;
    }

    .rr-col-left .fw-semibold {
        font-size: 13px;
    }

    .rr-col-left .small {
        font-size: 11px;
    }

    .rr-col-resume > .d-flex {
        align-items: flex-start !important;
        flex-direction: column;
    }

    .rr-col-resume > .d-flex > div {
        width: 100%;
    }

    .rr-col-resume > .d-flex .btn {
        font-size: 11px;
        padding: 7px 12px;
    }

    .rr-profile-panel p {
        font-size: 14px;
    }

    .rr-profile-row > div:last-child {
        padding: 18px !important;
    }

    .rr-scroll {
        max-height: 280px;
    }

    .rr-feedback-box textarea {
        font-size: 12px;
        min-height: 50px;
    }

    .rr-feedback-box label {
        font-size: 12px;
    }

    .star-rating label {
        font-size: 16px;
    }

    .rr-col-resume .btn-primary {
        font-size: 12px;
    }

    .rr-side-label {
        font-size: 12px;
    }

    .rr-side-card h3 {
        font-size: 13px !important;
    }

    .rr-side-list li {
        font-size: 11px;
    }

    .rr-col-left .card-header h2 {
        font-size: 16px !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const loadMoreBtn = document.getElementById('loadMoreBtn');
    if (!loadMoreBtn) return;

    const container = document.getElementById('loadMoreContainer');
    const items = document.querySelectorAll('.rr-review-item');
    let visibleCount = 3;

    // Initially hide items beyond first 3
    items.forEach((item, index) => {
        if (index >= 3) {
            item.classList.add('d-none');
            item.classList.add('rr-hidden-item');
        }
    });

    loadMoreBtn.addEventListener('click', function(e) {
        e.preventDefault();

        const hiddenItems = document.querySelectorAll('.rr-review-item.rr-hidden-item');
        let itemsToShow = Math.min(3, hiddenItems.length);

        for (let i = 0; i < itemsToShow; i++) {
            if (hiddenItems[i]) {
                hiddenItems[i].classList.remove('d-none');
                hiddenItems[i].classList.remove('rr-hidden-item');
                visibleCount++;
            }
        }

        // Check if all items are visible
        const remainingHidden = document.querySelectorAll('.rr-review-item.rr-hidden-item');
        if (remainingHidden.length === 0) {
            container.style.display = 'none';
        }
    });
});
</script>
@endsection
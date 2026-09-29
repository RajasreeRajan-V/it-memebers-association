{{-- resources/views/mentor/trainings/index.blade.php --}}
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


        {{-- ===================== HERO ===================== --}}

        <section class="rr-hero mb-4">

            <div class="rr-hero-content">

                <div class="rr-breadcrumb">
                    <i class="fa-solid fa-house"></i>
                    <span>›</span>
                    Trainings &amp; Courses
                </div>

                <h1 class="rr-hero-title">
                    Manage Your
                    <br>
                    <span class="blue">Trainings &amp; Courses</span>
                </h1>

                <p class="rr-hero-description">
                    Create, manage and share your trainings. Track approval status, edits and
                    performance in one place.
                </p>

                <div class="rr-hero-actions">
                    <a href="{{ route('mentor.trainings.create') }}" class="rr-hero-btn">
                        <i class="fa-solid fa-plus"></i>
                        Create Training
                    </a>
                </div>

                <div class="rr-hero-stats">

                    <div class="rr-mini-stat">
                        <div class="rr-mini-icon">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </div>

                        <div>
                            <p class="rr-mini-value">{{ $stats['total'] }}</p>
                            <p class="rr-mini-label">Total Trainings</p>
                        </div>
                    </div>

                    <div class="rr-mini-stat orange">
                        <div class="rr-mini-icon">
                            <i class="fa-regular fa-clock"></i>
                        </div>

                        <div>
                            <p class="rr-mini-value">{{ $stats['pending'] }}</p>
                            <p class="rr-mini-label">Pending Approval</p>
                        </div>
                    </div>

                    <div class="rr-mini-stat green">
                        <div class="rr-mini-icon">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>

                        <div>
                            <p class="rr-mini-value">{{ $stats['published'] ?? 0 }}</p>
                            <p class="rr-mini-label">Published</p>
                        </div>
                    </div>

                </div>

            </div>


            {{-- Decorative illustration: a course card with progress and enrolled learners --}}

            <div class="rr-hero-visual">

                <div class="rr-visual-circle"></div>

                <div class="rr-visual-card card-one">
                    <small>
                        <i class="fa-solid fa-users"></i>
                        Enrolled
                    </small>
                    <strong>128 Learners</strong>
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
                        <i class="fa-solid fa-circle-check"></i>
                        Status
                    </small>
                    <strong>Approved</strong>
                </div>

                <div class="rr-visual-screen">
                    <div class="rr-screen-live">
                        <span class="rr-live-dot"></span>
                        IN PROGRESS
                    </div>
                    <div class="rr-screen-play">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                </div>
                <div class="rr-visual-stand"></div>

                <div class="rr-visual-audience">
                    <span class="rr-aud-avatar one"></span>
                    <span class="rr-aud-avatar two"></span>
                    <span class="rr-aud-avatar three"></span>
                    <span class="rr-aud-more">+39</span>
                </div>

            </div>

        </section>


        {{-- ===================== TABS ===================== --}}
        @php
            $tabsList = [
                ['label' => 'All',              'status' => null,        'count' => $stats['total']],
                ['label' => 'Draft',             'status' => 'draft',     'count' => $stats['draft'] ?? 0],
                ['label' => 'Pending Approval',  'status' => 'pending',   'count' => $stats['pending']],
                ['label' => 'Approved',          'status' => 'approved',  'count' => $stats['approved']],
                ['label' => 'Rejected',          'status' => 'rejected',  'count' => $stats['rejected']],
                ['label' => 'Published',         'status' => 'published', 'count' => $stats['published'] ?? 0],
            ];
            $tabBadge = [
                null        => 'rr-badge-purple',
                'draft'     => 'rr-badge-blue',
                'pending'   => 'rr-badge-orange',
                'approved'  => 'rr-badge-blue',
                'rejected'  => 'rr-badge-red',
                'published' => 'rr-badge-green',
            ];
        @endphp
        <div class="rr-tabbar mb-4">
            @foreach ($tabsList as $t)
                <a href="{{ route('mentor.trainings.index', array_filter(['status' => $t['status'], 'q' => $search ?? null])) }}"
                   class="rr-tab {{ ($activeStatus ?? null) === $t['status'] ? 'rr-tab-active' : '' }}">
                    {{ $t['label'] }}
                    <span class="rr-pill {{ $tabBadge[$t['status']] ?? 'rr-badge-blue' }}">{{ $t['count'] }}</span>
                </a>
            @endforeach
        </div>

        {{-- ===================== MAIN GRID ===================== --}}
        <div class="rr-row tr-row">

            {{-- ---- LEFT / MAIN COLUMN: Trainings list ---- --}}
            <div class="rr-col-left tr-col-main">

                <div class="card rr-card border-0 mb-4">
                    <div class="card-header bg-white border-0 pb-3 pt-3 px-3">
                        <h2 class="h6 fw-semibold mb-3">My Trainings List</h2>
                        <form method="GET" action="{{ route('mentor.trainings.index') }}">
                            @if(!empty($activeStatus))
                                <input type="hidden" name="status" value="{{ $activeStatus }}">
                            @endif
                            <div class="input-group input-group-sm rr-search">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="fa-solid fa-magnifying-glass text-muted"></i>
                                </span>
                                <input type="text" name="q" value="{{ $search ?? '' }}" placeholder="Search trainings"
                                       class="form-control border-start-0 ps-0">
                            </div>
                        </form>
                    </div>

                    <div class="list-group list-group-flush">
                        @php
                            $iconPalette = ['rr-tag-0', 'rr-tag-1', 'rr-tag-2'];
                            $statusMap = [
                                'published' => ['label' => 'Published',        'class' => 'rr-badge-green'],
                                'approved'  => ['label' => 'Approved',         'class' => 'rr-badge-blue'],
                                'pending'   => ['label' => 'Pending Approval', 'class' => 'rr-badge-orange'],
                                'rejected'  => ['label' => 'Rejected',         'class' => 'rr-badge-red'],
                                'draft'     => ['label' => 'Draft',           'class' => 'rr-badge-blue'],
                            ];
                        @endphp

                        @forelse ($trainings as $index => $training)
                            @php
                                $accent = $iconPalette[$index % count($iconPalette)];
                                $statusInfo = $statusMap[$training->status] ?? ['label' => ucfirst($training->status), 'class' => 'rr-badge-blue'];
                                $thumbUrl = $training->thumbnail ? asset('storage/'.$training->thumbnail) : '';
                            @endphp

                            <div class="list-group-item py-3 border-0 border-bottom tr-training-item" role="button" tabindex="0"
                                 onclick="trOpenDetailsModal(this)"
                                 onkeydown="if(event.key==='Enter'){trOpenDetailsModal(this)}"
                                 data-title="{{ $training->title }}"
                                 data-description="{{ $training->short_description ?: 'No description provided.' }}"
                                 data-status="{{ $statusInfo['label'] }}"
                                 data-status-class="{{ $statusInfo['class'] }}"
                                 data-thumb="{{ $thumbUrl }}"
                                 data-rejection="{{ $training->status === 'rejected' ? $training->rejection_reason : '' }}"
                                 data-view-url="{{ route('mentor.trainings.show', $training) }}">

                                <div class="d-flex align-items-start gap-3">
                                    @if($thumbUrl)
                                        <img src="{{ $thumbUrl }}" class="rounded-3 flex-shrink-0 tr-item-thumb" alt="">
                                    @else
                                        <div class="tr-item-thumb tr-item-icon {{ $accent }} flex-shrink-0">
                                            <i class="fa-solid fa-graduation-cap"></i>
                                        </div>
                                    @endif

                                    <div class="flex-grow-1 min-w-0">
                                        <div class="d-flex justify-content-between align-items-start gap-2">
                                            <p class="fw-semibold mb-0 text-truncate">{{ $training->title }}</p>
                                        </div>
                                        <p class="small text-muted mb-2 text-truncate">
                                            {{ \Illuminate\Support\Str::limit($training->short_description, 90) }}
                                        </p>
                                        <div class="d-flex flex-wrap gap-1 align-items-center">
                                            <span class="rr-pill {{ $statusInfo['class'] }}">{{ $statusInfo['label'] }}</span>
                                        </div>
                                        @if ($training->status === 'rejected' && $training->rejection_reason)
                                            <p class="small mb-0 mt-2 tr-rejection-note">
                                                <i class="fa-solid fa-circle-exclamation me-1"></i>{{ \Illuminate\Support\Str::limit($training->rejection_reason, 80) }}
                                            </p>
                                        @endif
                                    </div>

                                    <div class="row-actions-wrap flex-shrink-0" onclick="event.stopPropagation()">
                                        <button type="button" class="row-actions-btn" onclick="trToggleRowMenu(this)" aria-label="Row actions">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </button>
                                        <div class="row-actions-menu">
                                            <a href="{{ route('mentor.trainings.show', $training) }}" class="row-menu-item">
                                                <i class="fa-regular fa-eye"></i> View
                                            </a>

                                            @if ($training->isEditableByMentor())
                                                <a href="{{ route('mentor.trainings.edit', $training) }}" class="row-menu-item">
                                                    <i class="fa-solid fa-pen"></i> Edit
                                                </a>
                                            @endif

                                            @if ($training->status === 'draft')
                                                <form action="{{ route('mentor.trainings.submit', $training) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="row-menu-item">
                                                        <i class="fa-solid fa-paper-plane"></i> Submit for Approval
                                                    </button>
                                                </form>
                                                <form action="{{ route('mentor.trainings.destroy', $training) }}" method="POST"
                                                      onsubmit="return confirm('Delete &quot;{{ $training->title }}&quot;? This cannot be undone.');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="row-menu-item row-menu-danger">
                                                        <i class="fa-regular fa-trash-can"></i> Delete
                                                    </button>
                                                </form>
                                            @endif

                                            @if ($training->status === 'rejected')
                                                <form action="{{ route('mentor.trainings.submit', $training) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="row-menu-item">
                                                        <i class="fa-solid fa-rotate-right"></i> Resubmit
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-muted py-5">
                                No trainings found. <a href="{{ route('mentor.trainings.create') }}">Create your first one</a>.
                            </div>
                        @endforelse
                    </div>

                    @if ($trainings->hasPages())
                        <div class="card-footer bg-white text-center border-0">
                            {{ $trainings->links() }}
                        </div>
                    @endif
                </div>
            </div>

            {{-- ---- RIGHT COLUMN: Sidebar ---- --}}
            <div class="tr-col-side">

                {{-- Quick Actions --}}
                <div class="card rr-card rr-side-card border-0 mb-4">
                    <div class="rr-side-card-accent"></div>
                    <div class="card-body">
                        <p class="rr-side-label mb-3"><i class="fa-solid fa-bolt"></i> Quick Actions</p>

                        <a href="{{ route('mentor.trainings.create') }}" class="rr-hero-btn w-100 justify-content-center mb-3">
                            <i class="fa-solid fa-plus"></i> Create Training
                        </a>

                        <a href="{{ route('mentor.trainings.index', ['status' => 'draft']) }}" class="tr-quick-action">
                            <span class="tr-qa-icon rr-tag-0"><i class="fa-regular fa-file-lines"></i></span>
                            <span class="tr-qa-text">
                                Continue a Draft
                                <small>Pick up where you left off</small>
                            </span>
                        </a>
                        <a href="{{ route('mentor.trainings.index', ['status' => 'rejected']) }}" class="tr-quick-action">
                            <span class="tr-qa-icon rr-tag-2"><i class="fa-solid fa-rotate-right"></i></span>
                            <span class="tr-qa-text">
                                Review Rejected
                                <small>Fix and resubmit for approval</small>
                            </span>
                        </a>
                    </div>
                </div>

                {{-- Training Overview --}}
                <div class="card rr-card rr-side-card border-0 mb-4">
                    <div class="rr-side-card-accent"></div>
                    <div class="card-body">
                        <p class="rr-side-label mb-3"><i class="fa-solid fa-chart-simple"></i> Training Overview</p>
                        <ul class="list-unstyled small mb-0 rr-side-list tr-overview-list">
                            <li><span class="tr-dot" style="background:#3376F2;"></span>Total Trainings <span class="tr-count">{{ $stats['total'] }}</span></li>
                            <li><span class="tr-dot" style="background:#22B573;"></span>Approved <span class="tr-count">{{ $stats['approved'] }}</span></li>
                            <li><span class="tr-dot" style="background:#F5A623;"></span>Pending Approval <span class="tr-count">{{ $stats['pending'] }}</span></li>
                            <li><span class="tr-dot" style="background:#EF5350;"></span>Rejected <span class="tr-count">{{ $stats['rejected'] }}</span></li>
                        </ul>
                    </div>
                </div>

                {{-- Latest Trainings --}}
                <div class="card rr-card rr-side-card border-0 mb-4">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3 border-0">
                        <h3 class="h6 fw-semibold mb-0">
                            <i class="fa-solid fa-clock-rotate-left me-2" style="color:#3376F2;"></i>Latest Trainings
                        </h3>
                        <a href="{{ route('mentor.trainings.index') }}" class="rr-side-link rr-side-link-sm">View All</a>
                    </div>
                    <div class="list-group list-group-flush">
                        @php
                            $recStatusMap = [
                                'published' => 'rr-badge-green',
                                'approved'  => 'rr-badge-blue',
                                'pending'   => 'rr-badge-orange',
                                'rejected'  => 'rr-badge-red',
                                'draft'     => 'rr-badge-blue',
                            ];
                        @endphp
                        @forelse (($recent ?? collect()) as $item)
                            <div class="list-group-item py-3 border-0 border-bottom rr-history-item">
                                <div class="d-flex align-items-center gap-2">
                                    @if($item->thumbnail)
                                        <img src="{{ asset('storage/'.$item->thumbnail) }}" class="rounded-3 flex-shrink-0" width="32" height="32" style="object-fit:cover;" alt="">
                                    @else
                                        <span class="tr-item-icon rr-tag-0 flex-shrink-0" style="width:32px;height:32px;font-size:13px;">
                                            <i class="fa-solid fa-graduation-cap"></i>
                                        </span>
                                    @endif
                                    <div class="flex-grow-1 min-w-0">
                                        <p class="small fw-semibold mb-0 text-truncate">{{ \Illuminate\Support\Str::limit($item->title, 26) }}</p>
                                        <p class="small text-muted mb-0 text-truncate">
                                            {{ $item->created_at?->format('d M Y') }}
                                        </p>
                                    </div>
                                    <span class="rr-pill {{ $recStatusMap[$item->status] ?? 'rr-badge-blue' }} flex-shrink-0">{{ ucfirst($item->status) }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="list-group-item text-center text-muted py-4 small border-0">No recent trainings.</div>
                        @endforelse
                    </div>
                </div>

                {{-- Tips --}}
                <div class="card rr-card rr-side-card border-0">
                    <div class="rr-side-card-accent"></div>
                    <div class="card-body">
                        <p class="rr-side-label mb-3"><i class="fa-regular fa-lightbulb"></i> Tips for a Great Training</p>
                        <ul class="tr-tips-list small text-muted mb-0">
                            <li>Write a clear, benefit-driven title</li>
                            <li>Keep the short description concise and specific</li>
                            <li>Use a high-quality thumbnail image</li>
                            <li>Break content into digestible modules</li>
                            <li>Submit early so review isn't rushed</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- ===================== TRAINING DETAILS MODAL ===================== --}}
<div class="tr-modal-overlay" id="trModalOverlay" onclick="trCloseDetailsModal(event)">
    <div class="tr-modal" onclick="event.stopPropagation()">
        <button type="button" class="tr-modal-close" onclick="trCloseDetailsModal()" aria-label="Close">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <div class="tr-modal-cover" id="trModalCover" style="display:none;"></div>

        <div class="tr-modal-body">
            <span class="rr-pill mb-3 d-inline-flex" id="trModalStatus"></span>

            <h2 id="trModalTitle" class="h5 fw-semibold mb-2"></h2>

            <p class="small text-muted mb-3" id="trModalDescription"></p>

            <div class="alert alert-danger py-2 px-3 small mb-3" id="trModalRejection" style="display:none;"></div>

            <a href="#" id="trModalViewBtn" class="rr-hero-btn">
                <i class="fa-regular fa-eye"></i> View Full Training
            </a>
        </div>
    </div>
</div>

<style>
/* =========================================================
   TRAININGS INDEX
   Same design language as the Webinars & Workshops page:
   soft blue/purple palette, card panels, CSS-drawn hero
   illustration.
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


/* Grid: main list (flex) + fixed sidebar */
.tr-row {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 340px;
    gap: 20px;
    width: 100%;
    align-items: start;
}

.tr-col-main, .tr-col-side { width: 100%; min-width: 0; }
.tr-col-side > .card:not(:last-child) { margin-bottom: 18px !important; }


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
    border: none;
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
   HERO VISUAL - a course card with progress and enrolled learners
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

.rr-visual-screen {
    position: absolute;
    z-index: 4;
    left: 34%;
    top: 22px;
    width: 150px;
    height: 100px;
    background: linear-gradient(145deg, #1E293B, #111827);
    border-radius: 10px;
    box-shadow: 0 16px 30px rgba(20, 30, 55, .28);
    display: flex;
    align-items: center;
    justify-content: center;
}

.rr-screen-live {
    position: absolute;
    top: 8px;
    left: 8px;
    display: flex;
    align-items: center;
    gap: 5px;
    padding: 3px 7px;
    border-radius: 999px;
    background: rgba(51, 118, 242, .18);
    color: #8FB4FF;
    font-size: 8px;
    font-weight: 800;
    letter-spacing: .05em;
}

.rr-live-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: #3376F2;
}

.rr-screen-play {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    background: rgba(255,255,255,.14);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 13px;
}

.rr-visual-stand {
    position: absolute;
    z-index: 3;
    left: calc(34% + 62px);
    top: 122px;
    width: 26px;
    height: 16px;
    background: #CBD5E5;
    border-radius: 0 0 6px 6px;
}

.rr-visual-audience {
    position: absolute;
    z-index: 5;
    left: 30%;
    bottom: 20px;
    display: flex;
    align-items: center;
}

.rr-aud-avatar {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    border: 2px solid #fff;
    margin-left: -9px;
    box-shadow: 0 4px 10px rgba(35, 61, 105, .12);
}

.rr-aud-avatar.one {
    background: linear-gradient(145deg, #7A4EE8, #9A70FF);
    margin-left: 0;
}

.rr-aud-avatar.two {
    background: linear-gradient(145deg, #2770DF, #408AF5);
}

.rr-aud-avatar.three {
    background: linear-gradient(145deg, #22B573, #4CD68C);
}

.rr-aud-more {
    margin-left: -9px;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    border: 2px solid #fff;
    background: #EEF4FF;
    color: var(--rr-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 9px;
    font-weight: 800;
    box-shadow: 0 4px 10px rgba(35, 61, 105, .12);
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
    top: 10px;
}

.rr-visual-card.card-two {
    right: 0;
    top: 30px;
}

.rr-visual-card.card-three {
    right: 6%;
    bottom: 10px;
}


/* =========================================================
   TABS
   ========================================================= */

.rr-tabbar { width: 100%; display: flex; align-items: center; gap: 30px; border-bottom: 1px solid #DDE2EA; margin-bottom: 14px; padding: 0 2px; overflow-x: auto; }
.rr-tab { display: inline-flex; align-items: center; gap: 10px; padding: 12px 2px 11px; color: #667085; font-size: 15px; font-weight: 600; text-decoration: none; border-bottom: 2px solid transparent; white-space: nowrap; }
.rr-tab:hover { color: var(--rr-primary); }
.rr-tab-active { color: var(--rr-primary); font-weight: 700; border-bottom-color: var(--rr-primary); }

.rr-pill { display: inline-flex; align-items: center; justify-content: center; min-width: 24px; height: 23px; padding: 0 8px; border-radius: 999px; font-size: 12px; font-weight: 700; }
.rr-badge-blue { background: #EEF4FF; color: var(--rr-primary); }
.rr-badge-orange { background: #FFF6E7; color: var(--rr-orange); }
.rr-badge-green { background: #EAF9F2; color: var(--rr-green); }
.rr-badge-purple { background: #F3EFFF; color: var(--rr-purple); }
.rr-badge-red { background: #FFF0F2; color: var(--rr-red); }

/* =========================================================
   CARDS
   ========================================================= */

.rr-card { background: #ffffff; border: 1px solid var(--rr-border) !important; border-radius: var(--rr-radius); box-shadow: var(--rr-shadow); overflow: hidden; }
.rr-col-left .card-header, .tr-col-main .card-header { padding: 18px 16px !important; }
.rr-col-left .card-header h2, .tr-col-main .card-header h2 { font-size: 17px !important; color: #1F2937; font-weight: 700 !important; }

.rr-search { width: 100%; border: 1px solid #E2E6ED; border-radius: 8px; overflow: hidden; }
.rr-search .input-group-text { border: 0 !important; background: #ffffff !important; padding-left: 10px; padding-right: 6px; }
.rr-search .form-control { border: 0 !important; box-shadow: none !important; height: 42px; font-size: 14px; color: #374151; }
.rr-search .form-control::placeholder { color: #9CA3AF; font-size: 13px; }

/* ---- Training list item ---- */
.tr-training-item { padding: 15px 14px !important; border-bottom: 1px solid #F0F2F5 !important; transition: background .15s ease; background: #ffffff; cursor: pointer; }
.tr-training-item:hover { background: #F8FAFF; }
.tr-training-item .fw-semibold { font-size: 15px; color: #1F2937; }
.tr-training-item .small { font-size: 13px; }

.tr-item-thumb { width: 56px; height: 56px; object-fit: cover; }
.tr-item-icon { display: flex; align-items: center; justify-content: center; border-radius: 10px; font-size: 20px; }

.tr-rejection-note { color: var(--rr-red); }

.rr-tag { display: inline-flex; align-items: center; padding: 4px 10px; border-radius: 5px; font-size: 11px; font-weight: 600; white-space: nowrap; }
.rr-tag-0 { background: #EEF4FF; color: var(--rr-primary); }
.rr-tag-1 { background: #EAF9F2; color: var(--rr-green); }
.rr-tag-2 { background: #F3EFFF; color: var(--rr-purple); }

/* ---- 3-dot row actions ---- */
.row-actions-wrap { position: relative; }
.row-actions-btn { width: 30px; height: 30px; border: none; background: #F3F4F6; border-radius: 8px; color: #6B7280; display: inline-flex; align-items: center; justify-content: center; cursor: pointer; }
.row-actions-btn:hover { background: #EEF4FF; color: var(--rr-primary); }
.row-actions-menu { display: none; position: absolute; right: 0; top: calc(100% + 6px); background: #fff; border: 1px solid #E7EAF0; border-radius: 10px; box-shadow: var(--rr-shadow); min-width: 210px; z-index: 20; overflow: hidden; }
.row-actions-menu.open { display: block; }
.row-menu-item { display: flex; align-items: center; gap: 10px; width: 100%; padding: 10px 14px; font-size: 13px; color: #374151; text-decoration: none; background: none; border: none; text-align: left; }
.row-menu-item:hover { background: #F8FAFF; color: var(--rr-primary); }
.row-menu-danger { color: var(--rr-red); }
.row-menu-danger:hover { background: #FFF0F2; color: var(--rr-red); }

/* ---- Side cards ---- */
.rr-side-card { width: 100%; position: relative; overflow: hidden; }
.rr-side-card-accent { height: 3px; width: 100%; background: var(--rr-primary); }
.rr-side-card .card-body { padding: 18px !important; }
.rr-side-label { display: flex; align-items: center; gap: 8px; color: #374151; font-size: 13px; font-weight: 700; margin-bottom: 15px !important; }
.rr-side-label i { color: var(--rr-primary); }
.rr-side-card h3 { font-size: 14px !important; color: #1F2937; font-weight: 700; }
.rr-side-link { display: inline-flex; align-items: center; gap: 7px; color: var(--rr-primary); font-size: 12px; font-weight: 700; text-decoration: none; }
.rr-side-link:hover { color: var(--rr-primary-dark); }
.rr-side-link-sm { font-size: 11px; }

/* Quick actions */
.tr-quick-action { display: flex; align-items: center; gap: 12px; padding: 12px; border-radius: 10px; text-decoration: none; margin-bottom: 8px; transition: background .15s ease; }
.tr-quick-action:last-child { margin-bottom: 0; }
.tr-quick-action:hover { background: #F8FAFF; }
.tr-qa-icon { width: 36px; height: 36px; border-radius: 10px; display: inline-flex; align-items: center; justify-content: center; font-size: 15px; flex-shrink: 0; }
.tr-qa-text { display: flex; flex-direction: column; font-size: 13px; font-weight: 600; color: #1F2937; }
.tr-qa-text small { font-size: 11.5px; font-weight: 400; color: #6B7280; }

/* Overview list */
.tr-overview-list li { display: flex; align-items: center; gap: 10px; color: #374151; font-size: 13px; font-weight: 500; margin-bottom: 12px !important; }
.tr-overview-list li:last-child { margin-bottom: 0 !important; }
.tr-dot { width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; }
.tr-count { margin-left: auto; font-weight: 700; color: #1F2937; }

/* Review/history style rows for latest trainings */
.rr-history-item { padding: 12px 16px !important; border-bottom: 1px solid #F0F2F5 !important; transition: background .15s ease; }
.rr-history-item:hover { background: #FAFBFF; }

/* Tips */
.tr-tips-list { padding-left: 18px; margin: 0; line-height: 1.7; }

/* ---- Pagination ---- */
.tr-col-main .pagination { justify-content: center; margin: 10px 0; }
.tr-col-main .pagination .page-link { font-size: 13px; border-radius: 6px; margin: 0 2px; color: var(--rr-primary); }
.tr-col-main .pagination .active .page-link { background: var(--rr-primary); border-color: var(--rr-primary); color: #ffffff; }

/* ---- Modal ---- */
.tr-modal-overlay {
    display: none; position: fixed; inset: 0; background: rgba(17, 24, 39, .55);
    align-items: center; justify-content: center; z-index: 1050; padding: 20px;
}
.tr-modal-overlay.open { display: flex; }
.tr-modal {
    width: 100%; max-width: 520px; max-height: 88vh; overflow-y: auto;
    background: #fff; border-radius: var(--rr-radius); box-shadow: var(--rr-shadow);
    position: relative;
}
.tr-modal-close {
    position: absolute; top: 14px; right: 14px; width: 32px; height: 32px; border: none;
    background: rgba(255,255,255,.9); border-radius: 50%; display: inline-flex; align-items: center;
    justify-content: center; cursor: pointer; z-index: 2; color: #374151; box-shadow: 0 2px 6px rgba(0,0,0,.15);
}
.tr-modal-cover { width: 100%; height: 200px; overflow: hidden; }
.tr-modal-body { padding: 24px; }

/* =========================================================
   RESPONSIVE
   ========================================================= */
@media (min-width: 1500px) {
    .rr-row { grid-template-columns: minmax(0, 1fr) 380px; gap: 24px; }
    .rr-hero-title { font-size: 40px; }
}

@media (max-width: 1200px) {
    .rr-page { padding-left: 20px; padding-right: 20px; }
    .rr-row { grid-template-columns: minmax(0, 1fr) 300px; gap: 16px; }
    .rr-hero-title { font-size: 30px; }
    .rr-hero-content { width: 62%; }
    .rr-hero-visual { width: 38%; }
}

@media (max-width: 991px) {
    .tr-row { grid-template-columns: 1fr; }
    .tr-col-main { order: 1; }
    .tr-col-side { order: 2; }

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
}

@media (max-width: 767px) {
    .rr-page { font-size: 14px; padding-left: 12px; padding-right: 12px; }

    .rr-hero { padding: 22px 18px; }
    .rr-hero-title { font-size: 26px; }
    .rr-hero-description { font-size: 13px; }

    .rr-hero-stats {
        flex-direction: column;
        width: 100%;
    }

    .rr-mini-stat { min-width: 100%; }

    .rr-hero-visual { display: none; }

    .rr-tabbar { gap: 18px; scrollbar-width: none; }
    .rr-tabbar::-webkit-scrollbar { display: none; }
    .rr-tab { font-size: 13px; gap: 7px; }
    .rr-pill { font-size: 11px; min-width: 22px; height: 21px; padding: 0 7px; }
    .tr-training-item .fw-semibold { font-size: 14px; }
    .tr-training-item .small { font-size: 12px; }
    .tr-item-thumb, .tr-item-icon { width: 44px; height: 44px; }
}

@media (max-width: 480px) {
    .rr-page { font-size: 13px; }
    .rr-hero-title { font-size: 22px; }
    .rr-hero-description { font-size: 12px; }
    .rr-hero-btn { width: 100%; }
    .rr-tab { font-size: 12px; gap: 6px; padding: 10px 2px 9px; }
    .rr-pill { font-size: 10px; min-width: 20px; height: 19px; padding: 0 6px; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // ---------- 3-dot row menu ----------
    window.trToggleRowMenu = function (btn) {
        const menu = btn.nextElementSibling;
        const isOpen = menu.classList.contains('open');
        document.querySelectorAll('.row-actions-menu.open').forEach(m => m.classList.remove('open'));
        if (!isOpen) menu.classList.add('open');
    };

    document.addEventListener('click', function (e) {
        if (!e.target.closest('.row-actions-wrap')) {
            document.querySelectorAll('.row-actions-menu.open').forEach(m => m.classList.remove('open'));
        }
    });

    // ---------- Training details modal ----------
    window.trOpenDetailsModal = function (card) {
        const d = card.dataset;

        document.getElementById('trModalTitle').textContent = d.title;
        document.getElementById('trModalDescription').textContent = d.description;

        const statusEl = document.getElementById('trModalStatus');
        statusEl.textContent = d.status;
        statusEl.className = 'rr-pill mb-3 d-inline-flex ' + d.statusClass;

        const rejectionEl = document.getElementById('trModalRejection');
        if (d.rejection) {
            rejectionEl.style.display = 'block';
            rejectionEl.innerHTML = '<strong>Rejected:</strong> ' + d.rejection;
        } else {
            rejectionEl.style.display = 'none';
        }

        const viewBtn = document.getElementById('trModalViewBtn');
        if (d.viewUrl) viewBtn.href = d.viewUrl;

        const coverEl = document.getElementById('trModalCover');
        coverEl.innerHTML = '';
        if (d.thumb) {
            coverEl.style.display = 'block';
            coverEl.innerHTML = '<img src="' + d.thumb + '" alt="" style="width:100%;height:100%;object-fit:cover;display:block;">';
        } else {
            coverEl.style.display = 'none';
        }

        document.getElementById('trModalOverlay').classList.add('open');
        document.body.style.overflow = 'hidden';
    };

    window.trCloseDetailsModal = function () {
        document.getElementById('trModalOverlay').classList.remove('open');
        document.body.style.overflow = '';
    };

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') trCloseDetailsModal();
    });
});
</script>
@endsection
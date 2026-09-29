{{-- resources/views/employers/freelancer/bid/bid_approval.blade.php --}}
@extends('layouts.app')

@php
    $bidNo = $bid->bid_number ?? $bid->id;
    $status = in_array($bid->status, ['approved', 'accepted']) ? 'approved' : $bid->status;
    $fl = $bid->freelancer;
    $flUser = $fl?->user;
    $desc = trim($bid->project->description ?? '') ?: 'No description provided.';
    $cover = trim($bid->cover_letter ?? '');
    $descLong = mb_strlen($desc) > 150 || substr_count($desc, "\n") >= 2;
    $coverLong = mb_strlen($cover) > 200 || substr_count($cover, "\n") >= 3;
    $skills = collect(preg_split('/[,;\n]+/', (string) ($fl?->skills ?? '')))->map(fn($s) => trim($s))->filter();
    $days = $bid->estimated_days;

    // Resume: find the value, whatever the column is called
    $resumeRaw = $fl?->resume_path ?? ($fl?->resumePath ?? ($fl?->resume ?? ($fl?->resume_file ?? null)));

    // Resume: build a working URL
    $resumeUrl = null;
    if (!empty($resumeRaw)) {
        if (\Illuminate\Support\Str::startsWith($resumeRaw, ['http://', 'https://'])) {
            $resumeUrl = $resumeRaw;
        } else {
            $clean = ltrim(preg_replace('#^(public/|storage/)#', '', $resumeRaw), '/');

            if (\Illuminate\Support\Facades\Storage::disk('public')->exists($clean)) {
                $resumeUrl = \Illuminate\Support\Facades\Storage::disk('public')->url($clean);
            } elseif (file_exists(public_path($resumeRaw))) {
                $resumeUrl = asset($resumeRaw);
            }
        }
    }
@endphp

@section('title', 'Bid Approval #' . $bidNo)
@section('page-title', 'Bid Approval')
@section('page-subtitle', '#' . $bidNo)

@section('content')
    <div class="ba-page">

        <a href="{{ route('employer.freelancer.bids.project', $bid->project->id) }}" class="ba-btn ba-btn--outline ba-back">
            <i class="fas fa-arrow-left"></i><span>Back to Bids</span>
        </a>

        {{-- Status banner --}}
        @if ($status === 'pending')
            <div class="ba-notice ba-notice--warning">
                <i class="fas fa-clock"></i>
                <div><strong>Pending Approval</strong>
                    <p>This bid is awaiting review. Please check the details below and take action.</p>
                </div>
            </div>
        @elseif ($status === 'approved')
            <div class="ba-notice ba-notice--success">
                <i class="fas fa-check-circle"></i>
                <div><strong>Approved</strong>
                    <p>This bid was approved on {{ ($bid->approved_at ?? $bid->updated_at)->format('M d, Y H:i') }}.</p>
                </div>
            </div>
        @elseif ($status === 'rejected')
            <div class="ba-notice ba-notice--danger">
                <i class="fas fa-times-circle"></i>
                <div><strong>Rejected</strong>
                    <p>This bid has been rejected and cannot be modified.</p>
                </div>
            </div>
        @endif

        <div class="ba-grid">
            {{-- ================= MAIN ================= --}}
            <div class="ba-col">

                {{-- Bid information --}}
                <section class="ba-panel">
                    <header class="ba-panel__head">
                        <h6><i class="fas fa-info-circle"></i> Bid Information</h6>
                        <span class="ba-badge ba-badge--{{ $status }}">{{ ucfirst($status) }}</span>
                    </header>
                    <div class="ba-panel__body">
                        <dl class="ba-info">
                            <div>
                                <dt>Bid Number</dt>
                                <dd class="ba-strong">#{{ $bidNo }}</dd>
                            </div>
                            <div>
                                <dt>Date Submitted</dt>
                                <dd><i class="far fa-calendar-alt"></i>{{ $bid->created_at->format('M d, Y H:i') }}</dd>
                            </div>
                            <div>
                                <dt>Project Title</dt>
                                <dd class="ba-semibold">{{ $bid->project->title ?? 'N/A' }}</dd>
                            </div>
                            <div>
                                <dt>Category</dt>
                                <dd><span class="ba-chip">{{ $bid->category ?? 'Uncategorized' }}</span></dd>
                            </div>

                            <div class="ba-full">
                                <dt>Project Description</dt>
                                <dd class="ba-box">
                                    <div class="ba-clamp {{ $descLong ? '' : 'ba-expanded' }}" id="descBox">
                                        {{ $desc }}</div>
                                    @if ($descLong)
                                        <button type="button" class="ba-more"
                                            onclick="var b=document.getElementById('descBox');var o=b.classList.toggle('ba-expanded');this.classList.toggle('is-open',o);this.querySelector('span').textContent=o?'Show Less':'Show More';">
                                            <span>Show More</span><i class="fas fa-chevron-down"></i>
                                        </button>
                                    @endif
                                </dd>
                            </div>

                            <div>
                                <dt>Bid Amount</dt>
                                <dd class="ba-amount">₹{{ number_format((float) $bid->bid_amount, 2) }}</dd>
                            </div>
                            <div>
                                <dt>Estimated Duration</dt>
                                <dd><i class="far fa-clock"></i>
                                    {{ $days ? $days . (is_numeric($days) ? ' days' : '') : 'Not specified' }}</dd>
                            </div>
                            <div class="ba-full">
                                <dt>Job Posted By</dt>
                                <dd class="ba-person">
                                    <span
                                        class="ba-avatar">{{ strtoupper(substr($bid->employer->name ?? 'U', 0, 1)) }}</span>
                                    <span>
                                        <b>{{ $bid->employer->name ?? 'Unknown' }}</b>
                                        <small><i class="fas fa-envelope"></i> {{ $bid->employer->email ?? '' }}</small>
                                    </span>
                                </dd>
                            </div>
                        </dl>
                    </div>
                </section>

                {{-- Bidder profile --}}
                <section class="ba-panel ba-panel--highlight">
                    <header class="ba-panel__head">
                        <h6><i class="fas fa-user-circle"></i> Bidder Profile</h6>
                        @if ($flUser?->profile_verified ?? false)
                            <span class="ba-badge ba-badge--approved"><i class="fas fa-check-circle"></i> Verified</span>
                        @endif
                    </header>
                    <div class="ba-panel__body">
                        <div class="ba-profile">
                            <span
                                class="ba-avatar ba-avatar--lg">{{ strtoupper(substr($flUser->name ?? 'U', 0, 1)) }}</span>
                            <div>
                                <h2>{{ $flUser->name ?? 'Unknown Bidder' }}</h2>
                                <p class="ba-muted">{{ $fl->specialization ?? 'Freelancer' }}</p>
                                <div class="ba-meta">
                                    <span><i class="fas fa-phone"></i> {{ $flUser->phone ?? 'Phone not specified' }}</span>
                                    <span><i class="fas fa-calendar-alt"></i> Member since
                                        {{ optional($flUser?->created_at)->format('M Y') ?? '—' }}</span>
                                </div>
                            </div>
                        </div>

                        <nav class="ba-tabs">
                            <button type="button" class="ba-tab is-active" data-tab="bio">Bio &amp; Skills</button>
                            <button type="button" class="ba-tab" data-tab="experience">Experience</button>
                            <button type="button" class="ba-tab" data-tab="portfolio">Portfolio</button>
                            <button type="button" class="ba-tab" data-tab="resume">Resume</button>
                        </nav>

                        <div class="ba-pane is-active" id="pane-bio">
                            <h5><i class="fas fa-address-card"></i> Contact</h5>
                            <ul class="ba-contact">
                                <li><i class="fas fa-envelope"></i>{{ $flUser->email ?? 'No email provided.' }}</li>
                                <li><i class="fas fa-phone"></i>{{ $flUser->phone ?? 'No phone number provided.' }}</li>
                            </ul>
                            <h5><i class="fas fa-tags"></i> Skills</h5>
                            <div class="ba-tags">
                                @forelse ($skills as $skill)
                                    <span class="ba-chip ba-chip--pill">{{ $skill }}</span>
                                @empty
                                    <span class="ba-muted">No skills listed.</span>
                                @endforelse
                            </div>
                        </div>

                        <div class="ba-pane" id="pane-experience">
                            @if (!empty($fl?->experience))
                                <div class="ba-box"><i class="fas fa-briefcase"></i> {{ $fl->experience }} years of
                                    experience</div>
                            @else
                                <p class="ba-empty">No work experience listed.</p>
                            @endif
                        </div>

                        <div class="ba-pane" id="pane-portfolio">
                            @if (!empty($fl?->portfolio_link) || !empty($fl?->github))
                                <div class="ba-links">
                                    @if (!empty($fl->portfolio_link))
                                        <a href="{{ $fl->portfolio_link }}" target="_blank" rel="noopener"
                                            class="ba-btn ba-btn--outline">
                                            <i class="fas fa-globe"></i><span>Portfolio</span></a>
                                    @endif
                                    @if (!empty($fl->github))
                                        <a href="{{ $fl->github }}" target="_blank" rel="noopener"
                                            class="ba-btn ba-btn--outline">
                                            <i class="fab fa-github"></i><span>GitHub</span></a>
                                    @endif
                                </div>
                            @else
                                <p class="ba-empty">No portfolio available.</p>
                            @endif
                        </div>

                        <div class="ba-pane" id="pane-resume">
                            @if ($resumeUrl)
                                <a href="{{ route('employer.freelancer.bids.resume', $bid->id) }}" target="_blank"
                                    rel="noopener" class="ba-btn ba-btn--primary">
                                    <i class="fas fa-file-pdf"></i>
                                    <span>View Resume</span>
                                </a>
                            @else
                                <p class="ba-empty">No resume available.</p>
                            @endif
                        </div>
                    </div>
                </section>

                {{-- Approval timeline --}}
                @if (isset($bid->approvals) && $bid->approvals->count() > 0)
                    <section class="ba-panel">
                        <header class="ba-panel__head">
                            <h6><i class="fas fa-history"></i> Approval Timeline</h6>
                        </header>
                        <div class="ba-panel__body">
                            <ul class="ba-timeline">
                                @foreach ($bid->approvals as $a)
                                    @php $as = in_array($a->status, ['approved', 'accepted']) ? 'approved' : $a->status; @endphp
                                    <li>
                                        <span class="ba-dot ba-dot--{{ $as }}">
                                            <i
                                                class="fas fa-{{ $as === 'approved' ? 'check' : ($as === 'rejected' ? 'times' : 'clock') }}"></i>
                                        </span>
                                        <div class="ba-box">
                                            <div class="ba-row">
                                                <b>{{ $a->approver->name ?? 'System' }}</b>
                                                <span
                                                    class="ba-badge ba-badge--{{ $as }}">{{ ucfirst($as) }}</span>
                                                <small
                                                    class="ba-muted ba-right">{{ $a->created_at->format('M d, Y H:i') }}</small>
                                            </div>
                                            @if ($a->comments)
                                                <p class="ba-comment">{{ $a->comments }}</p>
                                            @endif
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </section>
                @endif
            </div>

            {{-- ================= SIDEBAR ================= --}}
            <aside class="ba-col">
                <section class="ba-panel">
                    <header class="ba-panel__head">
                        <h6><i class="fas fa-envelope-open-text"></i> Cover Letter</h6>
                        <span class="ba-badge ba-badge--info">Bid Proposal</span>
                    </header>
                    <div class="ba-panel__body">
                        @if ($cover !== '')
                            <div class="ba-box">
                                <div class="ba-clamp ba-clamp--sm {{ $coverLong ? '' : 'ba-expanded' }}" id="coverBox">
                                    {{ $cover }}</div>
                                @if ($coverLong)
                                    <button type="button" class="ba-more"
                                        onclick="var b=document.getElementById('coverBox');var o=b.classList.toggle('ba-expanded');this.classList.toggle('is-open',o);this.querySelector('span').textContent=o?'Show Less':'Show More';">
                                        <span>Show More</span><i class="fas fa-chevron-down"></i>
                                    </button>
                                @endif
                            </div>
                        @else
                            <p class="ba-empty">No cover letter provided with this bid.</p>
                        @endif
                    </div>
                </section>

                @if ($status === 'pending')
                    <section class="ba-panel">
                        <header class="ba-panel__head">
                            <h6><i class="fas fa-gavel"></i> Approval Actions</h6>
                        </header>
                        <div class="ba-panel__body">
                            <form action="{{ route('employer.freelancer.bids.approve', $bid->id) }}" method="POST"
                                id="approvalForm">
                                @csrf
                                @method('PUT')

                                <div class="ba-field">
                                    <label for="approver_name">Approver Name</label>
                                    <input type="text" id="approver_name" name="approver_name" readonly required
                                        value="{{ old('approver_name', Auth::user()->name ?? '') }}">
                                    @error('approver_name')
                                        <span class="ba-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="ba-field">
                                    <label for="comments">Comments / Notes</label>
                                    <textarea id="comments" name="comments" rows="6" placeholder="Add any comments or notes about this bid...">{{ old('comments', 'Your proposal looks good, and your skills match our project requirements. We would like to proceed with your bid. We will contact you shortly to discuss the next steps.') }}</textarea>
                                    @error('comments')
                                        <span class="ba-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="ba-actions">
                                    <button type="submit" name="action" value="accepted"
                                        class="ba-btn ba-btn--success">
                                        <i class="fas fa-check-circle"></i><span>Accept Bid</span></button>
                                    <button type="submit" name="action" value="rejected"
                                        class="ba-btn ba-btn--danger">
                                        <i class="fas fa-times-circle"></i><span>Reject Bid</span></button>
                                </div>
                            </form>
                        </div>
                    </section>
                @endif
            </aside>
        </div>
    </div>

    @push('styles')
        <style>
            /* Everything is prefixed "ba-" so global layout CSS can't clash with it. */
            .ba-page {
                --ink: #1a1a2e;
                --soft: #4a4a5a;
                --muted: #8a8fa8;
                --line: #e9edf4;
                --bg: #f8faff;
                --pri: #4a6cf7;
                --pri-d: #3a5ce0;
                --pri-s: rgba(74, 108, 247, .1);
                --ok: #10b981;
                --ok-d: #0e9c71;
                --warn: #f59e0b;
                --bad: #ef4444;
                --bad-d: #dc3737;
                max-width: 1280px;
                margin: 0 auto;
                padding: 1.5rem;
                font-size: .9rem;
                color: var(--ink)
            }

            .ba-page * {
                box-sizing: border-box
            }

            .ba-page p,
            .ba-page h2,
            .ba-page h5,
            .ba-page h6,
            .ba-page dl,
            .ba-page dd,
            .ba-page ul {
                margin: 0;
                padding: 0
            }

            .ba-page ul {
                list-style: none
            }

            .ba-back {
                margin-bottom: 1.25rem
            }

            .ba-notice {
                display: flex;
                gap: 1rem;
                align-items: center;
                padding: 1rem 1.25rem;
                border-radius: 12px;
                margin-bottom: 1.5rem;
                border: 1px solid
            }

            .ba-notice>i {
                font-size: 1.4rem
            }

            .ba-notice p {
                font-size: .85rem;
                opacity: .9;
                margin-top: .15rem
            }

            .ba-notice--warning {
                background: #fffbeb;
                border-color: #fde68a;
                color: #92400e
            }

            .ba-notice--success {
                background: #ecfdf5;
                border-color: #a7f3d0;
                color: #065f46
            }

            .ba-notice--danger {
                background: #fef2f2;
                border-color: #fecaca;
                color: #991b1b
            }

            .ba-grid {
                display: grid;
                grid-template-columns: minmax(0, 2fr) minmax(300px, 1fr);
                gap: 1.5rem;
                align-items: start
            }

            .ba-col {
                display: flex;
                flex-direction: column;
                gap: 1.5rem;
                min-width: 0
            }

            .ba-panel {
                background: #fff;
                border: 1px solid var(--line);
                border-radius: 12px;
                box-shadow: 0 1px 3px rgba(20, 20, 43, .05)
            }

            .ba-panel--highlight {
                border: 2px solid var(--pri)
            }

            .ba-panel__head {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: .75rem;
                padding: 1rem 1.5rem;
                border-bottom: 1px solid var(--line)
            }

            .ba-panel__head h6 {
                font-size: .95rem;
                font-weight: 700;
                color: var(--pri);
                display: flex;
                align-items: center;
                gap: .5rem
            }

            .ba-panel__body {
                padding: 1.5rem
            }

            .ba-info {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 1.5rem
            }

            .ba-info>div {
                min-width: 0
            }

            .ba-full {
                grid-column: 1/-1
            }

            .ba-info dt {
                font-size: .68rem;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: .06em;
                color: var(--muted);
                margin-bottom: .4rem
            }

            .ba-info dd {
                font-size: .95rem;
                color: var(--soft);
                display: flex;
                align-items: center;
                gap: .45rem;
                word-break: break-word
            }

            .ba-info dd i {
                color: var(--muted)
            }

            .ba-strong {
                font-weight: 700;
                color: var(--pri) !important
            }

            .ba-semibold {
                font-weight: 600;
                color: var(--ink) !important
            }

            .ba-amount {
                font-size: 1.7rem !important;
                font-weight: 700;
                color: var(--ok) !important
            }

            .ba-chip {
                display: inline-block;
                padding: .25rem .85rem;
                background: var(--pri-s);
                color: var(--pri);
                border-radius: 12px;
                font-size: .78rem;
                font-weight: 600
            }

            .ba-chip--pill {
                border-radius: 20px
            }

            .ba-badge {
                display: inline-flex;
                align-items: center;
                gap: .3rem;
                padding: .3rem .85rem;
                border-radius: 20px;
                font-size: .68rem;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: .03em;
                white-space: nowrap
            }

            .ba-badge--pending {
                background: rgba(245, 158, 11, .14);
                color: #92400e
            }

            .ba-badge--approved {
                background: rgba(16, 185, 129, .14);
                color: #065f46
            }

            .ba-badge--rejected {
                background: rgba(239, 68, 68, .14);
                color: #991b1b
            }

            .ba-badge--info {
                background: var(--pri-s);
                color: var(--pri)
            }

            .ba-box {
                display: block !important;
                background: var(--bg);
                border-left: 3px solid var(--pri);
                border-radius: 10px;
                padding: 1rem 1.1rem;
                color: var(--soft);
                line-height: 1.7
            }

            /* Show more / less: unique class names + !important so global CSS can't override them */
            .ba-clamp {
                position: relative;
                max-height: 96px;
                overflow: hidden;
                white-space: pre-line;
                overflow-wrap: anywhere
            }

            .ba-clamp--sm {
                max-height: 120px
            }

            .ba-clamp:not(.ba-expanded)::after {
                content: '';
                position: absolute;
                inset: auto 0 0 0;
                height: 48px;
                background: linear-gradient(transparent, var(--bg));
                pointer-events: none
            }

            .ba-clamp.ba-expanded {
                max-height: none !important;
                overflow: visible !important
            }

            .ba-clamp.ba-expanded::after {
                display: none
            }

            .ba-more {
                background: none;
                border: 0;
                padding: .6rem 0 0;
                color: var(--pri);
                font: inherit;
                font-weight: 600;
                font-size: .82rem;
                cursor: pointer;
                display: inline-flex;
                align-items: center;
                gap: .4rem
            }

            .ba-more[hidden] {
                display: none
            }

            .ba-more i {
                font-size: .7rem;
                transition: transform .2s
            }

            .ba-more.is-open i {
                transform: rotate(180deg)
            }

            .ba-person {
                gap: .75rem !important
            }

            .ba-person b {
                display: block;
                color: var(--ink)
            }

            .ba-person small {
                color: var(--muted);
                font-size: .8rem
            }

            .ba-avatar {
                width: 46px;
                height: 46px;
                border-radius: 50%;
                background: linear-gradient(135deg, #4a6cf7, #6a4cf7);
                color: #fff;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                font-weight: 600;
                flex-shrink: 0
            }

            .ba-avatar--lg {
                width: 76px;
                height: 76px;
                font-size: 1.9rem
            }

            .ba-profile {
                display: flex;
                gap: 1.25rem;
                align-items: center;
                padding-bottom: 1.25rem;
                border-bottom: 1px solid var(--line)
            }

            .ba-profile h2 {
                font-size: 1.3rem;
                font-weight: 700
            }

            .ba-muted {
                color: var(--muted)
            }

            .ba-meta {
                display: flex;
                flex-wrap: wrap;
                gap: .5rem 1.25rem;
                margin-top: .5rem;
                font-size: .82rem;
                color: var(--soft)
            }

            .ba-meta i {
                color: var(--muted);
                margin-right: .25rem
            }

            .ba-tabs {
                display: flex;
                flex-wrap: wrap;
                gap: .25rem;
                border-bottom: 2px solid var(--line);
                margin-top: 1.25rem
            }

            .ba-tab {
                padding: .6rem 1.1rem;
                border: 0;
                background: none;
                font: inherit;
                font-size: .85rem;
                font-weight: 600;
                color: var(--muted);
                cursor: pointer;
                border-bottom: 2px solid transparent;
                margin-bottom: -2px
            }

            .ba-tab:hover {
                color: var(--pri)
            }

            .ba-tab.is-active {
                color: var(--pri);
                border-bottom-color: var(--pri)
            }

            .ba-pane {
                display: none;
                padding-top: 1.25rem
            }

            .ba-pane.is-active {
                display: block
            }

            .ba-pane h5 {
                font-size: .9rem;
                font-weight: 600;
                margin: 1.25rem 0 .7rem;
                display: flex;
                align-items: center;
                gap: .5rem
            }

            .ba-pane h5:first-child {
                margin-top: 0
            }

            .ba-pane h5 i {
                color: var(--pri)
            }

            .ba-contact {
                display: flex;
                flex-direction: column;
                gap: .6rem;
                color: var(--soft)
            }

            .ba-contact i {
                width: 20px;
                color: var(--pri)
            }

            .ba-tags,
            .ba-links {
                display: flex;
                flex-wrap: wrap;
                gap: .6rem
            }

            .ba-empty {
                text-align: center;
                color: var(--muted);
                padding: 1.5rem 0
            }

            .ba-timeline {
                position: relative
            }

            .ba-timeline li {
                position: relative;
                padding-left: 56px;
                margin-bottom: 1.25rem
            }

            .ba-timeline li:last-child {
                margin-bottom: 0
            }

            .ba-timeline li:not(:last-child)::before {
                content: '';
                position: absolute;
                left: 19px;
                top: 40px;
                bottom: -20px;
                width: 2px;
                background: var(--line)
            }

            .ba-dot {
                position: absolute;
                left: 0;
                top: 0;
                width: 40px;
                height: 40px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #fff
            }

            .ba-dot--approved {
                background: var(--ok)
            }

            .ba-dot--rejected {
                background: var(--bad)
            }

            .ba-dot--pending {
                background: var(--warn)
            }

            .ba-row {
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                gap: .6rem
            }

            .ba-right {
                margin-left: auto
            }

            .ba-comment {
                margin-top: .6rem;
                padding-top: .6rem;
                border-top: 1px solid var(--line);
                font-size: .83rem;
                color: var(--muted)
            }

            .ba-field {
                display: flex;
                flex-direction: column;
                gap: .35rem;
                margin-bottom: 1.1rem
            }

            .ba-field label {
                font-size: .78rem;
                font-weight: 600;
                color: var(--soft)
            }

            .ba-field input,
            .ba-field textarea {
                width: 100%;
                border: 1px solid var(--line);
                border-radius: 10px;
                padding: .65rem .9rem;
                font: inherit;
                font-size: .87rem;
                color: var(--ink);
                background: #fff;
                resize: vertical
            }

            .ba-field input[readonly] {
                background: var(--bg);
                color: var(--soft)
            }

            .ba-field input:focus,
            .ba-field textarea:focus {
                outline: 0;
                border-color: var(--pri);
                box-shadow: 0 0 0 3px var(--pri-s)
            }

            .ba-error {
                font-size: .75rem;
                color: var(--bad)
            }

            .ba-btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: .5rem;
                font: inherit;
                font-size: .85rem;
                font-weight: 600;
                line-height: 1;
                padding: .7rem 1.3rem;
                border-radius: 10px;
                border: 1px solid transparent;
                cursor: pointer;
                text-decoration: none;
                transition: .15s
            }

            .ba-btn--primary {
                background: var(--pri);
                color: #fff
            }

            .ba-btn--primary:hover {
                background: var(--pri-d);
                color: #fff
            }

            .ba-btn--success {
                background: var(--ok);
                color: #fff
            }

            .ba-btn--success:hover {
                background: var(--ok-d)
            }

            .ba-btn--danger {
                background: var(--bad);
                color: #fff
            }

            .ba-btn--danger:hover {
                background: var(--bad-d)
            }

            .ba-btn--outline {
                background: #fff;
                color: var(--pri);
                border-color: var(--line)
            }

            .ba-btn--outline:hover {
                background: var(--pri-s);
                border-color: var(--pri)
            }

            .ba-actions {
                display: flex;
                flex-direction: column;
                gap: .7rem
            }

            .ba-actions .ba-btn {
                width: 100%
            }

            @media(max-width:992px) {
                .ba-grid {
                    grid-template-columns: 1fr
                }
            }

            @media(max-width:640px) {
                .ba-page {
                    padding: 1rem
                }

                .ba-info {
                    grid-template-columns: 1fr
                }

                .ba-profile {
                    flex-direction: column;
                    text-align: center
                }

                .ba-meta {
                    justify-content: center
                }
            }

            @media print {

                .ba-back,
                .ba-tabs,
                .ba-actions,
                .ba-more {
                    display: none !important
                }

                .ba-pane {
                    display: block !important
                }

                .ba-clamp {
                    max-height: none !important;
                    overflow: visible !important
                }

                .ba-clamp::after {
                    display: none !important
                }
            }
        </style>
    @endpush

    {{-- Inline script (NOT @push) so it runs even if the layout has no @stack('scripts') --}}
    <script>
        (function() {
            // Tabs (event delegation, works immediately)
            document.addEventListener('click', function(e) {
                var tab = e.target.closest('.ba-tab');
                if (!tab) return;
                document.querySelectorAll('.ba-tab, .ba-pane').forEach(function(el) {
                    el.classList.remove('is-active');
                });
                tab.classList.add('is-active');
                var pane = document.getElementById('pane-' + tab.getAttribute('data-tab'));
                if (pane) pane.classList.add('is-active');
            });

            // Approval form
            var form = document.getElementById('approvalForm');
            if (!form) return;

            var defaults = {
                accepted: 'Your proposal looks good, and your skills match our project requirements. We would like to proceed with your bid. We will contact you shortly to discuss the next steps.',
                rejected: 'Thank you for your proposal. Unfortunately, we have decided not to proceed with your bid for this project. We appreciate your interest and wish you the best.'
            };
            var comments = document.getElementById('comments');

            form.addEventListener('submit', function(e) {
                var action = e.submitter ? e.submitter.value : null;
                var text = comments.value.trim();
                var msg = action === 'rejected' ?
                    'Are you sure you want to REJECT this bid? This cannot be undone.' :
                    'Are you sure you want to ACCEPT this bid?';

                if (!confirm(msg)) return e.preventDefault();

                // Only swap in the default text if the approver hasn't written their own
                if (!text || Object.values(defaults).indexOf(text) !== -1) {
                    comments.value = defaults[action] || text;
                }
            });
        })();
    </script>
@endsection
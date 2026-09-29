{{-- resources/views/admin/freelancer/bid/bid_approval.blade.php --}}
@extends('admin.layout.app')

@section('title', 'Bid Approval #' . ($bid->bid_number ?? $bid->id))

@section('page-title', 'Bid Approval')
@section('page-subtitle', '#' . ($bid->bid_number ?? $bid->id))

@section('content')
    <div class="bid-approval-page">

        {{-- Back Button --}}
        <div class="back-row">
            <a href="{{ route('employer.freelancer.bids.project', $bid->project->id) }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Bids</span>
            </a>
        </div>

        {{-- Approval Status Banner --}}
        @if ($bid->status === 'pending')
            <div class="notice notice--warning">
                <div class="notice__icon"><i class="fas fa-clock"></i></div>
                <div>
                    <h6>Pending Approval</h6>
                    <p>This bid is awaiting review by the approval committee. Please review the details below and take
                        action.</p>
                </div>
            </div>
        @elseif($bid->status === 'approved')
            <div class="notice notice--success">
                <div class="notice__icon"><i class="fas fa-check-circle"></i></div>
                <div>
                    <h6>Approved</h6>
                    <p>This bid was approved on
                        {{ $bid->approved_at?->format('M d, Y H:i') ?? $bid->updated_at->format('M d, Y H:i') }}.</p>
                </div>
            </div>
        @elseif($bid->status === 'rejected')
            <div class="notice notice--danger">
                <div class="notice__icon"><i class="fas fa-times-circle"></i></div>
                <div>
                    <h6>Rejected</h6>
                    <p>This bid has been rejected and cannot be modified.</p>
                </div>
            </div>
        @endif

        <div class="layout-grid">
            {{-- Main Content --}}
            <div class="layout-main">

                {{-- Bid Details --}}
                <div class="panel">
                    <div class="panel-header">
                        <h6><i class="fas fa-info-circle"></i> Bid Information</h6>
                        <span class="badge badge--{{ $bid->status }}">{{ ucfirst($bid->status) }}</span>
                    </div>
                    <div class="panel-body">
                        <div class="info-grid">
                            <div class="info-group">
                                <label>Bid Number</label>
                                <p class="info-value info-value--strong">#{{ $bid->bid_number ?? $bid->id }}</p>
                            </div>
                            <div class="info-group">
                                <label>Date Submitted</label>
                                <p class="info-value">
                                    <i class="far fa-calendar-alt"></i>
                                    {{ $bid->created_at->format('M d, Y H:i') }}
                                </p>
                            </div>
                            <div class="info-group">
                                <label>Project Title</label>
                                <p class="info-value info-value--semibold">{{ $bid->project->title ?? 'N/A' }}</p>
                            </div>
                            <div class="info-group">
                                <label>Category</label>
                                <p class="info-value">
                                    <span class="chip">{{ $bid->category ?? 'Uncategorized' }}</span>
                                </p>
                            </div>

                            {{-- Project Description with Read More --}}
                            <div class="info-group info-group--full">
                                <label>Project Description</label>
                                <div class="description-box">
                                    <div class="description-wrapper" id="projectDescription">
                                        @php
                                            $description = $bid->project->description ?? 'No description provided.';
                                            $isLong = strlen($description) > 250;
                                        @endphp

                                        <div class="description-inner">
                                            <div class="description-text {{ $isLong ? 'truncated' : '' }}"
                                                id="descriptionText">
                                                {{ $description }}
                                            </div>
                                        </div>

                                        @if ($isLong)
                                            <button class="read-more-btn"
                                                onclick="toggleDescription('projectDescription', 'descriptionText', 'readMoreBtn')"
                                                id="readMoreBtn">
                                                <span class="btn-text">Show More</span>
                                                <i class="fas fa-chevron-down btn-icon"></i>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="info-group">
                                <label>Bid Amount</label>
                                <p class="amount-display">₹{{ $bid->bid_amount }}</p>
                            </div>
                            <div class="info-group">
                                <label>Estimated Duration</label>
                                <p class="info-value">
                                    <i class="far fa-clock"></i>
                                    {{ $bid->estimated_days ?? 'Not specified' }}
                                </p>
                            </div>
                            <div class="info-group">
                                <label>Job Posted By</label>

                                <div class="person">
                                    <div class="avatar avatar--md">
                                        {{ strtoupper(substr($bid->employer->name ?? 'U', 0, 1)) }}
                                    </div>

                                    <div>
                                        <div class="person__name">
                                            {{ $bid->employer->name ?? 'Unknown' }}
                                        </div>

                                        <div class="person__meta">
                                            <i class="fas fa-envelope"></i>
                                            {{ $bid->employer->email ?? '' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- BIDDER PROFILE --}}
                <div class="panel panel--highlight">
                    <div class="panel-header">
                        <h6><i class="fas fa-user-circle"></i> Bidder Profile</h6>
                        @if ($bid->bidder->profile_verified ?? false)
                            <span class="badge badge--verified">
                                <i class="fas fa-check-circle"></i> Verified
                            </span>
                        @endif
                    </div>
                    <div class="panel-body">
                        <div class="bidder-profile">
                            {{-- Profile Header --}}
                            <div class="profile-header">
                                <div class="profile-avatar-wrapper">
                                    @if (isset($bid->bidder->avatar))
                                        <img src="{{ $bid->bidder->avatar }}" alt="{{ $bid->bidder->name ?? 'Bidder' }}"
                                            class="profile-avatar">
                                    @else
                                        <div class="avatar avatar--lg">
                                            {{ strtoupper(substr($bid->bidder->name ?? 'U', 0, 1)) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="profile-headline">
                                    <h2 class="profile-name">{{ $bid->freelancer->user->name ?? 'Unknown Bidder' }}</h2>
                                    <p class="profile-title">{{ $bid->freelancer->specialization ?? 'Freelancer' }}</p>
                                    <div class="profile-meta">
                                        <span class="meta-item">
                                            <i class="fas fa-phone"></i>
                                            {{ $bid->freelancer->user->phone ?? 'Phone not specified' }}
                                        </span>
                                        <span class="meta-item">
                                            <i class="fas fa-calendar-alt"></i>
                                            Member since {{ ($bid->freelancer->user->created_at ?? now())->format('M Y') }}
                                        </span>
                                        @if (isset($bid->bidder->rating))
                                            <span class="meta-item rating">
                                                <i class="fas fa-star"></i>
                                                {{ number_format($bid->bidder->rating, 1) }}
                                                <span class="rating-count">({{ $bid->bidder->review_count ?? 0 }}
                                                    reviews)</span>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- Profile Tabs --}}
                            <div class="profile-tabs">
                                <button class="tab-btn active" data-tab="bio">Bio & Skills</button>
                                <button class="tab-btn" data-tab="experience">Experience</button>
                                <button class="tab-btn" data-tab="portfolio">Portfolio</button>
                                <button class="tab-btn" data-tab="education">Resume</button>
                            </div>

                            {{-- Tab Content: Bio & Skills --}}
                            <div class="tab-content active" id="tab-bio">
                                <div class="profile-section">
                                    <h5><i class="fas fa-align-left"></i> About</h5>

                                    <div class="contact-details mt-3">
                                        <div class="contact-item">
                                            <i class="fas fa-envelope"></i>
                                            <span>
                                                {{ $bid->freelancer?->user?->email ?? 'No email provided.' }}
                                            </span>
                                        </div>

                                        <div class="contact-item">
                                            <i class="fas fa-phone"></i>
                                            <span>
                                                {{ $bid->freelancer?->user?->phone ?? 'No phone number provided.' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="profile-section">
                                    <h5>
                                        <i class="fas fa-tags"></i> Skills
                                    </h5>

                                    <div class="skills-container">
                                        @if (!empty($bid->freelancer?->skills))
                                            <span class="skill-tag">
                                                {{ $bid->freelancer->skills }}
                                            </span>
                                        @else
                                            <span class="text-muted">No skills listed.</span>
                                        @endif
                                    </div>
                                </div>
                                @if (isset($bid->bidder->languages) && count($bid->bidder->languages) > 0)
                                    <div class="profile-section">
                                        <h5><i class="fas fa-language"></i> Languages</h5>
                                        <div class="languages-list">
                                            @foreach ($bid->bidder->languages as $language)
                                                <span class="language-tag">
                                                    {{ $language['name'] ?? $language }}
                                                    @if (isset($language['proficiency']))
                                                        <span class="proficiency">({{ $language['proficiency'] }})</span>
                                                    @endif
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>

                            {{-- Tab Content: Experience --}}
                            <div class="tab-content" id="tab-experience">
                                @if (!empty($bid->freelancer?->experience))
                                    <div class="experience-item">
                                        <p class="exp-description">
                                            {{ $bid->freelancer->experience }} Years
                                        </p>
                                    </div>
                                @else
                                    <div class="empty-state">
                                        <p>No work experience listed.</p>
                                    </div>
                                @endif
                            </div>

                            {{-- Tab Content: Portfolio --}}
                            <div class="tab-content" id="tab-portfolio">
                                @if (!empty($bid->freelancer?->portfolio_link))
                                    <div class="portfolio-grid">
                                        <div class="portfolio-item">
                                            <div class="portfolio-info">
                                                <h6>Portfolio</h6>
                                                <a href="{{ $bid->freelancer->portfolio_link }}" target="_blank"
                                                    class="portfolio-link">
                                                    <i class="fas fa-external-link-alt"></i>
                                                    View Portfolio
                                                </a>
                                            </div>
                                            <div class="portfolio-info">
                                                <h6>GitHub</h6>
                                                <a href="{{ $bid->freelancer->github }}" target="_blank"
                                                    class="portfolio-link">
                                                    <i class="fas fa-external-link-alt"></i>
                                                    View GitHub
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="empty-state">
                                        <div class="empty-state__icon">
                                            <i class="fas fa-briefcase"></i>
                                        </div>
                                        <p>No portfolio available.</p>
                                    </div>
                                @endif
                            </div>

                            {{-- Tab Content: Education --}}
                            <div class="tab-content" id="tab-education">
                                @if (!empty($bid->freelancer?->resume))
                                    <div class="education-item">
                                        <h6>Resume</h6>
                                        <a href="{{ asset('storage/' . $bid->freelancer->resume) }}" target="_blank"
                                            class="portfolio-link">
                                            <i class="fas fa-file-pdf"></i>
                                            View Resume
                                        </a>
                                    </div>
                                @else
                                    <div class="empty-state">
                                        <p>No resume available.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SOCIAL & CONTACT LINKS --}}
                @if (isset($bid->bidder->social_links) && count($bid->bidder->social_links) > 0)
                    <div class="panel">
                        <div class="panel-header">
                            <h6><i class="fas fa-share-alt"></i> Social & Professional Links</h6>
                        </div>
                        <div class="panel-body">
                            <div class="social-links-grid">
                                @foreach ($bid->bidder->social_links as $platform => $url)
                                    <a href="{{ $url }}" target="_blank"
                                        class="social-link social-link--{{ $platform }}">
                                        <i class="fab fa-{{ $platform }}"></i>
                                        <span>{{ ucfirst($platform) }}</span>
                                    </a>
                                @endforeach

                                {{-- LinkedIn specific --}}
                                @if (isset($bid->bidder->linkedin_url))
                                    <a href="{{ $bid->bidder->linkedin_url }}" target="_blank"
                                        class="social-link social-link--linkedin">
                                        <i class="fab fa-linkedin-in"></i>
                                        <span>LinkedIn Profile</span>
                                    </a>
                                @endif

                                {{-- GitHub --}}
                                @if (isset($bid->bidder->github_url))
                                    <a href="{{ $bid->bidder->github_url }}" target="_blank"
                                        class="social-link social-link--github">
                                        <i class="fab fa-github"></i>
                                        <span>GitHub</span>
                                    </a>
                                @endif

                                {{-- Website / Portfolio --}}
                                @if (isset($bid->bidder->website))
                                    <a href="{{ $bid->bidder->website }}" target="_blank"
                                        class="social-link social-link--website">
                                        <i class="fas fa-globe"></i>
                                        <span>Portfolio Website</span>
                                    </a>
                                @endif

                                {{-- Dribbble --}}
                                @if (isset($bid->bidder->dribbble_url))
                                    <a href="{{ $bid->bidder->dribbble_url }}" target="_blank"
                                        class="social-link social-link--dribbble">
                                        <i class="fab fa-dribbble"></i>
                                        <span>Dribbble</span>
                                    </a>
                                @endif

                                {{-- Behance --}}
                                @if (isset($bid->bidder->behance_url))
                                    <a href="{{ $bid->bidder->behance_url }}" target="_blank"
                                        class="social-link social-link--behance">
                                        <i class="fab fa-behance"></i>
                                        <span>Behance</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                {{-- RESUME / CV --}}
                @if (isset($bid->bidder->resume_url) || isset($bid->bidder->resume))
                    <div class="panel">
                        <div class="panel-header">
                            <h6><i class="fas fa-file-pdf"></i> Resume / CV</h6>
                        </div>
                        <div class="panel-body">
                            <div class="resume-section">
                                @if (isset($bid->bidder->resume_url))
                                    <a href="{{ $bid->bidder->resume_url }}" target="_blank" class="btn btn-primary">
                                        <i class="fas fa-file-pdf"></i>
                                        <span>View Resume</span>
                                    </a>
                                    <a href="{{ $bid->bidder->resume_url }}" download class="btn btn-outline">
                                        <i class="fas fa-download"></i>
                                        <span>Download</span>
                                    </a>
                                @elseif(isset($bid->bidder->resume))
                                    <a href="{{ route('admin.bidder.resume.download', $bid->bidder->id) }}"
                                        class="btn btn-primary">
                                        <i class="fas fa-file-pdf"></i>
                                        <span>Download Resume</span>
                                    </a>
                                @endif
                                <span class="resume-file-info">
                                    <i class="far fa-file"></i>
                                    {{ $bid->bidder->resume_filename ?? 'Resume available for download' }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Approval Timeline --}}
                @if (isset($bid->approvals) && $bid->approvals->count() > 0)
                    <div class="panel">
                        <div class="panel-header">
                            <h6><i class="fas fa-history"></i> Approval Timeline</h6>
                        </div>
                        <div class="panel-body">
                            <div class="timeline">
                                @foreach ($bid->approvals as $approval)
                                    <div class="timeline-item">
                                        <div class="timeline-marker timeline-marker--{{ $approval->status }}">
                                            <i
                                                class="fas fa-{{ $approval->status === 'approved' ? 'check' : ($approval->status === 'rejected' ? 'times' : 'clock') }}"></i>
                                        </div>
                                        <div class="timeline-content">
                                            <div class="timeline-content__head">
                                                <div>
                                                    <h6>{{ $approval->approver->name ?? 'System' }}</h6>
                                                    <span
                                                        class="badge badge--{{ $approval->status }} badge--sm">{{ ucfirst($approval->status) }}</span>
                                                </div>
                                                <span class="timeline-date">
                                                    <i class="far fa-calendar-alt"></i>
                                                    {{ $approval->created_at->format('M d, Y H:i') }}
                                                </span>
                                            </div>
                                            @if ($approval->comments)
                                                <p class="timeline-comment">
                                                    <i class="fas fa-quote-left"></i>
                                                    {{ $approval->comments }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <div class="layout-side">

                {{-- COVER LETTER (Top - Moved to Sidebar) --}}
                <div class="panel">
                    <div class="panel-header">
                        <h6><i class="fas fa-envelope-open-text"></i> Cover Letter</h6>
                        <span class="badge badge--info">Bid Proposal</span>
                    </div>
                    <div class="panel-body">
                        @if ($bid->cover_letter)
                            @php
                                $coverLetter = $bid->cover_letter;
                                $isCoverLetterLong = strlen(strip_tags($coverLetter)) > 300;
                                $coverLetterId = 'coverLetter_' . uniqid();
                                $coverLetterTextId = 'coverLetterText_' . uniqid();
                                $coverLetterBtnId = 'coverLetterBtn_' . uniqid();
                            @endphp
                            <div class="cover-letter">
                                <div class="cover-letter-wrapper" id="{{ $coverLetterId }}">
                                    <div class="cover-letter-inner">
                                        <div class="cover-letter-content {{ $isCoverLetterLong ? 'truncated' : '' }}"
                                            id="{{ $coverLetterTextId }}">
                                            {!! nl2br(e($coverLetter)) !!}
                                        </div>
                                    </div>
                                    @if ($isCoverLetterLong)
                                        <button class="read-more-btn"
                                            onclick="toggleDescription('{{ $coverLetterId }}', '{{ $coverLetterTextId }}', '{{ $coverLetterBtnId }}')"
                                            id="{{ $coverLetterBtnId }}">
                                            <span class="btn-text">Show More</span>
                                            <i class="fas fa-chevron-down btn-icon"></i>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="empty-state empty-state--compact">
                                <div class="empty-state__icon"><i class="fas fa-file-alt"></i></div>
                                <p>No cover letter provided with this bid.</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Approval Actions --}}
                @if ($bid->status === 'pending')
                    <div class="panel panel--actions">
                        <div class="panel-header">
                            <h6><i class="fas fa-gavel"></i> Approval Actions</h6>
                        </div>
                        <div class="panel-body">
    <form action="{{ route('admin.freelancer.bids.approve', $bid->id) }}" method="POST"
        id="approvalForm">
        @csrf
        @method('PUT')

        <div class="field">
            <label for="approver_name">Approver Name</label>

            <input type="text"
                id="approver_name"
                name="approver_name"
                class="@error('approver_name') has-error @enderror"
                value="{{ old('approver_name', Auth::user()->name ?? '') }}"
                required
                readonly>

            @error('approver_name')
                <span class="field-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="field">
            <label for="comments">Comments / Notes</label>

            <textarea id="comments"
                name="comments"
                rows="6"
                class="@error('comments') has-error @enderror"
                placeholder="Add any additional comments or notes about this bid...">{{ old('comments', 'The employer will provide the required contract and will contact you directly to discuss the project details, finalize the terms, and proceed with the agreement.') }}</textarea>

            @error('comments')
                <span class="field-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="action-stack">

            {{-- Accept Bid --}}
            <button type="submit"
                name="action"
                value="accepted"
                class="btn btn-success btn-block"
                onclick="setApprovalComment('accepted')">
                <i class="fas fa-check-circle"></i>
                <span>Accept Bid</span>
            </button>

            {{-- Reject Bid --}}
            <button type="submit"
                name="action"
                value="rejected"
                class="btn btn-danger btn-block"
                onclick="setApprovalComment('rejected')">
                <i class="fas fa-times-circle"></i>
                <span>Reject Bid</span>
            </button>

        </div>
    </form>
</div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            /* ===== SHARED TOKENS ===== */
            .bid-approval-page {
                --ink: #1a1a2e;
                --ink-soft: #4a4a5a;
                --muted: #8a8fa8;
                --border: #eef2f7;
                --border-strong: #e9edf4;
                --surface: #ffffff;
                --surface-soft: #f8faff;
                --primary: #4a6cf7;
                --primary-dark: #3a5ce0;
                --primary-soft: rgba(74, 108, 247, 0.1);
                --success: #10b981;
                --success-dark: #0e9c71;
                --success-soft: rgba(16, 185, 129, 0.12);
                --warning: #f59e0b;
                --warning-soft: rgba(245, 158, 11, 0.12);
                --danger: #ef4444;
                --danger-dark: #dc3737;
                --danger-soft: rgba(239, 68, 68, 0.12);
                --radius: 12px;
                font-size: 0.9rem;
                color: var(--ink);
            }

            .bid-approval-page * {
                box-sizing: border-box;
            }

            .back-row {
                margin-bottom: 1.25rem;
            }

            /* ===== NOTICE BANNER ===== */
            .notice {
                display: flex;
                align-items: flex-start;
                gap: 1.1rem;
                padding: 1.1rem 1.4rem;
                border-radius: 14px;
                margin-bottom: 1.5rem;
            }

            .notice h6 {
                margin: 0 0 0.25rem;
                font-weight: 700;
                font-size: 0.95rem;
            }

            .notice p {
                margin: 0;
                font-size: 0.85rem;
                opacity: 0.9;
            }

            .notice__icon {
                width: 46px;
                height: 46px;
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.15rem;
                flex-shrink: 0;
            }

            .notice--warning {
                background: #fffbeb;
                border: 1px solid #fde68a;
                color: #92400e;
            }

            .notice--warning .notice__icon {
                background: var(--warning-soft);
                color: var(--warning);
            }

            .notice--success {
                background: #ecfdf5;
                border: 1px solid #a7f3d0;
                color: #065f46;
            }

            .notice--success .notice__icon {
                background: var(--success-soft);
                color: var(--success);
            }

            .notice--danger {
                background: #fef2f2;
                border: 1px solid #fecaca;
                color: #991b1b;
            }

            .notice--danger .notice__icon {
                background: var(--danger-soft);
                color: var(--danger);
            }

            /* ===== LAYOUT ===== */
            .layout-grid {
                display: grid;
                grid-template-columns: minmax(0, 2fr) minmax(280px, 1fr);
                gap: 1.5rem;
                align-items: start;
            }

            .layout-main,
            .layout-side {
                display: flex;
                flex-direction: column;
                gap: 1.5rem;
            }

            /* ===== PANELS ===== */
            .panel {
                background: var(--surface);
                border: 1px solid var(--border);
                border-radius: var(--radius);
                box-shadow: 0 1px 3px rgba(20, 20, 43, 0.04);
            }

            .panel--highlight {
                border-color: var(--primary);
                border-width: 2px;
                background: linear-gradient(to bottom, #ffffff, #fafcff);
            }

            .panel-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 1rem 1.5rem;
                border-bottom: 1px solid var(--border);
            }

            .panel-header h6 {
                margin: 0;
                font-size: 0.95rem;
                font-weight: 700;
                color: var(--primary);
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .panel-body {
                padding: 1.5rem;
            }

            .count-pill {
                background: var(--primary);
                color: #fff;
                font-size: 0.68rem;
                font-weight: 700;
                padding: 0.15rem 0.55rem;
                border-radius: 10px;
                margin-left: 0.35rem;
            }

            /* ===== INFO GRID ===== */
            .info-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 1.25rem 1.5rem;
            }

            .info-group--full {
                grid-column: 1 / -1;
            }

            .info-group label {
                display: block;
                font-size: 0.68rem;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.06em;
                color: var(--muted);
                margin-bottom: 0.3rem;
            }

            .info-value {
                margin: 0;
                font-size: 0.95rem;
                color: var(--ink-soft);
                display: flex;
                align-items: center;
                gap: 0.4rem;
            }

            .info-value--strong {
                font-weight: 700;
                color: var(--primary);
            }

            .info-value--semibold {
                font-weight: 600;
                color: var(--ink);
            }

            .info-value i {
                color: var(--muted);
            }

            .chip {
                display: inline-block;
                padding: 0.22rem 0.85rem;
                background: var(--primary-soft);
                color: var(--primary);
                border-radius: 12px;
                font-size: 0.78rem;
                font-weight: 600;
            }

            /* ===== DESCRIPTION BOX WITH READ MORE ===== */
            .description-box {
                background: var(--surface-soft);
                padding: 1rem 1.1rem;
                border-radius: 10px;
                font-size: 0.88rem;
                color: var(--ink-soft);
                border-left: 3px solid var(--primary);
                line-height: 1.6;
            }

            .description-wrapper {
                position: relative;
            }

            .description-inner {
                position: relative;
                overflow: hidden;
                transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .description-text {
                line-height: 1.7;
                color: var(--ink-soft);
                font-size: 0.92rem;
            }

            .description-text.truncated {
                max-height: 100px;
                overflow: hidden;
            }

            .description-text.truncated::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                height: 60px;
                background: linear-gradient(to bottom, transparent, var(--surface-soft));
                pointer-events: none;
            }

            .description-text.expanded {
                max-height: none;
            }

            .description-text.expanded::after {
                display: none;
            }

            /* ===== COVER LETTER WITH READ MORE (Sidebar) ===== */
            .cover-letter {
                background: var(--surface-soft);
                border-radius: 10px;
                padding: 1rem;
                border-left: 3px solid var(--primary);
            }

            .cover-letter-wrapper {
                position: relative;
            }

            .cover-letter-inner {
                position: relative;
                overflow: hidden;
                transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .cover-letter-content {
                font-size: 0.85rem;
                line-height: 1.7;
                color: var(--ink-soft);
                white-space: pre-wrap;
            }

            .cover-letter-content.truncated {
                max-height: 120px;
                overflow: hidden;
            }

            .cover-letter-content.truncated::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                height: 60px;
                background: linear-gradient(to bottom, transparent, var(--surface-soft));
                pointer-events: none;
            }

            .cover-letter-content.expanded {
                max-height: none;
            }

            .cover-letter-content.expanded::after {
                display: none;
            }

            /* ===== READ MORE BUTTON (Shared) ===== */
            .read-more-btn {
                background: none;
                border: none;
                color: var(--primary);
                font-weight: 600;
                font-size: 0.82rem;
                cursor: pointer;
                padding: 0.5rem 0 0;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                transition: all 0.2s ease;
                font-family: inherit;
                margin-top: 0.25rem;
            }

            .read-more-btn:hover {
                color: var(--primary-dark);
            }

            .read-more-btn .btn-icon {
                font-size: 0.7rem;
                transition: transform 0.3s ease;
            }

            .read-more-btn.expanded .btn-icon {
                transform: rotate(180deg);
            }

            .read-more-btn .btn-text {
                transition: all 0.2s ease;
            }

            .amount-display {
                font-size: 1.8rem;
                font-weight: 700;
                color: var(--success);
                margin: 0;
            }

            .amount-display--sm {
                font-size: 1.55rem;
            }

            /* ===== BIDDER PROFILE ===== */
            .bidder-profile {
                display: flex;
                flex-direction: column;
                gap: 1.5rem;
            }

            .profile-header {
                display: flex;
                gap: 1.5rem;
                align-items: flex-start;
                padding-bottom: 1.5rem;
                border-bottom: 1px solid var(--border);
            }

            .profile-avatar-wrapper {
                flex-shrink: 0;
            }

            .profile-avatar {
                width: 80px;
                height: 80px;
                border-radius: 50%;
                object-fit: cover;
                border: 3px solid var(--primary);
                box-shadow: 0 4px 16px rgba(74, 108, 247, 0.2);
            }

            .avatar--lg {
                width: 80px;
                height: 80px;
                font-size: 2rem;
                background: linear-gradient(135deg, #4a6cf7, #6a4cf7);
                border: 3px solid var(--primary);
                box-shadow: 0 4px 16px rgba(74, 108, 247, 0.2);
            }

            .profile-headline {
                flex: 1;
            }

            .profile-name {
                margin: 0;
                font-size: 1.35rem;
                font-weight: 700;
                color: var(--ink);
            }

            .profile-title {
                margin: 0.2rem 0 0.4rem;
                color: var(--muted);
                font-size: 0.9rem;
            }

            .profile-meta {
                display: flex;
                flex-wrap: wrap;
                gap: 1rem;
                font-size: 0.82rem;
                color: var(--ink-soft);
            }

            .meta-item {
                display: flex;
                align-items: center;
                gap: 0.35rem;
            }

            .meta-item i {
                color: var(--muted);
                width: 16px;
            }

            .meta-item.rating i {
                color: #f59e0b;
            }

            .rating-count {
                color: var(--muted);
                font-size: 0.75rem;
            }

            /* Profile Tabs */
            .profile-tabs {
                display: flex;
                gap: 0.5rem;
                border-bottom: 2px solid var(--border);
                padding-bottom: 0;
            }

            .tab-btn {
                padding: 0.6rem 1.2rem;
                border: none;
                background: none;
                font-weight: 600;
                color: var(--muted);
                cursor: pointer;
                border-bottom: 2px solid transparent;
                margin-bottom: -2px;
                transition: all 0.2s ease;
                font-size: 0.85rem;
            }

            .tab-btn:hover {
                color: var(--primary);
            }

            .tab-btn.active {
                color: var(--primary);
                border-bottom-color: var(--primary);
            }

            .tab-content {
                display: none;
                padding-top: 1.5rem;
            }

            .tab-content.active {
                display: block;
            }

            /* Profile Sections */
            .profile-section {
                margin-bottom: 1.5rem;
            }

            .profile-section:last-child {
                margin-bottom: 0;
            }

            .profile-section h5 {
                font-size: 0.9rem;
                font-weight: 600;
                color: var(--ink);
                margin: 0 0 0.7rem;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .profile-section h5 i {
                color: var(--primary);
            }

            .bio-text {
                color: var(--ink-soft);
                line-height: 1.7;
                font-size: 0.9rem;
            }

            .skills-container {
                display: flex;
                flex-wrap: wrap;
                gap: 0.5rem;
            }

            .skill-tag {
                padding: 0.3rem 0.9rem;
                background: var(--primary-soft);
                color: var(--primary);
                border-radius: 20px;
                font-size: 0.78rem;
                font-weight: 600;
            }

            .languages-list {
                display: flex;
                flex-wrap: wrap;
                gap: 0.5rem;
            }

            .language-tag {
                padding: 0.3rem 0.9rem;
                background: var(--surface-soft);
                border: 1px solid var(--border);
                border-radius: 20px;
                font-size: 0.78rem;
            }

            .proficiency {
                color: var(--muted);
                font-weight: 400;
            }

            /* Experience */
            .experience-item {
                padding: 1rem;
                background: var(--surface-soft);
                border-radius: 10px;
                margin-bottom: 0.75rem;
                border-left: 3px solid var(--primary);
            }

            .experience-item:last-child {
                margin-bottom: 0;
            }

            .exp-header {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
                flex-wrap: wrap;
                gap: 0.5rem;
            }

            .exp-header h6 {
                margin: 0;
                font-size: 0.95rem;
                font-weight: 600;
                color: var(--ink);
            }

            .exp-date {
                font-size: 0.75rem;
                color: var(--muted);
                white-space: nowrap;
            }

            .exp-company {
                margin: 0.2rem 0 0.3rem;
                font-weight: 500;
                color: var(--primary);
                font-size: 0.85rem;
            }

            .exp-description {
                margin: 0;
                font-size: 0.85rem;
                color: var(--ink-soft);
                line-height: 1.6;
            }

            /* Portfolio */
            .portfolio-grid {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }

            .portfolio-item {
                background: var(--surface-soft);
                border-radius: 10px;
                overflow: hidden;
                border: 1px solid var(--border);
                transition: all 0.2s ease;
            }

            .portfolio-item:hover {
                transform: translateY(-3px);
                box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
            }

            .portfolio-thumb {
                width: 100%;
                height: 140px;
                object-fit: cover;
            }

            .portfolio-placeholder {
                width: 100%;
                height: 140px;
                background: var(--surface-soft);
                display: flex;
                align-items: center;
                justify-content: center;
                color: var(--muted);
                font-size: 2rem;
            }

            .portfolio-info {
                padding: 0.8rem 1rem;
            }

            .portfolio-info h6 {
                margin: 0 0 0.2rem;
                font-size: 0.85rem;
                font-weight: 600;
            }

            .portfolio-info p {
                margin: 0 0 0.5rem;
                font-size: 0.78rem;
                color: var(--muted);
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            .portfolio-link {
                font-size: 0.75rem;
                color: var(--primary);
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                gap: 0.3rem;
            }

            .portfolio-link:hover {
                text-decoration: underline;
            }

            /* Education */
            .education-item {
                padding: 1rem;
                background: var(--surface-soft);
                border-radius: 10px;
                margin-bottom: 0.75rem;
                border-left: 3px solid var(--warning);
            }

            .education-item:last-child {
                margin-bottom: 0;
            }

            .education-item h6 {
                margin: 0;
                font-size: 0.95rem;
                font-weight: 600;
                color: var(--ink);
            }

            .edu-school {
                margin: 0.1rem 0 0.2rem;
                font-weight: 500;
                color: var(--ink-soft);
                font-size: 0.85rem;
            }

            .edu-date {
                font-size: 0.75rem;
                color: var(--muted);
                margin: 0 0 0.3rem;
            }

            .edu-description {
                margin: 0;
                font-size: 0.85rem;
                color: var(--ink-soft);
            }

            /* ===== SOCIAL LINKS ===== */
            .social-links-grid {
                display: flex;
                flex-wrap: wrap;
                gap: 0.75rem;
            }

            .social-link {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                padding: 0.5rem 1rem;
                border-radius: 10px;
                text-decoration: none;
                font-size: 0.85rem;
                font-weight: 500;
                border: 1px solid var(--border);
                background: var(--surface);
                color: var(--ink-soft);
                transition: all 0.2s ease;
            }

            .social-link:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            }

            .social-link i {
                font-size: 1rem;
            }

            .social-link--linkedin {
                border-color: #0077b5;
                color: #0077b5;
            }

            .social-link--linkedin:hover {
                background: #0077b5;
                color: #fff;
            }

            .social-link--github {
                border-color: #333;
                color: #333;
            }

            .social-link--github:hover {
                background: #333;
                color: #fff;
            }

            .social-link--website {
                border-color: var(--primary);
                color: var(--primary);
            }

            .social-link--website:hover {
                background: var(--primary);
                color: #fff;
            }

            .social-link--dribbble {
                border-color: #ea4c89;
                color: #ea4c89;
            }

            .social-link--dribbble:hover {
                background: #ea4c89;
                color: #fff;
            }

            .social-link--behance {
                border-color: #1769ff;
                color: #1769ff;
            }

            .social-link--behance:hover {
                background: #1769ff;
                color: #fff;
            }

            /* ===== RESUME ===== */
            .resume-section {
                display: flex;
                align-items: center;
                gap: 1rem;
                flex-wrap: wrap;
            }

            .resume-file-info {
                font-size: 0.85rem;
                color: var(--muted);
                display: flex;
                align-items: center;
                gap: 0.4rem;
            }

            /* ===== QUICK STATS ===== */
            .stat-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 0.75rem;
            }

            .stat-item {
                text-align: center;
                padding: 0.75rem;
                background: var(--surface-soft);
                border-radius: 8px;
            }

            .stat-label {
                display: block;
                font-size: 0.65rem;
                text-transform: uppercase;
                letter-spacing: 0.06em;
                color: var(--muted);
                font-weight: 600;
            }

            .stat-value {
                display: block;
                font-size: 1.4rem;
                font-weight: 700;
                color: var(--ink);
                margin-top: 0.1rem;
            }

            .stat-value .text-warning {
                color: #f59e0b;
            }

            /* ===== BADGES ===== */
            .badge {
                display: inline-flex;
                align-items: center;
                gap: 0.3rem;
                padding: 0.35rem 1rem;
                border-radius: 20px;
                font-size: 0.7rem;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.03em;
                white-space: nowrap;
            }

            .badge--sm {
                padding: 0.15rem 0.65rem;
                font-size: 0.62rem;
            }

            .badge--pending {
                background: var(--warning-soft);
                color: #92400e;
            }

            .badge--approved {
                background: var(--success-soft);
                color: #065f46;
            }

            .badge--rejected {
                background: var(--danger-soft);
                color: #991b1b;
            }

            .badge--info {
                background: var(--primary-soft);
                color: var(--primary);
            }

            .badge--verified {
                background: var(--success-soft);
                color: #065f46;
            }

            /* ===== PERSON / AVATAR ===== */
            .person {
                display: flex;
                align-items: center;
                gap: 0.75rem;
            }

            .avatar {
                border-radius: 50%;
                background: linear-gradient(135deg, #4a6cf7, #6a4cf7);
                color: #fff;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 600;
                flex-shrink: 0;
                box-shadow: 0 4px 12px rgba(74, 108, 247, 0.3);
            }

            .avatar--md {
                width: 46px;
                height: 46px;
                font-size: 0.95rem;
            }

            .person__name {
                font-weight: 600;
                color: var(--ink);
            }

            .person__meta {
                font-size: 0.8rem;
                color: var(--muted);
                display: flex;
                align-items: center;
                gap: 0.3rem;
            }

            /* ===== DOCUMENTS ===== */
            .documents-grid {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 0.9rem;
            }

            .document-card {
                display: flex;
                align-items: center;
                gap: 1rem;
                padding: 0.85rem 1rem;
                background: var(--surface-soft);
                border-radius: 12px;
                border: 1px solid var(--border);
                transition: all 0.18s ease;
            }

            .document-card:hover {
                background: #f0f4ff;
                border-color: #d6e0f5;
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(74, 108, 247, 0.08);
            }

            .document-icon {
                width: 42px;
                height: 42px;
                border-radius: 10px;
                background: var(--primary-soft);
                display: flex;
                align-items: center;
                justify-content: center;
                color: var(--primary);
                font-size: 1.1rem;
                flex-shrink: 0;
            }

            .document-info {
                flex: 1;
                min-width: 0;
            }

            .document-name {
                font-size: 0.85rem;
                font-weight: 600;
                color: var(--ink);
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .document-meta {
                font-size: 0.72rem;
                color: var(--muted);
                display: flex;
                align-items: center;
                gap: 0.35rem;
                margin-top: 0.15rem;
            }

            .dot {
                color: var(--border-strong);
            }

            /* ===== TIMELINE ===== */
            .timeline {
                position: relative;
            }

            .timeline-item {
                position: relative;
                padding-left: 60px;
                margin-bottom: 1.5rem;
            }

            .timeline-item:last-child {
                margin-bottom: 0;
            }

            .timeline-item::before {
                content: '';
                position: absolute;
                left: 22px;
                top: 32px;
                bottom: -12px;
                width: 2px;
                background: var(--border-strong);
            }

            .timeline-item:last-child::before {
                display: none;
            }

            .timeline-marker {
                position: absolute;
                left: 0;
                top: 2px;
                width: 44px;
                height: 44px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #fff;
                font-size: 1rem;
                z-index: 1;
            }

            .timeline-marker--approved {
                background: var(--success);
                box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
            }

            .timeline-marker--rejected {
                background: var(--danger);
                box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
            }

            .timeline-marker--pending {
                background: var(--warning);
                box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
            }

            .timeline-content {
                background: var(--surface-soft);
                padding: 1rem 1.25rem;
                border-radius: 12px;
                border-left: 3px solid var(--border-strong);
                transition: background 0.18s ease;
            }

            .timeline-content:hover {
                background: #f0f4ff;
            }

            .timeline-content__head {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
                flex-wrap: wrap;
                gap: 0.5rem;
            }

            .timeline-content h6 {
                margin: 0 0 0.3rem;
                font-size: 0.9rem;
                font-weight: 600;
                color: var(--ink);
            }

            .timeline-date {
                font-size: 0.78rem;
                color: var(--muted);
                display: flex;
                align-items: center;
                gap: 0.3rem;
                white-space: nowrap;
            }

            .timeline-comment {
                margin: 0.6rem 0 0;
                padding-top: 0.6rem;
                border-top: 1px solid var(--border-strong);
                font-size: 0.82rem;
                color: var(--muted);
                display: flex;
                gap: 0.4rem;
            }

            /* ===== FORM ===== */
            .field {
                margin-bottom: 1.1rem;
                display: flex;
                flex-direction: column;
                gap: 0.35rem;
            }

            .field label {
                font-size: 0.78rem;
                font-weight: 600;
                color: var(--ink-soft);
            }

            .field input,
            .field textarea {
                border: 1px solid var(--border-strong);
                border-radius: 10px;
                padding: 0.65rem 0.9rem;
                font-size: 0.87rem;
                font-family: inherit;
                color: var(--ink);
                background: var(--surface);
                resize: vertical;
                transition: border-color 0.15s ease, box-shadow 0.15s ease;
            }

            .field input:focus,
            .field textarea:focus {
                outline: none;
                border-color: var(--primary);
                box-shadow: 0 0 0 3px var(--primary-soft);
            }

            .field input.has-error,
            .field textarea.has-error {
                border-color: var(--danger);
            }

            .field-error {
                font-size: 0.75rem;
                color: var(--danger);
            }

            /* ===== SUMMARY ===== */
            .summary-item {
                margin-bottom: 0.4rem;
            }

            .summary-item label {
                display: block;
                font-size: 0.68rem;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.06em;
                color: var(--muted);
                margin-bottom: 0.2rem;
            }

            .summary-item p {
                margin: 0;
                font-size: 0.92rem;
            }

            .summary-strong {
                font-weight: 600;
                color: var(--ink);
                display: flex;
                align-items: center;
                gap: 0.4rem;
            }

            .summary-muted {
                color: var(--muted);
                font-size: 0.82rem;
                display: flex;
                align-items: center;
                gap: 0.35rem;
            }

            .panel-body hr {
                border: none;
                border-top: 1px solid var(--border);
                margin: 1rem 0;
            }

            /* ===== BUTTONS ===== */
            .btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 0.5rem;
                font-family: inherit;
                font-size: 0.85rem;
                font-weight: 600;
                border-radius: 10px;
                padding: 0.7rem 1.4rem;
                border: 1px solid transparent;
                cursor: pointer;
                text-decoration: none;
                transition: all 0.15s ease;
                line-height: 1;
            }

            .btn-block {
                width: 100%;
            }

            .btn-sm {
                padding: 0.45rem 0.8rem;
                font-size: 0.78rem;
            }

            .btn-icon-only {
                padding: 0.5rem 0.7rem;
            }

            .btn-primary {
                background: var(--primary);
                color: #fff;
                box-shadow: 0 2px 8px rgba(74, 108, 247, 0.3);
            }

            .btn-primary:hover {
                background: var(--primary-dark);
            }

            .btn-success {
                background: var(--success);
                color: #fff;
                box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
            }

            .btn-success:hover {
                background: var(--success-dark);
            }

            .btn-danger {
                background: var(--danger);
                color: #fff;
                box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
            }

            .btn-danger:hover {
                background: var(--danger-dark);
            }

            .btn-outline {
                background: var(--surface);
                color: var(--primary);
                border-color: var(--border-strong);
            }

            .btn-outline:hover {
                background: var(--primary-soft);
                border-color: var(--primary);
            }

            .action-stack {
                display: flex;
                flex-direction: column;
                gap: 0.75rem;
            }

            /* ===== EMPTY STATE ===== */
            .empty-state {
                text-align: center;
                padding: 2.5rem 1rem;
            }

            .empty-state--compact {
                padding: 1rem;
            }

            .empty-state__icon {
                width: 64px;
                height: 64px;
                margin: 0 auto 0.75rem;
                border-radius: 50%;
                background: var(--surface-soft);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.6rem;
                color: var(--muted);
            }

            .empty-state p {
                margin: 0;
                color: var(--muted);
                font-size: 0.85rem;
            }

            .contact-details {
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            .contact-item {
                display: flex;
                align-items: center;
                gap: 10px;
                color: #555;
                font-size: 14px;
            }

            .contact-item i {
                width: 18px;
                color: blue;
            }

            /* ===== RESPONSIVE ===== */
            @media (max-width: 992px) {
                .layout-grid {
                    grid-template-columns: 1fr;
                }

                .info-grid {
                    grid-template-columns: 1fr;
                }

                .documents-grid {
                    grid-template-columns: 1fr;
                }

                .portfolio-grid {
                    grid-template-columns: 1fr;
                }

                .stat-grid {
                    grid-template-columns: 1fr 1fr;
                }
            }

            @media (max-width: 640px) {
                .amount-display {
                    font-size: 1.4rem;
                }

                .timeline-item {
                    padding-left: 50px;
                }

                .timeline-marker {
                    width: 36px;
                    height: 36px;
                    font-size: 0.8rem;
                }

                .timeline-item::before {
                    left: 16px;
                }

                .profile-header {
                    flex-direction: column;
                    align-items: center;
                    text-align: center;
                }

                .profile-meta {
                    justify-content: center;
                }

                .profile-tabs {
                    flex-wrap: wrap;
                }

                .tab-btn {
                    font-size: 0.75rem;
                    padding: 0.4rem 0.8rem;
                }

                .stat-grid {
                    grid-template-columns: 1fr 1fr;
                }

                .social-links-grid {
                    justify-content: center;
                }

                .resume-section {
                    flex-direction: column;
                    align-items: stretch;
                }

                .resume-section .btn {
                    justify-content: center;
                }
            }

            @media print {

                .back-row,
                .panel-header,
                .action-stack,
                .profile-tabs {
                    display: none !important;
                }

                .tab-content {
                    display: block !important;
                }

                .panel--highlight {
                    border-color: #ddd;
                }

                .read-more-btn {
                    display: none !important;
                }

                .description-text.truncated,
                .cover-letter-content.truncated {
                    max-height: none !important;
                    overflow: visible !important;
                }

                .description-text.truncated::after,
                .cover-letter-content.truncated::after {
                    display: none !important;
                }
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Tab switching
                const tabBtns = document.querySelectorAll('.tab-btn');
                const tabContents = document.querySelectorAll('.tab-content');

                tabBtns.forEach(btn => {
                    btn.addEventListener('click', function() {
                        const tabId = this.dataset.tab;

                        // Remove active class from all tabs
                        tabBtns.forEach(b => b.classList.remove('active'));
                        tabContents.forEach(c => c.classList.remove('active'));

                        // Add active class to clicked tab
                        this.classList.add('active');
                        document.getElementById('tab-' + tabId).classList.add('active');
                    });
                });

                // Approval form
                const approvalForm = document.getElementById('approvalForm');

                if (approvalForm) {
                    approvalForm.addEventListener('submit', function(e) {
                        const action = e.submitter?.value;

                        if (action === 'reject') {
                            if (!confirm(
                                    'Are you sure you want to REJECT this bid? This action cannot be undone.'
                                )) {
                                e.preventDefault();
                                return false;
                            }
                        } else if (action === 'accepted') {
                            if (!confirm('Are you sure you want to APPROVE this bid?')) {
                                e.preventDefault();
                                return false;
                            }
                        }
                    });
                }
            });

            // Toggle description/cover letter with smooth animation
            function toggleDescription(wrapperId, textId, btnId) {
                const wrapper = document.getElementById(wrapperId);
                const text = document.getElementById(textId);
                const btn = document.getElementById(btnId);

                if (!wrapper || !text || !btn) return;

                // Check if we're expanding or collapsing
                const isExpanded = text.classList.contains('expanded');

                // Get the inner container (parent of text)
                const inner = text.parentElement;

                if (isExpanded) {
                    // Collapse
                    text.classList.remove('expanded');
                    text.classList.add('truncated');
                    btn.classList.remove('expanded');
                    btn.querySelector('.btn-text').textContent = 'Show More';

                    // Reset max-height to trigger animation
                    inner.style.maxHeight = inner.scrollHeight + 'px';

                    // Force reflow
                    void inner.offsetHeight;

                    // Set to truncated height (120px for sidebar cover letter)
                    const isCoverLetter = wrapperId.includes('coverLetter');
                    const truncatedHeight = isCoverLetter ? '120px' : '100px';
                    inner.style.maxHeight = truncatedHeight;
                } else {
                    // Expand
                    text.classList.remove('truncated');
                    text.classList.add('expanded');
                    btn.classList.add('expanded');
                    btn.querySelector('.btn-text').textContent = 'Show Less';

                    // Animate to full height
                    inner.style.maxHeight = inner.scrollHeight + 'px';
                }
            }

    function setApprovalComment(action) {
        const comments = document.getElementById('comments');

        if (action === 'accepted') {
            comments.value =
                'The employer will provide the required contract and will contact you directly to discuss the project details, finalize the terms, and proceed with the agreement.';
        }

        if (action === 'rejected') {
            comments.value =
                'Verification is not completed at this stage. The employer will contact you if the employee proceeds with the bid.';
        }
    }
</script>
    @endpush
@endsection

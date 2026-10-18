@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/freelancer/_work-styles.css') }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    /* ================= BASE & RESET ================= */
    .work-page {
        font-family: 'Inter', sans-serif;
        color: #111827;
        background-color: #f9fafb;
        min-height: 100vh;
        padding: 2rem 1rem;
    }

    .container {
        max-width: 1000px;
        margin: 0 auto;
    }

    /* ================= PAGE HEADING ================= */
    .page-heading {
        margin-bottom: 2rem;
    }

    .page-heading h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 0.25rem;
    }

    .page-heading p {
        font-size: 0.875rem;
        color: #6b7280;
    }

    /* ================= NAVIGATION ================= */
    .work-nav {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 2rem;
        overflow-x: auto;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid #e5e7eb;
    }

    .work-nav a {
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        font-weight: 500;
        color: #6b7280;
        text-decoration: none;
        border-radius: 9999px;
        transition: all 0.2s ease;
        white-space: nowrap;
    }

    .work-nav a:hover {
        background-color: #f3f4f6;
        color: #111827;
    }

    .work-nav a.active {
        background-color: #111827;
        color: #ffffff;
    }

    /* ================= ALERTS ================= */
    .alert-success {
        background-color: #ecfdf5;
        border: 1px solid #a7f3d0;
        color: #065f46;
        padding: 1rem;
        border-radius: 0.5rem;
        margin-bottom: 1.5rem;
        font-size: 0.875rem;
    }

    /* ================= SECTION TITLES ================= */
    .section-title {
        font-size: 1rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 1rem;
    }

    /* ================= CARD DESIGN (Matches Image) ================= */
    .job-card {
        background: #ffffff;
        border-radius: 1rem;
        padding: 1.5rem;
        margin-bottom: 1rem;
        border: 1px solid #f3f4f6;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.02);
        transition: box-shadow 0.2s ease;
    }

    .job-card:hover {
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
    }

    /* --- Header Row --- */
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 0.5rem;
    }

    .card-title-group {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .card-title {
        font-size: 1.125rem;
        font-weight: 700;
        color: #111827;
        margin: 0;
    }

    .badge-active {
        background-color: #e5e7eb;
        color: #4b5563;
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        padding: 0.25rem 0.6rem;
        border-radius: 9999px;
        letter-spacing: 0.025em;
    }

    .header-actions {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .badge-fixed {
        background-color: #e0e7ff;
        color: #3730a3;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.35rem 0.75rem;
        border-radius: 9999px;
    }

    .icon-btn {
        width: 2rem;
        height: 2rem;
        border-radius: 50%;
        border: 1px solid #e5e7eb;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: #6b7280;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .icon-btn:hover {
        border-color: #111827;
        color: #111827;
    }

    .icon-btn svg {
        width: 1rem;
        height: 1rem;
    }

    /* --- Company Info --- */
    .company-row {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-top: 0.75rem;
        margin-bottom: 0.25rem;
    }

    .company-logo {
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 0.5rem;
        object-fit: cover;
        background-color: #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        color: #6b7280;
        font-size: 0.875rem;
    }

    .company-name {
        font-size: 0.9rem;
        font-weight: 600;
        color: #111827;
    }

    /* --- Meta Details --- */
    .meta-row {
        font-size: 0.8rem;
        color: #6b7280;
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin-bottom: 0.5rem;
    }

    .meta-row strong {
        color: #374151;
        font-weight: 600;
    }

    .location-row {
        display: flex;
        align-items: center;
        gap: 0.35rem;
        font-size: 0.8rem;
        color: #2563eb;
        font-weight: 500;
        margin-bottom: 0.75rem;
    }

    .location-row svg {
        width: 1rem;
        height: 1rem;
    }

    /* --- Description --- */
    .card-description {
        font-size: 0.85rem;
        color: #4b5563;
        line-height: 1.5;
        margin-bottom: 1rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* --- Tags --- */
    .tags-row {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
    }

    .tag {
        background-color: #f3f4f6;
        color: #374151;
        font-size: 0.7rem;
        font-weight: 500;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
    }

    /* --- Footer --- */
    .card-footer {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        border-top: 1px solid #f3f4f6;
        padding-top: 1rem;
        gap: 1rem;
    }

    .footer-stats {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 1.25rem;
        font-size: 0.8rem;
        color: #6b7280;
    }

    .stat-budget {
        font-size: 1rem;
        font-weight: 700;
        color: #2563eb;
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 0.35rem;
    }

    .stat-item svg {
        width: 0.9rem;
        height: 0.9rem;
        color: #9ca3af;
    }

    .stat-bids strong {
        color: #111827;
    }

    .stat-bids .highlight {
        color: #16a34a;
        font-weight: 700;
    }

    /* --- Action Button --- */
    .btn-restore {
        background: white;
        border: 1px solid #e5e7eb;
        color: #374151;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.4rem 0.8rem;
        border-radius: 0.375rem;
        cursor: pointer;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
    }

    .btn-restore:hover {
        border-color: #2563eb;
        color: #2563eb;
    }

    /* ================= EMPTY STATE ================= */
    .empty-state {
        text-align: center;
        padding: 4rem 1rem;
        background: white;
        border-radius: 1rem;
        border: 1px solid #f3f4f6;
    }

    .empty-icon {
        font-size: 2rem;
        color: #9ca3af;
        margin-bottom: 1rem;
    }

    .empty-state h3 {
        font-size: 1rem;
        font-weight: 600;
        color: #111827;
        margin-bottom: 0.5rem;
    }

    .empty-state p {
        font-size: 0.875rem;
        color: #6b7280;
    }

    /* ================= PAGINATION ================= */
    .pagination-wrapper {
        margin-top: 2rem;
        display: flex;
        justify-content: center;
    }

    /* ================= PROPOSAL CARD OVERRIDES ================= */
    /* Ensure the included partial looks consistent with the new design */
    .job-card .status-badge {
        font-size: 0.65rem;
        padding: 0.25rem 0.6rem;
        border-radius: 9999px;
        text-transform: uppercase;
        font-weight: 700;
    }
    .job-card .status-approved { background: #dcfce7; color: #166534; }
    .job-card .status-pending { background: #fef3c7; color: #92400e; }
    .job-card .status-rejected { background: #fee2e2; color: #991b1b; }
    .job-card .status-closed { background: #e5e7eb; color: #374151; }
    .job-card .status-draft { background: #e0e7ff; color: #3730a3; }
</style>

<div class="container work-page">

    <div class="page-heading">
        <h1>Archived</h1>
        <p>Archived jobs, plus rejected, withdrawn, completed and cancelled projects.</p>
    </div>

    <div class="work-nav">
        <a href="{{ route('freelancer.saved-jobs') }}">Saved</a>
        <a href="{{ route('freelancer.applied') }}">Applied</a>
        <a href="{{ route('freelancer.proposals') }}">Proposals</a>
      
        <a href="{{ route('freelancer.in-progress') }}">In Progress</a>
        <a href="{{ route('freelancer.hired') }}">Hired</a>
        <a href="{{ route('freelancer.archived') }}" class="active">Archived</a>
    </div>

    @if (session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    {{-- ===== Manually archived jobs ===== --}}
    @if ($archivedJobs->isNotEmpty())
        <h4 class="section-title">Archived Jobs</h4>

        @foreach ($archivedJobs as $project)
            <div class="job-card">
                <div class="card-header">
                    <div class="card-title-group">
                        <h5 class="card-title">{{ $project->title }}</h5>
                        <!-- Static Active Badge to match image -->
                        <span class="badge-active">ACTIVE</span>
                    </div>
                    
                    <div class="header-actions">
                        <!-- Fixed Badge -->
                        @if($project->project_type)
                            <span class="badge-fixed">{{ ucfirst($project->project_type) }}</span>
                        @endif

                        <!-- Restore Action -->
                        <form action="{{ route('freelancer.unarchive-job', ['project' => $project->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="icon-btn" title="Restore Job">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="company-row">
                    <div class="company-logo">
                        {{ strtoupper(substr(optional(optional($project->employer)->employerRegistration)->company_name ?? 'C', 0, 1)) }}
                    </div>
                    <span class="company-name">
                        {{ optional(optional($project->employer)->employerRegistration)->company_name ?? 'Company Not Available' }}
                    </span>
                </div>

                <div class="meta-row">
                    <span>Contact Person: <strong>{{ optional($project->employer)->name ?? 'N/A' }}</strong></span>
                    <span>Posted: <strong>{{ $project->created_at->diffForHumans() }}</strong></span>
                </div>

                @if($project->work_mode)
                    <div class="location-row">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                        </svg>
                        {{ ucfirst($project->work_mode) }}
                    </div>
                @endif

                <div class="card-description">
                    {{ Str::limit($project->description, 160) }}
                </div>

                @if ($project->skills)
                    @php
                        $skillsList = is_array($project->skills) ? $project->skills : array_map('trim', explode(',', $project->skills));
                    @endphp
                    <div class="tags-row">
                        @foreach (array_slice($skillsList, 0, 5) as $skill)
                            <span class="tag">{{ $skill }}</span>
                        @endforeach
                        @if (count($skillsList) > 5)
                            <span class="tag">+{{ count($skillsList) - 5 }} more</span>
                        @endif
                    </div>
                @endif

                <div class="card-footer">
                    <div class="footer-stats">
                        <span class="stat-budget">{{ $project->budget }}</span>
                        
                        @if($project->duration)
                            <span class="stat-item">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="9" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7v5l3 3" />
                                </svg>
                                {{ $project->duration }}
                            </span>
                        @endif

                        @if($project->deadline)
                            <span class="stat-item">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ $project->deadline->format('M d, Y') }}
                            </span>
                        @endif

                        @php
                            $allocatedBids = (int) ($project->maximum_bids ?? 0);
                            $receivedBids = (int) ($project->freelancer_bids_count ?? 0);
                            $remainingBids = max(0, $allocatedBids - $receivedBids);
                        @endphp

                        <span class="stat-bids">
                            <strong>{{ $receivedBids }}</strong> Received • 
                            <span class="highlight">{{ $remainingBids }}</span> of <strong>{{ $allocatedBids }}</strong> Slots Remaining
                        </span>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    {{-- ===== Closed proposals ===== --}}
    @if ($proposals->isNotEmpty())
        <h4 class="section-title" style="margin-top: 2rem;">Closed Proposals</h4>

        @foreach ($proposals as $proposal)
            @include('freelancer.partials.work-card', ['item' => $proposal])
        @endforeach
    @endif

    @if ($archivedJobs->isEmpty() && $proposals->isEmpty())
        <div class="empty-state">
            <div class="empty-icon"><i class="bi bi-archive"></i></div>
            <h3>No Archived Projects</h3>
            <p>Archived jobs and rejected, withdrawn, completed or cancelled projects will appear here.</p>
        </div>
    @endif

    @if ($proposals->hasPages())
        <div class="pagination-wrapper">
            {{ $proposals->links() }}
        </div>
    @endif

</div>

@endsection
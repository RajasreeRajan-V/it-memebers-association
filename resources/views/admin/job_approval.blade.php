{{-- resources/views/admin/job_approval.blade.php --}}
@extends('admin.layout.app')

@section('title', 'Job Approvals')

@section('content')
<div class="job-approval-wrapper">

    <div class="page-header">
        <h1>Job Post Approvals</h1>
        <p>Review job posts submitted by employers before they go live.</p>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    <div class="filter-tabs">
        @foreach (['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected', 'all' => 'All'] as $value => $label)
            <a href="{{ route('admin.jobs.index', ['status' => $value]) }}"
               class="filter-tab {{ $status === $value ? 'active' : '' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>

    @if ($jobs->isEmpty())
        <div class="empty-state">
            <p>No {{ $status === 'all' ? '' : $status }} job posts to show.</p>
        </div>
    @else
        <div class="job-list">
            @foreach ($jobs as $job)
                <div class="job-card">
                    <div class="job-card-header">
                        <div>
                            <h2>{{ $job->title }}</h2>
                            <p class="job-meta">
                                {{ $job->employer->name ?? 'Unknown employer' }}
                                &middot; {{ ucfirst($job->employment_type) }}
                                &middot; {{ ucfirst($job->work_mode) }}
                            </p>
                        </div>
                        <span class="status-badge status-{{ $job->status }}">{{ ucfirst($job->status) }}</span>
                    </div>

                    <div class="job-card-body">
                        <div class="job-detail">
                            <span class="label">Location</span>
                            <span>{{ collect([$job->city, $job->district, $job->state, $job->country])->filter()->implode(', ') }}</span>
                        </div>
                        <div class="job-detail">
                            <span class="label">Experience</span>
                            <span>{{ $job->experience }}</span>
                        </div>
                        <div class="job-detail">
                            <span class="label">Salary</span>
                            <span>{{ $job->salary }}</span>
                        </div>
                        <div class="job-detail">
                            <span class="label">Qualification</span>
                            <span>{{ $job->qualification ?? '—' }}</span>
                        </div>
                        <div class="job-detail span-2">
                            <span class="label">Skills</span>
                            <span>{{ collect($job->skills)->implode(', ') }}</span>
                        </div>
                        <div class="job-detail span-2">
                            <span class="label">Description</span>
                            <p>{{ $job->description }}</p>
                        </div>

                        @if ($job->status === 'rejected' && $job->rejection_reason)
                            <div class="job-detail span-2">
                                <span class="label">Rejection Reason</span>
                                <p class="rejection-reason">{{ $job->rejection_reason }}</p>
                            </div>
                        @endif
                    </div>

                    @if ($job->status === 'pending')
                        <div class="job-card-actions">
                            <form action="{{ route('admin.jobs.approve', $job->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-approve">Approve</button>
                            </form>

                            <form action="{{ route('admin.jobs.reject', $job->id) }}" method="POST" class="reject-form">
                                @csrf
                                <input type="text" name="rejection_reason" placeholder="Reason for rejection (optional)">
                                <button type="submit" class="btn btn-reject">Reject</button>
                            </form>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="pagination-wrapper">
            {{ $jobs->links() }}
        </div>
    @endif

</div>

<style>
    .job-approval-wrapper {
        max-width: 900px;
        margin: 0 auto;
        padding: 32px 20px;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        color: #1f2937;
    }

    .page-header h1 {
        font-size: 1.6rem;
        font-weight: 600;
        margin: 0 0 4px;
        color: #111827;
    }

    .page-header p {
        font-size: 0.9rem;
        color: #6b7280;
        margin: 0 0 24px;
    }

    .alert {
        border-radius: 10px;
        padding: 12px 16px;
        margin-bottom: 20px;
        font-size: 0.875rem;
    }

    .alert-success {
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        color: #166534;
    }

    .alert-error {
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: #991b1b;
    }

    .filter-tabs {
        display: flex;
        gap: 8px;
        margin-bottom: 24px;
        border-bottom: 1px solid #e5e7eb;
    }

    .filter-tab {
        padding: 10px 14px;
        font-size: 0.85rem;
        font-weight: 500;
        color: #6b7280;
        text-decoration: none;
        border-bottom: 2px solid transparent;
    }

    .filter-tab.active {
        color: #4f46e5;
        border-bottom-color: #4f46e5;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #9ca3af;
        font-size: 0.9rem;
    }

    .job-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .job-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 20px;
    }

    .job-card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 16px;
    }

    .job-card-header h2 {
        font-size: 1.1rem;
        font-weight: 600;
        margin: 0 0 4px;
        color: #111827;
    }

    .job-meta {
        font-size: 0.8rem;
        color: #6b7280;
        margin: 0;
    }

    .status-badge {
        font-size: 0.75rem;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 999px;
        white-space: nowrap;
    }

    .status-pending { background: #fef9c3; color: #854d0e; }
    .status-approved { background: #dcfce7; color: #166534; }
    .status-rejected { background: #fee2e2; color: #991b1b; }

    .job-card-body {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
        padding-top: 14px;
        border-top: 1px solid #f3f4f6;
        margin-bottom: 6px;
    }

    .job-detail { display: flex; flex-direction: column; gap: 2px; }
    .job-detail .label {
        font-size: 0.75rem;
        font-weight: 600;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: 0.02em;
    }
    .job-detail span:not(.label), .job-detail p {
        font-size: 0.875rem;
        color: #374151;
        margin: 0;
    }
    .span-2 { grid-column: span 2; }

    .rejection-reason {
        color: #b91c1c !important;
    }

    .job-card-actions {
        display: flex;
        gap: 10px;
        align-items: center;
        padding-top: 16px;
        margin-top: 14px;
        border-top: 1px solid #f3f4f6;
        flex-wrap: wrap;
    }

    .reject-form {
        display: flex;
        gap: 8px;
        flex: 1;
        min-width: 220px;
    }

    .reject-form input {
        flex: 1;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        padding: 8px 10px;
        font-size: 0.85rem;
        font-family: inherit;
    }

    .btn {
        border: none;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 500;
        padding: 8px 16px;
        cursor: pointer;
        white-space: nowrap;
    }

    .btn-approve { background: #16a34a; color: #fff; }
    .btn-approve:hover { background: #15803d; }

    .btn-reject { background: #dc2626; color: #fff; }
    .btn-reject:hover { background: #b91c1c; }

    .pagination-wrapper { margin-top: 24px; }

    @media (max-width: 640px) {
        .job-card-body { grid-template-columns: 1fr; }
        .span-2 { grid-column: span 1; }
    }
</style>
@endsection
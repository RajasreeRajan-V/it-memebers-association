
<div class="job-detail-wrapper">
    <div class="job-detail-header">
        <div>
            <h1>{{ $job->title }}</h1>
            <div class="job-meta">
                <span class="meta-item">
                    <strong>Employment Type:</strong> {{ ucfirst($job->employment_type) }}
                </span>
                <span class="meta-item">
                    <strong>Work Mode:</strong> {{ ucfirst($job->work_mode) }}
                </span>
                <span class="meta-item">
                    <strong>Location:</strong> {{ $job->city }}, {{ $job->district }}, {{ $job->state }}
                </span>
                @if($job->country)
                    <span class="meta-item">
                        <strong>Country:</strong> {{ $job->country }}
                    </span>
                @endif
            </div>
        </div>
        <div class="job-actions-top">
            <a href="{{ route('employer.jobs.edit', $job->id) }}" class="btn btn-primary">Edit</a>
            <form action="{{ route('employer.jobs.destroy', $job->id) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        </div>
    </div>

    <div class="job-detail-body">
        <div class="job-info-grid">
            <div class="info-card">
                <h3>Status</h3>
                <span class="badge badge-{{ $job->status }}">{{ ucfirst($job->status) }}</span>
                @if($job->status == 'pending')
                    <p class="info-hint">Waiting for admin approval</p>
                @elseif($job->status == 'approved')
                    <p class="info-hint">Active and visible to applicants</p>
                @elseif($job->status == 'rejected')
                    <p class="info-hint">This job was not approved</p>
                @endif
            </div>

            @if($job->experience)
                <div class="info-card">
                    <h3>Experience</h3>
                    <p>{{ $job->experience }}</p>
                </div>
            @endif

            @if($job->salary)
                <div class="info-card">
                    <h3>Salary</h3>
                    <p>{{ $job->salary }}</p>
                </div>
            @endif

            @if($job->qualification)
                <div class="info-card">
                    <h3>Qualification</h3>
                    <p>{{ $job->qualification }}</p>
                </div>
            @endif
        </div>

        @if($job->skills)
            <div class="info-card skills-card">
                <h3>Skills</h3>
                <div class="skills-list">
                    @foreach(is_array($job->skills) ? $job->skills : explode(',', $job->skills) as $skill)
                        <span class="skill-tag">{{ trim($skill) }}</span>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="info-card description-card">
            <h3>Job Description</h3>
            <div class="description-content">
                {!! nl2br(e($job->description)) !!}
            </div>
        </div>

        @if($job->rejection_reason)
            <div class="info-card rejection-card">
                <h3>Rejection Reason</h3>
                <p class="rejection-text">{{ $job->rejection_reason }}</p>
            </div>
        @endif

        <div class="info-card meta-card">
            <h3>Additional Information</h3>
            <div class="meta-grid">
                <div>
                    <strong>Created:</strong>
                    <span>{{ $job->created_at->format('F d, Y h:i A') }}</span>
                </div>
                <div>
                    <strong>Last Updated:</strong>
                    <span>{{ $job->updated_at->format('F d, Y h:i A') }}</span>
                </div>
                <div>
                    <strong>Job ID:</strong>
                    <span>#{{ $job->id }}</span>
                </div>
                @if($job->expires_at)
                    <div>
                        <strong>Expires:</strong>
                        <span>{{ $job->expires_at->format('F d, Y') }}</span>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="job-detail-footer">
        <a href="{{ route('employer.jobs.index') }}" class="btn btn-secondary">← Back to Jobs</a>
    </div>
</div>

<style>
    .job-detail-wrapper {
        max-width: 1000px;
        margin: 0 auto;
        padding: 40px 20px;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        color: #1f2937;
    }

    .job-detail-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 32px;
        flex-wrap: wrap;
        gap: 16px;
    }

    .job-detail-header h1 {
        font-size: 2rem;
        font-weight: 700;
        margin: 0 0 12px;
        color: #111827;
    }

    .job-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .meta-item {
        font-size: 0.9rem;
        color: #4b5563;
    }

    .meta-item strong {
        color: #374151;
    }

    .job-actions-top {
        display: flex;
        gap: 8px;
    }

    .job-detail-body {
        display: flex;
        flex-direction: column;
        gap: 24px;
        margin-bottom: 32px;
    }

    .job-info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
    }

    .info-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 20px;
    }

    .info-card h3 {
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #6b7280;
        margin: 0 0 8px;
    }

    .info-card p {
        margin: 0;
        font-size: 0.95rem;
        color: #111827;
    }

    .badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-pending {
        background: #fef3c7;
        color: #92400e;
    }

    .badge-approved {
        background: #d1fae5;
        color: #065f46;
    }

    .badge-rejected {
        background: #fecaca;
        color: #991b1b;
    }

    .info-hint {
        font-size: 0.8rem !important;
        color: #6b7280 !important;
        margin-top: 4px !important;
    }

    .skills-card .skills-list {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 4px;
    }

    .skill-tag {
        background: #f3f4f6;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        color: #4b5563;
    }

    .description-content {
        margin-top: 8px;
        line-height: 1.8;
        color: #374151;
        white-space: pre-wrap;
    }

    .rejection-card {
        border-color: #fecaca;
        background: #fef2f2;
    }

    .rejection-text {
        color: #991b1b !important;
    }

    .meta-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 12px;
    }

    .meta-grid div {
        font-size: 0.9rem;
        color: #4b5563;
    }

    .meta-grid strong {
        color: #374151;
        display: block;
        font-size: 0.8rem;
        font-weight: 600;
        margin-bottom: 2px;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        font-size: 0.9rem;
        font-weight: 500;
        padding: 10px 20px;
        cursor: pointer;
        border: none;
        text-decoration: none;
        transition: background-color 0.15s ease;
    }

    .btn-primary {
        background: #4f46e5;
        color: #ffffff;
    }

    .btn-primary:hover {
        background: #4338ca;
    }

    .btn-secondary {
        background: transparent;
        color: #4b5563;
        border: 1px solid #d1d5db;
    }

    .btn-secondary:hover {
        background: #f3f4f6;
    }

    .btn-danger {
        background: #fecaca;
        color: #991b1b;
    }

    .btn-danger:hover {
        background: #fca5a5;
    }

    .job-detail-footer {
        padding-top: 24px;
        border-top: 1px solid #f3f4f6;
    }

    @media (max-width: 640px) {
        .job-detail-header {
            flex-direction: column;
        }

        .job-actions-top {
            width: 100%;
        }

        .job-actions-top .btn {
            flex: 1;
        }

        .job-info-grid {
            grid-template-columns: 1fr;
        }

        .meta-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

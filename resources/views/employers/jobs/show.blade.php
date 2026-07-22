@extends('layouts.app')

@section('content')

<div class="jobview-page">

    <div class="jobview-card">

        <div class="jobview-header">
            <div class="jobview-header-top">
                <span class="jobview-status jobview-status-{{ $job->status == 'active' ? 'active' : 'pending' }}">
                    {{ ucfirst($job->status) }}
                </span>
                <span class="jobview-date">Posted {{ $job->created_at->format('d M Y') }}</span>
            </div>
            <h1>{{ $job->title }}</h1>
            <div class="jobview-subtags">
                <span class="jobview-subtag">{{ ucfirst(str_replace('-', ' ', $job->employment_type)) }}</span>
                <span class="jobview-subtag-dot">•</span>
                <span class="jobview-subtag">{{ ucfirst($job->work_mode) }}</span>
                @if ($job->city || $job->state)
                    <span class="jobview-subtag-dot">•</span>
                    <span class="jobview-subtag">{{ collect([$job->city, $job->district, $job->state])->filter()->implode(', ') }}</span>
                @endif
            </div>
        </div>

        <div class="jobview-info-grid">
            <div class="jobview-info-item">
                <span class="jobview-info-label">Experience</span>
                <span class="jobview-info-value">{{ $job->experience ?: '—' }}</span>
            </div>
            <div class="jobview-info-item">
                <span class="jobview-info-label">Salary</span>
                <span class="jobview-info-value">{{ $job->salary ?: '—' }}</span>
            </div>
            <div class="jobview-info-item">
                <span class="jobview-info-label">Qualification</span>
                <span class="jobview-info-value">{{ $job->qualification ?: '—' }}</span>
            </div>
        </div>

        <div class="jobview-section">
            <h2>Description</h2>
            <p class="jobview-description">{{ $job->description }}</p>
        </div>

        @if ($job->skills)
            <div class="jobview-section">
                <h2>Skills</h2>
                <div class="jobview-skill-tags">
                    @foreach (is_array($job->skills) ? $job->skills : explode(',', $job->skills) as $skill)
                        <span class="jobview-skill-tag">{{ trim($skill) }}</span>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="jobview-location">
            <h2>Location</h2>
            <div class="jobview-location-grid">
                <div>
                    <span class="jobview-info-label">Country</span>
                    <span class="jobview-info-value">{{ $job->country ?: '—' }}</span>
                </div>
                <div>
                    <span class="jobview-info-label">State</span>
                    <span class="jobview-info-value">{{ $job->state ?: '—' }}</span>
                </div>
                <div>
                    <span class="jobview-info-label">District</span>
                    <span class="jobview-info-value">{{ $job->district ?: '—' }}</span>
                </div>
                <div>
                    <span class="jobview-info-label">City</span>
                    <span class="jobview-info-value">{{ $job->city ?: '—' }}</span>
                </div>
            </div>
        </div>

        <div class="jobview-footer">
            <div class="jobview-actions jobview-actions-split">
                <a href="{{ route('employer.jobs.index') }}" class="jobview-back">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                    Back to jobs
                </a>

                <div class="jobview-actions-right">
                    <a href="{{ route('employer.jobs.edit', $job) }}" class="jobview-btn jobview-btn-primary">Edit Job</a>
                    <form action="{{ route('employer.jobs.destroy', $job) }}" method="POST"
                          onsubmit="return confirm('Delete this job?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="jobview-btn jobview-btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    .jobview-page {
        max-width: 720px;
        margin: 0 auto;
        padding: 44px 20px 80px;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        color: #1f2937;
    }

    .jobview-back {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.85rem;
        font-weight: 600;
        color: #64748b;
        background: #f8fafc;
        border: 1px solid #e5e7eb;
        padding: 8px 16px;
        border-radius: 999px;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    .jobview-back svg { transition: transform 0.2s ease; }
    .jobview-back:hover {
        color: #2563eb;
        background: #eff6ff;
        border-color: #bfdbfe;
        transform: translateX(-2px);
    }
    .jobview-back:hover svg { transform: translateX(-2px); }

    .jobview-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        padding: 38px;
        box-shadow: 0 4px 24px rgba(15, 23, 42, 0.04);
    }

    /* Header */
    .jobview-header {
        padding-bottom: 26px;
        margin-bottom: 26px;
        border-bottom: 1px solid #f1f5f9;
    }

    .jobview-header-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 14px;
    }

    .jobview-status {
        display: inline-flex;
        padding: 4px 12px;
        border-radius: 999px;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }
    .jobview-status-active { background: #ecfdf5; color: #059669; }
    .jobview-status-pending { background: #f1f5f9; color: #64748b; }

    .jobview-date {
        font-size: 0.8rem;
        color: #9ca3af;
    }

    .jobview-header h1 {
        font-size: 1.65rem;
        font-weight: 700;
        color: #0f172a;
        margin: 0 0 10px;
        letter-spacing: -0.01em;
        line-height: 1.25;
    }

    .jobview-subtags {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        font-size: 0.88rem;
        color: #6b7280;
    }
    .jobview-subtag-dot { color: #d1d5db; }

    /* Info grid */
    .jobview-info-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        padding-bottom: 26px;
        margin-bottom: 26px;
        border-bottom: 1px solid #f1f5f9;
    }

    .jobview-info-item,
    .jobview-location-grid > div {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .jobview-info-label {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #9ca3af;
    }

    .jobview-info-value {
        font-size: 0.95rem;
        font-weight: 600;
        color: #111827;
    }

    /* Sections */
    .jobview-section {
        margin-bottom: 26px;
    }
    .jobview-section h2 {
        font-size: 0.9rem;
        font-weight: 700;
        color: #111827;
        margin: 0 0 10px;
    }

    .jobview-description {
        font-size: 0.92rem;
        line-height: 1.75;
        color: #4b5563;
        margin: 0;
        white-space: pre-line;
    }

    .jobview-skill-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }
    .jobview-skill-tag {
        background: #eef2ff;
        color: #4338ca;
        font-size: 0.8rem;
        font-weight: 600;
        padding: 5px 14px;
        border-radius: 999px;
    }

    /* Location */
    .jobview-location {
        background: #f9fafb;
        border: 1px solid #f1f5f9;
        border-radius: 12px;
        padding: 20px 22px;
        margin-bottom: 26px;
    }
    .jobview-location h2 {
        font-size: 0.9rem;
        font-weight: 700;
        color: #111827;
        margin: 0 0 14px;
    }
    .jobview-location-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
    }

    /* Footer / actions */
    .jobview-footer {
        padding-top: 22px;
        border-top: 1px solid #f1f5f9;
    }

    .jobview-actions-split {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .jobview-actions-right {
        display: flex;
        gap: 10px;
    }

    .jobview-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        padding: 9px 20px;
        cursor: pointer;
        border: none;
        text-decoration: none;
        transition: background-color 0.15s ease, transform 0.15s ease;
    }

    .jobview-btn-primary {
        background: #2563eb;
        color: #ffffff;
    }
    .jobview-btn-primary:hover { background: #1d4ed8; transform: translateY(-1px); }

    .jobview-btn-danger {
        background: #fef2f2;
        color: #dc2626;
    }
    .jobview-btn-danger:hover { background: #fee2e2; }

    @media (max-width: 640px) {
        .jobview-page { padding: 28px 16px 60px; }
        .jobview-card { padding: 24px; }
        .jobview-header h1 { font-size: 1.35rem; }
        .jobview-info-grid { grid-template-columns: 1fr 1fr; }
        .jobview-location-grid { grid-template-columns: 1fr 1fr; }
        .jobview-actions-split {
            flex-direction: column-reverse;
            gap: 12px;
        }
        .jobview-actions-right { width: 100%; }
        .jobview-actions-right .jobview-btn, .jobview-actions-right form { width: 100%; }
        .jobview-back { align-self: flex-start; }
    }
</style>

@endsection
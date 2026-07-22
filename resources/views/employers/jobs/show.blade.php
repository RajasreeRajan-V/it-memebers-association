@extends('layouts.app')

@section('content')

<div class="detail-wrapper">

    <div class="detail-header">
        <div>
            <a href="{{ route('employer.jobs.index') }}" class="back-link">&larr; Back to Jobs</a>
            <h1>{{ $job->title }}</h1>
            <span class="badge badge-{{ $job->status == 'active' ? 'green' : 'gray' }}">{{ ucfirst($job->status) }}</span>
        </div>
        <div class="detail-actions">
            <a href="{{ route('employer.jobs.edit', $job) }}" class="btn btn-secondary">Edit</a>
            <form action="{{ route('employer.jobs.destroy', $job) }}" method="POST"
                  onsubmit="return confirm('Delete this job? This cannot be undone.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="detail-card">
        <div class="detail-grid">
            <div class="detail-item">
                <span class="detail-label">Employment Type</span>
                <span class="detail-value">{{ ucfirst(str_replace('-', ' ', $job->employment_type)) }}</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Work Mode</span>
                <span class="detail-value">{{ ucfirst($job->work_mode) }}</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Experience</span>
                <span class="detail-value">{{ $job->experience ?: '—' }}</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Salary</span>
                <span class="detail-value">{{ $job->salary ?: '—' }}</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Qualification</span>
                <span class="detail-value">{{ $job->qualification ?: '—' }}</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Location</span>
                <span class="detail-value">{{ collect([$job->city, $job->district, $job->state, $job->country])->filter()->implode(', ') }}</span>
            </div>
        </div>

       @if ($job->skills)
    <div class="detail-section">
        <span class="detail-label">Skills</span>

        <div class="skill-tags">
            @foreach (is_array($job->skills) ? $job->skills : explode(',', $job->skills) as $skill)
                <span class="skill-tag">{{ trim($skill) }}</span>
            @endforeach
        </div>
    </div>
@endif

        <div class="detail-section">
            <span class="detail-label">Description</span>
            <p class="detail-description">{{ $job->description }}</p>
        </div>

        <div class="detail-footer">
            Posted on {{ $job->created_at->format('M d, Y') }}
        </div>
    </div>
</div>

<style>
    .detail-wrapper { max-width: 800px; margin: 0 auto; padding: 40px 20px; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; color: #1f2937; }
    .detail-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 20px; flex-wrap: wrap; gap: 12px; }
    .back-link { font-size: 0.82rem; color: #6b7280; text-decoration: none; display: inline-block; margin-bottom: 8px; }
    .back-link:hover { color: #4f46e5; }
    .detail-header h1 { font-size: 1.6rem; font-weight: 600; margin: 0 8px 0 0; display: inline; color: #111827; }
    .detail-actions { display: flex; gap: 10px; }
    .alert-success { background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; border-radius: 10px; padding: 12px 16px; margin-bottom: 20px; font-size: 0.9rem; }
    .badge { display: inline-block; padding: 3px 10px; border-radius: 999px; font-size: 0.75rem; font-weight: 600; vertical-align: middle; }
    .badge-green { background: #dcfce7; color: #166534; }
    .badge-gray { background: #f3f4f6; color: #6b7280; }
    .detail-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 14px; padding: 32px; }
    .detail-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 24px; }
    .detail-item { display: flex; flex-direction: column; gap: 4px; }
    .detail-label { font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.03em; color: #9ca3af; }
    .detail-value { font-size: 0.95rem; color: #111827; }
    .detail-section { margin-bottom: 24px; padding-top: 20px; border-top: 1px solid #f3f4f6; }
    .skill-tags { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 8px; }
    .skill-tag { background: #eef2ff; color: #4338ca; font-size: 0.8rem; padding: 4px 12px; border-radius: 999px; }
    .detail-description { font-size: 0.9rem; line-height: 1.6; color: #374151; margin-top: 8px; white-space: pre-line; }
    .detail-footer { font-size: 0.8rem; color: #9ca3af; padding-top: 16px; border-top: 1px solid #f3f4f6; }
    .btn { display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; font-size: 0.85rem; font-weight: 500; padding: 8px 16px; cursor: pointer; border: none; text-decoration: none; }
    .btn-secondary { background: transparent; color: #4b5563; border: 1px solid #d1d5db; }
    .btn-secondary:hover { background: #f3f4f6; }
    .btn-danger { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }
    .btn-danger:hover { background: #fee2e2; }
</style>

@endsection

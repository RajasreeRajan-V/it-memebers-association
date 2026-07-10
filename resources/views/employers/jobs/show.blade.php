{{-- resources/views/employer/jobs/show.blade.php --}}
@extends('employers.layout.app')

@section('title', 'Job Details')
@section('page-title', 'Job Details')
@section('page-subtitle', $job->title)

@section('content')

    <a href="{{ route('employer.jobs.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> Back to Job Postings
    </a>

    <div class="detail-card">
        {{-- Header --}}
        <div class="detail-header">
            <div>
                <h1>{{ $job->title }}</h1>
                <div class="detail-meta">
                    <span><i class="fas fa-briefcase"></i> {{ ucfirst(str_replace('-', ' ', $job->employment_type)) }}</span>
                    <span><i class="fas fa-location-dot"></i> {{ ucfirst($job->work_mode) }}</span>
                    <span><i class="far fa-clock"></i> Posted {{ $job->created_at->diffForHumans() }}</span>
                </div>
            </div>
            <span class="status-badge status-{{ $job->status }} status-lg">{{ ucfirst($job->status) }}</span>
        </div>

        {{-- Rejection reason banner --}}
        @if($job->status === 'rejected' && $job->rejection_reason)
            <div class="reason-banner">
                <i class="fas fa-circle-info"></i>
                <div>
                    <strong>Rejected by admin</strong>
                    <p>{{ $job->rejection_reason }}</p>
                </div>
            </div>
        @endif

        {{-- Key details grid --}}
        <div class="detail-body">
            <div class="detail-grid">
                <div class="detail-item">
                    <span><i class="fas fa-briefcase"></i> Employment Type</span>
                    <strong>{{ ucfirst(str_replace('-', ' ', $job->employment_type)) }}</strong>
                </div>
                <div class="detail-item">
                    <span><i class="fas fa-house-laptop"></i> Work Mode</span>
                    <strong>{{ ucfirst($job->work_mode) }}</strong>
                </div>
                <div class="detail-item">
                    <span><i class="fas fa-user-clock"></i> Experience</span>
                    <strong>{{ $job->experience ?: '—' }}</strong>
                </div>
                <div class="detail-item">
                    <span><i class="fas fa-sack-dollar"></i> Salary</span>
                    <strong>{{ $job->salary ?: '—' }}</strong>
                </div>
                <div class="detail-item">
                    <span><i class="fas fa-graduation-cap"></i> Qualification</span>
                    <strong>{{ $job->qualification ?: '—' }}</strong>
                </div>
                <div class="detail-item">
                    <span><i class="fas fa-map-location-dot"></i> Location</span>
                    <strong>{{ collect([$job->city, $job->district, $job->state])->filter()->implode(', ') ?: '—' }}</strong>
                </div>
                <div class="detail-item">
                    <span><i class="far fa-calendar"></i> Posted On</span>
                    <strong>{{ $job->created_at->format('d M Y, h:i A') }}</strong>
                </div>
                <div class="detail-item">
                    <span><i class="far fa-clock"></i> Last Updated</span>
                    <strong>{{ $job->updated_at->format('d M Y, h:i A') }}</strong>
                </div>
            </div>

            {{-- Skills --}}
            <div class="detail-block">
                <span class="block-label"><i class="fas fa-screwdriver-wrench"></i> Skills Required</span>
                <div class="skills-wrap">
                    @forelse($job->skills ?? [] as $skill)
                        <span class="skill-chip">{{ $skill }}</span>
                    @empty
                        <span class="no-data">No skills listed</span>
                    @endforelse
                </div>
            </div>

            {{-- Description --}}
            <div class="detail-block">
                <span class="block-label"><i class="fas fa-file-lines"></i> Job Description</span>
                <p class="description-text">{{ $job->description }}</p>
            </div>
        </div>

        {{-- Footer actions --}}
        <div class="detail-footer">
            <a href="{{ route('employer.jobs.edit', $job) }}" class="btn-primary">
                <i class="fas fa-pen"></i> Edit Job
            </a>
            <form action="{{ route('employer.jobs.destroy', $job) }}" method="POST"
                  onsubmit="return confirm('Delete this job posting?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger">
                    <i class="fas fa-trash"></i> Delete Job
                </button>
            </form>
            <a href="{{ route('employer.jobs.index') }}" class="btn-secondary">Back to List</a>
        </div>
    </div>

@endsection

@push('styles')
    @include('employers.partials.list-styles')
    <style>
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
            font-weight: 500;
            color: #64748b;
            text-decoration: none;
            margin-bottom: 1.25rem;
        }
        .back-link:hover { color: #7c3aed; }

        .detail-card {
            background: #fff;
            border-radius: 18px;
            border: 1px solid #edf2f7;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            overflow: hidden;
        }

        .detail-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
            padding: 1.75rem 1.75rem 1.25rem;
            border-bottom: 1px solid #f1f5f9;
            flex-wrap: wrap;
        }
        .detail-header h1 {
            font-size: 1.4rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 0.5rem;
        }
        .detail-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            font-size: 0.82rem;
            color: #64748b;
        }
        .detail-meta span { display: flex; align-items: center; gap: 0.4rem; }
        .detail-meta i { color: #a78bfa; }

        .status-lg { font-size: 0.78rem; padding: 0.35rem 1.1rem; flex-shrink: 0; }

        .reason-banner {
            display: flex;
            gap: 0.75rem;
            background: #fef2f2;
            border-bottom: 1px solid #fecaca;
            color: #991b1b;
            padding: 1rem 1.75rem;
            font-size: 0.85rem;
        }
        .reason-banner i { font-size: 1.1rem; margin-top: 0.1rem; }
        .reason-banner strong { display: block; margin-bottom: 0.15rem; }
        .reason-banner p { color: #b91c1c; }

        .detail-body { padding: 1.75rem; }

        .detail-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
            gap: 1.25rem 1.5rem;
            margin-bottom: 1.75rem;
            padding-bottom: 1.75rem;
            border-bottom: 1px solid #f1f5f9;
        }
        .detail-item span {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: #94a3b8;
            margin-bottom: 0.3rem;
        }
        .detail-item span i { color: #c4b5fd; font-size: 0.85rem; }
        .detail-item strong { font-size: 0.95rem; color: #0f172a; font-weight: 600; }

        .detail-block { margin-bottom: 1.75rem; }
        .detail-block:last-child { margin-bottom: 0; }
        .block-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.8rem;
            font-weight: 700;
            color: #334155;
            margin-bottom: 0.75rem;
        }
        .block-label i { color: #7c3aed; }

        .skills-wrap { display: flex; flex-wrap: wrap; gap: 0.5rem; }
        .skill-chip {
            background: #ede9fe;
            color: #6d28d9;
            font-size: 0.8rem;
            font-weight: 600;
            padding: 0.35rem 0.95rem;
            border-radius: 20px;
        }
        .no-data { font-size: 0.85rem; color: #94a3b8; }

        .description-text {
            font-size: 0.92rem;
            color: #334155;
            line-height: 1.8;
            white-space: pre-line;
        }

        .detail-footer {
            display: flex;
            gap: 0.75rem;
            padding: 1.25rem 1.75rem;
            border-top: 1px solid #f1f5f9;
            background: #fafbfc;
            flex-wrap: wrap;
        }
        .btn-danger {
            display: inline-flex; align-items: center; gap: 0.5rem; border: none; cursor: pointer;
            padding: 0.75rem 1.5rem; border-radius: 10px; font-weight: 600; font-size: 0.9rem;
            background: #fee2e2; color: #991b1b;
        }
        .btn-danger:hover { background: #fecaca; }

        @media (max-width: 640px) {
            .detail-header, .detail-body, .detail-footer { padding-left: 1.25rem; padding-right: 1.25rem; }
            .detail-footer { flex-direction: column; }
            .detail-footer .btn-primary, .detail-footer .btn-danger, .detail-footer .btn-secondary { width: 100%; justify-content: center; }
        }
    </style>
@endpush
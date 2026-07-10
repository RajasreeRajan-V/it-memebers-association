{{-- resources/views/employer/startup-profile/show.blade.php --}}
@extends('employers.layout.app')

@section('title', 'Startup Profile')
@section('page-title', 'Startup Profile')
@section('page-subtitle', $profile->startup_name)

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title"><i class="fas fa-rocket"></i> {{ $profile->startup_name }}</div>
            <div style="display:flex; align-items:center; gap:0.75rem;">
                <span class="status-badge status-{{ $profile->status }}">{{ ucfirst($profile->status) }}</span>
                <a href="{{ route('employer.startup-profile.edit') }}" class="quick-link-btn">
                    <i class="fas fa-pen"></i> Edit Profile
                </a>
            </div>
        </div>
        <div class="card-body">
            @if($profile->status === 'rejected' && $profile->rejection_reason)
                <div class="reason-banner">
                    <i class="fas fa-circle-info"></i> Rejection reason: {{ $profile->rejection_reason }}
                </div>
            @endif

            <div class="detail-grid">
                <div class="detail-item"><span>Founder</span><strong>{{ $profile->founder_name }}</strong></div>
                <div class="detail-item"><span>Team Size</span><strong>{{ $profile->team_size ?: '—' }}</strong></div>
                <div class="detail-item"><span>Industry</span><strong>{{ $profile->industry ?: '—' }}</strong></div>
                <div class="detail-item"><span>Funding Required</span><strong>{{ $profile->funding_required ?: '—' }}</strong></div>
                <div class="detail-item"><span>Website</span><strong>{{ $profile->website ?: '—' }}</strong></div>
                <div class="detail-item"><span>Location</span><strong>{{ collect([$profile->city, $profile->district, $profile->state])->filter()->implode(', ') ?: '—' }}</strong></div>
                <div class="detail-item"><span>Contact Email</span><strong>{{ $profile->contact_email }}</strong></div>
                <div class="detail-item"><span>Phone</span><strong>{{ $profile->phone_number }}</strong></div>
            </div>

            <div class="detail-block">
                <span>Business Description</span>
                <p>{{ $profile->business_description }}</p>
            </div>

            @if($profile->pitch_summary_path)
                <a href="{{ asset('storage/' . $profile->pitch_summary_path) }}" target="_blank" class="quick-link-btn" style="margin-top:0.5rem;">
                    <i class="fas fa-file-arrow-down"></i> View Pitch Summary
                </a>
            @endif
        </div>
    </div>
@endsection

@push('styles')
    @include('employers.partials.list-styles')
    <style>
        .reason-banner { background:#fef2f2; color:#991b1b; border:1px solid #fecaca; border-radius:10px; padding:0.75rem 1rem; font-size:0.85rem; margin-bottom:1.25rem; }
        .detail-grid { display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:1rem 1.5rem; margin-bottom:1.5rem; }
        .detail-item span { display:block; font-size:0.72rem; text-transform:uppercase; letter-spacing:0.04em; color:#94a3b8; margin-bottom:0.15rem; }
        .detail-item strong { font-size:0.9rem; color:#0f172a; font-weight:600; }
        .detail-block span { display:block; font-size:0.72rem; text-transform:uppercase; letter-spacing:0.04em; color:#94a3b8; margin-bottom:0.35rem; }
        .detail-block p { font-size:0.88rem; color:#334155; line-height:1.7; }
    </style>
@endpush

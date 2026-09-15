@extends('layouts.app')

@include('employers.startup-profile._styles')

@section('content')

<div class="sp-page">
<div class="sp-wrap" style="max-width:720px;">

    <a href="{{ route('employer.startup-profile.index') }}" class="sp-back">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M19 12H5M12 19l-7-7 7-7"/>
        </svg>
        Back to profile
    </a>

    @if (session('success'))
        <div class="sp-alert sp-alert-success">{{ session('success') }}</div>
    @endif

    <div class="sp-detail-card">

        {{-- ============================================================
            HEADER
        ============================================================ --}}

        <div class="sp-detail-header">

            @if ($profile->logo_path)
                <img src="{{ asset('storage/' . $profile->logo_path) }}"
                     alt="{{ $profile->startup_name }}"
                     class="sp-detail-logo">
            @else
                <span class="sp-detail-logo-fallback">
                    {{ strtoupper(substr(trim($profile->startup_name ?? 'S'), 0, 1)) }}
                </span>
            @endif

            <div class="min-w-0" style="flex:1;">

                <div class="sp-detail-header-top">
                    <span class="sp-status sp-status-{{ $profile->status }}">{{ $profile->status }}</span>
                    <span class="sp-detail-date">Updated {{ optional($profile->updated_at)->format('d M Y') }}</span>
                </div>

                <h1>{{ $profile->startup_name }}</h1>
                <p class="sp-detail-founder">Founded by {{ $profile->founder_name }}</p>

            </div>

        </div>

        {{-- REJECTION NOTICE --}}
        @if ($profile->status === 'rejected' && $profile->rejection_reason)
            <div class="sp-rejection-inline" style="margin-bottom:26px;">
                <strong>Rejected:</strong> {{ $profile->rejection_reason }}
            </div>
        @endif

        {{-- ============================================================
            INFO GRID
        ============================================================ --}}

        <div class="sp-info-grid">

            <div class="sp-info-item">
                <span class="sp-info-label">Industry</span>
                <span class="sp-info-value">{{ $profile->industry ?: '—' }}</span>
            </div>

            <div class="sp-info-item">
                <span class="sp-info-label">Team Size</span>
                <span class="sp-info-value">{{ $profile->team_size ?: '—' }}</span>
            </div>

            <div class="sp-info-item">
                <span class="sp-info-label">Funding Required</span>
                <span class="sp-info-value">{{ $profile->funding_required ?: '—' }}</span>
            </div>

        </div>

        {{-- ============================================================
            DESCRIPTION
        ============================================================ --}}

        <div class="sp-section">
            <h2>Business Description</h2>
            <p class="sp-section-body">{{ $profile->business_description }}</p>
        </div>

        {{-- ============================================================
            CONTACT
        ============================================================ --}}

        <div class="sp-section">
            <h2>Contact</h2>
            <div class="sp-info-grid" style="border-bottom:none;padding-bottom:0;margin-bottom:0;grid-template-columns:repeat(2,1fr);">
                <div class="sp-info-item">
                    <span class="sp-info-label">Email</span>
                    <span class="sp-info-value">{{ $profile->contact_email }}</span>
                </div>
                <div class="sp-info-item">
                    <span class="sp-info-label">Phone</span>
                    <span class="sp-info-value">{{ $profile->phone_number }}</span>
                </div>
                @if ($profile->website)
                    <div class="sp-info-item sp-link">
                        <span class="sp-info-label">Website</span>
                        <span class="sp-info-value sp-link">
                            <a href="{{ $profile->website }}" target="_blank">{{ $profile->website }}</a>
                        </span>
                    </div>
                @endif
            </div>
        </div>

        {{-- ============================================================
            PITCH SUMMARY
        ============================================================ --}}

        @if ($profile->pitch_summary_path)
            <div class="sp-section">
                <h2>Pitch Summary</h2>
                <a href="{{ asset('storage/' . $profile->pitch_summary_path) }}" target="_blank" class="sp-file-chip">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <path d="M14 2v6h6"></path>
                    </svg>
                    Download file
                </a>
            </div>
        @endif

        {{-- ============================================================
            LOCATION
        ============================================================ --}}

        <div class="sp-location-box">
            <h2>Location</h2>
            <div class="sp-location-grid">
                <div>
                    <span class="sp-info-label">Country</span>
                    <span class="sp-info-value">{{ $profile->country ?: '—' }}</span>
                </div>
                <div>
                    <span class="sp-info-label">State</span>
                    <span class="sp-info-value">{{ $profile->state ?: '—' }}</span>
                </div>
                <div>
                    <span class="sp-info-label">District</span>
                    <span class="sp-info-value">{{ $profile->district ?: '—' }}</span>
                </div>
                <div>
                    <span class="sp-info-label">City</span>
                    <span class="sp-info-value">{{ $profile->city ?: '—' }}</span>
                </div>
            </div>
        </div>

        {{-- ============================================================
            FOOTER ACTIONS
        ============================================================ --}}

        <div class="sp-detail-footer">
            <div class="sp-actions-split">

                <a href="{{ route('employer.startup-profile.index') }}" class="sp-back" style="margin-bottom:0;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                    Back to profile
                </a>

                <div class="sp-actions-right">
                    <a href="{{ route('employer.startup-profile.edit') }}" class="sp-btn sp-btn-primary">Edit Profile</a>
                    <form action="{{ route('employer.startup-profile.destroy') }}" method="POST"
                          onsubmit="return confirm('Delete this startup profile? This action cannot be undone.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="sp-btn sp-btn-danger">Delete</button>
                    </form>
                </div>

            </div>
        </div>

    </div>

</div>
</div>

@endsection
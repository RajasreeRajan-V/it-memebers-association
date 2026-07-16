@extends('layouts.app')

@include('employers.startup-profile._styles')

@section('content')
<section class="sp-wrap">
    <div class="container">

        @if (session('success'))
            <div class="alert alert-success" style="margin-bottom:18px;border-radius:12px;">{{ session('success') }}</div>
        @endif

        <div class="sp-card">
            <div class="sp-header">
                <div>
                    <h1>My Startup Profile</h1>
                    <p>This is what investors and admins see for your startup.</p>
                </div>
                <div class="sp-actions">
                    <span class="sp-status sp-status-{{ $profile->status }}">{{ $profile->status }}</span>
                    <a href="{{ route('employer.startup-profile.show') }}" class="sp-btn">View</a>
                    <a href="{{ route('employer.startup-profile.edit') }}" class="sp-btn sp-btn-primary">Edit</a>
                    <button type="button" id="spDeleteBtn" class="sp-btn sp-btn-danger">Delete</button>
                </div>
            </div>

            @if ($profile->status === 'rejected' && $profile->rejection_reason)
                <div class="sp-rejection">
                    <strong>Rejected:</strong> {{ $profile->rejection_reason }}
                </div>
            @endif

            <div class="sp-grid" style="margin-top:24px;">
                <div class="sp-field sp-field-full">
                    @if ($profile->logo_path)
                        <img src="{{ asset('storage/' . $profile->logo_path) }}" alt="{{ $profile->startup_name }}" class="sp-logo">
                    @else
                        <div class="sp-logo-placeholder">No Logo</div>
                    @endif
                </div>

                <div class="sp-field">
                    <span class="sp-label">Startup Name</span>
                    <span class="sp-value">{{ $profile->startup_name }}</span>
                </div>
                <div class="sp-field">
                    <span class="sp-label">Founder</span>
                    <span class="sp-value">{{ $profile->founder_name }}</span>
                </div>
                <div class="sp-field">
                    <span class="sp-label">Industry</span>
                    <span class="sp-value {{ $profile->industry ? '' : 'empty' }}">{{ $profile->industry ?: 'Not set' }}</span>
                </div>
                <div class="sp-field">
                    <span class="sp-label">Team Size</span>
                    <span class="sp-value {{ $profile->team_size ? '' : 'empty' }}">{{ $profile->team_size ?: 'Not set' }}</span>
                </div>
                <div class="sp-field">
                    <span class="sp-label">Funding Required</span>
                    <span class="sp-value {{ $profile->funding_required ? '' : 'empty' }}">{{ $profile->funding_required ?: 'Not set' }}</span>
                </div>
                <div class="sp-field">
                    <span class="sp-label">Location</span>
                    <span class="sp-value">{{ collect([$profile->city, $profile->district, $profile->state, $profile->country])->filter()->implode(', ') ?: 'Not set' }}</span>
                </div>
                <div class="sp-field">
                    <span class="sp-label">Website</span>
                    <span class="sp-value {{ $profile->website ? '' : 'empty' }}">
                        @if($profile->website)
                            <a href="{{ $profile->website }}" target="_blank">{{ $profile->website }}</a>
                        @else
                            Not set
                        @endif
                    </span>
                </div>
                <div class="sp-field">
                    <span class="sp-label">Contact</span>
                    <span class="sp-value">{{ $profile->contact_email }} · {{ $profile->phone_number }}</span>
                </div>
                <div class="sp-field sp-field-full">
                    <span class="sp-label">Business Description</span>
                    <span class="sp-value">{{ $profile->business_description }}</span>
                </div>
                @if ($profile->pitch_summary_path)
                <div class="sp-field">
                    <span class="sp-label">Pitch Summary</span>
                    <span class="sp-value"><a href="{{ asset('storage/' . $profile->pitch_summary_path) }}" target="_blank">Download file</a></span>
                </div>
                @endif
            </div>
        </div>

        <form id="spDeleteForm" action="{{ route('employer.startup-profile.destroy') }}" method="POST" style="display:none;">
            @csrf
            @method('DELETE')
        </form>
    </div>
</section>
@endsection

@include('employers.startup-profile._scripts')
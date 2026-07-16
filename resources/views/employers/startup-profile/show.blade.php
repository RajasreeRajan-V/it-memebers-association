@extends('layouts.app')

@include('employers.startup-profile._styles')

@section('content')
<section class="sp-wrap">
    <div class="container">
        <div class="sp-card">
            <div class="sp-header">
                <div>
                    <h1>{{ $profile->startup_name }}</h1>
                    <p>Startup profile preview</p>
                </div>
                <div class="sp-actions">
                    <span class="sp-status sp-status-{{ $profile->status }}">{{ $profile->status }}</span>
                    <a href="{{ route('employer.startup-profile.index') }}" class="sp-btn">Back</a>
                </div>
            </div>

            <div class="sp-grid" style="margin-top:24px;">
                <div class="sp-field sp-field-full">
                    @if ($profile->logo_path)
                        <img src="{{ asset('storage/' . $profile->logo_path) }}" alt="{{ $profile->startup_name }}" class="sp-logo">
                    @else
                        <div class="sp-logo-placeholder">No Logo</div>
                    @endif
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
    </div>
</section>
@endsection
@extends('layouts.app')

@include('employers.startup-profile._styles')

@section('content')

<div class="sp-page">
<div class="sp-form-wrapper">

    {{-- ============================================================
        PAGE HEADER
    ============================================================ --}}

    <div class="sp-form-header">
        <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;">
            <h1 style="margin:0;">Edit Startup Profile</h1>
            <span class="sp-status sp-status-{{ $profile->status }}">{{ $profile->status }}</span>
        </div>
        <p>Any changes will send your profile back for admin re-approval.</p>
    </div>

    @if ($errors->any())
        <div class="sp-alert sp-alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="sp-alert sp-alert-success">{{ session('success') }}</div>
    @endif

    {{-- ============================================================
        MAIN LAYOUT
    ============================================================ --}}

    <div class="sp-form-layout">

        {{-- ========================================================
            MAIN FORM
        ======================================================== --}}

        <div>

            <form action="{{ route('employer.startup-profile.update') }}"
                  method="POST"
                  enctype="multipart/form-data"
                  class="sp-profile-form">

                @method('PUT')

                <div class="sp-form-card">

                    <div class="sp-form-card-head">
                        <div class="sp-form-card-icon">
                            <i class="bi bi-building"></i>
                        </div>
                        <div>
                            <h2>Startup Details</h2>
                            <p>Update the information investors and admins see.</p>
                        </div>
                    </div>

                    @if ($profile->status === 'rejected' && $profile->rejection_reason)
                        <div class="sp-alert sp-alert-danger" style="margin-bottom:23px;">
                            <strong>Rejected:</strong> {{ $profile->rejection_reason }}
                        </div>
                    @endif

                    @include('employers.startup-profile._form')

                </div>

                <div class="sp-form-actions">
                    <a href="{{ route('employer.startup-profile.index') }}" class="sp-cancel">Cancel</a>
                    <button type="submit" class="sp-submit-btn">
                        <i class="bi bi-check2-circle"></i>
                        Update Profile
                    </button>
                </div>

            </form>

        </div>

        {{-- ========================================================
            SIDEBAR
        ======================================================== --}}

        <aside class="sp-sidebar">

            <div class="sp-side-card">
                <div class="sp-side-card-head">
                    <div class="sp-side-card-head-icon"><i class="bi bi-lightbulb"></i></div>
                    <h3>Profile Tips</h3>
                </div>

                <ul class="sp-tips-list">
                    <li><i class="bi bi-check2-circle"></i><span>Keep your startup name consistent with your branding.</span></li>
                    <li><i class="bi bi-check2-circle"></i><span>Refresh your business description as your pitch evolves.</span></li>
                    <li><i class="bi bi-check2-circle"></i><span>Swap in a new logo if your branding has changed.</span></li>
                    <li><i class="bi bi-check2-circle"></i><span>Double-check contact details before saving.</span></li>
                </ul>
            </div>

            <div class="sp-side-notice">
                <i class="bi bi-info-circle"></i>
                <div>
                    <strong>Re-approval required</strong>
                    <span>Saving changes moves your profile back to pending until an admin reviews it.</span>
                </div>
            </div>

        </aside>

    </div>

</div>
</div>

@include('employers.startup-profile._scripts')

@endsection
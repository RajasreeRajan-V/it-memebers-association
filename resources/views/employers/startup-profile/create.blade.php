@extends('layouts.app')

@include('employers.startup-profile._styles')

@section('content')

<div class="sp-page">
<div class="sp-form-wrapper">

    {{-- ============================================================
        PAGE HEADER
    ============================================================ --}}

    <div class="sp-form-header">
        <h1>Create Startup Profile</h1>
        <p>Get listed on the Investor Portal alongside your job postings.</p>
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

            <form action="{{ route('employer.startup-profile.store') }}"
                  method="POST"
                  enctype="multipart/form-data"
                  class="sp-profile-form">

                <div class="sp-form-card">

                    <div class="sp-form-card-head">
                        <div class="sp-form-card-icon">
                            <i class="bi bi-building"></i>
                        </div>
                        <div>
                            <h2>Startup Details</h2>
                            <p>Tell investors who you are and what you're building.</p>
                        </div>
                    </div>

                    @include('employers.startup-profile._form')

                </div>

                <div class="sp-form-actions">
                    <a href="{{ route('employer.jobs.index') }}" class="sp-cancel">Cancel</a>
                    <button type="submit" class="sp-submit-btn">
                        <i class="bi bi-send"></i>
                        Submit Profile
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
                    <li><i class="bi bi-check2-circle"></i><span>Use a clear, recognisable startup name.</span></li>
                    <li><i class="bi bi-check2-circle"></i><span>Write a concise, compelling business description.</span></li>
                    <li><i class="bi bi-check2-circle"></i><span>Upload a clean, high-resolution logo.</span></li>
                    <li><i class="bi bi-check2-circle"></i><span>Keep contact details accurate and up to date.</span></li>
                </ul>
            </div>

            <div class="sp-side-notice">
                <i class="bi bi-info-circle"></i>
                <div>
                    <strong>Before publishing</strong>
                    <span>Your profile will be reviewed by an admin before it appears to investors.</span>
                </div>
            </div>

        </aside>

    </div>

</div>
</div>

@include('employers.startup-profile._scripts')

@endsection
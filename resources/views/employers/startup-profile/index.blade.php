@extends('layouts.app')

@include('employers.startup-profile._styles')

@section('content')

<style>
    /* ============================================================
       HERO (scoped + !important to beat _styles.blade.php rules)
    ============================================================ */

    .sp-hero-wrap h1.sp-hero-title {
        font-size: 3rem !important;
        line-height: 1.12 !important;
        font-weight: 700 !important;
        letter-spacing: -.035em !important;
        color: #0f172a !important;
        margin: 0 0 1rem 0 !important;
    }

    .sp-hero-wrap h1.sp-hero-title span {
        color: #2563eb !important;
        display: block !important;
    }

    .sp-hero-wrap p.sp-hero-sub {
        font-size: 1rem !important;
        line-height: 1.6 !important;
        color: #64748b !important;
        margin: 0 0 1.5rem 0 !important;
        max-width: 28rem !important;
    }

    .sp-hero-buttons a {
        box-shadow: 0 7px 18px rgba(37, 99, 235, .08);
    }

    .sp-hero-buttons a:first-child {
        box-shadow: 0 9px 22px rgba(51, 118, 242, .20);
    }

    .sp-hero-image {
        border: 0 !important;
        margin: 0 !important;
        box-shadow: none !important;
        filter: none !important;
    }

    @media (max-width: 1023px) {
        .sp-hero-wrap h1.sp-hero-title {
            font-size: 42px !important;
        }
    }

    @media (max-width: 767px) {
        .sp-hero-wrap h1.sp-hero-title {
            font-size: 34px !important;
        }
    }

    @media (max-width: 575px) {
        .sp-hero-buttons {
            width: 100%;
        }

        .sp-hero-buttons a {
            flex: 1;
            justify-content: center;
        }
    }


    /* ============================================================
       STARTUP SUMMARY CARD (scoped + !important to beat _styles.blade.php rules)
    ============================================================ */

    .sp-summary-card {
        padding: 24px 26px !important;
        border-radius: 20px !important;
    }

    .sp-summary-inner {
        gap: 18px !important;
    }

    .sp-logo,
    .sp-logo-fallback {
        width: 64px !important;
        height: 64px !important;
        min-width: 64px !important;
        border-radius: 16px !important;
        font-size: 22px !important;
    }

    .sp-summary-title {
        font-size: 20px !important;
        line-height: 1.35 !important;
    }

    .sp-summary-founder {
        font-size: 13.5px !important;
        margin-top: 2px !important;
    }

    .sp-status {
        font-size: 11.5px !important;
        padding: 5px 13px !important;
    }

    .sp-menu > summary {
        width: 33px !important;
        height: 33px !important;
    }

    .sp-meta {
        gap: 15px !important;
        margin-top: 12px !important;
    }

    .sp-meta-item {
        font-size: 13px !important;
        gap: 6px !important;
    }

    .sp-meta-item svg {
        width: 15px !important;
        height: 15px !important;
    }

    .sp-description {
        font-size: 13.5px !important;
        line-height: 1.6 !important;
        margin-top: 12px !important;
    }

    @media (max-width: 767px) {

        .sp-summary-card {
            padding: 19px !important;
            border-radius: 17px !important;
        }

        .sp-summary-inner {
            gap: 13px !important;
        }

        .sp-logo,
        .sp-logo-fallback {
            width: 55px !important;
            height: 55px !important;
            min-width: 55px !important;
        }

        .sp-summary-title {
            font-size: 17.5px !important;
        }
    }
</style>

<div class="sp-page bg-slate-50 min-h-screen">

    <div class="sp-hero-wrap bg-gradient-to-b from-[#F5F8FF] via-[#F5F8FF] to-white border-b border-slate-100">

        <div class="max-w-6xl mx-auto px-6 py-11 md:py-13 grid md:grid-cols-2 gap-7 lg:gap-9 items-center">

            <div class="flex flex-col items-start text-left">

                <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-blue-700 bg-blue-100/70 px-3.5 py-1.5 rounded-full mb-4">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M13 2 3 14h7l-1 8 11-14h-7l0-6z"/>
                    </svg>
                    GET INVESTOR READY
                </span>

                <h1 class="sp-hero-title max-w-lg">
                    Get Projects Done
                    <span>Hire Top Talent</span>
                </h1>

                <p class="sp-hero-sub">
                    Build a profile that appears on the Investor Portal alongside your job postings — so investors and admins see exactly who you are and what you're building.
                </p>

                <div class="sp-hero-buttons flex flex-wrap items-center gap-3">

                    @if (!empty($profile))

                        <a href="{{ route('employer.startup-profile.edit') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-6 py-3 rounded-xl transition hover:-translate-y-0.5">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 20h9"></path>
                                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4Z"></path>
                            </svg>
                            Edit Startup Profile
                        </a>

                        <a href="{{ route('employer.startup-profile.show') }}" class="inline-flex items-center gap-2 bg-white border border-slate-200 text-slate-600 hover:text-blue-600 hover:border-blue-300 text-sm font-semibold px-6 py-3 rounded-xl transition">
                            View Profile
                        </a>

                    @else

                        <a href="{{ route('employer.startup-profile.create') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-6 py-3 rounded-xl transition hover:-translate-y-0.5">
                            <span class="text-base leading-none">＋</span>
                            Create Startup Profile
                        </a>

                        <a href="{{ route('employer.jobs.index') }}" class="inline-flex items-center gap-2 bg-white border border-slate-200 text-slate-600 hover:text-blue-600 hover:border-blue-300 text-sm font-semibold px-6 py-3 rounded-xl transition">
                            Back to Jobs
                        </a>

                    @endif

                </div>

            </div>

            <div class="relative flex justify-center md:justify-end">

                <img src="{{ asset('assets/img/uuu.png') }}" alt="Showcase your startup" class="sp-hero-image w-full max-w-md lg:max-w-[420px] h-auto object-contain" onerror="this.style.display='none'">

                <div class="absolute top-4 left-0 md:-left-4 flex items-center gap-2 bg-white rounded-xl shadow-lg shadow-blue-900/10 px-3.5 py-2">
                    <span class="w-7 h-7 rounded-lg bg-blue-100 flex items-center justify-center shrink-0 text-blue-600 text-sm">✓</span>
                    <div>
                        <p class="text-xs font-semibold text-slate-800 leading-tight">Verified Startups</p>
                        <p class="text-[10px] text-slate-400 leading-tight">Admin-approved profiles</p>
                    </div>
                </div>

                <div class="absolute top-24 right-0 md:right-4 flex items-center gap-2 bg-white rounded-xl shadow-lg shadow-blue-900/10 px-3.5 py-2">
                    <span class="w-7 h-7 rounded-lg bg-violet-100 flex items-center justify-center shrink-0 text-violet-600 text-sm">◈</span>
                    <div>
                        <p class="text-xs font-semibold text-slate-800 leading-tight">Investor Ready</p>
                        <p class="text-[10px] text-slate-400 leading-tight">Profile-first discovery</p>
                    </div>
                </div>

                <div class="absolute bottom-6 left-0 md:-left-6 flex items-center gap-2 bg-white rounded-xl shadow-lg shadow-blue-900/10 px-3.5 py-2">
                    <span class="w-7 h-7 rounded-lg bg-emerald-100 flex items-center justify-center shrink-0 text-emerald-600 text-sm">⚡</span>
                    <div>
                        <p class="text-xs font-semibold text-slate-800 leading-tight">Faster Funding</p>
                        <p class="text-[10px] text-slate-400 leading-tight">Get noticed sooner</p>
                    </div>
                </div>

            </div>

        </div>
    </div>


    <div class="sp-wrap" style="max-width:1152px;">

        @if (session('success'))
            <div class="sp-alert sp-alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="sp-alert sp-alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="sp-content-layout">

            <div class="sp-main-col">

                @if (!empty($profile))

                    <article class="sp-summary-card">
                        <div class="sp-summary-inner">

                            <div>
                                @if ($profile->logo_path)
                                    <img src="{{ asset('storage/' . $profile->logo_path) }}" alt="{{ $profile->startup_name }}" class="sp-logo">
                                @else
                                    <span class="sp-logo-fallback">
                                        {{ strtoupper(substr(trim($profile->startup_name ?? 'S'), 0, 1)) }}
                                    </span>
                                @endif
                            </div>

                            <div class="sp-summary-content">

                                <div class="sp-summary-top">

                                    <div class="min-w-0">
                                        <h2 class="sp-summary-title">{{ $profile->startup_name }}</h2>
                                        <p class="sp-summary-founder">Founded by {{ $profile->founder_name }}</p>
                                    </div>

                                    <div class="flex items-center gap-2">

                                        <span class="sp-status sp-status-{{ $profile->status }}">
                                            {{ $profile->status }}
                                        </span>

                                        <details class="sp-menu">
                                            <summary>
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                                    <circle cx="12" cy="5" r="1.8"></circle>
                                                    <circle cx="12" cy="12" r="1.8"></circle>
                                                    <circle cx="12" cy="19" r="1.8"></circle>
                                                </svg>
                                            </summary>

                                            <div class="sp-menu-panel">

                                                <a href="{{ route('employer.startup-profile.show') }}">
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                        <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z"></path>
                                                        <circle cx="12" cy="12" r="3"></circle>
                                                    </svg>
                                                    View Profile
                                                </a>

                                                <a href="{{ route('employer.startup-profile.edit') }}">
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                        <path d="M12 20h9"></path>
                                                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4Z"></path>
                                                    </svg>
                                                    Edit Profile
                                                </a>

                                                <div class="sp-menu-divider"></div>

                                                <button type="button" id="spDeleteBtn" class="sp-menu-danger">
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                        <path d="M3 6h18"></path>
                                                        <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2m3 0v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6h14Z"></path>
                                                        <path d="M10 11v6M14 11v6"></path>
                                                    </svg>
                                                    Delete Profile
                                                </button>

                                            </div>
                                        </details>

                                    </div>

                                </div>

                                <div class="sp-meta">

                                    @if ($profile->industry)
                                        <span class="sp-meta-item">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <rect x="3" y="7" width="18" height="13" rx="2"></rect>
                                                <path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            </svg>
                                            {{ $profile->industry }}
                                        </span>
                                    @endif

                                    @if ($profile->team_size)
                                        <span class="sp-meta-item">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                                <circle cx="9" cy="7" r="4"></circle>
                                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                            </svg>
                                            {{ $profile->team_size }}
                                        </span>
                                    @endif

                                    @if ($profile->funding_required)
                                        <span class="sp-meta-item" style="color:var(--sp-green); font-weight:600;">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7H14a3.5 3.5 0 0 1 0 7H6"></path>
                                            </svg>
                                            {{ $profile->funding_required }}
                                        </span>
                                    @endif

                                    @php
                                        $spLocation = collect([$profile->city, $profile->district, $profile->state, $profile->country])
                                            ->filter()->implode(', ');
                                    @endphp

                                    @if ($spLocation)
                                        <span class="sp-meta-item">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M12 21s-7-6.1-7-11a7 7 0 0 1 14 0c0 4.9-7 11-7 11z"></path>
                                                <circle cx="12" cy="10" r="2.5"></circle>
                                            </svg>
                                            {{ $spLocation }}
                                        </span>
                                    @endif

                                </div>

                                @if ($profile->business_description)
                                    <p class="sp-description">{{ $profile->business_description }}</p>
                                @endif

                                @if ($profile->status === 'rejected' && $profile->rejection_reason)
                                    <div class="sp-rejection-inline">
                                        <strong>Rejected:</strong> {{ $profile->rejection_reason }}
                                    </div>
                                @endif

                            </div>

                        </div>
                    </article>

                @else

                    <div class="sp-empty">

                        <div class="sp-empty-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="5" width="18" height="14" rx="2"></rect>
                                <path d="M8 10h8M8 14h5"></path>
                            </svg>
                        </div>

                        <h3>No startup profile yet</h3>
                        <p>Create your profile to get listed on the Investor Portal alongside your job postings.</p>

                        <a href="{{ route('employer.startup-profile.create') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-6 py-3 rounded-xl transition">
                            + Create Startup Profile
                        </a>

                    </div>

                @endif

                @if (!empty($profile))
                    <form id="spDeleteForm" action="{{ route('employer.startup-profile.destroy') }}" method="POST" style="display:none;">
                        @csrf
                        @method('DELETE')
                    </form>
                @endif

            </div>

            <aside class="sp-sidebar-col">

                <div class="sp-sidebar-cta">

                    @if (!empty($profile))
                        <h3>Keep it up to date</h3>
                        <p>A fresh, complete profile helps investors take your startup seriously.</p>
                        <a href="{{ route('employer.startup-profile.edit') }}">Edit Profile →</a>
                    @else
                        <h3>Get investor ready</h3>
                        <p>Create your startup profile and get listed on the Investor Portal in minutes.</p>
                        <a href="{{ route('employer.startup-profile.create') }}">Create Profile →</a>
                    @endif

                </div>

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

            </aside>

        </div>

    </div>

</div>

@include('employers.startup-profile._scripts')

@endsection
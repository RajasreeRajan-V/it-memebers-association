@extends('layouts.app')

@section('content')
<div class="inquiries-page">
    <div class="container">
        <div class="inquiries-shell">

            {{-- ===== Page Header ===== --}}
            <div class="inquiries-header">
                <div class="header-left">
                    <span class="header-eyebrow">
                        <i class="bi bi-inbox-fill"></i> Freelancer Dashboard
                    </span>
                    <h1 class="header-title">Service Inquiries</h1>
                    <p class="header-subtitle">
                        Employer messages about your listed services.
                    </p>
                </div>
                <div class="header-right">
                    <div class="stat-pill">
                        <span class="stat-value">{{ $inquiries->total() }}</span>
                        <span class="stat-label">{{ Str::plural('inquiry', $inquiries->total()) }}</span>
                    </div>
                </div>
            </div>

            {{-- ===== Inquiry list ===== --}}
            @forelse ($inquiries as $inquiry)
                <article class="inquiry-card">
                    <div class="inquiry-top">
                        <div class="inquiry-sender">
                            <div class="avatar">
                                {{ strtoupper(substr($inquiry->user->name ?? 'U', 0, 1)) }}
                            </div>
                            <div class="sender-meta">
                                <p class="sender-name">
                                    {{ $inquiry->user->name ?? 'Unknown employer' }}
                                </p>
                                @if ($inquiry->user?->email)
                                    <p class="sender-email">
                                        <i class="bi bi-envelope"></i>
                                        {{ $inquiry->user->email }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <time class="inquiry-time" datetime="{{ $inquiry->created_at->toIso8601String() }}">
                            <i class="bi bi-clock"></i>
                            {{ $inquiry->created_at->diffForHumans() }}
                        </time>
                    </div>

                    <div class="inquiry-service">
                        <span class="service-label"><i class="bi bi-briefcase"></i> Regarding service</span>
                        <a href="{{ route('freelancer.services.edit', $inquiry->service) }}" class="service-link">
                            {{ $inquiry->service->title }}
                            <i class="bi bi-box-arrow-up-right"></i>
                        </a>
                    </div>

                    <div class="inquiry-message">
                        {!! nl2br(e($inquiry->message)) !!}
                    </div>

                    <div class="inquiry-actions">
                        @if ($inquiry->user?->email)
                            <a
                                href="mailto:{{ $inquiry->user->email }}?subject={{ rawurlencode('Re: ' . $inquiry->service->title) }}"
                                class="btn-reply"
                            >
                                <i class="bi bi-reply-fill"></i> Reply by email
                            </a>
                        @else
                            <span class="no-reply">No email on file</span>
                        @endif
                    </div>
                </article>
            @empty
                <div class="empty-state">
                    <div class="empty-icon"><i class="bi bi-chat-square-text"></i></div>
                    <h3>No inquiries yet</h3>
                    <p>When an employer reaches out about one of your services, you'll see their message here.</p>
                </div>
            @endforelse

            {{-- ===== Pagination ===== --}}
            @if ($inquiries->hasPages())
                <div class="inquiries-pagination">
                    {{ $inquiries->links() }}
                </div>
            @endif

        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* =====================================================
       SERVICE INQUIRIES — page-scoped styling
    ===================================================== */
    .inquiries-page {
        padding: 3rem 0 4rem;
        background: #f7f8fb;
        min-height: 60vh;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        color: #1f2333;
    }

    .inquiries-page .container {
        max-width: 1080px;
        margin: 0 auto;
        padding: 0 1.25rem;
    }

    .inquiries-shell {
        max-width: 880px;
        margin: 0 auto;
    }

    /* ===== Header ===== */
    .inquiries-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 1.5rem;
        flex-wrap: wrap;
        margin-bottom: 2rem;
    }

    .header-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.78rem;
        font-weight: 600;
        letter-spacing: 0.04em;
        text-transform: uppercase;
        color: #4a6cf7;
        background: rgba(74, 108, 247, 0.08);
        padding: 0.3rem 0.7rem;
        border-radius: 20px;
        margin-bottom: 0.75rem;
    }

    .header-title {
        font-family: 'Poppins', sans-serif;
        font-size: 1.85rem;
        font-weight: 700;
        letter-spacing: -0.5px;
        color: #1a1a2e;
        margin: 0 0 0.35rem;
        line-height: 1.2;
    }

    .header-subtitle {
        font-size: 0.95rem;
        color: #6b7086;
        margin: 0;
    }

    .stat-pill {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: #fff;
        border: 1px solid #e6e9f2;
        border-radius: 14px;
        padding: 0.85rem 1.5rem;
        min-width: 110px;
        box-shadow: 0 2px 10px rgba(31, 35, 51, 0.04);
    }

    .stat-value {
        font-family: 'Poppins', sans-serif;
        font-size: 1.65rem;
        font-weight: 700;
        color: #4a6cf7;
        line-height: 1;
    }

    .stat-label {
        font-size: 0.72rem;
        font-weight: 600;
        color: #8a8fa8;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-top: 0.3rem;
    }

    /* ===== Card ===== */
    .inquiry-card {
        background: #fff;
        border: 1px solid #e6e9f2;
        border-radius: 16px;
        padding: 1.5rem 1.75rem;
        margin-bottom: 1rem;
        box-shadow: 0 1px 3px rgba(31, 35, 51, 0.03);
        transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
    }

    .inquiry-card:hover {
        border-color: #cfd7f0;
        box-shadow: 0 8px 28px rgba(74, 108, 247, 0.08);
        transform: translateY(-2px);
    }

    /* ===== Top row ===== */
    .inquiry-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
        margin-bottom: 1.15rem;
    }

    .inquiry-sender {
        display: flex;
        align-items: center;
        gap: 0.85rem;
    }

    .avatar {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: linear-gradient(135deg, #4a6cf7, #6a4cf7);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1rem;
        flex-shrink: 0;
        box-shadow: 0 3px 10px rgba(74, 108, 247, 0.25);
    }

    .sender-meta { line-height: 1.35; }

    .sender-name {
        font-family: 'Poppins', sans-serif;
        font-size: 1rem;
        font-weight: 600;
        color: #1a1a2e;
        margin: 0;
    }

    .sender-email {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        font-size: 0.82rem;
        color: #8a8fa8;
        margin: 0.15rem 0 0;
    }

    .sender-email i { font-size: 0.75rem; }

    .inquiry-time {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        font-size: 0.78rem;
        font-weight: 500;
        color: #8a8fa8;
        background: #f4f6fb;
        padding: 0.3rem 0.7rem;
        border-radius: 20px;
        white-space: nowrap;
    }

    .inquiry-time i { font-size: 0.72rem; }

    /* ===== Service row ===== */
    .inquiry-service {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 0.5rem;
        padding: 0.7rem 0.9rem;
        background: #f7f8fb;
        border: 1px solid #eef0f7;
        border-radius: 10px;
        margin-bottom: 1rem;
        font-size: 0.85rem;
    }

    .service-label {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        color: #8a8fa8;
        font-weight: 500;
    }

    .service-label i { font-size: 0.78rem; }

    .service-link {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        color: #4a6cf7;
        font-weight: 600;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .service-link:hover {
        color: #2f4dd4;
        text-decoration: underline;
    }

    .service-link i { font-size: 0.72rem; opacity: 0.8; }

    /* ===== Message body ===== */
    .inquiry-message {
        font-size: 0.92rem;
        line-height: 1.7;
        color: #3d4259;
        margin-bottom: 1.15rem;
        padding-left: 0.15rem;
        word-break: break-word;
    }

    /* ===== Actions ===== */
    .inquiry-actions {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding-top: 1rem;
        border-top: 1px solid #f0f2f8;
    }

    .btn-reply {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.85rem;
        font-weight: 600;
        color: #fff;
        background: #4a6cf7;
        border: 1px solid #4a6cf7;
        padding: 0.55rem 1.15rem;
        border-radius: 9px;
        text-decoration: none;
        transition: all 0.2s ease;
        box-shadow: 0 2px 8px rgba(74, 108, 247, 0.25);
    }

    .btn-reply:hover {
        background: #3a5ce0;
        border-color: #3a5ce0;
        color: #fff;
        box-shadow: 0 4px 14px rgba(74, 108, 247, 0.35);
        transform: translateY(-1px);
    }

    .btn-reply i { font-size: 0.8rem; }

    .no-reply {
        font-size: 0.82rem;
        color: #a5aabf;
        font-style: italic;
    }

    /* ===== Empty state ===== */
    .empty-state {
        background: #fff;
        border: 1px dashed #cfd7f0;
        border-radius: 16px;
        padding: 3.5rem 1.5rem;
        text-align: center;
    }

    .empty-icon {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background: rgba(74, 108, 247, 0.08);
        color: #4a6cf7;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
        margin: 0 auto 1.1rem;
    }

    .empty-state h3 {
        font-family: 'Poppins', sans-serif;
        font-size: 1.15rem;
        font-weight: 600;
        color: #1a1a2e;
        margin: 0 0 0.4rem;
    }

    .empty-state p {
        font-size: 0.9rem;
        color: #8a8fa8;
        max-width: 420px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* ===== Pagination ===== */
    .inquiries-pagination {
        margin-top: 2rem;
        display: flex;
        justify-content: center;
    }

    .inquiries-pagination nav > div:first-child {
        font-size: 0.82rem;
        color: #8a8fa8;
    }

    .inquiries-pagination .pagination {
        display: inline-flex;
        gap: 4px;
        flex-wrap: wrap;
        justify-content: center;
        margin: 0;
    }

    .inquiries-pagination .page-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 36px;
        height: 36px;
        padding: 0 0.6rem;
        border-radius: 8px !important;
        border: 1px solid #e6e9f2;
        background: #fff;
        color: #5a5f7a;
        font-size: 0.84rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .inquiries-pagination .page-link:hover {
        border-color: #4a6cf7;
        color: #4a6cf7;
        background: rgba(74, 108, 247, 0.05);
    }

    .inquiries-pagination .page-item.active .page-link {
        background: #4a6cf7;
        border-color: #4a6cf7;
        color: #fff;
        box-shadow: 0 2px 8px rgba(74, 108, 247, 0.3);
    }

    .inquiries-pagination .page-item.disabled .page-link {
        opacity: 0.45;
        cursor: not-allowed;
    }

    /* ===== Responsive ===== */
    @media (max-width: 640px) {
        .inquiries-page { padding: 1.75rem 0 2.5rem; }
        .inquiries-header { align-items: flex-start; }
        .header-title { font-size: 1.5rem; }
        .stat-pill { align-self: stretch; flex-direction: row; gap: 0.5rem; min-width: 0; }
        .stat-label { margin-top: 0; }
        .inquiry-card { padding: 1.15rem 1.15rem; border-radius: 14px; }
        .inquiry-top { gap: 0.75rem; }
        .inquiry-actions { flex-direction: column; align-items: stretch; }
        .btn-reply { justify-content: center; }
    }
</style>
@endpush
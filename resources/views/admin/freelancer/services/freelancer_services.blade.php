@extends('admin.layout.app')

@section('title', 'Service Review Queue')
@section('page-title', 'Service Review Queue')
@section('page-subtitle', $services->total() . ' pending')

@push('styles')
<style>
    .review-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
    }

    .review-header h1 {
        font-size: 1.4rem;
        font-weight: 700;
        color: #1a1a2e;
        letter-spacing: -0.3px;
    }

    .review-header .count-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        background: rgba(74, 108, 247, 0.1);
        color: #4a6cf7;
        font-size: 0.8rem;
        font-weight: 600;
        padding: 0.35rem 0.8rem;
        border-radius: 20px;
    }

    .status-alert {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.9rem 1.2rem;
        border-radius: 10px;
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
        color: #065f46;
        font-size: 0.9rem;
        margin-bottom: 1.5rem;
        animation: slideDown 0.3s ease;
    }

    .status-alert i { color: #10b981; font-size: 1.1rem; }

    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-8px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* ===== Review card ===== */
    .review-card {
        background: #fff;
        border: 1px solid #e9edf4;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
        transition: box-shadow 0.2s ease, border-color 0.2s ease;
    }

    .review-card:hover {
        box-shadow: 0 6px 20px rgba(74, 108, 247, 0.08);
        border-color: #d5ddf5;
    }

    .review-card .card-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 1rem;
        margin-bottom: 0.5rem;
        flex-wrap: wrap;
    }

    .review-card h2 {
        font-size: 1.15rem;
        font-weight: 600;
        color: #1a1a2e;
        letter-spacing: -0.2px;
        margin: 0;
    }

    .meta-line {
        font-size: 0.82rem;
        color: #8a8fa8;
        margin-bottom: 0.75rem;
        display: flex;
        flex-wrap: wrap;
        gap: 0.4rem 1rem;
    }

    .meta-line .meta-item {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
    }

    .meta-line i {
        color: #b0b5c8;
        font-size: 0.75rem;
    }

    .price-tag {
        color: #4a6cf7;
        font-weight: 600;
    }

    .review-card .description {
        font-size: 0.9rem;
        color: #3d4259;
        line-height: 1.65;
        margin-bottom: 0.9rem;
    }

    .chips {
        display: flex;
        flex-wrap: wrap;
        gap: 0.4rem;
        margin-bottom: 1rem;
    }

    .chip {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        font-size: 0.75rem;
        font-weight: 500;
        color: #5a5f7a;
        background: #f0f2f5;
        border: 1px solid #e9edf4;
        padding: 0.25rem 0.65rem;
        border-radius: 20px;
    }

    .chip i { font-size: 0.7rem; color: #8a8fa8; }

    .portfolio-link {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.82rem;
        font-weight: 500;
        color: #4a6cf7;
        text-decoration: none;
        margin-bottom: 1rem;
    }

    .portfolio-link:hover { text-decoration: underline; }

    .review-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        align-items: center;
        padding-top: 1rem;
        border-top: 1px solid #f0f2f5;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        font: inherit;
        font-size: 0.85rem;
        font-weight: 600;
        padding: 0.55rem 1.1rem;
        border-radius: 8px;
        border: 1px solid transparent;
        cursor: pointer;
        transition: all 0.2s ease;
        white-space: nowrap;
    }

    .btn i { font-size: 0.8rem; }

    .btn-approve {
        background: #10b981;
        color: #fff;
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.25);
    }

    .btn-approve:hover {
        background: #059669;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        transform: translateY(-1px);
    }

    .btn-reject {
        background: #ef4444;
        color: #fff;
        box-shadow: 0 2px 8px rgba(239, 68, 68, 0.25);
    }

    .btn-reject:hover {
        background: #dc2626;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        transform: translateY(-1px);
    }

    .reject-form {
        display: flex;
        gap: 0.5rem;
        flex: 1;
        min-width: 280px;
        align-items: center;
    }

    .reject-form input[type="text"] {
        flex: 1;
        font: inherit;
        font-size: 0.85rem;
        padding: 0.55rem 0.85rem;
        border: 1px solid #e9edf4;
        border-radius: 8px;
        background: #f8f9fb;
        color: #1a1a2e;
        transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
        min-width: 0;
    }

    .reject-form input[type="text"]:focus {
        outline: none;
        border-color: #4a6cf7;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(74, 108, 247, 0.12);
    }

    .reject-form input[type="text"]::placeholder {
        color: #a5aabf;
    }

    /* ===== Empty state ===== */
    .empty-state {
        text-align: center;
        padding: 3rem 1.5rem;
        background: #fff;
        border: 1px dashed #d5ddf5;
        border-radius: 12px;
        color: #8a8fa8;
    }

    .empty-state i {
        font-size: 2.5rem;
        color: #c5cbe0;
        margin-bottom: 1rem;
        display: block;
    }

    .empty-state p {
        font-size: 0.95rem;
        font-weight: 500;
    }

    /* ===== Pagination wrapper ===== */
    .pagination-wrap {
        margin-top: 1.5rem;
        display: flex;
        justify-content: center;
    }

    /* Style Laravel default pagination to match admin theme */
    .pagination-wrap nav > div:first-child {
        display: none; /* hide "Showing x of y" on small screens, optional */
    }

    .pagination-wrap .pagination,
    .pagination-wrap nav svg {
        display: inline-block;
    }

    .pagination-wrap nav > div {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
        font-size: 0.82rem;
        color: #8a8fa8;
    }

    .pagination-wrap nav a,
    .pagination-wrap nav span[aria-current="page"] span,
    .pagination-wrap nav span[aria-disabled="true"] span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 34px;
        height: 34px;
        padding: 0 0.5rem;
        margin: 0 2px;
        border-radius: 8px;
        border: 1px solid #e9edf4;
        background: #fff;
        color: #5a5f7a;
        font-size: 0.82rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .pagination-wrap nav a:hover {
        border-color: #4a6cf7;
        color: #4a6cf7;
        background: rgba(74, 108, 247, 0.05);
    }

    .pagination-wrap nav span[aria-current="page"] span {
        background: #4a6cf7;
        border-color: #4a6cf7;
        color: #fff;
        box-shadow: 0 2px 8px rgba(74, 108, 247, 0.3);
    }

    .pagination-wrap nav span[aria-disabled="true"] span {
        opacity: 0.4;
        cursor: not-allowed;
    }

    @media (max-width: 768px) {
        .review-card { padding: 1.15rem; }
        .review-actions { flex-direction: column; align-items: stretch; }
        .reject-form { min-width: 0; }
        .reject-form input[type="text"] { width: 100%; }
    }
</style>
@endpush

@section('content')

    <div class="review-header">
        <h1>Review Queue</h1>
        <span class="count-pill">
            <i class="fas fa-inbox"></i>
            {{ $services->total() }} pending {{ Str::plural('service', $services->total()) }}
        </span>
    </div>

    @if (session('status'))
        <div class="status-alert">
            <i class="fas fa-check-circle"></i>
            {{ session('status') }}
        </div>
    @endif

    @forelse ($services as $s)
        <div class="review-card">
            <div class="card-top">
                <h2>{{ $s->title }}</h2>
            </div>

            <div class="meta-line">
                <span class="meta-item"><i class="fas fa-folder"></i> {{ $s->category }}</span>
                <span class="meta-item"><i class="fas fa-user"></i> {{ $s->user->name }}</span>
                <span class="meta-item price-tag"><i class="fas fa-tag"></i> {{ $s->price }}</span>
                <span class="meta-item"><i class="fas fa-clock"></i> {{ $s->delivery_days }} days delivery</span>
            </div>

            <p class="description">{{ $s->description }}</p>

            <div class="chips">
                @if ($s->skills)
                    @foreach (array_map('trim', explode(',', $s->skills)) as $skill)
                        @if ($skill !== '')
                            <span class="chip"><i class="fas fa-check"></i> {{ $skill }}</span>
                        @endif
                    @endforeach
                @endif
                <span class="chip"><i class="fas fa-rotate"></i> {{ $s->revision_policy }}</span>
            </div>

            @if ($s->portfolio_url)
                <a href="{{ $s->portfolio_url }}" target="_blank" rel="noopener" class="portfolio-link">
                    <i class="fas fa-arrow-up-right-from-square"></i> View portfolio
                </a>
            @endif

            <div class="review-actions">
                <form method="POST" action="{{ route('admin.services.approve', $s) }}">
                    @csrf
                    <button type="submit" class="btn btn-approve">
                        <i class="fas fa-check"></i> Approve
                    </button>
                </form>

                <form method="POST" action="{{ route('admin.services.reject', $s) }}" class="reject-form">
                    @csrf
                    <input type="text" name="rejection_reason" placeholder="Reason for rejection" required>
                    <button type="submit" class="btn btn-reject">
                        <i class="fas fa-xmark"></i> Reject
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div class="empty-state">
            <i class="fas fa-circle-check"></i>
            <p>Nothing to review — the queue is all caught up.</p>
        </div>
    @endforelse

    @if ($services->hasPages())
        <div class="pagination-wrap">
            {{ $services->links() }}
        </div>
    @endif

@endsection
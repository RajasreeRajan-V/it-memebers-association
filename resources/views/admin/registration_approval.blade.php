@extends('admin.layout.app')

@section('title', 'Registration Approvals')
@section('page-title', 'Registration Approvals')

@push('styles')
<style>
    /* ============================================
       TABLE CARD CONTAINER
    ============================================ */
    .approval-container {
        background: #DAD9E7;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(35, 25, 50, 0.08), 0 1px 2px rgba(35, 25, 50, 0.04);
        border: 1px solid rgba(60, 82, 123, 0.1);
        overflow: hidden;
        margin-top: 1.25rem;
    }

    /* ============================================
       FILTER BAR (above table)
    ============================================ */
    .approval-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 0.75rem 1.5rem;
        padding: 1rem 1.5rem;
        background: rgba(218, 217, 231, 0.6);
        border-bottom: 1px solid rgba(60, 82, 123, 0.08);
    }

    .approval-toolbar .left {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9rem;
        font-weight: 600;
        color: #231932;
        flex-wrap: wrap;
    }

    .approval-toolbar .count-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 28px;
        height: 28px;
        padding: 0 0.65rem;
        border-radius: 999px;
        background: #504482;
        color: #DAD9E7;
        font-size: 0.75rem;
        font-weight: 700;
    }

    .approval-toolbar .right {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .approval-toolbar .filter-select {
        padding: 0.4rem 2rem 0.4rem 0.75rem;
        border: 1px solid rgba(60, 82, 123, 0.2);
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 500;
        color: #231932;
        background: #DAD9E7 url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6'%3E%3Cpath d='M0 0l5 6 5-6z' fill='%23504482'/%3E%3C/svg%3E") no-repeat right 0.7rem center;
        appearance: none;
        cursor: pointer;
        transition: border-color 0.15s, box-shadow 0.15s;
    }

    .approval-toolbar .filter-select:focus {
        outline: none;
        border-color: #504482;
        box-shadow: 0 0 0 3px rgba(80, 68, 130, 0.1);
    }

    .approval-toolbar .filter-select:hover {
        border-color: #3C527B;
    }

    /* ============================================
       TABLE
    ============================================ */
    .approval-table-wrap {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .approval-table {
        width: 100%;
        min-width: 720px;
        border-collapse: collapse;
        font-size: 0.875rem;
        background: #DAD9E7;
    }

    .approval-table thead th {
        padding: 0.75rem 1.25rem;
        text-align: left;
        font-weight: 600;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        color: #3A5079;
        background: rgba(218, 217, 231, 0.8);
        border-bottom: 1px solid rgba(60, 82, 123, 0.1);
        position: sticky;
        top: 0;
        z-index: 1;
        white-space: nowrap;
    }

    .approval-table thead th:first-child {
        padding-left: 1.5rem;
    }
    .approval-table thead th:last-child {
        padding-right: 1.5rem;
    }

    .approval-table tbody tr {
        transition: background-color 0.12s ease;
    }

    .approval-table tbody tr:hover {
        background: rgba(80, 68, 130, 0.04);
    }

    .approval-table tbody td {
        padding: 0.9rem 1.25rem;
        border-bottom: 1px solid rgba(60, 82, 123, 0.06);
        vertical-align: top;
        color: #231932;
    }

    .approval-table tbody td:first-child {
        padding-left: 1.5rem;
    }
    .approval-table tbody td:last-child {
        padding-right: 1.5rem;
    }

    /* ============================================
       ROW DATA
    ============================================ */
    .col-no {
        text-align: center;
        color: #3A5079;
        font-weight: 600;
        font-size: 0.8rem;
        width: 48px;
    }

    .user-name {
        font-weight: 600;
        color: #231932;
    }

    .user-email {
        font-size: 0.78rem;
        color: #3A5079;
        display: block;
        margin-top: 0.1rem;
    }

    .user-phone {
        font-size: 0.75rem;
        color: #3C527B;
        margin-top: 0.05rem;
    }

    /* ============================================
       BADGES
    ============================================ */
    .badge-role {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.2rem 0.6rem;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: capitalize;
        background: rgba(80, 68, 130, 0.12);
        color: #504482;
        white-space: nowrap;
    }

    .badge-pending {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.2rem 0.6rem;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 600;
        background: rgba(218, 217, 231, 0.5);
        color: #3C527B;
        white-space: nowrap;
    }

    .badge-pending::before {
        content: '';
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #504482;
        animation: pulse-dot 1.6s ease-in-out infinite;
    }

    @keyframes pulse-dot {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.4; transform: scale(0.7); }
    }

    /* ============================================
       ACTION BUTTONS - GREEN APPROVE / RED REJECT
    ============================================ */
    .action-group {
        display: flex;
        flex-wrap: wrap;
        gap: 0.4rem;
        align-items: center;
        justify-content: flex-end;
    }

    .btn-sm {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        border: none;
        padding: 0.35rem 0.8rem;
        border-radius: 6px;
        font-size: 0.72rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.15s ease;
        text-decoration: none;
        white-space: nowrap;
    }

    .btn-sm:active {
        transform: scale(0.96);
    }

    /* Approve Button - Green */
    .btn-approve {
        background: #16a34a;
        color: #ffffff;
        box-shadow: 0 1px 2px rgba(22, 163, 74, 0.25);
    }
    .btn-approve:hover {
        background: #15803d;
        box-shadow: 0 2px 4px rgba(22, 163, 74, 0.3);
        transform: translateY(-1px);
    }
    .btn-approve:active {
        transform: scale(0.96) translateY(0);
    }

    /* Reject Button - Red */
    .btn-reject {
        background: #dc2626;
        color: #ffffff;
        box-shadow: 0 1px 2px rgba(220, 38, 38, 0.25);
    }
    .btn-reject:hover {
        background: #b91c1c;
        box-shadow: 0 2px 4px rgba(220, 38, 38, 0.3);
        transform: translateY(-1px);
    }
    .btn-reject:active {
        transform: scale(0.96) translateY(0);
    }

    /* Details Button - Neutral */
    .btn-details {
        background: rgba(218, 217, 231, 0.5);
        color: #231932;
        border: 1px solid rgba(60, 82, 123, 0.15);
    }
    .btn-details:hover {
        background: rgba(218, 217, 231, 0.8);
        border-color: #3C527B;
    }

    /* ============================================
       DETAILS ROW (expanded)
    ============================================ */
    tr.details-row td {
        background: rgba(218, 217, 231, 0.4);
        padding: 0 1.5rem 1rem 1.5rem;
        border-bottom: 1px solid rgba(60, 82, 123, 0.08);
    }

    tr.details-row.is-hidden {
        display: none;
    }

    .detail-toggle-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        background: none;
        border: none;
        color: #504482;
        font-weight: 600;
        font-size: 0.8rem;
        cursor: pointer;
        padding: 0.3rem 0;
        transition: color 0.15s;
    }

    .detail-toggle-btn:hover {
        color: #3C527B;
    }

    .detail-toggle-btn i {
        transition: transform 0.2s ease;
        font-size: 0.7rem;
    }

    .detail-toggle-btn[aria-expanded="true"] i {
        transform: rotate(180deg);
    }

    .detail-panel {
        background: #DAD9E7;
        border: 1px solid rgba(60, 82, 123, 0.08);
        border-radius: 8px;
        padding: 1rem 1.25rem;
        margin-top: 0.5rem;
    }

    /* ============================================
       DETAIL GRID
    ============================================ */
    .detail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 0.6rem 1.5rem;
        font-size: 0.85rem;
    }

    .detail-grid .field .label {
        display: block;
        font-size: 0.65rem;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        color: #3A5079;
        margin-bottom: 0.1rem;
    }

    .detail-grid .field .value {
        color: #231932;
        font-weight: 500;
        word-break: break-word;
    }

    .detail-grid .field .value a {
        color: #504482;
        text-decoration: none;
        font-weight: 600;
    }

    .detail-grid .field .value a:hover {
        text-decoration: underline;
    }

    /* ============================================
       DOCUMENTS SECTION
    ============================================ */
    .doc-section {
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px dashed rgba(60, 82, 123, 0.15);
    }

    .doc-section-title {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        color: #3A5079;
        margin-bottom: 0.7rem;
    }

    .doc-list {
        display: flex;
        flex-wrap: wrap;
        gap: 0.65rem;
    }

    .doc-card {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        background: #DAD9E7;
        border: 1px solid rgba(60, 82, 123, 0.1);
        border-radius: 8px;
        padding: 0.45rem 0.6rem 0.45rem 0.5rem;
        min-width: 200px;
        max-width: 280px;
        transition: border-color 0.15s, box-shadow 0.15s;
    }

    .doc-card:hover {
        border-color: #504482;
        box-shadow: 0 1px 3px rgba(35, 25, 50, 0.06);
    }

    .doc-icon {
        width: 34px;
        height: 34px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        flex-shrink: 0;
    }

    .doc-icon--pdf {
        background: rgba(60, 82, 123, 0.1);
        color: #3C527B;
    }
    .doc-icon--image {
        background: rgba(80, 68, 130, 0.1);
        color: #504482;
    }
    .doc-icon--doc {
        background: rgba(80, 68, 130, 0.08);
        color: #3C527B;
    }
    .doc-icon--file {
        background: rgba(218, 217, 231, 0.5);
        color: #3A5079;
    }

    .doc-info {
        flex: 1;
        min-width: 0;
    }

    .doc-label {
        font-size: 0.7rem;
        font-weight: 600;
        color: #231932;
        display: block;
    }

    .doc-filename {
        font-size: 0.65rem;
        color: #3A5079;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 130px;
        display: block;
    }

    .doc-view-link {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        font-size: 0.65rem;
        font-weight: 700;
        color: #DAD9E7;
        background: #504482;
        border: 1px solid #504482;
        padding: 0.2rem 0.5rem;
        border-radius: 5px;
        text-decoration: none;
        flex-shrink: 0;
        transition: background 0.15s, color 0.15s;
    }

    .doc-view-link:hover {
        background: #3C527B;
        border-color: #3C527B;
        color: #DAD9E7;
    }

    .doc-empty {
        font-size: 0.8rem;
        color: #3A5079;
        font-style: italic;
        margin: 0;
    }

    /* ============================================
       EMPTY STATE
    ============================================ */
    .empty-state {
        text-align: center;
        padding: 3.5rem 1rem;
        color: #3A5079;
    }

    .empty-state .icon {
        font-size: 2rem;
        color: #16a34a;
        display: block;
        margin-bottom: 0.5rem;
    }

    .empty-state .title {
        font-size: 1rem;
        font-weight: 600;
        color: #231932;
        margin: 0 0 0.25rem;
    }

    .empty-state .sub {
        font-size: 0.85rem;
        color: #3A5079;
    }

    /* ============================================
       PAGINATION
    ============================================ */
    .pagination-wrap {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.3rem;
        padding: 1rem 1.5rem;
        border-top: 1px solid rgba(60, 82, 123, 0.08);
        background: rgba(218, 217, 231, 0.6);
        flex-wrap: wrap;
    }

    .pagination-wrap a,
    .pagination-wrap span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 34px;
        height: 34px;
        padding: 0 0.6rem;
        border-radius: 6px;
        border: 1px solid rgba(60, 82, 123, 0.1);
        font-size: 0.8rem;
        font-weight: 600;
        text-decoration: none;
        color: #504482;
        background: #DAD9E7;
        transition: background 0.12s, border-color 0.12s;
    }

    .pagination-wrap a:hover {
        background: rgba(80, 68, 130, 0.08);
        border-color: #504482;
    }

    .pagination-wrap .active {
        background: #504482;
        color: #DAD9E7;
        border-color: #504482;
    }

    .pagination-wrap .disabled {
        color: #3A5079;
        background: rgba(218, 217, 231, 0.3);
        cursor: default;
        border-color: rgba(60, 82, 123, 0.05);
        opacity: 0.5;
    }

    .pagination-wrap .dots {
        border: none;
        background: transparent;
        color: #3A5079;
        min-width: auto;
    }

    /* ============================================
       MOBILE RESPONSIVE - CARD LAYOUT
    ============================================ */
    @media (max-width: 992px) {
        .approval-toolbar {
            flex-direction: column;
            align-items: stretch;
            padding: 0.75rem 1rem;
            gap: 0.5rem;
        }

        .approval-toolbar .left {
            justify-content: center;
            font-size: 0.85rem;
        }

        .approval-toolbar .right {
            width: 100%;
        }

        .approval-toolbar .filter-select {
            width: 100%;
        }

        .action-group {
            flex-direction: column;
            align-items: stretch;
            gap: 0.3rem;
        }

        .btn-sm {
            justify-content: center;
            padding: 0.4rem 0.6rem;
            font-size: 0.7rem;
            width: 100%;
        }
    }

    @media (max-width: 768px) {
        .approval-container {
            border-radius: 8px;
            margin: 0.75rem 0;
        }

        /* Convert table to card layout */
        .approval-table-wrap {
            overflow: visible;
        }

        .approval-table {
            min-width: unset;
            display: block;
        }

        .approval-table thead {
            display: none;
        }

        .approval-table tbody {
            display: block;
        }

        .approval-table tbody tr {
            display: block;
            margin-bottom: 1rem;
            border-radius: 8px;
            background: #DAD9E7;
            border: 1px solid rgba(60, 82, 123, 0.08);
            box-shadow: 0 1px 3px rgba(35, 25, 50, 0.04);
            transition: box-shadow 0.2s ease;
        }

        .approval-table tbody tr:hover {
            background: #DAD9E7;
            box-shadow: 0 2px 8px rgba(35, 25, 50, 0.06);
        }

        .approval-table tbody td {
            display: flex;
            align-items: flex-start;
            padding: 0.5rem 0.75rem;
            border: none;
            border-bottom: 1px solid rgba(60, 82, 123, 0.04);
            gap: 0.5rem;
            font-size: 0.8rem;
        }

        .approval-table tbody td:last-child {
            border-bottom: none;
        }

        .approval-table tbody td:before {
            content: attr(data-label);
            font-weight: 600;
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: #3A5079;
            min-width: 90px;
            flex-shrink: 0;
        }

        .approval-table tbody td:first-child {
            padding-top: 0.75rem;
            border-bottom: none;
            background: rgba(80, 68, 130, 0.04);
            border-radius: 8px 8px 0 0;
        }

        .approval-table tbody td:first-child:before {
            display: none;
        }

        .approval-table tbody td:last-child {
            padding-bottom: 0.75rem;
            border-bottom: none;
            background: rgba(80, 68, 130, 0.02);
            border-radius: 0 0 8px 8px;
        }

        .approval-table tbody td:last-child:before {
            display: none;
        }

        /* Hide # column on mobile */
        .col-no {
            display: none !important;
        }

        /* Action buttons in card view */
        .action-group {
            flex-direction: row;
            flex-wrap: wrap;
            width: 100%;
            gap: 0.3rem;
        }

        .btn-sm {
            flex: 1;
            min-width: 80px;
            padding: 0.4rem 0.5rem;
            font-size: 0.65rem;
            justify-content: center;
        }

        .user-email,
        .user-phone {
            font-size: 0.75rem;
        }

        /* Detail row in card view */
        tr.details-row td {
            padding: 0.5rem 0.75rem;
        }

        .detail-panel {
            padding: 0.75rem;
            margin-top: 0;
        }

        .detail-grid {
            grid-template-columns: 1fr;
            gap: 0.4rem;
        }

        .doc-card {
            min-width: 100%;
            max-width: 100%;
        }

        .doc-filename {
            max-width: none;
        }

        .pagination-wrap {
            padding: 0.75rem 1rem;
            gap: 0.2rem;
        }

        .pagination-wrap a,
        .pagination-wrap span {
            min-width: 30px;
            height: 30px;
            font-size: 0.7rem;
            padding: 0 0.4rem;
        }

        .empty-state {
            padding: 2rem 0.5rem;
        }
    }

    @media (max-width: 480px) {
        .approval-toolbar .left {
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 0.25rem;
        }

        .approval-toolbar .left span:last-child {
            display: none;
        }

        .approval-table tbody td {
            flex-wrap: wrap;
            padding: 0.4rem 0.6rem;
            font-size: 0.75rem;
        }

        .approval-table tbody td:before {
            min-width: 70px;
            font-size: 0.6rem;
        }

        .btn-sm {
            font-size: 0.6rem;
            padding: 0.3rem 0.4rem;
            min-width: 60px;
        }

        .user-name {
            font-size: 0.85rem;
        }

        .badge-role,
        .badge-pending {
            font-size: 0.6rem;
            padding: 0.15rem 0.4rem;
        }

        .detail-panel {
            padding: 0.5rem;
        }

        .doc-card {
            padding: 0.35rem 0.4rem;
        }

        .doc-label {
            font-size: 0.65rem;
        }

        .doc-filename {
            font-size: 0.6rem;
        }

        .doc-view-link {
            font-size: 0.6rem;
            padding: 0.15rem 0.35rem;
        }
    }

    /* ============================================
       UTILITY - Touch-friendly
    ============================================ */
    @media (hover: none) {
        .btn-sm {
            min-height: 36px;
        }
        
        .btn-sm:active {
            transform: scale(0.96);
        }
        
        .doc-card {
            min-height: 44px;
        }
    }

    /* ============================================
       ACCESSIBILITY - Focus states
    ============================================ */
    .btn-sm:focus-visible,
    .detail-toggle-btn:focus-visible,
    .filter-select:focus-visible {
        outline: 2px solid #504482;
        outline-offset: 2px;
    }

    /* ============================================
       SUCCESS/ERROR TOAST COLORS
    ============================================ */
    .alert-success {
        background: #f0fdf4;
        border-color: #86efac;
        color: #166534;
    }

    .alert-success i {
        color: #16a34a;
    }

    .alert-danger {
        background: #fef2f2;
        border-color: #fca5a5;
        color: #991b1b;
    }

    .alert-danger i {
        color: #dc2626;
    }
</style>
@endpush

@section('content')

    {{-- TOOLBAR --}}
    <div class="approval-toolbar">
        <div class="left">
            <span class="count-badge">{{ method_exists($users, 'total') ? $users->total() : count($users) }}</span>
            <span>Pending Registrations</span>
            <span style="font-weight:400; font-size:0.8rem; color:#3A5079;">— review &amp; approve</span>
        </div>

<div class="right">
    <form action="{{ route('admin.registrations.approveAllInvestors') }}" method="POST">
        @csrf

        <button
            type="submit"
            class="btn-sm btn-approve"
            onclick="return confirm('Approve all pending investors?')">
            <i class="fas fa-check-double"></i>
            Approve All Investors
        </button>
    </form>
</div>
    </div>

    {{-- TABLE CONTAINER --}}
    <div class="approval-container">
        <div class="approval-table-wrap">
            <table class="approval-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Registered</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        {{-- MAIN ROW --}}
                        <tr class="data-row">
                            <td class="col-no" data-label="#">{{ ($users->firstItem() ?? 1) + $loop->index }}</td>

                            <td data-label="Name">
                                <div class="user-name">{{ $user->name }}</div>
                            </td>

                            <td data-label="Contact">
                                <span class="user-email"><i class="fas fa-envelope" style="font-size:0.65rem; margin-right:0.3rem; color:#3A5079;"></i> {{ $user->email }}</span>
                                @if ($user->phone)
                                    <span class="user-phone"><i class="fas fa-phone" style="font-size:0.65rem; margin-right:0.3rem; color:#3A5079;"></i> {{ $user->phone }}</span>
                                @endif
                            </td>

                            <td data-label="Role">
                                <span class="badge-role"><i class="fas fa-user-tag"></i> {{ $user->role }}</span>
                            </td>

                            <td data-label="Status">
                                <span class="badge-pending">{{ ucfirst($user->verification_status) }}</span>
                            </td>

                            <td data-label="Registered" style="font-size:0.8rem; color:#3A5079;">
                                <i class="fas fa-calendar-alt" style="font-size:0.65rem; margin-right:0.3rem; color:#3A5079;"></i>
                                {{ $user->created_at->format('d M Y') }}
                            </td>

                            <td data-label="Actions" style="text-align:right;">
                                <div class="action-group">
                                    {{-- Approve - Green Button --}}
                                    <form action="{{ route('admin.registrations.approve', $user->id) }}" method="POST" style="display:inline; flex:1;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn-sm btn-approve" onclick="return confirm('Approve {{ $user->name }}?')">
                                            <i class="fas fa-check"></i> Approve
                                        </button>
                                    </form>

                                    {{-- Reject - Red Button --}}
                                    <form action="{{ route('admin.registrations.reject', $user->id) }}" method="POST" style="display:inline; flex:1;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn-sm btn-reject" onclick="return confirm('Reject {{ $user->name }}?')">
                                            <i class="fas fa-times"></i> Reject
                                        </button>
                                    </form>

                                    {{-- Details Toggle --}}
                                    <button type="button" class="btn-sm btn-details detail-toggle-btn"
                                        aria-expanded="false"
                                        onclick="toggleDetails(this, {{ $loop->index }})">
                                        <i class="fas fa-chevron-down"></i>
                                        <span>More</span>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        {{-- DETAILS ROW --}}
                        <tr class="details-row is-hidden" data-index="{{ $loop->index }}">
                            <td colspan="7">
                                <div class="detail-panel">
                                    @php
                                        // Collect uploaded documents
                                        $documents = [];
                                        switch ($user->role) {
                                            case 'student':
                                                if ($user->studentRegistration) {
                                                    if ($user->studentRegistration->resume) $documents[] = ['label' => 'Resume', 'path' => $user->studentRegistration->resume];
                                                    if ($user->studentRegistration->college_id_card) $documents[] = ['label' => 'College ID Card', 'path' => $user->studentRegistration->college_id_card];
                                                }
                                                break;
                                            case 'employee':
                                                if ($user->employeeRegistration && $user->employeeRegistration->resume) {
                                                    $documents[] = ['label' => 'Resume', 'path' => $user->employeeRegistration->resume];
                                                }
                                                break;
                                            case 'employer':
                                                if ($user->employerRegistration && $user->employerRegistration->company_documents) {
                                                    $documents[] = ['label' => 'Company Documents', 'path' => $user->employerRegistration->company_documents];
                                                }
                                                break;
                                            case 'investor':
                                                if ($user->investorRegistration && $user->investorRegistration->verification_document) {
                                                    $documents[] = ['label' => 'Verification Document', 'path' => $user->investorRegistration->verification_document];
                                                }
                                                break;
                                        }

                                        $docType = function ($path) {
                                            $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                                            if ($ext === 'pdf') return 'pdf';
                                            if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif'])) return 'image';
                                            if (in_array($ext, ['doc', 'docx'])) return 'doc';
                                            return 'file';
                                        };
                                        $docIconMap = [
                                            'pdf'   => ['class' => 'doc-icon--pdf',   'icon' => 'fas fa-file-pdf'],
                                            'image' => ['class' => 'doc-icon--image', 'icon' => 'fas fa-file-image'],
                                            'doc'   => ['class' => 'doc-icon--doc',   'icon' => 'fas fa-file-word'],
                                            'file'  => ['class' => 'doc-icon--file',  'icon' => 'fas fa-file'],
                                        ];
                                    @endphp

                                    {{-- Info Grid --}}
                                    <div class="detail-grid">
                                        @switch($user->role)
                                            @case('student')
                                                @if ($user->studentRegistration)
                                                    <div class="field"><span class="label">College</span><span class="value">{{ $user->studentRegistration->college_name }}</span></div>
                                                    <div class="field"><span class="label">University</span><span class="value">{{ $user->studentRegistration->university }}</span></div>
                                                    <div class="field"><span class="label">Course</span><span class="value">{{ $user->studentRegistration->course }}</span></div>
                                                    <div class="field"><span class="label">Year</span><span class="value">{{ $user->studentRegistration->year }}</span></div>
                                                    <div class="field"><span class="label">Interested Domain</span><span class="value">{{ $user->studentRegistration->interested_domain ?? '-' }}</span></div>
                                                    <div class="field"><span class="label">Skills</span><span class="value">{{ $user->studentRegistration->skills ?? '-' }}</span></div>
                                                @endif
                                                @break

                                            @case('employee')
                                                @if ($user->employeeRegistration)
                                                    <div class="field"><span class="label">Company</span><span class="value">{{ $user->employeeRegistration->company_name }}</span></div>
                                                    <div class="field"><span class="label">Designation</span><span class="value">{{ $user->employeeRegistration->designation }}</span></div>
                                                    <div class="field"><span class="label">Experience</span><span class="value">{{ $user->employeeRegistration->experience_years }} yrs</span></div>
                                                    <div class="field"><span class="label">Current CTC</span><span class="value">{{ $user->employeeRegistration->current_ctc ?? '-' }}</span></div>
                                                    <div class="field"><span class="label">Expected CTC</span><span class="value">{{ $user->employeeRegistration->expected_ctc ?? '-' }}</span></div>
                                                    <div class="field"><span class="label">Skills</span><span class="value">{{ $user->employeeRegistration->skills ?? '-' }}</span></div>
                                                    @if ($user->employeeRegistration->linkedin)
                                                        <div class="field"><span class="label">LinkedIn</span><span class="value"><a href="{{ $user->employeeRegistration->linkedin }}" target="_blank">View <i class="fas fa-external-link-alt" style="font-size:0.6em;"></i></a></span></div>
                                                    @endif
                                                @endif
                                                @break

                                            @case('employer')
                                                @if ($user->employerRegistration)
                                                    <div class="field"><span class="label">Company</span><span class="value">{{ $user->employerRegistration->company_name }}</span></div>
                                                    <div class="field"><span class="label">GST No.</span><span class="value">{{ $user->employerRegistration->gst_number ?? '-' }}</span></div>
                                                    <div class="field"><span class="label">PAN No.</span><span class="value">{{ $user->employerRegistration->pan_number ?? '-' }}</span></div>
                                                    <div class="field"><span class="label">Industry</span><span class="value">{{ $user->employerRegistration->industry ?? '-' }}</span></div>
                                                    <div class="field"><span class="label">Company Size</span><span class="value">{{ $user->employerRegistration->company_size ?? '-' }}</span></div>
                                                    <div class="field"><span class="label">Address</span><span class="value">{{ $user->employerRegistration->company_address }}</span></div>
                                                    @if ($user->employerRegistration->website)
                                                        <div class="field"><span class="label">Website</span><span class="value"><a href="{{ $user->employerRegistration->website }}" target="_blank">Visit <i class="fas fa-external-link-alt" style="font-size:0.6em;"></i></a></span></div>
                                                    @endif
                                                @endif
                                                @break

                                            @case('freelancer')
                                                @if ($user->freelancerRegistration)
                                                    <div class="field"><span class="label">Specialization</span><span class="value">{{ $user->freelancerRegistration->specialization }}</span></div>
                                                    <div class="field"><span class="label">Experience</span><span class="value">{{ $user->freelancerRegistration->experience }} yrs</span></div>
                                                    <div class="field"><span class="label">Hourly Rate</span><span class="value">{{ $user->freelancerRegistration->hourly_rate ?? '-' }}</span></div>
                                                    <div class="field"><span class="label">Availability</span><span class="value">{{ $user->freelancerRegistration->availability ?? '-' }}</span></div>
                                                    <div class="field"><span class="label">Skills</span><span class="value">{{ $user->freelancerRegistration->skills ?? '-' }}</span></div>
                                                    @if ($user->freelancerRegistration->portfolio_link)
                                                        <div class="field"><span class="label">Portfolio</span><span class="value"><a href="{{ $user->freelancerRegistration->portfolio_link }}" target="_blank">View <i class="fas fa-external-link-alt" style="font-size:0.6em;"></i></a></span></div>
                                                    @endif
                                                    @if ($user->freelancerRegistration->github)
                                                        <div class="field"><span class="label">GitHub</span><span class="value"><a href="{{ $user->freelancerRegistration->github }}" target="_blank">View <i class="fas fa-external-link-alt" style="font-size:0.6em;"></i></a></span></div>
                                                    @endif
                                                @endif
                                                @break

                                            @case('investor')
                                                @if ($user->investorRegistration)
                                                    <div class="field"><span class="label">Organization</span><span class="value">{{ $user->investorRegistration->organization }}</span></div>
                                                    <div class="field"><span class="label">Investment Range</span><span class="value">{{ $user->investorRegistration->investment_range }}</span></div>
                                                    <div class="field"><span class="label">Preferred Sectors</span><span class="value">{{ $user->investorRegistration->preferred_sectors }}</span></div>
                                                    <div class="field"><span class="label">Stage</span><span class="value">{{ $user->investorRegistration->investment_stage }}</span></div>
                                                    @if ($user->investorRegistration->website)
                                                        <div class="field"><span class="label">Website</span><span class="value"><a href="{{ $user->investorRegistration->website }}" target="_blank">Visit <i class="fas fa-external-link-alt" style="font-size:0.6em;"></i></a></span></div>
                                                    @endif
                                                @endif
                                                @break

                                            @case('mentor')
                                                @if ($user->mentorRegistration)
                                                    <div class="field"><span class="label">Company</span><span class="value">{{ $user->mentorRegistration->company }}</span></div>
                                                    <div class="field"><span class="label">Designation</span><span class="value">{{ $user->mentorRegistration->designation }}</span></div>
                                                    <div class="field"><span class="label">Expertise</span><span class="value">{{ $user->mentorRegistration->expertise }}</span></div>
                                                    <div class="field"><span class="label">Experience</span><span class="value">{{ $user->mentorRegistration->years_of_experience }} yrs</span></div>
                                                    <div class="field"><span class="label">Availability</span><span class="value">{{ $user->mentorRegistration->availability ?? '-' }}</span></div>
                                                    @if ($user->mentorRegistration->linkedin)
                                                        <div class="field"><span class="label">LinkedIn</span><span class="value"><a href="{{ $user->mentorRegistration->linkedin }}" target="_blank">View <i class="fas fa-external-link-alt" style="font-size:0.6em;"></i></a></span></div>
                                                    @endif
                                                @endif
                                                @break
                                        @endswitch
                                    </div>

                                    {{-- Documents --}}
                                    <div class="doc-section">
                                        <div class="doc-section-title">
                                            <i class="fas fa-folder-open"></i> Uploaded Documents
                                        </div>

                                        @if (count($documents))
                                            <div class="doc-list">
                                                @foreach ($documents as $doc)
                                                    @php
                                                        $type = $docType($doc['path']);
                                                        $meta = $docIconMap[$type] ?? $docIconMap['file'];
                                                    @endphp
                                                    <div class="doc-card">
                                                        <div class="doc-icon {{ $meta['class'] }}">
                                                            <i class="{{ $meta['icon'] }}"></i>
                                                        </div>
                                                        <div class="doc-info">
                                                            <span class="doc-label">{{ $doc['label'] }}</span>
                                                            <span class="doc-filename" title="{{ basename($doc['path']) }}">{{ basename($doc['path']) }}</span>
                                                        </div>
                                                        <a href="{{ asset('storage/' . $doc['path']) }}" target="_blank" class="doc-view-link">
                                                            <i class="fas fa-eye"></i> View
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <p class="doc-empty">No documents uploaded for this registration.</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <span class="icon"><i class="fas fa-check-circle"></i></span>
                                    <p class="title">No pending registrations</p>
                                    <p class="sub">All caught up! 🎉</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if ($users->hasPages())
            <div class="pagination-wrap">
                {{-- Previous --}}
                @if ($users->onFirstPage())
                    <span class="disabled">&laquo;</span>
                @else
                    <a href="{{ $users->previousPageUrl() }}">&laquo;</a>
                @endif

                {{-- Numbers --}}
                @foreach ($users->getUrlRange(max(1, $users->currentPage() - 2), min($users->lastPage(), $users->currentPage() + 2)) as $page => $url)
                    @if ($page == $users->currentPage())
                        <span class="active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach

                {{-- Next --}}
                @if ($users->hasMorePages())
                    <a href="{{ $users->nextPageUrl() }}">&raquo;</a>
                @else
                    <span class="disabled">&raquo;</span>
                @endif
            </div>
        @endif
    </div>

@endsection

@push('scripts')
<script>
    /**
     * Toggle details row visibility
     * @param {HTMLElement} btn - The toggle button
     * @param {number} index - The row index (0-based)
     */
    function toggleDetails(btn, index) {
        const row = document.querySelector(`tr.details-row[data-index="${index}"]`);
        if (!row) return;

        const isHidden = row.classList.contains('is-hidden');
        row.classList.toggle('is-hidden');

        const icon = btn.querySelector('i');
        const span = btn.querySelector('span');

        if (isHidden) {
            icon.className = 'fas fa-chevron-up';
            span.textContent = 'Less';
            btn.setAttribute('aria-expanded', 'true');
        } else {
            icon.className = 'fas fa-chevron-down';
            span.textContent = 'More';
            btn.setAttribute('aria-expanded', 'false');
        }
    }

    // Close all expanded detail panels when Escape is pressed
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('tr.details-row:not(.is-hidden)').forEach(row => {
                row.classList.add('is-hidden');
                const btn = document.querySelector(`button[aria-expanded="true"]`);
                if (btn) {
                    btn.querySelector('i').className = 'fas fa-chevron-down';
                    btn.querySelector('span').textContent = 'More';
                    btn.setAttribute('aria-expanded', 'false');
                }
            });
        }
    });
</script>
@endpush
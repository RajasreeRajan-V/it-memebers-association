@extends('admin.layout.app')

@section('title', 'Legal Help')
@section('page-title', 'Legal Help')
@section('page-subtitle', 'Manage employee legal requests')

@push('styles')
<style>
    /* ===== Legal Help — Admin ===== */
    .lh-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.5rem;
    }
    .lh-header h1 {
        font-size: 1.15rem;
        font-weight: 700;
        color: #1a1a2e;
        letter-spacing: -0.3px;
    }
    .lh-header p {
        font-size: 0.85rem;
        color: #8a8fa8;
        margin-top: 0.2rem;
    }

    .lh-alert {
        padding: 0.9rem 1.2rem;
        border-radius: 10px;
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
        color: #065f46;
        margin-bottom: 1.5rem;
        font-size: 0.9rem;
    }

    /* Stat cards */
    .lh-stats {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0.9rem;
        margin-bottom: 1.5rem;
    }
    @media (min-width: 640px) { .lh-stats { grid-template-columns: repeat(4, 1fr); } }
    @media (min-width: 1024px) { .lh-stats { grid-template-columns: repeat(7, 1fr); } }

    .lh-stat-card {
        display: block;
        background: #fff;
        border: 1px solid #e9edf4;
        border-radius: 12px;
        padding: 0.9rem 1rem;
        text-decoration: none;
        transition: border-color 0.2s, box-shadow 0.2s, transform 0.15s;
    }
    .lh-stat-card:hover {
        border-color: #4a6cf7;
        box-shadow: 0 4px 14px rgba(74, 108, 247, 0.12);
        transform: translateY(-1px);
    }
    .lh-stat-card .value {
        font-size: 1.4rem;
        font-weight: 700;
        color: #1a1a2e;
        line-height: 1.2;
    }
    .lh-stat-card .label {
        font-size: 0.72rem;
        color: #8a8fa8;
        margin-top: 0.15rem;
        font-weight: 500;
    }

    /* Filter bar */
    .lh-filters {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 0.75rem;
        background: #fff;
        border: 1px solid #e9edf4;
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 1.5rem;
    }
    .lh-filters input[type="text"],
    .lh-filters select {
        border: 1px solid #dfe3ee;
        border-radius: 8px;
        padding: 0.55rem 0.75rem;
        font-size: 0.85rem;
        font-family: inherit;
        color: #1a1a2e;
        background: #fff;
    }
    .lh-filters input[type="text"] {
        flex: 1;
        min-width: 220px;
    }
    .lh-filters input:focus,
    .lh-filters select:focus {
        outline: none;
        border-color: #4a6cf7;
        box-shadow: 0 0 0 3px rgba(74, 108, 247, 0.12);
    }
    .lh-btn-primary {
        background: #4a6cf7;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 0.6rem 1.1rem;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
    }
    .lh-btn-primary:hover { background: #3a5ce0; }
    .lh-clear-link {
        font-size: 0.85rem;
        color: #8a8fa8;
        text-decoration: none;
    }
    .lh-clear-link:hover { color: #1a1a2e; }

    /* Table */
    .lh-table-wrap {
        background: #fff;
        border: 1px solid #e9edf4;
        border-radius: 12px;
        overflow: hidden;
    }
    .lh-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.85rem;
    }
    .lh-table thead tr {
        border-bottom: 1px solid #e9edf4;
        background: #f8f9fc;
    }
    .lh-table th {
        text-align: left;
        padding: 0.75rem 1.2rem;
        font-size: 0.68rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #8a8fa8;
        font-weight: 600;
    }
    .lh-table td {
        padding: 0.85rem 1.2rem;
        border-bottom: 1px solid #f0f2f5;
        color: #4a4f66;
        vertical-align: middle;
    }
    .lh-table tbody tr:hover { background: #fafbfd; }
    .lh-table tbody tr:last-child td { border-bottom: none; }

    .lh-req-link {
        color: #4a6cf7;
        font-weight: 600;
        text-decoration: none;
    }
    .lh-req-link:hover { text-decoration: underline; }

    .lh-manage-link {
        color: #4a6cf7;
        font-weight: 600;
        font-size: 0.8rem;
        text-decoration: none;
    }
    .lh-manage-link:hover { text-decoration: underline; }

    .lh-empty {
        text-align: center;
        padding: 3rem 1rem;
        color: #b0b4c4;
        font-size: 0.9rem;
    }

    /* Pill badges */
    .lh-pill {
        display: inline-block;
        padding: 0.25rem 0.65rem;
        border-radius: 999px;
        font-size: 0.72rem;
        font-weight: 600;
    }
    .lh-pill-red    { background: #fef2f2; color: #dc2626; }
    .lh-pill-orange { background: #fff7ed; color: #ea580c; }
    .lh-pill-green  { background: #ecfdf5; color: #059669; }
    .lh-pill-blue   { background: #eff6ff; color: #2563eb; }
    .lh-pill-gray   { background: #f1f2f6; color: #5a5f7a; }

    /* Pagination wrapper */
    .lh-pagination {
        border-top: 1px solid #e9edf4;
        padding: 0.85rem 1.2rem;
    }
    .lh-pagination nav { font-size: 0.8rem; }
</style>
@endpush

@section('content')
<div>

    <div class="lh-header">
        <div>
            <h1>Legal Help Requests</h1>
            <p>All legal requests raised by employees.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="lh-alert">{{ session('success') }}</div>
    @endif

    {{-- stat cards --}}
    <div class="lh-stats">
        @foreach([
            ['label' => 'Total', 'value' => $stats['total'], 'key' => ''],
            ['label' => 'Submitted', 'value' => $stats['submitted'], 'key' => 'submitted'],
            ['label' => 'Under Review', 'value' => $stats['under_review'], 'key' => 'under_review'],
            ['label' => 'In Progress', 'value' => $stats['in_progress'], 'key' => 'in_progress'],
            ['label' => 'Resolved', 'value' => $stats['resolved'], 'key' => 'resolved'],
            ['label' => 'Closed', 'value' => $stats['closed'], 'key' => 'closed'],
            ['label' => 'Unassigned', 'value' => $stats['unassigned'], 'key' => ''],
        ] as $card)
            <a href="{{ route('admin.legal-help.index', $card['key'] ? ['status' => $card['key']] : []) }}" class="lh-stat-card">
                <div class="value">{{ str_pad($card['value'], 2, '0', STR_PAD_LEFT) }}</div>
                <div class="label">{{ $card['label'] }}</div>
            </a>
        @endforeach
    </div>

    {{-- filters --}}
    <form method="GET" class="lh-filters">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search request # / title / category...">

        <select name="status">
            <option value="">All Statuses</option>
            @foreach(['submitted' => 'Submitted', 'under_review' => 'Under Review', 'assigned' => 'Assigned', 'in_progress' => 'In Progress', 'resolved' => 'Resolved', 'closed' => 'Closed'] as $value => $label)
                <option value="{{ $value }}" @selected(request('status') === $value)>{{ $label }}</option>
            @endforeach
        </select>

        <select name="priority">
            <option value="">All Priorities</option>
            @foreach(['low' => 'Low', 'medium' => 'Medium', 'high' => 'High'] as $value => $label)
                <option value="{{ $value }}" @selected(request('priority') === $value)>{{ $label }}</option>
            @endforeach
        </select>

        <select name="assigned">
            <option value="">Anyone</option>
            <option value="me" @selected(request('assigned') === 'me')>Assigned to me</option>
            <option value="unassigned" @selected(request('assigned') === 'unassigned')>Unassigned</option>
        </select>

        <button type="submit" class="lh-btn-primary">Filter</button>
        @if(request()->hasAny(['search', 'status', 'priority', 'assigned']))
            <a href="{{ route('admin.legal-help.index') }}" class="lh-clear-link">Clear</a>
        @endif
    </form>

    {{-- table --}}
    <div class="lh-table-wrap">
        <table class="lh-table">
            <thead>
                <tr>
                    <th>Request ID</th>
                    <th>Employee</th>
                    <th>Issue Title</th>
                    <th>Category</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th>Assigned To</th>
                    <th>Last Updated</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($legalRequests as $legalRequest)
                    @php
                        $priorityPill = ['red' => 'lh-pill-red', 'orange' => 'lh-pill-orange', 'green' => 'lh-pill-green'][$legalRequest->priority_color] ?? 'lh-pill-gray';
                        $statusPill = ['gray' => 'lh-pill-gray', 'orange' => 'lh-pill-orange', 'blue' => 'lh-pill-blue', 'green' => 'lh-pill-green'][$legalRequest->status_color] ?? 'lh-pill-gray';
                    @endphp
                    <tr>
                        <td>
                            <a href="{{ route('admin.legal-help.show', $legalRequest) }}" class="lh-req-link">
                                {{ $legalRequest->request_number }}
                            </a>
                        </td>
                        <td>{{ $legalRequest->employee->name ?? '—' }}</td>
                        <td>{{ $legalRequest->issue_title }}</td>
                        <td>{{ $legalRequest->category }}</td>
                        <td><span class="lh-pill {{ $priorityPill }}">{{ $legalRequest->priority_label }}</span></td>
                        <td><span class="lh-pill {{ $statusPill }}">{{ $legalRequest->status_label }}</span></td>
                        <td>{{ $legalRequest->assignedAdmin->name ?? 'Unassigned' }}</td>
                        <td>{{ $legalRequest->updated_at->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('admin.legal-help.show', $legalRequest) }}" class="lh-manage-link">Manage</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="lh-empty">No legal requests found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($legalRequests->hasPages())
            <div class="lh-pagination">{{ $legalRequests->links() }}</div>
        @endif
    </div>
</div>
@endsection

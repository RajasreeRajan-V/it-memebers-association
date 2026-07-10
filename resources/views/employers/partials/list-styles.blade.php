{{-- resources/views/employer/partials/list-styles.blade.php --}}
<style>
    .card { background:#fff; border-radius:16px; border:1px solid #edf2f7; box-shadow:0 2px 8px rgba(0,0,0,0.03); margin-bottom:1.5rem; overflow:hidden; }
    .card-header { display:flex; align-items:center; justify-content:space-between; padding:1.1rem 1.5rem; border-bottom:1px solid #f1f5f9; flex-wrap:wrap; gap:0.75rem; }
    .card-title { display:flex; align-items:center; gap:0.6rem; font-weight:600; font-size:1rem; color:#0f172a; }
    .card-title i { color:#7c3aed; font-size:1.1rem; }
    .card-body { padding:1.2rem 1.5rem 1.5rem; }
    .card-body.no-pad { padding:0; }

    .quick-link-btn {
        display:inline-flex; align-items:center; gap:0.5rem;
        background:#7c3aed; color:#fff; text-decoration:none;
        padding:0.6rem 1.1rem; border-radius:10px; font-weight:600; font-size:0.85rem;
        box-shadow:0 4px 0 #5b21b6; transition: transform .08s ease;
    }
    .quick-link-btn:active { transform: translateY(3px); box-shadow:0 1px 0 #5b21b6; }

    .empty-state { text-align:center; padding:3rem 1.5rem; color:#94a3b8; }
    .empty-state i { font-size:2.2rem; margin-bottom:0.75rem; color:#c4b5fd; display:block; }
    .empty-state p { margin-bottom:1rem; }

    .data-table { width:100%; border-collapse:collapse; }
    .data-table thead th {
        text-align:left; font-size:0.72rem; text-transform:uppercase; letter-spacing:0.04em;
        color:#94a3b8; font-weight:600; padding:0.75rem 1.5rem; border-bottom:1px solid #f1f5f9;
        background:#fafbfc;
    }
    .data-table tbody td {
        padding:0.8rem 1.5rem; font-size:0.87rem; color:#334155; border-bottom:1px solid #f1f5f9;
        vertical-align: middle;
    }
    .data-table tbody tr:last-child td { border-bottom:none; }
    .data-table .cell-title { font-weight:600; color:#0f172a; }
    .data-table .cell-actions { text-align:right; white-space:nowrap; }
    .data-table .cell-actions a, .data-table .cell-actions button {
        background:none; border:none; color:#7c3aed; cursor:pointer; font-size:0.9rem;
        padding:0.35rem 0.5rem; text-decoration:none;
    }
    .data-table .cell-actions button:hover { color:#dc2626; }
    .reason-row td { background:#fef2f2; color:#991b1b; font-size:0.78rem; padding:0.5rem 1.5rem; }

    .status-badge { padding:0.2rem 0.9rem; border-radius:30px; font-size:0.7rem; font-weight:600; white-space:nowrap; }
    .status-pending  { background:#fef3c7; color:#92400e; }
    .status-approved { background:#d1fae5; color:#065f46; }
    .status-rejected { background:#fee2e2; color:#991b1b; }
    .status-closed   { background:#e2e8f0; color:#475569; }
    .status-in_progress { background:#dbeafe; color:#1e40af; }
    .status-completed { background:#d1fae5; color:#065f46; }

    .pagination-wrap { padding:1rem 1.5rem; }

    @media (max-width:768px) {
        .data-table { display:block; overflow-x:auto; white-space:nowrap; }
    }
</style>

{{-- resources/views/employer/partials/form-styles.blade.php --}}
<style>
    .form-card { background:#fff; border-radius:16px; border:1px solid #edf2f7; box-shadow:0 2px 8px rgba(0,0,0,0.03); overflow:hidden; margin-bottom:1.5rem; }
    .form-card-header { padding:1.25rem 1.5rem; border-bottom:1px solid #f1f5f9; }
    .form-card-header h2 { font-size:1.05rem; font-weight:700; color:#0f172a; display:flex; align-items:center; gap:0.6rem; }
    .form-card-header h2 i { color:#7c3aed; }
    .form-card-header p { font-size:0.82rem; color:#94a3b8; margin-top:0.2rem; }
    .form-card-body { padding:1.5rem; }

    .form-grid { display:grid; grid-template-columns:1fr 1fr; gap:1.1rem 1.5rem; }
    .form-grid .full { grid-column:1 / -1; }

    .form-group { display:flex; flex-direction:column; gap:0.4rem; margin-bottom:1.1rem; }
    .form-group label { font-size:0.82rem; font-weight:600; color:#334155; }
    .form-group label .req { color:#dc2626; }
    .form-group .hint { font-size:0.72rem; color:#94a3b8; }

    .form-control {
        border:1px solid #e2e8f0; border-radius:10px; padding:0.65rem 0.9rem;
        font-size:0.88rem; color:#0f172a; background:#f8fafc; transition:border-color .15s, background .15s;
        font-family: inherit;
    }
    .form-control:focus { outline:none; border-color:#8b5cf6; background:#fff; box-shadow:0 0 0 3px rgba(139,92,246,0.12); }
    textarea.form-control { resize:vertical; min-height:110px; }

    .error-text { color:#dc2626; font-size:0.75rem; margin-top:0.15rem; }
    .form-control.is-invalid { border-color:#dc2626; background:#fef2f2; }

    .form-actions { display:flex; gap:0.75rem; margin-top:0.5rem; }
    .btn-primary, .btn-secondary {
        display:inline-flex; align-items:center; gap:0.5rem; border:none; cursor:pointer;
        padding:0.75rem 1.5rem; border-radius:10px; font-weight:600; font-size:0.9rem; text-decoration:none;
    }
    .btn-primary { background:#7c3aed; color:#fff; box-shadow:0 5px 0 #5b21b6; }
    .btn-primary:active { transform:translateY(3px); box-shadow:0 2px 0 #5b21b6; }
    .btn-secondary { background:#f1f5f9; color:#334155; }
    .btn-secondary:hover { background:#e2e8f0; }

    .current-file { display:flex; align-items:center; gap:0.6rem; background:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; padding:0.6rem 0.9rem; font-size:0.82rem; color:#475569; margin-bottom:0.5rem; }
    .current-file i { color:#7c3aed; }

    @media (max-width:768px) {
        .form-grid { grid-template-columns:1fr; }
    }
</style>

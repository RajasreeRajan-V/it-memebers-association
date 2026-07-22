
<style>
:root{
    --sp-ink:#0f172a;
    --sp-muted:#64748b;
    --sp-line:#e6e9f2;
    --sp-primary:#4f46e5;
    --sp-primary-dark:#3730a3;
    --sp-surface:#ffffff;
    --sp-surface-soft:#f8f9ff;
    --sp-radius-lg:18px;
    --sp-radius-md:14px;
    --sp-shadow-sm:0 2px 8px rgba(15,23,42,.05);
    --sp-shadow-md:0 12px 28px rgba(30,41,79,.08);
}
.sp-wrap{padding:40px 0 60px;}
.sp-card{
    background:var(--sp-surface);
    border:1px solid var(--sp-line);
    border-radius:var(--sp-radius-lg);
    box-shadow:var(--sp-shadow-sm);
    padding:28px 30px;
}
.sp-header{display:flex;align-items:center;justify-content:space-between;gap:16px;margin-bottom:24px;flex-wrap:wrap;}
.sp-header h1{font-weight:800;letter-spacing:-.02em;font-size:1.6rem;color:var(--sp-ink);margin:0;}
.sp-header p{color:var(--sp-muted);margin:4px 0 0;font-size:.92rem;}
.sp-actions{display:flex;gap:10px;flex-wrap:wrap;}
.sp-btn{
    padding:10px 18px;border-radius:10px;font-weight:600;font-size:.88rem;
    border:1px solid var(--sp-line);background:#fff;color:var(--sp-ink);
    text-decoration:none;display:inline-flex;align-items:center;gap:6px;
    transition:transform .15s ease,box-shadow .15s ease,border-color .15s ease;cursor:pointer;
}
.sp-btn:hover{transform:translateY(-1px);border-color:var(--sp-primary);}
.sp-btn-primary{background:var(--sp-primary);border-color:var(--sp-primary);color:#fff;box-shadow:0 6px 16px rgba(79,70,229,.24);}
.sp-btn-primary:hover{background:var(--sp-primary-dark);color:#fff;}
.sp-btn-danger{color:#b91c1c;border-color:#fecaca;background:#fff5f5;}
.sp-btn-danger:hover{background:#fee2e2;border-color:#f87171;}

.sp-status{display:inline-flex;align-items:center;gap:6px;font-size:.76rem;font-weight:700;padding:4px 12px;border-radius:999px;text-transform:capitalize;}
.sp-status-pending{background:#fef3c7;color:#92400e;}
.sp-status-approved{background:#dcfce7;color:#166534;}
.sp-status-rejected{background:#fee2e2;color:#b91c1c;}

.sp-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:18px 28px;margin-top:8px;}
.sp-field{display:flex;flex-direction:column;gap:4px;}
.sp-field-full{grid-column:1 / -1;}
.sp-label{font-size:.72rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;color:var(--sp-muted);}
.sp-value{font-size:.96rem;color:var(--sp-ink);}
.sp-value.empty{color:#9ca3af;font-style:italic;}

.sp-logo{width:84px;height:84px;border-radius:16px;object-fit:cover;border:1px solid var(--sp-line);background:var(--sp-surface-soft);}
.sp-logo-placeholder{width:84px;height:84px;border-radius:16px;background:var(--sp-surface-soft);border:1px dashed var(--sp-line);display:flex;align-items:center;justify-content:center;color:#94a3b8;font-size:.7rem;text-align:center;}

.sp-rejection{margin-top:18px;padding:14px 16px;border-radius:12px;background:#fef2f2;border:1px solid #fecaca;color:#991b1b;font-size:.88rem;}

/* Form */
.sp-form-group{display:flex;flex-direction:column;gap:6px;}
.sp-form-group label{font-size:.82rem;font-weight:600;color:var(--sp-ink);}
.sp-form-group input[type=text],
.sp-form-group input[type=email],
.sp-form-group input[type=url],
.sp-form-group input[type=tel],
.sp-form-group input[type=file],
.sp-form-group select,
.sp-form-group textarea{
    border:1px solid var(--sp-line);border-radius:10px;padding:10px 12px;
    font-size:.9rem;color:var(--sp-ink);background:#fff;
    transition:border-color .15s ease,box-shadow .15s ease;
}
.sp-form-group input:focus,
.sp-form-group select:focus,
.sp-form-group textarea:focus{
    outline:none;border-color:var(--sp-primary);
    box-shadow:0 0 0 3px rgba(79,70,229,.12);
}
.sp-form-group textarea{resize:vertical;min-height:110px;}
.sp-error{color:#dc2626;font-size:.78rem;}
.sp-current-file{font-size:.78rem;color:var(--sp-muted);margin-top:2px;}
.sp-current-file a{color:var(--sp-primary);}

.sp-empty{text-align:center;padding:60px 20px;color:var(--sp-muted);}
.sp-empty h2{color:var(--sp-ink);font-weight:800;margin-bottom:8px;}

@media (max-width:720px){
    .sp-grid{grid-template-columns:1fr;}
}
</style>

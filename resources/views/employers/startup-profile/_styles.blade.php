<style>

:root {
    --sp-blue: #3376f2;
    --sp-blue-dark: #245fd0;
    --sp-blue-light: #eef4ff;

    --sp-text: #172033;
    --sp-muted: #7b8498;

    --sp-border: #e8edf5;
    --sp-bg: #f8fafc;

    --sp-green: #059669;
    --sp-green-bg: #ecfdf5;
    --sp-amber: #92400e;
    --sp-amber-bg: #fef3c7;
    --sp-red: #dc2626;
    --sp-red-bg: #fef2f2;

    --sp-radius: 16px;
}

.sp-page {
    font-family:
        Inter,
        Poppins,
        ui-sans-serif,
        system-ui,
        -apple-system,
        BlinkMacSystemFont,
        "Segoe UI",
        sans-serif;
}


/* ============================================================
   HERO (index) — two-column, matches jobs hero
============================================================ */

.sp-hero {
    background: linear-gradient(180deg, #F5F8FF 0%, #F5F8FF 60%, #ffffff 100%);
    border-bottom: 1px solid #eef1f7;
}

.sp-hero-inner {
    max-width: 1152px;
    margin: 0 auto;
    padding: 44px 24px 52px;
    display: grid;
    grid-template-columns: 1fr;
    gap: 28px;
    align-items: center;
}

@media (min-width: 768px) {
    .sp-hero-inner { grid-template-columns: 1fr 1fr; gap: 32px; }
}

.sp-hero-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: .04em;
    color: var(--sp-blue-dark);
    background: rgba(51, 118, 242, .1);
    padding: 6px 14px;
    border-radius: 999px;
    margin-bottom: 16px;
}

.sp-hero h1 {
    font-size: 2.4rem;
    font-weight: 800;
    letter-spacing: -.035em;
    color: var(--sp-text);
    margin: 0 0 14px;
    line-height: 1.14;
    max-width: 480px;
}

.sp-hero h1 span { color: var(--sp-blue); display: block; }

.sp-hero p {
    color: var(--sp-muted);
    font-size: 15px;
    line-height: 1.65;
    max-width: 460px;
    margin: 0 0 24px;
}

.sp-hero-buttons { display: flex; flex-wrap: wrap; align-items: center; gap: 12px; }

.sp-hero-btn-primary {
    display: inline-flex; align-items: center; gap: 8px;
    background: var(--sp-blue); color: #fff;
    font-size: 14px; font-weight: 600;
    padding: 12px 24px; border-radius: 12px;
    text-decoration: none;
    box-shadow: 0 9px 22px rgba(51, 118, 242, .2);
    transition: all .2s ease;
}

.sp-hero-btn-primary:hover { background: var(--sp-blue-dark); color: #fff; transform: translateY(-2px); }

.sp-hero-btn-secondary {
    display: inline-flex; align-items: center; gap: 8px;
    background: #fff; color: #475569;
    border: 1px solid #e2e8f0;
    font-size: 14px; font-weight: 600;
    padding: 12px 24px; border-radius: 12px;
    text-decoration: none;
    box-shadow: 0 7px 18px rgba(37, 99, 235, .08);
    transition: all .2s ease;
}

.sp-hero-btn-secondary:hover { color: var(--sp-blue); border-color: #93c5fd; }

/* Decorative visual side of hero */
.sp-hero-visual {
    position: relative;
    display: flex;
    justify-content: center;
    min-height: 220px;
}

.sp-hero-visual-card {
    width: 100%;
    max-width: 340px;
    background: linear-gradient(135deg, var(--sp-blue) 0%, #7657e8 100%);
    border-radius: 22px;
    padding: 28px;
    color: #fff;
    box-shadow: 0 20px 45px rgba(51, 118, 242, .22);
}

.sp-hero-visual-card .sp-hvc-icon {
    width: 44px; height: 44px; border-radius: 12px;
    background: rgba(255,255,255,.18);
    display: flex; align-items: center; justify-content: center;
    margin-bottom: 16px;
}

.sp-hero-visual-card h4 { font-size: 15px; font-weight: 700; margin: 0 0 6px; }
.sp-hero-visual-card p { font-size: 12.5px; color: rgba(255,255,255,.82); line-height: 1.6; margin: 0; }

.sp-hero-float {
    position: absolute;
    display: flex; align-items: center; gap: 10px;
    background: #fff; border-radius: 12px;
    box-shadow: 0 14px 28px rgba(15,23,42,.1);
    padding: 9px 14px;
}

.sp-hero-float-1 { top: -8px; left: 0; }
.sp-hero-float-2 { bottom: 6px; right: -4px; }

.sp-hero-float-icon {
    width: 28px; height: 28px; border-radius: 9px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; font-size: 13px;
}

.sp-hero-float p { margin: 0; font-size: 11px; font-weight: 700; color: #1e293b; line-height: 1.3; }
.sp-hero-float span { display: block; font-size: 9.5px; color: #94a3b8; font-weight: 500; }

@media (max-width: 767px) {
    .sp-hero-visual { display: none; }
    .sp-hero h1 { font-size: 1.9rem; }
}


/* ============================================================
   PAGE WRAPPER
============================================================ */

.sp-wrap {
    max-width: 1152px;
    margin: 0 auto;
    padding: 28px 24px 70px;
}

.sp-alert {
    border-radius: 11px;
    padding: 13px 16px;
    margin-bottom: 18px;
    font-size: 13px;
    font-weight: 500;
}

.sp-alert-success {
    background: var(--sp-green-bg);
    border: 1px solid #cceedd;
    color: #287653;
}

.sp-alert-danger {
    background: #fff1f1;
    border: 1px solid #f6d0d0;
    color: #a84646;
}

.sp-alert ul { margin: 0; padding-left: 18px; }


/* ============================================================
   EMPTY STATE (no profile yet)
============================================================ */

.sp-empty {
    background: #fff;
    border: 1px solid var(--sp-border);
    border-radius: var(--sp-radius);
    box-shadow: 0 3px 13px rgba(15, 23, 42, .03);
    text-align: center;
    padding: 60px 24px;
}

.sp-empty-icon {
    width: 56px;
    height: 56px;
    margin: 0 auto 16px;
    border-radius: 50%;
    background: var(--sp-blue-light);
    color: var(--sp-blue);
    display: flex;
    align-items: center;
    justify-content: center;
}

.sp-empty h3 {
    font-size: 18px;
    font-weight: 700;
    color: var(--sp-text);
    margin: 0 0 6px;
}

.sp-empty p {
    font-size: 13px;
    color: var(--sp-muted);
    margin: 0 0 20px;
}


/* ============================================================
   PROFILE SUMMARY CARD (index)
============================================================ */

.sp-summary-card {
    position: relative;
    background: #fff;
    border: 1px solid var(--sp-border);
    border-radius: var(--sp-radius);
    padding: 22px;
    box-shadow: 0 2px 10px rgba(15, 23, 42, .025);
    transition: box-shadow .18s ease, border-color .18s ease;
}

.sp-summary-card.menu-active { z-index: 50; }

.sp-summary-inner {
    display: flex;
    align-items: flex-start;
    gap: 16px;
}

.sp-logo {
    width: 60px;
    height: 60px;
    min-width: 60px;
    border-radius: 14px;
    object-fit: cover;
    background: var(--sp-bg);
    border: 1px solid var(--sp-border);
    box-shadow: 0 3px 9px rgba(15, 23, 42, .035);
}

.sp-logo-fallback {
    width: 60px;
    height: 60px;
    min-width: 60px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--sp-blue-light);
    color: var(--sp-blue);
    font-weight: 700;
    font-size: 20px;
}

.sp-summary-content { flex: 1; min-width: 0; }

.sp-summary-top {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 12px;
    flex-wrap: wrap;
}

.sp-summary-title {
    font-size: 18px;
    font-weight: 700;
    color: var(--sp-text);
    margin: 0 0 3px;
    letter-spacing: -.01em;
}

.sp-summary-founder {
    font-size: 12.5px;
    font-weight: 600;
    color: var(--sp-blue);
    margin: 0;
}

.sp-status {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 11px;
    font-weight: 700;
    padding: 4px 12px;
    border-radius: 999px;
    text-transform: capitalize;
    white-space: nowrap;
}

.sp-status-pending  { background: var(--sp-amber-bg); color: var(--sp-amber); }
.sp-status-approved { background: var(--sp-green-bg); color: var(--sp-green); }
.sp-status-rejected { background: var(--sp-red-bg);   color: var(--sp-red); }

.sp-meta {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 14px;
    margin-top: 10px;
}

.sp-meta-item {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 12px;
    color: var(--sp-muted);
}

.sp-meta-item svg { width: 14px; height: 14px; color: #9aa4b3; flex-shrink: 0; }

.sp-description {
    margin-top: 10px;
    font-size: 12.5px;
    line-height: 1.65;
    color: var(--sp-muted);
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.sp-rejection-inline {
    margin-top: 14px;
    padding: 11px 14px;
    border-radius: 10px;
    background: var(--sp-red-bg);
    border: 1px solid #fecaca;
    color: #991b1b;
    font-size: 12.5px;
}


/* ============================================================
   3-DOT MENU
============================================================ */

.sp-menu { position: relative; flex-shrink: 0; }

.sp-menu > summary {
    width: 34px;
    height: 34px;
    list-style: none;
    border: 1px solid #e6ebf3;
    border-radius: 9px;
    color: #94a0b2;
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all .16s ease;
}

.sp-menu > summary::-webkit-details-marker { display: none; }
.sp-menu > summary::marker { display: none; }

.sp-menu > summary:hover {
    color: var(--sp-blue);
    border-color: #c9dafa;
    background: #f8fbff;
}

.sp-menu[open] > summary {
    color: var(--sp-blue-dark);
    border-color: #93c5fd;
    background: #f8fbff;
}

.sp-menu-panel {
    position: absolute;
    right: 0;
    top: 100%;
    z-index: 100;
    min-width: 190px;
    margin-top: 8px;
    padding: 5px;
    background: #fff;
    border: 1px solid #e7ebf3;
    border-radius: 12px;
    box-shadow: 0 15px 32px rgba(15, 23, 42, .12);
    animation: spMenuIn .14s ease-out;
    transform-origin: top right;
}

@keyframes spMenuIn {
    from { opacity: 0; transform: scale(.97) translateY(-4px); }
    to   { opacity: 1; transform: scale(1) translateY(0); }
}

.sp-menu-panel a,
.sp-menu-panel button {
    display: flex;
    align-items: center;
    gap: 10px;
    width: 100%;
    padding: 10px 14px;
    border: 0;
    background: none;
    border-radius: 8px;
    font-family: inherit;
    font-size: 12.5px;
    font-weight: 500;
    color: #4b5566;
    text-decoration: none;
    cursor: pointer;
    text-align: left;
    transition: background .15s ease, color .15s ease;
}

.sp-menu-panel a:hover,
.sp-menu-panel button:hover { background: #f8fafc; color: var(--sp-blue); }

.sp-menu-panel svg { width: 15px; height: 15px; flex-shrink: 0; }

.sp-menu-panel .sp-menu-danger { color: var(--sp-red); }
.sp-menu-panel .sp-menu-danger:hover { background: var(--sp-red-bg); color: var(--sp-red); }

.sp-menu-divider { margin: 4px 6px; border-top: 1px solid #f1f5f9; }


/* ============================================================
   DETAIL PAGE (show)
============================================================ */

.sp-detail-card {
    background: #ffffff;
    border: 1px solid var(--sp-border);
    border-radius: 18px;
    padding: 38px;
    box-shadow: 0 4px 24px rgba(15, 23, 42, .04);
}

.sp-back {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: .85rem;
    font-weight: 600;
    color: var(--sp-muted);
    background: var(--sp-bg);
    border: 1px solid var(--sp-border);
    padding: 8px 16px;
    border-radius: 999px;
    text-decoration: none;
    transition: all .2s ease;
    margin-bottom: 20px;
}

.sp-back svg { transition: transform .2s ease; }

.sp-back:hover {
    color: var(--sp-blue-dark);
    background: var(--sp-blue-light);
    border-color: #bfdbfe;
    transform: translateX(-2px);
}

.sp-back:hover svg { transform: translateX(-2px); }

.sp-detail-header {
    display: flex;
    align-items: flex-start;
    gap: 20px;
    padding-bottom: 26px;
    margin-bottom: 26px;
    border-bottom: 1px solid #f1f5f9;
}

.sp-detail-logo {
    width: 84px;
    height: 84px;
    min-width: 84px;
    border-radius: 18px;
    object-fit: cover;
    background: var(--sp-bg);
    border: 1px solid var(--sp-border);
}

.sp-detail-logo-fallback {
    width: 84px;
    height: 84px;
    min-width: 84px;
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--sp-blue-light);
    color: var(--sp-blue);
    font-weight: 700;
    font-size: 28px;
}

.sp-detail-header-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    margin-bottom: 8px;
}

.sp-detail-header h1 {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--sp-text);
    margin: 0 0 6px;
    letter-spacing: -.01em;
    line-height: 1.25;
}

.sp-detail-founder {
    font-size: .88rem;
    color: var(--sp-blue);
    font-weight: 600;
    margin: 0;
}

.sp-detail-date { font-size: .78rem; color: #9ca3af; }

.sp-info-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    padding-bottom: 26px;
    margin-bottom: 26px;
    border-bottom: 1px solid #f1f5f9;
}

.sp-info-item {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.sp-info-label {
    font-size: .7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .05em;
    color: #9ca3af;
}

.sp-info-value { font-size: .95rem; font-weight: 600; color: #111827; }
.sp-info-value.sp-link a { color: var(--sp-blue); text-decoration: none; }
.sp-info-value.sp-link a:hover { text-decoration: underline; }

.sp-section { margin-bottom: 26px; }
.sp-section h2 { font-size: .9rem; font-weight: 700; color: #111827; margin: 0 0 10px; }
.sp-section-body { font-size: .92rem; line-height: 1.75; color: #4b5563; margin: 0; white-space: pre-line; }

.sp-location-box {
    background: var(--sp-bg);
    border: 1px solid #f1f5f9;
    border-radius: 12px;
    padding: 20px 22px;
    margin-bottom: 26px;
}

.sp-location-box h2 { font-size: .9rem; font-weight: 700; color: #111827; margin: 0 0 14px; }

.sp-location-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
}

.sp-file-chip {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: var(--sp-blue-light);
    color: var(--sp-blue-dark);
    font-size: .85rem;
    font-weight: 600;
    padding: 9px 16px;
    border-radius: 10px;
    text-decoration: none;
    transition: background .15s ease;
}

.sp-file-chip:hover { background: #dce7ff; color: var(--sp-blue-dark); }

.sp-detail-footer { padding-top: 22px; border-top: 1px solid #f1f5f9; }

.sp-actions-split {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    flex-wrap: wrap;
}

.sp-actions-right { display: flex; gap: 10px; }

.sp-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    border-radius: 8px;
    font-size: .85rem;
    font-weight: 600;
    padding: 9px 20px;
    cursor: pointer;
    border: 1px solid var(--sp-border);
    background: #fff;
    color: var(--sp-text);
    text-decoration: none;
    transition: background-color .15s ease, transform .15s ease, border-color .15s ease;
}

.sp-btn:hover { transform: translateY(-1px); border-color: var(--sp-blue); color: var(--sp-blue); }

.sp-btn-primary { background: var(--sp-blue); border-color: var(--sp-blue); color: #fff; }
.sp-btn-primary:hover { background: var(--sp-blue-dark); border-color: var(--sp-blue-dark); color: #fff; }

.sp-btn-danger { background: var(--sp-red-bg); border: none; color: var(--sp-red); }
.sp-btn-danger:hover { background: #fee2e2; color: var(--sp-red); transform: translateY(-1px); border-color: transparent; }


/* ============================================================
   FORM PAGES (create / edit)
============================================================ */

.sp-form-wrapper { max-width: 1200px; margin: 0 auto; padding: 32px 24px 70px; }

.sp-form-header { margin-bottom: 24px; }
.sp-form-header h1 { margin: 0 0 7px; color: var(--sp-text); font-size: 27px; font-weight: 800; letter-spacing: -.4px; }
.sp-form-header p { margin: 0; color: var(--sp-muted); font-size: 14px; line-height: 1.6; }

.sp-form-layout {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 300px;
    gap: 24px;
    align-items: start;
}

.sp-form-card {
    background: #fff;
    border: 1px solid var(--sp-border);
    border-radius: var(--sp-radius);
    padding: 28px;
    box-shadow: 0 6px 22px rgba(29, 43, 76, .045);
}

.sp-form-card-head { display: flex; align-items: center; gap: 14px; margin-bottom: 22px; }

.sp-form-card-icon {
    width: 42px; height: 42px; flex: 0 0 42px;
    border-radius: 11px;
    display: flex; align-items: center; justify-content: center;
    background: var(--sp-blue-light); color: var(--sp-blue);
    font-size: 19px;
}

.sp-form-card-head h2 { margin: 0 0 4px; color: var(--sp-text); font-size: 18px; font-weight: 750; }
.sp-form-card-head p { margin: 0; color: var(--sp-muted); font-size: 13px; }

.sp-form-tip {
    display: flex; gap: 12px; align-items: flex-start;
    background: #f2f6ff; border: 1px solid #dfe9ff; border-radius: 11px;
    padding: 13px 15px; margin-bottom: 23px; color: #53617a;
}

.sp-form-tip > i { color: var(--sp-blue); font-size: 17px; margin-top: 1px; }
.sp-form-tip strong { display: block; color: #31466f; font-size: 12px; margin-bottom: 2px; }
.sp-form-tip span { display: block; color: #66728a; font-size: 12px; line-height: 1.55; }

.sp-form-row { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 21px 18px; }
.sp-field-full { grid-column: 1 / -1; }

.sp-form-field { min-width: 0; }

.sp-form-field label {
    display: block; margin: 0 0 8px;
    color: #343d50; font-size: 11px; font-weight: 750;
    letter-spacing: .35px; text-transform: uppercase;
}

.sp-required { color: #e05252; margin-left: 2px; }

.sp-form-field input,
.sp-form-field textarea,
.sp-form-field select {
    width: 100%; box-sizing: border-box;
    border: 1px solid #dfe4ec; border-radius: 10px;
    background: #fafbfc; color: #222b3c;
    font-family: inherit; font-size: 13px;
    outline: none;
    transition: border-color .2s ease, box-shadow .2s ease, background .2s ease;
}

.sp-form-field input { height: 45px; padding: 0 13px; }
.sp-form-field textarea { min-height: 130px; padding: 13px 14px; line-height: 1.65; resize: vertical; }

.sp-form-field input::placeholder,
.sp-form-field textarea::placeholder { color: #a5adba; }

.sp-form-field input:focus,
.sp-form-field textarea:focus,
.sp-form-field select:focus {
    background: #fff; border-color: var(--sp-blue);
    box-shadow: 0 0 0 3px rgba(51, 118, 242, .09);
}

.sp-form-field input.is-invalid,
.sp-form-field textarea.is-invalid { border-color: #e05252; box-shadow: 0 0 0 3px rgba(224, 82, 82, .07); }

.sp-field-error { margin: 6px 0 0; color: #dc4c4c; font-size: 11px; }
.sp-current-file { display: block; margin-top: 7px; color: #929aaa; font-size: 11px; }
.sp-current-file a { color: var(--sp-blue); }

/* Sidebar */
.sp-sidebar { display: flex; flex-direction: column; gap: 16px; }

.sp-side-card {
    background: #fff; border: 1px solid var(--sp-border); border-radius: var(--sp-radius);
    padding: 21px; box-shadow: 0 5px 18px rgba(29, 43, 76, .035);
}

.sp-side-card-head { display: flex; align-items: center; gap: 10px; margin-bottom: 17px; }

.sp-side-card-head-icon {
    width: 34px; height: 34px;
    display: flex; align-items: center; justify-content: center;
    border-radius: 9px; background: var(--sp-blue-light); color: var(--sp-blue);
    font-size: 15px;
}

.sp-side-card-head h3 { margin: 0; color: var(--sp-text); font-size: 14px; font-weight: 750; }

.sp-tips-list { list-style: none; padding: 0; margin: 0; }

.sp-tips-list li {
    display: flex; align-items: flex-start; gap: 9px;
    color: #707a8d; font-size: 12px; line-height: 1.55; margin-bottom: 13px;
}

.sp-tips-list li:last-child { margin-bottom: 0; }
.sp-tips-list i { color: var(--sp-blue); font-size: 13px; margin-top: 2px; }

.sp-side-notice {
    display: flex; align-items: flex-start; gap: 10px;
    background: #fff8ed; border: 1px solid #f7e4c4; border-radius: 13px; padding: 15px;
}

.sp-side-notice i { color: #d9952f; font-size: 17px; }
.sp-side-notice strong { display: block; color: #8d642a; font-size: 12px; margin-bottom: 3px; }
.sp-side-notice span { display: block; color: #9a7b4b; font-size: 11px; line-height: 1.5; }

/* Actions */
.sp-form-actions {
    display: flex; align-items: center; justify-content: space-between;
    margin-top: 18px; padding: 18px 0 0;
}

.sp-form-actions .sp-cancel {
    min-height: 42px; display: inline-flex; align-items: center; justify-content: center;
    border-radius: 10px; padding: 0 17px; font-size: 12px; font-weight: 700;
    border: 1px solid #e0e5ed; background: #fff; color: #657086;
    text-decoration: none; transition: all .2s ease;
}

.sp-form-actions .sp-cancel:hover { background: #f8f9fb; color: var(--sp-text); }

.sp-submit-btn {
    min-height: 42px; display: inline-flex; align-items: center; justify-content: center; gap: 8px;
    border-radius: 10px; padding: 0 17px; font-family: inherit; font-size: 12px; font-weight: 700;
    border: 1px solid var(--sp-blue); background: var(--sp-blue); color: #fff;
    cursor: pointer; transition: all .2s ease;
}

.sp-submit-btn:hover { background: var(--sp-blue-dark); border-color: var(--sp-blue-dark); transform: translateY(-1px); }
.sp-submit-btn:disabled { opacity: .7; cursor: not-allowed; transform: none; }


/* ============================================================
   INDEX CONTENT LAYOUT (list column + sidebar, like jobs index)
============================================================ */

.sp-content-layout {
    display: grid;
    grid-template-columns: minmax(0, 1fr);
    gap: 20px;
}

@media (min-width: 1024px) {
    .sp-content-layout { grid-template-columns: minmax(0, 1fr) 280px; gap: 24px; }
}

.sp-main-col { min-width: 0; }

.sp-sidebar-col { display: flex; flex-direction: column; gap: 16px; }

.sp-sidebar-cta {
    position: relative;
    overflow: hidden;
    border-radius: 18px;
    background: linear-gradient(135deg, var(--sp-blue) 0%, #7657e8 100%);
    color: #fff;
    padding: 20px;
    box-shadow: 0 10px 26px rgba(51, 118, 242, .18);
}

.sp-sidebar-cta::before {
    content: "";
    position: absolute;
    width: 112px; height: 112px;
    border-radius: 50%;
    background: rgba(255,255,255,.1);
    right: -32px; bottom: -32px;
}

.sp-sidebar-cta::after {
    content: "";
    position: absolute;
    width: 64px; height: 64px;
    border-radius: 50%;
    background: rgba(255,255,255,.1);
    right: 40px; top: -24px;
}

.sp-sidebar-cta h3 { position: relative; font-weight: 700; font-size: 16px; margin: 0 0 8px; }
.sp-sidebar-cta p { position: relative; font-size: 13px; color: rgba(255,255,255,.85); line-height: 1.6; margin: 0 0 16px; }

.sp-sidebar-cta a {
    position: relative;
    display: inline-flex; align-items: center; gap: 6px;
    background: #fff; color: var(--sp-blue);
    font-size: 13px; font-weight: 700;
    padding: 10px 16px; border-radius: 10px;
    text-decoration: none;
    transition: background .15s ease;
}

.sp-sidebar-cta a:hover { background: #f8fafc; }

.sp-sidebar-tips-list { list-style: none; padding: 0; margin: 0; font-size: 12px; color: var(--sp-muted); line-height: 2; }


/* ============================================================
   RESPONSIVE
============================================================ */

@media (max-width: 991px) {
    .sp-form-layout { grid-template-columns: 1fr; }
    .sp-sidebar { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); }
    .sp-info-grid { grid-template-columns: 1fr 1fr; }
    .sp-location-grid { grid-template-columns: 1fr 1fr; }
}

@media (max-width: 700px) {
    .sp-form-wrapper { padding: 25px 15px 50px; }
    .sp-form-header h1 { font-size: 23px; }
    .sp-form-card { padding: 21px; }
    .sp-form-row { grid-template-columns: 1fr; }
    .sp-field-full { grid-column: auto; }
    .sp-sidebar { grid-template-columns: 1fr; }
    .sp-hero h1 { font-size: 1.6rem; }
}

@media (max-width: 640px) {
    .sp-wrap { padding: 20px 16px 60px; }
    .sp-detail-card { padding: 24px; }
    .sp-detail-header { flex-direction: column; }
    .sp-detail-header h1 { font-size: 1.3rem; }
    .sp-info-grid { grid-template-columns: 1fr 1fr; }
    .sp-location-grid { grid-template-columns: 1fr 1fr; }
    .sp-actions-split { flex-direction: column-reverse; align-items: stretch; }
    .sp-actions-right { width: 100%; }
    .sp-actions-right .sp-btn, .sp-actions-right form { width: 100%; }
    .sp-back { align-self: flex-start; }
    .sp-summary-inner { flex-wrap: wrap; }
}

</style>
<style>
:root {
    --job-blue: #3376F2;
    --job-blue-dark: #245fd0;
    --job-blue-light: #eef4ff;
    --job-text: #172033;
    --job-muted: #64748b;
    --job-border: #e2e8f0;
    --job-bg: #f8fafc;
    --job-white: #ffffff;
    --job-success: #16a34a;
    --job-danger: #dc2626;
}


/* =========================================================
   BASE
========================================================= */

.jobpost-page,
.jobpost-page * {
    box-sizing: border-box;
}

.jobpost-page {
    width: 100%;
    min-height: 100vh;
    background: var(--job-bg);
    color: var(--job-text);

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

.jobpost-page .container-fluid {
    width: 100%;
    padding: 0 28px 35px;
}


/* =========================================================
   PAGE HEADER
========================================================= */

.jobpost-header {
    width: 100%;
    margin-bottom: 18px;
    padding-top: 5px;
    text-align: center;
}

.jobpost-header h1 {
    margin: 0;

    font-size: 27px;
    line-height: 1.25;
    font-weight: 750;

    color: var(--job-text);
}

.jobpost-header p {
    margin: 6px 0 0;

    color: var(--job-muted);

    font-size: 13px;
    line-height: 1.5;
}


/* =========================================================
   ALERTS
========================================================= */

.jobpost-alert {
    display: flex;
    align-items: flex-start;

    gap: 9px;

    padding: 11px 13px;
    margin-bottom: 15px;

    border-radius: 10px;

    font-size: 12px;
    line-height: 1.45;
}

.jobpost-alert-danger {
    color: #991b1b;

    background: #fef2f2;

    border: 1px solid #fecaca;
}

.jobpost-alert-success {
    color: #166534;

    background: #f0fdf4;

    border: 1px solid #bbf7d0;
}


/* =========================================================
   MAIN LAYOUT
========================================================= */

.jobpost-layout {
    width: 100%;

    display: grid;

    grid-template-columns:
        minmax(0, 1fr)
        270px;

    gap: 18px;

    align-items: start;
}

.jobpost-main {
    min-width: 0;
}


/* =========================================================
   PROGRESS
========================================================= */

.job-progress {
    width: 100%;

    background: var(--job-white);

    border: 1px solid var(--job-border);

    border-radius: 13px;

    padding: 13px 17px;

    margin-bottom: 14px;

    box-shadow:
        0 2px 8px rgba(15, 23, 42, 0.025);
}

.job-progress-track {
    display: flex;

    align-items: center;

    width: 100%;
}

.job-progress-item {
    display: flex;

    align-items: center;

    gap: 8px;

    flex: 0 0 auto;
}

.job-progress-circle {
    width: 30px;
    height: 30px;

    border-radius: 50%;

    background: #f1f5f9;

    border: 1px solid #dbe3ee;

    display: flex;

    align-items: center;
    justify-content: center;

    font-size: 12px;

    font-weight: 700;

    color: #64748b;

    transition:
        background .25s ease,
        color .25s ease,
        border-color .25s ease;
}

.job-progress-label {
    font-size: 12px;

    font-weight: 650;

    color: #64748b;

    white-space: nowrap;
}

.job-progress-item.active .job-progress-circle {
    background: var(--job-blue);

    border-color: var(--job-blue);

    color: #fff;
}

.job-progress-item.active .job-progress-label {
    color: var(--job-blue);
}

.job-progress-item.completed .job-progress-circle {
    background: var(--job-success);

    border-color: var(--job-success);

    color: #fff;
}

.job-progress-item.completed .job-progress-label {
    color: var(--job-success);
}

.job-progress-line {
    flex: 1;

    height: 2px;

    margin: 0 11px;

    background: #e2e8f0;

    transition: background .25s ease;
}

.job-progress-line.completed {
    background: var(--job-success);
}


/* =========================================================
   FORM CARD
========================================================= */

.jobpost-card {
    width: 100%;

    background: var(--job-white);

    border: 1px solid var(--job-border);

    border-radius: 15px;

    overflow: hidden;

    box-shadow:
        0 3px 12px rgba(15, 23, 42, 0.035);
}

.jobpost-form {
    width: 100%;
}


/* =========================================================
   WIZARD STEP
========================================================= */

.job-wizard-step {
    display: none;

    padding: 22px 24px;
}

.job-wizard-step.active {
    display: block;
}

.job-step-heading {
    display: flex;

    align-items: flex-start;

    gap: 11px;

    margin-bottom: 20px;
}

.job-step-number {
    width: 32px;
    height: 32px;

    flex: 0 0 32px;

    border-radius: 9px;

    background: var(--job-blue-light);

    color: var(--job-blue);

    display: flex;

    align-items: center;
    justify-content: center;

    font-size: 12px;

    font-weight: 750;
}

.job-step-heading h2 {
    margin: 0;

    font-size: 18px;

    font-weight: 750;

    color: var(--job-text);
}

.job-step-heading p {
    margin: 3px 0 0;

    color: var(--job-muted);

    font-size: 12px;

    line-height: 1.45;
}


/* =========================================================
   FORM GRID
========================================================= */

.job-form-grid {
    display: grid;

    grid-template-columns:
        repeat(2, minmax(0, 1fr));

    gap: 14px 16px;
}

.job-form-field-full {
    grid-column: 1 / -1;
}


/* =========================================================
   FORM FIELD
========================================================= */

.job-form-field {
    min-width: 0;
}

.job-form-field label {
    display: block;

    margin-bottom: 6px;

    font-size: 12px;

    font-weight: 700;

    color: var(--job-text);
}

.required-mark {
    color: var(--job-danger);

    margin-left: 2px;
}

.optional-label {
    color: #94a3b8;

    font-size: 11px;

    font-weight: 500;

    margin-left: 3px;
}


/* =========================================================
   INPUTS
========================================================= */

.job-form-field input,
.job-form-field select,
.job-form-field textarea {
    width: 100%;

    border: 1px solid #dbe3ee;

    border-radius: 8px;

    background: #fff;

    color: var(--job-text);

    font-family: inherit;

    font-size: 13px;

    outline: none;

    transition:
        border-color .2s ease,
        box-shadow .2s ease,
        background .2s ease;
}

.job-form-field input,
.job-form-field select {
    height: 40px;

    padding: 0 11px;
}

.job-form-field textarea {
    min-height: 190px;

    padding: 11px;

    resize: vertical;

    line-height: 1.55;
}

.job-form-field input::placeholder,
.job-form-field textarea::placeholder {
    color: #94a3b8;
}

.job-form-field input:focus,
.job-form-field select:focus,
.job-form-field textarea:focus {
    border-color: var(--job-blue);

    box-shadow:
        0 0 0 3px rgba(51, 118, 242, .08);
}

.job-form-field input.job-invalid,
.job-form-field select.job-invalid,
.job-form-field textarea.job-invalid {
    border-color: var(--job-danger);

    box-shadow:
        0 0 0 3px rgba(220, 38, 38, .07);
}


/* =========================================================
   FORM HELPERS
========================================================= */

.job-input-hint {
    margin-top: 5px;

    font-size: 10.5px;

    color: #94a3b8;

    line-height: 1.4;
}

.job-input-meta {
    display: flex;

    justify-content: space-between;

    gap: 10px;

    margin-top: 5px;

    font-size: 10.5px;

    color: #94a3b8;
}

.job-field-error {
    margin-top: 5px;

    color: var(--job-danger);

    font-size: 11px;

    line-height: 1.35;
}


/* =========================================================
   LOCATION INFORMATION
========================================================= */

.job-location-mode-info {
    display: flex;

    gap: 10px;

    align-items: flex-start;

    padding: 11px 13px;

    margin-bottom: 17px;

    border: 1px solid #dbeafe;

    border-radius: 9px;

    background: #f8fbff;
}

.job-location-mode-icon {
    width: 29px;
    height: 29px;

    flex: 0 0 29px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 8px;

    background: var(--job-blue-light);

    color: var(--job-blue);

    font-size: 12px;
}

.job-location-mode-info strong {
    display: block;

    margin-bottom: 2px;

    font-size: 11.5px;

    color: var(--job-text);
}

.job-location-mode-info p {
    margin: 0;

    font-size: 10.5px;

    line-height: 1.45;

    color: var(--job-muted);
}


/* =========================================================
   LOCATION PREVIEW
========================================================= */

.job-location-preview {
    display: flex;

    align-items: center;

    gap: 10px;

    margin-top: 18px;

    padding: 11px 13px;

    border: 1px solid var(--job-border);

    border-radius: 9px;

    background: #f8fafc;
}

.job-location-icon {
    width: 31px;
    height: 31px;

    flex: 0 0 31px;

    border-radius: 8px;

    background: var(--job-blue-light);

    color: var(--job-blue);

    display: flex;

    align-items: center;
    justify-content: center;

    font-size: 13px;
}

.job-location-preview strong {
    display: block;

    font-size: 11.5px;

    color: var(--job-text);
}

.job-location-preview p {
    margin: 2px 0 0;

    color: var(--job-muted);

    font-size: 10.5px;
}


/* =========================================================
   DESCRIPTION TIPS
========================================================= */

.job-description-tips {
    display: grid;

    gap: 7px;

    margin-top: 13px;
}

.job-description-tip {
    display: flex;

    align-items: center;

    gap: 7px;

    color: var(--job-muted);

    font-size: 10.5px;
}

.job-description-tip i {
    color: var(--job-success);

    font-size: 11px;
}
/* =========================================================
   JOB SEARCH & FILTER
========================================================= */

.job-filter-card {
    width: 100%;
    margin: 0 0 18px;

    padding: 16px;

    background: #ffffff;

    border: 1px solid #e2e8f0;

    border-radius: 14px;

    box-shadow: 0 3px 12px rgba(15, 23, 42, 0.035);
}

.job-filter-form {
    display: grid;

    grid-template-columns:
        minmax(180px, 1.5fr)
        minmax(150px, 1fr)
        minmax(140px, 1fr)
        minmax(140px, 1fr)
        minmax(130px, 1fr)
        minmax(130px, 1fr)
        auto;

    gap: 12px;

    align-items: end;
}

.job-filter-field {
    min-width: 0;
}

.job-filter-field label {
    display: block;

    margin-bottom: 6px;

    color: #334155;

    font-size: 11px;

    font-weight: 700;
}

.job-filter-field label i {
    margin-right: 4px;

    color: #3376F2;

    font-size: 11px;
}

.job-filter-field input,
.job-filter-field select {
    width: 100%;

    height: 38px;

    padding: 0 10px;

    border: 1px solid #dbe3ee;

    border-radius: 8px;

    background: #ffffff;

    color: #172033;

    font-family: inherit;

    font-size: 12px;

    outline: none;

    transition:
        border-color .2s ease,
        box-shadow .2s ease;
}

.job-filter-field input::placeholder {
    color: #94a3b8;
}

.job-filter-field input:focus,
.job-filter-field select:focus {
    border-color: #3376F2;

    box-shadow:
        0 0 0 3px rgba(51, 118, 242, 0.08);
}


/* Buttons */

.job-filter-actions {
    display: flex;

    align-items: center;

    gap: 7px;

    height: 38px;
}

.job-filter-btn {
    height: 38px;

    padding: 0 13px;

    border-radius: 8px;

    display: inline-flex;

    align-items: center;
    justify-content: center;

    gap: 6px;

    font-size: 11.5px;

    font-weight: 700;

    text-decoration: none;

    white-space: nowrap;

    cursor: pointer;

    transition:
        background .2s ease,
        border-color .2s ease,
        color .2s ease,
        transform .2s ease;
}

.job-filter-btn:hover {
    transform: translateY(-1px);
}

.job-filter-btn-primary {
    border: 1px solid #3376F2;

    background: #3376F2;

    color: #ffffff;
}

.job-filter-btn-primary:hover {
    border-color: #245fd0;

    background: #245fd0;

    color: #ffffff;
}

.job-filter-btn-clear {
    border: 1px solid #dbe3ee;

    background: #ffffff;

    color: #475569;
}

.job-filter-btn-clear:hover {
    background: #f8fafc;

    color: #172033;
}


/* Active filter indicator */

.job-filter-card.has-filters {
    border-color: #cbdcff;
}


/* =========================================================
   RESPONSIVE FILTER
========================================================= */

@media (max-width: 1250px) {

    .job-filter-form {
        grid-template-columns:
            repeat(3, minmax(0, 1fr));
    }

    .job-filter-search {
        grid-column: span 2;
    }

    .job-filter-actions {
        justify-content: flex-start;
    }
}


@media (max-width: 800px) {

    .job-filter-form {
        grid-template-columns:
            repeat(2, minmax(0, 1fr));
    }

    .job-filter-search {
        grid-column: span 2;
    }

    .job-filter-actions {
        grid-column: span 2;
    }
}


@media (max-width: 520px) {

    .job-filter-card {
        padding: 13px;
    }

    .job-filter-form {
        grid-template-columns: 1fr;
    }

    .job-filter-search {
        grid-column: auto;
    }

    .job-filter-actions {
        grid-column: auto;

        width: 100%;
    }

    .job-filter-btn {
        flex: 1;
    }
}

/* =========================================================
   ACTIONS
========================================================= */

.jobpost-actions {
    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 10px;

    padding: 13px 24px;

    border-top: 1px solid var(--job-border);

    background: #fff;
}

.jobpost-actions-left,
.jobpost-actions-right {
    display: flex;

    align-items: center;

    gap: 8px;
}

.jobpost-btn {
    min-height: 36px;

    padding: 0 14px;

    border-radius: 8px;

    border: 1px solid transparent;

    display: inline-flex;

    align-items: center;
    justify-content: center;

    gap: 6px;

    font-family: inherit;

    font-size: 11.5px;

    font-weight: 700;

    text-decoration: none;

    cursor: pointer;

    transition:
        background .2s ease,
        border-color .2s ease,
        color .2s ease,
        transform .2s ease,
        box-shadow .2s ease;
}

.jobpost-btn:hover {
    transform: translateY(-1px);
}

.jobpost-btn-secondary {
    background: #fff;

    border-color: #dbe3ee;

    color: #475569;
}

.jobpost-btn-secondary:hover {
    background: #f8fafc;
}

.jobpost-btn-primary {
    background: var(--job-blue);

    border-color: var(--job-blue);

    color: #fff;
}

.jobpost-btn-primary:hover {
    background: var(--job-blue-dark);

    border-color: var(--job-blue-dark);

    box-shadow:
        0 5px 14px rgba(51, 118, 242, .16);
}

.jobpost-btn-success {
    background: var(--job-success);

    border-color: var(--job-success);

    color: #fff;
}

.jobpost-btn-success:hover {
    background: #15803d;

    border-color: #15803d;
}

.jobpost-btn:disabled {
    opacity: .65;

    cursor: not-allowed;

    transform: none;
}


/* =========================================================
   SIDEBAR
========================================================= */

.jobpost-sidebar {
    display: grid;

    gap: 12px;
}

.jobpost-side-card {
    background: #fff;

    border: 1px solid var(--job-border);

    border-radius: 13px;

    padding: 15px;

    box-shadow:
        0 2px 8px rgba(15, 23, 42, 0.025);
}

.jobpost-side-card h3 {
    margin: 0 0 11px;

    font-size: 13px;

    font-weight: 750;

    color: var(--job-text);
}

.jobpost-side-card p {
    margin: 0;

    color: var(--job-muted);

    font-size: 10.5px;

    line-height: 1.55;
}


/* =========================================================
   POSTING TIPS
========================================================= */

.jobpost-tips {
    display: grid;

    gap: 10px;
}

.jobpost-tip {
    display: flex;

    align-items: flex-start;

    gap: 8px;
}

.jobpost-tip-icon {
    width: 27px;
    height: 27px;

    flex: 0 0 27px;

    border-radius: 7px;

    background: var(--job-blue-light);

    color: var(--job-blue);

    display: flex;

    align-items: center;
    justify-content: center;

    font-size: 11px;
}

.jobpost-tip-text strong {
    display: block;

    margin-bottom: 1px;

    font-size: 10.5px;

    color: var(--job-text);
}

.jobpost-tip-text span {
    display: block;

    font-size: 9.5px;

    line-height: 1.4;

    color: var(--job-muted);
}


/* =========================================================
   NOTICE
========================================================= */

.jobpost-notice {
    padding: 11px;

    border-radius: 9px;

    background: #f8fbff;

    border: 1px solid #dbeafe;
}

.jobpost-notice strong {
    display: block;

    margin-bottom: 4px;

    font-size: 10.5px;

    color: var(--job-text);
}

.jobpost-notice p {
    font-size: 10px;
}


/* =========================================================
   CHECKLIST
========================================================= */

.jobpost-checklist {
    display: grid;

    gap: 8px;
}

.jobpost-check-item {
    display: flex;

    align-items: center;

    gap: 7px;

    font-size: 10.5px;

    color: #94a3b8;
}

.jobpost-check-item i {
    font-size: 12px;
}

.jobpost-check-item.completed {
    color: var(--job-success);
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 1050px) {

    .jobpost-page .container-fluid {
        padding-left: 20px;
        padding-right: 20px;
    }

    .jobpost-layout {
        grid-template-columns: 1fr;
    }

    .jobpost-sidebar {
        grid-template-columns:
            repeat(3, minmax(0, 1fr));
    }
}


@media (max-width: 800px) {

    .jobpost-sidebar {
        grid-template-columns:
            repeat(2, minmax(0, 1fr));
    }

    .job-progress-label {
        font-size: 11px;
    }
}


@media (max-width: 720px) {

    .jobpost-page .container-fluid {
        padding-left: 15px;
        padding-right: 15px;
    }

    .jobpost-header h1 {
        font-size: 23px;
    }

    .jobpost-layout {
        gap: 14px;
    }

    .job-progress {
        padding: 12px;
    }

    .job-progress-label {
        display: none;
    }

    .job-progress-line {
        margin: 0 7px;
    }

    .job-wizard-step {
        padding: 20px 17px;
    }

    .job-form-grid {
        grid-template-columns: 1fr;
    }

    .job-form-field-full {
        grid-column: auto;
    }

    .jobpost-actions {
        padding: 12px 17px;
    }

    .jobpost-sidebar {
        grid-template-columns: 1fr;
    }
}


@media (max-width: 480px) {

    .jobpost-header {
        margin-bottom: 14px;
    }

    .jobpost-header h1 {
        font-size: 21px;
    }

    .jobpost-actions {
        flex-direction: column;

        align-items: stretch;
    }

    .jobpost-actions-left,
    .jobpost-actions-right {
        width: 100%;
    }

    .jobpost-actions-left {
        justify-content: flex-start;
    }

    .jobpost-actions-right {
        justify-content: flex-end;
    }

    .jobpost-btn {
        flex: 1;
    }

    .job-step-heading h2 {
        font-size: 17px;
    }

    .job-location-mode-info {
        padding: 10px;
    }
}
</style>
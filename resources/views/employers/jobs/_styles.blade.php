<style>

:root {
    --job-primary: #3363D6;
    --job-primary-dark: #2854c7;
    --job-primary-light: #eef4ff;

    --job-text: #172033;
    --job-muted: #7b8497;

    --job-border: #e9edf4;
    --job-bg: #f7f9fd;
    --job-white: #ffffff;

    --job-green: #22a06b;
    --job-purple: #7657e8;

    --job-radius: 16px;
}


/* ============================================================
   PAGE
============================================================ */

.jobpost-wrapper {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 32px 24px 70px;
    box-sizing: border-box;
}

.jobpost-header {
    margin-bottom: 24px;
}

.jobpost-header h1 {
    margin: 0 0 7px;
    color: var(--job-text);
    font-size: 27px;
    line-height: 1.25;
    font-weight: 800;
    letter-spacing: -0.4px;
}

.jobpost-header p {
    margin: 0;
    color: var(--job-muted);
    font-size: 14px;
    line-height: 1.6;
}


/* ============================================================
   LAYOUT
============================================================ */

.jobpost-layout {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 320px;
    gap: 24px;
    align-items: start;
}

.jobpost-main {
    min-width: 0;
}


/* ============================================================
   STEP INDICATOR
============================================================ */

.job-wizard-progress {
    background: #fff;
    border: 1px solid var(--job-border);
    border-radius: var(--job-radius);
    padding: 20px 24px;
    margin-bottom: 20px;
    box-shadow: 0 5px 18px rgba(29, 43, 76, 0.04);
}

.job-progress-track {
    display: flex;
    align-items: center;
    width: 100%;
}

.job-progress-item {
    display: flex;
    align-items: center;
    gap: 10px;
    flex: 1;
    min-width: 0;
}

.job-progress-item:last-child {
    flex: 0 1 auto;
}

.job-progress-number {
    width: 34px;
    height: 34px;
    flex: 0 0 34px;
    border-radius: 50%;
    background: #eef1f6;
    color: #8a93a5;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 13px;
    font-weight: 700;

    transition: all .25s ease;
}

.job-progress-label {
    font-size: 13px;
    color: #929aaa;
    font-weight: 600;
    white-space: nowrap;
}

.job-progress-line {
    height: 2px;
    background: #e9edf3;
    flex: 1;
    margin: 0 15px;
    transition: background .25s ease;
}

.job-progress-item.active .job-progress-number {
    background: var(--job-primary);
    color: #fff;
    box-shadow: 0 5px 12px rgba(51, 99, 214, .2);
}

.job-progress-item.active .job-progress-label {
    color: var(--job-primary);
}

.job-progress-item.completed .job-progress-number {
    background: #e8f7f0;
    color: var(--job-green);
}

.job-progress-item.completed .job-progress-label {
    color: var(--job-text);
}

.job-progress-line.completed {
    background: var(--job-primary);
}


/* ============================================================
   WIZARD STEPS
============================================================ */

.job-wizard-step {
    display: none;
    animation: jobStepFade .25s ease;
}

.job-wizard-step.active {
    display: block;
}

@keyframes jobStepFade {
    from {
        opacity: 0;
        transform: translateY(6px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}


/* ============================================================
   FORM CARD
============================================================ */

.job-form-card {
    background: var(--job-white);
    border: 1px solid var(--job-border);
    border-radius: var(--job-radius);
    padding: 28px;
    box-shadow: 0 6px 22px rgba(29, 43, 76, 0.045);
}

.job-form-card-head {
    display: flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 22px;
}

.job-form-card-icon {
    width: 42px;
    height: 42px;
    flex: 0 0 42px;

    border-radius: 11px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: var(--job-primary-light);
    color: var(--job-primary);

    font-size: 19px;
}

.job-form-card-icon.job-icon-purple {
    background: #f1edff;
    color: var(--job-purple);
}

.job-form-card-icon.job-icon-green {
    background: #eaf8f2;
    color: var(--job-green);
}

.job-form-card-head h2 {
    margin: 0 0 4px;
    color: var(--job-text);
    font-size: 18px;
    font-weight: 750;
}

.job-form-card-head p {
    margin: 0;
    color: var(--job-muted);
    font-size: 13px;
}


/* ============================================================
   TIP
============================================================ */

.job-form-tip {
    display: flex;
    gap: 12px;
    align-items: flex-start;

    background: #f2f6ff;
    border: 1px solid #dfe9ff;
    border-radius: 11px;

    padding: 13px 15px;
    margin-bottom: 23px;

    color: #53617a;
}

.job-form-tip > i {
    color: var(--job-primary);
    font-size: 17px;
    margin-top: 1px;
}

.job-form-tip strong {
    display: block;
    color: #31466f;
    font-size: 12px;
    margin-bottom: 2px;
}

.job-form-tip span {
    display: block;
    color: #66728a;
    font-size: 12px;
    line-height: 1.55;
}


/* ============================================================
   FORM GRID
============================================================ */

.job-form-row {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 21px 18px;
}

.job-field-full {
    grid-column: 1 / -1;
}


/* ============================================================
   FIELD
============================================================ */

.job-form-field {
    min-width: 0;
}

.job-form-field label {
    display: block;
    margin: 0 0 8px;

    color: #343d50;
    font-size: 11px;
    font-weight: 750;
    letter-spacing: .35px;
    text-transform: uppercase;
}

.job-required {
    color: #e05252;
    margin-left: 2px;
}

.job-form-field input,
.job-form-field textarea,
.job-form-field select {
    width: 100%;
    box-sizing: border-box;

    border: 1px solid #dfe4ec;
    border-radius: 10px;

    background: #fafbfc;
    color: #222b3c;

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
    height: 45px;
    padding: 0 13px;
}

.job-form-field textarea {
    min-height: 250px;
    padding: 13px 14px;
    line-height: 1.65;
    resize: vertical;
}

.job-form-field input::placeholder,
.job-form-field textarea::placeholder {
    color: #a5adba;
}

.job-form-field input:focus,
.job-form-field textarea:focus,
.job-form-field select:focus {
    background: #fff;
    border-color: var(--job-primary);
    box-shadow: 0 0 0 3px rgba(51, 99, 214, .09);
}

.job-form-field input.invalid,
.job-form-field textarea.invalid,
.job-form-field select.invalid {
    border-color: #e05252;
    box-shadow: 0 0 0 3px rgba(224, 82, 82, .07);
}


/* ============================================================
   SELECT
============================================================ */

.job-select-wrap {
    position: relative;
}

.job-select-wrap select {
    appearance: none;
    padding-right: 40px;
    cursor: pointer;
}

.job-select-wrap i {
    position: absolute;
    right: 14px;
    top: 50%;
    transform: translateY(-50%);

    color: #8c95a7;
    pointer-events: none;
    font-size: 13px;
}


/* ============================================================
   FIELD HELP
============================================================ */

.job-field-help {
    display: block;
    margin-top: 7px;
    color: #929aaa;
    font-size: 11px;
    line-height: 1.5;
}

.job-field-bottom {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 12px;
    margin-top: 7px;
}

.job-field-bottom small {
    color: #929aaa;
    font-size: 11px;
    line-height: 1.5;
}

.job-counter {
    flex: 0 0 auto;
    color: #9ba3b1;
    font-size: 10px;
}


/* ============================================================
   ERROR
============================================================ */

.job-field-error {
    margin: 6px 0 0;
    color: #dc4c4c;
    font-size: 11px;
}


/* ============================================================
   LOCATION PREVIEW
============================================================ */

.job-location-preview {
    display: flex;
    align-items: center;
    gap: 12px;

    background: #f8fafc;
    border: 1px solid #edf0f5;
    border-radius: 11px;

    padding: 14px;
    margin-top: 2px;
}

.job-location-preview-icon {
    width: 38px;
    height: 38px;
    flex: 0 0 38px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 9px;
    background: #eaf8f2;
    color: var(--job-green);
}

.job-location-preview strong {
    display: block;
    color: #374052;
    font-size: 12px;
    margin-bottom: 3px;
}

.job-location-preview span {
    color: #8a93a4;
    font-size: 11px;
}


/* ============================================================
   SIDEBAR
============================================================ */

.jobpost-sidebar {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.job-side-card {
    background: #fff;
    border: 1px solid var(--job-border);
    border-radius: var(--job-radius);
    padding: 21px;
    box-shadow: 0 5px 18px rgba(29, 43, 76, .035);
}

.job-side-card-head {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 17px;
}

.job-side-card-head-icon {
    width: 34px;
    height: 34px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 9px;
    background: var(--job-primary-light);
    color: var(--job-primary);

    font-size: 15px;
}

.job-side-card-head h3 {
    margin: 0;
    color: var(--job-text);
    font-size: 14px;
    font-weight: 750;
}


/* ============================================================
   TIPS
============================================================ */

.job-tips-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.job-tips-list li {
    display: flex;
    align-items: flex-start;
    gap: 9px;

    color: #707a8d;
    font-size: 12px;
    line-height: 1.55;

    margin-bottom: 13px;
}

.job-tips-list li:last-child {
    margin-bottom: 0;
}

.job-tips-list i {
    color: var(--job-primary);
    font-size: 13px;
    margin-top: 2px;
}


/* ============================================================
   NOTICE
============================================================ */

.job-side-notice {
    display: flex;
    align-items: flex-start;
    gap: 10px;

    background: #fff8ed;
    border: 1px solid #f7e4c4;
    border-radius: 13px;

    padding: 15px;
}

.job-side-notice i {
    color: #d9952f;
    font-size: 17px;
}

.job-side-notice strong {
    display: block;
    color: #8d642a;
    font-size: 12px;
    margin-bottom: 3px;
}

.job-side-notice span {
    display: block;
    color: #9a7b4b;
    font-size: 11px;
    line-height: 1.5;
}


/* ============================================================
   CHECKLIST
============================================================ */

.job-checklist {
    list-style: none;
    padding: 0;
    margin: 0;
}

.job-checklist li {
    display: flex;
    align-items: center;
    gap: 9px;

    color: #8b94a5;
    font-size: 12px;

    margin-bottom: 11px;

    transition: color .2s ease;
}

.job-checklist li:last-child {
    margin-bottom: 0;
}

.job-checklist li i {
    width: 18px;
    height: 18px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background: #f0f2f5;
    color: #9ba3af;

    font-size: 9px;
}

.job-checklist li.done {
    color: #4e596c;
}

.job-checklist li.done i {
    background: #e7f7ef;
    color: var(--job-green);
}


/* ============================================================
   ACTIONS
============================================================ */

.jobpost-actions {
    display: flex;
    align-items: center;
    justify-content: space-between;

    margin-top: 18px;
    padding: 18px 0 0;
}

.jobpost-actions-right {
    display: flex;
    align-items: center;
    gap: 10px;
}

.jobpost-btn,
.jobpost-back,
.jobpost-cancel {
    min-height: 42px;

    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;

    border-radius: 10px;

    padding: 0 17px;

    font-family: inherit;
    font-size: 12px;
    font-weight: 700;

    text-decoration: none;
    cursor: pointer;

    transition: all .2s ease;
}

.jobpost-btn {
    border: 1px solid var(--job-primary);
    background: var(--job-primary);
    color: #fff;
}

.jobpost-btn:hover {
    background: var(--job-primary-dark);
    border-color: var(--job-primary-dark);
    color: #fff;
    transform: translateY(-1px);
}

.jobpost-btn:disabled {
    opacity: .7;
    cursor: not-allowed;
    transform: none;
}

.jobpost-back,
.jobpost-cancel {
    border: 1px solid #e0e5ed;
    background: #fff;
    color: #657086;
}

.jobpost-back:hover,
.jobpost-cancel:hover {
    background: #f8f9fb;
    color: var(--job-text);
}

.jobpost-btn i,
.jobpost-back i {
    font-size: 12px;
}


/* ============================================================
   ALERTS
============================================================ */

.jobpost-alert {
    border-radius: 11px;
    padding: 13px 15px;
    margin-bottom: 18px;
    font-size: 12px;
}

.jobpost-alert-danger {
    background: #fff1f1;
    border: 1px solid #f6d0d0;
    color: #a84646;
}

.jobpost-alert-success {
    background: #edf9f3;
    border: 1px solid #cceedd;
    color: #287653;
}

.jobpost-alert ul {
    margin: 0;
    padding-left: 18px;
}

.jobpost-alert li {
    margin-bottom: 4px;
}

.jobpost-alert li:last-child {
    margin-bottom: 0;
}


/* ============================================================
   RESPONSIVE
============================================================ */

@media (max-width: 991px) {

    .jobpost-layout {
        grid-template-columns: 1fr;
    }

    .jobpost-sidebar {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

}


@media (max-width: 700px) {

    .jobpost-wrapper {
        padding: 25px 15px 50px;
    }

    .jobpost-header h1 {
        font-size: 23px;
    }

    .job-form-card {
        padding: 21px;
    }

    .job-form-row {
        grid-template-columns: 1fr;
    }

    .job-field-full {
        grid-column: auto;
    }

    .jobpost-sidebar {
        grid-template-columns: 1fr;
    }

    .job-progress-label {
        display: none;
    }

    .job-progress-item {
        justify-content: center;
    }

    .job-progress-line {
        margin: 0 9px;
    }

}


@media (max-width: 500px) {

    .jobpost-wrapper {
        padding-left: 11px;
        padding-right: 11px;
    }

    .job-form-card {
        padding: 17px;
        border-radius: 13px;
    }

    .job-wizard-progress {
        padding: 16px;
    }

    .job-progress-number {
        width: 31px;
        height: 31px;
        flex-basis: 31px;
    }

    .job-form-card-head h2 {
        font-size: 16px;
    }

    .job-form-card-head p {
        font-size: 12px;
    }

    .jobpost-actions {
        flex-direction: column-reverse;
        align-items: stretch;
        gap: 10px;
    }

    .jobpost-actions-right {
        width: 100%;
    }

    .jobpost-btn,
    .jobpost-back,
    .jobpost-cancel {
        width: 100%;
    }

    .jobpost-actions-right .jobpost-btn {
        flex: 1;
    }

}

</style>
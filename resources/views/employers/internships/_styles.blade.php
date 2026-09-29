<style>

    /* =========================================================
       INTERNSHIP PAGE
    ========================================================= */

    :root {
        --intern-blue: #3376f2;
        --intern-blue-dark: #245fd0;
        --intern-blue-light: #eef4ff;

        --intern-text: #172033;
        --intern-heading: #18243a;
        --intern-muted: #718096;

        --intern-border: #e5eaf2;
        --intern-white: #ffffff;

        --intern-danger: #ef4444;
        --intern-success: #16a34a;
    }


    /* =========================================================
       PAGE
    ========================================================= */

    .internship-page {
        width: 100%;
        max-width: 1180px;

        margin: 0 auto;

        padding: 32px 24px 60px;

        color: var(--intern-text);
    }


    /* =========================================================
       PAGE HEADER
    ========================================================= */

    .internship-page-header {

        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 20px;

        margin-bottom: 24px;
    }


    .page-title-row {

        display: flex;
        align-items: center;

        gap: 15px;
    }


    .page-title-icon {

        width: 50px;
        height: 50px;

        border-radius: 13px;

        background: var(--intern-blue-light);
        color: var(--intern-blue);

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 21px;

        flex-shrink: 0;
    }


    .internship-page-header h1 {

        margin: 0;

        font-size: 29px;
        line-height: 1.25;

        font-weight: 700;

        color: var(--intern-heading);

        letter-spacing: -0.4px;
    }


    .internship-page-header p {

        margin: 5px 0 0;

        color: var(--intern-muted);

        font-size: 15px;

        line-height: 1.5;
    }


    /* =========================================================
       BACK BUTTON
    ========================================================= */

    .back-button {

        display: inline-flex;

        align-items: center;
        justify-content: center;

        gap: 8px;

        padding: 11px 17px;

        border: 1px solid var(--intern-border);

        border-radius: 9px;

        background: #fff;

        color: #344054;

        font-size: 13px;

        font-weight: 600;

        text-decoration: none;

        transition: all .2s ease;
    }


    .back-button:hover {

        border-color: #cfd7e5;

        background: #f9fafb;

        color: var(--intern-blue);
    }


    /* =========================================================
       PROGRESS
    ========================================================= */

    .progress-card {

        display: flex;
        align-items: center;

        background: #fff;

        border: 1px solid var(--intern-border);

        border-radius: 12px;

        padding: 14px 18px;

        margin-bottom: 22px;

        overflow-x: auto;
    }


    .progress-step {

        display: flex;
        align-items: center;

        gap: 9px;

        white-space: nowrap;

        color: #98a2b3;

        font-size: 13px;

        font-weight: 600;
    }


    .progress-step.active {

        color: var(--intern-blue);
    }


    .step-circle {

        width: 31px;
        height: 31px;

        border-radius: 50%;

        display: flex;
        align-items: center;
        justify-content: center;

        background: #f1f4f8;

        color: #98a2b3;

        font-size: 11px;

        flex-shrink: 0;
    }


    .progress-step.active .step-circle {

        background: var(--intern-blue-light);

        color: var(--intern-blue);
    }


    .progress-line {

        height: 1px;

        width: 65px;

        background: #e7ebf2;

        margin: 0 14px;

        flex-shrink: 0;
    }


    /* =========================================================
       MAIN LAYOUT
    ========================================================= */

    .internship-layout {

        display: grid;

        grid-template-columns:
            minmax(0, 1fr)
            285px;

        gap: 22px;

        align-items: start;
    }


    .internship-main {

        min-width: 0;
    }


    /* =========================================================
       FORM CARD
    ========================================================= */

    .form-card {

        background: #fff;

        border: 1px solid var(--intern-border);

        border-radius: 14px;

        overflow: hidden;

        box-shadow:
            0 3px 15px rgba(30, 50, 80, .035);
    }


    .form-card-header {

        display: flex;
        align-items: center;

        gap: 13px;

        padding: 22px 25px;

        border-bottom: 1px solid var(--intern-border);
    }


    .section-icon {

        width: 43px;
        height: 43px;

        border-radius: 11px;

        background: var(--intern-blue-light);

        color: var(--intern-blue);

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 18px;

        flex-shrink: 0;
    }


    .form-card-header h2 {

        margin: 0;

        color: var(--intern-heading);

        font-size: 18px;

        font-weight: 700;
    }


    .form-card-header p {

        margin: 4px 0 0;

        color: var(--intern-muted);

        font-size: 13px;
    }


    .form-card-body {

        padding: 25px;
    }


    /* =========================================================
       INFO BOX
    ========================================================= */

    .info-box {

        display: flex;

        gap: 11px;

        padding: 14px 15px;

        margin-bottom: 26px;

        background: #f2f6ff;

        border: 1px solid #dce8ff;

        border-radius: 10px;

        color: #315fae;
    }


    .info-icon {

        flex-shrink: 0;

        margin-top: 2px;

        font-size: 15px;
    }


    .info-box strong {

        display: block;

        font-size: 13px;

        font-weight: 700;

        margin-bottom: 4px;
    }


    .info-box p {

        margin: 0;

        font-size: 13px;

        line-height: 1.55;

        color: #5573a7;
    }


    /* =========================================================
       FORM SECTIONS
    ========================================================= */

    .form-section {

        padding-bottom: 25px;

        margin-bottom: 25px;

        border-bottom: 1px solid #edf0f5;
    }


    .form-section:last-of-type {

        border-bottom: none;

        margin-bottom: 0;

        padding-bottom: 0;
    }


    .form-section-heading {

        display: flex;

        align-items: flex-start;

        gap: 11px;

        margin-bottom: 19px;
    }


    .form-section-number {

        width: 31px;
        height: 31px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 8px;

        background: #f5f7fb;

        color: var(--intern-blue);

        font-size: 11px;

        font-weight: 700;

        flex-shrink: 0;
    }


    .form-section-heading h3 {

        margin: 0;

        font-size: 15px;

        font-weight: 700;

        color: var(--intern-heading);
    }


    .form-section-heading p {

        margin: 4px 0 0;

        font-size: 12px;

        color: var(--intern-muted);
    }


    /* =========================================================
       FORM GRID
    ========================================================= */

    .form-grid-2 {

        display: grid;

        grid-template-columns: 1fr 1fr;

        gap: 17px;
    }


    .location-grid {

        display: grid;

        grid-template-columns: 1fr 1fr;

        gap: 17px;
    }


    /* =========================================================
       FORM GROUP
    ========================================================= */

    .form-group-custom {

        margin-bottom: 17px;
    }


    .form-group-custom:last-child {

        margin-bottom: 0;
    }


    .full-width {

        width: 100%;
    }


    .form-group-custom label {

        display: block;

        margin-bottom: 7px;

        color: #344054;

        font-size: 13px;

        font-weight: 600;
    }


    .required {

        color: var(--intern-danger);

        margin-left: 2px;
    }


    /* =========================================================
       INPUT
    ========================================================= */

    .input-wrapper {

        position: relative;
    }


    .input-wrapper > i {

        position: absolute;

        left: 13px;
        top: 50%;

        transform: translateY(-50%);

        color: #98a2b3;

        font-size: 13px;

        pointer-events: none;

        z-index: 2;
    }


    .form-control-custom {

        width: 100%;

        min-height: 44px;

        padding: 10px 12px 10px 38px;

        border: 1px solid #d9e0ea;

        border-radius: 8px;

        background: #fff;

        color: #1d2939;

        font-family: inherit;

        font-size: 13px;

        outline: none;

        transition:
            border-color .2s ease,
            box-shadow .2s ease,
            background .2s ease;

        box-sizing: border-box;
    }


    .form-control-custom::placeholder {

        color: #a0a8b6;
    }


    .form-control-custom:hover {

        border-color: #c6cfdb;
    }


    .form-control-custom:focus {

        border-color: var(--intern-blue);

        box-shadow:
            0 0 0 3px rgba(51, 118, 242, .10);

        background: #fff;
    }


    .form-control-custom.is-invalid {

        border-color: var(--intern-danger);
    }


    .form-control-custom.is-invalid:focus {

        box-shadow:
            0 0 0 3px rgba(239, 68, 68, .08);
    }


    /* =========================================================
       SELECT
    ========================================================= */

    .select-wrapper::after {

        content: "\f107";

        position: absolute;

        right: 13px;
        top: 50%;

        transform: translateY(-50%);

        font-family: "Font Awesome 5 Free";

        font-weight: 900;

        color: #98a2b3;

        font-size: 12px;

        pointer-events: none;
    }


    select.form-control-custom {

        appearance: none;

        -webkit-appearance: none;

        cursor: pointer;

        padding-right: 35px;
    }


    /* =========================================================
       TEXTAREA
    ========================================================= */

    textarea.form-control-custom {

        min-height: 145px;

        padding: 12px;

        resize: vertical;

        line-height: 1.6;

        font-size: 13px;
    }


    /* =========================================================
       HELPER
    ========================================================= */

    .helper-text {

        display: flex;

        align-items: center;

        gap: 5px;

        margin-top: 6px;

        color: #8a94a6;

        font-size: 11px;

        line-height: 1.5;
    }


    .helper-text i {

        font-size: 9px;
    }


    /* =========================================================
       VALIDATION
    ========================================================= */

    .invalid-feedback {

        margin-top: 5px;

        color: var(--intern-danger);

        font-size: 12px;

        line-height: 1.4;
    }


    /* =========================================================
       ALERT
    ========================================================= */

    .alert-custom {

        display: flex;

        align-items: flex-start;

        gap: 9px;

        padding: 13px 14px;

        border-radius: 9px;

        margin-bottom: 19px;

        font-size: 13px;
    }


    .alert-success-custom {

        color: #166534;

        background: #f0fdf4;

        border: 1px solid #bbf7d0;
    }


    .alert-error-custom {

        color: #b42318;

        background: #fff5f4;

        border: 1px solid #fecdca;
    }


    .alert-error-custom strong {

        display: block;

        margin-bottom: 2px;
    }


    .alert-error-custom span {

        display: block;

        font-size: 12px;
    }


    /* =========================================================
       ACTION BUTTONS
    ========================================================= */

    .form-actions {

        display: flex;

        align-items: center;

        justify-content: flex-end;

        gap: 10px;

        padding-top: 23px;

        margin-top: 25px;

        border-top: 1px solid #edf0f5;
    }


    .btn-primary-custom,
    .btn-secondary-custom {

        display: inline-flex;

        align-items: center;
        justify-content: center;

        gap: 8px;

        min-height: 42px;

        padding: 10px 18px;

        border-radius: 8px;

        font-family: inherit;

        font-size: 13px;

        font-weight: 600;

        text-decoration: none;

        cursor: pointer;

        transition: all .2s ease;
    }


    .btn-primary-custom {

        border: 1px solid var(--intern-blue);

        background: var(--intern-blue);

        color: #fff;
    }


    .btn-primary-custom:hover {

        background: var(--intern-blue-dark);

        border-color: var(--intern-blue-dark);

        color: #fff;

        transform: translateY(-1px);
    }


    .btn-primary-custom:disabled {

        opacity: .7;

        cursor: not-allowed;

        transform: none;
    }


    .btn-secondary-custom {

        border: 1px solid #dce2ea;

        background: #fff;

        color: #475467;
    }


    .btn-secondary-custom:hover {

        background: #f8fafc;

        border-color: #cbd3df;

        color: #344054;
    }


    /* =========================================================
       SIDEBAR
    ========================================================= */

    .internship-sidebar {

        position: sticky;

        top: 85px;
    }


    /* =========================================================
       TIPS
    ========================================================= */

    .tips-card {

        background: #fff;

        border: 1px solid var(--intern-border);

        border-radius: 13px;

        padding: 21px;

        box-shadow:
            0 3px 15px rgba(30, 50, 80, .035);
    }


    .tips-header {

        display: flex;

        align-items: center;

        gap: 9px;

        margin-bottom: 20px;
    }


    .tips-icon {

        width: 31px;
        height: 31px;

        display: flex;

        align-items: center;
        justify-content: center;

        border-radius: 8px;

        background: var(--intern-blue-light);

        color: var(--intern-blue);

        font-size: 13px;
    }


    .tips-header h3 {

        margin: 0;

        color: var(--intern-heading);

        font-size: 15px;

        font-weight: 700;
    }


    .tip-item {

        display: flex;

        align-items: flex-start;

        gap: 9px;

        margin-bottom: 17px;
    }


    .tip-item:last-child {

        margin-bottom: 0;
    }


    .tip-bullet {

        width: 20px;
        height: 20px;

        flex-shrink: 0;

        display: flex;

        align-items: center;
        justify-content: center;

        border-radius: 50%;

        background: #edf4ff;

        color: var(--intern-blue);

        font-size: 9px;

        margin-top: 1px;
    }


    .tip-item p {

        margin: 0;

        color: #667085;

        font-size: 12px;

        line-height: 1.6;
    }


    .tip-item strong {

        color: #475467;

        font-weight: 700;
    }


    /* =========================================================
       QUICK CARD
    ========================================================= */

    .quick-card {

        display: flex;

        align-items: flex-start;

        gap: 10px;

        margin-top: 14px;

        padding: 16px;

        background: #f8faff;

        border: 1px solid #e1eaff;

        border-radius: 11px;
    }


    .quick-card-icon {

        color: var(--intern-blue);

        font-size: 14px;

        margin-top: 2px;
    }


    .quick-card h4 {

        margin: 0 0 4px;

        color: #344054;

        font-size: 12px;

        font-weight: 700;
    }


    .quick-card p {

        margin: 0;

        color: #7b8496;

        font-size: 11px;

        line-height: 1.55;
    }


    /* =========================================================
       TABLET
    ========================================================= */

    @media (max-width: 1000px) {

        .internship-layout {

            grid-template-columns: 1fr;
        }


        .internship-sidebar {

            position: static;
        }


        .tips-card {

            max-width: none;
        }

    }


    /* =========================================================
       MOBILE
    ========================================================= */

    @media (max-width: 700px) {

        .internship-page {

            padding: 22px 15px 40px;
        }


        .internship-page-header {

            align-items: flex-start;
        }


        .page-title-row {

            align-items: flex-start;
        }


        .page-title-icon {

            width: 43px;
            height: 43px;

            font-size: 18px;
        }


        .internship-page-header h1 {

            font-size: 23px;
        }


        .internship-page-header p {

            font-size: 12px;
        }


        .back-button span {

            display: none;
        }


        .back-button {

            width: 40px;
            height: 40px;

            padding: 0;

            flex-shrink: 0;
        }


        .progress-card {

            padding: 12px;
        }


        .progress-line {

            width: 25px;

            margin: 0 8px;
        }


        .progress-step span {

            display: none;
        }


        .form-card-body {

            padding: 19px;
        }


        .form-card-header {

            padding: 18px 19px;
        }


        .form-grid-2,
        .location-grid {

            grid-template-columns: 1fr;

            gap: 0;
        }


        .form-section {

            padding-bottom: 21px;

            margin-bottom: 21px;
        }


        .form-actions {

            flex-direction: column-reverse;

            align-items: stretch;
        }


        .btn-primary-custom,
        .btn-secondary-custom {

            width: 100%;
        }

    }


    /* =========================================================
       SMALL MOBILE
    ========================================================= */

    @media (max-width: 420px) {

        .internship-page {

            padding-left: 10px;

            padding-right: 10px;
        }


        .form-card-body {

            padding: 16px;
        }


        .internship-page-header h1 {

            font-size: 21px;
        }


        .internship-page-header p {

            font-size: 11px;
        }


        .form-card-header h2 {

            font-size: 16px;
        }


        .form-card-header p {

            font-size: 12px;
        }

    }

</style>
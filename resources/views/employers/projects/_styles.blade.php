<style>

    /* =========================================================
       PROJECT FORM
    ========================================================= */

    .project-form-container {
        max-width: 760px;
        margin: 0 auto;
        padding: 25px 15px 45px;
    }


    /* =========================================================
       CARD
    ========================================================= */

    .form-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(15, 23, 42, 0.05);
    }


    /* =========================================================
       HEADER
    ========================================================= */

    .form-card-header {
        padding: 20px 24px;
        border-bottom: 1px solid #e5e7eb;
        background: #ffffff;

        display: flex;
        align-items: center;
        gap: 13px;
    }


    .header-icon {
        width: 42px;
        height: 42px;

        border-radius: 10px;

        background: #eef4ff;
        color: #3376f2;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 18px;
    }


    .form-card-header h4 {
        margin: 0;

        font-size: 19px;
        font-weight: 600;

        color: #111827;
    }


    .form-card-header p {
        margin: 4px 0 0;

        font-size: 13px;
        color: #6b7280;
    }


    /* =========================================================
       BODY
    ========================================================= */

    .form-card-body {
        padding: 24px;
    }


    /* =========================================================
       FORM GROUP
    ========================================================= */

    .form-group-custom {
        margin-bottom: 17px;
    }


    .form-group-custom label {
        display: block;

        margin-bottom: 6px;

        font-size: 14px;
        font-weight: 500;

        color: #374151;
    }


    .form-label-icon {
        display: flex;
        align-items: center;
        gap: 7px;
    }


    .form-label-icon i {
        color: #6b7280;
        font-size: 13px;
        width: 15px;
        text-align: center;
    }


    .required {
        color: #ef4444;
        margin-left: 2px;
    }


    /* =========================================================
       INPUTS
    ========================================================= */

    .form-control-custom {
        width: 100%;
        height: 42px;

        padding: 9px 13px;

        border: 1px solid #d1d5db;
        border-radius: 8px;

        background: #ffffff;

        font-family: inherit;
        font-size: 14px;

        color: #111827;

        transition:
            border-color 0.2s ease,
            box-shadow 0.2s ease,
            background 0.2s ease;

        box-sizing: border-box;
    }


    .form-control-custom::placeholder {
        color: #9ca3af;
    }


    .form-control-custom:focus {
        outline: none;

        border-color: #3376f2;

        box-shadow:
            0 0 0 3px rgba(51, 118, 242, 0.10);

        background: #ffffff;
    }


    .form-control-custom.is-invalid {
        border-color: #ef4444;
    }


    .form-control-custom.is-invalid:focus {
        border-color: #ef4444;

        box-shadow:
            0 0 0 3px rgba(239, 68, 68, 0.08);
    }


    /* =========================================================
       SELECT
    ========================================================= */

    select.form-control-custom {
        appearance: none;

        cursor: pointer;

        padding-right: 38px;

        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='11' height='11' viewBox='0 0 12 12'%3E%3Cpath fill='%236b7280' d='M6 8L2 4h8z'/%3E%3C/svg%3E");

        background-repeat: no-repeat;

        background-position: right 13px center;
    }


    /* =========================================================
       TEXTAREA
    ========================================================= */

    textarea.form-control-custom {
        min-height: 120px;

        height: auto;

        resize: vertical;

        line-height: 1.55;
    }


    /* =========================================================
       TWO COLUMN ROW
    ========================================================= */

    .row-custom {
        display: grid;

        grid-template-columns: repeat(2, minmax(0, 1fr));

        gap: 16px;
    }


    .row-custom .form-group-custom {
        min-width: 0;
    }


    /* =========================================================
       LOCATION SECTION
    ========================================================= */

    #locationFields {
        margin-top: 5px;
    }


    .location-heading {
        display: flex;
        align-items: center;

        gap: 10px;

        padding: 13px 14px;

        margin-bottom: 16px;

        background: #f8faff;

        border: 1px solid #e3ebff;

        border-radius: 9px;
    }


    .location-heading-icon {
        width: 34px;
        height: 34px;

        border-radius: 8px;

        background: #eaf1ff;
        color: #3376f2;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 14px;
    }


    .location-heading h5 {
        margin: 0;

        font-size: 14px;
        font-weight: 600;

        color: #1f2937;
    }


    .location-heading p {
        margin: 2px 0 0;

        font-size: 12px;
        color: #6b7280;
    }


    /* =========================================================
       HELPER TEXT
    ========================================================= */

    .helper-text {
        display: flex;
        align-items: center;

        gap: 5px;

        margin-top: 5px;

        font-size: 12px;

        color: #6b7280;
    }


    .helper-text i {
        font-size: 11px;
    }


    /* =========================================================
       VALIDATION
    ========================================================= */

    .invalid-feedback {
        display: block;

        margin-top: 5px;

        font-size: 12px;

        line-height: 1.4;

        color: #ef4444;
    }


    /* =========================================================
       ALERT
    ========================================================= */

    .alert-custom {
        padding: 12px 14px;

        margin-bottom: 20px;

        border-radius: 8px;

        font-size: 13px;
    }


    .alert-success-custom {
        background: #ecfdf5;

        border: 1px solid #a7f3d0;

        color: #047857;
    }


    .alert-danger-custom {
        background: #fef2f2;

        border: 1px solid #fecaca;

        color: #b91c1c;
    }


    .alert-custom i {
        margin-right: 5px;
    }


    .alert-title {
        font-weight: 600;

        margin-bottom: 5px;
    }


    .alert-custom ul {
        margin: 5px 0 0 20px;

        padding: 0;
    }


    .alert-custom li {
        margin-bottom: 2px;
    }


    /* =========================================================
       ACTION BUTTONS
    ========================================================= */

    .form-actions {
        display: flex;
        align-items: center;

        gap: 10px;

        margin-top: 23px;

        padding-top: 18px;

        border-top: 1px solid #e5e7eb;
    }


    .btn-custom {
        height: 42px;

        padding: 0 20px;

        border: none;

        border-radius: 8px;

        font-family: inherit;

        font-size: 14px;

        font-weight: 500;

        cursor: pointer;

        text-decoration: none;

        display: inline-flex;

        align-items: center;

        justify-content: center;

        gap: 7px;

        transition:
            background 0.2s ease,
            transform 0.2s ease;
    }


    .btn-primary-custom {
        flex: 1;

        background: #3376f2;

        color: #ffffff;
    }


    .btn-primary-custom:hover {
        background: #2867dc;

        color: #ffffff;
    }


    .btn-primary-custom:disabled {
        opacity: 0.7;

        cursor: not-allowed;
    }


    .btn-secondary-custom {
        background: #f3f4f6;

        color: #374151;
    }


    .btn-secondary-custom:hover {
        background: #e5e7eb;

        color: #111827;
    }


    /* =========================================================
       MOBILE
    ========================================================= */

    @media (max-width: 768px) {

        .project-form-container {
            max-width: 100%;

            padding: 15px 10px 30px;
        }


        .form-card {
            border-radius: 11px;
        }


        .form-card-header {
            padding: 17px;
        }


        .form-card-body {
            padding: 18px;
        }


        .form-card-header h4 {
            font-size: 17px;
        }


        .form-card-header p {
            font-size: 12px;
        }


        .row-custom {
            grid-template-columns: 1fr;

            gap: 0;
        }


        .form-group-custom label {
            font-size: 13px;
        }


        .form-control-custom {
            font-size: 14px;

            height: 42px;
        }


        .form-actions {
            flex-direction: column;
        }


        .btn-custom {
            width: 100%;
        }


        .btn-primary-custom {
            flex: none;
        }

    }


    /* =========================================================
       SMALL MOBILE
    ========================================================= */

    @media (max-width: 480px) {

        .project-form-container {
            padding-left: 7px;
            padding-right: 7px;
        }


        .form-card-header {
            padding: 15px;
        }


        .form-card-body {
            padding: 15px;
        }


        .header-icon {
            width: 38px;
            height: 38px;

            font-size: 16px;
        }


        .form-card-header h4 {
            font-size: 16px;
        }

    }

</style>
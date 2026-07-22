<style>
    .project-form-container {
        max-width: 680px;
        margin: 0 auto;
        padding: 10px 0 30px;
    }

    .form-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        overflow: hidden;
    }

    .form-card-header {
        padding: 16px 20px;
        border-bottom: 1px solid #e5e7eb;
        background: #fff;
    }

    .form-card-header h4 {
        margin: 0;
        font-size: 17px;
        font-weight: 600;
        color: #111827;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-card-header p {
        margin: 4px 0 0;
        font-size: 12px;
        color: #6b7280;
    }

    .form-card-body {
        padding: 18px 20px;
    }

    .form-group-custom {
        margin-bottom: 14px;
    }

    .form-group-custom label {
        display: block;
        margin-bottom: 5px;
        font-size: 13px;
        font-weight: 500;
        color: #374151;
    }

    .required {
        color: #ef4444;
    }

    .form-control-custom {
        width: 100%;
        height: 38px;
        padding: 8px 12px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        background: #fff;
        font-size: 13px;
        color: #111827;
        transition: 0.2s ease;
    }

    .form-control-custom:focus {
        outline: none;
        border-color: #d97706;
        box-shadow: 0 0 0 3px rgba(217, 119, 6, 0.1);
    }

    .form-control-custom.is-invalid {
        border-color: #ef4444;
    }

    select.form-control-custom {
        appearance: none;
        cursor: pointer;
        padding-right: 36px;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' viewBox='0 0 12 12'%3E%3Cpath fill='%236b7280' d='M6 8L2 4h8z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
    }

    textarea.form-control-custom {
        min-height: 80px;
        height: auto;
        resize: vertical;
    }

    .invalid-feedback {
        margin-top: 4px;
        font-size: 12px;
        color: #ef4444;
    }

    .helper-text {
        margin-top: 4px;
        font-size: 11px;
        color: #6b7280;
    }

    .row-custom {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }

    .form-actions {
        margin-top: 18px;
        padding-top: 16px;
        border-top: 1px solid #e5e7eb;
        display: flex;
        gap: 10px;
    }

    .btn-custom {
        height: 38px;
        padding: 0 18px;
        border: none;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: 0.2s ease;
    }

    .btn-primary-custom {
        flex: 1;
        background: #4e7cde;
        color: #fff;
    }

    .btn-primary-custom:hover {
        background: #4b8ce7;
        color: #fff;
    }

    .btn-secondary-custom {
        background: #f3f4f6;
        color: #374151;
    }

    .btn-secondary-custom:hover {
        background: #e5e7eb;
    }

    .form-label-icon {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .form-label-icon i {
        color: #6b7280;
        font-size: 12px;
    }

    @media (max-width: 768px) {
        .project-form-container {
            padding: 10px;
        }

        .form-card-header,
        .form-card-body {
            padding: 16px;
        }

        .row-custom {
            grid-template-columns: 1fr;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn-custom {
            width: 100%;
        }
    }
</style>
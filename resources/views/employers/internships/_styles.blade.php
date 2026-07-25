<style>
  .internship-form-container {
    max-width: 680px;
    margin: 0 auto;
    padding: 10px 0 20px;
}

    .form-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        overflow: hidden;
    }

    .form-card-header {
         padding: 14px 20px;
        border-bottom: 1px solid #e5e7eb;
        background: #fff;
    }

    .form-card-header h4 {
        margin: 0;
        font-size: 18px;
        font-weight: 600;
        color: #111827;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-card-header p {
        margin: 6px 0 0;
        font-size: 13px;
        color: #6b7280;
    }

    .form-card-body {
        padding: 16px 20px;
    }

    .form-group-custom {
        margin-bottom: 12px;
    }

    .form-group-custom label {
        display: block;
        margin-bottom: 4px;
    font-size: 12px;
        font-weight: 500;
        color: #374151;
    }

    .required {
        color: #ef4444;
    }

    .form-control-custom {
        width: 100%;
        padding: 7px 10px;
    font-size: 13px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        background: #fff;
        transition: 0.2s;
    }

    .form-control-custom:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .form-control-custom.is-invalid {
        border-color: #ef4444;
    }

    textarea.form-control-custom {
        min-height: 70px;
        resize: vertical;
    }

    select.form-control-custom {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' viewBox='0 0 12 12'%3E%3Cpath fill='%236b7280' d='M6 8L2 4h8z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 14px center;
        padding-right: 36px;
    }

    .row-custom {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .invalid-feedback {
        color: #ef4444;
        font-size: 12px;
        margin-top: 5px;
    }

    .helper-text {
        margin-top: 5px;
        font-size: 12px;
        color: #6b7280;
    }

    .form-actions {
         margin-top: 16px;
    padding-top: 12px;
        border-top: 1px solid #e5e7eb;
        display: flex;
        gap: 12px;
    }

    .btn-custom {
        padding: 10px 18px;
        border-radius: 8px;
        border: none;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        text-decoration: none;
        transition: 0.2s;
    }

    .btn-primary-custom {
        background: #4771c9;
        color: #fff;
        flex: 1;
    }

    .btn-primary-custom:hover {
        background: #5088d6;
    }

    .btn-secondary-custom {
        background: #f3f4f6;
        color: #374151;
    }

    .btn-secondary-custom:hover {
        background: #e5e7eb;
    }

    @media (max-width: 768px) {
        .row-custom {
            grid-template-columns: 1fr;
        }

        .form-card-body,
        .form-card-header {
            padding: 18px;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn-custom {
            width: 100%;
        }
    }
</style>
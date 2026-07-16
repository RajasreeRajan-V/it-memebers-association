<style>
    .job-form-wrapper { max-width: 800px; margin: 0 auto; padding: 40px 20px; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; color: #1f2937; }
    .job-form-header h1 { font-size: 1.75rem; font-weight: 600; margin: 0 0 4px; color: #111827; }
    .job-form-header p { font-size: 0.9rem; color: #6b7280; margin: 0 0 32px; }
    .alert { border-radius: 10px; padding: 16px; margin-bottom: 24px; }
    .alert-error { background: #fef2f2; border: 1px solid #fecaca; }
    .alert-success { background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; }
    .alert-title { font-size: 0.875rem; font-weight: 600; color: #991b1b; margin: 0 0 8px; }
    .alert-error ul { margin: 0; padding-left: 18px; color: #b91c1c; font-size: 0.85rem; }
    .error-message { color: #dc2626; font-size: 0.8rem; margin-top: 4px; }
    .job-form { background: #ffffff; border: 1px solid #e5e7eb; border-radius: 14px; padding: 32px; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04); }
    .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-top: 24px; }
    .form-group { display: flex; flex-direction: column; margin-bottom: 24px; }
    .form-grid .form-group { margin-bottom: 0; }
    .span-2 { grid-column: span 2; }
    label { font-size: 0.85rem; font-weight: 500; color: #374151; margin-bottom: 6px; }
    .required { color: #dc2626; }
    .optional { color: #9ca3af; font-weight: 400; }
    input[type="text"], input[type="date"], input[type="number"], select, textarea {
        border: 1px solid #d1d5db; border-radius: 8px; padding: 10px 12px; font-size: 0.9rem;
        font-family: inherit; color: #111827; background: #ffffff;
        transition: border-color 0.15s ease, box-shadow 0.15s ease;
    }
    input:focus, select:focus, textarea:focus { outline: none; border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15); }
    textarea { resize: vertical; min-height: 120px; }
    .hint { font-size: 0.75rem; color: #9ca3af; margin: 4px 0 0; }
    .location-section { margin-bottom: 24px; }
    .location-section h2 { font-size: 0.9rem; font-weight: 600; color: #1f2937; margin: 0 0 12px; }
    .location-grid { background: #f9fafb; border: 1px solid #f3f4f6; border-radius: 10px; padding: 20px; margin-top: 0; }
    .form-actions { display: flex; justify-content: flex-end; gap: 12px; padding-top: 20px; border-top: 1px solid #f3f4f6; }
    .btn { display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; font-size: 0.9rem; font-weight: 500; padding: 10px 20px; cursor: pointer; border: none; text-decoration: none; transition: background-color 0.15s ease; }
    .btn-secondary { background: transparent; color: #4b5563; border: 1px solid #d1d5db; }
    .btn-secondary:hover { background: #f3f4f6; color: #1f2937; }
    .btn-primary { background: #4f46e5; color: #ffffff; }
    .btn-primary:hover { background: #4338ca; }
    @media (max-width: 640px) {
        .form-grid { grid-template-columns: 1fr; }
        .span-2 { grid-column: span 1; }
        .job-form { padding: 20px; }
    }
</style>

@push('styles')
<style>
    .jobpost-wrapper { max-width: 800px; margin: 0 auto; padding: 40px 20px 80px; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; color: #1f2937; }
    .jobpost-header h1 { font-size: 1.75rem; font-weight: 600; margin: 0 0 4px; color: #111827; }
    .jobpost-header p { font-size: 0.9rem; color: #6b7280; margin: 0 0 32px; }

    .jobpost-alert { border-radius: 10px; padding: 16px; margin-bottom: 24px; }
    .jobpost-alert-error { background: #fef2f2; border: 1px solid #fecaca; }
    .jobpost-alert-success { background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; }
    .jobpost-alert-title { font-size: 0.875rem; font-weight: 600; color: #991b1b; margin: 0 0 8px; }
    .jobpost-alert-error ul { margin: 0; padding-left: 18px; color: #b91c1c; font-size: 0.85rem; }
    .jobpost-error-message { color: #dc2626; font-size: 0.8rem; margin-top: 4px; }

    .jobpost-form { background: #ffffff; border: 1px solid #e5e7eb; border-radius: 14px; padding: 32px; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04); }

    .jobpost-form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-top: 24px; }
    .jobpost-form-group { display: flex; flex-direction: column; margin-bottom: 24px; }
    .jobpost-form-grid .jobpost-form-group { margin-bottom: 0; }
    .jobpost-span-2 { grid-column: span 2; }

    .jobpost-form-group label { font-size: 0.85rem; font-weight: 500; color: #374151; margin-bottom: 6px; }
    .jobpost-required { color: #dc2626; }
    .jobpost-optional { color: #9ca3af; font-weight: 400; }

    .jobpost-form-group input[type="text"],
    .jobpost-form-group input[type="date"],
    .jobpost-form-group input[type="number"],
    .jobpost-form-group select,
    .jobpost-form-group textarea {
        border: 1px solid #d1d5db; border-radius: 8px; padding: 10px 12px; font-size: 0.9rem;
        font-family: inherit; color: #111827; background: #ffffff; width: 100%;
        transition: border-color 0.15s ease, box-shadow 0.15s ease;
    }
    .jobpost-form-group input:focus,
    .jobpost-form-group select:focus,
    .jobpost-form-group textarea:focus { outline: none; border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15); }
    .jobpost-form-group textarea { resize: vertical; min-height: 120px; }

    .jobpost-hint { font-size: 0.75rem; color: #9ca3af; margin: 4px 0 0; }

    .jobpost-location-section { margin-bottom: 0; }
    .jobpost-location-section h2 { font-size: 0.9rem; font-weight: 600; color: #1f2937; margin: 0 0 12px; }
    .jobpost-location-grid { background: #f9fafb; border: 1px solid #f3f4f6; border-radius: 10px; padding: 20px; margin-top: 0; }

    /* Description + Location side by side */
    .jobpost-side-by-side {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
        align-items: start;
        grid-column: 1 / -1;
    }
    .jobpost-description-col textarea {
        height: 100%;
        min-height: 260px;
    }

    .jobpost-back {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 0.85rem;
    font-weight: 600;
    color: #64748b;
    background: #f8fafc;
    border: 1px solid #e5e7eb;
    padding: 8px 16px;
    border-radius: 999px;
    text-decoration: none;
    margin-bottom: 24px;
    transition: all 0.2s ease;
}

.jobpost-back svg {
    transition: transform 0.2s ease;
}

.jobpost-back:hover {
    color: #2563eb;
    background: #eff6ff;
    border-color: #bfdbfe;
    transform: translateX(-2px);
}

.jobpost-back:hover svg {
    transform: translateX(-2px);
}
    .jobpost-actions { display: flex; justify-content: flex-end; gap: 12px; padding-top: 20px; border-top: 1px solid #f3f4f6; }
    .jobpost-btn { display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; font-size: 0.9rem; font-weight: 500; padding: 10px 20px; cursor: pointer; border: none; text-decoration: none; transition: background-color 0.15s ease; }
    .jobpost-btn-secondary { background: transparent; color: #4b5563; border: 1px solid #d1d5db; }
    .jobpost-btn-secondary:hover { background: #f3f4f6; color: #1f2937; }
    .jobpost-btn-primary { background: #4f46e5; color: #ffffff; }
    .jobpost-btn-primary:hover { background: #4338ca; }

    @media (max-width: 640px) {
        .jobpost-form-grid { grid-template-columns: 1fr; }
        .jobpost-span-2 { grid-column: span 1; }
        .jobpost-form { padding: 20px; }
        .jobpost-side-by-side { grid-template-columns: 1fr; }
    }
</style>
@endpush
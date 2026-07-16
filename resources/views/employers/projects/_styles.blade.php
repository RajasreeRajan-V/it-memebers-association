<style>
    .project-form-container { max-width: 700px; margin: 0 auto; padding: 15px 0 40px; }
    .form-card { background: #ffffff; border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06); overflow: hidden; border: 1px solid rgba(0, 0, 0, 0.05); }
    .form-card-header { background: linear-gradient(135deg, #92400e 0%, #d97706 100%); padding: 18px 25px; color: white; position: relative; overflow: hidden; }
    .form-card-header::before { content: ''; position: absolute; top: -50%; right: -20%; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%; pointer-events: none; }
    .form-card-header h4 { font-weight: 600; font-size: 18px; margin: 0 0 4px 0; position: relative; z-index: 1; display: flex; align-items: center; gap: 10px; }
    .form-card-header h4 i { font-size: 20px; opacity: 0.9; }
    .form-card-header p { margin: 0; opacity: 0.85; font-size: 12px; position: relative; z-index: 1; font-weight: 300; }
    .form-card-body { padding: 20px 25px; }
    .form-group-custom { margin-bottom: 14px; }
    .form-group-custom label { font-weight: 600; color: #2d3748; font-size: 13px; margin-bottom: 4px; display: block; }
    .form-group-custom label .required { color: #e53e3e; margin-left: 3px; }
    .form-control-custom { width: 100%; padding: 8px 12px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 13px; transition: all 0.3s ease; background: #f7fafc; color: #2d3748; }
    .form-control-custom:focus { border-color: #d97706; background: #ffffff; box-shadow: 0 0 0 3px rgba(217,119,6,0.12); outline: none; }
    .form-control-custom:hover { border-color: #a0aec0; }
    .form-control-custom.is-invalid { border-color: #fc8181; background: #fff5f5; }
    select.form-control-custom {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' viewBox='0 0 12 12'%3E%3Cpath fill='%234a5568' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat; background-position: right 12px center; padding-right: 32px; cursor: pointer;
    }
    textarea.form-control-custom { resize: vertical; min-height: 90px; font-size: 13px; }
    .invalid-feedback { font-size: 12px; color: #e53e3e; margin-top: 4px; display: flex; align-items: center; gap: 4px; }
    .invalid-feedback::before { content: '⚠'; font-size: 12px; }
    .alert-custom { padding: 10px 16px; border-radius: 8px; margin-bottom: 16px; font-size: 13px; font-weight: 500; }
    .alert-success-custom { background: #f0fff4; border: 2px solid #48bb78; color: #22543d; }
    .alert-success-custom::before { content: '✓'; margin-right: 8px; font-weight: bold; color: #48bb78; }
    .alert-error-custom { background: #fff5f5; border: 2px solid #fc8181; color: #742a2a; }
    .alert-error-custom::before { content: '✕'; margin-right: 8px; font-weight: bold; color: #fc8181; }
    .row-custom { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
    .form-actions { margin-top: 20px; padding-top: 16px; border-top: 2px solid #f7fafc; display: flex; gap: 12px; flex-wrap: wrap; }
    .btn-custom { padding: 8px 20px; border: none; border-radius: 8px; font-weight: 600; font-size: 13px; transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 8px; cursor: pointer; text-decoration: none; }
    .btn-primary-custom { background: linear-gradient(135deg, #92400e 0%, #d97706 100%); color: white; flex: 1; justify-content: center; }
    .btn-primary-custom:hover { transform: translateY(-1px); box-shadow: 0 4px 15px rgba(217,119,6,0.35); color: white; }
    .btn-secondary-custom { background: #edf2f7; color: #4a5568; flex: 0.4; justify-content: center; }
    .btn-secondary-custom:hover { background: #e2e8f0; color: #2d3748; }
    .helper-text { font-size: 11px; color: #718096; margin-top: 3px; display: flex; align-items: center; gap: 4px; }
    .helper-text i { font-size: 11px; }
    .form-label-icon { display: flex; align-items: center; gap: 6px; }
    .form-label-icon i { color: #d97706; font-size: 13px; width: 16px; }
    @media (max-width: 768px) {
        .form-card-header { padding: 15px 18px; }
        .form-card-header h4 { font-size: 16px; }
        .form-card-body { padding: 16px 18px; }
        .row-custom { grid-template-columns: 1fr; gap: 0; }
        .form-actions { flex-direction: column; }
        .btn-custom { width: 100%; justify-content: center; }
        .btn-secondary-custom { flex: 1; }
        .project-form-container { padding: 10px; }
    }
</style>

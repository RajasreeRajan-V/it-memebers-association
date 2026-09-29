{{-- Hidden JS templates used to dynamically add new modules / sessions --}}
<template id="module-template">
<div class="module-block card mb-3" data-mi="__MI__">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <label class="form-label fw-bold mb-0">Module __MI__</label>
            <button type="button" class="btn btn-sm btn-outline-danger remove-module">Remove Module</button>
        </div>
        <input type="text" name="modules[__MI__][title]" class="form-control mb-3" placeholder="Module title">
        <div class="sessions-wrapper ps-3 border-start">
            <div class="session-block border rounded p-2 mb-2">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <strong class="small">Session 1</strong>
                    <button type="button" class="btn btn-sm btn-outline-danger remove-session">&times;</button>
                </div>
                <input type="text" name="modules[__MI__][sessions][0][title]" class="form-control form-control-sm mb-2" placeholder="Session title">
                <textarea name="modules[__MI__][sessions][0][description]" class="form-control form-control-sm mb-2" rows="2" placeholder="Description"></textarea>
                <div class="row g-2">
                    <div class="col-md-6">
                        <label class="form-label small mb-1">Video</label>
                        <input type="file" name="modules[__MI__][sessions][0][video]" class="form-control form-control-sm" accept="video/*">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small mb-1">PDF</label>
                        <input type="file" name="modules[__MI__][sessions][0][pdf]" class="form-control form-control-sm" accept="application/pdf">
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-sm btn-outline-primary mt-2 add-session">+ Add Session</button>
    </div>
</div>
</template>

<template id="session-template">
<div class="session-block border rounded p-2 mb-2">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <strong class="small">New Session</strong>
        <button type="button" class="btn btn-sm btn-outline-danger remove-session">&times;</button>
    </div>
    <input type="text" name="modules[__MI__][sessions][__SI__][title]" class="form-control form-control-sm mb-2" placeholder="Session title">
    <textarea name="modules[__MI__][sessions][__SI__][description]" class="form-control form-control-sm mb-2" rows="2" placeholder="Description"></textarea>
    <div class="row g-2">
        <div class="col-md-6">
            <label class="form-label small mb-1">Video</label>
            <input type="file" name="modules[__MI__][sessions][__SI__][video]" class="form-control form-control-sm" accept="video/*">
        </div>
        <div class="col-md-6">
            <label class="form-label small mb-1">PDF</label>
            <input type="file" name="modules[__MI__][sessions][__SI__][pdf]" class="form-control form-control-sm" accept="application/pdf">
        </div>
    </div>
</div>
</template>

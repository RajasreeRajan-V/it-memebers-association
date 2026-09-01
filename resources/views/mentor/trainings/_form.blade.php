{{-- Shared form used by both create.blade.php and edit.blade.php --}}
@csrf
@if($training->exists) @method('PUT') @endif
@include('mentor.trainings._templates')

<!-- 1. Basic Information -->
<div class="card mb-4">
    <div class="card-header fw-bold"><i class="bi bi-info-circle"></i> 1. Basic Information</div>
    <div class="card-body row g-3">
        <div class="col-md-6">
            <label class="form-label">Training Title *</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $training->title) }}" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Category *</label>
            <input type="text" name="category" class="form-control" value="{{ old('category', $training->category) }}" required>
        </div>

        <div class="col-12">
            <label class="form-label">Short Description *</label>
            <input type="text" name="short_description" maxlength="500" class="form-control"
                   value="{{ old('short_description', $training->short_description) }}" required>
        </div>

        <div class="col-12">
            <label class="form-label">Full Description *</label>
            <textarea name="full_description" rows="5" class="form-control" required>{{ old('full_description', $training->full_description) }}</textarea>
        </div>

        <div class="col-md-4">
            <label class="form-label">Technology / Skill *</label>
            <input type="text" name="technology" class="form-control" value="{{ old('technology', $training->technology) }}" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Level *</label>
            <select name="level" class="form-select" required>
                @foreach (['beginner' => 'Beginner', 'intermediate' => 'Intermediate', 'advanced' => 'Advanced'] as $val => $label)
                    <option value="{{ $val }}" @selected(old('level', $training->level) === $val)>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label">Training Type *</label>
            <select name="training_type" id="training_type" class="form-select" required>
                @foreach (['recorded' => 'Recorded', 'live' => 'Live', 'hybrid' => 'Hybrid'] as $val => $label)
                    <option value="{{ $val }}" @selected(old('training_type', $training->training_type) === $val)>{{ $label }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-12">
            <label class="form-label">Thumbnail *</label>
            <input type="file" name="thumbnail" accept="image/*" class="form-control" {{ $training->exists ? '' : 'required' }}>
            @if ($training->thumbnail)
                <img src="{{ asset('storage/'.$training->thumbnail) }}" class="mt-2 rounded" height="80" alt="current thumbnail">
            @endif
        </div>
    </div>
</div>

<!-- 2. Training Details -->
<div class="card mb-4">
    <div class="card-header fw-bold"><i class="bi bi-sliders"></i> 2. Training Details</div>
    <div class="card-body row g-3">
        <div class="col-md-3">
            <label class="form-label">Duration *</label>
            <input type="text" name="duration" class="form-control" placeholder="e.g. 6 Weeks"
                   value="{{ old('duration', $training->duration) }}" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">Total Sessions *</label>
            <input type="number" min="1" name="total_sessions" class="form-control"
                   value="{{ old('total_sessions', $training->total_sessions) }}" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">Session Duration *</label>
            <input type="text" name="session_duration" class="form-control" placeholder="e.g. 1.5 hrs"
                   value="{{ old('session_duration', $training->session_duration) }}" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">Language *</label>
            <input type="text" name="language" class="form-control" value="{{ old('language', $training->language ?? '') }}" required>
        </div>

        <div class="col-md-4">
            <label class="form-label">Start Date</label>
            <input type="date" name="start_date" class="form-control"
                   value="{{ old('start_date', optional($training->start_date)->format('Y-m-d')) }}">
        </div>
        <div class="col-md-4">
            <label class="form-label">End Date</label>
            <input type="date" name="end_date" class="form-control"
                   value="{{ old('end_date', optional($training->end_date)->format('Y-m-d')) }}">
        </div>
        <div class="col-md-4">
            <label class="form-label">Maximum Participants</label>
            <input type="number" min="1" name="max_participants" class="form-control"
                   value="{{ old('max_participants', $training->max_participants) }}">
        </div>
    </div>
</div>

<!-- 3. What You'll Learn -->
<div class="card mb-4">
    <div class="card-header fw-bold"><i class="bi bi-lightbulb"></i> 3. What You'll Learn</div>
    <div class="card-body">
        <div id="outcomes-wrapper">
            @php $oldOutcomes = old('outcomes', $training->outcomes->pluck('outcome')->toArray() ?: ['']); @endphp
            @foreach ($oldOutcomes as $outcome)
                <div class="input-group mb-2 outcome-row">
                    <input type="text" name="outcomes[]" class="form-control" placeholder="Learning outcome" value="{{ $outcome }}">
                    <button type="button" class="btn btn-outline-danger remove-row">&times;</button>
                </div>
            @endforeach
        </div>
        <button type="button" class="btn btn-sm btn-outline-primary" id="add-outcome">+ Add Outcome</button>
    </div>
</div>

<!-- 4. Requirements -->
<div class="card mb-4">
    <div class="card-header fw-bold"><i class="bi bi-list-check"></i> 4. Requirements</div>
    <div class="card-body">
        <div id="requirements-wrapper">
            @php $oldReqs = old('requirements', $training->requirements->pluck('requirement')->toArray() ?: ['']); @endphp
            @foreach ($oldReqs as $req)
                <div class="input-group mb-2 requirement-row">
                    <input type="text" name="requirements[]" class="form-control" placeholder="Prerequisite" value="{{ $req }}">
                    <button type="button" class="btn btn-outline-danger remove-row">&times;</button>
                </div>
            @endforeach
        </div>
        <button type="button" class="btn btn-sm btn-outline-primary" id="add-requirement">+ Add Requirement</button>
    </div>
</div>

<!-- 5. Curriculum -->
<div class="card mb-4">
    <div class="card-header fw-bold"><i class="bi bi-diagram-3"></i> 5. Curriculum</div>
    <div class="card-body">
        <div id="modules-wrapper">
            @forelse ($training->modules as $mi => $module)
                @include('mentor.trainings._module-row', ['mi' => $mi, 'module' => $module])
            @empty
                @include('mentor.trainings._module-row', ['mi' => 0, 'module' => null])
            @endforelse
        </div>
        <button type="button" class="btn btn-sm btn-outline-primary" id="add-module">+ Add Module</button>
    </div>
</div>

<!-- 6. Training Resources -->
<div class="card mb-4">
    <div class="card-header fw-bold"><i class="bi bi-folder2-open"></i> 6. Training Resources</div>
    <div class="card-body">
        <label class="form-label">PDF / Documents (you can select multiple files)</label>
        <input type="file" name="resources[]" class="form-control" multiple accept=".pdf,.doc,.docx">
        @if ($training->resources->count())
            <ul class="list-group mt-3">
                @foreach ($training->resources as $resource)
                    <li class="list-group-item d-flex justify-content-between">
                        <span><i class="bi bi-file-earmark"></i> {{ $resource->title }}</span>
                        <a href="{{ asset('storage/'.$resource->file_path) }}" target="_blank">View</a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>

<!-- 7. Live Training Details -->
<div class="card mb-4" id="live-details" style="{{ old('training_type', $training->training_type) === 'live' || old('training_type', $training->training_type) === 'hybrid' ? '' : 'display:none;' }}">
    <div class="card-header fw-bold"><i class="bi bi-camera-video"></i> 7. Live Training Details</div>
    <div class="card-body row g-3">
        <div class="col-md-4">
            <label class="form-label">Platform</label>
            <input type="text" name="platform" class="form-control" placeholder="Zoom / Google Meet / MS Teams"
                   value="{{ old('platform', $training->platform) }}">
        </div>
        <div class="col-md-4">
            <label class="form-label">Meeting Link</label>
            <input type="url" name="meeting_link" class="form-control" placeholder="https://..."
                   value="{{ old('meeting_link', $training->meeting_link) }}">
        </div>
        <div class="col-md-4">
            <label class="form-label">Schedule</label>
            <input type="text" name="schedule" class="form-control" placeholder="e.g. Mon/Wed 7 PM IST"
                   value="{{ old('schedule', $training->schedule) }}">
        </div>
    </div>
</div>

<!-- 9. Certificate -->
<div class="card mb-4">
    <div class="card-header fw-bold"><i class="bi bi-patch-check"></i> 9. Certificate</div>
    <div class="card-body">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" name="certificate_enabled" value="1" id="certificate_enabled"
                   {{ old('certificate_enabled', $training->certificate_enabled) ? 'checked' : '' }}>
            <label class="form-check-label" for="certificate_enabled">Enable Certificate on completion</label>
        </div>
    </div>
</div>

<!-- Actions -->
<div class="d-flex gap-2 justify-content-end sticky-bottom bg-white py-3 border-top">
    <button type="submit" name="action" value="draft" class="btn btn-outline-secondary">
        <i class="bi bi-save"></i> Save as Draft
    </button>
    <button type="submit" name="action" value="submit" class="btn btn-success">
        <i class="bi bi-send-check"></i> Submit for Admin Approval
    </button>
</div>

@push('scripts')
<script>
document.getElementById('training_type').addEventListener('change', function () {
    document.getElementById('live-details').style.display =
        (this.value === 'live' || this.value === 'hybrid') ? '' : 'none';
});

function addSimpleRow(wrapperId, name, placeholder) {
    const wrapper = document.getElementById(wrapperId);
    const div = document.createElement('div');
    div.className = 'input-group mb-2';
    div.innerHTML = `<input type="text" name="${name}" class="form-control" placeholder="${placeholder}">
                      <button type="button" class="btn btn-outline-danger remove-row">&times;</button>`;
    wrapper.appendChild(div);
}

document.getElementById('add-outcome').addEventListener('click', () =>
    addSimpleRow('outcomes-wrapper', 'outcomes[]', 'Learning outcome'));

document.getElementById('add-requirement').addEventListener('click', () =>
    addSimpleRow('requirements-wrapper', 'requirements[]', 'Prerequisite'));

document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-row')) {
        e.target.closest('.input-group').remove();
    }
});

let moduleIndex = {{ max(1, $training->modules->count()) }};
document.getElementById('add-module').addEventListener('click', function () {
    const wrapper = document.getElementById('modules-wrapper');
    const template = document.getElementById('module-template').innerHTML
        .replaceAll('__MI__', moduleIndex);
    const div = document.createElement('div');
    div.innerHTML = template;
    wrapper.appendChild(div.firstElementChild);
    moduleIndex++;
});

document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-module')) {
        e.target.closest('.module-block').remove();
    }
    if (e.target.classList.contains('remove-session')) {
        e.target.closest('.session-block').remove();
    }
});

document.addEventListener('click', function (e) {
    if (e.target.classList.contains('add-session')) {
        const moduleBlock = e.target.closest('.module-block');
        const mi = moduleBlock.dataset.mi;
        const sessionsWrapper = moduleBlock.querySelector('.sessions-wrapper');
        let si = sessionsWrapper.children.length;
        const template = document.getElementById('session-template').innerHTML
            .replaceAll('__MI__', mi).replaceAll('__SI__', si);
        const div = document.createElement('div');
        div.innerHTML = template;
        sessionsWrapper.appendChild(div.firstElementChild);
    }
});
</script>
@endpush

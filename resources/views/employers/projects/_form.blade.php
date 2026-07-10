{{-- resources/views/employer/projects/_form.blade.php --}}
@php
    $project = $project ?? null;
    $skillsValue = old('skills', $project && $project->skills ? implode(', ', $project->skills) : '');
@endphp

<div class="form-grid">
    <div class="form-group full">
        <label>Project Title <span class="req">*</span></label>
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
               value="{{ old('title', $project->title ?? '') }}" placeholder="e.g. E-commerce Website" required>
        @error('title') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="form-group">
        <label>Project Type</label>
        <input type="text" name="project_type" class="form-control"
               value="{{ old('project_type', $project->project_type ?? '') }}" placeholder="e.g. Website, Mobile App">
    </div>

    <div class="form-group">
        <label>Budget <span class="req">*</span></label>
        <input type="text" name="budget" class="form-control @error('budget') is-invalid @enderror"
               value="{{ old('budget', $project->budget ?? '') }}" placeholder="e.g. ₹15,000 - ₹25,000" required>
        @error('budget') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="form-group">
        <label>Duration</label>
        <input type="text" name="duration" class="form-control"
               value="{{ old('duration', $project->duration ?? '') }}" placeholder="e.g. 2 weeks">
    </div>

    <div class="form-group">
        <label>Deadline</label>
        <input type="date" name="deadline" class="form-control @error('deadline') is-invalid @enderror"
               value="{{ old('deadline', optional($project->deadline ?? null)->format('Y-m-d')) }}">
        @error('deadline') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="form-group full">
        <label>Skills</label>
        <input type="text" name="skills" class="form-control"
               value="{{ $skillsValue }}" placeholder="Comma separated, e.g. PHP, React, Figma">
        <span class="hint">Separate each skill with a comma.</span>
    </div>

    <div class="form-group full">
        <label>Description <span class="req">*</span></label>
        <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                  placeholder="Scope of work, deliverables, requirements..." required>{{ old('description', $project->description ?? '') }}</textarea>
        @error('description') <div class="error-text">{{ $message }}</div> @enderror
    </div>
</div>

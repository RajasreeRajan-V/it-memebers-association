@php $project = $project ?? null; @endphp

<div class="form-group-custom">
    <label for="title" class="form-label-icon">
        <i class="fas fa-briefcase"></i>
        Project Title <span class="required">*</span>
    </label>
    <input type="text" class="form-control-custom @error('title') is-invalid @enderror"
           id="title" name="title" value="{{ old('title', $project->title ?? '') }}"
           placeholder="e.g., Build a Shopify Storefront" required>
    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="row-custom">
    <div class="form-group-custom">
        <label for="project_type" class="form-label-icon">
            <i class="fas fa-tag"></i>
            Budget Type <span class="required">*</span>
        </label>
        <select class="form-control-custom @error('project_type') is-invalid @enderror"
                id="project_type" name="project_type" required>
            <option value="">Select Type</option>
            @foreach (['fixed' => 'Fixed Price', 'hourly' => 'Hourly Rate'] as $value => $label)
                <option value="{{ $value }}" @selected(old('project_type', $project->project_type ?? '') == $value)>{{ $label }}</option>
            @endforeach
        </select>
        @error('project_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="form-group-custom">
        <label for="budget" class="form-label-icon">
            <i class="fas fa-money-bill-wave"></i>
            Budget <span class="required">*</span>
        </label>
        <input type="text" class="form-control-custom @error('budget') is-invalid @enderror"
               id="budget" name="budget" value="{{ old('budget', $project->budget ?? '') }}"
               placeholder="e.g., $500 - $1,000" required>
        @error('budget') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="row-custom">
    <div class="form-group-custom">
        <label for="duration" class="form-label-icon">
            <i class="fas fa-clock"></i>
            Duration <span class="required">*</span>
        </label>
        <input type="text" class="form-control-custom @error('duration') is-invalid @enderror"
               id="duration" name="duration" value="{{ old('duration', $project->duration ?? '') }}"
               placeholder="e.g., 2-4 weeks" required>
        @error('duration') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="form-group-custom">
        <label for="experience_level" class="form-label-icon">
            <i class="fas fa-chart-line"></i>
            Experience Level
        </label>
        <select class="form-control-custom @error('experience_level') is-invalid @enderror"
                id="experience_level" name="experience_level">
            <option value="">Select Level</option>
            @foreach (['entry' => 'Entry Level', 'intermediate' => 'Intermediate', 'expert' => 'Expert'] as $value => $label)
                <option value="{{ $value }}" @selected(old('experience_level', $project->experience_level ?? '') == $value)>{{ $label }}</option>
            @endforeach
        </select>
        @error('experience_level') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="row-custom">
    <div class="form-group-custom">
        <label for="skills" class="form-label-icon">
            <i class="fas fa-code"></i>
            Required Skills
        </label>
        <input type="text" class="form-control-custom @error('skills') is-invalid @enderror"
               id="skills" name="skills" value="{{ old('skills', $project->skills ?? '') }}"
               placeholder="React, Node.js, Figma">
        @error('skills') <div class="invalid-feedback">{{ $message }}</div> @enderror
        <div class="helper-text"><i class="fas fa-info-circle"></i> Separate with commas</div>
    </div>

    <div class="form-group-custom">
        <label for="deadline" class="form-label-icon">
            <i class="fas fa-calendar-alt"></i>
            Submission Deadline
        </label>
        <input type="date" class="form-control-custom @error('deadline') is-invalid @enderror"
               id="deadline" name="deadline"
               value="{{ old('deadline', optional($project->deadline ?? null)->format('Y-m-d')) }}">
        @error('deadline') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>



<div class="form-group-custom">
    <label>Work Mode</label>

    <select id="work_mode" name="work_mode" class="form-control-custom">
        <option value="remote">Remote</option>
        <option value="onsite">On-site</option>
        <option value="hybrid">Hybrid</option>
    </select>
</div>

<div id="locationFields">

    <div class="row-custom">
        <div class="form-group-custom">
            <label for="country" class="form-label-icon">
                <i class="fas fa-globe"></i> Country
            </label>

            <input type="text"
                   class="form-control-custom @error('country') is-invalid @enderror"
                   id="country"
                   name="country"
                   value="{{ old('country', $project->country ?? '') }}"
                   placeholder="Country">

            @error('country')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group-custom">
            <label for="state" class="form-label-icon">
                <i class="fas fa-map-pin"></i> State
            </label>

            <input type="text"
                   class="form-control-custom @error('state') is-invalid @enderror"
                   id="state"
                   name="state"
                   value="{{ old('state', $project->state ?? '') }}"
                   placeholder="State">

            @error('state')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group-custom">
            <label for="district" class="form-label-icon">
                <i class="fas fa-map-marked-alt"></i> District
            </label>

            <input type="text"
                   class="form-control-custom @error('district') is-invalid @enderror"
                   id="district"
                   name="district"
                   value="{{ old('district', $project->district ?? '') }}"
                   placeholder="District">

            @error('district')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group-custom">
            <label for="city" class="form-label-icon">
                <i class="fas fa-city"></i> City
            </label>

            <input type="text"
                   class="form-control-custom @error('city') is-invalid @enderror"
                   id="city"
                   name="city"
                   value="{{ old('city', $project->city ?? '') }}"
                   placeholder="City">

            @error('city')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

</div>

<div class="form-group-custom">
    <label for="description" class="form-label-icon">
        <i class="fas fa-align-left"></i>
        Description <span class="required">*</span>
    </label>
    <textarea class="form-control-custom @error('description') is-invalid @enderror"
              id="description" name="description" rows="5"
              placeholder="Describe the scope of work, deliverables, and expectations..." required>{{ old('description', $project->description ?? '') }}</textarea>
    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

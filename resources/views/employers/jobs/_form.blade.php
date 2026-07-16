@php $job = $job ?? null; @endphp

{{-- Job Title --}}
<div class="form-group">
    <label for="title">Job Title <span class="required">*</span></label>
    <input type="text" name="title" id="title" required
           value="{{ old('title', $job->title ?? '') }}"
           placeholder="e.g. Senior Backend Developer">
    @error('title') <p class="error-message">{{ $message }}</p> @enderror
</div>

<div class="form-grid">

    <div class="form-group">
        <label for="employment_type">Employment Type <span class="required">*</span></label>
        <select name="employment_type" id="employment_type" required>
            <option value="">Select employment type</option>
            @foreach (['full-time' => 'Full-time', 'part-time' => 'Part-time', 'contract' => 'Contract', 'freelance' => 'Freelance'] as $value => $label)
                <option value="{{ $value }}" @selected(old('employment_type', $job->employment_type ?? '') == $value)>{{ $label }}</option>
            @endforeach
        </select>
        @error('employment_type') <p class="error-message">{{ $message }}</p> @enderror
    </div>

    <div class="form-group">
        <label for="work_mode">Work Mode <span class="required">*</span></label>
        <select name="work_mode" id="work_mode" required>
            <option value="">Select work mode</option>
            @foreach (['onsite' => 'Onsite', 'hybrid' => 'Hybrid', 'remote' => 'Remote'] as $value => $label)
                <option value="{{ $value }}" @selected(old('work_mode', $job->work_mode ?? '') == $value)>{{ $label }}</option>
            @endforeach
        </select>
        @error('work_mode') <p class="error-message">{{ $message }}</p> @enderror
    </div>

    <div class="form-group">
        <label for="experience">Experience</label>
        <input type="text" name="experience" id="experience"
               value="{{ old('experience', $job->experience ?? '') }}"
               placeholder="e.g. 2-4 years">
        @error('experience') <p class="error-message">{{ $message }}</p> @enderror
    </div>

    <div class="form-group">
        <label for="salary">Salary</label>
        <input type="text" name="salary" id="salary"
               value="{{ old('salary', $job->salary ?? '') }}"
               placeholder="e.g. $60,000 - $80,000 / year">
        @error('salary') <p class="error-message">{{ $message }}</p> @enderror
    </div>

    <div class="form-group span-2">
        <label for="qualification">Qualification</label>
        <input type="text" name="qualification" id="qualification"
               value="{{ old('qualification', $job->qualification ?? '') }}"
               placeholder="e.g. Bachelor's degree in Computer Science">
        @error('qualification') <p class="error-message">{{ $message }}</p> @enderror
    </div>

  <div class="form-group span-2">
    <label for="skills">Skills</label>

    <input type="text"
           name="skills"
           id="skills"
           value="{{ old('skills', isset($job) && is_array($job->skills) ? implode(', ', $job->skills) : ($job->skills ?? '')) }}"
           placeholder="Comma-separated, e.g. Laravel, MySQL, REST APIs">

    <p class="hint">Separate each skill with a comma.</p>

    @error('skills')
        <p class="error-message">{{ $message }}</p>
    @enderror
</div>

<div class="location-section">
    <h2>Location</h2>
    <div class="form-grid location-grid">

        <div class="form-group">
            <label for="country">Country <span class="optional">(optional)</span></label>
            <input type="text" name="country" id="country"
                   value="{{ old('country', $job->country ?? '') }}"
                   placeholder="e.g. India">
            @error('country') <p class="error-message">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label for="state">State <span class="required">*</span></label>
            <input type="text" name="state" id="state" required
                   value="{{ old('state', $job->state ?? '') }}"
                   placeholder="e.g. Kerala">
            @error('state') <p class="error-message">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label for="district">District <span class="required">*</span></label>
            <input type="text" name="district" id="district" required
                   value="{{ old('district', $job->district ?? '') }}"
                   placeholder="e.g. Kasaragod">
            @error('district') <p class="error-message">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label for="city">City <span class="required">*</span></label>
            <input type="text" name="city" id="city" required
                   value="{{ old('city', $job->city ?? '') }}"
                   placeholder="e.g. Kanhangad">
            @error('city') <p class="error-message">{{ $message }}</p> @enderror
        </div>
    </div>
</div>

<div class="form-group">
    <label for="description">Description <span class="required">*</span></label>
    <textarea name="description" id="description" rows="6" required
              placeholder="Describe the role, responsibilities, and requirements...">{{ old('description', $job->description ?? '') }}</textarea>
    @error('description') <p class="error-message">{{ $message }}</p> @enderror
</div>

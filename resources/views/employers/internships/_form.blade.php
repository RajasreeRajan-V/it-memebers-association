@php $internship = $internship ?? null; @endphp

<div class="form-group-custom">
    <label for="title" class="form-label-icon">
        <i class="fas fa-heading"></i>
        Internship Title <span class="required">*</span>
    </label>
    <input type="text" class="form-control-custom @error('title') is-invalid @enderror"
           id="title" name="title" value="{{ old('title', $internship->title ?? '') }}"
           placeholder="e.g., Web Development Internship" required>
    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="row-custom">
    <div class="form-group-custom">
        <label for="internship_type" class="form-label-icon">
            <i class="fas fa-tag"></i>
            Type <span class="required">*</span>
        </label>
        <select class="form-control-custom @error('internship_type') is-invalid @enderror"
                id="internship_type" name="internship_type" required>
            <option value="">Select Type</option>
            @foreach (['paid' => 'Paid', 'unpaid' => 'Unpaid', 'stipend' => 'Stipend'] as $value => $label)
                <option value="{{ $value }}" @selected(old('internship_type', $internship->internship_type ?? '') == $value)>{{ $label }}</option>
            @endforeach
        </select>
        @error('internship_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="form-group-custom">
        <label for="work_mode" class="form-label-icon">
            <i class="fas fa-laptop-house"></i>
            Mode <span class="required">*</span>
        </label>
        <select class="form-control-custom @error('work_mode') is-invalid @enderror"
                id="work_mode" name="work_mode" required>
            <option value="">Select Mode</option>
            @foreach (['onsite' => 'Onsite', 'hybrid' => 'Hybrid', 'remote' => 'Remote'] as $value => $label)
                <option value="{{ $value }}" @selected(old('work_mode', $internship->work_mode ?? '') == $value)>{{ $label }}</option>
            @endforeach
        </select>
        @error('work_mode') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="row-custom">
    <div class="form-group-custom">
        <label for="duration" class="form-label-icon">
            <i class="fas fa-clock"></i>
            Duration <span class="required">*</span>
        </label>
        <input type="text" class="form-control-custom @error('duration') is-invalid @enderror"
               id="duration" name="duration" value="{{ old('duration', $internship->duration ?? '') }}"
               placeholder="e.g., 3 months" required>
        @error('duration') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="form-group-custom">
        <label for="stipend" class="form-label-icon">
            <i class="fas fa-money-bill-wave"></i>
            Stipend
        </label>
        <input type="text" class="form-control-custom @error('stipend') is-invalid @enderror"
               id="stipend" name="stipend" value="{{ old('stipend', $internship->stipend ?? '') }}"
               placeholder="e.g., $500/month">
        @error('stipend') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="row-custom">
    <div class="form-group-custom">
        <label for="start_date" class="form-label-icon">
            <i class="fas fa-calendar-plus"></i>
            Start Date
        </label>
        <input type="date" class="form-control-custom @error('start_date') is-invalid @enderror"
               id="start_date" name="start_date"
               value="{{ old('start_date', optional($internship->start_date ?? null)->format('Y-m-d')) }}">
        @error('start_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="form-group-custom">
        <label for="end_date" class="form-label-icon">
            <i class="fas fa-calendar-minus"></i>
            End Date
        </label>
        <input type="date" class="form-control-custom @error('end_date') is-invalid @enderror"
               id="end_date" name="end_date"
               value="{{ old('end_date', optional($internship->end_date ?? null)->format('Y-m-d')) }}">
        @error('end_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="row-custom">
    <div class="form-group-custom">
        <label for="positions" class="form-label-icon">
            <i class="fas fa-users"></i>
            Positions
        </label>
        <input type="number" class="form-control-custom @error('positions') is-invalid @enderror"
               id="positions" name="positions" value="{{ old('positions', $internship->positions ?? 1) }}" min="1">
        @error('positions') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="form-group-custom">
        <label for="qualification" class="form-label-icon">
            <i class="fas fa-graduation-cap"></i>
            Qualification
        </label>
        <input type="text" class="form-control-custom @error('qualification') is-invalid @enderror"
               id="qualification" name="qualification" value="{{ old('qualification', $internship->qualification ?? '') }}"
               placeholder="e.g., Bachelor's">
        @error('qualification') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="form-group-custom">
    <label for="skills" class="form-label-icon">
        <i class="fas fa-code"></i>
        Required Skills
    </label>

    <input type="text"
           class="form-control-custom @error('skills') is-invalid @enderror"
           id="skills"
           name="skills"
           value="{{ old('skills', isset($internship->skills) ? implode(', ', $internship->skills) : '') }}"
           placeholder="PHP, Laravel, MySQL">

    @error('skills')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    <div class="helper-text">
        <i class="fas fa-info-circle"></i>
        Separate with commas
    </div>
</div>

<div class="row-custom">
    <div class="form-group-custom">
        <label for="country" class="form-label-icon"><i class="fas fa-globe"></i> Country</label>
        <input type="text" class="form-control-custom @error('country') is-invalid @enderror"
               id="country" name="country" value="{{ old('country', $internship->country ?? '') }}" placeholder="Country">
        @error('country') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="form-group-custom">
        <label for="state" class="form-label-icon"><i class="fas fa-map-pin"></i> State <span class="required">*</span></label>
        <input type="text" class="form-control-custom @error('state') is-invalid @enderror"
               id="state" name="state" value="{{ old('state', $internship->state ?? '') }}" placeholder="State" required>
        @error('state') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="form-group-custom">
        <label for="district" class="form-label-icon"><i class="fas fa-map-marked-alt"></i> District <span class="required">*</span></label>
        <input type="text" class="form-control-custom @error('district') is-invalid @enderror"
               id="district" name="district" value="{{ old('district', $internship->district ?? '') }}" placeholder="District" required>
        @error('district') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="form-group-custom">
        <label for="city" class="form-label-icon"><i class="fas fa-city"></i> City <span class="required">*</span></label>
        <input type="text" class="form-control-custom @error('city') is-invalid @enderror"
               id="city" name="city" value="{{ old('city', $internship->city ?? '') }}" placeholder="City" required>
        @error('city') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="form-group-custom">
    <label for="description" class="form-label-icon">
        <i class="fas fa-align-left"></i>
        Description <span class="required">*</span>
    </label>
    <textarea class="form-control-custom @error('description') is-invalid @enderror"
              id="description" name="description" rows="4"
              placeholder="Detailed description of the internship..." required>{{ old('description', $internship->description ?? '') }}</textarea>
    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

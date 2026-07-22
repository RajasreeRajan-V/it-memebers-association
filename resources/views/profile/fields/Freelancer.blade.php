<div class="form-group">
    <label class="form-label" for="specialization">Specialization</label>
    <input type="text" class="form-control" id="specialization" name="specialization"
           value="{{ $val('specialization') }}">
</div>

<div class="form-group">
    <label class="form-label" for="experience">Experience (Years)</label>
    <input type="number" min="0" class="form-control" id="experience" name="experience"
           value="{{ $val('experience') }}">
</div>

<div class="form-group">
    <label class="form-label" for="hourly_rate">Hourly Rate</label>
    <input type="number" step="0.01" min="0" class="form-control" id="hourly_rate" name="hourly_rate"
           value="{{ $val('hourly_rate') }}">
</div>

<div class="form-group">
    <label class="form-label" for="availability">Availability</label>
    <select class="form-control" id="availability" name="availability">
        <option value="">Select availability</option>
        @foreach (['full-time' => 'Full-time', 'part-time' => 'Part-time', 'contract' => 'Contract', 'not-available' => 'Not Available'] as $key => $label)
            <option value="{{ $key }}" {{ $val('availability') === $key ? 'selected' : '' }}>{{ $label }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label class="form-label" for="portfolio_link">Portfolio Link</label>
    <input type="url" class="form-control" id="portfolio_link" name="portfolio_link"
           value="{{ $val('portfolio_link') }}" placeholder="https://yourportfolio.com">
</div>

<div class="form-group">
    <label class="form-label" for="github">GitHub</label>
    <input type="url" class="form-control" id="github" name="github"
           value="{{ $val('github') }}" placeholder="https://github.com/username">
</div>

<div class="form-group">
    <label class="form-label" for="linkedin">LinkedIn</label>
    <input type="url" class="form-control" id="linkedin" name="linkedin"
           value="{{ $val('linkedin') }}" placeholder="https://linkedin.com/in/username">
</div>

<div class="form-group form-group-full">
    <label class="form-label" for="skills">Skills</label>
    <textarea class="form-control" id="skills" name="skills" rows="3">{{ $val('skills') }}</textarea>
</div>
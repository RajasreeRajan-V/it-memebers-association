<div class="form-group">
    <label class="form-label" for="company">Company</label>
    <input type="text" class="form-control" id="company" name="company"
           value="{{ $val('company') }}">
</div>

<div class="form-group">
    <label class="form-label" for="designation">Designation</label>
    <input type="text" class="form-control" id="designation" name="designation"
           value="{{ $val('designation') }}">
</div>

<div class="form-group">
    <label class="form-label" for="years_of_experience">Years of Experience</label>
    <input type="number" min="0" class="form-control" id="years_of_experience" name="years_of_experience"
           value="{{ $val('years_of_experience') }}">
</div>

<div class="form-group">
    <label class="form-label" for="availability">Availability</label>
    <select class="form-control" id="availability" name="availability">
        <option value="">Select availability</option>
        @foreach (['weekdays' => 'Weekdays', 'weekends' => 'Weekends', 'flexible' => 'Flexible', 'not-available' => 'Not Available'] as $key => $label)
            <option value="{{ $key }}" {{ $val('availability') === $key ? 'selected' : '' }}>{{ $label }}</option>
        @endforeach
    </select>
</div>

<div class="form-group form-group-full">
    <label class="form-label" for="expertise">Expertise</label>
    <textarea class="form-control" id="expertise" name="expertise" rows="3">{{ $val('expertise') }}</textarea>
</div>

<div class="form-group">
    <label class="form-label" for="linkedin">LinkedIn</label>
    <input type="url" class="form-control" id="linkedin" name="linkedin"
           value="{{ $val('linkedin') }}" placeholder="https://linkedin.com/in/username">
</div>

<div class="form-group">
    <label class="form-label" for="resume">Resume</label>
    <input type="file" class="form-control form-file" id="resume" name="resume"
           accept=".pdf,.doc,.docx">
    @if ($registration && $registration->resume)
        <span class="existing-file"><i class="fa-solid fa-circle-check"></i> Current file on record</span>
    @endif
</div>

<div class="form-group form-group-full">
    <label class="form-label" for="bio">Bio</label>
    <textarea class="form-control" id="bio" name="bio" rows="4">{{ $val('bio') }}</textarea>
</div>
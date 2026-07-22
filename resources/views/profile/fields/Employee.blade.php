<div class="form-group">
    <label class="form-label" for="company_name">Company Name</label>
    <input type="text" class="form-control" id="company_name" name="company_name"
           value="{{ $val('company_name') }}">
</div>

<div class="form-group">
    <label class="form-label" for="designation">Designation</label>
    <input type="text" class="form-control" id="designation" name="designation"
           value="{{ $val('designation') }}">
</div>

<div class="form-group">
    <label class="form-label" for="experience_years">Experience (Years)</label>
    <input type="number" min="0" class="form-control" id="experience_years" name="experience_years"
           value="{{ $val('experience_years') }}">
</div>

<div class="form-group">
    <label class="form-label" for="current_ctc">Current CTC</label>
    <input type="number" step="0.01" min="0" class="form-control" id="current_ctc" name="current_ctc"
           value="{{ $val('current_ctc') }}">
</div>

<div class="form-group">
    <label class="form-label" for="expected_ctc">Expected CTC</label>
    <input type="number" step="0.01" min="0" class="form-control" id="expected_ctc" name="expected_ctc"
           value="{{ $val('expected_ctc') }}">
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

<div class="form-group">
    <label class="form-label" for="resume">Resume</label>
    <input type="file" class="form-control form-file" id="resume" name="resume"
           accept=".pdf,.doc,.docx">
    @if ($registration && $registration->resume)
        <span class="existing-file"><i class="fa-solid fa-circle-check"></i> Current file on record</span>
    @endif
</div>

<div class="form-group">
    <label class="form-label" for="experience_proof">Experience Proof</label>
    <input type="file" class="form-control form-file" id="experience_proof" name="experience_proof"
           accept=".pdf,.jpg,.jpeg,.png">
    @if ($registration && $registration->experience_proof)
        <span class="existing-file"><i class="fa-solid fa-circle-check"></i> Current file on record</span>
    @endif
</div>
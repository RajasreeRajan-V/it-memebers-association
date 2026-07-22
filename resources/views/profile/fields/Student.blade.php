<div class="form-group">
    <label class="form-label" for="college_name">College Name</label>
    <input type="text" class="form-control" id="college_name" name="college_name"
           value="{{ $val('college_name') }}">
</div>

<div class="form-group">
    <label class="form-label" for="university">University</label>
    <input type="text" class="form-control" id="university" name="university"
           value="{{ $val('university') }}">
</div>

<div class="form-group">
    <label class="form-label" for="course">Course</label>
    <input type="text" class="form-control" id="course" name="course"
           value="{{ $val('course') }}">
</div>

<div class="form-group">
    <label class="form-label" for="year">Year</label>
    <input type="text" class="form-control" id="year" name="year"
           value="{{ $val('year') }}">
</div>

<div class="form-group">
    <label class="form-label" for="interested_domain">Interested Domain</label>
    <input type="text" class="form-control" id="interested_domain" name="interested_domain"
           value="{{ $val('interested_domain') }}">
</div>

<div class="form-group form-group-full">
    <label class="form-label" for="skills">Skills</label>
    <textarea class="form-control" id="skills" name="skills" rows="3">{{ $val('skills') }}</textarea>
</div>

<div class="form-group">
    <label class="form-label" for="college_id_card">College ID Card</label>
    <input type="file" class="form-control form-file" id="college_id_card" name="college_id_card"
           accept=".pdf,.jpg,.jpeg,.png">
    @if ($registration && $registration->college_id_card)
        <span class="existing-file"><i class="fa-solid fa-circle-check"></i> Current file on record</span>
    @endif
</div>

<div class="form-group">
    <label class="form-label" for="resume">Resume</label>
    <input type="file" class="form-control form-file" id="resume" name="resume"
           accept=".pdf,.doc,.docx">
    @if ($registration && $registration->resume)
        <span class="existing-file"><i class="fa-solid fa-circle-check"></i> Current file on record</span>
    @endif
</div>
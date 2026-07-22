<div class="form-group">
    <label class="form-label" for="company_name">Company Name</label>
    <input type="text" class="form-control" id="company_name" name="company_name"
           value="{{ $val('company_name') }}">
</div>

<div class="form-group">
    <label class="form-label" for="industry">Industry</label>
    <input type="text" class="form-control" id="industry" name="industry"
           value="{{ $val('industry') }}">
</div>

<div class="form-group">
    <label class="form-label" for="company_size">Company Size</label>
    <input type="text" class="form-control" id="company_size" name="company_size"
           value="{{ $val('company_size') }}" placeholder="e.g. 1-10, 11-50, 500+">
</div>

<div class="form-group">
    <label class="form-label" for="gst_number">GST Number</label>
    <input type="text" class="form-control" id="gst_number" name="gst_number"
           value="{{ $val('gst_number') }}">
</div>

<div class="form-group">
    <label class="form-label" for="pan_number">PAN Number</label>
    <input type="text" class="form-control" id="pan_number" name="pan_number"
           value="{{ $val('pan_number') }}">
</div>

<div class="form-group">
    <label class="form-label" for="website">Website</label>
    <input type="url" class="form-control" id="website" name="website"
           value="{{ $val('website') }}" placeholder="https://example.com">
</div>

<div class="form-group form-group-full">
    <label class="form-label" for="company_address">Company Address</label>
    <textarea class="form-control" id="company_address" name="company_address" rows="3">{{ $val('company_address') }}</textarea>
</div>

<div class="form-group">
    <label class="form-label" for="company_logo">Company Logo</label>
    <input type="file" class="form-control form-file" id="company_logo" name="company_logo"
           accept="image/*">
    @if ($registration && $registration->company_logo)
        <span class="existing-file"><i class="fa-solid fa-circle-check"></i> Current file on record</span>
    @endif
</div>

<div class="form-group">
    <label class="form-label" for="company_documents">Company Documents</label>
    <input type="file" class="form-control form-file" id="company_documents" name="company_documents"
           accept=".pdf,.jpg,.jpeg,.png">
    @if ($registration && $registration->company_documents)
        <span class="existing-file"><i class="fa-solid fa-circle-check"></i> Current file on record</span>
    @endif
</div>
<div class="form-group">
    <label class="form-label" for="organization">Organization</label>
    <input type="text" class="form-control" id="organization" name="organization"
           value="{{ $val('organization') }}">
</div>

<div class="form-group">
    <label class="form-label" for="investment_stage">Investment Stage</label>
    <select class="form-control" id="investment_stage" name="investment_stage">
        <option value="">Select stage</option>
        @foreach (['pre-seed' => 'Pre-Seed', 'seed' => 'Seed', 'series-a' => 'Series A', 'series-b' => 'Series B', 'growth' => 'Growth'] as $key => $label)
            <option value="{{ $key }}" {{ $val('investment_stage') === $key ? 'selected' : '' }}>{{ $label }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label class="form-label" for="investment_range">Investment Range</label>
    <input type="text" class="form-control" id="investment_range" name="investment_range"
           value="{{ $val('investment_range') }}" placeholder="e.g. $10k - $50k">
</div>

<div class="form-group">
    <label class="form-label" for="website">Website</label>
    <input type="url" class="form-control" id="website" name="website"
           value="{{ $val('website') }}" placeholder="https://example.com">
</div>

<div class="form-group">
    <label class="form-label" for="linkedin">LinkedIn</label>
    <input type="url" class="form-control" id="linkedin" name="linkedin"
           value="{{ $val('linkedin') }}" placeholder="https://linkedin.com/in/username">
</div>

<div class="form-group">
    <label class="form-label" for="verification_document">Verification Document</label>
    <input type="file" class="form-control form-file" id="verification_document" name="verification_document"
           accept=".pdf,.jpg,.jpeg,.png">
    @if ($registration && $registration->verification_document)
        <span class="existing-file"><i class="fa-solid fa-circle-check"></i> Current file on record</span>
    @endif
</div>

<div class="form-group form-group-full">
    <label class="form-label" for="preferred_sectors">Preferred Sectors</label>
    <textarea class="form-control" id="preferred_sectors" name="preferred_sectors" rows="3">{{ $val('preferred_sectors') }}</textarea>
</div>

<div class="form-group form-group-full">
    <label class="form-label" for="bio">Bio</label>
    <textarea class="form-control" id="bio" name="bio" rows="4">{{ $val('bio') }}</textarea>
</div>
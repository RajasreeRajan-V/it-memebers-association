@csrf

<div class="sp-grid">

    <div class="sp-form-group">
        <label>Startup Name *</label>
        <input type="text" name="startup_name" value="{{ old('startup_name', $profile->startup_name ?? '') }}">
        @error('startup_name') <span class="sp-error">{{ $message }}</span> @enderror
    </div>

    <div class="sp-form-group">
        <label>Founder Name *</label>
        <input type="text" name="founder_name" value="{{ old('founder_name', $profile->founder_name ?? '') }}">
        @error('founder_name') <span class="sp-error">{{ $message }}</span> @enderror
    </div>

    <div class="sp-form-group">
        <label>Contact Email *</label>
        <input type="email" name="contact_email" value="{{ old('contact_email', $profile->contact_email ?? '') }}">
        @error('contact_email') <span class="sp-error">{{ $message }}</span> @enderror
    </div>

    <div class="sp-form-group">
        <label>Phone Number *</label>
        <input type="tel" name="phone_number" value="{{ old('phone_number', $profile->phone_number ?? '') }}">
        @error('phone_number') <span class="sp-error">{{ $message }}</span> @enderror
    </div>

    <div class="sp-form-group">
        <label>Industry</label>
        <input type="text" name="industry" value="{{ old('industry', $profile->industry ?? '') }}">
        @error('industry') <span class="sp-error">{{ $message }}</span> @enderror
    </div>

    <div class="sp-form-group">
        <label>Team Size</label>
        <input type="text" name="team_size" value="{{ old('team_size', $profile->team_size ?? '') }}" placeholder="e.g. 1-10">
        @error('team_size') <span class="sp-error">{{ $message }}</span> @enderror
    </div>

  <div class="sp-form-group">
        <label>Website (optional)</label>
        <input type="url" name="website" value="{{ old('website', $profile->website ?? '') }}" placeholder="https://">
        @error('website') <span class="sp-error">{{ $message }}</span> @enderror
    </div>

    <div class="sp-form-group">
        <label>Funding Required</label>
        <input type="text" name="funding_required" value="{{ old('funding_required', $profile->funding_required ?? '') }}" placeholder="e.g. $50,000">
        @error('funding_required') <span class="sp-error">{{ $message }}</span> @enderror
    </div>


    <div class="sp-form-group">
        <label>Country (optional)</label>
        <input type="text" name="country" value="{{ old('country', $profile->country ?? '') }}">
        @error('country') <span class="sp-error">{{ $message }}</span> @enderror
    </div>

    <div class="sp-form-group">
        <label>State</label>
        <input type="text" name="state" value="{{ old('state', $profile->state ?? '') }}">
        @error('state') <span class="sp-error">{{ $message }}</span> @enderror
    </div>

    <div class="sp-form-group">
        <label>District</label>
        <input type="text" name="district" value="{{ old('district', $profile->district ?? '') }}">
        @error('district') <span class="sp-error">{{ $message }}</span> @enderror
    </div>

    <div class="sp-form-group">
        <label>City</label>
        <input type="text" name="city" value="{{ old('city', $profile->city ?? '') }}">
        @error('city') <span class="sp-error">{{ $message }}</span> @enderror
    </div>

    <div class="sp-form-group">
        <label>Logo</label>
        <input type="file" name="logo" accept="image/*">
        @if(!empty($profile) && $profile->logo_path)
            <span class="sp-current-file">Current: <a href="{{ asset('storage/' . $profile->logo_path) }}" target="_blank">view logo</a></span>
        @endif
        @error('logo') <span class="sp-error">{{ $message }}</span> @enderror
    </div>

   <div class="sp-form-group">
        <label>Pitch Summary (optional — PDF/DOC/PPT)</label>
        <input type="file" name="pitch_summary">
        @if(!empty($profile) && $profile->pitch_summary_path)
            <span class="sp-current-file">Current: <a href="{{ asset('storage/' . $profile->pitch_summary_path) }}" target="_blank">view file</a></span>
        @endif
        @error('pitch_summary') <span class="sp-error">{{ $message }}</span> @enderror
    </div>

    <div class="sp-form-group sp-field-full">
        <label>Business Description *</label>
        <textarea name="business_description">{{ old('business_description', $profile->business_description ?? '') }}</textarea>
        @error('business_description') <span class="sp-error">{{ $message }}</span> @enderror
    </div>

</div>

<div class="sp-actions" style="margin-top:24px;">
    <button type="submit" class="sp-btn sp-btn-primary">
        {{ isset($profile) ? 'Update Profile' : 'Submit Profile' }}
    </button>
    <a href="{{ isset($profile) ? route('employer.startup-profile.index') : route('employer.jobs.index') }}" class="sp-btn">Cancel</a>
</div>
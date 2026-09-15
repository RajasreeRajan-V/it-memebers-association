@csrf

<div class="sp-form-tip">
    <i class="bi bi-info-circle"></i>
    <div>
        <strong>Before you submit</strong>
        <span>Any changes you make here will be reviewed by an admin before your profile goes live on the Investor Portal.</span>
    </div>
</div>

<div class="sp-form-row">

    <div class="sp-form-field">
        <label>Startup Name<span class="sp-required">*</span></label>
        <input type="text" id="startup_name" name="startup_name"
               value="{{ old('startup_name', $profile->startup_name ?? '') }}"
               placeholder="e.g. Nimbus Robotics">
        @error('startup_name') <p class="sp-field-error">{{ $message }}</p> @enderror
    </div>

    <div class="sp-form-field">
        <label>Founder Name<span class="sp-required">*</span></label>
        <input type="text" id="founder_name" name="founder_name"
               value="{{ old('founder_name', $profile->founder_name ?? '') }}"
               placeholder="e.g. Aditi Rao">
        @error('founder_name') <p class="sp-field-error">{{ $message }}</p> @enderror
    </div>

    <div class="sp-form-field">
        <label>Contact Email<span class="sp-required">*</span></label>
        <input type="email" id="contact_email" name="contact_email"
               value="{{ old('contact_email', $profile->contact_email ?? '') }}"
               placeholder="you@startup.com">
        @error('contact_email') <p class="sp-field-error">{{ $message }}</p> @enderror
    </div>

    <div class="sp-form-field">
        <label>Phone Number<span class="sp-required">*</span></label>
        <input type="tel" id="phone_number" name="phone_number"
               value="{{ old('phone_number', $profile->phone_number ?? '') }}"
               placeholder="+91 98765 43210">
        @error('phone_number') <p class="sp-field-error">{{ $message }}</p> @enderror
    </div>

    <div class="sp-form-field">
        <label>Industry</label>
        <input type="text" id="industry" name="industry"
               value="{{ old('industry', $profile->industry ?? '') }}"
               placeholder="e.g. Fintech, Healthtech">
        @error('industry') <p class="sp-field-error">{{ $message }}</p> @enderror
    </div>

    <div class="sp-form-field">
        <label>Team Size</label>
        <input type="text" id="team_size" name="team_size"
               value="{{ old('team_size', $profile->team_size ?? '') }}"
               placeholder="e.g. 1-10">
        @error('team_size') <p class="sp-field-error">{{ $message }}</p> @enderror
    </div>

    <div class="sp-form-field">
        <label>Website</label>
        <input type="url" id="website" name="website"
               value="{{ old('website', $profile->website ?? '') }}"
               placeholder="https://">
        @error('website') <p class="sp-field-error">{{ $message }}</p> @enderror
    </div>

    <div class="sp-form-field">
        <label>Funding Required</label>
        <input type="text" id="funding_required" name="funding_required"
               value="{{ old('funding_required', $profile->funding_required ?? '') }}"
               placeholder="e.g. $50,000">
        @error('funding_required') <p class="sp-field-error">{{ $message }}</p> @enderror
    </div>

    <div class="sp-form-field">
        <label>Country</label>
        <input type="text" id="country" name="country"
               value="{{ old('country', $profile->country ?? '') }}">
        @error('country') <p class="sp-field-error">{{ $message }}</p> @enderror
    </div>

    <div class="sp-form-field">
        <label>State</label>
        <input type="text" id="state" name="state"
               value="{{ old('state', $profile->state ?? '') }}">
        @error('state') <p class="sp-field-error">{{ $message }}</p> @enderror
    </div>

    <div class="sp-form-field">
        <label>District</label>
        <input type="text" id="district" name="district"
               value="{{ old('district', $profile->district ?? '') }}">
        @error('district') <p class="sp-field-error">{{ $message }}</p> @enderror
    </div>

    <div class="sp-form-field">
        <label>City</label>
        <input type="text" id="city" name="city"
               value="{{ old('city', $profile->city ?? '') }}">
        @error('city') <p class="sp-field-error">{{ $message }}</p> @enderror
    </div>

    <div class="sp-form-field">
        <label>Logo</label>
        <input type="file" id="logo" name="logo" accept="image/*">
        @if(!empty($profile) && $profile->logo_path)
            <span class="sp-current-file">Current: <a href="{{ asset('storage/' . $profile->logo_path) }}" target="_blank">view logo</a></span>
        @endif
        @error('logo') <p class="sp-field-error">{{ $message }}</p> @enderror
    </div>

    <div class="sp-form-field">
        <label>Pitch Summary <span style="text-transform:none;font-weight:500;color:#9aa3b2;">(PDF/DOC/PPT)</span></label>
        <input type="file" id="pitch_summary" name="pitch_summary">
        @if(!empty($profile) && $profile->pitch_summary_path)
            <span class="sp-current-file">Current: <a href="{{ asset('storage/' . $profile->pitch_summary_path) }}" target="_blank">view file</a></span>
        @endif
        @error('pitch_summary') <p class="sp-field-error">{{ $message }}</p> @enderror
    </div>

    <div class="sp-form-field sp-field-full">
        <label>Business Description<span class="sp-required">*</span></label>
        <textarea id="business_description" name="business_description"
                  placeholder="Tell investors what your startup does, the problem you're solving, and why now.">{{ old('business_description', $profile->business_description ?? '') }}</textarea>
        @error('business_description') <p class="sp-field-error">{{ $message }}</p> @enderror
    </div>

</div>
{{-- resources/views/employer/startup-profile/_form.blade.php --}}
@php $profile = $profile ?? null; @endphp

<div class="form-grid">
    <div class="form-group full">
        <label>Startup Name <span class="req">*</span></label>
        <input type="text" name="startup_name" class="form-control @error('startup_name') is-invalid @enderror"
               value="{{ old('startup_name', $profile->startup_name ?? '') }}" required>
        @error('startup_name') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="form-group full">
        <label>Startup Logo</label>
        @if($profile && $profile->logo_path)
            <div class="current-file"><i class="fas fa-image"></i> Current logo uploaded — choose a new file to replace it.</div>
        @endif
        <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror" accept="image/*">
        <span class="hint">Optional. PNG/JPG, max 2MB.</span>
        @error('logo') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="form-group">
        <label>Founder Name <span class="req">*</span></label>
        <input type="text" name="founder_name" class="form-control @error('founder_name') is-invalid @enderror"
               value="{{ old('founder_name', $profile->founder_name ?? '') }}" required>
        @error('founder_name') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="form-group">
        <label>Team Size</label>
        <input type="text" name="team_size" class="form-control"
               value="{{ old('team_size', $profile->team_size ?? '') }}" placeholder="e.g. 11-25 Members">
    </div>

    <div class="form-group">
        <label>Industry</label>
        <input type="text" name="industry" class="form-control" value="{{ old('industry', $profile->industry ?? '') }}">
    </div>

    <div class="form-group">
        <label>Funding Required</label>
        <input type="text" name="funding_required" class="form-control"
               value="{{ old('funding_required', $profile->funding_required ?? '') }}" placeholder="e.g. ₹50,00,000">
    </div>

    <div class="form-group">
        <label>Website</label>
        <input type="url" name="website" class="form-control @error('website') is-invalid @enderror"
               value="{{ old('website', $profile->website ?? '') }}" placeholder="https://">
        @error('website') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="form-group">
        <label>State</label>
        <input type="text" name="state" class="form-control" value="{{ old('state', $profile->state ?? '') }}">
    </div>
    <div class="form-group">
        <label>District</label>
        <input type="text" name="district" class="form-control" value="{{ old('district', $profile->district ?? '') }}">
    </div>
    <div class="form-group">
        <label>City</label>
        <input type="text" name="city" class="form-control" value="{{ old('city', $profile->city ?? '') }}">
    </div>

    <div class="form-group">
        <label>Contact Email <span class="req">*</span></label>
        <input type="email" name="contact_email" class="form-control @error('contact_email') is-invalid @enderror"
               value="{{ old('contact_email', $profile->contact_email ?? '') }}" required>
        @error('contact_email') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="form-group">
        <label>Phone Number <span class="req">*</span></label>
        <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror"
               value="{{ old('phone_number', $profile->phone_number ?? '') }}" required>
        @error('phone_number') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="form-group full">
        <label>Business Description <span class="req">*</span></label>
        <textarea name="business_description" class="form-control @error('business_description') is-invalid @enderror"
                  placeholder="What does your startup do?" required>{{ old('business_description', $profile->business_description ?? '') }}</textarea>
        @error('business_description') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="form-group full">
        <label>Pitch Summary</label>
        @if($profile && $profile->pitch_summary_path)
            <div class="current-file"><i class="fas fa-file-lines"></i> A pitch summary file is already uploaded — choose a new file to replace it.</div>
        @endif
        <input type="file" name="pitch_summary" class="form-control @error('pitch_summary') is-invalid @enderror" accept=".pdf,.doc,.docx,.ppt,.pptx">
        <span class="hint">Optional. PDF/DOC/PPT, max 5MB.</span>
        @error('pitch_summary') <div class="error-text">{{ $message }}</div> @enderror
    </div>
</div>

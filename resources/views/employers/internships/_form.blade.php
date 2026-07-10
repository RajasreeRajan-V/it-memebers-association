{{-- resources/views/employer/internships/_form.blade.php --}}
@php $internship = $internship ?? null; @endphp

<div class="form-grid">
    <div class="form-group full">
        <label>Internship Title <span class="req">*</span></label>
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
               value="{{ old('title', $internship->title ?? '') }}" placeholder="e.g. Web Development Intern" required>
        @error('title') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="form-group">
        <label>Internship Type <span class="req">*</span></label>
        <select name="internship_type" class="form-control @error('internship_type') is-invalid @enderror" required>
            <option value="">Select type</option>
            @foreach(['full-time' => 'Full-time', 'part-time' => 'Part-time', 'remote' => 'Remote', 'hybrid' => 'Hybrid', 'on-site' => 'On-site'] as $val => $label)
                <option value="{{ $val }}" @selected(old('internship_type', $internship->internship_type ?? '') === $val)>{{ $label }}</option>
            @endforeach
        </select>
        @error('internship_type') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="form-group">
        <label>Duration <span class="req">*</span></label>
        <input type="text" name="duration" class="form-control @error('duration') is-invalid @enderror"
               value="{{ old('duration', $internship->duration ?? '') }}" placeholder="e.g. 3 months" required>
        @error('duration') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="form-group">
        <label>Country</label>
        <input type="text" name="country" class="form-control" value="{{ old('country', $internship->country ?? '') }}">
    </div>
    <div class="form-group">
        <label>State</label>
        <input type="text" name="state" class="form-control" value="{{ old('state', $internship->state ?? '') }}">
    </div>
    <div class="form-group">
        <label>City</label>
        <input type="text" name="city" class="form-control" value="{{ old('city', $internship->city ?? '') }}">
    </div>

    <div class="form-group">
        <label>Stipend</label>
        <input type="text" name="stipend" class="form-control"
               value="{{ old('stipend', $internship->stipend ?? '') }}" placeholder="e.g. ₹5,000/month (leave blank if unpaid)">
    </div>

    <div class="form-group full">
        <label>Description <span class="req">*</span></label>
        <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                  placeholder="About the internship, roles and responsibilities..." required>{{ old('description', $internship->description ?? '') }}</textarea>
        @error('description') <div class="error-text">{{ $message }}</div> @enderror
    </div>
</div>

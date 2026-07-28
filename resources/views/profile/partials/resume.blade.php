{{-- resources/views/profile/partials/resume.blade.php --}}
@php
    $resumePath = $registration->resume ?? $user->resume ?? null;
@endphp

<form method="POST" action="{{ route('profile.resume.upload') }}" enctype="multipart/form-data" class="resume-card"
    id="resumeForm" novalidate>
    @csrf

    @if(!empty($resumePath))
        {{-- ===== STATE: Resume already exists ===== --}}
        <div class="resume-icon-wrapper">
            <label for="resumeUpload" class="resume-update-btn" title="Upload a new resume">
                <i class="fa-solid fa-arrows-rotate"></i> Update
            </label>

            <a href="{{ asset('storage/' . $resumePath) }}"
               target="_blank"
               rel="noopener noreferrer"
               class="resume-icon"
               title="View resume">
                <i class="fa-solid fa-file-pdf"></i>
            </a>
        </div>

        <div class="resume-content">
            <p class="resume-success">
                <i class="fa-solid fa-circle-check"></i>
                Resume uploaded successfully!
            </p>
            <p class="resume-text">
                Click the icon to view your resume, or hit <strong>Update</strong> to replace it with a new file.
            </p>

            <input type="file" id="resumeUpload" name="resume" accept=".pdf,.docx,.doc" hidden>
            <span class="resume-filename" id="resumeFileName"></span>
            <span class="field-error" id="resumeError"></span>

            {{-- hidden until a new file is chosen via the Update label above --}}
            <button type="submit" class="btn btn-primary" id="resumeSubmitBtn" hidden>
                <i class="fa-solid fa-upload"></i> Save New Resume
            </button>
        </div>
    @else
        {{-- ===== STATE: No resume yet ===== --}}
        <div class="resume-icon">
            <i class="fa-solid fa-file-lines"></i>
        </div>

        <div class="resume-content">
            <p class="resume-success">
                <i class="fa-solid fa-circle-check"></i>
                Congratulations, you have successfully registered!
            </p>
            <p class="resume-text">
                Upload your resume and we'll fill your profile automatically.
            </p>

            <label for="resumeUpload" class="resume-dropzone" id="resumeDropzone">
                <div>Drag & Drop or <span class="browse-link">Browse</span> to upload</div>
                <small>Max 1MB · .pdf, .docx, .doc</small>
                <span class="resume-filename" id="resumeFileName"></span>
            </label>
            <input type="file" id="resumeUpload" name="resume" accept=".pdf,.docx,.doc" hidden>
            <span class="field-error" id="resumeError"></span>

            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-upload"></i> Upload Resume
            </button>
        </div>
    @endif
</form>

@if(!empty($resumePath))
<script>
    // Reveal the "Save New Resume" button only once the user actually
    // picks a new file via the Update label, so the form doesn't submit empty.
    document.getElementById('resumeUpload')?.addEventListener('change', function () {
        const fileNameEl = document.getElementById('resumeFileName');
        const submitBtn = document.getElementById('resumeSubmitBtn');

        if (this.files && this.files.length > 0) {
            if (fileNameEl) fileNameEl.textContent = this.files[0].name;
            if (submitBtn) submitBtn.hidden = false;
        }
    });
</script>
@endif
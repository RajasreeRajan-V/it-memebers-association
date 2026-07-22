{{-- resources/views/profile/partials/resume.blade.php --}}
<form method="POST" action="{{ route('profile.resume.upload') }}" enctype="multipart/form-data" class="resume-card"
    id="resumeForm" novalidate>
    @csrf
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
</form>
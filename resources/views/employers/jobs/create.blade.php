
<div class="job-form-wrapper">

    <div class="job-form-header">
        <h1>Post a New Job</h1>
        <p>Fill in the details below to publish a job opening.</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-error">
            <p class="alert-title">Please fix the following:</p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-error">
            <p>{{ session('error') }}</p>
        </div>
    @endif

    <form action="{{ route('employer.jobs.store') }}" method="POST" class="job-form" enctype="multipart/form-data">
        @csrf

        {{-- Job Title --}}
        <div class="form-group">
            <label for="title">Job Title <span class="required">*</span></label>
            <input type="text" name="title" id="title" required
                   value="{{ old('title') }}"
                   placeholder="e.g. Senior Backend Developer">
            @error('title')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-grid">

            {{-- Employment Type --}}
            <div class="form-group">
                <label for="employment_type">Employment Type <span class="required">*</span></label>
                <select name="employment_type" id="employment_type" required>
                    <option value="">Select employment type</option>
                    @foreach (['full-time' => 'Full-time', 'part-time' => 'Part-time', 'contract' => 'Contract', 'freelance' => 'Freelance'] as $value => $label)
                        <option value="{{ $value }}" @selected(old('employment_type') == $value)>{{ $label }}</option>
                    @endforeach
                </select>
                @error('employment_type')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- Work Mode --}}
            <div class="form-group">
                <label for="work_mode">Work Mode <span class="required">*</span></label>
                <select name="work_mode" id="work_mode" required>
                    <option value="">Select work mode</option>
                    @foreach (['onsite' => 'Onsite', 'hybrid' => 'Hybrid', 'remote' => 'Remote'] as $value => $label)
                        <option value="{{ $value }}" @selected(old('work_mode') == $value)>{{ $label }}</option>
                    @endforeach
                </select>
                @error('work_mode')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- Experience --}}
            <div class="form-group">
                <label for="experience">Experience</label>
                <input type="text" name="experience" id="experience"
                       value="{{ old('experience') }}"
                       placeholder="e.g. 2-4 years">
                @error('experience')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- Salary --}}
            <div class="form-group">
                <label for="salary">Salary</label>
                <input type="text" name="salary" id="salary"
                       value="{{ old('salary') }}"
                       placeholder="e.g. $60,000 - $80,000 / year">
                @error('salary')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- Qualification --}}
            <div class="form-group span-2">
                <label for="qualification">Qualification</label>
                <input type="text" name="qualification" id="qualification"
                       value="{{ old('qualification') }}"
                       placeholder="e.g. Bachelor's degree in Computer Science">
                @error('qualification')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- Skills --}}
            <div class="form-group span-2">
                <label for="skills">Skills</label>
                <input type="text" name="skills" id="skills"
                       value="{{ old('skills') }}"
                       placeholder="Comma-separated, e.g. Laravel, MySQL, REST APIs">
                <p class="hint">Separate each skill with a comma.</p>
                @error('skills')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Location --}}
        <div class="location-section">
            <h2>Location</h2>
            <div class="form-grid location-grid">

                <div class="form-group">
                    <label for="country">Country <span class="optional">(optional)</span></label>
                    <input type="text" name="country" id="country"
                           value="{{ old('country') }}"
                           placeholder="e.g. India">
                    @error('country')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="state">State <span class="required">*</span></label>
                    <input type="text" name="state" id="state" required
                           value="{{ old('state') }}"
                           placeholder="e.g. Kerala">
                    @error('state')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="district">District <span class="required">*</span></label>
                    <input type="text" name="district" id="district" required
                           value="{{ old('district') }}"
                           placeholder="e.g. Kasaragod">
                    @error('district')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="city">City <span class="required">*</span></label>
                    <input type="text" name="city" id="city" required
                           value="{{ old('city') }}"
                           placeholder="e.g. Kanhangad">
                    @error('city')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Description --}}
        <div class="form-group">
            <label for="description">Description <span class="required">*</span></label>
            <textarea name="description" id="description" rows="6" required
                      placeholder="Describe the role, responsibilities, and requirements...">{{ old('description') }}</textarea>
            @error('description')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        {{-- Actions --}}
        <div class="form-actions">
            <a href="{{ route('employer.jobs.index') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Publish Job</button>
        </div>

    </form>
</div>

<style>
    .job-form-wrapper {
        max-width: 800px;
        margin: 0 auto;
        padding: 40px 20px;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        color: #1f2937;
    }

    .job-form-header h1 {
        font-size: 1.75rem;
        font-weight: 600;
        margin: 0 0 4px;
        color: #111827;
    }

    .job-form-header p {
        font-size: 0.9rem;
        color: #6b7280;
        margin: 0 0 32px;
    }

    .alert {
        border-radius: 10px;
        padding: 16px;
        margin-bottom: 24px;
    }

    .alert-error {
        background: #fef2f2;
        border: 1px solid #fecaca;
    }

    .alert-success {
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        color: #166534;
    }

    .alert-title {
        font-size: 0.875rem;
        font-weight: 600;
        color: #991b1b;
        margin: 0 0 8px;
    }

    .alert-error ul {
        margin: 0;
        padding-left: 18px;
        color: #b91c1c;
        font-size: 0.85rem;
    }

    .error-message {
        color: #dc2626;
        font-size: 0.8rem;
        margin-top: 4px;
    }

    .job-form {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        padding: 32px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
        margin-top: 24px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 24px;
    }

    .form-grid .form-group {
        margin-bottom: 0;
    }

    .span-2 {
        grid-column: span 2;
    }

    label {
        font-size: 0.85rem;
        font-weight: 500;
        color: #374151;
        margin-bottom: 6px;
    }

    .required {
        color: #dc2626;
    }

    .optional {
        color: #9ca3af;
        font-weight: 400;
    }

    input[type="text"],
    select,
    textarea {
        border: 1px solid #d1d5db;
        border-radius: 8px;
        padding: 10px 12px;
        font-size: 0.9rem;
        font-family: inherit;
        color: #111827;
        background: #ffffff;
        transition: border-color 0.15s ease, box-shadow 0.15s ease;
    }

    input[type="text"]:focus,
    select:focus,
    textarea:focus {
        outline: none;
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
    }

    textarea {
        resize: vertical;
        min-height: 120px;
    }

    .hint {
        font-size: 0.75rem;
        color: #9ca3af;
        margin: 4px 0 0;
    }

    .location-section {
        margin-bottom: 24px;
    }

    .location-section h2 {
        font-size: 0.9rem;
        font-weight: 600;
        color: #1f2937;
        margin: 0 0 12px;
    }

    .location-grid {
        background: #f9fafb;
        border: 1px solid #f3f4f6;
        border-radius: 10px;
        padding: 20px;
        margin-top: 0;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        padding-top: 20px;
        border-top: 1px solid #f3f4f6;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        font-size: 0.9rem;
        font-weight: 500;
        padding: 10px 20px;
        cursor: pointer;
        border: none;
        text-decoration: none;
        transition: background-color 0.15s ease;
    }

    .btn-secondary {
        background: transparent;
        color: #4b5563;
        border: 1px solid #d1d5db;
    }

    .btn-secondary:hover {
        background: #f3f4f6;
        color: #1f2937;
    }

    .btn-primary {
        background: #4f46e5;
        color: #ffffff;
    }

    .btn-primary:hover {
        background: #4338ca;
    }

    @media (max-width: 640px) {
        .form-grid {
            grid-template-columns: 1fr;
        }

        .span-2 {
            grid-column: span 1;
        }

        .job-form {
            padding: 20px;
        }
    }
</style>

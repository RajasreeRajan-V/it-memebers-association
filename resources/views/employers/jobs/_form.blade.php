{{-- resources/views/employer/jobs/_form.blade.php --}}
@php
    $job = $job ?? null;
    $skillsValue = old('skills', $job && $job->skills ? implode(', ', $job->skills) : '');
@endphp

<div class="form-grid">
    {{-- Job Title --}}
    <div class="form-group full">
        <label>Job Title <span class="req">*</span></label>
        <input type="text" 
               name="title" 
               id="title"
               class="form-control @error('title') is-invalid @enderror"
               value="{{ old('title', $job->title ?? '') }}" 
               placeholder="e.g. Senior Laravel Developer" 
               minlength="3"
               maxlength="255"
               required>
        @error('title') 
            <div class="error-text">{{ $message }}</div> 
        @enderror
        <div class="char-counter">
            <span id="titleCount" class="char-count">0 / 255</span>
            <span class="hint"></span>
        </div>
    </div>

    {{-- Employment Type --}}
    <div class="form-group">
        <label>Employment Type <span class="req">*</span></label>
        <select name="employment_type" 
                id="employment_type"
                class="form-control @error('employment_type') is-invalid @enderror" 
                required>
            <option value="">Select type</option>
            @foreach(['full-time' => 'Full-time', 'part-time' => 'Part-time', 'contract' => 'Contract', 'freelance' => 'Freelance'] as $val => $label)
                <option value="{{ $val }}" @selected(old('employment_type', $job->employment_type ?? '') === $val)>{{ $label }}</option>
            @endforeach
        </select>
        @error('employment_type') 
            <div class="error-text">{{ $message }}</div> 
        @enderror
    </div>

    {{-- Work Mode --}}
    <div class="form-group">
        <label>Work Mode <span class="req">*</span></label>
        <select name="work_mode" 
                id="work_mode"
                class="form-control @error('work_mode') is-invalid @enderror" 
                required>
            <option value="">Select mode</option>
            @foreach(['onsite' => 'Onsite', 'hybrid' => 'Hybrid', 'remote' => 'Remote'] as $val => $label)
                <option value="{{ $val }}" @selected(old('work_mode', $job->work_mode ?? '') === $val)>{{ $label }}</option>
            @endforeach
        </select>
        @error('work_mode') 
            <div class="error-text">{{ $message }}</div> 
        @enderror
    </div>

    {{-- Experience --}}
    <div class="form-group">
        <label>Experience <span class="req">*</span></label>
        <input type="text" 
               name="experience" 
               id="experience"
               class="form-control @error('experience') is-invalid @enderror"
               value="{{ old('experience', $job->experience ?? '') }}" 
               placeholder="e.g. 2-4 years"
               maxlength="50"
               required>
        @error('experience') 
            <div class="error-text">{{ $message }}</div> 
        @enderror
        <div class="char-counter">
            <span id="experienceCount" class="char-count">0 / 50</span>
            <span class="hint"></span>
        </div>
    </div>

    {{-- Salary --}}
    <div class="form-group">
        <label>Salary <span class="req">*</span></label>
        <input type="text" 
               name="salary" 
               id="salary"
               class="form-control @error('salary') is-invalid @enderror"
               value="{{ old('salary', $job->salary ?? '') }}" 
               placeholder="e.g. 6-8 LPA or ₹6,00,000 - ₹8,00,000"
               maxlength="50"
               required>
        @error('salary') 
            <div class="error-text">{{ $message }}</div> 
        @enderror
        <div class="char-counter">
            <span id="salaryCount" class="char-count">0 / 50</span>
            <span class="hint"></span>
        </div>
    </div>

    {{-- Skills --}}
    <div class="form-group full">
        <label>Skills <span class="req">*</span></label>
        <input type="text" 
               name="skills" 
               id="skills"
               class="form-control @error('skills') is-invalid @enderror"
               value="{{ $skillsValue }}" 
               placeholder="Comma separated, e.g. Laravel, MySQL, Vue.js"
               maxlength="500"
               required>
        @error('skills') 
            <div class="error-text">{{ $message }}</div> 
        @enderror
        <div class="char-counter">
            <span id="skillsCount" class="char-count">0 / 500</span>
            <span class="hint"></span>
        </div>
    </div>

    {{-- State --}}
    <div class="form-group">
        <label>State <span class="req">*</span></label>
        <input type="text" 
               name="state" 
               id="state"
               class="form-control @error('state') is-invalid @enderror"
               value="{{ old('state', $job->state ?? '') }}"
               maxlength="100"
               required>
        @error('state') 
            <div class="error-text">{{ $message }}</div> 
        @enderror
        <div class="char-counter">
            <span id="stateCount" class="char-count">0 / 100</span>
            <span class="hint"></span>
        </div>
    </div>

    {{-- District --}}
    <div class="form-group">
        <label>District <span class="req">*</span></label>
        <input type="text" 
               name="district" 
               id="district"
               class="form-control @error('district') is-invalid @enderror"
               value="{{ old('district', $job->district ?? '') }}"
               maxlength="100"
               required>
        @error('district') 
            <div class="error-text">{{ $message }}</div> 
        @enderror
        <div class="char-counter">
            <span id="districtCount" class="char-count">0 / 100</span>
            <span class="hint"></span>
        </div>
    </div>

    {{-- City --}}
    <div class="form-group">
        <label>City <span class="req">*</span></label>
        <input type="text" 
               name="city" 
               id="city"
               class="form-control @error('city') is-invalid @enderror"
               value="{{ old('city', $job->city ?? '') }}"
               maxlength="100"
               required>
        @error('city') 
            <div class="error-text">{{ $message }}</div> 
        @enderror
        <div class="char-counter">
            <span id="cityCount" class="char-count">0 / 100</span>
            <span class="hint"></span>
        </div>
    </div>

    {{-- Qualification (Optional) --}}
    <div class="form-group">
        <label>Qualification <span class="optional">(Optional)</span></label>
        <input type="text" 
               name="qualification" 
               id="qualification"
               class="form-control @error('qualification') is-invalid @enderror"
               value="{{ old('qualification', $job->qualification ?? '') }}" 
               placeholder="e.g. B.Tech / MCA (Optional)"
               maxlength="150">
        @error('qualification') 
            <div class="error-text">{{ $message }}</div> 
        @enderror
        <div class="char-counter">
            <span id="qualificationCount" class="char-count">0 / 150</span>
            <span class="hint"></span>
        </div>
    </div>

    {{-- Description --}}
    <div class="form-group full">
        <label>Description <span class="req">*</span></label>
        <textarea name="description" 
                  id="description"
                  class="form-control @error('description') is-invalid @enderror"
                  placeholder="Roles, responsibilities, requirements..."
                  minlength="20"
                  maxlength="1500"
                  required>{{ old('description', $job->description ?? '') }}</textarea>
        @error('description') 
            <div class="error-text">{{ $message }}</div> 
        @enderror
        <div class="char-counter">
            <span id="descriptionCount" class="char-count">0 / 1500</span>
            <span class="hint"></span>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Character counter for all fields
    const fieldsWithCounter = [
        { id: 'title', max: 255 },
        { id: 'experience', max: 50 },
        { id: 'salary', max: 50 },
        { id: 'skills', max: 500 },
        { id: 'state', max: 100 },
        { id: 'district', max: 100 },
        { id: 'city', max: 100 },
        { id: 'qualification', max: 150 },
        { id: 'description', max: 1500 }
    ];
    
    fieldsWithCounter.forEach(field => {
        const input = document.getElementById(field.id);
        const counter = document.getElementById(field.id + 'Count');
        
        if (input && counter) {
            function updateCounter() {
                const length = input.value.length;
                counter.textContent = `${length} / ${field.max}`;
                
                if (length > field.max * 0.9) {
                    counter.classList.add('warning');
                } else {
                    counter.classList.remove('warning');
                }
            }
            
            input.addEventListener('input', updateCounter);
            updateCounter();
        }
    });

    // ============================================
    // REAL-TIME INPUT FILTERING - BLOCK INVALID CHARACTERS
    // ============================================
    
    // Job Title: Letters, numbers, spaces, hyphens only
    document.getElementById('title').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^A-Za-z0-9\s\-]/g, '');
    });

    // Experience: Letters, numbers, spaces, hyphens only
    document.getElementById('experience').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^A-Za-z0-9\s\-]/g, '');
    });

    // Salary: Letters, numbers, spaces, hyphens, ., /, $, ₹, commas
    document.getElementById('salary').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^A-Za-z0-9\s\-\.\/\$₹,]/g, '');
    });

    // Skills: Letters, numbers, spaces, hyphens, commas only
    document.getElementById('skills').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^A-Za-z0-9\s\-\,]/g, '');
    });

    // State: Letters, spaces, hyphens only (no numbers)
    document.getElementById('state').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^A-Za-z\s\-]/g, '');
    });

    // District: Letters, spaces, hyphens only (no numbers)
    document.getElementById('district').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^A-Za-z\s\-]/g, '');
    });

    // City: Letters, spaces, hyphens only (no numbers)
    document.getElementById('city').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^A-Za-z\s\-]/g, '');
    });

    // Qualification: Letters, numbers, spaces, hyphens only (optional)
    document.getElementById('qualification').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^A-Za-z0-9\s\-]/g, '');
    });

    // Description: No filtering (allows normal punctuation)
    // Just prevent emojis and special symbols if needed
    document.getElementById('description').addEventListener('input', function(e) {
        // Allow letters, numbers, spaces, commas, hyphens, and normal punctuation
        // This is more permissive - only block emojis and very special chars
        this.value = this.value.replace(/[^\w\s\-,.!?;:'"()\[\]{}@#$%^&*+=<>/\\|`~]/g, '');
    });

    // ============================================
    // ADD VISUAL FEEDBACK WHEN INVALID CHARACTER IS TYPED
    // ============================================
    const filterFields = [
        { id: 'title', pattern: /[^A-Za-z0-9\s\-]/ },
        { id: 'experience', pattern: /[^A-Za-z0-9\s\-]/ },
        { id: 'salary', pattern: /[^A-Za-z0-9\s\-\.\/\$₹,]/ },
        { id: 'skills', pattern: /[^A-Za-z0-9\s\-\,]/ },
        { id: 'state', pattern: /[^A-Za-z\s\-]/ },
        { id: 'district', pattern: /[^A-Za-z\s\-]/ },
        { id: 'city', pattern: /[^A-Za-z\s\-]/ },
        { id: 'qualification', pattern: /[^A-Za-z0-9\s\-]/ }
    ];

    filterFields.forEach(field => {
        const input = document.getElementById(field.id);
        if (input) {
            input.addEventListener('keydown', function(e) {
                // Allow control keys
                if (e.ctrlKey || e.metaKey || e.key === 'Backspace' || e.key === 'Delete' || 
                    e.key === 'Tab' || e.key === 'ArrowLeft' || e.key === 'ArrowRight' ||
                    e.key === 'ArrowUp' || e.key === 'ArrowDown' || e.key === 'Home' || 
                    e.key === 'End') {
                    return;
                }
                
                // Check if the character being typed is allowed
                const char = e.key;
                if (char.length === 1 && field.pattern.test(char)) {
                    // Invalid character - show visual feedback
                    this.classList.add('is-invalid');
                    setTimeout(() => {
                        this.classList.remove('is-invalid');
                    }, 500);
                }
            });
        }
    });

    // Form submission validation
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            let isValid = true;
            
            // Check required fields
            const requiredFields = this.querySelectorAll('[required]');
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('is-invalid');
                    isValid = false;
                } else {
                    field.classList.remove('is-invalid');
                }
            });
            
            // Check description length
            const desc = document.getElementById('description');
            if (desc && (desc.value.length < 20 || desc.value.length > 1500)) {
                desc.classList.add('is-invalid');
                isValid = false;
            }
            
            if (!isValid) {
                e.preventDefault();
                const firstError = document.querySelector('.is-invalid');
                if (firstError) {
                    firstError.focus();
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
        });
    }
});
</script>

<style>
.char-counter {
    margin-top: 4px;
}

.char-count {
    font-size: 12px;
    color: #6c757d;
    display: block;
    text-align: right;
}

.char-count.warning {
    color: #dc3545;
    font-weight: bold;
}

.hint {
    display: block;
    font-size: 12px;
    color: #6c757d;
    margin-top: 2px;
}

.error-text {
    color: #dc3545;
    font-size: 13px;
    margin-top: 4px;
}

.is-invalid {
    border-color: #dc3545;
}

.is-invalid:focus {
    border-color: #dc3545;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
}

.req {
    color: #dc3545;
    font-weight: bold;
}

.optional {
    color: #6c757d;
    font-weight: normal;
    font-size: 0.9em;
}

.form-group {
    margin-bottom: 20px;
}

.form-group.full {
    grid-column: 1 / -1;
}

.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

/* Animation for invalid character flash */
@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    75% { transform: translateX(5px); }
}

.is-invalid {
    animation: shake 0.3s ease-in-out;
}

@media (max-width: 768px) {
    .form-grid {
        grid-template-columns: 1fr;
    }
    
    .form-group.full {
        grid-column: 1;
    }
}
</style>
@endpush
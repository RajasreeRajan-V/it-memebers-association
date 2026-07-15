
<style>
    /* Form Container - Reduced Width */
    .internship-form-container {
        max-width: 700px;
        margin: 0 auto;
        padding: 15px 0;
    }

    .form-card {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        overflow: hidden;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    /* Compact Header */
    .form-card-header {
        background: linear-gradient(135deg, #0F172A 0%, #764ba2 100%);
        padding: 18px 25px;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .form-card-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
        pointer-events: none;
    }

    .form-card-header h4 {
        font-weight: 600;
        font-size: 18px;
        margin: 0 0 4px 0;
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-card-header h4 i {
        font-size: 20px;
        opacity: 0.9;
    }

    .form-card-header p {
        margin: 0;
        opacity: 0.85;
        font-size: 12px;
        position: relative;
        z-index: 1;
        font-weight: 300;
    }

    .form-card-body {
        padding: 20px 25px;
    }

    /* Compact Form Groups */
    .form-group-custom {
        margin-bottom: 14px;
    }

    .form-group-custom label {
        font-weight: 600;
        color: #2d3748;
        font-size: 13px;
        margin-bottom: 4px;
        display: block;
    }

    .form-group-custom label .required {
        color: #e53e3e;
        margin-left: 3px;
    }

    .form-control-custom {
        width: 100%;
        padding: 8px 12px;
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        font-size: 13px;
        transition: all 0.3s ease;
        background: #f7fafc;
        color: #2d3748;
    }

    .form-control-custom:focus {
        border-color: #667eea;
        background: #ffffff;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        outline: none;
    }

    .form-control-custom:hover {
        border-color: #a0aec0;
    }

    .form-control-custom.is-invalid {
        border-color: #fc8181;
        background: #fff5f5;
    }

    select.form-control-custom {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' viewBox='0 0 12 12'%3E%3Cpath fill='%234a5568' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        padding-right: 32px;
        cursor: pointer;
    }

    textarea.form-control-custom {
        resize: vertical;
        min-height: 80px;
        font-size: 13px;
    }

    .invalid-feedback {
        font-size: 12px;
        color: #e53e3e;
        margin-top: 4px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .invalid-feedback::before {
        content: '⚠';
        font-size: 12px;
    }

    /* Compact Alert Messages */
    .alert-custom {
        padding: 10px 16px;
        border-radius: 8px;
        margin-bottom: 16px;
        font-size: 13px;
        font-weight: 500;
    }

    .alert-success-custom {
        background: #f0fff4;
        border: 2px solid #48bb78;
        color: #22543d;
    }

    .alert-success-custom::before {
        content: '✓';
        margin-right: 8px;
        font-weight: bold;
        color: #48bb78;
    }

    .alert-error-custom {
        background: #fff5f5;
        border: 2px solid #fc8181;
        color: #742a2a;
    }

    .alert-error-custom::before {
        content: '✕';
        margin-right: 8px;
        font-weight: bold;
        color: #fc8181;
    }

    /* Compact Grid */
    .row-custom {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }

    /* Compact Form Actions */
    .form-actions {
        margin-top: 20px;
        padding-top: 16px;
        border-top: 2px solid #f7fafc;
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .btn-custom {
        padding: 8px 20px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 13px;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        text-decoration: none;
    }

    .btn-primary-custom {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        flex: 1;
        justify-content: center;
    }

    .btn-primary-custom:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.35);
        color: white;
    }

    .btn-secondary-custom {
        background: #edf2f7;
        color: #4a5568;
        flex: 0.4;
        justify-content: center;
    }

    .btn-secondary-custom:hover {
        background: #e2e8f0;
        color: #2d3748;
    }

    .helper-text {
        font-size: 11px;
        color: #718096;
        margin-top: 3px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .helper-text i {
        font-size: 11px;
    }

    .form-label-icon {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .form-label-icon i {
        color: #667eea;
        font-size: 13px;
        width: 16px;
    }

    /* Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(15px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .form-card {
        animation: fadeInUp 0.4s ease;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .form-card-header {
            padding: 15px 18px;
        }

        .form-card-header h4 {
            font-size: 16px;
        }

        .form-card-body {
            padding: 16px 18px;
        }

        .row-custom {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn-custom {
            width: 100%;
            justify-content: center;
        }

        .btn-secondary-custom {
            flex: 1;
        }

        .internship-form-container {
            padding: 10px;
        }
    }

    /* Placeholder styling */
    .form-control-custom::placeholder {
        color: #a0aec0;
        font-size: 12px;
    }

    /* Success icon animation */
    .btn-primary-custom i {
        transition: transform 0.3s ease;
    }

    .btn-primary-custom:hover i {
        transform: translateX(3px);
    }

    /* Compact spacing for small screens */
    @media (max-width: 480px) {
        .form-card-header {
            padding: 12px 15px;
        }

        .form-card-header h4 {
            font-size: 14px;
        }

        .form-card-header p {
            font-size: 11px;
        }

        .form-card-body {
            padding: 12px 15px;
        }

        .form-group-custom {
            margin-bottom: 10px;
        }

        .form-control-custom {
            padding: 6px 10px;
            font-size: 12px;
        }

        .btn-custom {
            padding: 6px 16px;
            font-size: 12px;
        }
    }
</style>

<div class="internship-form-container">
    <div class="form-card">
        <div class="form-card-header">
            <h4>
                <i class="fas fa-user-graduate"></i>
                Post an Internship
            </h4>
            <p></p>
        </div>
        <div class="form-card-body">
            @if(session('success'))
                <div class="alert-custom alert-success-custom">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert-custom alert-error-custom">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('employer.internships.store') }}" method="POST" id="internshipForm">
                @csrf
                
                <!-- Title -->
                <div class="form-group-custom">
                    <label for="title" class="form-label-icon">
                        <i class="fas fa-heading"></i>
                        Internship Title <span class="required">*</span>
                    </label>
                    <input type="text" class="form-control-custom @error('title') is-invalid @enderror" 
                           id="title" name="title" value="{{ old('title') }}" 
                           placeholder="e.g., Web Development Internship" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Type & Mode -->
                <div class="row-custom">
                    <div class="form-group-custom">
                        <label for="internship_type" class="form-label-icon">
                            <i class="fas fa-tag"></i>
                            Type <span class="required">*</span>
                        </label>
                        <select class="form-control-custom @error('internship_type') is-invalid @enderror" 
                                id="internship_type" name="internship_type" required>
                            <option value="">Select Type</option>
                            <option value="paid" {{ old('internship_type') == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="unpaid" {{ old('internship_type') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                            <option value="stipend" {{ old('internship_type') == 'stipend' ? 'selected' : '' }}>Stipend</option>
                        </select>
                        @error('internship_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group-custom">
                        <label for="work_mode" class="form-label-icon">
                            <i class="fas fa-laptop-house"></i>
                            Mode <span class="required">*</span>
                        </label>
                        <select class="form-control-custom @error('work_mode') is-invalid @enderror" 
                                id="work_mode" name="work_mode" required>
                            <option value="">Select Mode</option>
                            <option value="onsite" {{ old('work_mode') == 'onsite' ? 'selected' : '' }}>Onsite</option>
                            <option value="hybrid" {{ old('work_mode') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                            <option value="remote" {{ old('work_mode') == 'remote' ? 'selected' : '' }}>Remote</option>
                        </select>
                        @error('work_mode')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Duration & Stipend -->
                <div class="row-custom">
                    <div class="form-group-custom">
                        <label for="duration" class="form-label-icon">
                            <i class="fas fa-clock"></i>
                            Duration <span class="required">*</span>
                        </label>
                        <input type="text" class="form-control-custom @error('duration') is-invalid @enderror" 
                               id="duration" name="duration" value="{{ old('duration') }}" 
                               placeholder="e.g., 3 months" required>
                        @error('duration')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group-custom">
                        <label for="stipend" class="form-label-icon">
                            <i class="fas fa-money-bill-wave"></i>
                            Stipend
                        </label>
                        <input type="text" class="form-control-custom @error('stipend') is-invalid @enderror" 
                               id="stipend" name="stipend" value="{{ old('stipend') }}" 
                               placeholder="e.g., $500/month">
                        @error('stipend')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Start & End Date -->
                <div class="row-custom">
                    <div class="form-group-custom">
                        <label for="start_date" class="form-label-icon">
                            <i class="fas fa-calendar-plus"></i>
                            Start Date
                        </label>
                        <input type="date" class="form-control-custom @error('start_date') is-invalid @enderror" 
                               id="start_date" name="start_date" value="{{ old('start_date') }}">
                        @error('start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group-custom">
                        <label for="end_date" class="form-label-icon">
                            <i class="fas fa-calendar-minus"></i>
                            End Date
                        </label>
                        <input type="date" class="form-control-custom @error('end_date') is-invalid @enderror" 
                               id="end_date" name="end_date" value="{{ old('end_date') }}">
                        @error('end_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Positions & Qualification -->
                <div class="row-custom">
                    <div class="form-group-custom">
                        <label for="positions" class="form-label-icon">
                            <i class="fas fa-users"></i>
                            Positions
                        </label>
                        <input type="number" class="form-control-custom @error('positions') is-invalid @enderror" 
                               id="positions" name="positions" value="{{ old('positions', 1) }}" min="1">
                        @error('positions')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group-custom">
                        <label for="qualification" class="form-label-icon">
                            <i class="fas fa-graduation-cap"></i>
                            Qualification
                        </label>
                        <input type="text" class="form-control-custom @error('qualification') is-invalid @enderror" 
                               id="qualification" name="qualification" value="{{ old('qualification') }}" 
                               placeholder="e.g., Bachelor's">
                        @error('qualification')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Skills -->
                <div class="form-group-custom">
                    <label for="skills" class="form-label-icon">
                        <i class="fas fa-code"></i>
                        Required Skills
                    </label>
                    <input type="text" class="form-control-custom @error('skills') is-invalid @enderror" 
                           id="skills" name="skills" value="{{ old('skills') }}" 
                           placeholder="PHP, Laravel, MySQL">
                    @error('skills')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="helper-text">
                        <i class="fas fa-info-circle"></i> Separate with commas
                    </div>
                </div>

                <!-- Location - Compact -->
                <div class="row-custom">
                    <div class="form-group-custom">
                        <label for="country" class="form-label-icon">
                            <i class="fas fa-globe"></i>
                            Country
                        </label>
                        <input type="text" class="form-control-custom @error('country') is-invalid @enderror" 
                               id="country" name="country" value="{{ old('country') }}" 
                               placeholder="Country">
                        @error('country')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group-custom">
                        <label for="state" class="form-label-icon">
                            <i class="fas fa-map-pin"></i>
                            State <span class="required">*</span>
                        </label>
                        <input type="text" class="form-control-custom @error('state') is-invalid @enderror" 
                               id="state" name="state" value="{{ old('state') }}" 
                               placeholder="State" required>
                        @error('state')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group-custom">
                        <label for="district" class="form-label-icon">
                            <i class="fas fa-map-marked-alt"></i>
                            District <span class="required">*</span>
                        </label>
                        <input type="text" class="form-control-custom @error('district') is-invalid @enderror" 
                               id="district" name="district" value="{{ old('district') }}" 
                               placeholder="District" required>
                        @error('district')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group-custom">
                        <label for="city" class="form-label-icon">
                            <i class="fas fa-city"></i>
                            City <span class="required">*</span>
                        </label>
                        <input type="text" class="form-control-custom @error('city') is-invalid @enderror" 
                               id="city" name="city" value="{{ old('city') }}" 
                               placeholder="City" required>
                        @error('city')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Description -->
                <div class="form-group-custom">
                    <label for="description" class="form-label-icon">
                        <i class="fas fa-align-left"></i>
                        Description <span class="required">*</span>
                    </label>
                    <textarea class="form-control-custom @error('description') is-invalid @enderror" 
                              id="description" name="description" rows="4" 
                              placeholder="Detailed description of the internship..." required>{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <button type="submit" class="btn-custom btn-primary-custom">
                        <i class="fas fa-paper-plane"></i>
                        Submit
                    </button>
                    <a href="{{ route('employer.internships.index') }}" class="btn-custom btn-secondary-custom">
                        <i class="fas fa-times"></i>
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('internshipForm');
        const submitBtn = form.querySelector('button[type="submit"]');

        // Loading state on submit
        form.addEventListener('submit', function() {
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';
            submitBtn.disabled = true;
        });

        // Auto-capitalize title
        const titleInput = document.getElementById('title');
        titleInput.addEventListener('blur', function() {
            if (this.value) {
                this.value = this.value.replace(/\w\S*/g, function(txt) {
                    return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
                });
            }
        });

        // Validate end date after start date
        const startDate = document.getElementById('start_date');
        const endDate = document.getElementById('end_date');

        endDate.addEventListener('change', function() {
            if (startDate.value && this.value) {
                if (new Date(this.value) <= new Date(startDate.value)) {
                    this.classList.add('is-invalid');
                    alert('End date must be after start date');
                    this.value = '';
                } else {
                    this.classList.remove('is-invalid');
                }
            }
        });

        // Remove invalid class on focus
        document.querySelectorAll('.form-control-custom').forEach(input => {
            input.addEventListener('focus', function() {
                this.classList.remove('is-invalid');
            });
        });
    });
</script>

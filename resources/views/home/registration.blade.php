@extends('layouts.app')

@section('content')

    <!-- Membership Hero -->
    <section class="hero" id="membership">
        <div class="container hero-inner">
            <div class="hero-copy">
                <p class="eyebrow">Welcome to Our Community</p>
                <h1>
                    Become a <span class="accent-text">Premium Member</span>
                </h1>
                <p class="hero-sub">
                    Unlock exclusive benefits, connect with industry leaders, and accelerate your
                    professional growth with our premium membership program.
                </p>
                <div class="hero-badges">
                    <span class="badge">
                        <svg viewBox="0 0 24 24" width="16" height="16">
                            <path d="M12 2l2.4 7.2H22l-6 4.6 2.3 7.2-6.3-4.6-6.3 4.6 2.3-7.2-6-4.6h7.6z" fill="currentColor"
                                stroke="none" />
                        </svg>
                        Verified Badge
                    </span>
                    <span class="badge">
                        <svg viewBox="0 0 24 24" width="16" height="16">
                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"
                                fill="none" />
                            <path d="M12 6v6l4 2" stroke="currentColor" stroke-width="2" fill="none" />
                        </svg>
                        24/7 Support
                    </span>
                    <span class="badge">
                        <svg viewBox="0 0 24 24" width="16" height="16">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" stroke="currentColor" stroke-width="2"
                                fill="none" />
                            <circle cx="9" cy="7" r="4" stroke="currentColor" stroke-width="2"
                                fill="none" />
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" stroke="currentColor"
                                stroke-width="2" fill="none" />
                        </svg>
                        Exclusive Network
                    </span>
                </div>
            </div>

            <div class="hero-membership">
                <div class="membership-card">
                    <span class="membership-glow"></span>
                    <div class="membership-badge">
                        <svg viewBox="0 0 24 24" width="28" height="28">
                            <path
                                d="M12 15C15.866 15 19 11.866 19 8C19 4.13401 15.866 1 12 1C8.13401 1 5 4.13401 5 8C5 11.866 8.13401 15 12 15Z"
                                stroke="white" stroke-width="1.5" fill="rgba(255,255,255,0.15)" />
                            <path d="M8.21 13.89L7 23L12 20L17 23L15.79 13.88" stroke="white" stroke-width="1.5"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
                    <h3>Ready to Get Started?</h3>
                    <p>Join thousands of professionals who are already part of our growing community.</p>
                    <div class="membership-actions">
                        <button class="btn btn-primary" id="joinNowBtn">
                            <span>Join Now</span>
                            <svg viewBox="0 0 24 24" width="16" height="16">
                                <path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" fill="none" />
                            </svg>
                        </button>
                        <a href="#" class="btn btn-secondary" id="membershipLoginBtn" data-login-trigger>
                            <span>Login</span>
                        </a>
                    </div>
                    <p class="membership-note">
                        <svg viewBox="0 0 24 24" width="14" height="14">
                            <path d="M12 2a10 10 0 1 0 10 10 10 10 0 0 0-10-10z" stroke="currentColor" stroke-width="2"
                                fill="none" />
                            <path d="M12 6v6l4 2" stroke="currentColor" stroke-width="2" fill="none" />
                        </svg>
                        Free trial available • No credit card required
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Registration Section - Full Width -->
    <section class="registration-section" id="registration-section">
        <div class="registration-wrapper-full">
            @if (session('status'))
                <div class="alert alert-success animate-fadeIn">
                    <svg viewBox="0 0 24 24" width="20" height="20">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" stroke="currentColor" stroke-width="2" fill="none"
                            stroke-linecap="round" />
                        <path d="M22 4L12 14.01l-3-3" stroke="currentColor" stroke-width="2" fill="none"
                            stroke-linecap="round" />
                    </svg>
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-error animate-shake">
                    <svg viewBox="0 0 24 24" width="20" height="20">
                        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"
                            fill="none" />
                        <path d="M12 8v4M12 16h.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    </svg>
                    <div>
                        <strong>Please fix the following errors:</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-error animate-shake">
                    <svg viewBox="0 0 24 24" width="20" height="20">
                        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"
                            fill="none" />
                        <path d="M12 8v4M12 16h.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            <div class="form-header text-center">
                <h2>Create Your Account</h2>
                <p>Fill in your details to get started with your professional journey</p>
            </div>

            <form method="POST" action="{{ route('do_registration') }}" enctype="multipart/form-data" id="registerForm"
                novalidate>
                @csrf

                <!-- Progress Steps -->
                <div class="progress-steps">
                    <div class="step active" data-step="1">
                        <div class="step-circle">
                            <span class="step-number">1</span>
                            <svg class="step-check" viewBox="0 0 24 24" width="16" height="16">
                                <polyline points="20 6 9 17 4 12" stroke="currentColor" stroke-width="3" fill="none"
                                    stroke-linecap="round" />
                            </svg>
                        </div>
                        <div class="step-label">Account Info</div>
                    </div>
                    <div class="step-connector" id="connector1"></div>
                    <div class="step" data-step="2">
                        <div class="step-circle">
                            <span class="step-number">2</span>
                            <svg class="step-check" viewBox="0 0 24 24" width="16" height="16">
                                <polyline points="20 6 9 17 4 12" stroke="currentColor" stroke-width="3" fill="none"
                                    stroke-linecap="round" />
                            </svg>
                        </div>
                        <div class="step-label">Choose Role</div>
                    </div>
                    <div class="step-connector" id="connector2"></div>
                    <div class="step" data-step="3">
                        <div class="step-circle">
                            <span class="step-number">3</span>
                            <svg class="step-check" viewBox="0 0 24 24" width="16" height="16">
                                <polyline points="20 6 9 17 4 12" stroke="currentColor" stroke-width="3" fill="none"
                                    stroke-linecap="round" />
                            </svg>
                        </div>
                        <div class="step-label">Role Details</div>
                    </div>
                </div>

                <div class="form-sections-grid">
                    <!-- Step 1: Account Information -->
                    <div class="form-card" id="step1-section">
                        <div class="card-header">
                            <div class="card-icon" style="background: linear-gradient(135deg, #2ECC71, #27AE60);">
                                <svg viewBox="0 0 24 24" width="24" height="24">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" stroke="white" stroke-width="2"
                                        fill="none" />
                                    <circle cx="12" cy="7" r="4" stroke="white" stroke-width="2"
                                        fill="none" />
                                </svg>
                            </div>
                            <div>
                                <h3>Account Information</h3>
                                <p>Fill in your basic details to create your account.</p>
                            </div>
                        </div>

                        <div class="form-grid">
                            <div class="form-group full-width">
                                <label class="form-label">
                                    <span>Full Name</span>
                                    <span class="required">*</span>
                                </label>
                                <div class="input-wrapper">
                                    <svg class="input-icon" viewBox="0 0 24 24" width="18" height="18">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" stroke="currentColor"
                                            stroke-width="2" fill="none" />
                                        <circle cx="12" cy="7" r="4" stroke="currentColor"
                                            stroke-width="2" fill="none" />
                                    </svg>
                                    <input type="text" name="name" value="{{ old('name') }}" required
                                        placeholder="Enter your full name">
                                </div>
                                @error('name')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    <span>Email Address</span>
                                    <span class="required">*</span>
                                </label>
                                <div class="input-wrapper">
                                    <svg class="input-icon" viewBox="0 0 24 24" width="18" height="18">
                                        <path
                                            d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"
                                            stroke="currentColor" stroke-width="2" fill="none" />
                                        <polyline points="22,6 12,13 2,6" stroke="currentColor" stroke-width="2"
                                            fill="none" />
                                    </svg>
                                    <input type="email" name="email" value="{{ old('email') }}" required
                                        placeholder="your@email.com">
                                </div>
                                @error('email')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    <span>Phone Number</span>
                                    <span class="required">*</span>
                                </label>
                                <div class="input-wrapper">
                                    <svg class="input-icon" viewBox="0 0 24 24" width="18" height="18">
                                        <path
                                            d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"
                                            stroke="currentColor" stroke-width="2" fill="none" />
                                    </svg>
                                    <input type="text" name="phone" value="{{ old('phone') }}" required
                                        placeholder="+91 9XXXXXXXXX">
                                </div>
                                @error('phone')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group" id="passwordFieldGroup">
                                <label class="form-label">
                                    <span>Password</span>
                                    <span class="required">*</span>
                                </label>
                                <div class="input-wrapper">
                                    <svg class="input-icon" viewBox="0 0 24 24" width="18" height="18">
                                        <rect x="3" y="11" width="18" height="11" rx="2"
                                            stroke="currentColor" stroke-width="2" fill="none" />
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4" stroke="currentColor" stroke-width="2"
                                            fill="none" />
                                    </svg>
                                    <input type="password" name="password" id="passwordInput" required
                                        placeholder="Minimum 8 characters">
                                </div>
                                @error('password')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group" id="passwordConfirmFieldGroup">
                                <label class="form-label">
                                    <span>Confirm Password</span>
                                    <span class="required">*</span>
                                </label>
                                <div class="input-wrapper">
                                    <svg class="input-icon" viewBox="0 0 24 24" width="18" height="18">
                                        <rect x="3" y="11" width="18" height="11" rx="2"
                                            stroke="currentColor" stroke-width="2" fill="none" />
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4" stroke="currentColor" stroke-width="2"
                                            fill="none" />
                                    </svg>
                                    <input type="password" name="password_confirmation" id="passwordConfirmInput"
                                        required placeholder="Re-enter your password">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Role Selection -->
                    <div class="form-card" id="step2-section">
                        <div class="card-header">
                            <div class="card-icon" style="background: linear-gradient(135deg, #4A90D9, #357ABD);">
                                <svg viewBox="0 0 24 24" width="24" height="24">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" stroke="white" stroke-width="2"
                                        fill="none" />
                                    <circle cx="9" cy="7" r="4" stroke="white" stroke-width="2"
                                        fill="none" />
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" stroke="white"
                                        stroke-width="2" fill="none" />
                                </svg>
                            </div>
                            <div>
                                <h3>Are you a?</h3>
                                <p>Select the role that best describes you. This will customize your registration
                                    experience.</p>
                            </div>
                        </div>

                        <div class="role-radio-grid">
                            @php
                                $roles = [
                                    'student' => 'Student',
                                    'employee' => 'Employee',
                                    'employer' => 'Employer',
                                    'freelancer' => 'Freelancer',
                                    'investor' => 'Investor',
                                    'mentor' => 'Mentor',
                                ];
                                $selectedRole = old('role', 'student');
                            @endphp

                            @foreach ($roles as $value => $label)
                                <label class="role-radio-card" data-role="{{ $value }}">
                                    <input type="radio" name="role" value="{{ $value }}"
                                        {{ $selectedRole === $value ? 'checked' : '' }} required>
                                    <span class="radio-circle"></span>
                                    <span class="radio-label">{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Step 3: Role-Specific Details -->
                    <div class="form-card" id="step3-section">
                        <div class="card-header">
                            <div class="card-icon" id="roleDetailIcon"
                                style="background: linear-gradient(135deg, #4A90D9, #357ABD);">
                                <svg viewBox="0 0 24 24" width="24" height="24">
                                    <path d="M12 2L2 7l10 5 10-5-10-5z" stroke="white" stroke-width="2" fill="none" />
                                    <path d="M2 17l10 5 10-5" stroke="white" stroke-width="2" fill="none" />
                                    <path d="M2 12l10 5 10-5" stroke="white" stroke-width="2" fill="none" />
                                </svg>
                            </div>
                            <div>
                                <h3 id="roleDetailTitle">Student Details</h3>
                                <p id="roleDescription">Provide your educational details to get started with internships
                                    and learning opportunities.</p>
                            </div>
                        </div>

                        <div class="form-grid" id="dynamicFields">
                            <!-- Dynamic fields injected by JavaScript -->
                        </div>
                    </div>

                    <!-- Terms and Submit -->
                    <div class="form-card submit-card">
                        <label class="checkbox-label">
                            <input type="checkbox" name="terms" required>
                            <span class="checkbox-custom">
                                <svg viewBox="0 0 24 24" width="14" height="14">
                                    <polyline points="20 6 9 17 4 12" stroke="white" stroke-width="3" fill="none"
                                        stroke-linecap="round" />
                                </svg>
                            </span>
                            <span class="checkbox-text">
                                I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy
                                    Policy</a>.
                                I understand my details will be reviewed as part of membership verification.
                            </span>
                        </label>

                        <button type="submit" class="submit-btn">
                            <span>Create Account</span>
                            <svg viewBox="0 0 24 24" width="20" height="20">
                                <path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" fill="none"
                                    stroke-linecap="round" />
                            </svg>
                        </button>

                        <p class="signin-text">
                            Already a member?
                            <a href="{{ route('membership') }}">Sign in to your account</a>
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Role Templates -->
    <template id="tpl-student">
        <div class="form-group">
            <label class="form-label"><span>College Name</span><span class="required">*</span></label>
            <input type="text" name="college_name" value="{{ old('college_name') }}" required
                placeholder="Enter college name">
        </div>
        <div class="form-group">
            <label class="form-label"><span>University</span><span class="required">*</span></label>
            <input type="text" name="university" value="{{ old('university') }}" required
                placeholder="Enter university">
        </div>
        <div class="form-group">
            <label class="form-label"><span>Course</span><span class="required">*</span></label>
            <input type="text" name="course" value="{{ old('course') }}" required placeholder="e.g. B.Tech CSE">
        </div>
        <div class="form-group">
            <label class="form-label"><span>Year of Study</span><span class="required">*</span></label>
            <select name="year" required>
                <option value="">Select year</option>
                <option value="1st Year" {{ old('year') == '1st Year' ? 'selected' : '' }}>1st Year</option>
                <option value="2nd Year" {{ old('year') == '2nd Year' ? 'selected' : '' }}>2nd Year</option>
                <option value="3rd Year" {{ old('year') == '3rd Year' ? 'selected' : '' }}>3rd Year</option>
                <option value="4th Year" {{ old('year') == '4th Year' ? 'selected' : '' }}>4th Year</option>
                <option value="Final Year" {{ old('year') == 'Final Year' ? 'selected' : '' }}>Final Year</option>
                <option value="Graduated" {{ old('year') == 'Graduated' ? 'selected' : '' }}>Graduated</option>
            </select>
        </div>
        <div class="form-group full-width">
            <label class="form-label"><span>Skills</span></label>
            <textarea name="skills" rows="3" placeholder="e.g. Python, React, Machine Learning">{{ old('skills') }}</textarea>
        </div>
        <div class="form-group full-width">
            <label class="form-label"><span>Interested Domain</span></label>
            <input type="text" name="interested_domain" value="{{ old('interested_domain') }}"
                placeholder="e.g. Web Development">
        </div>
        <div class="form-group">
            <label class="form-label"><span>Resume</span></label>
            <div class="file-upload">
                <input type="file" name="resume" id="resume-student" accept=".pdf,.doc,.docx">
                <label for="resume-student" class="file-label">
                    <svg viewBox="0 0 24 24" width="18" height="18">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" stroke="currentColor" stroke-width="2"
                            fill="none" />
                        <polyline points="17 8 12 3 7 8" stroke="currentColor" stroke-width="2" fill="none" />
                        <line x1="12" y1="3" x2="12" y2="15" stroke="currentColor"
                            stroke-width="2" />
                    </svg>
                    <span>Upload Resume</span>
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label"><span>College ID Card</span></label>
            <div class="file-upload">
                <input type="file" name="college_id_card" id="college-id" accept=".pdf,.jpg,.jpeg,.png">
                <label for="college-id" class="file-label">
                    <svg viewBox="0 0 24 24" width="18" height="18">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" stroke="currentColor" stroke-width="2"
                            fill="none" />
                        <polyline points="17 8 12 3 7 8" stroke="currentColor" stroke-width="2" fill="none" />
                        <line x1="12" y1="3" x2="12" y2="15" stroke="currentColor"
                            stroke-width="2" />
                    </svg>
                    <span>Upload ID Card</span>
                </label>
            </div>
        </div>
    </template>

    <template id="tpl-employee">
        <div class="form-group">
            <label class="form-label"><span>Company Name</span><span class="required">*</span></label>
            <input type="text" name="company_name" value="{{ old('company_name') }}" required
                placeholder="Current company name">
        </div>
        <div class="form-group">
            <label class="form-label"><span>Designation</span><span class="required">*</span></label>
            <input type="text" name="designation" value="{{ old('designation') }}" required
                placeholder="Your job title">
        </div>
        <div class="form-group">
            <label class="form-label"><span>Years of Experience</span><span class="required">*</span></label>
            <input type="number" name="experience_years" value="{{ old('experience_years') }}" min="0" required
                placeholder="e.g. 5">
        </div>
        <div class="form-group">
            <label class="form-label"><span>Current CTC (LPA)</span></label>
            <input type="number" name="current_ctc" value="{{ old('current_ctc') }}" step="0.01" min="0"
                placeholder="e.g. 5.5">
        </div>
        <div class="form-group">
            <label class="form-label"><span>Expected CTC (LPA)</span></label>
            <input type="number" name="expected_ctc" value="{{ old('expected_ctc') }}" step="0.01" min="0"
                placeholder="e.g. 8.0">
        </div>
        <div class="form-group">
            <label class="form-label"><span>LinkedIn Profile</span></label>
            <input type="url" name="linkedin" value="{{ old('linkedin') }}"
                placeholder="https://linkedin.com/in/...">
        </div>
        <div class="form-group full-width">
            <label class="form-label"><span>Skills</span></label>
            <textarea name="skills" rows="3" placeholder="e.g. Java, Spring Boot, AWS">{{ old('skills') }}</textarea>
        </div>
        <div class="form-group">
            <label class="form-label"><span>Resume</span></label>
            <div class="file-upload">
                <input type="file" name="resume" id="resume-employee" accept=".pdf,.doc,.docx">
                <label for="resume-employee" class="file-label">
                    <svg viewBox="0 0 24 24" width="18" height="18">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" stroke="currentColor" stroke-width="2"
                            fill="none" />
                        <polyline points="17 8 12 3 7 8" stroke="currentColor" stroke-width="2" fill="none" />
                        <line x1="12" y1="3" x2="12" y2="15" stroke="currentColor"
                            stroke-width="2" />
                    </svg>
                    <span>Upload Resume</span>
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label"><span>Experience Proof</span></label>
            <div class="file-upload">
                <input type="file" name="experience_proof" id="exp-proof" accept=".pdf,.jpg,.jpeg,.png">
                <label for="exp-proof" class="file-label">
                    <svg viewBox="0 0 24 24" width="18" height="18">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" stroke="currentColor" stroke-width="2"
                            fill="none" />
                        <polyline points="17 8 12 3 7 8" stroke="currentColor" stroke-width="2" fill="none" />
                        <line x1="12" y1="3" x2="12" y2="15" stroke="currentColor"
                            stroke-width="2" />
                    </svg>
                    <span>Upload Proof</span>
                </label>
            </div>
        </div>
    </template>

    <template id="tpl-employer">
        <div class="form-group">
            <label class="form-label"><span>Company Name</span><span class="required">*</span></label>
            <input type="text" name="company_name" value="{{ old('company_name') }}" required
                placeholder="Company name">
        </div>
        <div class="form-group">
            <label class="form-label"><span>Industry</span></label>
            <input type="text" name="industry" value="{{ old('industry') }}" placeholder="e.g. Technology, Finance">
        </div>
        <div class="form-group">
            <label class="form-label"><span>GST Number</span></label>
            <input type="text" name="gst_number" value="{{ old('gst_number') }}" placeholder="GSTIN">
        </div>
        <div class="form-group">
            <label class="form-label"><span>PAN Number</span></label>
            <input type="text" name="pan_number" value="{{ old('pan_number') }}" placeholder="PAN">
        </div>
        <div class="form-group">
            <label class="form-label"><span>Company Size</span></label>
            <select name="company_size">
                <option value="">Select range</option>
                <option value="1-10" {{ old('company_size') == '1-10' ? 'selected' : '' }}>1–10 employees</option>
                <option value="11-50" {{ old('company_size') == '11-50' ? 'selected' : '' }}>11–50 employees</option>
                <option value="51-200" {{ old('company_size') == '51-200' ? 'selected' : '' }}>51–200 employees</option>
                <option value="201-500" {{ old('company_size') == '201-500' ? 'selected' : '' }}>201–500 employees
                </option>
                <option value="500+" {{ old('company_size') == '500+' ? 'selected' : '' }}>500+ employees</option>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label"><span>Website</span></label>
            <input type="url" name="website" value="{{ old('website') }}" placeholder="https://...">
        </div>
        <div class="form-group full-width">
            <label class="form-label"><span>Company Address</span><span class="required">*</span></label>
            <textarea name="company_address" rows="3" required placeholder="Full company address">{{ old('company_address') }}</textarea>
        </div>
        <div class="form-group">
            <label class="form-label"><span>Company Logo</span></label>
            <div class="file-upload">
                <input type="file" name="company_logo" id="company-logo" accept=".jpg,.jpeg,.png,.svg">
                <label for="company-logo" class="file-label">
                    <svg viewBox="0 0 24 24" width="18" height="18">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" stroke="currentColor" stroke-width="2"
                            fill="none" />
                        <polyline points="17 8 12 3 7 8" stroke="currentColor" stroke-width="2" fill="none" />
                        <line x1="12" y1="3" x2="12" y2="15" stroke="currentColor"
                            stroke-width="2" />
                    </svg>
                    <span>Upload Logo</span>
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label"><span>Company Documents</span></label>
            <div class="file-upload">
                <input type="file" name="company_documents" id="company-docs" accept=".pdf,.doc,.docx">
                <label for="company-docs" class="file-label">
                    <svg viewBox="0 0 24 24" width="18" height="18">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" stroke="currentColor" stroke-width="2"
                            fill="none" />
                        <polyline points="17 8 12 3 7 8" stroke="currentColor" stroke-width="2" fill="none" />
                        <line x1="12" y1="3" x2="12" y2="15" stroke="currentColor"
                            stroke-width="2" />
                    </svg>
                    <span>Upload Documents</span>
                </label>
            </div>
        </div>
    </template>

    <template id="tpl-freelancer">
        <div class="form-group">
            <label class="form-label"><span>Specialization</span><span class="required">*</span></label>
            <input type="text" name="specialization" value="{{ old('specialization') }}" required
                placeholder="e.g. UI/UX Design">
        </div>
        <div class="form-group">
            <label class="form-label"><span>Years of Experience</span><span class="required">*</span></label>
            <input type="number" name="experience" value="{{ old('experience') }}" min="0" required
                placeholder="e.g. 3">
        </div>
        <div class="form-group">
            <label class="form-label"><span>Hourly Rate (₹)</span></label>
            <input type="number" name="hourly_rate" value="{{ old('hourly_rate') }}" step="0.01" min="0"
                placeholder="e.g. 500">
        </div>
        <div class="form-group">
            <label class="form-label"><span>Availability</span></label>
            <select name="availability">
                <option value="">Select availability</option>
                <option value="Full-time" {{ old('availability') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                <option value="Part-time" {{ old('availability') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                <option value="Weekends" {{ old('availability') == 'Weekends' ? 'selected' : '' }}>Weekends</option>
                <option value="Not available" {{ old('availability') == 'Not available' ? 'selected' : '' }}>Not available
                    right now</option>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label"><span>Portfolio Link</span></label>
            <input type="url" name="portfolio_link" value="{{ old('portfolio_link') }}" placeholder="https://...">
        </div>
        <div class="form-group">
            <label class="form-label"><span>GitHub Profile</span></label>
            <input type="url" name="github" value="{{ old('github') }}" placeholder="https://github.com/...">
        </div>
        <div class="form-group">
            <label class="form-label"><span>LinkedIn Profile</span></label>
            <input type="url" name="linkedin" value="{{ old('linkedin') }}"
                placeholder="https://linkedin.com/in/...">
        </div>
        <div class="form-group full-width">
            <label class="form-label"><span>Skills</span></label>
            <textarea name="skills" rows="3" placeholder="e.g. Figma, React, WordPress">{{ old('skills') }}</textarea>
        </div>
    </template>

    <template id="tpl-investor">
        <div class="form-group">
            <label class="form-label"><span>Organization</span><span class="required">*</span></label>
            <input type="text" name="organization" value="{{ old('organization') }}" required
                placeholder="Fund, firm, or 'Individual'">
        </div>
        <div class="form-group">
            <label class="form-label"><span>Investment Stage</span><span class="required">*</span></label>
            <select name="investment_stage" required>
                <option value="">Select stage</option>
                <option value="Idea" {{ old('investment_stage') == 'Idea' ? 'selected' : '' }}>Idea</option>
                <option value="Pre-seed" {{ old('investment_stage') == 'Pre-seed' ? 'selected' : '' }}>Pre-seed</option>
                <option value="Seed" {{ old('investment_stage') == 'Seed' ? 'selected' : '' }}>Seed</option>
                <option value="Series A" {{ old('investment_stage') == 'Series A' ? 'selected' : '' }}>Series A</option>
                <option value="Series B+" {{ old('investment_stage') == 'Series B+' ? 'selected' : '' }}>Series B+
                </option>
                <option value="Growth" {{ old('investment_stage') == 'Growth' ? 'selected' : '' }}>Growth</option>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label"><span>Investment Range</span><span class="required">*</span></label>
            <select name="investment_range" required>
                <option value="">Select range</option>
                <option value="Under ₹5L" {{ old('investment_range') == 'Under ₹5L' ? 'selected' : '' }}>Under ₹5L
                </option>
                <option value="₹5L - ₹25L" {{ old('investment_range') == '₹5L - ₹25L' ? 'selected' : '' }}>₹5L – ₹25L
                </option>
                <option value="₹25L - ₹1Cr" {{ old('investment_range') == '₹25L - ₹1Cr' ? 'selected' : '' }}>₹25L – ₹1Cr
                </option>
                <option value="₹1Cr - ₹5Cr" {{ old('investment_range') == '₹1Cr - ₹5Cr' ? 'selected' : '' }}>₹1Cr – ₹5Cr
                </option>
                <option value="₹5Cr+" {{ old('investment_range') == '₹5Cr+' ? 'selected' : '' }}>₹5Cr+</option>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label"><span>Preferred Sectors</span><span class="required">*</span></label>
            <input type="text" name="preferred_sectors" value="{{ old('preferred_sectors') }}" required
                placeholder="e.g. Fintech, HealthTech">
        </div>
        <div class="form-group">
            <label class="form-label"><span>LinkedIn Profile</span></label>
            <input type="url" name="linkedin" value="{{ old('linkedin') }}"
                placeholder="https://linkedin.com/in/...">
        </div>
        <div class="form-group">
            <label class="form-label"><span>Website</span></label>
            <input type="url" name="website" value="{{ old('website') }}" placeholder="https://...">
        </div>
        <div class="form-group full-width">
            <label class="form-label"><span>Short Bio</span></label>
            <textarea name="bio" rows="3" placeholder="Tell us about yourself and your investment philosophy...">{{ old('bio') }}</textarea>
        </div>
        <div class="form-group full-width">
            <label class="form-label"><span>Verification Document</span></label>
            <div class="file-upload">
                <input type="file" name="verification_document" id="verification-doc" accept=".pdf,.jpg,.jpeg,.png">
                <label for="verification-doc" class="file-label">
                    <svg viewBox="0 0 24 24" width="18" height="18">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" stroke="currentColor" stroke-width="2"
                            fill="none" />
                        <polyline points="17 8 12 3 7 8" stroke="currentColor" stroke-width="2" fill="none" />
                        <line x1="12" y1="3" x2="12" y2="15" stroke="currentColor"
                            stroke-width="2" />
                    </svg>
                    <span>Upload Document</span>
                </label>
            </div>
        </div>
    </template>

    <template id="tpl-mentor">
        <div class="form-group">
            <label class="form-label"><span>Company</span><span class="required">*</span></label>
            <input type="text" name="company" value="{{ old('company') }}" required
                placeholder="Current or most recent company">
        </div>
        <div class="form-group">
            <label class="form-label"><span>Designation</span><span class="required">*</span></label>
            <input type="text" name="designation" value="{{ old('designation') }}" required
                placeholder="Your job title">
        </div>
        <div class="form-group">
            <label class="form-label"><span>Area of Expertise</span><span class="required">*</span></label>
            <input type="text" name="expertise" value="{{ old('expertise') }}" required
                placeholder="e.g. Product Management">
        </div>
        <div class="form-group">
            <label class="form-label"><span>Years of Experience</span><span class="required">*</span></label>
            <input type="number" name="years_of_experience" value="{{ old('years_of_experience') }}" min="0"
                required placeholder="e.g. 10">
        </div>
        <div class="form-group">
            <label class="form-label"><span>Availability</span></label>
            <select name="availability">
                <option value="">Select availability</option>
                <option value="Weekdays" {{ old('availability') == 'Weekdays' ? 'selected' : '' }}>Weekdays</option>
                <option value="Weekends" {{ old('availability') == 'Weekends' ? 'selected' : '' }}>Weekends</option>
                <option value="Flexible" {{ old('availability') == 'Flexible' ? 'selected' : '' }}>Flexible</option>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label"><span>LinkedIn Profile</span></label>
            <input type="url" name="linkedin" value="{{ old('linkedin') }}"
                placeholder="https://linkedin.com/in/...">
        </div>
        <div class="form-group full-width">
            <label class="form-label"><span>Short Bio</span></label>
            <textarea name="bio" rows="3" placeholder="Tell us about your experience and mentoring philosophy...">{{ old('bio') }}</textarea>
        </div>
        <div class="form-group">
            <label class="form-label"><span>Resume</span></label>
            <div class="file-upload">
                <input type="file" name="resume" id="resume-mentor" accept=".pdf,.doc,.docx">
                <label for="resume-mentor" class="file-label">
                    <svg viewBox="0 0 24 24" width="18" height="18">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" stroke="currentColor" stroke-width="2"
                            fill="none" />
                        <polyline points="17 8 12 3 7 8" stroke="currentColor" stroke-width="2" fill="none" />
                        <line x1="12" y1="3" x2="12" y2="15" stroke="currentColor"
                            stroke-width="2" />
                    </svg>
                    <span>Upload Resume</span>
                </label>
            </div>
        </div>
    </template>

    <!-- Styles -->
    <style>
        /* Registration Section - Full Width */
        .registration-section {
            padding: 0;
            background: linear-gradient(180deg, #F4F3F8 0%, #FFFFFF 100%);
            scroll-margin-top: 20px;
            display: none;
            min-height: 100vh;
        }

        .registration-section.visible {
            display: flex;
            align-items: stretch;
        }

        .registration-wrapper-full {
            width: 100%;
            max-width: 100%;
            margin: 0;
            background: white;
            border-radius: 0;
            padding: 60px 80px;
            box-shadow: none;
            border: none;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .text-center {
            text-align: center;
        }

        .form-header {
            margin-bottom: 40px;
            padding-bottom: 30px;
            border-bottom: 2px solid #F4F3F8;
        }

        .form-header h2 {
            margin: 0 0 8px;
            font-size: 32px;
            font-weight: 800;
            color: #2d3748;
        }

        .form-header p {
            margin: 0;
            font-size: 16px;
            color: #6c757d;
        }

        /* Hero Section */
        .hero {
            padding: 80px 0 60px;
            background: linear-gradient(135deg, #F8F9FC 0%, #FFFFFF 100%);
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(74, 144, 217, 0.05) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .hero-inner {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        .hero-copy {
            max-width: 600px;
        }

        .eyebrow {
            display: inline-block;
            font-size: 13px;
            font-weight: 700;
            color: #4A90D9;
            text-transform: uppercase;
            letter-spacing: 2px;
            background: linear-gradient(90deg, rgba(74, 144, 217, 0.1), rgba(74, 144, 217, 0.05));
            padding: 6px 16px;
            border-radius: 50px;
            margin-bottom: 16px;
        }

        .hero h1 {
            font-size: 48px;
            font-weight: 800;
            color: #2d3748;
            margin: 0 0 16px;
            line-height: 1.2;
        }

        .accent-text {
            background: linear-gradient(135deg, #4A90D9, #2d3748);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-sub {
            font-size: 18px;
            line-height: 1.7;
            color: #6c757d;
            margin: 0 0 24px;
        }

        .hero-badges {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            background: white;
            border: 1px solid #E3E1EC;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
            color: #2d3748;
            transition: all 0.3s ease;
        }

        .badge:hover {
            border-color: #4A90D9;
            box-shadow: 0 2px 8px rgba(74, 144, 217, 0.15);
            transform: translateY(-2px);
        }

        .badge svg {
            color: #4A90D9;
            flex-shrink: 0;
        }

        .hero-membership {
            display: flex;
            justify-content: flex-end;
        }

        .membership-card {
            background: linear-gradient(135deg, #2d3748, #1a202c);
            border-radius: 20px;
            padding: 40px 36px;
            color: white;
            position: relative;
            overflow: hidden;
            max-width: 380px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        }

        .membership-glow {
            position: absolute;
            top: -50%;
            right: -30%;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(74, 144, 217, 0.15), transparent 70%);
            pointer-events: none;
        }

        .membership-badge {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            background: linear-gradient(135deg, #4A90D9, #357ABD);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            box-shadow: 0 8px 24px rgba(74, 144, 217, 0.3);
            position: relative;
            z-index: 1;
        }

        .membership-card h3 {
            font-size: 24px;
            font-weight: 700;
            margin: 0 0 8px;
            position: relative;
            z-index: 1;
        }

        .membership-card p {
            font-size: 15px;
            color: rgba(255, 255, 255, 0.7);
            margin: 0 0 24px;
            line-height: 1.6;
            position: relative;
            z-index: 1;
        }

        .membership-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 16px;
            position: relative;
            z-index: 1;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            font-family: inherit;
            cursor: pointer;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4A90D9, #357ABD);
            color: white;
            box-shadow: 0 4px 16px rgba(74, 144, 217, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(74, 144, 217, 0.4);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .btn svg {
            flex-shrink: 0;
            transition: transform 0.3s ease;
        }

        .btn-primary:hover svg {
            transform: translateX(4px);
        }

        .membership-note {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: rgba(255, 255, 255, 0.5) !important;
            margin: 0 !important;
            position: relative;
            z-index: 1;
        }

        .membership-note svg {
            stroke: rgba(255, 255, 255, 0.3);
            flex-shrink: 0;
        }

        /* Progress Steps */
        .progress-steps {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 40px;
            padding: 0 10px;
        }

        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            position: relative;
        }

        .step-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: white;
            border: 2px solid #E3E1EC;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .step-number {
            font-weight: 700;
            color: #9891ab;
            font-size: 14px;
            transition: all 0.4s ease;
        }

        .step-check {
            position: absolute;
            opacity: 0;
            transform: scale(0);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            color: white;
        }

        .step.active .step-circle {
            border-color: var(--accent-color, #4A90D9);
            background: linear-gradient(135deg, var(--accent-color, #4A90D9), #2d3748);
            box-shadow: 0 0 0 6px rgba(74, 144, 217, 0.15);
        }

        .step.active .step-number {
            color: white;
        }

        .step.completed .step-circle {
            background: linear-gradient(135deg, #2ECC71, #27AE60);
            border-color: #2ECC71;
        }

        .step.completed .step-number {
            opacity: 0;
            transform: scale(0);
        }

        .step.completed .step-check {
            opacity: 1;
            transform: scale(1);
        }

        .step-label {
            font-size: 12px;
            font-weight: 600;
            color: #9891ab;
            transition: color 0.3s ease;
            white-space: nowrap;
        }

        .step.active .step-label,
        .step.completed .step-label {
            color: #231932;
        }

        .step-connector {
            width: 80px;
            height: 2px;
            background: #E3E1EC;
            margin: 0 10px 24px;
            position: relative;
            overflow: hidden;
        }

        .step-connector::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, #2ECC71, #27AE60);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .step-connector.completed::after {
            transform: scaleX(1);
        }

        /* Form Sections Grid */
        .form-sections-grid {
            display: grid;
            gap: 30px;
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Form Card */
        .form-card {
            background: white;
            border-radius: 16px;
            padding: 32px;
            border: 1px solid #E3E1EC;
            transition: all 0.3s ease;
            animation: slideUp 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .form-card:hover {
            border-color: #D2CEE0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 24px;
            padding-bottom: 20px;
            border-bottom: 2px solid #F4F3F8;
        }

        .card-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 4px 12px -4px rgba(0, 0, 0, 0.2);
        }

        .card-header h3 {
            margin: 0 0 4px;
            font-size: 20px;
            color: #2d3748;
            font-weight: 700;
        }

        .card-header p {
            margin: 0;
            font-size: 14px;
            color: #6c757d;
        }

        /* Form Grid */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        @media (min-width: 1200px) {
            .form-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-label {
            font-size: 14px;
            font-weight: 600;
            color: #2d3748;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .required {
            color: #E74C3C;
            font-weight: 700;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #9891ab;
            pointer-events: none;
            transition: color 0.3s ease;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="password"],
        .form-group input[type="number"],
        .form-group input[type="url"],
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 12px 12px 40px;
            border: 2px solid #E3E1EC;
            border-radius: 10px;
            font-size: 14px;
            font-family: inherit;
            color: #2d3748;
            background: #FAFAFC;
            transition: all 0.3s ease;
            outline: none;
        }

        .form-group textarea {
            padding: 12px;
            resize: vertical;
            min-height: 80px;
        }

        .form-group select {
            padding: 12px;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: var(--accent-color, #4A90D9);
            background: white;
            box-shadow: 0 0 0 4px rgba(74, 144, 217, 0.1);
        }

        .form-group input:focus+.input-icon,
        .form-group input:focus~.input-icon {
            color: var(--accent-color, #4A90D9);
        }

        .error-message {
            font-size: 12px;
            color: #E74C3C;
            margin-top: 4px;
            animation: shake 0.4s ease;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-5px);
            }

            75% {
                transform: translateX(5px);
            }
        }

        /* Role Radio Grid */
        .role-radio-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }

        @media (min-width: 1200px) {
            .role-radio-grid {
                grid-template-columns: repeat(6, 1fr);
            }
        }

        .role-radio-card {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px 20px;
            border: 2px solid #E3E1EC;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: white;
            position: relative;
        }

        .role-radio-card:hover {
            border-color: #D2CEE0;
            background: #FAFAFC;
            transform: translateY(-2px);
        }

        .role-radio-card input[type="radio"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .radio-circle {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 2px solid #D2CEE0;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: all 0.3s ease;
        }

        .radio-circle::after {
            content: '';
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--accent-color, #4A90D9);
            transform: scale(0);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .role-radio-card input:checked~.radio-circle {
            border-color: var(--accent-color, #4A90D9);
            box-shadow: 0 0 0 4px rgba(74, 144, 217, 0.15);
        }

        .role-radio-card input:checked~.radio-circle::after {
            transform: scale(1);
        }

        .role-radio-card input:checked~.radio-label {
            color: var(--accent-color, #4A90D9);
            font-weight: 700;
        }

        .role-radio-card:has(input:checked) {
            border-color: var(--accent-color, #4A90D9);
            background: linear-gradient(90deg, #F0EDF7, #FFFFFF);
            box-shadow: 0 4px 12px rgba(74, 144, 217, 0.1);
        }

        .radio-label {
            font-size: 15px;
            font-weight: 600;
            color: #2d3748;
            transition: all 0.3s ease;
        }

        /* File Upload */
        .file-upload {
            position: relative;
        }

        .file-upload input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .file-label {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 16px;
            border: 2px dashed #D2CEE0;
            border-radius: 10px;
            background: #FAFAFC;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
            font-weight: 500;
            color: #6c757d;
        }

        .file-label:hover {
            border-color: var(--accent-color, #4A90D9);
            background: #F0EDF7;
            color: var(--accent-color, #4A90D9);
        }

        /* Submit Card */
        .submit-card {
            text-align: center;
            padding: 32px;
            background: linear-gradient(180deg, #FAFAFC 0%, #FFFFFF 100%);
        }

        .checkbox-label {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            cursor: pointer;
            margin-bottom: 24px;
            text-align: left;
        }

        .checkbox-label input[type="checkbox"] {
            display: none;
        }

        .checkbox-custom {
            width: 20px;
            height: 20px;
            border: 2px solid #D2CEE0;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: all 0.3s ease;
            margin-top: 2px;
        }

        .checkbox-custom svg {
            opacity: 0;
            transform: scale(0);
            transition: all 0.3s ease;
        }

        .checkbox-label input:checked+.checkbox-custom {
            background: var(--accent-color, #4A90D9);
            border-color: var(--accent-color, #4A90D9);
        }

        .checkbox-label input:checked+.checkbox-custom svg {
            opacity: 1;
            transform: scale(1);
        }

        .checkbox-text {
            font-size: 14px;
            color: #6c757d;
            line-height: 1.6;
        }

        .checkbox-text a {
            color: var(--accent-color, #4A90D9);
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .checkbox-text a:hover {
            color: #2d3748;
            text-decoration: underline;
        }

        .submit-btn {
            width: 100%;
            max-width: 400px;
            padding: 16px;
            font-size: 16px;
            font-weight: 700;
            font-family: inherit;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--accent-color, #4A90D9), #2d3748);
            color: white;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            position: relative;
            overflow: hidden;
        }

        .submit-btn::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(74, 144, 217, 0.3);
        }

        .submit-btn:hover::before {
            opacity: 1;
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .submit-btn svg {
            transition: transform 0.3s ease;
        }

        .submit-btn:hover svg {
            transform: translateX(4px);
        }

        .signin-text {
            margin-top: 20px;
            font-size: 15px;
            color: #6c757d;
        }

        .signin-text a {
            color: var(--accent-color, #4A90D9);
            font-weight: 700;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .signin-text a:hover {
            color: #2d3748;
        }

        /* Alerts */
        .alert {
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 24px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            font-size: 14px;
            animation: slideDown 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background: #E8F3EC;
            color: #24603C;
            border: 1px solid #BFE3CA;
        }

        .alert-error {
            background: #FBEAEF;
            color: #B4425C;
            border: 1px solid #F1C6D2;
        }

        .alert svg {
            flex-shrink: 0;
            margin-top: 2px;
        }

        .alert ul {
            margin: 6px 0 0;
            padding-left: 18px;
        }

        .animate-fadeIn {
            animation: fadeIn 0.5s ease;
        }

        .animate-shake {
            animation: shake 0.5s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* Responsive Design */
        @media (max-width: 1400px) {
            .registration-wrapper-full {
                padding: 50px 60px;
            }
        }

        @media (max-width: 1200px) {
            .registration-wrapper-full {
                padding: 40px 40px;
            }

            .form-sections-grid {
                max-width: 100%;
            }

            .form-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .hero-inner {
                gap: 40px;
            }

            .hero h1 {
                font-size: 38px;
            }
        }

        @media (max-width: 1024px) {
            .registration-wrapper-full {
                padding: 30px 30px;
            }

            .role-radio-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 768px) {
            .hero {
                padding: 60px 0 40px;
            }

            .hero-inner {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .hero-copy {
                max-width: 100%;
                text-align: center;
            }

            .hero h1 {
                font-size: 32px;
            }

            .hero-badges {
                justify-content: center;
            }

            .hero-membership {
                justify-content: center;
            }

            .membership-card {
                max-width: 100%;
                padding: 32px 24px;
            }

            .membership-actions {
                justify-content: center;
            }

            .registration-wrapper-full {
                padding: 24px 20px;
            }

            .form-sections-grid {
                gap: 20px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .role-radio-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .progress-steps {
                gap: 0;
            }

            .step-connector {
                width: 40px;
                margin: 0 5px 24px;
            }

            .step-label {
                font-size: 10px;
            }

            .step-circle {
                width: 34px;
                height: 34px;
            }

            .step-number {
                font-size: 12px;
            }

            .form-card {
                padding: 20px;
            }

            .card-header {
                flex-direction: column;
                text-align: center;
            }

            .form-header h2 {
                font-size: 24px;
            }
        }

        @media (max-width: 480px) {
            .hero h1 {
                font-size: 28px;
            }

            .hero-sub {
                font-size: 16px;
            }

            .membership-card {
                padding: 24px 20px;
            }

            .membership-card h3 {
                font-size: 20px;
            }

            .membership-actions {
                flex-direction: column;
                width: 100%;
            }

            .btn {
                justify-content: center;
                width: 100%;
            }

            .registration-wrapper-full {
                padding: 16px 12px;
            }

            .role-radio-grid {
                grid-template-columns: 1fr;
            }

            .form-card {
                padding: 16px;
            }

            .form-header h2 {
                font-size: 22px;
            }

            .form-header {
                margin-bottom: 24px;
                padding-bottom: 20px;
            }

            .submit-btn {
                max-width: 100%;
            }
        }

        @media (min-width: 1600px) {
            .registration-wrapper-full {
                padding: 80px 120px;
            }

            .form-sections-grid {
                max-width: 1600px;
            }

            .form-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 24px;
            }

            .form-header h2 {
                font-size: 36px;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const joinNowBtn = document.getElementById('joinNowBtn');
            const registrationSection = document.getElementById('registration-section');

            // Show registration section when "Join Now" is clicked
            joinNowBtn.addEventListener('click', function(e) {
                e.preventDefault();

                // Show the registration section
                registrationSection.classList.add('visible');
                registrationSection.style.display = 'flex';

                // Scroll to the registration section with smooth animation
                setTimeout(() => {
                    registrationSection.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }, 100);
            });

            // If there are validation errors, show the form automatically
            const hasErrors = document.querySelector('.alert-error');
            if (hasErrors) {
                registrationSection.classList.add('visible');
                registrationSection.style.display = 'flex';
            }

            const roleRadios = document.querySelectorAll('.role-radio-card input[type="radio"]');
            const dynamicFields = document.getElementById('dynamicFields');
            const roleDescription = document.getElementById('roleDescription');
            const roleDetailTitle = document.getElementById('roleDetailTitle');
            const roleDetailIcon = document.getElementById('roleDetailIcon');
            const progressSteps = document.querySelectorAll('.step');
            const connectors = document.querySelectorAll('.step-connector');

            // Password field elements - hidden/disabled for the investor role,
            // since investor accounts are provisioned with a password by an admin.
            const passwordFieldGroup = document.getElementById('passwordFieldGroup');
            const passwordConfirmFieldGroup = document.getElementById('passwordConfirmFieldGroup');
            const passwordInput = document.getElementById('passwordInput');
            const passwordConfirmInput = document.getElementById('passwordConfirmInput');

            const roleConfig = {
                student: {
                    title: 'Student Details',
                    description: 'Provide your educational details to get started with internships and learning opportunities.',
                    gradient: 'linear-gradient(135deg, #4A90D9, #357ABD)',
                    accent: '#4A90D9'
                },
                employee: {
                    title: 'Employee Details',
                    description: 'Share your professional experience to access job switches and career growth tools.',
                    gradient: 'linear-gradient(135deg, #2ECC71, #27AE60)',
                    accent: '#2ECC71'
                },
                employer: {
                    title: 'Employer Details',
                    description: 'Tell us about your company to post jobs and find the right talent.',
                    gradient: 'linear-gradient(135deg, #F39C12, #E67E22)',
                    accent: '#F39C12'
                },
                freelancer: {
                    title: 'Freelancer Details',
                    description: 'Showcase your skills and services to connect with potential clients.',
                    gradient: 'linear-gradient(135deg, #9B59B6, #8E44AD)',
                    accent: '#9B59B6'
                },
                investor: {
                    title: 'Investor Details',
                    description: 'Share your investment preferences to discover promising startups.',
                    gradient: 'linear-gradient(135deg, #E74C3C, #C0392B)',
                    accent: '#E74C3C'
                },
                mentor: {
                    title: 'Mentor Details',
                    description: 'Tell us about your expertise to start guiding the next generation of professionals.',
                    gradient: 'linear-gradient(135deg, #3498DB, #2980B9)',
                    accent: '#3498DB'
                }
            };

            function renderRoleFields(role) {
                const template = document.getElementById('tpl-' + role);
                if (template) {
                    dynamicFields.innerHTML = '';
                    const clone = template.content.cloneNode(true);
                    dynamicFields.appendChild(clone);

                    const config = roleConfig[role];
                    roleDetailTitle.textContent = config.title;
                    roleDescription.textContent = config.description;
                    roleDetailIcon.style.background = config.gradient;

                    document.documentElement.style.setProperty('--accent-color', config.accent);
                }
            }

            // Toggle the password fields based on role: investors don't set their
            // own password (it's issued by an admin after verification), so we
            // hide the inputs, drop the "required" attribute, and clear any value.
            function togglePasswordFields(role) {
                const isInvestor = role === 'investor';

                passwordFieldGroup.style.display = isInvestor ? 'none' : '';
                passwordConfirmFieldGroup.style.display = isInvestor ? 'none' : '';

                passwordInput.required = !isInvestor;
                passwordConfirmInput.required = !isInvestor;

                if (isInvestor) {
                    passwordInput.value = '';
                    passwordConfirmInput.value = '';
                }
            }

            function updateProgress(step) {
                progressSteps.forEach((s, index) => {
                    const stepNum = index + 1;
                    s.classList.remove('active', 'completed');
                    if (stepNum < step) s.classList.add('completed');
                    if (stepNum === step) s.classList.add('active');
                });

                connectors.forEach((connector, index) => {
                    if (index < step - 1) {
                        connector.classList.add('completed');
                    } else {
                        connector.classList.remove('completed');
                    }
                });
            }

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const sectionId = entry.target.id;
                        if (sectionId === 'step1-section') updateProgress(1);
                        if (sectionId === 'step2-section') updateProgress(2);
                        if (sectionId === 'step3-section') updateProgress(3);
                    }
                });
            }, {
                threshold: 0.3
            });

            document.querySelectorAll('.form-card').forEach(card => {
                observer.observe(card);
            });

            const initialRole = document.querySelector('.role-radio-card input[type="radio"]:checked');
            if (initialRole) {
                renderRoleFields(initialRole.value);
                togglePasswordFields(initialRole.value);
                const config = roleConfig[initialRole.value];
                document.documentElement.style.setProperty('--accent-color', config.accent);
            }

            roleRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    renderRoleFields(this.value);
                    togglePasswordFields(this.value);

                    setTimeout(() => {
                        document.getElementById('step3-section').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    }, 200);
                });
            });

            document.addEventListener('change', function(e) {
                if (e.target.type === 'file') {
                    const label = e.target.nextElementSibling;
                    if (label && e.target.files.length > 0) {
                        label.querySelector('span').textContent = e.target.files[0].name;
                        label.style.borderColor = '#2ECC71';
                        label.style.color = '#2ECC71';
                        label.style.background = '#E8F3EC';
                    }
                }
            });

            const firstError = document.querySelector('.alert-error');
            if (firstError) {
                firstError.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                updateProgress(1);
            }
        });
    </script>

@endsection
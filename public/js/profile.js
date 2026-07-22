document.addEventListener('DOMContentLoaded', function() {

    // ---------- Validation helpers ----------
    function showFieldError(el, message) {
        const errorEl = el.parentElement.querySelector('.field-error');
        if (errorEl) errorEl.textContent = message;
        el.classList.add('is-invalid');
    }

    function clearFieldError(el) {
        const errorEl = el.parentElement.querySelector('.field-error');
        if (errorEl) errorEl.textContent = '';
        el.classList.remove('is-invalid');
    }

    function isValidEmail(value) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value.trim());
    }

    function isValidPhone(value) {
        return /^[0-9+\-\s()]{7,15}$/.test(value.trim());
    }

    // ---------- Avatar upload validation ----------
    const avatarInput = document.getElementById('avatarUpload');
    const avatarError = document.getElementById('avatarError');
    const avatarForm = document.getElementById('avatarForm');

    if (avatarInput && avatarForm) {
        avatarInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (avatarError) avatarError.textContent = '';
            if (!file) return;

            const allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
            const maxSize = 2 * 1024 * 1024; // 2MB

            if (!allowedTypes.includes(file.type)) {
                if (avatarError) avatarError.textContent = 'Please upload a JPG, PNG, WEBP or GIF image.';
                this.value = '';
                return;
            }
            if (file.size > maxSize) {
                if (avatarError) avatarError.textContent = 'Image size must not exceed 2MB.';
                this.value = '';
                return;
            }

            // Valid file selected — submit the real form (full page reload,
            // avatar comes back saved from the server on the next render)
            avatarForm.submit();
        });
    }

    // ---------- Resume drag & drop ----------
    const dropzone = document.getElementById('resumeDropzone');
    const resumeInput = document.getElementById('resumeUpload');
    const fileNameLabel = document.getElementById('resumeFileName');
    const resumeError = document.getElementById('resumeError');
    const resumeForm = document.getElementById('resumeForm');

    if (dropzone && resumeInput) {
        ['dragenter', 'dragover'].forEach(evt => {
            dropzone.addEventListener(evt, e => {
                e.preventDefault();
                dropzone.classList.add('dragover');
            });
        });

        ['dragleave', 'drop'].forEach(evt => {
            dropzone.addEventListener(evt, e => {
                e.preventDefault();
                dropzone.classList.remove('dragover');
            });
        });

        dropzone.addEventListener('drop', function(e) {
            const files = e.dataTransfer.files;
            if (files && files.length) {
                resumeInput.files = files;
                fileNameLabel.textContent = files[0].name;
                dropzone.classList.remove('is-invalid');
                if (resumeError) resumeError.textContent = '';
            }
        });

        resumeInput.addEventListener('change', function() {
            if (this.files && this.files.length) {
                fileNameLabel.textContent = this.files[0].name;
                dropzone.classList.remove('is-invalid');
                if (resumeError) resumeError.textContent = '';
            }
        });
    }

    if (resumeForm) {
        resumeForm.addEventListener('submit', function(e) {
            let valid = true;
            const allowedExt = ['pdf', 'docx', 'doc'];
            const maxSize = 1 * 1024 * 1024; // 1MB
            if (resumeError) resumeError.textContent = '';
            dropzone.classList.remove('is-invalid');

            if (!resumeInput.files || !resumeInput.files.length) {
                if (resumeError) resumeError.textContent = 'Please select a resume file.';
                dropzone.classList.add('is-invalid');
                valid = false;
            } else {
                const file = resumeInput.files[0];
                const ext = file.name.split('.').pop().toLowerCase();
                if (!allowedExt.includes(ext)) {
                    if (resumeError) resumeError.textContent = 'Only PDF, DOC or DOCX files are allowed.';
                    dropzone.classList.add('is-invalid');
                    valid = false;
                } else if (file.size > maxSize) {
                    if (resumeError) resumeError.textContent = 'File size must not exceed 1MB.';
                    dropzone.classList.add('is-invalid');
                    valid = false;
                }
            }

            if (!valid) e.preventDefault();
        });
    }

    // ---------- Toggle edit section ----------
    const editBtn = document.getElementById('editProfileBtn');
    const editSection = document.getElementById('editProfileSection');

    if (editBtn && editSection) {
        editBtn.addEventListener('click', function() {
            editSection.hidden = false;
            editSection.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        });
    }

    // ---------- Basic info form validation ----------
    const basicInfoForm = document.getElementById('basicInfoForm');
    if (basicInfoForm) {
        basicInfoForm.addEventListener('submit', function(e) {
            let valid = true;
            const nameInput = document.getElementById('modal_name');
            const emailInput = document.getElementById('modal_email');
            const phoneInput = document.getElementById('modal_phone');

            [nameInput, emailInput, phoneInput].forEach(clearFieldError);

            if (!nameInput.value.trim()) {
                showFieldError(nameInput, 'Name is required.');
                valid = false;
            } else if (nameInput.value.trim().length < 2) {
                showFieldError(nameInput, 'Name must be at least 2 characters.');
                valid = false;
            }

            if (!emailInput.value.trim()) {
                showFieldError(emailInput, 'Email is required.');
                valid = false;
            } else if (!isValidEmail(emailInput.value)) {
                showFieldError(emailInput, 'Enter a valid email address.');
                valid = false;
            }

            if (!phoneInput.value.trim()) {
                showFieldError(phoneInput, 'Phone number is required.');
                valid = false;
            } else if (!isValidPhone(phoneInput.value)) {
                showFieldError(phoneInput, 'Enter a valid phone number.');
                valid = false;
            }

            if (!valid) e.preventDefault();
        });
    }

    // ---------- Change password form validation ----------
    const changePasswordForm = document.getElementById('changePasswordForm');
    if (changePasswordForm) {
        changePasswordForm.addEventListener('submit', function(e) {
            let valid = true;
            const currentInput = document.getElementById('current_password');
            const newInput = document.getElementById('new_password');
            const confirmInput = document.getElementById('new_password_confirmation');
            const strongPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;

            [currentInput, newInput, confirmInput].forEach(clearFieldError);

            if (!currentInput.value) {
                showFieldError(currentInput, 'Current password is required.');
                valid = false;
            }

            if (!newInput.value) {
                showFieldError(newInput, 'New password is required.');
                valid = false;
            } else if (!strongPattern.test(newInput.value)) {
                showFieldError(newInput,
                    'Min 8 characters, with an uppercase letter, lowercase letter and a number.');
                valid = false;
            }

            if (!confirmInput.value) {
                showFieldError(confirmInput, 'Please confirm your new password.');
                valid = false;
            } else if (newInput.value && confirmInput.value !== newInput.value) {
                showFieldError(confirmInput, 'Passwords do not match.');
                valid = false;
            }

            if (!valid) e.preventDefault();
        });
    }

    // ---------- Profile details form validation ----------
    // Validates any field marked "required" inside the role-specific
    // partials (profile.fields.*). Add `required` / `type="email"` /
    // `pattern="..."` to those inputs to plug them into this check.
    const profileDetailsForm = document.getElementById('profileDetailsForm');
    if (profileDetailsForm) {
        profileDetailsForm.addEventListener('submit', function(e) {
            let valid = true;
            let firstInvalid = null;

            profileDetailsForm.querySelectorAll('input, select, textarea').forEach(function(input) {
                const wrapper = input.closest('.form-group') || input.parentElement;
                let errorEl = wrapper.querySelector('.field-error');
                if (!errorEl) {
                    errorEl = document.createElement('span');
                    errorEl.className = 'field-error';
                    wrapper.appendChild(errorEl);
                }
                errorEl.textContent = '';
                input.classList.remove('is-invalid');

                if (input.hasAttribute('required') && !input.value.toString().trim()) {
                    errorEl.textContent = 'This field is required.';
                    input.classList.add('is-invalid');
                    valid = false;
                    firstInvalid = firstInvalid || input;
                    return;
                }

                if (input.type === 'email' && input.value.trim() && !isValidEmail(input.value)) {
                    errorEl.textContent = 'Enter a valid email address.';
                    input.classList.add('is-invalid');
                    valid = false;
                    firstInvalid = firstInvalid || input;
                    return;
                }

                if (input.pattern && input.value.trim()) {
                    const re = new RegExp('^(?:' + input.pattern + ')$');
                    if (!re.test(input.value.trim())) {
                        errorEl.textContent = input.title || 'Invalid value.';
                        input.classList.add('is-invalid');
                        valid = false;
                        firstInvalid = firstInvalid || input;
                    }
                }
            });

            if (!valid) {
                e.preventDefault();
                if (firstInvalid) {
                    firstInvalid.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }
            }
        });
    }

    // ---------- Basic info modal open/close ----------
    const editBasicInfoBtn = document.getElementById('editBasicInfoBtn');
    const basicInfoModalOverlay = document.getElementById('basicInfoModalOverlay');
    const basicInfoModalClose = document.getElementById('basicInfoModalClose');
    const basicInfoModalCancel = document.getElementById('basicInfoModalCancel');

    function openBasicInfoModal(e) {
        if (e) e.preventDefault();
        basicInfoModalOverlay.hidden = false;
    }

    function closeBasicInfoModal() {
        basicInfoModalOverlay.hidden = true;
    }

    if (editBasicInfoBtn && basicInfoModalOverlay) {
        editBasicInfoBtn.addEventListener('click', openBasicInfoModal);
        basicInfoModalClose.addEventListener('click', closeBasicInfoModal);
        basicInfoModalCancel.addEventListener('click', closeBasicInfoModal);

        basicInfoModalOverlay.addEventListener('click', function(e) {
            if (e.target === basicInfoModalOverlay) closeBasicInfoModal();
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !basicInfoModalOverlay.hidden) {
                closeBasicInfoModal();
            }
        });
    }

    // ---------- Change password modal open/close ----------
    const changePasswordBtn = document.getElementById('changePasswordBtn');
    const changePasswordModalOverlay = document.getElementById('changePasswordModalOverlay');
    const changePasswordModalClose = document.getElementById('changePasswordModalClose');
    const changePasswordModalCancel = document.getElementById('changePasswordModalCancel');

    function openChangePasswordModal(e) {
        if (e) e.preventDefault();
        changePasswordModalOverlay.hidden = false;
    }

    function closeChangePasswordModal() {
        changePasswordModalOverlay.hidden = true;
    }

    if (changePasswordBtn && changePasswordModalOverlay) {
        changePasswordBtn.addEventListener('click', openChangePasswordModal);
        changePasswordModalClose.addEventListener('click', closeChangePasswordModal);
        changePasswordModalCancel.addEventListener('click', closeChangePasswordModal);

        changePasswordModalOverlay.addEventListener('click', function(e) {
            if (e.target === changePasswordModalOverlay) closeChangePasswordModal();
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !changePasswordModalOverlay.hidden) {
                closeChangePasswordModal();
            }
        });
    }
});
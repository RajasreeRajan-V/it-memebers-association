<script>

document.addEventListener('DOMContentLoaded', function () {

    const form = document.querySelector('.jobpost-form');

    if (!form) {
        return;
    }


    /* =========================================================
       WIZARD ELEMENTS
    ========================================================= */

    const steps = Array.from(
        document.querySelectorAll('.job-wizard-step')
    );

    const progressItems = Array.from(
        document.querySelectorAll('.job-progress-item')
    );

    const progressLines = Array.from(
        document.querySelectorAll('.job-progress-line')
    );

    let currentStep = 1;

    const totalSteps = steps.length;


    /* =========================================================
       FORM ELEMENTS
    ========================================================= */

    const workModeField = document.getElementById('work_mode');

    const countryField = document.getElementById('country');
    const stateField = document.getElementById('state');
    const districtField = document.getElementById('district');
    const cityField = document.getElementById('city');

    const stateRequired = document.querySelector('.state-required');
    const districtRequired = document.querySelector('.district-required');
    const cityRequired = document.querySelector('.city-required');

    const locationPreview = document.getElementById('locationPreview');

    const titleField = document.getElementById('title');
    const descriptionField = document.getElementById('description');

    const titleCounter = document.getElementById('titleCounter');
    const descriptionCounter = document.getElementById('descriptionCounter');


    /* =========================================================
       SHOW WIZARD STEP
    ========================================================= */

    function showStep(stepNumber) {

        if (stepNumber < 1) {
            stepNumber = 1;
        }

        if (stepNumber > totalSteps) {
            stepNumber = totalSteps;
        }

        currentStep = stepNumber;


        /* Show correct step */
        steps.forEach(function (step) {

            const stepValue = Number(
                step.dataset.step
            );

            step.classList.toggle(
                'active',
                stepValue === currentStep
            );
        });


        /* Update progress */
        progressItems.forEach(function (item) {

            const itemStep = Number(
                item.dataset.step
            );

            item.classList.remove(
                'active',
                'completed'
            );

            if (itemStep === currentStep) {

                item.classList.add('active');

            } else if (itemStep < currentStep) {

                item.classList.add('completed');
            }
        });


        /* Update progress lines */
        progressLines.forEach(function (line, index) {

            line.classList.toggle(
                'completed',
                index < currentStep - 1
            );
        });


        updateNavigation();
        updateChecklist();
        updateLocationRequirements();
        updateLocationPreview();

        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }


    /* =========================================================
       NAVIGATION
    ========================================================= */

    function updateNavigation() {

        const nextButtons = document.querySelectorAll(
            '[data-next-step]'
        );

        const backButtons = document.querySelectorAll(
            '[data-prev-step]'
        );

        const publishButton = document.querySelector(
            '[data-publish-button]'
        );


        /* Hide all Next buttons */
        nextButtons.forEach(function (button) {
            button.style.display = 'none';
        });


        /* Hide all Back buttons */
        backButtons.forEach(function (button) {
            button.style.display = 'none';
        });


        /* Hide publish button */
        if (publishButton) {
            publishButton.style.display = 'none';
        }


        /* Current step -> next step */
        if (currentStep < totalSteps) {

            const nextButton = document.querySelector(
                `[data-next-step="${currentStep + 1}"]`
            );

            if (nextButton) {
                nextButton.style.display = 'inline-flex';
            }
        }


        /* Current step -> previous step */
        if (currentStep > 1) {

            const backButton = document.querySelector(
                `[data-prev-step="${currentStep - 1}"]`
            );

            if (backButton) {
                backButton.style.display = 'inline-flex';
            }
        }


        /* Final step -> publish */
        if (
            currentStep === totalSteps &&
            publishButton
        ) {
            publishButton.style.display = 'inline-flex';
        }
    }


    /* =========================================================
       VALIDATE ONE STEP
    ========================================================= */

    function validateStep(stepNumber) {

        const step = document.querySelector(
            `.job-wizard-step[data-step="${stepNumber}"]`
        );

        if (!step) {
            return true;
        }


        /* Step 3 has dynamic location rules */
        if (stepNumber === 3) {
            return validateLocationFields();
        }


        let valid = true;

        const requiredFields = step.querySelectorAll(
            '[required]'
        );


        requiredFields.forEach(function (field) {

            if (field.disabled) {
                return;
            }

            const value = String(
                field.value || ''
            ).trim();


            if (!value) {

                field.classList.add(
                    'job-invalid'
                );

                field.setAttribute(
                    'aria-invalid',
                    'true'
                );

                valid = false;

            } else {

                field.classList.remove(
                    'job-invalid'
                );

                field.removeAttribute(
                    'aria-invalid'
                );
            }
        });


        if (!valid) {

            const firstInvalid = step.querySelector(
                '.job-invalid'
            );

            if (firstInvalid) {
                firstInvalid.focus();
            }
        }


        return valid;
    }


    /* =========================================================
       VALIDATE CURRENT STEP
    ========================================================= */

    function validateCurrentStep() {
        return validateStep(currentStep);
    }


    /* =========================================================
       LOCATION REQUIREMENTS
    ========================================================= */

    function updateLocationRequirements() {

        if (!workModeField) {
            return;
        }

        const workMode = String(
            workModeField.value || ''
        ).toLowerCase();


        /* -----------------------------------------------------
           REMOTE
           All location fields optional
        ----------------------------------------------------- */

        if (workMode === 'remote') {

            if (countryField) {
                countryField.required = false;
            }

            if (stateField) {
                stateField.required = false;
            }

            if (districtField) {
                districtField.required = false;
            }

            if (cityField) {
                cityField.required = false;
            }


            if (stateRequired) {
                stateRequired.style.display = 'none';
            }

            if (districtRequired) {
                districtRequired.style.display = 'none';
            }

            if (cityRequired) {
                cityRequired.style.display = 'none';
            }


            if (stateField) {
                stateField.placeholder = 'Optional';
            }

            if (districtField) {
                districtField.placeholder = 'Optional';
            }

            if (cityField) {
                cityField.placeholder = 'Optional';
            }


            return;
        }


        /* -----------------------------------------------------
           HYBRID / ON-SITE
           Country optional
           State required
           District required
           City required
        ----------------------------------------------------- */

        if (countryField) {
            countryField.required = false;
        }

        if (stateField) {
            stateField.required = true;
        }

        if (districtField) {
            districtField.required = true;
        }

        if (cityField) {
            cityField.required = true;
        }


        if (stateRequired) {
            stateRequired.style.display = 'inline';
        }

        if (districtRequired) {
            districtRequired.style.display = 'inline';
        }

        if (cityRequired) {
            cityRequired.style.display = 'inline';
        }


        if (stateField) {
            stateField.placeholder = 'e.g. Kerala';
        }

        if (districtField) {
            districtField.placeholder = 'e.g. Kasaragod';
        }

        if (cityField) {
            cityField.placeholder = 'e.g. Kanhangad';
        }
    }


    /* =========================================================
       LOCATION VALIDATION
    ========================================================= */

    function validateLocationFields() {

        if (!workModeField) {
            return true;
        }


        const workMode = String(
            workModeField.value || ''
        ).toLowerCase();


        /*
         * Country is always optional.
         */
        if (countryField) {

            countryField.classList.remove(
                'job-invalid'
            );

            countryField.removeAttribute(
                'aria-invalid'
            );
        }


        /*
         * Remote:
         * State, District and City are also optional.
         */
        if (workMode === 'remote') {

            [
                stateField,
                districtField,
                cityField
            ].forEach(function (field) {

                if (!field) {
                    return;
                }

                field.classList.remove(
                    'job-invalid'
                );

                field.removeAttribute(
                    'aria-invalid'
                );
            });


            return true;
        }


        /*
         * Hybrid / On-site:
         * State, District and City are required.
         */

        const requiredLocationFields = [
            stateField,
            districtField,
            cityField
        ];

        let valid = true;


        requiredLocationFields.forEach(function (field) {

            if (!field) {
                return;
            }

            const value = String(
                field.value || ''
            ).trim();


            if (!value) {

                field.classList.add(
                    'job-invalid'
                );

                field.setAttribute(
                    'aria-invalid',
                    'true'
                );

                valid = false;

            } else {

                field.classList.remove(
                    'job-invalid'
                );

                field.removeAttribute(
                    'aria-invalid'
                );
            }
        });


        if (!valid) {

            const firstInvalid = document.querySelector(
                '.job-wizard-step[data-step="3"] .job-invalid'
            );

            if (firstInvalid) {
                firstInvalid.focus();
            }
        }


        return valid;
    }


    /* =========================================================
       NEXT BUTTONS
    ========================================================= */

    document.querySelectorAll(
        '[data-next-step]'
    ).forEach(function (button) {

        button.addEventListener(
            'click',
            function () {

                const nextStep = Number(
                    button.dataset.nextStep
                );


                if (!validateCurrentStep()) {
                    return;
                }


                if (
                    nextStep >= 1 &&
                    nextStep <= totalSteps
                ) {
                    showStep(nextStep);
                }
            }
        );
    });


    /* =========================================================
       BACK BUTTONS
    ========================================================= */

    document.querySelectorAll(
        '[data-prev-step]'
    ).forEach(function (button) {

        button.addEventListener(
            'click',
            function () {

                const previousStep = Number(
                    button.dataset.prevStep
                );


                if (
                    previousStep >= 1 &&
                    previousStep <= totalSteps
                ) {
                    showStep(previousStep);
                }
            }
        );
    });


    /* =========================================================
       REMOVE INVALID STATE
    ========================================================= */

    form.querySelectorAll(
        'input, select, textarea'
    ).forEach(function (field) {

        field.addEventListener(
            'input',
            function () {

                if (
                    String(field.value || '').trim()
                ) {
                    field.classList.remove(
                        'job-invalid'
                    );

                    field.removeAttribute(
                        'aria-invalid'
                    );
                }

                updateChecklist();
                updateLocationPreview();
            }
        );


        field.addEventListener(
            'change',
            function () {

                field.classList.remove(
                    'job-invalid'
                );

                field.removeAttribute(
                    'aria-invalid'
                );

                updateChecklist();
                updateLocationRequirements();
                updateLocationPreview();
            }
        );
    });


    /* =========================================================
       TITLE COUNTER
    ========================================================= */

    function updateTitleCounter() {

        if (
            !titleField ||
            !titleCounter
        ) {
            return;
        }

        titleCounter.textContent =
            String(titleField.value || '').length;
    }


    /* =========================================================
       DESCRIPTION COUNTER
    ========================================================= */

    function updateDescriptionCounter() {

        if (
            !descriptionField ||
            !descriptionCounter
        ) {
            return;
        }

        descriptionCounter.textContent =
            String(descriptionField.value || '').length;
    }


    if (titleField) {

        titleField.addEventListener(
            'input',
            updateTitleCounter
        );
    }


    if (descriptionField) {

        descriptionField.addEventListener(
            'input',
            updateDescriptionCounter
        );
    }


    /* =========================================================
       LOCATION PREVIEW
    ========================================================= */

    function updateLocationPreview() {

        if (!locationPreview) {
            return;
        }


        const values = [];


        const country = countryField
            ? String(countryField.value || '').trim()
            : '';

        const state = stateField
            ? String(stateField.value || '').trim()
            : '';

        const district = districtField
            ? String(districtField.value || '').trim()
            : '';

        const city = cityField
            ? String(cityField.value || '').trim()
            : '';


        /*
         * Display from most specific location
         * to country.
         */
        if (city) {
            values.push(city);
        }

        if (district) {
            values.push(district);
        }

        if (state) {
            values.push(state);
        }

        if (country) {
            values.push(country);
        }


        if (values.length > 0) {

            locationPreview.textContent =
                values.join(', ');

        } else {

            locationPreview.textContent =
                'Location will appear here';
        }
    }


    /* =========================================================
       CHECKLIST
    ========================================================= */

    function updateChecklist() {

        const titleCheck =
            document.querySelector(
                '[data-check="title"]'
            );

        const employmentCheck =
            document.querySelector(
                '[data-check="employment"]'
            );

        const descriptionCheck =
            document.querySelector(
                '[data-check="description"]'
            );

        const locationCheck =
            document.querySelector(
                '[data-check="location"]'
            );


        /* Job title */
        if (titleCheck && titleField) {

            const valid =
                String(titleField.value || '').trim().length > 2;

            titleCheck.classList.toggle(
                'completed',
                valid
            );
        }


        /* Employment type */
        const employmentField =
            document.getElementById(
                'employment_type'
            );

        if (
            employmentCheck &&
            employmentField
        ) {

            employmentCheck.classList.toggle(
                'completed',
                Boolean(employmentField.value)
            );
        }


        /* Description */
        if (
            descriptionCheck &&
            descriptionField
        ) {

            const valid =
                String(descriptionField.value || '').trim().length > 20;

            descriptionCheck.classList.toggle(
                'completed',
                valid
            );
        }


        /* Location */
        if (locationCheck) {

            const workMode =
                workModeField
                    ? String(workModeField.value || '').toLowerCase()
                    : '';


            /*
             * Remote:
             * location requirement is automatically complete.
             */
            if (workMode === 'remote') {

                locationCheck.classList.add(
                    'completed'
                );

            } else {

                const state =
                    stateField
                        ? String(stateField.value || '').trim()
                        : '';

                const district =
                    districtField
                        ? String(districtField.value || '').trim()
                        : '';

                const city =
                    cityField
                        ? String(cityField.value || '').trim()
                        : '';


                const valid =
                    Boolean(
                        state &&
                        district &&
                        city
                    );


                locationCheck.classList.toggle(
                    'completed',
                    valid
                );
            }
        }
    }


    /* =========================================================
       FORM SUBMIT
    ========================================================= */

    let submitting = false;


    form.addEventListener(
        'submit',
        function (event) {

            /*
             * If user submits before final step,
             * move to next step instead.
             */
            if (currentStep < totalSteps) {

                event.preventDefault();


                if (validateCurrentStep()) {

                    showStep(
                        currentStep + 1
                    );
                }

                return;
            }


            /*
             * Final step:
             * validate location.
             */
            if (!validateCurrentStep()) {

                event.preventDefault();
                return;
            }


            /*
             * Prevent double submission.
             */
            if (submitting) {

                event.preventDefault();
                return;
            }


            submitting = true;


            const publishButton =
                document.querySelector(
                    '[data-publish-button]'
                );


            if (publishButton) {

                publishButton.disabled = true;

                const originalText =
                    publishButton.innerHTML;

                publishButton.dataset.originalText =
                    originalText;

                publishButton.innerHTML =
                    '<i class="bi bi-hourglass-split"></i> Saving...';
            }
        }
    );


    /* =========================================================
       FIND INITIAL STEP
       If validation errors exist, open the step
       containing the first error.
    ========================================================= */

    function getInitialStep() {

        const errorField =
            document.querySelector(
                '.job-wizard-step .job-field-error'
            );


        if (errorField) {

            const errorStep =
                errorField.closest(
                    '.job-wizard-step'
                );


            if (errorStep) {

                const stepNumber =
                    Number(
                        errorStep.dataset.step
                    );


                if (
                    stepNumber >= 1 &&
                    stepNumber <= totalSteps
                ) {
                    return stepNumber;
                }
            }
        }


        return 1;
    }


    /* =========================================================
       INITIALIZE
    ========================================================= */

    updateTitleCounter();
    updateDescriptionCounter();
    updateLocationRequirements();
    updateLocationPreview();
    updateChecklist();

    showStep(
        getInitialStep()
    );

});

</script>
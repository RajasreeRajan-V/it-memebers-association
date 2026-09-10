<script>

document.addEventListener('DOMContentLoaded', function () {

    const form = document.querySelector('.jobpost-form');

    if (!form) {
        return;
    }

    /* ============================================================
       WIZARD ELEMENTS
    ============================================================ */

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
    let submitting = false;


    /* ============================================================
       SHOW STEP
    ============================================================ */

    function showStep(stepNumber) {

        currentStep = stepNumber;

        /* Show only current section */

        steps.forEach(function (step) {

            const stepValue = Number(step.dataset.step);

            if (stepValue === stepNumber) {
                step.classList.add('active');
            } else {
                step.classList.remove('active');
            }

        });


        /* ========================================================
           UPDATE PROGRESS ITEMS
        ======================================================== */

        progressItems.forEach(function (item) {

            const itemStep = Number(item.dataset.progress);

            item.classList.remove('active');
            item.classList.remove('completed');

            if (itemStep === stepNumber) {
                item.classList.add('active');
            }

            if (itemStep < stepNumber) {
                item.classList.add('completed');
            }

        });


        /* ========================================================
           UPDATE PROGRESS LINES
        ======================================================== */

        progressLines.forEach(function (line) {

            const lineStep = Number(line.dataset.line);

            if (lineStep < stepNumber) {
                line.classList.add('completed');
            } else {
                line.classList.remove('completed');
            }

        });


        updateNavigation();

        updateChecklist();

        updateLocationPreview();


        /* Scroll to top */

        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });

    }


    /* ============================================================
       UPDATE NAVIGATION
    ============================================================ */

    function updateNavigation() {

        /* Hide all Next buttons */

        document.querySelectorAll('[data-next-step]').forEach(function (button) {
            button.style.display = 'none';
        });


        /* Hide all Back buttons */

        document.querySelectorAll('[data-prev-step]').forEach(function (button) {
            button.style.display = 'none';
        });


        /* Hide Publish */

        document.querySelectorAll('[data-publish-button]').forEach(function (button) {
            button.style.display = 'none';
        });


        /* ========================================================
           STEP 1
        ======================================================== */

        if (currentStep === 1) {

            const nextButton = document.querySelector(
                '[data-next-step="2"]'
            );

            if (nextButton) {
                nextButton.style.display = 'inline-flex';
            }

        }


        /* ========================================================
           STEP 2
        ======================================================== */

        if (currentStep === 2) {

            const backButton = document.querySelector(
                '[data-prev-step="2"]'
            );

            const nextButton = document.querySelector(
                '[data-next-step="3"]'
            );

            if (backButton) {
                backButton.style.display = 'inline-flex';
            }

            if (nextButton) {
                nextButton.style.display = 'inline-flex';
            }

        }


        /* ========================================================
           STEP 3
        ======================================================== */

        if (currentStep === 3) {

            const backButton = document.querySelector(
                '[data-prev-step="3"]'
            );

            const publishButton = document.querySelector(
                '[data-publish-button]'
            );

            if (backButton) {
                backButton.style.display = 'inline-flex';
            }

            if (publishButton) {
                publishButton.style.display = 'inline-flex';
            }

        }

    }


    /* ============================================================
       VALIDATE CURRENT STEP
    ============================================================ */

    function validateCurrentStep() {

        const currentPanel = document.querySelector(
            `.job-wizard-step[data-step="${currentStep}"]`
        );

        if (!currentPanel) {
            return true;
        }


        const fields = currentPanel.querySelectorAll(
            'input, select, textarea'
        );

        let valid = true;
        let firstInvalid = null;


        fields.forEach(function (field) {

            field.classList.remove('invalid');


            /* Only required fields */

            if (!field.required) {
                return;
            }


            if (!field.value.trim()) {

                field.classList.add('invalid');

                valid = false;

                if (!firstInvalid) {
                    firstInvalid = field;
                }

            }

        });


        if (firstInvalid) {

            firstInvalid.focus();

            firstInvalid.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });

        }


        return valid;

    }


    /* ============================================================
       NEXT BUTTONS
    ============================================================ */

    document.querySelectorAll('[data-next-step]').forEach(function (button) {

        button.addEventListener('click', function (event) {

            event.preventDefault();


            /*
             * Validate current step before moving.
             */

            if (!validateCurrentStep()) {
                return;
            }


            /*
             * data-next-step contains the TARGET step.
             *
             * Step 1 button -> data-next-step="2"
             * Step 2 button -> data-next-step="3"
             */

            const targetStep = Number(
                button.dataset.nextStep
            );


            if (
                targetStep >= 1 &&
                targetStep <= steps.length
            ) {

                showStep(targetStep);

            }

        });

    });


    /* ============================================================
       BACK BUTTONS
    ============================================================ */

    document.querySelectorAll('[data-prev-step]').forEach(function (button) {

        button.addEventListener('click', function (event) {

            event.preventDefault();


            const targetStep = Number(
                button.dataset.prevStep
            );


            if (
                targetStep >= 1 &&
                targetStep <= steps.length
            ) {

                showStep(targetStep);

            }

        });

    });


    /* ============================================================
       REMOVE INVALID STATE
    ============================================================ */

    form.querySelectorAll(
        'input, select, textarea'
    ).forEach(function (field) {

        field.addEventListener('input', function () {
            field.classList.remove('invalid');
            updateChecklist();
        });

        field.addEventListener('change', function () {
            field.classList.remove('invalid');
            updateChecklist();
        });

    });


    /* ============================================================
       TITLE COUNTER
    ============================================================ */

    const titleInput =
        document.getElementById('title');

    const titleCounter =
        document.getElementById('titleCounter');


    function updateTitleCounter() {

        if (!titleInput || !titleCounter) {
            return;
        }

        titleCounter.textContent =
            titleInput.value.length;

    }


    if (titleInput) {

        titleInput.addEventListener(
            'input',
            updateTitleCounter
        );

        updateTitleCounter();

    }


    /* ============================================================
       DESCRIPTION COUNTER
    ============================================================ */

    const descriptionInput =
        document.getElementById('description');

    const descriptionCounter =
        document.getElementById('descriptionCounter');


    function updateDescriptionCounter() {

        if (!descriptionInput || !descriptionCounter) {
            return;
        }

        descriptionCounter.textContent =
            descriptionInput.value.length;

    }


    if (descriptionInput) {

        descriptionInput.addEventListener(
            'input',
            updateDescriptionCounter
        );

        updateDescriptionCounter();

    }


    /* ============================================================
       LOCATION PREVIEW
    ============================================================ */

    const country =
        document.getElementById('country');

    const state =
        document.getElementById('state');

    const district =
        document.getElementById('district');

    const city =
        document.getElementById('city');

    const locationPreview =
        document.getElementById('locationPreview');


    function updateLocationPreview() {

        if (!locationPreview) {
            return;
        }


        const values = [

            city ? city.value.trim() : '',
            district ? district.value.trim() : '',
            state ? state.value.trim() : '',
            country ? country.value.trim() : ''

        ].filter(Boolean);


        if (values.length > 0) {

            locationPreview.textContent =
                values.join(', ');

        } else {

            locationPreview.textContent =
                'Enter the location details above.';

        }

    }


    [
        country,
        state,
        district,
        city
    ].forEach(function (field) {

        if (field) {

            field.addEventListener(
                'input',
                updateLocationPreview
            );

        }

    });


    /* ============================================================
       CHECKLIST
    ============================================================ */

    function updateChecklist() {

        const titleCheck =
            document.querySelector('[data-check="title"]');

        const typeCheck =
            document.querySelector('[data-check="type"]');

        const descriptionCheck =
            document.querySelector('[data-check="description"]');

        const locationCheck =
            document.querySelector('[data-check="location"]');


        /* Title */

        if (titleCheck) {

            const titleValid =
                titleInput &&
                titleInput.value.trim().length > 2;

            titleCheck.classList.toggle(
                'done',
                titleValid
            );

        }


        /* Employment Type */

        if (typeCheck) {

            const employmentType =
                document.getElementById('employment_type');

            const typeValid =
                employmentType &&
                employmentType.value !== '';

            typeCheck.classList.toggle(
                'done',
                typeValid
            );

        }


        /* Description */

        if (descriptionCheck) {

            const descriptionValid =
                descriptionInput &&
                descriptionInput.value.trim().length > 20;

            descriptionCheck.classList.toggle(
                'done',
                descriptionValid
            );

        }


        /* Location */

        if (locationCheck) {

            const locationValid =
                state &&
                district &&
                city &&
                state.value.trim() !== '' &&
                district.value.trim() !== '' &&
                city.value.trim() !== '';

            locationCheck.classList.toggle(
                'done',
                locationValid
            );

        }

    }


    /* ============================================================
       FORM SUBMIT
    ============================================================ */

    form.addEventListener('submit', function (event) {

        /*
         * If somehow submitted before Step 3,
         * don't submit the form.
         */

        if (currentStep !== 3) {

            event.preventDefault();

            if (validateCurrentStep()) {

                showStep(currentStep + 1);

            }

            return;

        }


        /*
         * Validate final step.
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
            form.querySelector('[data-publish-button]');


        if (publishButton) {

            publishButton.disabled = true;

            publishButton.innerHTML =
                '<i class="bi bi-arrow-repeat"></i> Publishing...';

        }

    });


    /* ============================================================
       START AT STEP 1
    ============================================================ */

    showStep(1);

});

</script>
<script>

document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('internshipForm');

    if (!form) {
        return;
    }


    /* =========================================================
       SUBMIT BUTTON
    ========================================================= */

    const submitBtn = document.getElementById('submitBtn');

    let submitted = false;


    form.addEventListener('submit', function (event) {

        /* Validate dates before submit */
        if (!validateDates()) {

            event.preventDefault();

            const endDate =
                document.getElementById('end_date');

            if (endDate) {
                endDate.focus();
            }

            return;
        }


        /* Prevent double submission */
        if (submitted) {

            event.preventDefault();

            return;
        }


        submitted = true;


        if (submitBtn) {

            submitBtn.innerHTML =
                '<i class="fas fa-spinner fa-spin"></i> Posting...';

            submitBtn.disabled = true;

        }

    });


    /* =========================================================
       TITLE FORMATTING
    ========================================================= */

    const titleInput =
        document.getElementById('title');


    if (titleInput) {

        titleInput.addEventListener('blur', function () {

            if (!this.value.trim()) {
                return;
            }


            this.value = this.value
                .toLowerCase()
                .replace(/\b\w/g, function (letter) {

                    return letter.toUpperCase();

                });

        });

    }


    /* =========================================================
       DATE VALIDATION
    ========================================================= */

    const startDate =
        document.getElementById('start_date');

    const endDate =
        document.getElementById('end_date');


    function validateDates() {

        if (!startDate || !endDate) {

            return true;

        }


        if (!startDate.value || !endDate.value) {

            endDate.classList.remove('is-invalid');

            removeDateFeedback();

            return true;

        }


        const start =
            new Date(startDate.value);

        const end =
            new Date(endDate.value);


        if (end <= start) {

            endDate.classList.add('is-invalid');


            let feedback =
                document.querySelector('.js-date-feedback');


            if (!feedback) {

                feedback =
                    document.createElement('div');

                feedback.className =
                    'invalid-feedback js-date-feedback';

                endDate
                    .closest('.form-group-custom')
                    .appendChild(feedback);

            }


            feedback.textContent =
                'End date must be after the start date.';


            return false;

        }


        endDate.classList.remove('is-invalid');

        removeDateFeedback();

        return true;

    }


    function removeDateFeedback() {

        const feedback =
            document.querySelector('.js-date-feedback');

        if (feedback) {

            feedback.remove();

        }

    }


    if (startDate) {

        startDate.addEventListener(
            'change',
            validateDates
        );

    }


    if (endDate) {

        endDate.addEventListener(
            'change',
            validateDates
        );

    }


    /* =========================================================
       CHARACTER FILTER
    ========================================================= */

    function attachFilter(
        id,
        pattern,
        message
    ) {

        const input =
            document.getElementById(id);


        if (!input) {

            return;

        }


        input.addEventListener('input', function () {

            const original =
                this.value;


            const filtered =
                original.replace(pattern, '');


            if (original !== filtered) {

                this.value =
                    filtered;


                this.classList.add(
                    'is-invalid'
                );


                const group =
                    this.closest(
                        '.form-group-custom'
                    );


                if (!group) {

                    return;

                }


                let feedback =
                    group.querySelector(
                        '.js-live-feedback'
                    );


                if (!feedback) {

                    feedback =
                        document.createElement(
                            'div'
                        );


                    feedback.className =
                        'invalid-feedback js-live-feedback';


                    group.appendChild(
                        feedback
                    );

                }


                feedback.textContent =
                    message;

            }

            else {

                this.classList.remove(
                    'is-invalid'
                );


                const group =
                    this.closest(
                        '.form-group-custom'
                    );


                if (group) {

                    const feedback =
                        group.querySelector(
                            '.js-live-feedback'
                        );


                    if (feedback) {

                        feedback.remove();

                    }

                }

            }

        });

    }


    /* =========================================================
       FIELD FILTERS
    ========================================================= */

    attachFilter(
        'title',
        /[^A-Za-z0-9\s&().,\-]/g,
        'Only letters, numbers, spaces and & ( ) . , - are allowed.'
    );


    attachFilter(
        'duration',
        /[^A-Za-z0-9\s\-]/g,
        'Only letters, numbers, spaces and - are allowed.'
    );


    attachFilter(
        'stipend',
        /[^0-9₹$,.\/\-\s]/g,
        'Only numbers and ₹ $ , . - / are allowed.'
    );


    attachFilter(
        'qualification',
        /[^A-Za-z0-9\s,.\-()&]/g,
        'Only letters, numbers and , . - ( ) & are allowed.'
    );


    attachFilter(
        'skills',
        /[^A-Za-z0-9\s,.\-+#\/]/g,
        'Only letters, numbers and , . - + # / are allowed.'
    );


    attachFilter(
        'country',
        /[^A-Za-z\s]/g,
        'Only letters and spaces are allowed.'
    );


    attachFilter(
        'state',
        /[^A-Za-z\s]/g,
        'Only letters and spaces are allowed.'
    );


    attachFilter(
        'district',
        /[^A-Za-z\s]/g,
        'Only letters and spaces are allowed.'
    );


    attachFilter(
        'city',
        /[^A-Za-z\s]/g,
        'Only letters and spaces are allowed.'
    );


    /* =========================================================
       CLEAR ERROR ON FOCUS
    ========================================================= */

    document
        .querySelectorAll('.form-control-custom')
        .forEach(function (input) {

            input.addEventListener(
                'focus',
                function () {

                    this.classList.remove(
                        'is-invalid'
                    );


                    const group =
                        this.closest(
                            '.form-group-custom'
                        );


                    if (group) {

                        const feedback =
                            group.querySelector(
                                '.js-live-feedback'
                            );


                        if (feedback) {

                            feedback.remove();

                        }

                    }

                }
            );

        });

});

</script>
<script>

document.addEventListener('DOMContentLoaded', function () {

    /* ============================================================
       FORM SUBMIT STATE
    ============================================================ */

    const form = document.querySelector('.sp-profile-form');
    const submitBtn = form
        ? form.querySelector('.sp-submit-btn')
        : null;

    if (form && submitBtn) {

        form.addEventListener('submit', function () {

            submitBtn.disabled = true;

            submitBtn.dataset.originalText = submitBtn.innerHTML;

            submitBtn.innerHTML = `
                <i class="bi bi-hourglass-split"></i>
                Submitting...
            `;

        });

    }


    /* ============================================================
       CLEAR INVALID STATE ON FOCUS
    ============================================================ */

    document.querySelectorAll(
        '.sp-form-field input, .sp-form-field textarea, .sp-form-field select'
    ).forEach(function (input) {

        input.addEventListener('focus', function () {

            this.classList.remove('is-invalid');

            const feedback =
                this.parentNode.querySelector('.js-live-feedback');

            if (feedback) {
                feedback.remove();
            }

        });

    });


    /* ============================================================
       SLUG AUTO GENERATION
    ============================================================ */

    const startupName = document.getElementById('startup_name');
    const slug = document.getElementById('slug');

    if (startupName && slug) {

        let slugManuallyChanged = false;

        slug.addEventListener('input', function () {
            slugManuallyChanged = true;
        });

        startupName.addEventListener('input', function () {

            if (slugManuallyChanged) {
                return;
            }

            let value = this.value
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');

            slug.value = value;

        });

    }


    /* ============================================================
       BASIC CHARACTER FILTERS
    ============================================================ */

    function attachFilter(id, pattern, message) {

        const input = document.getElementById(id);

        if (!input) {
            return;
        }

        input.addEventListener('input', function () {

            const original = this.value;

            const filtered = original.replace(pattern, '');

            if (original !== filtered) {

                this.value = filtered;

                this.classList.add('is-invalid');

                let feedback =
                    this.parentNode.querySelector('.js-live-feedback');

                if (!feedback) {

                    feedback = document.createElement('p');

                    feedback.className =
                        'sp-field-error js-live-feedback';

                    this.parentNode.appendChild(feedback);

                }

                feedback.textContent = message;

            } else {

                this.classList.remove('is-invalid');

                const feedback =
                    this.parentNode.querySelector('.js-live-feedback');

                if (feedback) {
                    feedback.remove();
                }

            }

        });

    }


    /* Startup Name */
    attachFilter(
        'startup_name',
        /[^A-Za-z0-9\s&().,\-]/g,
        'Only letters, numbers, spaces, &, (, ), ., , and - are allowed.'
    );


    /* Slug */
    attachFilter(
        'slug',
        /[^a-z0-9\-]/g,
        'Only lowercase letters, numbers and - are allowed.'
    );


    /* Tagline */
    attachFilter(
        'tagline',
        /[^A-Za-z0-9\s&().,/'-]/g,
        'Please use normal text characters only.'
    );


    /* Team Size */
    attachFilter(
        'team_size',
        /[^A-Za-z0-9\s+\-]/g,
        'Only letters, numbers, spaces, + and - are allowed.'
    );


    /* Location */
    attachFilter(
        'location',
        /[^A-Za-z0-9\s,.\-()&/]/g,
        'Please use a valid location.'
    );


    /* Startup Phone */
    attachFilter(
        'startup_phone',
        /[^0-9+\-\s()]/g,
        'Only numbers, +, -, spaces and brackets are allowed.'
    );


    /* Funding Requirement */
    attachFilter(
        'funding_requirement',
        /[^A-Za-z0-9₹$€£,\s.\-+/]/g,
        'Please enter a valid funding amount.'
    );


    /* ============================================================
       DELETE BUTTON
    ============================================================ */

    const deleteBtn =
        document.getElementById('spDeleteBtn');

    const deleteForm =
        document.getElementById('spDeleteForm');

    if (deleteBtn && deleteForm) {

        deleteBtn.addEventListener('click', function () {

            if (
                confirm(
                    'Delete this startup profile? This action cannot be undone.'
                )
            ) {

                deleteForm.submit();

            }

        });

    }


    /* ============================================================
       3-DOT MENU
    ============================================================ */

    const menus =
        document.querySelectorAll('.sp-menu');


    function closeOtherMenus(currentMenu) {

        menus.forEach(function (menu) {

            if (menu !== currentMenu) {

                menu.removeAttribute('open');

                const card =
                    menu.closest('.sp-summary-card');

                if (card) {
                    card.classList.remove('menu-active');
                }

            }

        });

    }


    menus.forEach(function (menu) {

        menu.addEventListener('toggle', function () {

            const card =
                menu.closest('.sp-summary-card');

            if (menu.open) {

                closeOtherMenus(menu);

                if (card) {
                    card.classList.add('menu-active');
                }

            } else {

                if (card) {
                    card.classList.remove('menu-active');
                }

            }

        });


        menu.addEventListener('click', function (event) {

            event.stopPropagation();

        });

    });


    document.addEventListener('click', function (event) {

        menus.forEach(function (menu) {

            if (!menu.contains(event.target)) {

                menu.removeAttribute('open');

                const card =
                    menu.closest('.sp-summary-card');

                if (card) {
                    card.classList.remove('menu-active');
                }

            }

        });

    });

});

</script>
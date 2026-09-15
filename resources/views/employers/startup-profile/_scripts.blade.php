<script>
document.addEventListener('DOMContentLoaded', function () {

    /* ============================================================
       FORM SUBMIT STATE
    ============================================================ */

    const form = document.querySelector('.sp-profile-form');
    const submitBtn = form ? form.querySelector('.sp-submit-btn') : null;

    if (form && submitBtn) {
        form.addEventListener('submit', function () {
            submitBtn.disabled = true;
            submitBtn.dataset.originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = 'Submitting...';
        });
    }

    /* ============================================================
       CLEAR INVALID STATE ON FOCUS
    ============================================================ */

    document.querySelectorAll('.sp-form-field input, .sp-form-field textarea').forEach(input => {
        input.addEventListener('focus', function () {
            this.classList.remove('is-invalid');
            const feedback = this.parentNode.querySelector('.js-live-feedback');
            if (feedback) feedback.remove();
        });
    });

    /* ============================================================
       LIVE CHARACTER FILTERING PER FIELD
    ============================================================ */

    function attachFilter(id, disallowedPattern, message) {
        const input = document.getElementById(id);
        if (!input) return;

        input.addEventListener('input', function () {
            const original = this.value;
            const filtered = original.replace(disallowedPattern, '');

            if (original !== filtered) {
                this.value = filtered;
                this.classList.add('is-invalid');

                let feedback = this.parentNode.querySelector('.js-live-feedback');
                if (!feedback) {
                    feedback = document.createElement('p');
                    feedback.className = 'sp-field-error js-live-feedback';
                    this.parentNode.insertBefore(feedback, this.nextSibling);
                }
                feedback.textContent = message;
            } else {
                this.classList.remove('is-invalid');
                const feedback = this.parentNode.querySelector('.js-live-feedback');
                if (feedback) feedback.remove();
            }
        });
    }

    attachFilter('startup_name',     /[^A-Za-z0-9\s\-&().,]/g,  'Only letters, numbers, and & ( ) . , - are allowed.');
    attachFilter('team_size',        /[^A-Za-z0-9\s-]/g,        'Only letters, numbers, and - are allowed.');
    attachFilter('industry',         /[^A-Za-z0-9\s\-&/,.]/g,   'Only letters, numbers, and - & / , . are allowed.');
    attachFilter('founder_name',     /[^A-Za-z\s]/g,            'Only letters are allowed.');
    attachFilter('funding_required', /[^0-9₹$,.\-\s/]/g,        'Only numbers and ₹ $ , . - / are allowed (no letters).');
    attachFilter('phone_number',     /[^0-9+\-\s]/g,            'Only numbers, +, -, and spaces are allowed (no letters).');
    attachFilter('country',          /[^A-Za-z\s]/g,            'Only letters are allowed.');
    attachFilter('state',            /[^A-Za-z\s]/g,            'Only letters are allowed.');
    attachFilter('district',         /[^A-Za-z\s]/g,            'Only letters are allowed.');
    attachFilter('city',             /[^A-Za-z\s]/g,            'Only letters are allowed.');


    /* ============================================================
       DELETE BUTTON (index summary card menu)
    ============================================================ */

    const deleteBtn = document.getElementById('spDeleteBtn');
    const deleteForm = document.getElementById('spDeleteForm');

    if (deleteBtn && deleteForm) {
        deleteBtn.addEventListener('click', function () {
            if (confirm('Delete this startup profile? This action cannot be undone.')) {
                deleteForm.submit();
            }
        });
    }


    /* ============================================================
       3-DOT MENU: CLOSE ON OUTSIDE CLICK / STOP PROPAGATION
    ============================================================ */

    const menus = document.querySelectorAll('.sp-menu');

    function closeOtherMenus(currentMenu) {
        menus.forEach(function (menu) {
            if (menu !== currentMenu) {
                menu.removeAttribute('open');
                const card = menu.closest('.sp-summary-card');
                if (card) card.classList.remove('menu-active');
            }
        });
    }

    menus.forEach(function (menu) {
        menu.addEventListener('toggle', function () {
            const card = menu.closest('.sp-summary-card');
            if (menu.open) {
                closeOtherMenus(menu);
                if (card) card.classList.add('menu-active');
            } else if (card) {
                card.classList.remove('menu-active');
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
                const card = menu.closest('.sp-summary-card');
                if (card) card.classList.remove('menu-active');
            }
        });
    });

});
</script>
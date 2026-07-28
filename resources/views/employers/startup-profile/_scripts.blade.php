<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form[action*="startup-profile"]');
    const submitBtn = form ? form.querySelector('button[type="submit"]') : null;

    if (form && submitBtn) {
        form.addEventListener('submit', function () {
            submitBtn.disabled = true;
            submitBtn.dataset.originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = 'Submitting...';
        });
    }

    // Clear invalid state on focus
    document.querySelectorAll('.sp-form-group input, .sp-form-group textarea').forEach(input => {
        input.addEventListener('focus', function () {
            this.classList.remove('is-invalid');
            const feedback = this.parentNode.querySelector('.js-live-feedback');
            if (feedback) feedback.remove();
        });
    });

    // Live character filtering per field
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
                    feedback = document.createElement('span');
                    feedback.className = 'sp-error js-live-feedback';
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
});
</script>
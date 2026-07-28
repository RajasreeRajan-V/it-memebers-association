<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('.jobpost-form');
    const submitBtn = form.querySelector('button[type="submit"]');

    // Show spinner on submit
    form.addEventListener('submit', function () {
        submitBtn.disabled = true;
        submitBtn.dataset.originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';
    });

    // Clear invalid state on focus
    document.querySelectorAll('.form-control-custom, .jobpost-form input, .jobpost-form textarea, .jobpost-form select').forEach(input => {
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
                    feedback = document.createElement('div');
                    feedback.className = 'invalid-feedback js-live-feedback';
                    feedback.style.display = 'block';
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

    attachFilter('title',         /[^A-Za-z0-9\s\-&().,]/g, 'Only letters, numbers, and & ( ) . , - are allowed.');
    attachFilter('experience',    /[^A-Za-z0-9\s-]/g,       'Only letters, numbers, and - are allowed.');
    attachFilter('salary',        /[^0-9₹$,.\-\s/]/g,       'Only numbers and ₹ $ , . - / are allowed (no letters).');
    attachFilter('qualification', /[^A-Za-z0-9\s,.\-()&]/g, 'Only letters, numbers, and , . - ( ) & are allowed.');
    attachFilter('skills',        /[^A-Za-z0-9\s,.\-+#/]/g, 'Only letters, numbers, and , . - + # / are allowed.');
    attachFilter('country',       /[^A-Za-z\s]/g,           'Only letters are allowed.');
    attachFilter('state',         /[^A-Za-z\s]/g,           'Only letters are allowed.');
    attachFilter('district',      /[^A-Za-z\s]/g,           'Only letters are allowed.');
    attachFilter('city',          /[^A-Za-z\s]/g,           'Only letters are allowed.');
});
</script>
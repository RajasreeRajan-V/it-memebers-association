@php
    $hasLocationErrors = $errors->hasAny(['country', 'state', 'district', 'city']);
@endphp

<script>
document.addEventListener('DOMContentLoaded', function () {
    // --- Work mode / location toggle ---
    const workMode = document.getElementById('work_mode');
    const locationFields = document.getElementById('locationFields');
    const hasLocationErrors = {{ $hasLocationErrors ? 'true' : 'false' }};

    function toggleLocation() {
        if (workMode.value === 'onsite' || workMode.value === 'hybrid' || hasLocationErrors) {
            locationFields.style.display = 'block';
        } else {
            locationFields.style.display = 'none';
        }
    }

    workMode.addEventListener('change', toggleLocation);
    toggleLocation();

    // --- Clear invalid state on focus ---
    document.querySelectorAll('.form-control-custom').forEach(input => {
        input.addEventListener('focus', function () {
            this.classList.remove('is-invalid');
            const feedback = this.parentNode.querySelector('.js-live-feedback');
            if (feedback) feedback.remove();
        });
    });

    // --- Live character filtering per field ---
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

    attachFilter('title',    /[^A-Za-z0-9\s\-&().,]/g, 'Only letters, numbers, and & ( ) . , - are allowed.');
    attachFilter('budget',   /[^0-9₹$,.\-\s/]/g,       'Only numbers and ₹ $ , . - / are allowed (no letters).');
    attachFilter('duration', /[^A-Za-z0-9\s-]/g,       'Only letters, numbers, and - are allowed.');
    attachFilter('skills',   /[^A-Za-z0-9\s,.\-+#/]/g, 'Only letters, numbers, and , . - + # / are allowed.');
    attachFilter('country',  /[^A-Za-z\s]/g,           'Only letters are allowed.');
    attachFilter('state',    /[^A-Za-z\s]/g,           'Only letters are allowed.');
    attachFilter('district', /[^A-Za-z\s]/g,           'Only letters are allowed.');
    attachFilter('city',     /[^A-Za-z\s]/g,           'Only letters are allowed.');
});


document.addEventListener('DOMContentLoaded', function () {

    const workMode = document.getElementById('work_mode');
    const locationFields = document.getElementById('locationFields');

    function toggleLocation() {
        if (workMode.value === 'onsite' || workMode.value === 'hybrid') {
            locationFields.style.display = 'block';
        } else {
            locationFields.style.display = 'none';
        }
    }

    toggleLocation();

    workMode.addEventListener('change', toggleLocation);

});
</script>
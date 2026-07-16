<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('internshipForm');
        const submitBtn = form.querySelector('button[type="submit"]');

        form.addEventListener('submit', function() {
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';
            submitBtn.disabled = true;
        });

        const titleInput = document.getElementById('title');
        titleInput.addEventListener('blur', function() {
            if (this.value) {
                this.value = this.value.replace(/\w\S*/g, function(txt) {
                    return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
                });
            }
        });

        const startDate = document.getElementById('start_date');
        const endDate = document.getElementById('end_date');

        endDate.addEventListener('change', function() {
            if (startDate.value && this.value) {
                if (new Date(this.value) <= new Date(startDate.value)) {
                    this.classList.add('is-invalid');
                    alert('End date must be after start date');
                    this.value = '';
                } else {
                    this.classList.remove('is-invalid');
                }
            }
        });

        document.querySelectorAll('.form-control-custom').forEach(input => {
            input.addEventListener('focus', function() {
                this.classList.remove('is-invalid');
            });
        });
    });
</script>

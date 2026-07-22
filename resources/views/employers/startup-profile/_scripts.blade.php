
<script>
document.addEventListener('DOMContentLoaded', () => {
    const deleteBtn = document.getElementById('spDeleteBtn');
    const deleteForm = document.getElementById('spDeleteForm');
    if (deleteBtn && deleteForm) {
        deleteBtn.addEventListener('click', (e) => {
            e.preventDefault();
            if (confirm('Delete your startup profile? This cannot be undone.')) {
                deleteForm.submit();
            }
        });
    }
});
</script>

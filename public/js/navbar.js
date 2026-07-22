document.addEventListener('DOMContentLoaded', function () {
    // Toggle mobile nav
    const navToggle = document.getElementById('navToggle');
    const mainNav = document.querySelector('.main-nav');
    if (navToggle && mainNav) {
        navToggle.addEventListener('click', function () {
            const expanded = this.getAttribute('aria-expanded') === 'true' ? false : true;
            this.setAttribute('aria-expanded', expanded);
            mainNav.classList.toggle('open');
        });
    }

    // Account dropdown
    // Account dropdown
    const accountBtn = document.getElementById('accountBtn');
    const accountDropdown = document.getElementById('accountDropdown');

    if (accountBtn && accountDropdown) {

        accountBtn.addEventListener('click', function (e) {
            console.log("Button clicked");
            e.stopPropagation();

            console.log("Before:", accountDropdown.className);

            accountDropdown.classList.toggle('show');

            console.log("After Toggle:", accountDropdown.className);

            setTimeout(() => {
                console.log("After 100ms:", accountDropdown.className);
            }, 100);

            console.log("Dropdown visible:", accountDropdown.classList.contains('show'));
        });

        document.addEventListener('click', function (e) {
            console.log("Document click:", e.target);

            if (!accountBtn.contains(e.target) && !accountDropdown.contains(e.target)) {
                console.log("Closing dropdown");
                accountDropdown.classList.remove('show');
            }
        });

    }
});
document.addEventListener('DOMContentLoaded', function () {

    // JS for the hamburger menu
    const toggleBtn = document.getElementById('menu-toggle');
    const navMenu = document.getElementById('primary-menu');

    if (toggleBtn && navMenu) {
        toggleBtn.addEventListener('click', function (e) {
            e.preventDefault();
            const isOpen = navMenu.classList.toggle('is-open');
            toggleBtn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            toggleBtn.setAttribute('aria-label', isOpen ? 'Close main menu' : 'Open main menu');
        });

    }

});
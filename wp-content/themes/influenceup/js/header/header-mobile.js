/**
 * File header-mobile.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.querySelector('.mobile-menu-toggle');
    const mobileMenu = document.querySelector('#mobile-menu');

    menuToggle.addEventListener('click', function() {
        mobileMenu.classList.toggle('active');
    });
    // Submeniu aktyvavimas
    const menuParentItems = document.querySelectorAll('.menu-parent-item');
    menuParentItems.forEach(function (menuItem) {
        menuItem.addEventListener('click', function(event) {
            event.preventDefault(); // Sustabdo nuorodos veikimą
            const subMenu = menuItem.querySelector('.sub-menu');
            if (subMenu) {
                subMenu.classList.toggle('active');
                menuItem.classList.toggle('active');
            }
        });
    });
});



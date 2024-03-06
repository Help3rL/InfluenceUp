/**
 * File header-mobile.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.querySelector('.mobile-menu-toggle');
    const mobileMenu = document.querySelector('#mobile-menu');
    const menuIcon = document.querySelector('#menu-icon');
    const closeIcon = document.querySelector('#close-icon');

    menuToggle.addEventListener('click', function() {
        mobileMenu.classList.toggle('active');

        // Patikriname ar meniu yra aktyvu
        if(mobileMenu.classList.contains('active')){
            menuIcon.style.display = 'none'; // Paslepiame meniu ikoną
            closeIcon.style.display = 'block'; // Rodome X ikoną
        }else{
            menuIcon.style.display = 'block'; // Rodome meniu ikoną
            closeIcon.style.display = 'none'; // Paslepiame X ikoną
        }
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



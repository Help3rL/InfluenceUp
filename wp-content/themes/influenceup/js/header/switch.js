/**
 * File switch.js.
 *
 * Switching light theme, dark theme
 * 
 */

document.addEventListener('DOMContentLoaded', function () {
    const desktopCheckbox = document.getElementById('desktop-checkbox');
    const mobileCheckbox = document.getElementById('mobile-checkbox');

    const sunIcon = document.querySelector('.sun-icon');
    const moonIcon = document.querySelector('.moon-icon');

    function toggleIcons(theme) {
        if(theme === 'dark') {
            sunIcon.style.display = 'none';
            moonIcon.style.display = 'block';
        } else {
            sunIcon.style.display = 'block';
            moonIcon.style.display = 'none';
        }
    }

    const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
    toggleIcons(currentTheme);

    desktopCheckbox.addEventListener('change', function() {
        if(this.checked) {
            // On dark theme
            document.documentElement.setAttribute('data-theme', 'dark');
            toggleIcons('dark');
        } else {
            // On light theme
            document.documentElement.setAttribute('data-theme', 'light');
            toggleIcons('light');
        }
    });

    mobileCheckbox.addEventListener('change', function() {
        if(this.checked) {
            // On dark theme
            document.documentElement.setAttribute('data-theme', 'dark');
            toggleIcons('dark');
        } else {
            // On light theme
            document.documentElement.setAttribute('data-theme', 'light');
            toggleIcons('light');
        }
    });
});





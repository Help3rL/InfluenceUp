/**
 * File header.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
document.addEventListener('DOMContentLoaded', function() {
    var templateUri = influenceup.templateUrl;
    var menuItems = document.querySelectorAll('.menu-item');

    menuItems.forEach(function(menuItem) {
        menuItem.addEventListener('mouseover', function() {
            var navArrow = this.querySelector('.nav-arrow');
            if(navArrow) {
                navArrow.style.backgroundImage = "url('" + templateUri + "/up.svg')";
            }
        });

        menuItem.addEventListener('mouseout', function() {
            var navArrow = this.querySelector('.nav-arrow');
            if(navArrow) {
                navArrow.style.backgroundImage = "url('" + templateUri + "/down.svg')";
            }
        });
    });
});


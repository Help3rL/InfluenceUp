/**
 * File header-mobile.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
document.addEventListener("DOMContentLoaded", function () {
  const menuToggle = document.querySelector(".mobile-menu-toggle");
  const mobileMenu = document.querySelector("#mobile-menu");
  const menuIcon = document.querySelector("#menu-icon");
  const closeIcon = document.querySelector("#close-icon");

  menuToggle.addEventListener("click", function () {
    mobileMenu.classList.toggle("active");

    if (mobileMenu.classList.contains("active")) {
      menuIcon.style.display = "none";
      closeIcon.style.display = "block";
    } else {
      menuIcon.style.display = "block";
      closeIcon.style.display = "none";
    }
  });

  const menuParentItems = document.querySelectorAll(".menu-parent-item");
  menuParentItems.forEach(function (menuItem) {
    menuItem.addEventListener("click", function (event) {
      if (
        !event.target.closest("a") ||
        event.target.getAttribute("href") === "#"
      ) {
        const subMenu = menuItem.querySelector(".sub-menu");
        if (subMenu) {
          event.preventDefault();
          subMenu.classList.toggle("active");
          menuItem.classList.toggle("active");
        }
      }
    });
  });

  document.addEventListener(
    "click",
    function (event) {
      if (!event.target.closest(".menu-parent-item")) {
        const activeSubMenus = document.querySelectorAll(".sub-menu.active");
        activeSubMenus.forEach(function (subMenu) {
          subMenu.classList.remove("active");
          if (subMenu.parentNode.classList.contains("menu-parent-item")) {
            subMenu.parentNode.classList.remove("active");
          }
        });
      }
    },
    true
  );
});

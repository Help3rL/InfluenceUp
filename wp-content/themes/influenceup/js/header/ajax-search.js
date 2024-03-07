/**
 * File ajax-search.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */

jQuery(document).ready(function ($) {
  // Hide search results width
  $("#search-results, #mobile-search-results").hide();

  function handleSearch(inputSelector, resultsSelector) {
    $(inputSelector).keyup(function () {
      var searchValue = $(this).val();
      if (searchValue) {
        $(this).addClass("loading");
        $.ajax({
          type: "POST",
          url: ajaxsearch.ajaxurl,
          data: {
            action: "data_fetch",
            keyword: searchValue,
            nonce: ajaxsearch.nonce,
          },
          success: function (response) {
            $(inputSelector).removeClass("loading");
            $(resultsSelector).show();
            if (
              response.trim() === "" ||
              response.trim() === "<p>Niekas nerasta.</p>"
            ) {
              $(resultsSelector).html("<p>Niekas nerasta.</p>");
            } else {
              $(resultsSelector).html(response);
            }
          },
        });
      } else {
        $(resultsSelector).html("").hide();
        $(inputSelector).removeClass("loading");
      }
    });
  }
  $(document).on("click", function (event) {
    if (!$(event.target).closest(".search-container").length) {
      $("#search-results, #mobile-search-results").hide();
    }
  });

  handleSearch("#search-input", "#search-results");
  handleSearch("#mobile-search-input", "#mobile-search-results");
});

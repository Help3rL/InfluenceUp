jQuery(document).ready(function ($) {
  $("#custom-filter-form").on("submit", function (e) {
    e.preventDefault();

    var formData = $(this).serialize();

    $.ajax({
      url: customFilter.ajax_url,
      type: "POST",
      data: formData + "&action=custom_filter",
      beforeSend: function () {
        // Parodyti loading animation arba žinutę, jei reikia
      },
      success: function (response) {
        $("#custom-filter-results").html(response);
      },
      error: function (xhr, status, error) {
        console.log("AJAX Error:", error);
      },
    });
  });

  $("#reset-filter").on("click", function (e) {
    e.preventDefault();
    $("#custom-filter-form")[0].reset();
    $("#custom-filter-results").empty();
  });
});

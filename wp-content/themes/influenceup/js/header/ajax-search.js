/**
 * File ajax-search.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */

jQuery(document).ready(function($) {
    // Paslėpti abu search-results divs pradžioje
    $("#search-results, #mobile-search-results").hide();

    // Sukurti funkciją, kuri apdoroja paiešką
    function handleSearch(inputSelector, resultsSelector) {
        $(inputSelector).keyup(function() {
            var searchValue = $(this).val();
            if (searchValue) {
                $(this).addClass('loading');
                $.ajax({
                    type: 'POST',
                    url: ajaxsearch.ajaxurl,
                    data: {
                        action: 'data_fetch',
                        keyword: searchValue,
                        nonce: ajaxsearch.nonce
                    },
                    success: function(response) {
                        $(inputSelector).removeClass('loading');
                        $(resultsSelector).show();
                        if (response.trim() === '' || response.trim() === '<p>Niekas nerasta.</p>') {
                            $(resultsSelector).html('<p>Niekas nerasta.</p>');
                        } else {
                            $(resultsSelector).html(response);
                        }
                    }
                });
            } else {
                $(resultsSelector).html('').hide();
                $(inputSelector).removeClass('loading');
            }
        });
    }

    // Įvykdyti paieškos funkciją abiem input laukams
    handleSearch("#search-input", "#search-results");
    handleSearch("#mobile-search-input", "#mobile-search-results");
});






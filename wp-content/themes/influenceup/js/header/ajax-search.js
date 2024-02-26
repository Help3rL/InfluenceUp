/**
 * File ajax-search.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */

jQuery(document).ready(function($){
    $('#search-input').keyup(function(){
        var searchValue = $(this).val();
        if(searchValue){
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
                    $("#search-input").removeClass('loading'); 
                    $("#search-results").html(response);
                    return false;
                }
            });
        } else {
            $("#search-results").html('');
            $(this).removeClass('loading'); 
        }
    });
});



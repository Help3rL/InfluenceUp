<?php
/**
 * @package ClassifiedListing/Templates
 * @version 1.5.4
 */

?>

<?php
/**
 * Hook: rtcl_before_listing_loop_item.
 *
 * @hooked rtcl_template_loop_product_link_open - 10
 */
do_action( 'rtcl_before_listing_loop_item' );

/**
 * Hook: rtcl_listing_loop_item.
 *
 * @hooked listing_thumbnail - 10
 */
do_action( 'rtcl_listing_loop_item_start' );


/**
 * Hook: rtcl_listing_loop_item.
 *
 * @hooked loop_item_wrap_start - 10
 * @hooked loop_item_listing_title - 20
 * @hooked loop_item_labels - 30
 * @hooked loop_item_listable_fields - 40
 * @hooked loop_item_meta - 50
 * @hooked loop_item_excerpt - 60
 * @hooked loop_item_wrap_end - 100
 */
do_action( 'rtcl_listing_loop_item' );


/**
 * Hook: rtcl_after_listing_loop_item.
 *
 * @hooked listing_loop_map_data - 50
 */
do_action( 'rtcl_after_listing_loop_item' );
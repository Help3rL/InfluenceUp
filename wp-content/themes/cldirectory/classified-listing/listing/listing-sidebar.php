<?php
/**
 * @author        RadiusTheme
 * @package       classified-listing/templates
 * @version       1.1.4
 */

use Rtcl\Helpers\Functions;
use radiustheme\CLDirectory\Helper;
use radiustheme\CLDirectory\RDTheme;
use RtclStore\Helpers\Functions as StoreFunctions;

global $listing;
$sidebar_position = Functions::get_option_item( 'rtcl_moderation_settings', 'detail_page_sidebar_position', 'right' );

$sidebar_class = [
	'col-lg-4 col-md-12 offset-lg-0',
	'order-2',
];
if ( $sidebar_position == "left" ) {
	$sidebar_class   = array_diff( $sidebar_class, [ 'order-2' ] );
	$sidebar_class[] = 'order-1';
} elseif ( $sidebar_position == "bottom" ) {
	$sidebar_class   = array_diff( $sidebar_class, [ 'col-lg-4 col-md-12 offset-lg-0 ' ] );
	$sidebar_class[] = 'rtcl-listing-bottom-sidebar';
}
$single_listing_style = Helper::listing_single_style();
?>

<!-- Seller / User Information -->
<div id="sticky_sidebar" class="<?php echo esc_attr( implode( ' ', $sidebar_class ) ); ?>">
    <div class="listing-sidebar">
		<?php
			if ( $listing->can_show_user() ) {
				if ( (RDTheme::$options['show_user_info_on_details'] === 'show_store_info') && class_exists('RtclStore')) {
					if(StoreFunctions::get_user_store($listing->get_owner_id())){
						$listing->the_user_info();
					}
					else{
						Helper::get_custom_listing_template( 'listing-content-info');
					}
					
				} else {
					Helper::get_custom_listing_template( 'listing-content-info' );
				}
			}
		?>
		<?php if ( $listing->can_show_price() && $single_listing_style !=2): ?>
			<div class="listing-price-wrap widget">
				<?php $max_price=get_post_meta( $listing->get_id(), '_rtcl_max_price', true ); 
					$price_type=$listing->get_pricing_type();
				?>
				<?php $widget_title=$max_price && $price_type=='range' ? __('Pricing Range','cldirectory') :__('Price','cldirectory'); ?>
				<h3 class="listing-entry-inner-title">
					<?php  echo esc_html( $widget_title ); ?>        
				</h3>
				
				<div class="listing-price"><span><?php esc_html_e('Start Price:','cldirectory'); ?></span><?php printf( "%s", $listing->get_price_html() ); ?></div>
				
			</div>
		<?php endif; ?>
		<?php do_action('rtcl_single_listing_business_hours'); ?>
		<?php 
			$email=get_post_meta($listing->get_id(),'email',true);
			$has_contact_form=Functions::get_option_item( 'rtcl_moderation_settings', 'has_contact_form', false, 'checkbox' ); 
		?>
		<?php if ( $email && $has_contact_form) : ?>
			<div class='rtcl-do-email'>
				<?php $listing->email_to_seller_form(); ?>
			</div>
		<?php endif; ?>
	    <?php do_action( 'rtcl_after_single_listing_sidebar', $listing->get_id() ); ?>
		<?php if ( is_active_sidebar( 'single-listing-sidebar' ) ): ?>
            <aside class="sidebar-widget">
				<?php dynamic_sidebar( 'single-listing-sidebar' ); ?>
            </aside>
		<?php endif; ?>
    </div>
</div>

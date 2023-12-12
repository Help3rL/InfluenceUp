<?php
/**
 * Template Name: Listing Map
 *
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\CLDirectory;

get_header();

$map_listing_per_page=RDTheme::$options['listing_map_per_page'] ? RDTheme::$options['listing_map_per_page']:'-1';
?>
    <div id="primary" class="listing-map-page">
        <div class="container-fluid ">
			<div class="custom-row">
				<div  id="sticky_sidebar" class="custom-column-one sidebar-widget">
					<div class="filter-form  rtStickySidebar">
						<div class="widget">
							<h3 class="widget-heading"><?php esc_html_e( 'Filter By', 'cldirectory' ); ?></h3>
							<?php do_action('cldirectory_listing_grid_search_filer' ); ?>
						</div>
					</div>
				</div>
				<div class="custom-column-two">
					<div class="cldirectory-listing-map-wrapper">
						<?php
						if ( get_the_content() ) {
							the_content();
						} else {
							echo do_shortcode( '[rtcl_listings map="1" paginate="true" limit="' . $map_listing_per_page . '"]' );
						}
						?>
					</div>
				</div>
			</div>
            
        </div>
    </div>
	<?php get_footer(); ?>
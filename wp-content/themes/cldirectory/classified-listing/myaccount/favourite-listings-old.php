<?php
/**
 *
 * @author     RadiusTheme
 * @package    classified-listing/templates
 * @version    1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use radiustheme\CLDirectory\Listing_Functions;
use Rtcl\Helpers\Pagination;
use Rtcl\Models\Listing;
use radiustheme\CLDirectory\Helper;

global $post;
?>

<div class="rtcl-favourite-listings rtcl  listing-grid">

	<?php if ( $rtcl_query->have_posts() ) : ?>
        <div class="rtcl-list-view rtcl-listings">
            <!-- the loop -->
			<?php while ( $rtcl_query->have_posts() ) : $rtcl_query->the_post();
				$post_meta    = get_post_meta( $post->ID );
				$listing      = new Listing( $post->ID );
				?>
                <div class="listing-item  rtcl-listing-item product-box">
                    <div class="listing-thumb">
                        <a href="<?php the_permalink(); ?>"><?php $listing->the_thumbnail(); ?></a>
                        <?php Helper::get_listing_category($listing); ?>
                    </div>
                    <div class="item-content">
                        <div class="item-top-content">
                            <?php
                                Helper::get_formated_business_hour($listing); 
                                $listing->the_badges();
                             ?>
                        </div>
						
                        <?php if ( $listing->can_show_price() ): ?>
                            <div class="listing-price"><?php printf( "%s", $listing->get_price_html() ); ?></div>
						<?php endif; ?>
                        <h3 class="listing-title rtcl-listing-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<?php $listing->the_meta(); ?>
                        <div class="rtcl-actions">
                            <a href="#" class="btn btn-danger btn-sm rtcl-delete-favourite-listing"
                               data-id="<?php echo esc_attr( $post->ID ) ?>"><?php _e( 'Remove from Favourites', 'cldirectory' ) ?></a>
                        </div>
                    </div>
                </div>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
            <!-- end of the loop -->
        </div>
        <!-- pagination here -->
		<?php Pagination::pagination( $rtcl_query ); ?>
	<?php else : ?>
        <p class="listing-archive-noresult"> <?php _e( 'No listing found.', 'cldirectory' ) ?></p>
	<?php endif; ?>

</div>
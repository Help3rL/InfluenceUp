<?php
/**
 *Manage Listing by user
 *
 * @var WP_Query $rtcl_query
 * @package       cldirectory/templates
 * @version       1.0.0
 *
 * @author        RadiusTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Rtcl\Helpers\Functions;
use Rtcl\Helpers\Link;
use Rtcl\Helpers\Pagination;
use radiustheme\CLDirectory\Helper;

global $post;
?>

<div class="rtcl  manage-listing product-grid">

    <!-- header here -->
    <div class="action-wrap mb-2 listing-search-wrapper">
        <div class="float-sm-left">
            <form action="<?php echo esc_url( Link::get_account_endpoint_url( "listings" ) ); ?>" class="form-inline">
                <label class="sr-only" for="search-ml"><?php esc_html_e( "Name", 'cldirectory' ) ?></label>
                <input type="text" id="search-ml" name="u" class="form-control mb-2 mr-sm-2"
                       placeholder="<?php esc_html_e( "Search by title", 'cldirectory' ); ?>"
                       value="<?php echo isset( $_GET['u'] ) ? esc_attr( wp_unslash( $_GET['u'] ) ) : ''; ?>">
                <button type="submit"
                        class="btn btn-primary mb-2"><?php esc_html_e( "Search", 'cldirectory' ); ?></button>
				<?php Functions::query_string_form_fields( null, [ 'submit', 'paged', 'u' ] ); ?>
            </form>
        </div>
        <div class="float-sm-right">
            <a href="<?php echo esc_url( Link::get_listing_form_page_link() ); ?>"
               class="btn btn-success"><?php esc_html_e( 'Add New Listing', 'cldirectory' ); ?></a>
        </div>
        <div class="clearfix"></div>
    </div>

	<div class="rtcl-my-listing-menu-wrapper">
		<?php do_action( 'rtcl_my_account_before_my_listing', $rtcl_query ); ?>
    </div>
	<?php if ( $rtcl_query->have_posts() ): ?>
        <div class="rtcl-list-view rtcl-listings">
            <!-- the loop -->
			<?php while ( $rtcl_query->have_posts() ) : $rtcl_query->the_post();
				$post_meta = get_post_meta( $post->ID );
				$listing   = rtcl()->factory->get_listing( $post->ID );
				?>
                <div class="listing-item rtcl-listing-item product-box">
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
                        <div class="listing-price">
                            <?php Functions::get_template( 'listing/loop/price' ); ?>
                        </div>
                        <div class="rtcl-listings-title-block">
                            <h3 class="listing-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        </div>

                        <div class="list-expires-wrap">
                            <p class="mb-0">
                                <strong><?php esc_html_e( 'Status', 'cldirectory' ); ?></strong>:
                                <?php echo Functions::get_status_i18n( $post->post_status ); ?>
                            </p>
                            <?php if ( $listing->get_status() !== 'pending' ) { ?>
                                <?php if ( get_post_meta( $listing->get_id(), 'never_expires', true ) ) : ?>
                                    <p class="rtcl-never-expired">
                                        <strong><?php esc_html_e( 'Expires on', 'cldirectory' ); ?></strong>:
                                        <?php esc_html_e( 'Never Expires', 'cldirectory' ); ?>
                                    </p>
                                <?php elseif ( $expiry_date = get_post_meta( $listing->get_id(), 'expiry_date', true ) ) : ?>
                                    <p class="rtcl-expired-on">
                                        <strong><?php esc_html_e( 'Expires on', 'cldirectory' ); ?></strong>:
                                        <?php echo date_i18n( get_option( 'date_format' ) . ' ' . get_option( 'time_format' ),
                                            strtotime( $expiry_date ) ); ?>
                                    </p>
                                <?php endif; ?>
                            <?php } ?>
                        </div>

                        <?php do_action( 'rtcl_listing_loop_extra_meta', $listing ); ?>
                        <div class="rtcl-actions">
                            <?php do_action( 'rtcl_my_listing_actions', $listing ); ?>
                        </div>
                    </div>
                    
                </div>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
            <!-- end of the loop -->
        </div>
        <!-- pagination here -->
		<?php Pagination::pagination( $rtcl_query ); ?>
	<?php else: ?>
        <p><?php esc_html_e( "No listing found.", 'cldirectory' ); ?></p>
	<?php endif; ?>

	<?php do_action( 'rtcl_my_account_after_my_listing', $rtcl_query ); ?>
</div>
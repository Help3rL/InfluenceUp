<?php
/**
 * Template Name: Blog Grid
 *
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\CLDirectory;

$post_class = Helper::has_sidebar() ? 'row-cols-md-2 row-cols-sm-1 row-cols-1' : 'row-cols-sm-3 row-cols-1';
$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
$args = [
	'posts_per_page' => get_option( 'posts_per_page' ),
	'post_type'      => 'post',
	'post_status'    => 'publish',
	'paged'          => $paged,
];
$query = new \WP_Query( $args );
get_header();
?>
    <main class="site-main content-area blog-grid blog-grid-inner content-area style2 blog-content rtcl-widget-border-enable rtcl-widget-is-sticky">
        <div class="container">
            <div class="row">
                <div class="<?php Helper::the_layout_class(); ?>">
                    <div class="main-post-content">
						<?php
						if ( $query->have_posts() ) :
							echo '<div class="row ' . $post_class . '">';
							while ( $query->have_posts() ) : $query->the_post();
								echo '<div class="col">';
								get_template_part( 'template-parts/content-grid' );
								echo '</div>';
								endwhile;
							echo '</div>';

						else:
							get_template_part( 'template-parts/content', 'none' );
						endif;
						?>
                    </div>
					<?php echo Helper::cldirectory_list_posts_pagination( $query ); ?>
                </div>
				<?php
				if ( Helper::has_sidebar() ) {
					get_sidebar();
				}
				?>
            </div>
        </div>
    </main>
<?php

get_footer();
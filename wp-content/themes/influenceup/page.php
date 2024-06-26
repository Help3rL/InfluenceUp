<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package InfluenceUp
 */

get_header();
?>

<svg id="animated-lines" style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; pointer-events: none; z-index: -1;"></svg>
<style>
  svg#animated-lines path, svg#animated-lines circle {
    stroke: #FAAF3C;
    fill: none;
  }
  svg#animated-lines circle {
    fill: #FAAF3C;
  }
</style>
<?php
// Patikrina, ar esame kategorijos puslapyje ar klasifikuotų skelbimų archyvo puslapyje
$is_listings_page = is_category() || is_post_type_archive('rtcl_listing') || is_tax('rtcl_category');
?>

	<main id="primary" class="site-main<?php echo $is_listings_page ? ' listings-page' : ''; ?>">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>
		<?php get_sidebar(); ?>
	</main><!-- #main -->

<?php
get_footer();

<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package InfluenceUp
 */

?>

<footer id="colophon" class="site-footer">
	<div class="footer-links">
		<a href="/">Team</a>
		<a href="/">Privacy</a>
		<a href="/">Terms</a>
	</div>
	<div class="footer-social-links">
		<a href="/">
			<img src="<?php echo get_template_directory_uri(); ?>/inc/img/icons/facebook-icon.svg" alt="facebook-icon">
		</a>
		<a href="/">
			<img src="<?php echo get_template_directory_uri(); ?>/inc/img/icons/x-icon.svg" alt="x-icon">
		</a>
		<a href="/">
			<img src="<?php echo get_template_directory_uri(); ?>/inc/img/icons/instagram-icon.svg" alt="instagram-icon">
		</a>
	</div>
	<div class="footer-copy-right">
		<p>© <?php echo do_shortcode('[year]'); ?>, Influence Up</p>
	</div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>
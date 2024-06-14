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
		<?php
		$team_link = get_field('team_link', 'option');
		$privacy_link = get_field('privacy_link', 'option');
		$terms_link = get_field('terms_link', 'option');
		?>
		<a href="<?php echo esc_url($team_link['team_url']); ?>"><?php echo esc_html($team_link['team_text']); ?></a>
		<a href="<?php echo esc_url($privacy_link['privacy_url']); ?>"><?php echo esc_html($privacy_link['privacy_title']); ?></a>
		<a href="<?php echo esc_url($terms_link['terms_url']); ?>"><?php echo esc_html($terms_link['terms_title']); ?></a>
	</div>
	<div class="footer-social-links">
		<a href="<?php echo get_field('facebook_url', 'option'); ?>">
			<img src="<?php echo get_template_directory_uri(); ?>/inc/img/icons/facebook-icon.svg" alt="facebook-icon">
		</a>
		<a href="<?php echo get_field('twitter_url', 'option'); ?>">
			<img src="<?php echo get_template_directory_uri(); ?>/inc/img/icons/x-icon.svg" alt="x-icon">
		</a>
		<a href="<?php echo get_field('intagram_url', 'option'); ?>">
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
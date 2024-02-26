<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package InfluenceUp
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'influenceup'); ?></a>

		<header id="masthead" class="site-header">
			<div class="header-container">
				<!-- Logo -->
				<div class="header-logo">
					<?php if (has_custom_logo()) : ?>
						<div class="site-logo">
							<?php the_custom_logo(); ?>
						</div>
					<?php endif; ?>
				</div>

				<!-- main meniu -->
				<nav id="site-navigation" class="main-navigation">
					<?php
					wp_nav_menu(array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
					));
					?>
				</nav>

				<!-- Search ir login button -->
				<div class="header-extra">
					<div class="search-container">
						<input type="search" id="search-input" placeholder="Search...">
						<div id="search-results"></div>
					</div>
					<a href="<?php echo wp_login_url(); ?>" class="login-button">Prisijungti</a>

					<div class="theme-switch-wrapper">
						<label class="theme-switch" for="checkbox">
							<input type="checkbox" id="checkbox" />
							<div class="slider round">
								<img src="<?php echo get_template_directory_uri(); ?>/inc/img/icons/sun.svg" class="icon sun-icon" alt="Light Theme" />
								<img src="<?php echo get_template_directory_uri(); ?>/inc/img/icons/moon.svg" class="icon moon-icon" alt="Dark Theme" />
							</div>
						</label>
					</div>
				</div>
			</div>
		</header><!-- #masthead -->
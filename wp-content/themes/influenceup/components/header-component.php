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

				
				<div class="header-extra">
					<div class="search-container">
					<div class="search-icon-wrapper">
						
						<img src="<?php echo get_template_directory_uri(); ?>/inc/img/icons/search.svg" alt="Light Theme" />
					</div>
						<input type="search" id="search-input" placeholder="Search...">
						<div id="search-results"></div>
					</div>
					<a href="<?php echo wp_login_url(); ?>" class="login-button">Prisijungti</a>

					<div class="theme-switch-wrapper">
						<label class="theme-switch" for="desktop-checkbox">
							<input type="checkbox" id="desktop-checkbox" />
							<div class="slider round">
								<img src="<?php echo get_template_directory_uri(); ?>/inc/img/icons/sun.svg" class="icon sun-icon" alt="Light Theme" />
								<img src="<?php echo get_template_directory_uri(); ?>/inc/img/icons/moon.svg" class="icon moon-icon" alt="Dark Theme" />
							</div>
						</label>
					</div>
				</div>
				
				<div class="mobile-menu-toggle">
					<span class="menu-toggle-icon">
					<img src="<?php echo get_template_directory_uri(); ?>/inc/img/icons/menu.svg" alt="Open Menu" id="menu-icon">
        			<img src="<?php echo get_template_directory_uri(); ?>/inc/img/icons/close-icon.svg" alt="Close Menu" id="close-icon" style="display: none;">
					</span>
				</div>

			</div>
			<!-- Mobile meniu -->
			<div id="mobile-menu" class="mobile-menu">
					<div class="search-container">
					<div class="search-icon-wrapper">
						
						<img src="<?php echo get_template_directory_uri(); ?>/inc/img/icons/search.svg" alt="Light Theme" />
					</div>
						<input type="search" id="mobile-search-input" placeholder="Search...">
						<div id="mobile-search-results"></div>
					</div>
				<nav class="mobile-navigation">
					<?php
					wp_nav_menu(array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
					));
					?>
				</nav>

				<div class="theme-switch-wrapper">
						<label class="theme-switch" for="mobile-checkbox">
							<input type="checkbox" id="mobile-checkbox" />
							<div class="slider round">
								<img src="<?php echo get_template_directory_uri(); ?>/inc/img/icons/sun.svg" class="icon sun-icon" alt="Light Theme" />
								<img src="<?php echo get_template_directory_uri(); ?>/inc/img/icons/moon.svg" class="icon moon-icon" alt="Dark Theme" />
							</div>
						</label>
						<a href="<?php echo wp_login_url(); ?>" class="login-button">Prisijungti</a>
					</div>
			</div>

		</header><!-- #masthead -->
<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\CLDirectory;

$header_container = 'container';
if ( 'fullwidth' == RDTheme::$header_width ) {
	$header_container = 'container-fluid';
}
$full_container=RDTheme::$header_width==='fullwidth' ? 'has-full-container':'no-full-container';
?>
<div id="rt-sticky-placeholder"></div>
<div id="header-menu" class="header-menu menu-layout1 <?php echo esc_attr( $full_container ); ?>">
    <div class="<?php echo esc_attr( $header_container ); ?>">
		<div class="menu-full-wrap">
			<div class="menu-left-area">
				<?php get_template_part( 'template-parts/header/site', 'logo' ) ?>
				<div class="menu-wrap">
					<div id="site-navigation" class="main-navigation">
						<?php wp_nav_menu( [
							'theme_location'  => 'primary',
							'container'       => 'nav',
						] ); ?>
					</div>
				</div>
			</div>
			<div class="menu-right-area">
				<?php 
					get_template_part( 'template-parts/header/listing', 'area' );
				?>
			</div>
		</div>
    </div>
</div>
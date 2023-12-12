<?php
/**
 * Plugin Name: Classified Listing – BuddyPress Integration
 * Plugin URI: https://radiustheme.com/
 * Description: Provides Classified Listing – BuddyPress Integration addons.
 * Author: RadiusTheme
 * Version: 1.0.4
 * Author URI: www.radiustheme.com
 * Text Domain: rtcl-buddypress
 * Domain Path: /languages
 *
 * @package  RadiusTheme\BP
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Defining Constants.
 */
define( 'RTCL_BP_VERSION', '1.0.4' );
define( 'RTCL_BP_FILE_NAME', __FILE__ );
define( 'RTCL_BP_URL', plugin_dir_url( __FILE__ ) );
define( 'RTCL_BP_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'RTCL_BP_LANGUAGE_PATH', RTCL_BP_DIR_PATH . 'languages' );

require_once __DIR__ . '/vendor/autoload.php';

register_activation_hook( __FILE__, 'activate_rtcl_bp' );

register_deactivation_hook( __FILE__, 'deactivate_rtcl_bp' );

/**
 * Plugin activation action.
 *
 * Plugin activation will not work after "plugins_loaded" hook
 * that's why activation hooks run here.
 */
function activate_rtcl_bp() {
	RadiusTheme\BP\Helpers\Installer::activate();
}

/**
 * Plugin deactivation action.
 *
 * Plugin deactivation will not work after "plugins_loaded" hook
 * that's why deactivation hooks run here.
 */
function deactivate_rtcl_bp() {
	RadiusTheme\BP\Helpers\Installer::deactivate();
}

/**
 * Returns RtclBP.
 *
 * @return RtclBP
 */
function RtclBP() {
	return RadiusTheme\BP\RtclBP::getInstance();
}
RtclBP();

<?php
/*
Plugin Name: CLDirectory Core
Plugin URI: https://www.radiustheme.com
Description: CLDirectory Theme Core Plugin
Version: 1.0
Author: RadiusTheme
Author URI: https://www.radiustheme.com
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use radiustheme\CLDirectory\Listing_Functions;
use Rtcl\Helpers\Functions;
use radiustheme\CLDirectory\RDTheme;

if ( ! defined( 'CLDIRECTORY_CORE' ) ) {
	$plugin_data = get_file_data( __FILE__, [ 'version' => 'Version' ] );
	define( 'CLDIRECTORY_CORE', $plugin_data['version'] );
	define( 'CLDIRECTORY_CORE_THEME_PREFIX', 'cldirectory' );
	define( 'CLDIRECTORY_CORE_BASE_URL', plugin_dir_url( __FILE__ ) );
	define( 'CLDIRECTORY_CORE_BASE_DIR', plugin_dir_path( __FILE__ ) );
}

require_once CLDIRECTORY_CORE_BASE_DIR . 'demo-users/user-importer.php';

class CLDirectory_Core {

	public $plugin = 'cldirectory-core';
	public $action = 'cldirectory_theme_init';
	protected static $instance;

	public function __construct() {
		add_action( 'plugins_loaded', [ $this, 'demo_importer' ], 17 );
		add_action( 'plugins_loaded', [ $this, 'load_textdomain' ], 20 );
		add_action( $this->action, [ $this, 'after_theme_loaded' ] );

		if ( isset( $_GET['export_user'] ) && $_GET['export_user'] == 1 ) {
			CLDirectory_Core_Demo_User_Import::export_users();
		}
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function after_theme_loaded() {
		require_once CLDIRECTORY_CORE_BASE_DIR . 'lib/sidebar-generator/init.php'; // Sidebar generator
		require_once CLDIRECTORY_CORE_BASE_DIR . 'lib/wp-svg/init.php'; // SVG support
		require_once CLDIRECTORY_CORE_BASE_DIR . 'inc/shortcode.php'; // Shortcode
		require_once CLDIRECTORY_CORE_BASE_DIR . 'inc/hooks.php'; // Hooks
		require_once CLDIRECTORY_CORE_BASE_DIR . 'widgets/rt-contact.php'; // Contact Widget
		require_once CLDIRECTORY_CORE_BASE_DIR . 'widgets/featured-post.php'; // Featured Post Widget
		require_once CLDIRECTORY_CORE_BASE_DIR . 'optimization/__init__.php'; 
        
		if ( defined( 'RT_FRAMEWORK_VERSION' ) ) {
			require_once CLDIRECTORY_CORE_BASE_DIR . 'inc/post-meta.php'; // Post Meta
			require_once CLDIRECTORY_CORE_BASE_DIR . 'widgets/init.php'; // Widgets
		}
		if ( did_action( 'elementor/loaded' ) ) {
			require_once CLDIRECTORY_CORE_BASE_DIR . 'elementor/init.php'; // Elementor
		}
	}
	public function demo_importer() {
		require_once CLDIRECTORY_CORE_BASE_DIR . 'inc/demo-importer.php';
	}
	
	public function load_textdomain() {
		load_plugin_textdomain( $this->plugin, false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}
	public static function social_share( $sharer = [] ) {
		include CLDIRECTORY_CORE_BASE_DIR . 'inc/social-share.php';
	}
}

CLDirectory_Core::instance();
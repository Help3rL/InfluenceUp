<?php
/**
 * Main initialization class.
 *
 * @package RadiusTheme\BP
 */

namespace RadiusTheme\BP;

use RadiusTheme\BP\Controllers\Ajax;
use RadiusTheme\BP\Controllers\Scripts;
use RadiusTheme\BP\Traits\SingletonTrait;
use RadiusTheme\BP\Controllers\Hooks\FilterHooks;
use RadiusTheme\BP\Controllers\Hooks\ActionsHooks;
use RadiusTheme\BP\Controllers\Admin\AdminNotices;

if ( ! class_exists( RtclBP::class ) ) {
	/**
	 * Main initialization class.
	 */
	final class RtclBP {
		/**
		 * Main Activity.
		 *
		 * @var string
		 */
		public $activity_type = 'new_rtcl_listing';
		/**
		 * Main Activity.
		 *
		 * @var string
		 */
		public $share_activity_type = 'share_new_rtcl_listing';
		/**
		 * Singleton Function.
		 */
		use SingletonTrait;
		/**
		 * Class init.
		 *
		 * @return void
		 */
		public function __init() {
			\add_action( 'plugins_loaded', [ $this, 'on_plugins_loaded' ] );
			\add_action( 'init', [ $this, 'init_hooks' ] );
		}

		/**
		 * Init services.
		 *
		 * @return void
		 */
		public function init_hooks() {
			$this->i18n();
		}

		/**
		 * Internationalization.
		 *
		 * @return void
		 */
		public function i18n() {
			load_plugin_textdomain( 'rtcl-buddypress', false, RTCL_BP_LANGUAGE_PATH );
		}
		/**
		 * Return plugin dir templates path.
		 *
		 * @return string
		 */
		public function get_plugin_template_path() {
			return untrailingslashit( RTCL_BP_DIR_PATH ) . '/templates/';
		}

		/**
		 * Actions on Plugins Loaded.
		 *
		 * @return void
		 */
		public function on_plugins_loaded() {
			$dependence = AdminNotices::getInstance();
			if ( $dependence->check() ) {
				FilterHooks::init();
				ActionsHooks::init();
				Ajax::getInstance();
				Scripts::getInstance();
			}
			\do_action( 'rtcl_bp_loaded', $this );
		}

		/**
		 * Assets URL.
		 *
		 * @param string $location file location.
		 * @return string
		 */
		public function assets_url( $location = '' ) {
			return esc_url( RTCL_BP_URL . 'assets/' . $location );
		}
	}

}

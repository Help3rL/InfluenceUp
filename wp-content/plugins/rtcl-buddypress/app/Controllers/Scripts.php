<?php
/**
 * Main Scripts Class
 *
 * The main class that initiates all scripts.
 *
 * @package RadiusTheme\BP
 * @since    1.0.0
 */

namespace RadiusTheme\BP\Controllers;

use RadiusTheme\BP\Traits\SingletonTrait;
/**
 * Main Scripts Class
 */
class Scripts {

	/**
	 * Singleton Function.
	 */
	use SingletonTrait;
	/**
	 * Suffix string.
	 *
	 * @var string
	 */
	private $suffix;
	/**
	 * Plugin Version.
	 *
	 * @var string
	 */
	private $version;
	/**
	 * Ajax Url
	 *
	 * @var string
	 */
	/**
	 * Initial Function.
	 *
	 * @return void
	 */
	public function __init() {
		$this->suffix  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
		$this->version = ( defined( 'WP_DEBUG' ) && WP_DEBUG ) ? time() : RTCL_BP_VERSION;
		add_action( 'wp_enqueue_scripts', [ $this, 'register_frontend_scripts' ] );
	}
	/**
	 * Admin related script.
	 *
	 * @return void
	 */
	public function register_frontend_scripts() {
		wp_register_style( 'rtcl-bp-public', RtclBP()->assets_url( 'css/rtcl-bp-public' . $this->suffix . '.css' ), [], $this->version );
		wp_register_script( 'rtcl-bp-public', RtclBP()->assets_url( 'js/rtcl-bp-public' . $this->suffix . '.js' ), [], $this->version, true );
		wp_localize_script(
			'rtcl-bp-public',
			'rtcl_bp',
			[
				'ajaxurl'       => admin_url( 'admin-ajax.php' ),
				'loading'       => esc_html__( 'Loading', 'rtcl-buddypress' ),
				rtcl()->nonceId => wp_create_nonce( rtcl()->nonceText ),
			]
		);
		wp_enqueue_style( 'rtcl-bp-public' );
		wp_enqueue_script( 'rtcl-bp-public' );
	}

}

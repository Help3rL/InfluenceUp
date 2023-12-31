<?php
/**
 * Install class.
 *
 * @package rtclBP
 */

namespace RadiusTheme\BP\Helpers;

/**
 * Install class.
 */
class Installer {
	/**
	 * Activation actions.
	 *
	 * @return void
	 */
	public static function activate() {
		\flush_rewrite_rules();
	}

	/**
	 * Deactivation actions.
	 *
	 * @return void
	 */
	public static function deactivate() {
		\flush_rewrite_rules();
	}
}

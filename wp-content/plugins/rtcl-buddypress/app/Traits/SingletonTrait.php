<?php


namespace RadiusTheme\BP\Traits;

trait SingletonTrait {

	/**
	 * Store the singleton object.
	 */
	private static $singleton = false;

	/**
	 * Create an inaccessible constructor.
	 */
	private function __construct() {
		$this->__init();
	}

	protected function __init() {
	}

	/**
	 * Fetch an instance of the class.
	 */
	final public static function getInstance() {
		if ( false === self::$singleton ) {
			self::$singleton = new self();
		}

		return self::$singleton;
	}

	/**
	 * Prevent cloning.
	 */
	final public function __clone() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'rtcl-buddypress' ), '1.0' );
	}

	/**
	 * Prevent unserializing.
	 */
	final public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'rtcl-buddypress' ), '1.0' );
	}
}

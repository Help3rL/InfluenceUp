<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\CLDirectory;

class TGM_Config {

	public $base;
	public $path;

	public function __construct() {
		$this->base = 'cldirectory';
		$this->path = Constants::$theme_plugins_dir;

		add_action( 'tgmpa_register', [ $this, 'register_required_plugins' ] );
	}

	public function register_required_plugins() {
		$plugins = [
			// Bundled
			[
				'name'     => 'CLDirectory Core',
				'slug'     => 'cldirectory-core',
				'source'   => 'cldirectory-core.zip',
				'required' => true,
				'version'  => '1.0',
			],
			[
				'name'     => 'RT Framework',
				'slug'     => 'rt-framework',
				'source'   => 'rt-framework.zip',
				'required' => true,
				'version'  => '2.9',
			],
			[
				'name'     => 'RT Demo Importer',
				'slug'     => 'rt-demo-importer',
				'source'   => 'rt-demo-importer.zip',
				'required' => false,
				'version'  => '6.0.0',
			],
			[
				'name'     => 'Classified Listing Pro',
				'slug'     => 'classified-listing-pro',
				'source'   => 'classified-listing-pro.2.2.1.zip',
				'required' => true,
				'version'  => '2.2.1',
			],
			[
				'name'     => 'Review Schema Pro',
				'slug'     => 'review-schema-pro',
				'source'   => 'review-schema-pro.1.1.4.zip',
				'required' => false,
				'version'  => '1.1.4',
			],
			[
				'name'     => 'Classified Listing – Classified ads & Business Directory Plugin',
				'slug'     => 'classified-listing',
				'required' => true,
			],

			// Repository
			[
				'name'     => 'Elementor Website Builder',
				'slug'     => 'elementor',
				'required' => true,
			],
			[
				'name'     => 'Review Schema',
				'slug'     => 'review-schema',
				'required' => false,
			],
			array(
				'name'     => 'WP Fluent Forms',
				'slug'     => 'fluentform',
				'required' => false,
			),
		];

		$config = [
			'id'           => $this->base,            // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => $this->path,              // Default absolute path to bundled plugins.
			'menu'         => $this->base . '-install-plugins', // Menu slug.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                    // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
		];

		tgmpa( $plugins, $config );
	}

}

new TGM_Config;
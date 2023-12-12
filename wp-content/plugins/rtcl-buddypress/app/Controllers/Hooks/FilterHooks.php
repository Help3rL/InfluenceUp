<?php
/**
 * Main FilterHooks Class
 *
 * The main class that filter the functionality.
 *
 * @since 1.0.0
 */

namespace RadiusTheme\BP\Controllers\Hooks;

use Rtcl\Helpers\Functions;
use RadiusTheme\BP\Helpers\Fns;
use Rtcl\Helpers\Link;

/**
 * FilterHooks class
 */
class FilterHooks {

	/**
	 * Initialize function.
	 *
	 * @return void
	 */
	public static function init() {
		add_filter( 'rtcl_licenses', [ __CLASS__, 'license' ], 15 );
		add_filter( 'rtcl_my_listings_args', [ __CLASS__, 'my_listings_args' ] );
		add_filter( 'rtcl_favourite_listings_args', [ __CLASS__, 'favourite_listings_args' ] );
		add_filter( 'rtcl_login_redirect_to', [ __CLASS__, 'login_redirect_to' ], 10, 2 );
		// New Listing Added activity.
		add_filter( 'bp_before_activity_add_parse_args', [ __CLASS__, 'record_cpt_listing_activity_content' ] );
		add_filter( 'rtcl_register_settings_tabs', [ __CLASS__, 'rtcl_register_settings_tabs' ], 15, 1 );
		add_filter( 'rtcl_settings_option_fields', [ __CLASS__, 'buddypress_settings_option_fields' ], 15, 2 );
		add_filter( 'rtcl_get_account_endpoint_url', [ __CLASS__, 'get_account_endpoint_url' ], 10, 2 );
		add_filter( 'body_class', [ __CLASS__, 'body_class' ] );
	}
	/**
	 * Body Class.
	 *
	 * @param [array] $classes settings object.
	 * @return array
	 */
	public static function body_class( $classes ) {
		if ( bp_is_current_component( 'listings' ) ) {
			$classes[] = 'rtcl';
		}
		return $classes;
	}
	/**
	 * License Field
	 *
	 * @param [array] $licenses settings object.
	 * @return array
	 */
	public static function license( $licenses ) {
		$licenses[] = [
			'plugin_file' => RTCL_BP_FILE_NAME,
			'api_data'    => [
				'key_name'    => 'license_rtclbp_key',
				'status_name' => 'license_rtclbp_status',
				'action_name' => 'rtclbp_manage_licensing',
				'product_id'  => 184404, // Original Number.
				'version'     => RTCL_BP_VERSION,
			],
			'settings'    => [
				'title' => esc_html__( 'BuddyPress Integration  plugin license key', 'rtcl-buddypress' ),
			],
		];
		return $licenses;
	}
	/**
	 * Query Argument.
	 *
	 * @param string $field Lists.
	 * @param string $active_tab tab name.
	 * @return array
	 */
	public static function buddypress_settings_option_fields( $field, $active_tab ) {
		if ( 'buddypress' === $active_tab ) {
			/**
			 * Settings for buddypress
			 */
			$field = [
				'post_listing_activity'            => [
					'title'       => esc_html__( 'Post listing in activity', 'rtcl-buddypress' ),
					'type'        => 'checkbox',
					'default'     => 'yes',
					'description' => esc_html__( 'Immediately will post listing in activity', 'rtcl-buddypress' ),
				],
				'listing_activity_default_content' => [
					'title'      => esc_html__( 'Listing activity default content', 'rtcl-buddypress' ),
					'type'       => 'textarea',
					'default'    => esc_html__( 'New Listing Publish', 'rtcl-buddypress' ),
					'css'        => 'max-width:400px; height: 150px;',
					'dependency' => [
						'rules' => [
							'#rtcl_buddypress_settings-post_listing_activity' => [
								'type'  => 'equal',
								'value' => 'yes',
							],
						],
					],
				],
				'activity_listing_view'            => [
					'title'   => esc_html__( 'Activity listing view', 'rtcl-buddypress' ),
					'type'    => 'select',
					'default' => 'list',
					'options' => [
						'grid' => esc_html__( 'Grid', 'rtcl-buddypress' ),
						'list' => esc_html__( 'List', 'rtcl-buddypress' ),
					],
				],
				'share_button_visibility'          => [
					'title'       => esc_html__( 'Activity Share', 'rtcl-buddypress' ),
					'type'        => 'checkbox',
					'default'     => 'yes',
					'description' => esc_html__( 'Listing Share as activity', 'rtcl-buddypress' ),
				],
				'social_share_visibility'          => [
					'title'       => esc_html__( 'Social Share', 'rtcl-buddypress' ),
					'type'        => 'checkbox',
					'default'     => 'yes',
					'description' => esc_html__( 'Listing Social Share', 'rtcl-buddypress' ),
					'dependency'  => [
						'rules' => [
							'#rtcl_buddypress_settings-share_button_visibility' => [
								'type'  => 'equal',
								'value' => 'yes',
							],
						],
					],
				],
				'login_redirect_bp_dashboard'      => [
					'title'       => esc_html__( 'Redirect To BuddyPress Profile dashboard', 'rtcl-buddypress' ),
					'type'        => 'checkbox',
					'default'     => 'yes',
					'description' => esc_html__( 'Clasified listing Myaccount Related URl will redirect To BuddyPress dashboard', 'rtcl-buddypress' ),
				],
			];
			$field = apply_filters( 'rtcl_buddypress_settings_options', $field );
		}
		return $field;
	}
	/**
	 * Query Argument.
	 *
	 * @param string $tabs Tab Lists.
	 * @return string
	 */
	public static function rtcl_register_settings_tabs( $tabs ) {
		$tabs['buddypress'] = esc_html__( 'BuddyPress', 'rtcl-buddypress' );
		return $tabs;
	}
	/**
	 * Query Argument.
	 *
	 * @param string $args Query Argument.
	 * @return string
	 */
	public static function my_listings_args( $args ) {
		$args['author'] = bp_displayed_user_id();
		return $args;
	}
	/**
	 * Query Argument.
	 *
	 * @param string $args Query Argument.
	 * @return string
	 */
	public static function favourite_listings_args( $args ) {
		$favourite_posts  = get_user_meta( bp_displayed_user_id(), 'rtcl_favourites', true );
		$args['post__in'] = ! empty( $favourite_posts ) ? $favourite_posts : [ 0 ];
		return $args;
	}

	/**
	 * Before activity fire this function.
	 *
	 * @param [type] $data Activitys data.
	 * @return array
	 */
	public static function record_cpt_listing_activity_content( $data ) {
		if ( RtclBP()->activity_type === $data['type'] ) {
			$content = Functions::get_option_item( 'rtcl_buddypress_settings', 'listing_activity_default_content', esc_html__( 'New Listing Publish', 'rtcl-buddypress' ) );
			if ( $content ) {
				$data['content'] = $content;
			} else {
				$data['content'] = ' '; // Must Need One speace.
			}
		}
		return $data;
	}

	/**
	 * Before activity fire this function.
	 *
	 * @param array  $redirect Template Location's List.
	 * @param object $user Template Location's List.
	 * @return string
	 */
	public static function login_redirect_to( $redirect, $user ) {
		$is_redirect = Functions::get_option_item( 'rtcl_buddypress_settings', 'login_redirect_bp_dashboard', true, 'checkbox' );
		if ( $is_redirect ) {
			$user_domain = bp_core_get_user_domain( $user->ID ) . 'profile';
			$redirect    = esc_url( $user_domain );
		}
		return $redirect;
	}

	/**
	 * Change endpoint url.
	 *
	 * @param string $url Profile Url.
	 * @param string $endpoint Profile endpoint url.
	 * @return string
	 */
	public static function get_account_endpoint_url( $url, $endpoint ) {
		$is_redirect = Functions::get_option_item( 'rtcl_buddypress_settings', 'login_redirect_bp_dashboard', true, 'checkbox' );

        if ( ! $is_redirect || ! is_user_logged_in() ) {
			return $url;
		}

		$current_user  = wp_get_current_user();
		$url_endpoint  = 'listings' === $endpoint ? '' : $endpoint;
		$function_name = 'user_' . str_replace( [ '-', ' ' ], '_', strtolower( $endpoint ) ) . '_screen_function';

		// Add subnav item 1.
		if ( method_exists( Fns::class, $function_name ) ) {
			$url = bp_core_get_user_domain( $current_user->ID ) . 'listings/' . $url_endpoint;
		} else {
			$url = bp_core_get_user_domain( $current_user->ID ) . 'listings/';
		}
		return $url;
	}





}

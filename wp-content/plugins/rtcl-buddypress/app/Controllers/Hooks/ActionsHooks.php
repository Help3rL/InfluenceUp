<?php
/**
 * ActionsHooks Class
 *
 * The main class that filter the functionality.
 *
 * @since 1.0.0
 */

namespace RadiusTheme\BP\Controllers\Hooks;

use BP_Activity_Activity;
use Rtcl\Helpers\Functions;
use RadiusTheme\BP\Helpers\Fns;
use RtclStore\Helpers\Functions as StoreFunctions;

/**
 * ActionsHooks class
 */
class ActionsHooks {
	/**
	 * Initialize function.
	 *
	 * @return void
	 */
	public static function init() {
		add_action( 'bp_init', [ __CLASS__, 'listings_tracking_args' ] );
		add_action( 'bp_setup_nav', [ __CLASS__, 'rtcl_bp_add_nav_item' ], 100 );
		add_action( 'bp_activity_add_user_favorite', [ __CLASS__, 'activity_add_listing_user_favorite' ], 10, 2 );
		add_action( 'bp_activity_remove_user_favorite', [ __CLASS__, 'activity_remove_listing_user_favorite' ], 10, 2 );
		add_action( 'rtcl_my_listing_actions_button_display', [ __CLASS__, 'is_current_user_displayed' ] );
		add_action( 'rtcl_favourite_listing_actions_button_display', [ __CLASS__, 'is_current_user_displayed' ] );
		add_action( 'rtcl_listing_form_after_save_or_update_responses', [ __CLASS__, 'listing_form_after_save_or_update_responses' ], 10, 1 );
		add_action( 'bp_activity_entry_meta', [ __CLASS__, 'bp_activity_share_button_render' ] );
		add_action( 'bp_activity_entry_content', [ __CLASS__, 'bp_activity_entry_content' ] );
		
	}
	/**
	 * Listing Content .
	 *
	 * @return void
	 */
	public static function bp_activity_entry_content() {
		if ( Fns::is_rtcl_listings_activity() ) {
			$view       = Functions::get_option_item( 'rtcl_buddyboss_settings', 'activity_listing_view', 'list' );
			$listing_id = bp_activity_get_meta( bp_get_activity_id(), 'rtcl_bp_share_activity_listing_id', true );
			if ( ! $listing_id ) {
				$listing_id = bp_get_activity_secondary_item_id();
			}
			$listing = false;
			if ( rtcl()->post_type === get_post_type( $listing_id ) ) {
				$listing = rtcl()->factory->get_listing( $listing_id );
			}
			$data = [
				'template'              => 'rtcl-activity-' . $view . '/activity-content-listings',
				'listing'               => $listing,
				'default_template_path' => RtclBP()->get_plugin_template_path(),
			];
			Functions::get_template( $data['template'], $data, '', $data['default_template_path'] );
		}
	}
	/**
	 * Nav Items
	 *
	 * @return void
	 */
	public static function rtcl_bp_add_nav_item() {
		$parent_slug = 'listings';
		$child_slug  = 'my-listings'; // Pagination support.
		// Add listings page in my profile menu item.
		bp_core_new_nav_item(
			[
				'name'                    => esc_html__( 'Listings', 'rtcl-buddypress' ),
				'slug'                    => $parent_slug,
				'default_subnav_slug'     => $child_slug,
				'screen_function'         => [ Fns::class, 'user_listings_screen_function' ],
				'show_for_displayed_user' => true,
				'position'                => 999,
			]
		);
		$rtcl_menu = Functions::get_account_menu_items();
		unset( $rtcl_menu['dashboard'] );
		unset( $rtcl_menu['logout'] );
		if ( class_exists( 'RtclStore' ) && StoreFunctions::is_membership_enabled() ) {
			$rtcl_menu['membership_statistic'] = esc_html__( 'Membership Report', 'rtcl-buddypress' );
		}
		if ( get_current_user_id() !== bp_displayed_user_id() ) {
			unset( $rtcl_menu['chat'] );
			unset( $rtcl_menu['payments'] );
			unset( $rtcl_menu['membership_statistic'] );
		}

		foreach ( $rtcl_menu as $endpoint => $label ) {
			$function_name = 'user_' . str_replace( [ '-', ' ' ], '_', strtolower( $endpoint ) ) . '_screen_function';
			// Add subnav item 1.
			if ( method_exists( Fns::class, $function_name ) ) {
				if ( 'listings' === $endpoint ) {
					$endpoint = $child_slug; // Pagination support.
				}
				bp_core_new_subnav_item(
					[
						'name'            => $label,
						'slug'            => $endpoint,
						'parent_url'      => bp_displayed_user_domain() . $parent_slug . '/',
						'parent_slug'     => $parent_slug,
						'screen_function' => [ Fns::class, $function_name ],
					]
				);
			}
		}

	}

	/**
	 * Before activity fire this function.
	 *
	 * @return void
	 */
	public static function listings_tracking_args() {
		// Check if the Activity component is active before using it.
		$is_share = Functions::get_option_item( 'rtcl_buddypress_settings', 'post_listing_activity', true, 'checkbox' );
		if ( ! bp_is_active( 'activity' ) || ! $is_share ) {
			return;
		}
		// Don't forget to add the 'buddypress-activity' support!
		add_post_type_support( rtcl()->post_type, 'buddypress-activity' );

		/**
		 * Set tracking arguments for a given post type.
		 */
		bp_activity_set_post_type_tracking_args(
			rtcl()->post_type,
			[
				// 'component_id'             => buddypress()->blogs->id,
				'action_id'                => RtclBP()->activity_type,
				'bp_activity_admin_filter' => __( 'New Listing published', 'rtcl-buddypress' ),
				'bp_activity_front_filter' => __( 'Listings', 'rtcl-buddypress' ),
				'bp_activity_new_post'     => __( '%1$s posted a new <a href="%2$s">Listing</a>', 'rtcl-buddypress' ),
				'bp_activity_new_post_ms'  => __( '%1$s posted a new <a href="%2$s">Listing</a>, on the site %3$s', 'rtcl-buddypress' ),
				'contexts'                 => [ 'activity', 'member' ],
				'activity_comment'         => true,
				'position'                 => 100,
			]
		);

	}

	/**
	 * After activity add to favorite.
	 *
	 * @param [type] $activity_id Activity id.
	 * @param [type] $user_id User id.
	 * @return void
	 */
	public static function activity_add_listing_user_favorite( $activity_id, $user_id ) {
		$listing_id = bp_activity_get_meta( $activity_id, 'rtcl_bp_share_activity_listing_id', true );
		if ( ! $listing_id ) {
			$activity   = new BP_Activity_Activity( $activity_id );
			$listing_id = $activity->secondary_item_id;
		}
		if ( $listing_id ) {
			$favourites = (array) get_user_meta( $user_id, 'rtcl_favourites', true );
			if ( ! in_array( $listing_id, $favourites, true ) ) {
				$favourites[] = $listing_id;
				$favourites   = array_filter( $favourites );
				$favourites   = array_values( $favourites );
				update_user_meta( $user_id, 'rtcl_favourites', $favourites );
			}
		}
	}
	/**
	 * After activity add to favorite.
	 *
	 * @param [type] $activity_id Activity id.
	 * @param [type] $user_id User id.
	 * @return void
	 */
	public static function activity_remove_listing_user_favorite( $activity_id, $user_id ) {
		$listing_id = bp_activity_get_meta( $activity_id, 'rtcl_bp_share_activity_listing_id', true );
		if ( ! $listing_id ) {
			$activity   = new BP_Activity_Activity( $activity_id );
			$listing_id = $activity->secondary_item_id;
		}
		if ( $listing_id ) {
			$favourites = (array) get_user_meta( $user_id, 'rtcl_favourites', true );
			if ( in_array( $listing_id, $favourites, true ) ) {
				$key = array_search( $listing_id, $favourites, true );
				if ( false !== $key ) {
					unset( $favourites[ $key ] );
					$favourites = array_filter( $favourites );
					$favourites = array_values( $favourites );
					update_user_meta( $user_id, 'rtcl_favourites', $favourites );
				}
			}
		}
	}
	/**
	 * Display My listing Action
	 *
	 * @param boolean $boolval Activity id.
	 * @return boolean
	 */
	public static function is_current_user_displayed( $boolval = true ) {
		if ( get_current_user_id() !== bp_displayed_user_id() && ! Functions::is_account_page() ) {
			$boolval = false;
		}
		return $boolval;
	}

	/**
	 * Responses Argument.
	 *
	 * @param string $responses Responses Argument.
	 * @return string
	 */
	public static function listing_form_after_save_or_update_responses( $responses ) {
		global $current_user;
		$url                       = bp_core_get_user_domain( $current_user->ID ) . 'listings/';
		$responses['redirect_url'] = $url;
		return $responses;
	}
	/**
	 * Rendering share button in activity
	 *
	 * @since   1.0.0
	 *
	 * @access  public
	 */
	public static function bp_activity_share_button_render() {
		$is_share_button = Functions::get_option_item( 'rtcl_buddypress_settings', 'share_button_visibility', true, 'checkbox' );
		if ( Fns::bp_activity_share_can_share() && $is_share_button ) {
			global $activities_template;
			// Getting share count.
			$item_id = bp_activity_get_meta( $activities_template->activity->id, 'rtcl_bp_share_activity_main_parent_id', true );
			// Getting activity share count.
			if ( ! $item_id ) {
				$item_id = $activities_template->activity->id;
			}
			$share_count = bp_activity_get_meta( $item_id, 'rtcl_bp_share_activity_count', true );
			?>
			<a href="#" data-activity-id="<?php echo absint( $activities_template->activity->id ); ?>" class="button bp-primary-action rtcl-show-share-options" title="<?php esc_attr_e( 'Share this Listing', 'rtcl-buddypress' ); ?>"><?php printf( esc_html__( 'Share', 'rtcl-buddypress' ) . ' %s', $share_count ? ' <span>' . esc_html( $share_count ) . '</span>' : '' ); ?></a>
			<?php
		}
	}

}

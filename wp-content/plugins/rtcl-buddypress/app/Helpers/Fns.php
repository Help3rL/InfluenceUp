<?php
/**
 * Helpers class.
 *
 * @package RadiusTheme\BP
 */

namespace RadiusTheme\BP\Helpers;

use BP_Groups_Member;
use Rtcl\Helpers\Functions;
use Rtcl\Shortcodes\MyAccount;
use Rtcl\Controllers\Hooks\TemplateHooks;
use RtclBooking\Hooks\ActionHooks;
use RtclStore\Helpers\Functions as StoreFunctions;
use RtclPro\Controllers\Hooks\TemplateHooks as ProTemplateHooks;
use RtclStore\Controllers\Hooks\TemplateHooks as StoreTemplateHooks;

/**
 * Helpers class.
 */
class Fns {

	/**
	 * Print Listings for this users.
	 *
	 * @return void
	 */
	public static function user_listings_screen_function() {
		add_action( 'bp_template_content', [ TemplateHooks::class, 'account_listings_endpoint' ] );
		bp_core_load_template( 'bp_template_content' );
	}

	/**
	 * Returns list of user's groups
	 *
	 * @return string
	 * @since 1.4.0
	 *
	 */
	public static function bp_activity_share_get_users_groups() {
		$current_user_id = bp_loggedin_user_id();
		$html            = '';
		// Checking if group component is active.
		if ( bp_is_active( 'groups' ) ) {
			// Getting group ids of current user.
			$group_ids = BP_Groups_Member::get_group_ids( $current_user_id );
			// Checking if user belongs to any group.
			if ( ! empty( $group_ids ) && ! empty( $group_ids['groups'] ) ) {
				$html .= '<h4 style="font-size: 15px; margin: 5px 0;">' . esc_html__( 'Groups', 'rtcl-buddypress' ) . '</h4>';
				foreach ( $group_ids['groups'] as $group_id ) {
					// Getting group info using group id.
					$group = groups_get_group( [ 'group_id' => $group_id ] );
					$html  .= '<div class="share-to"><span data-value="share-in-group" group-id="' . absint( $group_id ) . '">' . esc_html( $group->name ) . '</span></div>';
				}
			}
		}

		return $html;
	}

	/**
	 * Favourite Listings function
	 *
	 * @return void
	 */
	public static function user_favourites_screen_function() {
		add_action( 'bp_template_content', [ MyAccount::class, 'favourite_listings' ] );
		bp_core_load_template( 'bp_template_content' );
	}

	/**
	 * Payment tab data
	 *
	 * @return void
	 */
	public static function user_payments_screen_function() {
		add_action( 'bp_template_content', [ MyAccount::class, 'payments_history' ] );
		bp_core_load_template( 'bp_template_content' );
	}

	/**
	 * Chat tab data
	 *
	 * @return void
	 */
	public static function user_chat_screen_function() {
		wp_enqueue_script( 'rtcl-user-chat' );
		add_action( 'bp_template_content', [ ProTemplateHooks::class, 'account_chat_endpoint' ] );
		bp_core_load_template( 'bp_template_content' );
	}

	/**
	 * Store tab data
	 *
	 * @return void
	 */
	public static function user_store_screen_function() {
		if ( method_exists( StoreTemplateHooks::class, 'account_store_endpoint' ) ) {
			wp_enqueue_script( 'rtcl-store' );
			wp_enqueue_style( 'rtcl-store' );
			add_action( 'bp_template_content', [ StoreTemplateHooks::class, 'account_store_endpoint' ] );
		}
		bp_core_load_template( 'bp_template_content' );
	}

	/**
	 * Favourite Listings function
	 *
	 * @return void
	 */
	public static function user_membership_statistic_screen_function() {
		if ( StoreFunctions::is_membership_enabled() ) {
			wp_enqueue_script( 'rtcl-store' );
			wp_enqueue_style( 'rtcl-store' );
			add_action( 'bp_template_content', [ StoreTemplateHooks::class, 'membership_statistic_report' ] );
		}
		bp_core_load_template( 'bp_template_content' );
	}

	/**
	 * My Bookings
	 *
	 * @return void
	 */
	public static function user_my_bookings_screen_function() {
		if ( method_exists( ActionHooks::class, 'account_my_bookings_endpoint' ) ) {
			wp_enqueue_script( 'rtcl-booking' );
			wp_enqueue_style( 'rtcl-booking' );
			add_action( 'bp_template_content', [ ActionHooks::class, 'account_my_bookings_endpoint' ] );
			bp_core_load_template( 'bp_template_content' );
		}
	}

	/**
	 * All Bookings
	 *
	 * @return void
	 */
	public static function user_all_bookings_screen_function() {
		if ( method_exists( ActionHooks::class, 'account_all_bookings_endpoint' ) ) {
			wp_enqueue_script( 'rtcl-booking' );
			wp_enqueue_style( 'rtcl-booking' );
			add_action( 'bp_template_content', [ ActionHooks::class, 'account_all_bookings_endpoint' ] );
			bp_core_load_template( 'bp_template_content' );
		}
	}

	/**
	 * Determine if an activity is sharable.
	 *
	 * @return  bool
	 */
	public static function bp_activity_share_can_share() {
		$can_share = true;
		// Determine activity type name.
		$activity_type = bp_get_activity_type();
		// Get allowed activity types.
		$activity_supported_types = apply_filters( 'rtcl_bp_activity_share_supported_types', [
			RtclBP()->activity_type,
			RtclBP()->share_activity_type
		] );
		// Checking if activity is supported for share.
		if ( ! in_array( $activity_type, $activity_supported_types, true ) ) {
			$can_share = false;
		}

		$can_share = apply_filters( 'rtcl_bp_activity_share_can_share', $can_share, $activity_type, $activity_supported_types );

		return $can_share;
	}

	/**
	 * Determine if an activity is sharable.
	 *
	 * @return  bool
	 */
	public static function is_rtcl_listings_activity() {
		$is_rtcl_listings = true;
		// Determine activity type name.
		$activity_type = bp_get_activity_type();
		// Get allowed activity types.
		$activity_supported_types = apply_filters( 'rtcl_bp_activity_share_supported_types', [
			RtclBP()->activity_type,
			RtclBP()->share_activity_type
		] );
		// Checking if activity is supported for share.
		if ( ! in_array( $activity_type, $activity_supported_types, true ) ) {
			$is_rtcl_listings = false;
		}

		$is_rtcl_listings = apply_filters( 'rtcl_bp_activity_supported', $is_rtcl_listings, $activity_type, $activity_supported_types );

		return $is_rtcl_listings;
	}
}


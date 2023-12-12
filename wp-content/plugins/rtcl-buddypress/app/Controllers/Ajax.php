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


use BP_Activity_Activity;
use Rtcl\Helpers\Functions;
use RadiusTheme\BP\Helpers\Fns;
use RadiusTheme\BP\Traits\SingletonTrait;

/**
 * Main Scripts Class
 */

class Ajax {
	/**
	 * Singleton Function.
	 */
	use SingletonTrait;
	/**
	 * Set up menus
	 */
	public function __init() {
		add_action( 'wp_ajax_rtcl_bp_share_option', [ $this, 'rtcl_bp_share_option' ] );
		add_action( 'wp_ajax_rtcl_bp_share_activity', [ $this, 'rtcl_bp_share_activity' ] );
	}
	/**
	 * Share option Modal content
	 *
	 * @return void
	 */
	public function rtcl_bp_share_option(){
		
		$title       = '<h4 class="share-modal-title">' . esc_html__( 'Share ', 'rtcl-buddypress' ) .'</h4>';
		$activity_id   = isset( $_POST['activity_id'] ) ? absint( $_POST['activity_id'] ) : null;
		if ( ! Functions::verify_nonce() || ! $activity_id ) {
			$return = [
				'success' => false,
				'title'   => $title,
				'content' => esc_html__( 'Session Expired...', 'rtcl-buddypress' ),
			];
			wp_send_json( $return );
		}
		
		$is_social_share = Functions::get_option_item( 'rtcl_buddypress_settings', 'social_share_visibility', true, 'checkbox' );
		ob_start();
		?>
		<div class="rtcl-share-options-wrapper" activity-id="<?php echo absint($activity_id);?>" >
			<select name="" id="share-type">
				<option value="default"><?php esc_html_e( 'Default', 'rtcl-buddypress' ); ?></option>
				<option value="rtcl-share-custom"><?php esc_html_e( 'Share with Custom Text', 'rtcl-buddypress' ); ?></option>
			</select>
			<textarea name="rtcl-bp-custom-text" class="rtcl-bp-custom-text hide" placeholder="<?php esc_html_e( 'Custom text field', 'rtcl-buddypress' ); ?>"></textarea>
			<div class="activity-share-to">
				<h6 style="font-size: 15px; margin: 5px 0;"><?php esc_html_e( 'Share as', 'rtcl-buddypress' ); ?></h6>
				<div class="share-to"><span data-value="rtcl-sitewide-activity" group-id="0"><?php esc_html_e( 'Site-Wide Activity', 'rtcl-buddypress' ); ?></span></div>
				<?php echo Fns::bp_activity_share_get_users_groups(); ?>
			</div>
			<?php if ( $is_social_share ) { ?>
			<h6 class="social-share-heading show" style="font-size: 15px; margin: 5px 0;"><?php esc_html_e( 'Social Share', 'rtcl-buddypress' ); ?></h6>
			<?php
				$listing_id = bp_activity_get_meta( $activity_id, 'rtcl_bp_share_activity_listing_id', true );
				if ( ! $listing_id ) {
					$current_activity = new BP_Activity_Activity( $activity_id );
					$listing_id = $current_activity->secondary_item_id;
				}
				if ( rtcl()->post_type === get_post_type( $listing_id ) ) {
					$listing = rtcl()->factory->get_listing( $listing_id );
					if ( $listing ) {
						echo '<div class="social-share-button show" style="">';
						echo $listing->get_the_social_share();
						echo '</div>';
					}
				}
			}
			?>
			<!-- Notification will display after shared -->
			<div class="notification" style="display: none;"> 
				<?php echo esc_html( apply_filters('rtcl_bp_after_shared_text', esc_html_e( 'The activity has been Shared.', 'rtcl-buddypress' ) ) ); ?>
			</div>
		</div>
		<?php
		$modal_content = ob_get_clean();
		$return = [
			'success' => true,
			'title'   => $title,
			'content' => $modal_content,
		];
		wp_send_json( $return );
		wp_die();
	}

	/**
	 * Share option Modal content
	 *
	 * @return void
	 */
	public function rtcl_bp_share_activity(){
		$current_activity_id   = isset( $_POST['act_id'] ) ? absint( $_POST['act_id'] ) : 0;
		$return = [
			'success' => false,
			'content' => esc_html__( 'Session Expired...', 'rtcl-buddypress' ),
		];
		if ( ! Functions::verify_nonce() || ! $current_activity_id ) {
			wp_send_json( $return );
		}
		$share_to   = isset( $_POST['share_to'] ) ? sanitize_text_field( $_POST['share_to'] ) : '';
		$custom_text   = isset( $_POST['custom_text'] ) ? sanitize_text_field( $_POST['custom_text'] ) : '';
		// Current logged in User's ID.
		$current_user_id = bp_loggedin_user_id();
		// Getting activity using Activity ID.
		$current_activity = new BP_Activity_Activity( $current_activity_id );
		// Current user's profile link.
		$current_profile_link = bp_core_get_userlink( $current_user_id );
		$listing_id           = bp_activity_get_meta( $current_activity->id, 'rtcl_bp_share_activity_listing_id', true );
		$main_parent_id       = bp_activity_get_meta( $current_activity->id, 'rtcl_bp_share_activity_main_parent_id', true );
		if ( ! $listing_id ) {
			$listing_id = $current_activity->secondary_item_id;
		}
		if ( ! $main_parent_id ) {
			$main_parent_id = $current_activity->id;
		}
		// User ID as a parent activity's User ID.
		$user_id = $current_activity->user_id;
		// Item id as an item ID.
		$item_id = $current_activity->item_id;
		// Parent activity user's profile link.
		$parent_profile_link = bp_core_get_userlink( $user_id );
		$share_count         = bp_activity_get_meta( $main_parent_id, 'rtcl_bp_share_activity_count', true );
		// Checking if sharing is in site-wide activity or in the group.
		if ( 'rtcl-sitewide-activity' === $share_to ) {
			// If user is sharing his/her own activity.
			if ( $current_user_id === $user_id ) {
				$action = sprintf( esc_html__( '%1$s shared an update', 'rtcl-buddypress' ), $current_profile_link );
			} else {
				$action = sprintf( '%1$s shared %2$s\'s update', $current_profile_link, $parent_profile_link );
			}
			$component = 'activity';
		} 
		else {
			$item_id   = isset( $_POST['group_id'] ) ? absint( $_POST['group_id'] ) : 0;
			// $item_id    = $group_id[1];
			$group      = groups_get_group( [ 'group_id' => $item_id ] );
			$group_link = '<a href="' . esc_attr( bp_get_group_permalink( $group ) ) . '">' . esc_attr( $group->name ) . '</a>';
			if ( $current_activity->id !== $main_parent_id ) {
				// Getting parent activity using Item ID.
				$parent_activity = new BP_Activity_Activity( $main_parent_id );
				// User ID as a parent activity's User ID.
				$user_id = $parent_activity->user_id;
				// Activity ID.
			}
			// Item id as an item ID.

			// If user is sharing his/her own activity.
			if ( $current_user_id === $user_id ) {
				$action = sprintf( esc_html__( '%1$s shared an update in the group %2$s', 'rtcl-buddypress' ), $current_profile_link, $group_link );
			} else {
				$action = sprintf( esc_html__( '%1$s shared %2$s\'s update in the group %3$s', 'rtcl-buddypress' ), $current_profile_link, $parent_profile_link, $group_link );
			}
			$component = 'groups';
		}

		$secondary_item_id = ( 0 === $current_activity->secondary_item_id ) ? $current_activity->id : $current_activity_id;

		$content = $current_activity->content;

		// // Checking if user shared an activity with custom text.
		if ( ! empty( $custom_text ) ) {
			$content = $custom_text;
		}
		// Prepare activity arguments.
		$activity_args = [
			'user_id'           => $current_user_id,
			'action'            => $action,
			'component'         => $component,
			'content'           => $content,
			'type'              => RtclBP()->share_activity_type,
			'primary_link'      => $current_profile_link,
			'secondary_item_id' => $secondary_item_id,
			'item_id'           => $item_id,
		];
		$activity_id   = bp_activity_add( $activity_args );
		if ( ! empty( $activity_id ) ) {
			$share_count = ! empty( $share_count ) ? (int) $share_count + 1 : 1;
			bp_activity_update_meta( $main_parent_id, 'rtcl_bp_share_activity_count', $share_count );
			bp_activity_update_meta( $activity_id, 'rtcl_bp_share_activity_main_parent_id', $main_parent_id );
			// Maintaining user's shared activity.
			$my_shared = bp_get_user_meta( $current_user_id, 'rtcl_bp_shared_activities', true );
			// Checking if $mu_shared is exist or not.
			if ( empty( $my_shared ) || ! is_array( $my_shared ) ) {
				$my_shared = [];
			}
			// Checking if $activity_id is already shared.
			if ( ! in_array( $activity_id, $my_shared, true ) ) {
				$my_shared[] = $activity_id;
			}
			// Updating user's shared activity meta.
			bp_update_user_meta( $current_user_id, 'rtcl_bp_shared_activities', $my_shared );
			bp_activity_update_meta( $activity_id, 'rtcl_bp_share_activity_listing_id', $listing_id );
			// Success message.
			$success_msg = __( 'An update shared successfully.', 'rtcl-buddypress' );
			$success_msg = apply_filters( 'bpas_success_message', $success_msg );
		} else {
			// Error message.
			$error_msg = __( 'There is an error when sharing this update. Please refresh page and try again.', 'rtcl-buddypress' );
			$error_msg = apply_filters( 'bpas_error_message', $error_msg );
		}

		$return = [
			'success' => true,
			'content' => esc_html__( 'Done...', 'rtcl-buddypress' ),
		];
		wp_send_json( $return );
	}

	
}
<?php
/**
 * Dashboard
 *
 * @author 		RadiusTheme
 * @package 	classified-listing/templates
 * @version     1.0.0
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

do_action( 'rtcl_account_dashboard', $current_user );

?>
<div class="rtcl-membership-statistics-report">
	<?php do_action( 'rtcl_account_dashboard_report', $current_user ); ?>
</div>
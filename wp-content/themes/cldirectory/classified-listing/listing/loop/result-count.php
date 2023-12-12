<?php
/**
 * Result Count
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Rtcl\Helpers\Functions;

?>
<div class="rtcl-result-count">
	<?php
	$post_per_pare = Functions::get_option_item( 'rtcl_moderation_settings', 'listing_top_per_page', 2 );
	$per_page      += absint( $post_per_pare );
	if ( 1 === $total ) {
		_e( 'Showing the single result', 'cldirectory' );
	} elseif ( $total <= $per_page || - 1 === $per_page ) {
		/* translators: %d: total results */
		printf( _n( '%d Search Results Found', '%d Search Results Found', $total, 'cldirectory' ), $total );
	} else {
		$first = ( $per_page * $current ) - $per_page + 1;
		$last  = min( $total, $per_page * $current );
		/* translators: 1: first result 2: last result 3: total results */
		printf( _nx( 'Showing %1$d&ndash;%2$d of %3$d result', 'Showing %1$d&ndash;%2$d of %3$d results', $total, 'with first and last result', 'cldirectory' ), $first, $last,
			$total );
	}
	?>
</div>

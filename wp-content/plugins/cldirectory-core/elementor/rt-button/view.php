<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\CLDirectory_Core;

$btn = $attr = '';

if ( !empty( $data['btnurl']['url'] ) ) {
	$attr  = 'href="' . $data['btnurl']['url'] . '"';
	$attr .= !empty( $data['btnurl']['is_external'] ) ? ' target="_blank"' : '';
	$attr .= !empty( $data['btnurl']['nofollow'] ) ? ' rel="nofollow"' : '';
	
}
if ( !empty( $data['btntext'] ) ) {
	$btn = '<a class="rt-btn-style" ' . $attr . '>' . $data['btntext'] . '</a>';
}

?>
<div class="rt-button">
    <?php echo wp_kses_post( $btn ); ?>
</div>
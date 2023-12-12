<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\CLDirectory_Core;

use Elementor\Group_Control_Image_Size;
extract($data);

$attr = '';
if ( !empty( $data['image_url']['url'] ) ) {
	$attr  = 'href="' . $data['image_url']['url'] . '"';
	$attr .= !empty( $data['image_url']['is_external'] ) ? ' target="_blank"' : '';
	$attr .= !empty( $data['image_url']['nofollow'] ) ? ' rel="nofollow"' : '';
	
}
//image
if ( $attr ) {
  $getimg = '<a ' . $attr . '>' .Group_Control_Image_Size::get_attachment_image_html( $data, 'rt_image_size' , 'rt_image' ).'</a>';
}
else {
	$getimg = Group_Control_Image_Size::get_attachment_image_html( $data, 'rt_image_size', 'rt_image' );
}

?>
<div class="rt-image-addon-wrapper style1 motion-effects-wrap">
    <div class="image">
        <?php echo wp_kses_post($getimg); ?>
    </div>
</div>
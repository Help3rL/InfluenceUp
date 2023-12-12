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

if ( $attr ) {
    $getimg2 = '<a ' . $attr . '>' .Group_Control_Image_Size::get_attachment_image_html( $data, 'rt_image_size' , 'rt_image2' ).'</a>';
}
else {
    $getimg2 = Group_Control_Image_Size::get_attachment_image_html( $data, 'rt_image_size', 'rt_image2' );
}
if ( $attr ) {
    $getimg3 = '<a ' . $attr . '>' .Group_Control_Image_Size::get_attachment_image_html( $data, 'rt_image_size' , 'rt_image3' ).'</a>';
}
else {
    $getimg3 = Group_Control_Image_Size::get_attachment_image_html( $data, 'rt_image_size', 'rt_image3' );
}
?>
<div class="rt-image-addon-wrapper style3 motion-effects-wrap">
    <ul class="image-list  d-lg-flex justify-content-xl-center align-items-center">

        <li>
            <?php if($getimg && $data['image1_show']=='yes'){
                echo wp_kses_post($getimg);
            } ?>
        </li>
        <li>
            <?php if($getimg2 && $data['image2_show']=='yes'){
                echo wp_kses_post($getimg2);
            } ?>
        </li>
        <li>
            <?php if($data['shape_display']=='yes'){ ?>
                <img src="<?php echo CLDIRECTORY_ASSETS_URL . 'img/img-wave.png'; ?>" width="74" height="23" alt="">
            <?php } ?>
        </li>
        <li>
            <?php if($getimg3 && $data['image3_show']=='yes'){
                echo wp_kses_post($getimg3);
            } ?>
        </li>
    </ul>
</div>
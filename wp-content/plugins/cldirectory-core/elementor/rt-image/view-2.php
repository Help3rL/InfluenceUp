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

$shape_image2 = wp_get_attachment_image_src($data['rt_image_shape']['id'],'full');

?>
<div class="rt-image-addon-wrapper style2 motion-effects-wrap">
    <ul class="shape">
        <li class="motion-effects6">
            <svg width="74" height="29" viewBox="0 0 74 29" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M72.4966 4.48944L73.977 2.51367C71.6791 0.827513 68.901 -0.0540588 66.0638 0.00256696C63.2266 0.0591927 60.4849 1.05093 58.2543 2.82747C56.3835 4.3449 54.0581 5.17173 51.6611 5.17173C49.2642 5.17173 46.9388 4.3449 45.0679 2.82747C42.7626 0.997105 39.9179 0.00239488 36.9885 0.00239488C34.0592 0.00239488 31.2144 0.997105 28.9091 2.82747C27.0383 4.3449 24.7128 5.17173 22.3159 5.17173C19.919 5.17173 17.5935 4.3449 15.7227 2.82747C13.4921 1.05093 10.7505 0.0591927 7.91327 0.00256696C5.07606 -0.0540588 2.29796 0.827513 0 2.51367L1.48046 4.48944C3.28484 3.18819 5.43975 2.47834 7.65478 2.45556C10.0427 2.47886 12.3571 3.29549 14.2422 4.77999C16.5421 6.58888 19.3639 7.58495 22.2757 7.61579C25.1876 7.58495 28.0094 6.58888 30.3092 4.77999C32.1819 3.26164 34.5093 2.43435 36.9082 2.43435C39.3071 2.43435 41.6345 3.26164 43.5071 4.77999C45.8106 6.60942 48.6534 7.60366 51.5808 7.60366C54.5082 7.60366 57.351 6.60942 59.6545 4.77999C61.4622 3.30075 63.7031 2.46989 66.0266 2.41732C68.3502 2.36475 70.6254 3.09344 72.4966 4.48944Z" fill="#E60000"/>
            <path d="M1.48046 15.1818C3.34642 13.809 5.60602 13.0951 7.91176 13.1497C10.2175 13.2043 12.4417 14.0244 14.2422 15.484C16.5432 17.3192 19.387 18.3171 22.3159 18.3171C25.2448 18.3171 28.0886 17.3192 30.3896 15.484C32.2648 13.9716 34.5912 13.1481 36.9885 13.1481C39.3858 13.1481 41.7122 13.9716 43.5875 15.484C45.8876 17.3212 48.7317 18.3203 51.6611 18.3203C54.5906 18.3203 57.4347 17.3212 59.7348 15.484C61.5354 14.0244 63.7595 13.2043 66.0653 13.1497C68.371 13.0951 70.6306 13.809 72.4966 15.1818L73.977 13.206C71.6798 11.518 68.9014 10.6353 66.0637 10.692C63.226 10.7486 60.4841 11.7415 58.2543 13.5198C56.3809 15.0313 54.0564 15.8543 51.6611 15.8543C49.2658 15.8543 46.9414 15.0313 45.0679 13.5198C42.7643 11.6856 39.9189 10.6884 36.9885 10.6884C34.0581 10.6884 31.2127 11.6856 28.9091 13.5198C27.0357 15.0313 24.7112 15.8543 22.3159 15.8543C19.9206 15.8543 17.5962 15.0313 15.7227 13.5198C13.4929 11.7415 10.751 10.7486 7.91333 10.692C5.07565 10.6353 2.29723 11.518 0 13.206L1.48046 15.1818Z" fill="#E60000"/>
            <path d="M43.6104 26.1763C45.9139 28.0058 48.7567 29 51.6841 29C54.6115 29 57.4543 28.0058 59.7578 26.1763C61.5562 24.7132 63.78 23.8899 66.0862 23.8332C68.3924 23.7764 70.6531 24.4896 72.5195 25.8625L74 23.8868C71.702 22.2006 68.9239 21.319 66.0867 21.3757C63.2495 21.4323 60.5079 22.424 58.2773 24.2006C56.4064 25.718 54.081 26.5448 51.6841 26.5448C49.2872 26.5448 46.9617 25.718 45.0909 24.2006C42.7864 22.3683 39.9413 21.3723 37.0115 21.3723C34.0816 21.3723 31.2365 22.3683 28.9321 24.2006C27.0612 25.718 24.7358 26.5448 22.3389 26.5448C19.9419 26.5448 17.6165 25.718 15.7457 24.2006C13.5131 22.4185 10.767 21.4235 7.92485 21.3669C5.08271 21.3102 2.30005 22.1951 0 23.8868L1.48046 25.8625C3.34693 24.4896 5.60754 23.7764 7.91377 23.8332C10.22 23.8899 12.4438 24.7132 14.2422 26.1763C16.5457 28.0058 19.3885 29 22.3159 29C25.2433 29 28.0861 28.0058 30.3896 26.1763C32.2613 24.656 34.5891 23.8274 36.9885 23.8274C39.388 23.8274 41.7157 24.656 43.5875 26.1763H43.6104Z" fill="#E60000"/>
            </svg>
        </li>
        <?php if($shape_image2){ ?>
            <li >
                <div class="shape" style="--rt-shape: url(<?php echo esc_url($shape_image2[0]); ?>);"></div>
            </li>
        <?php } ?>
    </ul>
    <div class="image">
        <?php echo wp_kses_post($getimg); ?>
    </div>
</div>
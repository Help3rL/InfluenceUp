<?php  
use Elementor\Group_Control_Image_Size;


$btn = $attr = '';

if ( !empty( $data['btnurl']['url'] ) ) {
	$attr  = 'href="' . $data['btnurl']['url'] . '"';
	$attr .= !empty( $data['btnurl']['is_external'] ) ? ' target="_blank"' : '';
	$attr .= !empty( $data['btnurl']['nofollow'] ) ? ' rel="nofollow"' : '';
	
}
if ( !empty( $data['btntext'] ) ) {
	$btn = '<a class="btn-fill" ' . $attr . '>' . $data['btntext'] . '</a>';
}
$get_img1=Group_Control_Image_Size::get_attachment_image_html( $data, 'icon_image_size' , 'rt_image' );
$get_img2=wp_get_attachment_image($data['rt_image2']['id'],'full'); 
?>

<div class="rt-about-box-wrapper">
    <div class="row justify-content-center g-4 row-cols-1 row-cols-md-2">
        <div class="col wow fadeInUp animated animated" data-wow-delay="0.3s" data-wow-duration="1s">
            <div class="about-box about-style-1">
                <div class="content-holder">
                    <div class="entry-sub-title"><?php echo esc_html($data['subtitle']); ?></div>
                    <h2 class="entry-title"><?php echo esc_html($data['title']); ?></h2>
                    <p class="entry-description"><?php echo esc_html($data['content']); ?></p>
                    <?php echo wp_kses_post( $btn ); ?>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="about-box about-style-1 motion-effects-wrap">
                <ul class="animated-shape">
                    <li class="shape-1 motion-effects1">
                        <svg width="100" height="52" viewBox="0 0 100 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2.00061 4C3.10518 4 4.00061 3.10457 4.00061 2C4.00061 0.895431 3.10518 0 2.00061 0C0.896041 0 0.000610352 0.895431 0.000610352 2C0.000610352 3.10457 0.896041 4 2.00061 4ZM18.0006 4C19.1052 4 20.0006 3.10457 20.0006 2C20.0006 0.895431 19.1052 0 18.0006 0C16.896 0 16.0006 0.895431 16.0006 2C16.0006 3.10457 16.896 4 18.0006 4ZM36.0006 2C36.0006 3.10457 35.1052 4 34.0006 4C32.896 4 32.0006 3.10457 32.0006 2C32.0006 0.895431 32.896 0 34.0006 0C35.1052 0 36.0006 0.895431 36.0006 2ZM50.0006 4C51.1052 4 52.0006 3.10457 52.0006 2C52.0006 0.895431 51.1052 0 50.0006 0C48.896 0 48.0006 0.895431 48.0006 2C48.0006 3.10457 48.896 4 50.0006 4ZM68.0006 2C68.0006 3.10457 67.1052 4 66.0006 4C64.896 4 64.0006 3.10457 64.0006 2C64.0006 0.895431 64.896 0 66.0006 0C67.1052 0 68.0006 0.895431 68.0006 2ZM82.0006 4C83.1052 4 84.0006 3.10457 84.0006 2C84.0006 0.895431 83.1052 0 82.0006 0C80.896 0 80.0006 0.895431 80.0006 2C80.0006 3.10457 80.896 4 82.0006 4ZM100.001 2C100.001 3.10457 99.1052 4 98.0006 4C96.896 4 96.0006 3.10457 96.0006 2C96.0006 0.895431 96.896 0 98.0006 0C99.1052 0 100.001 0.895431 100.001 2ZM2.00061 20C3.10518 20 4.00061 19.1046 4.00061 18C4.00061 16.8954 3.10518 16 2.00061 16C0.896041 16 0.000610352 16.8954 0.000610352 18C0.000610352 19.1046 0.896041 20 2.00061 20ZM20.0006 18C20.0006 19.1046 19.1052 20 18.0006 20C16.896 20 16.0006 19.1046 16.0006 18C16.0006 16.8954 16.896 16 18.0006 16C19.1052 16 20.0006 16.8954 20.0006 18ZM34.0006 20C35.1052 20 36.0006 19.1046 36.0006 18C36.0006 16.8954 35.1052 16 34.0006 16C32.896 16 32.0006 16.8954 32.0006 18C32.0006 19.1046 32.896 20 34.0006 20ZM52.0006 18C52.0006 19.1046 51.1052 20 50.0006 20C48.896 20 48.0006 19.1046 48.0006 18C48.0006 16.8954 48.896 16 50.0006 16C51.1052 16 52.0006 16.8954 52.0006 18ZM66.0006 20C67.1052 20 68.0006 19.1046 68.0006 18C68.0006 16.8954 67.1052 16 66.0006 16C64.896 16 64.0006 16.8954 64.0006 18C64.0006 19.1046 64.896 20 66.0006 20ZM84.0006 18C84.0006 19.1046 83.1052 20 82.0006 20C80.896 20 80.0006 19.1046 80.0006 18C80.0006 16.8954 80.896 16 82.0006 16C83.1052 16 84.0006 16.8954 84.0006 18ZM98.0006 20C99.1052 20 100.001 19.1046 100.001 18C100.001 16.8954 99.1052 16 98.0006 16C96.896 16 96.0006 16.8954 96.0006 18C96.0006 19.1046 96.896 20 98.0006 20ZM4.00061 34C4.00061 35.1046 3.10518 36 2.00061 36C0.896041 36 0.000610352 35.1046 0.000610352 34C0.000610352 32.8954 0.896041 32 2.00061 32C3.10518 32 4.00061 32.8954 4.00061 34ZM18.0006 36C19.1052 36 20.0006 35.1046 20.0006 34C20.0006 32.8954 19.1052 32 18.0006 32C16.896 32 16.0006 32.8954 16.0006 34C16.0006 35.1046 16.896 36 18.0006 36ZM36.0006 34C36.0006 35.1046 35.1052 36 34.0006 36C32.896 36 32.0006 35.1046 32.0006 34C32.0006 32.8954 32.896 32 34.0006 32C35.1052 32 36.0006 32.8954 36.0006 34ZM50.0006 36C51.1052 36 52.0006 35.1046 52.0006 34C52.0006 32.8954 51.1052 32 50.0006 32C48.896 32 48.0006 32.8954 48.0006 34C48.0006 35.1046 48.896 36 50.0006 36ZM68.0006 34C68.0006 35.1046 67.1052 36 66.0006 36C64.896 36 64.0006 35.1046 64.0006 34C64.0006 32.8954 64.896 32 66.0006 32C67.1052 32 68.0006 32.8954 68.0006 34ZM82.0006 36C83.1052 36 84.0006 35.1046 84.0006 34C84.0006 32.8954 83.1052 32 82.0006 32C80.896 32 80.0006 32.8954 80.0006 34C80.0006 35.1046 80.896 36 82.0006 36ZM100.001 34C100.001 35.1046 99.1052 36 98.0006 36C96.896 36 96.0006 35.1046 96.0006 34C96.0006 32.8954 96.896 32 98.0006 32C99.1052 32 100.001 32.8954 100.001 34ZM2.00061 52C3.10518 52 4.00061 51.1046 4.00061 50C4.00061 48.8954 3.10518 48 2.00061 48C0.896041 48 0.000610352 48.8954 0.000610352 50C0.000610352 51.1046 0.896041 52 2.00061 52ZM20.0006 50C20.0006 51.1046 19.1052 52 18.0006 52C16.896 52 16.0006 51.1046 16.0006 50C16.0006 48.8954 16.896 48 18.0006 48C19.1052 48 20.0006 48.8954 20.0006 50ZM34.0006 52C35.1052 52 36.0006 51.1046 36.0006 50C36.0006 48.8954 35.1052 48 34.0006 48C32.896 48 32.0006 48.8954 32.0006 50C32.0006 51.1046 32.896 52 34.0006 52ZM52.0006 50C52.0006 51.1046 51.1052 52 50.0006 52C48.896 52 48.0006 51.1046 48.0006 50C48.0006 48.8954 48.896 48 50.0006 48C51.1052 48 52.0006 48.8954 52.0006 50ZM66.0006 52C67.1052 52 68.0006 51.1046 68.0006 50C68.0006 48.8954 67.1052 48 66.0006 48C64.896 48 64.0006 48.8954 64.0006 50C64.0006 51.1046 64.896 52 66.0006 52ZM84.0006 50C84.0006 51.1046 83.1052 52 82.0006 52C80.896 52 80.0006 51.1046 80.0006 50C80.0006 48.8954 80.896 48 82.0006 48C83.1052 48 84.0006 48.8954 84.0006 50ZM98.0006 52C99.1052 52 100.001 51.1046 100.001 50C100.001 48.8954 99.1052 48 98.0006 48C96.896 48 96.0006 48.8954 96.0006 50C96.0006 51.1046 96.896 52 98.0006 52Z" fill="#FFB4B4"/>
                        </svg>
                    </li>
                </ul>
                <div class="figure-holder">
                    <?php if($get_img1){ ?>
                        <div class="about-img wow fadeInRight animated animated"  data-wow-delay="0.6s" data-wow-duration="1s">
                            <?php echo wp_kses_post($get_img1); ?>
                        </div>
                    <?php } ?>
                    <?php if($get_img2){ ?>
                        <div class="wow fadeInUp animated animated" data-wow-delay="0.7s" data-wow-duration="1s">
                            <div class="entry-review-info">
                                <?php echo wp_kses_post($get_img2); ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

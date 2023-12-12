<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\CLDirectory_Core;

?>
<div class="vertical-testimonial-slider rt-el-testimonial-carousel">
    <div class="container">
        <div class="row align-items-center">
        <div class="col-lg-4">
            <div class="section-title-vertical">
                <div class="title-wrapper">
                    <h2><?php echo wp_kses_post($data['sec_title']); ?></h2>
                    <span class="title-shape">
                        <svg width="217" height="30" viewBox="0 0 217 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.92944 26.9996C31.1359 14.1009 114.829 -7.62654 215.951 8.6531" stroke="#E60000" stroke-width="5"></path>
                        </svg>
                    </span>
                </div>
                <p>
                    <?php echo wp_kses_post($data['sec_content']); ?>
                </p>
            </div>
        </div>
        <div class="col-lg-7 position-relative">
            <div class="swiper vertical-slider" data-options="<?php echo esc_attr( $data['slider_data'] ); ?>">
                <div class="swiper-wrapper">
                    <?php foreach ( $data['items'] as $item ){ ?>
                        <div class="swiper-slide">
                            <div class="vertical-slider-item testimonial-block">
                                <p class="testimonial-block__text">
                                    <?php echo esc_html( $item['content'] ); ?>
                                </p>
                                <?php 
                                    if ( $item['image']['id'] && $data['thum_display']=='yes') {
                                        echo "<div class='testimonial-img'>";
                                        echo wp_get_attachment_image( $item['image']['id'], 'full' );
                                        echo "</div>";
                                    }
                                ?>
                                <h3 class="author-name testimonial-block__heading"><?php echo esc_html( $item['name'] ); ?></h3>
                                <span class="author-title testimonial-block__designation"><?php echo esc_html( $item['designation'] ); ?></span>
                                <?php if ( $data['rating'] ) : ?>
                                    <ul class="rating">
                                        <?php for ( $i=0; $i <=4 ; $i++ ) {
                                            if ( $i < $item['rating'] ) {
                                                $full = 'active';
                                            } else {
                                                $full = 'deactive';
                                            }
                                            echo '<li class="has-rating"><i class="fa-solid fa-star '.$full.'"></i></li>';
                                        } ?>
                                    </ul>
                                <?php endif; ?>
                                <span class="q-icon qoute-icon">
                                    <svg
                                        width="71"
                                        height="60"
                                        viewBox="0 0 71 60"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                        d="M32.7692 35.4545V51.8182C32.7692 54.0909 31.9728 56.0227 30.3798 57.6136C28.7869 59.2045 26.8526 60 24.5769 60H8.19231C5.91667 60 3.98237 59.2045 2.38942 57.6136C0.796474 56.0227 0 54.0909 0 51.8182V21.8182C0 18.8636 0.56891 16.0511 1.70673 13.3807C2.873 10.6818 4.4375 8.35227 6.40024 6.39205C8.36298 4.43182 10.6813 2.88352 13.3552 1.74716C16.0575 0.582387 18.8878 0 21.8462 0H24.5769C25.3165 0 25.9565 0.269887 26.497 0.809662C27.0375 1.34943 27.3077 1.98864 27.3077 2.72727V8.18182C27.3077 8.92046 27.0375 9.55966 26.497 10.0994C25.9565 10.6392 25.3165 10.9091 24.5769 10.9091H21.8462C18.8309 10.9091 16.2566 11.9744 14.1232 14.1051C11.9898 16.2358 10.9231 18.8068 10.9231 21.8182V23.1818C10.9231 24.3182 11.3213 25.2841 12.1178 26.0795C12.9143 26.875 13.8814 27.2727 15.0192 27.2727H24.5769C26.8526 27.2727 28.7869 28.0682 30.3798 29.6591C31.9728 31.25 32.7692 33.1818 32.7692 35.4545ZM71 35.4545V51.8182C71 54.0909 70.2035 56.0227 68.6106 57.6136C67.0176 59.2045 65.0833 60 62.8077 60H46.4231C44.1474 60 42.2131 59.2045 40.6202 57.6136C39.0272 56.0227 38.2308 54.0909 38.2308 51.8182V21.8182C38.2308 18.8636 38.7997 16.0511 39.9375 13.3807C41.1038 10.6818 42.6683 8.35227 44.631 6.39205C46.5937 4.43182 48.9121 2.88352 51.5859 1.74716C54.2883 0.582387 57.1186 0 60.0769 0H62.8077C63.5473 0 64.1873 0.269887 64.7278 0.809662C65.2682 1.34943 65.5385 1.98864 65.5385 2.72727V8.18182C65.5385 8.92046 65.2682 9.55966 64.7278 10.0994C64.1873 10.6392 63.5473 10.9091 62.8077 10.9091H60.0769C57.0617 10.9091 54.4874 11.9744 52.354 14.1051C50.2206 16.2358 49.1539 18.8068 49.1539 21.8182V23.1818C49.1539 24.3182 49.5521 25.2841 50.3486 26.0795C51.145 26.875 52.1122 27.2727 53.25 27.2727H62.8077C65.0833 27.2727 67.0176 28.0682 68.6106 29.6591C70.2035 31.25 71 33.1818 71 35.4545Z"
                                        fill="#F4F4F4"
                                        />
                                    </svg>
                                </span>
                                
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php if($data['dots']){ ?>
                <div class="vertical-slider-pagination swiper-pagination"></div>
            <?php } ?>
        </div>
    </div>
    <ul class="t-gradient-shape">
        <li></li>
        <li></li>
    </ul>
</div>
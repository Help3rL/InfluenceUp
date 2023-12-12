<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\CLDirectory_Core;


?>
<div class="rt-el-testimonial-carousel <?php echo esc_attr($data['layout']); ?>">
    <div class="slide-wrap">
        <div class="rt-global-slider swiper" data-options="<?php echo esc_attr( $data['slider_data'] ); ?>">
            <div class="swiper-wrapper">
				<?php foreach ( $data['items'] as $item ): ?>
                    <div class="swiper-slide slider-item">
                        <div class="testimonial-block">
                            <div class="qoute-icon">
                                <svg width="101" height="85" viewBox="0 0 101 85" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M46.6154 50.2273V73.4091C46.6154 76.6288 45.4824 79.3655 43.2163 81.6193C40.9503 83.8731 38.1987 85 34.9615 85H11.6538C8.41667 85 5.66506 83.8731 3.39904 81.6193C1.13301 79.3655 0 76.6288 0 73.4091V30.9091C0 26.7235 0.809295 22.7391 2.42788 18.956C4.08694 15.1326 6.3125 11.8324 9.10457 9.0554C11.8966 6.27841 15.1945 4.08499 18.9982 2.47514C22.8423 0.825048 26.8686 0 31.0769 0H34.9615C36.0136 0 36.9241 0.38234 37.6929 1.14702C38.4617 1.9117 38.8462 2.81723 38.8462 3.86363V11.5909C38.8462 12.6373 38.4617 13.5429 37.6929 14.3075C36.9241 15.0722 36.0136 15.4545 34.9615 15.4545H31.0769C26.7877 15.4545 23.1256 16.9638 20.0907 19.9822C17.0559 23.0007 15.5385 26.643 15.5385 30.9091V32.8409C15.5385 34.4508 16.105 35.8191 17.238 36.946C18.371 38.0729 19.7468 38.6364 21.3654 38.6364H34.9615C38.1987 38.6364 40.9503 39.7633 43.2163 42.017C45.4824 44.2708 46.6154 47.0076 46.6154 50.2273ZM101 50.2273V73.4091C101 76.6288 99.867 79.3655 97.601 81.6193C95.3349 83.8731 92.5833 85 89.3462 85H66.0385C62.8013 85 60.0497 83.8731 57.7837 81.6193C55.5176 79.3655 54.3846 76.6288 54.3846 73.4091V30.9091C54.3846 26.7235 55.1939 22.7391 56.8125 18.956C58.4716 15.1326 60.6971 11.8324 63.4892 9.0554C66.2812 6.27841 69.5791 4.08499 73.3828 2.47514C77.227 0.825048 81.2532 0 85.4615 0H89.3462C90.3982 0 91.3087 0.38234 92.0775 1.14702C92.8464 1.9117 93.2308 2.81723 93.2308 3.86363V11.5909C93.2308 12.6373 92.8464 13.5429 92.0775 14.3075C91.3087 15.0722 90.3982 15.4545 89.3462 15.4545H85.4615C81.1723 15.4545 77.5102 16.9638 74.4754 19.9822C71.4405 23.0007 69.9231 26.643 69.9231 30.9091V32.8409C69.9231 34.4508 70.4896 35.8191 71.6226 36.946C72.7556 38.0729 74.1314 38.6364 75.75 38.6364H89.3462C92.5833 38.6364 95.3349 39.7633 97.601 42.017C99.867 44.2708 101 47.0076 101 50.2273Z" fill="#F3F3F3"></path>
                                </svg>
                            </div>
                            <p class="testimonial-block__text">
                                <?php echo esc_html( $item['content'] ); ?>
                            </p>
                            <div class="testimonial-content">
                                
                                <?php 
                                    if ( $item['image']['id'] && $data['thum_display']=='yes') {
                                        echo "<div class='testimonial-img'>";
                                        echo wp_get_attachment_image( $item['image']['id'], 'full' );
                                        echo "</div>";
                                    }
                                ?>
                                <div class="content-info">
                                    <h3 class="testimonial-block__heading"><?php echo esc_html( $item['name'] ); ?></h3>
                                    <?php if ( $item['designation'] ): ?>
                                        <span class="testimonial-block__designation"><?php echo esc_html( $item['designation'] ); ?>
                                        </span>
                                    <?php endif; ?>
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
                                </div>
                            </div>
                        </div>
                    </div>
				<?php endforeach; ?>
            </div>
            <?php if($data['dots']){ ?>
                <div class="el-swiper-pagination"></div>
            <?php } ?>
        </div>
    </div>
</div>


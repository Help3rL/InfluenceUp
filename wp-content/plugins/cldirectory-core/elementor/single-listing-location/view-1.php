<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\ClDirectory_Core;
use Elementor\Group_Control_Image_Size;

$link_start = $data['enable_link'] ? '<a href="'.$data['permalink'].'">' : '';
$link_end   = $data['enable_link'] ? '</a>' : '';
$getimg = Group_Control_Image_Size::get_attachment_image_html( $data, 'rt_image_size', 'rt_image' );
?>
<div class="rt-el-listing-location-box">
    <div class="location-box">
        <?php echo wp_kses_post( $link_start );?>
        <?php if($getimg){ ?>
            <div class="item-img">
                <?php echo wp_kses_post($getimg); ?>
            </div>
        <?php } ?>
        <div class="item-content">
            <h3 class="item-title">
                <?php if($data['enable_link']){ ?>
                    <?php echo esc_html( $data['title'] ); ?>
                <?php } else{ ?>
                    <a href="<?php echo esc_url($data['permalink']); ?>"><?php echo esc_html( $data['title'] ); ?></a>
                <?php } ?>
            </h3>
            <?php if ( $data['display_count'] ): ?>
                <div class="item-count">
                    <span class="count"><?php echo esc_html( $data['count'] < 10 ? '0'.ltrim($data['count'], "0") : $data['count']); ?></span>
                    <?php if($data['count_suffix_display']=='yes'){ ?>
                        <span><?php echo esc_html($data['count_suffix_text']); ?></span>
                    <?php } ?>
                </div>
            <?php endif; ?>
        </div>
        <?php echo wp_kses_post( $link_end ); ?>
    </div>
</div>

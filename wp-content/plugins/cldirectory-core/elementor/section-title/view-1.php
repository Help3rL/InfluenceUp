<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * top_sub_title
 * title
 * subtitle
 * bg_title
 * top_title_icon
 *
 */

namespace radiustheme\CLDirectory_Core;
$section_tag='';
?>
<div class="section-title-wrapper">
    <div class="title-inner-wrapper">

        <!--Top Sub Title-->
        <?php if ( $data['top_sub_title'] ): ?>
            <div class="rt-section-subtitle <?php echo esc_attr($data['alignment']); ?>">
                <?php
                echo esc_html( $data['top_sub_title'] );
                ?>
            </div>
        <?php endif; ?>

        <!--Main Title-->
        <?php if ( $data['title'] ): ?>
            <div class="title-wrapper">
                <?php 
                $section_tag .='<'.esc_attr( $data['section_title_tag']).' class="rt-section-title" >';
                $section_tag .=wp_kses_post($data['title']);
                $section_tag .='</'.esc_attr( $data['section_title_tag']).'>';
                
                echo wp_kses_post($section_tag);
                ?>

                <?php if($data['title_shape']=='yes'){ ?>
                    <div class="rt-heading-shape <?php echo esc_html($data['title_shape_style']); ?>">
                        <?php 
                            if($data['title_shape_style']=='style2'){ ?>
                            
                                    <svg width="216" height="19" viewBox="0 0 216 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.999985 15.9998C30.1695 9.37474 113.8 -1.68752 214.966 7.06376" stroke="#E60000" stroke-width="6"/>
                                    </svg>

                            <?php }
                        ?>
                    </div>
                <?php } ?>
            </div>
        <?php endif; ?>

        <!--Description-->
        <?php if ( $data['description'] ): ?>
            <div class="section-description"><?php echo wp_kses_post( $data['description'] ); ?></div>
        <?php endif; ?>
    </div>
</div>
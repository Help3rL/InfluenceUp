<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\ClProperty_Core;
use Elementor\Group_Control_Image_Size;

$term = get_term_by('id', $data['category'], 'rtcl_category',ARRAY_A);
$getimg = Group_Control_Image_Size::get_attachment_image_html( $data, 'icon_image_size', 'rt_image' );

?>
<div class="rt-listing-category-wrapper">
		<?php if ( ! empty( $term ) ) :
			 
			$term_id = $term['term_id'];
			$name = $term['name'];
			$count = $term['count'];
			?>
			<div class="categories-block">
				<?php if($getimg){ ?>
					<div class="category-full-image">
					<a href="<?php echo esc_url(get_term_link($term_id,'rtcl_category')); ?>">
						<?php echo wp_kses_post($getimg); ?>
					</a>
					</div>
				<?php } ?>
				<div class="category-content-wrapper">
					<div class="categories-block-icon">
						<?php 
						if($data['cat_icon_style']=='default'){
							$icon = get_term_meta( $term_id, '_rtcl_icon', true );
							?>
							<i class="rtcl-icon rtcl-icon-<?php echo esc_attr( $icon ) ?>"></i>
						<?php }
						else if($data['cat_icon_style']=='default_image'){
							$image_id = get_term_meta( $term_id, '_rtcl_image', true );
							if($image_id){
								echo wp_kses_post(wp_get_attachment_image($image_id,'thumbnail'));
							}
						}
						?>
					</div>
					<div class="categories-block-content">
						<h3 class="categories-block__cname"><a href="<?php echo get_term_link( $term_id ) ?>"><?php echo esc_html( $name ) ?></a></h3>
						<a href="<?php echo get_term_link( $term_id ) ?>" class="categories-block__listing"><?php echo esc_html__( $count . ' ' . $data['cat_count_suffix'], 'clproperty-core' ) ?></a>
					</div>
				</div>
			</div>
			<?php 
		?>
		<?php endif; ?>
</div>


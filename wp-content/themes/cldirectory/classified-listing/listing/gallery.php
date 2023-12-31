<?php
/**
 * @author     RadiusTheme
 * @package    classified-listing/templates
 * @version    1.0.0
 *
 * @var array[] $images
 * @var array[] $videos
 * @var string  $video_url
 */


use Rtcl\Helpers\Functions;

$total_gallery_image  = count($images);

$total_gallery_item   = $total_gallery_image;
$isSliderEnable       = Functions::is_gallery_slider_enabled();
if ($total_gallery_item) :
	?>
	<div id="rtcl-slider-wrapper" class="rtcl-slider-wrapper mb-4" data-options="">
		<!-- Slider -->
		<div class="rtcl-slider<?php echo esc_attr($isSliderEnable ? '' : ' off') ?>">
			<div class="swiper-wrapper">
				<?php
				
				if ($total_gallery_image) {
					foreach ($images as $index => $image) :
						$image_attributes = wp_get_attachment_image_src($image->ID, 'rtcl-gallery');
					$image_full        = wp_get_attachment_image_src($image->ID, 'full'); ?>
						<div class="swiper-slide rtcl-slider-item">
							<img src="<?php echo esc_html($image_attributes[0]); ?>"
								 data-src="<?php echo esc_attr($image_full[0]) ?>"
								 data-large_image="<?php echo esc_attr($image_full[0]) ?>"
								 data-large_image_width="<?php echo esc_attr($image_full[1]) ?>"
								 data-large_image_height="<?php echo esc_attr($image_full[2]) ?>"
								 alt="<?php echo get_the_title($image->ID); ?>"
								 data-caption="<?php echo esc_attr(wp_get_attachment_caption($image->ID)); ?>"
								 class="rtcl-responsive-img"/>
						</div>
					<?php endforeach;
				} ?>
			</div>
			<div class="swiper-button-next"></div>
			<div class="swiper-button-prev"></div>
		</div>
		<?php if ($isSliderEnable && $total_gallery_item > 1): ?>
			<!-- Slider nav -->
			<div class="rtcl-slider-nav">
				<div class="swiper-wrapper">
					<?php
					if ($total_gallery_image) {
						foreach ($images as $index => $image) : ?>
							<div class="swiper-slide rtcl-slider-thumb-item">
								<?php echo wp_get_attachment_image($image->ID, 'rtcl-gallery-thumbnail'); ?>
							</div>
						<?php endforeach;
					} ?>
				</div>
				<div class="swiper-button-next"></div>
				<div class="swiper-button-prev"></div>
			</div>
		<?php endif; ?>
	</div>
<?php endif;

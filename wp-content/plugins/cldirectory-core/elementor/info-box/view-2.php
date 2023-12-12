<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\CLDirectory_Core;
$target   = $data['link']['is_external'] ? ' target="_blank"' : '';
$nofollow = $data['link']['nofollow'] ? ' rel="nofollow"' : '';

?>

<div class="why-choose-box rt-info-box style2">
	<div class="choose-box">
		<div class="icon-holder <?php echo esc_attr($data['text_align']); ?>">
				<span class="icon">
					<?php
					if ( 'image' == $data['icon_type'] ) {
						echo "<div class='img-wrap'>";
						echo wp_get_attachment_image( $data['image_icon']['id'], 'full' );
						echo "</div>";
					} else {
						\Elementor\Icons_Manager::render_icon( $data['info_icon'], [ 'aria-hidden' => 'true' ] );
					}
					echo $data['link']['url'] ? '</a>' : null;
					?>
				</span>
				
		</div>
		<div class="content-holder content-align <?php echo esc_attr($data['text_align']); ?>">
			<?php if ( $data['title'] ) : ?>
				<h3 class="entry-title">
					<?php
					echo $data['link']['url'] ? '<a href="' . $data['link']['url'] . '"' . $target . $nofollow . '>' : null;
					echo wp_kses_post( $data['title'] );
					echo $data['link']['url'] ? '</a>' : null;
					?>
				</h3>
			<?php endif; ?>
			<?php if($data['content']){ ?>
				<p class="entry-description"><?php echo wp_kses_post($data['content']); ?></p>
			<?php } ?>
			<?php if ( $data['show_readmore_btn'] ) : ?>
				<div class="read-more-btn">
					<a class="choose-btn" href="<?php echo esc_url( $data['link']['url'] ) ?>" <?php echo esc_attr( $target . ' ' . $nofollow ) ?>>
						
							<?php echo esc_html( $data['read_more_btn_text'] ); ?>
							
					</a>
				</div>
			<?php endif; ?>
		</div>
    </div>
</div>




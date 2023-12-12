<?php
/**
 * Author Listing
 *
 * @author     RadiusTheme
 * @package    ClassifiedListing/Templates
 * @version    2.2.1.1
 */

use Rtcl\Helpers\Functions;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$author   = get_user_by( 'slug', get_query_var( 'author_name' ) );
$user_id  = $author->ID;
$phone    = get_user_meta( $user_id, '_rtcl_phone', true );
$whatsApp = get_user_meta( $user_id, '_rtcl_whatsapp_number', true );
$website  = get_user_meta( $user_id, '_rtcl_website', true );
$pp_id    = absint( get_user_meta( $user_id, '_rtcl_pp_id', true ) );

?>
<div class="rtcl-user-single-wrapper rtcl">
	<div class="rtcl-user-info-wrap">
		<div class="rtcl-user-img">
			<?php echo wp_kses_post($pp_id ? wp_get_attachment_image( $pp_id, [
					400,
					220
				] ) : get_avatar( $user_id,'220' )); ?>
		</div>
		<div class="rtcl-user-info">
			<h3 class="user-name"><?php echo esc_html($author->display_name); ?></h3>
			<?php echo esc_html($author->description); ?>
			<div class="rtcl-user-meta">
				<?php if ( $phone ): ?>
					<div class="item-phone">
						<i class="phone-call-cl-icon"></i>
						<a href="tel:<?php echo esc_attr( $phone ); ?>"><?php echo esc_html( $phone ); ?></a>
					</div>
				<?php endif; ?>
				<?php if ( $whatsApp ): ?>
					<div class="item-whatsapp">
						<i class="fa-brands fa-whatsapp"></i>
						<a target="_blank"
						   href="https://wa.me/<?php echo esc_attr( $whatsApp ); ?>"><?php echo esc_html( $whatsApp ); ?></a>
					</div>
				<?php endif; ?>
				<div class="item-contact">
					<i class="envelope-cl-icon"></i>
					<a href="mailto:<?php echo esc_attr( $author->user_email ); ?>"><?php echo esc_html( $author->user_email ); ?></a>
				</div>
				<?php if ( $website ): ?>
					<div class="item-website">
						<i class="globe-cl-icon"></i>
						<a target="_blank"
						   href="<?php echo esc_url( $website ); ?>"><?php echo esc_url( $website ); ?></a>
					</div>
				<?php endif; ?>
			</div>
			<?php
			$social_list = Functions::get_user_social_profile( $user_id );
			if ( ! empty( $social_list ) ) {
				?>
				<div class="rtcl-user-social">
					<span><?php esc_html_e('Social Media:','cldirectory'); ?></span>
					<?php
					foreach ( $social_list as $item => $value ) {
						?>
						<a target="_blank" class="<?php echo esc_attr($item); ?>" href="<?php echo esc_url( $value ) ?>">
							<i class="rtcl-icon rtcl-icon-<?php echo esc_attr( $item ) ?>"></i>
						</a>
						<?php
					}
					?>
				</div>
			<?php } ?>
		</div>
	</div>
	<?php Functions::get_template( 'listing/author-listing'); ?>
</div>
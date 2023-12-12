
<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$btn = $attr = '';

if ( !empty( $data['btnurl']['url'] ) ) {
	$attr  = 'href="' . $data['btnurl']['url'] . '"';
	$attr .= !empty( $data['btnurl']['is_external'] ) ? ' target="_blank"' : '';
	$attr .= !empty( $data['btnurl']['nofollow'] ) ? ' rel="nofollow"' : '';
	
}
if ( !empty( $data['btntext'] ) ) {
	$btn = '<a class="btn-lg-outline custom-btn rt-btn-style" ' . $attr . '>' . $data['btntext'] . '</a>';
}
?>
<div class="call-to-action-wrap-layout-2 call-to-action-wrap-layout">
    <div class="footer-cta-bg">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-auto">
                    <div class="footer-cta-content">
                        <?php if($data['title']){ ?>
                            <h2 class="footer-cta-title title">
                                <?php echo wp_kses_post($data['title']); ?>
                            </h2>
                        <?php } ?>
                        <?php if($data['content']){ ?>
                            <p class="footer-cta-desc">
                                <?php  echo wp_kses_post($data['content']); ?>
                            </p>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="cta-btn">
                        <?php echo wp_kses_post( $btn ); ?>
                    </div>
                </div>
            </div>
            <div class="footer-cta-img-wrapper">
                <img src="<?php echo CLDIRECTORY_ASSETS_URL . 'img/cta-ill.svg'; ?>" width="344" height="140" class="footer-cta-img" alt="<?php echo esc_attr('Shape', 'cldirectory'); ?>">
            </div>
        </div>
    </div>
</div>
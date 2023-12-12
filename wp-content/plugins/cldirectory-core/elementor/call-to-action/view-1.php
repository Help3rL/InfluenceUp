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
	$btn = '<a class="rt-btn-style" ' . $attr . '>' . $data['btntext'] . '</a>';
}

?>

<div class="call-to-action-wrap-layout">
      <div class="cta-content-wrapper">
            <div class="content">
                <?php if($data['title']){ ?>
                    <h2 class="title"><?php echo wp_kses_post($data['title']); ?></h2>
                <?php } ?>
                <?php if($data['content']){ ?>
                    <p><?php echo wp_kses_post($data['content']); ?></p>
                <?php } ?>
            </div>
            <div class="button">
                <?php echo wp_kses_post( $btn ); ?>
            </div>
      </div>
</div>
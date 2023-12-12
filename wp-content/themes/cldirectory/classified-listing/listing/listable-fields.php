<?php
/**
 *
 * @var array $fields
 * @var int   $listing_id
 * @version       1.0.0
 *
 * @author        RadiusTheme
 * @package       classified-listing/templates
 */

use Rtcl\Models\RtclCFGField;
use radiustheme\CLDirectory\RDTheme; 
if ( count( $fields ) ) :
	ob_start();
	foreach ( $fields as $field ) :
		$field = new RtclCFGField( $field->ID ); 
		$value = $field->getFormattedCustomFieldValue( $listing_id );
		if ( $value ) :
			?>
            <li>
				<?php if ( $field->getIconClass() ): ?>
                    <i class='<?php echo esc_html( $field->getIconClass() ); ?>'></i>
				<?php else: ?>
                    <span class='listable-label'><?php echo esc_html( $field->getLabel().':' ); ?></span>
				<?php endif; ?>
                <span class='listable-value'>
                    <span class="value">
                    <?php
                    $value = strlen( $value ) == 1 ? '<span>0</span>' . $value : $value;
                    echo stripslashes_deep( $value );
                    ?>
                    </span>
                </span>
            </li>
		<?php endif;
	endforeach;

	$fields_html = ob_get_clean();
    $show_listing_custom_field = RDTheme::$options['show_listing_custom_fields'];
	if ( $fields_html && $show_listing_custom_field) {
		printf( '<div class="listable-items"><ul class="listing-features">%s</ul></div>', $fields_html );
	}
endif;

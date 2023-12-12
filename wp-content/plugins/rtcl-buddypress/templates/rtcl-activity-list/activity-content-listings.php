<?php
/**
 * Listing Activity
 *
 * @author     RadiusTheme
 * @package    classified-listing/templates
 * @version    1.0.0
 *
 * @var Rtcl\Models\Listing $listing
 */

if ( ! $listing ) {
	return;
}

?>
<div class="bd-press-listing-wraper list-view">
	<?php

	$img      = sprintf(
		"<div class='listing-thumb'><a href='%s' title='%s'>%s</a></div>",
		$listing->get_the_permalink(),
		esc_html( $listing->get_the_title() ),
		$listing->get_the_thumbnail( 'medium' )
	);
	$labels   = $listing->badges();
	$location = sprintf(
		'<li class="location"><i class="rtcl-icon rtcl-icon-location" aria-hidden="true"></i>%s</li>',
		$listing->the_locations( false )
	);

	$category = sprintf(
		'<li class="category"><i class="rtcl-icon rtcl-icon-tags" aria-hidden="true"></i>%s</li>',
		$listing->the_categories( false )
	);

	$price = sprintf( '<div class="listing-price">%s</div>', $listing->get_price_html() );

	if ( $category || $location ) {
		$listing_meta = sprintf(
			'<ul class="listing-meta">%s%s</ul>',
			$category,
			$location
		);
	}

	$title = sprintf(
		'<h3 class="listing-title rtcl-listing-title"><a href="%1$s" title="%2$s">%2$s</a></h3>',
		$listing->get_the_permalink(),
		esc_html( $listing->get_the_title() )
	);

	$excerpt             = get_the_excerpt( $listing->get_id() );
	$trimmed_content     = wp_trim_words( $excerpt, 20, '...' );
	$listing_description = sprintf(
		'<div class="rtcl-short-description"> %s </div>',
		wpautop( $trimmed_content )
	);

	$item_content = sprintf(
		'<div class="item-content">%s %s %s %s %s</div>',
		$labels,
		$title,
		$listing_meta,
		$listing_description,
		$price
	);
	printf( '%s%s', $img, $item_content );

	?>

</div>


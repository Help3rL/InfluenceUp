<?php 
namespace radiustheme\CLDirectory_Core;

use radiustheme\CLDirectory\Helper;
use radiustheme\CLDirectory\Listing_Functions;
use Rtcl\Helpers\Functions;
use RtclPro\Helpers\Fns;
use RtclPro\Controllers\Hooks\TemplateHooks as TemplateHooksPro;
use Rtcl\Controllers\Hooks\TemplateHooks;
$size = $data['thumbnail_size'] ? $data['thumbnail_size'] : 'rtcl-thumbnail';

$uniqueid = time() . rand( 1, 99 );
$count    = 0;



$gird_column_desktop = ( isset( $data['gird_column_desktop'] ) ? $data['gird_column_desktop'] : '4' );
$gird_column_tab     =  '6';
$gird_column_mobile  =  '6';
$col_class           = "col-lg-{$gird_column_desktop} col-md-{$gird_column_tab} col-sm-{$gird_column_mobile}";
?>

<div class="rtcl rt-el-listing-wrapper isotope-wrap" id="inner-isotope">
	<div class="filter-wrapper">
		<div class="isotope-classes-tab">
			<?php if ( $data['show_all_btn'] ) : ?>
				<a class="nav-item current" data-filter="*"><?php echo esc_html__( 'All', 'cldirectory-core' ); ?></a>
			<?php endif; ?>
			<?php foreach ( $data['navs'] as $key => $value ): ?>
				<a class="nav-item <?php echo ( ! $count && ! $data['show_all_btn'] ) ? 'current' : '';
				$count ++; ?>" data-filter=".<?php echo esc_attr( $key . $uniqueid ); ?>"><?php echo esc_html( $value ); ?></a>
			<?php endforeach; ?>
		</div>
	</div>
	<div class="rtcl-listings rtcl-grid-view">
		<div class="row featuredContainer">
			<?php foreach ( $data['queries'] as $key => $query ): ?>
				<?php if ( $query->have_posts() ) : ?>
					<?php while ( $query->have_posts() ) : $query->the_post(); ?>
						<?php
						global $listing;
						$phone = get_post_meta( $listing->get_id(), 'phone', true );
						?>
						<div class="<?php echo esc_attr( $col_class . ' ' . $key . $uniqueid ); ?>">
							<div class="listing-box listing-item rtcl-listing-item">
								<div class="listing-thumb">
									<?php Helper::get_formated_business_hour($listing); ?>
									<?php 
									$the_thumbnail = $listing->get_the_thumbnail( $size );
									echo wp_kses_post($the_thumbnail);
									if ( $listing && Fns::is_enable_mark_as_sold() && Fns::is_mark_as_sold( $listing->get_id() ) ) {
										echo '<span class="rtcl-sold-out">' . apply_filters( 'rtcl_sold_out_banner_text', esc_html__( "Sold Out", 'clcar' ) ) . '</span>';
									}
									?>
									<div class="listing-action-items">
										<?php  if($data['author_display']=='yes'){
											Helper::get_listing_author_info( $listing,false); 
										}
										?>
										<?php if($data['listing_action_visibility']=='yes'){ ?>
											<div class="cldirectory-listing-action">
												<?php if ( Fns::is_enable_compare()) {
													$compare_ids    = ! empty( $_SESSION['rtcl_compare_ids'] ) ? $_SESSION['rtcl_compare_ids'] : [];
													$selected_class = '';
													if ( is_array( $compare_ids ) && in_array( $listing->get_id(), $compare_ids ) ) {
														$selected_class = ' selected';
													}
													?>
													<a class="rtcl-compare <?php echo esc_attr( $selected_class ); ?>" href="#" data-listing_id="<?php echo absint( $listing->get_id() ) ?>">
														<i class="compare-cl-icon"></i>
													</a>
												<?php } ?>
												<?php 
													echo Listing_Functions::get_favourites_link( $listing->get_id() ); 
													
												?>
												<?php if ( Fns::is_enable_quick_view()) { ?>
													<div class="rtcl-quick-view rtcl-btn"
													data-listing_id="<?php echo absint( $listing->get_id() ) ?>"><i
															class="eye-alt-cl-icon"></i></div>
												<?php } ?>			
											</div>
										<?php } ?>
									</div>
								</div>
								<div class="item-content">
									<?php 
										echo '<h3 class="' . esc_attr( apply_filters( 'rtcl_listing_loop_title_classes', 'listing-title rtcl-listing-title' ) ) . '"><a href="' . $listing->get_the_permalink() . '">' . $listing->get_the_title() . '</a></h3>';
										
									?>	
									<?php if($data['label_display']=='yes'){
										$listing->the_badges();
									}
									?>
									<ul class="entry-meta">
										<?php if ( $listing->has_location() && $data['location_visibility']=='yes'): ?>
											<li><i class="map-marker-cl-icon"></i><?php $listing->the_locations(); ?></li>
										<?php endif; ?>
										<?php if($data['phone_visibility']=='yes'){ ?>
										    <li><i class="phone-call-cl-icon"></i><a href="tel:<?php echo esc_attr($phone); ?>"><?php echo esc_html($phone); ?></a></li>
										<?php } ?>
										<?php if($data['date_visibility']=='yes'){ ?>
											<li class="updated"><i class="far fa-clock"></i><?php $listing->the_time(); ?></li>
										<?php } ?>
										<?php if($data['views_display']=='yes'){ ?>
											<li class="rt-views">
												<i class="far fa-eye"></i>
												<?php echo sprintf( _n( "%s view", "%s views", $listing->get_view_counts(), 'cldirectory' ),
													number_format_i18n( $listing->get_view_counts() ) ); ?>
											</li>
										<?php } ?>
									</ul>
									<?php if($data['content_visibility']=='yes'){
										
										$content = strip_shortcodes( wp_strip_all_tags( $listing->get_the_content() ) );
										$content = wp_trim_words( $content, $data['content_limit'], '' );
										?>
										<div class="listing-excerpt"> <?php echo wp_kses_post( $content ); ?></div>
										
									<?php }
									?>	
									<?php if (rtcl()->has_pro()) {
											TemplateHooksPro::loop_item_listable_fields();
										}
									?>
									<div class="listing-footer">
										<?php if($data['cat_display']=='yes'){
											Helper::get_listing_category($listing);
										}
										?>
										<?php ?>
											<div class="listing-price">
												<?php Functions::get_template( 'listing/loop/price' ); ?>
											</div>
										<?php  ?>
									</div>
								</div>
								
							</div>
						</div>
					<?php endwhile; ?>
				<?php endif; ?>
				<?php wp_reset_postdata(); ?>
			<?php endforeach; ?>
		</div>
	</div>
</div>
<?php
if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
	?>
    <script>jQuery('.featuredContainer').isotope();</script>
	<?php
}


<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\CLDirectory_Core;

use radiustheme\CLDirectory\Helper;
use \WP_Query;


$args = [
	'post_type'           => 'post',
	'ignore_sticky_posts' => 1,
	'posts_per_page'      => $data['post_limit'],
	'post_status'         => 'publish',
];
if ( $data['orderby'] ) {
	$args['orderby'] = $data['orderby'];
}
if ( $data['order'] ) {
	$args['order'] = $data['order'];
}

if ( $data['post_source'] == 'by_category' && $data['categories'] ) :
	$args = wp_parse_args(
		[
			'cat' => $data['categories'],
		]
		, $args );
endif;

if ( $data['post_source'] == 'by_tags' && $data['tags'] ) :
	$args = wp_parse_args(
		[
			'tag_slug__in' => $data['tags'],
		]
		, $args );
endif;

if ( $data['post_source'] == 'by_id' && $data['post_id'] ) :
	$post_ids         = explode( ',', $data['post_id'] );
	$args['post__in'] = $post_ids;
endif;

if ( $data['exclude'] ) :
	$excluded_ids         = explode( ',', $data['exclude'] );
	$args['post__not_in'] = $excluded_ids;
endif;


if ( $data['offset'] ) {
	$args['offset'] = $data['offset'];
}

$query  = new \WP_Query( $args );

?>
<div class="rt-el-post-wrapper blog-grid <?php echo esc_attr($data['layout']); ?>">
	<div class="row">
	<?php $count = 1; 
		if ( $query->have_posts() ) : ?>
		<?php while ( $query->have_posts() ) : $query->the_post();?>
			<?php if ( $count == 1 ) { ?>
				<div class="col-lg-6">
					<div class="rt-post-item rt-post-grid">
						<?php if(has_post_thumbnail()){ ?>
							<div class="rt-post-thumb">
								<?php $thumb= get_the_post_thumbnail( get_the_ID(), 'rdtheme-size1');?>
								<a href="<?php the_permalink(); ?>">
									<?php echo wp_kses_post($thumb); ?>
								</a>									
							</div>
						<?php } ?>
						<div class="rt-post-content">
							<ul class="entry-meta">
								<?php if ( $data['cat_visibility'] ) : ?>
									<li class="category-meta">
										<?php echo get_the_category_list( esc_html_x( ', ', 'Used between list items, there is a space after the comma.', 'cldirectory-core' ) );
										?>
									</li>
								<?php endif; ?>
								<?php if ( $data['reading_time_visibility'] ) : ?>
									<li class="reading-time">
									<?php echo Helper::reading_time_count(get_the_content()); ?>
									</li>
                                <?php endif; ?>

								<?php if ( $data['comment_visibility'] ) : ?>
									<li class="comments-meta">
											<span class="post-comments-number">
											<?php
											comments_popup_link(
												esc_html__( 'No Comment', 'cldirectory-core' ),
												esc_html__( '1 Comment', 'cldirectory-core' ),
												esc_html__( '% Comments', 'cldirectory-core' ), '',
												esc_html__( 'Comments are Closed', 'cldirectory-core' )
											); ?>
										</span>
									</li>
								<?php endif; ?>
							</ul>
							<?php
								$title = strip_shortcodes( wp_strip_all_tags( get_the_title() ) );
								$title = wp_trim_words( $title, $data['title_limit'], '' );
							?>
							<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php echo wp_kses_post( $title ); ?></a></h3>
							<?php if ( 'visible' == $data['content_visibility'] ) : ?>
								<div class="post-excerpt">
									<?php
									$content = strip_shortcodes( wp_strip_all_tags( get_the_content() ) );
									$content = wp_trim_words( $content, $data['content_limit'], '' );
									echo wp_kses_post( $content );
									?>
								</div>
							<?php endif; ?>
							<ul class="footer-meta">
								<?php if ( $data['date_visibility'] ) : ?>
									<li class="post-date">
										<?php
											if ( 'default' == $data['p_date_format'] ) {
												?>
												<i class="calendar-cl-icon"></i><?php the_time( get_option( 'date_format' ) ); ?>
												<?php
											} else {
												?>
												<i class="calendar-cl-icon"></i><?php echo class_exists( 'radiustheme\CLDirectory\Helper' ) ? Helper::time_elapsed_string()
													: get_the_time( get_option( 'date_format' ) ); ?>
												<?php
											}
										?>
									</li>
								<?php endif; ?>
								<?php if ( $data['author_visibility'] ) : ?>
									<li class="author-meta <?php echo esc_attr( $data['author_avatar'] ) ?>">
										<span class="author vcard">
											<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
												<?php
												if ( 'image' == $data['author_avatar'] ) {
													echo get_avatar( get_the_author_meta( 'user_email' ), 35 );
												} elseif ( 'icon' == $data['author_avatar'] ) {
													echo '<i class="user-alt-cl-icon"></i>';
												}
												echo esc_html( get_the_author() );
												?>
											</a>
										</span>
									</li>
								<?php endif; ?>
							</ul>
						</div>
					</div>
				</div>
			<?php } ?>
			
			<?php if ( $count == 2 ) { ?>
				<div class="col-lg-6">
				<div class="row">
			<?php } ?>

				<?php if ( $count > 1 ) { ?>
					<div class="col-12">
						<div class="rt-post-item rt-post-list">
							<div class="rt-post-content-wrapper">
								<?php if(has_post_thumbnail()){ ?>
									<div class="rt-post-thumb">
										<?php $thumb= get_the_post_thumbnail( get_the_ID(), 'thumbnail');?>
										<a href="<?php the_permalink(); ?>">
										<?php echo wp_kses_post($thumb); ?>
										</a>			
									</div>
								<?php } ?>
								<div class="rt-post-content">
									<ul class="entry-meta">
										<?php if ( $data['cat_visibility'] ) : ?>
											<li class="category-meta">
												<?php echo get_the_category_list( esc_html_x( ', ', 'Used between list items, there is a space after the comma.', 'cldirectory-core' ) );
												?>
											</li>
										<?php endif; ?>
										<?php if ( $data['reading_time_visibility'] ) : ?>
											<li class="reading-time">
											<?php echo Helper::reading_time_count(get_the_content()); ?>
											</li>
										<?php endif; ?>

										<?php if ( $data['comment_visibility'] ) : ?>
											<li class="comments-meta">
													<i class="icon-comment" aria-hidden="true"></i><span class="post-comments-number">
													<?php
													comments_popup_link(
														esc_html__( 'No Comment', 'cldirectory-core' ),
														esc_html__( '1 Comment', 'cldirectory-core' ),
														esc_html__( '% Comments', 'cldirectory-core' ), '',
														esc_html__( 'Comments are Closed', 'cldirectory-core' )
													); ?>
												</span>
											</li>
										<?php endif; ?>
									</ul>
									<?php
										$title = strip_shortcodes( wp_strip_all_tags( get_the_title() ) );
										$title = wp_trim_words( $title, $data['title_limit'], '' );
									?>
							        <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php echo wp_kses_post( $title ); ?></a></h3>
									<ul class="footer-meta">
										<?php if ( $data['date_visibility'] ) : ?>
											<li class="post-date">
												<?php
													if ( 'default' == $data['p_date_format'] ) {
														?>
														<i class="calendar-cl-icon"></i><?php the_time( get_option( 'date_format' ) ); ?>
														<?php
													} else {
														?>
														<i class="calendar-cl-icon"></i><?php echo class_exists( 'radiustheme\CLDirectory\Helper' ) ? Helper::time_elapsed_string()
															: get_the_time( get_option( 'date_format' ) ); ?>
														<?php
													}
												?>
											</li>
										<?php endif; ?>
										<?php if ( $data['author_visibility'] ) : ?>
											<li class="author-meta <?php echo esc_attr( $data['author_avatar'] ) ?>">
												<span class="author vcard">
													<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
														<?php
														if ( 'image' == $data['author_avatar'] ) {
															echo get_avatar( get_the_author_meta( 'user_email' ), 35 );
														} elseif ( 'icon' == $data['author_avatar'] ) {
															echo '<i class="user-alt-cl-icon"></i>';
														}
														echo esc_html( get_the_author() );
														?>
													</a>
												</span>
											</li>
										<?php endif; ?>
									</ul>
								</div>
							</div>
							
						</div>	
					</div>
				<?php } ?>
			<?php $count++; endwhile;?>

				</div>
				</div>
	<?php endif;?>
	</div>
	<?php wp_reset_postdata(); ?>
</div>



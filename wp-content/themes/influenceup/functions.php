<?php

/**
 * InfluenceUp functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package InfluenceUp
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function influenceup_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on InfluenceUp, use a find and replace
		* to change 'influenceup' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('influenceup', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'influenceup'),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'influenceup_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'influenceup_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function influenceup_content_width()
{
	$GLOBALS['content_width'] = apply_filters('influenceup_content_width', 640);
}
add_action('after_setup_theme', 'influenceup_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function influenceup_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'influenceup'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'influenceup'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'influenceup_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function influenceup_scripts()
{
	wp_enqueue_style('influenceup-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_enqueue_style('influenceup-styles', get_template_directory_uri() . '/css/style.css', array(), _S_VERSION);
	wp_style_add_data('influenceup-style', 'rtl', 'replace');

	wp_enqueue_script('influenceup-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);
	wp_enqueue_script('influenceup-header-js', get_template_directory_uri() . '/js/header/header.js', array(), _S_VERSION, true);
	wp_enqueue_script('influenceup-header-mobile-js', get_template_directory_uri() . '/js/header/header-mobile.js', array(), _S_VERSION, true);
	wp_enqueue_script('influenceup-switch-js', get_template_directory_uri() . '/js/header/switch.js', array(), _S_VERSION, true);
	wp_localize_script('influenceup-header-js', 'influenceup', array(
		'templateUrl' => get_template_directory_uri() . '/inc/img/arrow'
	));
	//Search
	wp_enqueue_script('ajax-search', get_template_directory_uri() . '/js/header/ajax-search.js', array('jquery'), null, true);
	wp_localize_script('ajax-search', 'ajaxsearch', array(
		'ajaxurl' => admin_url('admin-ajax.php'),
		'nonce' => wp_create_nonce('live_search_nonce')
	));

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
	//slick
	wp_enqueue_style('slick-css', get_template_directory_uri() . '/assets/slick/slick.css', array(), false, 'all');
	wp_enqueue_style('slick-theme-css', get_template_directory_uri() . '/assets/slick/slick-theme.css', array(), false, 'all');
	wp_enqueue_script('slick-js', get_template_directory_uri() . '/assets/slick/slick.min.js', array('jquery'), false, true);
	//Carousels
	wp_enqueue_script('hero-section-slider.js', get_template_directory_uri() . '/js/hero-section-slider.js', array('jquery', 'slick-js'), false, true);
	wp_enqueue_script('rtcl-categories-carousel.js', get_template_directory_uri() . '/js/rtcl-categories-carousel.js', array('jquery', 'slick-js'), false, true);
	wp_enqueue_script('rtcl-listings-carousel.js', get_template_directory_uri() . '/js/rtcl-categories-carousel-listings.js', array('jquery', 'slick-js'), false, true);
	wp_enqueue_script('rtcl-categories-carousel-listings.js', get_template_directory_uri() . '/js/rtcl-categories-carousel.js', array('jquery', 'slick-js'), false, true);

	//Animated lines
	wp_enqueue_script('animated-lines-js', get_template_directory_uri() . '/js/animated-lines.js', array('jquery'), true);
}
add_action('wp_enqueue_scripts', 'influenceup_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}
/**
 * Add arrows to header menu item if have submenu 
 */
function add_menu_arrows($item_output, $item, $depth, $args)
{
	if ($args->theme_location == 'menu-1') {
		if (in_array('menu-item-has-children', $item->classes)) {
			$item_output .= '<span class="nav-arrow"></span>';
		}
	}
	return $item_output;
}
add_filter('walker_nav_menu_start_el', 'add_menu_arrows', 10, 4);

//Add count to menu sub menu categories
function add_category_count_to_menu($items, $args)
{
	foreach ($items as &$item) {
		//Checking menu categories are from 'rtcl category'
		if ($item->type === 'taxonomy' && $item->object === 'rtcl_category') {
			$term_id = $item->object_id; // Getting term ID
			$term = get_term($term_id, 'rtcl_category'); //Getting terms object

			//Checking if term not WP_Error and exist
			if (!is_wp_error($term) && $term) {
				//Check if menu item category name is "Visos kategorijos"
				if ($item->title === "Visos kategorijos") {
					//Get all categories records sum
					$terms = get_terms(['taxonomy' => 'rtcl_category', 'hide_empty' => false]);
					$all_categories_count = array_sum(wp_list_pluck($terms, 'count'));
					$item->title .= ' (' . $all_categories_count . ')';
				} else {
					$category_count = $term->count; //Get term record count
					$item->title .= ' (' . $category_count . ')'; //Add count to menu item
				}
			}
		}
	}
	return $items;
}
add_filter('wp_nav_menu_objects', 'add_category_count_to_menu', 10, 2);


// Ajax search actions
add_action('wp_ajax_data_fetch', 'data_fetch');
add_action('wp_ajax_nopriv_data_fetch', 'data_fetch');

function data_fetch()
{
	//saugumo tikrinimas
	check_ajax_referer('live_search_nonce', 'nonce');

	$query = new WP_Query(array(
		'posts_per_page' => -1,
		's' => esc_attr($_POST['keyword']),
		'post_type' => array('rtcl_listing')
	));
	if ($query->have_posts()) :
		echo '<ul>';
		while ($query->have_posts()) : $query->the_post();
			echo '<li><a href="' . esc_url(get_permalink()) . '">' . get_the_title() . '</a></li>';
		endwhile;
		echo '</ul>';
		wp_reset_postdata();
	else :
		echo '<p>Niekas nerasta.</p>';
	endif;

	die();
}


//display current year
function year_shortcode()
{
	$year = date_i18n('Y');
	return $year;
}
add_shortcode('year', 'year_shortcode');


function add_menu_parent_class($items)
{
	$parents = array();
	foreach ($items as $item) {
		if ($item->menu_item_parent && $item->menu_item_parent > 0) {
			$parents[] = $item->menu_item_parent;
		}
	}
	foreach ($items as $item) {
		if (in_array($item->ID, $parents)) {
			$item->classes[] = 'menu-parent-item'; // Čia yra mūsų pridėta klasė
		}
	}
	return $items;
}
add_filter('wp_nav_menu_objects', 'add_menu_parent_class');


function disable_admin_bar_for_non_admins()
{
	if (!current_user_can('administrator')) {
		add_filter('show_admin_bar', '__return_false');
	}
}
add_action('after_setup_theme', 'disable_admin_bar_for_non_admins');


function get_listing_image_url($post_id)
{
	$attachments = get_posts([
		'post_type' => 'attachment',
		'posts_per_page' => 1,
		'post_parent' => $post_id,
		'orderby' => 'menu_order',
		'order' => 'ASC'
	]);

	if (!empty($attachments)) {
		return wp_get_attachment_image_url($attachments[0]->ID, 'full'); // Return full img url
	}
	return ''; // If not return empty
}

//ACF options page
if (function_exists('acf_add_options_page')) {
	acf_add_options_page(array(
		'page_title' 	=> 'Footer Settings',
		'menu_title'	=> 'Footer Settings',
		'menu_slug' 	=> 'footer-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}
if (function_exists('acf_add_options_page')) {
	acf_add_options_page(array(
		'page_title'    => 'Listings Settings',
		'menu_title'    => 'Listings Settings',
		'menu_slug'     => 'listings-settings',
		'capability'    => 'edit_posts',
		'redirect'      => false
	));
}


// Custom listing rating
function custom_add_rating_to_listing()
{
	global $post;
	$categories = get_the_terms($post->ID, 'rtcl_category');
	$average_rating = get_post_meta($post->ID, 'rtrs_avg_rating', true);
	$review_count = get_post_meta($post->ID, '_rtcl_review_count', true);
?>
	<p><?php echo $categories ? esc_html($categories[0]->name) : 'No Category'; ?></p>
	<div class="service-rating">
		<i class="fa fa-star <?php echo ($average_rating > 0) ? 'filled' : ''; ?>"></i>
		<span class="rating-average"><?php echo esc_html($average_rating); ?></span>
		<?php if ($review_count >= 0) : ?>
			<span>(<?php echo esc_html($review_count); ?>)</span>
		<?php endif; ?>
	</div>
<?php
}

add_action('rtcl_listing_loop_item', 'custom_add_rating_to_listing', 79);

//Rtcl categories carousel shortcode
function rtcl_categories_carousel_shortcode()
{
	ob_start();
?>
	<div class="categories-carousel-parent">
		<div class="rtcl-categories-container listing-page-carousel">
			<?php $llistings_categories_carousel_title = get_field('listings_categories_carousel_title', 'option'); ?>
			<div class="carousel-headings-container">
				<h3><?php echo esc_html($llistings_categories_carousel_title); ?></h3>
				<div>
					<button type="button" class="carousel-prev">
						<?php echo file_get_contents(get_stylesheet_directory() . '/inc/img/arrow/arrow-left.svg'); ?>
					</button>
					<button type="button" class="carousel-next">
						<?php echo file_get_contents(get_stylesheet_directory() . '/inc/img/arrow/arrow-right.svg'); ?>
					</button>
				</div>
			</div>
			<div class="carousel-cards-listings">
				<?php
				$categories = get_categories(array(
					'taxonomy' => 'rtcl_category',
					'hide_empty' => false,
				));
				if (!empty($categories)) : ?>
					<?php foreach ($categories as $category) : ?>
						<?php
						//Check, has category children
						$child_categories = get_categories(array(
							'taxonomy' => 'rtcl_category',
							'hide_empty' => false,
							'parent' => $category->term_id,
						));

						if (!empty($child_categories)) {
							continue;
						}
						$category_link = get_term_link($category);
						$category_image_id = get_term_meta($category->term_id, '_rtcl_image', true);
						$category_image_url = wp_get_attachment_url($category_image_id);
						?>
						<a href="<?php echo esc_url($category_link); ?>">
							<div class="category-card">
								<?php if ($category_image_url) : ?>
									<img class="category-img" src="<?php echo esc_url($category_image_url); ?>" alt="<?php echo esc_attr($category->name); ?>">
								<?php endif; ?>
								<h3 class="carousel-category-name"><?php echo esc_html($category->name); ?></h3>
							</div>
						</a>
					<?php endforeach; ?>
				<?php else : ?>
					<p>Nėra kategorijų.</p>
				<?php endif; ?>
			</div>
		</div>
		<?php if (is_category() || is_tax('rtcl_category')) : ?>
			<h1 class="category-title">
				<?php single_cat_title(); ?>
			</h1>
		<?php endif; ?>
	</div>
<?php
	return ob_get_clean();
}
add_shortcode('rtcl_categories_carousel', 'rtcl_categories_carousel_shortcode');


function custom_rtcl_pagination()
{
	global $wp_query;

	if ($wp_query->max_num_pages <= 1) {
		return;
	}

	$big = 999999999; // Unic number
	$current_page = max(1, get_query_var('paged'));
	$total_pages = $wp_query->max_num_pages;
	$prev_svg = file_get_contents(get_stylesheet_directory() . '/inc/img/arrow/arrow-left-light.svg');
	$next_svg = file_get_contents(get_stylesheet_directory() . '/inc/img/arrow/arrow-right-light.svg');

	echo '<nav class="rtcl-pagination"><ul>';

	// Left arrow
	if ($current_page > 1) {
		echo '<li><a href="' . esc_url(get_pagenum_link($current_page - 1)) . '" class="prev service-carousel-prev">' . $prev_svg . '</a></li>';
	}

	// Pages number
	echo '<li><span class="page-info">Puslapis ' . $current_page . ' iš ' . $total_pages . '</span></li>';

	// Right arrow
	if ($current_page < $total_pages) {
		echo '<li><a href="' . esc_url(get_pagenum_link($current_page + 1)) . '" class="next service-carousel-next">' . $next_svg . '</a></li>';
	}

	echo '</ul></nav>';
}
add_action('rtcl_after_listing_loop', 'custom_rtcl_pagination', 10);

<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\CLDirectory_Core;

use Elementor\Plugin;
use radiustheme\CLDirectory\Helper;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

require_once CLDIRECTORY_CORE_BASE_DIR . '/elementor/controls/traits-icons.php';

// Elementor default widget control
require_once __DIR__ . '/el-extend.php';

class Custom_Widget_Init {

	public function __construct() {
		add_action( 'elementor/widgets/register', [ $this, 'init' ] );
		add_action( 'elementor/elements/categories_registered', [ $this, 'widget_category' ] );
		add_action( 'elementor/icons_manager/additional_tabs', [ $this, 'cldirectory_fontello_icons_tab' ] );
		add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'editor_style' ] );
	}

	public function editor_style() {
		$img = plugins_url( 'icon.png', __FILE__ );

		wp_add_inline_style( 'elementor-editor', '.elementor-element .icon .rdtheme-el-custom{content: url(' . $img . ');width: 28px;}' );
		wp_add_inline_style( 'elementor-editor', '.elementor-panel .select2-container {min-width: 100px !important; min-height: 30px !important;}' );
		wp_add_inline_style( 'elementor-editor', '.elementor-panel .elementor-control-type-heading .elementor-control-title {color: #93013d !important}' );
	}

	//load editor script
	// public function editor_scripts() {
	// 	wp_enqueue_script( 'select2' );
	// 	wp_enqueue_script( 'rt-el-editor-script', CLDIRECTORY_CORE_BASE_URL . 'elementor/assets/el_editor.js', [ 'jquery' ], CLDIRECTORY_CORE, true );
	// }

	//load frontend script
	// public function rt_load_scripts() {
	// 	wp_enqueue_script( 'select2' );
	// 	wp_enqueue_script( 'elementor-script', CLDIRECTORY_CORE_BASE_URL . 'elementor/assets/scripts.js', [ 'jquery' ], CLDIRECTORY_CORE, true );
	// }

	public function init() {
		require_once __DIR__ . '/base.php';

		// dirname => classname /@dev
		$widgets = [
			'section-title'     => 'Title',
			'video-icon'        => 'Video_Icon',
			'post'              => 'Post',
			'rt-button'         => 'Button',
			'info-box'          => 'Info_Box',
			'testimonial'       => 'Testimonial_Carousel',
			'parallax'          => 'RT_Parallax',
			'contact-info'      => 'RT_Contact_Info',
			'call-to-action'    => 'RT_Call_To_Action',
			'rt-pricing-tab'    => 'Rt_Pricing_Tab',
			'rt-about'    		=> 'Rt_About',
			'rt-count'    		=> 'Rt_Count',
			'rt-image'    		=> 'RT_Image',
		];

		if ( class_exists( 'Rtcl' ) ) {
			$widgets += [
				'rt-listing-tab'        => 'RT_Listing_Tab',
				'listing-locations' => 'Listing_Locations',
				'single-listing-location' => 'Single_Listing_Location',
				'single-listing-category' => 'Single_Listing_Category',
			];
		}

		foreach ( $widgets as $dirname => $class ) {
			$template_name = '/elementor-custom/' . $dirname . '/class.php';
			if ( file_exists( STYLESHEETPATH . $template_name ) ) {
				$file = STYLESHEETPATH . $template_name;
			} elseif ( file_exists( TEMPLATEPATH . $template_name ) ) {
				$file = TEMPLATEPATH . $template_name;
			} else {
				$file = __DIR__ . '/' . $dirname . '/class.php';
			}

			require_once $file;

			$classname = __NAMESPACE__ . '\\' . $class;
			Plugin::instance()->widgets_manager->register( new $classname );
		}
	}


	public function cldirectory_fontello_icons_tab($tabs=[]){
		$fontello_icons = ElementorIconTrait::fontello_icons();

		$tabs['cldirectory-fontello-icons'] = [
			'name'          => 'cldirectory-fontello-icons',
			'label'         => esc_html__( 'Custom Icons', 'cldirectory-core' ),
			'labelIcon'     => 'fab fa-elementor',
			'prefix'        => '',
			'displayPrefix' => '',
			'url'           => Helper::custom_font_css( 'cl-icons' ),
			'icons'         => $fontello_icons,
			'ver'           => '1.1',
		];

		return $tabs;
	}
	public function widget_category( $class ) {
		$id         = CLDIRECTORY_CORE_THEME_PREFIX . '-widgets'; // Category /@dev
		$properties = [
			'title' => __( 'RadiusTheme Elements', 'cldirectory-core' ),
		];

		Plugin::$instance->elements_manager->add_category( $id, $properties );
	}
	
}

new Custom_Widget_Init();
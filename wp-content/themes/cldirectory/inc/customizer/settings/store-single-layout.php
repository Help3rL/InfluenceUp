<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\CLDirectory\Customizer\Settings;

use radiustheme\CLDirectory\Customizer\Controls\Customizer_Image_Radio_Control;
use radiustheme\CLDirectory\Customizer\RDTheme_Customizer;
use radiustheme\CLDirectory\Helper;

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class RDTheme_Store_Single_Layout_Settings extends RDTheme_Customizer {

	public function __construct() {
		parent::instance();
		$this->populated_default_data();
		// Register Page Controls
		add_action( 'customize_register', [ $this, 'register_store_single_layout_controls' ] );
	}

	public function register_store_single_layout_controls( $wp_customize ) {
		

		// Top bar
		$wp_customize->add_setting( 'store_single_top_bar',
			[
				'default'           => $this->defaults['store_single_top_bar'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_text_sanitization',
			]
		);
		$wp_customize->add_control( 'store_single_top_bar', [
			'type'    => 'select',
			'section' => 'store_single_layout_section',
			'label'   => esc_html__( 'Top Bar', 'cldirectory' ),
			'choices' => [
				'default' => esc_html__( 'Default', 'cldirectory' ),
				'on'      => esc_html__( 'Enable', 'cldirectory' ),
				'off'     => esc_html__( 'Disable', 'cldirectory' ),
			],
		] );
		// Header Layout
		$wp_customize->add_setting( 'store_single_header_style',
			[
				'default'           => $this->defaults['store_single_header_style'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_text_sanitization',
			]
		);
		$wp_customize->add_control( 'store_single_header_style', [
			'type'    => 'select',
			'section' => 'store_single_layout_section',
			'label'   => esc_html__( 'Header Layout', 'cldirectory' ),
			'choices' => Helper::get_cldirectory_header_list(),
		] );



		// Transparent Header
		$wp_customize->add_setting( 'store_single_tr_header',
			[
				'default'           => $this->defaults['store_single_tr_header'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_text_sanitization',
			]
		);
		$wp_customize->add_control( 'store_single_tr_header', [
			'type'    => 'select',
			'section' => 'store_single_layout_section',
			'label'   => esc_html__( 'Transparent Header', 'cldirectory' ),
			'choices' => [
				'default' => esc_html__( 'Default', 'cldirectory' ),
				'on'      => esc_html__( 'Enable', 'cldirectory' ),
				'off'     => esc_html__( 'Disable', 'cldirectory' ),
			],
		] );

		//Header width
		$wp_customize->add_setting( 'store_single_header_width', [
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'rttheme_text_sanitization',
			'default'           => $this->defaults['store_single_header_width'],
		] );

		$wp_customize->add_control( 'store_single_header_width', [
			'type'    => 'select',
			'section' => 'store_single_layout_section', // Add a default or your own section
			'label'   => __( 'Header Width', 'cldirectory' ),
			'choices' => [
				'default'   => __( 'Default', 'cldirectory' ),
				'box-width' => __( 'Box width', 'cldirectory' ),
				'fullwidth' => __( 'Fullwidth', 'cldirectory' ),
			],
		] );

		// Breadcrumb
		$wp_customize->add_setting( 'store_single_breadcrumb',
			[
				'default'           => $this->defaults['store_single_breadcrumb'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_text_sanitization',
			]
		);
		$wp_customize->add_control( 'store_single_breadcrumb', [
			'type'    => 'select',
			'section' => 'store_single_layout_section',
			'label'   => esc_html__( 'Breadcrumb', 'cldirectory' ),
			'choices' => [
				'default' => esc_html__( 'Default', 'cldirectory' ),
				'on'      => esc_html__( 'Enable', 'cldirectory' ),
				'off'     => esc_html__( 'Disable', 'cldirectory' ),
			],
		] );
		// Footer Layout
		$wp_customize->add_setting( 'store_single_footer_style',
			[
				'default'           => $this->defaults['store_single_footer_style'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_text_sanitization',
			]
		);
		$wp_customize->add_control( 'store_single_footer_style', [
			'type'    => 'select',
			'section' => 'store_single_layout_section',
			'label'   => esc_html__( 'Footer Layout', 'cldirectory' ),
			'choices' => [
				'default' => esc_html__( 'Default', 'cldirectory' ),
				'1'       => esc_html__( 'Layout 1', 'cldirectory' ),
				'2'       => esc_html__( 'Layout 2', 'cldirectory' ),
			],
		] );

		// Padding Top
		$wp_customize->add_setting( 'store_single_padding_top',
			[
				'default'           => $this->defaults['store_single_padding_top'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_text_sanitization',
			]
		);
		$wp_customize->add_control( 'store_single_padding_top',
			[
				'label'       => esc_html__( 'Content Padding Top', 'cldirectory' ),
				'description' => esc_html__( 'Listing Archive Content Padding Top(Use px unit after digit)', 'cldirectory' ),
				'section'     => 'store_single_layout_section',
				'type'        => 'text',
			]
		);
		// Padding Bottom
		$wp_customize->add_setting( 'store_single_padding_bottom',
			[
				'default'           => $this->defaults['store_single_padding_bottom'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_text_sanitization',
			]
		);
		$wp_customize->add_control( 'store_single_padding_bottom',
			[
				'label'       => esc_html__( 'Content Padding Bottom', 'cldirectory' ),
				'description' => esc_html__( 'Listing Archive Content Padding Bottom(Use px unit after digit)', 'cldirectory' ),
				'section'     => 'store_single_layout_section',
				'type'        => 'text',
			]
		);
	}

}

/**
 * Initialise our Customizer settings only when they're required
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	new RDTheme_Store_Single_Layout_Settings();
}

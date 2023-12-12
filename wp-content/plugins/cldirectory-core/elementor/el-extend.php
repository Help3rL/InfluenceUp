<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\CLDirectory_Core;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class RT_Extende_Element_Widget {

	public function __construct() {
		add_action( 'elementor/widget/before_render_content', [ $this, 'cldirectory_elementor_extend_widget_render' ] );
		add_action( 'elementor/element/button/section_style/after_section_start', [ $this, 'custom_button_control' ], 10, 2 );

		add_action( 'elementor/element/image-carousel/section_style_image/after_section_start', function( $element, $args ) {
			$element->add_control(
				'image_gray_option',
				[
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label' => esc_html__( 'Image Gray Style', 'cldirectory-core' ),
					'label_on' => esc_html__( 'Show', 'cldirectory-core' ),
					'label_off' => esc_html__( 'Hide', 'cldirectory-core' ),
					'return_value' => 'has-gray',
					'default' => 'has-gray',
				]
			);

		}, 10, 2 );

		add_action( 'elementor/element/section/section_background/before_section_end', [ $this, 'add_elementor_section_background_controls' ] );
		add_action( 'elementor/frontend/section/before_render', [ $this, 'render_elementor_section_parallax_background' ] );

		/**Accordion extra control*/
		add_action( 'elementor/element/accordion/section_title_style/after_section_start', [ $this, 'custom_accordion_control' ], 10, 2 );

		add_action( 'elementor/element/accordion/section_toggle_style_title/after_section_start', [ $this, 'custom_accordion_title_control' ], 10, 2 );

	}
	/**Accordion Custom Control start*/
	function custom_accordion_title_control($accordion,$args){
		$accordion->add_control(
			'title_active_background',
			[
				'label' => esc_html__( 'Active Background', 'cldirectory-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion .elementor-accordion-item .elementor-active.elementor-tab-title' => 'background-color: {{VALUE}};',
				],
			]
		);
		$accordion->add_control(
			'title_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'cldirectory-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion .elementor-accordion-item .elementor-tab-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .elementor-widget-accordion .elementor-tab-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
	}

	function custom_accordion_control($accordion, $args){
		$accordion->add_responsive_control(
			'accordion_spacing',
			[
				'label'   => __( 'Accordion Spacing', 'cldirectory-core' ),
				'type'    => \Elementor\Controls_Manager::SLIDER,
				
				'size_units' => [ 'px','%'],
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion .elementor-accordion-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
	}
	/**Accordion custom control end */


	function add_elementor_section_background_controls( \Elementor\Element_Section $section ) {
		$section->add_control(
			'rt_section_parallax',
			[
				'label'        => __( 'Parallax', 'cldirectory-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_off'    => __( 'Off', 'cldirectory-core' ),
				'label_on'     => __( 'On', 'cldirectory-core' ),
				'default'      => 'no',
				'prefix_class' => 'rt-parallax-bg-',
			]
		);

		$section->add_control(
			'rt_parallax_speed',
			[
				'label'     => __( 'Speed', 'cldirectory-core' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 0.1,
				'max'       => 5,
				'step'      => 0.1,
				'default'   => 0.5,
				'condition' => [
					'rt_section_parallax' => 'yes',
				],
			]
		);

		$section->add_control(
			'rt_parallax_transition',
			[
				'label'        => __( 'Parallax Transition off?', 'cldirectory-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_off'    => __( 'on', 'cldirectory-core' ),
				'label_on'     => __( 'Off', 'cldirectory-core' ),
				'default'      => 'off',
				'return_value' => 'off',
				'prefix_class' => 'rt-parallax-transition-',
				'condition'    => [
					'rt_section_parallax' => 'yes',
				],
			]
		);
	}

	// Render section background parallax
	function render_elementor_section_parallax_background( \Elementor\Element_Base $element ) {
		if ( 'section' === $element->get_name() ) {
			if ( 'yes' === $element->get_settings_for_display( 'rt_section_parallax' ) ) {
				$rt_background = $element->get_settings_for_display( 'background_image' );
				if ( ! isset( $rt_background ) ) {
					return;
				}
				$rt_background_URL = $rt_background['url'];
				$data_speed        = $element->get_settings_for_display( 'rt_parallax_speed' );

				$element->add_render_attribute( '_wrapper', [
					'data-speed'    => $data_speed,
					'data-bg-image' => $rt_background_URL,
				] );
			}
		}
	}

	function custom_button_control( $button, $args ) {
		$button->add_control( 'animation_btn_enable',
			[
				'label'        => __( 'Animation Button', 'cldirectory-core' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => 'enable',
				'options'      => [
					'enable'  => __( 'Enable', 'cldirectory-core' ),
					'disable' => __( 'Disable', 'cldirectory-core' ),
				],
				'prefix_class' => 'elementor-button-animation-',
			]
		);

		$button->add_control(
			'button_animation_color',
			[
				'label'     => __( 'Hover Animation Color', 'cldirectory-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-button::after' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'animation_btn_enable' => 'enable',
				],
			]
		);
	}


	/**
	 * render custom control output
	 *
	 */
	public function cldirectory_elementor_extend_widget_render( $widget ) {
		/**
		 * Adding a new attribute to our button
		 *
		 * @param  \Elementor\Widget_Base  $button
		 */
		
		if ( 'image-carousel' === $widget->get_name() ) {
			// Get the settings
			$settings = $widget->get_settings();
			// Adding our type as a class to the button
			if ( $settings['image_gray_option'] ) {
				$widget->add_render_attribute( 'carousel-wrapper',
					[
						'class' => $settings['image_gray_option'],
					], true );
			}
		}
		
	}


}

new RT_Extende_Element_Widget();

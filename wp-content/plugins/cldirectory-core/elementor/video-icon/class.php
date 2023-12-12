<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\CLDirectory_Core;

use Elementor\Controls_Manager;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Video_Icon extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Video', 'cldirectory-core' );
		$this->rt_base = 'rt-video-icon';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'sec_general',
			[
				'label' => esc_html__( 'General', 'cldirectory-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'image',
			[
				'label' => __( 'Choose Image', 'cldirectory-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'video_url',
			[
				'label' => __( 'Video URL', 'cldirectory-core' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
					'categories' => [
						TagsModule::POST_META_CATEGORY,
						TagsModule::URL_CATEGORY,
					],
				],
				'placeholder' => __( 'Enter your URL', 'cldirectory-core' ),
				'default' => 'https://www.youtube.com/watch?v=XHOmBV4js_E',
				'label_block' => true,
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => __( 'Button Text', 'cldirectory-core' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter button text', 'cldirectory-core' ),
				'default' => __( 'Play Video', 'cldirectory-core' ),
				'label_block' => true,
			]
		);

		$this->add_responsive_control(
			'wrap_height',
			[
				'label' => __( 'Wrapper Height', 'cldirectory-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'vh' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
					'vh' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'text_align',
			[
				'label' => __( 'Alignment', 'cldirectory-core' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'cldirectory-core' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'cldirectory-core' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'cldirectory-core' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Horizontal Align', 'cldirectory-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'Default', 'cldirectory-core' ),
					'flex-start' => __( 'Start', 'cldirectory-core' ),
					'center' => __( 'Center', 'cldirectory-core' ),
					'flex-end' => __( 'End', 'cldirectory-core' ),
					'space-between' => __( 'Space Between', 'cldirectory-core' ),
					'space-around' => __( 'Space Around', 'cldirectory-core' ),
					'space-evenly' => __( 'Space Evenly', 'cldirectory-core' ),
				],
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper' => 'justify-content: {{VALUE}}; display:flex',
				],
			]
		);

		$this->add_responsive_control(
			'vertical_align',
			[
				'label' => __( 'Vertical Align', 'cldirectory-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'Default', 'cldirectory-core' ),
					'flex-start' => __( 'Start', 'cldirectory-core' ),
					'center' => __( 'Center', 'cldirectory-core' ),
					'flex-end' => __( 'End', 'cldirectory-core' ),
					'space-between' => __( 'Space Between', 'cldirectory-core' ),
					'space-around' => __( 'Space Around', 'cldirectory-core' ),
					'space-evenly' => __( 'Space Evenly', 'cldirectory-core' ),
				],
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper' => 'align-items: {{VALUE}}; display:flex',
				],
			]
		);

		$this->end_controls_section();


		//Play Button Style
		//=============================================
		$this->start_controls_section(
			'button_style',
			[
				'label' => esc_html__( 'Play Button Style', 'cldirectory-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'button_size',
			[
				'label' => __( 'Button Size', 'cldirectory-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 3,
						'step' => 0.1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 1,
				],
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper .icon-box' => 'transform: scale({{SIZE}});',
				],
			]
		);

		$this->add_control(
			'button_spacing',
			[
				'label' => __( 'Button Spacing', 'cldirectory-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper .icon-box' => 'margin-right:{{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
			'button_style_tabs'
		);

		$this->start_controls_tab(
			'button_style_normal_tab',
			[
				'label' => __( 'Normal', 'cldirectory-core' ),
			]
		);

		$this->add_control(
			'button_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Color', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper .video-popup-icon i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Background Color', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper .video-popup-icon' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'button_style_hover_tab',
			[
				'label' => __( 'Hover', 'cldirectory-core' ),
			]
		);

		$this->add_control(
			'button_color_hover',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Color Hover', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper .video-popup-icon:hover i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_bg_color_hover',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Background Color Hover', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper .video-popup-icon:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'text_style',
			[
				'label' => __( 'Text Style', 'cldirectory-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'label' => __( 'Text Typography', 'cldirectory-core' ),
				'selector' => '{{WRAPPER}} .rt-video-icon-wrapper .button-text',
			]
		);

		$this->add_control(
			'text_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Text Color', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper .button-text' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'text_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Text Hover Color', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper .button-text:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$data = $this->get_settings();
		$template = 'view-1';
		$this->rt_template( $template, $data );
	}

}
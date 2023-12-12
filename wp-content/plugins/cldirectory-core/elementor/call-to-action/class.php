<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\CLDirectory_Core;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class RT_Call_To_Action extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT CTA', 'cldirectory-core' );
		$this->rt_base = 'rt-call-to-action';
		parent::__construct( $data, $args );
	}
    
	protected function register_controls() {
		/*
		 * General Options
		 * ************************************
		 */

		$this->start_controls_section(
			'sec_general',
			[
				'label' => esc_html__( 'General', 'cldirectory-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'layout',
			[
				'label'   => esc_html__( 'Style', 'cldirectory-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [
					'style1' => __( 'Style 1', 'cldirectory-core' ),
					'style2' => __( 'Style 2', 'cldirectory-core' ),
				],
			]
		);
        $this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'cldirectory-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'Looking For A Place Where You Want To Go?',
			]
		);
        $this->add_control(
			'content',
			[
				'label'       => esc_html__( 'Content', 'cldirectory-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default'     => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quis bibendum id consequat',
			]
		);
		
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'           => 'background',
				'label'          => __( 'Background', 'clproperty-core' ),
				'types'          => [ 'classic', 'gradient', 'video' ],
				'fields_options' => [
					'background' => [
						'default' => 'classic',
						'label' => esc_html__( 'Background', 'cldirectory-core' ),
					],
					'image' => [
						'default' => [
							'url' =>  \Elementor\Utils::get_placeholder_image_src(),
						],
					]

				],
				'selector'       => '{{WRAPPER}} .call-to-action-wrap-layout .cta-content-wrapper',
				'condition'      =>[
					'layout'    =>['style1']
				]
			]
		);
		$this->add_control(
			'btntext',
			[
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Button Text', 'cldirectory-core' ),
				'default' => 'Lorem Ipsum',
			]
		);

		$this->add_control(
			'btnurl',
			[
				'type'        => Controls_Manager::URL,
				'label'       => esc_html__( 'Button URL', 'cldirectory-core' ),
				'placeholder' => 'https://your-link.com',
			]
		);
		$this->end_controls_section();

		/*
		 * Top Sub Title
		 * ************************************
		 */

		$this->start_controls_section(
			'style_settings',
			[
				'label' => esc_html__( ' Style Settings', 'cldirectory-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
			'title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Title Color', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .call-to-action-wrap-layout .title' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'content_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Content Color', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .call-to-action-wrap-layout p' => 'color: {{VALUE}}',
				],
			]
		);
        
		$this->add_control(
			'radius',
			[
				'label' => esc_html__( 'Box Border Radius', 'cldirectory-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .call-to-action-wrap-layout .cta-content-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .call-to-action-wrap-layout-2 .footer-cta-bg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'padding',
			[
				'label' => esc_html__( 'Box Padding', 'cldirectory-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .call-to-action-wrap-layout .cta-content-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .call-to-action-wrap-layout-2 .footer-cta-bg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_type',
				'label'    => esc_html__( 'Title Typography', 'cldirectory-core' ),
				'selector' => '{{WRAPPER}} .call-to-action-wrap-layout .title',
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'content_type',
				'label'    => esc_html__( 'Content Typography', 'cldirectory-core' ),
				'selector' => '{{WRAPPER}} .call-to-action-wrap-layout p',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_box',
			[
				'label' => __( 'Button', 'cldirectory-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'box_border_radius',
			[
				'label'     => __( 'Border Radius', 'cldirectory-core' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .call-to-action-wrap-layout .rt-btn-style' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'btn_typo',
				'label'    => esc_html__( 'Typography', 'cldirectory-core' ),
				'selector' => '{{WRAPPER}} .call-to-action-wrap-layout .rt-btn-style',
			]
		);

		$this->start_controls_tabs( 'cat_box_style' );

		// Normal tab.
		$this->start_controls_tab(
			'box_style_normal',
			[
				'label' => __( 'Normal', 'cldirectory-core' ),
			]
		);

		// Normal background color.
		$this->add_control(
			'box_style_normal_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => __( 'Background Color', 'cldirectory-core' ),
				'separator' => '',
				'selectors' => [
					'{{WRAPPER}} .call-to-action-wrap-layout .rt-btn-style' => 'background-color: {{VALUE}};',
				],
			]
		);

		// Normal Text color.
		$this->add_control(
			'box_style_normal_text_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => __( 'Text Color', 'cldirectory-core' ),
				'separator' => '',
				'selectors' => [
					'{{WRAPPER}} .call-to-action-wrap-layout .rt-btn-style' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		// Hover tab.
		$this->start_controls_tab(
			'box_style_hover',
			[
				'label' => __( 'Hover', 'cldirectory-core' ),
			]
		);

		// Hover background color.
		$this->add_control(
			'box_style_hover_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => __( 'Background Color', 'cldirectory-core' ),
				'separator' => '',
				'selectors' => [
					'{{WRAPPER}} .call-to-action-wrap-layout .rt-btn-style:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		// Hover Text color.
		$this->add_control(
			'box_style_hover_title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => __( 'Text Color', 'cldirectory-core' ),
				'separator' => '',
				'selectors' => [
					'{{WRAPPER}} .call-to-action-wrap-layout .rt-btn-style:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();


    }
	protected function render() {
		$data     = $this->get_settings();

		$template = 'view-1'; 

		if($data['layout']=='style2'){
			$template = 'view-2';
		}
		
		$this->rt_template( $template, $data );
	}

}
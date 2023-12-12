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

class Title extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'Section Title', 'cldirectory-core' );
		$this->rt_base = 'rt-title';
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
			'section_style',
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
			'section_title_tag',
			[
				'label'   => esc_html__( 'Section Title Tag', 'cldirectory-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => [
					'h1' => __( 'H1', 'cldirectory-core' ),
					'h2' => __( 'H2', 'cldirectory-core' ),
					'h3' => __( 'H3', 'cldirectory-core' ),
					'h4' => __( 'H4', 'cldirectory-core' ),
					'h5' => __( 'H5', 'cldirectory-core' ),
					'h6' => __( 'H6', 'cldirectory-core' ),
				],
			]
		);
		$this->add_control(
			'top_sub_title',
			[
				'label'       => esc_html__( 'Section Sub Title', 'cldirectory-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'Find Your Places Where Like To Go',
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Section Title', 'cldirectory-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'default'     => "We're going to became partners for the long run",
				'description' => esc_html__( "If you would like to use different color then separate word by <span>.", 'cldirectory-core' ),
			]
		);

		$this->add_control(
			'description',
			[
				'label'   => esc_html__( 'Description', 'cldirectory-core' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => 'Lorem Ipsum has been standard daand scrambled. Rimply dummy text of the printing and typesetting industry',
			]
		);  

		$this->add_responsive_control(
			'alignment',
			[
				'label'     => __( 'Alignment', 'cldirectory-core' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => __( 'Left', 'cldirectory-core' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'cldirectory-core' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'cldirectory-core' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper' => 'text-align: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'title_shape',
			[
				'label'        => __( 'Title Shape', 'cldirectory-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Enable', 'cldirectory-core' ),
				'label_off'    => __( 'Disable', 'cldirectory-core' ),
				'return_value' => 'yes',
				'default'      => false,
				'condition'	   =>[
					'section_style' =>['style1']
				]
			]
		);
		$this->add_control(
			'title_shape_style',
			[
				'label'   => esc_html__( 'Style', 'cldirectory-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [
					'style1' => __( 'Style 1', 'cldirectory-core' ),
					'style2' => __( 'Style 2', 'cldirectory-core' ),
				],
				'condition' =>[
					'title_shape'=>['yes']
				]
			]
		);
		$this->end_controls_section();


		/*
		 * Top Sub Title
		 * ************************************
		 */

		$this->start_controls_section(
			'top_title_settings',
			[
				'label' => esc_html__( ' Sub Title Settings', 'cldirectory-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'top_title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .rt-section-subtitle' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'top_title_two_typo',
				'label'    => esc_html__( 'Typography', 'cldirectory-core' ),
				'selector' => '{{WRAPPER}} .section-title-wrapper .rt-section-subtitle',
			]
		);

		$this->add_responsive_control(
			'top_title_margin',
			[
				'label'              => __( 'Margin', 'cldirectory-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'allowed_dimensions' => 'vertical',
				'default'            => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false,
				],
				'selectors'          => [
					'{{WRAPPER}} .section-title-wrapper .rt-section-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		// Main Title Settings
		//==============================================================
		$this->start_controls_section(
			'title_settings',
			[
				'label' => esc_html__( 'Section Title Settings', 'cldirectory-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .rt-section-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'label'    => esc_html__( 'Typography', 'cldirectory-core' ),
				'selector' => '{{WRAPPER}} .section-title-wrapper .rt-section-title',
			]
		);

		$this->add_responsive_control(
			'heading_margin',
			[
				'label'              => __( 'Margin', 'cldirectory-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'allowed_dimensions' => 'vertical',
				'default'            => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false,
				],
				'selectors'          => [
					'{{WRAPPER}} .section-title-wrapper .title-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		// Description Settings
		//==============================================================
		$this->start_controls_section(
			'description_settings',
			[
				'label' => esc_html__( 'Description Settings', 'cldirectory-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typo',
				'label'    => esc_html__( 'Typography', 'cldirectory-core' ),
				'selector' => '{{WRAPPER}} .section-title-wrapper .section-description,{{WRAPPER}} .section-title-wrapper .section-description h2',
			]
		);

		$this->add_control(
			'description_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .section-description' => 'color: {{VALUE}}',
					'{{WRAPPER}} .section-title-wrapper .section-description h2' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'description_margin',
			[
				'label'              => __( 'Margin', 'cldirectory-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'allowed_dimensions' => 'vertical',
				'default'            => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false,
				],
				'selectors'          => [
					'{{WRAPPER}} .section-title-wrapper .section-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					'{{WRAPPER}} .section-title-wrapper .section-description h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

    }

	protected function render() {
		$data     = $this->get_settings();
		$template = 'view-1';

		if($data['section_style']=='style2'){
			$template='view-2';
		}
		$this->rt_template( $template, $data );
	}

}
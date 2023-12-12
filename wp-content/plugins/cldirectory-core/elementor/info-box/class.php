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

class Info_Box extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'Info Box', 'cldirectory-core' );
		$this->rt_base = 'rt-info-box';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'rt_info_box',
			[
				'label' => esc_html__( 'Info Box Settings', 'cldirectory-core' ),
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
			'icon_type',
			[
				'label'   => __( 'Icon Type', 'cldirectory-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'icon',
				'options' => [
					'icon'  => __( 'Icon', 'cldirectory-core' ),
					'image' => __( 'Image', 'cldirectory-core' ),
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'cldirectory-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Wide Range of Brands',
				'label_block' => true,
			]
		);

		$this->add_control(
			'content',
			[
				'label'       => esc_html__( 'Content', 'cldirectory-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => 'Lorem ipsum dolor sit amet, conseetur adipiscing elit. In dolor libero eu potenti massa cursus.',
				'label_block' => true,
			]
		);
		$this->add_control(
			'count_number',
			[
				'label'       => esc_html__( 'Count Number', 'cldirectory-core' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => '1',
				'condition'   =>[
					'layout'  =>['style1']
				]
			]
		);
		$this->add_control(
			'info_icon',
			[
				'label'            => __( 'Choose Icon', 'cldirectory-core' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => [
					'value'   => 'briefcase-cl-icon',
					'library' => 'fa-solid',
				],
				'condition'        => [
					'icon_type' => [ 'icon' ],
				],
			]
		);

		$this->add_control(
			'show_readmore_btn',
			[
				'label'        => __( 'Read More Button', 'cldirectory-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'cldirectory-core' ),
				'label_off'    => __( 'Off', 'cldirectory-core' ),
				'return_value' => 'is-readmore',
			]
		);

		$this->add_control(
			'read_more_btn_text',
			[
				'label'       => esc_html__( 'Button Text', 'cldirectory-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Read More',
				'label_block' => true,
				'condition'   => [
					'show_readmore_btn' => [ 'is-readmore' ],
				],
			]
		);

		$this->add_control(
			'link',
			[
				'label'         => __( 'Link', 'cldirectory-core' ),
				'type'          => \Elementor\Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'cldirectory-core' ),
				'show_external' => true,
				'dynamic'       => [
					'active' => true,
				],
				'default'       => [
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				],
			]
		);

		$this->add_control(
			'image_icon',
			[
				'label'     => __( 'Choose Image', 'cldirectory-core' ),
				'type'      => \Elementor\Controls_Manager::MEDIA,
				'default'   => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'icon_type' => [ 'image' ],
				],
			]
		);

		$this->add_responsive_control(
			'text_align',
			[
				'label'     => __( 'Alignment', 'cldirectory-core' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
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
					'{{WRAPPER}} .rt-info-box .choose-box  *' => 'text-align: {{VALUE}} !important',
				],
				'toggle'    => true,
				'condition' =>[
					'layout' =>['style1']
				]
			]
		);



		$this->end_controls_section();

		// Title Settings
		//==============================================================
		$this->start_controls_section(
			'title_settings',
			[
				'label' => esc_html__( 'Title Settings', 'cldirectory-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .choose-box .content-holder .entry-title'   => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-info-box .choose-box .content-holder .entry-title a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Hover Color', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .choose-box .content-holder .entry-title:hover'   => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .rt-info-box .choose-box .content-holder .entry-title a:hover' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'cldirectory-core' ),
				'selector' => '{{WRAPPER}} .rt-info-box .choose-box .content-holder .entry-title',
			]
		);

		$this->add_responsive_control(
			'title_spacing',
			[
				'label'              => __( 'Title Spacing', 'cldirectory-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'allowed_dimensions' => 'vertical',
				'selectors'          => [
					'{{WRAPPER}} .rt-info-box .choose-box .content-holder .entry-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		// Sub Title
		//==============================================================
		$this->start_controls_section(
			'content_settings',
			[
				'label'     => esc_html__( 'Content Settings', 'cldirectory-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .choose-box .entry-description' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'content_typography',
				'label'    => esc_html__( 'Typography', 'cldirectory-core' ),
				'selector' => '{{WRAPPER}} .rt-info-box .choose-box .entry-description',
			]
		);

		$this->add_responsive_control(
			'content_spacing',
			[
				'label'              => __( 'Content Spacing', 'cldirectory-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'allowed_dimensions' => 'vertical',
				'selectors'          => [
					'{{WRAPPER}} .rt-info-box .choose-box .entry-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		// Icon Settings
		//==============================================================
		$this->start_controls_section(
			'icon_settings',
			[
				'label'     => esc_html__( 'Icon Settings', 'cldirectory-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'icon_type' => [ 'icon' ],
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Icon Font Size', 'cldirectory-core' ),
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 20,
						'max'  => 90,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .choose-box .icon-holder i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-info-box .choose-box svg' => 'width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};',
				],

			]
		);
		$this->add_control(
			'icon_colo2r',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .choose-box .icon-holder i'=> 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-info-box .icon-holder svg path'=> 'fill: {{VALUE}}',
				],
				'condition' =>[
					'layout' =>['style2']
				]
			]
		);
		$this->start_controls_tabs(
			'icon_style_tabs',[
				'condition' =>[
					'layout' =>['style1']
				]
			]
			
		);

		$this->start_controls_tab(
			'icon_normal_tab',
			[
				'label' => __( 'Normal', 'cldirectory-core' ),
			]
		);
		$this->add_control(
			'icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .choose-box .icon-holder i'=> 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-info-box .icon-holder svg path'=> 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'counter_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Counter Color', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .choose-box .icon-holder .count'=> 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-info-box .icon-holder svg path'=> 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'counter_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Counter Background', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .choose-box .icon-holder .count'=> 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'counter_border',
				'selector' => '{{WRAPPER}} .rt-info-box .choose-box .icon-holder .count',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'icon_bg',
				'label'    => __( 'Icon Shape', 'cldirectory-core' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rt-info-box .choose-box .icon-holder .icon',
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Icon Background', 'cldirectory-core' ),
					],
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'icon_shape_bg',
				'label'    => __( 'Icon Shape', 'cldirectory-core' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rt-info-box .choose-box .icon-holder .icon:before',
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Icon Shape Background', 'cldirectory-core' ),
					],
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_hover_tab',
			[
				'label' => __( 'Hover', 'cldirectory-core' ),
			]
		);

		$this->add_control(
			'icon_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Hover Color', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .choose-box:hover .icon-holder i'=> 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-info-box .icon-holder:hover svg path'=> 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'counter_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Counter Color', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .choose-box:hover .icon-holder .count'=> 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-info-box .choose-box:hover .icon-holder svg path'=> 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'counter_bg_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Counter Background', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .choose-box:hover .icon-holder .count'=> 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'counter_hover_border',
				'selector' => '{{WRAPPER}} .rt-info-box .choose-box:hover .icon-holder .count',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'icon_hover_bg',
				'label'    => __( 'Icon Shape', 'cldirectory-core' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rt-info-box .choose-box:hover .icon-holder .icon',
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Icon Background', 'cldirectory-core' ),
					],
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'icon_shape_bg_hover',
				'label'    => __( 'Icon Shape', 'cldirectory-core' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rt-info-box .choose-box:hover .icon-holder .icon:before',
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Icon Shape Background', 'cldirectory-core' ),
					],
				],
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// Image Settings
		//==============================================================

		$this->start_controls_section(
			'image_settings',
			[
				'label'     => esc_html__( 'Image Settings', 'cldirectory-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'icon_type' => [ 'image' ],
				],
			]
		);

		$this->add_responsive_control(
			'image_wrap_margin_bottom',
			[
				'label'      => __( 'Image Wrapper Margin Bottom', 'cldirectory-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .icon-holder' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_icon_width',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Image Width', 'cldirectory-core' ),
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 10,
						'max'  => 200,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .icon-holder img' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
				],
				'condition'  => [
					'icon_type' => [ 'image' ],
				],
			]
		);

		$this->add_responsive_control(
			'image_wrap_width',
			[
				'label'      => __( 'Image Wrapper Width / Height', 'cldirectory-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 50,
						'max'  => 200,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .icon-holder .icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'image_border_radius',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Border Radius', 'cldirectory-core' ),
				'size_units' => [ '%' ],
				'range'      => [
					'%' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .icon-holder .img-wrap img' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);




		//End Icon Style Tab

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
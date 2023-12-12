<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\CLDirectory_Core;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class RT_Image extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Image', 'cldirectory-core' );
		$this->rt_base = 'rt-image';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'rt_image_settings',
			[
				'label' => esc_html__( 'RT Image Settings', 'cldirectory-core' ),
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
					'style3' => __( 'Style 3', 'cldirectory-core' ),
				],
			]
		);
        $this->add_control(
			'rt_image',
			[
				'label'     => __( 'Choose Image', 'cldirectory-core' ),
				'type'      => \Elementor\Controls_Manager::MEDIA,
				'default'   => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'rt_image2',
			[
				'label'     => __( 'Choose Image', 'cldirectory-core' ),
				'type'      => \Elementor\Controls_Manager::MEDIA,
				'default'   => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' =>[
					'layout' =>['style3']
				]
			]
		);
		
		$this->add_control(
			'rt_image_shape',
			[
				'label'     => __( 'Choose Image Shape', 'cldirectory-core' ),
				'type'      => \Elementor\Controls_Manager::MEDIA,
				'default'   => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' =>[
					'layout' =>['style2']
				]
			]
		);
		$this->add_control(
			'rt_image3',
			[
				'label'     => __( 'Choose Image', 'cldirectory-core' ),
				'type'      => \Elementor\Controls_Manager::MEDIA,
				'default'   => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' =>[
					'layout' =>['style3']
				]
			]
		);
		$this->add_control(
			'image_url',
			[
				'label'         => __( 'URL', 'cldirectory-core' ),
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

        $this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'rt_image_size', 
				'default' => 'full',
			]
		);
		$this->add_control(
			'image1_show',
			[
				'label'        => __( 'Image 1 Visibility', 'cldirectory-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'cldirectory-core' ),
				'label_off'    => __( 'Hide', 'cldirectory-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition' =>[
					'layout' =>['style3']
				]
			]
		);
		$this->add_control(
			'image2_show',
			[
				'label'        => __( 'Image 2 Visibility', 'cldirectory-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'cldirectory-core' ),
				'label_off'    => __( 'Hide', 'cldirectory-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition' =>[
					'layout' =>['style3']
				]
			]
		);
		$this->add_control(
			'image3_show',
			[
				'label'        => __( 'Image 3 Visibility', 'cldirectory-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'cldirectory-core' ),
				'label_off'    => __( 'Hide', 'cldirectory-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition' =>[
					'layout' =>['style3']
				]
			]
		);
		$this->end_controls_section();

		/**Image 1 Positioning Settings */

		$this->start_controls_section(
			'rt_image_positioning',
			[
				'label' => esc_html__( 'Image 1 Positioning', 'cldirectory-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
				'condition' =>[
					'layout' =>['style3']
				]
			]
		);

		$this->add_responsive_control(
			'image1_position1',
			[
				'label'   => __( 'Image Position 1', 'cldirectory-core' ),
				'type'    => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -300,
						'max' => 1000,
					],
					'%'=>[
						'min' => -50,
						'max' => 100,
					]
				],
				'size_units' => [ 'px','%'],
				'selectors' => [
					'{{WRAPPER}} .rt-image-addon-wrapper.style3 .image-list li:nth-child(1)' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'image1_position2',
			[
				'label'   => __( 'Image Position 2', 'cldirectory-core' ),
				'type'    => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -300,
						'max' => 1000,
					],
					'%'=>[
						'min' => -50,
						'max' => 100,
					]
				],
				'size_units' => [ 'px','%'],
				'selectors' => [
					'{{WRAPPER}} .rt-image-addon-wrapper.style3 .image-list li:nth-child(1)' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'image1_rotation',
			[
				'label'   => __( 'Image 1 rotation', 'cldirectory-core' ),
				'type'    => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -300,
						'max' => 1000,
					],
				],
				'size_units' => [ ],
				'selectors' => [
					'{{WRAPPER}} .rt-image-addon-wrapper.style3 .image-list li:nth-child(1) img' => 'transform: rotate({{SIZE}}deg);;',
				],
			]
		);
		$this->add_responsive_control(
			'image1_index',
			[
				'label'   => __( 'z-index', 'cldirectory-core' ),
				'type'    => Controls_Manager::NUMBER,
				'selectors' => [
					'{{WRAPPER}} .rt-image-addon-wrapper.style3 .image-list li:nth-child(1)' => 'z-index:{{VALUE}}',
				],
			]
		);
		$this->end_controls_section();


		/**Image 2 Positioning Settings */

		$this->start_controls_section(
			'rt_image_2_positioning',
			[
				'label' => esc_html__( 'Image 2 Positioning', 'cldirectory-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
				'condition' =>[
					'layout' =>['style3']
				]
			]
		);

		$this->add_responsive_control(
			'image2_position1',
			[
				'label'   => __( 'Image Position 1', 'cldirectory-core' ),
				'type'    => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -300,
						'max' => 1000,
					],
					'%'=>[
						'min' => -50,
						'max' => 100,
					]
				],
				'size_units' => [ 'px','%'],
				'selectors' => [
					'{{WRAPPER}} .rt-image-addon-wrapper.style3 .image-list li:nth-child(2)' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'image2_position2',
			[
				'label'   => __( 'Image Position 2', 'cldirectory-core' ),
				'type'    => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -300,
						'max' => 1000,
					],
					'%'=>[
						'min' => -50,
						'max' => 100,
					]
				],
				'size_units' => [ 'px','%'],
				'selectors' => [
					'{{WRAPPER}} .rt-image-addon-wrapper.style3 .image-list li:nth-child(2)' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'image2_rotation',
			[
				'label'   => __( 'Image 2 rotation', 'cldirectory-core' ),
				'type'    => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -300,
						'max' => 1000,
					],
				],
				'size_units' => [ ],
				'selectors' => [
					'{{WRAPPER}} .rt-image-addon-wrapper.style3 .image-list li:nth-child(2) img' => 'transform: rotate({{SIZE}}deg);;',
				],
			]
		);
		$this->add_responsive_control(
			'image2_index',
			[
				'label'   => __( 'z-index', 'cldirectory-core' ),
				'type'    => Controls_Manager::NUMBER,
				'selectors' => [
					'{{WRAPPER}} .rt-image-addon-wrapper.style3 .image-list li:nth-child(2)' => 'z-index:{{VALUE}}',
				],
			]
		);
		$this->end_controls_section();

		/**Image 3 Positioning Settings */

		$this->start_controls_section(
			'rt_image_3_positioning',
			[
				'label' => esc_html__( 'Image 3 Positioning', 'cldirectory-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
				'condition' =>[
					'layout' =>['style3']
				]
			]
		);

		$this->add_responsive_control(
			'image3_position1',
			[
				'label'   => __( 'Image Position 1', 'cldirectory-core' ),
				'type'    => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -300,
						'max' => 1000,
					],
					'%'=>[
						'min' => -50,
						'max' => 100,
					]
				],
				'size_units' => [ 'px','%'],
				'selectors' => [
					'{{WRAPPER}} .rt-image-addon-wrapper.style3 .image-list li:nth-child(4)' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'image4_position2',
			[
				'label'   => __( 'Image Position 2', 'cldirectory-core' ),
				'type'    => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -300,
						'max' => 1000,
					],
					'%'=>[
						'min' => -50,
						'max' => 100,
					]
				],
				'size_units' => [ 'px','%'],
				'selectors' => [
					'{{WRAPPER}} .rt-image-addon-wrapper.style3 .image-list li:nth-child(4)' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'image3_rotation',
			[
				'label'   => __( 'Image 3 rotation', 'cldirectory-core' ),
				'type'    => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -300,
						'max' => 1000,
					],
				],
				'size_units' => [ ],
				'selectors' => [
					'{{WRAPPER}} .rt-image-addon-wrapper.style3 .image-list li:nth-child(4) img' => 'transform: rotate({{SIZE}}deg);;',
				],
			]
		);
		$this->add_responsive_control(
			'image4_index',
			[
				'label'   => __( 'z-index', 'cldirectory-core' ),
				'type'    => Controls_Manager::NUMBER,
				'selectors' => [
					'{{WRAPPER}} .rt-image-addon-wrapper.style3 .image-list li:nth-child(4)' => 'z-index:{{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'rt_shape_positioning',
			[
				'label' => esc_html__( 'Shape Positioning', 'cldirectory-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
				'condition' =>[
					'layout' =>['style3']
				]
			]
		);

		$this->add_responsive_control(
			'shape_position1',
			[
				'label'   => __( 'Shape Position 1', 'cldirectory-core' ),
				'type'    => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -300,
						'max' => 1000,
					],
					'%'=>[
						'min' => -50,
						'max' => 100,
					]
				],
				'size_units' => [ 'px','%'],
				'selectors' => [
					'{{WRAPPER}} .rt-image-addon-wrapper.style3 .image-list li:nth-child(3)' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'shape_position2',
			[
				'label'   => __( 'Shape Position 2', 'cldirectory-core' ),
				'type'    => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -300,
						'max' => 1000,
					],
					'%'=>[
						'min' => -50,
						'max' => 100,
					]
				],
				'size_units' => [ 'px','%'],
				'selectors' => [
					'{{WRAPPER}} .rt-image-addon-wrapper.style3 .image-list li:nth-child(3)' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'shape_display',
			[
				'label'        => esc_html__( 'Shape Display', 'cldirectory-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'cldirectory-core' ),
				'label_off'    => esc_html__( 'Off', 'cldirectory-core' ),
				'default'      => 'yes',
				'return_value' => 'yes',
			]
		);
		$this->end_controls_section();
		// Image Settings
		//==============================================================

		$this->start_controls_section(
			'image_settings_style',
			[
				'label'     => esc_html__( 'Image Style Settings', 'cldirectory-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' =>[
					'layout!' =>[
						'style3'
					]
				]
			]
		);

		$this->add_responsive_control(
			'image_icon_width',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Image Width', 'cldirectory-core' ),
				'size_units' => [ 'px'],
				'range'      => [
					'px' => [
						'min'  => 10,
						'max'  => 1200,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-image-addon-wrapper .image > img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_wrap_width',
			[
				'label'      => __( 'Image Height', 'cldirectory-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 10,
						'max'  => 1200,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-image-addon-wrapper .image > img' => 'height: {{SIZE}}{{UNIT}};object-fit:cover',
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
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-image-addon-wrapper .image > img' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

        $this->add_control(
			'shape_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Shape Color', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-image-addon-wrapper.style1 .image::after'=> 'background: {{VALUE}}',
				],
				'condition' =>[
					'layout'	=>['style1']
				]
			]
		);
		//End Icon Style Tab

		$this->end_controls_section();

		/**Image 1 Style Settings */

		$this->start_controls_section(
			'image1_settings_style',
			[
				'label'     => esc_html__( 'Image 1 Style Settings', 'cldirectory-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' =>[
					'layout' =>[
						'style3'
					]
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'image1_border',
				'selector' => '{{WRAPPER}} .rt-image-addon-wrapper.style3 .image-list li:nth-child(1) img',
			]
		);
		$this->add_control(
			'image1_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'cldirectory-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .rt-image-addon-wrapper.style3 .image-list li:nth-child(1) img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->end_controls_section();
		
		/**Image 2 Style Settings */

		$this->start_controls_section(
			'image2_settings_style',
			[
				'label'     => esc_html__( 'Image 2 Style Settings', 'cldirectory-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' =>[
					'layout' =>[
						'style3'
					]
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'image2_border',
				'selector' => '{{WRAPPER}} .rt-image-addon-wrapper.style3 .image-list li:nth-child(2) img',
			]
		);
		$this->add_control(
			'image2_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'cldirectory-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .rt-image-addon-wrapper.style3 .image-list li:nth-child(2) img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		/**Image 3 Style Settings */

		$this->start_controls_section(
			'image3_settings_style',
			[
				'label'     => esc_html__( 'Image 3 Style Settings', 'cldirectory-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' =>[
					'layout' =>[
						'style3'
					]
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'image3_border',
				'selector' => '{{WRAPPER}} .rt-image-addon-wrapper.style3 .image-list li:nth-child(4) img',
			]
		);
		$this->add_control(
			'image3_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'cldirectory-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .rt-image-addon-wrapper.style3 .image-list li:nth-child(4) img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		
	}

	protected function render() {
		$data     = $this->get_settings();
		switch ($data['layout']) {
			case 'style3':
				$template = 'view-3';
				break;
			case 'style2':
			$template = 'view-2';
			break;
			default:
			$template = 'view-1';
			break;
		}

		$this->rt_template( $template, $data );
	}

}
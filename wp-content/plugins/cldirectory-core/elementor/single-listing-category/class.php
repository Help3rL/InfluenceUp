<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\ClDirectory_Core;

use Elementor\Controls_Manager;
use Rtcl\Helpers\Functions;
use Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Single_Listing_Category extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Single Listing Category', 'cldirectory' );
		$this->rt_base = 'rt-single-listing-category';


		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		$args = [
			'taxonomy'   => rtcl()->category,
			'fields'     => 'id=>name',
			'hide_empty' => true,
		];
		if ( ! empty( $taxonomy ) ) {
			$args['taxonomy'] = sanitize_text_field( $taxonomy );
		}

		$terms = get_terms( $args );

		$category_dropdown = [];
		foreach ( $terms as $id => $name ) {
			$category_dropdown[ $id ] = $name;
		}


		$this->start_controls_section(
			'sec_general',
			[
				'label' => esc_html__( 'General', 'cldirectory' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);


		$this->add_control(
			'category',
			[
				'type'        => Controls_Manager::SELECT2,
				'label'       => esc_html__( 'Choose Category', 'cldirectory' ),
				'options'     => $category_dropdown,
				'multiple'    => false,
				'label_block' => true,
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
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'rt_image_size', 
				'default' => 'full',
			]
		);

		$this->end_controls_section();

		/*
		 * Icon Settings
		 * ===========================================
		 */
		$this->start_controls_section(
			'icon_settings',
			[
				'label' => esc_html__( 'Icon Settings', 'cldirectory' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'cat_icon_style',
			[
				'label'   => __( 'Icon Source', 'cldirectory' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default'       => __( 'Icon From Category', 'cldirectory' ),
					'default_image' => __( 'Image From Category', 'cldirectory' ),
				],
			]
		);


		$this->add_control(
			'thumb_divider',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'icon_font_size',
			[
				'label'      => __( 'Icon Font Size', 'cldirectory' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 20,
						'max'  => 60,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-listing-category-wrapper .categories-block  .categories-block-icon'   => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'cat_icon_style' => 'default',
				],
			]
		);

		$this->add_control(
			'icon_img_size',
			[
				'label'      => __( 'Image Size', 'cldirectory' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 30,
						'max'  => 200,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-listing-category-wrapper .categories-block  .categories-block-icon > img' => 'width: {{SIZE}}{{UNIT}};height:auto',
				],
				'condition'  => [
					'cat_icon_style' => 'default_image',
				],
			]
		);

		$this->end_controls_section();

		//Title Settings
		//=======================================

		$this->start_controls_section(
			'cat_title_setting',
			[
				'label' => esc_html__( 'Category Title Settings', 'cldirectory' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'cat_title_typography',
				'label'    => __( 'Typography', 'cldirectory' ),
				'selector' => '{{WRAPPER}} .categories-block .categories-block__cname',
			]
		);

		$this->add_control(
			'title_margin',
			[
				'label'              => __( 'Title Vertical Margin', 'cldirectory' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px', '%', 'em' ],
				'allowed_dimensions' => 'vertical',
				'default'            => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false,
				],
				'selectors'          => [
					'{{WRAPPER}} .categories-block .categories-block__cname' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		//Cat Title Settings
		//=======================================

		$this->start_controls_section(
			'cat_count_setting',
			[
				'label' => esc_html__( 'Category Count Settings', 'cldirectory' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'cat_count_typography',
				'label'    => __( 'Typography', 'cldirectory' ),
				'selector' => '{{WRAPPER}} .rt-listing-category-wrapper .categories-block__listing',
			]
		);

		$this->add_control(
			'cat_count_suffix',
			[
				'label'   => __( 'Count Suffix Text', 'cldirectory' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Listings', 'cldirectory' ),
			]
		);

		$this->end_controls_section();

		/*
		 * Box Settings
		 * ===========================================
		 */
		$this->start_controls_section(
			'box_settings',
			[
				'label' => esc_html__( 'Box Settings', 'cldirectory' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'box_margin',
			[
				'label'      => __( 'Margin Bottom', 'cldirectory' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 30,
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-listing-category-wrapper .categories-block' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_responsive_control(
			'box_height',
			[
				'type'            => \Elementor\Controls_Manager::SLIDER,
				'label'           => __( 'Image Height', 'cldirectory-core' ),
				'size_units'      => [ 'px' ],
				'range'           => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'devices'         => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => 290,
					'unit' => 'px',
				],
				'tablet_default'  => [
					'size' => 240,
					'unit' => 'px',
				],
				'mobile_default'  => [
					'size' => 220,
					'unit' => 'px',
				],
				'selectors'       => [
					'{{WRAPPER}} .rt-listing-category-wrapper .category-full-image > a img' => 'height: {{SIZE}}{{UNIT}};object-fit:cover;',
				],
			]
		);


		$this->add_control(
			'box_radius',
			[
				'label'      => __( 'Border Radius', 'cldirectory' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-listing-category-wrapper .categories-block' => 'border-radius: {{SIZE}}{{UNIT}};',
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
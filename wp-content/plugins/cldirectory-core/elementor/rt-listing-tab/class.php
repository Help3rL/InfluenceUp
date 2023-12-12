<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\CLDirectory_Core;

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Typography;
use Rtcl\Helpers\Functions;
use Rtcl\Models\RtclCFGField;
use \WP_Query;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class RT_Listing_Tab extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Listing Tab', 'cldirectory-core' );
		$this->rt_base = 'rt-listing-tab';

		$this->rt_translate = [
			'cols'        => [
				'12' => __( '1 Columns', 'cldirectory-core' ),
				'6'  => __( '2 Columns', 'cldirectory-core' ),
				'4'  => __( '3 Columns', 'cldirectory-core' ),
				'3'  => __( '4 Columns', 'cldirectory-core' ),
			],
		];

		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		$terms             = get_terms( [ 'taxonomy' => 'rtcl_category', 'fields' => 'id=>name' ] );
		$category_dropdown = [];

		

		foreach ( $terms as $id => $name ) {
			$category_dropdown[ $id ] = $name;
		}

		$this->start_controls_section(
			'sec_general',
			[
				'label' => esc_html__( 'General', 'cldirectory-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		

		$this->add_responsive_control(
			'gird_column_desktop',
			[
				'label'     => esc_html__( 'Grid Column', 'cldirectory-core' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => $this->rt_translate['cols'],
				'default'   => '4',
			]
		);



		$this->add_control(
			'category',
			[
				'type'     => Controls_Manager::SELECT2,
				'label'    => esc_html__( 'Category', 'cldirectory-core' ),
				'options'  => $category_dropdown,
				'multiple' => true,
			]
		);

		$this->add_control(
			'number',
			[
				'label'       => esc_html__( 'Posts Category Per Page', 'cldirectory-core' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => '8',
				'description' => esc_html__( 'Write -1 to show all', 'cldirectory-core' ),
			]
		);

		$this->add_control(
			'random',
			[
				'label'        => esc_html__( 'Change items on every page load', 'cldirectory-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'cldirectory-core' ),
				'label_off'    => esc_html__( 'Off', 'cldirectory-core' ),
				'default'      => false,
				'return_value' => 'yes',
			]
		);
		
		$this->add_control(
			'orderby',
			[
				'type'       => Controls_Manager::SELECT2,
				'label'      => esc_html__( 'Order By', 'cldirectory-core' ),
				'options'    => [
					'date'  => __( 'Date (Recents comes first)', 'cldirectory-core' ),
					'title' => __( 'Title', 'cldirectory-core' ),
				],
				'default'    => 'date',
			]
		);

		$this->add_control(
			'order',
			[
				'type'       => Controls_Manager::SELECT2,
				'label'      => esc_html__( 'Sort By', 'cldirectory-core' ),
				'options'    => [
					'asc'  => esc_html__( 'Ascending', 'cldirectory-core' ),
					'desc' => esc_html__( 'Descending', 'cldirectory-core' ),
				],
				'default'    => 'asc',
			]
		);

		$this->add_control(
			'more_options',
			[
				'label'     => __( 'Field Visibility Options', 'cldirectory-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'cat_display',
			[
				'label'        => esc_html__( 'Category Visibility', 'cldirectory-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'cldirectory-core' ),
				'label_off'    => esc_html__( 'Off', 'cldirectory-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->add_control(
			'content_visibility',
			[
				'label'        => esc_html__( 'Content Visibility', 'cldirectory-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'cldirectory-core' ),
				'label_off'    => esc_html__( 'Off', 'cldirectory-core' ),
				'return_value' => 'yes',
				'default'      => false,
			]
		);

		$this->add_control(
			'content_limit',
			[
				'label'     => esc_html__( 'Content Limit', 'cldirectory-core' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 30,
				'condition' => [
					'content_visibility' => 'yes',
				],
			]
		);
		$this->add_control(
			'listing_action_visibility',
			[
				'label'        => esc_html__( 'Action Button Visibility', 'cldirectory-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'cldirectory-core' ),
				'label_off'    => esc_html__( 'Off', 'cldirectory-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'location_visibility',
			[
				'label'        => esc_html__( 'Location Visibility', 'cldirectory-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'cldirectory-core' ),
				'label_off'    => esc_html__( 'Off', 'cldirectory-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->add_control(
			'phone_visibility',
			[
				'label'        => esc_html__( 'Phone Visibility', 'cldirectory-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'cldirectory-core' ),
				'label_off'    => esc_html__( 'Off', 'cldirectory-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->add_control(
			'date_visibility',
			[
				'label'        => esc_html__( 'Date Visibility', 'cldirectory-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'cldirectory-core' ),
				'label_off'    => esc_html__( 'Off', 'cldirectory-core' ),
				'return_value' => 'yes',
				'default'      => false,
			]
		);

		$this->add_control(
			'views_display',
			[
				'label'        => esc_html__( 'Post View Count Visibility', 'cldirectory-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'cldirectory-core' ),
				'label_off'    => esc_html__( 'Off', 'cldirectory-core' ),
				'return_value' => 'yes',
				'default'      => false,
			]
		);

		$this->add_control(
			'label_display',
			[
				'label'        => esc_html__( 'Label Visibility', 'cldirectory-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'cldirectory-core' ),
				'label_off'    => esc_html__( 'Off', 'cldirectory-core' ),
				'return_value' => 'yes',
				'default'      => false,
			]
		);

		

		$this->add_control(
			'author_display',
			[
				'label'        => esc_html__( 'Display Visibility', 'cldirectory-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'cldirectory-core' ),
				'label_off'    => esc_html__( 'Off', 'cldirectory-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->end_controls_section();

		/*
		 * Additional Settings
		 * ===========================================
		 */
		$this->start_controls_section(
			'additional_settings',
			[
				'label' => esc_html__( 'Additional Settings', 'cldirectory-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'thumbnail_size',
			[
				'label'   => __( 'Thumbnail Size', 'cldirectory-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => '0',
				'options' => $this->rt_get_all_image_sizes(),
			]
		);

		$this->add_responsive_control(
			'thumb_height',
			[
				'label'      => __( 'Thumbnail Height', 'cldirectory-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range'      => [
					'px' => [
						'min'  => 150,
						'max'  => 1000,
						'step' => 5,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rtcl .rtcl-listings .listing-item .listing-thumb > img' => 'height: {{SIZE}}{{UNIT}};object-fit:cover',
				],
			]
		);
		$this->end_controls_section();

		/*
		 * Filter Settings
		 * ===========================================
		 */
		$this->start_controls_section(
			'filter_settings',
			[
				'label'     => esc_html__( 'Filter Settings', 'cldirectory-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'filter_text_align',
			[
				'label'     => __( 'Alignment', 'cldirectory-core' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => [
					'flex-start'   => [
						'title' => __( 'Left', 'cldirectory-core' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'cldirectory-core' ),
						'icon'  => 'eicon-text-align-center',
					],
					'flex-end'  => [
						'title' => __( 'Right', 'cldirectory-core' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'   => 'center',
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .rt-el-listing-wrapper .isotope-classes-tab' => 'justify-content: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'show_all_btn',
			[
				'label'        => __( 'Show All Button', 'cldirectory-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'cldirectory-core' ),
				'label_off'    => __( 'Hide', 'cldirectory-core' ),
				'return_value' => 'yes',
				'default'      => false,
			]
		);
		$this->start_controls_tabs(
			'filter_style_tabs'
		);

		$this->start_controls_tab(
			'filter_style_normal_tab',
			[
				'label' => __( 'Normal', 'cldirectory-core' ),
			]
		);

		$this->add_control(
			'filter_color',
			[
				'label'     => __( 'Color', 'cldirectory-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .isotope-classes-tab .nav-item' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'filter_background',
			[
				'label'     => __( 'Background', 'cldirectory-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .isotope-classes-tab .nav-item'         => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .isotope-classes-tab .nav-item::before' => 'border-top-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'filter_style_hover_tab',
			[
				'label' => __( 'Hover/Active', 'cldirectory-core' ),
			]
		);

		$this->add_control(
			'filter_color_hover',
			[
				'label'     => __( 'Color on Hover', 'cldirectory-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .isotope-classes-tab .nav-item:hover'   => 'color: {{VALUE}}',
					'{{WRAPPER}} .isotope-classes-tab .nav-item.current' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'filter_background_hover',
			[
				'label'     => __( 'Background on Hover', 'cldirectory-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .isotope-classes-tab .nav-item:hover, {{WRAPPER}} .isotope-classes-tab .nav-item.current'                 => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .isotope-classes-tab .nav-item:hover::before, {{WRAPPER}} .isotope-classes-tab .nav-item.current::before' => 'border-top-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();


		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'filter_typography',
				'label'    => __( 'Filter Typography', 'cldirectory-core' ),
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				],
				'selector' => '{{WRAPPER}} .isotope-classes-tab .nav-item',
			]
		);

		$this->add_responsive_control(
			'filter_spacing',
			[
				'label'              => __( 'Spacing', 'cldirectory-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'allowed_dimensions' => 'vertical',
				'default'            => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '30',
					'left'     => '',
					'isLinked' => false,
				],
				'selectors'          => [
					'{{WRAPPER}} .filter-wrapper .isotope-classes-tab' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();
		//End Filter Settings

		$this->start_controls_section(
			'sec_color',
			[
				'label' => esc_html__( 'Color', 'cldirectory-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Title', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtcl .rtcl-listings .listing-item h3.listing-title a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Title Hover', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtcl .rtcl-listings .listing-item h3.listing-title a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'content_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Content Color', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-el-listing-wrapper .rtcl-listings.rtcl-grid-view .listing-item .listing-excerpt' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'price_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Price', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-el-listing-wrapper .item-price .rtcl-price' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rtcl .listing-item .rtcl-price' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rtcl span.rtcl-price-meta' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'cat_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Category', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-el-listing-wrapper  .listing-category a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'meta_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Meta', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtcl .rtcl-listings .listing-item .entry-meta li' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rtcl .rtcl-listings .listing-item .entry-meta li a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'cat_icon_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Category Icon Background', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtcl .listing-category a span' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'cat_icon_bg_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Category Icon Hover Background', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtcl .listing-category a:hover span' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'cat_icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Category Icon', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtcl .listing-category a span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'cat_icon_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Category Icon Hover', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtcl .listing-category a:hover span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'custom_field_icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Custom Field Icon', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtcl .rtcl-listings .listing-item .listing-features li i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'custom_field_text_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Custom Field Text', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtcl .rtcl-listings .listing-item .listing-features li' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'sec_label_color',
			[
				'label' => esc_html__( 'Label Color', 'cldirectory-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		
		$this->add_control(
			'featured_label_bg',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Featured Background', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .badge.rtcl-badge-featured' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'featured_label_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Featured Text Color', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtcl-listing-badge-wrap span.badge' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'new_label_bg',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'New Background', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .badge.rtcl-badge-new' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'new_label_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'New Text Color', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtcl-listing-badge-wrap span.badge.rtcl-badge-new' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'popular_label_bg',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Popular Background', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtcl-listing-badge-wrap span.badge.popular-badge' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'popular_label_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Popular Text Color', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtcl-listing-badge-wrap span.badge.popular-badge' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'sec_typo',
			[
				'label' => esc_html__( 'Typography', 'cldirectory-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'label'    => esc_html__( 'Title', 'cldirectory-core' ),
				'selector' => '{{WRAPPER}} .rtcl .rtcl-listings .listing-item h3.listing-title',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'content_typo',
				'label'    => esc_html__( 'Content Typography', 'cldirectory-core' ),
				'selector' => '{{WRAPPER}} .rt-el-listing-wrapper .rtcl-listings.rtcl-grid-view .listing-item .listing-excerpt',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'price_type',
				'label'    => esc_html__( 'Price Typography', 'cldirectory-core' ),
				'selector' => '{{WRAPPER}} .rt-el-listing-wrapper .item-price .rtcl-price',
			]
		);


		$this->end_controls_section();
	}

	private function rt_isotope_query( $data ) {
		$result = [];

		// Post type
		$args = [
			'post_type'           => 'rtcl_listing',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'posts_per_page'      => $data['number'],
		];

		// Ordering
		if ( $data['random'] ) {
			$args['orderby'] = 'rand';
		} else {
			$args['orderby'] = $data['orderby'];
			if ( $data['orderby'] == 'title' ) {
				$args['order'] = 'ASC';
			}
		}

		// Date and Meta Query results

		$args2 = [];

		if(!empty($data['category'])){
			foreach ( $data['category'] as $key => $value ) {
				
				$args2['tax_query'] = [
					[
						'taxonomy' => 'rtcl_category',
						'field'    => 'term_id',
						'terms'    => $value,
					],
				];
	
				$result[ $value ] = new WP_Query( $args + $args2 );
				$args2            = [];
			}
		}
		

		return $result;
	}

	private function rt_isotope_navigation( $data ) {
		$cat_list = $this->get_category_list('rtcl_category');

		$navs = [];

		if ( ! empty( $cat_list ) ) {
			$navs = $cat_list;
		}

		$navs = apply_filters( 'cldirectory_isotope_navigations', $navs );


		if($data['category'] !== ''){
			foreach ( $navs as $key => $value ) {
				if ( ! in_array( $key, $data['category'] ) ) {
					unset( $navs[ $key ] );
				}
			}
			return $navs;
		}
		if($data['category'] === ''){
			
			return $navs = [];
		}
		
	}

	protected function render() {

		$data = $this->get_settings();
		$data['queries'] = $this->rt_isotope_query( $data );
		$data['navs']    = $this->rt_isotope_navigation( $data );

		if ( empty( $data['queries'] ) ) {
			echo '<div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i>';
			echo __( " Please choose 2 or more ( Ad Category ) first for showing posts", "cldirectory-core" );
			echo '</div>';
		}

		$template = 'view-1';

		$this->rt_template( $template, $data );
	}


}
<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\ClDirectory_Core;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Rtcl\Helpers\Link;
use Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Single_Listing_Location extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'Listing Single Location', 'cldirectory-core' );
		$this->rt_base = 'rt-listing-location-single-box';
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
			'location',
			[
				'label'   => esc_html__( 'Location', 'cldirectory-core' ),
				'type'    => Controls_Manager::SELECT2,
				'options' => $this->rt_get_categories_by_id('rtcl_location'),
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

		$this->add_control(
			'display_count',
			[
				'label'     => esc_html__( 'Display Count', 'cldirectory-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'cldirectory-core' ),
				'label_off' => esc_html__( 'Off', 'cldirectory-core' ),
				'default'   => 'yes',
			]
		);

		$this->add_control(
			'enable_link',
			[
				'label'     => esc_html__( 'Enable Link', 'cldirectory-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'cldirectory-core' ),
				'label_off' => esc_html__( 'Off', 'cldirectory-core' ),
				'default'   => 'yes',
			]
		);
		$this->add_control(
			'count_suffix_display',
			[
				'label'     => esc_html__( 'Count Suffix', 'cldirectory-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'cldirectory-core' ),
				'label_off' => esc_html__( 'Off', 'cldirectory-core' ),
				'default'   => false,
			]
		);
		$this->add_control(
			'count_suffix_text',
			[
				'label'     	=> esc_html__( 'Count Suffix Text', 'cldirectory-core' ),
				'type'      	=> Controls_Manager::TEXT,
				'label_block'   =>true,
				'default'       => 'Listing',
				'condition'		=>[
				  'count_suffix_display'=>'yes'
				]
			]
		);

		$this->end_controls_section();

		//Image Style
		//=============================================
		$this->start_controls_section(
			'image_settings',
			[
				'label' => esc_html__( 'Image Settings', 'cldirectory-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
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
					'size' => 400,
					'unit' => 'px',
				],
				'tablet_default'  => [
					'size' => 470,
					'unit' => 'px',
				],
				'mobile_default'  => [
					'size' => 410,
					'unit' => 'px',
				],
				'selectors'       => [
					'{{WRAPPER}} .rt-el-listing-location-box .item-img > img' => 'height: {{SIZE}}{{UNIT}};object-fit:cover;',
				],
			]
		);
		$this->end_controls_section();

		//Location Style
		//=============================================
		$this->start_controls_section(
			'location_style',
			[
				'label' => esc_html__( 'Location Title', 'cldirectory-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'label'    => esc_html__( 'Typography', 'cldirectory-core' ),
				'selector' => '{{WRAPPER}} .rt-el-listing-location-box .location-box .item-content h3',
			]
		);

		$this->add_control(
			'location_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-el-listing-location-box .location-box .item-content h3' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-el-listing-location-box .location-box .item-content h3 a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		//Listings Count
		//=============================================
		$this->start_controls_section(
			'listings_count_settings',
			[
				'label' => esc_html__( 'Listing Count Settings', 'cldirectory-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'display_count' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'count_type',
				'label'    => esc_html__( 'Count Typography', 'cldirectory-core' ),
				'selector' => '{{WRAPPER}} .rt-el-listing-location-box .location-box .item-content .item-count',
			]
		);

		$this->add_control(
			'count_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Count Color', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-el-listing-location-box .location-box .item-content .item-count' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();
	}

	protected function rt_term_post_count( $term_id ) {
		$args = [
			'nopaging'            => true,
			'fields'              => 'ids',
			'post_type'           => 'rtcl_listing',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => 1,
			'suppress_filters'    => false,
			'tax_query'           => [
				[
					'taxonomy' => 'rtcl_location',
					'field'    => 'term_id',
					'terms'    => $term_id,
				],
			],
		];

		$posts = get_posts( $args );
		return count( $posts );
	}
	protected function get_terms_info($data){ 
		$term = get_term( $data['location'], 'rtcl_location' );
		$data=$data ? $data:array();
		if ( $term && ! is_wp_error( $term ) ) {
			$data['title']     = $term->name;
			$data['count']     = $this->rt_term_post_count( $term->term_id );
			$data['permalink'] = Link::get_location_page_link( $term );
		} else {
			$data['title']         = esc_html__( 'Please Select a Location and Background', 'cldirectory-core' );
			$data['count']         = 0;
			$data['display_count'] = $data['enable_link'] = false;
		}
		return $data;
		 
	}
	protected function render() {
		$data = $this->get_settings();
		$data=$this->get_terms_info($data);
		$template = 'view-1';

		$this->rt_template( $template, $data );
	}

}
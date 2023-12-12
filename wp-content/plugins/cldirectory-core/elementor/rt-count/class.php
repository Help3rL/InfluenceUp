<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\CLDirectory_Core;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Rt_Count extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = __( 'RT Count', 'cldirectory-core' );
		$this->rt_base = 'rt-count';
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
			'count_type',
			[
				'label'   => esc_html__( 'Count Type', 'cldirectory-core' ),
				'type'    => Controls_Manager::SELECT2,
				'options' => array(
					'rtcl_listing' 	=> esc_html__( 'Listing', 'listygo-core' ),
					'rtcl_location' => esc_html__( 'Listing Location', 'listygo-core' ),
					'rtcl_category' => esc_html__( 'Listing Category', 'listygo-core' ),
					'post' 			=> esc_html__( 'Blog Posts', 'listygo-core' ),
					'category' 		=> esc_html__( 'Blog Posts Category', 'listygo-core' ),
					'post_tag' 		=> esc_html__( 'Blog Posts Tags', 'listygo-core' ),
				),
                'default' => 'rtcl_listing',
			]
		);
		$this->add_control(
			'title',
			[
				'type'    => Controls_Manager::TEXT,
				'label_block' =>true,
				'label'   => esc_html__( 'Title', 'cldirectory-core' ),
				'default' => esc_html__( 'Car Available', 'cldirectory-core' ),
			]
		);
        $this->add_control(
			'number',
			[
				'type'    => Controls_Manager::NUMBER,
				'label'   => esc_html__( 'Number', 'cldirectory-core' ),
                'description' =>esc_html__('If you use custom count number,that was not come from database','cldirectory-core')
			]
		);
        $this->add_control(
			'counter_suffix',
			[
				'type'    => Controls_Manager::TEXT,
				'label_block' =>true,
				'label'   => esc_html__( 'Counter Suffix', 'cldirectory-core' ),
				'default' => esc_html__( '+', 'cldirectory-core' ),
			]
		);
        $this->add_control(
			'rt_image',
			[
				'label' => __( 'Image', 'cldirectory-core' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
                'condition'=>[
					'layout'=>['style2']
				]
			]
		);

        $this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'rt_image_size', 
				'default' => 'full',
				'condition'=>[
					'layout'=>['style2']
				]
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
					'{{WRAPPER}}  *' => 'text-align: {{VALUE}} !important',
				],
				'condition' =>[
					'layout' =>'style1'
				],
				'toggle'    => true,
			]
		);
		$this->add_responsive_control(
			'shape_position1',
			[
				'type' => \Elementor\Controls_Manager::SLIDER,
				'label' => esc_html__( 'Shape Position 1', 'cldirectory-core' ),
                'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -300,
						'max' => 1000,
					],
                    '%' => [
						'min' => -20,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .listing-counter-wrapper.style2 .banner-message-wrap' => 'top: {{SIZE}}{{UNIT}};',
				],
                'condition'  =>[
                    'layout' =>'style2',
                ]
			]
		);
		$this->add_responsive_control(
			'shape_position2',
			[
				'type' => \Elementor\Controls_Manager::SLIDER,
				'label' => esc_html__( 'Shape Position 2', 'cldirectory-core' ),
                'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -300,
						'max' => 1000,
					],
                    '%' => [
						'min' => -20,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .listing-counter-wrapper.style2 .banner-message-wrap' => 'left: {{SIZE}}{{UNIT}};',
				],
                'condition'  =>[
                    'layout' =>'style2',
                ]
			]
		);
		$this->end_controls_section();

        $this->start_controls_section(
			'box_style',
			[
				'label' => __( 'Box Style', 'cldirectory-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition'=>[
					'layout'=>'style1'
				]
			]
		);
        $this->add_responsive_control(
			'box_width',
			[
				'label'      => __( 'Box Width', 'cldirectory-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
                'range' => [
					'px' => [
						'min' => 50,
						'max' => 1000,
					],
                    '%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .listing-counter-wrapper.style1' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'box_height',
			[
				'label'      => __( 'Box Height', 'cldirectory-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
                'range' => [
					'px' => [
						'min' => 50,
						'max' => 1000,
					],
                    '%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .listing-counter-wrapper.style1' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'box_radius',
			[
				'label'      => __( 'Box Border Radius', 'cldirectory-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .listing-counter-wrapper.style1' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'box_bg',
				'label'    => __( 'Box Background', 'cldirectory-core' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .listing-counter-wrapper.style1',
			]
		);
        $this->add_control(
			'box_border_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Border Color', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .listing-counter-wrapper.style1'=> 'border-color: {{VALUE}}',
				],
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
			'content_style',
			[
				'label' => __( 'Content Style', 'cldirectory-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'count_typography',
				'label'    => esc_html__( 'Count Typography', 'cldirectory-core' ),
				'selector' => '{{WRAPPER}} .listing-counter-wrapper .counter-content .count',
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Title Typography', 'cldirectory-core' ),
				'selector' => '{{WRAPPER}} .listing-counter-wrapper .title',
			]
		);
        $this->add_control(
			'count_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Count Color', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .listing-counter-wrapper.style1 .counter-content .count' => 'color: {{VALUE}}',
					'{{WRAPPER}} .listing-counter-wrapper.style2 .counter-content .count' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Title Color', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .listing-counter-wrapper.style1 .title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .listing-counter-wrapper.style2 .title' => 'color: {{VALUE}}',
				],
			]
        );
        $this->end_controls_section();
	}
    private function rt_counts( $count_type ){
		if (in_array($count_type, ['rtcl_listing', 'post'])) {
			$posts = wp_count_posts($count_type);
			$data_count = $posts->publish;			
		} elseif (in_array($count_type, ['rtcl_location', 'rtcl_category', 'category', 'post_tag'])) {
			$data_count = count( get_terms($count_type) );
		} else {
			$data_count = 0;
		}
		return $data_count;
	}

	protected function render() {
		$data = $this->get_settings();
        $count_type = $data['count_type'];
		if ($data['number']) {
			$data['counts'] = $data['number'];
		} else {
			$data['counts'] = $this->rt_counts($count_type);
		}

		if ($data['title']) {
			$count_title = $data['title'];
		} elseif ($count_type == 'rtcl_listing' ) {
			$count_title = esc_html__( 'Total Listings', 'listygo-core' );
		} elseif ($count_type == 'post' ) {
			$count_title = esc_html__( 'Blog Posts', 'listygo-core' );
		} elseif ($count_type == 'rtcl_location' ) {
			$count_title = esc_html__( 'Listing Locations', 'listygo-core' );
		} elseif ($count_type == 'rtcl_category' ) {
			$count_title = esc_html__( 'Listing Categories', 'listygo-core' );
		} elseif ($count_type == 'category' ) {
			$count_title = esc_html__( 'Posts Categories', 'listygo-core' );
		} elseif ($count_type == 'post_tag' ) {
			$count_title = esc_html__( 'Posts Tags', 'listygo-core' );
		} else {
			$count_title = esc_html__( 'Please add title', 'listygo-core' );
		}
		$data['title'] = $count_title;

		switch ($data['layout']) {
			case 'style2':
			$template = 'view-2';
			break;
			default:
			$template = 'view-1';
			break;
		}
        

		return $this->rt_template( $template, $data );
	}

}
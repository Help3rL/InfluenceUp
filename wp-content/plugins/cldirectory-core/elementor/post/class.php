<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.2
 */

namespace radiustheme\CLDirectory_Core;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Post extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name      = esc_html__( 'Post', 'cldirectory-core' );
		$this->rt_base      = 'rt-post';
		$this->rt_translate = [
			'cols' => [
				'3'  => __( '4 Columns', 'cldirectory-core' ),
				'4'  => __( '3 Columns', 'cldirectory-core' ),
				'6'  => __( '2 Columns', 'cldirectory-core' ),
				'12' => __( '1 Columns', 'cldirectory-core' ),
			],
		];
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		// widget title
		$this->start_controls_section(
			'rt_post_grid',
			[
				'label' => esc_html__( 'Post Grid', 'cldirectory-core' ),
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
			'post_limit',
			[
				'label'       => __( 'Post Limit', 'cldirectory-core' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Post Limit', 'cldirectory-core' ),
				'description' => __( 'Enter number of post to show.', 'cldirectory-core' ),
				'default'     => '4',
			]
		);

		$this->add_control(
			'post_source',
			[
				'label'       => __( 'Post Source', 'cldirectory-core' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => [
					'most_recent' => __( 'From all recent post', 'cldirectory-core' ),
					'by_category' => __( 'By Category', 'cldirectory-core' ),
					'by_tags'     => __( 'By Tags', 'cldirectory-core' ),
					'by_id'       => __( 'By Post ID', 'cldirectory-core' ),
				],
				'default'     => [ 'most_recent' ],
				'description' => __( 'Select posts source that you like to show.', 'cldirectory-core' ),
			]
		);

		$this->add_control(
			'categories',
			[
				'label'       => __( 'Choose Categories', 'cldirectory-core' ),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'options'     => $this->rt_category_list(),
				'label_block' => true,
				'condition'   => [
					'post_source' => 'by_category',
				],
				'description' => __( 'Select post category\'s.', 'cldirectory-core' ),
			]
		);

		$this->add_control(
			'tags',
			[
				'label'       => __( 'Choose Tags', 'cldirectory-core' ),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'options'     => $this->rt_tag_list(),
				'label_block' => true,
				'condition'   => [
					'post_source' => 'by_tags',
				],
				'description' => __( 'Select post tag\'s.', 'cldirectory-core' ),
			]
		);

		$this->add_control(
			'post_id',
			[
				'label'       => __( 'Enter post IDs', 'cldirectory-core' ),
				'type'        => Controls_Manager::TEXT,
				'description' => __( 'Enter the post IDs separated by comma', 'cldirectory-core' ),
				'label_block' => 'true',
				'condition'   => [
					'post_source' => 'by_id',
				],
			]
		);

		$this->add_control(
			'offset',
			[
				'label'       => __( 'Post offset', 'cldirectory-core' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Post offset', 'cldirectory-core' ),
				'description' => __( 'Number of post to displace or pass over. The offset parameter is ignored when post limit => -1 (show all posts) is used.', 'cldirectory-core' ),
			]
		);

		$this->add_control(
			'exclude',
			[
				'label'       => __( 'Exclude posts', 'cldirectory-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => 'true',
				'description' => __( 'Enter the post IDs separated by comma for exclude', 'cldirectory-core' ),
			]
		);

		$this->add_control(
			'orderby',
			[
				'label'   => __( 'Order by', 'cldirectory-core' ),
				'type'    =>Controls_Manager::SELECT,
				'options' => [
					'date'           => __( 'Date', 'cldirectory-core' ),
					'ID'             => __( 'Order by post ID', 'cldirectory-core' ),
					'author'         => __( 'Author', 'cldirectory-core' ),
					'title'          => __( 'Title', 'cldirectory-core' ),
					'modified'       => __( 'Last modified date', 'cldirectory-core' ),
					'comment_count'  => __( 'Number of comments', 'cldirectory-core' ),
					'rand'           => __( 'Random order', 'cldirectory-core' ),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label'   => __( 'Sort order', 'cldirectory-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'ASC'  => __( 'ASC', 'cldirectory-core' ),
					'DESC' => __( 'DESC', 'cldirectory-core' ),
				],
			]
		);
		$this->end_controls_section();
		
		// Thumbnail style
		//========================================================
		$this->start_controls_section(
			'thumbnail_style',
			[
				'label' => __( 'Thumbnail Style', 'cldirectory-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'image_height',
			[
				'label'      => __( 'Image Height', 'cldirectory-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px','%' ],
				'range'      => [
					'%' => [
						'min'  => 20,
						'max'  => 100,
					],
					'px' => [
						'min'  => 200,
						'max'  => 1000,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-el-post-wrapper .rt-post-item.rt-post-grid .rt-post-thumb img' => 'height: {{SIZE}}{{UNIT}};object-fit:cover',
				],
			]
		);

		$this->end_controls_section();


		// Title Settings
		//=====================================================================
		$this->start_controls_section(
			'title_style',
			[
				'label' => __( 'Title Style', 'cldirectory-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .rt-el-post-wrapper .rt-post-item .rt-post-content .post-title',
			]
		);
		$this->add_control(
			'title_limit',
			[
				'label'     => __( 'Ttitle Character Limit', 'cldirectory-core' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'default'   => '10',
			]
		);
		$this->add_control(
			'title_spacing',
			[
				'label'              => __( 'Title Spacing', 'cldirectory-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-el-post-wrapper .rt-post-item .rt-post-content .post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'allowed_dimensions' => 'vertical',
				'default'            => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false,
				],
			]
		);

		$this->start_controls_tabs(
			'title_style_tabs'
		);

		$this->start_controls_tab(
			'title_normal_tab',
			[
				'label' => __( 'Normal', 'cldirectory-core' ),
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Title Color', 'cldirectory-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-el-post-wrapper .rt-post-item .rt-post-content .post-title a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'title_hover_tab',
			[
				'label' => __( 'Hover', 'cldirectory-core' ),
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label'     => __( 'Title Hover Color', 'cldirectory-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-el-post-wrapper .rt-post-item .rt-post-content .post-title a:hover' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();


		// Content Settings
		//=====================================================================

		$this->start_controls_section(
			'content_style',
			[
				'label' => __( 'Excerpt Style', 'cldirectory-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_visibility',
			[
				'label'   => __( 'Excerpt Visibility', 'cldirectory-core' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'visible' => [
						'title' => __( 'Visible', 'cldirectory-core' ),
						'icon'  => 'eicon-check',
					],
					'hidden'  => [
						'title' => __( 'Hidden', 'cldirectory-core' ),
						'icon'  => 'eicon-editor-close',
					],
				],
				'toggle'  => false,
				'default' => 'hidden',
			]
		);
		$this->add_control(
			'content_limit',
			[
				'label'     => __( 'Excerpt Limit', 'cldirectory-core' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'default'   => '15',
				'condition' => [
					'content_visibility' => 'visible',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'content_typography',
				'selector'  => '{{WRAPPER}} .rt-el-post-wrapper .rt-post-item  .post-excerpt',
				'condition' => [
					'content_visibility' => 'visible',
				],
			]
		);

		$this->add_control(
			'content_spacing',
			[
				'label'              => __( 'Excerpt Spacing', 'cldirectory-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-el-post-wrapper .post-excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'allowed_dimensions' => 'vertical',
				'default'            => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false,
				],
				'condition'          => [
					'content_visibility' => 'visible',
				],
			]
		);

		$this->add_control(
			'content_color',
			[
				'label'     => __( 'Content Color', 'cldirectory-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-el-post-wrapper .post-excerpt' => 'color: {{VALUE}}',
				],
				'condition' => [
					'content_visibility' => 'visible',
				],
			]
		);

		$this->end_controls_section();

		// Meta Information Settings
		//=====================================================================

		$this->start_controls_section(
			'meta_info_style',
			[
				'label' => __( 'Meta Info Style', 'cldirectory-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


		$this->start_controls_tabs(
			'post_meta_style_tabs'
		);

		$this->start_controls_tab(
			'post_meta_normal_tab',
			[
				'label' => __( 'Normal', 'cldirectory-core' ),
			]
		);


		$this->add_control(
			'post_meta_color',
			[
				'label'     => __( 'Meta Color', 'cldirectory-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-el-post-wrapper .rt-post-item .rt-post-content .entry-meta li' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-el-post-wrapper .rt-post-item .rt-post-content .entry-meta li a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-el-post-wrapper .rt-post-item .rt-post-content .footer-meta li' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-el-post-wrapper .rt-post-item .rt-post-content .footer-meta li a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'post_meta_hover_tab',
			[
				'label' => __( 'Box Hover', 'cldirectory-core' ),
			]
		);

		$this->add_control(
			'post_meta_color_hover',
			[
				'label'     => __( 'Meta Color Hover', 'cldirectory-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-el-post-wrapper .rt-post-item .rt-post-content .entry-meta li a:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-el-post-wrapper .rt-post-item .rt-post-content .footer-meta li a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'hr1',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'author_visibility',
			[
				'label'        => __( 'Author Visibility', 'cldirectory-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'cldirectory-core' ),
				'label_off'    => __( 'Hide', 'cldirectory-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'author_avatar',
			[
				'label'     => __( 'Author Avatar Style', 'cldirectory-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'icon',
				'options'   => [
					'icon'      => __( 'Author Icon', 'cldirectory-core' ),
					'image'     => __( 'Author Image', 'cldirectory-core' ),
					'no-avatar' => __( 'No Avatar', 'cldirectory-core' ),
				],
				'condition' => [
					'author_visibility' => 'yes',
				],
			]
		);


		$this->add_control(
			'cat_visibility',
			[
				'label'        => __( 'Category Visibility', 'cldirectory-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'cldirectory-core' ),
				'label_off'    => __( 'Hide', 'cldirectory-core' ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

		$this->add_control(
			'date_visibility',
			[
				'label'        => __( 'Date Visibility', 'cldirectory-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'cldirectory-core' ),
				'label_off'    => __( 'Hide', 'cldirectory-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'p_date_format',
			[
				'label'     => __( 'Date Format', 'cldirectory-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'time_ago',
				'options'   => [
					'default'  => __( 'Default From Settings', 'cldirectory-core' ),
					'time_ago' => __( 'Time Ago Format', 'cldirectory-core' ),
				],
			]
		);


		$this->add_control(
			'reading_time_visibility',
			[
				'label'        => __( 'Reading Time Visibility', 'cldirectory-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'cldirectory-core' ),
				'label_off'    => __( 'Hide', 'cldirectory-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'comment_visibility',
			[
				'label'        => __( 'Comment Visibility', 'cldirectory-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'cldirectory-core' ),
				'label_off'    => __( 'Hide', 'cldirectory-core' ),
				'return_value' => 'yes',
				'default'      => false,
			]
		);


		$this->end_controls_section();
		// Read More Settings
		//=====================================================================

		$this->start_controls_section(
			'read_more_btn',
			[
				'label' => __( 'Box Settings', 'cldirectory-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'box_color',
			[
				'label'     => __( 'Box Color', 'cldirectory-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-el-post-wrapper .rt-post-item' => 'background-color: {{VALUE}}',
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
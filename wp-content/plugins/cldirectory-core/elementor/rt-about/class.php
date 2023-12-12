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

class Rt_About extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = __( 'RT About', 'cldirectory-core' );
		$this->rt_base = 'rt-about';
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
			'title',
			[
				'type'    => Controls_Manager::TEXT,
				'label_block' =>true,
				'label'   => esc_html__( 'Title', 'cldirectory-core' ),
				'default' => esc_html__( 'Lowest prices and the best customer service.', 'cldirectory-core' ),
			]
		);
		$this->add_control(
			'subtitle',
			[
				'type'    => Controls_Manager::TEXT,
				'label_block' =>true,
				'label'   => esc_html__( 'Subtitle', 'cldirectory-core' ),
				'default' => esc_html__( 'About Us', 'cldirectory-core' ),
			]
		);
		$this->add_control(
			'content',
			[
				'type'    => Controls_Manager::TEXTAREA,
				'label'   => esc_html__( 'Congent', 'cldirectory-core' ),
				'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Imperdiet ullamcorper mattis mi vel. Et quam urna, neque, turpis est. Sem vel sed sit tellus ornare vivamus fringilla tellus in. In turpis senectus sed at posuere pharetra.', 'cldirectory-core' ),
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
			]
		);
        $this->add_control(
			'rt_image2',
			[
				'label' => __( 'Image 2', 'cldirectory-core' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'rt_image3',
			[
				'label' => __( 'Image 3', 'cldirectory-core' ),
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
					'layout'=>['style1']
				]
			]
		);
		$this->add_control(
			'btntext',
			[
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Button Text', 'cldirectory-core' ),
				'default' => esc_html__( 'Explore Now', 'cldirectory-core' ),
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

		$this->start_controls_section(
			'section_box',
			[
				'label' => __( 'General', 'cldirectory-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-about-box-wrapper .about-box.about-style-1 .content-holder .entry-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'label'    => esc_html__( 'Typography', 'cldirectory-core' ),
				'selector' => '{{WRAPPER}} .rt-about-box-wrapper .about-box.about-style-1 .content-holder .entry-title',
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Subtitle Color', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-about-box-wrapper .about-box.about-style-1 .content-holder .entry-sub-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'subtitle_typo',
				'label'    => esc_html__( 'Subtitle Typography', 'cldirectory-core' ),
				'selector' => '{{WRAPPER}} .rt-about-box-wrapper .about-box.about-style-1 .content-holder .entry-sub-title',
			]
		);
		$this->add_control(
			'content_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Content Color', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-about-box-wrapper .about-box.about-style-1 .content-holder .entry-description' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'cotent_typo',
				'label'    => esc_html__( 'Content Typography', 'cldirectory-core' ),
				'selector' => '{{WRAPPER}} .rt-about-box-wrapper .about-box.about-style-1 .content-holder .entry-description',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'sec_spacing',
			[
				'label' => esc_html__( 'Spacing', 'cldirectory-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'title_margin',
			[
				'label'      => __( 'Title Margin', 'cldirectory-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-about-box-wrapper .about-box.about-style-1 .content-holder .entry-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->add_responsive_control(
			'content_margin',
			[
				'label'      => __( 'Content Margin', 'cldirectory-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-about-box-wrapper .about-box.about-style-1 .content-holder .entry-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->add_responsive_control(
			'btn_padding',
			[
				'label'      => __( 'Button Padding', 'cldirectory-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .btn-fill' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$data = $this->get_settings();

		$template = 'view-1';

        if($data['layout']=='style2'){
            $template = 'view-2';
        }

		return $this->rt_template( $template, $data );
	}

}
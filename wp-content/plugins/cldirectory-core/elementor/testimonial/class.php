<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\CLDirectory_Core;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Testimonial_Carousel extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'Testimonial Carousel', 'cldirectory-core' );
		$this->rt_base = 'rt-testimonial-carousel';
		parent::__construct( $data, $args );
	}
	public function get_script_depends() {
		return [
			'swiper',
		];
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
			'sec_title',
			[
				'label'       => esc_html__( 'Section Title', 'cldirectory-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'We Love To Heare From Lovely Customer Voice',
				'condition'	  =>[
					'layout'=>['style2']
				]
			]
		);
		$this->add_control(
			'sec_content',
			[
				'label'       => esc_html__( 'Content', 'cldirectory-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default'     => 'Morem ipsum dolor sit amet, consectetur adipiscing sed do eiusmod temporeum scripserit doctus appetere interpretaris mea nruisse.',
				'condition'	  =>[
					'layout'=>['style2']
				]
			]
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'image',
			[
				'label'   => __( 'Choose Image', 'cldirectory-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
			'name',
			[
				'label'       => __( 'Name', 'cldirectory-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Enter Name', 'cldirectory-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'designation',
			[
				'label'       => __( 'Designation', 'cldirectory-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Enter Designation', 'cldirectory-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'content',
			[
				'label'   => __( 'Content', 'cldirectory-core' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => __( 'Enter Designation', 'cldirectory-core' ),
			]
		);
		$repeater->add_control(
            'rating',[
                'type' => Controls_Manager::SELECT2,
                'label'   => esc_html__( 'Rating', 'cldirectory-core' ),
				'options' => array(
					'1' => esc_html__( 'Rating 1', 'cldirectory-core' ),
					'2' => esc_html__( 'Rating 2', 'cldirectory-core' ),
					'3' => esc_html__( 'Rating 3', 'cldirectory-core' ),
					'4' => esc_html__( 'Rating 4', 'cldirectory-core' ),
					'5' => esc_html__( 'Rating 5', 'cldirectory-core' ),
				),
            ]
        );
		$this->add_control(
			'items',
			[
				'label'       => __( 'Testimonial List', 'cldirectory-core' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'name'        => __( 'Maria Zokatti', 'cldirectory-core' ),
						'designation' => __( 'CEO, PSDBOSS', 'cldirectory-core' ),
						'content'     => __( 'Engage with our professional real estate agents sell Following buy or rent your home.Get emails directly to your area reach inbox and manage the lead with.',
							'cldirectory-core' ),
					],
					[
						'name'        => __( 'John Doe', 'cldirectory-core' ),
						'designation' => __( 'WordPress Developer', 'cldirectory-core' ),
						'content'     => __( 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aliquid expedita recusandae ipsam quas fugit aperiam nihil nemo delectus laudantium? Enim est quibusdam dicta a',
							'cldirectory-core' ),
					],
					[
						'name'        => __( 'Kent Odeldan', 'cldirectory-core' ),
						'designation' => __( 'Web Designer', 'cldirectory-core' ),
						'content'     => __( 'Aliquid expedita recusandae ipsam quas fugit aperiam nihil nemo delectus laudantium? Enim est quibusdam dicta a', 'cldirectory-core' ),
					],

				],
				'title_field' => '{{{ name }}}',
			]
		);
		$this->add_control(
			'rating',
			[
				'label'        => __( 'Rating', 'cldirectory-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'cldirectory-core' ),
				'label_off'    => __( 'Hide', 'cldirectory-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->end_controls_section();
		//Carousel Settings
		//=======================================

		$this->start_controls_section(
			'carousel_settings',
			[
				'label'     => esc_html__( 'Carousel Settings', 'cldirectory-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'slider_per_group',
			[
				'label'        => __( 'Slider Per Group', 'cldirectory-core' ),
				'type'         => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 6,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 1,
				],
			]
		);

		$this->add_control(
			'dots',
			[
				'label'        => __( 'Dots', 'cldirectory-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'cldirectory-core' ),
				'label_off'    => __( 'Hide', 'cldirectory-core' ),
				'return_value' => 'yes',
				'default'      => false
			]
		);

		$this->add_control(
			'slider_loop',
			[
				'label'        => __( 'Infinite', 'cldirectory-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'cldirectory-core' ),
				'label_off'    => __( 'No', 'cldirectory-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'slider_autoplay',
			[
				'label'        => __( 'Autoplay', 'cldirectory-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'cldirectory-core' ),
				'label_off'    => __( 'No', 'cldirectory-core' ),
				'return_value' => 'yes',
				'default'      => false,
			]
		);

		$this->add_control(
			'slider_autoplay_delay',
			[
				'label'     => __( 'Autoplay Speed', 'cldirectory-core' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 1000,
				'max'       => 5000,
				'step'      => 500,
				'default'   => 3000,
				'condition' => [
					'slider_autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'centeredSlides',
			[
				'label'        => __( 'Centered Slides', 'cldirectory-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'cldirectory-core' ),
				'label_off'    => __( 'No', 'cldirectory-core' ),
				'return_value' => 'yes',
				'default'      => false,
				'description'  => __( 'If you use centered slider options then default column will not working.', 'cldirectory-core' ),
			]
		);

		$this->add_control(
			'speed',
			[
				'label'   => __( 'Speed', 'cldirectory-core' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'min'     => 100,
				'max'     => 5000,
				'step'    => 100,
				'default' => 2000,
			]
		);
		$this->add_control(
			'space',
			[
				'label'   => __( 'Space', 'cldirectory-core' ),
				'type'    => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 60,
					],
				],
				'size_units' => [ 'px'],
				'default' => [
					'size' => 24,
				],
			]
		);
		$this->add_control(
			'item',
			[
				'label'   => __( 'Desktop items', 'cldirectory-core' ),
				'type'    => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 6,
					],
				],
				'size_units' => [ 'px'],
				'default' => [
					'size' => 3,
				],
			]
		);
		$this->add_control(
			'medium_item',
			[
				'label'   => __( 'Medium Desktop items', 'cldirectory-core' ),
				'type'    => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 6,
					],
				],
				'size_units' => [ 'px'],
				'default' => [
					'size' => 2,
				],
			]
		);
		$this->add_control(
			'item_tablet',
			[
				'label'   => __( 'Tablet items', 'cldirectory-core' ),
				'type'    => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 6,
					],
				],
				'size_units' => [ 'px'],
				'default' => [
					'size' => 2,
				],
			]
		);
		$this->add_control(
			'item_mobile',
			[
				'label'   => __( 'Mobile items', 'cldirectory-core' ),
				'type'    => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 6,
					],
				],
				'size_units' => [ 'px'],
				'default' => [
					'size' => 1,
				],
			]
		);
		$this->end_controls_section();

		//Settings
		//=======================================
		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Section Style', 'post-grid-elementor-addon' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => 'style2',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'section_title_typo',
				'label'    => esc_html__( 'Title Typography', 'cldirectory-core' ),
				'selector' => '{{WRAPPER}} .vertical-testimonial-slider  .section-title-vertical h2',
			]
			
		);
		$this->add_control(
			'section_title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Title Color', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .vertical-testimonial-slider  .section-title-vertical h2' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'section_title_margin',
			[
				'label'              => __( 'Margin', 'cldirectory-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .vertical-testimonial-slider  .section-title-vertical .title-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'section_content_typo',
				'label'    => esc_html__( 'Content Typography', 'cldirectory-core' ),
				'selector' => '{{WRAPPER}} .vertical-testimonial-slider  .section-title-vertical p',
			]
			
		);
		$this->add_control(
			'section_content_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Content Color', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .vertical-testimonial-slider  .section-title-vertical p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'section_paddint',
			[
				'label'              => __( 'Section Padding', 'cldirectory-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .vertical-testimonial-slider' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__( 'Content Style', 'cldirectory-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'thumb_style_heading',
			[
				'label' => __( 'Thumb Style', 'cldirectory-core' ),
				'type'  => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'thum_display',
			[
				'label' => esc_html__( 'Thumb', 'cldirectory-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'cldirectory-core' ),
				'label_off' => esc_html__( 'Hide', 'cldirectory-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'thumb_size_width',
			[
				'label'      => __( 'Thumb Size Width', 'cldirectory-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 50,
						'max'  => 600,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-el-testimonial-carousel .testimonial-img img' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-el-testimonial-carousel .testimonial-img' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition'=>[
					'thum_display' =>'yes'
				]
			]
		);
		$this->add_control(
			'thumb_size_height',
			[
				'label'      => __( 'Thumb Size Height', 'cldirectory-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 50,
						'max'  => 600,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-el-testimonial-carousel .testimonial-img img' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-el-testimonial-carousel .testimonial-img' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition'=>[
					'thum_display' =>'yes'
				]
			]
		);
		$this->add_control(
			'border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'cldirectory-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .rt-el-testimonial-carousel .testimonial-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'=>[
					'thum_display' =>'yes'
				]
			]
		);
		$this->add_control(
			'name_style_heading',
			[
				'label'     => __( 'Name Style', 'cldirectory-core' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'label'    => esc_html__( 'Name Typography', 'cldirectory-core' ),
				'selector' => '{{WRAPPER}} .rt-el-testimonial-carousel .testimonial-block__heading',
			]
		);
		$this->add_control(
			'title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Name Color', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-el-testimonial-carousel .testimonial-block__heading' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'designation_style_heading',
			[
				'label'     => __( 'Designation Style', 'cldirectory-core' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'designation_typo',
				'label'    => esc_html__( 'Designation', 'cldirectory-core' ),
				'selector' => '{{WRAPPER}} .rt-el-testimonial-carousel .testimonial-block__designation',
			]
		);
		$this->add_control(
			'designation_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Designation', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-el-testimonial-carousel .testimonial-block__designation' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'content_style_heading',
			[
				'label'     => __( 'Content Style', 'cldirectory-core' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'content_typo',
				'label'    => esc_html__( 'Content', 'cldirectory-core' ),
				'selector' => '{{WRAPPER}} .rt-el-testimonial-carousel .testimonial-block .testimonial-block__text',
			]
		);
		$this->add_control(
			'content_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Content', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-el-testimonial-carousel .testimonial-block .testimonial-block__text' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'quote_style_heading',
			[
				'label'     => __( 'Quote Icon Style', 'cldirectory-core' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'quote_sign_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Quote Icon', 'cldirectory-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-el-testimonial-carousel .testimonial-block .qoute-icon svg path' => 'fill: {{VALUE}}',
				]
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_box',
			[
				'label' => __( 'Box', 'post-grid-elementor-addon' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => 'style2',
				],
			]
		);

		$this->add_control(
			'box_style_normal_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => __( 'Background Color', 'cldirectory-core' ),
				'separator' => '',
				'selectors' => [
					'{{WRAPPER}} .vertical-testimonial-slider .vertical-slider .vertical-slider-item' => 'background-color: {{VALUE}};',
				]
			]
		);

		$this->add_responsive_control(
			'wrapper_height',
			[
				'label'     => __( 'Box Wrapper Height', 'cldirectory-core' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' =>'',
				],
				'range'     => [
					'px' => [
						'min' => 100,
						'max' =>1200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .vertical-testimonial-slider .vertical-slider' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'box_height',
			[
				'label'     => __( 'Box Height', 'cldirectory-core' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' =>'',
				],
				'range'     => [
					'px' => [
						'min' => 100,
						'max' =>1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .vertical-testimonial-slider .vertical-slider .vertical-slider-item' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'box_border_radius',
			[
				'label'     => __( 'Border Radius', 'cldirectory-core' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' =>'',
				],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .vertical-testimonial-slider .vertical-slider .vertical-slider-item' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);
		$this->add_responsive_control(
			'box_padding',
			[
				'label'      => __( 'Padding', 'cldirectory-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .vertical-testimonial-slider .vertical-slider .vertical-slider-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->end_controls_section();
	}

	protected function render() {
		$data = $this->get_settings();

		if($data['slider_autoplay']=='yes'){
			$data['slider_autoplay']=true;
		}
		else{
			$data['slider_autoplay']=false;
		}

		$slider_direction= $data['layout']=='style2' ? 'vertical':'horizontal';

		$slider_data=array(
			'slidesPerView' 	=>1,
			'loop'				=>$data['slider_loop']=='yes' ? true:false,
			'centeredSlides'	=>$data['centeredSlides']=='yes' ? true:false ,
			'slideToClickedSlide' =>true,
			'direction'			 =>$slider_direction,
			'spaceBetween'		=>$data['space']['size'],
			'slidesPerGroup'		=>$data['slider_per_group']['size'],
			'autoplay'				=>array(
				'delay'  => $data['slider_autoplay_delay'],
			),
			'speed'      =>$data['speed'],
			'auto'		=>$data['slider_autoplay'], 
			'breakpoints' =>array(
				'0'    =>array('slidesPerView' =>1),
				'576'    =>array('slidesPerView'  =>$data['item_mobile']['size']),
				'768'    =>array('slidesPerView'  =>$data['item_tablet']['size']),
				'992'    =>array('slidesPerView'  =>$data['medium_item']['size']),
				'1200'    =>array('slidesPerView' =>$data['item']['size']),				
				'1600'    =>array('slidesPerView' =>$data['item']['size'])
			),
		);
		$data['slider_data'] = json_encode( $slider_data ); 
		
		$template = 'view-1';

        if($data['layout']=='style2'){
            $template = 'view-2';
        }

		$this->rt_template( $template, $data );
	}

}
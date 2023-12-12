<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\CLDirectory_Core;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Css_Filter;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class RT_Parallax extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Parallax Animation', 'cldirectory-core' );
		$this->rt_base = 'rt-parallax';
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
			'follow_parent',
			[
				'label'   => __( 'Follow Parent Element', 'cldirectory-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'follow-current-element',
				'options' => [
					'follow-main-wrapper' => __( 'Follow Main Wrapper', 'cldirectory-core' ),
					'follow-current-element'     => __( 'Follow Current Element', 'cldirectory-core' ),
				],
				'prefix_class' => 'rt-parallax-',
			]
		);


		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'animated_image',
			[
				'label'   => __( 'Animated Image', 'cldirectory-core' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'image_animation',
			[
				'label'   => __( 'Choose Animation', 'cldirectory-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					''                  => __( 'No Animation', 'cldirectory-core' ),
					'follow-with-mouse' => __( 'Follow with Mouse', 'cldirectory-core' ),
					'left-to-right'     => __( 'Left to Right', 'cldirectory-core' ),
					'top-to-bottom'     => __( 'Top to Bottom', 'cldirectory-core' ),
					'fa-spin'     => __( 'Spin Animation', 'cldirectory-core' ),
				],
			]
		);

		$repeater->add_control(
			'follow_position',
			[
				'label'      => __( 'Mouse Follow Position', 'cldirectory-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => - 200,
						'max'  => 200,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 100,
				],
				'condition'  => [
					'image_animation' => 'follow-with-mouse',
				],
			]
		);

		$repeater->add_responsive_control(
			'img_top_position',
			[
				'label'      => __( 'Image Top Position', 'cldirectory-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => -300,
						'max'  => 1000,
						'step' => 1,
					],
					'%'  => [
						'min' => - 20,
						'max' => 130,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$repeater->add_responsive_control(
			'img_left_position',
			[
				'label'      => __( 'Image Left Position', 'cldirectory-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => -1000,
						'max'  => 1500,
						'step' => 1,
					],
					'%'  => [
						'min' => -100,
						'max' => 130,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$repeater->add_responsive_control(
			'img_right_position',
			[
				'label'      => __( 'Image Right Position', 'cldirectory-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => -300,
						'max'  => 1000,
						'step' => 1,
					],
					'%'  => [
						'min' => - 20,
						'max' => 130,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$repeater->add_responsive_control(
			'img_bottom_position',
			[
				'label'      => __( 'Image Bottom Position', 'cldirectory-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => -300,
						'max'  => 1000,
						'step' => 1,
					],
					'%'  => [
						'min' => - 20,
						'max' => 130,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$repeater->add_control(
			'animation_duration',
			[
				'label'      => __( 'Animation Duration', 'cldirectory-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 1,
						'max'  => 20,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors'  => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'animation-duration: {{SIZE}}s;',
				],
				'condition'  => [
					'image_animation!' => [ 'follow-with-mouse' ],
				],
			]
		);

		$repeater->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters',
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
			]
		);

		$this->add_control(
			'animation_list',
			[
				'label'  => __( 'Animated Image List', 'cldirectory-core' ),
				'type'   => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);

		$this->end_controls_section();

		//Settings
		//=======================================
		$this->start_controls_section(
			'paralax_settings',
			[
				'label' => esc_html__( 'Parallax Settings', 'cldirectory-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_responsive_control(
			'image_wrap_width',
			[
				'label'          => __( 'Wrapper Width', 'cldirectory-core' ),
				'type'           => Controls_Manager::SLIDER,
				'size_units'     => [ 'px', '%' ],
				'range'          => [
					'px' => [
						'min' => 20,
						'max' => 1920,
					],
					'%' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors'      => [
					'{{WRAPPER}}' => 'width: {{SIZE}}{{UNIT}}; overflow: hidden;',
				],
			]
		);

		$this->add_control(
			'wrapper_float',
			[
				'label'   => __( 'Float', 'cldirectory-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'left' => __( 'Left', 'cldirectory-core' ),
					'right'     => __( 'Right', 'cldirectory-core' ),
				],
				'selectors'      => [
					'{{WRAPPER}}' => 'float: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$data = $this->get_settings();

		$animated_list = $data['animation_list'];
		if ( $animated_list ):
			$img_count = 1;
			foreach ( $animated_list as $list ) {
				if ( $list['animated_image']['id'] ) {
					$image_info = wp_get_attachment_image_src($list['animated_image']['id']);
					?>
                    <img
							width="<?php echo esc_attr($image_info[1]) ?>" 
							height="<?php echo esc_attr($image_info[1]) ?>"
                            src="<?php echo esc_url( $list['animated_image']['url'] ); ?>"
                            alt="<?php echo esc_attr( 'Animated Image' ) ?>"
                            data-position="<?php echo esc_attr( $list['follow_position']['size'] ) ?>"
                            class="rt-animated-img motion-effects <?php echo esc_attr( $img_count ) ?> <?php echo esc_attr( $list['image_animation'] . ' elementor-repeater-item-'. $list['_id'] ); ?>"
                    >
					<?php
					$img_count ++;
				}
			}
		endif;
	}

}
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

class Rt_Pricing_Tab extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = __( 'RT Pricing Tab', 'cldirectory-core' );
		$this->rt_base = 'rt-pricing-tab';
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
        /**Per month repeater control */
        $repeater1 = new \Elementor\Repeater();
        $repeater1->add_control(
			'title', [
				'type' => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Title', 'cldirectory-core' ),
				'default' => esc_html__( 'Basic Plan', 'cldirectory-core' ),
				'label_block' => true,
			]
		);
		$repeater1->add_control(
			'price', [
				'type' => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Price', 'cldirectory-core' ),
				'default'  => esc_html__('$39','cldirectory'),
				'label_block' => true,
				'description' =>esc_html__('please,sperate price currency with span tag ex:<span>$</span>')
			]
		);
        $repeater1->add_control(
			'price_suffix', [
				'type' => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Price Suffix', 'cldirectory-core' ),
				'default'  => esc_html__('Per Month','clproerty-core'),
				'label_block' => true,
			]
		);
        
        $repeater1->add_control(
			'content', [
				'type' => Controls_Manager::WYSIWYG,
				'label'   => esc_html__( 'Content', 'cldirectory-core' ),
				'label_block' => true,
			]
		);
        $repeater1->add_control(
			'btn_text', [
				'type' => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Button Text', 'cldirectory-core' ),
                'default'  => esc_html__('Purchase Now','cldirectory-core'),
				'label_block' => true,
			]
		);
        $repeater1->add_control(
			'btn_url', [
				'type' => Controls_Manager::URL,
				'label'   => esc_html__( 'Button URL', 'cldirectory-core' ),
				'label_block' => true,
			]
		);
        /**Yearly repeater control */
		$repeater2 = new \Elementor\Repeater();

        $repeater2->add_control(
			'yearly_title', [
				'type' => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Title', 'cldirectory-core' ),
				'default' => esc_html__( 'Basic Plan', 'cldirectory-core' ),
				'label_block' => true,
			]
		);
		$repeater2->add_control(
			'yearly_price', [
				'type' => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Price', 'cldirectory-core' ),
				'default'  => esc_html__('$39','cldirectory-core'),
				'label_block' => true,
				'description' =>esc_html__('please,sperate price currency with span tag ex:<span>$</span>')
			]
		);
        $repeater2->add_control(
			'yearly_price_suffix', [
				'type' => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Price Suffix', 'cldirectory-core' ),
				'default'  => esc_html__('Per Month','cldirectory-core'),
				'label_block' => true,
			]
		);
        $repeater2->add_control(
			'yearly_content', [
				'type' => Controls_Manager::WYSIWYG,
				'label'   => esc_html__( 'Content', 'cldirectory-core' ),
				'label_block' => true,
			]
		);
        $repeater2->add_control(
			'yearly_btn_text', [
				'type' => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Button Text', 'cldirectory-core' ),
                'default'  => esc_html__('Purchase Now','cldirectory-core'),
				'label_block' => true,
			]
		);
        $repeater2->add_control(
			'yearly_btn_url', [
				'type' => Controls_Manager::URL,
				'label'   => esc_html__( 'Button URL', 'cldirectory-core' ),
				'label_block' => true,
			]
		);
        $this->add_control(
            'monthly_title',[
                'type'        => Controls_Manager::TEXT,
                'label'       => esc_html__( 'Monthly Title', 'cldirectory-core' ),
                'default'     => "Monthly",
            ]
        );
        $this->add_control(
            'yearly_title',[
                'type'        => Controls_Manager::TEXT,
                'label'       => esc_html__( 'Yearly Title', 'cldirectory-core' ),
                'default'     => "Yearly",
            ]
        );
        $this->add_control(
			'monthly_features',
			[
				'label'       => __( 'Monthly Feature List', 'cldirectory-core' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater1->get_controls(),
				'default'     => [
					[
						'title'        => __( 'Basic Plan', 'cldirectory-core' ),
						'price' => __( '$39', 'cldirectory-core' ),
						'content'     => __( 'All Listing Access','cldirectory-core' ),
					],
                    [
						'title'        => __( 'Basic Plan', 'cldirectory-core' ),
						'price' => __( '$49', 'cldirectory-core' ),
						'content'     => __( 'All Listing Access','cldirectory-core' ),
					],
                    [
						'title'        => __( 'Basic Plan', 'cldirectory-core' ),
						'price' => __( '$59', 'cldirectory-core' ),
						'content'     => __( 'All Listing Access','cldirectory-core' ),
					],
				],
				'title_field' => '{{{ name }}}',
			]
		);
        $this->add_control(
			'yearly_features',
			[
				'label'       => __( 'Yearly Feature List', 'cldirectory-core' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater2->get_controls(),
				'default'     => [
					[
						'yearly_title'        => __( 'Basic Plan', 'cldirectory-core' ),
						'yearly_price' => __( '$79', 'cldirectory-core' ),
						'yearly_content'     => __( 'All Listing Access','cldirectory-core' ),
					],
                    [
						'yearly_title'        => __( 'Basic Plan', 'cldirectory-core' ),
						'yearly_price' => __( '$89', 'cldirectory-core' ),
						'yearly_content'     => __( 'All Listing Access','cldirectory-core' ),
					],
                    [
						'yearly_title'        => __( 'Basic Plan', 'cldirectory-core' ),
						'yearly_price' => __( '$99', 'cldirectory-core' ),
						'yearly_content'     => __( 'All Listing Access','cldirectory-core' ),
					],
				],
				'title_field' => '{{{ name }}}',
			]
		);
		$this->end_controls_section();

	}

	protected function render() {
		$data = $this->get_settings();

		$template = 'view-1';

		return $this->rt_template( $template, $data );
	}

}
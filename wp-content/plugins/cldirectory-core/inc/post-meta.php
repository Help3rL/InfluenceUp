<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\CLDirectory_Core;

use radiustheme\CLDirectory\Helper;
use radiustheme\CLDirectory\Listing_Functions;
use \RT_Postmeta;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'RT_Postmeta' ) ) {
	return;
}

$Postmeta = RT_Postmeta::getInstance();

$prefix = CLDIRECTORY_CORE_THEME_PREFIX;

/*-------------------------------------
#. Layout Settings
---------------------------------------*/
$nav_menus = wp_get_nav_menus( [ 'fields' => 'id=>name' ] );
$nav_menus = [ 'default' => __( 'Default', 'cldirectory-core' ) ] + $nav_menus;
$sidebars  = [ 'default' => __( 'Default', 'cldirectory-core' ) ] + Helper::custom_sidebar_fields();



$Postmeta->add_meta_box(
	"{$prefix}_page_settings", __( 'Layout Settings', 'cldirectory-core' ), [ 'page', 'post' ], '', '', 'high', [
	'fields' => [
		"{$prefix}_layout_settings" => [
			'label' => __( 'Layouts', 'cldirectory-core' ),
			'type'  => 'group',
			'value' => [
				'layout'         => [
					'label'   => __( 'Layout', 'cldirectory-core' ),
					'type'    => 'select',
					'options' => [
						'default'       => __( 'Default from customizer', 'cldirectory-core' ),
						'full-width'    => __( 'Full Width', 'cldirectory-core' ),
						'left-sidebar'  => __( 'Left Sidebar', 'cldirectory-core' ),
						'right-sidebar' => __( 'Right Sidebar', 'cldirectory-core' ),
					],
					'default' => 'default',
				],
				'sidebar'        => [
					'label'   => __( 'Custom Sidebar', 'cldirectory-core' ),
					'type'    => 'select',
					'options' => $sidebars,
					'default' => 'default',
				],
				'top_bar'        => [
					'label'   => __( 'Top Bar', 'cldirectory-core' ),
					'type'    => 'select',
					'options' => [
						'default' => __( 'Default from customizer', 'cldirectory-core' ),
						'on'      => __( 'Enable', 'cldirectory-core' ),
						'off'     => __( 'Disable', 'cldirectory-core' ),
					],
					'default' => 'default',
				],
				'header_btn'        => [
					'label'   => __( 'Header Right Button', 'cldirectory-core' ),
					'type'    => 'select',
					'options' => [
						'default' => __( 'Default from customizer', 'cldirectory-core' ),
						'on'      => __( 'Enable', 'cldirectory-core' ),
						'off'     => __( 'Disable', 'cldirectory-core' ),
					],
					'default' => 'default',
				],
				'footer_cta_banner_section'        => [
					'label'   => __( 'Footer CTA Banner Section', 'cldirectory-core' ),
					'type'    => 'select',
					'options' => [
						'default' => __( 'Default from customizer', 'cldirectory-core' ),
						'on'      => __( 'Enable', 'cldirectory-core' ),
						'off'     => __( 'Disable', 'cldirectory-core' ),
					],
					'default' => 'default',
				],
				'header_width'   => [
					'label'   => __( 'Header Width', 'cldirectory-core' ),
					'type'    => 'select',
					'options' => [
						'default'   => __( 'Default from customizer', 'cldirectory-core' ),
						'box-width' => __( 'Box Width', 'cldirectory-core' ),
						'fullwidth' => __( 'Full Width', 'cldirectory-core' ),
					],
					'default' => 'default',
				],

				'header_style'     => [
					'label'   => __( 'Header Layout', 'cldirectory-core' ),
					'type'    => 'select',
					'options' => [
						'default' => __( 'Default from customizer', 'cldirectory-core' ),
						'1'       => __( 'Layout 1', 'cldirectory-core' ),
						'2'       => __( 'Layout 2', 'cldirectory-core' ),
					],
					'default' => 'default',
				],
				'tr_header'        => [
					'label'   => __( 'Transparent Header', 'cldirectory-core' ),
					'type'    => 'select',
					'options' => [
						'default' => __( 'Default from customizer', 'cldirectory-core' ),
						'on'      => __( 'Enable', 'cldirectory-core' ),
						'off'     => __( 'Disable', 'cldirectory-core' ),
					],
					'default' => 'default',
				],
				'padding_top'      => [
					'label'   => esc_html__( 'Padding Top', 'cldirectory-core' ),
					'type'    => 'text',
					'default' => 'default',
				],
				'padding_bottom'   => [
					'label'   => esc_html__( 'Padding Bottom', 'cldirectory-core' ),
					'type'    => 'text',
					'default' => 'default',
				],
				'breadcrumb'       => [
					'label'   => __( 'Breadcrumb', 'cldirectory-core' ),
					'type'    => 'select',
					'options' => [
						'default' => __( 'Default from customizer', 'cldirectory-core' ),
						'on'      => __( 'Enable', 'cldirectory-core' ),
						'off'     => __( 'Disable', 'cldirectory-core' ),
					],
					'default' => 'default',
				],
				'footer_style'     => [
					'label'   => __( 'Footer Layout', 'cldirectory-core' ),
					'type'    => 'select',
					'options' => [
						'default' => __( 'Default from customizer', 'cldirectory-core' ),
						'1'       => __( 'Layout 1', 'cldirectory-core' ),
					],
					'default' => 'default',
				],
				'footer_border'    => [
					'label'   => __( 'Footer Border Top', 'cldirectory-core' ),
					'type'    => 'select',
					'options' => [
						'default' => __( 'Default from customizer', 'cldirectory-core' ),
						'on'      => __( 'Enable', 'cldirectory-core' ),
						'off'     => __( 'Disable', 'cldirectory-core' ),
					],
					'default' => 'default',
				],
				'page_color'      => [
					'label'   => esc_html__( 'Page Color', 'cldirectory-core' ),
					'type'    => 'color_picker',
					'desc'  => __( 'If not selected, default will be used', 'cldirectory-core' ),
				],
			],
		],
	],
] );
if ( class_exists( 'Rtcl' ) ) {
	$Postmeta->add_meta_box( 'listing_layout', esc_html__( 'Layout', 'cldirectory-core' ), [ "rtcl_listing" ], '', '', 'high', [
		'fields' => [
			'listing_layout' => [
				'label'   => __( 'Layout', 'cldirectory-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Slider Layout', 'cldirectory-core' ),
					'2'       => __( 'Image Full Width Laout', 'cldirectory-core' ),
				],
				'default' => 'default',
			],
		],
	] );
}
// Listing Car Brand & Year
if ( class_exists( 'Rtcl' )) {
	$Postmeta->add_meta_box( 'cldirectory_listing_details', esc_html__( 'Listing/Author/Company Logo', 'cldirectory-core' ), [ "rtcl_listing" ], '', '', 'default', [
		'fields' => [
			"listing_logo_img" => [
				'label' => esc_html__( 'Logo', 'cldirectory-core' ),
				'type'  => 'image',
				'desc'  => esc_html__( 'This is listing company brand logo.', 'cldirectory-core' ),
			]
		],
	] );
}






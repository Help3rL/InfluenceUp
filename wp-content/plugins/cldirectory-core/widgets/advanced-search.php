<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\CLDirectory_Core;

use radiustheme\CLDirectory\Helper;
use \WP_Widget;
use \RT_Widget_Fields;
use RtclPro\Helpers\Fns;
use Rtcl\Helpers\Functions;

class Advanced_Search extends WP_Widget {

	public function __construct() {
		$id = CLDIRECTORY_CORE_THEME_PREFIX . '_advanced_search';
		parent::__construct(
			$id, // Base ID
			esc_html__( 'CLDirectory: Advanced Search', 'cldirectory-core' ), // Name
			[
				'description' => esc_html__( 'Add advanced search field', 'cldirectory-core' ),
			] );
	}

	public function widget( $args, $instance ) {
		$data = [
			'can_search_by_keyword'         => ! empty( $instance['search_by_keyword'] ) ? 1 : 0,
			'can_search_by_category'        => ! empty( $instance['search_by_category'] ) ? 1 : 0,
			'can_search_by_location'        => ! empty( $instance['search_by_location'] ) ? 1 : 0,
			'can_search_by_listing_types'   => ! empty( $instance['search_by_listing_types'] ) ? 1 : 0,
			'can_search_by_price'           => ! empty( $instance['search_by_price'] ) ? 1 : 0,
			'can_search_by_custom_field'    => ! empty( $instance['search_by_custom_field'] ) ? 1 : 0,
			'can_search_by_radius_search'   => ! empty( $instance['search_by_radius_search'] ) ? 1 : 0,
			'min_price'                     => ! empty( $instance['min_price'] ) ? $instance['min_price'] : 0,
			'max_price'                     => ! empty( $instance['max_price'] ) ? $instance['max_price'] : 5000,
			'instance'                      => $instance,
		];


		$data['args'] = $args;
		$data['data'] = $data; 
		echo $args['before_widget'];
		echo "<div class='advance-search-content'>";
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

		Helper::get_custom_listing_template( 'listing-search-widget', true, $data );
		echo "</div>";
		echo $args['after_widget'];
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title']                     = ! empty( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['search_by_category']        = ! empty( $new_instance['search_by_category'] ) ? 1 : 0;
		$instance['search_by_category']        = ! empty( $new_instance['search_by_category'] ) ? 1 : 0;
		$instance['search_by_location']        = ! empty( $new_instance['search_by_location'] ) ? 1 : 0;
		$instance['search_by_listing_types']   = ! empty( $new_instance['search_by_listing_types'] ) ? 1 : 0;
		$instance['search_by_price']           = ! empty( $new_instance['search_by_price'] ) ? 1 : 0;
		$instance['search_by_keyword']         = ! empty( $new_instance['search_by_keyword'] ) ? 1 : 0;
		$instance['search_by_custom_field']    = ! empty( $new_instance['search_by_custom_field'] ) ? 1 : 0;
		$instance['search_by_radius_search']   = ! empty( $new_instance['search_by_radius_search'] ) ? 1 : 0;
		$instance['min_price']                 = ! empty( $new_instance['min_price'] ) ? absint( $new_instance['min_price'] ) : 0;
		$instance['max_price']                 = ! empty( $new_instance['max_price'] ) ? absint( $new_instance['max_price'] ) : 5000;

		return $instance;
	}

	public function form( $instance ) {
		// Define the array of defaults
		$defaults = [
			'title'                     => __( 'Advanced Search', 'cldirectory-core' ),
			'search_by_category'        => 1,
			'search_by_location'        => 1,
			'search_by_keyword'         => 1,
			'search_by_listing_types'   => 0,
			'search_by_custom_field'    => 1,
			'search_by_radius_search'   => 1,
			'search_by_price'           => 1,
			'min_price'                 => 0,
			'max_price'                 => 5000,
		];


		if ( 'local' !== Functions::location_type() ) {
			$defaults['search_by_location'] = 0;
		}

		// Parse incoming $instance into an array and merge it with $defaults
		$instance = wp_parse_args(
			(array) $instance,
			$defaults
		);

		$fields = [
			'title'                     => [
				'label' => esc_html__( 'Title', 'cldirectory-core' ),
				'type'  => 'text',
			],
			'search_by_keyword'         => [
				'label' => esc_html__( 'Search by Keyword', 'cldirectory-core' ),
				'type'  => 'checkbox',
			],
			'search_by_location'        => [
				'label' => esc_html__( 'Search by Local Location', 'cldirectory-core' ),
				'type'  => 'checkbox',
			],
			'search_by_listing_types'        => [
				'label' => esc_html__( 'Search by Listing Types', 'cldirectory-core' ),
				'type'  => 'checkbox',
			],
			'search_by_radius_search'   => [
				'label' => esc_html__( 'Search by Radius Search', 'cldirectory-core' ),
				'type'  => 'checkbox',
			],
			'search_by_category'        => [
				'label' => esc_html__( 'Search by Category', 'cldirectory-core' ),
				'type'  => 'checkbox',
			],
			'search_by_custom_field'    => [
				'label' => esc_html__( 'Search by Custom Fields', 'cldirectory-core' ),
				'type'  => 'checkbox',
			],
			'search_by_price'           => [
				'label' => esc_html__( 'Search by Price', 'cldirectory-core' ),
				'type'  => 'checkbox',
			],
			'min_price'                 => [
				'label' => esc_html__( 'Minimum Price', 'cldirectory-core' ),
				'type'  => 'number',
			],
			'max_price'                 => [
				'label' => esc_html__( 'Maximum Price', 'cldirectory-core' ),
				'type'  => 'number',
			],

		];

		if ( 'local' !== Functions::location_type() ) {
			unset( $fields['search_by_location'] );
		}

		RT_Widget_Fields::display( $fields, $instance, $this );
	}

}
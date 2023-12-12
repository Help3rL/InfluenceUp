<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\CLDirectory_Core;

use \ReflectionClass;
use Elementor\Widget_Base;
use Rtcl\Helpers\Functions;
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

abstract class Custom_Widget_Base extends Widget_Base {

	public $rt_name;
	public $rt_base;
	public $rt_category;
	public $rt_icon;
	public $rt_translate;
	public $rt_dir;

	public function __construct( $data = [], $args = null ) {
		$this->rt_category = CLDIRECTORY_CORE_THEME_PREFIX . '-widgets'; // Category /@dev
		$this->rt_icon     = 'rdtheme-el-custom';
		$this->rt_dir      = dirname( ( new ReflectionClass( $this ) )->getFileName() );
		parent::__construct( $data, $args );
	}

	public function get_name() {
		return $this->rt_base;
	}

	public function get_title() {
		return $this->rt_name;
	}

	public function get_icon() {
		return $this->rt_icon;
	}

	public function get_categories() {
		return [ $this->rt_category ];
	}

	public function rt_template( $template, $data ) {
		$template_name = DIRECTORY_SEPARATOR . 'elementor-custom' . DIRECTORY_SEPARATOR . basename( $this->rt_dir ) . DIRECTORY_SEPARATOR . $template . '.php';
		if ( file_exists( STYLESHEETPATH . $template_name ) ) {
			$file = STYLESHEETPATH . $template_name;
		} elseif ( file_exists( TEMPLATEPATH . $template_name ) ) {
			$file = TEMPLATEPATH . $template_name;
		} else {
			$file = $this->rt_dir . DIRECTORY_SEPARATOR . $template . '.php';
		}

		ob_start();
		include $file;
		echo ob_get_clean();
	}

	//Get Custom post category:
	protected function rt_get_categories_by_slug( $cat ) {
		$terms   = get_terms( [
			'taxonomy'   => $cat,
			'hide_empty' => true,
		] );
		$options = [ '0' => __( 'All Categories', 'cldirectory-core' ) ];
		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
			foreach ( $terms as $term ) {
				$options[ $term->slug ] = $term->name;
			}

			return $options;
		}
	}

	//Get Custom post category:
	protected function rt_get_categories_by_id( $cat ) {
		$terms   = get_terms( [
			'taxonomy'   => $cat,
			'hide_empty' => true,
		] );
		$options = [ '0' => __( 'All Categories', 'cldirectory-core' ) ];
		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
			foreach ( $terms as $term ) {
				$options[ $term->term_id ] = $term->name;
			}

			return $options;
		}
	}

	//post category list
	function rt_category_list() {
		$categories = get_categories( [ 'hide_empty' => false ] );
		$lists      = [];
		foreach ( $categories as $category ) {
			$lists[ $category->cat_ID ] = $category->name;
		}

		return $lists;
	}



	//get users roles
	function rt_get_users_roles() {
		global $wp_roles;
		$all_roles   = $wp_roles->roles;
		$agent_lists = [];
		foreach ( $all_roles as $index => $user ) {
			$agent_lists[ $index ] = $user['name'];
		}

		return $agent_lists;
	}

	// post tags lists
	function rt_tag_list() {
		$tags     = get_tags( [ 'hide_empty' => false ] );
		$tag_list = [];
		foreach ( $tags as $tag ) {
			$tag_list[ $tag->slug ] = $tag->name;
		}

		return $tag_list;
	}

	//Get all thumbnail size
	function rt_get_all_image_sizes() {
		global $_wp_additional_image_sizes;
		$image_sizes = [ '0' => __( 'Default Image Size', 'cldirectory_core' ) ];
		foreach ( $_wp_additional_image_sizes as $index => $item ) {
			$image_sizes[ $index ] = __( ucwords( $index . ' - ' . $item['width'] . 'x' . $item['height'] ), 'cldirectory_core' );
		}
		$image_sizes['full'] = __( "Full Size", 'cldirectory_core' );

		return $image_sizes;
	}

	//cfg field

	function rt_get_cgf_field(){
		$group_ids = Functions::get_cfg_ids();
	
		$list = [];
		foreach ( $group_ids as $id ) {
			$list[ $id ] = get_the_title( $id );
		}
		return $list;
	}

	//custom field

	function rt_get_custom_field($cfg_id){
		return Functions::get_cf_ids_by_cfg_id($cfg_id);
	}

	//get category list

	function get_category_list($taxonomy='category'){

		$terms             = get_terms( [ 'taxonomy' => $taxonomy, 'fields' => 'id=>name' ] );
		$categories = [];

		if(!empty($terms)){
			foreach ( $terms as $id => $name ) {
				$categories[ $id ] = $name;
			}
		}
		return $categories;
		
	}

}
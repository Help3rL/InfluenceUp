<?php
/**
 * InfluenceUp functions and definitions
 *
 * @package InfluenceUp
 * @since InfluenceUp 0.1
 */

// Enqueue styles and scripts
function influenceup_enqueue_scripts() {
  // Enqueue styles
  wp_enqueue_style( 'influenceup-style', get_stylesheet_uri() );

  // Enqueue scripts
  wp_enqueue_script( 'influenceup-script', get_template_directory_uri() . '/js/script.js', array(), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'influenceup_enqueue_scripts' );

// Register navigation menus
function influenceup_register_menus() {
  register_nav_menus( array(
    'primary' => esc_html__( 'Primary Menu', 'influenceup' ),
    'footer' => esc_html__( 'Footer Menu', 'influenceup' ),
  ) );
}
add_action( 'after_setup_theme', 'influenceup_register_menus' );

// Add theme support
function influenceup_theme_support() {
  // Add support for automatic feed links
  add_theme_support( 'automatic-feed-links' );

  // Add support for post thumbnails
  add_theme_support( 'post-thumbnails' );

  // Add support for title tag
  add_theme_support( 'title-tag' );

  // Add support for HTML5 markup
  add_theme_support( 'html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
  ) );

  // Add support for selective refresh widgets
  add_theme_support( 'customize-selective-refresh-widgets' );
}
add_action( 'after_setup_theme', 'influenceup_theme_support' );

// Custom template tags for this theme
require get_template_directory() . '/inc/template-tags.php';

// Customizer additions
require get_template_directory() . '/inc/customizer.php';

// Load Jetpack compatibility file
if ( defined( 'JETPACK__VERSION' ) ) {
  require get_template_directory() . '/inc/jetpack.php';
}

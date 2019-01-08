<?php
/**
 * @package WordPress
 * @subpackage WP-Mike-Notes
 */

include_once( plugin_dir_path( __FILE__ ) . 'lib/helpers.php' );

//Drag and drop menu support
register_nav_menu( 'primary', 'Primary Menu' );
//This theme uses post thumbnails
add_theme_support( 'post-thumbnails' );


//Enqueue_styles
if ( ! function_exists( 'Wps_load_styles' ) ) {
function Wps_load_styles() {

	wp_register_style( 'skeleton-style', get_template_directory_uri() . '/style.css');
	wp_register_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css');

	wp_enqueue_style( 'bootstrap' );
	wp_enqueue_style( 'skeleton-style' );

	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Open+Sans:300,400,700', array(), false );

	wp_enqueue_script( 'main-theme-js', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), date("ymd-Gis", filemtime( plugin_dir_path( __FILE__) . '/js/main.js' )), true );

}
add_action('wp_enqueue_scripts', 'Wps_load_styles');
} // endif



add_action('after_setup_theme', 'edit_image_sizes', 99);

function edit_image_sizes() {

  	add_image_size('hero', 1400, 550, true);
	add_image_size('square', 320, 320, true );

}


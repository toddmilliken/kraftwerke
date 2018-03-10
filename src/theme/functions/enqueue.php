<?php
/**
 * Enqueue scripts and stylesheets
 *
 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_script/
 *
 * @package   Kraftwerke
 * @since     1.0.0
 */



/**
 * Enqueue CSS stylesheets.
 *
 * @since 1.0.0
 */
function child_enqueue_styles() {
	wp_enqueue_style('theme-font-awesome', get_template_directory_uri() . '/inc/dist/css/font-awesome.min.css', array(), null);
	wp_enqueue_style('roboto', 'https://fonts.googleapis.com/css?family=Roboto:300,400,400i,700,700i,900', array(), null);
	wp_enqueue_style('child-theme-css', get_stylesheet_directory_uri() . '/core/css/child-theme.css', array(), null);
}
add_action('wp_enqueue_scripts', 'child_enqueue_styles');



/**
 * Enqueue javascript files.
 *
 * @since 1.0.0
 */
function child_enqueue_scripts() {
	
	// <head> scripts
	wp_enqueue_script('child-theme-plugins-head', get_stylesheet_directory_uri() . '/core/js/plugins-head.js', array(), null, false);
	wp_enqueue_script('child-theme-head-scripts', get_stylesheet_directory_uri() . '/core/js/child-theme-head.js', array(), null, false);

	// Moves jQuery to the footer to avoid render-blocking scripts from parsing the document 
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), false, null, true );
	wp_enqueue_script( 'jquery' );

	$google_maps_api_key = get_field( 'opts_google_maps_api_key', 'options' );
	if ( ! empty( $google_maps_api_key ) ) {
		wp_enqueue_script( 'child-theme-google-maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyA4ZilO-8ZzrsfnS5nrxlmpKFhR_rPjYik', array(), null, true );
	}
	
	// footer scripts
	wp_enqueue_script('child-theme-plugins-footer', get_stylesheet_directory_uri() . '/core/js/plugins-footer.js', array('jquery'), null, true);
	wp_enqueue_script('child-theme-scripts', get_stylesheet_directory_uri() . '/core/js/child-theme.js', array('jquery', 'child-theme-plugins-footer'), null, true);
}
add_action('wp_enqueue_scripts', 'child_enqueue_scripts', 10);	

function base_enqueue_styles() {
	return false;
}

function base_enqueue_scripts() {
	return false;
}
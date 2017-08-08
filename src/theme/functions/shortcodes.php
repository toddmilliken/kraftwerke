<?php
/**
 * Theme shortcodes
 * 
 * @package  Kraftwerke
 * @since    1.0.0
 */


/**
 * Registers theme shortcode
 *
 * @since    1.0.0
 */
function kwer_register_shortcodes() {
	/**
	 * Declare shortcodes
	 *
	 * @since 1.0.0
	 */
	$shortcodes = array(
		
		// New site shortcode: current year. 
	 	array(
	 		'name'     => 'year', 
	 		'callback' => 'kwer_shortcode_year',
	 	),
	 	
	);
	
	
	
	/**
	 * Register shortcodes
	 *
	 * @since 1.0.0
	 */
	foreach ( $shortcodes as $shortcode ) {
		add_shortcode( $shortcode['name'], $shortcode['callback'] );
	}
	
}
add_action( 'init', 'kwer_register_shortcodes' );



/**
 * New site shortcode: Year
 *
 * Displays the current year using PHP date function
 * Intended for display in the footer copy
 *
 * @since    1.0.0
 *
 * @return   string    Today's year
 */
function kwer_shortcode_year( $atts = array(), $content = null ) {
	return date('Y');
}
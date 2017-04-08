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
	wp_enqueue_style('child-theme-css', get_stylesheet_directory_uri() . '/core/css/child-theme.css', array(), null);
}
add_action('wp_enqueue_scripts', 'child_enqueue_styles');



/**
 * Enqueue javascript files.
 *
 * @since 1.0.0
 */
function child_enqueue_scripts() {
	wp_enqueue_script('child-theme-scripts', get_stylesheet_directory_uri() . '/core/js/child-theme.js', array('jquery', 'child-plugins-footer'), null, true);
}
add_action('wp_enqueue_scripts', 'child_enqueue_scripts', 11);	
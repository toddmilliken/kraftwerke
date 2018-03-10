<?php
/**
 * The front page template (home page)
 *
 * This is the home page of the site. 
 * This template is called when Settings > Reading > 
 * Front Page display is set to:
 * - Your latest posts
 * - A static page equal to Front Page
 *
 * It is NOT called a static page is euqal to Posts Page.  
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package  Kraftwerke
 * @since    1.0.0 
 */

/**
 * If Settings > Reading > Front page display 
 * is set to Your latest posts, locate the posts
 * template and return;
 */
if ( is_home() ) { 
	load_template(get_stylesheet_directory() . '/home.php');
	return;
} 

/**
 * Defines the directory where all the front
 * layers are called from
 */
$partial_dir = 'partials/front-page/';
 
/** Header */
get_header(); 

get_template_part($partial_dir . 'panels');	
get_template_part($partial_dir . 'icon-grid');
get_template_part($partial_dir . 'about');

/**
 * Hook for displaying additional content below the main content.
 */
do_action( 'base_before_main_close' );

/** Footer */
get_footer();
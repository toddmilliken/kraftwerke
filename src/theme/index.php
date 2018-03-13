<?php 
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Base_Theme
 * @since 0.7.0
 */
 
/** Header */
get_header(); 

/** Masthead */
get_template_part('partials/masthead');

/** Standard opening site wrapper */
kwer_main_open();

/**
 * Displays the post content
 *
 * Allows theme developers to hook into the main content area
 * to display specific template information. 
 *
 * @since 0.7.0
 *
 * @see functions/front-end/content.php for template logic
 */
do_action('base_action_content');
	
/** Standard closing site wrapper */
kwer_main_close();

/** Footer */
get_footer();
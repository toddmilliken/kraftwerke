<?php 
/**
 * Displays the site's posts listings
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package  Kraftwerke
 * @since    1.0.0
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
get_template_part('partials/content-posts');

/** Standard closing site wrapper */
kwer_main_close();

/** Footer */
get_footer();
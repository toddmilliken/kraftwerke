<?php 
/**
 * Displays the site's search results
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

/** Displays the posts */
get_template_part('partials/content-posts');

/** Pagination */
get_template_part('partials/pagination');

/** Standard closing site wrapper */
kwer_main_close();

/** Footer */
get_footer();
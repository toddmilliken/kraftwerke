<?php
/**
 * The Wordpress loop
 *
 * Displays post snippets on a listings page. 
 * If posts are found, fetch the_content. Else, display the 404 content. 
 *
 * @package  Kraftwerke
 * @since    1.0.0
 */

if ( have_posts() ) {
	while ( have_posts() ) : the_post();
		
		$post_id = get_the_id();
		
		// Args for displaying theme's listing style
		$args = array(
			'title'    => get_the_title() ,
			'excerpt'  => apply_filters( 'the_excerpt', get_the_excerpt() ) ,
			'link_url' => get_permalink() ,
			'meta'     => kwer_post_meta( $post_id ) ,
		);
		
		// Conditionally add post category
		$term_links = kwer_term_links( $post_id );
		if ( ! empty($term_links) ) {
			$args['terms'] = $term_links;
		}
		
		// Call the listing style
		kwer_media_block( $args );
		
	endwhile;	
} else {
	if ( is_search() ) {
		echo apply_filters( 'the_content', get_option('options_opts_no_search_text') );
	}
}

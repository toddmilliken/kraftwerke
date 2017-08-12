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
?>
	<div class="content-posts<?php echo ( !is_search() ? ' content-posts--flex' : '' ); ?>">
<?php
	while ( have_posts() ) : the_post();
		
		$post_id = get_the_id();
		
		// Args for displaying theme's listing style
		$args = array(
			'title'    => get_the_title() ,
			'excerpt'  => apply_filters( 'the_excerpt', get_the_excerpt() ) ,
			'link_url' => get_permalink() ,
			'meta'     => kwer_post_meta( $post_id ) ,
		);
		
		// Featured Image
		if ( has_post_thumbnail() ) {
			$args['img_id'] = get_post_thumbnail_id();
		}
		
		// Conditionally add post category
		$term_links = kwer_term_links( $post_id );
		if ( ! empty($term_links) ) {
			$args['terms'] = $term_links;
		}
		
		// Tags
/*
		$tag_links = array();
		$tags = get_the_tags( $post_id );
		if ( ! empty($tags) && ! is_wp_error($tags) ) {
			foreach ( $tags as $tag ) {
				$tag_links[] = '<a href="' . get_tag_link($tag) . '">' . $tag->name . '</a>';
			}
			$args['tags'] = $tag_links;
		}
*/
		
		if ( is_search() ) {
			// Call the listing style
			kwer_block_media( $args );
		} else {
			// Only style sticky posts if on the first page. 
			// If not the first page, do not add sticky class.
			if ( is_sticky() && !get_query_var('paged') ) {
				$args['classes'][] = 'block-card--sticky';
			}
			// Call the card style
			kwer_block_card( $args );
		}
		
	endwhile;	
?>
	</div>
<?php	
	kwer_pagination(array('echo' => true));
} else {
	if ( is_search() ) {
		echo apply_filters( 'the_content', get_option('options_opts_no_search_text') );
	}
}

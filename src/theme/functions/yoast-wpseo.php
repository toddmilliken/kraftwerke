<?php
/**
 * Modifies Wordpress SEO by Yoast plugin
 *
 * @package  Kraftwerke
 * @since    1.0.0
 */



/**
 * Prevent breadcrumb trail from appearing on certain pages
 *
 * @link   http://hookr.io/plugins/yoast-seo/3.6.1/files/frontend-class-breadcrumbs/
 *
 * @since  1.0.0
 */
function isc_yoast_breadcrumb_output( $output )
{	
	// Return false if this is the resources overview && its top-level. 
	global $post;
	
	// Return false if top level
	if ( empty( get_post_ancestors($post) ) ) {
		return false;
	}
	
	return $output;
}
add_filter( 'wpseo_breadcrumb_output', 'isc_yoast_breadcrumb_output' );



/**
 * Filters the post breadcrumb trail. 
 *
 * This function allows developers to modify the breadcrumb trail posts before display.
 * It conditionally overwrites the breadcrumb trail for post types that use rewrite rules
 * to set post-type page parents. 
 *
 * Example
 *
 * Default:        {archive} -> {postname}
 * Desired Result: {rewrite rule} -> {archive} -> {postname} or
 *                 {rewrite rule} -> {postname}
 *
 * Instead of /event/postname/ we usually want /about-us/events/postname/
 *
 * @since 1.0.0
 *
 * @link https://wordpress.org/support/topic/remove-current-post-title-from-breadcrumbs
 *
 * @param array $links The array of breadcrumbs containing each post's title and permalink.
 * @return array $links
 */
function em_wpseo_breadcrumb_links( $links ) {
	
	/** Creates an empty array of custom breadcrumb links. */
	$breadcrumb_links = array();
	/**
	 * Custom Post Types
	 */
	$parent = false;
	if ( is_singular( array('news-item', 'event') ) ) {
		$post_type = get_post_type();
		$news_event_opts = get_option( 'em_news_events_settings' );
		if ( $post_type === 'news-item' ) {
			$parent = ( isset($news_event_opts['news_parent']) ? $news_event_opts['news_parent'] : false );
		} else {
			$parent = ( isset($news_event_opts['event_parent']) ? $news_event_opts['event_parent'] : false );
		}
		if ( $parent ) {
			// 1) PUSH ANCESTORS OF PARENT, IF ANY TO BREADCRUMB
			if ( $ancestors = em_get_breadcrumbs( $parent ) ) :
				foreach ( $ancestors as $a ) :
					array_push( $breadcrumb_links, $a );
				endforeach;
			endif;
			// 2) APPEND THE PARENT TO THE END OF THE TRAIL
			array_push( $breadcrumb_links, array(
				'url' => get_permalink( $parent ),
				'text' => get_the_title( $parent )
			) );
		}
	}
	
	/** 
	 * Insert the new breadcrumb trail, conditionally after the home page.
	 */
	$wpseo_breadcrumb_opts = get_option('wpseo_internallinks');
	if ( !empty($breadcrumb_links) ) :
		if ( $wpseo_breadcrumb_opts['breadcrumbs-home'] ) {
			//insert after home page icon
			array_splice( $links, 1, 0, $breadcrumb_links );	
		} else {
			array_splice( $links, 0, 0, $breadcrumb_links );	
		} 
		return $links;
	else :
		return $links;
	endif;
}
//add_filter( 'wpseo_breadcrumb_links', 'em_wpseo_breadcrumb_links' );



/**
 * Generates breadcrumb trails for any post ID.
 *
 * Helper function. Requires post id. Retrieve's post ancestors given the post id,
 * and returns them in the format for the wpseo_breadcrumb_links filter. 
 *
 * @since 1.0.0
 *
 * @param int $post_id The post ID to return a breadcrumb trail for. 
 * @return array $breadcrumb_links Array of post ancestors containing the permalink and post title. 
 */
function em_get_breadcrumbs( $post_id ) {
	
	/** Creates an empty array of breadcrumb links. */
	$breadcrumb_links = array();
	
	/** If this post has ancestors, begin creation of breadcrumb trail. */
	if ( $ancestor_ids = get_post_ancestors( $post_id ) ) :
	
		/** Iterate thru each ancestor. */
		foreach ( $ancestor_ids as $ancestor ) :
		
			/** Prepend each ancestor as we traverse up to top-level parent */
			array_unshift( $breadcrumb_links, array(
				'url' => get_permalink( $ancestor ),
				'text' => get_the_title( $ancestor ),
			) );
			
		endforeach;
	endif;
	
	return $breadcrumb_links;
	
}
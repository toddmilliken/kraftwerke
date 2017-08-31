<?php
/**
 * Theme template hooks
 * 
 * @package  Kraftwerke
 * @since    1.0.0
 */



/**
 * Modify query
 *
 * Uses pre_get_posts hook to modify the main query.
 *
 * @since    1.00
 */
function kwer_pre_get_posts( $query ) {

	if ( !is_admin() && $query->is_main_query() ) {
		
		// Modify search results to exclue posts defined in Options. 		
		if ( $query->is_search() ) {
		
			if ( $opts_exclude_ids = get_option( 'options_opts_exclude_posts' ) ) {
				$query->set( 'post__not_in', $opts_exclude_ids );	
			}
			
		}
		
	};
	
}
add_action( 'pre_get_posts', 'kwer_pre_get_posts' );



function kwer_acf_google_map_api( $api ){
	
	$api['key'] = get_option('option_opts_google_maps_api_key') ;
	
	return $api;
	
}

add_filter('acf/fields/google_map/api', 'kwer_acf_google_map_api');
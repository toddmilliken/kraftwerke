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
	
	$api['key'] = get_field( 'opts_google_maps_api_key', 'options' ) ;
	
	return $api;
	
}

add_filter('acf/fields/google_map/api', 'kwer_acf_google_map_api');

function kwer_google_map() {
	get_template_part( 'partials/google-map' );
}
add_action( 'base_before_main_close', 'kwer_google_map' );

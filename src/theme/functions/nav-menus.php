<?php
/**
 * Child theme navigation menus
 *
 * @package  Kraftwerke
 * @since    1.0.0
 */
 
 

/**
 * Starts the element output.
 *
 * @since 3.0.0
 * @since 4.4.0 The {@see 'nav_menu_item_args'} filter was added.
 *
 * @see Walker::start_el()
 *
 * @param string   $output Passed by reference. Used to append additional content.
 * @param WP_Post  $item   Menu item data object.
 * @param int      $depth  Depth of menu item. Used for padding.
 * @param stdClass $args   An object of wp_nav_menu() arguments.
 * @param int      $id     Current item ID.
 */
function kwer_filter_nav_menu_start_el( $output, $item, $depth = 0, $args = array(), $id = 0 ) {
	
	/**
	 * Mobile Menu toggle controls
	 * Adds a toggle control to expand submenus when viewing in mobile context.
	 */
	if ( in_array('menu-item-has-children', $item->classes) ) {
		
		// Target all current-menu items so they are expanded by default in mobile			
		if ( in_array( 'current-menu-item', $item->classes) || in_array( 'current-menu-ancestor', $item->classes) ) {
			$output .= '<span class="toggle-control toggle-control--active"></span>';
		} else {
			$output .= '<span class="toggle-control"></span>';	
		}
		
	}	
	
	return $output;
	
}
add_filter( 'walker_nav_menu_start_el', 'kwer_filter_nav_menu_start_el', 20, 5 );
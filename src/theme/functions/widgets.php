<?php
/**
 * Theme widgets
 *
 * Extends the theme by adding widgets.
 * 
 * @package  Kraftwerke
 * @since    1.0.0
 */
 


/**
 * Register new widgets
 *
 * @since    1.0.0
 */
function kwer_load_widgets() {
	
	// Call-to-action button link
    register_widget( 'Kwer_Widget_CTA_Btn' );
    register_widget( 'Kwer_Widget_Text' );
    
}
add_action( 'widgets_init', 'kwer_load_widgets', 11 );
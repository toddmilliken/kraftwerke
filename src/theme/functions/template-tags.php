<?php
/**
 * Theme template tags
 *
 * Declares common theme components and functions
 * 
 * @package Kraftwerke
 * @since   1.0.0
 */
 
 
 
/**
 * Site Wrapper - Open
 *
 * @since 1.0.0
 */
function kwer_wrapper_open( $args = array() ) {
	?>
	<div class="outer-wrapper">
		<div class="site-wrapper">
	<?php
}
 
 
/**
 * Site Wrapper - Close
 *
 * @since 1.0.0
 */
function kwer_wrapper_close( $args = array() ) {
	?>
			</div>
		</div>
	<?php
}
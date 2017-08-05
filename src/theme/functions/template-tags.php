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
 * @since   1.0.0
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
 * @since   1.0.0
 */
function kwer_wrapper_close( $args = array() ) {
	?>
			</div>
		</div>
	<?php
}



/**
 * The opening HTML for the default template. 
 * Opens the "main" element that encloses everything between site header and footer. 
 * Opens the default content w/ sidebar layer, and conditionally calls the default sidebar.
 *
 * @param   array   $args
 *
 * @since   1.0.0
 */
function kwer_main_open( $args = array() ) {
	
	/** Default arguments */
	$default_args = array(
		'main_class' => '' ,
		'sidebar'    => true ,
		'no_content' => get_field('suppress_post_content') // hides the default layer
	);
	
	/** Merge passed arguments with defaults */
	$args = wp_parse_args( $args, $default_args );
	
	/**
	 * Hook for displaying additional content before opening main tag.
	 * @since 1.0.0
	 */	
	do_action('kwer_before_main_open'); ?>
	
	<main class="main<?php echo ( !empty($args['main_class']) ? ' ' . $args['main_class'] : '' ); ?>">
		
	<?php 
	/**
	 * Hook for displaying additional content before the default layer, but after opening main tag.
	 * @since 1.0.0
	 */	
	do_action('kwer_after_main_open'); 
	
	if ( ! $args['no_content'] ) : ?>
		<!-- start content w/ sidebar layer -->
		<section class="layer layer--default">
			<div class="layer__body">
				<div class="inner">
					<div class="layer__content-wrapper">
	
						<?php 
							/** Conditionally calls the sidebar */
							if ( $args['sidebar'] === true ) {
								get_sidebar(); 							
							}
						?>
						
						<article class="layer__content">
							
							<?php
								/**
								 * Hook for displaying content before the loop.
								 * @since 1.0.0
								 */	
								 do_action('kwer_before_the_content');
							 
	endif;			 
			
	
}
 
 

/**
 * The closing HTML for the default template, enclosing the default content w/ sidebar layer
 * and the "main" element that wraps all content between header and footer.
 * 
 * @since 1.0.0
 */
function kwer_main_close( $args = array() ) {
		
	/** Default arguments */
	$default_args = array(
		'no_content' => get_field('suppress_post_content') // hides the default layer
	);
	
	/** Merge passed arguments with defaults */
	$args = wp_parse_args( $args, $default_args );
	
	if ( ! $args['no_content'] ) :
	 
		 					/**
							 * Hook for displaying additional content after the loop.
							 * @since 1.0.0
							 */	
							do_action('kwer_after_the_content'); ?>
							
						</article><!-- closes article.main__content -->
					</div><!-- closes .layer__content-wrapper -->
				</div><!-- closes .inner -->
			</div><!-- closes .layer__body -->
		</section><!-- closes .layer -->
		
		<?php 
	endif;

	/**
	 * Hook for displaying additional content below the default layer, but before closing main tag.
	 * @since 1.0.0
	 */	
	do_action('kwer_before_main_close'); ?>
			
	</main>
	
	<?php 
	/**
	 * Hook for displaying additional content after closing main tag.
	 * @since 1.0.0
	 */	
	do_action('kwer_after_main_close'); 
	
}




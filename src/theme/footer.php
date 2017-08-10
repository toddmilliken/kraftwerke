<?php 
/**
 * The template for displaying the footer
 *
 * Displays the closing site wrapper and body/html tag
 *
 * @package  Kraftwerke
 * @since    1.0.0
 */
?>
		<footer class="site-footer">
			<div class="inner">
				<div class="site-footer__flex">
					<?php if ( $footer_copy = get_option('options_opts_footer') ) : ?>
						<div class="site-footer__copy"><?php echo apply_filters( 'the_content', $footer_copy ); ?></div>
					<?php endif; ?>
					<div class="site-footer__social">
						<?php base_social(array('title_text' => __('Follow Us', 'kraftwerke') . ':')); ?>
					</div>
				</div>
			</div>
		</footer>
<?php
			
		 // Site wrapper - open 
		kwer_wrapper_close();
		
		// WP Footer hook
		wp_footer();
		
?>
	</body>
</html>
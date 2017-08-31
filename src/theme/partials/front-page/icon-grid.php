<?php 
$post_id = get_the_id();
if ( $icon_items = get_post_meta( $post_id, 'icon_layer_items', true ) ) : ?>
	<section class="layer layer--front-page layer--icon-grid text-center">
		<div class="inner">
		<?php 
			
			// Headline
			if ( $icon_items_headline = get_post_meta( $post_id, 'icon_layer_headline', true ) ) {
				echo '<h2 class="layer__heading layer__heading--front-page">' . nl2br($icon_items_headline) . '</h2>';
			}
			
			// Grid
			echo '<div class="grid grid--thirds grid--icons">';
			for ($x = 0; $x < $icon_items; $x++) : 
				$icon_item_html = '';
				$icon_item_fa_class = get_post_meta( $post_id, 'icon_layer_items_' . $x . '_layer_icon_item_icon', true );
				$icon_item_headline = get_post_meta( $post_id, 'icon_layer_items_' . $x . '_layer_icon_item_headline', true );
				$icon_item_desc     = get_post_meta( $post_id, 'icon_layer_items_' . $x . '_layer_icon_item_desc', true );
				$icon_item_link_id  = get_post_meta( $post_id, 'icon_layer_items_' . $x . '_layer_icon_item_link_internal', true );
		?>
				<div class="grid__item">
					<div class="block-icon">
						<?php
							
							// icon
							if ( !empty($icon_item_fa_class) ) {
								$icon_item_html .= '<div class="block-icon__icon-wrapper"><i class="block-icon__icon fa ' . $icon_item_fa_class . '"></i></div>';
							}
							
							$icon_item_html .= '<div class="block-icon__body">';
								
								// Headline
								if ( !empty($icon_item_headline) ) {
									$icon_item_html .= '<h3 class="block-icon__headline">' . $icon_item_headline . '</h3>';
								}
								
								// Desc
								if ( !empty($icon_item_desc) ) {
									$icon_item_html .= '<p class="block-icon__description">' . nl2br($icon_item_desc) . '</p>';
								}
							
							$icon_item_html .= '</div>';
							
							// Link
							if ( !empty($icon_item_link_id) ) {
								$icon_item_html = '<a class="block-icon__link-wrapper" href="' . get_permalink($icon_item_link_id) . '">' . $icon_item_html . '</a>';
							}
							
							// Output
							echo $icon_item_html
						?>
					</div>
				</div>
				
		<?php 
			endfor; 
			echo '</div>'; // close the grid
			
			// See All Link
			$icon_grid_link_id   = get_post_meta( $post_id, 'icon_layer_link_internal', true );
			$icon_grid_link_text = get_post_meta( $post_id, 'icon_layer_link_text', true );
			
			if ( !empty($icon_grid_link_id) && !empty($icon_grid_link_text) ) {
				?>
				<div class="layer__view-all-link text-center">
					<a href="<?php echo get_permalink($icon_grid_link_id); ?>" class="more"><?php echo $icon_grid_link_text; ?></a>
				</div>
				<?php
			}
			
			
		?>
		</div>
	</section>
<?php endif; ?>
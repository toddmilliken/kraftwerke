<?php
	$cta_label     = get_post_meta( $post_id, 'panel_cta_label', true );
	$cta_title     = get_post_meta( $post_id, 'panel_cta_title', true );
	$cta_desc      = get_post_meta( $post_id, 'panel_cta_description', true );
	$cta_link_id   = get_post_meta( $post_id, 'panel_cta_link_internal', true );
	$cta_link_text = get_post_meta( $post_id, 'panel_cta_link_text', true );
	$cta_img_id    = get_post_meta( $post_id, 'panel_cta_img', true );
	$cta_img       = wp_get_attachment_image_src( $cta_img_id, '16-9-xs' );
	$cta_img_alt   = get_post_meta( $cta_img_id, '_wp_attachment_image_alt', true );
	$cta_query_str = get_post_meta( $post_id, 'panel_cta_link_query_string', true );
	if ( empty($cta_query_str) ) {
		$cta_query_str = '';
	} else {
		$cta_query_str = '?' . $cta_query_str;
	}

?>
<?php if ( $cta_link_id || $cta_title || $cta_desc ) : ?>
<div class="panel-cta-wrapper">
	<div class="inner">
		<div class="panel-cta">
			<?php if ( !empty($cta_label) ) : ?>	
				<div class="panel-cta__heading"><?php echo $cta_label; ?></div>
			<?php endif; ?>
			<div class="block-card">
				<?php if ( !empty($cta_link_id) ) : ?>
					<a class="block-card__link-wrapper" href="<?php echo esc_url( get_permalink($cta_link_id) . $cta_query_str ); ?>">
				<?php endif; ?>
					<div class="block-card__body">	
						<?php if ( $cta_img ) : ?>				
						<div class="block-card__media frame frame--16-9">
							<picture>
								<img class="frame__media" data-original="<?php echo $cta_img[0]; ?>" alt="<?php echo $cta_img_alt; ?>" width="<?php echo $cta_img[1]; ?>" height="<?php echo $cta_img[2]; ?>" >
							</picture>
						</div>
						<?php endif; ?>
						<?php if ( !empty($cta_title) ) : ?>
							<h3 class="block-card__title"><?php echo $cta_title; ?></h3>
						<?php endif; ?>
						<?php if ( !empty($cta_desc) ) : ?>
						<div class="block-card__excerpt">
							<p><?php echo nl2br($cta_desc); ?></p>
						</div>
						<?php endif; ?>
						<?php if ( !empty($cta_link_id) && !empty($cta_link_text) ) : ?>
							<span class="block-card__link more"><?php echo $cta_link_text; ?></span>
						<?php endif; ?>
					</div>
				<?php if ( !empty($cta_link_id) ) : ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
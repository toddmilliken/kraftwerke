<?php
/**
 * The front page hero panels
 *
 * @package  Kraftwerke
 * @since    1.0.0 
 */

	// LINK
	$link_text = get_field('panel_link_text') ? get_field('panel_link_text') : 'Learn More';
	switch ( get_field('panel_link_type') ) :
		case 'custom' :
			$link_target = get_field('panel_link_target') ? '_blank' : '_self';
			$link_url = get_field('panel_link_custom');
			break;								
		case 'internal' :
			$link_target = '_self';
			$link_url = get_field('panel_link_internal');
			break;								
	endswitch;
?>
<section class="panel">
	<div class="panel__messaging-wrapper">
		<div class="inner">
			<div class="panel__messaging">
				
				<?php if ( $link_url ) : ?>
					<a class="panel__link" href="<?php echo $link_url; ?>" target="'<?php echo $link_target; ?>">
				<?php endif; ?>
				
				<?php if ( $title = get_field('panel_headline') ) : ?>
					<h1 class="panel__title"><?php echo $title; ?> </h1>
				<?php endif; ?>
				
				<?php if ( $excerpt = get_field('panel_description') ) : ?>
					<p class="panel__excerpt"><?php echo strip_tags($excerpt, '<br><strong><i><b>'); ?></p>
				<?php endif; ?>
				
				<?php echo ( $link_url ? '<span class="more">' . $link_text . '</span>' : '' ); ?>
				
				<?php if ( $link_url ) : ?>
					</a>
				<?php endif; ?>
				
			</div>
		</div>
	</div>
	<?php if ( $images = get_field('panel_images') ) : ?>	
	<div id="js-panel-images" class="panel__images">
		<?php foreach ( $images as $image ) : 
			$desktop = $image['panel_img'];
		?>
		<div class="picturefill-background panel__image">
			<span data-src="<?php echo $desktop['url']; ?>" data-media="(min-width: 1025px)"></span>
		</div>	
		<?php endforeach; ?>
	</div>
	<?php endif; ?>	
</section>
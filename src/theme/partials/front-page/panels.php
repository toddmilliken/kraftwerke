<?php
/**
 * Front Page: Hero Panels
 *
 * Displays a large image carouel with messaging.
 *
 * @package  Kraftwerke
 * @since    1.0.0
 */
$post_id       = get_the_id();
$panel_images  = get_post_meta( $post_id, 'panel_images', true );
$panel_link    = get_post_meta( $post_id, 'panel_link', true );
$panel_message = get_post_meta( $post_id, 'panel_messaging', true );
?>
<section class="panels">
	<?php if ( ! empty($panel_message) ) : ?>
	<div class="panel">
		<div class="panel__body">
			<div class="inner">
				<h1>
					<?php if ( ! empty($panel_link) ) : ?>
						<a href="<?php echo get_permalink( $panel_link ); ?>"><?php echo nl2br( $panel_message ); ?></a>
					<?php else : ?>
						<?php echo nl2br( $panel_message ); ?>
					<?php endif; ?>
				</h1>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<?php if ( ! empty( $panel_images ) ) : ?>
		<div class="panel-slides">
			<?php for ($x = 0; $x < $panel_images; $x++) : 
				$attachment_id = get_post_meta( $post_id, 'panel_images_' . $x . '_panel_img', true );
				$attachment    = wp_get_attachment_image_src( $attachment_id, '16-9-xl' );
				$img_alt       = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );
				$xl_url        = $attachment[0];
				$lg_url        = wp_get_attachment_image_url( $attachment_id, '16-9-lg' );
				$md_url        = wp_get_attachment_image_url( $attachment_id, 'panel-tablet' );
				$sm_url        = wp_get_attachment_image_url( $attachment_id, 'panel-mobile' );
			?>
			<div class="panel-slide">
				<div class="frame frame--dark frame--cover">
					<picture>
						<source media="(min-width: 1201px)" data-original-set="<?php echo $xl_url; ?>" />
						<source media="(min-width: 1025)" data-original-set="<?php echo $lg_url; ?>" />
						<source media="(min-width: 641px)" data-original-set="<?php echo $md_url; ?>" />
						<img class="frame__media" alt="" data-original="<?php echo $sm_url; ?>" width="<?php echo $attachment[1]; ?>" height="<?php echo $attachment[2]; ?>" alt="<?php echo esc_attr($img_alt); ?>">
					</picture>
				</div>
			</div>
			<?php endfor; ?>
		</div>
	<?php endif; ?>
</section>
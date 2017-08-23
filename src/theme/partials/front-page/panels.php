<?php
/**
 * Front Page: Hero Panels
 *
 * Displays a large image carouel with messaging.
 *
 * @package  Kraftwerke
 * @since    1.0.0
 */
$post_id = get_the_id();
?>
<section class="panels">
	<div class="panel">
		<div class="panel__body">
			<div class="inner">
				<!-- Panel Messaging -->
				<?php include 'panel-message.php'; ?>
			</div>
		</div>
	</div>
	<?php include 'panel-slides.php'; ?>
</section>
<!-- Panel Call-to-Action -->
<?php include 'panel-cta.php'; ?>
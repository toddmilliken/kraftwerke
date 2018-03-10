<?php 

$location = get_field( 'opts_map_location', 'options' );
$content  = get_field( 'opts_map_content', 'options' );

if ( ! empty( $location ) ) :
?>
<section class="layer layer--google-map">
	<?php if ( ! empty( $content ) ) : ?>
		<div class="map-content">
			<DIV class="inner">
				<div class="map-content__inner">
					<?php echo $content; ?>
				</div>
			</div>
		</div>
	<?php endif; ?>
	<div class="fullwidth-map acf-map">
		<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">
			<?php if ( ! empty( get_field( 'opts_google_map_marker_content', 'options' ) ) ) : ?>
				<div class="marker-content">
					<?php echo get_field( 'opts_google_map_marker_content', 'options' ); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
<?php endif; ?>
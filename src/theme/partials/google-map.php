<?php 

$location = get_field( 'opts_map_location', 'options' ) ;

if ( ! empty( $location ) ) :
?>
<section class="layer layer--google-map">
	<div class="map-content">
		<DIV class="inner">
			<div class="map-content__inner">
				<h2> Directions</h2>
				<p>Lorem ipsum dolor amet 90's vaporware synth pinterest succulents art party butcher pour-over try-hard lumbersexual hell of literally taiyaki intelligentsia schlitz. </p>
				<p>Tilde tattooed farm-to-table, kitsch literally wayfarers pickled organic poke crucifix viral live-edge four loko shabby chic pinterest. </p>
				<a class="more" href="#">Contact Us</a>
			</div>
		</div>
	</div>
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
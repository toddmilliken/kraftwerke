<?php
/**
 * Google Maps layer
 *
 * @since    1.0.0
 * @package  Kraftwerke
 */

$location = get_field( 'opts_map_location', 'options' );
$content  = get_field( 'opts_map_content', 'options' );

if ( ! empty( $location ) ) :
?>
<section class="layer layer--google-map">
	<?php if ( ! empty( $content ) ) : ?>
		<div class="map-content">
			<div class="map-content__inner">
				<?php echo wp_kses_post( $content ); ?>
			</div>
		</div>
	<?php endif; ?>
	<div class="fullwidth-map acf-map">
		<div class="marker" data-lat="<?php echo esc_attr( $location['lat'] ); ?>" data-lng="<?php echo esc_attr( $location['lng'] ); ?>">
			<?php if ( ! empty( get_field( 'opts_google_map_marker_content', 'options' ) ) ) : ?>
				<div class="marker-content">
					<?php the_field( 'opts_google_map_marker_content', 'options' ); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
<?php endif; ?>

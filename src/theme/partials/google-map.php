<?php 

$location = get_option('option_opts_map_location');

if( !empty($location) ):
?>
<div class="fullwidth-map acf-map">
	<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
</div>
<?php endif; ?>
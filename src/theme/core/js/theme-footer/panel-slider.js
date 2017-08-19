(function($) {
	
	/**
	 * Conditionally fire a slick carousel for 
	 * each instance of .panel-slides
	 */
	var maybeInitPanels = function() {
		$('.panel-slides').each(function(i) {
			$this = $(this);
			if ( $this.find('.panel-slide').length > 1 ) {
				initSlick( $this );
			}
		});
	};
	
	/**
	 * Initialize Slick Carousel for a particular instance.
	 */
	var initSlick = function( $slider ) {

		$slider.slick({
			arrows: false ,
			autoplay: true,
			autoplaySpeed: 7000,
			cssEase: 'linear',
			dots: false,
			fade: true,
			slidesToShow: 1,
			swipe: false
		});
		
	};

	$(document).ready(function($) {
		maybeInitPanels();
	});
	
}(jQuery));
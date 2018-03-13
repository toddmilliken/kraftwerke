(function($) {
	

	/**
	 * initPrettyForms
	 * Initial Uniform for file uploads and wrap all non-multiselect <select> elements in a container to allow for better styling
	 */	
	var initPrettyForms = function() {
		
		// Run unform on upload elements only.
		if ( $('[type="file"]').length ) {
			$('[type="file"]').each(function(){
				var $this = $(this);	
							
				//! if .uploader is not the parent, add it.
				if ( !$this.parent().hasClass('uploader') ) {
					var classes = $(this).attr('class');
					$this.uniform();
					$this.removeClass(classes).parents('.uploader').addClass(classes);
				}
			});
		}
	
		// Fixes issue on Windows Chrome where 'ginput_container_fileupload' class is not being appended
		$('input[type="file"]').each(function(){
			$uploadElement = $(this);
			$uploadElement.closest('.ginput_container').addClass('ginput_container_fileupload');
		});
	
		// Wrap <div> with the class 'selector' around all <select> elements that do not have the 'multiple' attribute
		if ( $('select').length ) {
			$('select').not('[multiple="multiple"]').each(function(){
				var $this = $(this);
		
				//! if .selector is not the parent, add it.
				if ( !$this.parent().hasClass('selector') ) {
					var classes = $(this).attr('class');
					$this.wrapAll('<div class="selector">');
					$this.removeClass(classes).parents('.selector').addClass(classes);
				}
			});
		}
		
	};	



	/**
	 * initGravityFormsPostRender
	 * Re-run Uniform functions on gravity forms reloads (without page refresh).
	 */	
	var initGravityFormsPostRender = function() {

		$(document).bind('gform_post_render', function(){
			initPrettyForms();
		});
		
	};
	
	

	$(document).ready(function($) {
		initPrettyForms();
		initGravityFormsPostRender();
	});
	
}(jQuery));
(function($) {
	
/*
*  new_map
*
*  This function will render a Google Map onto the selected jQuery element
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$el (jQuery element)
*  @return	n/a
*/

function new_map( $el ) {
	
	// var
	var $markers = $el.find('.marker');
	
	
	// vars
	var args = {
		zoom		: 16,
		center		: new google.maps.LatLng(0, 0),
		mapTypeId	: google.maps.MapTypeId.ROADMAP,
		mapTypeControl: false,
		scrollwheel: false,
		styles      : [
			{
				"featureType": "all",
				"elementType": "labels.text.fill",
				"stylers": [
					{
						"visibility": "on"
					},
					{
						"color": "#ffffff"
					}
				]
			},
			{
				"featureType": "all",
				"elementType": "labels.text.stroke",
				"stylers": [
					{
						"color": "#ffffff"
					},
					{
						"visibility": "on"
					},
					{
						"weight": 0.9
					}
				]
			},
			{
				"featureType": "all",
				"elementType": "labels.icon",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "administrative",
				"elementType": "geometry",
				"stylers": [
					{
						"color": "#767676"
					},
					{
						"weight": 0.7
					}
				]
			},
			{
				"featureType": "administrative.province",
				"elementType": "geometry",
				"stylers": [
					{
						"visibility": "on"
					},
					{
						"color": "#ffffff"
					},
					{
						"weight": "2"
					}
				]
			},
			{
				"featureType": "administrative.province",
				"elementType": "labels",
				"stylers": [
					{
						"visibility": "on"
					}
				]
			},
			{
				"featureType": "administrative.locality",
				"elementType": "labels",
				"stylers": [
					{
						"visibility": "on"
					}
				]
			},
			{
				"featureType": "administrative.locality",
				"elementType": "labels.text.fill",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "administrative.neighborhood",
				"elementType": "labels",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "administrative.neighborhood",
				"elementType": "labels.text",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "landscape",
				"elementType": "geometry",
				"stylers": [
					{
						"color": "#767676"
					}
				]
			},
			{
				"featureType": "poi",
				"elementType": "geometry",
				"stylers": [
					{
						"color": "#767676"
					}
				]
			},
			{
				"featureType": "poi",
				"elementType": "labels",
				"stylers": [
					{
						"visibility": "simplified"
					}
				]
			},
			{
				"featureType": "poi",
				"elementType": "labels.text",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "road.highway",
				"elementType": "geometry",
				"stylers": [
					{
						"color": "#42ab9e"
					}
				]
			},
			{
				"featureType": "road.highway",
				"elementType": "labels.text",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "road.highway",
				"elementType": "labels.icon",
				"stylers": [
					{
						"visibility": "on"
					}
				]
			},
			{
				"featureType": "road.arterial",
				"elementType": "geometry",
				"stylers": [
					{
						"color": "#767676"
					},
					{
						"lightness": -20
					}
				]
			},
			{
				"featureType": "road.local",
				"elementType": "geometry",
				"stylers": [
					{
						"color": "#767676"
					},
					{
						"lightness": -17
					}
				]
			},
			{
				"featureType": "transit",
				"elementType": "geometry",
				"stylers": [
					{
						"color": "#767676"
					},
					{
						"lightness": -10
					}
				]
			},
			{
				"featureType": "transit",
				"elementType": "labels.icon",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "water",
				"elementType": "geometry",
				"stylers": [
					{
						"color": "#004358"
					}
				]
			}
		]
	};
	
	
	// create map	        	
	var map = new google.maps.Map( $el[0], args);
	
	
	// add a markers reference
	map.markers = [];
	
	
	// add markers
	$markers.each(function(){
		
    	add_marker( $(this), map );
		
	});
	
	if ( $(window).width() > 760 ) {
		map.panBy(-300, -80 )
	} else {
		map.panBy(0, -120 )
	}
	// center map
	center_map( map );


	
	
	// return
	return map;
	
}

/*
*  add_marker
*
*  This function will add a marker to the selected Google Map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$marker (jQuery element)
*  @param	map (Google Map object)
*  @return	n/a
*/

function add_marker( $marker, map ) {

	// var
	var lat = $marker.attr('data-lat');
	var lng = $marker.attr('data-lng');
	var latlng = new google.maps.LatLng( lat, lng );

	// create marker
	var marker = new google.maps.Marker({
		icon        : "data:image/svg+xml;charset=UTF-8,%3csvg baseProfile='basic' xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 48 48'%3e%3cpath fill='#42ab9e' stroke='#fff' stroke-width='2' d='M24 0c-9.8 0-17.7 7.8-17.7 17.4 0 15.5 17.7 30.6 17.7 30.6s17.7-15.4 17.7-30.6c0-9.6-7.9-17.4-17.7-17.4z'%3e%3c/path%3e%3c/svg%3e",
		position	: latlng,
		map			: map
	});

	console.log( marker );

	// add to array
	map.markers.push( marker );

	// if marker contains HTML, add it to an infoWindow
	if( $marker.html() )
	{
		// create info window
		var infowindow = new google.maps.InfoWindow({
			content		: $marker.html()
		});

		// show info window when marker is clicked
		google.maps.event.addListener(marker, 'click', function() {

			infowindow.open( map, marker );

		});

		infowindow.open( map, marker );
	}

}

/*
*  center_map
*
*  This function will center the map, showing all markers attached to this map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	map (Google Map object)
*  @return	n/a
*/

function center_map( map ) {

	// vars
	var bounds = new google.maps.LatLngBounds();

	// loop through all markers and create bounds
	$.each( map.markers, function( i, marker ){

		var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

		bounds.extend( latlng );

	});

	// only 1 marker?
	if( map.markers.length == 1 )
	{
		// set center of map
	    map.setCenter( bounds.getCenter() );
	    map.setZoom( 16 );
	}
	else
	{
		// fit to bounds
		map.fitBounds( bounds );
	}

}

/*
*  document ready
*
*  This function will render each map when the document is ready (page has loaded)
*
*  @type	function
*  @date	8/11/2013
*  @since	5.0.0
*
*  @param	n/a
*  @return	n/a
*/
// global var
var map = null;

$(document).ready(function(){

	$('.acf-map').each(function(){

		// create map
		map = new_map( $(this) );

	});

});

})(jQuery);

// style json
// [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"administrative","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"administrative.country","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"administrative.country","elementType":"geometry","stylers":[{"visibility":"simplified"}]},{"featureType":"administrative.country","elementType":"labels.text","stylers":[{"visibility":"simplified"}]},{"featureType":"administrative.province","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"administrative.locality","elementType":"all","stylers":[{"visibility":"simplified"},{"saturation":"-100"},{"lightness":"30"}]},{"featureType":"administrative.neighborhood","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"administrative.land_parcel","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"all","stylers":[{"visibility":"simplified"},{"gamma":"0.00"},{"lightness":"74"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"landscape.man_made","elementType":"all","stylers":[{"lightness":"3"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road","elementType":"geometry","stylers":[{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}]
(function($) {	
	
	var initLazyLoading = function() {
	
		var myLazyLoad = new LazyLoad({
		    show_while_loading: true, //best for progressive JPEG
			callback_set: function (img) {
		        picturefill({
					reevaluate: true,
		            elements: [img]
		        });
		    },
		});
	
	};
		
	
	$(window).on('load', function(){
		initLazyLoading();	
	});	

})(jQuery);	
(function($) {	
		
	var navicon = document.getElementById('js-navicon') ,
	    naviconClose = document.getElementById('js-navicon-close') ,
	    naviconTrigger = navicon.firstElementChild ,
	    siteHeader = document.getElementById('js-site-header') ,
	    htmlElement = document.documentElement;


	// Mobile Navicon Behavior
	function openMobileMenu(){
		console.log('open menu');
		// Make input field visible
		naviconTrigger.className +=  ' navicon__trigger--open';
		siteHeader.className += ' site-header--menu-open';
		htmlElement.className += ' html--menu-open';
	}
	
	// Mobile Navicon Behavior
	function closeMobileMenu(){
		console.log('close menu');
		// Hide the search input field
		naviconTrigger.className = naviconTrigger.className.replace(' navicon__trigger--open', '');
		siteHeader.className = siteHeader.className.replace(' site-header--menu-open', '');
		htmlElement.className = htmlElement.className.replace(' html--menu-open', '');
	}
	
	// navicon click event
	navicon.addEventListener('click', openMobileMenu, false);
	naviconClose.addEventListener('click', closeMobileMenu, false);
		
		
	// Toggles 'open' when user clicks on a top-level menu item when the navicon is visible
	$('.main-menu .toggle-control').click(function(e){
		
		if ( $('#js-navicon').is(':visible') ) {
			
			e.preventDefault();
				
			if ( $(this).hasClass('toggle-control--active') ) {
				// THIS WAS ALREADY ACTIVE
				$(this).removeClass('toggle-control--active').next('.sub-menu').stop().slideUp(400, function(){
					$(this).parent().removeClass('current-menu-item current-menu-ancestor current-menu-parent current-page-ancestor current-page-parent current_page_item current_page_parent current_page_ancestor');	
				});
				
			} else {
				// NOT ACTIVE YET, LETS ACTIVATE
				$(this).addClass('toggle-control--active').next('.sub-menu').stop().slideDown().parent('.menu-item').addClass('current-menu-ancestor');
			}
		}
		
	});
	
	
	// Fires when the document is clicked
	$(document).on('click', function( event ) {
		
		if ( $('#js-navicon').is(':visible') ) {
			// If the clicked element is not the navicon, a child of navicon, sitenavigation, or a child of sitenavigation, remove active state. 
			if ( event.target.className !== '#js-navicon'  &&  
			     ! $(event.target).closest('#js-navicon').length  && 
			     event.target.className !== '.site-navigation'  &&  
			     ! $(event.target).closest('.site-navigation').length
			) {
				naviconTrigger.className = naviconTrigger.className.replace(' navicon__trigger--open', '');
				siteHeader.className = siteHeader.className.replace(' site-header--menu-open', '');
				htmlElement.className = htmlElement.className.replace(' html--menu-open', '');
			}
		}
		
	});
	
}(jQuery));
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
(function($) {
	
	var $searchTrigger     = $('#js-site-search') ,
		$searchTriggerIcon = $searchTrigger.find('.fa') ,
	    $searchContainer   = $('#js-search-container') ,
	    $searchForm        = $searchContainer.find('.search-form') ,
	    $searchInput       = $searchContainer.find('.search-input') ,
	    activeClass        = 'is-active';
	
	// Fires when the checkbox select group is clicked.
	$searchTrigger.on('click', function(){
		$searchTrigger.toggleClass(activeClass);
		$searchContainer.toggleClass(activeClass);
		
		// Autofocus / Remove focus
		if ( $searchContainer.hasClass(activeClass) ) {
			$searchInput.focus();
			$searchTriggerIcon.removeClass('fa-search').addClass('fa-times');
		} else {
			$searchInput.blur();
			$searchTriggerIcon.removeClass('fa-times').addClass('fa-search');
		}
		
	});
		
	// Prevent empty values from submitting
	$searchForm.on('submit', function(e){
		if ( $searchInput.val() === '' ) {
			e.preventDefault();
		} 
	});
	
	$('.site-navigation .search-form').on('submit', function(e){
		console.log('test searchform');
		if ( $('.site-navigation .search-input').val() === '' ) {
			e.preventDefault();
		} 
	});
	
})(jQuery);
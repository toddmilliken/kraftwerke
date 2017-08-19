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
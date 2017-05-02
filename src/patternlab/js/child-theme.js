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
// The Web Font Loader is a JavaScript library that gives you more control 
// over font loading than the Google Fonts API provides. 
//
// The Web Font Loader also lets you use multiple web font providers. 
// It was co-developed by Google and Typekit.
//
// The documentation and source code for the Web Font Loader is available in the GitHub repository.
// @link: https://github.com/typekit/webfontloader

WebFontConfig = {
	//classes: false,
	google: { 
		families: [ 
			'Roboto:300,400,400i,600,700,700i,800'
		] 
	}
};
(function() {
	var wf = document.createElement('script');
	wf.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
	wf.type = 'text/javascript';
	wf.async = 'true';
	var s = document.getElementsByTagName('script')[0];
	s.parentNode.insertBefore(wf, s);
})();
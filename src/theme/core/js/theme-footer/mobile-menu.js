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
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
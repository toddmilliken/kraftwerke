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
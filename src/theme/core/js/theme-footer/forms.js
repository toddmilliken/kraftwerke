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
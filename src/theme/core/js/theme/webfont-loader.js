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
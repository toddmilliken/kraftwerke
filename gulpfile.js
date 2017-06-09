// --------------------------------
// Gulp Plugins
// --------------------------------

// Gulp - Duh
var gulp = require('gulp');

// Translation Related
var wpPot = require('gulp-wp-pot');

// CSS Related
var sass = require('gulp-sass');
var sassGlob = require('gulp-sass-glob');
var bulkSass = require('gulp-sass-glob-import');
var sasslint = require('gulp-sass-lint');
var postcss = require('gulp-postcss');
var autoprefixer = require('autoprefixer');

// JavaScript Related
var jshint = require('gulp-jshint');
var uglify = require('gulp-uglify');
var modernizr = require('gulp-modernizr');

// Tasks
var clean = require('gulp-clean');
var rename = require('gulp-rename');
var concat = require('gulp-concat'); // used for concatenating javascript files into 1 file.
var plumber = require('gulp-plumber');
var notify = require('gulp-notify');
var exec = require('child_process').exec;
var browserSync = require('browser-sync').create();
var download = require('gulp-download');
var fs = require('fs');

// New Sync/Copy task dependencies
var newer = require('gulp-newer');
var path = require('path');
var del = require('del');


// --------------------------------
// Globals
// --------------------------------

var packagejson = JSON.parse(fs.readFileSync('./package.json'));

// Root Paths
var src = {
	root: "./src/",
	acf: {},
	patternlab: {},
	theme: {},
	plugins: {}
};
src.theme.root              = src.root + "theme/";
src.theme.languages         = src.theme.root + "languages/";
src.theme.core              = src.theme.root + "core/";
src.theme.sass              = src.theme.core + "sass/";
src.theme.js                = src.theme.core + "js/";
src.plugins.root            = src.root + "plugins/";
src.acf.root                = src.root + "acf-json/";
src.patternlab.root         = src.root + "patternlab/";
src.patternlab.css          = src.patternlab.root + "css/";	
src.patternlab.js           = src.patternlab.root + "js/";	
src.patternlab.annotations 	= src.patternlab.root + "_annotations/";
src.patternlab.data         = src.patternlab.root + "_data/";
src.patternlab.meta         = src.patternlab.root + "_meta/";
src.patternlab.patterns 	  = src.patternlab.root + "_patterns/";

// WordPress Paths
var wp = {
	root: "./site/",
	theme: {}
};
wp.content 	   	   	   	   	= wp.root + "wp-content/";
wp.themes 	   	   	   	   	= wp.content + "themes/";
wp.theme.root 	   	   	   	= wp.themes + packagejson.name + "/";
wp.theme.core 	   	   	   	= wp.theme.root + "core/";
wp.theme.css 	   	   	   	  = wp.theme.core + "css/";
//wp.theme.icons 	   	   	   	= wp.theme.core + "icons/";
//wp.theme.images 	   	   	  = wp.theme.core + "images/";
wp.theme.js 	   	   	   	  = wp.theme.core + "js/";
wp.theme.acf 	   	   	   	  = wp.theme.root + "acf-json/";
wp.plugins 	   	   	   	   	= wp.content + "plugins/";

// Patternlab Paths
var patternlab = {
	root: "./patternlab/",
	public: {},
	source: {}
};
patternlab.gulpfile				= patternlab.root + "gulpfile.js";
patternlab.public.root 			= patternlab.root + "public/";
patternlab.public.css 			= patternlab.public.root + "css/";
patternlab.public.js 			= patternlab.public.root + "js/";
patternlab.source.root 			= patternlab.root + "source/";
patternlab.source.css 			= patternlab.source.root + "css/";
patternlab.source.js 			= patternlab.source.root + "js/";
patternlab.source.annotations 	= patternlab.source.root + "_annotations/";
patternlab.source.data 			= patternlab.source.root + "_data/";
patternlab.source.meta 			= patternlab.source.root + "_meta/";
patternlab.source.patterns 		= patternlab.source.root + "_patterns/";

/**
 * All theme files excepty js and sass
 */
var themeFiles = [
	src.theme.root + '**/*',
	'!' + src.theme.root + 'core/sass{,/**}',
	'!' + src.theme.root + 'core/js{,/**}'
];


/**
 * Gulp Error Handling
 */
var plumberErrorHandler = {
	errorHandler: notify.onError({
		title: 'Gulp - Error',
		message: 'Error: <%= error.message %>'
	})
};

gulp.task('acf:update-src', gulp.series(function() {
	return gulp.src([wp.theme.acf + '**/*'])
		.pipe(gulp.dest(src.acf.root));
}));

gulp.task('acf:get-src', gulp.series(function() {
	return gulp.src([src.acf.root + '**/*'])
		.pipe(gulp.dest(wp.theme.acf));
}));

// --------------------------------
// Theme Tasks
// --------------------------------

gulp.task("theme:clean", gulp.series(function() {
	return gulp.src([
			wp.theme.root,
			'!' + wp.theme.acf.replace(/\/$/, "")
		], {read: false})
		.pipe(clean());
}));

 
gulp.task('theme:generate-pot-files', function () {
    return gulp.src(src.theme.root + '**/*.php')
        .pipe(wpPot( {
            domain: 'kraftwerke',
            package: 'Kraftwerke'
        } ))
        .pipe(gulp.dest(src.theme.languages + 'file.pot'));
});

/**
 * Sass Tasks
 *
 * @ref: https://www.npmjs.com/package/gulp-sass
 */
 gulp.task('theme:sass', gulp.series(function() {
 	// Post CSS Processors
 	var processors = [
 		autoprefixer({
 			browsers: ['last 4 versions', 'ie >= 9']
 		})
 	];

 	return gulp.src([src.theme.sass + '**/*.scss'])
 		.pipe(plumber(plumberErrorHandler))
 		.pipe(sasslint({
 			options: {
 				'merge-default-rules': false
 			},
 			rules: {
 				'border-zero': [
 					2, {
 						'convention': 'none'
 					}
 				],
 				'brace-style': [
 					2, {
 						'style': '1tbs',
 						'allow-single-line': false
 					}
 				],
 				'class-name-format': [
 					2, {
 						'allow-leading-underscore': true,
 						'convention': 'hyphenatedbem',
 						'ignore': ['gform_wrapper', 'gform_body', 'gform_button']
 					}
 				],
 				'empty-args': [
 					2, {
 						'include': false
 					}
 				],
 				'extends-before-declarations': true,
 				'extends-before-mixins': true,
 				'function-name-format': [
 					2, {
 						'allow-leading-underscore': true,
 						'convention': 'hyphenatedlowercase',
 						'convention-explanation': 'Because we need to have some kind of rule to follow and this feels right as of 06/01/2016'
 					}
 				],
 				'hex-notation': [
 					2, {
 						'style': 'lowercase'
 					}
 				],
 				'leading-zero': [
 					2, {
 						'include': false
 					}
 				],
 				'mixins-before-declarations': [
 					2, {
 						exclude: [
							'smartphone-up',
							'smartphone-down',
							'inner-up',
							'inner-down',
							'tablet-landscape-up',
							'tablet-landscape-down',
							'mobile-menu',
							'desktop-menu',
							'xxs-up',
							'xxs-down',
							'xs-up',
							'xs-down',
							'sm-up',
							'sm-down',
							'md-up',
							'md-down',
							'lg-up',
							'lg-down'
						]
 					}
 				],
 				'nesting-depth': [
 					2, {
 						'max-depth': 3
 					}
 				],
 				//'no-duplicate-properties': 2,
 				'no-empty-rulesets': 2,
 				//'no-ids': 2,
 				'no-invalid-hex': 2,
 				'no-misspelled-properties': 2,
 				'no-qualifying-elements': [
 					2, {
 						'allow-element-with-attribute': true
 					}
 				],
 				'no-trailing-zero': 2,
 				'no-transition-all': 2,
 				'no-url-protocols': 2,
 				//'no-vendor-prefixes': 2,
 				'one-declaration-per-line': 2,
 				'placeholder-in-extend': 2,
 				'quotes': [
 					2, {
 						'style': 'double'
 					}
 				],
 				'single-line-per-selector': 2,
 				'space-after-colon': [
 					2, {
 						'include': true
 					}
 				],
 				'space-around-operator': [
 					2, {
 						'include': true
 					}
 				],
 				'space-before-bang': [
 					2, {
 						'include': true
 					}
 				],
 				'space-before-brace': [
 					2, {
 						'include': true
 					}
 				],
 				'space-before-colon': [
 					2, {
 						'include': false
 					}
 				],
 				'variable-name-format': [
 					2, {
 						'allow-leading-underscore': false,
 						'convention': 'hyphenatedlowercase',
 						'convention-explanation': 'Variables are required to be hyphenated and lowercase to promote improved readability compared to other formats.'
 					}
 				],
 				'zero-unit': [
 					2, {
 						'include': false
 					}
 				]
 			},
 		}))
 		.pipe(sasslint.format())
 		.pipe(sasslint.failOnError())
 		.pipe(bulkSass())
 		.pipe(sass({
 			includePaths: require('node-reset-scss').includePath,
 			outputStyle: 'expanded'
 		}).on('error', sass.logError))
 		.pipe(postcss(processors))
 		// Distribute to site
 		.pipe(gulp.dest(wp.theme.css))
 		// Distribute to Pattern Lab
 		.pipe(gulp.dest(src.patternlab.css))
		.pipe(browserSync.stream({match: '**/*.css'}));
}));

/**
 * JavaScript Tasks
 *
 * @ref: https://www.npmjs.com/package/gulp-jshint
 * @ref: https://www.npmjs.com/package/gulp-concat
 * @ref: https://www.npmjs.com/package/gulp-uglify
 */
gulp.task('theme-head:scripts', gulp.series(function() {
	return gulp.src(src.theme.js + 'theme-head/**/*.js', { dot: true })
		//.pipe(jshint())
		//.pipe(jshint.reporter('default'))
		.pipe(concat('child-theme-head.js'))
		// Distribute to site
		.pipe(gulp.dest(wp.theme.js))
		// Distribute to Pattern Lab
		.pipe(gulp.dest(src.patternlab.js));
}));
gulp.task('theme-footer:scripts', gulp.series(function() {
	return gulp.src(src.theme.js + 'theme-footer/**/*.js', { dot: true })
		.pipe(jshint())
		.pipe(jshint.reporter('default'))
		.pipe(concat('child-theme.js'))
		// Distribute to site
		.pipe(gulp.dest(wp.theme.js))
		// Distribute to Pattern Lab
		.pipe(gulp.dest(src.patternlab.js));
}));

gulp.task('theme:single-scripts', gulp.series(function() {
	return gulp.src([
			src.theme.js + '*.js',
			'!' + src.theme.js + 'theme-head/**/*',
			'!' + src.theme.js + 'theme-footer/**/*',
			'!' + src.theme.js + 'vendor-footer/**/*',
			'!' + src.theme.js + 'vendor-head/**/*'
		], { dot: true })
		.pipe(jshint())
	    .pipe(jshint.reporter('default'))
	    // Distribute to site
	    .pipe(gulp.dest(wp.theme.js))
 		.pipe(gulp.dest(src.patternlab.js));
}));


/**
 * Download required JavaScript vendor libraries - added before closing </body> tag
 *
 * @ref: https://www.npmjs.com/package/gulp-download
 */
var vendorURLsHead = [
	// PictureFill
	'https://raw.githubusercontent.com/scottjehl/picturefill/master/dist/picturefill.js'
];

var vendorURLsFooter = [
	// Slick
	'https://raw.githubusercontent.com/kenwheeler/slick/master/slick/slick.js',
	// Colorbox
	'https://raw.githubusercontent.com/jackmoore/colorbox/master/jquery.colorbox.js',
	// Easy List Splitter
	'https://raw.githubusercontent.com/steelx/easyListSplitter/master/jquery.easyListSplitter.js',
	// Uniform
	'https://raw.githubusercontent.com/AudithSoftworks/Uniform/4.0/dist/js/jquery.uniform.standalone.js',
	// Hover Intent
	'https://raw.githubusercontent.com/briancherne/jquery-hoverIntent/master/jquery.hoverIntent.js',
	// Flexibility
	'https://raw.githubusercontent.com/jonathantneal/flexibility/master/flexibility.js'
];

//---
// MODERNIZR
//---
gulp.task('theme:download-modernizr', function() {
  return gulp.src(src.theme.js + '**/*.js')
    .pipe(modernizr({
			options : [
				'setClasses',
				'addTest',
				'html5printshiv',
				'testProp',
				'fnBind'
			],
			tests : [
				'fontface',
				'backgroundsize',
				'borderimage',
				'borderradius',
				'boxshadow',
				'flexbox',
				'flexboxlegacy',
				'hsla',
				'multiplebgs',
				'opacity',
				'rgba',
				'textshadow',
				'cssanimations',
				'csscolumns',
				'generatedcontent',
				'cssgradients',
				'cssreflections',
				'csstransforms',
				'csstransforms3d',
				'csstransitions',
				'inlinesvg',
				'svg',
				'touch',
				'shiv',
				'cssclasses',
				'teststyles',
				'testprop',
				'testallprops',
				'prefixes',
				'domprefixes',
				'load'
			]
    }))
    .pipe(rename({ suffix: '.min' }))
    .pipe(uglify())
    .pipe(gulp.dest(src.theme.js + 'vendor-head/'))
});

gulp.task('theme:download-vendor-head', gulp.series(function() {
	return download(vendorURLsHead)
		// Distribute to theme
		.pipe(gulp.dest(src.theme.js + 'vendor-head/'));
}));

gulp.task('theme:download-vendor-footer', gulp.series(function() {
	return download(vendorURLsFooter)
		// Distribute to theme
		.pipe(gulp.dest(src.theme.js + 'vendor-footer/'));
}));


/**
 * Distribute vendor plugins to patternlab and site
 */
gulp.task('theme:distribute-vendor-head', gulp.series(function() {
	return gulp.src([src.theme.js + 'vendor-head/*.js'])
		.pipe(concat('plugins-head.js'))
		.pipe(uglify())
		// Distribute to site
		.pipe(gulp.dest(wp.theme.js))
		// Distribute to Pattern Lab
		.pipe(gulp.dest(src.patternlab.js));
}));

gulp.task('theme:distribute-vendor-footer', gulp.series(function() {
	return gulp.src([src.theme.js + 'vendor-footer/*.js'])
		.pipe(concat('plugins-footer.js'))
		.pipe(uglify())
		// Distribute to site
		.pipe(gulp.dest(wp.theme.js))
		// Distribute to Pattern Lab
		.pipe(gulp.dest(src.patternlab.js));
}));

/**
 * Theme Copy Task: Intended to copy over *.php files from /src/ to /site/
 */
gulp.task("theme:copy", gulp.series(function() {
	return gulp.src(themeFiles, { dot: true })
		.pipe(plumber(plumberErrorHandler))
		.pipe(gulp.dest(wp.theme.root));
}));

gulp.task("theme:init", gulp.series(function() {
	return exec("cd " + wp.themes + " && mkdir -p " + packagejson.name + " && cd ../../../", function(error, stdout, stderr) {
	    if(error) {
	        console.log(error, stderr);
			return;
	    }
		console.log(stdout);
		console.log(stdout);
	});
}));


/**
 * WP Plugin Copy Task: Intended to copy over *.php files from /src/ to /site/
 */
gulp.task("wp-plugins:copy", gulp.series(function() {
	return gulp.src(src.plugins.root + '**/*', { dot: true })
		.pipe(plumber(plumberErrorHandler))
		.pipe(gulp.dest(wp.plugins));
}));

gulp.task("theme:build", gulp.series([
	'acf:update-src',
	'theme:clean',
	'theme:sass',
	'theme-head:scripts',
	'theme-footer:scripts',
	'theme:single-scripts',
	'theme:distribute-vendor-head',
	'theme:distribute-vendor-footer',
	'theme:generate-pot-files',
	'theme:copy',
	'acf:get-src',
	'wp-plugins:copy'
]));


// --------------------------------
// Patternlab Tasks
// --------------------------------

/**
 * Runs npm install within the patternlab directory
 */
gulp.task('patternlab:init', gulp.series(function() {
	return exec("cd patternlab && npm install && cd ../", function(error, stdout, stderr) {
	    if(error) {
	        console.log(error, stderr);
			return;
	    }
		console.log(stdout);
		console.log(stdout);
	});
}));

/**
 * Copy patternlab files to patternlab/source
 */
gulp.task('patternlab:copy', gulp.series(function() {
	return gulp.src([src.patternlab.root + '**/*', '!' + src.patternlab.root + '**/__*'])
		.pipe(plumber(plumberErrorHandler))
		.pipe(newer(patternlab.source.root))
		.pipe(gulp.dest(patternlab.source.root));
}));

/**
 * Serves up Patternlab using the gulp tasks within /patternlab
 */
gulp.task('patternlab:serve', gulp.series(function() {
	return exec("gulp --gulpfile " + patternlab.gulpfile + " patternlab:serve", function(error, stdout, stderr) {
		if(error) {
	        console.log(error, stderr);
			return;
	    }
		console.log(stdout);
		console.log(stdout);
	});
}));


// --------------------------------
// Server Tasks
// --------------------------------

/**
 * Serves up the site using a proxy server which you need to provide
 */
gulp.task('site:serve', gulp.series(function() {
	browserSync.init({
		proxy: "kraftwerke.dev", // Rename this to your desired domain name
		port: 3333
    });
}));


// --------------------------------
// Watch Tasks
// --------------------------------

gulp.task('watch', gulp.series(function() {
	// Theme Watcher
	gulp.watch(themeFiles, gulp.series(['theme:copy']));
	
	// Plugins Watcher
	gulp.watch(src.plugins.root + '**/*', gulp.series(['wp-plugins:copy']));

	// Sass Watcher
	gulp.watch(src.theme.sass + '**/*.scss', gulp.series(['theme:sass']));

	// Scripts Watcher
	gulp.watch(src.theme.js + '**/*.js', gulp.series(['theme-head:scripts', 'theme-footer:scripts', 'theme:single-scripts']));
	
	// Languages Watcher
	gulp.watch(src.theme.languages + '**/*.php', gulp.series(['theme:generate-pot-files']));

	// Patternlab Watchers
	var watcher = gulp.watch(src.patternlab.root + '**/*', gulp.series(['patternlab:copy']));
	watcher.on('change', function(ev) {
		if(ev.type === 'deleted') {
			// path.relative gives us a string where we can easily switch directories
			del(path.relative('./', ev.path).replace(src.patternlab.root.substr(2),patternlab.source.root.substr(2)));
		}
	});
	
	// ACF Watchers
	gulp.watch(wp.theme.acf + '**/*', gulp.series(['acf:update-src']));
}));


// --------------------------------
// Default Task
// --------------------------------

gulp.task('default', gulp.series(
	gulp.parallel(
		'theme:build',
		'site:serve',
		'patternlab:serve',
		'watch'
	)
));


// --------------------------------
// Init Task
// --------------------------------

gulp.task('init', gulp.series([
	'theme:init',
	'theme:download-modernizr',
	'theme:download-vendor-head',
	'theme:download-vendor-footer',
	'patternlab:init',
	'patternlab:copy',
	'default'
]));

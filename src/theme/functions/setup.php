<?php
/**
 * Child theme setup functions
 *
 * Registers support for various Wordpress featuers such as featured image support, 
 * custom image sizes, etc. 
 *
 * @package Kraftwerke
 * @since 1.0.0
 */


/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since 1.0.0
 */
function kw_setup() {
	
	
	/**
	 * Add local translations
	 * 
	 * @since   1.0.0
	 *
	 * @link    https://developer.wordpress.org/reference/functions/load_theme_textdomain/
	 */
	load_theme_textdomain( 'kraftwerke', get_template_directory() . '/languages' );


	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 *
	 * @since   1.0.0
	 *
	 * @link    https://codex.wordpress.org/Title_Tag
	 */
	add_theme_support( 'title-tag' );


	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 * 
	 * @since   1.0.0
	 *
	 * @link    http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	
	
	/*
	 * Add child theme custom image sizes. 
	 * 
	 * @since   1.0.0
	 *
	 * @link    https://developer.wordpress.org/reference/functions/add_image_size/
	 */
	
	add_image_size( 'masthead', 1600, 374, true );
	add_image_size( 'masthead-mobile', 640, 240, true );
	add_image_size( '16-9-xl', 1600, 900, true );	
	add_image_size( '16-9-lg', 1200, 675, true );
	add_image_size( '16-9-md', 970, 545, true );
	add_image_size( '16-9-sm', 640, 360, true );
	add_image_size( '16-9-xs', 480, 270, true );
	add_image_size( 'panel-tablet', 768, 1024, array('center', 'top') );
	add_image_size( 'panel-mobile', 640, 736, array('center', 'top') );
	//add_image_size( 'custom-background-smartphone-portrait', 320, 535, array('left', 'top') );
	
}
add_action( 'after_setup_theme', 'kw_setup' );
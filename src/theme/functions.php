<?php
/**
 * Kraftwerke theme functions
 *
 * Uses built-in PHP function "require" to include child-theme functionality.
 * Functions are referenced from the the "functions/" directory. 
 * Adds functionality for sidebars, menus, enqueue scripts, and additinal theme features.
 * 
 * @package Kraftwerke
 * @since 1.0.0
 *
 * @link http://php.net/manual/en/function.require.php
 */


 
/** Registers support for various WordPress features */
require 'functions/setup.php';

/** Defines theme template tags */
require 'functions/template-tags.php';

/** Registers theme stylesheets and scripts */ 
require 'functions/enqueue.php';

/** Registers additional widgetized areas. Re-enabled disable WP widgets */
//require 'functions/sidebars.php';

/** Modifies WP Core widgets behaviors */
//require 'functions/widgets.php';
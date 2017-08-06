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


/**
 * Functions
 */

// Enqueued theme stylesheets and scripts
require 'functions/enqueue.php';
 
// Navigation Menus
require 'functions/nav-menus.php';
 
// Theme setup (supports, image crops, etc)
require 'functions/setup.php';

// Theme template tags
require 'functions/template-tags.php';

// Widgets
require 'functions/widgets.php';

// Yoast WPSEO functionality
require 'functions/yoast-wpseo.php';


/**
 * Classes
 */

// Widget: Call-to-action Button Link
require 'classes/kwer-widget-cta-btn.php';

// Widget: WP Text Widget (modified with cta more link fields)
require 'classes/kwer-widget-text.php';
<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              www.kraftwerke1.com
 * @since             1.0.0
 * @package           Kwer_Options
 *
 * @wordpress-plugin
 * Plugin Name:       Kraftwerke ACF Options
 * Plugin URI:        www.kraftwerke1.com
 * Description:       Adds site options and page options to the admin screens. 
 * Version:           1.0.0
 * Author:            Todd Milliken
 * Author URI:        www.kraftwerke1.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       kwer-options
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-kwer-options-activator.php
 */
function activate_kwer_options() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-kwer-options-activator.php';
	Kwer_Options_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-kwer-options-deactivator.php
 */
function deactivate_kwer_options() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-kwer-options-deactivator.php';
	Kwer_Options_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_kwer_options' );
register_deactivation_hook( __FILE__, 'deactivate_kwer_options' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-kwer-options.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_kwer_options() {

	$plugin = new Kwer_Options();
	$plugin->run();
	
	// Define plugin constants
	if ( ! defined('KWER_OPTIONS_FILE') ) {
		define('KWER_OPTIONS_FILE', __FILE__);
	}

}
run_kwer_options();

<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       www.kraftwerke1.com
 * @since      1.0.0
 *
 * @package    Kwer_Options
 * @subpackage Kwer_Options/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Kwer_Options
 * @subpackage Kwer_Options/admin
 * @author     Todd Milliken <milliktr@gmail.com>
 */
class Kwer_Options_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}
	
	/**
	 * Verify ACF is active
	 *
	 * @since   1.0.0
	 */
	public function verify_dependencies() {
		
		if ( ! is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) || ! is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ||  ! class_exists('acf') )
		{
			add_action( 'admin_notices', array($this, 'notice_require_acf') );
			if ( isset( $_GET['activate'] ) ) {
				unset( $_GET['activate'] );	
			}
			deactivate_plugins( KWER_OPTIONS_FILE );
		}
		
	}
	
	
	/**
	 * ACF inactive.
	 *
	 * Deactivate this plugin because Advanced Custom Fields is inactive. 
	 *
	 * @since    1.0.0
	 */
	public function notice_require_acf() {
		?>
		
			<div class="notice notice-error is-dismissible">
				<p><?php _e( 'Kraftwerke Site Options detected that <a href="https://www.advancedcustomfields.com/" target="_blank">Advanced Custom Fields (ACF)</a> is not installed or activated. This add-on plugin will not work unless ACF is installed and activated.' ); ?></p>
			</div>
		
		<?php
			
	}
	
	
	/**
	 * Create ACF options page
	 *
	 * @since    1.0.0
	 */
	public function register_acf_options_page() {
		
		if( function_exists('acf_add_options_page') ) {
			acf_add_options_page();
			include 'partials/acf-site-options.php';
			include 'partials/acf-page-options.php';
		}
	}

}

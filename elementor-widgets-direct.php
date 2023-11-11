<?php
/**
 * Plugin Name: Elementor Widgets Direct
 * Description: Custom Elementor addon.
 * Plugin URI:  https://direct.ir/
 * Version:     1.0.0
 * Author:      Mohamad Gandomi
 * Author URI:  https://hadesboard.com/
 * Text Domain: elementor-widgets-direct
 * 
 * Elementor tested up to:     3.5.0
 * Elementor Pro tested up to: 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define("EAA_PDU", plugin_dir_url(__FILE__));

function elementor_widgets_direct() {

	// Load plugin file
	require_once( __DIR__ . '/includes/plugin.php' );

	// Run the plugin
	\Elementor_Widgets_Direct\Plugin::instance();

}
add_action( 'plugins_loaded', 'elementor_widgets_direct' );
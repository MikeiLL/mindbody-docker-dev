<?php
/*
 * Plugin Name: Mindbody Sandbox Plugin
 * Description: Child plugin for mZoo Mindbody and MBO Access for testing.
 * @package MZMBOSANDBOX
 *
 * @wordpress-plugin
 * Version: 		1.0.6
 * Stable tag: 		1.0.6
 * Author: 			mZoo.org
 * Author URI: 		http://www.mZoo.org/
 * Plugin URI: 		http://www.mzoo.org/
 * License:         GPL-2.0+
 * License URI:     http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: 	mbo-sandbox
 * Domain Path: 	/languages
*/
namespace mbo_sandbox;

use mbo_sandbox as NS;
use MZ_Mindbody;
use MZ_Mindbody\Inc\Core as Core;

if ( !defined( 'WPINC' ) ) {
    die;
}

// TODO make more eloquent appoach like EDD JILT work!
//	 * Based on http://wptavern.com/how-to-prevent-wordpress-plugins-from-activating-on-sites-with-incompatible-hosting-environments

/**
 * Define Constants
 */

define( __NAMESPACE__ . '\NS', __NAMESPACE__ . '\\' );

define( NS . 'PLUGIN_NAME', 'mbo-sandbox' );

define( NS . 'PLUGIN_VERSION', '1.0.6' );

define( NS . 'PLUGIN_NAME_DIR', plugin_dir_path( __FILE__ ) );

define( NS . 'PLUGIN_NAME_URL', plugin_dir_url( __FILE__ ) );

define( NS . 'PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

define( NS . 'PLUGIN_TEXT_DOMAIN', 'mbo-sandbox' );

add_action( 'admin_init', __NAMESPACE__ . '\\mbo_sandbox_has_mbo_api_and_access' );


/**
 * Insure that parent plugin, is active or deactivate plugin.
 */
function mbo_sandbox_has_mbo_api_and_access() {
	if ( is_admin() && current_user_can( 'activate_plugins' ) && !(is_plugin_active( 'mz-mindbody-api/mz-mindbody.php' ) && is_plugin_active( 'mz-mbo-access/mz-mbo-access.php' )) ) {
		add_action( 'admin_notices', __NAMESPACE__ . '\\mbo_sandbox_child_plugin_notice' );

		deactivate_plugins( plugin_basename( __FILE__ ) ); 

		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}
	}
}



/**
 * Child Plugin Notice
 */
function mbo_sandbox_child_plugin_notice(){
		?><div class="error"><p><?php echo __("Sorry, but MBO Sandbox plugin requires the parent plugins, MZ Mindbody API and MZ MBO Access, to be installed and active.", NS\PLUGIN_TEXT_DOMAIN); ?></p></div><?php
}

function mbo_sandbox_one( $atts, $content = '' ){
    return "Hello Sandbox";
}
add_shortcode('mbo-sandbox-one', __NAMESPACE__ . '\\mbo_sandbox_one');


?>
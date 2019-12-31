<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           WF_List_Generator
 *
 * @wordpress-plugin
 * Plugin Name:       WF List Generator
 * Plugin URI:        http://example.com/plugin-name-uri/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            WPFeel
 * Author URI:        http://wpfeel.net/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wf-list-generator
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WFLG_VERSION', '1.0.0' );
define( 'WFLG_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'WFLG_URL', plugin_dir_url( __FILE__ ) );
define( 'WFLG_PUBLIC_URL', WFLG_URL . 'public/' );
define( 'WFLG_ADMIN_URL', WFLG_URL . 'admin/' );
define( 'WFLG_FILE', __FILE__ );
define( 'WFLG_BASENAME', plugin_basename( __FILE__ ) );

define( 'WFLG_ROOT_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'WFLG_ADMIN_DIR_PATH', WFLG_ROOT_DIR_PATH . 'admin/' );
define( 'WFLG_PUBLIC_PATH', WFLG_ROOT_DIR_PATH . 'public/' );


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wflg-activator.php
 */
function activate_wflg() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wflg-activator.php';
	WFLG_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wflg-deactivator.php
 */
function deactivate_wflg() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wflg-deactivator.php';
	WFLG_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wflg' );
register_deactivation_hook( __FILE__, 'deactivate_wflg' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wf-list-generator.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wflg() {

	$plugin = new WF_List_Generator();
	$plugin->run();

}
run_wflg();

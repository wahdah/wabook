<?php

/**
 * @link              https://partners.wahdah.my/
 * @since             1.0.0
 * @package           Wabook
 *
 * @wordpress-plugin
 * Plugin Name:       Wabook
 * Plugin URI:        partners.wahdah.my
 * Description:       Enjoy Free car rental service for every users. Design Your own car rental platform now and start your business. Join us now on WahdahPartner to enjoy the rental services.
 * Version:           1.0.0
 * Author:            Lenon
 * Author URI:        https://partners.wahdah.my/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cars
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently pligin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WABOOK_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-cars-activator.php
 */
function activate_cars() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cars-activator.php';
	Cars_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-cars-deactivator.php
 */
function deactivate_cars() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cars-deactivator.php';
	Cars_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_cars' );
register_deactivation_hook( __FILE__, 'deactivate_cars' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-cars.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );
function run_cars() {

	$plugin = new Cars();
	$plugin->run();

}
run_cars();


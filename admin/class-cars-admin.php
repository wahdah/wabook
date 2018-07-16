<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       www.wahdah.my
 * @since      1.0.0
 *
 * @package    WaBook
 * @subpackage WaBook/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    WaBook
 * @subpackage WaBook/admin
 * @author     Lenon <lenonkoh96@hotmail.com>
 */
class Cars_Admin {

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
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	

/**
 * Register the administration menu for this plugin into the WordPress Dashboard menu.
 *
 * @since    1.0.0
 */
public function add_plugin_admin_menu() {

    /**
     * Add a settings page for this plugin to the Settings menu.
     *
     * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
     *
     *        Administration Menus: http://codex.wordpress.org/Administration_Menus
     *
     * add_options_page( $page_title, $menu_title, $capability, $menu_slug, $function);
     *
     * @link https://codex.wordpress.org/Function_Reference/add_options_page
     */
	add_menu_page( 
        __( 'WaBook', 'car-rental' ),
        __( 'WaBook', 'car-rental' ),
        'manage_options',
        'fee-manage',
        'dashboard_control',
        /*plugins_url( "WaBook/admin/css/wahdah.png" ),*/
        'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBzdGFuZGFsb25lPSJubyI/Pgo8IURPQ1RZUEUgc3ZnIFBVQkxJQyAiLS8vVzNDLy9EVEQgU1ZHIDIwMDEwOTA0Ly9FTiIKICJodHRwOi8vd3d3LnczLm9yZy9UUi8yMDAxL1JFQy1TVkctMjAwMTA5MDQvRFREL3N2ZzEwLmR0ZCI+CjxzdmcgdmVyc2lvbj0iMS4wIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciCiB3aWR0aD0iMjUwLjAwMDAwMHB0IiBoZWlnaHQ9IjI1MC4wMDAwMDBwdCIgdmlld0JveD0iMCAwIDI1MC4wMDAwMDAgMjUwLjAwMDAwMCIKIHByZXNlcnZlQXNwZWN0UmF0aW89InhNaWRZTWlkIG1lZXQiPgo8bWV0YWRhdGE+CkNyZWF0ZWQgYnkgcG90cmFjZSAxLjE1LCB3cml0dGVuIGJ5IFBldGVyIFNlbGluZ2VyIDIwMDEtMjAxNwo8L21ldGFkYXRhPgo8ZyB0cmFuc2Zvcm09InRyYW5zbGF0ZSgwLjAwMDAwMCwyNTAuMDAwMDAwKSBzY2FsZSgwLjEwMDAwMCwtMC4xMDAwMDApIgpmaWxsPSIjMDAwMDAwIiBzdHJva2U9Im5vbmUiPgo8cGF0aCBkPSJNMjIwOSAyMDUyIGMtMTQ2IC0xMzAgLTM5OCAtMzU1IC01NjAgLTQ5OCBsLTI5NSAtMjYxIC02NCAyODEgYy0zNAoxNTQgLTY2IDI4NSAtNzAgMjg5IC00IDUgLTEzMyAtMTU1IC0yODYgLTM1NiAtMTU0IC0yMDAgLTI4MiAtMzU5IC0yODUgLTM1MwotNCA2IC01MCAxMzUgLTEwNCAyODYgLTUzIDE1MSAtMTAxIDI3OSAtMTA2IDI4NSAtNSA1IC05IC0yMjMgLTkgLTU1MyAwIC0zMDkKMyAtNTYyIDggLTU2MiA0IDAgMTIzIDEwNCAyNjUgMjMwIDE0MiAxMjcgMjYzIDIzMCAyNjkgMjMwIDUgMCAtOCAtMTUgLTMwCi0zMyAtMjIgLTE5IC0xNDYgLTEzMCAtMjc3IC0yNDggLTE5MyAtMTc1IC0yMzMgLTIxNSAtMjE4IC0yMjEgMTAgLTQgMjg2IC04NAo2MTMgLTE3OCAzMjcgLTk0IDYwMyAtMTczIDYxNCAtMTc2IDE0IC01IDE2IC0zIDEwIDcgLTYgMTEgLTUgMTIgNyAyIDEwIC04CjkyIC05IDMxNyAtMyAxNjcgNSAzMDUgMTAgMzA4IDEyIDIgMyAtMTg2IDY0IC00MTggMTM2IC0yMzIgNzMgLTQyNCAxMzAgLTQyNgoxMjcgLTIgLTIgNDQgLTYxIDEwMiAtMTMwIDU5IC02OSAxMDUgLTEyNSAxMDIgLTEyNSAtMiAwIC0xNDggMTY4IC0zMjMgMzcyCi0xNzUgMjA1IC0zMzEgMzg4IC0zNDggNDA3IC0xNiAxOSAtMjUgMzIgLTE5IDI4IDcgLTQgMTE0IC0xMjYgMjM5IC0yNzIgMTI2Ci0xNDYgMjMxIC0yNjUgMjM0IC0yNjUgNSAwIDEwMjAgMTc0NiAxMDI5IDE3NzEgMTAgMjUgLTM0IC0xMiAtMjc5IC0yMjl6Ii8+CjxwYXRoIGQ9Ik0yNTEgMTUyMCBjLTg5IC0xMDAgLTE2MSAtMTg1IC0xNjEgLTE5MCAwIC02IDY2IC0xMCAxNjUgLTEwIGwxNjUgMAowIDE5MCBjMCAxMDUgLTIgMTkwIC00IDE5MCAtMyAwIC03NyAtODEgLTE2NSAtMTgweiIvPgo8cGF0aCBkPSJNNzUgMTI5OCBjLTE3IC00NiAtNjQgLTIxMyAtNjAgLTIxNiA0IC00IDI2NSAyMTYgMjY1IDIyNCAwIDIgLTQ1IDQKLTEwMCA0IC03MSAwIC0xMDIgLTQgLTEwNSAtMTJ6Ii8+CjwvZz4KPC9zdmc+',
        6
    ); 
	
	add_submenu_page('fee-manage','Setup','Setup','manage_options','fee-manage');
	add_submenu_page('fee-manage','Manage Location','Manage Location','manage_options','location-manage','dashboard_control');
	add_submenu_page('fee-manage','Pending Booking','Pending Booking','manage_options','book-list','dashboard_control');
}





/**
 * Render the settings page for this plugin.
 *
 * @since    1.0.0
 */





}

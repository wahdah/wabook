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
        plugins_url( "WaBook/admin/css/wahdah.png" ),
        6
    ); 
	
	add_submenu_page('fee-manage','Setup','Setup','manage_options','fee-manage');
	add_submenu_page('fee-manage','Manage Location','Manage Location','manage_options','location-manage','dashboard_control');
	add_submenu_page('fee-manage','Pending Booking','Pending Booking','manage_options','book-list','booking_list');
}





/**
 * Render the settings page for this plugin.
 *
 * @since    1.0.0
 */





}

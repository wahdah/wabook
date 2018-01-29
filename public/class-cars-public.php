<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       www.wahdah.my
 * @since      1.0.0
 *
 * @package    WaBook
 * @subpackage WaBook/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Cars
 * @subpackage WaBook/public
 * @author     Lenon <lenonkoh96@hotmail.com>
 */
class Cars_Public{

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Cars_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cars_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_register_style( 'design', plugin_dir_url( __FILE__ ) . 'css/bootstrap/css/bootstrap.css', array(), $this->version, 'all' );
		wp_enqueue_style('design');
		wp_register_style( 'flatpicker-css', 'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css', array(), $this->version, 'all' );
		wp_enqueue_style('flatpicker-css');
		wp_register_style( 'menubar', plugin_dir_url( __FILE__ ) . 'css/menu_bar.css', array(), $this->version, 'all' );
		wp_enqueue_style('menubar');
		wp_register_style( 'timepicker-css', plugin_dir_url( __FILE__ ) . 'js/timepicker/jquery.timepicker.css', array(), $this->version, 'all' );
		wp_enqueue_style('timepicker-css');
	}
	
	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Cars_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cars_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_register_script( 'flatpickr', 'https://cdn.jsdelivr.net/npm/flatpickr', array( 'jquery' ), $this->version, false );
		wp_enqueue_script('flatpickr');
		wp_register_script( 'timepicker', plugin_dir_url( __FILE__ ) . 'js/timepicker/jquery.timepicker.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script('timepicker');
		wp_register_script( 'date', plugin_dir_url( __FILE__ ) . 'js/date.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script('date');
		
	}


}

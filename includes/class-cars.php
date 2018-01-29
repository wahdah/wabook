<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       www.wahdah.my
 * @since      1.0.0
 *
 * @package    WaBook
 * @subpackage WaBook/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    WaBook
 * @subpackage WaBook/includes
 * @author     Lenon <lenonkoh96@hotmail.com>
 */
class Cars {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Cars_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'PLUGIN_NAME_VERSION' ) ) {
			$this->version = PLUGIN_NAME_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'cars';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Cars_Loader. Orchestrates the hooks of the plugin.
	 * - Cars_i18n. Defines internationalization functionality.
	 * - Cars_Admin. Defines all hooks for the admin area.
	 * - Cars_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-cars-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-cars-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-cars-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-cars-public.php';

		$this->loader = new Cars_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Cars_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Cars_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Cars_Admin( $this->get_plugin_name(), $this->get_version() );


		// Add menu item
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_plugin_admin_menu' );
	
		function dashboard_control() 
		{	
			$action = isset( $_GET['page'] ) ? $_GET['page'] : 'fee-manage';
			global $wpdb;
				switch ($action) {
					case 'location-manage':
						
						$table_name = $wpdb->prefix . "wahdah_location";
						$display_location = $wpdb->get_results("SELECT * FROM wp_wahdah_location");
						if(isset($_POST['submit_add']))
						{	
							$location = ucwords(strtolower($_POST['location']));
							$pickupfee = $_POST['pickupfee'];
							
							$result = $wpdb->get_var(
							$wpdb->prepare(
								"SELECT * FROM ".$table_name." 
								WHERE name = %s LIMIT 1",
								$location
							));

							if ( $result > 0 )
							{
								echo"<script type='text/javascript'>
								alert('$location Existed');
								window.location=document.location.href;
								</script>";	
							}						
							else
							{
								$wpdb->insert(
									$table_name,
										array(
											'name' => $location,
											'pickupfee' => $pickupfee
											));
								echo "<script type='text/javascript'>
								alert('Record Saved');
								window.location=document.location.href;
								</script>";			
							}		
						}
						
						if(!empty($_GET['action']) && $_GET['action'] == 'delete')
						{
							$id = $_GET['id'];

							$wpdb->query('DELETE  FROM '.$table_name.' WHERE id = "'.$id.'"');
							echo "<script type='text/javascript'>
							window.location='admin.php?page=location-manage';
							</script>";		
						}
						include dirname(dirname( __FILE__ )) . '/admin/partials/add_location.php';
						
						if(!empty($_GET['action']) && $_GET['action'] == 'edit')
						{
							$id = $_GET['id'];
							$plocation = $wpdb->get_var("SELECT name FROM ".$table_name." WHERE id = $id");
							$pfee = $wpdb->get_var("SELECT pickupfee FROM ".$table_name." WHERE id = $id");
							if(isset($_POST['submit_edit']))
							{
								$newlocation =  ucwords(strtolower($_POST['newlocation']));
								$newpickupfee = $_POST['newpickupfee'];
								
								
								$result = $wpdb->get_var(
								$wpdb->prepare(
									"SELECT * FROM ".$table_name." 
									WHERE name = %s AND pickupfee = %f LIMIT 1",
									$newlocation,$newpickupfee
								));

								if ( $result > 0 )
								{
									echo"<script type='text/javascript'>
									alert('$newlocation Existed');
									window.location=document.location.href;
									</script>";	
								}						
								else
								{
									$wpdb->update( 
									$table_name, 
										array( 
											'name' => $newlocation,
											'pickupfee' => $newpickupfee
										  ), 
										array('id' => $id), 
										array('%s','%f'), 
										array('%d'));
										
									echo "<script type='text/javascript'>
									alert('Record Updated');
									window.location='admin.php?page=location-manage';;
									</script>";							
								}						
							}
							include dirname(dirname( __FILE__ )) . '/admin/partials/edit_location.php';
						}
						break;
					
					default:

						$deposit = sprintf('%0.2f', round($wpdb->get_var("SELECT deposit FROM wp_wahdah_setup"), 2));
						$token = $wpdb->get_var("SELECT token FROM wp_wahdah_setup");
						
						if(!empty($_POST))
						{	
							$deposit = $_POST['deposit'];
							$token = $_POST['token'];
							
							$table_name = $wpdb->prefix . "wahdah_setup";	
							$wpdb->update( 
								$table_name, 
									array( 
										'deposit' => $deposit,
										'token' => $token,
									  ), 
									array('id' => 1), 
									array('%f','%s'), 
									array('%d')); 
									
							echo "<script type='text/javascript'>
							alert('Record Saved');
							window.location=document.location.href;
							</script>";
						}
						include dirname(dirname( __FILE__ )) . '/admin/partials/admin_setup.php';
						break;
				}
		}



	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Cars_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		include dirname(dirname( __FILE__ )) . '/public/virtual.php';
		include dirname(dirname( __FILE__ )) . '/public/rental.php';
		include dirname(dirname( __FILE__ )) . '/public/login_bar.php';
		include dirname(dirname( __FILE__ )) . '/public/details.php';
		include dirname(dirname( __FILE__ )) . '/public/url_encryption.php';
		include dirname(dirname( __FILE__ )) . '/public/payment.php';
		include dirname(dirname( __FILE__ )) . '/public/success_payment.php';
		include dirname(dirname( __FILE__ )) . '/public/history.php';
		include dirname(dirname( __FILE__ )) . '/public/change_password.php';
		include dirname(dirname( __FILE__ )) . '/public/view_history.php';
		
		

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Cars_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}

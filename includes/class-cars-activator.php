<?php

/**
 * Fired during plugin activation
 *
 * @link       www.wahdah.my
 * @since      1.0.0
 *
 * @package    WaBook
 * @subpackage WaBook/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    WaBook
 * @subpackage WaBook/includes
 * @author     Lenon <lenonkoh96@hotmail.com>
 */
class Cars_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		

		global $wpdb;
		$table_name = $wpdb->prefix . 'wahdah_setup';
		$charset_collate = $wpdb->get_charset_collate();

		if ( $wpdb->get_var( "SHOW TABLES LIKE '{$table_name}'" ) != $table_name ) {

			$sql = "CREATE TABLE $table_name (
							id mediumint(9) NOT NULL AUTO_INCREMENT,
							deposit float(11) NOT NULL,
							bankname varchar(200) DEFAULT '' NOT NULL,
							bankaccount varchar(200) DEFAULT '' NOT NULL,
							accountname varchar(200) DEFAULT '' NOT NULL,
							PRIMARY KEY  (id)
							) $charset_collate;";

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );
			
			$wpdb->insert( 
				$table_name, 
				array(
					'deposit' => 300.00,
					'bankname' => '',
					'bankaccount' => '',
					'accountname' => '',
					
				) 
			);
		}
		
		$table_name2 = $wpdb->prefix . 'wahdah_location';
		if ( $wpdb->get_var( "SHOW TABLES LIKE '{$table_name2}'" ) != $table_name2 ) {

			$sql2 = "CREATE TABLE $table_name2 (
							id mediumint(9) NOT NULL AUTO_INCREMENT,
							name varchar(200) DEFAULT '' NOT NULL,
							pickupfee float(11) NOT NULL, 						
							PRIMARY KEY  (id)
							) $charset_collate;";

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql2 );
		}
		
		if ( null === $wpdb->get_row( "SELECT post_name FROM {$wpdb->prefix}posts WHERE post_name = 'rental'", 'ARRAY_A' ) ) {
     
			$current_user = wp_get_current_user();
			
			// create post object
			$page = array(
				'post_name' => 'rental',
				'post_status' => 'publish',
				'post_title' => 'Car Search',
				'post_content' => '[design type="horizontal"]<br>[search_results]',
				'post_author' => $current_user->ID,
				'post_type'   => 'page',
				'comment_status' => 'closed'
			);
			
			// insert the post into the database
			wp_insert_post( $page );
		}


	}

}

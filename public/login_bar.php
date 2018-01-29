<?php
class asabfa {

	function __construct() {
		add_action( 'init', array( $this, 'show_admin_bar' ) );
		add_action( 'admin_bar_menu', array( $this, 'add_login_links' ), 11 );
	}

	function add_login_links() {
		global $wp_admin_bar;
		if ( $this->is_logged_in())
		{
			$wp_admin_bar->add_node( array(
				'parent'    => 'user-actions',
				'id'        => 'history',
				'title'     => '<span class="user-url">' . __( 'Booking History' ) . '</span>',
				'href'      => home_url("/history/")
			));
			
			if(wp_get_current_user()->user_status == 1)
			{	
				$wp_admin_bar->remove_node( 'wp-logo' );
				$wp_admin_bar->remove_node( 'search' );	
				$wp_admin_bar->add_node( array(
					'parent'    => 'user-actions',
					'id'        => 'profile',
					'title'     => '<span class="user-url">' . __( 'Change Password' ) . '</span>',
					'href'      => home_url("/profile/")
				));
			}
			
			return;
		}
		if ( isset( $wp_admin_bar ) )
			if(!is_user_logged_in()) {
				$wp_admin_bar->remove_node( 'search' );
				$wp_admin_bar->remove_node( 'wp-logo' );
				 $args = array(
				'id' => 'login',
				'title' => __( 'Login Here', 'asabfa' ), 
				'href' => wp_login_url(), 
			);
			$wp_admin_bar->add_node($args);
			}
	}

	function has_logged_in() {
		// Have they ever logged in?
		return isset( $_COOKIE['asabfa_logged_in'] ) && $_COOKIE['asabfa_logged_in'] ;
	}

	function is_logged_in() {
		$user_id = get_current_user_id();
		if ( 0 != $user_id ) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function show_admin_bar( $show ) {
		// If the user has logged in previously - show the bar
		if ( $this->has_logged_in() ) {
			$show = TRUE;
		}
		// If user is currently logged in. Show the bar, and set a cookie
		if ( $this->is_logged_in() ) {
			setcookie( 'asabfa_logged_in', '1', time() + 60 * 60 * 24 * 1000 );
			$show = TRUE;
		}
		if ( $show && !is_admin() ) {
			add_filter( 'show_admin_bar', '__return_true' );
		} else {
			add_filter( 'show_admin_bar', '__return_false' );
		}
	}

}

$asabfa = new asabfa();
?>
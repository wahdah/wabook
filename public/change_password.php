<?php
function edit_profile()
{
	global $wpdb;
	if(isset($_POST['changepw'])) 
	{	
		$newpassword = $wpdb->_real_escape($_POST['newpw']);
		$confirmpassword = $wpdb->_real_escape($_POST['newpw2']);
		if($newpassword == $confirmpassword)
		{
			$current_user = wp_get_current_user();
			$user_email = $current_user->user_email;
			$table_name = $wpdb->prefix . "users";

			$wpdb->update($table_name,
				array( 'user_pass' => wp_hash_password($newpassword) ),
				array( 'user_email' => $user_email),
				array('%s'),
				array('%s')
			);		
			echo '<script type="text/javascript"> alert("Update Successful") </script>';
			wp_redirect(wp_login_url());
			
		}
		else
		{
			echo '<script type="text/javascript"> alert("Password Not Match") </script>';
		}			
	}
}


function load_profile()
{
	ob_start();
	edit_profile();
	
	if(!is_user_logged_in()) {
		wp_redirect(home_url());	
	}
	else
	{
		$current_user = wp_get_current_user();
		$name = $current_user->user_nicename;
		$email = $current_user->user_email;
		include( dirname( __FILE__ ) . '/partials/profile.php' );
	}

	return ob_get_clean();
}
add_shortcode('profile','load_profile');
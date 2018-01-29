<?php
function get_book_details()
{
	global $sale_data;
	
	if(is_user_logged_in()) {	
		require( dirname( __FILE__ ) . '/config/config.php' );
		require( dirname( __FILE__ ) . '/config/func.php' );
		$reqHead = getReq($token);
		$context = stream_context_create($reqHead);
		$current_user = wp_get_current_user();
		$useremail = $current_user->user_email;
			
		// Open the file using the HTTP headers set above
		$sales = file_get_contents('https://api.wahdah.my/partner/sales.json?search='.$useremail, false, $context);
		
		$sale_data = json_decode($sales, true);
	}
}


function book_list()
{
	ob_start();
	get_book_details();
	
	global $sale_data;
	if(!is_user_logged_in()) {
		wp_redirect(home_url());	
	}
	else
	{
		include( dirname( __FILE__ ) . '/partials/history_template.php' );
	}
	return ob_get_clean();
}
add_shortcode('booklist','book_list');
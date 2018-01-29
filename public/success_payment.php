<?php

function get_sale_id()
{
	global $sale_data,$days;
	require( dirname( __FILE__ ) . '/config/config.php' );
	require( dirname( __FILE__ ) . '/config/func.php' );
	$reqHead = getReq($token);
	$context = stream_context_create($reqHead);
	$cryptID = $_GET['id'];
	$saleID = encrypt_decrypt('decrypt',$cryptID);

    // Open the file using the HTTP headers set above
    $sales = file_get_contents('https://api.wahdah.my/partner/sales/'.$saleID.'.json', false, $context);
	
	$sale_data = json_decode($sales, true);
	
	$pickupDate = new DateTime(str_replace("T"," ",$sale_data['sale']['start']));
		$returnDate = new DateTime(str_replace("T"," ",$sale_data['sale']['end']));
		
		$interval = $pickupDate->diff($returnDate);

		$days = $interval->d;

		if($days > 0 && $interval->h > 4){
			$days = $days + 1;
		}else if($days == 0){
			$days = 1;
		}
	
}

function thankyou_page()
{
	ob_start();
	if(!empty($_GET))
	{   
		get_sale_id();
		global $sale_data,$days;
		if(!empty($sale_data))
		{
			include( dirname( __FILE__ ) . '/partials/thankyou.php' );
			redirect();
		}
		else
		{
			exit;
			wp_redirect(home_url());
		}
	}
	else
	{
		wp_redirect(home_url());	
	}
	return ob_get_clean();
}
add_shortcode('thankU','thankyou_page');

function redirect()
{
	global $sale_data;
	if(!is_user_logged_in()) {
		
		$loginusername = $sale_data['sale']['email'];
		$user = get_user_by('login', $loginusername);
        $user_id = $user->ID;
        //login
        wp_set_current_user($user_id, $loginusername);
        wp_set_auth_cookie($user_id);
        do_action('wp_login', $loginusername);
		
	}else{}
	echo'<script type="text/javascript">
			window.setTimeout(function(){
			window.location.href = "'.home_url('/history/').'"
    }, 5500);
		</script>';
}
?>
<?php
function get_book() {
	
	global $sale_data,$days,$payapi;
    if(!empty($_GET))
	{
		require( dirname( __FILE__ ) . '/config/config.php' );
		require( dirname( __FILE__ ) . '/config/func.php' );
		$getOpts = getReq($token);
    	$context = stream_context_create($getOpts);
        $salesID = $_GET['bookID'];

    	// Open the file using the HTTP headers set above
    	$sales = file_get_contents('https://api.wahdah.my/partner/sales/view/'.$salesID.'.json', false, $context);
    	$sale_data = json_decode($sales, true);
		
		$payment_api = file_get_contents('https://api.wahdah.my/partner/company-profile.json', false, $context);
		$payapi = json_decode($payment_api, true);
		
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
	
	if(isset($_POST['paybtn']))
	{
		$paymethod = $_POST['paymentmethod'];
		if($paymethod == '1')
		{	
			wp_redirect("http://www.wahdah.my/partner/payment/paypal/". $salesID);
		}
		if($paymethod == '2')
		{	
			$arr_params = array( 
					'id' => encrypt_decrypt('encrypt',$salesID),
				);
			wp_redirect(esc_url(add_query_arg($arr_params,home_url('/transfer/')) ));
		}
		if($paymethod == '3')
		{
			$arr_params = array( 
					'id' => encrypt_decrypt('encrypt',$salesID),
				);
			wp_redirect(esc_url(add_query_arg($arr_params,home_url('/thankyou/')) ));
		}
	}
	
	if(isset($_POST['backbtn']))
	{				
		wp_redirect(home_url('/history/'));
	}
	
}


function book_details_shortcode() {
    ob_start();
	get_book();
	global $sale_data,$days,$payapi;
	$current_user = wp_get_current_user();
	$useremail = $current_user->user_email;
	if(!empty($sale_data))
	{   
		if(strtolower($useremail) !== strtolower($sale_data['sale']['email']))
		{
			wp_redirect(home_url('/history/'));
		}
		else
		{
			include( dirname( __FILE__ ) . '/partials/view_history_template.php' );
		}
	}
	else
	{
		wp_redirect(home_url('/history/'));
	}
	return ob_get_clean();

}
add_shortcode( 'view_book_details', 'book_details_shortcode' );
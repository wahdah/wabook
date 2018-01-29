<?php
function get_details() {
	global $sale_data,$days,$vehicle_data;
	
    if(!empty($_GET))
	{
		require( dirname( __FILE__ ) . '/config/config.php' );
		require( dirname( __FILE__ ) . '/config/func.php' );
		$getOpts = getReq($token);
    	$context = stream_context_create($getOpts);
		$saleid = $_GET['bookID'];
        $salesID = encrypt_decrypt('decrypt',$saleid);
    	// Open the file using the HTTP headers set above
    	$sales = file_get_contents('https://api.wahdah.my/partner/sales/view/'.$salesID.'.json', false, $context);
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
		
	if(!empty($_POST)){
		
		$paymethod = $_POST['paymentmethod'];
		if($paymethod == '1')
		{	
			wp_redirect("http://www.wahdah.my/partner/payment/paypal/". $salesID);
		}
		else
		{
			$arr_params = array( 
					'id' => encrypt_decrypt('encrypt',$salesID),
				);
			wp_redirect(esc_url(add_query_arg($arr_params,home_url('/thankyou/')) ));
		}
	
		
    }
	
}

function payment_shortcode() {
    ob_start();
	get_details();
	global $sale_data,$days,$vehicle_data;
	
	if(!empty($sale_data))
	{    
		include( dirname( __FILE__ ) . '/partials/payment_template.php' );
	}
	else
	{
		wp_redirect(home_url());
	}
	return ob_get_clean();

}
add_shortcode( 'payment', 'payment_shortcode' );
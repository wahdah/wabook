<?php
function add_book() {
	
	global $vehicle_data,$days,$rental_amount,$rounding,$pickupReturnFee,$depositAmount,$taxAmount,$discountAmount,$returnDate,$returnTime,$pickupLocation,$returnLocation,$pickupDate,$pickupTime,$fleet_id;
	
    if(!empty($_GET))
	{
		global $wpdb;
		require( dirname( __FILE__ ) . '/config/config.php' );
		require( dirname( __FILE__ ) . '/config/func.php' );
		$getOpts = getReq($token);
    	$context = stream_context_create($getOpts);
        $partnerVehicleId = $_GET['vehicleId'];
    	// Open the file using the HTTP headers set above
    	$vehicle = file_get_contents('https://api.wahdah.my/partner/vehicles/'.$partnerVehicleId.'.json', false, $context);
    	$vehicle_data = json_decode($vehicle, true);
		
		
		$vehicle_ID = $vehicle_data['vehiclePartner']['vehicle_id'];
		$getOpts3 = getReq($token);
    	$context3 = stream_context_create($getOpts3);
    	$fleet= file_get_contents('https://api.wahdah.my/partner/fleets/.json?search='.$vehicle_ID, false, $context);
    	$fleet_data = json_decode($fleet, true);
		
		
		
			$pickupLocation = $_GET['start_location'];
			$returnLocation = $_GET['return_location'];
			
			$pickupTime = date("H:i:s", strtotime($_GET["start_time"]));
			$returnTime = date("H:i:s", strtotime($_GET["end_time"]));
			
			$pickupDate = new DateTime($_GET["pickup_date"] . $pickupTime);
			$returnDate = new DateTime($_GET["return_date"] . $returnTime);
			
			$interval = $pickupDate->diff($returnDate);

			$days = $interval->d;

			if($days > 0 && $interval->h > 4){
				$days = $days + 1;
			}else if($days == 0){
				$days = 1;
			}
			
			$oRate[1] = $vehicle_data['vehiclePartner']['o_rate_1'];
			$oRate[2] = $vehicle_data['vehiclePartner']['o_rate_2'];
			$oRate[3] = $vehicle_data['vehiclePartner']['o_rate_3'];
			$oRate[4] = $vehicle_data['vehiclePartner']['o_rate_4'];
			$oRate[5] = $vehicle_data['vehiclePartner']['o_rate_5'];

			$rental_amount = calculate_rental_amount($days, $oRate);


			// additional rate
			//------------------------------------------------------
			$pickupReturnFee = $wpdb->get_var("SELECT pickupfee FROM wp_wahdah_location WHERE name = '$pickupLocation'");
			$rounding = 0;
			$depositAmount = $wpdb->get_var("SELECT deposit FROM wp_wahdah_setup");
			$discountAmount = 0;
			$taxAmount = 0;
			//------------------------------------------------------


	}
	
	if(!empty($_POST)){
		global $wpdb;
		
		$cus_name = $_POST['s_name'];
		$cus_email = $_POST['email'];
	
		$table_name = $wpdb->prefix . "users";
		$result = $wpdb->get_var(
					$wpdb->prepare(
						"SELECT * FROM ".$table_name." 
						WHERE user_login = %s LIMIT 1",
						$cus_email
					));
		
		if ( $result > 0 )
		{
			//
		}						
		else
		{	
			$wpdb->insert($table_name,
				array(
					'user_login' => strtolower($cus_email),
					'user_pass' => wp_hash_password('abcd123'),
					'user_nicename' => $cus_name,
					'user_email' => $cus_email,
					'user_status' => 1,
					'display_name' => $cus_name,
					));		
		}
		
		//insert data to api
        $data = $_POST;
		$data['name'] = $data['s_name'];
		unset($data['s_name']);
        $postOpts = postReq($token, $data);
    	$postContext = stream_context_create($postOpts);
    	$file = file_get_contents('https://api.wahdah.my/partner/sales.json', false, $postContext);
		$reqHead2 = getReq($token);
		$context2 = stream_context_create($reqHead2);
		
		
		$sales = file_get_contents('https://api.wahdah.my/partner/sales.json?search='.$cus_email, false, $context2);
		$sale_data = json_decode($sales, true);
		$vID = $_GET['vehicleId'];
		$arr_params = array( 
					'bookID' => encrypt_decrypt('encrypt',$sale_data['sales'][0]['id']),
				);
		
		wp_redirect(esc_url(add_query_arg($arr_params,home_url('/payment/') )));
    }
}

function book_shortcode() {
    ob_start();
	add_book();
	global $vehicle_data,$days,$rental_amount,$rounding,$pickupReturnFee,$depositAmount,$taxAmount,$discountAmount,$returnDate,$returnTime,$pickupLocation,$returnLocation,$pickupDate,$pickupTime,$fleet_id;
	
	if(!empty($vehicle_data))
	{
		include( dirname( __FILE__ ) . '/partials/book_details_template.php' );
	}
	else
	{
		wp_redirect(home_url());
	}
	
	return ob_get_clean();

}
add_shortcode( 'booking_details', 'book_shortcode' );
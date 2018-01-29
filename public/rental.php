<?php
//Search Form


function car_search() {
	require( dirname( __FILE__ ) . '/config/config.php' );
    require( dirname( __FILE__ ) . '/config/func.php' );
	global $vehicle_data;
    if(isset($_GET['submit_search']))
	{
			
			$reqHead = getReq($token);

			$context = stream_context_create($reqHead);

			// Open the file using the HTTP headers set above
			$vehicles = file_get_contents('https://api.wahdah.my/partner/vehicles.json', false, $context);

			$vehicle_data = json_decode($vehicles, true);

			$pickupLocation = $_GET['start_location'];
			$returnLocation = $_GET['end_location'];
		
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

			$v =array();
			$i = 0;
			foreach($vehicle_data['vehicles'] as $v){
				$oRate[1] = $v['o_rate_1'];
				$oRate[2] = $v['o_rate_2'];
				$oRate[3] = $v['o_rate_3'];
				$oRate[4] = $v['o_rate_4'];
				$oRate[5] = $v['o_rate_5'];

				$rental_amount = calculate_rental_amount($days, $oRate);
				$vehicle_data['vehicles'][$i]['rental_amount'] = $rental_amount;
				$vehicle_data['vehicles'][$i]['days'] = $days;
					
				$i++;
			}
	
	}	
}
//Form Display (shortcode)
function wah_shortcode($atts) {

	$layout = shortcode_atts(array(
		'type' => 'horizontal'
	),$atts); 

	ob_start();
	car_search();
	global $wpdb;
	$search_location = $wpdb->get_results("SELECT * FROM wp_wahdah_location");
	
	if($layout['type'] == "box")
	{	
		include( dirname( __FILE__ ) . '/partials/box_search_bar.php' );
	}
	else
	{
		include( dirname( __FILE__ ) . '/partials/search_bar.php' );
	}
	
	return ob_get_clean();
}
add_shortcode( 'design', 'wah_shortcode' );


//Search Result
function car_results( $atts,$content){	
global $vehicle_data;
	if (empty ( $vehicle_data )) {
		return $content;
	}
	else{
		ob_start();
		$displaylist = '';
		if( !empty ( $vehicle_data ) && ! is_wp_error ( $vehicle_data ) )
		{				
			include( dirname( __FILE__ ) . '/partials/car_search_div.php' );
		}
		echo '<div id="container2" class="row">'.$displaylist.'</div>';
		return ob_get_clean();
	}

}
add_shortcode('search_results','car_results');
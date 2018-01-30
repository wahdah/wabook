<?php
foreach ( $vehicle_data['vehicles'] as $v )
		{	
				$displaylist .= '<div class="col-sm-6 col-md-4 "> <div class="car-container">';
				if(!empty($v['vehicle']['image']['clean']['thumb']['http'])){
				$displaylist .= '<img src="'. $v['vehicle']['image']['clean']['thumb']['http'] .'" alt="">';
				}
				$displaylist .= '<p><b>'. $v['vehicle']['manufacturer']['name'].' '. $v['vehicle']['name']. ' ('.$v['vehicle']['transmission'] .') '.$v['vehicle']['engine_size'] / 1000 .'</b></p>';
				$displaylist .= '<p>Duration : '.$v['days'].' Day(s)</p>';
				$displaylist .= '<div class="pricebox">';
				$displaylist .= '<h3><small id="myr">MYR</small> <span id="price">'.sprintf('%0.2f', round($v['rental_amount'], 2)) .'</span></h3>';
				
				$arr_params = array( 
					'start_location' => $_GET['start_location'],
					'return_location' => $_GET['end_location'],
					'start_time' => $_GET['start_time'],
					'end_time' => $_GET['end_time'],
					'pickup_date' => $_GET['pickup_date'],
					'return_date' => $_GET['return_date'],
					'vehicleId' => $v['id']
				);
				$displaylist .= '<a href="'. esc_url(add_query_arg( $arr_params,home_url('/details/') )).'" class="btn btn-primary btn-carlist" val="'.$v['id'].'">Book Now</a>';
				$displaylist .= '</div>';
				$displaylist .= '</div>';
                $displaylist .= '</div>';
		}
		

?>

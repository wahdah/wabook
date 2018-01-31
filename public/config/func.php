<?php
    function pr($data){
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }

    function getReq($token){
    	$opts = array(
      		'http'=>array(
    			'method'=>"GET",
    			'header'=>
    				"Accept: application/json\r\n" .
    				"Authorization: Bearer $token\r\n"
    		)
    	);

        return $opts;
    }

    function postReq($token, $data){
        $opts = array(
            'http'=>array(
    			'method'=>"POST",
    			'header'=>
    				"Authorization: Bearer $token\r\n" .
    				"Accept: application/json\r\n" .
                    "Content-Type: application/x-www-form-urlencoded",
                'content'=> http_build_query($data)
    		)
    	);

        return $opts;
    }
	
	function patchReq($token, $data){
        $opts = array(
            'http'=>array(
    			'method'=>"PATCH",
    			'header'=>
    				"Authorization: Bearer $token\r\n" .
    				"Accept: application/json\r\n" .
                    "Content-Type: application/x-www-form-urlencoded",
                'content'=> http_build_query($data)
    		)
    	);

        return $opts;
    }

    function calculate_rental_amount($days,$rate){
        if ($days <= 3) $rental_amount = bcmul($days, $rate[1], 2);
		if ($days >= 4 && $days <= 6) $rental_amount = bcmul($days, $rate[2], 2);
		if ($days === 7) $rental_amount = bcmul($days, $rate[3], 2);
		if ($days >= 8 && $days <= 13) $rental_amount = bcmul($days, $rate[4], 2);
		if ($days >= 14 && $days <= 29) $rental_amount = bcmul(30, $rate[5], 2);
		if ($days >= 30) $rental_amount = bcmul($days, $rate[5], 2);

        return $rental_amount;
    }
?>

<?php
function payment_receipt()
{
	global $sale_data;
	if(!empty($_GET))
	{
		require( dirname( __FILE__ ) . '/config/config.php' );
		require( dirname( __FILE__ ) . '/config/func.php' );
		$getOpts = getReq($token);

    	$context = stream_context_create($getOpts);

        $salesID = $_GET['bookID'];

    	// Open the file using the HTTP headers set above
    	$sales = file_get_contents('https://api.wahdah.my/partner/sales/'.$salesID.'.json', false, $context);

    	$sale_data = json_decode($sales, true);
	}
	
	if(!empty($_POST)){
		
		
		$amountbox=$_POST['amountbox'];
		$datebox= $_POST["datebox"];
		$timebox = $_POST["timebox"];
		$bankname = $_POST["bankname"];
		$benefbox = $_POST["benefbox"];
		$transactionbox = $_POST["transactionbox"];
		$proof = $_FILES['proof']['name'];
		$tranfer = $_POST["transfer"];
		$payment = $_POST["payment"];
		$cid = $row2['customerID'];
		$dir = '../proof/';
				$target = $dir . basename($_FILES['proof']['name']);
				
				//get data from the form
				if(move_uploaded_file($_FILES['proof']['tmp_name'],$target))
					$msg = "Image uploaded successfully";
				else
					$msg = "Image uploaded failed";

		
       
    }
}


function payment_offline() {
    ob_start();
	payment_receipt();
	global $wpdb,$sale_data;
	include( dirname( __FILE__ ) . '/partials/offline_payment.php' );
	
	return ob_get_clean();

}
add_shortcode( 'offline_pay', 'payment_offline' );
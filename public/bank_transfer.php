<?php
function payment_receipt()
{
	global $sale_data,$bankapi;
	if(!empty($_GET))
	{
		require( dirname( __FILE__ ) . '/config/config.php' );
		require( dirname( __FILE__ ) . '/config/func.php' );
		$getOpts = getReq($token);

    	$context = stream_context_create($getOpts);
		$said = $_GET['id'];
        $salID = encrypt_decrypt('decrypt',$said);

    	// Open the file using the HTTP headers set above
    	$sales = file_get_contents('https://api.wahdah.my/partner/sales/'.$salID.'.json', false, $context);
    	$sale_data = json_decode($sales, true);
		
		$bankap_details = file_get_contents('https://api.wahdah.my/partner/company-profile.json', false, $context);
		$bankapi = json_decode($bankap_details, true);
	}
	
	if(!empty($_POST)){
		
		
		$amountbox=$_POST['amountbox'];
		$date= date("Y:m:d", strtotime($_POST["date_transaction"]));
		$bankname = $_POST["bankname"];
		$benefbox = $_POST["benefbox"];
		$tranfer = $_POST["transfer"];
		$transaction = $_POST["transaction"];
		$tmp_name = $_FILES["picture"]["tmp_name"];



		if (!file_exists(dirname(dirname( __FILE__ )))) {
			mkdir('receipts', 0777, true);
		}

		$FolderUrl   = dirname(dirname( __FILE__ )).'/receipts/';

		if (!file_exists($FolderUrl)) {
			mkdir($FolderUrl, 0777, true);
		}


		define('UPLOADS_THEME_PATH',$FolderUrl);

		//insert
		if (isset($_POST['insert'])) {
			global $wpdb;
			$table_name = $wpdb->prefix . "upload";
			$path_array = wp_upload_dir(); // normal format start
			$file_name   =   pathinfo($tmp_name ,PATHINFO_FILENAME).time().".".pathinfo($_FILES['picture']['name'] ,PATHINFO_EXTENSION); 
			$imgtype     =   strtolower(pathinfo($tmp_name,PATHINFO_EXTENSION));                
			$targetpath  =   UPLOADS_THEME_PATH.''.$file_name;

			move_uploaded_file($tmp_name, $targetpath );

			$wpdb->insert(
				$table_name, //table
				array('amount' => $amountbox, 'date' => $date, 'bank' => $bankname, 'type' => $tranfer, 'receipt_no' => $transaction, 'image'=>$file_name), //data
				array('%f', '%s', '%s', '%s', '%s', '%s')        
			);
			$bookid = $_GET['id'];
			$arr_params = array( 
					'id' => $bookid,
				);
			wp_redirect(esc_url(add_query_arg($arr_params,home_url('/thankyou/')) ));
		}
       
    }
}


function payment_offline() {
    ob_start();
	payment_receipt();
	global $wpdb,$sale_data,$bankapi;
	if(!empty($sale_data['sale']))
	{
		include( dirname( __FILE__ ) . '/partials/offline_payment.php' );
	}
	else
	{
		wp_redirect(home_url());
	}
	
	return ob_get_clean();

}
add_shortcode( 'offline_pay', 'payment_offline' );
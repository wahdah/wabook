<h1>Pending Booking</h1>

<div style="display:inline-block;width:550px;float:left">
	<table class="table" class="table table-bordered">
		<tr>
		<?php if(!empty($sd["invoice_partner"]["invoice_number"])) { ?>
			<th>Referene No.</th>
		<?php }?>
			<th>Amount(RM)</th>
			<th>Payment Status</th>
			<th>Update Status</th>
			<th>View Receipt</th>
		</tr>
		<?php if(!empty($sale_data['sales'])){ ?>
		
		<?php foreach($sale_data['sales'] as $sd):
		if($sd['payment_status'] !== 1 && $sd['payment_method'] == '')
		{
			$start = date("j M Y, g:i A", strtotime(str_replace("T"," ",$sd['start'])));
			$end = date("j M Y, g:i A", strtotime(str_replace("T"," ",$sd['end'])));

			 echo '<tr>';
				if(!empty($sd["invoice_partner"]["invoice_number"]))
				{
					echo'<td>'.$sd["invoice_partner"]["invoice_number"].'</td>';
				}
				echo'<td>' . sprintf('%0.2f', round($sd['rental_amount'], 2)) .'</td>';
					if($sd['payment_status'] == '0')
						echo "<td>Unpaid</td>";
					else
						echo '<td>Paid</td>';
			?>
		
			<form method="post">
				<input type="hidden" name="type" value="<?= $sd['type'] ?>">
				<input type="hidden" name="name" value="<?= $sd['name'] ?>">
				<input type="hidden" name="email" value="<?= $sd['email'] ?>">
				<input type="hidden" name="address" value="<?= $sd['address'] ?>">
				<input type="hidden" name="ic_no" value="<?= $sd['ic_no'] ?>">
				<input type="hidden" name="mobile_number" value="<?= $sd['mobile_number'] ?>">
				<input type="hidden" name="note" value="<?= $sd['note'] ?>">
				<input type="hidden" name="vehicle_id" value="<?= $sd['vehicle_id'] ?>">
				<input type="hidden" name="vehicle_name" value="<?= $sd['vehicle_name'] ?>">
				<input type="hidden" name="pickup_location" value="<?= $sd['pickup_location'] ?>">
				<input type="hidden" name="return_location" value="<?= $sd['return_location'] ?>">
				<input type="hidden" name="start" value="<?= $sd['start'] ?>">
				<input type="hidden" name="end" value="<?= $sd['end'] ?>">
				<input type="hidden" name="addons" value="<?= $sd['addons'] ?>">
				<input type="hidden" name="rental_amount" value="<?= $sd['rental_amount'] ?>">
				<input type="hidden" name="pickup_return_fee" value="<?= $sd['pickup_return_fee'] ?>">
				<input type="hidden" name="addon_amount" value="<?= $sd['addon_amount'] ?>">
				<input type="hidden" name="discount_amount" value="<?= $sd['discount_amount'] ?>">
				<input type="hidden" name="total_amount_before_tax" value="<?= $sd['total_amount_before_tax'] ?>">
				<input type="hidden" name="tax_amount" value="<?= $sd['tax_amount'] ?>">
				<input type="hidden" name="rounding" value="<?= $sd['rounding'] ?>">
				<input type="hidden" name="total_amount" value="<?= $sd['total_amount'] ?>">
				<input type="hidden" name="type_pricing" value="<?= $sd['type_pricing'] ?>">		
				<input type="hidden" name="status" value="<?= $sd['status'] ?>">
				<input type="hidden" name="reimburse_status" value="<?= $sd['reimburse_status'] ?>">
				<input type="hidden" name="deposit_amount" value="<?= $sd['deposit_amount'] ?>">
				<input type="hidden" name="fleet_id" value="<?= $sd['fleet_id'] ?>">
				<input type="hidden" name="sale_id" value="<?= $sd['sale_id'] ?>">				
				<input type="hidden" name="user_id" value="<?= $sd['user_id'] ?>">
				<input type="hidden" name="staff_id" value="<?= $sd['staff_id'] ?>">
				<input type="hidden" name="imburse_id" value="<?= $sd['imburse_id'] ?>">
				<input type="hidden" name="blacklist" value="<?= $sd['blacklist'] ?>">
				<input type="hidden" name="remark" value="<?= $sd['remark'] ?>">
				<input type="hidden" name="payment_data" value="<?= $sd['payment_data'] ?>">
				<input type="hidden" name="payment_at" value="<?= $sd['payment_at'] ?>">
				<input type="hidden" name="payment_method" value="<?= $sd['payment_method'] ?>">
				<input type="hidden" name="katsana_data" value="<?= $sd['katsana_data'] ?>">
				<input type="hidden" name="created_at" value="<?= $sd['created_at'] ?>">
				<input type="hidden" name="invoice_partner" value="<?= $sd['invoice_partner']['invoice_number'] ?>">
				<input type="hidden" name="staff" value="<?= $sd['staff'] ?>">
				<input type="hidden" name="sale" value="<?= $sd['sale'] ?>">
				<input type="hidden" name="fleet" value="<?= $sd['fleet'] ?>">	
				<input type="hidden" name="payment_status" value="1" />
				<input type="hidden" name="id" value="<?= $sd['id'] ?>" />
			<td><a href="" onclick="return confirm('Do you want to approve this booking?')"><input type="submit" name="updatepay" value="Approve" /></a></td>
			</form>
			<?php
				$table_name = $wpdb->prefix . "upload";
				$result = $wpdb->get_var(
					$wpdb->prepare(
						"SELECT * FROM ".$table_name." 
						WHERE receipt_no = %s LIMIT 1",
						$sd["id"]
					));
				if ( $result > 0 )
				{
					echo '<td><a href="?page=book-list&receipt='.$sd["id"].'">View</a></td>';
				}						
				else
				{
					echo '<td>View</td>';					
				}	
			
			echo '</tr>';
		}
		endforeach;
		}
		else{ echo'No result found'; }?>
	</table>
</div>

<div style="float:left;width:550px;display:inline-block">
<?php
	if(!empty($_GET['receipt']))
	{
		$refno = $_GET['receipt'];
		$table_name = $wpdb->prefix . "upload";
		$image = $wpdb->get_var( 
			$wpdb->prepare("SELECT path FROM ".$table_name." WHERE receipt_no = %s", $refno)  
		);
		if ($image)
		{
			echo '<img src="'.$image.'">';

		}
		
	}
?>
</div>
<?php
?>
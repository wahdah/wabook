<h1>Pending Booking</h1>

<div style="display:inline-block;width:550px;float:left">
	<table class="table" border="1">
		<tr>
			<th>Referene No.</th>
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
			

			 echo '<tr>
					<td>'.$sd["invoice_partner"]["invoice_number"].'</td>
					<td>' . sprintf('%0.2f', round($sd['rental_amount'], 2)) .'</td>';
					if($sd['payment_status'] == '0')
						echo "<td>Unpaid</td>";
					else
						echo '<td>Paid</td>';
			?>
			<td><a href="?page=book-list&bookID=<?= $sd['id'] ?>&payment_status=1 " onclick="return confirm('Do you want to approve this booking?')"> Approve </a></td>
			<?php
				$table_name = $wpdb->prefix . "upload";
				$result = $wpdb->get_var(
					$wpdb->prepare(
						"SELECT * FROM ".$table_name." 
						WHERE receipt_no = %s LIMIT 1",
						$sd["invoice_partner"]["invoice_number"]
					));
				if ( $result > 0 )
				{
					echo '<td><a href="?page=book-list&receipt='.$sd["invoice_partner"]["invoice_number"].'">View</a></td>';
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
			echo '<img src="/'.$image.'" />';

		}
		
	}
?>
</div>
<?php
?>
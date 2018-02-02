<div>
	<table class="table table-bordered">
        <tbody>
		<tr>
		<?php if(!empty($sd["invoice_partner"]["invoice_number"])) { ?>
			<th>Reference No.</th>
		<?php }?>
			<th>Car</th>
			<th>Date</th>
			<th>Pickup Location</th>
			<th>Return Location</th>
			<th>Fee (RM)</th>
			<th>Payment Status</th>
		</tr>
            </tbody>
		<?php if(!empty($sale_data['sales'])){ ?>
		
		<?php foreach($sale_data['sales'] as $sd):
		
		$start = date("j M Y, g:i a", strtotime(str_replace("T"," ",$sd['start'])));
		$end = date("j M Y, g:i a", strtotime(str_replace("T"," ",$sd['end'])));
		
		$arr_params = array( 
						'bookID' => $sd['id']
					);
		echo '<tr>';
		if(!empty($sd["invoice_partner"]["invoice_number"]))
		{
			echo' <td><a href="'. add_query_arg($arr_params,home_url('/viewhistory/')) .'">'.$sd["invoice_partner"]["invoice_number"].'</a></td>
			<td>' .$sd['vehicle_name'] .'</td>';
		}
		else{
			echo'<td><a href="'. add_query_arg($arr_params,home_url('/viewhistory/')) .'">' .$sd['vehicle_name'] .'</a></td>';
		}
		echo '<td style="width:190px">' .$start.' <b>TO</b> <br>' .$end .'</td>
		 <td>' .$sd['pickup_location'] .'</td>
			  <td>' .$sd['return_location'] .'</td>
			  <td>' . sprintf('%0.2f', round($sd['rental_amount'], 2)) .'</td>';
			  if($sd['payment_status'] == '0')
				  echo "<td>Unpaid</td>";
			  else
				  echo '<td>Paid</td>';
		
		 echo '</tr>';
		endforeach;
		}
		else{ echo'No result found'; }?>
	</table>
</div>
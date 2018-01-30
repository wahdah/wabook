<div class="row">
   <div class="col-md-4">
         <div class="box-book-details">
            <div>
                <img src="<?= $sale_data['image']['clean']['thumb']['http']?>" alt="">
            </div>
            <div>
                <div>
                    <h3 id="carselect"><b>SELECTED CAR</b></h3>
                    <p><b><?= $sale_data['sale']['vehicle_name'] ?></b></p>
                </div>
                <div id="block_display"><h4 id="location">Pickup Location:</h4></br>
                    <p><?= $sale_data['sale']['pickup_location'] ?>
                    <br><?= date("j M Y, g:i a", strtotime(str_replace("T"," ",$sale_data['sale']['start'])));?></p>
                </div>
                <div id="block_display"><h4 id="location">Return Location:</h4><br>
                    <p><?= $sale_data['sale']['return_location'] ?>
                    <br><?= date("j M Y, g:i a", strtotime(str_replace("T"," ",$sale_data['sale']['end'])));?></p>
                </div>
                <div>
                    <h3 class="h3"><small id="myr">MYR </small><span id="price"> <?= sprintf('%0.2f', round($sale_data['sale']['rental_amount'], 2)) ?></span> </h3> <p id="days">for <?= $days ?> day(s)</p>
                </div>
            </div>
        </div>
    </div>
    
        <div class="col-md-8">
			<div>
				<h3 class="h3 title">Summary of Rental</h3>
				<table>
					<tr>
						<th>Item</th>
						<th>Amount(MYR)</th>
					</tr>
					<tr>
						<td>Rental</td>
						<td><?= sprintf('%0.2f', round($sale_data['sale']['rental_amount'], 2)) ?></td>
					</tr>
					<tr>
						<td>Total Amount</td>
						 <td><?= sprintf('%0.2f', round($sale_data['sale']['total_amount_before_tax'], 2)) ?></td>
					</tr>
					<tr>
						<td>Rounding</td>
						<td><?= sprintf('%0.2f', round($sale_data['sale']['rounding'], 2)) ?></td>
					</tr>
					<tr>
						<td>Pickup Return Fee</td>
						<td><?= sprintf('%0.2f', round($sale_data['sale']['pickup_return_fee'], 2)) ?></td>
					</tr>
					<tr>
						<td>Refundable Deposit</td>
						<td><?= sprintf('%0.2f', round($sale_data['sale']['deposit_amount'], 2)) ?></td>
					</tr>
					<tr>
						<td>Grand Total</td>
						<td><?= sprintf('%0.2f', round($sale_data['sale']['total_amount'], 2)) ?></td>
					</tr>
				</table>
			</div>
        
           
               <div class="box summary-book">
				<h3><strong>Customer Details</strong></h3>
				<table>
					<tr>
						<td>Name</td>
						<td><?= $sale_data['sale']['name'] ?></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><?= $sale_data['sale']['email'] ?></td>
					</tr>
					<tr>
						<td>Address</td>
						<td><?= $sale_data['sale']['address'] ?></td>
					</tr>
					<tr>
						<td>IC Number</td>
						<td><?= $sale_data['sale']['ic_no'] ?></td>
					</tr>
					<tr>
						<td>Mobile Number</td>
						<td><?= $sale_data['sale']['mobile_number'] ?></td>
					</tr>
					<tr>
						<td>Note</td>
						<td><?= $sale_data['sale']['note'] ?></td>
					</tr>
				</table>
            </div>
            <hr>
                
                <form action="" method="post">
			<div style="height:100px;">
				<h3><strong>Payment Method</strong></h3>
				<?php
				if($payapi['company_profile']['payment'] !== 0)
				{
					if($payapi['company_profile']['paypal'] == 1)
					{
						if($payapi['company_profile']['paypal_enabled'] == 1)
							echo '<label for="paypal"><input type="radio" id="paypal" name="paymentmethod" value="1" checked />Paypal</label>';
					}
					if($payapi['company_profile']['bank_transfer_enabled'] == 1)
						echo'<label for="trasfer"><input type="radio" id="trasfer" name="paymentmethod" value="2" />Bank Trasnfer</label>';
					if($payapi['company_profile']['cod_enabled'] == 1)
						echo'<label for="cod"><input type="radio" id="cod" name="paymentmethod" value="3" />COD(Cash On Delivery)</label>';
					
				}
				?>

			</div>
			<input style="float:right" type="submit" id="btn-pay" name="submitbtn" value="Proceed To Pay" />       
		</form>
    </div>        
</div>
  
		


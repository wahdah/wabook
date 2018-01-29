<div class="box-book-details"> 
    <div class="row">
		<div class="col-md-5">
            <div>
			<img src="<?= $sale_data['image']['clean']['thumb']['http']?>" alt="">
        </div>
        </div>
        
        <div class="col-md-7">
			<div>
				<h3 id="carselect"><b>SELECTED CAR</b></h3>
				<p><b><?= $sale_data['sale']['vehicle_name'] ?></b></p>
			</div>
			<div id="block_display"><h5 id="location">Pickup Location</h5></br>
				<p><?= $sale_data['sale']['pickup_location'] ?>
				<br><?= date("j M Y, g:i A", strtotime(str_replace("T"," ",$sale_data['sale']['start'])));?></p>
			</div>
            <div id="block_display"><h5 id="location">Return Location:</h5><br>
				<p><?= $sale_data['sale']['return_location'] ?>
				<br><?= date("j M Y, g:i A", strtotime(str_replace("T"," ",$sale_data['sale']['end']))); ?></p>
			</div>
			<div>
				<h3 class="h3"><small id="myr">MYR </small><span id="price"> <?= sprintf('%0.2f', round($sale_data['sale']['rental_amount'], 2)) ?></span> </h3> <p id="days">for <?= $days ?> day(s)</p>
			</div>
        </div>
    </div>
</div>
    <h3 class="h3 title">Summary of Rental</h3>			
        <div class="summaryhistory">
				<table class="table">
                    <thead>
					<tr>
						<th>Item</th>
						<th class="text-center">Amount (MYR)</th>
					</tr>
                    </thead>
					<tr>
						<td>Rental</td>
						<td class="text-center"><?= sprintf('%0.2f', round($sale_data['sale']['rental_amount'], 2)) ?></td>
					</tr>
					<tr>
						<td>Pickup Return Fee</td>
						 <td class="text-center"><?= sprintf('%0.2f', round($sale_data['sale']['pickup_return_fee'], 2)) ?></td>
					</tr>
					<tr>
						<td>Refundable Deposit</td>
						<td class="text-center"><?= sprintf('%0.2f', round($sale_data['sale']['deposit_amount'], 2)) ?></td>
					</tr>
					<tr>
						<td class="text-right"><b>Total Amount</b></td>
						<td class="text-center"><b><?= sprintf('%0.2f', round($sale_data['sale']['total_amount_before_tax'], 2)) ?></b></td>
					</tr>
					<tr>
						<td class="text-right"><b>Rounding</b></td>
						<td class="text-center"><b><?= sprintf('%0.2f', round($sale_data['sale']['rounding'], 2)) ?></b></td>
					</tr>
					<tr>
						<td class="text-right"><b>Grand Total</b></td>
						<td class="text-center"><b><?= sprintf('%0.2f', round($sale_data['sale']['total_amount'], 2)) ?></b></td>
					</tr>
				</table>
			</div> 
		<h3 class="h3 title">Customer Details</h3>
            <div class="summaryhistory">
				<table class="table table-bordered">
					<tr>
						<td><b>Name</b></td>
						<td class="text-left"><?= $sale_data['sale']['name'] ?></td>
					</tr>
					<tr>
						<td><b>Email</b></td>
						<td class="text-left"><?= $sale_data['sale']['email'] ?></td>
					</tr>
					<tr>
                        <td><b>Address</b></td>
						<td class="text-left"><?= $sale_data['sale']['address'] ?></td>
					</tr>
					<tr>
						<td><b>IC Number</b></td>
						<td class="text-left"><?= $sale_data['sale']['ic_no'] ?></td>
					</tr>
					<tr>
						<td><b>Mobile Number</b></td>
						<td class="text-left"><?= $sale_data['sale']['mobile_number'] ?></td>
					</tr>
					<tr>
						<td><b>Note</b></td>
						<td class="text-left"><?= $sale_data['sale']['note'] ?></td>
					</tr>
				</table>
        </div>
    <h3 class="h3 title">Payment Method</h3>
            <div class="summaryhistory">
			<form action="" method="post">
			<?php if($sale_data['sale']['payment_status'] == '0'): ?>
			<div>
				<label for="paypal"><input type="radio" id="paypal" name="paymentmethod" value="1" checked />Paypal</label>
				<label for="cod"><input type="radio" id="cod" name="paymentmethod" value="2" />COD (Cash On Delivery)</label>
			</div>
			<div style="float:right">
                <input type="submit" id="ibutton" name="backbtn" value="Back" />
				<input id="btn-pay" type="submit" name="paybtn" value="Proceed To Pay" />
			</div>
		
		<?php 
			else:			
				echo'<div style="height:100px;"><h3>Payment Method</h3><b><p>'.$sale_data['sale']['payment_method'].'</p></b></div>';
				echo '<div style="float:right"><input id="ibutton" type="submit" name="backbtn" value="Back" /></div>';
			endif;
			 ?>
			</form>	
	   </div>
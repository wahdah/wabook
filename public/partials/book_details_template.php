    <div class="box-book-details">
        <div class="row">
            
                    
            <div class="col-md-5">
                    <div>
                        <img src="<?= $vehicle_data["vehiclePartner"]['vehicle']['image']['clean']['thumb']['http'] ?>" alt="">
                    </div>
            </div>
            <div class="col-md-7">
                        <div>
                            <h3 id="carselect"><b>SELECTED CAR</b></h3>
                            <p><b><?= $vehicle_data['vehiclePartner']['vehicle']['manufacturer']['name'].' '. $vehicle_data['vehiclePartner']['vehicle']['name']. ' ('.$vehicle_data['vehiclePartner']['vehicle']['transmission'] .') '.$vehicle_data['vehiclePartner']['vehicle']['engine_size'] / 1000 ?></b></p>
                        </div>
                        <div id="block_display">
                            <h4 id="location">Pickup Location</h4></br>
                            <p><?= $pickupLocation ?>
                            <br><?= $pickupDate->format('j M Y'); ?>, <?= date('g:i A', strtotime($pickupTime)) ?></p>
                        </div>
                        <div id="block_display">
                            <h4 id="location">Return Location:</h4><br>
                            <p><?= $returnLocation ?><br><?= $returnDate->format('j M Y') ?>, <?= date('g:i A', strtotime($returnTime)) ?></p>
                        </div>
                        <div>
                            <h3 class="h3"><small id="myr">MYR</small><span id="price">
                            <?= sprintf('%0.2f', round($rental_amount, 2)) ?></span> </h3>
                            <p id="days">for <?= $days ?> day(s)</p>
                        </div>
            </div>
        </div>
    </div>
        <h3 class="h3 title">Summary of Rental</h3>
            <table class="table">
                <tbody>
                    <tr>
                        <th>Item</th>
                        <th class="text-center">Amount (MYR)</th>
                    </tr>
                
                    <tr>
                        <td>Rental</td>
                        <td class="text-center"><?= $rental_amount ?></td>
                    </tr>
                    <tr>
                        <td>Total Amount</td>
                        <td class="text-center"><?= $rental_amount ?></td>
                    </tr>
                    <tr>
                        <td>Rounding</td>
                        <td class="text-center"><?= $rounding ?></td>
                    </tr>
                    <tr>
                        <td>Pickup Return Fee</td>
                        <td class="text-center"><?= $pickupReturnFee ?></td>
                    </tr>
                    <tr>
                        <td>Refundable Deposit</td>
                        <td class="text-center"><?= $depositAmount ?></td>
                    </tr>
                    <tr>
                        <td>Grand Total</td>
                    <?php $total = $rental_amount + $depositAmount + $pickupReturnFee + $taxAmount; ?>
                        <td class="text-center"><?= $total ?></td>
                    </tr>
                </tbody>
            </table>
        <div class="box summary-book">
        <form action="" method="post">
            <table class="table">
                <tr>
                    <td><b>Name</b></td>
                    <td><input type="text" name="s_name" class="form-control" placeholder="e.g. John Doe" required="required" maxlength="100" id="name"></td>
                </tr>
                <tr>
                    <td><b>Email</b></td>
                    <td><input type="email" name="email" class="form-control" placeholder="e.g. john_doe@mail.com" required="required" maxlength="100" id="email"></td>
                </tr>
				<tr>
                    <td><b>Address</b></td>
                    <td>
						<textarea name="address" class="form-control" placeholder="e.g. Taman Bukit Katil Baiduri, Ayer Keroh, Melaka" required="required" maxlength="500" id="address" rows="5"></textarea>
					</td>
                </tr>
                <tr>
                    <td><b>IC Number</b></td>
                    <td><input type="text" name="ic_no" class="form-control" placeholder="e.g. 543210987654" required="required" maxlength="50" id="driver-ic-number"></td>
                </tr>
                <tr>
                    <td><b>Mobile Number</b></td>
                    <td><input type="text" name="mobile_number" class="form-control" placeholder="e.g. +60123456789" required="required" maxlength="20" id="driver-mobile-number"></td>
                </tr>
                <tr>
                    <td><b>Note</b></td>
                    <td><textarea name="note" class="form-control" placeholder="e.g. I will reach 30 minutes earlier." maxlength="500" id="note" rows="5"></textarea></td>
                </tr>
				
            </table>
          </div>     
           
			<input type="hidden" name="deposit_amount" value="<?= $depositAmount ?>">
			<input type="hidden" name="deposit_amount" value="<?= $depositAmount ?>">
			<input type="hidden" name="discount_amount" value="<?= $discountAmount ?>">
			<input type="hidden" name="end_date" value="<?= $returnDate->format('Y-m-d') ?>">
			<input type="hidden" name="end_time" value="<?= date('H:i:s', strtotime($returnTime)) ?>">
			<input type="hidden" name="pickup_location" value="<?= $pickupLocation ?>">
			<input type="hidden" name="pickup_return_fee" value="<?= $pickupReturnFee ?>">
			<input type="hidden" name="return_location" value="<?= $returnLocation ?>">
			<input type="hidden" name="rental_amount" value="<?= $rental_amount ?>">
			<input type="hidden" name="rounding" value="<?= $rounding ?>">
			<input type="hidden" name="start_date" value="<?= $pickupDate->format('Y-m-d') ?>">
			<input type="hidden" name="start_time" value="<?= date('H:i:s', strtotime($pickupTime)) ?>">
			<input type="hidden" name="tax_amount" value="<?= $taxAmount ?>">
			<input type="hidden" name="total_amount_before_tax" value="<?= $rental_amount ?>">
			<input type="hidden" name="total_amount" value="<?= $total ?>">
			<input type="hidden" name="vehicle_id" value="<?= $vehicle_data['vehiclePartner']['vehicle_id'] ?>">
			<input style="float:right" type="submit" id="ibutton" name="submitbtn" value="Next" />
        </form>
         
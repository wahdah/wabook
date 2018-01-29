<h1>Setup</h1>
	<form action="" method="post">
		<p><label for="dep">Customer Deposit (RM) : </label><input id="dep" type="text" placeholder="<?php _e('eg. 300.00','car-rental'); ?>" name="deposit" value="<?= $deposit ?>" required /></p>
		
		<p><label for="ba">Company Bank Account : </label><input id="ba" type="text" placeholder="<?php _e('eg. 12345678910','car-rental'); ?>" name="bankaccount" value="<?= $bankaccount ?>" required /></p>
		
		<p><label for="bn">Company Bank Name : </label><input id="bn" type="text" placeholder="<?php _e('eg. CIMB Bank','car-rental'); ?>" name="bankname" value="<?= $bankname ?>" required /></p>
		
		<p><label for="an">Account Holder Name : </label><input id="an" type="text" placeholder="<?php _e('eg. Wahdah Sdn Bhd','car-rental'); ?>" name="accountname" value="<?= $accountname ?>" required /></p>
		
		
		

		<?php submit_button( _('Save'),'primary','submit_search', true  ); ?>
		<input type="hidden" name="field_id" value="0" />
		<?php wp_nonce_field('car_search'); ?>
    </form>

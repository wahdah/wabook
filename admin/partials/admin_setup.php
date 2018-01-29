<h1>Setup</h1>
	<form action="" method="post">
		<p><label for="tok">Token : </label><input id="tok" size="160" type="text" placeholder="<?php _e('Please insert your token','car-rental'); ?>" name="token" value="<?= $token ?>" required /></p>
		<p><label for="dep">Customer Deposit (RM) : </label><input id="dep" type="text" placeholder="<?php _e('eg. 300.00','car-rental'); ?>" name="deposit" value="<?= $deposit ?>" required /></p>
		<?php submit_button( _('Save'),'primary','submit_search', true  ); ?>
		<input type="hidden" name="field_id" value="0" />
		<?php wp_nonce_field('car_search'); ?>
    </form>

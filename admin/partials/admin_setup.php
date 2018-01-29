<h1>Setup</h1>
	<form action="" method="post">
		<p><label for="dep">Customer Deposit (RM) : </label><input id="dep" type="text" placeholder="<?php _e('eg. 300.00','car-rental'); ?>" name="deposit" value="<?= $deposit ?>" required /></p>
		<?php submit_button( _('Save'),'primary','submit_search', true  ); ?>
		<input type="hidden" name="field_id" value="0" />
		<?php wp_nonce_field('car_search'); ?>
    </form>

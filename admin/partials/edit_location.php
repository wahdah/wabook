<h1>Edit Location</h1>
	<form action="" method="post">
	
		<p><label for="nloc">New Location Name : </label><input id="nloc" type="text" placeholder="<?php _e('eg. Melaka Sentral','car-rental'); ?>" name="newlocation" value="<?= $plocation ?>" required /></p>
		
        <p><label for="newpickup">New Pickup Fee (RM) : </label><input id="newpickup" type="text" placeholder="<?php _e('eg. 50.00','car-rental'); ?>" name="newpickupfee" value="<?= sprintf('%0.2f', round($pfee, 2)); ?>"  required /></p>      		
		
		<?php submit_button( _('Save'),'primary','submit_edit', true  ); ?>
		<input type="hidden" name="field_id" value="0" />
		<?php wp_nonce_field('car_search'); ?>
    </form>
	
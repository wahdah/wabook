<h1>Manage Location</h1>
<br/>
<h2>Add New Location</h2>
	<form action="" method="post">
	
		<p><label for="loc">Location Name : </label><input id="loc" type="text" placeholder="<?php _e('eg. Melaka Sentral','car-rental'); ?>" name="location" value="<?= (isset($location) ? $location : '') ?>" required /></p>
		
        <p><label for="pickup">Pickup Fee (RM) : </label><input id="pickup" type="text" placeholder="<?php _e('eg. 50.00','car-rental'); ?>" name="pickupfee" value=""  required /></p>      		
		
		<?php submit_button( _('Add Location'),'primary','submit_add', true  ); ?>
		<input type="hidden" name="field_id" value="0" />
		<?php wp_nonce_field('car_search'); ?>
    </form>
<br/>
<h1>Location List</h1>

<table border='1' style="text-align:center">
	<?php
	if(!empty($display_location)): ?>
	<tr><th width="200px">Location Name</th><th width="150px">Pickup Fee (RM)</th><th colspan="2" width="150px">Action</th></tr>
	<?php foreach($display_location as $l):?>
	<tr><td width="200px"><?= $l->name ?></td><td>
	<?= sprintf('%0.2f', round($l->pickupfee, 2)); ?></td><td><a href="<?php echo admin_url('admin.php?page=location-manage&action=edit&id='.$l->id .' '); ?>" >Edit</a></td><td>
	<a href="<?php echo admin_url('admin.php?page=location-manage&action=delete&id='.$l->id .' '); ?>" onclick="return confirm('Are you sure you want to delete this?')" >Delete</a></td></tr>
	<?php endforeach;else: echo'Please Add New Location';endif;?>
	
</table>
<br/>

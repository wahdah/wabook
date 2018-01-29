<div class="wrap_search">
	<div class="menubar">
        		<p id="nav"><b>CAR</b></p>
        	</div>
	<div class="searchbar">	
		<div class="no-gutter sm">
   <form action="<?php esc_url( $_SERVER['REQUEST_URI'] ) ?>" method="get" accept-charset="utf-8" class="form-inline" role="form">
   <select class="iwidth" id="location_s" name="start_location" title="Select a location" required>
						<option value="" disabled selected>Any location</option>
	<?php foreach($search_location as $s):
	 echo '<option>'.$s->name .'</option>';
	endforeach ?>
	</select> 

	<div class="form-group date required">
		<input type="text" id="hdatepick" class="datepick" placeholder="Pickup date" name="pickup_date" value="<?php (isset($_GET['pickup_date']) ? $_GET['pickup_date'] : '') ?>" required />
	</div>
	
	<div class="form-group time required">
		<input type="text" id="hstime" class="timestart right" placeholder="Pick time" name="start_time" value="<?php (isset($_GET['start_time']) ? $_GET['start_time'] : '') ?>" required />
	</div>
	
	<div class="form-group date required">
		<input type="text" id="hdateend" class="dateend" placeholder="Return date" name="return_date" value="<?php (isset($_GET['return_date']) ? $_GET['return_date'] : '') ?>" required />
	</div>
	
	<div class="form-group time required">
		<input type="text" id="hetime" class="timeend right" placeholder="Return time" name="end_time" value="<?php (isset($_GET['end_time']) ? $_GET['end_time'] : '') ?>" required />
	</div>

	<input type="submit" id="ibutton" name="submit_search" value="Search" />
	<div>
	<label for="mycheckbox"><input type="checkbox" id="mycheckbox" name="check_location" value="1" />Return to another location</label>
	</div>
	<div id="mycheckboxdiv" style="display:none;">
	<select class="iwidth" id="location_e" name="end_location" title="Select a location">
						<option value="" disabled selected>Any location</option>
						<?php foreach($search_location as $s):
	 echo '<option>'.$s->name .'</option>';
	endforeach ?>

    </select>
       </div>
	</form>
        </div>
    </div>
</div>
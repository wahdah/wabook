<div class="wrap_search">
    <div class="menubar">
        		<p id="nav"><b>CAR</b></p>
    </div>
	<div class="searchbarbox">		
       <form action="<?php esc_url( $_SERVER['REQUEST_URI'] ) ?>" method="get">

        <div class="row carsearchpad">
            <div class=".col-sm-9">
                <label>Pickup Location</label>
                <select class="box_location" id="location_s" name="start_location" title="Select a location" required>
                    <option value="" disabled selected>Any location</option>
                   <?php foreach($search_location as $s):
                   echo '<option>'.$s->name .'</option>';
                   endforeach ?>
               </select> 
	<label for="mycheckbox"><input type="checkbox" id="mycheckbox" name="check_location" value="1" />Return to another location</label>
    <div id="mycheckboxdiv" style="display:none;">
	<label>Return Location</label>
	<select class="box_location" id="location_e" name="end_location" title="Select a location">
						<option value="" disabled selected>Any location</option>
						<?php foreach($search_location as $s):
	 echo '<option>'.$s->name .'</option>';
	endforeach ?>
         </select></div>
        </div></br>
       </div>
	<div class="row carsearchpad">
        <div class=".col-xs-8 .col-sm-6">
            <label>Pickup Date</label>
	<input type="text" id="datepick" class="datepick" placeholder="Pickup date" name="pickup_date" value="<?php (isset($_GET['pickup_date']) ? $_GET['pickup_date'] : '') ?>" required />
    <input type="text" id="stime" class="timestart" placeholder="Pick time" name="start_time" value="<?php (isset($_GET['start_time']) ? $_GET['start_time'] : '') ?>" required />
    </br></br>
        </div>
    <div class=".col-xs-4 .col-sm-6">
        <label>Return Date</label>
    <input type="text" id="dateend" class="dateend" placeholder="Return date" name="return_date" value="<?php (isset($_GET['return_date']) ? $_GET['return_date'] : '') ?>" required />
    <input type="text" id="etime" class="timeend" placeholder="Return time" name="end_time" value="<?php (isset($_GET['end_time']) ? $_GET['end_time'] : '') ?>" required />
        </br></br>
    </div>
    <div class="dCenter text-center">
	   <input type="submit" id="ibuttonbox" name="submit_search" value="Search" />
    </div>
	</div>
	</form>
    </div>
</div>




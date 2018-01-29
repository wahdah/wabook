<div style="text-align:center;">
		<h1 style="margin:0;padding:0;font-weight:bold;font-size:3em">Thank You !</h1>
		<h2 style="margin:0;padding:0">You have Successfully Booked <span style="font-weight:bold;"><?= $sale_data['sale']['vehicle_name'] ?></span> <br>for <span style="font-weight:bold;"><?= $days ?> days</span> on <span style="font-weight:bold;"><?= date("j M Y, g:i a", strtotime(str_replace("T"," ",$sale_data['sale']['start']))) ?></span> </h2>
		<h2 style="margin:0;padding:0">It's our pleasure to serve you, Please Visit Us Again</h2>
		<h3 style="font-weight:bold;color:grey;width:600px;margin:0 auto">This page will automatically redirect in few second..<div class="loader"></div></h3>
	</div>
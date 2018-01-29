jQuery(document).ready(function($) {

$( ".datepick" ).flatpickr({
	
	dateFormat: "j M Y",
	minDate: new Date(),

	onChange: function() {
		date = $( ".datepick" ).val();
        tempStartDate = new Date(date);
        default_end = new Date(tempStartDate.getFullYear(), tempStartDate.getMonth(), tempStartDate.getDate()+1);
		flatpickr(".dateend", { defaultDate: new Date( default_end),minDate: new Date() ,dateFormat:"j M Y" }).set( "minDate" , $( "#datepick" ).val() );
		
	}
 });


$( ".dateend" ).flatpickr({
	dateFormat: "j M Y",
	minDate : new Date().fp_incr(1)
 });
 

$('.timestart').timepicker({
	'timeFormat': 'g:i A',
	'minTime': '7:00 AM',
	'maxTime': '11:00 PM',
	'step': 15,
	
});
$('.timeend').timepicker({
	'timeFormat': 'g:i A',
    'minTime': '7:00 AM',
    'maxTime': '11:00 PM',
	'step': 15
});
$(".timestart,.timeend").val('9:00 AM');

$('#mycheckbox').change(function(){
    if(this.checked) {
        $('#mycheckboxdiv').show();
    } else {
        $('#mycheckboxdiv').hide();
    }
});


$('#location_s').change(function(){
    var loc = $(this).val();
	$('#location_e').val(loc);
	
});

$('#login-trigger').click(function(){
    $(this).next('#login-content').slideToggle();
    $(this).toggleClass('active');          
    
    if ($(this).hasClass('active')) $(this).find('span').html('&#x25B2;')
      else $(this).find('span').html('&#x25BC;')
    });

});
